<?php
$supplier = $_GET['supplier'];
$voucher = $_GET['voucher'];
$dfrom = $_GET['dfrom'];
$dto = $_GET['dto'];
list($supcode, $supname) = explode("_", $supplier);

if(isset($_POST['btnsave'])){
$pono = $_POST['pono'];
$rrno = $_POST['rrno'];
$invoice = $_POST['invoice'];
$amount = $_POST['amount'];
$wvat = $_POST['wvat'];
$total = $_POST['net'];
$ck = $_POST['ck'];

$grandtotal = 0;
$sql = $conn->query("select * from stocktablepayables where po='$pono' and rrno='$rrno' and invno='$invoice'");
while($row2 = $sql->fetch_assoc()){
$discountprice=$row2['prodtype1'];
$origprice=$row2['unitcost'];
$quantity=$row2['quantity'];
$stockalert=$row2['stockalert'];
if($discountprice>0){$origprice = $discountprice;}
$ifyes += $origprice*$quantity;

if($stockalert>0){
$price = $origprice / 1.12;
$total = ($origprice - ($price*0.01)) * $quantity;
$grandtotal+=$total;
}else{
$price = $origprice;
$total = ($origprice - ($price*0.01)) * $quantity;
$grandtotal+=$total;
}
}
if($ck=="yes"){$grandtotal = $ifyes;}
$grandtotal=number_format($grandtotal, 2, '.', '');
$conn->query("INSERT INTO `suppliervoucher`(`voucherid`, `po`, `rr`, `invno`, `amount`, `acknowledge`, `dateposted`, `user`, `status`, `supplier`) VALUES ('$voucher', '$pono', '$rrno', '$invoice', '$grandtotal', '$ck', CURDATE(), '$user', 'pending', '$supplier')");
echo"<script>window.location='?makesupvoucher&supplier=$supplier&voucher=$voucher&dfrom=$dfrom&dto=$dto';</script>";
}


if(isset($_POST['btndel'])){
$id = $_POST['code'];
$conn->query("delete from suppliervoucher where id='$id'");
echo"<script>alert('deleted..'); window.location='?makesupvoucher&supplier=$supplier&voucher=$voucher&dfrom=$dfrom&dto=$dto';</script>";
}

if(isset($_POST['btnfinalized'])){
$conn->query("update suppliervoucher set status='finalized' where voucherid='$voucher'");
echo"<script>alert('Success!!'); window.location='?paysupplier';</script>";
}
?>


<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?paysupplier">Payment to Supplier</a></li>
<li class="breadcrumb-item">Payment to Supplier Details</li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<p><b><i class="bi bi-file-earmark-medical"></i> MAKE SUPPLIER PAYMENT VOUCHER</b></p><hr>


<table width="100%">
<tr><td width="55%" valign="top">


<div class='card' style="box-shadow: 0px 0px 1px 1px lightgrey;">
<div class='card-body'>


<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th>#</th>
<th>DATE</th>
<th>RRNO/ INVOICE/ PO</th>
<th>AMOUNT/ VAT/ TOTAL</th>
<th></th>
</tr>
</thead>
<tbody>
<?php

$i=0;
$sql = "SELECT * from stocktablepayables where datearray between '$dfrom' and '$dto' and suppliercode='$supcode'  and (paymentstatus = 'charge' or paymentstatus = 'pending') and trantype = 'charge' group by rrno, po, invno order by rrno asc";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$duedate=$row['duedate'];
$rrno=$row['rrno'];
$suppliername=$row['suppliername'];
$suppliercode=$row['suppliercode'];
$isid=$row['isid'];
$invno=$row['invno'];
$po=$row['po'];
$date=$row['date'];
$datearray =$row['datearray'];
$myval = $rrno."_".$po."_".$invno;

$grandtotal = 0; $wvat = 0; $net = 0;
$sql2 = "SELECT * from stocktablepayables where rrno='$rrno' and po ='$po' and invno = '$invno'";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$discountprice=$row2['prodtype1'];
$origprice=$row2['unitcost'];
$quantity=$row2['quantity'];
$stockalert=$row2['stockalert'];

if($discountprice>0){$origprice = $discountprice;}

$grandtotal += $origprice*$quantity;
if($stockalert>0){
$price = $origprice / 1.12;
$wvat += ($origprice-$price) * $quantity;
}

$net=$grandtotal-$wvat;
}
$grandtotal=number_format($grandtotal, 2, '.', '');
$wvat=number_format($wvat, 2, '.', '');
$net=number_format($net, 2, '.', '');

$result2x = $conn->query("SELECT * from suppliervoucher where rr='$rrno' and po ='$po' and invno = '$invno'");
if(mysqli_num_rows($result2x)<=0){
$i++;
echo"
<tr>
<td bgcolor='$col' class='text-center' style='font-size: 11px;'>$i</td>
<td style='font-size: 11px;' valign='TOP'><a href='http://$ip/ERP/medmatrix/rr_print/$invno/$rrno' target='_blank'><font color='blue'><i class='icofont-printer'></i> Print</font></a><br><font color='gray'>Due:</font>$duedate<br><font color='gray'>Trans:</font>$datearray</td>
<td style='font-size: 11px;'><font color='gray'>RRNO:</font>$rrno<br><font color='gray'>Invoice:</font>$invno<br><font color='gray'>PO No:</font>$po</td>
<td style='font-size: 11px;'><font color='gray'>Amount:</font>$grandtotal<br><font color='gray'>Wvat:</font>$wvat<br><font color='gray'>Total:</font>$net</td>
"; ?>
<td style="text-align: center;"><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal22cc" style="border: none; padding: 4px 10px; font-size: 10px; margin: 2px 1px;" onclick="loaddata('<?php echo $po ?>', '<?php echo $rrno ?>', '<?php echo $invno ?>', '<?php echo $grandtotal ?>', '<?php echo $wvat ?>', '<?php echo $net ?>');"><i class="icofont-check"></i></button></td>
<?php echo"
</tr>
";
} }
?>
</tbody>
</table>


</div>
</div>


</td><td width="1%"></td><td valign="TOP">

<div class='card' style="box-shadow: 0px 0px 1px 1px lightgrey;">
<div class='card-body'>

<form method="POST"><button type="submit" onclick="return confirm('Are you sure you want to finalize this Voucher?');" class="btn btn-success btn-sm" name="btnfinalized"><i class='icofont-ui-clip-board'></i> Finalize Voucher</button></form><hr>

<table align="center" width="95%">
<tr>
<td width="50%" style='font-size: 11px;'>Supplier: <br><b><?php echo $supname ?></td>
<td style='font-size: 11px;'>Voucher: <b><br><?php echo $voucher ?></td>
</tr>
</table>
<hr class="sidebar-divider">


<table width="98%" class="table">
<tr>
<td style='font-size: 11px;'><b>PO</td>
<td class="text-center" style='font-size: 11px;'><b>RR</td>
<td class="text-center" style='font-size: 11px;'><b>Invoice</td>
<td class="text-center" style='font-size: 11px;'><b>Amount</td>
<td class="text-center" style='font-size: 11px;'><b>Action</td>
</tr>

<?php
$totalxx="0.00";
$sql3="SELECT * FROM suppliervoucher WHERE voucherid='$voucher'";
$sqlAdded=mysqli_query($conn,$sql3);
while($item=mysqli_fetch_array($sqlAdded)){
$po = $item['po'];
$rr = $item['rr'];
$inv = $item['invno'];
$amount = $item['amount'];
$id = $item['id'];
$totalx += $amount;
$amountx = number_format($amount, 2);
$totalxx = number_format($totalx, 2);
echo"
<tr>
<td style='font-size: 11px;'>$po</td>
<td style='font-size: 11px;'>$rr</td>
<td style='font-size: 11px;'>$inv</td>
<td style='font-size: 11px;'>$amountx</td>
<td style='text-align: center;'>
<form method='POST'>
<button type='submit' class='btn btn-warning' name='btndel' style='border: none; padding: 4px 10px; font-size: 10px; margin: 2px 1px;'><i class='icofont-trash'></i></button>
<input type='hidden' name='code' value='$id'>
</form>
</td>
</tr>
";
}
echo"
<tr>
<td colspan='3'><b>Total</td>
<td colspan='2'><b>₱ $totalxx</td>
</tr>
";
?>
</table><br>
</div>
</div>


</td></tr>
</table>




</div>
</div>
</div>
</div>
</section>
</main>






<!------------------------------------>
<form method="POST">
<div class="modal fade" id="exampleModal22cc" tabindex="-1">
<div class="modal-dialog glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> Create Supplier Payable Voucher</h5>
<button type="button" class="btn-close" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">

<table align='center' width='90%'>
<tr>
<td><font color='black'>PO Number: </td>
<td><input type='text' name='pono' id='pono' style='font-size:13px; padding: 5px; width: 100%;' readonly></td>
</tr>
<tr>
<td><font color='black'>RR Number: </td>
<td><input type='text' name='rrno' id='rrno' style='font-size:13px; padding: 5px; width: 100%;' readonly></td>
</tr>
<tr>
<td><font color='black'>Invoice: </td>
<td><input type='text' name='invoice' id='invoice' style='font-size:13px; padding: 5px; width: 100%;' readonly></td>
</tr>
<tr>
<td><font color='black'>Amount: </td>
<td><input type='text' name='amount' id='amount' style='font-size:13px; padding: 5px; width: 100%;' readonly></td>
</tr>

<tr>
<td><font color='black'>Wvat: </td>
<td><input type='text' name='wvat' id='wvat' style='font-size:13px; padding: 5px; width: 100%;' readonly></td>
</tr>
<tr>
<td><font color='black'>Total: </td>
<td><input type='net' name='net' id="net" style='font-size:13px; padding: 5px; width: 100%;' readonly></td>
</tr>
<tr>
<td><font color='black'>Withholding TAX: </td>
<td><input type="checkbox" name="ck" value="yes"></td>
</tr>
<tr>
<td></td>
<td style='text-align: right;'><button type='submit' name='btnsave' class='btn btn-danger' style='border: none; padding: 4px 10px; font-size: 14px; margin: 2px 1px;'><i class='fa-solid fa-clipboard'></i> Post Data</button></td>
</tr>
</table>

</div>
</div>
</div>
</div>
</form>
<!------------------------------------>


<script>
function loaddata(pono, rrno, invoice, amount, wvat, net){
document.getElementById("pono").value = pono;
document.getElementById("rrno").value = rrno;
document.getElementById("invoice").value = invoice;
document.getElementById("amount").value = amount;
document.getElementById("wvat").value = wvat;
document.getElementById("net").value = net;
}
</script>

