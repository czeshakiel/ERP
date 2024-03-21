<?php
$caseno = $_GET['caseno'];

$sql2l = "SELECT * FROM admission, patientprofile where admission.patientidno=patientprofile.patientidno and caseno='$caseno'";
$result2l = $conn->query($sql2l);
while($row2l = $result2l->fetch_assoc()) { 
$lname=$row2l['lastname'];
$fname=$row2l['firstname'];
$mname=$row2l['middlename'];
$pname= $lname.", ".$fname." ".$mname;
}  

if(isset($_POST['btnsave'])){
$caseno11 = $_POST['caseno'];
$user11 = $_POST['user'];
$notes = $_POST['notes'];
$datep = $_POST['datep'];
$timep = $_POST['timep'];
$timep = date("h:i:s a", strtotime($timep));
$notes = addslashes($notes);
$sql778 = "INSERT INTO `medical_notes`(`caseno`, `notes`, `dateposted`, `timeposted`, `userposted`, `type` , `subtype`) VALUES
('$caseno11','$notes','$datep','$timep','$user11','NURSE', 'active')";
if ($conn->query($sql778) === TRUE) {}		
$loc = "index.php?nursesnote&caseno=$caseno11$datax";
echo"<script>window.location='$loc';</script>";
}


if(isset($_POST['btndel'])){
$idno = $_POST['idno'];
$caseno11 = $_POST['caseno'];

$sql2 = "SELECT * FROM medical_notes where id='$idno'";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) { 
$usr=$row2['userposted'];
}
$upuser = "Posted by: ".$usr."<br> Remove by: ".$user;

$sql778 = "update medical_notes set subtype='removed', userposted='$upuser' where id='$idno'";
if ($conn->query($sql778) === TRUE) {}		
$loc = "index.php?nursesnote&caseno=$caseno11$datax";
echo"<script>window.location='$loc';</script>";
}
   
?>	



<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?detail&caseno=<?php echo $caseno ?>">Patient Information</a></li>
<li class="breadcrumb-item"><a href="?nursesnote&caseno=<?php echo $caseno ?>">Nurses Note</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<p><b><i class="bi bi-file-earmark-medical"></i> NURSES' NOTE || <small>CASENO: <?php echo $caseno ?> || NAME: <?php echo $pname ?></font></b></p><hr>


<table width="100%">
<tr><td width="35%">
<br>
<div class='card' style='box-shadow: 0px 0px 0px 1px lightgrey;'>
<div class='card-body'>
<div class='d-flex align-items-center justify-content-between mt-5'>
<div class='lesson_name'>
<div class='project-block light-info-bg'>
<i class='icofont-patient-file'></i>
</div>
<span class='small project_name fw-bold'> NURSE INSTRUCTION </span>
</div>
</div>
<form method="POST">
<table><tr><td>
<font color="black">
<input type="date" name="datep" value="<?php echo date('Y-m-d'); ?>" style="background: white; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e;">
<input type="time" name="timep" value="<?php echo date('H:i:s'); ?>" style="background: white; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e;">
</td></tr></table><br>

<div class="form-floating">
<textarea class="form-control" placeholder="Address" name="notes" id="tec" style="height:200px; font-size:10pt; background: white; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e;"><?php echo $finaldiagnosis ?></textarea>
<label for="floatingTextarea"><font color="blue">&#128716; Enter Nurses Note Here....</label>
</div>

<input type="hidden" name="caseno" value="<?php echo $caseno ?>">
<input type="hidden" name="user" value="<?php echo $user ?>"><br>
<p align="right"><button type="submit" name="btnsave" class="btn btn-xs btn-primary"><font size="2"><i class="icofont-save"> Save</i></button></p>
</form>
</div></div>

</td><td width="2%"></td><td valign="TOP">

<div class='dd-handle'>

<p align="right"><a href="?nursesnoteprint&caseno=<?php echo $caseno ?>&pname=<?php echo $pname ?><?php echo $datax ?>"><button class="btn btn-primary btn-sm" disabled><i class="icofont-printer"></i> Print Preview</button></a></p>
<table class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<td width="5%"></td>
<th class="text-center" bgcolor="<?php echo $primarycolor ?>" width="15%">DATE</th>
<th class="text-center" bgcolor="<?php echo $primarycolor ?>" width="15%">TIME</th>
<th class="text-center" bgcolor="<?php echo $primarycolor ?>"></th>
<th class="text-center" bgcolor="<?php echo $primarycolor ?>" width="10%"></th>
</tr>
</thead>
<tbody>

<?php 
$i = 0;
$sql = "SELECT * FROM medical_notes where caseno='$caseno' and type='NURSE' and subtype='active' order by dateposted asc, timeposted asc";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) { 
$caseno=$row['caseno'];
$datep=$row['dateposted'];
$timep=$row['timeposted'];
$notes=$row['notes'];
$user11=$row['userposted'];
$idno=$row['id'];
$i++;											  								  
?>

<tr>
    <td valign="TOP">&#128204;</td>
<td bgcolor="<?php echo $col ?>" align="center" style="font-size:11px;"><?php echo $datep ?></td>
<td bgcolor="<?php echo $col ?>" style="font-size:11px;"><?php echo $timep ?></td>
<td bgcolor="<?php echo $col ?>" style="font-size:11px;"><?php echo $notes ?><br><small><font color="red"><i>Posted by: <?php echo $user11 ?></i></font></td>
<td style="text-align: center;">

<form method="POST">
<button type="submit" name="btndel" onclick="return confirm('Are you sure you want to remove?');" class="btn btn-xs btn-secondary btn-sm"><font size="2"><i class="icofont-trash"></i></button>
<input type="hidden" name="idno" value="<?php echo $idno ?>">
<input type="hidden" name="caseno" value="<?php echo $caseno ?>">
</form>
</td>
</tr>
<?php }?>
</tbody>
</table>

</div>

</td>
</tr>
</table>

</div>
</div>
</div>
</div>
</section>
</main>

