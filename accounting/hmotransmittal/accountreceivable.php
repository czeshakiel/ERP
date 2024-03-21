<?php
$batchnox = "V".date("YmdHis");
if($dept=="HMO"){$hidden="";}else{$hidden="hidden";}

if($dept=="HMO"){$status="pending";}else{$status="FOR OR";}

if(isset($_POST['submit'])){
$batchno = $_POST['batchno'];
$transdate = $_POST['transdate'];
$hmo = $_POST['hmo'];
$ttype = $_POST['ttype'];
$discount = $_POST['discount'];
$vat = $_POST['vat'];
echo"<script>window.location='?hmoacctreceivabledetails&batchno=$batchno&transdate=$transdate&hmo=$hmo&ttype=$ttype&discount=$discount&vat=$vat';</script>";
}
?>

<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">
<table width="100%"><tr><td>
<font color="black"><b><i class="bi bi-credit-card-2-back"></i> ACCOUNT RECEIVABLE HMO</b></font>
</td><td align="right">

<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#requestreturn2" <?php echo $hidden ?>><i class="icofont-plus-circle"></i> New Transmittal</button>
</td></tr></table><hr>


<table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
<thead>
<tr>
<th class="text-center">#</th>
<th class="text-center">Company/Trantype</th>
<th class="text-center">Voucher Number/<br> User</th>
<th class="text-center">Amount</th>
<th class="text-center">Date</th>
<th class="text-center">Stat</th>
<th class="text-center"></th>
</tr>
</thead>
<tbody>


<?php
$i = 0;
$sql4 = "select sum(amount) as amount, batchno, transdate, user, company, controlno, idhmo, trantype, ptype, voucherno, datetrans, status, discount, vat, caseno
from arv_tbl_hmotransmittallist where voucherno!='' and status='$status' group by voucherno";
$result4 = $conn->query($sql4);
while($row4 = $result4->fetch_assoc()) {
$batchno=$row4['batchno'];
$voucher=$row4['voucherno'];
$amount=$row4['amount'];
$amount2=number_format($row4['amount'], 2);
$transdate=date("F d, Y", strtotime($row4['transdate']));
$userx=$row4['user'];
$company=$row4['company'];
$idhmo=$row4['idhmo'];
$controlno=$row4['controlno'];
$trantype=$row4['trantype'];
$ptype=$row4['ptype'];
$datetrans=$row4['datetrans'];
$status=$row4['status'];
$discount=$row4['discount'];
$vat=$row4['vat'];
$caseno=$row4['caseno'];
$hmo = $idhmo."||".$company;
$i++;

$ispaid=0; $count=0;
$sql44 = $conn->query("select count(controlno) as cc from arv_tbl_hmotransmittallist where voucherno='$voucher'");
while($row44 = $sql44->fetch_assoc()) {$count = $row44['cc'];}

if($trantype=="insurance"){$dist = "processingdetails";}else{$dist = "processingdetailsassist";}

if($status=="pending" or $status=="FOR OR"){
$btn = "<a href='?hmoacctreceivabledetails&batchno=$voucher&transdate=$datetrans&hmo=$hmo&ttype=$trantype&discount=$discount&vat=$vat'><button class='btn btn-primary btn-sm'><i class='icofont-eye'></i></button></a>";
}else{
$btn = "";
}
echo"
<tr>
<td style='font-size:12px;'>$i</td>
<td style='font-size:12px;'>$company<br>$trantype ($ptype)</td>
<td style='font-size:12px;'>$voucher<br>$userx</td>
<td style='font-size:12px;'>$amount2</td>
<td style='font-size:12px;'>$transdate</td>
<td style='font-size:12px;'>$count patient/s</td>
<td>$btn</td>
</tr>
";
  }  
  
  ?>
</tbody>
</table>

        

</div>
</div>
</div>
</div>
</section>
</main>


<!-------------------------------------------- RETURN MED/SUP ------------------------------------------->
<?php
if(isset($_POST['submit'])){
$transdate=$_POST['transdate'];
$hmo=$_POST['hmo'];
$ptype=$_POST['ptype'];
$ttype=$_POST['ttype'];
$batchno=$_POST['batchno'];
echo"<script>window.location='?newtransmittallist&batchno=$batchno&transdate=$transdate&hmo=$hmo&ptype=$ptype&ttype=$ttype';</script>";
}
?>

<div class="modal fade" id="requestreturn2" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog" style="box-shadow: 0px 0px 2000px #6e7fcb;">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> NEW TRANSMITTAL</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">


<form role="form" name="f1"  method="POST" onSubmit="return submitPO();">
<input type="hidden" name="view" value="accountreceivablelist">
<input type="hidden" name="username" value="<?php echo $user ?>">
<input type="hidden" name="userunique" value="<?php echo $userunique ?>"> 	
<input type="hidden" name="dept" value="<?php echo $dept ?>"> 
<input type="hidden" name="branch" value="<?php echo $branch ?>">



<table width="100%" align="center">
<tr>
<td width="30%"><font color="black">Voucher:</td>
<td><input  name='batchno' name='id' type='text' value='<?php echo $batchnox ?>' class='form-control'></td>
</tr>
<tr>
<td><font color="black">Transaction Date:</td>
<td><input  name='transdate' type='date' value="<?php echo date('Y-m-d'); ?>" class='form-control' required></td>
</tr>
<tr>
<td><font color="black">User:</td>
<td><input name='user2' type='text' value='<?php echo $user ?>' class='form-control' readonly></td>
</tr>
<tr>
<td><font color="black">HMO-Company:</td>
<td>
<select name="hmo" class="form-select" id="supplier" required>
<option value="">SELECT Company</option>
<?php												
$sqlm = "SELECT * from company order by companyname";
$resultm = $conn->query($sqlm);
while($rowm = $resultm->fetch_assoc()) {
$company=$rowm['acctno']."||".$rowm['companyname'];
echo"<option value='$company'>$rowm[companyname]</option>";
} ?>
</select>
</td>
</tr>

<tr>
<td><font color="black">Transaction Type:</td>
<td>
<select name="ttype" class="form-select" required>
<option value="insurance">INSURANCE</option>
<option value="assistance">ASSISTANCE</option>
</select>
</td>
</tr>
<tr>
<td><font color="black">Discount:</td>
<td><input name='discount' type='text' value='' class='form-control'></td>
</tr>
<tr>
<td><font color="black">Vat:</td>
<td><input name='vat' type='text' value='' class='form-control'></td>
</tr>
<tr>
<td colspan="2" style="text-align: right;"><input type="submit" name="submit" value="SUBMIT" class="btn btn-primary" ></td>
</tr>
</table> <br>
</form> 


</div>
</div> 
</td></tr></table> 




</div>
</div>
</div>
</div>
<!---------------------------------------- END RETURN MED/SUP ------------------------------------------->


<script>
function changebg(val){

for (let i = 1; i <= 2; i++) {
var text="";
text += "pp" + i;
document.getElementById(text).style="";
} 
document.getElementById(val).style="background: #5a6495; color: white; border-color: #f44336;";
}
</script>