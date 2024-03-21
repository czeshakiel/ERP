<?php
if(isset($_POST['datef']) or isset($_POST['datet'])){
$datef = $_POST['datef'];
$datet = $_POST['datet'];
}else{
$datef = date("Y-m-d");
$datet = date("Y-m-d");
}

$branchx = $_POST['branch'];
?>

<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?chargeslip">Charge Slip</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<table width="100%"><tr>
<td><b><i class="bi bi-file-earmark-medical"></i> CHARGE SLIP [RR BRANCH] </b></td>
<td align="right">
<form method="POST">
<table width="60%"><tr>
<td>
<select name="branch" style="padding: 3px;">
<option value="">Select Branch</option>
<option value="AMSHI">AMSHI</option>   
<option value="MMSHI">MMSHI</option>   
<option value="CMSHI">CMSHI</option>   
<option value="MMHI">MMHI</option>   
</select>
</td>
<td><input type="date" name="datef" value="<?php echo $datef ?>"></td>
<td>-</td>
<td><input type="date" name="datet" value="<?php echo $datet ?>"></td>
<td><button type="submit" class="btn btn-primary btn-sm" value="Submit"><i class='icofont-check-circled'></i> Submit</button></td>
</tr></table>
</form>
</td>
</tr></table><hr>

<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th class="text-center">#</th>
<th class="text-center">BRANCH</th>
<th class="text-center">PO</th>
<th class="text-center">RRNO</th>
<th class="text-center">INVOICE</th>
<th class="text-center"></th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$sql = "Select * from stocktablepayables where dept='$branchx' and datearray between '$datef' and '$datet' group by invno, rrno, po";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()){
$po=$row['po'];
$rrno=$row['rrno'];
$invno=$row['invno'];
$deptx=$row['dept'];


echo"
<tr>
<td style='font-size: 12px;'>$i.</td>
<td style='font-size: 12px;'>$deptx</b></td>
<td style='font-size: 12px;'>$po</td>
<td style='font-size: 12px;'>$rrno</td>
<td style='font-size: 12px;'>$invno</td>
<td style='text-align: center;'>
<a href='../printslip/chargeslip/$po/$rrno/$invno' target='_blank' class='btn btn-primary btn-sm' style='border-radius: 50%;'><i class='icofont-printer'></i></a>
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
