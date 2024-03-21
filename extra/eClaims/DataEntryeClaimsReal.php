<?php
include("../Settings.php");
include("../outcon.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="Resources/Favicon/favicon.png" type="image/png" />
<link rel="shortcut icon" href="Resources/Favicon/favicon.png" type="image/png" />
<title><?php $snamesql=mysqli_query($mycon1,"SELECT heading FROM heading"); while($snamefetch=mysqli_fetch_array($snamesql)){ $sname=$snamefetch['heading']; } echo "$sname"; ?></title>
<link href="Resources/CSS/style.css" rel="stylesheet" type="text/css" />
<script type="text/JavaScript">
<!--
function placeFocus() {
if (document.forms.length > 0) {
var field = document.forms[0];
for (i = 0; i < field.length; i++) {
if ((field.elements[i].type == "text") || (field.elements[i].type == "textarea") || (field.elements[i].type.toString().charAt(0) == "s")) {
document.forms[0].elements[i].focus();
break;
         }
      }
   }
}
//-->
</script>
</head>

<body onload="placeFocus()">
<div align='center'>
  <table style='height:100%;width:94%; position: absolute; top: 0; bottom: 0; left: 3%; right: 3%;' border='0' bordercolor='#000000' cellpadding='0' cellspacing='0'>
    <tr>
      <td style='height: 100%;'><div align='center'><img src='Resources/GIF/Loading.gif' height='230' width='auto' /></div></td>
    </tr>
  </table>
</div>
<?php
ini_set("display_errors","On");

$patientidno=mysqli_real_escape_string($mycon1,$_GET['patientidno']);
$caseno=mysqli_real_escape_string($mycon1,$_GET['caseno']);
$username=mysqli_real_escape_string($mycon1,$_GET['uname']);


$cf1sql=mysqli_query($mycon3,"SELECT * FROM `eclaimtree`.`cf1` WHERE caseno='$caseno'");
$cf1count=mysqli_num_rows($cf1sql);

if($cf1count==0){
  mysqli_query($mycon1,"SET NAMES 'utf8'");
  $admsql=mysqli_query($mycon1,"SELECT `type`, `hmomembership`, `paymentmode`, `room`, UPPER(`street`) AS `street`, UPPER(`barangay`) AS `barangay`, UPPER(`municipality`) AS `municipality`, UPPER(`province`) AS `province`, `zipcode`, UPPER(`pastmed`) AS `pastmed`, UPPER(`initialdiagnosis`) AS `initialdiagnosis`, UPPER(`finaldiagnosis`) AS `finaldiagnosis`, UPPER(`ap`) AS `ap`, `timeadmitted`, `dateadmit` FROM `admission` WHERE `caseno`='$caseno'");
  $admfetch=mysqli_fetch_array($admsql);
  $type=$admfetch['type'];
  $hmomembership=$admfetch['hmomembership'];
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

  $initialdiagnosis=str_replace("`","",$initialdiagnosis);
  $initialdiagnosis=str_replace("%","PERCENT",$initialdiagnosis);
  $initialdiagnosis=str_replace("&","AND",$initialdiagnosis);
  $initialdiagnosis=str_replace("<","LESS THAN",$initialdiagnosis);
  $initialdiagnosis=str_replace(">","MORE THAN",$initialdiagnosis);
  $initialdiagnosis=str_replace(":","",$initialdiagnosis);
  $initialdiagnosis=str_replace("  "," ",$initialdiagnosis);
  $initialdiagnosis=str_replace("  "," ",$initialdiagnosis);
  $initialdiagnosis=str_replace("  "," ",$initialdiagnosis);
  $initialdiagnosis=trim($initialdiagnosis);

  $finaldiagnosis=str_replace("`","",$finaldiagnosis);
  $finaldiagnosis=str_replace("%","PERCENT",$finaldiagnosis);
  $finaldiagnosis=str_replace("&","AND",$finaldiagnosis);
  $finaldiagnosis=str_replace("<","LESS THAN",$finaldiagnosis);
  $finaldiagnosis=str_replace(">","MORE THAN",$finaldiagnosis);
  $finaldiagnosis=str_replace(":","",$finaldiagnosis);
  $finaldiagnosis=str_replace("  "," ",$finaldiagnosis);
  $finaldiagnosis=str_replace("  "," ",$finaldiagnosis);
  $finaldiagnosis=str_replace("  "," ",$finaldiagnosis);
  $finaldiagnosis=trim($finaldiagnosis);

  if($room=="OPD"){$pPatientType="O";}else{$pPatientType="I";}

  $datetimead=$dateadmit." ".$timeadmitted;
  $gettimead=date("h:i:sA",strtotime($datetimead));

  $mailadd=$street." ".$barangay." ".$municipality." ".$province;
  $mailadd=str_replace("&","AND",$mailadd);
  $mailadd=str_replace("  "," ",$mailadd);
  $mailadd=str_replace("  "," ",$mailadd);
  $mailadd=str_replace("  "," ",$mailadd);
  $mailadd=str_replace("`","",$mailadd);
  $mailadd=trim($mailadd);

  if($type=="Employment-Govt"){$typerel="G";}
  else if($type=="Employment-Private"){$typerel="S";}
  else if($type=="Self-Employed"){$typerel="NS";}
  else if($type=="OFW"){$typerel="NO";}
  else if($type=="OWWA"){$typerel="NO";}
  else if($type=="Indigent"){$typerel="I";}
  else if($type=="Pensioner"){$typerel="P";}
  else if($type=="NON PHIC"){$typerel="PS";}
  else if($type=="Lifetime member"){$typerel="P";}
  else if($type=="Employed Private"){$typerel="S";}
  else if($type=="Employer Government"){$typerel="G";}
  else if($type=="Individually Paying"){$typerel="NS";}
  else if($type=="Non Paying Private"){$typerel="PS";}
  else if($type=="Non Paying Government"){$typerel="PG";}
  else{$typerel="PS";}

  mysqli_query($mycon1,"SET NAMES 'utf8'");
  $patfsql=mysqli_query($mycon1,"SELECT UPPER(`lastname`) AS `lastname`, UPPER(`firstname`) AS `firstname`, UPPER(`middlename`) AS `middlename`, `birthdate`, `age`, UPPER(`sex`) AS `sex`, `suffix` FROM `patientprofile` WHERE `patientidno`='$patientidno'");
  $patffetch=mysqli_fetch_array($patfsql);
  $lastname=$patffetch['lastname'];
  $firstname=$patffetch['firstname'];
  $middlename=$patffetch['middlename'];
  $birthdate=$patffetch['birthdate'];
  $age=$patffetch['age'];
  $sex=$patffetch['sex'];
  $suffix=$patffetch['suffix'];

  $birthdatespl=preg_split('/\-/', $birthdate);

  $bm=$birthdatespl[0];
  $bd=$birthdatespl[1];
  $by=$birthdatespl[2];

  if(strlen($bd)==1){$bdf="0".$bd;}else{$bdf=$bd;}

  $birthdaterel=$bm."-".$bdf."-".$by;

  mysqli_query($mycon1,"SET NAMES 'utf8'");
  $cfsql=mysqli_query($mycon1,"SELECT `identificationno`, `lastname`, `firstname`, `middlename` FROM `claiminfo` WHERE `patientidno`='$patientidno' AND `caseno`='$caseno'");
  $cfcount=mysqli_num_rows($cfsql);

  if($cfcount==0){
    $identificationno="";
    $mlname="";
    $mfname="";
    $mmname="";
  }
  else{
    $cffetch=mysqli_fetch_array($cfsql);
    $identificationno=$cffetch['identificationno'];
    $mlname=strtoupper($cffetch['lastname']);
    $mfname=strtoupper($cffetch['firstname']);
    $mmname=strtoupper($cffetch['middlename']);
  }

  $cimisql=mysqli_query($mycon1,"SELECT * FROM `claiminfomoreinfo` WHERE `caseno`='$caseno'");
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
    $carrelationos="";
    $carreason="";
    $carreasonos="";
    $caruw="";
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
  }

  $emppenfmt=str_replace("-","",$emppen);
  $empbusinessname=str_replace("'","",$empbusinessname);
  $empbusinessname=str_replace("&","AND",$empbusinessname);

  $mbsuffix=$membersuffix;
  $mbdate=$memberbday;
  $mgender=$membergender;

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
    $msuffixrel=$mbsuffix;
    $mbdaterel=$mbdate;
    $mgenderrel=$mgender;
  }

  $identificationnofmt=str_replace("-","",$identificationno);

  $cfasql=mysqli_query($mycon1,"SELECT `hciyes`, `hcino`, `disposition`, `expireddays`, `timeexpired`, `transferto`, `transferadd`, `reasons`, `private`, `nonprivate`, `doctor1`, `datesigned1`, `copay1`, `doctor2`, `datesigned2`, `copay2`, `doctor3`, `datesigned3`, `copay3` FROM `claiminfoadd` WHERE `caseno`='$caseno'");
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
    $copay="";
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
    $copay=$cfafetch['copay1'];
    $datesigned=$cfafetch['datesigned1'];
    $doctor2=$cfafetch['doctor2'];
    $datesigned2=$cfafetch['datesigned2'];
    $copay2=$cfafetch['copay2'];
    $doctor3=$cfafetch['doctor3'];
    $datesigned3=$cfafetch['datesigned3'];
    $copay3=$cfafetch['copay3'];
  }

  $expdt=$expireddays." ".$timeexpired;

  if(($hciyes=="checked")&&($hcino=="")){$pPatientReferred="Y";$pReferredIHCPAccreCode="";}
  else if(($hciyes=="")&&($hcino=="checked")){$pPatientReferred="N";$pReferredIHCPAccreCode="";}
  else{$pPatientReferred="N";$pReferredIHCPAccreCode="";}

  if($disposition=="E"){$pExpiredDate=date("m-d-Y",strtotime($expireddays));$pExpiredTime=date("h:i:sA",strtotime($expdt));}
  else{$pExpiredDate="";$pExpiredTime="";}

  if($disposition=="T"){$pReferralIHCPAccreCode="";$pReferralReasons=$reasons;}
  else{$pReferralIHCPAccreCode="";$pReferralReasons="";}

  if(($nonprivate=="checked")&&($private=="")){$accty="N";}
  else if(($nonprivate=="")&&($private=="checked")){$accty="P";}
  else if(($nonprivate=="checked")&&($private=="checked")){$accty="";}
  else if(($nonprivate=="")&&($private=="")){$accty="";}
  else{$accty="";}

  $dtsql=mysqli_query($mycon1,"SELECT `datedischarged`, `timedischarged` FROM `dischargedtable` WHERE `caseno`='$caseno'");
  $dtcount=mysqli_num_rows($dtsql);
  if($dtcount==0){
    $datedischarged="__";
    $timedischarged="";
  }
  else{
    $dtfetch=mysqli_fetch_array($dtsql);
    $datedischarged=$dtfetch['datedischarged'];
    $timedischarged=$dtfetch['timedischarged'];
  }

  $datedischarged=str_replace("_","-",$datedischarged);

  $ddis=preg_split('/\-/',$datedischarged);
  $ddism=$ddis[0];
  $ddisd=$ddis[1];
  $ddisy=$ddis[2];

  $datedischargedrel=$ddism."-".$ddisd."-".$ddisy;

  $datetimedis=$datedischargedrel." ".$timedischarged;
  $gettimedis=date("h:i:sA",strtotime($datetimedis));

  $fcsql=mysqli_query($mycon1,"SELECT `icdcode`, `hospitalshare`, `pfshare`, `level`, UPPER(`description`) AS `description` FROM `finalcaserate` WHERE `caseno`='$caseno' AND `level`='primary'");
  $fccount=mysqli_num_rows($fcsql);

  if($fccount==0){
    $fcicdcode="";
    $fcdesc="";
    $fchshare=0;
    $fcpshare=0;
  }
  else{
    $fcfetch=mysqli_fetch_array($fcsql);
    $fcicdcode=$fcfetch['icdcode'];
    $fchshare=$fcfetch['hospitalshare'];
    $fcpshare=$fcfetch['pfshare'];
    $fcdesc=$fcfetch['description'];
  }


  mysqli_query($mycon3,"SET NAMES 'utf8'");
  mysqli_query($mycon3,"INSERT INTO `eclaimtree`.`cf1` (`pMemberPIN`, `pMemberLastName`, `pMemberFirstName`, `pMemberMiddleName`, `pMemberSuffix`, `pMemberBirthDate`, `pMemberShipType`, `pMailingAddress`, `pMemberSex`, `pZipCode`, `pLandlineNo`, `pMobileNo`, `pEmailAddress`, `pPatientIs`, `pPatientPIN`, `pPatientLastName`, `pPatientFirstName`, `pPatientMiddleName`, `pPatientSuffix`, `pPatientBirthDate`, `pPatientSex`, `pPEN`, `pEmployerName`, `caseno`) VALUES ('$identificationnofmt', '$mlnamerel', '$mfnamerel', '$mmnamerel', '$msuffixrel', '".date("m-d-Y",strtotime($mbdaterel))."', '$typerel', '$mailadd', '$mgenderrel', '$zipcode', '', '', '', '$paymentmode', '$identificationnofmt', '$lastname', '$firstname', '$middlename', '$suffix', '".date("m-d-Y",strtotime($birthdaterel))."', '$sex', '$emppenfmt', '$empbusinessname', '$caseno')");
  $ecf1=mysqli_affected_rows($mycon3);

  mysqli_query($mycon3,"INSERT INTO `eclaimtree`.`cf2` (`pPatientReferred`, `pReferredIHCPAccreCode`, `pAdmissionDate`, `pAdmissionTime`, `pDischargeDate`, `pDischargeTime`, `pDisposition`, `pExpiredDate`, `pExpiredTime`, `pReferralIHCPAccreCode`, `pReferralReasons`, `pAccommodationType`, `pHasAttachedSOA`, `caseno`) VALUES ('$pPatientReferred', '$pReferredIHCPAccreCode', '".date("m-d-Y",strtotime($dateadmit))."', '$gettimead', '".date("m-d-Y",strtotime($datedischargedrel))."', '$gettimedis', '$disposition', '$pExpiredDate', '$pExpiredTime', '$pReferralIHCPAccreCode', '$pReferralReasons', '$accty', 'Y', '$caseno')");
  $ecf2=mysqli_affected_rows($mycon3);

  mysqli_query($mycon3,"INSERT INTO `eclaimtree`.`claim` (`pClaimNumber`, `pTrackingNumber`, `pPhilhealthClaimType`, `pPatientType`, `pIsEmergency`, `caseno`) VALUES ('".date("ymdhis")."', '', 'ALL-CASE-RATE', '$pPatientType', 'N', '$caseno')");
  $eclaim=mysqli_affected_rows($mycon3);

  mysqli_query($mycon3,"INSERT INTO `eclaimtree`.`caseno` (`caseno`, `status`) VALUES ('$caseno', 'processing')");
  $ecaseno=mysqli_affected_rows($mycon3);

  mysqli_query($mycon3,"INSERT INTO `eclaimtree`.`diagnosis` (`pAdmissionDiagnosis`, `caseno`) VALUES ('$initialdiagnosis', '$caseno')");
  $ediagnosis=mysqli_affected_rows($mycon3);

  mysqli_query($mycon3,"INSERT INTO `eclaimtree`.`discharge` (`pDischargeDiagnosis`, `caseno`) VALUES ('$finaldiagnosis', '$caseno')");
  $edischarge=mysqli_affected_rows($mycon3);

  $mcsql=mysqli_query($mycon1,"SELECT `transmitno1`, `transmitno2` FROM `myCounter`");
  $mcfetch=mysqli_fetch_array($mcsql);
  $transmitno1=$mcfetch['transmitno1'];
  $transmitno2=$mcfetch['transmitno2'];

  if($transmitno1=='1'){$partone="A";}
  if($transmitno1=='2'){$partone="B";}
  if($transmitno1=='3'){$partone="C";}
  if($transmitno1=='4'){$partone="D";}

  if($transmitno2<10){$transmitno=$partone."-00000".$transmitno2;}
  else if(($transmitno2<100)&&($transmitno2>9)){$transmitno=$partone."-0000".$transmitno2;}
  else if(($transmitno2<1000)&&($transmitno2>99)){$transmitno=$partone."-000".$transmitno2;}
  else if(($transmitno2<10000)&&($transmitno2>999)){$transmitno=$partone."-00".$transmitno2;}
  else if(($transmitno2<100000)&&($transmitno2>9999)){$transmitno=$partone."-0".$transmitno2;}
  else if(($transmitno2<1000000)&&($transmitno2>99999)){$transmitno=$partone."-".$transmitno2;}

  mysqli_query($mycon3,"INSERT INTO `eclaimtree`.`etransmittal` (`pHospitalTransmittalNo`, `pTotalClaims`, `caseno`) VALUES ('$transmitno', '1', '$caseno')");
  $eetransmittal=mysqli_affected_rows($mycon3);

  if($transmitno2=='99999'){$transmitno2plus=0;$transmitno1plus=$transmitno1+1;}
  else{$transmitno2plus=$transmitno2+1;$transmitno1plus=$transmitno1;}

  mysqli_query($mycon1,"UPDATE `myCounter` SET `transmitno1`='$transmitno1plus', `transmitno2`='$transmitno2plus'");
  $eprofessionals=0;

  /*PF------PF------PF------PF------PF------PF------PF------PF------PF------PF------PF------PF------PF------PF------PF------PF------PF*/
  //PROFESSIONAL FEE-------------------------------------------------------------------------------------------------------------------------
  $atcount=0;$sucount=0;$ancount=0;
  $prcount=0;$tprgr=0;$tprad=0;$tprp1=0;$tprp2=0;$tprhm=0;$tprex=0;
  $prsql=mysqli_query($mycon1,"SELECT `productcode`, `productdesc`, `producttype` FROM `productout` WHERE `caseno`='$caseno' AND `productsubtype`='PROFESSIONAL FEE' AND (`producttype`='IPD attending' OR `producttype`='IPD surgeon' OR `producttype`='IPD anesthesiologist') ORDER BY FIELD(`producttype`, 'IPD attending', 'IPD surgeon', 'IPD anesthesiologist'), `productdesc`");
  while($prfetch=mysqli_fetch_array($prsql)){
    $prcode=$prfetch['productcode'];
    $prdoctor=$prfetch['productdesc'];
    $prptype=$prfetch['producttype'];
    $prcount++;

    $dfsql=mysqli_query($mycon1,"SELECT `name` FROM `docfile` WHERE `code`='$prcode'");
    $dfcount=mysqli_num_rows($dfsql);
    if($dfcount==0){
      $logdoc=$prdoctor;
    }
    else{
      $dffetch=mysqli_fetch_array($dfsql);
      $logdoc=$dffetch['name'];
    }

    $pra=0;$pragr=0;$praad=0;$prap1=0;$prap2=0;$prahm=0;$praex=0;
    $pratsql=mysqli_query($mycon1,"SELECT * FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `productdesc`='$prdoctor'");
    while($pratfetch=mysqli_fetch_array($pratsql)){$pragr+=($pratfetch['sellingprice']*$pratfetch['quantity']);$praad+=$pratfetch['adjustment'];$prap1+=$pratfetch['phic'];$prap2+=$pratfetch['phic1'];$prahm+=$pratfetch['hmo'];$praex+=$pratfetch['excess'];}

    if($prptype=="IPD attending"){
    //Attending--------------------------------------------------------------------------------------
      $atcount++;
      if($atcount==1){
        $yxamt=0;
        $prcosql=mysqli_query($mycon1,"SELECT * FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND (`producttype`='IPD comanaged' OR `producttype`='Consultation')");
        while($prcofetch=mysqli_fetch_array($prcosql)){
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
        $prcssql=mysqli_query($mycon1,"SELECT * FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `producttype`='IPD co-surgeon'");
        while($prcsfetch=mysqli_fetch_array($prcssql)){
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
        $prcasql=mysqli_query($mycon1,"SELECT * FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `producttype`='IPD co-anesthesiologist'");
        while($prcafetch=mysqli_fetch_array($prcasql)){

          $pragr+=($prcafetch['sellingprice']*$prcafetch['quantity']);$praad+=$prcafetch['adjustment'];$prap1+=$prcafetch['phic'];$prap2+=$prcafetch['phic1'];$prahm+=($prcafetch['hmo']+$yzamt);$praex+=($prcafetch['excess']-$yzamt);
        }
      }
    //End Surgeon------------------------------------------------------------------------------------
    }

    $zxamount=0;
    $zxsql=mysqli_query($mycon1,"SELECT `amount`, `accttitle` FROM `collection` WHERE `acctno`='$caseno' AND `description`='$prdoctor' AND `accttitle` LIKE '%AR%%PF%'");
    while($zxfetch=mysqli_fetch_array($zxsql)){
      $zxacc=$zxfetch['accttitle'];
      if($zxacc!="AR TRADE PF"){
        $zxamount+=$zxfetch['amount'];
      }
    }

    $tprgr+=$pragr;$tprad+=$praad;$tprp1+=$prap1;$tprp2+=$prap2;$tprhm+=($prahm+$zxamount);$tprex+=($praex-$zxamount);

    $pfdesc=$prdoctor;
    $pfiact=$pragr;
    $pfiadj=$praad;
    $pfihmo=$prahm+$zxamount;
    $pfiph1=$prap1;
    $pfiph2=$prap2;
    $pfifin=$praex-$zxamount;

    mysqli_query($mycon1,"SET NAMES 'utf8'");
    $docsql=mysqli_query($mycon1,"SELECT * FROM `docfile` WHERE `code`='$prcode'");
    $doccount=mysqli_num_rows($docsql);
    if($doccount!=0){
      $docfetch=mysqli_fetch_array($docsql);
      $docphicacc=$docfetch['phicacc'];
      $docln=mb_strtoupper(trim($docfetch['lastname']));
      $docfn=mb_strtoupper(trim($docfetch['firstname']));
      $docmn=mb_strtoupper(trim($docfetch['middlename']));
      $docsf=mb_strtoupper(trim($docfetch['ext']));

      if($pfifin>0){
        $pWithCoPay="Y";
        $pDoctorCoPay=$pfifin;
      }
      else{
        $pWithCoPay="N";
        $pDoctorCoPay="0";
      }

      $phicaccfmt=str_replace("-","",$docphicacc);

      mysqli_query($mycon3,"SET NAMES 'utf8'");
      mysqli_query($mycon3,"INSERT INTO `eclaimtree`.`professionals` (`pDoctorAccreCode`, `pDoctorLastName`, `pDoctorFirstName`, `pDoctorMiddleName`, `pDoctorSuffix`, `pWithCoPay`, `pDoctorCoPay`, `pDoctorSignDate`, `caseno`) VALUES ('$phicaccfmt', '$docln', '$docfn', '$docmn', '$docsf', '$pWithCoPay', '$pDoctorCoPay', '".date("m-d-Y",strtotime($datedischarged))."', '$caseno')");

    }
  }
  //END PROFESSIONAL FEE---------------------------------------------------------------------------------------------------------------------
  /*PF------PF------PF------PF------PF------PF------PF------PF------PF------PF------PF------PF------PF------PF------PF------PF------PF*/

  mysqli_query($mycon3,"INSERT INTO `eclaimtree`.`aprbypatsig` (`pDateSigned`, `caseno`) VALUES ('".date("m-d-Y",strtotime($datedischarged))."', '$caseno')");
  $eaprbypatsig=mysqli_affected_rows($mycon3);

  //CASE RATES-----------------------------------------------------------------------------------------------------------------------------------------
  $crhtot=0;
  $crptot=0;
  $cr1="";
  $cr2="";
  $fcsql=mysqli_query($mycon1,"SELECT * FROM `finalcaserate` WHERE `caseno`='$caseno'");
  while($fcfetch=mysqli_fetch_array($fcsql)){
    $ir=$fcfetch['icdcode'];
    $hs=$fcfetch['hospitalshare'];
    $ps=$fcfetch['pfshare'];
    $lv=$fcfetch['level'];
    $de=$fcfetch['description'];

    $to=$hs+$ps;

    if($lv=="primary"){
      mysqli_query($mycon3,"INSERT INTO kmscicaserate(caseno,code,type,packageamount,hospitalamount,pfamount) VALUES('$caseno','$ir','1','$to','$hs','$ps')");
      $crhtot+=$hs;
      $crptot+=$ps;
      $cr1=$ir;
    }
    else if($lv=="secondary"){
      mysqli_query($mycon3,"INSERT INTO kmscicaserate(caseno,code,type,packageamount,hospitalamount,pfamount) VALUES('$caseno','$ir','2','$to','$hs','$ps')");
      $crhtot+=$hs;
      $crptot+=$ps;
      $cr2=$ir;
    }
    else{
      mysqli_query($mycon3,"INSERT INTO kmscicaserateadd(caseno,`code`,`description`) VALUES('$caseno','$ir','$de')");
    }
  }
  //---------------------------------------------------------------------------------------------------------------------------------------------------



  //---------------------------------------------------------------------------------------------------------------------------------------------------
  mysqli_query($mycon3,"INSERT INTO `eclaimtree`.`allcaserate` (`eraseme`, `caseno`) VALUES ('1', '$caseno')");
  mysqli_query($mycon3,"INSERT INTO `eclaimtree`.`apr` (`eraseme`, `caseno`) VALUES ('1', '$caseno')");
  mysqli_query($mycon3,"INSERT INTO `eclaimtree`.`special` (`eraseme`, `caseno`) VALUES ('1', '$caseno')");
  mysqli_query($mycon3,"INSERT INTO `eclaimtree`.`documents` (`eraseme`, `caseno`) VALUES ('1', '$caseno')");
  //---------------------------------------------------------------------------------------------------------------------------------------------------




  //Patient Account Summary----------------------------------------------------------------------------------------------------------------------------

  //pRectalI-------------------
  if(file_exists('/opt/lampp/htdocs/2022codes/eClaims/Charges/'.$caseno.'-ai.txt')){unlink('/opt/lampp/htdocs/ERP/extra/eClaims/Charges/'.$caseno.'-ai.txt');}
  mysqli_query($mycon1,"SELECT * FROM productoutaddinfo WHERE caseno='$caseno' INTO OUTFILE '/opt/lampp/htdocs/ERP/extra/eClaims/Charges/$caseno-ai.txt' FIELDS TERMINATED BY '|'");
  mysqli_query($mycon6,"LOAD DATA LOCAL INFILE '/opt/lampp/htdocs/ERP/extra/eClaims/Charges/$caseno-ai.txt' INTO TABLE productoutaddinfo FIELDS TERMINATED BY '|' LINES TERMINATED BY '\n'");
  if(file_exists('/opt/lampp/htdocs/2022codes/eClaims/Charges/'.$caseno.'-ai.txt')){unlink('/opt/lampp/htdocs/ERP/extra/eClaims/Charges/'.$caseno.'-ai.txt');}
  //---------------------------

  $hgtot=0;
  $hatot=0;
  $aeposql=mysqli_query($mycon1,"SELECT refno, productcode, productdesc, sellingprice, CAST(sellingprice AS DECIMAL(10,2)) AS sp, quantity, adjustment, CAST(adjustment AS DECIMAL(10,2)) AS adj, gross, CAST(gross AS DECIMAL(10,2)) AS gr, phic, CAST(phic AS DECIMAL(10,2)) AS ph, phic1, CAST(phic1 AS DECIMAL(10,2)) AS ph1, hmo, CAST(hmo AS DECIMAL(10,2)) AS hm, excess, CAST(excess AS DECIMAL(10,2)) AS ex, productsubtype, administration, terminalname, status FROM productout WHERE caseno='$caseno' AND trantype='charge' AND quantity > 0 AND productsubtype NOT LIKE 'PROFESSIONAL FEE' ORDER BY productsubtype, productdesc, datearray");
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
    $aeptype=$aepofetch['productsubtype'];
    $aetname=$aepofetch['administration'];
    $aeterm=$aepofetch['terminalname'];
    $aestat=strtoupper($aepofetch['status']);

    $consp=$aepofetch['sp'];
    $conadj=$aepofetch['adj'];
    $congross=$aepofetch['gr'];
    $conphic=$aepofetch['ph'];
    $conphic1=$aepofetch['ph1'];
    $conhmo=$aepofetch['hm'];
    $conexcess=$aepofetch['ex'];

    $one=number_format(((($consp*$aeqty)-$conadj)*1),2);
    $two=number_format(($congross*1),2);
    $three=number_format((($conphic+$conphic1+$conhmo+$conexcess)*1),2);

    if(($aeptype=="PHARMACY/MEDICINE")||($aeptype=="PHARMACY/SUPPLIES")||($aeptype=="MEDICAL SURGICAL SUPPLIES")){
      if(($aetname!="pending")&&($aetname!="dispensed")){
        $hgtot+=($consp*$aeqty);
        $hatot+=$conadj;

        if($aeptype=="PHARMACY/MEDICINE"){
          if (file_exists('/opt/lampp/htdocs/2022codes/eClaims/Charges/'.$caseno.'.txt')) {unlink('/opt/lampp/htdocs/2022codes/eClaims/Charges/'.$caseno.'.txt');}
          mysqli_query($mycon1,"SELECT * FROM productout WHERE refno='$aerefno' INTO OUTFILE '/opt/lampp/htdocs/2022codes/eClaims/Charges/$caseno.txt' FIELDS TERMINATED BY '|'");
          mysqli_query($mycon6,"LOAD DATA LOCAL INFILE '/opt/lampp/htdocs/2022codes/eClaims/Charges/$caseno.txt' INTO TABLE productout FIELDS TERMINATED BY '|' LINES TERMINATED BY '\n'");
        }
      }
    }
    else if(($aeptype=="LABORATORY")||($aeptype=="XRAY")||($aeptype=="MAMMOGRAPHY")||($aeptype=="ULTRASOUND")||($aeptype=="EEG")||($aeptype=="CT SCAN")||($aeptype=="HEARTSTATION")){
      if($aeterm!="pending"){
        $hgtot+=($consp*$aeqty);
        $hatot+=$conadj;
      }
    }
    else{
      $hgtot+=($consp*$aeqty);
      $hatot+=$conadj;
    }
  }

  $hntot=$hgtot-$hatot;

  //PF---------------------------------------------
  $pgtot=0;
  $patot=0;
  $pfaeposql=mysqli_query($mycon1,"SELECT `refno`, `productcode`, `productdesc`, `sellingprice`, CAST(`sellingprice` AS DECIMAL(10,2)) AS `sp`, `quantity`, `adjustment`, CAST(`adjustment` AS DECIMAL(10,2)) AS `adj`, `gross`, CAST(`gross` AS DECIMAL(10,2)) AS `gr`, `phic`, CAST(`phic` AS DECIMAL(10,2)) AS `ph`, `phic1`, CAST(`phic1` AS DECIMAL(10,2)) AS `ph1`, `hmo`, CAST(`hmo` AS DECIMAL(10,2)) AS `hm`, `excess`, CAST(`excess` AS DECIMAL(10,2)) AS `ex`, `productsubtype`, `administration`, `terminalname`, `status` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > 0 AND `productsubtype`='PROFESSIONAL FEE' ORDER BY `productsubtype`, `productdesc`, `datearray`");
  while($pfaepofetch=mysqli_fetch_array($pfaeposql)){
    $pfaerefno=$pfaepofetch['refno'];
    $pfaecode=$pfaepofetch['productcode'];
    $pfaedesc=$pfaepofetch['productdesc'];
    $pfaesp=$pfaepofetch['sellingprice'];
    $pfaeqty=$pfaepofetch['quantity'];
    $pfaeadj=$pfaepofetch['adjustment'];
    $pfaegross=$pfaepofetch['gross'];
    $pfaephic=$pfaepofetch['phic'];
    $pfaephic1=$pfaepofetch['phic1'];
    $pfaehmo=$pfaepofetch['hmo'];
    $pfaeexcess=$pfaepofetch['excess'];
    $pfaeptype=$pfaepofetch['productsubtype'];
    $pfaetname=$pfaepofetch['administration'];
    $pfaeterm=$pfaepofetch['terminalname'];
    $pfaestat=strtoupper($pfaepofetch['status']);

    $pfaedesc=str_replace("ams-","",$pfaedesc);
    $pfaedesc=str_replace("-sup","",$pfaedesc);
    $pfaedesc=str_replace("-med","",$pfaedesc);

    $pconsp=$pfaepofetch['sp'];
    $pconadj=$pfaepofetch['adj'];
    $pcongross=$pfaepofetch['gr'];
    $pconphic=$pfaepofetch['ph'];
    $pconphic1=$pfaepofetch['ph1'];
    $pconhmo=$pfaepofetch['hm'];
    $pconexcess=$pfaepofetch['ex'];

    $pgtot+=($pconsp*$pfaeqty);
    $patot+=$pconadj;
  }

  $pntot=$pgtot-$patot;
  //END PF-----------------------------------------

  $pasumsql=mysqli_query($mycon1,"SELECT * FROM `patientaccountsummary` WHERE `caseno`='$caseno'");
  $pasumcount=mysqli_num_rows($pasumsql);
  if($pasumcount==0){
    mysqli_query($mycon1,"INSERT INTO `kmsci`.`patientaccountsummary` (`caseno`, `hactual`, `hadjustment`, `hgross`, `pfactual`, `pfadjustment`, `pfgross`) VALUES ('$caseno', '$hgtot', '$hatot', '$hntot', '$pgtot', '$patot', '$pntot')");
  }
  else{
    mysqli_query($mycon1,"UPDATE `kmsci`.`patientaccountsummary` SET hactual='$hgtot', hadjustment='$hatot', hgross='$hntot', pfactual='$pgtot', pfadjustment='$patot', pfgross='$pntot' WHERE caseno='$caseno'");
  }

  mysqli_query($mycon3,"INSERT INTO `kmscifees` (`pTotalHCICharges`, `pTotalHCIDiscount`, `pTotalPFCharges`, `pTotalPFDiscount`, `caseno`) VALUES ('$hgtot', '$hatot', '$pgtot', '$patot', '$caseno')");
  //---------------------------------------------------------------------------------------------------------------------------------------------------

  $nasql=mysqli_query($mycon1,"SELECT name FROM nsauth WHERE username='$username'");
  $nacount=mysqli_num_rows($nasql);
  if($nacount==0){
    $nameofuser="";
  }
  else{
    $nafetch=mysqli_fetch_array($nasql);
    $nameofuser=$nafetch['name'];
  }

  $logdate=date("Y-m-d");
  $logtime=date("H:i:s");

  mysqli_query($mycon4,"SET NAMES 'utf8'");
  mysqli_query($mycon4,"INSERT INTO `eclaimtree-temp`.`importlog` (`caseno`, `user`, `date`, `time`) VALUES ('$caseno', '$username', '$logdate', '$logtime')");

  $pPatientLastName=$lastname;
  $pPatientFirstName=$firstname;
  $pPatientMiddleName=$middlename;
  $pPatientSuffix=$suffix;

  if($pPatientMiddleName==""){$pPatientMiddleName="";}
  else{$pPatientMiddleName=" ".$pPatientMiddleName;}

  if($pPatientSuffix==""){$pPatientSuffix="";}
  else{$pPatientSuffix=" ".$pPatientSuffix;}

  $pn=$pPatientLastName.", ".$pPatientFirstName.$pPatientSuffix.$pPatientMiddleName;

  $adt=$dateadmit." ".$gettimead;

  mysqli_query($mycon4,"INSERT INTO `eclaimtree-temp`.`statusinfo` (`caseno`, `pStatus`, `pn`, `ln`, `cln`, `ad`, `at`, `dd`, `dt`, `cr1`, `cr2`, `dept`) VALUES ('$caseno', '', '".$pn."', '".$pPatientLastName."', '1', '".date("Y-m-d",strtotime($adt))."', '".date("H:i:s",strtotime($adt))."', '".date("Y-m-d",strtotime($datedischargedrel))."', '".date("H:i:s",strtotime($datetimedis))."', '$cr1', '$cr2', '0')");

  //pHospitalTransmittalNo Generator-------------------------------------------------------------------------------------------------------------------
  $hcode="KMS-".date("YmdHi");

  mysqli_query($mycon4,"DELETE FROM `hcode` WHERE `caseno`='$caseno'");

  mysqli_query($mycon4,"INSERT INTO `hcode` (`caseno`, `pHospitalTransmittalNo`) VALUES ('$caseno', '$hcode')");
  //End pHospitalTransmittalNo Generator---------------------------------------------------------------------------------------------------------------

  //pemisc
  $pemiscsql=mysqli_query($mycon2,"SELECT * FROM `pemisc` WHERE `caseno`='$caseno'");
  while($pemiscfetch=mysqli_fetch_array($pemiscsql)){
    $pSkinId=$pemiscfetch['pSkinId'];
    $pHeentId=$pemiscfetch['pHeentId'];
    $pChestId=$pemiscfetch['pChestId'];
    $pHeartId=$pemiscfetch['pHeartId'];
    $pAbdomenId=$pemiscfetch['pAbdomenId'];
    $pNeuroId=$pemiscfetch['pNeuroId'];
    $pRectalId=$pemiscfetch['pRectalId'];
    $pGuId=$pemiscfetch['pGuId'];

    mysqli_query($mycon5,"INSERT INTO `pemisc` (`caseno`, `pSkinId`, `pHeentId`, `pChestId`, `pHeartId`, `pAbdomenId`, `pNeuroId`, `pRectalId`, `pGuId`, `pReportStatus`) VALUES('$caseno', '$pSkinId', '$pHeentId', '$pChestId', '$pHeartId', '$pAbdomenId', '$pNeuroId', '$pRectalId', '$pGuId', 'U')");
  }

  //courseward
  $coursesql=mysqli_query($mycon2,"SELECT * FROM `courseward` WHERE `caseno`='$caseno'");
  while($coursefetch=mysqli_fetch_array($coursesql)){
    $pHciCaseNo=$coursefetch['pHciCaseNo'];
    $pHciTransNo=$coursefetch['pHciTransNo'];
    $pDateAction=$coursefetch['pDateAction'];
    $pDoctorsAction=$coursefetch['pDoctorsAction'];

    $pDoctorsAction=str_replace("`","",$pDoctorsAction);
    $pDoctorsAction=str_replace("%","PERCENT",$pDoctorsAction);
    $pDoctorsAction=str_replace("<","LESS THAN",$pDoctorsAction);
    $pDoctorsAction=str_replace(">","MORE THAN",$pDoctorsAction);
    $pDoctorsAction=str_replace("&","AND",$pDoctorsAction);
    $pDoctorsAction=str_replace(":","",$pDoctorsAction);
    $pDoctorsAction=str_replace("  "," ",$pDoctorsAction);
    $pDoctorsAction=str_replace("  "," ",$pDoctorsAction);
    $pDoctorsAction=trim($pDoctorsAction);

    mysqli_query($mycon5,"INSERT INTO `courseward` (`caseno`, `pHciCaseNo`, `pHciTransNo`, `pDateAction`, `pDoctorsAction`, `pReportStatus`) VALUES('$caseno', '$pHciCaseNo', '$pHciTransNo', '$pDateAction', '$pDoctorsAction', 'U')");
  }

  //admissionaddinfo
  $xcsql=mysqli_query($mycon1,"SELECT `chiefcomplaint`, `historyofpresentillness`, `pastmedicalhistory` FROM `admissionaddinfo` WHERE `caseno`='$caseno'");
  $xccount=mysqli_num_rows($xcsql);
  if($xccount=='0'){
    $cc="";
    $hopi="";
    $pmh="";
  }
  else{
    $xcfetch=mysqli_fetch_array($xcsql);
    $cc=$xcfetch['chiefcomplaint'];
    $hopi=$xcfetch['historyofpresentillness'];
    $pmh=$xcfetch['pastmedicalhistory'];

    $cc=str_replace("`","",$cc);
    $cc=str_replace("%","PERCENT",$cc);
    $cc=str_replace("&","AND",$cc);
    $cc=str_replace("<","LESS THAN",$cc);
    $cc=str_replace(">","MORE THAN",$cc);
    $cc=str_replace(":","",$cc);
    $cc=str_replace("  "," ",$cc);
    $cc=str_replace("  "," ",$cc);
    $cc=trim($cc);

    $hopi=str_replace("`","",$hopi);
    $hopi=str_replace("%","PERCENT",$hopi);
    $hopi=str_replace("&","AND",$hopi);
    $hopi=str_replace("<","LESS THAN",$hopi);
    $hopi=str_replace(">","MORE THAN",$hopi);
    $hopi=str_replace(":","",$hopi);
    $hopi=str_replace("  "," ",$hopi);
    $hopi=str_replace("  "," ",$hopi);
    $hopi=trim($hopi);

    $pmh=str_replace("`","",$pmh);
    $pmh=str_replace("%","PERCENT",$pmh);
    $pmh=str_replace("&","AND",$pmh);
    $pmh=str_replace("<","LESS THAN",$pmh);
    $pmh=str_replace(">","MORE THAN",$pmh);
    $pmh=str_replace(":","",$pmh);
    $pmh=str_replace("  "," ",$pmh);
    $pmh=str_replace("  "," ",$pmh);
    $pmh=trim($pmh);
  }

  //subjective
  $subjectivesql=mysqli_query($mycon2,"SELECT * FROM `subjective` WHERE `caseno`='$caseno'");
  while($subjectivefetch=mysqli_fetch_array($subjectivesql)){
    $pChiefComplaint=$subjectivefetch['pChiefComplaint'];
    $pIllnessHistory=$subjectivefetch['pIllnessHistory'];
    $pOtherComplaint=$subjectivefetch['pOtherComplaint'];
    $pSignsSymptoms=$subjectivefetch['pSignsSymptoms'];
    $pPainSite=$subjectivefetch['pPainSite'];
    $pReportStatus=$subjectivefetch['pReportStatus'];

    $pChiefComplaint=str_replace("`","",$pChiefComplaint);
    $pChiefComplaint=str_replace("%","PERCENT",$pChiefComplaint);
    $pChiefComplaint=str_replace("&","AND",$pChiefComplaint);
    $pChiefComplaint=str_replace("<","LESS THAN",$pChiefComplaint);
    $pChiefComplaint=str_replace(">","MORE THAN",$pChiefComplaint);
    $pChiefComplaint=str_replace(":","",$pChiefComplaint);
    $pChiefComplaint=str_replace("  "," ",$pChiefComplaint);
    $pChiefComplaint=str_replace("  "," ",$pChiefComplaint);
    $pChiefComplaint=trim($pChiefComplaint);

    if($pChiefComplaint==""){$pcc=$cc;}else{$pcc=$pChiefComplaint;}

    $pIllnessHistory=str_replace("`","",$pIllnessHistory);
    $pIllnessHistory=str_replace("%","PERCENT",$pIllnessHistory);
    $pIllnessHistory=str_replace("&","AND",$pIllnessHistory);
    $pIllnessHistory=str_replace("<","LESS THAN",$pIllnessHistory);
    $pIllnessHistory=str_replace(">","MORE THAN",$pIllnessHistory);
    $pIllnessHistory=str_replace(":","",$pIllnessHistory);
    $pIllnessHistory=str_replace("  "," ",$pIllnessHistory);
    $pIllnessHistory=str_replace("  "," ",$pIllnessHistory);
    $pIllnessHistory=trim($pIllnessHistory);

    if($pIllnessHistory==""){$pih=$hopi;}else{$pih=$pIllnessHistory;}

    mysqli_query($mycon5,"INSERT INTO `subjective` (`caseno`, `pChiefComplaint`, `pIllnessHistory`, `pOtherComplaint`, `pSignsSymptoms`, `pPainSite`, `pReportStatus`) VALUES('$caseno', '$pcc', '$pih', '$pOtherComplaint', '$pSignsSymptoms', '$pPainSite', '$pReportStatus')");
  }

  //pespecific
  $pespecificsql=mysqli_query($mycon2,"SELECT * FROM `pespecific` WHERE `caseno`='$caseno'");
  while($pespecificfetch=mysqli_fetch_array($pespecificsql)){
    $pSkinRem=trim(mb_strtoupper($pespecificfetch['pSkinRem']));
    $pHeentRem=trim(mb_strtoupper($pespecificfetch['pHeentRem']));
    $pChestRem=trim(mb_strtoupper($pespecificfetch['pChestRem']));
    $pHeartRem=trim(mb_strtoupper($pespecificfetch['pHeartRem']));
    $pAbdomenRem=trim(mb_strtoupper($pespecificfetch['pAbdomenRem']));
    $pNeuroRem=trim(mb_strtoupper($pespecificfetch['pNeuroRem']));
    $pRectalRem=trim(mb_strtoupper($pespecificfetch['pRectalRem']));
    $pGuRem=trim(mb_strtoupper($pespecificfetch['pGuRem']));

    mysqli_query($mycon5,"INSERT INTO `pespecific` (`caseno`, `pSkinRem`, `pHeentRem`, `pChestRem`, `pHeartRem`, `pAbdomenRem`, `pNeuroRem`, `pRectalRem`, `pGuRem`, `pReportStatus`) VALUES('$caseno', '$pSkinRem', '$pHeentRem', '$pChestRem', '$pHeartRem', '$pAbdomenRem', '$pNeuroRem', '$pRectalRem', '$pGuRem', 'U')");
  }

  //pepert
  $pepertsql=mysqli_query($mycon2,"SELECT * FROM `pepert` WHERE `caseno`='$caseno'");
  while($pepertfetch=mysqli_fetch_array($pepertsql)){
    $pSystolic=trim($pepertfetch['pSystolic']);
    $pDiastolic=trim($pepertfetch['pDiastolic']);
    $pHr=trim($pepertfetch['pHr']);
    $pRr=trim($pepertfetch['pRr']);
    $pTemp=trim($pepertfetch['pTemp']);
    $pHeight=trim($pepertfetch['pHeight']);
    $pWeight=trim($pepertfetch['pWeight']);
    $pVision=trim($pepertfetch['pVision']);
    $pLength=trim($pepertfetch['pLength']);
    $pHeadCirc=trim($pepertfetch['pHeadCirc']);

    mysqli_query($mycon5,"INSERT INTO `pepert` (`caseno`, `pSystolic`, `pDiastolic`, `pHr`, `pRr`, `pTemp`, `pHeight`, `pWeight`, `pVision`, `pLength`, `pHeadCirc`, `pReportStatus`) VALUES('$caseno', '$pSystolic', '$pDiastolic', '$pHr', '$pRr', '$pTemp', '$pHeight', '$pWeight', '$pVision', '$pLength', '$pHeadCirc', 'U')");
  }

  //pegensurvey
  $pegensurveysql=mysqli_query($mycon2,"SELECT * FROM `pegensurvey` WHERE `caseno`='$caseno'");
  while($pegensurveyfetch=mysqli_fetch_array($pegensurveysql)){
    $pGensurveyId=$pegensurveyfetch['pGenSurveyId'];
    $pGensurveyRem=trim($pegensurveyfetch['pGenSurveyRem']);

    mysqli_query($mycon5,"INSERT INTO `pegensurvey` (`caseno`, `pGenSurveyId`, `pGenSurveyRem`, `pReportStatus`) VALUES('$caseno', '$pGensurveyId', '$pGensurveyRem', 'U')");
  }

  //mhspecific
  $mhspecificsql=mysqli_query($mycon2,"SELECT * FROM `mhspecific` WHERE `caseno`='$caseno'");
  $mhspecificcount=mysqli_num_rows($mhspecificsql);
  if($mhspecificcount==0){
    $pMdiseaseCode="";
    $pSpecificDesc="";
  }
  else{
    while($mhspecificfetch=mysqli_fetch_array($mhspecificsql)){
      $pMdiseaseCode=$mhspecificfetch['pMdiseaseCode'];
      $pSpecificDesc=$mhspecificfetch['pSpecificDesc'];

      $pSpecificDesc=str_replace("`","",$pSpecificDesc);
      $pSpecificDesc=str_replace("%","PERCENT",$pSpecificDesc);
      $pSpecificDesc=str_replace("&","AND",$pSpecificDesc);
      $pSpecificDesc=str_replace("<","LESS THAN",$pSpecificDesc);
      $pSpecificDesc=str_replace(">","MORE THAN",$pSpecificDesc);
      $pSpecificDesc=str_replace(":","",$pSpecificDesc);
      $pSpecificDesc=str_replace("  "," ",$pSpecificDesc);
      $pSpecificDesc=str_replace("  "," ",$pSpecificDesc);
      $pSpecificDesc=trim($pSpecificDesc);
    }
  }

  if($pSpecificDesc==""){$psd=$pmh;}else{$psd=$pSpecificDesc;}

  mysqli_query($mycon5,"INSERT INTO `mhspecific` (`caseno`, `pMdiseaseCode`, `pSpecificDesc`, `pReportStatus`) VALUES('$caseno','$pMdiseaseCode','$psd','U')");

  //menshist
  $menshistsql=mysqli_query($mycon2,"SELECT * FROM `menshist` WHERE `caseno`='$caseno'");
  while($menshistfetch=mysqli_fetch_array($menshistsql)){
    $pMenarchePeriod=$menshistfetch['pMenarchePeriod'];
    $pLastMensPeriod=$menshistfetch['pLastMensPeriod'];
    $pPeriodDuration=$menshistfetch['pPeriodDuration'];
    $pMensInterval=$menshistfetch['pMensInterval'];
    $pPadsPerDay=$menshistfetch['pPadsPerDay'];
    $pOnsetSexIc=$menshistfetch['pOnsetSexIc'];
    $pBirthCtrlMethod=$menshistfetch['pBirthCtrlMethod'];
    $pIsMenopause=$menshistfetch['pIsMenopause'];
    $pMenopauseAge=$menshistfetch['pMenopauseAge'];
    $pIsApplicable=$menshistfetch['pIsApplicable'];

    mysqli_query($mycon5,"INSERT INTO `menshist` (`caseno`, `pMenarchePeriod`, `pLastMensPeriod`, `pPeriodDuration`, `pMensInterval`, `pPadsPerDay`, `pOnsetSexIc`, `pBirthCtrlMethod`, `pIsMenopause`, `pMenopauseAge`, `pIsApplicable`, `pReportStatus`) VALUES('$caseno', '$pMenarchePeriod', '$pLastMensPeriod', '$pPeriodDuration', '$pMensInterval', '$pPadsPerDay', '$pOnsetSexIc', '$pBirthCtrlMethod', '$pIsMenopause', '$pMenopauseAge', '$pIsApplicable', 'U')");
  }

  //preghist
  $preghistsql=mysqli_query($mycon2,"SELECT * FROM `preghist` WHERE `caseno`='$caseno'");
  while($preghistfetch=mysqli_fetch_array($preghistsql)){
    $pPregCnt=$preghistfetch['pPregCnt'];
    $pDeliveryCnt=$preghistfetch['pDeliveryCnt'];
    $pDeliveryTyp=$preghistfetch['pDeliveryTyp'];
    $pFullTermCnt=$preghistfetch['pFullTermCnt'];
    $pPrematureCnt=$preghistfetch['pPrematureCnt'];
    $pAbortionCnt=$preghistfetch['pAbortionCnt'];
    $pLivChildrenCnt=$preghistfetch['pLivChildrenCnt'];
    $pWPregIndhyp=$preghistfetch['pWPregIndhyp'];
    $pWFamPlan=$preghistfetch['pWFamPlan'];

    mysqli_query($mycon5,"INSERT INTO `preghist` (`caseno`, `pPregCnt`, `pDeliveryCnt`, `pDeliveryTyp`, `pFullTermCnt`, `pPrematureCnt`, `pAbortionCnt`, `pLivChildrenCnt`, `pWPregIndhyp`, `pWFamPlan`, `pReportStatus`) VALUES('$caseno', '$pPregCnt', '$pDeliveryCnt', '$pDeliveryTyp', '$pFullTermCnt', '$pPrematureCnt', '$pAbortionCnt', '$pLivChildrenCnt', '$pWPregIndhyp', '$pWFamPlan', 'U')");
  }

  echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=AllDone.php'>";
}
else{
  echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=AlreadyEntered.php'>";
}
?>
</body>
</html>
