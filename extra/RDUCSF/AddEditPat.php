<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Add/Edit Patient Information</title>
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
      .form-container-Edit input[type=text], .form-container-Edit input[type=password] {
      width: 250px;
      height: 40px;
      padding: 7px;
      margin: 5px 0 5px 0;
      border: none;
      background: #eee;
      }
            /* Full-width for input fields */
      .form-container-Edit select {
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
    <script type="text/javascript">
        function change_url(val) {
            window.location=val;
        }
    </script>
  </head>
<body>
<?php
ini_set("display_errors", "On");
include("../../main/connection.php");

mysqli_query($conn,"SET NAMES utf8");

$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);
$patientidno=mysqli_real_escape_string($conn,$_GET['patientidno']);
$paymentmode=mysqli_real_escape_string($conn,$_GET['paymentmode']);

mysqli_query($conn,'SET NAMES utf8');
$cfsql=mysqli_query($conn,"SELECT identificationno, UPPER(lastname) AS lastname, UPPER(firstname) AS firstname, UPPER(middlename) AS middlename FROM claiminfo WHERE patientidno='$patientidno' AND caseno='$caseno'");
$cfcount=mysqli_num_rows($cfsql);
if($cfcount==0){
  $cf2sql=mysqli_query($conn,"SELECT identificationno, UPPER(lastname) AS lastname, UPPER(firstname) AS firstname, UPPER(middlename) AS middlename FROM claiminfo WHERE patientidno='$patientidno' AND caseno NOT LIKE '$caseno' AND identificationno NOT LIKE '' AND lastname NOT LIKE ''");
  $cf2count=mysqli_num_rows($cf2sql);
  if($cf2count==0){
    $identificationno="";
    $mlname="";
    $mfname="";
    $mmname="";
  }
  else{
    $cf2fetch=mysqli_fetch_array($cf2sql);
    $identificationno=$cf2fetch['identificationno'];
    $mlname=$cf2fetch['lastname'];
    $mfname=$cf2fetch['firstname'];
    $mmname=$cf2fetch['middlename'];

  }

}
else{
  while($cffetch=mysqli_fetch_array($cfsql)){
    $identificationno=$cffetch['identificationno'];
    $mlname= $cffetch['lastname'];
    $mfname=$cffetch['firstname'];
    $mmname=$cffetch['middlename'];
  }
}

$cimisql=mysqli_query($conn,"SELECT * FROM claiminfomoreinfo WHERE caseno='$caseno'");
$cimicount=mysqli_num_rows($cimisql);
if($cimicount==0){
  $membersuffix="";
  $memberbday="";
  $membergender="";
  $rtm="";
}
else{
  while($cimifetch=mysqli_fetch_array($cimisql)){
    $membersuffix=$cimifetch['membersuffix'];
    $memberbday=$cimifetch['memberbday'];
    $membergender=$cimifetch['membergender'];
    $rtm=$cimifetch['rtm'];
  }
}

if($memberbday==""){
  $mm="";
  $md="";
  $my="";
}
else{
  $mm=date("m",strtotime($memberbday));
  $md=date("d",strtotime($memberbday));
  $my=date("Y",strtotime($memberbday));
}

$patpsql=mysqli_query($conn,"SELECT * FROM patientprofile WHERE patientidno='$patientidno'");
while($patpfetch=mysqli_fetch_array($patpsql)){
  $ln=$patpfetch['lastname'];
  $fn=$patpfetch['firstname'];
  $mn=$patpfetch['middlename'];
  $sf=$patpfetch['suffix'];
  $db=$patpfetch['dateofbirth'];
  $gf=$patpfetch['sex'];
}

$pmds=preg_split("/\-/",$db);
$pm=$pmds[1];
$pd=$pmds[2];
$py=$pmds[0];


$lnf=$ln;
$fnf=$fn;
$mnf=$mn;
$sff=$sf;
$gff=$gf;
$bdm=$pm;
$bdd=$pd;
$bdy=$py;


if($gff=="M"){$sg1="selected='selected'";$sg2="";}
else if($gff=="F"){$sg1="";$sg2="selected='selected'";}
else{$sg1="";$sg2="";}

echo "
<div align='center'>
  <form name='Save' method='post' action='AddEditPatSave.php' class='form-container-Edit'>
    <table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td colspan='3'><div align='center' class='arial s20 blue bold'>Patient Information</div></td>
      </tr>
      <tr>
        <td colspan='3' height='10'></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Last Name</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='Last Name' name='lastname' value='$lnf' autocomplete='off' required /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>First Name</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='First Name' name='firstname' value='$fnf' autocomplete='off' required /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Middle Name</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='Middle Name' name='middlename' value='$mnf' autocomplete='off' /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Suffix</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='Suffix' name='suffix' value='$sff' autocomplete='off' /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Birth Date</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td>
          <select name='mm'>
            <option value=''>MM</option>
";

for($l=1;$l<=12;$l++){
if($l<10){$lf="0".$l;}else{$lf=$l;}
if($lf==$bdm){$sm="selected='selected'";}else{$sm="";}
$dl=date("M",strtotime("2020-$lf-01"));
echo "
            <option value='$lf' $sm>$dl</option>
";
}

echo "
          </select>
          <select name='dd'>
            <option value=''>DD</option>
";

for($k=1;$k<=31;$k++){
if($k<10){$kf="0".$k;}else{$kf=$k;}
if($kf==$bdd){$sd="selected='selected'";}else{$sd="";}
echo "
            <option value='$kf' $sd>$kf</option>
";
}

echo "
          </select>
          <select name='yy'>
            <option value=''>YYYY</option>
";

for($j=1920;$j<=date("Y")+5;$j++){
if($j==$bdy){$sy="selected='selected'";}else{$sy="";}
echo "
            <option $sy>$j</option>
";
}

echo "
          </select>
        </td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Gender</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td>
          <select name='gender' style='width: 250px;'>
            <option value='M' $sg1>Male</option>
            <option value='F' $sg2>Female</option>
          </select>
        </td>
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
    </table>
  <input type='hidden' name='caseno' value='$caseno' />
  <input type='hidden' name='patientidno' value='$patientidno' />
  <input type='hidden' name='paymentmode' value='$paymentmode' />
  </form>
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
