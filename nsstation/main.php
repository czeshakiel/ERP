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
                    <th scope="col">Date/ Time Admitted <br>Attending Physician</th>
                    <th scope="col">Room & Status</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>

                                 
                  <?php
$i=0;
$sql = "SELECT a.caseno,a.dateadmit,a.room,a.status,a.ap,a.result,a.hmomembership,pp.lastname,pp.firstname,pp.middlename,pp.sex, a.timeadmitted, a.patientidno,
 a.employerno FROM admission a LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno JOIN room r ON r.room=a.room WHERE r.nursestation='$dept' AND 
 a.ward='in' group by a.caseno order by pp.lastname";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$patientidno=$row['patientidno'];
$caseno=$row['caseno'];
UpdateStatus($caseno);
$hcaseno=$row['employerno'];
$lname=$row['lastname'];
$fname=$row['firstname'];
$mname=$row['middlename'];
$name = utf8_encode($lname.", ".$fname." ".$mname);
$dateadmit=date("M d, Y", strtotime($row['dateadmit']));
$timeadmitted=date("h:s:i a", strtotime($row['timeadmitted']));
$dateadmit2=$row['dateadmit'];
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


if($status1=="MGH"){
$blink="blink";
$status="<span class='badge bg-danger'>$status</span>";
}
elseif($status1=="WARNING"){
$blink="blink";
$status="<span class='badge bg-info'><i class='icofont-warning'></i> $status</span>";
}
elseif($status1=="LOCKED"){
$blink="blink";
$status="<span class='badge bg-primary'><i class='icofont-ui-lock'></i> $status</span>";
}
elseif($status1=="YELLOW TAG"){
$blink="blink";
$status="<span class='badge bg-warning'><i class='icofont-ban'></i> $status</span>";
}else{$status="<i class='icofont-patient-bed'></i> $status";}

$today= date("Y-m-d");
if($today==$dateadmit2){$newadd = "<span class='badge' style='background-color: #31e62e; color: #113dee;'><i class='icofont-star'></i> TODAY ADMISSION</span>";}
else{$newadd = "";}


if($sf=="FINAL"){
$blink="blink";
$status="FOR DISCHARGE";
$status="<span class='badge bg' style='background: #b2117b; color: white;'><i class='icofont-pulse'></i> $status</span>";
}

$i++;


echo"
<tr>
<td align='center' style='background: $col; font-size: 11px;'>$i.</td>
<td style='background: $col; font-size: 11px;'><table><tr><td><img src='../main/img/$ge.png' width='30' height='30' style='border-radius: 50%;'></td><td> $patientidno $newadd<br><b>$name</b></td></tr></table></td>
<td style='background: $col; font-size: 11px;'><table><tr><td>$caseno<br>$hcaseno</td></tr></table></td>
<td style='background: $col; font-size: 11px;'><table><tr><td>$dateadmit $timeadmitted <br> $ap</td></tr></table></td>
<td style='background: $col; font-size: 11px;'><table><tr><td>$icon</td><td>$room<br><font class='$blink'>$status</td></tr></table></td>
<td style='text-align: center; background: $col; font-size: 11px;'>
<a href='?detail&caseno=$row[caseno]$datax' class='btn btn-outline-dark btn-sm' title='View Profile'>
<i class='icofont-man-in-glasses'></i>
</a>
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


