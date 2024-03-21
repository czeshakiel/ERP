<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Add Room</title>
  <link rel='stylesheet' type='text/css' href='../../Resources/JS/tcal.css' />
  <script type='text/javascript' src='../../Resources/JS/tcal.js'></script>
  <link rel="stylesheet" type="text/css" href="../Resources/CSS/mystyle.css">
  <!-- Favicon -->
  <link rel="icon" href="../Resources/Favicon/logo.png" type="image/png" />
  <link rel="shortcut icon" href="../Resources/Favicon/logo.png" type="image/png" />

    <style>
      * {box-sizing: border-box;}
      body {font-family: Roboto, Helvetica, sans-serif;background-color: #E8E4C9;}
      /* Fix the button on the left side of the page */
      .open-btn {display: flex;justify-content: left;}
      /* Style and fix the button on the page */
      .open-button {background-color: #1c87c9;color: white;padding: 12px 20px;border: none;border-radius: 5px;cursor: pointer;opacity: 0.8;position: fixed;}
      /* Styles for the form container */
      .form-container-Edit {max-width: 500px;padding: 15px;background-color: #E8E4C9;}
      /* Full-width for input fields */
      .form-container-Edit input[type=number], .form-container-Edit input[type=date] {width: 250px;height: 40px;padding: 7px;margin: 5px 0 5px 0;border: none;background: #eee;border-radius: 10px;font-size: 16px;}
      .list {width: 250px;height: 40px;padding: 7px;margin: 5px 0 5px 0;border: none;background: #eee;border-radius: 10px;font-size: 16px;}
      .list:focus{background-color: #ddd;outline: none;}
      /* Full-width for input fields */
      .form-container-Edit select {height: 40px;padding: 7px;margin: 5px 0 5px 0;border: none;background: #eee;border-radius: 10px;font-size: 16px;}
      /* Select fields */
      .form-container-Edit select {padding: 10px;margin: 5px 0 10px 0;border: none;background: #eee;}
      /* When the inputs get focus, do something */
      .form-container-Edit input[type=number]:focus, .form-container-Edit input[type=date]:focus, .form-container-Edit select:focus {background-color: #ddd;outline: none;}
      /* Style submit/login button */
      .form-container-Edit .btn {background-color: #8ebf42;color: #fff;padding: 12px 20px;border: none;cursor: pointer;margin-bottom:10px;opacity: 0.8;border-radius: 10px;}
      /* Style cancel button */
      .form-container-Edit .cancel {background-color: #cc0000;}
      /* Hover effects for buttons */
      .form-container-Edit .btn:hover, .open-button:hover {opacity: 1;}
    </style>
    <script type="text/javascript">
        function change_url(val) {
            window.location=val;
        }
    </script>
  </head>
<body>
<?php
ini_set("display_errors", "On");
include("../../main/class2.php");
$cuz = new database();

$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);
$xix=mysqli_real_escape_string($conn,$_GET['xix']);

mysqli_query($conn,"SET NAMES 'utf8'");
$zsql=mysqli_query($conn,"SELECT `name` FROM `nsauth` WHERE `username`='".base64_decode($xix)."' AND `station`='BILLING'");
$zfetch=mysqli_fetch_array($zsql);
$name=$zfetch['name'];

echo "
<div align='center'>
  <form name='Save' method='post' action='addroomsave.php' class='form-container-Edit'>
    <table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td colspan='3'><div align='center' class='arial s20 blue bold'>Add Room</div></td>
      </tr>
      <tr>
        <td colspan='3' height='10'></td>
      </tr>
      <tr>
        <td><div align='left' class='s14 bold'>Room</div></td>
        <td width='10'><div align='center' class='s14 bold'>:</div></td>
        <td>
          <input list='brow' class='list' name='room' placeholder='Search Room' autocomplete='off' autofocus required>
          <datalist id='brow' class=''>
";

$asql=mysqli_query($conn,"SELECT `room` FROM `room` WHERE `nursestation` <> '' ORDER BY `room` ASC");
while($afetch=mysqli_fetch_array($asql)){
  $rm=$afetch['room'];
echo "
            <option selected='selected'>$rm</option>
";
}

echo "
          </datalist>
        </td>
      </tr>
      <tr>
        <td><div align='left' class='s14 bold'>Days Stayed</div></td>
        <td width='10'><div align='center' class='s14 bold'>:</div></td>
        <td><input type='number' placeholder='Days Stayed' name='qty' value='1' autocomplete='off' required /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14 bold'>Selling Price</div></td>
        <td width='10'><div align='center' class='s14 bold'>:</div></td>
        <td><input type='date' placeholder='Date' name='datearray' value='".date("Y-m-d")."' autocomplete='off' required /></td>
      </tr>
      <tr>
        <td colspan='3' height='10'></td>
      </tr>
      <tr>
        <td colspan='3'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <td width='49%'><div align='right'><button type='button' class='btn cancel' onclick='closeme()'>Close</button></div></td>
            <td width='2%'></td>
            <td width='49%'><div align='left'><button type='submit' name='save' class='btn'>Save</button></div></td>
          </tr>
        </table></td>
      </tr>
    </table>
  <input type='hidden' name='caseno' value='$caseno' />
  <input type='hidden' name='name' value='$name' />
  </form>
</div>
";

?>
<script src="../../Resources/JS/sb-admin-2.js"></script>
<script src="../../Resources/JS/jquery.min.js"></script>
<script>
  function closeme() {
    window.close();
  }
</script>

</body>
</html>
