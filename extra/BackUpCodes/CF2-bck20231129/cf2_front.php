<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="../image/logo/logo.png" type="image/png" />
<link rel="shortcut icon" href="../image/logo/logo.png" type="image/png" />
<title>Claim Form 2 Front</title>
<link href="Resources/CSS/style.css" rel="stylesheet" type="text/css" />
<link href="Resources/CSS/mystyle.css" rel="stylesheet" type="text/css" />
<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />
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
<style type="text/css">
<!--

-->
</style>
</head>

<body onload="placeFocus()">

<?php
ini_set("display_errors","On");
include("../../main/class2.php");

$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);
$user=base64_decode(mysqli_real_escape_string($conn,$_GET['user']));

$cursty="style='cursor: pointer;'";

include("access.php");
include("Popup/PUS-Doctor.php");

echo"
<div align='center'>
  <table width='730' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td class='t2 b2 l2 r2'>
        <table width='100%' border='0' cellpadding='0' cellspacing='0'>
";

include("cf2_front_header.php");
include("cf2_front_p1.php");
include("cf2_front_p2.php");
include("cf2_front_p3.php");
include("cf2_front_p4.php");

echo "
        </table>
      </td>
    </tr>
  </table>
";

$fcrpsql=mysqli_query($conn,"SELECT * FROM `finalcaserate` WHERE `caseno`='$caseno' $dontinclude AND `con`='' ORDER BY FIELD(`level`, 'primary', 'secondary', '', 'additional'), CAST(`autono` AS UNSIGNED)");
$fcrpcount=mysqli_num_rows($fcrpsql);
if($fcrpcount!=0){
echo"
  <table width='730' border='0' cellpaddinf='0' cellspacing='0'>
    <tr>
      <td height='8'></td>
    </tr>
  </table>
  <table width='730' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td class='t2 b2 l2 r2'>
        <table width='100%' border='0' cellpadding='0' cellspacing='0'>
";

include("cf2_front_header.php");
include("cf2_front_p1.php");
include("cf2_front_p2.php");
include("cf2_front_disdxalt.php");
include("cf2_front_p4.php");

echo "
        </table>
      </td>
    </tr>
  </table>
";

$fcrpsql=mysqli_query($conn,"SELECT * FROM `finalcaserate` WHERE `caseno`='$caseno' $dontinclude AND `con`='' ORDER BY FIELD(`level`, 'primary', 'secondary', '', 'additional'), CAST(`autono` AS UNSIGNED)");
$fcrpcount=mysqli_num_rows($fcrpsql);
if($fcrpcount!=0){
echo"
  <table width='730' border='0' cellpaddinf='0' cellspacing='0'>
    <tr>
      <td height='8'></td>
    </tr>
  </table>
  <table width='730' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td class='t2 b2 l2 r2'>
        <table width='100%' border='0' cellpadding='0' cellspacing='0'>
";

include("cf2_front_header.php");
include("cf2_front_p1.php");
include("cf2_front_p2.php");
include("cf2_front_disdxalt.php");
include("cf2_front_p4.php");

echo "
        </table>
      </td>
    </tr>
  </table>
";
}

$fcrpsql=mysqli_query($conn,"SELECT * FROM `finalcaserate` WHERE `caseno`='$caseno' $dontinclude AND `con`='' ORDER BY FIELD(`level`, 'primary', 'secondary', '', 'additional'), CAST(`autono` AS UNSIGNED)");
$fcrpcount=mysqli_num_rows($fcrpsql);
if($fcrpcount!=0){
echo"
  <table width='730' border='0' cellpaddinf='0' cellspacing='0'>
    <tr>
      <td height='8'></td>
    </tr>
  </table>
  <table width='730' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td class='t2 b2 l2 r2'>
        <table width='100%' border='0' cellpadding='0' cellspacing='0'>
";

include("cf2_front_header.php");
include("cf2_front_p1.php");
include("cf2_front_p2.php");
include("cf2_front_disdxalt.php");
include("cf2_front_p4.php");

echo "
        </table>
      </td>
    </tr>
  </table>
";
}

$fcrpsql=mysqli_query($conn,"SELECT * FROM `finalcaserate` WHERE `caseno`='$caseno' $dontinclude AND `con`='' ORDER BY FIELD(`level`, 'primary', 'secondary', '', 'additional'), CAST(`autono` AS UNSIGNED)");
$fcrpcount=mysqli_num_rows($fcrpsql);
if($fcrpcount!=0){
echo"
  <table width='730' border='0' cellpaddinf='0' cellspacing='0'>
    <tr>
      <td height='8'></td>
    </tr>
  </table>
  <table width='730' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td class='t2 b2 l2 r2'>
        <table width='100%' border='0' cellpadding='0' cellspacing='0'>
";

include("cf2_front_header.php");
include("cf2_front_p1.php");
include("cf2_front_p2.php");
include("cf2_front_disdxalt.php");
include("cf2_front_p4.php");

echo "
        </table>
      </td>
    </tr>
  </table>
";
}
}

echo "
</div>
";

include("Popup/PU-PatName.php");
include("Popup/PU-Dispo.php");

?>
</body>
</html>
