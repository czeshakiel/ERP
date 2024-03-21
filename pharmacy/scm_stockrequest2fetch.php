<?php
$search=$_GET['str'];
$deptx=$_GET['str2'];
include "../main/class.php";
include "../main/header.php";
if($search==""){echo"";}else{
echo"
<table align='center' width='100%' class='table'>
<tr>
<td class='text-center' width='60%'><font size='1'><b>DESCRIPTION</td>
<td class='text-center' width='5%'><font size='1'>SOH</td>
<td class='text-center'><font size='1'></td>
</tr>
";
$i=0;
if($deptx=="CPU" or $deptx=="CPU-RDU" or $deptx=="CSR"){$qry="and s.datearray>='2021-07-01'";}else{$qry="";}
$sqlccv = "SELECT r.code, r.description, r.generic, r.itemname, sum(s.quantity) as qtyy  FROM receiving r JOIN stocktable s ON r.code = s.code WHERE s.dept = '$deptx'
 AND (r.description LIKE '%$search%' OR r.generic LIKE '%$search%') $qry GROUP BY r.code ORDER BY r.itemname";
$resultccv = $conn->query($sqlccv);
if(mysqli_num_rows($resultccv) > 0){
while($row22j = $resultccv->fetch_assoc()) {
$code = $row22j['code'];
$desc = $row22j['description'];
$generic = $row22j['generic'];
$itemname = $row22j['itemname'];
$pd = $itemname." (".$generic.")";
$qty=$row22j['qtyy'];
if($qty==""){$qty=0;}
$i++;



$desc = str_replace("ams-", "", $desc);
$desc = str_replace("-med", "", $desc);
$desc = str_replace("-sup", "", $desc);
if($generic==""){$geberic = "N/A";}
echo "
<tr>
<td bgcolor='$bgc' align='left' style='font-size: 11px;'>$desc <br><font color='blue'>[$generic]</font></td>
<td bgcolor='$bgc' align='left' style='font-size: 11px;'>$qty</td>
<td bgcolor='$bgc' align='left' style='font-size: 11px;'>
<form method='POST'>
<table width='100%'><tr>
<td><input tyoe='text' name='qty' class='form-control'></td>
<td><button type='submit' name='btnsave' class='btn btn-danger btn-sm'><i class='icofont-checked'></i></button></td>
</tr></table>
<input type='hidden' name='type' value='$transactiontype'>
<input type='hidden' name='rrno' id='rrno' value='$rrno'>
<input type='hidden' name='soh' id='rrno' value='$qty'>
<input type='hidden' name='code' id='rrno' value='$code'>
</form>
</td>
</tr>
";
}
}else{echo"<tr><td colspan='4'>Data Not Found.....</td></tr>";}
echo"</table>";
}
?>
