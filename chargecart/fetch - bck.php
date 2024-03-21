
<?php
include "../main/class.php";
include "../main/header.php";

$search=$_GET['str'];
$caseno=$_GET['str2'];
$batchno=$_GET['str3'];
$dept="PHARMACY";

if(strpos($caseno, "R-")!==false or strpos($caseno, "R-")!==false or strpos($caseno, "R-")!==false){

}


if($search==""){echo"";}else{
echo"
<table width='95%' class='table'>
<tr>
<td bgcolor='#073A51' width='45%' style='font-size: 11px;'><b>DESCRIPTION</td>
<td bgcolor='#073A51' width='5%' style='font-size: 11px;'><b>SOH</td>
<td bgcolor='#073A51' width='15%' style='font-size: 11px;'><b>ROUTE</td>
<td bgcolor='#073A51' width='15%' style='font-size: 11px;'><b>FREQUENCY</td>
<td bgcolor='#073A51' width='10%' style='font-size: 11px;'><b>QTY</td>
<td bgcolor='#073A51' width='10%' style='font-size: 11px;'><b></td>
</tr>
";

$sqlx5 = "SELECT creditlimit FROM  patientscredit where caseno ='$caseno'";
$resultx5 = $conn->query($sqlx5);
while($rowx5 = $resultx5->fetch_assoc()){
$creditlimit=$rowx5['creditlimit'];
}

$sqlx4 = "SELECT * FROM productout WHERE caseno='$caseno' AND quantity > 0 AND trantype='charge' AND productsubtype NOT LIKE '%OTHERS%' AND producttype NOT LIKE '%READERS FEE%' AND approvalno NOT LIKE '%proferfee%' AND approvalno NOT LIKE '%instrument%' AND producttype NOT LIKE '%PAYMENT OF%'";
$resultx4 = $conn->query($sqlx4);
while($rowx4 = $resultx4->fetch_assoc()) {
$rsp=$rowx4['sellingprice'];
$rqt=$rowx4['quantity'];
$rad=$rowx4['adjustment'];
$gross+=($rsp*$rqt)-$rad;
}

$sqlccv = "SELECT sum(s.quantity) as qtyd, r.description, s.code, s.generic, r.unit FROM stocktable s, receiving r where s.code=r.code and s.dept='$dept' and (r.description like '%$search%' or r.generic like '%$search%') group by s.code order by r.code";
$resultccv = $conn->query($sqlccv);
if(mysqli_num_rows($resultccv) > 0){
while($rowccv = $resultccv->fetch_assoc()) {
$qty = $rowccv['qtyd'];
$desc = $rowccv['description'];
$code = $rowccv['code'];
$generic = $rowccv['generic'];
$cost = $rowccv['unitcost'];
$unit = $rowccv['unit'];

$desc = str_replace("ams-", "", $desc);
$desc = str_replace("-med", "", $desc);


$sql1 = "SELECT `gtestcode` FROM `receiving` WHERE `code`='$code'";
$result1 = $conn->query($sql1);
while($row1 = $result1->fetch_assoc()) {
$gtestcode = $row1['gtestcode'];
}

if($unit=="PHARMACY/MEDICINE"){$log = "medicine";}else{$log="injection-syringe";}
// 

$btncash = ""; $btncharge=""; $com=""; $bgc="";
if($qty<=0){$qty=0;}


if($gross>=$creditlimit){
$btncash = "<button type='submit' class='btn btn-primary' name='btnsubmit' value='cash' title='CASH' style='background: #cbd659; color: white;'><i class='icofont-coins'></i></button>";
$btncharge = "";
}else{
$btncash = "<button type='submit' class='btn btn-warning' name='btnsubmit' value='cash' title='CASH' style='background: #cbd659; color: white;'><font color='white'><i class='icofont-coins'></i></button>";
$btncharge = "<button type='submit' class='btn btn-danger' name='btnsubmit' value='charge' title='CHARGE' style='background: #4b4e77; color: white;'><font color='white'><i class='icofont-credit-card'></i></button>";
}
if($gtestcode!="0"){$com="<span class='badge bg-danger'><i class='icofont-ban'></i> Disabled</span>"; $btncash = ""; $btncharge="";}

if($qty>0){
echo"
<tr><td colspan='6'>
<form method='post' style='clear:both;margin-bottom:0px;'>
<table width='100%'>
<tr>
<td width='45%' style='font-size:11px;'><table><tr><td style='font-size:20px;'><i class='icofont-$log'></i></td><td style='font-size:11px;'><b>$desc ($generic)</td></tr></table></td>
<td width='5%' style='text-align: center; font-size: 15px;'><span class='badge bg-success'>$qty</span></td>
<td width='15%'>
<input list='route' name='route' class='inputlist4' style='padding: 5px; font-size: 12px;'>
<datalist id='route'>
";
$sql1 = "SELECT * FROM `route`";
$result1 = $conn->query($sql1);
while($row1 = $result1->fetch_assoc()) {
$route = $row1['route'];
echo"<option value='$route'>$route</option>";
}
echo"
</datalist>
</td>
<td width='15%'>
<input list='freq' name='freq' class='inputlist4' style='padding: 5px; font-size: 12px;'>
<datalist id='freq'>
";
$sql1 = "SELECT * FROM `sig`";
$result1 = $conn->query($sql1);
while($row1 = $result1->fetch_assoc()) {
$route2 = $row1['administration'];
echo"<option value='$route2'>$route2</option>";
}
echo"
</datalist>
</td>
<td style='text-align: center;' width='10%'><input type='text' name='qty' value='1' style='padding: 5px; text-align: center; font-size: 12px;'></td>
<td style='text-align: center;' width='10%'>
<table><tr><td>$btncash</td><td></td>"; 
//if(strpos($caseno, "R-")!==false or strpos($caseno, "R-")!==false or strpos($caseno, "R-")!==false){

if($gtestcode!="0"){$com="<span class='badge bg-danger'><i class='icofont-ban'></i> Disabled</span>";}else{
echo"<td id='presc'><button type='button' class='btn btn-secondary btn-sm' data-bs-toggle='modal' data-bs-target='#exampleModaladdcash' data-bs-dismiss='modal' "; ?> onclick="search('<?php echo $desc ?> (<?php echo $generic ?>)', 'cash', 'btnsubmit')" <?php echo" style='background: #cbd659; color: white;'><font color='white'><i class='icofont-coins'></i></button></td>";
}
echo"<td id='presc'><button type='button' class='btn btn-secondary btn-sm' data-bs-toggle='modal' data-bs-target='#exampleModaladdhm' data-bs-dismiss='modal' "; ?> onclick="search('<?php echo $desc ?> (<?php echo $generic ?>)', 'SUBMIT', 'btnsubmithm')" <?php echo"><i class='icofont-plus-circle'></i></button></td>";
//}
echo"<td>$com</td></tr></table>
</td>
<input type='hidden' value='$code' name='code'>
<input type='hidden' value='$desc' name='desc'>
<input type='hidden' value='$qty' name='qty2'>
</tr>
</table>
</form>
</td></tr>
";

}
}echo"</table>";
}else{
    
    echo"
    <script>
    $(document).ready(function(){
    $('#exampleModaladdhmxxx').modal('show');
    });
    </script>


 <div class='modal fade' id='exampleModaladdhmxxx' tabindex='-1'>
<div class='modal-dialog modal-xs glowing-circle3'>
<div class='modal-content'>
<div class='modal-header'>
<h5 class='modal-title'><i class='icofont-hand'></i> Opppsss....</h5>
<button type='button' class='btn-close' onclick='location.reload();' aria-label='Close'></button>
</div>
<div class='modal-body'>

    

<img src='../main/img/noresult.png' style='width: 100%;'>
<br><h5 align='center'>No result for <font color='red'><u>$search</u></font></h5><br>
<p align='center'><button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#exampleModaladdhm' data-bs-dismiss='modal' "; ?> onclick="search('<?php echo $search ?>')" <?php echo"><i class='icofont-plus-circle'></i> ADD THIS ITEM</button></p>


</div>
</div>
</div>
</div>
";   
}

}
?>

<?php include "../main/footer.php"; ?>
