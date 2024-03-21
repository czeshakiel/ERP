<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="Resources/Favicon/favicon.png" type="image/png" />
<link rel="shortcut icon" href="Favicon/logo.png" type="image/png" />
<title><?php include("../Settings.php"); $cuz = new database(); mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass()); mysql_select_db($cuz->getDB()); $snamesql=mysql_query("SELECT * FROM heading"); while($snamefetch=mysql_fetch_array($snamesql)){$sname=$snamefetch['heading'];$address=$snamefetch['address'];} echo "$sname"; ?></title>
<link href="CSS/mystyle.css" rel="stylesheet" type="text/css" />
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
mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$caseno=mysql_real_escape_string($_POST['caseno']);
$d1=strtoupper(mysql_real_escape_string($_POST['d1']));
$d2=strtoupper(mysql_real_escape_string($_POST['d2']));
$d3=strtoupper(mysql_real_escape_string($_POST['d3']));

mysql_query("UPDATE `soadetails` SET `d1`='$d1', `d2`='$d2', `d3`='$d3' WHERE caseno='$caseno'");

echo "
<div align='left'>
  <table width='100%' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='left' class='arial s16 blue bold'>Saving other diagnosis...</div></td>
    </tr>
  </table>
</div>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=AddDiagnosis.php?caseno=$caseno'>";
?>
</body>
</html>
