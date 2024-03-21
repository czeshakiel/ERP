
<?php
error_reporting(1);
if($_SESSION['mod']=="out"){$mod="Out Patient List"; $mod2="IPD"; $ward="a.ward='out'";}
else{$mod="In Patient List"; $mod2="OPD"; $ward="a.ward='in' and a.status!='discharged'";}

if(isset($_POST['mod'])){
$module = $_POST['mod'];
if($module=="OPD"){$_SESSION['mod']="out";}else{$_SESSION['mod']="in";}
echo"<script>window.location='?main';</script>";
exit();
}
?>
<main id="main" class="main">

<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?view=main">Main</a></li>
<li class="breadcrumb-item"></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<table width="100%"><tr><td><b><i class="bi bi-credit-card-2-back"></i> REORDERING LEVEL</b>
<i style='font-size:10px;'>Reorder point formula = (<u title='Sale from date received to current date devided to number of days form date received to current date'>Average daily sales</u> 
X <u title='number of days from date purchase order to date purchase received'>Days of average Lead time</u>) - <u title='Stock-onhand'>Safety Stocks</u></i>
</td></tr></table><hr>


<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th scope="col">#</th>
<th scope="col">Item Information</th>
<th scope="col">SOH</th>
<th scope="col">Qty Used</th>
<th scope="col">Status</th>
<th scope="col"></th>
</tr>
</thead>
<tbody>

<?php
$i=0;
$sql = $conn->query("select sum(s.quantity) as soh, r.code, r.description, r.generic from stocktable s, receiving r where s.code=r.code and s.dept='$dept' group by r.code HAVING soh>0");
while($row = $sql->fetch_assoc()){ 
$code =$row['code'];
$description =$row['description'];
$generic =$row['generic'];
$soh =$row['soh'];
$i++;

$currentdate = date("Y-m-d");
$sql1 = $conn->query("select * from stocktable where dept='$dept' and code='$code' and  (trantype='charge' or trantype='cash' or trantype='STOCK TRANSFER') 
and quantity>0 order by datearray DESC limit 1");
while($res1 = $sql1->fetch_assoc()){$datereceived = $res1['datearray'];}

$sql2 = $conn->query("select sum(quantity) as qty from stocktable where dept='$dept' and code='$code' and  datearray between '$datereceived' and '$currentdate' and  quantity<0");
while($res2 = $sql2->fetch_assoc()){$qtydispensed = $res2['qty'];}
$qtydispensed = str_replace("-", "", $qtydispensed);

$sql3 = $conn->query("select sum(quantity) as qty from  stocktable where dept='$dept' and code='$code' and  datearray between '$datereceived' and '$currentdate' and  trantype='return'");
while($res3 = $sql3->fetch_assoc()){$qtyreturn = $res3['qty'];}

$qtyused = $qtydispensed - $qtyreturn;  
if($qtyused<=0){$qtyused=0;}

$date1 = new DateTime($datereceived);
$date2 = new DateTime($currentdate);
$interval = $date1->diff($date2);
$buffer = $interval->format('%a');

$averageused = $qtyused/$buffer;
$averageused = number_format($averageused, 2);

$leadtime = 2;
$reorderlevel = $averageused*$leadtime;
$reqqty = $reorderlevel - $soh;
if($reqqty<0){$reqqty = 0;}

if($reqqty>0){
echo"
<tr>
<td bgcolor='$col' align='center'><font color='$colx' size='2'>$i.</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'>$code<br><b>$description</b></td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'>$soh</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><font color='gray'>Qty Used:</font> $qtyused <br><font color='gray'>Average Used:</font> $averageused</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><font color='gray'>Re-order level:</font> $reorderlevel <br><font color='gray'>Requested Qty:</font> $reqqty</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><font color='gray'>Date Received:</font> $datereceived <br><font color='gray'>Total days [up to current]:</font> $buffer day/s</td>
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



