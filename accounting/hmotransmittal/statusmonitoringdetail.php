<?php
$yy = $_GET['yy'];
$hmo = $_GET['hmo'];
$ttype = $_GET['ttype'];

list($hmocode, $hmoname) = explode("||", $hmo);
?>

<div class="col-lg-12" style="width: 100%;">
<div class="card mb-4">
<div class="table-responsive p-3">

 <h5><?php echo $hmo ?></h5><hr>
<table id="myProjectTable" class="table table-hover align-middle mb-0 tablex" style="width:100%">
<thead>
<tr>
<th>#</th>
<th>CASENO</th>
<th>NAME</th>
<th>Date<br>Discharged</th>
<th>Date<br>Transmittal</th>
<th>Date of<br>Payment</th>
<th>Aging from<br>Discharged to<br>Transmittal</th>
<th>Aging from<br>Transmittal to<br>Payment</th>
</tr>
</thead>
<tbody>
<?php
if($ttype=="insurance"){
$sql = $conn->query("select a.caseno, a.dateadmit, p.patientname from admission a, patientprofile p where a.patientidno=p.patientidno and a.hmo='$hmoname'");
}else{
$sql = $conn->query("select a.caseno, a.dateadmit, p.patientname from admission a, patientprofile p, collection c where a.patientidno=p.patientidno and a.caseno=c.acctno and c.accttitle like '%$hmoname%'");    
}
$i=0;
while($result = $sql->fetch_assoc()){
$caseno = $result['caseno'];
$ptname = $result['patientname'];
$dateadmit = $result['dateadmit'];

$datedischarged = "";
$sql2 = $conn->query("select * from dischargedtable where caseno='$caseno'");
if(mysqli_num_rows($sql2)==0){$sql2 = $conn->query("select * from arv_tbl_hmofinalize where caseno='$caseno'");}
while($result2 = $sql2->fetch_assoc()){$datedischarged = $result2['datearray'];}

$datetransmittal = ""; $datepayment="";
$sql3 = $conn->query("select * from arv_tbl_hmotransmittallist where caseno='$caseno'");
while($result3 = $sql3->fetch_assoc()){$datetransmittal = $result3['transdate']; $datepayment = $result3['datereceived'];}

$col="";
if(strpos($caseno, "AR-")!==false and $datedischarged==""){$datedischarged=$dateadmit; $col='green';}

$agedt="";
if($datedischarged!="" and $datetransmittal!=""){
// ------------ get age ------
$date1 = new DateTime($datedischarged);
$date2 = new DateTime($datetransmittal);
$interval = $date1->diff($date2);
$agedt =  $interval->y ."y, ".$interval->m."m, ".$interval->d."d";
// ---------------------------
}

$agetp="";
if($datetransmittal!="" and $datepayment!=""){
// ------------ get age ------
$date11 = new DateTime($datetransmittal);
$date22 = new DateTime($datepayment);
$interval2 = $date11->diff($date22);
$agetp =  $interval2->y ."y, ".$interval2->m."m, ".$interval2->d."d";
// ---------------------------
}

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


if($yy==$date1[0]){
    $i++;
echo"
<tr>
<td>$i</td>
<td>$caseno</td>
<td>$ptname</td>
<td style='color:$col;'>$datedischarged</td>
<td>$datetransmittal</td>
<td>$datepayment</td>
<td>$agedt</td>
<td>$agetp</td>
</tr>
";
}

}
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