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

$caseno=mysql_real_escape_string($_GET['caseno']);

$asql=mysql_query("SELECT * FROM soadetails WHERE caseno='$caseno'");
$afetch=mysql_fetch_array($asql);
$d1=$afetch['d1'];
$d2=$afetch['d2'];
$d3=$afetch['d3'];


echo "
<div align='left'>
  <table width='100%' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='left' class='arial s16 blue bold'>Edit Other Diagnosis</div></td>
    </tr>
    <tr>
      <td height='15'></td>
    </tr>
    <tr>
      <form name='Update' method='post' action='AddDiagnosisSave.php'>
      <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td class='t3 b3 l3 r3'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td colspan='3' height='5'></td>
            </tr>
            <tr>
              <td width='5'></td>
              <td><div laign='left' class='arial s13 black'>Dianosis 1</div></td>
              <td width='5'></td>
            </tr>
            <tr>
              <td colspan='3' height='5'></td>
            </tr>
            <tr>
              <td width='5'></td>
              <td><div align='left'><textarea name='d1' class='borderblue2 w500 h100 blue s14'>$d1</textarea></div></td>
              <td width='5'></td>
            </tr>
            <tr>
              <td colspan='3' height='5'></td>
            </tr>
            <tr>
              <td width='5'></td>
              <td><div laign='left' class='arial s13 black'>Dianosis 2</div></td>
              <td width='5'></td>
            </tr>
            <tr>
              <td colspan='3' height='5'></td>
            </tr>
            <tr>
              <td width='5'></td>
              <td><div align='left'><textarea name='d2' class='borderblue2 w500 h100 blue s14'>$d2</textarea></div></td>
              <td width='5'></td>
            </tr>
            <tr>
              <td colspan='3' height='5'></td>
            </tr>
            <tr>
              <td width='5'></td>
              <td><div laign='left' class='arial s13 black'>Dianosis 3</div></td>
              <td width='5'></td>
            </tr>
            <tr>
              <td colspan='3' height='5'></td>
            </tr>
            <tr>
              <td width='5'></td>
              <td><div align='left'><textarea name='d3' class='borderblue2 w500 h100 blue s14'>$d3</textarea></div></td>
              <td width='5'></td>
            </tr>
            <tr>
              <td colspan='3' height='5'></td>
            </tr>
            <tr>
              <td colspan='3'><div align='center'><input type='submit' class='arial bordergreen bggreen white s214 bold h40 w70' value='Save' /></div></td>
            </tr>
            <tr>
              <td colspan='3' height='5'></td>
            </tr>
          </table></td>
        </tr>
      </table></div></td>
      <input type='hidden' name='caseno' value='$caseno' />
      </form>
    </tr>
  </table>
</div>
";
?>
</body>
</html>
