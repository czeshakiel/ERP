<?php
include "../main/class.php";
include "../main/header.php";
$caseno = $_GET['caseno'];

$sql2g = "SELECT * FROM admission, patientprofile where admission.patientidno=patientprofile.patientidno and admission.caseno='$caseno'";
$result2g = $conn->query($sql2g);
while($row2g = $result2g->fetch_assoc()) {
$lname=$row2g['lastname'];
$fname=$row2g['firstname'];
$mname=$row2g['middlename'];
$senior=$row2g['senior'];
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
echo"<script>alert('Please select doctor!');</script>";
echo "<script>window.location='index.php?view=pfposting&caseno=$caseno$datax';</script>";
exit;
}
if($pf==""){
echo"<script>alert('Please provide PF amount!');</script>";
echo "<script>window.location='index.php?view=pfposting&caseno=$caseno$datax';</script>";
exit;
}
if($round==""){
echo"<script>alert('Please input round!');</script>";
echo "<script>window.location='index.php?view=pfposting&caseno=$caseno$datax';</script>";
exit;
}

$sql2 = "SELECT * FROM docfile where code='$doctor'";
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
 '','$user','$batchno','$services','PROFESSIONAL FEE','doc-pf','','Approved','$branch','$loc',CURDATE(),'')";
if ($conn->query($sql7) === TRUE) {echo"<script>alert('Successfully Added!');</script>";}

$conn->query("INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('Add Professional fee [$refno - $caseno - $docname]', '$user', CURDATE(), CURTIME())");
echo"<script>window.history.back();</script>";
}


if(isset($_POST['btn_del'])){
$refno = $_POST['refno'];
$casenox = $_POST['caseno'];
$code = $_POST['code'];
$sql7 = "delete from productout where refno='$refno' and productcode='$code' and caseno='$casenox'";
if ($conn->query($sql7) === TRUE) {echo"<script>alert('Successfully Removed!');</script>";}

$conn->query("INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('Remove Professional fee [$refno - $caseno - $docname]', '$user', CURDATE(), CURTIME())");
echo"<script>window.history.back();</script>";
}


?>


<div class="col-lg-12" style="width: 100%;">
<div class="card mb-4">
<div class="table-responsive p-3">

PF POSTING <b>(<?php echo $caseno ?> - <?php echo $name ?>)</b>
<hr class="sidebar-divider my-0">



<!----------------------------------------------- TABLE --------------------------->
<table align="center" width="100%">
<tr>
<td width="35%" valign="top">
<form name="myform" method="POST">


<br><br>
<div class='card' style='box-shadow: 0px 0px 0px 1px lightgrey;'>
<div class='card-body'>
<div class='d-flex align-items-center justify-content-between mt-5'>
<div class='lesson_name'>
<div class='project-block light-primary-bg'>
<i class='icofont-doctor-alt'></i>
</div>
<span class='small project_name fw-bold'> PF POSTING </span>
</div>
</div>

<table>
<tr>
<td><font color="black">DOCTOR:<br>
<select name="doctor" class="select2-single form-control">
<option value=""></option>
<!--option >MARY ANN A. JOSUE, RTRP</option-->
<!--option >KRIZIAH LOU R. EMBODO, RTRP</option-->
<option >JURELL DAVE N. OGADO, RTRP</option>
<!--option >CHEROKEE A. LOREQUE, RTRP</option-->
<option >JEANNY ROSE DAGATAN, RN</option>
<option >ELLEN ESPILOY, RTRP</option>
<option >LENS C/O DRA. EMBALSADO</option>
<option >IMPLANTS C/O DR. AMPARO</option>
<option >INSTRUMENT C/O DR. DEL ROSARIO</option>
<option >INSTRUMENT C/O DR. CERIALES</option>
<option >SUPPLIES C/O DR. ISAGUIRRE</option>
<option >STAINLESS c/o Dr. MANGAHAS</option>
<option >SUPPLIES C/O DR. PURACAN</option>
<option >SUPPLIES C/O DR. LAFORTEZA</option>
<option >STENT C/O DR. LOBATON</option>
<option >RUBBER BOND LIGATOR C/O DR. LASALA</option>

<?php
$sql2x = "SELECT * FROM docfile where status ='ACTIVE' order by name";
$result2x = $conn->query($sql2x);
while($row2x = $result2x->fetch_assoc()) {
$name=$row2x['name'];
$code=$row2x['code'];
echo "<option value='$code'>$name</option>";
}
?>
</select>
</td>
</tr>
<tr>
<td><font color="black">SERVICES:<br>
<select name="services" style="width:100%;" class="select2-single form-control">
<option value'IPD attending'>IPD attending</option>
<option value'ON CALL'>ON CALL</option>
<option value'IPD comanaged'>IPD comanaged</option>
<option value'IPD discharge'>IPD surgeon</option>
<option value'IPD discharge'>IPD co-surgeon</option>
<option value'IPD discharge'>IPD anesthesiologist</option>
<option value'IPD discharge'>IPD co-anesthesiologist</option>
<!--option value='Consultation'>Consultation</option>
<option value'IPD admitting'>IPD admitting</option>
<option value'IPD discharge'>IPD discharge</option>
<option value='OPD Procedure'>OPD Procedure</option-->
<!--option value'IPD comanaged'>IPD pfexcess</option>
<option value'IPD comanaged'>AP others</option-->



<?php
$sql2xx = "select distinct(proc) as proc from PF_SHARING WHERE tag not like  '%NONE%' order by proc desc";
$result2xx = $conn->query($sql2xx);
while($row2xx = $result2xx->fetch_assoc()) {
$procedure=$row2xx['proc'];

echo "<!--option value='$procedure'>$procedure</option-->";
}
?>
</select>
</td>
</tr>
<tr>
<td>PF:<br><input type="text" name="pf" value="0" style="width:100%;">
</td>
</tr>
<tr>
<td>ROUND:<br><input type="text" name="round" value="1" style="width:100%;">
</td>
</tr>
<tr>
<td>PHIC:<br><input type="text" name="phic" value="0" style="width:100%;" placeholder="IF NO ENTRY FOR PHIC, JUST ENCODE A ZERO VALUE">
</td>
</tr>
<tr>
<td>HMO:<br><input type="text" name="hmo" value="0" style="width:100%;" placeholder="IF NO ENTRY FOR HMO, JUST ENCODE A ZERO VALUE">
</td>
</tr>
<tr>
<td>DISCOUNT:<br><input type="text" name="disc" value="0" style="width:100%;" placeholder="IF NO ENTRY FOR DISC, JUST ENCODE A ZERO VALUE">
</td>
</tr>
<td><p align="right"><button type="submit" name="btn_submit" class="btn btn-sm btn-warning"><font size="2%"><i class="fa fa-check-circle-o"></i> Submit</font></button></td>
</tr>
</table>


</form>

</div></div><br>

</td><td width="10"></td>


<td  valign="top">
<br>
<b>Request for EXCESS <i><font color="red">(set by DOCTOR)</font></i></b>
<table align="center" class="tablex">
<thead>
<tr>
<th class="text-center" style='font-size:11px;'>DOCTOR</th>
<th class="text-center" style='font-size:11px;'>SERVICES</th>
<th class="text-center" style='font-size:11px;'>EXCESS</th>
</tr>
</thead>
<tbody>
<?php
$sql2z = "SELECT * FROM request_caserate where caseno='$caseno'";
$result2z = $conn->query($sql2z);
while($row2z = $result2z->fetch_assoc()) {
$ontop=$row2z['ontop'];

$sql2zv = "SELECT * FROM admission where caseno='$caseno'";
$result2zv = $conn->query($sql2zv);
while($row2zv = $result2zv->fetch_assoc()) {
$ap=$row2zv['ap'];
}
?>
<tr>
<td><font color="blue" class="blink"><?php echo $ap ?></td>
<td><font color="blue" class="blink"><?php echo $ontop ?></td>
<td><font color="blue" class="blink">FOR EXCESS</td>
</tr>
<?php } ?>
</tbody>
</table>


<!------------------------------------------------------------------------------------->


<br><br>
<b>PARTIAL REQUEST <i><font color="red">(set by station)</font></i></b>
<table id="myTable" align="center" class="tablex">
<thead>
<tr>
<th class="text-center" style='font-size:11px;'>DOCTOR</th>
<th class="text-center" style='font-size:11px;'>SERVICES</th>
  <th class="text-center" style='font-size:11px;'>QTY</th>
<th class="text-center" style='font-size:11px;'>SP</th>
<th class="text-center" style='font-size:11px;'>SC</th>
<th class="text-center" style='font-size:11px;'>GROSS</th>
<th class="text-center" style='font-size:11px;'>PHIC</th>
<th class="text-center" style='font-size:11px;'>HMO</th>
<th class="text-center" style='font-size:11px;'>EXCESS</th>
</tr>
</thead>
<tbody>
<?php
$sql2z = "SELECT * FROM productoutarv where (productsubtype='PROFESSIONAL FEE' OR productsubtype LIKE '%ON CALL%') and caseno='$caseno'";
$result2z = $conn->query($sql2z);
while($row2z = $result2z->fetch_assoc()) {
$pdesc=$row2z['productdesc'];
$gross=$row2z['gross'];
$qty=$row2z['quantity'];
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
<td style="font-size:10px;"><?php echo $pdesc ?></td>
<td style="font-size:10px;"><?php echo $ptype ?></td>
<td style="font-size:10px;"><?php echo $qty ?></td>
  <td style="font-size:10px;"><?php echo $sp ?></td>
<td style="font-size:10px;"><?php echo $adj ?></td>
<td style="font-size:10px;"><?php echo $gross ?></td>
<td style="font-size:10px;"><?php echo $phic ?></td>
<td style="font-size:10px;"><?php echo $hmo ?></td>
<td style="font-size:10px;"><?php echo $excess ?></td>
<td>
<!-- <form method="POST"> -->
<a href='removepf.php?refno=<?=$row2z['refno'];?>' target="_blank" onclick="return confirm('Do you wish to remove this item?');return false;"><button name="btn_del" class="btn btn-danger btn-sm" title="delete pf" disabled><i class="icofont-trash"></i></button></a>
<input type="hidden" name="refno" value="<?php echo $refno ?>">
<input type="hidden" name="caseno" value="<?php echo $caseno ?>">
<input type="hidden" name="code" value="<?php echo $pcode ?>">
<!-- </form> -->
</td>
</tr>
<?php } ?>
</tbody>
</table>
<!------------------------------------------------------------------------------------->

<br><br>
<b>FINAL REQUEST <i><font color="red">(set by billing)</font></i></b>
<table id="myTable" align="center" class="tablex">
<thead>
<tr>
<th class="text-center" style="font-size:11px;">DOCTOR</th>
<th class="text-center" style="font-size:11px;">SERVICES</th>
<th class="text-center" style="font-size:11px;">SP</th>
<th class="text-center" style="font-size:11px;">SC</th>
<th class="text-center" style="font-size:11px;">GROSS</th>
<th class="text-center" style="font-size:11px;">PHIC</th>
<th class="text-center" style="font-size:11px;">HMO</th>
<th class="text-center" style="font-size:11px;">EXCESS</th>
<th class="text-center" style="font-size:11px;"></th>
</tr>
</thead>
<tbody>
<?php
$sql2z = "SELECT * FROM productout where (productsubtype='PROFESSIONAL FEE' OR productsubtype LIKE '%ON CALL%') and caseno='$caseno' and (approvalno='doc-pf' or approvalno='')";
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
<td style="font-size:10px;"><?php echo $pdesc ?></td>
<td style="font-size:10px;"><?php echo $ptype ?></td>
<td style="font-size:10px;"><?php echo $sp ?></td>
<td style="font-size:10px;"><?php echo $adj ?></td>
<td style="font-size:10px;"><?php echo $gross ?></td>
<td style="font-size:10px;"><?php echo $phic ?></td>
<td style="font-size:10px;"><?php echo $hmo ?></td>
<td style="font-size:10px;"><?php echo $excess ?></td>
<td>
<form method="POST">
<button type="submit" name="btn_del" class="btn btn-danger btn-sm" title="delete pf" onclick="return confirm('Are you sure you want to remove <?php echo $pdesc ?>');"><i class="icofont-trash"></i></button>
<input type="hidden" name="refno" value="<?php echo $refno ?>">
<input type="hidden" name="caseno" value="<?php echo $caseno ?>">
<input type="hidden" name="code" value="<?php echo $pcode ?>">
</form>
</td>
</tr>
<?php } ?>
</tbody>
</table>


</td>



</tr>
</table>
</div></div></div>
<!----------------------------------------------------------------------------------------------------------->






<?php include "../main/footer.php"; ?>