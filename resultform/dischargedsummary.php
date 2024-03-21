<?php
include '../main/class.php';
$version = explode(".", phpversion());

if($version[0]=="5"){
//5.4 and above   
require_once '../resultform/dompdf5.4/autoload.inc.php';
}else{
//7.1 and above    
require_once '../resultform/dompdf7.1/autoload.inc.php';
}

$dompdf = new Dompdf\Dompdf();

$caseno=$_GET['caseno'];


$sqlx1 = "SELECT * FROM admission where caseno='$caseno'";
$resultx1 = $conn->query($sqlx1);
while($rowx1 = $resultx1->fetch_assoc()) {
$patientidno=$rowx1['patientidno'];
$initialdiagnosis=$rowx1['initialdiagnosis'];
$finaldiagnosis=$rowx1['finaldiagnosis'];
$employerno=$rowx1['employerno'];
$room=$rowx1['room'];
$membership=$rowx1['membership'];
$hmo=$rowx1['hmo'];
$street=$rowx1['street'];
$barangay=$rowx1['barangay'];
$municipality=$rowx1['municipality'];
$province=$rowx1['province'];
$address2 = $street." ".$barangay." ".$municipality." ".$province;
$branch=$_GET['branch'];
$dateadmitted=date("M d, Y", strtotime($rowx1['dateadmitted']));
$timeadmitted=date("h:i:s A", strtotime($rowx1['timeadmitted']));
$ap=$rowx1['ap'];
$ad=$rowx1['ad'];
$patientcontactno=$rowx1['patientcontactno'];
$policyno=$rowx1['policyno'];
$statusxx=$rowx1['status'];
$resultsxx=$rowx1['result'];
$ward=$rowx1['ward'];
$remarks=$rowx1['remarks'];
if($statusxx=="MGH" or $statusxx=="YELLOW TAG"){$blink="<i class='blink'>";}
else{$blink="";}
$hmomembership=$rowx1['hmomembership'];
if($hmomembership == "hmo-hmo") {$hmomembership = "WITH HMO";}
if($hmomembership == "hmo-company") {$hmomembership = "WITH COMPANY";}
if($hmomembership =="none") {$hmomembership = "NONE";}
if ($membership == "Nonmed-none") {$membership = "NO";}
if ($membership == "phic-med") {$membership = "YES";}
if ($ward == "out") {$ward = "OUTPATIENT";}
if ($ward == "in") {$ward = "INPATIENT";}
}

$sqlx1d = "SELECT * FROM admissionaddinfo where caseno='$caseno'";
$resultx1d = $conn->query($sqlx1d);
while($rowx1d = $resultx1d->fetch_assoc()) {$chiefcomplaints = $rowx1d['chiefcomplaint'];}

if(is_numeric($ap)){
$sqlAp=mysqli_query($conn,"SELECT `name` FROM docfile WHERE code='$ap'");
if(mysqli_num_rows($sqlAp)>0){
$myap=mysqli_fetch_array($sqlAp);
$ap=$myap['name'];
}else{$ap="";}
}

if(is_numeric($ad)){
$sqlAp=mysqli_query($conn,"SELECT `name` FROM docfile WHERE code='$ad'");
if(mysqli_num_rows($sqlAp)>0){
$myap=mysqli_fetch_array($sqlAp);
$ad=$myap['name'];
}else{$ad="";}
}

$cn=explode('-',$caseno);
if($cn[0]=="AR"){
$sqlx2 = "SELECT * FROM nsauthemployees where empid='$patientidno'";
$resultx2 = $conn->query($sqlx2);
if(mysqli_num_rows($resultx2)>0){
while($rowx2 = $resultx2->fetch_assoc()) {
$patientidno=$rowx2['empid'];
$sex=$rowx2['gender'];
if($sex=="F"){$sex="FEMALE"; $avat = "female";}
else{$sex="MALE"; $avat = "male";}
$age=$rowx2['age'];
$birthdate=$rowx2['birthdate'];
$patientname=$rowx2['name'];
$senior=$rowx2['senior'];
}

}else{

mysqli_query($conn,"SET NAMES 'utf8'");
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
$patientname=$rowx2['patientname'];
}
}
}else{
mysqli_query($conn,"SET NAMES 'utf8'");
$sqlx2 = "SELECT * FROM patientprofile where patientidno='$patientidno'";
$resultx2 = $conn->query($sqlx2);
while($rowx2 = $resultx2->fetch_assoc()) {
$patientidno=$rowx2['patientidno'];
$sex=$rowx2['sex'];
if($sex=="F"){$sex="FEMALE"; $avat = "girl";}
else{$sex="MALE"; $avat = "boy";}
$age=$rowx2['age'];
$birthdate=$rowx2['dateofbirth'];
$senior=$rowx2['senior'];
$patientname=$rowx2['patientname'];
}
}


// ------------ get age ------
$now = time();
$your_date = strtotime($birthdate);
$datediff = $now - $your_date;
$age = floor($datediff / (60*60*24*365));

$date1 = new DateTime($birthdate);
$date2 = new DateTime(date("Y-m-d"));
$interval = $date1->diff($date2);
$age =  $interval->y ."y, ".$interval->m."m, ".$interval->d."d";
// ---------------------------

$sqlPatientProfile=mysqli_query($conn,"SELECT * FROM patientprofile WHERE patientidno='$patientidno'");
if(mysqli_num_rows($sqlPatientProfile)>0){
$patientname=mysqli_fetch_array($sqlPatientProfile)['patientname'];
}

$datedischarged="";
$timedischarged="";
$det = $conn->query("select * from dsdetails where caseno='$caseno'");
while($det1=$det->fetch_assoc()){
$datedischarged = $det1['datedischarged'];
$timedischarged = $det1['timedischarged'];
$operationdone = $det1['operationdone'];
$ffon = $det1['ffcheckupon'];
$ffat = $det1['ffat'];
$advicedto = $det1['advise'];
$dischargedby = $det1['dischargedby'];
$preparedby = $det1['preparedby'];
$receivedby = $det1['rod'];
}

$patient=$patientname."_".$caseno;
$resultx3 = $conn->query("SELECT * FROM dischargedtable where caseno='$caseno'");
if(mysqli_num_rows($resultx3)){
while($rowx3 = $resultx3->fetch_assoc()) {
$datedischarged=date("M d, Y", strtotime($rowx3['datearray']));
$timedischarged=date("h:i:s A", strtotime($rowx3['timedischarged']));
}
}


// Define the HTML content
$html = '
<style>
.tablex { 
width: 100%; 
border-collapse: collapse; 
border: 1px solid #070707; 
font-size: 11px;
}

.tablex td, tr { 
border: 1px solid #070707; 
font-size: 11px;
}




.watermark-container {
    position: relative;
}


.watermark-container::after {
content: "";
background-image: url("../resultform/watermark.png");
background-repeat: no-repeat;
background-position: center center;
background-size: 200px 100px;
opacity: 0.2;
position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
z-index: -1;
}



</style>
';

if($statusxx=="discharged"){
$html .= '
<table width="100%"><tr>
<td width="10%"><img src="../resultform/kmsci.png" width="60" height="60"></td>
<td>
<table align="center"><tr>
<td style="text-align: center;"><b>'.$heading.'</b></td>
</tr><tr>
<td style="font-size: 13px; text-align: center;">'.$address.'</td>
</tr></table>
</td>
<td width="10%">&nbsp;</td>
</tr></table>
<br>
';
}else{
$html .= '<h2 align="center"><font color="red">NOT PRINTABLE! FOR PREVIEW PURPOSE ONLY...</font></h2>';
$html .=' <div class="watermark-container">';
}

$html .= '
<table align="center"><tr>
<td style="font-size: 15px; text-align: center;"><b>DISCHARGE SUMMARY<b></td>
</tr></table>

<table width="100%" cellpadding="0" cellspacing="0" class="table" style="font-family:Arial; font-size:12px;" border="0">
<tr>
<td style="font-size: 11px; width: 15%;"></td>
<td style="font-size: 11px; width: 5%;"></td>
<td style="font-size: 11px; width: 48%;"></td>
<td style="font-size: 11px; width: 2%;"></td>
<td style="font-size: 11px; width: 15%;"><b>Caseno</b></td>
<td style="font-size: 11px; width: 5%;">:</td>
<td style="font-size: 11px; width: 15%; border-bottom: 1px solid black;">'.$employerno.'</td>
</tr>
<tr>
<td style="font-size: 11px;"><b>Name</b></td>
<td style="font-size: 11px;">:</td>
<td style="font-size: 11px; border-bottom: 1px solid black;">'.$patientname.'</td>
<td style="font-size: 11px;"></td>
<td style="font-size: 11px;"><b>Time Admitted</b></td>
<td style="font-size: 11px;">:</td>
<td style="font-size: 11px; border-bottom: 1px solid black;">'.$timeadmitted.'</td>
</tr>
<tr>
<td style="font-size: 11px;"><b>Address</b></td>
<td style="font-size: 11px;">:</td>
<td style="font-size: 11px; border-bottom: 1px solid black;">'.strtoupper($address2).'</td>
<td style="font-size: 11px;"></td>
<td style="font-size: 11px;"><b>Time Discharged</b></td>
<td style="font-size: 11px;">:</td>
<td style="font-size: 11px; border-bottom: 1px solid black;">'.$timedischarged.'</td>
</tr>
<tr>
<td style="font-size: 11px;"><b>Attending Physician</b></td>
<td style="font-size: 11px;">:</td>
<td style="font-size: 11px; border-bottom: 1px solid black;">'.strtoupper($ap).'</td>
<td style="font-size: 11px;"></td>
<td style="font-size: 11px;"><b>Date Admitted</b></td>
<td style="font-size: 11px;">:</td>
<td style="font-size: 11px; border-bottom: 1px solid black;">'.$dateadmitted.'</td>
</tr>
<tr>
<td style="font-size: 11px;"><b>Chief Complaints</b></td>
<td style="font-size: 11px;">:</td>
<td style="font-size: 11px; border-bottom: 1px solid black;">'.strtoupper($chiefcomplaints).'</td>
<td style="font-size: 11px;"></td>
<td style="font-size: 11px;"><b>Date Discharged</b></td>
<td style="font-size: 11px;">:</td>
<td style="font-size: 11px; border-bottom: 1px solid black;">'.$datedischarged.'</td>
</tr>
<tr>
<td style="font-size: 11px;"><b>Final Diagnosis</b></td>
<td style="font-size: 11px;">:</td>
<td style="font-size: 11px; border-bottom: 1px solid black;" colspan="8">'.strtoupper($finaldiagnosis).'</td>
</tr>
<tr>
<td style="font-size: 11px;"><b>Operation Done</b></td>
<td style="font-size: 11px;">:</td>
<td style="font-size: 11px; border-bottom: 1px solid black;" colspan="8">'.strtoupper($operationdone).'</td>
</tr>
</table>
';

if(strpos($caseno, 'O-')===false){
$html .= '
<br>
<table align="center"><tr>
<td style="font-size: 15px; text-align: center;"><b>LABORATORY FINDINGS<b></td>
</tr></table>

<table align="center" width="100%" border="1" style="border-collapse: collapse;"><tr><td height="220" valign="TOP">
<table class="tablex">
';
$i=0;
$dd = $conn->query("SELECT * FROM labfindings WHERE caseno='$caseno' ORDER by no");
while($afetch = $dd->fetch_assoc()){
$no=$afetch['no'];
$labfindings=$afetch['labfindings'];
$dateadded=$afetch['dateadded'];
$addedby=$afetch['addedby'];
$i++;

$html .= '<tr><td style="font-size: 11px;">'.$labfindings.'</td></tr>';
}


$html .= '
</table>
</td></tr></table>
';
}

$html .= '
<br>
<table align="center"><tr>
<td style="font-size: 15px; text-align: center;"><b>HOME MEDICATIONS</b></td>
</tr></table>

<table align="center" width="100%" border="1" style="border-collapse: collapse;"><tr><td height="230" valign="TOP">
<table class="tablex">
<tr>
<td style="font-size:11px;" rowspan="2">Generic/Brand</td>
<td style="font-size:11px;" rowspan="2">Dosage</td>
<td style="font-size:11px;" rowspan="2">Frequency</td>
<td style="font-size:11px;" colspan="4" width="20%" style="text-align: center;">Timing</td>
<td style="font-size:11px;" rowspan="2">Duration</td>
</tr>
<tr>
<td style="font-size:11px;">AM</td>
<td style="font-size:11px;">NN</td>
<td style="font-size:11px;">PM</td>
<td style="font-size:11px;">MN</td>
</tr>
';
$i=0;
$dd = $conn->query("SELECT po.refno, po.productdesc, po.quantity, h.dosage, h.frequency, h.tam, h.tnn, h.tpm, h.tmn, h.duration, h.no FROM 
productouthm po, homemeds h WHERE po.caseno=h.caseno and po.productcode=h.code and h.caseno='$caseno' group by h.code, h.batchno ORDER by h.no");
while($afetch = $dd->fetch_assoc()){
$no=$afetch['no'];
$refno=$afetch['refno'];
$productdesc=$afetch['productdesc'];
$quantity=$afetch['quantity'];
$dosage=$afetch['dosage'];
$frequency=$afetch['frequency'];
$tam=$afetch['tam'];
$tnn=$afetch['tnn'];
$tpm=$afetch['tpm'];
$tmn=$afetch['tmn'];
$duration=$afetch['duration'];
$i++;

$html .= '
<tr>
<td style="font-size:11px;">'.$productdesc.'</td>
<td style="font-size:11px;">'.$dosage.'</td>
<td style="font-size:11px;">'.$frequency.'</td>
<td style="font-size:11px;">'.$tam.'</td>
<td style="font-size:11px;">'.$tnn.'</td>
<td style="font-size:11px;">'.$tpm.'</td>
<td style="font-size:11px;">'.$tmn.'</td>
<td style="font-size:11px;">'.$duration.'</td>
</tr>
';

}


$html .= '
</table>
</td></tr></table>

<table width="100%">
<tr>
<td style="font-size: 11px; width:20%;"><b>Follow up check-up on</b></td>
<td style="font-size: 11px; width:5%;">:</td>
<td style="font-size: 11px; border-bottom: 1px solid black;">'.$ffon.'</td>
</tr>
<tr>
<td style="font-size: 11px; width:20%;"><b>At</b></td>
<td style="font-size: 11px; width:5%;">:</td>
<td style="font-size: 11px; border-bottom: 1px solid black;">'.$ffat.'</td>
</tr>
<tr>
<td style="font-size: 11px; width:20%;" valign="TOP"><b>Advised to</b></td>
<td style="font-size: 11px; width:5%;" valign="TOP">:</td>
<td style="font-size: 11px;">
<table width="100%" border="1" style="border-collapse: collapse;">
<tr><td height="50" valign="TOP">'.$advicedto.'</td></tr>
</table>
</td>
</tr>
</table>


<br>
<table width="100%">
<tr>
<td style="width:5%;">Prepared By</td>
<td style="width:3%;">:</td>
<td style="width:22%; border-bottom: 1px solid black;">'.$preparedby.'</td>
<td></td>
<td style="width:5%;">Recieved By</td>
<td style="width:3%;">:</td>
<td style="width:22%; border-bottom: 1px solid black;">'.$receivedby.'</td>
<td></td>
<td style="width:5%;">Discharged By</td>
<td style="width:3%;">:</td>
<td style="width:22%; border-bottom: 1px solid black;">'.$dischargedby.'</td>
</tr></table>

<br>
<table align="center"><tr>
<td style="font-size: 16px; text-align: center;"><b>NOTICE: Please bring this summary during your follow up check-up. Thank you!</b></td>
</tr></table>

</div>
';


// Load the HTML into the renderer
$dompdf->loadHtml($html);

// Set the paper size and orientation
//$dompdf->setPaper('A4', 'portrait');
//$dompdf->setPaper([0,0,612,1008], 'portrait');
$dompdf->setPaper([0, 0, 612, 936], 'portrait');

// Render the PDF
$dompdf->render();


// Output the generated PDF to the browser
$dompdf->stream('Discharged Sumarry.pdf', array('Attachment' => false));
?>