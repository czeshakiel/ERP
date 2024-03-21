<?php
$batchno = "V".date("YmdHis");

if(isset($_POST['submit'])){
$batchno = $_POST['batchno'];
$transdate = $_POST['transdate'];
$hmo = $_POST['hmo'];
$ttype = $_POST['ttype'];
echo"<script>window.location='?hmoacctreceivabledetails&batchno=$batchno&transdate=$transdate&hmo=$hmo&ttype=$ttype';</script>";
}
?>
<div class="col-lg-12" style="width: 100%;">
<div class="card mb-4">
<div class="table-responsive p-3">

 
<table width="50%">
<tr><td> 

<div class="card" style='box-shadow: 0px 0px 0px 1px #4B54B2;'>
<div class="card-header" style="background-color: #4B54B2; padding: 7px; color: white;">
<i class="bi bi-award"></i> ACCOUNT RECEIVABLE/ VOUCHER RECIEVED
</div>
<div class="card-body">

<form role="form" name="f1"  method="POST" onSubmit="return submitPO();">
<input type="hidden" name="view" value="accountreceivablelist">
<input type="hidden" name="username" value="<?php echo $user ?>">
<input type="hidden" name="userunique" value="<?php echo $userunique ?>"> 	
<input type="hidden" name="dept" value="<?php echo $dept ?>"> 
<input type="hidden" name="branch" value="<?php echo $branch ?>">



<table width="100%" align="center">
<tr>
<td width="30%"><font color="black">Voucher:</td>
<td><input  name='batchno' name='id' type='text' value='<?php echo $batchno ?>' class='form-control'></td>
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
<select name="hmo" class="select2-single form-control" id="supplier" required>
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
<select name="ttype" class="select2-single form-control" required>
<option value="insurance">INSURANCE</option>
<option value="assistance">ASSISTANCE</option>
</select>
</td>
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
