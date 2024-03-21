<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Saving...</title>
  <link rel="stylesheet" type="text/css" href="../Resources/CSS/mystyle.css">
  <!-- Favicon -->
    <link rel="icon" href="../Resources/Favicon/logo.png" type="image/png" />
    <link rel="shortcut icon" href="../Resources/Favicon/logo.png" type="image/png" />

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
$cuz = new database();

$caseno=mysqli_real_escape_string($conn,$_POST['caseno']);
$name=mysqli_real_escape_string($conn,$_POST['name']);
$room=mysqli_real_escape_string($conn,$_POST['room']);
$datearray=mysqli_real_escape_string($conn,$_POST['datearray']);
$qty=mysqli_real_escape_string($conn,$_POST['qty']);

$pdate=date("YmdHis");

echo "
<div align='center'>
     <table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; left: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td><div align='center' class='arial s18 blue bold'>Room added...</div></td>
      </tr>
</div>
";

$asql=mysqli_query($conn,"SELECT * FROM `room` WHERE `room`='$room'");
$afetch=mysqli_fetch_array($asql);
$roomrates=$afetch['roomrates'];

$bsql=mysqli_query($conn,"SELECT p.`senior` FROM `admission` a, `patientprofile` p WHERE a.`caseno`='$caseno' AND a.`patientidno`=p.`patientidno`");
$bfetch=mysqli_fetch_array($bsql);
$senior=$bfetch['senior'];

$rnd=strtoupper(substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 3));
$refno="RM".date("YmdHis").$rnd;

$time=date('H:i:s');
$dat=date('M-d-Y');
$datenow=date('Y-m-d');

if($senior=="Y"){
  $adj=($roomrates*$qty)*0.20;
  $gross=($roomrates*$qty)-$adj;
}
else{
  $adj=0;
  $gross=($roomrates*$qty);
}

mysqli_query($conn,"SET NAMES 'utf8'");
  $sqlInsertRoom=mysqli_query($conn,"INSERT INTO `productout` (`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`, `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`, `cdisc`, `scpwd`) VALUES('$refno', '$time', '$caseno', '$room', '$room', '$roomrates', '$qty', '$adj', '$gross', 'charge', '0.00', '0.00', '$gross', '$dat', 'Approved', '', '', '', '', 'ROOM ACCOMODATION', '', '$name', '', 'KMSCI', 'BILLING', '$datearray', '0.00', '$adj', '$senior')");

echo "<META HTTP-EQUIV='Refresh'CONTENT='1;URL=Close.php'>";

?>

</body>
</html>
