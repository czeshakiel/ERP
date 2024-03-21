<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Saving...</title>
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

$idno=mysqli_real_escape_string($conn,$_POST['idno']);
$level=mysqli_real_escape_string($conn,$_POST['level']);
$caseno=mysqli_real_escape_string($conn,$_POST['caseno']);
$user=base64_decode(mysqli_real_escape_string($conn,$_POST['user']));
$frm=mysqli_real_escape_string($conn,$_POST['frm']);
$rvauto=mysqli_real_escape_string($conn,$_POST['rvauto']);

echo "
<div align='center'>
    <table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td><div align='center' class='arial s16 blue bold'>Saving changes...</div></td>
      </tr>
    </table>
</div>
";

$histype="tertiary";

$asql=mysqli_query($conn,"SELECT `icdcode`, `description`, `actualcaserate`, `hospital`, `pf`, `actualcaserate2`, `hospital2`, `pf2`, `actualcaserate3`, `hospital3`, `pf3`, `category`, `annex` FROM `caserates` WHERE `idno`='$idno'");
$afetch=mysqli_fetch_array($asql);
$icdcode=$afetch['icdcode'];
$description=$afetch['description'];
$actualcaserate=$afetch['actualcaserate'];
$hospital=$afetch['hospital'];
$pf=$afetch['pf'];
$actualcaserate2=$afetch['actualcaserate2'];
$hospital2=$afetch['hospital2'];
$pf2=$afetch['pf2'];
$actualcaserate3=$afetch['actualcaserate3'];
$hospital3=$afetch['hospital3'];
$pf3=$afetch['pf3'];
$category=$afetch['category'];
$rvu=$afetch['annex'];

if($histype=="tertiary"){
  if($level=="primary"){
    $hs=$hospital;
    $ps=$pf;
  }
  else if($level=="secondary"){
    $hs=$hospital2;
    $ps=$pf2;
  }
  else{
    $hs=0;
    $ps=0;
  }
}
else if($histype=="primary"){
  $hs=$hospital3;
  $ps=$pf3;
}
else{
  $hs=0;
  $ps=0;
}

if($category=="medical"){
  $type="icd";
}
else if($category=="surgical"){
  $type="rvs";
}
else{
  $type="icd";
}

if($frm=="con"){
  $con=$rvauto;

  mysqli_query($conn,"UPDATE `finalcaserate` SET `con`='' WHERE `con`='$rvauto'");
}
else{
  $con="";
}

//CREDIT LIMIT UPDATE------------------------------------------------------------------------------
//if(($level=="primary")||($level=="secondary")){
//$toths=0;
//$clfcsql=mysqli_query($conn,"SELECT SUM(`hospitalshare`) AS `toths` FROM `finalcaserate` WHERE `caseno`='$caseno' AND (`level`='primary' OR `level`='secondary')");
//$clfcfetch=mysqli_fetch_array($clfcsql);
//$toths=$clfcfetch['toths'];
//}

//$cl=$toths+$hs;

//mysqli_query($conn,"UPDATE `patientscredit` SET `creditlimit`='$cl' WHERE `caseno`='$caseno'");
//-------------------------------------------------------------------------------------------------

$datetime=date("Y-m-d H:i:s");

if($category=="surgical"){
$relatedprocedure=strtoupper(mysqli_real_escape_string($conn,$_POST['relatedprocedure']));
$dateofprocedure=mysqli_real_escape_string($conn,$_POST['dateofprocedure']);
$laterality=mysqli_real_escape_string($conn,$_POST['laterality']);

mysqli_query($conn,"INSERT INTO `finalcaserate` (`icdcode`, `hospitalshare`, `pfshare`, `caseno`, `level`, `description`, `desccf2`, `type`, `rvu`, `con`, `datetime`, `user`, `relatedprocedure`, `dateofprocedure`, `laterality`) VALUES ('$icdcode', '$hs', '$ps', '$caseno', '$level', '$description', '$description', '$type', '$rvu', '$con', '$datetime', '$user', '$relatedprocedure', '$dateofprocedure', '$laterality')");
}
else{
mysqli_query($conn,"INSERT INTO `finalcaserate` (`icdcode`, `hospitalshare`, `pfshare`, `caseno`, `level`, `description`, `desccf2`, `type`, `con`, `datetime`, `user`) VALUES ('$icdcode', '$hs', '$ps', '$caseno', '$level', '$description', '$description', '$type', '$con', '$datetime', '$user')");
}

echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=Close.php'>";

?>

</body>
</html>
