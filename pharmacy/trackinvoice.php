<?php
if(isset($_POST['datef']) or isset($_POST['datet'])){
$datef = $_POST['datef'];
$datet = $_POST['datet'];
}else{
$datef = date("Y-m-d");
$datet = date("Y-m-d");
}
?>

<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?trackinvoice">Track Invoice</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<table width="100%"><tr>
<td><b><i class="bi bi-file-earmark-medical"></i> TRACK INVOICE </b></td>
<td align="right">
<form method="POST">
<table width="40%"><tr>
<td><input type="date" name="datef" value="<?php echo $datef ?>"></td>
<td>-</td>
<td><input type="date" name="datet" value="<?php echo $datet ?>"></td>
<td><button type="submit" class="btn btn-primary btn-sm" value="Submit"><i class='icofont-check-circled'></i> Submit</button></td>
</tr></table>
</form>
</td>
</tr></table><hr>

<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th class="text-center">#</th>
<th class="text-center">PATIENT INFO</th>
<th class="text-center">DATE/ User</th>
<th class="text-center">INVOICE/<br>TRANTYPE</th>
<th class="text-center"></th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$sql = "SELECT i.caseno, i.invno, i.trantype, i.datearray, i.timearray, i.user, ifnull(p.lastname, pp.lastname) as lastname, ifnull(p.firstname, pp.firstname) as firstname, ifnull(p.middlename, pp.middlename) as middlename FROM arv_tbl_invoice i left join admission a on i.caseno=a.caseno left join patientprofile p on a.patientidno=p.patientidno left join patientprofilewalkin pp on a.patientidno=pp.patientidno where i.dept='$dept' and i.datearray between '$datef' and '$datet' group by i.invno, i.caseno, i.trantype order by i.datearray desc, i.timearray desc";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()){
$caseno=$row['caseno'];
$lname=$row['lastname'];
$fname=$row['firstname'];
$mname=$row['middlename'];
$name = $lname.", ".$fname." ".$mname;
$datearray=date("F d, Y", strtotime($row['datearray']));
$timearray=date("h:i:s a", strtotime($row['timearray']));
$trantype=$row['trantype'];
$invno=$row['invno'];
$myuser=$row['user'];
$i++; $colx = "black";

echo"
<tr>
<td style='font-size: 11px;'>$i.</td>
<td style='font-size: 11px;'>$caseno<br><b>$name</b></td>
<td style='font-size: 11px;'><font color='gray'>Date/Time:</font>$datearray || $timearray<br><font color='gray'>User:</font> $myuser</td>
<td style='font-size: 11px;'><font color='gray'>Invoice:</font> $invno<br><font color='gray'>Trantype:</font> $trantype</td>
<td style='text-align: center;'>
<a href='chargeslipreprint.php?caseno=$caseno&pname=$name&trantype=$trantype&invno=$invno$datax' target='_blank' class='btn btn-primary btn-sm' style='border-radius: 50%;'><i class='icofont-printer'></i></a>
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
