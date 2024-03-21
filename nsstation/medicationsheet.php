<?php
if(isset($_GET['deleteitem'])){
$caseno = $_GET['caseno'];
$refno = $_GET['refno'];
$conn->query("update productout set caseno='$caseno-ERRORADM' where caseno='$caseno' and refno='$refno'");
echo"<script>alert('$caseno ----> $refno'); window.history.back();</script>";
}
?>

<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?detail&caseno=<?php echo $caseno ?>">Patient Information</a></li>
<li class="breadcrumb-item"><a href="?medicationsheet&caseno=<?php echo $caseno ?>">Medication Sheet</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<p><b><i class="bi bi-file-earmark-medical"></i> MEDICATION SHEET <font size="1">[ <?php echo $caseno." - ".$ptname ?> ]</font></b></p><hr>

<style>.arrr tr:hover td {background: lightyellow;}</style>
<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th style='font-size: 11px;'></th>
<th width="30%" style='font-size: 11px;'><b>DESCRIPTION</th>
<th class='text-center' style='font-size: 11px;'><b>QTY</th>
<th class='text-center' style='font-size: 11px;'><b>TRANTYPE</th>
<th class='text-center' style='font-size: 11px;'><b>DATE/ TIME<br>REQUESTED</th>
<th class='text-center' style='font-size: 11px;'><b>DATE/ TIME<br>ADMINISTERED</th>
<th width="20%" style='font-size: 11px;'><b>USER</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$sql2 = "SELECT * from productout where (productsubtype like '%MEDICINE%' or productsubtype like '%SUPPLIES%') and (administration = 'dispensed' OR administration = 'administered') and quantity<>0 and caseno='$caseno' order by trantype desc, productdesc asc";
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
$gross=$row2['gross'];

$approvalno=$row2['approvalno'];
$approvalno=str_replace(" ", "_", $approvalno);
$approvalno=explode("_", $approvalno);

$productsubtype=$row2['productsubtype'];
$batchno=$row2['batchno'];
$refno=$row2['refno'];

$sql22 = "SELECT * from productout where refno='$referenceno'";
$result22 = $conn->query($sql22);
while($row22 = $result22->fetch_assoc()) {
$datearray2=$row22['datearray'];
$invno2=$row22['invno'];
$adm2=$row22['administration'];
$referenceno2=$row22['referenceno'];
}

if($adm2=="dispensed"){
$sql22 = "SELECT * from productout where refno='$referenceno2'";
$result22 = $conn->query($sql22);
while($row22 = $result22->fetch_assoc()) {
$datearray2=$row22['datearray'];
$invno2=$row22['invno'];
$adm2=$row22['administration'];
}
}


if($gross>0){$gg="";}else{
$gg="<br><h5 style='color: red;'><b>ERROR!</b></h5>";
$conn->query("update productout set caseno='$caseno-ERRORADM' where caseno='$caseno' and refno='$refno'");
}

$desc = str_replace("ams-", "", $desc);
$desc = str_replace("mak-", "", $desc);
$desc = str_replace("-med", "", $desc);
$desc = str_replace("-sup", "", $desc);
$i++;
echo"
<tr>
<td style='font-size: 11px;'><input type='checkbox'></td>
<td style='font-size: 11px;'><font color='gray'>Desc:</font> <b>$desc</b><br><font color='gray'>Accttitle:</font> $productsubtype $gg</td>
<td class='text-center' style='font-size: 13px;'>$qty</td>
<td style='font-size: 11px;'><font color='gray'>Trantype:</font> $trantype<br><font color='gray'>Status:</font> $adm</td>
<td style='font-size: 11px;'><font color='gray'>Date:</font>$datearray2<br><font color='gray'>Time:</font> $invno2</td>
<td style='font-size: 11px;'><font color='gray'>Date:</font>$approvalno[0]<br><font color='gray'>Time:</font> $approvalno[1]<br><font color='gray'>Refno:</font> $refno<br><font color='gray'>Batchno:</font> $batchno</td>
<td style='font-size: 11px;'>

<div class='accordion-item'>
<button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapseTwo$i' aria-expanded='false' aria-controls='flush-collapseTwo' style='height:30px; font-size:12pt; padding: 0px;'>
<font size='2%'>USER >>>>></font>
</button>

<div id='flush-collapseTwo$i' class='accordion-collapse collapse' aria-labelledby='flush-headingTwo' data-bs-parent='#accordionFlushExample'>
<div class='accordion-body'>$luser</div>
</div>
</div>
";
if($user=="ARVID ZANE BANDIOLA"){echo"<a href='?medicationsheet&caseno=$caseno&refno=$refno&deleteitem'>delete</a>";}

echo"
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
