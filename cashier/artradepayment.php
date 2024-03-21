<?php

$caseno=$_GET['caseno'];
$sqlOR=mysqli_query($conn,"SELECT patientidno FROM admission where caseno='$caseno'");
$or=mysqli_fetch_array($sqlOR);
$patientidno=$or['patientidno'];

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

if($dept=="ACCOUNTING"){$orno=""; $ar="arpayment";}else{$ar="artradepayment";}

if(isset($_POST['btnsub'])){
$refno = $_POST['refno'];
$payment = $_POST['hospital'];
$count = $_POST['count'];
$orno = $_POST['orno'];
$totalamountxx = $_POST['totalamountxx'];
$cdate = date("M-d-Y");

$ss = $conn->query("select * from collection where ofr='$orno'");
if(mysqli_num_rows($ss)>0){$orno = $orno."-0";}

for($i=1; $i<=$count; $i++){
$refno1 = "RN".date("YmdHis").$i;

$sqlv = "SELECT * from collection where refno='$refno[$i]'";
$resultv = $conn->query($sqlv);
while($rowv = $resultv->fetch_assoc()){ 
$acctname=$rowv['acctname'];
$pdesc=$rowv['description'];
$accttitle=$rowv['accttitle'];
$amount=$rowv['amount'];
}
//echo"<script>alert('$refno[$i] - $payment[$i]');</script>";




if($refno[$i] != ""){
if($payment[$i]>$totalamountxx[$i]){$payment[$i] = $totalamountxx[$i];}
$less = $amount - $payment[$i];
if($payment[$i]>0){
$sql778 = "INSERT INTO `collection`(`refno`, `acctno`, `acctname`, `ofr`, `description`, `accttitle`, `amount`, `discount`, `date`, `Dept`, `username`, `shift`, `type`, `paymentTime`, `paidBy`, `datearray`, `branch`, `batchno`) VALUES ('$refno1', '$caseno', '$acctname', '$orno', '$pdesc', '$accttitle', '$payment[$i]', '0', '$cdate', '$dept', '$user', '$refno[$i]', 'cash-Visa', CURTIME(), '$dept', CURDATE(), '$branch', '$orno')";
if ($conn->query($sql778) === TRUE) {}

$sql778 = "update collection set amount='$less' where refno='$refno[$i]'";
if ($conn->query($sql778) === TRUE) {}

$sql778 = "INSERT INTO `acctgenledge`(`refno`, `acctitle`, `transaction`, `amount`, `date`, `caseno`, `status`) VALUES ('$refno1', '$accttitle', 'debit', '$payment[$i]', '$cdate', '$caseno', 'PAID')";
if ($conn->query($sql778) === TRUE) {}

$sql778 = "update acctgenledge set amount='$less' where refno='$refno[$i]'";
if ($conn->query($sql778) === TRUE) {}
}
}

}

$sqla11 = "INSERT INTO `orno_used`(`orseries`, `or_used`) VALUES ('$orno_id', '$orno')";
if ($conn->query($sqla11) === TRUE) {}


echo"
<script>
alert('saved');
let a=document.createElement('a');
a.target='_blank';
a.href='http://$ip/2020codes/PrintOR/OR1.php?orno=$orno&datearray=$datearrayxx&name=$user&userunique=$userunique&branch=$branch&dept=$dept';
a.click();

window.location= '?$ar&caseno=$caseno$datax';
</script>";
}


$nn = $conn->query("select * from admission a, patientprofile p where a.patientidno=p.patientidno and a.caseno='$caseno'");
while($n = $nn->fetch_assoc()){
$name = $n['lastname'].", ".$n['firstname']." ".$n['middlename'];
}

?>

<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?view=main">Main</a></li>
<li class="breadcrumb-item">AR-Trade Payment</li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">
<p><font color="black"><b><i class="bi bi-file-earmark-medical"></i> AR-TRADE PAYMENT</b></p><hr>

<form name="f1" method="POST">
<input type="hidden" name="view" value="artradepayment">
<input type="hidden" name="dept" value="<?=$st;?>">
<input type="hidden" name="branch" value="<?=$branch;?>">
<input type="hidden" name="nursename" value="<?=$nursename;?>">
<input type="hidden" name="userunique" value="<?=$userunique;?>">
<input type="hidden" name="caseno" value="<?=$caseno;?>">
<input type="hidden" name="patientidno" value="<?=$patientidno;?>">
<input type="hidden" name="orseries" value="<?=$orseries;?>">

<table width='100%'><tr><td width='60%'>

<div class="col">
<div class="card teacher-card" style='box-shadow: 0px 0px 0px 1px lightgrey;'>
<div class="card-body  d-flex">
<div class="profile-av pe-xl-4 pe-md-2 pe-sm-4 pe-4 text-center w220">
<img src='../main/img/boy.png' width='70' height='70' style='border-radius: 50%;'>

</div>
<div class="teacher-info border-start ps-xl-4 ps-md-3 ps-sm-4 ps-4 w-100">
<table width="100%"><tr>
<td width="80%">
<h6  class="mb-0 mt-2  fw-bold d-block fs-6"><?php echo strtoupper($name) ?></h6>
<span class="py-1 fw-bold small-11 mb-0 mt-1"><?php echo $address ?></span>
<br><font size='1%'>Caseno: <b><?php echo $caseno ?></b> || Room: <b><?php echo $room ?></b> || PATIENT TYPE: <b><?php echo $ss ?></b></font>
</td>
</tr>
</table>

</div>
</div>
</div>
</div><br>


<div class='dd-handle'>
<div class='task-info d-flex align-items-center'>
OR NO: <input type="text" name="orno" value="<?=$orno;?>" style="width: 40%; height:35px; font-size:10pt; color: black; background: white; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e; text-align: center;" placeholder="Enter OR Number..">
</div>
<hr>


<table align="center" width="98%"><tr><td style='font-size: 11px;'>
<table class="table">
<tr>
<th style="width: 10%; text-align: center;"></th>
<th style="width: 40%; text-align: center;">Account Title</th>
<th style="width: 25%; text-align: center;">Amount Payable</th>
<th style="width: 25%; text-align: center;">Amount Allocated</th>
</tr>
<?php
$totalamount=0;
$z=0;


$sql = $conn->query("select * from collection where acctno='$caseno' AND (accttitle LIKE '%AR TRADE%' OR accttitle LIKE '%AR EMPLOYEE%' or accttitle like '%DOCTOR%')
AND type='pending' AND amount > 0 GROUP BY refno");
while($acct = $sql->fetch_assoc()){
$accttitle = $acct['accttitle'];
$refno = $acct['refno'];
$desc = $acct['description'];
$amount = $acct['amount'];

$totalamountxx = 0;
$lateposting = 0;
$sql2 = $conn->query("SELECT amount FROM collection where refno like 'LP%%' and description = '$desc' and acctno='$caseno'");
while($acct2 = $sql2->fetch_assoc()){$lateposting = $acct2['amount'];}
$totalamount +=$amount-$lateposting;
$totalamountxx=$amount-$lateposting;

if($accttitle=="AR TRADE PF"){$dr="DR. ";}
else{$dr="";}
$z++;


if($totalamountxx>0){
echo "
<tr>
<td style='text-align: center; font-size: 11px;'><input type='checkbox' name='refno[$z]' value='$refno' style='transform : scale(1.6);' checked></td>
<td style='text-align: center; font-size: 11px;'>$dr $desc</td>
<td style='text-align: center; font-size: 11px;'>".number_format($totalamountxx,2)."</td>
<td style='text-align: center; font-size: 11px;'><input type='text' name='hospital[$z]' value='0.00' class='form-control' style='width:150px; text-align:right; height:30px; font-size:12pt;'></td>
</tr>
<input type='hidden' name='totalamountxx[$z]' value='$totalamountxx'>
";
}

}
?>
 
<tr>
<td align="right"></td>
<td align="center"><b>TOTAL EXCESS</td>
<td align="center"><b><u><?=number_format($totalamount,2,".",",");?></u></td>
<td style='font-size: 11px;'></td>
</tr>
</table>

<input type="hidden" name="count" value="<?php echo $z ?>">
<p align="right"><button type='submit' class='btn btn-primary btn-sm' name='btnsub'><i class="icofont-check-circled"></i> Submit Allocation</button></p>
</td></tr></table>

</div>
</form>

</td><td width="1%"></td>
<td valign='TOP' width='35%'>
<br>
<div class='card' style='box-shadow: 0px 0px 0px 1px lightgrey;'>
<div class='card-body'>
<div class='d-flex align-items-center justify-content-between mt-5'>
<div class='lesson_name'>
<div class='project-block light-danger-bg'>
<i class='icofont-history'></i>
</div>
<span class='small project_name fw-bold'> Payment History </span>
</div>
</div>
<?php
echo"
<table align='center' width='95%' class='table'>
<tr>
<td></td>
<td style='font-size: 11px;'>Desc/ Accttitle</td>
<td style='font-size: 11px;'>OFR/ Amount</td>
<td style='font-size: 11px;'>Date/ User</td>
</tr>
";
$sqlccc = "select * from collection where acctno='$caseno' and (accttitle like '%TRADE%' OR accttitle like '%EMPLOYEE%' or accttitle like '%DOCTOR%') 
and (type='cash-Visa' OR type='card-Visa')";
$resultccc = $conn->query($sqlccc);
while($rowccc = $resultccc->fetch_assoc()){
$ofr=$rowccc['ofr'];
$pdesc=$rowccc['description'];
$accttitle=$rowccc['accttitle'];
$datearray=$rowccc['datearray'];
$userx=$rowccc['username'];
$amount=number_format($rowccc['amount'], 2);
echo"
<tr>
<td style='font-size: 11px;'>&#128204;</td>
<td style='font-size: 11px;'>$pdesc<br>$accttitle</td>
<td style='font-size: 11px;'>$ofr<br>$amount</td>
<td style='font-size: 11px;'>$datearray<br>$userx</td>
</tr>
";
}

$sqlccc1 = "select * from collection where acctno='$caseno' and refno like 'LP%%'";
$resultccc1 = $conn->query($sqlccc1);
while($rowccc1 = $resultccc1->fetch_assoc()){
$ofr1=$rowccc1['ofr'];
$pdesc1=$rowccc1['description'];
$accttitle1=$rowccc1['accttitle'];
$datearray1=$rowccc1['datearray'];
$userx1=$rowccc1['username'];
$amount1=number_format($rowccc1['amount'], 2);

echo"
<tr>
<td style='font-size: 11px;'>&#128204;</td>
<td style='font-size: 11px;'>$pdesc1<br>$accttitle1</td>
<td style='font-size: 11px;'>$ofr1<br>$amount1</td>
<td style='font-size: 11px;'>$datearray1<br>$userx1</td>
</tr>
";
}

echo"</table><br>";
?>
</div>
</div>
</td>
</tr>
</table>

</div>
</div>
</div>
</div>
</section>
</main>
