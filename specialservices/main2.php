<script>
function disch(){if (confirm('Are you sure you want to discharge this patient??')){return true;}else{event.stopPropagation(); event.preventDefault();};}
function cancel(){if (confirm('Are you sure you want to cancel this patient??')){return true;}else{event.stopPropagation(); event.preventDefault();};}
function arrv(){if (confirm('Are you sure you want to arrive this patient??')){return true;}else{event.stopPropagation(); event.preventDefault();};}
</script>

<?php
if(isset($_GET['arrv'])){
$casexx = $_GET['caseno'];
$autono = $_GET['autono'];


$result = $conn->query("select * from ORSCHEDULE where caseno='$casexx' and autono='$autono'");
while($row = $result->fetch_assoc()){
$pf=$row['pf'];

$pf=str_replace('"', "", $pf);
$pf=str_replace('[', "", $pf);
$pf=str_replace(']', "", $pf);
$pf = explode(",", $pf);
$countpf = count($pf);
  
for($d=0; $d<$countpf; $d++){
list($doctor, $specialization) = explode("||", $pf[$d]);
  
$dd = $conn->query("select * from docfile where code='$doctor'");
while($dd1 = $dd->fetch_assoc()){$doct = $dd1['name'];}
  
$refno = date("YmdHis")."".$d;
$conn->query("INSERT INTO `productout`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`,
 `gross`, `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`,
 `approvalno`, `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`) VALUES
 ('$refno',CURTIME(),'$casexx','$doctor','$doct','0','1','0','0','charge','0','0','0',CURDATE(),'Approved',
 '','$user','$refno','$specialization','PROFESSIONAL FEE','doc-pf','','Approved','$branch','0',CURDATE(),'')");

}
}

$conn->query("UPDATE ORSCHEDULE SET status='ARRIVED'  WHERE caseno='$casexx' and autono='$autono'");
echo"<script>window.location='?main';</script>";
}

if(isset($_GET['disch'])){
$casexx = $_GET['caseno'];
$autono = $_GET['autono'];

;
$sql7 = "UPDATE ORSCHEDULE SET status='DISCHARGED' WHERE caseno='$casexx' and autono='$autono'";
if ($conn->query($sql7) === TRUE) {}
echo"<script>window.location='?main';</script>";
}

if(isset($_GET['canc'])){
$casexx = $_GET['caseno'];

$sql7 = "UPDATE ORSCHEDULE SET status='DISCHARGED' WHERE caseno='$casexx'";
if ($conn->query($sql7) === TRUE) {}
echo"<script>window.location='?main';</script>";
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


            <table id="myProjectTable" class="table table-hover align-middle mb-0" width="100%">
                <thead>
                  <tr>
                    <th scope="col" width='1%'>#</th>
                    <th scope="col" width='25%'>Patient Information</th>
                    <th scope="col" width="30%">Date/ Time Schedule <br>& Procedure</th>
                    <th scope="col">Doctors</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>

                                 
                  <?php

$i=0;
$sql = "select o.room as room2, o.type, o.pf, p.lastname, p.firstname, p.middlename, p.sex, o.typeofoperation, a.room, o.dateofoperation, o.timeofoperation,
 o.status, o.caseno, o.usages, o.autono, a.ap, a.employerno, a.patientidno from ORSCHEDULE o, patientprofile p, admission a where o.caseno=a.caseno 
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
$dateadmit=date("M d, Y", strtotime($row['dateofoperation']));
$timeadmitted=date("h:s:i a", strtotime($row['timeofoperation']));
$room=$row['room'];
$status=$row['status'];
$status1 =$row['status'];
$sf=$row['result'];
$typeofoperation=$row['typeofoperation'];
$typeofoperation2=$row['typeofoperation'];
$hmomembership=$row['hmomembership'];
$autono=$row['autono'];
$sex = $row['sex'];
if($sex=="M"){$ge = "boy"; $sexcol ="blue";}else{$ge = "girl"; $sexcol ="#F309B6";}
$namearrayx=$lname.', '.$fname.' '.$mname;

$pf=$row['pf'];
$batchno = $row['pf'];
$type=$row['type'];
$room2=$row['room2'];
$i++;

if($room2=="OR"){
$pf=str_replace('"', "", $pf);
$pf=str_replace('[', "", $pf);
$pf=str_replace(']', "", $pf);
$pf = explode(",", $pf);
$countpf = count($pf);

for($d=0; $d<$countpf; $d++){
list($doctor, $specialization) = explode("||", $pf[$d]);

$dd = $conn->query("select * from docfile where code='$doctor'");
while($dd1 = $dd->fetch_assoc()){$doct = $dd1['name'];}

$mydoc = $doct." <font color='red'>".$specialization."</font>";
if($d==0){$mydoc2 = $mydoc;}else{$mydoc2 = $mydoc2."<br>".$mydoc;}
}



$dd2 = $conn->query("select * from rsurgery where proccode='$typeofoperation'");
while($dd12 = $dd2->fetch_assoc()){$typeofoperation = $dd12['procdesc'];}
}

//if(strpos($pf, "RF")!==false){$mydoc2="";}

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
<!--a href='?main&caseno=$caseno$datax&autono=$autono&arrv' onclick='arrv()' class='btn btn-outline-warning btn-sm' title='Arrived Patient'><i class='icofont-checked'></i></a-->
<a href='../specialservices/orverify.php?caseno=$caseno&autono=$autono' target='tabiframereturn'><button type='button' data-bs-toggle='modal' data-bs-target='#requestreturn2x' class='btn btn-outline-warning btn-sm' title='Arrived Patient'><i class='icofont-checked'></i></button></a>
<a href='?main&caseno=$caseno$datax&autono=$autono&canc' onclick='cancel()' class='btn btn-outline-success btn-sm' title='Cencel Request'><i class='icofont-close-circled'></i></a>
";
}
                                              

echo"
<tr>
<td bgcolor='$col' align='center' valign='TOP'><font color='$colx' size='2'>$i.</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;' valign='TOP'><table><tr><td valign='TOP'><img src='../main/img/$ge.png' width='40' height='40' style='border-radius: 50%;'></td><td><i class='icofont-ui-tag'></i> $caseno<br><b><i class='icofont-user'></i> $name</b><br><i class='icofont-hospital'></i> $room<br><i class='icofont-info-circle'></i> $status</td></tr></table></td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;' valign='TOP'><i class='icofont-ui-calendar'></i> $dateadmit $timeadmitted <br><font color='#3b8e49'><i class='icofont-flask'></i> $typeofoperation</font></td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;' valign='TOP'>$mydoc2</td>
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



<div class="modal fade" id="requestreturn2x" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog" style="box-shadow: 0px 0px 2000px #6e7fcb;">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> VERIFY PROCEDURE</h5>
<button type="button" class="btn-close" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">


<iframe id='tabiframe2' name='tabiframereturn' src='' width='100%' height='550px' style="border:none;"></iframe>


</div>
</div>
</div>
</div>