
<main id="main" class="main">

<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?view=main">Main</a></li>
<li class="breadcrumb-item">Home Medicine</li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<table width="100%"><tr><td><b><i class="bi bi-credit-card-2-back"></i> HOME MEDICINE</b></td></td></tr></table><hr>


<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th scope="col">#</th>
<th scope="col">Patient Information</th>
<th scope="col">Date/ Time Request and User</th>
<th scope="col">Room and Batchno</th>
<th scope="col">Status</th>
<th scope="col"></th>
</tr>
</thead>
<tbody>

<?php
$i=0;
$sqla2 = $conn->query("SELECT a.*, p.* FROM admission a JOIN productouthm p ON a.caseno = p.caseno WHERE 
(p.productsubtype = 'PHARMACY/MEDICINE' OR p.productsubtype LIKE '%SUPPLIES%') AND p.location = '$dept' AND p.administration = 'pending'
AND p.shift = 'HOMEMEDS' AND p.quantity > 0 AND p.datearray BETWEEN DATE_SUB(CURDATE(), INTERVAL 2 DAY) AND CURDATE()
GROUP BY a.caseno, p.batchno ORDER BY p.datearray DESC, p.invno DESC;");
while($rowa2 = $sqla2->fetch_assoc()){
$caseno =$rowa2['caseno'];
$batchno =$rowa2['batchno'];
$refno =$rowa2['refno'];
$userx =$rowa2['loginuser'];
$status1 =$rowa2['status'];
$trantype=$rowa2['trantype'];
$invnox=date("h:i:s a", strtotime($rowa2['invno']));
$ddate=date("M d, Y", strtotime($rowa2['datearray']));
$patientidno= $rowa2['patientidno'];
$room= $rowa2['room'];
$i++;

$pt = $conn->query("select * from patientprofile where patientidno='$patientidno'");
while($res = $pt->fetch_assoc()){
$lastname = $res['lastname'];
$firstname = $res['firstname'];
$middlename = $res['middlename'];
$sex=$res['sex'];
$patientname = strtoupper($lastname.", ".$firstname." ".$middlename);
if($sex=="M"){$ge = "boy"; $sexcol ="blue";}else{$ge = "girl"; $sexcol ="#F309B6";}
}

$sqla22 = $conn->query("select * from room where room = '$room'");
while($rowa22 = $sqla22->fetch_assoc()){$ns = $rowa22['nursestation'];}

if($trantype=="charge"){$lc = "badge bg-primary";}else{$lc = "badge bg-success";}
if($status1=="requested"){$lc2 = "badge bg-danger"; $arvcol="red";}else{$lc2 = "badge bg-warning"; $arvcol="black";}

echo"
<tr>
<td bgcolor='$col' align='center'><font color='$colx' size='2'>$i.</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><table><tr><td><img src='../main/img/$ge.png' width='30' height='30' style='border-radius: 50%;'></td><td> $caseno<br><b>$patientname</b></td></tr></table></td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><font color='gray'><i class='icofont-ui-calendar'></i></font> $ddate $invnox <br><font color='gray'><i class='icofont-user'></i></font> $userx</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><font color='gray'><i class='icofont-bed'></i></font> $room <font color='blue'>[$ns]</font> <br><font color='gray'><i class='icofont-company'></i></font> $batchno</td>
<td bgcolor='$col' style='color: $col1; font-size: 11px;'><span class='$lc'>$trantype</span><br><span class='$lc2'>$status1</span></td>
<td style='text-align: center;' bgcolor='$col'>
<a href='?details&caseno=$rowa2[caseno]&batchno=$rowa2[batchno]$datax&homemeds' class='btn btn-outline-dark btn-sm' title='View Profile'><i class='icofont-waiter-alt'></i></a>
<a href='../medmatrix/print_home_meds/$rowa2[caseno]/$rowa2[batchno]' target='_blank' class='btn btn-outline-danger btn-sm' title='Print RX'><i class='icofont-printer'></i></a>
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