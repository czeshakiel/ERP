<?php
include "../main/class.php";
$conn1 = mysqli_connect("192.168.0.183", "uploadchart", "uploadchart", "kmsci");
$id=$_GET['id'];
$query=$conn1->query("SELECT * FROM uploadfiles WHERE id='$id'");
while($row = $query->fetch_assoc()){
$file_name=$row['caseno'];
$pdf_doc=$row['document'];
}
header("Content-Type: application/pdf");
echo $pdf_doc;
?>