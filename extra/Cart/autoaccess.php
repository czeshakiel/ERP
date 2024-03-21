<!doctype html>
<html>
<head>
  <meta charset='utf-8'>
  <title>Log-in</title>
  <link rel='stylesheet' type='text/css' href='http://$setip/arv2020/Auth/css/login2.css'>
  <link rel='stylesheet' href='http://$setip/arv2020/arv_includes/stackpath.bootstrapcdn.css'>
  <link rel='icon' href='http://$setip/arv2020/Auth/icons/avatar1.png' type='image/png' />
  <link rel='shortcut icon' href='http://$setip/arv2020/Auth/icons/avatar1.png' type='image/png' />
</head>
<body onload='placeFocus()'>
<?php
ini_set("display_errors","On");
include("../Settings.php");

$caseno=mysqli_real_escape_string($mycon1,$_GET['caseno']);
$toh=mysqli_real_escape_string($mycon1,$_GET['toh']);
$station=mysqli_real_escape_string($mycon1,$_GET['station']);
$user=mysqli_real_escape_string($mycon1,$_GET['user']);

$asql=mysqli_query($mycon1,"SELECT `password`, `name`, `Access` FROM `nsauth` WHERE `username`='$user' AND `station`='$station'");
$afetch=mysqli_fetch_array($asql);
$upass=$afetch['password'];
$uaccess=$afetch['Access'];
$uname=$afetch['name'];


setcookie("ccpass", $upass, time() + 900, "/");
setcookie("ccname", $uname, time() + 900, "/");
setcookie("ccacce", $uaccess, time() + 900, "/");


    if($toh=="CHARGES_QUOT"){
      $tick="LXD-".date("YmdHis").rand(1000,9999);
      echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=cccharges_quot.php?caseno=$caseno&station=$station&toh=$toh&tick=$tick'>";
    }
    else if($toh=="PHARMACY_QUOT"){
      $tick="PHARMACY-".date("YmdHis").rand(1000,9999);
      echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=ccpharmacy_quot.php?caseno=$caseno&station=$station&toh=$toh&tick=$tick&stk=PHARMACY'>";
    }
    else if($toh=="CSR2_QUOT"){
      $tick="CSR2-".date("YmdHis").rand(1000,9999);
      echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=cccsr2_quot.php?caseno=$caseno&station=$station&toh=$toh&tick=$tick&stk=CSR2'>";
    }
?>
</body>
</html>
