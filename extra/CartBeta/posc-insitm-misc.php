<?php
  mysqli_query($tmpconn,"INSERT INTO `productout` (`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`, `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`, `cdisc`, `scpwd`, `remarks`, `addons`) VALUES ('$refno', '$invno', '$caseno', '$kconcode', '$itemname', '$sp', '$qty', '$adjustment', '$gross', '$trantype', '0', '0', '$gross', '$pdate', '$status', 'pending', '$cnm', '$tick', '', '$kconunit', '$apprno', '$referenceno', '', 'NEW', '$dept', '".date("Y-m-d")."', '0', '$adjustment', '$sn', '$itmrema', '$itmaddons')");

  $rnoplus=$rno+1;
  mysqli_query($conn,"UPDATE myCounter SET prefnocount='$rnoplus' WHERE counterno='1'");
?>
