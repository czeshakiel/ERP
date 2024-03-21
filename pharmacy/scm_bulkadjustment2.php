<?php

include "../main/connection.php";
include "../main/model.php";
error_reporting(1);

$batchno = "BA".date("YmdHis");
$curdate = "2024-01-19";
$curtime = "19:26:00";
$curdate2 = "2024-01-19";
$curtime2 = "19:27:00";
$dept="PHARMACY";

$conn->query("update stocktable set dept = 'pharmacy_xxxx' where dept='$dept' and trantype='ADJUSTMENT' and datearray='$curdate' and timearray='$curtime'");

$discre = 0; $i=0;
$sql222 = "SELECT * FROM `scm_adjustmenthistory` WHERE dept='$dept' and reason like '%BA20240119094107%'";
$result222 = $conn->query($sql222);
while($row222 = $result222->fetch_assoc()){ 
$datearray=$row222['datearray'];
$timearray=$row222['timearray'];
$desc=$row222['desc'];
$newqty=$row222['newqty'];
$reason=$row222['reason'];
$userm=$row222['user'];
$code=$row222['code'];
$desc=$row222['desc'];
$i++;

$ndate = $curdate." ".$curtime;
$result2 = $conn->query("SELECT sum(quantity) as qtyy FROM stocktable where dept='$dept' and code='$code' and CONCAT(datearray, ' ', timearray)<'$ndate' group by code");
while($row2 = $result2->fetch_assoc()) {$oldqty=$row2['qtyy'];}
if($oldqty==""){$oldqty=0;}

$updatedqty = $newqty - $oldqty;
$comment = "Bulk Ajustment [$batchno]";
$transid = "Adj-".date("YmdHsi").$i;

adjustment_entry($code, $desc, $oldqty, $newqty, $comment, $transid, $updatedqty, $curdate2, $curtime2, $dept, $userm);
}


$conn->query("INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('Submit Bulk Adjustment [$dept $batchno]', '$user', CURDATE(), CURTIME())");


echo"<h1>DONE</h1>";
?>