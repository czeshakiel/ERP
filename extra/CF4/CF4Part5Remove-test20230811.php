<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="Resources/Favicon/favicon.png" type="image/png" />
<link rel="shortcut icon" href="Resources/Favicon/favicon.png" type="image/png" />
<title>CF4 Creator 2.0</title>
<link href="Resources/CSS/style.css" rel="stylesheet" type="text/css" />
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
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
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
include("Settings.php");

$caseno=mysqli_real_escape_string($mycon5,$_POST['caseno']);
$source=mysqli_real_escape_string($mycon5,$_POST['source']);
$pDrugCode=mysqli_real_escape_string($mycon5,$_POST['pDrugCode']);
$no=mysqli_real_escape_string($mycon5,$_POST['no']);

mysqli_query($mycon5,"DELETE FROM `medicine` WHERE no='$no'");

mysqli_query($mycon1,"UPDATE `poaddon` SET `status`='pending' WHERE `caseno`='$caseno' AND `drugcode`='$pDrugCode'");

echo "
<table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; left: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
  <tr>
    <td><div align='center'>
      <table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td><div align='center' class='arial14redbold'>Entry deleted!!!</div></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=CF4Part5-test20230811.php?caseno=$caseno&source=$source'>";
?>
</body>
</html>
