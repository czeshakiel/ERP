<script>
function bb(){document.getElementById('iddecking').click();}
function ifrefund(){if (confirm('Refund selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};}
</script>
<button type='button' id='iddecking' data-bs-toggle='modal' data-bs-target='#decking' hidden>My Button</button>

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
              <h7><b><?php echo strtoupper($patientname); ?></b></h7>
              <p align="center" style="font-size: 11px;"><?php echo $address ?></p>
              
              
              <table width="100%">
               <tr><td><hr style="border: 2px solid red; border-radius: 5px;"></td></tr>
              </table>
              
              
                            <div class="d-flex align-items-start" style="width: 100%;">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><font size="2%">H-Info</font></button>
                  <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><font size="2%">P-Info</font></button>
                  <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"><font size="2%">PHIC &<br> HMO</font></button>
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
<th class="text-center">REFNO/ DESCRIPTION<br>DATE & TIME</th>
<th class="text-center"><br> STATUS/<br>FILMNO/ TEST</th>
<th class="text-center"></th>
<th class="text-center"></th>
</tr>
</thead>
<tbody>
                                  
<?php 
$i=0;
$sql = "select * from productout where (productdesc LIKE '%ABG%' or productdesc LIKE '%ASTHMA%' or productdesc LIKE '%COPD%' or
productdesc LIKE '%SPIRO%' or productdesc LIKE '%SLEEP TEST%') and productsubtype not like '%SUPPLIES%' and caseno='$caseno' and status not like 
'%CANCELLED%' group by refno";
$result = $conn->query($sql);
while($row4 = $result->fetch_assoc()) { 
$si="1";$col="";$col1="black";$blink="";$i++;$ofr="";

$caseno=$row4['caseno'];
$refno=$row4['refno'];
$productdesc=$row4['productdesc'];
$status =$row4['status'];
$loginuser=$row4['loginuser'];
$terminalname=$row4['terminalname'];
$patientidno=$row4['patientidno'];
$invno=$row4['invno'];
$trantype=$row4['trantype'];
$productsubtype = $row4['productsubtype'];
$productcode =$row4['productcode'];
$appro=$row4['approvalno'];
$datearray=$row4['datearray'];
$finalized=$row4['shift'];
list($user, $filmno) = explode('_', $appro);
if($filmno == "") {list($user, $filmno) = explode('-', $appro); }
$loginuser = strtoupper($loginuser);


if($status=="PAID"){
$resulta13x = $conn->query("SELECT ofr from collection where refno='$refno'");
while($rowa13x = $resulta13x->fetch_assoc()){$ofr =$rowa13x['ofr'];}
}

if($empid=="735"){$disp = "<a href='../others/change_reader.php?caseno=$caseno&refno=$refno' target='_blank'>$productdesc</a>";}else{$disp ="$productdesc";}

echo"
<tr>
<td bgcolor='$col' align='center' style='font-size: 11px;'>$i.</td>
<td bgcolor='$col' style='font-size: 11px;'><i class='icofont-flask'></i> <b>$disp</b><br><i class='icofont-id'></i> $refno<br><i class='icofont-calendar'></i> $datearray - $invno</td>
<td bgcolor='$col' style='font-size: 11px;'><i class='icofont-gears'></i> $status - $ofr<br><i class='icofont-film'></i> $filmno<br><i class='icofont-info-circle'></i> $terminalname</td>
<td bgcolor='$col' align='center' style='font-size: 11px;'>
<a tabindex='0' class='btn btn-outline-primary btn-sm' role='button' title='Person Request' data-bs-container='body' data-toggle='popover' data-bs-placement='top' data-bs-content='$loginuser' style='border-radius: 50%;'><i class='icofont-user-alt-4'></i></a>  
<button type='button' class='btn btn-outline-danger btn-sm' role='button' title='Reader Doctor' data-bs-container='body' data-toggle='popover' data-bs-placement='top' data-bs-content='$read' style='border-radius: 50%;'><i class='icofont-man-in-glasses'></i></button>  
</td>
<td bgcolor='$col' align='center'>
";
if(isset($_GET['nsstation']) or isset($_GET['philhealth'])){
if($terminalname=="Testtobedone" or $terminalname=="pending"){echo "<p align='center'><font size='1'>Request is not Test Done</font></p>";}
else{echo"<a class='btn btn-outline-dark mb-1 btn-sm' href='../printresult/imaging-view/$caseno/$refno' target='_blank' title='Print Result'><font size='2'><i class='icofont-printer'></i></font></a>";}
}else{

if($status=="requested"){echo "<p align='center'><font size='1'>Request is not Paid or Approved</font></p>";}
elseif($terminalname=="refund"){}
elseif($terminalname=="pending" and ($status=="Approved" or $status=="PAID")){
echo "
<div class='btn-group btn-group-justified'>
<a class='btn btn-outline-warning mb-1 btn-sm' href='../radiology/xraydecking.php?caseno=$caseno&refno=$refno&productsubtype=$productsubtype$datax' target='tabiframedecking' onclick='bb();' title='Generate Result'><font size='2'><i class='icofont-flask'></i></font></a>
"; if($status=="PAID"){ echo"<a class='btn btn-outline-warning mb-1 btn-sm' href='?xrayresults&caseno=$caseno&refno=$refno$datax&btnrefund' onclick='ifrefund();' title='Refund Item'><font size='2'><i class='icofont-undo'></i></font></a>";}
echo"</div>";
}
elseif($terminalname=="Testtobedone"){echo "<p align='center'><font size='1'>Request is not Test Done</font></p>";}
elseif($finalized=="finalized"){echo "<p align='center'><font size='1'>Request is Already Finalized..</font></p>";}
else{
echo"
<div class='btn-group btn-group-justified'>
<a class='btn btn-outline-dark mb-1 btn-sm' href='../printresult/imaging/$caseno/$refno' target='_blank' title='Print Result'><font size='2'><i class='icofont-printer'></i></font></a>
<a class='btn btn-outline-dark mb-1 btn-sm' href='?abg_createresult&caseno=$caseno&refno=$refno' title='Edit Result'><font size='2'><i class='icofont-ui-edit'></i></font></a>
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