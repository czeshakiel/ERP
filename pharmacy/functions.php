<?php
$name=$_GET['str'];
include('../main/class.php');

if($name=="patient"){
echo "<option value=''>Select Patient</option>";
$sqlccv = "SELECT * FROM patientprofilewalkin where patientidno!='' order by lastname";
$resultccv = $conn->query($sqlccv);
while($rowccv = $resultccv->fetch_assoc()) {
$lastname=$rowccv['lastname'];
$firstname=$rowccv['firstname'];
$lastname=$rowccv['lastname'];
$middlename=$rowccv['middlename'];
$patientidno=$rowccv['patientidno'];
$name = $lastname.", ".$firstname." ".$middlename;
$namex = $name."_____".$patientidno;
echo"<option value='$namex'>$name</option>";
}
}

elseif($name=="doctor"){
echo "<option hidden>Select Doctor</option>
<option value='NONE__NONE'>NONE</option>";

$sqlccv = "SELECT * FROM docfile order by name";
$resultccv = $conn->query($sqlccv);
while($rowccv = $resultccv->fetch_assoc()) {
$name=$rowccv['name'];
$codedoc=$rowccv['code'];
$co = $codedoc."__".$name;
echo"<option value='$codedoc'>$name</option>";
}
}


elseif($name=="barcode"){
$barcode=$_GET['str2'];
$dept=$_GET['dept'];
$bar = $conn->query("select * from receiving where aveconsole='$barcode'");
if(mysqli_num_rows($bar)==1){
while($bar1 = $bar->fetch_assoc()){$code=$bar1['code'];}
$qty1 = "1";
$ttype = "PATIENT";
include "../dispensing/pricingscheme_vat.php";
include "../dispensing/POSinsert.php";
}else{echo"no item found...";}
}									
?>
