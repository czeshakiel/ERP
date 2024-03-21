<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Saving...</title>
  <link rel="stylesheet" type="text/css" href="../../2021codes/Resources/CSS/mystyle.css">
  <!-- Favicon -->
    <link rel="icon" href="../../2021codes/Resources/Favicon/favicon.png" type="image/png" />
    <link rel="shortcut icon" href="../../2021codes/Resources/Favicon/favicon.png" type="image/png" />

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
include('../extra/Settings.php');

mysqli_query($mycon1,'SET NAMES utf8');

$pin=mysqli_real_escape_string($mycon1,$_POST['pin']);
$patname=mysqli_real_escape_string($mycon1,$_POST['patname']);
$memname=mysqli_real_escape_string($mycon1,$_POST['memname']);
$mtype=mysqli_real_escape_string($mycon1,$_POST['mtype']);
$age=mysqli_real_escape_string($mycon1,$_POST['age']);
$sex=mysqli_real_escape_string($mycon1,$_POST['sex']);
$dateadmit=mysqli_real_escape_string($mycon1,$_POST['dateadmit']);
$datedischarged=mysqli_real_escape_string($mycon1,$_POST['datedischarged']);
$finaldiagnosis=mysqli_real_escape_string($mycon1,$_POST['finaldiagnosis']);
$roomandboard=mysqli_real_escape_string($mycon1,$_POST['roomandboard']);
$labothers=mysqli_real_escape_string($mycon1,$_POST['labothers']);
$meds=mysqli_real_escape_string($mycon1,$_POST['meds']);
$or=mysqli_real_escape_string($mycon1,$_POST['or']);
$pf=mysqli_real_escape_string($mycon1,$_POST['pf']);
$dt=mysqli_real_escape_string($mycon1,$_POST['dt']);
$user=mysqli_real_escape_string($mycon1,$_POST['user']);
$caseno=mysqli_real_escape_string($mycon1,$_POST['caseno']);

echo "
<div align='center'>
    <table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td><div align='center' class='arial s16 blue bold'>Saving changes...</div></td>
      </tr>
</div>
";

mysqli_query($mycon1,"INSERT INTO `translist` (`caseno`, `claimnumber`, `pin`, `membername`, `patientname`, `mtype`, `age`, `sex`, `dateadmitted`, `datedischarged`, `finaldiagnosis`, `roomandboard`, `labothers`, `meds`, `or`, `pf`, `datetransmitted`, `status`, `dateadded`, `user`) VALUES ('$caseno', '', '$pin', '$memname', '$patname', '$mtype', '$age', '$sex', '$dateadmit', '$datedischarged', '$finaldiagnosis', '$roomandboard', '$labothers', '$meds', '$or', '$pf', '$dt', 'Pending', '".date("Y-m-d H:i:s")."', '$user')");

mysqli_query($mycon1,"UPDATE `dischargedtable` SET `count`='9' WHERE `caseno`='$caseno'");

echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=Close.php'>";

?>

</body>
</html>
