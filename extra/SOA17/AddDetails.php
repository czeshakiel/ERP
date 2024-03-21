<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="../../image/logo/logo.png" type="image/png" />
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
$type=mysql_real_escape_string($_GET['type']);

$asql=mysql_query("SELECT * FROM soadetails WHERE caseno='$caseno'");
$afetch=mysql_fetch_array($asql);
$c1=$afetch['c1'];
$c2=$afetch['c2'];

if($type==1){
  $desc=$c1;
  $label="Primary";
}
else if($type==2){
  $desc=$c2;
  $label="Secondary";
}

echo "
<div align='left'>
  <table width='100%' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='left' class='arial s16 blue bold'>Edit $label Case Rate Description</div></td>
    </tr>
    <tr>
      <td height='15'></td>
    </tr>
    <tr>
      <form name='Update' method='post' action='AddDetailsSave.php'>
      <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td class='t3 b3 l3 r3'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td colspan='3' height='5'></td>
            </tr>
            <tr>
              <td width='5'></td>
              <td><div align='left'><textarea name='description' class='borderblue2 w500 h100 blue s14'>$desc</textarea></div></td>
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
      <input type='hidden' name='type' value='$type' />
      </form>
    </tr>
  </table>
";

$bsql=mysql_query("SELECT * FROM finalcaserate WHERE caseno='$caseno' AND (level='primary' OR level='secondary') ORDER BY level");
while($bfetch=mysql_fetch_array($bsql)){
  $icd=$bfetch['icdcode'];
  $hs=$bfetch['hospitalshare'];
  $ps=$bfetch['pfshare'];
  $lv=$bfetch['level'];
  $tot=$hs+$ps;

  if($lv=="primary"){$lvlabel="<span style='color: blue;'>PRIMARY</span>";}
  else if($lv=="secondary"){$lvlabel="<span style='color: red;'>SECONDARY</span>";}

  echo "
  <hr />
  <span style='font-family: Arial;'>
  Caserate Type: <b>$lvlabel</b><br />
  <span style='font-family: Arial;'>
  ICD/RVS Code: <b>$icd</b><br />
  Total Case Rate: <b>$tot</b><br />
  Hospital Share: <b>$hs</b><br />
  PF Share: <b>$ps</b>
  </span>
  <hr />
  ";
}

echo "
  <br />
</div>
";
?>
</body>
</html>
