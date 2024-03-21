<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?returnitem">Return Items</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">
<p><b><i class="bi bi-file-earmark-medical"></i> RETURN ITEMS </b></font></p><hr>

<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>">#</th>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>">PATEINT INFORMATION</th>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>">DATE REQUEST/ ROOM</th>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>">DATE/TIME ADMIT</th>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>">USER</th>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>"></th>
</tr>
</thead>
<tbody>

<?php
$i=0;$r2='';$z1 = 0;

$sqla2 = "select admission.patientidno,admission.caseno,admission.dateadmitted,patientprofile.lastname,patientprofile.firstname, patientprofile.sex,
patientprofile.middlename,admission.room,productreturn.username,productreturn.gross, productreturn.date, admission.dateadmit, admission.timeadmitted from admission,patientprofile,productreturn
where productreturn.trantype='finalized' and productreturn.caseno=admission.caseno and admission.patientidno = patientprofile.patientidno
and productreturn.gross like '%$dept%' group by productreturn.caseno order by patientprofile.lastname asc";
$resulta2 = $conn->query($sqla2);
while($rowa2 = $resulta2->fetch_assoc()) {
$patientidno =$rowa2['patientidno'];
$caseno =$rowa2['caseno'];
$dateadmitted =$rowa2['dateadmitted'];
$lastname =$rowa2['lastname'];
$firstname =$rowa2['firstname'];
$middlename =$rowa2['middlename'];
$room =$rowa2['room'];
$usernamex=$rowa2['username'];
$invnox=$rowa2['gross'];
$dateret=date("F d, Y", strtotime($rowa2['date']));
$patientname = strtoupper("$lastname".",  "."$firstname"."  "."$middlename");
$arvcol = "black";
$sex=$rowa2['sex'];
$dateadmit=date("F d, Y", strtotime($rowa2['dateadmit']));
$timeadmit=date("h:i:s a", strtotime($rowa2['timeadmitted']));
if($sex=="M"){$ge = "male"; $sexcol ="blue";}else{$ge = "female"; $sexcol ="#F309B6";}

$sqla22 = $conn->query("select * from room where room = '$room'");
while($rowa22 = $sqla22->fetch_assoc()){$ns = $rowa22['nursestation'];}

$i++;
$col="";

echo"
<tr>
<td bgcolor='$col' align='center'><font color='$colx' size='2'>$i.</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><table><tr><td><img src='../main/img/$ge.png' width='30' height='30' style='border-radius: 50%;'></td><td> $caseno $wardx<br><b>$patientname</b></td></tr></table></td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'>$dateret <br> $room <font color='blue'>[$ns]</font></td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'>$dateadmit <br> $timeadmit</td>
<td bgcolor='$col' style='color: $col1; font-size: 11px;'>$usernamex</td>
<td style='text-align: center;' bgcolor='$col'>
<a href='?returnitem2&caseno=$rowa2[caseno]' class='btn btn-outline-dark btn-sm' title='View Profile'>
<i class='icofont-eye'></i>
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
</div>
</div>
</section>
</main>


