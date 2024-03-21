<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th class="text-center">#</th>
<th class="text-center">PATIENT <br> INFORMATION</th>
<th class="text-center">DATE/ TIME<br>REQUEST</th>
<th class="text-center">BATCHNO/ <br> PRODUCTTYPE</th>
<th class="text-center">AMOUNT/ <br> DISCOUNT</th>
<th class="text-center">ROOM/ <br> USER</th>
<th class="text-center">ACTION</th>
</tr>
</thead>
<tbody>


<?php
$sql = "SELECT a.patientidno, po.datearray, po.caseno,po.productdesc,po.refno,po.productsubtype,sum(po.gross) as amount, sum(po.adjustment) as discount,
 a.room, a.ward, a.status, po.loginuser, a.hmo, po.batchno, po.invno FROM productout po, admission a WHERE po.caseno=a.caseno and po.caseno not like '%_cancelled%'
  and po.trantype='cash' AND po.status='requested' AND a.ward = 'in' $displayx group by a.caseno, po.batchno having amount>0 order by po.batchno desc";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$caseno=$row['caseno'];
$datearray=$row['datearray'];
$productdesc=$row['productdesc'];
$refno=$row['refno'];
$productsubtype=$row['productsubtype'];
$amount=$row['amount'];
$room=$row['room'];
$ward=$row['ward'];
$status=$row['status'];
$loginuser=$row['loginuser'];
$hmo=$row['hmo'];
$dated=$row['datearray'];
$invno=$row['invno'];
$dtreq = date("F d, Y", strtotime($dated))."<br>".date("h:i:s a", strtotime($invno));
$batchno=$row['batchno'];
$discount=$row['discount'];
$patientidno=$row['patientidno'];
$i++;

$result2 = $conn->query("SELECT * from patientprofile where patientidno='$patientidno'");
while($row2 = $result2->fetch_assoc()) {
$patientname= utf8_encode($row2['lastname'].", ".$row2['firstname']." ".$row2['middlename']);
$sex=$row2['sex'];
$senior=$row2['senior'];
}

if($sex=="M"){if($senior=="Y"){$ge="boy";}else{$ge="boy";}}
else{if($senior=="Y"){$ge="girl";}else{$ge="girl";}}

list($amc, $desc, $type) = preg_split('/[-:-:-]/', $productdesc);
echo"
<tr>
<td bgcolor='$col' align='center'><font color='$colx' size='2'>$i.</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><table><tr><td><img src='../main/img/$ge.png' width='30' height='30' style='border-radius: 50%;'></td><td> $caseno<br><b>$patientname</b></td></tr></table></td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'>$dtreq</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'>$batchno<br>$productsubtype</td>
<td bgcolor='$col' style='color: $col1; font-size: 11px;'>$amount<br>$discount</td>
<td bgcolor='$col' style='color: $col1; font-size: 11px;'><font color='gray'><i class='icofont-bed'></i></font> $room<br><font color='gray'><i class='icofont-user'></i></font> $loginuser</td>
<td style='text-align: center;' bgcolor='$col'>
<a href='?outpatientdetail&caseno=$caseno&batchno=$batchno&productsubtype=$productsubtype$datax' title='View Detail'><button type='button' class='btn btn-primary btn-sm'><i class='icofont-eye-alt'></i> View</button></a>
</td>
</tr>
";  

} 


$sql = "SELECT a.patientidno, po.datearray, po.caseno,po.productdesc,po.refno,po.productsubtype,sum(po.gross) as amount, sum(po.adjustment) as discount,
 a.room, a.ward, a.status, po.loginuser, a.hmo, po.batchno, po.invno FROM productout po, admission a, dischargedtable d WHERE po.caseno=a.caseno and
  a.caseno=d.caseno and po.caseno not like '%_cancelled%' and po.trantype='cash' AND po.status='requested' AND a.ward = 'discharged'
   and DATE(d.datearray) > (NOW() - INTERVAL 2 DAY) group by a.caseno, po.batchno having amount>0 order by po.batchno desc";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$caseno=$row['caseno'];
$datearray=$row['datearray'];
$productdesc=$row['productdesc'];
$refno=$row['refno'];
$productsubtype=$row['productsubtype'];
$amount=$row['amount'];
$room=$row['room'];
$ward=$row['ward'];
$status=$row['status'];
$loginuser=$row['loginuser'];
$hmo=$row['hmo'];
$dated=$row['datearray'];
$invno=$row['invno'];
$dtreq = date("F d, Y", strtotime($dated))."<br>".date("h:i:s a", strtotime($invno));
$batchno=$row['batchno'];
$discount=$row['discount'];
$patientidno=$row['patientidno'];
$i++;

$result2 = $conn->query("SELECT * from patientprofile where patientidno='$patientidno'");
while($row2 = $result2->fetch_assoc()) {
$patientname= utf8_encode($row2['lastname'].", ".$row2['firstname']." ".$row2['middlename']);
$sex=$row2['sex'];
$senior=$row2['senior'];
}

if($sex=="M"){if($senior=="Y"){$ge="boy";}else{$ge="boy";}}
else{if($senior=="Y"){$ge="girl";}else{$ge="girl";}}

list($amc, $desc, $type) = preg_split('/[-:-:-]/', $productdesc);
echo"
<tr>
<td bgcolor='$col' align='center'><font color='$colx' size='2'>$i.</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><table><tr><td><img src='../main/img/$ge.png' width='30' height='30' style='border-radius: 50%;'></td><td> $caseno<br><b>$patientname</b></td></tr></table></td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'>$dtreq</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'>$batchno<br>$productsubtype</td>
<td bgcolor='$col' style='color: $col1; font-size: 11px;'>$amount<br>$discount</td>
<td bgcolor='$col' style='color: $col1; font-size: 11px;'><font color='gray'><i class='icofont-bed'></i></font> $room<br><font color='gray'><i class='icofont-user'></i></font> $loginuser</td>
<td style='text-align: center;'>
<a href='?outpatientdetail&caseno=$caseno&batchno=$batchno&productsubtype=$productsubtype$datax' title='View Detail'><button type='button' class='btn btn-warning btn-sm'><i class='icofont-eye-alt'></i> View</button></a>
</td>
</tr>
";  
}

if($dept=="CASHIER"){
$sqlc = "select acctname,description,accttitle,amount,acctno,refno,username from collection  where  type='pending' and amount > 0
 and (accttitle not like 'AR %%' and accttitle!='APPF OTHERS PF' and accttitle!='FOR REFUND') and acctno not like 'R-%' and DATE(datearray) > (NOW() - INTERVAL 7 DAY)";
$resultc = $conn->query($sqlc);
while($rowc = $resultc->fetch_assoc()){
$acctname2=$rowc['acctname'];
$description2=$rowc['description'];
$accttitle2=$rowc['accttitle'];
$amount2=$rowc['amount'];
$refno2=$rowc['refno'];
$acctno2=$rowc['acctno'];
$uuname=$rowc['username'];
$i++;

$sqlcc = "select room,hmo,ward,status from admission  where  caseno='$acctno2'";
$resultcc = $conn->query($sqlcc);
while($rowcc = $resultcc->fetch_assoc()) {
$room2=$rowcc['room'];
$hmo2=$rowcc['hmo'];
$ward2=$rowcc['ward'];
$status2=$rowcc['status'];
}

$sqlccc = "select user from collectionpostedby  where  refno='$refno2'";
$resultccc = $conn->query($sqlccc);
while($rowccc = $resultccc->fetch_assoc()) {
$loginuser2=$rowccc['user'];
}

echo"
<tr>
<td bgcolor='$col' align='center'><font color='$colx' size='2'>$i.</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><table><tr><td><img src='../main/img/$ge.png' width='30' height='30' style='border-radius: 50%;'></td><td> $acctno2<br><b>$acctname2</b></td></tr></table></td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'>$dtreq</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'>$description2<br>$accttitle2</td>
<td bgcolor='$col' style='color: $col1; font-size: 11px;'>$amount2<br>$discount2</td>
<td bgcolor='$col' style='color: $col1; font-size: 11px;'>$room<br>$loginuser</td>
<td style='text-align: center;' bgcolor='$col'>
";

if($description2=="HOSPITAL-BILL" or $description2=="HOSPITAL BILL" or $description2=="HOSPITALBILL"){
$acc_desc = $description2;
}else{$acc_desc = $accttitle2;}

echo"
<a href='?outpatientdetail&caseno=$acctno2&productsubtype=$acc_desc$datax&collection' title='View Detail'><button type='button' class='btn btn-danger btn-sm'><i class='icofont-eye-alt'></i> View</button></a>
</td>
</tr>
";
 } }
 echo"
</tbody>
</table>

";

