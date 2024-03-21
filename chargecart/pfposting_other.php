<?php
$sql2g = "SELECT * FROM admission, patientprofile where admission.patientidno=patientprofile.patientidno and admission.caseno='$caseno'";
$result2g = $conn->query($sql2g);
while($row2g = $result2g->fetch_assoc()) {
$lname=$row2g['lastname'];
$fname=$row2g['firstname'];
$mname=$row2g['middlename'];
$name = $lname.", ".$fname." ".$mname;
}



if(isset($_POST['btn_submit'])){
$doctor = $_POST['doctor'];
$services = $_POST['services'];
$phic = $_POST['phic'];
$hmo = $_POST['hmo'];
$disc = $_POST['disc'];
$pf = $_POST['pf'];
$round = $_POST['round'];

if($doctor==""){
echo"<script>alert('Please select Person!');</script>";
echo "<script>window.location='index.php?view=pfposting_other&caseno=$caseno$datax';</script>";
exit;
}
if($pf==""){
echo"<script>alert('Please provide PF amount!');</script>";
echo "<script>window.location='index.php?view=pfposting_other&caseno=$caseno$datax';</script>";
exit;
}
if($round==""){
echo"<script>alert('Please input round!');</script>";
echo "<script>window.location='index.php?view=pfposting_other&caseno=$caseno$datax';</script>";
exit;
}

$sql2 = "SELECT * FROM nsauthemployees where empid='$doctor'";
$result2 = $conn->query($sql2);
$rescount=mysqli_num_rows($result2);
if($rescount!=0){
while($row2 = $result2->fetch_assoc()) {
$docname=$row2['name'];
}
}
else{
$docname=$doctor;
}


$gross = $pf * $round;
if($senior == "Y" or $senior == "y" or $senior == "YES"){$lesssenior = $gross * .20;}else{$lesssenior = 0;}
$gross2 = $gross - $disc - $lesssenior;
$lessphic = $gross - $phic;
$lesshmo = $lessphic - $hmo;
$lessdisc = $lesshmo - $disc;
$lessdisc = $lessdisc - $lesssenior;
$excess = $lessdisc;
$disc = $disc + $lesssenior;
$refno = date("YmdHis");
$vdate = date("M-d-Y");
$batchno = "PF".$refno;
if($disc>0){$loc="discount";}else{$loc="0";}


//echo"<script>alert('CODE: $doctor DOC: $docname');</script>";
$sql7 = "INSERT INTO `productout`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`,
 `gross`, `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`,
 `approvalno`, `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`) VALUES
 ('$refno',CURTIME(),'$caseno','$doctor','$docname','$pf','$round','$disc','$gross2','charge','$phic','$hmo','$excess','$vdate','Approved',
 '','$user','$batchno','$services','PROFESSIONAL FEE','nurse-pf','','Approved','$branch','$loc',CURDATE(),'')";
if ($conn->query($sql7) === TRUE) {echo"<script>alert('Successfully Added!');</script>";}
$location = "index.php?view=pfposting_other&caseno=$caseno$datax";
?>
<script>
window.location="<?php echo $location ?>";
</script>
<?php
}


if(isset($_POST['btn_del'])){
$refno = $_POST['refno'];
$casenox = $_POST['caseno'];
$code = $_POST['code'];
$sql7 = "delete from productout where refno='$refno' and productcode='$code' and caseno='$casenox'";
if ($conn->query($sql7) === TRUE) {echo"<script>alert('Successfully Removed!');</script>";}
$location = "index.php?view=pfposting_other&caseno=$caseno$datax";
?>
<script>
window.location="<?php echo $location ?>";
</script>
<?php
}


?>
<div class="col-lg-12" style="width: 100%;">
<div class="card mb-4">
<div class="table-responsive p-3">


PF POSTING OTHERS <b>(<?php echo $caseno ?> - <?php echo $name ?>)</b>
<hr class="sidebar-divider my-0">


<div class="card-body table-responsive">
<div style="width: 100%; margin: auto;">

<!----------------------------------------------- TABLE --------------------------->
<table align="center" width="100%">
<tr>
<td width="40%" valign="top">
<form name="myform" method="POST">



<div class="container-fluid">
<div class="panel panel-default" width="100%">
<div class="panel-heading">
<a href="http://192.168.0.100:100/cgi-bin/nsprintps.cgi?ticketno=&caseno=<?php echo $caseno ?>" target="_blank"><button type="button" class="btn btn-xs btn-danger"><font size="2%"><i class="fa fa-file-text-o"> POS CHARGE-SLIP</i></font></button></a>
<a href="http://192.168.0.100:100/cgi-bin/nsprintps1.cgi?ticketno=&caseno=<?php echo $caseno ?>" target="_blank"><button type="button" name="btn_add" class="btn btn-xs btn-primary"><font size="2%"><i class="fa fa-check-circle-o"> STANDARD CHARGE-SLIP </i></font></button></a>
</div>
<div class="card-body">
<div style="width: 95%; margin: auto;">
<br>
<table>
<tr>
<td style="text-align:right; width: 20%;"><font color="black">NAME:</td>
<td style="text-align:left;"><font color="black">
<select name="doctor">
<option value=""></option>
<?php
$sql2x = "SELECT * FROM nsauthemployees order by name";
$result2x = $conn->query($sql2x);
while($row2x = $result2x->fetch_assoc()) {
$name=$row2x['name'];
$code=$row2x['empid'];
echo "<option value='$code'>$name</option>";
}
?>
</select>
</td>
</tr>
<tr>
<td style="text-align:right;"><font color="black">SERVICES:</td>
<td style="text-align:left;"><font color="black">
<select name="services">
<option value'IPD apnurse'>IPD apnurse</option>
<option value'IPD apdoc'>IPD apdoc</option>
<option value'Oncall Nurse'>Oncall Nurse</option>
<option value'AP others'>AP others</option>
</select>
</td>
</tr>
<tr>
<td style="text-align:right;"><font color="black">PF:</td>
<td><font color="black"><input type="text" name="pf" value="">
</td>
</tr>
<tr>
<td style="text-align:right;"><font color="black">QUNATITY:</td>
<td style="text-align:left;"><font color="black"><input type="text" name="round" value="1">
</td>
</tr>
<tr>
<td style="text-align:right;"><font color="black">PHIC:</td>
<td style="text-align:left;"><font color="black"><input type="text" name="phic" value="0"><br>
<font color="red" size="1"><i>IF NO ENTRY FOR PHIC, JUST ENCODE A ZERO VALUE</i></font>
</td>
</tr>
<tr>
<td style="text-align:right;"><font color="black">HMO:</td>
<td style="text-align:left;"><font color="black"><input type="text" name="hmo" value="0"><br>
<font color="red" size="1"><i>IF NO ENTRY FOR HMO, JUST ENCODE A ZERO VALUE</i></font>
</td>
</tr>
<tr>
<td style="text-align:right;"><font color="black">DISCOUNT:</td>
<td style="text-align:left;"><font color="black"><input type="text" name="disc" value="0"><br>
<font color="red" size="1"><i>IF NO ENTRY FOR DISC, JUST ENCODE A ZERO VALUE</i></font>
</td>
</tr>
<td></td>
<td><p align="right"><button type="submit" name="btn_submit" class="btn btn-xs btn-info"><font size="2%"><i class="fa fa-check-circle-o"> SUBMIT </i></font></button></td>
</tr>
</table><br>
</div></div></div></div></div>
</div>

</form>
</td>


<td  valign="top">





<div class="tablex">
<div class="panel panel-default" width="100%">
<div class="panel-heading">
<p align="left"><font color="black"><b>FINAL REQUEST <i><font color="red">(set by billing)</font></i></p>
</div>
<div class="card-body">
<div style="width: 100%; margin: auto;">
<table id="myTable" align="center" class="tablex">
<thead>
<tr>
<th class="text-center" bgcolor="#033958"><font color="white">DOCTOR</th>
<th class="text-center" bgcolor="#033958"><font color="white">SERVICES</th>
<th class="text-center" bgcolor="#033958"><font color="white">SP</th>
<th class="text-center" bgcolor="#033958"><font color="white">SC</th>
<th class="text-center" bgcolor="#033958"><font color="white">GROSS</th>
<th class="text-center" bgcolor="#033958"><font color="white">PHIC</th>
<th class="text-center" bgcolor="#033958"><font color="white">HMO</th>
<th class="text-center" bgcolor="#033958"><font color="white">EXCESS</th>
<th class="text-center" bgcolor="#033958"><font color="white"></th>
</tr>
</thead>
<tbody>
<?php
$sql2z = "SELECT * FROM productout where (productsubtype='PROFESSIONAL FEE' OR productsubtype LIKE '%ON CALL%') and caseno='$caseno' and approvalno='nurse-pf'";
$result2z = $conn->query($sql2z);
while($row2z = $result2z->fetch_assoc()) {
$pdesc=$row2z['productdesc'];
$gross=$row2z['gross'];
$adj=$row2z['adjustment'];
$sp=$row2z['sellingprice'];
$phic=$row2z['phic'];
$hmo=$row2z['hmo'];
$excess=$row2z['excess'];
$ptype=$row2z['producttype'];
$refno=$row2z['refno'];
$pcode=$row2z['productcode'];
?>
<tr>
<td><font class="font4"><?php echo $pdesc ?></td>
<td><font class="font4"><?php echo $ptype ?></td>
<td><font class="font4"><?php echo $sp ?></td>
<td><font class="font4"><?php echo $adj ?></td>
<td><font class="font4"><?php echo $gross ?></td>
<td><font class="font4"><?php echo $phic ?></td>
<td><font class="font4"><?php echo $hmo ?></td>
<td><font class="font4"><?php echo $excess ?></td>
<td>
<form method="POST">
<button type="submit" name="btn_del" class="btn btn-danger" title="delete pf" onclick="return confirm('Are you sure you want to remove <?php echo $pdesc ?>');"><li class="fa fa-trash"></li></button>
<input type="hidden" name="refno" value="<?php echo $refno ?>">
<input type="hidden" name="caseno" value="<?php echo $caseno ?>">
<input type="hidden" name="code" value="<?php echo $pcode ?>">
</form>
</td>
</tr>
<?php } ?>
</tbody>
</table>
</div></div></div></div></div>
</div>


</td>



</tr>
</table>

<!----------------------------------------------------------------------------------------------------------->







</div>
</div>




</div>
</div>
</div>

