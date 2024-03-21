<?php $actionadmit = $_GET['ad']; ?>

<body onload="aa('');">
<main id="main" class="main">

<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?view=main">Main</a></li>
<li class="breadcrumb-item"></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">

<div class="card">
<div class="card-body">

<h5><font color="black"><i class='icofont-users'></i> LIST OF PATIENTS</h5><hr>

<div class="row">
<div class="col-lg-8">

<table width="70%"><tr>
<td valign="TOP">
<div class="input-group mb-3" valign="bottom">
<span class="input-group-text" id="basic-addon1"><i class="icofont-search-2"></i></span>
<input type="text" class="form-control" name="search_text" id="search_text" onchange="aa(this.value)" placeholder="Search Patient [Enter]">
</div>
</td>
</tr></table>

<div id="result"></div>

</div><div class="col-lg-4">
<!--iframe id='tabiframe' name='tabiframe' src='' width='100%' style='border:0; height: auto;'  onload="resizeIframe()"></iframe-->

<div id="included-content"></div>


</div></div>


<div class="modal fade" id="dis_sum_modal" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog modal-xl glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><b><i class="icofont-patient-file"></i> DISCHARGE SUMMARY</b></h5>
<button type="button" class="btn-close btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<table width="100%" align="center"><tr><td style="text-align: left;">
<iframe id='tabiframe2' name='dis_sum' width='100%' height='600px' style="border:none;"></iframe>
</td><tr></table>

</div>
</div>
</div>
</div>



<script>
function aa(str){
//var str = document.getElementById('search_text').value;
var dept = "<?php echo $dept ?>";
var username = "<?php echo $user ?>";
var userunique = "<?php echo $userunique ?>";
var branch = "<?php echo $branch ?>";
var actionadmit = "<?php echo $actionadmit ?>";
$.get("../doctorslog/patientlistfetch.php", {str:str, dept:dept, username:username, userunique:userunique, branch:branch, actionadmit:actionadmit},
function (data) {$("#result").html(data);});

document.getElementById("included-content").innerHTML="";
}


function resizeIframe() {
var iframe = document.getElementById("tabiframe");
iframe.style.height = iframe.contentWindow.document.body.scrollHeight + 'px';
}


function reloadIncludeFile(val) {
$.get("../doctorslog/patientlistdetail.php", {patientidno:val},
function (data) {$("#included-content").html(data);});
}
</script>



</div>
</div>

</div>
</div>
</section>

</main>
