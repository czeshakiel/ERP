<?php $pono1 = "PO".date("YmdHis"); ?>
<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?purchaserequest">Purchase Request</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<table width="100%"><tr><td>
<font color="black"><b><i class="bi bi-credit-card-2-back"></i> PURCHASE REQUISITION</b></font>
</td><td align="right">

<button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#requestreturn2"><i class="bi bi-plus-circle-dotted"></i> New Purchase Request</button>
</td></tr></table><hr>


<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th class="text-center">Supplier Information</th>
<th class="text-center">PO NO and PO Date</th>
<th class="text-center">Type and Terms</th>
<th class="text-center">Requesting User</th>
<th></th>
</tr>
</thead>
<?php
$i=0; $amount=0; $disym = date("Y-m");
$sqlyy = "SELECT * from purchaseorder where reqdept='$dept' and (trantype='charge' or trantype='cash') and status='pending' group by po order by generic desc";
$resultyy = $conn->query($sqlyy);
while($rowyy = $resultyy->fetch_assoc()) {
$supplier = $rowyy['supplier'];
$suppliercode = $rowyy['suppliercode'];
$pono = $rowyy['po'];
$rrno= $rowyy['rrno'];
$trantype = $rowyy['trantype'];
$terms = $rowyy['terms'];
$datearray = date("F d, Y", strtotime($rowyy['reqdate']));
$requser = $rowyy['user'];
$i++;
$datenow = date("Y-m-d");
$supplierx = $suppliercode."_".$supplier;
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

if($diff<=1){$imoji = "laughing"; $coll="green";}
elseif($diff>1 and $diff<5){$imoji = "simple-smile"; $coll="blue";}
elseif($diff>5 and $diff<10){$imoji = "expressionless";  $coll="yellow";}
elseif($diff>10 and $diff<20){$imoji = "sad";  $coll="";}
else{$imoji = "angry"; $coll="red";}

echo"
<tr>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><table width='100%'><tr><td width='20%'><font size='5%'><i style='color: $coll;' class='icofont-$imoji'></i></font></td><td> $suppliercode<br>$supplier</td></tr></table></td>
<td align='center' style='color: $colx; font-size: 11px;'>$pono<br>$datearray</td>
<td align='center' style='color: $colx; font-size: 11px;'>$trantype<br>$terms</td>
<td align='center' style='color: $colx; font-size: 11px;'>$requser<br>$dd</td>
<td align='center'><a href='?purchaserequest2&supplier=$supplierx&rrno=$pono&trantype=$trantype&terms=$terms&transdate=$datearray'><button class='btn btn-outline-primary btn-sm' title='Manage'><i class='icofont-check-circled'></i></button></a></td>
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
$supplier = $_POST['supplier'];
$transdate = $_POST['transdate'];
$trantype = $_POST['trantype'];
$terms = $_POST['terms'];
$rrno = $_POST['rrno'];
echo"<script>window.location='?purchaserequest2&supplier=$supplier&transdate=$transdate&trantype=$trantype&terms=$terms&rrno=$rrno';</script>";
}
?>

<div class="modal fade" id="requestreturn2" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog" style="box-shadow: 0px 0px 2000px #6e7fcb;">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> NEW PURCHASE REQUISITION</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<form role="form" name="f1" method="POST" onSubmit="return submitPO();">
<input type="hidden" name="rrno" value="<?php echo $pono1 ?>">

<table width="95%" align="center">
<tr>
<td width="35%" align="right" style="padding: 10px;"><font class="font8">Date Requested:&nbsp;&nbsp;</td>
<td><input  name='transdate' name='transdate' type='date' style="height:30px; font-size:12pt; padding: 0px; width: 100%;" required></td>
</tr>
<tr>
<td align="right" style="padding: 10px;"><font class="font8">Terms:&nbsp;&nbsp;</td>
<td>
<select name="terms" class="form-control" id="terms" style="height:30px; font-size:12pt; padding: 0px;" required>
<option value="">SELECT TERMS</option>
<option value="none">none</option>
<option value="60">60</option>
<option value="45">45</option>
<option value="30">30</option>
<option value="15">15</option>
</select>
</td>
</tr>
<tr>
<td align="right" style="padding: 10px;"><font class="font8">Transaction Type:&nbsp;&nbsp;</td>
<td>
<select name="trantype" class="form-control" id="trantype" style="height:30px; font-size:12pt; padding: 0px;">
<option value="charge">CHARGE</option>
<option value="cash">CASH</option>
<option value="EXCESS STOCKS">EXCESS STOCKS</option>
<option value="FREE GOODS">FREE GOODS</option>
</select>
</td>
</tr>
<tr>
<td align="right" style="padding: 10px;"><font class="font8">Suppier:&nbsp;&nbsp;</td>
<td>
<select name="supplier" class="form-control" id="supplier" style="height:30px; font-size:12pt; padding: 0px;" required>
<option value="">SELECT SUPPLIER</option>
<?php												
$sqlm = "SELECT suppliercode,suppliername FROM supplierscsr ORDER BY suppliername ASC";
$resultm = $conn->query($sqlm);
while($rowm = $resultm->fetch_assoc()) {
$supplier=$rowm['suppliercode']."_".$rowm['suppliername'];
echo"<option value='$supplier'>$rowm[suppliername]</option>";
} ?>
</select>
</td>
</tr>
<tr>
<td colspan="2" style="text-align: right;"><input type="submit" name="submit" value="SUBMIT" class="btn btn-primary" ></td>
</tr>
</table>
</form> 

</div>
</div>
</div>
</div>
<!---------------------------------------- END RETURN MED/SUP ------------------------------------------->
