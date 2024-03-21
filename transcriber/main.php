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

<h5>NO COURSE IN THE WARD [TO FOLLOW]</h5><hr>
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
include "../nsstation/change_status.php";
$i=0;
$sql = "select * from admission a, patientprofile p where a.patientidno=p.patientidno and a.lastnamed='to follow'";
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
$i++;

$sql1ss = "select * from courseward where caseno='$caseno'";
$result1ss = $conncf4->query($sql1ss);
$count_courseward = mysqli_num_rows($result1ss);

if($count_courseward<2){

echo"
<tr>
<td bgcolor='$col' align='center'><font color='$colx' size='2'>$i.</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><table><tr><td><img src='../main/img/$ge.png' width='30' height='30' style='border-radius: 50%;'></td><td> $patientidno<br><b>$name</b></td></tr></table></td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><table><tr><td>$caseno<br>$hcaseno</td></tr></table></td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><table><tr><td>$dateadmit $timeadmitted <br> $ap</td></tr></table></td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><table><tr><td>$icon</td><td>$room<br><font color='$col' class='$blink'>$status</td></tr></table></td>
<td style='text-align: center;' bgcolor='$col'>
<a href='?detail&caseno=$row[caseno]$datax' class='btn btn-outline-dark btn-sm' title='View Profile'>
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


