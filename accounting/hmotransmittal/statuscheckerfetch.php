<?php
$isearch=$_GET['str'];
include "../../main/class.php";
include "../../main/header.php";
$chk = 0;
$counting1 = 0;

if($isearch == ""){}
else{
echo"
<form method='POST'>

<table width='100%' align='center'><tr><td>
<table class='tablex'>
<tr>
<th></th>
<th width='30%'><font class='font8x'>Patient Information</th>
<th width='30%'><font class='font8x'>Date Time Admitted/ Physician</th>
<th class='text-center' width='0%'><font class='font8x'>HMO/ Date Discharged</th>
<th class='text-center'>Action</th>
</tr>
";

$tamount = 0; $ckpen = 0;
$sql = "SELECT p.*, a.* FROM patientprofile p, admission a where p.patientidno=a.patientidno and (p.lastname like '$isearch%' OR p.firstname like '$isearch%' 
OR concat(p.lastname,' ',p.firstname,' ',p.middlename) like '%$isearch%' OR concat(p.lastname,', ',p.firstname,' ',p.middlename) like '%$isearch%') and
a.hmomembership='hmo-hmo' order by p.lastname limit 10";
$result = $conn->query($sql);
$counting = mysqli_num_rows($result);
while($row = $result->fetch_assoc()) {
    $patientidno = $row['patientidno'];
    $caseno = $row['caseno'];
    $lname = $row['lastname'];
    $fname = $row['firstname'];
    $mname = $row['middlename'];
    $name = $lname.", ".$fname." ".$mname;
    $suffix =$row['suffix'];
    $bdate =$row['dateofbirth'];
    $gender =$row['sex'];
    $senior =$row['senior'];
    $ap =$row['ap'];
    $hmo =$row['hmo'];
    $bdate2 = date("M d, Y", strtotime($bdate));
    $dateadmit = date("M d, Y", strtotime($row['dateadmit']))." ".date("h:i:s a", strtotime($row['timeadmitted']));
    if($suffix!=""){$suffix = "($suffix)";}


    if(is_numeric($ap)){
        $sqlAp=mysqli_query($conn,"SELECT `name` FROM docfile WHERE code='$ap'");
        if(mysqli_num_rows($sqlAp)>0){
        $myap=mysqli_fetch_array($sqlAp);
        $ap=$myap['name'];
        }else{$ap="";}
        }

echo"
<tr>
<td style='font-size: 11px; text-align: center;'>$ckbox</td>
<td style='font-size: 12px;'><font color='gray'><i class='icofont-id'></i> Caseno:</font> $caseno<br><font color='gray'><i class='icofont-user-alt-3'></i> NAME:</font> <b>$name</b></td>
<td style='font-size: 12px;'><font color='gray'><i class='icofont-clip-board'></i> Date/ Time Admitted:</font> $dateadmit<br><font color='gray'><i class='icofont-law-document'></i> Physician:</font> <b>$ap</b></td>
<td style='font-size: 12px;'><font color='gray'><i class='icofont-peso'></i> HMO:</font> $hmo<br><font color='gray'><i class='icofont-sale-discount'></i> Date Discharged:</font> $disc</td>
<td style='font-size: 12px;'><font color='gray'><i class='icofont-ui-calendar'></i> Status:</font> $sstat</td>
</tr>
";
} 
$tamount2 = number_format($tamount, 2);
echo"
<tr id='idtotal'>
<td colspan='3' style='text-align: right;'><b>TOTAL:&nbsp;</b></td>
<td colspan='2'><b><i class='icofont-peso'></i> $tamount2</b></td>
</tr>
";

if($counting==0){
echo"<script>document.getElementById('idtotal').style.display='none';</script>";
if($counting1=="0"){
echo "
<tr>
<td colspan='9'><h3><font color='black'>No Data Found........</h3></td>
</tr>

<script>
document.getElementById('idrefund').style.display='none';
document.getElementById('idcancel').style.display='none';
document.getElementById('idprint').style.display='none';
</script>
";
}else{
echo "
<tr>
<td colspan='9'><h3><font color='black'></h3></td>
</tr>
";    
}
}
echo"</table></tr></td></table><br></form>";

}
?>