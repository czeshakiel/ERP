<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Additional Data for Procedures</title>
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
include("../../main/connection.php");

$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);
$user=mysqli_real_escape_string($conn,$_GET['user']);
$editauto=mysqli_real_escape_string($conn,$_GET['editauto']);

$asql=mysqli_query($conn,"SELECT `icdcode`, `type`, `relatedprocedure`, `dateofprocedure`, `laterality` FROM `finalcaserate` WHERE `autono`='$editauto'");
$afetch=mysqli_fetch_array($asql);
$icdcode=$afetch['icdcode'];
$type=$afetch['type'];
$relatedprocedure=$afetch['relatedprocedure'];
$dateofprocedure=$afetch['dateofprocedure'];
$laterality=$afetch['laterality'];

if($type=="icd"){
  $disp="ICD Code";
}
else if($type=="rvs"){
  $disp="RVS Code";
}
else{
  $disp="Additional DX";
}

if($laterality=="L"){
  $sl1="checked";$sl2="";$sl3="";$sl4="";
}
else if($laterality=="R"){
  $sl1="";$sl2="checked";$sl3="";$sl4="";
}
else if($laterality=="B"){
  $sl1="";$sl2="";$sl3="checked";$sl4="";
}
else if($laterality=="N"){
  $sl1="";$sl2="";$sl3="";$sl4="checked";
}
else{
  $sl1="";$sl2="";$sl3="";$sl4="";
}

echo "
<div align='center'>
  <table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; center: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='center'>
        <form name='Save' method='post' action='EditRVRPSave.php' class='form-container-Edit' id='document'>
          <table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='center' class='arial s20 blue bold'>Additional Data for Procedures</div></td>
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
                  <td><div align='left' class='s14 bold'>Related Procedure</div></td>
                  <td width='10'><div align='center' class='s14'>:</div></td>
                  <td>
";

echo '
                    <textarea name="relatedprocedure" onkeypress="return handleEnter(this, event)" style="width: 250px;height: 100px;">'.$relatedprocedure.'</textarea>
';

echo "
                  </td>
                </tr>
                <tr>
                  <td><div align='left' class='s14 bold'>Date of Procedure</div></td>
                  <td width='10'><div align='center' class='s14'>:</div></td>
                  <td><input type='date' placeholder='Date of Procedure' name='dateofprocedure' value='$dateofprocedure' autocomplete='off' style='width: 250px;height: 40px;' /></td>
                </tr>
                <tr>
                  <td colspan='3' height='10'></td>
                </tr>
                <tr>
                  <td><div align='left' class='s14 bold'>Laterality</div></td>
                  <td width='10'><div align='center' class='s14'>:</div></td>
                  <td><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><table border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td><label class='con1'><span>Left</span><input type='radio' name='laterality' value='L' $sl1 /><span class='checkmark'></span></label></td>
                          <td width='4'></td>
                          <td><label class='con1'><span>Right</span><input type='radio' name='laterality' value='R' $sl2 /><span class='checkmark'></span></label></td>
                          <td width='4'></td>
                          <td><label class='con1'><span>Both</span><input type='radio' name='laterality' value='B' $sl3 /><span class='checkmark'></span></label></td>
                          <td width='4'></td>
                          <td><label class='con1'><span>N/A</span><input type='radio' name='laterality' value='N' $sl4 /><span class='checkmark'></span></label></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
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
