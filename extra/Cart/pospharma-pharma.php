<!DOCTYPE html>
<html lang="en">
<head>
  <title>POS-Pharmacy</title>
  <!-- My CSS-->
  <link rel="stylesheet" type="text/css" href="rs/css/mycss.css">
  <!-- Favicon -->
  <link rel="icon" href="rs/favicon/logo.png" type="image/png" />
  <link rel="shortcut icon" href="rs/favicon/logo.png" type="image/png" />
</head>
<body class="app sidebar-mini">
<?php
ini_set("display_errors","On");
include('../Settings.php');
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$ccpass=$_COOKIE["ccpass"];
$ccname=$_COOKIE["ccname"];

setcookie("ccpass", $ccpass, time() + 300, "/");
setcookie("ccname", $ccname, time() + 300, "/");

$caseno=mysql_real_escape_string($_POST['caseno']);
$code=mysql_real_escape_string($_POST['code']);
$quantity=mysql_real_escape_string($_POST['qty']);
$trantype=mysql_real_escape_string($_POST['trantype']);
$toh=mysql_real_escape_string($_POST['toh']);
$station=mysql_real_escape_string($_POST['station']);
$stk=mysql_real_escape_string($_POST['stk']);
$user=$ccname;
$dept=$stk;
$deptrel=$station;
$tick=mysql_real_escape_string($_POST['tick']);

$setip=$cuz->setIP();

if($trantype=="charge"){$paymenttype="charge";$status="Approved";}
else if($trantype=="cash"){$paymenttype="cash";$status="requested";}

//Credit Limit-----------------------------------------------------------------
$ptcsql=mysql_query("SELECT creditlimit FROM patientscredit WHERE caseno='$caseno'");
$ptcfetch=mysql_fetch_array($ptcsql);
$ptcl=$ptcfetch['creditlimit'];
//End Credit Limit-------------------------------------------------------------

//Total Excess-----------------------------------------------------------------
$fpesql=mysql_query("SELECT SUM(excess) AS gross FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype NOT LIKE '%OTHERS%' AND producttype NOT LIKE '%READERS FEE%' AND approvalno NOT LIKE '%proferfee%' AND approvalno NOT LIKE '%instrument%' AND producttype NOT LIKE '%PAYMENT OF%'");
$fpecount=mysql_num_rows($fpesql);
if($fpecount==0){$pexcess=0;}
else{while($fpefetch=mysql_fetch_array($fpesql)){$pexcess=$fpefetch['gross'];}}
//End Total Excess-------------------------------------------------------------
echo "CREDIT LIMIT: $ptcl<br />CHARGED AMOUNT: $pexcess<br />";
//Admission Details------------------------------------------------------------
$admsql=mysql_query("SELECT patientidno, membership, hmomembership, hmo, policyno, ward FROM admission WHERE caseno='$caseno'");
$admfetch=mysql_fetch_array($admsql);

$patientidno=$admfetch['patientidno'];
$membership=$admfetch['membership'];
$hmomembership=$admfetch['hmomembership'];
$policyno=$admfetch['policyno'];
$ward=$admfetch['ward'];
$sethmo=$admfetch['hmo'];
//End Admission Details--------------------------------------------------------

//Patient Profile Details------------------------------------------------------
if(strpos($patientidno, "W") !== false){
$ppsql=mysql_query("SELECT senior FROM patientprofilecmshi WHERE patientidno='$patientidno'");
}
else{
$ppsql=mysql_query("SELECT senior FROM patientprofile WHERE patientidno='$patientidno'");
}
$ppfetch=mysql_fetch_array($ppsql);

$senior=$ppfetch['senior'];
//End Patient Profile Details--------------------------------------------------

//-----------------------------------------------------------------------------
$invno=date("H:i:s");
$date=date("M-d-Y");
$approvalno="";
$branch="MMSHI";
$pdate=date("Y-m-d");
$batchno=$tick;
//-----------------------------------------------------------------------------

//START receiving--------------------------------------------------------------
$rcvsql=mysql_query("SELECT description, itemname, unit, sellingprice, OPD FROM receiving WHERE code='$code'");
$rcvfetch=mysql_fetch_array($rcvsql);
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
$prmsql=mysql_query("SELECT philhealth, nonmed, opd, lotno FROM productsmasterlist WHERE code='$code'");
$prmfetch=mysql_fetch_array($prmsql);

$phi=$prmfetch['philhealth'];
$non=$prmfetch['nonmed'];
$opd=$prmfetch['opd'];
//END productsmasterlist Details-----------------------------------------------

//START Know Price Scheme------------------------------------------------------
$stlotsql=mysql_query("SELECT lotno FROM receiving WHERE code='$code' GROUP BY code");
$stlotfetch=mysql_fetch_array($stlotsql);
$lot=$stlotfetch['lotno'];

$stuc=mysql_query("SELECT unitcost FROM stocktable WHERE code='$code' GROUP BY rrno ORDER BY CAST(unitcost AS DECIMAL(10,2))");
while($stucfetch=mysql_fetch_array($stuc)){
$uc=$stucfetch['unitcost'];
echo $uc."<br />";
}

//END Know Price Scheme--------------------------------------------------------

$c=explode('-',$caseno);
if(($trantype=="charge")&&($pexcess>$ptcl)&&($c[0]=="I")){
echo "EXCEEDED SET CREDIT LIMIT. CANNOT ADD MORE ITEM.";
mysql_query("UPDATE admission SET status='YELLOW TAG' WHERE caseno='$caseno'");
echo "<META HTTP-EQUIV='Refresh'CONTENT='5;URL=http://$setip/2021codes/ChargeCart/ccpharmacy-pharma.php?caseno=$caseno&station=$station&toh=$toh&tick=$tick&stk=$stk'>";
}
else{
//KNOW IF ENOUGH QTY IN STOCKS
$kstsql=mysql_query("SELECT SUM(quantity) AS qty FROM stocktable WHERE code='$code' AND dept='$dept'");
$kstfetch=mysql_fetch_array($kstsql);
$kstqty=$kstfetch['qty'];
echo $lot." --> ".$uc." --> ".$trantype."<br />";
//echo "REQUESTED QUANTITY: ".$quantity."<br />SOH: $kstqty<br />PHIC: $membership<br />HMO: $hmomembership<br />LOA: $policyno<br />SENIOR: $senior<br />";
//echo "<br />PRICES:<br />P: $phi<br />N: $non<br />O: $opd<br /><br /><br />";
//A----------------------------------------------------------------------------------------------------------------------------------------
if($kstqty>=$quantity){
$relqty=$quantity;
$stsql=mysql_query("SELECT code, rrno, SUM(quantity) AS quantity FROM stocktable WHERE code='$code' AND dept='$dept' GROUP BY rrno having sum(quantity) > 0 ORDER BY rrno DESC");
while($stfetch=mysql_fetch_array($stsql)){
$code=$stfetch['code'];
$rrno=$stfetch['rrno'];
$qt=$stfetch['quantity'];

//GENERATE REFNO---------------------------------------------------------------
$rndsql=mysql_query("SELECT refnodate FROM myCounter");
$rndfetch=mysql_fetch_array($rndsql);
$rndate=$rndfetch['refnodate'];

if($rndate!=date("Ymd")){
mysql_query("UPDATE myCounter SET refnodate='".date("Ymd")."', refnocount='0'");
}

$rncsql=mysql_query("SELECT refnocount FROM myCounter");
$rncfetch=mysql_fetch_array($rncsql);
$rncount=$rncfetch['refnocount'];

if($rncount<10){$refno=date("Ymd")."00000".$rncount;}
else if($rncount<100){$refno=date("Ymd")."0000".$rncount;}
else if($rncount<1000){$refno=date("Ymd")."000".$rncount;}
else if($rncount<10000){$refno=date("Ymd")."00".$rncount;}
else if($rncount<100000){$refno=date("Ymd")."0".$rncount;}
else{$refno=date("Ymd")."0".$rncount;}
//END GENERATE REFNO-----------------------------------------------------------


echo "<font color='blue'>".$code." | ".$rrno." | --> ".$qt."</font><br />";

  if(($qt>=$relqty)&&($relqty>0)){

  //START Price & Adjustments----------------------------------------------------
    if(($hmomembership=="hmo-hmo")||($hmomembership=="hmo-company")){
    //Get HMO Total----------------------------------------------------------------
    $hmgsql=mysql_query("SELECT SUM(hmo) AS hmogross FROM productout WHERE caseno='$caseno' AND (trantype='charge' OR trantype='extinguish') AND productsubtype NOT LIKE '%OTHERS%' AND producttype NOT LIKE '%READERS FEE%' AND producttype NOT LIKE '%CT CONTRAST%' AND approvalno NOT LIKE '%proferfee%' AND approvalno NOT LIKE '%instrument%' AND producttype NOT LIKE '%PAYMENT OF%'");
    $hmgfetch=mysql_fetch_array($hmgsql);

    $hmgross=$hmgfetch['hmogross'];
    //End Get HMO TOtal------------------------------------------------------------
    }

    $quanti=$relqty;

    include("priceschemeA.php");

  //END Price & Adjustments------------------------------------------------------

//    echo "INSERT INTO `productout` (`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`, `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`) VALUES ('$refno', '$invno', '$caseno', '$code', '$descrel', '$price', '$relqty', '$adjustment', '$gross', '$trantype', '$phic1', '$hmo', '$excess', '$date', '$status', '$rrno', '$user', '$batchno', '$tagging', '$unit', '', '', 'pending', 'MMSHI', '', '$pdate', '$phic2')<br />";
    mysql_query("INSERT INTO `productout` (`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`, `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`) VALUES ('$refno', '$invno', '$caseno', '$code', '$descrel', '$price', '$relqty', '$adjustment', '$gross', '$trantype', '$phic1', '$hmo', '$excess', '$date', '$status', '$rrno', '$user', '$batchno', '$tagging', '$unit', '', '', 'pending', 'MMSHI', '$dept', '$pdate', '$phic2')");

    $relqty=0;
    echo "<font color='red'>NEW QTY: ".$relqty."</font><br /><br />";

    if(($hmomembership=="hmo-hmo")||($hmomembership=="hmo-company")){$hmgross+=$hmo;}
  }
  else{
    if($relqty!=0){

    //START Price & Adjustments----------------------------------------------------
    if(($hmomembership=="hmo-hmo")||($hmomembership=="hmo-company")){
    //Get HMO Total----------------------------------------------------------------
    $hmgsql=mysql_query("SELECT SUM(hmo) AS hmogross FROM productout WHERE caseno='$caseno' AND (trantype='charge' OR trantype='extinguish') AND productsubtype NOT LIKE '%OTHERS%' AND producttype NOT LIKE '%READERS FEE%' AND producttype NOT LIKE '%CT CONTRAST%' AND approvalno NOT LIKE '%proferfee%' AND approvalno NOT LIKE '%instrument%' AND producttype NOT LIKE '%PAYMENT OF%'");
    $hmgfetch=mysql_fetch_array($hmgsql);

    $hmgross=$hmgfetch['hmogross'];
    //End Get HMO TOtal------------------------------------------------------------
    }

    $quanti=$qt;

    include("priceschemeA.php");

    //END Price & Adjustments------------------------------------------------------

//    echo "INSERT INTO `productout` (`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`, `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`) VALUES ('$refno', '$invno', '$caseno', '$code', '$descrel', '$price', '$qt', '$adjustment', '$gross', '$trantype', '$phic1', '$hmo', '$excess', '$date', '$status', '$rrno', '$user', '$batchno', '$tagging', '$unit', '', '', 'pending', 'MMSHI', '', '$pdate', '$phic2')<br />";
    mysql_query("INSERT INTO `productout` (`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`, `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`) VALUES ('$refno', '$invno', '$caseno', '$code', '$descrel', '$price', '$qt', '$adjustment', '$gross', '$trantype', '$phic1', '$hmo', '$excess', '$date', '$status', '$rrno', '$user', '$batchno', '$tagging', '$unit', '', '', 'pending', 'MMSHI', '$deptrel', '$pdate', '$phic2')");

      $relqty=$relqty-$qt;
      echo "<font color='red'>NEW QTY: ".$relqty."</font><br /><br />";

    }
    else{
      
      echo "NOT INCLUDED!!!<br /><br />";
    }
  }

//-----------------------------------------------------------------------------
$rncplus=$rncount+1;
mysql_query("UPDATE myCounter SET refnocount='$rncplus'");
//-----------------------------------------------------------------------------

if($relqty==0){
echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=http://$setip/2021codes/ChargeCart/ccpharmacy-pharma.php?caseno=$caseno&station=$station&toh=$toh&tick=$tick&stk=$stk'>";break;
}
//
}


}
//B----------------------------------------------------------------------------------------------------------------------------------------
else{
echo "<font color='red' size='7'>QUANTITY REQUESTED IS GREATER THAN STOCK ON HAND</font>";
echo "<META HTTP-EQUIV='Refresh'CONTENT='5;URL=http://$setip/2021codes/ChargeCart/ccpharmacy-pharma.php?caseno=$caseno&station=$station&toh=$toh&tick=$tick&stk=$stk'>";
}
}

?>
</body>
</html>
