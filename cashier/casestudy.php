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
$result = $conn->query("SELECT a.caseno, po.datearray, po.productdesc, po.refno, po.productsubtype, po.gross, a.room, a.ward, po.status, 
po.loginuser, po.hmo, po.invno, po.batchno, po.adjustment, a.patientidno FROM productout po JOIN admission a ON po.caseno = a.caseno
WHERE po.productcode = '211115113644p-50' AND po.trantype = 'cash' AND po.status = 'requested' AND DATE(po.datearray) > (NOW() - INTERVAL 5 DAY)
ORDER BY po.refno DESC;");
while($row = $result->fetch_assoc()){
$caseno=$row['caseno'];
$datearray=$row['datearray'];
$productdesc=$row['productdesc'];
$refno=$row['refno'];
$productsubtype=$row['productsubtype'];
$amount=$row['gross'];
$room=$row['room'];
$ward=$row['ward'];
$status=$row['status'];
$loginuser=$row['loginuser'];
$hmo=$row['hmo'];
$dated=$row['datearray'];
$invno=$row['invno'];
$dtreq = date("F d, Y", strtotime($dated))."<br>".date("h:i:s a", strtotime($invno));
$batchno=$row['batchno'];
$discount=$row['adjustment'];
$patientidno=$row['patientidno'];
$i++;
   
$result2 = $conn->query("SELECT * from patientprofile where patientidno='$patientidno'");
while($row2 = $result2->fetch_assoc()){
$patientname=$row2['lastname'].", ".$row2['firstname']." ".$row2['middlename'];
$sex=$row2['sex'];
$senior=$row2['senior'];
}
   
if($sex=="M"){if($senior=="Y"){$ge="boy";}else{$ge="boy";}}
else{if($senior=="Y"){$ge="girl";}else{$ge="girl";}}
   
//list($amc, $desc, $type) = preg_split('/[-:-:-]/', $productdesc);
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
?>

<div class="container">
<div class="btn-group btn-group-justified">
<a href="?outpatientdetail&caseno=<?php echo $caseno ?>&batchno=<?php echo $batchno ?>&productsubtype=<?php echo $productsubtype.$datax ?>" class="btn btn-primary btn-sm" title="View Detail"><i class="icofont-eye-alt"></i></a>
<a href="" data-toggle="modal" data-target="#exampleModal22cc" onclick="myacc('<?php echo $refno ?>', '<?php echo $productsubtype ?>', '<?php echo $excess ?>', '<?php echo $patientname ?>', '<?php echo $caseno ?>');" style='pointer-events: none;' class='btn btn-default border border-primary btn-sm'><i class="icofont-ui-edit"></i></a>
</div>
</div>
   
</td>
</tr>
<?php } ?>


</tbody>
</table>