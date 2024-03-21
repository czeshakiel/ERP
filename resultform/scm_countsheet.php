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



$deptx = $_POST['dept'];
$acctitlex = $_POST['accttitle'];
$invdatex = $_POST['invdate'];


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

<header>
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
<td style="font-size: 13px; text-align: center;"><b>'.$deptx.' COUNT SHEET<b></td>
</tr></table><hr>

<table>
<tr><td style="font-size: 11px;">Inventory Date: <b>'.$invdatex.'</b></td></tr>
<tr><td style="font-size: 11px;">Account title: <b>'.$acctitlex.'</b></td></tr>
</table>

<table align="center" width="100%" border="1" style="border-collapse: collapse;">
<tr>
<td style="text-align: center; font-size: 11px; width: 5%;"><b>NO.</b></td>
<td style="text-align: center; font-size: 11px; width: 60%;"><b>DESCRIPTION</b></td>
<td style="text-align: center; font-size: 11px; width: 10%;"><b>EXPIRATION</b></td>
<td style="text-align: center; font-size: 11px; width: 5%;"><b>QTY</b></td>
<td style="text-align: center; font-size: 11px; width: 10%;"><b>PHYSICAL<br>COUNT 1</b></td>
<td style="text-align: center; font-size: 11px; width: 10%;"><b>PHYSICAL<br>COUNT 2</b></td>
</tr>
</table>
</header>


<main>
<table align="center" width="100%" border="1" style="border-collapse: collapse;">
';

$i=0;
$resultn = $conn->query("select * from bulkadjustment where dept='$dept'");
while($rown = $resultn->fetch_assoc()){ 
$qty=addslashes($rown['soh']);
$desc=addslashes($rown['desc']);
$i++;

$desc=str_replace('ams-','',$desc);
$desc=str_replace('cmshi-','',$desc);
$desc=str_replace('-med','',$desc);
$desc=str_replace('-sup','',$desc);

$html .= '
<tr>
<td style="text-align: center; font-size: 11px; width: 5%;">'.$i.'</td>
<td style="font-size: 11px; width: 60%;">'.$desc.'</td>
<td style="text-align: center; font-size: 11px; width: 10%;"></td>
<td style="text-align: center; font-size: 11px; width: 5%;">'.$qty.'</td>
<td style="text-align: center; font-size: 11px; width: 10%;"></td>
<td style="font-size: 11px; width: 10%;"></td>
</tr>
';
}

$html .= '
</table>
</main>
';


// Load the HTML into the renderer
$dompdf->loadHtml($html);

// Set the paper size and orientation
//$dompdf->setPaper('A4', 'portrait');
$dompdf->setPaper([0,0,612,1008], 'portrait');

// Render the PDF
$dompdf->render();

// Output the generated PDF to the browser
$dompdf->stream('Count sheet.pdf', array('Attachment' => false));
?>