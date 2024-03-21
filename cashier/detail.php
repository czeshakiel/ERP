<?php
$_SESSION['homemeds']='';
include "../chargecart/cartmodal.php";

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
?>


<main id="main" class="main">

    <div class="pagetitle">
      <h1><?php echo strtoupper($dept)." DEPARTMENT" ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="?view=main">Main</a></li>
          <li class="breadcrumb-item"><a href="?view=detail&caseno=<?php echo $caseno ?>">Patient Information</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="../mainpage/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"><p></p>
              <h5><b><?php echo $patientname ?></b></h5>
              <p align="center" style="font-size: 12px;"><?php echo $address ?></p>
              
              <div class="btn-group" role="group" aria-label="Basic outlined example">
                <a href='http://<?php echo $ip ?>/iHIS/chargecart/cart.php?caseno=<?php echo $caseno ?>' target='tabiframe'><button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#cart"><i class="ri-shopping-cart-2-line"></i> Charge Cart</button></a>
                 <a href='../chargecart/carthm.php?caseno=<?php echo $caseno ?>&batchno=<?php echo $bbno ?>' target='tabiframehm'><button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#carthm"><i class="ri-medicine-bottle-fill"></i> Home Meds</button></a>
              </div>
              
              <table width="100%">
               <tr><td><hr style="border: 2px solid red; border-radius: 5px;"></td></tr>
              <tr><td><p style="font-size: 12px;"><b>Initial Diagnosis:</b> <?php echo $initialdiagnosis ?></p></td></tr>
              <tr><td><p style="font-size: 12px;"><b>Final Diagnosis:</b> <?php echo $finaldiagnosis ?></p></td></tr>
              <tr><td><p style="font-size: 12px;"><b>Remarks:</b> <?php echo $remarks ?></p></td></tr>
              <tr><td><hr style="border: 2px solid red; border-radius: 5px;"></td></tr>
              </table>
              
              
                            <div class="d-flex align-items-start" style="width: 100%;">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><font size="2%">H-Info</font></button>
                  <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><font size="2%">P-Info</font></button>
                  <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"><font size="2%">PHIC & HMO</font></button>
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
                  <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <table width="100%">
                  <tr>
                  <td><font size="1%"><i class="bi bi-bar-chart-line"></i> PHILHEALTH :</font></td>
                  <td><font size="1%"><b><?php echo $membership ?></b></font></td>
                  </tr>
                  <tr>
                  <td><font size="1%"><i class="bi bi-bar-chart-line"></i> HMO :</font></td>
                  <td><font size="1%"><b><?php echo $hmo ?></b></font></td>
                  </tr>
                  <tr>
                  <td><font size="1%"><i class="bi bi-bar-chart-line"></i> CREDIT LIMIT :</font></td>
                  <td><font size="1%"><b><?php echo number_format($creditlimit1,2); ?></b></font></td>
                  </tr>
                  <tr>
                  <td><font size="1%"><i class="bi bi-bar-chart-line"></i> CEDIT USED :</font></td>
                  <td><font size="1%"><b><?php echo number_format($gross,2); ?></b></font></td>
                  </tr>
                  <tr>
                  <td><font size="1%"><i class="bi bi-bar-chart-line"></i> CEDIT BALANCE :</font></td>
                  <td><font size="1%"><b><?php echo number_format($creditlimit,2); ?></b></font></td>
                  </tr>
                  <tr>
                  <td><font size="1%"><i class="bi bi-bar-chart-line"></i> LOA LIMIT :</font></td>
                  <td><font size="1%"><b><?php echo number_format($loa1,2) ?></b></font></td>
                  </tr>
                  <tr>
                  <td><font size="1%"><i class="bi bi-bar-chart-line"></i> LOA USED :</font></td>
                  <td><font size="1%"><b><?php echo number_format($grosshmo,2); ?></b></font></td>
                  </tr>
                  <tr>
                  <td><font size="1%"><i class="bi bi-bar-chart-line"></i> LOA BALANCE :</font></td>
                  <td><font size="1%"><b><?php echo number_format($loa1-$grosshmo,2); ?></b></font></td>
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
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#p1"><font size="2%"><i class="ri-medicine-bottle-line"></i> Medicine</font></button>
                </li>
                
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#p2"><font size="2%"><i class="ri-surgical-mask-line"></i> Supplies</font></button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#p3"><font size="2%"><i class="ri-flask-fill"></i> Laboratories</font></button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#p4"><font size="2%"><i class="ri-secure-payment-line"></i> Charges</font></button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#p5"><font size="2%"><i class="ri-arrow-go-back-fill"></i> Return</font></button>
                </li>
                
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#p6"><font size="2%"><i class="ri-file-damage-line"></i> Damage</font></button>
                </li>
                
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#p7"><font size="2%"><i class="ri-close-circle-line"></i> Cancelled</font></button>
                </li>

              </ul>
              <div class="tab-content pt-2">

<div class="tab-pane fade show active p1" id="p1"><?php include "../ns/details/med.php"; ?></div>
<div class="tab-pane fade show pt-3" id="p2"><?php include "../ns/details/sup.php"; ?></div>
<div class="tab-pane fade show pt-3" id="p3"><?php include "../ns/details/lab_xray.php"; ?></div>
<div class="tab-pane fade show pt-3" id="p4"><?php include "../ns/details/othercharges.php"; ?></div>
<div class="tab-pane fade show pt-3" id="p5"><?php include "../ns/details/return.php"; ?></div>
<div class="tab-pane fade show pt-3" id="p6"><?php include "../ns/details/damage.php"; ?></div>
<div class="tab-pane fade show pt-3" id="p7"><?php include "../ns/details/cancelled.php"; ?></div>               

                
              
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

