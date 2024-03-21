<?php
$supplier = $_GET['supplier'];
$voucher = $_GET['voucher'];
list($supcode, $supname) = explode("_", $supplier);

if(isset($_POST['btnsave'])){
$payee = $_POST['payee'];
$total = $_POST['total'];
$status = $_POST['status'];
$bank = $_POST['bank'];
$chequeno = $_POST['chequeno'];
$cardno = $_POST['cardno'];
$cardname = $_POST['cardname'];
$statuspay = $_POST['statuspay'];
$amount = $_POST['amount'];
$refno = "RN".date('YmdHis');
    
$sql = $conn->query("select * from suppliervoucher where voucherid='$voucher'");
while($res = $sql->fetch_assoc()){
$po = $res['po'];
$rr = $res['rr'];
$invno = $res['invno'];
$conn->query("update stocktablepayables set isid='$voucher', paymentstatus='paid' where rrno='$rr' and po='$po' and invno='$invno'");
}
    
if($statuspay == "FULL"){$amm = $total;}else{$amm = $amount;}
if($status == "cheque"){$ccno = $chequeno;}elseif($status == ""){$ccno = $cardno;}
$conn->query("INSERT INTO `arv_tbl_paymentledger`(`refno`, `voucherno`, `payee`, `paymenttype`, `paymentstatus`, `ccno`, `ccname`, `amount`, `datetrans`, `datearray`, `transaction`) VALUES ('$refno', '$voucher', '$payee', '$status', '$statuspay', '$ccno', '$cardname', '$amm', '$datetrans', CURDATE(), 'credit')");
$conn->query("update suppliervoucher set status='paid' where voucherid='$voucher'");
echo"<script>alert('Successfully Saved!');</script>";
    
if($status == "cheque"){
echo"
<script>
let a=document.createElement('a');
a.target='_blank';
a.href='http://$ip/ERP/accounting/cheque/$bank.php?voucher=$voucher';
a.click();
    
window.location = '?paysupplier';
</script>
"; 
}else{echo"<script>window.location = '?paysupplier';</script>";}
}
?>


<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?paysupplier">Payment to Supplier</a></li>
<li class="breadcrumb-item">Payment to Supplier Details</li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<p><b><i class="bi bi-file-earmark-medical"></i> MAKE SUPPLIER PAYMENT VOUCHER</b></p><hr>


<table width="100%">
<tr><td width="55%" valign="top">


<div class='card' style="box-shadow: 0px 0px 1px 1px lightgrey;">
<div class='card-body'>


<form method="POST">
<table width="90%" align="center">
<tr>
<td>PAYEE:</td>
<td><input type="text" name="payee" value="<?php echo $supname ?>" style='font-size:13px; padding: 5px; width: 100%;'></td>
</tr>
<tr>
<td>TOTAL:</td>
<td><input type="text" name="total" id="total" value="<?php echo $net2 ?>" style='font-size:13px; padding: 5px; width: 100%;' readonly></td>
</tr>

<tr>
<td>PAYMENT TYPE:</td>
<td>
<select name="status" style='font-size:13px; padding: 5px; width: 100%;' onchange="paymentstat(this.value);">
<option value="cash">CASH</option>
<option value="cheque">CHEQUE</option>
<option value="card">CARD</option>
</select>
</td>
</tr>

<tr id="idline1" style="display: none;"><td colspan="2"><hr></td></tr>
<tr id="idbank" style="display: none;">
<td>BANK:</td>
<td>
<select name="bank" style='font-size:13px; padding: 5px; width: 100%;' onchange="paymentstat2(this.value);">
<option value="METROBANK">METROBANK</option>
<option value="CHINABANK">CHINA BANK</option>
<option value="BDO">BDO</option>
<option value="UCPB">UCPB</option>
</select>
</td>
</tr>

<tr id="idchequeno" style="display: none;">
<td>CHEQUE NO:</td>
<td><input type="text" name="chequeno" placeholder="Enter Cheque Number here..." style='font-size:13px; padding: 5px; width: 100%;'></td>
</tr>

<tr id="idcardname" style="display: none;">
<td>CARD NAME:</td>
<td><input type="text" name="cardname" placeholder="Enter Card Number here..." style='font-size:13px; padding: 5px; width: 100%;'></td>
</tr>


<tr id="idcardno" style="display: none;">
<td>CARD NO:</td>
<td><input type="text" name="cardno" placeholder="Enter Card Number here..." style='font-size:13px; padding: 5px; width: 100%;'></td>
</tr>
<tr id="idline2" style="display: none;"><td colspan="2"><hr></td></tr>

<tr>
<td>STATUS:</td>
<td>
<select name="statuspay" style='font-size:13px; padding: 5px; width: 100%;' onchange="paymentstat2(this.value);">
<option value="FULL">FULL-PAYMENT</option>
<option value="PARTIAL">PARTIAL-PAYMENT</option>
</select>
</td>
</tr>


<tr id="idpayment" style="display: none;">
<td>Amount:</td>
<td><input type="text" name="amount" style='font-size:13px; padding: 5px; width: 100%;'></td>
</tr>

<tr>
<td colspan="2" align="right"><button type="submit" class="btn btn-danger" name="btnsave"><i class="fa fa-eye"></i> Submit</button></td>
</tr>
</table><br>
</form>


</div>
</div>


</td><td width="1%"></td><td valign="TOP">

<div class='card' style="box-shadow: 0px 0px 1px 1px lightgrey;">
<div class='card-body'>

<table align="center" width="95%">
<tr>
<td width="50%" style='font-size: 11px;'>Supplier: <br><b><?php echo $suppliername ?></td>
<td style='font-size: 11px;'>Voucher: <b><br><?php echo $voucher ?></td>
</tr>
</table>
<hr class="sidebar-divider">


<table width="98%" class="table">
<tr>
<td style='font-size: 11px;'><b>PO</td>
<td class="text-center" style='font-size: 11px;'><b>RR</td>
<td class="text-center" style='font-size: 11px;'><b>Invoice</td>
<td class="text-center" style='font-size: 11px;'><b>Amount</td>
</tr>

<?php
$totalxx="0.00";
$sql3="SELECT * FROM suppliervoucher WHERE voucherid='$voucher'";
$sqlAdded=mysqli_query($conn,$sql3);
while($item=mysqli_fetch_array($sqlAdded)){
$po = $item['po'];
$rr = $item['rr'];
$inv = $item['invno'];
$amount = $item['amount'];
$id = $item['id'];
$totalx += $amount;
$amountx = number_format($amount, 2);
$totalxx = number_format($totalx, 2);
echo"
<tr>
<td style='font-size: 11px;'>$po</td>
<td style='font-size: 11px;'>$rr</td>
<td style='font-size: 11px;'>$inv</td>
<td style='font-size: 11px;'>$amountx</td>
</tr>
";
}
echo"
<tr>
<td colspan='3'><b>Total</td>
<td><b>₱ $totalxx</td>
</tr>
";
?>
</table><br>
</div>
</div>


</td></tr>
</table>




</div>
</div>
</div>
</div>
</section>
</main>


<script>
function paymentstat(val){
document.getElementById("idcardno").style.display = 'none';
document.getElementById("idchequeno").style.display = 'none';
document.getElementById("idbank").style.display = 'none';
document.getElementById("idcardname").style.display = 'none';
document.getElementById("idline1").style.display = 'none';
document.getElementById("idline2").style.display = 'none';
if(val == "cheque"){
document.getElementById("idchequeno").style.display = '';
document.getElementById("idbank").style.display = '';
document.getElementById("idline1").style.display = '';
document.getElementById("idline2").style.display = '';
}
else if(val == "card"){
document.getElementById("idcardno").style.display = '';
document.getElementById("idcardname").style.display = '';
document.getElementById("idbank").style.display = '';
document.getElementById("idline1").style.display = '';
document.getElementById("idline2").style.display = '';
}
}

function paymentstat2(val){
document.getElementById("idpayment").style.display = 'none';
if(val == "PARTIAL"){ document.getElementById("idpayment").style.display = '';}
}

$(document).ready(function() {
document.getElementById('total').value = '<?php echo $totalx ?>';
});
</script>
