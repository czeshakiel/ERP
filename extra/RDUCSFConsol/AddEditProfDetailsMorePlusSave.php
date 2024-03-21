<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Saving...</title>
  <link rel="stylesheet" type="text/css" href="CSS/mystyle.css">
  <!-- Favicon -->
  <link rel='icon' href='../../main/assets/favicon/favicon.png' type='image/png' />
  <link rel='shortcut icon' href='../../main/assets/favicon/favicon.png' type='image/png' />

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
include("../../main/connection.php");

mysqli_query($conn,'SET NAMES utf8');

$doctor4=mysqli_real_escape_string($conn,$_POST['doctor4']);
$copay4=mysqli_real_escape_string($conn,$_POST['copay4']);
$mm4=mysqli_real_escape_string($conn,$_POST['mm4']);
$dd4=mysqli_real_escape_string($conn,$_POST['dd4']);
$yy4=mysqli_real_escape_string($conn,$_POST['yy4']);

if("$yy4-$mm4-$dd4"=="--"){$da4="";}else{$da4="$yy4-$mm4-$dd4";}

$doctor5=mysqli_real_escape_string($conn,$_POST['doctor5']);
$copay5=mysqli_real_escape_string($conn,$_POST['copay5']);
$mm5=mysqli_real_escape_string($conn,$_POST['mm5']);
$dd5=mysqli_real_escape_string($conn,$_POST['dd5']);
$yy5=mysqli_real_escape_string($conn,$_POST['yy5']);

if("$yy5-$mm5-$dd5"=="--"){$da5="";}else{$da5="$yy5-$mm5-$dd5";}

$doctor6=mysqli_real_escape_string($conn,$_POST['doctor6']);
$copay6=mysqli_real_escape_string($conn,$_POST['copay6']);
$mm6=mysqli_real_escape_string($conn,$_POST['mm6']);
$dd6=mysqli_real_escape_string($conn,$_POST['dd6']);
$yy6=mysqli_real_escape_string($conn,$_POST['yy6']);

if("$yy6-$mm6-$dd6"=="--"){$da6="";}else{$da6="$yy6-$mm6-$dd6";}

$caseno=mysqli_real_escape_string($conn,$_POST['caseno']);

echo "
<div align='center'>
    <table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td><div align='center' class='arial s16 blue bold'>Saving changes...</div></td>
      </tr>
</div>
";

$loguser=base64_decode($_SESSION['nm']);

$asql=mysqli_query($conn,"SELECT * FROM `claiminfoadd2` WHERE `caseno`='$caseno'");
$acount=mysqli_num_rows($asql);

//DOCTROR 4----------------------------------------------------------------------------------------------------------------------
$csql=mysqli_query($conn,"SELECT name FROM docfile WHERE phicacc='$doctor4'");
$cfetch=mysqli_fetch_array($csql);
$doc4=$cfetch['name'];

if($doc4=="REFERRAL"){
  $doc4="";
}

$c1sql=mysqli_query($conn,"SELECT SUM(excess) AS excess FROM productout WHERE caseno='$caseno' AND productdesc='$doc4'");
$c1count=mysqli_num_rows($c1sql);
if($c1count=="0"){
  $ex4=0;
}
else{
  $c1fetch=mysqli_fetch_array($c1sql);
  $ex4=$c1fetch['excess'];
}
//-------------------------------------------------------------------------------------------------------------------------------

//DOCTROR 5----------------------------------------------------------------------------------------------------------------------
$dsql=mysqli_query($conn,"SELECT name FROM docfile WHERE phicacc='$doctor5'");
$dfetch=mysqli_fetch_array($dsql);
$doc5=$dfetch['name'];

if($doc5=="REFERRAL"){
  $doc5="";
}

$d1sql=mysqli_query($conn,"SELECT SUM(excess) AS excess FROM productout WHERE caseno='$caseno' AND productdesc='$doc5'");
$d1count=mysqli_num_rows($d1sql);
if($d1count=="0"){
  $ex5=0;
}
else{
  $d1fetch=mysqli_fetch_array($d1sql);
  $ex5=$d1fetch['excess'];
}
//-------------------------------------------------------------------------------------------------------------------------------

//DOCTROR 6----------------------------------------------------------------------------------------------------------------------
$esql=mysqli_query($conn,"SELECT name FROM docfile WHERE phicacc='$doctor6'");
$efetch=mysqli_fetch_array($esql);
$doc6=$efetch['name'];

if($doc6=="REFERRAL"){
  $doc6="";
}

$e1sql=mysqli_query($conn,"SELECT SUM(excess) AS excess FROM productout WHERE caseno='$caseno' AND productdesc='$doc6'");
$e1count=mysqli_num_rows($e1sql);
if($e1count=="0"){
  $ex6=0;
}
else{
  $e1fetch=mysqli_fetch_array($e1sql);
  $ex6=$e1fetch['excess'];
}
//-------------------------------------------------------------------------------------------------------------------------------

if($acount==0){
  mysqli_query($conn,"INSERT INTO `claiminfoadd2` (`caseno`, `doctor7`, `datesigned7`, `copay7`, `doctor8`, `datesigned8`, `copay8`, `doctor9`, `datesigned9`, `copay9`) VALUES ('$caseno', '$doc4', '$da4', '$ex4', '$doc5', '$da5', '$ex5', '$doc6', '$da6', '$ex6')");

  $inlog="$loguser |  ('$caseno', '$doc4', '$da4', '$ex4', '$doc5', '$da5', '$ex5', '$doc6', '$da6', '$ex6')";
}
else{
    mysqli_query($conn,"UPDATE `claiminfoadd2` SET `doctor7`='$doc4', `datesigned7`='$da4', `copay7`='$ex4', `doctor8`='$doc5', `datesigned8`='$da5', `copay8`='$ex5', `doctor9`='$doc6', `datesigned9`='$da6', `copay9`='$ex6' WHERE `caseno`='$caseno'");

    $inlog="$loguser | `doctor7`='$doc4', `datesigned7`='$da4', `copay7`='$ex4', `doctor8`='$doc5', `datesigned8`='$da5', `copay8`='$ex5', `doctor9`='$doc6', `datesigned9`='$da6', `copay9`='$ex6'";
}

$pdate=date("Ymdhis");
$log = fopen("Logs/PROF3-$caseno-$pdate.txt", "w") or die("Unable to open file!");
fwrite($log, $inlog);
fclose($log);

echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=Close.php'>";
?>

</body>
</html>
