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
$currentroom = $row2['room'];
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
$newroom = $_POST['room'];
$datenow=date('Y-m-d');
$now=date('Y-m-d H:i:s');
$time=date('H:i:s');
$dat=date('M-d-Y');
$refno="RN".date("YmdHis");

$sqlRoom=$conn->query("SELECT * FROM room WHERE room='$newroom'");
while($rr=$sqlRoom->fetch_assoc()){$roomrates = $rr['roomrates'];}

$conn->query("INSERT INTO productout(refno, invno, caseno, productcode, productdesc, sellingprice, quantity, adjustment, gross, trantype, phic, hmo, excess, `date`, `status`, terminalname, loginuser, batchno, producttype, productsubtype, approvalno, referenceno, administration, shift, location, datearray, phic1) VALUES('$refno','$time','$caseno','$newroom','$newroom','$roomrates','1','0.00','$roomrates','charge','0.00','0.00','$roomrates','$dat','Approved','','$nursename','','','ROOM ACCOMODATION','','','','KMSCI','NS','$datenow','0.00')");
$conn->query("update admission set room='$newroom' where caseno='$caseno'");
$conn->query("UPDATE room SET roomstat='vacant' WHERE room='$currentroom'");
$conn->query("UPDATE room SET roomstat='occupied' WHERE room='$newroom'");
$conn->query("INSERT INTO userlogs(transaction,loginuser,datearray,timearray) VALUES('$namearray room is change to $newroom','$loginuser',CURDATE(), CURTIME())");

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
<li class="breadcrumb-item"><a href="?room&caseno=<?php echo $caseno ?>">Room</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<p><b><i class="bi bi-file-earmark-medical"></i> ADD/ CHANGE ROOM <font size="1">[ <?php echo $caseno." - ".$namearray ?> ]</b></font></p><hr>


<table width="45%"><tr><td>

<div class="card" style='box-shadow: 0px 0px 0px 1px #3E427A;'>
<div class="card-header" style="background-color: #3E427A; padding: 7px;">
<table width="100%"><tr><td style="color: white;"> <i class="bi bi-award"></i> Current Room: <b><?php echo $currentroom ?></td></tr></table>
</div>
<div class="card-body">

<form method="POST">
<br><table width="95%" align="center">
<tr>
<td width="30%;"><font class="font8">New Room:</td>
<td>
<select class="select2-single" name="room" id="select2SinglePlaceholder" style="height:35px; font-size:10pt; color: black; width: 100%;" required>
<?php
$sqlRoom=$conn->query("SELECT * FROM room WHERE roomstat='vacant' ORDER BY room ASC");
while($rr=$sqlRoom->fetch_assoc()){
echo "<option value='$rr[room]'>$rr[room] ($rr[nursestation])</option>";
}
?>
</select>
</td>
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
