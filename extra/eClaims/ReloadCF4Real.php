<?php
include("../Settings.php"); include("../outcon.php"); $cuz = new database();
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

$caseno=mysqli_real_escape_string($mycon1,$_GET['caseno']);
$username=mysqli_real_escape_string($mycon1,$_GET['uname']);


$cf1sql=mysqli_query($mycon3,"SELECT * FROM `eclaimtree`.`cf1` WHERE caseno='$caseno'");
$cf1count=mysqli_num_rows($cf1sql);


$admsql=mysqli_query($mycon1,"SELECT patientidno, type, hmomembership, paymentmode, room, UPPER(street) AS street, UPPER(barangay) AS barangay, UPPER(municipality) AS municipality, UPPER(province) AS province, zipcode,UPPER(pastmed) AS pastmed, UPPER(initialdiagnosis) AS initialdiagnosis, UPPER(finaldiagnosis) AS finaldiagnosis, UPPER(ap) AS ap, timeadmitted, dateadmit FROM admission WHERE caseno='$caseno'");
$admfetch=mysqli_fetch_array($admsql);
$type=$admfetch['type'];
$patientidno=$admfetch['patientidno'];
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


$rmsql=mysqli_query($mycon1,"SELECT `roomprop` FROM `room` WHERE `room`='$room'");
$rmcount=mysqli_num_rows($rmsql);
if($rmcount==0){
  $accty="N";
}
else{
  $rmfetch=mysqli_fetch_array($rmsql);
  $rmprop=$rmfetch['roomprop'];

  if($rmprop=="PRIVATE"){$accty="P";}
  else if($rmprop=="SEMI-PRIVATE"){$accty="N";}
  else if($rmprop=="WARD"){$accty="N";}
  else{$accty="N";}
}

if($room=="OPD"){$pPatientType="O";}else{$pPatientType="I";}

$datetimead=$dateadmit." ".$timeadmitted;
$gettimead=date("h:i:sA",strtotime($datetimead));

$mailadd=$street." ".$barangay." ".$municipality." ".$province;

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



$patfsql=mysqli_query($mycon1,"SELECT UPPER(lastname) AS lastname, UPPER(firstname) AS firstname, UPPER(middlename) AS middlename, birthdate, age, UPPER(sex) AS sex, suffix FROM patientprofile WHERE patientidno='$patientidno'");
while($patffetch=mysqli_fetch_array($patfsql)){
$lastname=$patffetch['lastname'];
$firstname=$patffetch['firstname'];
$middlename=$patffetch['middlename'];
$birthdate=$patffetch['birthdate'];
$age=$patffetch['age'];
$sex=$patffetch['sex'];
$suffix=$patffetch['suffix'];
}

$birthdatespl=preg_split('/\-/', $birthdate);

$bm=$birthdatespl[0];
$bd=$birthdatespl[1];
$by=$birthdatespl[2];

if(strlen($bd)==1){$bdf="0".$bd;}else{$bdf=$bd;}

$birthdaterel=$bm."-".$bdf."-".$by;


$cfsql=mysqli_query($mycon1,"SELECT identificationno, lastname, firstname, middlename FROM claiminfo WHERE caseno='$caseno'");
$cfcount=mysqli_num_rows($cfsql);

if($cfcount==0){
$identificationno="";
$mlname="";
$mfname="";
$mmname="";
}
else{
while($cffetch=mysqli_fetch_array($cfsql)){
$identificationno=$cffetch['identificationno'];
$mlname=strtoupper($cffetch['lastname']);
$mfname=strtoupper($cffetch['firstname']);
$mmname=strtoupper($cffetch['middlename']);
}
}

$cimisql=mysqli_query($mycon1,"SELECT * FROM claiminfomoreinfo WHERE caseno='$caseno'");
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
while($cimifetch=mysqli_fetch_array($cimisql)){
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
}

$empbusinessname=str_replace("'","",$empbusinessname);
$empbusinessname=str_replace("&","AND",$empbusinessname);

$emppenfmt=str_replace("-","",$emppen);

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



$cfasql=mysqli_query($mycon1,"SELECT hciyes, hcino, disposition, expireddays, timeexpired, transferto, transferadd, reasons, private, nonprivate, doctor1, datesigned1, copay1, doctor2, datesigned2, copay2, doctor3, datesigned3, copay3 FROM claiminfoadd WHERE caseno='$caseno'");
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
while($cfafetch=mysqli_fetch_array($cfasql)){
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
}

$expdt=$expireddays." ".$timeexpired;

if(($hciyes=="checked")&&($hcino=="")){$pPatientReferred="Y";$pReferredIHCPAccreCode="";}else if(($hciyes=="")&&($hcino=="checked")){$pPatientReferred="N";$pReferredIHCPAccreCode="";}else{$pPatientReferred="N";$pReferredIHCPAccreCode="";}

if($disposition=="E"){$pExpiredDate=date("m-d-Y",strtotime($expireddays));$pExpiredTime=date("h:i:sA",strtotime($expdt));}else{$pExpiredDate="";$pExpiredTime="";}

if($disposition=="T"){$pReferralIHCPAccreCode="";$pReferralReasons=$reasons;}else{$pReferralIHCPAccreCode="";$pReferralReasons="";}


$dtsql=mysqli_query($mycon1,"SELECT datedischarged, timedischarged FROM dischargedtable WHERE caseno='$caseno'");
$dtcount=mysqli_num_rows($dtsql);
if($dtcount==0){
$datedischarged="__";
$timedischarged="";
}
else{
while($dtfetch=mysqli_fetch_array($dtsql)){
$datedischarged=$dtfetch['datedischarged'];
$timedischarged=$dtfetch['timedischarged'];
}
}

$datedischarged=str_replace("_","-",$datedischarged);

$ddis=preg_split('/\-/',$datedischarged);
$ddism=$ddis[0];
$ddisd=$ddis[1];
$ddisy=$ddis[2];

$datedischargedrel=$ddism."-".$ddisd."-".$ddisy;

$datetimedis=$datedischargedrel." ".$timedischarged;
$gettimedis=date("h:i:sA",strtotime($datetimedis));




//Patient Account Summary----------------------------------------------------------------------------------------------------------------------------

//pRectalI-------------------
if (file_exists('/opt/lampp/htdocs/2022codes/eClaims/Charges/'.$caseno.'-ai.txt')) {unlink('/opt/lampp/htdocs/2022codes/eClaims/Charges/'.$caseno.'-ai.txt');}
mysqli_query($mycon1,"SELECT * FROM productoutaddinfo WHERE caseno='$caseno' INTO OUTFILE '/opt/lampp/htdocs/2022codes/eClaims/Charges207/$caseno-ai.txt' FIELDS TERMINATED BY '|'");
mysqli_query($mycon6,"LOAD DATA LOCAL INFILE '/opt/lampp/htdocs/2022codes/eClaims/Charges/$caseno-ai.txt' INTO TABLE productoutaddinfo FIELDS TERMINATED BY '|' LINES TERMINATED BY '\n'");
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
  //else if(($aeptype=="LABORATORY")||($aeptype=="XRAY")||($aeptype=="MAMMOGRAPHY")||($aeptype=="ULTRASOUND")||($aeptype=="EEG")||($aeptype=="ECG")||($aeptype=="CT SCAN")||($aeptype=="HEARTSTATION")){
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


$nasql=mysqli_query($mycon1,"SELECT name FROM nsauth WHERE username='$username'");
$nacount=mysqli_num_rows($nasql);
if($nacount==0){
$nameofuser="";
}
else{
while($nafetch=mysqli_fetch_array($nasql)){$nameofuser=$nafetch['name'];}
}

$logdate=date("Y-m-d");
$logtime=date("H:i:s");


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

  //mysqli_query($mycon5,"INSERT INTO `subjective` (`caseno`, `pChiefComplaint`, `pIllnessHistory`, `pOtherComplaint`, `pSignsSymptoms`, `pPainSite`, `pReportStatus`) VALUES('$caseno', '$pChiefComplaint', '$pIllnessHistory', '$pOtherComplaint', '$pSignsSymptoms', '$pPainSite', '$pReportStatus')");
}

//pespecific
$pespecificsql=mysqli_query($mycon2,"SELECT * FROM `pespecific` WHERE `caseno`='$caseno'");
while($pespecificfetch=mysqli_fetch_array($pespecificsql)){
$pSkinRem=$pespecificfetch['pSkinRem'];
$pHeentRem=$pespecificfetch['pHeentRem'];
$pChestRem=$pespecificfetch['pChestRem'];
$pHeartRem=$pespecificfetch['pHeartRem'];
$pAbdomenRem=$pespecificfetch['pAbdomenRem'];
$pNeuroRem=$pespecificfetch['pNeuroRem'];
$pRectalRem=$pespecificfetch['pRectalRem'];
$pGuRem=$pespecificfetch['pGuRem'];

  mysqli_query($mycon5,"INSERT INTO `pespecific` (`caseno`, `pSkinRem`, `pHeentRem`, `pChestRem`, `pHeartRem`, `pAbdomenRem`, `pNeuroRem`, `pRectalRem`, `pGuRem`, `pReportStatus`) VALUES('$caseno', '$pSkinRem', '$pHeentRem', '$pChestRem', '$pHeartRem', '$pAbdomenRem', '$pNeuroRem', '$pRectalRem', '$pGuRem', 'U')");
}

//pepert
$pepertsql=mysqli_query($mycon2,"SELECT * FROM `pepert` WHERE `caseno`='$caseno'");
while($pepertfetch=mysqli_fetch_array($pepertsql)){
$pSystolic=$pepertfetch['pSystolic'];
$pDiastolic=$pepertfetch['pDiastolic'];
$pHr=$pepertfetch['pHr'];
$pRr=$pepertfetch['pRr'];
$pTemp=$pepertfetch['pTemp'];
$pHeight=$pepertfetch['pHeight'];
$pWeight=$pepertfetch['pWeight'];
$pVision=$pepertfetch['pVision'];
$pLength=$pepertfetch['pLength'];
$pHeadCirc=$pepertfetch['pHeadCirc'];

  mysqli_query($mycon5,"INSERT INTO `pepert` (`caseno`, `pSystolic`, `pDiastolic`, `pHr`, `pRr`, `pTemp`, `pHeight`, `pWeight`, `pVision`, `pLength`, `pHeadCirc`, `pReportStatus`) VALUES('$caseno', '$pSystolic', '$pDiastolic', '$pHr', '$pRr', '$pTemp', '$pHeight', '$pWeight', '$pVision', '$pLength', '$pHeadCirc', 'U')");
}

//pegensurvey
$pegensurveysql=mysqli_query($mycon2,"SELECT * FROM `pegensurvey` WHERE `caseno`='$caseno'");
while($pegensurveyfetch=mysqli_fetch_array($pegensurveysql)){
$pGensurveyId=$pegensurveyfetch['pGenSurveyId'];
$pGensurveyRem=$pegensurveyfetch['pGenSurveyRem'];

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

//medicine
$medicinesql=mysqli_query($mycon2,"SELECT * FROM `medicine` WHERE `caseno`='$caseno'");
while($medicinefetch=mysqli_fetch_array($medicinesql)){
$pHciCaseNo=$medicinefetch['pHciCaseNo'];
$pHciTransNo=$medicinefetch['pHciTransNo'];
$pDrugCode=$medicinefetch['pDrugCode'];
$pGenericName=$medicinefetch['pGenericName'];
$pGenericCode=$medicinefetch['pGenericCode'];
$pSaltCode=$medicinefetch['pSaltCode'];
$pStrengthCode=$medicinefetch['pStrengthCode'];
$pFormCode=$medicinefetch['pFormCode'];
$pUnitCode=$medicinefetch['pUnitCode'];
$pPackageCode=$medicinefetch['pPackageCode'];
$pRoute=$medicinefetch['pRoute'];
$pQuantity=$medicinefetch['pQuantity'];
$pActualUnitPrice=$medicinefetch['pActualUnitPrice'];
$pCoPayment=$medicinefetch['pCoPayment'];
$pTotalAmtPrice=$medicinefetch['pTotalAmtPrice'];
$pInstructionQuantity=$medicinefetch['pInstructionQuantity'];
$pInstructionStrength=$medicinefetch['pInstructionStrength'];
$pInstructionFrequency=$medicinefetch['pInstructionFrequency'];
$pPrescPhysician=$medicinefetch['pPrescPhysician'];
$pIsApplicable=$medicinefetch['pIsApplicable'];
$pDateAdded=$medicinefetch['pDateAdded'];
$pModule=$medicinefetch['pModule'];
$pReportStatus=$medicinefetch['pReportStatus'];
$pDeficiencyRemarks=$medicinefetch['pDeficiencyRemarks'];

  mysqli_query($mycon5,"INSERT INTO `medicine`(`pHciCaseNo`, `pHciTransNo`, `pDrugCode`, `pGenericName`, `pGenericCode`, `pSaltCode`, `pStrengthCode`, `pFormCode`, `pUnitCode`, `pPackageCode`, `pRoute`, `pQuantity`, `pActualUnitPrice`, `pCoPayment`, `pTotalAmtPrice`, `pInstructionQuantity`, `pInstructionStrength`, `pInstructionFrequency`, `pPrescPhysician`, `pIsApplicable`, `pDateAdded`, `pModule`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('$pHciCaseNo', '$pHciTransNo', '$pDrugCode', '$pGenericName', '$pGenericCode', '$pSaltCode', '$pStrengthCode', '$pFormCode', '$pUnitCode', '$pPackageCode', '$pRoute', '$pQuantity', '$pActualUnitPrice', '$pCoPayment', '$pTotalAmtPrice', '$pInstructionQuantity', '$pInstructionStrength', '$pInstructionFrequency', '$pPrescPhysician', '$pIsApplicable', '$pDateAdded', '$pModule', '$pReportStatus', '$pDeficiencyRemarks', '$caseno')");
}

echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=AllDone.php'>";


?>
</body>
</html>
