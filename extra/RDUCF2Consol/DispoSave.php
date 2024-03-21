<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Saving...</title>
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
ini_set("display_errors","On");
include("../../main/class2.php");

$ip=$_SERVER['REMOTE_ADDR'];

$caseno=mysqli_real_escape_string($conn,$_POST['caseno']);

$isref=mysqli_real_escape_string($conn,$_POST['isref']);
$hci=mysqli_real_escape_string($conn,$_POST['hci']);
$disposition=mysqli_real_escape_string($conn,$_POST['disposition']);
$expireddays=mysqli_real_escape_string($conn,$_POST['expireddays']);
$timeexpired=mysqli_real_escape_string($conn,$_POST['timeexpired']);
$romi=mysqli_real_escape_string($conn,$_POST['romi']);
$user=mysqli_real_escape_string($conn,$_POST['user']);

if($isref=="N"){$hciyes="";$hcino="checked";$hcirel="";}
else if($isref=="Y"){$hciyes="checked";$hcino="";$hcirel=$hci;}
else{$hciyes="";$hcino="";$hicrel="";}

if($romi=="P"){$private="checked";$nonprivate="";}
else if($romi=="N"){$private="";$nonprivate="checked";}
else{$private="";$nonprivate="";}

if($disposition=="E"){$expireddaysrel=$expireddays;$timeexpiredrel=$timeexpired;}
else{$expireddaysrel="";$timeexpiredrel="";}

echo "
<div align='left'>
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='left' class='arial s18 white bold'>Saving data...</div></td>
    </tr>
  </table>
</div>
";

$xsql=mysqli_query($conn,"SELECT `patientidno` FROM `admission` WHERE `caseno`='$caseno'");
$xfetch=mysqli_fetch_array($xsql);
$patid=$xfetch['patientidno'];

$asql=mysqli_query($conn,"SELECT * FROM `claiminfoadd` WHERE `caseno`='$caseno'");
$acount=mysqli_num_rows($asql);

if($acount==0){
  mysqli_query($conn,"INSERT INTO `claiminfoadd` (`patientidno`, `caseno`, `hciyes`, `hcino`, `hci`, `hciaddress`, `disposition`, `expireddays`, `timeexpired`, `transferto`, `transferadd`, `reasons`, `private`, `nonprivate`) VALUES ('$patid', '$caseno', '$hciyes', '$hcino', '$hcirel', '', '$disposition', '$expireddaysrel', '$timeexpiredrel', '', '', '', '$private', '$nonprivate')");
}
else{
  mysqli_query($conn,"UPDATE `claiminfoadd` SET `hciyes`='$hciyes', `hcino`='$hcino', `hci`='$hcirel', `disposition`='$disposition', `expireddays`='$expireddaysrel', `timeexpired`='$timeexpiredrel', `private`='$private', `nonprivate`='$nonprivate' WHERE `caseno`='$caseno'");
}

echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=cf2_front.php?caseno=$caseno&user=$user'>";

?>
</body>
</html>
