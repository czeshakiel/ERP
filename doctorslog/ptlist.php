<?php
$page=$_GET['page'];
if($page=="xray"){$que = "(productsubtype = 'XRAY' or productsubtype = 'RADIOLOGY')";}
if($page=="ultrasound"){$que = "productsubtype = 'ULTRASOUND'";}
if($page=="ctscan"){$que = "(productsubtype = 'CTSCAN' or productsubtype = 'CT SCAN')";}
if($page=="mamo"){$que = "productsubtype = 'MAMMOGRAPHY'";}
$page2 = strtoupper($page);
?>


<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($_SESSION['deptdoc'])." DEPARTMENT" ?><small style="font-size: 13px;"> || Reader: <b><?php echo strtoupper($_SESSION['userdoc']); ?></b></small></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?view=main">Main</a></li>
<li class="breadcrumb-item"><a href="?view=detail&caseno=<?php echo $caseno ?>">Patient Information</a></li>
<li class="breadcrumb-item"><a href="?view=finaldx&caseno=<?php echo $caseno ?>">Set Final Diagnosis</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body"><br>




<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th bgcolor="<?php echo $primarycolor2 ?>" class="text-center">#</th>
<th bgcolor="<?php echo $primarycolor2 ?>" class="text-center">PATIENT INFO</th>
<th bgcolor="<?php echo $primarycolor2 ?>" class="text-center">DESCRIPTION</th>
<th bgcolor="<?php echo $primarycolor2 ?>" class="text-center">STATUS</th>
<th bgcolor="<?php echo $primarycolor2 ?>" class="text-center">DATE/ TIME REQ</th>
<th bgcolor="<?php echo $primarycolor2 ?>" class="text-center" width="10%">FILM NO.</th>
<th bgcolor="<?php echo $primarycolor2 ?>" class="text-center">VIEW</th>
</tr>
</thead>
<tbody>


<?php
$i=0;
$sql = "select * from productout where terminalname!='Testdone' and $que and referenceno ='$_SESSION[empiddoc]' group by refno";
$result = $conn->query($sql);
while($colfetch = $result->fetch_assoc()) {
$approvalno=$colfetch['approvalno'];
$gross=$colfetch['gross'];
$branch =$colfetch['branch'];
$status=$colfetch['status'];
$refno= $colfetch['refno'];
$productdesc= $colfetch['productdesc'];
$batchno =$colfetch['batchno'];
$caseno =$colfetch['caseno'];
$productsubtype =$colfetch['productsubtype'];
$ward =$colfetch['ward'];
$ap=$colfetch['ap'];
$patientidno=$colfetch['patientidno'];
$productcode=$colfetch['productcode'];
$sellingprice =$colfetch['gross'];
$senior =$colfetch['senior'];
$date1 =$colfetch['date'];
$trantype =$colfetch['trantype'];
$hmo=$colfetch['hmo'];
$invno=date("h:i:s a", strtotime($colfetch['invno']));
$datearray =date("F d, Y", strtotime($colfetch['datearray']));
$namearray = $lastname.", ".$firstname." ".$middlename;
$str = "$namearray";
$namearray = strtoupper($str);
$gross=number_format($gross,"2",".",",");
$i++;
list($approvalno, $filmno) = explode('_', $approvalno);
$ecol = "BLACK";

$sel = $conn->query("select * from patientprofile p, admission a where a.patientidno=p.patientidno and a.caseno='$caseno'");
while($sel1 = $sel->fetch_assoc()){$sex = $sel1['gender']; $namearray = $sel1['lastname'].", ".$sel1['firstname']." ".$sel1['middlename'];}

if($sex=="M"){$ge = "boy"; $sexcol ="blue";}else{$ge = "girl"; $sexcol ="#F309B6";}
echo"

<tr>
<td bgcolor='$col' align='center'><font color='$colx' size='2'>$i.</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><table><tr><td><img src='../main/img/$ge.png' width='30' height='30' style='border-radius: 50%;'></td><td> $caseno<br>$namearray</td></tr></table></td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'>$productdesc <br> $productsubtype</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'>$trantype<br>$status</td>
<td bgcolor='$col' style='color: $col1; font-size: 11px;'>$datearray<br>$invno</td>
<td bgcolor='$col' align='center' style='color: $col1;'><input name='filmno' type='text' value ='$filmno'  readonly></td>
<td style='text-align: center;' bgcolor='$col'>
<form method='POST' action='?makeresult'>
<button class='btn btn-outline-dark btn-sm' type='submit'><i class='icofont-check'></i></button>
<input name='description' type='hidden' id='generic' value='$productdesc'>
<input name='patientsname' type='hidden' id='prodqty' value='$namearray'>
<input name='radiologist' type='hidden' id='radiologist2' value='$_SESSION[userdoc]'>
<input name='xraycode' type='hidden' id='patientsname' value='$productcode'>
<input name='prodsubtype' type='hidden' id='type' value='$productsubtype'>
<input name='physician' type='hidden' id='status' value='$ap'>
<input name='batchno' type='hidden' id='text3' value='$batchno'>
<input name='approvalno' type='hidden' id='text3' value='$approvalno'>
<input name='productcode' type='hidden' id='sellingprice' value='$productcode'>
<input name='sellingprice' type='hidden' id='physician' value='$sellingprice'>
<input name='refno' type='hidden' class='style10' id='refno3' value='$refno'>
<input name='patientidno' type='hidden' class='style10' id='patientidno' value='$patientidno'>
<input name='trantype' type='hidden' id='trantype' value='$trantype'>
<input name='senior' type='hidden' id='filmno'  value='$senior'>
<input name='caseno' type='hidden' value='$caseno'>
<input name='status' type='hidden' value='$status'>
<input name='filmno' type='hidden' value='$filmno'>
</form>
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
