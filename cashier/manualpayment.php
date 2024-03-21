<style>
.desn{padding: 5px 5px; width:100%; height:35px; font-size:12pt; color: black; width: 100%; background: white; box-shadow: 0 0 5px #a093f4; border: 1px solid #170d57;}
</style>

<?php
if(isset($_POST['btnsub'])){
$particular = $_POST['particular'];
$chargeto=$_POST['accttitle'];
$amount=$_POST['amount'];
$discount = $_POST['discount'];
$refno="MP".date("YmdHis");
$conn->query("INSERT INTO `collection_temp2`(`refno`, `description`, `accttitle`, `amount`, `discount`, `ip`) VALUES ('$refno', '$particular', '$chargeto', '$amount', '$discount', '$myip')");
echo"<script>window.location='?manualpayment';</script>";
}

if(isset($_POST['btndel'])){
$refno = $_POST['refno'];
$conn->query("delete from `collection_temp2` where refno='$refno' and ip='$myip'");
echo"<script>window.location='?manualpayment';</script>";
}

if(isset($_POST['btnclear'])){
$conn->query("delete from `collection_temp2` where ip='$myip'");
echo"<script>window.location='?manualpayment';</script>";
}

$result22j = $conn->query("SELECT * from orno_series where status='Active' and dept='$dept'");
while($row22j = $result22j->fetch_assoc()) {
$orno_id=$row22j['id'];
$active_or = $row22j['orno'];
}

$result22jj = $conn->query("SELECT * from orno_used where orseries='$orno_id'");
$orseries = mysqli_num_rows($result22jj);

if($orseries>0){
$sql22jjj = "SELECT max(or_used) as maxor from orno_used where orseries='$orno_id'";
$result22jjj = $conn->query($sql22jjj);
while($row22jjj = $result22jjj->fetch_assoc()) {
$maxor=$row22jjj['maxor'];
}
$orno = $maxor+1;
}else{$orno = $active_or;}


if(isset($_POST['btnsubmit'])){
$orno=$_POST['orno'];

$ss = $conn->query("select * from collection where ofr='$orno'");
if(mysqli_num_rows($ss)>0){

//echo "
//<script>
//alert('OR Number is Already used!');
//window.location='?manualpayment';
//</script>
//";
$orno=$orno."-0";
}

//else{
$patient=explode('_',$_POST['patientname']);
$caseno=$patient[0];
$patientname=$patient[1];
if($patientname==""){$patientname=$caseno;}
$date=date('M-d-Y');
$time=date('H:i:s');
$datearray=date('Y-m-d');

$cc= $conn->query("select * from collection_temp2 where ip='$myip'");
while($cc1 = $cc->fetch_assoc()){
$conn->query("INSERT INTO collection (refno, acctno, acctname, ofr, description, accttitle, amount, discount, date, Dept, username, shift, type, paymentTime, paidBy, datearray, branch, batchno) VALUES
('$cc1[refno]','$caseno','$patientname','$orno','$cc1[description]','$cc1[accttitle]','$cc1[amount]','$cc1[discount]','$date','out','$user','','cash-Visa','$time','$dept','$datearray','$branch', '$orno')");
}

$conn->query("INSERT INTO orno_used(orseries,or_used) VALUES('$orno_id','$orno')");
$conn->query("delete from `collection_temp2` where ip='$myip'");

echo "
<script>
alert('Item successfully added!');

let a=document.createElement('a');
a.target='_blank';
a.href='http://$ip/2020codes/PrintOR/OR1.php?orno=$orno&datearray=$datearray&name=$username&userunique=$userunique&branch=$branch&dept=$dept';
a.click();

window.location='?manualpayment';
</script>
";

//}
}
?>

<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?manualpayment">Manual Payment</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">


<table width='100%'>
<tr>
<td width="35%">

<div class="card" style='box-shadow: 0px 0px 0px 1px #535683;'>
<div class="card-header" style="background-color: #535683; padding: 7px; color: white;">Manual Payment</div>
<div class="card-body">

<form method='POST'>
Particulars: <br><input type='text' name='particular'class="form-control" oninput="load1();">
Charge to: <br>
<select name="accttitle"class="select2-single" style="width: 100%;" id="chargeto"></select>
Amount: <br><input type='text' name='amount'class="form-control">
Discount: <br><input type='text' name='discount'class="form-control"><br>
<p align='right'><button type='submit' class='btn btn-primary btn-sm' name='btnsub'><i class='icofont-check-circled'></i> Submit</button></p>
</form>

</div>
</div>

</td><td width="2%"></td>
<td valign="TOP">


<div class='dd-handle' id="myDIV" style="box-shadow: 0px 0px 0px 1px lightgrey;">
<div class='task-info d-flex align-items-center'></div>

<form method='POST'>
<button type='submit' class='btn btn-danger btn-sm' name='btnclear' style="width: 20%; color: white;"><i class='icofont-trash'></i> Reset Posting</button>
<button type='button' class='btn btn-primary btn-sm' btn-sm' data-bs-toggle='modal' data-bs-target='#requestreturn2' onclick='load2();' style="width: 20%;"><i class='icofont-coins'></i> Post Payment</button>
</form>
<hr>

<table class='table'>
<tr>
<td style='font-size:11px; width:5%;'><b></td>
<td style='font-size:11px; width:30%;'><b>Desc</td>
<td style='font-size:11px; width:30%;'><b>Accttitle</td>
<td style='font-size:11px; width:10%;'><b>Gross</td>
<td style='font-size:11px; width:10%;'><b>Discount</td>
<td style='font-size:11px; width:10%;'><b>Net</td>
<td style='font-size:11px;'></td>
</tr>
<?php
$i=0;
$cc= $conn->query("select * from collection_temp2 where ip='$myip'");
while($cc1 = $cc->fetch_assoc()){
$i++;
$gross=number_format($cc1['amount']+$cc1['discount'], 2);
$total+=$cc1['amount'];
$total2=number_format($total, 2);
echo"
<tr>
<td style='font-size:11px;'>&#128204;</td>
<td style='font-size:11px;'>$cc1[description]</td>
<td style='font-size:11px;'>$cc1[accttitle]</td>
<td style='font-size:11px;'>$gross</td>
<td style='font-size:11px;'>$cc1[discount]</td>
<td style='font-size:11px;'>$cc1[amount]</td>
<td style='font-size:11px;'>
<form method='POST'>
<button type='submit' class='btn btn-outline-danger btn-sm' name='btndel' style='border-radius: 50%;'><i class='icofont-trash'></i></button>
<input type='hidden' name='refno' value='$cc1[refno]'>
</form>
</td>
</tr>
";
}

echo"
<tr>
<td style='font-size:13px;' colspan='5' align='right'><b>TOTAL:</td>
<td style='font-size:13px;' colspan='2'><b>$total2</td>
</tr>
";
?>


</table>

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


<form method="POST">
<div class="modal fade" id="requestreturn2" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog modal-xs glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> Final Bill [Excess]</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<table width="100%" border="0">
<tr>
<td><font color="black">OR NO.</td>
<td><input  name='orno' type='text' value='<?=$orno;?>'class="form-control" id='orno' readonly></td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td><font color="black">PATIENT NAME</td>
<td>
<input list="brow" name="patientname" class="form-control">
<datalist id="brow"></datalist>
</td>
</tr>
<tr>
<td colspan='2'>
<p align='right'><button type='submit' class='btn btn-primary btn-sm' name='btnsubmit'><i class='icofont-check-circled'></i> Submit</button></p>
</td>
</tr>
</table>

</div>
</div>
</div>
</div>
</form>




<script>
function load1(){
var str = "chargeto";
$.get("../cashier/functions.php", {str:str},
function (data) {$("#chargeto").html(data);});
}

function load2(){
var str = "paymentname";
$.get("../cashier/functions.php", {str:str},
function (data) {$("#brow").html(data);});
}
</script>