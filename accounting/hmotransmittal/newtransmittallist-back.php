<?php
$hmo = $_GET['hmo'];
$transdate = $_GET['transdate'];
$transdate2 = date("F d, Y", strtotime($transdate));
$batchno = $_GET['batchno'];
$ptype = $_GET['ptype'];
$ttype = $_GET['ttype'];
list($hmocode, $hmoname) = explode("||", $hmo);
$datax2="&batchno=$batchno&hmo=$hmo&transdate=$transdate&ptype=$ptype&ttype=$ttype";

if($ptype=="in"){$patienttype = "IN-PATIENT"; $qryz = "and a.caseno like '%I-%'";}
elseif($ptype=="in"){$patienttype = "OUT-PATIENT"; $qryz = "and a.caseno not like '%I-%'";}
else{$patienttype = "ALL"; $qryz = "";}

if(isset($_POST['btnsave'])){
$caseno=$_POST['caseno'];
$amount=$_POST['amount'];
$gl_id=$_POST['gl_id'];
$origamount=$_POST['origamount'];
$refno = "RN".date("YmdHis");


$ck = $conn->query("select * from arv_tbl_hmotransmittallist where batchno='$batchno' and caseno='$caseno' and status='pending'");
if(mysqli_num_rows($ck)>0){$conn->query("delete from arv_tbl_hmotransmittallist where batchno='$batchno' and caseno='$caseno' and status='pending'");}


$sql1="INSERT INTO `arv_tbl_hmotransmittallist`(`refno`, `batchno`, `caseno`, `idhmo`, `company`, `amount`, `origamount`, `transaction`, `status`, `user`, `transdate`, `datearray` , `ptype`, `trantype`, `chequeno`) VALUES ('$refno', '$batchno', '$caseno', '$hmocode', '$hmoname', '$amount', '$origamount', 'requesting', 'pending', '$user', '$transdate', CURDATE(), '$ptype', '$ttype', '$gl_id')";
if($conn->query($sql1) === TRUE) {echo"<script>alert('Saved....');</script>";}
echo"<script>window.location='?newtransmittallist$datax2'</script>";
}


if(isset($_POST['btndel'])){
$code=$_POST['code'];
$sql1="DELETE FROM arv_tbl_hmotransmittallist WHERE autono='$code'";
if($conn->query($sql1) === TRUE) {echo"<script>alert('Deleted....');</script>";}
echo"<script>window.location='?newtransmittallist$datax2'</script>";
}


if(isset($_POST['btnpost'])){
$controlno=$_POST['controlno'];
$sql1="update arv_tbl_hmotransmittallist set transaction = 'Approved', controlno = '$controlno' where batchno = '$batchno'";
if($conn->query($sql1) === TRUE){
    $dd = $conn->query("select * from arv_tbl_hmotransmittallist where transaction = 'Approved' and controlno = '$controlno' and batchno = '$batchno' and chequeno!=''");
    while($dd1 = $dd->fetch_assoc()){$conn->query("update gl_posting set status='transmitted' where gl_id='$dd1[chequeno]' and gl_type='debit'");}

    echo"<script>alert('Successfully Submit!'); window.location='?view=newtransmittal$datax'</script>";

}else{echo"<script>alert('Unable to process transaction!'); window.location='?newtransmittallist$datax2'</script>";}
}
?>

<body onload="aa('');">
<main id="main" class="main">

<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?view=main">Main</a></li>
<li class="breadcrumb-item"></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">

<div class="card">
<div class="card-body">

<h5><font color="black"><i class='icofont-users'></i> NEW TRANSMITTAL</h5><hr>

<table width="100%"><tr>
<td width="60%" valign="TOP">

<table width="70%"><tr>
<td valign="TOP">
<div class="input-group mb-3" valign="bottom">
<span class="input-group-text" id="basic-addon1"><i class="icofont-search-2"></i></span>
<input type="text" class="form-control" name="search_text" id="search_text" onchange="aa(this.value)" placeholder="Search Patient [Enter]">
</div>
</td>
</tr></table>

<div class='card' style="min-height: 400px;"><div id="result"></div></div>

</td>
<td width="2%"></td><td valign="TOP">

<!--div id="included-content"></div-->
<?php
$ddate = date('mdY');
echo"
<div class='card'>
<div class='card-header py-3'>

<form method='POST'>
<table width='100%'>
<tr>
<td>Control Number:</td>
<td width='40%'><input type='text' name='controlno' value='$ddate'></td>
<td width='10%'><button class='btn btn-primary btn-sm' type='submit' name='btnpost'>POST</button></td>
</tr>
</table>
</form>
<hr>
<table align='center' width='95%'>
<tr>
<td width='50%' style='font-size: 12px;'><i class='icofont-institution'></i> $hmoname</td>
<td style='font-size: 12px;'><i class='icofont-numbered'></i> $batchno</td>
</tr>
<tr>
<td style='font-size: 12px;'><i class='icofont-ui-calendar'></i> $transdate2</font></td>
<td style='font-size: 12px;'><i class='icofont-native-american'></i> $patienttype</td>
</tr>
</table>
<hr>
</div>
<div class='card-body'>
";

$i = 0;
$sql33= $conn->query("SELECT * FROM arv_tbl_hmotransmittallist ar left join admission a on ar.caseno=a.caseno left join patientprofile p on a.patientidno=p.patientidno 
WHERE ar.batchno='$batchno'");
while($item=$sql33->fetch_assoc()){
$ptname = $item['patientname'];
$amm = $item['amount'];
$amm2 = number_format($amm, 2);
$i++;
echo"
<div class='timeline-item ti-danger border-bottom ms-2'>
<div class='d-flex' style='width: 100%;'>
<span class='avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg'>$i</span>
<div class='flex-fill ms-3'>
<div class='mb-1'><strong><font size='2px' color='#5A91DC'>$ptname</font></strong></div>

<table width='100%'>
<tr>
<td style='font-size:15px; color: red;' valign='TOP' width='95%'><i class='icofont-peso'></i> $amm2</td>
<td style='font-size:10px;' valign='TOP'>
<form method='POST'>
<button type='submit' class='btn btn-danger btn-sm' name='btndel' style='font-size: 9px; color: white; padding: 3px;'><i class='icofont-trash'></i></button>
<input type='hidden' name='code' value='$item[autono]'>
</form>
</td>
</tr>
</table>
</font>

</div>
</div>
</div> <!-- timeline item end  -->
";
}
?>

</div>
</div>

</td></tr></table>




<script>
function aa(str){
//var str = document.getElementById('search_text').value;
var hmo = "<?php echo $hmo ?>";
var ttype = "<?php echo $ttype ?>";
var ptype = "<?php echo $ptype ?>";
$.get("../accounting/hmotransmittal/newtransmittallistfetch.php", {str:str, hmo:hmo, ttype:ttype, ptype:ptype},
function (data) {$("#result").html(data);});

document.getElementById("included-content").innerHTML="";
}
</script>



</div>
</div>

</div>
</div>
</section>

</main>
