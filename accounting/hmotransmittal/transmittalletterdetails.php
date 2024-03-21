<?php
include "../../main/connection.php";
//include "../../main/functions.php";
$batchno = $_GET['batchno'];
$hmon = $_GET['hmo'];
list($hmoc, $hmonn) = explode("_", $hmon);
$controlno = $_GET['controlno'];
$transdate = date("F d, Y", strtotime($_GET['transdate']));
?>

<table><tr><td>
<div class="sidebar-brand-icon">
<img src="../../main/img/logo/mmshi.png" width="60px">
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
<tr>
<th class="text-center" style="">#</th>
<th class="text-center" style="">NANE OF PATIENT</th>
<th class="text-center" style="">CONFINEMENT</th>
<th class="text-center" style="">ACTUAL</th>
<th class="text-center" style="">LAB TEST</th>
<th class="text-center" style="">DATE REPORTED</th>
</tr>
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

$sql2 = $conn->query("select * from dischargedtable where caseno='$caseno'");
if(mysqli_num_rows($sql2)==0){$sql2 = $conn->query("select * from arv_tbl_hmofinalize where caseno='$caseno'");}
while($result2 = $sql2->fetch_assoc()){$datedischarged = $result2['datearray'];}


?>
<tr>
<td bgcolor="<?php echo $col ?>" style="text-align: center;"><font color="blue"><font size="2"><?php echo $i ?></td>
<td bgcolor="<?php echo $col ?>" style="text-align: center;"><font color="<?php echo $ecol ?>" size="2"><?php echo $patientname ?></td>
<td bgcolor="<?php echo $col ?>" style="text-align: center;"><font color="<?php echo $ecol ?>" size="2"><?php echo $dateadmit ?></td>
<td bgcolor="<?php echo $col ?>" style="text-align: center;"><font color="<?php echo $ecol ?>" size="2"><?php echo $actual ?></td>
<td bgcolor="<?php echo $col ?>" style="text-align: center;"><font color="<?php echo $ecol ?>" size="2">
<?php
$sql44 = "select sum(hmo) as amountc, productdesc from productout where caseno='$caseno' and quantity>0 and trantype='charge' group by productdesc";
$result44 = $conn->query($sql44);
while($row44 = $result44->fetch_assoc()) {
$amountc = $row44['amountc'];
$productdesc = $row44['productdesc'];
if($amountc > 0){echo "$productdesc ($amountc) &nbsp;";}
}
?>
</td>
<td bgcolor="<?php echo $col ?>" style="text-align: center;"><font color="<?php echo $ecol ?>" size="2"><?php echo $datedischarged ?></td>
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
<td style="text-align: center;"></td>
<td style="text-align: center;"><?php echo $t_actual ?></td>
<td style="text-align: center;"><font color="blue"></td>
<td style="text-align: center;"><font color="blue"></td>
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
<td><u>MARIAN GRACE G. PUERTO</u></td>
<td><u>VON ANTHONY V. QUEZON</u></td>
<td>_______________________</td>
</tr>
<tr>
<td>&nbsp; &nbsp; &nbsp; &nbsp;HMO-CLERK</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HMO-HEAD</td>
<td></td>
</tr>
</table>

