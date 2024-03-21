<?php
$batchno = "HMO".date("YmdHis");
$mm = date("m");
$yy = date("Y");

if(isset($_POST['submit'])){
$mm = $_POST['mm'];
$dd = $_POST['dd'];
$yy = $_POST['yy'];
echo"<script>window.location='?transmittallistdetails&mm=$mm&dd=$dd&yy=$yy';</script>";
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
<td><font color="black">Transaction Type:</td>
<td>
<select id="mm" name="mm" style="height:30px; font-size:10pt; color: black; width: 30%;">
<?php for($x = 1; $x <= 12; $x++) {
$value = str_pad($x,2,"0",STR_PAD_LEFT);
$monthz = date("M", mktime(0, 0, 0, $value, 10));
if($mm==$value){echo "<option value='$value' selected>$monthz</option>";}else{echo "<option value='$value'>$monthz</option>";}
} ?>
</select> -

<select id="dd" name="dd" style="height:30px; font-size:10pt; color: black; width: 30%;">
<option value="05">05</option>
<option value="20">20</option>
</select> -

<select id="yy" name="yy" style="height:30px; font-size:10pt; color: black; width: 30%;">
<?php for($i=$yy; $i>2015; $i--){echo "<option value='$i'>$i</option>"; } ?>
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
