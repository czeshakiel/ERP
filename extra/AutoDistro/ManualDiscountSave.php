<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Manual Distro</title>
<link href="../Resources/CSS/mystyle.css" rel="stylesheet" type="text/css" />
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
<style style="text/css">
/* Define the default color for all the table rows */
.hoverTable tr{background: #ffffff;}

/* Define the hover highlight color for the table row */
.hoverTable tr:hover {background-color: #ffff99;}
</style>
</head>

<body onload="placeFocus()">
<?php
include("../Settings.php");
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());
//mysql_query("SET NAMES 'utf8'");

$caseno=mysql_real_escape_string($_POST['caseno']);
$refno=mysql_real_escape_string($_POST['refno']);
$net=mysql_real_escape_string($_POST['net']);
$adjustment=mysql_real_escape_string($_POST['adjustment']);
$gross=mysql_real_escape_string($_POST['gross']);
$phic=mysql_real_escape_string($_POST['phic']);
$phic1=mysql_real_escape_string($_POST['phic1']);
$hmo=mysql_real_escape_string($_POST['hmo']);

$newgross=$net-$adjustment;
$newexcess=$newgross-$phic-$phic1-$hmo;

echo "
<table width='100%' border='0' cellpadding='0' cellspacing='0'>
";

if((is_numeric($phic))&&(is_numeric($phic1))&&(is_numeric($hmo))){
  if($tot>$gross){
    echo "
  <tr>
    <td><div align='left' class='arial s20 bold red'>Error!!! Total amount inputed is greater than the net total. Try again.</div></td>
  </tr>
    ";
    echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=ManualDistroItem.php?caseno=$caseno&refno=$refno'>";
  }
  else{
    echo "
  <tr>
    <td><div align='left' class='arial s20 bold blue'>Saving changes...</div></td>
  </tr>
    ";

    mysql_query("UPDATE productout SET adjustment='$adjustment', gross='$newgross', excess='$newexcess' WHERE refno='$refno'");

    echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=ManualDiscount.php?caseno=$caseno&refno=$refno'>";
  }
}
else{
echo "
  <tr>
    <td><div align='left' class='arial s20 bold red'>Invalid amount entered!!! Try again.</div></td>
  </tr>
";
echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=ManualDiscount.php?caseno=$caseno&refno=$refno'>";
}


echo "
</table>
";

?>
</body>
</html>
