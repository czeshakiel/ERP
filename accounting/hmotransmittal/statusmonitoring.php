<?php
$batchno = "HMO".date("YmdHis");
$mm = date("m");
$yy = date("Y");

if(isset($_POST['submit'])){
$hmo = $_POST['hmo'];
$ttype = $_POST['ttype'];
$yy = $_POST['yy'];
echo"<script>window.location='?statusmonitoringdetail&yy=$yy&hmo=$hmo&ttype=$ttype';</script>";
}
?>

<div class="col-lg-12" style="width: 100%;">
<div class="card mb-4">
<div class="table-responsive p-3">

 
<table width="40%">
<tr><td> 


<div class="card" style='box-shadow: 0px 0px 0px 1px #4B54B2;'>
<div class="card-header" style="background-color: #4B54B2; padding: 7px; color: white;">
<i class="bi bi-award"></i> TRANSMITTAL LIST
</div>
<div class="card-body">

<form role="form" name="f1" method="POST" onSubmit="return submitPO();">
<input type="hidden" name="view" value="processing2">
<input type="hidden" name="username" value="<?php echo $user ?>">
<input type="hidden" name="userunique" value="<?php echo $userunique ?>"> 	
<input type="hidden" name="dept" value="<?php echo $dept ?>"> 
<input type="hidden" name="branch" value="<?php echo $branch ?>">



<table width="100%" align="center">
<tr>
<td width="35%"><font color="black">Year:</td>
<td>
<select id="yy" name="yy" class="form-select">
<?php for($i=$yy; $i>2015; $i--){echo "<option value='$i'>$i</option>"; } ?>
</select>
</td>
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
