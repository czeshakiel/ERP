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

$doctor4=mysql_real_escape_string($_POST['doctor4']);
$copay4=mysql_real_escape_string($_POST['copay4']);
$mm4=mysql_real_escape_string($_POST['mm4']);
$dd4=mysql_real_escape_string($_POST['dd4']);
$yy4=mysql_real_escape_string($_POST['yy4']);

if("$yy4-$mm4-$dd4"=="--"){$da4="";}else{$da4="$yy4-$mm4-$dd4";}

$doctor5=mysql_real_escape_string($_POST['doctor5']);
$copay5=mysql_real_escape_string($_POST['copay5']);
$mm5=mysql_real_escape_string($_POST['mm5']);
$dd5=mysql_real_escape_string($_POST['dd5']);
$yy5=mysql_real_escape_string($_POST['yy5']);

if("$yy5-$mm5-$dd5"=="--"){$da5="";}else{$da5="$yy5-$mm5-$dd5";}

$doctor6=mysql_real_escape_string($_POST['doctor6']);
$copay6=mysql_real_escape_string($_POST['copay6']);
$mm6=mysql_real_escape_string($_POST['mm6']);
$dd6=mysql_real_escape_string($_POST['dd6']);
$yy6=mysql_real_escape_string($_POST['yy6']);

if("$yy6-$mm6-$dd6"=="--"){$da6="";}else{$da6="$yy6-$mm6-$dd6";}

$caseno=mysql_real_escape_string($_POST['caseno']);



echo "
<div align='center'>
    <table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td><div align='center' class='arial s16 blue bold'>Saving changes...</div></td>
      </tr>
</div>
";

session_start();
if(isset($_COOKIE['nameofuser'])){
  $loguser=$_COOKIE['nameofuser'];
}
else{
  $loguser="test";
}

$asql=mysql_query("SELECT * FROM `claiminfoadd2` WHERE `caseno`='$caseno'");
$acount=mysql_num_rows($asql);

//DOCTROR 4----------------------------------------------------------------------------------------------------------------------
$csql=mysql_query("SELECT name FROM docfile WHERE phicacc='$doctor4'");
$cfetch=mysql_fetch_array($csql);
$doc4=$cfetch['name'];

if($doc4=="REFERRAL"){
  $doc4="";
}

$c1sql=mysql_query("SELECT SUM(excess) AS excess FROM productout WHERE caseno='$caseno' AND productdesc='$doc4'");
$c1count=mysql_num_rows($c1sql);
if($c1count=="0"){
  $ex4=0;
}
else{
  $c1fetch=mysql_fetch_array($c1sql);
  $ex4=$c1fetch['excess'];
}
//-------------------------------------------------------------------------------------------------------------------------------

//DOCTROR 5----------------------------------------------------------------------------------------------------------------------
$dsql=mysql_query("SELECT name FROM docfile WHERE phicacc='$doctor5'");
$dfetch=mysql_fetch_array($dsql);
$doc5=$dfetch['name'];

if($doc5=="REFERRAL"){
  $doc5="";
}

$d1sql=mysql_query("SELECT SUM(excess) AS excess FROM productout WHERE caseno='$caseno' AND productdesc='$doc5'");
$d1count=mysql_num_rows($d1sql);
if($d1count=="0"){
  $ex5=0;
}
else{
  $d1fetch=mysql_fetch_array($d1sql);
  $ex5=$d1fetch['excess'];
}
//-------------------------------------------------------------------------------------------------------------------------------

//DOCTROR 6----------------------------------------------------------------------------------------------------------------------
$esql=mysql_query("SELECT name FROM docfile WHERE phicacc='$doctor6'");
$efetch=mysql_fetch_array($esql);
$doc6=$efetch['name'];

if($doc6=="REFERRAL"){
  $doc6="";
}

$e1sql=mysql_query("SELECT SUM(excess) AS excess FROM productout WHERE caseno='$caseno' AND productdesc='$doc6'");
$e1count=mysql_num_rows($e1sql);
if($e1count=="0"){
  $ex6=0;
}
else{
  $e1fetch=mysql_fetch_array($e1sql);
  $ex6=$e1fetch['excess'];
}
//-------------------------------------------------------------------------------------------------------------------------------

if($acount==0){
  mysql_query("INSERT INTO `claiminfoadd2` (`caseno`, `doctor4`, `datesigned4`, `copay4`, `doctor5`, `datesigned5`, `copay5`, `doctor6`, `datesigned6`, `copay6`) VALUES ('$caseno', '$doc4', '$da4', '$ex4', '$doc5', '$da5', '$ex5', '$doc6', '$da6', '$ex6')");

  $inlog="$loguser |  ('$caseno', '$doc4', '$da4', '$ex4', '$doc5', '$da5', '$ex5', '$doc6', '$da6', '$ex6')";
}
else{
    mysql_query("UPDATE `claiminfoadd2` SET `doctor4`='$doc4', `datesigned4`='$da4', `copay4`='$ex4', `doctor5`='$doc5', `datesigned5`='$da5', `copay5`='$ex5', `doctor6`='$doc6', `datesigned6`='$da6', `copay6`='$ex6' WHERE `caseno`='$caseno'");

    $inlog="$loguser | `doctor4`='$doc4', `datesigned4`='$da4', `copay4`='$ex4', `doctor5`='$doc5', `datesigned5`='$da5', `copay5`='$ex5', `doctor6`='$doc6', `datesigned6`='$da6', `copay6`='$ex6'";
}

$pdate=date("Ymdhis");
$log = fopen("Logs/PROF2-$caseno-$pdate.txt", "w") or die("Unable to open file!");
fwrite($log, $inlog);
fclose($log);

echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=Close.php'>";
?>

</body>
</html>
