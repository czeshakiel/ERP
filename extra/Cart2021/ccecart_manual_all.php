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
.div-container .tpl {background-color: #821C97;}
.div-container .btn:hover, .open-button:hover {opacity: 1;}

/* Define the hover highlight color for the table row */
.hoverTable tr:hover {background-color: #ffff99;}
</style>
<script type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
</head>

<body onload="placeFocus()">
<?php
session_start();
header("Refresh:600");
//ini_set("display_errors","On");
include("../Settings.php");
$cuz = new database();
$setip=$cuz->setIP();

$caseno=mysqli_real_escape_string($mycon1,$_GET['caseno']);
$station=mysqli_real_escape_string($mycon1,$_GET['station']);
$toh=mysqli_real_escape_string($mycon1,$_GET['toh']);
$tick=mysqli_real_escape_string($mycon1,$_GET['tick']);
$stk=mysqli_real_escape_string($mycon1,$_GET['stk']);

if(isset($_GET['delete'])){
$ccpass=$_COOKIE["ccpass"];
$ccname=$_COOKIE["ccname"];
$ccacce=$_COOKIE["ccacce"];

setcookie("ccpass", $ccpass, time() + 600, "/");
setcookie("ccname", $ccname, time() + 600, "/");
setcookie("ccacce", $ccacce, time() + 600, "/");

$refno=mysqli_real_escape_string($mycon1,$_GET['refno']);
$rchksql=mysqli_query($mycon1,"SELECT administration FROM productout WHERE refno='$refno'");
$rchkfetch=mysqli_fetch_array($rchksql);
$sta=$rchkfetch['administration'];
  if($sta=='pending'){
    $da=date("YmdHis");
    if (file_exists('/opt/lampp/htdocs/2021codes/ChargeCart/DelLog/'.$refno."-".$da."-".$ccname.'.txt')) {unlink('/opt/lampp/htdocs/2021codes/ChargeCart/DelLog/'.$refno."-".$da."-".$ccname.'.txt');}
    mysqli_query($mycon1,"SELECT * FROM productout WHERE refno='$refno' INTO OUTFILE '/opt/lampp/htdocs/2021codes/ChargeCart/DelLog/$refno-$da-$ccname.txt' FIELDS TERMINATED BY '|'");
    mysqli_query($mycon1,"DELETE FROM productout WHERE refno='$refno'");
    echo "<span class='arial s16 red bold'>Item deleted.</span>";
    echo "<META HTTP-EQUIV='Refresh'CONTENT='1;URL=http://$setip/2021codes/ChargeCart/cccsr2_manual.php?caseno=$caseno&station=$station&toh=$toh&tick=$tick&stk=$stk'>";
  }
  else{
    echo "<span class='arial s16 red bold'>Unable to delete item. Item already dispensed.</span>";
    echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=http://$setip/2021codes/ChargeCart/cccsr2_manual.php?caseno=$caseno&station=$station&toh=$toh&tick=$tick&stk=$stk'>";
  }
}
else{
  //KNOW CREDIT LEFT-----------------------------
  $totgross=0;
  $fsql=mysqli_query($mycon1,"SELECT sellingprice, quantity, adjustment FROM productout WHERE caseno='$caseno' AND quantity > 0  AND trantype='charge'");
  while($ffetch=mysqli_fetch_array($fsql)){
    $fsp=$ffetch['sellingprice'];
    $fqt=$ffetch['quantity'];
    $fad=$ffetch['adjustment'];

    $totgross+=($fsp*$fqt)-$fad;
  }

  $losql=mysqli_query($mycon1,"SELECT policyno, status FROM admission WHERE caseno='$caseno'");
  $lofetch=mysqli_fetch_array($losql);
  $polno=$lofetch['policyno'];
  $patst=$lofetch['status'];

  $clsql=mysqli_query($mycon1,"SELECT `creditlimit` FROM `patientscredit` WHERE `caseno`='$caseno'");
  $clcount=mysqli_num_rows($clsql);
  if($clcount==0){
    $setcl=0;
  }
  else{
    $clfetch=mysqli_fetch_array($clsql);
    $setcl=$clfetch['creditlimit'];
  }

  $cl=$setcl+$polno;

  if($cl<$totgross){
    $label=" -->  <span style='color: #FF0000;'>EXCEEDED CREDIT LIMIT</span>";
  }
  else{
    $label=" --> $totgross | $cl";
  }
  //---------------------------------------------

if (!isset($_COOKIE["ccpass"])){
header("location: ../ChargeCart/?caseno=$caseno&station=$station&toh=$toh");
}
else{

$pen=0;
$dis=0;
if($patst=="LOCKED"){
  $pensql=mysqli_query($mycon1,"SELECT `refno`, `productdesc`, `invno`, `datearray`, `approvalno` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > '0' AND `administration`='pending' AND (`productsubtype` LIKE '%PHARMACY/MEDICINE%' OR `productsubtype` LIKE '%PHARMACY/SUPPLIES%' OR `productsubtype` LIKE '%MEDICAL SURGICAL SUPPLIES%')");
  while($penfetch=mysqli_fetch_array($pensql)){
    $prefno=$penfetch['refno'];
    $pdesc=$penfetch['productdesc'];
    $pinvno=$penfetch['invno'];
    $pdatearray=$penfetch['datearray'];
    $papprovalno=$penfetch['approvalno'];

    if($papprovalno==""){
      $pstartdt=$pdatearray." ".$pinvno;
    }
    else{
      $pstartdt=$penfetch['approvalno'];
    }

    $penddt=date("Y-m-d H:i:s");

    $date1 = new DateTime($pstartdt);
    $date2 = new DateTime($penddt);

    $diff = $date2->diff($date1);

    $hours = $diff->h;
    $hours = $hours + ($diff->days*24);

    //echo $prefno." --> ".$pdesc." --> ".$pstartdt." to ".$penddt." --> ".$hours."<br />";
    if($hours>='12'){
      $pen+=1;
    }
  }

  $dissql=mysqli_query($mycon1,"SELECT `refno`, `productdesc`, `invno`, `datearray`, `approvalno` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > '0' AND `administration`='dispensed' AND (`productsubtype` LIKE '%PHARMACY/MEDICINE%' OR `productsubtype` LIKE '%PHARMACY/SUPPLIES%' OR `productsubtype` LIKE '%MEDICAL SURGICAL SUPPLIES%')");
  while($disfetch=mysqli_fetch_array($dissql)){
    $drefno=$disfetch['refno'];
    $ddesc=$disfetch['productdesc'];
    $dinvno=$disfetch['invno'];
    $ddatearray=$disfetch['datearray'];
    $dapprovalno=$disfetch['approvalno'];

    if($dapprovalno==""){
      $dstartdt=$ddatearray." ".$dinvno;
    }
    else{
      $dstartdt=$disfetch['approvalno'];
    }

    $denddt=date("Y-m-d H:i:s");

    $ddate1 = new DateTime($dstartdt);
    $ddate2 = new DateTime($denddt);

    $ddiff = $ddate2->diff($ddate1);

    $dhours = $ddiff->h;
    $dhours = $dhours + ($ddiff->days*24);

    //echo $drefno." --> ".$ddesc." --> ".$dstartdt." to ".$denddt." --> ".$dhours."<br />";
    if($dhours>='12'){
      $dis+=1;
    }
  }//echo $pen." AND ".$dis;

  if(($pen==0)&&($dis==0)){
    mysqli_query($mycon1,"UPDATE `admission` SET `status`='Active' WHERE `caseno`='$caseno'");
  }
}

echo "
<div align='left'>
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <!-- td><input type='button' onclick=MM_openBrWindow('http://$setip/cgi-bin/printallsup2A.cgi?ticketno=$tick&amp;caseno=$caseno','','toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes,width=800,height=800') value='CHARGE SLIP NO. $tick' /></td -->
          <td><input type='button' onclick=MM_openBrWindow('ccpharmacyprintticketRX.php?ticketno=$tick&amp;caseno=$caseno','','toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes,width=800,height=800') value='PRINT RX' /></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height='10'><div align='left' class='arial s14 bold'>$stk CART | USER: <span class='blue'>".$_COOKIE["ccname"]." $label</span></div></td>
    </tr>
";

$lcksql=mysqli_query($mycon1,"SELECT `status` FROM `admission` WHERE `caseno`='$caseno'");
$lckfetch=mysqli_fetch_array($lcksql);
$lck=$lckfetch['status'];

if($lck=="LOCKED"){
  if($pen>0){
    if($dis>1){
      $qwe="are items";
    }
    else{
      $qwe="is an item";
    }

    $penlabel="<span style='color: #952BFF;font-size: 16px;'>The system detected that there $qwe need to be dispensed.</span>";
  }
  else{
    $penlabel="";
  }

  if($dis>0){
    if($dis>1){
      $asd="are items";
    }
    else{
      $asd="is an item";
    }

    $dislabel="<span style='color: #952BFF;font-size: 16px;'>The system detected that there $asd need to be administered.</span>";
  }
  else{
    $dislabel="";
  }

echo "
    <tr>
      <td height='80'><div align='left' style='color: red;font-family: arial;font-size: 20px;font-weight: bold;'>CSR2 CART IS DISABLED!!! $penlabel $dislabel</div></td>
    </tr>
";
}
else{
  if(isset($_GET['manual'])){$temval=mysqli_real_escape_string($mycon1,$_GET['searchme']);}else{$temval="";}
echo "
    <tr class='div-container'>
      <form name='searchme' method='get'>
      <td><input name='searchme' type='text' autocomplete='off' placeholder='Type item name here and press enter...' value='$temval' /></td>
      <input type='hidden' name='caseno' value='$caseno' />
      <input type='hidden' name='station' value='$station' />
      <input type='hidden' name='toh' value='$toh' />
      <input type='hidden' name='tick' value='$tick' />
      <input type='hidden' name='stk' value='$stk' />
      <input type='hidden' name='manual' value='' />
      </form>
    </tr>
    <tr>
      <td height='10'></td>
    </tr>
    <tr>
      <td><div align='left'>
";

  if(isset($_GET['manual'])){
    $at=$totgross;
    $cl=$cl;
    $searchme=mysqli_real_escape_string($mycon1,$_GET['searchme']);

    $len=strlen($searchme);

    $ccacce=$_COOKIE["ccacce"];

    if($len>1){

    $zsql=mysqli_query($mycon1,"SELECT membership, hmomembership, status FROM admission WHERE caseno='$caseno'");
    $zfetch=mysqli_fetch_array($zsql);
    $membership=$zfetch['membership'];
    $hmomembership=$zfetch['hmomembership'];
    $adstat=$zfetch['status'];

    $a=0;
    $asql=mysqli_query($mycon1,"SELECT r.unit, r.pnf, r.lotno, r.testcode, r.gtestcode, r.code, r.description, s.generic, SUM(s.quantity) AS soh FROM receiving r, stocktable s WHERE r.code=s.code AND (r.unit LIKE '%PHARMACY/SUPPLIES%' OR r.unit LIKE '%MEDICAL SURGICAL SUPPLIES%' OR r.unit LIKE '%PHARMACY/MEDICINE%') AND r.description LIKE '%$searchme%' AND s.dept='$stk' GROUP BY r.code");
    //$asql=mysqli_query($mycon1,"SELECT s.code, s.description, s.generic FROM receiving r, stocktable s WHERE r.code=s.code AND (r.unit LIKE '%PHARMACY/SUPPLIES%' OR r.unit LIKE '%MEDICAL SURGICAL SUPPLIES%') AND s.description LIKE '%$searchme%' AND s.dept='$stk' GROUP BY r.code");
    $acount=mysqli_num_rows($asql);

    if($acount==0){
    echo "
    <span class='arial s14 red bold'>0 Results Found!!!</span>
    ";
    }
    else{
    echo "
      <table border='1' bordercolor='#000000' cellpadding='0' cellspacing='0'>
        <tr>
          <td bgcolor='3380ff' width='30'><div align='center' class='arial s12 white bold'>&nbsp;#&nbsp;</div></td>
          <td bgcolor='3380ff' width='400'><div align='center' class='arial s12 white bold'>&nbsp;Description&nbsp;</div></td>
          <td bgcolor='3380ff' width='80'><div align='center' class='arial s12 white bold'>&nbsp;SOH&nbsp;</div></td>
          <td bgcolor='3380ff' width='80'><div align='center' class='arial s12 white bold'>&nbsp;Qty&nbsp;</div></td>

    	  <!--td bgcolor='3380ff' width='80'><div align='center' class='arial s12 white bold'>&nbsp;CASH&nbsp;</div></td>
    	  <td bgcolor='3380ff' width='80'><div align='center' class='arial s12 white bold'>&nbsp;CHARGE&nbsp;</div></td-->

          <td bgcolor='3380ff' width='160'><div align='center' class='arial s12 white bold'>&nbsp;&nbsp;</div></td>
          <td bgcolor='3380ff' width='150'><div align='center' class='arial s12 white bold'>&nbsp;Type&nbsp;</div></td>
        </tr>
    ";

    $chb=0;
    while($afetch=mysqli_fetch_array($asql)){
    $co=$afetch['code'];
    $ds=$afetch['description'];
    $gn=$afetch['generic'];
    $ty=$afetch['unit'];
    $pnf=$afetch['pnf'];
    $lot=$afetch['lotno'];
    $gte=$afetch['gtestcode'];
    $tes=$afetch['testcode'];
    $soh=$afetch['soh'];

    if($tes=="1"){
      $adt="MDRP";
    }
    else{
      $adt="NON MDRP";
    }

    if($lot=="S"){$lots="SPECIAL";}else{$lots="MARK-UP";}

    $ds=str_replace("cmshi-","",$ds);
    $ds=str_replace("-sup","",$ds);
    $ds=str_replace("-med","",$ds);
    $ds=str_replace("ams-","",$ds);

    $a++;

    if($gn!=""){
      $gndisp="($gn)";
    }
    else{
      $gndisp="";
    }

    if($pnf!="PNDF"){
    $bg="bgcolor='#FF0000' title='NON PNDF $adt'";
    }
    else{
    $bg="title='$adt'";
    }

    /*$ysql=mysqli_query($mycon1,"SELECT philhealth,nonmed  FROM productsmasterlist WHERE code='$co'");
    $yfetch=mysqli_fetch_array($ysql);
    $charge_price =$yfetch['philhealth'];
    $cash_price =$yfetch['nonmed'];*/

    echo "
      <form method='post' action='pospharma.php'>
        <tr $bg>
          <td height='35'><div align='center' class='arial s14 black'>&nbsp;$a&nbsp;</div></td>
          <td height='35'><div align='left' class='arial s14 black' title='$lots'>&nbsp;".strtoupper($ds)." ".strtoupper($gndisp)."&nbsp;</div></td>
          <td height='35'><div align='center' class='arial s14 black'>&nbsp;$soh&nbsp;</div></td>
          <td height='35'><div align='center'>&nbsp;<input type='number' name='qty' style='width: 50px;height: 20px;padding: 5px;margin: 3px 0 3px 0;border: none;background: #eee;border-radius: 5px;font-size: 14px;text-align: center;border: 1px solid #000000;' value='1' required />&nbsp;</div></td>

    	  <!--td height='35'><div align='center' class='arial s14 black'>&nbsp;$cash_price&nbsp;</div></td>
    	  <td height='35'><div align='center' class='arial s14 black'>&nbsp;$charge_price&nbsp;</div></td-->
    ";

    if($gte=="1"){
    echo "
          <td class='div-container'><div align='center' style='color: #c557ff;font-family: Arial;font-weight: bold;'>DISABLED</div></td>
    ";
    }
    else if($gte=="0"){
    if($soh<1){
    echo "
            <td class='div-container'><div align='center' style='color: #c557ff;font-family: Arial;font-weight: bold;'></div></td>
    ";
    }
    else{
    echo "
          <td class='div-container'><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
    ";
    if(stripos($caseno, "W") !== FALSE){
      if(((stripos($caseno, "AP") !== FALSE)||(stripos($caseno, "AR") !== FALSE))&&($bg=="")){
      echo "
              <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn' value='cash'>&nbsp;Cash&nbsp;</button></div></td>
              <td width='20'></td>
              <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn cancel' value='charge'>Charge</button></td>
      ";
      $chb+=1;
      }
      else{
      echo "
              <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn' value='cash'>&nbsp;Cash&nbsp;</button></div></td>
      ";
      }
    }
    else if((stripos($caseno, "AP") !== FALSE)||(stripos($caseno, "AR") !== FALSE)){
      echo "
              <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn' value='cash'>&nbsp;Cash&nbsp;</button></div></td>
              <td width='20'></td>
              <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn cancel' value='charge'>Charge</button></td>
      ";
      $chb+=1;
    }
    else{
      if((($membership=="Nonmed-none")||($membership=="none"))&&($hmomembership=="none")){
        if(((stripos($caseno, "AP") !== FALSE)||(stripos($caseno, "AR") !== FALSE))&&($bg=="")){
        echo "
              <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn' value='cash'>&nbsp;Cash&nbsp;</button></div></td>
              <td width='20'></td>
              <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn cancel' value='charge'>Charge</button></td>
        ";
        $chb+=1;
        }
        else{
        echo "
              <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn' value='cash'>&nbsp;Cash&nbsp;</button></div></td>
        ";
        if(($ccacce=="4")||($ccacce=="5")){
          if($chb==0){
          echo "
              <td width='20'></td>
              <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn tpl' value='tpl' title='To Pay Later'>&nbsp;TPL&nbsp;</button></td>
          ";
          }
        }
        }
      }
      else if(((($membership=="Nonmed-none")||($membership=="none"))&&($hmomembership!="none"))&&($bg=="")){
        echo "
              <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn' value='cash'>&nbsp;Cash&nbsp;</button></div></td>
              <td width='20'></td>
              <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn cancel' value='charge'>Charge</button></td>
        ";
        $chb+=1;
      }
      else{
        if($pnf!="PNDF"){
        echo "
              <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn' value='cash'>&nbsp;Cash&nbsp;</button></div></td>

              <!------------------------------------------ ARVID 06/09/2021 10:31am ------------------------------------>
              <td width='20'></td>
              <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn cancel' value='charge'>Charge</button></td>
              <!------------------------------------------------------------------------------>
        ";
        $chb+=1;

    if(($ccacce=="4")||($ccacce=="5")){
      if($chb==0){
        echo "
              <td width='20'></td>
              <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn tpl' value='tpl' title='To Pay Later'>&nbsp;TPL&nbsp;</button></td>
        ";
      }
    }

        }
        else{
        echo "
              <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn' value='cash'>&nbsp;Cash&nbsp;</button></div></td>
        ";

          if($cl>=$at){
          echo "
              <td width='20'></td>
              <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn cancel' value='charge'>Charge</button></td>
          ";

          if(($ccacce=="4")||($ccacce=="5")){
              echo "
                    <td width='20'></td>
                    <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn tpl' value='tpl' title='To Pay Later'>&nbsp;TPL&nbsp;</button></td>
              ";
          }
          $chb+=1;
          }
        }
      }
    }

    if((($ccacce=="4")||($ccacce=="5"))&&($cl<$at)){
      //if(stripos($bg, "NON PNDF") !== FALSE){
      //}
      //else{
    if($chb==0){
    echo "
              <td width='20'></td>
              <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn tpl' value='tpl' title='To Pay Later'>&nbsp;TPL&nbsp;</button></td>
    ";
    }
      //}
    }
    else{
      if(($cl>$at)&&($adstat=="LOCKED")&&(($ccacce=="4")||($ccacce=="5"))){
        if($chb==0){
    echo "
              <td width='20'></td>
              <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn tpl' value='tpl' title='To Pay Later'>&nbsp;TPL&nbsp;</button></td>
    ";
        }
      }
    }

    echo "
            </tr>
          </table></div></td>
    ";
  }
  }

    echo "
          <td height='35'><div align='left' class='arial s13 black'>&nbsp;".strtoupper($ty)."&nbsp;</div></td>
        </tr>
    ";

    if($ty!="LABORATORY"){
      echo "
        <input type='hidden' name='remarks' value='' />
      ";
    }

    echo "
        <input type='hidden' name='caseno' value='$caseno' />
        <input type='hidden' name='station' value='$station' />
        <input type='hidden' name='toh' value='$toh' />
        <input type='hidden' name='tick' value='$tick' />
        <input type='hidden' name='code' value='$co' />
        <input type='hidden' name='unit' value='$ty' />
        <input type='hidden' name='stk' value='$stk' />
        </form>
    ";
    }

    echo "
        <tr>
          <td colspan='6'><div align='left' style='font-family: courier;font-size: 10px;color: blue;padding-left: 5px;'>Nothing follows...</td>
        </tr>
      </table>
    ";
    }
    }
  }

echo "
      </div></td>
    </tr>
";
}

echo "
    <tr>
      <td height='10'></td>
    </tr>
";

$a=0;
$asql=mysqli_query($mycon1,"SELECT refno, productdesc, quantity, trantype, status FROM productout WHERE caseno='$caseno' AND quantity > 0 AND batchno='$tick'");
$acount=mysqli_num_rows($asql);

if($acount!=0){
echo "
    <tr>
      <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td class='t2 b2'><div align='center' class='arial s11 black bold'>#</div></td>
          <td class='t2 b2' width='400'><div align='center' class='arial s11 black bold'>Description</div></td>
          <td class='t2 b2' width='50'><div align='center' class='arial s11 black bold'>Quantity</div></td>
          <!-- td class='t2 b2' width='50'><div align='center' class='arial s11 black bold'></div></td>
          <td class='t2 b2' width='50'><div align='center' class='arial s11 black bold'></div></td -->
        </tr>
";


while($afetch=mysqli_fetch_array($asql)){
$refno=$afetch['refno'];
$desc=$afetch['productdesc'];
$quan=$afetch['quantity'];
$tran=$afetch['trantype'];
$stat=$afetch['status'];
$a++;

if($stat=="PAID"){$disa="class='bordergrey bggrey grey s12' disabled";$stla=" --> Paid";}else{$disa="class='borderred bgred white s12'";$stla="";}

$desc=str_replace("ams-","",$desc);
$desc=str_replace("-med","",$desc);
$desc=str_replace("-sup","",$desc);

echo "
        <tr>
          <td class='b1' width='30' height='20'><div align='left' class='arial s13 black'>$a</div></td>
          <td class='b1'><div align='left' class='arial s13 black'>$desc <span style='color: red;'>($tran)$stla</span></div></td>
          <td class='b1' width='50'><div align='center' class='arial s13 black'>$quan</div></td>
          <!-- form name='delete' method='get' action='cccsr2_manual.php'>
          <td class='b1' width='50'><div align='center'><button type='submit' name='delete' $disa> X </button</div></td>
          <input type='hidden' name='caseno' value='$caseno' />
          <input type='hidden' name='station' value='$station' />
          <input type='hidden' name='toh' value='$toh' />
          <input type='hidden' name='tick' value='$tick' />
          <input type='hidden' name='stk' value='$stk' />
          <input type='hidden' name='refno' value='$refno' />
          </form ->
          <!-- td class='b1' width='50'><div align='center'>
";

if($_SESSION['homemeds'] == "yes") {
echo "
          <form method='POST' action='../../2020codes/HomeMedsEnterDetails.php' target='_blank'>
            <button type='submit' name='rf' class='borderred bgred white s12'> Route/ Frequency </button</div>
            <input type='hidden' name='caseno' value='$caseno' />
            <input type='hidden' name='refno' value='$refno' />
            <input type='hidden' name='type' value='hm' />
          </form>
";
}

echo "
          </td -->
        </tr>
";
}

echo "
      </table></div></td>
    </tr>
";
}

echo "
  </table>
</div>
";
}
}


?>
</body>
</html>
