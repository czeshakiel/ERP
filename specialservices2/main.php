<script>
function disch(){if (confirm('Are you sure you want to discharge this patient??')){return true;}else{event.stopPropagation(); event.preventDefault();};}
function cancel(){if (confirm('Are you sure you want to cancel this patient??')){return true;}else{event.stopPropagation(); event.preventDefault();};}
function arrv(){if (confirm('Are you sure you want to arrive this patient??')){return true;}else{event.stopPropagation(); event.preventDefault();};}
</script>

<?php
if(isset($_GET['arrv'])){
$casexx = $_GET['caseno'];
$autono = $_GET['autono'];

$sql7 = "UPDATE ORSCHEDULE SET status='ARRIVED'  WHERE caseno='$casexx' and autono='$autono'";
if ($conn->query($sql7) === TRUE) {}
echo"<script>window.location='?detail&caseno=$caseno';</script>";
}

if(isset($_GET['disch'])){
$casexx = $_GET['caseno'];
$autono = $_GET['autono'];

;
$sql7 = "UPDATE ORSCHEDULE SET status='DISCHARGED' WHERE caseno='$casexx' and autono='$autono'";
if ($conn->query($sql7) === TRUE) {}
echo"<script>window.location='?view=main$datax';</script>";
}

if(isset($_GET['canc'])){
$casexx = $_GET['caseno'];

$sql7 = "UPDATE ORSCHEDULE SET status='DISCHARGED' WHERE caseno='$casexx'";
if ($conn->query($sql7) === TRUE) {}
echo"<script>window.location='?view=main$datax';</script>";
}
?>
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


            <table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Patient Information</th>
                    <th scope="col">Generated & <br>Hospital Caseno</th>
                    <th scope="col">Date/ Time Admitted <br>Procedure</th>
                    <th scope="col">Room & Status</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>

                                 
                  <?php

$i=0;
$sql = "select p.lastname, p.firstname, p.middlename, p.sex, o.typeofoperation, a.room, o.dateofoperation, o.timeofoperation, o.status,
 o.caseno, o.usages, o.autono, a.ap, a.employerno, a.patientidno, a.dateadmit, a.timeadmitted from ORSCHEDULE o, patientprofile p, admission a where o.caseno=a.caseno
  and o.room = '$dept' and  (o.status ='RESERVED' or  o.status ='ARRIVED') AND   o.patientidno= p.patientidno order by p.lastname asc";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$patientidno=$row['patientidno'];
$caseno=$row['caseno'];
$hcaseno=$row['employerno'];
$lname=$row['lastname'];
$fname=$row['firstname'];
$mname=$row['middlename'];
$name = $lname.", ".$fname." ".$mname;
$dateadmit=date("M d, Y", strtotime($row['dateadmit']));
$timeadmitted=date("h:s:i a", strtotime($row['timeadmitted']));
$room=$row['room'];
$status=$row['status'];
$status1 =$row['status'];
$sf=$row['result'];
$typeofoperation=$row['typeofoperation'];
$hmomembership=$row['hmomembership'];
$autono=$row['autono'];
$sex = $row['sex'];
if($sex=="M"){$ge = "boy"; $sexcol ="blue";}else{$ge = "girl"; $sexcol ="#F309B6";}
$namearrayx=$lname.', '.$fname.' '.$mname;


$col="";
$icon = "<i style='font-size: 20px; color: #black;'><i class='bi bi-person-badge'></i></i>";
$col1="black";
$blink="";
$i++;


 if($status == "ARRIVED") {
$btn ="
<a href='?detail&caseno=$caseno$datax' class='btn btn-outline-primary btn-sm' title='View Profile'><i class='icofont-hotel-boy'></i></a>
<a href='?main&caseno=$caseno$datax&autono=$autono&disch' onclick='disch()' class='btn btn-outline-danger btn-sm' title='DIscharged Patient'><i class='icofont-sign-out'></i></a>
";
}else{
$btn ="
<a href='?main&caseno=$caseno$datax&autono=$autono&arrv' onclick='arrv()' class='btn btn-outline-warning btn-sm' title='Arrived Patient'><i class='icofont-checked'></i></a>
<a href='?main&caseno=$caseno$datax&autono=$autono&canc' onclick='cancel()' class='btn btn-outline-success btn-sm' title='Cencel Request'><i class='icofont-close-circled'></i></a>
";
}
                                              

echo"
<tr>
<td bgcolor='$col' align='center'><font color='$colx' size='2'>$i.</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><table><tr><td><img src='../main/img/$ge.png' width='30' height='30' style='border-radius: 50%;'></td><td> $patientidno<br><b>$name</b></td></tr></table></td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'>$caseno<br>$hcaseno</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'>$dateadmit $timeadmitted <br> <span class='badge bg-primary'><i class='bi bi-exclamation-triangle me-1'></i> $typeofoperation</span></td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><table><tr><td>$icon</td><td>$room<br><font color='$col'>$status</td></tr></table></td>
<td style='text-align: center;' bgcolor='$col'>
$btn
</td>
</tr>
";
}


?>
                  

</tbody>
</table>
              


            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
