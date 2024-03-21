<?php
$caseno = $_GET['caseno'];
$refno = $_GET['refno'];
$prodsubtype = $_GET['productsubtype']." RESULT";
$prodsubtype2 = $_GET['productsubtype'];

if(isset($_POST['btn_sub'])){
$interpretation = $_POST['result'];
$caseno = $_POST['caseno'];
$refno = $_POST['refno'];
$filmno = $_POST['filmno'];
$radtech = $_POST['radtech'];
$app = $radtech."_".$filmno;

$conn->query("update productout set approvalno = '$app' where caseno='$caseno' and refno='$refno'");

$interpretation = addslashes($interpretation);
$sql77 = "update xray1 set interpretation='$interpretation', filmno='$filmno', validate = '$radtech' where refno = '$refno' and caseno='$caseno'";
if ($conn->query($sql77) === TRUE) {}

echo"<script>window.location='?xrayresults&caseno=$caseno';</script>";
} 


$sql1x = "select * from xray1 where caseno='$caseno' and refno='$refno'";
$result1x = $conn->query($sql1x);
while($row1x = $result1x->fetch_assoc()) { 
$radiologist=$row1x['radiologist'];
$prodsubtype=$row1x['clinicalservices'];
$interpretation=$row1x['interpretation'];
$validateuser=$row1x['validate'];
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

?>



<form method="POST">
<main id="main" class="main">

    <div class="pagetitle">
    <h5><?php echo strtoupper($_SESSION['deptdoc'])." DEPARTMENT" ?><small style="font-size: 13px;"> || Reader: <b><?php echo strtoupper($radiologist); ?></b></small></h5>
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
<td width="30%"><font class="font8">FILM NO.:<br><input type="text" name="filmno" value="<?php echo $filmno ?>" style="height:30px; font-size:10pt; padding: 0px; text-align: center; width: 100%;" required></td>
<td><font class="font8">RAD TECH:<br>
<select name="radtech" style="height:30px; font-size:10pt; padding: 0px; text-align: center; width: 100%;" required>
<option value="<?php echo $validateuser ?>"><?php echo $validateuser ?></option>
<?php
$sql2 = "SELECT * FROM nsauth where station='XRAY' order by name";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) { 
$namex=$row2['name'];
echo "<option value='$namex'>$namex</option>";
}
?>
</select>
<input type="hidden" name="reader" value="<?php echo $radiologist ?>">
</td>

<td valign="bottom" style="text-align: right;"><button class="btn btn-warning btn-sm" name="btn_sub" onclick="aac()"><i class="bi bi-twitter"></i> Submit Result</button></td>
</tr>
</table>
<hr>


Normal Values:
<select id="radtechxxx" onchange="vval(this.value);" style="height:30px; font-size:12pt; padding: 0px; width: 50%;">
<option value="<?php echo $interpretation ?>">N/A</option>
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





<link rel="stylesheet" type="text/css" href="<?php echo $ipadd ?>assets/vendor/editor/dist/themes/flat/style.css" />
<textarea id="id_cazary_full" placeholder="Enter Result here..." style="height: 650px; width: 100%;" name="result"><?php echo $interpretation ?></textarea>
<input type="hidden" name="caseno" value="<?php echo $caseno ?>">
<input type="hidden" name="refno" value="<?php echo $refno ?>">
<input type="hidden" name="ap" value="<?php echo $ap ?>">
<input type="hidden" name="trantype" value="<?php echo $trantype ?>">
<input type="hidden" name="radiologist" value="<?php echo $radiologist ?>">
<input type="hidden" name="senior" value="<?php echo $senior ?>">
<script type="text/javascript" src="<?php echo $ipadd ?>assets/vendor/editor/addition.js"></script>
<script type="text/javascript" src="<?php echo $ipadd ?>assets/vendor/editor/dist/cazary.min.js"></script>
<script type="text/javascript">
//(function($, window){$(function($){$("textarea#id_cazary_full").cazary({commands: "FULL"});});})(jQuery, window);
function vval(val){document.getElementById('id_cazary_full').value=val;}
</script>



              
              
              
</div>
</div>
</div>
</section>
</main><!-- End #main -->
</form>
