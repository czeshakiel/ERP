<?php
$batchno = $_GET['batchno'];
$hmon = $_GET['hmo'];
list($hmoc, $hmonn) = explode("_", $hmon);
$controlno = $_GET['controlno'];
$transdate = date("F d, Y", strtotime($_GET['transdate']));

$sql4s = $conn->query("select * from arv_tbl_hmotransmittallist where batchno = '$batchno' group by batchno");
while($row4s = $sql4s->fetch_assoc()) {$ptype = $row4s['ptype'];}
?>

<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item">Transmittal List</li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<table width="100%"><tr>
<td>
<font color="black"><h5>HMO TRANSMITTAL - <?php echo $controlno ?></h5>
<small>Date: <?php echo $transdate ?><br>
TO: CLAIMS DEPARTMENT <b><font color="red"><?php echo $hmonn ?></b></font>
</td><td valign="bottom" style="text-align: right;">

<div class="btn-group btn-group-justified">
<a class="btn btn-outline-dark mb-1" href='../accounting/hmotransmittal/transmittalletter.php?hmo=<?php echo $hmon ?>&batchno=<?php echo $batchno ?>&controlno=<?php echo $controlno ?>&transdate=<?php echo $transdate.$datax ?>' target="_blank" title="Print Transmittal Letter">
<font size="2"><i class="icofont-printer"></i> Transmittal Letter</font></a>
<a class="btn btn-outline-dark mb-1" href='pfreport.php?hmo=<?php echo $hmon ?>&batchno=<?php echo $batchno ?>&controlno=<?php echo $controlno ?>&transdate=<?php echo $transdate.$datax ?>' target="_blank" title="Print Transmittal Letter PF"><font size="2"><i class="fa-solid fa-user-tie"></i> Professional Fee</font></a>
<a class="btn btn-outline-dark mb-1" href='../accounting/hmotransmittal/transmittalletterdetails.php?hmo=<?php echo $hmon ?>&batchno=<?php echo $batchno ?>&controlno=<?php echo $controlno ?>&transdate=<?php echo $transdate.$datax ?>' target="_blank" title="Print Transmittal Letter Details"><font size="2"><i class="fa-solid fa-circle-info"></i> Detailed Report</font></a>
</div>

</td>
</tr></table>


<hr>
<table width="100%" align="center" class="tablex">
<thead>
<?php if($ptype=="in"){ ?>
<tr>
<th class="text-center" style="font-size: 12px;">#</th>
<th class="text-center" style="font-size: 12px;">NAME OF PATIENT</th>
<th class="text-center" style="font-size: 12px;" colspan="2">CONFINEMENT</th>
<th class="text-center" style="font-size: 12px;">LOA</th>
<th class="text-center" style="font-size: 12px;">ACTUAL</th>
<th class="text-center" style="font-size: 12px;">MEDICARE</th>
<th class="text-center" style="font-size: 12px;">EXCESS</th>
<th class="text-center" style="font-size: 12px;">PF FEE</th>
<th class="text-center" style="font-size: 12px;">HOSP. BILL</th>
<th class="text-center" style="font-size: 12px;">HMO BILL</th>
<th class="text-center" style="font-size: 12px;">TOTAL EXCESS</th>
</tr>
<tr>
<td></td>
<td></td>
<td class="text-center" style="font-size: 12px;"><b>FROM</td>
<td class="text-center" style="font-size: 12px;"><b>TO</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

<?php } else { ?>
<tr>
<th class="text-center" style="font-size: 12px;">#</th>
<th class="text-center" style="font-size: 12px;">NANE OF PATIENT</th>
<th class="text-center" style="font-size: 12px;">CONFINEMENT</th>
<th class="text-center" style="font-size: 12px;">LOA</th>
<th class="text-center" style="font-size: 12px;">ACTUAL</th>
<th class="text-center" style="font-size: 12px;">MEDICARE</th>
<th class="text-center" style="font-size: 12px;">EXCESS</th>
<th class="text-center" style="font-size: 12px;">PF FEE</th>
<th class="text-center" style="font-size: 12px;">HOSP. BILL</th>
<th class="text-center" style="font-size: 12px;">HMO BILL</th>
<th class="text-center" style="font-size: 12px;">TOTAL EXCESS</th>
</tr>

<?php } ?>
</thead>
<tbody>


<?php
$i = 0;
$sql4 = "select p.patientname, a.policyno, hmol.caseno, a.dateadmit, hmol.status from arv_tbl_hmotransmittallist hmol left join admission a on hmol.caseno=a.caseno join patientprofile p on a.patientidno=p.patientidno where hmol.batchno = '$batchno'";
$result4 = $conn->query($sql4);
while($row4 = $result4->fetch_assoc()) {
$patientname=$row4['patientname'];
$loa = $row4['policyno'];
$caseno = $row4['caseno'];
$dateadmit = $row4['dateadmit'];
$status = $row4['status'];
$i++; $ecol="";

$dis = $conn->query("select * from dischargedtable where caseno='$caseno'");
while($diss = $dis->fetch_assoc()){$ddischarged = $diss['datearray'];}


$sql44 = "select sum(excess) as excess, sum(phic) as phic, sum(hmo) as hmo from productout where caseno = '$caseno' and quantity>0 and trantype='charge'";
$result44 = $conn->query($sql44);
while($row44 = $result44->fetch_assoc()) {
$hmo = $row44['hmo'];
$phic = $row44['phic'];
$excess = $row44['excess'];
$actual = $hmo + $phic + $excess;
}

$sql44 = "select sum(hmo) as hmo from productout where caseno = '$caseno' and quantity>0 and productsubtype like '%professional fee%' and producttype not like '%READER%'";
$result44 = $conn->query($sql44);
while($row44 = $result44->fetch_assoc()) {
$hmopf = $row44['hmo'];
}

$sql44 = "select sum(hmo) as hmo from productout where caseno = '$caseno' and quantity>0 and productsubtype not like '%professional fee%'";
$result44 = $conn->query($sql44);
while($row44 = $result44->fetch_assoc()) {
$hmohosp = $row44['hmo'];
}
$hmobill = $hmopf + $hmohosp;

$sql44 = "select * from finalcaserate where caseno = '$caseno' and level = 'primary'";
$result44 = $conn->query($sql44);
while($row44 = $result44->fetch_assoc()) {
$hospshare = $row44['hospitalshare'];
$pfshare = $row44['pfshare'];
$philh = $hospshare + $pfshare;
}

$p_excess = $actual - $philh;
$final_excess = $p_excess - $hmobill;


// ------- SUMMARY ----------------
$t_actual += $actual;
$t_philh += $philh;
$t_pexcess += $p_excess;
$t_hmopf += $hmopf;
$t_hmohosp += $hmohosp;
$t_hmobill += $hmobill;
$t_final_excess += $final_excess;

$actual = number_format($actual,2);
$philh = number_format($philh,2);
$pexcess = number_format($pexcess,2);
$hmopf = number_format($hmopf,2);
$hmohosp = number_format($hmohosp,2);
$hmobill = number_format($hmobill,2);
$final_excess = number_format($final_excess,2);
// -------------------------------

if($status=="PAID"){$ecol="red";}
?>
<tr>
<td style="text-align: center; font-size: 12px; color: <?php echo $ecol ?>;"><font color="blue"><font size="2"><?php echo $i ?></td>
<td style="text-align: center; font-size: 12px; color: <?php echo $ecol ?>;"><?php echo $patientname ?></td>

<?php if($ptype=="in"){ ?>
<td style="text-align: center; font-size: 12px; color: <?php echo $ecol ?>;"><?php echo $dateadmit ?></td>
<td style="text-align: center; font-size: 12px; color: <?php echo $ecol ?>;"><?php echo $ddischarged ?></td>
<?php } else { ?>
<td style="text-align: center; font-size: 12px; color: <?php echo $ecol ?>;"><?php echo $dateadmit ?></td>
<?php } ?>

<td style="text-align: center; font-size: 12px; color: <?php echo $ecol ?>;"><?php echo $loa ?></td>
<td style="text-align: center; font-size: 12px; color: <?php echo $ecol ?>;"><?php echo $actual ?></td>
<td style="text-align: center; font-size: 12px; color: <?php echo $ecol ?>;"><?php echo $philh ?></td>
<td style="text-align: center; font-size: 12px; color: <?php echo $ecol ?>;"><?php echo $p_excess ?></td>
<td style="text-align: center; font-size: 12px; color: <?php echo $ecol ?>;"><?php echo $hmopf ?></td>
<td style="text-align: center; font-size: 12px; color: <?php echo $ecol ?>;"><?php echo $hmohosp ?></td>
<td style="text-align: center; font-size: 12px; color: <?php echo $ecol ?>;"><?php echo $hmobill ?></td>
<td style="text-align: center; font-size: 12px; color: <?php echo $ecol ?>;"><?php echo $final_excess ?></td>
</tr>
<?php } 

$t_actual = number_format($t_actual,2);
$t_philh = number_format($t_philh,2);
$t_pexcess = number_format($t_pexcess,2);
$t_hmopf = number_format($t_hmopf,2);
$t_hmohosp = number_format($t_hmohosp,2);
$t_hmobill = number_format($t_hmobill,2);
$t_final_excess = number_format($t_final_excess,2);
?>

<tr>
<td></td>
<td style="text-align: center; font-size: 12px;"><font color="blue">* GRAND TOTAL *</td>
<?php if($ptype=="in"){ ?>
<td style="text-align: center; font-size: 12px;"></td>
<td style="text-align: center; font-size: 12px;"></td>
<?php } else { ?>
<td style="text-align: center; font-size: 12px;"></td>
<?php } ?>
<td style="text-align: center; font-size: 12px;"><font color="blue"></td>
<td style="text-align: center; font-size: 12px;"><font color="blue"><?php echo $t_actual ?></td>
<td style="text-align: center; font-size: 12px;"><font color="blue"><?php echo $t_philh ?></td>
<td style="text-align: center; font-size: 12px;"><font color="blue"><?php echo $t_pexcess ?></td>
<td style="text-align: center; font-size: 12px;"><font color="blue"><?php echo $t_hmopf ?></td>
<td style="text-align: center; font-size: 12px;"><font color="blue"><?php echo $t_hmohosp ?></td>
<td style="text-align: center; font-size: 12px;"><font color="blue"><?php echo $t_hmobill ?></td>
<td style="text-align: center; font-size: 12px;"><font color="blue"><?php echo $t_final_excess ?></td>
</tr>
</tbody>
</table>


</div>
</div>
</div>
</div>
</section>
</main>
<!--?php include "../main/modaldel.php"; ?-->
