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
$sql1 = "select * from productout where caseno='$caseno' and (productsubtype='PHARMACY/MEDICINE' OR productsubtype='PHARMACY/SUPPLIES' OR productsubtype='MEDICAL SURGICAL SUPPLIES' OR productsubtype='MEDICAL SUPPLIES') and (administration='dispensed' or administration='pending') and trantype='charge' and quantity > 0";
$result1 = $conn->query($sql1);
$countmedsup1 = mysqli_num_rows($result1);

$sql1 = "select * from productout where caseno='$caseno' and productsubtype='LABORATORY' and terminalname='pending' and (status='PAID' or status='Approved') and quantity > 0";
$result1 = $conn->query($sql1);
$countlab = mysqli_num_rows($result1);

$sql2 = "select * from productout where caseno='$caseno' and (productsubtype='EEG' or productsubtype='XRAY' or productsubtype='ULTRASOUND' OR productsubtype='CTSCAN'
OR productsubtype='CT SCAN' OR productsubtype='MAMMOGRAPHY' OR productsubtype='ECG' OR productsubtype='HEARTSTATION') and terminalname='pending' and (status='PAID' or status='Approved') and quantity > 0 and approvalno=''";
$result2 = $conn->query($sql2);
$countrad = mysqli_num_rows($result2);


$sql3 = "select * from admission where caseno='$caseno' and finaldiagnosis=''";
$result3 = $conn->query($sql3);
$countfx = mysqli_num_rows($result3);

$sql32 = "select * from admission where caseno='$caseno' and specialization=''";
$result32 = $conn->query($sql32);
$countfx2 = mysqli_num_rows($result32);

$sql1ss = "select * from courseward where caseno='$caseno'";
$result1ss = $conncf4->query($sql1ss);
$count_courseward = mysqli_num_rows($result1ss);

$sql32n = "select * from admission where caseno='$caseno' and membership!='phic-med'";
$result32n = $conn->query($sql32n);
$countmembership = mysqli_num_rows($result32n);
if($countmembership>0){$count_courseward = "2";}


if($countmedsup1>0){
echo'
<script type="text/javascript">
swal({
icon: "error",
title: "Error on Updating Status!",
text: "You have an unsettled MED/SUP, for dispensed status please administer or return the product and for pending status please cancel/ delete request before set to MGH.",
type: "error"
}).then(function() {
window.location = "'.$ddept.'/index.php?detail&caseno='.$caseno.'";
});
</script>';
}

elseif($countlab>0){
echo'
<script type="text/javascript">
swal({
icon: "error",
title: "Error on Updating Status!",
text: "You have an unsettled LABORATORY procedure, please Testdone or Test to be Done before set to MGH.",
type: "error"
}).then(function() {
window.location = "'.$ddept.'/index.php?detail&caseno='.$caseno.'";
});
</script>';
}

elseif($countrad>0){
echo'
<script type="text/javascript">
swal({
icon: "error",
title: "Error on Updating Status!",
text: "You have an unsettled EEG/XRAY/ULTRASOUND/CTSCAN/HEARTSTATION procedure, please Testdone or Test to be Done before set to MGH.",
type: "error"
}).then(function() {
window.location = "'.$ddept.'/index.php?detail&caseno='.$caseno.'";
});
</script>';
}

elseif($countfx>0){
echo'
<script type="text/javascript">
swal({
icon: "error",
title: "Error on Updating Status!",
text: "No Final Diagnosis. '.$ddpet.'",
type: "error"
}).then(function() {
window.location = "'.$ddept.'/index.php?detail&caseno='.$caseno.'";
});
</script>';
}

elseif($count_courseward<2)
{
echo'
<script type="text/javascript">
swal({
icon: "error",
title: "Error on Updating Status!",
text: "NO Course in the Ward!",
type: "error"
}).then(function() {
window.location = "'.$ddept.'/index.php?detail&caseno='.$caseno.'";
});
</script>';
}
else
{
$sql778 = "update admission set status='MGH', consult_id = concat(consult_id, '\nMgh by: $user') where caseno='$caseno'";
if ($conn->query($sql778) === TRUE) {}

$sql778z = "insert into admitmgh values('$caseno',curdate(),curtime(),'$user')";
if ($conn->query($sql778z) === TRUE) {}

echo'
<script type="text/javascript">
swal({
icon: "success",
title: "Successful on Updating Status!",
text: "Update '.$caseno.' to MGH status!",
type: "error"
}).then(function() {
window.location = "'.$ddept.'/index.php?detail&caseno='.$caseno.'";
});
</script>';
}

$loc = "'.$ddept.'/index.php?detail&caseno=$caseno$datax";
//header('refresh:3; '.$loc.'');
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
