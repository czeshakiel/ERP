<style>
.font1 {font-family: Lucida Console, Courier New, monospace;}
.font2 {font-family: Ariel, Helvetica, sans-serif;}
.font3 {font-family: Times New Roman, Times, serif;}
</style>
<table width="100%" border="0"><tr><td width="50%">

<?php
error_reporting(0);
$pname = $_GET['pname'];
$caseno = $_GET['caseno'];
$batchno = $_GET['batchno'];
$name1 = $_GET['user'];
$invno = $_GET['invno'];
$dept = $_GET['dept'];


if(isset($_GET['chargeslip'])){$qq = "and trantype='charge'";}
elseif(isset($_GET['cashslip'])){$qq = "and trantype='cash'";}
elseif(isset($_GET['allslip'])){$qq = "";}

include '../main/class.php';
$sql2 = "SELECT * FROM ipaddress";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) { 
$ip=$row2['ipaddress'];
}

$sql22 = "SELECT * from admission where caseno='$caseno'";
$result22 = $conn->query($sql22);
while($row22 = $result22->fetch_assoc()) { 
$membership=$row22['membership'];
$hmo=$row22['hmo'];
$room=$row22['room'];
}  

$sql22 = "SELECT * from productout where caseno='$caseno' and batchno='$batchno' and (status='Approved' or status='PAID')";
$result22 = $conn->query($sql22);
while($row22 = $result22->fetch_assoc()) { 
$ddate=$row22['datearray'];
$ttime=$row22['invno'];
}
   
$datearray1 = date("Y/m/d");
$datearray2 = date("h:s:i a");
?>

<html>
<body>
<br/>
<table width="400" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><span class="style21">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="1" class='font1'><?php echo $pname ?></span></td>
<td align="right"><span class="style21">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="1" class='font1'><?php echo $ddate."-".$ttime ?></span></td>
</tr>
<tr>
<td><span class="style18">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="1" class='font1'><?php echo $room ?></span></td>
<td align="right"><span class="style18">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="1" class='font1'><?php echo $datearray1."-".$datearray2 ?></span></td>
</tr>
</table>
<br />
<br />
</body>
</html>

<?php 
echo"<br><table width='400' border='0' cellpadding='0' cellspacing='0'>";
$tot_adj=0;
$grandtotal=0;
$sql22 = "SELECT * from productout where caseno='$caseno' and batchno='$batchno' and (status='Approved' or status='PAID') and quantity>0 $qq";
$result22 = $conn->query($sql22);
$countlist = mysqli_num_rows($result22);
while($row22 = $result22->fetch_assoc()) { 
$quantity=$row22['quantity'];
$desc=$row22['productdesc'];
$sellingprice=$row22['sellingprice'];
$adjustment=$row22['adjustment'];
$total = $sellingprice * $quantity;
$tot_adj = $tot_adj + $adjustment;
$grandtotal = $grandtotal + $total;

echo "
<tr class='med-text'>
<td width='0'>&nbsp;</td>
<td width='30'><font size='1' class='font1'>$quantity</td>
<td align='left' width='260'><font size='1' class='font1'>$desc&nbsp;&nbsp;&nbsp;</td>
<td align='right' width='50'><font size='1' class='font1'>$sellingprice</td>
<td align='right' width='75'><font size='1' class='font1'>$total</td>
</tr>
";
$actualamount = $grandtotal;
$discount = $tot_adj;
$netprice = $grandtotal - $tot_adj;
$TOTALPRICE = $netprice;
}
echo"</table>";
if($tot_adj == ""){}


$space = 14 - $countlist;
for($i=0; $i<$space; $i++){echo"<br>";}
?>

<table width="400" border="0" cellpadding="0" cellspacing="0">
<tr class="med-total">
<td align="right" width="240">
<table width="50%">
<tr>
<td><p align="right"><font size='1' class='font1'><b>Total Sales:</b></td>
<td width="30%"><p align="right"><font size='1' class='font1'><b><?php echo $actualamount  ?></b></td>
</tr>
</table>
</td>
</tr>  
  
 
<tr class="med-total">
<td align="right" width="240">
<table width="50%">
<tr>
<td><p align="right"><font size='1' class='font1'><b>Less: SC/PWD Discount:</b></td>
<td width="30%"><p align="right"><font size='1' class='font1'><b><?php echo $discount ?></b></td>
</tr>
</table>
</td>
</tr>
  
  
<tr class="med-total">
<td align="right" width="240">
<table width="50%">
<tr>
<td><p align="right"><font size='1' class='font1'><b>Total Due:</b></td>
<td width="30%"><p align="right"><font size='1' class='font1'><b><?php echo $TOTALPRICE  ?></b></td>
</tr>
</table>
</td>
</tr>
</table>
<br />
<br />
<table width="400" border="0" cellpadding="0" cellspacing="0">
<tr class="med-gross">
<td width="15">&nbsp;</td>
<td align="left" width="465"><font size='1' class='font1'><?php echo $name1 ?></td>
</tr>
</table> 


<?php if($dept=="csr2" or $dept=="CSR2"){ ?>
<table width="400" border="0" cellpadding="0" cellspacing="0">
<tr class="med-gross">
    <td width="15">&nbsp;</td>
    <td align="left" width="465"><font size='1' class='font1'>INVOICE NO.: <?php echo $invno ?></td>
  </tr>
</table> 
<?php } ?>

</td>
<!-- ################################## 2nd Copy ########################## -->
<?php if($dept=="csr2" or $dept=="CSR2ddd") { ?>
<td align="left" width="50%">

<?php
$pname = $_GET['pname'];
$caseno = $_GET['caseno'];
$batchno = $_GET['batchno'];
$name1 = $_GET['user'];
$invno = $_GET['invno'];
$dept = $_GET['dept'];

include '../Auth/connect.php';
$sql2 = "SELECT * FROM ipaddress";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) { 
$ip=$row2['ipaddress'];
}

$sql22 = "SELECT * from admission where caseno='$caseno'";
$result22 = $conn->query($sql22);
while($row22 = $result22->fetch_assoc()) { 
$membership=$row22['membership'];
$hmo=$row22['hmo'];
$room=$row22['room'];
}  

$sql22 = "SELECT * from productout where caseno='$caseno' and batchno='$batchno' and (status='Approved' or status='PAID')";
$result22 = $conn->query($sql22);
while($row22 = $result22->fetch_assoc()) { 
$ddate=$row22['datearray'];
$ttime=$row22['invno'];
}
   
$datearray1 = date("Y/m/d");
$datearray2 = date("h:s:i a");
?>

<html>
<body>
<br/>
<table width="400" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><span class="style21">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="1" class='font1'><?php echo $pname ?></span></td>
<td align="right"><span class="style21">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="1" class='font1'><?php echo $ddate."-".$ttime ?></span></td>
</tr>
<tr>
<td><span class="style18">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="1" class='font1'><?php echo $room ?></span></td>
<td align="right"><span class="style18">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="1" class='font1'><?php echo $datearray1."-".$datearray2 ?></span></td>
</tr>
</table>
<br />
<br />
</body>
</html>

<?php 
echo"<br><table width='400' border='0' cellpadding='0' cellspacing='0'>";
$tot_adj=0;
$grandtotal=0;
$sql22 = "SELECT * from productout where caseno='$caseno' and batchno='$batchno' and (status='Approved' or status='PAID') and quantity>0";
$result22 = $conn->query($sql22);
$countlist = mysqli_num_rows($result22);
while($row22 = $result22->fetch_assoc()) { 
$quantity=$row22['quantity'];
$desc=$row22['productdesc'];
$sellingprice=$row22['sellingprice'];
$adjustment=$row22['adjustment'];
$total = $sellingprice * $quantity;
$tot_adj = $tot_adj + $adjustment;
$grandtotal = $grandtotal + $total;

echo "
<tr class='med-text'>
<td width='0'>&nbsp;</td>
<td width='30'><font size='1' class='font1'>$quantity</td>
<td align='left' width='260'><font size='1' class='font1'>$desc&nbsp;&nbsp;&nbsp;</td>
<td align='right' width='50'><font size='1' class='font1'>$sellingprice</td>
<td align='right' width='75'><font size='1' class='font1'>$total</td>
</tr>
";
$actualamount = $grandtotal;
$discount = $tot_adj;
$netprice = $grandtotal - $tot_adj;
$TOTALPRICE = $netprice;
}
echo"</table>";
if($tot_adj == ""){}


$space = 14 - $countlist;
for($i=0; $i<$space; $i++){echo"<br>";}
?>

<table width="400" border="0" cellpadding="0" cellspacing="0">
<tr class="med-total">
<td align="right" width="240">
<table width="50%">
<tr>
<td><p align="right"><font size='1' class='font1'><b>Total Sales:</b></td>
<td width="30%"><p align="right"><font size='1' class='font1'><b><?php echo $actualamount  ?></b></td>
</tr>
</table>
</td>
</tr>  
  
 
<tr class="med-total">
<td align="right" width="240">
<table width="50%">
<tr>
<td><p align="right"><font size='1' class='font1'><b>Less: SC/PWD Discount:</b></td>
<td width="30%"><p align="right"><font size='1' class='font1'><b><?php echo $discount ?></b></td>
</tr>
</table>
</td>
</tr>
  
  
<tr class="med-total">
<td align="right" width="240">
<table width="50%">
<tr>
<td><p align="right"><font size='1' class='font1'><b>Total Due:</b></td>
<td width="30%"><p align="right"><font size='1' class='font1'><b><?php echo $TOTALPRICE  ?></b></td>
</tr>
</table>
</td>
</tr>
</table>
<br />
<br />
<table width="400" border="0" cellpadding="0" cellspacing="0">
<tr class="med-gross">
<td width="15">&nbsp;</td>
<td align="left" width="465"><font size='1' class='font1'><?php echo $name1 ?></td>
</tr>
</table> 


<?php if($dept=="csr2" or $dept=="CSR2"){ ?>
<table width="400" border="0" cellpadding="0" cellspacing="0">
<tr class="med-gross">
    <td width="15">&nbsp;</td>
    <td align="left" width="465"><font size='1' class='font1'>INVOICE NO.: <?php echo $invno ?></td>
  </tr>
</table> 
<?php } ?>



</td>
</tr>
<?php } ?>
</table>

