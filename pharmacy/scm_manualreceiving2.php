<?php
$supplier = $_GET['supplier'];
$transdate = $_GET['transdate'];
$trantype = $_GET['trantype'];
$terms = $_GET['terms'];
$invoicedate = $_GET['invoicedate'];
$invno = $_GET['invno'];
$rrno = $_GET['rrno'];
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

$sql2l = "SELECT * FROM stocktablepreview WHERE invno='$invno' AND code='$code'";
$result2l = $conn->query($sql2l);
$count = mysqli_num_rows($result2l);

$dd = $conn->query("select max(rrdetails) as rrdetails from savequantity");
while($dd1 = $dd->fetch_assoc()){$rrdetails = $dd1['rrdetails']+1;}

if($count>0){
$sql2ll = "SELECT * FROM stocktablepreview WHERE invno='$invno' AND code='$code'";
$result2ll = $conn->query($sql2ll);
while($rowb = $result2ll->fetch_assoc()) { 
$oldqty=$rowb['quantity'];
$isid=$rowb['isid'];
$newqty=$oldqty+$qty;

$sql = "UPDATE stocktablepreview SET quantity='$newqty', statquantity='$newqty',recdqty='$newqty' WHERE rrno='$rrno' AND invno='$invno' AND code='$code'";	
if($conn->query($sql) === TRUE) {}

$conn->query("delete from savequantity where rrdetails='$isid'");
$conn->query("INSERT INTO `savequantity`(`rrdetails`, `quantity`, `expiration`, `lotno`, `vat`, `unit`) VALUES ('$isid', '$qty', '$expiration', '$lotno', '', '$unit')");
echo"<script>alert('update....'); window.location='?manualreceiving2$datax$datax2'</script>";
}


}else{
$sql1="INSERT INTO stocktablepreview(`date`,rrno,po,invno,suppliercode,suppliername,code,`description`,unitcost,quantity,recdqty,generic,statquantity,expiration,lotno,
trantype,terms,transdate,dept,prodtype1,paymentstatus,isid,receivinguser,prevqty,stockalert,duedate,datearray) values ('$invoicedate','$rrno','$invno','$invno','$supcode','$suppliername',
'$code','$desc','$unitcost','$qty','$qty','$generic','$qty','$expiration','$lotno','$trantype','$terms','$transdate','$dept','$discount','$remarks','$rrdetails','$user','0','u','$invoicedate','$transdate')";
if($conn->query($sql1) === TRUE) {}

$conn->query("INSERT INTO `savequantity`(`rrdetails`, `quantity`, `expiration`, `lotno`, `vat`, `unit`) VALUES ('$rrdetails', '$qty', '$expiration', '$lotno', '', '$unit')");
echo"<script>window.location='?manualreceiving2$datax$datax2'</script>";
}
}



if(isset($_POST['btndel'])){
$code=$_POST['code'];
$isid=$_POST['isid'];
$sql1="DELETE FROM stocktablepreview WHERE rrno='$rrno' AND invno='$invno' AND code='$code'";
if($conn->query($sql1) === TRUE) {}
$conn->query("delete from savequantity where rrdetails='$isid'");
echo"<script>window.location='?manualreceiving2$datax$datax2'</script>";
}



if(isset($_POST['btnpost'])){
$sql1="INSERT INTO stocktable (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`,
 `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`,
  `duedate`, `datearray`, `timearray`) SELECT `date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`,
   `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`,
    `duedate`, `datearray`, CURTIME() FROM stocktablepreview WHERE invno='$invno' and rrno='$rrno'";
if($conn->query($sql1) === TRUE){
$conn->query("INSERT INTO stocktablepayables (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`,
`statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`,
 `duedate`, `datearray`) SELECT `date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`,
  `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`,
   `duedate`, `datearray` FROM stocktablepreview WHERE invno='$invno' and rrno='$rrno'");

$conn->query("delete from stocktablepreview invno='$invno' and rrno='$rrno'");
echo"
<script>
let a=document.createElement('a');
a.target='_blank';
a.href='../medmatrix/rr_print/$invno/$rrno';
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
<li class="breadcrumb-item"><a href="?manualreceiving">Manual Receiving</a></li>
<li class="breadcrumb-item"><a>Manual Receiving Details</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<p><b><i class="bi bi-file-earmark-medical"></i> MANUAL RECEIVING DETAILS</b></p><hr>


<table width="100%">
<tr><td width="45%" valign="top">


<div class='card' style="box-shadow: 0px 0px 1px 1px lightgrey;">
<div class='card-body' style="text-align: center;">
<div class="input-group mb-3" style="width: 80%;">
<span class="input-group-text" id="basic-addon1" style="box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e; background-color: white;">&#128269;</span>
<input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="product" id="search_text" onchange="aa()" placeholder="Search by description or generic [Enter]" style="box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e; background-color: white;">
</div>



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
<form method='POST'><button class="btn btn-primary btn-sm" type="submit" name="btnpost" style="border: none; padding: 4px 10px; font-size: 14px; margin: 2px 1px;"><i class='icofont-save'></i> SAVE RECEIVING LIST</button></form>
<hr>


<table align="center" width="95%">
<tr>
<td width="65%"><font size='2' color='black'>Supplier: <b><?php echo $suppliername ?></td>
<td><font size='2' color='black'>Terms: <b><?php echo $terms ?></td>
</tr>
<tr>
<td><font size='2' color='black'>Department: <b><?php echo $dept ?></td>
<td><font size='2' color='black'>Invoice: <b><?php echo $invno ?></td>
</tr>
<tr>
<td><font size='2' color='black'>Transaction Date: <b><?php echo $transdate ?></td>
<td><font size='2' color='black'>RRNO: <b><?php echo $rrno ?></td>
</tr>
</table>
<hr class="sidebar-divider">


<table width="98%" class="table">
<tr>
<td><font size='1'><b>Description</td>
<td class="text-center"><font size='1'><b>Qty</td>
<td class="text-center"><font size='1'><b>OrigUP</td>
<td class="text-center"><font size='1'><b>DiscUP</td>
<td class="text-center"><font size='1'><b>Total</td>
<td class="text-center"><font size='1'><b>Action</td>
</tr>

<?php
$sql3="SELECT * FROM stocktablepreview WHERE invno='$invno' and rrno='$rrno'";
$sqlAdded=mysqli_query($conn,$sql3);
while($item=mysqli_fetch_array($sqlAdded)){

if($item['prodtype1']==0){
$total=$item['unitcost']*$item['quantity'];
$proditem=0;
}else{
$total=$item['quantity']*$item['prodtype1'];
$proditem=$item['prodtype1'];
}

echo"
<tr>
<td><font size='1' color='black'>$item[description]</td>
<td style='text-align: center;'><font size='1' color='black'>$item[quantity]</td>
<td style='text-align: center;'><font size='1' color='black'>".number_format($item['unitcost'],2,".",",")."</td>
<td style='text-align: center;'><font size='1' color='black'>".number_format($proditem,2,".",",")."</td>
<td style='text-align: center;'><font size='1' color='black'>".number_format($total,2,".",",")."</td>
<td style='text-align: center;'>
<form method='POST'>
<button type='submit' class='btn btn-danger' name='btndel' style='border: none; padding: 4px 10px; font-size: 10px; margin: 2px 1px;'><i class='icofont-trash'></i></button>
<input type='hidden' name='code' value='$item[code]'>
<input type='hidden' name='isid' value='$item[isid]'>
</form>
</td>
</tr>
";
}
?>
</table></td>
<td>

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
<div class="modal fade" id="exampleModal22cc" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> Item Receiving</h5>
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
<td><font color='black'>Lotno:</td>
<td>
<input type='text' name='lotno' style='width:100%; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e; background-color: #dee5ee; padding: 5px 12px; margin: 5px 0;'></td>
</tr>
<tr>
<td><font color='black'>Discount:</td>
<td>
<input type='text' name='discount' style='width:100%; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e; background-color: #dee5ee; padding: 5px 12px; margin: 5px 0;'></td>
</tr>
<tr>
<td><font color='black'>Expiration:</td>
<td>
<input type='date' name='expiredate' style='width:100%; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e; background-color: #dee5ee; padding: 5px 12px; margin: 5px 0;'></td>
</tr>
<tr>
<td><font color='black'>Remarks:</td>
<td>
<input type='text' name='remarks' style='width:100%; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e; background-color: #dee5ee; padding: 5px 12px; margin: 5px 0;'></td>
</tr>
<tr>
<td>
<input type='hidden' name='rrno' id='rrno' value='<?php echo $rrno ?>'>
</td><td align='right'>
<button type='submit' name='btnsave' class='btn btn-primary' style='border: none; padding: 4px 10px; font-size: 14px; margin: 2px 1px;'><i class='icofont-save'></i> Post Data</button></td>
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
    var deptreq = "<?php echo $dept ?>";
document.getElementById('soh').style.display='none'; document.getElementById('soh1').style.display='';
document.getElementById('unitcost').style.display='none'; document.getElementById('unitcost1').style.display='';
$.get("../pharmacy/scm_getsoh_uc.php", {str:str, deptreq:deptreq},
function (data) {
    const myArray = data.split("_");
    document.getElementById('unitcost').value=myArray[1];
    document.getElementById('soh').value=myArray[0];
    document.getElementById('soh').style.display=''; document.getElementById('soh1').style.display='none';
    document.getElementById('unitcost').style.display=''; document.getElementById('unitcost1').style.display='none';
});   
}
</script>