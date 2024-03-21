<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Edit Amount</title>
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
    <script type="text/javascript">
      function handleEnter (field, event) {
        var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
          if (keyCode == 13) {
            var i;
            for (i = 0; i < field.form.elements.length; i++)
            if (field == field.form.elements[i])
            break;
            i = (i + 1) % field.form.elements.length;
            field.form.elements[i].focus();
            return false;
          }
          else
            return true;
      }
    </script>
  </head>
<body>
<?php
ini_set("display_errors", "On");
include('../Settings.php');
$cuz = new database();

$caseno=mysqli_real_escape_string($mycon1,$_GET['caseno']);
$user=mysqli_real_escape_string($mycon1,$_GET['user']);
$editauto=mysqli_real_escape_string($mycon1,$_GET['autono']);

$asql=mysqli_query($mycon1,"SELECT `icdcode`, `type`, `hospitalshare`, `pfshare` FROM `finalcaserate` WHERE `autono`='$editauto'");
$afetch=mysqli_fetch_array($asql);
$icdcode=$afetch['icdcode'];
$type=$afetch['type'];
$hospitalshare=$afetch['hospitalshare'];
$pfshare=$afetch['pfshare'];

if($type=="icd"){
  $disp="ICD Code";
}
else if($type=="rvs"){
  $disp="RVS Code";
}
else{
  $disp="Additional DX";
}

echo "
<div align='center'>
  <table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; center: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='center'>
        <form name='Save' method='post' action='EditICRVAmtSave.php' class='form-container-Edit' id='document'>
          <table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='center' class='arial s20 blue bold'>Edit Amount</div></td>
            </tr>
            <tr>
              <td height='10'></td>
            </tr>
            <tr>
              <td><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td><div align='left' class='s14 bold'>$disp</div></td>
                  <td width='10'><div align='center' class='s14'>:</div></td>
                  <td><input type='text' placeholder='$disp' name='icdcode' value='$icdcode' autocomplete='off' style='width: 250px;height: 40px;' readonly /></td>
                </tr>
                <tr>
                  <td><div align='left' class='s14 bold'>HCI Amount</div></td>
                  <td width='10'><div align='center' class='s14'>:</div></td>
                  <td><input type='text' placeholder='HCI Amount' name='hospitalshare' value='$hospitalshare' autocomplete='off' style='width: 250px;height: 40px;' /></td>
                </tr>
                <tr>
                  <td><div align='left' class='s14 bold'>PF Amount</div></td>
                  <td width='10'><div align='center' class='s14'>:</div></td>
                  <td><input type='text' placeholder='PF Amount' name='pfshare' value='$pfshare' autocomplete='off' style='width: 250px;height: 40px;' /></td>
                </tr>
                <tr>
                  <td colspan='3' height='10'></td>
                </tr>
                <tr>
                  <td colspan='3'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='49%'><div align='right'><button type='button' class='btn cancel' onclick='closeme()'>Close</button></div></td>
                      <td width='2%'></td>
                      <td width='49%'><div align='left'><button type='submit' class='btn'>Save</button></div></td>
                    </tr>
                  </table></td>
                </tr>
";

echo "
              </table></div></td>
            </tr>
          </table>
        <input type='hidden' name='caseno' value='$caseno' />
        <input type='hidden' name='user' value='$user' />
        <input type='hidden' name='editauto' value='$editauto' />
        </form>
      </div></td>
    </tr>
  </table>
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
