<style>
.A4 {
  background: white;
  width: 21.59cm;
  height: 27.94cm;
  display: block;
  margin: 0 auto;
  padding: 10px 25px;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
  overflow-y: scroll;
  box-sizing: border-box;
}

@media print {
  @page {
     size: 8.5in 11in landscape;
  }
}


@media print {
  body {
    margin: 0;
    padding: 0;
  }

  .A4 {
    box-shadow: none;
  }

  .noprint {
    display: none;
  }

  .enable-print {
    display: block;
  }
}

</style>

<?php
ob_start();
$caseno=$_GET['caseno'];
$refno=$_GET['refno'];
include '../main/class.php';

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
if($filmno==""){$filmno = $filmno2;}


if($radiologist == "ELMA PACIFICO CONAHAP MD, DPBR, FCT-MRISP"){$sig ="1";}
if($radiologist == "APOLONIO S. BERNARDO MD, FPCR, FUSP, Fellow-CTMRI"){$sig ="2";}
if($radiologist == "ELMA P. PACIFICO-CONAHAP MD, DPBR, FCT-MRISP"){$sig ="3";}

$interpretation=nl2br($interpretation);
echo "
<div width='730' align='center' class='A4'><br>
<table align='center'  style='border-collapse: collapse;' border='0' width='100%'>
<tr><td>

<table width='100%' align='center'>
<tr>
<td width='7%'><img src='http://$ip/ERP/main/img/logo/mmshi.png' width='50' height='auto'></td>
<td><p align='center'><b>$heading<br><font size='1%'>$address<br>$telno</font></b></p></td>
</tr>
</table>

</td></tr>
<tr><td>

<br>

<table width='100%' style='border-collapse: collapse;' border='0'>
<tr><td colspan='4' style='font-weight:bold' align='center'></td></tr>

<tr>
<td style='font-size:11px;'>FILM NO:</td>
<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;'>$filmno</td>
<td style='font-size:11px;'>&nbsp;&nbsp;&nbsp;DATE:</td>
<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;'>$daterr</td>
</tr>

<tr>
<td style='font-size:11px;'>CASENO:</td>
<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;'>$caseno</td>
<td style='font-size:11px;'>&nbsp;&nbsp;&nbsp;ROOM:</td>
<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;'>$room</td>
</tr>

<tr>
<td style='font-size:11px;'>NAME:</td>
<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;'>$name</td>
<td style='font-size:11px;'>&nbsp;&nbsp;&nbsp;AGE/SEX:</td>
<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px;'>$age/$sex</td>
</tr>

<tr>
<td style='font-size:11px;'>REFERED BY:</td>
<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px'>$ap</td>
<td style='font-size:11px;'>&nbsp;&nbsp;&nbsp;EXAMINATION:</td>
<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px'>$partexamined</td>
</tr>

<tr>
<th style='font-size:11px;'><p align='left'>ADDRESS:</p></th>
<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px' colspan='3'>$address22</td>
</tr>

<tr>
<th style='font-size:11px;'><p align='left'>COMPLAINT: </p></th>
<td style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px' colspan='3'>N/A</td>
</tr>
</table>

			
<table width='100%'>
<tr>
<td style='font-size:11px; width: 10%;'><p align='left'>HEIGHT: </p></td>
<th style=' width: 15%; font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px'><p align='left'>$height cm/ft</p></th>
<td style='font-size:11px; width: 10%;'><p align='left'>WEIGHT: </p></td>
<th style=' width: 15%; font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px'><p align='left'>$weight kg</p></th>
<td style='font-size:11px; width: 5%;'><p align='left'>BSA: </p></td>
<th style='font-weight:bold;border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;font-size:11px''><p align='left'>$bsa</p></th>
</tr>
</table>


</td></tr>
<tr><td>

<br><table width='100%' style='border-collapse: collapse;'>
<tr>
<td align='center'><b> RADIOGRAPHY RESULT</b></td>
</tr>
</table>

</td></tr>

<tr><td style='text-align: center;'>

<br><font color='black'>
<div style='font-size: 14px; font-family: Arial, Helvetica, sans-serif; border: none; text-align: justify; resize: none; height: 580px;' readonly>$interpretation</div>
</font>

</td></tr>
<tr><th style='border-bottom: solid 1px black;'></th></tr>

<tr>
<td style='text-align: center; background-image:url(http://$ip/ERP/resultform/signature/$sig.png);background-repeat:no-repeat;background-size:450px 130px; background-position: center;'>
<br>
<b><font size='1'>$radiologist</b><br>
Radiologist<br>
Lic. No.  <br>
Electronically Signed <br>
</p>
</td>
</tr>
<tr>
<th style='border-bottom: solid 1px black;'></th>
</tr>
<tr>
<td><b><font color='black' size='1'>DISCLAIMER:</b> These findings ar based on radiological imaging studies. It must be correlated with clinical, laboratory, and other ancillary procedures for a comprehensive assesment of patient's condition. Thus, radiology reports are best explained  by the attending  physician to the patient.</td>
</tr>
<tr>
<td><br><b><font color='black' size='1'>RAD TECH:$validate</b></td>
</tr>

</table>
</div>
";
//$html = ob_get_clean();
//file_put_contents('my_page.html', $html);
?>


</body>
</html>
