<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Result Edit Logs</title>
  <link rel="stylesheet" type="text/css" href="../extra/Resources/CSS/mystyle.css">
  <!-- Favicon -->
    <link rel="icon" href="../extra/Resources/Favicon/favicon.png" type="image/png" />
    <link rel="shortcut icon" href="../extra/Resources/Favicon/favicon.png" type="image/png" />
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
      .form-container-Edit input[type=text], .form-container-Edit input[type=number] {text-align: center;width: 200px;height: 40px;padding: 7px;margin: 5px 0 5px 0;border: none;background: #eee;border-radius: 10px;font-size: 16px;}
      /* Full-width for input fields */
      .form-container-Edit textarea {width: 95%;height: 60px;padding: 7px;margin: 5px 0 5px 0;border: none;background: #eee;border-radius: 10px;font-size: 16px;text-align: center;}
      /* Select fields */
      .form-container-Edit select {padding: 10px;margin: 5px 0 10px 0;border: none;background: #eee;border-radius: 10px;font-size: 16px;text-align: center;width: 200px;}
      /* When the inputs get focus, do something */
      .form-container-Edit input[type=text]:focus, .form-container-Edit input[type=password]:focus, .form-container-Edit textarea:focus {background-color: #ddd;outline: none;}
      /* Style submit/login button */
      .form-container-Edit .btn {background-color: #8ebf42;color: #fff;padding: 12px 20px;border: none;cursor: pointer;margin-bottom:10px;opacity: 0.8;border-radius: 10px;width: 80px;}
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
include('../main/class2.php');

$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);
$refno=mysqli_real_escape_string($conn,$_GET['refno']);

mysqli_query($conn,"SET NAMES 'utf8'");
$asql=mysqli_query($conn,"SELECT p.`lastname`, p.`firstname`, p.`middlename`, p.`suffix` FROM `admission` a, `patientprofile` p WHERE a.`caseno`='$caseno' AND a.`patientidno`=p.`patientidno`");
$afetch=mysqli_fetch_array($asql);
$ln=trim(mb_strtoupper($afetch['lastname']));
$fn=trim(mb_strtoupper($afetch['firstname']));
$mn=trim(mb_strtoupper($afetch['middlename']));
$sf=trim(mb_strtoupper($afetch['suffix']));

if($mn==""){$mn="";}else{$mn=" ".$mn;}
if($sf==""){$sf="";}else{$sf=" ".$sf;}

$patname=$ln.", ".$fn.$sf.$mn;

$bsql=mysqli_query($conn,"SELECT `productdesc` FROM `productout` WHERE `refno`='$refno'");
$bfetch=mysqli_fetch_array($bsql);
$label=$bfetch['productdesc'];

echo "
<table border='0' width='100%' cellpadding='0' cellspacing='0'>
  <tr>
    <td><div align='left' style='padding: 5px 5px;'>
      <table border='0' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
          <td class='b1'><div align='center' style='padding: 5px 5px;font-family: arial;font-weight: bold;font-size: 16px;'>Cancel Request Log</div></td>
        </tr>
        <tr>
          <td><div align='left' style='font-family: arial;font-weight: bold;font-size: 14px;'>PATIENT NAME: <span style='color: #0389D1;'><u>$patname</u></span></div></td>
        </tr>
        <tr>
          <td height='5'></td>
        </tr>
        <tr>
          <td><div align='left' style='font-family: arial;font-size: 14px;font-weight: bold;'>$label</td>
        </tr>
        <tr>
          <td height='5'></td>
        </tr>
        <tr>
          <td><div align='left'>
";

$x=0;
$xsql=mysqli_query($conn,"SELECT * FROM `userlogs` WHERE `transaction` LIKE '%|LabUpdate|%%|Cancel%%|$caseno|$refno|%'");
if(mysqli_num_rows($xsql)>0){

echo "
            <table border='0' cellpadding='0' cellspacing='0'>
";

  while($xfetch=mysqli_fetch_array($xsql)){
    $loginuser=$xfetch['loginuser'];
    $transaction=$xfetch['transaction'];
    $timearray=$xfetch['timearray'];
    $datearray=$xfetch['datearray'];
    $x++;

echo "
              <tr>
                <td valign='top'><div align='left' style='font-family: arial;font-size: 13px;padding: 3px 5px 3px 3px;'>$x.</div></td>
                <td><div align='left' style='font-family: arial;font-size: 13px;padding: 3px 3px;'>Request Cancelled by $loginuser on ".date("M d, Y H:i:s",strtotime("$datearray $timearray"))."</div></td>
              </tr>
";
  }

echo "
            </table>
";
}

echo "
          </div></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='300;URL=Close.php'>";
?>
</body>
</html>
