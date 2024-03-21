<?php
$patientidno=$_GET['patientidno'];
include "../main/class.php";
include "../main/header.php";

$s1 = $conn->query("select * from patientprofile where patientidno='$patientidno'");
while($ss1 = $s1->fetch_assoc()){$name=strtoupper($ss1['lastname'].", ".$ss1['firstname']." ".$ss1['middlename']);}
?>

<div class='card'>
<div class='card-header py-3'><h6 class='mb-0 fw-bold '><font color="#3E8E75"><b><i class="icofont-qr-code"></i> <?php echo $patientidno ?></b><br><small><i class="icofont-user-alt-2"></i> <?php echo $name ?></small></font></h6></div>
<div class='card-body'>

<?php
$i = 0;
$result = $conn->query("SELECT a.dateadmit, a.timeadmitted, a.caseno, a.ap, a.finaldiagnosis, a.employerno FROM admission a, patientprofile p where 
a.patientidno=p.patientidno and p.patientidno='$patientidno' and (a.caseno like 'I-%' OR a.caseno like 'O-%') order by dateadmit desc, timeadmitted desc");
while($row = $result->fetch_assoc()) {
$dateadmit= date("M d, Y", strtotime($row['dateadmit']));
$timeadmit= date("h:i:s a", strtotime($row['timeadmitted']));
$caseno = $row['caseno'];
$ap=$row['ap'];
$finaldx=$row['finaldiagnosis'];
$employerno=$row['employerno'];


if(is_numeric($ap)){
$sqlAp=mysqli_query($conn,"SELECT `name` FROM docfile WHERE code='$ap'");
if(mysqli_num_rows($sqlAp)>0){
$myap=mysqli_fetch_array($sqlAp);
$ap=$myap['name'];
}else{$ap="";}
}

$datedisc=""; $timedisc="";
$sql33 = $conn->query("select * from dischargedtable where caseno='$caseno'");
if(mysqli_num_rows($sql33)>0){
while($res33 = $sql33->fetch_assoc()){
$datedisc = date("F d, Y", strtotime($res33['datearray']));
$timedisc = date("h:i:s a", strtotime($res33['timedischarged']));
}    
}

$i++;
echo"
<div class='timeline-item ti-danger border-bottom ms-2'>
<div class='d-flex' style='width: 100%;'>
<span class='avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg'>$i</span>
<div class='flex-fill ms-3'>
<div class='mb-1'><strong><font size='3px' color='#5A91DC'>$caseno</font></strong></div>

<table width='100%'>
<tr>
<td style='font-size:10px;' valign='TOP'><font size='2px' color='#548d0e'>Hospital Caseno:</font><br><b><i class='icofont-rounded-double-right'></i> $employerno</b></td>
</tr>
<tr>
<td style='font-size:10px;' valign='TOP'><font size='2px' color='#548d0e'>Date/Time Admitted:</font><br><b><i class='icofont-rounded-double-right'></i> $dateadmit $timeadmit</b></td>
</tr>
<tr>
<td style='font-size:10px;' valign='TOP'><font size='2px' color='#548d0e'>Date/Time Discharged:</font><br><b><i class='icofont-rounded-double-right'></i> $datedisc $timedisc</b></td>
</tr>
<tr>
<td style='font-size:10px;' valign='TOP'><font size='2px' color='#548d0e'>Attending Doctor:</font><br><b><i class='icofont-rounded-double-right'></i> $ap</b></td>
</tr>
<tr>
<td style='font-size:10px; text-align: justify;' valign='TOP'><font size='2px' color='#548d0e'>Diagnosis:</font><br><i class='icofont-rounded-double-right'></i> $finaldx</td>
</tr>
</table>
</font>

";?>
<br>
<table align="right"><tr><td>
<a href='?detail&caseno=<?php echo $caseno ?>'><button type="button" name="btnsub" title="View Profile" class="btn btn-outline-info btn-sm"><font size="2"><i class="icofont-search-job"></i></button></a>

<a href='http://<?php echo $ip ?>/ERP/printresult/dischargedsummary/<?php echo $caseno ?>' target='dis_sum'>
<button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#dis_sum_modal" title="Discharge Summary"><font size="2"><i class="icofont-printer"></i></button>
</a>

</td></tr></table>
<?php echo"


</div>
</div>
</div> <!-- timeline item end  -->
";
}
?>

</div>
</div>


