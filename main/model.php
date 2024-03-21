<?php

function get_reader_pf($code){

}

function testtobedone($caseno, $refno, $user){
include "../main/connection.php";
$conn->query("update productout set administration='Testtobedone' where refno='$refno' and caseno='$caseno'");
$conn->query("INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('procedure of patient $caseno with refno: $reno is set as Test to be done.', '$user', CURDATE(), CURTIME())");
}



function forrefund($caseno, $refno, $user){
include "../main/connection.php";
$conn->query("update productout set administration='for refund' where refno='$refno' and caseno='$caseno'");
$conn->query("INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('procedure of patient $caseno with refno: $reno is request for refund.', '$user', CURDATE(), CURTIME())");
}




function ARtrade_otp($caseno){
include "../main/connection.php";
$otp = rand(100000,999999);

$sql1 = $conn->query("select * from admission a, patientprofile p where a.patientidno=p.patientidno and a.caseno='$caseno'");
while($res1 = $sql1->fetch_assoc()){$name = strtoupper($res1['lastname'].", ".$res1['firstname']." ".$res1['middlename']);}

$resultcf = $conn->query("SELECT sum(amount) as tot FROM collection_temp2 where acctno='$caseno' and accttitle like '%TRADE%'");
while($rowcf = $resultcf->fetch_assoc()){$total = number_format($rowcf['tot'], 2);}

$conn->query("insert into otp (caseno, otp, status) VALUES ('$caseno', '$otp', 'pending')");

$data = array(
'Body' => 'Patient [ '.$caseno.' ] '.$name.' request for AR-TRADE transaction with the amount of P'.$total.'. Your ONE-TIME PIN (OTP) is: '.$otp.'',
'From' => '+16812029765',
'To' => '+639512619967'
);

$ch = curl_init('https://api.twilio.com/2010-04-01/Accounts/AC7b11d9505dec7829aff10f265da13c88/Messages.json');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, 'AC7b11d9505dec7829aff10f265da13c88:665d1170dc97cf951cd399c7dcf91bed');
$result = curl_exec($ch);
curl_close($ch);
//echo $result;
}



function UpdateStatus($caseno){
include "../main/connection.php";
$result2 = $conn->query("SELECT * FROM productout where caseno='$caseno' and administration='dispensed' and (productsubtype LIKE '%PHARMACY/MEDICINE%' or
productsubtype LIKE '%PHARMACY/SUPPLIES%') and quantity > 0 AND trantype='charge'");
if(mysqli_num_rows($result2)>0){
while($row2 = $result2->fetch_assoc()) {
$apr=$row2['approvalno'];

$date=explode('_',$apr);
$time1=strtotime($date[0]." ".$date[1]);
$time2=strtotime(date('Y-m-d H:i:s'));
$hour=abs($time2-$time1)/(60*60);
if($hour >= 10 and $hour < 12){
$warning=$warning+1;
}elseif($hour >= 24){
$locked=$locked+1;
}
}
}

if($warning > 0){$conn->query("UPDATE admission SET `status`='WARNING' WHERE caseno='$caseno'");}
elseif($locked > 0){$conn->query("UPDATE admission SET `status`='LOCKED' WHERE caseno='$caseno'");}
else{
$result2s = $conn->query("SELECT status FROM admission WHERE caseno='$caseno'");
while($row2s = $result2s->fetch_assoc()) {$astat=$row2s['status'];}
if($astat=="MGH"){}
else{
if($astat=="YELLOW TAG"){}
else{
$conn->query("UPDATE admission SET `status`='Active' WHERE caseno='$caseno'");
}
}
}
}



function fifo_issuance($code, $dept, $reqdept, $qtyy, $reqno, $user, $mytype){
include "../main/connection.php";
$reqqty = $qtyy;
$sql2 = "SELECT code, rrno, SUM(quantity) AS quantity, (unitcost) as unitc, expiration FROM stocktable WHERE code='$code' AND dept='$dept'
GROUP BY rrno having sum(quantity) > 0 ORDER BY rrno DESC";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$rrno=$row2['rrno'];
$quantity=$row2['quantity'];
$unitc=$row2['unitc'];
$expiration=$row2['expiration'];
$lotno=$row2['lotno'];

$sqlh = "SELECT * from receiving where code='$code'";
$resulth = $conn->query($sqlh);
while($rowh = $resulth->fetch_assoc()) {
$unit = $rowh['unit'];
$gen = $rowh['generic'];
$desc = $rowh['description'];
if($unit=="PHARMACY/MEDICINE"){$prodtype = "med";}else{$prodtype = "sup";}
}

// Quantity = SOH
// Qtyy = Qty Request

if($qtyy>0){
if($quantity>=$qtyy){
$conn->query("INSERT INTO `stocktable`(`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`,
`recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`,
`prevqty`, `stockalert`, `duedate`, `datearray`, `timearray`) VALUES ('', '$rrno', '', '', '$dept', '$dept', '$code', '$desc', '$unitc', '$qtyy', '$qtyy', '$gen', '$qtyy',
'$expiration', '$lotno', 'STOCK TRANSFER', 'NONE', CURDATE(), '$reqdept', '', '$mytype', '$reqno', '$user', '', 'u', CURTIME(), CURDATE(), CURTIME())");

$conn->query("INSERT INTO `stocktable`(`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`,
`recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`,
`prevqty`, `stockalert`, `duedate`, `datearray`, `timearray`) VALUES ('', '$rrno', '', '', '$dept', '$dept', '$code', '$desc', '$unitc', '-$qtyy', '$qtyy', '$gen', '$qtyy',
'$expiration', '$lotno', 'STOCK TRANSFER', 'NONE', CURDATE(), '$dept', '', '$mytype', '$reqno', '$user', '', 'u', CURTIME(), CURDATE(), CURTIME())");

$conn->query("INSERT INTO `purchaseorder`(`rrno`, `transdate`, `supplier`, `suppliercode`, `terms`, `trantype`, `code`, `description`, `unitcost`,
 `generic`, `prodqty`, `dept`, `status`, `prodtype1`, `po`, `user`, `approvingofficer`, `reqdept`, `reqno`, `reqdate`, `requser`) VALUES ('$rrno', '', '$dept', '$dept', 'NONE', '', '$code', '$desc',
  '$unitc', '$gen', '$qtyy', '$dept', 'received', '', '$reqno', '$user', 'charge', '$reqdept', '$reqno', CURDATE(), '$user')");

$qtyy=0;
}

else{
$conn->query("INSERT INTO `stocktable`(`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`,
`recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`,
`prevqty`, `stockalert`, `duedate`, `datearray`, `timearray`) VALUES ('', '$rrno', '', '', '$dept', '$dept', '$code', '$desc', '$unitc', '$quantity', '$quantity', '$gen', '$quantity',
'$expiration', '$lotno', 'STOCK TRANSFER', 'NONE', CURDATE(), '$reqdept', '', '$mytype', '$reqno', '$user', '', 'u', CURTIME(), CURDATE(), CURTIME())");

$conn->query("INSERT INTO `stocktable`(`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`,
`recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`,
`prevqty`, `stockalert`, `duedate`, `datearray`, `timearray`) VALUES ('', '$rrno', '', '', '$dept', '$dept', '$code', '$desc', '$unitc', '-$quantity', '$quantity', '$gen', '$quantity',
'$expiration', '$lotno', 'STOCK TRANSFER', 'NONE', CURDATE(), '$dept', '', '$mytype', '$reqno', '$user', '', 'u', CURTIME(), CURDATE(), CURTIME())");

$conn->query("INSERT INTO `purchaseorder`(`rrno`, `transdate`, `supplier`, `suppliercode`, `terms`, `trantype`, `code`, `description`, `unitcost`,
 `generic`, `prodqty`, `dept`, `status`, `prodtype1`, `po`, `user`, `approvingofficer`, `reqdept`, `reqno`, `reqdate`, `requser`) VALUES ('$rrno', '', '$dept', '$dept', 'NONE', '', '$code', '$desc',
'$unitc', '$gen', '$quantity', '$dept', 'received', '', '$reqno', '$user', 'charge', '$reqdept', '$reqno', CURDATE(), '$user')");

$qtyy = $qtyy - $quantity;
}

}

$conn->query("update purchaseorder set prodqty='$qtyy' where reqno='$reqno' and code='$code' and status='request'");

$xx = $conn->query("select * from purchaseorder where reqno='$reqno' and code='$code' and status='request'");
while($xx1 = $xx->fetch_assoc()){$prodqty = $xx1['prodqty'];}
$balance = $prodqty - $reqqty;

if($balance>0){$conn->query("update purchaseorder set status='cancel' where reqno='$reqno' and code='$code' and status='request'");}

}
}







// -------------------> NEAREST TO 5 Cents --------------->>>
function sp($data){
$sp = number_format($data, 2, '.', '');
$ck = substr($sp, -1);
if(($ck==1) || ($ck==2) || ($ck==3) || ($ck==4)){$val =  (5-$ck) * 0.01;}
elseif(($ck==6) || ($ck==7) || ($ck==8) || ($ck==9)){$val =  (10-$ck) * 0.01;}
else{$val=0;}
$sp = $sp + $val;
return $sp;
}
// ---------------> END NEAREST TO 5 Cents --------------->>>



// ------------------------AR EMP/DOC PRICING ---------------------------------
function cashPOSdoc($data){
include "../main/connection.php";
list($producttype, $lotno, $unitcost, $fixprice, $mdrp, $qty1) = explode("||", $data);
    
if($lotno=="M" || $lotno==""){
$markup = 0.60;
$vat = 0.12;
$max = 0.20;
$markup1 = 1.60;
$vat1 = 1.12;
$max1 = 1.20;
    
$sp = $unitcost * $markup1;
$sp = sp($sp);
//if($mdrp=="0"){$sp = $sp * $vat1;}
$less = $sp * $max;
$Less = $less * $qty1;
$newgross = $sp * $qty1;
$newadj = $less;
$newnet = $newgross - $newadj;
}else{
$sp = $fixprice;
$sp = sp($sp);
$newgross = $sp * $qty1;
$newadj = 0;
$newnet = $newgross - $newadj;
}
return array ($sp, $newgross, $newadj, $newnet, $lessvat, $less);
}
// ------------------- END AR EMP/DOC PRICING ---------------------------------



// -------------------------- POS PRICING ---------------------------------
function cashPOS($data){
include "../main/connection.php";
list($producttype, $lotno, $unitcost, $fixprice, $mdrp, $qty1, $code) = explode("||", $data);

if($lotno=="M" || $lotno==""){
$sp = $unitcost * 1.30; //IOM xxxx
$sp = sp($sp);


$mk = $conn->query("select * from markupaddon where status='1' and trantype='cash' order by sort");
while($mk1 = $mk->fetch_assoc()){$sp = $sp + ($sp * $mk1['addon']); $sp = sp($sp);}


$sp = $sp * 1.12;
$sp = sp($sp);
$less = $sp * 0.26;
$less = $less * $qty1;
$newadj = $less;
$newgross = $sp * $qty1;
$newnet = $newgross - $newadj;

}else{
$sp = $fixprice;
$sp = sp($sp);
$newgross = $sp * $qty1;
$newadj = 0;
$newnet = $newgross - $newadj;

$dd = $conn->query("select * from receiving a, productsmasterlist b where a.code=b.code and a.code='$code' and optset4='specialpricing'");
if(mysqli_num_rows($dd)>0){
  $newadj = $newgross*0.02;
  $less = $newgross*0.02;
  $newnet = $newgross - $newadj;
}
}

return array ($sp, $newgross, $newadj, $newnet, $lessvat, $less);
}
// ---------------------- END POS PRICING ---------------------------------



// ------------------------ SENIOR CASH MED/SUP ---------------------------------
function seniorPOS($data){
include "../main/connection.php";
list($producttype, $lotno, $unitcost, $fixprice, $mdrp, $qty1) = explode("||", $data);

if($lotno=="M" || $lotno==""){
$max = 0.20;
$vat1 = 1.12;

$sp = $unitcost * 1.30; //IOM xxx
$sp = sp($sp);

$mk = $conn->query("select * from markupaddon where status='1' and trantype='cash' order by sort");
while($mk1 = $mk->fetch_assoc()){$sp = $sp + ($sp * $mk1['addon']); $sp = sp($sp);}

if($mdrp=="0"){
$sp = $sp * $vat1;
$sp = sp($sp);
$splessvat = $sp / $vat1;
if($producttype!="PHARMACY/MEDICINE"){$splessvat = $sp;}
$lessvat = $sp - $splessvat;
$less = $splessvat * $max;

$lessvat = $lessvat * $qty1;
$less = $less * $qty1;

$less2 = $less + $lessvat;
$newgross = $sp * $qty1;
}

else{
$sp = sp($sp);
$less = $sp * $max;
$less = $less * $qty1;
$newgross = $sp * $qty1;
}

$newadj = $lessvat + $less;
$newnet = $newgross - $newadj;
$checkm = "MARKUP";
}

else{
$sp = $fixprice;
$sp = sp($sp);
$max = 0.20;
$vat1 = 1.12;


if($mdrp=="0"){
$splessvat = $sp / $vat1;
if($producttype!="PHARMACY/MEDICINE"){$splessvat = $sp;}
$lessvat = $sp - $splessvat;
$less = $splessvat * $max;

$lessvat = $lessvat * $qty1;
$less = $less * $qty1;

$less2 = $less + $lessvat;
$newgross = $sp * $qty1;
}else{
$less = $sp * $max;
$less = $less * $qty1;
$newgross = $sp * $qty1;
}

$newadj = $less + $lessvat;
$newnet = $newgross - $newadj;
$checkm = "FIXED";
}

return array ($sp, $newgross, $newadj, $newnet, $lessvat, $less);
}
// -------------------- END SENIOR CASH MED/SUP ---------------------------------







function adjustment_entry($code, $desc, $oldqty, $qty, $comment, $transid, $updatedqty, $curdate, $curtime, $dept, $user){
  include "../main/connection.php";
//----------
$datex = date("M-d-Y");
$errno = $form = "e99".date("YmdHsi");
$po = "";
$invno = "";
$recdqty = "0";

$sql22j = "SELECT * from stocktable where code='$code' and dept='$dept' and (trantype='charge' or trantype='cash') order by datearray desc";
$result22j = $conn->query($sql22j);
$checker = mysqli_num_rows($result22j);

if($checker>0) {
while($row22j = $result22j->fetch_assoc()) {
$rrno=$row22j['rrno'];
$unitcost=$row22j['unitcost'];
$generic=$row22j['generic'];
$expiration=$row22j['expiration'];
$lotno=$row22j['lotno'];
$prodtype1 = $row22j['prodtype1'];
}

}else{
$rrno = "AUTO-".date("YmdHis");
$unitcost = "";
$generic = "";
$expiration = "";
$lotno="";
$prodtype1 = "";
}

$desc2 = $desc." (".$generic.")";
//echo "<script>alert('$code ----- $rrno ------- $lotno');</script>";

if(strpos($updatedqty, "-")!==false){
$updatedqty1 = str_replace("-", "", $updatedqty);

$jj = $conn->query("select sum(quantity) as qty, rrno, po, invno, unitcost, generic, expiration, lotno, prodtype1 from 
stocktable where code='$code' and dept='$dept' group by rrno  having sum(quantity)>0 order by rrno");
while($jj1 = $jj->fetch_assoc()){
$qtyrr = $jj1['qty'];
$rrno = $jj1['rrno'];
$po = $jj1['po'];
$invno = $jj1['invno'];
$unitcost=$jj1['unitcost'];
$generic=$jj1['generic'];
$expiration=$jj1['expiration'];
$lotno=$jj1['lotno'];
$prodtype1 = $jj1['prodtype1'];
  
if($updatedqty1>0){
if($qtyrr>=$updatedqty1){
$conn->query("insert into stocktable (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`,
 `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`,
  `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`, `timearray`) values 
  ('$datex','$rrno','$po','$invno','CPU','CPU','$code','$desc2','$unitcost','-$updatedqty1','$recdqty','$generic','$qty','$expiration','$lotno',
'ADJUSTMENT','NONE','$datex','$dept','$prodtype1','NONE','','$user','$errno','u','$due', '$curdate','$curtime')");
$updatedqty1 = 0;
}else{
$conn->query("insert into stocktable (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`,
`recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`,
 `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`, `timearray`) values
  ('$datex','$rrno','$po','$invno','CPU','CPU','$code','$desc2','$unitcost','-$qtyrr','$recdqty','$generic','$qty','$expiration','$lotno',
'ADJUSTMENT','NONE','$datex','$dept','$prodtype1','NONE','','$user','$errno','u','$due', '$curdate','$curtime')");
$updatedqty1 = $updatedqty1 - $qtyrr;
}
}

}


}else{
$conn->query("insert into stocktable (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`,
`recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`,
 `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`, `timearray`) values ('$datex','$rrno','$po','$invno','CPU','CPU','$code','$desc2',
 '$unitcost','$updatedqty','$recdqty','$generic','$qty','$expiration','$lotno',
'ADJUSTMENT','NONE','$datex','$dept','$prodtype1','NONE','','$user','$errno','u','$due', '$curdate','$curtime')"); 
}

$sqlx2222 = "INSERT INTO `scm_adjustmenthistory`(`transid`, `rrno`, `invno`, `code`, `desc`, `oldqty`, `newqty`, `reason`, `dept`, `user`, `datearray`, `timearray`)
 VALUES ('$transid','$rrno','$invno','$code','$desc','$oldqty','$qty','$comment','$dept','$user', '$curdate', '$updatedqty')";
if($conn->query($sqlx2222) === TRUE) {}
}


function getTextBetween($text, $start, $end) {
$startPos = strpos($text, $start);
if ($startPos === false) {return false;}
    
$startPos += strlen($start);
$endPos = strpos($text, $end, $startPos);
if ($endPos === false) {return false;}
    
return substr($text, $startPos, $endPos - $startPos);
}
?>