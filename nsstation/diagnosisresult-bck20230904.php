<style>
.z {

      animation: blinker 0.6s linear infinite;
      font-size: 15px;
      font-weight: bold;
      font-family: sans-serif;
      }
      @keyframes blinker {  
      50% { opacity: 0; }
      }
      .blink-one {
      animation: blinker-one 1s linear infinite;
      }
      @keyframes blinker-one {  
      0% { opacity: 0; }
      }
      .blink-two {
      animation: blinker-two 1.4s linear infinite;
      }
      @keyframes blinker-two {  
      100% { opacity: 0; }
      }
}

</style>

<?php
if(isset($_POST['btntest'])){
$refnotest = $_POST['refnotest'];
$casenotest = $_POST['casenotest'];
echo"<script>alert('$casenotest ------ $refnotest');</script>";
$sqll = "update productout set terminalname='Testdone' where caseno='$casenotest' and refno='$refnotest'";
if ($conn->query($sqll) === TRUE) {}
?>
<script>
window.location="index.php?labs&view=detail&caseno=<?php echo $casenotest ?><?php echo $datax ?>";
</script>
<?php
}
?>

<?php
$sqlx1 = "SELECT * FROM admission where caseno='$caseno'";
$resultx1 = $conn->query($sqlx1);
while($rowx1 = $resultx1->fetch_assoc()) {
$patientidno=$rowx1['patientidno'];
$initialdiagnosis=$rowx1['initialdiagnosis'];
$finaldiagnosis=$rowx1['finaldiagnosis'];
$employerno=$rowx1['employerno'];
$room=$rowx1['room'];
$membership=$rowx1['membership'];
$hmo=$rowx1['hmo'];
$street=$rowx1['street'];
$barangay=$rowx1['barangay'];
$municipality=$rowx1['municipality'];
$province=$rowx1['province'];
$address = $street." ".$barangay." ".$municipality." ".$province;
$branch=$_GET['branch'];
$dateadmitted=$rowx1['dateadmitted'];
$timeadmitted=$rowx1['timeadmitted'];
$ap=$rowx1['ap'];
$ad=$rowx1['ad'];
$patientcontactno=$rowx1['patientcontactno'];
$policyno=$rowx1['policyno'];
$statusxx=$rowx1['status'];
$resultsxx=$rowx1['result'];
$ward=$rowx1['ward'];
$remarks=$rowx1['remarks'];
if($statusxx=="MGH" or $statusxx=="YELLOW TAG"){$blink="<i class='blink'>";}
else{$blink="";}
$hmomembership=$rowx1['hmomembership'];
if($hmomembership == "hmo-hmo") {$hmomembership = "WITH HMO";}
if($hmomembership == "hmo-company") {$hmomembership = "WITH COMPANY";}
if($hmomembership =="none") {$hmomembership = "NONE";}
if ($membership == "Nonmed-none") {$membership = "NO";}
if ($membership == "phic-med") {$membership = "YES";}
if ($ward == "out") {$ward = "OUTPATIENT";}
if ($ward == "in") {$ward = "INPATIENT";}
}

if(is_numeric($ap)){
$sqlAp=mysqli_query($conn,"SELECT `name` FROM docfile WHERE code='$ap'");
if(mysqli_num_rows($sqlAp)>0){
$myap=mysqli_fetch_array($sqlAp);
$ap=$myap['name'];
}else{$ap="";}
}

if(is_numeric($ad)){
$sqlAp=mysqli_query($conn,"SELECT `name` FROM docfile WHERE code='$ad'");
if(mysqli_num_rows($sqlAp)>0){
$myap=mysqli_fetch_array($sqlAp);
$ad=$myap['name'];
}else{$ad="";}
}

$cn=explode('-',$caseno);
if($cn[0]=="AR"){
$sqlx2 = "SELECT * FROM nsauthemployees where empid='$patientidno'";
$resultx2 = $conn->query($sqlx2);
if(mysqli_num_rows($resultx2)>0){
while($rowx2 = $resultx2->fetch_assoc()) {
$patientidno=$rowx2['empid'];
$sex=$rowx2['gender'];
if($sex=="F"){$sex="FEMALE"; $avat = "female";}
else{$sex="MALE"; $avat = "male";}
$age=$rowx2['age'];
$birthdate=$rowx2['birthdate'];
$patientname=$rowx2['name'];
$senior=$rowx2['senior'];
}

}else{

mysqli_query($conn,"SET NAMES 'utf8'");
$sqlx2 = "SELECT * FROM patientprofile where patientidno='$patientidno'";
$resultx2 = $conn->query($sqlx2);
while($rowx2 = $resultx2->fetch_assoc()) {
$patientidno=$rowx2['patientidno'];
$sex=$rowx2['sex'];
if($sex=="F"){$sex="FEMALE"; $avat = "female";}
else{$sex="MALE"; $avat = "male";}
$age=$rowx2['age'];
$birthdate=$rowx2['birthdate'];
$senior=$rowx2['senior'];
$patientname=$rowx2['patientname'];
}
}
}else{
mysqli_query($conn,"SET NAMES 'utf8'");
$sqlx2 = "SELECT * FROM patientprofile where patientidno='$patientidno'";
$resultx2 = $conn->query($sqlx2);
while($rowx2 = $resultx2->fetch_assoc()) {
$patientidno=$rowx2['patientidno'];
$sex=$rowx2['sex'];
if($sex=="F"){$sex="FEMALE"; $avat = "girl";}
else{$sex="MALE"; $avat = "boy";}
$age=$rowx2['age'];
$birthdate=$rowx2['birthdate'];
$senior=$rowx2['senior'];
$patientname=$rowx2['patientname'];
}
}

$patient=$patientname."_".$caseno;
$datedischarged="";
$timedischarged="";
$sqlx3 = "SELECT * FROM dischargedtable where caseno='$caseno'";
$resultx3 = $conn->query($sqlx3);
while($rowx3 = $resultx3->fetch_assoc()) {
$datedischarged=$rowx3['datedischarged'];
$timedischarged=$rowx3['timedischarged'];
}

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

$sqlPatientProfile=mysqli_query($conn,"SELECT * FROM patientprofile WHERE patientidno='$patientidno'");
if(mysqli_num_rows($sqlPatientProfile)>0){
$patientname=mysqli_fetch_array($sqlPatientProfile)['patientname'];
}

$gross=0;
$grosshmo=0;
$sqlx4 = "SELECT sellingprice, quantity, hmo FROM productout WHERE caseno='$caseno' AND quantity > 0 AND trantype='charge'
AND productsubtype NOT LIKE '%OTHERS%' AND producttype NOT LIKE '%READERS FEE%' AND approvalno NOT LIKE '%proferfee%' AND
approvalno NOT LIKE '%instrument%' AND producttype NOT LIKE '%PAYMENT OF%'";
$resultx4 = $conn->query($sqlx4);
while($rowx4 = $resultx4->fetch_assoc()) {
$rsp=$rowx4['sellingprice'];
$rqt=$rowx4['quantity'];
$rad=$rowx4['adjustment'];
$gross+=($rsp*$rqt)-$rad;
$grosshmo+=$rowx4['hmo'];
}

$sqlx5 = "SELECT creditlimit FROM   patientscredit where caseno ='$caseno'";
$resultx5 = $conn->query($sqlx5);
while($rowx5 = $resultx5->fetch_assoc()) {
$creditlimit1=$rowx5['creditlimit'];
}

$sqlx6 = "select sum(amount) as amount from collection where acctno = '$caseno'";
$resultx6 = $conn->query($sqlx6);
while($rowx6 = $resultx6->fetch_assoc()) {
$amount=$rowx6['amount'];
}

$totalcredit=$gross-$grosshmo;
$creditlimit =$creditlimit1 - $totalcredit;

$sqlx7 = "SELECT policyno FROM  admission where caseno ='$caseno'";
$resultx7 = $conn->query($sqlx7);
while($rowx7 = $resultx7->fetch_assoc()) {
$loa1=$rowx7['policyno'];
}
//Added by Eczekiel
if($creditlimit <= 0){$creditlimit = 0;}

if($creditlimit <= 0){
$gross=$creditlimit1;
$grosshmo=$totalcredit-$gross;
}

$bbno ="HM-".date('YmdHis');

if(isset($_POST['btnrev'])){
$pass = $_POST['pass'];
$reason = $_POST['reason'];
$sqlx1 = "SELECT * FROM nsauth where password = '$pass' and Access = '4' and station = 'VERIFIER'";
$resultx1 = $conn->query($sqlx1);
$ccount = mysqli_num_rows($resultx1);
while($rowx2 = $resultx1->fetch_assoc()) {
$name = $rowx2['name'];
}

$sqlx12 = "SELECT * FROM admission where result = 'FINAL' and caseno = '$caseno'";
$resultx12 = $conn->query($sqlx12);
$ccount2 = mysqli_num_rows($resultx12);

if($ccount>0){
if($ccount2>0){echo"<script>alert('Billing is already finalized! Please call the billing to cancel Final Bill..'); window.location = '?view=detail&caseno=$caseno$datax';</script>";}else{
$sqll = "update admission set status='Active', consult_id = concat(consult_id, '\nCancel mgh by: $user') where caseno='$caseno'";
if ($conn->query($sqll) === TRUE) {}else{echo"<script>alert('no 1!');</script>";}

$sqll = "delete from admitmgh where caseno = '$caseno'";
if ($conn->query($sqll) === TRUE) {}else{echo"<script>alert('no 2!');</script>";}

$sqll = "INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('$caseno - $patientname CANCEL MGH ($reason)', '$user', CURDATE(), CURTIME())";
if ($conn->query($sqll) === TRUE) {}else{echo"<script>alert('no 2!');</script>";}

echo"<script>alert('Successfully Update!'); window.location = '?view=detail&caseno=$caseno$datax';</script>";
}
}else{echo"<script>alert('Unauthorized Password!'); window.location = '?view=detail&caseno=$caseno$datax';</script>";}
}

if($statusxx=="Active"){$mystat="<i class='icofont-check-circled'></i> ACTIVE STATUS";}
elseif($statusxx=="WARNING"){$mystat="<i class='icofont-warning'></i> $statusxx";}
elseif($statusxx=="YELLOW TAG"){$mystat="<i class='icofont-ban'></i> $statusxx";}
elseif($statusxx=="MGH"){$mystat="<i class='icofont-travelling'></i> MGH STATUS";}
?>

<main id="main" class="main">

<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?detail&caseno=<?php echo $caseno ?>">Patient Information</a></li>
<li class="breadcrumb-item"><a href="?diagnosisresult&caseno=<?php echo $caseno ?>">Test Performed</a></li>
</ol>
</nav>


</div><!-- End Page Title -->

<section class="section profile">

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
<td width="15%" style="font-size: 11px;"><i class="icofont-medical-sign"></i> Initial Diagnosis: :</font></td>
<td style="font-size: 11px;"><b><?php echo $initialdiagnosis ?></b></font></td>
</tr>
<tr>
<td style="font-size: 11px;"><i class="icofont-medical-sign-alt"></i> Final Diagnosis :</font></td>
<td style="font-size: 11px;"><b><?php echo $finaldiagnosis ?></b></font></td>
</tr>
<tr>
<td style="font-size: 11px;"><i class="icofont-prescription"></i> Remarks :</font></td>
<td style="font-size: 11px;"><b><?php echo $remarks ?></b></font></td>
</tr>
</table>
</div>




</div>
</div>
</div>
</div>


<br>


<div class="card">
<div class="card-body pt-3">
<!-- Bordered Tabs -->


<?php
if(isset($_GET['xray'])){
$ipd = "class='btn btn-primary'";
$opd = "class='btn btn-outline-primary'";
$ttbd = "class='btn btn-outline-primary'";
$lload = "1";
}
elseif(isset($_GET['lab'])){
$opd = "class='btn btn-primary'";
$ipd = "class='btn btn-outline-primary'";
$ttbd = "class='btn btn-outline-primary'";
$lload = "2";
}

elseif(isset($_GET['ecg'])){
$ttbd = "class='btn btn-primary'";
$opd = "class='btn btn-outline-primary'";
$ipd = "class='btn btn-outline-primary'";
$lload = "3";
}

else{
$ipd = "class='btn btn-primary'";
$opd = "class='btn btn-outline-primary'";
$ttbd = "class='btn btn-outline-primary'";
$lload = "1";
}
?>

<table width="60%"><tr><td>
<div class="container">
<div class="btn-group btn-group-justified" style="width: 100%;">
<button name="ipd" style="width:20%; font-size: 12px;" onclick="loadz('xray');" <?php echo $ipd ?>><i class="icofont-users-alt-5"></i> Imaging Results</button></a>
<button name="opd" style="width:20%; font-size: 12px;" onclick="loadz('lab');" <?php echo $opd ?>><i class="icofont-users-social"></i> Laboratories</button>
<button name="rdu" style="width:20%; font-size: 12px;" onclick="loadz('ecg');" <?php echo $ttbd ?>><i class="icofont-ui-clip-board"></i> ECG Results</button>
</div>
</div>
</td>
</tr></table>
<hr>


<?php 
if($lload=="1"){include "other/dximaging.php";}
elseif($lload=="2"){include "other/dxlaboratory.php";}
elseif($lload=="3"){include "other/dxecg.php"; }
?>


</div>
</div>
</div>


<br><br>

</div>
</div>
</section>

</main><!-- End #main -->

<script>
function loadz(val){window.location= "?diagnosisresult&caseno=<?php echo $caseno ?>&"+val;}
</script>


