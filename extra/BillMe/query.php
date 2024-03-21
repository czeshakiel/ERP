<?php
ini_set("display_errors","On");
include("../../main/class2.php");
include("../Resources/CSS/divstyle.php");

$cuz = new database();
$setip=$cuz->setIP();

mysqli_query($conn,"SET NAMES 'utf8'");

$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);
$user=mysqli_real_escape_string($conn,$_GET['user']);
$dept=mysqli_real_escape_string($conn,$_GET['dept']);

//HEADING
$asql=mysqli_query($conn,"SELECT * FROM `heading`");
$afetch=mysqli_fetch_array($asql);
$heading=$afetch['heading'];

//USERDETAILS
$bsql=mysqli_query($conn,"SELECT * FROM `nsauth` WHERE `username`='".base64_decode($user)."' AND `station`='BILLING'");
$bfetch=mysqli_fetch_array($bsql);
$name=$bfetch['name'];
$uname=$bfetch['username'];
$upass=$bfetch['password'];

if(!isset($COOKIE['billname'])){setcookie("billname", $name, time() + 28800, "/");}
if(!isset($COOKIE['billuser'])){setcookie("billuser", $uname, time() + 28800, "/");}
if(!isset($COOKIE['billpass'])){setcookie("billpass", $upass, time() + 28800, "/");}

//ADMISSION TABLE
$csql=mysqli_query($conn,"SELECT * FROM `admission` WHERE `caseno`='$caseno'");
$cfetch=mysqli_fetch_array($csql);
$patientidno=$cfetch['patientidno'];
$type=$cfetch['type'];
$membership=$cfetch['membership'];
$hmomembership=$cfetch['hmomembership'];
$hmo=$cfetch['hmo'];
$policyno=$cfetch['policyno'];
$paymentmode=$cfetch['paymentmode'];
$room=$cfetch['room'];
$ward=$cfetch['ward'];
$street=$cfetch['street'];
$barangay=$cfetch['barangay'];
$municipality=$cfetch['municipality'];
$province=$cfetch['province'];
$zipcode=$cfetch['zipcode'];
$ap=$cfetch['ap'];
//$initialdiagnosis=$cfetch['initialdiagnosis'];
$finaldiagnosis=$cfetch['finaldiagnosis'];
$dateadmit=$cfetch['dateadmit'];
$complied=$cfetch['identity'];
$result=$cfetch['result'];
$status=$cfetch['status'];

if($membership=="phic-med"){
  $phic="ACTIVE";
}
else{
  $phic="NONE";
}

if($hmo=="N/A"){
  $hmoblink="";
}
else{
  $hmoblink="hmoblinker";
}

if($complied=="Complied"){
  $warning2="PHIC Document already complied.";
  $color2="style='color:blue'";
}else{
  $warning2="PHIC Document not yet complied!";
  $color2="style='color:red'";
}

$pataddress=$street." ".$barangay." ".$municipality." ".$province." ".$zipcode;

//CASE RATES
$dsql=mysqli_query($conn,"SELECT * FROM `finalcaserate` WHERE `caseno`='$caseno' AND `level`='primary'");
$dcount=mysqli_num_rows($dsql);
if($dcount!=0){
  $dfetch=mysqli_fetch_array($dsql);
  $crcode1=$dfetch['icdcode'];
  $h1=$dfetch['hospitalshare'];
  $p1=$dfetch['pfshare'];
}
else{
  $crcode1="&nbsp;";
  $h1="0";
  $p1="0";
}

$esql=mysqli_query($conn,"SELECT * FROM `finalcaserate` WHERE `caseno`='$caseno' AND `level`='secondary'");
$ecount=mysqli_num_rows($esql);
if($ecount!=0){
  $efetch=mysqli_fetch_array($esql);
  $crcode2=$efetch['icdcode'];
  $h2=$efetch['hospitalshare'];
  $p2=$efetch['pfshare'];
}
else{
  $crcode2="&nbsp;";
  $h2="0";
  $p2="0";
}

//PATIENT PROFILE
$kprosql=mysqli_query($conn,"SELECT * FROM `patientprofile` WHERE `patientidno`='$patientidno'");
$kprocount=mysqli_num_rows($kprosql);

if($kprocount!=0){
  $dsql=mysqli_query($conn,"SELECT * FROM `patientprofile` WHERE `patientidno`='$patientidno'");
  $dfetch=mysqli_fetch_array($dsql);
  $lastname=$dfetch['lastname'];
  $firstname=$dfetch['firstname'];
  $middlename=$dfetch['middlename'];
  $suffix=$dfetch['suffix'];
  $birthdate=$dfetch['birthdate'];
  $age=$dfetch['age'];
  $sex=$dfetch['sex'];
  $senior=$dfetch['senior'];
  $patientname=$dfetch['patientname'];
  $dateofbirth=$dfetch['dateofbirth'];
}
else{
  $dsql=mysqli_query($conn,"select UPPER(lastname) as lastname,UPPER(firstname) as firstname,UPPER(middlename) as middlename,age,UPPER(gender) as sex,birthdate from nsauthemployees where empid = '$patientidno'");
  $dfetch=mysqli_fetch_array($dsql);
  $lastname=$dfetch['lastname'];
  $firstname=$dfetch['firstname'];
  $middlename=$dfetch['middlename'];
  $suffix="";
  $birthdate=$dfetch['birthdate'];
  $sex=$dfetch['sex'];
  $senior="N";
  $patientname=$lastname." ".$firstname." ".$middlename;
  $dateofbirth=$dfetch['birthdate'];

  $datetoday=date("Y-m-d");
  $today = date("Y-m-d",strtotime($birthdate));
  $diff = date_diff(date_create($datetoday), date_create($today));
  $age=$diff->format('%y');
}

$patname=$lastname.", ".$firstname." ".$suffix." ".$middlename;

$patient=$patientname."_".$caseno;

$sqlFinal=mysqli_query($conn,"SELECT * FROM billingpayment WHERE caseno='$caseno'");
if(mysqli_num_rows($sqlFinal)>0){
  $finalview="style='display:none;'";
  $setfinal="";
}else{
  $finalview="";
  $setfinal="style='display:none;'";
}
$sqlFinal=mysqli_query($conn,"SELECT * FROM admission WHERE caseno='$caseno'");
if(mysqli_num_rows($sqlFinal)>0){
  $fin=mysqli_fetch_array($sqlFinal);
  $result=$fin['result'];
}else{
  $result="";
}

$esql=mysqli_query($conn,"SELECT `name` FROM `docfile` WHERE `code`='$ap'");
$ecount=mysqli_num_rows($esql);

if($ecount==0){
  $aprel=$ap;
}
else{
  $efetch=mysqli_fetch_array($esql);
  $aprel=$efetch['name'];
}

?>
