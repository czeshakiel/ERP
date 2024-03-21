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

$datefrom=$_POST['datefrom'];
$dateto=$_POST['dateto'];
$type=$_POST['type'];
$accttitle=$_POST['accttitle'];
$desc=$_POST['desc'];
$reader=$_POST['reader'];

$sql = $conn->query("select * from docfile where code='$reader'");
while($res = $sql->fetch_assoc()){$doc = $res['name'];}

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

<p align="right" style="font-size: 13px;">
Reader: <b>'.strtoupper($doc).'</b><br>
Date: <b>'.$datefrom.' - '.$dateto.' ---- '.$accttitle.'</b>

</p>
<table align="center"><tr>
<td style="font-size: 15px; text-align: center;"><b>READERS FEE REPORT<b></td>
</tr></table>



<br>
<table align="center" width="100%" border="1" style="border-collapse: collapse;">
<tr>
<td style="text-align: center; font-size: 11px; width: 25%;"><b>PATIENT</b></td>
<td style="text-align: center; font-size: 11px; width: 5%;"><b>SENIOR</b></td>
<td style="text-align: center; font-size: 11px; width: 10%;"><b>DATE</b></td>
<td style="text-align: center; font-size: 11px; width: 35%;"><b>TEST</b></td>
<td style="text-align: center; font-size: 11px; width: 5%;"><b>CASH</b></td>
<td style="text-align: center; font-size: 11px; width: 5%;"><b>PHIC</b></td>
<td style="text-align: center; font-size: 11px; width: 5%;"><b>HMO</b></td>
<td style="text-align: center; font-size: 11px; width: 5%;"><b>EXCESS</b></td>
<td style="text-align: center; font-size: 11px; width: 5%;"><b>PF SHARE</b></td>
</tr>
';

if($accttitle!=""){
if($accttitle=="ALL"){$que = "and (a.productsubtype='XRAY' or a.productsubtype='ULTRASOUND' or a.productsubtype='CT SCAN')";}
else{$que = "and a.productsubtype='$accttitle'";}
}else{
 $que = "and a.productcode='$desc'";
}

$sql2 = $conn->query("SELECT a.caseno, c.lastname, c.firstname, c.middlename, a.scpwd, a.datearray, a.productdesc, a.productsubtype, a.trantype, a.phic, a.hmo, a.excess from productout a, admission b, patientprofile c where a.caseno=b.caseno and b.patientidno=c.patientidno and
 a.referenceno='$reader' and a.datearray between '$datefrom' and '$dateto' and (a.terminalname='Testtobedone' or a.terminalname='Testdone') $que");
while($res2 = $sql2->fetch_assoc()) { 
$caseno = $res2['caseno'];
$name = $res2['lastname'].", ".$res2['firstname']." ".$res2['middlename'];
$scpwd = $res2['scpwd'];
$datearray = $res2['datearray'];
$productdesc = $res2['productdesc'];
$trantype = $res2['trantype'];
$myphic = $res2['phic'];
$myhmo = $res2['hmo'];
$excess = $res2['excess'];
$productsubtype = $res2['productsubtype'];

if($excess>0 and $trantype=="cash"){$mycash=$excess; $myexcess="0";}
if($excess>0 and $trantype=="charge"){$mycash="0"; $myexcess=$excess;}

$total = $mycash + $myphic + $myhmo + $myexcess;

$html .= '
<tr>
<td style="font-size:11px;">'.strtoupper($name).'</td>
<td style="font-size:11px; text-align: center;">'.$scpwd.'</td>
<td style="font-size:11px; text-align: center;">'.$datearray.'</td>
<td style="font-size:11px;">'.$productdesc .'<b style="font-size:7px; color:red;">['.$productsubtype.']</b></td>
<td style="font-size:11px; text-align:right;">'.number_format($mycash, 2).'</td>
<td style="font-size:11px; text-align:right;">'.number_format($myphic, 2).'</td>
<td style="font-size:11px; text-align:right;">'.number_format($myhmo, 2).'</td>
<td style="font-size:11px; text-align:right;">'.number_format($myexcess, 2).'</td>
<td style="font-size:11px; text-align:right;">'.number_format($total, 2).'</td>
</td>
';
}

$html .= '</table><br>';


$hf = $totalx * 0.01;
$gross = $totalx * 1.01;
$totalx2 = number_format($totalx, 2);
$hf2 = number_format($hf, 2);
$gross2 = number_format($gross, 2);

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
$dompdf->setPaper('Letter', 'landscape');
//$dompdf->setPaper([0,0,612,1008], 'portrait');

// Render the PDF
$dompdf->render();

// Output the generated PDF to the browser
$dompdf->stream('Electronic Stock Card.pdf', array('Attachment' => false));
?>
