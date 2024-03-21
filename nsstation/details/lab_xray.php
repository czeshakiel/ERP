<?php
if(isset($_GET['convertcash'])){
$refno=$_GET['refno'];
$caseno=$_GET['caseno'];

$conn->query("update productout set trantype='cash' and status='requested' where refno='$refno' and caseno='$caseno'");
echo"<script>alert('done!'); window.location='?detail&caseno=$caseno';</script>";
}
?>

<!---------------------------------------------- MEDICINE/SUPPLIES ----------------------------------------->
<table class="datatable table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th class="text-center"  bgcolor="<?php echo $primarycolor2 ?>"><font size="2">#</th>
<th class="text-center"  bgcolor="<?php echo $primarycolor2 ?>" width="5%"><font size="2"><i class="icofont-eye"></i></th>
<th class="text-center"  bgcolor="<?php echo $primarycolor2 ?>" width="60%"><font size="2">DESCRIPTION</th>
<th class="text-center"  bgcolor="<?php echo $primarycolor2 ?>" width="25%"><font size="2">STATUS</th>
<th class="text-center"  bgcolor="<?php echo $primarycolor2 ?>"><font size="2%">QTY</th>
<th class="text-center"  bgcolor="<?php echo $primarycolor2 ?>"><font size="2%">USER</th>
</tr>
</thead>
<tbody>

<?php
$i=0;
$sql = $conn->query("SELECT * FROM productout where caseno= '$caseno'
and productsubtype not like '%MEDICINE%' and productsubtype not like '%SUPPLIES%'
and productsubtype not like '%PROFESSIONAL FEE%' and productsubtype not like '%ROOM ACCOMODATION%' and productsubtype not like
'%NURSING_CHARGES%' and productsubtype not like '%NURSING SERVICE FEE%' and productsubtype not like '%OR/DR/ER FEE%' and productsubtype
not like '%MISCELLANEOUS%' and productsubtype not LIKE '%MEDICAL EQUIPMENT%' and productsubtype not like '%MEDICAL SURGICAL SUPPLIES%'
and productsubtype not like '%OTHER FEES%' and productsubtype not like '%CONSULTATION FEE%' and productsubtype NOT LIKE '%AMBULANCE%'
and productsubtype NOT LIKE '%NURSING%' and productsubtype NOT LIKE '%NURSE%' and productsubtype NOT LIKE '%OXYGEN%' and productsubtype
NOT LIKE '%ADMISSION FEE%' and productsubtype NOT LIKE '%ER FEE%' AND productsubtype NOT LIKE '%CSR KIT%' and productsubtype NOT LIKE
'%OR/DR SUPPLIES%' AND productsubtype NOT LIKE 'OR-CHARGES' AND productsubtype NOT LIKE 'LINENS' AND productsubtype NOT LIKE
'GENERAL SUPPLIES' AND productsubtype NOT LIKE '%PULMONARY%' AND productsubtype NOT LIKE '%RT REFERRAL%'  AND productsubtype
NOT LIKE '%OPERATING ROOM FEE%' AND (status = 'Approved' or status= 'PAID' or status= 'BALANCE' or status= 'requested' or
status= 'REFUND') and quantity > 0  group by refno order by productsubtype, datearray desc");
while($row = $sql->fetch_assoc()) {
$col="";
$col1="black";
$blink="";
$status =$row['administration'];
$status1 =$row['status'];
$administration1 =$row['administration'];
$prod =$row['productsubtype'];
$terminalname=$row['terminalname'];
$productdesc=$row['productdesc'];
$approvalno=$row['approvalno'];
$producttype=$row['producttype'];
$qty =$row['quantity'];
$invno =$row['invno'];
$approvalno = $row['approvalno'];
$batchno=$row['batchno'];
$productcode=$row['productcode'];
$refno=$row['refno'];
$datearray= date("F d, Y", strtotime($row['datearray']));
$timedispensed=$row['datearray'];
$loginuser=$row['loginuser'];
$i++;

$productdesc=str_replace("mak-","",$productdesc);
$productdesc=str_replace("-med","",$productdesc);
$productdesc=str_replace("-sup","",$productdesc);
$productdesc=str_replace("ams-","",$productdesc);

if($terminalname == "pending") {$terminalname="<span class='badge bg-primary'>$terminalname</span>";}
elseif($terminalname == "Testdone") {$terminalname="<span class='badge bg-danger'>$terminalname</span>";}
else{$terminalname="<span class='badge bg-success'>$terminalname</span>";}

$color ="";
$linkage="$productdesc";


$sqlq = "SELECT remarks FROM labtest WHERE refno='$refno'";
$resultq = $conn->query($sqlq);
while($rowq = $resultq->fetch_assoc()) {$rm=$rowq['remarks'];}

$hmm="";
if($rm!=""){$hmm = "<small><font color='blue'>$rm</font></small>";}
?>

<tr>
<td align="center" style="font-size: 12px;"><?php echo $i ?>.</td>
<td align="center" style="font-size: 13px;">
<?php
if($dept=="HMO"){echo"<a href='../pharmacy/chargeslipreprint.php?caseno=$caseno&pname=$patientname&trantype=".$row['trantype']."&invno=$invno&HMO' title='Print Invoice' target='_blank'><i class='icofont-print'></i></a>";} 

if(($productdesc=="RAPID TEST" || $productdesc=="RAPID TEST - PATIENT" || $productdesc=="RAPID TEST - WATCHER/OPD" ) && $row['trantype']=="charge"){
echo"<a href='?detail&caseno=$caseno&refno=$refno&covertcash'><button type='button' class='btn btn-danger btn-sm' title='conver to cash'><i class='icofont-undo'></i></button></a>";
}
?>


</td>
<td style="font-size: 12px;"><font color='#5D6BD9'>Desc:</font> <b><?php echo $productdesc." ".$hmm; ?></b><br><font color='#5D6BD9'>Accttitle:</font> <?php echo $prod ?></td>
<td style="font-size: 12px;"><font color='#5D6BD9'>Status:</font> <?php echo $row['trantype'].'/ '.$status1.'/ '.$terminalname ?><br><font color='#5D6BD9'>Date:</font> <?php echo $datearray ?></td>
<td class="text-center" style="font-size: 13px;"><?php echo $qty ?></td>
<td style="text-align: center; font-size: 25px;"><i class="icofont-waiter-alt" data-bs-toggle="tooltip" title="<?php echo $loginuser ?>"></i></td>
</tr>
<?php  } ?></tbody></table>
<!------------------------------------------ END OF MEDICINE/SUPPLIES ----------------------------------------->