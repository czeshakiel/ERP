<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Remove from Black List</title>
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
      .form-container-Edit input[type=text], .form-container-Edit input[type=date], .form-container-Edit textarea {
      padding: 7px;
      margin: 5px 0 5px 0;
      border: none;
      background: #eee;
      }
      /* When the inputs get focus, do something */
      .form-container-Edit input[type=text]:focus, .form-container-Edit input[type=date]:focus, .form-container-Edit select:focus, .form-container-Edit textarea:focus {
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
    <script type="text/javascript">
        function change_url(val) {
            window.location=val;
        }
    </script>
  </head>
<body>
<?php
ini_set("display_errors", "On");
include("../main/connection.php");

if(isset($_POST['confirm'])){
  $no=mysqli_real_escape_string($conn,$_POST['no']);
  $pn=base64_decode(mysqli_real_escape_string($conn,$_POST['pn']));
  $user=base64_decode(mysqli_real_escape_string($conn,$_POST['user']));

  $recact="$pn is removed from the Patient Black List.";
  mysqli_query($conn,"INSERT INTO `userlogs` (`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('$recact', '$user', '".date("Y-m-d")."', '".date("H:i:s")."')");

  mysqli_query($conn,"DELETE FROM `patientblacklist` WHERE `no`='$no'");

echo "
<div align='center'>
  <form name='Save' method='post' class='form-container-Edit'>
    <table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; left: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td valign='middle'>
          <table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='center' class='arial s18 red bold'>Patient Removed from <span style='color: #000000;'><u>&quot;Black List&quot;</u></span>!!!</div></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </form>
</div>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='2;URL=Close.php'>";
}
else{
  $pn=mysqli_real_escape_string($conn,$_GET['pn']);
  $no=mysqli_real_escape_string($conn,$_GET['no']);
  $user=mysqli_real_escape_string($conn,$_GET['user']);

echo "
<div align='center'>
  <form name='Save' method='post' class='form-container-Edit'>
    <table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; left: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td valign='middle'>
          <table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='center' class='arial s16 red bold'>Are you really sure you want to remove<br /><span style='color: #8C1BF7;'><u>&quot;".base64_decode($pn)."&quot;</u></span><br />from <span style='color: #000000;'><u>&quot;Black List&quot;</u></span>?</div></td>
            </tr>
            <tr>
              <td height='10'></td>
            </tr>
            <tr>
              <td>
                <table width='100%' border='0' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td width='49%'><div align='right'><button type='button' class='btn cancel' onclick='closeme()'>&nbsp; Close &nbsp;</button></div></td>
                    <td width='2%'></td>
                    <td width='49%'><div align='left'><button type='submit' name='confirm' class='btn'>Confirm</button></div></td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <input type='hidden' name='no' value='$no' />
    <input type='hidden' name='pn' value='$pn' />
    <input type='hidden' name='user' value='$user' />
  </form>
</div>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='300;URL=Close.php'>";
}

?>

<script>
  function closeme() {
    window.close();
  }
</script>

</body>
</html>
