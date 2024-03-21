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
ini_set("display_errors","On");
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

setcookie("ccpass", $ccpass, time() + 300, "/");
setcookie("ccname", $ccname, time() + 300, "/");
setcookie("ccacce", $ccacce, time() + 300, "/");

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
    echo "<META HTTP-EQUIV='Refresh'CONTENT='1;URL=http://$setip/2021codes/ChargeCart/ccpharmacy.php?caseno=$caseno&station=$station&toh=$toh&tick=$tick&stk=$stk'>";
  }
  else{
    echo "<span class='arial s16 red bold'>Unable to delete item. Item already dispensed.</span>";
    echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=http://$setip/2021codes/ChargeCart/ccpharmacy.php?caseno=$caseno&station=$station&toh=$toh&tick=$tick&stk=$stk'>";
  }
}
else{
  //KNOW CREDIT LEFT-----------------------------
  $totgross=0;
  $fsql=mysqli_query($mycon1,"SELECT sellingprice, quantity, adjustment, productdesc FROM productout WHERE caseno='$caseno' AND quantity > 0  AND trantype='charge'");
  while($ffetch=mysqli_fetch_array($fsql)){
    $ffetch=mysqli_fetch_array($fsql);
    $fsp=$ffetch['sellingprice'];
    $fqt=$ffetch['quantity'];
    $fad=$ffetch['adjustment'];
    $fde=$ffetch['productdesc'];

    $totgross+=($fsp*$fqt)-$fad;
    echo $fde." --> | ".$fsp." | ".$fqt." | ".$fad." | ".$totgross."<br />";
  }

  $clsql=mysqli_query($mycon1,"SELECT `creditlimit` FROM `patientscredit` WHERE `caseno`='$caseno'");
  $clcount=mysqli_num_rows($clsql);
  if($clcount==0){
    $cl=0;
  }
  else{
    $clfetch=mysqli_fetch_array($clsql);
    $cl=$clfetch['creditlimit'];
  }

  if($cl<$totgross){
    $label=" -->  <span style='color: #FF0000;'>EXCEEDED CREDIT LIMIT</span>";
  }
  else{
    $label=" --> $totgross";
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
xmlhttp.open("GET","ccpharmacyresult.php?caseno='.$caseno.'&station='.$station.'&toh='.$toh.'&tick='.$tick.'&stk='.$stk.'&at='.$totgross.'&cl='.$cl.'&searchme="+document.searchme.searchme.value,true);
xmlhttp.send();
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
';



echo "
<div align='left'>
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td><input type='button' onclick=MM_openBrWindow('http://$setip/cgi-bin/printallsup2A.cgi?ticketno=$tick&amp;caseno=$caseno','','toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes,width=800,height=800') value='CHARGE SLIP NO. $tick' /></td>
          <td><input type='button' onclick=MM_openBrWindow('ccpharmacyprintticket.php?ticketno=$tick&amp;caseno=$caseno','','toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes,width=800,height=800') value='PRINT ALL TICKET' /></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height='10'><div align='left' class='arial s14 bold'>PHARMACY CART | USER: <span class='blue'>".$_COOKIE["ccname"]." $label</span></div></td>
    </tr>
    <tr class='div-container'>
      <form name='searchme' method='get'>
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
    <tr>
      <td height='10'></td>
    </tr>
";

$a=0;
$asql=mysqli_query($mycon1,"SELECT refno, productdesc, quantity FROM productout WHERE caseno='$caseno' AND batchno='$tick'");
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
$a++;

echo "
        <tr>
          <td class='b1' width='30' height='20'><div align='left' class='arial s13 black'>$a</div></td>
          <td class='b1'><div align='left' class='arial s13 black'>$desc</div></td>
          <td class='b1' width='50'><div align='center' class='arial s13 black'>$quan</div></td>
          <form name='delete' method='get' action='ccpharmacy.php'>
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
