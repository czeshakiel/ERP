<?php
include "../main/class.php";
include "../main/header.php";
$conn1 = mysqli_connect("192.168.0.183", "uploadchart", "uploadchart", "kmsci");

if(isset($_GET['psg'])){
$h1 = "PHILHEALTH PSG";
$grp = "psg"; 
}elseif(isset($_GET['cpg'])){
$h1 = "CLINCAL PRACTICE GUIDELINES";
$grp = "cpg";
}else{
$h1 = "LICENSING ASSESSMENT TOOL";
$grp = "lat";
}


if(isset($_POST['btnupload'])){
$pass=$_POST['pass'];

$ss = $conn->query("select * from nsauth where station='uploadfiles' and password='$pass'");
if(mysqli_num_rows($ss)>0){
while($ss1 = $ss->fetch_assoc()){$uname = $ss1['name'];}

$title=$_POST['title'];
$file_name=$_FILES['file']['name'];
$file_tmp=$_FILES['file']['tmp_name'];
$datearray=date('Y-m-d');
$timearray=date('H:i:s');
$pdf_blob=addslashes(file_get_contents($file_tmp));
$title = addslashes($title);


$ck = $conn1->query("INSERT INTO `uploadfiles`(`document`, `title`, `datearray`, `timearray`, `grp`, `user`) VALUES ('$pdf_blob', '$title', '$datearray', '$timearray', '$grp', '$uname')");
if($ck==true){echo"<script>alert('saved..');</script>";}else{echo"<script>alert('unable to save');</script>";}

}else{echo"<script>alert('unauthorized password! please try again!');</script>";}
echo "<script>window.location='../main/uploadfiles.php?$grp';</script>";
}
?>

<div class="card">
<div class="card-body">

<table width="100%">
<tr>
<td><h5><?php echo $h1 ?></h5></td>
<td style='text-align: right;'>
<button type="button" class="btn btn-warning btn-sm" id="idc" data-bs-toggle="modal" data-bs-target="#dis_sum_modal"><i class="icofont-arrow-right"></i> Upload <?php echo strtoupper($grp) ?></button>
</td></tr></table>
<hr>

<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">TItle</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>

                                 
                  <?php
$i=0;
// $sql = "SELECT * from uploadfiles where grp = '$grp'";
$sql = "SELECT * FROM uploadfiles WHERE grp = '$grp' ORDER BY datearray DESC";
$result = $conn1->query($sql);
while($row = $result->fetch_assoc()) {
$title=$row['title'];
$id=$row['id'];
$i++;


echo"
<tr>
<td align='center' style='background: $col; font-size: 11px;'>$i.</td>
<td style='background: $col; font-size: 11px;'>$title</td>
<td style='text-align: center; background: $col; font-size: 11px;'>
<a href='../main/uploadfilesview.php?id=$id' target='_blank' class='btn btn-outline-dark btn-sm' title='View Profile'>
<i class='icofont-file-pdf'></i>
</a>
</td>
</tr>
";
}


?>
                  

</tbody>
</table>
              


            </div>
          </div>

<div class="modal fade" id="dis_sum_modal" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog modal-xs glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><b><i class="icofont-patient-file"></i> Upload</b></h5>
<button type="button" class="btn-close btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<form method="post" enctype="multipart/form-data">
<table width="100%" align="center">
<tr>
<td>
<label>PDF File</label>
<input type="file" name="file" class="form-control" accept=".pdf" required>
</td>
</tr>
<tr>
<td>
<label>Title</label>
<input type="text" name="title" class="form-control" required>
</td>
</tr>
<tr>
<td>
<label>Password:</label>
<input type="password" name="pass" class="form-control" required>
</td>
</tr>
<tr>
<td>
<button type="submit" name="btnupload" class="btn btn-danger">Upload</button>
</td>
</tr>
</table>
</form>

</div>
</div>
</div>
</div>


<?php include "../main/footer.php"; ?>


