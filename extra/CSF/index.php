<?php
include("../../main/class2.php");

$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);

$cursty="style='cursor: pointer;'";

//admission
$admsql=mysqli_query($conn,"SELECT `patientidno`, `type`, `paymentmode`, `room`, UPPER(`street`) AS `street`, UPPER(`barangay`) AS `barangay`, UPPER(`municipality`) AS `municipality`, UPPER(`province`) AS `province`, `zipcode`, UPPER(`pastmed`) AS `pastmed`, UPPER(`initialdiagnosis`) AS `initialdiagnosis`, UPPER(`finaldiagnosis`) AS `finaldiagnosis`, UPPER(`ap`) AS `ap`, `timeadmitted`, `dateadmit` FROM `admission` WHERE `caseno`='$caseno'");
$admfetch=mysqli_fetch_array($admsql);
$patientidno=$admfetch['patientidno'];
$type=$admfetch['type'];
$paymentmode=$admfetch['paymentmode'];
$room=$admfetch['room'];
$street=$admfetch['street'];
$barangay=$admfetch['barangay'];
$municipality=$admfetch['municipality'];
$province=$admfetch['province'];
$zipcode=$admfetch['zipcode'];
$pastmed=$admfetch['pastmed'];
$initialdiagnosis=$admfetch['initialdiagnosis'];
$finaldiagnosis=$admfetch['finaldiagnosis'];
$ap=$admfetch['ap'];
$timeadmitted=$admfetch['timeadmitted'];
$dateadmit=$admfetch['dateadmit'];

$dateadmitfmt=date("m-d-Y",strtotime($dateadmit));
$datetimead=$dateadmit." ".$timeadmitted;
$gettimead=date("H:i:sA",strtotime($datetimead));
$mailadd=$street." ".$barangay." ".$municipality." ".$province;

//patientprofile
mysqli_query($conn,"SET NAMES utf8");
$patfsql=mysqli_query($conn,"SELECT UPPER(`lastname`) AS `lastname`, UPPER(`firstname`) AS `firstname`, UPPER(`middlename`) AS `middlename`, `birthdate`, `age`, UPPER(`sex`) AS `sex`, UPPER(`suffix`) AS `suffix` FROM `patientprofile` WHERE `patientidno`='$patientidno'");
$patffetch=mysqli_fetch_array($patfsql);
$lastname=$patffetch['lastname'];
$firstname=$patffetch['firstname'];
$middlename=$patffetch['middlename'];
$birthdate=$patffetch['birthdate'];
$age=$patffetch['age'];
$sex=$patffetch['sex'];
$suffix=$patffetch['suffix'];

$birthdatefmt=date("m-d-Y",strtotime($birthdate));

$birthdatespl=preg_split('/\-/', $birthdate);

$bm=$birthdatespl[0];
$bd=$birthdatespl[1];
$by=$birthdatespl[2];

if(strlen($bd)==1){$bdf="0".$bd;}else{$bdf=$bd;}

$birthdaterel=$bm."-".$bdf."-".$by;

//claiminfo
mysqli_query($conn,"SET NAMES utf8");
$cfsql=mysqli_query($conn,"SELECT `identificationno`, UPPER(`lastname`) AS `lastname`, UPPER(`firstname`) AS `firstname`, UPPER(`middlename`) AS `middlename` FROM `claiminfo` WHERE `caseno`='$caseno'");
$cfcount=mysqli_num_rows($cfsql);
if($cfcount==0){
  $identificationno="";
  $mlname="";
  $mfname="";
  $mmname="";
  $mbdate="";
  $mgender="";
  $msuffix='';
}
else{
  $cffetch=mysqli_fetch_array($cfsql);
  $identificationno=$cffetch['identificationno'];
  $mlname= $cffetch['lastname'];
  $mfname=$cffetch['firstname'];
  $mmname=$cffetch['middlename'];
  $mbdate="";
  $mgender="";
  $msuffix='';
}

$identificationnofmt=str_replace("-","",$identificationno);
$mbdatefmt=date("m-d-Y",strtotime($mbdate));

//claiminfoadd
mysqli_query($conn,"SET NAMES utf8");
$cfasql=mysqli_query($conn,"SELECT * FROM `claiminfoadd` WHERE `caseno`='$caseno'");
$cfacount=mysqli_num_rows($cfasql);
if($cfacount==0){
  $hciyes="";
  $hcino="";
  $disposition="";
  $expireddays="";
  $timeexpired="";
  $transferto="";
  $transferadd="";
  $reasons="";
  $private="";
  $nonprivate="";
  $doctor="";
  $datesigned="";
  $doctor2="";
  $datesigned2="";
  $copay2="";
  $doctor3="";
  $datesigned3="";
  $copay3="";
}
else{
  $cfafetch=mysqli_fetch_array($cfasql);
  $hciyes=$cfafetch['hciyes'];
  $hcino=$cfafetch['hcino'];
  $disposition=$cfafetch['disposition'];
  $expireddays=$cfafetch['expireddays'];
  $timeexpired=$cfafetch['timeexpired'];
  $transferto=$cfafetch['transferto'];
  $transferadd=$cfafetch['transferadd'];
  $reasons=$cfafetch['reasons'];
  $private=$cfafetch['private'];
  $nonprivate=$cfafetch['nonprivate'];
  $doctor=$cfafetch['doctor1'];
  $datesigned=$cfafetch['datesigned1'];
  $doctor2=$cfafetch['doctor2'];
  $datesigned2=$cfafetch['datesigned2'];
  $copay2=$cfafetch['copay2'];
  $doctor3=$cfafetch['doctor3'];
  $datesigned3=$cfafetch['datesigned3'];
  $copay3=$cfafetch['copay3'];
}

//claiminfomoreinfo
$cimisql=mysqli_query($conn,"SELECT * FROM `claiminfomoreinfo` WHERE `caseno`='$caseno'");
$cimicount=mysqli_num_rows($cimisql);
if($cimicount==0){
  $membersuffix="";
  $memberbday="";
  $membergender="";
  $rtm="";
  $comchoose="";
  $comname="";
  $comdatesigned="";
  $comrelation="";
  $comrelationos="";
  $comreason="";
  $comreasonos="";
  $comuw="";
  $emppen="";
  $empbusinessname="";
  $empname="";
  $empcontactno="";
  $empsigdesignation="";
  $empdatesigned="";
  $carchoose="";
  $carname="";
  $cardatesigned="";
  $carrelation="";
  $c1arrelationos="";
  $carreason="";
  $carreasonos="";
  $caruw="";
  $hcirep="";
  $hcidesignation="";
  $hcidatesigned="";
}
else{
  $cimifetch=mysqli_fetch_array($cimisql);
  $membersuffix=$cimifetch['membersuffix'];
  $memberbday=$cimifetch['memberbday'];
  $membergender=$cimifetch['membergender'];
  $rtm=$cimifetch['rtm'];
  $comchoose=$cimifetch['comchoose'];
  $comname=$cimifetch['comname'];
  $comdatesigned=$cimifetch['comdatesigned'];
  $comrelation=$cimifetch['comrelation'];
  $comrelationos=$cimifetch['comrelationos'];
  $comreason=$cimifetch['comreason'];
  $comreasonos=$cimifetch['comreasonos'];
  $comuw=$cimifetch['comuw'];
  $emppen=$cimifetch['emppen'];
  $empbusinessname=$cimifetch['empbusinessname'];
  $empname=$cimifetch['empname'];
  $empcontactno=$cimifetch['empcontactno'];
  $empsigdesignation=$cimifetch['empsigdesignation'];
  $empdatesigned=$cimifetch['empdatesigned'];
  $carchoose=$cimifetch['carchoose'];
  $carname=$cimifetch['carname'];
  $cardatesigned=$cimifetch['cardatesigned'];
  $carrelation=$cimifetch['carrelation'];
  $carrelationos=$cimifetch['carrelationos'];
  $carreason=$cimifetch['carreason'];
  $carreasonos=$cimifetch['carreasonos'];
  $caruw=$cimifetch['caruw'];
  $hcirep=$cimifetch['hcirep'];
  $hcidesignation=$cimifetch['hcidesignation'];
  $hcidatesigned=$cimifetch['hcidatesigned'];
}

//dischargedtable
$dtsql=mysqli_query($conn,"SELECT `datedischarged`, `timedischarged` FROM `dischargedtable` WHERE `caseno`='$caseno'");
$dtcount=mysql_num_rows($dtsql);
if($dtcount==0){
  $datedischarged="__";
  $timedischarged="";
}
else{
  $dtfetch=mysqli_fetch_array($dtsql);
  $datedischarged=$dtfetch['datedischarged'];
  $datedischarged=str_replace("_","-",$datedischarged);
  $timedischarged=$dtfetch['timedischarged'];
}

$datetimedis=$datedischarged." ".$timedischarged;
$gettimedis=date("H:i:sA",strtotime($datetimedis));

if($paymentmode=="Member"){
  $mlnamerel=$lastname;
  $mfnamerel=$firstname;
  $mmnamerel=$middlename;
  $msuffixrel=$suffix;
  $mbdaterel=$birthdaterel;
  $mgenderrel=$sex;
}
else{
  $mlnamerel=$mlname;
  $mfnamerel=$mfname;
  $mmnamerel=$mmname;
  $mbdaterel=$memberbday;
  $msuffixrel=$membersuffix;
  $mgenderrel=$membergender;
}

/*1. PhilHealth Identification Number (PIN) of Member: */
$phicofmember=$identificationno; //Place value of PHIC Number of member from the DB here.

if(strlen($phicofmember)==14){
  $phicmember=str_split($phicofmember);

  $phicmember0=$phicmember[0];
  $phicmember1=$phicmember[1];
  $phicmember3=$phicmember[3];
  $phicmember4=$phicmember[4];
  $phicmember5=$phicmember[5];
  $phicmember6=$phicmember[6];
  $phicmember7=$phicmember[7];
  $phicmember8=$phicmember[8];
  $phicmember9=$phicmember[9];
  $phicmember10=$phicmember[10];
  $phicmember11=$phicmember[11];
  $phicmember13=$phicmember[13];
}
else if(strlen($phicofmember)==12){
  $phicmember=str_split($phicofmember);

  $phicmember0=$phicmember[0];
  $phicmember1=$phicmember[1];
  $phicmember3=$phicmember[2];
  $phicmember4=$phicmember[3];
  $phicmember5=$phicmember[4];
  $phicmember6=$phicmember[5];
  $phicmember7=$phicmember[6];
  $phicmember8=$phicmember[7];
  $phicmember9=$phicmember[8];
  $phicmember10=$phicmember[9];
  $phicmember11=$phicmember[10];
  $phicmember13=$phicmember[11];
}
else{
  $phicmember0="";
  $phicmember1="";
  $phicmember3="";
  $phicmember4="";
  $phicmember5="";
  $phicmember6= "";
  $p0hicmember7="";
  $phicmember8="";
  $phicmember9="";
  $phicmember10="";
  $phicmember11="";
  $phicmember13="";
}
/*------------------------------------------------------*/


/*2. Name of Member: */
$LN=$mlnamerel;
$FN=$mfnamerel;
$MN=$mmnamerel;
$MS=$msuffixrel;
/*------------------------------------------------------*/


/*3. Member Date of Birth: */
$bdayofmem=date("m-d-Y",strtotime($mbdaterel)); //change this to the value on the DB.

$bdayofmemarr=str_split($bdayofmem);

if(strlen($bdayofmem)>1){
  $bdayofmemarr0=$bdayofmemarr[0];
  $bdayofmemarr1=$bdayofmemarr[1];
  $bdayofmemarr3=$bdayofmemarr[3];
  $bdayofmemarr4=$bdayofmemarr[4];
  $bdayofmemarr6=$bdayofmemarr[6];
  $bdayofmemarr7=$bdayofmemarr[7];
  $bdayofmemarr8=$bdayofmemarr[8];
  $bdayofmemarr9=$bdayofmemarr[9];
}
else{
  $bdayofmemarr0="";
  $bdayofmemarr1="";
  $bdayofmemarr3="";
  $bdayofmemarr4="";
  $bdayofmemarr6="";
  $bdayofmemarr7="";
  $bdayofmemarr8="";
  $bdayofmemarr9="";
}
/*------------------------------------------------------*/


/*4. PhilHealth Identification Number (PIN) of Dependent: */
$phicofdep=""; //Place value of PHIC Number of dependent from the DB here.

if(strlen($phicofdep)==14){
  $phicdep=str_split($phicofdep);

  $phicdep0=$phicdep[0];
  $phicdep1=$phicdep[1];
  $phicdep3=$phicdep[3];
  $phicdep4=$phicdep[4];
  $phicdep5=$phicdep[5];
  $phicdep6=$phicdep[6];
  $phicdep7=$phicdep[7];
  $phicdep8=$phicdep[8];
  $phicdep9=$phicdep[9];
  $phicdep10=$phicdep[10];
  $phicdep11=$phicdep[11];
  $phicdep13=$phicdep[13];
}
else{
  $phicdep0="";
  $phicdep1="";
  $phicdep3="";
  $phicdep4="";
  $phicdep5="";
  $phicdep6="";
  $phicdep7="";
  $phicdep8="";
  $phicdep9="";
  $phicdep10="";
  $phicdep11="";
  $phicdep13="";
}
/*------------------------------------------------------*/

/*5. Name of Patient: */
$LNPat=$lastname;
$FNPat=$firstname;
$MNPat=$middlename;
$MNSuf=$suffix;
/*------------------------------------------------------*/

/*6. Relationship to Member: */
$relofmem=$rtm;

if($paymentmode=="Member"){$rom1="";$rom2="";$rom3="";}
else{
  if($relofmem=="Child"){$rom1="checked='checked'";$rom2="";$rom3="";}
  else if($relofmem=="Parent"){$rom1="";$rom2="checked='checked'";$rom3="";}
  else if($relofmem=="Spouse"){$rom1="";$rom2="";$rom3="checked='checked'";}
  else {$rom1="";$rom2="";$rom3="";}
}
/*------------------------------------------------------*/

$datedischarged=str_replace("_","-",$datedischarged);

/*7. Confinement Period */
$dateadmitted=date("m-d-Y",strtotime($dateadmit));
if($datedischarged!=""){
  $ddis=preg_split('/\-/',$datedischarged);
  $ddism=$ddis[0];
  $ddisd=$ddis[1];
  $ddisy=$ddis[2];
  $ddisf=$ddism."-".$ddisd."-".$ddisy;
}
if($datedischarged == "--"){
  $ddism="";
  $ddisd="";
  $ddisy="";
  $ddisf="";
}

if($ddisf!=""){$datedischargedfmt=date("m-d-Y",strtotime($ddisf));}
else{$datedischargedfmt="--";}

if($datedischargedfmt=="--"){$datedischargedfmtdisp="";}
else{$datedischargedfmtdisp=$datedischargedfmt;}

$dateadmittedarr=str_split($dateadmitted);

$dateadmittedarr0=$dateadmittedarr[0];
$dateadmittedarr1=$dateadmittedarr[1];
$dateadmittedarr3=$dateadmittedarr[3];
$dateadmittedarr4=$dateadmittedarr[4];
$dateadmittedarr6=$dateadmittedarr[6];
$dateadmittedarr7=$dateadmittedarr[7];
$dateadmittedarr8=$dateadmittedarr[8];
$dateadmittedarr9=$dateadmittedarr[9];

$datedischargedarr=str_split($datedischargedfmt);

if($datedischargedfmt!="--"){
  $datedischargedarr0=$datedischargedarr[0];
  $datedischargedarr1=$datedischargedarr[1];
  $datedischargedarr3=$datedischargedarr[3];
  $datedischargedarr4=$datedischargedarr[4];
  $datedischargedarr6=$datedischargedarr[6];
  $datedischargedarr7=$datedischargedarr[7];
  $datedischargedarr8=$datedischargedarr[8];
  $datedischargedarr9=$datedischargedarr[9];
}
else{
  $tmpddsql=mysqli_query($conn,"SELECT * FROM `tempdatestorage` WHERE `caseno`='$caseno'");
  $tmpddcount=mysqli_num_rows($tmpddsql);
  if($tmpddcount!=0){
    $tmpddfetch=mysqli_fetch_array($tmpddsql);
    $tmpdd=$tmpddfetch['date'];

    if($tmpdd!=""){
      $tmpddfmt=date("m-d-Y",strtotime($tmpdd));
      $tmpddspl=str_split($tmpddfmt);

      $datedischargedarr0=$tmpddspl[0];
      $datedischargedarr1=$tmpddspl[1];
      $datedischargedarr3=$tmpddspl[3];
      $datedischargedarr4=$tmpddspl[4];
      $datedischargedarr6=$tmpddspl[6];
      $datedischargedarr7=$tmpddspl[7];
      $datedischargedarr8=$tmpddspl[8];
      $datedischargedarr9=$tmpddspl[9];

      $datedischargedfmtdisp=$datedischargedarr0.$datedischargedarr1."-".$datedischargedarr3.$datedischargedarr4."-".$datedischargedarr6.$datedischargedarr7.$datedischargedarr8.$datedischargedarr9;
    }
    else{
      $datedischargedarr0="";
      $datedischargedarr1="";
      $datedischargedarr3="";
      $datedischargedarr4="";
      $datedischargedarr6="";
      $datedischargedarr7="";
      $datedischargedarr8="";
      $datedischargedarr9="";

      $datedischargedfmtdisp="";
    }
  }
  else{
    $datedischargedarr0="";
    $datedischargedarr1="";
    $datedischargedarr3="";
    $datedischargedarr4="";
    $datedischargedarr6="";
    $datedischargedarr7="";
    $datedischargedarr8="";
    $datedischargedarr9="";

    $datedischargedfmtdisp="";
  }
}
/*------------------------------------------------------*/

/*8. Patient Date of Birth: */
$bdayofpat=date("m-d-Y",strtotime($birthdaterel)); //change this to the value on the DB.

$bdayofpatarr=str_split($bdayofpat);

if(strlen($bdayofpat)>1){
  $bdayofpatarr0=$bdayofpatarr[0];
  $bdayofpatarr1=$bdayofpatarr[1];
  $bdayofpatarr3=$bdayofpatarr[3];
  $bdayofpatarr4=$bdayofpatarr[4];
  $bdayofpatarr6=$bdayofpatarr[6];
  $bdayofpatarr7=$bdayofpatarr[7];
  $bdayofpatarr8=$bdayofpatarr[8];
  $bdayofpatarr9=$bdayofpatarr[9];
}
else{
  $bdayofpatarr0="";
  $bdayofpatarr1="";
  $bdayofpatarr3="";
  $bdayofpatarr4="";
  $bdayofpatarr6="";
  $bdayofpatarr7="";
  $bdayofpatarr8="";
  $bdayofpatarr9="";
}
/*------------------------------------------------------*/

/*9. CERTIFICATION OF MEMBER:*/
if($comchoose=="M"){
  $comnamem=$mfnamerel." ".$mmnamerel." ".$mlnamerel." ".$msuffixrel;
  $comnamer="";
}
else if($comchoose=="R"){
  $comnamem="";
  $comnamer=$comname;
}
else{
  $comnamem="";
  $comnamer="";
}

$comdate=date("m-d-Y",strtotime($comdatesigned));

$comdatearr=str_split($comdate);

if($comchoose=="M"){
  if(($comdatesigned!="")&&($comdatesigned!="--")){
    $comdatearr01=$comdatearr[0];
    $comdatearr11=$comdatearr[1];
    $comdatearr31=$comdatearr[3];
    $comdatearr41=$comdatearr[4];
    $comdatearr61=$comdatearr[6];
    $comdatearr71=$comdatearr[7];
    $comdatearr81=$comdatearr[8];
    $comdatearr91=$comdatearr[9];

    $comdate1=$comdate;

    $comdatearr02="";
    $comdatearr12="";
    $comdatearr32="";
    $comdatearr42="";
    $comdatearr62="";
    $comdatearr72="";
    $comdatearr82="";
    $comdatearr92="";

    $comdate2="";
  }
  else{
    $comdatearr01="";
    $comdatearr11="";
    $comdatearr31="";
    $comdatearr41="";
    $comdatearr61="";
    $comdatearr71="";
    $comdatearr81="";
    $comdatearr91="";

    $comdate1="";

    $comdatearr02="";
    $comdatearr12="";
    $comdatearr32="";
    $comdatearr42="";
    $comdatearr62="";
    $comdatearr72="";
    $comdatearr82="";
    $comdatearr92="";

    $comdate="";
  }
}
else if($comchoose=="R"){
  if(($comdatesigned!="")&&($comdatesigned!="--")){
    $comdatearr01="";
    $comdatearr11="";
    $comdatearr31="";
    $comdatearr41="";
    $comdatearr61="";
    $comdatearr71="";
    $comdatearr81="";
    $comdatearr91="";

    $comdate1="";

    $comdatearr02=$comdatearr[0];
    $comdatearr12=$comdatearr[1];
    $comdatearr32=$comdatearr[3];
    $comdatearr42=$comdatearr[4];
    $comdatearr62=$comdatearr[6];
    $comdatearr72=$comdatearr[7];

    $comdatearr82=$comdatearr[8];
    $comdatearr92=$comdatearr[9];

    $comdate2=$comdate;
  }
  else{
    $comdatearr01="";
    $comdatearr11="";
    $comdatearr31="";
    $comdatearr41="";
    $comdatearr61="";
    $comdatearr71="";
    $comdatearr81="";
    $comdatearr91="";

    $comdate1="";

    $comdatearr02="";
    $comdatearr12="";
    $comdatearr32="";
    $comdatearr42="";
    $comdatearr62="";
    $comdatearr72="";
    $comdatearr82="";
    $comdatearr92="";

    $comdate2="";
  }
}
else{
  $comdatearr01="";
  $comdatearr11="";
  $comdatearr31="";
  $comdatearr41="";
  $comdatearr61="";
  $comdatearr71="";
  $comdatearr81="";
  $comdatearr91="";

  $comdate1="";

  $comdatearr02="";
  $comdatearr12="";
  $comdatearr32="";
  $comdatearr42="";
  $comdatearr62="";
  $comdatearr72="";
  $comdatearr82="";
  $comdatearr92="";

  $comdate2="";
}

if($comchoose=="M"){
  if($comrelation=="Spouse"){$comrtm1="checked='checked'";$comrtm2="";$comrtm3="";$comrtm4="";$comrtm5="";$comrtmos="";}
  else if($comrelation=="Child"){$comrtm1="";$comrtm2="checked='checked'";$comrtm3="";$comrtm4="";$comrtm5="";$comrtmos="";}
  else if($comrelation=="Parent"){$comrtm1="";$comrtm2="";$comrtm3="checked='checked'";$comrtm4="";$comrtm5="";$comrtmos="";}
  else if($comrelation=="Sibling"){$comrtm1="";$comrtm2="";$comrtm3="";$comrtm4="checked='checked'";$comrtm5="";$comrtmos="";}
  else if($comrelation=="Others"){$comrtm1="";$comrtm2="";$comrtm3="";$comrtm4="";$comrtm5="checked='checked'";$comrtmos=$comrelationos;}
  else{$comrtm1="";$comrtm2="";$comrtm3="";$comrtm4="";$comrtm5="";$comrtmos="";}
}
else if($comchoose=="R"){
  if($comrelation=="Spouse"){$comrtm1="checked='checked'";$comrtm2="";$comrtm3="";$comrtm4="";$comrtm5="";$comrtmos="";}
  else if($comrelation=="Child"){$comrtm1="";$comrtm2="checked='checked'";$comrtm3="";$comrtm4="";$comrtm5="";$comrtmos="";}
  else if($comrelation=="Parent"){$comrtm1="";$comrtm2="";$comrtm3="checked='checked'";$comrtm4="";$comrtm5="";$comrtmos="";}
  else if($comrelation=="Sibling"){$comrtm1="";$comrtm2="";$comrtm3="";$comrtm4="checked='checked'";$comrtm5="";$comrtmos="";}
  else if($comrelation=="Others"){$comrtm1="";$comrtm2="";$comrtm3="";$comrtm4="";$comrtm5="checked='checked'";$comrtmos=$comrelationos;}
  else{$comrtm1="";$comrtm2="";$comrtm3="";$comrtm4="";$comrtm5="";$comrtmos="";}
}
else{
  if($comrelation=="Spouse"){$comrtm1="checked='checked'";$comrtm2="";$comrtm3="";$comrtm4="";$comrtm5="";$comrtmos="";}
  else if($comrelation=="Child"){$comrtm1="";$comrtm2="checked='checked'";$comrtm3="";$comrtm4="";$comrtm5="";$comrtmos="";}
  else if($comrelation=="Parent"){$comrtm1="";$comrtm2="";$comrtm3="checked='checked'";$comrtm4="";$comrtm5="";$comrtmos="";}
  else if($comrelation=="Sibling"){$comrtm1="";$comrtm2="";$comrtm3="";$comrtm4="checked='checked'";$comrtm5="";$comrtmos="";}
  else if($comrelation=="Others"){$comrtm1="";$comrtm2="";$comrtm3="";$comrtm4="";$comrtm5="checked='checked'";$comrtmos=$comrelationos;}
  else{$comrtm1="";$comrtm2="";$comrtm3="";$comrtm4="";$comrtm5="";$comrtmos="";}
}

if($comchoose=="M"){
  if($comreason=="1"){$comres1="checked='checked'";$comres2="";$comreso="";}
  else if($comreason=="2"){$comres1="";$comres2="checked='checked'";$comreso=$comreasonos;}
  else{$comres1="";$comres2="";$comreso="";}
}
else if($comchoose=="R"){
  if($comreason=="1"){$comres1="checked='checked'";$comres2="";$comreso="";}
  else if($comreason=="2"){$comres1="";$comres2="checked='checked'";$comreso=$comreasonos;}
  else{$comres1="";$comres2="";$comreso="";}
}
else{
  if($comreason=="1"){$comres1="";$comres2="";$comreso="";}
  else if($comreason=="2"){$comres1="";$comres2="";$comreso="";}
  else{$comres1="";$comres2="";$comreso="";}
}

if($comuw=="1"){$comuw1="checked='checked'";$comuw2="";}
else if($comuw=="2"){$comuw1="";$comuw2="checked='checked'";}
else{$comuw1="";$comuw2="";}
/*------------------------------------------------------*/


/*1.PhilHealth Employer No. (PEN): */
$phicofemploy=$emppen; //Place value of PhilHealth Employer No. (PEN) from the DB here.

if(strlen($phicofemploy)==14){
  $pen=str_split($phicofemploy);
  $pen0=$pen[0];
  $pen1=$pen[1];
  $pen3=$pen[3];
  $pen4=$pen[4];
  $pen5=$pen[5];
  $pen6=$pen[6];
  $pen7=$pen[7];
  $pen8=$pen[8];
  $pen9=$pen[9];
  $pen10=$pen[10];
  $pen11=$pen[11];
  $pen13=$pen[13];
}
else if(strlen($phicofemploy)==12){
  $pen=str_split($phicofemploy);
  $pen0=$pen[0];
  $pen1=$pen[1];
  $pen3=$pen[2];
  $pen4=$pen[3];
  $pen5=$pen[4];
  $pen6=$pen[5];
  $pen7=$pen[6];
  $pen8=$pen[7];
  $pen9=$pen[8];
  $pen10=$pen[9];
  $pen11=$pen[10];
  $pen13=$pen[11];
}
else{
  $pen0="";
  $pen1="";
  $pen3="";
  $pen4="";
  $pen5="";
  $pen6="";
  $pen7="";
  $pen8="";
  $pen9="";
  $pen10="";
  $pen11="";
  $pen13="";
}
/*------------------------------------------------------*/

/*2. Contact No.: */
$employercontactno=$empcontactno;
/*------------------------------------------------------*/


/*3. Business Name: */
$employerbusname=strtoupper($empbusinessname);
/*------------------------------------------------------*/

/*4. CERTIFICATION OF EMPLOYER: */
$employername=$empname;
$employerdesignation=$empsigdesignation;

$employerdatesigned=date("m-d-Y",strtotime($empdatesigned));

$empdatesiarr=str_split($employerdatesigned);

if(($empdatesigned!="")&&($empdatesigned!="--")){
  $empdatesiarr0=$empdatesiarr[0];
  $empdatesiarr1=$empdatesiarr[1];
  $empdatesiarr3=$empdatesiarr[3];
  $empdatesiarr4=$empdatesiarr[4];
  $empdatesiarr6=$empdatesiarr[6];
  $empdatesiarr7=$empdatesiarr[7];
  $empdatesiarr8=$empdatesiarr[8];
  $empdatesiarr9=$empdatesiarr[9];

  $empdatesiarrf=$employerdatesigned;
}
else{
  $empdatesiarr0="";
  $empdatesiarr1="";
  $empdatesiarr3="";
  $empdatesiarr4="";
  $empdatesiarr6="";
  $empdatesiarr7="";
  $empdatesiarr8="";
  $empdatesiarr9="";

  $empdatesiarrf="";
}
/*------------------------------------------------------*/

/*PART III - CONSENT TO ACCESS PATIENT RECORD/S */
if($carchoose=="M"){$consentaccname=$mfnamerel." ".$mmnamerel." ".$mlnamerel." ".$msuffixrel;}
else{$consentaccname=$carname;}

$consentaccdatesigned=date("m-d-Y",strtotime($cardatesigned));

$consentaccsiarr=str_split($consentaccdatesigned);

if(($cardatesigned!="")&&($cardatesigned!="--")){
  $consentaccsiarr0=$consentaccsiarr[0];
  $consentaccsiarr1=$consentaccsiarr[1];
  $consentaccsiarr3=$consentaccsiarr[3];
  $consentaccsiarr4=$consentaccsiarr[4];
  $consentaccsiarr6=$consentaccsiarr[6];
  $consentaccsiarr7=$consentaccsiarr[7];
  $consentaccsiarr8=$consentaccsiarr[8];
  $consentaccsiarr9=$consentaccsiarr[9];

  $consentaccsiarrf=$consentaccdatesigned;
}
else{
  $consentaccsiarr0="";
  $consentaccsiarr1="";
  $consentaccsiarr3="";
  $consentaccsiarr4="";
  $consentaccsiarr6="";
  $consentaccsiarr7="";
  $consentaccsiarr8="";
  $consentaccsiarr9="";

  $consentaccsiarrf="";
}

$consentaccrelation=$carrelation;

if($carchoose=="M"){
  if($carrelation=="Spouse"){$carrtm1="checked='checked'";$carrtm2="";$carrtm3="";$carrtm4="";$carrtm5="";$carrtmos="";}
  else if($carrelation=="Child"){$carrtm1="";$carrtm2="checked='checked'";$carrtm3="";$carrtm4="";$carrtm5="";$carrtmos="";}
  else if($carrelation=="Parent"){$carrtm1="";$carrtm2="";$carrtm3="checked='checked'";$carrtm4="";$carrtm5="";$carrtmos="";}
  else if($carrelation=="Sibling"){$carrtm1="";$carrtm2="";$carrtm3="";$carrtm4="checked='checked'";$carrtm5="";$carrtmos="";}
  else if($carrelation=="Others"){$carrtm1="";$carrtm2="";$carrtm3="";$carrtm4="";$carrtm5="checked='checked'";$carrtmos=$carrelationos;}
  else{$carrtm1="";$carrtm2="";$carrtm3="";$carrtm4="";$carrtm5="";$carrtmos="";}
}
else if($carchoose=="R"){
  if($carrelation=="Spouse"){$carrtm1="checked='checked'";$carrtm2="";$carrtm3="";$carrtm4="";$carrtm5="";$carrtmos="";}
  else if($carrelation=="Child"){$carrtm1="";$carrtm2="checked='checked'";$carrtm3="";$carrtm4="";$carrtm5="";$carrtmos="";}
  else if($carrelation=="Parent"){$carrtm1="";$carrtm2="";$carrtm3="checked='checked'";$carrtm4="";$carrtm5="";$carrtmos="";}
  else if($carrelation=="Sibling"){$carrtm1="";$carrtm2="";$carrtm3="";$carrtm4="checked='checked'";$carrtm5="";$carrtmos="";}
  else if($carrelation=="Others"){$carrtm1="";$carrtm2="";$carrtm3="";$carrtm4="";$carrtm5="checked='checked'";$carrtmos=$carrelationos;}
  else{$carrtm1="";$carrtm2="";$carrtm3="";$carrtm4="";$carrtm5="";$carrtmos="";}
}
else{
  if($carrelation=="Spouse"){$carrtm1="checked='checked'";$carrtm2="";$carrtm3="";$carrtm4="";$carrtm5="";$carrtmos="";}
  else if($carrelation=="Child"){$carrtm1="";$carrtm2="checked='checked'";$carrtm3="";$carrtm4="";$carrtm5="";$carrtmos="";}
  else if($carrelation=="Parent"){$carrtm1="";$carrtm2="";$carrtm3="checked='checked'";$carrtm4="";$carrtm5="";$carrtmos="";}
  else if($carrelation=="Sibling"){$carrtm1="";$carrtm2="";$carrtm3="";$carrtm4="checked='checked'";$carrtm5="";$carrtmos="";}
  else if($carrelation=="Others"){$carrtm1="";$carrtm2="";$carrtm3="";$carrtm4="";$carrtm5="checked='checked'";$carrtmos=$carrelationos;}
  else{$carrtm1="";$carrtm2="";$carrtm3="";$carrtm4="";$carrtm5="";$carrtmos="";}
}

if($carchoose=="M"){
  if($carreason=="1"){$carres1="checked='checked'";$carres2="";$carresos="";}
  else if($carreason=="2"){$carres1="";$carres2="checked='checked'";$carresos=$carreasonos;}
  else{$carres1="";$carres2="";$carresos="";}
}
else if($carchoose=="R"){
  if($carreason=="1"){$carres1="checked='checked'";$carres2="";$carresos="";}
  else if($carreason=="2"){$carres1="";$carres2="checked='checked'";$carresos=$carreasonos;}
  else{$carres1="";$carres2="";$carresos="";}
}
else{
  if($carreason=="1"){$carres1="checked='checked'";$carres2="";$carresos="";}
  else if($carreason=="2"){$carres1="";$carres2="checked='checked'";$carresos=$carreasonos;}
  else{$carres1="";$carres2="";$carresos="";}
}

if($caruw=="1"){$caruw1="checked='checked'";$caruw2="";}
else if($caruw=="2"){$caruw1="";$caruw2="checked='checked'";}
else{$caruw1="";$caruw2="";}
/*------------------------------------------------------*/

/*PART V - PROVIDER INFORMATION AND CERTIFICATION*/
$hcidatesignedfmt=date("m-d-Y",strtotime($hcidatesigned));

$hcidtarr=str_split($hcidatesignedfmt);

if(($hcidatesigned!="")&&($hcidatesigned!="--")){
  $hcidtarr0=$hcidtarr[0];
  $hcidtarr1=$hcidtarr[1];
  $hcidtarr3=$hcidtarr[3];
  $hcidtarr4=$hcidtarr[4];
  $hcidtarr6=$hcidtarr[6];
  $hcidtarr7=$hcidtarr[7];
  $hcidtarr8=$hcidtarr[8];
  $hcidtarr9=$hcidtarr[9];

  $hcidtarrf=$hcidatesignedfmt;
}
else{
  $hcidtarr0="";
  $hcidtarr1="";
  $hcidtarr3="";
  $hcidtarr4="";
  $hcidtarr6="";
  $hcidtarr7="";
  $hcidtarr8="";
  $hcidtarr9="";

  $hcidtarrf="";
}

$dcname=$doctor;

mysqli_query($conn,"SET NAMES utf8");
$dfsql=mysqli_query($conn,"SELECT `phicacc` FROM `docfile` WHERE `name` LIKE '$dcname'");
$dfcount=mysqli_num_rows($dfsql);
if($dfcount==0){
  $phicacc="";

  $dclname="";
  $dcfname="";
  $dcmname="";
  $dcsuffix="";

  $phicac1="";

  $pa10="";
  $pa11="";
  $pa12="";
  $pa13="";
  $pa14="";
  $pa15="";
  $pa16="";
  $pa17="";
  $pa18="";
  $pa19="";
  $pa110="";
  $pa111="";
  $pa112="";
  $pa113="";
}
else{
  $dffetch=mysqli_fetch_array($dfsql);
  $phicacc=$dffetch['phicacc'];

  mysqli_query($conn,"SET NAMES utf8");
  $ddsql=mysqli_query($conn,"SELECT UPPER(`lastname`) AS `lastname`, UPPER(`firstname`) AS `firstname`, UPPER(`middlename`) AS `middlename`, UPPER(`suffix`) AS `suffix` FROM `docdetails` WHERE `phicacc`='$phicacc'");
  $ddcount=mysqli_num_rows($ddsql);
  if($ddcount==0){
    $dclname="";
    $dcfname="";
    $dcmname="";
    $dcsuffix="";

    $phicac1="";

    $pa10="";
    $pa11="";
    $pa12="";
    $pa13="";
    $pa14="";
    $pa15="";
    $pa16="";
    $pa17="";
    $pa18="";
    $pa19="";
    $pa110="";
    $pa111="";
    $pa112="";
    $pa113="";
  }
  else{
    $ddfetch=mysqli_fetch_array($ddsql);
    $dclname=$ddfetch['lastname'];
    $dcfname=$ddfetch['firstname'];
    $dcmname=$ddfetch['middlename'];
    $dcsuffix=$ddfetch['suffix'];

    $phicac1=str_replace("-","",$phicacc);

    $pa1=str_split($phicacc);
    $pa10=$pa1[0];
    $pa11=$pa1[1];
    $pa12=$pa1[2];
    $pa13=$pa1[3];
    $pa14=$pa1[4];
    $pa15=$pa1[5];
    $pa16=$pa1[6];
    $pa17=$pa1[7];
    $pa18=$pa1[8];
    $pa19=$pa1[9];
    $pa110=$pa1[10];
    $pa111=$pa1[11];
    $pa112=$pa1[12];
    $pa113=$pa1[13];
  }
}

$pfname1=$dcfname." ".$dcmname." ".$dclname." ".$dcsuffix;

//PF2
$dcname2=$doctor2;

mysqli_query($conn,"SET NAMES utf8");
$df2sql=mysqli_query($conn,"SELECT `phicacc` FROM `docfile` WHERE `name`='$dcname2'");
$df2count=mysqli_num_rows($df2sql);
if($df2count==0){
  $phicacc2="";

  $phicac2="";

  $dc2lname="";
  $dc2fname="";
  $dc2mname="";
  $dc2suffix="";

  $pa20="";
  $pa21="";
  $pa22="";
  $pa23="";
  $pa24="";
  $pa25="";
  $pa26="";
  $pa27="";
  $pa28="";
  $pa29="";
  $pa210="";
  $pa211="";
  $pa212="";
  $pa213="";
}
else{
  $df2fetch=mysqli_fetch_array($df2sql);
  $phicacc2=$df2fetch['phicacc'];

  mysqli_query($conn,"SET NAMES utf8");
  $dd2sql=mysqli_query($conn,"SELECT UPPER(`lastname`) AS `lastname`, UPPER(`firstname`) AS `firstname`, UPPER(`middlename`) AS `middlename`, UPPER(`suffix`) AS `suffix` FROM `docdetails` WHERE `phicacc`='$phicacc2'");
  $dd2count=mysqli_num_rows($dd2sql);
  if($dd2count==0){
    $dc2lname="";
    $dc2fname="";
    $dc2mname="";
    $dc2suffix="";

    $phicac2="";

    $pa20="";
    $pa21="";
    $pa22="";
    $pa23="";
    $pa24="";
    $pa25="";
    $pa26="";
    $pa27="";
    $pa28="";
    $pa29="";
    $pa210="";
    $pa211="";
    $pa212="";
    $pa213="";
  }
  else{
    $dd2fetch=mysqli_fetch_array($dd2sql);
    $dc2lname=$dd2fetch['lastname'];
    $dc2fname=$dd2fetch['firstname'];
    $dc2mname=$dd2fetch['middlename'];
    $dc2suffix=$dd2fetch['suffix'];

    $phicac2=str_replace("-","",$phicacc2);

    $pa2123=str_split($phicacc2);
    $pa20=$pa2123[0];
    $pa21=$pa2123[1];
    $pa22=$pa2123[2];
    $pa23=$pa2123[3];
    $pa24=$pa2123[4];
    $pa25=$pa2123[5];
    $pa26=$pa2123[6];
    $pa27=$pa2123[7];
    $pa28=$pa2123[8];
    $pa29=$pa2123[9];
    $pa210=$pa2123[10];
    $pa211=$pa2123[11];
    $pa212=$pa2123[12];
    $pa213=$pa2123[13];
  }
}

$pfname2=$dc2fname." ".$dc2mname." ".$dc2lname." ".$dc2suffix;

//PF3
$dcname3=$doctor3;

mysqli_query($conn,"SET NAMES utf8");
$df3sql=mysqli_query($conn,"SELECT `phicacc` FROM `docfile` WHERE `name`='$dcname3'");
$df3count=mysqli_num_rows($df3sql);
if($df3count==0){
  $phicacc3="";

  $dc3lname="";
  $dc3fname="";
  $dc3mname="";
  $dc3suffix="";

  $phicac3="";

  $pa30="";
  $pa31="";
  $pa32="";
  $pa33="";
  $pa34="";
  $pa35="";
  $pa36="";
  $pa37="";
  $pa38="";
  $pa39="";
  $pa310="";
  $pa311="";
  $pa312="";
  $pa313="";
}
else{
  $df3fetch=mysqli_fetch_array($df3sql);
  $phicacc3=$df3fetch['phicacc'];

  mysqli_query($conn,"SET NAMES utf8");
  $dd3sql=mysqli_query($conn,"SELECT UPPER(`lastname`) AS `lastname`, UPPER(`firstname`) AS `firstname`, UPPER(`middlename`) AS `middlename`, UPPER(`suffix`) AS `suffix` FROM `docdetails` WHERE `phicacc`='$phicacc3'");
  $dd3count=mysqli_num_rows($dd3sql);
  if($dd3count==0){
    $dc3lname="";
    $dc3fname="";
    $dc3mname="";
    $dc3suffix="";

    $phicac3="";

    $pa30="";
    $pa31="";
    $pa32="";
    $pa33="";
    $pa34="";
    $pa35="";
    $pa36="";
    $pa37="";
    $pa38="";
    $pa39="";
    $pa310="";
    $pa311="";
    $pa312="";
    $pa313="";
  }
  else{
    $dd3fetch=mysqli_fetch_array($dd3sql);
    $dc3lname=$dd3fetch['lastname'];
    $dc3fname=$dd3fetch['firstname'];
    $dc3mname=$dd3fetch['middlename'];
    $dc3suffix=$dd3fetch['suffix'];

    $phicac3=str_replace("-","",$phicacc3);

    $pa3123=str_split($phicacc3);
    $pa30=$pa3123[0];
    $pa31=$pa3123[1];
    $pa32=$pa3123[2];
    $pa33=$pa3123[3];
    $pa34=$pa3123[4];
    $pa35=$pa3123[5];
    $pa36=$pa3123[6];
    $pa37=$pa3123[7];
    $pa38=$pa3123[8];
    $pa39=$pa3123[9];
    $pa310=$pa3123[10];
    $pa311=$pa3123[11];
    $pa312=$pa3123[12];
    $pa313=$pa3123[13];
  }
}

$pfname3=$dc3fname." ".$dc3mname." ".$dc3lname." ".$dc3suffix;

$pfdatesigned=date("m-d-Y",strtotime($datesigned));

$pfdatesiarr=str_split($pfdatesigned);

if(($datesigned!="")&&($datesigned!="0000-00-00")){
  $pfdatesiarr0=$pfdatesiarr[0];
  $pfdatesiarr1=$pfdatesiarr[1];
  $pfdatesiarr3=$pfdatesiarr[3];
  $pfdatesiarr4=$pfdatesiarr[4];
  $pfdatesiarr6=$pfdatesiarr[6];
  $pfdatesiarr7=$pfdatesiarr[7];
  $pfdatesiarr8=$pfdatesiarr[8];
  $pfdatesiarr9=$pfdatesiarr[9];

  $pfdatesiarrf=$pfdatesigned;
}
else{
   $pfdatesiarr0="";
  $pfdatesiarr1="";
  $pfdatesiarr3="";
  $pfdatesiarr4="";
  $pfdatesiarr6="";
  $pfdatesiarr7="";
  $pfdatesiarr8="";
  $pfdatesiarr9="";

  $pfdatesiarrf="";
}

$pfdatesigned2=date("m-d-Y",strtotime($datesigned2));

$pfdatesiarr2111=str_split($pfdatesigned2);

if(($datesigned2!="")&&($datesigned2!="0000-00-00")){
  $pfdatesiarr20=$pfdatesiarr2111[0];
  $pfdatesiarr21=$pfdatesiarr2111[1];
  $pfdatesiarr23=$pfdatesiarr2111[3];
  $pfdatesiarr24=$pfdatesiarr2111[4];
  $pfdatesiarr26=$pfdatesiarr2111[6];
  $pfdatesiarr27=$pfdatesiarr2111[7];
  $pfdatesiarr28=$pfdatesiarr2111[8];
  $pfdatesiarr29=$pfdatesiarr2111[9];

  $pfdatesiarr2f=$pfdatesigned2;
}
else{
  $pfdatesiarr20="";
  $pfdatesiarr21="";
  $pfdatesiarr23="";
  $pfdatesiarr24="";
  $pfdatesiarr26="";
  $pfdatesiarr27="";
  $pfdatesiarr28="";
  $pfdatesiarr29="";

  $pfdatesiarr2f="";
}

$pfdatesigned3=date("m-d-Y",strtotime($datesigned3));

$pfdatesiarr3111=str_split($pfdatesigned3);

if(($datesigned3!="")&&($datesigned3!="0000-00-00")){
  $pfdatesiarr30=$pfdatesiarr3111[0];
  $pfdatesiarr31=$pfdatesiarr3111[1];
  $pfdatesiarr33=$pfdatesiarr3111[3];
  $pfdatesiarr34=$pfdatesiarr3111[4];
  $pfdatesiarr36=$pfdatesiarr3111[6];
  $pfdatesiarr37=$pfdatesiarr3111[7];
  $pfdatesiarr38=$pfdatesiarr3111[8];
  $pfdatesiarr39=$pfdatesiarr3111[9];

  $pfdatesiarr3f=$pfdatesigned3;
}
else{
  $pfdatesiarr30="";
  $pfdatesiarr31="";
  $pfdatesiarr33="";
  $pfdatesiarr34="";
  $pfdatesiarr36="";
  $pfdatesiarr37="";
  $pfdatesiarr38="";
  $pfdatesiarr39="";

  $pfdatesiarr3f="";
}

$pcasesql=mysqli_query($conn,"SELECT `icdcode` FROM `finalcaserate` WHERE `caseno`='$caseno' AND `level`='primary'");
$pcasecount=mysqli_num_rows($pcasesql);
if($pcasecount==0){
  $pcase="";
}
else{
  $pcasefetch=mysqli_fetch_array($pcasesql);
  $pcase=$pcasefetch['icdcode'];
}

$scasesql=mysqli_query($conn,"SELECT `icdcode` FROM `finalcaserate` WHERE `caseno`='$caseno' AND `level`='secondary'");
$scasecount=mysqli_num_rows($scasesql);
if($scasecount==0){
  $scase="";
}
else{
  while($scasefetch=mysqli_fetch_array($scasesql)){$scase=$scasefetch['icdcode'];}
}

if($hcidtarr0==""){$hcidtarr0=$pfdatesiarr0;}
if($hcidtarr1==""){$hcidtarr1=$pfdatesiarr1;}
if($hcidtarr3==""){$hcidtarr3=$pfdatesiarr3;}
if($hcidtarr4==""){$hcidtarr4=$pfdatesiarr4;}
if($hcidtarr6==""){$hcidtarr6=$pfdatesiarr6;}
if($hcidtarr7==""){$hcidtarr7=$pfdatesiarr7;}
if($hcidtarr8==""){$hcidtarr8=$pfdatesiarr8;}
if($hcidtarr9==""){$hcidtarr9=$pfdatesiarr9;}

function getBrowser(){
  $user_agent=$_SERVER['HTTP_USER_AGENT'];
  $browser="N/A";

  $browsers=[
    '/msie/i' => 'Internet explorer',
    '/firefox/i' => 'Firefox',
    '/safari/i' => 'Safari',
    '/chrome/i' => 'Chrome',
    '/edge/i' => 'Edge',
    '/opera/i' => 'Opera',
    '/mobile/i' => 'Mobile browser',
  ];

  foreach ($browsers as $regex => $value) {
    if (preg_match($regex, $user_agent)) {
      $browser=$value;
    }
  }

  return $browser;
}

echo "
<!doctype html>
<html>
<head>
  <meta http-equiv='content-type' content='text/html; charset=utf-8' />
  <title>Claim Signature Form</title>
  <link rel='icon' href='../../main/assets/favicon/favicon.png' type='image/png' />
  <link rel='shortcut icon' href='../../main/assets/favicon/favicon.png' type='image/png' />
  <link href='CSS/style.css' rel='stylesheet' type='text/css' />
  <link href='CSS/mystyle.css' rel='stylesheet' type='text/css' />
  <style>
    #phicborder {border: #000000 solid 1px;width: 750px;height: auto;}
    #smallbox {border: #000000 solid 1px;width: 13px;height: 14px;font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';font-size: 10px;line-height: 1;text-align: center;}
    #bigbox {border: #000000 solid 2px;width: 80px;height: 65px;}
    #bottomborderdv {border-bottom: #000000 solid 1px;font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';font-size: 10px;line-height: 1;vertical-align: bottom;text-align: left;}
    #header {border: #000000 solid 1px;}
    #body {border: #000000 solid 1px;}
    #part1 {border: #000000 solid 1px;}
    #phicborder2 {border: #000000 solid 1px;width: 750px;height: auto;}
    #part2 {border: #000000 solid 1px;}
    .boxborder {border: #000000 solid 1px;font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';font-size: 10px;line-height: 1;}
    .boxborder2 {border: #000000 solid 2px;}
    .bottomboxborder {border-bottom: #000000 solid 1px;font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';font-size: 12px;font-weight: bold;line-height: 1;}
    .part1style {font-weight: bold;font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';font-size: 10px;line-height: 1;background: #000000;color: white;}
    .stylebody {font-weight: bold;font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';font-size: 10px;line-height: 1;}
    .stylebody1 {font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';font-size: 8px;line-height: 1;}
    .stylebody12 {font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';font-size: 9px;line-height: 1.2;}
    .stylebodyp1 {font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';font-size: 9px;line-height: 1;}
    .stylebody2 {font-weight: bold;font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';font-size: 8px;line-height: 1;}
    .stylebody21 {font-weight: bold;font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';font-size: 9px;line-height: 1;}
    .stylebody3 {font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';font-size: 10px;line-height: 1;}
    .stylehead {font-family:Baskerville, Palatino Linotype, Palatino, Century Schoolbook L, Times New Roman, serif;font-size: 10px;line-height: 1;}
    .stylehead1 {font-weight: bold;font-family:Baskerville, Palatino Linotype, Palatino, Century Schoolbook L, Times New Roman, serif;font-size: 12px;line-height: 1;}
    .stylehead2 {font-weight: bold;font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';font-size: 50px;line-height: 1;}
    .stylehead3 {font-weight: bold;font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';font-size: 10px;line-height: 1;vertical-align:middle;}
    .larger111211111 {-webkit-transform:scale(1.5,1.5);-icab-transform:scale(1.5,1.5);-moz-transform:scale(1.5,1.5);-ms-transform:scale(1.5,1.5);-o-transform:scale(1.5,1.5);transform:scale(1.5,1.5);}
  </style>
</head>
<body><div id='phicborder'>
  <!-- HEADER START HERE-->
  <div id ='header'>
    <table width='750' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='10'></td>
        <td width='150'><div align='left'><img src='Image/Logo.jpg' height='auto' width='130' /></div></td>
        <td width='auto' align='center'><div class='times black s10 bold'><i>Republic of the Philippines</i></div><div class='times black s16 bold'>PHILIPPINE HEALTH INSURANCE CORPORATION</div><div class='times black s10 bold'>Citystate Centre 709 Shaw Boulevard, Pasig City</div><div class='times black s10 bold'>Call Center (02) 441-7442 * Trunkline (02) 441-7444</div><div class='times black s10 bold'>www.philhealth.gov.ph</div><div class='times black s10 bold'>email:actioncenter@philhealth.gov.ph</div></td>
        <td width='150' align='center'><div class='tahoma s8 black'>This form may be reproduced and</div><div class='tahoma s10 black'>is NOT FOR SALE</div><div class='stylehead2'>CSF</div><div class='tahoma s12 black bold'>(Claim Signature Form)</div><div class='tahoma s8 black'>Revised September 2018</div></td>
        <td width='10'></td>
      </tr>
    </table>
  </div>
  <!-- HEADER BODY START HERE-->
  <div id='body'>
    <table width='750' border='0' cellspacing='0' cellpadding='0'>
      <tbody>
        <tr>
          <td colspan='14' height='4'></td>
        </tr>
        <tr>
          <td width='4'>&nbsp;</td>
          <td width='600' class='stylebody21' valign='middle' >IMPORTANT REMINDERS:</td>
          <td width='62'  class='stylebody3'>Series #</td>
          <td width='15' height='18'><div id='smallbox'></div></td>
          <td width='15' height='18' ><div id='smallbox'></div></td>
          <td width='15' height='18' ><div id='smallbox'></div></td>
          <td width='15' height='18' ><div id='smallbox'></div></td>
          <td width='15' height='18' ><div id='smallbox'></div></td>
          <td width='15' height='18' ><div id='smallbox'></div></td>
          <td width='15' height='18' ><div id='smallbox'></div></td>
          <td width='15' height='18' ><div id='smallbox'></div></td>
          <td width='15' height='18' ><div id='smallbox'></div></td>
          <td width='15' height='18' ><div id='smallbox'></div></td>
          <td width='15' height='18' ><div id='smallbox'></div></td>
          <td width='15' height='18' ><div id='smallbox'></div></td>
          <td width='15' height='18' ><div id='smallbox'></div></td>
          <td width='15' height='18' ><div id='smallbox'></div></td>
          <td width='15' height='18' ><div id='smallbox'></div></td>
          <td width='15' height='18' ><div id='smallbox'></div></td>
          <td width='4'>&nbsp;</td>
        </tr>
        <tr>
          <td width='4'>&nbsp;</td>
          <td colspan='18' rowspan='2' class='stylebody12' valign='top'><span class='stylebody12'>PLEASE WRITE IN CAPITAL <strong>LETTERS</strong> AND <strong>CHECK</strong> THE APPROPRIATE BOXES.</span><br><span class='stylebody12'>All Information required in this form are necessary. Claim forms with incomplete information shall not be processed.</span><br> <span class='stylebody21'>FALSE/INCORRECT INFORMATION OR MISREPRESENTATION SHALL BE SUBJECT TO CRIMINAL, CIVIL OR ADMINISTRATIVE LIABILITIES.</span></td>
          <td>&nbsp;</td>
        </tr>

      </tbody>
    </table>
  </div>
  <div id='part1'>
";

include("CSF1.php");
include("CSF2.php");
include("CSF3.php");
include("CSF4.php");
include("CSF5.php");
//

echo "
  </div>
</div>
";

$hsql=mysqli_query($conn,"SELECT * FROM `claiminfoadd2` WHERE `caseno`='$caseno'");
$hcount=mysqli_num_rows($hsql);
if($hcount!=0){
echo "
<br />
<br />
<br />
<div id='phicborder2'>
<div id='part2'>
";

  include("CSF6.php");

  $h2sql=mysqli_query($conn,"SELECT * FROM `claiminfoadd2` WHERE `caseno`='$caseno' AND (`doctor7` NOT LIKE '' OR `doctor8` NOT LIKE '' OR `doctor9` NOT LIKE '')");
  $h2count=mysqli_num_rows($h2sql);
  if($h2count){
    include("CSF6B.php");
  }

echo "
</div>
</div>
";
}

echo "
</body>
</html>
";
?>
