<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Charges List</title>
<link href="../../../Resources/CSS/mystyle.css" rel="stylesheet" type="text/css" />
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
include("../../../Settings.php");
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());
//mysql_query("SET NAMES 'utf8'");

$caseno=mysql_real_escape_string($_POST['caseno']);
$action=mysql_real_escape_string($_POST['action']);

if(isset($_POST['productcode'])){
$pc=$_POST['productcode'];

echo "
<div align='left'>
  <table border='0' width='100%' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='left' class='arial blue bold s20'>Addint item to list...</div></td>
    </tr>
  </table>
</div>
";

foreach ($pc as $productcode){
echo $productcode."<br />";

$desql=mysql_query("SELECT * FROM `distroexclude` WHERE caseno='$caseno' AND code='$productcode'");
$decount=mysql_num_rows($desql);

$date=date("Y-m-d h:i:s");

if($action=="Add"){
if($decount==0){mysql_query("INSERT INTO `distroexclude` (`caseno`, `code`, `dateadded`) VALUES ('$caseno','$productcode','$date')");}
}
else if($action=="Remove"){
mysql_query("DELETE FROM `distroexclude` WHERE caseno='$caseno' AND code='$productcode'");
}

}

echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=../../ExcludeList/?caseno=$caseno'>";
}
else{
echo "
<div align='left'>
  <table border='0' width='100%' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='left' class='arial red bold s20'>NO ITEM SELECTED!!! Please select atleast 1 item.</div></td>
    </tr>
  </table>
</div>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='2;URL=../../ExcludeList/?caseno=$caseno'>";
}
?>
</body>
</html>
