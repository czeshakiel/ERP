<?php
include "../main/class.php";
$conn2 = mysqli_connect("localhost", "root", "b0ykup4l", "kmscits");


$ckt2 = $conn->query("SHOW TABLES LIKE 'datedischargedlog'");
if(mysqli_num_rows($ckt2)==0){
$conn->query("CREATE TABLE `datedischargedlog` (`id` int(20) NOT NULL AUTO_INCREMENT, `caseno` varchar(50) NOT NULL, `disyear` varchar(10) NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
}


$disyr = "2021";
$sql = $conn->query("select * from admission where caseno like 'I-%%' and status='discharged' and dateadmit like '%$disyr%' order by dateadmit asc");
while($res = $sql->fetch_assoc()){
$caseno = $res['caseno'];
$disyear = date("Y", strtotime($res['dateadmit']));

$sql2 = $conn->query("select * from dischargedtable where caseno='$caseno'");
while($res2 = $sql2->fetch_assoc()){$ddis = date("Y", strtotime($res2['datearray']));}

$conn->query("delete from datedischargedlog where caseno='$caseno'");
$conn->query("INSERT INTO datedischargedlog (caseno, disyear) value ('$caseno', '$ddis')");

$prodout = "productout".$ddis;
$ckt = $conn->query("SHOW TABLES LIKE '$prodout'");
if(mysqli_num_rows($ckt)==0){$conn->query("CREATE TABLE $prodout LIKE productout;");}
$conn->query("INSERT INTO $prodout SELECT * FROM productout where caseno='$caseno'");
}

echo"<h1>DONE!</h1>";
?>