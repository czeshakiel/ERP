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
.div-container input[type=text]:focus, .div-container input[type=password]:focus, .div-container select:focus {background-color: #ddd;outline: none;}
.div-container .btn {background-color: #8ebf42;color: #fff;padding: 5px 10px;border: none;cursor: pointer;opacity: 0.8;border-radius: 5px;}
.div-container .cancel {background-color: #cc0000;}
.div-container .tpl {background-color: #821C97;}
.div-container .btn:hover, .open-button:hover {opacity: 1;}

/* Define the hover highlight color for the table row */
.hoverTable tr:hover {background-color: #ffff99;}
</style>
</head>

<body onload="placeFocus()">
<?php
header("Refresh:300");
//ini_set("display_errors","On");
include("../Settings.php");
$cuz = new database();
$setip=$cuz->setIP();

$caseno=mysqli_real_escape_string($mycon1,$_GET['caseno']);

echo "
<div align='left'>
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td colspan='3'><div align='left' style='font-family: Arial;font-weight: bold;color: red;font-size: 20px;'>RE-PRINT</div></td>
    </tr>
    <tr>
      <td colspan='3' height='20'></td>
    </tr>
";


$asql=mysqli_query($mycon1,"SELECT `batchno` FROM `productout` WHERE `caseno`='$caseno' AND batchno LIKE 'CSR2-%%' GROUP BY `batchno`");
while($afetch=mysqli_fetch_array($asql)){
$batchno=$afetch['batchno'];
echo "
    <tr>
      <td><div align='left' style='font-family: Arial;font-weight: bold;'>Batch No.&nbsp;</div></td>
      <td><div align='center' style='font-family: Arial;font-weight: bold;'>&nbsp;:&nbsp;</div></td>
      <td><a href='http://$setip/cgi-bin/printallsup2A.cgi?ticketno=$batchno&amp;caseno=$caseno' class='astyle' target='_blank'><div align='center' style='font-family: Arial;font-weight: bold;color: blue;font-size: 16px;'>$batchno</div></a></td>
    </tr>
    <tr>
      <td colspan='3' height='5'></td>
    </tr>
    <tr>
      <td colspan='3' class='b3'>
        <iframe src='http://$setip/cgi-bin/printallsup2A.cgi?ticketno=$batchno&amp;caseno=$caseno' title='Input Result' style='border: none;' width='400' height='590px'></iframe>
      </td>
    </tr>
    <tr>
      <td colspan='3' height='10'></td>
    </tr>
    
";
}

echo "
  </table>
</div>
";


?>
</body>
</html>
