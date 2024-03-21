<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Add to Black List</title>
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
include('../main/connection.php');

if(isset($_POST['proceed'])){
  $remarks=mb_strtoupper(trim(mysqli_real_escape_string($conn,$_POST['remarks'])));
  $pn=mysqli_real_escape_string($conn,$_POST['pn']);
  $patid=mysqli_real_escape_string($conn,$_POST['patid']);
  $user=mysqli_real_escape_string($conn,$_POST['user']);

echo "
<div align='center'>
  <form name='Save' method='post' class='form-container-Edit'>
    <table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; left: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td valign='middle'>
          <table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='center' class='arial s16 red bold'>Are you really sure you want to <span style='color: #000000;'><u>&quot;Black List&quot;</u></span><br /><span style='color: #8C1BF7;'><u>&quot;$pn&quot;</u></span>?</div></td>
            </tr>
            <tr>
              <td height='10'></td>
            </tr>
            <tr>
              <td>
                <table width='100%' border='0' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td width='49%'><div align='right'><a href='?patientidno=$patid&user=$user'><button type='button' class='btn cancel'>&nbsp; Back &nbsp;</button></a></div></td>
                    <td width='2%'></td>
                    <td width='49%'><div align='left'><button type='submit' name='confirm' class='btn'>Confirm</button></div></td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <input type='hidden' name='remarks' value='$remarks' />
    <input type='hidden' name='patid' value='$patid' />
    <input type='hidden' name='user' value='$user' />
  </form>
</div>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='300;URL=Close.php'>";
}
else{
  if(isset($_POST['confirm'])){
    $remarks=mysqli_real_escape_string($conn,$_POST['remarks']);
    $patid=mysqli_real_escape_string($conn,$_POST['patid']);
    $user=base64_decode(mysqli_real_escape_string($conn,$_POST['user']));

    mysqli_query($conn,"SET NAMES 'utf8'");
    //patientprofile-----------------------------------------------------------------------------------------------------------------
    $patsql=mysqli_query($conn,"SELECT `lastname`, `firstname`, `middlename`, `suffix`, `birthdate`, `sex` FROM `patientprofile` WHERE `patientidno`='$patid'");
    $patfetch=mysqli_fetch_array($patsql);
    $ln=strtoupper($patfetch['lastname']);
    $fn=strtoupper($patfetch['firstname']);
    $mn=strtoupper($patfetch['middlename']);
    $sf=strtoupper($patfetch['suffix']);
    $bd=date("Y-m-d",strtotime($patfetch['birthdate']));
    $sx=strtoupper($patfetch['sex']);

    if($sf!=""){
      $sf=" ".$sf;
    }
    else{
      $sf="";
    }

    if($mn!=""){$mni=" ".$mn;}else{$mni="";}
    if($sf!=""){$sfi=" ".$sf;}else{$sfi="";}
    $pn=$ln.", ".$fn.$sfi.$mni;

    $dateOfBirth=date("Y-m-d");
    $today = $bd;
    $diff = date_diff(date_create($dateOfBirth), date_create($today));
    $ager=$diff->format('%y');
    //-------------------------------------------------------------------------------------------------------------------------------

    mysqli_query($conn,"INSERT INTO `patientblacklist` (`patientidno`, `ln`, `fn`, `mn`, `sf`, `bd`, `dateset`, `user`, `remarks`) VALUES ('$patid', '$ln', '$fn', '$mn', '$sf', '$bd', '".date("Y-m-d H:i:s")."', '$user', '$remarks')");

echo "
<div align='center'>
  <form name='Save' method='post' class='form-container-Edit'>
    <table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; left: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td valign='middle'>
          <table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='center' class='arial s18 red bold'>Patient <span style='color: #000000;'><u>&quot;Black Listed&quot;</u></span>!!!</div></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </form>
</div>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='2;URL=Close.php'>";
  }
  else{
    $patid=mysqli_real_escape_string($conn,$_GET['patientidno']);
    $user=mysqli_real_escape_string($conn,$_GET['user']);

    mysqli_query($conn,"SET NAMES 'utf8'");
    //patientprofile-----------------------------------------------------------------------------------------------------------------
    $patsql=mysqli_query($conn,"SELECT `lastname`, `firstname`, `middlename`, `suffix`, `birthdate`, `sex` FROM `patientprofile` WHERE `patientidno`='$patid'");
    $patfetch=mysqli_fetch_array($patsql);
    $ln=strtoupper($patfetch['lastname']);
    $fn=strtoupper($patfetch['firstname']);
    $mn=strtoupper($patfetch['middlename']);
    $sf=strtoupper($patfetch['suffix']);
    $bd=date("Y-m-d",strtotime($patfetch['birthdate']));
    $sx=strtoupper($patfetch['sex']);

    if($sf!=""){
      $sf=" ".$sf;
    }
    else{
      $sf="";
    }

    if($mn!=""){$mn=" ".$mn;}else{$mn="";}
    if($sf!=""){$sf=" ".$sf;}else{$sf="";}
    $pn=$ln.", ".$fn.$sf.$mn;

    $dateOfBirth=date("Y-m-d");
    $today = $bd;
    $diff = date_diff(date_create($dateOfBirth), date_create($today));
    $ager=$diff->format('%y');
    //-------------------------------------------------------------------------------------------------------------------------------

echo "
<div align='center'>
  <form name='Save' method='post' class='form-container-Edit'>
    <table border='0' width='100%' cellpadding='0' cellspacing='0'>
      <tr>
        <td colspan='3'><div align='center' class='arial s20 blue bold'>Black List Patient</div></td>
      </tr>
      <tr>
        <td colspan='3' height='10'></td>
      </tr>
      <tr>
        <td width='95'><div align='left' class='s14 bold'>Patient Name</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='Patient Name' value='$pn' autocomplete='off' style='width: 100%;height: 40px;' readonly /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14 bold'>Reason</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><textarea name='remarks' placeholder='Black List Reason' style='width: 100%;height: 120px;font-size: 11px;' required></textarea></td>
      </tr>
      <tr>
        <td colspan='3' height='10'></td>
      </tr>
      <tr>
        <td colspan='3'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <td width='49%'><div align='right'><button type='button' class='btn cancel' onclick='closeme()'>&nbsp; Close &nbsp;</button></div></td>
            <td width='2%'></td>
            <td width='49%'><div align='left'><button type='submit' name='proceed' class='btn'>Proceed</button></div></td>
          </tr>
        </table></td>
      </tr>
    </table>
    <input type='hidden' name='pn' value='$pn' />
    <input type='hidden' name='patid' value='$patid' />
    <input type='hidden' name='user' value='$user' />
  </form>
</div>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='300;URL=Close.php'>";
  }
}
?>

<script>
  function closeme() {
    window.close();
  }
</script>

</body>
</html>
