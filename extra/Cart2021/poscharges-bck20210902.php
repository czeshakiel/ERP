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
header("Refresh:300");
ini_set("display_errors","On");
include("../Settings.php");
$cuz = new database();
$setip=$cuz->setIP();

$caseno=mysqli_real_escape_string($mycon1,$_GET['caseno']);
$station=mysqli_real_escape_string($mycon1,$_GET['station']);
$toh=mysqli_real_escape_string($mycon1,$_GET['toh']);
$tick=mysqli_real_escape_string($mycon1,$_GET['tick']);
$remarks=mysqli_real_escape_string($mycon1,$_GET['remarks']);
$code=mysqli_real_escape_string($mycon1,$_GET['code']);
$unit=mysqli_real_escape_string($mycon1,$_GET['unit']);
$settrantype=mysqli_real_escape_string($mycon1,$_GET['trantype']);
$qty=mysqli_real_escape_string($mycon1,$_GET['qty']);

if(isset($_GET['labreq'])){
  $retadd="cccharges-lab.php";
}
else{
  $retadd="cccharges.php";
}

if($settrantype=="tpl"){
  $referenceno="TPL-".$ccname;
  $trantype="charge";
}
else{
  $referenceno="";
  $trantype=$settrantype;
}


if (!isset($_COOKIE["ccpass"])){
  header("location: ../ChargeCart/?caseno=$caseno&station=$station&toh=$toh");
}
else{
$ccpass=$_COOKIE["ccpass"];
$ccname=$_COOKIE["ccname"];

setcookie("ccpass", $ccpass, time() + 300, "/");
setcookie("ccname", $ccname, time() + 300, "/");

  $asql=mysqli_query($mycon1,"SELECT `opd`, `philhealth` FROM `productsmasterlist` WHERE `code`='$code'");
  $afetch=mysqli_fetch_array($asql);
  $opd=$afetch['opd'];
  $phi=$afetch['philhealth'];

  if($trantype=="cash"){
    $sp=$opd;
  }
  else if($trantype=="charge"){
    $sp=$phi;
  }

//SUNDAY PRICE INCREASE 2021-08-21 MARK----------------------------------------
  $ifsun=date("D");
  if($ifsun=="Sun"){
    if(($code=="210519084140p-3")||($code=="210330142232p-3")){
      if((stripos($caseno, "R-") !== FALSE)||(stripos($caseno, "WD-") !== FALSE)){
        $sp=$sp;
      }
      else{
        $sp=$sp+($sp*0.30);
      }
    }
    else if(($code=="210407140138p-3")||($code=="210330142303p-3")||($code=="210407140432p-3")){
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
$kconsql=mysqli_query($mycon1,"SELECT `PRIVATE`, `SEMIPRIVATE` FROM `receiving` WHERE `code`='$code'");
$kconfetch=mysqli_fetch_array($kconsql);
$kconw=$kconfetch['PRIVATE'];
$kconcode=$kconfetch['SEMIPRIVATE'];
//end container------------------------------------------------------------------------------------


//refno generator----------------------------------------------------------------------------------
  $prdsql=mysqli_query($mycon1,"SELECT prefnodate FROM myCounter");
  $prdfetch=mysqli_fetch_array($prdsql);
  $prd=$prdfetch['prefnodate'];

  $pdate=date("Ymd");
  if($prd!=$pdate){
    mysqli_query($mycon1,"UPDATE myCounter SET prefnodate='$pdate', prefnocount='0' WHERE counterno='1'");
  }

  $prcsql=mysqli_query($mycon1,"SELECT prefnocount FROM myCounter");
  $prcfetch=mysqli_fetch_array($prcsql);
  $rno=$prcfetch['prefnocount'];

  $sequ=date("YmdHi");

  if($rno<10){$refno=$sequ."000".$rno;}
  else if(($rno<100)&&($rno>9)){$refno=$sequ."00".$rno;}
  else if(($rno<1000)&&($rno>99)){$refno=$sequ."0".$rno;}
  else if($rno>999){$refno=$sequ.$rno;}
//-------------------------------------------------------------------------------------------------

  $invno=date("H:i:s");

  $bsql=mysqli_query($mycon1,"SELECT `description`, `lotno`, `unit`, `itemname` FROM `receiving` WHERE `code`='$code'");
  $bfetch=mysqli_fetch_array($bsql);
  $description=$bfetch['description'];
  $lotno=$bfetch['lotno'];
  $itemname=$bfetch['itemname'];

  $csql=mysqli_query($mycon1,"SELECT `patientidno`, `membership`, `hmomembership`, `policyno`, `status` FROM `admission` WHERE `caseno`='$caseno'");
  $cfetch=mysqli_fetch_array($csql);
  $patientidno=$cfetch['patientidno'];
  $membership=$cfetch['membership'];
  $hmomembership=$cfetch['hmomembership'];
  $policyno=$cfetch['policyno'];
  $status=$cfetch['status'];

  $dsql=mysqli_query($mycon1,"SELECT `senior`, `patientname` FROM `patientprofile` WHERE `patientidno`='$patientidno'");
  $dcount=mysqli_num_rows($dsql);
  if($dcount>0){
    $dfetch=mysqli_fetch_array($dsql);
    $sn=$dfetch['senior'];
    $patname=$dfetch['patientname'];
  }
  else{
    $d2sql=mysqli_query($mycon1,"SELECT CONCAT(`lastname`, ' ', `middlename`, ' ', `firstname`) AS `name` FROM `nsauthemployees` WHERE `empid`='$patientidno'");
    $d2fetch=mysqli_fetch_array($d2sql);
    $patname=$d2fetch['name'];
    $sn="N";
  }

  $esql=mysqli_query($mycon1,"SELECT `creditlimit` FROM `patientscredit` WHERE `caseno`='$caseno'");
  $efetch=mysqli_fetch_array($esql);
  $crl=$efetch['creditlimit'];

  if($hmomembership!="none"){
    $totallimit=$crl+$policyno;
  }
  else{
    $totallimit=$crl;
  }

  //EXCLUDE adjustment
  if(($code=="210330142303p-3")||($code=="210407140138p-3")||($code=="210407140432p-3") ||($code=="210422113305p-3") ||($code=="210330142232p-3") ||($code=="10007110p-3") ||($code=="L135p-3") ||($code=="210422113831p-3")||($code=="L77p-3") ||($code=="L1000p-3") ||($code=="110002625n-3")||($code=="210412153403p-3")||($code=="2081004p-23") ||($code=="210428135102p-50") ||($code=="210505163500p-24") ||($code=="L80p-3") ||($code=="1000554n-3") ||($code=="10007026p-3") ||($code=="L85p-3") ||($code=="210511142122p-50") ||($code=="210511142343p-50")||($code=="210519084140p-3")||($code=="210823152208p-3")||($code=="210804162541p-3")||($code=="210901082034p-3")||($code=="210901082006p-3")||($code=="10007314p-13")){
    $adjustment=0;
  }
  else{
    if($sn=="Y"){
      $adjustment=round((($sp*$qty)*0.20),2);
    }
    else if($sn=="N"){
      $adjustment=0;
    }
    else{
      $adjustment=0;
    }
  }

  $gross=round((($sp*$qty)-$adjustment),2);

  $pdate=date("M-d-Y");

  if($trantype=="cash"){
    $status="requested";
    include("insertitem.php");

    if(($kconw=="container")&&($kconcode!="")){
      include("pospharma-cont.php");
    }

    echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=http://$setip/2021codes/ChargeCart/$retadd?caseno=$caseno&station=$station&toh=$toh&tick=$tick'>";
  }
  else if($trantype=="charge"){
  //KNOW CREDIT LEFT-----------------------------
  $fsql=mysqli_query($mycon1,"SELECT SUM((sellingprice * quantity)-adjustment) AS totgross FROM productout WHERE caseno='$caseno' AND trantype='charge'");
  $ffetch=mysqli_fetch_array($fsql);
  $totgross=$ffetch['totgross'];
  $sqlStat=mysqli_query($mycon1,"SELECT status FROM admission WHERE caseno='$caseno'");
  $stt=mysqli_fetch_array($sqlStat);
  $stat=$stt['status'];
  //---------------------------------------------
    $status="Approved";

    if(($totgross+$gross)<$totallimit AND $stat != "YELLOW TAG"){
      include("insertitem.php");
      echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=http://$setip/2021codes/ChargeCart/$retadd?caseno=$caseno&station=$station&toh=$toh&tick=$tick'>";
    }
    else{
      if((stripos($caseno, "AR") !== FALSE)||(stripos($caseno, "AP") !== FALSE)){
        include("insertitem.php");
        echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=http://$setip/2021codes/ChargeCart/$retadd?caseno=$caseno&station=$station&toh=$toh&tick=$tick'>";
      }
      else{
        if($settrantype=="tpl" || $stat=="MGH"){
          include("insertitem.php");
          echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=http://$setip/2021codes/ChargeCart/$retadd?caseno=$caseno&station=$station&toh=$toh&tick=$tick'>";
        }
        else{
            echo "<span class='arial s18 red bold'>EXCEEDED CREDIT LIMIT!!! CANNOT CHARGE MORE ITEM!</span>";
            echo "<META HTTP-EQUIV='Refresh'CONTENT='8;URL=http://$setip/2021codes/ChargeCart/$retadd?caseno=$caseno&station=$station&toh=$toh&tick=$tick'>";
            if($status!="YELLOW TAG"){
              mysqli_query($mycon1,"UPDATE `admission` SET `status`='YELLOW TAG' WHERE `caseno`='$caseno'");
            }
        }
      }
    }
    echo "<br />CREDIT LIMIT: ".$totallimit."<br />TOTAL CHARGED: ".$totgross."";
  }

echo '
<script type="text/JavaScript">
<!--
function placeFocus() {
if (document.forms.length > 0) {
var field = document.forms[0];
for (i = 0; i < field.length; i++) {
if ((field.elements[i].type == "text") || (field.elements[i].type == "textarea") || (field.elements[i].type.toString().charAt(0) == "s")) {
document.forms[0].elements[i].focus();
break;
         }
      }
   }
}
//-->
</script>
';



echo "
<div align='left'>

</div>
";



}

?>
</body>
</html>
