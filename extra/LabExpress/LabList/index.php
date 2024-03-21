<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="../../Resources/Favicon/favicon.png" type="image/png" />
<link rel="shortcut icon" href="../../Resources/Favicon/favicon.png" type="image/png" />
<title>LAB TEST LIST</title>
<link href="../../Resources/CSS/mystyle.css" rel="stylesheet" type="text/css" />
<!-- Bootstrap core CSS-->
<link href="../../Resources/assets/css/bootstrap.min.css" rel="stylesheet"/>
<!-- animate CSS-->
<link href="../../Resources/assets/css/animate.css" rel="stylesheet" type="text/css"/>
<!-- Icons CSS-->
<link href="../../Resources/assets/css/icons.css" rel="stylesheet" type="text/css"/>
<!-- Custom Style-->
<!-- link href="assets/css/app-style.css" rel="stylesheet"/ -->
<style style="text/css">
.hoverTable{width:100%;}

.div-container input[type=text], .div-container input[type=password] {width: 450px;height: 30px;padding: 7px;margin: 5px 0 5px 0;border: none;background: #eee;border-radius: 10px;font-size: 18px;font-weight: bold;border: 2px solid #000000;}
.div-container select {height: 40px;padding: 7px;margin: 5px 0 5px 0;border: none;background: #eee;}
.div-container input[type=text]:focus, .div-container input[type=password]:focus, .div-container select:focus {background-color: #ddd;outline: none;}

.btn {background-color: #8ebf42;color: #fff;font-weight: bold;font-size: 12px;padding: 5px 10px;border: none;cursor: pointer;opacity: 0.8;border-radius: 5px;}
.cancel {background-color: #cc0000;}
.tpl {background-color: #821C97;}
.btn:hover, .open-button:hover {opacity: 1;}

.bgunsel{background-color: #02668E;color: #FFFFFF;font-family: arial;font-size: 16px;font-weight: bold;padding: 5px 10px 5px 10px;border-radius: 8px 8px 0 0;opacity: 0.7;border-top: 1px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;}
.bgunsel:hover{opacity: 1;}
.bgsel{background-color: #FF0000;color: #FFFFFF;font-family: arial;font-size: 16px;font-weight: bold;padding: 5px 10px 5px 10px;border-radius: 8px 8px 0 0;opacity: 1;border-top: 1px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;}
.bgsel:hover{opacity: 0.5;}

/* Define the hover highlight color for the table row */
.hoverTable tr:hover {background-color: #ffff99;}
</style>
<script>
function changeTypeInput(inputElement){
 inputElement.type="password"
}
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
</script>
</head>

<body onload='placeFocus()'>
<?php
ini_set("display_errors","On");
include("../../../main/class.php");

$setip=$_SERVER['HTTP_HOST'];

if(isset($_GET['type'])){
  $type=mysqli_real_escape_string($conn,$_GET['type']);
}
else{
  $type="hematology";
}

if($type=="hematology"){$bgs1="bgsel";$bgs2="bgunsel";$bgs3="bgunsel";$bgs4="bgunsel";}
else if($type=="chemistry"){$bgs1="bgunsel";$bgs2="bgsel";$bgs3="bgunsel";$bgs4="bgunsel";}
else if($type=="serology"){$bgs1="bgunsel";$bgs2="bgunsel";$bgs3="bgsel";$bgs4="bgunsel";}
else{$bgs1="bgunsel";$bgs2="bgunsel";$bgs3="bgunsel";$bgs4="bgsel";}


echo "
<div align='left' style='padding: 10px;'>
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td><a href='?type=hematology' style='text-decoration: none;'><div class='$bgs1'>Hematology</div></a></td>
          <td width='1'></td>
          <td><a href='?type=chemistry' style='text-decoration: none;'><div class='$bgs2'>Chemistry</div></a></td>
          <td width='1'></td>
          <td><a href='?type=serology' style='text-decoration: none;'><div class='$bgs3'>Serology</div></a></td>
          <td width='1'></td>
          <td><a href='?type=others' style='text-decoration: none;'><div class='$bgs4'>Others</div></a></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>
        <table border='0' cellpadding='0' cellspacing='0' class='hoverTable'>
          <tr>
            <td class='t2 b2 l2'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;'>#</div></td>
            <td class='t2 b2 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;'>Code</div></td>
            <td class='t2 b2 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;'>Exam Name</div></td>
            <td class='t2 b2 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;'>Type</div></td>
            <td class='t2 b2 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;' title='No of Set Normal Values'>No. of NV Set</div></td>
            <td class='t2 b2 l1 r2'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;'>Action</div></td>
          </tr>
";

$a=0;

if($type=="others"){$asql=mysqli_query($conn,"SELECT * FROM `receiving` WHERE `unit`='LABORATORY' AND `lotno` NOT LIKE '%hematology%' AND `lotno` NOT LIKE '%chemistry%' AND `lotno` NOT LIKE '%serology%' ORDER BY `itemname`");}
else{$asql=mysqli_query($conn,"SELECT * FROM `receiving` WHERE `unit`='LABORATORY' AND `lotno` LIKE '%$type%' ORDER BY `itemname`");}

while($afetch=mysqli_fetch_array($asql)){
  $code=$afetch['code'];
  $itemname=$afetch['itemname'];
  $lotno=$afetch['lotno'];
  $a++;

  if($lotno=="S"){$lotno="";}

  $bsql=mysqli_query($conn,"SELECT * FROM `labnormalvalues` WHERE `code`='$code' AND `stat`='1'");
  $bcount=mysqli_num_rows($bsql);

echo "
          <tr>
            <td class='b1 l2'><div align='left' style='padding: 5px 3px 5px 3px;color: #000000;font-family: arial;font-size: 16px;'>$a</div></td>
            <td class='b1 l1'><div align='left' style='padding: 5px 3px 5px 3px;color: #000000;font-family: arial;font-size: 16px;'>$code</div></td>
            <td class='b1 l1'><div align='left' style='padding: 5px 3px 5px 3px;color: #000000;font-family: arial;font-size: 16px;'>$itemname</div></td>
            <td class='b1 l1'><div align='center' style='padding: 5px 3px 5px 3px;color: #000000;font-family: arial;font-size: 15px;'>".mb_strtoupper($lotno)."</div></td>
            <td class='b1 l1'><div align='center' style='padding: 5px 3px 5px 3px;color: #000000;font-family: arial;font-size: 15px;'>$bcount</div></td>
            <td class='b1 l1 r2'><a href='../NV/?scode=$code&type=$type'><div align='center' style='padding: 5px 3px 5px 3px;color: #000000;'><button class='btn' title='Set Normal Values'>Set NV</button></div></a></td>
          </tr>
";
}

echo "
          <tr>
            <td class='t2' colspan='6'></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</div>
";
?>
</body>
</html>
