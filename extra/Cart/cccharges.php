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

.quadrat {
  -webkit-animation: NAME-YOUR-ANIMATION 1s infinite;  /* Safari 4+ */
  -moz-animation: NAME-YOUR-ANIMATION 1s infinite;  /* Fx 5+ */
  -o-animation: NAME-YOUR-ANIMATION 1s infinite;  /* Opera 12+ */
  animation: NAME-YOUR-ANIMATION 1s infinite;  /* IE 10+, Fx 29+ */
}

@-webkit-keyframes NAME-YOUR-ANIMATION {
  0%, 49% {
    background-color: #FFFFFF;
    color: #FF0000;
    height: 100%;
  }
  50%, 100% {
    background-color: #FF0000;
    color: #FFFFFF;
    height: 100%;
  }
}
</style>
</head>

<body onload="placeFocus()">
<?php
header("Refresh:600");
ini_set("display_errors","On");
include("../../main/class.php");
$cuz = new database();
$setip=$cuz->setIP();

$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);
$station=mysqli_real_escape_string($conn,$_GET['station']);
$toh=mysqli_real_escape_string($conn,$_GET['toh']);
$tick=mysqli_real_escape_string($conn,$_GET['tick']);

mysqli_query($conn,"SET NAMES 'utf8'");

$patsql=mysqli_query($conn,"SELECT p.patientname, a.patientidno FROM admission a, patientprofile p WHERE a.caseno='$caseno' AND a.patientidno=p.patientidno");
$patfetch=mysqli_fetch_array($patsql);
$patname=strtoupper($patfetch['patientname']);
$patientidno=strtoupper($patfetch['patientidno']);

if(isset($_GET['delete'])){
$ccpass=$_COOKIE["ccpass"];
$ccname=$_COOKIE["ccname"];
$ccacce=$_COOKIE["ccacce"];

setcookie("ccpass", $ccpass, time() + 600, "/");
setcookie("ccname", $ccname, time() + 600, "/");
setcookie("ccacce", $ccacce, time() + 600, "/");

$refno=mysqli_real_escape_string($conn,$_GET['refno']);
$rchksql=mysqli_query($conn,"SELECT productcode, terminalname, status, trantype, productsubtype, approvalno FROM productout WHERE refno='$refno'");
$rchkfetch=mysqli_fetch_array($rchksql);
$sta=$rchkfetch['terminalname'];
$pco=$rchkfetch['productcode'];
$ptr=$rchkfetch['trantype'];
$stt=$rchkfetch['status'];
$pty=$rchkfetch['productsubtype'];
$app=$rchkfetch['approvalno'];

$miscsql=mysqli_query($conn,"SELECT `SEMIPRIVATE` FROM `receiving` WHERE `code`='$pco' AND `PRIVATE`='misc'");
$misccount=mysqli_num_rows($miscsql);

$miscaddsql=mysqli_query($conn,"SELECT `code` FROM `receiving` WHERE `SEMIPRIVATE`='$pco' AND `PRIVATE`='misc'");
$miscaddcount=mysqli_num_rows($miscaddsql);

  if($sta=='pending'){
    $da=date("YmdHis");
    if($ptr=="cash"){
      if($stt=="PAID"){
        echo "<span class='arial s16 red bold'>Unable to delete item. Item already &quot;PAID&quot;.</span>";
        echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=../Cart/cccharges.php?caseno=$caseno&station=$station&toh=$toh&tick=$tick'>";
      }
      else{
        if($misccount!=0){
          $miscfetch=mysqli_fetch_array($miscsql);
          $misccd=$miscfetch['SEMIPRIVATE'];
          mysqli_query($conn,"SELECT * FROM productout WHERE productcode='$misccd' AND approvalno='PA-$refno' INTO OUTFILE '/opt/lampp/htdocs/ERP/extra/Cart/DelLog/MISC-$refno-$da-$ccname.txt' FIELDS TERMINATED BY '|'");
          mysqli_query($conn,"DELETE FROM productout WHERE productcode='$misccd' AND approvalno='PA-$refno'");
        }

        if($miscaddcount!=0){
          $miscaddfetch=mysqli_fetch_array($miscaddsql);
          $miscaddcd=$miscaddfetch['code'];

          $apps=preg_split("/\-/",$app);
          $appref=$apps[1];

          mysqli_query($conn,"SELECT * FROM productout WHERE productcode='$miscaddcd' AND refno='$appref' INTO OUTFILE '/opt/lampp/htdocs/ERP/extra/Cart/DelLog/MISCI-$refno-$da-$ccname.txt' FIELDS TERMINATED BY '|'");
          mysqli_query($conn,"DELETE FROM productout WHERE productcode='$miscaddcd' AND refno='$appref'");
          mysqli_query($conn,"DELETE FROM labpending WHERE refno='$appref'");
        }

        if (file_exists('/opt/lampp/htdocs/ERP/extra/Cart/DelLog/'.$refno."-".$da."-".$ccname.'.txt')) {unlink('/opt/lampp/htdocs/ERP/extra/Cart/DelLog/'.$refno."-".$da."-".$ccname.'.txt');}
        mysqli_query($conn,"SELECT * FROM productout WHERE refno='$refno' INTO OUTFILE '/opt/lampp/htdocs/ERP/extra/Cart/DelLog/$refno-$da-$ccname.txt' FIELDS TERMINATED BY '|'");
        mysqli_query($conn,"DELETE FROM productout WHERE refno='$refno'");

        if($pty=="LABORATORY"){
          mysqli_query($conn,"DELETE FROM labpending WHERE refno='$refno'");
        }

        echo "<span class='arial s16 red bold'>Item deleted.</span>";
        echo "<META HTTP-EQUIV='Refresh'CONTENT='1;URL=../Cart/cccharges.php?caseno=$caseno&station=$station&toh=$toh&tick=$tick'>";
      }
    }
    else{
      if($misccount!=0){
        $miscfetch=mysqli_fetch_array($miscsql);
        $misccd=$miscfetch['SEMIPRIVATE'];
        mysqli_query($conn,"SELECT * FROM productout WHERE productcode='$misccd' AND approvalno='PA-$refno' INTO OUTFILE '/opt/lampp/htdocs/ERP/extra/Cart/DelLog/MISC-$refno-$da-$ccname.txt' FIELDS TERMINATED BY '|'");
        mysqli_query($conn,"DELETE FROM productout WHERE productcode='$misccd' AND approvalno='PA-$refno'");
      }

      if($miscaddcount!=0){
        $miscaddfetch=mysqli_fetch_array($miscaddsql);
        $miscaddcd=$miscaddfetch['code'];

        $apps=preg_split("/\-/",$app);
        $appref=$apps[1];

        mysqli_query($conn,"SELECT * FROM productout WHERE productcode='$miscaddcd' AND refno='$appref' INTO OUTFILE '/opt/lampp/htdocs/ERP/extra/Cart/DelLog/MISCI-$refno-$da-$ccname.txt' FIELDS TERMINATED BY '|'");
        mysqli_query($conn,"DELETE FROM productout WHERE productcode='$miscaddcd' AND refno='$appref'");
        mysqli_query($conn,"DELETE FROM labpending WHERE refno='$appref'");
      }

      if (file_exists('/opt/lampp/htdocs/ERP/extra/Cart/DelLog/'.$refno."-".$da."-".$ccname.'.txt')) {unlink('/opt/lampp/htdocs/ERP/extra/Cart/DelLog/'.$refno."-".$da."-".$ccname.'.txt');}
      mysqli_query($conn,"SELECT * FROM productout WHERE refno='$refno' INTO OUTFILE '/opt/lampp/htdocs/ERP/extra/Cart/DelLog/$refno-$da-$ccname.txt' FIELDS TERMINATED BY '|'");
      mysqli_query($conn,"DELETE FROM productout WHERE refno='$refno'");

      if($pty=="LABORATORY"){
        mysqli_query($conn,"DELETE FROM labpending WHERE refno='$refno'");
      }

      echo "<span class='arial s16 red bold'>Item deleted.</span>";
      echo "<META HTTP-EQUIV='Refresh'CONTENT='1;URL=../Cart/cccharges.php?caseno=$caseno&station=$station&toh=$toh&tick=$tick'>";
    }
  }
  else{
    $ctnnum=0;
    $ctnsql=mysqli_query($conn,"SELECT `SEMIPRIVATE` FROM `receiving` WHERE `PRIVATE`='container' GROUP BY `SEMIPRIVATE`");
    while($ctnfetch=mysqli_fetch_array($ctnsql)){
      $ctnsp=$ctnfetch['SEMIPRIVATE'];
      if($pco==$ctnsp){$ctnnum++;}
    }

    if($ctnnum>0){
      $da=date("YmdHis");
      if (file_exists('/opt/lampp/htdocs/ERP/extra/Cart/DelLog/'.$refno."-".$da."-".$ccname.'.txt')) {unlink('/opt/lampp/htdocs/ERP/extra/Cart/DelLog/'.$refno."-".$da."-".$ccname.'.txt');}
      mysqli_query($conn,"SELECT * FROM productout WHERE refno='$refno' INTO OUTFILE '/opt/lampp/htdocs/ERP/extra/Cart/DelLog/$refno-$da-$ccname.txt' FIELDS TERMINATED BY '|'");
      mysqli_query($conn,"DELETE FROM productout WHERE refno='$refno'");
      echo "<span class='arial s16 red bold'>Item deleted.</span>";
      echo "<META HTTP-EQUIV='Refresh'CONTENT='1;URL=../Cart/cccharges.php?caseno=$caseno&station=$station&toh=$toh&tick=$tick'>";
    }
    else{
      echo "<span class='arial s16 red bold'>Unable to delete item. Item already testdone.</span>";
      echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=../Cart/cccharges.php?caseno=$caseno&station=$station&toh=$toh&tick=$tick'>";
    }
  }
}
else{

  //KNOW CREDIT LEFT-----------------------------
  $totgross=0;
  $fsql=mysqli_query($conn,"SELECT sellingprice, quantity, adjustment FROM productout WHERE caseno='$caseno' AND quantity > 0  AND trantype='charge'");
  while($ffetch=mysqli_fetch_array($fsql)){
    $fsp=$ffetch['sellingprice'];
    $fqt=$ffetch['quantity'];
    $fad=$ffetch['adjustment'];

    $totgross+=($fsp*$fqt)-$fad;
  }

  $losql=mysqli_query($conn,"SELECT policyno FROM admission WHERE caseno='$caseno'");
  $lofetch=mysqli_fetch_array($losql);
  $polno=$lofetch['policyno'];

  $clsql=mysqli_query($conn,"SELECT `creditlimit` FROM `patientscredit` WHERE `caseno`='$caseno'");
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
    $label="";
  }
  //---------------------------------------------

if (!isset($_COOKIE["ccpass"])){
header("location: ../Cart/?caseno=$caseno&station=$station&toh=$toh");
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
xmlhttp.open("GET","ccchargesresult.php?caseno='.$caseno.'&station='.$station.'&toh='.$toh.'&tick='.$tick.'&at='.$totgross.'&cl='.$cl.'&searchme="+document.searchme.searchme.value,true);
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
      <td><div align='left' style='font-family: arial;font-weight: bold;font-size: 18px;'>PATIENT NAME: <span style='color: #FF0000;'>$patname</span></div></td>
    </tr>
    <tr>
      <td><table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <!-- td><input type='button' onclick=MM_openBrWindow('http://$setip/2011codes/nsprintps.php?ticketno=$tick&amp;caseno=$caseno','','toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes,width=800,height=800') value='CHARGE SLIP NO. $tick' /></td -->
          <!--td><input type='button' onclick=MM_openBrWindow('http://$setip/cgi-bin/printallsup2.cgi?ticketno=$tick&amp;caseno=$caseno','','toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes,width=800,height=800') value='CHARGE SLIP NO. $tick' /></td-->
          <!-- td><input type='button' onclick=MM_openBrWindow('http://$setip/2021codes/Ticket/print_ticket_all.php?ticketno=$tick&amp;caseno=$caseno','','toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes,width=800,height=800') value='CHARGE SLIP NO. $tick' /></td -->
          <!-- td><input type='button' onclick=MM_openBrWindow('http://$setip/cgi-bin/nsprintps1.cgi?ticketno=$tick&amp;caseno=$caseno','','toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes,width=800,height=800') value='STANDARD CHARGE SLIP NO. $tick' /></td -->
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height='10'><div align='left' class='arial s14 bold'>CHARGES CART | USER: <span class='blue'>".$_COOKIE["ccname"]." --> $totgross</span></div></td>
    </tr>
    <tr class='div-container'>
      <form name='searchme'>
      <td><input name='searchme' type='text' autocomplete='off' placeholder='Type item name here...' onKeyUp='showResult();' /></td>
      <input type='hidden' name='caseno' value='$caseno' />
      <input type='hidden' name='station' value='$station' />
      <input type='hidden' name='toh' value='$toh' />
      <input type='hidden' name='tick' value='$tick' />
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
$presdate=date("Y-m-d");
$asql=mysqli_query($conn,"SELECT refno, productcode, productdesc, quantity, trantype FROM productout WHERE caseno='$caseno' AND batchno='$tick'");
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
$ccode=$afetch['productcode'];
$desc=$afetch['productdesc'];
$quan=$afetch['quantity'];
$tran=$afetch['trantype'];
$a++;
$zsql=mysqli_query($conn,"SELECT po.`refno`, a.`caseno` FROM `admission` a, `productout` po WHERE a.`patientidno`='$patientidno' AND a.`caseno` NOT LIKE '$caseno' AND a.`dateadmit`='$presdate' AND a.`caseno`=po.`caseno` AND po.`productcode`='$ccode' AND (po.`trantype`='cash' OR po.`trantype`='charge') AND (po.`status`='PAID' OR po.`status`='Approved')");
$zcount=mysqli_num_rows($zsql);

$ysql=mysqli_query($conn,"SELECT `remarks` FROM `labtest` WHERE `refno`='$refno'");
$yfetch=mysqli_fetch_array($ysql);
$rmksd=$yfetch['remarks'];

if($rmksd!=""){
  $rmksd=" REMARKS: ".$rmksd;
}

echo "
        <tr>
          <td class='b1' width='30' height='20'><div align='left' class='arial s13 black'>$a</div></td>
";

if($zcount!=0){
  $zfetch=mysqli_fetch_array($zsql);
  $otrefno=$zfetch['refno'];
  $otcaseno=$zfetch['caseno'];

echo "
          <td class='b1'><div align='left' class='arial s13 black'>$desc <span style='color: red;cursor: pointer;'>($tran) --> <span class='quadrat' style='color: #FF0000;font-family: arial;font-size: 10px;font-weight: bold;' title='System detected that the same service is requested to this patient from a previous transaction this day.'"; ?> onclick="<?php echo "window.open('ItemDetails.php?caseno=$otcaseno&patid=$patientidno&refno=$otrefno', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=400,width=500,height=200');";?>" <?php echo ">(Duplicate Request)</span></span></div></td>
";
}
else{
echo "
          <td class='b1'><div align='left' class='arial s13 black'>$desc <span style='color: red;'>($tran)</span><span style='color: blue;'>$rmksd</span></div></td>
";
}

echo "
          <td class='b1' width='50'><div align='center' class='arial s13 black'>$quan</div></td>
          <form name='delete' method='get' action='cccharges.php'>
          <td class='b1' width='50'><div align='center'><button type='submit' name='delete' class='borderred bgred white s12'> X </button</div></td>
          <input type='hidden' name='caseno' value='$caseno' />
          <input type='hidden' name='station' value='$station' />
          <input type='hidden' name='toh' value='$toh' />
          <input type='hidden' name='tick' value='$tick' />
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