<?php
$hmo = $_GET['hmo'];
$transdate = $_GET['transdate'];
$batchno = $_GET['batchno'];
$ptype = $_GET['ptype'];
$ttype = $_GET['ttype'];
list($hmocode, $hmoname) = explode("_", $hmo);
$datax2="&batchno=$batchno&hmo=$hmo&transdate=$transdate&ptype=$ptype&ttype=$ttype";

if($ptype=="in"){$patienttype = "IN-PATIENT"; $qryz = "and a.caseno like '%I-%'";}
elseif($ptype=="in"){$patienttype = "OUT-PATIENT"; $qryz = "and a.caseno not like '%I-%'";}
else{$patienttype = "ALL"; $qryz = "";}

if(isset($_POST['btnsave'])){
$caseno=$_POST['caseno'];
$amount=$_POST['amount'];
$amountreceived=$_POST['amountreceived'];
$id=$_POST['id'];
$refno = "RN".date("YmdHis");

if($amount>$amountreceived){$descre = $amount-$amountreceived; $descre = "-".$descre;}
elseif($amount<$amountreceived){$descre = $amountreceived-$amount; $descre = "+".$descre;}
else{$descre="none";}

$conn->query("update arv_tbl_hmotransmittallist set voucherno='$batchno', datereceived='$transdate', amountreceived='$amountreceived', discre='$descre', datetrans=CURDATE(), userprep='$user' where autono='$id'");
echo"<script>alert('Saved....'); window.location='?hmoacctreceivabledetails$datax2'</script>";
}


if(isset($_POST['btndel'])){
$code=$_POST['code'];
$conn->query("update arv_tbl_hmotransmittallist set voucherno='', datereceived='', amountreceived='', discre='', datetrans='', userprep='' where autono='$code'");
echo"<script>alert('Deleted....'); window.location='?hmoacctreceivabledetails$datax2'</script>";
}


if(isset($_POST['btnpost'])){
$controlno=$_POST['controlno'];
$sql1="update arv_tbl_hmotransmittallist set status = 'PAID' where voucherno = '$batchno'";
if($conn->query($sql1) === TRUE){echo"<script>alert('Successfully Submit!'); window.location='?view=newtransmittal$datax'</script>";}
else{echo"<script>alert('Unable to process transaction!'); window.location='?hmoacctreceivabledetails$datax2'</script>";}
}
?>







<div class="col-lg-12" style="width: 100%;">
<div class="card mb-4">
<div class="table-responsive p-3">
<h5><font color='black'><i class='fa fa-file'></i> CREATE ACCOUNT RECEIVABLE VOUCHER</h5><hr>

<table width="100%">
<tr><td width="55%" valign="top">


<div class="panel panel-default" width="100%">
<div class="panel-heading" style="text-align: left; background: <?php echo $primarycolor ?>;">
<form method="POST">
<input type="text" name="product" placeholder="&#128269; Search by Name (Lastname Firstname Middlename)" class="form-control" style="width: 70%;">
</form>
</div>

<?php if(isset($_POST['product'])){ $prod = $_POST['product']; ?>
<br>
<table align="center" width="98%" border="1" class="tablex">
<tr>
<td></td>
<td>Caseno</td>
<td>Patient Name</td>
<td>Date Admit</td>
<td width="20%">Amount</td>
</tr>


<?php
if($prod == ""){$prod="dgfgjhfdfsdtgdfd";}
$sql22j = "SELECT * from admission a, patientprofile p, arv_tbl_hmotransmittallist ar where (p.lastname like '%$prod%' or p.firstname like '%$prod%' or p.patientname like '%$prod%') and a.patientidno=p.patientidno and a.caseno=ar.caseno and ar.company='$hmoname' and ar.trantype='$ttype' and ar.status='pending'";
$result22j = $conn->query($sql22j);
$checker = mysqli_num_rows($result22j);
if($checker>0) {
while($row22j = $result22j->fetch_assoc()) {
$caseno = $row22j['caseno'];
$pname = $row22j['patientname'];
$hmocompany = $row22j['hmo'];
$dateadmit = $row22j['dateadmit'];
$amount = $row22j['amount'];
$id = $row22j['autono'];

$btn = "<button class='btn btn-primary' name='btnsave'><i class='icofont-check-circled'></i></button>";

echo"
<form method='POST'>
<tr>
";

echo"
<td style='text-align: center;'>$btn</td>
<td><font size='1' color='black'>$caseno</td>
<td><font size='1' color='black'>$pname</td>
<td><font size='1' color='black'>$dateadmit</td>
<td><font size='1' color='black'><input type='text' name='amountreceived' value='$amount' style='height:30px; font-size:10pt; padding: 0px; text-align: center;'></td>
</tr>
<input type='hidden' name='caseno' value='$caseno'>
<input type='hidden' name='amount' value='$amount'>
<input type='hidden' name='id' value='$id'>
</form>
";
}
}else{echo"<tr><td colspan='4'>No Record Found...</td></tr>";}
?>
</table><br>
<?php } ?>


</div>


</td><td width="1%"></td><td valign="TOP">

<div class="panel panel-default" width="100%">
<div class="panel-heading" style="text-align: left; background: <?php echo $primarycolor ?>;">
<form method='POST'>
<table width="100%">
<tr>
<td align="right"><button class="btn btn-primary" type="submit" name="btnpost">POST VOUCHER PAYMENT</button></td>
</tr>
</table>
</form>
</div>


<table align="center" width="95%">
<tr>
<td width="65%"><font size='2' color='black'>Company: <?php echo $hmoname ?></td>
<td><font size='2' color='black'>Voucher: <?php echo $batchno ?></td>
</tr>
<tr>
<td><font size='2' color='black'>Department: <?php echo $dept ?></td>
<td><font size='2' color='black'>Transaction Date: <?php echo $transdate ?></font></td>
</tr>
<tr>
<td><font size='2' color='black'>TYPE: <?php echo $patienttype ?></td>
<td></td>
</tr>
</table>
<hr class="sidebar-divider">


<table width="98%" border="1" align="center" class="tablex">
<tr>
<td>Name</td>
<td>amount</td>
<td>Action</td>
</tr>

<?php
$sql3=$conn->query("SELECT * FROM arv_tbl_hmotransmittallist ar left join admission a on ar.caseno=a.caseno left join patientprofile p on a.patientidno=p.patientidno WHERE ar.voucherno='$batchno'");
while($item = $sql3->fetch_assoc()){

echo"
<tr>
<td><font size='2' color='black'>$item[patientname]</td>
<td style='text-align: center;'><font size='2' color='black'>$item[amount]</td>
<td style='text-align: center;'>
<form method='POST'>
<button type='submit' class='btn btn-danger' name='btndel'><i class='icofont-trash'></i></button>
<input type='hidden' name='code' value='$item[autono]'>
</form>
</td>
</tr>
";
}
?>
</table><br>
</div>


</td></tr>
</table>




</div>
</div>
</div>

