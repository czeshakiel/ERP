<?php
    $fncount=mysqli_real_escape_string($tmpconn,$_POST['fncount']);

    //transfer productout start--------------------------------------------------------------------
    for($x=1;$x<=$fncount;$x++){
      $xlb="itmrfn".$x;
      $eachitm=mysqli_real_escape_string($tmpconn,$_POST[$xlb]);

      $xxsql=mysqli_query($tmpconn,"SELECT * FROM `productout` WHERE `refno`='$eachitm'");
      while($xxfetch=mysqli_fetch_array($xxsql)){
        $refno=$xxfetch['refno'];
        $invno=$xxfetch['invno'];
        $caseno=$xxfetch['caseno'];
        $productcode=$xxfetch['productcode'];
        $productdesc=$xxfetch['productdesc'];
        $sellingprice=$xxfetch['sellingprice'];
        $quantity=$xxfetch['quantity'];
        $adjustment=$xxfetch['adjustment'];
        $gross=$xxfetch['gross'];
        $trantype=$xxfetch['trantype'];
        $phic=$xxfetch['phic'];
        $hmo=$xxfetch['hmo'];
        $excess=$xxfetch['excess'];
        $date=$xxfetch['date'];
        $status=$xxfetch['status'];
        $terminalname=$xxfetch['terminalname'];
        $loginuser=$xxfetch['loginuser'];
        $batchno=$xxfetch['batchno'];
        $producttype=$xxfetch['producttype'];
        $productsubtype=$xxfetch['productsubtype'];
        $approvalno=$xxfetch['approvalno'];
        $referenceno=$xxfetch['referenceno'];
        $administration=$xxfetch['administration'];
        $shift=$xxfetch['shift'];
        $location=$xxfetch['location'];
        $senior=$xxfetch['senior'];
        $datearray=$xxfetch['datearray'];
        $phic1=$xxfetch['phic1'];
        $cvat=$xxfetch['cvat'];
        $cdisc=$xxfetch['cdisc'];
        $wvat=$xxfetch['wvat'];
        $scpwd=$xxfetch['scpwd'];
        $rmks=$xxfetch['remarks'];
        $addons=$xxfetch['addons'];

        //echo "INSERT INTO `productout` (`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`, `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`, `administration`, `shift`, `location`, `senior`, `datearray`, `phic1`) VALUES ('$refno', '$invno', '$caseno', '$productcode', '$productdesc', '$sellingprice', '$quantity', '$adjustment', '$gross', '$trantype', '$phic', '$hmo', '$excess', '$date', '$status', '$terminalname', '$loginuser', '$batchno', '$producttype', '$productsubtype', '$approvalno', '$referenceno', '$administration', '$shift', '$location', '$senior', '$datearray', '$phic1')<br />";
        mysqli_query($conn,"INSERT INTO `productout` (`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`, `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`, `administration`, `shift`, `location`, `senior`, `datearray`, `phic1`, `cvat`, `cdisc`, `wvat`, `scpwd`, `remarks`, `addons`) VALUES ('$refno', '$invno', '$caseno', '$productcode', '$productdesc', '$sellingprice', '$quantity', '$adjustment', '$gross', '$trantype', '$phic', '$hmo', '$excess', '$date', '$status', '$terminalname', '$loginuser', '$batchno', '$producttype', '$productsubtype', '$approvalno', '$referenceno', '$administration', '$shift', '$location', '$senior', '$datearray', '$phic1', '$cvat', '$cdisc', '$wvat', '$scpwd', '$rmks', '$addons')");
        //echo "DELETE FROM `productout` WHERE `refno`='$eachitm'<br />";
        mysqli_query($tmpconn,"DELETE FROM `productout` WHERE `refno`='$eachitm'");

        $yysql=mysqli_query($tmpconn,"SELECT * FROM `labtest` WHERE `refno`='$refno'");
        $yycount=mysqli_num_rows($yysql);
        if($yycount>0){
          $yyfetch=mysqli_fetch_array($yysql);
          $test=$yyfetch['test'];
          $timeofreq=$yyfetch['timeofreq'];
          $remarks=$yyfetch['remarks'];
          //echo "<br />";
          //echo "INSERT INTO `labtest` (`caseno`, `test`, `testdetails`, `timeofreq`, `refno`, `labno`, `specs`, `interval`, `remarks`) VALUES ('$caseno', '$test', '$productdesc', '$timeofreq', '$refno', '0', 'requested', '', '$remarks')<br />";
          mysqli_query($conn,"INSERT INTO `labtest` (`caseno`, `test`, `testdetails`, `timeofreq`, `refno`, `labno`, `specs`, `interval`, `remarks`) VALUES ('$caseno', '$test', '$productdesc', '$timeofreq', '$refno', '0', 'requested', '', '$remarks')");
          //echo "DELETE FROM `labtest` WHERE `refno`='$refno'<br />";
          mysqli_query($tmpconn,"DELETE FROM `labtest` WHERE `refno`='$refno'");
        }
        //echo "<br />";
        $zzsql=mysqli_query($tmpconn,"SELECT * FROM `labpending` WHERE `refno`='$refno'");
        $zzcount=mysqli_num_rows($zzsql);
        if($zzcount>0){
          $zzfetch=mysqli_fetch_array($zzsql);
          $labtype=$zzfetch['labtype'];
          $station=$zzfetch['station'];

          //echo "INSERT INTO `labpending` (`refno`, `patientidno`, `caseno`, `patientname`, `itemcode`, `productdesc`, `ptype`, `trantype`, `status`, `resultstatus`, `testdonedt`, `labtype`, `testno`, `station`, `dateadded`, `timeadded`, `user`, `viewcount`, `printcount`, `verified`, `redit`) VALUES ('$refno', '$patientidno', '$caseno', '$pn', '$productcode', '$productdesc', '$productsubtype', '$trantype', '$status', '$terminalname', '', '$labtype', '', '$station', '$datearray', '$invno', '$loginuser', '0', '0', '0', '0')<br />";
          mysqli_query($conn,"INSERT INTO `labpending` (`refno`, `patientidno`, `caseno`, `patientname`, `itemcode`, `productdesc`, `ptype`, `trantype`, `status`, `resultstatus`, `testdonedt`, `labtype`, `testno`, `station`, `dateadded`, `timeadded`, `user`, `viewcount`, `printcount`, `verified`, `redit`) VALUES ('$refno', '$patientidno', '$caseno', '$pn', '$productcode', '$productdesc', '$productsubtype', '$trantype', '$status', '$terminalname', '', '$labtype', '', '$station', '$datearray', '$invno', '$loginuser', '0', '0', '0', '0')");
          //echo "DELETE FROM `labpending` WHERE `refno`='$refno'<br />";
          mysqli_query($tmpconn,"DELETE FROM `labpending` WHERE `refno`='$refno'");
        }
        //echo "<br />";

        $reclog="$pn --> $caseno --> RefNo: $refno --> Desc.: $productdesc --> Item Finalized. ($productdesc, $sellingprice, $quantity, $adjustment, $gross)";
        mysqli_query($tmpconn,"INSERT INTO `userlogs` (`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('$reclog', '".base64_decode($_SESSION['cnm'])."', '".date("Y-m-d")."', '".date("H:i:s")."')");
      }
    }
    //transfer productout end----------------------------------------------------------------------

    $rfa="&tick=$tick";
    $pstick=preg_split("/\-/",$tick);
    $newtick=$pstick[0]."-".date("YmdHis").rand(1000,9999);

echo "
    <span style='font-family: arial;font-weight: bold;font-size: 16px;color: #A50A68;'>Request Finalized!!!</span>
";

    echo "<META HTTP-EQUIV='Refresh'CONTENT='2;URL=../$aa[3]/".str_replace("$rfa","",$aa[4])."&tick=$newtick'>";
?>
