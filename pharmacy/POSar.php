

<?php
if(isset($_GET['aremployee'])){$ttype = "EMPLOYEE"; $hhead = "CHARGE TO EMPLOYEE"; $arp="aremployee";}
else{$ttype = "DOCTOR"; $hhead = "CHARGE TO DOCTOR"; $arp="ardoctor";}

//include "pricingscheme_vat.php";
$mm1x = date("M", mktime(0, 0, 0, $mm, 10));
$ipadd = $_SERVER['REMOTE_ADDR'];
$ddx = $dd;

$sql2d = "SELECT * FROM nsauth where username='$userunique' and station='$dept'";
$result2d = $conn->query($sql2d);
while($row2d = $result2d->fetch_assoc()) {
$passwordxx=$row2d['password'];
}

if(isset($_POST['btnpayment'])){
$patientidno1 = $_POST['pname'];
$docname = $_POST['docname'];
list($namex, $patientidno) = explode("_____", $patientidno1);
include "POSsave.php";
}

if(isset($_POST['btnsubmit'])){
$desc = $_POST['desc'];
$qty1 = $_POST['qty'];
$quantity = $_POST['qty22'];
$code = $_POST['code'];
include "POSinsert.php";
}

if(isset($_POST['btnclear'])){
$sql = "delete from poswalkin2 where ipaddress='$ipadd' and ttype='$ttype'";
if($conn->query($sql) === TRUE) {}
echo"<script>window.location='?$arp';</script>";
}

if(isset($_POST['btndel'])){
$id = $_POST['id'];
$sql = "delete from poswalkin2 where ipaddress='$ipadd' and id='$id'";
if($conn->query($sql) === TRUE) {}
echo"<script>window.location='?$arp';</script>";
}

?>




<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item">AR Doctor || AR Employee</li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">


<table width="100%" align="center"><tr><td style="text-align: left;">
<table width="100%" align="center">
<tr><td width="80%" valign="top">

<div class='card'>
<div class='card-body'>

<table width="100%">
<tr>
<td width="40%">
<input type="text" class="form-control" aria-label="Username" oninput="bb(this.value, 'barcode');" onkeypress="return event.charCode >= 48 && event.charCode <= 57" aria-describedby="basic-addon1" name="barcode" id="barcode" placeholder="&#128272; Enter Barcode">
</td><td></td><td valign="">
<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#searchitem" id="searchprod" title="Search Item [ F2 ]"><i class="icofont-search-document"></i></button>
</td>
<td align='right'><h5><b><i class='icofont-ui-cart'></i> <?php echo $hhead ?></b></h5></td>
</tr></table>
</div>

<div id="scroll" style="display: block; height: 380px; overflow-y: scroll;">
<table class="table">
<thead>
<tr>
<th class="text-center" style="background: #5d1537; color: white;" width="10%"><font size="1">Action</th>
<th class="text-center" style="background: #5d1537; color: white;" width="5%"><font size="1">#</th>
<th class="text-center" style="background: #5d1537; color: white;" width="50%"><font size="1">Description</th>
<th class="text-center" style="background: #5d1537; color: white;" width="10%"><font size="1">SRP</th>
<th class="text-center" style="background: #5d1537; color: white;" width="5%"><font size="1">Qty</th>
<th class="text-center" style="background: #5d1537; color: white;" width="10%"><font size="1">Disc</th>
<th class="text-center" style="background: #5d1537; color: white;" width="10%"><font size="1">Total</th>
</tr>
</thead>
<tbody>
<?php
$i = 0; $tot2 = "0.00"; $sc2 = "0.00"; $total = "0.00";
$sqlcc = "SELECT * FROM poswalkin2 where ipaddress='$ipadd' and ttype='$ttype' order by id desc";
$resultcc = $conn->query($sqlcc);
while($rowcc = $resultcc->fetch_assoc()) {
$code=$rowcc['code'];
$desc=$rowcc['desc'];
$srp=$rowcc['sellingprice'];
$qty=$rowcc['qty'];
$sc1=$rowcc['adjustment'];
$tot1=$rowcc['net'];
$id=$rowcc['id'];
$lotno=$rowcc['lotno'];
$disss=$rowcc['dis'];
$uc=$rowcc['unitcost'];
$wvat=$rowcc['wvat'];
if($wvat=="0"){$wvat = "(Vatable)"; $vatcol = 'blue';}else{$wvat = "(Non-Vatable)"; $vatcol = 'red';}
$i++;
$tot2+=$tot1;
$sc2+= $sc1;
$total = $tot2 + $sc2;

$btn="";


if($sc2<=0){$sc2="0.00";}
$val = 'Code: '.$code.'\nDescription '.$desc.'\nUnitcost: '.$uc.'\nLotno: '.$lotno;
if($disss=="Y"){$col="lightyellow";}else{$col="";}
echo "
<tr>
<td style='background: $col;' class='text-center'>
<form method='POST'>
<button name='btndel' class='btn btn-outline-danger btn-sm' style='background: #830d21; color: white; font-size:8px;'><i class='icofont-trash'></i></button>
";
if($i==1){ ?>
<button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#manageqty1" id="manageqty" onclick="myval('<?php echo $code ?>', '<?php echo $desc ?>', '<?php echo $id ?>');" title="Manage Quantity [ Ctrl+4 ]"   style='background: #0a3877; color: white; font-size:8px;'><i class="icofont-pencil"></i></button>
<?php }
echo"
<input type='hidden' name='id' value='$id'>
</form>
</td>
<td style='background: $col;' class='text-center'><font size='1' color='black'>$i</td>
<td style='background: $col;'>"; ?><a href="" onclick="alert('<?php echo $val ?>');"><?php echo"<font size='1' color='black'>$desc</a> <font color='$vatcol' size='1'>$wvat</font></td>
<td style='background: $col;' class='text-center'><font size='1' color='black'>$srp</td>
<td style='background: $col;' class='text-center'><font size='1' color='black'>$qty</td>
<td style='background: $col;' class='text-center'><font size='1' color='black'>$sc1</td>
<td style='background: $col;' class='text-center'><font size='1' color='black'>$tot1</td>
</tr>
";
}
?>
</tbody>
</table>
</div>
<table width='100%'><tr>
<td width='35%'>

<table width="100%">
<tr>
<td>
<form method="POST">
<button style="width: 100%; background: #830d21; color: white;" name="btnclear" id="btnclear" class="btn btn-danger" onclick="return confirm('Are you sure you want to clear the existing transaction?');"><font size="1"><i class="bi bi-slash-circle"></i> CLEAR [ F1 ]</font></button><br>
</form>
</td>
</tr><tr>
<td>
<button class="btn btn-warning" style="width: 100%; background: #9f2c48; color: white;" data-bs-toggle="modal" data-bs-target="#submitreq" onclick="load1('patient'); load2('doctor');"><font size="1"><i class="bi bi-patch-check"></i> SUBMIT [ F10 ]</font></button><br>
</td>
</tr>
</table>


</td>
<td>
<table width="100%">
<tr>
<td style="text-align: left; background: #5d1537; color: white; border-top: 2px solid red;"><font size="2">Cost before discount</font></td>
<td style="text-align: right; background: #5d1537; color: white; text-align: right; border-top: 2px solid red;" width="30%"><font size="2"><b>&#8369;<?php echo $total ?></b></font></td>
<td style="text-align: right; background: #5d1537; color: white; text-align: right; border-top: 2px solid red;"></td>
</tr>
<tr>
<td style="text-align: left; background: #5d1537; color: white;"><font size="2">Discount</font></td>
<td style="text-align: right; background: #5d1537; color: white;"><font size="2"><b>&#8369;<?php echo $sc2 ?></b></font></td>
<td style="text-align: right; background: #5d1537; color: white;"></td>
</tr>
<tr>
<td style="text-align: left; background: #5d1537; color: white; border-bottom: 2px solid red;"><font size="4"><b>Total to Pay</b></font></td>
<td style="text-align: right; background: #5d1537; color: white; border-bottom: 2px solid red;"><font size="4"><b>&#8369;<?php echo $tot2 ?></b></font></td>
<td style="text-align: right; background: #5d1537; color: white; border-bottom: 2px solid red;">&nbsp;</td>
</tr>
</table>
</td>
</tr></table>

</div>

</td>
</tr>
</table>


</div>
</div>





<!-------------------------------------------- Search Item ------------------------------------------->
<div class="modal fade" id="searchitem" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog modal-xl glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> Search item by Description</h5>
<button type="button" class="btn-close" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">

<div class="col-md-12"><div class="form-floating">
<input type="text" class="form-control" name="search_text" id="search_text" onchange="aa()" style="width: 400px;" placeholder="&#128270; Search by Brandname or Generic" class="form-control">
<label for="floatingName">&#128270; Search Item...</label>
</div></div>

<input type="hidden" id="dept" value="<?php echo $dept ?>">

<img style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; margin: auto; width: 400px; display: none;" src="../main/img/loading.gif" id="loading2"></img>

<form method="POST">
<script>
function aa(){
document.getElementById("loading2").style.display="";
var dept = document.getElementById('dept').value;
var str = document.getElementById('search_text').value;
$.get("fetch.php", {str:str, str2:dept},
function (data) {$("#result").html(data); document.getElementById("loading2").style.display="none";});
}
</script>
</form>

<div id="result" style="display: block; height: 420px; overflow-y: scroll;"></div>


</div>
</div>
</div>
</div>
<!---------------------------------------- END Search Item ------------------------------------------->




<!-------------------------------------------- Manage Qty ------------------------------------------->
<div class="modal fade" id="manageqty1" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> Manage QTY</h5>
<button type="button" class="btn-close" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">

<form method="POST">
<table width="100%">
<tr>
<td>Description:</td>
<td><input type="text" name="mydesc" id="mydesc" style="width: 100%;" readonly><input type="hidden" name="mycode" id="mycode" readonly><input type="hidden" name="myid" id="myid" readonly></td>
</tr>
<tr>
<td>Qty:</td>
<td><input type="text" name="myqty" id="myqty" value="1" style="text-align: center; font-size: 55px; background: lightyellow; width: 100%;" class="form-control"></td>
</tr>
<tr>
<td></td>
<td align="right"><button type="submit" name="mysubmit" class="btn btn-primary">Submit</button></td>
</tr>
</table>


</div>
</div>
</div>
</div>
<!---------------------------------------- END Manage Qty ------------------------------------------->


<!-------------------------------------------- SUBMIT REQUEST ------------------------------------------->
<div class="modal fade" id="submitreq" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> Submit request</h5>
<button type="button" class="btn-close" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">

<form method="POST">
<table align="center" width="100%">
<tr><td>


<select class="form-control" onchange="ptid(this.value);" id="select2SinglePlaceholder" required>

<?php
if(isset($_GET['aremployee'])){

echo"<option value=''>Select Employee</option>";
$sqlccv = "SELECT * FROM nsauthemployees order by lastname";
$resultccv = $conn->query($sqlccv);
while($rowccv = $resultccv->fetch_assoc()) {
$lname=$rowccv['lastname'];
$fname=$rowccv['firstname'];
$mname=$rowccv['middlename'];
$name = $lname.", ".$fname." ".$mname;
$ncode=$rowccv['empid'];
$docz = $name."_____".$ncode;
echo"<option value='$docz'>$name</option>";
}

}else{
echo"<option value=''>Select Doctor</option>";
$sqlccv = "SELECT * FROM docfile order by name";
$resultccv = $conn->query($sqlccv);
while($rowccv = $resultccv->fetch_assoc()) {
$name=$rowccv['name'];
$ncode=$rowccv['code'];
$docz = $name."_____".$ncode;
echo"<option value='$docz'>$name</option>";
}
}
?>
</select>


</td></tr>
<tr><td align="right"><button type="submit" name="btnpayment" class="btn btn-primary">Submit</button></td></tr>
</tr>
</table>
<input type='hidden' name='pname' id='pname'>
</form>

</div>
</div>
</div>
</div>
<!---------------------------------------- END SUBMIT REQUEST ------------------------------------------->




</div>
</div>
</section>
</main>


<script>
function payment(val){
var total = document.getElementById("totalamm").value;
var change = parseFloat(val - total).toFixed(2);
document.getElementById("change").value = change;
if(val<=0){document.getElementById("change").value="0.00";}
}


function bb(str2, str){
var dept = "<?php echo $dept ?>";
$.get("../main/functions.php", {str:str, str2:str2, dept:dept},
function (data) {window.location='?pos';});
}

function load1(str){
$.get("../main/functions.php", {str:str},
function (data) {$("#ptid2").html(data);});
}

function load2(str){
$.get("../main/functions.php", {str:str},
function (data) {$("#docid2").html(data);});
}

function load11(str){
$.get("../main/functions.php", {str:str},
function (data) {$("#ptid22").html(data);});
}

function load22(str){
$.get("../main/functions.php", {str:str},
function (data) {$("#docid22").html(data);});
}

document.onkeyup = function(e) {
if (e.which == 112) {document.getElementById("btnclear").click();}
else if (e.ctrlKey && e.which == 49) {document.getElementById("applysenior").click();}//ctrl+1
else if (e.ctrlKey && e.which == 50) {document.getElementById("revertsenior").click();}// ctrl+2
else if (e.which == 113) {document.getElementById("searchprod").click(); setTimeout(displaysearch, 1000);}// f2
else if (e.ctrlKey && e.which == 52) {document.getElementById("manageqty").click();} // ctrl+4
else if (e.which == 115) {document.getElementById("postpayment1").click();} // f4
}
function displaysearch(){document.getElementById("search_text").focus();}



function change() {
var total = document.getElementById("total").value;
var payment = document.getElementById("amountreceive").value;
if(payment == ""){
document.getElementById("change").value = "0";
}else{
document.getElementById("change").value = payment - total;
}
}

function ofr() {
document.getElementById("ofr").value = document.getElementById("orno").value;
}

function ptid(val){
alert(val);
document.getElementById("pname").value = val;
}

function docid(val){
document.getElementById("docname").value = val;
}

function myval(val, val2, val3){
document.getElementById("mycode").value=val;
document.getElementById("mydesc").value=val2;
document.getElementById("myid").value=val3;
}
</script>