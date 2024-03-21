<?php
$batchnox = "HMO".date("YmdHis");
?>

<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">
<table width="100%"><tr><td>
<font color="black"><b><i class="bi bi-credit-card-2-back"></i> HMO TRANSMITTAL</b></font>
</td><td align="right">

<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#requestreturn2"><i class="icofont-plus-circle"></i> New Transmittal</button>
</td></tr></table><hr>


<div class="card">
<div class="card-body pt-3">
<!-- Bordered Tabs -->


<ul class="nav nav-tabs nav-tabs-bordered">

<li class="nav-item">
<button class="nav-link active hover-effect" id="pp1" style="background: #5a6495; color: white; border-color: #f44336;" onclick="changebg(this.id)" data-bs-toggle="tab" data-bs-target="#p1"><font size="2%"><i class="icofont-medicine"></i> Pending Transaction</font></button>
</li>

<li class="nav-item">
<button class="nav-link hover-effect" id="pp2" onclick="changebg(this.id)" data-bs-toggle="tab" data-bs-target="#p2"><font size="2%"><i class="icofont-thermometer-alt"></i> Processing Status</font></button>
</li>

</ul>
<div class="tab-content pt-2">

<div class="tab-pane fade show active" id="p1"><?php include "../accounting/hmotransmittal/transmittal_pending.php"; ?></div>
<div class="tab-pane fade show" id="p2"><?php include "../accounting/hmotransmittal/transmittal_processing.php"; ?></div>


</div>
</div>
</div>

        

</div>
</div>
</div>
</div>
</section>
</main>


<!-------------------------------------------- RETURN MED/SUP ------------------------------------------->
<?php
if(isset($_POST['submit'])){
$transdate=$_POST['transdate'];
$hmo=$_POST['hmo'];
$ptype=$_POST['ptype'];
$ttype=$_POST['ttype'];
$batchno=$_POST['batchno'];
echo"<script>window.location='?newtransmittallist&batchno=$batchno&transdate=$transdate&hmo=$hmo&ptype=$ptype&ttype=$ttype';</script>";
}
?>

<div class="modal fade" id="requestreturn2" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog" style="box-shadow: 0px 0px 2000px #6e7fcb;">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> NEW TRANSMITTAL</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">


<form role="form" method="POST">
<table width="90%" align="center">
<tr>
<td width="30%"><font color="black">Batch Number:</td>
<td><input  name='batchno' type='text' value='<?php echo $batchnox ?>' class="form-control" required></td>
</tr>
<tr>
<td><font color="black">Transaction Date:</td>
<td><input  name='transdate' type='date' value="<?php echo date('Y-m-d'); ?>" class="form-control" required></td>
</tr>
<tr>
<td><font color="black">HMO-Company:</td>
<td>
<select name="hmo" class="form-control" id="supplier" required>
<option value="">SELECT Company</option>
<?php												
$sqlm = "SELECT * from company order by companyname";
$resultm = $conn->query($sqlm);
while($rowm = $resultm->fetch_assoc()) {
$company=$rowm['acctno']."||".$rowm['companyname'];
echo"<option value='$company'>$rowm[companyname]</option>";
} ?>
</select>
</td>
</tr>
<tr>
<td><font color="black">Patient Type:</td>
<td>
<select name="ptype" class="form-control" required>
<option value="in">IN-PATIENT</option>
<option value="out">OUT-PATIENT</option>
<option value="all">ALL</option>
</select>
</td>
</tr>
<tr>
<td><font color="black">Transaction Type:</td>
<td>
<select name="ttype" class="form-control" required>
<option value="insurance">INSURANCE</option>
<option value="assistance">ASSISTANCE</option>
</select>
</td>
</tr>
<tr>
<td colspan="2" style="text-align: right;"><input type="submit" name="submit" value="SUBMIT" class="btn btn-primary" ></td>
</tr>
</table> <br>
</form> 




</div>
</div>
</div>
</div>
<!---------------------------------------- END RETURN MED/SUP ------------------------------------------->


<script>
function changebg(val){

for (let i = 1; i <= 2; i++) {
var text="";
text += "pp" + i;
document.getElementById(text).style="";
} 
document.getElementById(val).style="background: #5a6495; color: white; border-color: #f44336;";
}
</script>