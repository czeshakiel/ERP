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

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

echo "
<div align='left'>
  <table border='0' cellpadding='0' cellspacing='0' class='hoverTable'>
    <tr>
      <td class='t2 b2 l2'><div align='center' class='arial s11 black bold'>&nbsp;#&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='arial s11 black bold'>&nbsp;Package Name&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='arial s11 black bold'>&nbsp;Included Test&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='arial s11 black bold'>&nbsp;Package Price&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='arial s11 black bold'>&nbsp;&nbsp;</div></td>
      <td class='t2 b2 l1 r2'><div align='center' class='arial s11 black bold'>&nbsp;&nbsp;</div></td>
    </tr>
";

$a=0;
$asql=mysql_query("SELECT * FROM packagelist ORDER BY packagename");
while($afetch=mysql_fetch_array($asql)){
$a++;
$pckgno=$afetch['pckgno'];
$packagename=$afetch['packagename'];
$price=$afetch['price'];

echo "
    <tr>
      <td class='b1 l2' height='25'><div align='left' class='arial s13 black'>&nbsp;$a&nbsp;</div></td>
      <td class='b1 l1'><div align='left' class='arial s13 black'>&nbsp;$packagename&nbsp;</div></td>
      <td class='b1 l1'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td colspan='3' height='5'></td>
        </tr>
";

$b=0;
$bsql=mysql_query("SELECT * FROM packagedetails WHERE pckgno='$pckgno'");
while($bfetch=mysql_fetch_array($bsql)){
$b++;
$no=$bfetch['no'];
$code=$bfetch['code'];
$description=$bfetch['description'];
$bprice=$bfetch['price'];

echo "
        <tr>
          <td><div align='left' class='arial s11 black'>&nbsp;$b.&nbsp;</div></td>
          <td><div align='left' class='arial s11 black'>&nbsp;$description&nbsp;</div></td>
          <td><div align='right' class='arial s11 black'>&nbsp;".number_format($bprice,"2",".",",")."&nbsp;</div></td>
        </tr>
";
}

echo "
        <tr>
          <td colspan='3' height='5'></td>
        </tr>
      </table></td>
      <td class='b1 l1'><div align='right' class='arial s13 black'>&nbsp;".number_format($price,"2",".",",")."&nbsp;</div></td>
      <td class='b1 l1'><div align='center'>&nbsp;<a href='addpack.php?pckgno=$pckgno' target='_blank'><input type='button' class='arial s13 white bold bgblue borderblack' value=' View ' /></a>&nbsp;</div></td>
      <td class='b1 l1 r2'><div align='center'>&nbsp;<a href='rempack.php?pckgno=$pckgno'><input type='button' class='arial s13 white bold bgred borderblack' value='   X   ' /></a>&nbsp;</div></td>
    </tr>
";
}

echo "
    <tr>
      <td colspan='6' height='40' class='t2 b2 l2 r2'><div align='center'><a href='addpack.php' target='_blank' class='astyle'><input type='button' class='arial s16 white bold bgblue borderblack' value='     +     ' /></a></div></td>
    </tr>
  </table>
</div>
";

?>
</body>
</html>
