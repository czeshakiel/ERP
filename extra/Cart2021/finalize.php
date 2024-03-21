<?php
include("../Settings.php");
$caseno=mysqli_real_escape_string($mycon1,$_GET['caseno']);
$station=mysqli_real_escape_string($mycon1,$_GET['station']);
$toh=mysqli_real_escape_string($mycon1,$_GET['toh']);
$tick=mysqli_real_escape_string($mycon1,$_GET['tick']);
$stk=mysqli_real_escape_string($mycon1,$_GET['stk']);

$asql=mysqli_query($mycon1,"SELECT * FROM `productout_tempsave` WHERE `cseno`='$caseno' AND `administratrion`='pending'");
while($afetch=mysqli_fetch_array($asql)){
  $refno=$afetch['refno'];
  $invno=$afetch['invno'];
  $productcode=$afetch['productcode'];
  $productdesc=$afetch['productdesc'];
  $sellingprice=$afetch['sellingprice'];
  $quantity=$afetch['quantity'];
  $adjustment=$afetch['adjustment'];
  $gross=$afetch['gross'];
  $trantype=$afetch['trantype'];
  $phic=$afetch['phic'];
  $hmo=$afetch['hmo'];
  $excess=$afetch['excess'];
  $date=$afetch['date'];
  $status=$afetch['status'];
  $terminalname=$afetch['terminalname'];
  $loginuser=$afetch['loginuser'];
  $batchno=$afetch['batchno'];
  $producttype=$afetch['producttype'];
  $productsubtype=$afetch['productsubtype'];
  $approvalno=$afetch['approvalno'];
  $referenceno=$afetch['referenceno'];
  $administration=$afetch['administration'];
  $shift=$afetch['shift'];
  $location=$afetch['location'];
  $datearray=$afetch['datearray'];
  $phic1=$afetch['phic1'];

  //GENERATE REFNO---------------------------------------------------------------
  $rndsql=mysql_query("SELECT refnodate FROM myCounter");
  $rndfetch=mysql_fetch_array($rndsql);
  $rndate=$rndfetch['refnodate'];

  if($rndate!=date("Ymd")){
  mysql_query("UPDATE myCounter SET refnodate='".date("Ymd")."', refnocount='0'");
  }

  $rncsql=mysql_query("SELECT refnocount FROM myCounter");
  $rncfetch=mysql_fetch_array($rncsql);
  $rncount=$rncfetch['refnocount'];

  if($rncount<10){$newrefno="FN".date("Ymd")."00000".$rncount;}
  else if($rncount<100){$newrefno="FN".date("Ymd")."0000".$rncount;}
  else if($rncount<1000){$newrefno="FN".date("Ymd")."000".$rncount;}
  else if($rncount<10000){$newrefno="FN".date("Ymd")."00".$rncount;}
  else if($rncount<100000){$newrefno="FN".date("Ymd")."0".$rncount;}
  else{$newrefno="FN".date("Ymd").$rncount;}
  //END GENERATE REFNO-----------------------------------------------------------
}
?>
