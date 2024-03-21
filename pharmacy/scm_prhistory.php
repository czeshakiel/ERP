<?php
if(isset($_POST['btnsubmit'])){
$dfrom = $_POST['dstart']; $dto = $_POST['dto']; $supplier = $_POST['supplier'];
echo"<script>window.location = '?prhistorylist&dfrom=$dfrom&dto=$dto&supplier=$supplier';</script>";
}
?>

<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a>Authentication</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<p><font color="black"><b><i class="bi bi-file-earmark-medical"></i> PURCHASE RECEIVING HISTORY</b></font></p><hr>


<table width="40%">
<tr>
<td valign="top" style="width: 70%;">
<div class="card" style='box-shadow: 0px 0px 0px 1px #0a0a42;'>
<div class="card-header" style="background-color: #0a0a42; padding: 7px;">
<table width="100%"><tr><td style="color: white;"> <i class="bi bi-award"></i> CHECK RR PER SUPPLIER</td></tr></table>
</div>
<div class="card-body">

<form method="POST">
<table width="100%" align="center">
<tr><td>
<font color="black">
Date From:<br>
<input type="date" name="dstart" class="form-control" value="<?php echo date('Y-m').'-01' ?>" required><br>
Date To:<br>
<input type="date" name="dto" class="form-control" value="<?php echo date('Y-m').'-31' ?>" required><br>
Supplier:<br>
<select name="supplier" class="select2-single form-control">
<?php												
$sqlm = "SELECT suppliercode,suppliername FROM supplierscsr ORDER BY suppliername ASC";
$resultm = $conn->query($sqlm);
while($rowm = $resultm->fetch_assoc()) {
$supplier=$rowm['suppliercode']."_".$rowm['suppliername'];
echo"<option value='$supplier'>$rowm[suppliername]</option>";
} ?>
</select><br>
<br></font>
<p align="right"><button type="submit" class="btn btn-danger" name="btnsubmit"><i class="fa fa-submit"></i> Submit</button></p>
</td></tr></table>
</form>
</div>
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
