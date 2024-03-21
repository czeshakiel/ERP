<table width="100%" border='1' style="border-collapse: collapse;" class="tablex">
<tr>
<td></td>
<td style='font-size: 11px; text-align: center; width: 70%;'><b>Details</td>
<td style='font-size: 11px; text-align: center;'><b>Price </td>
<td style='font-size: 11px; text-align: center;'><b>Qty </td>
<td style='font-size: 11px; text-align: center;'><b>GROSS </td>
<td style='font-size: 11px; text-align: center;'><b>DSC </td>
<td style='font-size: 11px; text-align: center;'><b>TOTAL </td>
</tr>
<?php
$z=0;
  $sql22 = "SELECT * from productout where caseno='$caseno' and trantype='cash' and status='requested' and sellingprice > 0 and batchno != '$batchnoxx' order by batchno";
   $result22 = $conn->query($sql22);
   while($row22 = $result22->fetch_assoc()) {
   $productcode=$row22['productcode'];
   $productdesc=$row22['productdesc'];
   $refno=$row22['refno'];
   $batchno=$row22['batchno'];
   $sellingprice=$row22['sellingprice'];
   $quantity=$row22['quantity'];
   $adjustment=$row22['adjustment'];
   $gross=$row22['gross'];
   $productsubtype=$row22['productsubtype'];
   $scpwd=$row22['scpwd'];
   if($scpwd!=$senior){$cksenior++;}
   $dtreq= date("M d, Y", strtotime($row22['datearray']))." ".$row22['invno'];
   $z++;
   $grosssum=$sellingprice*$quantity;
	$nana="t$z";


//ADDED 2021-05-11 MARK --> CONTAINER-----------------------------------------------------------
   $kref=$row22['refno'];
if(stripos($refex, $kref) !== FALSE){
}
else{
//----------------------------------------------------------------------------------------------



	$timex = date("H:i:s");
	$sqla1a = "insert into collection_temp (`refno`, `acctno`, `acctname`, `ofr`, `description`, `accttitle`, `amount`, `discount`, `date`, `Dept`, `username`, `shift`, `type`, `paymentTime`, `paidBy`, `datearray`, `branch`, `ip`, `quantity`) values ('$refno','$caseno','$pname','$nana','$productdesc','$productsubtype','$gross','$adjustment','$datexx','$ward','$user','','cash-Visa','not-include','','$datex','$branch','$ipx','$quantity')";
	if ($conn->query($sqla1a) === TRUE) {}

	if($adj=="" or $adj=="0") {$action = ""; $distypeval="PERCENT";} else {$action ="readonly"; $distypeval="AMOUNT";}

$rem2 ="";
$sql22xx2 = "SELECT * from labtest where caseno='$caseno' and refno ='$refno'";
$result22xx2 = $conn->query($sql22xx2);
while($row22xx2 = $result22xx2->fetch_assoc()) {
$rem2 = $row22xx2['remarks'];
}

 ?>

<tr>
<td style='font-size: 11px; text-align: center;'>
<input type="checkbox" style="transform : scale(1.5);" value="<?php echo $grosssum; ?>" id="<?php echo $nana; ?>" name="<?php echo $nana; ?>" onclick="cal(this.value,this.id,'<?php echo $adjustment ?>','<?php echo $gross ?>','<?php echo $nana ?>');"> </td>
<?php
if($pckname!=""){$pckname="[$pckname]";}
echo "
<td style='font-size: 12px;;'>
<font color='gray'>Desc:</font> <b>$productdesc</b>
<font color='red'><i><small>$rem2</small></i></font>
<font color='blue'><small>$pckname</small></i></font>
<br><font color='gray'>Accttitle:</font> $productsubtype
<br><font color='gray'>Accttitle:</font>$dtreq
<br><font color='gray'>Batchno:</font>$batchno </td>
<td style='font-size: 12px;; text-align: center;'>$sellingprice </td>
<td style='font-size: 12px;; text-align: center;'>$quantity </td>
<td style='font-size: 12px;; text-align: center;'>$grosssum </td>
<td style='font-size: 12px;; text-align: center;'>$adjustment </td>
<td style='font-size: 12px;; text-align: center;'>$gross </td>
</tr>
";

//ADDED 2021-05-11 MARK --> CONTAINER-----------------------------------------------------------
}
//----------------------------------------------------------------------------------------------

}
?>
</table>
