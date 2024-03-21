<?php
echo "
<div align='left'>
  <table border='0' width='100%' cellpadding='0' cellspacing='0'>
    <tr>
      <td class='t2 b2 l2' width='40'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;padding: 3px 3px;'>#</div></td>
      <td class='t2 b2 l1' width='170'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;padding: 3px 3px;'>Ref. No.</div></td>
      <td class='t2 b2 l1' width='170'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;padding: 3px 3px;'>Code</div></td>
      <td class='t2 b2 l1'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;padding: 3px 3px;'>Description</div></td>
      <td class='t2 b2 l1' width='70'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;padding: 3px 3px;'>SP</div></td>
      <td class='t2 b2 l1' width='70'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;padding: 3px 3px;'>Qty.</div></td>
      <td class='t2 b2 l1' width='70'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;padding: 3px 3px;'>Discount</div></td>
      <td class='t2 b2 l1' width='70'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;padding: 3px 3px;'>Net</div></td>
      <td class='t2 b2 l1' width='70'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;padding: 3px 3px;'>CR 1</div></td>
      <td class='t2 b2 l1' width='70'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;padding: 3px 3px;'>CR 2</div></td>
      <td class='t2 b2 l1' width='70'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;padding: 3px 3px;'>HMO</div></td>
      <td class='t2 b2 l1 r2' width='70'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;padding: 3px 3px;'>Excess</div></td>
    </tr>
";

if((stripos($caseno, "R-") !== FALSE)||(stripos($caseno, "WD-") !== FALSE)||(stripos($caseno, "ARD-") !== FALSE)){
  $aeposql=mysqli_query($conn,"SELECT refno, productcode, productdesc, sellingprice, quantity, adjustment, gross, phic, phic1, hmo, excess FROM productout WHERE caseno='$caseno' AND trantype='charge' AND quantity > 0 ORDER BY datearray");
}
else{
  $aeposql=mysqli_query($conn,"SELECT refno, productcode, productdesc, sellingprice, quantity, adjustment, gross, phic, phic1, hmo, excess FROM productout WHERE caseno='$caseno' AND trantype='charge' AND quantity > 0 AND productsubtype NOT LIKE 'PROFESSIONAL FEE' ORDER BY datearray");
}

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

  $newdisc=($aesp*$aeqty)*0.20;
  $newgross=($aesp*$aeqty)-$newdisc;

  $newexcess=$newgross-$aephic-$aephic1-$aehmo;
  mysqli_query($conn,"UPDATE `productout` SET adjustment='$newdisc', gross='$newgross', phic='0', hmo='0', phic1='0', excess='$newexcess' WHERE refno='$aerefno'");

  if(((($aesp*$aeqty)-$aeadj)!=$aegross)||($aegross!=($aephic+$aephic1+$aehmo+$aeexcess))){$bg="bgred white";$flag+=1;}else{$bg="";}

echo "
    <tr>
      <td class='b1 l2 $bg'><div align='left' style='font-family: arial;font-size: 14px;padding: 3px 2px;'>$aeno</div></td>
      <td class='b1 l1 $bg'><div align='left' style='font-family: arial;font-size: 14px;padding: 3px 2px;'>$aerefno</div></td>
      <td class='b1 l1 $bg'><div align='left' style='font-family: arial;font-size: 14px;padding: 3px 2px;'>$aecode</div></td>
      <td class='b1 l1 $bg'><div align='left' style='font-family: arial;font-size: 14px;padding: 3px 2px;'>$aedesc</div></td>
      <td class='b1 l1 $bg'><div align='right' style='font-family: arial;font-size: 14px;padding: 3px 2px;'>$aesp</div></td>
      <td class='b1 l1 $bg'><div align='right' style='font-family: arial;font-size: 14px;padding: 3px 2px;'>$aeqty</div></td>
      <td class='b1 l1 $bg'><div align='right' style='font-family: arial;font-size: 14px;padding: 3px 2px;'>$aeadj</div></td>
      <td class='b1 l1 $bg'><div align='right' style='font-family: arial;font-size: 14px;padding: 3px 2px;'>$aegross</div></td>
      <td class='b1 l1 $bg'><div align='right' style='font-family: arial;font-size: 14px;padding: 3px 2px;'>$aephic</div></td>
      <td class='b1 l1 $bg'><div align='right' style='font-family: arial;font-size: 14px;padding: 3px 2px;'>$aephic1</div></td>
      <td class='b1 l1 $bg'><div align='right' style='font-family: arial;font-size: 14px;padding: 3px 2px;'>$aehmo</div></td>
      <td class='b1 l1 r2 $bg'><div align='right' style='font-family: arial;font-size: 14px;padding: 3px 2px;'>$aeexcess</div></td>
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
  alert('Application of senior/pwd discount was successfull!!!');
  window.location='../BillMe/?caseno=$caseno&dept=BILLING&user=$user';
</script>
";
?>
