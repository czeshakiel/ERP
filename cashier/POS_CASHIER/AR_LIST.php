<table width="100%" class="tablex">
<tr>
<th colspan="9" bgcolor="<?php echo $primarycolor2 ?>"><font color="white">COLLECTION TYPE : <?php echo $productsubtype ?></font></th>
</tr>
<tr>
<td bgcolor="<?php echo $primarycolor3 ?>" width="3%"><font color="white"></td>
<td bgcolor="<?php echo $primarycolor3 ?>" width="41%"><font color="white"> Description </td>
<td bgcolor="<?php echo $primarycolor3 ?>" width="20%"><font color="white"> Batchno </td>
<td bgcolor="<?php echo $primarycolor3 ?>" width="6%"><font color="white"> Price </td>
<td bgcolor="<?php echo $primarycolor3 ?>" width="6%"><font color="white"> Qty </td>
<td bgcolor="<?php echo $primarycolor3 ?>" width="6%"><font color="white"> GROSS </td>
<td bgcolor="<?php echo $primarycolor3 ?>" width="6%"><font color="white"> DSC </td>
<td bgcolor="<?php echo $primarycolor3 ?>" width="6%"><font color="white"> TOTAL </td>
<td bgcolor="<?php echo $primarycolor3 ?>" width="3%"><font color="white">&nbsp;</td>
</tr>
<?php


$z=0;
$sql22 = "select acctname,description,accttitle,amount,acctno,refno,username,
discount from collection  where  type='pending' and amount > 0 and acctno='$caseno' and accttitle like '%AR%'";
$result22 = $conn->query($sql22);
while($row22 = $result22->fetch_assoc()) {
$pname=$row22['acctname'];
$productdesc=$row22['accttitle'];
$refno=$row22['refno'];
//$batchno=$row22['batchno'];
$quantity="1";
$adjustment=$row22['discount'];
$gross=$row22['amount'];
$sellingprice=$gross + $adjustment;
$productsubtype=$row22['description'];
$z++;
$grosssum=$sellingprice*$quantity;
$nana="s$z";
$gross2 = $gross2 + $grosssum;
$gross3 = $gross3 + $gross;
$adj = $adj + $adjustment;

$timex = date("H:i:s");
$sqla1a = "insert into collection_temp (`refno`, `acctno`, `acctname`, `ofr`, `description`, `accttitle`, `amount`, `discount`, `date`, `Dept`, `username`, `shift`, `type`, `paymentTime`, `paidBy`, `datearray`, `branch`, `ip`) values ('$refno','$caseno','$pname','$nana','$productsubtype','$productdesc','$gross','$adjustment','$datexx','$ward','$user','','cash-Visa','include','','$datex','$branch','$ipx')";
if ($conn->query($sqla1a) === TRUE) {}
if($adj=="" or $adj=="0") {$action = ""; $distypeval="PERCENT";} else {$action ="readonly"; $distypeval="AMOUNT";}
?>


<tr>
<td align="center">  <input type="checkbox" value="<?php echo $grosssum; ?>" id="<?php echo $nana; ?>" name="<?php echo $nana; ?>" onclick="cal(this.value,this.id,'<?php echo $adjustment ?>','<?php echo $gross ?>','<?php echo $nana ?>');" checked> </td>

<?php
echo "
<td><font color='black'> $productsubtype </td>
<td><label class='label22'><font size='1' color='white'> $productdesc </td>
<td><font color='black'> $sellingprice </td>
<td><font color='black'> $quantity </td>
<td><font color='black'> $grosssum </td>
<td><font color='black'> $adjustment </td>
<td><font color='black'> $gross </td>
<td><p align='center'> <a href='index.php?view=manage_coh$datax&caseno=$caseno&refno=$refno&code=$productdesc&pname=$pname&mm=$mm1&dd=$dd1&yy=$yy1'><font size='3' color='red'><i class='fa fa-eye'></i></a>  </td>
</tr>
";
}
?>
</table>
