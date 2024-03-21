<?php
include("../Settings.php");
$caseno=mysqli_real_escape_string($mycon1,$_GET['caseno']);
$label=mysqli_real_escape_string($mycon1,$_GET['label']);

ini_set("display_errors","On");
echo "
<!doctype html>
<html>
<head>
  <meta charset='utf-8'>
  <title>SOA - In-dept</title>
  <link rel='icon' href='../../image/logo/logo.png' type='image/png' />
  <link rel='shortcut icon' href='../../image/logo/logo.png' type='image/png' />
  <link href='../Resources/CSS/mystyle.css' rel='stylesheet' type='text/css' />
";
?>
<style style="text/css">
/* Define the default color for all the table rows */
.hoverTable tr{background: #FFFFFF;}

/* Define the hover highlight color for the table row */
.hoverTable tr:hover {background-color: #ffff99;}
</style>

<?php
echo "
</head>
<body>
<div align='left'>
";

$htact=0;
$htadj=0;
$htgrs=0;
$htph1=0;
$htph2=0;
$hthmo=0;
$alloth="";
$stsql=mysqli_query($mycon1,"SELECT `autono`, `label` FROM `prdsetup` WHERE `label`='$label'");
$stcount=mysqli_num_rows($stsql);

if($stcount!=0){
echo "
  <table border='0' cellpadding='0' cellspacing='0' class='hoverTable'>
    <tr>
      <td class='t2 b2 l2' height='20'><div align='center' class='courier s15 black bold'>&nbsp;Code&nbsp;</div></a></td>
      <td class='t2 b2 l1'><div align='center' class='courier s15 black bold'>&nbsp;Description&nbsp;</div></a></td>
      <td class='t2 b2 l1'><div align='center' class='courier s15 black bold'>&nbsp;Type&nbsp;</div></a></td>
      <td class='t2 b2 l1'><div align='center' class='courier s15 black bold'>&nbsp;SP&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='courier s15 black bold'>&nbsp;Qty.&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='courier s15 black bold'>&nbsp;Gross&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='cenmter' class='courier s15 black bold'>&nbsp;Discount&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='courier s15 black bold'>&nbsp;Net&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='courier s15 black bold'>&nbsp;CR1&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='courier s15 black bold'>&nbsp;CR2&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='courier s15 black bold'>&nbsp;HMO&nbsp;</div></td>
      <td class='t2 b2 l1 r2'><div align='center' class='courier s15 black bold'>&nbsp;Excess&nbsp;</div></td>
    </tr>
<!-- CHARGES START----------------------------------------------------------------------------------------------------------------------------- -->
";

while($stfetch=mysqli_fetch_array($stsql)){
  $no=$stfetch['autono'];
  $label=$stfetch['label'];

echo "
    <tr>
      <td class='t1 b2 l2 r2' colspan='12' height='30'><div align='left' class='courier s18 black bold'>&nbsp;$label</div></td>
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

    $alloth=$alloth." AND productsubtype NOT LIKE '$productsubtype'";

    //PREDEFINED CONDITIONS------------
    if($type==1){
      $posql=mysqli_query($mycon1,"SELECT `productcode`, `productdesc`, `productsubtype`, cast(`sellingprice` as decimal(10,2)) AS `sp`, cast(`quantity` as decimal(10,2)) AS `qty`, cast(`adjustment` as decimal(10,2)) AS `adj`, cast(`phic` as decimal(10,2)) AS `ph1`, cast(`phic1` as decimal(10,2)) AS `ph2`, cast(`hmo` as decimal(10,2)) AS `hmo`, cast(`excess` as decimal(10,2)) AS `exc` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 AND `productsubtype` LIKE '$productsubtype'");
    }
    else if($type==2){
      $posql=mysqli_query($mycon1,"SELECT `productcode`, `productdesc`, `administration`, `productsubtype`, cast(`sellingprice` as decimal(10,2)) AS `sp`, `quantity` AS `qty`, cast(`adjustment` as decimal(10,2)) AS `adj`, cast(`phic` as decimal(10,2)) AS `ph1`, cast(`phic1` as decimal(10,2)) AS `ph2`, cast(`hmo` as decimal(10,2)) AS `hmo`, cast(`excess` as decimal(10,2)) AS `exc` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 AND `productsubtype` LIKE '$productsubtype' AND `administration` LIKE '$administration'");
    }
    else if($type==3){
      $posql=mysqli_query($mycon1,"SELECT `productcode`, `productdesc`, `terminalname`, `productsubtype`, cast(`sellingprice` as decimal(10,2)) AS `sp`, cast(`quantity` as decimal(10,2)) AS `qty`, cast(`adjustment` as decimal(10,2)) AS `adj`, cast(`phic` as decimal(10,2)) AS `ph1`, cast(`phic1` as decimal(10,2)) AS `ph2`, cast(`hmo` as decimal(10,2)) AS `hmo`, cast(`excess` as decimal(10,2)) AS `exc` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 AND `productsubtype` LIKE '$productsubtype' AND `terminalname` LIKE '$terminalname'");
    }
    else if($type==4){
      $posql=mysqli_query($mycon1,"SELECT `productcode`, `productdesc`, `productsubtype`, cast(`sellingprice` as decimal(10,2)) AS `sp`, cast(`quantity` as decimal(10,2)) AS `qty`, cast(`adjustment` as decimal(10,2)) AS `adj`, cast(`phic` as decimal(10,2)) AS `ph1`, cast(`phic1` as decimal(10,2)) AS `ph2`, cast(`hmo` as decimal(10,2)) AS `hmo`, cast(`excess` as decimal(10,2)) AS `exc` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 AND `gross` > 0 AND `productsubtype` LIKE '$productsubtype' AND `producttype` LIKE '$producttype'");
    }
    //---------------------------------

    while($pofetch=mysqli_fetch_array($posql)){
      $pcode=$pofetch['productcode'];
      $pdesc=$pofetch['productdesc'];
      $hstact+=$pofetch['sp']*$pofetch['qty'];
      $hstadj+=$pofetch['adj'];
      $hstgrs+=($pofetch['sp']*$pofetch['qty'])-$pofetch['adj'];
      $hstph1+=$pofetch['ph1'];
      $hstph2+=$pofetch['ph2'];
      $hsthmo+=$pofetch['hmo'];

      $pdesc=str_replace("ams-","",$pdesc);
      $pdesc=str_replace("-med","",$pdesc);
      $pdesc=str_replace("-sup","",$pdesc);
      $pdesc=str_replace("mak-","",$pdesc);

      if($type==2){
        $stat="<span style='font-size:14px;color: red;'>(".$pofetch['administration'].")</span>";
      }
      else if($type==3){
        $stat="<span style='font-size:14px;color: red;'>(".$pofetch['terminalname'].")</span>";
      }
      else{
        $stat="";
      }

echo "
    <tr>
      <td class='b1 l2' height='20'><div align='left' class='courier s16 black'>&nbsp;$pcode&nbsp;</div></td>
      <td class='b1 l1' height='20'><div align='left' class='courier s16 black'>&nbsp;$pdesc $stat&nbsp;</div></td>
      <td class='b1 l1' height='20'><div align='center' class='courier s16 black'>&nbsp;".$pofetch['productsubtype']."&nbsp;</div></td>
      <td class='b1 l1'><div align='right' class='courier s16 black'>&nbsp;".number_format($pofetch['sp'],2)."&nbsp;</div></td>
      <td class='b1 l1'><div align='right' class='courier s16 black'>&nbsp;".$pofetch['qty']."&nbsp;</div></td>
      <td class='b1 l1'><div align='right' class='courier s16 black'>&nbsp;".number_format(($pofetch['sp']*$pofetch['qty']),2)."&nbsp;</div></td>
      <td class='b1 l1'><div align='right' class='courier s16 black'>&nbsp;".number_format($pofetch['adj'],2)."&nbsp;</div></td>
      <td class='b1 l1'><div align='right' class='courier s16 black'>&nbsp;".number_format((($pofetch['sp']*$pofetch['qty'])-$pofetch['adj']),2)."&nbsp;</div></td>
      <td class='b1 l1'><div align='right' class='courier s16 black'>&nbsp;".number_format($pofetch['ph1'],2)."&nbsp;</div></td>
      <td class='b1 l1'><div align='right' class='courier s16 black'>&nbsp;".number_format($pofetch['ph2'],2)."&nbsp;</div></td>
      <td class='b1 l1'><div align='right' class='courier s16 black'>&nbsp;".number_format($pofetch['hmo'],2)."&nbsp;</div></td>
      <td class='b1 l1 r2'><div align='right' class='courier s16 black'>&nbsp;".number_format($pofetch['exc'],2)."&nbsp;</div></td>
    </tr>
";
    }
  }

  $hstfin=round((round($hstact,2)-round($hstadj,2)-round($hstph1,2)-round($hstph2,2)-round($hsthmo,2)),2);

$htact+=$hstact;
$htadj+=$hstadj;
$htgrs+=$hstgrs;
$htph1+=$hstph1;
$htph2+=$hstph2;
$hthmo+=$hsthmo;

}

$apotact=0;
$apotadj=0;
$apotgrs=0;
$apotph1=0;
$apotph2=0;
$apothmo=0;

$subact=$htact;
$subadj=$htadj;
$subgrs=$htgrs;
$subph1=$htph1;
$subph2=$htph2;
$subhmo=$hthmo;


$subfin=round((round($subact,2)-round($subadj,2)-round($subph1,2)-round($subph2,2)-round($subhmo,2)),2);

echo "
    <tr>
      <td class='t2 b2 l2' height='30' colspan='5'><div align='left' class='courier s18 black bold'>&nbsp;Sub Total</div></td>
      <td class='t2 b2 l1'><div align='right' class='courier s18 black bold'>&nbsp;".number_format($subact,2)."&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='right' class='courier s18 black bold'>&nbsp;".number_format($subadj,2)."&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='right' class='courier s18 black bold'>&nbsp;".number_format($subgrs,2)."&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='right' class='courier s18 black bold'>&nbsp;".number_format($subph1,2)."&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='right' class='courier s18 black bold'>&nbsp;".number_format($subph2,2)."&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='right' class='courier s18 black bold'>&nbsp;".number_format($subhmo,2)."&nbsp;</div></td>
      <td class='t2 b2 l1 r2'><div align='right' class='courier s18 black bold'>&nbsp;".number_format($subfin,2)."&nbsp;</div></td>
    </tr>
  </table>
";
}
else if($stcount==0){
  if(isset($_GET['alloth'])){
    $apotact=0;
    $apotadj=0;
    $apotgrs=0;
    $apotph1=0;
    $apotph2=0;
    $apothmo=0;

echo "
  <table border='0' cellpadding='0' cellspacing='0' class='hoverTable'>
    <tr>
      <td class='t2 b2 l2' height='20'><div align='center' class='courier s15 black bold'>&nbsp;Code&nbsp;</div></a></td>
      <td class='t2 b2 l1'><div align='center' class='courier s15 black bold'>&nbsp;Description&nbsp;</div></a></td>
      <td class='t2 b2 l1'><div align='center' class='courier s15 black bold'>&nbsp;Type&nbsp;</div></a></td>
      <td class='t2 b2 l1'><div align='center' class='courier s15 black bold'>&nbsp;SP&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='courier s15 black bold'>&nbsp;Qty.&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='courier s15 black bold'>&nbsp;Gross&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='cenmter' class='courier s15 black bold'>&nbsp;Discount&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='courier s15 black bold'>&nbsp;Net&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='courier s15 black bold'>&nbsp;CR1&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='courier s15 black bold'>&nbsp;CR2&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='courier s15 black bold'>&nbsp;HMO&nbsp;</div></td>
      <td class='t2 b2 l1 r2'><div align='center' class='courier s15 black bold'>&nbsp;Excess&nbsp;</div></td>
    </tr>
<!-- CHARGES START----------------------------------------------------------------------------------------------------------------------------- -->
";

    $alloth=base64_decode($_GET['alloth']);
//ALL OTHERS-------------------------------------------------------------------------------------------------------------------------------
    $aposql=mysqli_query($mycon1,"SELECT `productcode`, `productdesc`, `productsubtype`, `producttype`, cast(`sellingprice` as decimal(10,2)) AS `sp`,`quantity` AS `qty`, cast(`adjustment` as decimal(10,2)) AS `adj`, cast(`phic` as decimal(10,2)) AS `ph1`, cast(`phic1` as decimal(10,2)) AS `ph2`, cast(`hmo` as decimal(10,2)) AS `hmo`, cast(`excess` as decimal(10,2)) AS `exc` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 AND `productsubtype` NOT LIKE 'PROFESSIONAL FEE' $alloth");
    while($apofetch=mysqli_fetch_array($aposql)){
      $apcode=$apofetch['productcode'];
      $apdesc=$apofetch['productdesc'];
      $apptype=$apofetch['producttype'];
      $aptype=$apofetch['productsubtype'];
      $apotact+=$apofetch['sp']*$apofetch['qty'];
      $apotadj+=$apofetch['adj'];
      $apotgrs+=($apofetch['sp']*$apofetch['qty'])-$apofetch['adj'];
      $apotph1+=$apofetch['ph1'];
      $apotph2+=$apofetch['ph2'];
      $apothmo+=$apofetch['hmo'];

      $apdesc=str_replace("ams-","",$apdesc);
      $apdesc=str_replace("-med","",$apdesc);
      $apdesc=str_replace("-sup","",$apdesc);
      $apdesc=str_replace("mak-","",$apdesc);

echo "
    <tr>
      <td class='b1 l2' height='20'><div align='left' class='courier s16 black'>&nbsp;$apcode&nbsp;</div></td>
      <td class='b1 l1' height='20'><div align='left' class='courier s16 black'>&nbsp;$apdesc&nbsp;</div></td>
      <td class='b1 l1' height='20'><div align='left' class='courier s16 black'>&nbsp;".$apofetch['productsubtype']."&nbsp;</div></td>
      <td class='b1 l1'><div align='right' class='courier s16 black'>&nbsp;".number_format($apofetch['sp'],2)."&nbsp;</div></td>
      <td class='b1 l1'><div align='right' class='courier s16 black'>&nbsp;".$apofetch['qty']."&nbsp;</div></td>
      <td class='b1 l1'><div align='right' class='courier s16 black'>&nbsp;".number_format(($apofetch['sp']*$apofetch['qty']),2)."&nbsp;</div></td>
      <td class='b1 l1'><div align='right' class='courier s16 black'>&nbsp;".number_format($apofetch['adj'],2)."&nbsp;</div></td>
      <td class='b1 l1'><div align='right' class='courier s16 black'>&nbsp;".number_format((($apofetch['sp']*$apofetch['qty'])-$apofetch['adj']),2)."&nbsp;</div></td>
      <td class='b1 l1'><div align='right' class='courier s16 black'>&nbsp;".number_format($apofetch['ph1'],2)."&nbsp;</div></td>
      <td class='b1 l1'><div align='right' class='courier s16 black'>&nbsp;".number_format($apofetch['ph2'],2)."&nbsp;</div></td>
      <td class='b1 l1'><div align='right' class='courier s16 black'>&nbsp;".number_format($apofetch['hmo'],2)."&nbsp;</div></td>
      <td class='b1 l1 r2'><div align='right' class='courier s16 black'>&nbsp;".number_format($apofetch['exc'],2)."&nbsp;</div></td>
    </tr>
";
    }

    $apotfin=round((round($apotact,2)-round($apotadj,2)-round($apotph1,2)-round($apotph2,2)-round($apothmo,2)),2);

$subact=$apotact;
$subadj=$apotadj;
$subgrs=$apotgrs;
$subph1=$apotph1;
$subph2=$apotph2;
$subhmo=$apothmo;

$subfin=round((round($subact,2)-round($subadj,2)-round($subph1,2)-round($subph2,2)-round($subhmo,2)),2);

echo "
    <tr>
      <td class='t2 b2 l2' height='30' colspan='5'><div align='left' class='courier s18 black bold'>&nbsp;Sub Total</div></td>
      <td class='t2 b2 l1'><div align='right' class='courier s18 black bold'>&nbsp;".number_format($subact,2)."&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='right' class='courier s18 black bold'>&nbsp;".number_format($subadj,2)."&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='right' class='courier s18 black bold'>&nbsp;".number_format($subgrs,2)."&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='right' class='courier s18 black bold'>&nbsp;".number_format($subph1,2)."&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='right' class='courier s18 black bold'>&nbsp;".number_format($subph2,2)."&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='right' class='courier s18 black bold'>&nbsp;".number_format($subhmo,2)."&nbsp;</div></td>
      <td class='t2 b2 l1 r2'><div align='right' class='courier s18 black bold'>&nbsp;".number_format($subfin,2)."&nbsp;</div></td>
    </tr>
  </table>
";
  }
//END ALL OTHERS---------------------------------------------------------------------------------------------------------------------------
  else{
    $xysql=mysqli_query($mycon1,"SELECT `patientidno` FROM `admission` WHERE `caseno`='$caseno'");
    $xyfetch=mysqli_fetch_array($xysql);
    $patid=$xyfetch['patientidno'];

    $xzsql=mysqli_query($mycon1,"SELECT `patientname` FROM `patientprofile` WHERE `patientidno`='$patid'");
    $xzcount=mysqli_num_rows($xzsql);

    if($xzcount!=0){
      $xzfetch=mysqli_fetch_array($xzsql);
      $patname=strtoupper($xzfetch['patientname']);
    }
    else{
      $xxsql=mysqli_query($mycon1,"SELECT `name` FROM `nsauthemployees` WHERE `empid`='$patid'");
      $xxfetch=mysqli_fetch_array($xxsql);
      $patname=strtoupper($xxfetch['name']);
    }

    $allothpf="";
    $allotpfsql=mysqli_query($mycon1,"SELECT `producttype` FROM `prdsetupdetails` WHERE `productsubtype`='PROFESSIONAL FEE' GROUP BY `producttype`");
    while($allothpffetch=mysqli_fetch_array($allotpfsql)){
      $allothpf=$alloothpf." AND `producttype`='".$allothpffetch['producttype']."'";
    }

    $apotact=0;
    $apotadj=0;
    $apotgrs=0;
    $apotph1=0;
    $apotph2=0;
    $apothmo=0;
    $apotadjall=0;

    $pfnum=0;

echo "
  <span class='arial black s16 bold'>PATIENT NAME: </span><span class='arial blue s16 bold'><u>$patname</u></span><br /><br />
  <table border='0' cellpadding='0' cellspacing='0' class='hoverTable'>
    <tr>
      <td class='t2 b2 l2' height='20'><div align='center' class='courier s11 black bold'>&nbsp;#&nbsp;</div></a></td>
      <td class='t2 b2 l1'><div align='center' class='courier s11 black bold'>&nbsp;Description&nbsp;</div></a></td>
      <!-- td class='t2 b2 l1'><div align='center' class='courier s11 black bold'>&nbsp;Type&nbsp;</div></a></td -->
      <td class='t2 b2 l1'><div align='center' class='courier s11 black bold'>&nbsp;SP&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='courier s11 black bold'>&nbsp;Qty.&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='courier s11 black bold'>&nbsp;Gross&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='courier s11 red bold'>&nbsp;Discount&nbsp;</div></td>
";

    $z=0;
    $zsql=mysqli_query($mycon1,"SELECT `accttitle` FROM `collection` WHERE `acctno`='$caseno' AND `accttitle` LIKE '%AR%%PF%' GROUP BY `accttitle`");
    while($zfetch=mysqli_fetch_array($zsql)){
      $zacc=$zfetch['accttitle'];
      $z++;

echo "
      <td class='t2 b2 l1'><div align='center' class='courier s11 red bold'>&nbsp;$zacc&nbsp;</div></td>
";

      $zstore[$z]=$zacc;
      $prt[$z]=0;
    }

echo "
      <td class='t2 b2 l1'><div align='center' class='courier s11 black bold'>&nbsp;Net&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='courier s11 black bold'>&nbsp;CR1&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='courier s11 black bold'>&nbsp;CR2&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='courier s11 black bold'>&nbsp;HMO&nbsp;</div></td>
      <td class='t2 b2 l1 r2'><div align='center' class='courier s11 black bold'>&nbsp;Excess&nbsp;</div></td>
    </tr>
<!-- CHARGES START----------------------------------------------------------------------------------------------------------------------------- -->
";

    $aposql=mysqli_query($mycon1,"SELECT `productcode`, `productdesc`, `producttype`, `productsubtype`, cast(`sellingprice` as decimal(10,2)) AS `sp`,`quantity` AS `qty`, cast(`adjustment` as decimal(10,2)) AS `adj`, cast(`phic` as decimal(10,2)) AS `ph1`, cast(`phic1` as decimal(10,2)) AS `ph2`, cast(`hmo` as decimal(10,2)) AS `hmo`, cast(`excess` as decimal(10,2)) AS `exc` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 AND `gross` > 0 AND `productsubtype` LIKE 'PROFESSIONAL FEE'");
    while($apofetch=mysqli_fetch_array($aposql)){
      $apcode=$apofetch['productcode'];
      $apdesc=$apofetch['productdesc'];
      $apttyp=$apofetch['producttype'];
      $aptype=$apofetch['productsubtype'];
      $apotact+=$apofetch['sp']*$apofetch['qty'];
      $apotadj+=$apofetch['adj'];
      $apotgrs+=($apofetch['sp']*$apofetch['qty'])-$apofetch['adj'];
      $apotph1+=$apofetch['ph1'];
      $apotph2+=$apofetch['ph2'];
      $apothmo+=$apofetch['hmo'];
      $pfnum++;

      $apdesc=str_replace("ams-","",$apdesc);
      $apdesc=str_replace("-med","",$apdesc);
      $apdesc=str_replace("-sup","",$apdesc);
      $apdesc=str_replace("mak-","",$apdesc);

echo "
    <tr>
      <td class='b1 l2' height='20'><div align='left' class='courier s12 black'>&nbsp;$pfnum&nbsp;</div></td>
      <td class='b1 l1' height='20' title='$apttyp'><div align='left' class='courier s12 black'>&nbsp;$apdesc&nbsp;</div></td>
      <!--  td class='b1 l1' height='20'><div align='left' class='courier s12 black'>&nbsp;".$apofetch['producttype']."&nbsp;</div></td -->
      <td class='b1 l1'><div align='right' class='courier s12 black'>&nbsp;".number_format($apofetch['sp'],2)."&nbsp;</div></td>
      <td class='b1 l1'><div align='right' class='courier s12 black'>&nbsp;".$apofetch['qty']."&nbsp;</div></td>
      <td class='b1 l1'><div align='right' class='courier s12 black'>&nbsp;".number_format(($apofetch['sp']*$apofetch['qty']),2)."&nbsp;</div></td>
      <td class='b1 l1'><div align='right' class='courier s12 red'>&nbsp;".number_format($apofetch['adj'],2)."&nbsp;</div></td>
";

      $addamt=0;
      for($y=1;$y<=$z;$y++){
        $yacc[$y]=$zstore[$y];
        $ysql=mysqli_query($mycon1,"SELECT SUM(`amount`) AS `amt` FROM `collection` WHERE `acctno`='$caseno' AND `description`='$apdesc' AND `accttitle` LIKE '$yacc[$y]'");
        $ycount=mysqli_num_rows($ysql);
        if($ycount==0){
          $yamt[$y]=0;
        }
        else{
          $yfetch=mysqli_fetch_array($ysql);
          $yamt[$y]=$yfetch['amt'];
        }

        $prt[$y]+=$yamt[$y];


echo "
      <td class='b1 l1'><div align='right' class='courier s12 red'>&nbsp;".number_format($yamt[$y],2)."&nbsp;</div></td>
";

        $addamt+=$yamt[$y];
      }

      $apotadjall+=$addamt;

echo "
      <td class='b1 l1'><div align='right' class='courier s12 black'>&nbsp;".number_format(((($apofetch['sp']*$apofetch['qty'])-$apofetch['adj'])-$addamt),2)."&nbsp;</div></td>
      <td class='b1 l1'><div align='right' class='courier s12 black'>&nbsp;".number_format($apofetch['ph1'],2)."&nbsp;</div></td>
      <td class='b1 l1'><div align='right' class='courier s12 black'>&nbsp;".number_format($apofetch['ph2'],2)."&nbsp;</div></td>
      <td class='b1 l1'><div align='right' class='courier s12 black'>&nbsp;".number_format($apofetch['hmo'],2)."&nbsp;</div></td>
      <td class='b1 l1 r2'><div align='right' class='courier s12 black'>&nbsp;".number_format(($apofetch['exc']-$addamt),2)."&nbsp;</div></td>
    </tr>
";
    }

    $subact=$apotact;
    $subadj=$apotadj;
    $subgrs=$apotgrs-$apotadjall;
    $subph1=$apotph1;
    $subph2=$apotph2;
    $subhmo=$apothmo;

    $subfin=round((round($subact,2)-round(($subadj+$apotadjall),2)-round($subph1,2)-round($subph2,2)-round($subhmo,2)),2);

echo "
    <tr>
      <td class='t2 b2 l2' height='30' colspan='4'><div align='left' class='courier s12 black bold'>&nbsp;Sub Total</div></td>
      <td class='t2 b2 l1'><div align='right' class='courier s12 black bold'>&nbsp;".number_format($subact,2)."&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='right' class='courier s12 red bold'>&nbsp;".number_format($subadj,2)."&nbsp;</div></td>
";

  for($x=1;$x<=$z;$x++){
echo "
      <td class='t2 b2 l1'><div align='right' class='courier s12 red bold'>&nbsp;".number_format($prt[$x],2)."&nbsp;</div></td>
";
    }

echo "
      <td class='t2 b2 l1'><div align='right' class='courier s12 black bold'>&nbsp;".number_format($subgrs,2)."&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='right' class='courier s12 black bold'>&nbsp;".number_format($subph1,2)."&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='right' class='courier s12 black bold'>&nbsp;".number_format($subph2,2)."&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='right' class='courier s12 black bold'>&nbsp;".number_format($subhmo,2)."&nbsp;</div></td>
      <td class='t2 b2 l1 r2'><div align='right' class='courier s12 black bold'>&nbsp;".number_format($subfin,2)."&nbsp;</div></td>
    </tr>
  </table>
";
  }
}

//HOSPITAL SUB TOTAL-----------------------------------------------------------------------------------------------------------------------


echo "
</div>
</body>
</html>
";
?>
