<?php
ini_set("display_errors","On");
include("query.php");

$resall= fopen("../../../2017codes/SOA/Logs/$caseno.txt", "w") or die("Unable to open file!");
fwrite($resall, "");

echo "
<!doctype html>
<html>
<head>
  <meta charset='utf-8'>
  <title>SOA - $heading</title>
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
              <td width='110' rowspan='5'><div align='center'><a href='LabelManagement.php' style='text-decoration: none;' target='_blank'><img src='../Resources/Logo/logo.png' height='100' width='auto' /></a></div></td>
              <td width='auto'><div align='center' class='times s16 black bold'>STATEMENT OF ACCOUNT</div></td>
              <td width='110'></td>
            </tr>
            <tr>
              <td height='10' colspan='2'></td>
            </tr>
            <tr>
              <td colspan='2' height='30' valign='middle'><div align='right'><table border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td><div align='left' class='times s14 black bold'>SOA Reference No.</div></td>
                  <td width='15'><div align='center' class='times s14 black bold'>:</div></td>
                  <td class='b1'><div align='left' class='arial s16 black'>$caseno</div></td>
                </tr>
              </table></div></td>
            </tr>
            <tr>
              <td height='10' colspan='2'></td>
            </tr>
            <tr>
              <td><div align='center' class='times black'><span class='bold s14'>$heading</span><br /><span class='s12'>$hadd<br />$htelno</span></div></td>
              <td></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height='15'></td>
        </tr>
";

include("header.php");

echo "
        <tr>
          <td height='15'></td>
        </tr>
        <tr>
          <td><div align='center' class='times s14 black bold'>SUMMARY OF FEES</div></td>
        </tr>
        <tr>
          <td height='15'></td>
        </tr>

        <!-- ------------------------------------------------------------------------------------------------------------------------------ -->
        <tr>
          <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='auto' class='t2 b2 l2' rowspan='2'><div align='center' class='times s12 black bold'>Particulars</div></td>
              <td width='65' class='t2 b2 l1' rowspan='2'><div align='center' class='times s12 black bold'>Actual<br />Charges</div></td>
              <td class='t2 b1 l1' colspan='2'><div align='center' class='times s12 black bold'>Amount of Discounts</div></td>
              <td class='t2 b1 l1' colspan='2'><div align='center' class='times s12 black bold'>PhilHealth benefits</div></td>
              <td width='65' class='t2 b2 l1 r2' rowspan='2'><div align='center' class='times s12 black bold'>Out of<br />Pocket<br />of Patient</div></td>
            </tr>
            <tr>
              <td width='65' class='b2 l1'><div align='center' class='times s12 black bold'>Senior<br />Citizen/<br />PWD</div></td>
              <td width='65' class='b2 l1'><a href='../../2017codes/SOA/DiscType.php?caseno=$caseno' class='astyle' target='_blank'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='2'></td>
                  <td width='auto'><div align='left' class='times s8 black bold'>Place &#10004;</div></td>
                </tr>
";

$tddssql=mysqli_query($conn,"SELECT discounttype1, discounttype2, discounttype3, discounttype4, discounttype5, discounttype5o FROM tempdatestorage WHERE caseno='$caseno'");
$tddscount=mysqli_num_rows($tddssql);

if($tddscount==0){
  $pcso="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  $dswd="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  $doh="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  $hmo="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  $others="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  $othersVal="";

  $discounttype5="";
}
else{
  while($tddsfetch=mysqli_fetch_array($tddssql)){
    $discounttype1=$tddsfetch['discounttype1'];
    $discounttype2=$tddsfetch['discounttype2'];
    $discounttype3=$tddsfetch['discounttype3'];
    $discounttype4=$tddsfetch['discounttype4'];
    $discounttype5=$tddsfetch['discounttype5'];
    $discounttype5o=$tddsfetch['discounttype5o'];
  }

  if($discounttype1=="c"){$pcso="&nbsp;&#10004;&nbsp;";}else{$pcso="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}
  if($discounttype2=="c"){$dswd="&nbsp;&#10004;&nbsp;";}else{$dswd="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}
  if($discounttype3=="c"){$doh="&nbsp;&#10004;&nbsp;";}else{$doh="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}
  if($discounttype4=="c"){$hmo="&nbsp;&#10004;&nbsp;";}else{$hmo="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}
  if($discounttype5=="c"){$others="&nbsp;&#10004;&nbsp;";$othersval=$discounttype5o;}else{$others="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";$othersval="";}

}

if(stripos($hmomembership, "hmo-") !== FALSE){$hmo="&nbsp;&#10004;&nbsp;";$hmodisp="<br /><span style='font-size: 8px;'>".$sethmo."</span>";}else{$hmodisp="";}

echo "
                <tr>
                  <td></td>
                  <td><div align='left' class='times s10 black bold'><u>".$pcso."</u>PCSO</div></td>
                </tr>
                <tr>
                  <td></td>
                  <td><div align='left' class='times s10 black bold'><u>".$dswd."</u>DSWD</div></td>
                </tr>
                <tr>
                  <td></td>
                  <td><div align='left'><span class='times s10 black bold'><u>".$doh."</u>DOH</span><span class='times s8 black'>(MAP)</span></div></td>
                </tr>
                <tr>
                  <td></td>
                  <td><div align='left' class='times s10 black bold'><u>".$hmo."</u>HMO $hmodisp</div></td>
                </tr>
                <tr>
                  <td></td>
                  <td><div align='left' class='times s10 black bold'><u>".$others."</u>Others:</div></td>
                </tr>
";


if($discounttype5=="c"){
echo "
                <tr>
                  <td></td>
                  <td><div align='left' class='times s10 black bold'>&nbsp;$othersval</div></td>
                </tr>
";
}
else{
echo "
                <tr>
                  <td></td>
                  <td><div align='left' class='times s10 black bold'>&nbsp;</div></td>
                </tr>
";
}

echo "
              </table></a></td>
              <td width='65' class='b2 l1'><div align='center' class='times s12 black bold'>First<br />Case Rate<br />amount</div></td>
              <td width='65' class='b2 l1'><div align='center' class='times s12 black bold'>Second<br />Case Rate<br />amount</div></td>
            </tr>
            <!-- ------------------------------------------------------------------------------------------------------------------------------ -->

<!-- CHARGES START----------------------------------------------------------------------------------------------------------------------------- -->
            <tr>
              <td class='b2 l2'><a href='../../2020codes/AutoDistro/showcharges.php?caseno=$caseno' target='_blank' class='astyle'><div align='center' class='times s12 black bold'>HCI fees</div></a></td>
              <td class='b2 l1 r2' colspan='6'><div align='center' class='times s12 black bold'>&nbsp;</div></td>
            </tr>
";

$htact=0;
$htadj=0;
$htgrs=0;
$htph1=0;
$htph2=0;
$hthmo=0;
$alloth="";
$stsql=mysqli_query($conn,"SELECT `autono`, `label` FROM `soasetup` ORDER BY CAST(`sort` AS unsigned)");
while($stfetch=mysqli_fetch_array($stsql)){
  $no=$stfetch['autono'];
  $label=$stfetch['label'];

  $hstact=0;
  $hstadj=0;
  $hstgrs=0;
  $hstph1=0;
  $hstph2=0;
  $hsthmo=0;
  $sdsql=mysqli_query($conn,"SELECT `productsubtype`, `type`, `producttype`, `terminalname`, `administration` FROM `soasetupdetails` WHERE `no`='$no'");
  while($sdfetch=mysqli_fetch_array($sdsql)){
    $type=$sdfetch['type'];
    $productsubtype=$sdfetch['productsubtype'];
    $producttype=$sdfetch['producttype'];
    $terminalname=$sdfetch['terminalname'];
    $administration=$sdfetch['administration'];

    $alloth=$alloth." AND productsubtype NOT LIKE '$productsubtype'";

    //PREDEFINED CONDITIONS------------
    if($type==1){
      $posql=mysqli_query($conn,"SELECT `productdesc`, cast(`sellingprice` as decimal(10,2)) AS `sp`, cast(`quantity` as decimal(10,2)) AS `qty`, cast(`adjustment` as decimal(10,2)) AS `adj`, cast(`phic` as decimal(10,2)) AS `ph1`, cast(`phic1` as decimal(10,2)) AS `ph2`, cast(`hmo` as decimal(10,2)) AS `hmo` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 AND `productsubtype` LIKE '$productsubtype'");
    }
    else if($type==2){
      $posql=mysqli_query($conn,"SELECT `productdesc`, cast(`sellingprice` as decimal(10,2)) AS `sp`, cast(`quantity` as decimal(10,2)) AS `qty`, cast(`adjustment` as decimal(10,2)) AS `adj`, cast(`phic` as decimal(10,2)) AS `ph1`, cast(`phic1` as decimal(10,2)) AS `ph2`, cast(`hmo` as decimal(10,2)) AS `hmo` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 AND `productsubtype` LIKE '$productsubtype' AND `administration` LIKE '$administration'");
    }
    else if($type==3){
      $posql=mysqli_query($conn,"SELECT `productdesc`, cast(`sellingprice` as decimal(10,2)) AS `sp`, cast(`quantity` as decimal(10,2)) AS `qty`, cast(`adjustment` as decimal(10,2)) AS `adj`, cast(`phic` as decimal(10,2)) AS `ph1`, cast(`phic1` as decimal(10,2)) AS `ph2`, cast(`hmo` as decimal(10,2)) AS `hmo` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 AND `gross` > 0 AND `productsubtype` LIKE '$productsubtype' AND `terminalname` LIKE '$terminalname'");
    }
    else if($type==4){
      $posql=mysqli_query($conn,"SELECT `productdesc`, cast(`sellingprice` as decimal(10,2)) AS `sp`, cast(`quantity` as decimal(10,2)) AS `qty`, cast(`adjustment` as decimal(10,2)) AS `adj`, cast(`phic` as decimal(10,2)) AS `ph1`, cast(`phic1` as decimal(10,2)) AS `ph2`, cast(`hmo` as decimal(10,2)) AS `hmo` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 AND `gross` > 0 AND `productsubtype` LIKE '$productsubtype' AND `producttype` LIKE '$producttype'");
    }
    //---------------------------------

    while($pofetch=mysqli_fetch_array($posql)){
      //if(($productsubtype=="PHARMACY/SUPPLIES")||($productsubtype=="MEDICAL SURGICAL SUPPLIES")){echo $pofetch['productdesc']." --> |".$productsubtype."|<br />";}
      $hstact+=$pofetch['sp']*$pofetch['qty'];
      $hstadj+=$pofetch['adj'];
      $hstgrs+=($pofetch['sp']*$pofetch['qty'])-$pofetch['adj'];
      $hstph1+=$pofetch['ph1'];
      $hstph2+=$pofetch['ph2'];
      $hsthmo+=$pofetch['hmo'];
    }
  }

  $hstfin=round((round($hstact,2)-round($hstadj,2)-round($hstph1,2)-round($hstph2,2)-round($hsthmo,2)),2);

if($hstact>0){
echo "
            <tr>
              <td class='b1 l2'><a href='subdetails.php?caseno=$caseno&label=$label' target='_blank' class='astyle'><div align='left' class='times s10 black bold' style='padding: 0 3px;'>$label</div></a></td>
              <td class='b1 l1'><div align='right' class='times s10 black' style='padding: 0 3px;'>".number_format($hstact,2)."</div></td>
              <td class='b1 l1'><div align='right' class='times s10 black' style='padding: 0 3px;'>".number_format($hstadj,2)."</div></td>
              <td class='b1 l1'><div align='right' class='times s10 black' style='padding: 0 3px;'>".number_format($hsthmo,2)."</div></td>
              <td class='b1 l1'><div align='right' class='times s10 black' style='padding: 0 3px;'>".number_format($hstph1,2)."</div></td>
              <td class='b1 l1'><div align='right' class='times s10 black' style='padding: 0 3px;'>".number_format($hstph2,2)."</div></td>
              <td class='b1 l1 r2'><div align='right' class='times s10 black' style='padding: 0 3px;'>".number_format($hstfin,2)."</div></td>
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
$aposql=mysqli_query($conn,"SELECT `productdesc`, cast(`sellingprice` as decimal(10,2)) AS `sp`, cast(`quantity` as decimal(10,2)) AS `qty`, cast(`adjustment` as decimal(10,2)) AS `adj`, cast(`phic` as decimal(10,2)) AS `ph1`, cast(`phic1` as decimal(10,2)) AS `ph2`, cast(`hmo` as decimal(10,2)) AS `hmo` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 AND `productsubtype` NOT LIKE 'PROFESSIONAL FEE' $alloth");
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
              <td class='b1 l2'><a href='subdetails.php?caseno=$caseno&label=ALLOTHERS&alloth=".base64_encode($alloth)."' target='_blank' class='astyle'><div align='left' class='times s10 black bold' style='padding: 0 3px;'>MISCELLANEOUS</div></a></td>
              <td class='b1 l1'><div align='right' class='times s10 black' style='padding: 0 3px;'>".number_format($apotact,2)."</div></td>
              <td class='b1 l1'><div align='right' class='times s10 black' style='padding: 0 3px;'>".number_format($apotadj,2)."</div></td>
              <td class='b1 l1'><div align='right' class='times s10 black' style='padding: 0 3px;'>".number_format($apothmo,2)."</div></td>
              <td class='b1 l1'><div align='right' class='times s10 black' style='padding: 0 3px;'>".number_format($apotph1,2)."</div></td>
              <td class='b1 l1'><div align='right' class='times s10 black' style='padding: 0 3px;'>".number_format($apotph2,2)."</div></td>
              <td class='b1 l1 r2'><div align='right' class='times s10 black' style='padding: 0 3px;'>".number_format($apotfin,2)."</div></td>
            </tr>
";
}
//END ALL OTHERS---------------------------------------------------------------------------------------------------------------------------


//HOSPITAL SUB TOTAL-----------------------------------------------------------------------------------------------------------------------
$subact=$htact+$apotact;
$subadj=$htadj+$apotadj;
$subgrs=$htgrs+$apotgrs;
$subph1=$htph1+$apotph1;
$subph2=$htph2+$apotph2;
$subhmo=$hthmo+$apothmo;

$subfin=round((round($subact,2)-round($subadj,2)-round($subph1,2)-round($subph2,2)-round($subhmo,2)),2);

echo "
            <tr>
              <td class='t1 b1 l2' height='18'><div align='left' class='times s10 black bold' style='padding: 0 3px;'>Subtotal</div></td>
              <td class='t1 b1 l1'><div align='right' class='times s10 black bold' style='padding: 0 3px;'>".number_format($subact,2)."</div></td>
              <td class='t1 b1 l1'><div align='right' class='times s10 black bold' style='padding: 0 3px;'>".number_format($subadj,2)."</div></td>
              <td class='t1 b1 l1'><div align='right' class='times s10 black bold' style='padding: 0 3px;'>".number_format($subhmo,2)."</div></td>
              <td class='t1 b1 l1'><div align='right' class='times s10 black bold' style='padding: 0 3px;'>".number_format($subph1,2)."</div></td>
              <td class='t1 b1 l1'><div align='right' class='times s10 black bold' style='padding: 0 3px;'>".number_format($subph2,2)."</div></td>
              <td class='t1 b1 l1 r2'><div align='right' class='times s10 black bold' style='padding: 0 3px;'>".number_format($subfin,2)."</div></td>
            </tr>
";
$logall=$subact."|".$subadj."|".$subhmo."|".$subph1."|".$subph2."|".$subfin."|<>";
fwrite($resall, $logall);
//END HOSPITAL SUB TOTAL-------------------------------------------------------------------------------------------------------------------


echo "
<!-- CHARGES END------------------------------------------------------------------------------------------------------------------------------- -->


<!-- PF START---------------------------------------------------------------------------------------------------------------------------------- -->
            <tr>
              <td class='t1 l2'><a href='../../2020codes/AutoDistro/showcharges.php?caseno=$caseno' target='_blank' class='astyle'><div align='center' class='times s12 black bold'>Professional fee/s</div></a></td>
              <td class='t1 b2 l1 r2' rowspan='2' colspan='6'><div align='center' class='times s12 black bold'>&nbsp;</div></td>
            </tr>
            <tr>
              <td>
                <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td width='15' class='t1 b2 l2'><div align='center' class='times s10 black bold'>#</div></td>
                    <td width='80' class='t1 b2 l1'><div align='center' class='times s10 black bold'>P.A.N.</div></td>
                    <td width='auto' class='t1 b2 l1'><div align='center' class='times s10 black bold'>Physician Name</div></td>
                  </tr>
                </table>
              </td>
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
$prsql=mysqli_query($conn,"SELECT `productcode`, `productdesc`, `producttype` FROM `productout` WHERE `caseno`='$caseno' AND `productsubtype`='PROFESSIONAL FEE' AND (`producttype`='IPD attending' OR `producttype`='IPD surgeon' OR `producttype`='IPD anesthesiologist' OR `producttype`='ON CALL') ORDER BY FIELD(`producttype`, 'IPD attending', 'IPD surgeon', 'IPD anesthesiologist', 'ON CALL'),`productdesc`");
while($prfetch=mysqli_fetch_array($prsql)){
  $prcode=$prfetch['productcode'];
  $prdoctor=$prfetch['productdesc'];
  $prptype=$prfetch['producttype'];
  $prcount++;

  $dfsql=mysqli_query($conn,"SELECT `name` FROM `docfile` WHERE `code`='$prcode'");
  $dfcount=mysqli_num_rows($dfsql);
  if($dfcount==0){
    $logdoc=$prdoctor;
  }
  else{
    $dffetch=mysqli_fetch_array($dfsql);
    $logdoc=$dffetch['name'];
  }

  $pra=0;$pragr=0;$praad=0;$prap1=0;$prap2=0;$prahm=0;$praex=0;
  $pratsql=mysqli_query($conn,"SELECT * FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `productdesc`='$prdoctor'");
  while($pratfetch=mysqli_fetch_array($pratsql)){$pragr+=($pratfetch['sellingprice']*$pratfetch['quantity']);$praad+=$pratfetch['adjustment'];$prap1+=$pratfetch['phic'];$prap2+=$pratfetch['phic1'];$prahm+=$pratfetch['hmo'];$praex+=$pratfetch['excess'];}

  if($prptype=="IPD attending"){
  //Attending--------------------------------------------------------------------------------------
    $atcount++;
    if($atcount==1){
      $yxamt=0;
      $prcosql=mysqli_query($conn,"SELECT * FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND (`producttype`='IPD comanaged' OR `producttype`='Consultation')");
      while($prcofetch=mysqli_fetch_array($prcosql)){
        $yxsql=mysqli_query($conn,"SELECT `amount`, `accttitle` FROM `collection` WHERE `acctno`='$caseno' AND `description`='".$prcofetch['productdesc']."' AND `accttitle` LIKE '%AR%%PF%'");
        while($yxfetch=mysqli_fetch_array($yxsql)){
          if(($yxfetch['accttitle']!="AR TRADE PF")&&($yxfetch['accttitle']!="AR EMPLOYEE PF")&&($yxfetch['accttitle']!="AR PERSONAL PF")&&($yxfetch['accttitle']!="AR DOCTOR PF")){
            $yxamt+=$yxfetch['amount'];
          }
        }

        $pragr+=($prcofetch['sellingprice']*$prcofetch['quantity']);$praad+=$prcofetch['adjustment'];$prap1+=$prcofetch['phic'];$prap2+=$prcofetch['phic1'];$prahm+=($prcofetch['hmo']+$yxamt);$praex+=($prcofetch['excess']-$yxamt);
      }
    }
  //End Attending----------------------------------------------------------------------------------
  }
  else if($prptype=="IPD surgeon"){
  //Surgeon----------------------------------------------------------------------------------------
    $sucount++;
    if($sucount==1){
      $yyamt=0;
      $prcssql=mysqli_query($conn,"SELECT * FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `producttype`='IPD co-surgeon'");
      while($prcsfetch=mysqli_fetch_array($prcssql)){
        $yysql=mysqli_query($conn,"SELECT `amount`, `accttitle` FROM `collection` WHERE `acctno`='$caseno' AND `description`='".$prcsfetch['productdesc']."' AND `accttitle` LIKE '%AR%%PF%'");
        while($yyfetch=mysqli_fetch_array($yysql)){
          if(($yyfetch['accttitle']!="AR TRADE PF")&&($yyfetch['accttitle']!="AR EMPLOYEE PF")&&($yyfetch['accttitle']!="AR PERSONAL PF")&&($yyfetch['accttitle']!="AR DOCTOR PF")){
            $yyamt+=$yyfetch['amount'];
          }
        }

        $pragr+=($prcsfetch['sellingprice']*$prcsfetch['quantity']);$praad+=$prcsfetch['adjustment'];$prap1+=$prcsfetch['phic'];$prap2+=$prcsfetch['phic1'];$prahm+=($prcsfetch['hmo']+$yyamt);$praex+=($prcsfetch['excess']-$yyamt);
      }
    }
  //End Surgeon------------------------------------------------------------------------------------
  }
  else if($prptype=="IPD anesthesiologist"){
  //Surgeon----------------------------------------------------------------------------------------
    $ancount++;
    if($ancount==1){
      $yzamt=0;
      $prcasql=mysqli_query($conn,"SELECT * FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `producttype`='IPD co-anesthesiologist'");
      while($prcafetch=mysqli_fetch_array($prcasql)){
        $yzsql=mysqli_query($conn,"SELECT `amount`, `accttitle` FROM `collection` WHERE `acctno`='$caseno' AND `description`='".$prcafetch['productdesc']."' AND `accttitle` LIKE '%AR%%PF%'");
        while($yzfetch=mysqli_fetch_array($yzsql)){
          if(($yzfetch['accttitle']!="AR TRADE PF")&&($yzfetch['accttitle']!="AR EMPLOYEE PF")&&($yzfetch['accttitle']!="AR PERSONAL PF")&&($yzfetch['accttitle']!="AR DOCTOR PF")){
            $yzamt+=$yzfetch['amount'];
          }
        }

        $pragr+=($prcafetch['sellingprice']*$prcafetch['quantity']);$praad+=$prcafetch['adjustment'];$prap1+=$prcafetch['phic'];$prap2+=$prcafetch['phic1'];$prahm+=($prcafetch['hmo']+$yzamt);$praex+=($prcafetch['excess']-$yzamt);
      }
    }
  //End Surgeon------------------------------------------------------------------------------------
  }

  $zxamount=0;
  $zxsql=mysqli_query($conn,"SELECT `amount`, `accttitle` FROM `collection` WHERE `acctno`='$caseno' AND `description`='$prdoctor' AND `accttitle` LIKE '%AR%%PF%'");
  while($zxfetch=mysqli_fetch_array($zxsql)){
    $zxacc=$zxfetch['accttitle'];
    if(($zxacc!="AR TRADE PF")&&($zxacc!="AR EMPLOYEE PF")&&($zxacc!="AR PERSONAL PF")&&($zxacc!="AR DOCTOR PF")){
      $zxamount+=$zxfetch['amount'];
    }
  }

  $tprgr+=$pragr;$tprad+=$praad;$tprp1+=$prap1;$tprp2+=$prap2;$tprhm+=($prahm+$zxamount);$tprex+=($praex-$zxamount);

if($prptype!="ON CALL"){
  $logall2="$logdoc<->".$pragr."<->".$praad."<->".($prahm+$zxamount)."<->".$prap1."<->".$prap2."<->".($praex-$zxamount)."<->|";
  fwrite($resall, $logall2);
}

if($prptype=="ON CALL"){
  $drtitle="";
}
else{
  if(stripos($prdoctor, "C/O") !== FALSE){
    $drtitle="";
  }
  else{
    $drtitle="DR. ";
  }
}

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

$pfpacsql=mysqli_query($conn,"SELECT `phicacc` FROM `docfile` WHERE `code`='$prcode'");
$pfpaccount=mysqli_num_rows($pfpacsql);
if($pfpaccount==0){
  $phicacc="";
}
else{
  $pfpacfetch=mysqli_fetch_array($pfpacsql);
  $phicacc=$pfpacfetch['phicacc'];
}

echo "
            <tr>
              <td class='b1 l2'><a href='subdetails.php?caseno=$caseno&label=PF' target='_blank' class='astyle'><div align='left' class='times s10 black bold'>
                <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td width='15'><div align='left' class='times s10 black bold' style='padding: 0 3px;'>$prcount.</div></td>
                    <td width='80' class='l1'><div align='center' class='times s10 black bold'>$phicacc</div></td>
                    <td width='auto' class='l1'><div align='left' class='times s10 black bold' style='padding: 0 3px 0 3px;'>$drtitle$pfdesc</div></td>
                  </tr>
                </table>
              </div></a></td>
              <td class='b1 l1'><div align='right' class='times s10 black' style='padding: 0 3px;'>".number_format($pfiact,2)."</div></td>
              <td class='b1 l1'><div align='right' class='times s10 black' style='padding: 0 3px;'>".number_format($pfiadj,2)."</div></td>
              <td class='b1 l1'><div align='right' class='times s10 black' style='padding: 0 3px;'>".number_format($pfihmo,2)."</div></td>
              <td class='b1 l1'><div align='right' class='times s10 black' style='padding: 0 3px;'>".number_format($pfiph1,2)."</div></td>
              <td class='b1 l1'><div align='right' class='times s10 black' style='padding: 0 3px;'>".number_format($pfiph2,2)."</div></td>
              <td class='b1 l1 r2'><div align='right' class='times s10 black' style='padding: 0 3px;'>".number_format($pfifin,2)."</div></td>
            </tr>
";
}

$pffin=round((round($pfact,2)-round($pfadj,2)-round($pfph1,2)-round($pfph2,2)-round($pfhmo,2)),2);
//END PROFESSIONAL FEE---------------------------------------------------------------------------------------------------------------------


$logall3="<>";
fwrite($resall, $logall3);

$logall4=$tprgr."|".$tprad."|".$tprhm."|".$tprp1."|".$tprp2."|".$tprex."|<>";
fwrite($resall, $logall4);

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
              <td class='t1 b1 l2' height='18'><a href='' target='_blank' class='astyle'><div align='left' class='times s10 black bold' style='padding: 0 3px;'>Subtotal</div></a></td>
              <td class='t1 b1 l1'><div align='right' class='times s10 black bold' style='padding: 0 3px;'>".number_format($pfact,2)."</div></td>
              <td class='t1 b1 l1'><div align='right' class='times s10 black bold' style='padding: 0 3px;'>".number_format($pfadj,2)."</div></td>
              <td class='t1 b1 l1'><div align='right' class='times s10 black bold' style='padding: 0 3px;'>".number_format($pfhmo,2)."</div></td>
              <td class='t1 b1 l1' bgcolor='$stpbgp1'><div align='right' class='times s10 black bold' style='padding: 0 3px;'>".number_format($pfph1,2)."</div></td>
              <td class='t1 b1 l1' bgcolor='$stpbgp2'><div align='right' class='times s10 black bold' style='padding: 0 3px;'>".number_format($pfph2,2)."</div></td>
              <td class='t1 b1 l1 r2'><div align='right' class='times s10 black bold' style='padding: 0 3px;'>".number_format($pffin,2)."</div></td>
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
              <td class='t1 b1 l2' height='22'><a href='' target='_blank' class='astyle'><div align='left' class='times s11 black bold' style='padding: 0 3px;'>TOTAL</div></a></td>
              <td class='t1 b1 l1'><div align='right' class='times s11 black bold' style='padding: 0 3px;'>".number_format($allact,2)."</div></td>
              <td class='t1 b1 l1'><div align='right' class='times s11 black bold' style='padding: 0 3px;'>".number_format($alladj,2)."</div></td>
              <td class='t1 b1 l1'><div align='right' class='times s11 black bold' style='padding: 0 3px;'>".number_format($allhmo,2)."</div></td>
              <td class='t1 b1 l1' bgcolor='$tbgp1'><div align='right' class='times s11 black bold' style='padding: 0 3px;'>".number_format($allph1,2)."</div></td>
              <td class='t1 b1 l1' bgcolor='$tbgp2'><div align='right' class='times s11 black bold' style='padding: 0 3px;'>".number_format($allph2,2)."</div></td>
              <td class='t1 b1 l1 r2'><div align='right' class='times s11 black bold' style='padding: 0 3px;'>".number_format($allfin,2)."</div></td>
            </tr>
";


echo "
<!-- PAYMENT START----------------------------------------------------------------------------------------------------------------------------- -->
            <tr>
              <td class='t1 b1 l2' height='18'><div align='left' class='times s11 black bold'>&nbsp;LESS:</div></td>
              <td class='t1 b1 r2' colspan='6'></td>
            </tr>
";

$artsql=mysqli_query($conn,"SELECT SUM(`amount`) AS `amt`, `datearray`, `refno`, `ofr` FROM `collection` WHERE `acctno`='$caseno' AND `accttitle` LIKE 'AR TRADE%%' AND (`type`='cash-Visa' OR `type`='card-Visa') GROUP BY `ofr`");
$artcount=mysqli_num_rows($artsql);
while($artfetch=mysqli_fetch_array($artsql)){
  $artofr=$artfetch['ofr'];
  $artdate=$artfetch['datearray'];
  $artamt=$artfetch['amt'];

echo "
            <tr>
              <td class='t1 b1 l2'><div align='left' class='times s11 black'>&nbsp;AR TRADE - $artofr - $artdate</div></td>
              <td class='t1 b1' colspan='5'></td>
              <td class='t1 b1 l1 r2'><div align='right' class='times s11 black'>&nbsp;".number_format($artamt,2)."&nbsp;</div></td>
            </tr>
";
}

$removeamt=0;
$lessacct=mysqli_query($conn,"SELECT type as status,accttitle as acctitle, amount, datearray,refno,ofr FROM collection where acctno='$caseno'  and accttitle like '%AR %'");
while($lessacctfetch=mysqli_fetch_array($lessacct)){
  $acstatus=$lessacctfetch['status'];
  $acctitle=$lessacctfetch['acctitle'];

  if($acctitle=="AR TRADE" or $acctitle=="AR TRADE PF"){
    $acctitle=str_replace(' PF','',$acctitle);

    if(($acstatus=="cash-Visa")||($acstatus=="card-Visa")){

      $amount=$lessacctfetch['amount'];
      $date=$lessacctfetch['datearray'];

/*echo "
            <tr>
              <td class='t1 b1 l2'><div align='left' class='times s11 black' style='padding: 0 3px;'>$acctitle - $lessacctfetch[ofr] - $date</div></td>
              <td class='t1 b1' colspan='5'></td>
              <td class='t1 b1 l1 r2'><div align='right' class='times s11 black' style='padding: 0 3px;'>".number_format($amount,2)."</div></td>
            </tr>
";*/
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
      if(($acctitle=="AR EMPLOYEE")||($acctitle=="AR EMPLOYEE")||($acctitle=="AR DOCTOR")||($acctitle=="AR PERSONAL")){
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
              <td class='t1 b1 l2'><div align='left' class='times s11 black' style='padding: 0 3px;'>$acctitle - $lessacctfetch[ofr] - $date</div></td>
              <td class='t1 b1' colspan='5'></td>
              <td class='t1 b1 l1 r2'><div align='right' class='times s11 black' style='padding: 0 3px;'>".number_format($amount,2)."</div></td>
            </tr>
";
      }
    }
  }
}

$lesscollect=mysqli_query($conn,"SELECT * FROM collection where acctno='$caseno' and (accttitle='PATIENTS DEPOSIT' OR accttitle='PF DEPOSIT') and type !='pending' ");
while($lesscollectfech=mysqli_fetch_array($lesscollect)){
  $acctitle=$lesscollectfech['accttitle'];
  $amount=$lesscollectfech['amount'];
  $ofr=$lesscollectfech['ofr'];
  $date=$lesscollectfech['date'];

echo "
            <tr>
              <td class='t1 b1 l2'><div align='left' class='times s11 black' style='padding: 0 3px;'>$acctitle - $ofr - $date</div></td>
              <td class='t1 b1' colspan='5'></td>
              <td class='t1 b1 l1 r2'><div align='right' class='times s11 black' style='padding: 0 3px;'>".number_format($amount,2)."</div></td>
            </tr>
";
}

$faddamt=0;
$lesscollect=mysqli_query($conn,"SELECT `accttitle`, SUM(`amount`) AS `amount`, `ofr`, `date` FROM `collection` WHERE `acctno`='$caseno' AND (`accttitle`='CASHONHAND' OR `accttitle`='PROFESSIONAL FEE') AND `type` NOT LIKE 'pending' GROUP BY `ofr`");
while($lesscollectfech=mysqli_fetch_array($lesscollect)){
  $acctitle=$lesscollectfech['accttitle'];
  $amount=$lesscollectfech['amount'];
  $ofr=$lesscollectfech['ofr'];
  $date=$lesscollectfech['date'];

  $addamt=0;
  $addconsql=mysqli_query($conn,"SELECT `amount` FROM `collection` WHERE `acctno`='$caseno' AND `ofr`='$ofr' AND `description`='HOSPITAL BILL' AND `accttitle`='MEDICAL SURGICAL SUPPLIES' AND `type` NOT LIKE 'pending'");
  while($addconfetch=mysqli_fetch_array($addconsql)){
    $addamt+=$addconfetch['amount'];
    $faddamt+=$addconfetch['amount'];
  }

  $amount=$amount+$addamt;

echo "
            <tr>
              <td class='t1 b1 l2'><div align='left' class='times s11 black'>&nbsp;CASHONHAND - $ofr - $date</div></td>
              <td class='t1 b1' colspan='5'></td>
              <td class='t1 b1 l1 r2'><div align='right' class='times s11 black'>&nbsp;".number_format($amount,2)."&nbsp;</div></td>
            </tr>
";
}

$lesscollect=mysqli_query($conn,"SELECT pd.accttitle,pd.amount,c.description,pd.datearray FROM collection c INNER JOIN pfdiscount pd ON pd.refno=c.refno where pd.caseno='$caseno'");
while($lesscollectfech=mysqli_fetch_array($lesscollect)){
  $acctitle=$lesscollectfech['accttitle'];
  $amount=$lesscollectfech['amount'];
  $description=$lesscollectfech['description'];
  $date=$lesscollectfech['datearray'];

echo "
            <tr>
              <td class='t1 b1 l2'><div align='left' class='times s11 black' style='padding: 0 3px;'>$acctitle - $description - $date</div></td>
              <td class='t1 b1' colspan='5'></td>
              <td class='t1 b1 l1 r2'><div align='right' class='times s11 black' style='padding: 0 3px;'>".number_format($amount,2)."</div></td>
            </tr>
";
}


//start-- sum of the total Less (AR and Patient's Deposit)
$total_AR=0;
$AR_query=mysqli_query($conn,"SELECT * FROM acctgenledge where caseno='$caseno' and (acctitle like '%AR %')");
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
$PD_query=mysqli_query($conn,"SELECT * FROM collection where acctno='$caseno' and (accttitle='PATIENTS DEPOSIT' or accttitle='PF DEPOSIT' or accttitle='CASHONHAND' or accttitle='PROFESSIONAL FEE') and type !='pending' ");
while($PD_fetch=mysqli_fetch_array($PD_query)){
  $acctitle=$PD_fetch['accttitle'];
  $amount=$PD_fetch['amount'];
  $total_PD +=$amount;
}

$total_less= ($total_AR + $total_PD) - $removeamt;
$total_disc=0;

$PD_query=mysqli_query($conn,"SELECT amount,accttitle FROM pfdiscount where caseno='$caseno'");
while($PD_fetch=mysqli_fetch_array($PD_query)){
  $acctitle=$PD_fetch['accttitle'];
  $amount=$PD_fetch['amount'];
  $total_disc +=$amount;
}

$total_less= $total_less + $total_disc + $faddamt;
echo "
            <tr>
              <td class='t1 b1 l2' height='22'><div align='left' class='times s11 black bold' style='padding: 0 3px;'>Subtotal Less</div></td>
              <td class='t1 b1' colspan='5'></td>
              <td class='t1 b1 l1 r2'><div align='right' class='times s11 black bold' style='padding: 0 3px;'>".number_format($total_less,2)."</div></td>
            </tr>
";

//end-- sum of the total Less (AR and Patient's Deposit)
$net=$allfin-$total_less;
echo "
            <tr>
              <td class='t1 b2 l2' height='22'><div align='left' class='times s12 black bold' style='padding: 0 3px;'>NET</div></td>
              <td class='t1 b2' colspan='5'></td>
              <td class='t1 b2 l1 r2'><div align='right' class='times s12 black bold' style='padding: 0 3px;'>".number_format($net,2)."</div></td>
            </tr>

<!-- PAYMENT END------------------------------------------------------------------------------------------------------------------------------- -->
";


echo "
          </table></td>
        </tr>
        <!-- ------------------------------------------------------------------------------------------------------------------------------ -->

      </table></td>
    </tr>
    <tr>
      <td height='50'><div align='center' class='times s12 black bold'>Itemized Charges at Next Page.</div></td>
    </tr>
    <tr>
      <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
          <td width='350' valign='top'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='left' class='times s12 black bold'>Prepared by:</div></td>
            </tr>
            <tr>
              <td height='30'></td>
            </tr>
            <tr>
              <td class='b1' height='20' style='cursor: pointer;'";?> onclick="<?php echo "window.open('setbiller.php?caseno=$caseno&setuser=$user&uname=$uname', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=$hei,left=$wid,width=$setw,height=$seth');"; ?>" <?php echo "><div align='center' class='times s13 black bold' >$setuser</div></td>
            </tr>
            <tr>
              <td><div align='left' class='times s11 black bold'>Billing Clerk/Accountant</div></td>
            </tr>
            <tr>
              <td><div align='left' class='times s11 black bold'>(Signature over printed name)</div></td>
            </tr>
            <tr>
              <td height='3'></td>
            </tr>
            <tr>
              <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='65' height='15'><div align='left' class='times s11 black bold'>Date signed:</div></td>
                  <td class='b1'><div align='left' class='times s11 black'>$comdatesigned</div></td>
                </tr>
                <tr>
                  <td height='15'><div align='left' class='times s11 black bold'>Contact no.:</div></td>
                  <td class='b1'><div align='left' class='times s11 black'>$htelno</div></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
          <td width='20'></td>
          <td width='350'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='left' class='times s12 black bold'>Conforme:</div></td>
            </tr>
            <tr>
              <td height='30'></td>
            </tr>
            <tr>
              <td class='b1' height='20'><div align='center' class='times s13 black bold'>$signame</div></td>
            </tr>
            <tr>
              <td><div align='left' class='times s11 black bold'>Member/Patient/Authorized representative</div></td>
            </tr>
            <tr>
              <td><div align='left' class='times s11 black bold'>(Signature over printed name)</div></td>
            </tr>
            <tr>
              <td height='3'></td>
            </tr>
            <tr>
              <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='256' height='15'><div align='left' class='times s11 black bold'>Relationship to member of authorized representative:</div></td>
                  <td class='b1'><div align='left' class='times s11 black'>$comrel</div></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='65' height='15'><div align='left' class='times s11 black bold'>Date signed:</div></td>
                  <td width='109' class='b1'><div align='left' class='times s11 black'>$comdatesigned</div></td>
                  <td width='2'></td>
                  <td width='65' height='15'><div align='left' class='times s11 black bold'>Contact no.:</div></td>
                  <td width='109' class='b1'><div align='left' class='times s11 black'>$comcontact</div></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height='15' class='b1'></td>
    </tr>
    <tr>
      <td><div align='left' class='times s11 black'><span class='bold'>NOTE:</span><br />1. Fill out the form legibly.<br />2. The member/patient/authorized representative should not sign a blank SOA.<br />3. Printed copy of SOA or its equivalent should be free of charge.</div></td>
    </tr>
  </table>
</div>
";

$pensql=mysqli_query($conn,"SELECT sellingprice, quantity, adjustment, gross, hmo, phic, phic1, excess FROM productout WHERE caseno='$caseno' AND quantity > 0 AND trantype='charge' AND (productsubtype='PHARMACY/MEDICINE' OR productsubtype='PHARMACY/SUPPLIES' OR productsubtype='MEDICAL SURGICAL SUPPLIES' OR productsubtype='MEDICAL SUPPLIES') AND (administration LIKE 'pending' OR administration LIKE 'dispensed')");
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

fclose($resall);
exec("chmod 777 ../../2017codes/SOA/Logs/$caseno.txt");
?>
