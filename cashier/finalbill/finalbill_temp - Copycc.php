<?php
// ------------------------------------------------------------------- SAVE COLLECTION_TEMP TABLE --------------------------------------------------------------------------
if(isset($_POST['btnpost'])){
$hospitalpay = $_POST['hospitalpay'];
$hospitalbal= $_POST['hospitalbal'];
$hospitalbal2 = $hospitalbal;
$doctorpay = $_POST['doctorpay'];
$doctorpayx = $_POST['doctorpayx'];
$refnodoc = $_POST['refnodoc'];
$ofr = $_POST['ofr'];
$refnohosp = "RN".date("YmdHis");
$vdate = date("M-d-Y");
$datearrayxx = date("Y-m-d");
$hospitalpay= $_POST['hospitalpay'];

$sqla11 = "delete from collection_temp2 where acctno = '$caseno'";
if ($conn->query($sqla11) === TRUE) {}

if($hospitalbal<0){
if($hospitalpay>0){
// -------------------------------- FOR REFUND --------------------------------
$refnohosp = "PF".$refnohosp; $hospitalbal = str_replace("-", "", $hospitalbal);
$sqla11 = "INSERT INTO `collection_temp2`(`refno`, `acctno`, `acctname`, `ofr`, `description`, `accttitle`, `amount`, `discount`, `date`, `Dept`, `username`, `shift`, `type`, `paymentTime`, `paidBy`, `datearray`, `branch`) VALUES ('$refnohosp', '$caseno', '$name', '', 'HOSPITAL BILL', 'FOR REFUND', '$hospitalpay', '', '$vdate', 'in', '$user', '', 'pending', CURTIME(), '$dept', CURDATE(), '$branch')";
if ($conn->query($sqla11) === TRUE) {echo "<h1> Insert Collection APPF OTHERS PF </h1> ";}
// ------------------------------ END FOR REFUND ------------------------------
}
}else{
// -------------------------------- HOSPITAL PAYMENT ---------------------------
if($hospitalpay>$hospitalbal){$hospitalpay = $hospitalbal;}

if($hospitalpay>0){
$sqla11 = "INSERT INTO `collection_temp2`(`refno`, `acctno`, `acctname`, `ofr`, `description`, `accttitle`, `amount`, `discount`, `date`, `Dept`, `username`, `shift`, `type`, `paymentTime`, `paidBy`, `datearray`, `branch`) VALUES ('$refnohosp', '$caseno', '$name', '$ofr', 'HOSPITAL BILL', 'CASHONHAND', '$hospitalpay', '', '$vdate', 'in', '$user', '', 'cash-Visa', CURTIME(), '$dept', CURDATE(), '$branch')";
if ($conn->query($sqla11) === TRUE) {echo "<h1> Insert Collection [CASHONHAND] </h1> ";}
}

if($hospitalpay<$hospitalbal){
$bal = $hospitalbal - $hospitalpay; $refnohosp = $refnohosp."-AR";
$sqla11 = "INSERT INTO `collection_temp2`(`refno`, `acctno`, `acctname`, `ofr`, `description`, `accttitle`, `amount`, `discount`, `date`, `Dept`, `username`, `shift`, `type`, `paymentTime`, `paidBy`, `datearray`, `branch`) VALUES ('$refnohosp', '$caseno', '$name', '', 'HOSPITAL BILL', 'AR TRADE', '$bal', '', '$vdate', 'in', '$user', '', 'pending', CURTIME(), '$dept', CURDATE(), '$branch')";
if ($conn->query($sqla11) === TRUE) {echo "<h1> Insert Collection [AR-TRADE] </h1> ";}
}
// ------------------------------ END HOSPITAL PAYMENT ---------------------------
}


// --------------------------------------------------------------- PROFESSIONAL FEE ---------------------------------------------------------------
$countdoc = count($refnodoc);
for($i = 0; $i<$countdoc; $i++){

$sqlc = "SELECT * FROM productout where refno='$refnodoc[$i]'";
$resultc = $conn->query($sqlc);
while($rowc = $resultc->fetch_assoc()) {
$excess = $rowc['excess'];
$pdesc = $rowc['productdesc'];

if($hospitalbal2<0){
$hospitalbal = str_replace("-", "", $hospitalbal2);
if($doctorpay[$i]>$excess){$doctorpay[$i] = $excess;}
$hospitalbal2 = $hospitalbal2 - $doctorpay[$i];

if($doctorpay[$i]>0){
$sqla11 = "INSERT INTO `collection_temp2`(`refno`, `acctno`, `acctname`, `ofr`, `description`, `accttitle`, `amount`, `discount`, `date`, `Dept`, `username`, `shift`, `type`, `paymentTime`, `paidBy`, `datearray`, `branch`) VALUES ('$refnodoc[$i]', '$caseno', '$name', '', '$pdesc', 'APPF OTHERS PF', '$doctorpay[$i]', '', '$vdate', 'in', '$user', '', 'pending', CURTIME(), '$dept', CURDATE(), '$branch')";
if ($conn->query($sqla11) === TRUE) {echo "<h1> Insert Collection [$name APPF] $excess</h1> ";}
}

if($doctorpay[$i]<$excess){
$excess = $excess - $doctorpay[$i];
if($doctorpayx[$i]>=$excess){$doctorpayx[$i] = $excess;}
$bal2 = $excess - $doctorpayx[$i];

if($doctorpayx[$i]>0){
$refnodoc[$i] = $refnodoc[$i]."200";
$sqla11 = "INSERT INTO `collection_temp2`(`refno`, `acctno`, `acctname`, `ofr`, `description`, `accttitle`, `amount`, `discount`, `date`, `Dept`, `username`, `shift`, `type`, `paymentTime`, `paidBy`, `datearray`, `branch`) VALUES ('$refnodoc[$i]', '$caseno', '$name', '$ofr', '$pdesc', 'PROFESSIONAL FEE', '$doctorpayx[$i]', '', '$vdate', 'in', '$user', '', 'cash-Visa', CURTIME(), '$dept', CURDATE(), '$branch')";
if ($conn->query($sqla11) === TRUE) {echo "<h1> Insert Collection [$name PF] $excess</h1> ";}
}

if($bal2>0){
$refnodoc[$i] = $refnodoc[$i]."ARR";
$sqla11 = "INSERT INTO `collection_temp2`(`refno`, `acctno`, `acctname`, `ofr`, `description`, `accttitle`, `amount`, `discount`, `date`, `Dept`, `username`, `shift`, `type`, `paymentTime`, `paidBy`, `datearray`, `branch`) VALUES ('$refnodoc[$i]', '$caseno', '$name', '', '$pdesc', 'AR TRADE PF', '$bal2', '', '$vdate', 'in', '$user', '', 'pending', CURTIME(), '$dept', CURDATE(), '$branch')";
if ($conn->query($sqla11) === TRUE) {echo "<h1> Insert Collection [$name AR PF] $excess</h1> ";}
}

}else{
$bal2 = $excess - $doctorpayx[$i];
$sqla11 = "INSERT INTO `collection_temp2`(`refno`, `acctno`, `acctname`, `ofr`, `description`, `accttitle`, `amount`, `discount`, `date`, `Dept`, `username`, `shift`, `type`, `paymentTime`, `paidBy`, `datearray`, `branch`) VALUES ('$refnodoc[$i]', '$caseno', '$name', '', '$pdesc', 'APPF OTHERS PF', '$excess', '', '$vdate', 'in', '$user', '', 'pending', CURTIME(), '$dept', CURDATE(), '$branch')";
if ($conn->query($sqla11) === TRUE) {echo "<h1> Insert Collection [$name APPF aaaaaaa] $excess</h1> ";}
}


}else{
if($doctorpay[$i]>$excess){$doctorpay[$i] = $excess;}
if($doctorpay[$i]>0){
$sqla11 = "INSERT INTO `collection_temp2`(`refno`, `acctno`, `acctname`, `ofr`, `description`, `accttitle`, `amount`, `discount`, `date`, `Dept`, `username`, `shift`, `type`, `paymentTime`, `paidBy`, `datearray`, `branch`) VALUES ('$refnodoc[$i]', '$caseno', '$name', '$ofr', '$pdesc', 'PROFESSIONAL FEE', '$doctorpay[$i]', '', '$vdate', 'in', '$user', '', 'cash-Visa', CURTIME(), '$dept', CURDATE(), '$branch')";
if ($conn->query($sqla11) === TRUE) {echo "<h1> Insert Collection [PFaa] </h1> ";}
}
if($doctorpay[$i]<$excess){
$bal2 = $excess - $doctorpay[$i]; $refnodoc[$i] = $refnodoc[$i]."-AR";
$sqla11 = "INSERT INTO `collection_temp2`(`refno`, `acctno`, `acctname`, `ofr`, `description`, `accttitle`, `amount`, `discount`, `date`, `Dept`, `username`, `shift`, `type`, `paymentTime`, `paidBy`, `datearray`, `branch`) VALUES ('$refnodoc[$i]', '$caseno', '$name', '', '$pdesc', 'AR TRADE PF', '$bal2', '', '$vdate', 'in', '$user', '', 'pending', CURTIME(), '$dept', CURDATE(), '$branch')";
if ($conn->query($sqla11) === TRUE) {echo "<h1> Insert Collection [AR PFaa] </h1> ";}
}
}
}
}
// ----------------------------------------------------
echo"<script>window.location= 'finalbill2.php?caseno=$caseno$datax';</script>";
}
?>
