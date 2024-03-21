<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?paysupplier">Payment to Supplier</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<?php
if(isset($_GET['pending'])){
$ipd = "class='btn btn-primary btn-sm'";
$opd = "class='btn btn-default border border-primary btn-sm'";
$ttbd = "class='btn btn-default border border-primary btn-sm'";
$ques = "status='pending'";
}
elseif(isset($_GET['processing'])){
$opd = "class='btn btn-primary btn-sm'";
$ipd = "class='btn btn-default border border-primary btn-sm'";
$ttbd = "class='btn btn-default border border-primary btn-sm'";
$ques = "status='finalized'";
}

elseif(isset($_GET['paid'])){
$ttbd = "class='btn btn-primary btn-sm'";
$opd = "class='btn btn-default border border-primary btn-sm'";
$ipd = "class='btn btn-default border border-primary btn-sm'";
$ques = "status='paid'";
}

else{
$ipd = "class='btn btn-primary btn-sm'";
$opd = "class='btn btn-default border border-primary btn-sm'";
$ttbd = "class='btn btn-default border border-primary btn-sm'";
$ques = "status='pending'";
}

?>

<table width="100%"><tr><td width="60%">
<div class="container">
<div class="btn-group btn-group-justified" style="width: 100%;">
<button name="ipd" style="width:20%; font-size: 12px;" onclick="loadz('pending');" <?php echo $ipd ?>><i class="icofont-users-alt-5"></i> Pending Voucher</button></a>
<button name="opd" style="width:20%; font-size: 12px;" onclick="loadz('processing');" <?php echo $opd ?>><i class="icofont-users-social"></i> Processing Voucher</button>
<button name="rdu" style="width:20%; font-size: 12px;" onclick="loadz('paid');" <?php echo $ttbd ?>><i class="icofont-ui-clip-board"></i> Paid Voucher</button>
</div>
</div>
</td><td style="text-align: right;">
<button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#decking"><i class="icofont-plus-circle"></i> Create Transaction</button>
</td>
</tr>
</td></tr></table>
<hr>




<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr> 
<th class="text-center" width="5%"></th>
<th class="text-center" width="20%">Voucher</th>
<th class="text-center">Detail</th>
<th class="text-center" width="15%">TOTAL</th>
<th class="text-center" width="5%">ACTION</th>
</tr>
</thead>
<tbody>

<?php
$totalxx="0.00"; $i=0;
$sql3="SELECT sum(amount) as amount, voucherid, id, supplier FROM suppliervoucher WHERE $ques group by voucherid";
$sqlAdded=mysqli_query($conn,$sql3);
while($item=mysqli_fetch_array($sqlAdded)){
$voucherid= $item['voucherid'];
$amount = $item['amount'];
$id = $item['id'];
$supplier = $item['supplier'];
$totalx += $amount;
$amountx = number_format($amount, 2);
$totalxx = number_format($totalx, 2);
$i++;


if(isset($_GET['pending'])){
$vm = "<a href='?makesupvoucher&supplier=$supplier&voucher=$voucherid'>";
}elseif(isset($_GET['processing'])){
$vm = "<a href='?paysupvoucher&supplier=$supplier&voucher=$voucherid'>";
}elseif(isset($_GET['paid'])){
$vm = "<a href='http://$ip/ERP/accounting/cheque/METROBANK.php?paysupvoucher&supplier=$supplier&voucher=$voucherid' target='_blank'>";
}else{
$vm = "<a href='?makesupvoucher&supplier=$supplier&voucher=$voucherid'>";
}

echo"
<tr>
<td style='font-size: 11px;' valign='TOP'>$i</td>
<td style='font-size: 11px;' valign='TOP'>$voucherid</td>
<td style='font-size: 11px;'>
<table class='table'>
<tr>
<td><b>PO</td>
<td><b>RR</td>
<td><b>Invno</td>
</tr>
";
$sql3x=$conn->query("SELECT * FROM suppliervoucher WHERE $ques and voucherid='$voucherid' order by rr");
while($res = $sql3x->fetch_assoc()){
echo"
<tr>
<td>$res[po]</td>
<td>$res[rr]</td>
<td>$res[invno]</td>
</tr>
";
}
echo"
</table>
</td>
<td style='font-size: 11px;'' valign='TOP'>$amountx</td>
<td style='text-align: center;'' valign='TOP'>
$vm
<button type='button' class='btn btn-primary' name='btndel' style='border: none; padding: 4px 10px; font-size: 10px; margin: 2px 1px;'><i class='icofont-info-circle'></i></button>
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
</div>
</div>
</section>
</main>

<script>
function loadz(val){window.location= "?paysupplier&"+val;}
</script>



<!-------------------------------------------- RETURN MED/SUP ------------------------------------------->
<?php
if(isset($_POST['btnsub'])){
$supplier = $_POST['supplier'];
$alias = $_POST['alias'];
$dfrom = $_POST['dfrom'];
$dto = $_POST['dto'];
$voucher = $_POST['voucher'];
echo"<script>window.location='?$alias&supplier=$supplier&voucher=$voucher&dfrom=$dfrom&dto=$dto';</script>";
}
?>
<div class="modal fade" id="decking" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> Create Supplier Payable Voucher</h5>
<button type="button" class="btn-close" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">

<form method="POST">
<input type="hidden" name="alias" value="makesupvoucher">
<table width="98%" align="center">
<tr><td>
<font color="black">
Voucher Number:<br><input type="text" name="voucher" value="<?php echo "VC".date("YmdHis"); ?>"class="form-control"><br>
Date From:<br><input type="date" name="dfrom" value="<?php echo date("Y-m") ?>-01"class="form-control"><br>
Date To:<br><input type="date" name="dto" value="<?php echo date("Y-m") ?>-31"class="form-control"><br>
Supplier:<br>
<select class="form-control" name="supplier">
<?php												
$sqlm = "SELECT suppliercode,suppliername FROM supplierscsr ORDER BY suppliername ASC";
$resultm = $conn->query($sqlm);
while($rowm = $resultm->fetch_assoc()) {
$supplier=$rowm['suppliercode']."_".$rowm['suppliername'];
echo"<option value='$supplier'>$rowm[suppliername]</option>";
} ?>
</select>
<br></font>
<p align="right"><button type="submit" name='btnsub' class="btn btn-danger"><i class="fa fa-submit"></i> Submit</button></p>
</td></tr></table>
</form>

</div>
</div>
</div>
</div>
<!---------------------------------------- END RETURN MED/SUP ------------------------------------------->
