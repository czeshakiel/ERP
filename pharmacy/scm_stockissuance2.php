<!------------------------------- AUTO LOADING IF PAGE IS LOADING --------------------->
<style>
.center {
position: absolute;
top: 0;
bottom: 0;
left: 0;
right: 0;
margin: auto;
}
</style>

<script>
document.onreadystatechange = function() {
if (document.readyState !== "complete") {
document.getElementById("loading").style.display="";
document.getElementById("maindisplay").style.display="none";
} else {
document.getElementById("loading").style.display="none";
document.getElementById("maindisplay").style.display="";
}
};
</script>
<img src="../main/img/loading2.gif" id="loading" class="center"></img>
<!--------------------------- END AUTO LOADING IF PAGE IS LOADING --------------------->

<?php
include "../main/class.php";
include "../main/header.php";

$reqno=$_GET['reqno'];
$reqdate=$_GET['reqdate'];
$requser=$_GET['requser'];
$reqdept=$_GET['reqdept'];

if(isset($_GET['cancel'])){
$reqno=$_GET['reqno'];

$conn->query("Update purchaseorder set status='cancel' where reqno='$reqno'");
$conn->query("INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('Cancel Stock Request with the request number of [$reqno]', '$user', CURDATE(), CURTIME())");
echo"<script>window.history.back();</script>";
exit();
}

if(isset($_GET['cancelindv'])){
$id=$_GET['id'];
$conn->query("Update purchaseorder set status='cancel' where rrdetails='$id'");
$conn->query("INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('Cancel Stock Request with the request number of [$reqno] and rrdetails [$id]', '$user', CURDATE(), CURTIME())");
echo"<script>window.history.back();</script>";
exit();
}

if(isset($_POST['btnissue'])){
$checkb = $_POST['checkb'];
$qty = $_POST['qty'];
$ccount = count($checkb);

for($i=0; $i<$ccount; $i++){
list($id, $soh, $qtyreq, $code) = explode("_", $checkb[$i]);
if($qty[$i]>$soh){$qtyy = $soh;}else{$qtyy = $qty[$i];}

fifo_issuance($code, $dept, $reqdept, $qtyy, $reqno, $user);
}

echo"<script>alert('Stocks Issued Successfully!'); window.history.back();</script>";
exit();
}
?>

<form method="POST">
<div id="maindisplay">
<div class='dd-handle'>
<div class='task-info d-flex align-items-center justify-content-between'>
</div>

<table width="100%"><tr>
<td>Requesting Department: <b><?php echo $reqdept ?></b><br>Request Number: <b><?php echo $reqno ?></b></td>
<td style="text-align: right;">
<button type="submit" name="btnissue" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to issue this request?');" style="background: #245238; color: white;"><i class="icofont-email"></i> Issue Stocks</button>
<a href="scm_stockissuance2.php?reqno=<?php echo $reqno ?>&cancel" onclick="if (confirm('Are you sure you want to cancel this request?')){return true;}else{event.stopPropagation(); event.preventDefault();};"><button type="button" class="btn btn-danger btn-sm" style="background: #622e31; color: white;"><i class="icofont-trash"></i> Cancel Request</button></a>
</td>
</tr></table><hr>

<table class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th style="font-size: 11px;"></th>
<th style="font-size: 11px; width: 50%;">Description</th>
<th style="font-size: 11px; width: 10%;">Requested Qty</th>
<th style="font-size: 11px; width: 10%;">Trantype</th>
<th style="font-size: 11px; width: 10%;">SOH</th>
<th style="font-size: 11px; width: 10%;">ISSUED QTY</th>
<th style="font-size: 11px;"></th>
</tr>
</thead>
<tbody>


<?php
$sql = "SELECT * FROM purchaseorder where reqno='$reqno' and status='request' and prodqty>0";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$refno = $row['refno'];
$productcode = $row['code'];
$productdesc = $row['description'];
$qty = $row['prodqty'];
$trantype = $row['trantype'];
$id = $row['rrdetails'];

$result2 = $conn->query("SELECT sum(quantity) as qtyy FROM stocktable where code='$productcode' and dept='$dept'");
while($row2 = $result2->fetch_assoc()) {$soh=$row2['qtyy'];}

$ck_val = $id."_".$soh."_".$qty."_".$productcode;

if($soh<=0){$ckk = ""; $diss="disabled";}else{$ckk="checked"; $diss="";}
echo"
<tr>
<td><input type='checkbox' style='transform : scale(1.6);' value='$ck_val' id='$nana' name='checkb[]' $ckk $diss></td>
<td style='font-size: 11px;'>$productdesc</a></td>
<td style='font-size: 15px;'><span class='badge bg-danger'>$qty</span></td>
<td style='font-size: 11px;'>$trantype</td>
<td style='font-size: 11px;'>$soh</td>
<td><input type='text' name='qty[]' value='$qty' class='form-control' $diss></td>
<td style='font-size: 11px;'>
"; ?> <a href="scm_stockissuance2.php?id=<?php echo $id ?>&cancelindv" onclick="if (confirm('Are you sure you want to cancel <?php echo $productdesc ?>?')){return true;}else{event.stopPropagation(); event.preventDefault();};"><button type="button" class="btn btn-outline-primary btn-sm"><i class="icofont-trash"></i></button></td>
</tr> <?php
}

echo"</tbody></table></div>";
?>
</div>
</form>

<?php include "../main/footer.php"; ?>