<?php
if(isset($_POST['btnsave'])){
$vdate = date("M-d-Y");
$datearrayxx = date("Y-m-d");
$ofr = $_POST['ofr'];
$orseries = $_POST['orseries'];
$datenow = date("M-d-Y");
$paymenttype = $_POST['paymenttype'];

if($ofr==""){$ofr=0;}else{$or = $conn->query("select * from collection where ofr='$ofr'");}

if(mysqli_num_rows($or)>0){$ofr = $ofr."-0";}
//if(mysqli_num_rows($or)>0){echo"<script>alert('ORNO is already used!'); window.location= 'finalbill2.php?caseno=$caseno$datax';</script>"; exit();}
//else{

$sql = "SELECT * FROM collection_temp2 where acctno = '$caseno'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$refno = $row['refno'];
$description = $row['description'];
$accttitle = $row['accttitle'];
$amount = $row['amount'];
$type = $row['type'];
$branchx = $row['branch'];
$shift = $row['shift'];
$pfcode="";
if($type=="pending"){$ofrx=""; $stat = "credit"; $stat2="pending";}else{$ofrx=$ofr; $stat="debit"; $stat2="PAID"; $type=$paymenttype;}

if($accttitle=="PROFESSIONAL FEE"){
$pf = $conn->query("select * from docfile where name='$description'");
while($pf1 = $pf->fetch_assoc()){$pfcode = $pf1['code'];}
}

$sqla11 = "INSERT INTO `collection`(`refno`, `acctno`, `acctname`, `ofr`, `description`, `accttitle`, `amount`, `discount`, `date`, `Dept`, `username`, `shift`, `type`, `paymentTime`, `paidBy`, `datearray`, `branch`, `batchno`, `pfcode`) VALUES ('$refno', '$caseno', '$name', '$ofrx', '$description', '$accttitle', '$amount', '', '$vdate',
'in', '$user', '$shift', '$type', CURTIME(), '$dept', CURDATE(), '$branchx', '$ofr', '$pfcode')";
if ($conn->query($sqla11) === TRUE) {echo "<h1> Insert Collection </h1> ";}

$sqla1 = "insert into collectiondetails2 (`refno`, `acctno`, `acctname`, `ofr`, `description`, `accttitle`, `srp`, `qty`, `gross`, `discount`, `net`,
 `date`, `Dept`, `username`, `shift`, `type`, `paymentTime`, `paidBy`, `datearray`, `branch`, `ccname`, `ccno`, `actual_amount`, `bank`, `isvat`, 
 `wvat`, `scpwd`, `scdiscount`, `lotno`, `sdisc_percent`, `sdisc_amount`, `sdisc_type`) values ('$refno','$caseno','$name','$ofrx','$description',
 '$accttitle','$amount','1','$amount','0','$amount','$vate','in','$user','$shift','$type','CURTIME()','$dept','CURDATE()','$samp',
'$ccname','$ccno','$actual','$bank','$isvat','$wvat','$senior','$scpwd','$lotno', '$specialdisc2', '$newless', '$specialdisctype')";
if ($conn->query($sqla1) === TRUE) {echo "<h1> insert collectiondetails</h1> ";}

$sqlsave2=mysqli_query($conn,"INSERT INTO `acctgenledge`(`refno`, `acctitle`, `transaction`, `amount`, `date`, `caseno`, `status`) VALUES ('$refno', '$accttitle', '$stat', '$amount', '$datenow' ,'$caseno' ,'$stat2')");
}


// ----------------------------------------------------
$sqla11 = "delete from collection_temp2 where acctno = '$caseno'";
if ($conn->query($sqla11) === TRUE) {}

$sqla11 = "update admission set corp = 'FINAL-PAID' where caseno = '$caseno'";
if ($conn->query($sqla11) === TRUE) {}

if($ofr!=""){
$conn->query("INSERT INTO orno_used(orseries,or_used) VALUES('$orseries','$ofr')");

echo"
<script>
alert('saved');
let a=document.createElement('a');
a.target='_blank';
a.href='http://$ip/2020codes/PrintOR/OR1.php?orno=$ofr&datearray=$datearrayxx&name=$user&userunique=$userunique&branch=$branch&dept=$dept';
a.click();
</script>
";
}

echo"<script>window.location= 'finalbill2.php?caseno=$caseno$datax';</script>";

//}


}
?>
