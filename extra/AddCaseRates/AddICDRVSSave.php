<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Saving...</title>
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

$idno=mysqli_real_escape_string($mycon1,$_POST['idno']);
$user=mysqli_real_escape_string($mycon1,$_POST['user']);
$icdcode=mb_strtoupper(mysqli_real_escape_string($mycon1,$_POST['icdcode']));
$category=mysqli_real_escape_string($mycon1,$_POST['category']);
$groupid=mysqli_real_escape_string($mycon1,$_POST['groupid']);
$description=mb_strtoupper(mysqli_real_escape_string($mycon1,$_POST['description']));
$hospital=mysqli_real_escape_string($mycon1,$_POST['hospital']);
$pf=mysqli_real_escape_string($mycon1,$_POST['pf']);
$hospital2=mysqli_real_escape_string($mycon1,$_POST['hospital2']);
$pf2=mysqli_real_escape_string($mycon1,$_POST['pf2']);
$groupdiag=mb_strtoupper(mysqli_real_escape_string($mycon1,$_POST['groupdiag']));

echo "
<div align='center'>
    <table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td><div align='center' class='arial s16 blue bold'>Saving changes...</div></td>
      </tr>
    </table>
</div>
";

//LOGS
if(!is_dir("Logs/Edit/$icdcode")){
mkdir("Logs/Edit/$icdcode", 0777, true);
exec("chmod 777 Logs/Edit/$icdcode/");
}
$pdate=date("YmdHis");
mysqli_query($mycon1,"SELECT * FROM `caserates` WHERE `idno`='$idno' INTO OUTFILE '/opt/lampp/htdocs/2022codes/AddCaseRates/Logs/Edit/$icdcode/$icdcode-$user-$pdate.txt' FIELDS TERMINATED BY '|'");
//END LOGS

mysqli_query($mycon1,"UPDATE `caserates` SET `icdcode`='$icdcode', `description`='$description', `actualcaseratenew`='".($hospital+$pf)."', `hospitalnew`='$hospital', `pfnew`='$pf', `actualcaserate2new`='".($hospital2+$pf2)."', `hospital2new`='$hospital2', `pf2new`='$pf2', `groupid`='$groupid', `groupdiag`='$groupdiag', `category`='$category', `rvscode`='$icdcode' WHERE `idno`='$idno'");

echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=Close.php'>";

?>

</body>
</html>
