
<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?ormonitoring">OR Monitoring</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">



<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th class="text-center"><font color="white">#</th>
<th class="text-center"><font color="white">PATIENT INFO</th>
<th class="text-center"><font color="white">TRANSACTION-ID</th>
<th class="text-center"><font color="white">DETAILS</th>
<th class="text-center"><font color="white">DATE/TIME</th>
<th class="text-center"><font color="white">OR NO</th>
<th class="text-center"></th>
</tr>
</thead>
<tbody>


<!-- ################################ ARVID QUERY..... START SQL QUERY ##############################################-->

<?php
$sql = "SELECT sum(amount) as amount, sum(discount) as discount, acctname, ofr, datearray, paymentTime, username, paidBy, acctno, type FROM collection where datearray=CURDATE() and paidBy='$dept' group by ofr order by paymentTime desc";
$result = $conn->query($sql);
$i=0;
while($row = $result->fetch_assoc()) {
$acctname = $row['acctname'];
$acctno = $row['acctno'];
$ofr = $row['ofr'];
$amount = $row['amount'];
$discount = $row['discount'];
$datearray = $row['datearray'];
$PaymentTime = $row['paymentTime'];
$username = $row['username'];
$paidby = $row['paidBy'];
$type = $row['type'];

if($paidby =="CASHIER"){$vv = "CASHIER-MAIN";}
elseif($paidby =="CASHIER2"){$vv = "CASHIER-OPD";}
elseif($paidby =="CASHIER3"){$vv = "PHARMA-IPD";}
elseif($paidby =="CASHIER4"){$vv = "RDU CASHIER";}
$i++;

echo"
<tr>
<td style='font-size: 11px;' align='center'>$i</td>
<td style='font-size: 11px;'><font color='gray'>Caseno:</font> $acctno<br><font color='gray'>Name:</font> <b>$acctname</b></td>
<td style='font-size: 11px;'><font color='gray'>Date:</font> $datearray<br><font color='gray'>Time:</font> $PaymentTime</td>
<td style='font-size: 11px;'><font color='gray'>Amount:</font> $amount<br><font color='gray'>Disc:</font> $discount</td>
<td style='font-size: 11px;'><font color='gray'>User:</font> $username<br><font color='gray'>Dept:</font> $vv</td>
<td style='font-size: 11px;'><font color='gray'>OR No:</font> <span class='badge bg-danger'>$ofr</span><br><font color='gray'>Status:</font> $type</td>
<td><a href='http://$ip/2020codes/PrintOR/OR1.php?orno=$ofr$datax&$paidby' target='_blank'><button type='button' title='View Item(s)' class='btn btn-sm btn-primary'><i class='icofont-printer'></i></button></a></p></td>
</tr>
";
 } ?>
</tbody>
</table>




</div>
</div>
</div>
</div>
</section>
</main>
