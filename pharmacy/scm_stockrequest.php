<?php $pono1 = strtoupper($dept)."-".date("YmdHis"); ?>
<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?stockrequest">Stock Request</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">
<table width="100%"><tr><td>
<font color="black"><b><i class="bi bi-credit-card-2-back"></i> STOCK REQUISITION</b></font>
</td><td align="right">

<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#requestreturn2"><i class="icofont-plus-circle"></i> New Stock Request</button>
</td></tr></table><hr>


<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th class="text-center">Requested To</th>
<th class="text-center">Req NO and Req Date</th>
<th class="text-center">Type and Terms</th>
<th class="text-center">Requesting User</th>
<th></th>
</tr>
</thead>
<?php
$i=0; $amount=0; $disym = date("Y-m");
$sqlyy = "SELECT * from purchaseorder where reqdept='$dept' and (status='request' or status='process') group by po order by generic desc";
$resultyy = $conn->query($sqlyy);
while($rowyy = $resultyy->fetch_assoc()) {
$supplier = $rowyy['supplier'];
$suppliercode = $rowyy['suppliercode'];
$pono = $rowyy['po'];
$rrno= $rowyy['rrno'];
$trantype = $rowyy['trantype'];
$terms = $rowyy['terms'];
$datearray = date("F d, Y", strtotime($rowyy['reqdate']));
$datearray2 = $rowyy['reqdate'];
$requser = $rowyy['user'];
$reqno = $rowyy['reqno'];
$status = $rowyy['status'];
$i++;
$datenow = date("Y-m-d");
$supplierx = $suppliercode."_".$supplier;
$daterequest = $rowyy['generic'];
$reqdept = $suppliercode."_".$supplier;
$apprv = $rowyy['approvingofficer'];

// ---------------------->>>> GET TOTAL DAYS <<<---------------------
$earlier = new DateTime($rowyy['generic']);
$later = new DateTime($datenow);
$diff = $later->diff($earlier)->format("%a");
// ------------------>>>> END GET TOTAL DAYS <<<---------------------

// ---------------------->>>> GET YR, MM, DAYS <<<-------------------
$origin = new DateTime($rowyy['generic']);
$target = new DateTime($datenow);
$interval = $origin->diff($target);
$aa = $interval->format('%y-%m-%d');
list($yr, $mm, $dy) = explode("-", $aa);
if($yr>0){$dd = "$yr year(s), $mm month(s), and $dy day(s) ago";}
elseif($mm>0){$dd = "$mm month(s) and $dy day(s) ago";}
else{$dd = "$dy day(s) ago";}
// ----------------->>>>  END GET YR, MM, DAYS <<<-------------------

if($diff<=1){$imoji = "emoji-laughing";}
elseif($diff>1 and $diff<5){$imoji = "emoji-sunglasses";}
elseif($diff>5 and $diff<10){$imoji = "emoji-smile";}
elseif($diff>10 and $diff<20){$imoji = "emoji-neutral";}
else{$imoji = "emoji-frown";}

$reqno = str_replace (' ', '__', $reqno);
$dept = str_replace (' ', '__', $dept);
echo"
<tr>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><table width='100%'><tr><td width='20%'><font size='5%'><i class='bi bi-$imoji'></i></font></td><td> $suppliercode<br>$supplier</td></tr></table></td>
<td align='center' style='color: $colx; font-size: 11px;'>$pono<br>$datearray</td>
<td align='center' style='color: $colx; font-size: 11px;'>$trantype<br>NONE</td>
<td align='center' style='color: $colx; font-size: 11px;'>$requser<br>$dd</td>
<td align='center'>
";

if($status=="request"){echo"<a href='../scmprint/stockrequest/$reqno/$dept' target='_blank'><button class='btn btn-outline-primary btn-sm' title='Manage'><i class='icofont-check-circled'></i></button></a>";}
else{echo"<a href='../pharmacy/?stockrequest2&rrno=$pono&transdate=$datearray2&requesteddept=$reqdept&transactiontype=$apprv'><button class='btn btn-outline-danger btn-sm' title='Manage'><i class='icofont-pencil'></i></button></a>";}

echo"
</td>
</tr>
";
}
?>
</table>
        

</div>
</div>
</div>
</div>
</section>
</main>


<!-------------------------------------------- RETURN MED/SUP ------------------------------------------->
<?php
if(isset($_POST['submit'])){
$requesteddept=$_POST['requesteddept'];
$transdate=$_POST['transdate'];
$rrno=$_POST['rrno'];
$transactiontype=$_POST['transactiontype'];
echo"<script>window.location='?stockrequest2&rrno=$rrno&transdate=$transdate&requesteddept=$requesteddept&transactiontype=$transactiontype';</script>";
}
?>
<div class="modal fade" id="requestreturn2" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog" style="box-shadow: 0px 0px 2000px #6e7fcb;">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> NEW STOCK REQUISITION</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<form role="form" name="f1" method="POST" onSubmit="return submitPO();">
<input type="hidden" name="rrno" value="<?php echo $pono1 ?>">

<table width="95%" align="center">
<tr>
<td width="30%" style="padding: 10px;"><font class="font8">Date Requested:<br>
<input  name='transdate' name='transdate' type='date' value="<?php echo date('Y-m-d'); ?>" style="height:30px; font-size:12pt; padding: 0px;" class="form-control" required></td>
</tr>
<tr>
<td style="padding: 10px;"><font class="font8">Requested To:<br>
<select name="requesteddept" class="form-control" id="supplier" style="height:30px; font-size:12pt; padding: 0px;" required>
<option value=""></option>
<?php												
$sqlm = "SELECT * from station where (station like '%pharmacy%' or station like '%csr%' or station like '%cpu%') order by station ASC";
$resultm = $conn->query($sqlm);
while($rowm = $resultm->fetch_assoc()) {
$id = $rowm['id'];
$station = str_replace("_", "|", $rowm['station']);
$supplier=$id."_".$station;
echo"<option value='$supplier'>$rowm[station]</option>";
} ?>
</select>
</td>
</tr>

<tr>
<td style="padding: 10px;"><font class="font8">Transaction Type:<br>
<select name="transactiontype" class="form-control" id="supplier" style="height:30px; font-size:12pt; padding: 0px;" required>
<option value="charge">For Patient Use (charge)</option>
<option value="EXPENSE">Departmental Use (Expense)</option>
</select>
</td>
</tr>

<tr>
<td style="text-align: right;"><button type="submit" name="submit" value="SUBMIT" class="btn btn-primary btn-sm"><i class="icofont-check-circled"></i> Submit</button></td>
</tr>
</table>
</form> 

</div>
</div>
</div>
</div>
<!---------------------------------------- END RETURN MED/SUP ------------------------------------------->
