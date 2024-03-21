<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="../../Resources/Favicon/favicon.png" type="image/png" />
<link rel="shortcut icon" href="../../Resources/Favicon/favicon.png" type="image/png" />
<title>Laboratory Package</title>
<link href="../../Resources/CSS/mystyle.css" rel="stylesheet" type="text/css" />
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
<?php
include('../../Settings.php');
$cuz = new database();

$pckgno=mysqli_real_escape_string($mycon1,$_GET['pckgno']);
$code=mysqli_real_escape_string($mycon1,$_GET['code']);
$desc=mysqli_real_escape_string($mycon1,$_GET['desc']);
$price=mysqli_real_escape_string($mycon1,$_GET['price']);
$newprice=mysqli_real_escape_string($mycon1,$_GET['newprice']);
$user=mysqli_real_escape_string($mycon1,$_GET['user']);
$autodistro=mysqli_real_escape_string($mycon1,$_GET['autodistro']);
$ph1=mysqli_real_escape_string($mycon1,$_GET['ph1']);
$ph2=mysqli_real_escape_string($mycon1,$_GET['ph2']);
$hmo=mysqli_real_escape_string($mycon1,$_GET['hmo']);
$exc=mysqli_real_escape_string($mycon1,$_GET['exc']);

echo "
<div align='left'>
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='left' class='arial 16 blue bold'>Adding package...</div></td>
    </tr>
  </table>
</div>
";

$pdate=date("YmdHis");

if($newprice!=""){$price=$newprice;}

mysqli_query($mycon1,"INSERT INTO `packagedetails` (`pckgno`, `code`, `description`, `price`, `autodistro`, `ph1`, `ph2`, `hmo`, `exc`) VALUES ('$pckgno', '$code', '$desc', '$price', '$autodistro', '$ph1', '$ph2', '$hmo', '$exc')");

$desc=str_replace(" ","_",$desc);
$desc=str_replace("/","_",$desc);
$hsf = fopen("Logs/AddItems/$pckgno-$desc-$user-$pdate.txt", "w") or die("Unable to open file!");
fwrite($hsf, "INSERT INTO `packagedetails` (`pckgno`, `code`, `description`, `price`, `autodistro`, `ph1`, `ph2`, `hmo`, `exc`) VALUES ('$pckgno', '$code', '$desc', '$price', '$autodistro', '$ph1', '$ph2', '$hmo', '$exc')");
fclose($hsf);

$asql=mysqli_query($mycon1,"SELECT SUM(price) AS totpr FROM packagedetails WHERE pckgno='$pckgno'");
$afetch=mysqli_fetch_array($asql);
$totpr=$afetch['totpr'];

$bsql=mysqli_query($mycon1,"SELECT price FROM packagelist WHERE pckgno='$pckgno'");
$bfetch=mysqli_fetch_array($bsql);
$price=$bfetch['price'];

$disc=$totpr-$price;

mysqli_query($mycon1,"UPDATE packagelist SET discount='$disc' WHERE pckgno='$pckgno'");

echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=Close.php'>";
?>
</body>
</html>
