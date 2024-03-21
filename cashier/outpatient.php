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
$sql = "SELECT a.patientidno, po.datearray, po.caseno, po.productdesc, po.refno, po.productsubtype, SUM(po.gross) AS amount,
SUM(po.adjustment) AS discount, po.excess, a.room, a.ward, a.status, po.loginuser, a.hmo, po.batchno, po.invno
FROM productout po INNER JOIN admission a ON po.caseno = a.caseno WHERE 
po.caseno NOT LIKE '%%_cancelled' AND po.trantype = 'cash' AND po.status = 'requested' AND a.ward = 'out'
AND po.productsubtype NOT LIKE '%RDU-SUPPLIES%' AND po.productsubtype NOT LIKE '%RDU SUPPLIES%' AND po.productsubtype NOT LIKE '%RDU-MEDICINE%'
AND po.datearray BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() GROUP BY a.caseno, po.batchno
HAVING amount > 0 ORDER BY po.datearray DESC, po.invno DESC";
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

</tbody>
</table>