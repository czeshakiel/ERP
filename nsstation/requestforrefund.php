<?php
include "../main/class.php";
include "../main/header.php";
$caseno=$_GET['caseno'];
if(isset($_POST['btnsubmit'])){
$reason = $_POST['reason'];
$pass = $_POST['pass'];
$ck = $_POST['ck'];
$count = count($ck);
$casenonew = $caseno."_refund";

$sql = "SELECT * from nsauth where username='$userunique' and password = '$pass'";
$result = $conn->query($sql);

if(mysqli_num_rows($result)>0){

for($i=0; $i<$count; $i++){
$sql7789 = "update productout set terminalname='refund', status='refund', shift = '$reason', loginuser = concat(loginuser, '<br>refund by: $user') where refno = '$ck[$i]' and caseno = '$caseno'";
if ($conn->query($sql7789) === TRUE) {}

$sql7789 = "update labtest set caseno = '$casenonew' where refno = '$ck[$i]' and caseno = '$caseno'";
if ($conn->query($sql7789) === TRUE) {}
}

echo "<script>alert('Successfully Deleted!'); window.location = 'requestforrefund.php?caseno=$caseno$datax';</script>";

}else{echo"<script>alert('Wrong Password!'); window.location = 'requestforrefund.php?caseno=$caseno$datax';</script>";}

}
?>

<div class="col-lg-12" style="width: 100%;">
<div class="card mb-4">
<div class="table-responsive p-3">


<form method="POST" name="arvz">

<table width="100%">
<tr>
<td width="40%">
<h5><font color="black"></font></h5>
</td><td valign="top" style="text-align: right;">
<div class="container">
<div class="btn-group btn-group-justified" style="width: 100%;">
<button class='btn btn-outline-danger btn-sm'  type="button" onclick="check()" style="width: 200px;"><i class='icofont-checked'></i> Check All</button>
<button class='btn btn-outline-danger btn-sm' type="button" onclick="uncheck()" style="width: 200px;"><i class='icofont-close-squared-alt'></i> Un-check All</button>
<button class='btn btn-outline-danger btn-sm' data-bs-toggle="modal" data-bs-target="#cancelpendingxx" style="width: 200px;"><i class='icofont-trash'></i> For Refund</button>
</div>
</div>
</td></tr></table>
<hr>

<?php
echo"<table border='1' width='100%' align='center' class='table table-hover align-middle mb-0'>";
echo"
<tr><td colspan='6' class='text-center' bgcolor='lightyellow'>LABORATORY & OTHER SERVICES</td></tr>
<tr>
<td style='font-size: 11px;' width='5%'><b>#</td>
<td style='font-size: 11px;' width='5%'></td>
<td style='font-size: 11px;' width='40%'><b>CODE/ DESCRIPTION</td>
<td style='font-size: 11px;' width='23%'><b>DATE/ TERMINALNAME</td>
<td style='font-size: 11px;'><b>QTY</td>
<td style='font-size: 11px;' width='23%'><b>TYPE</td>
</tr>
";
$i=0;
$sql = "SELECT * from productout where caseno = '$caseno' and status='PAID' and quantity>0 and terminalname = 'pending' and (productsubtype not like '%SUPPLIES%' or productsubtype not like '%MIDECINE%')";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()){
$refno = $row['refno'];
$i++;
$sql123=mysqli_query($conn, "SELECT remarks FROM labtest where refno='$refno'");
if(mysqli_num_rows($sql123)==0){
$remarks="";
}else{
$sql123fetch=mysqli_fetch_array($sql123);
$remarks="<span style='color: RED;'> ($sql123fetch[remarks])</span>";
}
echo"
<tr>
<td><font color='black'>$i</td>
<td class='text-center'><font color='black'><input type='checkbox' name='ck[]' id='ck$i' value='$refno' style='transform : scale(1.6);'></td>
<td style='font-size: 11px;'>$row[productcode]<br><b>$row[productdesc]$remarks</td>
<td style='font-size: 11px;'>$row[datearray]<br>$row[terminalname]</td>
<td style='font-size: 11px;'>$row[quantity]</td>
<td style='font-size: 11px;'>$row[trantype]<br>$row[productsubtype]</td>
</tr>
";
}
?>
</tbody>
</table>




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
