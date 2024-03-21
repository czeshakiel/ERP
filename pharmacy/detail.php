<script>
function confdelete(){if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};}
</script>

<?php
include "../chargecart/cartmodal.php";

session_start();
setcookie("ccname", "$user", time() + (86400 * 30), "/");
$caseno=$_GET['caseno'];
$batchno=$_GET['batchno'];
$invno=$_GET['invno'];

$statx=$_GET['stat'];
if($statx=="cash"){$xstat = "and trantype='cash'";}
elseif($statx=="charge"){$xstat = "and trantype='charge'";}
else{$xstat = "";}

if(isset($_GET['homemeds'])){$homemeds = "homemeds";}else{$homemeds = "";}

if(isset($_GET['delete'])){
$refn = $_GET['refno'];
$code = $_GET['code'];
$desc = $_GET['desc'];
$conn->query("INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('Delete request ', '$user', CURDATE(), CURTIME())");
$conn->query("delete from productout where caseno='$caseno' and refno='$refn'");
echo"<script>alert('$refno successfully deleted...'); window.location='?details&caseno=$caseno&batchno=$batchno';</script>";
}

// --------------------------------------------------- DISPENSE TRANSACTION -----------------------------------------------
if(isset($_POST['btn_dispense'])){
$invno=$_POST["invno"];
$pname=$_POST["pname"];
$caseno=$_POST["caseno"];
$batchno=$_POST["batchno"];
$user=$_POST["user"];
$dataz=$_POST["datax"];
$ch = $_POST['checkb'];
$qty1 = $_POST['qty1'];
$dept = $_POST['dept'];
$ip = $_POST['ip'];
$today = date("Ymd");
$todaytime = date("his");
$todaytimex = date("H:i:s");
$coder=date("YmdHis").rand(10,99);
$localdate = date("M-d-Y");
$todayx = date("Y-m-d");
$coderx=$todaytime."".$today;
$invno2 = $invno;

$sql = "SELECT * FROM admission where caseno='$caseno'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {$ward=$row['status'];}

if($ward=="MGH" && strpos($batchno, "HM-")=== false){
echo"<script>alert('Unable to Dispensed! Patient Status is $ward'); window.history.back();</script>";
exit();
}

// -------------------------------- Check Invoice ----------------------------
$sqlf = "SELECT * FROM arv_tbl_invoice where invno='$invno' and caseno!='$caseno'";
$resultf = $conn->query($sqlf);
$countinvno = mysqli_num_rows($resultf);

if($countinvno>0){
echo"<script>alert('Unable to Dispensed! Invoice Number is already used!'); window.history.back();</script>";
exit();
}
// ---------------------------- END Check Invoice ----------------------------

$ii = 1;
if($invno==""){echo "<script>window.alert('INVALID TRANSACTION! PLEASE FILL-IN INVOICE NUMBER!');</script>"; } else {
for ($i=0; $i<sizeof($ch); $i++){

$xx = $ch[$i];
list($caseno,$code,$refno,$quantity, $rrno, $qtyonhand, $unitcost) = explode("_",$xx);
$qtycc = $qty1[$i];

$sql2 = "SELECT * FROM receiving where code='$code'";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$dx="(".$row2['generic'].") ".$row2['description'];
$gen=$row2['generic'];
$lotno=$row2['lotno'];
}

$sql2d = "SELECT * FROM productout where caseno='$caseno' and refno='$refno' and productcode='$code'";
$result2d = $conn->query($sql2d);
while($row2d = $result2d->fetch_assoc()) {
$srp=$row2d['sellingprice'];
$gross=$row2d['gross'];
$qtyp=$row2d['quantity'];
$adj=$row2d['adjustment'];
$trantype=$row2d['trantype'];
$hmo = $row2d['hmo'];
$phic = $row2d['phic'];
$exc = $row2d['excess'];
$pst = $row2d['productsubtype'];
$stat= $row2d['status'];
$loginuser= $row2d['loginuser'];
$gross1 = $gross / $qtyp;
$adj1 = $adj / $qtyp;
}

$dx = str_replace("ams-", "", $dx);
$dx = str_replace("mak-", "", $dx);
$dx = str_replace("-med", "", $dx);
$dx = str_replace("-sup", "", $dx);

$ii++;
if($invno=="Multiple OR No.!"){
$sql2dxx = "SELECT * FROM collection where acctno='$caseno' and refno='$refno'";
$result2dxx = $conn->query($sql2dxx);
$count_invno = mysqli_num_rows($result2dxx);
if($count_invno>0){
while($row2dxx = $result2dxx->fetch_assoc()) {$invno2 = $row2dxx['ofr'];}
}else{$invno2 = "CHARGE-".date("YmdHis").$ii;}
}

if($pst=="PHAMRACY/MEDICINE"){$dds = "med"; $ddss = "Medicine";}else{$dds = "sup"; $ddss = "Supplies";}
//echo"<script>alert('QTY ONHAND; $qtyp QTY-request: $qtycc QTY-soh: $quantity');</script>";
if($qtyp<=0){echo"<script>alert('$dx is ALREADY DISPENSED with referenceno $refno!');</script>";} else {

if($qtycc>=$quantity){$qtyccc = 0; $srp = 0; $gross1 = $gross; $adj1 = $adj;}
else{$srp = $srp; $qtyccc = $quantity - $qtycc; $gross1 = $gross1 * $qtyccc; $adj1 = $adj1 * $qtyccc;}
if($phic>0){$phic = $gross1; $hmo = 0; $exc = 0;}
elseif($hmo>0){$phic = 0; $hmo = $gross1;$exc = 0;}
else{$phic = 0; $hmo = 0; $exc = $gross1;}
$loguser="Requested by: ".$loginuser."<br>Dispensed by: ".$user;
$qtyccx = "-".$qtycc;
$ddtt = $todayx." ".$todaytimex;

$gg = $adj1 + $gross1;
$sqla1aaa = "INSERT INTO `arv_tbl_invoice`(`invno`, `code`, `desc`, `quantity`, `gross`, `discount`, `net`, `caseno`, `trantype`, `datearray`, `timearray`, `user`, `dept`) VALUES ('$invno2', '$code', '$dx', '$qtycc', '$gg', '$adj1', '$gross1', '$caseno', '$trantype', CURDATE(), CURTIME(), '$user', '$dept')";
if ($conn->query($sqla1aaa) === TRUE) {echo "insert into invoice <br>";}

$dispensed = "dispensed";
if(strpos($batchno, "HM-")!== false){$dispensed = "administered"; $loguser="Requested by: ".$loginuser."<br>Dispensed by: ".$user."<br>Administered by: ".$user;}

$sqla1aa = "INSERT INTO `productout`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`, `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`, `administration`, `shift`, `location`, `datearray`) values
('$coder','$invno2','$caseno','$code','$dx','$unitcost','$qtycc','$adj1','$gross1','$trantype','$phic','$hmo','$exc','$localdate','$stat','$rrno','$loguser','$batchno','$dds','$pst','$ddtt','$refno','$dispensed','$branch','$dept','$todayx')";
if ($conn->query($sqla1aa) === TRUE) {echo "insert into productout <br>";}

$sqla1a = "insert into stocktable (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`, `timearray`) values
('$localdate','$rrno','','','$caseno','$pname','$code','$dx','$unitcost','$qtyccx','0','$gen','$qtycc','','$lotno','dispensed','NONE','$localdate','$dept','','NONE','','$user','$coderx','u','$todaytimex', CURDATE(), CURTIME())";
if ($conn->query($sqla1a) === TRUE) {echo "insert into stocktable <br>";}

if($qtycc>=$quantity){$qtyccc = 0; $srp = 0; $gross1 = $gross1 * $qtyccc; $adj1 = $adj1 * $qtyccc;}
else{$srp = $srp; $qtyccc = $quantity - $qtycc; $gross1 = $gross1 * $qtyccc; $adj1 = $adj1 * $qtyccc;}

if($phic>0){$phic = $gross1; $hmo = 0; $exc = 0;}
elseif($hmo>0){$phic = 0; $hmo = $gross1; $exc = 0;}
else{$phic = 0; $hmo = 0; $exc = $gross1;}

$sqla1aaahm = $conn->query("update productouthm set quantity ='$qtyccc', sellingprice='$srp', gross='$gross1', adjustment='$adj1' ,hmo='$hmo', phic='$phic', excess='$exc' where caseno='$caseno' and refno='$refno' and productcode='$code'");

$sqla1aaa = "update productout set quantity ='$qtyccc', sellingprice='$srp', gross='$gross1', adjustment='$adj1' ,hmo='$hmo', phic='$phic', excess='$exc' where caseno='$caseno' and refno='$refno' and productcode='$code'";
if ($conn->query($sqla1aaa) === TRUE) {echo "update productout <br><br>";}


$coder++;
}}}

include "../pharmacy/scm_dispensed_reorderlevel.php";
echo"<script>window.location='?details&batchno=$batchno&caseno=$caseno$datax';</script>";
}
// --------------------------------------------------- END DISPENSE TRANSACTION -----------------------------------------------




$sqla12o = "select * from productout where caseno='$caseno' and batchno='$batchno' and administration='pending' and (status='PAID' or status='Approved')";
$resulta12o = $conn->query($sqla12o);
while($rowa12o = $resulta12o->fetch_assoc()) {
$srp1 =$rowa12o['sellingprice'];
$discount =$rowa12o['adjustment'];
$qty1 =$rowa12o['quantity'];
$totx = $srp1 * $qty1;
$disc_tot += $discount;
$srp_tot += $totx;
$net = $srp_tot - $disc_tot;
}

if($srp_tot>0) {$stx="";} else {$stx="disabled";}

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

$address2 = str_replace(" ", "", $address);
if($address2==""){$address="Address: N/A";}

if(is_numeric($ap)){
$sqlAp=mysqli_query($conn,"SELECT `name` FROM docfile WHERE code='$ap'");
if(mysqli_num_rows($sqlAp)>0){
$myap=mysqli_fetch_array($sqlAp);
$ap=$myap['name'];
}else{$ap="";}
}

if(is_numeric($ad)){
$sqlAp=mysqli_query($conn,"SELECT `name` FROM docfile WHERE code='$ad'");
if(mysqli_num_rows($sqlAp)>0){
$myap=mysqli_fetch_array($sqlAp);
$ad=$myap['name'];
}else{$ad="";}
}


$r2='';$i=0;
$sqla12 = "select * from productout where caseno='$caseno' and batchno='$batchno' and administration='pending' and quantity>0 order by status";
$resulta12 = $conn->query($sqla12);
while($rowa12 = $resulta12->fetch_assoc()){
$caseno =$rowa12['caseno'];
$code =$rowa12['productcode'];
$productdesc =$rowa12['productdesc'];
$refno =$rowa12['refno'];
$quantity =$rowa12['quantity'];
$srp =$rowa12['sellingprice'];
$status =$rowa12['status'];
$terminalname =$rowa12['terminalname'];
$approvalno =$rowa12['approvalno'];

if(($dept=="PHARMACY" or $dept=="pharmacy" or $dept=="PHARMACY_OPD" or $dept=="pharmacy_opd") and $status=="PAID") {
$sqla12g = "select * from collection where refno='$refno'";
$resulta12g = $conn->query($sqla12g);
while($rowa12g = $resulta12g->fetch_assoc()) {$ofrtemp= $rowa12g['ofr']; if($ofrtemp!=""){$ofr=$ofrtemp;}}
}

if($ofr=="" and $dept=="CSR2"){ $ofr = "KMSCI-".date("YmdHis"); }
}


$_SESSION['cun']=base64_encode($userunique);
$_SESSION['cpw']=base64_encode($password);
$_SESSION['cac']=base64_encode($_SESSION['access']);
$_SESSION['cnm']=base64_encode($user);

if($dept=="PHARMACY"){$ct="phm";}
else{$ct="phs";}
?>

<main id="main" class="main">

<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?details&caseno=<?php echo $caseno ?>&batchno=<?php echo $batchno ?>">Patient Information</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">


<div class="col">
<div class="card teacher-card">
<div class="card-body  d-flex">
<div class="profile-av pe-xl-4 pe-md-2 pe-sm-4 pe-4 text-center w220">
<img src='../main/img/<?php echo $avat ?>.png' width='120' height='120' style='border-radius: 50%;'>
<div class="about-info d-flex align-items-center mt-1 justify-content-center flex-column">

<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
<button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#cart" onclick="ccart();"><i class="icofont-ui-cart"></i> Cart</button>

    <div class="btn-group" role="group">
        <button id="btnGroupDrop1" type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="icofont-printer text-danger"></i> {Rx}</button>
        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
            <li style='font-size: 13px;'><a class="dropdown-item" onClick="printinvoice('chargeslip')">Charge Slip</a></li>
            <li style='font-size: 13px;'><a class="dropdown-item" onClick="printinvoice('cashslip')">Cash Slip</a></li>
            <!--li style='font-size: 13px;'><a class="dropdown-item" href="" onClick="printinvoice('allslip')">All</a></li-->
        </ul>
    </div>
</div>

</div>

<script>
function ccart(){
let a=document.createElement('a');
a.target='tabiframe';
a.href='../extra/CartBeta/?caseno=<?php echo $caseno ?>&ct=<?php echo $ct ?>&dept=<?php echo $dept ?>&user=<?php echo $userunique ?>&tick=<?php echo $batchno ?>&<?php echo $homemeds ?>';
a.click(); 
}
</script>    

</div>
<div class="teacher-info border-start ps-xl-4 ps-md-3 ps-sm-4 ps-4 w-100">
<table width="100%"><tr>
<td width="80%">
<h6  class="mb-0 mt-2  fw-bold d-block fs-6"><?php echo strtoupper($patientname) ?></h6>
<span class="py-1 fw-bold small-11 mb-0 mt-1"><?php echo $address ?></span>
</td>
<td valign="bottom" style="font-size: 15px;"><b class="z"><?php echo $mystat ?></b></td>
</tr>
</table>

<div class="collapse show" id="collapseExample">
<div class="card card-body">

<table width="100%">
<tr>
<td style="font-size: 11px;"><i class="bi bi-upc-scan"></i> PRN :</font></td>
<td style="font-size: 11px;"><b><?php echo $patientidno ?></b></font></td>
<td style="font-size: 11px;"><i class="bi bi-box-seam"></i> GCN :</font></td>
<td style="font-size: 11px;"><b><?php echo $caseno ?></b></font></td>
<td style="font-size: 11px;"><i class="bi bi-calendar-date-fill"></i> HCN :</font></td>
<td style="font-size: 11px;"><b><?php echo $employerno ?></b></font></td>
</tr>
<tr>
<td style="font-size: 11px;"><i class="bi bi-person-square"></i> ATTENDING :</font></td>
<td style="font-size: 11px;"><b><?php echo $ap ?></b></font></td>
<td style="font-size: 11px;"><i class="bi bi-person-circle"></i> ADMITTING :</font></td>
<td style="font-size: 11px;"><b><?php echo $ad ?></b></font></td>
<td style="font-size: 11px;"><i class="bi bi-building"></i> ROOM :</font></td>
<td style="font-size: 11px;"><b><?php echo $room ?></b></font></td>
</tr>
<tr>
<td style="font-size: 11px;"><i class="bi bi-calendar-day-fill"></i> DATE/TIME ADMIT :</font></td>
<td style="font-size: 11px;"><b><?php echo date("F d, Y", strtotime($dateadmitted))." ".date("h:i:s a", strtotime($timeadmitted)); ?></b></font></td>
<td style="font-size: 11px;"><i class="bi bi-calendar-month-fill"></i> DATE/IME DISCH.. :</font></td>
<td style="font-size: 11px;"><b><?php echo $datedischarged ?> <?php echo $timedischarged; ?></b></font></td>
<td style="font-size: 11px;"><i class="bi bi-bar-chart-line"></i> STATUS :</font></td>
<td style="font-size: 11px;"><b><?php echo $statusxx ?></b></font></td>
</tr>
<tr>
<td style="font-size: 11px;"><i class="bi bi-calendar2-month"></i> BIRTHDATE :</font></td>
<td style="font-size: 11px;"><b><?php echo $birthdate ?></b></font></td>
<td style="font-size: 11px;"><i class="bi bi-graph-up"></i> AGE :</font></td>
<td style="font-size: 11px;"><b><?php echo $age ?></b></font></td>
<td style="font-size: 11px;"><i class="bi bi-gender-ambiguous"></i> GENDER :</font></td>
<td style="font-size: 11px;"><b><?php echo $sex ?></b></font></td>
</tr>
<tr>
<td style="font-size: 11px;"><i class="bi bi-bar-chart-line"></i> SENIOR :</font></td>
<td style="font-size: 11px;"><b><?php echo $senior ?></b></font></td>
<td style="font-size: 11px;"><i class="bi bi-bar-chart-line"></i> HMO :</font></td>
<td style="font-size: 11px;"><b><?php echo $hmo ?></b></font></td>
<td style="font-size: 11px;"><i class="bi bi-bar-chart-line"></i> PHILHEALTH :</font></td>
<td style="font-size: 11px;"><b><?php echo $membership ?></b></font></td>
</tr>

</table>

</div>
</div>
</div>
</div>
</div>
</div><br>


<div class="card">
<div class="card-body pt-3">

<form method="POST" name="arvz">
<table width="100%" align="center">
<tr>

<td style="font-size:11px; width: 15%;">INVOICE NUMBER:<br><input type="text" name="invno" id="invno" value="<?php echo $ofr ?>" oninput="load(this.value);" style="height:30px; font-size:10pt; padding: 0px; width: 100%;"></td>
<td style="font-size:11px; width: 15%;">GROSS:<br><input type="text" name="total" id="total" value="<?php echo $srp_tot ?>" style="color: red; height:30px; font-size:10pt; padding: 0px; width: 100%;" readonly></font></td>
<td style="font-size:11px; width: 15%;">DISCOUNT:<br><input type="text" name="total2" id="total2" value="<?php echo $disc_tot ?>" style="color: red; height:30px; font-size:10pt; padding: 0px; width: 100%;" readonly></font></td>
<td style="font-size:11px; width: 15%;">NET:<br><input type="text" name="total3" id="total3" value="<?php echo $net ?>" style="color: red; height:30px; font-size:10pt; padding: 0px; width: 100%;" readonly></font></td>
<td valign="bottom">||
<a><button type="button" onClick="SetAllCheckBoxes('arvz', 'checkb[]', true, '<?php echo $srp_tot ?>');" style="width: 10%; height:30px; font-size:10pt; padding: 0px;" class="btn btn-warning" title="Check All" <?php echo $stx ?>><i class="icofont-checked"></i></button></a>
<button type="button" onClick="SetAllCheckBoxes('arvz', 'checkb[]', false, '0');" style="width: 10%; height:30px; font-size:10pt; padding: 0px;" class="btn btn-xs btn-success" title="Uncheck All" <?php echo $stx ?>><i class="icofont-close-squared-alt"></i></button>
<button type="submit" name="btn_dispense" class="btn btn-xs btn-primary" style="width: 30%; height:30px; font-size:10pt; padding: 0px;" title="Dispense Items" <?php echo $stx ?>><i class="icofont-safety"></i> Dispense</button>
</td>
</tr>
</table><hr>


<table class="table">
<thead>
<tr>
<th style="background-color: <?php echo $primarycolor2 ?>; font-size: 11px; width: 5%;">#</th>
<th style="background-color: <?php echo $primarycolor2 ?>; font-size: 11px; width: 50%;">DESCRIPTION</th>
<th style="background-color: <?php echo $primarycolor2 ?>; font-size: 11px; width: 10%;">STATUS</th>
<th style="background-color: <?php echo $primarycolor2 ?>; font-size: 11px; width: 5%;">QTY</th>
<th style="background-color: <?php echo $primarycolor2 ?>; font-size: 11px; width: 5%;">DISPENSE</th>
<th style="background-color: <?php echo $primarycolor2 ?>; font-size: 11px; width: 8%;">SOH</th>
<th style="background-color: <?php echo $primarycolor2 ?>; font-size: 11px; width: 12%;">Amount</th>
<th style="background-color: <?php echo $primarycolor2 ?>; font-size: 11px; width: 5%;"></th>
</tr>
</thead>
<tbody>

<?php
$r2='';$i=0;$x = 0;
$sqla12 = "select * from productout where caseno='$caseno' and batchno='$batchno' and administration='pending' and quantity>0 $xstat order by status";
$resulta12 = $conn->query($sqla12);
while($rowa12 = $resulta12->fetch_assoc()) {
$caseno =$rowa12['caseno'];
$code =$rowa12['productcode'];
$productdesc =$rowa12['productdesc'];
$refno =$rowa12['refno'];
$quantity =$rowa12['quantity'];
$srp =$rowa12['sellingprice'];
$status =$rowa12['status'];
$terminalname =$rowa12['terminalname'];
$approvalno =$rowa12['approvalno'];
$discounting =$rowa12['adjustment'];
$totals=$quantity*$srp;
$discount =$rowa12['adjustment'];
$net =$rowa12['gross'];

$sqla12x = "select sum(quantity) as qtyxx from stocktable where code='$code' and dept='$dept' and rrno='$terminalname'";
$resulta12x = $conn->query($sqla12x);
while($rowa12x = $resulta12x->fetch_assoc()){$qtyx=$rowa12x['qtyxx'];}

$desc2=$productdesc;
$sql222 = $conn->query("SELECT * from labtest where caseno='$caseno' and refno='$refno'");
while($row222 = $sql222->fetch_assoc()) {$remarks=$row222['remarks'];}
if($remarks!=""){$desc2 = "$productdesc <font color='blue' size='2px'>($remarks)</font>";}


$i++; $col="";
$arvcol ="";
$nana = "S".$i;
$nanaxxx = "Z".$i;
$checkbox = "checked";
if($status=="requested"){$arvcol ="red"; $checkbox = "disabled"; $checkbox2 = "";}
if($status=="PAID"){$arvcol ="black"; $checkbox2 = "";}
if($approvalno=="FOR CANCEL"){$col="lightyellow";}else{$col="";}
?>

<tr>
<?php
$valuexx = $caseno.'_'.$code.'_'.$refno.'_'.$quantity.'_'.$terminalname.'_'.$qtyx.'_'.$srp;
if($status=="requested"){echo "<td align='center' valign='TOP'><font color='red'><i class='icofont-warning' aria-hidden='true'></i></td>";}
else{echo"<td align='center' valign='TOP'><input type='checkbox' value='$valuexx' id='$nana' name='checkb[]' onclick='cal($totals, $discounting, this.id, this.checked);' style='transform : scale(1.6);' $checkbox></td>";}
echo"
<input type='hidden' name='caseno' value='$caseno'>
<input type='hidden' name='refno' value='$refno'>
<input type='hidden' name='pname' value='$patientname'>
<input type='hidden' name='batchno' value='$batchno'>
<input type='hidden' name='user' value='$user'>
<input type='hidden' name='datax' value='$datax'>
<input type='hidden' name='qtyxxz' value='$quantity'>
<input type='hidden' name='dept' value='$dept'>
<input type='hidden' name='ip' value='$ip'>

<td bgcolor='$col' style='color: $arvcol; font-size: 11px;' valign='TOP'><b title='$code'>$desc2</b><br><i style='font-size:9px; color:green;'>RRNO: <b>$terminalname</b></i></td>
<td style='color: $arvcol; font-size:11px;' valign='TOP'>$status</td>
<td style='color: $arvcol; font-size:11px;' valign='TOP'>$quantity</td>

<td bgcolor='$col' style='color: $arvcol; font-size: 11px;' valign='TOP'>
<input type='text' name='qty1[]' id='$nanaxxx' value='$quantity' style='color: $arvcol; height:25px; font-size:10pt; padding: 0px; width: 100%; background: #110547; color: white; border-color: #110547; border-radius: 5px;'
class='text-center' oninput='qtyc(this.value, $quantity);' $checkbox>
</td>

<td style='color: $arvcol; font-size:11px;' valign='TOP'>$qtyx </td>
<td style='color: $arvcol; font-size:11px;' valign='TOP'><font color='gray'>SRP:</font> $srp<br><font color='gray'>Gross:</font> $totals<br><font color='gray'>Discount:</font> $discount<br><font color='gray'>Net:</font> $net </td>
</form>

<td bgcolor='$col' style='text-align: center;'>
<table align='center'><tr><td>
";
if($status=="requested" or $status=="Approved") {
echo "
<a onclick='confdelete();' href='?details&caseno=$caseno&batchno=$batchno&refno=$refno&code=$code&desc=$productdesc&delete'><button type='button' class='btn btn-secondary btn-sm' name='btndel' title='Delete Item' style='border-radius: 50%;'><i class='icofont-trash'></i></button></a>
";
} else {echo "<i class='icofont-info-circle' title='Cancel or Manage Qty for Paid Item/s is Prohibited!' style='font-size: 20px; color: red;'></i>";}
echo"</td></tr></table> </td></tr>"; }
?>

</tbody>
</table>

</form>

</div>
</div>

</div>
</div>

</div>
</div>
</section>
</main>



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

function printinvoice(val){
var invno = document.getElementById('invno').value;
let a=document.createElement('a');
a.target='_blank';
a.href='../pharmacy/chargeslip.php?caseno=<?php echo $caseno ?>&pname=<?php echo $patientname ?>&batchno=<?php echo $batchno ?>&user=<?php echo $user ?><?php echo $datax ?>&invno=' + invno + '&' + val;
a.click();
}
</script>


