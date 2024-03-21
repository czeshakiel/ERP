<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Add/Edit Member Information</title>
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
include('../../2021codes/Settings.php');
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$caseno=mysqli_real_escape_string($mycon1,$_GET['caseno']);
$user=mysqli_real_escape_string($mycon1,$_GET['uname']);

//mysqli_query($mycon1,"SET NAMES 'utf8'");

$asql=mysqli_query($mycon1,"SELECT * FROM `translist` WHERE `caseno`='$caseno'");
$afetch=mysqli_fetch_array($asql);
$claimnumber=$afetch['claimnumber'];
$pin=$afetch['pin'];
$membername=$afetch['membername'];
$patientname=$afetch['patientname'];
$mtype=$afetch['mtype'];
$age=$afetch['age'];
$sex=$afetch['sex'];
$dateadmitted=$afetch['dateadmitted'];
$datedischarged=$afetch['datedischarged'];
$finaldiagnosis=$afetch['finaldiagnosis'];
$roomandboard=$afetch['roomandboard'];
$labothers=$afetch['labothers'];
$meds=$afetch['meds'];
$or=$afetch['or'];
$pf=$afetch['pf'];

//Account Summary----------------------------------------------------------------------------------------------------------------
//Meds
$mdgross=0;
$asmdsql=mysqli_query($mycon1,"SELECT `sellingprice`, `quantity`, `adjustment`, `gross`, `hmo`, `phic`, `phic1`, `excess` FROM `productout` WHERE `caseno`='$caseno' AND `quantity` > 0 AND `trantype`='charge' AND `productsubtype`='PHARMACY/MEDICINE' AND `administration` NOT LIKE 'pending'");
while($asmdfetch=mysqli_fetch_array($asmdsql)){
  $mdgross+=$asmdfetch['phic']+$asmdfetch['phic1'];
}

//ROOM
$rmgross=0;
$asrmsql=mysqli_query($mycon1,"SELECT `sellingprice`, `quantity`, `adjustment`, `gross`, `hmo`, `phic`, `phic1`, `excess` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `productsubtype`='ROOM ACCOMODATION'");
while($asrmfetch=mysqli_fetch_array($asrmsql)){
  $rmgross+=$asrmfetch['phic']+$asrmfetch['phic1'];
}

//OTHERS
$otgross=0;
$asotsql=mysqli_query($mycon1,"SELECT `sellingprice`, `quantity`, `adjustment`, `gross`, `hmo`, `phic`, `phic1`, `excess` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `productsubtype` NOT LIKE 'ROOM ACCOMODATION' AND `productsubtype` NOT LIKE 'PHARMACY/MEDICINE' AND `productsubtype` NOT LIKE 'PROFESSIONAL FEE'");
while($asotfetch=mysqli_fetch_array($asotsql)){
  $otgross+=$asotfetch['phic']+$asotfetch['phic1'];
}

//OR
$orgross=0;

//PF
$pfgross=0;
$aspfsql=mysqli_query($mycon1,"SELECT `sellingprice`, `quantity`, `adjustment`, `gross`, `hmo`, `phic`, `phic1`, `excess` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `productsubtype`='PROFESSIONAL FEE'");
while($aspffetch=mysqli_fetch_array($aspfsql)){
  $pfgross+=$aspffetch['phic']+$aspffetch['phic1'];
}
//-------------------------------------------------------------------------------------------------------------------------------

echo "
<div align='center'>
  <form name='Save' method='post' action='EditPatientSave.php' class='form-container-Edit'>
    <table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td colspan='3'><div align='center' class='arial s20 blue bold'>Add to Pending List</div></td>
      </tr>
      <tr>
        <td colspan='3' height='10'></td>
      </tr>
      <tr>
        <td><div align='left' class='s14 bold'>PIN</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='PhilHealth Identification No.' name='pin' value='$pin' autocomplete='off' maxlength='12' style='width: 250px;height: 40px;' readonly /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14 bold'>Member Name</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='PHIC Member Name' name='memname' value='$membername' autocomplete='off' style='width: 250px;height: 40px;' readonly /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14 bold'>Patient Name</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='Patient Name' name='patname' value='$patientname' autocomplete='off' style='width: 250px;height: 40px;' readonly /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14 bold'>M / Age / Sex</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='Membership Type' name='mtype' value='$mtype' autocomplete='off' style='width: 50px;height: 40px;text-align: center;' readonly />
        &nbsp;/&nbsp;
        <input type='text' placeholder='Age' name='age' value='$age' autocomplete='off' style='width: 50px;height: 40px;text-align: center;' />
        &nbsp;/&nbsp;
        <input type='text' placeholder='Sex' name='sex' value='$sex' autocomplete='off' style='width: 50px;height: 40px;text-align: center;' /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14 bold'>Confinement</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
          <tr>
            <td width='123'><input type='date' placeholder='Date Admitted' name='dateadmit' value='$dateadmitted' autocomplete='off' style='width: 123px;height: 40px;font-size: 10px;' readonly /></td>
            <td width='4'></td>
            <td width='123'><input type='date' placeholder='Date Discharged' name='datedischarged' value='$datedischarged' autocomplete='off' style='width: 123px;height: 40px;font-size: 10px;' readonly /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><div align='left' class='s14 bold'>Final Diagnosis</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><textarea name='finaldiagnosis' placeholder='Final Diagnosis' style='width: 250px;height: 120px;font-size: 11px;' required>$finaldiagnosis</textarea></td>
      </tr>
      <tr>
        <td><div align='left' class='s14 bold' style='cursor: pointer;'";?> onclick="<?php echo "window.open('../../2017codes/SOA/StatementOfAccountPHICVer.php?caseno=$caseno&patientidno=$patid&uname=$user', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=60,left=300,width=1200,height=700');"; ?>" <?php echo ">Hospital Charges</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><div align='left'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <td width='60' valign='bottom'><div align='center' style='font-family: courier new;font-size: 12px;font-weight: bold;font-color: blue;'>Room & Board</div></td>
            <td width='3'></td>
            <td width='60' valign='bottom'><div align='center' style='font-family: courier new;font-size: 12px;font-weight: bold;font-color: blue;'>Lab / Others</div></td>
            <td width='4'></td>
            <td width='60' valign='bottom'><div align='center' style='font-family: courier new;font-size: 12px;font-weight: bold;font-color: blue;'>Meds.</div></td>
            <td width='3'></td>
            <td width='60' valign='bottom'><div align='center' style='font-family: courier new;font-size: 12px;font-weight: bold;font-color: blue;'>O. R.</div></td>
          </tr>
          <tr>
            <td colspan='7' height='5'></td>
          </tr>
          <tr>
            <td><div align='center'><input type='text' placeholder='room Type' name='roomandboard' value='".number_format($roomandboard,2,".","")."' autocomplete='off' style='width: 60px;height: 40px;text-align: center;font-size: 11px;' required /></div></td>
            <td></td>
            <td><div align='center'><input type='text' placeholder='room Type' name='labothers' value='".number_format($labothers,2,".","")."' autocomplete='off' style='width: 60px;height: 40px;text-align: center;font-size: 11px;' required /></div></td>
            <td></td>
            <td><div align='center'><input type='text' placeholder='room Type' name='meds' value='".number_format($meds,2,".","")."' autocomplete='off' style='width: 60px;height: 40px;text-align: center;font-size: 11px;' required /></div></td>
            <td></td>
            <td><div align='center'><input type='text' placeholder='room Type' name='or' value='".number_format($or,2,".","")."' autocomplete='off' style='width: 60px;height: 40px;text-align: center;font-size: 11px;' required /></div></td>
          </tr>
        </table></div></td>
      </tr>
      <tr>
        <td><div align='left' class='s14 bold' style='cursor: pointer;'";?> onclick="<?php echo "window.open('../../2017codes/SOA/StatementOfAccountPHICVer.php?caseno=$caseno&patientidno=$patid&uname=$user', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=60,left=300,width=1200,height=700');"; ?>" <?php echo ">PF Charges</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='Patient Name' name='pf' value='".number_format($pf,2,".","")."' autocomplete='off' style='width: 250px;height: 40px;' required /></td>
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
  <input type='hidden' name='user' value='$user' />
  <input type='hidden' name='caseno' value='$caseno' />
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
