
<?php
if($dept=="PHARMACY_OPD"){$_SESSION['mod']="out"; $dis="hidden";}
if($_SESSION['mod']=="out"){$mod="Out Patient List"; $mod2="IPD"; $ward="a.ward='out' and a.status!='discharged'";}
else{$mod="In Patient List"; $mod2="OPD"; $ward="a.ward='in' and a.status!='discharged'";}

if(isset($_POST['mod'])){
$module = $_POST['mod'];
if($module=="OPD"){$_SESSION['mod']="out";}else{$_SESSION['mod']="in";}
echo"<script>window.location='?main';</script>";
exit();
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

<table width="100%"><tr><td><b><i class="bi bi-credit-card-2-back"></i> PENDING REQUEST - <?php echo $mod ?></b>
</td><td align="right">
<form method="POST">
<button type="submit" class="btn btn-primary btn-sm" name="mod" value="<?php echo $mod2 ?>" <?php echo $dis ?>><i class="icofont-sign-out"></i> Switch to <?php echo $mod2 ?></button>
</form>
</td></tr></table><hr>


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
$sqla2 = $conn->query("SELECT a.caseno, p.batchno, p.refno, p.loginuser, p.status, p.trantype, p.invno, p.datearray, a.patientidno, a.room FROM 
admission a INNER JOIN productout p ON a.caseno = p.caseno WHERE $ward AND (p.productsubtype LIKE '%MEDICINE%' OR p.productsubtype LIKE '%SUPPLIES%')
AND p.location = '$dept' AND p.administration = 'pending' AND p.shift != 'HOMEMEDS' AND p.quantity > 0 GROUP BY p.caseno, p.batchno, p.trantype
ORDER BY p.datearray DESC, p.invno DESC;");
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

if(strpos($caseno, "WPOS")!==false or strpos($caseno, "EMP")!==false or strpos($caseno, "DOC")!==false){$patientpofile="patientprofilewalkin";}
else{$patientpofile="patientprofile";}


if($_SESSION['mod']!="out"){
$sqla22 = $conn->query("select * from room where room = '$room'");
while($rowa22 = $sqla22->fetch_assoc()){$ns = $rowa22['nursestation'];}
}

$pt = $conn->query("select * from $patientpofile where patientidno='$patientidno'");
while($res = $pt->fetch_assoc()){
$lastname = $res['lastname'];
$firstname = $res['firstname'];
$middlename = $res['middlename'];
$sex=$res['sex'];
$patientname = strtoupper($lastname.", ".$firstname." ".$middlename);
if($sex=="M"){$ge = "boy"; $sexcol ="blue";}else{$ge = "girl"; $sexcol ="#F309B6";}
}


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
<a href='?details&caseno=$rowa2[caseno]&batchno=$rowa2[batchno]$datax' class='btn btn-outline-dark btn-sm' title='View Profile'><i class='icofont-waiter-alt'></i></a>
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