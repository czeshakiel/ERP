<?php
if(isset($_GET['arpatient'])){
$caseno="AR-".date("YmdHis");
$vv = "AR";
$hidden = "block";
$required = "required";
}else{
$caseno="W".$dept."-".date("YmdHis");
$vv = "WALKIN";
$hidden = "none";
$required = "";
}


if(isset($_GET['pid'])){
$pid = $_GET['pid'];
$act = "btnupdate";
$resulta12xz = $conn->query("select * from patientprofile where patientidno='$pid'");
while($rowa12xz = $resulta12xz->fetch_assoc()) {
$sex=$rowa12xz['sex'];
$lastname = $rowa12xz['lastname'];
$firstname = $rowa12xz['firstname'];
$middlename = $rowa12xz['middlename'];
$patientidno= $rowa12xz['patientidno'];
$dob = $rowa12xz['dateofbirth'];
$suffix = $rowa12xz['suffix'];
if($sex=="F" or $sex=="f"){$female = "selected";}else{$male = "selected";}
}


$resulta12xz1 = $conn->query("select * from admission where patientidno='$pid'");
while($rowa12xz1 = $resulta12xz1->fetch_assoc()) {
$provice = $rowa12xz1['province'];
$municipality = $rowa12xz1['municipality'];
$barangay = $rowa12xz1['barangay'];
$street = $rowa12xz1['street'];
$zipcode = $rowa12xz1['zipcode'];
}

}else{
$act = "btnsave";
}


if(isset($_POST['btnsave'])){
echo"<h1>$_POST[ptidno]ss</h1>";
$btn = $_POST['btnsave'];
$lname = $_POST['lname'];
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$name = $lname." ".$fname." ".$mname;
$suffix = $_POST['suffix'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$controlno = $_POST['controlno'];
$charge = $_POST['charge'];
$discount = $_POST['discount'];
$dadmit = date("M-d-Y");
$tadmit = date("H:i:s");
$datearray = date("Y-m-d");
$ward = "out";
$room = "OPD";

// ------------ get age ------
$now = time();
$your_date = strtotime($dob);
$datediff = $now - $your_date;
$age = floor($datediff / (60*60*24*365));
// ---------------------------



if($btn == "btnsave"){
$pidx = $_POST['ptidno'];
$sql7 = "INSERT INTO `admission`(`patientidno`, `caseno`, `type`, `membership`, `hmomembership`, `hmo`, `corp`, `policyno`, `paymentmode`, `room`, `ward`, `street`, `barangay`, `municipality`, `province`, `zipcode`, `lastnamed`, `firstnamed`, `middlenamed`, `idno`, `bp`, `temp`, `height`, `weight`, `confinementperiod`, `pastmed`, `initialdiagnosis`, `ad`, `ap`, `case`, `dateadmitted`, `timeadmitted`, `status`, `casetype`, `birthplace`, `stat1`, `patientadmit`, `religion`, `occupation`, `job`, `addemployer`, `employerno`, `notify`, `relationship`, `proc`, `contactno`, `course`, `remarks`, `disposition`, `result`, `specialization`, `identity`, `finaldiagnosis`, `patientcontactno`, `diet`, `admittingclerk`, `dateadmit`, `count`, `branch`, `consult_id`) VALUES ('$pidx', '$caseno', 'N/A', 'none', 'none', 'N/A', '', '', 'N/A', '$room', '$ward', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$dadmit', '$tadmit', 'Active', 'A', '', '', '', '', '', 'restrict', '$charge', '$controlno', '', '', '', '0', '', 'NEW', '', '', '', '', '', '', '', '$user', '$datearray', '1', '$branch', '')";
if ($conn->query($sql7) === TRUE) {}

$sql8 = "INSERT INTO `patientprofile`(`patientidno`, `lastname`, `firstname`, `middlename`, `suffix`, `birthdate`, `age`, `sex`, `senior`, `patientname`, `dateofbirth`, `type`) VALUES ('$pidx', '$lname', '$fname', '$mname', '$suffix', '', '$age', '$gender', '$discount', '$name', '$dob', '')";
if ($conn->query($sql8) === TRUE) {}

}else{
$sql7 = "INSERT INTO `admission`(`patientidno`, `caseno`, `type`, `membership`, `hmomembership`, `hmo`, `corp`, `policyno`, `paymentmode`, `room`, `ward`, `street`, `barangay`, `municipality`, `province`, `zipcode`, `lastnamed`, `firstnamed`, `middlenamed`, `idno`, `bp`, `temp`, `height`, `weight`, `confinementperiod`, `pastmed`, `initialdiagnosis`, `ad`, `ap`, `case`, `dateadmitted`, `timeadmitted`, `status`, `casetype`, `birthplace`, `stat1`, `patientadmit`, `religion`, `occupation`, `job`, `addemployer`, `employerno`, `notify`, `relationship`, `proc`, `contactno`, `course`, `remarks`, `disposition`, `result`, `specialization`, `identity`, `finaldiagnosis`, `patientcontactno`, `diet`, `admittingclerk`, `dateadmit`, `count`, `branch`, `consult_id`) VALUES ('$pid', '$caseno', 'N/A', 'none', 'none', 'N/A', '', '', 'N/A', '$room', '$ward', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$dadmit', '$tadmit', 'Active', 'A', '', '', '', '', '', 'restrict', '$charge', '$controlno', '', '', '', '0', '', 'NEW', '', '', '', '', '', '', '', '$user', '$datearray', '1', '$branch', '')";
if ($conn->query($sql7) === TRUE) {}

$sql8 = "UPDATE `patientprofile` SET `lastname`='$lname', `firstname`='$fname', `middlename`='$mname', `suffix`='$suffix', `birthdate`='', `age`='$age', `sex`='$gender', `senior`='$discount', `patientname`='$name', `dateofbirth`='$dob', `type`='' WHERE patientidno = '$pid'";
if ($conn->query($sql8) === TRUE) {}
}

if($dept=="RT" or $dept=="PT"){
$sql88 = "INSERT INTO `ORSCHEDULE`(`patientidno`, `caseno`, `dateofoperation`, `timeofoperation`, `typeofoperation`, `room`, `usages`, `status`, `username`, `branch`) VALUES ('$pid', '$caseno', CURDATE(), CURTIME(), 'RT REFFERAL', '$dept', '', 'RESERVED', '$user', '$branch')";
if ($conn->query($sql88) === TRUE) {}
}

echo"<script> alert('Successfully Admitted..'); window.location = '?main';</script>";
}
?>


<body onload="loadprovince('<?php echo $provice ?>'); loadmunicipality('<?php echo $provice ?>', '<?php echo $municipality ?>'); loadbarangay('<?php echo $municipality ?>', '<?php echo $barangay ?>');">
<main id="main" class="main">

<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?view=main">Main</a></li>
<li class="breadcrumb-item"></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">

<div class="card">
<div class="card-body">

<h5><?php echo $vv ?> ADMISSION <?php echo $dadmit ?></h5><hr>


<form method="POST">
<table width="100%">
<tr><td valign="TOP" width="49%">

<div class="dd-handle">
<div class="task-info d-flex align-items-center justify-content-between">
<table width="100%" align="center">
<tr>
<td width="30%">Last Name:<br><input type="text" name="lname" id="lname" value="<?php echo $lastname ?>" class="form-control" required></td>
</tr>
<tr>
<td>First Name:<br><input type="text" name="fname" id="fname" value="<?php echo $firstname ?>" class="form-control" required></td>
</tr>
<tr>
<td>Middle Name:<br><input type="text" name="mname" id="mname" value="<?php echo $middlename ?>" class="form-control" required></td>
</tr>
<tr>
<td>Suffix:<br><input type="text" name="suffix" id="mname" value="<?php echo $suffix ?>" class="form-control"></td>
</tr>
<tr>
<td width="15%">Gender:<br>
<select name="gender" class="form-control" reuqired>
<option value="M" <?php echo $male ?>>Male</option>
<option value="F" <?php echo $female ?>>Female</option>
</select>
</td>
</tr>

<tr>
<td width="15%">Date of Birth:<br><input type="date" name="dob" value="<?php echo $dob ?>" class="form-control" required></td>
</tr>
</table>
</div></div>

</td><td width="2%"></td><td valign="TOP">

<div class="dd-handle">
<div class="task-info d-flex align-items-center justify-content-between">
<table width="100%">

<tr>
<td><font class="font8">Province:<br><select class="select2-single" style="width: 100%;" name="prov" id="prov" onchange="loadmunicipality(this.value)">
</select>
</td>
</tr>
<tr>
<td><font class="font8">Municipality:<br>
<select name="mun" id="mun" class="select2-single" style="width: 100%;" onchange="loadbarangay(this.value); loadzipcode();">
</select>
</td>
</tr>

<tr>
<td><font class="font8">Barangay:<br>
<select name="barx" id="barx" class="select2-single" style="width: 100%;">
</select>
</td>
</tr>

<tr>
<td><font class="font8">Purok/Street:<br>
<font class="font8"><input type="text" name="street" placeholder="Street/Purok" value="<?php echo $street ?>" class="form-control"></td>
</tr>

<tr>
<td><font class="font8">Zipcode:<br>
<font class="font8"><input type="text" name="zipcode" id="zipcode" placeholder="Zipcode" value="<?php echo $zipcode ?>" class="form-control" readonly></td>
</tr>

<tr>
<td><hr></td>
</tr>

<tr>
<td width="15%">Control No.:<br><input type="text" name="controlno" id="controlno" value="<?php echo $caseno; ?>" class="form-control" required></td>
</tr>
<tr style="display: <?php echo $hidden ?>;">
<td width="30%">Charge to:<br>
<select name="charge" id="charge" class="select2-single form-control" style="font-size: 44px;" <?php echo $required ?>>
<option value=""></option>
<?php
$sqlemp=mysqli_query($conn,"SELECT empid,`name` FROM nsauthemployees ORDER BY lastname ASC");
if(mysqli_num_rows($sqlemp)>0){
while($emp=mysqli_fetch_array($sqlemp)){echo "<option value='$emp[empid]'>$emp[name]</option>";}
}

$sqlemp=mysqli_query($conn,"SELECT accttitle FROM accttitle WHERE accttitle LIKE '%AR %' ORDER BY accttitle ASC");
if(mysqli_num_rows($sqlemp)>0){
while($emp=mysqli_fetch_array($sqlemp)){echo "<option value='$emp[accttitle]'>$emp[accttitle]</option>";}
}
?>
</select>
</td>
</tr>
<tr>
<td width="15%">Discount Type:<br>
<select name="discount" id="dischount" class="select2-single2 form-control" required>
<option value="N">None</option>
<option value="Y">PWD/ Senior</option>
</select>
</td>
</tr>
</table>
</div></div>

<br>
<input type='hidden' name='ptidno' id='ptidno'>


<div class="card" style='box-shadow: 0px 0px 0px 1px #5d344f;'>
<div class="card-header" style="background-color: #5d344f; padding: 7px; color: white;"><i class="icofont-lock"></i> Authentication</div>
<div class="card-body">
<table width="100%">
<tr>
<td>Password:<br><input type="password" name="password" id="passw" value="" class="form-control" required></td>
</tr>
<tr><td align="right"> <br><button type="button" onclick="loadvalidate();" name="btnsave" id="btnsave" value="<?php echo $act ?>" class="btn btn-danger" style="background: #5d344f; color: white;"><i class="icofont-check-circled"></i> Submit Admission</button></td></tr>
</table>
</div></div>

</td>
</tr>
</table>
</form>
<br>



</div>
</div>

</div>
</div>
</section>

</main>



<script>
function loadvalidate(){
var caseno = document.getElementById("controlno").value;
var pass = document.getElementById("passw").value;
var str = "validate_cp";

$.get("../main/functions.php", {
caseno:caseno, pass:pass, str:str
}, function (data) {
var all = data;
data = data.replace(/(\r\n|\n|\r)/gm, ""); // remove nextline
data = data.replace(/\s+/g, ''); // remove spacing

if(data=="ok"){

var seqname ="P";
var user = "<?php echo $user ?>";
var str = "generateseq";

$.get("../main/functions.php", {seqname:seqname, user:user, str:str},
function (datax) {
document.getElementById("ptidno").value = datax;

$("#btnsave").get(0).type = "submit";
$("#btnsave").click();
});

}else{

$("#btnsave").get(0).type = "button";
alert(all);

}
});


}



function loadprovince(str) {
var str2 = "loadprovince";
$.get("../main/functions.php", {str:str2, str2:str},
function (data, status) {$("#prov").html(data);});  
}

function loadmunicipality(str, str3) {
var str2 = "loadmunicipality";
$.get("../main/functions.php", {str:str2, str2:str, str3:str3},
function (data, status) {$("#mun").html(data);});
}

function loadbarangay(str, str3) {
var str2 = "loadbarangay";
$.get("../main/functions.php", {str:str2, str2:str, str3:str3},
function (data, status) {$("#barx").html(data);});  
}

function loadzipcode(){
var pro = document.getElementById('prov').value;
var mun = document.getElementById('mun').value;
var str2 = "loadzipcode";
$.get("../main/functions.php", {str:str2, pro:pro, mun:mun},
function (data, status) {document.getElementById("zipcode").value=data;});  
}
</script>