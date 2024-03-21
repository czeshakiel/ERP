<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Unlock Case Rate Edit/Delete</title>
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
      .form-container-Edit input[type=text], .form-container-Edit input[type=password], .form-container-Edit textarea {
      padding: 7px;
      margin: 5px 0 5px 0;
      border: none;
      background: #eee;
      }
      /* When the inputs get focus, do something */
      .form-container-Edit input[type=text]:focus, .form-container-Edit input[type=password]:focus, .form-container-Edit select:focus, .form-container-Edit textarea:focus {
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
      function placeFocus() {
        if (document.forms.length > 0) {
          var field = document.forms[0];
          for (i = 0; i < field.length; i++) {
            if ((field.elements[i].type == "text") || (field.elements[i].type == "textarea") || (field.elements[i].type.toString().charAt(0) == "s")) {
              document.forms[0].elements[i].focus();
              break;
            }
          }
        }
      }
    </script>
  </head>
<body onload="placeFocus()">
<?php
ini_set("display_errors", "On");
include('../Settings.php');
$cuz = new database();

$caseno=mysqli_real_escape_string($mycon1,$_GET['caseno']);
$user=mysqli_real_escape_string($mycon1,$_GET['user']);

echo "
<div align='center'>
  <table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; center: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td valign='middle'><div align='center'>
        <table border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <td><div align='center' class='arial s20 red bold'>Unlock Error!!! Wrong Username or Password!!!</div></td>
          </tr>
        </table>
      </div></td>
    </tr>
  </table>
</div>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=../CaseRates/?caseno=$caseno&user=$user'>";
?>

<script>
  function closeme() {
    window.close();
  }
</script>

</body>
</html>
