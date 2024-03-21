<?php
include('connection.php');
$id=$_GET['id'];
$query=mysqli_query($conUp,"SELECT * FROM uploadchart WHERE id='$id'");
$row=mysqli_fetch_array($query);
$file_name=$row['caseno'];
$pdf_doc=$row['document'];
		// header('Content-type: application/pdf');
		// header('Content-Disposition: inline; filename=name.pdf');
		// header('Content-Transfer-Encoding: binary');
		// header('Accept-Ranges: bytes');
		header("Content-Type: application/pdf");
		echo $pdf_doc;
?>
