<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Edit Item</title>
  <link rel="stylesheet" type="text/css" href="../Resources/CSS/mystyle.css">
  <!-- Favicon -->
    <link rel="icon" href="../Resources/Favicon/logo.png" type="image/png" />
    <link rel="shortcut icon" href="../Resources/Favicon/logo.png" type="image/png" />

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

$ip=$cuz->setIP();

$restype=mysqli_real_escape_string($mycon1,$_POST['restype']);

echo "
<div align='center'>
  <table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; left: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td valign='middle'><div align='center' style='color: blue;font-family: arial;font-weight: bold;font-size: 20px;'>Loading...</div></td>
    </tr>
  </table>
</div>
";

if($restype=="chemistry"){
  $caseno=mysqli_real_escape_string($mycon1,$_POST['caseno']);
  $lab29=mysqli_real_escape_string($mycon1,$_POST['lab29']);
  $testno=mysqli_real_escape_string($mycon1,$_POST['testno']);

  $asql=mysqli_query($mycon1,"SELECT `printcount` FROM `labpending` WHERE `refno`='$lab29'");
  $afetch=mysqli_fetch_array($asql);
  $pc=$afetch['printcount'];

  $npc=$pc+1;

  echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=../../../labprint/bloodchem_alt.php?caseno=$caseno&lab29=$lab29&testno=$testno'>";
}
else if($restype=="hematology"){
  $caseno=mysqli_real_escape_string($mycon1,$_POST['caseno']);
  $lab29=mysqli_real_escape_string($mycon1,$_POST['lab29']);

  $asql=mysqli_query($mycon1,"SELECT `printcount` FROM `labpending` WHERE `refno`='$lab29'");
  $afetch=mysqli_fetch_array($asql);
  $pc=$afetch['printcount'];

  $npc=$pc+1;

  echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=../../../labprint/hemabody_alt2.php?caseno=$caseno&lab29=$lab29'>";
}
else if($restype=="stool"){
  $patient=mysqli_real_escape_string($mycon1,$_POST['patient']);
  $refno=mysqli_real_escape_string($mycon1,$_POST['refno']);

  $asql=mysqli_query($mycon1,"SELECT `printcount` FROM `labpending` WHERE `refno`='$refno'");
  $afetch=mysqli_fetch_array($asql);
  $pc=$afetch['printcount'];

  $npc=$pc+1;

  echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=http://$ip/cgi-bin/fecalysis200_alt.cgi?patient=$patient&refno=$refno'>";
}
else if($restype=="others"){
  $desc=mysqli_real_escape_string($mycon1,$_POST['desc']);
  $caseno=mysqli_real_escape_string($mycon1,$_POST['caseno']);
  $refno=mysqli_real_escape_string($mycon1,$_POST['refno']);

  $asql=mysqli_query($mycon1,"SELECT `printcount` FROM `labpending` WHERE `refno`='$refno'");
  $afetch=mysqli_fetch_array($asql);
  $pc=$afetch['printcount'];

  $npc=$pc+1;

  echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=http://$ip/labprint/$desc-body_alt.php?caseno=$caseno&refno=$refno'>";
}
?>
</body>
</html>
