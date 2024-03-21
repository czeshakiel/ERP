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
$senior = $row2['senior'];
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

$now = time();
$your_date = strtotime($birthdate);
$datediff = $now - $your_date;
$age = floor($datediff / (60*60*24*365));

if($senior == "Y" and $age>59){$se = "senior citizen";}
elseif($senior == "Y" and $age<60){$se = "Persons with disabilities";}
else{$se="Not Senior|PWD";}

if(isset($_POST['btnupdate'])){
$senior = $_POST['senior'];

$sqlx = "update patientprofile set senior = '$senior' where patientidno='$patientidno'";
if($conn->query($sqlx) === TRUE){
echo"<script>alert('Successfully Update!');</script>";
$sqlxx = "INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('EDIT SENIOR|PWD STATUS PT. $ptname [from $senior to $doctor]', '$user', CURDATE(), CURTIME())";
if($conn->query($sqlxx) === TRUE){}
}

// ------------------------>> Update Price <<--------------------------
/*$pout = $conn->query("select * from productout where caseno='$caseno' and status!='PAID'");
while($po = $pout->fetch_assoc()){
$refno = $po['refno'];
$productcode = $po['productcode'];
$qty = $po['quantity'];

$re = $conn->query("select * from receiving where code='$productcode");
while($rec = $re->fetch_assoc()){
$lotno = $rec['lotno'];
}
}*/
// ------------------------>> Update Price <<--------------------------


echo"<script>window.location='?senior&caseno=$caseno$datax';</script>";
}
?>

<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?detail&caseno=<?php echo $caseno ?>">Patient Information</a></li>
<li class="breadcrumb-item"><a href="?senior&caseno=<?php echo $caseno ?>">Set Senior|PWD</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<p><b><i class="bi bi-file-earmark-medical"></i> CHANGE SENIOR|PWD STATUS <font size="1">[ <?php echo $caseno." - ".$namearray ?> ]</b></font></p><hr>

<table width="50%"><tr><td>
<div class="col">
<div class="card teacher-card" style="box-shadow: 0px 0px 1px 1px lightgrey;">
<div class="card-body  d-flex">
<div class="profile-av pe-xl-4 pe-md-2 pe-sm-4 pe-4 text-center w220">
<img src="../main/img/senior.jpg" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
<div class="about-info d-flex align-items-center mt-1 justify-content-center flex-column">
<h6 class="mb-0 fw-bold d-block fs-6 mt-2">SENIOR/ PWD</h6>
</div>
</div>
<div class="teacher-info border-start ps-xl-4 ps-md-3 ps-sm-4 ps-4 w-100">
<span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted">STATUS</span>
<h6  class="mb-0 mt-2  fw-bold d-block fs-6"><?php echo $se ?></h6>
<div class="video-setting-icon mt-3 pt-3 border-top">
<form method="POST">
<br><table width="95%" align="center">
<tr>
<td width="30%;"><font class="font8">SENIOR/ PWD:</td>
<td>
<select class="select2-single" name="senior" id="select2SinglePlaceholder" style="height:35px; font-size:10pt; color: black; width: 100%;" required>
<option value='N'>NO [ Not Senior | PWD ]</option>
<option value='Y'>YES [ Senior | PWD ]</option>
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


</div>
</div>
</div>
</div>
</section>
</main>
