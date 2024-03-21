<?php
include "../main/class.php";
include "../main/header.php";


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

$sqlc = "SELECT * FROM admission a, patientprofile p where a.patientidno=p.patientidno and a.caseno='$caseno'";
$resultc = $conn->query($sqlc);
while($rowc = $resultc->fetch_assoc()) {
$name = strtoupper($rowc['lastname'].", ".$rowc['firstname']." ".$rowc['middlename']);
}

if(isset($_GET['btndel'])){
$sqla11 = "delete from collection_temp2 where acctno = '$caseno'";
if ($conn->query($sqla11) === TRUE) {}
echo"<script>alert('deleted!'); window.location= 'finalbill2.php?caseno=$caseno$datax';</script>";
}

include "../cashier/finalbill/finalbill_temp.php";
include "../cashier/finalbill/finalbill.php";
?>


<div class="col">
<div class="card teacher-card" style='box-shadow: 0px 0px 0px 1px lightgrey;'>
<div class="card-body  d-flex">
<div class="profile-av pe-xl-4 pe-md-2 pe-sm-4 pe-4 text-center w220">
<img src='../main/img/boy.png' width='70' height='70' style='border-radius: 50%;'>

</div>
<div class="teacher-info border-start ps-xl-4 ps-md-3 ps-sm-4 ps-4 w-100">
<table width="100%"><tr>
<td width="80%">
<h6  class="mb-0 mt-2  fw-bold d-block fs-6"><?php echo strtoupper($name) ?></h6>
<span class="py-1 fw-bold small-11 mb-0 mt-1"><?php echo $address ?></span>
<br><font size='1%'>Caseno: <b><?php echo $caseno ?></b> || Room: <b><?php echo $room ?></b> || PATIENT TYPE: <b><?php echo $ss ?></b></font>
</td>
</tr>
</table>

</div>
</div>
</div>
</div><br>


<!----------------------------------------------------------------------------- DESIGN --------------------------------------------------------------------------------->
<table width="98%" align="center"><tr>
<td width="60%" valign="TOP">

<div class='dd-handle'>
<div class='task-info d-flex align-items-center'></div>
<form method="POST">


<table width="100%" align="center" class="tablex">
<tr>
<th style='font-size:11px;' width="55%"><b>DESCRIPTION</b></th>
<th style='font-size:11px;'><b>TOTAL</b></th>
<th style='font-size:11px;' width="30%"><b>AMOUNT</b></th>
</tr>

<?php

// ----------------------------------------- HOSPITAL BILL ----------------------------------------
$sql = "SELECT sum(amount) as amm FROM collection where acctno = '$caseno' and description  like '%HOSPITAL BILL%' and (type='cash-Visa' or accttitle ='DISCOUNT')";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$ispaid = $row['amm'];
}

$sqlc = "SELECT sum(amount) as amm FROM collection where acctno = '$caseno' and accttitle like 'AR%%' and (accttitle not like '%TRADE%' and accttitle not like '%PF%')";
$resultc = $conn->query($sqlc);
while($rowc = $resultc->fetch_assoc()) {
$ispaid2 = $rowc['amm'];
}

$ipdad = $conn->query("Select sum(excess) as exc from productout where caseno='$caseno' and producttype = 'IPD Admitting'");
while($ipdadm = $ipdad->fetch_assoc()){$ipdadmittng = $ipdadm['exc'];}

$sqlc = "SELECT sum(excess) as hospbill FROM productout where productsubtype != 'PROFESSIONAL FEE' and caseno='$caseno' and trantype='charge' and quantity>0";
$resultc = $conn->query($sqlc);
while($rowc = $resultc->fetch_assoc()) {
$hospbill = $rowc['hospbill'] + $ipdadmittng;
$bal = $hospbill - $ispaid;
$bal = $bal - $ispaid2;
$bal = number_format($bal, 2, '.', '');
$bal2 = str_replace("-", "", $bal);

if($bal<0){$baldetail = "<b>FOR REFUND</b>"; $dis="readonly";}
else{$baldetail = "<b>HOSPITAL-BILL</b>"; $dis=""; $finalbal += $bal2;}


echo"
<tr>
<td style='font-size: 11px;'><i class='icofont-check-circled'></i> $baldetail</td>
<td style='font-size: 11px;'>$bal2</td>
<td>
<input type='text' name='hospitalpay' id='hospitalpay' value='$bal2' style='width: 100%; height:30px; font-size:12pt; padding: 0px; text-align: center;' $dis>
<input type='hidden' id='hp' value='$bal2'>
<input type='hidden' name='hospitalbal' value='$bal'>
</td>
</tr>
";
}
// ------------------------------------- END HOSPITAL BILL ----------------------------------------


if($bal<0){$head = "<tr style='background-color: #545252;'><td></td><td></td><td> <div class='row'><div class='col-lg-6' style='text-align: center; font-size: 10px; color: white;'><b>APPF</b></div><div class='col-lg-6' style='text-align: center; font-size: 10px; color: white;'><b>EXCESS</b></div></div> </td></tr>";}
else{$head="";}
echo"$head";


// ------------------------------------- PROFESSIONAL FEE ----------------------------------------
$ii=1;
$sqlc = "SELECT * FROM productout where productsubtype = 'PROFESSIONAL FEE' and producttype!='IPD Admitting' and caseno='$caseno' and excess>0 and trantype='charge'";
$resultc = $conn->query($sqlc);
while($rowc = $resultc->fetch_assoc()) {
$pdesc = strtoupper($rowc['productdesc']);
$excess = $rowc['excess'];
$ptype = $rowc['producttype'];
$refnodoc = $rowc['refno'];
$docdesc = $rowc['productdesc'];

$sql = "SELECT sum(amount) as amm FROM collection where refno='$refnodoc' and type='cash-Visa'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$ispaiddoc = $row['amm'];
}
$baldoc = $excess - $ispaiddoc;

//$sqlg = "SELECT sum(amount) as amm FROM collection where acctno = '$caseno' and description = '$docdesc'
// and accttitle like 'AR%%' and accttitle not like '%TRADE%'";
//$resultg = $conn->query($sqlg);
//while($rowg = $resultg->fetch_assoc()) {
//$ispaiddoc2 = $rowg['amm'];
//}

$hh = $conn->query("select sum(amount) as collection_amm from collection where acctno='$caseno' and description='$pdesc'");
while($hh1 = $hh->fetch_assoc()){$ispaiddoc2 = $hh1['collection_amm'];}
$excess = $excess - $collection_amm;



$baldoc = $baldoc - $ispaiddoc2;
$excess = $excess - $ispaiddoc2;
$finalbal += $baldoc;
if($bal<0){
$txtpf = "<input type='text' name='doctorpay[]' id='val$ii' value='0' oninput='checkref();' style='width: 100%; height:30px; font-size:12pt; padding: 0px; text-align: center; background: lightyellow;' required>";
$txtpf2 = "<input type='text' name='doctorpayx[]' id='mval$ii' value='$baldoc' style='width: 100%; height:30px; font-size:12pt; padding: 0px; text-align: center;' required>";
$disp = "";
$xx = "6";
}
else{
$txtpf = "<input type='text' name='doctorpay[]' value='$excess' style='width: 100%; height:30px; font-size:12pt; padding: 0px; text-align: center;'>"; $txtpf2 ="";
$disp = "style='display:none;'";
$xx = "12";
}
$txtval ="<input type='hidden' id='zval$ii' value='$baldoc'>";

if($baldoc>0){$ii++;
echo"
<tr>
<td style='font-size: 11px;'><div class='row'><div class='col-lg-1' style='font-size: 20px;'><i class='icofont-doctor-alt'></i></div><div class='col-lg-11'> <b>$pdesc</b><br><font color='red' size='1px'>[$ptype]</font></div></div></td>
<td style='font-size: 11px;'>$baldoc</td>
<td>
<div class='row'><div class='col-lg-$xx' style='text-align: center;'>$txtpf</div><div class='col-lg-6' style='text-align: center;' $disp>$txtpf2</div></div></td>
</tr>
<input type='hidden' name='refnodoc[]' value='$refnodoc'>
$txtval
";
}
}
// --------------------------------- END PROFESSIONAL FEE ----------------------------------------




//if($baldoc>0 or $bal>0){$dis="";}else{$dis="disabled";}
$finalbalx = number_format($finalbal, 2);
?>
<tr><td><font size="2" color="black"><b>TOTAL:</b></td><td colspan="2"><font size="2" color="black"><b>&#8369; <?php echo $finalbalx ?></b></td></tr>
</table>

<br>

<table align="right" width="40%" style="padding: 10px;"><tr>
<td><input type='text' name='approvedby' placeholder='Approved By..' style='width: 100%; height:30px; font-size:12pt; padding: 0px;'></td>
<tr>
<td>
<select style='width: 100%; height:30px; font-size:12pt; padding: 0px;' name="artrade" onchange="empdoc(this.value);">
<option value="AR TRADE">AR TRADE</option>
<option value="AR EMPLOYEE">AR EMPLOYEE</option>
<option value="AR DOCTOR">AR DOCTOR</option>
<option value="AR PERSONAL">AR PERSONAL</option>
</select>
</td>
</tr>
<tr id="idempdoc" style="display: none;">
<td>
<select style='width: 100%; height:30px; font-size:12pt; padding: 0px;' name="chargeto" id="chargeto"></select>
</td>
</tr>
<tr><td style="text-align: right;">
<button type="submit" name="btnpost" class="btn btn-warning btn-sm" onclick="return fsave();" <?php echo $dis ?>><i class="icofont-check-circled"></i> Submit for Payment</button>
</td></tr></table>

<br><br><br><br><br><br>
</form>
</div>

<br>

<div class='dd-handle'>
<div class='task-info d-flex align-items-center'></div>
<table width="100%">
<tr><td colspan="3"><font color="black">REVIEW ENTRIES:</td></tr>
<tr><td colspan="3">
<table width="90%" align="center">
<?php
$checkdebit = 0; $ttotal=0; $checkartrade =0;
$sqlcf = "SELECT * FROM collection_temp2 where acctno='$caseno' order by type";
$resultcf = $conn->query($sqlcf);
$ccount = mysqli_num_rows($resultcf);
if($ccount<=0){$diss = "disabled";}
while($rowcf = $resultcf->fetch_assoc()){

if(strpos($rowcf['accttitle'], 'TRADE')!==false){$checkartrade++;}
elseif(strpos($rowcf['accttitle'], 'AR EMPLOYEE')!==false){$checkartrade++;}
elseif(strpos($rowcf['accttitle'], 'AR PERSONAL')!==false){$checkartrade++;}
elseif(strpos($rowcf['accttitle'], 'AR DOCTOR')!==false){$checkartrade++;}

if($rowcf['accttitle']=="CASHONHAND" OR $rowcf['accttitle']=="PROFESSIONAL FEE" OR $rowcf['accttitle']=="MEDICAL SURGICAL SUPPLIES"){$ttotal += $rowcf['amount'];}

if($rowcf['type'] == "cash-Visa"){$pp = "<font color='blue'>[debit]";}
elseif($rowcf['accttitle'] == "FOR REFUND"){$pp = "<font color='green'>[credit-pending]";}
elseif($rowcf['accttitle'] == "APPF OTHERS PF"){$pp = "<font color='green'>[credit-pending]";}
else{$pp = "<font color='red'>[debit-pending]";}

if($rowcf['type'] == "cash-Visa" and $rowcf['amount']>0){$checkdebit++;}
echo"
<tr>
<td width='70%' style='font-size:11px;'>&#128204; $rowcf[description] <small><font color='blue'>[$rowcf[accttitle]]</font></small></td>
<td style='font-size:11px;'>$rowcf[amount] <small>$pp</small> </td>
</tr>
";
}

if($checkdebit>0){$req = "required"; $display="block"; $dis="";}else{$orno=""; $req=""; $display="none"; $dis="disabled";}
echo"
<tr>
<td><b>TOTAL PAYMENT:</td>
<td><b>$ttotal</td>
</tr>
";
?>
</table>
<hr>
</td></tr>
<tr><td colspan="3">


<form method="POST">
<div style="display: <?php echo $display ?>;">
<table width="70%" align="right">
<tr>
<td width="49%">OR NO.:
<input type="text" name="ofr" value="<?php echo $orno ?>" placeholder="Enter OR Number Here......" class="form-control" style="width: 100%; height:35px; font-size:10pt; color: black; background: white; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e; text-align: center;" <?php echo $req ?> readonly>
<input type="hidden" name="orseries" value="<?php echo $orno_id ?>">
</td>
<td width="2%"></td>
<td>Mode of Payment:
<select name="paymenttype" class="form-control" style="width: 100%; height:35px; font-size:10pt; color: black; background: white; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e; text-align: center;">
<option value="cash-Visa">CASH</option>
<option value="card-Visa">CARD</option>
<option value="cheque-Visa">CHEQUE</option>
</select>
</td>
</tr>
</table>
</div>
<br><br><br><p>
<table width="100%"><tr><td><p align="right">
<a href="../cashier/finalbill2.php?btndel=<?php echo $datax ?>&caseno=<?php echo $caseno ?>"><button type="button" class="btn btn-outline-danger btn-sm"><i class="icofont-spinner-alt-3"></i> Reset Posting</button></a>
<?php
if($checkartrade>0){
ARtrade_otp($caseno);
$c1 ="";
$c2 ="hidden";
}else{
$c1 ="hidden";
$c2 ="";
}
?>
<!--button type="button" class="btn btn-outline-success btn-sm" onclick="" data-bs-toggle="modal" data-bs-target="#requestreturn2" <?php echo $c1 ?>><i class="icofont-tick-boxed"></i> Enter Code</button>
<button type="submit" name="btnsave" id="btnsave" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to post payment?')" <?php echo $c2 ?>><i class="icofont-tick-boxed"></i> Post Payment</button-->
<button type="submit" name="btnsave" id="btnsave" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to post payment?')"  <?php echo $diss ?>><i class="icofont-tick-boxed"></i> Post Payment</button>
</p></td></tr></table>

</form>


</td></tr>
</table><br>


</div>


</td><td width="1%"></td>
<td valign="TOP">


<br>
<div class='card' style='box-shadow: 0px 0px 0px 1px lightgrey;'>
<div class='card-body'>
<div class='d-flex align-items-center justify-content-between mt-5'>
<div class='lesson_name'>
<div class='project-block light-danger-bg'>
<i class='icofont-history'></i>
</div>
<span class='small project_name fw-bold'> PAYMENT HISTORY </span>
</div>
</div>

<table class='table'>
<thead>
<tr>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>">#</th>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>">DESCRIPTION</th>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>">AMOUNT</th>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>"></th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$sql = "SELECT * FROM collection where acctno = '$caseno' and (description  like '%HOSPITAL%' or accttitle  like '%PROFESSIONAL%') and type='cash-Visa' group by ofr";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$ofr=$row['ofr'];
$colx  = "black";
$i++;

$desc2=""; $total = 0;
$sqly = "SELECT * FROM collection where acctno = '$caseno' and ofr='$ofr'";
$resulty = $conn->query($sqly);
while($rowy = $resulty->fetch_assoc()) {
$descx=$rowy['description'];
$accttitlex=$rowy['accttitle'];
$amount=$rowy['amount'];
$total += $amount;

if($desc2 == ""){$desc2 = $descx."<br><font size='1' color='red'>[".$accttitlex."]</font>";}
else{$desc2 = $desc2."<br>".$descx."<br><font size='1' color='red'>[".$accttitlex."]</font>";}
}

$total2 += $total;
?>


<tr>
<td bgcolor="<?php echo $col ?>" align="center"><font color="blue" size="2"><?php echo $i ?></td>
<td bgcolor="<?php echo $col ?>" style="font-size: 11px;"><?php echo $desc2 ?></td>
<td bgcolor="<?php echo $col ?>" style="font-size: 11px;"><?php echo $total."<br><font color='red'>[".$ofr."]" ?></td>
<td style="text-align: center;">
<a href="http://<?php echo $ip ?>/2020codes/PrintOR/OR1.php?orno=<?php echo $ofr ?>&datearray=<?php echo $datearrayxx ?>&name=<?php echo $user.$datax ?>" target="_blank"><button type="button" class="btn btn-primary"><i class="fa fa-print"></i></button></a>
</td>
</tr>

<?php } ?>

<?php
$ofr=""; $total="";
$sqlf = "SELECT * FROM collection where acctno = '$caseno' and accttitle like 'AR%%' and accttitle not like '%TRADE%'";
$resultf = $conn->query($sqlf);
while($rowf = $resultf->fetch_assoc()) {
$descx=$rowf['description'];
$accttitlex=$rowf['accttitle'];
$amountf=$rowf['amount'];
$total = $amountf;
$i++;
$desc2 = $descx."<br><font size='1' color='red'>[".$accttitlex."]</font>";
$total2 += $total;
?>


<tr>
<td bgcolor="<?php echo $col ?>" align="center"><font color="blue" size="2"><?php echo $i ?></td>
<td bgcolor="<?php echo $col ?>"  style="font-size: 11px;"><?php echo $desc2 ?></td>
<td bgcolor="<?php echo $col ?>"  style="font-size: 11px;"><?php echo $total."<br><font color='red'>[".$ofr."]" ?></td>
<td style="text-align: center;">

</td>
</tr>
<?php } ?>
<tr>
<td colspan="2" class="text-center"><font color="black"><b>TOTAL:</td>
<td class="text-center"><font color="black"><b><?php echo $total2 ?></td>
<td></td>
</tr>
</tbody>
</table>
</div>
</div>


<br><br>
<div class='card' style='box-shadow: 0px 0px 0px 1px lightgrey;'>
<div class='card-body'>
<div class='d-flex align-items-center justify-content-between mt-5'>
<div class='lesson_name'>
<div class='project-block light-success-bg'>
<i class='icofont-pay'></i>
</div>
<span class='small project_name fw-bold'> ACCOUNT RECEIVABLE TRADE </span>
</div>
</div>
<table class='table'>
<thead>
<tr>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>">#</th>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>">DESCRIPTION</th>
<th class="text-center" bgcolor="<?php echo $primarycolor2 ?>">AMOUNT</th>
</tr>
</thead>
<tbody>
<?php

$i=0; $total = 0;
$sql = "SELECT * FROM collection where acctno = '$caseno' and accttitle  like '%TRADE%' and type='pending'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$desc=$row['description'];
$accttitle=$row['accttitle'];
$amount=$row['amount'];
$ofr=$row['ofr'];
$total += $amount;
$colx  = "black"; $i++;
?>


<tr>
<td bgcolor="<?php echo $col ?>" align="center"><font color="blue" size="2"><?php echo $i ?></td>
<td bgcolor="<?php echo $col ?>" class="text-center"><?php echo $desc." [".$accttitle."]" ?></td>
<td bgcolor="<?php echo $col ?>" class="text-center"><?php echo $amount ?></td>
</tr>
<?php }?>
<tr>
<td colspan="2" class="text-center"><font color="black"><b>TOTAL:</td>
<td class="text-center"><font color="black"><b><?php echo $total ?></td>
</tr>
</tbody>
</table>
</div>
</div>

</td></tr></table>


<!-------------------------------------------- ENTER OTP ------------------------------------------->
<div class="modal fade" id="requestreturn2" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog" style="box-shadow: 0px 0px 2000px #6e7fcb;">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> One-Time Password Access (OTP)</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<table width="95%" align="center">
<tr>
<td>Verification Code:<br><input  name='verificationcode' id='verificationcode' type='text' style="height:30px; font-size:12pt; padding: 0px; width:100%;" required><p></td>
</tr>
<tr>
<td style="text-align: right;"><button type="button" name="btnsubmit" class="btn btn-danger" onclick="verify();">SUBMIT</button></td>
</tr>
</table>

</div>
</div>
</div>
</div>
<!---------------------------------------- END ENTER OTP ------------------------------------------->



<?php include "../main/footer.php"; ?>


<script>
function checkref(){
var hp = document.getElementById("hp").value;
var total = 0; var total2 = 0;
for(i=1; i<"<?php echo $ii ?>"; i++){total = document.getElementById("val"+i).value; total2 = Number(total2) + Number(total);}
var res = Number(hp) - Number(total2);
res = parseFloat(res).toFixed(2);
document.getElementById("hospitalpay").value = res;

var vtotal = 0; var vtotal1 = 0; vtotal2 = 0;
for(i=1; i<"<?php echo $ii ?>"; i++){
vtotal = document.getElementById("val"+i).value;
vtotal1 = document.getElementById("zval"+i).value;
vtotal2 = Number(vtotal1) - Number(vtotal);
document.getElementById("mval"+i).value = vtotal2;
}
}

function fsave(){
if(document.getElementById("hospitalpay").value<0){alert('Please Allocate the amount correctly!'); return false;}
else{return confirm('Proceed?');}
}


function verify(){
var str="ARtrade_otp";
var caseno = "<?php echo $caseno ?>";

var otp = document.getElementById('verificationcode').value;
$.get("../main/functions.php", {str:str, otp:otp, caseno:caseno}, function (data) {
//alert(data);
if(data=="YES"){document.getElementById("btnsave").click();}else{
document.getElementById('verificationcode').value="";
swal({
icon: 'error',
title: 'Invalid OTP!',
text: 'Please try again!',
type: 'error',
button: false,
timer: 2000
});

}
});
}



function empdoc(val){
var str = "chargeto";

if(val=="AR EMPLOYEE"){
document.getElementById('idempdoc').style.display='';

$.get("../main/functions.php", {str:str, str2:val},
function (data) {$("#chargeto").html(data);});
document.getElementById('chargeto').required=true;
}

else if(val=="AR DOCTOR"){
document.getElementById('idempdoc').style.display='';

$.get("../main/functions.php", {str:str, str2:val},
function (data) {$("#chargeto").html(data);});
document.getElementById('chargeto').required=true;
}

else{
document.getElementById('idempdoc').style.display='NONE';
document.getElementById('chargeto').required=false;

}

}
</script>
