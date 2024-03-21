<!doctype html>
<html class='no-js' lang='en' dir='ltr'>
<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=Edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
  <title>KMSCI Laboratory Cart</title>
</head>
<body>

<?php
include("../../main/class.php");

$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);

echo "
<table border='0' width='100%' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='auto' class='t2 b2 l1 r2'><iframe src='../Cart/?caseno=$caseno&toh=CHARGES&station=LABORATORY' name='mainFrame' id='mainFrame' title='mainFrame' style='border: 0px;' height='600' width='100%'></iframe></td>
  </tr>
</table>
";
?>

</body>
</html>
