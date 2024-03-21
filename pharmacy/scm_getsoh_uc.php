<?php
$code=$_GET['str'];
$reqdept=$_GET['deptreq'];
include "../main/class.php";

if($reqdept=="CPU" or $reqdept=="CSR"){$qry="and datearray>='2021-07-01'";}else{$qry="";}

$qty="0";
$result2 = $conn->query("SELECT sum(quantity) as qtyy FROM stocktable where code='$code' and dept='$reqdept' $qry");
while($row2 = $result2->fetch_assoc()) {$qty=$row2['qtyy'];}

$result2222 = $conn->query("SELECT * from stocktable where code='$code' and (trantype='cash' or trantype='charge') order by datearray DESC limit 1");
while($row2222 = $result2222->fetch_assoc()){$unitp=$row2222['unitcost'];}

if($qty<=0){$qty="0";}
if($unitp<=0){$unitp="0";}

$val2 = $qty."_".$unitp;
echo"$val2";
?>