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
include("../../main/class2.php");

mysqli_query($conn,'SET NAMES utf8');

$lastname=strtoupper(mysqli_real_escape_string($conn,$_POST['lastname']));
$firstname=strtoupper(mysqli_real_escape_string($conn,$_POST['firstname']));
$middlename=strtoupper(mysqli_real_escape_string($conn,$_POST['middlename']));
$suffix=strtoupper(mysqli_real_escape_string($conn,$_POST['suffix']));
$mm=mysqli_real_escape_string($conn,$_POST['mm']);
$dd=mysqli_real_escape_string($conn,$_POST['dd']);
$yy=mysqli_real_escape_string($conn,$_POST['yy']);
$gender=mysqli_real_escape_string($conn,$_POST['gender']);
$caseno=mysqli_real_escape_string($conn,$_POST['caseno']);
$patientidno=mysqli_real_escape_string($conn,$_POST['patientidno']);
$paymentmode=mysqli_real_escape_string($conn,$_POST['paymentmode']);

$bd=date("M-d-Y",strtotime("$yy-$mm-$dd"));
$dob="$yy-$mm-$dd";

if($suffix!=""){
  $pname="$lastname $firstname $suffix $middlename";
}
else{
  $pname="$lastname $firstname $middlename";
}

echo "
<div align='center'>
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='center' class='arial s16 blue bold'>Saving changes...</div></td>
    </tr>
  </table>
</div>
";

if($paymentmode=="Member"){
  //claiminfo
  $asql=mysqli_query($conn,"SELECT * FROM claiminfo WHERE patientidno='$patientidno' AND caseno='$caseno'");
  $acount=mysqli_num_rows($asql);
  if($acount==0){
    mysqli_query($conn,"INSERT INTO `claiminfo` (`patientidno`, `caseno`, `lastname`, `firstname`, `middlename`) VALUES ('$patientidno', '$caseno', '$lastname', '$firstname', '$middlename')");
  }
  else{
    mysqli_query($conn,"UPDATE `claiminfo` SET `lastname`='$lastname', `firstname`='$firstname', `middlename`='$middlename' WHERE `patientidno`='$patientidno' AND `caseno`='$caseno'");
  }

  //claiminfoadd
  $bsql=mysqli_query($conn,"SELECT * FROM `claiminfoadd` WHERE `patientidno`='$patientidno' AND `caseno`='$caseno'");
  $bcount=mysqli_num_rows($bsql);
  if($bcount==0){
    mysqli_query($conn,"INSERT INTO `claiminfoadd` (`patientidno`, `caseno`) VALUES ('$patientidno', '$caseno')");
  }

  //claiminfomoreinfo
  $csql=mysqli_query($conn,"SELECT * FROM `claiminfomoreinfo` WHERE `caseno`='$caseno'");
  $ccount=mysqli_num_rows($csql);
  if($ccount==0){
    mysqli_query($conn,"INSERT INTO `claiminfomoreinfo` (`caseno`, `membersuffix`, `memberbday`, `membergender`, `rtm`) VALUES ('$caseno', '$suffix', '$bd', '$gender', '$paymentmode')");
  }
  else{
    mysqli_query($conn,"UPDATE `claiminfomoreinfo` SET `membersuffix`='$suffix', `memberbday`='$bd', `membergender`='$gender', `rtm`='$paymentmode' WHERE caseno='$caseno'");
  }
}

$bday=new DateTime($dob);
$ages=$bday->diff(new DateTime);

$ay=$ages->y;
$am=$ages->m;
$ad=$ages->d;

mysqli_query($conn,"UPDATE `patientprofile` SET `lastname`='$lastname', `firstname`='$firstname', `middlename`='$middlename', `suffix`='$suffix', `birthdate`='$bd', `age`='$ay', `sex`='$gender', `patientname`='$pname', `dateofbirth`='$dob' WHERE patientidno='$patientidno'");

$loguser=base64_decode($_SESSION['nm']);

$inlog="$loguser | `lastname`='$lastname', `firstname`='$firstname', `middlename`='$middlename', `suffix`='$suffix', `birthdate`='$bd', `age`='$ay', `sex`='$gender', `patientname`='$pname', `dateofbirth`='$dob'";

$pdate=date("Ymdhis");
$log = fopen("Logs/PatientName-$caseno-$pdate.txt", "w") or die("Unable to open file!");
fwrite($log, $inlog);
fclose($log);

echo "<META HTTP-EQUIV='Refresh'CONTENT='1;URL=Close.php'>";

?>

</body>
</html>
