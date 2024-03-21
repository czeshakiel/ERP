<?php
$rrno = "RR".date("YmdHis");
if(isset($_GET['undone'])){
$vb = "undone";
$db = "stocktablepreview";
$dis = "Done";
$dis2="";
}else{
$vb = "done";
$db = "stocktablepayables";

$dis = "Undone";
$dis2="&undone";
}
?>
<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?manualreceiving">Manual Receiving</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<table width="100%"><tr><td>
<font color="black"><b><i class="bi bi-credit-card-2-back"></i> MANUAL RECEIVING <small>[<?php echo date("F, Y"); ?>]</small></b>
</td><td align="right">
<a href='?manualreceiving<?php echo $dis2 ?>'><button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#requestreturn2" style="background: #5d1537; color:white;"><i class="icofont-plus-circle"></i> <?php echo $dis ?> Transaction</button></a>
<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#requestreturn2"><i class="icofont-plus-circle"></i> Create New Transaction</button>
</td></tr></table><hr>


<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th class="text-center">Supplier Information</th>
<th class="text-center">Invoice and RRNO</th>
<th class="text-center">Type and Terms</th>
<th class="text-center">Date Posting and Total</th>
<th></th>
</tr>
</thead>
<?php
$i=0; $amount=0; $disym = date("Y-m");
$sqlyy = "SELECT date, suppliername, suppliercode, invno, po, rrno, trantype, terms, datearray, transdate, duedate, sum(unitcost*quantity) as total 
FROM $db where datearray like '$disym%%' group by invno, po, rrno";
$resultyy = $conn->query($sqlyy);
while($rowyy = $resultyy->fetch_assoc()) {
$supplier = $rowyy['suppliername'];
$suppliercode = $rowyy['suppliercode'];
$supplierx = $suppliercode."_".$supplier;
$invno = $rowyy['invno'];
$pono = $rowyy['po'];
$rrno= $rowyy['rrno'];
$trantype = $rowyy['trantype'];
$terms = $rowyy['terms'];
$transdate = $rowyy['transdate'];
$duedate = $rowyy['duedate'];
$isconfirm = $rowyy['date'];
$datearray = date("F d, Y", strtotime($rowyy['datearray']));
$total = number_format($rowyy['total'], 2);
$i++;
if($pono == ""){$pono="USING MANUAL RECEIVING";}

echo"
<tr>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><table width='100%'><tr><td width='15%'><font size='5%'><i class='icofont-basket'></i></td><td> $suppliercode<br>$supplier</td></tr></table></td>
<td align='center' style='color: $colx; font-size: 11px;'>$invno<br>$rrno</td>
<td align='center' style='color: $colx; font-size: 11px;'>$trantype<br>$terms</td>
<td align='center' style='color: $colx; font-size: 11px;'>$datearray<br>$total</td>
<td align='center'>
";

if($vb=="done"){echo"<a href='../medmatrix/rr_print/$invno/$rrno' target='_blank'><button class='btn btn-outline-primary btn-sm'><i class='icofont-printer'></i></button></a>";}
else{echo"<a href='?manualreceiving2&supplier=$supplierx&transdate=$transdate&trantype=$trantype&terms=$terms&invoicedate=$duedate&invno=$invno&rrno=$rrno'><button class='btn btn-outline-danger btn-sm'><i class='icofont-ui-edit'></i></button></a>";}

echo"
</td>
</tr>
";
}
?>
</table>
        

</div>
</div>
</div>
</div>
</section>
</main>


<!-------------------------------------------- RETURN MED/SUP ------------------------------------------->
<?php
if(isset($_POST['btnsubmit'])){
    $supplier = $_POST['supplier'];
    $transdate = $_POST['transdate'];
    $trantype = $_POST['trantype'];
    $terms = $_POST['terms'];
    $invoicedate = $_POST['invoicedate'];
    $invno = $_POST['invno'];
    $rrno = $_POST['rrno'];
    echo"<script>window.location='?manualreceiving2&supplier=$supplier&transdate=$transdate&trantype=$trantype&terms=$terms&invoicedate=$invoicedate&invno=$invno&rrno=$rrno';</script>";
}
?>
<div class="modal fade" id="requestreturn2" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog" style="box-shadow: 0px 0px 2000px #6e7fcb;">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> NEW TRANSACTION</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<form role="form" name="f1" method="POST" onSubmit="return submitPO();">
<input type="hidden" name="rrno" value="<?php echo $rrno ?>">

<table width="95%" align="center">
<tr>
<td>Invoice No:<br><input  name='invno' name='id' type='text' style="height:30px; font-size:12pt; padding: 0px; width:100%;" required><p></td>
</tr>
<tr>
<td>Invoice Date:<br><input  name='invoicedate' name='invoicedate' type='date' style="height:30px; font-size:12pt; padding: 0px; width:100%;" value="<?php echo date('Y-m-d'); ?>" required><p></td>
</tr>
<tr>
<td>Transaction Date:<br><input  name='transdate' name='transdate' type='date' style="height:30px; font-size:12pt; padding: 0px; width:100%;" value="<?php echo date('Y-m-d'); ?>" required><p></td>
</tr>
<tr>
<td>
Terms:
<select name="terms" class="form-control" id="terms" style="height:30px; font-size:12pt; padding: 0px;" required>
<option value="">SELECT TERMS</option>
<option value="none">none</option>
<option value="60">60</option>
<option value="45">45</option>
<option value="30">30</option>
<option value="15">15</option>
</select><br>
</td>
</tr>
<tr>
<td>
Transaction Type:
<select name="trantype" class="form-control" id="trantype" style="height:30px; font-size:12pt; padding: 0px;">
<option value="charge">CHARGE</option>
<option value="cash">CASH</option>
<option value="EXCESS STOCKS">EXCESS STOCKS</option>
<option value="FREE GOODS">FREE GOODS</option>
</select><br>
</td>
</tr>
<tr>
<td>
Suppier:
<select name="supplier" class="form-control" id="supplier" style="height:30px; font-size:12pt; padding: 0px;" required>
<option value="">SELECT SUPPLIER</option>
<?php												
$sqlm = "SELECT suppliercode,suppliername FROM supplierscsr ORDER BY suppliername ASC";
$resultm = $conn->query($sqlm);
while($rowm = $resultm->fetch_assoc()) {
$supplier=$rowm['suppliercode']."_".$rowm['suppliername'];
echo"<option value='$supplier'>$rowm[suppliername]</option>";
} ?>
</select><br>
</td>
</tr>
<tr>
<td style="text-align: right;"><input type="submit" name="btnsubmit" value="SUBMIT" class="btn btn-primary" ></td>
</tr>
</table>
</form> 

</div>
</div>
</div>
</div>
<!---------------------------------------- END RETURN MED/SUP ------------------------------------------->
