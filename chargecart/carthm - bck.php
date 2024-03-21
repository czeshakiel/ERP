<script>
function del(){
return confirm("Are you sure you want to delete?");
}
</script>

<?php
include "../main/class.php";
include "../main/header.php";

$batchno = $_GET['batchno'];
$pdescxx = $_GET['pdesc'];

if(isset($_POST['btnsubmittiming'])){
$am = $_POST['am'];
$nn = $_POST['nn'];
$pm = $_POST['pm'];
$mn = $_POST['mn'];
$duration = $_POST['duration'];
$code = $_POST['code'];

$conn->query("update homemeds set tam='$am AM', tnn='$nn NN', tpm='$pm PM', tmn='$mn MN', duration='$duration' where no='$code'");
echo"<script>alert('done'); window.location = 'carthm.php?caseno=$caseno&batchno=$batchno';</script>";
}

if(isset($_POST['btnsubmithm'])){
$qty = $_POST['qty'];
$pdesc = $_POST['pdesc'];
$route = $_POST['route'];
$freq = $_POST['frequency'];

$am = $_POST['am'];
$nn = $_POST['nn'];
$pm = $_POST['pm'];
$mn = $_POST['mn'];
$duration = $_POST['duration'];
$coder = "AUTOHM".date("YmdHis");
$unit = "PHARMACY/MEDICINE";
$dept2="PHARMACY";

$conn->query("INSERT INTO `productouthm`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`,
 `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`,
 `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`) VALUES ('$coder',CURTIME(),'$caseno','$coder','$pdesc','$sp','$qty',
 '$adjustment','$net','homemeds','0','0','$net','$datex','$appr','$rrno','$empid','$batchno','$prodtype','$unit','insert-1','QR-$qty','pending','$branch',
 '$dept2',CURDATE(),'')");

// ---------- Insert to HOME MEDS -----------------
$conn->query("INSERT INTO `homemeds`(`caseno`, `refno`, `code`, `dosage`, `frequency`, `tam`, `tnn`, `tpm`, `tmn`, `duration`, `dateadded`, `addedby`) VALUES ('$caseno','$coder','$coder','$route','$freq','$am','$nn','$pm','$mn','$duration',NOW(),'$user')");
$conn->query("INSERT INTO `productoutconsult`(`caseno`, `productdesc`, `quantity`, `batchno`, `route`, `frequency`) VALUES ('$caseno','$pdesc','$qty','$batchno','$route','$freq')");

echo"<script>alert('done'); window.location = 'carthm.php?caseno=$caseno&batchno=$batchno';</script>";
}

if(isset($_POST['btnsubmit'])){
$qty1 = $_POST['qty'];
$code = $_POST['code'];

$route = $_POST['route'];
$freq = $_POST['freq'];
$desc = $_POST['desc'];
$btn = $_POST['btnsubmit'];
$result22223 = $conn->query("SELECT * from admission a, patientprofile p where a.patientidno=p.patientidno and a.caseno='$caseno'");
while($row22223 = $result22223->fetch_assoc()){ $senior=$row22223['senior'];}

include "../chargecart/pricescheme.php";
echo"<script>alert('Saved..'); window.location = 'carthm.php?caseno=$caseno&batchno=$batchno';</script>";
}

if(isset($_POST['btndel'])){
$refno = $_POST['refno'];

$sql778 = "delete from productout where refno='$refno' and caseno='$caseno'";
if ($conn->query($sql778) === TRUE) {}

$sql778 = "delete from productouthm where refno='$refno' and caseno='$caseno'";
if ($conn->query($sql778) === TRUE) {}

$sql778 = "delete from homemeds where refno='$refno' and caseno='$caseno'";
if ($conn->query($sql778) === TRUE) {}


echo"<script>alert('Successfully Deleted!'); window.location = 'carthm.php?caseno=$caseno$datax&batchno=$batchno';</script>";
}
?>

<table width="100%"><tr>
<td width="40%">

<div class="input-group mb-3" style="width: 100%;">
<span class="input-group-text" id="basic-addon1">&#128269;</span>
<input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="search_text" id="search_text" onchange="aa()" placeholder="Search by description or generic [Enter]">
</div>

</td><td valign="top">
<table align="right"><tr><td>
<a href="../chargecart/homemeds_print.php?caseno=<?php echo $caseno ?>&batchno=<?php echo $batchno ?>" target="_blank">
<button class="btn btn-secondary" name="printtick" style="padding: 5px; font-size: 12px;"><i class="icofont-printer"></i> Print Prescription - <?php echo $batchno ?></button><br style="margin-bottom: 8px;">
</a>
</td><td>
<div class="dropdown">
<button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 5px; font-size: 12px; color: white;">
<i class="icofont-printer"></i> Print Previous Transaction
</button>
<ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>
<?php
echo"<li><a class='dropdown-item' href='../chargecart/homemeds_print.php?caseno=$caseno' target='_blank'><i class='icofont-printer'></i> PRINT ALL</a></li>";
$sqlx77 = "SELECT * FROM productouthm where caseno ='$caseno' and batchno like 'HM-%%' group by batchno";
$resultx77 = $conn->query($sqlx77);
while($rowx77 = $resultx77->fetch_assoc()) {
$bthm= $rowx77['batchno'];
$u++;
echo"<li><a class='dropdown-item' href='../chargecart/homemeds_print.php?caseno=$caseno&batchno=$bthm' target='_blank'><i class='icofont-printer'></i> $bthm</a></li>";
}
?>
</ul>
</div>
</td></tr></table>

</td></tr></table>



<hr>
<img style="width: 150px; display: none; position: fixed; top: 40%; left: 40%;" src="../main/img/loading.gif" id="loading2">
<div id="result"></div>
<div style="clear:both"></div><br>


<script>
function aa(){
document.getElementById("loading2").style.display="";
document.getElementById("result").style.display="none";    

var caseno = "<?php echo $caseno ?>";
var str = document.getElementById('search_text').value;
var batchno = "<?php echo $batchno ?>";
$.get("../chargecart/fetch.php", {str:str, str2:caseno, str3:batchno},
function (data) {$("#result").html(data);  document.getElementById("loading2").style.display="none"; document.getElementById("result").style.display="";});   
}
</script>

</div>


</td></tr></table>


<table width='100%'>
<tr>
<td width='5%'></td>
<td style='text-align: center; font-size: 11px;'><b>DESCRIPTION</td>
<td style='text-align: center; font-size: 11px;'><b>QTY</td>
<td style='text-align: center; font-size: 11px;'><b>ROUTE/ FREQUENCY</td>
<td style='text-align: center; font-size: 11px;'><b>TIMING</td>
<td style='text-align: center; font-size: 11px;'><b>TYPE</td>
<td><font class='font8''><b></td>
</tr>
<tr><td colspan="6"><hr style="margin:0; padding:0;"></td></tr>
<?php
$sqlx7 = "SELECT * FROM productouthm where caseno ='$caseno' and batchno='$batchno'";
$resultx7 = $conn->query($sqlx7);
while($rowx7 = $resultx7->fetch_assoc()) {
$desc=$rowx7['productdesc'];
$qty=$rowx7['quantity'];
$trantype=$rowx7['trantype'];
$refno=$rowx7['refno'];

$timing = "";
$sqlx77 = "SELECT * FROM homemeds where caseno ='$caseno' and refno='$refno'";
$resultx77 = $conn->query($sqlx77);
while($rowx77 = $resultx77->fetch_assoc()) {
$id = $rowx77['no'];
$freq1 = $rowx77['frequency'];
$route = $rowx77['dosage'];
$duration = $rowx77['duration'];
$tmn = $rowx77['tmn'];
$tpm = $rowx77['tpm'];
$tnn = $rowx77['tnn'];
$tam = $rowx77['tam'];
if($route!=""){$freq1 = $freq1." [".$route."]";}
}

if($duration!=""){$timing = $duration;}
if($tmn!=""){$timing = $tmn." | ".$timing;}
if($tpm!=""){$timing = $tpm." | ".$timing;}
if($tnn!=""){$timing = $tnn." | ".$timing;}
if($tam!=""){$timing = $tam." | ".$timing;}

echo"
<form method='POST'>
<tr>
<td style='text-align: center; font-size: 11px;'><i class='icofont-checked'></i></td>
<td style='font-size: 11px;'>$desc</td>
<td style='text-align: center; font-size: 11px;'>$qty</td>
<td style='text-align: center; font-size: 11px;'>$freq1</td>
<td style='text-align: center; font-size: 11px;'>";
if($timing==""){echo"<button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#exampleModaladdtiming' data-bs-dismiss='modal'";?> onclick="search2('<?php echo $tam ?>', '<?php echo $tnn ?>', '<?php echo $tpm ?>', '<?php echo $tmn ?>', '<?php echo $duration ?>', '<?php echo $id ?>');"; <?php echo">Add Timing..</button>";}else{echo"$timing";}
echo"</td>
<td style='text-align: center; font-size: 11px;'>$trantype</td>
<td style='text-align: center; font-size: 11px;'>
<button type='submit' class='btn btn-danger btn-sm' name='btndel' onclick='return del()'><i class='icofont-trash'></i></button>
<input type='hidden' name='refno' value='$refno'>
</td>
</tr>
</form>
";
}
?>
</table>


<script>function search(val){document.getElementById("pdesc").value=val;}</script>
<div class="modal fade" id="exampleModaladdhm" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog modal-xs glowing-circle3">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="icofont-plus-circle"></i> Prescription Meds</h5>
<button type="button" class="btn-close" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">
<?php
echo"
<form method='POST'>
<table width='90%' align='center'>
<tr>
<td width='20%'><font color='black'>Description:</td><td><input  name='pdesc' id='pdesc' type='text' value='$search' class='form-control' required></td>
</tr>
<tr>
<td style='text-align: right;'><font color='black'>Quantity:</td><td><input  name='qty' type='text' value='' class='form-control' required></td>
</tr>
<tr>
<td style='text-align: right;'><font color='black'>Route:</td><td><input  name='route' type='text' value='' class='form-control'></td>
</tr>
<tr>
<td style='text-align: right;'><font color='black'>Frequency:</td><td><input  name='frequency' type='text' value='' class='form-control'></td>
</tr>

<tr>
<td style='text-align: right;'><font color='black'>AM:</td><td><input  name='am' type='text' value='' class='form-control'></td>
</tr>
<tr>
<td style='text-align: right;'><font color='black'>NN:</td><td><input  name='nn' type='text' value='' class='form-control'></td>
</tr>
<tr>
<td style='text-align: right;'><font color='black'>PM:</td><td><input  name='pm' type='text' value='' class='form-control'></td>
</tr>
<tr>
<td style='text-align: right;'><font color='black'>MN:</td><td><input  name='mn' type='text' value='' class='form-control'></td>
</tr>
<tr>
<td style='text-align: right;'><font color='black'>Duration:</td><td><input  name='duration' type='text' value='' class='form-control'></td>
</tr>

<tr>
<td colspan='2' style='text-align: right;'><br><button type='submit' name='btnsubmithm' value='SUBMIT' class='btn btn-danger btn-sm' style='color: white;'><i class='icofont-check-circled'></i> Submit Prescription</button></td>
</tr>
</table> <br>
</form> 
";
?>
</div>
</div>
</div>
</div>





<script>function search2(val1, val2, val3, val4, val5, val6){
document.getElementById("am").value=val1;
document.getElementById("nn").value=val2;
document.getElementById("pm").value=val3;
document.getElementById("mn").value=val4;
document.getElementById("duration").value=val5;
document.getElementById("code").value=val6;
}</script>
<div class="modal fade" id="exampleModaladdtiming" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog modal-xs glowing-circle3">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="icofont-plus-circle"></i> TIMING</h5>
<button type="button" class="btn-close" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">
<?php
echo"
<form method='POST'>
<table width='90%' align='center'>
<tr>
<td style='text-align: right;'><font color='black'>AM:</td><td><input  name='am' id='am' type='text' value='' class='form-control'></td>
</tr>
<tr>
<td style='text-align: right;'><font color='black'>NN:</td><td><input  name='nn' id='nn' type='text' value='' class='form-control'></td>
</tr>
<tr>
<td style='text-align: right;'><font color='black'>PM:</td><td><input  name='pm' id='pm' type='text' value='' class='form-control'></td>
</tr>
<tr>
<td style='text-align: right;'><font color='black'>MN:</td><td><input  name='mn' id='mn' type='text' value='' class='form-control'></td>
</tr>
<tr>
<td style='text-align: right;'><font color='black'>Duration:</td><td><input  name='duration' id='duration' type='text' value='' class='form-control'></td>
</tr>

<tr>
<td colspan='2' style='text-align: right;'><br><button type='submit' name='btnsubmittiming' value='SUBMIT' class='btn btn-danger btn-sm' style='color: white;'><i class='icofont-check-circled'></i> Submit Prescription</button></td>
</tr>
</table> <br>
<input type='hidden' name='code' id='code'>
</form> 
";
?>
</div>
</div>
</div>
</div>





<?php include "../main/footer.php"; ?>
