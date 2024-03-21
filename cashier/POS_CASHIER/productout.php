<table width="100%" border='1' style="border-collapse: collapse;" class="tablex">
<tr>
<td></td>
<td style='font-size: 11px; text-align: center; width: 70%;'><b>Details </td>
<td style='font-size: 11px; text-align: center;'><b>Price </td>
<td style='font-size: 11px; text-align: center;'><b>Qty </td>
<td style='font-size: 11px; text-align: center;'><b>GROSS </td>
<td style='font-size: 11px; text-align: center;'><b>DSC </td>
<td style='font-size: 11px; text-align: center;'><b>TOTAL </td>
</tr>
<?php
//ADDED 2021-05-11 MARK --> CONTAINER-----------------------------------------------------------
$refex="";
//----------------------------------------------------------------------------------------------
$z=0;
$sql22 = "SELECT * from productout where caseno='$caseno' and trantype='cash' and status='requested' and sellingprice>0 and batchno='$batchnoxx' order by datearray, batchno";
$result22 = $conn->query($sql22);
while($row22 = $result22->fetch_assoc()) {
$productcode=$row22['productcode'];
$productdesc=$row22['productdesc'];
$refno=$row22['refno'];
$batchno=$row22['batchno'];
$sellingprice=$row22['sellingprice'];
$terminalname=$row22['terminalname'];
$quantity=$row22['quantity'];
$adjustment=$row22['adjustment'];
$gross=$row22['gross'];
$productsubtype=$row22['productsubtype'];
$referenceno=$row22['referenceno'];
$scpwd=$row22['scpwd'];
if($scpwd!=$senior){$cksenior++;}
$dtreq= date("M d, Y", strtotime($row22['datearray']))." ".$row22['invno'];
$z++;
$grosssum=$sellingprice*$quantity;
$nana="s$z";
$gross2 = $gross2 + $grosssum;
$gross3 = $gross3 + $gross;
$adj = $adj + $adjustment;
$timex = date("H:i:s");

// ----------------------------------- PACKAGENAME
$pckname = "";
$sql22xx = "SELECT * from packagelist where pckgno ='$referenceno'";
$result22xx = $conn->query($sql22xx);
while($row22xx = $result22xx->fetch_assoc()) {
$pckname = $row22xx['packagename'];
}
// -----------------------------------

$sqla1a = "insert into collection_temp (`refno`, `acctno`, `acctname`, `ofr`, `description`, `accttitle`, `amount`, `discount`, `date`, `Dept`, `username`, `shift`, `type`, `paymentTime`, `paidBy`, `datearray`, `branch`, `ip`, `quantity`) values ('$refno','$caseno','$pname','$nana','$productdesc','$productsubtype','$gross','$adjustment','$datexx','$ward','$user','','cash-Visa','include','','$datex','$branch','$ipx','$quantity')";
if ($conn->query($sqla1a) === TRUE) {}

if($adj=="" or $adj=="0") {$action = ""; $distypeval="PERCENT";} else {$action ="readonly"; $distypeval="AMOUNT";}

$rem="";
$sql22xx = "SELECT * from labtest where caseno='$caseno' and refno ='$refno'";
$result22xx = $conn->query($sql22xx);
while($row22xx = $result22xx->fetch_assoc()) {
$rem = $row22xx['remarks'];
}
?>
<tr>
<td style='font-size: 11px; text-align: center;'>
<input type="checkbox" style="transform : scale(1.5);" value="<?php echo $grosssum; ?>" id="<?php echo $nana; ?>" name="<?php echo $nana; ?>" onclick="cal(this.value,this.id,'<?php echo $adjustment ?>','<?php echo $gross ?>','<?php echo $nana ?>');" checked>
</td>
<?php
if($pckname!=""){$pckname="[$pckname]";}
echo "
<td style='font-size: 12px;'>
<font color='gray'>Desc:</font> <b>$productdesc</b>
<font color='red'><i><small>$rem</small></i></font>
<font color='blue'><small>$pckname</small></i></font>
<br><font color='gray'>Accttitle:</font> $productsubtype<br><font color='gray'>Date/Time Req.:</font> $dtreq 
";

if($productsubtype=="PROFESSIONAL FEE" or $productsubtype=="CONSULTATION FEE"){ ?>
 <br><a href="" data-bs-toggle="modal" data-bs-target="#exampleModal22cc" onclick="myacc('<?php echo $refno ?>', '<?php echo $productsubtype ?>', '<?php echo $gross ?>', '<?php echo $pname ?>', '<?php echo $caseno ?>');" class="btn btn-danger btn-sm"><i class="icofont-ui-edit"> Edit Amount</i></a>   
<?php }

echo"</td>
<td style='font-size: 12px; text-align: center;'>$sellingprice </td>
<td style='font-size: 12px; text-align: center;'>$quantity </td>
<td style='font-size: 12px; text-align: center;'>$grosssum </td>
<td style='font-size: 12px; text-align: center;'>$adjustment </td>
<td style='font-size: 12px; text-align: center;'>$gross </td>
</tr>
";
//ADDED 2021-05-11 MARK --> CONTAINER-----------------------------------------------------------
$zxcsql=mysqli_query($conn,"SELECT `SEMIPRIVATE` FROM `receiving` WHERE `code`='$productcode' AND `PRIVATE`='container'");
$zxccount=mysqli_num_rows($zxcsql);
if($zxccount!=0){
$zxcfetch=mysqli_fetch_array($zxcsql);
$copc=$zxcfetch['SEMIPRIVATE'];
include("showcontainer.php");
}
//----------------------------------------------------------------------------------------------
}
?>
</table>
