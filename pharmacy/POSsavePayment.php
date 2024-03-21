<?php
ini_set("display_errors","On");
//--------- Additional Info ----------------
$ipaddS = $_SERVER['REMOTE_ADDR'];
$gencode = date("YmdHsi");
$datex = date("Y-m-d");
$timex = date("H:s:i");
$i=0;
$today = date("Ymd");
$todaytime = date("his");
$coderx="e".$todaytime."".$today;
$datearrayxx = date("Y-m-d");
$batchno = $dept."-".date("YmdHsi");

if($ttype == "PATIENT"){$case = "WPOS"; $myloc = "pos"; $t1 = "cash"; $t2 = "requested";}
elseif($ttype == "DOCTOR"){$case = "DOC"; $myloc = "posdoc"; $t1 = "charge"; $t2 = "Approved";}
else{$case = "EMP"; $myloc = "posemp"; $t1 = "charge"; $t2 = "Approved";}

$caseno = $case ."-".date('YmdHis');
// -----------------------------------------


$sqlccv = "SELECT * FROM patientprofilewalkin where patientidno='$patientidno'";
$resultccv = $conn->query($sqlccv);
$checkpt = mysqli_num_rows($resultccv);
while($rowccv = $resultccv->fetch_assoc()){
$lastname=$rowccv['lastname'];
$firstname=$rowccv['firstname'];
$middlename=$rowccv['middlename'];
$name = $lastname.", ".$firstname." ".$middlename;
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
$totalgross += $gross;

$qty22 = $row['qty'];
$ind_sp = $gross / $qty22;
$ind_ad = $adjustment / $qty22;
$ind_net = $net / $qty22;

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
	
$sqla1a = "INSERT INTO `productout`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`,
 `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`,
 `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`) VALUES ('$refno_arv',CURTIME(),'$caseno','$code','$desc','$srp','$qty',
 '$adjustment','$net','$t1','0','0','$net','$datex','$t2','$rrno','$user','$batchno','$prodtype','$unit','insert-1','QR-$qty','pending','$branch',
 '$dept',CURDATE(),'')";
if ($conn->query($sqla1a) === TRUE) {}
$qty=0;
//echo "<script>alert('Trans: 1   request: $qty  soh: $quantity  Insert: $qty');</script>";
}else{
$refno_arv = "POS-".$gencode.$i;
$net = $ind_net * $quantity;
$adjustment = $ind_ad * $quantity;
	
$sqla1a = "INSERT INTO `productout`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`,
 `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`,
 `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`) VALUES ('$refno_arv','','$caseno','$code','$desc','$srp','$quantity',
 '$adjustment','$net','$t1','0','0','$net','$datex','$t2','$rrno','$user','$batchno','$prodtype','$unit','insert-2','QR-$quantity','pending','$branch',
 '$dept',CURDATE(),'')";
if ($conn->query($sqla1a) === TRUE) {}
//echo "<script>alert('Trans: 2  request: $qty  soh: $quantity  Insert: $quantity');</script>";
$qty = $qty - $quantity;
}
//------------------------------------------------ END INSERT PRODUCTOUT --------------------------------------------------

$i++;
} 

}
}



$sql2d = "SELECT * FROM productout where batchno='$batchno'";
$result2d = $conn->query($sql2d);
while($row2d = $result2d->fetch_assoc()){
$code=$row2d['productcode'];
$refno=$row2d['refno'];
$srp=$row2d['sellingprice'];

$qtyp=$row2d['quantity'];
$adj=$row2d['adjustment'];
$trantype=$row2d['trantype'];
$hmo = $row2d['hmo'];
$phic = $row2d['phic'];
$exc = $row2d['excess'];
$pst = $row2d['productsubtype'];
$stat= $row2d['status'];
$loginuser= $row2d['loginuser'];
$rrno = $row2d['terminalname'];
$caseno = $row2d['caseno'];
$localdate = date("M-d-Y");
$coder = "PHARMA-".date("YmdHis");
$amount = $exc;
$discount = $adj;
$gross = $amount + $discount;
$date = date("M-d-Y");


$sql2 = $conn->query("SELECT * FROM receiving where code='$code'");
while($row2 = $sql2->fetch_assoc()){
$dx="(".$row2['generic'].") ".$row2['description'];
$gen=$row2['generic'];
$lotno=$row2['lotno'];
}


$result2222 = $conn->query("SELECT * from stocktable where code='$code' and (trantype = 'charge' or trantype = 'cash') order by datearray");
while($row2222 = $result2222->fetch_assoc()){ $unitp=$row2222['unitcost'];}

$conn->query("update productout set administration='dispensed', status='PAID' where productcode='$code' and batchno='$batchno' and caseno='$caseno'");

$qtypp = "-".$qtyp;
$sqla1a = $conn->query("insert into stocktable (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`) values
('$localdate','$rrno','','','$caseno','$name','$code','$dx','$unitp','$qtypp','0','$gen','$qtypp','','$lotno','dispensed','NONE','$localdate','$dept','','NONE','$refno','$user','$coder','u',CURTIME(), CURDATE())");

if(strpos("I-", $caseno)!==false){$Dept = "in";}else{$Dept="out";}
if($ttype == "PATIENT"){
//-------------------------------------------------------------------->
$sqla1 = $conn->query("insert into collection values ('$refno','$caseno','$name','$ofr','$dx','$pst','$amount','$discount','$date','$Dept','$user','$shift','$type','$timex','$mydept','$datex','$branch')");

$sqla1 = "insert into collectiondetails2 (`refno`, `acctno`, `acctname`, `ofr`, `description`, `accttitle`, `srp`, `qty`, `gross`, `discount`, `net`, `date`, `Dept`, `username`, `shift`, `type`, `paymentTime`, `paidBy`, `datearray`, `branch`, `ccname`, `ccno`, `actual_amount`, `bank`, `isvat`, `wvat`, `scpwd`, `scdiscount`, `lotno`, `sdisc_percent`, `sdisc_amount`, `sdisc_type`) values ('$refno','$caseno','$name','$ofr','$dx','$pst','$srp','$qtyp','$gross','$discount','$amount','$date','$Dept','$user','$shift','$type','$timex','$mydept','$datex','$branch',
'$ccname','$ccno','$actual','$bank','$isvat','$wvat','$senior','$scpwd','$lotno', '$specialdisc2', '$newless', '$specialdisctype')";
if ($conn->query($sqla1) === TRUE) {echo "<h1> insert collectiondetails</h1> ";}
//-------------------------------------------------------------------->
}

}

if($ttype == "PATIENT"){$sqla11 = $conn->query("INSERT INTO `orno_used`(`orseries`, `or_used`) VALUES ('$orno_id', '$ofr')");}

$sqlposwalkin2 = "delete from poswalkin2 where ipaddress='$ipaddS' and ttype='$ttype'";
if($conn->query($sqlposwalkin2) === TRUE) {}
echo"
<script>
let a = document.createElement('a');
a.target='_blank';
a.href='ofrpharma.php?orno=$ofr';
a.click();

window.location='index.php?view=$myloc&$datax';
</script>
";
?>
