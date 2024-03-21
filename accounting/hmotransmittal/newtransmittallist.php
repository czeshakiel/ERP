<?php
$hmo = $_GET['hmo'];
$transdate = $_GET['transdate'];
$transdate2 = date("F d, Y", strtotime($transdate));
$batchno = $_GET['batchno'];
$ptype = $_GET['ptype'];
$ttype = $_GET['ttype'];
list($hmocode, $hmoname) = explode("||", $hmo);
$datax2="&batchno=$batchno&hmo=$hmo&transdate=$transdate&ptype=$ptype&ttype=$ttype";

if($ptype=="in"){$patienttype = "IN-PATIENT"; $qryz = "and a.caseno like '%I-%'";}
elseif($ptype=="in"){$patienttype = "OUT-PATIENT"; $qryz = "and a.caseno not like '%I-%'";}
else{$patienttype = "ALL"; $qryz = "";}

if(isset($_POST['btnsave'])){
$caseno=$_POST['caseno'];
$amount=$_POST['amount'];
$gl_id=$_POST['gl_id'];
$origamount=$_POST['origamount'];
$loa=$_POST['loa'];
$loe=$_POST['loe'];
$refno = "RN".date("YmdHis");


$ck = $conn->query("select * from arv_tbl_hmotransmittallist where batchno='$batchno' and caseno='$caseno' and status='pending'");
if(mysqli_num_rows($ck)>0){$conn->query("delete from arv_tbl_hmotransmittallist where batchno='$batchno' and caseno='$caseno' and status='pending'");}


$sql1="INSERT INTO `arv_tbl_hmotransmittallist`(`refno`, `batchno`, `caseno`, `idhmo`, `company`, `amount`, `origamount`, `transaction`, `status`, `user`, `transdate`, `datearray` , `ptype`, `trantype`, `chequeno`, `loano`, `loeno`) VALUES ('$refno', '$batchno', '$caseno', '$hmocode', '$hmoname', '$amount', '$origamount', 'requesting', 'pending', '$user', '$transdate', CURDATE(), '$ptype', '$ttype', '$gl_id', '$loa', '$loe')";
if($conn->query($sql1) === TRUE) {echo"<script>alert('Saved....');</script>";}
echo"<script>window.location='?newtransmittallist$datax2'</script>";
}


if(isset($_POST['btndel'])){
$code=$_POST['code'];
$sql1="DELETE FROM arv_tbl_hmotransmittallist WHERE autono='$code'";
if($conn->query($sql1) === TRUE) {echo"<script>alert('Deleted....');</script>";}
echo"<script>window.location='?newtransmittallist$datax2'</script>";
}


if(isset($_POST['btnpost'])){
$controlno=$_POST['controlno'];
$sql1="update arv_tbl_hmotransmittallist set transaction = 'Approved', controlno = '$controlno' where batchno = '$batchno'";
if($conn->query($sql1) === TRUE){
    $dd = $conn->query("select * from arv_tbl_hmotransmittallist where transaction = 'Approved' and controlno = '$controlno' and batchno = '$batchno' and chequeno!=''");
    while($dd1 = $dd->fetch_assoc()){$conn->query("update gl_posting set status='transmitted' where gl_id='$dd1[chequeno]' and gl_type='debit'");}

    echo"<script>alert('Successfully Submit!'); window.location='?view=newtransmittal$datax'</script>";

}else{echo"<script>alert('Unable to process transaction!'); window.location='?newtransmittallist$datax2'</script>";}
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

<div class="col-lg-7">
<div class="card">
<div class="card-body">

<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th class="text-center">#</th>
<th class="text-center">Patient</th>
<th class="text-center">Amount</th>
<th class="text-center"></th>
</tr>
</thead>
<tbody>


<?php
$i = 0;
if($ttype=="insurance"){
$result4 = $conn->query("select * from admission where hmo='$hmoname' and status='discharged' group by caseno");
while($row4 = $result4->fetch_assoc()) {
$patientidno=$row4['patientidno'];
$caseno=$row4['caseno'];
$dateadmit=$row4['dateadmit'];
$i++;

$amount = 0;
// if($ptype=="in"){
// $result2 = $conn->query("SELECT sum(hmo) as hmoamount FROM productout where caseno='$caseno' and trantype='charge'");
// while($row2 = $result2->fetch_assoc()) {$amount=$row2['hmoamount'];}
// }else{
// $result2 = $conn->query("SELECT sum(hmo) + sum(excess) as hmoamount FROM productout where caseno='$caseno' and trantype='charge'");
// while($row2 = $result2->fetch_assoc()) {$amount=$row2['hmoamount'];}
// }

$result2 = $conn->query("SELECT sum(hmo) as hmoamount FROM productout where caseno='$caseno' and trantype='charge'");
while($row2 = $result2->fetch_assoc()) {$amount=$row2['hmoamount'];}

$ff = $conn->query("select * from patientprofile where patientidno='$patientidno'");
while($ff1 = $ff->fetch_assoc()){$name = $ff1['lastname'].", ".$ff1['firstname']." ".$ff1['middlename'];}

$datedischarged =="";
$hh = $conn->query("select * from dischargedtable where caseno='$caseno'");
if(mysqli_num_rows($hh)==0){$hh = $conn->query("select * from arv_tbl_hmofinalize where caseno='$caseno'");}
while($hh1 = $hh->fetch_assoc()){$datedischarged = $hh1['datearray'];}

$ck = $conn->query("select * from arv_tbl_hmotransmittallist where caseno='$caseno' and idhmo='$hmocode'");
if(mysqli_num_rows($ck)==0){
echo"
<tr>
<td align='center'><font color='blue'>$i</td>
<td style='font-size: 10px;' valign='TOP'><font color='gray'><i class='icofont-id'></i> Caseno:</font> <a href='../nsstation/?detail&caseno=$caseno' target='_blank'>$caseno || $refno</a><br><font color='gray'><i class='icofont-user-alt-3'></i> Name:</font> <b>$name</b><br><font color='gray'><i class='icofont-calendar'></i> Date Admitted:</font> $dateadmit<br><font color='gray'><i class='icofont-calendar'></i> Date Discharged:</font> $datedischarged
<td style='font-size: 11px;'>
<table>
<tr><td>Amount:</td><td><input type='text' name='amountx' value='$amount' oninput=\"eload(this.value, '$i', 'xx$i');\" style='height:20px; font-size:10pt; padding: 0px; text-align: center;'></td></tr>
<tr><td>LOE#:</td><td><input type='text' value='' oninput=\"loe1(this.value, '$i', 'loe$i');\" style='height:20px; font-size:10pt; padding: 0px; text-align: center;'></td></tr>
<tr><td>LOA#:</td><td><input type='text' value='' oninput=\"loa1(this.value, '$i', 'loa$i');\" style='height:20px; font-size:10pt; padding: 0px; text-align: center;'></td></tr>
</table>
</td>
<td style='text-align: center;'>
<form method='POST'>
<button type='submit' class='btn btn-primary btn-sm' name='btnsave'><i class='icofont-check'></i></button>
<input type='hidden' name='caseno' value='$caseno'>
<input type='hidden' name='origamount' value='$amount'>
<input type='hidden' name='amount' id='xx$i' value='$amount'>
<input type='hidden' name='loe' id='loe$i'>
<input type='hidden' name='loa' id='loa$i'>
</form>
</td>
</tr>
";
}

}
}else{
$result4 = $conn->query("select c.amount, a.patientidno, a.caseno, c.refno from admission a, collection c where a.caseno=c.acctno 
and c.accttitle like '%$hmoname%' and a.status='discharged' and c.amount>0 group by a.caseno");
while($row4 = $result4->fetch_assoc()) {
$amount=$row4['amount'];
$patientidno=$row4['patientidno'];
$caseno=$row4['caseno'];
$refno=$row4['refno'];
$i++;

// ======================>> GL POSTING
if(strpos($caseno, "AR-") === false and strpos($caseno, "R-") !== false) {
if(strpos($refno, "GL")!==false){
$sel = $conn->query("select * from gl_posting where refno='$refno'");
if(mysqli_num_rows($sel)>0){
while($ssel = $sel->fetch_assoc()){$gl_id = $ssel['gl_id'];}

$fel = $conn->query("select * from gl_posting where gl_id='$gl_id' and gl_type='debit' and status='pending'");
if(mysqli_num_rows($fel)>0){
while($fel1 = $fel->fetch_assoc()){$loa=$fel1['amount'];}
}else{$loa="0";}
}
}else{$loa = "0";}
}
// ======================>> END GL POSTING

$ff = $conn->query("select * from patientprofile where patientidno='$patientidno'");
while($ff1 = $ff->fetch_assoc()){$name = $ff1['lastname'].", ".$ff1['firstname']." ".$ff1['middlename'];}

$datedischarged =="";
$hh = $conn->query("select * from dischargedtable where caseno='$caseno'");
if(mysqli_num_rows($hh)==0){$hh = $conn->query("select * from arv_tbl_hmofinalize where caseno='$caseno'");}
while($hh1 = $hh->fetch_assoc()){$datedischarged = $hh1['datearray'];}

$ck = $conn->query("select * from arv_tbl_hmotransmittallist where caseno='$caseno' and idhmo='$hmocode'");
if(mysqli_num_rows($ck)==0){
echo"
<tr>
<td align='center'><font color='blue'>$i</td>
<td style='font-size: 10px;'><font color='gray'><i class='icofont-id'></i> Caseno:</font> <a href='../nsstation/?detail&caseno=$caseno' target='_blank'>$caseno || $refno</a><br><font color='gray'><i class='icofont-user-alt-3'></i> Name:</font> <b>$name</b>
<td style='font-size: 11px;'><input type='text' name='amountx' value='$amount' oninput=\"eload2(this.value, '$i');\" style='height:30px; font-size:10pt; padding: 0px; text-align: center;'></td>
<td style='text-align: center;'>
<form method='POST'>
<button type='submit' class='btn btn-primary btn-sm' name='btnsave'><i class='icofont-check'></i></button>
<input type='hidden' name='caseno' value='$caseno'>
<input type='hidden' name='origamount' value='$amount'>
<input type='hidden' name='amount' id='xamount$i' value='$amount'>
<input type='hidden' name='gl_id' value='$gl_id'>
</form>
</td>
</tr>
";
}
}

}
?>

</tbody>
</table>

</div></div>
</div>

<div class="col-lg-5">

<div class="card">
<div class="card-body">

<h5><font color="black"><i class='icofont-users'></i> NEW TRANSMITTAL</h5><hr>

<table width="100%"><tr>
<td valign="TOP">

<!--div id="included-content"></div-->
<?php
$ddate = date('mdY');
echo"
<div class='card'>
<div class='card-body'>

<form method='POST'>
<table width='100%'>
<tr>
<td>Control Number:</td>
<td width='40%'><input type='text' name='controlno' value='$ddate'></td>
<td width='10%'><button class='btn btn-primary btn-sm' type='submit' name='btnpost'>POST</button></td>
</tr>
</table>
</form>
<hr>
<table align='center' width='95%'>
<tr>
<td width='50%' style='font-size: 12px;'><i class='icofont-institution'></i> $hmoname</td>
<td style='font-size: 12px;'><i class='icofont-numbered'></i> $batchno</td>
</tr>
<tr>
<td style='font-size: 12px;'><i class='icofont-ui-calendar'></i> $transdate2</font></td>
<td style='font-size: 12px;'><i class='icofont-native-american'></i> $patienttype</td>
</tr>
</table>
<hr>

<div class='card'>
<table class='tablex'>
<tr>
<th>DETAILS</th>
<th></th>
</tr>
";

$i = 0;
$sql33= $conn->query("SELECT * FROM arv_tbl_hmotransmittallist ar left join admission a on ar.caseno=a.caseno left join patientprofile p on a.patientidno=p.patientidno 
WHERE ar.batchno='$batchno'");
while($item=$sql33->fetch_assoc()){
$ptname = $item['patientname'];
$amm = $item['amount'];
$loano = $item['loano'];
$loeno = $item['loeno'];
$amm2 = number_format($amm, 2);
$i++;

echo"
<tr>
<td style='font-size:11px;'>
<font color='gray'><i class='icofont-id'></i> Name:</font> $ptname<br>
<font color='gray'><i class='icofont-id'></i> Amount:</font> $amm<br>
<font color='gray'><i class='icofont-id'></i> LOE#:</font> $loeno<br>
<font color='gray'><i class='icofont-id'></i> LOA#:</font> $loano
</td>
<td style='text-align: center;'>
<form method='POST'>
<button type='submit' class='btn btn-danger btn-sm' name='btndel' style='font-size: 9px; color: white; padding: 5px;'><i class='icofont-trash'></i> Del</button>
<input type='hidden' name='code' value='$item[autono]'>
</form>
</td>
</tr>
";
}
?>
</table></div>
</div>
</div>

</td></tr></table>



</div>
</div>

</div>
</div>
</section>

</main>



<script>
function eload(val, val2, id){
document.getElementById(id).value=val;
}

function loa1(val, val2, id){
document.getElementById(id).value=val;
}

function loe1(val, val2, id){
document.getElementById(id).value=val;
}
</script>