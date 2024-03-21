<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PACKAGE LIST</title>
<link href="Resources/CSS/style.css" rel="stylesheet" type="text/css" />
<script type="text/JavaScript">
<!--
function placeFocus() {
if (document.forms.length > 0) {
var field = document.forms[0];
for (i = 0; i < field.length; i++) {
if ((field.elements[i].type == "text") || (field.elements[i].type == "textarea") || (field.elements[i].type.toString().charAt(0) == "s")) {
document.forms[0].elements[i].focus();
break;
         }
      }
   }
}
//-->
</script>
<style type="text/css">
<!--
.T1 {border-top-width: 1px;border-top-color: #000000;border-top-style: solid;}
.B1 {border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;}
.L1 {border-left-width: 1px;border-left-color: #000000;border-left-style: solid;}
.R1 {border-right-width: 1px;border-right-color: #000000;border-right-style: solid;}

.s1 {font-family: Arial;font-weight: bold;font-size: 12px;}
.s2 {font-family: Arial;font-size: 18px;}
.s3 {font-family: Arial;font-weight: bold;font-size: 16px;color: #000000;}
.s4 {font-family: Arial;font-weight: bold;font-size: 16px;color: #FFFFFF;}

.hoverTable{border-collapse:collapse;}
/*.hoverTable td{padding:0px; border:#4e95f4 1px solid;}*/

/* Define the default color for all the table rows */
/*.hoverTable tr{background: #b8d1f3;}*/

/* Define the hover highlight color for the table row */
.hoverTable tr:hover {background-color: #ffff99;}

.button1 {font-family: Arial;font-size: 14px;font-weight: bold;color: #FFFFFF;background-color: #00DA1D;border: 1px solid #00DA1D;}

.astyle {text-decoration: none;}
-->
</style>
<script type="text/javascript">
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
</head>

<body onload="placeFocus()">
<?php
ini_set("display_errors","On");
include("../../main/class.php");

if((isset($_COOKIE["ccpass"]))&&($_COOKIE["ccname"])&&($_COOKIE["ccacce"])){
  $ccpass=$_COOKIE["ccpass"];
  $ccname=$_COOKIE["ccname"];
  $ccacce=$_COOKIE["ccacce"];

  setcookie("ccpass", $ccpass, time() + 600, "/");
  setcookie("ccname", $ccname, time() + 600, "/");
  setcookie("ccacce", $ccacce, time() + 600, "/");
}
else{
  $ccpass="";
  $ccname="";
  $ccacce="";
}

$caseno=mysqli_real_escape_string($conn,$_POST['caseno']);
$dept=mysqli_real_escape_string($conn,$_POST['dept']);
$ipass=mysqli_real_escape_string($conn,$_POST['enterpassword']);
$nursename=mysqli_real_escape_string($conn,$_POST['user']);
$ticket=mysqli_real_escape_string($conn,$_POST['ticket']);
$pckgno=mysqli_real_escape_string($conn,$_POST['pckgno']);
$pn=mysqli_real_escape_string($conn,$_POST['pn']);
$remarks=strtoupper(mysqli_real_escape_string($conn,$_POST['remarks']));
$disrel=mysqli_real_escape_string($conn,$_POST['disrel']);
$prc=mysqli_real_escape_string($conn,$_POST['prc']);
$frm=mysqli_real_escape_string($conn,$_POST['frm']);
$trantype=mysqli_real_escape_string($conn,$_POST['trantype']);
$station=mysqli_real_escape_string($conn,$_POST['station']);

$rm=$pn." - ".$remarks;
$rm=$remarks;

$tick="LXD-".date("Ymd").$ticket;

if(($pckgno=="PCKG-20210222035829")||($pckgno=="PCKG-20210711025237")){
  $correction=0.01;
}
else{
  $correction=0;
}

$zysql=mysqli_query($conn,"SELECT * FROM `admission` WHERE `caseno`='$caseno' AND `membership`='phic-med'");
$zycount=mysqli_num_rows($zysql);

$bsql=mysqli_query($conn,"SELECT * FROM `packagedetails` WHERE `pckgno`='$pckgno' ORDER BY CAST(`price` AS DECIMAL(10,2)) DESC");
$bcount=mysqli_num_rows($bsql);

$perc=($disrel/$prc)*100;

$cou=0;
$totamtper=0;
$tapdis=0;
while($bfetch=mysqli_fetch_array($bsql)){
  $cd=$bfetch['code'];
  $ds=$bfetch['description'];
  $pr=$bfetch['price'];
  $autodistro=$bfetch['autodistro'];
  $ph1=$bfetch['ph1'];
  $ph2=$bfetch['ph2'];
  $hmo=$bfetch['hmo'];
  $exc=$bfetch['exc'];
  $cou++;

  if($cou==$bcount){
    $apdis=$disrel-$totamtper-$correction;
  }
  else{
    $apdis=$pr*(round($perc)/100);
    $totamtper+=$apdis;
  }

  $csql=mysqli_query($conn,"SELECT `unit` FROM `receiving` WHERE `code`='$cd'");
  $cfetch=mysqli_fetch_array($csql);
  $unit=$cfetch['unit'];

  $zsql=mysqli_query($conn,"SELECT `patientidno` FROM `admission` WHERE `caseno`='$caseno'");
  $zfetch=mysqli_fetch_array($zsql);
  $patientidno=$zfetch['patientidno'];

  $ysql=mysqli_query($conn,"SELECT `patientname` FROM `patientprofile` WHERE `patientidno`='$patientidno'");
  $yfetch=mysqli_fetch_array($ysql);
  $patname=$yfetch['patientname'];

  if($trantype=="cash"){$stat="requested";}
  else if($trantype=="charge"){$stat="Approved";}

  //refno generator--------------------------------------------------------------------------------
  $prdsql=mysqli_query($conn,"SELECT `prefnodate` FROM `myCounter`");
  $prdfetch=mysqli_fetch_array($prdsql);
  $prd=$prdfetch['prefnodate'];

  $pdate=date("Ymd");
  if($prd!=$pdate){
    mysqli_query($conn,"UPDATE `myCounter` SET `prefnodate`='$pdate', `prefnocount`='0' WHERE `counterno`='1'");
  }

  $prcsql=mysqli_query($conn,"SELECT `prefnocount` FROM `myCounter`");
  $prcfetch=mysqli_fetch_array($prcsql);
  $rno=$prcfetch['prefnocount'];

  $sequ="PK".date("YmdHi");

  if($rno<10){$refno=$sequ."000".$rno;}
  else if(($rno<100)&&($rno>9)){$refno=$sequ."00".$rno;}
  else if(($rno<1000)&&($rno>99)){$refno=$sequ."0".$rno;}
  else if($rno>999){$refno=$sequ.$rno;}
  //-----------------------------------------------------------------------------------------------

  //AddOns-----------------------------------------------------------------------------------------
  if(($zycount!=0)&&($autodistro==1)){
    $addon="&autodistro&ph1=$ph1&ph2=$ph2&hmo=$hmo&exc=$exc";
  }
  else{
    $addon="";
  }
  //EndAddOns--------------------------------------------------------------------------------------

  if($unit=="PHARMACY/SUPPLIES"){
  //POSPHARMA
    echo "
      <iframe src='../Cart2021/packagepharma.php?caseno=$caseno&code=$cd&qty=1&trantype=$trantype&toh=PACKAGE&station=$station&tick=PS$ticket&stk=PHARMACY&sprel=$pr&referenceno=$pckgno&packrno=$refno&itd=$apdis&srno=$refno".$addon."' height='0' width='0' style='border: none;'></iframe>
    ";
  }
  else if($unit=="PHARMACY/MEDICINE"){
  //POSPHARMA
    echo "
      <iframe src='../Cart2021/packagepharma.php?caseno=$caseno&code=$cd&qty=1&trantype=$trantype&toh=PACKAGE&station=$station&tick=PM$ticket&stk=PHARMACY&sprel=$pr&referenceno=$pckgno&packrno=$refno&itd=$apdis&srno=$refno".$addon."' height='0' width='0' style='border: none;'></iframe>
    ";
  }
  else{
  //POSCHARGES
    echo "
      <iframe src='../Cart2021/poscharges.php?caseno=$caseno&station=$station&toh=PACKAGE&tick=OT$ticket&remarks=$remarks&code=$cd&unit=$unit&trantype=$trantype&qty=1&sprel=$pr&referenceno=$pckgno&packrno=$refno&itd=$apdis&srno=$refno".$addon."' height='0' width='0' style='border: none;'></iframe>
    ";
  }

  $rnoplus=$rno+1;
  mysqli_query($conn,"UPDATE `myCounter` SET `prefnocount`='$rnoplus' WHERE `counterno`='1'");
}

echo "
<div align='left' class='arial16bluebold'>PACKAGE ADDED</div>
<br />
<div align='left' class='arial16bluebold'>
  <form name='back' action='../Package2023/' method='post'>
    <input type='submit' name='Back' value='&lt;&lt;Back' />
    <input type='hidden' name='caseno' value='$caseno'>
    <input type='hidden' name='dept' value='$dept'>
    <input type='hidden' name='enterpassword' value='$ipass'>
    <input type='hidden' name='user' value='$nursename'>
    <input type='hidden' name='ticket' value='$ticket'>
    <input type='hidden' name='station' value='$station'>
  </form>
</div>
";


?>
</body>
</html>
