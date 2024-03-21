<?php
error_reporting(1);
include '../main/class.php';

$doc = $_POST['doc'];
$datef = $_POST['datef'];
$datet = $_POST['datet'];
$date = date("F d, Y", strtotime($datef))." - ".date("F d, Y", strtotime($datet));

$doc2=$doc;
$sql = $conn->query("select * from docfile where code='$doc'");
while($res=$sql->fetch_assoc()){
$doc2 = $res['name'];
}

if($doc=="ALL"){$que="";}
else{$que="and pfcode='$doc'";}
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
<td width="10%"><img src="../resultform/kmsci.png" width="50" height="50"></td>
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
<td style="font-size: 13px; text-align: center;"><b> PF EXCESS<b></td>
</tr></table><hr>

<table align='left'>
<tr><td style="font-size: 12px;">Report Date: <b><?php echo $date ?></b></td></tr>
<tr><td style="font-size: 12px;">Doctor: <b><?php echo $doc2 ?></b></td></tr>
</table>

<?php if($doc!="ALL"){ ?>
<table align="center" width="100%" border="1" style="border-collapse: collapse;">
<tr>
<td style="text-align: center; font-size: 12px; width: 5%;"><b>NO.</b></td>
<td style="text-align: center; font-size: 12px; width: 50%;"><b>DOCTOR</b></td>
<td style="text-align: center; font-size: 12px; width: 35%;"><b>PATIENT</b></td>
<td style="text-align: center; font-size: 12px; width: 10%;"><b>AMOUNT</b></td>
</tr>
</table>
</div>


<div class='content'>
<table align="center" width="100%" border="1" style="border-collapse: collapse;">
<?php
$i=0;
$resultn = $conn->query("select * from collection where accttitle='PROFESSIONAL FEE' and datearray between '$datef' and '$datet' $que order by pfcode");
while($rown = $resultn->fetch_assoc()){ 
$desc=addslashes($rown['description']);
$name=addslashes($rown['acctname']);
 $amount=$rown['amount'];
 $amount2 = number_format($number, 2);
$i++;

echo "
<tr>
<td style='text-align: center; font-size: 12px; width: 5%;'>$i</td>
<td style='font-size: 12px; width: 50%;'>$desc</td>
<td style='text-align: left; font-size: 12px; width: 35%;'>$name</td>
<td style='text-align: right; font-size: 12px; width: 10%;'>$amount2</td>
</tr>
";
}

echo "
</table>

<br><br>
";
}

echo"

<table width='100%'><tr><td>
<table width='70%' border='1' style='border-collapse: collapse;'>
<tr>
<td colspan='2' style='font-size: 12px;'><b>PF EXCESS SUMMARY</b></td>
";

$resultn1 = $conn->query("select sum(amount) as total, description from collection where accttitle='PROFESSIONAL FEE' and datearray between '$datef' and '$datet' $que group by pfcode order by pfcode");
while($rown1 = $resultn1->fetch_assoc()){ 
$desc1=addslashes($rown1['description']);
$totalamount=$rown1['total'];
$totalamount2 = number_format($totalamount, 2);
$gtotal+=$totalamount;
$gtotal2 = number_format($gtotal, 2);
$i++;

echo"
<tr>
<td width='70%' style='font-size: 12px;'>$desc1</td>
<td width='15%;' style='font-size: 12px; text-align: right;'>$totalamount2</td>
<!--td style='font-size: 12px; text-align: center;'><a href='../accounting/cheque/chequewriter.php?amount=$totalamount&doctor=$desc1' target='_blank'>Cheque Writer</a></td-->
</tr>
";

}

echo"
<tr>
<td style='text-align: right; font-size: 13px;'><b>GRAND TOTAL:</b></td>
<td style='text-align: right; font-size: 13px;'><b>$gtotal2</b></td>
</tr>
</table>

<br><br><br><br>
<table width='80%'>
<tr>
<td style='width: 45%; border-bottom: 1px solid black; text-align: center; font-size: 12px;'><b>$user</b></td>
<td></td>
<td style='width: 45%; border-bottom: 1px solid black;'></td>
</tr>
<tr>
<td style='text-align: center; font-size: 12px;'>Prepared By</td>
<td></td>
<td style='text-align: center; font-size: 12px;'>Received By</td>
</tr>
</table>

</td></tr></table>



</div>
</div>
";
?>
