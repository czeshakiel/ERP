<?php
ini_set("display_errors","On");
include("query.php");

echo "
<!doctype html>
<html>
<head>
  <meta charset='utf-8'>
  <title>Itemized Charges - $heading</title>
  <link rel='icon' href='../../image/logo/logo.png' type='image/png' />
  <link rel='shortcut icon' href='../../image/logo/logo.png' type='image/png' />
  <link href='../Resources/CSS/mystyle.css' rel='stylesheet' type='text/css' />
</head>
<body>
<div align='center'>
  <table width='720' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td height='80' valign='middle'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='120'><div align='left' class='arial s14 black bold'>PATIENT NAME:</div></td>
                  <td><div align='left' class='s17 bold'>$patname</div></td>
                </tr>
                <tr>
                  <td><div align='left' class='arial s14 black bold'>CASE NO.:</div></td>
                  <td><div align='left' class='s17 bold'>$caseno</div></td>
                </tr>
                <tr>
                  <td colspan='2'><div align='left' class='arial s14 black'>Today is ".date("D M d, Y g:i A", time())."</div></td>
                </tr>
              </table></td>
              <form>
              <td width='90' valign='middle'><a href='PRDLabelManagement.php' style='text-decoration: none;' target='_blank'><div align='center'>
                <input name='msg' type='hidden' value='$caseno'>
                <input name='Input' type='hidden' onClick='update_qrcode()' value='update'/>
                <div id='qr'></div>
              </div></a></td>
              </form>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height='5'></td>
        </tr>
";
echo "
        <tr>
          <td height='5'></td>
        </tr>
        <tr>
          <td><div align='center' class='times s14 black bold'>Itemized Charges</div></td>
        </tr>
        <tr>
          <td height='5'></td>
        </tr>

        <!-- ------------------------------------------------------------------------------------------------------------------------------ -->
        <tr>
          <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
<!-- CHARGES START----------------------------------------------------------------------------------------------------------------------------- -->
            <tr>
              <td class='b2' colspan='6'></td>
            </tr>
            <tr>
              <td class='b2 l2' width='auto'><div align='center' class='times s10 black bold' style='padding: 0 3px;'>Service Date</div></td>
              <td class='b2 l1' width='400'><div align='center' class='times s10 black bold style='padding: 0 3px;''>Item Name</div></td>
              <td class='b2 l1' width='80'><div align='center' class='times s10 black bold' style='padding: 0 3px;'>Unit of Measurement</div></td>
              <td class='b2 l1' width='60'><div align='center' class='times s10 black bold' style='padding: 0 3px;'>Price</div></td>
              <td class='b2 l1' width='50'><div align='center' class='times s10 black bold' style='padding: 0 3px;'>Quantity</div></td>
              <td class='b2 l1 r2' width='60'><div align='center' class='times s10 black bold' style='padding: 0 3px;'>Amount</div></td>
            </tr>
            <tr>
              <td class='b2' colspan='6' height='10'></td>
            </tr>
";

$gtot=0;

$htact=0;
$htadj=0;
$htgrs=0;
$htph1=0;
$htph2=0;
$hthmo=0;
$alloth="";
$stsql=mysqli_query($mycon1,"SELECT `autono`, `label` FROM `soasetup` ORDER BY CAST(`sort` AS unsigned)");
while($stfetch=mysqli_fetch_array($stsql)){
  $no=$stfetch['autono'];
  $label=$stfetch['label'];


  $hstact=0;
  $hstadj=0;
  $hstgrs=0;
  $hstph1=0;
  $hstph2=0;
  $hsthmo=0;
  $ksdsql=mysqli_query($mycon1,"SELECT `productsubtype`, `type`, `producttype`, `terminalname`, `administration` FROM `soasetupdetails` WHERE `no`='$no'");
  while($ksdfetch=mysqli_fetch_array($ksdsql)){
    $ktype=$ksdfetch['type'];
    $kproductsubtype=$ksdfetch['productsubtype'];
    $kproducttype=$ksdfetch['producttype'];
    $kterminalname=$ksdfetch['terminalname'];
    $kadministration=$ksdfetch['administration'];

    //PREDEFINED CONDITIONS------------
    if($ktype==1){
      $kposql=mysqli_query($mycon1,"SELECT `productdesc`, cast(`sellingprice` as decimal(10,2)) AS `sp`, cast(`quantity` as decimal(10,2)) AS `qty`, cast(`adjustment` as decimal(10,2)) AS `adj`, cast(`phic` as decimal(10,2)) AS `ph1`, cast(`phic1` as decimal(10,2)) AS `ph2`, cast(`hmo` as decimal(10,2)) AS `hmo` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 AND `productsubtype` LIKE '$kproductsubtype'");
    }
    else if($ktype==2){
      $kposql=mysqli_query($mycon1,"SELECT `productdesc`, cast(`sellingprice` as decimal(10,2)) AS `sp`, cast(`quantity` as decimal(10,2)) AS `qty`, cast(`adjustment` as decimal(10,2)) AS `adj`, cast(`phic` as decimal(10,2)) AS `ph1`, cast(`phic1` as decimal(10,2)) AS `ph2`, cast(`hmo` as decimal(10,2)) AS `hmo` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 AND `productsubtype` LIKE '$kproductsubtype' AND `administration` LIKE '$kadministration'");
    }
    else if($ktype==3){
      $kposql=mysqli_query($mycon1,"SELECT `productdesc`, cast(`sellingprice` as decimal(10,2)) AS `sp`, cast(`quantity` as decimal(10,2)) AS `qty`, cast(`adjustment` as decimal(10,2)) AS `adj`, cast(`phic` as decimal(10,2)) AS `ph1`, cast(`phic1` as decimal(10,2)) AS `ph2`, cast(`hmo` as decimal(10,2)) AS `hmo` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 AND `gross` > 0 AND `productsubtype` LIKE '$kproductsubtype' AND `terminalname` LIKE '$kterminalname'");
    }
    else if($ktype==4){
      $kposql=mysqli_query($mycon1,"SELECT `productdesc`, cast(`sellingprice` as decimal(10,2)) AS `sp`, cast(`quantity` as decimal(10,2)) AS `qty`, cast(`adjustment` as decimal(10,2)) AS `adj`, cast(`phic` as decimal(10,2)) AS `ph1`, cast(`phic1` as decimal(10,2)) AS `ph2`, cast(`hmo` as decimal(10,2)) AS `hmo` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 AND `gross` > 0 AND `productsubtype` LIKE '$kproductsubtype' AND `producttype` LIKE '$kproducttype'");
    }
    //---------------------------------

    $alloth=$alloth." AND productsubtype NOT LIKE '$kproductsubtype'";

    while($kpofetch=mysqli_fetch_array($kposql)){
      $hstact+=$kpofetch['sp']*$kpofetch['qty'];
      $hstadj+=$kpofetch['adj'];
      $hstgrs+=($kpofetch['sp']*$kpofetch['qty'])-$kpofetch['adj'];
      $hstph1+=$kpofetch['ph1'];
      $hstph2+=$kpofetch['ph2'];
      $hsthmo+=$kpofetch['hmo'];

    }
    $hstfin=round((round($hstact,2)-round($hstadj,2)-round($hstph1,2)-round($hstph2,2)-round($hsthmo,2)),2);
  }

  if($hstact>0){
echo "
            <tr>
              <td class='b2 l2 r2' colspan='6'><a href='subdetails.php?caseno=$caseno&label=$label' target='_blank' class='astyle'><div align='left' class='times s10 black bold'>&nbsp;$label</div></a></td>
            </tr>
";

    $sdsubtot=0;
    $sdsql=mysqli_query($mycon1,"SELECT `productsubtype`, `type`, `producttype`, `terminalname`, `administration` FROM `soasetupdetails` WHERE `no`='$no'");
    while($sdfetch=mysqli_fetch_array($sdsql)){
      $type=$sdfetch['type'];
      $productsubtype=$sdfetch['productsubtype'];
      $producttype=$sdfetch['producttype'];
      $terminalname=$sdfetch['terminalname'];
      $administration=$sdfetch['administration'];

      //PREDEFINED CONDITIONS------------
      if($type==1){
        $posql=mysqli_query($mycon1,"SELECT `productdesc`, cast(`sellingprice` as decimal(10,2)) AS `sp`, cast(`quantity` as decimal(10,2)) AS `qty`, cast(`adjustment` as decimal(10,2)) AS `adj`, cast(`phic` as decimal(10,2)) AS `ph1`, cast(`phic1` as decimal(10,2)) AS `ph2`, cast(`hmo` as decimal(10,2)) AS `hmo`, `datearray` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 AND `productsubtype` LIKE '$productsubtype'");
      }
      else if($type==2){
        $posql=mysqli_query($mycon1,"SELECT `productdesc`, cast(`sellingprice` as decimal(10,2)) AS `sp`, cast(`quantity` as decimal(10,2)) AS `qty`, cast(`adjustment` as decimal(10,2)) AS `adj`, cast(`phic` as decimal(10,2)) AS `ph1`, cast(`phic1` as decimal(10,2)) AS `ph2`, cast(`hmo` as decimal(10,2)) AS `hmo`, `datearray` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 AND `productsubtype` LIKE '$productsubtype' AND `administration` LIKE '$administration'");
      }
      else if($type==3){
        $posql=mysqli_query($mycon1,"SELECT `productdesc`, cast(`sellingprice` as decimal(10,2)) AS `sp`, cast(`quantity` as decimal(10,2)) AS `qty`, cast(`adjustment` as decimal(10,2)) AS `adj`, cast(`phic` as decimal(10,2)) AS `ph1`, cast(`phic1` as decimal(10,2)) AS `ph2`, cast(`hmo` as decimal(10,2)) AS `hmo`, `datearray` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 AND `gross` > 0 AND `productsubtype` LIKE '$productsubtype' AND `terminalname` LIKE '$terminalname'");
      }
      else if($type==4){
        $posql=mysqli_query($mycon1,"SELECT `productdesc`, cast(`sellingprice` as decimal(10,2)) AS `sp`, cast(`quantity` as decimal(10,2)) AS `qty`, cast(`adjustment` as decimal(10,2)) AS `adj`, cast(`phic` as decimal(10,2)) AS `ph1`, cast(`phic1` as decimal(10,2)) AS `ph2`, cast(`hmo` as decimal(10,2)) AS `hmo`, `datearray` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 AND `gross` > 0 AND `productsubtype` LIKE '$productsubtype' AND `producttype` LIKE '$producttype'");
      }
      //---------------------------------

      while($pofetch=mysqli_fetch_array($posql)){
        $pdesc=strtoupper(trim($pofetch['productdesc']));
        $pdate=$pofetch['datearray'];

        $pdesc=str_replace("MAK-","",$pdesc);
        $pdesc=str_replace("AMS-","",$pdesc);
        $pdesc=str_replace("-MED","",$pdesc);
        $pdesc=str_replace("-SUP","",$pdesc);
        $pdesc=str_replace("() ","",$pdesc);

        $sdsubtot+=($pofetch['sp']*$pofetch['qty']);

echo "
            <tr>
              <td class='b1 l2'><div align='center' class='times s10 black' style='padding: 2 3px;'>".date("M d, Y",strtotime($pdate))."</div></td>
              <td class='b1 l1'><div align='left' class='times s10 black' style='padding: 2px 3px;'>$pdesc</div></td>
              <td class='b1 l1'><div align='left' class='times s10 black'></div></td>
              <td class='b1 l1'><div align='right' class='times s10 black' style='padding: 2 3px;'>".number_format($pofetch['sp'],2)."</div></td>
              <td class='b1 l1'><div align='right' class='times s10 black' style='padding: 2 3px;'>".number_format($pofetch['qty'])."</div></td>
              <td class='b1 l1 r2'><div align='right' class='times s10 black' style='padding: 2 3px;'>".number_format(($pofetch['sp']*$pofetch['qty']),2)."</div></td>
            </tr>
";


      }
    }

$gtot+=$sdsubtot;
echo "
            <tr>
              <td class='t1 b1 l2' colspan='5'><div align='left' class='times s10 black bold' style='padding: 2 3px;'>Sub Total</div></td>
              <td class='t1 b1 l1 r2'><div align='right' class='times s10 black bold' style='padding: 2 3px;'>".number_format($sdsubtot,2)."</div></td>
            </tr>
            <tr>
              <td colspan='6' height='10' class='t1 b2'></td>
            </tr>
";

  }

$htact+=$hstact;
$htadj+=$hstadj;
$htgrs+=$hstgrs;
$htph1+=$hstph1;
$htph2+=$hstph2;
$hthmo+=$hsthmo;

}


//ALL OTHERS-------------------------------------------------------------------------------------------------------------------------------
$apotact=0;
$apotadj=0;
$apotgrs=0;
$apotph1=0;
$apotph2=0;
$apothmo=0;
$aposql=mysqli_query($mycon1,"SELECT `productdesc`, cast(`sellingprice` as decimal(10,2)) AS `sp`, cast(`quantity` as decimal(10,2)) AS `qty`, cast(`adjustment` as decimal(10,2)) AS `adj`, cast(`phic` as decimal(10,2)) AS `ph1`, cast(`phic1` as decimal(10,2)) AS `ph2`, cast(`hmo` as decimal(10,2)) AS `hmo` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 AND `productsubtype` NOT LIKE 'PROFESSIONAL FEE' $alloth");
while($apofetch=mysqli_fetch_array($aposql)){
  $apotact+=$apofetch['sp']*$apofetch['qty'];
  $apotadj+=$apofetch['adj'];
  $apotgrs+=($apofetch['sp']*$apofetch['qty'])-$apofetch['adj'];
  $apotph1+=$apofetch['ph1'];
  $apotph2+=$apofetch['ph2'];
  $apothmo+=$apofetch['hmo'];
}

$apotfin=round((round($apotact,2)-round($apotadj,2)-round($apotph1,2)-round($apotph2,2)-round($apothmo,2)),2);

if(round($apotact,2)>0){
echo "
            <tr>
              <td class='b2 l2 r2' colspan='6'><a href='subdetails.php?caseno=$caseno&label=ALLOTHERS&alloth=".base64_encode($alloth)."' target='_blank' class='astyle'><div align='left' class='times s10 black bold'>&nbsp;MISCELLANEOUS</div></a></td>
            </tr>
";

  $msdsubtot=0;
  $mposql=mysqli_query($mycon1,"SELECT `productdesc`, cast(`sellingprice` as decimal(10,2)) AS `sp`, cast(`quantity` as decimal(10,2)) AS `qty`, cast(`adjustment` as decimal(10,2)) AS `adj`, cast(`phic` as decimal(10,2)) AS `ph1`, cast(`phic1` as decimal(10,2)) AS `ph2`, cast(`hmo` as decimal(10,2)) AS `hmo`, `datearray` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 AND `productsubtype` NOT LIKE 'PROFESSIONAL FEE' $alloth ORDER BY `datearray`");
  while($mpofetch=mysqli_fetch_array($mposql)){
    $mpdesc=strtoupper(trim($mpofetch['productdesc']));
    $mpdate=$mpofetch['datearray'];
    $mpdesc=str_replace("MAK-","",$mpdesc);
    $mpdesc=str_replace("AMS-","",$mpdesc);
    $mpdesc=str_replace("-MED","",$mpdesc);
    $mpdesc=str_replace("-SUP","",$mpdesc);
    $mpdesc=str_replace("() ","",$mpdesc);

    $msdsubtot+=($mpofetch['sp']*$mpofetch['qty']);

echo "
            <tr>
              <td class='b1 l2'><div align='center' class='times s10 black' style='padding: 2 3px;'>".date("M d, Y",strtotime($mpdate))."</div></td>
              <td class='b1 l1'><div align='left' class='times s10 black' style='padding: 2px 3px;'>$mpdesc</div></td>
              <td class='b1 l1'><div align='left' class='times s10 black'></div></td>
              <td class='b1 l1'><div align='right' class='times s10 black' style='padding: 2 3px;'>".number_format($mpofetch['sp'],2)."</div></td>
              <td class='b1 l1'><div align='right' class='times s10 black' style='padding: 2 3px;'>".number_format($mpofetch['qty'])."</div></td>
              <td class='b1 l1 r2'><div align='right' class='times s10 black' style='padding: 2 3px;'>".number_format(($mpofetch['sp']*$mpofetch['qty']),2)."</div></td>
            </tr>
";


  }

$gtot+=$msdsubtot;
echo "
            <tr>
              <td class='t1 b2 l2' colspan='5'><div align='left' class='times s10 black bold' style='padding: 2 3px;'>Sub Total</div></td>
              <td class='t1 b2 l1 r2'><div align='right' class='times s10 black bold' style='padding: 2 3px;'>".number_format($msdsubtot,2)."</div></td>
            </tr>
";

}
//END ALL OTHERS---------------------------------------------------------------------------------------------------------------------------

echo "
            <tr>
              <td colspan='6' height='10' class='b2'></td>
            </tr>
            <tr>
              <td class='b2 l2' colspan='5'><div align='left' class='times s12 black bold' style='padding: 2 3px;'>Total</div></td>
              <td class='b2 l1 r2'><div align='right' class='times s12 black bold' style='padding: 2 3px;'>".number_format($gtot,2)."</div></td>
            </tr>
";

echo "
<!-- CHARGES END------------------------------------------------------------------------------------------------------------------------------- -->
";


echo "
          </table></td>
        </tr>
        <!-- ------------------------------------------------------------------------------------------------------------------------------ -->

      </table></td>
    </tr>
    <tr>
      <td height='15'></td>
    </tr>
  </table>
</div>
";

$pensql=mysqli_query($mycon1,"SELECT sellingprice, quantity, adjustment, gross, hmo, phic, phic1, excess FROM productout WHERE caseno='$caseno' AND quantity > 0 AND trantype='charge' AND (productsubtype='PHARMACY/MEDICINE' OR productsubtype='PHARMACY/SUPPLIES' OR productsubtype='MEDICAL SURGICAL SUPPLIES' OR productsubtype='MEDICAL SUPPLIES') AND (administration LIKE 'pending' OR administration LIKE 'dispensed')");
$pencount=mysqli_num_rows($pensql);

if($pencount!=0){
  $addwarn="WARNING!!! PATIENT STILL HAS PENDING MEDICINES OR SUPPLIES. $pencount";
}
else{
  $addwarn="";
}

if(($status=="MGH")||($status=="discharged")||($status=="TRANSFERRED")||($status=="DAMA")){
  if($pencount!=0){
echo "
<div align='center'><span style='font-size: 20px;font-family: arial;font-weight: bold;color: red;'>$addwarn</span></div>
";
  }
}
else{
echo "
<div align='center'><span style='font-size: 20px;font-family: arial;font-weight: bold;color: red;'>PATIENT IS NOT SET AS MGH!!!<br />$addwarn</span></div>
";
}

echo "
</body>
</html>
";
?>
