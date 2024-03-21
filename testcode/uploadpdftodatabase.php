<div class="modal fade" id="UploadChart" role="dialog" tabindex='-1'>
<div class="modal-dialog modal-md">
<div class="modal-content">
<form method="post" enctype="multipart/form-data" action="uploadchart.php">
<input type="hidden" name="caseno" id="upload_caseno">
<input type="hidden" name="patientidno" id="upload_patientidno">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="text-align:left;">Upload Chart</h4>
</div>

<div class="modal-body">
<div class="form-group">
<label>PDF File</label>
<input type="file" name="file" class="form-control" accept=".pdf" required>
</div>
</div>

<div class="modal-footer">
<button type="submit" class="btn btn-primary" style="width:90px;">Upload</button>
</div>
</form>
</div>
 </div>
</div> 


            <?php
date_default_timezone_set('Asia/Manila');
include('../includes/config.php');
session_start();
$caseno=$_POST['caseno'];
$patientidno=$_POST['patientidno'];
	$file_name=$_FILES['file']['name'];
	$file_tmp=$_FILES['file']['tmp_name'];
	$upload_by=$_SESSION['username'];
	$datearray=date('Y-m-d');
	$timearray=date('H:i:s');
	$pdf_blob=addslashes(file_get_contents($file_tmp));	

		$check=mysqli_query($conUp,"SELECT * FROM uploadchart WHERE caseno='$caseno' AND patientidno='$patientidno'");
		if(mysqli_num_rows($check)>0){
			$insert=mysqli_query($conUp,"UPDATE uploadchart SET document='$pdf_blob',uploaded_by='$upload_by',datearray='$datearray',timearray='$timearray' WHERE caseno='$caseno' AND patientidno='$patientidno'");
		}else{
			$insert=mysqli_query($conUp,"INSERT INTO uploadchart(`caseno`,`patientidno`,`document`,`uploaded_by`,`datearray`,`timearray`) VALUES('$caseno','$patientidno','$pdf_blob','$upload_by','$datearray','$timearray')");			
		}		
		if($insert){
			echo "<script>alert('Chart successfully uploaded!');</script>";
		}else{
			echo "<script>alert('Unable to upload chart!');</script>";
		}		
	echo "<script>window.location='../medicalrecords/?transaction&patientidno=$patientidno&caseno=$caseno';</script>";
?>



<!--  ------------------ VIEW PDF --------------------------->

<a href="downloadchart.php?id=<?=$id;?>" class="btn btn-success" target="_blank">View Chart</a>

<?php
include('../includes/config.php');
session_start();
$id=$_GET['id'];
$query=mysqli_query($conUp,"SELECT * FROM uploadchart WHERE id='$id'");
$row=mysqli_fetch_array($query);
$file_name=$row['caseno'];
$pdf_doc=$row['document'];
header("Content-Type: application/pdf");
echo $pdf_doc;
?>