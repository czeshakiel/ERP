<!------------------------------- AUTO LOADING IF PAGE IS LOADING --------------------->
<style>
.center {
position: absolute;
top: 0;
bottom: 0;
left: 0;
right: 0;
margin: auto;
}

::placeholder { /* Firefox */
color: red;
opacity: 1;
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
 color: red;
}

::-ms-input-placeholder { /* Microsoft Edge */
 color: red;
}
</style>

<script>
document.onreadystatechange = function() {
if (document.readyState !== "complete") {
document.getElementById("loading").style.display="";
document.getElementById("maindisplay").style.display="none";
} else {
document.getElementById("loading").style.display="none";
document.getElementById("maindisplay").style.display="";
}
};
</script>
<img src="../main/img/loading2.gif" id="loading" class="center"></img>
<!--------------------------- END AUTO LOADING IF PAGE IS LOADING --------------------->

<?php

include "../main/class.php";
include "../main/header.php";
error_reporting(1);
$caseno=$_GET['caseno'];

$sq = $conn->query("select * from admission a, patientprofile p where a.patientidno=p.patientidno and a.caseno='$caseno'");
while($res = $sq->fetch_assoc()){$myname = $res['lastname'].", ".$res['firstname']." ".$res['middlename']; $sex['sex'];}

if($sex=="F"){$sex="FEMALE"; $avat = "girl";}
else{$sex="MALE"; $avat = "boy";}

if(isset($_POST['btnsubmit'])){
// ---------------------------------->>>> ADMINISTER MEDICINE --------------------------->>>
$ckmed = $_POST['ck'];
$qtyadministermed = $_POST['qtyadminister'];
$route = $_POST['route'];
$freq = $_POST['freq'];
$loop1 = "0";
$loop2 = "0";

if(!empty($ckmed)){
$ckmedcount = count($ckmed);
for($i=0; $i<$ckmedcount; $i++){
$sqlp = $conn->query("select * from productout where refno='$ckmed[$i]' and caseno='$caseno'");
while($rest = $sqlp->fetch_assoc()){
$code = $rest['productcode'];
$desc = $rest['productdesc'];
$srp = $rest['sellingprice'];
$qty = $rest['quantity'];
$adj = $rest['adjustment'];
$gross = $rest['gross'];
$trantype = $rest['trantype'];
$phic = $rest['phic'];
$hmo = $rest['hmo'];
$excess = $rest['excess'];
$status = $rest['status'];
$terminalname = $rest['terminalname'];
$batchno = $rest['batchno'];
$producttype = $rest['producttype'];
$productsubtype = $rest['productsubtype'];
$shift = $rest['shift'];
$location = $rest['location'];
$loginuser = $rest['loginuser'];
}

$loginuser = $loginuser."<br>Administered by:".$user;

if($qtyadministermed[$i]<$qty){
$updateqty = $qty - $qtyadministermed[$i];
$updateadj = ($adj/$qty) * $updateqty;
$updategross = ($gross/$qty) * $updateqty;
$updatephic = ($phic/$qty) * $updateqty;
$updatehmo = ($hmo/$qty) * $updateqty;
$updateexcess = ($excess/$qty) * $updateqty;

$adj = ($adj/$qty) * $qtyadministermed[$i];
$gross = ($gross/$qty) * $qtyadministermed[$i];
$phic = ($phic/$qty) * $qtyadministermed[$i];
$hmo = ($hmo/$qty) * $qtyadministermed[$i];
$excess = ($excess/$qty) * $qtyadministermed[$i];
}else{
$updateqty = "0";
$updateadj = "0";
$updategross = "0";
$updatephic = "0";
$updatehmo = "0";
$updateexcess = "0";  
}

$loop1++;
if($qtyadministermed[$i]>0){
$loop2++;
//$refno = date("YmdHis")."".$i;
$refno = "ADM".$ckmed[$i];
$xtest = $conn->query("select * from productout where refno='$refno'");
if(mysqli_num_rows($xtest)>0){$refno = $refno."x1";}

$conn->query("INSERT INTO `productout`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`, `trantype`, `phic`, `hmo`, `excess`,
`date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`, `remarks`, `addons`) 
VALUES ('$refno', CURTIME(), '$caseno', '$code', '$desc', '$srp', '$qtyadministermed[$i]', '$adj', '$gross', '$trantype', '$phic', '$hmo', '$excess', CURDATE(), '$status', '$terminalname',
'$loginuser', '$batchno', '$producttype', '$productsubtype', NOW(), '$ckmed[$i]', 'administered', '$shift', '$location', CURDATE(), '', '$loop1 - $loop2', 'newadm')");

$conn->query("update productout set quantity='$updateqty', adjustment='$updateadj', gross='$updategross', phic='$updatephic', hmo='$updatehmo', excess='$updateexcess' where caseno='$caseno' and refno='$ckmed[$i]'");
$conn->query("INSERT INTO `productoutaddinfo`(`refno`, `caseno`, `code`, `route`, `frequency`) VALUES ('$refno', '$caseno', '$code', '$route[$i]', '$freq[$i]')");
$conn->query("INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('$caseno $myname medicine is administered with refno $refno (qty administer: $qtyadministermed[$i]) [Dispensed Hist.: $ckmed[$i] - $code - $desc]', '$user', CURDATE(), CURTIME())");
}


}
}
// ----------------------------->>>> END ADMINISTER MEDICINE --------------------------->>>

// ---------------------------------->>>> ADMINISTER SUPPLIES --------------------------->>>
$cksup = $_POST['cks'];
$qtyadministersup = $_POST['qtyadministers'];

if(!empty($cksup)){
$cksupcount = count($cksup);
for($ii=0; $ii<$cksupcount; $ii++){
$sqlpp = $conn->query("select * from productout where refno='$cksup[$ii]' and caseno='$caseno'");
while($restp = $sqlpp->fetch_assoc()){
$code = $restp['productcode'];
$desc = $restp['productdesc'];
$srp = $restp['sellingprice'];
$qty = $restp['quantity'];
$adj = $restp['adjustment'];
$gross = $restp['gross'];
$trantype = $restp['trantype'];
$phic = $restp['phic'];
$hmo = $restp['hmo'];
$excess = $restp['excess'];
$status = $restp['status'];
$terminalname = $restp['terminalname'];
$batchno = $restp['batchno'];
$producttype = $restp['producttype'];
$productsubtype = $restp['productsubtype'];
$shift = $restp['shift'];
$location = $restp['location'];
$loginuser = $restp['loginuser'];
}

$loginuser = $loginuser."<br>Administered by:".$user;

if($qtyadministersup[$ii]<$qty){
$updateqty = $qty - $qtyadministersup[$ii];
$updateadj = ($adj/$qty) * $updateqty;
$updategross = ($gross/$qty) * $updateqty;
$updatephic = ($phic/$qty) * $updateqty;
$updatehmo = ($hmo/$qty) * $updateqty;
$updateexcess = ($excess/$qty) * $updateqty;

$adj = ($adj/$qty) * $qtyadministersup[$ii];
$gross = ($gross/$qty) * $qtyadministersup[$ii];
$phic = ($phic/$qty) * $qtyadministersup[$ii];
$hmo = ($hmo/$qty) * $qtyadministersup[$ii];
$excess = ($excess/$qty) * $qtyadministersup[$ii];
}else{
$updateqty = "0";
$updateadj = "0";
$updategross = "0";
$updatephic = "0";
$updatehmo = "0";
$updateexcess = "0";  
}


if($qtyadministersup[$ii]>0){
//$refno1 = date("YmdHis")."".$ii;
$refno1 = "ADM".$cksup[$ii];
$conn->query("INSERT INTO `productout`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`, `trantype`, `phic`, `hmo`, `excess`,
`date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`) 
VALUES ('$refno1', CURTIME(), '$caseno', '$code', '$desc', '$srp', '$qtyadministersup[$ii]', '$adj', '$gross', '$trantype', '$phic', '$hmo', '$excess', CURDATE(), '$status', '$terminalname',
'$loginuser', '$batchno', '$producttype', '$productsubtype', NOW(), '$cksup[$ii]', 'administered', '$shift', '$location', CURDATE(), '')");

$conn->query("update productout set quantity='$updateqty', adjustment='$updateadj', gross='$updategross', phic='$updatephic', hmo='$updatehmo', excess='$updateexcess' where caseno='$caseno' and refno='$cksup[$ii]'");
$conn->query("INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('$caseno $myname supply is administered with refno $refno1 (qty administer: $qtyadministersup[$ii]) [Dispensed Hist.: $cksup[$ii] - $code - $desc]', '$user', CURDATE(), CURTIME())");
}

}
}
// ------------------------------->>>> END ADMINISTER SUPPLIES --------------------------->>>

echo"
<script>
swal({
icon: 'success',
title: 'Successfully Administered!',
text: 'by $user!',
type: 'error',
button: false,
});

setTimeout(function(){window.location.href = 'administer.php?caseno=$caseno';}, 2000);
</script>
";
}
?>


<body  onload="checkallx();">
<form method="POST" name="arvz">
<div id="maindisplay" style="display: none;">

<table width="97%" align="center">
<tr>
<td width="60%">
<table width="100%"><tr>
<td width="10%"><img src='../main/img/<?php echo $avat ?>.png' width='50' height='50' style='border-radius: 50%;'></td>
<td>
<span class="py-1 fw-bold small-11 mb-0 mt-1"><?php echo $caseno ?></span>
<h6  class="mb-0 mt-2  fw-bold d-block fs-6"><?php echo strtoupper($myname) ?></h6>
</td></tr>
</table>
</td><td valign="top" style="text-align: right;">
<button type="button" class = "btn btn-danger btn-sm" style='padding: 5px; font-size: 13px; color: white; background: #a41739;' onclick="checkForm();"><i class='icofont-check-circled'></i> Submit Transaction</button>&nbsp;
</td></tr></table>
<hr>


<table width="97%" align="center"><tr><td>
<div class="card" style="width: 100%;">
<div class="card-body">

<div class="accordion accordion-flush" id="accordionFlushExample">
<div class="accordion-item">
<h2 class="accordion-header" id="flush-headingOne">
<button class="accordion-button collapsedive" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
<b><i class="icofont-pills"></i> &nbsp; MEDICINE(S)</b> &nbsp;<b id='medcount'></b></button></h2>
<div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">


<table class="table">
<thead>
<tr>
<td><input type="checkbox" id="checkall" onclick="checkallx();" style='transform : scale(1.7);'></td>
<td style='font-size: 11px;' width="10%"><b>Date & Time <br> Trantype</td>
<td style='font-size: 11px;' width="50%"><b>Batchno/ Item Description</td>
<td style='font-size: 11px;'><b>Qty</td>
<td style='font-size: 11px;' width="5%"><b>Administered</td>
<td style='font-size: 11px;' width="15%"><b>Route</td>
<td style='font-size: 11px;' width="15%"><b>Frequency</td>
</tr>
</thead>
<tbody>
<?php
$i=0;
$sql = "SELECT * from productout where caseno = '$caseno' and quantity>0 and administration='dispensed' and productsubtype like '%MEDICINE%'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$refno = $row['refno'];
$desc = $row['productdesc'];
$code = $row['productcode'];
$loginuser = explode("<br>", $row['loginuser']);
$desc = str_replace("ams-", "", $desc);
$desc = str_replace("mak-", "", $desc);
$desc = str_replace("-sup", "", $desc);
$desc = str_replace("-med", "", $desc);

$sql2 = $conn->query("select * from productreturn where caseno='$caseno' and refno1='$refno' and trantype!='return'");
$sql3 = $conn->query("select * from productreturnCN where caseno='$caseno' and refno1='$refno' and trantype!='return'");
if(mysqli_num_rows($sql2)==0 and mysqli_num_rows($sql3)==0){
$i++;
echo"
<tr>
<td class='text-center'><input type='checkbox' name='ck[]' id='ck$i' value='$refno' style='transform : scale(1.7);'"; ?> onclick="myrequired('<?php echo $i ?>')" <?php echo"></td>
<td style='font-size: 11px;'>$row[datearray]<br><b>$row[trantype]</td>
<td style='font-size: 11px;'><b>$desc</b><br><font color='red' size='1px'>$loginuser[0]</font></td>
<td style='font-size: 18px;'><span class='badge bg-danger'>$row[quantity]</span></td>
<td><font color='black'><input type='text' name='qtyadminister[]' id='qtyadminister$i' value='$row[quantity]' style='width: 100%; font-size:13px; padding: 5px; text-align: center;' disabled></td>
<td>
<input list='rroute' name='route[]' id='route$i' style='width: 100%; font-size:12px; padding: 5px;' disabled>
<datalist id='rroute'>
<option value=''>
";
$SQLroute=$conn->query("SELECT route FROM route");
if(mysqli_num_rows($SQLroute)>0){
while($r=$SQLroute->fetch_assoc()){
echo"<option value='$r[route]'>";
}}
echo"
</datalist>
</td>
<td>
<input list='ffreq' name='freq[]' id='freq$i' style='width: 100%; font-size:12px; padding: 5px;' disabled>
<datalist id='ffreq'>
<option value=''>
";
$SQLsig=$conn->query("SELECT administration FROM sig WHERE status='Active'");
if(mysqli_num_rows($SQLsig)>0){
while($r1=$SQLsig->fetch_assoc()){
echo"<option value='$r1[administration]'>";
}}
echo"
</datalist>
</td>
</tr>
";
}
}
?>
</tbody>
</table>

</div>
</div>
<div class="accordion-item">
<h2 class="accordion-header" id="flush-headingTwo">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
<b><i class="icofont-thermometer-alt"></i> &nbsp; SUPPLIES</b> &nbsp;<b id='supcount'></b></button></h2>
<div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">


<table class="table">
<thead>
<tr>
<td><input type="checkbox" id="checkalls" onclick="checkallxs();" style='transform : scale(1.7);'></td>
<td style='font-size: 11px;' width="10%"><b>Date & Time <br> Trantype</td>
<td style='font-size: 11px;' width="75%"><b>Batchno/ Item Description</td>
<td style='font-size: 11px;'><b>Qty</td>
<td style='font-size: 11px;' width="7%"><b>Administered</td>
</tr>
</thead>
<tbody>
<?php
$ii=0;
$sql = "SELECT * from productout where caseno = '$caseno' and quantity>0 and administration='dispensed' and productsubtype like '%SUPPLIES%'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$refno = $row['refno'];
$desc = $row['productdesc'];
$code = $row['productcode'];
$loginuser = explode("<br>", $row['loginuser']);
$desc = str_replace("ams-", "", $desc);
$desc = str_replace("mak-", "", $desc);
$desc = str_replace("-sup", "", $desc);
$desc = str_replace("-med", "", $desc);

$sql2 = $conn->query("select * from productreturn where caseno='$caseno' and refno1='$refno' and trantype!='return'");
$sql3 = $conn->query("select * from productreturnCN where caseno='$caseno' and refno1='$refno' and trantype!='return'");
if(mysqli_num_rows($sql2)==0 and mysqli_num_rows($sql3)==0){
$ii++;
echo"
<tr>
<td class='text-center'><input type='checkbox' name='cks[]' id='cks$ii' value='$refno' style='transform : scale(1.7);'"; ?> onclick="myrequired2('<?php echo $ii ?>')" <?php echo"></td>
<td style='font-size: 11px;'>$row[datearray]<br><b>$row[trantype]</td>
<td style='font-size: 11px;'><b>$desc</b><br><font color='red' size='1px'>$loginuser[0]</font></td>
<td style='font-size: 20px;'><span class='badge bg-danger'>$row[quantity]</span></td>
<td><font color='black'><input type='text' name='qtyadministers[]' id='qtyadministers$ii' value='$row[quantity]' style='width: 100%; font-size:13px; padding: 5px; text-align: center;' disabled></td>
</tr>
";
}
}
?>
</tbody>
</table>

</div>
</div>
</div>


</div>
</div>
</td></tr></table>
</div>



<div class="modal fade" id="exampleModal2del" tabindex="-1">
<div class="modal-dialog modal-xs glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="icofont-lock"></i> Authentication!</h5>
<button type="button" class="btn-close" data-bs-dismiss='modal' aria-label="Close"></button>
</div>
<div class="modal-body">
<font color="black">Enter Password:</font>
<input type="password" name="pass" id="pass" placeholder="Enter Password.." class="form-control" required>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary" onclick="verify();" id="idadminis" data-bs-dismiss='modal' style='padding: 5px; font-size: 13px; color: white; background: #291673;'><i class='icofont-tick-boxed'></i> Administer</button>
<button type="submit" name="btnsubmit" id="btnsubmit" class="btn btn-danger" hidden>Administer</button>
</div>
</div>
</div>
</div>



</form>


<script>
function checkForm() {
document.getElementById('pass').value="1";
var textboxes = document.getElementsByTagName("input");
for (var i = 0; i < textboxes.length; i++) {
if (textboxes[i].required && textboxes[i].value.trim() == "") {

swal("ERROR!", "Please fill in all required fields!", "error");
return false;
}
}

var checkboxes = document.querySelectorAll('input[type="checkbox"]');
var z = "1";
for (var i = 0; i < checkboxes.length; i++) {
if (checkboxes[i].checked) {z = z+"1";}
}
if(z=="1"){
swal("ERROR!", "Please select an item to be administered.", "error");
return false;
}

document.getElementById('pass').value="";
$('#exampleModal2del').modal('show');
return true;
}

function verify(){
var str="verifyadminister";
var pass = document.getElementById("pass").value;
var username = "<?php echo $userunique ?>";
var ver = "verified";
$.get("../main/functions.php", {str:str, pass:pass, username:username}, function (data) {
if(data=="YES"){
document.getElementById("btnsubmit").click();
document.getElementById("idadminis").disabled = true; 
}else{

document.getElementById('pass').value="";
swal({
icon: 'error',
title: 'Wrong Password!',
text: 'Please try again!',
type: 'error',
button: false,
timer: 1000
});

}
});

}

function myrequired(val){
var ck = "ck"+val;
var route = "route"+val;
var freq = "freq"+val;
var qtyadminister = "qtyadminister"+val;
if(document.getElementById(ck).checked==true){
document.getElementById(route).required= true; 
document.getElementById(freq).required= true;
document.getElementById(qtyadminister).required= true;
document.getElementById(route).placeholder = "* Required";
document.getElementById(freq).placeholder = "* Required";
document.getElementById(qtyadminister).placeholder = "* Required";
document.getElementById(route).disabled = false;
document.getElementById(freq).disabled = false;
document.getElementById(qtyadminister).disabled = false;
}else{
document.getElementById(route).required= false; 
document.getElementById(freq).required= false;
document.getElementById(qtyadminister).required= false;
document.getElementById(route).placeholder = "";
document.getElementById(freq).placeholder = "";
document.getElementById(qtyadminister).placeholder = "";
document.getElementById(route).disabled = true;
document.getElementById(freq).disabled = true;
document.getElementById(qtyadminister).disabled = true;
}
}

function myrequired2(val){
var ck = "cks"+val;
var qtyadminister = "qtyadministers"+val;
if(document.getElementById(ck).checked==true){
document.getElementById(qtyadminister).required= true;
document.getElementById(qtyadminister).placeholder = "* Required";
document.getElementById(qtyadminister).disabled = false;
}else{
document.getElementById(qtyadminister).required= false;
document.getElementById(qtyadminister).placeholder = "";
document.getElementById(qtyadminister).disabled = true;
}
}

function checkallx(){
if(document.getElementById("checkall").checked == true){check();}else{uncheck();}

var medcount = document.getElementById("medcount");
medcount.innerHTML = "<span class='badge bg-info'><?php echo $i ?></span>";

var i='<?php echo $i ?>';
if(i==0){document.getElementById("checkall").disabled= true;}

var supcount = document.getElementById("supcount");
supcount.innerHTML = "<span class='badge bg-info'><?php echo $ii ?></span>";

var ii='<?php echo $ii ?>';
if(ii==0){document.getElementById("checkalls").disabled= true;}
}

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

var countmed = "<?php echo $i ?>";
for(var z = 1; z <= countmed; z++){
var route = "route"+z;
var freq = "freq"+z;
var qtyadminister = "qtyadminister"+z;

document.getElementById(route).required= true; 
document.getElementById(freq).required= true;
document.getElementById(qtyadminister).required= true;
document.getElementById(route).placeholder = "* Required";
document.getElementById(freq).placeholder = "* Required"; 
document.getElementById(qtyadminister).placeholder = "* Required"; 
document.getElementById(route).disabled = false;
document.getElementById(freq).disabled = false;
document.getElementById(qtyadminister).disabled = false;
   
}
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

var countmed = "<?php echo $i ?>";
for(var z = 1; z <= countmed; z++){
var route = "route"+z;
var freq = "freq"+z;
var qtyadminister = "qtyadminister"+z;

document.getElementById(route).required= false; 
document.getElementById(freq).required= false; 
document.getElementById(qtyadminister).required= false;
document.getElementById(route).placeholder = "";
document.getElementById(freq).placeholder = ""; 
document.getElementById(qtyadminister).placeholder = ""; 
document.getElementById(route).disabled = true;
document.getElementById(freq).disabled = true;
document.getElementById(qtyadminister).disabled = true;
}
}


function checkallxs(){if(document.getElementById("checkalls").checked == true){checks();}else{unchecks();}}
function checks(){
if(!document.forms['arvz'])
return;
var objCheckBoxes = document.forms['arvz'].elements['cks[]'];
if(!objCheckBoxes)
return;
var countCheckBoxes = objCheckBoxes.length;
if(!countCheckBoxes)
objCheckBoxes.checked = true;
else
for(var i = 0; i < countCheckBoxes; i++)
objCheckBoxes[i].checked = true;

var countsup = "<?php echo $ii ?>";
for(var z = 1; z <= countsup; z++){
var qtyadminister = "qtyadministers"+z;
document.getElementById(qtyadminister).required= true;
document.getElementById(qtyadminister).placeholder = "* Required"; 
document.getElementById(qtyadminister).disabled = false;
}
}

function unchecks(){
if(!document.forms['arvz'])
return;
var objCheckBoxes = document.forms['arvz'].elements['cks[]'];
if(!objCheckBoxes)
return;
var countCheckBoxes = objCheckBoxes.length;
if(!countCheckBoxes)
objCheckBoxes.checked = false;
else
for(var i = 0; i < countCheckBoxes; i++)
objCheckBoxes[i].checked = false;

var countsup = "<?php echo $ii ?>";
for(var z = 1; z <= countsup; z++){
var qtyadminister = "qtyadministers"+z;
document.getElementById(qtyadminister).required= false;
document.getElementById(qtyadminister).placeholder = ""; 
document.getElementById(qtyadminister).disabled = true;
}
}
</script>


<?php include "../main/footer.php"; ?>
