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
<hr class="sidebar-divider my-0">

<?php
$dstart=$_GET['datefrom'];
$dend=$_GET['dateto'];
$code=$_GET['code'];
$date_dis = $dstart." - ".$dend;
$datebeg = date('Y-m-d', strtotime('-1 day', strtotime($dstart)));

$sql22c = "select * from receiving where code='$code'";
$result22c = $conn->query($sql22c);
while($row22c = $result22c->fetch_assoc()){ 
$desc = $row22c['itemname'];
}

echo "
<div id='GFG'>

<table align='center' width='100%'>
<tr>
<td style='background-image:url(../main/img/logo/mmshi.png);background-repeat:no-repeat;background-size:70px 70px;'>
<p align='center'><font color='black'><b>$heading</b><br>
ADJUSTMENT HISTORY<br>
DATE: $date_dis</p>
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

<table align='center' class='tablex' width='100%'>
<tr>
<th style='text-align: center; font-size: 12px;'><b>DATE/ TIME</th>
<th style='text-align: center; font-size: 12px;'><b>DESCRIPTION</th>
<th style='text-align: center; font-size: 12px;'><b>OLD QTY</th>
<th style='text-align: center; font-size: 12px;'><b>NEW QTY</th>
<th style='text-align: center; font-size: 12px;'><b>DISCRE</th>
<th style='text-align: center; font-size: 12px;'><b>REASON</th>
<th style='text-align: center; font-size: 12px;'><b>USER</th>
</tr>
";

$discre = 0;
$sql222 = "SELECT * FROM `scm_adjustmenthistory` WHERE datearray between '$dstart' and '$dend' and dept='$dept' order by datearray, timearray";
$result222 = $conn->query($sql222);
while($row222 = $result222->fetch_assoc()){ 
$datearray=$row222['datearray'];
$timearray=$row222['timearray'];
$desc=$row222['desc'];
$oldqty=$row222['oldqty'];
$newqty=$row222['newqty'];
$reason=$row222['reason'];
$userm=$row222['user'];

if($oldqty>=$newqty){$discre = $oldqty - $newqty;}else{$discre = $newqty - $oldqty;}
echo"
<tr>
<td style='text-align: center; font-size: 12px;'>$datearray - $timearray</td>
<td style='text-align: center; font-size: 12px;'>$desc</td>
<td style='text-align: center; font-size: 12px;'>$oldqty</td>
<td style='text-align: center; font-size: 12px;'>$newqty</td>
<td style='text-align: center; font-size: 12px;'>$discre</td>
<td style='text-align: center; font-size: 12px;'>$reason</td>
<td style='text-align: center; font-size: 12px;'>$userm</td>
</tr>
<tr>
";
}


echo "
</table>




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

