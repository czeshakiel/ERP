<?php
if(isset($_POST['btn_sub'])){
$caseno = $_POST['caseno'];
$refno = $_POST['refno'];
$doctor = $_POST['ap'];
$today = date("Ymd");
$todaytime = date("his");
$coder=$todaytime."".$today;
$localdate = date("M-d-Y");
$todayx = date("Y-m-d");
$todaytimex = date("H:i:s");
$daylight = $todayx." ".$todaytimex;
$designation="CARDIOLOGIST";
$technician="EVANGELINE ULEP";
$initial= $_POST['initial'];
$result=addslashes($_POST['result']);
$trantype = $_POST['trantype'];
$radiologist = $_POST['radiologist'];
$transcriptionist= $user;
$senior = $_POST['senior'];
$val=$_POST['val'];
$velosity=$_POST['velosity'];
$peak=$_POST['peak'];
$valve=$_POST['valve'];
$vti=$_POST['vti'];


$vc=$_POST['vc'];
$percent=$_POST['percent'];
$jet=$_POST['jet'];
$volume=$_POST['volume'];
$gradient=$_POST['gradient'];
$g5=$_POST['g5'];

$filmno = $_POST['filmno'];
$cardiologist = $_POST['cardiologist'];

$user_film = $user."_".$filmno;

$sql2z = "SELECT * FROM productout where refno='$refno' and caseno='$caseno'";
$result2z = $conn->query($sql2z);
while($row2z = $result2z->fetch_assoc()) {
$productcode=$row2z['productcode'];
}

$sql2zy = "SELECT * FROM nsauthdoctors where name='$radiologist'";
$result2zy = $conn->query($sql2zy);
while($row2zy = $result2zy->fetch_assoc()) {
$empid=$row2zy['empid'];
}

$sql2zyy = "SELECT max(autono) as maxid FROM readersfee";
$result2zyy = $conn->query($sql2zyy);
while($row2zyy = $result2zyy->fetch_assoc()) {
$maxid=$row2zyy['maxid'];
}
$maxid = $maxid + 1;


$sql2zz = "SELECT * FROM productsmasterlist where code='$productcode'";
$result2zz = $conn->query($sql2zz);
while($row2zz = $result2zz->fetch_assoc()){
$opdprice=$row2zz['opd'];
}

$sql2zz = "SELECT * FROM receiving where code='$productcode'";
$result2zz = $conn->query($sql2zz);
while($row2zz = $result2zz->fetch_assoc()){
$desc=$row2zz['description'];
}

$sql2g = "SELECT * FROM nsauthdoctors where empid='$radiologist' order by name";
$result2g = $conn->query($sql2g);
while($row2g = $result2g->fetch_assoc()) {
$name=$row2g['name'];
$empid=$row2g['empid'];
}
$userdec = "Set By: ".$user; // examnurse column
$userrad = "EVANGELINE ULEP"; // examperform column

if($senior=="y" or $senior=="Y"){$opdprice1 = $opdprice * .20; $opdprice = $opdprice - $opdprice1;}
else{$opdprice1 = 0; $opdprice = $opdprice - $opdprice1;}
$amtSum1 = $opdprice * .25;


// DELETE EXISTING VALUE //
$sql7 = $conn->query("delete from xray1 where refno='$refno' and caseno='$caseno'");
$sql7 = $conn->query("delete from 2dechoresult_ver2 where refno='$refno' and caseno='$caseno'");
$sql7 = $conn->query("delete from productout where batchno='$refno' and caseno='$caseno'");
$sql7 = $conn->query("delete from readersfee where refno1='$refno' and caseno='$caseno'");


// INSERT AND UPDATE DATA //
$sql7 = $conn->query("update productout set terminalname='Testdone', approvalno='$user_film' where refno='$refno' and caseno='$caseno'");
$sqll = $conn->query("insert into xray1 (`patientidno`, `caseno`, `refno`, `radiologist`, `partexamined`, `examnurse` , `examperform`) values ('$patientidno', '$caseno', '$refno', '$name', '$desc', '$userdec', '$userrad')");


$sqll = $conn->query("insert into 2dechoresult_ver2 (`patientidno`, `caseno`, `refno`, `reader`, `partexamined`, `validate`,remarks) values ('$patientidno','$caseno','$refno','$name','$desc','$cardiologist','$technician')");


$count=60;
for($i=1; $i<=$count; $i++){
$ii = $i-1; $table="lab".$i; $value = $val[$ii];
$sql77 = $conn->query("UPDATE 2dechoresult_ver2  set {$table}='$value' where refno = '$refno' and caseno='$caseno'");
}

// ---------->> Velosity
$count=66; $dv = 0;
for($i=61; $i<=$count; $i++){
$table="lab".$i; $value = $velosity[$dv];
$sql77 = $conn->query("UPDATE 2dechoresult_ver2  set {$table}='$value' where refno = '$refno' and caseno='$caseno'");
$dv++;
}

// ---------->> Peak
$count=72; $dv = 0;
for($i=67; $i<=$count; $i++){
$table="lab".$i; $value = $peak[$dv];
$sql77 = $conn->query("UPDATE 2dechoresult_ver2  set {$table}='$value' where refno = '$refno' and caseno='$caseno'");
$dv++;
}

// ---------->> Valve
$count=78; $dv = 0;
for($i=73; $i<=$count; $i++){
$table="lab".$i; $value = $valve[$dv];
$sql77 = $conn->query("UPDATE 2dechoresult_ver2  set {$table}='$value' where refno = '$refno' and caseno='$caseno'");
$dv++;
}

// ---------->> VTI
$count=84; $dv = 0;
for($i=79; $i<=$count; $i++){
$table="lab".$i; $value = $vti[$dv];
$sql77 = $conn->query("UPDATE 2dechoresult_ver2  set {$table}='$value' where refno = '$refno' and caseno='$caseno'");
$dv++;
}

// ---------->> VC
$count=88; $dv = 0;
for($i=85; $i<=$count; $i++){
$table="lab".$i; $value = $vc[$dv];
$sql77 = $conn->query("UPDATE 2dechoresult_ver2  set {$table}='$value' where refno = '$refno' and caseno='$caseno'");
$dv++;
}

// ---------->> percent
$count=92; $dv = 0;
for($i=89; $i<=$count; $i++){
$table="lab".$i; $value = $percent[$dv];
$sql77 = $conn->query("UPDATE 2dechoresult_ver2  set {$table}='$value' where refno = '$refno' and caseno='$caseno'");
$dv++;
}

// ---------->> jet
$count=96; $dv = 0;
for($i=93; $i<=$count; $i++){
$table="lab".$i; $value = $jet[$dv];
$sql77 = $conn->query("UPDATE 2dechoresult_ver2  set {$table}='$value' where refno = '$refno' and caseno='$caseno'");
$dv++;
}

// ---------->> volume
$count=100; $dv = 0;
for($i=97; $i<=$count; $i++){
$table="lab".$i; $value = $volume[$dv];
$sql77 = $conn->query("UPDATE 2dechoresult_ver2  set {$table}='$value' where refno = '$refno' and caseno='$caseno'");
$dv++;
}

// ---------->> gradient
$count=104; $dv = 0;
for($i=101; $i<=$count; $i++){
$table="lab".$i; $value = $gradient[$dv];
$sql77 = $conn->query("UPDATE 2dechoresult_ver2  set {$table}='$value' where refno = '$refno' and caseno='$caseno'");
$dv++;
}

// ---------->> g5
$count=111; $dv = 0;
for($i=105; $i<=$count; $i++){
$table="lab".$i; $value = $g5[$dv];
$sql77 = $conn->query("UPDATE 2dechoresult_ver2  set {$table}='$value' where refno = '$refno' and caseno='$caseno'");
$dv++;
}

$sql77 = $conn->query("UPDATE 2dechoresult_ver2  set interpretation='$result', date='$daylight', authno='$coder', designation='$designation', remarks='$technician', filmno='$filmno', referredby='$doctor' where refno = '$refno' and caseno='$caseno'");


//==============
if ($trantype == "cash"){
$sql778 = $conn->query("insert into productout values('$coder','$todaytimex','$caseno','$empid','$radiologist','$amtSum1','1','0','$amtSum1','NONE','0','0','$amtSum1','$localdate','PAID','$productcode','','$refno','READERS FEE','PROFESSIONAL FEE','','$refno','','$branch','','$todayx','')");
}

if ($trantype == "charge") {
$sql779 = $conn->query("insert into productout values('$coder','$todaytimex','$caseno','$empid','$radiologist','$amtSum1','1','0','$amtSum1','NONE','0','$amtSum1','0','$localdate','Approved','$productcode','','$refno','READERS FEE','PROFESSIONAL FEE','','$refno','','$branch','','$todayx','')");
}
//==============

$sql777 = $conn->query("insert into readersfee values('$maxid','$caseno','$coder','$productcode','$radiologist','$empid','$todayx','$refno','$amtSum1','$opdprice','$senior','PROFESSIONAL FEE')");
echo"<script>alert('Successfully Saved...'); window.location='?view=detail&caseno=$caseno$datax';</script>";
}
?>



<?php
$caseno = $_GET['caseno'];
$description = $_GET['description'];
$prodsubtype = $_GET['prodsubtype'];
$prodsubtype = $prodsubtype." RESULT";
$refno = $_GET['refno'];
$trantype = $_GET['trantype'];
$func = "";
$label = "SUBMIT";


$sqlx1 = "SELECT * FROM admission where caseno='$caseno'";
$resultx1 = $conn->query($sqlx1);
while($rowx1 = $resultx1->fetch_assoc()) {
$patientidno=$rowx1['patientidno'];
$initialdiagnosis=$rowx1['initialdiagnosis'];
$finaldiagnosis=$rowx1['finaldiagnosis'];
$employerno=$rowx1['employerno'];
$room=$rowx1['room'];
$membership=$rowx1['membership'];
$hmo=$rowx1['hmo'];
$street=$rowx1['street'];
$barangay=$rowx1['barangay'];
$municipality=$rowx1['municipality'];
$province=$rowx1['province'];
$address = $street." ".$barangay." ".$municipality." ".$province;
$branch=$_GET['branch'];
$dateadmitted=$rowx1['dateadmitted'];
$timeadmitted=$rowx1['timeadmitted'];
$ap=$rowx1['ap'];
$ad=$rowx1['ad'];
$patientcontactno=$rowx1['patientcontactno'];
$policyno=$rowx1['policyno'];
$statusxx=$rowx1['status'];
$resultsxx=$rowx1['result'];
$ward=$rowx1['ward'];
$identity=$rowx1['identity'];
if($statusxx=="MGH" or $statusxx=="YELLOW TAG"){$blink="<p class='blink'>";}
else{$blink="";}
$hmomembership=$rowx1['hmomembership'];
if($hmomembership == "hmo-hmo") {$hmomembership = "WITH HMO";}
if($hmomembership == "hmo-company") {$hmomembership = "WITH COMPANY";}
if($hmomembership =="none") {$hmomembership = "NONE";}
if ($membership == "Nonmed-none") {$membership = "NO";}
if ($membership == "phic-med") {$membership = "YES";}
if ($ward == "out") {$ward = "OUTPATIENT";}
if ($ward == "in") {$ward = "INPATIENT";}
}

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


$cn=explode('-',$caseno);
if($cn[0]=="AR"){
$sqlx2 = "SELECT * FROM nsauthemployees where empid='$patientidno'";
$resultx2 = $conn->query($sqlx2);
if(mysqli_num_rows($resultx2)>0){
while($rowx2 = $resultx2->fetch_assoc()) {
$patientidno=$rowx2['empid'];
$sex=$rowx2['gender'];
if($sex=="F"){$sex="FEMALE"; $avat = "female";}
else{$sex="MALE"; $avat = "male";}
$age=$rowx2['age'];
$birthdate=$rowx2['birthdate'];
$patientname=$rowx2['name'];
$senior=$rowx2['senior'];
}

}else{

mysqli_query($conn,"SET NAMES 'utf8'");
$sqlx2 = "SELECT * FROM patientprofile where patientidno='$patientidno'";
$resultx2 = $conn->query($sqlx2);
while($rowx2 = $resultx2->fetch_assoc()) {
$patientidno=$rowx2['patientidno'];
$sex=$rowx2['sex'];
if($sex=="F"){$sex="FEMALE"; $avat = "female";}
else{$sex="MALE"; $avat = "male";}
$age=$rowx2['age'];
$birthdate=$rowx2['birthdate'];
$senior=$rowx2['senior'];
$patientname=$rowx2['patientname'];
}
}
}else{
mysqli_query($conn,"SET NAMES 'utf8'");
$sqlx2 = "SELECT * FROM patientprofile where patientidno='$patientidno'";
$resultx2 = $conn->query($sqlx2);
while($rowx2 = $resultx2->fetch_assoc()) {
$patientidno=$rowx2['patientidno'];
$sex=$rowx2['sex'];
if($sex=="F"){$sex="FEMALE"; $avat = "female";}
else{$sex="MALE"; $avat = "male";}
$age=$rowx2['age'];
$birthdate=$rowx2['birthdate'];
$senior=$rowx2['senior'];
$patientname=$rowx2['patientname'];
}
}

$patient=$patientname."_".$caseno;
$datedischarged="";
$timedischarged="";
$sqlx3 = "SELECT * FROM dischargedtable where caseno='$caseno'";
$resultx3 = $conn->query($sqlx3);
while($rowx3 = $resultx3->fetch_assoc()) {
$datedischarged=$rowx3['datedischarged'];
$timedischarged=$rowx3['timedischarged'];
}

$sqlPatientProfile=mysqli_query($conn,"SELECT * FROM patientprofile WHERE patientidno='$patientidno'");
if(mysqli_num_rows($sqlPatientProfile)>0){
$patientname=mysqli_fetch_array($sqlPatientProfile)['patientname'];
}

$gross=0;
$grosshmo=0;
$sqlx4 = "SELECT sellingprice, quantity, hmo FROM productout WHERE caseno='$caseno' AND quantity > 0 AND trantype='charge'
AND productsubtype NOT LIKE '%OTHERS%' AND producttype NOT LIKE '%READERS FEE%' AND approvalno NOT LIKE '%proferfee%' AND
approvalno NOT LIKE '%instrument%' AND producttype NOT LIKE '%PAYMENT OF%'";
$resultx4 = $conn->query($sqlx4);
while($rowx4 = $resultx4->fetch_assoc()) {
$rsp=$rowx4['sellingprice'];
$rqt=$rowx4['quantity'];
$rad=$rowx4['adjustment'];
$gross+=($rsp*$rqt)-$rad;
$grosshmo+=$rowx4['hmo'];
}

$pf1 ="0.00"; $hp1="0.00"; $total1="0.00"; $pf2 ="0.00"; $hp2="0.00"; $total2="0.00";

$sqlx5 = "SELECT * FROM finalcaserate where caseno ='$caseno' and level='primary'";
$resultx5 = $conn->query($sqlx5);
while($rowx5 = $resultx5->fetch_assoc()) {
$case1=$rowx5['icdcode'];
$pf1=$rowx5['pfshare'];
$hp1=$rowx5['hospitalshare'];
$total1 = $pf1 + $hp1;
$pf1=number_format($pf1, 2);
$hp1=number_format($hp1, 2);
$total1=number_format($total1, 2);
}
$sqlx5 = "SELECT * FROM finalcaserate where caseno ='$caseno' and level='secondary'";
$resultx5 = $conn->query($sqlx5);
while($rowx5 = $resultx5->fetch_assoc()) {
$case2=$rowx5['icdcode'];
$pf2=$rowx5['pfshare'];
$hp2=$rowx5['hospitalshare'];
$total2 = $pf2 + $hp2;
$pf2=number_format($pf2, 2);
$hp2=number_format($hp2, 2);
$total2=number_format($total2, 2);
}



$sql1x = $conn->query("select * from 2dechoresult_ver2 where caseno='$caseno' and refno='$refno'");
while($row1x = $sql1x->fetch_assoc()){
$radiologist=$row1x['reader'];
$prodsubtype=$row1x['clinicalservices'];
$interpretation=$row1x['interpretation'];
$interpret=$row1x['interpretation'];
$description=$row1x['partexamined'];
$filmno=$row1x['filmno'];
$remarks=$row1x['remarks'];
$validate=$row1x['validate'];

for($i=1; $i <= 111;$i++){$table="lab".$i; $lab[$i]=$row1x["$table"];}
}

$tt = $conn->query("select * from productout where caseno='$caseno' and refno='$refno'");
while($tt1 = $tt->fetch_assoc()){$trantype = $tt1['trantype'];}

?>


<form method="POST" name="arv">



<main id="main" class="main">
<div class="pagetitle">
<h1><?php echo strtoupper($dept)." DEPARTMENT" ?></h1>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?view=main">Main</a></li>
<li class="breadcrumb-item"><a href=""></a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body"><br>



<div class="card">
<div class="card-body">
<html>
<head>
</head>
<body>


<table width="100%"><tr><td valign="TOP" width="65%">

<table border="0" style="width: 100%;" align='center' cellpadding='0' cellspacing='0' bordercolor='#000000'>
<tr><th colspan="8">

<table width="100%"><tr>
<td width="10%">
<img src="../main/img/<?php echo $avat ?>.png" style='border-radius: 50%;' width='60' height='60'>
</td><td valign="bottom" style="text-align: left;">
<font class="font2" color="red"> <?php echo $patientname?></font>
<font color="#086678" class="font8x"><?php echo $address?></font>
<font color="black" class="font8x">ATTENDING: <?php echo $ap ?></font>
</td></tr></table>
</th></tr>
<tr>
<td width="25%"><font size="2" color="black" class="font7">PATIENTID NO: </td>
<td width="25%"><font size="2" color="black" class="font7"><?php echo $patientidno ?></td>
<td width="25%"><font size="2" color="black" class="font7">CASENO: </td>
<td width="25%"><font size="2" color="black" class="font7"><?php echo $caseno ?></td>
<tr>
<tr>
<td><font size="2" color="black" class="font7">AGE/ GENDER/ SENIOR: </td>
<td><font size="2" color="black" class="font7"><?php echo $age?>/ <?php echo $sex ?>/ <?php echo $senior ?></td>
<td><font size="2" color="black" class="font7">BIRTHDATE:</td>
<td><font size="2" color="black" class="font7"><?php echo $birthdate ?></td>
<tr>
<tr>
<td><font size="2" color="black" class="font7">HMO: </td>
<td><font size="2" color="black" class="font7"><?php echo $hmo ?></td>
<td><font size="2" color="black" class="font7">PHILHEALTH: </td>
<td><font size="2" color="black" class="font7"><?php echo $membership ?></td>
<tr>
<tr>
<td><font size="2" color="black" class="font7">DATE/TIME ADMITTED: </td>
<td><font size="2" color="black" class="font7"><?php echo $dateadmitted." ".$timeadmitted ?></td>
<td><font size="2" color="black" class="font7">ROOM NO:</td>
<td><font size="2" color="black" class="font7"><?php echo $room ?></td>
</tr>
</table>

</td><td style="border: 1px solid black; background: black;"></td>
<td valign="bottom">


<table width="90%" align="center">
<tr>
<td width="40%">
<font color="black">READER:
</td><td>
<select class="select2-single form-control" name="radiologist" required>
<option></option>
<?php
$sql2g = "SELECT * FROM nsauthdoctors where station='HEARTREADER' or station='HEARTDOCTOR' ORDER BY FIELD(Access, 'Internal Medicine') DESC";
$result2g = $conn->query($sql2g);
while($row2g = $result2g->fetch_assoc()) {
$name=$row2g['name'];
$empid=$row2g['empid'];
if($radiologist == $name){echo "<option value='$empid' selected>$name</option> ";}
echo "<option value='$empid'>$name</option> ";
}
?>
</select>
</td>
</tr><tr>
<td width="40%">
<font color="black">CARDIOLOGIST:
</td><td>
<select class="select2-single form-control" name="cardiologist" required>

<?php
$sql2 = "SELECT * FROM nsauthdoctors where station='HEARTDOCTOR' order by name";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$namex=$row2['name'];

if($validate == $namex){echo "<option value='$namex' selected>$namex</option> ";}
echo "<option value='$namex'>$namex</option>";
}
?>
</select>
</td>
</tr><tr>
<td><font color="black">FILM NO.:</td>
<td><input type="text" name="filmno" value="<?php echo $filmno ?>" style="height:30px; font-size:12pt; padding: 0px; text-align: center;" required></td>
</tr>
</table>



</td>
</tr></table>
</body>
</html>
</div>
</div>



<table align="center" width="100%">
<tr>
<td>

<hr>


</td>
</tr>
<tr>
<td>
<p align="center"><font color="black"><b>2D AND M-MODE MEASUREMENT</b></p>
<table width="90%" align="center">
<tr><td>
<!----------------------------------------------------- GROUP 1 --------------------------------------------->
<table width="95%" class="tablex">
<tr>
<th bgcolor="lightyellow" class="text-center" width="25%"><font class="font8"><b>PARAMETERS</th>
<th bgcolor="lightyellow" class="text-center" width="25%"><font class="font8"><b>RESULT</th>
<th bgcolor="lightyellow" class="text-center" width="25%"><font class="font8"><b>NORMAL VALUES</th>
</tr>
<?php
$tab=1;
$sql2 = $conn->query("SELECT * FROM 2decho_ver2 where 2decho_ver2.group='1' order by id");
while($row2 = $sql2->fetch_assoc()){
$demension=$row2['demension'];
$id=$row2['id'];
$ns=$row2['normalstart'];
$ne=$row2['normalend'];
$nv=$row2['normalvalues'];
if($nv==""){$nv="-";}
?>
<tr>
<td class="text-center"><font color="black"><font class="font8"><?php echo $demension ?></td>
<td class="text-center"><font color="black"><input type="text" name="val[]" oninput="find(this.value,<?php echo $ns ?>,<?php echo $ne ?>,<?php echo $tab ?>) " tabindex="<?php echo $tab; ?>" style="height:30px; font-size:12pt; padding: 0px; text-align: center; width: 95%;" value="<?php echo $lab[$tab] ?>"></td>
<td class="text-center"><font color="black" size="1%"><?php echo $nv ?></td>
</tr>
<?php
$tab++;
}
?>
</table>
<!------------------------------------------------- END GROUP 1 --------------------------------------------->

</td><td width="1%"></td><td>

<!----------------------------------------------------- GROUP 2 --------------------------------------------->
<table width="95%" class="tablex">
<tr>
<th bgcolor="lightyellow" class="text-center" width="25%"><font class="font8"><b>PARAMETERS</th>
<th bgcolor="lightyellow" class="text-center" width="25%"><font class="font8"><b>RESULT</th>
<th bgcolor="lightyellow" class="text-center" width="25%"><font class="font8"><b>NORMAL VALUES</th>
</tr>
<?php
$tab=31;
$sql2 = $conn->query("SELECT * FROM 2decho_ver2 where 2decho_ver2.group='2' order by id");
while($row2 = $sql2->fetch_assoc()){
$demension=$row2['demension'];
$id=$row2['id'];
$ns=$row2['normalstart'];
$ne=$row2['normalend'];
$nv=$row2['normalvalues'];
if($nv==""){$nv="-";}
?>
<tr>
<td class="text-center"><font color="black"><font class="font8"><?php echo $demension ?></td>
<td class="text-center"><font color="black"><input type="text" name="val[]" oninput="find(this.value,<?php echo $ns ?>,<?php echo $ne ?>,<?php echo $tab ?>) " tabindex="<?php echo $tab; ?>" style="height:30px; font-size:12pt; padding: 0px; text-align: center; width: 95%;" value="<?php echo $lab[$tab] ?>"></td>
<td class="text-center"><font color="black" size="1%"><?php echo $nv ?></td>
</tr>
<?php
$tab++;
}
?>
</table>
<!------------------------------------------------- END GROUP 2 --------------------------------------------->


</td></tr></table>
<br>


</td>
</tr>
<tr>
<td>
<p align="center"><font color="black"><b>DOPPLER STUDY</b></p>
<table width="90%" align="center"><tr><td width="65%">



<!----------------------------------------------------- GROUP 3 --------------------------------------------->
<table width="95%" class="tablex">
<tr>
<th bgcolor="lightyellow" width="22%" class="text-center"><font class="font8"><b>VALVE</th>
<th bgcolor="lightyellow" width="20%" class="text-center"><font class="font8"><b>Velocity (m/sec) (E/A)</th>
<th bgcolor="lightyellow" width="20%" class="text-center"><font class="font8"><b>PEAK GRADIENT</th>
<th bgcolor="lightyellow" width="20%" class="text-center"><font class="font8"><b>Valve Area</th>
<th bgcolor="lightyellow" width="18%" class="text-center"><font class="font8"><b>VTI (cm)</th>
</tr>
<?php
$sql2 = "SELECT * FROM 2decho_ver2 where 2decho_ver2.group='3'";
$result2 = $conn->query($sql2);
$tab=61; $velocity=61; $peak=67; $valve=73; $vti=79;
while($row2 = $result2->fetch_assoc()) {
$demension=$row2['demension'];
$id=$row2['id'];
$ns=$row2['normalstart'];
$ne=$row2['normalend'];
if($demension=="PAPressure"){$val2 = "PAT=";}
if(strpos($lab[$max], "PAT=") !== false){$val2 ="";}
?>
<tr>
<td class="text-center"><font color="black"><font class="font8"><?php echo $demension ?></td>
<td class="text-center"><font color="black"><input type="text" name="velosity[]" value="<?php echo $val2.$lab[$velocity]; ?>" tabindex="<?php echo $tab; ?>" style="text-align: center; height:30px; font-size:12pt; padding: 0px; width: 95%;"></td>
<td class="text-center"><font color="black"><input type="text" name="peak[]" value="<?php echo $lab[$peak]; ?>" tabindex="<?php echo $tab; ?>" style="text-align: center; height:30px; font-size:12pt; padding: 0px; width: 95%;"></td>
<td class="text-center"><font color="black"><input type="text" name="valve[]" value="<?php echo $lab[$valve]; ?>" tabindex="<?php echo $tab; ?>" style="text-align: center; height:30px; font-size:12pt; padding: 0px; width: 95%;"></td>
<td class="text-center"><font color="black"><input type="text" name="vti[]" value="<?php echo $lab[$vti]; ?>" tabindex="<?php echo $tab; ?>" style="text-align: center; height:30px; font-size:12pt; padding: 0px; width: 95%;"></td>
</tr>
<?php
$tab++; $velocity++; $peak++; $valve++; $vti++;
}
?>
</table>
<!------------------------------------------------- END GROUP 3 --------------------------------------------->
<br>
<!----------------------------------------------------- GROUP 4 --------------------------------------------->
<table width="95%" class="tablex">
<tr>
<th bgcolor="lightyellow" width="25%" class="text-center"><font class="font8"><b></th>
<th bgcolor="lightyellow" width="15%" class="text-center"><font class="font8"><b>VC</th>
<th bgcolor="lightyellow" width="15%" class="text-center"><font class="font8"><b>%</th>
<th bgcolor="lightyellow" width="15%" class="text-center"><font class="font8"><b>Jet Area</th>
<th bgcolor="lightyellow" width="15%" class="text-center"><font class="font8"><b>Volume</th>
<th bgcolor="lightyellow" width="15%" class="text-center"><font class="font8"><b>Gradient</th>
</tr>
<?php
$sql2 = "SELECT * FROM 2decho_ver2 where 2decho_ver2.group='4'";
$result2 = $conn->query($sql2);
$tab=85;
$vc=85; $perc=89; $jet=93; $volume=97; $grad=101;
while($row2 = $result2->fetch_assoc()) {
$demension=$row2['demension'];
$id=$row2['id'];
$ns=$row2['normalstart'];
$ne=$row2['normalend'];
if($demension=="PAPressure"){$val2 = "PAT=";}
if(strpos($lab[$max], "PAT=") !== false){$val2 ="";}
?>
<tr>
<td class="text-center"><font color="black"><font class="font8"><?php echo $demension ?></td>
<td class="text-center"><font color="black"><input type="text" name="vc[]" value="<?php echo $val2.$lab[$vc]; ?>" tabindex="<?php echo $tab; ?>" style="text-align: center; height:30px; font-size:12pt; padding: 0px; width: 95%;"></td>
<td class="text-center"><font color="black"><input type="text" name="percent[]" value="<?php echo $lab[$perc]; ?>" tabindex="<?php echo $tab; ?>" style="text-align: center; height:30px; font-size:12pt; padding: 0px; width: 95%;"></td>
<td class="text-center"><font color="black"><input type="text" name="jet[]" value="<?php echo $lab[$jet]; ?>" tabindex="<?php echo $tab; ?>" style="text-align: center; height:30px; font-size:12pt; padding: 0px; width: 95%;"></td>
<td class="text-center"><font color="black"><input type="text" name="volume[]" value="<?php echo $lab[$volume]; ?>" tabindex="<?php echo $tab; ?>" style="text-align: center; height:30px; font-size:12pt; padding: 0px; width: 95%;"></td>
<td class="text-center"><font color="black"><input type="text" name="gradient[]" value="<?php echo $lab[$grad]; ?>" tabindex="<?php echo $tab; ?>" style="text-align: center; height:30px; font-size:12pt; padding: 0px; width: 95%;"></td>
</tr>
<?php
$tab++; $vc++; $perc++; $jet++; $volume++; $grad++;
}
?>

</table>
<!------------------------------------------------- END GROUP 4 --------------------------------------------->




</td><td width="1%"></td><td valign="TOP">

<!----------------------------------------------------- GROUP 5 --------------------------------------------->
<table width="95%" class="tablex">
<th bgcolor="lightyellow" width="50%" class="text-center"><font class="font8"><b></th>
<th bgcolor="lightyellow" class="text-center"><font class="font8"><b></th>
</tr>
<?php
$sql2 = "SELECT * FROM 2decho_ver2 where 2decho_ver2.group='5'";
$result2 = $conn->query($sql2);
$tab=106;
$g5=105;
while($row2 = $result2->fetch_assoc()) {
$demension=$row2['demension'];
$id=$row2['id'];
$ns=$row2['normalstart'];
$ne=$row2['normalend'];
if($demension=="PAPressure"){$val2 = "PAT=";}
if(strpos($lab[$max], "PAT=") !== false){$val2 ="";}
?>
<tr>
<td class="text-center"><font color="black"><font class="font8"><?php echo $demension ?></td>
<td class="text-center"><font color="black"><input type="text" name="g5[]" value="<?php echo $val2.$lab[$g5]; ?>" tabindex="<?php echo $tab++; ?>" style="text-align: center; height:30px; font-size:12pt; padding: 0px; width: 95%;"></td>
</tr>
<?php
$g5++;
}
?>
</table>
<!------------------------------------------------- END GROUP 5 --------------------------------------------->

</td></tr></table>

</td>
</tr>
<tr>
<td>
<hr>
<p align="left"><font color="black">
RESULT WITH INITIAL READING:
<select name="initial" onchange="arv.result.value=this.value">
<option value=""></option>
<?php
$sql2 = "SELECT * from 2dechoinitial";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()){
$desc=$row2['desc'];
$value=$row2['val'];
echo "<option value='$value'>$desc</option>";
}
?>
</select>
</font>
</p>
</td>
</tr>
<tr>
<td>
<font color="black"><textarea id="result" name="result" rows="8" cols="150" <?php echo $func ?>><?php echo $interpret ?></textarea></font>
<input type="hidden" name="caseno" value="<?php echo $caseno ?>">
<input type="hidden" name="refno" value="<?php echo $refno ?>">
<input type="hidden" name="ap" value="<?php echo $ap ?>">
<input type="hidden" name="trantype" value="<?php echo $trantype ?>">
<input type="hidden" name="senior" value="<?php echo $senior ?>">
</td>
</tr>
<tr>
<td valign="bottom" align="right"><button type="submit" name="btn_sub" class="btn btn-primary" <?php echo $func ?>><i class="fa fa-send"></i> SUBMIT RESULT</button></td>
</tr>
</table>


</div>
</div>
</div>
</div>
</section>
</main>
</form>


<script type = "text/javascript">
function find(val,ns,ne, tab){
if(val<ns) {document.getElementById('fi'+tab).value = "LOW";}
else{
if(val>ne){document.getElementById('fi'+tab).value = "HIGH";}
else{document.getElementById('fi'+tab).value = "NORMAL";}
}
}
</script>
