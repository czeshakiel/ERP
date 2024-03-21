<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Home Meds</title>
<link href="Resources/CSS/mystyle.css" rel="stylesheet" type="text/css" />
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

</head>

<body onload="placeFocus()" bgcolor='#0099CC'>
<?php
include("../../main/class2.php");

$ip=$_SERVER['REMOTE_ADDR'];

$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);

$name=mysqli_real_escape_string($conn,$_GET['name']);
$dsm=mysqli_real_escape_string($conn,$_GET['dsm']);
$dsd=mysqli_real_escape_string($conn,$_GET['dsd']);
$dsy=mysqli_real_escape_string($conn,$_GET['dsy']);
$setnum=mysqli_real_escape_string($conn,$_GET['setnum']);

$filn=$caseno."_".$setnum;

$dat=$dsy.$dsm.$dsd;

if(isset($_GET['relationship1'])){$relationship1="<img src='Resources/Pictures/check.png' height='10' width='auto' />";}else{$relationship1="";}
if(isset($_GET['relationship2'])){$relationship2="<img src='Resources/Pictures/check.png' height='10' width='auto' />";}else{$relationship2="";}
if(isset($_GET['relationship3'])){$relationship3="<img src='Resources/Pictures/check.png' height='10' width='auto' />";}else{$relationship3="";}
if(isset($_GET['relationship4'])){$relationship4="<img src='Resources/Pictures/check.png' height='10' width='auto' />";}else{$relationship4="";}
if(isset($_GET['relationship5'])){$relationship5="<img src='Resources/Pictures/check.png' height='10' width='auto' />";}else{$relationship5="";}
$relationship5spec=mysqli_real_escape_string($conn,$_GET['relationship5spec']);

if(isset($_GET['reason1'])){$reason1="<img src='Resources/Pictures/check.png' height='10' width='auto' />";}else{$reason1="";}
if(isset($_GET['reason2'])){$reason2="<img src='Resources/Pictures/check.png' height='10' width='auto' />";}else{$reason2="";}
$reason2spec=mysqli_real_escape_string($conn,$_GET['reason2spec']);

if(isset($_GET['unable1'])){$unable1="<img src='Resources/Pictures/check.png' height='10' width='auto' />";}else{$unable1="";}
if(isset($_GET['unable2'])){$unable2="<img src='Resources/Pictures/check.png' height='10' width='auto' />";}else{$unable2="";}

$setdate=$dsy.$dsm.$dsd;

mysqli_query($conn,"SET NAMES 'utf8'");

$ret=fopen("Files/$filn.txt", "r") or die("Unable to open file!");
$retres=trim(fgets($ret));
fclose($ret);
//echo $retres."<br />";
$retressp=preg_split("/\*/",$retres);
$dt=preg_split("/\-/",$retressp[2]);

//echo $retressp[2]."<br />";

$in=$name."|".$dat."|".$relationship1."|".$relationship2."|".$relationship3."|".$relationship4."|".$relationship5."|".$reason1."|".$reason2."|".$unable1."|".$unable2."|".$relationship5spec."|".$reason2spec."|";
//echo $in."<br /><br />";

$sav=$retressp[0]."*".$retressp[1]."*".$in."*".$retressp[3]."*";//echo $sav."<br />";
//echo $retres."<br />";

echo "
<div align='left'>
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='left' class='arial s18 white bold'>Saving data...</div></td>
    </tr>
  </table>
</div>
";

$res= fopen("Files/$filn.txt", "w") or die("Unable to open file!");
fwrite($res, $sav);
fclose($res);

echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=cf2_back.php?caseno=$caseno'>";

?>
</body>
</html>
