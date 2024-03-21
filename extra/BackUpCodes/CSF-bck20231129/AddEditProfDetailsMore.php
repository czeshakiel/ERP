<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Health Care Professional Information</title>
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
      .form-container-Edit input[type=text], .form-container-Edit input[type=number], .form-container-Edit input[type=password] {
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
      .btn2 {
      background-color: #9b0cca;
      color: #fff;
      padding: 5px;
      font-size: 20px;
      font-weight: bold;
      border-radius: 20px;
      border: none;
      cursor: pointer;
      width: 40px;
      height: 40px;
      opacity: 0.8;
      }
      /* Hover effects for buttons */
      .btn2:hover {
      opacity: 0.6;
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
include('../Settings.php');
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$caseno=mysql_real_escape_string($_GET['caseno']);

mysql_query('SET NAMES utf8');


$asql=mysql_query("SELECT * FROM `claiminfoadd2` WHERE `caseno`='$caseno'");
$acount=mysql_num_rows($asql);

if($acount==0){
  $doctor4="";
  $datesigned4="";
  $copay4="";
  $doctor5="";
  $datesigned5="";
  $copay5="";
  $doctor6="";
  $datesigned6="";
  $copay6="";
  $doctor7="";
  $datesigned7="";
  $copay7="";
  $doctor8="";
  $datesigned8="";
  $copay8="";
  $doctor9="";
  $datesigned9="";
  $copay10="";
  $doctor10="";
  $datesigned10="";
  $copay10="";
}
else{
  $afetch=mysql_fetch_array($asql);
  $doctor4=$afetch['doctor4'];
  $datesigned4=$afetch['datesigned4'];
  $copay4=$afetch['copay4'];
  $doctor5=$afetch['doctor5'];
  $datesigned5=$afetch['datesigned5'];
  $copay5=$afetch['copay5'];
  $doctor6=$afetch['doctor6'];
  $datesigned6=$afetch['datesigned6'];
  $copay6=$afetch['copay6'];
  $doctor7=$afetch['doctor7'];
  $datesigned7=$afetch['datesigned7'];
  $copay7=$afetch['copay7'];
  $doctor8=$afetch['doctor8'];
  $datesigned8=$afetch['datesigned8'];
  $copay8=$afetch['copay8'];
  $doctor9=$afetch['doctor9'];
  $datesigned9=$afetch['datesigned9'];
  $copay10=$afetch['copay10'];
  $doctor10=$afetch['doctor10'];
  $datesigned10=$afetch['datesigned10'];
  $copay10=$afetch['copay10'];
}

if($datesigned4!=""){
  if($datesigned4=="0000-00-00"){
    $bdm4=date("m");
    $bdd4=date("d");
    $bdy4=date("Y");
  }
  else{
    $bdm4=date("m",strtotime($datesigned4));
    $bdd4=date("d",strtotime($datesigned4));
    $bdy4=date("Y",strtotime($datesigned4));
  }
}
else{
  $bdm4=date("m");
  $bdd4=date("d");
  $bdy4=date("Y");
}

if($datesigned5!=""){
  if($datesigned5=="0000-00-00"){
    $bdm5=date("m");
    $bdd5=date("d");
    $bdy5=date("Y");
  }
  else{
    $bdm5=date("m",strtotime($datesigned5));
    $bdd5=date("d",strtotime($datesigned5));
    $bdy5=date("Y",strtotime($datesigned5));
  }
}
else{
  $bdm5=date("m");
  $bdd5=date("d");
  $bdy5=date("Y");
}

if($datesigned6!=""){
  if($datesigned6=="0000-00-00"){
    $bdm6=date("m");
    $bdd6=date("d");
    $bdy6=date("Y");
  }
  else{
    $bdm6=date("m",strtotime($datesigned6));
    $bdd6=date("d",strtotime($datesigned6));
    $bdy6=date("Y",strtotime($datesigned6));
  }
}
else{
  $bdm6=date("m");
  $bdd6=date("d");
  $bdy6=date("Y");
}

if($datesigned7!=""){
  $bdm7=date("m",strtotime($datesigned7));
  $bdd7=date("d",strtotime($datesigned7));
  $bdy7=date("Y",strtotime($datesigned7));
}
else{
  $bdm7=date("m");
  $bdd7=date("d");
  $bdy7=date("Y");
}

if($datesigned8!=""){
  $bdm8=date("m",strtotime($datesigned8));
  $bdd8=date("d",strtotime($datesigned8));
  $bdy8=date("Y",strtotime($datesigned8));
}
else{
  $bdm8=date("m");
  $bdd8=date("d");
  $bdy8=date("Y");
}

if($datesigned9!=""){
  $bdm9=date("m",strtotime($datesigned9));
  $bdd9=date("d",strtotime($datesigned9));
  $bdy9=date("Y",strtotime($datesigned9));
}
else{
  $bdm9=date("m");
  $bdd9=date("d");
  $bdy9=date("Y");
}

if($datesigned10!=""){
  $bdm10=date("m",strtotime($datesigned10));
  $bdd10=date("d",strtotime($datesigned10));
  $bdy10=date("Y",strtotime($datesigned10));
}
else{
  $bdm10=date("m");
  $bdd10=date("d");
  $bdy10=date("Y");
}

echo "
<div align='center'>
  <form name='Save' method='post' action='AddEditProfDetailsMoreSave.php' class='form-container-Edit'>
    <table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td colspan='3'><div align='center' class='arial s20 blue bold'>More Health Care Professional Information</div></td>
      </tr>
      <tr>
        <td colspan='3' height='10'></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Doctor 4</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td>
          <select name='doctor4' style='width: 250px;'>
            <option value=''></option>
";

$bsql=mysql_query("SELECT phicacc, lastname, firstname, middlename, suffix FROM docdetails ORDER BY lastname");
while($bfetch=mysql_fetch_array($bsql)){
$phicacc1=$bfetch['phicacc'];
$ln=$bfetch['lastname'];
$fn=$bfetch['firstname'];
$mn=$bfetch['middlename'];
$sf=$bfetch['suffix'];

$csql=mysql_query("SELECT name FROM docfile WHERE phicacc='$phicacc1'");
$cfetch=mysql_fetch_array($csql);
$name=strtoupper($cfetch['name']);

if($doctor4==$name){$sd1="selected='selected'";}
else{
  if(($ln=="LASTNAME")&&($doctor4=="")){
    $sd1="selected='selected'";
  }
  else{
    $sd1="";
  }
}

echo "
            <option value='$phicacc1' $sd1>$ln, $fn $mn $sf</option>
";
}

echo "
          </select>
        </td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Co-Pay</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='number' placeholder='Co-Pay' name='copay4' value='$copay4' autocomplete='off' maxlength='12' /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Date Signed</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td>
          <select name='mm4'>
            <option value=''>MM</option>
";

for($l=1;$l<=12;$l++){
if($l<10){$lf="0".$l;}else{$lf=$l;}
if($lf==$bdm4){$sm="selected='selected'";}else{$sm="";}
$dl=date("M",strtotime("2020-$lf-01"));
echo "
            <option value='$lf' $sm>$dl</option>
";
}

echo "
          </select>
          <select name='dd4'>
            <option value=''>DD</option>
";

for($k=1;$k<=31;$k++){
if($k<10){$kf="0".$k;}else{$kf=$k;}
if($kf==$bdd4){$sd="selected='selected'";}else{$sd="";}
echo "
            <option value='$kf' $sd>$kf</option>
";
}

echo "
          </select>
          <select name='yy4'>
            <option value=''>YYYY</option>
";

for($j=2020;$j<=date("Y")+5;$j++){
if($j==$bdy4){$sy="selected='selected'";}else{$sy="";}
echo "
            <option $sy>$j</option>
";
}

echo "
          </select>
        </td>
      </tr>
      <tr>
        <td colspan='3' height='10'></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Doctor 5</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td>
          <select name='doctor5' style='width: 250px;'>
            <option value=''></option>
";

$dsql=mysql_query("SELECT phicacc, lastname, firstname, middlename, suffix FROM docdetails ORDER BY lastname");
while($dfetch=mysql_fetch_array($dsql)){
$phicacc2=$dfetch['phicacc'];
$ln2=$dfetch['lastname'];
$fn2=$dfetch['firstname'];
$mn2=$dfetch['middlename'];
$sf2=$dfetch['suffix'];

$esql=mysql_query("SELECT name FROM docfile WHERE phicacc='$phicacc2'");
$ecount=mysql_num_rows($esql);

$efetch=mysql_fetch_array($esql);
$name2=strtoupper($efetch['name']);

if($doctor5==$name2){$sd2="selected='selected'";}
else{
  if(($ln2=="LASTNAME")&&($doctor5=="")){
    $sd2="selected='selected'";
  }
  else{
    $sd2="";
  }
}

echo "
            <option value='$phicacc2' $sd2>$ln2, $fn2 $mn2 $sf2</option>
";
}

echo "
          </select>
        </td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Co-Pay</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='number' placeholder='Co-Pay' name='copay5' value='$copay5' autocomplete='off' maxlength='12' /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Date Signed</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td>
          <select name='mm5'>
            <option value=''>MM</option>
";

for($l=1;$l<=12;$l++){
if($l<10){$lf="0".$l;}else{$lf=$l;}
if($lf==$bdm5){$sm="selected='selected'";}else{$sm="";}
$dl=date("M",strtotime("2020-$lf-01"));
echo "
            <option value='$lf' $sm>$dl</option>
";
}

echo "
          </select>
          <select name='dd5'>
            <option value=''>DD</option>
";

for($k=1;$k<=31;$k++){
if($k<10){$kf="0".$k;}else{$kf=$k;}
if($kf==$bdd5){$sd="selected='selected'";}else{$sd="";}
echo "
            <option value='$kf' $sd>$kf</option>
";
}

echo "
          </select>
          <select name='yy5'>
            <option value=''>YYYY</option>
";

for($j=2020;$j<=date("Y")+5;$j++){
if($j==$bdy5){$sy="selected='selected'";}else{$sy="";}
echo "
            <option $sy>$j</option>
";
}

echo "
          </select>
        </td>
      </tr>
      <tr>
        <td colspan='3' height='10'></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Doctor 6</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td>
          <select name='doctor6' style='width: 250px;'>
            <option value=''></option>
";

$fsql=mysql_query("SELECT phicacc, lastname, firstname, middlename, suffix FROM docdetails ORDER BY lastname");
while($ffetch=mysql_fetch_array($fsql)){
$phicacc3=$ffetch['phicacc'];
$ln3=$ffetch['lastname'];
$fn3=$ffetch['firstname'];
$mn3=$ffetch['middlename'];
$sf3=$ffetch['suffix'];

$gsql=mysql_query("SELECT name FROM docfile WHERE phicacc='$phicacc3'");
$gfetch=mysql_fetch_array($gsql);
$name3=strtoupper($gfetch['name']);

if($doctor6==$name3){$sd3="selected='selected'";}else{$sd3="";}

echo "
            <option value='$phicacc3' $sd3>$ln3, $fn3 $mn3 $sf3</option>
";
}

echo "
          </select>
        </td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Co-Pay</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='number' placeholder='Co-Pay' name='copay6' value='$copay3' autocomplete='off' maxlength='12' /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Date Signed</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td>
          <select name='mm6'>
            <option value=''>MM</option>
";

for($l=1;$l<=12;$l++){
if($l<10){$lf="0".$l;}else{$lf=$l;}
if($lf==$bdm6){$sm="selected='selected'";}else{$sm="";}
$dl=date("M",strtotime("2020-$lf-01"));
echo "
            <option value='$lf' $sm>$dl</option>
";
}

echo "
          </select>
          <select name='dd6'>
            <option value=''>DD</option>
";

for($k=1;$k<=31;$k++){
if($k<10){$kf="0".$k;}else{$kf=$k;}
if($kf==$bdd6){$sd="selected='selected'";}else{$sd="";}
echo "
            <option value='$kf' $sd>$kf</option>
";
}

echo "
          </select>
          <select name='yy6'>
            <option value=''>YYYY</option>
";

for($j=2020;$j<=date("Y")+5;$j++){
if($j==$bdy6){$sy="selected='selected'";}else{$sy="";}
echo "
            <option $sy>$j</option>
";
}

echo "
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
  </form>
</div>
<br />
<div align='right'>
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><a href='AddEditProfDetailsMorePlus.php?caseno=$caseno'><div align='left'><button type='submit' class='btn2' title='Add More Doctor'>+</button></a></td>
      <td width='10'></td>
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
