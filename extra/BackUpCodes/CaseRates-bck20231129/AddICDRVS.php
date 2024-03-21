<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Add Case Rate</title>
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
      /* Radio Look Like Checkbox*/
      .css-prp{color: #17CBF2;font-family: arial;}
      .con1 {display: block;position: relative;padding-left: 25px;margin-bottom: 12px;cursor: pointer;font-size: 15px;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;}

      /* Hide the browser's default radio button */
      .con1 input {position: absolute;opacity: 0;cursor: pointer;}

      /* Create a custom radio button */
      .checkmark {position: absolute;top: 0;left: 0;height: 18px;width: 18px;background-color: lightgrey;border-radius: 10%;}

      /* When the radio button is checked, add a blue background */
      .con1 input:checked ~ .checkmark {background-color: #17CBF2;}
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
$user=mysqli_real_escape_string($mycon1,$_GET['user']);
$idno=mysqli_real_escape_string($mycon1,$_GET['idno']);
$frm=mysqli_real_escape_string($mycon1,$_GET['frm']);
$rvauto=mysqli_real_escape_string($mycon1,$_GET['rvauto']);

$asql=mysqli_query($mycon1,"SELECT `icdcode`, `category`, `groupid` FROM `caserates` WHERE `idno`='$idno'");
$afetch=mysqli_fetch_array($asql);
$icdcode=$afetch['icdcode'];
$category=$afetch['category'];
$groupid=$afetch['groupid'];

if($category=="medical"){
  $disp="ICD Code";
}
else if($category=="surgical"){
  $disp="RVS Code";
}
else{
  $disp="Additional DX";
}

$bsql=mysqli_query($mycon1,"SELECT `autono` FROM `finalcaserate` WHERE `caseno`='$caseno'");
$bcount=mysqli_num_rows($bsql);

if($bcount!=0){
//1st caserate-----------------------------------
  $csql=mysqli_query($mycon1,"SELECT `autono`, `con` FROM `finalcaserate` WHERE `caseno`='$caseno' AND `level`='primary'");
  $ccount=mysqli_num_rows($csql);
//2nd caserate-----------------------------------
  $dsql=mysqli_query($mycon1,"SELECT `autono`, `con` FROM `finalcaserate` WHERE `caseno`='$caseno' AND `level`='secondary'");
  $dcount=mysqli_num_rows($dsql);
//-----------------------------------------------
}
else{
  $ccount=0;
  $dcount=0;
}

//SPOC Warning-----------------------------------
$esql=mysqli_query($mycon1,"SELECT `patientidno` FROM `admission` WHERE `caseno`='$caseno'");
$efetch=mysqli_fetch_array($esql);
$patientidno=$efetch['patientidno'];

$presdate=date("Y-m-d");
$val=date('Y-m-d',(strtotime('-90 day',strtotime($presdate))));

$fsql=mysqli_query($mycon1,"SELECT f.`icdcode`, a.`caseno`, d.`datearray` FROM `admission` a, `dischargedtable` d, `finalcaserate` f, `caserates` c WHERE a.`patientidno`='$patientidno' AND a.`caseno` NOT LIKE '$caseno' AND a.`caseno`=d.`caseno` AND a.`caseno`=f.`caseno` AND f.`icdcode`=c.`icdcode` AND (d.`datearray` BETWEEN '$val' AND '$presdate') AND (f.`level`='primary' OR f.`level`='secondary') AND c.`groupid`='$groupid'");
$fcount=mysqli_num_rows($fsql);
//-----------------------------------------------

$gsql=mysqli_query($mycon1,"SELECT `icdcode` FROM `finalcaserate` WHERE `caseno`='$caseno' AND `icdcode`='$icdcode'");
$gcount=mysqli_num_rows($gsql);

$hcount=0;
if($frm=="con"){
  $hsql=mysqli_query($mycon1,"SELECT `con` FROM `finalcaserate` WHERE `con`='$rvauto'");
  $hcount=mysqli_num_rows($hsql);
}

echo "
<div align='center'>
  <table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; center: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='center'>
        <form name='Save' method='post' action='AddICDRVSSave.php' class='form-container-Edit'>
          <table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='center' class='arial s20 blue bold'>Add Case Rate</div></td>
            </tr>
            <tr>
              <td height='10'></td>
            </tr>
";

if($gcount!=0){
echo "
            <tr>
              <td><div align='center'><span class='arial s14 red bold'>DUPLICATE ERROR!!! $disp is already added to this patient.</span></div></td>
            </tr>
            <tr>
              <td height='3'></td>
            </tr>
            <tr>
              <td colspan='3' height='20'></td>
            </tr>
            <tr>
              <td colspan='3'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td><div align='center'><button type='button' class='btn cancel' onclick='closeme()'>Close</button></div></td>
                </tr>
              </table></td>
            </tr>
";
}
else{
if($hcount!=0){
echo "
            <tr>
              <td><div align='center'><span class='arial s14 red bold'>WARNING!!! Another &quot;$disp&quot; is already set for this RVS Code. Remove the set &quot;$disp&quot; first.</span></div></td>
            </tr>
            <tr>
              <td height='3'></td>
            </tr>
            <tr>
              <td colspan='3' height='20'></td>
            </tr>
            <tr>
              <td colspan='3'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td><div align='center'><button type='button' class='btn cancel' onclick='closeme()'>Close</button></div></td>
                </tr>
              </table></td>
            </tr>
";
}
else{
if($fcount!=0){
echo "
            <tr>
              <td><div align='center'><span class='arial s14 red bold'>SPOC WARNING!!! System detected patient has previous admission with simmilar diagnosis.</span><br /><span class='arial s10 blue'>* Ignore if patient is undergoing Chemotheraphy or Hemodialysis.</span></div></td>
            </tr>
            <tr>
              <td height='3'></td>
            </tr>
";
}

echo "
            <tr>
              <td><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td><div align='left' class='s14 bold'>$disp</div></td>
                  <td width='10'><div align='center' class='s14'>:</div></td>
                  <td><input type='text' placeholder='$disp' name='icdcode' value='$icdcode' autocomplete='off' style='width: 250px;height: 40px;' readonly /></td>
                </tr>
                <tr>
                  <td><div align='left' class='s14 bold'>Type</div></td>
                  <td width='10'><div align='center' class='s14'>:</div></td>
                  <td><select name='level' style='width: 250px;height: 40px;'>
";

if($disp!="Additional DX"){
if($ccount==0){
echo "
                    <option value='primary'>Primary Case Rate</option>
";
}

if($dcount==0){
echo "
                    <option value='secondary'>Secondary Case Rate</option>
";
}
}

echo "
                    <option value='additional'>for Additional Diagnosis</option>
                  </select></td>
                </tr>
";

if($category=="surgical"){
echo "
                <tr>
                  <td><div align='left' class='s14 bold'>Related Procedure</div></td>
                  <td width='10'><div align='center' class='s14'>:</div></td>
                  <td>
";

echo '
                    <textarea name="relatedprocedure" onkeypress="return handleEnter(this, event)" style="width: 250px;height: 100px;"></textarea>
';

echo "
                  </td>
                </tr>
                <tr>
                  <td><div align='left' class='s14 bold'>Date of Procedure</div></td>
                  <td width='10'><div align='center' class='s14'>:</div></td>
                  <td><input type='date' placeholder='Date of Procedure' name='dateofprocedure' value='' autocomplete='off' style='width: 250px;height: 40px;' /></td>
                </tr>
                <tr>
                  <td colspan='3' height='10'></td>
                </tr>
                <tr>
                  <td><div align='left' class='s14 bold'>Laterality</div></td>
                  <td width='10'><div align='center' class='s14'>:</div></td>
                  <td><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><table border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td><input type='radio' name='laterality' value='' style='display: none;' checked  /><label class='con1'><span>Left</span><input type='radio' name='laterality' value='L' /><span class='checkmark'></span></label></td>
                          <td width='4'></td>
                          <td><label class='con1'><span>Right</span><input type='radio' name='laterality' value='R' /><span class='checkmark'></span></label></td>
                          <td width='4'></td>
                          <td><label class='con1'><span>Both</span><input type='radio' name='laterality' value='B' /><span class='checkmark'></span></label></td>
                          <td width='4'></td>
                          <td><label class='con1'><span>N/A</span><input type='radio' name='laterality' value='N' /><span class='checkmark'></span></label></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                </tr>
";
}

echo "
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
";
}
}

echo "
              </table></div></td>
            </tr>
          </table>
        <input type='hidden' name='idno' value='$idno' />
        <input type='hidden' name='caseno' value='$caseno' />
        <input type='hidden' name='user' value='$user' />
        <input type='hidden' name='frm' value='$frm' />
        <input type='hidden' name='rvauto' value='$rvauto' />
        </form>
      </div></td>
    </tr>
  </table>
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
