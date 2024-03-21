<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Consolidate List</title>
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
      max-width: 580px;
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
include("../../main/connection.php");

if(!isset($_POST['Save'])){
  $caseno=mysqli_real_escape_string($conn,$_GET['caseno']);
  $patid=mysqli_real_escape_string($conn,$_GET['patientidno']);
  $setuser=mysqli_real_escape_string($conn,$_GET['uname']);
  $dt=mysqli_real_escape_string($conn,$_GET['dt']);

  $dtd=date("d",strtotime($dt));
  $dtm=date("m",strtotime($dt));
  $dty=date("Y",strtotime($dt));

  if($dtd<16){$fd=$dty."-".$dtm."-"."01";$td=$dty."-".$dtm."-"."15";}
  else if($dtd>15){$fd=$dty."-".$dtm."-"."16";$td=$dty."-".$dtm."-"."31";}
  else{$fd=$dty."-".$dtm."-"."01";$td=$dty."-".$dtm."-"."31";}

  mysqli_query($conn,"SET NAMES 'utf8'");

  //patientprofile---------------------------------------------------------------------------------------------------------------
  $patsql=mysqli_query($conn,"SELECT `lastname`, `firstname`, `middlename`, `suffix`, `birthdate`, `sex` FROM `patientprofile` WHERE `patientidno`='$patid'");
  $patfetch=mysqli_fetch_array($patsql);
  $ln=strtoupper($patfetch['lastname']);
  $fn=strtoupper($patfetch['firstname']);
  $mn=strtoupper($patfetch['middlename']);
  $sf=strtoupper($patfetch['suffix']);
  $bd=date("Y-m-d",strtotime($patfetch['birthdate']));
  $sx=strtoupper($patfetch['sex']);

  if($sf!=""){$sf=" ".$sf;}
  else{$sf="";}

  $name=$ln.", ".$fn.$sf." ".$mn;

  $dateOfBirth=date("Y-m-d");
  $today = $bd;
  $diff = date_diff(date_create($dateOfBirth), date_create($today));
  $ager=$diff->format('%y');
  //-----------------------------------------------------------------------------------------------------------------------------

  //check if present in rduconsolidate-------------------------------------------------------------------------------------------
  $rcsql=mysqli_query($conn,"SELECT * FROM `rduconsolidate` WHERE `caseno`='$caseno'");
  $rccount=mysqli_num_rows($rcsql);
  //-----------------------------------------------------------------------------------------------------------------------------

  if($rccount==0){
echo "
<div align='center'><table border='0' style='height: 100%;width: 100%;position: absolute;top: 0;bottom: 0;left: 0;right: 0;' cellpadding='0' cellspacing='0'>
  <tr>
    <td valign='top'><div align='center'><form name='Save' method='post' class='form-container-Edit'>
      <table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td><div align='center' class='arial s20 blue bold'>Patient List</div></td>
        </tr>
        <tr>
          <td height='10'></td>
        </tr>
        <tr>
          <td><div align='center'>
            <table border='0' cellpadding='0' cellspacing='0'>
              <tr>
                <td class='t2 b2 l2' style='background-color: #00B9FF;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #FFFFFF;padding: 5px;'>#</div></td>
                <td class='t2 b2 l1' style='background-color: #00B9FF;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #FFFFFF;padding: 5px;'></div></td>
                <td class='t2 b2 l1' style='background-color: #00B9FF;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #FFFFFF;padding: 5px;'>Case No.</div></td>
                <td class='t2 b2 l1' style='background-color: #00B9FF;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #FFFFFF;padding: 5px;'>Patient Name</div></td>
                <td class='t2 b2 l1 r2' style='background-color: #00B9FF;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #FFFFFF;padding: 5px;'>Date Transaction</div></td>
              </tr>
";


    $a=0;
    $asql=mysqli_query($conn,"SELECT `caseno`, `dateadmit` FROM `admission` WHERE `patientidno`='$patid' AND `dateadmit` BETWEEN '$fd' AND '$td' AND `ward` <> 'CANCELLED' AND `caseno` LIKE 'R-%' AND `membership`='phic-med' ORDER BY `dateadmit` ASC");
    while($afetch=mysqli_fetch_array($asql)){
      $lscaseno=$afetch['caseno'];
      $da=$afetch['dateadmit'];
      $dateadmit=date("M d, Y",strtotime($afetch['dateadmit']));

      //check if present in rduconsolidate---------------------------------------------------------------------------------------
      $crcsql=mysqli_query($conn,"SELECT * FROM `rduconsolidate` WHERE `caseno`='$lscaseno'");
      $crccount=mysqli_num_rows($crcsql);
      //-------------------------------------------------------------------------------------------------------------------------

      if($crccount==0){
        $a++;
echo "
              <tr>
                <td class='b1 l2' style='background-color: #FFFFFF;'><div align='left' style='font-family: arial;font-size: 13px;padding: 5px;color: #000000;'>$a</div></td>
                <td class='b1 l1' style='background-color: #FFFFFF;'><div align='center' style='font-family: arial;font-size: 13px;padding: 5px;color: #000000;'><input type='checkbox' name='caseno[]' value='$lscaseno' checked /><input type='hidden' name='da[]' value='$da' /></div></td>
                <td class='b1 l1' style='background-color: #FFFFFF;'><div align='left' style='font-family: arial;font-size: 13px;padding: 5px;color: #000000;'>$lscaseno</div></td>
                <td class='b1 l1' style='background-color: #FFFFFF;'><div align='left' style='font-family: arial;font-size: 13px;padding: 5px;color: #000000;'>$name</div></td>
                <td class='b1 l1 r2' style='background-color: #FFFFFF;'><div align='center' style='font-family: arial;font-size: 13px;padding: 5px;color: #000000;'>$dateadmit</div></td>
              </tr>
";
      }
    }

echo "
              <tr>
                <td class='t1 b2 l2 r2' colspan='5' height='5' style='background-color: #00B9FF;'></td>
              </tr>
            </table>
          </div></td>
        </tr>
        <tr>
          <td height='10'></td>
        </tr>
        <tr>
          <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='49%'><div align='right'><button type='button' class='btn cancel' style='border-radiues: 5px;' onclick='closeme()'>Close</button></div></td>
              <td width='2%'></td>
              <td width='49%'><div align='left'><button type='submit' name='Save' class='btn' style='border-radiues: 5px;'>Save</button></div></td>
            </tr>
          </table></td>
        </tr>
      </table>
      <input type='hidden' name='setuser' value='$setuser' />
      <input type='hidden' name='patid' value='$patid' />
      <input type='hidden' name='patname' value='$name' />
      </form></div></td>
    </tr>
  </table>
</div>
";
  }
  else{
echo "
<div align='center'>
  <table border='0' style='height: 100%;width: 100%;position: absolute;top: 0;bottom: 0;left: 0;right: 0;' cellpadding='0' cellspacing='0'>
    <tr>
      <td valign='middle'><div align='center' style='color: #FF0000;font-family: arial;font-size: 16px;font-weight: bold;'> ERROR!!! Patient Already Added!<br /><br /><span style='color: black;'>&quot;$name&quot;<br />".date("M d, Y",strtotime($dt))."</span></div></td>
    </tr>
  </table>
</div>
";
  }
}

if(isset($_POST['Save'])){
  $setuser=mysqli_real_escape_string($conn,$_POST['setuser']);
  $patid=mysqli_real_escape_string($conn,$_POST['patid']);
  $patname=mb_strtoupper(trim(mysqli_real_escape_string($conn,$_POST['patname'])));

  if(isset($_POST['caseno'])){
    $rducaseno="RC-".date("YmdHis");

echo "
<div align='center'>
  <table border='0' style='height: 100%;width: 100%;position: absolute;top: 0;bottom: 0;left: 0;right: 0;' cellpadding='0' cellspacing='0'>
    <tr>
      <td valign='middle'><div align='center'>
";
    $case=$_POST['caseno'];
    $dat=$_POST['da'];

    $xcount=sizeof($case);
    for($x=0;$x<$xcount;$x++){
      mysqli_query($conn,"SET NAMES 'utf8'");
      mysqli_query($conn,"INSERT INTO `rduconsolidate`(`rducaseno`, `patid`, `patientname`, `caseno`, `dateadmit`, `addedby`, `datetime`, `remarks`) VALUES ('$rducaseno', '$patid', '$patname', '".trim($case[$x])."', '".trim($dat[$x])."', '$setuser', '".date("Y-m-d H:i:s")."', '')");
    }

echo "
        <span style='color: blue;font-size; 16px;font-family: arial;font-weight: bold;'>Added Successfully!!!</span>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='2;URL=Close.php'>";
  }
  else{
    echo "ERROR!!!";
  }
echo "
      </div></td>
    </tr>
  </table>
</div>
";
}
?>

<script>
  function closeme() {
    window.close();
  }
</script>

</body>
</html>
