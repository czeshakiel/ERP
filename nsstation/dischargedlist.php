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

<h5><span class='badge bg-danger'><i class="icofont-wheelchair"></i> Discharged list less than 24 hours</span></h5><hr>
            <table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Patient Information</th>
                    <th scope="col">Generated & <br>Hospital Caseno</th>
                    <th scope="col">Date/ Time Discharged <br>Attending Physician</th>
                    <th scope="col">Room & Status</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>

                                 
                  <?php
$i=0;
$sql = "SELECT a.caseno,a.dateadmit,a.room,a.status,a.ap,a.result,a.hmomembership,pp.lastname,pp.firstname,pp.middlename,pp.sex, a.timeadmitted, a.patientidno, a.employerno FROM admission a LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno JOIN room r ON r.room=a.room WHERE r.nursestation='$dept' AND a.status='discharged' order by pp.lastname";
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
$ap=$row['ap'];
$sf=$row['result'];
$hmomembership=$row['hmomembership'];
$sex = $row['sex'];
if($sex=="M"){$ge = "boy"; $sexcol ="blue";}else{$ge = "girl"; $sexcol ="#F309B6";}
$namearrayx=$lname.', '.$fname.' '.$mname;

if(is_numeric($ap)){
$sqlAp=mysqli_query($conn,"SELECT `name` FROM docfile WHERE code='$ap'");
if(mysqli_num_rows($sqlAp)>0){
$myap=mysqli_fetch_array($sqlAp);
$ap=$myap['name'];
}else{$ap="";}
}

$col="";
$icon = "<i style='font-size: 20px; color: #black;'><i class='bi bi-person-badge'></i></i>";
$col1="black";
$blink="";


$dis = $conn->query("select * from dischargedtable where caseno='$caseno'");
while($res1 = $dis->fetch_assoc()){
$datedischarged = $res1['datearray'];
$timedischarged = $res1['timedischarged'];
$datetime = $datedischarged." ".$timedischarged;
$datetime2 = date("F d, Y h:i:s a", strtotime($datetime));
}

$date1 = new DateTime($datetime);
$date2 = new DateTime();
$diff = $date2->diff($date1);
$hours = $diff->h;
$hours = $hours + ($diff->days*24);

if($hours<=24){
  $i++;  
echo"
<tr>
<td bgcolor='$col' align='center'><font color='$colx' size='2'>$i.</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><table><tr><td><img src='../main/img/$ge.png' width='30' height='30' style='border-radius: 50%;'></td><td> $patientidno<br><b>$name</b></td></tr></table></td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><table><tr><td>$caseno<br>$hcaseno</td></tr></table></td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><table><tr><td>$datetime2 <br> $ap</td></tr></table></td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><table><tr><td>$icon</td><td>$room<br><font color='$col' class='$blink'>$status</td></tr></table></td>
<td style='text-align: center;' bgcolor='$col'>
<a href='?dischargedsummary&caseno=$row[caseno]$datax' class='btn btn-outline-dark btn-sm' title='View Profile'>
<i class='icofont-man-in-glasses'></i>
</a>
</td>
</tr>
";
}

}


?>
                  

</tbody>
</table>
              


            </div>
          </div>

        </div>
      </div>
    </section>


