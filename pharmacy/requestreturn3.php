<?php
include "../main/class.php";
include "../main/header.php";


if(isset($_POST['final'])){
$ofr = $_POST['ofr'];
$sql = "update requestreturn set status='Finalized' where ofr='$ofr' and status='pending'";	
if($conn->query($sql) === TRUE) {}
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

/*$ind_gross = $gross / $qty;
$ind_adj = $adj / $qty;
$ind_gross2 = $ind_gross * $qtyreturn;
$ind_adj2 = $ind_adj * $qtyreturn;*/


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
if($qtyreturn>$qty)
{
echo"<script>alert('Request for return quantity is grater than quantity xx');</script>";
}else
{
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
$loc ="requestreturn3.php?batchno=$batchno&pcode=$code&refno=$origrefno&ofr=$ofr&caseno=$caseno$datax";
?>
<script>window.location="<?php echo $loc ?>";</script>
<?php

}
?>
<?php
$ofr = $_GET['ofr'];
$refno = $_GET['refno'];
$batchno = $_GET['batchno'];
$pcode = $_GET['pcode'];
$caseno = $_GET['caseno'];
session_start();
	   
$sqlconfig = "select tabname from version";
$resultconfig=$conn->query($sqlconfig);
$row1k=mysqli_fetch_array($resultconfig);
$configx=$row1k['tabname'];
?>


<p><font color="black"><b><i class="bi bi-credit-card-2-back"></i> ORNO: <font size="1"><?php echo $ofr ?></font> / BATCHNO: <font size="1"><?php echo $batchno ?></font> / REFNO: <font size="1"><?php echo $refno ?></font></b></font></p><hr>


<form action="requestreturn2.php?view=main<?php echo $datax ?>" method="POST">
<p align="left"><button class="btn btn-danger btn-sm"><i class="bi bi-arrow-left-circle"></i> Back</button></p>
<input type="hidden" name="btn_search">
<input type="hidden" name="search" value="<?php echo $ofr ?>">
</form>


<table class="table">
<tr>
<th bgcolor="<?php echo $primarycolor2 ?>" width="40%">CODE/DESCRIPTION</th>
<th bgcolor="<?php echo $primarycolor2 ?>" width="20%">STATUS/ QTY</th>
<th bgcolor="<?php echo $primarycolor2 ?>" width="15%"><font color="black">PENDING</th>
<th bgcolor="<?php echo $primarycolor2 ?>" width="15%">RETURN</th>
<th bgcolor="<?php echo $primarycolor2 ?>">action</td>
</tr>
<?php
$h=0;
$sqlj = "select * from productout where caseno='$caseno' and batchno='$batchno' and productcode='$pcode' and quantity>0 and status='PAID'";
$resultj = $conn->query($sqlj);
while($rowj = $resultj->fetch_assoc()) {
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

$sql22 = "select * from requestreturn where caseno='$caseno' and refno='$refno2' and origrefno='$refno' and ofr='$ofr' and code='$code' and status='pending'";
$result22=$conn->query($sql22);
$cc = mysqli_num_rows($result22);
if($cc>0){
while($row22 = $result22->fetch_assoc()) {
$quant = $row22['quantity'];
$stat = $row22['status'];	
$coll = "red";
}
}else{$quant=""; $coll="";}


if($stat == "Finalized"){}else{
$h++;
echo"
<form method='post'>
<tr>
<td style='text-align:left; font-size: 12px;'>$code<br><b>$productdesc</b></td>
<td style='text-align:left; font-size: 12px;'>$qty<br>$status</td>
<td bgcolor='$coll' style='text-align:center; color: white; background: #e3e3f7;'><font color='black' size='2'>$quant</td>
<td style='text-align:left; color: white;'><font color='black' size='2'><input type='text' name='qtyreturn' value='$qty' style='height:40px; font-size:15pt; padding: 5px; text-align: center;'></td>
<td style='text-align:left; color: white;'><font color='black' size='2'><button type='submit' name='btn_req' class='btn btn-danger btn-sm'><i class='icofont-check-circled'></i></button>
<input type='hidden' name='qty' value='$qty'>
<input type='hidden' name='ofr' value='$ofr'>
<input type='hidden' name='origrefno' value='$refno'>
<input type='hidden' name='refno' value='$refno2'>
<input type='hidden' name='code' value='$code'>
<input type='hidden' name='caseno' value='$caseno'>
<input type='hidden' name='batchno' value='$batchno'>
<input type='hidden' name='terminalname' value='$terminalname'>
<input type='hidden' name='sp' value='$sp'>
<input type='hidden' name='gross' value='$gross'>
<input type='hidden' name='adj' value='$adj'>
</td>
</tr>
</form>
";
}
}
if($h<1){$dis="disabled";}else{$dis="";}
?>
</table>

