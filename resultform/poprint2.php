<?php
require_once('../tcpdf/tcpdf.php');


// create new PDF document
$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('PhilHealth Corp.');
$pdf->SetTitle('CF3: Report');
$pdf->SetSubject('CF3: Report');
$pdf->setPrintHeader(false);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetFont('dejavusans', '', 8);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->AddPage();



include "../mainpage/class.php";
$caseno=$_GET['caseno'];
$refno=$_GET['refno'];

$sql222 = $conn->query("SELECT * FROM productout where caseno='$caseno' and refno='$refno'");
while($row222 = $sql222->fetch_assoc()) { 
$approvalno=$row222['approvalno'];
$referenceno=$row222['referenceno'];
list($user, $filmno) = explode('_', $approvalno);
}

$sql2222 = $conn->query("SELECT * FROM admission where caseno='$caseno'");
while($row2222 = $sql2222->fetch_assoc()){ 
$room=$row2222['room'];
$patientidno=$row2222['patientidno'];
$ap=$row2222['ap'];
$street=$row2222['street'];
$barangay=$row2222['barangay'];
$municipality=$row2222['municipality'];
$province=$row2222['province'];
$address22=$street." ".$barangay." ".$municipality.", ".$province;
}

$sql2222x = $conncf4->query("SELECT * FROM pepert where caseno='$caseno'");
while($row2222x = $sql2222x->fetch_assoc()){ 
$height=$row2222x['pHeight'];
$weight=$row2222x['pWeight'];
}

$sql3 = $conn->query("SELECT * from patientprofile where patientidno='$patientidno'");
if(mysqli_num_rows($sql3)==0){$sql3 = $conn->query("SELECT concat(lastname,' ',firstname,' ',middlename) as patientname, birthdate, age, age as senior, gender as sex from nsauthemployees where empid='$patientidno'");}
while($row3 = $sql3->fetch_assoc()){ 
$age=$row3['age'];
$sex=$row3['sex'];
$name=$row3['patientname'];
if($sex=='M') {$sex='MALE';} elseif($sex=='F') {$sex='FEMALE';}
}

$sql33 = "SELECT * FROM xray1 where caseno='$caseno' and refno='$refno'";
$result33 = $conn->query($sql33);
while($row33 = $result33->fetch_assoc()) {
$validate=$row33['validate'];
$referredby=$row33['referredby'];
$interpretation=$row33['interpretation'];
$radiologist=$row33['radiologist'];
$partexamined=$row33['partexamined'];
$daterr=$row33['date'];
$filmno2=$row33['filmno'];
}

if($radiologist == "ELMA PACIFICO CONAHAP MD, DPBR, FCT-MRISP"){$sig ="1";}
if($radiologist == "APOLONIO S. BERNARDO MD, FPCR, FUSP, Fellow-CTMRI"){$sig ="2";}
if($radiologist == "ELMA P. PACIFICO-CONAHAP MD, DPBR, FCT-MRISP"){$sig ="3";}

$report1 = '
<table Style="width: 100%;" align="center">
<tr>
<td width="7%"><img src="../mainpage/img/logo/kmsci.png" width="50" height="auto"></td>
<td width="93%"><p align="center" style="font-size: 13px;"><b>'.$heading.'<br><small>'.$address.'<br>'.$telno.'</small></b></p></td>
</tr>
</table>

<br><br>

<table style="border-collapse: collapse;" width="100%">

<tr>
<td style="font-size:11px;" width="15%">FILM NO:</td>
<td style="border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;" width="35%">'.$filmno.'</td>
<td style="font-size:11px;" width="15%">&nbsp;&nbsp;&nbsp;DATE:</td>
<td style="border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;" width="35%">'.$daterr.'</td>
</tr>


<tr>
<td style="font-size:11px;">CASENO:</td>
<td style="border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;">'.$caseno.'</td>
<td style="font-size:11px;">&nbsp;&nbsp;&nbsp;ROOM:</td>
<td style="border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;">'.$room.'</td>
</tr>

<tr>
<td style="font-size:11px;">NAME:</td>
<td style="border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;">'.$name.'</td>
<td style="font-size:11px;">&nbsp;&nbsp;&nbsp;AGE/SEX:</td>
<td style="border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;">'.$age.'/'.$sex.'</td>
</tr>

<tr>
<td style="font-size:11px;">REFERED BY:</td>
<td style="border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px">'.$ap.'</td>
<td style="font-size:11px;">&nbsp;&nbsp;&nbsp;EXAMINATION:</td>
<td style="border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px">'.$partexamined.'</td>
</tr>

<tr>
<th style="font-size:11px;"><p align="left">ADDRESS:</p></th>
<td style="border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px" colspan="3">'.$address22.'</td>
</tr>

<tr>
<th style="font-size:11px;"><p align="left">COMPLAINT: </p></th>
<td style="border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px" colspan="3">N/A</td>
</tr>
</table>


<br><hr>

<p></p>

<table width="100%" style="border-collapse: collapse;">
<tr>
<td align="center" style="font-size: 15px;"><b> RADIOGRAPHY RESULT</b></td>
</tr>
</table>

<br>
<table border="1" class="tablex"><tr><td>
<div style="font-size: 14px; font-family: Arial, Helvetica, sans-serif; border: none; text-align: justify; height: 1000px;">'.$interpretation.'</div>
</td></tr></table>
<table>
<tr><th style="border-bottom: solid 1px black;"></th></tr>

<tr>
<!--td style="text-align: center; background-image:url(http://'.$ip.'/arv2022/radiology/signature/'.$sig.'.png);background-repeat:no-repeat;background-size:450px 130px; background-position: center;"-->
<br>
<b>'.$radiologist.'</b><br>
Radiologist<br>
Lic. No.  <br>
Electronically Signed <br>
</p>
</td>
</tr>
<tr>
<th style="border-bottom: solid 1px black;"></th>
</tr>
<tr>
<td><b><font color="black" size="1">DISCLAIMER:</b> These findings ar based on radiological imaging studies. It must be correlated with clinical, laboratory, and other ancillary procedures for a comprehensive assesment of patient"s condition. Thus, radiology reports are best explained  by the attending  physician to the patient.</td>
</tr>
<tr>
<td><br><b><font color="black" size="1">RAD TECH:$validate</b></td>
</tr>

</table>
';

$pdf->writeHTML($report1, true, false, true, false, '');
$pdf->lastPage();
ob_end_clean();
$pdf->Output($pdf_name, 'I');
?>
