<style>
.select2-container .select2-selection--single {font-size: 11px;}
</style>

<?php
$requesteddept = $_GET['requesteddept'];
$transdate = $_GET['transdate'];
$trantype = $_GET['trantype'];
$terms = $_GET['terms'];
$rrno = $_GET['rrno'];
$transactiontype = $_GET['transactiontype'];
$receivingdept = "CPU";
list($requesteddeptcode, $requesteddeptname) = explode("_", $requesteddept);
$requesteddeptname = str_replace("|", "_", $requesteddeptname);
$datax2="&rrno=$rrno&requesteddept=$requesteddept&transdate=$transdate&trantype=$trantype&terms=$terms&invoicedate=$invoicedate&invno=$invno&transactiontype=$transactiontype";

if($transactiontype=="charge"){$transactiontype1="For Patient Use";}else{$transactiontype1="Departmental Use";}
if(isset($_POST['btnsave'])){
$code=$_POST['code'];
$qty=$_POST['qty'];
$unitcost=$_POST['unitcost'];
$discount=$_POST['discount'];
$invoicedate=$_POST['invoicedate'];
$lotno=$_POST['lotno'];
$expiration=$_POST['expiredate'];
$remarks=$_POST['remarks'];
$desc=$_POST['desc'];
$type=$transactiontype;
$soh=$_POST['soh'];

if($qty>$soh){$qty=$soh;}

$sql2n = "SELECT * from receiving where code = '$code'";
$result2n = $conn->query($sql2n);
while($row2n = $result2n->fetch_assoc()) {$generic=$row2n['generic']; $desc = $row2n['description']." (".$row2n['generic'].")";}

$sql2l = "SELECT * FROM purchaseorder WHERE po='$rrno' AND code='$code'";
$result2l = $conn->query($sql2l);
$count = mysqli_num_rows($result2l);

if($soh>0){
if($count>0){
$conn->query("delete from purchaseorder where po='$rrno' and code='$code'");
$conn->query("INSERT INTO purchaseorder (rrno, transdate, supplier, suppliercode, terms, trantype, code, `description`, unitcost, generic, prodqty, dept, `status`, prodtype1, po, user, approvingofficer, reqdept, reqno, reqdate, requser) values ('', '$transdate', '$requesteddeptname', '$requesteddeptcode', '$terms', 'NONE', '$code', '$desc', '$unitcost', '$transdate', '$qty', '$requesteddeptname', 'process', '$discount', '$rrno', '$user', '$type', '$dept', '$rrno', '$transdate', '$user')");
echo"<script>window.location='?stockrequest2$datax$datax2'</script>";
}else{
$conn->query("INSERT INTO purchaseorder (rrno, transdate, supplier, suppliercode, terms, trantype, code, `description`, unitcost, generic, prodqty, dept, `status`, prodtype1, po, user, approvingofficer, reqdept, reqno, reqdate, requser) values ('', '$transdate', '$requesteddeptname', '$requesteddeptcode', '$terms', 'NONE', '$code', '$desc', '$unitcost', '$transdate', '$qty', '$requesteddeptname', 'process', '$discount', '$rrno', '$user', '$type', '$dept', '$rrno', '$transdate', '$user')");
echo"<script>window.location='?stockrequest2$datax$datax2'</script>";
}
}else{echo"<script>alert('Zero Quantity!'); window.location='?stockrequest2$datax$datax2'</script>";}
}



if(isset($_POST['btndel'])){
$code=$_POST['code'];
$sql1=$conn->query("DELETE FROM purchaseorder WHERE po='$rrno' AND code='$code'");
echo"<script>window.location='?stockrequest2$datax$datax2'</script>";
}



$rrno2 = str_replace (' ', '__',  $rrno);
$dept2 = str_replace (' ', '__', $dept);
if(isset($_POST['btnpost1'])){
$conn->query("update purchaseorder set status='request' WHERE po='$rrno'");
echo"
<script>
let a=document.createElement('a');
a.target='_blank';
a.href='../scmprint/stockrequest/$rrno2/$dept2';
a.click();

window.location='?stockrequest';
</script>
";
}
?>







<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?stockrequest">Stock Request</a></li>
<li class="breadcrumb-item"><a>Create Stock Request</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<p><font color="black"><b><i class="bi bi-file-earmark-medical"></i> CREATE REQUEST</b></font></p><hr>


<table width="100%">
<tr><td width="50%" valign="top">


<div class='card' style="box-shadow: 0px 0px 0px 1px lightgrey;">
<div class='card-body'>

<table align="center" width="100%">
<tr>
<td width="50%"><font size='2' color='black'>Requested To: <b><?php echo $requesteddeptname ?></td>
<td><font size='2' color='black'>Department: <b><?php echo $dept ?></td>
</tr>
<tr>
<td><font size='2' color='black'>Transaction Date: <b><?php echo $transdate ?></td>
<td><font size='2' color='black'>Requisition No.: <b><?php echo $rrno ?></td>
</tr>
<tr>
<td><font size='2' color='black'>Transaction Type: <span class='badge bg-primary'><?php echo $transactiontype1 ?></span></td>
<td><font size='2' color='black'></td>
</tr>
</table>

</div>
</div>

<br>
<div class='card' style="box-shadow: 0px 0px 0px 1px lightgrey;">
<div class='card-body'>

<table width="98%" class="table">
<tr>
<td><font size='1'><b>Description</td>
<td class="text-center"><font size='1'><b>Qty</td>
<td class="text-center"><font size='1'><b>Type</td>
<td class="text-center"><font size='1'><b>Action</td>
</tr>

<?php
$sql3="SELECT * FROM purchaseorder WHERE po='$rrno'";
$sqlAdded=mysqli_query($conn,$sql3);
while($item=mysqli_fetch_array($sqlAdded)){

if($item['prodtype1']>0){
$total=$item['prodqty']*$item['prodtype1'];
$proditem=$item['prodtype1'];
}else{
$total=$item['unitcost']*$item['prodqty'];
$proditem=0;
}

echo"
<tr>
<td style='font-size:13px;'>$item[description]</td>
<td style='text-align: center; font-size:13px;'>$item[prodqty]</td>
<td style='text-align: center; font-size:13px;'>".strtoupper($item['approvingofficer'])."</td>
<td style='text-align: center;'>
<form method='POST'>
<button type='submit' class='btn btn-danger' name='btndel' style='border: none; padding: 4px 10px; font-size: 10px; margin: 2px 1px; background: #782626; color: white;'><i class='icofont-trash'></i></button>
<input type='hidden' name='code' value='$item[code]'>
</form>
</td>
</tr>
";
}
?>
</table>

</div>
</div>


</td><td width="1%"></td><td valign="TOP">


<div class='card' style="box-shadow: 0px 0px 0px 1px lightgrey;">
<div class='card-body'>
<div style="text-align: right;">
<button class="btn btn-danger" type="button" name="btnpost" style="border: none; padding: 4px 10px; font-size: 14px; margin: 2px 1px; background: #05471a; color: white;"><i class='icofont-close-line-circled'></i> Cancel</button>

<form method="POST">
<button class="btn btn-danger" type="submit" name="btnpost1" style="border: none; padding: 4px 10px; font-size: 14px; margin: 2px 1px; background: #782626; color: white;"><i class='icofont-printer'></i> Submit Request</button>
</form>

</div>
<hr>



<div class="input-group mb-3" style="width: 100%;">
<span class="input-group-text" id="basic-addon1" style="box-shadow: 0 0 1px #67a6ee; background-color: white;">&#128269;</span>
<input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="product" id="search_text" onchange="aa()" placeholder="Search by description or generic [Enter]" style="box-shadow: 0 0 1px #67a6ee; background-color: white;">
</div>



<script>
function aa(){
document.getElementById("loading2").style.display="";
document.getElementById("result").style.display="none";
var dept = "<?php echo $requesteddeptname ?>";
var str = document.getElementById('search_text').value;
$.get("../pharmacy/scm_stockrequest2fetch.php", {str:str, str2:dept},
function (data) {$("#result").html(data); document.getElementById("loading2").style.display="none"; document.getElementById("result").style.display="";});
}
</script>

<img style="width: 200px; display: none; align: center;" src="../main/img/loading.gif" id="loading2"></img>
<div id="result"></div>






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
function getsoh(str){

var deptreq = "<?php echo $requesteddeptname ?>";
$.get("../pharmacy/scm_getsoh_uc.php", {str:str, deptreq:deptreq},
function (data) {
    const myArray = data.split("_");
   //document.getElementById('unitcost').value=myArray[1];
    document.getElementById('soh').value=myArray[0];
});
}
</script>
