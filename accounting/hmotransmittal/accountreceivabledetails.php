<?php
$hmo = $_GET['hmo'];
$transdate = $_GET['transdate'];
$batchno = $_GET['batchno'];
$ptype = $_GET['ptype'];
$ttype = $_GET['ttype'];
$discount = $_GET['discount'];
$wvat = $_GET['vat'];
list($hmocode, $hmoname) = explode("||", $hmo);
$datax2="&batchno=$batchno&hmo=$hmo&transdate=$transdate&ptype=$ptype&ttype=$ttype";

if($dept=="HMO"){$disable=""; $label="Cheque No.";}else{$disable="disabled"; $label="OR No.";}

if($ptype=="in"){$patienttype = "IN-PATIENT"; $qryz = "and a.caseno like '%I-%'";}
elseif($ptype=="in"){$patienttype = "OUT-PATIENT"; $qryz = "and a.caseno not like '%I-%'";}
else{$patienttype = "ALL"; $qryz = "";}

if(isset($_POST['btnsave'])){
$caseno=$_POST['caseno'];
$amount=$_POST['origamount'];
$amountreceived=$_POST['amount'];
$refno = "RN".date("YmdHis");

if($amount>$amountreceived){$descre = $amount-$amountreceived; $descre = "-".$descre;}
elseif($amount<$amountreceived){$descre = $amountreceived-$amount; $descre = "+".$descre;}
else{$descre="none";}

if(isset($_POST['id'])){
$id = $_POST['id'];
$conn->query("update arv_tbl_hmotransmittallist set voucherno='$batchno', datereceived='$transdate', amountreceived='$amountreceived', discre='$descre', datetrans=CURDATE(), userprep='$user', discount='$discount', vat='$vat' where autono='$id'");
}


echo"<script>alert('Saved....$id'); window.history.back();</script>";
}


if(isset($_POST['btndel'])){
$code=$_POST['code'];
$conn->query("update arv_tbl_hmotransmittallist set voucherno='', datereceived='', amountreceived='', discre='', datetrans='', userprep='', discount='', vat='' where autono='$code'");
echo"<script>alert('Deleted....'); window.history.back();</script>";
}


if(isset($_POST['btnpost'])){
$controlno=$_POST['controlno'];

if($dept=="CASHIER"){

$disc2=0;
$sql3=$conn->query("SELECT ar.refno, ar.caseno, p.patientname, ar.amountreceived, ar.autono FROM arv_tbl_hmotransmittallist ar left join admission a on ar.caseno=a.caseno left join patientprofile p 
on a.patientidno=p.patientidno WHERE ar.voucherno='$batchno'");
while($item = $sql3->fetch_assoc()){
$ptname = $item['patientname'];
$amm = $item['amountreceived'];
$amm2 = number_format($amm, 2);
$gross+=$amm;
$disc = $amm*$discount;
$disc2+=$disc;
$vat = ($amm-$disc)*$vat;
$net = $amm - ($disc+$vat);
$refno = $item['refno']."HMO";
$caseno=$item['caseno'];
$autono=$item['autono'];

if(strpos($caseno, "I-")!==false){$ddept = "in";}else{$ddept="out";}
$controlno2 = "HMO-".$controlno;
$conn->query("update arv_tbl_hmotransmittallist set status='PAID', dateposted=CURDATE(), userposted='$user' where autono='$autono'");

$conn->query("INSERT INTO `collection`(`refno`, `acctno`, `acctname`, `ofr`, `description`, `accttitle`,
 `amount`, `discount`, `date`, `Dept`, `username`, `shift`, `type`, `paymentTime`, `paidBy`, `datearray`, `branch`, `batchno`) VALUES 
 ('$refno', '$caseno', '$ptname', '$controlno2', 'AR $hmoname', 'AR $hmoname', '$net', '0', '', '$ddept', '$user', '', 'cash-Visa', CURTIME(), '$dept', CURDATE(), '', '$controlno2')");
}

if($disc2>0){
$refno2 = "RN".date("YmdHis")."HMO";
 $conn->query("INSERT INTO `collection` (`refno`, `acctno`, `acctname`, `ofr`, `description`, `accttitle`,
 `amount`, `discount`, `date`, `Dept`, `username`, `shift`, `type`, `paymentTime`, `paidBy`, `datearray`, `branch`, `batchno`) VALUES 
 ('$refno2', '$caseno', '$ptname', '', 'AR $hmoname Discount', 'AR $hmoname Discount', '$disc2', '0', '', '$ddept', '$user', '', 'pending', CURTIME(), '$dept', CURDATE(), '', '$controlno2')");
}

echo"
<script>
alert('Successfully Submit!');

let a=document.createElement('a');
a.target='_blank';
a.href='http://$ip/2020codes/PrintOR/OR1.php?orno=$ofr&datearray=$datearrayxx&name=$nursename&userunique=$userunique&branch=$branch&dept=$dept&$dept';
a.click();

window.location= '?hmoacctreceivable';
</script>
";
exit();

//echo"<script>alert('Successfully Submit!'); window.location='?hmoacctreceivable';</script>";

}elseif($dept=="HMO"){

$sql1="update arv_tbl_hmotransmittallist set status = 'FOR OR', chequeno='$controlno' where voucherno = '$batchno'";
if($conn->query($sql1) === TRUE){echo"<script>alert('Successfully Submit!'); window.location='?hmoacctreceivable';</script>";}
else{echo"<script>alert('Unable to process transaction!'); window.location='?hmoacctreceivable';</script>";}

}else{

echo"<script>alert('No Department! Unable to process transaction!'); window.location='?hmoacctreceivable';</script>";

}
}
?>

<body onload="aa('');">
<main id="main" class="main">

<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?view=main">Main</a></li>
<li class="breadcrumb-item"></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">

<div class="card">
<div class="card-body">

<h5><font color="black"><i class='icofont-users'></i> HMO ACCOUNT RECEIVABLE</h5><hr>

<table width="100%"><tr>
<td width="60%" valign="TOP">

<table width="70%"><tr>
<td valign="TOP">
<div class="input-group mb-3" valign="bottom">
<span class="input-group-text" id="basic-addon1"><i class="icofont-search-2"></i></span>
<input type="text" class="form-control" name="search_text" id="search_text" onchange="aa(this.value)" placeholder="Search Patient [Enter]" <?php echo $disable ?>>
</div>
</td>
</tr></table>

<div class='card' style="min-height: 400px;"><div id="result"></div></div>

</td>
<td width="2%"></td><td valign="TOP">

<!--div id="included-content"></div-->
<?php
$ddate = date('mdY');
echo"
<div class='card'>
<div class='card-header py-3'>

<form method='POST'>
<table width='100%'>
<tr>
<!--td>OR Number:</td-->
<td width='40%'>$label: <input type='text' name='controlno' value='$ddate' class='form-control'></td>
<td width='30%' style='text-align:right;'><button class='btn btn-primary btn-sm' type='submit' name='btnpost'>SUBMIT FOR OR</button></td>
</tr>
</table>
</form>
<hr>
<table align='center' width='95%'>
<tr>
<td width='50%' style='font-size: 12px;'><i class='icofont-institution'></i> $hmoname</td>
<td style='font-size: 12px;'><i class='icofont-numbered'></i> $batchno</td>
</tr>
<tr>
<td style='font-size: 12px;'><i class='icofont-ui-calendar'></i> $transdate</font></td>
<td style='font-size: 12px;'><i class='icofont-native-american'></i> $patienttype</td>
</tr>
</table>
<hr>
</div>
<div class='card-body'>
";

$i = 0; $gross = 0;
$sql3=$conn->query("SELECT * FROM arv_tbl_hmotransmittallist ar left join admission a on ar.caseno=a.caseno left join patientprofile p 
on a.patientidno=p.patientidno WHERE ar.voucherno='$batchno'");
while($item = $sql3->fetch_assoc()){
$ptname = $item['patientname'];
$amm = $item['amountreceived'];
$amm2 = number_format($amm, 2);
$gross+=$amm;
$gross2 = number_format($gross, 2);
$disc = $gross*$discount;
$disc2 = number_format($disc, 2);
$vat = ($gross-$disc)*$vat;
$vat2 = number_format($vat, 2);
$net = $gross - ($disc+$vat);
$net2 = number_format($net, 2);
$i++;

echo"
<div class='timeline-item ti-danger border-bottom ms-2'>
<div class='d-flex' style='width: 100%;'>
<span class='avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg'>$i</span>
<div class='flex-fill ms-3'>
<div class='mb-1'><strong><font size='2px' color='#5A91DC'>$ptname</font></strong></div>

<table width='100%'>
<tr>
<td style='font-size:15px; color: red;' valign='TOP' width='95%'><i class='icofont-peso'></i> $amm2</td>
<td style='font-size:10px;' valign='TOP'>
<form method='POST'>
<button type='submit' class='btn btn-danger btn-sm' name='btndel' style='font-size: 9px; color: white; padding: 3px;' $disable><i class='icofont-trash'></i></button>
<input type='hidden' name='code' value='$item[autono]'>
</form>
</td>
</tr>
</table>
</font>

</div>
</div>
</div> <!-- timeline item end  -->
";
}

echo"
<br>
<table width='60%' align='right'>
<tr>
<td>Gross:</td>
<td><b>$gross2</b></td>
</tr>
<tr>
<td>Discount ($discount):</td>
<td><b>$disc2</b></td>
</tr>
<tr>
<td>vat ($vat):</td>
<td><b>$vat2</b></td>
</tr>
<tr>
<td>Net:</td>
<td><b>$net2</b></td>
</tr>
</table>
";
?>

</div>
</div>

</td></tr></table>




<script>
function aa(str){
//var str = document.getElementById('search_text').value;
var hmo = "<?php echo $hmo ?>";
var ttype = "<?php echo $ttype ?>";
var ptype = "<?php echo $ptype ?>";
$.get("../accounting/hmotransmittal/accountreceivabledetailsfetch.php", {str:str, hmo:hmo, ttype:ttype, ptype:ptype},
function (data) {$("#result").html(data);});

document.getElementById("included-content").innerHTML="";
}
</script>



</div>
</div>

</div>
</div>
</section>

</main>
