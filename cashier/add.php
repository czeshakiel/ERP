<?php
function test($data){
$ipx=$_SERVER['REMOTE_ADDR'];
include '../main/class.php';
$sqla1ag = "update collection_temp set paymentTime='include' where ofr='$data' and ip='$ipx'";
if ($conn->query($sqla1ag) === TRUE) {}
}

if (isset($_POST['callFunc1'])) {
echo test($_POST['callFunc1']);
}
?>
