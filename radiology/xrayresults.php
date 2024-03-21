
<?php
if(isset($_GET['btnrefund'])){
$caseno = $_GET['caseno'];
$refno = $_GET['refno'];
$conn->query("update productout set terminalname='refund', status='refund', administration='refund' where caseno='$caseno' and refno='$refno'");
echo"<script>window.history.back();</script>";
}

$caseno = $_GET['caseno'];
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



if(isset($_POST['btn_sub'])){
$interpretation = $_POST['result'];
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
$interpretation = addslashes($interpretation);

$sql2z = $conn->query("SELECT * FROM productout where refno='$refno' and caseno='$caseno'");
while($row2z = $sql2z->fetch_assoc()) { $productcode=$row2z['productcode'];}

$sql2zy = $conn->query("SELECT * FROM nsauthdoctors where name='$radiologist'");
while($row2zy = $sql2zy->fetch_assoc()) { $empid=$row2zy['empid'];}

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

$sql7 = $conn->query("update productout set terminalname='Testdone' where refno='$refno' and caseno='$caseno'");

$sql77 = $conn->query("update xray1 set interpretation='$interpretation',authno='$coder',designation='$designation',remarks='$technician',date='$daylight',validate='$transcriptionist',filmno='$filmno',referredby='$doctor'  where refno = '$refno' and caseno='$caseno'");

//==============
if ($trantype == "cash") {
$status1 = "PAID";
$sql778 = $conn->query("insert into productout values('$coder','$todaytimex','$caseno','$empid','$radiologist','$amtSum1','1','0','$amtSum1','NONE','0','0','$amtSum1','$localdate','$status1','$productcode','','$refno','READERS FEE','PROFESSIONAL FEE','','$refno','','$branch','','$todayx','')");	 
}
//==============


//==============
if ($trantype == "charge") {
$status1 = "Approved";
$sql779 = $conn->query("insert into productout values('$coder','$todaytimex','$caseno','$empid','$radiologist','$amtSum1','1','0','$amtSum1','NONE','0','$amtSum1','0','$localdate','$status1','$productcode','','$refno','READERS FEE','PROFESSIONAL FEE','','$refno','','$branch','','$todayx','')");
}
//==============


$sql777 = $conn->query("insert into readersfee values('$maxid','$caseno','$coder','$productcode','$radiologist','$empid','$todayx','$refno','$amtSum1','$opdprice','$senior','PROFESSIONAL FEE')");
// END INSERT AND UPDATE DATA //

echo"window.location='index.php?view=xrayresults&caseno=$caseno$datax';";
}  
?>



<form method="POST">
<main id="main" class="main">

    <div class="pagetitle">
      <h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
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
              <h5 style='text-align: center;'><b><?php echo strtoupper($patientname); ?></b></h5>
              <p align="center" style="font-size: 12px;"><?php echo $address ?></p>
              
              
              <table width="100%">
               <tr><td><hr style="border: 2px solid red; border-radius: 5px;"></td></tr>
              </table>
              
              
                            <div class="d-flex align-items-start" style="width: 100%;">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><font size="2%">1</font></button>
                  <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><font size="2%">2</font></button>
                  <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"><font size="2%">3</font></button>
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








<table class="datatable table">
<thead>
<tr>
<th class="text-center">#</th>
<th class="text-center">REFNO/<br> DESCRIPTION</th>
<th class="text-center">DATE/TIME/<br> STATUS</th>
<th class="text-center">FILMNO/ TEST</th>
<th class="text-center"></th>
<th class="text-center"></th>
</tr>
</thead>
<tbody>
                                  
<?php 
$i=0;
$sql = "select productout.shift, productout.caseno, productout.refno, productout.productdesc,productout.status,productout.gross,
productout.loginuser,productout.terminalname,productout.hmo,productout.invno, admission.ward, admission.patientidno,
 admission.room, admission.dateadmitted, productout.productsubtype,productout.productcode, productout.trantype, productout.date,productout.approvalno, productout.datearray,
admission.timeadmitted from productout, admission where admission.caseno=productout.caseno and (productsubtype = 'XRAY' OR productsubtype='ULTRASOUND'
OR productsubtype='CT SCAN' OR productsubtype='MAMMOGRAPHY') and productout.caseno='$caseno' and productout.status not like '%CANCELLED%' group by productout.refno";
$result = $conn->query($sql);
while($row4 = $result->fetch_assoc()) { 
$si="1";$col="";$col1="black";$blink="";$i++;$ofr="";

$caseno=$row4['caseno'];
$refno=$row4['refno'];
$productdesc=$row4['productdesc'];
$status =$row4['status'];
$gross=$row4['gross'];
$loginuser=$row4['loginuser'];
$terminalname=$row4['terminalname'];
$ward=$row4['ward'];
$patientidno=$row4['patientidno'];
$room=$row4['room'];
$dateadmitted=$row4['dateadmitted'];
$timeadmitted=$row4['timeadmitted'];
$lname=$row4['lastname'];
$fname=$row4['firstname'];
$mname=$row4['middlename'];
$name = $lname.", ".$fname." ".$mname;
$hmo=$row4['hmo'];
$invno=$row4['invno'];
$date=$row4['date'];
$trantype=$row4['trantype'];
$productsubtype = $row4['productsubtype'];
$productcode =$row4['productcode'];
$appro=$row4['approvalno'];
$datearray=$row4['datearray'];
$finalized=$row4['shift'];
list($user, $filmno) = explode('_', $appro);
if($filmno == "") {list($user, $filmno) = explode('-', $appro); }

$sqlh = "select * from xrayevent where hmo='$refno'";
$resulth = $conn->query($sqlh);
$ccount = mysqli_num_rows($resulth);

if($ccount>0){
while($rowh = $resulth->fetch_assoc()) {$read = $rowh['ap'];}
}else{$read = "---------";}

if($status=='requested'){$ecol='red';}
else{$ecol='black';} 
$namearray = "$lastname".",  "."$firstname"."  "."$middlename";

if($ward == "discharged") {$ward = "IN";}
if($ward == "out") {$ward = "OUT";}

$str = "$namearray";
$patientname = strtoupper($str);

$str = "$loginuser";
$loginuser = strtoupper($str);



if($status=="PAID"){
$sqla13x = "SELECT ofr from collection where refno='$refno'";
$resulta13x = $conn->query($sqla13x);
while($rowa13x = $resulta13x->fetch_assoc()) { $ofr =$rowa13x['ofr'];}
$titlex = "Refund Item"; $iconx = "undo";
}else{$titlex = "Cancel Test"; $iconx = "trash";}

if($terminalname=="Testtobedone" or $terminalname=="Testdone"){$hidden="hidden";}else{$hidden="";}

if($empid=="735"){$disp = "<a href='../others/change_reader.php?caseno=$caseno&refno=$refno' target='_blank'>$productdesc</a>";}else{$disp ="$productdesc";}

echo"
<tr>
<td bgcolor='$col' align='center' style='font-size: 11px;'>$i.</td>
<td bgcolor='$col' style='font-size: 11px;'>$refno<br><b>$disp</b></td>
<td bgcolor='$col' align='center' style='font-size: 11px;'>$datearray - $invno<br>$status - $ofr</td>
<td bgcolor='$col' align='center' style='font-size: 11px;'>$filmno<br>$terminalname</td>
<td bgcolor='$col' align='center' style='font-size: 11px;'>
<a tabindex='0' class='btn btn-outline-primary btn-sm' role='button' title='Person Request' data-bs-container='body' data-toggle='popover' data-bs-placement='top' data-bs-content='$loginuser' style='border-radius: 50%;'><i class='icofont-user-alt-4'></i></a>  
<button type='button' class='btn btn-outline-danger btn-sm' role='button' title='Reader Doctor' data-bs-container='body' data-toggle='popover' data-bs-placement='top' data-bs-content='$read' style='border-radius: 50%;'><i class='icofont-man-in-glasses'></i></button>  
</td>
<td bgcolor='$col' align='center'>
";
if(isset($_GET['nsstation'])){
if($terminalname=="Testtobedone" or $terminalname=="pending"){echo "<p align='center'><font size='1'>Request is not<br> Test Done</font></p>";}
else{echo"<a class='btn btn-outline-dark mb-1 btn-sm' href='../printresult/imaging-view/$caseno/$refno' target='_blank' title='Print Result'><font size='2'><i class='icofont-printer'></i></font></a>";}
}elseif(isset($_GET['philhealth'])){
if($terminalname=="Testtobedone" or $terminalname=="pending"){echo "<p align='center'><font size='1'>Request is not<br> Test Done</font></p>";}
else{echo"<a class='btn btn-outline-dark mb-1 btn-sm' href='../printresult/imaging-view/$caseno/$refno' target='_blank' title='Print Result'><font size='2'><i class='icofont-printer'></i></font></a>";}
}else{

if($status=="requested"){echo "<p align='center'><font size='1'>Request is not Paid<br> or Approved</font></p>";}
elseif($terminalname=="refund"){}
elseif($terminalname=="pending"){
echo "
<div class='btn-group btn-group-justified'>
<a class='btn btn-outline-warning mb-1 btn-sm' href='../radiology/xraydecking.php?caseno=$caseno&refno=$refno&productsubtype=$productsubtype$datax' target='tabiframedecking' onclick='bb();' title='Generate Result'><font size='2'><i class='icofont-flask'></i></font></a>
<button type='button' id='iddecking' data-bs-toggle='modal' data-bs-target='#decking' hidden>My Button</button>
<a class='btn btn-outline-warning mb-1 btn-sm' href='?xrayresults&caseno=$caseno&refno=$refno$datax&btnrefund' onclick='ifrefund();' title='$titlex' $hidden><font size='2'><i class='icofont-$iconx'></i></font></a>
</div>
";
}
elseif($terminalname=="Testtobedone"){echo "<p align='center'><font size='1'>Request is not Test Done</font></p>";}
elseif($finalized=="finalized"){echo "<p align='center'><font size='1'>Request is Already Finalized..</font></p>";}
else{
echo"
<div class='btn-group btn-group-justified'>
<a class='btn btn-outline-dark mb-1 btn-sm' href='../printresult/imaging/$caseno/$refno' target='_blank' title='Print Result'><font size='2'><i class='icofont-printer'></i></font></a>
<a class='btn btn-outline-dark mb-1 btn-sm' href='?editresult&caseno=$caseno&refno=$refno&productsubtype=$productsubtype$datax' title='Edit Result'><font size='2'><i class='icofont-ui-edit'></i></font></a>
<a class='btn btn-outline-dark mb-1 btn-sm' href='?xrayresults&caseno=$caseno&refno=$refno&code=$productcode&btnfinal=$datax' title='Finalize Result'><font size='2'><i class='icofont-lock'></i></font></a>
</div>&nbsp;
";
}

}
echo"
</td>
</tr>
";
}
?>
</table>

            
</div>
</div>
</div>
</section>
</main><!-- End #main -->
</form>


<!-------------------------------------------- RETURN MED/SUP ------------------------------------------->
<div class="modal fade" id="decking" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> SET READER AND FILMNO</h5>
<button type="button" class="btn-close" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">

<table width="100%" align="center"><tr><td style="text-align: left;">
<iframe id='tabiframe2' name='tabiframedecking' src='' width='100%' height='600px' style="border:none;"></iframe>
</td><tr></table>


</div>
</div>
</div>
</div>
<!---------------------------------------- END RETURN MED/SUP ------------------------------------------->

<script>
function bb(){document.getElementById('iddecking').click();}
function ifrefund(){if (confirm('Refund selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};}
</script>

