<?php
$sql2 = "SELECT * FROM admission, patientprofile where admission.patientidno=patientprofile.patientidno and caseno='$caseno'";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()){
$initialdx=$row2['initialdiagnosis'];
$employerno=$row2['employerno'];
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
$gender = $row2['sex']; if($gender==""){$gender = $row2['gender'];}
$namearray = "$lastname".",  "."$firstname"."  "."$middlename";
if($gender=="m" or $gender=="M"){$gender="MALE";}else{$gender="FEMALE";}
}

if(isset($_POST['btnupdate'])){
$newcaseno = $_POST['newcaseno'];
$sqlCheck=mysqli_query($conn,"SELECT * FROM admission WHERE employerno='$newcaseno'");
if(mysqli_num_rows($sqlCheck)>0){
echo"<script>alert('Caseno already used!');</script>";
}else{
$sqlx = "update admission set employerno = '$newcaseno' where caseno='$caseno'";
if($conn->query($sqlx) === TRUE){
echo"<script>alert('Successfully Update!');</script>";
$sqlxx = "INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('EDIT HOSPITAL CASENO PT. $ptname [from $employerno to $newcaseno]', '$user', CURDATE(), CURTIME())";
if($conn->query($sqlxx) === TRUE){}
}
}
echo"<script>window.location='?editcaseno&caseno=$caseno$datax';</script>";
}
?>

<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?detail&caseno=<?php echo $caseno ?>">Patient Information</a></li>
<li class="breadcrumb-item"><a href="?editcaseno&caseno=<?php echo $caseno ?>">Change Hospital Caseno</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<p><b><i class="bi bi-file-earmark-medical"></i> EDIT HOSPITAL CASENO <font size="1">[ <?php echo $caseno." - ".$namearray ?> ]</font></b></p><hr>


<table width="45%"><tr><td>
<div class="card" style='box-shadow: 0px 0px 0px 1px #4B54B2;'>
<div class="card-header" style="background-color: #4B54B2; padding: 7px;">
<table width="100%"><tr><td style="color: white;"> <i class="bi bi-award"></i> HOSPITAL CASENO: <b><?php echo $employerno ?></td></tr></table>
</div>
<div class="card-body">
<form method="POST">
<br><table width="100%" align="center">
<tr>
<td width="50%"><font class="font8">NEW HOSPITAL CASENO:</td>
<td><input type="text" name="newcaseno" style="height:35px; font-size:10pt; color: black; width: 100%;" required></td>
</tr>
<tr><td colspan="2" align="right">
<button type="submit" name="btnupdate" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
</td></tr>
</table><br>
</form>
</div>
</div>
</td></tr></table>

</div>
</div>
</div>
</div>
</section>
</main>
