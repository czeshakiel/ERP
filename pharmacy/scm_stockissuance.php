
<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?stockissuance">Stock Issuance</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<p><font color="black"><b><i class="bi bi-file-earmark-medical"></i> Stock Issuance</b></font></p><hr>

<form name="deptz">
<input type="hidden" name="deptz" value="<?php echo $dept ?>">
</form>

<table width="100%"><tr><td width="40%" valign="TOP">

<ul class="list-group mt-3" style='box-shadow: 0px 0px 1px 1px #400c25;'>


<?php
$a=0;
$msql = $conn->query("SELECT reqno, dept, reqdept, requser FROM purchaseorder WHERE status='request' AND dept='$dept' GROUP BY reqdept");
while($mres = $msql->fetch_assoc()){
$reqdept=$mres['reqdept'];
$a++;

$bsql=$conn->query("SELECT reqno, dept, reqdept, requser, reqdate FROM purchaseorder WHERE reqdept='$reqdept' AND status='request' AND dept='$dept' and prodqty>0 GROUP BY reqno");
$bcount=mysqli_num_rows($bsql);

if($bcount>0){
echo"
<li class='list-group-item d-flex' style='box-shadow: 0px 0px 0px 1px #400c25;'>
<div class='number border-end pe-2 fw-bold'><strong style='color:#46476D;'>$a</strong></div>
<div class='cs-text flex-fill ps-2'><span>$reqdept</span></div>
<div class='vote-text'><a href='?stockissuance&reqdept=$reqdept'><buttton class='btn btn-outline-warning btn-sm' style='padding: 2px 5px;'><span class='badge rounded-pill bg-danger'>$bcount</span> Pending</button></a></div>
</li>
";
}
}
?>
</ul>
<br>

</td><td width="1%"></td><td valign="TOP">
<?php if(isset($_GET['reqdept'])){ $rd = $_GET['reqdept']; ?>
<div class="card" style='box-shadow: 0px 0px 0px 1px #400c25;'>
<div class="card-header" style="background-color: #400c25; padding: 7px;">
<table width="100%"><tr>
<td style="color: white;"> <i class="bi bi-award"></i> Requesting Department: <b><u><?php echo $rd ?></u></b></td>
<td style="text-align: right;"><a href='?stockissuance'><button class="btn btn-danger btn-sm"><i class="icofont-close-circled"></i> Close</button></a></td>
</tr></table>
</div>
<div class="card-body">

<table id="patient-table" class="table table-hover" width="100%">
<thead>
<tr>
<th scope="col"></th>
<th scope="col">Request No.</th>
<th scope="col">Request Date</th>
<th scope="col">Requested By</th>
<th scope="col"></th>
</tr>
</thead>
<tbody>
<?php
$a=0;
$msql = $conn->query("SELECT reqno, dept, reqdept, requser, reqdate FROM purchaseorder WHERE reqdept='$rd' AND status='request' AND dept='$dept' and prodqty>0 GROUP BY reqno ORDER BY reqdate DESC");
while($mres = $msql->fetch_assoc()){
$reqno=$mres['reqno'];
$requser=$mres['requser'];
$reqdate=$mres['reqdate'];
$a++;


echo"
<tr>
<td style='font-size:11px;'>$a.</td>
<td style='font-size:11px;'>$reqno</td>
<td style='font-size:11px;'>$reqdate</td>
<td style='font-size:11px;'>$requser</td>
<td>
<a href='http://$ip/ERP/pharmacy/scm_stockissuance2.php?reqno=$reqno&reqdate=$reqdate&requser=$requser&reqdept=$rd' target='tabiframeissuance' style='color: white;'>
<button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#manageissuance' style='padding: 0px 5px; color: white; background: #400c25;'><i class='icofont-eye'></i></button>
</a>
</td>
</tr>
";

}
?>
</tbody>
</table>

</div>
</div>
<?php } ?>
</td></tr></table>

</div>
</div>
</div>
</div>
</section>
</main>


<!-------------------------------------------- RETURN MED/SUP ------------------------------------------->
<div class="modal fade" id="manageissuance" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog modal-xl glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><b><i class="icofont-finger-print"></i> MANAGE STOCK ISSUANCE</b></h5>
<button type="button" class="btn-close btn-outline-danger" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">

<table width="100%" align="center"><tr><td style="text-align: left;">
<iframe id='tabiframeissuance' name='tabiframeissuance' src='' width='100%' height='550px' style="border:none;"></iframe>
</td><tr></table>

</div>
</div>
</div>
</div>
<!---------------------------------------- END RETURN MED/SUP ------------------------------------------->