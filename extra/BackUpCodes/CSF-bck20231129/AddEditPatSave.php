<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Saving...</title>
  <link rel="stylesheet" type="text/css" href="CSS/mystyle.css">
  <!-- Favicon -->
    <link rel="icon" href="../../rs/favicon/logo.png" type="image/png" />
    <link rel="shortcut icon" href="../../rs/favicon/logo.png" type="image/png" />

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
include('../Settings.php');
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

mysql_query('SET NAMES utf8');

$lastname=strtoupper(mysql_real_escape_string($_POST['lastname']));
$firstname=strtoupper(mysql_real_escape_string($_POST['firstname']));
$middlename=strtoupper(mysql_real_escape_string($_POST['middlename']));
$suffix=strtoupper(mysql_real_escape_string($_POST['suffix']));
$mm=mysql_real_escape_string($_POST['mm']);
$dd=mysql_real_escape_string($_POST['dd']);
$yy=mysql_real_escape_string($_POST['yy']);
$gender=mysql_real_escape_string($_POST['gender']);
$caseno=mysql_real_escape_string($_POST['caseno']);
$patientidno=mysql_real_escape_string($_POST['patientidno']);
$paymentmode=mysql_real_escape_string($_POST['paymentmode']);

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
</div>
";

if($paymentmode=="Member"){
  //claiminfo
  $asql=mysql_query("SELECT * FROM claiminfo WHERE patientidno='$patientidno' AND caseno='$caseno'");
  $acount=mysql_num_rows($asql);
  if($acount==0){
    mysql_query("INSERT INTO `claiminfo` (`patientidno`, `caseno`, `lastname`, `firstname`, `middlename`) VALUES ('$patientidno', '$caseno', '$lastname', '$firstname', '$middlename')");
  }
  else{
    mysql_query("UPDATE `claiminfo` SET `lastname`='$lastname', `firstname`='$firstname', `middlename`='$middlename' WHERE patientidno='$patientidno' AND caseno='$caseno'");
  }

  //claiminfoadd
  $bsql=mysql_query("SELECT * FROM claiminfoadd WHERE patientidno='$patientidno' AND caseno='$caseno'");
  $bcount=mysql_num_rows($bsql);
  if($bcount==0){
    mysql_query("INSERT INTO `claiminfoadd` (`patientidno`, `caseno`) VALUES ('$patientidno', '$caseno')");
  }

  //claiminfomoreinfo
  $csql=mysql_query("SELECT * FROM claiminfomoreinfo WHERE caseno='$caseno'");
  $ccount=mysql_num_rows($csql);
  if($ccount==0){
    mysql_query("INSERT INTO `claiminfomoreinfo` (`caseno`, `membersuffix`, `memberbday`, `membergender`, `rtm`) VALUES ('$caseno', '$suffix', '$bd', '$gender', '$paymentmode')");
  }
  else{
    mysql_query("UPDATE `claiminfomoreinfo` SET `membersuffix`='$suffix', `memberbday`='$bd', `membergender`='$gender', `rtm`='$paymentmode' WHERE caseno='$caseno'");
  }

}

$bday=new DateTime($dob);
$ages=$bday->diff(new DateTime);

$ay=$ages->y;
$am=$ages->m;
$ad=$ages->d;

mysql_query("UPDATE `patientprofile` SET `lastname`='$lastname', `firstname`='$firstname', `middlename`='$middlename', `suffix`='$suffix', `birthdate`='$bd', `age`='$ay', `sex`='$gender', `patientname`='$pname', `dateofbirth`='$dob' WHERE patientidno='$patientidno'");

session_start();
$loguser=$_COOKIE['nameofuser'];

$inlog="$loguser | `lastname`='$lastname', `firstname`='$firstname', `middlename`='$middlename', `suffix`='$suffix', `birthdate`='$bd', `age`='$ay', `sex`='$gender', `patientname`='$pname', `dateofbirth`='$dob'";

$pdate=date("Ymdhis");
$log = fopen("Logs/PatientName-$caseno-$pdate.txt", "w") or die("Unable to open file!");
fwrite($log, $inlog);
fclose($log);

echo "<META HTTP-EQUIV='Refresh'CONTENT='1;URL=Close.php'>";

?>

</body>
</html>
