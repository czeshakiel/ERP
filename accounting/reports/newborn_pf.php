<?php
$date = date("Y-m-d");

echo"
<table width='80%' align='center'><tr><td>

<div class='dd-handle'>
<div class='task-info d-flex align-items-center justify-content-between'>
<h6 class='light-info-bg py-1 px-2 rounded-1 d-inline-block fw-bold small-14 mb-0'>(NEWBORN TEST)</h6>
</div>

<form method='POST' action='../printreport/newbornpf' target='_blank'>
<Input type='hidden' name='redirect'>
<table width='100%' align='center'>
<tr>
<td>Start Date :<br><input type='date' name='datef' value='$date' style='height:30px; font-size:12pt; padding: 0px; width: 100%;' required></td>
</tr>

<tr>
<td>End Date :<br><input type='date' name='datet' value='$date' style='height:30px; font-size:12pt; padding: 0px; width: 100%;' required></td>
</tr>
<!--tr>
<td>TRANSACTION:<br>
<select name='trans' class='form-control select2-single' style='height:30px; font-size:12pt; padding: 0px;'>
<option value='CASH'>CASH</option>
<option value='HMO'>HMO</option>
<option value='PHIC'>PHIC</option>
<option value='CHARGE EXCESS'>CHARGE EXCESS</option>
</select>
</td>
</tr>
<tr>
<td>TEST :<br>
<select name='test' class='form-control select2-single' style='height:30px; font-size:12pt; padding: 0px;'>
";

$sqltest = $conn->query("SELECT * FROM receiving WHERE `unit` LIKE 'LABORATORY' AND `description` LIKE '%NEWBORN%' ORDER BY `description` ASC");
while($rowresult = $sqltest->fetch_assoc()) { 
$productcode=$rowresult['code'];
$productdesc=$rowresult['itemname'];
echo "<option value='$productcode'>$productdesc</option>";
}
echo"
<option value='All'>All</option>
</select>
</td>
</tr-->
<tr>
<td>READER :<br>
<select name='reader' class='form-control select2-single' style='height:30px; font-size:12pt; padding: 0px;' required>
";
echo "<option value=''>Select reader...</option>";
$sql22d = $conn->query("SELECT * FROM nsauthdoctors WHERE station='NEWBORNDOCTORS' AND name!=''");
while($row22d = $sql22d->fetch_assoc()) { 
$name=$row22d['name'];
$empid=$row22d['empid'];
echo "<option value='$empid'>$name</option>";
}
echo "<option value='All'>All</option>";
echo"
</select>
</td>
</tr>

<tr>
<td colspan='2' style='text-align: right;'>
<button type='submit' class='btn btn-success btn-sm'><font size='3%'><i class='icofont-check'></i> Submit</font></button>
<br> <br> 
</td>
</tr>
</table>	
</form>

<div class='tikit-info row g-3 align-items-center'>
<div class='col-sm'>
</div>
</div>
</div>

</td></tr></table>
";
?>