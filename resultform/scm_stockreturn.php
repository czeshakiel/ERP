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

$pono=$_GET['reqno'];
$st=$_GET['dept'];

$pono = str_replace ('__', ' ', $pono);
$st = str_replace ('_', ' ', $st);

$sql = $conn->query("SELECT * FROM purchaseorder WHERE reqno='$pono'");
while($res = $sql->fetch_assoc()){$deptx=$res['reqdept']; $reqdate = $res['reqdate'];}


// Define the HTML content
$html = '
<table width="100%"><tr>
<td width="10%"><img src="../resultform/kmsci.png" width="50" height="50"></td>
<td>
<table align="center"><tr>
<td style="text-align: center;"><b>'.$heading.'</b></td>
</tr><tr>
<td style="font-size: 13px; text-align: center;">'.$address.'</td>
</tr></table>
</td>
<td width="10%">&nbsp;</td>
</tr></table>
<br>

<table align="center"><tr>
<td style="font-size: 13px; text-align: center;"><b>STOCK RETURN REQUISITION SLIP<b></td>
</tr></table><hr>


<table width="100%" cellpadding="0" cellspacing="0" class="table" style="font-family:Arial; font-size:12px;" border="0">
<tr>
<td style="font-size: 11px; width: 10%;">Return to: </td>
<td style="font-size: 11px; width: 10%;"><u><b>'.$deptx.'</b></u></td>
<td style="font-size: 11px; width: 10%;">STR No.:</td>
<td style="font-size: 11px; width: 10%;"><u><b>'.$pono.'</b></u></td>
</tr>
<tr>
<td style="font-size: 11px; width: 10%;">Requested By: </td>
<td style="font-size: 11px; width: 10%;"><b><u>'.$st.'</b></u></td>
<td style="font-size: 11px; width: 10%;">Date: </td>
<td style="font-size: 11px; width: 10%;"><b><u>'.$reqdate.'</b></u></td>
</tr>
</table>



<br>
<table align="center" width="100%" border="1" style="border-collapse: collapse;">
<tr>
<td style="text-align: center; font-size: 11px; width: 10%;"><b>#</b></td>
<td style="text-align: center; font-size: 11px; width: 10%;"><b>QTY</b></td>
<td style="text-align: center; font-size: 11px; width: 60%;"><b>DESCRIPTION</b></td>
<td style="text-align: center; font-size: 11px; width: 20%;"><b>LOTNO</b></td>
<td style="text-align: center; font-size: 11px; width: 20%;"><b>EXPIRATION</b></td>
</tr>
';

$i=0;
$result222 = $conn->query("SELECT * FROM purchaseorder WHERE po='$pono' AND `status` LIKE '%transfer%'");
while($row222 = $result222->fetch_assoc()){ 
$code=$row222['code'];
$reqdate = $row222['reqdate'];
$description= $row222['description'];
$prodqty = $row222['prodqty'];
$rrdetails = $row222['rrdetails'];
$i++;

$description=str_replace('cmshi-', '', $description);
$description=str_replace('ams-', '', $description);
$description=str_replace('amc-', '', $description);
$description=str_replace('RDU-', '', $description);
$description=str_replace('-sup', '', $description);
$description=str_replace('-med', '', $description);

$mreqdate="";
$result = $conn->query("SELECT * from savequantity where rrdetails='$rrdetails'");
while($row = $result->fetch_assoc()){$lotno = $row['lotno']; $expiration = $row['expiration'];}

$suppliername = str_replace("'", "", $suppliername);
$receivinguser = str_replace("'", "", $receivinguser);

if($suppliername=="CPU" and $dept!="CPU" and $trantype=="ADJUSTMENT"){$suppliername=$dept;}

$html .= '
<tr>
<td style="text-align: center; font-size: 11px;">'.$i.'.</td>
<td style="text-align: center; font-size: 11px;">'.$prodqty.'</td>
<td style="font-size: 11px;">'.$description.'</td>
<td style="text-align: center; font-size: 11px;">'.$lotno.'</td>
<td style="text-align: center; font-size: 11px;">'.$expiration.'</td>
</tr>
';
}

$html .= '
</table>

<br>
<table align="center" width="100%">
<tr>
<td style="font-size: 11px;">REQUESTED BY:</td>
<td style="font-size: 11px;">RECEIVED BY:</td>
<td style="font-size: 11px;">APPROVED BY:</td>
</tr>
<tr>
<td style="font-size: 11px;">&nbsp;</td>
<td style="font-size: 11px;">&nbsp;</td>
<td style="font-size: 11px;">&nbsp;</td>
</tr>
<tr>
<td style="font-size: 11px;">&nbsp;</td>
<td style="font-size: 11px;">&nbsp;</td>
<td style="font-size: 11px;">&nbsp;</td>
</tr>
<tr>
<td style="font-size: 11px;"><u>_______________________</u></td>
<td style="font-size: 11px;"><u>_______________________</u></td>
<td style="font-size: 11px;"><u>_______________________</u></td>
</tr>
</table>

';


// Load the HTML into the renderer
$dompdf->loadHtml($html);

// Set the paper size and orientation
//$dompdf->setPaper('A4', 'portrait');
$dompdf->setPaper([0,0,612,1008], 'portrait');

// Render the PDF
$dompdf->render();

// Output the generated PDF to the browser
$dompdf->stream('Electronic Stock Card.pdf', array('Attachment' => false));
?>
