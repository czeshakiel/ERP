
<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th class="text-center" width="5%" bgcolor="<?php echo $primarycolor2 ?>">#</th>
<th class="text-center" width="40%" bgcolor="<?php echo $primarycolor2 ?>">CASENO/ PATIENT NAME</th>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>">ROOM</th>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>">EXCESS</th>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>"></th>
</tr>
</thead>
<tbody>
<?php
$i=0;
//$sql = "SELECT * FROM admission, patientprofile where admission.patientidno=patientprofile.patientidno and ward ='in' and room!='OPD' and result = 'FINAL' order by dateadmit desc, timeadmitted desc";
if($dept=="CASHIER4"){
$sql = "SELECT * FROM admission, patientprofile where admission.patientidno=patientprofile.patientidno and (ward ='in' OR ward ='out') 
 and status!='discharged' and result = 'FINAL' and corp='' and caseno like 'R-%%' order by dateadmit desc, timeadmitted desc";
}
else{
$sql = "SELECT * FROM admission, patientprofile where admission.patientidno=patientprofile.patientidno and (ward ='in' OR ward ='out') 
and room!='OPD' and status!='discharged' and result = 'FINAL' and corp='' order by dateadmit desc, timeadmitted desc";
}
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
$sex=$row['sex'];
$hmomembership=$row['hmomembership'];
$namearrayx=$lname.', '.$fname.' '.$mname;
if($sex=="M"){$ge = "boy"; $sexcol ="blue";}else{$ge = "girl"; $sexcol ="#F309B6";}

$totalexcess=0;
$result1x = $conn->query("SELECT sum(excess) as totalexcess from productout where caseno='$caseno' and quantity>0 and trantype='charge'");
while($row1x = $result1x->fetch_assoc()){$totalexcess=$row1x['totalexcess'];}

$result1x2 = $conn->query("SELECT sum(amount) as amm from collection where acctno='$caseno' and (description = 'HOSPITAL BILL' or accttitle like '%TRADE%')");
while($row1x2 = $result1x2->fetch_assoc()){$amm=$row1x2['amm'];}

$totalexcess = $totalexcess - $amm;

$i++;
$colx  = "black";
$totalexcess2 = number_format($totalexcess, 2);

//if($totalexcess>0){
echo"
<td>$i</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><table><tr><td><img src='../main/img/$ge.png' width='30' height='30' style='border-radius: 50%;'></td><td> $caseno<br><b>$name</b></td></tr></table></td>
<td bgcolor='$col' style='color: $col1; font-size: 11px;'>$room<br>$status</td>
<td style='color: $col1; font-size: 11px;'>&#8369; $totalexcess2</td>
<td><a href='finalbill2.php?caseno=$caseno$datax' target='tabframex'><button type='button' class='btn btn-outline-primary btn-sm' data-bs-toggle='modal' data-bs-target='#requestreturn2'><i class='icofont-eye-alt' aria-hidden='true'></i> View</button></a></td>
</tr>
";
 //}

}
 ?>
</tbody>
</table>



<form method="POST">
<div class="modal fade" id="requestreturn2" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog modal-xl glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> Final Bill [Excess]</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<table width="100%" align="center"><tr><td style="text-align: left;">
<iframe class="responsive-iframe" name="tabframex" id="tabframex" width='100%' height='600px' style="border:none;"></iframe>
</td><tr></table>

</div>
</div>
</div>
</div>
</form>

