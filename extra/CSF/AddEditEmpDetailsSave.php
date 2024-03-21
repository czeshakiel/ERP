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
include("../../main/class2.php");

mysqli_query($conn,'SET NAMES utf8');

$caseno=mysqli_real_escape_string($conn,$_POST['caseno']);
$type=mysqli_real_escape_string($conn,$_POST['type']);
$show=mysqli_real_escape_string($conn,$_POST['show']);

echo "
<div align='center'>
    <table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td><div align='center' class='arial s16 blue bold'>Saving changes...</div></td>
      </tr>
</div>
";

$loguser=base64_decode($_SESSION['nm']);

if($show=="on"){
  $emppen=mysqli_real_escape_string($conn,$_POST['emppen']);
  $empbusinessname=strtoupper(trim(mysqli_real_escape_string($conn,$_POST['empbusinessname'])));
  $empcontactno=strtoupper(trim(mysqli_real_escape_string($conn,$_POST['empcontactno'])));
  $empname=strtoupper(trim(mysqli_real_escape_string($conn,$_POST['empname'])));
  $empsigdesignation=strtoupper(trim(mysqli_real_escape_string($conn,$_POST['empsigdesignation'])));
  $mm=mysqli_real_escape_string($conn,$_POST['mm']);
  $dd=mysqli_real_escape_string($conn,$_POST['dd']);
  $yy=mysqli_real_escape_string($conn,$_POST['yy']);

  if("$yy-$mm-$dd"=="--"){
    $da="";
  }
  else{
    $da=date("M-d-Y",strtotime("$yy-$mm-$dd"));
  }

  $asql=mysqli_query($conn,"SELECT * FROM `claiminfomoreinfo` WHERE `caseno`='$caseno'");
  $acount=mysqli_num_rows($asql);

  if($acount==0){
    mysqli_query($conn,"INSERT INTO `claiminfomoreinfo` (`caseno`, `emppen`, `empbusinessname`, `empname`, `empcontactno`, `empsigdesignation`, `empdatesigned`) VALUES ('$caseno', '$emppen', '$empbusinessname', '$empname', '$empcontactno', '$empsigdesignation', '$da')");

    $inlog="$loguser | (`caseno`, `emppen`, `empbusinessname`, `empname`, `empcontactno`, `empsigdesignation`, `empdatesigned`) VALUES ('$caseno', '$emppen', '$empbusinessname', '$empname', '$empcontactno', '$empsigdesignation', '$da') | $type";
  }
  else{
    mysqli_query($conn,"UPDATE `claiminfomoreinfo` SET `emppen`='$emppen', `empbusinessname`='$empbusinessname', `empname`='$empname', `empcontactno`='$empcontactno', `empsigdesignation`='$empsigdesignation', `empdatesigned`='$da' WHERE `caseno`='$caseno'");

    $inlog="$loguser | `emppen`='$emppen', `empbusinessname`='$empbusinessname', `empname`='$empname', `empcontactno`='$empcontactno', `empsigdesignation`='$empsigdesignation', `empdatesigned`='$da' | UPDATE `admission` SET `type`='$type' WHERE `caseno`='$caseno'";
  }

  mysqli_query($conn,"UPDATE `admission` SET `type`='$type' WHERE `caseno`='$caseno'");

}
else{
  $asql=mysqli_query($conn,"SELECT * FROM `claiminfomoreinfo` WHERE `caseno`='$caseno'");
  $acount=mysqli_num_rows($asql);

  if($acount!=0){
    mysqli_query($conn,"UPDATE `claiminfomoreinfo` SET `emppen`='', `empbusinessname`='', `empname`='', `empcontactno`='', `empsigdesignation`='', `empdatesigned`='' WHERE `caseno`='$caseno'");
  }

  mysqli_query($conn,"UPDATE `admission` SET `type`='$type' WHERE `caseno`='$caseno'");

  $inlog="$loguser | $type";
}

$pdate=date("Ymdhis");
$log = fopen("Logs/EMP-$caseno-$pdate.txt", "w") or die("Unable to open file!");
fwrite($log, $inlog);
fclose($log);

echo "<META HTTP-EQUIV='Refresh'CONTENT='1;URL=Close.php'>";
?>

</body>
</html>
