<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="../image/logo/logo.png" type="image/png" />
<link rel="shortcut icon" href="../image/logo/logo.png" type="image/png" />
<title>Claim Form 2 Back</title>
<link href="Resources/CSS/style.css" rel="stylesheet" type="text/css" />
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

include("backaccess.php");
include("Popup/PUS-Doctor.php");

$cursty="style='cursor: pointer;'";

echo"
<div align='center'>
  <table boder='0' width='730' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='left' style='font-family: arial; color: #8D8D8D;font-size: 10px;'><b>Patient Name:</b> $patientname</div></td>
    </tr>
    <tr>
      <td>
";

$qstart=0;
$qend=2;
$num=1;

include("cf2_back_body.php");

echo "
      </td>
    </tr>
  </table>
";

include("Popup/PU-Doctor1.php");
include("Popup/PU-Doctor2.php");
include("Popup/PU-Doctor3.php");

$qcheck=$qend+1;
if(!empty($pdrs[$qcheck])){
echo "
  <table boder='0' width='730' cellpadding='0' cellspacing='0'>
    <tr>
      <td height='25'></td>
    </tr>
    <tr>
      <td><div align='left' style='font-family: arial; color: #8D8D8D;font-size: 10px;'><b>Patient Name:</b> $patientname</div></td>
    </tr>
    <tr>
      <td>
";

$qstart=3;
$qend=5;
$num=2;

include("cf2_back_body.php");

echo "
      </td>
    </tr>
  </table>
";
}

include("Popup/PU-Doctor4.php");
include("Popup/PU-Doctor5.php");
include("Popup/PU-Doctor6.php");

$qcheck=$qend+1;
if(!empty($pdrs[$qcheck])){
echo "
  <table boder='0' width='730' cellpadding='0' cellspacing='0'>
    <tr>
      <td height='25'></td>
    </tr>
    <tr>
      <td><div align='left' style='font-family: arial; color: #8D8D8D;font-size: 10px;'><b>Patient Name:</b> $patientname</div></td>
    </tr>
    <tr>
      <td>
";

$qstart=6;
$qend=8;
$num=3;

include("cf2_back_body.php");

echo "
      </td>
    </tr>
  </table>
";
}

echo "
</div>
";


include("Popup/PU-Doctor7.php");
include("Popup/PU-Doctor8.php");
include("Popup/PU-Doctor9.php");
include("Popup/PU-Consent.php");
include("Popup/PU-HCIRep.php");

?>




</body>
</html>
