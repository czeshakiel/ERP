<?php
$dfrom = $_GET['dfrom'];
$dto = $_GET['dto'];
$supplier = $_GET['supplier'];
list($supcode, $supname) = explode("_", $supplier);
?>

<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?prhistory">Purchase Receiving History</a></li>
<li class="breadcrumb-item"><a>Purchase Receiving History List</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<table width="100%"><tr>
<td width="35%" valign="TOP">

<div class="card" style='box-shadow: 0px 0px 0px 1px #0a0a42;'>
<div class="card-header" style="background-color: #0a0a42; padding: 7px;">
<table width="100%"><tr><td style="color: white;"> <i class="bi bi-award"></i> PURCHASE RECEIVING HISTORY</td></tr></table>
</div>
<div class="card-body">
<br><table width="100%" align="center">
<tr><td width="50%"><font class="font8">Supplier:<br><input type="text" name="newcaseno" class="form-control" value="<?php echo $supname ?>" readonly></td></tr>
<tr><td width="50%"><font class="font8">Date From:<br><input type="text" name="newcaseno" class="form-control" value="<?php echo $dfrom ?>" readonly></td></tr>
<tr><td width="50%"><font class="font8">Date To:<br><input type="text" name="newcaseno" class="form-control" value="<?php echo $dto ?>" readonly></td></tr>
</table><br>
</div>
</div>

</td>
<td width="2%"></td>
<td valign="TOP">
<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th class="text-center">#</th>
<th class="text-center" width="35%">DATE</th>
<th class="text-center" width="35%">RRNO/ INVOICE</th>
<th class="text-center" width="20%">STATUS</th>
<th class="text-center"></th>
</tr>
</thead>
<tbody>
<?php

$i=0;
$sql = "SELECT * from stocktablepayables where datearray between '$dfrom' AND '$dto' and suppliercode='$supcode' and dept='$dept' group by rrno order by rrno asc";
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

$extratotalgross = 0; $wvat = 0; $net = 0;
$sql2 = "SELECT * from stocktablepayables where rrno = '$rrno'";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$discountprice=$row2['prodtype1'];
$origprice=$row2['unitcost'];
$quantity=$row2['quantity'];
$stockalert=$row2['stockalert'];
$trantype=$row2['trantype'];
$vat = $stockalert * $quantity;
$disc = $discountprice * $quantity;
$orig = $origprice * $quantity;
if($discountprice>1){$extratotalgross += $disc;}else{$extratotalgross += $orig;}
$wvat += $vat;
$net = $extratotalgross - $wvat;
}


$net2 += $net;
$col="";
$colx="black";
$blink="";
$i++;

echo"
<tr>
<td style='font-size: 11px;'>$i</td>
<td style='font-size: 11px;' valign='TOP'><font color='gray'><i class='icofont-ui-calendar'></i> Trans Date:</font> $datearray<br><font color='gray'><i class='icofont-calendar'></i> Due Date:</front> $duedate</td>
<td style='font-size: 11px;'><font color='gray'><i class='icofont-paper'></i> PO No:</font> $po<br><font color='gray'><i class='icofont-papers'></i> RR No:</font> $rrno<br><font color='gray'><i class='icofont-law-document'></i> Invoice:</font> $invno</td>
<td style='font-size: 11px;' valign='TOP'><font color='gray'><i class='icofont-prestashop'></i> Trantype:</font> $trantype<br><font color='gray'><i class='icofont-tags'></i> Amount:</font> $net</td>

<td style='text-align: center;'>
<a href=' ../medmatrix/rr_print/$invno/$rrno' target='_blank' class='btn btn-primary btn-sm' style='background:#0a0a42; color: white;'><i class='icofont-printer'></i></a>
</td>

</tr>
"; } ?>
</tbody>
</table>

</td></tr></table>

</div>
</div>
</div>
</div>
</section>
</main>
