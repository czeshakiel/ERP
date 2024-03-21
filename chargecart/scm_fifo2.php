<?php
$dept2 = "pharmacy"; $i=1; $gencode = date("YmdHis");
$sql2 = "SELECT code, rrno, SUM(quantity) AS quantity, (unitcost) as unitc FROM stocktable WHERE code='$code' AND dept='PHARMACY' GROUP BY rrno having sum(quantity) > 0 ORDER BY rrno DESC";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$rrno=$row2['rrno'];
$quantity=$row2['quantity'];
$unitc=$row2['unitc'];

if($qty1>0){
// Quantity = SOH
// Qty = Qty Request
if($quantity>=$qty1){
$refno_arv = "AUTOGEN".$gencode.$i;
$net = $ind_net * $qty1;
$adjustment = $ind_ad * $qty1;
	
$conn->query("INSERT INTO `productout`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`,
 `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`,
 `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`) VALUES ('$refno_arv',CURTIME(),'$caseno','$code','$desc','$sp','$qty1',
 '$adjustment','$net','$btn','0','0','$net','$datex','$appr','$rrno','$user','$batchno','$prodtype','$unit','insert-1','QR-$qty1','processing','HOMEMEDS',
 '$dept2',CURDATE(),'')");

$conn->query("INSERT INTO `productouthm`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`,
 `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`,
 `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`) VALUES ('$refno_arv',CURTIME(),'$caseno','$code','$desc','$sp','$qty1',
 '$adjustment','$net','$btn','0','0','$net','$datex','$appr','$rrno','$user','$batchno','$prodtype','$unit','insert-1','QR-$qty1','processing','HOMEMEDS',
 '$dept2',CURDATE(),'')");
 
// ---------- Insert to HOME MEDS -----------------
$conn->query("INSERT INTO `homemeds`(`caseno`, `refno`, `code`, `dosage`, `frequency`, `tam`, `tnn`, `tpm`, `tmn`, `duration`, `dateadded`, `addedby`, `batchno`) VALUES ('$caseno','$refno_arv','$code','$route','$freq','','','','','',NOW(),'$user', '$batchno')");

$conn->query("INSERT INTO `productoutconsult`(`caseno`, `productdesc`, `quantity`, `batchno`, `route`, `frequency`) VALUES ('$caseno','$desc','$qty1','$batchno',''$route,'$freq')");

//echo "<script>alert('Trans: 1   request: $qty1  soh: $quantity  Insert: $qty1');</script>";
$qty1=0; $i++;

}else{
$refno_arv = "AUTOGEN".$gencode.$i;
$net = $ind_net * $quantity;
$adjustment = $ind_ad * $quantity;

$conn->query("INSERT INTO `productout`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`,
 `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`,
 `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`) VALUES ('$refno_arv', CURTIME(),'$caseno','$code','$desc','$sp','$quantity',
 '$adjustment','$net','$btn','0','0','$net','$datex','$appr','$rrno','$empid','$batchno','$prodtype','$unit','insert-2','QR-$quantity','pending','HOMEMEDS',
 '$dept2',CURDATE(),'')");
	
$conn->query("INSERT INTO `productouthm`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`,
 `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`,
 `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`) VALUES ('$refno_arv', CURTIME(),'$caseno','$code','$desc','$sp','$quantity',
 '$adjustment','$net','$btn','0','0','$net','$datex','$appr','$rrno','$empid','$batchno','$prodtype','$unit','insert-2','QR-$quantity','pending','HOMEMEDS',
 '$dept2',CURDATE(),'')");

//echo "<script>alert('Trans: 2  request: $qty1  soh: $quantity  Insert: $quantity');</script>";
$qty1 = $qty1 - $quantity; $i++;

// ---------- Insert to HOME MEDS -----------------
$conn->query("INSERT INTO `homemeds`(`caseno`, `refno`, `code`, `dosage`, `frequency`, `tam`, `tnn`, `tpm`, `tmn`, `duration`, `dateadded`, `addedby`, `batchno`) VALUES ('$caseno','$refno_arv','$code','$route','$freq','','','','','',NOW(),'$user', '$batchno')");

$conn->query("INSERT INTO `productoutconsult`(`caseno`, `productdesc`, `quantity`, `batchno`, `route`, `frequency`) VALUES ('$caseno','$desc','$quantity','$batchno',''$route,'$freq')");
}

} 
}


// ---------------------------------->>>>> NO RR (QTY AVALABLE IN STOCKTABLE) <<<<--------------------------------------
if($qty1>0){
$refno_arv = "MYHM".date("YmdHis");
$net = $ind_net * $qty1;
$adjustment = $ind_ad * $qty1;

$conn->query("INSERT INTO `productout`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`,
 `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`,
 `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`) VALUES ('$refno_arv', CURTIME(),'$caseno','$code','$desc','$sp','$qty1',
 '$adjustment','$net','homemeds','0','0','$net','$datex','$appr','$rrno','$empid','$batchno','$prodtype','$unit','insert-2','QR-$quantity','pending','HOMEMEDS',
 '$dept2',CURDATE(),'')");
	
$conn->query("INSERT INTO `productouthm`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`,
 `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`,
 `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`) VALUES ('$refno_arv', CURTIME(),'$caseno','$code','$desc','$sp','$qty1',
 '$adjustment','$net','homemeds','0','0','$net','$datex','$appr','$rrno','$empid','$batchno','$prodtype','$unit','insert-2','QR-$quantity','pending','HOMEMEDS',
 '$dept2',CURDATE(),'')");

// ---------- Insert to HOME MEDS -----------------
$conn->query("INSERT INTO `homemeds`(`caseno`, `refno`, `code`, `dosage`, `frequency`, `tam`, `tnn`, `tpm`, `tmn`, `duration`, `dateadded`, `addedby`, `batchno`) VALUES ('$caseno','$refno_arv','$code','$route','$freq','','','','','',NOW(),'$user', '$batchno')");
$conn->query("INSERT INTO `productoutconsult`(`caseno`, `productdesc`, `quantity`, `batchno`, `route`, `frequency`) VALUES ('$caseno','$desc','$qty1','$batchno',''$route,'$freq')");

//echo "<script>alert('Trans: 3  request: $qty1  soh: 0  Insert: $qty1');</script>";
}
?>
