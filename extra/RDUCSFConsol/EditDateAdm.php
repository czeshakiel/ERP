<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Admission Date/Time Information</title>
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
include('../Settings.php');
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$caseno=mysql_real_escape_string($_GET['caseno']);

$asql=mysql_query("SELECT dateadmit, timeadmitted FROM admission WHERE caseno='$caseno'");
$afetch=mysql_fetch_array($asql);
$dateadmit=$afetch['dateadmit'];
$timeadmitted=$afetch['timeadmitted'];

$mm=date("m",strtotime("$dateadmit $timeadmitted"));
$dd=date("d",strtotime("$dateadmit $timeadmitted"));
$yy=date("Y",strtotime("$dateadmit $timeadmitted"));

$hh=date("h",strtotime("$dateadmit $timeadmitted"));
$ii=date("i",strtotime("$dateadmit $timeadmitted"));
$ss=date("s",strtotime("$dateadmit $timeadmitted"));
$aa=date("A",strtotime("$dateadmit $timeadmitted"));

echo "
<div align='center'>
  <form name='Save' method='post' action='EditDateAdmSave.php' class='form-container-Edit'>
    <table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td colspan='3'><div align='center' class='arial s20 blue bold'>Admission Date/Time</div></td>
      </tr>
      <tr>
        <td colspan='3' height='10'></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Date Admitted</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td>
          <select name='mm'>
            <option value=''>MM</option>
";

for($l=1;$l<=12;$l++){
if($l<10){$lf="0".$l;}else{$lf=$l;}
if($lf==$mm){$sm="selected='selected'";}else{$sm="";}
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
if($kf==$dd){$sd="selected='selected'";}else{$sd="";}
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
if($j==$yy){$sy="selected='selected'";}else{$sy="";}
echo "
            <option $sy>$j</option>
";
}

echo "
          </select>
        </td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Time Admitted</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td>
          <select name='hh'>
            <option value=''>HH</option>
";

for($p=1;$p<=12;$p++){
if($p<10){$pf="0".$p;}else{$pf=$p;}
if($pf==$hh){$sh="selected='selected'";}else{$sh="";}
echo "
            <option value='$pf' $sh>$pf</option>
";
}

echo "
          </select>:
          <select name='ii'>
            <option value=''>MM</option>
";

for($o=0;$o<=59;$o++){
if($o<10){$of="0".$o;}else{$of=$o;}
if($of==$ii){$sm="selected='selected'";}else{$sm="";}
echo "
            <option value='$of' $sm>$of</option>
";
}

echo "
          </select>:
          <select name='ss'>
            <option value=''>SS</option>
";

for($i=0;$i<=59;$i++){
if($i<10){$if="0".$i;}else{$if=$i;}
if($if==$ss){$ses="selected='selected'";}else{$ses="";}
echo "
            <option value='$if' $ses>$if</option>
";
}

if($aa=="AM"){$sa1="selected='selected'";$sa2="";}
else if($aa=="PM"){$sa1="";$sa2="selected='selected'";}
else{$sa1="";$sa2="";}

echo "
          </select>
          <select name='aa'>
            <option value='AM' $sa1>AM</option>
            <option value='PM' $sa2>PM</option>
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
";

?>

<script>    
  function closeme() {
    window.close();
  }
</script>

</body>
</html>
