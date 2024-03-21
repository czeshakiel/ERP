<?php
$sql2 = "SELECT * FROM admission, patientprofile where admission.patientidno=patientprofile.patientidno and caseno='$caseno'";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()){
$employerno=$row2['employerno'];
$room=$row2['room'];
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
$gender = $row2['sex']; if($gender==""){$gender = $row2['gender'];}
$namearray = "$lastname".",  "."$firstname"."  "."$middlename";
if($gender=="m" or $gender=="M"){$gender="MALE";}else{$gender="FEMALE";}
}

if(isset($_POST['btnupdate'])){
$diet = $_POST['diet'];
$remarks = $_POST['remarks'];

$sql2yyx = "SELECT * FROM diet where COD='$diet' order by description";
$result2yyx = $conn->query($sql2yyx);
while($row2yyx = $result2yyx->fetch_assoc()){
$dnamex = $row2yyx['description'];
}


$sqlx = "INSERT INTO `dietlist`(`caseno`, `code`, `remarks`, `empid`, `date`, `time`, `room`) VALUES ('$caseno', '$diet', '$remarks', '$empid', CURDATE(), CURTIME(), '$room')";
if($conn->query($sqlx) === TRUE){
echo"<script>alert('Successfully Update!');</script>";
$sqlxx = "INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('ADD DIET PT. $ptname [$dnamex]', '$user', CURDATE(), CURTIME())";
if($conn->query($sqlxx) === TRUE){}
}
echo"<script>window.location='?dietlist&caseno=$caseno$datax';</script>";
}
?>

<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?detail&caseno=<?php echo $caseno ?>">Patient Information</a></li>
<li class="breadcrumb-item"><a href="?dietlist&caseno=<?php echo $caseno ?>">Diet List</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<p><b><i class="bi bi-file-earmark-medical"></i> DIET LIST <font size="1">[ <?php echo $caseno." - ".$namearray ?> ]</font></b></p><hr>



<table width="100%"><tr><td width="30%">
<div class="card" style='box-shadow: 0px 0px 0px 1px #4F547A;'>
<div class="card-header" style="background-color: #4F547A; padding: 7px;">
<table width="100%"><tr><td style="color: white;"> <i class="bi bi-award"></i> SET NEW DIET</td></tr></table>
</div>
<div class="card-body">

<form method="POST">
<br><table width="100%" align="center">
<tr>
<td width="25%">DIET:<br>
<select class="select2-single" name="diet" id="select2SinglePlaceholder" style="height:35px; font-size:10pt; color: black; width: 100%;" required>
<?php
$sql2yy = "SELECT * FROM diet order by description";
$result2yy = $conn->query($sql2yy);
while($row2yy = $result2yy->fetch_assoc()){
$dname = $row2yy['description'];
$dcode = $row2yy['COD'];
echo"<option value='$dcode'>$dname</option>";
}
?>
</select>
</td>
</tr>
<tr>
<td><br>REMARKS:<br>
<textarea name="remarks" style="width: 100%;" rows="7"></textarea></td>
</tr>
<tr><td colspan="2" align="right">
<button type="submit" name="btnupdate" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
</td></tr>
</table><br>
</form>

</div>
</td><td width="1%"></td>
<td valign="TOP">

<table class="datatable table" width="100%" align="center" border="1">
<thead>
<tr>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>">#</th>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>">DATE/TIME</th>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>">DIET</th>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>">ROOM</th>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>">REMARKS</th>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>">USER</th>
</tr>
</thead>
<tbody>

<?php
$i = 0;
$sqlx3 = "SELECT * FROM dietlist where caseno='$caseno'";
$resultx3 = $conn->query($sqlx3);
while($rowx3 = $resultx3->fetch_assoc()) {
$vdate=$rowx3['date'];
$vtime=$rowx3['time'];
$vcode=$rowx3['code'];
$vroom=$rowx3['room'];
$vstatus=$rowx3['status'];
$vremarks=$rowx3['remarks'];
$vempid=$rowx3['empid'];
$i++;

$sql2yyx = "SELECT * FROM diet where COD='$vcode' order by description";
$result2yyx = $conn->query($sql2yyx);
while($row2yyx = $result2yyx->fetch_assoc()){
$dnamex = $row2yyx['description'];
}

$sql2yyx = "SELECT * FROM nsauthemployees where empid = '$vempid'";
$result2yyx = $conn->query($sql2yyx);
while($row2yyx = $result2yyx->fetch_assoc()){
$vname = $row2yyx['name'];
}

echo"
<tr>
<td style='font-size: 11px;'>$i</td>
<td style='font-size: 11px;'>$vdate/ $vtime</td>
<td style='font-size: 11px;'>$dnamex</td>
<td style='font-size: 11px;'>$vroom</td>
<td style='font-size: 11px;'>$vremarks</td>
<td style='font-size: 20px;' align='center'><i class='icofont-waiter-alt' data-bs-toggle='tooltip' title='$vname'></i></td>
</tr>

";
}
?>
</tbody>
</table>
</div>
</div>
</td>

</tr></table>

</div>
</div>
</div>
</div>
</section>
</main>
