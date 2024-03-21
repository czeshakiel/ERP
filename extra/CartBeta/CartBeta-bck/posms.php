<?php
ini_set("dispaly_errors","On");
$ccpass=base64_decode($_SESSION['cpw']);
$ccname=base64_decode($_SESSION['cnm']);

$adderr=0;

$code=mysqli_real_escape_string($conn,$_POST['itmcode']);
$quantity=mysqli_real_escape_string($conn,$_POST['qty']);
$settrantype=mysqli_real_escape_string($conn,$_POST['trantype']);
$toh=mysqli_real_escape_string($conn,$_POST['stk']);
$station=$dept;
$stk=mysqli_real_escape_string($conn,$_POST['stk']);

if($settrantype=="tpl"){
  $referenceno="TPL-".$ccname;
  $trantype="charge";
}
else{
  $referenceno="";

  if(($settrantype=="cash")||($settrantype=="charge")){
    $trantype=$settrantype;
  }
  else{
    $trantype="cash";
  }
}


if($stk=="PHARMACY" or $stk=="pharmacy"){
  $toaddress="ccpharmacy.php";
  $dispense="off";
}
else if($stk=="CSR2" or $stk=="csr2"){
  $toaddress="cccsr2.php";
  $dispense="off";
}
else if($stk=="pharmacy_opd" or $stk=="PHARMACY_OPD"){
  $toaddress="ccphopcart.php";
  $dispense="off";
}
else{
  $toaddress="ccecart_manual_all.php";
  $dispense="on";
}

if($toh=="PHARMACY_MANUAL"){
  $toaddress="ccpharmacy_manual.php";
}

if($toh=="RDU_MANUAL"){
  $toaddress="ccecart_manual.php";
}

if($toh=="CSR2_MANUAL"){
  $toaddress="cccsr2_manual.php";
}

if($toh=="PACKAGE"){
  $toaddress="packageadded.php";
  $referenceno=mysqli_real_escape_string($conn,$_POST['referenceno']);
}

$user=$ccname;
$dept=$stk;
$deptrel=$station;

if($dispense=="off"){
  if($trantype=="charge"){$status="Approved";}
  else if($trantype=="cash"){$status="requested";}

  $administration="pending";
}
else if($dispense=="on" and $trantype=="charge"){
  $status="Approved";
  $administration="dispensed";
}
else if($dispense=="on" and $trantype=="cash"){
  $status="requested";
  $administration="dispensed";
}
// ------------------------------------------------------------

//Credit Limit-----------------------------------------------------------------
$ptcsql=mysqli_query($conn,"SELECT creditlimit FROM patientscredit WHERE caseno='$caseno'");
$ptcfetch=mysqli_fetch_array($ptcsql);
$ptcl=$ptcfetch['creditlimit'];
//End Credit Limit-------------------------------------------------------------

//Added by Eczekiel 2021-04-24
$ptcsql=mysqli_query($conn,"SELECT policyno, addemployer FROM admission WHERE caseno='$caseno'");
$ptcfetch=mysqli_fetch_array($ptcsql);
$ptcl1=$ptcfetch['policyno'];
$aem=$ptcfetch['addemployer'];

$ptcl=$ptcl+$ptcl1;
//
if((stripos($caseno, "AR") !== FALSE)||(stripos($caseno, "AP") !== FALSE)){
$ptcl="200000";
}

if($toh=="PACKAGE"){
$ptcl="200000";
}

//Total Excess-----------------------------------------------------------------
$fpesql=mysqli_query($conn,"SELECT SUM(excess) AS gross FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype NOT LIKE '%OTHERS%' AND producttype NOT LIKE '%READERS FEE%' AND approvalno NOT LIKE '%proferfee%' AND approvalno NOT LIKE '%instrument%' AND producttype NOT LIKE '%PAYMENT OF%'");
$fpecount=mysqli_num_rows($fpesql);
if($fpecount==0){$pexcess=0;}
else{while($fpefetch=mysqli_fetch_array($fpesql)){$pexcess=$fpefetch['gross'];}}
//End Total Excess-------------------------------------------------------------

//Patient Profile Details------------------------------------------------------
$senior=$sn;
$patientname=$pn;
//End Patient Profile Details--------------------------------------------------

//-----------------------------------------------------------------------------
$invno=date("H:i:s");
$date=date("M-d-Y");
$approvalno="";
$branch="MMSHI";
$pdate=date("Y-m-d");
$batchno=$tick;
//-----------------------------------------------------------------------------

$hmtickspl=preg_split("/\-/",$tick);
$hmbatch="HM-".$hmtickspl[1];
if(isset($_SESSION['homemeds'])){
if($_SESSION['homemeds'] == "yes"){$batchno=$hmbatch;}
else{$batchno=$batchno;}
}

//START receiving--------------------------------------------------------------
$rcvsql=mysqli_query($conn,"SELECT `description`, `itemname`, `unit`, `sellingprice`, `generic`, `OPD`, `lotno` FROM `receiving` WHERE `code`='$code'");
$rcvfetch=mysqli_fetch_array($rcvsql);
$desc=$rcvfetch['description'];
$genc=$rcvfetch['generic'];
$unit=$rcvfetch['unit'];
$spr=$rcvfetch['sellingprice'];
$sopd=$rcvfetch['OPD'];
$itmn=$rcvfetch['itemname'];
$lot=$rcvfetch['lotno'];

//$descsp=preg_split("/\-/",$desc);
$ds=str_replace("cmshi-","",$desc);
$ds=str_replace("-sup","",$ds);
$ds=str_replace("-med","",$ds);
$ds=str_replace("ams-","",$ds);

if($genc==""){$gn="";}
else{$gn="($genc) ";}

$descrel=$gn.$ds;

if($unit=="PHARMACY/MEDICINE"){
  $tagging="med";
}
else{
  $tagging="sup";
}
//END receiving----------------------------------------------------------------

//START productsmasterlist Details---------------------------------------------
$prmsql=mysqli_query($conn,"SELECT philhealth, nonmed, opd, lotno FROM productsmasterlist WHERE code='$code'");
$prmfetch=mysqli_fetch_array($prmsql);

$phi=$prmfetch['philhealth'];
$non=$prmfetch['nonmed'];
$opd=$prmfetch['opd'];
//END productsmasterlist Details-----------------------------------------------

$stuc=mysqli_query($conn,"SELECT unitcost FROM stocktable WHERE code='$code' AND (trantype LIKE 'charge' OR trantype LIKE 'cash') AND unitcost > 0 ORDER BY datearray");
while($stucfetch=mysqli_fetch_array($stuc)){
$uc=round($stucfetch['unitcost'],2);
}

//END Know Price Scheme--------------------------------------------------------

$c=explode('-',$caseno);
if(($trantype=="charge")&&($pexcess>$ptcl)&&($c[0]=="I")&&($dispense!="on")&&($settrantype!="tpl")){
echo "<font color='red' size='5'><b>EXCEEDED SET CREDIT LIMIT. CANNOT ADD MORE ITEM.</b></font>";
mysqli_query($conn,"UPDATE admission SET status='YELLOW TAG' WHERE caseno='$caseno'");
}
else{
//KNOW IF ENOUGH QTY IN STOCKS
$kstsql=mysqli_query($conn,"SELECT SUM(quantity) AS qty FROM stocktable WHERE code='$code' AND dept='$dept'");
$kstfetch=mysqli_fetch_array($kstsql);
$kstqty=$kstfetch['qty'];

if($toh=="PACKAGE"){$kstqty="100";}

//A----------------------------------------------------------------------------------------------------------------------------------------
if($kstqty>=$quantity){
$relqty=$quantity;
$stsql=mysqli_query($conn,"SELECT code, rrno, SUM(quantity) AS quantity FROM stocktable WHERE code='$code' AND dept='$dept' GROUP BY rrno having sum(quantity) > 0 ORDER BY rrno DESC");
while($stfetch=mysqli_fetch_array($stsql)){
$code=$stfetch['code'];
$rrno=$stfetch['rrno'];
$qt=$stfetch['quantity'];

//GENERATE REFNO---------------------------------------------------------------
$rndsql=mysqli_query($conn,"SELECT refnodate FROM myCounter");
$rndfetch=mysqli_fetch_array($rndsql);
$rndate=$rndfetch['refnodate'];

if($rndate!=date("Ymd")){
mysqli_query($conn,"UPDATE myCounter SET refnodate='".date("Ymd")."', refnocount='0'");
}

$rncsql=mysqli_query($conn,"SELECT refnocount FROM myCounter");
$rncfetch=mysqli_fetch_array($rncsql);
$rncount=$rncfetch['refnocount'];

if($rncount<10){$refno=date("Ymd")."00000".$rncount;}
else if($rncount<100){$refno=date("Ymd")."0000".$rncount;}
else if($rncount<1000){$refno=date("Ymd")."000".$rncount;}
else if($rncount<10000){$refno=date("Ymd")."00".$rncount;}
else if($rncount<100000){$refno=date("Ymd")."0".$rncount;}
else{$refno=date("Ymd")."0".$rncount;}
//END GENERATE REFNO-----------------------------------------------------------

if($toh=="PACKAGE"){
  $refno=mysqli_real_escape_string($conn,$_POST['srno']);
}

  if(($qt>=$relqty)&&($relqty>0)){

  //START Price & Adjustments----------------------------------------------------
    if(($hmomembership=="hmo-hmo")||($hmomembership=="hmo-company")){
    //Get HMO Total----------------------------------------------------------------
    $hmgsql=mysqli_query($conn,"SELECT SUM(hmo) AS hmogross FROM productout WHERE caseno='$caseno' AND (trantype='charge' OR trantype='extinguish') AND productsubtype NOT LIKE '%OTHERS%' AND producttype NOT LIKE '%READERS FEE%' AND producttype NOT LIKE '%CT CONTRAST%' AND approvalno NOT LIKE '%proferfee%' AND approvalno NOT LIKE '%instrument%' AND producttype NOT LIKE '%PAYMENT OF%'");
    $hmgfetch=mysqli_fetch_array($hmgsql);

    $hmgross=$hmgfetch['hmogross'];
    //End Get HMO TOtal------------------------------------------------------------
    }

    $quanti=$relqty;
    $hmo=0;

    include("priceschemeA.php");

  //END Price & Adjustments------------------------------------------------------
    if($code=="202102150002"){$trantype="charge";$status="Approved";}

    mysqli_query($tmpconn,"INSERT INTO `productout` (`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`, `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`) VALUES ('$refno', '$invno', '$caseno', '$code', '$descrel', '$price', '$relqty', '$adjustment', '$gross', '$trantype', '$phic1', '$hmo', '$excess', '$date', '$status', '$rrno', '$user', '$batchno', '$tagging', '$unit', '', 'QR-$relqty', '$administration', 'MMSHI', '$dept', '$pdate', '$phic2')");
	if($_SESSION['homemeds'] == "yes") {
	mysqli_query($conn,"INSERT INTO `productouthm` (`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`, `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`) VALUES ('$refno', '$invno', '$caseno', '$code', '$descrel', '$price', '$relqty', '$adjustment', '$gross', '$trantype', '$phic1', '$hmo', '$excess', '$date', '$status', '$rrno', '$user', '$batchno', '$tagging', '$unit', '', 'QR-$relqty', '$administration', 'MMSHI', '$dept', '$pdate', '$phic2')");
	}
    if($dispense=="on"){
      include("dispensed.php");
    }

    $relqty=0;

    if(($hmomembership=="hmo-hmo")||($hmomembership=="hmo-company")){$hmgross+=$hmo;}
  }
  else{
    if($relqty!=0){

    //START Price & Adjustments----------------------------------------------------
    if(($hmomembership=="hmo-hmo")||($hmomembership=="hmo-company")){
    //Get HMO Total----------------------------------------------------------------
    $hmgsql=mysqli_query($conn,"SELECT SUM(hmo) AS hmogross FROM productout WHERE caseno='$caseno' AND (trantype='charge' OR trantype='extinguish') AND productsubtype NOT LIKE '%OTHERS%' AND producttype NOT LIKE '%READERS FEE%' AND producttype NOT LIKE '%CT CONTRAST%' AND approvalno NOT LIKE '%proferfee%' AND approvalno NOT LIKE '%instrument%' AND producttype NOT LIKE '%PAYMENT OF%'");
    $hmgfetch=mysqli_fetch_array($hmgsql);

    $hmgross=$hmgfetch['hmogross'];
    //End Get HMO TOtal------------------------------------------------------------
    }

    $quanti=$qt;

    include("priceschemeA.php");
    $hmo=0;

    //END Price & Adjustments------------------------------------------------------
     if($code=="202102150002"){$trantype="charge";$status="Approved";}

     mysqli_query($tmpconn,"INSERT INTO `productout` (`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`, `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`) VALUES ('$refno', '$invno', '$caseno', '$code', '$descrel', '$price', '$qt', '$adjustment', '$gross', '$trantype', '$phic1', '$hmo', '$excess', '$date', '$status', '$rrno', '$user', '$batchno', '$tagging', '$unit', '', '$referenceno', '$administration', 'MMSHI', '$dept', '$pdate', '$phic2')");
	if($_SESSION['homemeds'] == "yes") {
	mysqli_query($conn,"INSERT INTO `productouthm` (`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`, `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`) VALUES ('$refno', '$invno', '$caseno', '$code', '$descrel', '$price', '$qt', '$adjustment', '$gross', '$trantype', '$phic1', '$hmo', '$excess', '$date', '$status', '$rrno', '$user', '$batchno', '$tagging', '$unit', '', '$referenceno', '$administration', 'MMSHI', '$dept', '$pdate', '$phic2')");
	}
    if($dispense=="on"){
      include("dispensed.php");
    }

      $relqty=$relqty-$qt;

    }
    else{
    }
  }

//-----------------------------------------------------------------------------
$rncplus=$rncount+1;
mysqli_query($conn,"UPDATE myCounter SET refnocount='$rncplus'");
//-----------------------------------------------------------------------------

if($relqty==0){
}
//
}


}
//B----------------------------------------------------------------------------------------------------------------------------------------
else{
  $adderr=1;
}
}

?>
