<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Employer Information</title>
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

$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);

mysqli_query($conn,'SET NAMES utf8');

$adsql=mysqli_query($conn,"SELECT type FROM admission WHERE caseno='$caseno'");
$adfetch=mysqli_fetch_array($adsql);
$type=$adfetch['type'];

if(!isset($_GET['settype'])){
  $settype=$type;
}
else{
  $settype=mysqli_real_escape_string($_GET['settype']);
}

if($settype=="Employment-Govt"){$st1="selected";$st2="";$st3="";$st4="";$st5="";$st6="";$st7="";$st8="";$st9="";$st10="";$show="on";}
else if($settype=="Employment-Private"){$st1="";$st2="selected";$st3="";$st4="";$st5="";$st6="";$st7="";$st8="";$st9="";$st10="";$show="on";}
else if($settype=="Self-Employed"){$st1="";$st2="";$st3="selected";$st4="";$st5="";$st6="";$st7="";$st8="";$st9="";$st10="";$show="off";}
else if($settype=="OFW"){$st1="";$st2="";$st3="";$st4="selected";$st5="";$st6="";$st7="";$st8="";$st9="";$st10="";$show="off";}
else if($settype=="OWWA"){$st1="";$st2="";$st3="";$st4="";$st5="selected";$st6="";$st7="";$st8="";$st9="";$st10="";$show="off";}
else if($settype=="Indigent"){$st1="";$st2="";$st3="";$st4="";$st5="";$st6="selected";$st7="";$st8="";$st9="";$st10="";$show="off";}
else if($settype=="Pensioner"){$st1="";$st2="";$st3="";$st4="";$st5="";$st6="";$st7="selected";$st8="";$st9="";$st10="";$show="off";}
else if($settype=="NON PHIC"){$st1="";$st2="";$st3="";$st4="";$st5="";$st6="";$st7="";$st8="selected";$st9="";$st10="";$show="off";}
else if($settype=="Non Paying Private"){$st1="";$st2="";$st3="";$st4="";$st5="";$st6="";$st7="";$st8="";$st9="selected";$st10="";$show="off";}
else if($settype=="Non Paying Government"){$st1="";$st2="";$st3="";$st4="";$st5="";$st6="";$st7="";$st8="";$st9="";$st10="selected";$show="off";}
else{$st1="";$st2="";$st3="";$st4="";$st5="";$st6="";$st7="";$st8="";$st9="";$st10="";$show="off";}

if($show=="on"){
  $cimisql=mysqli_query($conn,"SELECT * FROM claiminfomoreinfo WHERE caseno='$caseno'");
  $cimicount=mysqli_num_rows($cimisql);
  if($cimicount==0){
    $emppen="";
    $empbusinessname="";
    $empname="";
    $empcontactno="";
    $empsigdesignation="";
    $empdatesigned="";
  }
  else{
    while($cimifetch=mysqli_fetch_array($cimisql)){
      $emppen=$cimifetch['emppen'];
      $empbusinessname=$cimifetch['empbusinessname'];
      $empname=$cimifetch['empname'];
      $empcontactno=$cimifetch['empcontactno'];
      $empsigdesignation=$cimifetch['empsigdesignation'];
      $empdatesigned=$cimifetch['empdatesigned'];
    }
  }

  if($empdatesigned!=""){
    $bdm=date("m",strtotime($empdatesigned));
    $bdd=date("d",strtotime($empdatesigned));
    $bdy=date("Y",strtotime($empdatesigned));
  }
  else{
    $bdm="";
    $bdd="";
    $bdy="";
  }
}

echo "
<div align='center'>
  <form name='Save' method='post' action='AddEditEmpDetailsSave.php' class='form-container-Edit'>
    <table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td colspan='3'><div align='center' class='arial s20 blue bold'>Employer Information</div></td>
      </tr>
      <tr>
        <td colspan='3' height='10'></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>PHIC Type</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td>
          <select onchange='change_url(this.value);' style='width: 250px;'>
            <option value='AddEditEmpDetails.php?caseno=$caseno&settype=Employment-Govt' $st1>Employment-Govt</option>
            <option value='AddEditEmpDetails.php?caseno=$caseno&settype=Employment-Private' $st2>Employment-Private</option>
            <option value='AddEditEmpDetails.php?caseno=$caseno&settype=Self-Employed' $st3>Self-Employed</option>
            <option value='AddEditEmpDetails.php?caseno=$caseno&settype=OFW' $st4>OFW</option>
            <option value='AddEditEmpDetails.php?caseno=$caseno&settype=OWWA' $st5>OWWA</option>
            <option value='AddEditEmpDetails.php?caseno=$caseno&settype=Indigent' $st6>Indigent</option>
            <option value='AddEditEmpDetails.php?caseno=$caseno&settype=Pensioner' $st7>Pensioner</option>
            <option value='AddEditEmpDetails.php?caseno=$caseno&settype=NON-PHIC' $st8>NON PHIC</option>
            <option value='AddEditEmpDetails.php?caseno=$caseno&settype=Non Paying Private' $st9>Non Paying Private</option>
            <option value='AddEditEmpDetails.php?caseno=$caseno&settype=Non Paying Government' $st10>Non Paying Government</option>
          </select>
        </td>
      </tr>
";

if($show=="on"){
echo "
      <tr>
        <td><div align='left' class='s14'>PEN</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='PhilHealth Employer No.' name='emppen' value='$emppen' autocomplete='off' maxlength='12' /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Business Name</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='Employer Business Name' name='empbusinessname' value='$empbusinessname' autocomplete='off'  /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Contact No.</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='Employer Contact No.' name='empcontactno' value='$empcontactno' autocomplete='off' /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Signatory</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='Employer or Authorized Representative' name='empname' value='$empname' autocomplete='off' /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Designation</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='Designation of Signatory' name='empsigdesignation' value='$empsigdesignation' autocomplete='off' /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Date Signed</div></td>
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

for($j=2020;$j<=date("Y")+5;$j++){
if($j==$bdy){$sy="selected='selected'";}else{$sy="";}
echo "
            <option $sy>$j</option>
";
}

echo "
          </select>
        </td>
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
    </table>
  <input type='hidden' name='caseno' value='$caseno' />
  <input type='hidden' name='type' value='$settype' />
  <input type='hidden' name='show' value='$show' />
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
