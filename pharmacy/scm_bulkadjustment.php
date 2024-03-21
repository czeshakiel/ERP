<?php
error_reporting(1);
$ff = $conn->query("select * from bulkadjustment where dept='$dept' group by batchno");
while($ff1 = $ff->fetch_assoc()){$batchno = $ff1['batchno'];}

if(isset($_POST['generate'])){
if($userunique=="arvid123" and $password=="azb"){
$batchno = "BA".date("YmdHis");
$sql = $conn->query("select r.code, r.description, r.generic, r.unit from receiving r, stocktable s where r.code=s.code and s.dept='$dept'
 group by r.code order by r.unit, r.description, r.generic");
while($res = $sql->fetch_assoc()){
$code = $res['code'];
$generic = $res['generic'];
$description = $res['description'];
$unit = $res['unit'];
if($generic!=""){$description = "$description ($generic)";}

$description = str_replace("ams-", "", $description);
$description = str_replace("-med", "", $description);
$description = str_replace("-sup", "", $description);
$description = addslashes($description);

$result2 = $conn->query("SELECT sum(quantity) as qtyy FROM stocktable where code='$code' and dept='$dept'");
while($row2 = $result2->fetch_assoc()) {$qty_stock=$row2['qtyy'];}
if($qty_stock==""){$qty_stock=0;}

$conn->query("INSERT INTO `bulkadjustment`(`code`, `desc`, `soh`, `dept`, `qty`, `user`, `accttitle`, `batchno`) VALUES 
('$code', '$description', '$qty_stock', '$dept', '', '', '$unit', '$batchno')");
}

$conn->query("INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('Generate List for Bulk Adjustment [$dept $batchno]', '$user', CURDATE(), CURTIME())");
echo"<script>window.location='?bulkadjustment';</script>";

}else{
echo"
<script>

swal({
icon: 'error',
title: 'Unauthorized!',
text: 'Generating bulk adjustments is not permitted for you. In order to proceed, please contact IT.!',
type: 'error',
button: false,
});

setTimeout(function () {window.location.href = '?bulkadjustment';}, 3000); 

</script>
";
}
}

if(isset($_POST['reset'])){
$sql = $conn->query("delete from bulkadjustment where dept='$dept'");
$conn->query("INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('Remove List for Bulk Adjustment [$dept $batchno]', '$user', CURDATE(), CURTIME())");
echo"<script>alert('done reset!'); window.location='?bulkadjustment';</script>";
}

if(isset($_POST['bulkadjustment'])){
$curdate = date("Y-m-d", strtotime($_POST['curdate']));
$curtime = date("H:i:s", strtotime($_POST['curtime']));

$i=0;
$sql6 = $conn->query("select * from bulkadjustment where qty!='' and dept='$dept'");
while($res6 = $sql6->fetch_assoc()){
$code = $res6['code'];
$desc = $res6['desc'];
$qty = $res6['qty'];
$userx = $res6['user'];
$mybatch = $res6['batchno'];
$comment = "Bulk Ajustment [$mybatch]";

$ndate = $curdate." ".$curtime;
$result2 = $conn->query("SELECT sum(quantity) as qtyy FROM stocktable where dept='$dept' and code='$code' and CONCAT(datearray, ' ', timearray)<'$ndate' group by code");
while($row2 = $result2->fetch_assoc()) {$oldqty=$row2['qtyy'];}
if($oldqty==""){$oldqty=0;}
$updatedqty = $qty - $oldqty;

if($qty!=$oldqty){
$i++;
$transid = "Adj-".date("YmdHsi").$i;
adjustment_entry($code, $desc, $oldqty, $qty, $comment, $transid, $updatedqty, $curdate, $curtime, $dept, $userx);
}

}

$sql = $conn->query("delete from bulkadjustment where dept='$dept'");   
$conn->query("INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('Submit Bulk Adjustment [$dept $batchno]', '$user', CURDATE(), CURTIME())");
echo"<script>alert('Done Bulk Adjustment'); window.location='?bulkadjustment';</script>";
}
?>

<style>
/* Popover */
.popover {color: red;}
.popover-content {
background-color: yellow;
color: red;
}

.tooltip-inner {white-space: pre-wrap;}

.tablex tr:hover{background: #F3D5E9;}

.p2 {
    font-family: Arial, Helvetica, sans-serif;
}
</style>



<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a>Bulk Adjustment</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">
<br>

<?php
$sqlx = $conn->query("select * from bulkadjustment where dept='$dept'");
if(mysqli_num_rows($sqlx)==0){echo"<form method='POST'><p align='center'><button class='btn btn-danger' name='generate'><i class='icofont-spinner-alt-2'></i> Generate List</button></p></form>";}
else{
echo"
<table><tr>
<td valign='top'><h6>Batchno: <b>$batchno</b></h6><i class='p2' style='color: red;'>Make sure to review your work before submitting the bulk adjustment.</i></td>
</tr></table>
<hr>


<table width='100%'><tr>
<td valign='TOP'>

<table width='100%'>
<tr>
<td width='15%'>
<form method='POST' action='../printslip/bulkadj/countsheet' target='_blank'>
<button class='btn btn-danger btn-sm' name='countsheet' style='width:100%;'><i class='icofont-printer'></i> Count Sheet</button>
<input type='hidden' name='dept' value='$dept'>
</form>
</td>
<td width='15%'><form method='POST'><button class='btn btn-warning btn-sm' name='reset' style='width:100%;'><i class='icofont-close-circled'></i> Reset List</button></form></td>
<td>||</td>
<td>
<form method='POST'>
<input type='date' name='curdate' style='width:30%; font-size: 13px; padding:4px; text-align:center;' required>
<input type='time' name='curtime' style='width:30%; font-size: 13px; padding:4px; text-align:center;' required>
<button class='btn btn-primary btn-sm' name='bulkadjustment'><i class='icofont-checked'></i> Submit Bulk Adjustment</button>
</form>
</td>
</tr>
</table>

</td></tr></table>
<hr>

<table width='100%' class='tablex' id='myProjectTable'>
<thead>
<tr>
<th width='5%'>#</th>
<th width='12%'>Code</th>
<th>Desc</th>
<th width='5%'>Generated<br>SOH</th>
<th width='5%'>Reltime<br>SOH</th>
<th width='10%'>New Qty</th>
<th width='10%'>User</th>
</tr>
</thead>
";

$i=0;
$sql3 = $conn->query("select * from bulkadjustment where dept='$dept'");
while($res3 = $sql3->fetch_assoc()){
$qty = $res3['soh'];
$code = $res3['code'];
$desc = $res3['desc'];
$id= $res3['id'];
$newqty= $res3['qty'];
$accttitle = $res3['accttitle'];
$userc = $res3['user'];
$i++;

$result2 = $conn->query("SELECT sum(quantity) as qtyy FROM stocktable where code='$code' and dept='$dept'");
while($row2 = $result2->fetch_assoc()) {$qty_stock=$row2['qtyy'];}
if($qty_stock==""){$qty_stock=0;}

if($newqty==""){$bgcol="";}else{$bgcol="#F2F3D5";}

echo"
<tr>
<td style='font-size:12px;'><b class='p2'>$i.</b></td>
<td style='font-size:12px;'><b class='p2'>$accttitle</b></td>
<td style='font-size:12px;'><b class='p2'>$desc</b></td>
<td style='font-size:12px; text-align: center;'><b class='p2'>$qty</b></td>
<td style='font-size:12px; text-align: center;'><b class='p2'>$qty_stock</b></td>
<td><input type='text' name='qty$i' id='qty$i' value='$newqty' oninput=\"updateqty('qty$i', '$id', 'user$i');\" style='width:100%; font-size: 15px; padding:4px; text-align:center; background: $bgcol;' class='form-control' onkeypress='return (event.charCode >= 48 && event.charCode <= 57)' tabindex='$i'></td>
<td style='font-size:8px;'><i id='user$i'>$userc</i></td>
</tr>
";
}
echo"</table>";
}

?>

</div>
</div>
</div>
</div>
</section>
</main>


<script>
function updateqty(quantity, id, userx){
var str = "adjustment_qty";
var user = "<?php echo $user ?>";
var qty = document.getElementById(quantity).value;

if(qty==""){
user='';
document.getElementById(quantity).style.backgroundColor = "";
}else{document.getElementById(quantity).style.backgroundColor = "#F2F3D5";}

document.getElementById(userx).innerHTML = user;

$.get("../main/functions.php", {str:str, qty:qty, id:id, user:user},
function (data) {});
}
</script>