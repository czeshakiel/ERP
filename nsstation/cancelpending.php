<?php
include "../main/class.php";
include "../main/header.php";
$caseno=$_GET['caseno'];
if(isset($_POST['btnsubmit'])){
$reason = $_POST['reason'];
$pass = $_POST['pass'];
$ck = $_POST['ck'];
$count = count($ck);
$casenonew = $caseno."_cancelled";

$sql = "SELECT * from nsauth where username='$userunique' and password = '$pass'";
$result = $conn->query($sql);

if(mysqli_num_rows($result)>0){

for($i=0; $i<$count; $i++){
$sql7789 = "update productout set caseno='$casenonew', shift = '$reason', loginuser = concat(loginuser, '<br>deleted by: $user') where refno = '$ck[$i]' and caseno = '$caseno'";
if ($conn->query($sql7789) === TRUE) {}

$sql7789 = "update labtest set caseno = '$casenonew' where refno = '$ck[$i]' and caseno = '$caseno'";
if ($conn->query($sql7789) === TRUE) {}
}

echo "<script>alert('Successfully Deleted!'); window.location = '?view=deletepending&caseno=$caseno$datax';</script>";

}else{echo"<script>alert('Wrong Password!'); window.location = '?view=deletepending&caseno=$caseno$datax';</script>";}

}
?>




<form method="POST" name="arvz">

<table width="100%">
<tr>
<td width="40%">
</td><td valign="top" style="text-align: right;">
<div class="container">
<div class="btn-group btn-group-justified" style="width: 100%;">
<button class='btn btn-outline-danger btn-sm'  type="button" onclick="check()" style="width: 200px;"><i class='icofont-checked'></i> Check All</button>
<button class='btn btn-outline-danger btn-sm' type="button" onclick="uncheck()" style="width: 200px;"><i class='icofont-close-squared-alt'></i> Un-check All</button>
<button class='btn btn-outline-danger btn-sm' data-bs-toggle="modal" data-bs-target="#cancelpendingxx" style="width: 200px;"><i class='icofont-trash'></i> Delete Selected Item(s)</button>
</div>
</div>
</td></tr></table>
<hr>

<div class="col-lg-12" style="width: 100%;">
<div class="card mb-4">
<div class="table-responsive p-3">


<div class="accordion accordion-flush" id="accordionFlushExample">
<div class="accordion-item">
<h2 class="accordion-header" id="flush-headingOne">
<button class="accordion-button collapsedive" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
<b><i class="icofont-pills"></i> &nbsp; MEDICINE & SUPPLIES</b> &nbsp;<b id='medcount'></b></button></h2>
<div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">



<table border="1" width="100%" align="center" class="table table-hover align-middle mb-0">
<tr>
<td style='font-size: 11px;' width='5%'><b>#</td>
<td style='font-size: 11px;' width='5%'></td>
<td style='font-size: 11px;' width='40%'><b>CODE/ DESCRIPTION</td>
<td style='font-size: 11px;' width='23%'><b>DATE/ TERMINALNAME</td>
<td style='font-size: 11px;'><b>QTY</td>
<td style='font-size: 11px;' width='23%'><b>TYPE</td>
</tr>
<?php
$i=0;
$sql = "SELECT * from productout where caseno = '$caseno' and status!='PAID' and quantity>0 and administration='pending' and (productsubtype  like '%SUPPLIES%' or productsubtype like '%MEDICINE%')";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()){
$refno = $row['refno'];
$i++;
echo"
<tr>
<td><font color='black'>$i</td>
<td class='text-center'><font color='black'><input type='checkbox' name='ck[]' id='ck$i' value='$refno' style='transform : scale(1.6);'></td>
<td style='font-size: 11px;'>$row[productcode]<br><b>$row[productdesc]</b></td>
<td style='font-size: 11px;'>$row[datearray]<br>$row[terminalname]</td>
<td style='font-size: 11px;'>$row[quantity]</td>
<td style='font-size: 11px;'>$row[trantype]<br>$row[productsubtype]</td>
</tr>
";
}
echo"</table>";
?>
<br>

</div>
</div>
<div class="accordion-item">
<h2 class="accordion-header" id="flush-headingTwo">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
<b><i class="icofont-thermometer-alt"></i> &nbsp; LABORATORY & OTHER SERVICES</b> &nbsp;<b id='supcount'></b></button></h2>
<div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">



<?php
echo"<table border='1' width='100%' align='center' class='table table-hover align-middle mb-0'>";
echo"
<tr>
<td style='font-size: 11px;' width='5%'><b>#</td>
<td style='font-size: 11px;' width='5%'></td>
<td style='font-size: 11px;' width='40%'><b>CODE/ DESCRIPTION</td>
<td style='font-size: 11px;' width='23%'><b>DATE/ TERMINALNAME</td>
<td style='font-size: 11px;'><b>QTY</td>
<td style='font-size: 11px;' width='23%'><b>TYPE</td>
</tr>
";
$sql = "SELECT * from productout where caseno = '$caseno' and status!='PAID' and quantity>0 and terminalname = 'pending' and (productsubtype not like '%SUPPLIES%' or productsubtype not like '%MIDECINE%')";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()){
$refno = $row['refno'];

$sql1 = $conn->query("SELECT remarks FROM labtest WHERE refno='$refno'");
$rem=$sql1->fetch_assoc();

$i++;
echo"
<tr>
<td><font color='black'>$i</td>
<td class='text-center'><font color='black'><input type='checkbox' name='ck[]' id='ck$i' value='$refno' style='transform : scale(1.6);'></td>
<td style='font-size: 11px;'>$row[productcode]<br><b>$row[productdesc] <font color='red'>$rem[remarks]</font></td>
<td style='font-size: 11px;'>$row[datearray]<br>$row[terminalname]</td>
<td style='font-size: 11px;'>$row[quantity]</td>
<td style='font-size: 11px;'>$row[trantype]<br>$row[productsubtype]</td>
</tr>
";
}
?>
</tbody>
</table>

</div>
</div>
</div>


<div class="modal fade" id="cancelpendingxx" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog modal-xl glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> Cancel Request?</h5>
<button type="button" class="btn-close" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">
<font color="black">Are you sure you want to Cancel Request? <br>
<textarea name="reason" placeholder="Enter Reason for Cancel Request..." style="width: 100%; height:100px; font-size:10pt; background: white; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e;" required></textarea><br><br>
Enter Password:</font>
<input type="password" name="pass" placeholder="***** Password here *****" style="width: 50%; font-size:15pt; background: white; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e;" required>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
<button type="submit" name="btnsubmit" class="btn btn-danger btn-sm">Submit</button>
</div>
</div>
</div>
</div>



</form>


</div>
</div>
</div>



<script>
function check(){
if(!document.forms['arvz'])
return;
var objCheckBoxes = document.forms['arvz'].elements['ck[]'];
if(!objCheckBoxes)
return;
var countCheckBoxes = objCheckBoxes.length;
if(!countCheckBoxes)
objCheckBoxes.checked = true;
else
for(var i = 0; i < countCheckBoxes; i++)
objCheckBoxes[i].checked = true;
}

function uncheck(){
if(!document.forms['arvz'])
return;
var objCheckBoxes = document.forms['arvz'].elements['ck[]'];
if(!objCheckBoxes)
return;
var countCheckBoxes = objCheckBoxes.length;
if(!countCheckBoxes)
objCheckBoxes.checked = false;
else
for(var i = 0; i < countCheckBoxes; i++)
objCheckBoxes[i].checked = false;
}
</script>

<?php include "../main/footer.php"; ?>
