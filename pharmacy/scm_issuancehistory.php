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

<b><i class="bi bi-credit-card-2-back"></i> ISSUANCE HISTORY <small>[<?php echo date("F, Y"); ?>]</small></b><hr>
 
<table width="40%">
<tr><td valign="TOP" width="50%"> 


<div class='card' style="box-shadow: 0px 0px 1px 1px lightgrey;">
<div class='card-body'>Select Transaction Date<hr>

<form role="form" name="f1" method="POST" onSubmit="return submitPO();">
<input type="hidden" name="view" value="issuancehistory2">
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
<td>Transaction:</td>
<td>
<select class="select2-single form-control" name="code" required>
<option value="in">Received Request</option>
<option value="out">Issued Request</option>
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
</tr></table> 
        

</div>
</div>
</div>
</div>
</section>
</main>
