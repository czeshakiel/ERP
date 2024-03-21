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
  font-size: 17px;
}
</style>

<?php
$caseno = $_GET['caseno'];
$refno = $_GET['refno'];

$resultx1 = $conn->query("SELECT * FROM admission where caseno='$caseno'");
while($rowx1 = $resultx1->fetch_assoc()) {
$patientidno=$rowx1['patientidno'];
$street=$rowx1['street'];
$barangay=$rowx1['barangay'];
$municipality=$rowx1['municipality'];
$province=$rowx1['province'];
$address = $street." ".$barangay." ".$municipality." ".$province;
$ap=$rowx1['ap'];
}

if(is_numeric($ap)){
$sqlAp=mysqli_query($conn,"SELECT `name` FROM docfile WHERE code='$ap'");
if(mysqli_num_rows($sqlAp)>0){
$myap=mysqli_fetch_array($sqlAp);
$myap=$myap['name'];
}else{$myap="";}
}

$resultx2 = $conn->query("SELECT * FROM patientprofile where patientidno='$patientidno'");
while($rowx2 = $resultx2->fetch_assoc()) {
$sex=$rowx2['sex'];
if($sex=="F"){$sex="FEMALE"; $avat = "female";}
else{$sex="MALE"; $avat = "male";}
$age=$rowx2['age'];
$birthdate=$rowx2['birthdate'];
$senior=$rowx2['senior'];
$patientname=$rowx2['patientname'];

// ------------ get age ------
$now = time();
$your_date = strtotime($birthdate);
$datediff = $now - $your_date;
$age = floor($datediff / (60*60*24*365));

$date1 = new DateTime($birthdate);
$date2 = new DateTime(date("Y-m-d"));
$interval = $date1->diff($date2);
$age =  $interval->y ."y, ".$interval->m."m, ".$interval->d."d";
// ---------------------------
}

$resultx2 = $conn->query("SELECT * FROM productout where caseno='$caseno' and refno='$refno'");
while($rowx22 = $resultx2->fetch_assoc()) {
$productdesc = $rowx22['productdesc']." RESULT";
}


if(isset($_POST['btn_save'])){
$doctor = $ap;
$today = date("Ymd");
$todaytime = date("his");
$coder=$todaytime."".$today;
$localdate = date("M-d-Y");
$todayx = date("Y-m-d");
$todaytimex = date("H:i:s");
$daylight = $todayx." ".$todaytimex;
$designation="RESPIRATORY THERAPIST";
$transcriptionist= $_POST['resthe'];
$exam=$_POST['exam'];
$vent=$_POST['vent'];
$labno = $_POST['labno'];
$ox_del = $_POST['ox_del'];
$remarks = $_POST['remarks'];
$time = $_POST['time'];
    
$result2z = $conn->query("SELECT * FROM productout where refno='$refno' and caseno='$caseno'");
while($row2z = $result2z->fetch_assoc()) {$productcode=$row2z['productcode'];}
    
$result2zz = $conn->query("SELECT * FROM productsmasterlist where code='$productcode'");
while($row2zz = $result2zz->fetch_assoc()) {$opdprice=$row2zz['opd'];}
    
if($senior=="y" or $senior=="Y"){
$opdprice1 = $opdprice * .20;
$opdprice = $opdprice - $opdprice1;
}else{
$opdprice1 = 0;
$opdprice = $opdprice - $opdprice1;
}
$amtSum1 = $opdprice * .25;
$user=$_POST['user'];
$approvalno = "$user"."_$labno";

$conn->query("delete from rt_abgresult where caseno='$caseno' and refno='$refno'");
$conn->query("INSERT INTO  rt_abgresult (`patientidno`, `caseno`, `refno`, `filmno`, `testno`, `reader`, `clinicalservice`, `partexamined`, `refferedby`, `date`, `validate`, `designation`, `authno`,
 `remarks`,`ox_del`,`time`) VALUES ('$patientidno','$caseno','$refno','$labno','','','LABORATORY','$productdesc', '$doctor','$daylight','$transcriptionist','$designation','$coder','$remarks','$ox_del','$time')");

$conn->query("update productout set approvalno='$approvalno',terminalname='Testdone' where refno='$refno' and caseno='$caseno'");
$conn->query("UPDATE `labpending` SET `resultstatus`='Testdone', `testdonedt`='".date("Y-m-d H:i:s")."' WHERE `refno`='$refno'");
    

    
$count=1;
foreach ($exam as $value) {
$table="lab".$count;
$sql77 = "UPDATE rt_abgresult set {$table}='$value' where refno = '$refno' and caseno='$caseno'";
if ($conn->query($sql77) === TRUE) {}
$count++;
}
    
$count=8;
foreach ($vent as $value) {
$table="lab".$count;
$sql77 = "UPDATE rt_abgresult  set {$table}='$value' where refno = '$refno' and caseno='$caseno'";
if ($conn->query($sql77) === TRUE) {}
$count++;
}

//echo"<script> window.open('abg_printresult.php?caseno=$caseno&refno=$refno');</script>";
echo"<script> window.location='?rtresults&caseno=$caseno';</script>";
}


$sqlv = $conn->query("select * from rt_abgresult where caseno='$caseno' and refno='$refno'");
while($resv = $sqlv->fetch_assoc()){
$validate = $resv['validate'];
$filmno = $resv['filmno'];
$ox_del = $resv['ox_del'];
$time = $resv['time'];

for($i=1; $i<=13; $i++){
$cul = "lab".$i;
$lab[$i] = $resv[$cul];
}
}

?>

<main id="main" class="main">

<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?ptpf">PT PF Date</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">

<div class="card">
<div class="card-body">




<div class="col">
<div class="card teacher-card">
<div class="card-body  d-flex">
<div class="profile-av pe-xl-4 pe-md-2 pe-sm-4 pe-4 text-center w220">
<img src='../main/img/<?php echo $avat ?>.png' width='120' height='120' style='border-radius: 50%;'>
<div class="about-info d-flex align-items-center mt-1 justify-content-center flex-column">
<font size="1" align="left">Patient ID: <b><?php echo $patientidno ?></b><br>Caseno: <b><?php echo $caseno ?></b></font>
</div>
</div>


<div class="teacher-info border-start ps-xl-4 ps-md-3 ps-sm-4 ps-4 w-100">
<table width="100%"><tr>
<td width="80%">
<h6  class="mb-0 mt-2  fw-bold d-block fs-6"><?php echo strtoupper($patientname) ?></h6>
<span class="py-1 fw-bold small-11 mb-0 mt-1"><?php echo $address ?></span>
</td>
</tr>
</table>

<div class="video-setting-icon mt-3 pt-3 border-top">
<table width="100%">
<tr>
<td width="15%" style="font-size: 11px;"><i class="icofont-medical-sign"></i> Age/ Gender:</font></td>
<td style="font-size: 11px;"><b><?php echo $age." / ".$sex ?></b></font></td>
</tr>
<tr>
<td style="font-size: 11px;"><i class="icofont-medical-sign-alt"></i> Senior/PWD :</font></td>
<td style="font-size: 11px;"><b><?php echo $senior ?></b></font></td>
</tr>
<tr>
<td style="font-size: 11px;"><i class="icofont-prescription"></i> Clinical Services :</font></td>
<td style="font-size: 11px;"><b><?php echo $productdesc ?></b></font></td>
</tr>
<tr>
<td style="font-size: 11px;"><i class="icofont-prescription"></i> Attending :</font></td>
<td style="font-size: 11px;"><b><?php echo $ap ?></b></font></td>
</tr>
</table>
</div>


</div>
</div>
</div>
</div>

<br>
<form method="POST">
<table width="100%"><tr>
<td width="35%" valign="TOP">

<div class="card" style='box-shadow: 0px 0px 0px 1px #6d2344;'>
<div class="card-header" style="background-color: #6d2344; padding: 7px;">
<table width="100%"><tr><td style="color: white;"> <i class="icofont-flask"></i> ARTERIAL BLOOD GAS RESULT</td></tr></table>
</div>
<div class="card-body">

<table width="100%" >
<tr>
<td width="30%"><font color="black">RESPIRATORY THERAPIST:<br>
<select name="resthe" class="form-control" required>
<?php 
echo "<option value='$validate'>$validate</option>";
echo "<option value='aa'>aa</option>";
$asql=$conn->query("SELECT `name` FROM `nsauth` WHERE `station`='RT' AND `branch`='1' ORDER BY `name`");
while($afetch=$asql->fetch_assoc()){
$aname=$afetch['name'];
echo "<option value='$aname'>$aname</option>";
}
?>
</select>
</td>
</tr>
<tr>
<td><font color="black">LAB NO.:<br><input type="text" name="labno" value="<?php echo $filmno ?>" class="form-control" required></td>
</tr>
<tr>
<td><font color="black">OXYGEN DELIVERY:<br><input type="text" name="ox_del" value="<?php echo $ox_del ?>" class="form-control"></td>
</tr>
<tr>
<td><font color="black">TIME:&nbsp;&nbsp;<br><input type="time" name="time" value="<?php echo $time ?>" class="form-control" required></td>
</tr>
</table>

</div>
</div>

</td>
<td width="2%"></td>
<td valign="TOP">


<div class='card' style='box-shadow: 0px 0px 0px 1px #6d2344;'>
<div class='ribbon-2'>EXAMINATION</div>
<div class='card-body'>&nbsp;<hr>

<table width="100%">
<tr>
<td align="center" width="30%"></td>
<td align="center">RESULT</td>
<td align="center">NORMAL VALUES</td>
</tr>
<?php
$i = 0;
$sql2 = "SELECT * FROM rt_abg where grp ='1'";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$exam=$row2['exam'];
$id=$row2['id'];
$ns=$row2['normalstart'];
$ne=$row2['normalend'];
$unit=$row2['unit'];
$i++;
?>
<tr>
<td align="right" style="padding: 10px; font-size: 12px;"><b><?php echo $exam ?></b></td>
<td align="center"><font color="black"><input type="text" name="exam[]" class="form-control" value="<?php echo $lab[$i] ?>" style="font-size:15px; padding: 5px; text-align: center;"></td>
<td align="center"><font color="black"><input type="text" name="val1" value="<?php echo $ns.'-'.$ne.$unit ?>" class="form-control" style="font-size:15px; padding: 5px;" readonly></td>
</tr>
<?php
}
?>
<tr>
<td colspan="3"> &nbsp</td>
</tr>
<tr>
<td align="right" style="padding: 10px; font-size: 12px;"><b>REMARKS:</b></td>
<td align="right" colspan="2"><font color="black"><input type="text" name="remarks" class="form-control" style="font-size:15px; padding: 5px;"></td>
</tr>
</table>


</div>
</div>

<br>


<div class='card' style='box-shadow: 0px 0px 0px 1px #6d2344;'>
<div class='ribbon-2'>VENTILATOR SET-UP</div>
<div class='card-body'>&nbsp;<hr>

<table width="100%">
<tr>
<td width="30%"></td>
<td align="center">RESULT</td>
<td align="center">NORMAL VALUES</td>
</tr>
<?php
$sql2 = "SELECT * FROM rt_abg where grp ='2'";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$exam=$row2['exam'];
$id=$row2['id'];
$ns=$row2['normalstart'];
$ne=$row2['normalend'];
$unit=$row2['unit'];
$i++;
?>
<tr>
<td align="right" style="padding: 10px; font-size: 12px;"><b><?php echo $exam ?></b></td>
<td align="center"><font color="black"><input type="text" name="vent[]" class="form-control" value="<?php echo $lab[$i] ?>" style="font-size:15px; padding: 5px; text-align: center;"></td>
<td align="center"><font color="black"><input type="text" name="val1" value="<?php echo $ns.'-'.$ne.$unit ?>" class="form-control" style="font-size:15px; padding: 5px;" readonly></td>
</tr>
<?php
} ?>
<tr>
</table>
</div>
</div>

<br>
<p align="right"><button type="submit" name="btn_save" class="btn btn-s btn-danger" style="background: #6d2344; color: white;"><i class="icofont-check-circled"></i> Submit Result</button></p>

</td>
</tr></table>
</form>

</div>
</div>

</div>
</div>
</section>

</main>