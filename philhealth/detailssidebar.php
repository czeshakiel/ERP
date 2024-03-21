<?php
$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);

mysqli_query($conn,"SET NAMES 'utf8'");
$zasql=mysqli_query($conn,"SELECT `patientidno`, `caseno`, `membership`, `paymentmode`, `hmo`, `room`, `street`, `barangay`, `municipality`, `province`, `initialdiagnosis`, `finaldiagnosis`, `ap`, `timeadmitted`, `dateadmitted`, `branch`, `employerno`, `ad`, `status`, `remarks` FROM `admission` WHERE `caseno`='$caseno'");
$zacount=mysqli_num_rows($zasql);
if($zacount==0){
  $patientidno="";
  $caseno="";
  $membership="";
  $paymentmode="";
  $hmo="";
  $room="";
  $initialdiagnosis="";
  $finaldiagnosis="";
  $ap="";
  $ad="";
  $employerno="";
  $timeadmitted="";
  $dateadmitted="";
  $branch="";
  $adstatus="";
  $street="";
  $barangay="";
  $municipality="";
  $province="";
  $adremarks="";
}
else{
  $zafetch=mysqli_fetch_array($zasql);
  $patientidno=$zafetch['patientidno'];
  $caseno=$zafetch['caseno'];
  $membership=$zafetch['membership'];
  $paymentmode=$zafetch['paymentmode'];
  $hmo=$zafetch['hmo'];
  $room=$zafetch['room'];
  $initialdiagnosis=trim(mb_strtoupper($zafetch['initialdiagnosis']));
  $finaldiagnosis=trim(mb_strtoupper($zafetch['finaldiagnosis']));
  $ap=$zafetch['ap'];
  $ad=$zafetch['ad'];
  $employerno=$zafetch['employerno'];
  $timeadmitted=$zafetch['timeadmitted'];
  $dateadmitted=$zafetch['dateadmitted'];
  $branch=$zafetch['branch'];
  $adstatus=$zafetch['status'];
  $adremarks=$zafetch['remarks'];

  if($zafetch['street']!=""){$street=mb_strtoupper($zafetch['street'])." ";}else{$street="";}
  if($zafetch['barangay']!=""){$barangay=mb_strtoupper($zafetch['barangay'])." ";}else{$barangay="";}
  if($zafetch['municipality']!=""){$municipality=mb_strtoupper($zafetch['municipality'])." ";}else{$municipality="";}
  if($zafetch['province']!=""){$province=mb_strtoupper($zafetch['province'])." ";}else{$province="";}

}

$pataddress=$street.$barangay.$municipality.$province;

if($finaldiagnosis==""){$bgrf="";}else{$bgrf="background-color: #FF5733;";}

$zbsql=mysqli_query($conn,"SELECT `name` FROM `docfile` WHERE `code`='$ap'");
$zbcount=mysqli_num_rows($zbsql);
if($zbcount!=0){
  $zbfetch=mysqli_fetch_array($zbsql);
  $ap=$zbfetch['name'];
}

$zcsql=mysqli_query($conn,"SELECT `name` FROM `docfile` WHERE `code`='$ad'");
$zccount=mysqli_num_rows($zcsql);
if($zccount!=0){
  $zcfetch=mysqli_fetch_array($zcsql);
  $ad=$zcfetch['name'];
}

$zdsql=mysqli_query($conn,"SELECT UPPER(`lastname`) AS `lname`, UPPER(`firstname`) AS `fname`, UPPER(`middlename`) AS `mname`, UPPER(`suffix`) AS `suffix`, `age`, `senior`, `sex`, `birthdate`, `dateofbirth` FROM `patientprofile` WHERE `patientidno`='$patientidno'");
$zdcount=mysqli_num_rows($zdsql);
if($zdcount==0){
  $zdfetch=mysqli_fetch_array($zdsql);
  $lname="";
  $fname="";
  $mname="";
  $suffix="";
  $age="";
  $senior="";
  $sex="";
  $birthdate="";
  $dateofbirth="";
}
else{
  $zdfetch=mysqli_fetch_array($zdsql);
  $lname=$zdfetch['lname'];
  $fname=$zdfetch['fname'];
  $mname=$zdfetch['mname'];
  $suffix=$zdfetch['suffix'];
  $age=$zdfetch['age'];
  $senior=$zdfetch['senior'];
  $sex=$zdfetch['sex'];
  $birthdate=$zdfetch['birthdate'];
  $dateofbirth=$zdfetch['dateofbirth'];

  if($zdfetch['lname']!=""){$ln=$lname.", ";}else{$ln="";}
  if($zdfetch['fname']!=""){$fn=$fname." ";}else{$fn="";}
  if($zdfetch['mname']!=""){$mn=$mname;}else{$mn="";}
  if($zdfetch['suffix']!=""){$sf=$suffix." ";}else{$sf="";}
}

if($dateofbirth!="0000-00-00"){
  $bday=new DateTime($dateofbirth);
  $ages=$bday->diff(new DateTime);

  $ay=$ages->y;
  $am=$ages->m;
  $ad=$ages->d;

  if($ay==0){
    $age=$am." Month/s ".$ad." Day/s";
  }
}

$patientname=$ln.$fn.$sf.$mn;
$patient=$lname.", ".$fname." ".$mname."_".$caseno;

if(($sex=="m")||($sex=="M")){$sex="MALE";$ics="boy";}
else{
  if(($sex=="f")||($sex=="F")){$sex="FEMALE";$ics="girl-alt";}
  else{$sex="";$ics="zigzag";}
}


if(($senior=="Y")||($senior=="y")){$senior="YES";}
else{$senior="NO";}

//PRINT LOCK---------------------------------------------------------------------------------------
if((stripos($caseno, "I-") !== FALSE)){
  $dat="<input type='hidden' name='dat' value='0' />";
  $pl=0;
}
else{
  $zsql=mysqli_query($conn,"SELECT `lock` FROM `labprintlock`");
  $zfetch=mysqli_fetch_array($zsql);
  $pl=$zfetch['lock'];
  $dat="<input type='hidden' name='dat' value='$pl' />";
}
//-------------------------------------------------------------------------------------------------

if(stripos($caseno, "I-") !== FALSE){$mh="&inp";}else{$mh="&otp";}

//-------------------------------------------------------------------------------------------------
$dstsql=mysqli_query($conn,"SELECT `timedischarged`, `datearray` FROM `dischargedtable` WHERE `caseno`='$caseno'");
$dstcount=mysqli_num_rows($dstsql);

if($dstcount==0){
  $ddt="";
}
else{
  $dstfetch=mysqli_fetch_array($dstsql);
  $tmd=$dstfetch['timedischarged'];
  $dtd=$dstfetch['datearray'];

  $ddt=date("M d, Y h:i A",strtotime("$tmd $dtd"));
}
//-------------------------------------------------------------------------------------------------


if(isset($_GET['details'])){
  $aac0="active";$aac1="";$aac2="";$aac3="";$aac4="";$aac5="";$aac6="";$aac7="";$aac8="";$aac9="";
  $x1="";$x2="";$x3="";$x4="";$x5="";$x6="";
  $y1="left";$y2="left";$y3="left";$y4="left";$y5="left";$y6="left";$y7="left";
  $bacc1a="";$bacc1b="";
  $bacc3a="";$bacc3b="";$bacc3c="";$bacc3d="";$bacc3e="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
  $bacc5a="";$bacc5b="";
  $bacc6a="";$bacc6b="";$bacc6c="";$bacc6d="";
}
else if(isset($_GET['csfada'])){
  $aac0="";$aac1="";$aac2="";$aac3="";$aac4="active";$aac5="";$aac6="";$aac7="";$aac8="";$aac9="";
  $x1="";$x2="";$x3="";$x4="show";$x5="";$x6="";
  $y1="left";$y2="left";$y3="left";$y4="down";$y5="left";$y6="left";$y7="left";
  $bacc1a="";$bacc1b="";
  $bacc3a="";$bacc3b="";$bacc3c="";$bacc3d="";$bacc3e="";
  $bacc4a="active";$bacc4b="";$bacc4c="";$bacc4d="";
  $bacc5a="";$bacc5b="";
  $bacc6a="";$bacc6b="";$bacc6c="";$bacc6d="";
}
else if(isset($_GET['caserate'])){
  $aac0="";$aac1="active";$aac2="";$aac3="";$aac4="";$aac5="";$aac6="";$aac7="";$aac8="";$aac9="";
  $x1="";$x2="";$x3="";$x4="";$x5="";$x6="";$x6="";
  $y1="left";$y2="left";$y3="left";$y4="left";$y5="left";$y6="left";$y7="left";
  $bacc1a="";$bacc1b="";
  $bacc3a="";$bacc3b="";$bacc3c="";$bacc3d="";$bacc3e="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
  $bacc5a="";$bacc5b="";
  $bacc6a="";$bacc6b="";$bacc6c="";$bacc6d="";
}
else if(isset($_GET['lab'])){
  $aac0="";$aac1="";$aac2="";$aac3="";$aac4="";$aac5="active";$aac6="";$aac7="";$aac8="";$aac9="";
  $x1="";$x2="";$x3="";$x4="";$x5="show";$x6="";
  $y1="left";$y2="left";$y3="left";$y4="left";$y5="down";$y6="left";$y7="left";
  $bacc1a="";$bacc1b="";
  $bacc3a="";$bacc3b="";$bacc3c="";$bacc3d="";$bacc3e="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
  $bacc5a="active";$bacc5b="";
  $bacc6a="";$bacc6b="";$bacc6c="";$bacc6d="";
}
else if(isset($_GET['rad'])){
  $aac0="";$aac1="";$aac2="";$aac3="";$aac4="";$aac5="active";$aac6="";$aac7="";$aac8="";$aac9="";
  $x1="";$x2="";$x3="";$x4="";$x5="show";$x6="";
  $y1="left";$y2="left";$y3="left";$y4="left";$y5="down";$y6="left";$y7="left";
  $bacc1a="";$bacc1b="";
  $bacc3a="";$bacc3b="";$bacc3c="";$bacc3d="";$bacc3e="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
  $bacc5a="";$bacc5b="active";
  $bacc6a="";$bacc6b="";$bacc6c="";$bacc6d="";
}
else if(isset($_GET['epm'])){
  $aac0="";$aac1="";$aac2="";$aac3="";$aac4="";$aac5="";$aac6="active";$aac7="";$aac8="";$aac9="";
  $x1="";$x2="";$x3="";$x4="";$x5="";$x6="show";
  $y1="left";$y2="left";$y3="left";$y4="left";$y5="left";$y6="down";$y7="left";
  $bacc1a="";$bacc1b="";
  $bacc3a="";$bacc3b="";$bacc3c="";$bacc3d="";$bacc3e="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
  $bacc5a="";$bacc5b="";
  $bacc6a="active";$bacc6b="";$bacc6c="";$bacc6d="";
}
else if(isset($_GET['epr'])){
  $aac0="";$aac1="";$aac2="";$aac3="";$aac4="";$aac5="";$aac6="active";$aac7="";$aac8="";$aac9="";
  $x1="";$x2="";$x3="";$x4="";$x5="";$x6="show";
  $y1="left";$y2="left";$y3="left";$y4="left";$y5="left";$y6="down";$y7="left";
  $bacc1a="";$bacc1b="";
  $bacc3a="";$bacc3b="";$bacc3c="";$bacc3d="";$bacc3e="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
  $bacc5a="";$bacc5b="";
  $bacc6a="";$bacc6b="active";$bacc6c="";$bacc6d="";
}
else if(isset($_GET['rmk'])){
  $aac0="";$aac1="";$aac2="";$aac3="";$aac4="";$aac5="";$aac6="active";$aac7="";$aac8="";$aac9="";
  $x1="";$x2="";$x3="";$x4="";$x5="";$x6="show";
  $y1="left";$y2="left";$y3="left";$y4="left";$y5="left";$y6="down";$y7="left";
  $bacc1a="";$bacc1b="";
  $bacc3a="";$bacc3b="";$bacc3c="";$bacc3d="";$bacc3e="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
  $bacc5a="";$bacc5b="";
  $bacc6a="";$bacc6b="";$bacc6c="active";$bacc6d="";
}
else if(isset($_GET['cns'])){
  $aac0="";$aac1="";$aac2="";$aac3="";$aac4="";$aac5="";$aac6="active";$aac7="";$aac8="";$aac9="";
  $x1="";$x2="";$x3="";$x4="";$x5="";$x6="show";
  $y1="left";$y2="left";$y3="left";$y4="left";$y5="left";$y6="down";$y7="left";
  $bacc1a="";$bacc1b="";
  $bacc3a="";$bacc3b="";$bacc3c="";$bacc3d="";$bacc3e="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
  $bacc5a="";$bacc5b="";
  $bacc6a="";$bacc6b="";$bacc6c="";$bacc6d="active";
}
else if(isset($_GET['cf4p1'])){
  $aac0="";$aac1="";$aac2="";$aac3="";$aac4="";$aac5="";$aac6="";$aac7="";$aac8="";$aac9="";
  $x1="";$x2="";$x3="show";$x4="";$x5="";$x6="";
  $y1="left";$y2="left";$y3="down";$y4="left";$y5="left";$y6="left";$y7="left";
  $bacc1a="";$bacc1b="";
  $bacc2a="";$bacc2b="";
  $bacc3a="active";$bacc3b="";$bacc3c="";$bacc3d="";$bacc3e="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
  $bacc5a="";$bacc5b="";
  $bacc6a="";$bacc6b="";$bacc6c="";$bacc6d="";
}
else if(isset($_GET['cf4p2'])){
  $aac0="";$aac1="";$aac2="";$aac3="";$aac4="";$aac5="";$aac6="";$aac7="";$aac8="";$aac9="";
  $x1="";$x2="";$x3="show";$x4="";$x5="";$x6="";
  $y1="left";$y2="left";$y3="down";$y4="left";$y5="left";$y6="left";$y7="left";
  $bacc1a="";$bacc1b="";
  $bacc2a="";$bacc2b="";
  $bacc3a="";$bacc3b="active";$bacc3c="";$bacc3d="";$bacc3e="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
  $bacc5a="";$bacc5b="";
  $bacc6a="";$bacc6b="";$bacc6c="";$bacc6d="";
}
else if(isset($_GET['cf4p3'])){
  $aac0="";$aac1="";$aac2="";$aac3="";$aac4="";$aac5="";$aac6="";$aac7="";$aac8="";$aac9="";
  $x1="";$x2="";$x3="show";$x4="";$x5="";$x6="";
  $y1="left";$y2="left";$y3="down";$y4="left";$y5="left";$y6="left";$y7="left";
  $bacc1a="";$bacc1b="";
  $bacc2a="";$bacc2b="";
  $bacc3a="";$bacc3b="";$bacc3c="active";$bacc3d="";$bacc3e="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
  $bacc5a="";$bacc5b="";
  $bacc6a="";$bacc6b="";$bacc6c="";$bacc6d="";
}
else if(isset($_GET['cf4p4'])){
  $aac0="";$aac1="";$aac2="";$aac3="";$aac4="";$aac5="";$aac6="";$aac7="";$aac8="";$aac9="";
  $x1="";$x2="";$x3="show";$x4="";$x5="";$x6="";
  $y1="left";$y2="left";$y3="down";$y4="left";$y5="left";$y6="left";$y7="left";
  $bacc1a="";$bacc1b="";
  $bacc2a="";$bacc2b="";
  $bacc3a="";$bacc3b="";$bacc3c="";$bacc3d="active";$bacc3e="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
  $bacc5a="";$bacc5b="";
  $bacc6a="";$bacc6b="";$bacc6c="";$bacc6d="";
}
else if(isset($_GET['cf4p5'])){
  $aac0="";$aac1="";$aac2="";$aac3="";$aac4="";$aac5="";$aac6="";$aac7="";$aac8="";$aac9="";
  $x1="";$x2="";$x3="show";$x4="";$x5="";$x6="";
  $y1="left";$y2="left";$y3="down";$y4="left";$y5="left";$y6="left";$y7="left";
  $bacc1a="";$bacc1b="";
  $bacc2a="";$bacc2b="";
  $bacc3a="";$bacc3b="";$bacc3c="";$bacc3d="";$bacc3e="active";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
  $bacc5a="";$bacc5b="";
  $bacc6a="";$bacc6b="";$bacc6c="";$bacc6d="";
}
else if(isset($_GET['docom'])){
  $aac0="";$aac1="";$aac2="";$aac3="";$aac4="";$aac5="";$aac6="";$aac7="active";$aac8="";$aac9="";
  $x1="show";$x2="";$x3="";$x4="";$x5="";$x6="";
  $y1="left";$y2="left";$y3="left";$y4="left";$y5="left";$y6="left";$y7="left";
  $bacc1a="active";$bacc1b="";
  $bacc2a="";$bacc2b="";
  $bacc3a="";$bacc3b="";$bacc3c="";$bacc3d="";$bacc3e="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
  $bacc5a="";$bacc5b="";
  $bacc6a="";$bacc6b="";$bacc6c="";$bacc6d="";
}
else if(isset($_GET['actbill'])){
  $aac0="";$aac1="";$aac2="";$aac3="";$aac4="";$aac5="";$aac6="";$aac7="";$aac8="active";$aac9="";
  $x1="show";$x2="";$x3="";$x4="";$x5="";$x6="";
  $y1="left";$y2="left";$y3="left";$y4="left";$y5="left";$y6="left";$y7="left";
  $bacc1a="active";$bacc1b="";
  $bacc2a="";$bacc2b="";
  $bacc3a="";$bacc3b="";$bacc3c="";$bacc3d="";$bacc3e="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
  $bacc5a="";$bacc5b="";
  $bacc6a="";$bacc6b="";$bacc6c="";$bacc6d="";
}
else if(isset($_GET['patchk'])){
  $aac0="";$aac1="";$aac2="";$aac3="";$aac4="";$aac5="";$aac6="";$aac7="";$aac8="";$aac9="active";
  $x1="show";$x2="";$x3="";$x4="";$x5="";$x6="";
  $y1="left";$y2="left";$y3="left";$y4="left";$y5="left";$y6="left";$y7="left";
  $bacc1a="active";$bacc1b="";
  $bacc2a="";$bacc2b="";
  $bacc3a="";$bacc3b="";$bacc3c="";$bacc3d="";$bacc3e="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
  $bacc5a="";$bacc5b="";
  $bacc6a="";$bacc6b="";$bacc6c="";$bacc6d="";
}
else{
  $aac0="";$aac1="active";$aac2="";$aac3="";$aac4="";$aac5="";$aac6="";$aac7="";$aac8="";$aac9="";
  $x1="show";$x2="";$x3="";$x4="";$x5="";$x6="";
  $y1="down";$y2="left";$y3="left";$y4="left";$y5="left";$y6="left";$y7="left";
  $bacc1a="active";$bacc1b="";
  $bacc2a="";$bacc2b="";
  $bacc3a="";$bacc3b="";$bacc3c="";$bacc3d="";$bacc3e="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
  $bacc5a="";$bacc5b="";
  $bacc6a="";$bacc6b="";$bacc6c="";$bacc6d="";
}

//First CaseRate
$fcrsql=mysqli_query($conn,"SELECT `icdcode`, `hospitalshare`, `pfshare` FROM `finalcaserate` WHERE `caseno`='$caseno' AND `level`='primary'");
if(mysqli_num_rows($fcrsql)==0){
  $ficdrvs="&nbsp;";
  $fhci="&nbsp;";
  $fpf="&nbsp;";
  $ftot="&nbsp;";
}
else{
  $fcrfetch=mysqli_fetch_array($fcrsql);
  $ficdrvs=$fcrfetch['icdcode'];
  $fhci=number_format($fcrfetch['hospitalshare'],2);
  $fpf=number_format($fcrfetch['pfshare'],2);
  $ftot=number_format(($fcrfetch['hospitalshare']+$fcrfetch['pfshare']),2);
}

//Second CaseRate
$scrsql=mysqli_query($conn,"SELECT `icdcode`, `hospitalshare`, `pfshare` FROM `finalcaserate` WHERE `caseno`='$caseno' AND `level`='secondary'");
if(mysqli_num_rows($scrsql)==0){
  $sicdrvs="&nbsp;";
  $shci="&nbsp;";
  $spf="&nbsp;";
  $stot="&nbsp;";
}
else{
  $scrfetch=mysqli_fetch_array($scrsql);
  $sicdrvs=$scrfetch['icdcode'];
  $shci=number_format($scrfetch['hospitalshare'],2);
  $spf=number_format($scrfetch['pfshare'],2);
  $stot=number_format(($scrfetch['hospitalshare']+$scrfetch['pfshare']),2);
}


echo "
  <button class='hamburger' onclick='sbview();'><i class='icofont-navigation-menu'></i></button>
  <!-- sidebar -->
  <div class='sidebar px-4 py-4 py-md-5 me-0'>
    <div class='d-flex flex-column h-100'>
      <a href='../philhealth/' class='mb-0 brand-icon'>
        <span class='logo-icon'>
          <span style='font-size: 30px;'><i class='icofont-patient-file'></i></span>
        </span>
        <span class='logo-text'>PhilHealth</span>
      </a>
      <!-- Menu: main ul -->
      <ul class='menu-list flex-grow-1 mt-3'>
        <li><a class='m-link' href='../philhealth/'><span><i class='icofont-home fs-5'></i> Home</span></a></li>
        <li  class='collapsed'>
          <a class='m-link $aac0' href='../philhealth/?details$mh&caseno=$caseno'>
            <span><i class='icofont-$ics fs-5'></i> Patient Profile</span>
          </a>
        </li>
        <li  class='collapsed'>
          <a class='m-link $aac1' href='../philhealth/?caserate&caseno=$caseno&user=$sun'>
            <span><i class='icofont-search-job fs-5'></i> Case Rates</span>
          </a>
        </li>
        <li  class='collapsed'>
          <a class='m-link' data-bs-toggle='collapse' data-bs-target='#one' href='#'>
            <span><i class='icofont-listine-dots fs-5'></i> Patient Account</span> <span class='arrow icofont-dotted-$y1 ms-auto text-end fs-5'></span>
          </a>
          <!-- Menu: Sub menu ul -->
          <ul class='sub-menu collapse' id='one'>
            <li><a class='ms-link' href='../extra/SOA17/StatementOfAccountPHICVer.php?caseno=$caseno&uname=".base64_decode($snm)."&patientidno=$patientidno' target='_blank'><span><i class='icofont-people'></i> PhilHealth SOA 1.0</span></a></li>
            <li><a class='ms-link' href='../extra/SOA/?caseno=$caseno&user=$sun&dept=PHILHEALTH' target='_blank'><span><i class='icofont-people'></i> PhilHealth SOA 2.0</span></a></li>
            <li><a class='ms-link' href='http://".$_SERVER['HTTP_HOST']."/2011codes/details.php?nursename=".base64_decode($snm)."&caseno=$caseno&username=MARK%20ALOCELJA&userunique=marcuz' target='_blank'><span><i class='icofont-people'></i> Details 1.0</span></a></li>
            <li><a class='ms-link' href='../extra/Details/?caseno=$caseno&user=$sun&dept=PHILHEALTH' target='_blank'><span><i class='icofont-people'></i> Details 2.0</span></a></li>
          </ul>
        </li>
        </li>
        <li class='collapsed'>
          <a class='m-link $aac3' data-bs-toggle='collapse' data-bs-target='#cf4' href='#'>
            <span><i class='icofont-file-alt fs-5'></i> CF4 Data Entry</span> <span class='arrow icofont-dotted-$y3 ms-auto text-end fs-5'></span>
          </a>
          <!-- Menu: Sub menu ul -->
          <ul class='sub-menu collapse $x3' id='cf4'>
            <li><a class='ms-link $bacc3a' href='../philhealth/?cf4p1&caseno=$caseno'><span><i class='icofont-education'></i> CF4 Part 1</span></a></li>
            <li><a class='ms-link $bacc3b' href='../philhealth/?cf4p2&caseno=$caseno'><span><i class='icofont-education'></i> CF4 Part 2</span></a></li>
            <li><a class='ms-link $bacc3c' href='../philhealth/?cf4p3&caseno=$caseno'><span><i class='icofont-education'></i> CF4 Part 3</span></a></li>
            <li><a class='ms-link $bacc3d' href='../philhealth/?cf4p4&caseno=$caseno'><span><i class='icofont-education'></i> CF4 Part 4</span></a></li>
            <!-- li><a class='ms-link $bacc3e' href='../philhealth/?cf4p5&caseno=$caseno'><span><i class='icofont-education'></i> CF4 Part 5</span></a></li -->
          </ul>
        </li>
        <li  class='collapsed'>
          <a class='m-link $aac4' data-bs-toggle='collapse' data-bs-target='#claimform' href='#'>
            <span><i class='icofont-paperclip fs-5'></i> Claim Forms</span> <span class='arrow icofont-dotted-$y4 ms-auto text-end fs-5'></span>
          </a>
          <!-- Menu: Sub menu ul -->
          <ul class='sub-menu collapse $x4' id='claimform'>
            <li><a class='ms-link' href='../extra/CSF/?caseno=$caseno' target='_blank'><span><i class='icofont-paperclip'></i> CSF</span></a></li>
            <li><a class='ms-link $bacc4a' href='../philhealth/?csfada&caseno=$caseno'><span><i class='icofont-paperclip'></i> CSF Add Data</span></a></li>
            <li><a class='ms-link' href='../extra/CF2/cf2_front.php?caseno=$caseno&user=".$sun."' target='_blank'><span><i class='icofont-paperclip'></i> CF2 Front</span></a></li>
            <li><a class='ms-link' href='../extra/CF2/before_cf2_back.php?caseno=$caseno' target='_blank'><span><i class='icofont-paperclip'></i> CF2 Back</span></a></li>
            <li><a class='ms-link' href='../extra/CF2/ReloadCF2.php?caseno=$caseno' target='_blank'><span><i class='icofont-paperclip'></i> Reload CF2 Data</span></a></li>
          </ul>
        </li>
        <li  class='collapsed'>
          <a class='m-link $aac5' data-bs-toggle='collapse' data-bs-target='#result' href='#'>
            <span><i class='icofont-package fs-5'></i> Diagnostic Results</span> <span class='arrow icofont-dotted-$y5 ms-auto text-end fs-5'></span>
          </a>
          <!-- Menu: Sub menu ul -->
          <ul class='sub-menu collapse $x5' id='result'>
            <li><a class='ms-link $bacc5a' href='../philhealth/?lab&caseno=$caseno'><span><i class='icofont-beaker'></i> Laboratory Results</span></a></li>
            <li><a class='ms-link $bacc5b' href='../philhealth/?rad&caseno=$caseno'><span><i class='icofont-radio-active'></i> Radiology Results</span></a></li>
          </ul>
        </li>
        <li  class='collapsed'>
          <a class='m-link $aac6' data-bs-toggle='collapse' data-bs-target='#others' href='#'>
            <span><i class='icofont-package fs-5'></i> Other Transactions</span> <span class='arrow icofont-dotted-$y6 ms-auto text-end fs-5'></span>
          </a>
          <!-- Menu: Sub menu ul -->
          <ul class='sub-menu collapse $x6' id='others'>
            <li><a class='ms-link $bacc6a' href='../philhealth/?epm&caseno=$caseno'><span><i class='icofont-pixels'></i> Edit PHIC Membership</span></a></li>
            <!-- li><a class='ms-link $bacc6b' href='../philhealth/?epr&caseno=$caseno'><span><i class='icofont-pixels'></i> Edit Profile</span></a></li -->
            <li><a class='ms-link $bacc6c' href='../philhealth/?rmk&caseno=$caseno'><span><i class='icofont-pixels'></i> Remarks</span></a></li>
            <!-- li><a class='ms-link $bacc6d' href='../philhealth/?cns&caseno=$caseno'><span><i class='icofont-pixels'></i> Consent</span></a></li -->
          </ul>
        </li>
        <li  class='collapsed'>
          <a class='m-link $aac7' href='../philhealth/?docom&caseno=$caseno'>
            <span><i class='icofont-file-document fs-5'></i> Document Complied</span>
          </a>
        </li>
        <!-- li  class='collapsed'>
          <a class='m-link $aac7' href='http://".$_SERVER['HTTP_HOST']."/arv2022/philhealth/checkComplied.php?caseno=$caseno&msg=Complied' target='_blank' ";?> onclick="return confirm('Proceed to set as &quot;Document Compiled&quot;?');" <?php echo ">
            <span><i class='icofont-file-document fs-5'></i> Document Complied</span>
          </a>
        </li -->
        <li  class='collapsed'>
          <a class='m-link $aac8' href='../philhealth/?actbill&caseno=$caseno'>
            <span><i class='icofont-money fs-5'></i> Actual Bill</span>
          </a>
        </li>
        <!-- li  class='collapsed'>
          <a class='m-link $aac8' href='http://".$_SERVER['HTTP_HOST']."/arv2022/philhealth/checkComplied.php?caseno=$caseno&msg=Actual%20Bill' target='_blank' ";?> onclick="return confirm('Proceed to set as &quot;Actual Bill&quot;?');" <?php echo ">
            <span><i class='icofont-money fs-5'></i> Actual Bill</span>
          </a>
        </li -->
        <!-- li  class='collapsed'>
          <a class='m-link $aac9' href='../philhealth/?patchk&caseno=$caseno' ";?> onclick="return confirm('Proceed to set as &quot;Checked&quot;?');" <?php echo ">
            <span><i class='icofont-checked fs-5'></i> Checked</span>
          </a>
        </li -->
        <!-- li  class='collapsed'>
          <a class='m-link $aac9' href='http://".$_SERVER['HTTP_HOST']."/arv2022/philhealth/checkDetails.php?caseno=$caseno&status=Checked' target='_blank' ";?> onclick="return confirm('Proceed to set as &quot;Checked&quot;?');" <?php echo ">
            <span><i class='icofont-checked fs-5'></i> Checked</span>
          </a>
        </li -->
      </ul>
    </div>
  </div>
";
?>
