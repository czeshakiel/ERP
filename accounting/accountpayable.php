<?php
$grandtotal = 0; $wvat = 0; $net = 0;
$sql = "SELECT * from stocktablepayables where (paymentstatus = 'charge' or paymentstatus = 'pending') and trantype = 'charge' and datearray>='2020-04-01'";
$result = $conn->query($sql);
while($row2 = $result->fetch_assoc()){
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

$sql2 = "SELECT * from stocktablepayables where paymentstatus = 'paid' and trantype = 'charge' and datearray>='2020-04-01'";
$result2 = $conn->query($sql2);
while($row22 = $result2->fetch_assoc()){
$discountprice2=$row22['prodtype1'];
$origprice2=$row22['unitcost'];
$quantity2=$row22['quantity'];
$stockalert2=$row22['stockalert'];

if($discountprice2>0){$origprice2 = $discountprice2;}
$grandtotal2 += $origprice2*$quantity2;
if($stockalert2>0){
$price2 = $origprice2 / 1.12;
$wvat2 += ($origprice2-$price2) * $quantity2;
}
$net12=$grandtotal2-$wvat2;
}
$mynet = $net - $net12;
$grossunpaid = number_format($net, 2);
$grosspaid = number_format($net12, 2);
$netunpaid = number_format($mynet, 2);
?>
<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?view=main">Main</a></li>
<li class="breadcrumb-item"><a href=""></a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<p><b><i class="bi bi-file-earmark-medical"></i> ACCOUNT PAYABLES</b></p><hr>

<table align="center" width="85%"><tr><td>
<div class="card mb-3">
<div class="card-body d-sm-flex justify-content-between">
<a class="d-flex">
<img class="avatar rounded-circle" src="../main/img/supplier.png" alt="">
<div class="flex-fill ms-3 text-truncate">
<h6 class="d-flex justify-content-between mb-0"><span>AP - SUPPLIER</span></h6>
<span class="text-muted">Total Paid: ₱<?php echo $grosspaid ?></span>
</div>
</a>
<div class="text-end d-none d-md-block">
<p class="mb-1"><i class="icofont-money ps-1"></i> Total Amount: ₱<?php echo $grossunpaid ?></p>
<span class="text-muted">Total Unpaid (Balance): ₱<?php echo $netunpaid ?></span>
</div>
</div>
<div class="card-footer justify-content-between d-flex align-items-center">
<div class="d-none d-md-block">

</div>
<div class="card-hover-show">
<a class="btn btn-sm btn-warning border lift" href="?paysupplier"><i class="icofont-list"></i> Make Voucher</a>
<a class="btn btn-sm btn-success border lift" href="#"><i class="icofont-sub-listing"></i> View Detail</a>
</div>
</div>
</div>


<div class="col-lg-4 col-sm-5 ms-auto">
<table class="table table-clear">
<tbody>
<tr>
<td ><strong>Total Amount</strong></td>
<td class="text-end">₱<?php echo $grossunpaid ?></td>
</tr>
<tr>
<td ><strong>Total Paid</strong></td>
<td class="text-end">₱<?php echo $grosspaid ?></td>
</tr>
<tr>
<td ><strong>Balance (Unpaid)</strong></td>
<td class="text-end"><strong>₱<?php echo $netunpaid ?></strong></td>
</tr>
</tbody>
</table>
</div>

</td></tr></table>



</div>
</div>
</div>
</div>
</section>
</main>

