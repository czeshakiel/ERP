<?php
$table="dohemr";
$conn = mysqli_connect("localhost", "root", "b0ykup4l", "$table");
$rows = "Tables_in_".$table;

$sql = $conn->query("SHOW TABLES FROM $table");
while($res = $sql->fetch_assoc()){
$tab = $res[$rows];

$sql2 = $conn->query("select * from aaadel where mytable='$tab'");
if(mysqli_num_rows($sql2)==0){$conn->query("TRUNCATE TABLE $tab");}
}

echo"<h1>DONE</h1>";
?>