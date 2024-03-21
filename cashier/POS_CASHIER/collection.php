<?php
$z=0;
$sql22 = "select acctname,description,accttitle,amount,acctno,refno,username, discount from collection  where  type='pending' and amount > 0 
and acctno='$caseno' and (accttitle not like '%AR%' and accttitle not like '%DISCOUNT%')";
$result22 = $conn->query($sql22);
if(mysqli_num_rows($result22)>0){
?>

<table width="100%" border='1' style="border-collapse: collapse;" class="tablex">
<tr>
<td></td>
<td style='font-size: 12px; text-align: center; width: 70%;'><b>Details </td>
<td style='font-size: 12px; text-align: center;'><b>Price </td>
<td style='font-size: 12px; text-align: center;'><b>Qty </td>
<td style='font-size: 12px; text-align: center;'><b>GROSS </td>
<td style='font-size: 12px; text-align: center;'><b>DSC </td>
<td style='font-size: 12px; text-align: center;'><b>TOTAL </td>
</tr>
<?php
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
<td style='font-size: 11px; text-align: center;'>  <input type="checkbox" style="transform : scale(1.5);" value="<?php echo $grosssum; ?>" id="<?php echo $nana; ?>" name="<?php echo $nana; ?>" onclick="cal(this.value,this.id,'<?php echo $adjustment ?>','<?php echo $gross ?>','<?php echo $nana ?>');" checked> </td>

<?php
echo "
<td style='font-size: 12px;'><b>$productsubtype [$productdesc]</b></td>
<td style='font-size: 12px;'>$sellingprice </td>
<td style='font-size: 12px;'>$quantity </td>
<td style='font-size: 12px;'>$grosssum </td>
<td style='font-size: 12px;'>$adjustment </td>
<td style='font-size: 12px;'>$gross </td>
</tr>
";

}
?>
</table>


<?php }else{include "POS_CASHIER/productout.php";} ?>
