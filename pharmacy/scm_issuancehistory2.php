<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?issuancehistory">Issuance History</a></li>
<li class="breadcrumb-item">Issuance History List</li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">
<p><b><i class="bi bi-file-earmark-medical"></i> ISSUANCE HISTORY LIST </b></font></p><hr>

<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>">#</th>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>">ISSUANCE ID</th>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>">SUPPLIER/<br>CHARGE TO</th>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>">REQ. USER/<br> ISSUING USER</th>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>">TRANS. DATE/<br> STATUS</th> 
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>"></th>
</tr>
</thead>
<tbody>

<?php
$datefrom = $_GET['datefrom'];
$dateto = $_GET['dateto'];
$code = $_GET['code'];

if($code=="out"){$qr = "po.dept='$dept'";}
else{$qr = "po.reqdept='$dept'";}

$i=0;
$sqla2 = "SELECT po.reqdept, po.dept, po.requser, po.user, po.status, po.reqno, SUM(po.prodqty*po.unitcost) as amount, s.datearray FROM
purchaseorder po LEFT JOIN stocktable s ON s.isid=po.reqno AND s.code=po.code WHERE $qr AND po.status='received' AND s.datearray
 BETWEEN '$datefrom' AND '$dateto' AND (po.reqno <> '' OR po.po <> '')  GROUP BY po.reqno";
$resulta2 = $conn->query($sqla2);
while($item = $resulta2->fetch_assoc()) {
$i++;

echo"
<tr>
<td bgcolor='$col' align='center'><font color='$colx' size='2'>$i.</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'>$item[reqno]</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'>$item[dept]<br>$item[reqdept]</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'>$item[requser]<br>$item[user]</td>
<td bgcolor='$col' style='color: $col1; font-size: 11px;'>$item[datearray]<br>$item[status]</td>
<td style='text-align: center;' bgcolor='$col'>
<a href='../../supplychain/print_stock_issuance/$item[reqno]' target='_blank' class='btn btn-outline-dark btn-sm' title='View Profile'>
<i class='icofont-printer'></i>
</a>
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


