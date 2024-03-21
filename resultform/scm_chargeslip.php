<?php
include '../main/class.php';
$version = explode(".", phpversion());

if($version[0]=="5"){
//5.4 and above   
require_once '../resultform/dompdf5.4/autoload.inc.php';
}else{
//7.1 and above    
require_once '../resultform/dompdf7.1/autoload.inc.php';
}

$dompdf = new Dompdf\Dompdf();

$po=$_GET['po'];
$rrno=$_GET['rrno'];
$invno=$_GET['invno'];

$pono = str_replace ('_', ' ', $pono);
$st = str_replace ('_', ' ', $st);

$sql = $conn->query("SELECT * FROM stocktablepayables where po='$po' and rrno='$rrno' and invno='$invno' group by dept");
while($res = $sql->fetch_assoc()){$deptx = $res['dept']; $transdate = $res['transdate']; $terms=$res['terms']; $supname=$res['suppliername'];}

if($terms=="NONE" or $terms=="none"){$terms = "NONE";}
else{$terms = $terms." days";}

$sql2 = $conn->query("SELECT * FROM purchaseorder where po='$po'");
while($res2 = $sql2->fetch_assoc()){$podept = $res2['dept'];}

if($deptx=="AMSHI"){$deptx = "ANTIPAS MEDICAL SPECIALISTS HIOSPITAL, INC";}
elseif($deptx=="MMSHI"){$deptx = "MAKILALA MEDICAL SPECIALISTS HIOSPITAL, INC";}
elseif($deptx=="CMSHI"){$deptx = "CENTENO MEDICAL SPECIALISTS HIOSPITAL, INC";}
elseif($deptx=="MMHI"){$deptx = "MAGSAYSAY MEDICAL HOSPITAL, INC.";}

// Define the HTML content
$html = '
<style>
.footer {
  position: fixed;
  left: 0;
  bottom: 25%;
  width: 100%;
}
</style>

<table width="100%"><tr>
<td width="10%"><img src="../resultform/kmsci.png" width="70" height="70"></td>
<td>
<table align="center"><tr>
<td style="text-align: center;"><b>'.$heading.'</b></td>
</tr><tr>
<td style="font-size: 13px; text-align: center;">'.$address.'</td>
</tr><tr>
<td style="font-size: 13px; text-align: center;">Tel. No.: '.$telno.'</td>
</tr></table>
</td>
<td width="10%">&nbsp;</td>
</tr></table>

<p align="right" style="font-size: 13px;">Charge Slip No.: <b>'.$rrno.'</b></p>
<table align="center"><tr>
<td style="font-size: 15px; text-align: center;"><b>CHARGE SLIP<b></td>
</tr></table>


<table width="100%" border="1" style="border-collapse: collapse;">
<tr>
<td rowspan="3" width="60%" valign="TOP" style="font-size: 12px;">
Charge To:<br><br><b>'.$podept.' - '.$deptx.'</b>
</td>
<td colspan="2" style="font-size: 12px;"><b>'.$supname.'</b></td>
</tr>
<tr>
<td style="font-size: 12px;">Date: <b>'.$transdate.'</b></td>
<td style="font-size: 12px;">Terms: <b>90 days</b></td>
</tr>
<tr>
<td style="font-size: 12px;">PO No.: <b>'.$po.'</b></td>
<td style="font-size: 12px;">Invoice: <b>'.$invno.'</b></td>
</tr>
</table>



<br>
<table align="center" width="100%" border="1" style="border-collapse: collapse;">
<tr>
<td style="text-align: center; font-size: 11px; width: 5%;"><b>Qty</b></td>
<td style="text-align: center; font-size: 11px; width: 5%;"><b>Unit</b></td>
<td style="text-align: center; font-size: 11px; width: 40%;"><b>Product Description</b></td>
<td style="text-align: center; font-size: 11px; width: 15%;"><b>Lot #</b></td>
<td style="text-align: center; font-size: 11px; width: 15%;"><b>Expiration Date</b></td>
<td style="text-align: center; font-size: 11px; width: 6%;"><b>Unit Cost</b></td>
<td style="text-align: center; font-size: 11px; width: 6%;"><b>Disc</b></td>
<td style="text-align: center; font-size: 11px; width: 7%;"><b>Total Amount</b></td>
</tr>
';

$total = 0; $totalx = 0;
$result222 = $conn->query("SELECT * FROM stocktablepayables where po='$po' and rrno='$rrno' and invno='$invno'");
while($row222 = $result222->fetch_assoc()){ 
$qty=$row222['quantity'];
$reqdate = $row222['reqdate'];
$description= $row222['description'];
$lotno = $row222['lotno'];
$expiration = $row222['expiration'];
$unitcost = $row222['unitcost'];
$generic = $row222['generic'];
$discountprice=$row222['prodtype1'];
$isid=$row222['isid'];
$code=$row222['code'];
$trantype = $row222['trantype'];

$dd = $conn->query("select * from receiving where code='$code'");
while($dd1 = $dd->fetch_assoc()){
$description = $dd1['description'];
$generic = $dd1['generic'];
}

if($generic!=""){$description = "($generic) $description";}

$unitcost2 = number_format($unitcost, 2);
$total = $qty * $unitcost;
$disc = 0;
if($discountprice>0){
$disc = $unitcost - $discountprice;
$total = $qty * $discountprice;
}

if($trantype=="FREE GOODS"){$total=0;}

$disc2 = number_format($disc, 2);
$total2 = number_format($total, 2);
$discountprice2 = number_format($discountprice, 2);
$totalx+=$total;

$mreqdate="";
$result = $conn->query("SELECT reqdate FROM purchaseorder WHERE code='$code' AND reqdept='$st' AND `status`='received' AND 
reqdate < '$reqdate' GROUP BY reqno ORDER BY reqdate DESC");
while($row = $result->fetch_assoc()){$mreqdate = $row['reqdate'];}

$dd = $conn->query("select * from savequantity where rrdetails='$isid'");
while($dd1 = $dd->fetch_assoc()){$unitx = $dd1['unit'];}

$suppliername = str_replace("'", "", $suppliername);
$receivinguser = str_replace("'", "", $receivinguser);

if($suppliername=="CPU" and $dept!="CPU" and $trantype=="ADJUSTMENT"){$suppliername=$dept;}


$html .= '
<tr>
<td style="text-align: center; font-size: 11px;">'.$qty.'</td>
<td style="text-align: center; font-size: 11px;">'.$unitx.'</td>
<td style="font-size: 11px;">'.$description.'</td>
<td style="text-align: center; font-size: 11px;">'.$lotno.'</td>
<td style="text-align: center; font-size: 11px;">'.$expiration.'</td>
<td style="text-align: center; font-size: 11px;">'.$unitcost2.'</td>
<td style="text-align: center; font-size: 11px;">'.$discountprice2.'</td>
<td style="text-align: center; font-size: 11px;">'.$total2.'</td>
</tr>
';


}

$html .= '</table><br>';


$hf = $totalx * 0.01;
$gross = $totalx * 1.01;
$totalx2 = number_format($totalx, 2);
$hf2 = number_format($hf, 2);
$gross2 = number_format($gross, 2);

$html .=  '
<div class="footer">

<table width="40%" align="right">
<tr>
<td style="font-size: 13px;">Total</td>
<td style="font-size: 13px; border-bottom: 1px solid black;">'.$totalx2.'</td>
</tr>
<tr>
<td style="font-size: 13px;">Add: 1% Handling Fee</td>
<td style="font-size: 13px; border-bottom: 1px solid black;">'.$hf2.'</td>
</tr>
<tr>
<td style="font-size: 13px;">Grand Total</td>
<td style="font-size: 13px; border-bottom: 1px solid black;"><b>'.$gross2.'</b></td>
</tr>
</table>

<br><br><br><br><br><br><br>

<table align="center" width="100%">
<tr>
<td style="font-size: 11px;" width="23%">Prepared by:</td>
<td style="font-size: 11px;" width="23%">Checked by:</td>
<td style="font-size: 11px;" width="23%">Approved by:</td>
<td style="font-size: 11px;" width="23%">Received by:</td>
</tr>
<tr>
<td style="font-size: 11px;">&nbsp;</td>
<td style="font-size: 11px;">&nbsp;</td>
<td style="font-size: 11px;">&nbsp;</td>
<td style="font-size: 11px;">&nbsp;</td>
</tr>
<tr>
<td style="font-size: 11px;"><u>'.$user.'</u></td>
<td style="font-size: 11px;"><u>_______________________</u></td>
<td style="font-size: 11px;"><u>_______________________</u></td>
<td style="font-size: 11px;"><u>_______________________</u></td>
</tr>
<tr>
<td style="font-size: 11px;"></td>
<td style="font-size: 11px;"></td>
<td style="font-size: 11px;"></td>
<td style="font-size: 11px;">Signature over printed name</td>
</tr>
</table>

<p style="font-size: 11px;"><b>NOTE: Return of expiry Medicines and Supplies must be three (3) months before expiration date.</b></p>

<table align="center" width="100%">
<tr>
<td style="font-size: 11px;"><u><b>** white and yellow copy - customer </b></u></td>
<td style="font-size: 11px;"><u><b>** pink copy - Kmsci copy</b></u></td>
</tr>
</table>
</footer>
';


// Load the HTML into the renderer
$dompdf->loadHtml($html);

// Set the paper size and orientation
$dompdf->setPaper('Letter', 'portrait');
//$dompdf->setPaper([0,0,612,1008], 'portrait');

// Render the PDF
$dompdf->render();

// Output the generated PDF to the browser
$dompdf->stream('Electronic Stock Card.pdf', array('Attachment' => false));
?>
