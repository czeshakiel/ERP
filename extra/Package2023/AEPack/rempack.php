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
$user=mysqli_real_escape_string($mycon1,$_GET['user']);

echo "
<div align='left'>
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='left' class='arial 16 blue bold'>Removing package...</div></td>
    </tr>
  </table>
</div>
";

$asql=mysqli_query($mycon1,"SELECT * FROM `packagelist` WHERE `pckgno`='$pckgno'");
$afetch=mysqli_fetch_array($asql);
$packagename=$afetch['packagename'];

$pdate=date("YmdHis");

mysqli_query($mycon1,"SELECT * FROM `packagelist` WHERE `pckgno`='$pckgno' INTO OUTFILE '/opt/lampp/htdocs/2020codes/Package/AEPack/Logs/Delete/$packagename-$pckgno-$user-$pdate.txt' FIELDS TERMINATED BY '|'");
mysqli_query($mycon1,"DELETE FROM `packagelist` WHERE `pckgno`='$pckgno'");

$bsql=mysqli_query($mycon1,"SELECT * FROM `packagedetails` WHERE `pckgno`='$pckgno'");
while($bfetch=mysqli_fetch_array($bsql)){
  $no=$bfetch['no'];
  $code=$bfetch['code'];
  $description=$bfetch['description'];
  $price=$bfetch['price'];

  mysqli_query($mycon1,"SELECT * FROM `packagedetails` WHERE `no`='$no' INTO OUTFILE '/opt/lampp/htdocs/2020codes/Package/AEPack/Logs/DeleteItems/$packagename-$pckgno-$description-$user-$pdate.txt' FIELDS TERMINATED BY '|'");
}

mysqli_query($mycon1,"DELETE FROM `packagedetails` WHERE `pckgno`='$pckgno'");

echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=../AEPack/?user=$user'>";
?>
</body>
</html>
