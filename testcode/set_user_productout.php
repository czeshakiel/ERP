<?php
include "../main/connection.php";

$caseno="I-20230003674";
$sql = $conn->query("select * from productout where caseno='$caseno' and administration='administered' and loginuser=''");
while($result = $sql->fetch_assoc()){
$refno = $result['refno'];
$refno2 = $result['referenceno'];

$sql2 = $conn->query("select * from productout where caseno='$caseno' and refno='$refno2'");
while($result2 = $sql2->fetch_assoc()){$loginuser = $result2['loginuser'];}

$sql3 = $conn->query("select * from userlogs where transaction like '%$refno%'");
while($result3 = $sql3->fetch_assoc()){$loginuser2 = $result3['loginuser'];}
$loginuser = $loginuser."<br>Administered by:".$loginuser2;

$conn->query("update productout set loginuser='$loginuser' where caseno='$caseno' and refno='$refno'");
}

echo"<h1>DONE!!!!</h1>";
?>