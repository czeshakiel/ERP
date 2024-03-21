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


$asql=mysql_query("SELECT `doctor1`, `datesigned1`, `copay1`, `doctor2`, `datesigned2`, `copay2`, `doctor3`, `datesigned3`, `copay3` FROM `claiminfoadd` WHERE `caseno`='$caseno'");
$acount=mysql_num_rows($asql);

if($acount==0){
  $doctor1="";
  $datesigned1="";
  $copay1="";
  $doctor2="";
  $datesigned2="";
  $copay2="";
  $doctor3="";
  $datesigned3="";
  $copay3="";
}
else{
  $afetch=mysql_fetch_array($asql);
  $doctor1=$afetch['doctor1'];
  $datesigned1=$afetch['datesigned1'];
  $copay1=$afetch['copay1'];
  $doctor2=$afetch['doctor2'];
  $datesigned2=$afetch['datesigned2'];
  $copay2=$afetch['copay2'];
  $doctor3=$afetch['doctor3'];
  $datesigned3=$afetch['datesigned3'];
  $copay3=$afetch['copay3'];
}

if($datesigned1!=""){
  if($datesigned1=="0000-00-00"){
    $bdm=date("m");
    $bdd=date("d");
    $bdy=date("Y");
  }
  else{
    $bdm=date("m",strtotime($datesigned1));
    $bdd=date("d",strtotime($datesigned1));
    $bdy=date("Y",strtotime($datesigned1));
  }
}
else{
  $bdm=date("m");
  $bdd=date("d");
  $bdy=date("Y");
}

if($datesigned2!=""){
  if($datesigned2=="0000-00-00"){
    $bdm2=date("m");
    $bdd2=date("d");
    $bdy2=date("Y");
  }
  else{
    $bdm2=date("m",strtotime($datesigned2));
    $bdd2=date("d",strtotime($datesigned2));
    $bdy2=date("Y",strtotime($datesigned2));
  }
}
else{
  $bdm2=date("m");
  $bdd2=date("d");
  $bdy2=date("Y");
}

if($datesigned3!=""){
  if($datesigned3=="0000-00-00"){
    $bdm3=date("m");
    $bdd3=date("d");
    $bdy3=date("Y");
  }
  else{
    $bdm3=date("m",strtotime($datesigned3));
    $bdd3=date("d",strtotime($datesigned3));
    $bdy3=date("Y",strtotime($datesigned3));
  }
}
else{
  $bdm3=date("m");
  $bdd3=date("d");
  $bdy3=date("Y");
}

echo "
<div align='center'>
  <form name='Save' method='post' action='AddEditProfDetailsSave.php' class='form-container-Edit'>
    <table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td colspan='3'><div align='center' class='arial s20 blue bold'>Health Care Professional Information</div></td>
      </tr>
      <tr>
        <td colspan='3' height='10'></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Doctor 1</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td>
          <select name='doctor1' style='width: 250px;'>
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

if($doctor1==$name){$sd1="selected='selected'";}else{$sd1="";}

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
        <td><input type='number' placeholder='Co-Pay' name='copay1' value='$copay1' autocomplete='off' maxlength='12' /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Date Signed</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td>
          <select name='mm1'>
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
          <select name='dd1'>
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
          <select name='yy1'>
            <option value=''>YYYY</option>
";

for($j=2020;$j<=date("Y")+5;$j++){
  if($bdy=="-0001"){
    if($j==date("Y")){$sy="selected='selected'";}else{$sy="";}
  }
  else{
    if($j==$bdy){$sy="selected='selected'";}else{$sy="";}
  }

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
        <td><div align='left' class='s14'>Doctor 2</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td>
          <select name='doctor2' style='width: 250px;'>
            <option value=''></option>
";

$dsql=mysql_query("SELECT phicacc, lastname, firstname, middlename, suffix FROM docdetails");
while($dfetch=mysql_fetch_array($dsql)){
$phicacc2=$dfetch['phicacc'];
$ln2=$dfetch['lastname'];
$fn2=$dfetch['firstname'];
$mn2=$dfetch['middlename'];
$sf2=$dfetch['suffix'];

$esql=mysql_query("SELECT name FROM docfile WHERE phicacc='$phicacc2'");
$efetch=mysql_fetch_array($esql);
$name2=strtoupper($efetch['name']);

if($doctor2==$name2){$sd2="selected='selected'";}else{$sd2="";}

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
        <td><input type='number' placeholder='Co-Pay' name='copay2' value='$copay2' autocomplete='off' maxlength='12' /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Date Signed</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td>
          <select name='mm2'>
            <option value=''>MM</option>
";

for($l=1;$l<=12;$l++){
if($l<10){$lf="0".$l;}else{$lf=$l;}
if($lf==$bdm2){$sm="selected='selected'";}else{$sm="";}
$dl=date("M",strtotime("2020-$lf-01"));
echo "
            <option value='$lf' $sm>$dl</option>
";
}

echo "
          </select>
          <select name='dd2'>
            <option value=''>DD</option>
";

for($k=1;$k<=31;$k++){
if($k<10){$kf="0".$k;}else{$kf=$k;}
if($kf==$bdd2){$sd="selected='selected'";}else{$sd="";}
echo "
            <option value='$kf' $sd>$kf</option>
";
}

echo "
          </select>
          <select name='yy2'>
            <option value=''>YYYY</option>
";

for($j=2020;$j<=date("Y")+5;$j++){
if($j==$bdy2){$sy="selected='selected'";}else{$sy="";}
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
        <td><div align='left' class='s14'>Doctor 3</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td>
          <select name='doctor3' style='width: 250px;'>
            <option value=''></option>
";

$fsql=mysql_query("SELECT phicacc, lastname, firstname, middlename, suffix FROM docdetails");
while($ffetch=mysql_fetch_array($fsql)){
$phicacc3=$ffetch['phicacc'];
$ln3=$ffetch['lastname'];
$fn3=$ffetch['firstname'];
$mn3=$ffetch['middlename'];
$sf3=$ffetch['suffix'];

$gsql=mysql_query("SELECT name FROM docfile WHERE phicacc='$phicacc3'");
$gfetch=mysql_fetch_array($gsql);
$name3=strtoupper($gfetch['name']);

if($doctor3==$name3){$sd3="selected='selected'";}else{$sd3="";}

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
        <td><input type='number' placeholder='Co-Pay' name='copay3' value='$copay3' autocomplete='off' maxlength='12' /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Date Signed</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td>
          <select name='mm3'>
            <option value=''>MM</option>
";

for($l=1;$l<=12;$l++){
if($l<10){$lf="0".$l;}else{$lf=$l;}
if($lf==$bdm3){$sm="selected='selected'";}else{$sm="";}
$dl=date("M",strtotime("2020-$lf-01"));
echo "
            <option value='$lf' $sm>$dl</option>
";
}

echo "
          </select>
          <select name='dd3'>
            <option value=''>DD</option>
";

for($k=1;$k<=31;$k++){
if($k<10){$kf="0".$k;}else{$kf=$k;}
if($kf==$bdd3){$sd="selected='selected'";}else{$sd="";}
echo "
            <option value='$kf' $sd>$kf</option>
";
}

echo "
          </select>
          <select name='yy3'>
            <option value=''>YYYY</option>
";

for($j=2020;$j<=date("Y")+5;$j++){
if($j==$bdy3){$sy="selected='selected'";}else{$sy="";}
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
      <td><a href='AddEditProfDetailsMore.php?caseno=$caseno'><div align='left'><button type='submit' class='btn2' title='Add More Doctor'>+</button></a></td>
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
