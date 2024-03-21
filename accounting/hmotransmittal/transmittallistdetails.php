<?php
$hmo = $_GET['hmo'];
$hmo2 = explode("_", $hmo);
$mm = $_GET['mm'];
$yy = $_GET['yy'];
$dd = $_GET['dd'];

$vdate = $yy."-".$mm."-".$dd;
$mm2 = date("F", strtotime($vdate));
?>
<!-- Datatables -->
<div class="col-lg-12" style="width: 100%;">
<div class="card mb-4">
<div class="table-responsive p-3">

<h5><font color='black'><i class="fa-solid fa-list-check"></i> FOR PROCESSING TRANSMITTAL <b>(<?php echo $mm2." ".$dd.", ".$yy ?>)</b></font></h5><hr>
<table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
<thead>
<tr>
<th class="text-center">#</th>
<th class="text-center">Company/Trantype</th>
<th class="text-center">Batchno/ User</th>
<th class="text-center">Amount</th>
<th class="text-center">Date</th>
<th class="text-center">Stat</th>
<th class="text-center"></th>
</tr>
</thead>
<tbody>


<?php
$i = 0;
$sql4 = "select sum(amount) as amount, batchno, transdate, user, company, controlno, idhmo, trantype, ptype from arv_tbl_hmotransmittallist where transdate='$vdate'
 and transaction = 'Approved' and status='pending' group by batchno";
$result4 = $conn->query($sql4);
while($row4 = $result4->fetch_assoc()) {
$batchno=$row4['batchno'];
$amount=$row4['amount'];
$amount2=number_format($row4['amount'], 2);
$transdate=date("F d, Y", strtotime($row4['transdate']));
$userx=$row4['user'];
$company=$row4['company'];
$idhmo=$row4['idhmo'];
$controlno=$row4['controlno'];
$trantype=$row4['trantype'];
$ptype=$row4['ptype'];
$hmo = $idhmo."_".$company;
$i++;

$ispaid=0; $count=0;
$sql44 = $conn->query("select count(controlno) as cc from arv_tbl_hmotransmittallist where transaction = 'Approved' and batchno='$batchno'");
while($row44 = $sql44->fetch_assoc()) {$count = $row44['cc'];}

$sql441 = $conn->query("select count(controlno) as cc from arv_tbl_hmotransmittallist where transaction = 'Approved' and status='PAID' and batchno='$batchno'");
while($row441 = $sql441->fetch_assoc()) {$ispaid = $row441['cc'];}

if($trantype=="insurance"){$dist = "processingdetails";}else{$dist = "processingdetailsassist";}


echo"
<tr>
<td style='font-size:12px;'>$i</td>
<td style='font-size:12px;'>$company<br>$trantype ($ptype)</td>
<td style='font-size:12px;'>$batchno<br>$userx</td>
<td style='font-size:12px;'>$amount2</td>
<td style='font-size:12px;'>$transdate</td>
<td style='font-size:12px;'>$ispaid / $count</td>
<td><a href='?$dist&hmo=$hmo&batchno=$batchno&controlno=$controlno&transdate=$transdate'>
<button class='btn btn-primary btn-sm'><i class='icofont-eye'></i> VIEW</button>
</a></td>
</tr>
";
  }  
  
  ?>
</tbody>
</table>

</div>
</div>
</div>
