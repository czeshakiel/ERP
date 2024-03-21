<!---------------------------------------------- MEDICINE/SUPPLIES ----------------------------------------->
<table class="table table-hover align-middle mb-0">
<thead>
<tr>
<th class="text-center"  bgcolor="<?php echo $primarycolor2 ?>"><font size="2">#</th>
<th class="text-center"  bgcolor="<?php echo $primarycolor2 ?>" width="40%"><font size="2">DESCRIPTION</th>
<th class="text-center"  bgcolor="<?php echo $primarycolor2 ?>" width="25%"><font size="2">STATUS</th>
<th class="text-center"  bgcolor="<?php echo $primarycolor2 ?>"><font size="2%">Refno/ User</th>
<th class="text-center"  bgcolor="<?php echo $primarycolor2 ?>"><font size="2%"></th>
</tr>
</thead>
<tbody>

<?php
$i=0;
$sql = $conn->query("SELECT * FROM productout where caseno= '$caseno' and (productsubtype='XRAY' OR productsubtype='ULTRASOUND' OR productsubtype='CT SCAN' OR productsubtype='MAMMOGRAPHY') and terminalname='Testdone'  group by refno order by trantype desc, datearray desc");
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


$resultq = $conn->query("SELECT remarks FROM labtest WHERE refno='$refno'");
while($rowq = $resultq->fetch_assoc()) {$rm=$rowq['remarks'];}

$hmm="";
if($rm!=""){$hmm = "<small><font color='blue'>$rm</font></small>";}
?>

<tr>
<td align="center" style="font-size: 12px;"><?php echo $i ?>.</td>
<td style="font-size: 12px;"><font color='gray'>Desc:</font> <b><?php echo $productdesc." ".$hm; ?></b><br><font color='gray'>Test:</font> <?php echo $prod ?></td>
<td style="font-size: 12px;"><font color='gray'>Status:</font> <?php echo $row['trantype'].'/ '.$status1.'/ '.$terminalname ?><br><font color='gray'>Date:</font> <?php echo $datearray ?></td>
<td style="font-size: 12px;"><font color='gray'>Refno:</font> <b><?php echo $refno ?></b><br><font color='gray'>User:</font> <?php echo $loginuser ?></td>
<td style="text-align: center; font-size: 25px;"><a href="http://<?php echo $ip ?>/ERP/printresult/imaging-view/<?php echo $caseno ?>/<?php echo $refno ?>" target="_bank"><button type="submit" class="btn btn-outline-primary btn-sm"><i class="icofont-printer"></i></button></a></td>
</tr>
<?php  } ?></tbody></table>
<!------------------------------------------ END OF MEDICINE/SUPPLIES ----------------------------------------->
