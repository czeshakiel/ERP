<?php
ini_set("display_errors","On");

$myqty=1;

$stk="CASHIER";

if($itmtran=="tpl"){
  $referenceno="TPL-".$ccname;
  $trantype="charge";
}
else{
  $referenceno="";
  $trantype=$itmtran;
}

$dispense="off";

$user=base64_decode($_SESSION['cnm']);
$dept=$stk;
$toh=$stk;
$deptrel=$dept;


//$setip=$cuz->setIP();

if($dispense=="off"){
  if($trantype=="charge"){$status="Approved";}
  else if($trantype=="cash"){$status="requested";}

  $administration="pending";
}


//Credit Limit-----------------------------------------------------------------
$ptcl=$cl;
//End Credit Limit-------------------------------------------------------------

if((stripos($caseno, "AR") !== FALSE)||(stripos($caseno, "AP") !== FALSE)){
$ptcl="200000";
}

//-----------------------------------------------------------------------------
$invno=date("H:i:s");
$date=date("M-d-Y");
$approvalno="";
$branch="KMSCI";
$pdate=date("Y-m-d");
$batchno=$tick;
//-----------------------------------------------------------------------------

//START receiving--------------------------------------------------------------
$rcvsql=mysqli_query($conn,"SELECT `description`, `itemname`, `unit`, `sellingprice`, `OPD` FROM `receiving` WHERE `code`='$kconcode'");
$rcvfetch=mysqli_fetch_array($rcvsql);
$desc=$rcvfetch['description'];
$unit=$rcvfetch['unit'];
$spr=$rcvfetch['sellingprice'];
$sopd=$rcvfetch['OPD'];
$itmn=$rcvfetch['itemname'];

$descsp=preg_split("/\-/",$desc);
//$descrel=$descsp[1];
$descrel=$itmn;
//$tagging=$descsp[2];

if($unit=="PHARMACY/MEDICINE"){
  $tagging="med";
}
else{
  $tagging="sup";
}
//END receiving----------------------------------------------------------------

//START productsmasterlist Details---------------------------------------------
$prmsql=mysqli_query($conn,"SELECT `philhealth`, `nonmed`, `opd`, `lotno` FROM `productsmasterlist` WHERE `code`='$kconcode'");
$prmfetch=mysqli_fetch_array($prmsql);
$phi=$prmfetch['philhealth'];
$non=$prmfetch['nonmed'];
$opd=$prmfetch['opd'];
//END productsmasterlist Details-----------------------------------------------

//START Know Price Scheme------------------------------------------------------
$stlotsql=mysqli_query($conn,"SELECT `lotno` FROM `receiving` WHERE `code`='$kconcode' GROUP BY `code`");
$stlotfetch=mysqli_fetch_array($stlotsql);
$lot=$stlotfetch['lotno'];

$stuc=mysqli_query($conn,"SELECT `unitcost` FROM `stocktable` WHERE `code`='$kconcode' GROUP BY `rrno` ORDER BY CAST(`unitcost` AS DECIMAL(10,2))");
while($stucfetch=mysqli_fetch_array($stuc)){
$uc=$stucfetch['unitcost'];
}

//END Know Price Scheme--------------------------------------------------------


//KNOW IF ENOUGH QTY IN STOCKS - CONDEMNED BY MARK UNTITL WHERE STOCK FOR THE CONTAINER IS FROM IS FINALIZED
//$kstsql=mysqli_query($conn,"SELECT SUM(`quantity`) AS `qty` FROM `stocktable` WHERE `code`='$kconcode' AND `dept`='$dept'");
//$kstfetch=mysqli_fetch_array($kstsql);
//$kstqty=$kstfetch['qty'];
$kstqty=100000;//Quantity bypass

//A----------------------------------------------------------------------------------------------------------------------------------------
if($kstqty>=$myqty){
$relqty=$myqty;
$stsql=mysqli_query($conn,"SELECT `code`, `rrno`, SUM(`quantity`) AS `quantity` FROM `stocktable` WHERE `code`='$kconcode' AND `dept`='$dept' GROUP BY `rrno` having SUM(`quantity`) > 0 ORDER BY `rrno` DESC");
while($stfetch=mysqli_fetch_array($stsql)){
$kconcode=$stfetch['code'];
$rrno=$stfetch['rrno'];
$qt=$stfetch['quantity'];
$qt=10000;//Quantity bypass

//GENERATE REFNO---------------------------------------------------------------
$rndsql=mysqli_query($conn,"SELECT `refnodate` FROM `myCounter`");
$rndfetch=mysqli_fetch_array($rndsql);
$rndate=$rndfetch['refnodate'];

if($rndate!=date("Ymd")){
mysqli_query($conn,"UPDATE `myCounter` SET `refnodate`='".date("Ymd")."', `refnocount`='0'");
}

$rncsql=mysqli_query($conn,"SELECT `refnocount` FROM `myCounter`");
$rncfetch=mysqli_fetch_array($rncsql);
$rncount=$rncfetch['refnocount'];

if($rncount<10){$refno="CN".date("Ymd")."00000".$rncount;}
else if($rncount<100){$refno="CN".date("Ymd")."0000".$rncount;}
else if($rncount<1000){$refno="CN".date("Ymd")."000".$rncount;}
else if($rncount<10000){$refno="CN".date("Ymd")."00".$rncount;}
else if($rncount<100000){$refno="CN".date("Ymd")."0".$rncount;}
else{$refno="CN".date("Ymd").$rncount;}
//END GENERATE REFNO-----------------------------------------------------------

if(($qt>=$relqty)&&($relqty>0)){

  //START Price & Adjustments----------------------------------------------------
  if(($hmomembership=="hmo-hmo")||($hmomembership=="hmo-company")){
    //Get HMO Total----------------------------------------------------------------
    $hmgsql=mysqli_query($conn,"SELECT SUM(`hmo`) AS `hmogross` FROM `productout` WHERE `caseno`='$caseno' AND (trantype='charge' OR trantype='extinguish') AND productsubtype NOT LIKE '%OTHERS%' AND producttype NOT LIKE '%READERS FEE%' AND producttype NOT LIKE '%CT CONTRAST%' AND approvalno NOT LIKE '%proferfee%' AND approvalno NOT LIKE '%instrument%' AND producttype NOT LIKE '%PAYMENT OF%'");
    $hmgfetch=mysqli_fetch_array($hmgsql);

    $hmgross=$hmgfetch['hmogross'];
    //End Get HMO TOtal------------------------------------------------------------
  }

  $quanti=$relqty;
  $code=$kconcode;
  include("priceschemeA.php");

  if($kconcode=="202102150002"){$trantype="charge";$status="Approved";}
  mysqli_query($tmpconn,"INSERT INTO `productout` (`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`, `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`, `cvat`, `cdisc`, `wvat`, `scpwd`, `remarks`, `addons`) VALUES ('$refno', '$invno', '$caseno', '$kconcode', '$descrel', '$price', '$relqty', '$adjustment', '$gross', '$trantype', '$phic1', '$hmo', '$excess', '$date', '$status', '$rrno', '$cnm', '$batchno', '$tagging', '$unit', 'dispenseme', '$referenceno', '$administration', 'KMSCI', '$dept', '$pdate', '$phic2', '$cvat', '$cdisc', '$wvat', '$scpwd', '$rmks', '$addons')");

  $relqty=0;

  if(($hmomembership=="hmo-hmo")||($hmomembership=="hmo-company")){$hmgross+=$hmo;}
}
else{
  if($relqty!=0){
    //START Price & Adjustments----------------------------------------------------
    if(($hmomembership=="hmo-hmo")||($hmomembership=="hmo-company")){
    //Get HMO Total----------------------------------------------------------------
      $hmgsql=mysqli_query($conn,"SELECT SUM(`hmo`) AS `hmogross` FROM `productout` WHERE `caseno`='$caseno' AND (`trantype`='charge' OR `trantype`='extinguish') AND `productsubtype` NOT LIKE '%OTHERS%' AND `producttype` NOT LIKE '%READERS FEE%' AND `producttype` NOT LIKE '%CT CONTRAST%' AND `approvalno` NOT LIKE '%proferfee%' AND `approvalno` NOT LIKE '%instrument%' AND `producttype` NOT LIKE '%PAYMENT OF%'");
      $hmgfetch=mysqli_fetch_array($hmgsql);

      $hmgross=$hmgfetch['hmogross'];
    //End Get HMO TOtal------------------------------------------------------------
    }

    $quanti=$qt;
    $code=$kconcode;
    include("priceschemeA.php");

    //END Price & Adjustments------------------------------------------------------

    if($kconcode=="202102150002"){$trantype="charge";$status="Approved";}
    mysqli_query($tmpconn,"INSERT INTO `productout` (`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`, `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`, `cvat`, `cdisc`, `wvat`, `scpwd`, `remarks`, `addons`) VALUES ('$refno', '$invno', '$caseno', '$kconcode', '$descrel', '$price', '$qt', '$adjustment', '$gross', '$trantype', '$phic1', '$hmo', '$excess', '$date', '$status', '$rrno', '$cnm', '$batchno', '$tagging', '$unit', 'dispenseme', '$referenceno', '$administration', 'KMSCI', '$deptrel', '$pdate', '$phic2', '$cvat', '$cdisc', '$wvat', '$scpwd', '$rmks', '$addons')");


    $relqty=$relqty-$qt;
  }
  else{
  }
}

$rncplus=$rncount+1;
mysqli_query($conn,"UPDATE `myCounter` SET `refnocount`='$rncplus'");
//-----------------------------------------------------------------------------

if($relqty==0){
}
//
}


}
//B----------------------------------------------------------------------------------------------------------------------------------------
else{
echo "<font color='red' size='5'>QUANTITY REQUESTED IS GREATER THAN STOCK ON HAND</font>";
}

?>
</body>
</html>
