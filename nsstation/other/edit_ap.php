<?php
$sql2 = "SELECT * FROM admission, patientprofile where admission.patientidno=patientprofile.patientidno and caseno='$caseno'";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()){
$initialdx=$row2['initialdiagnosis'];
$patientidno=$row2['patientidno'];
$patientadmit=$row2['patientadmit'];
$disposition=$row2['disposition'];
$finaldx=$row2['finaldiagnosis'];
$lastname = $row2['lastname'];
$firstname = $row2['firstname'];
$middlename = $row2['middlename'];
$age = $row2['age'];
$ward = $row2['ward'];
$ap = $row2['ap'];
$ad = $row2['ad'];
$gender = $row2['sex']; if($gender==""){$gender = $row2['gender'];}
$namearray = "$lastname".",  "."$firstname"."  "."$middlename";
if($gender=="m" or $gender=="M"){$gender="MALE";}else{$gender="FEMALE";}
}

if(is_numeric($ap)){
$sqlAp=mysqli_query($conn,"SELECT `name` FROM docfile WHERE code='$ap'");
if(mysqli_num_rows($sqlAp)>0){
$myap=mysqli_fetch_array($sqlAp);
$ap=$myap['name'];
}else{$ap="";}
}

if(is_numeric($ad)){
$sqlAd=mysqli_query($conn,"SELECT `name` FROM docfile WHERE code='$ad'");
if(mysqli_num_rows($sqlAd)>0){
$myad=mysqli_fetch_array($sqlAd);
$ad=$myad['name'];
}else{$ad="";}
}

if(isset($_POST['btnupdate'])){
$doctor = $_POST['doctorad'];

$sqlx = "update admission set ad = '$doctorad' where caseno='$caseno'";
if($conn->query($sqlx) === TRUE){
echo"<script>alert('Successfully Update!');</script>";
$sqlxx = "INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('EDIT ADMITTING PHYSICAIN PT. $ptname [from $ad to $doctorad]', '$user', CURDATE(), CURTIME())";
if($conn->query($sqlxx) === TRUE){}
}
echo"<script>window.location='?ap&caseno=$caseno$datax';</script>";
}

if(isset($_POST['btnupdatead'])){
$doctor = $_POST['doctor'];

$sqlx = "update admission set ap = '$doctor' where caseno='$caseno'";
if($conn->query($sqlx) === TRUE){
echo"<script>alert('Successfully Update!');</script>";
$sqlxx = "INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('EDIT ATTENDING PHYSICAIN PT. $ptname [from $ap to $doctor]', '$user', CURDATE(), CURTIME())";
if($conn->query($sqlxx) === TRUE){}
}
echo"<script>window.location='?ap&caseno=$caseno$datax';</script>";
}
?>

<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?detail&caseno=<?php echo $caseno ?>">Patient Information</a></li>
<li class="breadcrumb-item"><a href="?ap&caseno=<?php echo $caseno ?>">Change Attending Physician</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<p><b><i class="bi bi-file-earmark-medical"></i> CHANGE ATTENDING AND ADMITTING PHYSICIAN <font size="1">[ <?php echo $caseno." - ".$namearray ?> ]</b></font></p><hr>

<table width="50%"><tr><td>
<div class="col">
<div class="card teacher-card" style="box-shadow: 0px 0px 1px 1px lightgrey;">
<div class="card-body  d-flex">
<div class="profile-av pe-xl-4 pe-md-2 pe-sm-4 pe-4 text-center w220">
<img src="../main/img/attending.jpg" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
<div class="about-info d-flex align-items-center mt-1 justify-content-center flex-column">
<h6 class="mb-0 fw-bold d-block fs-6 mt-2">ATTENDING PHYSICIAN</h6>
</div>
</div>
<div class="teacher-info border-start ps-xl-4 ps-md-3 ps-sm-4 ps-4 w-100">
<span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted">Attending Physician</span>
<h6  class="mb-0 mt-2  fw-bold d-block fs-6"><?php echo $ap ?></h6>
<div class="video-setting-icon mt-3 pt-3 border-top">
<form method="POST">
<br><table width="100%" align="center">
<tr>
<td width="35%"><font class="font8">NEW ATTENDING:</td>
<td>
<select class="select2-single" name="doctor" style="height:35px; font-size:10pt; color: black; width: 100%;" required>
<option value='<?php echo $ap ?>'><?php echo $ap ?></option>
<?php
$sql2yy = "SELECT * FROM docfile order by name";
$result2yy = $conn->query($sql2yy);
while($row2yy = $result2yy->fetch_assoc()){
$dname = $row2yy['name'];
$dcode = $row2yy['code'];
echo"<option value='$dcode'>$dname</option>";
}
?>
</select>
</td>
</tr>
<tr><td colspan="2" align="right">
<button type="submit" name="btnupdate" class="btn btn-primary"><i class="icofont-check-circled"></i> Update</button>
</td></tr>
</table><br>
</form>
</div>
</div>
</div>
</div>
</div>
</td></tr></table>

<br>

<table width="50%"><tr><td>
<div class="col">
<div class="card teacher-card" style="box-shadow: 0px 0px 1px 1px lightgrey;">
<div class="card-body  d-flex">
<div class="profile-av pe-xl-4 pe-md-2 pe-sm-4 pe-4 text-center w220">
<img src="../main/img/admitting.jpg" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
<div class="about-info d-flex align-items-center mt-1 justify-content-center flex-column">
<h6 class="mb-0 fw-bold d-block fs-6 mt-2">ADMITTING PHYSICIAN</h6>
</div>
</div>
<div class="teacher-info border-start ps-xl-4 ps-md-3 ps-sm-4 ps-4 w-100">
<span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted">Admitting Physician</span>
<h6  class="mb-0 mt-2  fw-bold d-block fs-6"><?php echo $ad ?></h6>
<div class="video-setting-icon mt-3 pt-3 border-top">
<form method="POST">
<br><table width="100%" align="center">
<tr>
<td width="35%"><font class="font8">NEW ADMITTING:</td>
<td>
<select class="select2-single" name="doctorad" style="height:35px; font-size:10pt; color: black; width: 100%;" required>
<option value='<?php echo $ap ?>'><?php echo $ap ?></option>
<?php
$sql2yy = "SELECT * FROM docfile order by name";
$result2yy = $conn->query($sql2yy);
while($row2yy = $result2yy->fetch_assoc()){
$dname = $row2yy['name'];
$dcode = $row2yy['code'];
echo"<option value='$dcode'>$dname</option>";
}
?>
</select>
</td>
</tr>
<tr><td colspan="2" align="right">
<button type="submit" name="btnupdatead" class="btn btn-primary"><i class="icofont-check-circled"></i> Update</button>
</td></tr>
</table><br>
</form>
</div>
</div>
</div>
</div>
</div>
</td></tr></table>


</div>
</div>
</div>
</div>
</section>
</main>


