<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Link RTH Patient</title>
  <link rel="stylesheet" type="text/css" href="../Resources/CSS/mystyle.css">
  <!-- Favicon -->
    <link rel="icon" href="../Resources/Favicon/favicon.png" type="image/png" />
    <link rel="shortcut icon" href="../Resources/Favicon/favicon.png" type="image/png" />
    <link href="../../aboy2020/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
include("../outcon.php");
$cuz = new database();

$erthcaseno=mysqli_real_escape_string($mycon1,$_GET['erthcaseno']);
$unm=mysqli_real_escape_string($mycon1,$_GET['unm']);
$pn=mysqli_real_escape_string($mycon1,$_GET['pn']);
$spn=mysqli_real_escape_string($mycon1,$_GET['spn']);

if(isset($_POST['searchme'])){
  $searchme=mysqli_real_escape_string($mycon1,$_POST['searchme']);
}
else{
  $searchme=base64_decode($spn);
}

echo "
<table style='height:95%;width:98%;position: absolute;top: 15px;bottom: 15px;left: 15px;right: 15px;' border='0' cellpadding='0' cellspacing='0'>
  <tr>
    <td valign='top'><div align='left'>
      <table border='0' width='99%' cellpadding='0' cellspacing='0'>
        <tr>
          <td><div align='left' style='color: #FFFFFF;font-size: 20px;font-weight: bold;-webkit-text-stroke: 2px #000000;'>".base64_decode($pn)."</div></td>
        </tr>
        <tr>
          <td><div align='left'>
            <form name='searchme' method='post' action='LinkRTH.php?erthcaseno=$erthcaseno&unm=$unm&pn=$pn&spn=$spn'>
            <input type='text' name='searchme' value='$searchme' placeholder='Type patient name here.' autocomplete='off' style='font-weight: bold;font-size: 16px;height: 45px;width: 400px;text-align: left;border: 2px solid #000000;border-radius: 5px;padding-left: 5px;background-color: #CBCBCB;' autofocus />
            </form>
          </div></td>
        </tr>
        <tr>
          <td height='10'></td>
        </tr>
        <tr>
          <td><div align='left'>
";

include("LinkRTHSR.php");

echo "
          </div></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
";

?>

<script>
  function closeme() {
    window.close();
  }
</script>

</body>
</html>
