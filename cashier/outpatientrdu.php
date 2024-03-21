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
$sql = "select productout.caseno,admission.patientidno,productout.productdesc,productout.status,productout.refno,productout.gross,productout.loginuser,productout.terminalname,admission.ward,admission.hmo,admission.room,productout.productsubtype,productout.sellingprice,productout.adjustment,productout.excess,productout.quantity,productout.datearray, productout.batchno from productout,admission where productout.caseno not like '%_cancelled%' and productout.productcode not like '%N/A%'  and productout.trantype='cash' and productout.status='requested' and admission.caseno=productout.caseno and (admission.room='RDU' or admission.caseno like 'WD-%') and (productout.sellingprice>0 and productout.quantity>0 and productout.gross>0 and productout.productsubtype not like 'LABORATORY') and DATE(productout.datearray) > (NOW() - INTERVAL 7 DAY) group by productout.datearray,productout.productsubtype,admission.caseno order by productout.datearray desc, productout.invno desc";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()){
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
    $excess=$row['excess'];
    $i++;



if(strpos($caseno, "WPOS")===false){$loading = "SELECT * from patientprofile where patientidno='$patientidno'";}
else{$loading = "SELECT * from patientprofilewalkin where patientidno='$patientidno'";}
$resultd = $conn->query("$loading");
while($row2 = $resultd->fetch_assoc()){
$patientname=$row2['lastname'].", ".$row2['firstname']." ".$row2['middlename'];
$sex=$row2['sex'];
$senior=$row2['senior'];
}

$patient = "$lastname"."_"."$caseno";
if($sex=="M"){if($senior=="Y"){$ge="boy";}else{$ge="boy";}}
else{if($senior=="Y"){$ge="girl";}else{$ge="girl";}}
echo"
<tr>
<td bgcolor='$col' align='center'><font color='$colx' size='2'>$i.</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><table><tr><td><img src='../main/img/$ge.png' width='30' height='30' style='border-radius: 50%;'></td><td> $caseno<br><b>$patientname</b></td></tr></table></td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'>$dtreq</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'>$batchno<br>$productsubtype</td>
<td bgcolor='$col' style='color: $col1; font-size: 11px;'>$amount<br>$discount</td>
<td bgcolor='$col' style='color: $col1; font-size: 11px;'><font color='gray'><i class='icofont-bed'></i></font> $room<br><font color='gray'><i class='icofont-user'></i></font> $loginuser</td>
<td style='text-align: center;' bgcolor='$col'>
";

if($productsubtype=="PROFESSIONAL FEE" or $productsubtype=="AMBULANCE FEE" or $productsubtype=="NURSE ON CALL" or $productsubtype=="CONSULTATION FEE"){$bb = "title='Edit Price' class='btn btn-danger btn-sm'";}else{$bb = "style='pointer-events: none;' class='btn btn-default border border-primary btn-sm'";}
?>
<div class="container">
<div class="btn-group btn-group-justified">

<a href="?outpatientdetail&caseno=<?php echo $caseno ?>&batchno=<?php echo $batchno ?>&productsubtype=<?php echo $productsubtype.$datax ?>" class="btn btn-primary btn-sm" title="View Detail"><i class="icofont-eye-alt"></i></a>

<a href="" data-bs-toggle="modal" data-bs-target="#exampleModal22cc" onclick="myacc('<?php echo $refno ?>', '<?php echo $productsubtype ?>', '<?php echo $excess ?>', '<?php echo $patientname ?>', '<?php echo $caseno ?>');" <?php echo $bb ?>><i class="icofont-ui-edit"></i></a>

</div>
</div>

</td>
</tr>
<?php  } ?>








<?php
$sqlc = "select acctname,description,accttitle,amount,acctno,refno,username, discount from collection  where  type='pending' and amount > 0 and (accttitle not like 'AR%%' and accttitle not like '%DISCOUNT%') and acctno like 'R-%' and DATE(datearray) > (NOW() - INTERVAL 10 DAY)";
$resultc = $conn->query($sqlc);
while($rowc = $resultc->fetch_assoc()) {
$acctname2=$rowc['acctname'];
$description2=$rowc['description'];
$accttitle2=$rowc['accttitle'];
$amount2=$rowc['amount'];
$refno2=$rowc['refno'];
$acctno2=$rowc['acctno'];
$uuname=$rowc['username'];
$amt=$rowc['amount'];
$discount2=$rowc['discount'];

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
while($rowccc = $resultccc->fetch_assoc()){
$loginuser2=$rowccc['user'];
}

$i++;
list($amc, $desc, $type) = preg_split('/[-:-:-]/', $productdesc);


if($sex=="M"){if($senior=="Y"){$ge="boy";}else{$ge="boy";}}
else{if($senior=="Y"){$ge="girl";}else{$ge="girl";}}
echo"
<tr>
<td bgcolor='$col' align='center'><font color='$colx' size='2'>$i.</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><table><tr><td><img src='../main/img/$ge.png' width='30' height='30' style='border-radius: 50%;'></td><td> $acctno2<br><b>$acctname2</b></td></tr></table></td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'>$dtreq2</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'>$description2<br>$accttitle2</td>
<td bgcolor='$col' style='color: $col1; font-size: 11px;'>$amount2<br>$discount2</td>
<td bgcolor='$col' style='color: $col1; font-size: 11px;'><font color='gray'><i class='icofont-bed'></i></font> $room<br><font color='gray'><i class='icofont-user'></i></font> $loginuser2</td>
<td style='text-align: center;' bgcolor='$col'>
";

if($productsubtype=="PROFESSIONAL FEE" or $productsubtype=="AMBULANCE FEE" or $productsubtype=="NURSE ON CALL" or $productsubtype=="CONSULTATION FEE"){$bb = "title='Edit Price' class='btn btn-danger btn-sm'";}else{$bb = "style='pointer-events: none;' class='btn btn-default border border-primary btn-sm'";}
?>
<div class="container">
<div class="btn-group btn-group-justified">

<a href="?outpatientdetail&caseno=<?php echo $acctno2 ?>&batchno=<?php echo $batchno ?>&productsubtype=<?php echo $description2.$datax ?>" class="btn btn-primary btn-sm" title="View Detail"><i class="icofont-eye-alt"></i></a>

<a href="" data-bs-toggle="modal" data-bs-target="#exampleModal22cc" onclick="myacc('<?php echo $refno ?>', '<?php echo $productsubtype ?>', '<?php echo $excess ?>', '<?php echo $patientname ?>', '<?php echo $caseno ?>');" <?php echo $bb ?>><i class="icofont-ui-edit"></i></a>

</div>
</div>

</td>
</tr>
<?php  } ?>

</tbody>
</table>