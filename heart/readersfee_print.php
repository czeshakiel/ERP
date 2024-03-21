<?php
$dstart=$_GET['dstartx'];
$dend=$_GET['dendx'];
$readerr=$_GET['reader'];
$trans=$_GET['trans'];
$test=$_GET['test'];
$date_dis = $dstart." - ".$dend;
list($readerid, $reader) = explode("_", $readerr);

include '../main/class.php';
$sql2 = "SELECT * FROM ipaddress";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) { 
$ip=$row2['ipaddress'];
}

$sql22 = "SELECT * FROM heading";
$result22 = $conn->query($sql22);
while($row22 = $result22->fetch_assoc()) { 
$hh=$row22['heading'];
$tt=$row22['telno'];
}



echo "
<html>
<style type='text/css'>
    textarea { border: none; }
</style>
<style>
@media print {
    * {
        -webkit-print-color-adjust: exact;
    }
}

th{
    font-weight: normal;
}
textarea{
  visibility:hidden;
}

table {
  border-collapse: collapse;
}
</style>
<body>


<table align='center'>
<tr>
<td style='background-image:url(http://$ip/arv2020/arv_includes/dist/img/mmshi.png);background-repeat:no-repeat;background-size:90px 80px;'>
<h3 align='center'>$hh<br>
PF READERS FEE REPORT - $trans<br>
DATE: $date_dis <br>
$reader</h3>
</td>
</tr>

<tr>
<th style='border-bottom: solid 1px black;'></th>
</tr>

<tr>
<td>
<br>


</td>
</tr>

<tr>
<td>


<table align='center' width='100%' border='1'>
<tr>
<td>#</td>
<td>PATIENT'S NAME</td>
<td>SENIOR</td>
<td>$trans</td>
<td>DATE</td>
<td>TYPE OF TEST</td>
<td>GROSS</td>
<td><p align='right'>TAKE HOME PAY</p></td>
</tr>
<tr>
<th colspan='8' style='border-bottom: solid 1px black;'></th>
";
$i=0;
$amount2;
	if($test == "All")
		{
			$sql22 = "select UPPER(patientprofile.lastname) as lname,UPPER(patientprofile.firstname) as fname,UPPER(patientprofile.middlename) as mname,readersfee.amount,readersfee.caseno,readersfee.date,admission.hmo,readersfee.refno1,readersfee.gross,readersfee.productcode,readersfee.refno,readersfee.producttype  from readersfee,admission,patientprofile where readersfee.date between '$dstart' AND '$dend'  and (admission.ward='out' or admission.ward='discharged' or admission.ward='in') and (readersfee.doctor  like '%$reader%' or readersfee.doctorsid like '%$readerid%') and admission.caseno=readersfee.caseno and patientprofile.patientidno=admission.patientidno   order by readersfee.date";

		}
		else
		{
			$sql22 = "select UPPER(patientprofile.lastname) as lname,UPPER(patientprofile.firstname) as fname,UPPER(patientprofile.middlename) as mname,readersfee.amount,readersfee.caseno,readersfee.date,admission.hmo,readersfee.refno1,readersfee.gross,readersfee.productcode,readersfee.refno,readersfee.producttype  from readersfee,admission,patientprofile where readersfee.date between '$dstart' AND '$dend'  and (admission.ward='out' or admission.ward='discharged' or admission.ward='in') and (readersfee.doctor  like '%$reader%' or readersfee.doctorsid like '%$readerid%') and admission.caseno=readersfee.caseno and patientprofile.patientidno=admission.patientidno and readersfee.productcode='$test'  order by readersfee.date";

			
		}
//$sql22 = "select UPPER(patientprofile.lastname) as lname,UPPER(patientprofile.firstname) as fname,UPPER(patientprofile.middlename) as mname,readersfee.amount,readersfee.caseno,readersfee.date,admission.hmo,readersfee.refno1,readersfee.gross,readersfee.productcode,readersfee.refno,readersfee.producttype  from readersfee,admission,patientprofile where readersfee.date between '$dstart' AND '$dend'  and (admission.ward='out' or admission.ward='discharged' or admission.ward='in') and readersfee.doctor  like '%$reader%' and admission.caseno=readersfee.caseno and patientprofile.patientidno=admission.patientidno $querytest  order by readersfee.date";
$result22 = $conn->query($sql22);
while($row22 = $result22->fetch_assoc()) { 
$fname=$row22['fname'];
$lname=$row22['lname'];
$mname=$row22['mname'];
$name = $lname.", ".$fname." ".$mname;
$datez=$row22['date'];
$productcode=$row22['productcode'];
$gross=$row22['gross'];
$amount=$row22['amount'];
$senior=$row22['producttype'];
$refno20=$row22['refno'];
$hmo=$row22['hmo'];


// if($senior="" or $senior="READERS FEE")
// 	{$senior="---";}


$sql22s = "select description from receiving where code='$productcode'";
$result22s = $conn->query($sql22s);
while($row22s = $result22s->fetch_assoc()) { 
$description=$row22s['description'];
}
list($a1, $desc, $a2) = explode('-', $description);


if($trans=="CASH")
{
$sql223 = "select excess from productout where refno='$refno20' AND status ='PAID' and excess > 0 and productsubtype='PROFESSIONAL FEE'";
$result223 = $conn->query($sql223);
while($row223 = $result223->fetch_assoc()) { 
$amount2 = $amount2 + $amount;
$i++;
echo "
<tr>
<td>$i</td>
<td>$name</td>
<td>$senior</td>
<td>---</td>
<td>$datez</td>
<td>$description</td>
<td>".number_format($gross,'2')."</td>
<td><p align='right'>".number_format($amount,'2')."</p></td>
</tr>
<tr>
";
}
}

elseif($trans=="HMO")
{
$sql223 = "select hmo from productout where  refno='$refno20' and hmo > 0 AND status ='Approved' and productsubtype='PROFESSIONAL FEE'";
$result223 = $conn->query($sql223);
while($row223 = $result223->fetch_assoc()) { 
$amount2 = $amount2 + $amount;
$i++;
echo "
<tr>
<td>$i</td>
<td>$name</td>
<td>$senior</td>
<td>$hmo</td>
<td>$datez</td>
<td>$description</td>
<td>$gross</td>
<td><p align='right'>$amount</p></td>
</tr>
<tr>
";
}
}

elseif($trans=="PHIC")
{
$sql223 = "select phic from productout where  refno='$refno20' AND status ='Approved' and phic > 0 and productsubtype='PROFESSIONAL FEE'";
$result223 = $conn->query($sql223);
while($row223 = $result223->fetch_assoc()) { 
$amount2 = $amount2 + $amount;
$i++;
echo "
<tr>
<td>$i</td>
<td>$name</td>
<td>$senior</td>
<td>---</td>
<td>$datez</td>
<td>$description</td>
<td>$gross</td>
<td><p align='right'>$amount</p></td>
</tr>
<tr>
";
}
}
}
echo "
<tr>
<td bgcolor='lightgray'>TOTAL:</td>
<td bgcolor='lightgray'></td>
<td bgcolor='lightgray'></td>
<td bgcolor='lightgray'></td>
<td bgcolor='lightgray'></td>
<td bgcolor='lightgray'></td>
<td bgcolor='lightgray'></td>
<td bgcolor='lightgray'><p align='right'>".number_format($amount2,'2')."</p></td>
</tr>
<tr>
";

echo "
</table>




</td>
</tr>
<tr>
<th style='border-bottom: solid 1px black;'></th>
</tr>
<tr>
<td>
<table align='center' width='100%'>
<tr>
<td>PREPARED BY:</td>
<td>CHECKED BY:</td>
<td>NOTED BY:</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><u>EVANGELINE ULEP</u></td>
<td><u></u></td>
<td><u>ALMA R. GALAY</u></td>
</tr>
<tr>
<td>HEART STATION HEAD</td>
<td>ACCOUNTING IN-CHARGE</td>
<td>ADMINISTRATOR</td>
</tr>
</table>
</td>
</tr>
<tr>
<td>
<textarea id='result' name='result' rows='1' cols='90' style='font-size: 18px;' disabled>
</textarea></font>
</td>
</tr>
</table>


</body>
</html>
";
?>