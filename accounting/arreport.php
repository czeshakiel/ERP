<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?arreport">Account Receivable Report</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">


<table width="100%">
<tr>
<td valign="top" style="width: 45%;">
<div class='card'>
<div class='card-header py-3'><h6 class='mb-0 fw-bold '><font color="#3E8E75"><i class="icofont-patient-file-alt"></i> ACCOUNT RECEIVABLE REPORTS</font></h6></div>
<div class='card-body'>


<?php
echo"
<div class='timeline-item ti-danger border-bottom ms-2'>
<div class='d-flex' style='width: 100%;'>
<span class='avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg'>1</span>
<div class='flex-fill ms-3'>
<div class='mb-1'><strong><font size='2px' color='#5A91DC'>AR EMPLOYEE [MEDICINE/SUPPLIES]</font></strong></div>
";?>
<table align="right">
<tr><td>
<a href="?arreport&aremployeemed">
<button type="button" class="btn btn-outline-primary btn-sm"><font size="2"><i class="icofont-file-alt"></i> View Report</button>
</a>
</td></tr></table>
<?php echo"


</div>
</div>
</div> <!-- timeline item end  -->
";
?>


<?php
echo"
<div class='timeline-item ti-danger border-bottom ms-2'>
<div class='d-flex' style='width: 100%;'>
<span class='avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg'>1</span>
<div class='flex-fill ms-3'>
<div class='mb-1'><strong><font size='2px' color='#5A91DC'>AR DOCTOR [MEDICINE/SUPPLIES]</font></strong></div>
";?>
<table align="right">
<tr><td>
<a href="?arreport&ardoctormed">
<button type="button" class="btn btn-outline-primary btn-sm"><font size="2"><i class="icofont-file-alt"></i> View Report</button>
</a>
</td></tr></table>
<?php echo"


</div>
</div>
</div> <!-- timeline item end  -->
";
?>


</div>
</div>
</td>

<td width="2%"></td>
<td valign="TOP">

<div class='card'>
<div class='card-body'>

<?php
if(isset($_GET['aremployeemed'])){include "../accounting/reports/ar_emp_doc.php";}
elseif(isset($_GET['ardoctormed'])){include "../accounting/reports/ar_emp_doc.php";}
?>

</div>
</div>

</td>
</tr>
</table>


</div>
</div>
</div>
</div>
</section>
</main>
