<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Charges List</title>
<link href="../../Resources/CSS/mystyle.css" rel="stylesheet" type="text/css" />
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
include("../../Settings.php");
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());
//mysql_query("SET NAMES 'utf8'");

$caseno=mysql_real_escape_string($_GET['caseno']);

//admission
$adsql=mysql_query("SELECT `patientidno`, `membership`, `hmomembership`, `policyno` FROM admission WHERE caseno='$caseno'");
$adfetch=mysql_fetch_array($adsql);
$patientidno=$adfetch['patientidno'];
$membership=$adfetch['membership'];
$hmomembership=$adfetch['hmomembership'];
$policyno=$adfetch['policyno'];

//patientprofile
$ptsql=mysql_query("SELECT `lastname`, `firstname`, `middlename`, `suffix`, `senior` FROM patientprofile WHERE patientidno='$patientidno'");
$ptfetch=mysql_fetch_array($ptsql);
$lastname=$ptfetch['lastname'];
$firstname=$ptfetch['firstname'];
$middlename=$ptfetch['middlename'];
$suffix=$ptfetch['suffix'];
$senior=$ptfetch['senior'];

$name=strtoupper($lastname.", ".$firstname." ".$middlename." ".$suffix);

echo "
<div align='left'>
  <table border='0' width='100%' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='left' class='arial blue bold s20'><u>$name</u></div></td>
    </tr>
    <tr>
      <td height='20'></td>
    </tr>
    <tr>
      <td><div align='left' class='arial red bold s18'>Charges List</div></td>
    </tr>
    <tr>
      <td height='5'></td>
    </tr>
    <tr>
      <form name='exclude' method='post' action='AddExclude/index.php'>
      <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td class='t2 b2 l2' width='30'><div align='center' class='arial black bold s12'></div></td>
          <td class='t2 b2 l1' width='auto'><div align='center' class='arial black bold s12'>&nbsp;Description&nbsp;</div></td>
          <td class='t2 b2 l1' width='auto'><div align='center' class='arial black bold s12'>&nbsp;Type&nbsp;</div></td>
          <td class='t2 b2 l1' width='100'><div align='center' class='arial black bold s12'>&nbsp;Price&nbsp;</div></td>
          <td class='t2 b2 l1' width='100'><div align='center' class='arial black bold s12'>&nbsp;Qty.&nbsp;</div></td>
          <td class='t2 b2 l1' width='100'><div align='center' class='arial black bold s12'>&nbsp;Gross&nbsp;</div></td>
          <td class='t2 b2 l1' width='100'><div align='center' class='arial black bold s12'>&nbsp;Discount&nbsp;</div></td>
          <td class='t2 b2 l1 r2' width='100'><div align='center' class='arial black bold s12'>&nbsp;Net&nbsp;</div></td>
        </tr>
";

$posql=mysql_query("SELECT productcode, productdesc, sellingprice, SUM(quantity) AS qty, SUM(adjustment) AS adj, SUM(gross) AS grs, productsubtype FROM productout WHERE caseno='$caseno' AND productcode NOT LIKE '%vacant%' AND trantype='charge' AND productsubtype NOT LIKE 'PROFESSIONAL FEE' GROUP BY productcode ORDER BY productdesc");
while($pofetch=mysql_fetch_array($posql)){
$productcode=$pofetch['productcode'];
$productdesc=$pofetch['productdesc'];
$sp=$pofetch['sellingprice'];
$qty=$pofetch['qty'];
$adj=$pofetch['adj'];
$grs=$pofetch['grs'];
$ptype=$pofetch['productsubtype'];

$net=$sp*$qty;

$desql=mysql_query("SELECT * FROM `distroexclude` WHERE caseno='$caseno' AND code='$productcode'");
$decount=mysql_num_rows($desql);

if($decount!=0){$ck="checked='checked'";}else{$ck="";}

echo "
        <tr>
          <td class='b1 l2' height='25'><div align='center' class='arial black s14'>&nbsp;<input type='checkbox' name='productcode[]' $ck value='$productcode' />&nbsp;</div></td>
          <td class='b1 l1'><div align='left' class='arial black s14'>&nbsp;$productdesc&nbsp;</div></td>
          <td class='b1 l1'><div align='left' class='arial black s14'>&nbsp;$ptype&nbsp;</div></td>
          <td class='b1 l1'><div align='rigth' class='arial black s14'>&nbsp;".number_format($sp,2,'.',',')."&nbsp;</div></td>
          <td class='b1 l1'><div align='right' class='arial black s14'>&nbsp;$qty&nbsp;</div></td>
          <td class='b1 l1'><div align='right' class='arial black s14'>&nbsp;".number_format($net,2,'.',',')."&nbsp;</div></td>
          <td class='b1 l1'><div align='right' class='arial black s14'>&nbsp;".number_format($adj,2,'.',',')."&nbsp;</div></td>
          <td class='b1 l1 r2'><div align='right' class='arial black s14'>&nbsp;".number_format($grs,2,'.',',')."&nbsp;</div></td>
        </tr>
";
}

echo "
        <tr>
          <td class='t1' colspan='8' height='10'></td>
        </tr>
        <tr>
          <td colspan='8'><div align='right'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='left'><input type='submit' name='action' class='arial s14 white bold bgred borderblack h30 w70' value='Remove' /></div></td>
              <td><div align='right'><input type='submit' name='action' class='arial s14 white bold bggreen borderblack h30 w70' value='Add' /></div></td>
            </tr>
          </table></td>
        </tr>
      </table></div></td>
      <input type='hidden' name='caseno' value='$caseno' />
      </form>
    </tr>
  </table>
</div>
";
?>
</body>
</html>
