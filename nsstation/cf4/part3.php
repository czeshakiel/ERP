<style>
.ribbon-2 {
  --f: 10px; /* control the folded part*/
  --r: 15px; /* control the ribbon shape */
  --t: 10px; /* the top offset */
  
  position: absolute;
  inset: var(--t) calc(-1*var(--f)) auto auto;
  padding: 0 30px var(--f) calc(30px + var(--r));
  clip-path: 
    polygon(0 0,100% 0,100% calc(100% - var(--f)),calc(100% - var(--f)) 100%,
      calc(100% - var(--f)) calc(100% - var(--f)),0 calc(100% - var(--f)),
      var(--r) calc(50% - var(--f)/2));
  background: #BD1550;
  box-shadow: 0 calc(-1*var(--f)) 0 inset #0005;
  color: white;
  font-size: 18px;
}
</style>

<?php
if(isset($_POST['btnsave'])){

$heent = $_POST['heent'];
$heentother = $_POST['heentother'];
$countheent = count($heent);

$chest = $_POST['chest'];
$chestother = $_POST['chestother'];
$countchest = count($chest);

$cvs = $_POST['cvs'];
$cvsother = $_POST['cvsother'];
$countcvs = count($cvs);

$abdomen = $_POST['abdomen'];
$abdomenother = $_POST['abdomenother'];
$countabdomen = count($abdomen);

$gu = $_POST['gu'];
$guother = $_POST['guother'];
$countgu = count($gu);

$skin = $_POST['skin'];
$skinother = $_POST['skinother'];
$countskin = count($skin);

$neuro = $_POST['neuro'];
$neuroother = $_POST['neuroother'];
$countneuro = count($neuro);

if($countheent<=0){echo"<script>alert('Please select atleast 1 Heent!'); window.history.back();</script>"; exit;}
elseif($countchest<=0){echo"<script>alert('Please select atleast 1 Chest!'); window.history.back();</script>"; exit;}
elseif($countcvs<=0){echo"<script>alert('Please select atleast 1 Heart!'); window.history.back();</script>"; exit;}
elseif($countabdomen<=0){echo"<script>alert('Please select atleast 1 Abdomen!'); window.history.back();</script>"; exit;}
elseif($countgu<=0){echo"<script>alert('Please select atleast 1 GU!'); window.history.back();</script>"; exit;}
elseif($countskin<=0){echo"<script>alert('Please select atleast 1 Skin!'); window.history.back();</script>"; exit;}
elseif($countneuro<=0){echo"<script>alert('Please select atleast 1 Neuro!'); window.history.back();</script>"; exit;}
else{

$sqln = "delete from pemisc where caseno='$caseno'";
if($conncf4->query($sqln) === TRUE) {}

for($i=0; $i<$countheent; $i++){
$sqln = "insert into pemisc (pHeentId, pReportStatus, caseno) values ('$heent[$i]', 'U', '$caseno')";
if($conncf4->query($sqln) === TRUE) {}
}

for($i=0; $i<$countchest; $i++){
$sqln = "insert into pemisc (pChestId, pReportStatus, caseno) values ('$chest[$i]', 'U', '$caseno')";
if($conncf4->query($sqln) === TRUE) {}
}

for($i=0; $i<$countcvs; $i++){
$sqln = "insert into pemisc (pheartId, pReportStatus, caseno) values ('$cvs[$i]', 'U', '$caseno')";
if($conncf4->query($sqln) === TRUE) {}
}

for($i=0; $i<$countabdomen; $i++){
$sqln = "insert into pemisc (pAbdomenId, pReportStatus, caseno) values ('$abdomen[$i]', 'U', '$caseno')";
if($conncf4->query($sqln) === TRUE) {}
}

for($i=0; $i<$countgu; $i++){
$sqln = "insert into pemisc (pGuId, pReportStatus, caseno) values ('$gu[$i]', 'U', '$caseno')";
if($conncf4->query($sqln) === TRUE) {}
}

for($i=0; $i<$countskin; $i++){
$sqln = "insert into pemisc (pSkinId, pReportStatus, caseno) values ('$skin[$i]', 'U', '$caseno')";
if($conncf4->query($sqln) === TRUE) {}
}

for($i=0; $i<$countneuro; $i++){
$sqln = "insert into pemisc (pNeuroId, pReportStatus, caseno) values ('$neuro[$i]', 'U', '$caseno')";
if($conncf4->query($sqln) === TRUE) {}
}

}
$sqln = "delete from pespecific where caseno='$caseno'";
if($conncf4->query($sqln) === TRUE) {}

$sqln1 = "INSERT INTO `pespecific`(`pSkinRem`, `pHeentRem`, `pChestRem`, `pHeartRem`, `pAbdomenRem`, `pNeuroRem`, `pRectalRem`, `pGuRem`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`)
VALUES ('$skinother', '$heentother', '$chestother', '$cvsother', '$abdomenother', '$neuroother', '', '$guother', 'U', '', '$caseno')";
if($conncf4->query($sqln1) === TRUE) {}

// ---------------------------- PEPERT ------------------
$bp1 = $_POST['bp1'];
$bp2 = $_POST['bp2'];
$hr = $_POST['hr'];
$rr = $_POST['rr'];
$temp = $_POST['temp'];
$height = $_POST['height'];
$weight = $_POST['weight'];

$sqln = "delete from pepert where caseno='$caseno'";
if($conncf4->query($sqln) === TRUE) {}

$sqln1 = "INSERT INTO `pepert`(`pSystolic`, `pDiastolic`, `pHr`, `pRr`, `pTemp`, `pHeight`, `pWeight`, `pVision`, `pLength`, `pHeadCirc`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES
('$bp1', '$bp2', '$hr', '$rr', '$temp', '$height', '$weight', '', '', '', 'U', '', '$caseno')";
if($conncf4->query($sqln1) === TRUE) {}
// ------------------------- END PEPERT ------------------

// ---------------------------- PEGENSURVEY ------------------
$pGenSurvey = $_POST['pGenSurvey'];
$pGenSurveyRemarks = $_POST['pGenSurveyRemarks'];
if($pGenSurvey=="1"){$pGenSurveyRemarks="";}

$sqln = "delete from pegensurvey where caseno='$caseno'";
if($conncf4->query($sqln) === TRUE) {}

$sqln = "INSERT INTO `pegensurvey`(`pGenSurveyId`, `pGenSurveyRem`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('$pGenSurvey', '$pGenSurveyRemarks', 'U', '', '$caseno')";
if($conncf4->query($sqln) === TRUE) {}
// ------------------------- END PEGENSURVEY ------------------

echo"
<script type='text/javascript'>
swal({
icon: 'success',
title: 'Update Entries!',
text: 'PERTINENT FINDINGS PER SYSTEM',
type: 'error',
button: false
});
setTimeout(function(){window.location.href = '?detail&caseno=$caseno$datax';}, 2000);
</script>";

//echo"<script>alert('PERTINENT FINDINGS PER SYSTEM IS SUCCESSFULLY UPDATED!'); window.location='index.php?detail&caseno=$caseno$datax';</script>";
}


$sql = "SELECT * FROM pepert WHERE caseno='$caseno'";
$result = $conncf4->query($sql);
while($row = $result->fetch_assoc()){
$bps1=$row['pSystolic'];
$bps2=$row['pDiastolic'];
$temp=$row['pTemp'];
$respiratoryrate=$row['pRr'];
$heartrate=$row['pHr'];
$height=$row['pHeight'];
$weight=$row['pWeight'];
}

$sqln = "SELECT pGenSurveyId, pGenSurveyRem FROM `pegensurvey` WHERE caseno='$caseno'";
$resultn = $conncf4->query($sqln);
while($aefetch = $resultn->fetch_assoc()){
$pGenSurveyId=$aefetch['pGenSurveyId'];
$pGenSurveyRem=$aefetch['pGenSurveyRem'];
}
if($pGenSurveyId=="1"){$gsa="checked='checked'";$gsb="";$gsval="";}else{$gsa="";$gsb="checked='checked'";$gsval=$pGenSurveyRem;}

$sql2 = "SELECT * FROM admission, patientprofile where admission.patientidno=patientprofile.patientidno and caseno='$caseno'";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$initialdx=$row2['initialdiagnosis'];
$patientidno=$row2['patientidno'];
$sex=$row2['sex'];
if($sex=="F"){$sex="FEMALE"; $avat = "female";}
else{$sex="MALE"; $avat = "male";}
$age=$row2['age'];
$birthdate=date("m/d/Y", strtotime($row2['dateofbirth']));
$senior=$row2['senior'];
$lastname=$row2['lastname'];
$firstname=$row2['firstname'];
$middlename=$row2['middlename'];
$suffix=$row2['suffix'];
$ptype=strtoupper($row2["paymentmode"]);
$namearray = "$lastname".",  "."$firstname"."  "."$middlename";

$bp=$row2["bp"];
$tempx=strtoupper($row2["temp"]);
$patientadmitx=$row2["patientadmit"];
$heightx=$row2["height"];
$weightx=$row2["weight"];
list($bp1, $bp2) = explode("/", $bp);
}

$addinfo = $conn->query("SELECT * FROM `admissionaddinfo` WHERE caseno='$caseno'");
while($adin = $addinfo->fetch_assoc()){
$respiratoryratex = $adin['respiratoryrate'];
$heartratex = $adin['heartrate'];
}

if(mysqli_num_rows($result)==0){
$bps1 = $bp1;
$bps2 = $bp2;
$temp=$tempx;
$respiratoryrate=$respiratoryratex;
$heartrate=$heartratex;
$height=$heightx;
$weight=$weightx;
}
?>

<html>
<body onload="loadall();">
<form method="POST">

<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?detail&caseno=<?php echo $caseno ?>">Patient Information</a></li>
<li class="breadcrumb-item"><a href="?otherinfo&caseno=<?php echo $caseno ?>">CF4 Additional Information</a></li>
<li class="breadcrumb-item"><a href="?part2&caseno=<?php echo $caseno ?>">Pertinent Sign & Symptoms on Admission</a></li>
<li class="breadcrumb-item"><a href="?part3&caseno=<?php echo $caseno ?>">Pertinent Findings per System</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">
<p><b><i class="bi bi-file-earmark-medical"></i> CF4 PART 3 <font size="1">[ <?php echo $caseno." - ".$namearray ?> ]</font></b></p><hr>

<?php
echo"
<table width='100%'><tr><td>
<div class='card teacher-card  mb-3' style='box-shadow: 0px 0px 0px 1px lightgrey;'>
<div class='ribbon-2'><i class='icofont-patient-file'></i> VITAL SIGN AND GENERAL SURVEY</div>
<div class='card-body  d-flex teacher-fulldeatil'>
<div class='profile-teacher pe-xl-4 pe-md-2 pe-sm-4 pe-0 text-center w220 mx-sm-0 mx-auto'>
<a href='#'>
<img src='../main/assets/images/lg/avatar3.jpg' alt='' class='avatar xl rounded-circle img-thumbnail shadow-sm'>
</a>
<div class='about-info d-flex align-items-center mt-3 justify-content-center flex-column'>
<h6 class='mb-0 fw-bold d-block fs-6'>$caseno</h6>
<span class='text-muted small'>$namearray</span>
</div>
</div>
<div class='teacher-info border-start ps-xl-4 ps-md-3 ps-sm-4 ps-4 w-100'>
<br><br>

<table width='100%' align='center'>
<tr>
<td width='33%' style='font-size: 11px;'>BP:<br>
<input type='text' name='bp1' id='bp1' value='$bps1' style='height:30px; width: 30%; font-size:10pt; padding: 0px; color: black; text-align: center;'> <font class='font4'>/
<input type='text' name='bp2' id='bp2' value='$bps2' style='height:30px; width: 30%; font-size:10pt; padding: 0px; color: black; text-align: center;'> <font class='font4'>mmHg
</td>
<td  width='34%' style='font-size: 11px;'>HR:<br>
<input type='text' name='hr' id='hr' value='$heartrate' style='height:30px; width: 40%; font-size:10pt; padding: 0px; color: black; text-align: center;'> <font class='font4'>/min</td>
<td  width='33%' style='font-size: 11px;'>RR:<br>
<input type='text' name='rr' id='rr' value='$respiratoryrate' style='height:30px; width: 40%; font-size:10pt; padding: 0px; color: black; text-align: center;'> <font class='font4'>/min</td>
</tr><tr>
<td style='font-size: 11px;'>Temp:<br>
<input type='text' name='temp' id='temp' value='$temp' style='height:30px; width: 40%; font-size:10pt; padding: 0px; color: black; text-align: center;'> <font class='font4'>°C</td>
<td style='font-size: 11px;'>Height:<br>
<input type='text' name='height' id='height' value='$height' style='height:30px; width: 40%; font-size:10pt; padding: 0px; color: black; text-align: center;'>
<font class='font4' color='red'><a onclick='convertcm()' style='cursor: pointer;'>/<b>cm</b></a> <font size='1'><i class='icofont-arrow-left'></i> click here to convert ft to cm</font>
</td>
<td style='font-size: 11px;'>Weight:<br>
<input type='text' name='weight' id='weight' value='$weight' style='height:30px; width: 40%; font-size:10pt; padding: 0px; color: black; text-align: center;'> <font class='font4'>/kg</td>
</tr>
</table>

<hr>
<table width='100%' align='center'>
<tr>
<td width='12%' valign='TOP' style='font-size: 11px;'><b>General Survey:</b></td>
<td width='15%'>
<input type='radio' name='pGenSurvey' value='1' id='pGenSurvey_1' $gsa onclick='setDisabled(this.value)'>
<label for='pGenSurvey_1' style='font-size: 11px;'>Awake and alert</label>
</td>
<td width='15%'>
<input type='radio' name='pGenSurvey' value='2' id='pGenSurvey_2' $gsb onclick='setDisabled(this.value)'>
<label for='pGenSurvey_2' style='font-size: 11px;'>Altered Sensorium</label>
</td>
</tr><tr>
<td colspan='3'>
<input type='text' name='pGenSurveyRemarks' value='$gsval' id='pGenSurveyRem' style='height:30px; width: 100%; font-size:10pt; padding: 0px; display: none;'/>
</td>
</tr>
</table>

</div>
</div>
</div>

</td></tr><tr><td valign='TOP'>
<h6 class='light-primary-bg py-1 px-2 rounded-1 d-inline-block fw-bold small-14 mb-0'><i class='icofont-patient-file'></i> PERTINENT FINDINGS PER SYSTEM</h6><br><br>

";
// ---------------------------> HEENT <-----------------------------
echo"
<div class='card' style='box-shadow: 0px 0px 0px 1px lightgrey;'>
<div class='card-body'>
<div class='d-flex align-items-center justify-content-between mt-5'>
<div class='lesson_name'>
<div class='project-block light-danger-bg'>
<i class='icofont-listening'></i>
</div>
<span class='small text-muted project_name fw-bold'> A. HEENT </span>
</div>
</div>
<table width='100%' align='center'><tr>
";
$i = 1;
$sql222 = "SELECT * FROM pespecific WHERE caseno='$caseno' and pHeentRem!=''";
$result222 = $conncf4->query($sql222);
$countheent = mysqli_num_rows($result222);
while($row222 = $result222->fetch_assoc()) {$pHeentRem = $row222['pHeentRem'];}

$heentnum = 0;
$sql2 = "SELECT * FROM tsekap_lib_heent WHERE LIB_STAT='1' ORDER BY SORT_NO ASC";
$result2 = $connepcb->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$HEENT_ID = $row2['HEENT_ID'];
$HEENT_DESC = $row2['HEENT_DESC'];
$heentnum++;

$sql22 = "SELECT * FROM pemisc WHERE caseno='$caseno' and pHeentId='$HEENT_ID'";
$result22 = $conncf4->query($sql22);
while($row22 = $result22->fetch_assoc()) {$pHeentId = $row22['pHeentId'];}

if($HEENT_ID == $pHeentId){$checked = "checked";}else{$checked = "";}

echo"<td width='25%' style='font-size: 12px;'><input type='checkbox' style='transform : scale(1.3);' name='heent[]' value='$HEENT_ID' id='heent$heentnum' onclick='loadheent()' $checked> $HEENT_DESC</td>";
if($i<4){$i++;}else{echo"</tr>"; $i=1;}
}
echo"</table>";
echo"<div id='divheent' style='display: none;'>
<table width='100%' align='center'><tr><td>

<textarea placeholder=' &#x1F449; If Others, Please Specify..' name='heentother' id='heentother' class='form-control' onkeydown='if(event.keyCode == 13){return false;}'>$pHeentRem</textarea>
</td></tr></table></div>";

if($countheent>0){echo"<script>document.getElementById('heent$heentnum').checked = true;</script>";}
// ------------------------> END HEENT <-----------------------------

echo"</div></div><br><br>";

// ---------------------------> CHEST <-----------------------------
echo"
<div class='card' style='box-shadow: 0px 0px 0px 1px lightgrey;'>
<div class='card-body'>
<div class='d-flex align-items-center justify-content-between mt-5'>
<div class='lesson_name'>
<div class='project-block light-info-bg'>
<i class='icofont-lungs'></i>
</div>
<span class='small text-muted project_name fw-bold'> B. CHEST/ LUNGS </span>
</div>
</div>
<table width='100%' align='center'><tr>";
$i = 1;
$sql222 = "SELECT * FROM pespecific WHERE caseno='$caseno' and pChestRem!=''";
$result222 = $conncf4->query($sql222);
$countchest = mysqli_num_rows($result222);
while($row222 = $result222->fetch_assoc()) {$pChestRem = $row222['pChestRem'];}

$chestnum = 0;
$sql2 = "SELECT * FROM tsekap_lib_chest WHERE LIB_STAT='1' ORDER BY SORT_NO ASC";
$result2 = $connepcb->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$CHEST_ID = $row2['CHEST_ID'];
$CHEST_DESC = $row2['CHEST_DESC'];
$chestnum++;

$sql22 = "SELECT * FROM pemisc WHERE caseno='$caseno' and pChestId='$CHEST_ID'";
$result22 = $conncf4->query($sql22);
while($row22 = $result22->fetch_assoc()) {$pChestId = $row22['pChestId'];}

if($CHEST_ID == $pChestId){$checked = "checked";}else{$checked = "";}

echo"<td width='25%' style='font-size: 12px;'><input type='checkbox' style='transform : scale(1.3);' name='chest[]' value='$CHEST_ID' id='chest$chestnum' onclick='loadchest()' $checked> $CHEST_DESC</td>";
if($i<4){$i++;}else{echo"</tr>"; $i=1;}
}
echo"</table>";
echo"<div id='divchest' style='display: none;'>
<table width='100%' align='center'><tr><td>

<textarea placeholder=' &#x1F449; If Others, Please Specify..' name='chestother' id='chestother' class='form-control' onkeydown='if(event.keyCode == 13){return false;}'>$pChestRem</textarea>
</td></tr></table></div>";

if($countchest>0){echo"<script>document.getElementById('chest$chestnum').checked = true;</script>";}
// ------------------------> END CHEST <-----------------------------

echo"</div></div><br><br>";

// ---------------------------> CVS <-----------------------------
echo"
<div class='card' style='box-shadow: 0px 0px 0px 1px lightgrey;'>
<div class='card-body'>
<div class='d-flex align-items-center justify-content-between mt-5'>
<div class='lesson_name'>
<div class='project-block light-warning-bg'>
<i class='icofont-heart-beat-alt'></i>
</div>
<span class='small text-muted project_name fw-bold'> C. CVS </span>
</div>
</div>
<table width='100%' align='center'><tr>
";
$i = 1;
$sql222 = "SELECT * FROM pespecific WHERE caseno='$caseno' and pHeartRem!=''";
$result222 = $conncf4->query($sql222);
$countheart = mysqli_num_rows($result222);
while($row222 = $result222->fetch_assoc()) {$pHeartRem = $row222['pHeartRem'];}

$cvsnum = 0;
$sql2 = "SELECT * FROM tsekap_lib_heart WHERE LIB_STAT='1' ORDER BY SORT_NO ASC";
$result2 = $connepcb->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$HEART_ID = $row2['HEART_ID'];
$HEART_DESC = $row2['HEART_DESC'];
$cvsnum++;

$sql22 = "SELECT * FROM pemisc WHERE caseno='$caseno' and pHeartId='$HEART_ID'";
$result22 = $conncf4->query($sql22);
while($row22 = $result22->fetch_assoc()) {$pHeartId = $row22['pHeartId'];}

if($HEART_ID == $pHeartId){$checked = "checked";}else{$checked = "";}

echo"<td width='25%' style='font-size: 12px;'><input type='checkbox' style='transform : scale(1.3);' name='cvs[]' value='$HEART_ID' id='cvs$cvsnum' onclick='loadheart()' $checked> $HEART_DESC</td>";
if($i<4){$i++;}else{echo"</tr>"; $i=1;}
}
echo"</table>";
echo"<div id='divcvs' style='display: none;'>
<table width='100%' align='center'><tr><td>

<textarea placeholder=' &#x1F449; If Others, Please Specify..' name='cvsother' id='cvsother' class='form-control' onkeydown='if(event.keyCode == 13){return false;}'>$pHeartRem</textarea>
</td></tr></table></div>";

if($countheart>0){echo"<script>document.getElementById('cvs$cvsnum').checked = true;</script>";}
// ------------------------> END CVS <-----------------------------

echo"</div></div><br><br>";

// ---------------------------> ABDOMEN <-----------------------------
echo"
<div class='card' style='box-shadow: 0px 0px 0px 1px lightgrey;'>
<div class='card-body'>
<div class='d-flex align-items-center justify-content-between mt-5'>
<div class='lesson_name'>
<div class='project-block light-success-bg'>
<i class='icofont-paralysis-disability'></i>
</div>
<span class='small text-muted project_name fw-bold'> D. ABDOMEN </span>
</div>
</div>
<table width='100%' align='center'><tr>
";
$i = 1;
$sql222 = "SELECT * FROM pespecific WHERE caseno='$caseno' and pAbdomenRem!=''";
$result222 = $conncf4->query($sql222);
$countabdomen = mysqli_num_rows($result222);
while($row222 = $result222->fetch_assoc()) {$pAbdomenRem = $row222['pAbdomenRem'];}

$abdomennum = 0;
$sql2 = "SELECT * FROM tsekap_lib_abdomen WHERE LIB_STAT='1' ORDER BY SORT_NO ASC";
$result2 = $connepcb->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$ABDOMEN_ID = $row2['ABDOMEN_ID'];
$ABDOMEN_DESC = $row2['ABDOMEN_DESC'];
$abdomennum++;

$sql22 = "SELECT * FROM pemisc WHERE caseno='$caseno' and pAbdomenId='$ABDOMEN_ID'";
$result22 = $conncf4->query($sql22);
while($row22 = $result22->fetch_assoc()) {$pAbdomenId = $row22['pAbdomenId'];}

if($ABDOMEN_ID == $pAbdomenId){$checked = "checked";}else{$checked = "";}

echo"<td width='25%' style='font-size: 12px;'><input type='checkbox' style='transform : scale(1.3);' name='abdomen[]' value='$ABDOMEN_ID' id='abdomen$abdomennum' onclick='loadabdomen()' $checked> $ABDOMEN_DESC</td>";
if($i<4){$i++;}else{echo"</tr>"; $i=1;}
}
echo"</table>";
echo"<div id='divabdomen' style='display: none;'>
<table width='100%' align='center'><tr><td>

<textarea placeholder=' &#x1F449; If Others, Please Specify..' name='abdomenother' id='abdomenother' class='form-control' onkeydown='if(event.keyCode == 13){return false;}'>$pAbdomenRem</textarea>
</td></tr></table></div>";

if($countabdomen>0){echo"<script>document.getElementById('abdomen$abdomennum').checked = true;</script>";}
// ------------------------> END ABDOMEN <-----------------------------

echo"</div></div><br><br>";

// ---------------------------> GU (IE) <-----------------------------
echo"
<div class='card' style='box-shadow: 0px 0px 0px 1px lightgrey;'>
<div class='card-body'>
<div class='d-flex align-items-center justify-content-between mt-5'>
<div class='lesson_name'>
<div class='project-block light-danger-bg'>
<i class='icofont-nurse'></i>
</div>
<span class='small text-muted project_name fw-bold'> E. GU (IE) </span>
</div>
</div>
<table width='100%' align='center'><tr>";
$i = 1;
$sql222 = "SELECT * FROM pespecific WHERE caseno='$caseno' and pGuRem!=''";
$result222 = $conncf4->query($sql222);
$countgu = mysqli_num_rows($result222);
while($row222 = $result222->fetch_assoc()) {$pGuRem = $row222['pGuRem'];}

$gunum = 0;
$sql2 = "SELECT * FROM tsekap_lib_genitourinary WHERE LIB_STAT='1' ORDER BY SORT_NO ASC";
$result2 = $connepcb->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$GU_ID = $row2['GU_ID'];
$GU_DESC = $row2['GU_DESC'];
$gunum++;

$sql22 = "SELECT * FROM pemisc WHERE caseno='$caseno' and pGuId='$GU_ID'";
$result22 = $conncf4->query($sql22);
while($row22 = $result22->fetch_assoc()) {$pGuId = $row22['pGuId'];}

if($GU_ID == $pGuId){$checked = "checked";}else{$checked = "";}

echo"<td width='25%' style='font-size: 12px;'><input type='checkbox' style='transform : scale(1.3);' name='gu[]' value='$GU_ID' id='gu$gunum' onclick='loadgu()' $checked> $GU_DESC</td>";
if($i<4){$i++;}else{echo"</tr>"; $i=1;}
}
echo"</table>";
echo"<div id='divgu' style='display: none;'>
<table width='100%' align='center'><tr><td>

<textarea placeholder=' &#x1F449; If Others, Please Specify..' name='guother' id='guother' class='form-control' onkeydown='if(event.keyCode == 13){return false;}'>$pGuRem</textarea>
</td></tr></table></div>";
if($countgu>0){echo"<script>document.getElementById('gu$gunum').checked = true;</script>";}
// ------------------------> END GU (IE) <-----------------------------

echo"</div></div><br><br>";

// ---------------------------> Skin/Extremities <-----------------------------
echo"
<div class='card' style='box-shadow: 0px 0px 0px 1px lightgrey;'>
<div class='card-body'>
<div class='d-flex align-items-center justify-content-between mt-5'>
<div class='lesson_name'>
<div class='project-block light-warning-bg'>
<i class='icofont-patient-bed'></i>
</div>
<span class='small text-muted project_name fw-bold'> F. Skin/Extremities </span>
</div>
</div>
<table width='100%' align='center'><tr>
";
$i = 1;
$sql222 = "SELECT * FROM pespecific WHERE caseno='$caseno' and pSkinRem!=''";
$result222 = $conncf4->query($sql222);
$countskin = mysqli_num_rows($result222);
while($row222 = $result222->fetch_assoc()) {$pSkinRem = $row222['pSkinRem'];}

$SKINnum = 0;
$sql2 = "SELECT * FROM tsekap_lib_skin_extremities WHERE LIB_STAT='1' ORDER BY SORT_NO ASC";
$result2 = $connepcb->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$SKIN_ID = $row2['SKIN_ID'];
$SKIN_DESC = $row2['SKIN_DESC'];
$skinnum++;

$sql22 = "SELECT * FROM pemisc WHERE caseno='$caseno' and pSkinId='$SKIN_ID'";
$result22 = $conncf4->query($sql22);
while($row22 = $result22->fetch_assoc()) {$pSkinId = $row22['pSkinId'];}

if($SKIN_ID == $pSkinId){$checked = "checked";}else{$checked = "";}

echo"<td width='25%' style='font-size: 12px;'><input type='checkbox' style='transform : scale(1.3);' name='skin[]' value='$SKIN_ID' id='skin$skinnum' onclick='loadskin()' $checked> $SKIN_DESC</td>";
if($i<4){$i++;}else{echo"</tr>"; $i=1;}
}

echo"</table>";
echo"<div id='divskin' style='display: none;'>
<table width='100%' align='center'><tr><td>

<textarea placeholder=' &#x1F449; If Others, Please Specify..' name='skinother' id='skinother' class='form-control' onkeydown='if(event.keyCode == 13){return false;}'>$pSkinRem</textarea>
</td></tr></table></div>";
if($countskin>0){echo"<script>document.getElementById('skin$skinnum').checked = true;</script>";}
// ------------------------> END Skin/Extremities <-----------------------------

echo"</div></div><br><br>";

// ---------------------------> Neurological Examination <-----------------------------
echo"
<div class='card' style='box-shadow: 0px 0px 0px 1px lightgrey;'>
<div class='card-body'>
<div class='d-flex align-items-center justify-content-between mt-5'>
<div class='lesson_name'>
<div class='project-block light-primary-bg'>
<i class='icofont-medical-sign'></i>
</div>
<span class='small text-muted project_name fw-bold'> G. Neurological Examination </span>
</div>
</div>
<table width='100%' align='center'><tr>
";
$i = 1;
$sql222 = "SELECT * FROM pespecific WHERE caseno='$caseno' and pNeuroRem!=''";
$result222 = $conncf4->query($sql222);
$countneuro = mysqli_num_rows($result222);
while($row222 = $result222->fetch_assoc()) {$pNeuroRem = $row222['pNeuroRem'];}

$neuronum = 0;
$sql2 = "SELECT * FROM tsekap_lib_neuro WHERE LIB_STAT='1' ORDER BY SORT_NO ASC";
$result2 = $connepcb->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$NEURO_ID = $row2['NEURO_ID'];
$NEURO_DESC = $row2['NEURO_DESC'];
$neuronum++;

$sql22 = "SELECT * FROM pemisc WHERE caseno='$caseno' and pNeuroId='$NEURO_ID'";
$result22 = $conncf4->query($sql22);
while($row22 = $result22->fetch_assoc()) {$pNeuroId = $row22['pNeuroId'];}

if($NEURO_ID == $pNeuroId){$checked = "checked";}else{$checked = "";}

echo"<td width='25%' style='font-size: 12px;'><input type='checkbox' style='transform : scale(1.3);' name='neuro[]' value='$NEURO_ID' id='neuro$neuronum' onclick='loadneuro()' $checked> $NEURO_DESC</td>";
if($i<4){$i++;}else{echo"</tr>"; $i=1;}
}
echo"</table>";
echo"<div id='divneuro' style='display: none;'>
<table width='100%' align='center'><tr><td>

<textarea placeholder=' &#x1F449; If Others, Please Specify..' name='neuroother' id='neuroother' class='form-control' onkeydown='if(event.keyCode == 13){return false;}'>$pNeuroRem</textarea>
</td></tr></table></div>";
if($countneuro>0){echo"<script>document.getElementById('neuro$neuronum').checked = true;</script>";}
// ----------------------> END Neurological Examination <-----------------------------

echo"
</div></div>
</td></tr></table><hr>
";
echo"<p align='right'><button type='submit' class='btn btn-primary' name='btnsave' onclick='return validate()'> NEXT <i class='icofont-circled-right'></i></button></ip";
?>
</form>

</div>
</div>
</div>
</div>
</section>
</main>

<script>
function loadheent(){
if(document.getElementById("heent<?php echo $heentnum ?>").checked == true){
document.getElementById("divheent").style.display = "block";
document.getElementById("heentother").required = true;
}else{
document.getElementById("divheent").style.display = "none";
document.getElementById("heentother").required = false;
}

if(document.getElementById("heent1").checked == true){
for(i=2; i<="<?php echo $heentnum ?>"; i++){
document.getElementById("heent"+i).checked = false;
document.getElementById("heent"+i).disabled = true;
document.getElementById("divheent").style.display = "none";
document.getElementById("heentother").required = false;
}
}else{
for(i=2; i<="<?php echo $heentnum ?>"; i++){document.getElementById("heent"+i).disabled = false;}
}
}

function loadchest(){
if(document.getElementById("chest<?php echo $chestnum ?>").checked == true){
document.getElementById("divchest").style.display = "block";
document.getElementById("chestother").required = true;
}else{
document.getElementById("divchest").style.display = "none";
document.getElementById("chestother").required = false;
}

if(document.getElementById("chest1").checked == true){
for(i=2; i<="<?php echo $chestnum ?>"; i++){
document.getElementById("chest"+i).checked = false;
document.getElementById("chest"+i).disabled = true;
document.getElementById("divchest").style.display = "none";
document.getElementById("chestother").required = false;
}
}else{
for(i=2; i<="<?php echo $chestnum ?>"; i++){document.getElementById("chest"+i).disabled = false;}
}
}

function loadheart(){

if(document.getElementById("cvs<?php echo $cvsnum ?>").checked == true){
document.getElementById("divcvs").style.display = "block";
document.getElementById("cvsother").required = true;
}else{
document.getElementById("divcvs").style.display = "none";
document.getElementById("cvsother").required = false;
}

if(document.getElementById("cvs1").checked == true){
for(i=2; i<="<?php echo $cvsnum ?>"; i++){
document.getElementById("cvs"+i).checked = false;
document.getElementById("cvs"+i).disabled = true;
document.getElementById("divcvs").style.display = "none";
document.getElementById("cvsother").required = false;
}
}else{
for(i=2; i<="<?php echo $cvsnum ?>"; i++){document.getElementById("cvs"+i).disabled = false;}
}
}

function loadabdomen(){

if(document.getElementById("abdomen<?php echo $abdomennum ?>").checked == true){
document.getElementById("divabdomen").style.display = "block";
document.getElementById("abdomenother").required = true;
}else{
document.getElementById("divabdomen").style.display = "none";
document.getElementById("abdomenother").required = false;
}

if(document.getElementById("abdomen1").checked == true){
for(i=2; i<="<?php echo $abdomennum ?>"; i++){
document.getElementById("abdomen"+i).checked = false;
document.getElementById("abdomen"+i).disabled = true;
document.getElementById("divabdomen").style.display = "none";
document.getElementById("abdomenother").required = false;
}
}else{
for(i=2; i<="<?php echo $abdomennum ?>"; i++){document.getElementById("abdomen"+i).disabled = false;}
}
}

function loadgu(){

if(document.getElementById("gu<?php echo $gunum ?>").checked == true){
document.getElementById("divgu").style.display = "block";
document.getElementById("guother").required = true;
}else{
document.getElementById("divgu").style.display = "none";
document.getElementById("guother").required = false;
}

if(document.getElementById("gu1").checked == true){
for(i=2; i<="<?php echo $gunum ?>"; i++){
document.getElementById("gu"+i).checked = false;
document.getElementById("gu"+i).disabled = true;
document.getElementById("divgu").style.display = "none";
document.getElementById("guother").required = false;
}
}else{
for(i=2; i<="<?php echo $gunum ?>"; i++){document.getElementById("gu"+i).disabled = false;}
}
}

function loadneuro(){
if(document.getElementById("neuro<?php echo $neuronum ?>").checked == true){
document.getElementById("divneuro").style.display = "block";
document.getElementById("neuroother").required = true;
}else{
document.getElementById("divneuro").style.display = "none";
document.getElementById("neuroother").required = false;
}

if(document.getElementById("neuro1").checked == true){
for(i=2; i<="<?php echo $neuronum ?>"; i++){
document.getElementById("neuro"+i).checked = false;
document.getElementById("neuro"+i).disabled = true;
document.getElementById("divneuro").style.display = "none";
document.getElementById("neuroother").required = false;
}
}else{
for(i=2; i<="<?php echo $neuronum ?>"; i++){document.getElementById("neuro"+i).disabled = false;}
}
}

function loadskin(){
if(document.getElementById("skin<?php echo $skinnum ?>").checked == true){
document.getElementById("divskin").style.display = "block";
document.getElementById("skinother").required = true;
}else{
document.getElementById("divskin").style.display = "none";
document.getElementById("skinother").required = false;
}

if(document.getElementById("skin1").checked == true){
for(i=2; i<="<?php echo $skinnum ?>"; i++){
document.getElementById("skin"+i).checked = false;
document.getElementById("skin"+i).disabled = true;
document.getElementById("divskin").style.display = "none";
document.getElementById("skinother").required = false;
}
}else{
for(i=2; i<="<?php echo $skinnum ?>"; i++){document.getElementById("skin"+i).disabled = false;}
}
}

function setDisabled(val){
if(val=="1"){document.getElementById("pGenSurveyRem").style.display = "none";}
else{document.getElementById("pGenSurveyRem").style.display = "block";}
}

function loadall(){
loadheent();
loadchest();
loadheart();
loadabdomen();
loadgu();
loadskin();
loadneuro();

if(document.getElementById("pGenSurvey_1").checked == true){document.getElementById("pGenSurveyRem").style.display = "none";}
else{document.getElementById("pGenSurveyRem").style.display = "block";}
}

function convertcm(){
var height = document.getElementById("height").value;
var cm = height * 30.48;
if(height<10){document.getElementById("height").value = Math.round(cm);}
}

function validate(){
var height = document.getElementById("height").value;
var weight = document.getElementById("weight").value;
var bp1 = document.getElementById("bp1").value;
var bp2 = document.getElementById("bp2").value;
var hr = document.getElementById("hr").value;
var rr = document.getElementById("rr").value;
var temp = document.getElementById("temp").value;


var heentother = document.getElementById("heentother").value;
var chestother = document.getElementById("chestother").value;
var cvsother = document.getElementById("cvsother").value;
var abdomenother = document.getElementById("abdomenother").value;
var guother = document.getElementById("guother").value;
var skinother = document.getElementById("skinother").value;
var neuroother = document.getElementById("neuroother").value;

const bawal = ["none", "NONE", "None", "NA", "N/A", "na", "n/a", "not applicable", "Not Applicable", "NOT APPLICABLE"];
for (let i = 0; i < bawal.length; i++) {
if(heentother == bawal[i]){alert('invalid value for heent!'); return false;}
else if(chestother == bawal[i]){alert('invalid value for chest!'); return false;}
else if(cvsother == bawal[i]){alert('invalid value for cvs!'); return false;}
else if(abdomenother == bawal[i]){alert('invalid value for abdomen!'); return false;}
else if(guother == bawal[i]){alert('invalid value for GU!'); return false;}
else if(skinother == bawal[i]){alert('invalid value for skin!'); return false;}
else if(neuroother == bawal[i]){alert('invalid value for neuro!'); return false;}
}

if(isNaN(height) == true){alert('Number only for Height!'); return false;}
else if(height == ""){alert('Height is required!'); return false;}
else if(height<30){alert('Invalid Value for height! Please input valid value!'); return false;}

else if(isNaN(weight) == true){alert('Number only for Weight!'); return false;}
else if(weight == ""){alert('Weight is required!'); return false;}
else if(weight<=0){alert('Invalid Value for weight! Please input valid value!'); return false;}

else if(isNaN(temp) == true){alert('Number only for temp!'); return false;}
else if(temp == ""){alert('Temp is required!'); return false;}
else if(temp<30 || temp>42){alert('Invalid Value for temp! Please input valid value!'); return false;}

else if(isNaN(bp1) == true){alert('Number only for Systolic!'); return false;}
else if(bp1 == ""){alert('Systolic is required!'); return false;}

else if(isNaN(bp2) == true){alert('Number only for Diastolic!'); return false;}
else if(bp2 == ""){alert('Diastolic is required!'); return false;}

else if(isNaN(hr) == true){alert('Number only for HR!'); return false;}
else if(hr == ""){alert('HR is required!'); return false;}

else if(isNaN(rr) == true){alert('Number only for RR!'); return false;}
else if(rr == ""){alert('RR is required!'); return false;}
else{return true;}

}
</script>

</body>
</html>



