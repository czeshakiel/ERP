<?php
include "../main/class.php";
include "../main/header.php";
$dept=$_GET['dept'];
$user=$_GET['user'];
$userunique=$_GET['username'];
$_SESSION['userunique']=$userunique;
$_SESSION['username']=$user;
$_SESSION['dept']=$dept;
$_SESSION['verifyuser']=true;
if($dept=='ADMISSION'){$st="admission"; $dist="username";}
if($dept=='OPD'){$st="opd"; $dist="username";}
if($dept=='ER'){$st="er"; $dist="username";}
if($dept=='NS1' || $dept=='NS2' || $dept=='NS3'){$st="ns"; $dist="username";}
if($dept=='PHARMACY'){$st="pharmacy"; $dist="username";}
if($dept=='BILLING'){$st="billing"; $dist="nursename";}
if($dept=='HMO'){$st="hmo"; $dist="username";}

if($dept=='NS1' || $dept=='NS2' || $dept=='NS3' || $dept=='NS 4' || $dept=='NS 5A' || $dept=='NS 5B' || $dept=='NS 6' || $dept=='SCU'){
$locx = "http://$ip/arv2020/nsstation/index.php?dept=$dept&username=$user&branch=$branch&userunique=$userunique&view=main";
}
elseif($dept=='OR' || $dept=='ENDOSCOPY'){
$locx = "http://$ip/arv2020/nsstation/index.php?dept=$dept&username=$user&branch=$branch&userunique=$userunique&view=ormain";
}
elseif($dept=='PHARMACY' || $dept=='PHARMACY_OPD' || $dept=='pharmacy_opd' || $dept=='csr2' || $dept=='CSR2'){
$locx = "http://$ip/arv2020/pharmacy/index.php?dept=$dept&username=$user&branch=$branch&userunique=$userunique&view=main";
}
else{
$locx = "http://$ip/aboy2020/pages/$st/?main&dept=$dept&$dist=$user&userunique=$userunique&station10=$dept&branch=$branch";
}

$sql2 = "SELECT `maindept`, `subdept1`, `subdept2`, `subdept3` FROM `department` WHERE `maindept`='$dept'";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$mt=$row2['maindept'];
$s1=$row2['subdept1'];
$s2=$row2['subdept2'];
$s3=$row2['subdept3'];
$s4 = "PHARMACY_OPD";
$s5 = "CSR2";
}
?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

.bg-black {
    background-color: #000;
}

#logo {
    width: 30px;
    height: 30px;
    border-radius: 4px;
}

.navbar-brand {
    padding: 14px 20px;
    font-size: 16px;
}

.navbar-nav {
    width: 100%;
}

.nav-item {
    padding: 6px 14px;
    text-align: center;
}

.nav-link {
    padding-bottom: 10px;
}

.v-line {
    background-color: gray;
    width: 1px;
    height: 20px;
}

.navbar-collapse.collapse.in {
    display: block !important;
}

@media (max-width: 576px) {
    .nav-item {
        width: 100%;
        text-align: left;
    }

    .v-line {
        display: none;
    }
}




.box {
  position:relative;
  width: 100%;
  height: 530px;
  margin: 5px auto 0 auto;
}
.box-gradient {
  position:absolute;
  width:100%;
  height:100%;
  border-radius:10px;
  -moz-border-radius:10px;
  -webkit-border-radius:10px;
  background: -moz-linear-gradient(left, #CCCCCC 0%, #EEEEEE 50%, #EEEEEE 50%, #CCCCCC 100%);
  background: -webkit-gradient(linear, left top, right top, color-stop(0%,#CCCCCC),color-stop(50%,#EEEEEE), color-stop(50%,#EEEEEE), color-stop(100%,#CCCCCC));
}
.box-shadow {
  position:absolute;
  left:50%;
  margin:400px 0 0 -290px;
  bottom:10px;
  width:580px;
  height:16px;
  background:#fff;
  border-radius:290px / 8px;
  -moz-border-radius:290px / 8px;
  -webkit-border-radius:290px / 8px;
  box-shadow:0 10px 20px #000;
  -moz-box-shadow:0 10px 20px #000;
  -webkit-box-shadow:0 10px 20px #000;
}
</style>

<div class="container-fluid px-0" style="padding-left: 20px;padding-right: 20px;">
  <nav class="navbar navbar-expand-sm navbar-dark bg-black py-0 px-0" style="border-radius: 10px;">
    <a class="navbar-brand" href="#"><!-- img id="logo" src="../main/img/ad.png" --><i class="icofont-ui-cart" style="font-size: 20px;"></i> &nbsp;&nbsp;&nbsp;MY CART</a>
    <span class="v-line"></span>
    <button class="navbar-toggler mr-3" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">

        <li class="nav-item active"><a class="nav-link" href="../extra/CartBeta/?caseno=<?php echo $caseno ?>&ct=sot&dept=<?php echo $dept ?>&user=<?php echo $userunique ?>&xix" target="tabiframecart"><i class="icofont-hospital"></i> Charges</a></li>
        <?php /*if($mt=="$dept") { ?><!-- li class="nav-item"><a class="nav-link" href="../extra/Cart/?caseno=<?php echo $caseno ?>&toh=<?php echo $mt ?>&station=<?php echo $dept ?>" target="tabiframecart"><i class="icofont-patient-bed"></i> <?php echo $dept ?></a></li --><?php }*/ ?>
        <?php if($mt=="$dept") { ?><li class="nav-item"><a class="nav-link" href="../extra/CartBeta/?caseno=<?php echo $caseno ?>&ct=eca&dept=<?php echo $dept ?>&user=<?php echo $userunique ?>&xix" target="tabiframecart"><i class="icofont-patient-bed"></i> <?php echo $dept ?></a></li><?php } ?>
        <?php if($dept=="RDU") { ?><li class="nav-item"><a class="nav-link" href="../extra/Cart/?caseno=<?php echo $caseno ?>&toh=RDU_MANUAL&station=<?php echo $dept ?>" target="tabiframecart"><i class="icofont-paralysis-disability"></i> RDU</a></li><?php } ?>
        <?php if($s2=="PHARMACY") { ?><li class="nav-item"><a class="nav-link" href="../extra/CartBeta/?caseno=<?php echo $caseno ?>&ct=phm&dept=<?php echo $dept ?>&user=<?php echo $userunique ?>&xix" target="tabiframecart"><i class="icofont-medicine"></i> Pharmacy</a></li><?php } ?>
        <?php if($wardx=="OUTPATIENT" or $dept=="PHARMACY_OPD") { ?>
          <li class="nav-item"><a class="nav-link" href="http://<?php echo $ip ?>/cgi-bin/profilesearch2pharma.cgi?caseno=<?php echo $caseno ?>&username=<?php echo $user ?>&userType=<?php echo $userType ?>&ticket=<?php echo $ticketno ?>&identity=Approved&dept=PHARMACY_OPD&deptrel=<?php echo $dept ?>" target="tabiframecart"><i class="icofont-pills"></i> Pharmacy OPD</a></li>
          <li class="nav-item"><a class="nav-link" href="../extra/Cart/?caseno=<?php echo $caseno ?>&toh=PHARMACY OPD&station=<?php echo $dept ?>" target="tabiframecart"><i class="icofont-pills"></i> Pharmacy OPD Test</a></li>
        <?php } ?>
        <?php if($s5=="CSR2"){ ?><li class="nav-item"><a class="nav-link" href="../extra/CartBeta/?caseno=<?php echo $caseno ?>&ct=phs&dept=<?php echo $dept ?>&user=<?php echo $userunique ?>&xix" target="tabiframecart"><i class="icofont-injection-syringe"></i> CSR2</a></li><?php } ?>
        <?php if((stripos($caseno, "I-") === FALSE)&&($dept!="ONCOLOGY")){ ?><li class="nav-item"><a class="nav-link" href="../extra/Cart/?caseno=<?php echo $caseno ?>&toh=PACKAGE2023&station=<?php echo $dept ?>" target="tabiframecart"><i class="icofont-package"></i> PACKAGES</a></li><?php } ?>
        <?php if((stripos($caseno, "O-") !== FALSE)&&($dept!="ONCOLOGY")){ ?><li class="nav-item"><a class="nav-link" href="../extra/Cart/?caseno=<?php echo $caseno ?>&toh=PACKAGE2022&station=<?php echo $dept ?>" target="tabiframecart"><i class="icofont-surgeon"></i> ENDO/COLO</a></li><?php } ?>       
        <li class="nav-item"><a class="nav-link" href="http://<?php echo $ip ?>/ERP/nsstation/?printslip&caseno=<?php echo $caseno ?>" target="tabiframecart"><i class="icofont-printer"></i> Print Slip</a></li>
      </ul>
    </div>
  </nav>
</div>


<div class="box">
  <div class="box-shadow"></div>
  <div class="box-gradient">
    <iframe id='tabiframecart' name='tabiframecart' src='../extra/CartBeta/?caseno=<?php echo $caseno ?>&ct=sot&dept=<?php echo $dept ?>&user=<?php echo $userunique ?>&xix' width='100%' height='100%' style='border:0'></iframe>
  </div>
</div>
