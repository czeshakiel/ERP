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

$orno=$_GET['orno'];
$datearray1 = date("Y/m/d");
$datearray2 = date("h:s:i a");

$sql = $conn->query("select * from collection where ofr='$orno'");
while($res=$sql->fetch_assoc()){
$pname = $res['acctname'];
$caseno = $res['acctno'];
$ddate=date("M d,Y", strtotime($res['datearray']));
$ttime=date("h:i:s a", strtotime($res['paymentTime']));
}

$sql22 = "SELECT * from admission where caseno='$caseno'";
$result22 = $conn->query($sql22);
while($row22 = $result22->fetch_assoc()) { 
$membership=$row22['membership'];
$hmo=$row22['hmo'];
$room=$row22['room'];
}  

// Define the HTML content
$html = '
<style>
.footer {
  position: fixed;
  left: 0;
  bottom: 25%;
  width: 100%;
}

.p1 {
  font-family: "Times New Roman", Times, serif;
}

.p2 {
  font-family: Arial, Helvetica, sans-serif;
}

.p3 {
  font-family: "Lucida Console", "Courier New", monospace;
}
</style>

<br><br><br><br>&nbsp;<br>
<table width="50%"><tr><td>
<table width="90%" border="0" cellspacing="0" cellpadding="0" align="right">
<tr>
<td style="text-align: right;"><span class="style21">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="1" class="p2"><b>'.$orno.'</b></span></td>
<td align="right"><span class="style21">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="1" class="p2"><b>'.$ddate.'-'.$ttime.'</b></span></td>
</tr>
<tr>
<td colspan="2"><span class="style18">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="1" class="p2"><b>'.$pname.'</b></span></td>
</tr>
</table>
</td></tr></table>

<br><br><br><br>
<table width="50%"><tr><td>
<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
';

$totalsale=0; $scpwd = 0; $sccheck=0;
$sql3 = $conn->query("select * from collection where ofr='$orno'");
$countlist = mysqli_num_rows($sql3);
while($res3=$sql3->fetch_assoc()){
$desc = $res3['description'];
$refno = $res3['refno'];
$accttitle = $res3['accttitle'];

$sql4 = $conn->query("select * from collectiondetails2 where ofr='$orno' and refno='$refno' order by date desc, paymentTime desc limit 1");
while($res4=$sql4->fetch_assoc()){
$qty = $res4['qty'];
$srp = $res4['srp'];
$gross = $res4['gross'];
$net = $res4['net'];
$wvat = $res4['wvat'];
$scdiscount += $res4['scdiscount'];
$scpwd = $res4['scpwd'];
$isvat = $res4['isvat'];
$lot = $res4['lotno'];
$totalsale+=$gross-$wvat;
}

list($lotno, $xvat) = explode("|", $lot);

if($accttitle=="PHARMACY/MEDICINE" and $xvat=="V"){
$vatablesale += $gross;
$VATexemptsale += 0;
}

else{
$vatablesale += 0;
$VATexemptsale += $gross;
}

if($scpwd=="YES" or $scpwd=="Y"){$sccheck++;}


$html .='
<tr>
<td style="text-align: left; font-size: 11px; width: 10%;" class="p2">'.$qty.'</td>
<td style="text-align: left; font-size: 11px; width: 60%;" class="p2">'.$desc.'</td>
<td style="text-align: right; font-size: 11px; width: 15%;" class="p2">'.$srp.'</td>
<td style="text-align: right; font-size: 11px; width: 15%;" class="p2">'.$gross.'</td>
</tr>
';

}

$html .= '</table><br>';

$space = 7 - $countlist;
for($i=0; $i<$space; $i++){$html .='<br>';}


$totaldue = $totalsale - $scdiscount;
$vatableamount = $vatablesale - ($vatablesale / 1.12);

if($sccheck>0){
$vatablesale = 0;
$VATexemptsale = $totalsale;
$vatableamount = 0;
}

$html .= '
<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td style="width: 34%; text-align: right; font-size: 11px;"></td>
<td style="width: 70%; text-align: right; font-size: 11px;" class="p2">'.number_format($totalsale, 2).'</td>
</tr>
<tr>
<td style="text-align: right; font-size: 11px;" class="p2">'.number_format($vatablesale, 2).'</td>
<td style="text-align: right; font-size: 11px;" class="p2">'.number_format($scdiscount, 2).'</td>
</tr>
<tr>
<td style="text-align: right; font-size: 11px;" class="p2">'.number_format($VATexemptsale, 2).'</td>
<td style="text-align: right; font-size: 11px;" class="p2">'.number_format($totaldue, 2).'</td>
</tr>
<tr>
<td style="text-align: right; font-size: 11px;" class="p2">'.number_format(0, 2).'</td>
<td style="text-align: right; font-size: 11px;" class="p2">'.number_format(0, 2).'</td>
</tr>
<tr>
<td style="text-align: right; font-size: 11px;" class="p2">'.number_format($vatableamount, 2).'</td>
<td style="text-align: right; font-size: 11px;" class="p2">'.number_format($totaldue, 2).'</td>
</tr>
</td>
</table>
<p align="right" style="font-size: 12px;" class="p2"><b>'.number_format($totaldue, 2).'</b></p>
';

$html .= '</td></tr></table>';
// Load the HTML into the renderer
$dompdf->loadHtml($html);

// Set the paper size and orientation
$dompdf->setPaper('Letter', 'portrait');
//$dompdf->setPaper([0,0,612,1008], 'portrait');

// Render the PDF
$dompdf->render();

// Output the generated PDF to the browser
$dompdf->stream('Cash Invoice.pdf', array('Attachment' => false));
?>
