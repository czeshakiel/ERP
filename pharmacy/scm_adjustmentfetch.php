<?php
include "../main/class.php";
include "../main/header.php";
$dept = strtoupper($dept);
$search=$_GET['str'];
if($search==""){}else{
//$dept=$_GET['str2'];
echo"
<table align='center' width='100%' class='table'>
<tr>
<th bgcolor='#073A51'><font size='2'>Description</th>
<th bgcolor='#073A51'><font size='2'>SOH</th>
<th bgcolor='#073A51' style='text-align: center;' width='40%'><font size='2'>QTY</th>
</tr>
";
$i=0;
$sqlccv = "SELECT sum(s.quantity) as qtyd, s.description, s.code, s.generic, r.gtestcode, r.unit FROM stocktable s, receiving r where r.code=s.code and s.dept='$dept' and (r.description like '%$search%' or r.generic like '%$search%') group by r.code order by r.code limit 10";
$resultccv = $conn->query($sqlccv);
if(mysqli_num_rows($resultccv) > 0){
while($rowccv = $resultccv->fetch_assoc()) {
$qty = $rowccv['qtyd'];
$desc = $rowccv['description'];
$code = $rowccv['code'];
$generic = $rowccv['generic'];
$cost = $rowccv['unitcost'];
$gtestcode = $rowccv['gtestcode'];
$unit = $rowccv['unit'];
$i++;

$desc = str_replace("ams-", "", $desc);
$desc = str_replace("-med", "", $desc);
$desc = str_replace("-sup", "", $desc);

$desc2 = $desc."<br><font color='blue'>(".$generic.")</font>";

if($unit=="PHARMACY/MEDICINE"){$pic = "meds.png";}else{$pic="sup.png";}
$btn = "<button type='submit' class='btn btn-primary btn-sm' name='btnsave'><font><i class='icofont-check-circled'></i></button>"; $bgc="";
if($gtestcode!="0"){$btn = "<font color='red' size='5px'><i class='icofont-ban' title='DISABLED'><i></font>"; $bgc = "red";}

echo"
<tr>
<td bgcolor='$bgc' align='left'><table width='100%'><tr><td width='5%'><img src='../main/img/$pic' width='20' height='20' style='border-radius: 50%;'></td><td title='$code' style='font-size:11px;'>$desc2</td></tr></table></td>
<td bgcolor='$bgc' style='font-size: 13px;'>$qty</td>
<td bgcolor='$bgc'>
<form method='POST'>
<input type='hidden' value='$code' name='code'>
<input type='hidden' value='$desc' name='desc'>
<input type='hidden' value='$qty' name='oldqty'>
<table width='100%'><tr>
<td width='30%' class='text-center'><input type='text' name='qty' value='1' style='width: 100%; font-size:13px; padding: 5px; text-align: center;' class='form-control'></td>
<td>
<select id='listing' name='comment' class='form-control' style='width: 100%; font-size:13px; padding: 5px; text-align: center;'>";
$sql1 = "select code,comment from returncomment";
$result1 = $conn->query($sql1);
while($row1 = $result1->fetch_assoc()) {
$comment = $row1['comment'];
echo"<option value='$comment'>$comment</option>";
}
echo"
</select>
</td>
<td class='text-center'>$btn</td>
</tr></table>
</form>
</td>
</tr>
";
if($i>9){echo"<tr><td colspan='3'><font size='1' color='red'> ** Display is limit to 10 items to prevent loading on the system. If item is not on the list please search by full name of the item. ** </font></td></tr>";}

}
}else{echo"<tr><td colspan='4'>Data Not Found.....</td></tr>";}
echo"</table>";
}
?>
