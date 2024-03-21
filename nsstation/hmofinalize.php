<?php
include '../main/class.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>

<script src="../main/arv_new/jquery/dist/jquery.min.js"></script>
<script src="../main/arv_new/sweetalert/sweetalert.js"></script>

</head>
</html>

<?php
if($dept=="VERIFIER"){$ddept="../verifier";}
else{$ddept="../nsstation";}

$caseno = $_GET['caseno'];
$conn->query("update productout set caseno='$caseno-removeHMO' where status!='PAID' and terminalname='pending'");
$conn->query("update arv_tbl_hmofinalize set status='deleted' where caseno='$caseno'");
$conn->query("INSERT INTO `arv_tbl_hmofinalize`(`caseno`, `datearray`, `timearray`, `user`, `status`) VALUES ('$caseno', CURDATE(), CURTIME(), '$user', 'active')");

echo'
<script type="text/javascript">
swal({
icon: "success",
title: "DONE!",
text: "Successful on Updating HMO Status to Finalized!",
type: "error"
}).then(function() {
window.location = "'.$ddept.'/index.php?detail&caseno='.$caseno.'";
});
</script>';

?>

<script>
$(function () {
$('input').iCheck({
checkboxClass: 'icheckbox_square-blue',
radioClass: 'iradio_square-blue',
increaseArea: '20%' /* optional */
});
});
</script>
