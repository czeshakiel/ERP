<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Saving...</title>
  <link rel="stylesheet" type="text/css" href="../../Resources/CSS/mystyle.css">
  <!-- Favicon -->
    <link rel="icon" href="../../Resources/Favicon/favicon.png" type="image/png" />
    <link rel="shortcut icon" href="../../Resources/Favicon/favicon.png" type="image/png" />

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
include("../../../main/class.php");

mysqli_query($conn,'SET NAMES utf8');

$caseno=mysqli_real_escape_string($conn,$_POST['caseno']);
$printbatchno=mysqli_real_escape_string($conn,$_POST['printbatchno']);

$username=mysqli_real_escape_string($conn,$_POST['username']);
$password=mysqli_real_escape_string($conn,$_POST['password']);

$asql=mysqli_query($conn,"SELECT * FROM `nsauth` WHERE `username`='$username' AND `password`='$password' AND `station`='LABORATORY'");
$acount=mysqli_num_rows($asql);

if($acount==0){
echo "
<div align='center'>
  <table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; left: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td valign='middle'><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td><div align='center' class='arial s16 red bold'>Verification failed!!! Wrong username or password!!!</div></td>
        </tr>
      </table></div></td>
    </tr>
  </table>
</div>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='5;URL=Verify.php?caseno=$caseno&refno=$refno&testno=$testno'>";
}
else{
  $afetch=mysqli_fetch_array($asql);
  $name=$afetch['name'];

echo "
<div align='center'>
  sdfsd
  <table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; left: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td valign='middle'><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td><div align='center' class='arial s16 blue bold'>Processing...</div></td>
        </tr>
      </table></div></td>
    </tr>
  </table>
</div>
";

  $xsql=mysqli_query($conn,"SELECT `refno` FROM `labresults` WHERE `printbatchno`='$printbatchno'");
  while($xfetch=mysqli_fetch_array($xsql)){
    $refno=$xfetch['refno'];

    $bsql=mysqli_query($conn,"SELECT * FROM `verifier` WHERE `refno`='$refno'");
    $bcount=mysqli_num_rows($bsql);

    $pdate=date("Y-m-d");
    $ptime=date("H:i:s");

    if($bcount==0){
      mysqli_query($conn,"INSERT INTO `verifier` (`refno`, `testno`, `caseno`, `user`, `name`, `date`, `time`) VALUES ('$refno', '$printbatchno', '$caseno', '$username', '$name', '$pdate', '$ptime')");
    }
    else{
      mysqli_query($conn,"UPDATE `verifier` SET `user`='$username', `name`='$name' WHERE `refno`='$refno'");
    }

    mysqli_query($conn,"UPDATE `labpending` SET `verified`='1', `redit`='1' WHERE `refno`='$refno'");
  }

  echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=Close.php'>";
}
?>

</body>
</html>
