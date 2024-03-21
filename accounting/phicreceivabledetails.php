<style>
    .tablex {
  border-collapse: separate;
  border-spacing: 0;
  width: 100%;
  

}
.tablex tr th,
.tablex tr td {
  border-right: 1px solid #bbb;
  border-bottom: 1px solid #bbb;
  padding: 5px;
  text-align: left;
  /*font-family: "Arial", Arial, San-serif;*/
    font-family: Arial, Helvetica, sans-serif;
}
.tablex tr th:first-child,
.tablex tr td:first-child {
  border-left: 1px solid #bbb;
}
.tablex tr th {

  border-top: 1px solid #bbb;
  text-align: left;
}

/* top-left border-radius */
.tablex tr:first-child th:first-child {
}

/* top-right border-radius */
.tablex tr:first-child th:last-child {
}

/* bottom-left border-radius */
.tablex tr:last-child td:first-child {
}

/* bottom-right border-radius */
.tablex tr:last-child td:last-child {
}
}
</style>

<script>
function printDiv() {
var divContents = document.getElementById("GFG").innerHTML;
var a = window.open('', '', 'height=500, width=500');
a.document.write('<html>');
a.document.write(divContents);
a.document.write('</body></html>');
a.document.close();
a.print();
}
</script>


<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?adjustmenthistory">Adjustment History</a></li>
<li class="breadcrumb-item">Adjustment Histroy Details</li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<button class="btn btn-primary btn-sm" onclick="printDiv()"><i class="icofont-printer"></i> Print Adjustment Detail</button><p></p>
<hr>

<?php
$dstart=$_GET['datefrom'];
$dend=$_GET['dateto'];
$date_dis = date("F d, Y", strtotime($dstart))." to ".date("F d, Y", strtotime($dend));

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


<table align='center' width='100%'>
<tr>
<td style='background-image:url(../main/img/logo/mmshi.png);background-repeat:no-repeat;background-size:70px 70px;'>
<p align='center'><font color='black'><b>$heading</b><br>
AUTO CREDIT PAYMENT NOTOCE<br>
DATE: $date_dis</p>
</td>
</tr>

<tr>
<td>
<br>


</td>
</tr>

<tr>
<td>
<table align='center' class='tablex' width='100%'>
<tr>
<th style='text-align: center; font-size: 12px;' rowspan='2'>PABN No.</th>
<th style='text-align: center; font-size: 12px;' rowspan='2'>Series No.</th>
<th style='text-align: center; font-size: 12px;' rowspan='2'>Member PIN</th>
<th style='text-align: center; font-size: 12px;' rowspan='2'>Patient Name</th>
<th style='text-align: center; font-size: 12px;' rowspan='2'>Confinement Period</th>
<th style='text-align: center; font-size: 12px;' colspan='2'>Caserate 1</th>
<th style='text-align: center; font-size: 12px;' colspan='2'>Caserate 2</th>
<th style='text-align: center; font-size: 12px;' colspan='2'>Others</th>
<th style='text-align: center; font-size: 12px;' colspan='4'>TOTAL</th>
</tr>
<tr>
<td style='text-align: center; font-size: 12px;'>Code</td>
<td style='text-align: center; font-size: 12px;'>Gross</td>
<td style='text-align: center; font-size: 12px;'>Code</td>
<td style='text-align: center; font-size: 12px;'>Gross</td>
<td style='text-align: center; font-size: 12px;'>Code</td>
<td style='text-align: center; font-size: 12px;'>Gross</td>
<td style='text-align: center; font-size: 12px;'>Gross</td>
<td style='text-align: center; font-size: 12px;'>WTax</td>
<td style='text-align: center; font-size: 12px;'>HCI</td>
<td style='text-align: center; font-size: 12px;'>PF</td>
</tr>
";

$totalrdv=0;
$sql1 = $conn->query("select * from ecstatus where pVoucherDate between '$dstart' and '$dend' and pStatus='WITH CHEQUE' ORDER BY pPatientLastName ASC");
while($res1 = $sql1->fetch_assoc()){
$caseno = $res1['caseno'];
$pCheckAmount = $res1['pCheckAmount'];

$caseno2 = $caseno;
if(strpos($caseno, "RC-")!==false){
$sql22 = $conn->query("select * from rduconsolidate where rducaseno='$caseno'");
$countrdu = mysqli_num_rows($sql22);
while($res22 = $sql22->fetch_assoc()){$caseno2 = $res22['caseno'];} 
}

$wtax=0; $hosp_net=0;
$sql2 = $conn->query("select * from finalcaserate where (caseno='$caseno' or caseno='$caseno2') and level='primary'");
while($res2 = $sql2->fetch_assoc()){
$code = $res2['icdcode'];
$hshare = $res2['hospitalshare'];
$pshare = $res2['pfshare'];
$gross = $hshare+$pshare;
}

$code2="NONE";
$sql22 = $conn->query("select * from finalcaserate where (caseno='$caseno' or caseno='$caseno2') and level='secondary'");
while($res22 = $sql22->fetch_assoc()){
$code2 = $res22['icdcode'];
$hshare2 = $res22['hospitalshare'];
$pshare2 = $res22['pfshare'];
$gross2 = $hshare2+$pshare2;
}

if(strpos($caseno, "RC-")!==false){
$hshare = $hshare*$countrdu;
$pshare = $pshare*$countrdu;
$gross = $hshare+$pshare;
}

$wtax = ($gross+$gross2) * 0.02;
$hosp_net = ($hshare+$hshare2) - $wtax;

$totalrdv+=($hshare+$hshare2);
$totalwt+=$wtax;

$mygross = number_format($gross+$gross2, 2);
$grossx1 = number_format($gross, 2);
$grossx2 = number_format($gross2, 2);
$mywtax = number_format($wtax, 2);
$myhosp_net = number_format($hosp_net, 2);
$mypshare = number_format($pshare+$pshare2, 2);
$mytotalrdv = number_format($totalrdv, 2);
$mytotalwt = number_format($totalwt, 2);

$mygross2+=$gross+$gross2;
$mywtax2+=$wtax;
$myhosp_net2+=$hosp_net;
$mypshare2+=$pshare+$pshare2;

$mygross2z=number_format($mygross2, 2);
$mywtax2z=number_format($mywtax2, 2);
$myhosp_net2z=number_format($myhosp_net2, 2);
$mypshare2z=number_format($mypshare2, 2);

$doc=""; $z=0;
$sql2f = $conn->query("select * from productout where caseno='$caseno' and productsubtype='PROFESSIONAL FEE' and (phic>0 OR phic1>0)");
while($res2f = $sql2f->fetch_assoc()){
if($z==0){$doc = $res2f['productdesc'];}else{$doc = $doc.", ".$res2f['productdesc'];}
$z++;
}
if(strpos($caseno, "RC-")!==false){$doc = "AREX E. ACQUIATAN";}

echo"
<tr>
<td style='text-align: center; font-size: 11px;'>$res1[pVoucherNo]</td>
<td style='text-align: center; font-size: 11px;'>$res1[pClaimSeriesLhio]</td>
<td style='text-align: center; font-size: 11px;'>$res1[pPin]</td>
<td style='text-align: center; font-size: 11px;'>$res1[pPatientLastName], $res1[pPatientFirstName] $res1[pPatientMiddleName]</td>
<td style='text-align: center; font-size: 11px;'>$res1[pAdmissionDate] to $res1[pDischargeDate]</td>
<td style='text-align: center; font-size: 11px;'>$code</td>
<td style='text-align: center; font-size: 11px;'>$grossx1</td>
<td style='text-align: center; font-size: 11px;'>$code2</td>
<td style='text-align: center; font-size: 11px;'>$grossx2</td>
<td style='text-align: center; font-size: 11px;'>NONE</td>
<td style='text-align: center; font-size: 11px;'>0.00</td>
<td style='text-align: center; font-size: 11px;'>$mygross</td>
<td style='text-align: center; font-size: 11px;'>$mywtax</td>
<td style='text-align: center; font-size: 11px;'>$myhosp_net</td>
<td style='text-align: center; font-size: 11px;'>$mypshare</td>
</tr>
<tr><td colspan='15' style='font-size: 11px; background: #F4E5F9;'>Health Care Professional/s: [$caseno] $doc</td></tr>
";
}

echo"
<tr><td colspan='15' style='font-size: 11px; background: #F4E5F9;'>&nbsp;</td></tr>
<tr>
<td style='text-align: center; font-size: 11px;'></td>
<td style='text-align: center; font-size: 11px;'></td>
<td style='text-align: center; font-size: 11px;'></td>
<td style='text-align: center; font-size: 11px;'></td>
<td style='text-align: center; font-size: 11px;'></td>
<td style='text-align: center; font-size: 11px;'></td>
<td style='text-align: center; font-size: 11px;'></td>
<td style='text-align: center; font-size: 11px;'></td>
<td style='text-align: center; font-size: 11px;'></td>
<td style='text-align: center; font-size: 11px;'></td>
<td style='text-align: center; font-size: 11px;'></td>
<td style='text-align: center; font-size: 11px;'><b>$mygross2z</b></td>
<td style='text-align: center; font-size: 11px;'><b>$mywtax2z</b></td>
<td style='text-align: center; font-size: 11px;'><b>$myhosp_net2z</b></td>
<td style='text-align: center; font-size: 11px;'><b>$mypshare2z</b></td>
</tr>
";

echo "
</table>

<br>
<table width='30%' align='right'><tr><td>
<table class='tablex'>
<tr>
<th>RDV:</th>
<th>$mytotalrdv</th>
</tr>
<tr>
<td>WT:</td>
<td>$mytotalwt</td>
</tr>
</table>
</td></tr></table>

</td>
</tr>
<tr>
<td><br><br><br><br>
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
<td><u>_______________________</u></td>
<td><u>_______________________</u></td>
<td><u>_______________________</u></td>
</tr>
<tr>
<td>$dept HEAD</td>
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
</div>
";
?>







</div>
</div>
</div>
</div>
</section>
</main>

