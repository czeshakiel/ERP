<style>
/* Popover */
.popover {color: red;}
.popover-content {
background-color: yellow;
color: red;
}

.tooltip-inner {white-space: pre-wrap;}
</style>

<?php
error_reporting(1);
$sql22 = "SELECT * from admission where caseno='$caseno'";
$result22 = $conn->query($sql22);
while($row22 = $result22->fetch_assoc()) {
$patientidno=$row22['patientidno'];
}

if(isset($_POST['btnsave'])){
$code = $_POST['code'];
$desc = $_POST['desc'];
$oldqty = $_POST['oldqty'];
if($oldqty==""){$oldqty=0;}
$qty = $_POST['qty'];
$comment = $_POST['comment'];
$transid = "Adj-".date("YmdHsi");
$updatedqty = $qty - $oldqty;
$curdate = date("Y-m-d");
$curtime = date("H:i:s");

adjustment_entry($code, $desc, $oldqty, $qty, $comment, $transid, $updatedqty, $curdate, $curtime, $dept, $user);
echo"<script>alert('done..'); window.location='?adjustment$datax';</script>";
}
?>



<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a>Adjustment Entry</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<p><font color="black"><b><i class="bi bi-file-earmark-medical"></i> ADJUSTMENT ENTRY</b></font></p><hr>


<form name="deptz">
<input type="hidden" name="deptz" value="<?php echo $dept ?>">
</form>

<table width="100%"><tr><td width="60%" valign="TOP">



<div class='card' style="box-shadow: 0px 0px 1px 1px lightgrey;">
<div class='card-body' style="text-align: center;">

<div class="input-group mb-3" style="width: 70%; padding: 10px;">
<span class="input-group-text" id="basic-addon1">&#128269;</span>
<input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="product" id="search_text" onchange="aa()" placeholder="Search by description or generic [Enter]">
</div>
<hr>

<div id="result"></div>
<img style="width: 200px; display: none; align: center;" src="../main/img/loading.gif" id="loading2"></img>

<script>
function aa(){
document.getElementById("loading2").style.display="";
document.getElementById("result").style.display="none";
var str = document.getElementById('search_text').value;
$.get("../pharmacy/scm_adjustmentfetch.php", {str:str},
function (data) {$("#result").html(data); document.getElementById("loading2").style.display="none"; document.getElementById("result").style.display="";});   
}
</script><br>
</div>
</div>

</td><td width="1%"></td><td valign="TOP">

<div class='card' style="box-shadow: 0px 0px 1px 1px lightgrey;">
<div class='card-body'>
TODAY'S ADJUSTMENT<hr>
<table class="datatable table">
<thead>
<tr>
<th>DESCRIPTION:</th>
<th>Qty</th>
<th></th>

</tr>
</thead>
<?php

$sql22 = "SELECT * from scm_adjustmenthistory where dept='$dept' and datearray=CURDATE()";
$result22 = $conn->query($sql22);
$countx = mysqli_num_rows($result22);
while($row22 = $result22->fetch_assoc()) {
$qty=$row22['newqty'];
$qty1=$row22['oldqty'];
$description=$row22['desc'];
$reason=$row22['reason'];
$code=$row22['code'];
$user11=$row22['user'];
if($qty>$qty1){$tot = $qty - $qty1; } else {$tot = $qty1 - $qty;}
$description=str_replace("ams-","",$description);
$description=str_replace("-med","",$description);
$description=str_replace("-sup","",$description);


$sel = $conn->query("select * from receiving where code='$code'");
while($rec = $sel->fetch_assoc()){$unitx = $rec['unit'];}

if($unitx=="PHARMACY/MEDICINE"){$pics = "meds.png";}else{$pics="sup.png";}

$read = "Description: $description \n\nOld Qty: $qty1 \n\nNew Qty: $qty \n\nDISCREPANCY: $tot \n\nReason: $reason \n\nUser: $user11";
echo "
<tr>
<td width='70%' style='text-align: left;'><font color='black' size='1'><table width='100%'><tr><td width='5%'><img src='../main/img/$pics' width='20' height='20' style='border-radius: 50%;'></td><td><font size='1' color='black' title='$code'>$description</td></tr></table></font></td>
<td width='10%' style='text-align: left;'><font color='black' size='1'>$qty</font></td>
<td width='10%' style='text-align: left; font-size: 20px;'><i class='icofont-info-circle' data-bs-toggle='tooltip' title='$read'></i></td>
</tr>
";

}

?>

</table><br>
</div>

</td></tr></table>

</div>
</div>
</div>
</div>
</section>
</main>
