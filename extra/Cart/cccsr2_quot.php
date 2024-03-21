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
</head>

<body onload="placeFocus()">
<?php
header("Refresh:300");
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

setcookie("ccpass", $ccpass, time() + 300, "/");
setcookie("ccname", $ccname, time() + 300, "/");

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
    echo "<META HTTP-EQUIV='Refresh'CONTENT='1;URL=http://$setip/2021codes/ChargeCart/cccsr2.php?caseno=$caseno&station=$station&toh=$toh&tick=$tick&stk=$stk'>";
  }
  else{
    echo "<span class='arial s16 red bold'>Unable to delete item. Item already dispensed.</span>";
    echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=http://$setip/2021codes/ChargeCart/cccsr2.php?caseno=$caseno&station=$station&toh=$toh&tick=$tick&stk=$stk'>";
  }
}
else{

  $losql=mysqli_query($mycon1,"SELECT status FROM admission WHERE caseno='$caseno'");
  $lofetch=mysqli_fetch_array($losql);
  $patst=$lofetch['status'];

  //KNOW CREDIT LEFT-----------------------------
  $totgross=0;
  $fsql=mysqli_query($mycon1,"SELECT sellingprice, quantity, adjustment FROM productout WHERE caseno='$caseno' AND quantity > 0  AND trantype='charge'");
  while($ffetch=mysqli_fetch_array($fsql)){
    $fsp=$ffetch['sellingprice'];
    $fqt=$ffetch['quantity'];
    $fad=$ffetch['adjustment'];

    $totgross+=($fsp*$fqt)-$fad;
  }
  //---------------------------------------------

if (!isset($_COOKIE["ccpass"])){
header("location: ../ChargeCart/?caseno=$caseno&station=$station&toh=$toh");
}
else{
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

function showResult() {
if (document.searchme.searchme.value.length==0) {
  document.getElementById("livesearch").innerHTML=" ";
  return;
  }
if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","cccsr2result_quot.php?caseno='.$caseno.'&station='.$station.'&toh='.$toh.'&tick='.$tick.'&stk='.$stk.'&at='.$totgross.'&cl='.$cl.'&searchme="+document.searchme.searchme.value,true);
xmlhttp.send();
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
';

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
          <td><input type='button' onclick=MM_openBrWindow('http://$setip/cgi-bin/printallsup2.cgi?ticketno=$tick&amp;caseno=$caseno','','toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes,width=800,height=800') value='CHARGE SLIP NO. $tick' /></td>
          <td><input type='button' onclick=MM_openBrWindow('cccsr2printticketRX.php?ticketno=$tick&amp;caseno=$caseno','','toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes,width=800,height=800') value='PRINT RX' /></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height='10'><div align='left' class='arial s14 bold'>CSR2 CART | USER: <span class='blue'>".$_COOKIE["ccname"]." --> $totgross</span></div></td>
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
echo "
    <tr class='div-container'>
      <form name='searchme'>
      <td><input name='searchme' type='text' autocomplete='off' placeholder='Type item name here...' onKeyUp='showResult();' /></td>
      <input type='hidden' name='caseno' value='$caseno' />
      <input type='hidden' name='station' value='$station' />
      <input type='hidden' name='toh' value='$toh' />
      <input type='hidden' name='tick' value='$tick' />
      <input type='hidden' name='stk' value='$stk' />
      </form>
    </tr>
    <tr>
      <td height='10'></td>
    </tr>
    <tr>
      <td><div id='livesearch' align='left'></div></td>
    </tr>
";
}

echo "
    <tr>
      <td height='10'></td>
    </tr>
";

$a=0;
$asql=mysqli_query($mycon1,"SELECT refno, productdesc, quantity, trantype FROM productout WHERE caseno='$caseno' AND batchno='$tick'");
$acount=mysqli_num_rows($asql);

if($acount!=0){
echo "
    <tr>
      <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td class='t2 b2'><div align='center' class='arial s11 black bold'>#</div></td>
          <td class='t2 b2' width='400'><div align='center' class='arial s11 black bold'>Description</div></td>
          <td class='t2 b2' width='50'><div align='center' class='arial s11 black bold'>Quantity</div></td>
          <td class='t2 b2' width='50'><div align='center' class='arial s11 black bold'></div></td>
        </tr>
";


while($afetch=mysqli_fetch_array($asql)){
$refno=$afetch['refno'];
$desc=$afetch['productdesc'];
$quan=$afetch['quantity'];
$tran=$afetch['trantype'];
$a++;

echo "
        <tr>
          <td class='b1' width='30' height='20'><div align='left' class='arial s13 black'>$a</div></td>
          <td class='b1'><div align='left' class='arial s13 black'>$desc <span style='color: red;'>($tran)</span></div></td>
          <td class='b1' width='50'><div align='center' class='arial s13 black'>$quan</div></td>
          <form name='delete' method='get' action='cccsr2.php'>
          <td class='b1' width='50'><div align='center'><button type='submit' name='delete' class='borderred bgred white s12'> X </button</div></td>
          <input type='hidden' name='caseno' value='$caseno' />
          <input type='hidden' name='station' value='$station' />
          <input type='hidden' name='toh' value='$toh' />
          <input type='hidden' name='tick' value='$tick' />
          <input type='hidden' name='stk' value='$stk' />
          <input type='hidden' name='refno' value='$refno' />
          </form>
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
