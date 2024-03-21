<?php
$page=$_GET['page'];
if($page=="xray"){$que = "(productsubtype = 'XRAY' or productsubtype = 'RADIOLOGY')";}
if($page=="ultrasound"){$que = "productsubtype = 'ULTRASOUND'";}
if($page=="ctscan"){$que = "(productsubtype = 'CTSCAN' or productsubtype = 'CT SCAN')";}
if($page=="mamo"){$que = "productsubtype = 'MAMMOGRAPHY'";}
$page2 = strtoupper($page);
$rdoc = $_SESSION['empiddoc'];
?>

<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($_SESSION['deptdoc'])." DEPARTMENT" ?><small style="font-size: 13px;"> || Reader: <b><?php echo strtoupper($_SESSION['userdoc']); ?></b></small></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?ptlist&page=<?php echo $page ?>"><?php echo $page2 ?> Request</a></li>
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
<th bgcolor="<?php echo $primarycolor2 ?>" class="text-center">VIEW</th>
</tr>
</thead>
<tbody>


<?php
$i=0;
$sql = "SELECT * FROM productout WHERE terminalname!='Testdone' and (trantype not like '%CANCEL%' and caseno not like '%%_cancelled') and 
(status='approved' or status='PAID') and referenceno='$rdoc' and $que GROUP BY refno order by datearray desc, invno desc";
$result = $conn->query($sql);
while($colfetch = $result->fetch_assoc()){
$approvalno=$colfetch['approvalno'];
$status=$colfetch['status'];
$refno= $colfetch['refno'];
$productdesc= $colfetch['productdesc'];
$caseno =$colfetch['caseno'];
$productsubtype =$colfetch['productsubtype'];
$productcode=$colfetch['productcode'];
$trantype =$colfetch['trantype'];
$invno=date("h:i:s a", strtotime($colfetch['invno']));
$datearray =date("F d, Y", strtotime($colfetch['datearray']));
list($approvalno, $filmno) = explode('_', $approvalno);
$ecol = "BLACK";
$i++;

$sql2 = $conn->query("select * from admission a, patientprofile b where a.patientidno=b.patientidno and a.caseno='$caseno'");
while($colfetch2 = $sql2->fetch_assoc()){
$sex = $colfetch2['sex'];
$namearray = strtoupper($colfetch2['lastname'].", ".$colfetch2['firstname']." ".$colfetch2['middlename']);
if($sex=="M"){$ge = "boy"; $sexcol ="blue";}else{$ge = "girl"; $sexcol ="#F309B6";}
}

echo"
<tr>
<td bgcolor='$col' align='center'><font color='$colx' size='2'>$i.</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><table><tr><td><img src='../main/img/$ge.png' width='30' height='30' style='border-radius: 50%;'></td><td> $caseno<br>$namearray</td></tr></table></td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'>$productdesc <br> $productsubtype</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'>$trantype<br>$status</td>
<td bgcolor='$col' style='color: $col1; font-size: 11px;'>$datearray<br>$invno</td>
<td style='text-align: center;' bgcolor='$col'>
<form method='POST' action='?makeresult'>
<button class='btn btn-outline-dark btn-sm' type='submit'><i class='icofont-check'></i></button>
<input name='trantype' type='hidden' id='trantype' value='$trantype'>
<input name='refno' type='hidden' class='style10' id='refno3' value='$refno'>
<input name='radiologist' type='hidden' id='radiologist2' value='$_SESSION[userdoc]'>
<input name='description' type='hidden' id='generic' value='$productdesc'>
<input name='prodsubtype' type='hidden' id='type' value='$productsubtype'>
<input name='caseno' type='hidden' value='$caseno'>
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