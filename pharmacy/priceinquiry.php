<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?priceinquirynew">Price Inquiry</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">


<body  onload="startTime()">

<?php
if(isset($_POST['datefrom']) and isset($_POST['dateto'])){$datefrom = $_POST['datefrom']; $dateto = $_POST['dateto'];}
else{$datefrom = date("Y-m-d"); $dateto = date("Y-m-d");}
?>



<table width="100%"><tr>
<td><b><i class="bi bi-file-earmark-medical"></i> PRICE INQUIRY </b></td>
<td align="right">
</tr></table>
<hr>

<?php
echo "
<iframe src='../extra/Prices/?xox=".base64_encode($userunique)."&sdpt=$dept' title='description' width='100%' height='600' style='border: none;'></iframe>
";
?>

</div>
</div>
</div>
</div>
</section>
</main>
