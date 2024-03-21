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
include("../../main/class.php");
$cuz = new database();

$caseno=mysqli_real_escape_string($conn,$_POST['caseno']);
$un=mysqli_real_escape_string($conn,$_POST['uname']);
$name=mysqli_real_escape_string($conn,$_POST['name']);

if(!is_dir("Logs/SetUser/$caseno")){
mkdir("Logs/SetUser/$caseno", 0777, true);
exec("chmod 777 Logs/SetUser/$caseno/");
}

$pdate=date("YmdHis");

echo "
<div align='center'>
  <table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; left: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='center' class='arial s18 blue bold'>Saving changes...</div></td>
    </tr>
  </table>
</div>
";


$setusql=mysqli_query($conn,"SELECT * FROM setuser WHERE caseno='$caseno'");
$setucount=mysqli_num_rows($setusql);
if($setucount==0){
  $logsin="NEW --> $pdate --> $un";
  $logs=fopen("Logs/SetUser/$caseno/$pdate.txt", "w") or die("Unable to open file!");
  fwrite($logs, $logsin);
  fclose($logs);

  mysqli_query($conn,"INSERT INTO `setuser` (`caseno`, `name`) VALUES ('$caseno', '$name')");
}
else{
  $setufetch=mysqli_fetch_array($setusql);
  $prevname=$setufetch['name'];

  $logsin="OLD --> $prevname --> $pdate --> $un";
  $logs=fopen("Logs/SetUser/$caseno/$pdate.txt", "w") or die("Unable to open file!");
  fwrite($logs, $logsin);
  fclose($logs);

  mysqli_query($conn,"UPDATE `setuser` SET `name` = '$name' WHERE `caseno` = '$caseno'");
}

echo "<META HTTP-EQUIV='Refresh'CONTENT='1;URL=Close.php'>";

?>

</body>
</html>
