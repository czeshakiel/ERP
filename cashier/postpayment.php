<table width="100%">
<tr><td width="60%" valign="top">
<div class='dd-handle'>
<div class='task-info d-flex align-items-center'></div>
<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>">#</th>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>">CASENO/ PATIENT NAME</th>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>">ROOM</th>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>"></th>
</tr>
</thead>
<tbody>
<?php


$i=0;
$sql = "SELECT a.*, p.lastname, p.firstname, p.middlename, p.sex FROM  admission a JOIN patientprofile p ON a.patientidno = p.patientidno
WHERE a.ward = 'in' AND a.room != 'OPD' ORDER BY a.dateadmit DESC, a.timeadmitted DESC";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$caseno=$row['caseno'];
$lname=$row['lastname'];
$fname=$row['firstname'];
$mname=$row['middlename'];
$name = $lname.", ".$fname." ".$mname;
$dateadmit=$row['dateadmit'];
$room=$row['room'];
$status=$row['status'];
$ap=$row['ap'];
$hmomembership=$row['hmomembership'];
$namearrayx=$lname.', '.$fname.' '.$mname;
$sex=$row['sex'];

$sql1 = "SELECT sum(gross) as gross1, sum(hmo) as gross2 from productout where caseno='$caseno'";
$result1 = $conn->query($sql1);
while($row1 = $result1->fetch_assoc()) {
$gross1=$row1['gross1'];
$gross2=$row1['gross2'];
}

$i++;
$colx  = "black";

if($sex=="M"){if($senior=="Y"){$ge="boy";}else{$ge="boy";}}
else{if($senior=="Y"){$ge="girl";}else{$ge="girl";}}

echo"
<tr>
<td>$i</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><table><tr><td><img src='../main/img/$ge.png' width='30' height='30' style='border-radius: 50%;'></td><td> $caseno<br><b>$name</b></td></tr></table></td>
<td style='color: $colx; font-size: 11px;'>$room<br>$status</td>
<td>
<a href='postpayment2.php?pname=$name&caseno=$caseno$datax' target='tabiframe'><button type='submit' class='btn btn-outline-primary btn-sm'><i class='icofont-architecture-alt'></i></button></a>
</td>
</tr>
";
?>

<?php }?>
</tbody>
</table>
</div>


</td><td width="1%"></td><td valign="top">
<br><br>
<div class='card' style='box-shadow: 0px 0px 0px 1px lightgrey;'>
<div class='card-body'>
<div class='d-flex align-items-center justify-content-between mt-5'>
<div class='lesson_name'>
<div class='project-block light-primary-bg'>
<i class='icofont-pay'></i>
</div>
<span class='small project_name fw-bold'> Patient Deposit Payment </span>
</div>
</div>
<table width="100%">
<tr><td>
<iframe id='tabiframe' name='tabiframe' src='' width='100%' height='600px' style='border:0'></iframe>
</td></tr></table>
</div></div>
</td></tr></table>