<?php
$isearch=$_GET['str'];
$actionadmit=$_GET['actionadmit'];
include "../main/class.php";
include "../main/header.php";
$chk = 0;
$counting1 = 0;
if($isearch == ""){$vload = "SELECT * FROM patientprofile order by lastname limit 0"; $counting1="1";}
else{$vload = "SELECT * FROM patientprofile p, admission a where p.patientidno=a.patientidno and (a.employerno like '$isearch%' OR p.lastname like '$isearch%' OR p.firstname like '$isearch%' OR concat(p.lastname,' ',p.firstname,' ',p.middlename) like '%$isearch%' OR concat(p.lastname,', ',p.firstname,' ',p.middlename) like '%$isearch%') group by p.patientidno order by p.lastname limit 10";}

echo"
<hr>
<table width='100%' align='center'><tr><td>
<table class='table' border='1'>
<tr>
<th width='50%'><font class='font8x'>Patient Information</th>
<th width='30%'><font class='font8x'>Birthdate/ Age</th>
<th class='text-center' width='10%'><font class='font8x'>GENDER</th>
<th class='text-center'>Action</th>
</tr>
";


$sql = "$vload";
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
$bdate2 = date("M d, Y", strtotime($bdate));
if($suffix!=""){$suffix = "($suffix)";}

// ------------ get age ------
$now = time();
$your_date = strtotime($bdate);
$datediff = $now - $your_date;
$age = floor($datediff / (60*60*24*365));
// ---------------------------

if($senior == "Y"){if($age>=60){$senior = "SENIOR";}else{$senior = "PWD";}}
elseif($senior == "N"){$senior = "NO";}
else{$senior = "<i class='blink'><font color='red'>UNDIFINED</font></i>";}


if($gender == "M" or $gender == "m"){$gender = "<font color='blue'><i class='icofont-business-man-alt-2'></i></font>";}
else{$gender = "<font color='#f61399'><i class='icofont-girl-alt'></i></font>";}


echo"
<tr>
<td style='font-size: 12px;'><font color='gray'><i class='icofont-id'></i> HRN:</font> $patientidno<br><font color='gray'><i class='icofont-user-alt-3'></i> NAME:</font> <b>$lname, $fname $mname $suffix</b></td>
<td style='font-size: 12px;'><font color='gray'><i class='icofont-ui-calendar'></i> DOB:</font> $bdate2<br><font color='gray'><i class='icofont-tack-pin'></i> AGE:</font> $age yr/s old</td>
<td bgcolor='$col' class='text-center'><font color='black' size='5'>$gender</td>
<td style='text-align: center;'>
<a href='../doctorslog/patientlistdetail.php?patientidno=$patientidno' target='tabiframe'><button "; ?> onclick="reloadIncludeFile('<?php echo $patientidno ?>');" <?php echo" class='btn btn-danger btn-sm' style='background: #5d344f; color: white;'><i class='icofont-eye'></i></button></a>
</td>
</tr>
";
} 

if($counting==0){

if($counting1=="0"){
echo "
<tr>
<td colspan='9'><h3><font color='black'>No Record Found........</h3></td>
</tr>
";
}else{
echo "
<tr>
<td colspan='9'><h3><font color='black'></h3></td>
</tr>
";    
}
}
echo"</table></tr></td></table><br>";
?>
