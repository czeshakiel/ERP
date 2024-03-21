<?php
$actionadmit = $_GET['ad'];
if($actionadmit==""){
if(isset($_GET['consultationhistory'])){$actionadmit = $_GET['consultationhistory'];}
}
?>

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

<h5><font color="black"><i class='icofont-users'></i> List of Patient/ <span class='badge bg-secondary'><?php echo strtoupper($actionadmit) ?></span></h5><hr>


<table width="100%"><tr>
<td width="40%" valign="TOP">


<div class="input-group mb-3" valign="bottom">
<span class="input-group-text" id="basic-addon1"><i class="icofont-search-2"></i></span>
<input type="text" class="form-control" name="search_text" id="search_text" onchange="aa(this.value)" placeholder="Search Patient [Enter]">
</div>
</td>
<td valign="TOP" align="right"><button type="button" class="btn btn-primary" style="background: #3a3e6c; color: white;" data-bs-toggle="modal" data-bs-target="#exampleModalSm"><i class="icofont-waiter-alt"></i> New Patient</button></td>
</tr></table>

<div id="result"></div>


<script>
function aa(str){
//var str = document.getElementById('search_text').value;
var dept = "<?php echo $dept ?>";
var username = "<?php echo $user ?>";
var userunique = "<?php echo $userunique ?>";
var branch = "<?php echo $branch ?>";
var actionadmit = "<?php echo $actionadmit ?>";
$.get("../specialservices/patientlistfetch.php", {str:str, dept:dept, username:username, userunique:userunique, branch:branch, actionadmit:actionadmit},
function (data) {$("#result").html(data);});
}
</script>



</div>
</div>

</div>
</div>
</section>

</main>


<!-- Modal SM -->
<div class="modal fade" id="exampleModalSm" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="exampleModalSmLabel">NEW ADMISSION</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <table width="100%">
            <tr><td><a href='?walkinpatient'><button type="button" class="btn btn-danger" style="width:100%">Walkin Admission</button></a></td></tr>
            <tr><td><a href='?arpatient'><button type="button" class="btn btn-warning" style="width:100%">AR Admission</button></a></td></tr>
            </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModalSm2" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="exampleModalSmLabel">RE-ADMISSION</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method='POST'>
            <input type='hidden' name='ptid' id='ptid'>
            <table width="100%">
            <tr><td><button type="submit" name="walkinpatient" value="walkinpatient" class="btn btn-danger" style="width:100%">Walkin Admission</button></td></tr>
            <tr><td><button type="submit" name="arpatient" value="arpatient" class="btn btn-warning" style="width:100%">AR Admission</button></td></tr>
            </table>
            </form>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($_POST['walkinpatient'])){
$url = $_POST['walkinpatient'];
$ptid = $_POST['ptid'];
echo"<script>window.location='?$url&pid=$ptid';</script>";
}

if(isset($_POST['arpatient'])){
$url = $_POST['arpatient'];
$ptid = $_POST['ptid'];
echo"<script>window.location='?$url&pid=$ptid';</script>";
}
?>