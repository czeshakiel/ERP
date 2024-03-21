<body onload="loadd();">
<script>
function fdx(){
var patientadmit=$('#patientadmit').val();
var pathonone=$('#pathonone').val();
var typeofbirth=$('#typeofbirth').val();
var disposition=$('#disposition').val();
var ifdied=$('#ifdied').val();
var iftransfer=$('#iftransfer').val();

if(patientadmit=="NEWBORN"){
if(pathonone==""){
alert("Please enter NEWBORN STATUS!");
$('#pathonone').focus();
return false;
}else if(typeofbirth==""){
alert("Please enter TYPE OF BIRTH");
$('#typeofbirth').focus();
return false;
}
}

else if(disposition=="DIED"){
if(ifdied == ""){
alert("Please enter TYPE OF DEATH");
$('#ifdied').focus();
return false;
}
}

else if(disposition=="TRANSFERRED"){
if(iftransfer == ""){
alert("Please enter Hospital Name");
$('#iftransfer').focus();
return false;
}
}

else{
return confirm('Do you wish to save this record?');
}

}
</script>

<?php
error_reporting(1);
if($dept=='ADMISSION'){$st="admission";$dist="username";}
if($dept=='OPD'){$st="opd";$dist="username";}
if($dept=='ER'){$st="er";$dist="username";}
if($dept=='HMO'){$st="hmo";$dist="username";}

if($dept=='NS1' || $dept=='NS2' || $dept=='NS3'){$st="ns";$dist="username";}
if($dept=='PHARMACY'){$st="pharmacy";$dist="username";}
if($dept=='BILLING'){$st="billing";$dist="nursename";}

if($dept=='NS1' || $dept=='NS2' || $dept=='NS3' || $dept=='NS 4' || $dept=='NS 5A' || $dept=='NS 5B' || $dept=='NS 6' || $dept=='SCU' || $dept=='ICU'){
$locx = "http://$ip/arv2020/nsstation/index.php?dept=$dept&username=$user&branch=$branch&userunique=$userunique&main";}
elseif($dept=='verifier' || $dept=='VERIFIER'){
$locx = "http://$ip/arv2020/nsstation/index.php?dept=$dept&username=$user&branch=$branch&userunique=$userunique&main2";}
elseif($dept=='OR' || $dept=='ENDOSCOPY' || $dept=='PT' || $dept=='RT'){
$locx = "http://$ip/arv2020/nsstation/index.php?dept=$dept&username=$user&branch=$branch&userunique=$userunique&ormain";}
elseif($dept=='PHARMACY' || $dept=='PHARMACY_OPD' || $dept=='pharmacy_opd' || $dept=='csr2' || $dept=='CSR2'){
$locx = "http://$ip/arv2020/pharmacy/index.php?dept=$dept&username=$user&branch=$branch&userunique=$userunique&main";}
else{$locx = "http://$ip/aboy2020/pages/$st/?main&dept=$dept&$dist=$user&userunique=$userunique&station10=$dept&branch=$branch";}


  
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
$patientadmit=$rowx1['patientadmit'];
$disposition=$rowx1['disposition'];
$hmomembership=$rowx1['hmomembership'];

if($disposition=="DIED"){$disposition2="EXPIRED";}else{$disposition2=$disposition;}

if($statusxx=="MGH" or $statusxx=="YELLOW TAG"){$blink="<i class='blink'>";}
else{$blink="";}

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
if($sex=="F"){$sex="FEMALE"; $avat = "female";}
else{$sex="MALE"; $avat = "male";}
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
$age2 = floor($datediff / (60*60*24*365));

$date1 = new DateTime($birthdate);
$date2 = new DateTime(date("Y-m-d"));
$interval = $date1->diff($date2);
$age =  $interval->y ."y, ".$interval->m."m, ".$interval->d."d"; 
// ---------------------------




// --------- EMR TABLE ---------
$sql2y = "SELECT hfhudcode FROM genInfoClassification";
$result2y = $connEMR->query($sql2y);
while($row2y = $result2y->fetch_assoc()){
$hfhudcode = $row2y['hfhudcode'];
}

$sql2y = "SELECT * from newborn where caseno='$caseno'";
$result2y = $connEMR->query($sql2y);
while($row2y = $result2y->fetch_assoc()){
$nbcode = $row2y['code'];
if($nbcode=="9"){$nb = "WELL BABY";}
if($nbcode=="8"){$nb = "SICK BABY";}
}

$sql2y = "SELECT * from typeofbirth where caseno='$caseno'";
$result2y = $connEMR->query($sql2y);
while($row2y = $result2y->fetch_assoc()){
$tob = $row2y['typeofbirth'];
}

$sql2y = "SELECT * from transfers where caseno='$caseno'";
$result2y = $connEMR->query($sql2y);
while($row2y = $result2y->fetch_assoc()){
$hospital = $row2y['hospital'];
$reasoning = $row2y['reason'];
}
// ----------------------------
$fd =" &#x267F; Please Enter here....";


if(isset($_POST['btn_save'])){
  $healthcode = $_POST['hfc'];
  $gender = $_POST['gender'];
  $age = $_POST['age'];
  $type = $_POST['type'];
  $datereport = $_POST['datereport'];
  $patientadmit = $_POST['patientadmit'];
  $pathonone = $_POST['pathonone'];
  $typeofbirth = $_POST['typeofbirth'];
  $disposition = $_POST['disposition'];
  $ifdied = $_POST['ifdied'];
  $iftransfer = $_POST['iftransfer'];
  $iftransferreason = $_POST['iftransferreason'];
  $finaldx = $_POST['finaldx'];
  $icd = $_POST['icd'];
  $doctor = $_POST['doctor'];
  $specialty = $_POST['specialty'];
  list($desc, $icdcode) = explode("_", $icd);
  
  
  $sql2x = "SELECT phicacc1,code from docfile  where name='$doctor'";
  $result2x = $conn->query($sql2x);
  $checkaddinfo = mysqli_num_rows($result2x);
  while($row2x = $result2x->fetch_assoc()){
  $code1 = $row2x['code'];
  $phicacc1 = $row2x['phicacc1'];
  }
  
  // ----------------- EMR TABLE -----------------------
  $sqlb1 = "delete from patienthospOptDischargesNumberDeliveries where caseno='$caseno'";
  if($connEMR->query($sqlb1) === TRUE){echo"1";}
  
  $sqlb2 = "delete from patienthospOptDischargesMorbidity where patientidno='$caseno'";
  if($connEMR->query($sqlb2) === TRUE){echo"2";}
  
  $sqlb3 = "delete from specialtycaseno where caseno='$caseno'";
  if($connEMR->query($sqlb3) === TRUE){echo"3";}
  
  
  $sqlb4 = "delete from transfers where caseno = '$caseno' and status not like '%ingoing%'";
  if($connEMR->query($sqlb4) === TRUE){echo"4";}
  
  $sqlb5 = "delete from patienthospitalOperationsDeaths where caseno = '$caseno'";
  if($connEMR->query($sqlb5) === TRUE){echo"5";}
  
  $sqlb6 = "delete from patienthospOptDischargesMorbidity where patientidno = '$caseno'";
  if($connEMR->query($sqlb6) === TRUE){echo"6";}
  
  $sqlb7 = "delete from patienthospitalOperationsMortalityDeaths where patientidno = '$patientidno'";
  if($connEMR->query($sqlb7) === TRUE){echo"7";}
  
  $sqlb8 = "delete from typeofdeath where patientidno='$patientidno'";
  if($connEMR->query($sqlb8) === TRUE){echo"8";}
  
  $sqlb9 = "delete from newborn where caseno = '$caseno'";
  if($connEMR->query($sqlb9) === TRUE){echo"9";}
  
  $sqlb10 = "delete from typeofbirth where caseno = '$caseno'";
  if($connEMR->query($sqlb10) === TRUE){echo"10";}
  
  $sqlb11 = "delete from newborn where caseno = '$caseno'";
  if($connEMR->query($sqlb11) === TRUE){echo"11";}
  
  $sqlb12 = "delete from newborn where caseno = '$caseno'";
  if($connEMR->query($sqlb12) === TRUE){echo"12";}
  
  $sqlb13 = "delete from newborn where caseno = '$caseno'";
  if($connEMR->query($sqlb13) === TRUE){echo"13";}
  
  
  $sqlb14 = "insert into specialtycaseno values ('$caseno','$specialty','$code1')";
  if($connEMR->query($sqlb14) === TRUE){echo"14";}
  
  
  if($patientadmit == "NEWBORN"){
  $sqlb15 = "INSERT INTO  newborn values ('$caseno','$pathonone')";
  if($connEMR->query($sqlb15) === TRUE){echo"15";}
  
  $sqlb16 = "INSERT INTO  typeofbirth values ('$caseno','$typeofbirth')";
  if($connEMR->query($sqlb16) === TRUE){echo"16";}
  }
  
  if($disposition == "TRANSFERRED"){
  $sqlb17 = "INSERT INTO `transfers`(`caseno`, `status`, `hospital`, `reason`, `dateoftransfer`, `census`) values ('$caseno', 'outgoing', '$iftransfer', '$iftransferreason', CURDATE(), '1')";
  if($connEMR->query($sqlb17) === TRUE){echo"17";}
  $munder1=0; 
  if($sex == "MALE"){
  if($age <= 0){$munder1= "1";}
  if($age >= 1 and $age <= 4){$m1to4 = "1";}
  if($age >= 5 and $age <= 9){$m5to9= "1";}
  if($age >= 10 and $age <= 14){$m10to14 = "1";}
  if($age >= 15 and $age <= 19){$m15to19= "1";}
  if($age >= 20 and $age <= 24){$m20to24 = "1";}
  if($age >= 25 and $age <= 29){$m25to29= "1";}
  if($age >= 30 and $age <= 34){$m30to34 = "1";}
  if($age >= 35 and $age <= 39){$m35to39 = "1";}
  if($age >= 40 and $age <= 44){$m40to44= "1";}
  if($age >= 45 and $age <= 49){$m45to49 = "1";}
  if($age >= 50 and $age <= 54){$m50to54 = "1";}
  if($age >= 55 and $age <= 59){$m55to59= "1";}
  if($age >= 60 and $age <= 64){$m60to64 = "1";}
  if($age >= 65 and $age <= 69){$m65to69 = "1";}
  if($age >= 70){$m70over= "1";}
  }
  
  if($sex == "FEMALE"){
  if($age<=0){$funder1= "1";}
  if($age >= 1 and $age <= 4){$f1to4 = "1";}
  if($age >= 5 and  $age <= 9){$f5to9= "1";}
  if($age >= 10 and $age <= 14){$f10to14 = "1";}
  if($age >= 15 and $age <= 19){$f15to19= "1";}
  if($age >= 20 and $age <= 24){$f20to24 = "1";}
  if($age >= 25 and $age <= 29){$f25to29= "1";}
  if($age >= 30 and $age <= 34){$f30to34 = "1";}
  if($age >= 35 and $age <= 39){$f35to39 = "1";}
  if($age >= 40 and $age <= 44){$f40to44= "1";}
  if($age >= 45 and $age <= 49){$f45to49 = "1";}
  if($age >= 50 and $age <= 54){$f50to54 = "1";}
  if($age >= 55 and $age <= 59){$f55to59= "1";}
  if($age >= 60 and $age <= 64){$f60to64 = "1";}
  if($age >= 65 and $age <= 69){$f65to69 = "1";}
  if($age >= 70){$f70over= "1";}
  }
  
  $sqlb18 = "insert into patienthospOptDischargesMorbidity values ('$desc','$munder1','$funder1','$m1to4','$f1to4','$m5to9','$f5to9','$m10to14','$f10to14','$m15to19','$f15to19','$m20to24',
  '$f20to24','$m25to29','$f25to29','$m30to34','$f30to34','$m35to39','$f35to39','$m40to44','$f40to44','$m45to49','$f45to49','$m50to54','$f50to54','$m55to59','$f55to59','$m60to64','$f60to64',
  '$m65to69','$f65to69','$m70over','$f70over','$msubtotal','$fsubtotal','$grandtotal','$icd10code','$icd10category','$datereport','$caseno','$branch','$discharged','PENDING')";
  if($connEMR->query($sqlb18) === TRUE){echo"18";}
  }
  
  
  if($disposition == "DIED"){
  $sqlb19 = "delete from patienthospOptDischargesMorbidity where patientidno='$caseno'";
  if($connEMR->query($sqlb19) === TRUE){echo"19";}
  
  $sqlb20 = "insert into typeofdeath values ('$patientidno','$ifdied')";
  if($connEMR->query($sqlb20) === TRUE){echo"20";}
  
  if($sex == "Male"){
  if($age <= 0){$munder1= "1";}
  if($age >= 1 and $age <= 4){$m1to4 = "1";}
  if($age >= 5 and $age <= 9){$m5to9= "1";}
  if($age >= 10 and $age <= 14){$m10to14 = "1"; }
  if($age >= 15 and $age <= 19){$m15to19= "1";}
  if($age >= 20 and $age <= 24){$m20to24 = "1";}
  if($age >= 25 and $age <= 29){$m25to29= "1";}
  if($age >= 30 and $age <= 34){$m30to34 = "1";}
  if($age >= 35 and $age <= 39){$m35to39 = "1";}
  if($age >= 40 and $age <= 44){$m40to44= "1";}
  if($age >= 45 and $age <= 49){$m45to49 = "1";}
  if($age >= 50 and $age <= 54){$m50to54 = "1";}
  if($age >= 55 and $age <= 59){$m55to59= "1";}
  if($age >= 60 and $age <= 64){$m60to64 = "1";}
  if($age >= 65 and $age <= 69){$m65to69 = "1";}
  if($age >= 70){$m70over= "1";}
  }
  
  if($sex == "FEMALE"){
  if($age<=0){$funder1= "1";}
  if($age >= 1 and $age <= 4){$f1to4 = "1";}
  if($age >= 5 and $age <= 9){$f5to9= "1";}
  if($age >= 10 and $age <= 14){$f10to14 = "1";}
  if($age >= 15 and $age <= 19){$f15to19= "1";}
  if($age >= 20 and $age <= 24){$f20to24 = "1";}
  if($age >= 25 and $age <= 29){$f25to29= "1";}
  if($age >= 30 and $age <= 34){$f30to34 = "1";}
  if($age >= 35 and $age <= 39){$f35to39 = "1";}
  if($age >= 40 and $age <= 44){$f40to44= "1";}
  if($age >= 45 and $age <= 49){$f45to49 = "1";}
  if($age >= 50 and $age <= 54){$f50to54 = "1";}
  if($age >= 55 and $age <= 59){$f55to59= "1";}
  if($age >= 60 and $age <= 64){$f60to64 = "1";}
  if($age >= 65 and $age <= 69){$f65to69 = "1";}
  if($age >= 70){$f70over= "1";}
  }
  
  $sqlb21 = "insert into patienthospitalOperationsMortalityDeaths values ('$desc','$munder1','$funder1','$m1to4','$f1to4','$m5to9','$f5to9','$m10to14','$f10to14','$m15to19','$f15to19','$m20to24',
  '$f20to24','$m25to29','$f25to29','$m30to34','$f30to34','$m35to39','$f35to39','$m40to44','$f40to44','$m45to49','$f45to49','$m50to54','$f50to54','$m55to59','$f55to59','$m60to64','$f60to64',
  '$m65to69','$f65to69','$m70over','$f70over','$msubtotal','$fsubtotal','$grandtotal','$icd10code','$icd10category','$datereport','$caseno,'$branch','$discharged','PENDING')";
  if($connEMR->query($sqlb21) === TRUE){echo"21";}
  }
  // ----------------------------- END EMR TABLE ----------------------------
  
  $sqlx = "update admission set finaldiagnosis = '$finaldx', disposition= '$disposition', patientadmit = '$patientadmit'  where caseno='$caseno'";
  if($conn->query($sqlx) === TRUE){echo"INSERT FINAL DIAGNOSIS!";}

  $conn->query("INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('update Final Diagnosis [$caseno - $patientname]', '$user', CURDATE(), CURTIME())");
  
  echo"<script>alert('Successfully Saved!'); window.location='?finaldx&caseno=$caseno$datax';</script>";
  }
?>


<main id="main" class="main">

    <div class="pagetitle">
      <h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="?main">Main</a></li>
          <li class="breadcrumb-item"><a href="?detail&caseno=<?php echo $caseno ?>">Patient Information</a></li>
          <li class="breadcrumb-item"><a href="?finaldx&caseno=<?php echo $caseno ?>">Set  Final Diagnosis</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="../main/img/boy.png" alt="Profile" class="rounded-circle" style="width: 120px;"><p></p>
              <h5><b><?php echo ucwords(strtolower($patientname)) ?></b></h5>
              <p align="center" style="font-size: 12px;"><?php echo $address ?></p>
              
                        
                            
              <table width="100%">
              <tr><td colspan="2"><hr style="border: 2px solid red; border-radius: 5px;"></td></tr>
              <tr>
              <td width="30%" style="font-size: 10px;"><i class="bi bi-bar-chart-line"></i> Initial Diagnosis: :</font></td>
              <td style="font-size: 10px;"><b><?php echo $initialdiagnosis ?></b></font></td>
              </tr>
              <tr>
              <td style="font-size: 10px;"><i class="bi bi-bar-chart-line"></i> Remarks :</font></td>
              <td style="font-size: 10px;"><b><?php echo $remarks ?></b></font></td>
              </tr>
              <tr><td colspan="2"><hr style="border: 2px solid red; border-radius: 5px;"></td></tr>
              </table>
              
              
                            <div class="d-flex align-items-start" style="width: 100%;">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><font size="2%">H-Info</font></button>
                  <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><font size="2%">P-Info</font></button>
                </div>
                
                
                <div class="tab-content" id="v-pills-tabContent">
                  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                  
                  <table width="100%">
                  <tr>
                  <td><font size="1%"><i class="bi bi-upc-scan"></i> PRN :</font></td>
                  <td><font size="1%"><b><?php echo $patientidno ?></b></font></td>
                  </tr>
                  <tr>
                  <td><font size="1%"><i class="bi bi-box-seam"></i> GCN :</font></td>
                  <td><font size="1%"><b><?php echo $caseno ?></b></font></td>
                  </tr>
                  <tr>
                  <td><font size="1%"><i class="bi bi-calendar-date-fill"></i> HCN :</font></td>
                  <td><font size="1%"><b><?php echo $employerno ?></b></font></td>
                  </tr>
                  <tr>
                  <td><font size="1%"><i class="bi bi-building"></i> ROOM :</font></td>
                  <td><font size="1%"><b><?php echo $room ?></b></font></td>
                  </tr>
                  <tr>
                  <td><font size="1%"><i class="bi bi-person-square"></i> ATTENDING :</font></td>
                  <td><font size="1%"><b><?php echo $ap ?></b></font></td>
                  </tr>
                  <tr>
                  <td><font size="1%"><i class="bi bi-person-circle"></i> ADMITTING :</font></td>
                  <td><font size="1%"><b><?php echo $ad ?></b></font></td>
                  </tr>
                  <tr>
                  <td><font size="1%"><i class="bi bi-calendar-day-fill"></i> DATE ADMIT :</font></td>
                  <td><font size="1%"><b><?php echo $dateadmitted ?></b></font></td>
                  </tr>
                  <tr>
                  <td><font size="1%"><i class="bi bi-clock-history"></i> TIME ADMIT :</font></td>
                  <td><font size="1%"><b><?php echo date("h:i:s a", strtotime($timeadmitted)); ?></b></font></td>
                  </tr>
                  <tr>
                  <td><font size="1%"><i class="bi bi-calendar-month-fill"></i> DATE DISCH.. :</font></td>
                  <td><font size="1%"><b><?php echo $datedischarged ?></b></font></td>
                  </tr>
                  <tr>
                  <td><font size="1%"><i class="bi bi-clock"></i> TIME DISCH.. :</font></td>
                  <td><font size="1%"><b><?php echo $timedischarged; ?></b></font></td>
                  </tr>
                  <tr>
                  <td><font size="1%"><i class="bi bi-bar-chart-line"></i> STATUS :</font></td>
                  <td><font size="1%"><b><?php echo $statusxx ?></b></font></td>
                  </tr>
                  <tr>
                  <td><font size="1%"><i class="bi bi-bar-chart-line"></i> PHILHEALTH :</font></td>
                  <td><font size="1%"><b><?php echo $membership ?></b></font></td>
                  </tr>
                  <tr>
                  <td><font size="1%"><i class="bi bi-bar-chart-line"></i> HMO :</font></td>
                  <td><font size="1%"><b><?php echo $hmo ?></b></font></td>
                  </tr>
                  </table>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  </div>
                  <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <table width="100%">
                  <tr>
                  <td><font size="1%"><i class="bi bi-graph-up"></i> AGE :</font></td>
                  <td><font size="1%"><b><?php echo $age ?></b></font></td>
                  </tr>
                  <tr>
                  <td><font size="1%"><i class="bi bi-gender-ambiguous"></i> GENDER :</font></td>
                  <td><font size="1%"><b><?php echo $sex ?></b></font></td>
                  </tr>
                  <tr>
                  <td><font size="1%"><i class="bi bi-bar-chart-line"></i> SENIOR :</font></td>
                  <td><font size="1%"><b><?php echo $senior ?></b></font></td>
                  </tr>
                  <tr>
                  <td><font size="1%"><i class="bi bi-calendar2-month"></i> BIRTHDATE :</font></td>
                  <td><font size="1%"><b><?php echo $birthdate ?></b></font></td>
                  </tr>
                  </table>
                  </div>
                </div>
              </div>
              
              
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">


            <b><i class='icofont-patient-file'></i> Set Final Diagnosis</b><hr>
<form method="POST"  onSubmit="return fdx();">
<div class="panel panel-default" width="100%">
<table width="100%" align="center"><tr><td width="49%" valign="TOP">



<br><br>
<div class='card' style='box-shadow: 0px 0px 0px 1px lightgrey;'>
<div class='card-body'>
<div class='d-flex align-items-center justify-content-between mt-5'>
<div class='lesson_name'>
<div class='project-block light-primary-bg'>
<i class='icofont-undo'></i>
</div>
<span class='small project_name fw-bold'> Patient record </span>
</div>
</div>
 
<table width="100%" align="center">
<tr style="display: none;">
<td style="font-size: 12px;">Health Facility Code:</td>
<td><input type="text" name="hfc" class="form-control" value="<?php echo $hfhudcode ?>" style="height:35px; font-size:10pt; color: black;" readonly></td>
</tr>

<tr style="display: none;">
<td>Age:</td>
<td><input type="text" name="age" value="<?php echo $age2 ?>" style="height:35px; font-size:10pt; color: black;" readonly></td>
</tr>

<tr style="display: none;">
<td>Gender:</td>
<td><input type="text" name="gender" value="<?php echo $sex ?>" style="height:35px; font-size:10pt; color: black;" readonly></td>
</tr>

<tr style="display: none;">
<td>Type:</td>
<td><input type="text" name="type" value="<?php echo $ward ?>" style="height:35px; font-size:10pt; color: black; background: white; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e; " readonly></td>
</tr>

</td>
<tr>
<td width="35%" style="font-size: 12px;">Reporting Date:<br>
<input type="date" name="datereport" value="<?php echo date('Y-m-d'); ?>" style="width: 100%; height:35px; font-size:10pt; color: black; background: white; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e;" required></td>
</tr>

<tr>
<td style="font-size: 12px;">How the Patient was admitted:<br>
<select name="patientadmit" id="patientadmit" class="select" style="height:35px; font-size:10pt; color: black; width: 100%; background: white; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e;" onchange="loadd();" required>
<option value="<?php echo $patientadmit ?>"><?php echo $patientadmit ?></option>
<option value="Ambulatory">Ambulatory</option>
<option value="Stretcher">Stretcher</option>
<option value="Wheel Chair">Wheel Chair</option>
<option value="Carried by Rel.">Carried by Rel.</option>
<option value="NEWBORN">NEWBORN</option>
</select>
</td>
</tr>

<tr id="ifnewborn1" style="display: none;">
<td style="text-align: right;"><font color="red" size="1">Newborn Status:<br>
<select name="pathonone" id="pathonone" style="height:35px; font-size:10pt; color: black; width: 100%; background: white; box-shadow: 0 0 5px #f79d9d; border: 1px solid #ec2828;">
<option value="<?php echo $nb ?>"><?php echo $nb ?></option>
<option value="9">WELL BABY</option>
<option value="8">SICK BABY</option>
</select>
</td>
</tr>

<tr id="ifnewborn2" style="display: none;">
<td style="text-align: right;"><font color="red" size="1">Type of Birth:<br>
<select name='typeofbirth' id='typeofbirth' style="height:35px; font-size:10pt; color: black; width: 100%; background: white; box-shadow: 0 0 5px #f79d9d; border: 1px solid #ec2828;">
<option value="<?php echo $tob ?>"><?php echo $tob ?></option>
<option>NORMAL</option>
<option>CAESARIAN</option>
<option>OTHERS</option>
</select>
</td>
</tr>

<tr>
<td style="font-size: 12px;">Disposition:<br>
<select name="disposition" id="disposition" class="select" style="height:35px; font-size:10pt; color: black; width: 100%; background: white; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e;" onchange="loadd();" required>
<option value="<?php echo $disposition ?>"><?php echo $disposition2 ?></option>
<option value="IMPROVED">IMPROVED</option>
<option value="HAMA">HAMA</option>
<option value="ABSCONDED">ABSCONDED</option>
<option value="TRANSFERRED">TRANSFERRED</option>
<option value="DIED">EXPIRED</option>
</select>
</td>
</tr>

<tr id="ifdied2" style="display: none;">
<td style="text-align: right;"><font color="red" size="1">IF DIED, SELECT TYPE OF DEATH:<br>
<select name="ifdied" id="ifdied" class="select" style="height:35px; font-size:10pt; color: black; width: 100%; background: white; box-shadow: 0 0 5px #ee7ee4; border: 1px solid #a11f95;">
<option value="<?php echo $typeofdeath ?>"><?php echo $typeofdeath ?></option>
<option value="ADULT/PEDIA">ADULT/PEDIA</option>
<option value="STILLBIRTHS">STILLBIRTHS</option>
<option value="NEONATAL">NEONATAL</option>
<option value="MATERNAL">MATERNAL</option>
</select>
</td>
</tr>

<tr id="iftransfer1" style="display: none;">
<td style="text-align: right;"><font color="red" size="1">IF TRANSFER, NAME OF HOSPITAL:<br>
<input type="text" name="iftransfer" id="iftransfer" style="height:35px; font-size:10pt; color: black; width: 100%; background: white; box-shadow: 0 0 5px #96f396; border: 1px solid #1e851e;" value="<?php echo $hospital ?>"></td>
</tr>

<tr id="iftransfer2" style="display: none;">
<td style="text-align: right;"><font color="red" size="1">REASON OF TRANSFER:<br>
<input type="text" name="iftransferreason" id="iftransferreason" style="height:35px; font-size:10pt; color: black; width: 100%; background: white; box-shadow: 0 0 5px #96f396; border: 1px solid #1e851e;" value="<?php echo $reasoning ?>"></td>
</tr>
</table>
</div>
</div>

</td><td width="2%"></td><td valign="TOP">

<br><br>
<div class='card' style='box-shadow: 0px 0px 0px 1px lightgrey;'>
<div class='card-body'>
<div class='d-flex align-items-center justify-content-between mt-5'>
<div class='lesson_name'>
<div class='project-block light-danger-bg'>
<i class='icofont-file-document'></i>
</div>
<span class='small project_name fw-bold'> Electronic Medical Records</span>
</div>
</div>
<table width="100%" align="center">
<tr>
<td style="font-size: 12px;">ICD 10:<br>
<input list="ptid" name="icd" oninput="ptid(this.value);" placehoder="Search by Description.." style="height:35px; font-size:10pt; color: black; width: 100%; background: white; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e;">
<datalist id="ptid">
<?php
$sqlccv = "SELECT * FROM ricd10";
$resultccv = $connEMR->query($sqlccv);
while($rowccv = $resultccv->fetch_assoc()){
$icddesc=$rowccv['icd10desc'];
$icdcode=$rowccv['icd10code'];
$icd = $icddesc."_".$icdcode;
echo"<option value='$icd'></option>";
}
?>
</datalist>
</td>
</tr>

<tr>
<td style="font-size: 12px;">Doctor:<br>
<select name="doctor" id="select2SinglePlaceholder" style="height:35px; font-size:10pt; color: black; width: 100%; background: white; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e;" required>
<option value='<?php echo $ap ?>'><?php echo $ap ?></option>
<?php
$sql2yy = "SELECT * FROM docfile order by name";
$result2yy = $conn->query($sql2yy);
while($row2yy = $result2yy->fetch_assoc()){
$dname = $row2yy['name'];
echo"<option value='$dname'>$dname</option>";
}
?>
</select>
</td>
</tr>

<tr>
<td style="font-size: 12px;">Specialty:<br>
<select name="specialty" style="height:35px; font-size:10pt; color: black; width: 100%; background: white; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e;" required>
<option value=''></option>
<?php
$sql2yy = "SELECT tscode,tsdesc FROM rtservice where tscode between '1' and '6'  order by tscode asc";
$result2yy = $connEMR->query($sql2yy);
while($row2yy = $result2yy->fetch_assoc()){
$tscode= $row2yy['tscode'];
$tsdesc= $row2yy['tsdesc'];
echo"<option value='$tscode'>$tsdesc</option>";
}
?>
</select>
</td>
</tr>
</table>
</div>
</div>


</td>
</tr>
</table><br>

<div class="card" style='box-shadow: 0px 0px 0px 1px #4B54B2;'>
<div class="card-header" style="background-color: #4B54B2; padding: 7px; color: white;">FINAL DIAGNOSIS</div>
<div class="card-body">

<div class="form-floating">
<textarea class="form-control" placeholder="Address" id="floatingTextarea" name="finaldx" onkeydown="if(event.keyCode == 13){return false;}" style="resize: none; height:200px; font-size:10pt; background: white; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e;"><?php echo $finaldiagnosis ?></textarea>
<label for="floatingTextarea"><font color="blue"><?php echo $fd ?></label>
</div>

</div></div>
<hr>
<p align='right'><button type="submit" name="btn_save" class="btn btn-primary btn-sm"> Submit <i class="icofont-arrow-right"></i></button></p>


</form>














            
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->



  <script>
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 5000); // Change image every 2 seconds
}

function loadd(){
var val = document.getElementById("disposition").value;
if(val=="DIED"){
document.getElementById("ifdied2").style.display="";
document.getElementById("iftransfer1").style.display="none";
document.getElementById("iftransfer2").style.display="none";
}

else if(val=="TRANSFERRED"){
document.getElementById("iftransfer1").style.display="";
document.getElementById("iftransfer2").style.display="";
document.getElementById("ifdied2").style.display="none";
}

else{
document.getElementById("iftransfer1").style.display="none";
document.getElementById("iftransfer2").style.display="none";
document.getElementById("ifdied2").style.display="none";
}

var val2 = document.getElementById("patientadmit").value;
if(val2=="NEWBORN"){
document.getElementById("ifnewborn1").style.display="";
document.getElementById("ifnewborn2").style.display="";
}else{
document.getElementById("ifnewborn1").style.display="none";
document.getElementById("ifnewborn2").style.display="none";
}
}
</script>