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

  mysqli_query($conn,"INSERT INTO `productout`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`, `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`, `cdisc`, `scpwd`, `remarks`, `addons`) VALUES ('$refno', '$invno', '$caseno', '$code', '$itemname', '$sp', '$qty', '$adjustment', '$gross', '$trantype', '$phic1', '$hmo', '$excess', '$pdate', '$status', 'pending', '$ccname', '$tick', '$lotno', '$unit', '$apprno', '$referenceno', '', 'NEW', '$station', '".date("Y-m-d")."', '$phic2', '$adjustment', '$sn', '$remarks', '$referenceno')");

  $pd=date("M_d_y_H:i");

  if($unit=="LABORATORY"){
    mysqli_query($conn,"INSERT INTO `labtest` (`caseno`, `test`, `testdetails`, `timeofreq`, `refno`, `labno`, `specs`, `interval`, `remarks`) VALUES ('$caseno','$lotno','$itemname','$pd','$refno','0','requested','','$remarks')");

    //Lab Pending----------------------------------------------------------------------------------
    //if(($code!='210330142232p-3')&&($code!='210412153403p-3')&&($code!='210519084140p-3')&&($code!='210823152208p-3')&&($code!='210901082034p-3')&&($code!='210330142303p-3')&&($code!='210407140138p-3')&&($code!='210407140432p-3')&&($code!='210804162541p-3')&&($code!='210901082006p-3')&&($code!="10007083p-3")){
    mysqli_query($conn,"INSERT INTO `labpending` (`refno`, `patientidno`, `caseno`, `patientname`, `itemcode`, `productdesc`, `ptype`, `trantype`, `status`, `resultstatus`, `labtype`, `station`, `dateadded`, `timeadded`, `user`, `viewcount`) VALUES ('$refno', '$patientidno', '$caseno', '$patname', '$code', '$itemname', '$unit', '$trantype', '$status', 'pending', '$lotno', '$station', '".date("Y-m-d")."', '".date("H:i:s")."', '$ccname', '0')");
    //}
    //---------------------------------------------------------------------------------------------
  }
  else if($unit=="XRAY"){
    mysqli_query($conn,"INSERT INTO `labpending` (`refno`, `patientidno`, `caseno`, `patientname`, `itemcode`, `productdesc`, `ptype`, `trantype`, `status`, `resultstatus`, `labtype`, `station`, `dateadded`, `timeadded`, `user`, `viewcount`) VALUES ('$refno', '$patientidno', '$caseno', '$patname', '$code', '$itemname', '$unit', '$trantype', '$status', 'pending', '$lotno', '$station', '".date("Y-m-d")."', '".date("H:i:s")."', '$ccname', '0')");
  }
  else{
    if($code=="210906184316p-50"){
      mysqli_query($conn,"INSERT INTO `labtest` (`caseno`, `test`, `testdetails`, `timeofreq`, `refno`, `labno`, `specs`, `interval`, `remarks`) VALUES ('$caseno','$lotno','$itemname','$pd','$refno','0','requested','','$remarks')");
    }
  }

  $rnoplus=$rno+1;
  mysqli_query($conn,"UPDATE `myCounter` SET `prefnocount`='$rnoplus' WHERE `counterno`='1'");
?>
