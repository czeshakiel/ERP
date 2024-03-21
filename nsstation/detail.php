<style>
.z {

      animation: blinker 1.6s linear infinite;
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


.hover-effect {background-color: red; border: 1px solid blue;}
.hover-effect:hover {
  color: white; /* color on hover */
  background-color: #5a6495;
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

if($dept=='ADMISSION'){$st="admission";$dist="username";}
if($dept=='OPD'){$st="opd";$dist="username";}
if($dept=='ER'){$st="er";$dist="username";}
if($dept=='HMO'){$st="hmo";$dist="username";}

if($dept=='NS1' || $dept=='NS2' || $dept=='NS3'){$st="ns";$dist="username";}
if($dept=='PHARMACY'){$st="pharmacy";$dist="username";}
if($dept=='BILLING'){$st="billing";$dist="nursename";}

if($dept=='NS1' || $dept=='NS2' || $dept=='NS3' || $dept=='NS 4' || $dept=='NS 5A' || $dept=='NS 5B' || $dept=='NS 6' || $dept=='SCU' || $dept=='ICU'){
$locx = "http://$ip/arv2020/nsstation/index.php?dept=$dept&username=$user&branch=$branch&userunique=$userunique&view=main";}
elseif($dept=='verifier' || $dept=='VERIFIER'){
$locx = "http://$ip/arv2020/nsstation/index.php?dept=$dept&username=$user&branch=$branch&userunique=$userunique&view=main2";}
elseif($dept=='OR' || $dept=='ENDOSCOPY' || $dept=='PT' || $dept=='RT'){
$locx = "http://$ip/arv2020/nsstation/index.php?dept=$dept&username=$user&branch=$branch&userunique=$userunique&view=ormain";}
elseif($dept=='PHARMACY' || $dept=='PHARMACY_OPD' || $dept=='pharmacy_opd' || $dept=='csr2' || $dept=='CSR2'){
$locx = "http://$ip/arv2020/pharmacy/index.php?dept=$dept&username=$user&branch=$branch&userunique=$userunique&view=main";}
else{$locx = "http://$ip/aboy2020/pages/$st/?main&dept=$dept&$dist=$user&userunique=$userunique&station10=$dept&branch=$branch";}
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
$birthdate=$rowx2['dateofbirth'];
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
$birthdate=$rowx2['dateofbirth'];
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

echo"<script>alert('Successfully Update!'); window.location = '?detail&caseno=$caseno$datax';</script>";
}
}else{echo"<script>alert('Unauthorized Password!'); window.location = '?detail&caseno=$caseno$datax';</script>";}
}

if($statusxx=="Active"){$mystat="<span class='badge bg-primary'><i class='icofont-check-circled'></i> ACTIVE STATUS</span>";}
elseif($statusxx=="LOCKED"){$mystat="<span class='badge bg-secondary'><i class='icofont-lock'></i> $statusxx</span>";}
elseif($statusxx=="WARNING"){$mystat="<span class='badge bg-info'><i class='icofont-warning'></i> $statusxx</span>";}
elseif($statusxx=="YELLOW TAG"){$mystat="<span class='badge bg-warning'><i class='icofont-ban'></i> $statusxx</span>";}
elseif($statusxx=="MGH"){$mystat="<span class='badge bg-danger'><i class='icofont-travelling'></i> MGH STATUS</span>";}


if(strpos($dept, "NS")!==false and ($statusxx!="MGH" and $statusxx!="discharged" and $statusxx!="LOCKED")){$ccdisabled = "";}
elseif($dept=="ICU" and ($statusxx!="MGH" and $statusxx!="discharged" and $statusxx!="locked")){$ccdisabled = "";}
elseif($dept=="OR" and ($statusxx!="MGH" and $statusxx!="discharged" and $statusxx!="locked")){$ccdisabled = "";}
elseif($dept=="ONCOLOGY" and ($statusxx!="MGH" and $statusxx!="discharged" and $statusxx!="locked")){$ccdisabled = "";}
elseif($dept=="SCU" and ($statusxx!="MGH" and $statusxx!="discharged" and $statusxx!="locked")){$ccdisabled = "";}
elseif($dept=="OPD"  and ($statusxx!="MGH" and $statusxx!="discharged" and $statusxx!="locked")){$ccdisabled = "";}
elseif($dept=="ER"  and ($statusxx!="MGH" and $statusxx!="discharged" and $statusxx!="locked")){$ccdisabled = "";}
elseif($dept=="HMO"  and ($statusxx!="MGH" and $statusxx!="discharged" and $statusxx!="locked")){$ccdisabled = "";}
elseif($dept=="RDU"  and ($statusxx!="MGH" and $statusxx!="discharged" and $statusxx!="locked")){$ccdisabled = "";}
elseif($dept=="PT"  and ($statusxx!="MGH" and $statusxx!="discharged" and $statusxx!="locked")){$ccdisabled = "";}
elseif($dept=="DOC-OTHERS"){$ccdisabled = "disabled";}
else{$ccdisabled="disabled";}
?>
<body onload="changebgmain();">
<main id="main" class="main">

<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?detail&caseno=<?php echo $caseno ?>">Patient Information</a></li>
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
<div class="btn-group mt-2" role="group" aria-label="Basic outlined example">
<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#cart" onclick="ccart();" <?php echo $ccdisabled ?>><i class="icofont-ui-cart"></i> Cart</button>
<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#carthm" onclick="hmeds();"><i class="icofont-prescription text-danger"></i> {Rx}</button>
</div>
</div>

<script>
function ccart(){
let a=document.createElement('a');
a.target='tabiframe';
a.href='../chargecart/cart.php?caseno=<?php echo $caseno ?>';
a.click();
}

function hmeds(){
let a=document.createElement('a');
a.target='tabiframehm';
a.href='../chargecart/carthm.php?caseno=<?php echo $caseno ?>&batchno=<?php echo $bbno ?>';
a.click();
}
</script>    


</div>
<div class="teacher-info border-start ps-xl-4 ps-md-3 ps-sm-4 ps-4 w-100">
<table width="100%"><tr>
<td width="80%">
<h6  class="mb-0 mt-2  fw-bold d-block fs-6"><?php echo strtoupper($patientname) ?></h6>
<span class="py-1 fw-bold small-11 mb-0 mt-1"><?php echo $address ?><br><?php echo $patientcontactno ?></span>
</td>
<td valign="bottom"><b class="z" style="font-size: 20px;"><?php echo $mystat ?></b></td>
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

<table><tr>
<td>
<div class="d-flex flex-wrap align-items-center ct-btn-set">
<a data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" class="btn btn-dark btn-sm mt-1" style="width: 180px;"><i class="icofont-invisible me-2 fs-6"></i>Information Details</a>
</div>
</td><td>
<div class="d-flex flex-wrap align-items-center ct-btn-set">
<a data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample" class="btn btn-dark btn-sm mt-1" style="width: 180px;"><i class="icofont-credit-card me-2 fs-6"></i>Credit Limit</a>
</div>
</td>
</tr></table>

<br><div class="collapse" id="collapseExample">
<div class="card card-body">

<table width="100%">
<tr>
<td style="font-size: 11px;"><i class="icofont-id-card"></i> PRN :</font></td>
<td style="font-size: 11px;"><b><?php echo $patientidno ?></b></font></td>
<td style="font-size: 11px;"><i class="icofont-businessman"></i> GCN :</font></td>
<td style="font-size: 11px;"><b><?php echo $caseno ?></b></font></td>
<td style="font-size: 11px;"><i class="icofont-businesswoman"></i> HCN :</font></td>
<td style="font-size: 11px;"><b><?php echo $employerno ?></b></font></td>
</tr>
<tr>
<td style="font-size: 11px;"><i class="icofont-doctor-alt"></i> ATTENDING :</font></td>
<td style="font-size: 11px;"><b><?php echo $ap ?></b></font></td>
<td style="font-size: 11px;"><i class="icofont-doctor"></i> ADMITTING :</font></td>
<td style="font-size: 11px;"><b><?php echo $ad ?></b></font></td>
<td style="font-size: 11px;"><i class="icofont-patient-bed"></i> ROOM :</font></td>
<td style="font-size: 11px;"><b><?php echo $room ?></b></font></td>
</tr>
<tr>
<td style="font-size: 11px;"><i class="icofont-ui-calendar"></i> DATE/TIME ADMIT :</font></td>
<td style="font-size: 11px;"><b><?php echo date("F d, Y", strtotime($dateadmitted))." ".date("h:i:s a", strtotime($timeadmitted)); ?></b></font></td>
<td style="font-size: 11px;"><i class="icofont-calendar"></i> DATE/IME DISCH.. :</font></td>
<td style="font-size: 11px;"><b><?php echo $datedischarged ?> <?php echo $timedischarged; ?></b></font></td>
<td style="font-size: 11px;"><i class="icofont-info-circle"></i> STATUS :</font></td>
<td style="font-size: 11px;"><b><?php echo $statusxx ?></b></font></td>
</tr>
<tr>
<td style="font-size: 11px;"><i class="icofont-birthday-cake"></i> BIRTHDATE :</font></td>
<td style="font-size: 11px;"><b><?php echo $birthdate ?></b></font></td>
<td style="font-size: 11px;"><i class="icofont-chart-histogram"></i> AGE :</font></td>
<td style="font-size: 11px;"><b><?php echo $age ?></b></font></td>
<td style="font-size: 11px;"><i class="icofont-waiter-alt"></i> GENDER :</font></td>
<td style="font-size: 11px;"><b><?php echo $sex ?></b></font></td>
</tr>
<tr>
<td style="font-size: 11px;"><i class="icofont-tracking"></i> SENIOR :</font></td>
<td style="font-size: 11px;"><b><?php echo $senior ?></b></font></td>
<td style="font-size: 11px;"><i class="icofont-company"></i> HMO :</font></td>
<td style="font-size: 11px;"><b><?php echo $hmo ?></b></font></td>
<td style="font-size: 11px;"><i class="icofont-handshake-deal"></i> PHILHEALTH :</font></td>
<td style="font-size: 11px;"><b><?php echo $membership ?></b></font></td>
</tr>

</table>

</div>
</div>


<div class="collapse" id="collapseExample2">
<div class="card card-body">

<table width="100%">
<tr>
<td style="font-size: 11px;"><i class="icofont-id-card"></i> CREDIT LIMIT :</font></td>
<td style="font-size: 11px;"><b><?php echo number_format($creditlimit1,2); ?></b></font></td>
<td style="font-size: 11px;"><i class="icofont-businessman"></i> CREDIT USED :</font></td>
<td style="font-size: 11px;"><b><?php echo number_format($gross,2); ?></b></font></td>
<td style="font-size: 11px;"><i class="icofont-businesswoman"></i> CREDIT BALANCE :</font></td>
<td style="font-size: 11px;"><b><?php echo number_format($creditlimit,2); ?></b></font></td>
</tr>
<tr>
<td style="font-size: 11px;"><i class="icofont-id-card"></i> LOA LIMIT :</font></td>
<td style="font-size: 11px;"><b><?php echo number_format($loa1,2) ?></b></font></td>
<td style="font-size: 11px;"><i class="icofont-businessman"></i> LOA USED :</font></td>
<td style="font-size: 11px;"><b><?php echo number_format($grosshmo,2); ?></b></font></td>
<td style="font-size: 11px;"><i class="icofont-businesswoman"></i> LOA BALANCE :</font></td>
<td style="font-size: 11px;"><b><?php echo number_format($loa1-$grosshmo,2); ?></b></font></td>
</tr>
</table>

</div>
</div>


</div>
</div>
</div>
</div>


<br>
 

<div class="card">
<div class="card-body pt-3">
<!-- Bordered Tabs -->


<ul class="nav nav-tabs nav-tabs-bordered">

<li class="nav-item">
<button class="nav-link active hover-effect" id="pp1" onclick="changebg(this.id)" data-bs-toggle="tab" data-bs-target="#p1"><font size="2%"><i class="icofont-medicine"></i> Medicine(s)</font></button>
</li>

<li class="nav-item">
<button class="nav-link hover-effect" id="pp2" onclick="changebg(this.id)" data-bs-toggle="tab" data-bs-target="#p2"><font size="2%"><i class="icofont-thermometer-alt"></i> Supplies</font></button>
</li>

<li class="nav-item">
<button class="nav-link hover-effect" id="pp3" onclick="changebg(this.id)" data-bs-toggle="tab" data-bs-target="#p3"><font size="2%"><i class="icofont-flask"></i> Diagnostics</font></button>
</li>

<li class="nav-item">
<button class="nav-link hover-effect" id="pp4" onclick="changebg(this.id)" data-bs-toggle="tab" data-bs-target="#p4"><font size="2%"><i class="icofont-nurse-alt"></i> Other Charges</font></button>
</li>

<li class="nav-item">
<button class="nav-link hover-effect" id="pp5" onclick="changebg(this.id)" data-bs-toggle="tab" data-bs-target="#p5"><font size="2%"><i class="icofont-undo"></i> Return Usage</font></button>
</li>

<li class="nav-item">
<button class="nav-link hover-effect" id="pp6" onclick="changebg(this.id)" data-bs-toggle="tab" data-bs-target="#p6"><font size="2%"><i class="icofont-link-broken"></i> Damage Item(s)</font></button>
</li>

<li class="nav-item">
<button class="nav-link hover-effect" id="pp7" onclick="changebg(this.id)" data-bs-toggle="tab" data-bs-target="#p7"><font size="2%"><i class="icofont-close-circled"></i> Cancelled</font></button>
</li>

</ul>
<div class="tab-content pt-2">

<div class="tab-pane fade show active" id="p1"><?php include "details/med.php"; ?></div>
<div class="tab-pane fade show" id="p2"><?php include "details/sup.php"; ?></div>
<div class="tab-pane fade show" id="p3"><?php include "details/lab_xray.php"; ?></div>
<div class="tab-pane fade show" id="p4"><?php include "details/othercharges.php"; ?></div>
<div class="tab-pane fade show" id="p5"><?php include "details/return.php"; ?></div>
<div class="tab-pane fade show" id="p6"><?php include "details/damage.php"; ?></div>
<div class="tab-pane fade show" id="p7"><?php include "details/cancelled.php"; ?></div>


</div>
</div>
</div>


<br><br>

</div>
</div>
</section>

</main><!-- End #main -->


<script>
function changebg(val){

for (let i = 1; i <= 7; i++) {
var text="";
text += "pp" + i;
document.getElementById(text).style="";
} 
document.getElementById(val).style="background: #5a6495; color: white; border-color: #f44336;";
}

function changebgmain(){document.getElementById('pp1').style="background: #5a6495; color: white; border-color: #f44336;";}
</script>