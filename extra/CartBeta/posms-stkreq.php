<?php
if($unit=="PHARMACY/MEDICINE"){
  $requesteddept="PHARMACY";
}
else if(($unit=="PHARMACY/SUPPLIES")||($unit=="MEDICAL SURGICAL SUPPLIES")||($unit=="MEDICAL SUPPLIES")){
  $requesteddept="CSR2";
}

$cposql=mysqli_query($tconn,"SELECT `po` FROM `purchaseorder` WHERE `dept`='$requesteddept' AND `reqdept`='$stk'");
if(mysqli_num_rows($cposql)==0){
  $reqno=$stk."-".date("YmdH").strtoupper(substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 3));
}
else{
  $cpofetch=mysqli_fetch_array($cposql);
  $reqno=$cpofetch['po'];
}


$rnd=strtoupper(substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 2));
$porefno="RN".date("YmdHis").$rnd;

mysqli_query($tconn,"INSERT INTO `purchaseorder` (`rrno`, `transdate`, `supplier`, `suppliercode`, `terms`, `trantype`, `code`, `description`, `unitcost`, `generic`, `prodqty`, `dept`, `status`, `prodtype1`, `po`, `user`, `approvingofficer`, `reqdept`, `reqno`, `reqdate`, `requser`) VALUES ('$rrno', '$porefno', '$requesteddept', '$requesteddept', '', 'NONE', '$code', '$desc', '$uc', '".date("Y-m-d")."', '$relqty', '$requesteddept', 'request', '$refno', '$reqno', '$user', 'charge', '$stk', '$reqno', '".date("Y-m-d")."', '$user')");
?>
