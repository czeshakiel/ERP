<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Add Case Rate</title>
  <link rel="stylesheet" type="text/css" href="../Resources/CSS/mystyle.css">
  <!-- Favicon -->
    <link rel="icon" href="../Resources/Favicon/favicon.png" type="image/png" />
    <link rel="shortcut icon" href="../Resources/Favicon/favicon.png" type="image/png" />

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
      .form-container-Edit input[type=text], .form-container-Edit input[type=number], .form-container-Edit textarea {
      padding: 7px;
      margin: 5px 0 5px 0;
      border: none;
      background: #eee;
      }
      /* When the inputs get focus, do something */
      .form-container-Edit input[type=text]:focus, .form-container-Edit input[type=number]:focus, .form-container-Edit select:focus, .form-container-Edit textarea:focus {
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
      /* Radio Look Like Checkbox*/
      .css-prp{color: #17CBF2;font-family: arial;}
      .con1 {display: block;position: relative;padding-left: 25px;margin-bottom: 12px;cursor: pointer;font-size: 15px;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;}

      /* Hide the browser's default radio button */
      .con1 input {position: absolute;opacity: 0;cursor: pointer;}

      /* Create a custom radio button */
      .checkmark {position: absolute;top: 0;left: 0;height: 18px;width: 18px;background-color: lightgrey;border-radius: 10%;}

      /* When the radio button is checked, add a blue background */
      .con1 input:checked ~ .checkmark {background-color: #17CBF2;}
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

$icdcode=mb_strtoupper(mysqli_real_escape_string($mycon1,$_GET['icdcode']));
$user=mysqli_real_escape_string($mycon1,$_GET['user']);

$disp="ICD/RVS Code";

echo "
<div align='center'>
  <table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; center: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='center'>
        <form name='Save' method='post' action='AddICDToListGo.php' class='form-container-Edit'>
          <table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='center' class='arial s20 blue bold'>Edit Case Rate</div></td>
            </tr>
            <tr>
              <td height='10'></td>
            </tr>
            <tr>
              <td><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td><div align='left' class='s14 bold'>$disp</div></td>
                  <td width='10'><div align='center' class='s14'>:</div></td>
                  <td><input type='text' placeholder='$disp' name='icdcode' value='$icdcode' autocomplete='off' style='width: 250px;height: 40px;' required /></td>
                </tr>
                <tr>
                  <td><div align='left' class='s14 bold'>Type</div></td>
                  <td width='10'><div align='center' class='s14'>:</div></td>
                  <td><select name='category' style='width: 250px;height: 40px;' required>
                    <option value='' disabled selected>Select Type</option>
                    <option value='medical'>Medical(ICD)</option>
                    <option value='surgical'>Surgical(RVS)</option>
                    <option value='additional'>For DX Only</option>
                  </select></td>
                </tr>
                <tr>
                  <td><div align='left' class='s14 bold'>Description</div></td>
                  <td width='10'><div align='center' class='s14'>:</div></td>
                  <td>
                    <textarea name='description' style='width: 250px;height: 100px;' placeholder='Description'></textarea>
                  </td>
                </tr>
                <tr>
                  <td><div align='left' class='s14 bold'>Group ID</div></td>
                  <td width='10'><div align='center' class='s14'>:</div></td>
                  <td><input type='text' placeholder='Group ID' name='groupid' value='' autocomplete='off' style='width: 250px;height: 40px;' /></td>
                </tr>
                <tr>
                  <td><div align='left' class='s14 bold'>Group Desc.</div></td>
                  <td width='10'><div align='center' class='s14'>:</div></td>
                  <td>
                    <textarea name='groupdiag' placeholder='Group Description' style='width: 250px;height: 100px;' required></textarea>
                  </td>
                </tr>
                <tr>
                  <td colspan='3' height='5'></td>
                </tr>
                <tr>
                  <td colspan='3'><div align='center' class='s14 bold blue'>1st Case Rate Amount</div></td>
                </tr>
                <tr>
                  <td><div align='left' class='s14 bold'>Hospital</div></td>
                  <td width='10'><div align='center' class='s14'>:</div></td>
                  <td><input type='number' step='0.01' placeholder='Hospital Share Amount' name='hospital' value='' autocomplete='off' style='width: 250px;height: 40px;' required /></td>
                </tr>
                <tr>
                  <td><div align='left' class='s14 bold'>PF</div></td>
                  <td width='10'><div align='center' class='s14'>:</div></td>
                  <td><input type='number' step='0.01' placeholder=PF Share Amount' name='pf' value='' autocomplete='off' style='width: 250px;height: 40px;' required /></td>
                </tr>
                <tr>
                  <td colspan='3' height='5'></td>
                </tr>
                <tr>
                  <td colspan='3'><div align='center' class='s14 bold blue'>2nd Case Rate Amount</div></td>
                </tr>
                <tr>
                  <td><div align='left' class='s14 bold'>Hospital</div></td>
                  <td width='10'><div align='center' class='s14'>:</div></td>
                  <td><input type='number' step='0.01' placeholder='Hospital Share Amount' name='hospital2' value='' autocomplete='off' style='width: 250px;height: 40px;' required /></td>
                </tr>
                <tr>
                  <td><div align='left' class='s14 bold'>PF</div></td>
                  <td width='10'><div align='center' class='s14'>:</div></td>
                  <td><input type='number' step='0.01' placeholder=PF Share Amount' name='pf2' value='' autocomplete='off' style='width: 250px;height: 40px;' required /></td>
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
          <input type='hidden' name='user' value='$user' />
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
