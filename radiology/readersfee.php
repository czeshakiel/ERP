

<main id="main" class="main">

    <div class="pagetitle">
      <h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="?main">Main</a></li>
          <li class="breadcrumb-item"><a href="?readersfee">Readers Fee</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->


<form method="POST" action="../printreport/readersfee" target="_blank">
<div class="row">
<div class="col-xl-5">

<div class="card">
<div class="card-body">

<div class="row">
<div class="col-xl-12" style="font-size:12px;">
<b>Date From:</b><br><input type='date' name='datefrom' class='form-control' required>
</div>
<div class="col-xl-12" style="font-size:12px;">
<b>Date To:</b><br><input type='date' name='dateto' class='form-control' required>
</div>
<div class="col-xl-12" style="font-size:12px;">
<b>Report Type:</b><br>
<select name="type" id="type" class="form-control select2-single" style="width:100%;" onchange="myview()" required>
<option value="">Select Type</option>
<option value="Accounttitle">Accounttitle</option>
<option value="description">Description</option>
</select>
</div>
<div class="col-xl-12" style="font-size:12px; display:none;" id="viewaccttitle">
<b>Account Title:</b><br>
<select name="accttitle"  class="form-control select2-single" style="width:100%;">
  <option value="XRAY">XRAY</option>
  <option value="ULTRASOUND">ULTRASOUND</option>
  <option value="CT SCAN">CT SCAN</option>
  <option value="ALL">ALL</option>
</select>
</div>
<div class="col-xl-12" style="font-size:12px; display:none;" id="viewdesc">
<b>Description:</b><br>
<select name="desc"  class="form-control select2-single" style="width:100%;">
<?php
$sqltest = $conn->query("SELECT * from receiving WHERE (unit = 'XRAY' OR unit='ULTRASOUND' OR unit='CT SCAN' OR unit='MAMMOGRAPHY') ORDER BY description ASC");
while($rowresult = $sqltest->fetch_assoc()) { 
$productcode=$rowresult['code'];
$productdesc=$rowresult['description'];
echo "<option value='$productcode'>$productdesc</option>";
}
?>
</select>
</div>
<div class="col-xl-12" style="font-size:12px;">
<b>Readers:</b><br>
<select name="reader" class="form-control select2-single" style="width:100%;">
<?php
$sql22d = $conn->query("select * FROM nsauthdoctors where station='RADIOLOGYDOCTORS'");
while($row22d = $sql22d->fetch_assoc()) { 
$name=$row22d['name'];
$empid=$row22d['empid'];
echo "<option value='$empid'>$name</option>";
}
?>
</select>
</div>
<div class="col-xl-12" style="font-size:12px; text-align: right;">
<br>
<button type="submit" name='bntsubmit' class='btn btn-danger'>Generate Report</button>
</div>

</div>

</div>
</div>


</div>
</div>
</form>


<script>
function myview(){
var val = document.getElementById('type').value;

if(val=="Accounttitle"){
  document.getElementById('viewaccttitle').style.display='';
  document.getElementById('viewdesc').style.display='none';
}else if(val=="description"){
  document.getElementById('viewaccttitle').style.display='none';
  document.getElementById('viewdesc').style.display='';
}else{
  document.getElementById('viewaccttitle').style.display='none';
  document.getElementById('viewdesc').style.display='none';
}
}
</script>