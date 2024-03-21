<?php
error_reporting(1);
include "../../main/class.php";

$batchno = $_GET['batchno'];
$vdate = date("Y-m-d");
?>

<style>
.A4 {
background: white;
font-family: Tahoma;
width: 21.59cm;
height: 33.02cm;
display: block;
margin: 0 auto;
padding: 10px 25px;
margin-bottom: 0.5cm;
}

@media print {
@page {
size: 8.5in 13in;
size: portrait;
}
}
</style>

<div width='730' align='center' class='A4'>
<div class='header'>
<table width="100%"><tr>
<td width="10%"><img src="../../resultform/kmsci.png" width="50" height="50"></td>
<td>
<table align="center"><tr>
<td style="text-align: center;"><b><?php echo $heading ?></b></td>
</tr><tr>
<td style="font-size: 13px; text-align: center;"><?php echo $address ?></td>
</tr></table>
</td>
<td width="10%">&nbsp;</td>
</tr></table>
<br>

<table align="center"><tr>
<td style="font-size: 13px; text-align: center;"><h4 align="center"><u>TRASMITTAL LETTER</u><br><?php echo $vdate ?><br>DEPARTMENT OF SOCIAL WELFARE & DEVELOPMENT<br><br>HOSPITAL ASSISTANCE PROGRAM</h4></td>
</tr></table><hr>



<table align="center" width="100%" border="1" style="border-collapse: collapse;">
<tr>
<td style="text-align: center; font-size: 12px; width: 5%;"><b>NO.</b></td>
<td style="text-align: center; font-size: 12px; width: 30%;"><b>Name of Patient</b></td>
<td style="text-align: center; font-size: 12px; width: 10%;"><b>Confinement</b></td>
<td style="text-align: center; font-size: 12px; width: 10%;"><b>GL Date</b></td>
<td style="text-align: center; font-size: 12px; width: 10%;"><b>Amount</b></td>
<td style="text-align: center; font-size: 12px; width: 35%;"><b>Address</b></td>
</tr>


<?php
$i = 0;
$sql4 = "select p.patientname, a.policyno, hmol.caseno, a.dateadmit, hmol.amount, a.street, a.barangay, a.municipality, a.province from arv_tbl_hmotransmittallist hmol left join admission a on hmol.caseno=a.caseno 
join patientprofile p on a.patientidno=p.patientidno where hmol.batchno = '$batchno'";
$result4 = $conn->query($sql4);
while($row4 = $result4->fetch_assoc()) {
$patientname=$row4['patientname'];
$loa = $row4['policyno'];
$caseno = $row4['caseno'];
$dateadmit = $row4['dateadmit'];
$amount = $row4['amount'];
$address1 = $row4['street']." ".$row4['barangay']." ".$row4['municipality'].", ".$row4['province'];
$i++; $ecol="black";
$total += $amount;

$amount2 = number_format($amount, 2);
$total2 = number_format($total, 2);

echo "
<tr>
<td style='text-align: center; font-size: 12px;'>$i</td>
<td style='font-size: 12px;'>$patientname</td>
<td style='text-align: center; font-size: 12px;'>$dateadmit</td>
<td style='text-align: center; font-size: 12px;'></td>
<td style='text-align: center; font-size: 12px;'>$amount2</td>
<td style='font-size: 12px; width: 12%;'>$address1</td>
</tr>
";

}

echo "
<tr>
<td style='text-align: center; font-size: 12px;'></td>
<td style='text-align: center; font-size: 12px;' colspan='3'><b>** Grand Total **</b></td>
<td style='font-size: 12px;' colspan='2'><b>$total2</b></td>
</tr>
";

echo "
</table>
</div>
</div>
";
?>
