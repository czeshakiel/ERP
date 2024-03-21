<?php
$rrno = "RR".date("YmdHis");
if(isset($_POST['submit1'])){
$datefrom = $_POST['datefrom'];
$dateto = $_POST['dateto'];
$code = $_POST['code'];
echo"<script>window.location='?adjustmenthistorydet&datefrom=$datefrom&dateto=$dateto&code=$code';</script>";
exit();
}

if(isset($_POST['submit2'])){
$datefrom = $_POST['datefrom'];
$dateto = $_POST['dateto'];
echo"<script>window.location='?adjustmenthistory2&datefrom=$datefrom&dateto=$dateto';</script>";
exit();
}
?>
<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?adjustmenthistory">Adjustment History</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<b><i class="bi bi-credit-card-2-back"></i> COUNT SHEET <small>[<?php echo date("F, Y"); ?>]</small></b><hr>
 
<table width="70%">
<tr><td valign="TOP" width="50%"> 


<div class='card' style="box-shadow: 0px 0px 0px 1px lightgrey;">
<div class='card-body'>Count Sheet Generator<hr>

<form method="POST" action="../printslip/countsheet" target="_blank">
<input type="hidden" name="view" value="adjustmenthistory2det">
<table width="100%" align="center">
<tr>
<td>Department:<br>
<select class="select2-single" style="width:100%;" name="dept" required>
<option value="<?php echo $dept ?>"><?php echo $dept ?></option>
<?php												
$sqlm = "SELECT * from station order by station";
$resultm = $conn->query($sqlm);
while($rowm = $resultm->fetch_assoc()) {
$station=strtoupper($rowm['station']);
echo"<option value='$station'>$station</option>";
} ?>
</select>
</td>
</tr>

<tr>
<td>Type:<br>
<select class="select2-single" style="width:100%;" name="accttitle" required>
<option value="">Select Type</option>
<?php												
$sqlm1 = "SELECT r.unit FROM stocktable s INNER JOIN receiving r ON r.code=s.code GROUP BY r.unit";
$resultm1 = $conn->query($sqlm1);
while($rowm1 = $resultm1->fetch_assoc()) {
$unit=$rowm1['unit'];
echo"<option value='$unit'>$unit</option>";
} ?>
</select>
</td>
</tr>
<tr>
<td>Inventory Date:<br><input type="date" name="invdate" value="<?php echo date("Y-m-d"); ?>" style="width:100%; padding:2px;">
<tr>
<td style="text-align: right;"><button type="submit" name="countsheet" class="btn btn-primary btn-sm">Generate</button></td>
</tr>
</table> <br>
</form> 

</div>
</div>
 
</td>
<td width="2%"></td>
<td valign="TOP">

<div class='card' style="box-shadow: 0px 0px 1px 1px lightgrey;">
<div class='card-body'>Adjustment History [All]<hr>

<form role="form" name="f1" method="POST" onSubmit="return submitPO();">
<input type="hidden" name="view" value="adjustmenthistory2">

<table width="100%" align="center">
<tr>
<td width="25%">Date From:</td>
<td><input  name='datefrom' type='date' value="<?php echo date('Y-m-d'); ?>" class="form-control" required></td>
</tr>
<tr>
<td>Date To:</td>
<td><input  name='dateto' type='date' value="<?php echo date('Y-m-d'); ?>" class="form-control" required></td>
</tr>
<tr>
<td colspan="2" style="text-align: right;"><input type="submit" name="submit2" value="SUBMIT" class="btn btn-primary btn-sm" ></td>
</tr>
</table><br> 
</form> 

</div>
</div>
</td><td></td>
</tr></table> 
        

</div>
</div>
</div>
</div>
</section>
</main>
