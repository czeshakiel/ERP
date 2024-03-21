<?php
include"../mainpage/class.php";
$isearch = "bandiola";
$dept = "XRAY";
// ----------------------
$chk = 0; $limitx = "limit 10";
if($dept=="xray" or $dept=="XRAY"){$ques = "(po.productsubtype = 'XRAY' OR po.productsubtype='ULTRASOUND' OR po.productsubtype='CT SCAN' OR po.productsubtype='MAMMOGRAPHY')"; $chk = 1; $limitx = "limit 100";}
elseif($dept=="laboratory" or $dept=="LABORATORY"){$ques = "po.productsubtype = 'LABORATORY'"; $chk = 1; $limitx = "limit 100";}
elseif($dept=="rt" or $dept=="RT"){$ques = "(po.productdesc LIKE '%ABG%' or po.productdesc LIKE '%ASTHMA%' or po.productdesc LIKE '%COPD%' or po.productdesc LIKE '%SPIRO%' or po.productdesc LIKE '%SLEEP TEST%')"; $chk = 1; $limitx = "limit 100";}
elseif($dept=="heart" or $dept=="HEART"){$ques = "(po.productdesc LIKE '%ECG%' or po.productdesc LIKE '%ECHO%')"; $chk = 1; $limitx = "limit 100";}
// ----------------------
echo"
<hr>
<table width='100%' align='center'><tr><td>
<table class='table'>
<tr>
<th><font class='font8x'># $opsearch</th>
<th width='25%' valign='bottom'><font class='font8x'>Patient Information</th>
<th width='20%'><font class='font8x'>Generated & <br>Hospital Caseno</th>
<th width='20%'><font class='font8x'>DATE/ TIME & Admitted/<br> Discharged</th>
<th width='20%'><font class='font8x'>REQUEST</th>
<th><font class='font8x'>VIEW</th>
</tr>
";


$i=0;
$sql = "SELECT a.caseno FROM admission a, patientprofile p, productout po where  a.caseno=po.caseno and a.patientidno=p.patientidno";
$result = $conn->query($sql);
$counting = mysqli_num_rows($result);
while($row = $result->fetch_assoc()) {
$caseno = $row['caseno'];
$hcaseno = $row['employerno'];
$patientidno = $row['patientidno'];
$sex = $row['sex'];
$name = strtoupper($row['lastname'].", ".$row['firstname']." ".$row['middlename']);
$si="1";
$col="";
$col1="black";
$blink="";
$status1 =$row['status'];
$i++;

$datedischarged = ""; $timedischarged = "";
$sqlj = "select * from dischargedtable where caseno = '$caseno'";
$resultj = $conn->query($sqlj);
while($rowj = $resultj->fetch_assoc()) {
$datedischarged = $rowj['datedischarged'];
$timedischarged = $rowj['timedischarged'];
}
if($sex=="M"){$ge = "boy"; $sexcol ="blue";}else{$ge = "girl"; $sexcol ="#F309B6";}


if($hcaseno==""){$hcaseno="<font color='red'>---Not Applicable---</font>";}
if($datedischarged==""){$datedischarged="<font color='red'>---Not Dicharged---</font>";}

if($counting>0){
echo"
<tr>
<td bgcolor='$col' style='font-size: 11px;'>$i</td>
<td bgcolor='$col' style='font-size: 11px;'><table><tr><td><img src='../mainpage/img/$ge.png' width='30' height='30' style='border-radius: 50%;'></td><td> $patientidno<br>$name</td></tr></table></td>
<td bgcolor='$col' style='font-size: 11px;'>$caseno<br>$hcaseno</td>
<td bgcolor='$col' style='font-size: 11px;'>$row[dateadmitted] $row[timeadmitted]<br>$datedischarged $timedischarged</td>
<td bgcolor='$col' class='text-center' style='color: red; font-size: 11px;'><---- Not Appicable ----><br><i class='bi bi-clipboard-x'></i></td>
<td style='text-align: center;'>
<a href='index.php?view=$view1&dept=$dept&caseno=$caseno$datax'><button type='button' class='btn btn-xs btn-primary btn-sm'><i class='bi bi-person-bounding-box'></i></button></a>
</td>
</tr>
";
}

}
if($counting<1){echo "<tr><td colspan='7'><h3><font color='black'>No Record Found........</h3></td></tr>";}

echo"</table></tr></td></table><br>";
?>
