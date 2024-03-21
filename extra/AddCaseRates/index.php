<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="../Resources/Favicon/favicon.png" type="image/png" />
<link rel="shortcut icon" href="../Resources/Favicon/favicon.png" type="image/png" />
<title>SEARCH ICD</title>
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

.s1 {font-family: Arial;font-weight: bold;font-size: 11px;}
.s2 {font-family: Arial;font-size: 16px;}
.s3 {font-family: Arial;font-weight: bold;font-size: 14px;color: #000000;}
.s4 {font-family: Arial;font-weight: bold;font-size: 13px;color: #000000;}
.s5 {font-family: Arial;font-size: 13px;color: #0B95F7;}

.red {color: #FF0000;}
.blue {color: #0B95F7;}

.s12 {font-size: 12px;}

.bgwhite {background-color: #FFFFFF;}

.borderwhite {border-color: #000000;border-width: 1px;}

.hoverTable{border-collapse:collapse;}
/*.hoverTable td{padding:0px; border:#4e95f4 1px solid;}*/

/* Define the default color for all the table rows */
/*.hoverTable tr{background: #b8d1f3;}*/

/* Define the hover highlight color for the table row */
.hoverTable tr:hover {background-color: #ffff99;}

.btnstyle .btn {border: 1px solid #000000;width: 26px;height: 26px;border-radius: 8px;font-family: arial;font-size: 14px;font-weight: bold;text-align: center;padding: 0px 0px;}
.btnstyle .rem {background-color: #FF0000;color: #FFFFFF;}
.btnstyle .rem:hover {opacity: 0.4;}
.btnstyle .add {background-color: #FFFFFF;color: #000000;}
.btnstyle .add:hover {opacity: 0.4;}
.btnstyle .view {background-color: #01d0da;color: #FFFFFF;}
.btnstyle .view:hover {opacity: 0.6;}
.btnstyle .dis {background-color: #b4b4b1;color: #e9e9e7;}

.button1 {font-family: Arial;font-size: 14px;font-weight: bold;color: #FFFFFF;background-color: #00DA1D;border: 1px solid #00DA1D;height: 32px;}
.button2 {font-family: Arial;font-size: 14px;font-weight: bold;color: #FFFFFF;background-color: #00DA1D;border: 1px solid #00DA1D;}

.textfield1 {font-family: Arial;font-size: 16px;font-weight: bold;color: #000000;background-color: #ccff99;border: 1px solid #000000;height: 30px;width: 200px;}

.astyle {text-decoration: none;}
-->
</style>

</head>

<body onload="placeFocus()">
<?php
ini_set("display_errors","On");
include("../Settings.php");

$user=mysqli_real_escape_string($mycon1,$_GET['user']);

echo '
<script>
function showResult() {
  if (document.searchme.searchme.value.length==0) {
    document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
    return;
  }
  if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  }
  else {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","caserateres.php?user='.$user.'&searchme="+document.searchme.searchme.value,true);
  xmlhttp.send();
}
</script>
';

echo "
<div align='center'>
  <table border='0' width='100%' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='left' class='arial s12 blue bold'>SEARCH ICD/RVS</div></td>
    </tr>
    <tr>
      <td height='5'></td>
    </tr>
    <tr>
      <form name='searchme' onload='showResult();' method='get' action='../AddCaseRates/'>
      <td><div align='left'><input name='searchme' type='text' autocomplete='off' onKeyUp='showResult();' style='height: 40px;width: 350px;font-family: courier new;font-size: 25px;color: red;border: 2px solid black;padding-left: 5px;padding-right: 5px;border-radius: 10px;' placeholder='SEARCH ICD/RVS CODE'></div></td>
      <input name='user' type='hidden' value='$user' />
      </form>
    </tr>
    <tr>
      <td height='10'></td>
    </tr>
    <tr>
      <td><div id='livesearch' align='left'></div></td>
    </tr>
    <tr>
      <td height='20'></td>
    </tr>
  </table>
</div>
";
?>
</body>
</html>
