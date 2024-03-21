<?php
$caseno=$_GET['caseno'];
$refno=$_GET['refno'];
$sql = "select * from productout where caseno = '$caseno' and refno='$refno'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) { 
$desc = $row['productdesc'];
$ptype = $row['productsubtype'];
$trantype = $row['trantype'];
}

if(strpos($desc, "ECHO") !== false){
echo"<script>window.location = '?cr2decho&refno=$refno&caseno=$caseno&description=$desc&prodsubtype=$ptype&trantype=$trantype$datax';</script>";
}

elseif(strpos($desc, "STRESS TEST ADULT") !== false){
echo"<script>window.location = '?crstresstestadult&refno=$refno&caseno=$caseno&description=$desc&prodsubtype=$ptype&trantype=$trantype$datax';</script>";
}

else{
echo"<script>window.location = '?resultdecking&refno=$refno&caseno=$caseno$datax';</script>";
}
?>
