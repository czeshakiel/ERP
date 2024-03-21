<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Saving...</title>
  <link rel="stylesheet" type="text/css" href="CSS/mystyle.css">
  <!-- Favicon -->
  <link rel='icon' href='../../main/assets/favicon/favicon.png' type='image/png' />
  <link rel='shortcut icon' href='../../main/assets/favicon/favicon.png' type='image/png' />

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
      .form-container-Edit input[type=text], .form-container-Edit input[type=password], .form-container-Edit select {
      width: 250px;
      height: 40px;
      padding: 7px;
      margin: 5px 0 5px 0;
      border: none;
      background: #eee;
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
  </head>
<body>
<?php
ini_set("display_errors", "On");
include("../../main/connection.php");

$cuz = new database();

mysqli_query($conn,'SET NAMES utf8');

$doctor1=mysqli_real_escape_string($conn,$_POST['doctor1']);
$copay1=mysqli_real_escape_string($conn,$_POST['copay1']);
$mm1=mysqli_real_escape_string($conn,$_POST['mm1']);
$dd1=mysqli_real_escape_string($conn,$_POST['dd1']);
$yy1=mysqli_real_escape_string($conn,$_POST['yy1']);

if("$yy1-$mm1-$dd1"=="--"){$da1="";}else{$da1="$yy1-$mm1-$dd1";}

$doctor2=mysqli_real_escape_string($conn,$_POST['doctor2']);
$copay2=mysqli_real_escape_string($conn,$_POST['copay2']);
$mm2=mysqli_real_escape_string($conn,$_POST['mm2']);
$dd2=mysqli_real_escape_string($conn,$_POST['dd2']);
$yy2=mysqli_real_escape_string($conn,$_POST['yy2']);

if("$yy2-$mm2-$dd2"=="--"){$da2="";}else{$da2="$yy2-$mm2-$dd2";}

$doctor3=mysqli_real_escape_string($conn,$_POST['doctor3']);
$copay3=mysqli_real_escape_string($conn,$_POST['copay3']);
$mm3=mysqli_real_escape_string($conn,$_POST['mm3']);
$dd3=mysqli_real_escape_string($conn,$_POST['dd3']);
$yy3=mysqli_real_escape_string($conn,$_POST['yy3']);

if("$yy3-$mm3-$dd3"=="--"){$da3="";}else{$da3="$yy3-$mm3-$dd3";}

$caseno=mysqli_real_escape_string($conn,$_POST['caseno']);

echo "
<div align='center'>
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='center' class='arial s16 blue bold'>Saving changes...</div></td>
    </tr>
  </table>
</div>
";

$loguser=base64_decode($_SESSION['nm']);

$asql=mysqli_query($conn,"SELECT * FROM `claiminfoadd` WHERE `caseno`='$caseno'");
$acount=mysqli_num_rows($asql);

$bsql=mysqli_query($conn,"SELECT `patientidno` FROM `admission` WHERE `caseno`='$caseno'");
$bfetch=mysqli_fetch_array($bsql);
$patientidno=$bfetch['patientidno'];

$csql=mysqli_query($conn,"SELECT name FROM docfile WHERE phicacc='$doctor1'");
$cfetch=mysqli_fetch_array($csql);
$doc1=$cfetch['name'];

if($doc1=="REFERRAL"){
  $doc1="";
}

$dsql=mysqli_query($conn,"SELECT name FROM docfile WHERE phicacc='$doctor2'");
$dfetch=mysqli_fetch_array($dsql);
$doc2=$dfetch['name'];

if($doc2=="REFERRAL"){
  $doc2="";
}

$esql=mysqli_query($conn,"SELECT name FROM docfile WHERE phicacc='$doctor3'");
$efetch=mysqli_fetch_array($esql);
$doc3=$efetch['name'];

if($doc3=="REFERRAL"){
  $doc3="";
}

if($acount==0){
  mysqli_query($conn,"INSERT INTO `claiminfoadd` (`patientidno`, `caseno`, `doctor1`, `datesigned1`, `copay1`, `doctor2`, `datesigned2`, `copay2`, `doctor3`, `datesigned3`, `copay3`) VALUES ('$patientidno', '$caseno', '$doc1', '$da1', '$copay1', '$doc2', '$da2', '$copay2', '$doc3', '$da3', '$copay3')");

  $inlog="$loguser |  ('$patientidno', '$caseno', '$doc1', '$da1', '$copay1', '$doc2', '$da2', '$copay2', '$doc3', '$da3', '$copay3')";
}
else{
    mysqli_query($conn,"UPDATE `claiminfoadd` SET `doctor1`='$doc1', `datesigned1`='$da1', `copay1`='$copay1', `doctor2`='$doc2', `datesigned2`='$da2', `copay2`='$copay2', `doctor3`='$doc3', `datesigned3`='$da3', `copay3`='$copay3' WHERE `caseno`='$caseno'");

    $inlog="$loguser | `doctor1`='$doc1', `datesigned1`='$da1', `copay1`='$copay1', `doctor2`='$doc2', `datesigned2`='$da2', `copay2`='$copay2', `doctor3`='$doc3', `datesigned3`='$da3', `copay3`='$copay3'";
}

$pdate=date("Ymdhis");
$log = fopen("Logs/PROF-$caseno-$pdate.txt", "w") or die("Unable to open file!");
fwrite($log, $inlog);
fclose($log);

echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=Close.php'>";

?>

</body>
</html>
