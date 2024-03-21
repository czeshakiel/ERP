<?php
if(isset($_POST['reviewreq'])){
$case = $_POST['caseno'];
$ofr = $_POST['ofr'];
?>
<script>
window.open('../reviewreturn.php?caseno=<?php echo $case ?>&ofr=<?php echo $ofr ?>', '_blank');
</script>
<?php
}
?>



<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?requestreturn">Processing for Refund</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<table width="100%"><tr><td><b><i class="bi bi-credit-card-2-back"></i> CREDIT MEMO</b></font>
</td><td align="right">

<a href='../pharmacy/requestreturn2.php' target='tabiframerequestreturn2'><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#requestreturn2" style="background: #0b3056; color: white;"><i class="icofont-check-circled"></i> Create Transaction</button></a>
</td></tr></table><hr>
<table id="patient-table" class="table table-hover align-middle mb-0" width="100%">
<thead>
<tr>
<th class="text-center">#</th>
<th class="text-center">Patient Information</th>
<th class="text-center">Orno and Refno</th>
<th class="text-center">Date/Time Request</th>
<th class="text-center">Requested User with<br> Total Amount</th>
<th></th>
</tr>
</thead>
<?php
$i=0; $amount=0; $datenow = date("Y-m-d");
$sqlyy = "SELECT * FROM requestreturn where status='Finalized' and reqdept='$dept' and datetimereq like '$datenow%%' group by transid, caseno order by caseno";
$resultyy = $conn->query($sqlyy);
while($rowyy = $resultyy->fetch_assoc()) {
$caseno = $rowyy['caseno'];
$transid = $rowyy['transid'];
$ofrxx = $rowyy['ofr'];
$requser= $rowyy['requser'];
$datetimereq = $rowyy['datetimereq'];
list($datereq, $timereq) = explode(" ", $datetimereq);
$datereq = date("F d, Y", strtotime($datereq));
$timereq = date("h:i:s a", strtotime($timereq));
$total =+ $rowyy['amount'];
$i++;
//$sqljj = "select * from collection where acctno='$caseno'";
$sqljj = "select * from admission, patientprofile where admission.patientidno=patientprofile.patientidno and admission.caseno='$caseno'";
$resultjj = $conn->query($sqljj);
$totc = mysqli_num_rows($resultjj);
while($rowjj = $resultjj->fetch_assoc()) {
//$acctname = $rowjj['acctname'];
$lname = $rowjj['lastname'];
$fname = $rowjj['firstname'];
$mname = $rowjj['middlename'];
$acctname = $lname.", ".$fname." ".$mname;
$sex = $rowjj['sex'];
}

if($totc<=0){
$sqljj = "select * from admission, nsauthemployees where admission.patientidno=nsauthemployees.empid and admission.caseno='$caseno'";
$resultjj = $conn->query($sqljj);
$totc2 = mysqli_num_rows($resultjj);
while($rowjj = $resultjj->fetch_assoc()) {
//$acctname = $rowjj['acctname'];
$lname = $rowjj['lastname'];
$fname = $rowjj['firstname'];
$mname = $rowjj['middlename'];
$acctname = $lname.", ".$fname." ".$mname;
$sex = $rowjj['sex'];
}
}

if($totc2<=0){
$sqljj = "select * from admission, patientprofilewalkin where admission.patientidno=patientprofilewalkin.patientidno and admission.caseno='$caseno'";
$resultjj = $conn->query($sqljj);
$totc2 = mysqli_num_rows($resultjj);
while($rowjj = $resultjj->fetch_assoc()) {
//$acctname = $rowjj['acctname'];
$lname = $rowjj['lastname'];
$fname = $rowjj['firstname'];
$mname = $rowjj['middlename'];
$sex = $rowjj['sex'];
$acctname = $lname.", ".$fname." ".$mname;
}
}
if($sex=="M"){$ge = "boy"; $sexcol ="blue";}else{$ge = "girl"; $sexcol ="#F309B6";}
echo"
<tr>
<td align='center' style='color: $colx; font-size: 11px;'>$i.</td>
<td bgcolor='$col' style='color: $colx; font-size: 11px;'><table><tr><td><img src='../main/img/$ge.png' width='30' height='30' style='border-radius: 50%;'></td><td> $caseno<br><b>$acctname</b></td></tr></table></td>
<td style='color: $colx; font-size: 11px;'><font color='gray'>OR No.:</font> $ofrxx<br><font color='gray'>Refno:</font> $transid</td>
<td style='color: $colx; font-size: 11px;'><font color='gray'>Date:</font> $datereq<br><font color='gray'>Time:</font> $timereq</td>
<td style='color: $colx; font-size: 11px;'><font color='gray'>User:</font> $requser<br><font color='gray'>Total Amount:</font> $total</td>
<td align='center'><a href='../resultform/ticket_return.php?caseno=$caseno&transid=$transid&user=$user' target='_blank'><button class='btn btn-outline-primary btn-sm'><i class='icofont-printer'></i></button></a></td>
</tr>
";
}
?>
</table>

</div>
</div>
</div>
</div>
</section>
</main>




<!-------------------------------------------- RETURN MED/SUP ------------------------------------------->
<div class="modal fade" id="requestreturn2" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog modal-xl" style="box-shadow: 0px 0px 2000px #6e7fcb;">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><b><i class="icofont-pixels"></i> PREPARING FOR REFUND</b></h5>
<button type="button" class="btn-close" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">

<table width="100%" align="center"><tr><td style="text-align: left;">
<iframe id='tabiframe2' name='tabiframerequestreturn2' src='' width='100%' height='600px' style="border:none;"></iframe>
</td><tr></table>

</div>
</div>
</div>
</div>
<!---------------------------------------- END RETURN MED/SUP ------------------------------------------->

<script>
function aaa(){
var ifr = document.getElementsByName('tabframex')[0];
ifr.src = ifr.src;
}
</script>

