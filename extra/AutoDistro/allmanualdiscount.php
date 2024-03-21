<?php

$asql=mysqli_query($conn,"SELECT `id`, `producttype` FROM `hmoallocation` WHERE `producttype` <> 'PROFESSIONAL FEE' ORDER BY `id` ASC");
while($afetch=mysqli_fetch_array($asql)){
  $id=$afetch['id'];
  $producttype=$afetch['producttype'];

  $bsql=mysqli_query($conn,"SELECT `productsubtype` FROM `hmoallocationtype` WHERE `pid`='$id' GROUP BY `productsubtype`");
  $bcount=mysqli_num_rows($bsql);

  $bd=0;
  $be=0;
  $bf=0;

  if($bcount>0){
    while($bfetch=mysqli_fetch_array($bsql)){
      $bptype=$bfetch['productsubtype'];

      $csql=mysqli_query($conn,"SELECT SUM(`excess`) AS `excess`, SUM(`adjustment`) AS `discount` FROM `productout` WHERE `caseno`='$caseno' AND `productsubtype`='$bptype' AND `trantype`='charge' AND `quantity` > 0");
      while($cfetch=mysqli_fetch_array($csql)){
        $bd+=$cfetch['discount'];
        $be+=$cfetch['excess'];
      }

      if(($be>0)||(($be==0)&&($bd>0))){$bf=1;}
    }
  }

  if($bf==1){
echo "
<div align='left'>
  <span style='color: red;font-family: arial;font-size: 18px;font-weight: bold;'>$producttype</span>
  <table border='0' width='100%' cellpadding='0' cellspacing='0'>
    <tr>
      <td class='t2 b2 l2' width='25' style='padding: 2px 3px 2px 3px;'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;'>#</div></td>
      <td class='t2 b2 l1' width='170' style='padding: 2px 3px 2px 3px;'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;'>Reference No.</div></td>
      <td class='t2 b2 l1' width='220' style='padding: 2px 3px 2px 3px;'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;'>Code</div></td>
      <td class='t2 b2 l1' style='padding: 2px 3px 2px 3px;'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;'>Description</div></td>
      <td class='t2 b2 l1' width='70' style='padding: 2px 3px 2px 3px;'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;'>SP</div></td>
      <td class='t2 b2 l1' width='70' style='padding: 2px 3px 2px 3px;'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;'>Qty.</div></td>
      <td class='t2 b2 l1' width='70' style='padding: 2px 3px 2px 3px;'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;'>Discount</div></td>
      <td class='t2 b2 l1' width='70' style='padding: 2px 3px 2px 3px;'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;'>Net</div></td>
      <td class='t2 b2 l1' width='70' style='padding: 2px 3px 2px 3px;'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;'>CR 1</div></td>
      <td class='t2 b2 l1' width='70' style='padding: 2px 3px 2px 3px;'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;'>CR 2</div></td>
      <td class='t2 b2 l1' width='70' style='padding: 2px 3px 2px 3px;'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;'>HMO</div></td>
      <td class='t2 b2 l1' width='70' style='padding: 2px 3px 2px 3px;'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;'>Excess</div></td>
      <td class='t2 b2 l1 r2' width='80' style='padding: 2px 3px 2px 3px;'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;'>Discount %</div></td>
    </tr>
";

    $d=0;
    $dsql=mysqli_query($conn,"SELECT `productsubtype` FROM `hmoallocationtype` WHERE `pid`='$id' AND `productsubtype` <> 'PROFESSIONAL FEE'");
    while($dfetch=mysqli_fetch_array($dsql)){
      $productsubtype=$dfetch['productsubtype'];

      $aeno=0;
      $asd=0;
      $flag=0;
      $aeposql=mysqli_query($conn,"SELECT `refno`, `productcode`, `productdesc`, `sellingprice`, SUM(`quantity`) AS `quantity`, SUM(`adjustment`) AS `adjustment`, SUM(`gross`) AS `gross`, SUM(`phic`) AS `phic`, SUM(`phic1`) AS `phic1`, SUM(`hmo`) AS `hmo`, SUM(`excess`) AS `excess` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 AND `productsubtype`='$productsubtype' GROUP BY `productcode`, `sellingprice` ORDER BY `datearray`");
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
        $d++;

        $newdisc=($aesp*$aeqty)*.20;
        $newgross=($aesp*$aeqty)-$newdisc;

        $newexcess=$newgross-$aephic-$aephic1-$aehmo;

        $s=str_replace(",","",number_format(round($aesp,2),2));
        $q=str_replace(",","",number_format(round($aeqty,2),2));
        $a=str_replace(",","",number_format(round($aeadj,2),2));
        $g=number_format(round($aegross,2),2);

        $p=str_replace(",","",number_format(round($aephic,2),2));
        $p2=str_replace(",","",number_format(round($aephic1,2),2));
        $h=str_replace(",","",number_format(round($aehmo,2),2));
        $e=str_replace(",","",number_format(round($aeexcess,2),2));

        $x=number_format(round((($s*$q)-$a),2),2);
        $y=number_format(round(($p+$p2+$h+$e),2),2);

        if(($x!=$g)||($g!=$y)){$bg="bgred white";$flag+=1;}else{$bg="";}

        $setdis=round($aeadj/($aesp*$aeqty),1)*100;

echo "
    <tr>
      <td class='b1 l2 $bg' style='padding: 5px 3px 5px 3px;'><div align='left' style='font-family: arial;font-size: 14px;'>$d</div></td>
      <td class='b1 l1 $bg' style='padding: 5px 3px 5px 3px;'><div align='left' style='font-family: arial;font-size: 14px;'>$aerefno</div></td>
      <td class='b1 l1 $bg' style='padding: 5px 3px 5px 3px;'><div align='left' style='font-family: arial;font-size: 14px;'>$aecode</div></td>
      <td class='b1 l1 $bg' style='padding: 5px 3px 5px 3px;'><div align='left' style='font-family: arial;font-size: 14px;'>$aedesc</div></td>
      <td class='b1 l1 $bg' style='padding: 5px 3px 5px 3px;'><div align='right' style='font-family: arial;font-size: 14px;'>$aesp</div></td>
      <td class='b1 l1 $bg' style='padding: 5px 3px 5px 3px;'><div align='right' style='font-family: arial;font-size: 14px;'>$aeqty</div></td>
      <td class='b1 l1 $bg' style='padding: 5px 3px 5px 3px;'><div align='right' style='font-family: arial;font-size: 14px;'>$aeadj</div></td>
      <td class='b1 l1 $bg' style='padding: 5px 3px 5px 3px;'><div align='right' style='font-family: arial;font-size: 14px;'>$aegross</div></td>
      <td class='b1 l1 $bg' style='padding: 5px 3px 5px 3px;'><div align='right' style='font-family: arial;font-size: 14px;'>$aephic</div></td>
      <td class='b1 l1 $bg' style='padding: 5px 3px 5px 3px;'><div align='right' style='font-family: arial;font-size: 14px;'>$aephic1</div></td>
      <td class='b1 l1 $bg' style='padding: 5px 3px 5px 3px;'><div align='right' style='font-family: arial;font-size: 14px;'>$aehmo</div></td>
      <td class='b1 l1 $bg' style='padding: 5px 3px 5px 3px;'><div align='right' style='font-family: arial;font-size: 14px;'>$aeexcess</div></td>
      <td class='b1 l1 r2 $bg' style='padding: 5px 3px 5px 3px;'><div align='center' style='font-family: arial;font-size: 14px;'><input type='number' step='0.01' style='width: 50px;text-align: center;' value='$setdis' /></div></td>
    </tr>
";

      }
    }

echo "
    <tr>
      <td colspan='13' class='t2'></td>
    </tr>
  </table>
</div>
<br />
";

  }
}

?>
