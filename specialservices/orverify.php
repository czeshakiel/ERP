

<?php
include "../main/class.php";
include "../main/header.php";

echo"
<style>
.tablex { 
width: 100%; 
border-collapse: collapse; 
}

.tablex th { 
background: #3498db; 
color: white; 
font-weight: bold; 
}

.tablex td, th { 
padding: 5px; 
border: 1px solid #070707; 
text-align: left; 
font-size: 11px;
}
</style>
";
$caseno=$_GET['caseno'];
$autono=$_GET['autono'];
$hin = date("h");
$min = date("s");
$pin = date("a");


$sql = "select o.room as room2, o.type, o.pf, p.lastname, p.firstname, p.middlename, p.sex, o.typeofoperation, a.room, o.dateofoperation, o.timeofoperation,
 o.status, o.caseno, o.usages, o.autono, a.ap, a.employerno, a.patientidno, o.remarks, o.type from ORSCHEDULE o, patientprofile p, admission a where o.caseno=a.caseno 
 and o.patientidno= p.patientidno and o.autono='$autono' and o.caseno='$caseno' order by p.lastname asc";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$batchno=$row['pf'];
$test=$row['typeofoperation'];
$remarks=$row['remarks'];
$type=$row['type'];
$protype=$row['usages'];
$dateofoperation=$row['dateofoperation'];
$timeofoperation=$row['timeofoperation'];
list($hh, $mm, $ss) = explode(":", $timeofoperation);
}

$am=""; $pm="";
if($hh>12){$hh = $hh - 12; $pm = "selected";}else{$hh = $hh; $am = "selected";}

$minor=""; $major="";
if($type=="MINOR"){$minor = "selected";}else{$major="selected";}

$sched=""; $oncall=""; $stat="";
if($protype=="Schedule"){$sched="selected";}
elseif($protype=="Oncall"){$oncall="selected";}
else{$stat="selected";}

$sql22 = "SELECT * from admission, patientprofile where admission.patientidno=patientprofile.patientidno and caseno='$caseno'";
$result22 = $conn->query($sql22);
while($row22 = $result22->fetch_assoc()) {
$patientidno=$row22['patientidno'];
$lname=$row22['lastname'];
$fname=$row22['firstname'];
$mname=$row22['middlename'];
$name = $lname.", ".$fname." ".$mname;
}

$datec = $yy."-".$mm."-".$dd;
$today = date("Ymd");
$todaytime = date("his");
$coder=$todaytime."".$today;


if(isset($_POST['btn_submit'])){
$pro = $_POST['pro'];
$deptx = $_POST['dept'];
$date = $_POST['date'];
$hin = $_POST['hin'];
$min = $_POST['min'];
$pin = $_POST['pin'];
$protype = $_POST['protype'];

if($pin=="pm"){$hin = $hin + 12; }
$time = $hin.":".$min.":00";

if($protype=="Stat"){
$date = date("Y-m-d");
$time = date("H:i:s");
}

if($deptx=="OR"){
$pf = $conn->query("select * from orpf where caseno='$caseno' and batchno='$batchno'");
while($pfd = $pf->fetch_assoc()){$doc[] = $pfd['doctor']."||".$pfd['specialization'];}
$doc = json_encode($doc);
$type = $_POST['type'];
}
$conn->query("delete from ORSCHEDULE where caseno='$caseno' and pf='$batchno'");
$conn->query("insert into `ORSCHEDULE`(`patientidno`, `caseno`, `dateofoperation`, `timeofoperation`, `typeofoperation`, `room`, `usages`, `status`, `username`, `branch`, `pf`, `type`, `autono`) 
values ('$patientidno','$caseno','$date','$time','$pro','$deptx','$protype','RESERVED','$user','$branch','$doc','$type', '$autono')");

$conn->query("delete from orpf where caseno='$caseno' and batchno='$batchno'");



$result = $conn->query("select * from ORSCHEDULE where caseno='$caseno' and autono='$autono'");
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

$conn->query("UPDATE ORSCHEDULE SET status='ARRIVED'  WHERE caseno='$caseno' and autono='$autono'");



echo"<script>window.location='?main';</script>";
}
?>
<body onload="loadpro('<?php echo $dept ?>'); checkpf();">
<form name="myform" method="POST">
<div class='card' style='box-shadow: 0px 0px 1px 1px lightgrey;'>
<div class='card-body'>

<table><tr><td><img src='../main/img/male.png' width='40' height='40' style='border-radius: 50%;'></td><td> <?php echo $caseno ?><br><b><?php echo $name ?></b></td></tr></table>
<hr>

<input type="text" name="code" value="<?php echo $caseno ?>" hidden>
<input type="text" name="desc" value="<?php echo $name ?>" hidden>
<table width="100%" border="0">
<tr>
<td>DEPARTMENT:<br>
<select name="dept" id='dept' onchange="loadpro(this.value); checkpf();" class="select2-single" style="width: 100%;">
<option value="<?php echo $dept ?>"><?php echo $dept ?></option>
<option value="OR">OR</option>
<option value="ENDOSCOPY">ENDOSCOPY</option>
<option value="PT">PT</option>
<option value="RT">RT</option>
</select>
</td>
</tr>
<tr>
<td>PROCEDURE:<br>
<select name="pro" id="pro" class="select2-single" style="width: 435px;" required></select>
</td>
</tr>
<tr><td>REMARKS<br><textarea name="remarks" rows="4" cols="50"><?php echo $remarks ?></textarea></td></tr>
<tr>
<td>PROCEDURE TYPE:<br>
<select name="protype" id="protype" class="select2-single" style="width: 435px;" onchange="stat(this.value)" required>
<option value="Schedule" <?php echo $sched ?>>Schedule</optioon>
<option value="Oncall" <?php echo $oncall ?>>Oncall</optioon>
<option value="Stat" <?php echo $stat ?>>Stat</optioon>
</select>
</td>
</tr>

<tr id='stat1'>
<td>Date :<br><input type="date" name="date" value="<?php echo $dateofoperation ?>" style="width: 100%; font-size: 15px;"></td>
</tr>

<tr id='stat2'>
<td>
TIME:
<br>
<select name="hin" style="font-size:15px;">
<option value="<?php echo $hin ?>"><?php echo $hin ?></option>
<?php for($i=1; $i<=12; $i++) { if($i<10) {$i = "0".$i;}?>
<?php if($hh==$i){echo"<option value='$i' selected>$i</option>";}else{echo"<option value='$i'>$i</option>";} ?>
<?php } ?>
</select>
:
<select name="min" style="font-size:15px;">
<option value="<?php echo $min ?>"><?php echo $min ?></option>
<?php for($i=00; $i<=59; $i++) { if($i<10) {$i = "0".$i;}?>
<?php if($mm==$i){echo"<option value='$i' selected>$i</option>";}else{echo"<option value='$i'>$i</option>";} ?>
<option value="<?php echo $i ?>"><?php echo $i ?></option>
<?php } ?>
</select>
<select name="pin" style="font-size:15px;">
<option value="<?php echo $pin ?>"><?php echo $pin ?></option>
<option value="am" <?php echo $am ?>>am</option>
<option value="pm" <?php echo $pm ?>>pm</option>
</select></p>
</td>
</tr>
<tr id='pflist' style='display: none;'><td>

Type of Operation:<br>
<select name="type" class="select2-single" style="width: 100%;">
<option value="MINOR" <?php echo $minor ?>>MINOR OPERATION</option>
<option value="MAJOR" <?php echo $major ?>>MAJOR OPERATION</option>
</select><br><br>

<div class='card' style='box-shadow: 0px 0px 1px 1px lightgrey;'>
<div class='card-body'>
Professional Fee:
<table width='100%'>
<tr>
<td>
<select name='doctor' id="doctor" class='select2-single' style="width: 200px;">
<?php
$sql2x = "SELECT * FROM docfile where status ='ACTIVE' order by name";
$result2x = $conn->query($sql2x);
while($row2x = $result2x->fetch_assoc()) {
$name=$row2x['name'];
$code=$row2x['code'];
echo "<option value='$code'>$name</option>";
}
?>
</select>
</td><td>
<select name="services" id="services" class='select2-single' style="width: 200px;">
<option value'IPD attending'>IPD attending</option>
<option value'ON CALL'>ON CALL</option>
<option value'IPD comanaged'>IPD comanaged</option>
<option value'IPD discharge'>IPD surgeon</option>
<option value'IPD discharge'>IPD co-surgeon</option>
<option value'IPD discharge'>IPD anesthesiologist</option>
<option value'IPD discharge'>IPD co-anesthesiologist</option>
<?php
$sql2xx = "select distinct(proc) as proc from PF_SHARING WHERE tag not like  '%NONE%' order by proc desc";
$result2xx = $conn->query($sql2xx);
while($row2xx = $result2xx->fetch_assoc()) {
$procedure=$row2xx['proc'];
echo "<!--option value='$procedure'>$procedure</option-->";
}
?>
</select>
</td>
</tr>
<tr><td colspan='2' style='text-align: right;'>
<button type='button' class='btn btn-warning' style='padding: 3px; font-size: 10px; color: black; background: #d8ce27;' onclick="dbaction('add', '');"><i class="icofont-doctor-alt"></i> Add Professional Fee</button>
<button type='button' class='btn btn-primary' style='padding: 3px; font-size: 10px; color: white; background: #2d2280;' onclick="dbaction('clear', '');"><i class="icofont-ui-delete"></i> Clear PF List</button>
</td></tr>
</table><hr>

<table width='100%' class='tablex' id="myDiv2">
<?php 
$sqx = $conn->query("select d.name, o.specialization, o.id from orpf o, docfile d where o.doctor=d.code and o.caseno='$caseno' and o.batchno='$batchno' order by o.id asc");
while($res = $sqx->fetch_assoc()){ $id = $res['id'];
echo"<tr>
<td>$res[name]</td>
<td>$res[specialization]</td>
<td style='text-align: center;'><button type='button' class='btn btn-primary' style='padding: 3px; font-size: 10px; color: white; background: #1e7d29;'"; ?> onclick="dbaction('del', '<?php echo $id ?>');" <?php echo"><i class='icofont-trash'></i></button></td>
</tr>";
}
?>
</table>



</div></div><br>
</td></tr>

<tr>
<td><p align="right"><button type="submit" name="btn_submit" class="btn btn-danger btn-sm" style='padding: 3px; font-size: 13px; color: white; background: #a41739;'><i class="icofont-check-circled"></i> Submit Request</button></td>
</tr>
</table>
</div></div>

</form>








<script>
function loadpro(str) {
    var test = "<?php echo $test ?>";
$.get("../nsstation/loadpro.php", {
str:str, test:test
}, function (data, status) {
$("#pro").html(data);
});
}

function checkpf(){
var dept = document.getElementById('dept').value;
var pro = document.getElementById('pro').value;

if(dept=='OR'){document.getElementById('pflist').style.display = 'block';}
else{document.getElementById('pflist').style.display = 'none';}
}

function dbaction(str, str2){
var doctor = document.getElementById('doctor').value;
var services = document.getElementById('services').value;
var caseno = "<?php echo $caseno ?>";
var batchno = "<?php echo $batchno ?>";

$.get("../nsstation/loadpro.php", {str:str, doctor:doctor, services:services, caseno:caseno, str2:str2, batchno:batchno}, function (data) {$('#myDiv2').load(' #myDiv2');});
}


function stat(val){
if(val=="Stat"){
document.getElementById("stat1").style.display="none";
document.getElementById("stat2").style.display="none";
}else if(val=="Oncall"){
document.getElementById("stat1").style.display="";
document.getElementById("stat2").style.display="none";
}else{
document.getElementById("stat1").style.display="";
document.getElementById("stat2").style.display="";  
}  
}
</script>




<?php include "../main/footer.php"; ?>


