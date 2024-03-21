<?php
$sql = $conn->query("select sum(phic) as phic, sum(phic1) as phic1, sum(hmo) as hmo from productout where productsubtype!='PROFESSIONAL FEE'");
while($res = $sql->fetch_assoc()){$phic = $res['phic']+$res['phic1']; $phic2 = number_format($phic, 2); $hmo = $res['hmo']; $hmo2 = number_format($hmo, 2);}


// ----------------------------- AR TRADE -------------------------------
$sql2 = $conn->query("select sum(amount) as artrade from acctgenledge where acctitle='AR TRADE'");
while($res2 = $sql2->fetch_assoc()){$artrade = $res2['artrade']; $artrade2 = number_format($artrade, 2);}

$sql22 = $conn->query("select sum(amount) as artrade from acctgenledge where acctitle='AR TRADE' and status='PAID'");
while($res22 = $sql22->fetch_assoc()){$artradepaid = $res22['artrade']; $artradepaid2 = number_format($artradepaid, 2);}
$artradeunpaid = $artrade - $artradepaid;
$artradeunpaid2 = number_format($artradeunpaid, 2);
// ------------------------- END AR TRADE -------------------------------



// ----------------------------- AR EMPLOYEE -------------------------------
$sql3 = $conn->query("select sum(amount) as aremployee from collection where accttitle like '%EMPLOYEE%'");
while($res3 = $sql3->fetch_assoc()){$aremployee = $res3['aremployee']; $aremployee2 = number_format($aremployee, 2);}

$sql33 = $conn->query("select sum(amount) as aremployee from collection where accttitle like '%EMPLOYEE%' and type='PAID'");
while($res33 = $sql33->fetch_assoc()){$aremployeepaid = $res33['aremployee']; $aremployeepaid2 = number_format($aremployeepaid, 2);}
$aremployeeunpaid = $aremployee - $aremployeepaid;
$aremployeeunpaid2 = number_format($aremployeeunpaid, 2);
// ------------------------- END AR TRADE -------------------------------

$grandtotal = $phic+$hmo+$artrade;
$grandtotal2 = number_format($grandtotal, 2);

$totalpaid = $artradepaid;
$totalpaid2 = number_format($totalpaid, 2);

$totalunpaid = $grandtotal-$totalpaid;
$totalunpaid2 = number_format($totalunpaid, 2);

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

<p><b><i class="bi bi-file-earmark-medical"></i> ACCOUNT RECEIVABLE</b></p><hr>

<table align="center" width="85%"><tr><td>
<div class="card mb-3">
<div class="card-body d-sm-flex justify-content-between">
<a class="d-flex">
<img class="avatar rounded-circle" src="../main/img/phic.jpg" alt="">
<div class="flex-fill ms-3 text-truncate">
<h6 class="d-flex justify-content-between mb-0"><span>AR - Philhealth</span></h6>
<span class="text-muted">Total Paid: ₱0.00</span>
</div>
</a>
<div class="text-end d-none d-md-block">
<p class="mb-1"><i class="icofont-money ps-1"></i> Total Amount: ₱<?php echo $phic2 ?></p>
<span class="text-muted">Total Unpaid (Balance): ₱<?php echo $phic2 ?></span>
</div>
</div>
<div class="card-footer justify-content-between d-flex align-items-center">
<div class="d-none d-md-block">

</div>
<div class="card-hover-show">
<a class="btn btn-sm btn-warning border lift" href="?phicreceivable"><i class="icofont-list"></i> Generate Voucher</a>
<a class="btn btn-sm btn-success border lift" href="#">View Detail</a>
</div>
</div>
</div>

<div class="card mb-3">
<div class="card-body d-sm-flex justify-content-between">
<a class="d-flex">
<img class="avatar rounded-circle" src="../main/img/hmo.jpg" alt="">
<div class="flex-fill ms-3 text-truncate">
<h6 class="d-flex justify-content-between mb-0"><span>AR - HMO</span></h6>
<span class="text-muted">Total Paid: ₱0.00</span>
</div>
</a>
<div class="text-end d-none d-md-block">
<p class="mb-1"><i class="icofont-money ps-1"></i> Total Amount: ₱<?php echo $hmo2 ?></p>
<span class="text-muted">Total Unpaid (Balance): ₱<?php echo $hmo2 ?></span>
</div>
</div>
<div class="card-footer justify-content-between d-flex align-items-center">
<div class="d-none d-md-block">

</div>
<div class="card-hover-show">
<a class="btn btn-sm btn-success border lift" href="#">View Detail</a>
</div>
</div>
</div>

<div class="card mb-3">
<div class="card-body d-sm-flex justify-content-between">
<a class="d-flex">
<img class="avatar rounded-circle" src="../main/img/artrade.png" alt="">
<div class="flex-fill ms-3 text-truncate">
<h6 class="d-flex justify-content-between mb-0"><span>AR - Personal Trade</span></h6>
<span class="text-muted">Total Paid: ₱<?php echo $artradepaid2 ?></span>
</div>
</a>
<div class="text-end d-none d-md-block">
<p class="mb-1"><i class="icofont-money ps-1"></i> Total Amount: ₱<?php echo $artrade2 ?></p>
<span class="text-muted">Total Unpaid (Balance): ₱<?php echo $artradeunpaid2 ?></span>
</div>
</div>
<div class="card-footer justify-content-between d-flex align-items-center">
<div class="d-none d-md-block">

</div>
<div class="card-hover-show">
<a class="btn btn-sm btn-warning border lift" href="?artrade"><i class="icofont-list"></i> Make Payment</a>
<a class="btn btn-sm btn-success border lift" href="#">View Detail</a>
</div>
</div>
</div>



<div class="card mb-3">
<div class="card-body d-sm-flex justify-content-between">
<a class="d-flex">
<img class="avatar rounded-circle" src="../main/img/artrade.png" alt="">
<div class="flex-fill ms-3 text-truncate">
<h6 class="d-flex justify-content-between mb-0"><span>AR - EMPLOYEE</span></h6>
<span class="text-muted">Total Paid: ₱<?php echo $aremployeepaid2 ?></span>
</div>
</a>
<div class="text-end d-none d-md-block">
<p class="mb-1"><i class="icofont-money ps-1"></i> Total Amount: ₱<?php echo $aremployee2 ?></p>
<span class="text-muted">Total Unpaid (Balance): ₱<?php echo $aremployeeunpaid2 ?></span>
</div>
</div>
<div class="card-footer justify-content-between d-flex align-items-center">
<div class="d-none d-md-block">

</div>
<div class="card-hover-show">
<a class="btn btn-sm btn-warning border lift" href="?aremployee"><i class="icofont-list"></i> Make Payment</a>
<a class="btn btn-sm btn-success border lift" href="#">View Detail</a>
</div>
</div>
</div>



<div class="col-lg-4 col-sm-5 ms-auto">
<table class="table table-clear">
<tbody>
<tr>
<td ><strong>Total Amount</strong></td>
<td class="text-end">₱<?php echo $grandtotal2 ?></td>
</tr>
<tr>
<td ><strong>Total Paid</strong></td>
<td class="text-end">₱<?php echo $totalpaid2 ?></td>
</tr>
<tr>
<td ><strong>Balance (Unpaid)</strong></td>
<td class="text-end"><strong>₱<?php echo $totalunpaid2 ?></strong></td>
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

