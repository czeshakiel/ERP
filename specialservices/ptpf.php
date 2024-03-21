<main id="main" class="main">

<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?ptpf">PT PF Date</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">

<div class="card">
<div class="card-body">

<table width="40%">
<tr><td>

<div class="card" style='box-shadow: 0px 0px 0px 1px #4B54B2;'>
<div class="card-header" style="background-color: #4B54B2; padding: 7px;">
<table width="100%"><tr><td style="color: white;"> <i class="bi bi-award"></i> PT PROFESSIONAL FEE REPORT</td></tr></table>
</div>
<div class="card-body">

<form role="form" name="f1" action="index.php" method="GET" onSubmit="return submitPO();">
<input type="hidden" name="ptreport">

<table width="100%" align="center">
<tr>
<td width="20%"><font color="black">Date From:<br><input  name='datefrom' type='date' value="<?php echo date('Y-m-d'); ?>" class="form-control" required><br></td>
</tr>
<tr>
<td><font color="black">Date To:<br><input  name='dateto' type='date' value="<?php echo date('Y-m-d'); ?>" class="form-control" required><br></td>
</tr>
<tr>
<td style="text-align: right;"><button type="submit" name="submit" class="btn btn-primary btn-sm"><i class='icofont-check-circled'></i> Submit</button></td>
</tr>
</table>
</form>

</div>
</div>
</td></tr></table>

</div>
</div>

</div>
</div>
</section>

</main>


