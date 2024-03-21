<!---------------------------------------------- MEDICINE/SUPPLIES ----------------------------------------->
<table class="datatable table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th class="text-center"  bgcolor="<?php echo $primarycolor2 ?>"><font size="2">#</th>
<th class="text-center"  bgcolor="<?php echo $primarycolor2 ?>" width="10%"><font size="2">ACTIONS</th>
<th class="text-center"  bgcolor="<?php echo $primarycolor2 ?>" width="50%"><font size="2">DESCRIPTION</th>
<th class="text-center"  bgcolor="<?php echo $primarycolor2 ?>" width="20%"><font size="2">STATUS</th>
<th class="text-center"  bgcolor="<?php echo $primarycolor2 ?>"><font size="2">QTY</th>
<th class="text-center"  bgcolor="<?php echo $primarycolor2 ?>"><font size="2">USER</th>
</tr>
</thead>
<tbody>

<?php
$i=0;
$casenonew = $caseno."_cancelled";
$sql = $conn->query("SELECT * from productout where caseno = '$casenonew'");
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
$loginuser = $row['loginuser'];
$i++;

$productdesc=str_replace("mak-","",$productdesc);
$productdesc=str_replace("-med","",$productdesc);
$productdesc=str_replace("-sup","",$productdesc);
$productdesc=str_replace("ams-","",$productdesc);

$color ="";
$linkage="$productdesc";
$loginuser = str_replace("<br>","\n",$loginuser);

$hmm="";
if(strpos($batchno, "HM-")!== false){$hmm = "<small><font color='blue'>[homemeds]</small>";}
?>

<tr>
<td align="center" style="font-size: 10px;"><?php echo $i ?>.</td>
<td align="center" style="font-size: 20px;"><i class="icofont-checked"></i></td>
<td style="font-size: 10px;">Desc: <b><?php echo $productdesc." ".$hmm; ?></b><br>Accttitle: <b><?php echo $prod ?></b></td>
<td style="font-size: 10px;">Status: <b>Cancelled Request</b><br>Date: <b><?php echo $datearray ?></b></td>
<td class="text-center" style="font-size: 13px;"><?php echo $qty ?></td>
<td style="text-align: center; font-size: 25px;"><i class="icofont-waiter-alt" data-bs-toggle="tooltip" title="<?php echo $loginuser ?>"></i></td>
</tr>
<?php  } ?></tbody></table>
<!------------------------------------------ END OF MEDICINE/SUPPLIES ----------------------------------------->
