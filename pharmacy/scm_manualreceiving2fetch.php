<?php
$search=$_GET['str'];
$dept=$_GET['str2'];
include "../main/class.php";
include "../main/header.php";
if($search==""){echo"";}else{
echo"
<table align='center' width='100%' class='table'>
<tr>
<td class='text-center'><font size='1'><b>DESCRIPTION</td>
<td class='text-center'><font size='1'></td>
</tr>
";
$i=0;
$sqlccv = "SELECT * from receiving where (description like '%$search%' or generic like '%$search%') and (unit like '%MEDICINE%' or unit like '%SUPPLIES%') order by itemname";
$resultccv = $conn->query($sqlccv);
if(mysqli_num_rows($resultccv) > 0){
while($row22j = $resultccv->fetch_assoc()) {
$code = $row22j['code'];
$desc = $row22j['description'];
$generic = $row22j['generic'];
$itemname = $row22j['itemname'];
$pd = $itemname." (".$generic.")";
$i++;

/*
$sql2 = "SELECT sum(quantity) as qtyy FROM stocktable where code='$code' and dept='$dept'";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$qty=$row2['qtyy'];
if($qty==""){$qty=0;}
}

$sql2222 = "SELECT * from stocktable where code='$code' and (trantype not like '%return%' and trantype not like '%dispensed%') order by datearray";
$result2222 = $conn->query($sql2222);
while($row2222 = $result2222->fetch_assoc()) { 
$unitp=$row2222['unitcost'];
}
*/

$desc = str_replace("ams-", "", $desc);
$desc = str_replace("-med", "", $desc);
$desc = str_replace("-sup", "", $desc);
if($generic==""){$geberic = "N/A";}
echo "
<tr>
<td bgcolor='$bgc' align='left' style='font-size: 11px;'>$desc <br><font color='blue'>[$generic]</font></td>
"; ?>
<td style="text-align: center;"><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal22cc" style="border: none; padding: 4px 10px; font-size: 10px; margin: 2px 1px;" onclick="loaddata('<?php echo $code ?>', '<?php echo $itemname ?>', '<?php echo $qty ?>', '<?php echo $unitp ?>'); getsoh('<?php echo $code ?>');"><i class="icofont-check-circled"></i></button></td>
<?php echo"
</tr>
";
}
}else{echo"<tr><td colspan='4'>Data Not Found.....</td></tr>";}
echo"</table>";
}
?>
