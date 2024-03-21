
<?php
include "../main/class.php";
include "../main/header.php";
$isearch = $_GET['search'];

if(isset($_POST['finalized'])){
$caseno = $_POST['caseno'];
$dt = date("Y-m-d h:s:i a");
$transid = "REFUND-".date("YmdHsi");
$sql = "update requestreturn set status='Finalized', transid='$transid', datetimereq='$dt', requser='$user' where caseno='$caseno' and status='pending' and ip='$my_ip'";
if($conn->query($sql) === TRUE){

// ------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
$coder = date("Ymdhis");
$dates = date("M-d-Y");
$dt= date("Y-m-d h:s:i a");

$sql2 = "select * from requestreturn where caseno='$caseno' and transid='$transid'";
$result2=$conn->query($sql2);
while($rowj = $result2->fetch_assoc()){
$refno=$rowj['refno'];
$origrefno=$rowj['origrefno'];
$ofr=$rowj['ofr'];
$code=$rowj['code'];
$qty=$rowj['quantity'];
$amount=$rowj['amount'];
$discount=$rowj['discount'];
$rr=$rowj['rr'];

$amount1 = $amount1 + $amount;
$discount1 = $discount1 + $discount;

$sql2a = "select * from productout where caseno='$caseno' and refno='$refno' and productcode='$code'";
$result2a=$conn->query($sql2a);
while($rowja = $result2a->fetch_assoc()) {
$quantity=$rowja['quantity'];
$gross = $rowja['gross'];
$adjustment = $rowja['adjustment'];
$description = $rowja['productdesc'];
$unitcost = $rowja['sellingprice'];
$location = $rowja['location'];
}

$sql2a = "select * from collection where acctno='$caseno'";
$result2a=$conn->query($sql2a);
while($rowja = $result2a->fetch_assoc()){$patientname=$rowja['acctname'];}

$updatedqty = $quantity - $qty;
$updatedgross = $gross - $amount;
$updatedadj = $adjustment - $discount;

$conn->query("update productout set quantity ='$updatedqty', gross='$updatedgross', excess='$updatedgross', adjustment='$updatedadj' where caseno='$caseno' and refno='$refno' and productcode='$code'");
$conn->query("INSERT INTO `stocktable`(`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`) VALUES ('$dates', '$rr', '$coder', '', '$caseno', '$patientname', '$code', '$description', '$unitcost', '$qty', '', '', '$qty', '', '', 'return', 'NONE', '$dates', '$location', '', '', '', '$user', '', '', CURTIME(), CURDATE())");
$conn->query("INSERT INTO `refunditems`(`refno`, `caseno`, `code`, `desc`, `amount`, `disc`, `quantity`, `vdate`, `vtime`, `user`) VALUES ('$ofr', '$caseno', '$code', '$description', '$amount', '$discount', '$qty', CURDATE(), CURTIME(), '$user', '$transid')");
}

$conn->query("INSERT INTO `collection`(`refno`, `acctno`, `acctname`, `ofr`, `description`, `accttitle`, `amount`, `discount`, `date`, `Dept`, `username`, `shift`, `type`, `paymentTime`, `paidBy`, `datearray`, `branch`) VALUES ('$transid','$caseno','$patientname','$ofr','REFUND-ITEMS','REFUND-ITEMS','$amount1', '$discount1','$dates','','$user','PENDING REFUND','',CURTIME(),'$dept', CURDATE(),'$branch')");
// ----------------------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

echo"<script>window.location='requestreturn2.php?search=$isearch';</script>";
}
}




if(isset($_POST['btn_req'])){
$qtyreturn = $_POST['qtyreturn'];
$qty = $_POST['qty'];
$ofr = $_POST['ofr'];
$origrefno = $_POST['origrefno'];
$refno = $_POST['refno'];
$code = $_POST['code'];
$caseno = $_POST['caseno'];
$batchno = $_POST['batchno'];
$sp = $_POST['sp'];
$gross = $_POST['gross'];
$adj = $_POST['adj'];

// ============================================= FIXED MAGIC CALCULATION ================================================
// ----------------------------------
$sqldk = "SELECT * from collection where refno='$origrefno' and acctno='$caseno'";
$resultdk = $conn->query($sqldk);
while($rowdk = $resultdk->fetch_assoc()) {
$amount22=$rowdk['amount'];
$discount22 = $rowdk['discount'];
}

// ------------ PENDING ---------------
$po = "SELECT * from productout where refno='$origrefno' and caseno='$caseno'";
$po1 = $conn->query($po);
while($po2 = $po1->fetch_assoc()) {
$refno1=$po2['refno'];
$quantity1 += $po2['quantity'];
}
// ------------------------------------

// ------------ DISPENSE --------------
if($refno1!=""){
$po1 = "SELECT * from productout where referenceno='$refno1' and caseno='$caseno'";
$po11 = $conn->query($po1);
while($po21 = $po11->fetch_assoc()) {
$refno2=$po21['refno'];
$quantity2 += $po21['quantity'];
} }
// ------------------------------------

// ------------ ADMINISTER --------------
if($refno2!=""){
$po11 = "SELECT * from productout where referenceno='$refno2' and caseno='$caseno'";
$po111 = $conn->query($po11);
while($po211 = $po111->fetch_assoc()) {
$refno3=$po211['refno'];
$quantity3 += $po211['quantity'];
} }
// ------------------------------------

// ------------ RETURNED --------------
$po114 = "SELECT * from requestreturn where caseno='$caseno' and refno='$refno' and origrefno='$origrefno' and ofr='$ofr' and code='$code' and status='DONE'";
$po1114 = $conn->query($po114);
while($po2114 = $po1114->fetch_assoc()){
$quantity4 += $po2114['quantity'];
}
// ------------------------------------

// ------------- GET QUANTITY -------------
$quantity = $quantity1 + $quantity2 + $quantity3 + $quantity4;
//echo"<script>alert('$quantity');</script>";
// ----------------------------------------

$indv_amt = $amount22 / $quantity;
$indv_disc = $discount22 / $quantity;
$newamt = $qtyreturn * $indv_amt;
$newdisc = $qtyreturn * $indv_disc;
//echo "<script>alert('amount:$indv_amt <br> Quantity: $quantity <br> TOTAL: $amount22 <br> QTYRETURN: $qtyreturn <br> REFUND: $newamt');</script>";
// ===================================================================================================================

$terminalname = $_POST['terminalname'];
if($qtyreturn>$qty){echo"<script>alert('Request for return quantity is grater than quantity xx');</script>";}
else{
$sql2 = "select * from requestreturn where caseno='$caseno' and refno='$refno' and origrefno='$origrefno' and ofr='$ofr' and code='$code' and status='pending'";
$result2=$conn->query($sql2);
$countt = mysqli_num_rows($result2);

if($countt>0){
$sql = "update requestreturn set quantity='$qtyreturn', amount='$newamt', discount='$newdisc', ip='$my_ip' where caseno='$caseno' and refno='$refno' and origrefno='$origrefno' and ofr='$ofr' and code='$code' and status='pending'";
if($conn->query($sql) === TRUE) {}

$sqlb = "update logs_arv1 set quantity='$qtyreturn', amount='$newamt', discount='$newdisc' where caseno='$caseno' and refno='$refno' and origrefno='$origrefno' and ofr='$ofr' and code='$code' and status='pending'";
if($conn->query($sqlb) === TRUE) {}
}else{
$sql = "insert into requestreturn (`caseno`, `refno`, `origrefno`, `ofr`, `code`, `quantity`, `status`, `amount`, `discount`, rr, reqdept, ip) values ('$caseno','$refno','$origrefno','$ofr','$code','$qtyreturn','pending','$newamt','$newdisc','$terminalname', '$dept', '$my_ip')";
if($conn->query($sql) === TRUE) {}

$sqlb = "insert into logs_arv1 (`caseno`, `refno`, `origrefno`, `ofr`, `code`, `quantity`, `status`, `amount`, `discount`, rr, reqdept) values ('$caseno','$refno','$origrefno','$ofr','$code','$qtyreturn','pending','$newamt','$newdisc','$terminalname', '$dept')";
if($conn->query($sqlb) === TRUE) {}
}

if($qtyreturn=="0" or $qtyreturn==""){
$sqlc = "delete from requestreturn where caseno='$caseno' and refno='$refno' and origrefno='$origrefno' and ofr='$ofr' and code='$code' and status='pending'";
if($conn->query($sqlc) === TRUE) {}
}
}
echo"<script>window.location='requestreturn2.php?search=$isearch';</script>";
}



if(isset($_POST['btnremove'])){
$id = $_POST['id'];
$conn->query("delete from `requestreturn` where id='$id'");
echo"<script>alert('Successfully removed $id!'); window.location='requestreturn2.php?search=$isearch';</script>";
}
?>

<img style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; margin: auto; width: 400px; display: none;" src="../main/img/loading.gif" id="loading2"></img>
<table width="100%" align="center">
<tr>
<td style="text-align: left;">
<form method="GET" action="requestreturn2.php">
<div class="input-group mb-3" style="width: 40%;">
<span class="input-group-text" id="basic-addon1" style="box-shadow: 0 0 5px #67a6ee; background-color: white;">&#128269;</span>
<input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="search" id="search_text" placeholder="Search OR Number.." onchange="loadx();" style="box-shadow: 0 0 5px #67a6ee; background-color: white;">
</div>
</form>
</td>
</tr>
</table>
</div>


<?php
if(isset($_GET['search'])){ 
$sq = $conn->query("select * from collection c, admission a where c.acctno=a.caseno and c.ofr='$isearch'");
if(mysqli_num_rows($sq)>0){

while($res = $sq->fetch_assoc()){$patientidno = $res['patientidno']; $caseno = $res['caseno'];}

mysqli_query($conn,"SET NAMES 'utf8'");
$sqlx2 = "SELECT * FROM patientprofile where patientidno='$patientidno'";
$resultx2 = $conn->query($sqlx2);
while($rowx2 = $resultx2->fetch_assoc()) {
$patientidno=$rowx2['patientidno'];
$sex=$rowx2['sex'];
if($sex=="F"){$sex="FEMALE"; $avat = "female";}
else{$sex="MALE"; $avat = "male";}
$age=$rowx2['age'];
$birthdate=$rowx2['birthdate'];
$senior=$rowx2['senior'];
$patientname=$rowx2['patientname'];
}
?>

<div class="col">
<div class="card teacher-card">
<div class="card-body  d-flex">
<div class="profile-av pe-xl-4 pe-md-2 pe-sm-4 pe-4 text-center w220">
<img src='../main/img/<?php echo $avat ?>.png' width='80' height='80' style='border-radius: 50%;'>
<div class="about-info d-flex align-items-center mt-1 justify-content-center flex-column"><font size="1px">OR Number: <b><?php echo $isearch ?></b></font></div>
</div>


<div class="teacher-info border-start ps-xl-4 ps-md-3 ps-sm-4 ps-4 w-100">
<table width="100%"><tr>
<td width="80%">
<h6  class="mb-0 mt-2  fw-bold d-block fs-6"><?php echo strtoupper($patientname) ?></h6>
<span class="py-1 fw-bold small-11 mb-0 mt-1"><?php echo $address ?></span><br>
<font size="1" align="left">Patient ID: <b><?php echo $patientidno ?></b><br>Caseno: <b><?php echo $caseno ?></b></font>
</td>
</tr>
</table>




</div>
</div>
</div>
</div>


<br>


<table width="98%" align='center'><tr><td width="60%" valign="TOP">

<div class='dd-handle'>
<div class='task-info d-flex align-items-center justify-content-between'>
</div>
<table class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th style="font-size: 11px;" width="75%">Description</th>
<th style="font-size: 11px;">Qty</th>
</tr>
</thead>
<tbody>

<?php
$i=0;
$sql = "SELECT * FROM collection where ofr = '$isearch' and type='cash-Visa' and (accttitle='PHARMACY/MEDICINE' OR accttitle like'%supplies%')";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()){
$refno = $row['refno'];
$acctno = $row['acctno'];
$acctname = $row['acctname'];
$ofr = $row['ofr'];
$description = $row['description'];
$accttitle = $row['accttitle'];
$amount = $row['amount'];
$discount = $row['discount'];
$paymentTime = $row['paymentTime'];
$datearray = $row['datearray'];
$username = $row['username'];

$i++;
$resultj = $conn->query("select * from productout where refno='$refno' and caseno='$acctno'");
while($rowj = $resultj->fetch_assoc()){
$batchno = $rowj['batchno'];
$pcode = $rowj['productcode'];
}

$sqlj = "select * from productout where caseno='$acctno' and batchno='$batchno' and productcode='$pcode' and quantity>0 and status='PAID'";
$resultj = $conn->query($sqlj);
while($rowj = $resultj->fetch_assoc()){
$code= $rowj['productcode'];
$productdesc = $rowj['productdesc'];
$qty = $rowj['quantity'];
$refno2 = $rowj['refno'];
$status = $rowj['administration'];
$terminalname = $rowj['terminalname'];
$coll ="";
$sp = $rowj['sellingprice'];
$gross = $rowj['gross'];
$adj = $rowj['adjustment'];

$quant=""; $coll="";
$result22=$conn->query("select * from requestreturn where caseno='$acctno' and refno='$refno2' and origrefno='$refno' and ofr='$ofr' and code='$pcode'");
while($row22 = $result22->fetch_assoc()){
$quant = $row22['quantity'];
$stat = $row22['status'];
$coll = "red";
}

$productdesc=str_replace("mak-","",$productdesc);
$productdesc=str_replace("-med","",$productdesc);
$productdesc=str_replace("-sup","",$productdesc);
$productdesc=str_replace("ams-","",$productdesc);

$h++;

$totqty = $qty - $quant;
if($totqty>0){
echo"

<tr>
<td style='text-align:left; font-size: 12px;'><font color='gray'>Refno:</font> $refno2<br><font color='gray'>Desc:</font> <b>$productdesc</b><br><font color='gray'>Qty:</font> <span class='badge bg' style='background: #b2117b; color: white;'>$qty</span><br><font color='gray'>Status:</font> $status</td>
<td style='text-align:left; color: white;'>
<form method='post'>
<table width='100%'><tr><td>
<input type='text' name='qtyreturn' value='$qty' class='form-control' style='text-align:center;'>
</td><td width='10%'>
<button type='submit' name='btn_req' class='btn btn-danger' style='background: #5d1537; color: white;'><i class='icofont-check-circled'></i></button>
<input type='hidden' name='qty' value='$qty'>
<input type='hidden' name='ofr' value='$ofr'>
<input type='hidden' name='origrefno' value='$refno'>
<input type='hidden' name='refno' value='$refno2'>
<input type='hidden' name='code' value='$code'>
<input type='hidden' name='caseno' value='$acctno'>
<input type='hidden' name='batchno' value='$batchno'>
<input type='hidden' name='terminalname' value='$terminalname'>
<input type='hidden' name='sp' value='$sp'>
<input type='hidden' name='gross' value='$gross'>
<input type='hidden' name='adj' value='$adj'>
</td></tr></table>
</form>
</td>
</tr>

";
}
}
}
echo"</tbody></table></div>";
?>


</td><td width="2%"></td><td valign="TOP">
<br><br>
<div class='card' style='box-shadow: 0px 0px 0px 1px lightgrey;'>
<div class='card-body'>
<div class='d-flex align-items-center justify-content-between mt-5'>
<div class='lesson_name'>
<div class='project-block light-danger-bg'>
<i class='icofont-undo'></i>
</div>
<span class='small project_name fw-bold'>Request for Refund </span>
</div>
</div>

<table align="right"><tr><td>
<a href='../resultform/ticket_return.php?caseno=<?php echo $caseno ?>&transid=<?php echo $transid ?>&user=<?php echo $user ?>' target='_blank'><button class="btn btn-primary btn-sm" style="background: #15415e; color: white;"><i class="icofont-paper"></i> Review Entries</button></a>
</td><td>
<form method="POST">
<button type="submit" name="finalized" class="btn btn-danger btn-sm" style="background: #631a2f; color: white;" onclick="return confirm('Are you sure you want to finalize?');"><i class="icofont-recycle-alt"></i> Finalized Refund</button>
<input type='hidden' name='caseno' value='<?php echo $acctno ?>'>
</form>
</td></tr></table><br>

<table align="center" class="table" width="100%">
<tr>
<td style='font-size: 11px;' width="95%"><b>Item</td>
<td style='font-size: 11px;'></td>
</tr>
<?php
$result=$conn->query("select * from requestreturn where caseno='$acctno' and status='pending'");
while($row = $result->fetch_assoc()) {
$code = $row['code'];
$qty = $row['quantity'];
$amount= $row['amount'];
$refno= $row['refno'];
$id= $row['id'];

$resultj = $conn->query("select * from receiving where code='$code'");
while($rowj = $resultj->fetch_assoc()){$desc = $rowj['description']." (".$rowj['generic'].")";}

$desc=str_replace("mak-","",$desc);
$desc=str_replace("-med","",$desc);
$desc=str_replace("-sup","",$desc);
$desc=str_replace("ams-","",$desc);

echo"
<form method='POST'>
<tr>
<td style='font-size: 11px;'><font color='gray'>Refno:</font> $refno<br><font color='gray'>Desc:</font> $desc<br><font color='gray'>Qty:</font> <span class='badge bg' style='background: #b2117b; color: white;'>$qty</span><br><font color='gray'>Amount:</font> $amount</td>
<td>
<button type='submit' name='btnremove' class='btn btn-outline-primary btn-sm' style='background: #260948; color: white;'><i class='icofont-trash'></i></button>
<input type='hidden' name='id' value='$id'>
</td>
</tr>
</form>
";
}
?>
</table></div></div>


</div></div>

</td></tr></table>

<?php }else{echo"<h5>No Record Found....</h5>";} } include "../main/footer.php"; ?>


<script>
function loadx(){document.getElementById("loading2").style.display="";}
function unloadx(){document.getElementById("loading2").style.display="none";}
</script>
