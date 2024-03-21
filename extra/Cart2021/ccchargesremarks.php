<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="Resources/Favicon/favicon.png" type="image/png" />
<link rel="shortcut icon" href="Resources/Favicon/favicon.png" type="image/png" />
<title>SEARCH CHARGES</title>
<link href="../Resources/CSS/mystyle.css" rel="stylesheet" type="text/css" />
<style style="text/css">
.hoverTable{width:100%; border-collapse:collapse;}
.hoverTable td{padding:7px; border:#4e95f4 1px solid;}

.div-container input[type=text], .div-container input[type=password] {width: 450px;height: 30px;padding: 7px;margin: 5px 0 5px 0;border: none;background: #eee;border-radius: 10px;font-size: 18px;font-weight: bold;border: 2px solid #000000;}
.div-container select {height: 40px;padding: 7px;margin: 5px 0 5px 0;border: none;background: #eee;}
.div-container textarea {width: 450px;height: 100px;padding: 7px;margin: 5px 0 5px 0;border: none;background: #eee;border-radius: 10px;font-size: 18px;font-weight: bold;border: 2px solid #000000;}
.div-container input[type=text]:focus, .div-container input[type=password]:focus, .div-container select:focus {background-color: #ddd;outline: none;}
.div-container .btn {background-color: #8ebf42;color: #fff;padding: 10px 10px;border: none;cursor: pointer;opacity: 0.8;border-radius: 5px;font-size: 18px;}
.div-container .cancel {background-color: #cc0000;}
.div-container .btn:hover, .open-button:hover {opacity: 1;}

/* Define the hover highlight color for the table row */
.hoverTable tr:hover {background-color: #ffff99;}
</style>
</head>

<body onload="placeFocus()">
<?php
ini_set("display_errors","On");
include("../Settings.php");
$cuz = new database();
$setip=$cuz->setIP();

$caseno=mysqli_real_escape_string($mycon1,$_GET['caseno']);
$station=mysqli_real_escape_string($mycon1,$_GET['station']);
$toh=mysqli_real_escape_string($mycon1,$_GET['toh']);
$tick=mysqli_real_escape_string($mycon1,$_GET['tick']);
$code=mysqli_real_escape_string($mycon1,$_GET['code']);
$unit=mysqli_real_escape_string($mycon1,$_GET['unit']);
$trantype=mysqli_real_escape_string($mycon1,$_GET['trantype']);
$qty=mysqli_real_escape_string($mycon1,$_GET['qty']);

$asql=mysqli_query($mycon1,"SELECT itemname FROM receiving WHERE code='$code'");
$afetch=mysqli_fetch_array($asql);
$desc=$afetch['itemname'];

if (!isset($_COOKIE["ccpass"])){
header("location: ../ChargeCart/?caseno=$caseno&station=$station&toh=$toh");
}
else{
$ccpass=$_COOKIE["ccpass"];
$ccname=$_COOKIE["ccname"];

setcookie("ccpass", $ccpass, time() + 300, "/");
setcookie("ccname", $ccname, time() + 300, "/");

echo '
<script type="text/JavaScript">
<!--
function placeFocus() {
if (document.forms.length > 0) {
var field = document.forms[0];
for (i = 0; i < field.length; i++) {
if ((field.elements[i].type == "textarea") || (field.elements[i].type.toString().charAt(0) == "s")) {
document.forms[0].elements[i].focus();
break;
         }
      }
   }
}
//-->
</script>
';



echo "
<div align='left'>
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td><input type='button' onclick=MM_openBrWindow('http://$setip/2011codes/nsprintps.php?ticketno=$tick&amp;caseno=$caseno','','toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes,width=800,height=800') value='CHARGE SLIP NO. $tick' /></td>
          <td><input type='button' onclick=MM_openBrWindow('http://$setip/cgi-bin/nsprintps1.cgi?ticketno=$tick&amp;caseno=$caseno','','toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes,width=800,height=800') value='STANDARD CHARGE SLIP NO. $tick' /></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height='10'><div align='left' class='arial s14 blue bold'>".$_COOKIE["ccname"]."</div></td>
    </tr>
    <tr>
      <td><div align='left'>
        <form name='submit' class='div-container' method='get' action='poscharges.php'>
          <table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><input name='searchme' type='text' autocomplete='off' value='$desc' size='30' ></td>
            </tr>
            <tr>
              <td><textarea name='remarks' placeholder='Type remarks here...'></textarea></td>
            </tr>
            <tr>
              <td><div align='right'><button type='submit' class='btn'>&nbsp;Submit&nbsp;</button></div></td>
            </tr>
          </table>
        <input type='hidden' name='caseno' value='$caseno' />
        <input type='hidden' name='station' value='$station' />
        <input type='hidden' name='toh' value='$toh' />
        <input type='hidden' name='tick' value='$tick' />
        <input type='hidden' name='code' value='$code' />
        <input type='hidden' name='unit' value='$unit' />
        <input type='hidden' name='trantype' value='$trantype' />
        <input type='hidden' name='qty' value='$qty' />
        </form>
      </div></td>
    </tr>
    <tr>
      <td height='10'></td>
    </tr>
    <tr>
      <td><div id='livesearch' align='left'></div></td>
    </tr>
  </table>
</div>
";
}

?>
</body>
</html>
