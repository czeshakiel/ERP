<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="Resources/Favicon/favicon.png" type="image/png" />
<link rel="shortcut icon" href="Resources/Favicon/favicon.png" type="image/png" />
<title><?php include("../Settings.php"); $cuz = new database(); mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass()); mysql_select_db($cuz->getDB()); $snamesql=mysql_query("SELECT heading FROM heading"); while($snamefetch=mysql_fetch_array($snamesql)){ $sname=$snamefetch['heading']; } echo "$sname"; ?></title>
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
//-->
</script>
</head>

<body onload="placeFocus()">
<div align='center'>
  <table style='height:100%;width:94%; position: absolute; top: 0; bottom: 0; left: 3%; right: 3%;' border='0' bordercolor='#000000' cellpadding='0' cellspacing='0'>
    <tr>
      <td style='height: 100%;'><div align='center'><img src='Resources/GIF/Loading.gif' height='300' width='auto' /></div></td>
    </tr>
  </table>
</div>
<?php
$caseno=mysql_real_escape_string($_GET['caseno']);
$username=mysql_real_escape_string($_GET['username']);

echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=ReloadCF4Real.php?caseno=$caseno&uname=$username'>";
?>
</body>
</html>
