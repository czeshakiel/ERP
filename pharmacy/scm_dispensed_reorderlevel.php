 <?php
$sql = $conn->query("select sum(s.quantity) as soh, r.code, r.description, r.generic from stocktable s, receiving r where s.code=r.code and s.dept='$dept'
 and r.code='$mycode' group by r.code HAVING soh>0");
while($row = $sql->fetch_assoc()){
$code =$row['code'];
$description =$row['description'];
$generic =$row['generic'];
$soh =$row['soh'];
$i++;

$currentdate = date("Y-m-d");
$sql1 = $conn->query("select * from stocktable where dept='$dept' and code='$code' and  (trantype='charge' or trantype='cash' or trantype='STOCK TRANSFER') 
and quantity>0 order by datearray DESC limit 1");
while($res1 = $sql1->fetch_assoc()){$datereceived = $res1['datearray'];}

$sql2 = $conn->query("select sum(quantity) as qty from stocktable where dept='$dept' and code='$code' and  datearray between '$datereceived' and '$currentdate' 
and  quantity<0");
while($res2 = $sql2->fetch_assoc()){$qtydispensed = $res2['qty'];}
$qtydispensed = str_replace("-", "", $qtydispensed);

$sql3 = $conn->query("select sum(quantity) as qty from  stocktable where dept='$dept' and code='$code' and  datearray between '$datereceived' and '$currentdate'
 and  trantype='return'");
while($res3 = $sql3->fetch_assoc()){$qtyreturn = $res3['qty'];}

$qtyused = $qtydispensed - $qtyreturn;
  
if($qtyused<=0){$qtyused=0;}

$date1 = new DateTime($datereceived);
$date2 = new DateTime($currentdate);
$interval = $date1->diff($date2);
$buffer = $interval->format('%a');

$averageused = $qtyused/$buffer;
$averageused = number_format($averageused, 2);

$leadtime = 2;
$reorderlevel = $averageused*$leadtime;
$reqqty = $reorderlevel - $soh;
if($reqqty<0){$reqqty = 0;}

if($reqqty>0){
$rf= "RN".date("YmdHis");
$conn->query("delete from purchaseorder where code='$code' and reqdept='$dept' and status='pending' and reqno like '%AUTOREC%'");
$conn->query("INSERT INTO `purchaseorder`(`rrno`, `transdate`, `supplier`, `suppliercode`, `terms`, `trantype`, `code`, `description`, `unitcost`, `generic`, `prodqty`,
 `dept`, `status`, `prodtype1`, `po`, `user`, `approvingofficer`, `reqdept`, `reqno`, `reqdate`, `requser`) VALUES ('$rf', CURDATE(), '', '', '', '', '', '',)");
}
}

echo"<script>alert('execute reordering level');</script>";
?>