<?php
$caseno = $_GET['caseno'];
$description = $_GET['description'];
$prodsubtype = $_GET['prodsubtype'];
$prodsubtype = $prodsubtype." RESULT";
$refno = $_GET['refno'];
$trantype = $_GET['trantype'];
$func = "";
$label = "SUBMIT";



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
echo"<script>alert('Successfully Saved...'); window.location='?details&caseno=$caseno$datax';</script>";
}


$sqlz = "select a.status, a.patientidno, a.caseno, a.membership, a.hmo, a.room, a.street, a.barangay, a.municipality, a.province, a.initialdiagnosis, a.ap, a.dateadmitted, a.branch, a.employerno, a.ad, a.status, p.lastname, p.firstname, p.middlename, p.patientidno, p.sex, p.age, p.senior, p.birthdate from admission a, patientprofile p where a.patientidno=p.patientidno and a.caseno ='$caseno'";
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
if($sex=="M"){$ge = "boy"; $sexcol ="blue";}else{$ge = "girl"; $sexcol ="#F309B6";}
if ($senior == "Y" or $senior=="y") {$senior = "YES";}else{$senior = "NO";}
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
?>


<form method="POST" name="arv">
<main id="main" class="main">

    <div class="pagetitle">
      <h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="?view=main">Main</a></li>
          <li class="breadcrumb-item">2D Echo Ver.2</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="../mainpage/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"><p></p>
              <h5><b><?php echo strtoupper($patientname); ?></b></h5>
              <p align="center" style="font-size: 12px;"><?php echo $address ?></p>
              
              
              <table width="100%">
               <tr><td><hr style="border: 2px solid red; border-radius: 5px;"></td></tr>
              </table>
              
              
                            <div class="d-flex align-items-start" style="width: 100%;">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><font size="2%">H-Info</font></button>
                  <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><font size="2%">P-Info</font></button>
                  <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"><font size="2%">OTHER</font></button>
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





<table width="100%" align="center">
<tr>
<td width="33%">
<font color="black">READER:
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
<td width="33%">
<font color="black">CARDIOLOGIST:
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
<td><font color="black">FILM NO.:<input type="text" name="filmno" value="<?php echo $filmno ?>" class="form-control" required></td>
</tr>
</table><hr>


<p align="center"><font color="black"><b>2D AND M-MODE MEASUREMENT</b></p>
<table width="100%" align="center">
<tr><td>
<!----------------------------------------------------- GROUP 1 --------------------------------------------->
<table width="100%" class="table" border="1">
<tr>
<th bgcolor="lightyellow" class="text-center" width="35%" style='font-size: 10px;'><b>PARAMETERS</th>
<th bgcolor="lightyellow" class="text-center" width="25%" style='font-size: 10px;'><b>RESULT</th>
<th bgcolor="lightyellow" class="text-center" width="40%" style='font-size: 10px;'><b>NORMAL VALUES</th>
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
<td class="text-center" style="font-size: 11px;"><?php echo $demension ?></td>
<td class="text-center" style="font-size: 12px;"><input type="text" name="val[]" oninput="find(this.value,<?php echo $ns ?>,<?php echo $ne ?>,<?php echo $tab ?>) " tabindex="<?php echo $tab; ?>" style="height:25px; padding: 0px; text-align: center; width: 95%;" value="<?php echo $lab[$tab] ?>"></td>
<td class="text-center" style="font-size: 10px; color: #31638d;"><?php echo $nv ?></td>
</tr>
<?php
$tab++;
}
?>
</table>
<!------------------------------------------------- END GROUP 1 --------------------------------------------->

</td><td width="1%"></td><td valign="TOP">

<!----------------------------------------------------- GROUP 2 --------------------------------------------->
<table width="100%" class="table" border="1">
<tr>
<th bgcolor="lightyellow" class="text-center" width="35%" style='font-size: 10px;'><b>PARAMETERS</th>
<th bgcolor="lightyellow" class="text-center" width="25%" style='font-size: 10px;'><b>RESULT</th>
<th bgcolor="lightyellow" class="text-center" width="40%" style='font-size: 10px;'><b>NORMAL VALUES</th>
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
<td class="text-center" style="font-size: 11px;"><?php echo $demension ?></td>
<td class="text-center" style="font-size: 12px;"><input type="text" name="val[]" oninput="find(this.value,<?php echo $ns ?>,<?php echo $ne ?>,<?php echo $tab ?>) " tabindex="<?php echo $tab; ?>" style="height:25px; padding: 0px; text-align: center; width: 95%;" value="<?php echo $lab[$tab] ?>"></td>
<td class="text-center" style="font-size: 10px; color: #31638d;""><?php echo $nv ?></td>
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
<table width="100%" align="center"><tr><td width="65%">



<!----------------------------------------------------- GROUP 3 --------------------------------------------->
<table width="100%" class="table" border="1">
<tr>
<th bgcolor="lightyellow" width="22%" class="text-center" style="font-size: 11px;"><b>VALVE</th>
<th bgcolor="lightyellow" width="20%" class="text-center" style="font-size: 11px;"><b>Velocity (m/sec) (E/A)</th>
<th bgcolor="lightyellow" width="20%" class="text-center" style="font-size: 11px;"><b>PEAK GRADIENT</th>
<th bgcolor="lightyellow" width="20%" class="text-center" style="font-size: 11px;"><b>Valve Area</th>
<th bgcolor="lightyellow" width="18%" class="text-center" style="font-size: 11px;"><b>VTI (cm)</th>
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
<td class="text-center" style="font-size: 11px;"><?php echo $demension ?></td>
<td class="text-center" style="font-size: 11px;"><input type="text" name="velosity[]" value="<?php echo $val2.$lab[$velocity]; ?>" tabindex="<?php echo $tab; ?>" style="text-align: center; height:25px; padding: 0px; width: 95%;"></td>
<td class="text-center" style="font-size: 11px;"><input type="text" name="peak[]" value="<?php echo $lab[$peak]; ?>" tabindex="<?php echo $tab; ?>" style="text-align: center; height:25px; padding: 0px; width: 95%;"></td>
<td class="text-center" style="font-size: 11px;"><input type="text" name="valve[]" value="<?php echo $lab[$valve]; ?>" tabindex="<?php echo $tab; ?>" style="text-align: center; height:25px; padding: 0px; width: 95%;"></td>
<td class="text-center" style="font-size: 11px;"><input type="text" name="vti[]" value="<?php echo $lab[$vti]; ?>" tabindex="<?php echo $tab; ?>" style="text-align: center; height:25px; padding: 0px; width: 95%;"></td>
</tr>
<?php
$tab++; $velocity++; $peak++; $valve++; $vti++;
}
?>
</table>
<!------------------------------------------------- END GROUP 3 --------------------------------------------->
<br>
<!----------------------------------------------------- GROUP 4 --------------------------------------------->
<table width="100%" class="table" border="1">
<tr>
<th bgcolor="lightyellow" width="25%" class="text-center" style="font-size: 11px;"><b></th>
<th bgcolor="lightyellow" width="15%" class="text-center" style="font-size: 11px;"><b>VC</th>
<th bgcolor="lightyellow" width="15%" class="text-center" style="font-size: 11px;"><b>%</th>
<th bgcolor="lightyellow" width="15%" class="text-center" style="font-size: 11px;"><b>Jet Area</th>
<th bgcolor="lightyellow" width="15%" class="text-center" style="font-size: 11px;"><b>Volume</th>
<th bgcolor="lightyellow" width="15%" class="text-center" style="font-size: 11px;"><b>Gradient</th>
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
<td class="text-center" style="font-size: 11px;"><?php echo $demension ?></td>
<td class="text-center" style="font-size: 11px;"><input type="text" name="vc[]" value="<?php echo $val2.$lab[$vc]; ?>" tabindex="<?php echo $tab; ?>" style="text-align: center; height:25px; padding: 0px; width: 95%;"></td>
<td class="text-center" style="font-size: 11px;"><input type="text" name="percent[]" value="<?php echo $lab[$perc]; ?>" tabindex="<?php echo $tab; ?>" style="text-align: center; height:25px; padding: 0px; width: 95%;"></td>
<td class="text-center" style="font-size: 11px;"><input type="text" name="jet[]" value="<?php echo $lab[$jet]; ?>" tabindex="<?php echo $tab; ?>" style="text-align: center; height:25px; padding: 0px; width: 95%;"></td>
<td class="text-center" style="font-size: 11px;"><input type="text" name="volume[]" value="<?php echo $lab[$volume]; ?>" tabindex="<?php echo $tab; ?>" style="text-align: center; height:25px; padding: 0px; width: 95%;"></td>
<td class="text-center" style="font-size: 11px;"><input type="text" name="gradient[]" value="<?php echo $lab[$grad]; ?>" tabindex="<?php echo $tab; ?>" style="text-align: center; height:25px; padding: 0px; width: 95%;"></td>
</tr>
<?php
$tab++; $vc++; $perc++; $jet++; $volume++; $grad++;
}
?>

</table>
<!------------------------------------------------- END GROUP 4 --------------------------------------------->




</td><td width="1%"></td><td valign="TOP">

<!----------------------------------------------------- GROUP 5 --------------------------------------------->
<table width="100%" class="table" border="1">
<th bgcolor="lightyellow" width="50%" class="text-center" style="font-size: 11px;"><b></th>
<th bgcolor="lightyellow" class="text-center" style="font-size: 11px;"><b></th>
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
<td class="text-center" style="font-size: 11px;"><?php echo $demension ?></td>
<td class="text-center"><font color="black"><input type="text" name="g5[]" value="<?php echo $val2.$lab[$g5]; ?>" tabindex="<?php echo $tab++; ?>" style="text-align: center; height:25px; padding: 0px; width: 95%;"></td>
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
<font color="black"><textarea id="result" name="result" rows="8" style="width: 100%;" <?php echo $func ?>><?php echo $interpret ?></textarea></font>
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
</section>
</main><!-- End #main -->
</form>
