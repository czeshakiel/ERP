<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Saving...</title>
  <link rel="stylesheet" type="text/css" href="CSS/mystyle.css">
  <!-- Favicon -->
    <link rel="icon" href="../../rs/favicon/logo.png" type="image/png" />
    <link rel="shortcut icon" href="../../rs/favicon/logo.png" type="image/png" />

    <style>
      * {
      box-sizing: border-box;
      }
      body {
      font-family: Roboto, Helvetica, sans-serif;
      background-color: #E8E4C9;
      }
      /* Fix the button on the left side of the page */
      .open-btn {
      display: flex;
      justify-content: left;
      }
      /* Style and fix the button on the page */
      .open-button {
      background-color: #1c87c9;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      opacity: 0.8;
      position: fixed;
      }
      /* Styles for the form container */
      .form-container-Edit {
      max-width: 500px;
      padding: 15px;
      background-color: #E8E4C9;
      }
      /* Full-width for input fields */
      .form-container-Edit input[type=text], .form-container-Edit input[type=password], .form-container-Edit select {
      width: 250px;
      height: 40px;
      padding: 7px;
      margin: 5px 0 5px 0;
      border: none;
      background: #eee;
      }
      /* Select fields */
      .form-container-Edit select {
      padding: 10px;
      margin: 5px 0 10px 0;
      border: none;
      background: #eee;
      }
      /* When the inputs get focus, do something */
      .form-container-Edit input[type=text]:focus, .form-container-Edit input[type=password]:focus, .form-container-Edit select:focus {
      background-color: #ddd;
      outline: none;
      }
      /* Style submit/login button */
      .form-container-Edit .btn {
      background-color: #8ebf42;
      color: #fff;
      padding: 12px 20px;
      border: none;
      cursor: pointer;
      margin-bottom:10px;
      opacity: 0.8;
      }
      /* Style cancel button */
      .form-container-Edit .cancel {
      background-color: #cc0000;
      }
      /* Hover effects for buttons */
      .form-container-Edit .btn:hover, .open-button:hover {
      opacity: 1;
      }
    </style>
  </head>
<body>
<?php
ini_set("display_errors", "On");
include('../Settings.php');
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

mysql_query('SET NAMES utf8');

$mm=mysql_real_escape_string($_POST['mm']);
$dd=mysql_real_escape_string($_POST['dd']);
$yy=mysql_real_escape_string($_POST['yy']);
$hh=mysql_real_escape_string($_POST['hh']);
$ii=mysql_real_escape_string($_POST['ii']);
$ss=mysql_real_escape_string($_POST['ss']);
$aa=mysql_real_escape_string($_POST['aa']);
$caseno=mysql_real_escape_string($_POST['caseno']);
$type=mysql_real_escape_string($_POST['type']);

if("$yy-$mm-$dd"=="--"){
  $da="";
}
else{
  $da=date("M-d-Y",strtotime("$yy-$mm-$dd"));
}

if($hh!=""){
  $ta="$hh:$ii:$ss $aa";
}
else{
  $ta="";
}

echo "
<div align='center'>
    <table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td><div align='center' class='arial s16 blue bold'>Saving changes...</div></td>
      </tr>
</div>
";

session_start();
$loguser=$_COOKIE['nameofuser'];

if($type=="1"){
mysql_query("UPDATE `dischargedtable` SET `datedischarged`='$da', `timedischarged`='$ta', `datearray`='$yy-$mm-$dd' WHERE caseno='$caseno'");
$inlog="$loguser | `datedischarged`='$da', `timedischarged`='$ta', `datearray`='$yy-$mm-$dd'";
}
else if($type=="2"){
  $asql=mysql_query("SELECT * FROM `tempdatestorage` WHERE `caseno`='$caseno'");
  $acount=mysql_num_rows($asql);
  
  if($acount==0){
    mysql_query("INSERT INTO `tempdatestorage` (`caseno`, `date`, `time`) VALUES ('$caseno', '$da', '$ta')");
  }
  else{
    mysql_query("UPDATE `tempdatestorage` SET `date`='$da', `time`='$ta' WHERE `caseno`='$caseno'");
  }

$inlog="$loguser | `date`='$da', `time`='$ta'";
}

$pdate=date("Ymdhis");
$log = fopen("Logs/DATD-$caseno-$pdate.txt", "w") or die("Unable to open file!");
fwrite($log, $inlog);
fclose($log);

echo "<META HTTP-EQUIV='Refresh'CONTENT='1;URL=Close.php'>";

?>

</body>
</html>
