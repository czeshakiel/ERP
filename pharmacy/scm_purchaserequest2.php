<?php
$supplier = $_GET['supplier'];
$transdate = $_GET['transdate'];
$trantype = $_GET['trantype'];
$terms = $_GET['terms'];
$rrno = $_GET['rrno'];
$receivingdept = "CPU";
$transdate2 = date("M-d-Y", strtotime($transdate));
list($supcode, $suppliername) = explode("_", $supplier);
$datax2="&rrno=$rrno&supplier=$supplier&transdate=$transdate&trantype=$trantype&terms=$terms&invoicedate=$invoicedate&invno=$invno";


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

$sql2n = "SELECT * from receiving where code = '$code'";
$result2n = $conn->query($sql2n);
while($row2n = $result2n->fetch_assoc()) {$generic=$row2n['generic'];}

$sql2l = "SELECT * FROM purchaseorder WHERE po='$rrno' AND code='$code'";
$result2l = $conn->query($sql2l);
$count = mysqli_num_rows($result2l);

if($count>0){
$conn->query("delete from purchaseorder where po='$rrno' and code='$code'");

$conn->query("INSERT INTO purchaseorder (rrno, transdate, supplier, suppliercode, terms, trantype, code, `description`, unitcost, generic, prodqty, dept, `status`, prodtype1, po, user, approvingofficer, reqdept, reqno, reqdate, requser) values ('', '$transdate2', '$suppliername', '$supcode', '$terms', '$trantype', '$code', '$desc', '$unitcost', '$transdate', '$qty', '$receivingdept', 'pending', '$discount', '$rrno', '$user', '', '$dept', '', '$transdate', '$user')");

//insert savequantity----------------------------
$kposql=mysqli_query($conn,"SELECT `rrdetails` FROM `purchaseorder` WHERE `po`='$rrno'");
while($kpofetch=mysqli_fetch_array($kposql)){
  $kporrd=$kpofetch['rrdetails'];
  $ksqtysql=mysqli_query($conn,"SELECT `rrdetails` FROM `savequantity` WHERE `rrdetails`='$kporrd'");
  if(mysqli_num_rows($ksqtysql)==0){
    mysqli_query($conn,"INSERT INTO `savequantity` (`rrdetails`, `quantity`) VALUES ('$kporrd', '0')");
  }
}
//-----------------------------------------------

echo"<script>window.location='?purchaserequest2$datax$datax2'</script>";
}else{
$conn->query("INSERT INTO purchaseorder (rrno, transdate, supplier, suppliercode, terms, trantype, code, `description`, unitcost, generic, prodqty, dept, `status`, prodtype1, po, user, approvingofficer, reqdept, reqno, reqdate, requser) values ('', '$transdate2', '$suppliername', '$supcode', '$terms', '$trantype', '$code', '$desc', '$unitcost', '$transdate', '$qty', '$receivingdept', 'pending', '$discount', '$rrno', '$user', '', '$dept', '', '$transdate', '$user')");

//insert savequantity----------------------------
$kposql=mysqli_query($conn,"SELECT `rrdetails` FROM `purchaseorder` WHERE `po`='$rrno'");
while($kpofetch=mysqli_fetch_array($kposql)){
  $kporrd=$kpofetch['rrdetails'];
  $ksqtysql=mysqli_query($conn,"SELECT `rrdetails` FROM `savequantity` WHERE `rrdetails`='$kporrd'");
  if(mysqli_num_rows($ksqtysql)==0){
    mysqli_query($conn,"INSERT INTO `savequantity` (`rrdetails`, `quantity`) VALUES ('$kporrd', '0')");
  }
}
//-----------------------------------------------

echo"<script>window.location='?purchaserequest2$datax$datax2'</script>";
}
}



if(isset($_POST['btndel'])){
$code=$_POST['code'];
$sql1=$conn->query("DELETE FROM purchaseorder WHERE po='$rrno' AND code='$code'");
echo"<script>window.location='?purchaserequest2$datax$datax2'</script>";
}



if(isset($_POST['btnpost'])){
$sql1="INSERT INTO stocktable (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`) SELECT `date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray` FROM stocktablepayables WHERE invno='$invno'";
if($conn->query($sql1) === TRUE) {
echo"
<script>
let a=document.createElement('a');
a.target='_blank';
a.href='../scm/rrresult1.php?rrno=$rrno&nursename=$user&userunique=$userunique&branch=$branch&dept=$dept&invno=$invno&transdate=$transdate&trantype=$trantype&terms=$terms&supplier=$suppliercode&suppliername=$suppliername&invdate=$invoicedate&reqdept=$dept';
a.click();
window.location='?manualreceiving$datax';</script>";
}else{echo"<script>alert('Unable to process transaction!'); window.location='?manualreceiving2$datax$datax2'</script>";
}
}
?>







<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?purchaserequest">Purchase Request</a></li>
<li class="breadcrumb-item"><a>Purchase Request Details</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<p><font color="black"><b><i class="icofont-file-earmark-medical"></i> PURCHASE REQUEST DETAILS</b></font></p><hr>


<table width="100%">
<tr><td width="45%" valign="top">


<div class='card' style="box-shadow: 0px 0px 1px 1px lightgrey;">
<div class='card-body' style="text-align: center;">
<div class="input-group mb-3" style="width: 80%;">
<span class="input-group-text" id="basic-addon1" style="box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e; background-color: white;">&#128269;</span>
<input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="product" id="search_text" onchange="aa()" placeholder="Search by description or generic [Enter]" style="box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e; background-color: white;">
</div>

<hr>


<script>
function aa(){
document.getElementById("loading2").style.display="";
document.getElementById("result").style.display="none";
var dept = "<?php echo $dept ?>";
var str = document.getElementById('search_text').value;
$.get("../pharmacy/scm_manualreceiving2fetch.php", {str:str, str2:dept},
function (data) {$("#result").html(data); document.getElementById("loading2").style.display="none"; document.getElementById("result").style.display="";});
}
</script>

<img style="width: 200px; display: none; align: center;" src="../main/img/loading.gif" id="loading2"></img>
<div id="result"></div>

</div>
</div>

</td><td width="1%"></td><td valign="TOP">

<div class='card' style="box-shadow: 0px 0px 1px 1px lightgrey;">
<div class='card-body'>
<a href='../medmatrix/po_print/<?php echo $rrno ?>' target='_blank'><button class="btn btn-danger" type="submit" name="btnpost" style="border: none; padding: 4px 10px; font-size: 14px; margin: 2px 1px;"><i class='icofont-printer'></i> Print PO</button></a>
<a href='../medmatrix/pr_print/<?php echo $rrno ?>' target='_blank'><button class="btn btn-primary" type="submit" name="btnpost" style="border: none; padding: 4px 10px; font-size: 14px; margin: 2px 1px;"><i class='icofont-printer'></i> Print PR</button></a>
<a href='../medmatrix/pr_study/<?php echo $rrno ?>' target='_blank'><button class="btn btn-warning" type="submit" name="btnpost" style="border: none; padding: 4px 10px; font-size: 14px; margin: 2px 1px;"><i class='icofont-printer'></i> Print PR Study</button></a>

<form method='POST' action='../medmatrix/bridge/printpo' target='_blank'>
    <button class="btn btn-danger" type="submit" name="btnpost" style="border: none; padding: 4px 10px; font-size: 14px; margin: 2px 1px;"><i class='icofont-printer'></i> Print PO</button>
    <input type='hidden' name='pono' value='<?php echo $rrno ?>'>
    <input type='hidden' name='user_login' value='<?php echo $user ?>'>
    <input type='hidden' name='supplier' value='<?php echo $supplier ?>'>
    <input type='hidden' name='trantype' value='<?php echo $trantype ?>'>
    <input type='hidden' name='reqdate' value='<?php echo $transdate ?>'>
    <input type='hidden' name='terms' value='<?php echo $terms ?>'>
</form>
<hr>


<table align="center" width="95%">
<tr>
<td width="65%"><font size='2' color='black'>Supplier: <b><?php echo $suppliername ?></td>
<td><font size='2' color='black'>Terms: <b><?php echo $terms ?></td>
</tr>
<tr>
<td><font size='2' color='black'>Department: <b><?php echo $dept ?></td>
<td><font size='2' color='black'>PONO: <b><?php echo $rrno ?></td>
</tr>
<tr>
<td><font size='2' color='black'>Transaction Date: <b><?php echo $transdate ?></td>
<td><font size='2' color='black'></td>
</tr>
</table>
<hr class="sidebar-divider">


<table width="98%" class="table">
<tr>
<td><font size='1'><b>Description</td>
<td class="text-center"><font size='1'><b>Qty</td>
<td class="text-center"><font size='1'><b>OrigUC</td>
<td class="text-center"><font size='1'><b>DiscUC</td>
<td class="text-center"><font size='1'><b>Total</td>
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
<td><font size='1' color='black'>$item[description]</td>
<td style='text-align: center;'><font size='1' color='black'>$item[prodqty]</td>
<td style='text-align: center;'><font size='1' color='black'>".number_format($item['unitcost'],2,".",",")."</td>
<td style='text-align: center;'><font size='1' color='black'>".number_format($proditem,2,".",",")."</td>
<td style='text-align: center;'><font size='1' color='black'>".number_format($total,2,".",",")."</td>
<td style='text-align: center;'>
<form method='POST'>
<button type='submit' class='btn btn-danger' name='btndel' style='border: none; padding: 4px 10px; font-size: 10px; margin: 2px 1px;'><i class='icofont-trash'></i></button>
<input type='hidden' name='code' value='$item[code]'>
</form>
</td>
</tr>
";
}
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






<!------------------------------------>
<form method="POST">
<div class="modal fade" id="exampleModal22cc" tabindex="-1">
<div class="modal-dialog" style="box-shadow: 0px 0px 2000px #6e7fcb;">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="icofont-cart-plus"></i> ITEM RECEIVING</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<table align='center' width='100%'>
<tr>
<td><font color='black'>Code:</td>
<td>
<input type='text' name='code' id='code' style='width:100%; box-shadow: 0 0 5px #FF99CC; border: 1px solid #FF6699; background-color: #FFF2FF; padding: 5px 12px; margin: 5px 0;' readonly></td>
</tr>
<tr>
<td><font color='black'>Description:</td>
<td>
<input type='text' name='desc' style='width:100%; box-shadow: 0 0 5px #FF99CC; border: 1px solid #FF6699; background-color: #FFF2FF; padding: 5px 12px; margin: 5px 0;' id='desc' readonly>
</td>
</tr>
<tr>
<td><font color='black'>Stock On-hand:</td>
<td>
<input type='text' name='soh' id='soh' style='width:100%; box-shadow: 0 0 5px #FF99CC; border: 1px solid #FF6699; background-color: #FFF2FF; padding: 5px 12px; margin: 5px 0; display: none;' readonly>
<button style='width:100%; box-shadow: 0 0 5px #FF99CC; border: 1px solid #FF6699; background-color: #FFF2FF; padding: 5px 12px; margin: 5px 0; display: none;' id='soh1' type="button" disabled><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...</button>
</td>
</tr>
<tr>
<td><font color='black'>Unitcost:</td>
<td>
<input type='text' name='unitcost' id='unitcost' style='width:100%; box-shadow: 0 0 5px #FF99CC; border: 1px solid #FF6699; background-color: #FFF2FF; padding: 5px 12px; margin: 5px 0; display: none;' required>
<button style='width:100%; box-shadow: 0 0 5px #FF99CC; border: 1px solid #FF6699; background-color: #FFF2FF; padding: 5px 12px; margin: 5px 0; display: none;' id='unitcost1' type="button" disabled><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...</button>
</td>
</tr>
<tr><td colspan='2'><hr></td></tr>
<tr>
<td><font color='black'>Quantity:</td>
<td>
<input type='text' name='qty' id='qty' style='width:100%; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e; background-color: #dee5ee; padding: 5px 12px; margin: 5px 0;' required></td>
</tr>
<tr>
<td><font color='black'>Discounted Unitcost:</td>
<td>
<input type='text' name='discount' id='discount' style='width:100%; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e; background-color: #dee5ee; padding: 5px 12px; margin: 5px 0;'></td>
</tr>
<tr>
<td style='text-align: right;' colspan='2'>
<button type='submit' name='btnsave' class='btn btn-primary' style='border: none; padding: 4px 10px; font-size: 14px; margin: 2px 1px;'><i class='icofont-save'></i> Post Data</button></td>
<input type='hidden' name='rrno' id='rrno' value='<?php echo $rrno ?>'>
</td>
</tr>
</table>

</div>
</div>
</div>
</div>
</form>
<!------------------------------------>


<script>
function loaddata(code, desc, qty, unitcost){
document.getElementById("code").value = code;
document.getElementById("desc").value = desc;
document.getElementById("soh").value = qty;
document.getElementById("unitcost").value = unitcost;
}

function getsoh(str){
document.getElementById('soh').style.display='none'; document.getElementById('soh1').style.display='';
document.getElementById('unitcost').style.display='none'; document.getElementById('unitcost1').style.display='';
$.get("../pharmacy/scm_getsoh_uc.php", {str:str},
function (data) {
    const myArray = data.split("_");
    document.getElementById('unitcost').value=myArray[1];
    document.getElementById('soh').value=myArray[0];
    document.getElementById('soh').style.display=''; document.getElementById('soh1').style.display='none';
    document.getElementById('unitcost').style.display=''; document.getElementById('unitcost1').style.display='none';
});
}
</script>
