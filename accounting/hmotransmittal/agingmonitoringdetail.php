<?php
$vdate = $_GET['vdate'];
$hmo = $_GET['hmo'];
$ttype = $_GET['ttype'];
list($yy, $mm, $dd) = explode("-", $vdate);
$dfrom = $yy."-".$mm."-01";

list($hmocode, $hmoname) = explode("||", $hmo);
?>

<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?agingmonitoring">Aging Monitoring</a></li>
<li class="breadcrumb-item active"><a href="">Aging Monitoring Details</a></li>
</ol>
</nav>
</div><!-- End Page Title -->


<div class="col-lg-12" style="width: 100%;">
<div class="card mb-4">
<div class="table-responsive p-3">

 <h5><b><?php echo $hmoname ?></b> AS OF <?php echo strtoupper(date("F d, Y", strtotime($vdate))) ?></h5><hr>
<table class="table table-hover align-middle mb-0 tablex" style="width:100%">
<thead>
<tr>
<th>#</th>
<th>CASENO</th>
<th>NAME</th>
<th>Date<br>Discharged</th>
<th>Date<br>Transmittal</th>
<th>Amount</th>
<th>Current</th>
<th>30 days</th>
<th>60 days</th>
<th>90 days</th>
<th>120 days up</th>
<th>Remarks</th>
</tr>
</thead>
<tbody>
<?php

$datetransmittal = ""; $datepayment=""; $i=0;
$sql3 = $conn->query("select * from arv_tbl_hmotransmittallist where transdate between '$dfrom' and '$vdate' and (idhmo='$hmocode' or company='$hmoname')");
while($result3 = $sql3->fetch_assoc()){
    $datetransmittal = $result3['transdate'];
    $datepayment = $result3['datereceived'];
    $caseno = $result3['caseno'];
    $amount = $result3['amount'];
    $i++;

    $sql = $conn->query("select a.caseno, a.dateadmit, p.patientname from admission a, patientprofile p where a.patientidno=p.patientidno and a.caseno='$caseno'");
    while($result = $sql->fetch_assoc()){
        $ptname = $result['patientname'];
        $dateadmit = $result['dateadmit'];
    }

    $datedischarged = $dateadmit;
    $sql2 = $conn->query("select * from dischargedtable where caseno='$caseno'");
    if(mysqli_num_rows($sql2)==0){$sql2 = $conn->query("select * from arv_tbl_hmofinalize where caseno='$caseno'");}
    while($result2 = $sql2->fetch_assoc()){$datedischarged = $result2['datearray'];}

    $totalpf=0;
    $ff = $conn->query("select sum(hmo) as totalpf from productout where caseno='$caseno' and productsubtype='PROFESSIONAL FEE'");
    while($ff1 = $ff->fetch_assoc()){$totalpf = $ff1['totalpf'];}
    $amount = $amount-$totalpf;

$col="";
// ------------ get age ------
$date1 = strtotime($datedischarged);
$date2 = strtotime($datetransmittal);
$interval = $date2 - $date1;
$days = floor($interval / (60 * 60 * 24));

$totalamount+=$amount;
if($days<30){$current = number_format($amount,2); $totalcurrent+=$amount;}
elseif($days<60){$tri = number_format($amount,2); $totaltri+=$amount;}
elseif($days<90){$six = number_format($amount,2); $totalsix+=$amount;}
elseif($days<120){$nine = number_format($amount,2); $totalnine+=$amount;}
elseif($days>=120){$up = number_format($amount,2); $totalup+=$amount;}


$date1 = explode("-", $datedischarged);

if(strpos($caseno, "AR-")!==false){
$ptname = "
<a href='../accounting/hmotransmittal/chargesdetail.php?caseno=$caseno' target='iframex' onclick='cclick();'>$ptname</a>
<button type='button' id='idcanceladministered' data-bs-toggle='modal' data-bs-target='#requestreturn2' hidden>My Button</button>
";
}else{
$userx = base64_encode($userunique);
$ptname = "
<a href='../extra/SOA/?caseno=$caseno&user=$userx&dept=$dept' target='_blank'>$ptname</a>
<!--a href='../extra/SOA/?caseno=$caseno&user=YXJ2aWQxMjM=&dept=$dept' target='_blank'>$ptname</a-->
";   
}



echo"
<tr>
<td style='font-size:11px;'>$i</td>
<td style='font-size:11px;'>$caseno</td>
<td style='font-size:11px;'>$ptname</td>
<td style='font-size:11px; color:$col;'>$datedischarged</td>
<td style='font-size:11px;'>$datetransmittal</td>
<td style='font-size:11px;'>$amount</td>
<td style='font-size:11px;'>$current</td>
<td style='font-size:11px;'>$tri</td>
<td style='font-size:11px;'>$six</td>
<td style='font-size:11px;'>$nine</td>
<td style='font-size:11px;'>$up</td>
<td style='font-size:11px;'></td>
</tr>
";

}

$totalamount2 = number_format($totalamount,2);
$totalcurrent2 = number_format($totalcurrent,2);
$totaltri2 = number_format($totaltri,2);
$totalsix2 = number_format($totalsix,2);
$totalnine2 = number_format($totalnine,2);
$totalup2 = number_format($totalup,2);
echo"
<tr>
<td style='font-size:11px;'></td>
<td style='font-size:11px;'></td>
<td style='font-size:11px;'></td>
<td style='font-size:11px; color:$col;'></td>
<td style='font-size:11px;'>TOTAL</td>
<td style='font-size:11px;'><b>$totalamount2</td>
<td style='font-size:11px;'><b>$totalcurrent2</td>
<td style='font-size:11px;'><b>$totaltri2</td>
<td style='font-size:11px;'><b>$totalsix2</td>
<td style='font-size:11px;'><b>$totalnine2</td>
<td style='font-size:11px;'><b>$totalup2</td>
<td style='font-size:11px;'></td>
</tr>
";
echo"</tbody></table>";
?>
        

</div>
</div>
</div>




<!-------------------------------------------- RETURN MED/SUP ------------------------------------------->
<div class="modal fade" id="requestreturn2" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog modal-lg" style="box-shadow: 0px 0px 2000px #6e7fcb;">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> CHARGES DETAILS</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">


<table width="100%" align="center"><tr><td style="text-align: left;">
<iframe name='iframex' id='iframex' style="position: relative; width: 100%; height: 400px; border: none;" src=""></iframe>
</td><tr></table>

</div>
</div>
</div>
</div>
<!---------------------------------------- END RETURN MED/SUP ------------------------------------------->

<script>
function cclick(){document.getElementById('idcanceladministered').click();}
</script>