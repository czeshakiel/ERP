<?php
include "main/connection.php";
error_reporting(1);
echo"
<table align='center' width='100%' border='1' style='border-collapse: collapse;'>
<tr>
<td style='text-align: center; font-size: 11px; width: 5%;'><b>NO.</b></td>
<td style='text-align: center; font-size: 11px; width: 60%;'><b>PATIENT</b></td>
<td style='text-align: center; font-size: 11px; width: 10%;'><b>AMOUNT</b></td>
</tr>
";

$i=0;
$resultn = $conn->query("select * from collection where accttitle='PROFESSIONAL FEE' and type like '%Visa%'");
while($rown = $resultn->fetch_assoc()){ 
$desc=addslashes($rown['description']);
$name=addslashes($rown['acctname']);
$refno=$rown['refno'];
$i++;

$pfcode="";
$pf = $conn->query("select * from docfile where name='$desc'");
while($pf1 = $pf->fetch_assoc()){$pfcode = $pf1['code'];}

$conn->query("update collection set pfcode='$pfcode' where refno='$refno'");


echo"
<tr>
<td style='text-align: center; font-size: 11px; width: 5%;'>$i</td>
<td style='font-size: 11px; width: 60%;'>$name</td>
<td style='text-align: center; font-size: 11px; width: 30%;'>$desc</td>
<td style='text-align: center; font-size: 11px; width: 5%;'>0</td>
</tr>
";
}

echo"</table>";
?>