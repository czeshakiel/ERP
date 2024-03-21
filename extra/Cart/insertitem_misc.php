<?php
  mysqli_query($conn,"INSERT INTO `productout`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`, `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`) VALUES ('$refno', '$invno', '$caseno', '$kconcode', '$itemname', '$sp', '$qty', '$adjustment', '$gross', '$trantype', '0', '0', '$gross', '$pdate', '$status', 'pending', '$ccname', '$tick', '', '$kconunit', '$apprno', '$referenceno', '', 'NEW', '$station', '".date("Y-m-d")."', '0')");

  $rnoplus=$rno+1;
  mysqli_query($conn,"UPDATE myCounter SET prefnocount='$rnoplus' WHERE counterno='1'");

 //include "arv_includes.php";
?>
