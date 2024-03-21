<?php
include "../main/class.php";
include "../main/header.php";
echo"<body style='background: white;'>";

$name = $_GET['pname'];
$caseno = $_GET['caseno'];
$datenow = date("M-d-Y");


$sql22j = "SELECT * from orno_series where status='Active' and dept='$dept'";
$result22j = $conn->query($sql22j);
while($row22j = $result22j->fetch_assoc()) {
$orno_id=$row22j['id'];
$active_or = $row22j['orno'];
}

$sql22jj = "SELECT * from orno_used where orseries='$orno_id'";
$result22jj = $conn->query($sql22jj);
$orseries = mysqli_num_rows($result22jj);

if($orseries>0){
$sql22jjj = "SELECT max(or_used) as maxor from orno_used where orseries='$orno_id'";
$result22jjj = $conn->query($sql22jjj);
while($row22jjj = $result22jjj->fetch_assoc()) {
$maxor=$row22jjj['maxor'];
}
$orno = $maxor+1;
}else{$orno = $active_or;}

if(isset($_POST['reset'])){
    $sqldel=mysqli_query($conn,"delete from collection_temp where ip='$my_ip' and acctno='$caseno'");
    echo"<script>history.back();</script>";
    }
    
    if(isset($_POST['btnsave'])){
    $desc = $_POST['desc'];
    $amount = $_POST['amount'];
    $refno = "PP".date("YmdHis");
    $sqlsave=mysqli_query($conn,"insert into collection_temp (refno, acctno, acctname,amount,description,accttitle,date,username, type, paymentTime, branch, ip) values
    ('$refno','$caseno','$name','$amount','HOSPITAL BILL','$desc',CURDATE(),'$user','cash-Visa','POSTPAYMENT','$branch','$my_ip')");
    echo"<script>history.back();</script>";
    }
    
    if(isset($_POST['save'])){
    $ofr = $_POST['ofr'];

$ss = $conn->query("select * from collection where ofr='$ofr'");
if(mysqli_num_rows($ss)>0){$ofr = $ofr."-0";}

    $sql = "SELECT * from collection_temp where ip='$my_ip' and paymentTIme='POSTPAYMENT' and acctno='$caseno'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
    $refno = $row['refno'];
    $description = $row['description'];
    $accttitle = $row['accttitle'];
    $amm = $row['amount'];
    
    $sqlsave=mysqli_query($conn,"INSERT INTO collection (refno, acctno, acctname, ofr, description, accttitle, amount, discount, date, Dept, username, shift, type,
     paymentTime, paidBy, datearray, branch, batchno) values ('$refno','$caseno','$name','$ofr','$description','$accttitle','$amm','',CURDATE(),'in','$user','','cash-Visa',CURTIME(),'$dept',CURDATE(),'$branch', '$ofr')");
    
    $sqlsave2=mysqli_query($conn,"INSERT INTO `acctgenledge`(`refno`, `acctitle`, `transaction`, `amount`, `date`, `caseno`, `status`) VALUES ('$refno','$accttitle','debit','$amm','$datenow','$caseno','PAID')");
    }
    
    $conn->query("INSERT INTO orno_used(orseries,or_used) VALUES('$orno_id','$ofr')");
    
    $sqldel=mysqli_query($conn,"delete from collection_temp where ip='$my_ip' and acctno='$caseno' and paymentTime='POSTPAYMENT'");
    echo"<script>window.open('http://$ip/2020codes/PrintOR/OR1.php?orno=$ofr');</script>";
    echo"<script>history.back();</script>";
    }

echo"
<font color='gray'>Caseno:</font> <b>$caseno</b> <br>
<font color='gray'>Name:</font> <b>$name</b>
<hr class='sidebar-divider my-0'><br>
<form method='post'>
<table width='90%' align='center'>
<tr>
<td><font class='font8'>Account Title:</td>
<td>
<select name='desc' style='width: 100%; height:35px; font-size:10pt; color: black; background: white; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e; text-align: center;'>
<!--option value='CASHONHAND'>CASHONHAND</option-->
<option value='PATIENTS DEPOSIT'>PATIENTS DEPOSIT</option>
</select>
</td>
</tr>
<tr>
<td><font class='font8'>Amount:</td>
<td><input type='text' name='amount' style='width: 100%; height:35px; font-size:10pt; color: black; background: white; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e; text-align: center;' required></td>
</tr>
<tr>
<td></td>
<td align='right'><br>
<button type='submit' name='btnsave' class='btn btn-outline-danger btn-sm'><i class='icofont-plus-circle'></i> Add for Payment</button>
</td>
</tr>
</table>
</form>
<hr>
 
<table width='90%' align='center'>
<tr>
<td>

<form method='post'>OR Number:
<input type='text' name='ofr' placeholder='Enter OR Number...' value='$orno' style='width: 50%; height:35px; font-size:10pt; color: black; background: white; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e; text-align: center;' required><br><br>
<button type='submit' name='save' value='Post Payment' class='btn btn-warning btn-sm'><i class='icofont-tick-boxed'></i> Post Payment</button>
<button type='submit' name='reset' value='Reset Posting' class='btn btn-success btn-sm'><i class='icofont-spinner-alt-3'></i> Reset Posting</button>
</form>
</td>
</tr>
</table>

<table class='table' width='100%'>
<tr>
<td></td>
<td>Description</td>
<td>Accttitle</td>
<td>Amount</td>
</tr>
";
$tot="0.00";
$sql = "SELECT * from collection_temp where ip='$my_ip' and paymentTIme='POSTPAYMENT' and acctno='$caseno'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$refno = $row['refno'];
$description = $row['description'];
$accttitle = $row['accttitle'];
$amm = $row['amount'];
$tot+=$amm;
echo"
<tr>
<td>&#128204;</td>
<td>$description</td>
<td>$accttitle</td>
<td>$amm</td>
</tr>
";
}
echo"
<tr>
<td colspan='3'><b>TOTAL:</b></td>
<td><b>$tot</b></td>
</tr>
";
echo"</table>";

include "../main/footer.php";
?>

