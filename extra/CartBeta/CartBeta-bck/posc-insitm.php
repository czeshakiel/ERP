<?php
if(isset($_GET['autodistro'])){
  $phic1=mysqli_real_escape_string($conn,$_GET['ph1']);
  $phic2=mysqli_real_escape_string($conn,$_GET['ph2']);
  $hmo=mysqli_real_escape_string($conn,$_GET['hmo']);
  $excess=mysqli_real_escape_string($conn,$_GET['exc']);
}
else{
  $phic1=0;
  $phic2=0;
  $hmo=0;
  $excess=$gross;
}

  //echo "INSERT INTO `productout`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`, `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`) VALUES ('$refno', '$invno', '$caseno', '$itmcode', '$itmname', '$sp', '$itmqty', '$adjustment', '$gross', '$trantype', '$phic1', '$hmo', '$excess', '$pdate', '$status', 'pending', '$cnm', '$tick', '$lotno', '$itmtype', '$apprno', '$referenceno', '', 'NEW', '$dept', '".date("Y-m-d")."', '$phic2')<br />";
  mysqli_query($tmpconn,"INSERT INTO `productout`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`, `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`) VALUES ('$refno', '$invno', '$caseno', '$itmcode', '$itmname', '$sp', '$itmqty', '$adjustment', '$gross', '$trantype', '$phic1', '$hmo', '$excess', '$pdate', '$status', 'pending', '$cnm', '$tick', '$lotno', '$itmtype', '$apprno', '$referenceno', '', 'NEW', '$dept', '".date("Y-m-d")."', '$phic2')");

  $pd=date("M_d_y_H:i");

  if($itmtype=="LABORATORY"){
    //echo "INSERT INTO `labtest` (`caseno`, `test`, `testdetails`, `timeofreq`, `refno`, `labno`, `specs`, `interval`, `remarks`) VALUES ('$caseno','$lotno','$itmname','$pd','$refno','0','requested','','$itmrema') <br />";
    mysqli_query($tmpconn,"INSERT INTO `labtest` (`caseno`, `test`, `testdetails`, `timeofreq`, `refno`, `labno`, `specs`, `interval`, `remarks`) VALUES ('$caseno','$lotno','$itmname','$pd','$refno','0','requested','','$itmrema')");

    //echo "INSERT INTO `labpending` (`refno`, `patientidno`, `caseno`, `patientname`, `itemcode`, `productdesc`, `ptype`, `trantype`, `status`, `resultstatus`, `labtype`, `station`, `dateadded`, `timeadded`, `user`, `viewcount`) VALUES ('$refno', '$patientidno', '$caseno', '$patname', '$itmcode', '$itemname', '$itmtype', '$trantype', '$status', 'pending', '$lotno', '$dept', '".date("Y-m-d")."', '".date("H:i:s")."', '$cnm', '0')<br />";
    mysqli_query($tmpconn,"INSERT INTO `labpending` (`refno`, `patientidno`, `caseno`, `patientname`, `itemcode`, `productdesc`, `ptype`, `trantype`, `status`, `resultstatus`, `labtype`, `station`, `dateadded`, `timeadded`, `user`, `viewcount`) VALUES ('$refno', '$patientidno', '$caseno', '$patname', '$itmcode', '$itemname', '$itmtype', '$trantype', '$status', 'pending', '$lotno', '$dept', '".date("Y-m-d")."', '".date("H:i:s")."', '$cnm', '0')");
  }
  else if($itmtype=="XRAY"){
    //echo "INSERT INTO `labpending` (`refno`, `patientidno`, `caseno`, `patientname`, `itemcode`, `productdesc`, `ptype`, `trantype`, `status`, `resultstatus`, `labtype`, `station`, `dateadded`, `timeadded`, `user`, `viewcount`) VALUES ('$refno', '$patientidno', '$caseno', '$patname', '$itmcode', '$itmname', '$itmtype', '$trantype', '$status', 'pending', '$lotno', '$dept', '".date("Y-m-d")."', '".date("H:i:s")."', '$cnm', '0')<br />";
    mysqli_query($tmpconn,"INSERT INTO `labpending` (`refno`, `patientidno`, `caseno`, `patientname`, `itemcode`, `productdesc`, `ptype`, `trantype`, `status`, `resultstatus`, `labtype`, `station`, `dateadded`, `timeadded`, `user`, `viewcount`) VALUES ('$refno', '$patientidno', '$caseno', '$patname', '$itmcode', '$itmname', '$itmtype', '$trantype', '$status', 'pending', '$lotno', '$dept', '".date("Y-m-d")."', '".date("H:i:s")."', '$cnm', '0')");
  }
  else{
    if($itmcode=="210906184316p-50"){
      //echo "INSERT INTO `labtest` (`caseno`, `test`, `testdetails`, `timeofreq`, `refno`, `labno`, `specs`, `interval`, `remarks`) VALUES ('$caseno','$lotno','$itmname','$pd','$refno','0','requested','','$itmrema')<br />";
      mysqli_query($tmpconn,"INSERT INTO `labtest` (`caseno`, `test`, `testdetails`, `timeofreq`, `refno`, `labno`, `specs`, `interval`, `remarks`) VALUES ('$caseno','$lotno','$itmname','$pd','$refno','0','requested','','$itmrema')");
    }
  }

$rnoplus=$rno+1;
//echo "UPDATE `myCounter` SET `prefnocount`='$rnoplus' WHERE `counterno`='1'";
mysqli_query($conn,"UPDATE `myCounter` SET `prefnocount`='$rnoplus' WHERE `counterno`='1'");
?>
