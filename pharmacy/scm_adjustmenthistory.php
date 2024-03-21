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

if(isset($_POST['submit3'])){
$batch = $_POST['batch'];
echo"<script>window.location='?bulkadjustmenthistory&batch=$batch';</script>";
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

<b><i class="bi bi-credit-card-2-back"></i> ADJUSTMENT HISTORY <small>[<?php echo date("F, Y"); ?>]</small></b><hr>
 
<table width="100%">
<tr><td valign="TOP" width="33%"> 


<div class='card' style="box-shadow: 0px 0px 0px 0px lightgrey;">
<div class='card-body'>Adjustment History [Per Item]<hr>

<form role="form" name="f1" method="POST" onSubmit="return submitPO();">
<input type="hidden" name="view" value="adjustmenthistory2det">
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
<td>Item:</td>
<td>
<select class="select2-single form-control" name="code" required>
<option value="">SELECT ITEM</option>
<?php												
$sqlm = "SELECT * from receiving where (unit like '%MEDICINE%' or unit like '%SUPPLIES%') order by itemname";
$resultm = $conn->query($sqlm);
while($rowm = $resultm->fetch_assoc()) {
$desc=$rowm['itemname'];
$code=$rowm['code'];
echo"<option value='$code'>$desc</option>";
} ?>
</select>
</td>
</tr>
<tr>
<td colspan="2" style="text-align: right;"><input type="submit" name="submit1" value="SUBMIT" class="btn btn-primary btn-sm" ></td>
</tr>
</table> <br>
</form> 

</div>
</div>
 
</td>
<td></td>
<td width="33%" valign="TOP">

<div class='card' style="box-shadow: 0px 0px 0px 0px lightgrey;">
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
</td>
<td></td>
<td width="33%" valign="TOP">

<div class='card' style="box-shadow: 0px 0px 0px 0px lightgrey;">
<div class='card-body'>Bulk Adjustment<hr>

<form role="form" name="f1" method="POST" onSubmit="return submitPO();">
<input type="hidden" name="view" value="adjustmenthistory2det">
<table width="100%" align="center">
<tr>
<td>Batch:</td>
<td>
<select class="select2-single form-control" style="width:100%;" name="batch" required>
<option value="">SELECT BATCH</option>
<?php												
$sqlmx = "SELECT * from userlogs where transaction like '%Submit Bulk Adjustment%' order by datearray, timearray";
$resultmx = $conn->query($sqlmx);
while($rowmx = $resultmx->fetch_assoc()) {
$transaction=$rowmx['transaction'];
$dt=date("F d, Y", strtotime($rowmx['datearray']))." ".date("h:i:s a", strtotime($rowmx['timearray']));
$ck = getTextBetween($transaction,"[","]");
list($mydept, $mybatch) = explode(" ", $ck);

if($dept==$mydept){echo"<option value='$mybatch'>$dt</option>";}
} ?>
</select>
</td>
</tr>
<tr>
<td colspan="2" style="text-align: right;"><input type="submit" name="submit3" value="SUBMIT" class="btn btn-primary btn-sm" ></td>
</tr>
</table> <br>
</form> 

</div>
</div>

</td>
</tr></table> 
        

</div>
</div>
</div>
</div>
</section>
</main>
