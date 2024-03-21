<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="Resources/Favicon/favicon.png" type="image/png" />
<link rel="shortcut icon" href="Resources/Favicon/favicon.png" type="image/png" />
<title>SEARCH CHARGES</title>
<link href="../Resources/CSS/mystyle.css" rel="stylesheet" type="text/css" />
<style style="text/css">
.hoverTable{width:100%; border-collapse:collapse;}
.hoverTable td{padding:7px; border:#4e95f4 1px solid;}

.div-container input[type=text], .div-container input[type=password] {width: 450px;height: 30px;padding: 7px;margin: 5px 0 5px 0;border: none;background: #eee;border-radius: 10px;font-size: 18px;font-weight: bold;border: 2px solid #000000;}
.div-container select {height: 40px;padding: 7px;margin: 5px 0 5px 0;border: none;background: #eee;}
.div-container input[type=text]:focus, .div-container input[type=password]:focus, .div-container select:focus {background-color: #ddd;outline: none;}
.div-container .btn {background-color: #8ebf42;color: #fff;padding: 5px 10px;border: none;cursor: pointer;opacity: 0.8;border-radius: 5px;}
.div-container .cancel {background-color: #cc0000;}
.div-container .btn:hover, .open-button:hover {opacity: 1;}

/* Define the hover highlight color for the table row */
.hoverTable tr:hover {background-color: #ffff99;}
</style>
</head>

<body onload="placeFocus()">
<?php
ini_set("display_errors","On");

$setip=$_SERVER['HTTP_HOST'];

if($settrantype=="tpl"){
  $referenceno="TPL-".$ccname;
  $trantype="charge";
}
else{
  $referenceno="";
  $trantype=$settrantype;
}


  $asql=mysqli_query($conn,"SELECT `opd`, `philhealth` FROM `productsmasterlist` WHERE `code`='$kconcode'");
  $afetch=mysqli_fetch_array($asql);
  $opd=$afetch['opd'];
  $phi=$afetch['philhealth'];

  $csql=mysqli_query($conn,"SELECT `patientidno`, `membership`, `hmomembership`, `policyno`, `status`, `addemployer` FROM `admission` WHERE `caseno`='$caseno'");
  $cfetch=mysqli_fetch_array($csql);
  $patientidno=$cfetch['patientidno'];
  $membership=$cfetch['membership'];
  $hmomembership=$cfetch['hmomembership'];
  $policyno=$cfetch['policyno'];
  $status=$cfetch['status'];
  $addemployer=$cfetch['addemployer'];

  if($trantype=="cash"){
    $sp=$opd;
  }
  else if($trantype=="charge"){
    if($addemployer!=''){
      //COMPANY SPECIAL PRICE----------------------------------------
      $cslsql=mysqli_query($conn,"SELECT `price` FROM `comsplist` WHERE `code`='$kconcode' AND `company`='$addemployer'");
      $cslcount=mysqli_num_rows($cslsql);
      if($cslcount!=0){
        $cslfetch=mysqli_fetch_array($cslsql);
        if($cslfetch['price']>0){
          $sp=$cslfetch['price'];
        }
        else{
          $sp=$phi;
        }
      }
      else{
        //CASH PRICE FOR CHARGE ITEMS------------------------------------------------------------------------
        if(($addemployer=="DSWD")||($addemployer=="DOH")||($addemployer=="PCSO")||($addemployer=="PROVINCE")){
          $sp=$opd;
        }
        //---------------------------------------------------------------------------------------------------
        else{
          $sp=$phi;
        }
      }
      //-------------------------------------------------------------
    }
    else{
      $sp=$phi;
    }
  }

//SUNDAY PRICE INCREASE 2021-08-21 MARK----------------------------------------
  $ifsun=date("D");
  if($ifsun=="Sun"){
    if(($kconcode=="210519084140p-3")||($kconcode=="210330142232p-3")){
      if((stripos($caseno, "R-") !== FALSE)||(stripos($caseno, "WD-") !== FALSE)){
        $sp=$sp;
      }
      else{
        $sp=$sp+($sp*0.30);
      }
    }
    else if(($kconcode=="210407140138p-3")||($kconcode=="210330142303p-3")||($kconcode=="210407140432p-3")){
      if((stripos($caseno, "R-") !== FALSE)||(stripos($caseno, "WD-") !== FALSE)){
        $sp=5000;
      }
      else{
        $sp=7000;
      }
    }
  }
//---------------------------------------------------------------------------

//container----------------------------------------------------------------------------------------
$kconsql=mysqli_query($conn,"SELECT `PRIVATE`, `SEMIPRIVATE`, `testcode`, `unit` FROM `receiving` WHERE `code`='$kconcode'");
$kconfetch=mysqli_fetch_array($kconsql);
$testcode=$kconfetch['testcode'];
$kconunit=$kconfetch['unit'];
//end container------------------------------------------------------------------------------------


//refno generator----------------------------------------------------------------------------------
  $prdsql=mysqli_query($conn,"SELECT `prefnodate` FROM `myCounter`");
  $prdfetch=mysqli_fetch_array($prdsql);
  $prd=$prdfetch['prefnodate'];

  $pdate=date("Ymd");
  if($prd!=$pdate){
    mysqli_query($conn,"UPDATE `myCounter` SET `prefnodate`='$pdate', `prefnocount`='0' WHERE `counterno`='1'");
  }

  $prcsql=mysqli_query($conn,"SELECT `prefnocount` FROM `myCounter`");
  $prcfetch=mysqli_fetch_array($prcsql);
  $rno=$prcfetch['prefnocount'];

  $sequ=date("YmdHis");

  if($rno<10){$refno=$sequ."000".$rno;}
  else if(($rno<100)&&($rno>9)){$refno=$sequ."00".$rno;}
  else if(($rno<1000)&&($rno>99)){$refno=$sequ."0".$rno;}
  else if($rno>999){$refno=$sequ.$rno;}
//-------------------------------------------------------------------------------------------------

  $invno=date("H:i:s");

  $bsql=mysqli_query($conn,"SELECT `description`, `lotno`, `unit`, `itemname` FROM `receiving` WHERE `code`='$kconcode'");
  $bfetch=mysqli_fetch_array($bsql);
  $description=$bfetch['description'];
  $lotno=$bfetch['lotno'];
  $itemname=$bfetch['itemname'];

  $dsql=mysqli_query($conn,"SELECT `senior`, `patientname` FROM `patientprofile` WHERE `patientidno`='$patientidno'");
  $dcount=mysqli_num_rows($dsql);
  if($dcount>0){
    $dfetch=mysqli_fetch_array($dsql);
    $sn=$dfetch['senior'];
    $patname=$dfetch['patientname'];
  }
  else{
    $d2sql=mysqli_query($conn,"SELECT CONCAT(`lastname`, ' ', `middlename`, ' ', `firstname`) AS `name` FROM `nsauthemployees` WHERE `empid`='$patientidno'");
    $d2fetch=mysqli_fetch_array($d2sql);
    $patname=$d2fetch['name'];
    $sn="N";
  }

  $esql=mysqli_query($conn,"SELECT `creditlimit` FROM `patientscredit` WHERE `caseno`='$caseno'");
  $efetch=mysqli_fetch_array($esql);
  $crl=$efetch['creditlimit'];

  if($hmomembership!="none"){
    $totallimit=$crl+$policyno;
  }
  else{
    $totallimit=$crl;
  }

  if($sn=="Y"){
    $adjustment=round((($sp*$qty)*0.20),2);
  }
  else if($sn=="N"){
    $adjustment=0;
  }
  else{
    $adjustment=0;
  }

  if($testcode=="1"){
    $adjustment=0;
  }

  $gross=round((($sp*$qty)-$adjustment),2);

  $pdate=date("M-d-Y");

  if($trantype=="cash"){
    $status="requested";
    include("insertitem_misc.php");
  }
  else if($trantype=="charge"){
  //KNOW CREDIT LEFT-----------------------------
  $fsql=mysqli_query($conn,"SELECT SUM((`sellingprice` * `quantity`)-`adjustment`) AS `totgross` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge'");
  $ffetch=mysqli_fetch_array($fsql);
  $totgross=$ffetch['totgross'];
  $sqlStat=mysqli_query($conn,"SELECT `status` FROM `admission` WHERE `caseno`='$caseno'");
  $stt=mysqli_fetch_array($sqlStat);
  $stat=$stt['status'];
  //---------------------------------------------
    $status="Approved";

    if(($totgross+$gross)<$totallimit AND $stat != "YELLOW TAG"){
      include("insertitem_misc.php");
    }
    else{
      if((stripos($caseno, "AR") !== FALSE)||(stripos($caseno, "AP") !== FALSE)){
        include("insertitem_misc.php");
      }
      else{
        if($settrantype=="tpl" || $stat=="MGH"){
          include("insertitem_misc.php");
        }
        else{
        }
      }
    }
  }

?>
</body>
</html>
