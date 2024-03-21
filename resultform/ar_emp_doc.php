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

if($report=="AR EMPLOYEE"){$qry="EMP";}else{$qry="DOC";}

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

if($report=="AR DOCTOR"){
  $sqlxxxx = "SELECT * from admission a, docfile p where a.patientidno=p.code and a.caseno like 'DOC%' and dateadmit between '$datef' and '$datet' order by a.patientidno";
}else{
$sqlxxxx = "SELECT * from admission a, nsauthemployees n where a.patientidno=n.empid and a.caseno like '$qry%' and dateadmit between '$datef' and '$datet' order by a.patientidno";
}
$resultxxxx = $conn->query($sqlxxxx);
while($rowxxxx = $resultxxxx->fetch_assoc()) { 
$name = $rowxxxx['name'];
$caseno = $rowxxxx['caseno'];


$sqlxxxxz = "SELECT * from productout where caseno='$caseno' and administration='dispensed'";
$resultxxxxz = $conn->query($sqlxxxxz);
$countyy = mysqli_num_rows($resultxxxxz);
if($countyy>0){
while($rowxxxxz = $resultxxxxz->fetch_assoc()) { 
$desc = $rowxxxxz['productdesc'];
$gross = $rowxxxxz['gross'];
$qty = $rowxxxxz['quantity'];
$vdate = $rowxxxxz['datearray'];
$total += $gross;

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
}
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
$dompdf->stream('Electronic Stock Card.pdf', array('Attachment' => false));
?>
