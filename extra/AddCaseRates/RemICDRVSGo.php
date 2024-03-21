<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Removing...</title>
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
include('../Settings.php');
$cuz = new database();

$caseno=mysqli_real_escape_string($mycon1,$_POST['caseno']);
$autono=mysqli_real_escape_string($mycon1,$_POST['autono']);
$user=base64_decode(mysqli_real_escape_string($mycon1,$_POST['user']));

$asql=mysqli_query($mycon1,"SELECT `icdcode` FROM `finalcaserate` WHERE `autono`='$autono'");
$afetch=mysqli_fetch_array($asql);
$icdcode=$afetch['icdcode'];

if(!is_dir("Logs/Delete/$caseno")){
mkdir("Logs/Delete/$caseno", 0777, true);
exec("chmod 777 Logs/Delete/$caseno/");
}

$pdate=date("YmdHis");

mysqli_query($mycon1,"SELECT * FROM finalcaserate WHERE autono='$autono' INTO OUTFILE '/opt/lampp/htdocs/2021codes/CaseRates/Logs/Delete/$caseno/$icdcode-$autono-$user-$pdate.txt' FIELDS TERMINATED BY '|'");


echo "
<div align='center'>
     <table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; left: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td><div align='center' class='arial s18 blue bold'>Item deleted...</div></td>
      </tr>
</div>
";

mysqli_query($mycon1,"DELETE FROM `finalcaserate` WHERE `autono`='$autono'");

echo "<META HTTP-EQUIV='Refresh'CONTENT='1;URL=Close.php'>";

?>

</body>
</html>
