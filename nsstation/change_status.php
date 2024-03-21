<?php
function UpdateStatus($caseno){
$sql2 = "SELECT * FROM productout where caseno='$caseno' and administration='dispensed' and (productsubtype LIKE '%PHARMACY/MEDICINE%' or productsubtype LIKE '%PHARMACY/SUPPLIES%') and quantity > 0 AND trantype='charge'";
$result2 = $conn->query($sql2);
if(mysqli_num_rows($result2)>0){
while($row2 = $result2->fetch_assoc()) {
$apr=$row2['approvalno'];

$date=explode('_',$apr);
$time1=strtotime($date[0]." ".$date[1]);
$time2=strtotime(date('Y-m-d H:i:s'));
$hour=abs($time2-$time1)/(60*60);
if($hour >= 10 and $hour < 12){
$warning=$warning+1;
}elseif($hour >= 24){
$locked=$locked+1;
}
}
}

if($warning > 0){
$sqla1a = "UPDATE admission SET `status`='WARNING' WHERE caseno='$caseno'";
if ($conn->query($sqla1a) === TRUE) {}
}elseif($locked > 0){
$sqla1a = "UPDATE admission SET `status`='LOCKED' WHERE caseno='$caseno'";
if ($conn->query($sqla1a) === TRUE) {}
}else{


$sql2s = "SELECT status FROM admission WHERE caseno='$caseno'";
$result2s = $conn->query($sql2s);
while($row2s = $result2s->fetch_assoc()) {
$astat=$row2s['status'];
}


if($astat=="MGH"){}
elseif($astat=="YELLOW TAG"){}
else{
$sqla1a = "UPDATE admission SET `status`='Active' WHERE caseno='$caseno'";
if ($conn->query($sqla1a) === TRUE) {}
}
}
}
?>
