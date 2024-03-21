<?php
$isearch=$_GET['str'];
$dfrom=$_GET['dfrom'];
$dto=$_GET['dto'];
$options=$_GET['options'];
$opsearch=$_GET['opsearch'];

if($isearch==""){echo"";}else{
include "../main/class.php";
include "../main/header.php";
// ----------------------
$chk = 0; $limitx = "limit 10";
if($dept=="xray" or $dept=="XRAY"){$ques = "and (po.productsubtype = 'XRAY' OR po.productsubtype='ULTRASOUND' OR po.productsubtype='CT SCAN' OR po.productsubtype='MAMMOGRAPHY')"; $chk = 1; $limitx = "limit 100";}
elseif($dept=="laboratory" or $dept=="LABORATORY"){$ques = "and po.productsubtype = 'LABORATORY'"; $chk = 1; $limitx = "limit 100";}
elseif($dept=="rt" or $dept=="RT"){$ques = "and (po.productdesc LIKE '%ABG%' or po.productdesc LIKE '%ASTHMA%' or po.productdesc LIKE '%COPD%' or po.productdesc LIKE '%SPIRO%' or po.productdesc LIKE '%SLEEP TEST%') and po.productsubtype not like '%SUPPLIES%'"; $chk = 1; $limitx = "limit 100";}
elseif($dept=="heart" or $dept=="HEART"){$ques = "and (po.productdesc LIKE '%ECG%' or po.productdesc LIKE '%ECHO%' or po.productdesc like '%STRESS TEST%')"; $chk = 1; $limitx = "limit 100";}
// ----------------------

if($options=="all"){$disp = "";}
elseif($options=="ipd"){$disp = " and a.caseno like 'I-%%'";}
elseif($options=="opd"){$disp = " and a.caseno like 'O-%%'";}
elseif($options=="walkin"){$disp = " and a.caseno like 'W%%'";}
elseif($options=="rdu"){$disp = " and a.caseno like 'R%%'";}
elseif($options=="ar"){$disp = " and a.caseno like 'AR%%'";}
elseif($options=="discharged"){$disp = " and a.ward = 'discharged'";}

if($opsearch=="profile"){
echo"
<hr>
<table width='100%' align='center'><tr><td>
<table class='table'>
<tr>
<th width='30%' valign='bottom'><font class='font8x'>Patient Information</th>
<th width='20%'><font class='font8x'>Generated & <br>Hospital Caseno</th>
<th width='20%'><font class='font8x'>DATE/ TIME & Admitted/<br> Discharged</th>
<th width='20%'><font class='font8x'>NO. OF REQUEST</th>
<th><font class='font8x'>VIEW</th>
</tr>
";


$space = ", ";
$i=0;
$sql = "SELECT * FROM admission a, patientprofile p where a.patientidno=p.patientidno and (p.lastname like '$isearch%' OR p.firstname like '$isearch%' OR concat(p.lastname,' ',p.firstname,' ',p.middlename) like '%$isearch%' OR concat(p.lastname,', ',p.firstname,' ',p.middlename) like '%$isearch%' OR a.caseno='$isearch') and a.dateadmit between '$dfrom' and '$dto' $disp order by p.lastname ASC, p.firstname ASC, a.dateadmit DESC $limitx";
$result = $conn->query($sql);
$counting = mysqli_num_rows($result);
while($row = $result->fetch_assoc()){
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

$resultjc = $conn->query("select * from productout po where po.caseno = '$caseno' $ques");
$countc = mysqli_num_rows($resultjc);

if($dept=="XRAY"){$view1="xrayresults";}
elseif($dept=="laboratory"){$view1="labresults";}
elseif($dept=="RT"){$view1="rtresults";}
elseif($dept=="HEART"){$view1="details";}
else{$view1="detail";}


if($hcaseno==""){$hcaseno="<font color='red'>---Not Applicable---</font>";}
if($datedischarged==""){$datedischarged="<font color='red'>---Not Dicharged---</font>";}
if($chk==1){
if($countc>0){
echo"
<tr>
<td bgcolor='$col' style='font-size: 11px;'><table><tr><td><img src='../main/img/$ge.png' width='30' height='30' style='border-radius: 50%;'></td><td> $patientidno<br>$name</td></tr></table></td>
<td bgcolor='$col' style='font-size: 11px;'>$caseno<br>$hcaseno</td>
<td bgcolor='$col' style='font-size: 11px;'>$row[dateadmitted] $row[timeadmitted]<br>$datedischarged $timedischarged</td>
<td bgcolor='$col' class='text-center'>$blink<font color='$col1' size='2'>";if($countc>0){echo"<span class='badge bg-danger'><i class='bi bi-star me-1'></i> $countc request for  $dept.</span>";}echo"</td>
<td style='text-align: center;'>
<a href='?$view1&dept=$dept&caseno=$caseno$datax'><button type='button' class='btn btn-xs btn-primary btn-sm'><i class='icofont-waiter'></i></button></a>
</td>
</tr>
";
}
}else{
echo"
<tr>
<td bgcolor='$col' style='font-size: 11px;'><table><tr><td><img src='../main/img/$ge.png' width='30' height='30' style='border-radius: 50%;'></td><td> $patientidno<br>$name</td></tr></table></td>
<td bgcolor='$col' style='font-size: 11px;'>$caseno<br>$hcaseno</td>
<td bgcolor='$col' style='font-size: 11px;'>$row[dateadmitted] $row[timeadmitted]<br>$datedischarged $timedischarged</td>
<td bgcolor='$col' class='text-center' style='color: red; font-size: 11px;'><---- Not Appicable ----><br><i class='bi bi-clipboard-x'></i></td>
<td style='text-align: center;'>
<a href='?$view1&dept=$dept&caseno=$caseno$datax'><button type='button' class='btn btn-xs btn-primary btn-sm'><i class='icofont-waiter'></i></button></a>
</td>
</tr>
";
}


} 

if($counting<1){
echo "
<tr>
<td colspan='7'><h3><font color='black'>No Record Found........</h3></td>
</tr>
";
}
echo"</table></tr></td></table><br>";
}else{include "../nsstation/searcharchivesdetailfetch.php";}

}
?>
