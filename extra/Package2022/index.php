<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PACKAGE LIST</title>
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
<style type="text/css">
<!--
.t1 {border-top-width: 1px;border-top-color: #000000;border-top-style: solid;}
.b1 {border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;}
.l1 {border-left-width: 1px;border-left-color: #000000;border-left-style: solid;}
.r1 {border-right-width: 1px;border-right-color: #000000;border-right-style: solid;}

.t2 {border-top-width: 2px;border-top-color: #000000;border-top-style: solid;}
.b2 {border-bottom-width: 2px;border-bottom-color: #000000;border-bottom-style: solid;}
.l2 {border-left-width: 2px;border-left-color: #000000;border-left-style: solid;}
.r2 {border-right-width: 2px;border-right-color: #000000;border-right-style: solid;}

.hoverTable{border-collapse:collapse;}
.hoverTable tr:hover {background-color: #ffff99;}
.button1 {font-family: Arial;font-size: 14px;font-weight: bold;color: #FFFFFF;background-color: #00DA1D;border: 1px solid #00DA1D;}
.astyle {text-decoration: none;}
-->
</style>
</head>

<body onload="placeFocus()">
<?php
ini_set("display_errors","On");
include("../Settings.php");
$cuz = new database();

if(isset($_POST['caseno'])){$caseno=mysqli_real_escape_string($mycon1,$_POST['caseno']);}else{$caseno=mysqli_real_escape_string($mycon1,$_GET['caseno']);}
if(isset($_POST['dept'])){$dept=mysqli_real_escape_string($mycon1,$_POST['dept']);}else{$dept=mysqli_real_escape_string($mycon1,$_GET['dept']);}
if(isset($_POST['ticket'])){$ticket=mysqli_real_escape_string($mycon1,$_POST['ticket']);}else{$ticket=mysqli_real_escape_string($mycon1,$_GET['ticket']);}
if(isset($_POST['station'])){$station=mysqli_real_escape_string($mycon1,$_POST['station']);}else{$station=mysqli_real_escape_string($mycon1,$_GET['station']);}

if((!isset($_COOKIE["ccpass"]))||(!isset($_COOKIE["ccname"]))||(!isset($_COOKIE["ccacce"]))){
  if(isset($_SESSION['ccpass'])){setcookie("ccpass", $_SESSION['ccpass'], time() + 600, "/");}
  if(isset($_SESSION['ccname'])){setcookie("ccname", $_SESSION['ccname'], time() + 600, "/");}
  if(isset($_SESSION['ccacce'])){setcookie("ccacce", $_SESSION['ccacce'], time() + 600, "/");}

  echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=../Package2023/?caseno=$caseno&station=$station&dept=PACKAGE&ticket=$ticket'>";
}

if((isset($_COOKIE["ccpass"]))&&($_COOKIE["ccname"])&&($_COOKIE["ccacce"])){
  $ccpass=$_COOKIE["ccpass"];
  $ccname=$_COOKIE["ccname"];
  $ccacce=$_COOKIE["ccacce"];

  setcookie("ccpass", $ccpass, time() + 600, "/");
  setcookie("ccname", $ccname, time() + 600, "/");
  setcookie("ccacce", $ccacce, time() + 600, "/");
}
else{
  $ccpass="";
  $ccname="";
  $ccacce="";
}

if(isset($_POST['caseno'])){$caseno=mysqli_real_escape_string($mycon1,$_POST['caseno']);}else{$caseno=mysqli_real_escape_string($mycon1,$_GET['caseno']);}
if(isset($_POST['dept'])){$dept=mysqli_real_escape_string($mycon1,$_POST['dept']);}else{$dept=mysqli_real_escape_string($mycon1,$_GET['dept']);}
if(isset($_POST['ticket'])){$ticket=mysqli_real_escape_string($mycon1,$_POST['ticket']);}else{$ticket=mysqli_real_escape_string($mycon1,$_GET['ticket']);}
if(isset($_POST['station'])){$station=mysqli_real_escape_string($mycon1,$_POST['station']);}else{$station=mysqli_real_escape_string($mycon1,$_GET['station']);}

if(isset($_POST['user'])){$frm=1;$nursename=mysqli_real_escape_string($mycon1,$_POST['user']);}else{$frm=2;$nursename=$ccname;}
if(isset($_POST['enterpassword'])){$ipass=mysqli_real_escape_string($mycon1,$_POST['enterpassword']);}else{$ipass=$ccpass;}

$asql=mysqli_query($mycon1,"SELECT * FROM `nsauth` WHERE `password`='$ipass'");
$acount=mysqli_num_rows($asql);

if($acount==0){
echo "
<div align='left' class='arial16redbold'>WRONG AUTHENTICATION!!!</div>
";
}
else{
$afetch=mysqli_fetch_array($asql);
$nm=$afetch['name'];

echo "
<div align='left' style='font-family: arial;font-weight: bold;color: #0091C7;font-size: 18px;padding-left: 10px;'>PACKAGE LIST</div>
<br />
<div align='left' style='padding-left: 10px;'>
  <table border='0' cellpadding='0' cellspacing='0' class='hoverTable'>
    <tr>
      <td class='t2 b2 l2' width='auto'><div align='center' style='font-family: arial;font-weight: bold;color: #0091C7;font-size: 16px;padding: 2px 5px 2px 5px;'>PACKAGE</div></td>
      <td class='t2 b2 l1' width='120'><div align='center' style='font-family: arial;font-weight: bold;color: #0091C7;font-size: 16px;padding: 2px 5px 2px 5px;'>PRICE</div></td>
      <td class='t2 b2 l1 r2' width='100'><div align='center' style='font-family: arial;font-weight: bold;color: #0091C7;font-size: 16px;padding: 2px 5px 2px 5px;'></div></td>
    </tr>
";

if($station!="RDU"){
$bsql=mysqli_query($mycon1,"SELECT * FROM `packagelist` WHERE `dept` LIKE 'ENDCOL' ORDER BY `packagename`");
while($bfetch=mysqli_fetch_array($bsql)){
$pno=$bfetch['pckgno'];
$pn=$bfetch['packagename'];
$pr=$bfetch['price'];
$discount=$bfetch['discount'];

echo "
    <tr>
      <td class='b1 l2' height='40'><div align='left' style='font-family: arial;color: #000000;font-size: 15px;padding: 2px 5px 2px 5px;'>&nbsp;$pn&nbsp;</div></td>
      <td class='b1 l1' height='40'><div align='right' style='font-family: arial;color: #000000;font-size: 15px;padding: 2px 5px 2px 5px;'>&nbsp;".number_format($pr,2,'.',',')."&nbsp;</div></td>
      <td class='b1 l1 r2' height='40'><div align='center' style='font-family: arial;color: #000000;font-size: 15px;padding: 2px 5px 2px 5px;'>
        <form name='View' method='post' action='vp.php'>
          <input type='submit' name='View' style='background-color: #FF5733;color: #FFFFFF;font-weight: bold;border: 1px solid black;padding: 3px 8px 3px 8px;border-radius: 4px;'";?> onclick="return confirm('Add Package?');" <?php echo " title='Add Package' value='  +  ' />
          <input type='hidden' name='caseno' value='$caseno' />
          <input type='hidden' name='dept' value='$dept' />
          <input type='hidden' name='ipass' value='$ipass' />
          <input type='hidden' name='user' value='$nm' />
          <input type='hidden' name='ticket' value='$ticket' />
          <input type='hidden' name='pckgno' value='$pno' />
          <input type='hidden' name='pn' value='$pn' />
          <input type='hidden' name='dis' value='$discount' />
          <input type='hidden' name='prc' value='$pr' />
          <input type='hidden' name='frm' value='$frm' />
          <input type='hidden' name='station' value='$station' />
        </form>
      </div></td>
    </tr>
";
}
}
else if($station=="RDU"){
$bsql=mysqli_query($mycon1,"SELECT * FROM `packagelist` WHERE `dept`='RDU' and `pckgno` NOT LIKE 'PCKG-20210222035829' ORDER BY `packagename`");
while($bfetch=mysqli_fetch_array($bsql)){
$pno=$bfetch['pckgno'];
$pn=$bfetch['packagename'];
$pr=$bfetch['price'];
$discount=$bfetch['discount'];

echo "
    <tr>
      <td class='b1 l1' height='40'><div align='left' style='font-family: arial;color: #000000;font-size: 15px;padding: 2px 5px 2px 5px;'>&nbsp;$pn&nbsp;</div></td>
      <td class='b1' height='40'><div align='right' style='font-family: arial;color: #000000;font-size: 15px;padding: 2px 5px 2px 5px;'>&nbsp;".number_format($pr,2,'.',',')."&nbsp;</div></td>
      <td class='b1 r1' height='40'><div align='center' style='font-family: arial;color: #000000;font-size: 15px;padding: 2px 5px 2px 5px;'>
        <form name='View' method='post' action='vp.php'>
          <input type='submit' name='View' value='View' />
          <input type='hidden' name='caseno' value='$caseno' />
          <input type='hidden' name='dept' value='$dept' />
          <input type='hidden' name='ipass' value='$ipass' />
          <input type='hidden' name='user' value='$nm' />
          <input type='hidden' name='ticket' value='$ticket' />
          <input type='hidden' name='pckgno' value='$pno' />
          <input type='hidden' name='pn' value='$pn' />
          <input type='hidden' name='dis' value='$discount' />
          <input type='hidden' name='prc' value='$pr' />
          <input type='hidden' name='frm' value='$frm' />
          <input type='hidden' name='station' value='$station' />
        </form>
      </div></td>
    </tr>
";
}
}


echo "
    <tr>
      <td colspan='3' class='b1'></td>
    </tr>
  </table>
</div>
";
}

?>
</body>
</html>
