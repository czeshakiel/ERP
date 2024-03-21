<?php
//-------------------------------------------------------------------------------------------------
include("agegroup.php");

$agro=mysqli_real_escape_string($conn,$_POST['agro']);

$patid=mysqli_real_escape_string($conn,$_POST['patid']);
$labno=trim(mysqli_real_escape_string($conn,$_POST['labno']));
$ap=mysqli_real_escape_string($conn,$_POST['ap']);
$mt=mysqli_real_escape_string($conn,$_POST['mt']);
$pt=mysqli_real_escape_string($conn,$_POST['pt']);
$printbatchno=mysqli_real_escape_string($conn,$_POST['printbatchno']);
$remarks=mb_strtoupper(trim(mysqli_real_escape_string($conn,$_POST['remarks'])));

$redtime=0;

$bvaln=mysqli_real_escape_string($conn,$_POST['bval']);
$itmrefno=mysqli_real_escape_string($conn,$_POST['itmrefno']);
$itmdesc=mysqli_real_escape_string($conn,$_POST['desc']);
$logs=mysqli_real_escape_string($conn,$_POST['logs']);

//Logs---------------------------------------------------------------------------------------------
$elogs=base64_decode($logs)."|Updated-".$user."-".date("Y-m-d H:i:s");
$cvsql=mysqli_query($conn,"SELECT `labno`, `ap`, `mt`, `printbatchno` FROM `labresults` WHERE `refno`='$itmrefno' AND `caseno`='$caseno' LIMIT 0,1");
$cvfetch=mysqli_fetch_array($cvsql);
$cvlabno=$cvfetch['labno'];
$cvap=$cvfetch['ap'];
$cvmt=$cvfetch['mt'];
$cvprintbatchno=$cvfetch['printbatchno'];

if($labno!=$cvlabno){$elogs=$elogs."-labno=$cvlabno";}
if($ap!=$cvap){$elogs=$elogs."-ap=$cvap";}
if($mt!=$cvmt){$elogs=$elogs."-mt=$cvmt";}
if($printbatchno!=$cvprintbatchno){$elogs=$elogs."-printbatchno=$cvprintbatchno";}
//-------------------------------------------------------------------------------------------------

$itmerr=0;
for($w=1;$w<=$bvaln;$w++){
  $nol="no-$w";
  $resl="result-$w";
  $prfl="prf-$w";

  $non=mysqli_real_escape_string($conn,$_POST[$nol]);
  $resultn=trim(mysqli_real_escape_string($conn,$_POST[$resl]));
  $prfn=mysqli_real_escape_string($conn,$_POST[$prfl]);

  if($prfn!=""){$resultnd=$prfn;}
  else{$resultnd=$resultn;}

  $bsql=mysqli_query($conn,"SELECT `no`, `code`, `testname`, `testabr`, `grp`, `sort`, `amll`, `amul`, `afll`, `aful`, `cll`, `cul`, `nll`, `nul`, `displaynv`, `others`, `unit`, `type`, `header`, CAST(`amll` AS DECIMAL(10,3)) AS `amlld`, CAST(`amul` AS DECIMAL(10,3)) AS `amuld`, CAST(`afll` AS DECIMAL(10,3)) AS `aflld`, CAST(`aful` AS DECIMAL(10,3)) AS `afuld`, CAST(`cll` AS DECIMAL(10,3)) AS `clld`, CAST(`cul` AS DECIMAL(10,3)) AS `culd`, CAST(`nll` AS DECIMAL(10,3)) AS `nlld`, CAST(`nul` AS DECIMAL(10,3)) AS `nuld` FROM `labnormalvalues` WHERE `no`='$non' AND `stat`='1'");
  $bfetch=mysqli_fetch_array($bsql);
  $lnvno=$bfetch['no'];
  $code=$bfetch['code'];
  $testname=$bfetch['testname'];
  $testabr=$bfetch['testabr'];
  $sort=$bfetch['sort'];
  $amll=$bfetch['amll'];
  $amul=$bfetch['amul'];
  $afll=$bfetch['afll'];
  $aful=$bfetch['aful'];
  $cll=$bfetch['cll'];
  $cul=$bfetch['cul'];
  $nll=$bfetch['nll'];
  $nul=$bfetch['nul'];
  $displaynv=$bfetch['displaynv'];
  $others=$bfetch['others'];
  $unit=mysqli_real_escape_string($conn,$bfetch['unit']);
  $grp=$bfetch['grp'];
  $type=$bfetch['type'];
  $header=$bfetch['header'];

  $amlld=$bfetch['amlld'];
  $amuld=$bfetch['amuld'];
  $aflld=$bfetch['aflld'];
  $afuld=$bfetch['afuld'];
  $clld=$bfetch['clld'];
  $culd=$bfetch['culd'];
  $nlld=$bfetch['nlld'];
  $nuld=$bfetch['nuld'];

  if($type==3){
    $resl2="result2-$q-$w";
    $resultn2=trim(mysqli_real_escape_string($conn,$_POST[$resl2]));

    if($resultn2!=""){$resultn2=$resultn2." sec.";$spc=" ";}
    else{$resultn2="";$spc="";}
    if($resultn!=""){$resultn=$resultn." min.";}
    else{$resultn="";$spc="";}
    $resultn=$resultn.$spc.$resultn2;
  }

  if($unit!=""){$unitd=" ".$unit;}else{$unitd="";}

  if($grp==1){
    if($agro=="A"){$nvll=$amll;$nvul=$amul;$nvlld=$amlld;$nvuld=$amuld;}
    else if($agro=="AF"){$nvll=$afll;$nvul=$aful;$nvlld=$aflld;$nvuld=$afuld;}
    else if($agro=="C"){$nvll=$cll;$nvul=$cul;$nvlld=$clld;$nvuld=$culd;}
    else if($agro=="N"){$nvll=$nll;$nvul=$nul;$nvlld=$nlld;$nvuld=$nuld;}
    else{$nvll=$amll;$nvul=$amul;$nvlld=$amlld;$nvuld=$amuld;}
  }
  else if($grp==3){
    $setot=substr_count($others,"|");
    $ots=preg_split("/\|/",$others);

    $nvll="";$nvul="";$nvlld="";$nvuld="";

    for($otz=0;$otz<$setot;$otz++){
      $otss=preg_split("/\*/",$ots[$otz]);
      $otagl=$otss[0];
      $otagh=$otss[1];
      $otll=$otss[2];
      $otul=$otss[3];

      if(($ay>=$otagl)&&($ay<=$otagh)){
        $nv=$otll." - ".$otul.$unitd;
        $nvll=$otll;$nvul=$otul;$nvlld=$otll;$nvuld=$otul;
      }
    }
  }
  else{
    $nvll="";$nvul="";$nvlld="";$nvuld="";
  }

  if($resultn!=""){
    if($type==1){
      if(($nvll!="")&&($nvul!="")){
        if($resultnd<$nvlld){$suf="L";$sufd=" (L)";}
        else if($resultnd>$nvuld){$suf="H";$sufd=" (H)";}
        else{$suf="";$sufd="";}
      }
      else{
        $suf="";$sufd="";
      }
    }
    else{
      $suf="";$sufd="";
    }
  }
  else{
    $suf="";$sufd="";
  }

  if($displaynv!=""){
    $dispnv=$displaynv;
  }
  else{
    if(($nvll!="")&&($nvul!="")){$dispnv=trim("$nvll - $nvul $unit");}
    else{$dispnv="";}
  }

  //Logs-------------------------------------------------------------------------------------------
  $vnsql=mysqli_query($conn,"SELECT `preresult`, `result`, `suf` FROM `labresults` WHERE `refno`='$itmrefno' AND `code`='$code' AND `caseno`='$caseno' AND `lnvno`='$lnvno'");
  $vnfetch=mysqli_fetch_array($vnsql);
  $vnpreresult=$vnfetch['preresult'];
  $vnresult=$vnfetch['result'];
  $vnsuf=$vnfetch['suf'];

  if($prfn!=$vnpreresult){$elogs=$elogs."-preresult($testname)=($vnpreresult)";}
  if($resultn!=$vnresult){$elogs=$elogs."-result($testname)=($vnresult)";}
  if($suf!=$vnsuf){$elogs=$elogs."-suf($testname)=($vnsuf)";}
  //-----------------------------------------------------------------------------------------------

  mysqli_query($conn,"UPDATE `labresults` SET `labno`='$labno', `ap`='$ap', `mt`='$mt', `pt`='$pt', `printbatchno`='$printbatchno', `preresult`='$prfn', `result`='$resultn', `suf`='$suf', `nvll`='$nvll', `nvul`='$nvul', `unit`='$unit', `dispnv`='$dispnv', `remarks`='$remarks', `logs`='$elogs' WHERE `refno`='$itmrefno' AND `code`='$code' AND `caseno`='$caseno' AND `lnvno`='$lnvno'");
}

echo "<span style='color: #0784C0;'>&quot;".$itmdesc."&quot; RESULTS UPDATED SUCCESSFULLY!.</span><br />";

mysqli_query($conn,"UPDATE `labresults` SET `logs`='$elogs' WHERE `refno`='$itmrefno' AND `code`='$code' AND `caseno`='$caseno'");
mysqli_query($conn,"UPDATE `labpending` SET `testno`='$printbatchno' WHERE `refno`='$itmrefno'");

//$redtime=3;
echo "<META HTTP-EQUIV='Refresh'CONTENT='$redtime;URL=../extra/LabExpress/PrintResult/?caseno=$caseno&patid=$patid&printbatchno=$printbatchno&stype=$stype&asd=$user'>";
////-----------------------------------------------------------------------------------------------
?>
