
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
$sql = $conn->query("SELECT * FROM productout where caseno = '$caseno' and (productsubtype='ECG' or productsubtype='HEARTSTATION') and (status='PAID' or status='Approved') group by refno order by trantype desc, datearray desc");
while($row = $sql->fetch_assoc()) {
$col="";
$col1="black";
$blink="";
$status =$row['administration'];
$status1 =$row['status'];
$administration1 =$row['administration'];
$prod =$row['productsubtype'];
$terminalname=$row['terminalname'];
$terminalname2=$row['terminalname'];
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
<td style="text-align: center; font-size: 25px;">
<?php
if($terminalname2 = "Testdone" and strpos($productdesc, "ECHO")!==false){echo"<a href='../printresult/2decho_v1/$caseno/$refno/iuo' target='_blank'><button class='btn btn-outline-info btn-sm'><i class='icofont-printer'></i></button></a>";}
elseif($terminalname2 = "Testdone" and strpos($productdesc, "STRESS")!==false){echo"<a href='../printresult/stresstest/$caseno/$refno/iuo' target='_blank'><button class='btn btn-outline-info btn-sm'><i class='icofont-printer'></i></button></a>";}
elseif($terminalname2 = "Testdone"){echo"<a href='../heart/resultdeckingecg.php?caseno=$caseno&refno=$refno&productsubtype=$productsubtype' target='tabiframedecking'><button type='submit' class='btn btn-outline-primary btn-sm' data-bs-toggle='modal' data-bs-target='#decking'><i class='icofont-flask'></i></button></a>";}
?>
</td>
</tr>
<?php  } ?></tbody></table>


<!-------------------------------------------- RETURN MED/SUP ------------------------------------------->
<div class="modal fade" id="decking" tabindex="-1">
<div class="modal-dialog glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> SET READER AND FILMNO</h5>
<button type="button" class="btn-close" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">

<table width="100%" align="center"><tr><td style="text-align: left;">
<iframe id='tabiframe2' name='tabiframedecking' src='' width='100%' height='600px' style="border:none;"></iframe>
</td><tr></table>

</div>
</div>
</div>
</div>
<!---------------------------------------- END RETURN MED/SUP ------------------------------------------->
