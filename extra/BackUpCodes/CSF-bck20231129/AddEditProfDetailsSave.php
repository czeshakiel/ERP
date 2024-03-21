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

$doctor1=mysql_real_escape_string($_POST['doctor1']);
$copay1=mysql_real_escape_string($_POST['copay1']);
$mm1=mysql_real_escape_string($_POST['mm1']);
$dd1=mysql_real_escape_string($_POST['dd1']);
$yy1=mysql_real_escape_string($_POST['yy1']);

if("$yy1-$mm1-$dd1"=="--"){$da1="";}else{$da1="$yy1-$mm1-$dd1";}

$doctor2=mysql_real_escape_string($_POST['doctor2']);
$copay2=mysql_real_escape_string($_POST['copay2']);
$mm2=mysql_real_escape_string($_POST['mm2']);
$dd2=mysql_real_escape_string($_POST['dd2']);
$yy2=mysql_real_escape_string($_POST['yy2']);

if("$yy2-$mm2-$dd2"=="--"){$da2="";}else{$da2="$yy2-$mm2-$dd2";}

$doctor3=mysql_real_escape_string($_POST['doctor3']);
$copay3=mysql_real_escape_string($_POST['copay3']);
$mm3=mysql_real_escape_string($_POST['mm3']);
$dd3=mysql_real_escape_string($_POST['dd3']);
$yy3=mysql_real_escape_string($_POST['yy3']);

if("$yy3-$mm3-$dd3"=="--"){$da3="";}else{$da3="$yy3-$mm3-$dd3";}

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

$asql=mysql_query("SELECT * FROM `claiminfoadd` WHERE `caseno`='$caseno'");
$acount=mysql_num_rows($asql);

$bsql=mysql_query("SELECT `patientidno` FROM `admission` WHERE `caseno`='$caseno'");
$bfetch=mysql_fetch_array($bsql);
$patientidno=$bfetch['patientidno'];

$csql=mysql_query("SELECT name FROM docfile WHERE phicacc='$doctor1'");
$cfetch=mysql_fetch_array($csql);
$doc1=$cfetch['name'];

if($doc1=="REFERRAL"){
  $doc1="";
}

$dsql=mysql_query("SELECT name FROM docfile WHERE phicacc='$doctor2'");
$dfetch=mysql_fetch_array($dsql);
$doc2=$dfetch['name'];

if($doc2=="REFERRAL"){
  $doc2="";
}

$esql=mysql_query("SELECT name FROM docfile WHERE phicacc='$doctor3'");
$efetch=mysql_fetch_array($esql);
$doc3=$efetch['name'];

if($doc3=="REFERRAL"){
  $doc3="";
}

if($acount==0){
  mysql_query("INSERT INTO `claiminfoadd` (`patientidno`, `caseno`, `doctor1`, `datesigned1`, `copay1`, `doctor2`, `datesigned2`, `copay2`, `doctor3`, `datesigned3`, `copay3`) VALUES ('$patientidno', '$caseno', '$doc1', '$da1', '$copay1', '$doc2', '$da2', '$copay2', '$doc3', '$da3', '$copay3')");

  $inlog="$loguser |  ('$patientidno', '$caseno', '$doc1', '$da1', '$copay1', '$doc2', '$da2', '$copay2', '$doc3', '$da3', '$copay3')";
}
else{
    mysql_query("UPDATE `claiminfoadd` SET `doctor1`='$doc1', `datesigned1`='$da1', `copay1`='$copay1', `doctor2`='$doc2', `datesigned2`='$da2', `copay2`='$copay2', `doctor3`='$doc3', `datesigned3`='$da3', `copay3`='$copay3' WHERE `caseno`='$caseno'");

    $inlog="$loguser | `doctor1`='$doc1', `datesigned1`='$da1', `copay1`='$copay1', `doctor2`='$doc2', `datesigned2`='$da2', `copay2`='$copay2', `doctor3`='$doc3', `datesigned3`='$da3', `copay3`='$copay3'";
}

$pdate=date("Ymdhis");
$log = fopen("Logs/PROF-$caseno-$pdate.txt", "w") or die("Unable to open file!");
fwrite($log, $inlog);
fclose($log);

echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=Close.php'>";

?>

</body>
</html>
