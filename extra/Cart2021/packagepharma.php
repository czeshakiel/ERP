<?php
ini_set("display_errors","On");
include("../../main/class.php");

$setip=$_SERVER['HTTP_HOST'];

$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);
$code=mysqli_real_escape_string($conn,$_GET['code']);
$quantity=mysqli_real_escape_string($conn,$_GET['qty']);
$settrantype=mysqli_real_escape_string($conn,$_GET['trantype']);
$toh=mysqli_real_escape_string($conn,$_GET['toh']);
$station=mysqli_real_escape_string($conn,$_GET['station']);
$tick=mysqli_real_escape_string($conn,$_GET['tick']);
$stk=mysqli_real_escape_string($conn,$_GET['stk']);

$sprel=mysqli_real_escape_string($conn,$_GET['sprel']);
$referenceno=mysqli_real_escape_string($conn,$_GET['referenceno']);
$packrno=mysqli_real_escape_string($conn,$_GET['packrno']);
$itd=mysqli_real_escape_string($conn,$_GET['itd']);
$srno=mysqli_real_escape_string($conn,$_GET['srno']);

if(isset($_GET['autodistro'])){
  $ph1=mysqli_real_escape_string($conn,$_GET['ph1']);
  $ph2=mysqli_real_escape_string($conn,$_GET['ph2']);
  $hmo=mysqli_real_escape_string($conn,$_GET['hmo']);
  $exc=mysqli_real_escape_string($conn,$_GET['exc']);
}

echo "
<html>
  <head>
    <title>PACKAGE ADDED</title>
    <link rel='stylesheet' type='text/css' href='http://$setip/arv2020/Auth/css/login2.css'>
    <link rel='stylesheet' href='http://$setip/arv2020/arv_includes/stackpath.bootstrapcdn.css'>
    <link rel='icon' href='http://$setip/arv2020/Auth/icons/avatar1.png' type='image/png' />
    <link rel='shortcut icon' href='http://$setip/arv2020/Auth/icons/avatar1.png' type='image/png' />
  </head>
  <body>
    <div align='left' style='color: #A569BD;font-weight: bold;font-family: arial;font-size: 14px;'></div>
  </body>
</html>
";

echo "
<form method='POST' action='pospharma.php' id='data' style='display:none'>
  <input type='hidden' name='caseno' value='$caseno' />
  <input type='hidden' name='code' value='$code' />
  <input type='hidden' name='qty' value='$quantity' />
  <input type='hidden' name='trantype' value='$settrantype' />
  <input type='hidden' name='toh' value='$toh' />
  <input type='hidden' name='station' value='$station' />
  <input type='hidden' name='tick' value='$tick' />
  <input type='hidden' name='stk' value='$stk' />
  <input type='hidden' name='sprel' value='$sprel' />
  <input type='hidden' name='referenceno' value='$referenceno' />
  <input type='hidden' name='packrno' value='$packrno' />
  <input type='hidden' name='itd' value='$itd' />
  <input type='hidden' name='srno' value='$srno' />
";

if(isset($_GET['autodistro'])){
echo "
  <input type='hidden' name='autodistro' value='' />
  <input type='hidden' name='ph1' value='$ph1' />
  <input type='hidden' name='ph2' value='$ph2' />
  <input type='hidden' name='hmo' value='$hmo' />
  <input type='hidden' name='exc' value='$exc' />
";
}

echo "
  <input type='submit'>
</form>
<script>
  document.forms.namedItem('data').submit();
</script>
";
?>
