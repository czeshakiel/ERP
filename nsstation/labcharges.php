<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?detail&caseno=<?php echo $caseno ?>">Patient Information</a></li>
<li class="breadcrumb-item"><a href="?labcharges&caseno=<?php echo $caseno ?>">Laboratory Charges</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<p><b><i class="bi bi-file-earmark-medical"></i> Laboratory Charges <font size="1">[ <?php echo $caseno." - ".$ptname ?> ]</font></b></p><hr>

<style>.arrr tr:hover td {background: lightyellow;}</style>
<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th style='font-size: 11px;'></th>
<th width="30%" style='font-size: 11px;'><b>DESCRIPTION</th>
<th class='text-center' style='font-size: 11px;'><b>TRANTYPE</th>
<th class='text-center' style='font-size: 11px;'><b>DATE/ TIME<br>REQUESTED</th>
<th width="20%" style='font-size: 11px;'><b>USER</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$lab = $conn->query("select * from accounttitlemaster where grp1='labtest'");
while($res = $lab->fetch_assoc()){
$accttitle = $res['accttitle'];

$sql2 = "SELECT * from productout where productsubtype like '%$accttitle%' and status!='requested' and caseno='$caseno' order by productsubtype, productdesc";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$code=$row2['productcode'];
$desc=$row2['productdesc'];
$datearray=$row2['datearray'];
$invno=$row2['invno'];
$qty=$row2['quantity'];
$luser=$row2['loginuser'];
$trantype=$row2['trantype'];
$adm=$row2['terminalname'];
$referenceno=$row2['referenceno'];
$approvalno=explode("_", $row2['approvalno']);
$productsubtype=$row2['productsubtype'];
$datearray2=$row2['datearray'];
$invno2=$row2['invno'];


$i++;
echo"
<tr>
<td style='font-size: 11px;'><input type='checkbox'></td>
<td style='font-size: 11px;'><font color='gray'>Desc:</font> <b>$desc</b><br><font color='gray'>Accttitle:</font> $productsubtype</td>
<td style='font-size: 11px;'><font color='gray'>Trantype:</font> $trantype<br><font color='gray'>Status:</font> $adm</td>
<td style='font-size: 11px;'><font color='gray'>Date:</font>$datearray2<br><font color='gray'>Time:</font> $invno2</td>
<td style='font-size: 11px;'>

<div class='accordion-item'>
<button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapseTwo$i' aria-expanded='false' aria-controls='flush-collapseTwo' style='height:30px; font-size:12pt; padding: 0px;'>
<font size='2%'>USER >>>>></font>
</button>

<div id='flush-collapseTwo$i' class='accordion-collapse collapse' aria-labelledby='flush-headingTwo' data-bs-parent='#accordionFlushExample'>
<div class='accordion-body'>$luser</div>
</div>
</div>

</td>
</tr>
";
}
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
