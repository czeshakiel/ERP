<?php
ini_set("display_errors","On");
include("query.php");

echo "
<!doctype html>
<html>
<head>
  <meta charset='utf-8'>
  <title>DETAILS - $heading</title>
  <link rel='icon' href='../../image/logo/logo.png' type='image/png' />
  <link rel='shortcut icon' href='../../image/logo/logo.png' type='image/png' />
  <link href='../Resources/CSS/mystyle.css' rel='stylesheet' type='text/css' />

  <script type='text/javascript' src='../Resources/JS/qr/qrcode.js'></script>
  <script type='text/javascript' src='../Resources/JS/qr/qrcode_SJIS.js'></script>
  <script type='text/javascript' src='../Resources/JS/qr/sample.js'></script>

</head>
<body onLoad='update_qrcode()'>
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

        <!-- ------------------------------------------------------------------------------------------------------------------------------ -->
        <tr>
          <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td class='b1' colspan='9'></td>
            </tr>
            <tr>
              <td class='t1 b1 l2'><div align='center' class='courier s10 black bold'>&nbsp;Description&nbsp;</div></td>
              <td class='t1 b1 l1'><div align='center' class='courier s10 black bold'>&nbsp;SP&nbsp;</div></td>
              <td class='t1 b1 l1'><div align='center' class='courier s10 black bold'>&nbsp;Qty.&nbsp;</div></td>
              <td class='t1 b1 l1'><div align='center' class='courier s10 black bold'>&nbsp;Gross&nbsp;</div></td>
              <td class='t1 b1 l1'><div align='center' class='courier s10 black bold'>&nbsp;Adj.&nbsp;</div></td>
              <td class='t1 b1 l1'><div align='center' class='courier s10 black bold'>&nbsp;HMO/Oth.&nbsp;</div></td>
              <td class='t1 b1 l1'><div align='center' class='courier s10 black bold'>&nbsp;PH 1&nbsp;</div></td>
              <td class='t1 b1 l1'><div align='center' class='courier s10 black bold'>&nbsp;PH 2&nbsp;</div></td>
              <td class='t1 b1 l1 r2'><div align='center' class='courier s10 black bold'>&nbsp;Excess&nbsp;</div></td>
            </tr>

<!-- CHARGES START----------------------------------------------------------------------------------------------------------------------------- -->
";

$htact=0;
$htadj=0;
$htgrs=0;
$htph1=0;
$htph2=0;
$hthmo=0;
$alloth="";

$zsql=mysqli_query($mycon1,"SELECT `productsubtype` FROM `prdsetupdetails` GROUP BY `productsubtype`");
while($zfetch=mysqli_fetch_array($zsql)){
  $alloth=$alloth." AND `productsubtype` NOT LIKE '".$zfetch['productsubtype']."'";
}

$asql=mysqli_query($mycon1,"SELECT `headerlabel` FROM `prdsetup` GROUP BY `headerlabel` ORDER BY CAST(`sort` AS unsigned)");
while($afetch=mysqli_fetch_array($asql)){
  $ahlabel=$afetch['headerlabel'];

echo "
            <tr>
              <td class='t1 b1 l2 r2 bgblack' colspan='9'><div align='center' class='courier s16 white bold'>&nbsp;$ahlabel</div></td>
            </tr>
";


  $stsql=mysqli_query($mycon1,"SELECT `autono`, `label`, `gtype` FROM `prdsetup` WHERE `headerlabel`='$ahlabel' ORDER BY CAST(`sort` AS unsigned)");
  while($stfetch=mysqli_fetch_array($stsql)){
    $no=$stfetch['autono'];
    $label=$stfetch['label'];
    $gtype=$stfetch['gtype'];

    //GTYPE 0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000
    if($gtype==0){

echo "
            <tr>
              <td class='t1 b2 l2 r2' colspan='9'><a href='subdetails.php?caseno=$caseno&label=$label' target='_blank' class='astyle'><div align='left' class='courier s14 black bold'>&nbsp;$label</div></a></td>
            </tr>
";

    $hstact=0;
    $hstadj=0;
    $hstgrs=0;
    $hstph1=0;
    $hstph2=0;
    $hsthmo=0;
    $sdsql=mysqli_query($mycon1,"SELECT `productsubtype`, `type`, `producttype`, `terminalname`, `administration` FROM `prdsetupdetails` WHERE `no`='$no'");
    while($sdfetch=mysqli_fetch_array($sdsql)){
      $type=$sdfetch['type'];
      $productsubtype=$sdfetch['productsubtype'];
      $producttype=$sdfetch['producttype'];
      $terminalname=$sdfetch['terminalname'];
      $administration=$sdfetch['administration'];

        //PREDEFINED CONDITIONS------------
        if($type==1){
          $posql=mysqli_query($mycon1,"SELECT `productdesc`, cast(`sellingprice` as decimal(10,2)) AS `sp`, SUM(`quantity`) AS `qty`, SUM(cast(`adjustment` as decimal(10,2))) AS `adj`, SUM(cast(`phic` as decimal(10,2))) AS `ph1`, SUM(cast(`phic1` as decimal(10,2))) AS `ph2`, SUM(cast(`hmo` as decimal(10,2))) AS `hmo` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 AND `productsubtype` LIKE '$productsubtype' GROUP BY `productcode`, `sellingprice` ORDER BY `productdesc`");
        }
        else if($type==2){
          $posql=mysqli_query($mycon1,"SELECT `productdesc`, cast(`sellingprice` as decimal(10,2)) AS `sp`, SUM(`quantity`) AS `qty`, SUM(cast(`adjustment` as decimal(10,2))) AS `adj`, SUM(cast(`phic` as decimal(10,2))) AS `ph1`, SUM(cast(`phic1` as decimal(10,2))) AS `ph2`, SUM(cast(`hmo` as decimal(10,2))) AS `hmo` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 AND `productsubtype` LIKE '$productsubtype' AND `administration` LIKE '$administration' GROUP BY `productcode`, `sellingprice` ORDER BY `productdesc`");
        }
        else if($type==3){
          $posql=mysqli_query($mycon1,"SELECT `productdesc`, cast(`sellingprice` as decimal(10,2)) AS `sp`, SUM(`quantity`) AS `qty`, SUM(cast(`adjustment` as decimal(10,2))) AS `adj`, SUM(cast(`phic` as decimal(10,2))) AS `ph1`, SUM(cast(`phic1` as decimal(10,2))) AS `ph2`, SUM(cast(`hmo` as decimal(10,2))) AS `hmo` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 AND `productsubtype` LIKE '$productsubtype' AND `terminalname` LIKE '$terminalname' GROUP BY `productcode`, `sellingprice` ORDER BY `productdesc`");
        }
        else if($type==4){
          $posql=mysqli_query($mycon1,"SELECT `productdesc`, cast(`sellingprice` as decimal(10,2)) AS `sp`, SUM(`quantity`) AS `qty`, SUM(cast(`adjustment` as decimal(10,2))) AS `adj`, SUM(cast(`phic` as decimal(10,2))) AS `ph1`, SUM(cast(`phic1` as decimal(10,2))) AS `ph2`, SUM(cast(`hmo` as decimal(10,2))) AS `hmo` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 AND `productsubtype` LIKE '$productsubtype' AND `producttype` LIKE '$producttype' GROUP BY `productcode`, `sellingprice` ORDER BY `productdesc`");
        }
      //---------------------------------

        while($pofetch=mysqli_fetch_array($posql)){
          $hsdesc=$pofetch['productdesc'];
          $hstact+=$pofetch['sp']*$pofetch['qty'];
          $hstadj+=$pofetch['adj'];
          $hstgrs+=($pofetch['sp']*$pofetch['qty'])-$pofetch['adj'];
          $hstph1+=$pofetch['ph1'];
          $hstph2+=$pofetch['ph2'];
          $hsthmo+=$pofetch['hmo'];

          $hsdesc=str_replace("ams-","",$hsdesc);
          $hsdesc=str_replace("-sup","",$hsdesc);
          $hsdesc=str_replace("-med","",$hsdesc);

echo "
            <tr>
              <td class='b1 l2'><a href='subdetails.php?caseno=$caseno&label=$label' target='_blank' class='astyle'><div align='left' class='courier s11 black'>&nbsp;$hsdesc</div></a></td>
              <td class='b1 l1'><div align='right' class='courier s11 black'>&nbsp;".number_format(($pofetch['sp']),2)."&nbsp;</div></td>
              <td class='b1 l1'><div align='right' class='courier s11 black'>&nbsp;".$pofetch['qty']."&nbsp;</div></td>
              <td class='b1 l1'><div align='right' class='courier s11 black'>&nbsp;".number_format(($pofetch['sp']*$pofetch['qty']),2)."&nbsp;</div></td>
              <td class='b1 l1'><div align='right' class='courier s11 black'>&nbsp;".number_format($pofetch['adj'],2)."&nbsp;</div></td>
              <td class='b1 l1'><div align='right' class='courier s11 black'>&nbsp;".number_format($pofetch['hmo'],2)."&nbsp;</div></td>
              <td class='b1 l1'><div align='right' class='courier s11 black'>&nbsp;".number_format($pofetch['ph1'],2)."&nbsp;</div></td>
              <td class='b1 l1'><div align='right' class='courier s11 black'>&nbsp;".number_format($pofetch['ph2'],2)."&nbsp;</div></td>
              <td class='b1 l1 r2'><div align='right' class='courier s11 black'>&nbsp;".number_format((($pofetch['sp']*$pofetch['qty'])-$pofetch['adj']),2)."&nbsp;</div></td>
            </tr>
";
        }
      }

      $hstfin=round((round($hstact,2)-round($hstadj,2)-round($hstph1,2)-round($hstph2,2)-round($hsthmo,2)),2);

      if($hstact>0){
echo "
            <tr>
              <td class='t1 b2 l2' colspan='3' height='25'><div align='left' class='courier s12 black bold'>&nbsp;SUB TOTAL</div></td>
              <td class='t1 b2 l1'><div align='right' class='courier s12 black bold'>&nbsp;".number_format($hstact,2)."&nbsp;</div></td>
              <td class='t1 b2 l1'><div align='right' class='courier s12 black bold'>&nbsp;".number_format($hstadj,2)."&nbsp;</div></td>
              <td class='t1 b2 l1'><div align='right' class='courier s12 black bold'>&nbsp;".number_format($hsthmo,2)."&nbsp;</div></td>
              <td class='t1 b2 l1'><div align='right' class='courier s12 black bold'>&nbsp;".number_format($hstph1,2)."&nbsp;</div></td>
              <td class='t1 b2 l1'><div align='right' class='courier s12 black bold'>&nbsp;".number_format($hstph2,2)."&nbsp;</div></td>
              <td class='t1 b2 l1 r2'><div align='right' class='courier s12 black bold'>&nbsp;".number_format($hstfin,2)."&nbsp;</div></td>
            </tr>
";
      }

      $htact+=$hstact;
      $htadj+=$hstadj;
      $htgrs+=$hstgrs;
      $htph1+=$hstph1;
      $htph2+=$hstph2;
      $hthmo+=$hsthmo;

echo "
            <tr>
              <td class='b1' colspan='9' height='10'></td>
            </tr>
";

    }
    //GTYPE 1111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111
    else if($gtype==1){
echo "
            <tr>
              <td class='t1 b2 l2 r2' colspan='9'><a href='subdetails.php?caseno=$caseno&label=$label' target='_blank' class='astyle'><div align='left' class='courier s14 black bold'>&nbsp;$label</div></a></td>
            </tr>
";

//ALL OTHERS-------------------------------------------------------------------------------------------------------------------------------
      $apotact=0;
      $apotadj=0;
      $apotgrs=0;
      $apotph1=0;
      $apotph2=0;
      $apothmo=0;
      $aposql=mysqli_query($mycon1,"SELECT `productdesc`, cast(`sellingprice` as decimal(10,2)) AS `sp`, SUM(`quantity`) AS `qty`, SUM(cast(`adjustment` as decimal(10,2))) AS `adj`, SUM(cast(`phic` as decimal(10,2))) AS `ph1`, SUM(cast(`phic1` as decimal(10,2))) AS `ph2`, SUM(cast(`hmo` as decimal(10,2))) AS `hmo` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 AND `productsubtype` NOT LIKE 'PROFESSIONAL FEE' $alloth GROUP BY `productcode`, `sellingprice` ORDER BY `productdesc`");
      while($apofetch=mysqli_fetch_array($aposql)){
        $apotdesc=$apofetch['productdesc'];
        $apotact+=$apofetch['sp']*$apofetch['qty'];
        $apotadj+=$apofetch['adj'];
        $apotgrs+=($apofetch['sp']*$apofetch['qty'])-$apofetch['adj'];
        $apotph1+=$apofetch['ph1'];
        $apotph2+=$apofetch['ph2'];
        $apothmo+=$apofetch['hmo'];

        $apotdesc=str_replace("ams-","",$apotdesc);
        $apotdesc=str_replace("-med","",$apotdesc);
        $apotdesc=str_replace("-sup","",$apotdesc);

echo "
            <tr>
              <td class='b1 l2'><a href='subdetails.php?caseno=$caseno&label=$label' target='_blank' class='astyle'><div align='left' class='courier s11 black'>&nbsp;$apotdesc</div></a></td>
              <td class='b1 l1'><div align='right' class='courier s11 black'>&nbsp;".number_format(($apofetch['sp']),2)."&nbsp;</div></td>
              <td class='b1 l1'><div align='right' class='courier s11 black'>&nbsp;".$apofetch['qty']."&nbsp;</div></td>
              <td class='b1 l1'><div align='right' class='courier s11 black'>&nbsp;".number_format(($apofetch['sp']*$apofetch['qty']),2)."&nbsp;</div></td>
              <td class='b1 l1'><div align='right' class='courier s11 black'>&nbsp;".number_format($apofetch['adj'],2)."&nbsp;</div></td>
              <td class='b1 l1'><div align='right' class='courier s11 black'>&nbsp;".number_format($apofetch['hmo'],2)."&nbsp;</div></td>
              <td class='b1 l1'><div align='right' class='courier s11 black'>&nbsp;".number_format($apofetch['ph1'],2)."&nbsp;</div></td>
              <td class='b1 l1'><div align='right' class='courier s11 black'>&nbsp;".number_format($apofetch['ph2'],2)."&nbsp;</div></td>
              <td class='b1 l1 r2'><div align='right' class='courier s11 black'>&nbsp;".number_format((($apofetch['sp']*$apofetch['qty'])-$apofetch['adj']),2)."&nbsp;</div></td>
            </tr>
";
      }

      $apotfin=round((round($apotact,2)-round($apotadj,2)-round($apotph1,2)-round($apotph2,2)-round($apothmo,2)),2);

      if(round($apotact,2)>0){
echo "
            <tr>
              <td class='t1 b2 l2' colspan='3' height='25'><div align='left' class='courier s12 black bold'>&nbsp;SUB TOTAL</div></td>
              <td class='t1 b2 l1'><div align='right' class='courier s12 black bold'>&nbsp;".number_format($apotact,2)."&nbsp;</div></td>
              <td class='t1 b2 l1'><div align='right' class='courier s12 black bold'>&nbsp;".number_format($apotadj,2)."&nbsp;</div></td>
              <td class='t1 b2 l1'><div align='right' class='courier s12 black bold'>&nbsp;".number_format($apothmo,2)."&nbsp;</div></td>
              <td class='t1 b2 l1'><div align='right' class='courier s12 black bold'>&nbsp;".number_format($apotph1,2)."&nbsp;</div></td>
              <td class='t1 b2 l1'><div align='right' class='courier s12 black bold'>&nbsp;".number_format($apotph2,2)."&nbsp;</div></td>
              <td class='t1 b2 l1 r2'><div align='right' class='courier s12 black bold'>&nbsp;".number_format($apotfin,2)."&nbsp;</div></td>
            </tr>
";
      }

echo "
            <tr>
              <td class='b1' colspan='9' height='10'></td>
            </tr>
";
      //END ALL OTHERS---------------------------------------------------------------------------------------------------------------------------
    }
  }
}
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

//HOSPITAL SUB TOTAL-----------------------------------------------------------------------------------------------------------------------
$subact=$htact+$apotact;
$subadj=$htadj+$apotadj;
$subgrs=$htgrs+$apotgrs;
$subph1=$htph1+$apotph1;
$subph2=$htph2+$apotph2;
$subhmo=$hthmo+$apothmo;

$subfin=round((round($subact,2)-round($subadj,2)-round($subph1,2)-round($subph2,2)-round($subhmo,2)),2);

echo "
            <!-- tr>
              <td class='t1 b1 l2' height='18' colspan='3'><div align='left' class='courier s13 black bold'>&nbsp;TOTAL</div></td>
              <td class='t1 b1 l1'><div align='right' class='courier s13 black bold'>&nbsp;".number_format($subact,2)."&nbsp;</div></td>
              <td class='t1 b1 l1'><div align='right' class='courier s13 black bold'>&nbsp;".number_format($subadj,2)."&nbsp;</div></td>
              <td class='t1 b1 l1'><div align='right' class='courier s13 black bold'>&nbsp;".number_format($subhmo,2)."&nbsp;</div></td>
              <td class='t1 b1 l1'><div align='right' class='courier s13 black bold'>&nbsp;".number_format($subph1,2)."&nbsp;</div></td>
              <td class='t1 b1 l1'><div align='right' class='courier s13 black bold'>&nbsp;".number_format($subph2,2)."&nbsp;</div></td>
              <td class='t1 b1 l1 r2'><div align='right' class='courier s13 black bold'>&nbsp;".number_format($subfin,2)."&nbsp;</div></td>
            </tr>
";

//END HOSPITAL SUB TOTAL-------------------------------------------------------------------------------------------------------------------

echo "
            <tr>
              <td class='t1 b1' colspan='9' height='10'></td>
            </tr -->
";

echo "
<!-- CHARGES END------------------------------------------------------------------------------------------------------------------------------- -->


<!-- PF START---------------------------------------------------------------------------------------------------------------------------------- -->
            <tr>
              <td class='t1 b1 l2 r2 bgblack' colspan='9'><div align='center' class='courier s16 white bold'>&nbsp;PROFESSIONAL FEE</div></td>
            </tr>
";

//PROFESSIONAL FEE-------------------------------------------------------------------------------------------------------------------------
$pfact=0;
$pfadj=0;
$pfgrs=0;
$pfph1=0;
$pfph2=0;
$pfhmo=0;
$pfnum=0;

//admitting--------------------------------------
$pfaact=0;
$pfaadj=0;
$pfagrs=0;
$pfaph1=0;
$pfaph2=0;
$pfahmo=0;

$atcount=0;$sucount=0;$ancount=0;
$prcount=0;$tprgr=0;$tprad=0;$tprp1=0;$tprp2=0;$tprhm=0;$tprex=0;
$prsql=mysqli_query($mycon1,"SELECT `productdesc`, `producttype` FROM `productout` WHERE `caseno`='$caseno' AND `productsubtype`='PROFESSIONAL FEE' AND (`producttype`='IPD attending' OR `producttype`='IPD comanaged' OR `producttype`='IPD surgeon' OR `producttype`='IPD co-surgeon' OR `producttype`='IPD anesthesiologist' OR `producttype`='IPD co-anesthesiologist' OR `producttype`='ON CALL') ORDER BY FIELD(`producttype`, 'IPD attending', 'IPD comanaged', 'IPD surgeon', 'IPD co-surgeon', 'IPD anesthesiologist', 'IPD co-anesthesiologist', 'ON CALL'),`productdesc`");
while($prfetch=mysqli_fetch_array($prsql)){
  $prdoctor=$prfetch['productdesc'];
  $prptype=$prfetch['producttype'];
  $prcount++;

  $pra=0;$pragr=0;$praad=0;$prap1=0;$prap2=0;$prahm=0;$praex=0;
  $pratsql=mysqli_query($mycon1,"SELECT * FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `productdesc`='$prdoctor'");
  while($pratfetch=mysqli_fetch_array($pratsql)){$pragr+=($pratfetch['sellingprice']*$pratfetch['quantity']);$praad+=$pratfetch['adjustment'];$prap1+=$pratfetch['phic'];$prap2+=$pratfetch['phic1'];$prahm+=$pratfetch['hmo'];$praex+=$pratfetch['excess'];}

  $zxamount=0;
  $zxsql=mysqli_query($mycon1,"SELECT `amount`, `accttitle` FROM `collection` WHERE `acctno`='$caseno' AND `description`='$prdoctor' AND `accttitle` LIKE '%AR%%PF%'");
  while($zxfetch=mysqli_fetch_array($zxsql)){
    $zxacc=$zxfetch['accttitle'];
    if($zxacc!="AR TRADE PF"){
      $zxamount+=$zxfetch['amount'];
    }
  }

  $tprgr+=$pragr;$tprad+=$praad;$tprp1+=$prap1;$tprp2+=$prap2;$tprhm+=($prahm+$zxamount);$tprex+=($praex-$zxamount);

if($prptype=="ON CALL"){$drtitle="";}else{$drtitle="DR. ";}

$pfdesc=$prdoctor;
$pfiact=$pragr;
$pfiadj=$praad;
$pfihmo=$prahm+$zxamount;
$pfiph1=$prap1;
$pfiph2=$prap2;
$pfifin=$praex-$zxamount;

$pfact+=$pfiact;
$pfadj+=$pfiadj;
$pfgrs+=$pfact-$pfadj;
$pfph1+=$pfiph1;
$pfph2+=$pfiph2;
$pfhmo+=$pfihmo;

echo "
            <tr>
              <td class='b1 l2' colspan='3' title='$prptype'><a href='subdetails.php?caseno=$caseno&label=PF' target='_blank' class='astyle'><div align='left' class='courier s11 black bold'>&nbsp;$prcount. $drtitle$pfdesc&nbsp;</div></a></td>
              <td class='b1 l1'><div align='right' class='courier s11 black'>&nbsp;".number_format($pfiact,2)."&nbsp;</div></td>
              <td class='b1 l1'><div align='right' class='courier s11 black'>&nbsp;".number_format($pfiadj,2)."&nbsp;</div></td>
              <td class='b1 l1'><div align='right' class='courier s11 black'>&nbsp;".number_format($pfihmo,2)."&nbsp;</div></td>
              <td class='b1 l1'><div align='right' class='courier s11 black'>&nbsp;".number_format($pfiph1,2)."&nbsp;</div></td>
              <td class='b1 l1'><div align='right' class='courier s11 black'>&nbsp;".number_format($pfiph2,2)."&nbsp;</div></td>
              <td class='b1 l1 r2'><div align='right' class='courier s11 black'>&nbsp;".number_format($pfifin,2)."&nbsp;</div></td>
            </tr>
";
}

$pffin=round((round($pfact,2)-round($pfadj,2)-round($pfph1,2)-round($pfph2,2)-round($pfhmo,2)),2);
//END PROFESSIONAL FEE---------------------------------------------------------------------------------------------------------------------

$stpbgp1="";
$stpbgp2="";

if(number_format($pfph1,2)!=number_format($p1,2)){
  $stpbgp1="#FF0000";
}

if(number_format($pfph2,2)!=number_format($p2,2)){
  $stpbgp2="#FF0000";
}

echo "
            <tr>
              <td class='t1 b1 l2' height='25' colspan='3'><div align='left' class='courier s13 black bold'>&nbsp;SUB TOTAL</div></td>
              <td class='t1 b1 l1'><div align='right' class='courier s13 black bold'>&nbsp;".number_format($pfact,2)."&nbsp;</div></td>
              <td class='t1 b1 l1'><div align='right' class='courier s13 black bold'>&nbsp;".number_format($pfadj,2)."&nbsp;</div></td>
              <td class='t1 b1 l1'><div align='right' class='courier s13 black bold'>&nbsp;".number_format($pfhmo,2)."&nbsp;</div></td>
              <td class='t1 b1 l1' bgcolor='$stpbgp1'><div align='right' class='courier s13 black bold'>&nbsp;".number_format($pfph1,2)."&nbsp;</div></td>
              <td class='t1 b1 l1' bgcolor='$stpbgp2'><div align='right' class='courier s13 black bold'>&nbsp;".number_format($pfph2,2)."&nbsp;</div></td>
              <td class='t1 b1 l1 r2'><div align='right' class='courier s13 black bold'>&nbsp;".number_format($pffin,2)."&nbsp;</div></td>
            </tr>
<!-- PF END------------------------------------------------------------------------------------------------------------------------------------ -->
";


$allact=round(($subact+$pfact),2);
$alladj=round(($subadj+$pfadj),2);
$allgrs=round(($subgrs+$pfgrs),2);
$allph1=round(($subph1+$pfph1),2);
$allph2=round(($subph2+$pfph2),2);
$allhmo=round(($subhmo+$pfhmo),2);

$allfin=round(($subfin+$pffin),2);

$tbgp1="";
$tbgp2="";

if(number_format($allph1,2)!=number_format(($h1+$p1),2)){
  $tbgp1="#FF0000";
}

if(number_format($allph2,2)!=number_format(($h2+$p2),2)){
  $tbgp2="#FF0000";
}

echo "
            <tr>
              <td class='t1 b1' colspan='9' height='10'></td>
            </tr>
            <tr>
              <td class='t1 b1 l2' height='25' colspan='3'><div align='left' class='courier s13 black bold'>&nbsp;TOTAL</div></td>
              <td class='t1 b1 l1'><div align='right' class='courier s13 black bold'>&nbsp;".number_format($allact,2)."&nbsp;</div></td>
              <td class='t1 b1 l1'><div align='right' class='courier s13 black bold'>&nbsp;".number_format($alladj,2)."&nbsp;</div></td>
              <td class='t1 b1 l1'><div align='right' class='courier s13 black bold'>&nbsp;".number_format($allhmo,2)."&nbsp;</div></td>
              <td class='t1 b1 l1' bgcolor='$tbgp1'><div align='right' class='courier s13 black bold'>&nbsp;".number_format($allph1,2)."&nbsp;</div></td>
              <td class='t1 b1 l1' bgcolor='$tbgp2'><div align='right' class='courier s13 black bold'>&nbsp;".number_format($allph2,2)."&nbsp;</div></td>
              <td class='t1 b1 l1 r2'><div align='right' class='courier s13 black bold'>&nbsp;".number_format($allfin,2)."&nbsp;</div></td>
            </tr>
            <tr>
              <td class='t1 b1' colspan='9' height='10'></td>
            </tr>
";


echo "
<!-- PAYMENT START----------------------------------------------------------------------------------------------------------------------------- -->
            <tr>
              <td class='t1 b1 l2 r2' height='18' colspan='9'><div align='left' class='courier s14 black bold'>&nbsp;LESS:</div></td>
            </tr>
";

$removeamt=0;
$lessacct=mysqli_query($mycon1,"SELECT type as status,accttitle as acctitle, amount, datearray,refno,ofr FROM collection where acctno='$caseno'  and accttitle like '%AR %'");
while($lessacctfetch=mysqli_fetch_array($lessacct)){
  $acstatus=$lessacctfetch['status'];
  $acctitle=$lessacctfetch['acctitle'];

  if($acctitle=="AR TRADE" or $acctitle=="AR TRADE PF"){
    $acctitle=str_replace(' PF','',$acctitle);

    if($acstatus=="cash-Visa"){

      $amount=$lessacctfetch['amount'];
      $date=$lessacctfetch['datearray'];

echo "
            <tr>
              <td class='t1 b1 l2' colspan='8'><div align='left' class='courier s13 black'>&nbsp;$acctitle - $lessacctfetch[ofr] - $date</div></td>
              <td class='t1 b1 l1 r2'><div align='right' class='courier s13 black'>&nbsp;".number_format($amount,2)."&nbsp;</div></td>
            </tr>
";
    }
  }
  else{
    if((stripos($acctitle, "AR ") !== FALSE)&&(stripos($acctitle, " PF") !== FALSE)){
        $amount=$lessacctfetch['amount'];
        $date=$lessacctfetch['datearray'];
        $removeamt+=$amount;
        $amount=0;


    }
    else{
        $amount=$lessacctfetch['amount'];
        $date=$lessacctfetch['datearray'];
        $acctitle=str_replace(' PF','',$acctitle);

echo "
            <tr>
              <td class='t1 b1 l2' colspan='8'><div align='left' class='courier s13 black'>&nbsp;$acctitle - $lessacctfetch[ofr] - $date</div></td>
              <td class='t1 b1 l1 r2'><div align='right' class='courier s13 black'>&nbsp;".number_format($amount,2)."&nbsp;</div></td>
            </tr>
";
    }
  }
}

$lesscollect=mysqli_query($mycon1,"SELECT * FROM collection where acctno='$caseno' and (accttitle='PATIENTS DEPOSIT' OR accttitle='PF DEPOSIT') and type !='pending' ");
while($lesscollectfech=mysqli_fetch_array($lesscollect)){
  $acctitle=$lesscollectfech['accttitle'];
  $amount=$lesscollectfech['amount'];
  $ofr=$lesscollectfech['ofr'];
  $date=$lesscollectfech['date'];

echo "
            <tr>
              <td class='t1 b1 l2' colspan='8'><div align='left' class='courier s13 black'>&nbsp;$acctitle - $ofr - $date</div></td>
              <td class='t1 b1 l1 r2'><div align='right' class='courier s13 black'>&nbsp;".number_format($amount,2)."&nbsp;</div></td>
            </tr>
";
}

$lesscollect=mysqli_query($mycon1,"SELECT accttitle,sum(amount) as amount,ofr,date FROM collection where acctno='$caseno' and (accttitle='CASHONHAND' or accttitle='PROFESSIONAL FEE') and type !='pending' group by ofr");
while($lesscollectfech=mysqli_fetch_array($lesscollect)){
  $acctitle=$lesscollectfech['accttitle'];
  $amount=$lesscollectfech['amount'];
  $ofr=$lesscollectfech['ofr'];
  $date=$lesscollectfech['date'];

echo "
            <tr>
              <td class='t1 b1 l2' colspan='8'><div align='left' class='courier s13 black'>&nbsp;CASHONHAND - $ofr - $date</div></td>
              <td class='t1 b1 l1 r2'><div align='right' class='courier s13 black'>&nbsp;".number_format($amount,2)."&nbsp;</div></td>
            </tr>
";
}

$lesscollect=mysqli_query($mycon1,"SELECT pd.accttitle,pd.amount,c.description,pd.datearray FROM collection c INNER JOIN pfdiscount pd ON pd.refno=c.refno where pd.caseno='$caseno'");
while($lesscollectfech=mysqli_fetch_array($lesscollect)){
  $acctitle=$lesscollectfech['accttitle'];
  $amount=$lesscollectfech['amount'];
  $description=$lesscollectfech['description'];
  $date=$lesscollectfech['datearray'];

echo "
            <tr>
              <td class='t1 b1 l2' colspan='8'><div align='left' class='courier s13 black'>&nbsp;$acctitle - $description - $date</div></td>
              <td class='t1 b1 l1 r2'><div align='right' class='courier s13 black'>&nbsp;".number_format($amount,2)."&nbsp;</div></td>
            </tr>
";
}


//start-- sum of the total Less (AR and Patient's Deposit)
$total_AR=0;
$AR_query=mysqli_query($mycon1,"SELECT * FROM acctgenledge where caseno='$caseno' and (acctitle like '%AR %')");
while($AR_fetch=mysqli_fetch_array($AR_query)){
  $acct=$AR_fetch['acctitle'];
  $statu=$AR_fetch['status'];

  if($acct=="AR TRADE" or $acct=="AR TRADE PF"){
    if($statu=="PAID"){
      $acctitle=$AR_fetch['acctitle'];
      $amount=$AR_fetch['amount'];
      $total_AR +=$amount;
    }
  }
  else{
    $acctitle=$AR_fetch['acctitle'];
    $amount=$AR_fetch['amount'];
    $total_AR +=$amount;
  }
}

$total_PD=0;
$PD_query=mysqli_query($mycon1,"SELECT * FROM collection where acctno='$caseno' and (accttitle='PATIENTS DEPOSIT' or accttitle='PF DEPOSIT' or accttitle='CASHONHAND' or accttitle='PROFESSIONAL FEE') and type !='pending' ");
while($PD_fetch=mysqli_fetch_array($PD_query)){
  $acctitle=$PD_fetch['accttitle'];
  $amount=$PD_fetch['amount'];
  $total_PD +=$amount;
}

$total_less= ($total_AR + $total_PD) - $removeamt;
$total_disc=0;

$PD_query=mysqli_query($mycon1,"SELECT amount,accttitle FROM pfdiscount where caseno='$caseno'");
while($PD_fetch=mysqli_fetch_array($PD_query)){
  $acctitle=$PD_fetch['accttitle'];
  $amount=$PD_fetch['amount'];
  $total_disc +=$amount;
}

$total_less= $total_less + $total_disc;
echo "
            <tr>
              <td class='t1 b1 l2' height='22' colspan='8'><div align='left' class='courier s13 black bold'>&nbsp;Subtotal Less</div></td>
              <td class='t1 b1 l1 r2'><div align='right' class='courier s13 black bold'>&nbsp;".number_format($total_less,2)."&nbsp;</div></td>
            </tr>
";

//end-- sum of the total Less (AR and Patient's Deposit)
$net=$allfin-$total_less;
echo "
            <tr>
              <td class='t1 b2 l2' height='22' colspan='8'><div align='left' class='courier s15 black bold'>&nbsp;NET</div></td>
              <td class='t1 b2 l1 r2'><div align='right' class='courier s15 black bold'>&nbsp;".number_format($net,2)."&nbsp;</div></td>
            </tr>

<!-- PAYMENT END------------------------------------------------------------------------------------------------------------------------------- -->
";


echo "
          </table></td>
        </tr>
        <!-- ------------------------------------------------------------------------------------------------------------------------------ -->

      </table></td>
    </tr>
";



echo "
    <tr>
      <td><div align='left'><table border='0' width=70%' cellpadding='0' cellspacing='0'>
        <tr>
          <td colspan='2' height='10'></td>
        </tr>
        <tr>
          <td colspan='2'><div align='left' class='arial s14 black'>BILLER: <u><span class='bold'>$setuser</span></u></div></td>
        </tr>
        <tr>
          <td colspan='2' height='10'></td>
        </tr>
";

//RETURN
$retsql=mysqli_query($mycon1,"SELECT `productdesc`, SUM(`sellingprice`*`quantity`) AS `amount` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='return' GROUP BY `productdesc`");
if(mysqli_num_rows($retsql)>0){
echo "
        <tr>
          <td colspan='2'><div align='left' class='arial s14 red bold'>RETURNED ITEMS:</div></td>
        </tr>
";

	while($retfetch=mysqli_fetch_array($retsql)){
echo "
        <tr>
          <td><div align='left' class='courier s14 red'>".$retfetch['productdesc']."</div></td>
          <td><div align='right' class='courier s14 red'>".number_format($retfetch['amount'],2)."</div></td>
        </tr>
";
	}
}

$pensql=mysqli_query($mycon1,"SELECT `productdesc`, SUM(`sellingprice`*`quantity`) AS `amount` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `sellingprice` > '0' AND `quantity` > '0' AND `gross` > '0' AND `administration`='pending' GROUP BY `productdesc`");
if(mysqli_num_rows($pensql)>0){
echo "
        <tr>
          <td colspan='2'><div align='left' class='arial s14 red bold'>PENDING ITEMS:</div></td>
        </tr>
";

	while($penfetch=mysqli_fetch_array($pensql)){
echo "
        <tr>
          <td><div align='left' class='courier s14 red'>".$penfetch['productdesc']."</div></td>
          <td><div align='right' class='courier s14 red'>".number_format($penfetch['amount'],2)."</div></td>
        </tr>
";
	}
}

$dissql=mysqli_query($mycon1,"SELECT `productdesc`, SUM(`sellingprice`*`quantity`) AS `amount` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `sellingprice` > '0' AND `quantity` > '0' AND `gross` > '0' AND `administration`='dispensed' GROUP BY `productdesc`");
if(mysqli_num_rows($dissql)>0){
echo "
        <tr>
          <td colspan='2'><div align='left' class='arial s14 red bold'>DISPENSED ITEMS:</div></td>
        </tr>
";

	while($disfetch=mysqli_fetch_array($dissql)){
echo "
        <tr>
          <td><div align='left' class='courier s14 red'>".$disfetch['productdesc']."</div></td>
          <td><div align='right' class='courier s14 red'>".number_format($disfetch['amount'],2)."</div></td>
        </tr>
";
	}
}

echo "
      </table></div></td>
    </tr>
  </table>
</div>
</body>
</html>
";

?>
