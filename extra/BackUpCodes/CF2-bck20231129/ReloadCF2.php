<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="../image/logo/logo.png" type="image/png" />
<link rel="shortcut icon" href="../image/logo/logo.png" type="image/png" />
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
ini_set("display_errors","On");
include("../../main/class2.php");

$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);

if(file_exists("Files/$caseno"."_1.txt")){unlink("Files/$caseno"."_1.txt");}
if(file_exists("Files/$caseno"."_2.txt")){unlink("Files/$caseno"."_2.txt");}
if(file_exists("Files/$caseno"."_3.txt")){unlink("Files/$caseno"."_3.txt");}
if(file_exists("Files/$caseno"."_4.txt")){unlink("Files/$caseno"."_4.txt");}

echo "
<div align='left'>
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='left' class='arial s18 white bold'>Realod CF2 data...</div></td>
    </tr>
  </table>
</div>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=Close.php'>";

?>
</body>
</html>
