<style>
.tablex { 
width: 100%; 
border-collapse: collapse; 
}

.tablex th { 
background: #3498db; 
color: white; 
font-weight: bold; 
}

.tablex td, th { 
padding: 10px; 
border: 1px solid #070707; 
text-align: left; 
font-size: 18px;
}
</style>

<main id="main" class="main">

<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?ptpf">PT PF Date</a></li>
<li class="breadcrumb-item">PT PF Report Detail</li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">

<div class="card">
<div class="card-body">



<?php
$dstart=$_GET['datefrom'];
$dend=$_GET['dateto'];
$date_dis = $dstart." - ".$dend;

echo "
<div id='GFG'>
<html>
<style type='text/css'>
textarea { border: none; }
@media print {* {-webkit-print-color-adjust: exact;}}
th{font-weight: normal;}
textarea{visibility:hidden;}
table {border-collapse: collapse;}
</style>
<body>

<table align='center' border='0' width='100%'>
<tr><td align='center' style='font-size: 12px; padding: 0px;'>

<table border='0'  width='100%'>
<tr align='center'><td align='center' style='font-size: 12px; padding: 0px;'><b><font color='black'>$heading</td></tr>
<tr align='center'><td align='center' style='font-size: 12px; padding: 0px;'><font color='black'>PHYSICAL THERAPY DEPARTMENT</td></tr>
<tr align='center'><td align='center' style='font-size: 12px; padding: 0px;'><font color='black'>Total Number of Sessions</td></tr>
<tr align='center'><td align='center' style='font-size: 12px; padding: 0px;'><font color='black'>".date('M-d-Y',strtotime($dstart))." to ".date('M-d-Y',strtotime($dend))."</td></tr>
<tr align='center'><td align='center' style='font-size: 12px; padding: 0px;'>&nbsp;</td></tr>
<tr align='center'><td align='center' style='font-size: 12px; padding: 0px;'><font color='black'><b>For Dra. Dizons' Fee</td></tr>
</table>

</td>
</tr>
<tr>
<td align='center' style='font-size: 12px; padding: 0px;'>
<br>

<table align='center' width='100%' border='1' class='tablex'>
<tr align='center'>
<td align='center' style='font-size: 12px; padding: 5px;'><b>#</td>
<td align='center' style='font-size: 12px; padding: 5px;'><b>Month</td>
<td align='center' style='font-size: 12px; padding: 5px;'><b>PT1</td>
<td align='center' style='font-size: 12px; padding: 5px;'><b>PT1+t</td>
<td align='center' style='font-size: 12px; padding: 5px;'><b>PT2</td>
<td align='center' style='font-size: 12px; padding: 5px;'><b>PT3</td>
<td align='center' style='font-size: 12px; padding: 5px;'><b>PT4</td>
<td align='center' style='font-size: 12px; padding: 5px;'><b>PT5</td>
<td align='center' style='font-size: 12px; padding: 5px;'><b>PT5+</td>
<td align='center' style='font-size: 12px; padding: 5px;'><b>PT5++</td>
<td align='center' style='font-size: 12px; padding: 5px;'><b>PT6</td>
</tr>
";
$i=0;
$amount2;
$sql22 = "SELECT monthname(datearray) as 'date', COUNT(CASE WHEN productcode='10007327p-24' THEN productcode END) as 'PT1', COUNT(CASE WHEN productcode='10007329p-24' THEN productcode END) as 'PT1traction', COUNT(CASE WHEN productcode='10007328p-24' THEN productcode END) as 'PT2', COUNT(CASE WHEN productcode='10007331p-24' THEN productcode END) as 'PT3', COUNT(CASE WHEN productcode='10007332p-24' THEN productcode END) as 'PT4', COUNT(CASE WHEN productcode='10007333p-24'  THEN productcode END) as 'PT5', COUNT(CASE WHEN productcode='10007334p-24' THEN productcode END) as 'PT5plus', COUNT(CASE WHEN productcode='10007335p-24' THEN productcode END) as 'PT5plusplus', COUNT(CASE WHEN productcode='10007336p-24' THEN productcode END) as 'PT6' FROM `productout` where datearray between '$dstart' AND '$dend' AND (status = 'PAID' OR status = 'Approved') group by year(datearray), month(datearray) asc";
$PT1_total=0;
$PT1traction_total=0;
$PT2_total=0;
$PT3_total=0;
$PT4_total=0;
$PT5_total=0;
$PT5plus_total=0;
$PT5plusplus_total=0;
$PT6_total=0;

$result22 = $conn->query($sql22);
while($row22 = $result22->fetch_assoc()) {
$date=$row22['date'];
$PT1=$row22['PT1'];
$PT1traction=$row22['PT1traction'];
$PT2=$row22['PT2'];
$PT3=$row22['PT3'];
$PT4=$row22['PT4'];
$PT5=$row22['PT5'];
$PT5plus=$row22['PT5plus'];
$PT5plusplus=$row22['PT5plusplus'];
$PT6=$row22['PT6'];
$i++;

echo "
<tr>
<td align='center' style='font-size: 12px; padding: 5px;'>$i.</td>
<td align='center' style='font-size: 12px; padding: 5px;'>$date</td>
<td align='center' style='font-size: 12px; padding: 5px;'>$PT1</td>
<td align='center' style='font-size: 12px; padding: 5px;'>$PT1traction</td>
<td align='center' style='font-size: 12px; padding: 5px;'>$PT2</td>
<td align='center' style='font-size: 12px; padding: 5px;'>$PT3</td>
<td align='center' style='font-size: 12px; padding: 5px;'>$PT4</td>
<td align='center' style='font-size: 12px; padding: 5px;'>$PT5</td>
<td align='center' style='font-size: 12px; padding: 5px;'>$PT5plus</td>
<td align='center' style='font-size: 12px; padding: 5px;'>$PT5plusplus</td>
<td align='center' style='font-size: 12px; padding: 5px;'>$PT6</td>
</tr>
";
$PT1_total += $PT1;
$PT1traction_total += $PT1traction;
$PT2_total += $PT2;
$PT3_total += $PT3;
$PT4_total += $PT4;
$PT5_total += $PT5;
$PT5plus_total += $PT5plus;
$PT5plusplus_total += $PT5plusplus;
$PT6_total += $PT6;
}
echo "
<tr>
<td style='font-size: 12px; padding: 5px;' align='center'><b></td>
<td style='font-size: 12px; padding: 5px;' align='center'><b>Total</td>
<td style='font-size: 12px; padding: 5px;' align='center'><b>$PT1_total</td>
<td style='font-size: 12px; padding: 5px;' align='center'><b>$PT1traction_total</td>
<td style='font-size: 12px; padding: 5px;' align='center'><b>$PT2_total</td>
<td style='font-size: 12px; padding: 5px;' align='center'><b>$PT3_total</td>
<td style='font-size: 12px; padding: 5px;' align='center'><b>$PT4_total</td>
<td style='font-size: 12px; padding: 5px;' align='center'><b>$PT5_total</td>
<td style='font-size: 12px; padding: 5px;' align='center'><b>$PT5plus_total</td>
<td style='font-size: 12px; padding: 5px;' align='center'><b>$PT5plusplus_total</td>
<td style='font-size: 12px; padding: 5px;' align='center'><b>$PT6_total</td>
<tr>
";

echo "
<tr>
<td style='font-size: 12px; padding: 5px;' align='center'><b></td>
<td style='font-size: 12px; padding: 5px;' align='center'><b>Rate </td>
<td style='font-size: 12px; padding: 5px;' align='center'><b> 10</td>
<td style='font-size: 12px; padding: 5px;' align='center'><b>20</td>
<td style='font-size: 12px; padding: 5px;' align='center'><b>10</td>
<td style='font-size: 12px; padding: 5px;' align='center'><b>10</td>
<td style='font-size: 12px; padding: 5px;' align='center'><b>50</td>
<td style='font-size: 12px; padding: 5px;' align='center'><b>30</td>
<td style='font-size: 12px; padding: 5px;' align='center'><b>30</td>
<td style='font-size: 12px; padding: 5px;' align='center'><b>30</td>
<td style='font-size: 12px; padding: 5px;' align='center'><b>50</td>
</tr>
";
echo "
<tr>
<td style='font-size: 12px; padding: 5px; background: #e4e1e1;' align='center'><b></td>
<td style='font-size: 12px; padding: 5px; background: #e4e1e1;' align='center'><b>Amount</td>
<td style='font-size: 12px; padding: 5px; background: #e4e1e1;' align='center'><b>".number_format(($PT1_total * 10),2)."</td>
<td style='font-size: 12px; padding: 5px; background: #e4e1e1;' align='center'><b>".number_format(($PT1traction_total * 20),2)." </td>
<td style='font-size: 12px; padding: 5px; background: #e4e1e1;' align='center'><b>".number_format(($PT2_total * 10),2)."</td>
<td style='font-size: 12px; padding: 5px; background: #e4e1e1;' align='center'><b>".number_format(($PT3_total * 10),2)." </td>
<td style='font-size: 12px; padding: 5px; background: #e4e1e1;' align='center'><b>".number_format(($PT4_total * 50),2)."</td>
<td style='font-size: 12px; padding: 5px; background: #e4e1e1;' align='center'><b>".number_format(($PT5_total * 30),2)."</td>
<td style='font-size: 12px; padding: 5px; background: #e4e1e1;' align='center'><b>".number_format(($PT5plus_total * 30),2)."</td>
<td style='font-size: 12px; padding: 5px; background: #e4e1e1;' align='center'><b>".number_format(($PT5plusplus_total * 30),2)."</td>
<td style='font-size: 12px; padding: 5px; background: #e4e1e1;' align='center'><b>".number_format(($PT6_total * 50),2)."</td>
</tr>
</table>
</br>
";
$over_all_total= ($PT1_total * 10) + ($PT1traction_total * 20) + ($PT2_total * 10) + ($PT3_total * 10) + ($PT4_total * 50) + ($PT5_total * 30) + ($PT5plus_total * 30) + ($PT5plusplus_total * 30) + ($PT6_total * 50);
echo "
<table align='left' border='0'>
<tr>
<td colspan='1' align='center'><h4><b><font color='black'>Total Amount: </h4></td>
<td align='center'><h4><b><font color='black'><u>".number_format(($over_all_total),2)."</u></h4></td>
</tr>
<tr>
</table>
</br>
</br>

<table width='100%' border='0'>
<tr align='right' >
<td colspan='2' align='left' width='30%'><font color='black'>Prepared by:</td>
<td align='center' style='font-size: 12px; padding: 0px;'>&nbsp;</td>
</tr>
<tr align='right' height='40'>
<td colspan='2' align='left' >&nbsp;</td>
</tr>
<tr align='right'>
<td colspan='2' align='center' style='border-top: 2px solid black;'><b><font color='black'>PT Head</td>
<td align='center' style='font-size: 12px; padding: 0px;'>&nbsp;</td>
</tr>
</table>
</br>

</td></tr></table>
</div>
";
?>

</div>
</div>

</div>
</div>
</section>

</main>