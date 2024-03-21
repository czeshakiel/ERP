<?php
ini_set("display_errors","On");
//--------- Additional Info ----------------
$ipaddS = $_SERVER['REMOTE_ADDR'];
$gencode = date("YmdHsi");
$datex = date("M-d-Y");
$timex = date("H:s:i");
$i=0;
$today = date("Ymd");
$todaytime = date("his");
$coderx="e".$todaytime."".$today;
$datearrayxx = date("Y-m-d");
$batchno = $dept."-".date("YmdHsi");

if($ttype == "PATIENT"){$case = "WPOS"; $myloc = "pos"; $t1 = "cash"; $t2 = "requested";}
elseif($ttype == "DOCTOR"){$case = "DOC"; $myloc = "ardoctor"; $t1 = "charge"; $t2 = "Approved";}
else{$case = "EMP"; $myloc = "aremployee"; $t1 = "charge"; $t2 = "Approved";}

$caseno = $case ."-".date('YmdHis');
// -----------------------------------------


$sqlccv = "SELECT * FROM patientprofilewalkin where patientidno='$patientidno'";
$resultccv = $conn->query($sqlccv);
$checkpt = mysqli_num_rows($resultccv);
while($rowccv = $resultccv->fetch_assoc()) {
$lastname=$rowccv['lastname'];
$firstname=$rowccv['firstname'];
$middlename=$rowccv['middlename'];
$name = $lastname.", ".$firstname." ".$middlename;
}


if($checkpt==0){

$sqlccvc = "SELECT * FROM docfile where code='$patientidno'";
$resultccvc = $conn->query($sqlccvc);
$checkdoc = mysqli_num_rows($resultccvc);
while($rowccvc = $resultccvc->fetch_assoc()) {
$lastname=$rowccvc['lastname'];
$firstname=$rowccvc['firstname'];
$middlename=$rowccvc['middlename'];
$name=$rowccvc['name'];
}

if($checkdoc<=0){
$sqlccvz = "SELECT * FROM nsauthemployees where empid='$patientidno'";
$resultccvz = $conn->query($sqlccvz);
while($rowccvz = $resultccvz->fetch_assoc()){
$lastname=$rowccvz['lastname'];
$firstname=$rowccvz['firstname'];
$middlename=$rowccvz['middlename'];
$name = $lastname.", ".$firstname." ".$middlename;
}
}


// ------------------> INSERT TO PATIENT PROFILE WALKIN
$sqla1ad = "INSERT INTO `patientprofilewalkin`(`patientidno`, `lastname`, `firstname`, `middlename`, `suffix`, `birthdate`, `age`, `sex`, `senior`, `patientname`, `dateofbirth`, `type`) VALUES ('$patientidno', '$lastname', '$firstname', '$middlename', '$ttype', '', '', '', '', '$name', '', '')";
if ($conn->query($sqla1ad) === TRUE) {}
}

// ------------------> GET SENIOR STATUS
$sqlbb = "SELECT * from poswalkin2 where ipaddress='$ipaddS' and ttype='$ttype'";
$resultbb = $conn->query($sqlbb);
while($rowbb = $resultbb->fetch_assoc()) {
$senior = $rowbb['dis'];
}


$sqla1ad = "INSERT INTO admission (`patientidno`, `caseno`, `type`, `membership`, `hmomembership`, `hmo`, `corp`, `policyno`, `paymentmode`, `room`, `ward`, middlenamed, dateadmitted, timeadmitted, status, casetype, job, course, admittingclerk, dateadmit, branch, remarks, ap, ad) values ('$patientidno','$caseno','N/A','none','none','N/A','','','N/A','OPD', 'out','$name','$datex', '$timex', 'Active', 'A', 'restrict', 'NEW', '$user', CURDATE(), '$branch','$senior', '$docname', '$docname');";
if ($conn->query($sqla1ad) === TRUE) {}


$totalgross=0;
$sql = "SELECT * from poswalkin2 where ipaddress='$ipaddS' and ttype='$ttype'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()){
$code=$row['code'];
$desc=$row['desc'];
$srp=$row['sellingprice'];
$qty=$row['qty'];
$gross=$row['gross'];
$adjustment=$row['adjustment'];
$net=$row['net'];
$lotno=$row['lotno'];
$unitcost=$row['unitcost'];
$lessvat=$row['lessvat'];
$less=$row['less'];
if($lessvat>0){$wvat = "Y";}else{$wvat="N";}
$totalgross += $gross;

$qty22 = $row['qty'];
$ind_sp = $gross / $qty22;
$ind_ad = $adjustment / $qty22;
$ind_net = $net / $qty22;
$ind_vat = $lessvat / $qty22;
$ind_less = $less / $qty22;

$sqlh = "SELECT * from receiving where code='$code'";
$resulth = $conn->query($sqlh);
while($rowh = $resulth->fetch_assoc()) {
$unit = $rowh['unit'];
$gen = $rowh['generic'];
if($unit=="PHARMACY/MEDICINE"){$prodtype = "med";}else{$prodtype = "sup";}
}

$srp = $ind_net + $ind_ad;
echo"-------------------------------------- $desc ---------------------------------------<br>";

$sql2 = "SELECT code, rrno, SUM(quantity) AS quantity, (unitcost) as unitc FROM stocktable WHERE code='$code' AND dept='$dept' GROUP BY rrno having sum(quantity) > 0 ORDER BY rrno DESC";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$rrno=$row2['rrno'];
$quantity=$row2['quantity'];
$unitc=$row2['unitc'];

if($qty>0){

//------------------------------------------------ INSERT PRODUCTOUT --------------------------------------------------
// Quantity = SOH
// Qty = Qty Request
if($quantity>=$qty){
$refno_arv = "POS-".$gencode.$i;
$net = $ind_net * $qty;
$adjustment = $ind_ad * $qty;
$less = $ind_less * $qty;
$lessvat = $ind_vat * $qty;
	
$sqla1a = "INSERT INTO `productout`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`,
 `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`,
 `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`, `cvat`, `cdisc`, `wvat`, `scpwd`) VALUES ('$refno_arv',CURTIME(),'$caseno','$code','$desc','$srp','$qty',
 '$adjustment','$net','$t1','0','0','$net','$datex','$t2','$rrno','$user','$batchno','$prodtype','$unit','insert-1','QR-$qty','pending','$branch',
 '$dept',CURDATE(),'', '$lessvat', '$less', '$wvat', '$senior')";
if ($conn->query($sqla1a) === TRUE) {}
$qty=0;
//echo "<script>alert('Trans: 1   request: $qty  soh: $quantity  Insert: $qty');</script>";
}else{
$refno_arv = "POS-".$gencode.$i;
$net = $ind_net * $quantity;
$adjustment = $ind_ad * $quantity;
$less = $ind_less * $quantity;
$lessvat = $ind_vat * $quantity;
	
$sqla1a = "INSERT INTO `productout`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`,
 `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`,
 `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`, `cvat`, `cdisc`, `wvat`, `scpwd`) VALUES ('$refno_arv',CURTIME(),'$caseno','$code','$desc','$srp','$quantity',
 '$adjustment','$net','$t1','0','0','$net','$datex','$t2','$rrno','$user','$batchno','$prodtype','$unit','insert-2','QR-$quantity','pending','$branch',
 '$dept',CURDATE(),'', '$lessvat', '$less', '$wvat', '$senior')";
if ($conn->query($sqla1a) === TRUE) {}
//echo "<script>alert('Trans: 2  request: $qty  soh: $quantity  Insert: $quantity');</script>";
$qty = $qty - $quantity;
}
//------------------------------------------------ END INSERT PRODUCTOUT --------------------------------------------------

$i++;
} 

}
}

$sqlposwalkin2 = "delete from poswalkin2 where ipaddress='$ipaddS' and ttype='$ttype'";
if($conn->query($sqlposwalkin2) === TRUE) {}
echo"<script>window.location='?$myloc';</script>";
?>
