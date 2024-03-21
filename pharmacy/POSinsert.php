<?php
$ipaddressxx = $_SERVER['REMOTE_ADDR'];
$sql = "SELECT * from receiving where code = '$code'";
$result = $conn->query($sql);
$checkreceiving = mysqli_num_rows($result);
while($row = $result->fetch_assoc()){
$desc=$row['description'];
$code=$row['code'];
$unitcost=$row['unitprice'];
$lotno=$row['lotno'];
$testcode = $row['testcode'];
$prodtype = $row['unit'];
$itemname = $row['itemname'];
$generic = $row['generic'];
}

$desc = str_replace("ams-", "", $desc);
$desc = str_replace("-med", "", $desc);
$desc = str_replace("-sup", "", $desc);

$itemname = "$desc ($generic)";

if($checkreceiving>0){
$result2 = $conn->query("SELECT sum(quantity) as qtyy FROM stocktable where code='$code' and dept='$dept'");
while($row2 = $result2->fetch_assoc()) {$qty_stock=$row2['qtyy'];}

$result2222 = $conn->query("SELECT unitcost from stocktable where code='$code' and trantype IN ('charge', 'cash') order by datearray DESC limit 1");
while($row2222 = $result2222->fetch_assoc()) {$unitp=$row2222['unitcost'];}

$result22223 = $conn->query("SELECT opd from productsmasterlist where code='$code'");
while($row22223 = $result22223->fetch_assoc()) { $phic=$row22223['opd'];}

$result22223f = $conn->query("SELECT dis from poswalkin2 where ipaddress='$ipaddressxx' and ttype='$ttype' group by ipaddress");
while($row22223f = $result22223f->fetch_assoc()) { $dis=$row22223f['dis'];}
if($dis==""){$dis="N";}

if($ttype=="PATIENT" and $dis=="N"){$price = "cashPOS";}
elseif($ttype=="PATIENT" and $dis=="Y"){$price = "seniorPOS";}
else{$price = "cashPOSdoc";}

if($qty1>$qty_stock){echo"<script>alert('Quantity request is greater that quantity onhand.');</script>";}else{
$datalist = $prodtype."||".$lotno."||".$unitp."||".$phic."||".$testcode."||".$qty1."||".$code;
list($sp, $newgross, $newadj, $newnet, $lessvat, $less) = $price($datalist);

$sql = "INSERT INTO `poswalkin2`(`code`, `desc`, `sellingprice`, `qty`, `gross`, `adjustment`,`net`, `lotno`, `unitcost`, `ipaddress`, `dis` , `wvat`, `ttype`, `lessvat`, `less`)
 VALUES ('$code','$itemname','$sp','$qty1','$newgross','$newadj','$newnet','$lotno','$unitp','$ipaddressxx','$dis' ,'$testcode' ,'$ttype','$lessvat','$less')";	
if($conn->query($sql) === TRUE) {}


if($ttype == "PATIENT"){echo"<script>window.location = '?pos';</script>";}
elseif($ttype == "DOCTOR"){echo"<script>window.location = '?ardoctor';</script>";}
else{echo"<script>window.location = '?aremployee';</script>";}	

} }else{echo"<script>alert('NO ITEM FOUND IN DATABASE!');</script>";}
?>