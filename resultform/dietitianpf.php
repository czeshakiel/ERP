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

$datef=$_POST['datef'];
$datet=$_POST['datet'];
$datef2 = date("F d, Y", strtotime($datef));
$datet2 = date("F d, Y", strtotime($datet));
$report=$_POST['report'];

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

<p align="right" style="font-size: 13px;">Date: <b>'.$datef2.' - '.$datet2.'</b></p>
<table align="center"><tr>
<td style="font-size: 15px; text-align: center;"><b>'.$report.'<b></td>
</tr></table>


<table align="center" width="100%" border="1" style="border-collapse: collapse;">
<tr>
<td style="text-align: center; font-size: 11px; width: 30%;"><b>Charge to</b></td>
<td style="text-align: center; font-size: 11px; width: 10%;"><b>Date</b></td>
<td style="text-align: center; font-size: 11px; width: 40%;"><b>Product Description</b></td>
<td style="text-align: center; font-size: 11px; width: 10%;"><b>Qty</b></td>
<td style="text-align: center; font-size: 11px; width: 10%;"><b>Amount</b></td>
</tr>
';

$result = $conn->query("SELECT * from productout where productdesc='DIET COUNSELING' and (caseno not like '%cancelled%' or trantype not like '%cancelled%') 
and datearray between '$datef' and '$datet' order by datearray");
while($row = $result->fetch_assoc()) { 
$desc = $row['productdesc'];
$gross = 150;
$qty = $row['quantity'];
$vdate = $row['datearray'];
$caseno = $row['caseno'];
$total += $gross;


$sql2 = $conn->query("select * from admission a, patientprofile p where a.patientidno=p.patientidno and a.caseno='$caseno'");
while($res2 = $sql2->fetch_assoc()){$name = $res2['lastname'].", ".$res2['firstname']." ".$res2['middlename'];}

$html .= '
<tr>
<td style="text-align: center; font-size: 11px;">'.$name.'</td>
<td style="text-align: center; font-size: 11px;">'.$vdate.'</td>
<td style="font-size: 11px;">'.$desc.'</td>
<td style="text-align: center; font-size: 11px;">'.$qty.'</td>
<td style="text-align: center; font-size: 11px;">'.$gross.'</td>
</tr>
';

}

$html .= '</table><br>';

$totalx2 = number_format($total, 2);

$html .=  '

<table width="40%" align="right">
<tr>
<td style="font-size: 13px;">Total</td>
<td style="font-size: 13px; border-bottom: 1px solid black;">'.$totalx2.'</td>
</tr>
</table>

<br><br>

<table align="center" width="100%">
<tr>
<td style="font-size: 11px;" width="30%">Prepared by:</td>
<td style="font-size: 11px;" width="30%">Checked by:</td>
<td style="font-size: 11px;" width="30%">Approved by:</td>
</tr>
<tr>
<td style="font-size: 11px;">&nbsp;</td>
<td style="font-size: 11px;">&nbsp;</td>
<td style="font-size: 11px;">&nbsp;</td>
</tr>
<tr>
<td style="font-size: 11px;"><u>'.$user.'</u></td>
<td style="font-size: 11px;"><u>_______________________</u></td>
<td style="font-size: 11px;"><u>_______________________</u></td>
</tr>
<tr>
<td style="font-size: 11px;"></td>
<td style="font-size: 11px;">Accounting In-charge</td>
<td style="font-size: 11px;">Administrator</td>
</tr>
</table>
';


// Load the HTML into the renderer
$dompdf->loadHtml($html);

// Set the paper size and orientation
$dompdf->setPaper('Letter', 'portrait');
//$dompdf->setPaper([0,0,612,1008], 'portrait');

// Render the PDF
$dompdf->render();

// Output the generated PDF to the browser
$dompdf->stream('Dietitian PF.pdf', array('Attachment' => false));
?>
