<!DOCTYPE html>
<html lang="en">
  <head>
  <title>DUPLICATE WARNING!!!</title>
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
$patid=mysqli_real_escape_string($mycon1,$_GET['patid']);
$refno=mysqli_real_escape_string($mycon1,$_GET['refno']);

$asql=mysqli_query($mycon1,"SELECT `invno`, `productdesc`, `trantype`, `status`, `terminalname`, `datearray` FROM `productout` WHERE `refno`='$refno'");
$afetch=mysqli_fetch_array($asql);
$ctime=$afetch['invno'];
$cdesc=$afetch['productdesc'];
$ctran=$afetch['trantype'];
$cstat=$afetch['status'];
$crest=$afetch['terminalname'];
$cdate=$afetch['datearray'];

if($ctran=="cash"){$ctrand="Cash";}
else if($ctran=="charge"){$ctrand="Charged";}
else{$ctrand=$ctran;}

if($crest=="pending"){$crestd="Pending";}
else if($crest=="Testdone"){$crestd="Test Done";}
else if($crest=="Testtobedone"){$crestd="Test to be Done";}
else if($crest=="refund"){$crestd="Refund";}
else if($crest=="for refund"){$crestd="For Refund";}
else if($crest=="FOR CANCEL"){$crestd="For Cancel";}
else{$crestd="Status Unknown";}

$dt=$cdate." ".$ctime;
$dtfmt=date("M d, Y H:i A",strtotime($dt));

echo "
<div align='center'>
  <table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; left: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td width='10'></td>
      <td><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td><div align='center' class='arial s16 red bold'>System detected that the same service is requested to this patient from a previous transaction this day.</div></td>
        </tr>
        <tr>
          <td height='10'></td>
        </tr>
        <tr>
          <td><div align='left' class='arial s14 blue bold'>Details:</div></td>
        </tr>
        <tr>
          <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td class='t2 b2 l2'><div align='center' class='arial s10 black bold'>Description</div></td>
              <td class='t2 b2 l1'><div align='center' class='arial s10 black bold'>Tran. Type</div></td>
              <td class='t2 b2 l1'><div align='center' class='arial s10 black bold'>Result Status</div></td>
              <td class='t2 b2 l1 r2'><div align='center' class='arial s10 black bold'>Date/Time Requseted</div></td>
            </tr>
            <tr>
              <td class='b2 l2'><div align='center' class='arial s11 black'>$cdesc</div></td>
              <td class='b2 l1'><div align='center' class='arial s11 black'>$ctrand <span class='s12'>($cstat)</span></div></td>
              <td class='b2 l1'><div align='center' class='arial s11 black'>$crestd</div></td>
              <td class='b2 l1 r2'><div align='center' class='arial s11 black'>$dtfmt</div></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height='10'></td>
        </tr>
        <tr>
          <td><div align='center' class='arial s14 black bold'>Case No: <u>$caseno</u></div></td>
        </tr>
      </table></td>
      <td width='10'></td>
    </tr>
  </table>
</div>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='60;URL=Close.php'>";

?>

<script>    
  function closeme() {
    window.close();
  }
</script>

</body>
</html>
