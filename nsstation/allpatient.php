<style>
.tabley {
  border: 1px solid #ccc;
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  width: 100%;
  /*table-layout: fixed;*/
}

.tabley caption {
  font-size: 1.5em;
  margin: .5em 0 .75em;
}

.tabley tr {
  background-color: #f8f8f8;
  border: 1px solid #ddd;
  padding: .35em;
}

.tabley th,
.tabley td {
  padding: .625em;
 /* text-align: center;*/
}

.tabley th {
  font-size: .85em;
  letter-spacing: .1em;
  text-transform: uppercase;
}

@media screen and (max-width: 600px) {
  .tabley {
    border: 0;
  }

  .tabley caption {
    font-size: 1.3em;
  }
  
  .tabley thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  .tabley tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  
  .tabley td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  
  .tabley td::before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  
  .tabley td:last-child {
    border-bottom: 0;
  }
}

</style>

<?php
$datenow = date("Y-m-d");
// ------------------------------- Doctor's Login Access --------------------
if($dept=="DOC-OTHERS" or $dept=="MEDICARE" or $dept=="PHARMACY" or $dept=="pharmacy_opd" or $dept=="csr2"  or $dept=="PT" or $dept=="RT" or $dept=="VERIFIER" or $dept=="TRANSCRIBER"){
if(isset($_GET["activepatients"])){$qry = "a.ward ='in' and a.room!='OPD' and a.status!='discharged'"; $bc = "IPD List";}
elseif(isset($_GET["activeptopd"])){$qry = "a.ward='out' and a.dateadmit = '$datenow'";  $bc = "OPD List";}
elseif(isset($_GET["activeptopd_alt"])){$qry = "(a.room='ER' OR a.room='ONCO') and a.membership='phic-med' and a.status!='discharged'";}
elseif(isset($_GET["mypatient"])){$qry = "a.ward ='in' and a.room!='OPD' and (a.ap like '%$user%' or a.ap like '%$empid%')"; $bc = "My Patient";}
else{$qry = "a.ward ='in' and a.room!='OPD' and a.status!='discharged'"; $bc = "IPD List";}
}else{$qry = "a.ward ='in' and a.room!='OPD' and a.status!='discharged'"; $bc = "IPD List";}
$datax = "&username=".$user."&userunique=".$userunique."&dept=".$dept."&branch=".$branch."&empid=".$empid;
// --------------------------------------------------------------------------
?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="?main">Main</a></li>
          <li class="breadcrumb-item"><?php echo $bc ?></li>
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
 a.employerno, r.nursestation FROM admission a LEFT JOIN patientprofile pp ON pp.patientidno=a.patientidno JOIN room r ON r.room=a.room WHERE $qry 
 group by a.caseno order by pp.lastname";
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
$dateadmit2=$row['dateadmit'];
$room=$row['room'];
$status=$row['status'];
$status1 =$row['status'];
$ap=$row['ap'];
$sf=$row['result'];
$hmomembership=$row['hmomembership'];
$sex = $row['sex'];
$station = $row['nursestation'];
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
  $status="<span class='badge bg-success'><i class='icofont-pulse'></i> $status</span>";
  }
  UpdateStatus($caseno);
  $i++;

echo"
<tr>
<td bgcolor='$col' align='center'><font color='$colx' size='2'>$i.</td>
<td data-label='Patient Information' bgcolor='$col' style='color: $colx; font-size: 11px;'><div class='row'><div class='col-lg-2'><a href='?detail&caseno=$row[caseno]' title='View Profile'><img src='../main/img/$ge.png' width='30' height='30' style='border-radius: 50%;'></a></div><div class='col-lg-10'> $patientidno $newadd<br><b>$name</b></div></div></td>
<td data-label='Caseno' bgcolor='$col' style='color: $colx; font-size: 11px;'>$caseno<br>$hcaseno</td>
<td data-label='Date/Time Admit/ AP' bgcolor='$col' style='color: $colx; font-size: 11px;'>$dateadmit $timeadmitted <br> $ap</td>
<td data-label='Room/Status' bgcolor='$col' style='color: $colx; font-size: 11px;'>$room<br><font color='$col' class='$blink'>$status</td>
<td style='text-align: center;' bgcolor='$col'>
<a href='?detail&caseno=$row[caseno]' class='btn btn-outline-dark btn-sm' title='View Profile'>
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
</main>
