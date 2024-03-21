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

$caseno=mysqli_real_escape_string($conn,$_POST['caseno']);
$patientidno=mysqli_real_escape_string($conn,$_POST['patientidno']);

$ln=mysqli_real_escape_string($conn,$_POST['ln']);
$fn=mysqli_real_escape_string($conn,$_POST['fn']);
$su=mysqli_real_escape_string($conn,$_POST['su']);
$mn=mysqli_real_escape_string($conn,$_POST['mn']);
$name=$ln.$fn.$su.$mn;

$lastname=mysqli_real_escape_string($conn,$_POST['lastname']);
$firstname=mysqli_real_escape_string($conn,$_POST['firstname']);
$suffix=mysqli_real_escape_string($conn,$_POST['suffix']);
$middlename=mysqli_real_escape_string($conn,$_POST['middlename']);
$upname=$lastname.$firstname.$suffix.$middlename;

if($name!=$upname){
echo "
<div align='left'>
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='left' class='arial s18 white bold'>Saving changes...</div></td>
    </tr>
  </table>
</div>
";

mysqli_query($conn,"UPDATE `patientprofile` SET `lastname`='$lastname', `firstname`='$firstname', `middlename`='$middlename', `suffix`='$suffix' WHERE `patientidno`='$patientidno'");
}
else{
echo "
<div align='left'>
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='left' class='arial s18 white bold'>No changes were made...</div></td>
    </tr>
  </table>
</div>
";
}

echo "<META HTTP-EQUIV='Refresh'CONTENT='2;URL=cf2_front.php?caseno=$caseno'>";

?>
</body>
</html>
