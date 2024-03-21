<?php
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

$sequ=date("YmdHis");

if($rno<10){$refno=$sequ."000".$rno;}
else if(($rno<100)&&($rno>9)){$refno=$sequ."00".$rno;}
else if(($rno<1000)&&($rno>99)){$refno=$sequ."0".$rno;}
else if($rno>999){$refno=$sequ.$rno;}

if($ct=="pck"){
  $refno=mysqli_real_escape_string($conn,$_GET['srno']);
}
?>
