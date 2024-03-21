<table class="datatable table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th class="text-center"  bgcolor="#FF0000"><font size="2">#</th>
<th class="text-center"  bgcolor="#FF0000" width="10%"><font size="2">ACTIONS</th>
<th class="text-center"  bgcolor="#FF0000" width="50%"><font size="2">DESCRIPTION</th>
<th class="text-center"  bgcolor="#FF0000" width="20%"><font size="2">STATUS</th>
<th class="text-center"  bgcolor="#FF0000"><font size="2">QTY</th>
<th class="text-center"  bgcolor="#FF0000"><font size="2">USER</th>
</tr>
</thead>
<tbody>

<?php
$i=0;
$sql = "SELECT * from `productreturnCN` where ($allcs) and `trantype`='return' order by `dateofret` desc";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$si="2";
$col="";
$col1="black";
$blink="";
$codess =$row['productcode'];
$quantityss =$row['quantity1'];
$datearray222 = $row['dateofret'];
$unamess =$row['username'];
$unamess = str_replace('<br>', '\n', $unamess);
$postedby =$row['postedby'];
$mm="";

$sqlb = "SELECT * FROM `receiving` WHERE `code`='$codess'";
$resultb = $conn->query($sqlb);
if(mysqli_num_rows($resultb)>0){
  $rowb = $resultb->fetch_assoc();
  $descss =$rowb['description'];
  $prodtype =$rowb['unit'];
  if(stripos($prodtype, "/") !== FALSE){
    list($p, $mm) = explode("/", $prodtype);
  }
  else{
    $p="";
    $mm="";
  }
}
else{
  $p="";
  $mm="";
}

$descss=str_replace("mak-","",$descss);
$descss=str_replace("-med","",$descss);
$descss=str_replace("-sup","",$descss);
$descss=str_replace("ams-","",$descss);
$i++;
?>
<tr>
<td align="center" style="font-size: 10px;"><?php echo $i ?>.</td>
<td align="center" style="font-size: 20px;"><i class="icofont-checked"></i></td>
<td style="font-size: 10px;">Desc: <b><?php echo $descss; ?></b><br>Accttitle: <b><?php echo $prodtype ?></b></td>
<td style="font-size: 10px;">Status: <b>Damage Item/s</b><br>Date: <b><?php echo $datearray222 ?></b></td>
<td class="text-center" style="font-size: 13px;"><?php echo $quantityss ?></td>
<td style="text-align: center; font-size: 25px;"><i class="icofont-waiter-alt" data-bs-toggle="tooltip" title="<?php echo $unamess ?>"></i></td>
</tr>
<?php  } ?></tbody></table>
