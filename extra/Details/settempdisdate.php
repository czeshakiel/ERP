<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Set Temporary Discharged Date</title>
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
      .form-container-Edit input[type=date], .form-container-Edit input[type=time] {
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
      .form-container-Edit input[type=time]:focus, .form-container-Edit input[type=date]:focus, .form-container-Edit select:focus {
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
      width: 80px;
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
$cuz = new database();

$caseno=mysqli_real_escape_string($mycon1,$_GET['caseno']);
$uname=mysqli_real_escape_string($mycon1,$_GET['uname']);

$tdssql=mysqli_query($mycon1,"SELECT * FROM tempdatestorage WHERE caseno='$caseno'");
$tdscount=mysqli_num_rows($tdssql);
if($tdscount==0){
  $tdate=date("Y-m-d");
  $ttime=date("H:i");
}
else{
  $tdsfetch=mysqli_fetch_array($tdssql);
  $tdate=$tdsfetch['date'];
  $ttime=$tdsfetch['time'];

  if($tdate==""){
    $tdate=date("Y-m-d");
  }

  if($ttime==""){
    $ttime=date("H:i");
  }
}

echo "
<div align='center'><table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; left: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
  <tr>
    <td valign='middle'><div align='center'>
      <form name='Save' method='post' action='settempdisdatesave.php' class='form-container-Edit'>
        <table border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <td><div align='center' class='arial s20 blue bold'>Set Temporay Discahrged Date</div></td>
          </tr>
          <tr>
            <td height='10'></td>
          </tr>
          <tr>
            <td><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
              <tr>
                <td><input type='date' name='tdate' value='$tdate' /></td>
                <td width='5'></td>
                <td><input type='time' name='ttime' value='$ttime' /></td>
              </tr>
            </div></table></td>
          </tr>
          <tr>
            <td height='10'></td>
          </tr>
          <tr>
            <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
              <tr>
                <td width='49%'><div align='right'><button type='button' class='btn cancel' onclick='closeme()'>Close</button></div></td>
                <td width='2%'></td>
                <td width='49%'><div align='left'><button type='submit' class='btn'>Set</button></div></td>
              </tr>
            </table></td>
          </tr>
        </table>
      <input type='hidden' name='caseno' value='$caseno' />
      <input type='hidden' name='uname' value='$uname' />
      </form>
    </div></td>
  </tr>
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
