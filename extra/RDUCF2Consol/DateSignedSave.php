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
$num=mysqli_real_escape_string($conn,$_GET['num']);
$dsm=mysqli_real_escape_string($conn,$_GET['dsm']);
$dsd=mysqli_real_escape_string($conn,$_GET['dsd']);
$dsy=mysqli_real_escape_string($conn,$_GET['dsy']);
$setnum=mysqli_real_escape_string($conn,$_GET['setnum']);

$filn=$caseno."_".$setnum;

$setdate=$dsy.$dsm.$dsd;

$nm=$num+1;

mysqli_query($conn,"SET NAMES 'utf8'");

$ret=fopen("Files/$filn.txt", "r") or die("Unable to open file!");
$retres=trim(fgets($ret));
fclose($ret);
//echo $retres."<br />";
$retressp=preg_split("/\*/",$retres);
$dt=preg_split("/\-/",$retressp[1]);

if($nm==1){
  $ds="-".$setdate."-".$dt[2]."-".$dt[3];
}
else if($nm==2){
  $ds="-".$dt[1]."-".$setdate."-".$dt[3];
}
else if($nm==3){
  $ds="-".$dt[1]."-".$dt[2]."-".$setdate;
}
//echo $retressp[1]."<br />";
//echo $ds."<br />";

//echo $retres."<br />";

$sav=$retressp[0]."*".$ds."*".$retressp[2]."*".$retressp[3]."*";
//echo $sav."<br />";

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
