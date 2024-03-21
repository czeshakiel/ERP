<?php
ini_set("display_errors","On");
$ip=$_SERVER['REMOTE_ADDR'];

//heading
$hesql=mysqli_query($conn,"SELECT * FROM `heading`");
$hefetch=mysqli_fetch_array($hesql);
$heading=strtoupper($hefetch['heading']);
$fadd=strtoupper($hefetch['FullAddress']);

//admission
$adsql=mysqli_query($conn,"SELECT * FROM `admission` WHERE `caseno`='$caseno'");
$adfetch=mysqli_fetch_array($adsql);
$patientidno=$adfetch['patientidno'];
$initialdiagnosis=strtoupper($adfetch['initialdiagnosis']);
$finaldiagnosis=strtoupper($adfetch['finaldiagnosis']);
$room=$adfetch['room'];
$timeadmitted=$adfetch['timeadmitted'];
$dateadmit=$adfetch['dateadmit'];

$dateadmitspl=str_split($dateadmit);
$ady1=$dateadmitspl[0];
$ady2=$dateadmitspl[1];
$ady3=$dateadmitspl[2];
$ady4=$dateadmitspl[3];
$adm1=$dateadmitspl[5];
$adm2=$dateadmitspl[6];
$add1=$dateadmitspl[8];
$add2=$dateadmitspl[9];

$dt=$dateadmit." ".$timeadmitted;

$timehfmt=date("h",strtotime($dt));
$timehspl=str_split($timehfmt);
$adh1=$timehspl[0];
$adh2=$timehspl[1];

$timeifmt=date("i",strtotime($dt));
$timeispl=str_split($timeifmt);
$adi1=$timeispl[0];
$adi2=$timeispl[1];

$timeafmt=date("A",strtotime($dt));
if($timeafmt=="AM"){
  $adam="&#10004;";$adpm="";
}
else if($timeafmt=="PM"){
  $adam="";$adpm="&#10004;";
}
else{
  $adam="";$adpm="";
}

//patientprofile
mysqli_query($conn,"SET NAMES 'utf8'");
$pasql=mysqli_query($conn,"SELECT * FROM `patientprofile` WHERE `patientidno`='$patientidno'");
$pafetch=mysqli_fetch_array($pasql);
$ln=strtoupper($pafetch['lastname']);
$fn=strtoupper($pafetch['firstname']);
$mn=strtoupper($pafetch['middlename']);
$su=strtoupper($pafetch['suffix']);
$bd=strtoupper($pafetch['dateofbirth']);
$se=strtoupper($pafetch['sex']);

//caserate
$cr1sql=mysqli_query($conn,"SELECT * FROM `finalcaserate` WHERE `caseno`='$caseno' AND `level`='primary'");
$cr1fetch=mysqli_fetch_array($cr1sql);
$cr1=$cr1fetch['icdcode'];

$cr2sql=mysqli_query($conn,"SELECT * FROM `finalcaserate` WHERE `caseno`='$caseno' AND `level`='secondary'");
$cr2fetch=mysqli_fetch_array($cr2sql);
$cr2=$cr2fetch['icdcode'];

//ROOM
$rmsql=mysqli_query($conn,"SELECT `roomprop` FROM `room` WHERE `room`='$room'");
$rmcount=mysqli_num_rows($rmsql);
if($rmcount==0){
$roomprop="";
}
else{
$rmfetch=mysqli_fetch_array($rmsql);
$roomprop=$rmfetch['roomprop'];
}

if($roomprop=="PRIVATE"){$rmchk1="&#10004;";$rmchk2="";$romi="P";}
else{$rmchk1="";$rmchk2="&#10004;";$romi="N";}

$hc=fopen("AccreCode.txt", "r") or die("Unable to open file!");
$hcres=trim(fgets($hc));
fclose($hc);

$hcs=str_split($hcres);
$hc1=$hcs['0'];
$hc2=$hcs['1'];
$hc3=$hcs['2'];
$hc4=$hcs['3'];
$hc5=$hcs['4'];
$hc6=$hcs['5'];
$hc7=$hcs['6'];
$hc8=$hcs['7'];
$hc9=$hcs['8'];

//DISCHARGEDTABLE
$dtsql=mysqli_query($conn,"SELECT `timedischarged`, `datearray` FROM `dischargedtable` WHERE `caseno`='$caseno'");
$dtcount=mysqli_num_rows($dtsql);

if($dtcount!=0){
  $dtfetch=mysqli_fetch_array($dtsql);
  $timedischarged=$dtfetch['timedischarged'];
  $datedischarged=$dtfetch['datearray'];

  $datedisspl=str_split($datedischarged);
  $dty1=$datedisspl[0];
  $dty2=$datedisspl[1];
  $dty3=$datedisspl[2];
  $dty4=$datedisspl[3];
  $dtm1=$datedisspl[5];
  $dtm2=$datedisspl[6];
  $dtd1=$datedisspl[8];
  $dtd2=$datedisspl[9];

  $dtdt=$datedischarged." ".$timedischarged;

  $timedishfmt=date("h",strtotime($dtdt));
  $timedishspl=str_split($timedishfmt);
  $dth1=$timedishspl[0];
  $dth2=$timedishspl[1];

  $timedisifmt=date("i",strtotime($dtdt));
  $timedisispl=str_split($timedisifmt);
  $dti1=$timedisispl[0];
  $dti2=$timedisispl[1];

  $timedisafmt=date("A",strtotime($dtdt));
  if($timedisafmt=="AM"){
    $dtam="&#10004;";$dtpm="";
  }
  else if($timedisafmt=="PM"){
    $dtam="";$dtpm="&#10004;";
  }
  else{
    $dtam="";$dtpm="";
  }
}
else{
  $dty1="";
  $dty2="";
  $dty3="";
  $dty4="";
  $dtm1="";
  $dtm2="";
  $dtd1="";
  $dtd2="";

  $dth1="";
  $dth2="";
  $dtm1="";
  $dtm2="";
  $dti1="";
  $dti2="";
  $dtam="";
  $dtpm="";
}


//CLAIMINFOADD
$clasql=mysqli_query($conn,"SELECT `hciyes`, `hcino`, `hci`, `hciaddress`, `disposition`, `expireddays`, `timeexpired`, `transferto`, `transferadd`, `reasons`, `private`, `nonprivate` FROM `claiminfoadd` WHERE `caseno`='$caseno'");
$clacount=mysqli_num_rows($clasql);

if($clacount!=0){
  $clafetch=mysqli_fetch_array($clasql);
  $hciyes=$clafetch['hciyes'];
  $hcino=$clafetch['hcino'];
  $hci=$clafetch['hci'];
  $hciaddress=$clafetch['hciaddress'];
  $disposition=$clafetch['disposition'];
  $expireddays=$clafetch['expireddays'];
  $timeexpired=$clafetch['timeexpired'];
  $transferto=$clafetch['transferto'];
  $transferadd=$clafetch['transferadd'];
  $reasons=$clafetch['reasons'];
  $private=$clafetch['private'];
  $nonprivate=$clafetch['nonprivate'];
}
else{
  $hciyes="";
  $hcino="";
  $hci="";
  $hciaddress="";
  $disposition="";
  $expireddays="";
  $timeexpired="";
  $transferto="";
  $transferadd="";
  $reasons="";
  $private="";
  $nonprivate="";
}

if($disposition=="E"){
  if($expireddays!="0000-00-00"){
    $expireddaysspl=str_split($expireddays);
    $exy1=$expireddaysspl[0];
    $exy2=$expireddaysspl[1];
    $exy3=$expireddaysspl[2];
    $exy4=$expireddaysspl[3];

    $exm1=$expireddaysspl[5];
    $exm2=$expireddaysspl[6];

    $exd1=$expireddaysspl[8];
    $exd2=$expireddaysspl[9];

    $exdt=trim($expireddays." ".$timeexpired);
    $exh=date("h",strtotime($exdt));
    $exhspl=str_split($exh);
    $exh1=$exhspl[0];
    $exh2=$exhspl[1];

    $exh=date("i",strtotime($exdt));
    $exhspl=str_split($exh);
    $exmn1=$exhspl[0];
    $exmn2=$exhspl[1];

    $exA=date("A",strtotime($exdt));
    if($exA=="AM"){
      $exdtam="&#10004;";$exdtpm="";
    }
    else if($exA=="PM"){
      $exdtam="";$exdtpm="&#10004;";
    }
    else{
      $exdtam="";$exdtpm="";
    }
  }
}
else{
  $exy1="";
  $exy2="";
  $exy3="";
  $exy4="";

  $exm1="";
  $exm2="";

  $exd1="";
  $exd2="";

  $exh1="";
  $exh2="";

  $exmn1="";
  $exmn2="";

  $exdtam="";
  $exdtpm="";
}

if(($hciyes=="checked")&&($hcino=="")){
  $isrefy="&#10004;";$isrefn="";$isref="y";
}
else if(($hciyes=="")&&($hcino=="checked")){
  $isrefy="";$isrefn="&#10004;"; $isref="n";
}
else{
  $isrefy="";$isrefn="";$isref="";
}

if($isref=="y"){
  $hcidisp=strtoupper($hci);
}
else{
  $hcidisp="";
}

if($disposition=="I"){
  $disi="&#10004;";$disr="";$dish="";$disa="";$dise="";$dist="";
}
else if($disposition=="R"){
  $disi="";$disr="&#10004;";$dish="";$disa="";$dise="";$dist="";
}
else if($disposition=="H"){
  $disi="";$disr="";$dish="&#10004;";$disa="";$dise="";$dist="";
}
else if($disposition=="A"){
  $disi="";$disr="";$dish="";$disa="&#10004;";$dise="";$dist="";
}
else if($disposition=="E"){
  $disi="";$disr="";$dish="";$disa="";$dise="&#10004;";$dist="";
}
else if($disposition=="T"){
  $disi="";$disr="";$dish="";$disa="";$dise="";$dist="&#10004;";
}
else{
  $disi="";$disr="";$dish="";$disa="";$dise="";$dist="";
}

if($private=="checked"){$rmchk1="&#10004;";$rmchk2="";$romi="P";}
if($nonprivate=="checked"){$rmchk1="";$rmchk2="&#10004;";$romi="N";}

?>
