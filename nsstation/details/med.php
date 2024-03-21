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
$sql = $conn->query("SELECT * FROM productout where caseno= '$caseno' and (productsubtype ='PHARMACY/MEDICINE' or productsubtype ='RDU MEDICINE' or 
productsubtype ='RDU-MEDICINE') and (status = 'Approved' or status= 'PAID' or status= 'BALANCE' or status= 'requested' or status= 'REFUND')  
and quantity > 0  group by refno order by trantype desc, administration desc");
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
$datearray= date("F d, Y", strtotime($row['datearray']))." ".date("h:i:s a", strtotime($row['invno']));
$timedispensed=$row['datearray'];
$i++;

$productdesc=str_replace("mak-","",$productdesc);
$productdesc=str_replace("-med","",$productdesc);
$productdesc=str_replace("-sup","",$productdesc);
$productdesc=str_replace("ams-","",$productdesc);

$color ="";
if($status == "pending") {$status="<span class='badge bg-primary'>$status</span>";}
if($status == "dispensed") {$status="<span class='badge bg-secondary'>$status</span>";}
if($status == "administered") {$status="<span class='badge bg-danger'>$status</span>";}
$loginuser = $row['loginuser'];

$hmm="";
if(strpos($batchno, "HM-")!== false){$hmm = "<small><font color='blue'>[homemeds]</font></small>";}
$loginuser = str_replace("<br>","\n",$loginuser);

?>

<tr>
<td align="center" style="font-size: 12px;"><?php echo $i ?>.</td>
<td align="center" style="font-size: 13px;">

<?php if($dept=="HMO"){echo"<a href='../pharmacy/chargeslipreprint.php?caseno=$caseno&pname=$patientname&trantype=".$row['trantype']."&invno=$invno&HMO' title='Print Invoice' target='_blank'><i class='icofont-print'></i></a>";} ?>
</td>
<td style="font-size: 12px;"><font color='#5D6BD9'>Desc:</font> <b><?php echo $productdesc." ".$hmm; ?></b><br><font color='#5D6BD9'>Accttitle:</font> <?php echo $prod ?></td>
<td style="font-size: 12px;"><font color='#5D6BD9'>Status:</font> <?php echo $row['trantype'].'/ '.$status1.'/ '.$status ?><br><font color='#5D6BD9'>Date:</font> <?php echo $datearray ?></td>
<td class="text-center" style="font-size: 13px;"><?php echo $qty ?></td>
<td style="text-align: center; font-size: 25px;"><i class="icofont-waiter-alt" data-bs-toggle="tooltip" title="<?php echo $loginuser ?>"></i></td>
</tr>
<?php  } ?></tbody></table>
<!------------------------------------------ END OF MEDICINE/SUPPLIES ----------------------------------------->
