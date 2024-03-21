<?php
$search=$_GET['str'];
$dept=$_GET['str2'];
if($search==""){echo"";}else{
echo"
<table class='table' align='center' border='1' width='100%'>
<tr>
<th bgcolor='#073A51'>CODE/DESCRIPTION</th>
<th bgcolor='#073A51' width='10%'>SOH</th>
<th bgcolor='#073A51' style='text-align: center;' width='20%'>QTY</th>
</tr>
";
include "../main/class.php";
$sqlccv = "SELECT sum(s.quantity) as qtyd, r.description, s.code, r.generic, r.lotno FROM stocktable s, receiving r where s.code=r.code and s.dept='$dept' and (r.description like '%$search%' or r.generic like '%$search%') group by s.code order by r.description limit 20";
$resultccv = $conn->query($sqlccv);
if(mysqli_num_rows($resultccv) > 0){
while($rowccv = $resultccv->fetch_assoc()) {
$qty = $rowccv['qtyd'];
$desc = $rowccv['description'];
$code = $rowccv['code'];
$generic = $rowccv['generic'];
$cost = $rowccv['unitcost'];
$lotno = $rowccv['lotno'];

if($lotno=="M"){$lotno="<span class='badge bg-primary'><i class='icofont-chart-histogram'></i> Markup</span>";}
else{$lotno="<span class='badge bg-danger'><i class='icofont-price'></i> Special</span>";}

$desc = str_replace("ams-", "", $desc);
$desc = str_replace("-med", "", $desc);
$desc = str_replace("-sup", "", $desc);


$sql1 = "SELECT * FROM `receiving` WHERE `code`='$code'";
$result1 = $conn->query($sql1);
while($row1 = $result1->fetch_assoc()){
$gtestcode = $row1['gtestcode'];
$unit = $row1['unit'];
}

$col="black"; $col2="blue";
if($qty<=0){$qty=0;}
if($qty>0){$btn = "<button type='submit' class='btn btn-primary btn-sm' name='btnsubmit'><font><i class='icofont-paper-plane'></i> Submit</button>"; $bgc="";}
else{$btn ="<span class='badge bg-danger'><i class='icofont-ban'></i> ZERO QTY!</span>"; $bgc = "lightyellow";}
if($gtestcode!="0"){$btn = "<span class='badge bg-danger'><i class='icofont-ban'></i> DISABLED</span>";}


if($generic == ""){$generic = "";}else{$generic = "<font size='1' color='$col2'>[$generic]";}
if($unit=="PHARMACY/MEDICINE"){$icon="<i class='icofont-medicine'></i>";}else{$icon="<i class='icofont-paper'></i>";}
echo"

<tr>
<td style='font-size: 11px;'><table><tr><td style='font-size: 20px;'>$icon</td><td>$code<br><b>$desc</b> $generic $lotno</small></td></tr></table></td>
<td style='font-size: 17px;'><span class='badge bg-secondary'>$qty</span></td>
<td bgcolor='$bgc'>
<form method='POST'>
<input type='hidden' value='$code' name='code'>
<input type='hidden' value='$desc' name='desc'>
<input type='hidden' value='$qty' name='qty2'>
<table width='100%'><tr><td width='50%' class='text-center'><input type='text' name='qty' value='1' style='text-align: center; height:30px; font-size:12pt; padding: 0px; width: 100%;'></td><td class='text-center'>$btn</td></tr></table>
</form>
</td>
</tr>
";


}
}else{echo"<tr><td colspan='4'>Data Not Found.....</td></tr>";}
echo"</table>";
}
?>