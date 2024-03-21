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

$caseno=mysql_real_escape_string($_POST['caseno']);
$dept=mysql_real_escape_string($_POST['dept']);

//admission
$adsql=mysql_query("SELECT `patientidno`, `membership`, `hmomembership`, `policyno`, `dateadmit` FROM admission WHERE caseno='$caseno'");
$adfetch=mysql_fetch_array($adsql);
$patientidno=$adfetch['patientidno'];
$membership=$adfetch['membership'];
$hmomembership=$adfetch['hmomembership'];
$policyno=$adfetch['policyno'];
$dateadmit=$adfetch['dateadmit'];

$distsql=mysqli_query($mycon1,"SELECT `timedischarged`, `datearray` FROM `dischargedtable` WHERE `caseno`='$caseno'");
$distcount=mysqli_num_rows($distsql);
if($distcount!=0){
  $distfetch=mysqli_fetch_array($distsql);
  $disdt=$distfetch['datearray']." ".$distfetch['timedischarged'];
  $now=strtotime($disdt);
}
else{
  $now = time(); // or your date as well
}

$your_date = strtotime($dateadmit);
$datediff = $now - $your_date;

$diff = round($datediff / (60 * 60 * 24));
$nodays = $diff - 1;

//patientprofile
mysql_query("SET NAMES 'utf8'");
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

echo "Total Gross: ".number_format($totalgross,2)."<br />Total Discount: ".number_format($totaldiscount,2)."<br />Total Net: ".number_format($totalnet,2)."<br />";

include("allexcess.php");

if(($membership=="Nonmed-none")&&($hmomembership=="none")){//One*********************************************************************************************************
  echo "PHIC: None<br />HMO: None<br />";
}//End One***************************************************************************************************************************************************************
else if(($membership=="phic-med")&&($hmomembership=="none")){//Two*******************************************************************************************************
  echo "PHIC: Active<br />HMO: None<br />";
  //finalcaserate check
  $kfcsql=mysql_query("SELECT * FROM finalcaserate WHERE caseno='$caseno' AND (level='primary' OR level='secondary')");
  $kfccount=mysql_num_rows($kfcsql);

  if($kfccount==0){
    echo "<font color='red'>NO CASE RATE IS SET!!! Set Case Rate first.<br /></font>";
    echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=showcharges.php?caseno=$caseno'>";
  }
  else{
    //---------------------------------------------------------------------------------------------
    //finalcaserate primary
    $fc1sql=mysql_query("SELECT hospitalshare FROM finalcaserate WHERE caseno='$caseno' AND level='primary'");
    $fc1count=mysql_num_rows($fc1sql);

    if($fc1count==0){
      echo "<font color='red'>NO PRIMARY CASE RATE IS SET!!! Set Primary Case Rate first.<br /></font>";
    }
    else{
      $fc1fetch=mysql_fetch_array($fc1sql);
      $fchs=$fc1fetch['hospitalshare'];
      echo "PHIC 1 Avail: ".$fchs."<br />";
      $fcnewhs=$fchs;
      include("phicone.php");
    }
    //---------------------------------------------------------------------------------------------

    //---------------------------------------------------------------------------------------------
    //finalcaserate secondary
    $fc2sql=mysql_query("SELECT hospitalshare FROM finalcaserate WHERE caseno='$caseno' AND level='secondary'");
    $fc2count=mysql_num_rows($fc2sql);

    if($fc2count!=0){
      $fc2fetch=mysql_fetch_array($fc2sql);
      $fchs=$fc2fetch['hospitalshare'];
      echo "PHIC 2 Avail: ".$fchs."<br />";
      $fcnewhs=$fchs;
      include("phictwo.php");
    }
    //---------------------------------------------------------------------------------------------
    echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=showcharges.php?caseno=$caseno'>";
  }
}//End Two***************************************************************************************************************************************************************
else if(($membership=="phic-med")&&(($hmomembership=="hmo-hmo")||($hmomembership=="hmo-company"))){//Three**************************************************************************************************
  echo "PHIC: Active<br />HMO: Active<br />";
  //finalcaserate check
  $kfcsql=mysql_query("SELECT * FROM finalcaserate WHERE caseno='$caseno' AND (level='primary' OR level='secondary')");
  $kfccount=mysql_num_rows($kfcsql);

  if($kfccount==0){
    echo "<font color='red'>NO CASE RATE IS SET!!! Set Case Rate first.<br /></font>";
    echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=showcharges.php?caseno=$caseno'>";
  }
  else{
    //---------------------------------------------------------------------------------------------
    //finalcaserate primary
    $fc1sql=mysql_query("SELECT hospitalshare FROM finalcaserate WHERE caseno='$caseno' AND level='primary'");
    $fc1count=mysql_num_rows($fc1sql);

    if($fc1count==0){
      echo "<font color='red'>NO PRIMARY CASE RATE IS SET!!! Set Primary Case Rate first.<br /></font>";
    }
    else{
      $fc1fetch=mysql_fetch_array($fc1sql);
      $fchs=$fc1fetch['hospitalshare'];
      echo "PHIC 1 Avail: ".$fchs."<br />";
      $fcnewhs=$fchs;
      include("phicone.php");
    }
    //---------------------------------------------------------------------------------------------

    //---------------------------------------------------------------------------------------------
    //finalcaserate secondary
    $fc2sql=mysql_query("SELECT hospitalshare FROM finalcaserate WHERE caseno='$caseno' AND level='secondary'");
    $fc2count=mysql_num_rows($fc2sql);

    if($fc2count!=0){
      $fc2fetch=mysql_fetch_array($fc2sql);
      $fchs=$fc2fetch['hospitalshare'];
      echo "PHIC 2 Avail: ".$fchs."<br />";
      $fcnewhs=$fchs;
      include("phictwo.php");
    }
    //---------------------------------------------------------------------------------------------
  }

    //---------------------------------------------------------------------------------------------

    if($policyno>0){
      echo "HMO Avail: ".$policyno."<br />";
      $fcnewhs=$policyno;
      //include("hmo.php");
    }
    //---------------------------------------------------------------------------------------------
    echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=showcharges.php?caseno=$caseno'>";
}//End Three*************************************************************************************************************************************************************
else if(($membership=="Nonmed-none")&&(($hmomembership=="hmo-hmo")||($hmomembership=="hmo-company"))){//Four************************************************************************************************
echo "PHIC: None<br />HMO: Active<br />";
    //---------------------------------------------------------------------------------------------

    if($policyno>0){
      echo "HMO Avail: ".$policyno."<br />";
      $fcnewhs=$policyno;
      include("hmo.php");
    }
    //---------------------------------------------------------------------------------------------
    echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=showcharges.php?caseno=$caseno'>";
}//End Four**************************************************************************************************************************************************************
?>
</body>
</html>
