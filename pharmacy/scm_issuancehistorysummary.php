<?php
$rrno = "RR".date("YmdHis");
if(isset($_POST['submit1'])){
$datefrom = $_POST['datefrom'];
$dateto = $_POST['dateto'];
$code = $_POST['code'];
echo"<script>window.location='?issuancehistory2&datefrom=$datefrom&dateto=$dateto&code=$code';</script>";
exit();
}
?>

<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?issuancehistory">Issuance History</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<b><i class="bi bi-credit-card-2-back"></i> ISSUANCE HISTORY SUMMARY <small>[<?php echo date("F, Y"); ?>]</small></b><hr>
 
<table width="80%">
<tr><td valign="TOP" width="50%"> 


<div class='card' style="box-shadow: 0px 0px 1px 1px lightgrey;">
<div class='card-body'>Department Issuance Report Charged
<hr>

<form role="form" name="f1" method="POST" action="../medmatrix/issuance_history_charge" target="_blank">
<input type="hidden" name="department" value="<?php echo $dept ?>">
<table width="100%" align="center">
<tr>
<td width="25%">Date From:</td>
<td><input  name='startdate' type='date' value="<?php echo date('Y-m-d'); ?>" class="form-control" required></td>
</tr>
<tr>
<td>Date To:</td>
<td><input  name='enddate' type='date' value="<?php echo date('Y-m-d'); ?>" class="form-control" required></td>
</tr>
<tr>
<td>Request to:</td>
<td>
<select name="dept2" class="form-control">
<option value="CPU">CPU</option>
<option value="CSR">CSR</option>
</select>
</td>
</tr>
<tr>
<td colspan="2" style="text-align: right;"><input type="submit" class="btn btn-primary btn-sm" ></td>
</tr>
</table> <br>
</form> 

</div>
</div>
 
</td><td>

<div class='card' style="box-shadow: 0px 0px 1px 1px lightgrey;">
<div class='card-body'>Department Issuance Report Expense<hr>

<form role="form" name="f1" method="POST" action="../medmatrix/issuance_history_expense" target="_blank">
<input type="hidden" name="department" value="<?php echo $dept ?>">
<table width="100%" align="center">
<tr>
<td width="25%">Date From:</td>
<td><input  name='startdate' type='date' value="<?php echo date('Y-m-d'); ?>" class="form-control" required></td>
</tr>
<tr>
<td>Date To:</td>
<td><input  name='enddate' type='date' value="<?php echo date('Y-m-d'); ?>" class="form-control" required></td>
</tr>
<tr>
<td>Request to:</td>
<td>
<select name="dept2" class="form-control">
<option value="CPU">CPU</option>
<option value="CSR">CSR</option>
</select>
</td>
</tr>
<tr>
<td colspan="2" style="text-align: right;"><input type="submit" class="btn btn-primary btn-sm" ></td>
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
