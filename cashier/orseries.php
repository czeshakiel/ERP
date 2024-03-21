<?php
if(isset($_POST['btn_search'])) {
$or = $_POST['search'];

$conn->query("update orno_series set status='Not-Active' where dept='$dept'");
$conn->query("INSERT INTO `orno_series`(`orno`, `status`, `dept`) values ('$or','Active','$dept')");
echo"<script>window.location='?orseries';</script>";
}

$sq = $conn->query("select * from orno_series where status='Active' and dept='$dept'");
while($my = $sq->fetch_assoc()){$orse = $my['orno'];}
?>


<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?detail&caseno=<?php echo $caseno ?>">Patient Information</a></li>
<li class="breadcrumb-item"><a href="?senior&caseno=<?php echo $caseno ?>">Set Senior|PWD</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<p><b><i class="bi bi-file-earmark-medical"></i> CHANGE SENIOR|PWD STATUS <font size="1">[ <?php echo $caseno." - ".$namearray ?> ]</b></font></p><hr>

<table width="50%"><tr><td>
<div class="col">
<div class="card teacher-card" style="box-shadow: 0px 0px 1px 1px lightgrey;">
<div class="card-body  d-flex">
<div class="profile-av pe-xl-4 pe-md-2 pe-sm-4 pe-4 text-center w220">
<img src="../main/img/seriesno.jpg" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
<div class="about-info d-flex align-items-center mt-1 justify-content-center flex-column">
<h6 class="mb-0 fw-bold d-block fs-6 mt-2">OR SERIES NUMBER</h6>
</div>
</div>
<div class="teacher-info border-start ps-xl-4 ps-md-3 ps-sm-4 ps-4 w-100">
<span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted">Current OR Series</span>
<h6  class="mb-0 mt-2  fw-bold d-block fs-6"><?php echo $orse ?></h6>
<div class="video-setting-icon mt-3 pt-3 border-top">

<form method="POST">
<table width="100%" align="center">
<tr>
<td><p align="left"><br><font color="black"> New OR Series:<br>
<input type="text" name="search" placeholder="e.g 9800000" class="form-control"><br><br><button type="submit" name="btn_search" class="btn btn-sm btn-danger">Update OR Series</button></td>
</tr>
</table>
</form>



</div>
</div>
</div>
</div>
</div>
</td></tr></table>


</div>
</div>
</div>
</div>
</section>
</main>
