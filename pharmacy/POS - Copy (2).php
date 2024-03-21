<style>
.keep-scrolling {
    background-color: #EEE;
    width: 100%;
    overflow-y: scroll; /* Add the ability to scroll the y axis */
    display: block; height: 380px;

    /* Hide the scrollbar for Internet Explorer, Edge and Firefox */
    -ms-overflow-style: none;  /* Internet Explorer and Edge */
    scrollbar-width: none;  /* Firefox */

    /* Hide the scrollbar for Chrome, Safari and Opera */
    &::-webkit-scrollbar {
       display: none;
    }
}
</style>

<body onload="scrolling();">
<?php
//include "pricingscheme_vat.php";
$ddx = $dd;
$mm1x = date("M", mktime(0, 0, 0, $mm, 10));
$ipadd = $_SERVER['REMOTE_ADDR'];
$doc = $_POST['docid2'];
$ptid = $_POST['ptid2'];
list($docid, $docname) = explode("__", $doc);

if($dept=="PHARMACY"){$mydept="CASHIER3";}
elseif($dept=="PHARMACY_OPD"){$mydept="CASHIER2";}
elseif($dept=="CSR2"){$mydept="CASHIER";}


if(isset($_POST['btnnewpatient'])){
$lname = $_POST['lastname'];
$fname = $_POST['firstname'];
$mname = $_POST['middlename'];
$bday = $_POST['birthdate'];
$bdayy = date_create($bday);
$pwd = $_POST['password'];
$bday2 = date_format($bdayy,"M-d-Y");
$gender = $_POST['gender'];
$suffix = $_POST['suffix'];
$discount = $_POST['discount'];
if($discount=="NONE"){$disc="N";}else{$disc="Y";}
$genid = date("YmdHsi");
$patientidno = "WP-".$genid;
$name = $lname.", ".$fname." ".$mname;
$now = time();
$your_date = strtotime($bday);
$datediff = $now - $your_date;
$age = round($datediff / (60*60*24*365));


$sql2d = "SELECT * FROM nsauth where password='$pwd' and station='$dept'";
$result2d = $conn->query($sql2d);
$checkpass = mysqli_num_rows($result2d);

if($checkpass>0) {

$sql = "INSERT INTO `patientprofilewalkin`(`patientidno`, `lastname`, `firstname`, `middlename`, `suffix`, `birthdate`,
`age`, `sex`, `senior`, `patientname`, `dateofbirth`, `type`) VALUES ('$patientidno','$lname','$fname','$mname','$suffix','$bday2',
'$age','$gender','$disc','$name','$bday', CURDATE())";
if($conn->query($sql) === TRUE) {}

}else{echo"<script>alert('Wrong Password! Please try again. thank you!');</script>";}
echo"<script>window.location='?pos';</script>";
}


if(isset($_POST['btnpayment'])){
$patientidno1 = $_POST['pname'];
$docname = $_POST['docname'];
list($namex, $patientidno) = explode("_____", $patientidno1);
$ttype = "PATIENT";
include "POSsave.php";
}

if(isset($_POST['btnpayment2'])){
$patientidno1 = $_POST['pname'];
$docname = $_POST['docname'];
$ofr = $_POST['ofr'];
list($namex, $patientidno) = explode("_____", $patientidno1);
$ttype = "PATIENT";
include "POSsavePayment.php";
}

if(isset($_POST['btnsubmit'])){
$desc = $_POST['desc'];
$qty1 = $_POST['qty'];
$quantity = $_POST['qty22'];
$code = $_POST['code'];
$ttype = "PATIENT";
include "POSinsert.php";
}

if(isset($_POST['mysubmit'])){
$qty1 = $_POST['myqty'];
$code = $_POST['mycode'];
$id = $_POST['myid'];
$ttype = "PATIENT";

$conn->query("delete from poswalkin2 where code='$code' and ipaddress='$ipadd' and id='$id'");
include "POSinsert.php";
}

if(isset($_POST['btnclear'])){
$sql = "delete from poswalkin2 where ipaddress='$ipadd'";
if($conn->query($sql) === TRUE) {}
echo"<script>window.location='?pos';</script>";
}

if(isset($_POST['btndel'])){
$id = $_POST['id'];
$sql = "delete from poswalkin2 where ipaddress='$ipadd' and id='$id'";
if($conn->query($sql) === TRUE) {}
echo"<script>window.location='?pos';</script>";
}

if(isset($_POST['applysenior'])){
$sql2d = "SELECT * FROM poswalkin2 where ipaddress='$ipadd'";
$result2d = $conn->query($sql2d);
while($row2d = $result2d->fetch_assoc()) {
$id=$row2d['id'];
$qty1=$row2d['qty'];
$lotno=$row2d['lotno'];
$unitp=$row2d['unitcost'];
$sellingp=$row2d['sellingprice'];
$codep=$row2d['code'];

$testcode =  "";
$sql2dd = "SELECT * FROM receiving where code='$codep'";
$result2dd = $conn->query($sql2dd);
while($row2dd = $result2dd->fetch_assoc()) {
$testcode=$row2dd['testcode'];
$prodtype = $row2dd['unit'];
}

$datalist = $prodtype."||".$lotno."||".$unitp."||".$sellingp."||".$testcode."||".$qty1;
list($sp, $newgross, $newadj, $newnet, $lessvat, $less) = seniorPOS($datalist);

$lessvat = round($lessvat, 2);
$less = round($less, 2);
$newadj = $lessvat + $less;
$newnet = $newgross - $newadj;


$sqlBB = "update poswalkin2 set gross='$newgross', adjustment='$newadj', net='$newnet', lessvat='$lessvat', less='$less', dis='Y' where id='$id'";
if($conn->query($sqlBB) === TRUE){}
}
echo"<script>window.location='?pos';</script>";
}

if(isset($_POST['revertsenior'])){
$sql2d = "SELECT * FROM poswalkin2 where ipaddress='$ipadd'";
$result2d = $conn->query($sql2d);
while($row2d = $result2d->fetch_assoc()) {
$id=$row2d['id'];
$qty1=$row2d['qty'];
$lotno=$row2d['lotno'];
$unitp=$row2d['unitcost'];
$sellingp=$row2d['sellingprice'];
$codep=$row2d['code'];
$testcode =  "";

$sql2dd = "SELECT * FROM receiving where code='$codep'";
$result2dd = $conn->query($sql2dd);
while($row2dd = $result2dd->fetch_assoc()){
$testcode=$row2dd['testcode'];
$prodtype = $row2dd['unit'];
}


$datalist = $prodtype."||".$lotno."||".$unitp."||".$sellingp."||".$testcode."||".$qty1;
list($sp, $newgross, $newadj, $newnet, $lessvat, $less) = cashPOS($datalist);


$lessvat = round($lessvat, 2);
$less = round($less, 2);
$newadj = $lessvat + $less;
$newnet = $newgross - $newadj;

//echo"<script>alert('SP: $newgross <br> Adj: $newadj <br> Net: $newnet <br> TESTCODE: $testcode');</script>";
$sqlBB = "update poswalkin2 set gross='$newgross', adjustment='$newadj', net='$newnet', dis='N', lessvat='$lessvat', less='$less' where id='$id'";
if($conn->query($sqlBB) === TRUE){}
}
echo"<script>window.location='?pos';</script>";
}
?>




<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?pos">Point of Sale</a></li>
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
<td>


<input type="text" class="form-control" aria-label="Username" name="search_text" id="search_text" onchange="aa()" placeholder="&#128272; Search by Brandname or Generic" style="width:50%;">


<input type="hidden" id="dept" value="<?php echo $dept ?>">

<img style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; margin: auto; width: 200px; display: none;" src="../main/img/loading.gif" id="loading2"></img>

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

<br><div id="result"></div>

</td>
</tr></table>
</div>

<table class="tablex">
<thead>
<tr>
<th class="text-center" style="background: #404a83; color: white;" width="10%"><font size="1">Action</th>
<th class="text-center" style="background: #404a83; color: white;" width="5%"><font size="1">#</th>
<th class="text-center" style="background: #404a83; color: white;" width="50%"><font size="1">Description</th>
<th class="text-center" style="background: #404a83; color: white;" width="10%"><font size="1">SRP</th>
<th class="text-center" style="background: #404a83; color: white;" width="5%"><font size="1">Qty</th>
<th class="text-center" style="background: #404a83; color: white;" width="10%"><font size="1">Disc</th>
<th class="text-center" style="background: #404a83; color: white;" width="10%"><font size="1">Total</th>
</tr>
</thead>
</table>

<div id="scroll" class="keep-scrolling">
<table class="tablex">
<?php
$i = 0; $tot2 = "0.00"; $sc2 = "0.00"; $total = "0.00";
$sqlcc = "SELECT * FROM poswalkin2 where ipaddress='$ipadd' and ttype='PATIENT' order by id desc";
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
<td style='background: $col;' class='text-center' width='10%'>
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
<td style='background: $col;' class='text-center' width='5%'><font size='1' color='black'>$i</td>
<td style='background: $col;' width='50%'>"; ?><a href="" onclick="alert('<?php echo $val ?>');"><?php echo"<font size='1' color='black'>$desc</a> <a href='../pharmacy/viewpricecomputation.php?id=$id' target='_blank'><font color='$vatcol' size='1'>$wvat</font></a></td>
<td style='background: $col;' class='text-center' width='10%'><font size='1' color='black'>$srp</td>
<td style='background: $col;' class='text-center' width='5%'><font size='1' color='black'>$qty</td>
<td style='background: $col;' class='text-center' width='10%'><font size='1' color='black'>$sc1</td>
<td style='background: $col;' class='text-center' width='10%'><font size='1' color='black'>$tot1</td>
</tr>
";
}

?>
</tbody>
</table>
</div>
<table width='100%'><tr>
<td width='40%'>

<table width="100%">
<tr>
<td width="30%">
<form method="POST">
<button style="width: 100%; background: #830d21; color: white;" name="btnclear" id="btnclear" class="btn btn-danger" onclick="return confirm('Are you sure you want to clear the existing transaction?');"><font size="1"><i class="bi bi-slash-circle"></i> CLEAR [ F1 ]</font></button><br>
</form>
</td>

<td width="30%">
<form method="POST">
<button style="width: 100%; background: #0a3877; color: white;" class="btn btn-info" name="applysenior" id="applysenior""><font size="1"><i class="bx bxs-discount"></i> Apply Senior [Ctrl+1]</button>
</form>
</td>


<td width="30%">
<form method="POST">
<button style="width: 100%; background: #7a25a1; color: white;" class="btn btn-warning" name="revertsenior" id="revertsenior"><font size="1"><i class="bx bx-rewind-circle"></i> Revert Senior [Ctrl+2]</button>
</form>
</td>

</tr><tr>

<td>
<button style="width: 100%; background: #10703d; color: white;" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#patientprofile" id="newpatient"><font size="1"><i class="bx bx-rewind-circle"></i> New Patient [ F2 ]</button>
</td>



<td>
<button style="width: 100%; background: #705010; color: white;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#postpayment" id="postpayment1" onclick="getorno('<?php echo $mydept ?>'); load11('patient'); load22('doctor');" disabled><font size="1"><i class="bx bx-rewind-circle"></i> Post Payemnt [ F9 ]</button>
</td>

<td>
<button class="btn btn-warning" style="width: 100%; background: #9f2c48; color: white;" data-bs-toggle="modal" data-bs-target="#submitreq" onclick="load1('patient'); load2('doctor');"><font size="1"><i class="bi bi-patch-check"></i> SUBMIT [ F10 ]</font></button><br>
</td>
</tr>
</table>


</td>
<td>
<table width="100%">
<tr>
<td style="text-align: left; background: #404a83; color: white; border-top: 2px solid red;"><font size="2">Cost before discount</font></td>
<td style="text-align: right; background: #404a83; color: white; text-align: right; border-top: 2px solid red;" width="30%"><font size="2"><b>&#8369;<?php echo $total ?></b></font></td>
<td style="text-align: right; background: #404a83; color: white; text-align: right; border-top: 2px solid red;"></td>
</tr>
<tr>
<td style="text-align: left; background: #404a83; color: white;"><font size="2">Discount</font></td>
<td style="text-align: right; background: #404a83; color: white;"><font size="2"><b>&#8369;<?php echo $sc2 ?></b></font></td>
<td style="text-align: right; background: #404a83; color: white;"></td>
</tr>
<tr>
<td style="text-align: left; background: #404a83; color: white; border-bottom: 2px solid red;"><font size="4"><b>Total to Pay</b></font></td>
<td style="text-align: right; background: #404a83; color: white; border-bottom: 2px solid red;"><font size="4"><b>&#8369;<?php echo $tot2 ?></b></font></td>
<td style="text-align: right; background: #404a83; color: white; border-bottom: 2px solid red;">&nbsp;</td>
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






<!-------------------------------------------- Patient Profile ------------------------------------------->
<div class="modal fade" id="patientprofile" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> New Patient</h5>
<button type="button" class="btn-close" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">

<form method="POST">
<table align="center" width="100%">
<tr>
<td width="20%">LASTNAME</td>
<td><input type="text" name="lastname" class="inplistx" required></td>
</tr>
<tr><th colspan="2">&nbsp;</th></tr>
<tr>
<td>FIRSTNAME</td>
<td><input type="text" name="firstname" class="inplistx" required></td>
</tr>
<tr><th colspan="2">&nbsp;</th></tr>
<tr>
<td>MIDDLENAME</td>
<td><input type="text" name="middlename" class="inplistx"></td>
</tr>
<tr><th colspan="2">&nbsp;</th></tr>
<tr>
<td>SUFFIX</td>
<td><input type="text" name="suffix" placeholder="e.g. JR." class="inplistx"></td>
</tr>
<tr><th colspan="2">&nbsp;</th></tr>
<tr>
<td>BIRTHDATE</td>
<td><input type="date" name="birthdate" value="<?php echo date('Y-m-d'); ?>" class="inplistx"></td>
</tr>
<tr><th colspan="2">&nbsp;</th></tr>
<tr>
<td>GENDER</td>
<td>
<select name="gender" class="inplistx">
<option value="M">MALE</option>
<option value="F">FEMALE</option>
</select>
</td>
</tr>
<tr><th colspan="2">&nbsp;</th></tr>
<tr>
<td>DISCOUNT</td>
<td>
<select name="discount" class="inplistx">
<option value="NONE">NONE</option>
<option value="SENIOR">SENIOR</option>
<option value="PWD">PWD</option>
</select>
</td>
</tr>
<tr><th colspan="2">&nbsp;</th></tr>
<tr>
<td>PASSWORD</td>
<td><input type="password" name="password" style="background-color: lightyellow;" class="inplistx" required></td>
</tr>
</table>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="submit" name="btnnewpatient" class="btn btn-primary">Save changes</button>
</form>
</td><tr></table>

</div>
</div>
</div>
</div>
<!--------------------------------------- END Patient Profile ------------------------------------------->


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
</form>

</div>
</div>
</div>
</div>
<!---------------------------------------- END Manage Qty ------------------------------------------->


<!-------------------------------------------- SUBMIT REQUEST ------------------------------------------->
<div class="modal fade" id="submitreq" role="dialog" data-bs-backdrop="static">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> Submit request</h5>
<button type="button" class="btn-close" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">

<form method="POST">
<table align="center" width="100%">
<tr><td><select class="form-control select2-single" name="pname" id="ptid2" onchange="ptid(this.value);" style="width: 100%;" required></select></td></tr>
<tr><td><select class="form-control" name="docname" id="docid2" style="width: 100%;" required></select></td></tr>
<tr><td align="right"><button type="submit" name="btnpayment" class="btn btn-primary">Submit</button></td></tr>
</tr>
</table>
</form>

</div>
</div>
</div>
</div>
<!---------------------------------------- END SUBMIT REQUEST ------------------------------------------->

<!-------------------------------------------- Post Payment ------------------------------------------->
<div class="modal fade" id="postpayment" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> Post Payment</h5>
<button type="button" class="btn-close" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">

<form method="POST">
<table align="center" width="100%">
<tr><td><select class="form-control" name="pname2" id="ptid22" onchange="ptid(this.value);" style="width: 100%;" required></select></td></tr>
<tr><td><select class="form-control" name="docname2" id="docid22" style="width: 100%;" required></select></td></tr>
<tr><td>Or Number:<br><input type="text" name="ofr" id="orno" value="<?php echo $orno ?>" class="form-control"></td></tr>
<tr><td>Total:<br><input type="text" name="totalamm" id="totalamm" value="<?php echo $tot2 ?>" style="text-align: center; font-size: 30px;" class="form-control" readonly></td></tr>
<tr><td>Amount Received:<br><input type="text" name="ammreceived" id="ammreceived" oninput="payment(this.value);" style="text-align: center; font-size: 40px; background: lightyellow;" class="form-control"></td></tr>
<tr><td>Change:<br><input type="text" name="change" id="change" value="0.00" style="text-align: center; font-size: 30px; background: #e51d1d; color: white;" class="form-control" readonly></td></tr>
<tr><td align="right"><button type="submit" name="btnpayment2" class="btn btn-primary">Post Payment</button></td></tr>
</tr>
</table>
</form>

</div>
</div>
</div>
</div>
<!---------------------------------------- END Post Payment ------------------------------------------->



</div>
</div>
</section>
</main>



<script>
function getorno(val){
var str = "get_orno";
$.get("../main/functions.php", {str:str, dept:val},function(data) {document.getElementById("orno").value=data;});
}

function payment(val){
var total = document.getElementById("totalamm").value;
var change = parseFloat(val - total).toFixed(2);
document.getElementById("change").value = change;
if(val<=0){document.getElementById("change").value="0.00";}
}


function scrolling(){
var myDiv = document.getElementById("scroll");
myDiv.scrollTop = myDiv.scrollHeight;
document.getElementById("barcode").focus();
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
//alert(val);
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
