<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="Resources/Favicon/favicon.png" type="image/png" />
<link rel="shortcut icon" href="Resources/Favicon/favicon.png" type="image/png" />
<title><?php include("../Settings.php"); $cuz = new database(); mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass()); mysql_select_db($cuz->getDB()); $snamesql=mysql_query("SELECT * FROM heading"); while($snamefetch=mysql_fetch_array($snamesql)){$sname=$snamefetch['heading'];$address=$snamefetch['address'];} echo "$sname"; ?></title>
<link href="../../eClaims/Resources/CSS/style.css" rel="stylesheet" type="text/css" />
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

session_start();

$caseno=mysql_real_escape_string($_GET['caseno']);
$setuser=mysql_real_escape_string($_GET['setuser']);

echo "
<div align='center'>
  <table width='100%' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td width='10'></td>
          <td><table bordercolor='#000000' bgcolor='#747474' border='1' cellpadding='0' cellspacing='0'>
            <tr>
              <form name='EditUser' method='post' action='EditUserSave.php'>
              <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td height='30'><div align='left' class='arial12whitebold'>&nbsp;Set User&nbsp;</div></td>
                  <td height='30'><div align='center' class='arial12whitebold'>:</div></td>
                  <td height='30'><div align='left' class='arial13white'>
                    <select name='name'>
                      <option selected='selected'>$setuser</option>
                      <!--option>ROSSANA B. SUMAMPONG</option-->
                      <option>CRISVEGINE LAZALITA</option>
                      <option>DIMPLE M. FUENTES</option>
                      <!--option>AIZA I. CHINANOG</option>
                      <option>CHARMAINE S. AHIT</option-->
                      <option>MA. ADELINE IGANG</option>
                      <option>LEA M. TANUDTANUD</option>
                      <option>MARIAN GRACE PUERTO</option>
                      <option>VON ANTHONY V. QUEZON</option>
                      <option>ENGELBERT E. DELA CRUZ</option>
                    </select>
                  </div></td>
                </tr>
                <tr>
                  <td height='25' colspan='3'><div align='right'><input type='submit' name='GO' class='butgreen01' value='   GO   ' />&nbsp;</div></td>
                </tr>
              </table></td>
              <input type='hidden' name='caseno' value='$caseno' />
              </form>
            </tr>
          </table></td>
        </tr>
      </table></td>
    </tr>
  </table>
</div>
";
?>
</body>
</html>
