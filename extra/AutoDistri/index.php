<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Auto Distro</title>
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
$dept=mysql_real_escape_string($_GET['dept']);

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

$kposql=mysql_query("SELECT SUM(sellingprice*quantity) AS totgross, SUM(adjustment) AS totdiscount, SUM(gross) AS totnet FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype NOT LIKE 'PROFESSIONAL FEE'");
$kpofetch=mysql_fetch_array($kposql);
$totalgross=$kpofetch['totgross'];
$totaldiscount=$kpofetch['totdiscount'];
$totalnet=$kpofetch['totnet'];

$know=0;

echo "
<table width='100%' border='0' cellpadding='0' cellspacing='0'>
  <tr>
    <td><div align='left' class='arial s20 bold blue'>AUTO DISTRIBUTE CHARGES</div></td>
  </tr>
  <tr>
    <td height='30'></td>
  </tr>
  <tr>
    <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td><div align='left' class='arial s12 black bold'>Patient</div></td>
        <td><div align='left' class='arial s12 black bold'>&nbsp;:&nbsp;</div></td>
        <td class='b1'><div align='left' class='arial s14 black'>&nbsp;".$lastname.", ".$firstname." ".$middlename." ".$suffix."&nbsp;</div></td>
      </tr>
      <tr>
        <td colspan='3' height='10'></td>
      </tr>
      <tr>
        <td><div align='left' class='arial s12 black bold'>Total Charges</div></td>
        <td><div align='left' class='arial s12 black bold'>&nbsp;:&nbsp;</div></td>
        <td><div align='left' class='arial s14 black'>&nbsp;".$totalnet."&nbsp;</div></td>
      </tr>
      <tr>
        <td colspan='3' height='15'></td>
      </tr>
      <tr>
        <td><div align='left' class='arial s12 black bold'>PHIC</div></td>
        <td><div align='left' class='arial s12 black bold'>&nbsp;:&nbsp;</div></td>
        <td><div align='left' class='arial s14 black'>&nbsp;".$phic."&nbsp;</div></td>
      </tr>
";

if($phic=="Active"){
  //finalcaserate check
  $kfcsql=mysql_query("SELECT * FROM finalcaserate WHERE caseno='$caseno' AND (level='primary' OR level='secondary')");
  $kfccount=mysql_num_rows($kfcsql);

  if($kfccount==0){
    echo "
      <tr>
        <td colspan='3'><div align='left' class='arial s14 red bold'>CASE RATE IS NOT SET.</div></td>
      </tr>
    ";
    $know+=1;
  }
  else {
    $fc1sql=mysql_query("SELECT hospitalshare FROM finalcaserate WHERE caseno='$caseno' AND level='primary'");
    $fc1count=mysql_num_rows($fc1sql);
    $fc1fetch=mysql_fetch_array($fc1sql);

    if($fc1count!=0){
      $fc1hshare=$fc1fetch['hospitalshare'];
      echo "
      <tr>
        <td><div align='left' class='arial s12 black bold'>Case Rate 1</div></td>
        <td><div align='left' class='arial s12 black bold'>&nbsp;:&nbsp;</div></td>
        <td><div align='left' class='arial s14 black'>&nbsp;".$fc1hshare."&nbsp;</div></td>
      </tr>
      ";
    }
    else{
      $know+=1;
    }

    $fc2sql=mysql_query("SELECT hospitalshare FROM finalcaserate WHERE caseno='$caseno' AND level='secondary'");
    $fc2count=mysql_num_rows($fc2sql);
    $fc2fetch=mysql_fetch_array($fc2sql);

    if($fc2count!=0){
      $fc2hshare=$fc2fetch['hospitalshare'];
      echo "
      <tr>
        <td><div align='left' class='arial s12 black bold'>Case Rate 2</div></td>
        <td><div align='left' class='arial s12 black bold'>&nbsp;:&nbsp;</div></td>
        <td><div align='left' class='arial s14 black'>&nbsp;".$fc2hshare."&nbsp;</div></td>
      </tr>
      ";
    }

  }
}

echo "
      <tr>
        <td colspan='3' height='20'></td>
      </tr>
      <tr>
        <td><div align='left' class='arial s12 black bold'>HMO</div></td>
        <td><div align='left' class='arial s12 black bold'>&nbsp;:&nbsp;</div></td>
        <td><div align='left' class='arial s14 black'>&nbsp;".$hmo."&nbsp;</div></td>
      </tr>
";

  if($hmo=="Active"){

    if($policyno<1){
      echo "
      <tr>
        <td colspan='3'><div align='left' class='arial s14 red bold'>LOA MUST BE SET FIRST.</div></td>
      </tr>
      ";
      $know+=1;
    }
    else {
      echo "
      <tr>
        <td><div align='left' class='arial s12 black bold'>LOA</div></td>
        <td><div align='left' class='arial s12 black bold'>&nbsp;:&nbsp;</div></td>
        <td><div align='left' class='arial s14 black'>&nbsp;".$policyno."&nbsp;</div></td>
      </tr>
      ";
    }
  }

echo "
    </table></div></td>
  </tr>
  <tr>
    <td height='30'></td>
  </tr>
";

if($know==0){
  echo "
  <tr>
    <form name='Auto' method='post' action='../AutoDistro/' >
    <td height='30'><input type='submit' class='bggreen borderblack arial s16 white bold h35' value='DISTRIBUTE CHARGES NOW' /></td>
    <input type='hidden' name='caseno' value='$caseno' />
    <input type='hidden' name='dept' value='$dept' />
    </form>
  </tr>
  ";
}
else{
  echo "
  <tr>
    <td height='30'><input type='submit' class='bggrey bordergrey arial s16 grey bold h35' value='DISTRIBUTE CHARGES NOW' disabled /></td>
  </tr>
  ";
}

echo "
  <tr>
    <td height='30'></td>
  </tr>
</table>
";

?>
</body>
</html>
