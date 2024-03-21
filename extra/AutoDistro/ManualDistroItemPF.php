<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Manual Distro</title>
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
include("../Settings.php");
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());
//mysql_query("SET NAMES 'utf8'");

$caseno=mysql_real_escape_string($_GET['caseno']);
$refno=mysql_real_escape_string($_GET['refno']);

//admission
$adsql=mysql_query("SELECT `patientidno`, `membership`, `hmomembership`, `policyno` FROM admission WHERE caseno='$caseno'");
$adfetch=mysql_fetch_array($adsql);
$patientidno=$adfetch['patientidno'];
$membership=$adfetch['membership'];
$hmomembership=$adfetch['hmomembership'];
$policyno=$adfetch['policyno'];

if($membership=="Nonmed-none"){$phic="None";}else{$phic="Active";}
if($hmomembership=="none"){$hmo="None";}else{$hmo="Active";}

//patientprofile
$ptsql=mysql_query("SELECT `lastname`, `firstname`, `middlename`, `suffix`, `senior` FROM patientprofile WHERE patientidno='$patientidno'");
$ptfetch=mysql_fetch_array($ptsql);
$lastname=$ptfetch['lastname'];
$firstname=$ptfetch['firstname'];
$middlename=$ptfetch['middlename'];
$suffix=$ptfetch['suffix'];
$senior=$ptfetch['senior'];

$itmsql=mysql_query("SELECT * FROM productout WHERE refno='$refno'");
$itmfetch=mysql_fetch_array($itmsql);
$pde=$itmfetch['productdesc'];
$gro=$itmfetch['gross'];
$ph1=$itmfetch['phic'];
$ph2=$itmfetch['phic1'];
$hmo=$itmfetch['hmo'];

echo "
<table width='100%' border='0' cellpadding='0' cellspacing='0'>
  <tr>
    <td><div align='left' class='arial s20 bold blue'>MANUAL DISTRIBUTE PER ITEM</div></td>
  </tr>
  <tr>
    <td height='30'></td>
  </tr>
  <tr>
    <td><div align='left'>
      <table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <form name='save' method='post' action='ManualDistroItemSave.php'>
          <td class='t3 b3 l3 r3'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td colspan='5' height='3'></td>
            </tr>
            <tr>
              <td width='3'></td>
              <td><div align='left' class='arial s12 black'>&nbsp;Description&nbsp;</div></td>
              <td><div align='center' class='arial s12 black'>&nbsp;:&nbsp;</div></td>
              <td><div align='left'>&nbsp;<input type='text' class='bggreen bordergreen white arial s12 bold h25' value='$pde' readonly /></div></td>
              <td width='3'></td>
            </tr>
            <tr>
              <td colspan='5' height='3'></td>
            </tr>
            <tr>
              <td></td>
              <td><div align='left' class='arial s12 black'>&nbsp;Net&nbsp;</div></td>
              <td><div align='center' class='arial s12 black'>&nbsp;:&nbsp;</div></td>
              <td><div align='left'>&nbsp;<input type='text' name='gross' class='bggreen bordergreen white arial s12 bold h25' value='$gro' readonly /></div></td>
              <td></td>
            </tr>
            <tr>
              <td colspan='5' height='3'></td>
            </tr>
            <tr>
              <td></td>
              <td><div align='left' class='arial s12 black'>&nbsp;Case Rate 1&nbsp;</div></td>
              <td><div align='center' class='arial s12 black'>&nbsp;:&nbsp;</div></td>
              <td><div align='left'>&nbsp;<input type='text' name='phic' class='arial s12 bold h25' value='$ph1' /></div></td>
              <td></td>
            </tr>
            <tr>
              <td colspan='5' height='3'></td>
            </tr>
            <tr>
              <td></td>
              <td><div align='left' class='arial s12 black'>&nbsp;Case Rate 2&nbsp;</div></td>
              <td><div align='center' class='arial s12 black'>&nbsp;:&nbsp;</div></td>
              <td><div align='left'>&nbsp;<input type='text' name='phic1' class='arial s12 bold h25' value='$ph2' /></div></td>
              <td></td>
            </tr>
            <tr>
              <td colspan='5' height='3'></td>
            </tr>
            <tr>
              <td></td>
              <td><div align='left' class='arial s12 black'>&nbsp;HMO&nbsp;</div></td>
              <td><div align='center' class='arial s12 black'>&nbsp;:&nbsp;</div></td>
              <td><div align='left'>&nbsp;<input type='text' name='hmo' class='arial s12 bold h25' value='$hmo' /></div></td>
              <td></td>
            </tr>
            <tr>
              <td colspan='5' height='10'></td>
            </tr>
            <tr>
              <td></td>
              <td colspan='3' height='25'><div align='right'><input type='submit' class='bgblue borderblack white arial s14 bold h30 w100' value='Save' /></div></td>
              <td></td>
            </tr>
            <tr>
              <td colspan='5' height='3'></td>
            </tr>
          </table></td>
          <input type='hidden' name='refno' value='$refno' />
          <input type='hidden' name='caseno' value='$caseno' />
          </form>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
";

?>
</body>
</html>
