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
$result=$_POST['result'];
$trantype = $_POST['trantype'];
$radiologist = $_POST['radiologist'];
$transcriptionist= $user;
$senior = $_POST['senior'];
$val=$_POST['val'];
$max=$_POST['max'];
$peak=$_POST['peak'];
$ori=$_POST['ori'];
$vti=$_POST['vti'];
$ratio=$_POST['ratio'];
$jet=$_POST['jet'];
$grad=$_POST['grad'];
$filmno = $_POST['filmno'];
$cardiologist = $_POST['cardiologist'];

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
$sql7 = "delete from xray1 where refno='$refno' and caseno='$caseno'";
if ($conn->query($sql7) === TRUE) {}

$sql7 = "delete from 2dechoresult where refno='$refno' and caseno='$caseno'";
if ($conn->query($sql7) === TRUE) {}

$sql7 = "delete from productout where batchno='$refno' and caseno='$caseno'";
if ($conn->query($sql7) === TRUE) {}

$sql7 = "delete from readersfee where refno1='$refno' and caseno='$caseno'";
if ($conn->query($sql7) === TRUE) {}


// INSERT AND UPDATE DATA //
$sql7 = "update productout set terminalname='Testdone' where refno='$refno' and caseno='$caseno'";
if ($conn->query($sql7) === TRUE) {}

$sqll = "insert into xray1 (`patientidno`, `caseno`, `refno`, `radiologist`, `partexamined`, `examnurse` , `examperform`) values ('$patientidno','$caseno','$refno','$name','$desc','$userdec','$userrad')";
if ($conn->query($sqll) === TRUE) {}

$sqll = "insert into 2dechoresult (`patientidno`, `caseno`, `refno`, `reader`, `partexamined`, `validate`,remarks) values ('$patientidno','$caseno','$refno','$name','$desc','$cardiologist','$technician')";
if ($conn->query($sqll) === TRUE) {}


$count=1;
foreach ($val as $value){
$table="lab".$count;
$sql77 = "UPDATE 2dechoresult  set {$table}='$value' where refno = '$refno' and caseno='$caseno'";
if ($conn->query($sql77) === TRUE) {}
$count++;  
}

$count=29;
foreach ($max as $value) {$table="lab".$count;
$sql77 = "UPDATE 2dechoresult  set {$table}='$value' where refno = '$refno' and caseno='$caseno'";
if ($conn->query($sql77) === TRUE) {} $count++; 
}

$count=34;
foreach ($peak as $value) {$table="lab".$count;
$sql77 = "UPDATE 2dechoresult  set {$table}='$value' where refno = '$refno' and caseno='$caseno'";
if ($conn->query($sql77) === TRUE) {} $count++;   
}

$count=39;
foreach ($ori as $value) {$table="lab".$count;
$sql77 = "UPDATE 2dechoresult  set {$table}='$value' where refno = '$refno' and caseno='$caseno'";
if ($conn->query($sql77) === TRUE) {} $count++; 
}

$count=44;
foreach ($vti as $value) {$table="lab".$count;
$sql77 = "UPDATE 2dechoresult  set {$table}='$value' where refno = '$refno' and caseno='$caseno'";
if ($conn->query($sql77) === TRUE) {} $count++;  
}

$count=49;
foreach ($ratio as $value) {$table="lab".$count;
$sql77 = "UPDATE 2dechoresult  set {$table}='$value' where refno = '$refno' and caseno='$caseno'";
if ($conn->query($sql77) === TRUE) {} $count++;   
}

$count=54;
foreach ($jet as $value) {$table="lab".$count;
$sql77 = "UPDATE 2dechoresult  set {$table}='$value' where refno = '$refno' and caseno='$caseno'";
if ($conn->query($sql77) === TRUE) {} $count++; 
}

$count=59;
foreach ($grad as $value) {$table="lab".$count;
$sql77 = "UPDATE 2dechoresult  set {$table}='$value' where refno = '$refno' and caseno='$caseno'";
if ($conn->query($sql77) === TRUE) {} $count++; 
}

$sql77 = "UPDATE 2dechoresult  set interpretation='$result', date='$daylight', authno='$coder', designation='$designation', remarks='$technician', filmno='$filmno', referredby='$doctor' where refno = '$refno' and caseno='$caseno'";
if ($conn->query($sql77) === TRUE) {}


//==============
if ($trantype == "cash") {
$status1 = "PAID";
$sql778 = "insert into productout values('$coder','$todaytimex','$caseno','$empid','$radiologist','$amtSum1','1','0','$amtSum1','NONE','0','0','$amtSum1','$localdate','$status1','$productcode','','$refno','READERS FEE','PROFESSIONAL FEE','','$refno','','$branch','','$todayx','')";
if ($conn->query($sql778) === TRUE) {}	 
}

if ($trantype == "charge") {
$status1 = "Approved";
$sql779 = "insert into productout values('$coder','$todaytimex','$caseno','$empid','$radiologist','$amtSum1','1','0','$amtSum1','NONE','0','$amtSum1','0','$localdate','$status1','$productcode','','$refno','READERS FEE','PROFESSIONAL FEE','','$refno','','$branch','','$todayx','')";
if ($conn->query($sql779) === TRUE) {}	
}
//==============


$sql777 = "insert into readersfee values('$maxid','$caseno','$coder','$productcode','$radiologist','$empid','$todayx','$refno','$amtSum1','$opdprice','$senior','PROFESSIONAL FEE')";
if ($conn->query($sql777) === TRUE) {}

echo"<script>alert('Successfully Saved...'); window.location='?view=detail&caseno=$caseno$datax';</script>";
}
?>



<?php
$caseno = $_GET['caseno'];
$description = $_GET['description'];
$prodsubtype = $_GET['prodsubtype'];
$prodsubtype = $prodsubtype." RESULT";
$refno = $_GET['refno'];
$trantype = $_POST['trantype'];
$func = "";
$label = "SUBMIT";

	
$sql1x = "select * from 2dechoresult where caseno='$caseno' and refno='$refno'";
$result1x = $conn->query($sql1x);
while($row1x = $result1x->fetch_assoc()){ 
$validate=$row1x['validate'];
} 

   

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


$sqlx5f = "SELECT * FROM 2dechoresult where caseno ='$caseno' and refno='$refno'";
$resultx5f = $conn->query($sqlx5f);
while($rowx5f = $resultx5f->fetch_assoc()) {
$interpret=$rowx5f['interpretation'];
$filmno=$rowx5f['filmno'];

$radiologist=$rowx5f['reader'];
$prodsubtype=$rowx5f['clinicalservices'];
$interpretation=$rowx5f['interpretation'];
$description=$rowx5f['partexamined'];
$validate=$rowx5f['validate'];

for($i=1; $i <= 63;$i++){
$table="lab".$i;
$lab[$i]=$rowx5f["$table"];
}
}
?>	


<form method="POST" name="arv">
<div class="col-lg-12" style="width: 100%;">
<div class="card mb-4">
<div class="table-responsive p-3">



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

<table width="80%" border="1" align="center">
<tr>
<td bgcolor="lightyellow" class="text-center" width="15%"><font class="font8"><b>DEMENSION</td>
<td bgcolor="lightyellow" class="text-center"><font class="font8"><b>RESULT</td>
<td bgcolor="lightyellow" class="text-center"><font class="font8"><b>FINDINGS</td>
<td bgcolor="lightyellow" class="text-center"><font class="font8"><b>NORMAL VALUES</td>
<td bgcolor="lightyellow" class="text-center"><font class="font8"><b>CU NORMAL VALUES</td>

</tr>
<?php
$tab=1;
$sql2 = "SELECT * FROM 2decho where 2decho.group!='4'";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) { 
$demension=$row2['demension'];
$id=$row2['id'];
$ns=$row2['normalstart'];
$ne=$row2['normalend'];
?>
<tr>
<td class="text-center"><font color="black"><font class="font8"><?php echo $demension ?></td>
<td class="text-center"><font color="black"><input type="text" name="val[]" oninput="find(this.value,<?php echo $ns ?>,<?php echo $ne ?>,<?php echo $tab ?>) " tabindex="<?php echo $tab; ?>" style="height:30px; font-size:12pt; padding: 0px; text-align: center; background: lightyellow; width: 95%;" value="<?php echo $lab[$tab] ?>"></td>
<td class="text-center"><font color="black"><input type="text" name="fi[]" id="fi<?php echo $tab ?>" style="height:30px; font-size:12pt; padding: 0px; text-align: center; width: 95%;" value"<?php 
if( $ns == ""){echo  "-";}
elseif($lab[$tab] == "") {echo "-";}
elseif($lab[$tab] < $ns) {echo "LOW";}
elseif($lab[$tab] > $ne){echo "HIGH";}
else{echo  "NORMAL";}
?>" readonly>
</td>
<td class="text-center"><font color="black"><input type="text" name="val1" value="<?php echo $ns.'-'.$ne ?>" style="height:30px; font-size:12pt; padding: 0px; text-align: center; width: 95%;" readonly></td>
<td class="text-center"><font color="black"><input type="text" name="val2" value="" style="height:30px; font-size:12pt; padding: 0px; width: 95%;" readonly></td>
</tr>
<?php
$tab++;
}
?>

</table>
<br>
</td>
</tr>
<tr>
<td>

<table width="90%" border="1" align="center">
<tr>
<td bgcolor="lightyellow" width="8%" class="text-center"><font class="font8"><b>VALVE</td>
<td bgcolor="lightyellow" class="text-center"><font class="font8"><b>MAX VELOCITY(M/SEC)</td>
<td bgcolor="lightyellow" class="text-center"><font class="font8"><b>PEAK GRADIENT(MMHG)</td>
<td bgcolor="lightyellow" class="text-center"><font class="font8"><b>ORIFIRE AREA(CM2)</td>
<td bgcolor="lightyellow" class="text-center"><font class="font8"><b>VTI</td>
<td bgcolor="lightyellow" class="text-center"><font class="font8"><b>RATIO</td>
<td bgcolor="lightyellow" class="text-center"><font class="font8"><b>JET AREA</td>
<td bgcolor="lightyellow" class="text-center"><font class="font8"><b>GRADIENT</td>
</tr>
<?php
$sql2 = "SELECT * FROM 2decho where 2decho.group='4'";
$result2 = $conn->query($sql2);
$tab=30;
$max=29;
$peak=34;
$ori=39;
$vti=44;
$ratio=49;
$jet=54;
$grad=59;
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
<td class="text-center"><font color="black"><input type="text" name="max[]" value="<?php echo $val2.$lab[$max]; ?>" tabindex="<?php echo $tab++; ?>" style="height:30px; font-size:12pt; padding: 0px; width: 95%;"></td>
<td class="text-center"><font color="black"><input type="text" name="peak[]" value="<?php echo $lab[$peak]; ?>" tabindex="<?php echo $tab++; ?>" style="height:30px; font-size:12pt; padding: 0px; width: 95%;"></td>
<td class="text-center"><font color="black"><input type="text" name="ori[]" value="<?php echo $lab[$ori]; ?>" tabindex="<?php echo $tab++; ?>" style="height:30px; font-size:12pt; padding: 0px; width: 95%;"></td>
<td class="text-center"><font color="black"><input type="text" name="vti[]" value="<?php echo $lab[$vti]; ?>" tabindex="<?php echo $tab++; ?>" style="height:30px; font-size:12pt; padding: 0px; width: 95%;"></td>
<td class="text-center"><font color="black"><input type="text" name="ratio[]" value="<?php echo $lab[$ratio]; ?>" tabindex="<?php echo $tab++; ?>" style="height:30px; font-size:12pt; padding: 0px; width: 95%;"></td>
<td class="text-center"><font color="black"><input type="text" name="jet[]" value="<?php echo $lab[$jet]; ?>" tabindex="<?php echo $tab++; ?>" style="height:30px; font-size:12pt; padding: 0px; width: 95%;"></td>
<td class="text-center"<font color="black"><input type="text" name="grad[]" value="<?php echo $lab[$grad]; ?>" tabindex="<?php echo $tab++; ?>" style="height:30px; font-size:12pt; padding: 0px; width: 95%;"></td>
</tr>
<?php
$max++;
$peak++;
$ori++;
$vti++;
$ratio++;
$jet++;
$grad++;
}
?>
</table>

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
while($row2 = $result2->fetch_assoc()) { 
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

