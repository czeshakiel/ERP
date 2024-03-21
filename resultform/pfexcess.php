<?php
//error_reporting(1);
//ini_set("display_errors", "ON");
include '../main/class.php';
$version = explode(".", phpversion());

if($version[0]=="5"){
//5.4 and above   
require_once '../resultform/dompdf5.4/autoload.inc.php';
}else{
//7.1 and above    
require_once '../resultform/dompdf7.1/autoload.inc.php';
}

ini_set('memory_limit', '900M');
ini_set("display_errors", "ON");
error_reporting(1);
$dompdf = new Dompdf\Dompdf();



$doc = $_POST['doc'];
$datef = $_POST['datef'];
$datet = $_POST['datet'];
$date = date("F d, Y", strtotime($datef))." - ".date("F d, Y", strtotime($datet));

$doc2=$doc;
$sql = $conn->query("select * from docfile where code='$doc'");
while($res=$sql->fetch_assoc()){
$doc2 = $res['name'];
}

if($doc=="ALL"){$que="";}
else{$que="and pfcode='$doc'";}

// Define the HTML content
$html = '
<head>
<style>
@page {margin-bottom: 200px;}
    
header {
position: fixed;
top: 0cm;
left: 0cm;
right: 0cm;
height: 2cm;
}

footer {
position: fixed; 
bottom: 0cm; 
left: 0cm; 
right: 0cm;
height: 2cm;
}

 main {
position: relative;
top: 180px;
}
</style>
</head>

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
<td style="font-size: 13px; text-align: center;"><b>PF EXCESS<b></td>
</tr></table><hr>

<table>
<tr><td style="font-size: 11px;">Report Date: <b>'.$date.'</b></td></tr>
<tr><td style="font-size: 11px;">Doctor: <b>'.$doc2.'</b></td></tr>
</table>
';

if($doc!="ALL"){ 
$html .='

<table align="center" width="100%" border="1" style="border-collapse: collapse;">
<tr>
<td style="text-align: center; font-size: 11px; width: 5%;"><b>NO.</b></td>
<td style="text-align: center; font-size: 11px; width: 50%;"><b>DOCTOR</b></td>
<td style="text-align: center; font-size: 11px; width: 35%;"><b>PATIENT</b></td>
<td style="text-align: center; font-size: 11px; width: 10%;"><b>AMOUNT</b></td>
</tr>
</table>




<table align="center" width="100%" border="1" style="border-collapse: collapse;">
';
if($doc=="ALL"){$que="";}
else{$que = "and pfcode='$doc'";}
$i=0;
$resultn = $conn->query("select * from collection where accttitle='PROFESSIONAL FEE' and datearray between '$datef' and '$datet' $que order by pfcode");
while($rown = $resultn->fetch_assoc()){ 
$desc=addslashes($rown['description']);
$name=addslashes($rown['acctname']);
$amount=$rown['amount'];
$i++;


$html .= '
<tr>
<td style="text-align: center; font-size: 11px; width: 5%;">'.$i.'</td>
<td style="font-size: 11px; width: 50%;">'.$desc.'</td>
<td style="font-size: 11px; width: 35%;">'.$name.'</td>
<td style="text-align: center; font-size: 11px; width: 10%;">'.number_format($amount, 2).'</td>
</tr>
';
}

$html .= '
</table>
<br><br>
';
}

$html.='
<table width="70%" border="1" style="border-collapse: collapse;">
<tr><td colspan="2" style="font-size: 12px;"><b>PF EXCESS SUMMARY</b></td>
';


$resultn1 = $conn->query("select sum(amount) as total, description from collection where accttitle='PROFESSIONAL FEE' and datearray between '$datef' and '$datet' $que group by pfcode order by description");
while($rown1 = $resultn1->fetch_assoc()){ 
$desc1=addslashes($rown1['description']);
$totalamount=$rown1['total'];
$i++;
$gtotal += $totalamount;
$html .= '
<tr>
<td width="70%" style="font-size: 12px;">'.$desc1.'</td>
<td style="font-size: 12px; text-align:right;">'.number_format($totalamount, 2).'</td>
</tr>
';
}

$html .= '
<tr>
<td width="70%" style="font-size: 12px;"><b>GRAND TOTAL</b></td>
<td style="font-size: 12px; text-align:right;"><b>'.number_format($gtotal, 2).'</b></td>
</tr>
';

$html .= '
</table>
';


$html .=  '


<br><br><br><br>

<table align="center" width="100%">
<tr>
<td style="font-size: 11px;" width="23%">Prepared by:</td>
<td style="font-size: 11px;" width="23%">Checked by:</td>
<td style="font-size: 11px;" width="23%">Noted by:</td>
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
<td style="font-size: 11px;">_______________________</td>
<td style="font-size: 11px;">_______________________</td>
<td style="font-size: 11px;">_______________________</td>
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
$dompdf->stream('PF Excess.pdf', array('Attachment' => false));
?>