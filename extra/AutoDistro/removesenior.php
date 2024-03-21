<?php
echo "
<div align='left'>
  <table border='0' width='100%' cellpadding='0' cellspacing='0'>
    <tr>
      <td class='t2 b2 l2'><div align='center'>&nbsp;#&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center'>&nbsp;No.&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center'>&nbsp;Code&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center'>&nbsp;Description&nbsp;</div></td>
      <td class='t2 b2 l1' width='70'><div align='center'>&nbsp;SP&nbsp;</div></td>
      <td class='t2 b2 l1' width='70'><div align='center'>&nbsp;Qty.&nbsp;</div></td>
      <td class='t2 b2 l1' width='70'><div align='center'>&nbsp;Discount&nbsp;</div></td>
      <td class='t2 b2 l1' width='70'><div align='center'>&nbsp;Net&nbsp;</div></td>
      <td class='t2 b2 l1' width='70'><div align='center'>&nbsp;CR 1&nbsp;</div></td>
      <td class='t2 b2 l1' width='70'><div align='center'>&nbsp;CR 2&nbsp;</div></td>
      <td class='t2 b2 l1' width='70'><div align='center'>&nbsp;HMO&nbsp;</div></td>
      <td class='t2 b2 l1 r2' width='70'><div align='center'>&nbsp;Excess&nbsp;</div></td>
    </tr>
";

$aeno=0;
$asd=0;
$flag=0;
$aeposql=mysqli_query($conn,"SELECT refno, productcode, productdesc, sellingprice, quantity, adjustment, gross, phic, phic1, hmo, excess FROM productout WHERE caseno='$caseno' AND trantype='charge' AND quantity > 0 AND productsubtype NOT LIKE 'PROFESSIONAL FEE' ORDER BY datearray");
while($aepofetch=mysqli_fetch_array($aeposql)){
$aerefno=$aepofetch['refno'];
$aecode=$aepofetch['productcode'];
$aedesc=$aepofetch['productdesc'];
$aesp=$aepofetch['sellingprice'];
$aeqty=$aepofetch['quantity'];
$aeadj=$aepofetch['adjustment'];
$aegross=$aepofetch['gross'];
$aephic=$aepofetch['phic'];
$aephic1=$aepofetch['phic1'];
$aehmo=$aepofetch['hmo'];
$aeexcess=$aepofetch['excess'];
$aeno++;
$asd+=$aegross;

$newdisc=0;
$newgross=($aesp*$aeqty);

$newexcess=$newgross-$aephic-$aephic1-$aehmo;

mysqli_query($conn,"UPDATE `productout` SET adjustment='$newdisc', gross='$newgross', phic='0', hmo='0', phic1='0', excess='$newexcess' WHERE refno='$aerefno'");

if(((($aesp*$aeqty)-$aeadj)!=$aegross)||($aegross!=($aephic+$aephic1+$aehmo+$aeexcess))){$bg="bgred white";$flag+=1;}else{$bg="";}

echo "
    <tr>
      <td class='b1 l2 $bg'><div align='left'>&nbsp;$aeno&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='left'>&nbsp;$aerefno&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='left'>&nbsp;$aecode&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='left'>&nbsp;$aedesc&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right'>&nbsp;$aesp&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right'>&nbsp;$aeqty&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right'>&nbsp;$aeadj&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right'>&nbsp;$aegross&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right'>&nbsp;$aephic&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right'>&nbsp;$aephic1&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right'>&nbsp;$aehmo&nbsp;</div></td>
      <td class='b1 l1 r2 $bg'><div align='right'>&nbsp;$aeexcess&nbsp;</div></td>
    </tr>
";

}

echo "
    <tr>
      <td colspan='6' class='t1 b2 l2'><div align='right' style='font-family: arial;font-size: 14px;font-weight: bold;padding: 3px 2px;'>Gross:</div></td>
      <td class='t1 b2 l1'><div align='right' style='font-family: arial;font-size: 14px;font-weight: bold;padding: 3px 2px;'>$asd</div></td>
      <td colspan='5' class='t1 b2 l1 r2'></td>
    </tr>
  </table>
</div>
";

echo "
<script>
  alert('Removal of senior/pwd discount was successfull!!!');
  window.location='../BillMe/?caseno=$caseno&dept=BILLING&user=$user';
</script>
";
?>
