<?php
ini_set("display_errors","ON");
$itmqty=mysqli_real_escape_string($conn,$_POST['qty']);
$itmcode=mysqli_real_escape_string($conn,$_POST['itmcode']);
$itmtran=mysqli_real_escape_string($conn,$_POST['trantype']);
$itmtype=mysqli_real_escape_string($conn,$_POST['itmtype']);
$itmname=mysqli_real_escape_string($conn,$_POST['itmname']);

$itmrema="";
if(isset($_POST['remarks'])){
  $itmrema=mb_strtoupper(trim(mysqli_real_escape_string($conn,$_POST['remarks'])));
}

if($itmtran=="tpl"){
  $referenceno="TPL-".$cnm;
  $trantype="charge";
}
else{
  $referenceno="";

  if(($itmtran=="cash")||($itmtran=="charge")){
    $trantype=$itmtran;
  }
  else{
    $trantype="cash";
  }
}

$zasql=mysqli_query($conn,"SELECT `opd`, `philhealth` FROM `productsmasterlist` WHERE `code`='$itmcode'");
$zafetch=mysqli_fetch_array($zasql);
$opd=$zafetch['opd'];
$phi=$zafetch['philhealth'];

//container----------------------------------------------------------------------------------------
$kconsql=mysqli_query($conn,"SELECT `description`, `optset3`, `PRIVATE`, `SEMIPRIVATE`, `testcode` FROM `receiving` WHERE `code`='$itmcode'");
$kconfetch=mysqli_fetch_array($kconsql);
$kconw=$kconfetch['PRIVATE'];
$kconcode=$kconfetch['SEMIPRIVATE'];
$testcode=$kconfetch['testcode'];
$itmdsc=$kconfetch['description'];
$optset3=$kconfetch['optset3'];
//end container------------------------------------------------------------------------------------


//REGULAR PRICE--------------------------------------------------------------------------------------
if($trantype=="cash"){
  $sp=$opd;

  if($optset3=="99"){
    $ksosql=mysqli_query($conn,"SELECT * FROM `productout` WHERE `caseno`='$caseno' AND `productsubtype`='LABORATORY' AND `productdesc` LIKE '%%-%SENDOUT%'");
    $ksocount=mysqli_num_rows($ksosql);

    if($ksocount==0){$sp=$sp+1000;}
    else{$sp=$sp+500;}
  }
}
else if($trantype=="charge"){
  if($addemployer!=''){
    //COMPANY SPECIAL PRICE----------------------------------------
    $cslsql=mysqli_query($conn,"SELECT `price` FROM `comsplist` WHERE `code`='$itmcode' AND `company`='$addemployer'");
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
      if(($addemployer=="DSWD")||($addemployer=="DOH")||($addemployer=="PCSO")||($addemployer=="PROVINCE")||($addemployer=="EDC")||($addemployer=="EMCOR")||($addemployer=="COSUCECO")){
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
//END REGULAR PRICE--------------------------------------------------------------------------------

include("posc-spoverride.php");
include("rfngen.php");

//-------------------------------------------------------------------------------------------------
$invno=date("H:i:s");

$bsql=mysqli_query($conn,"SELECT `description`, `lotno`, `unit`, `itemname`, `testcode` FROM `receiving` WHERE `code`='$itmcode'");
$bfetch=mysqli_fetch_array($bsql);
$description=$bfetch['description'];
$lotno=$bfetch['lotno'];
$itemname=$bfetch['itemname'];
$testcode=$bfetch['testcode'];

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

if($hmomembership!="none"){$totallimit=$cl;}
else{$totallimit=$setcl;}

if($ct=="pck"){$totallimit=300000;}

if($sn=="Y"){$adjustment=round((($sp*$itmqty)*0.20),2);}
else if($sn=="N"){$adjustment=0;}
else{$adjustment=0;}

if($testcode=="1"){$adjustment=0;}

//-------------------------------------------------------------------------------------------------
include("posc-adjoverride.php");
//-------------------------------------------------------------------------------------------------

$gross=round((($sp*$itmqty)-$adjustment),2);

$pdate=date("M-d-Y");

$apprno="";
if(($kconw=="misc")&&($kconcode!="")){$apprno="PA-".$refno;}

if(($ct=="pck")&&($itmtype=="PROFESSIONAL FEE")&&(($itmname=="SURGEON")||($itmname=="ANESTHESIOLOGIST"))){
  $zusql=mysqli_query($conn,"SELECT `packagename` FROM `packagelist` WHERE `pckgno`='$referenceno'");
  $zufetch=mysqli_fetch_array($zusql);
  $zupckgnm=$zufetch['packagename'];
  $zupckgnm=str_replace("(NON-MED)","",$zupckgnm);
  $zupckgnm=str_replace("(PHIC)","",$zupckgnm);

  $apprno=$zapckgnm;
}


//PRODOUT INSERT START-----------------------------------------------------------------------------
if($trantype=="cash"){
  $status="requested";
  include("posc-insitm.php");


  if(($kconw=="container")&&($kconcode!="")){
    if(stripos($caseno, "I-") === FALSE){
      include("posms-cont.php");
    }
  }
  else if(($kconw=="misc")&&($kconcode!="")){
    include("posc-misc.php");
  }

}
else if($trantype=="charge"){
  $status="Approved";

  if((($totgross+$gross)<$totallimit)&&($admstatus!="YELLOW TAG")){
    include("posc-insitm.php");

    if(($kconw=="misc")&&($kconcode!="")){
      include("posc-misc.php");
    }
  }
  else{
    if((stripos($caseno, "AR") !== FALSE)||(stripos($caseno, "AP") !== FALSE)){
      include("posc-insitm.php");

      if(($kconw=="misc")&&($kconcode!="")){
        include("posc-misc.php");
      }
    }
    else{
      if(($itmtran=="tpl")||($admstatus=="MGH")){
        include("posc-insitm.php");

        if(($kconw=="misc")&&($kconcode!="")){
          include("posc-misc.php");
        }
      }
      else{
        echo "<span class='arial s18 red bold'>EXCEEDED CREDIT LIMIT!!! CANNOT CHARGE MORE ITEM!</span>";
        if($status!="YELLOW TAG"){
          mysqli_query($conn,"UPDATE `admission` SET `status`='YELLOW TAG' WHERE `caseno`='$caseno'");
        }
      }
    }
  }
}
//PRODOUT INSERT END-------------------------------------------------------------------------------
?>
