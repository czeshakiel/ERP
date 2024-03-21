<?php
  mysqli_query($mycon1,"INSERT INTO `productout`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`, `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`) VALUES ('$refno', '$invno', '$caseno', '$code', '$itemname', '$sp', '$qty', '$adjustment', '$gross', '$trantype', '0', '0', '$gross', '$pdate', '$status', 'pending', '$ccname', '$tick', '$lotno', '$unit', '$apprno', '$referenceno', '', 'NEW', '$station', '".date("Y-m-d")."', '0')");

  $pd=date("M_d_y_H:i");

  if($unit=="LABORATORY"){
    mysqli_query($mycon1,"INSERT INTO `labtest` (`caseno`, `test`, `testdetails`, `timeofreq`, `refno`, `labno`, `specs`, `interval`, `remarks`) VALUES ('$caseno','$lotno','$itemname','$pd','$refno','0','requested','','$remarks')");

    //Lab Pending----------------------------------------------------------------------------------
    //if(($code!='210330142232p-3')&&($code!='210412153403p-3')&&($code!='210519084140p-3')&&($code!='210823152208p-3')&&($code!='210901082034p-3')&&($code!='210330142303p-3')&&($code!='210407140138p-3')&&($code!='210407140432p-3')&&($code!='210804162541p-3')&&($code!='210901082006p-3')&&($code!="10007083p-3")){
    mysqli_query($mycon1,"INSERT INTO `labpending` (`refno`, `patientidno`, `caseno`, `patientname`, `itemcode`, `productdesc`, `ptype`, `trantype`, `status`, `resultstatus`, `station`, `dateadded`, `timeadded`, `user`, `viewcount`) VALUES ('$refno', '$patientidno', '$caseno', '$patname', '$code', '$itemname', '$unit', '$trantype', '$status', 'pending', '$station', '".date("Y-m-d")."', '".date("H:i:s")."', '$ccname', '0')");
    //}
    //---------------------------------------------------------------------------------------------
  }
  else if($unit=="XRAY"){
    mysqli_query($mycon1,"INSERT INTO `labpending` (`refno`, `patientidno`, `caseno`, `patientname`, `itemcode`, `productdesc`, `ptype`, `trantype`, `status`, `resultstatus`, `station`, `dateadded`, `timeadded`, `user`, `viewcount`) VALUES ('$refno', '$patientidno', '$caseno', '$patname', '$code', '$itemname', '$unit', '$trantype', '$status', 'pending', '$station', '".date("Y-m-d")."', '".date("H:i:s")."', '$ccname', '0')");
  }
  else{
    if($code=="210906184316p-50"){
      mysqli_query($mycon1,"INSERT INTO `labtest` (`caseno`, `test`, `testdetails`, `timeofreq`, `refno`, `labno`, `specs`, `interval`, `remarks`) VALUES ('$caseno','$lotno','$itemname','$pd','$refno','0','requested','','$remarks')");
    }
  }

  $rnoplus=$rno+1;
  mysqli_query($mycon1,"UPDATE myCounter SET prefnocount='$rnoplus' WHERE counterno='1'");

 //include "arv_includes.php";
?>
