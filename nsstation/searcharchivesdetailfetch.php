<?php
echo"
<hr>
<table width='100%' align='center'><tr><td>
<table class='table'>
<tr>
<th width='30%' valign='bottom'><font class='font8x'>Patient Information</th>
<th width='20%'><font class='font8x'>Generated & <br>Hospital Caseno</th>
<th width='20%'><font class='font8x'>DATE/ TIME & Admitted/<br> Discharged</th>
<th width='20%'><font class='font8x'>Date/Time Request<br>Procedure Request</th>
<th><font class='font8x'>VIEW</th>
</tr>
";


$i=0;
$sql = "SELECT * FROM admission a, patientprofile p, productout po where a.patientidno=p.patientidno and a.caseno=po.caseno and (p.lastname like '$isearch%' OR p.firstname like '$isearch%' OR concat(p.lastname,' ',p.firstname,' ',p.middlename) like '%$isearch%' OR concat(p.lastname,', ',p.firstname,' ',p.middlename) like '%$isearch%' OR a.caseno='$isearch') and a.dateadmit between '$dfrom' and '$dto' $disp $ques order by p.lastname ASC, p.firstname ASC, a.dateadmit DESC $limitx";
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
$productdesc =$row['productdesc'];
$dtreq =$row['datearray']." ".$row['invno'];
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
<td bgcolor='$col' style='font-size: 11px;'><table><tr><td><img src='../main/img/$ge.png' width='30' height='30' style='border-radius: 50%;'></td><td> $patientidno<br>$name</td></tr></table></td>
<td bgcolor='$col' style='font-size: 11px;'>$caseno<br>$hcaseno</td>
<td bgcolor='$col' style='font-size: 11px;'>$row[dateadmitted] $row[timeadmitted]<br>$datedischarged $timedischarged</td>
<td bgcolor='$col' class='text-center' style='color: red; font-size: 11px;'>$productdesc<br><i class='bi bi-clipboard-x'></i> $dtreq</td>
<td style='text-align: center;'>
<a href='?details&dept=$dept&caseno=$caseno$datax'><button type='button' class='btn btn-xs btn-danger btn-sm'><i class='icofont-waiter'></i></button></a>
</td>
</tr>
";
}

}
if($counting<1){echo "<tr><td colspan='7'><h3><font color='black'>No Record Found........</h3></td></tr>";}

echo"</table></tr></td></table><br>";
?>
