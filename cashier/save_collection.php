<?php
session_start();
include '../main/class.php';
$ofr=$_GET['orno'];
$dis=$_GET['dis'];
$caseno=$_GET['caseno'];
$ipx = $_SERVER['REMOTE_ADDR'];
$user = $_GET['nursename'];
$paymentType = $_GET['paymenttype'];
$orseries = $_GET['orseries'];
$mm = $_GET['mm'];
$dd = $_GET['dd'];
$yy = $_GET['yy'];
//$dept = $_GET['dept'];
$ccname = $_GET['ccname'];
$ccno = $_GET['ccno'];
$actual = $_GET['actual'];
$bank = $_GET['bank'];
$transactions = $_GET['transactions'];
$sukicard = $_GET['sukicard'];
$specialdisc = $_GET['specialdisc'];
$specialdiscremove = str_replace('.', '', $specialdisc);
$specialdisctype = $_GET['specialdisctype'];
$type = $transactions."-Visa";
if($transactions=="cash"){$actual="";}


$sql = "SELECT * FROM ipaddress";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {$ip=$row['ipaddress'];}


if($ofr==""){ echo "<body bgcolor='red'><h1> Please Fill-in the OR No.! </h1></body>";}
elseif($dis=="") { echo "<body bgcolor='red'><h1> DONT LEAVE DISCOUNT EMPTY/NULL VALUE! </h1></body>"; }
else{

$sqlcols = "SELECT sum(discount) as totdis, sum(amount) as totalamm FROM collection_temp where paymentTime='include' and acctno='$caseno' and ip='$ipx'";
$resultcols = $conn->query($sqlcols);
while($rowcols = $resultcols->fetch_assoc()) {
$totdis=$rowcols['totdis'];
//$totamm=$rowcols['totalamm'];
}

$totamm=0; $ckmed = 0; $notmedsup = 0;
$sqlcol = "SELECT * FROM collection_temp where acctno='$caseno' and paymentTime='include' and ip='$ipx'";
$resultcol = $conn->query($sqlcol);
while($rowcol = $resultcol->fetch_assoc()) {
$refno=$rowcol['refno'];
$acctno=$rowcol['acctno'];
$acctname=$rowcol['acctname'];
$description=$rowcol['description'];
$accttitle=$rowcol['accttitle'];
$amount=$rowcol['amount'];
$discount=$rowcol['discount'];
$date=$rowcol['date'];
$Dept=$rowcol['Dept'];
$username=$rowcol['username'];
$datearray=$rowcol['datearray'];
$branch=$rowcol['branch'];
$ip1=$rowcol['ip'];
$qtyy1=$rowcol['quantity'];
$gross = $amount + $discount;
$srp = $gross / $qtyy1;
$timex = date("H:i:s");

if($totdis<=0){
$discount = ($dis / 100) * $amount;
$amount = $amount - $discount;
}else{
$discount = $discount;
$amount = $amount;
}


if(strpos($accttitle, "PHARMACY/MEDICINE")!== false){$totamm+=$amount;}


//ADDED 2021-05-11 MARK --> CONTAINER------------------------------------------------------------------------------------------------------------------------------------
$lkjsql=mysqli_query($conn,"SELECT `productcode`, `quantity`, `approvalno`, `terminalname` FROM `productout` WHERE `refno`='$refno'");
$lkjfetch=mysqli_fetch_array($lkjsql);
$pco=$lkjfetch['productcode'];
$apv=$lkjfetch['approvalno'];
$rrset=$lkjfetch['terminalname'];
$qtset=$lkjfetch['quantity'];

mysqli_query($conn,"SET NAMES 'utf8'");
$poisql=mysqli_query($conn,"SELECT p.patientname FROM admission a, patientprofile p WHERE a.caseno='$caseno' AND a.patientidno=p.patientidno");
$poifetch=mysqli_fetch_array($poisql);
$pname=$poifetch['patientname'];

if($apv=="dispenseme"){
$newapv="AUTO-Dispensed-".date("Ymdhis")."-$username";
echo "UPDATE `productout` SET `approvalno`='$newapv', `administration`='dispensed' WHERE `refno`='$refno'";
mysqli_query($conn,"UPDATE `productout` SET `approvalno`='$newapv', `administration`='dispensed' WHERE `refno`='$refno'");

include("dispensed.php");
}
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------


// Arvid 02-24-2022 Auto compute for VAT and SC -------------------------------------------------------------------------------------------------------------------------
/*$profile2 = $conn->query("select * from admission where caseno='$caseno'");
while($prof = $profile2->fetch_assoc()){
$rem = $prof['remarks'];
$ptid = $prof['patientidno'];
}

$profile22= $conn->query("select * from patientprofile where patientidno='$ptid'");
while($prof22 = $profile22->fetch_assoc()){$senior = $prof22['senior'];}

if(strpos($caseno, "WPOS") !== false){$senior=$rem;}

$vatable = $conn->query("select * from receiving where code='$pco'");
while($svat = $vatable->fetch_assoc()){
$isvatable = $svat['testcode'];
$lotno = $svat['lotno'];
}

$gross = $amount + $discount; $wvat=0; $scpwd = 0;
if($isvatable=="0"){$isvat="YES";}else{$isvat="NO";}
if($isvatable=="0"){$wvat = $gross / 1.12; $wvat = $gross - $wvat;}
if($senior=="Y"){$scpwd = $gross - $wvat; $scpwd = $scpwd * 0.20;}

$wvat = round($wvat, 2);
$scpwd = round($scpwd, 2);

if(strpos($accttitle, "SUPPLIES")!== false){$isvat="NO"; $wvat=0;}
*/


$vatable = $conn->query("select * from receiving where code='$pco'");
while($svat = $vatable->fetch_assoc()){
$testcode = $svat['testcode'];
$lotno = $svat['lotno'];
}

if($testcode=="0" or $testcode==""){$xvat="V";}else{$xvat="NV";}
$lotno = $lotno."|".$xvat;

$xx = $conn->query("select * from productout where refno='$refno' and caseno='$caseno'");
while($xxy = $xx->fetch_assoc()){
$wvat = $xxy['cvat'];
$scpwd = $xxy['cdisc'];
$senior = $xxy['scpwd'];
if($xxy['wvat']=="N"){$isvat="NO";}else{$isvat="YES";}
}

// --------------------- SPECIAL DISCOUNT ----------------------------------
if($specialdisctype=="ADD-ONS"){
if($specialdisc<100 and $specialdisc>9){$specialdisc2 = "0.".$specialdiscremove;}
elseif($specialdisc<10){$specialdisc2 = "0.0".$specialdiscremove;}
else{$specialdisc2 = 1;}

$newless = $amount * $specialdisc2;
$amount = $amount - $newless;
$discount = $discount + $newless;
}

elseif($specialdisctype=="OVERRIDING" or $specialdisctype=="OVERRIDINGAMOUNT"){
if($specialdisc<100 and $specialdisc>9){$specialdisc2 = "0.".$specialdiscremove;}
elseif($specialdisc<10){$specialdisc2 = "0.0".$specialdiscremove;}
else{$specialdisc2 = 1;}

$newless = $gross * $specialdisc2;
$amount = $gross - $newless;
$discount = $newless;
}
// -------------------------------------------------------------------------
if(strpos($acctno, "R-")!==false){}else{
if(strpos($accttitle, "PHARMACY/MEDICINE")!== false or strpos($accttitle, "SUPPLIES")!== false){
$ckmed++;
$discount = $wvat + $scpwd; 
$amount = $gross - $discount;
}
if(strpos($accttitle, "PHARMACY/MEDICINE")=== false and strpos($accttitle, "SUPPLIES")=== false){$notmedsup++;}
}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------


$pfcode="";
if($accttitle=="PROFESSIONAL FEE"){
$pf = $conn->query("select * from docfile where name='$description'");
while($pf1 = $pf->fetch_assoc()){$pfcode = $pf1['code'];}
}


$date = date("M-d-Y");
//$sqla1s = "delete from collection where refno='$refno' and acctno='$acctno'";
//if ($conn->query($sqla1s) === TRUE) {echo "<h1> insert collection	</h1> ";}
$sqla1 = "INSERT INTO collection (refno, acctno, acctname, ofr, description, accttitle, amount, discount, date, Dept, username, shift, type, paymentTime,
 paidBy, datearray, branch, batchno, pfcode) values ('$refno','$acctno','$acctname','$ofr','$description','$accttitle','$amount','$discount','$date','$Dept',
 '$username','$shift','$type','$timex','$dept','$datearray','$branch', '$ofr', '$pfcode')";
if ($conn->query($sqla1) === TRUE) {echo "<h1> insert collection	</h1> "; $samp="done";}
else{
$samp="not-done";
$conn->query("update collection set amount='$amount', discount='$discount', paidBy='$dept', type='$type', ofr='$ofr', username='$user', batchno='$ofr', paymentTime=CURTIME(), datearray=CURDATE(), pfcode='$pfcode' where acctno='$acctno' and refno='$refno'");
}

//$sqla1z = "insert into collection_mirror values ('$refno','$acctno','$acctname','$ofr','$description','$accttitle','$amount','$discount','$date','$Dept','$username','$shift','$type','$timex','$dept','$datearray','$branch','$qtyy1')";
//if ($conn->query($sqla1z) === TRUE) {echo "<h1> insert collection	</h1> ";}

$sqla11 = "update acctgenledge set status ='PAID' where refno='$refno'";
if ($conn->query($sqla11) === TRUE) {echo "<h1> update acctgenledge	AR -</h1> ";}

$sqla11 = "update productout set status ='PAID', approvalno='' where refno='$refno' and caseno='$acctno'";
if ($conn->query($sqla11) === TRUE) {echo "<h1> update productout	</h1> ";}

$sqla11 = "update productouthm set status ='PAID', approvalno='' where refno='$refno' and caseno='$acctno'";
if ($conn->query($sqla11) === TRUE) {echo "<h1> update productout	</h1> ";}

//FOR LABPENDING --> MARK 2021-08=26
$sqla11 = "update labpending set status ='PAID' where refno='$refno'";
if ($conn->query($sqla11) === TRUE) {echo "<h1> update labpending	</h1> ";}


//$sqla12 = "insert into collectiondetails values ('$refno','$acctno','$acctname','$ofr','$description','$accttitle','$srp','$qtyy1','$gross','$discount','$amount','$date','$Dept','$username','$shift','$type','$timex','$dept','$datearray','$branch','$ccname','$ccno','$actual','$bank')";
//if ($conn->query($sqla12) === TRUE) {echo "<h1> insert collectiondetails	</h1> ";}

//$conn->query("insert into dimple03 (`refno`, `acctno`, `acctname`, `ofr`, `description`, `accttitle`, `srp`, `qty`, `gross`, `discount`, `net`, `date`, `Dept`, `username`, `shift`, `type`, `paymentTime`, `paidBy`, `datearray`, `branch`, `ccname`, `ccno`, `actual_amount`, `bank`, `isvat`, `wvat`, `scpwd`, `scdiscount`, `lotno`) values ('$refno','$acctno','$acctname','$ofr','$description','$accttitle','$srp','$qtyy1','$gross','$discount','$amount','$date','$Dept','$username','$shift','$type','$timex','$dept','$datearray','$branch',
//'$ccname','$ccno','$actual','$bank','$isvat','$wvat','$senior','$scpwd','$lotno')");

$sqla1 = "insert into collectiondetails2 (`refno`, `acctno`, `acctname`, `ofr`, `description`, `accttitle`, `srp`, `qty`, `gross`, `discount`, `net`, `date`, `Dept`, `username`, `shift`, `type`, `paymentTime`, `paidBy`, `datearray`, `branch`, `ccname`, `ccno`, `actual_amount`, `bank`, `isvat`, `wvat`, `scpwd`, `scdiscount`, `lotno`, `sdisc_percent`, `sdisc_amount`, `sdisc_type`) values ('$refno','$acctno','$acctname','$ofr','$description','$accttitle','$srp','$qtyy1','$gross','$discount','$amount','$date','$Dept','$username','$shift','$type','$timex','$dept','$datearray','$samp',
'$ccname','$ccno','$actual','$bank','$isvat','$wvat','$senior','$scpwd','$lotno', '$specialdisc2', '$newless', '$specialdisctype')";
if ($conn->query($sqla1) === TRUE) {echo "<h1> insert collectiondetails</h1> ";}
}
//-------------------------------------------------------------------->

$sqla11 = "INSERT INTO `orno_used`(`orseries`, `or_used`) VALUES ('$orseries', '$ofr')";
if ($conn->query($sqla11) === TRUE) {echo "<h1> update productout	</h1> ";}

if($sukicard!=""){
$points = floor($totamm/100);
if($points>0){$conn->query("INSERT INTO `sukicarddetails`(`cardno`, `amount`, `points`, `datearray`, `refno`) VALUES ('$sukicard', '$totamm', '$points', CURDATE(), '$ofr')");}
}

//echo"
//<script>
//let a=document.createElement('a');
//a.target='_blank';
//a.href='http://$ip/2020codes/PrintOR/OR1-test20230921.php?orno=$ofr&datearray=$datearrayxx&name=$nursename&userunique=$userunique&branch=$branch&dept=$dept&$paidby';
//a.click();

//window.location='http://$ip/2020codes/PrintOR/OR1.php?orno=$ofr&datearray=$datearrayxx&name=$nursename&userunique=$userunique&branch=$branch&dept=$dept&$paidby';
//</script>
//";
//exit();

if(($ckmed>0 and $notmedsup==0) and ($dept=="CASHIER3" or $dept=="CASHIER2")){echo"<script>window.location='http://$ip/ERP/printslip/ORprint/$ofr';</script>";}
else{
echo"<script>window.location='http://$ip/2020codes/PrintOR/OR1.php?orno=$ofr&datearray=$datearrayxx&name=$nursename&userunique=$userunique&branch=$branch&dept=$dept&$paidby';</script>";
}

//echo"<script>window.location='printOR/kmsciOR.php?orno=$ofr';</script>";
}
?>