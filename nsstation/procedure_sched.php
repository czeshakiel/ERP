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

<table width="100%"><tr><td>
<font color="black"><b><i class="bi bi-credit-card-2-back"></i> PROCEDURE SCHEDULE </b>
</td><td align="right">
<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#requestreturn22"><i class="icofont-plus-circle"></i> Request Procedure</button>
<!--button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#requestreturn2"><i class="icofont-plus-circle"></i> Add New Procedure</button-->
</td></tr></table><hr>


<table id="myProjectTable" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th scope="col">#</th>
<th scope="col" width="45%">Type of Procedure</th>
<th scope="col" width="20%">Status<br>Date/ Time Sched</th>
<th scope="col" width="30%">PF</th>
<th scope="col" width="5%">Type</th>
</tr>
</thead>
<tbody>


<?php
$i=0;
$sql = "select * from ORSCHEDULE where caseno='$caseno' order by dateofoperation desc, timeofoperation desc";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$status=$row['status'];
$typeofoperation=$row['typeofoperation'];
$dateofoperation=date("F d, Y", strtotime($row['dateofoperation']));
$timeofoperation=date("h:i:s a", strtotime($row['timeofoperation']));
$pf=$row['pf'];
$type=$row['type'];
$room=$row['room'];
$i++;

if($room=="OR"){
$pf=str_replace('"', "", $pf);
$pf=str_replace('[', "", $pf);
$pf=str_replace(']', "", $pf);
$pf = explode(",", $pf);
$countpf = count($pf);

for($d=0; $d<$countpf; $d++){
list($doctor, $specialization) = explode("||", $pf[$d]);

$dd = $conn->query("select * from docfile where code='$doctor'");
while($dd1 = $dd->fetch_assoc()){$doct = $dd1['name'];}

$mydoc = $doct." <font color='red'>".$specialization."</font>";
if($d==0){$mydoc2 = $mydoc;}else{$mydoc2 = $mydoc2."<br>".$mydoc;}
}

$dd2 = $conn->query("select * from rsurgery where proccode='$typeofoperation'");
while($dd12 = $dd2->fetch_assoc()){$typeofoperation = $dd12['procdesc'];}
}

echo"
<tr>
<td valign='TOP'>&#128204;</td>
<td valign='TOP' bgcolor='$col' style='color: $colx; font-size: 11px;'>$typeofoperation</td>
<td valign='TOP' bgcolor='$col' style='color: $colx; font-size: 11px;'>$status<br>$dateofoperation $timeofoperation</td>
<td valign='TOP' bgcolor='$col' style='color: $colx; font-size: 11px;'>$mydoc2</td>
<td valign='TOP' bgcolor='$col' style='color: $colx; font-size: 11px;'>$type</td>
</tr>
";
}

?>


</tbody>
</table>




</div>
</div>

</div>
</div>
</section>


<script>
function loadpro(str) {
$.get("loadpro.php", {
str:str
}, function (data, status) {
$("#pro").html(data);
});
}
</script>



<!-------------------------------------------- RETURN MED/SUP ------------------------------------------->
<div class="modal fade" id="requestreturn2" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog" style="box-shadow: 0px 0px 2000px #6e7fcb;">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> NEW PROCEDURE</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<form name="myform" method="POST">
<table style="width: 100%;" align="center">
<tr>
<td width="20%">DEPARTMENT:&nbsp;&nbsp;</b></td>
<td>
<select name="dept" onchange="loadpro(this.value)">
<option value="OR">OR</option>
<option value="ENDOSCOPY">ENDOSCOPY</option>
<option value="PT">PT</option>
<option value="RT">RT</option>
</select>
</td>
</tr>
<tr>
<td colspan="2"><br>PROCEDURE:</font></p><textarea name="dpro" id="" cols="30" rows="10" class="form-control"></textarea>
</td>
</tr>
<tr>
<td><br><br><br></td>
<td><p align="right"><button type="submit" name="btn_save" class="btn btn-xs btn-info"><font size="2%"><i class="fa fa-check-circle-o"> SAVE </i></font></button></td>
</tr>
</table><br>
</form>

</div>
</div>
</div>
</div>
<!---------------------------------------- END RETURN MED/SUP ------------------------------------------->

<!-------------------------------------------- RETURN MED/SUP ------------------------------------------->
<div class="modal fade" id="requestreturn22" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog" style="box-shadow: 0px 0px 2000px #6e7fcb;">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="icofont-patient-bed"></i> REQUEST PROCEDURE</h5>
<button type="button" class="btn-close" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">

<table width="100%" align="center"><tr><td style="text-align: left;">
<iframe id='tabiframe2' name='tabiframereturn' src='../nsstation/procedure_sched2.php?caseno=<?php echo $caseno ?>' width='100%' height='550px' style="border:none;"></iframe>
</td><tr></table>

</div>
</div>
</div>
</div>
<!---------------------------------------- END RETURN MED/SUP ------------------------------------------->

