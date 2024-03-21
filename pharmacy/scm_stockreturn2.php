<style>
.select2-container .select2-selection--single {font-size: 11px;}
</style>

<?php
$requesteddept = $_GET['requesteddept'];
$transdate = $_GET['transdate'];
$trantype = $_GET['trantype'];
$terms = $_GET['terms'];
$rrno = $_GET['rrno'];
$transactiontype = "charge";
$receivingdept = "CPU";
list($requesteddeptcode, $requesteddeptname) = explode("_", $requesteddept);
$requesteddeptname = str_replace("|", "_", $requesteddeptname);
$datax2="&rrno=$rrno&requesteddept=$requesteddept&transdate=$transdate&trantype=$trantype&terms=$terms&invoicedate=$invoicedate&invno=$invno";


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
$type="charge";
$soh=$_POST['soh'];

if($qty>$soh){$qty=$soh;}

$sql2n = "SELECT * from receiving where code = '$code'";
$result2n = $conn->query($sql2n);
while($row2n = $result2n->fetch_assoc()) {$generic=$row2n['generic']; $desc = $row2n['description']." (".$row2n['generic'].")";}

$sql2l = "SELECT * FROM purchaseorder WHERE po='$rrno' AND code='$code'";
$result2l = $conn->query($sql2l);
$count = mysqli_num_rows($result2l);
while($ff = $result2l->fetch_assoc()){$rrid = $ff['rrdetails'];}

if($soh>0){
if($count>0){$conn->query("delete from purchaseorder where po='$rrno' and code='$code'"); $conn->query("delete from savequantity where rrdetails='$rrid'");}
$conn->query("INSERT INTO purchaseorder (rrno, transdate, supplier, suppliercode, terms, trantype, code, `description`, unitcost, generic, prodqty, dept, `status`, prodtype1, po, user, approvingofficer,
 reqdept, reqno, reqdate, requser) values ('', '$transdate', '$dept', '$dept', '$terms', 'NONE', '$code', '$desc', '$unitcost', '$transdate', '$qty', '$dept',
  'transfer', '$discount', '$rrno', '$user', '$type', '$requesteddeptname', '$rrno', '$transdate', '$user')");

$ss = $conn->query("SELECT * FROM purchaseorder WHERE po='$rrno' AND code='$code'");
while($ss1 = $ss->fetch_assoc()){$rrid1 = $ss1['rrdetails'];}
$conn->query("insert into savequantity (rrdetails, expiration, lotno) value ('$rrid1', '$expiration', '$lotno')");

echo"<script>window.location='?stockreturn2$datax$datax2'</script>";

}else{echo"<script>alert('Zero Quantity!'); window.location='?stockreturn2$datax$datax2'</script>";}
}



if(isset($_POST['btndel'])){
$code=$_POST['code'];
$sql1=$conn->query("DELETE FROM purchaseorder WHERE po='$rrno' AND code='$code'");
echo"<script>window.location='?stockreturn2$datax$datax2'</script>";
}
?>





<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?stockreturn">Stock Return to Warehouse</a></li>
<li class="breadcrumb-item"><a>Create Stock Return</a></li>
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
<tr><td width="65%" valign="top">


<div class='card' style="box-shadow: 0px 0px 0px 1px lightgrey;">
<div class='card-body'>

<table align="center" width="100%">
<tr>
<td width="50%"><font size='2' color='black'>Return To: <b><?php echo $requesteddeptname ?></td>
<td><font size='2' color='black'>Department: <b><?php echo $dept ?></td>
</tr>
<tr>
<td><font size='2' color='black'>Transaction Date: <b><?php echo $transdate ?></td>
<td><font size='2' color='black'>Requisition No.: <b><?php echo $rrno ?></td>
</tr>
<tr>
<td><font size='2' color='black'>Transaction Type: <span class='badge bg-primary'><?php echo $transactiontype ?></span></td>
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

<?php
 $rrno2 = str_replace (' ', '__',  $rrno);
$dept2 = str_replace (' ', '__', $dept);
?>

<div class='card' style="box-shadow: 0px 0px 0px 1px lightgrey;">
<div class='card-body'>
<div style="text-align: right;">
<button class="btn btn-danger" type="button" name="btnpost" style="border: none; padding: 4px 10px; font-size: 14px; margin: 2px 1px; background: #05471a; color: white;"><i class='icofont-close-line-circled'></i> Cancel</button>
<a href="../scmprint/stockrequest/<?php echo $rrno2 ?>/<?php echo $dept2 ?>" target="_blank">
<button class="btn btn-danger" type="button" name="btnpost" style="border: none; padding: 4px 10px; font-size: 14px; margin: 2px 1px; background: #782626; color: white;"><i class='icofont-printer'></i> Print Request</button>
</a>

</div>
<hr>

<h5>Search Item<h5>
<form method="POST">
<table>
<tr><td style="font-size: 12px;">Item Description:</td></tr>
<tr><td>
<select class="select2-single form-control" name="code" onchange="getsoh(this.value)" required>
<option value=" ">SELECT ITEM</option>
<?php												
$sqlm = "SELECT r.code, r.description, r.generic, r.itemname FROM receiving r JOIN stocktable s ON r.code = s.code WHERE s.dept = '$dept'
 GROUP BY r.code ORDER BY r.itemname";
$resultm = $conn->query($sqlm);
while($rowm = $resultm->fetch_assoc()) {
$desc=$rowm['description'];
$code=$rowm['code'];
$gen=$rowm['generic'];
echo"<option value='$code'>$desc ($gen)</option>";
} ?>
</select>
</td></tr>
<tr>
<td>
<br>
<table width='100%'>
<tr>
<td width='50%' style='font-size:11px;'>Stock on-hand:<br><input type="text" name="soh" id="soh" class="form-control" style="text-align: center;" readonly></td>
<td style='font-size:11px;'>Quantity Request:<br><input type="text" name="qty" class="form-control" style="text-align: center;" required></td>
</tr>
<tr>
<td style='font-size:11px;'>lotno:<br><input type="text" name="lotno" class="form-control" style="text-align: center;" required></td>
<td style='font-size:11px;'>Expiration:<br><input type="date" name="expiredate" class="form-control" style="text-align: center;" required></td>
</tr>
</table>
</td>
</tr>
<tr><td><br></td></tr>
<tr><td style="text-align: right;"><button type='submit' name='btnsave' class="btn btn-danger btn-sm" style="border: none; padding: 4px 10px; font-size: 14px; margin: 2px 1px; background: #110547; color: white;"><i class="icofont-check-circled"></i> Add to List</button></td></tr>
</table>
<input type='hidden' name="type" value='<?php echo $transactiontype ?>'>
<input type='hidden' name='rrno' id='rrno' value='<?php echo $rrno ?>'>
<input type="hidden" id="desc" name="desc">
<input type="hidden" id="unitcost" name="unitcost">
</form>

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
var deptreq = "<?php echo $dept ?>";
$.get("../pharmacy/scm_getsoh_uc.php", {str:str, deptreq:deptreq},
function (data) {
const myArray = data.split("_");
document.getElementById('unitcost').value=myArray[1];
document.getElementById('soh').value=myArray[0];
});
}
</script>