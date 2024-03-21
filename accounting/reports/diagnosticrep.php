<script type="text/javascript" src="../main/arv_new/excel/excel.min.js"></script>
<?php include "../main/arv_new/excel/excel.php"; ?>

<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?detail&caseno=<?php echo $caseno ?>">Patient Information</a></li>
<li class="breadcrumb-item"><a href="?editcaseno&caseno=<?php echo $caseno ?>">Change Hospital Caseno</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<p><b><i class="bi bi-file-earmark-medical"></i> Diagnostic Report </b></p><hr>

<?php if(!isset($_POST['datefrom'])){ ?>
<table width="40%"><tr><td>
<div class="card" style='box-shadow: 0px 0px 0px 1px #4B54B2;'>
<div class="card-header" style="background-color: #4B54B2; padding: 7px;">
<table width="100%"><tr><td style="color: white;"> <i class="bi bi-award"></i> HOSPITAL CASENO: <b><?php echo $employerno ?></td></tr></table>
</div>
<div class="card-body">
<form method="POST">
<br><table width="100%" align="center">
<tr>
<td width="30%"><font class="font8">Date from:</td>
<td><input type="date" name="datefrom" style="height:35px; font-size:10pt; color: black; width: 100%;" value="<?php echo date('Y-m-d') ?>" required></td>
</tr>
<tr>
<td><font class="font8">Date to:</td>
<td><input type="date" name="dateto" style="height:35px; font-size:10pt; color: black; width: 100%;" value="<?php echo date('Y-m-d') ?>" required></td>
</tr>
<tr>
<td><font class="font8">Account-title:</td>
<td>
<select name='accttitle' class='form-control select2-single' style='height:30px; font-size:12pt; padding: 0px;'>
<?php
$sqltest = $conn->query("SELECT * from receiving WHERE (unit = 'XRAY' OR unit='ULTRASOUND' OR unit='CT SCAN' OR unit='MAMMOGRAPHY' or
unit='ECG' or unit='EEG' or unit='HEARTSTATION') group by unit ORDER BY unit ASC");
while($rowresult = $sqltest->fetch_assoc()) { 
$productcode=$rowresult['unit'];
$productdesc=$rowresult['unit'];
echo "<option value='$productcode'>$productdesc</option>";
}
?>
</select>
</td>
</tr>
<tr><td colspan="2" align="right">
<button type="submit" name="btnupdate" class="btn btn-primary"><i class="fa fa-edit"></i> Submit</button>
</td></tr>
</table><br>
</form>
</div>
</div>
</td></tr></table>
<?php } ?>



<?php 
if(isset($_POST['datefrom'])){
$datefrom = $_POST['datefrom'];
$dateto = $_POST['dateto'];
$accttitle = $_POST['accttitle'];

?> <button class="btn btn-primary" onclick="ExportToExcel('xlsx')"><i class="icofont-file-excel"></i> Export to excel</button><br><br> <?php

echo"
<h3>Account Title: <b>$accttitle</b></h3>
<table width='100%' border='1' class='table'>
<tr>
<td>name</td>
<td>Test</td>
<td>Status</td>
<td>Amount</td>
<td>Reader</td>
<td></td>
</tr>
";

$total = 0;
$sqlres = $conn->query("select * from patientprofile a, admission b, productout c where a.patientidno = b.patientidno and b.caseno = c.caseno and
 (c.status='PAID' or c.status='Approved') and productsubtype='$accttitle' and terminalname!='refund' and datearray between '$datefrom' and '$dateto'
  order by productsubtype, datearray");
while($res = $sqlres->fetch_assoc()){
$docid = $res['referenceno'];
$gross = $res['gross'];
$caseno = $res['caseno'];
$patientname = $res['patientname'];
$vdate = date("F d, Y", strtotime($res['datearray']));
$gross2 = number_format($gross, 2);
$pdesc = $res['productdesc'];

$prof="<b>READER NOT ASSIGN!</b>"; $doc=""; $hidden = "hidden";
$sqlresd = $conn->query("select * from docfile where (code='$docid' or name='$docid')");
while($dd = $sqlresd->fetch_assoc()){
$prof = $dd['name'];
$id = $dd['code'];
$doc = $id."_".$prof;
$hidden = "";
}


echo"
<tr>
<td style='font-size: 12px;'>$caseno<br>$patientname</td>
<td style='font-size: 12px;'><b>$res[productdesc]</b><br>$vdate</td>
<td style='font-size: 12px;'>$res[terminalname]<br>$res[trantype]/ $res[status]</td>
<td style='font-size: 12px;'>$gross2</td>
<td style='font-size: 12px;'>$prof</td>
<td>
"; ?>
<button class="btn btn-danger" data-bs-toggle='modal' onclick="loaddata('<?php echo $doc ?>', '100', '<?php echo $pdesc ?>');" data-bs-target='#decking1x' title='Verify' <?php echo $hidden ?>><font size='2'><i class='icofont-flask'></i></button>
<?php echo"
</td>
</tr>
";
}
echo"</table>";


echo"
<table width='100%' border='1' class='table' id='excel' hidden>
<tr>
<td>caseno</td>
<td>name</td>
<td>Test</td>
<td>Date Request</td>
<td>Status</td>
<td>Trantype</td>
<td>Trantype2</td>
<td>Amount</td>
<td>Reader</td>
<td></td>
</tr>
";

$total = 0;
$sqlres = $conn->query("select * from patientprofile a, admission b, productout c where a.patientidno = b.patientidno and b.caseno = c.caseno and
 (c.status='PAID' or c.status='Approved') and productsubtype='$accttitle' and terminalname!='refund' and datearray between '$datefrom' and '$dateto'
  order by productsubtype, datearray");
while($res = $sqlres->fetch_assoc()){
$docid = $res['referenceno'];
$gross = $res['gross'];
$caseno = $res['caseno'];
$patientname = $res['patientname'];
$vdate = date("F d, Y", strtotime($res['datearray']));
$gross2 = number_format($gross, 2);
$pdesc = $res['productdesc'];

$prof="<b>READER NOT ASSIGN!</b>"; $doc=""; $hidden = "hidden";
$sqlresd = $conn->query("select * from docfile where (code='$docid' or name='$docid')");
while($dd = $sqlresd->fetch_assoc()){
$prof = $dd['name'];
$id = $dd['code'];
$doc = $id."_".$prof;
$hidden = "";
}

if(strpos($caseno, "I-")!==false){
if($res['trantype']=="cash"){$tr = "IPD CASH";}
else{$tr = "IPD CHARGE";}
}else{
if($res['trantype']=="cash"){$tr = "OPD CASH";}
else{$tr = "OPD CHARGE";}
}

echo"
<tr>
<td style='font-size: 12px;'>$caseno</td>
<td style='font-size: 12px;'>$patientname</td>
<td style='font-size: 12px;'>$res[productdesc]</td>
<td style='font-size: 12px;'>$vdate</td>
<td style='font-size: 12px;'>$res[terminalname]</td>
<td style='font-size: 12px;'>$res[trantype]/ $res[status]</td>
<td style='font-size: 12px;'>$tr</td>
<td style='font-size: 12px;'>$gross2</td>
<td style='font-size: 12px;'>$prof</td>
<td>
"; ?>
<button class="btn btn-danger" data-bs-toggle='modal' onclick="loaddata('<?php echo $doc ?>', '100', '<?php echo $pdesc ?>');" data-bs-target='#decking1x' title='Verify' <?php echo $hidden ?>><font size='2'><i class='icofont-flask'></i></button>
<?php echo"
</td>
</tr>
";
}
echo"</table>";

} 
?>



</div>
</div>
</div>
</div>
</section>
</main>



<!-------------------------------------------- RETURN MED/SUP ------------------------------------------->
<div class="modal fade" id="decking1x" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> Verify Reader</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<p>Test<br><input type="text" name="test" id="test" class="form-control" readonly></p>
<p>Reader<br><input type="text" name="reader" id="reader" class="form-control" readonly></p>
<p>Amount<br><input type="text" name="amount" class="form-control"></p>
<p align="right"><button class="btn btn-danger">Verify</button></button>

</div>
</div>
</div>
</div>
<!---------------------------------------- END RETURN MED/SUP ------------------------------------------->

<script>
function loaddata(val1, val2, val3){
document.getElementById('reader').value=val1;
document.getElementById('test').value=val3;
}
</script>