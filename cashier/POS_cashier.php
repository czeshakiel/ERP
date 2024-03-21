<style>
.font1 {font-family: Lucida Console, Courier New, monospace; font-size: 13px; color: black;}
.font2 {font-family: Ariel, Helvetica, sans-serif;}
.font3 {font-family: Times New Roman, Times, serif; font-size: 15px; color: black;}
.font4 {font-family: Times New Roman, Times, serif; font-size: 12px; color: black;}
.colred {background: red;}
.tablex {
  border-collapse: separate;
  border-spacing: 0;
  width: 100%;
  

}
.tablex tr th,
.tablex tr td {
  border-right: 1px solid #bbb;
  border-bottom: 1px solid #bbb;
  padding: 5px;
  text-align: left;
  /*font-family: "Arial", Arial, San-serif;*/
    font-family: Arial, Helvetica, sans-serif;
}
.tablex tr th:first-child,
.tablex tr td:first-child {
  border-left: 1px solid #bbb;
}
.tablex tr th {

  border-top: 1px solid #bbb;
  text-align: left;
}

/* top-left border-radius */
.tablex tr:first-child th:first-child {
  border-top-left-radius: 6px;
}

/* top-right border-radius */
.tablex tr:first-child th:last-child {
  border-top-right-radius: 6px;
}

/* bottom-left border-radius */
.tablex tr:last-child td:first-child {
  border-bottom-left-radius: 6px;
}

/* bottom-right border-radius */
.tablex tr:last-child td:last-child {
  border-bottom-right-radius: 6px;
}
}

</style>
<?php echo"<html><body onload='getdisc();'></body></html>"; ?>
<?php
error_reporting(1);
if($dept == "cashier2" or $dept == "CASHIER2"){$readonly = "";}else{$readonly = "readonly";}
$caseno = $_GET['caseno'];
$productsubtype = $_GET['productsubtype'];
$batchnoxx = $_GET['batchno'];
$datex = date("Y-m-d");
$ipx=$_SERVER['REMOTE_ADDR'];
$cksenior = 0;


if(isset($_POST['btnup'])){
$myrefno = $_POST['irefno'];
$mycaseno = $_POST['icaseno'];
$amm = $_POST['newamount'];
$mytype = $_POST['mytype'];
$myamount = $_POST['myamount'];

$ss = $conn->query("select * from admission a, patientprofile p where a.patientidno=p.patientidno and a.caseno='$mycaseno'");
while($ss1 = $ss->fetch_assoc()){$sen = $ss1['senior'];}

if($sen=="Y"){
$gross = $amm - ($amm*0.20);
$adj = $amm*0.20;
}else{
$gross = $amm;
$adj = 0;
}

$conn->query("update productout set sellingprice='$amm', gross='$gross', adjustment='$adj', excess='$gross' where refno='$myrefno' and caseno='$mycaseno'");
$conn->query("INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('Update amount of [$myrefno - $mytype] from $myamount to $amm', '$user', CURDATE(), CURTIME())");
echo"<script>alert('Successfully Updated!'); window.location='?outpatientdetail&caseno=$caseno&batchno=$batchnoxx&productsubtype=$productsubtype';</script>";
}



$sqlnamex = "select * from admission, patientprofile where admission.patientidno=patientprofile.patientidno and admission.caseno='$caseno'";
$sqlname1x = $conn->query($sqlnamex);
$checkk = mysqli_num_rows($sqlname1x);

$sqlnamexx = "select * from admission, nsauthemployees where admission.patientidno=nsauthemployees.empid and admission.caseno='$caseno'";
$sqlname1xx = $conn->query($sqlnamexx);
$checkk2 = mysqli_num_rows($sqlname1xx);

if($checkk>0){$loading = "select * from admission, patientprofile where admission.patientidno=patientprofile.patientidno and admission.caseno='$caseno'";}
elseif($checkk2>0){$loading = "select * from admission, nsauthemployee where admission.patientidno=nsauthemployee and admission.caseno='$caseno'";}
else{$loading = "select * from admission, patientprofilewalkin where admission.patientidno=patientprofilewalkin.patientidno and admission.caseno='$caseno'";}

$sqlname = "$loading";
$sqlname1 = $conn->query($sqlname);
while($name = $sqlname1->fetch_assoc()){
$pname=utf8_encode($name['patientname']);
$room=$name['room'];
$ward=$name['ward'];
$dob=$name['dateofbirth'];
$sex=$name['sex'];
if($ward=="in"){ $bt_sub = "inpatient"; }else{$bt_sub = "outpatient";}
if($sex=="Male" or $sex=="M"){$avat = "boy.png";}else{$avat="girl.png";}
}

// --------------------------------------------->>>>>>>>
$profile2 = $conn->query("select * from admission where caseno='$caseno'");
while($prof = $profile2->fetch_assoc()){$rem = $prof['remarks']; $ptid = $prof['patientidno'];}

$profile22= $conn->query("select * from patientprofile where patientidno='$ptid'");
while($prof22 = $profile22->fetch_assoc()){$senior = $prof22['senior'];}

if(strpos($caseno, "WPOS") !== false){$senior=$rem;}

if($senior=="N"){$ss = "<label class='label'>NONE SENIOR/PWD</label>"; $ss2="NON SENIOR"; $ss3="SENIOR/PWD";}
else{
// ------------ get age ------
$now = time();
$your_date = strtotime($dob);
$datediff = $now - $your_date;
$age = floor($datediff / (60*60*24*365));
// ---------------------------
if($age>59){$ss = "<label class='label2'>PWD PATIENT</label>"; $dd2="PWD"; $ss3="NON PWD";}else{$ss = "<label class='label2'>SENIOR PATIENT</label>"; $ss2="SENIOR"; $ss3="NON SENIOR";}
}
// --------------------------------------------->>>>>>>>


$sql22j = "SELECT * from orno_series where status='Active' and dept='$dept'";
$result22j = $conn->query($sql22j);
while($row22j = $result22j->fetch_assoc()) {
$orno_id=$row22j['id'];
$active_or = $row22j['orno'];
}

$sql22jj = "SELECT * from orno_used where orseries='$orno_id'";
$result22jj = $conn->query($sql22jj);
$orseries = mysqli_num_rows($result22jj);

if($orseries>0){
$sql22jjj = "SELECT max(or_used) as maxor from orno_used where orseries='$orno_id'";
$result22jjj = $conn->query($sql22jjj);
while($row22jjj = $result22jjj->fetch_assoc()) {
$maxor=$row22jjj['maxor'];
}
$orno = $maxor+1;
}else{$orno = $active_or;}


if(isset($_POST['btn_submit'])){
$dis = $_POST['dis'];
$ofr = $_POST['orno'];
$nursename = $user;
$paymenttype = $_POST['paymenttype'];
$sukicard = $_POST['sukicard'];
$transactions = $_POST['transactions'];
$specialdisc = $_POST['specialdisc'];
$specialdisctype = $_POST['specialdisctype'];
$_SESSION['caseno'] = $caseno;

$sql22jjx = "SELECT * from collection where ofr='$ofr'";
$result22jjx = $conn->query($sql22jjx);
$xxd = mysqli_num_rows($result22jjx);

if($xxd>0){$ofr = $ofr."-0";}
//if($xxd>0){echo "<script>alert('OR number is already used!')</script>";}
//else{
echo"
<script>
let a=document.createElement('a');
a.target='_blank';
a.href='save_collection.php?orno=$ofr&nursename=$nursename&paymenttype=$paymenttype&caseno=$caseno&dis=$dis&mm=$mm&dd=$dd&yy=$yy&sukicard=$sukicard&transactions=$transactions&specialdisc=$specialdisc&specialdisctype=$specialdisctype&orseries=$orno_id$datax';
a.click();

window.location= 'index.php?main&mm=$mm&dd=$dd&yy=$yy&username=$nursename&userunique=$userunique&dept=$dept&branch=$branch';
</script>
";
exit();
//}
}



$sqla1a = "delete from collection_temp where ip='$ipx'";
if ($conn->query($sqla1a) === TRUE) {}

if($senior=="N"){$warning = "Despite not being registered as a PWD/Senior, the system detected that you have a PWD/Senior discount on certain items.";}
else{$warning = "Despite the fact that you are listed as a PWD/Senior, the system discovered that you do not have a PWD/Senior discount on some items.";}
?>

<!------------------------------------------------------- DESIGN --------------------------------------------->

<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item">Payment Details</a>
</nav>
</div><!-- End Page Title -->

<div class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none;" id="idwarning">
<strong><i class="icofont-warning"></i> WARNING!</strong> <?php echo $warning ?> <a href=""><b><u>Update Here</u></b></a>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<div class="col">
<div class="card teacher-card">
<div class="card-body  d-flex">
<div class="profile-av pe-xl-4 pe-md-2 pe-sm-4 pe-4 text-center w220">
<img src='../main/img/<?php echo $avat ?>' width='70' height='70' style='border-radius: 50%;'>

</div>
<div class="teacher-info border-start ps-xl-4 ps-md-3 ps-sm-4 ps-4 w-100">
<table width="100%"><tr>
<td width="80%">
<h6  class="mb-0 mt-2  fw-bold d-block fs-6"><?php echo strtoupper($pname) ?></h6>
<span class="py-1 fw-bold small-11 mb-0 mt-1"><?php echo $address ?></span>
<br><font size='1%'><i class="icofont-finger-print"></i> Caseno: <b><?php echo $caseno ?></b> || <i class="icofont-patient-bed"></i> Room: <b><?php echo $room ?></b> || <i class="icofont-stretcher"></i> PATIENT TYPE: <b><?php echo $ss ?></b></font>
</td>
</tr>
</table>

</div>
</div>
</div>
</div><br>

<form name ="arvz" method="POST">



<input type="hidden" name="orseries" value="<?=$orno_id;?>">
<table width="100%"><tr><td width="73%" valign="TOP">

<div id="scroll" style="display: block; height: 450px; overflow-y: scroll;">
<table width="100%" align="center">
<tr>
<td valign="top" style="text-align: center;">

<ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
<li class="nav-item" role="presentation">
<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-home" type="button" role="tab" aria-controls="home" aria-selected="true" style="font-size: 13px;"><b>BATCH <?php echo $batchnoxx ?></b></button>
</li>

<li class="nav-item flex-fill" role="presentation">
<button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-profile" type="button" role="tab" aria-controls="profile" aria-selected="false" style="font-size: 13px;"><b>OTHER PENDING REQUEST</b></button>
</li>
</ul>

<div class="tab-content pt-2" id="borderedTabJustifiedContent">
<div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel" aria-labelledby="home-tab">
<?php
$sql22f = "select count(acctname) as cc from collection  where  type='pending' and amount > 0 and acctno='$caseno'";
$result22f = $conn->query($sql22f);
while($row22f = $result22f->fetch_assoc()) {$cc=$row22f['cc'];}
if($productsubtype=="001-HOSPITALBILL" or $productsubtype=="HOSPITALBILL" or $productsubtype=="HOSPITAL BILL" or $productsubtype=="PROFESSIONAL FEE" or $productsubtype=="" or $productsubtype=="CERTIFICATION FEE" or isset($_GET['collection'])){ 
include "POS_CASHIER/collection.php";}
else{include "POS_CASHIER/productout.php"; }
?>
</div>
<div class="tab-pane fade" id="bordered-justified-profile" role="tabpanel" aria-labelledby="profile-tab">
<?php include "POS_CASHIER/others.php"; ?>
</div>
</div>

<?php
if($cksenior>0){echo"<script>document.getElementById('idwarning').style.display='';</script>";}
else{echo"<script>document.getElementById('idwarning').style.display='none';</script>";}
?>
		
</td>



</tr>
</table>
</div>

</td><td width="1%"></td><td valign="TOP">

<div class="dd-handle">
<div class="task-info d-flex align-items-center justify-content-between">
<h6 class="light-info-bg py-1 px-2 rounded-1 d-inline-block fw-bold small-14 mb-0"><i class="icofont-credit-card"></i> Payment Details</h6>
<div class="task-priority d-flex flex-column align-items-center justify-content-center">
<span class="badge bg-warning text-end mt-1">Inprogress</span>
</div>
</div>

&nbsp;

<?php
echo"
<div class='timeline-item ti-danger border-bottom ms-2' style='padding: 5px;'>
<div class='d-flex' style='width: 100%;'>
<span class='avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg'><i class='icofont-chart-growth'></i></span>
<div class='flex-fill ms-3'>
<table width='100%'>
<tr><td style='font-size: 11px; color: #5A91DC;'>GROSS</td></tr>
<tr><td style='text-align: right;'><i class='icofont-peso'></i><b id=gross>$gross2</b></td></tr>
</table>
</div>
</div>
</div> <!-- timeline item end  -->


<div class='timeline-item ti-danger border-bottom ms-2' style='padding: 5px;'>
<div class='d-flex' style='width: 100%;'>
<span class='avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg'><i class='icofont-dollar-minus'></i></span>
<div class='flex-fill ms-3'>
<table width='100%'>
<tr><td style='font-size: 11px; color: #5A91DC;'>LESS VAT</td></tr>
<tr><td style='text-align: right;'><i class='icofont-peso'></i><b id='lessvat'>0.00</b></td></tr>
</table>
</div>
</div>
</div> <!-- timeline item end  -->


<div class='timeline-item ti-danger border-bottom ms-2' style='padding: 5px;'>
<div class='d-flex' style='width: 100%;'>
<span class='avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg'><i class='icofont-wheelchair'></i></span>
<div class='flex-fill ms-3'>
<table width='100%'>
<tr><td style='font-size: 11px; color: #5A91DC;'>Less Senior/PWD</td></tr>
<tr><td style='text-align: right;'><i class='icofont-peso'></i><b id='lesssenior'>0.00</b></td></tr>
</table>
</div>
</div>
</div> <!-- timeline item end  -->


<div class='timeline-item ti-danger border-bottom ms-2' style='padding: 5px;'>
<div class='d-flex' style='width: 100%;'>
<span class='avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg'><i class='icofont-bill'></i></span>
<div class='flex-fill ms-3'>
<table width='100%'>
<tr><td style='font-size: 11px; color: #5A91DC;'>Sub-Total</td></tr>
<tr><td style='text-align: right;'><i class='icofont-peso'></i><b id='subtotal'>$gross3</b></td></tr>
</table>
</div>
</div>
</div> <!-- timeline item end  -->


<div class='timeline-item ti-danger border-bottom ms-2' style='padding: 5px;'>
<div class='d-flex' style='width: 100%;'>
<span class='avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg'><i class='icofont-law-alt-1'></i></span>
<div class='flex-fill ms-3'>
<table width='100%'>
<tr><td style='font-size: 11px; color: #5A91DC;'>NET (Less SPECIAL DISC)</td></tr>
<tr><td style='text-align: right;'><i class='icofont-peso'></i><b id='mynet'>NO DISC</b></td></tr>
</table>
</div>
</div>
</div> <!-- timeline item end  -->
";
?>
<br>

<table width="100%">
<tr><td><button type="button" id="btnpayment" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#requestreturn2" style="width: 100%;"><i class="icofont-coins"></i> Payment [Ctrl + 1]</button></td></tr>
<tr><td><button type="button" class="btn btn-warning" style="width: 100%;" onclick="location.reload();"><i class="icofont-refresh"></i> Refresh [Ctrl + 2]</button></td></tr>
<tr><td><button type="button" class="btn btn-danger data-bs-toggle="modal" data-bs-target="#requestreturn2" style="width: 100%;"><i class="icofont-close-circled"></i> Close [Ctrl + 3]</button></td></tr>
</table>
</div>

</td></tr></table>



<!-------------------------------------------- RETURN MED/SUP ------------------------------------------->
<div class="modal fade" id="requestreturn2" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog" style="box-shadow: 0px 0px 2000px #6e7fcb;">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="icofont-coins"></i> PAYMENT DETAILS</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">



<?php if($gross2=="" or $gross2=="0") {$gross2="0";} ?>
<?php if($gross3=="" or $gross3=="0") {$gross3="0";} ?>
<?php if($adj=="" or $adj=="0") {$adj="0";} ?>

<input type="hidden" name="net22" value="<?php echo $gross3 ?>">
<input type="hidden" name="disc22" value="<?php echo $adj ?>">


<table width="100%" style="border-collapse: collapse;">
<tr>
<td><font style="font-size:12px;">ORNO:</font><input type="text" name="orno" value="<?php echo $orno ?>" class="form-control" <?php echo $readonly ?>></td>
<td><font style="font-size:12px;">Enter Loyalty Card Number [if any]:</font> <input type="text" name="sukicard" id="hcn" class="form-control" onchange="checkCaseno(this.value); sukiDiscount(<?=$suk;?>,<?=$sukidisc;?>);"></td>
</tr>


<tr>
<td>
<font style="font-size:12px;">TYPE:</font>
<select name="transactions" onclick="myFunction(this.value);" class="form-select">
<option value="cash">CASH</option>
<option value="check">CHECK</option>
<option value="card">DEBIT/CREDIT CARD</option>
<option value="loyaltycard">LOYALTY-CARD</option>
</select>

<input type="hidden" name="total_price" value="<?php echo $gross2 ?>" readonly="readonly" style="width:100%; background-color: lightyellow;">
<input type="hidden" name="total_price2" value="<?php echo $gross3 ?>" readonly="readonly" style="width:100%; background-color: lightyellow;">
<input type="hidden" name="dis" value="<?php echo $adj ?>" oninput="diss(this.value)" style="width:100%" <?php echo $action ?>>
<input type="hidden" name="distype" value="<?php echo $distypeval ?>">
<input type="hidden" name="caseno" value="<?php echo $caseno ?>">
<input type="hidden" name="mm" value="<?php echo $mm ?>">
<input type="hidden" name="dd" value="<?php echo $dd ?>">
<input type="hidden" name="yy" value="<?php echo $yy ?>">

<input type="hidden" name="userunique" value="<?php echo $userunique ?>">
<input type="hidden" name="branch" value="<?php echo $branch ?>">
<input type="hidden" name="dept" value="<?php echo $dept ?>">
<input type="hidden" name="bt_sub" value="<?php echo $bt_sub ?>">
<input type="hidden" name="orseries" value="<?php echo $orno_id ?>">


</td><td>

<?php
$sqlCheckSenior=mysqli_query($conn,"SELECT pp.senior FROM patientprofile pp INNER JOIN admission a ON a.patientidno=pp.patientidno WHERE a.caseno='$caseno' AND pp.senior='Y'");
if(mysqli_num_rows($sqlCheckSenior)>0){
$sukidisc=$gross3;
$suk=($gross3-$sukidisc)+$adj;
}else{
$sukidisc=($gross3/1.05);
$suk=($gross3-$sukidisc)+$adj;
}
?>
<font style="font-size:12px;">SPECIAL DISC:</font>
<select name="specialdisctype" id="specialdisc" onchange="sd(this.value);" class="form-select">
<option value="NONE">NONE</option>
<option value="ADD-ONS">ADD-ONS (%)</option>
<option value="OVERRIDING">OVERRIDING (%)</option>
<option value="OVERRIDINGAMOUNT">OVERRIDING (Amount)</option>
</select>
</td>
</tr>

<tr>
<td colspan="2">

<div id="myDIV" style="display: none;">
<hr>
CC NO:<br><input type="text" name="ccno" value="" style="width:100%; text-align:center; background: #e4e9f6;" class="form-control">
BANK:<br>
<input list="ptid" name="bank" style="width:100%; text-align:center; background: #e4e9f6;" class="form-control">
<datalist id="ptid">
<option value='METROBANK'></option>
<option value='UCPB'></option>
<option value='AUB'></option>
<option value='CHINABANK'></option>
<option value='BDO'></option>
</datalist>

CCNAME:<br><input type="text" name="ccname" value="<?php echo $pname ?>" style="width:100%; text-align:center; background: #e4e9f6;" class="form-control">
<hr>
</div>


<div id="myDIV2" style="display: none;"><hr>
LC No.:<br><input type="text" name="lcno" value="" style="width:100%; text-align:center; background: #daf6e2;" class="form-control" id="hcn2" onchange="loadloyalty(this.value);">
EARNED POINTS:<br><input type="text" name="lcpoint" value="" id='lcpoint' style="width:100%; text-align:center; background: #daf6e2;" class="form-control" readonly>
<hr></div>


<div id="aaax" style="display: none;">
<hr>
<table width="100%"><tr>
<td><font color="black">ENTER DISC <i id='disc1'></i>: <br>
<input type="text" name="specialdisc" id="mydis1" oninput="specialdiscx(this.value)" placeholder="" style="width:100%; text-align:center; background: #f7e8e1;" class="form-control">
<input type="text" name="specialdisc2" id="mydis2" oninput="specialdiscx(this.value)" placeholder="" style="width:100% text-align:center; background: #f7e8e1;" class="form-control">
</td>
</tr></table>
<hr>
</div>


</td>
</tr>

<tr>
<td colspan='2'><font style="font-size:12px;">AMOUNT :</font> <input type="text" name="ar" id="ar" oninput="tot(this.value)" style="font-size: 30px; text-align: center; width: 100%;" required></td>
</tr>
<tr>
<td colspan='2'><font style="font-size:12px;">CHANGE :</font><input type="text" name="change" id="change" value="0" style="text-align: center; font-size:30px; width:100%;" readonly></td>
</tr>
</table><br>
<p align="right"><button type="submit" class="btn btn-primary" name="btn_submit" style="width: 50%;"><i class="bi bi-eye"></i> Post Payment</button></p>
<br>




</div>
</div>
</div>
</div>
<!---------------------------------------- END RETURN MED/SUP ------------------------------------------->
</form>



</div>
</div>
</div>
</div>
</section>
</main>


<style>
  .my-swal {
  width: 50%;
}
</style>
<?php
$cksen = $conn->query("select * from collection_temp where branch!='$senior'");
if(mysqli_num_rows($cksen)==0){

echo"
<script>window.onload = function() { $('#exampleModal').modal('show');}</script>

<div class='modal fade' id='exampleModal' tabindex='-1' data-bs-backdrop='static'>
<div class='modal-dialog modal-dialog-centered'>
<div class='modal-content'>
<div class='modal-header'>
<h5 class='modal-title'><i class='icofont-warning'></i> ALERT!</h5>

</div>
<div class='modal-body'>
<table align='center'><tr><td><img src='../main/img/question.gif'></td></tr></table>
<font color='black'>The patient status is <b>$ss2</b>, but the system has detected that there are requests that require <b>$ss3</b> computation. Do you want to override the computation as <b>$ss2</b>?</font>
</div>
<div class='modal-footer'>
<a href=''><button type='button' class='btn btn-secondary' data-dismiss='modal' style='background: #0a3877; color: white;'><i class='icofont-exclamation-circle'></i> Retain as $ss3</button></a>
<a href=''><button type='submit' name='btnnewpatient' class='btn btn-danger' style='background: #830d21; color: white;'><i class='icofont-exchange'></i> Overide as $ss2</button></a>
</div>
</div>
</div>
</div>

";
}

?>


<form method="POST">
<div class="modal fade" id="exampleModal22cc" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog modal-xs glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><b><i class="icofont-finger-print"></i> <i id='myname'></i></b></h5>
<button type="button" class="btn-close btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<table width="100%" align="center">
<tr>
<td>Refno:</td>
<td>
<input type="text" id="myrefno" name="irefno" class="form-control" readonly>
<input type="hidden" id="mycaseno" name="icaseno">
</td>
<tr>
<tr>
<td>Type:</td>
<td><input type="text" id="mytype" name="mytype" class="form-control" readonly></td>
<tr>
<tr>
<td>Amount:</td>
<td><input type="text" id="myamount" name="myamount" class="form-control" readonly></td>
<tr>
<tr>
<td>NEW Amount:</td>
<td><input type="text" name="newamount" style="background: lightyellow;" class="form-control" required></td>
<tr>
<tr>
<td></td>
<td align="right"><button type="submit" name="btnup" class="btn btn-danger"><i class="fa fa-edit"></i> UPDATE</button></td>
<tr>
</table>

</div>
</div>
</div>
</div>
</form>


<script>
function myacc(refno, type, amm, name, caseno){
document.getElementById("myrefno").value = refno;
document.getElementById("mycaseno").value = caseno;
document.getElementById("mytype").value = type;
document.getElementById("myamount").value = amm;
document.getElementById("myname").innerHTML = name;
}
</script>


<!-- swal('Cancelled', 'Status is retain as $ss3', 'info'); -->


<!-- CheckBox Auto Sum -->

<script type = "text/javascript">

//------------------------------ CAL ------------------------
function cal(val,val_id,num,netx,nana){
var checkBox = document.getElementById(val_id);
var p1= eval(arvz.total_price.value)
var p2= eval(arvz.dis.value)
var net= eval(arvz.total_price2.value)

if(checkBox.checked==true){
p1 += eval(val);
p2 += eval(num);
net += eval(netx);
var nanx = nana;
$.ajax({
url: 'add.php',
type: 'post',
data: { "callFunc1": nanx},
success: function(response) { console.log(response); getdisc();}
});
}else{
var nanx = nana;
p1 -=eval(val);
p2 -= eval(num);
net -= eval(netx);
$.ajax({
url: 'remv.php',
type: 'post',
data: { "callFunc1": nanx},
success: function(response) { console.log(response); getdisc();}
});
}

arvz.total_price.value = eval(p1)
arvz.total_price2.value = eval(net)
arvz.dis.value = eval(p2)
arvz.disc22.value = eval(p2);
arvz.net22.value = eval(net);

document.getElementById("gross").innerHTML = eval(p1);
document.getElementById("subtotal").innerHTML = eval(net);
getdisc();
}
//-------------------------- END CAL ------------------------


function getdisc(){$.get("getdiscount.php", {},function (data) {const myArray = data.split(" "); $("#lesssenior").html(myArray[1]); $("#lessvat").html(myArray[0]);});}


// ----------------------- TOT -----------------------------
function tot(amm){
if(document.getElementById("mynet").innerHTML == "NO DISC"){
var gross = document.getElementById("subtotal").innerHTML;
}
else{var gross = document.getElementById("mynet").innerHTML;}
gross = parseFloat(gross);
if(amm<=0){amm = gross;}
var change = amm - gross;
arvz.change.value = eval(change)
}
// ------------------- END TOT -----------------------------


// ----------------------- DISS -----------------------------
function diss(disxx){
var gross= eval(arvz.total_price.value)
var dis= eval(arvz.dis.value)
var distype= arvz.distype.value
if(dis == "") { dis = "0"; }
if(distype=="AMOUNT") {dis = dis;}
else {dis = (dis / 100) * gross;}
var net = gross - dis;
arvz.total_price2.value = eval(net)
}
// ------------------- END DISS -----------------------------


// ----------------------- SD -----------------------------
function sd(vall){
var gross = <?php echo $gross3 ?>;
if(vall=="OVERRIDING"){
document.getElementById("aaax").style.display = "block";
var gross = document.getElementById("subtotal").innerHTML;
var vat = document.getElementById("lessvat").innerHTML;
var sen = document.getElementById("lesssenior").innerHTML;
var newgross = parseFloat(gross) + parseFloat(sen) + parseFloat(vat);
document.getElementById("mynet").innerHTML = "0.00";
document.getElementById("subtotal").innerHTML = newgross;
document.getElementById("lessvat").innerHTML ="0.00";
document.getElementById("lesssenior").innerHTML = "0.00";
document.getElementById("disc1").innerHTML = "(Percentage only [%])";

document.getElementById("mydis1").style.display = "";
document.getElementById("mydis2").style.display = "none";
}

else if(vall=="ADD-ONS"){
document.getElementById("aaax").style.display = "block";
var gross = document.getElementById("gross").innerHTML;

$.get("getdiscount.php", {},function (data){
const myArray = data.split(" ");
$("#lesssenior").html(myArray[1]);
$("#lessvat").html(myArray[0]);
$("#subtotal").html(parseFloat(gross)-(parseFloat(myArray[0])+parseFloat(myArray[1])));
});

document.getElementById("disc1").innerHTML = "(Percentage only [%])";
document.getElementById("mydis1").style.display = "";
document.getElementById("mydis2").style.display = "none";
}

else if(vall=="OVERRIDINGAMOUNT"){
  document.getElementById("aaax").style.display = "block";
var gross = document.getElementById("subtotal").innerHTML;
var vat = document.getElementById("lessvat").innerHTML;
var sen = document.getElementById("lesssenior").innerHTML;
var newgross = parseFloat(gross) + parseFloat(sen) + parseFloat(vat);
document.getElementById("mynet").innerHTML = "0.00";
document.getElementById("subtotal").innerHTML = newgross;
document.getElementById("lessvat").innerHTML ="0.00";
document.getElementById("lesssenior").innerHTML = "0.00";
document.getElementById("disc1").innerHTML = "(Amount)";

document.getElementById("mydis1").style.display = "none";
document.getElementById("mydis2").style.display = "";

}

else{
document.getElementById("mynet").innerHTML = "NO DISC";
document.getElementById("aaax").style.display = "none";
var gross = document.getElementById("gross").innerHTML;
$.get("getdiscount.php", {},function (data){
const myArray = data.split(" ");
$("#lesssenior").html(myArray[1]);
$("#lessvat").html(myArray[0]);
$("#subtotal").html(parseFloat(gross)-(parseFloat(myArray[0])+parseFloat(myArray[1])));
});

document.getElementById("mydis1").style.display = "none";
document.getElementById("mydis2").style.display = "none";
}
}
// ------------------- END SD -----------------------------

// ------------------ SPECIAL DISC ------------------------
function specialdiscx(val){
var sel = document.getElementById("specialdisc").value;
var gross = document.getElementById("subtotal").innerHTML;
var vat = document.getElementById("lessvat").innerHTML;
var sen = document.getElementById("lesssenior").innerHTML;
document.getElementById("ar").value = "";
document.getElementById("change").value = "0";

var val2 = val.replace(".", "");
var val3 = val;

if(val<100 && val>9){val = "0."+ val2;}
else if(val<10){val = "0.0"+ val2;}
else{val = 1;}

if(sel=="ADD-ONS"){
var net = gross * val;
var inet = gross - net;
document.getElementById("mynet").innerHTML = inet;
}

else if(sel=="OVERRIDING"){
var newgross = parseFloat(gross) + parseFloat(sen) + parseFloat(vat);
var net = newgross * val;
var inet = newgross - net;
document.getElementById("mynet").innerHTML = inet;
document.getElementById("subtotal").innerHTML = newgross;
document.getElementById("lessvat").innerHTML ="0.00";
document.getElementById("lesssenior").innerHTML = "0.00";
}

else if(sel=="OVERRIDINGAMOUNT"){
var newgross = parseFloat(gross) + parseFloat(sen) + parseFloat(vat);
var inet = val3;
var disc = newgross - val3;
var perc = (disc/newgross)*100;
document.getElementById("mydis1").value=perc;
document.getElementById("mynet").innerHTML = inet;
document.getElementById("subtotal").innerHTML = newgross;
document.getElementById("lessvat").innerHTML ="0.00";
document.getElementById("lesssenior").innerHTML = "0.00";
}

}
// -------------- END SPECIAL DISC ------------------------

// ----------------------- myFUNCTION -----------------------------
function myFunction(val){
var x = document.getElementById("myDIV");
if (val === "card") {x.style.display = "block";}
else if (val === "check") {x.style.display = "block";}
else {x.style.display = "none";}
var x2 = document.getElementById("myDIV2");
if (val === "loyaltycard") {x2.style.display = "block";}
else {x2.style.display = "none";}
$("#hcn2").val('');
$("#lcpoint").val('');
}
// ------------------- END myFUNCTION -----------------------------


function getXMLHTTP(){ //fuction to return the xml http object
var xmlhttp=false;
try{xmlhttp=new XMLHttpRequest();}
catch(e){
try{xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");}
catch(e){
try{xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");}
catch(e1){xmlhttp=false;}
}
}
return xmlhttp;
}


function sukiDiscount(discount,gross){
document.getElementById("discount").value=discount;
document.getElementById("net").value=gross;
}

function checkCaseno(str){
$.get("checkSuki.php", {
str:str
}, function (data, status){
data = data.trim();
if(data == ""){alert('Invalid Suki Card No.'); document.getElementById('hcn').value="";}
});
}

function loadloyalty(str){
$.get("checkSuki2.php", {
str:str
}, function (data, status) {
$("#lcpoint").val(data);
});
}
</script>

<script>
function changeclass(val){
document.getElementById("c1").className = "";
document.getElementById("c3").className = "";
document.getElementById(val).className = "active";
}



document.onkeyup = function(e) {
if (e.ctrlKey && e.which == 49) {document.getElementById("btnpayment").click();}
else if (e.ctrlKey && e.which == 50) {location.reload(); }
else if (e.ctrlKey && e.which == 51) {window.location = '?main'; }
}
</script>
