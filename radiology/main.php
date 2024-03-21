<script>
function confirmx(){
    if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};
    }
</script>

<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?view=main">Main</a></li>
<li class="breadcrumb-item"><a href=""></a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<?php
if(isset($_GET['IPD'])){
$ipd = "class='btn btn-primary btn-sm'";
$opd = "class='btn btn-outline-primary btn-sm'";
$ttbd = "class='btn btn-outline-primary btn-sm'";

$result4 = $conn->query("SELECT a.*, p.*, count(p.refno) as totalreq FROM productout p INNER JOIN admission a ON p.caseno = a.caseno
WHERE (p.productsubtype IN ('XRAY', 'ULTRASOUND', 'CT SCAN', 'MAMMOGRAPHY')) AND a.ward='in' and p.terminalname='pending' AND
p.caseno not like '%%_cancelled' GROUP BY a.caseno HAVING totalreq > 0 ORDER BY p.datearray DESC, p.invno DESC");
}

elseif(isset($_GET['OPD'])){
$opd = "class='btn btn-primary btn-sm'";
$ipd = "class='btn btn-outline-primary btn-sm'";
$ttbd = "class='btn btn-outline-primary btn-sm'";

$result4 = $conn->query("SELECT a.*, p.*, count(p.refno) as totalreq FROM productout p INNER JOIN admission a ON p.caseno = a.caseno
WHERE (p.productsubtype IN ('XRAY', 'ULTRASOUND', 'CT SCAN', 'MAMMOGRAPHY')) AND a.ward='out' and p.terminalname='pending' AND p.caseno not like '%%_cancelled' AND 
p.datearray BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() GROUP BY a.caseno HAVING totalreq > 0 ORDER BY p.datearray DESC, p.invno DESC");
}

elseif(isset($_GET['TTBD'])){
$ttbd = "class='btn btn-primary btn-sm'";
$opd = "class='btn btn-outline-primary btn-sm'";
$ipd = "class='btn btn-outline-primary btn-sm'";

$result4 = $conn->query("SELECT a.*, p.*, count(p.refno) as totalreq FROM productout p INNER JOIN admission a ON p.caseno = a.caseno
WHERE (p.productsubtype IN ('XRAY', 'ULTRASOUND', 'CT SCAN', 'MAMMOGRAPHY')) AND (a.ward='in' or a.ward='out') and p.terminalname='Testtobedone' 
AND p.caseno not like '%%_cancelled' AND p.datearray BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() GROUP BY a.caseno 
HAVING totalreq > 0 ORDER BY p.datearray DESC, p.invno");
}

else{
$ipd = "class='btn btn-primary btn-sm'";
$opd = "class='btn btn-outline-primary btn-sm'";
$ttbd = "class='btn btn-outline-primary btn-sm'";

$result4 = $conn->query("SELECT a.*, p.*, count(p.refno) as totalreq FROM productout p INNER JOIN admission a ON p.caseno = a.caseno
WHERE (p.productsubtype IN ('XRAY', 'ULTRASOUND', 'CT SCAN', 'MAMMOGRAPHY')) AND a.ward='in' and p.terminalname='pending' AND
p.caseno not like '%%_cancelled' GROUP BY a.caseno HAVING totalreq > 0 ORDER BY p.datearray DESC, p.invno");
}

if(!isset($_POST['day1'])){$day1=date("Y-m-d"); $day2=date("Y-m-d");}else{$day1 = $_POST['day1']; $day2 = $_POST['day2'];}
?>

<table width="100%"><tr><td width="45%">
<div class="container">
<div class="btn-group btn-group-justified" style="width: 100%;">
<button name="ipd" style="width:20%; font-size: 12px;" onclick="loadz('IPD');" <?php echo $ipd ?>><i class="icofont-users-alt-5"></i> IPD Request</button></a>
<button name="opd" style="width:20%; font-size: 12px;" onclick="loadz('OPD');" <?php echo $opd ?>><i class="icofont-users-social"></i> OPD Request</button>
<button name="rdu" style="width:20%; font-size: 12px;" onclick="loadz('TTBD');" <?php echo $ttbd ?>><i class="icofont-ui-clip-board"></i> Test To Be Done</button>
</div>
</div>
</td><td>
</td></tr></table>
<hr>


<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr> 
<th class="text-center">#</th>
<th class="text-center">PATIENT <br> INFORMATION</th>
<th class="text-center">DATE/ TIME<br>ADMITTED</th>
<th class="text-center">ROOM</th>
<th class="text-center">REQUEST</th>
<th class="text-center">ACTION</th>
</tr>
</thead>
<tbody>



<?php


while($row4 = $result4->fetch_assoc()){
$patientidno=$row4['patientidno'];
$caseno=$row4['caseno'];
$refno=$row4['refno'];
$productdesc=$row4['productdesc'];
$status =$row4['status'];;
$loginuser=$row4['loginuser'];
$terminalname=$row4['terminalname'];
$patientidno=$row4['patientidno'];
$room=$row4['room'];
$invno=$row4['timeadmitted'];
$date=$row4['dateadmit'];
$trantype=$row4['trantype'];
$productsubtype = $row4['productsubtype'];
$productcode =$row4['productcode'];
$approvalno =$row4['approvalno'];
$totalreq =$row4['totalreq'];
$dtreq = date("F d, Y", strtotime($date))."<br>".date("h:i:s a", strtotime($invno));
list($readercode, $read) = explode("_", $row4['administration']);
if($read==""){$read="---- NOT SET ----";}
$i++;


$result44 = $conn->query("select * from patientprofile where patientidno='$patientidno'");
while($row44 = $result44->fetch_assoc()){
$lname=$row44['lastname'];
$fname=$row44['firstname'];
$mname=$row44['middlename'];
$name = $lname.", ".$fname." ".$mname;
$sex = $row44['sex'];

if($sex=="M"){if($senior=="Y"){$ge="boy";}else{$ge="boy";}}
else{if($senior=="Y"){$ge="girl";}else{$ge="girl";}}
}


echo"
<tr>
<td bgcolor='$col' align='center'><font color='$colx' size='2'>$i.</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><table><tr><td><img src='../main/img/$ge.png' width='30' height='30' style='border-radius: 50%;'></td><td> $caseno<br><b>$name</b></td></tr></table></td>
<td bgcolor='$col' style='color: $colx; font-size: 11px; text-align: center;'>$dtreq</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px; text-align: center;'>$room</td>
<td bgcolor='$col' style='color: $col1; font-size: 14px; text-align: center;'><span class='badge bg-danger'>$totalreq pending</span></td>
<td bgcolor='$col' style='color: $col1; font-size: 11px; text-align: center;'>
<a href='?xrayresults&dept=$dept&caseno=$caseno'><button class='btn btn-primary btn-sm'>View</button></a>
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

<script>
function loadz(val){window.location= "?main&"+val;}
</script>



<!-------------------------------------------- RETURN MED/SUP ------------------------------------------->
<div class="modal fade" id="decking" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> SET READER AND FILMNO</h5>
<button type="button" class="btn-close" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">

<table width="100%" align="center"><tr><td style="text-align: left;">
<iframe id='tabiframe2' name='tabiframedecking' src='' width='100%' height='550px' style="border:none;"></iframe>
</td><tr></table>

</div>
</div>
</div>
</div>
<!---------------------------------------- END RETURN MED/SUP ------------------------------------------->
