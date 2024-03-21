<style>
.font1 {font-family: Lucida Console, Courier New, monospace; font-size: 13px; color: black;}
.font2 {font-family: Ariel, Helvetica, sans-serif;}
.font3 {font-family: Times New Roman, Times, serif; font-size: 15px; color: black;}
.font4 {font-family: Times New Roman, Times, serif; font-size: 12px; color: black;}
.colred {background: red;}
.textb{text-align: center; padding: 5px 5px; width:100%; height:25px; font-size:10pt; color: black; width: 100%; background: white; box-shadow: 0 0 5px #abf096; border: 1px solid #48972f;}
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
}

/* top-right border-radius */
.tablex tr:first-child th:last-child {
}

/* bottom-left border-radius */
.tablex tr:last-child td:first-child {
}

/* bottom-right border-radius */
.tablex tr:last-child td:last-child {
}
}
</style>

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

$height=addslashes($_POST['height']);
$weight=addslashes($_POST['weight']);
$bsa=addslashes($_POST['bsa']);
$hr=addslashes($_POST['hr']);

$reasonex=json_encode($_POST['reasonex']);
$highrisk=json_encode($_POST['highrisk']);
$otherpost=json_encode($_POST['otherpost']);
$restingecg=$_POST['restingecg'];
$ifabnormal=$_POST['ifabnormal'];
$responses=$_POST['responses'];
$functionalcapacity=$_POST['functionalcapacity'];
$duketreadmill=$_POST['duketreadmill'];
$scoretreadmill=$_POST['scoretreadmill'];
$interpretation=$_POST['interpretation'];
$interpretationscore=$_POST['interpretationscore'];
$comments=$_POST['comments'];
$testtype=$_POST['testtype'];
$vc=$_POST['vc'];
$percent=$_POST['percent'];
$jet=$_POST['jet'];
$volume=$_POST['volume'];
$gradient=$_POST['gradient'];
$g5=$_POST['g5'];

$sbp=$_POST['sbp'];
$dbp=$_POST['dbp'];
$targethr=$_POST['targethr'];
$mphr=$_POST['mphr'];

$filmno = $_POST['filmno'];
$cardiologist = $_POST['cardiologist'];

$user_film = $user."_".$filmno;

$result2z = $conn->query("SELECT * FROM productout where refno='$refno' and caseno='$caseno'");
while($row2z = $result2z->fetch_assoc()) {
$productcode=$row2z['productcode'];
$productsubtype=$row2z['productsubtype'];
}

$result2zy = $conn->query("SELECT * FROM nsauthdoctors where name='$radiologist'");
while($row2zy = $result2zy->fetch_assoc()) {$empid=$row2zy['empid'];}

$result2zyy = $conn->query("SELECT max(autono) as maxid FROM readersfee");
while($row2zyy = $result2zyy->fetch_assoc()) {$maxid=$row2zyy['maxid'];}
$maxid = $maxid + 1;


$result2zz = $conn->query("SELECT * FROM productsmasterlist where code='$productcode'");
while($row2zz = $result2zz->fetch_assoc()){$opdprice=$row2zz['opd'];}

$result2zz = $conn->query("SELECT * FROM receiving where code='$productcode'");
while($row2zz = $result2zz->fetch_assoc()){$desc=$row2zz['description'];}

$result2g = $conn->query("SELECT * FROM nsauthdoctors where empid='$radiologist' order by name");
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
$sql7 = $conn->query("delete from readersfee_report where refno='$refno' and caseno='$caseno'");

// INSERT AND UPDATE DATA //
$sql7 = $conn->query("update productout set terminalname='Testdone', approvalno='$user_film' where refno='$refno' and caseno='$caseno'");
$sqll = $conn->query("insert into xray1 (`patientidno`, `caseno`, `refno`, `radiologist`, `partexamined`, `examnurse` , `examperform`) values ('$patientidno', '$caseno', '$refno', '$name', '$desc', '$userdec', '$userrad')");


$conn->query("INSERT INTO `readersfee_report`(`caseno`, `doc_id`, `doc_name`, `code`, `desc`, `accttitle`, `refno`, `sc_pwd`, `srp`, `discount`, `net`, 
`datearray`, `timearray`, `user`) VALUES ('$caseno', '$empid', '$name', '$productcode', '$desc', '$productsubtype', '$refno', '$senior',
'', '', '', CURDATE(), CURTIME(), '$user')");


$sqll = $conn->query("insert into 2dechoresult_ver2 (`patientidno`, `caseno`, `refno`, `reader`, `partexamined`, `validate`,remarks, height, weight, BSA, HR) values ('$patientidno','$caseno','$refno','$name','$desc','$cardiologist','$technician', '$height', '$weight', '$bsa', '$hr')");


$count=44;
for($i=1; $i<=$count; $i++){
$table="lab".$i; $val = "r".$i; $value = $_POST[$val];
$sql77 = $conn->query("UPDATE 2dechoresult_ver2  set {$table}='$value' where refno = '$refno' and caseno='$caseno'");
}

$sql77 = $conn->query("UPDATE 2dechoresult_ver2  set lab45='$reasonex', lab46='$restingecg', lab47='$ifabnormal', lab48='$responses', lab49='$highrisk', lab50='$otherpost', lab51='$functionalcapacity', lab52='$duketreadmill', lab53='$scoretreadmill', lab54='$interpretation', lab55='$interpretationscore', lab56='$comments', lab57='$sbp', lab58='$dbp', lab59='$targethr', lab60='$mphr', lab111='$testtype', interpretation='$result', date='$daylight', authno='$coder', designation='$designation', remarks='$technician', filmno='$filmno', referredby='$doctor' where refno = '$refno' and caseno='$caseno'");

$conn->query("INSERT INTO `readersfee_report`(`caseno`, `doc_id`, `doc_name`, `code`, `desc`, `accttitle`, `refno`, `sc_pwd`, `srp`, `discount`, `net`, 
`datearray`, `timearray`, `user`) VALUES ('$caseno', '$empid', '$name', '$productcode', '$desc', '$productsubtype', '$refno', '$senior',
'', '', '', CURDATE(), CURTIME(), '$user')");

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

$height=$row1x['height'];
$weight=$row1x['weight'];
$bsa=$row1x['BSA'];
$hr=$row1x['HR'];

for($i=1; $i <= 111;$i++){$table="lab".$i; $lab[$i]=$row1x["$table"];}
}

$reasonfortermination=str_replace('"', "", $lab[45]);
$reasonfortermination=str_replace('[', "", $reasonfortermination);
$reasonfortermination=str_replace(']', "", $reasonfortermination);
$reasonfortermination = explode(",", $reasonfortermination);
$countrft = count($reasonfortermination);

$s[1]=""; $s[2]=""; $s[3]=""; $s[4]=""; $s[5]=""; $s[6]=""; $s[7]=""; $s[8]="";
$s[9]=""; $s[10]=""; $s[11]=""; $s[12]=""; $s[13]=""; $s[14]=""; $s[15]=""; $s[16]="";
for($d=0; $d<=$countrft; $d++){
if($reasonfortermination[$d]=='1'){$s[1]="checked";}
elseif($reasonfortermination[$d]=='2'){$s[2]="checked";}
elseif($reasonfortermination[$d]=='3'){$s[3]="checked";}
elseif($reasonfortermination[$d]=='4'){$s[4]="checked";}
elseif($reasonfortermination[$d]=='5'){$s[5]="checked";}
elseif($reasonfortermination[$d]=='6'){$s[6]="checked";}
elseif($reasonfortermination[$d]=='7'){$s[7]="checked";}
elseif($reasonfortermination[$d]=='8'){$s[8]="checked";}
elseif($reasonfortermination[$d]=='9'){$s[9]="checked";}
elseif($reasonfortermination[$d]=='10'){$s[10]="checked";}
elseif($reasonfortermination[$d]=='11'){$s[11]="checked";}
elseif($reasonfortermination[$d]=='12'){$s[12]="checked";}
elseif($reasonfortermination[$d]=='13'){$s[13]="checked";}
elseif($reasonfortermination[$d]=='14'){$s[14]="checked";}
elseif($reasonfortermination[$d]=='15'){$s[15]="checked";}
elseif($reasonfortermination[$d]=='16'){$s[16]="checked";}
}


$highriskfeature=str_replace('"', "", $lab[49]);
$highriskfeature=str_replace('[', "", $highriskfeature);
$highriskfeature=str_replace(']', "", $highriskfeature);
$highriskfeature = explode(",", $highriskfeature);
$counthrf = count($highriskfeature);

$t[1]=""; $t[2]=""; $t[3]=""; $t[4]=""; $t[5]=""; $t[6]=""; $t[7]=""; $t[8]="";
for($d=0; $d<=$counthrf; $d++){
if($highriskfeature[$d]=='1'){$t[1]="checked";}
elseif($highriskfeature[$d]=='2'){$t[2]="checked";}
elseif($highriskfeature[$d]=='3'){$t[3]="checked";}
elseif($highriskfeature[$d]=='4'){$t[4]="checked";}
elseif($highriskfeature[$d]=='5'){$t[5]="checked";}
elseif($highriskfeature[$d]=='6'){$t[6]="checked";}
elseif($highriskfeature[$d]=='7'){$t[7]="checked";}
elseif($highriskfeature[$d]=='8'){$t[8]="checked";}
}


$otherpostexc=str_replace('"', "", $lab[50]);
$otherpostexc=str_replace('[', "", $otherpostexc);
$otherpostexc=str_replace(']', "", $otherpostexc);
$otherpostexc = explode(",", $otherpostexc);
$countope = count($otherpostexc);

$u[1]=""; $u[2]=""; $u[3]=""; $u[4]=""; $u[5]=""; $u[6]="";
for($d=0; $d<=$countope; $d++){
if($otherpostexc[$d]=='1'){$u[1]="checked";}
elseif($otherpostexc[$d]=='2'){$u[2]="checked";}
elseif($otherpostexc[$d]=='3'){$u[3]="checked";}
elseif($otherpostexc[$d]=='4'){$u[4]="checked";}
elseif($otherpostexc[$d]=='5'){$u[5]="checked";}
elseif($otherpostexc[$d]=='6'){$u[6]="checked";}
}
?>



<main id="main" class="main">

    <div class="pagetitle">
      <h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="?view=main">Main</a></li>
          <li class="breadcrumb-item">Stress Test</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="../main/img/boy.png" alt="Profile" class="rounded-circle" style="width: 120px;"><p></p>
              <h5><b><?php echo ucwords(strtolower($patientname)) ?></b></h5>
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


<?php
if(isset($_POST['testtype'])){
$testtype=$_POST['testtype'];
echo"
<form method='POST'>
<input type='hidden' name='testtype' value='$testtype'>
<table width='100%' align='center'>
<tr>
<td width='33%'>
<font color='black'>READER:
<select name='radiologist' style='text-align: center; padding: 5px 5px; width:100%; height:30px; font-size: 12px;' required>
<option></option>
";
$sql2g = "SELECT * FROM nsauthdoctors where station='HEARTREADER' or station='HEARTDOCTOR' ORDER BY FIELD(Access, 'Internal Medicine') DESC";
$result2g = $conn->query($sql2g);
while($row2g = $result2g->fetch_assoc()) {
$name=$row2g['name'];
$empid=$row2g['empid'];
if($radiologist == $name){echo "<option value='$empid' selected>$name</option>";}
echo "<option value='$empid'>$name</option>";
}
echo"
</select>
</td>
<td width='33%'>
<font color='black'>CARDIOLOGIST:
<select name='cardiologist' style='text-align: center; padding: 5px 5px; width:100%; height:30px; font-size: 12px;' required>
";

$sql2 = "SELECT * FROM nsauthdoctors where station='HEARTDOCTOR' order by name";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$namex=$row2['name'];

if($validate == $namex){echo "<option value='$namex' selected>$namex</option>";}
echo "<option value='$namex'>$namex</option>";
}
echo"
</select>
</td>
<td><font color='black'>FILM NO.:<input type='text' name='filmno' value='$filmno' style='text-align: center; padding: 5px 5px; width:100%; height:30px; font-size: 12px;' required></td>
</tr>
</table><hr>


<table width='100%' class='table' border='1'>
<tr>
<th style='font-size: 10px;'><b>Height:<br><input type='text' name='height' value='$height' style='height:30px; font-size:12pt; padding: 0px; text-align: center; width: 95%;'></th>
<th style='font-size: 10px;'><b>Weight:<br><input type='text' name='weight' value='$weight' style='height:30px; font-size:12pt; padding: 0px; text-align: center; width: 95%;'></th>
<th style='font-size: 10px;'><b>BSA:<br><input type='text' name='bsa' value='$bsa' style='height:30px; font-size:12pt; padding: 0px; text-align: center; width: 95%;'></th>
<th style='font-size: 10px;'><b>HR:<br><input type='text' name='hr' value='$hr' style='height:30px; font-size:12pt; padding: 0px; text-align: center; width: 95%;'></th>
</tr>

<tr>
<th style='font-size: 10px;'><b>SBP:<br><input type='text' name='sbp' value='$lab[57]' style='height:30px; font-size:12pt; padding: 0px; text-align: center; width: 95%;'></th>
<th style='font-size: 10px;'><b>DBP:<br><input type='text' name='dbp' value='$lab[58]' style='height:30px; font-size:12pt; padding: 0px; text-align: center; width: 95%;'></th>
<th style='font-size: 10px;'><b>Target HR:<br><input type='text' name='targethr' value='$lab[59]' style='height:30px; font-size:12pt; padding: 0px; text-align: center; width: 95%;'></th>
<th style='font-size: 10px;'><b>MPHR:<br><input type='text' name='mphr' value='$lab[60]' style='height:30px; font-size:12pt; padding: 0px; text-align: center; width: 95%;'></th>
</tr>

</table><hr>


<p align='center'><font color='black'><b>$testtype STRESS TEST</b></p>

<b  style='font-size: 11px;'>MONITORED LEADS: I-II-III-aVR-aVL-aVF-V1-V2-V3-V4-V5-V6. Three minutes of walking at each indicated stage of exercise.</b>

<table width='100%' class='tablex' border='1' style='border-collapse: collapse;'>
<tr>
<td style='font-size:11px; text-align: center; width: 20%;'></td>
<td style='font-size:11px; text-align: center;'></td>
<td style='font-size:11px; text-align: center;'>Speed<br>(mph)</td>
<td style='font-size:11px; text-align: center;'>Grade(%)</td>
<td style='font-size:11px; text-align: center;'> Oxygen Consumption<br>(ml O2/kg/min)</td>
<td style='font-size:11px; text-align: center;'>Workload<br>(Mets)</td>
<td style='font-size:11px; text-align: center;'>Functional<br>Class</td>
<td style='font-size:11px; text-align: center;'>BP</td>
<td style='font-size:11px; text-align: center;'>HR</td>
</tr>
<tr>
<td style='font-size:11px; text-align: center;'>CONTROL SUPINE</td>
<td style='font-size:11px; text-align: center;'></td>
<td style='font-size:11px; text-align: center;'><input type='text' name='r1' value='$lab[1]' class='textb'></td>
<td style='font-size:11px; text-align: center;'><input type='text' name='r2' value='$lab[2]' class='textb'></td>
<td style='font-size:11px; text-align: center;'><input type='text' name='r3' value='$lab[3]' class='textb'></td>
<td style='font-size:11px; text-align: center;'><input type='text' name='r4' value='$lab[4]' class='textb'></td>
<td style='font-size:11px; text-align: center;'><input type='text' name='r5' value='$lab[5]' class='textb'></td>
<td style='font-size:11px; text-align: center;'><input type='text' name='r6' value='$lab[6]' class='textb'></td>
<td style='font-size:11px; text-align: center;'><input type='text' name='r7' value='$lab[7]' class='textb'></td>
</tr>
<tr>
<td style='font-size:11px; text-align: center;'>CONTROL STANDING</td>
<td style='font-size:11px; text-align: center;'></td>
<td style='font-size:11px; text-align: center;'><input type='text' name='r8' value='$lab[8]' class='textb'></td>
<td style='font-size:11px; text-align: center;'><input type='text' name='r9' value='$lab[9]' class='textb'></td>
<td style='font-size:11px; text-align: center;'><input type='text' name='r10' value='$lab[10]' class='textb'></td>
<td style='font-size:11px; text-align: center;'><input type='text' name='r11' value='$lab[11]' class='textb'></td>
<td style='font-size:11px; text-align: center;'><input type='text' name='r12' value='$lab[12]' class='textb'></td>
<td style='font-size:11px; text-align: center;'><input type='text' name='r13' value='$lab[13]' class='textb'></td>
<td style='font-size:11px; text-align: center;'><input type='text' name='r14' value='$lab[14]' class='textb'></td>
</tr>

<tr>
<td style='font-size:11px; text-align: center;'>Stages:</td>
<td style='font-size:11px; text-align: center;'>1</td>
";
$z=2; $zz=0; $zzz=0; $num1 = 15; $num2=16;
$init = $conn->query("select * from stresstestinitial where test='$testtype'");
while($nv = $init->fetch_assoc()){
$nvalue = $nv['normalvalue'];
$zz++; $zzz++;

echo"
<td style='font-size:11px; text-align: center;'>$nvalue</td>
";

if($zz==5){
$v1="r".$num1;
$v2="r".$num2;
echo"
<td style='font-size:11px; text-align: center;'><input type='text' name='$v1' value='$lab[$num1]' class='textb'></td>
<td style='font-size:11px; text-align: center;'><input type='text' name='$v2' value='$lab[$num2]' class='textb'></td>
</tr>
";
$num1= $num1+2; $num2=$num2+2;
}



if($zz==5 and mysqli_num_rows($init)>$zzz){echo"
<tr>
<td style='font-size:11px; text-align: center;'></td>
<td style='font-size:11px; text-align: center;'>$z</td>";
$zz=0; $z++;}
}
echo"</tr><tr>
</table>

<br>
<b style='font-size: 11px;'>BLOOD PRESSURE AND HEART RATE RECOVERY</b>
<table width='100%' class='tablex' border='1' style='border-collapse: collapse;'>
<tr>
<td style='font-size:11px; text-align: center; width: 5%;'></td>
<td style='font-size:11px; text-align: center;'>Immediately After</td>
<td style='font-size:11px; text-align: center;'>1 min</td>
<td style='font-size:11px; text-align: center;'>3 mins</td>
<td style='font-size:11px; text-align: center;'>5 mins</td>
<td style='font-size:11px; text-align: center;'>8 mins</td>
<td style='font-size:11px; text-align: center;'>11 mins</td>
</tr>
<tr>
<td style='font-size:11px; text-align: center;'>BP:</td>
<td style='font-size:11px; text-align: center;'><input type='text' name='r33' value='$lab[33]' class='textb'></td>
<td style='font-size:11px; text-align: center;'><input type='text' name='r34' value='$lab[34]' class='textb'></td>
<td style='font-size:11px; text-align: center;'><input type='text' name='r35' value='$lab[35]' class='textb'></td>
<td style='font-size:11px; text-align: center;'><input type='text' name='r36' value='$lab[36]' class='textb'></td>
<td style='font-size:11px; text-align: center;'><input type='text' name='r37' value='$lab[37]' class='textb'></td>
<td style='font-size:11px; text-align: center;'><input type='text' name='r38' value='$lab[38]' class='textb'></td>
</tr>
<tr>
<td style='font-size:11px; text-align: center;'>HR:</td>
<td style='font-size:11px; text-align: center;'><input type='text' name='r39' value='$lab[39]' class='textb'></td>
<td style='font-size:11px; text-align: center;'><input type='text' name='r40' value='$lab[40]' class='textb'></td>
<td style='font-size:11px; text-align: center;'><input type='text' name='r41' value='$lab[41]' class='textb'></td>
<td style='font-size:11px; text-align: center;'><input type='text' name='r42' value='$lab[42]' class='textb'></td>
<td style='font-size:11px; text-align: center;'><input type='text' name='r43' value='$lab[43]' class='textb'></td>
<td style='font-size:11px; text-align: center;'><input type='text' name='r44' value='$lab[44]' class='textb'></td>
</tr>
</table>

<br>
<b style='font-size: 11px;'>REASONS FOR TERMINATION OF EXERSICE:</b>
<table width='100%' border='1' class='tablex'>
<tr>
";
$z2=2; $zz2=0; $zzz2=0;
$init2 = $conn->query("select * from stresstestinitial where groupx='2'");
while($nv2 = $init2->fetch_assoc()){
$nvalue2 = $nv2['test'];
$zz2++; $zzz2++;
echo"<td style='font-size:11px; width: 25%;' valign='TOP'><input type='checkbox' name='reasonex[]' value='$zzz2' $s[$zzz2]> $nvalue2</td>";
if($zz2==4 and mysqli_num_rows($init2)>$zzz2){echo"</tr>";$zz2=0; $z2++;}
}
echo"</tr><tr>
</table>


<br>
<table width='100%' border='1' class='tablex'>
<tr>
<td width='50%' style='font-size:11px;'>
<b>RESTING ECG:</b><br>
<select name='restingecg' style='height:30px; font-size:10pt; padding: 0px; text-align: center; width: 100%;'>
<option value='$lab[46]'>$lab[46]</option>
<option value='Normal'>Normal</option>
<option value='Abnormal'>Abnormal</option>
</select>
<br><br><textarea name='ifabnormal' placeholder='if Abnormal...' style='height: 100px; width: 100%;'>$lab[47]</textarea>

</td><td style='font-size:11px;' valign='TOP'>

<b>RESPONSES TO EXERCISE TEST:</b><br>
<textarea name='responses' placeholder='' style='height: 150px; width: 100%;'>$lab[48]</textarea>

</td>

</tr>
</table>




<br>
<b style='font-size: 11px;'>HIGH RISK FEATURES:</b>
<table width='100%' border='1' class='tablex'>
<tr>
";
$z2=2; $zz2=0; $zzz2=0;
$init2 = $conn->query("select * from stresstestinitial where groupx='3'");
while($nv2 = $init2->fetch_assoc()){
$nvalue2 = $nv2['test'];
$zz2++; $zzz2++;
echo"<td style='font-size:11px; width: 50%;' valign='TOP'><input type='checkbox' name='highrisk[]' value='$zzz2' $t[$zzz2]> $nvalue2</td>";
if($zz2==2 and mysqli_num_rows($init2)>$zzz2){echo"</tr>";$zz2=0; $z2++;}
}
echo"</tr><tr>
</table>

<br>
<b style='font-size: 11px;'>OTHER POST EXERCISE FINDINGS::</b>
<table width='100%' border='1' class='tablex'>
<tr>
";
$z2=2; $zz2=0; $zzz2=0;
$init2 = $conn->query("select * from stresstestinitial where groupx='4'");
while($nv2 = $init2->fetch_assoc()){
$nvalue2 = $nv2['test'];
$zz2++; $zzz2++;
echo"<td style='font-size:11px; width: 33%;' valign='TOP'><input type='checkbox' name='otherpost[]' value='$zzz2' $u[$zzz2]> $nvalue2</td>";
if($zz2==3 and mysqli_num_rows($init2)>$zzz2){echo"</tr>";$zz2=0; $z2++;}
}
echo"</tr><tr>
</table>

<br>
<table width='100%' border='1' class='tablex'>
<tr>
<td width='50%' style='font-size:11px;' valign='TOP'>
<b>FUNCTIONAL CAPACITY:</b><br>
<select name='functionalcapacity' style='height:30px; font-size:10pt; padding: 0px; text-align: center; width: 100%;'>
<option value='$lab[51]'>$lab[51]</option>
<option value='Poor'>Poor</option>
<option value='Fair'>Fair</option>
<option value='Average'>Average</option>
<option value='Good'>Good</option>
<option value='High'>High</option>
</select>

<hr>

<b>DUKE TREADMILL SCORE:</b><br>
<select name='duketreadmill' style='height:30px; font-size:10pt; padding: 0px; text-align: center; width: 100%;'>
<option value='$lab[52]'>$lab[52]</option>
<option value='Low Risk'>Low Risk</option>
<option value='Moderate Risk'>Moderate Risk</option>
<option value='High Risk'>High Risk</option>
</select>
<br><br><input type='text' name='scoretreadmill' value='$lab[53]' placeholder='Score' style='height: 30px; width: 100%;'>

</td><td style='font-size:11px;' valign='TOP'>

<b>INTERPRETATION:</b><br>
<select name='interpretation' style='height:30px; font-size:10pt; padding: 0px; text-align: center; width: 100%;' required>
<option value='$lab[54]'>$lab[54]</option>
<option value='Normal Stress Test'>Normal Stress Test</option>
<option value='Abnormal Stress Test'>Abnormal Stress Test</option>
<option value='Equivocal Stress Test'>Equivocal Stress Test</option>
<option value='Inadequate Stress Test'>Inadequate Stress Test</option>
<option value='Functional Capacity'>Functional Capacity</option>
</select>
<br><br>
<b>AT:</b>&nbsp;<input type='text' name='interpretationscore' value='$lab[55]' placeholder='' style='height: 30px; width: 50%;'>&nbsp;METS
<hr>
<b>Comments/ Remarks:</b>
<textarea name='comments' placeholder='Comments/ Remarks:' style='height: 50px; width: 100%;'>$lab[56]</textarea>



</td>

</tr>
</table>
<hr>
<button type='submit' class='btn btn-danger btn-sm' name='btn_sub'>Submit result</button>
</form>
";

}else{
echo"
<form method='POST'>
<table width='50%' align='center'><tr><td style='text-align: right;'>

<br><br>
<div class='card' style='box-shadow: 0px 0px 0px 1px lightgrey;'>
<div class='card-body'>
<div class='d-flex align-items-center justify-content-between mt-5'>
<div class='lesson_name'>
<div class='project-block light-primary-bg'>
<i class='icofont-flask'></i>
</div>
<span class='small project_name fw-bold'> Type of Test </span>
</div>
</div>

<select name='testtype' class='form-control'>
<option value='BRUCE'>BRUCE</option>
<option value='KATTUS'>KATTUS</option>
<option value='NEPTET'>NEPTET</option>
<option value='MODIFIED BRUCE'>MODIFIED BRUCE</option>
</select><br>
<button type='submit' class='btn btn-outline-danger btn-sm'><i class='icofont-arrow-right'></i> Proceed</button>

</div>
</div>

</td></tr></table>
</form>
";

}
?>








              
              
</div>
</div>
</div>
</section>
</main><!-- End #main -->
