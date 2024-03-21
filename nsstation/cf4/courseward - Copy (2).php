<style>
textarea:focus{border: solid 1px red;}
textarea{
resize: none;	
border: none;
border-radius: 10px;
outline: none;
padding: 2px;
font-size: 1em;
color: black;
transition: border 0.5s;
-webkit-transition: border 0.5s;
-moz-transition: border 0.5s;
-o-transition: border 0.5s;
border: solid 1px <?php echo $primarycolor ?>;	
-webkit-box-sizing:border-box;
-moz-box-sizing:border-box;
box-sizing:border-box;
font-size: 12px;	
}
</style>

<?php
$caseno = $_GET['caseno'];
$sql2l = "SELECT * FROM nsauthdoctors where name='$user'";
$result2l = $conn->query($sql2l);
while($row2l = $result2l->fetch_assoc()) {
$code=$row2l['empid'];
}

$sql2l = "SELECT * FROM admission, patientprofile where admission.patientidno=patientprofile.patientidno and caseno='$caseno'";
$result2l = $conn->query($sql2l);
while($row2l = $result2l->fetch_assoc()) {
$lname=$row2l['lastname'];
$fname=$row2l['firstname'];
$mname=$row2l['middlename'];
$ciwbypass=$row2l['lastnamed'];
$pname= $lname.", ".$fname." ".$mname;
}

if(isset($_POST['btnfinal'])){
$sql778m = "Update admission set lastnamed = 'finalized', firstnamed = CONCAT(firstnamed, '\nFinalized by: $user') where caseno='$caseno'";
if ($conn->query($sql778m) === TRUE) {}
echo"<script>alert('Successfully Updated to Finalized!');</script>";

$loc = "index.php?courseward&caseno=$caseno$datax";
echo"<script>window.location='$loc';</script>";
}

if(isset($_POST['btnsave'])){
$caseno11 = $_POST['caseno'];
$user11 = $_POST['user'];
$notes = strtoupper($_POST['notes']);
//$datep = $_POST['datep'];
$notes = addslashes($notes);
$idtran = $_POST['idtran'];

$mm = $_POST['mm'];
$dd = $_POST['dd'];
$yy = $_POST['yy'];
$datep =$yy."-".$mm."-".$dd;
$notes = preg_replace('/\s+/', ' ',$notes);
$notes = preg_replace('/\.{4,}/', '.', $notes);

$pHciCaseNo = "";
$pHciTransNo="";
$sql2l = "SELECT pHciCaseNo, pHciTransNo FROM enlistment WHERE caseno='$caseno11'";
$result2l = $conncf4->query($sql2l);
while($row2l = $result2l->fetch_assoc()) {
$pHciCaseNo=$row2l['pHciCaseNo'];
$pHciTransNo=$row2l['pHciTransNo'];
}

if($_POST['btnsave']=="SAVE"){
$sql778 = "INSERT INTO `courseward` (`pHciCaseNo`, `pHciTransNo`, `pDateAction`, `pDoctorsAction`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('$pHciCaseNo', '$pHciTransNo', '$datep', '$notes', 'U', '', '$caseno11')";
if ($conncf4->query($sql778) === TRUE) {}

// --------------
$sql2lm = "SELECT * from courseward where caseno='$caseno11' and pDoctorsAction='$notes'";
$result2lm = $conncf4->query($sql2lm);
while($row2lm = $result2lm->fetch_assoc()) {
$idcw=$row2lm['no'];
}

$datepp = "Saved: ".$datep;
$userxx = "(Saved by: ".$user." - ".date('Y-m-d H:i:s').")";
$sql778m = "INSERT INTO `courseward_logs`(`trans_id`, `user`, `userid`, `dateaction`, `cw` , `caseno`, `logs`) VALUES ('$idcw', '$user', '$empid', '$datepp', '$notes', '$caseno11', '$userxx')";
if ($conncf4->query($sql778m) === TRUE) {}

echo"<script>alert('Successfully Saved!');</script>";
}

else{
$sql778m = "Update courseward set pDoctorsAction = '$notes', pDateAction = '$datep' where no='$idtran'";
if ($conncf4->query($sql778m) === TRUE) {}

$userxx = "(Edit by: ".$user." - ".date('Y-m-d H:i:s').")";
$sql778m = "Update courseward_logs set cw = '$notes', logs = CONCAT(logs, '\n$userxx') where trans_id='$idtran'";
if ($conncf4->query($sql778m) === TRUE) {}
echo"<script>alert('Successfully Updated!');</script>";
}

$loc = "?courseward&caseno=$caseno11$datax";
echo"<script>window.location='$loc';</script>";
}




if(isset($_POST['btndel'])){
$idno = $_POST['idno'];
$caseno11 = $_POST['caseno'];

$sql2 = "SELECT * FROM courseward where no='$idno'";
$result2 = $conncf4->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$usr=$row2['userposted'];
}

//$upuser = "Posted by: ".$usr."<br> Remove by: ".$user;

$sql778 = "delete from courseward where caseno='$caseno11' and no='$idno'";
if ($conncf4->query($sql778) === TRUE) {}

$userxx = "(delete by: ".$user." - ".date('Y-m-d H:i:s').")";
$sql778m = "Update courseward_logs set cw = '$notes', logs = CONCAT(logs, '\n$userxx') where trans_id='$idno'";
if ($conncf4->query($sql778m) === TRUE) {}

$loc = "?courseward&caseno=$caseno11$datax";
echo"<script>window.location='$loc';</script>";
}



//-------------------------------- FILTER BY DATE ----------------------------------------
$mm = date("m");
$yy3 = date("Y");
$yy4 = $yy3 +5;
$yy = date("Y");
$dd = date("d");
$value = str_pad($mm,2,"0",STR_PAD_LEFT);
$mm1x = date("M", mktime(0, 0, 0, $value, 10));
$datearray = $yy."-".$mm."-".$dd;
// ---------------------------------------------------------------------------------------
?>

<style>
.watermark__inner {
    /* Center the content */
    align-items: center;
    display: flex;
    justify-content: center;


    top: 0;
    left: 0;
    right: 0;
    bottom: 0;


    /* Take full size */
    height: 100%;
    width: 100%;
}

.watermark__body {
    /* Text color */
    /*color: rgba(0, 0, 0, 0.2);*/
    color: red;

    /* Text styles */
    font-size: 1rem;
    font-weight: bold;
    text-transform: uppercase;

    /* Rotate the text */
    transform: rotate(-45deg);

    /* Disable the selection */
    user-select: none;
    padding: 20%;
}


.h5x { color: #d54d7b; font-family: "Great Vibes", cursive; font-size: 25px; font-weight: normal; text-align: center; text-shadow: 0 1px 1px #fff; }
</style>


<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?detail&caseno=<?php echo $caseno ?>">Patient Information</a></li>
<li class="breadcrumb-item"><a href="?courseward&caseno=<?php echo $caseno ?>">CF4 Course in the Ward</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">


<b><i class="bi bi-file-earmark-medical"></i> COURSE IN THE WARD <font size="1">[ <?php echo $caseno." - ".$pname ?> ]</font></b><hr>




<table width="100%">
<tr>
<td valign="TOP" width="35%">



<br>
<form method="POST">
<div class="card">
<div class="card-body">
<div class="d-flex align-items-center justify-content-between mt-5">
<div class="lesson_name">
<div class="project-block light-success-bg">
<i class="icofont-ui-calendar"></i>
</div>
<span class="small text-muted project_name fw-bold"> 
  
<font color="black">
<select id="mm" name="mm" style="height:30px; font-size:10pt; color: black; width: 50px;">
<option value="<?php echo $mm ?>"> <?php echo $mm1x ?> </option>
<?php for($x = 1; $x <= 12; $x++) {
$value = str_pad($x,2,"0",STR_PAD_LEFT);
$monthz = date("M", mktime(0, 0, 0, $value, 10));
echo "<option value='$value'>$monthz</option>";
} ?>
</select> -

<select id="dd" name="dd" style="height:30px; font-size:10pt; color: black; width: 50px;">
<option value="<?php echo $dd ?>"><?php echo $dd ?></option>
<?php for($z=1; $z<32; $z++) { if($z<10){$z = "0".$z;} echo "<option value='$z'>$z</option>"; } ?>
</select> -

<select id="yy" name="yy" style="height:30px; font-size:10pt; color: black; width: 50px;">
<option value="<?php echo $yy ?>"><?php echo $yy ?></option>
<?php for($i=$yy4; $i>$yy; $i--)
{echo "<option value='$i'>$i</option>"; } ?>
<?php for($i=$yy3; $i>=2015; $i--)
{echo "<option value='$i'>$i</option>"; } ?>

</select>

</span>
</div>
</div>

<div class="row g-2 pt-4">

<div class="form-floating">
<textarea class="form-control" placeholder="Address" id="floatingTextarea" name="notes" style="text-transform: uppercase; height: 200px;" maxlength="1500" onkeyup="countChar(this)" required></textarea>
<label for="floatingTextarea"><font color="blue">&#x267F; Enter Doctors Order here......</label>
</div>


</div>
<div class="dividers-block"></div>
<div class="d-flex align-items-center justify-content-between mb-2">
<h4 class="small fw-bold mb-0">Required Number of Charater</h4>
<span class="small light-danger-bg  p-1 rounded"><i class="icofont-ui-clock"></i> <b  id="charNum">1500</b></span>
</div>

<div class="dividers-block"></div>

<table align="right"><tr><td>
<button type="submit" name="btnsave" id="btnsave" value="SAVE" class="btn btn-primary btn-sm"><i class="icofont-save"></i> Save</button>
<button class="btn btn-danger btn-sm" onclick="document.getElementById('tec').value = ''; document.getElementById('btnsave').value = 'SAVE';"><i class="icofont-trash"></i> Clear</button>
<input type="hidden" name="caseno" value="<?php echo $caseno ?>">
<input type="hidden" name="user" value="<?php echo $user ?>">
<input type="hidden" name="idtran" id="idtran">
</td></tr></table>

</div>
</div>
</form>

<?php
if($dept=="DOC-OTHERS"){
if(isset($_POST['btnbypass'])){
$reason = $_POST['reason'];
$sql778 = "update admission set lastnamed='to follow', firstnamed='reason: $reason <br> User: $user' where caseno='$caseno'";
if ($conn->query($sql778) === TRUE) {}
echo"<script>window.history.back();</script>";
}

$sql = "SELECT * FROM admission a, patientprofile p where a.patientidno=p.patientidno and a.caseno='$caseno'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$name=strtoupper($row['lastname'].", ".$row['firstname']." ".$row['middlename']);
$ciwbypass = $row['lastnamed'];
}
if($ciwbypass == "to follow"){$disp = "<b class='blink'><font color='red' size='5%'>Bypass CIW!</font>"; $dis = "disabled";}else{$disp = ""; $dis = "";}

echo"
<hr>
<form method='POST'>
<table width='90%' align='center'>
<tr><td colspan='2' style='text-align: center;'>$disp</td></tr>
<tr>
<td><font color='black'><b>REASON:</b></font></td>
<td>
<select class='form-control' name='reason' style='height:30px; font-size:10pt; color: black;'>
<option value='No Course Ward Available'>No Course in the Ward Available</option>
<option value='No Transcriptionist'>No Transcriptionist</option>
<option value='Both Not Available'>Both are not Available</option>
</select>
</td>
</tr>
<tr><td colspan='2' align='right'><button type='submit' name='btnbypass' class='btn btn-primary' $dis><i class='fa fa-window-restore'></i> Submit [to follow]</button></td></tr>
</table>
</form>
<hr>
";
}

else{
$sql1ss = "select * from courseward where caseno='$caseno'";
$result1ss = $conncf4->query($sql1ss);
$count_courseward = mysqli_num_rows($result1ss);

if($ciwbypass == "to follow"){
if($count_courseward>1){echo"<form method='POST'><p align='center'><button type='submit' class='btn btn-danger' name='btnfinal'>Finalized CIW</button></p></form>";}
}else{echo"<p align='center'><font color='red' size='5'>Already Finalized!</font></p>";}
}
?>


</td><td width="1%"><td>
<td valign="TOP" width="64%">



<div class='card'>
<div class='card-header py-3'><h6 class='mb-0 fw-bold '><font color="#3E8E75"><i class="icofont-patient-file"></i> DOCTORS ORDER/ ACTION</font></h6></div>
<div class='card-body'>

<?php
$i = 0;
$sql = "SELECT * FROM courseward WHERE caseno='$caseno' ORDER BY pDateAction asc";
$result = $conncf4->query($sql);
if(mysqli_num_rows($result)>0){
while($row = $result->fetch_assoc()) {
$pDateAction1= date("M d, Y", strtotime($row['pDateAction']));
$pDateAction = $row['pDateAction'];
$pDoctorsAction=$row['pDoctorsAction'];
$pDoctorsAction2 = addslashes($pDoctorsAction);
$idno=$row['no'];
$i++;
list($yy1, $mm1, $dd1) = explode("-", $pDateAction);

$sql5 = "SELECT * FROM courseward_logs WHERE trans_id='$idno'";
$result5 = $conncf4->query($sql5);
while($row5 = $result5->fetch_assoc()) {
$userdoc = $row5['user'];
}

echo"
<div class='timeline-item ti-danger border-bottom ms-2'>
<div class='d-flex' style='width: 100%;'>
<span class='avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg'>$i</span>
<div class='flex-fill ms-3'>
<div class='mb-1'><strong><font size='2px' color='#5A91DC'>$pDateAction1</font></strong></div>
<span class='d-flex text' style='text-align: justify;'><font size='2px' color='#282B2F'>$pDoctorsAction</font></span>

";?>
<br>
<table align="right">
<tr><td colspan="2" style="font-size: 9px;">Econde by: <b><?php echo $userdoc ?></b></td></tr>  
<tr><td>
<button name="btnedit" title="Edit Entry" class="btn btn-outline-primary btn-sm" onclick="getval('<?php echo $pDoctorsAction2 ?>', '<?php echo $idno ?>', '<?php echo $yy1 ?>', '<?php echo $mm1 ?>', '<?php echo $dd1 ?>'); window.scrollTo(0, 0);"><font size="2"><i class="icofont-edit"></i> Edit Entry</button>
</td>
<td valign="TOP">
<form method="POST">
<button type="submit" title="Remove Entry" name="btndel" onclick="return confirm('Are you sure you want to remove?');" class="btn btn-outline-primary btn-sm"><font size="2"><i class="icofont-trash"></i> Delete Entry</button>
<input type="hidden" name="idno" value="<?php echo $idno ?>">
<input type="hidden" name="caseno" value="<?php echo $caseno ?>">
</form>
</td></tr></table>
<?php echo"


</div>
</div>
</div> <!-- timeline item end  -->
";
} }else{echo"<div class='watermark__inner'><div class='watermark__body h5x'>No Course in<br>the Ward entry..</div></div>";}

?>
</div>
</div>

</td>
</tr>
</table>

</div>
</div>
</div>
</div>
</section>
</main>

<script>
function getval(val, val2, yy1, mm1, dd1){
document.getElementById("floatingTextarea").value = val;
document.getElementById("idtran").value = val2;
document.getElementById("btnsave").value = "UPDATE";

document.getElementById("yy").value = yy1;
document.getElementById("mm").value = mm1;
document.getElementById("dd").value = dd1;
}

function countChar(val) {
  var len = val.value.length;
  if (len > 1500) {
    val.value = val.value.substring(0, 1500);
  } else {
  var x = 1500 - len;
  var y = x;
    $('#charNum').text(y);
  }
};

const textarea = document.getElementById('floatingTextarea');
textarea.addEventListener('keydown', function(event) {
if (event.key === 'Enter') {event.preventDefault();}
});
</script>
