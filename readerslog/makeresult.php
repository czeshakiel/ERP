<?php
if(isset($_GET['caseno'])){
$caseno = $_GET['caseno'];
$refno = $_GET['refno'];
$prodsubtype = $_GET['productsubtype']." RESULT";
$prodsubtype2 = $_GET['productsubtype'];

$sql1x = "select * from xray1 where caseno='$caseno' and refno='$refno'";
$result1x = $conn->query($sql1x);
while($row1x = $result1x->fetch_assoc()) { 
$radiologist=$row1x['radiologist'];
$prodsubtype=$row1x['clinicalservices'];
$interpretation=$row1x['interpretation'];
$impression=$row1x['impression'];
$validateuser=$row1x['examperform'];
}

$sql1x = "select * from productout where caseno='$caseno' and refno='$refno'";
$result1x = $conn->query($sql1x);
while($row1x = $result1x->fetch_assoc()){
$description=$row1x['productdesc'];
$prodsubtype = $row1x['productsubtype']." Result";
$appro=$row1x['approvalno'];
list($user, $filmno) = explode('_', $appro);
if($filmno == "") {list($user, $filmno) = explode('-', $appro); }
} 

$btn = "btn_up";
}
else{
$caseno = $_POST['caseno'];
$description = $_POST['description'];
$prodsubtype = $_POST['prodsubtype']." RESULT";
$prodsubtype2 = $_POST['prodsubtype'];
$filmno = $_POST['filmno'];
$radiologist = $_POST['radiologist'];
$refno = $_POST['refno'];
$trantype = $_POST['trantype'];
$btn = "btn_sub";
}

$sqlz = "select a.status, a.patientidno, a.caseno, a.membership, a.hmo, a.room, a.street, a.barangay, a.municipality, a.province, a.initialdiagnosis,
 a.ap, a.dateadmitted, a.branch, a.employerno, a.ad, a.status, p.lastname, p.firstname, p.middlename, p.patientidno, p.sex, p.age, p.senior, p.birthdate
  from admission a, patientprofile p where a.patientidno=p.patientidno and a.caseno ='$caseno'";
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
  $dd = $conn->query("SELECT `name` FROM docfile WHERE code='$ap'");
  if(mysqli_num_rows($dd)>0){
  while($dd1 = $dd->fetch_assoc()){$ap = $dd1['name'];}
  }else{$ap="";}
  }
  
if(is_numeric($ad)){
  $dd = $conn->query("SELECT `name` FROM docfile WHERE code='$ad'");
  if(mysqli_num_rows($dd)>0){
  while($dd1 = $dd->fetch_assoc()){$ad = $dd1['name'];}
  }else{$ad="";}
  }



if(isset($_POST['btn_up'])){
  $interpretation = $_POST['interpretation'];
  $impression = $_POST['impression'];
  $caseno = $_POST['caseno'];
  $refno = $_POST['refno'];
  $filmno = $_POST['filmno'];
  $radtech = $_POST['radtech'];
  $app = $radtech."_".$filmno;
  
  $conn->query("update productout set approvalno = '$app', terminalname='Testdone' where caseno='$caseno' and refno='$refno'");
  
  $interpretation = addslashes($interpretation);
  $conn->query("update xray1 set interpretation='$interpretation', impression='$impression', filmno='$filmno', validate = '$radtech'
   where refno = '$refno' and caseno='$caseno'");
   

  echo"<script>window.location='?xrayresults&caseno=$caseno';</script>";
  } 

if(isset($_POST['btn_sub'])){
$interpretation = addslashes($_POST['interpretation']);
$impression = addslashes($_POST['impression']);
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
$designation="RADIOLOGIST";
$technician="RADIOLOGIC TECHNOLOGIST";
$transcriptionist= $_POST['radtech'];
$trantype = $_POST['trantype'];
$radiologist = $_POST['radiologist'];
$senior = $_POST['senior'];

$sql2z = $conn->query("SELECT * FROM productout where refno='$refno' and caseno='$caseno'");
while($row2z = $sql2z->fetch_assoc()) {
$productcode=$row2z['productcode'];
$productdesc=$row2z['productdesc'];
$productsubtype=$row2z['productsubtype'];
}

$sql2zy = $conn->query("SELECT * FROM nsauthdoctors where name='$radiologist'");
while($row2zy = $sql2zy->fetch_assoc()){$empid=$row2zy['empid'];}

$sql2zyy = $conn->query("SELECT max(autono) as maxid FROM readersfee");
while($row2zyy = $sql2zyy->fetch_assoc()) { $maxid=$row2zyy['maxid'];}
$maxid = $maxid + 1;

$sql2zz = $conn->query("SELECT * FROM productsmasterlist where code='$productcode'");
while($row2zz = $sql2zz->fetch_assoc()) { $opdprice=$row2zz['opd'];}

if($senior=="y" or $senior=="Y" or $senior=="YES"){
$opdprice1 = $opdprice * .20;
$opdprice = $opdprice - $opdprice1;	
}else{
$opdprice1 = 0;
$opdprice = $opdprice - $opdprice1;		
}
$amtSum1 = $opdprice * .25;

// INSERT AND UPDATE DATA //

$conn->query("update productout set terminalname='Testdone' where refno='$refno' and caseno='$caseno'");
$conn->query("update xray1 set interpretation='$interpretation', impression='$impression', authno='$coder',designation='$designation', remarks='$technician',
date='$daylight',validate='$transcriptionist',filmno='$filmno',referredby='$doctor'  where refno = '$refno' and caseno='$caseno'");

//==============
if ($trantype == "cash"){
$status1 = "PAID";
$conn->query("INSERT INTO `productout`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`,
 `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`,
 `administration`, `shift`, `location`, `senior`, `datearray`) values ('$coder','$todaytimex','$caseno','$empid','$radiologist','$amtSum1','1','0','$amtSum1',
 'NONE','0','0','$amtSum1','$localdate','$status1','$productcode','','$refno','READERS FEE','PROFESSIONAL FEE','','$refno','','$branch','','$todayx','')");
}

if ($trantype == "charge"){
$status1 = "Approved";
$conn->query("INSERT INTO `productout`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`,
 `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`,
 `administration`, `shift`, `location`, `senior`, `datearray`) values ('$coder','$todaytimex','$caseno','$empid','$radiologist','$amtSum1','1','0','$amtSum1',
 'NONE','0','$amtSum1','0','$localdate','$status1','$productcode','', '$refno','READERS FEE','PROFESSIONAL FEE','','$refno','','$branch','','$todayx')");
}
//==============

$sql777 = $conn->query("insert into readersfee values('$maxid','$caseno','$coder','$productcode','$radiologist','$empid','$todayx','$refno','$amtSum1','$opdprice','$senior','PROFESSIONAL FEE')");

$conn->query("INSERT INTO `readersfee_report`(`caseno`, `doc_id`, `doc_name`, `code`, `desc`, `accttitle`, `refno`, `sc_pwd`, `srp`, `discount`, `net`, 
`datearray`, `timearray`, `user`) VALUES ('$caseno', '$empid', '$radiologist', '$productcode', '$productdesc', '$productsubtype', '$refno', '$senior',
'', '', '', CURDATE(), CURTIME(), '$user')");

echo"<script>window.location='?xrayresults&caseno=$caseno';</script>";
}
?>



<form method="POST" name="arv">
<main id="main" class="main">

    <div class="pagetitle">
    <h5><?php echo strtoupper($_SESSION['deptdoc'])." DEPARTMENT" ?><small style="font-size: 13px;"> || Reader: <b><?php echo strtoupper($_SESSION['userdoc']); ?></b></small></h5>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="?view=main">Main</a></li>
          <li class="breadcrumb-item"><a href="?view=details&caseno=<?php echo $caseno ?>&batchno=<?php echo $batchno ?>">Patient Information</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="../main/img/<?php echo $ge ?>.png" alt="Profile" class="rounded-circle" style="width: 120px;"><p></p>
              <h5><b><?php echo strtoupper($patientname); ?></b></h5>
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


<?php
if(isset($_POST['btnsave'])){
$res = $_POST['result'];
echo"<script>alert('$res');</script>";
}

?>

<table width="100%"><tr>
<td width="50%"><h6><font size='2px'>PART EXAMINED: <b><span class="badge bg-primary"><i class="bi bi-star me-1"></i> <?php echo $description ?></span></b></h6></td>
<td><h6><font size='2px'>CLINICAL SERVICES: <b><span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> <?php echo $prodsubtype ?></span></b></h6></td>
</tr></table>
<hr>
<table width="100%" align="center">
<tr>
<td><font class="font8">
FILM NO.:<br><input type="text" name="filmno" value="<?php echo $filmno ?>" style="height:30px; font-size:10pt; padding: 0px; text-align: center; width: 100%;" required>
<input type="text" name="reader" value="<?php echo $radiologist ?>" style="height:30px; font-size:10pt; padding: 0px; text-align: center; width: 100%;" hidden>
</td>
<td><font class="font8">RAD TECH:<br>
<select name="radtech" style="height:30px; font-size:10pt; padding: 0px; text-align: center; width: 100%;" required>
<option value="N/A">N/A</option>
<?php
$sql2 = "SELECT * FROM nsauth where station='XRAY' and access='1' order by name";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) { 
$namex=$row2['name'];
if($validateuser==$namex){echo "<option value='$namex' selected>$namex</option>";}
else{echo "<option value='$namex'>$namex</option>";}

}
?>
</select>
</td>
<td valign="bottom"><button class="btn btn-warning btn-sm" name="<?php echo $btn ?>" onclick="aac()"><i class="bi bi-twitter"></i> Submit Result</button></td>
</tr>
</table>
<hr>


Normal Values:
<select id="radtechxxx" onchange="vval(this.value);" style="height:30px; font-size:12pt; padding: 0px; width: 50%;">
<option value="">N/A</option>
<?php
$sql2 = "SELECT * FROM xraytemp where accttitle='$prodsubtype2' order by description";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) { 
$description=$row2['description'];
$template=$row2['template'];
echo "<option value='$template'>$description</option>";
}
?>
</select><hr>

<div class="form-floating mb-3">
<textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea1" style="height: 200px;" name="interpretation"><?php echo $interpretation ?></textarea>
<label for="floatingTextarea1">Interpretation:</label>
</div>

<div class="form-floating mb-3">
<textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 200px;" name="impression"><?php echo $impression ?></textarea>
<label for="floatingTextarea2">Impression:</label>
</div>

<input type="hidden" name="caseno" value="<?php echo $caseno ?>">
<input type="hidden" name="refno" value="<?php echo $refno ?>">
<input type="hidden" name="ap" value="<?php echo $ap ?>">
<input type="hidden" name="trantype" value="<?php echo $trantype ?>">
<input type="hidden" name="radiologist" value="<?php echo $radiologist ?>">
<input type="hidden" name="senior" value="<?php echo $senior ?>">
<script>
function vval(val){document.getElementById('floatingTextarea1').value=val;}
</script>




</div>
</div>
</div>
</section>
</main><!-- End #main -->
</form>