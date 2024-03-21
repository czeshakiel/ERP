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
$sql = $conn->query("SELECT * FROM productout where caseno= '$caseno' and quantity > 0 
 and producttype not like '%READERS FEE%'  and administration not like '%pending%' 
 and (productsubtype = 'ROOM ACCOMODATION' or productsubtype = 'PROFESSIONAL FEE' or productsubtype = 'NURSING CHARGES' or
  productsubtype = 'NURSING SERVICE FEE'or productsubtype = 'OR/DR/ER FEE' or productsubtype = 'MISCELLANEOUS'  or productsubtype = 'OTHER FEES'
   or productsubtype = 'CONSULTATION FEE' or productsubtype='ADMISSION FEE' or productsubtype='AMBULANCE INCOME' or productsubtype='ER FEE'
    or productsubtype='NURSE ON CALL' or productsubtype LIKE '%OXYGEN%' or productsubtype LIKE '%MEDICAL EQUIPMENT%' or productsubtype LIKE 'OR-CHARGES' or
     productsubtype LIKE 'LINENS' or productsubtype LIKE 'GENERAL SUPPLIES' or productsubtype LIKE '%PULMONARY%' OR productsubtype LIKE '%RT REFERRAL%' OR
      productsubtype LIKE '%OPERATING ROOM FEE%') and (status = 'Approved' or status= 'PAID' or status= 'BALANCE' or status= 'requested' or status= 'REFUND')
         group by refno order by datearray desc");
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
$i++;

$productdesc=str_replace("mak-","",$productdesc);
$productdesc=str_replace("-med","",$productdesc);
$productdesc=str_replace("-sup","",$productdesc);
$productdesc=str_replace("ams-","",$productdesc);
$color ="";
$loginuser = $row['loginuser'];

$linkage="$productdesc";

$hmm="";
if($prod=="PROFESSIONAL FEE"){$hmm = "<small><font color='blue'>$producttype</font></small>";}
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
