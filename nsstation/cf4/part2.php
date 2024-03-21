<style>
.ribbon-2 {
  --f: 10px; /* control the folded part*/
  --r: 15px; /* control the ribbon shape */
  --t: 10px; /* the top offset */
  
  position: absolute;
  inset: var(--t) calc(-1*var(--f)) auto auto;
  padding: 0 30px var(--f) calc(30px + var(--r));
  clip-path: 
    polygon(0 0,100% 0,100% calc(100% - var(--f)),calc(100% - var(--f)) 100%,
      calc(100% - var(--f)) calc(100% - var(--f)),0 calc(100% - var(--f)),
      var(--r) calc(50% - var(--f)/2));
  background: #BD1550;
  box-shadow: 0 calc(-1*var(--f)) 0 inset #0005;
  color: white;
  font-size: 18px;
}
</style>

<?php
$sqlx1 = "SELECT * FROM admission where caseno='$caseno'";
$resultx1 = $conn->query($sqlx1);
while($rowx1 = $resultx1->fetch_assoc()) {
$patientidno=$rowx1['patientidno'];
}

$sqlx2 = "SELECT * FROM patientprofile where patientidno='$patientidno'";
$resultx2 = $conn->query($sqlx2);
while($rowx2 = $resultx2->fetch_assoc()) {
$patientidno=$rowx2['patientidno'];
$sex=$rowx2['sex'];
if($sex=="F"){$sex="FEMALE"; $avat = "female";}
else{$sex="MALE"; $avat = "male";}
$age=$rowx2['age'];
$birthdate=$rowx2['dateofbirth'];
$senior=$rowx2['senior'];
$lastname=$rowx2['lastname'];
$firstname=$rowx2['firstname'];
$middlename=$rowx2['middlename'];
$suffix=$rowx2['suffix'];
$ptype=strtoupper($rowx2["paymentmode"]);
$namearray = "$lastname".",  "."$firstname"."  "."$middlename";
}

/*
$sqlx3 = "SELECT pHospitalTransmittalNo FROM hcode WHERE caseno='$caseno'";
$resultx3 = $conn_ett->query($sqlx3);
while($rowx3 = $resultx3->fetch_assoc()) {
$pHospitalTransmittalNo=$rowx3['pHospitalTransmittalNo'];
}

*/

$sqlx4 = "SELECT identificationno FROM claiminfo WHERE caseno='$caseno'";
$resultx4 = $conn->query($sqlx4);
while($rowx4 = $resultx4->fetch_assoc()) {
$pin=$rowx4['identificationno'];
}

/*1. PhilHealth Identification Number (PIN) of Member: */
$phicofmember = $pin; //Place value of PHIC Number of member from the DB here.

if(strlen($phicofmember)==14){
$phicmember = str_split($phicofmember);

$phicmember0 = $phicmember[0];
$phicmember1 = $phicmember[1];
$phicmember3 = $phicmember[3];
$phicmember4 = $phicmember[4];
$phicmember5 = $phicmember[5];
$phicmember6 = $phicmember[6];
$phicmember7 = $phicmember[7];
$phicmember8 = $phicmember[8];
$phicmember9 = $phicmember[9];
$phicmember10 = $phicmember[10];
$phicmember11 = $phicmember[11];
$phicmember13 = $phicmember[13];

}
else if(strlen($phicofmember)==12){
$phicmember = str_split($phicofmember);

$phicmember0 = $phicmember[0];
$phicmember1 = $phicmember[1];
$phicmember3 = $phicmember[2];
$phicmember4 = $phicmember[3];
$phicmember5 = $phicmember[4];
$phicmember6 = $phicmember[5];
$phicmember7 = $phicmember[6];
$phicmember8 = $phicmember[7];
$phicmember9 = $phicmember[8];
$phicmember10 = $phicmember[9];
$phicmember11 = $phicmember[10];
$phicmember13 = $phicmember[11];
}
else{
$phicmember0 = "";
$phicmember1 = "";
$phicmember3 = "";
$phicmember4 = "";
$phicmember5 = "";
$phicmember6 = "";
$phicmember7 = "";
$phicmember8 = "";
$phicmember9 = "";
$phicmember10 = "";
$phicmember11 = "";
$phicmember13 = "";
}

$pinrel=$phicmember0.$phicmember1.$phicmember3.$phicmember4.$phicmember5.$phicmember6.$phicmember7.$phicmember8.$phicmember9.$phicmember10.$phicmember11.$phicmember13;
/*------------------------------------------------------*/

$sqlx5 = "SELECT pCivilStatus FROM enlistment WHERE caseno='$caseno'";
$resultx5 = $conncf4->query($sqlx5);
while($rowx5 = $resultx5->fetch_assoc()) {
$cvsrel=$rowx5['pCivilStatus'];

if($cvsrel=="S"){$cvs="SINGLE";}
else if($cvsrel=="M"){$cvs="MARRIED";}
else if($cvsrel=="W"){$cvs="WIDOWED";}
else if($cvsrel=="X"){$cvs="SEPARATED";}
else if($cvsrel=="A"){$cvs="ANNULED";}
else{$cvs="SINGLE";}
}


if(isset($_POST['btnsave'])){
$countsymp=$_POST['countsymp'];
$symptomother=$_POST['symptomother'];
$txtpain=$_POST['txtpain'];
$txtother=$_POST['txtother'];

for($i=1; $i<=$countsymp; $i++){
$symptom=$_POST['symptom'.$i];
if($symptom!=""){$symptom1 = $symptom1.$symptom;}
}
if($symptomother!=""){$symptom1 = $symptom1.$symptomother;}

if($symptom1==""){echo"<script>alert('Please select atleast 1!'); window.history.back();</script>"; exit;}

$checksub = $conncf4->query("select * from subjective where caseno='$caseno'");
$ifexist= mysqli_num_rows($checksub);

if($ifexist>0){
$conncf4->query("Update subjective set pSignsSymptoms='$symptom1', pPainSite='$txtpain', pOtherComplaint='$txtother' where caseno='$caseno'");
//echo"<script>alert('Update Entries!');</script>";
}
else{
$conncf4->query("INSERT INTO `subjective`(`pChiefComplaint`, `pIllnessHistory`, `pOtherComplaint`, `pSignsSymptoms`, `pPainSite`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '$txtother', '$symptom1', '$txtpain', 'U', '', '$caseno')");
//echo"<script>alert('Save Entries!');</script>";
}

echo"
<script type='text/javascript'>
swal({
icon: 'success',
title: 'Update Entries!',
text: 'PERTINENT SIGNS & SYMPTOMS ON ADMISSION',
type: 'error',
button: false
});
setTimeout(function(){window.location.href = '?part3&caseno=$caseno$datax';}, 2000);
</script>";

//echo"<script>window.location='index.php?part3&caseno=$caseno$datax';</script>";
}
?>

<body onload="loadtxt();">
<form method="POST">



<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?detail&caseno=<?php echo $caseno ?>">Patient Information</a></li>
<li class="breadcrumb-item"><a href="?otherinfo&caseno=<?php echo $caseno ?>">CF4 Additional Information</a></li>
<li class="breadcrumb-item"><a href="?part2&caseno=<?php echo $caseno ?>">Pertinent Sign & Symptoms on Admission</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<p><b><i class="bi bi-file-earmark-medical"></i> CF4 PART 2 <font size="1">[ <?php echo $caseno." - ".$namearray ?> ]</font></b></p><hr>


<?php
echo"
<table width='100%'><tr><td width='70%' valign='TOP'>
";
// ---------------------------> HEENT <-----------------------------
echo"
<div class='card' style='box-shadow: 0px 0px 1px 1px lightgrey;'>
<div class='ribbon-2'>PERTINENT SIGNS & SYMPTOMS ON ADMISSION</div>
<div class='card-body'>&nbsp;<hr>
<table width='95%' align='center'><tr>
";
$i=1;
$x = 0;
$sql2 = "SELECT * FROM tsekap_lib_symptoms  WHERE LIB_STAT = '1' AND SYMPTOMS_ID NOT IN('X') ORDER BY SYMPTOMS_DESC ASC";
$result2 = $connepcb->query($sql2);
while($row2 = $result2->fetch_assoc()) { 
$SYMPTOMS_ID=$row2["SYMPTOMS_ID"];
$SYMPTOMS_DESC=$row2["SYMPTOMS_DESC"];
if($SYMPTOMS_DESC=="PAIN"){$col='blue';}else{$col='';}
$SYMPTOMS_ID2 = $SYMPTOMS_ID.";";
$x++;

$subj = $conncf4->query("select * from subjective where caseno='$caseno'");
while($myrow = $subj->fetch_assoc()){
$symp = explode(";", $myrow['pSignsSymptoms']);
$pPainSite = $myrow['pPainSite'];
$pOtherComplaint = $myrow['pOtherComplaint'];
}
$countsymp = count($symp);

$c=0;
for($d=0; $d<=$countsymp; $d++){
if($SYMPTOMS_ID == $symp[$d]){$c++;}
}

if($c>0){$checked="checked";}else{$checked="";}
if($pOtherComplaint != ""){$checked2="checked";}else{$checked2="";}

echo"<td width='37%' valign='TOP' style='font-size: 12px; color: $col; padding: 3px;'><input type='checkbox' style='transform : scale(1.4);' name='symptom$x' value='$SYMPTOMS_ID2' id='ch_$SYMPTOMS_DESC' onclick='loadtxt()' $checked>&nbsp;&nbsp; $SYMPTOMS_DESC"; if($SYMPTOMS_DESC=="PAIN"){echo"<textarea placeholder=' &#x1F449; Please input the site of Pain here..' rows='3' name='txtpain' id='txtpain' onkeydown='if(event.keyCode == 13){return false;}' style='display: none; color: black; width: 100%;'>$pPainSite</textarea>";} echo"</td>";
if($i<3){$i++; if($SYMPTOMS_DESC=="WEIGHT LOSS"){echo"<td style='font-size: 11px;'><font color='blue'><input type='checkbox' style='transform : scale(1.2);' name='symptomother' value='X;' id='ch_others' onclick='loadtxt()' $checked2> OTHERS<br> <textarea placeholder=' &#x1F449; If Others, Please Specify..' rows='3' name='txtother' id='txtother' onkeydown='if(event.keyCode == 13){return false;}' style='display: none; color: black; width: 100%;'>$pOtherComplaint</textarea> </td>";} }else{echo"</tr>"; $i=1;}

}
echo"</table><br></div></div>";

// ------------------------> END HEENT <-----------------------------
echo"
<input type='hidden' name='countsymp' value='$x'>


<hr><p align='right'><button class='btn btn-primary btn-sm' name='btnsave'> NEXT <i class='icofont-arrow-right'></i></button></p>
</td></tr></table></form>

";
?>


</div>
</div>
</div>
</div>
</section>
</main>

<script>
function loadtxt(){
if(document.getElementById("ch_PAIN").checked == true){
document.getElementById("txtpain").disabled = false;
document.getElementById("txtpain").required = true;
document.getElementById("txtpain").focus();
document.getElementById("txtpain").style.backgroundColor = "lightyellow";
document.getElementById("txtpain").style.display = "block";
}else{
document.getElementById("txtpain").disabled = true;
document.getElementById("txtpain").required = false;
document.getElementById("txtpain").style.backgroundColor = "";
document.getElementById("txtpain").style.display = "none";
}

if(document.getElementById("ch_others").checked == true){
document.getElementById("txtother").disabled = false;
document.getElementById("txtother").required = true;
document.getElementById("txtother").focus();
document.getElementById("txtother").style.backgroundColor = "lightyellow";
document.getElementById("txtother").style.display = "block";
}else{
document.getElementById("txtother").disabled = true;
document.getElementById("txtother").required = false;
document.getElementById("txtother").style.backgroundColor = "";
document.getElementById("txtother").style.display = "none";
}
}
</script>
