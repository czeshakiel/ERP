<?php
$sqlx1 = "SELECT * FROM admission where caseno='$caseno'";
$resultx1 = $conn->query($sqlx1);
while($rowx1 = $resultx1->fetch_assoc()){
$patientidno=$rowx1['patientidno'];
$initialdiagnosis=$rowx1['initialdiagnosis'];
$finaldiagnosis=$rowx1['finaldiagnosis'];
$status = $rowx1['status'];
}

mysqli_query($conn,"SET NAMES 'utf8'");
$sqlx2 = "SELECT * FROM patientprofile where patientidno='$patientidno'";
$resultx2 = $conn->query($sqlx2);
while($rowx2 = $resultx2->fetch_assoc()) {
$patientidno=$rowx2['patientidno'];
$sex=$rowx2['sex'];
if($sex=="F"){$sex="FEMALE"; $avat = "female";}
else{$sex="MALE"; $avat = "male";}
$age=$rowx2['age'];
$birthdate=$rowx2['birthdate'];
$senior=$rowx2['senior'];
$patientname=$rowx2['patientname'];
}
?>

<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?detail&caseno=<?php echo $caseno ?>">Patient Information</a></li>
<li class="breadcrumb-item"><a href="?dischargedsummary&caseno=<?php echo $caseno ?>">Discharged Summary</a></li>
</ol>
</nav>
</div>

<section class="section profile">

<div class="col">
<div class="card teacher-card">
<div class="card-body  d-flex">
<div class="profile-av pe-xl-4 pe-md-2 pe-sm-4 pe-4 text-center w220">
<img src='../main/img/<?php echo $avat ?>.png' width='120' height='120' style='border-radius: 50%;'>
<div class="about-info d-flex align-items-center mt-1 justify-content-center flex-column">
<font size="1" align="left">Patient ID: <b><?php echo $patientidno ?></b><br>Caseno: <b><?php echo $caseno ?></b></font>
</div>
</div>


<div class="teacher-info border-start ps-xl-4 ps-md-3 ps-sm-4 ps-4 w-100">
<table width="100%"><tr>
<td width="80%">
<h6  class="mb-0 mt-2  fw-bold d-block fs-6"><?php echo strtoupper($patientname) ?></h6>
<span class="py-1 fw-bold small-11 mb-0 mt-1"><?php echo $address ?></span>
</td>
</tr>
</table>

<div class="video-setting-icon mt-3 pt-3 border-top">
<table width="100%">
<tr>
<td width="15%" style="font-size: 11px;"><i class="icofont-medical-sign"></i> Initial Diagnosis: :</font></td>
<td style="font-size: 11px;"><b><?php echo $initialdiagnosis ?></b></font></td>
</tr>
<tr>
<td style="font-size: 11px;"><i class="icofont-medical-sign-alt"></i> Final Diagnosis :</font></td>
<td style="font-size: 11px;"><b><?php echo $finaldiagnosis ?></b></font></td>
</tr>
<tr>
<td style="font-size: 11px;"><i class="icofont-prescription"></i> Remarks :</font></td>
<td style="font-size: 11px;"><b><?php echo $remarks ?></b></font></td>
</tr>
</table>
</div>




</div>
</div>
</div>
</div>


<br>


<div class="card">
<div class="card-body pt-3">
<!-- Bordered Tabs -->
<div id='mainbtn'>
<table align='right'><tr>
<td>
<div class="dropdown">
<button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">
<i class="icofont-printer"></i> Print Prescription
</button>
<ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>
<?php
echo"<li><a class='dropdown-item' href='../chargecart/homemeds_print.php?caseno=$caseno' target='_blank'><i class='icofont-printer'></i> PRINT ALL</a></li>";
$sqlx77 = "SELECT * FROM productouthm where caseno ='$caseno' and (batchno like 'HM-%%' or batchno='$caseno') group by batchno";
$resultx77 = $conn->query($sqlx77);
while($rowx77 = $resultx77->fetch_assoc()) {
$bthm= $rowx77['batchno'];
if($bthm==$caseno){$bthm1="Discharged Sumarry RX";}else{$bthm1=$bthm;}
$u++;
echo"<li><a class='dropdown-item' href='../chargecart/homemeds_print.php?caseno=$caseno&batchno=$bthm' target='_blank'><i class='icofont-printer'></i> $bthm1</a></li>";
}
?>
</ul>
</div>
</td>
<td>


<a class="ms-link" href='http://<?php echo $ip ?>/ERP/printresult/dischargedsummary/<?php echo $caseno ?>' target='tabiframerequestforrefund'>
<button type="button" id="idrequestforrefund" data-bs-toggle="modal" data-bs-target="#requestforrefund"class='btn btn-danger' style="background: #811421; color: white;"><i class='icofont-printer'></i> Discharged Summary</button>
</a>

</td>
</tr></table>
</div><br>


<ul class="nav nav-tabs nav-tabs-bordered">
<li class="nav-item">
<button class="nav-link active" data-bs-toggle="tab" data-bs-target="#p1"><font size="2%"><i class="icofont-flask"></i> Laboratory Findings</font></button>
</li>

<li class="nav-item">
<button class="nav-link" data-bs-toggle="tab" data-bs-target="#p2"><font size="2%"><i class="icofont-pills"></i> Home Medications</font></button>
</li>

<li class="nav-item">
<button class="nav-link" data-bs-toggle="tab" data-bs-target="#p3"><font size="2%"><i class="icofont-info-circle"></i> Other Information</font></button>
</li>

</ul>
<div class="tab-content pt-2">

<div class="tab-pane fade show active" id="p1">

<div class="card" style='box-shadow: 0px 0px 0px 1px #146f81;'>
<div class="card-header" style="background-color: #146f81; padding: 7px; color: white;">LABORATORY FINDINGS</div>
<div class="card-body">
<table width="100%">
<tr>
<td width="40%">


<div class="dd-handle">
<div class="task-info d-flex align-items-center justify-content-between">
<table width="100%" align="center"><tr><td>
<select name='result' id='result' class='form-control' style='width: 100%;' onchange="loadz(this.value)";>
<option value=''>Select Laboratory Result...</option>";
<?php
 $sql = $conn->query("SELECT * FROM lablogs WHERE caseno='$caseno'");
while($res = $sql->fetch_assoc()){
$testname=$res['testname'];
$results=$res['results'];
$find=$testname.'-'.$results;
echo "<option value='$find'>$find</option>";
}

$sql = $conn->query("SELECT * FROM xray1 WHERE caseno='$caseno'");
while($res = $sql->fetch_assoc()){
$testname=$res['partexamined'];
$results=$res['impression'];
$find=$testname.' ---> '.$results;
echo "<option value='$find'>$find</option>";
}
?>
</select>
</td></tr>
<tr><td><br>
<textarea class="form-control" placeholder="Write Laboratory finding/s here...." id="labresult" name="labresult" onkeydown="if(event.keyCode == 13){return false;}" style="resize: none; height:200px; font-size:10pt; background: white; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e;"></textarea>
<input type='hidden' name='myid' id='myid'>
</td></tr>
<tr><td align='right'>
<br><button class='btn btn-danger btn-sm' name='btnsave' id='btnsave' value='btnsave' onclick='savedata();'>Submit Test</button>
</td></tr>
</table>
</div></div>


</td><td width="2%"></td><td valign="TOP">
<div style="overflow:scroll; height:350px; width: 100%;" id="myDiv">
<table id="myProjectTable1" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th scope="col" width="5%">#</th>
<th scope="col" width="80%">Lab Result</th>
<th scope="col" width="15%"></th>
</tr>
</thead>
<tbody>

<?php
$i=0;
$dd = $conn->query("SELECT * FROM labfindings WHERE caseno='$caseno' ORDER by no");
while($afetch = $dd->fetch_assoc()){
$no=$afetch['no'];
$labfindings=$afetch['labfindings'];
$dateadded=$afetch['dateadded'];
$addedby=$afetch['addedby'];
$i++;
echo"
<tr>
<td style='font-size:11px;'>$i</td>
<td style='font-size:15px;'>$labfindings</td>
<td style='font-size:11px;'>
<button type=button' class='btn btn-primary btn-sm' style='padding: 5px; font-size: 10px;'"; ?> onclick="editval('<?php echo $labfindings ?>', '<?php echo $no ?>')" <?php echo"><i class='icofont-edit'></i></button>
<button type='button' class='btn btn-danger btn-sm' name='btndel' style='padding: 5px; font-size: 10px; background: #a91e27; color: white;'";?> onclick="deletedata('<?php echo $no ?>')" <?php echo"><i class='icofont-trash'></i></button>
</td>
</tr>
";
}
?>
</tbody>
</table>
</div>
</td>
</tr>
</table>
</div></div>

</div>
<div class="tab-pane fade show" id="p2">

<div class="card" style='box-shadow: 0px 0px 0px 1px #146f81;'>
<div class="card-header" style="background-color: #146f81; padding: 7px; color: white;">Home Medications</div>
<div class="card-body">
<table width="100%">
<tr>
<td width="30%">

<div class="dd-handle">
<div class="task-info d-flex align-items-center justify-content-between">
<table width='100%' align='center' id="textview2">
<tr><td width='20%'><font color='black'>Description:</td><td>
<input type="text" name='pdesc' id='pdesc' list="meds" class='form-control' required>
<datalist id="meds">
<?php
$mm = $conn->query("select * from receiving where unit='PHARMACY/MEDICINE' order by description");
while($mm1=$mm->fetch_assoc()){
echo"<option value='$mm1[itemname]'>";
}
?>
</datalist>
</td></tr>
<tr><td style='text-align: right;'><font color='black'>Quantity:</td><td><input  name='qty' id='qty' type='text' value='' class='form-control' required></td></tr>
<tr><td style='text-align: right;'><font color='black'>Dosage:</td><td><input  name='route' id='route' type='text' value='' class='form-control'></td></tr>
<tr><td style='text-align: right;'><font color='black'>Frequency:</td><td><input  name='frequency' id='frequency' type='text' value='' class='form-control'></td></tr>
<tr><td style='text-align: right;'><font color='black'>AM:</td><td><input  name='am' id='am' type='text' value='' class='form-control'></td></tr>
<tr><td style='text-align: right;'><font color='black'>NN:</td><td><input  name='nn' id='nn' type='text' value='' class='form-control'></td></tr>
<tr><td style='text-align: right;'><font color='black'>PM:</td><td><input  name='pm' id='pm' type='text' value='' class='form-control'></td></tr>
<tr><td style='text-align: right;'><font color='black'>MN:</td><td><input  name='mn' id='mn' type='text' value='' class='form-control'></td></tr>
<tr><td style='text-align: right;'><font color='black'>Duration:</td><td><input  name='duration' id='duration' type='text' value='' class='form-control'></td></tr>
<tr><td colspan='2' style='text-align: right;'><br><button type='button' name='btnsubmithm' value='btnsave' class='btn btn-danger btn-sm' style='color: white;' onclick='savedata2()'><i class='icofont-check-circled'></i> Submit Prescription</button></td></tr>
</table>
<input type='hidden' name='codemed' id='codemed'>
<input type='hidden' name='batchnomed' id='batchnomed'>
</div></div>

</td><td width="2%"></td><td valign="TOP">

<div style="overflow:scroll; height:450px; width: 100%;" id="myDiv2">
<table id="myProjectTable2" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th scope="col" width="5%">#</th>
<th scope="col" width="50%">Generic/Brand</th>
<th scope="col" colspan="4" width="20%" style='text-align: center;'>timing</th>
<th scope="col">Duration</th>
<th scope="col"></th>
</tr>
<tr>
<th scope="col"></th>
<th scope="col"></th>
<th scope="col">AM</th>
<th scope="col">NN</th>
<th scope="col">PM</th>
<th scope="col">MN</th>
<th scope="col"></th>
<th scope="col"></th>
</tr>
</thead>
<tbody>

<?php
$i=0;
$dd = $conn->query("SELECT po.refno, po.productdesc, po.quantity, h.dosage, h.frequency, h.tam, h.tnn, h.tpm, h.tmn, h.duration,
 h.no, h.refno as refno2, h.code, h.batchno, sum(po.quantity) as qty FROM productouthm po, homemeds h WHERE po.caseno=h.caseno and po.productcode=h.code and h.caseno='$caseno' group by h.code, h.batchno ORDER by h.no");
while($afetch = $dd->fetch_assoc()){
$no=$afetch['no'];
$refno=$afetch['refno'];
$productdesc=$afetch['productdesc'];
$quantity=$afetch['quantity'];
$dosage=$afetch['dosage'];
$frequency=$afetch['frequency'];
$tam=$afetch['tam'];
$tnn=$afetch['tnn'];
$tpm=$afetch['tpm'];
$tmn=$afetch['tmn'];
$duration=$afetch['duration'];
$refno2=$afetch['refno2'];
$code=$afetch['code'];
$batchno=$afetch['batchno'];
$i++;


$ckp = $conn->query("select * from productout where caseno='$caseno' and batchno='$batchno' and status='PAID'");


echo"
<tr>
<td style='font-size:11px;'>$i</td>
<td style='font-size:11px;'><font color='gray'>Item:</font> <b>$afetch[productdesc]</b><br><font color='gray'>Dosage:</font> $afetch[dosage]<br><font color='gray'>Frequency:</font> $afetch[frequency]<br><font color='gray'>Quantity:</font> $afetch[qty]</td>
<td style='font-size:11px;'>$afetch[tam]</td>
<td style='font-size:11px;'>$afetch[tnn]</td>
<td style='font-size:11px;'>$afetch[tpm]</td>
<td style='font-size:11px;'>$afetch[tmn]</td>
<td style='font-size:11px;'>$afetch[duration]</td>
<td style='font-size:11px;'>

<button type=button' class='btn btn-primary btn-sm' style='padding: 5px; font-size: 10px;'"; ?> 
onclick="editval2('<?php echo $productdesc ?>', '<?php echo $quantity ?>', '<?php echo $dosage ?>', '<?php echo $frequency ?>', '<?php echo $tam ?>', '<?php echo $tnn ?>', '<?php echo $tpm ?>', '<?php echo $tmn ?>', '<?php echo $duration ?>', '<?php echo $code ?>', '<?php echo $batchno ?>')" 
<?php echo"><i class='icofont-edit'></i></button>
"; if(strpos($refno2, "MYHM")!==false or mysqli_num_rows($ckp)==0){ echo"
<button type='button' class='btn btn-danger btn-sm' name='btndel' style='padding: 5px; font-size: 10px; background: #a91e27; color: white;'";?> onclick="deletedata2('<?php echo $no ?>', '<?php echo $refno ?>')" <?php echo"><i class='icofont-trash'></i></button>
"; } echo"
</td>
</tr>
";
}
?>
</tbody>
</table>
</div>

</td></tr></table>
</div></div>

</div>
<div class="tab-pane fade show" id="p3">

<table width="50%">
<tr>
<td>

<div class="card" style='box-shadow: 0px 0px 0px 1px #146f81;'>
<div class="card-header" style="background-color: #146f81; padding: 7px; color: white;">Other Information</div>
<div class="card-body">

<div class="dd-handle">
<div class="task-info d-flex align-items-center justify-content-between">

<?php
$det = $conn->query("select * from dsdetails where caseno='$caseno'");
while($det1=$det->fetch_assoc()){
$datedischarged = $det1['datedischarged'];
$timedischarged = $det1['timedischarged'];
$operationdone = $det1['operationdone'];
$ffon = $det1['ffcheckupon'];
$ffat = $det1['ffat'];
$advicedto = $det1['advise'];
$dischargedby = $det1['dischargedby'];
$preparedby = $det1['preparedby'];
$receivedby = $det1['rod'];
}
?>

<table width='100%' align='center'>
<tr><td style='text-align: right; width: 30%;'><font color='black'>Date Discharged:</td><td><input name='datedischarged' id='datedischarged' type='date' value='<?php echo $datedischarged  ?>' class='form-control' required></td></tr>
<tr><td style='text-align: right;'><font color='black'>Time Discharged:</td><td><input  name='timedischarged' id='timedischarged' type='time' value='<?php echo $timedischarged  ?>' class='form-control' required></td></tr>
<tr><td style='text-align: right;'><font color='black'>Operation Done:</td><td><input  name='operationdone' id='operationdone' type='text' value='<?php echo $operationdone  ?>' class='form-control'></td></tr>
<tr><td style='text-align: right;'><font color='black'>Follow up check-up on:</td><td><input  name='ffon' id='ffon' type='text' value='<?php echo $ffon  ?>' class='form-control'></td></tr>
<tr><td style='text-align: right;'><font color='black'>Follow up check-up at:</td><td><input  name='ffat' id='ffat' type='text' value='<?php echo $ffat  ?>' class='form-control'></td></tr>
<tr><td style='text-align: right;'><font color='black'>Adviced to:</td><td><input  name='advicedto' id='advicedto' type='text' value='<?php echo $advicedto  ?>' class='form-control'></td></tr>
<tr><td style='text-align: right;'><font color='black'>Prepared By:</td><td><input  name='preparedby' id='preparedby' type='text' value='<?php echo $preparedby  ?>' class='form-control'></td></tr>
<tr><td style='text-align: right;'><font color='black'>Received By:</td><td><input  name='receivedby' id='receivedby' type='text' value='<?php echo $receivedby  ?>' class='form-control'></td></tr>
<tr><td style='text-align: right;'><font color='black'>Discharged By:</td><td><input  name='dischargedby' id='dischargedby' type='text' value='<?php echo $dischargedby  ?>' class='form-control'></td></tr>
<tr><td colspan='2' style='text-align: right;'><br><button type='button' name='btnsubmithm' value='btnsave' class='btn btn-danger btn-sm' style='color: white;' onclick='savedata3()'><i class='icofont-check-circled'></i> Submit Prescription</button></td></tr>
</table>
<input type='hidden' name='refnomed' id='refnomed'>
<input type='hidden' name='nomed' id='nomed'>
</div></div>


</div></div>

</td></tr></table>

</div>


</div>



</div>
</div>
</div>


<br><br>

</div>
</div>
</section>

</main><!-- End #main -->



<div class="modal fade" id="requestforrefund" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog modal-xl glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><b><i class="icofont-patient-file"></i> DISCHARGE SUMMARY</b></h5>
<button type="button" class="btn-close btn-outline-danger" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">

<table width="100%" align="center"><tr><td style="text-align: left;">
<iframe id='tabiframe2' name='tabiframerequestforrefund' src='' width='100%' height='600px' style="border:none;"></iframe>
</td><tr></table>

</div>
</div>
</div>
</div>



<script>
function loadz(val){document.getElementById('labresult').value=val;}

function editval(val, val2){
document.getElementById("labresult").value=val;
document.getElementById("myid").value=val2;
document.getElementById("btnsave").value='btnupdate';
}

function savedata(){
var str = "save_ds_lab";
var lab = document.getElementById("labresult").value;
var idx = document.getElementById("myid").value;
var btn = document.getElementById("btnsave").value;
var caseno = "<?php echo $caseno ?>";

$.get("../main/functions.php", {str:str, idx:idx, lab:lab, btn:btn, caseno:caseno},
function (data) {

swal({
icon: 'success',
title: 'Update Entries!',
text: 'SAVED',
type: 'error',
button: false,
timer: 1000
});

$('#myProjectTable1').load(' #myProjectTable1');
document.getElementById("result").selectedIndex = 0;
document.getElementById("labresult").value="";
document.getElementById("myid").value="";
document.getElementById("btnsave").value="btnsave";
});

}


function deletedata(val){
if (confirm("Are you sure you want to delete this data?")) {
var str = "delete_ds_lab";
$.get("../main/functions.php", {str:str, idx:val},
function (data) {

swal({
icon: 'success',
title: 'Delete Entries!',
text: 'Deleted',
type: 'error',
button: false,
timer: 1000
});

$('#myProjectTable1').load(' #myProjectTable1');
document.getElementById("result").selectedIndex = 0;
document.getElementById("labresult").value="";
document.getElementById("myid").value="";
document.getElementById("btnsave").value="btnsave";
});

}
}

function editval2(val, val2, val3, val4, val5, val6, val7, val8, val9, val10, val11){
document.getElementById("pdesc").value=val;
document.getElementById("qty").value=val2;
document.getElementById("route").value=val3;
document.getElementById("frequency").value=val4;
document.getElementById("am").value=val5;
document.getElementById("nn").value=val6;
document.getElementById("pm").value=val7;
document.getElementById("mn").value=val8;
document.getElementById("duration").value=val9;
document.getElementById("codemed").value=val10;
document.getElementById("batchnomed").value=val11;
var caseno = "<?php echo $caseno ?>";
}


function savedata2(){
var str = "save_ds_med";
var desc = document.getElementById("pdesc").value;
var qty = document.getElementById("qty").value;
var route = document.getElementById("route").value;
var frequency = document.getElementById("frequency").value;
var am = document.getElementById("am").value;
var nn = document.getElementById("nn").value;
var pm = document.getElementById("pm").value;
var mn = document.getElementById("mn").value;
var duration = document.getElementById("duration").value;
var code = document.getElementById("codemed").value;
var batchnox = document.getElementById("batchnomed").value;
var caseno = "<?php echo $caseno ?>";


$.get("../main/functions.php", {str:str, desc:desc, qty:qty, route:route, frequency:frequency, am:am, nn:nn, pm:pm, mn:mn, duration:duration, caseno:caseno, code:code, batchnox:batchnox},
function (data){

swal({
icon: 'success',
title: 'Update Entries!',
text: 'SAVED',
type: 'error',
button: false,
timer: 1000
});

$('#myProjectTable2').load(' #myProjectTable2');
$('#textview2').load(' #textview2');
$('#mainbtn').load(' #mainbtn');
});

}



function deletedata2(val, val2){
if (confirm("Are you sure you want to delete this data?")) {
var str = "delete_ds_med";
$.get("../main/functions.php", {str:str, no:val, refno:val2},
function (data) {

swal({
icon: 'success',
title: 'Delete Entries!',
text: 'Deleted',
type: 'error',
button: false,
timer: 1000
});

$('#myProjectTable2').load(' #myProjectTable2');
$('#textview2').load(' #textview2');
$('#mainbtn').load(' #mainbtn');
});

}
}


function savedata3(){
var str = "save_ds_oi";
var dd = document.getElementById("datedischarged").value;
var td = document.getElementById("timedischarged").value;
var od = document.getElementById("operationdone").value;
var ffon = document.getElementById("ffon").value;
var ffat = document.getElementById("ffat").value;
var at = document.getElementById("advicedto").value;
var pb = document.getElementById("preparedby").value;
var rb = document.getElementById("receivedby").value;
var db = document.getElementById("dischargedby").value;
var caseno = "<?php echo $caseno ?>";


$.get("../main/functions.php", {str:str, dd:dd, td:td, od:od, ffon:ffon, ffat:ffat, at:at, pb:pb, rb:rb, db:db, caseno:caseno},
function (data){

swal({
icon: 'success',
title: 'Update Entries!',
text: 'SAVED',
type: 'error',
button: false,
timer: 1000
});

});

}
</script>