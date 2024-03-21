<?php
$sqlz = "select admission.status, admission.patientidno, admission.caseno, admission.membership, admission.hmo, admission.room, admission.street, admission.barangay, admission.municipality, admission.province, admission.initialdiagnosis, admission.ap, admission.dateadmitted, admission.branch, admission.employerno, admission.ad, admission.status, ifnull(patientprofile.lastname, patientprofilewalkin.lastname) as lastname, ifnull(patientprofile.firstname, patientprofilewalkin.firstname) as firstname, ifnull(patientprofile.middlename, patientprofilewalkin.middlename) as middlename, ifnull(patientprofile.patientidno, patientprofilewalkin.patientidno) as patientidno, ifnull(patientprofile.sex, patientprofilewalkin.sex) as sex, ifnull(patientprofile.age, patientprofilewalkin.age) as age, ifnull(patientprofile.senior, patientprofilewalkin.senior) as senior, ifnull(patientprofile.birthdate, patientprofilewalkin.birthdate) as birthdate from admission left join patientprofile on admission.patientidno=patientprofile.patientidno left join patientprofilewalkin on admission.patientidno=patientprofilewalkin.patientidno where admission.caseno ='$caseno'";
$resultz = $conn->query($sqlz);
while($rowz = $resultz->fetch_assoc()){
$patientidno=$rowz['patientidno'];
$caseno=$rowz['caseno'];
$membership=$rowz['membership'];
$hmo=$rowz['hmo'];
$room=$rowz['room'];
$street=$rowz['street'];
$barangay=$rowz['barangay'];
$municipality=$rowz['municipality'];
$province=$rowz['province'];
$initialdiagnosis=$rowz['initialdiagnosis'];
$finaldiagnosis=$rowz['finaldiagnosis'];
$ap=$rowz['ap'];
$ad=$rowz['ad'];
$employerno=$rowz['employerno'];
$dateadmitted=$rowz['dateadmitted'];
$branch=$rowz['branch'];
$status=$rowz['status'];
$address = $street." ".$barangay." ".$municipality." ".$province;
$lname=$rowz['lastname'];
$fname=$rowz['firstname'];
$mname=$rowz['middlename'];
$age=$rowz['age'];
$senior=$rowz['senior'];
$sex=$rowz['sex'];
$statusxx=$rowz['status'];
$birthdate=$rowz['birthdate'];
$patientname = $lname.", ".$fname." ".$mname;
$patient = $lname. ", " .$fname. " " .$mname."_".$caseno;
if ($sex == "m" or $sex == "M" or $sex == "MALE" or $sex == "male" or $sex == "Male") {$sex = "MALE"; $avat = "boy";}else{ $sex = "FEMALE";  $avat = "girl";}
if ($senior == "Y" or $senior=="y") {$senior = "YES";}else{$senior = "NO";}
}

if(isset($_POST['btndel'])){
$autono = $_POST['autono'];
$sql = "delete from productreturn where autono='$autono'";
if($conn->query($sql) === TRUE) {}
echo"<script>window.location = '?returnitem2&caseno=$caseno';</script>";
}

if(isset($_POST['btnreturn'])){
$checkb = $_POST['checkb'];
$countcheck = count($checkb);
$timearray = date("M-d-Y");
$datearray = date("Y-m-d");
$refno1 = date("YmdHsi");

$approvalno = date("Y-m-d H:s:i");
for($i=0; $i<$countcheck; $i++){
list($caseno,$code,$desc,$qty,$refno,$autono,$rrno) = explode("_", $checkb[$i]);
$newrefno = $refno1."".$i;

$sqld = "select * from productout where caseno='$caseno' and refno='$refno' and productcode='$code'";
$resultd= $conn->query($sqld);
while($rowd = $resultd->fetch_assoc()) {
$quantity = $rowd['quantity'];
$gross = $rowd['gross'];
$adjustment = $rowd['adjustment'];
$srp = $rowd['sellingprice'];
$invno1 = $rowd['invno'];
$batchno = $rowd['batchno'];
$producttype = $rowd['producttype'];
$productsubtype = $rowd['productsubtype'];
$location = $rowd['location'];
$ogross = $gross / $quantity;
$oadj = $adjustment / $quantity;
}

$ngross = $ogross * $qty;
$nadj = $oadj * $qty;
$newqty = $quantity - $qty;

$sqldd = "select patientprofile.patientname from admission, patientprofile where admission.patientidno=patientprofile.patientidno and caseno='$caseno'";
$resultdd= $conn->query($sqldd);
while($rowdd = $resultdd->fetch_assoc()) {
$patientname = $rowdd['patientname'];
}

$sqlddd = "select * from receiving where code='$code'";
$resultddd= $conn->query($sqlddd);
while($rowddd = $resultddd->fetch_assoc()) {
$unitcost = $rowddd['unitprice'];
$generic = $rowddd['generic'];
$lotno = $rowddd['lotno'];
}

$sql11 = "update productout set gross='$ngross', adjustment='$nadj', quantity='$newqty', excess='$ngross' where caseno='$caseno' and refno='$refno' and productcode='$code'";
if($conn->query($sql11) === TRUE) {echo"update productout $desc<br>";}

$sql22 = "update productreturn set trantype='return' where caseno='$caseno' and refno1='$refno' and autono='$autono'";
if($conn->query($sql22) === TRUE) {echo"update productreturn $desc<br>";}

$sql33 = "insert into stocktable (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`,
`recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`,
 `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`, `timearray`) values ('$timearray','$rrno','','','$caseno','$patientname','$code','$desc',
'$unitcost','$qty','','$generic','$qty','$expiration','$lotno','return','NONE','$timearray','$dept','','','',
'$user','','','$invno1','$datearray', CURTIME())";
if($conn->query($sql33) === TRUE) {echo"insert stocktable $desc<br>";}

$sql44 = "INSERT INTO `productout`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`,
`quantity`, `adjustment`, `gross`, `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`,
`batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`, `administration`, `shift`, `location`, `datearray`,
`phic1`) VALUES ('$newrefno','','$caseno','$code','$desc','$srp','$qty','0','0','return','0','0','0','$timearray','Return','$refno','$user','$batchno',
'$producttype','$productsubtype','$approvalno','$refno','return','$branch','$location','$datearray','')";
if($conn->query($sql44) === TRUE) {echo"insert productout $desc<br>";}

//echo"caseno:$caseno<br>code:$code<br>desc:$desc<br>qty:$qty<br>refno:$refno<br>autono:$autono<br>rrno:$rrno";
}
echo"<script>window.location = '?returnitem$datax';</script>";
}
?>

<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?returnitem">Return Item</a></li>
<li class="breadcrumb-item"><a href="?returnitem2&caseno=<?php echo $caseno ?>">Return Item Details</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section profile">
<div class="row">
<div class="col-xl-4">
<div class="card">

<div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
<img src='../main/img/boy.png' width='100' height='100' style='border-radius: 50%;'><p></p>
<h5><b><?php echo $patientname ?></b></h5>
<p align="center" style="font-size: 12px;"><?php echo $address ?></p>

<table width="100%">
<tr><td><hr style="border: 2px solid red; border-radius: 5px;"></td></tr>
</table>


<div class="d-flex align-items-start" style="width: 100%;">
<div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
<button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><font size="2%">H-Info</font></button>
<button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><font size="2%">P-Info</font></button>
<button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"><font size="2%">PHIC & HMO</font></button>
</div>


<div class="tab-content" id="v-pills-tabContent">
<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

<table width="100%">
<tr>
<td><font size="1%"><i class="bi bi-upc-scan"></i> PRN :</font></td>
<td><font size="1%"><b><?php echo $patientidno ?></b></font></td>
</tr>
<tr>
<td><font size="1%"><i class="bi bi-box-seam"></i> GCN :</font></td>
<td><font size="1%"><b><?php echo $caseno ?></b></font></td>
</tr>
<tr>
<td><font size="1%"><i class="bi bi-calendar-date-fill"></i> HCN :</font></td>
<td><font size="1%"><b><?php echo $employerno ?></b></font></td>
</tr>
<tr>
<td><font size="1%"><i class="bi bi-building"></i> ROOM :</font></td>
<td><font size="1%"><b><?php echo $room ?></b></font></td>
</tr>
<tr>
<td><font size="1%"><i class="bi bi-person-square"></i> ATTENDING :</font></td>
<td><font size="1%"><b><?php echo $ap ?></b></font></td>
</tr>
<tr>
<td><font size="1%"><i class="bi bi-person-circle"></i> ADMITTING :</font></td>
<td><font size="1%"><b><?php echo $ad ?></b></font></td>
</tr>
<tr>
<td><font size="1%"><i class="bi bi-calendar-day-fill"></i> DATE ADMIT :</font></td>
<td><font size="1%"><b><?php echo $dateadmitted ?></b></font></td>
</tr>
<tr>
<td><font size="1%"><i class="bi bi-clock-history"></i> TIME ADMIT :</font></td>
<td><font size="1%"><b><?php echo date("h:i:s a", strtotime($timeadmitted)); ?></b></font></td>
</tr>
<tr>
<td><font size="1%"><i class="bi bi-calendar-month-fill"></i> DATE DISCH.. :</font></td>
<td><font size="1%"><b><?php echo $datedischarged ?></b></font></td>
</tr>
<tr>
<td><font size="1%"><i class="bi bi-clock"></i> TIME DISCH.. :</font></td>
<td><font size="1%"><b><?php echo $timedischarged; ?></b></font></td>
</tr>
<tr>
<td><font size="1%"><i class="bi bi-bar-chart-line"></i> STATUS :</font></td>
<td><font size="1%"><b><?php echo $statusxx ?></b></font></td>
</tr>
</table>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>
<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
<table width="100%">
<tr>
<td><font size="1%"><i class="bi bi-graph-up"></i> AGE :</font></td>
<td><font size="1%"><b><?php echo $age ?></b></font></td>
</tr>
<tr>
<td><font size="1%"><i class="bi bi-gender-ambiguous"></i> GENDER :</font></td>
<td><font size="1%"><b><?php echo $sex ?></b></font></td>
</tr>
<tr>
<td><font size="1%"><i class="bi bi-bar-chart-line"></i> SENIOR :</font></td>
<td><font size="1%"><b><?php echo $senior ?></b></font></td>
</tr>
<tr>
<td><font size="1%"><i class="bi bi-calendar2-month"></i> BIRTHDATE :</font></td>
<td><font size="1%"><b><?php echo $birthdate ?></b></font></td>
</tr>
</table>
</div>
<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
<table width="100%">
<tr>
<td><font size="1%"><i class="bi bi-bar-chart-line"></i> PHILHEALTH :</font></td>
<td><font size="1%"><b><?php echo $membership ?></b></font></td>
</tr>
<tr>
<td><font size="1%"><i class="bi bi-bar-chart-line"></i> HMO :</font></td>
<td><font size="1%"><b><?php echo $hmo ?></b></font></td>
</tr>
<tr>
<td><font size="1%"><i class="bi bi-bar-chart-line"></i> CREDIT LIMIT :</font></td>
<td><font size="1%"><b><?php echo number_format($creditlimit1,2); ?></b></font></td>
</tr>
<tr>
<td><font size="1%"><i class="bi bi-bar-chart-line"></i> CEDIT USED :</font></td>
<td><font size="1%"><b><?php echo number_format($gross,2); ?></b></font></td>
</tr>
<tr>
<td><font size="1%"><i class="bi bi-bar-chart-line"></i> CEDIT BALANCE :</font></td>
<td><font size="1%"><b><?php echo number_format($creditlimit,2); ?></b></font></td>
</tr>
<tr>
<td><font size="1%"><i class="bi bi-bar-chart-line"></i> LOA LIMIT :</font></td>
<td><font size="1%"><b><?php echo number_format($loa1,2) ?></b></font></td>
</tr>
<tr>
<td><font size="1%"><i class="bi bi-bar-chart-line"></i> LOA USED :</font></td>
<td><font size="1%"><b><?php echo number_format($grosshmo,2); ?></b></font></td>
</tr>
<tr>
<td><font size="1%"><i class="bi bi-bar-chart-line"></i> LOA BALANCE :</font></td>
<td><font size="1%"><b><?php echo number_format($loa1-$grosshmo,2); ?></b></font></td>
</tr>
</table>
</div>
</div>
</div>


</div>
</div>

</div>

<div class="col-xl-8">

<div class="card">
<div class="card-body pt-3">




<form method="POST" name="arvz">
<table class="table">
<thead>
<tr>
<th class="text-center" style="font-size: 11px;">#</th>
<th class="text-center" style="font-size: 11px;" width="60%">DESCRIPTION</th>
<th class="text-center" style="font-size: 11px;" width="10%">QTY</th>
<th class="text-center" style="font-size: 11px;" width="25%">Date/Time Return</th>
<th class="text-center"></th>
</tr>
</thead>
<tbody>

<?php
$r2=''; $i=0; $x = 0;
$sqla12 = "select r.description, r.generic, pr.productcode, pr.date, pr.gross, pr.quantity1, pr.username, pr.rrno, pr.autono, pr.refno1, pr.dateofret from productreturn pr, receiving r where pr.productcode=r.code and caseno='$caseno' and trantype='finalized'";
$resulta12 = $conn->query($sqla12);
while($rowa12 = $resulta12->fetch_assoc()) {
$code =$rowa12['productcode'];
$productdesc ="(".$rowa12['generic'].") ".$rowa12['description'];
$date =$rowa12['date'];
$batchno =$rowa12['gross'];
$uname =$rowa12['username'];
$qty =$rowa12['quantity1'];
$refno =$rowa12['refno1'];
$autono =$rowa12['autono'];
$rrno =$rowa12['rrno'];
$dateofret =$rowa12['dateofret'];
$status="PAID";
$arvcol = "black";
$checkbox="checked";
?>

<tr>

<td align="center">
<?php if($status=="PAID" or $status=="Approved") { ?>
<input type="checkbox" style='transform : scale(1.6);' value="<?php echo $caseno."_".$code."_".$productdesc."_".$qty."_".$refno."_".$autono."_".$rrno ?>" id="<?php echo $nana; ?>" name="checkb[]" onclick="cal(<?php echo $totals; ?>,this.id, this.checked, '<?php echo $nanaxxx ?>');" <?php echo $checkbox ?>>
<?php }else {echo "<font color='red'><i class='fa fa-exclamation-circle' aria-hidden='true'></i>";} ?>
<input type="hidden" name="caseno" value="<?php echo $caseno ?>">

</td>
<td style="font-size: 11px;"><?php echo $productdesc ?></td>
<td style="font-size: 12px; text-align: center;"><?php echo $qty  ?></td>
<td style="font-size: 12px; text-align: center;"><?php echo $dateofret ?></td>
<td style="font-size: 11px;">

<form method="POST">
<button name="btndel" class="btn btn-outline-danger btn-sm" title="Cancel Return" onclick="return confirm('Are you sure you want to cancel?');"><i class="icofont-trash"></i></button>
<input type="hidden" name="autono" value="<?php echo $autono ?>">
</form>
</td>
</tr>
<?php  } ?>
</tbody>
</table>
<p align="right">
<button type="submit" name="btnreturn" onclick="return confirm('Sure to Submit?');" class="btn btn-primary btn-sm"><i class="icofont-undo"></i> RETURN ITEM(S)</button>
</p>
</form>







</div>

</div>
</div>
</section>

</main><!-- End #main -->



<!-- CheckBox Auto Sum -->
<script type = "text/javascript">
function cal(val, discounting, val_id, benable) {
let idtxt = val_id.replace("S", "Z");
var checkBox = document.getElementById(val_id);
var p1= eval(arvz.total.value)
var p2= eval(arvz.total2.value)
var p3= eval(arvz.total3.value)
if(checkBox.checked==true){
p1 = eval(p1) + eval(val);
p2 = eval(p2) + eval(discounting);
}
else{
p1 = eval(p1) - eval(val);
p2 = eval(p2) - eval(discounting);
}
p3 = eval(p1) - eval(p2);
document.getElementById(idtxt).disabled = !benable
arvz.total.value = Number((p1).toFixed(2));
arvz.total2.value = Number((p2).toFixed(2));
arvz.total3.value = Number((p3).toFixed(2));
}

function qtyc(val,val2) {
if (val > val2) {
window.alert("DISPENSE QUANTITY IS GREATER THAN REQUEST QUANTITY! IF DQ > RQ SYSTEM WILL ONLY DISPENSE THE EXACT QUANTITY!");
arvz.qty1.value = val2
}
}
</script>
<!-- End of CheckBox Auto Sum -->

<script type="text/javascript">
function SetAllCheckBoxes(FormName, FieldName, CheckValue, totval){
if(!document.forms[FormName])
return;
var objCheckBoxes = document.forms[FormName].elements[FieldName];
if(!objCheckBoxes)
return;
var countCheckBoxes = objCheckBoxes.length;
if(!countCheckBoxes)
objCheckBoxes.checked = CheckValue;
else
// set the check value for all check boxes
for(var i = 0; i < countCheckBoxes; i++)
objCheckBoxes[i].checked = CheckValue;
arvz.total.value = eval(totval)
}
// -->

function printinvoice(){
var invno = document.getElementById('invno').value;
let a=document.createElement('a');
a.target='_blank';
a.href='../dispensing/chargeslip.php?caseno=<?php echo $caseno ?>&pname=<?php echo $patientname ?>&batchno=<?php echo $batchno ?>&user=<?php echo $user ?><?php echo $datax ?>&invno=' + invno;
a.click();
}
</script>


