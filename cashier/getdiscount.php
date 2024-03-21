<?php
include "../main/class.php";
$ip = $_SERVER['REMOTE_ADDR'];
$sqlccv = "SELECT * from collection_temp where ip='$ip' and paymentTime='include'";
$resultccv = $conn->query($sqlccv);
while($rowccv = $resultccv->fetch_assoc()) {
$acct = $rowccv['accttitle'];
$amm = $rowccv['amount'];
$disc = $rowccv['discount'];
$refno = $rowccv['refno'];
$gross = $amm + $disc;
$splesssenior = 0;
$splessvat2 = 0;

// ------------- productout------------
$sql = "SELECT * from productout where refno = '$refno'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {$code = $row['productcode']; $caseno = $row['caseno']; $qty1 = $row['quantity']; $srp = $row['sellingprice']; $gross = $row['gross']; $adj = $row['adjustment'];}


// ------------- admission/ptprofile------------
$sql = "SELECT * from admission a, patientprofile p where a.patientidno=p.patientidno and a.caseno='$caseno'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {$senior1 = $row['senior']; $senior2 = $row['remarks'];}
if(strpos($caseno,"WPOS")!== false){$senior = $senior2;}else{$senior = $senior1;}

// ------------- receiving------------
$sql = "SELECT * from receiving where code = '$code'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {$testcode = $row['testcode']; $unit = $row['unit'];}


if($unit=="PHARMACY/MEDICINE"){
if($testcode=="0"){
$gross2 = $gross + $adj;
$getvat = $gross2/1.12;
$lessvat = $gross2 - $getvat;
$getsen = $adj - $lessvat;
}else{
$lessvat = 0;
$getsen = $adj;
}
}else{$getsen = $adj;}


$vatless += $lessvat;
$otherless += $getsen;
}

if($vatless<=0){$vatless = "0.00";}
if($otherless<=0){$otherless = "0.00";}

$vatless = number_format($vatless, 2);
$otherless = number_format($otherless, 2);
echo"$vatless $otherless";
?>
