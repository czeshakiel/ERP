<?php
include "../main/class.php";
include "../main/header.php";
if($dept=='ADMISSION'){$st="admission"; $dist="username";}
if($dept=='OPD'){$st="opd"; $dist="username";}
if($dept=='ER'){$st="er"; $dist="username";}
if($dept=='NS1' || $dept=='NS2' || $dept=='NS3'){$st="ns"; $dist="username";}
if($dept=='PHARMACY'){$st="pharmacy"; $dist="username";}
if($dept=='BILLING'){$st="billing"; $dist="nursename";}

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

$sql2 = "SELECT maindept,subdept1,subdept2,subdept3 FROM department where maindept='$dept'";
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
.navbar2 {
  overflow: hidden;
  background-color: #4933ff;
}

.navbar2 a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar2 a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #ddd;
}

.dropdown:hover .dropdown-content {
  display: block;
}
</style>
</head>
<body>

<div class="navbar2">
<a href="../extra/Cart/?caseno=<?php echo $caseno ?>&toh=CHARGES&station=<?php echo $dept ?>" target="tabiframecart"><i class="bi bi-person-check-fill"></i> Charges</a>
<a href="http://<?php echo $ip ?>/cgi-bin/wah/docmanual.cgi?caseno=<?php echo $caseno ?>&username=<?php echo $user ?>&userType=<?php echo $userType ?>&ticket=<?php echo $ticketno ?>&identity=Approved&dept=<?php echo $dept ?>" target="tabiframecart"><i class="bi bi-person-check-fill"></i> Doctor</a>
  
<?php if($mt=="$dept") { ?>
<a href="../extra/Cart/?caseno=<?php echo $caseno ?>&toh=<?php echo $mt ?>&station=<?php echo $dept ?>" target="tabiframecart"><i class="bi bi-person-check-fill"></i> <?php echo $dept ?></a>
<?php } ?>

<?php if($dept=="RDU") { ?>
<a href="../extra/Cart/?caseno=<?php echo $caseno ?>&toh=RDU_MANUAL&station=<?php echo $dept ?>" target="tabiframecart">RDU</a>
<?php } ?>

<?php if($s2=="PHARMACY") { ?>
<a href="../extra/Cart/?caseno=<?php echo $caseno ?>&toh=PHARMACY_MANUAL&station=<?php echo $dept ?>" target="tabiframecart"><i class="bi bi-person-check-fill"></i> Pharmacy</a>
<?php } ?>

<?php if($wardx=="OUTPATIENT" or $dept=="PHARMACY_OPD") { ?>
<a href="http://<?php echo $ip ?>/cgi-bin/profilesearch2pharma.cgi?caseno=<?php echo $caseno ?>&username=<?php echo $user ?>&userType=<?php echo $userType ?>&ticket=<?php echo $ticketno ?>&identity=Approved&dept=PHARMACY_OPD&deptrel=<?php echo $dept ?>" target="tabiframecart">P_OPD</a>
<a href="../extra/Cart/?caseno=<?php echo $caseno ?>&toh=PHARMACY OPD&station=<?php echo $dept ?>" target="tabiframecart">p_OPD TEST</a>
<?php } ?>

<?php if($s5=="CSR2") { ?>
<a href="../extra/Cart/?caseno=<?php echo $caseno ?>&toh=CSR2_MANUAL&station=<?php echo $dept ?>" target="tabiframecart">CSR2</a>
<?php } ?>
<a href="../extra/Cart/?caseno=<?php echo $caseno ?>&toh=PACKAGE&station=<?php echo $dept ?>" target="tabiframecart">PACKAGES</a>
</div>

</body>
</html>


<iframe id='tabiframecart' name='tabiframecart' src='../extra/Cart/?caseno=<?php echo $caseno ?>&toh=CHARGES&station=<?php echo $dept ?>' width='100%' height='600px' style='border:0'></iframe>
