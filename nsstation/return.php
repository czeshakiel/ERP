<?php include "../main/class.php"; include "../main/header.php"; ?>
<style>
  .tablex {
  border-collapse: separate;
  border-spacing: 0;
  width: 100%;
  

}
.tablex tr th,
.tablex tr td {
  border-right: 1px solid #bbb;
  border-bottom: 1px solid #bbb;
  padding: 5px;
  text-align: left;
  /*font-family: "Arial", Arial, San-serif;*/
    font-family: Arial, Helvetica, sans-serif;
}
.tablex tr th:first-child,
.tablex tr td:first-child {
  border-left: 1px solid #bbb;
}
.tablex tr th {

  border-top: 1px solid #bbb;
  text-align: left;
}

/* top-left border-radius */
.tablex tr:first-child th:first-child {
  border-top-left-radius: 6px;
}

/* top-right border-radius */
.tablex tr:first-child th:last-child {
  border-top-right-radius: 6px;
}

/* bottom-left border-radius */
.tablex tr:last-child td:first-child {
  border-bottom-left-radius: 6px;
}

/* bottom-right border-radius */
.tablex tr:last-child td:last-child {
  border-bottom-right-radius: 6px;
}
}
</style>
<?php
$caseno = $_GET['caseno'];
if(isset($_POST['btnpass'])){
$password = $_POST['password'];
$newbatch = "NB-".date("YmdHis");

$sqlg = "SELECT * FROM nsauth where password = '$password' and station='$dept'";
$resultg = $conn->query($sqlg);
$existing2 = mysqli_num_rows($resultg);
while($rowg = $resultg->fetch_assoc()) {
$finaluser = $rowg['name'];
}

if($existing2>0){
$sql778 = "UPDATE `productreturn` set trantype='finalized', username=concat('Return by: ',username, ' <br> Finalized by: ', '$finaluser'), origqty='$newbatch'  where trantype='pending' and caseno='$caseno'";
if ($conn->query($sql778) === TRUE) {}


$cc = 0;
$sql = "SELECT * FROM productreturnCN where caseno='$caseno' and trantype='pending'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$refno2 = $row['refno1'];
$qtyret = $row['quantity1'];
$cc++;
//echo"<script>alert('$refno2');</script>";

$sqlz = "SELECT * FROM productout where caseno='$caseno' and refno='$refno2'";
$resultz = $conn->query($sqlz);
while($rowz = $resultz->fetch_assoc()) {
$qtypr = $rowz['quantity'];
$gross = $rowz['gross'];
$adj = $rowz['adjustment'];
}

$indgross = $gross / $qtypr;
$indadj = $adj / $qtypr;
$newqty = $qtypr - $qtyret;
$newgross = $newqty * $indgross;
$newadj = $newqty * $indadj;

$sql7781 = "UPDATE `productout` set quantity='$newqty', gross='$newgross', adjustment='$newadj', excess='$newgross' where refno='$refno2' and caseno='$caseno'";
if ($conn->query($sql7781) === TRUE) {}
}

$sql778 = "UPDATE `productreturnCN` set trantype='return', username=concat('Return by: ',username, ' <br> Finalized by: ', '$user'), origqty='$newbatch'  where trantype='pending' and caseno='$caseno'";
if ($conn->query($sql778) === TRUE) {}

}else{
echo"<script>alert('Wrong username and password!');</script>";
}
echo"<script>alert('return.php?caseno=$caseno$datax);</script>";
?>
<script>
window.location="return.php?caseno=<?php echo $caseno ?><?php echo $datax ?>";
</script>
<?php
}



if(isset($_POST['btnremove'])){
$refno2 = $_POST['refno2'];

$sql778 = "delete from `productreturn` where refno2='$refno2' and caseno='$caseno'";
if ($conn->query($sql778) === TRUE) {}
echo"<script>alert('Successfully removed $refno2!');</script>";

?>
<script>
window.location="return.php?caseno=<?php echo $caseno ?><?php echo $datax ?>";
</script>
<?php
}

if(isset($_POST['btnremovecn'])){
$refno2 = $_POST['refno2'];

$sql778 = "delete from `productreturnCN` where refno2='$refno2' and caseno='$caseno'";
if ($conn->query($sql778) === TRUE) {}
echo"<script>alert('Successfully removed $refno2!');</script>";

?>
<script>
window.location="return.php?caseno=<?php echo $caseno ?><?php echo $datax ?>";
</script>
<?php
}

if(isset($_POST['btnreturn'])){
$qtyreturn = $_POST['qtyreturn'];
$qty = $_POST['qty'];
$code = $_POST['code'];
$refno = $_POST['refno'];
$batchno = $_POST['batchno'];
$rr = $_POST['rr'];
$datex = date("M-d-Y");
$dater = date("Y-m-d H:i:s");
$refno2 = date("YmdHsi");
$type = $_POST['type'];
$reason = $_POST['reason'];
$nurse22 = $_POST['nurse22'];
$station22 = $_POST['station22'];
$reason = $_POST['reason'];

if($qtyreturn != "" or $qtyreturn>0){
if($qtyreturn > $qty){$qtyreturn = $qty;}else{$qtyreturn = $qtyreturn;}
$refno2 = $refno2."".$i;

$resultz = $conn->query("SELECT * FROM productout where refno='$refno' and caseno='$caseno'");
while($rowz = $resultz->fetch_assoc()){
$qtypr = $rowz['quantity'];
$gross = $rowz['gross'];
$adj = $rowz['adjustment'];
}


$indgross = $gross / $qtypr;
$amount = $qtyreturn * $indgross;


if($type=="Return"){
if($existing>0){$sql778 = $conn->query("UPDATE `productreturn` set quantity1='$qtyreturn', username='$user', trantype='pending' where refno1='$refno' and caseno='$caseno'");}
else{
$sql778 = $conn->query("INSERT INTO `productreturn`(`caseno`, `productcode`, `quantity1`, `origqty`, `date`,
`dateofret`, `username`, `refno1`, `refno2`, `trantype`, `gross`, `postedby`, `autono`, `rrno`) values
('$caseno', '$code', '$qtyreturn', '', '$datex', '$dater', '$user', '$refno', '$refno2', 'pending', '$batchno', '$user', '$refno2', '$rr')");
}

}else{
if($existing>0){$sql778 = $conn->query("UPDATE `productreturnCN` set quantity1='$qtyreturn', username='$user', trantype='pending' where refno1='$refno' and caseno='$caseno'");}
else{
$sql778 = $conn->query("INSERT INTO `productreturnCN` (`caseno`, `productcode`, `quantity1`, `origqty`, `date`,
 `dateofret`, `username`, `refno1`, `refno2`, `trantype`, `gross`, `postedby`, `autono`, `rrno`, `nurse`, `station`, `reason`, `amount`) values ('$caseno', '$code', '$qtyreturn',
  '', '$datex', '$dater', '$user', '$refno', '$refno2', 'pending', '$batchno', '$user', '$refno2', '$rr', '$nurse22', '$station22', '$reason', '$amount')");
}

}
}
echo"<script>window.location='return.php?caseno=$caseno$datax';</script>";
}


$sqlc = "SELECT patientprofile.patientname FROM admission, patientprofile where admission.caseno='$caseno' and admission.patientidno=patientprofile.patientidno;";
$resultc = $conn->query($sqlc);
while($rowc = $resultc->fetch_assoc()) {$name = $rowc['patientname'];}
?>
<body onload="btnfinal();">
<p><font color="black"><b><i class="bi bi-file-earmark-medical"></i> Return Item for Charge Transaction Only. <font size="1">[ <?php echo $caseno." - ".$name ?> ]</font></b></font></p><hr>

<table width="98%" align='center'><tr><td width="60%" valign="TOP">
 
<div class='dd-handle'>
<div class='task-info d-flex align-items-center justify-content-between'>
</div>
<table id="myProjectTable" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th style="font-size: 11px; width: 85%;">Description</th>
<th style="font-size: 11px; width: 10%;">Qty</th>
<th style="font-size: 11px;"></th>
</tr>
</thead>
<tbody>


<?php
mysqli_query($conn,"SET NAMES 'utf8'");
$sql = "SELECT * FROM productout where caseno= '$caseno' AND quantity > 0 and (productsubtype ='PHARMACY/MEDICINE' OR productsubtype='SALES-SUPPLIES'  
OR productsubtype='gmap' OR productsubtype='PHARMACY/SUPPLIES' OR productsubtype='MEDICAL SURGICAL SUPPLIES' OR productsubtype='MEDICAL SUPPLIES') and trantype='charge' and administration='dispensed'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$refno = $row['refno'];
$productcode = addslashes($row['productcode']);
$productdesc = addslashes($row['productdesc']);
$batchno = addslashes($row['batchno']);
$datetime = addslashes($row['approvalno']);
$invno = addslashes($row['invno']);
$trantype = $row['trantype'];
$qty = $row['quantity'];
$rr = $row['terminalname'];
$referenceno = $row['referenceno'];
$gross = $row['gross'];

$ff = $conn->query("select * from productout where caseno='$caseno' and refno='$referenceno'");
while($ff1 = $ff->fetch_assoc()){$datereq = date("M d, Y", strtotime($ff1['datearray']))." ".date("h:i:s a", strtotime($ff1['invno']));}

$trantype22 = "";
$pending  = "0";
$sql2 = "SELECT sum(quantity1) as quantity1, trantype, refno2 from productreturn where (trantype='pending' OR trantype='finalized') and refno1='$refno' and caseno='$caseno'";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$pending = $row2['quantity1'];
$trantype22 = $row2['trantype'];
$refno2 = $row2['refno2'];
}

$sql22 = "SELECT sum(quantity1) as quantity1, trantype, refno2 from productreturnCN where (trantype='pending' OR trantype='finalized') and refno1='$refno' and caseno='$caseno'";
$result22 = $conn->query($sql22);
while($row22 = $result22->fetch_assoc()) {
$pending2 = $row22['quantity1'];
$trantype222 = $row22['trantype'];
$refno22 = $row22['refno2'];
}

$qty2 = $qty - ($pending + $pending2);
if($trantype22=="pending"){$col2 = "red";}elseif($trantype22=="finalized"){$col2 = "yellow";}else{$col2 = "";}

if($qty2>0){
echo"
<tr>
<td style='font-size: 11px;'>"; ?><a href="" onclick="alert('Code: <?php echo $productcode ?> \nBatchno: <?php echo $batchno ?> \nInvoice: <?php echo $invno ?> \nGross: <?php echo $gross ?>');"> <?php echo"<b>$productdesc</b></a><br><font color='gray'>Date Request:</font> $datereq</td>
<td style='font-size: 15px;'><span class='badge bg-danger'>$qty2</span></td>
<td style='font-size: 11px;'>
"; ?> <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#returnitem" onclick="valx('<?php echo $productcode ?>', '<?php echo $productdesc ?>', '<?php echo $batchno ?>', '<?php echo $invno ?>', '<?php echo $qty2 ?>', '<?php echo $rr ?>', '<?php echo $refno ?>');"><i class="icofont-check-circled"></i></button></td>
</tr> <?php
} }

echo"</tbody></table></div>";
?>

</td><td width="2%"></td><td valign="TOP">


<p align="right" id="finalbtn" style="display: none;"><button type="button" name="btnreturn" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#returnfinal"><i class="icofont-law-order"></i> Finalize Transaction</button></b></p>
<br><br>
<div class='card' style='box-shadow: 0px 0px 0px 1px lightgrey;'>
<div class='card-body'>
<div class='d-flex align-items-center justify-content-between mt-5'>
<div class='lesson_name'>
<div class='project-block light-danger-bg'>
<i class='icofont-undo'></i>
</div>
<span class='small project_name fw-bold'> Return Item/s </span>
</div>
</div>

<table align="right"><tr><td>
<div class="dropdown">
<button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 5px; font-size: 12px; background: #834747; color: white;">
<i class="icofont-printer"></i> Print Return Slip
</button>
<ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>
<?php
echo"<li><a class='dropdown-item' href='../resultform/returnslip.php?caseno=$caseno' target='_blank' style='font-size:13px;'><i class='icofont-printer'></i> Print All</a></li>";
$sqlx77 = "SELECT * FROM productreturn where caseno ='$caseno' and trantype='finalized' group by origqty order by dateofret Desc";
$resultx77 = $conn->query($sqlx77);
while($rowx77 = $resultx77->fetch_assoc()) {
$bthm= $rowx77['origqty'];
$u++;
echo"<li><a class='dropdown-item' href='../resultform/returnslip.php?caseno=$caseno&batchno=$bthm' target='_blank' style='font-size:13px;'><i class='icofont-printer'></i> $bthm</a></li>";
}
?>
</ul>
</div>
</td></tr></table><br>


<table align="center" class="table" width="100%">
<tr>
<td style='font-size: 11px;' width="75%"><b>Item</td>
<td style='font-size: 11px;'><b>Qty</td>
<td style='font-size: 11px;'></td>
</tr>
<?php
$sql = "SELECT * FROM productreturn, receiving where productreturn.productcode=receiving.code and productreturn.caseno = '$caseno' and productreturn.trantype='pending'";
$result = $conn->query($sql);
$countreturnx = mysqli_num_rows($result);
while($row = $result->fetch_assoc()) {
$desc = $row['description'];
$qty1 = $row['quantity1'];
$amount= $row['amount'];
$refno2= $row['refno2'];

$desc=str_replace("mak-","",$desc);
$desc=str_replace("-med","",$desc);
$desc=str_replace("-sup","",$desc);
$desc=str_replace("ams-","",$desc);

echo"
<form method='POST'>
<tr>
<td style='font-size: 11px;'>$desc</td>
<td style='font-size: 11px;'>$qty1<br>$amount</td>
<td>
<button type='submit' name='btnremove' class='btn btn-outline-danger btn-sm' style='padding: 5px; font-size: 10px; background: #a91e27; color: white;'><i class='icofont-trash'></i></button>
<input type='hidden' name='refno2' value='$refno2'>
</td>
</tr>
</form>
";
}
?>
</table></div></div>


<br><br>
<div class='card' style='box-shadow: 0px 0px 0px 1px lightgrey;'>
<div class='card-body'>
<div class='d-flex align-items-center justify-content-between mt-5'>
<div class='lesson_name'>
<div class='project-block light-warning-bg'>
<i class='icofont-link-broken'></i>
</div>
<span class='small project_name fw-bold'> Damage Item/s </span>
</div>
</div>

<table align="right"><tr><td>
<div class="dropdown">
<button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 5px; font-size: 12px; color: white;">
<i class="icofont-printer"></i> Print Damage Slip
</button>
<ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>
<?php
echo"<li><a class='dropdown-item' href='../resultform/damageslip.php?caseno=$caseno' target='_blank' style='font-size:13px;'><i class='icofont-printer'></i> Print All</a></li>";
$sqlx77 = "SELECT * FROM productreturnCN where caseno ='$caseno' and trantype='finalized' group by origqty";
$resultx77 = $conn->query($sqlx77);
while($rowx77 = $resultx77->fetch_assoc()) {
$bthm= $rowx77['origqty'];
$u++;
echo"<li><a class='dropdown-item' href='../resultform/damageslip.php?caseno=$caseno&batchno=$bthm' target='_blank' style='font-size:13px;'><i class='icofont-printer'></i> $bthm</a></li>";
}
?>
</ul>
</div>
</td></tr></table><br>

<table align="center" class="table" width="100%">
<tr>
<td style='font-size: 11px;' width="75%"><b>Item</td>
<td style='font-size: 11px;'><b>Qty/ Amount</td>
<td style='font-size: 11px;'></td>
</tr>
<?php
$total=0;
$sql2 = "SELECT * FROM productreturnCN, receiving where productreturnCN.productcode=receiving.code and productreturnCN.caseno = '$caseno' and productreturnCN.trantype='pending'";
$result2 = $conn->query($sql2);
$countreturnxx = mysqli_num_rows($result2);
while($row2 = $result2->fetch_assoc()) {
$nurse = $row2['nurse'];
$station = $row2['station'];
$desc = $row2['description'];
$qty1 = $row2['quantity1'];
$amount= $row2['amount'];
$refno2= $row2['refno2'];
if($amount<=0){$amount=0;}
$total += $amount;

$desc=str_replace("mak-","",$desc);
$desc=str_replace("-med","",$desc);
$desc=str_replace("-sup","",$desc);
$desc=str_replace("ams-","",$desc);
echo"
<form method='POST'>
<tr>
<td style='font-size: 11px;'>$nurse || $station<br>$desc</td>
<td style='font-size: 11px;'>$qty1<br>$amount</td>
<td>
<button type='submit' name='btnremovecn' class='btn btn-outline-danger btn-sm' style='padding: 5px; font-size: 10px; background: #a91e27; color: white;'><i class='icofont-trash'></i></button>
<input type='hidden' name='refno2' value='$refno2'>
</td>
</tr>
</form>
";
}

echo"
<tr>
<td style='font-size: 11px;'><b>TOTAL:</td>
<td style='font-size: 11px;'><b>$total</td>
<td></td>
";
?>
</table></div></div>
<br>


</td>

</tr></table>



<!-- /# row -->

<!-- End PAge Content -->





<form method="POST">

<div class="modal fade" id="returnfinal" tabindex="-1">
<div class="modal-dialog modal-xs glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="icofont-lock"></i> Authentication!</h5>
<button type="button" class="btn-close" data-bs-dismiss='modal' aria-label="Close"></button>
</div>
<div class="modal-body">

<table align="center" width="100%">
<tr><td><input type="password" name="password" class="form-control" placeholder="Enter Password here..." required></td></tr>
</table>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style='padding: 5px; font-size: 13px; color: white; background: #9d204e;'><i class='icofont-close'></i> Close</button>
<button type="submit" name="btnpass" class="btn btn-primary" style='padding: 5px; font-size: 13px; color: white; background: #291673;'><i class='icofont-check-circled'></i> Submit</button>
</div>
</div>
</div>
</div>
</form>


<form method="POST">
<!-- Modal -->

<div class="modal fade" id="returnitem" tabindex="-1">
<div class="modal-dialog glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> Return Item</h5>
<button type="button" class="btn-close" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">
  

<table align="center" width="100%">
<input type="hidden" name="code" id="code">
<input type="hidden" name="batchno" id="batchno">
<input type="hidden" name="invno" id="invno">
<input type="hidden" name="qty" id="qty">
<tr><td>Desc:<br><input type="text" name="desc" id="desc" class="form-control" readonly></td></tr>
<tr><td>Qty Return:<br><input type="text" name="qtyreturn" id="qtyreturn" class="form-control" required></td></tr>
<tr><td>Type:<br><select name="type" id="type"  class="form-control" onchange="valy();"><option>Return</option><?php if($dept=="VERIFIER"){ ?><option>Damage</option><?php } ?></select></td></tr>

<tr><td>

<table align="center" width="100%" id="damage" style="display: none;">
<tr><td><hr></td></tr>
<tr><td>Reason:<br><input type="text" name="reason" id="reason" class="form-control"></td></tr>
<tr><td>
Station Careoff:<br>
<select name="station22" class="form-control">
<?php
echo"<option value='$dept'>$dept</option>";
$sql = "SELECT * FROM station where station like 'NS%%'";
$result = $conn->query($sql);
$existing = mysqli_num_rows($result);
while($row = $result->fetch_assoc()) {
$station = $row['station'];
echo"<option value='$station'>$station</option>";
}
echo"
<option value='ICU'>ICU</option>
<option value='ER'>ER</option>
<option value='OR'>OR</option>
<option value='OPD'>OPD</option>
";
?>
</select>
</td></tr>
<tr><td>Nurse Careoff:<br>
<input list="ptid" name="nurse22" onchange="ptid(this.value);" class="form-control">
<datalist id="ptid">
<?php
$sqlccv = "SELECT * FROM nsauth where station like '%NS%' and name not like '%ARVID%' group by name order by name";
$resultccv = $conn->query($sqlccv);
while($rowccv = $resultccv->fetch_assoc()) {
$name=$rowccv['name'];
echo"<option value='$name'></option>";
}

?>
</datalist>

</td></tr>
<tr><td><hr></td></tr>
</table>

<input type="hidden" name="rr" id="rr">
<input type="hidden" name="refno" id="refno2">
</td></tr>
</table>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-warning btn-sm" data-bs-dismiss="modal">Close</button>
<button type="submit" name="btnreturn" class="btn btn-danger btn-sm">Submit</button>
</div>
</div>
</div>
</div>
</form>


<?php include "../main/footer.php"; ?>

<script>
function valx(val1, val2, val3, val4, val5, val6, val7){
document.getElementById("code").value = val1;
document.getElementById("desc").value = val2;
document.getElementById("batchno").value = val3;
document.getElementById("invno").value = val4;
document.getElementById("qty").value = val5;
document.getElementById("qtyreturn").value = val5;
document.getElementById("rr").value = val6;
document.getElementById("refno2").value = val7;
}

function valy(){
if(document.getElementById("type").value=="Damage"){
document.getElementById("damage").style.display = "";
document.getElementById("reason").attribute.requred = "requred";
}else{
document.getElementById("damage").style.display = "none";
document.getElementById("reason").attribute.requred = "";
}
}

function btnfinal(){
var creturn = "<?php echo $countreturnx ?>";
var cdamage =  "<?php echo $countreturnxx ?>";

if(creturn>0 || cdamage>0){document.getElementById("finalbtn").style.display="block";}
else{document.getElementById("finalbtn").style.display="none";}
}
</script>
