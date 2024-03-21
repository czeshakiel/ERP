<?php
if(isset($_GET['deleteitem'])){
$caseno = $_GET['caseno'];
$refno = $_GET['refno'];
$conn->query("update productout set caseno='$caseno-ERRORADM' where caseno='$caseno' and refno='$refno'");
echo"<script>alert('$caseno ----> $refno'); window.history.back();</script>";
}

if(isset($_POST['supplies'])){
    $danger="outline-primary";
    $danger2="primary";
    $que="SUPPLIES";
}else{
    $danger="primary";
    $danger2="outline-primary";
    $que="MEDICINE";
}
?>

<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?detail&caseno=<?php echo $caseno ?>">Patient Information</a></li>
<li class="breadcrumb-item"><a href="?medicationsheetgroup&caseno=<?php echo $caseno ?>">Medication Sheet Group</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<table width="100%"><tr>
<td width="70%">
<p><b><i class="bi bi-file-earmark-medical"></i> MEDICATION SHEET GROUP <font size="1">[ <?php echo $caseno." - ".$ptname ?> ]</font></b></p>
</td><td>
<table width="100%"><tr>
<td width="50%"><form method="POST"><button type="submit" name="medicine" class="btn btn-<?php echo $danger ?>" style="width: 100%;"><i class="icofont-pills"></i> Medicines</button></form></td>
<td><form method="POST"><button type="submit" name="supplies" class="btn btn-<?php echo $danger2 ?>" style="width: 100%;"><i class="icofont-injection-syringe"></i> Supplies</button></form></td>
</tr></table>
</td></tr></table>
<hr>

<style>.arrr tr:hover td {background: lightyellow;}</style>
<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th style='font-size: 11px;'></th>
<th width="50%" style='font-size: 11px;'><b>DESCRIPTION</th>
<th class='text-center' style='font-size: 11px;'><b>QTY</th>
<th class='text-center' style='font-size: 11px;'><b>TRANTYPE</th>
<th class='text-center' style='font-size: 11px;'><b>ADMINISTRATION</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$sql2 = "SELECT sum(quantity) as quantity, productcode, productdesc, trantype, administration, productsubtype, status from productout where productsubtype like '%$que%' and (administration = 'dispensed' OR administration = 'administered') and quantity<>0 and caseno='$caseno' 
 group by productcode, administration, trantype order by trantype desc, productdesc asc, administration";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$code=$row2['productcode'];
$desc=$row2['productdesc'];
$datearray=$row2['datearray'];
$invno=$row2['invno'];
$qty=$row2['quantity'];
$luser=$row2['loginuser'];
$trantype=$row2['trantype'];
$adm=$row2['administration'];
$referenceno=$row2['referenceno'];
$status=$row2['status'];

$approvalno=$row2['approvalno'];
$approvalno=str_replace(" ", "_", $approvalno);
$approvalno=explode("_", $approvalno);

$productsubtype=$row2['productsubtype'];
$batchno=$row2['batchno'];
$refno=$row2['refno'];

if($adm=="administered"){$sec = "danger"; $ico ="check-circled";}else{$sec="secondary"; $ico="not-allowed";}

$desc = str_replace("ams-", "", $desc);
$desc = str_replace("mak-", "", $desc);
$desc = str_replace("-med", "", $desc);
$desc = str_replace("-sup", "", $desc);
$i++;
echo"
<tr>
<td style='font-size: 11px;'><input type='checkbox' style='transform : scale(1.7);'></td>
<td style='font-size: 11px;'><font color='gray'>Desc:</font> <b>$desc</b><br><font color='gray'>Accttitle:</font> $productsubtype</td>
<td class='text-center' style='font-size: 14px;'>$qty</td>
<td style='font-size: 11px;'><font color='gray'>Trantype:</font> $trantype<br><font color='gray'>Status:</font> $status</td>
<td style='font-size: 16px;'><span class='badge bg-$sec'><i class='icofont-$ico'></i> $adm</span></td>
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
