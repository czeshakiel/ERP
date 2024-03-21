<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?servemonitoring">Served Monitoring</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">


<body  onload="startTime()">

<?php
if(isset($_POST['datefrom']) and isset($_POST['dateto'])){$datefrom = $_POST['datefrom']; $dateto = $_POST['dateto'];}
else{$datefrom = date("Y-m-d"); $dateto = date("Y-m-d");}
?>



<table width="100%"><tr>
<td><b><i class="bi bi-file-earmark-medical"></i> SERVE MONITORING </b></td>
<td align="right">
<form method="POST">
<table width="30%"><tr>
<td><input type="date" name="datefrom" value="<?php echo $datefrom ?>"></td>
<td>-</td>
<td><input type="date" name="dateto" value="<?php echo $dateto ?>"></td>
<td><input type="submit" class="btn btn-primary btn-sm" value="SUBMIT"></td>
</tr></table>
</form>
</td>

</tr></table>
<hr>


<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th class="text-center">#</th>
<th class="text-center">DESCRIPTION</th>
<th class="text-center">CHARGE TO</th>
<th class="text-center">USER PROCESS</th>
</tr>
</thead>
<tbody>
<?php
$i = 0;
$sql2dd = "SELECT * FROM stocktable where trantype='dispensed' and datearray between '$datefrom' and '$dateto' and dept='$dept'";
$result2dd = $conn->query($sql2dd);
while($row2dd = $result2dd->fetch_assoc()) {
$autono=$row2dd['autono'];
$quantity=$row2dd['quantity'];
$quantity = str_replace("-", "", $quantity);
$userlog=$row2dd['receivinguser'];
$codexx=$row2dd['code'];
$desc=$row2dd['description'];
$caseno=$row2dd['suppliercode'];
$name=$row2dd['suppliername'];
$ptcaseno=$row2dd['suppliercode'];

$i++;
echo"
<tr>
<td class='text-center'><font color='black'>$i.</font></td>
<td style='font-size:11px;'>$codexx<br><b>$desc</b></font></td>
<td style='font-size:11px;'><font color='gray'>Caseno:</font>$ptcaseno<br><font color='gray'>Name:</font>$name</td>
<td style='font-size:11px;'><font color='gray'>Quantity:</font> $quantity<br><font color='gray'>User:</font> $userlog</td>
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

