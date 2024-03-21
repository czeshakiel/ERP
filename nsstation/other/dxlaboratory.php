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
error_reporting(1);
$i=0;
$sql = $conn->query("SELECT * FROM productout where caseno= '$caseno' and productsubtype = 'LABORATORY' and (status='PAID' or status='Approved') order by datearray desc");
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
$trantype=$row['trantype'];
$i++;


if($terminalname2 == "pending") {$terminalname="<span class='badge bg-primary'>$terminalname2</span>";}
elseif($terminalname2 == "Testdone") {$terminalname="<span class='badge bg-danger'>$terminalname2</span>";}
else{$terminalname="<span class='badge bg-success'>$terminalname2</span>";}

$color ="";
$linkage="$productdesc";


$resultq = $conn->query("SELECT remarks FROM labtest WHERE refno='$refno'");
while($rowq = $resultq->fetch_assoc()) {$rm=$rowq['remarks'];}

$resultq1 = $conn->query("SELECT * FROM receiving WHERE code='$productcode'");
while($rowq1 = $resultq1->fetch_assoc()) {$lotno=$rowq1['lotno'];}



$hmm="";
if($rm!=""){$hmm = "<small><font color='blue'>$rm</font></small>";}
$linked = "../nsstation/other/dxlaboratory_redirect.php?caseno=$caseno&refno=$refno";

?>

<tr>
<td align="center" style="font-size: 12px;"><?php echo $i ?>.</td>
<td style="font-size: 12px;"><font color='gray'>Desc:</font> <b><?php echo $productdesc." ".$hmm; ?></b><br><font color='gray'>Test:</font> <?php echo $lotno ?></td>
<td style="font-size: 12px;"><font color='gray'>Status:</font> <?php echo $row['trantype'].'/ '.$status1.'/ '.$terminalname ?><br><font color='gray'>Date:</font> <?php echo $datearray ?></td>
<td style="font-size: 12px;"><font color='gray'>Refno:</font> <b><?php echo $refno ?></b><br><font color='gray'>User:</font> <?php echo $loginuser ?></td>
<td style="text-align: center; font-size: 25px;">
<?php 
if($terminalname2=="Testdone"){echo"<a href='$linked&from=$dept' target='_bank'><button type='submit' class='btn btn-outline-primary btn-sm'><i class='icofont-printer'></i></button></a>";}
else{
  if($productdesc=="HGT" or $productdesc=="RBS"){
//echo"<a href='http://$ip/cgi-bin/bloodchemnewns.cgi?refno=$refno&productdesc=$productdesc&trantype=$trantype&nursename=$user&nursestation=&caseno=$caseno&setgrp=2&lyte=$lotno' target='_bank'><button type='submit' class='btn btn-outline-warning btn-sm'><i class='icofont-flask'></i></button></a>";

    if(($status1=="PAID")||($status1=="Approved")){
      $agstart="<form method='post' target='_blank'><input type='hidden' name='stest' /><input type='hidden' name='srefno' value='$refno' /><input type='hidden' name='ltype' value='$lotno' />";
      $agend="</form>";
      
      echo "$agstart<button type='submit' class='btn btn-outline-danger btn-sm' title='Input Result/s'><i class='icofont-flask'></i></button>$agend";
    }
  }
}
?>
</td>
</tr>
<?php  } ?></tbody></table>
<!------------------------------------------ END OF MEDICINE/SUPPLIES ----------------------------------------->
