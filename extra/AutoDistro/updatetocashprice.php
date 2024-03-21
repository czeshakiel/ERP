<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Show Charges</title>
<link href="../Resources/CSS/mystyle.css" rel="stylesheet" type="text/css" />
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
<style style="text/css">
/* Define the default color for all the table rows */
.hoverTable tr{background: #ffffff;}

/* Define the hover highlight color for the table row */
.hoverTable tr:hover {background-color: #ffff99;}
</style>
</head>

<body onload="placeFocus()">
<?php
ini_set("dispaly_errors","On");
include("../Settings.php");
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());
//mysql_query("SET NAMES 'utf8'");

if(isset($_POST['refno'])){
$cid=$_POST['refno'];

foreach ($cid as $refno){
  $asql=mysqli_query($mycon1,"SELECT `productcode`, `caseno`, `sellingprice`, `quantity`, `adjustment` FROM `productout` WHERE `refno`='$refno'");
  $afetch=mysqli_fetch_array($asql);
  $code=$afetch['productcode'];
  $caseno=$afetch['caseno'];
  $sp=$afetch['sellingprice'];
  $qty=$afetch['quantity'];
  $adj=$afetch['adjustment'];

  $totg=$sp*$qty;
  $adjperc=$adj/$totg;

  $bsql=mysqli_query($mycon1,"SELECT `opd` FROM `productsmasterlist` WHERE `code`='$code'");
  $bfetch=mysqli_fetch_array($bsql);
  $cashp=$bfetch['opd'];

if($adj>0){

}
else{
  $totgc=$cashp*$qty;

  echo "
  <div align='left'>
    $refno --> $code --> $cashp | $sp | $qty | $totgc | $adj | $adjperc |<br />
    <!-- UPDATE `productout` SET `sellingprice`='$cashp', `quantity`='$qty', `gross`='$totgc', `phic`='0', `hmo`='0', `excess`='$totgc', `phic1`='0'<br / -->
  </div>
  ";

    //mysqli_query($mycon1,"UPDATE `productout` SET `sellingprice`='$cashp', `quantity`='$qty', `gross`='$totg', `phic`='0', `hmo`='0', `excess`='$totg', `phic1`='0'");
}

  $pdate=date("YmdHis");
  mysqli_query($mycon1,"SELECT * FROM productout WHERE refno='$refno' INTO OUTFILE '/opt/lampp/htdocs/2020codes/AutoDistro/UpdatePriceLogs/$caseno-$pdate-$refno.txt' FIELDS TERMINATED BY '|'");
}
}
else{
  echo "<span style='color: red;font-weight: bold;'>ERROR!!! NO ITEM SELECTED</span>";
}
?>
</body>
</html>
