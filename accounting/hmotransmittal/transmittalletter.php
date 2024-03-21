
<?php
include "../../main/class.php";
$batchno = $_GET['batchno'];
$hmon = $_GET['hmo'];
list($hmoc, $hmonn) = explode("_", $hmon);
$controlno = $_GET['controlno'];
$transdate = date("F d, Y", strtotime($_GET['transdate']));


$sql4s = $conn->query("select * from arv_tbl_hmotransmittallist where batchno = '$batchno' group by batchno");
while($row4s = $sql4s->fetch_assoc()) {$ptype = $row4s['ptype'];}
?>

<table><tr><td>
<div class="sidebar-brand-icon">
<img src="<?php echo $ipadd ?>img/logo/mmshi.png" width="60px">
</div>
</td><td>
<p style="margin: 0px; pading: 0px;"><font color="black" size='4'><?php echo $heading ?></font></p>
<p style="margin: 0px; pading: 0px;"><font color="black" size='2'><?php echo $address ?></font></p>
<p style="margin: 0px; pading: 0px;"><font color="black" size='2'><?php echo $telno ?></font></p>
</td></tr></table>

<h4 align="center"><u>TRASMITTAL LETTER</u></h4>

<font color="black"><h5>Control Number - <?php echo $controlno ?>
<br><small>Date: <?php echo $transdate ?><br>
TO: CLAIMS DEPARTMENT <font color="red"><?php echo $hmonn ?></small></h5></font><hr>



<table border="1" width="100%" align="center" style="border-collapse: collapse;">
<thead>
<?php if($ptype=="in"){ ?>
<tr>
<th class="text-center">#</th>
<th class="text-center">NANE OF PATIENT</th>
<th class="text-center" colspan="2">CONFINEMENT</th>
<th class="text-center">ACTUAL</th>
<th class="text-center">MEDICARE</th>
<th class="text-center">EXCESS</th>
<th class="text-center">PF FEE</th>
<th class="text-center">HOSP. BILL</th>
<th class="text-center">HMO BILL</th>
<th class="text-center">TOTAL EXCESS</th>
</tr>
<tr>
<td></td>
<td></td>
<td align="center">FROM</td>
<td align="center">TO</td>
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
<th class="text-center">#</th>
<th class="text-center">NANE OF PATIENT</th>
<th class="text-center">CONFINEMENT</th>
<th class="text-center">ACTUAL</th>
<th class="text-center">MEDICARE</th>
<th class="text-center">EXCESS</th>
<th class="text-center">PF FEE</th>
<th class="text-center">HOSP. BILL</th>
<th class="text-center">HMO BILL</th>
<th class="text-center">TOTAL EXCESS</th>
</tr>

<?php } ?>
</thead>
<tbody>


<?php
$i = 0;
$sql4 = "select p.patientname, a.policyno, hmol.caseno, a.dateadmit from arv_tbl_hmotransmittallist hmol left join admission a on hmol.caseno=a.caseno join patientprofile p on a.patientidno=p.patientidno where hmol.batchno = '$batchno'";
$result4 = $conn->query($sql4);
while($row4 = $result4->fetch_assoc()) {
$patientname=$row4['patientname'];
$loa = $row4['policyno'];
$caseno = $row4['caseno'];
$dateadmit = $row4['dateadmit'];
$i++; $ecol="black";

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
?>
<tr>
<td bgcolor="<?php echo $col ?>" style="text-align: center;"><font color="blue"><font size="2"><?php echo $i ?></td>
<td bgcolor="<?php echo $col ?>" style="text-align: center;"><font color="<?php echo $ecol ?>" size="2"><?php echo $patientname ?></td>

<?php if($ptype=="in"){ ?>
<td bgcolor="<?php echo $col ?>" style="text-align: center;"><font color="<?php echo $ecol ?>" size="2"><?php echo $dateadmit ?></td>
<td bgcolor="<?php echo $col ?>" style="text-align: center;"><font color="<?php echo $ecol ?>" size="2"><?php echo $ddischarged ?></td>
<?php } else { ?>
<td bgcolor="<?php echo $col ?>" style="text-align: center;"><font color="<?php echo $ecol ?>" size="2"><?php echo $dateadmit ?></td>
<?php } ?>

<td bgcolor="<?php echo $col ?>" style="text-align: center;"><font color="<?php echo $ecol ?>" size="2"><?php echo $actual ?></td>
<td bgcolor="<?php echo $col ?>" style="text-align: center;"><font color="<?php echo $ecol ?>" size="2"><?php echo $philh ?></td>
<td bgcolor="<?php echo $col ?>" style="text-align: center;"><font color="<?php echo $ecol ?>" size="2"><?php echo $p_excess ?></td>
<td bgcolor="<?php echo $col ?>" style="text-align: center;"><font color="<?php echo $ecol ?>" size="2"><?php echo $hmopf ?></td>
<td bgcolor="<?php echo $col ?>" style="text-align: center;"><font color="<?php echo $ecol ?>" size="2"><?php echo $hmohosp ?></td>
<td bgcolor="<?php echo $col ?>" style="text-align: center;"><font color="<?php echo $ecol ?>" size="2"><?php echo $hmobill ?></td>
<td bgcolor="<?php echo $col ?>" style="text-align: center;"><font color="<?php echo $ecol ?>" size="2"><?php echo $final_excess ?></td>
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
<td style="text-align: center;"><font color="blue">* GRAND TOTAL *</td>
<?php if($ptype=="in"){ ?>
<td style="text-align: center;"></td>
<td style="text-align: center;"></td>
<?php } else { ?>
<td style="text-align: center;"></td>
<?php } ?>
<td style="text-align: center;"><font color="blue"><?php echo $t_actual ?></td>
<td style="text-align: center;"><font color="blue"><?php echo $t_philh ?></td>
<td style="text-align: center;"><font color="blue"><?php echo $t_pexcess ?></td>
<td style="text-align: center;"><font color="blue"><?php echo $t_hmopf ?></td>
<td style="text-align: center;"><font color="blue"><?php echo $t_hmohosp ?></td>
<td style="text-align: center;"><font color="blue"><?php echo $t_hmobill ?></td>
<td style="text-align: center;"><font color="blue"><?php echo $t_final_excess ?></td>
</tr>
</tbody>
</table>


<br><br>

<table width="100%">
<tr>
<td>Prepared by:</td>
<td>Verified by:</td>
<td>Received by:</td>
</tr>
<tr>
<td colspan="3">&nbsp;</td>
</tr>
<tr>
<td><u><?php echo $user ?></u></td>
<td><u>VON ANTHONY V. QUEZON</u></td>
<td>_______________________</td>
</tr>
<tr>
<td>HMO-CLERK</td>
<td>HMO-HEAD</td>
<td></td>
</tr>
</table>


