<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Import to eClaims</title>
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
      .form-container-Edit input[type=text], .form-container-Edit input[type=password] {
      width: 250px;
      height: 40px;
      padding: 7px;
      margin: 5px 0 5px 0;
      border: none;
      background: #eee;
      border-radius: 10px;
      font-size: 16px;
      }
            /* Full-width for input fields */
      .form-container-Edit select {
      height: 40px;
      padding: 7px;
      margin: 5px 0 5px 0;
      border: none;
      background: #eee;
      border-radius: 10px;
      font-size: 16px;
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
      border-radius: 10px;
      width: 100px;
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
    <script type="text/javascript">
        function change_url(val) {
            window.location=val;
        }
    </script>
  </head>
<body>
<?php
ini_set("display_errors", "On");
include('../Settings.php');

$patientidno=mysqli_real_escape_string($mycon1,$_GET['patientidno']);
$caseno=mysqli_real_escape_string($mycon1,$_GET['caseno']);
$username=mysqli_real_escape_string($mycon1,$_GET['uname']);

mysqli_query($mycon1,"SET NAMES 'utf8'");
$asql=mysqli_query($mycon1,"SELECT `patientname` FROM `patientprofile` WHERE `patientidno`='$patientidno'");
$afetch=mysqli_fetch_array($asql);
$name=strtoupper($afetch['patientname']);

echo "
<div align='center'>
  <form name='Save' method='get' action='DataEntryeClaims.php' class='form-container-Edit'>
    <table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; left: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <td colspan='3'><div align='center' class='arial s16 blue bold'>IMPORT DATA OF &quot;<span style='color: #FF0000'>$name</span>&quot; TO eCLAIMS?</div></td>
          </tr>
          <tr>
            <td colspan='3' height='10'></td>
          </tr>
          <tr>
            <td colspan='3'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
              <tr>
                <td width='49%'><div align='right'><button type='button' class='btn cancel' onclick='closeme()'>&nbsp;No?</button></div></td>
                <td width='1%'></td>
                <td width='50%'><div align='left'><button type='submit' class='btn'>Yes?</button></div></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table>
  <input type='hidden' name='caseno' value='$caseno' />
  <input type='hidden' name='patientidno' value='$patientidno' />
  <input type='hidden' name='username' value='$username' />
  </form>
</div>
";

?>

<script>
  function closeme() {
    window.close();
  }
</script>

</body>
</html>
