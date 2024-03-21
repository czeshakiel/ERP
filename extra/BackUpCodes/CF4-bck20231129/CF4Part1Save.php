<?php
$txtPerTransmittalNo=mysqli_real_escape_string($conncf4,$_POST['txtPerTransmittalNo']);
$txtPerClaimId=mysqli_real_escape_string($conncf4,$_POST['txtPerClaimId']);
$txtPerPatPIN=mysqli_real_escape_string($conncf4,$_POST['txtPerPatPIN']);
$txtPerPatLname=mb_strtoupper(mysqli_real_escape_string($conncf4,$_POST['txtPerPatLname']));
$txtPerPatFname=mb_strtoupper(mysqli_real_escape_string($conncf4,$_POST['txtPerPatFname']));
$txtPerPatMname=mb_strtoupper(mysqli_real_escape_string($conncf4,$_POST['txtPerPatMname']));
$txtPerPatExtName=mb_strtoupper(mysqli_real_escape_string($conncf4,$_POST['txtPerPatExtName']));
$txtPerPatBirthdayM=mysqli_real_escape_string($conncf4,$_POST['txtPerPatBirthdayM']);
$txtPerPatBirthdayD=mysqli_real_escape_string($conncf4,$_POST['txtPerPatBirthdayD']);
$txtPerPatBirthdayY=mysqli_real_escape_string($conncf4,$_POST['txtPerPatBirthdayY']);
$txtPerPatSex=mysqli_real_escape_string($conncf4,$_POST['txtPerPatSex']);
$txtPerPatStatus=mysqli_real_escape_string($conncf4,$_POST['txtPerPatStatus']);
$txtPerPatType=mysqli_real_escape_string($conncf4,$_POST['txtPerPatType']);

$pChiefComplaint=mb_strtoupper(mysqli_real_escape_string($conncf4,$_POST['pChiefComplaint']));
$pHistPresentIllness=mb_strtoupper(mysqli_real_escape_string($conncf4,$_POST['pHistPresentIllness']));
$txaMedHistOthers=mb_strtoupper(mysqli_real_escape_string($conncf4,$_POST['xaMedHistOthers']));

$pChiefComplaint=str_replace("`","",$pChiefComplaint);
$pChiefComplaint=str_replace("<","LESS THAN",$pChiefComplaint);
$pChiefComplaint=str_replace(">","MORE THAN",$pChiefComplaint);
$pChiefComplaint=str_replace(":","",$pChiefComplaint);
$pChiefComplaint=str_replace("+","POSITIVE",$pChiefComplaint);
$pChiefComplaint=str_replace("  "," ",$pChiefComplaint);
$pChiefComplaint=str_replace("  "," ",$pChiefComplaint);
$pChiefComplaint=trim($pChiefComplaint);

$pHistPresentIllness=str_replace("`","",$pHistPresentIllness);
$pHistPresentIllness=str_replace("<","LESS THAN",$pHistPresentIllness);
$pHistPresentIllness=str_replace(">","MORE THAN",$pHistPresentIllness);
$pHistPresentIllness=str_replace(":","",$pHistPresentIllness);
$pHistPresentIllness=str_replace("+","POSITIVE",$pHistPresentIllness);
$pHistPresentIllness=str_replace("  "," ",$pHistPresentIllness);
$pHistPresentIllness=str_replace("  "," ",$pHistPresentIllness);
$pHistPresentIllness=trim($pHistPresentIllness);

$txaMedHistOthers=str_replace("`","",$txaMedHistOthers);
$txaMedHistOthers=str_replace("<","LESS THAN",$txaMedHistOthers);
$txaMedHistOthers=str_replace(">","MORE THAN",$txaMedHistOthers);
$txaMedHistOthers=str_replace(":","",$txaMedHistOthers);
$txaMedHistOthers=str_replace("+","POSITIVE",$txaMedHistOthers);
$txaMedHistOthers=str_replace("  "," ",$txaMedHistOthers);
$txaMedHistOthers=str_replace("  "," ",$txaMedHistOthers);
$txaMedHistOthers=trim($txaMedHistOthers);

$txtPerPatBirthday=$txtPerPatBirthdayY."-".$txtPerPatBirthdayM."-".$txtPerPatBirthdayD;
if($txtPerPatBirthday=="--"){$txtPerPatBirthday="";}

$mhDone=$_POST['mhDone'];
//$txtOBHistLastMensM=mysql_real_escape_string($_POST['txtOBHistLastMensM']);
//$txtOBHistLastMensD=mysql_real_escape_string($_POST['txtOBHistLastMensD']);
//$txtOBHistLastMensY=mysql_real_escape_string($_POST['txtOBHistLastMensY']);

//$txtOBHistLastMens=$txtOBHistLastMensY."-".$txtOBHistLastMensM."-".$txtOBHistLastMensD;

$txtOBHistLastMens=mysqli_real_escape_string($conncf4,$_POST['txtOBHistLastMens']);
if($txtOBHistLastMens=="--"){$txtOBHistLastMens="";}

if($mhDone=="Y"){
  $txtOBHistLastMens=$txtOBHistLastMens;

  $txtOBHistGravity=mysqli_real_escape_string($conncf4,$_POST['txtOBHistGravity']);
  $txtOBHistParity=mysqli_real_escape_string($conncf4,$_POST['txtOBHistParity']);
  $txtOBHistFullTerm=mysqli_real_escape_string($conncf4,$_POST['txtOBHistFullTerm']);
  $txtOBHistPremature=mysqli_real_escape_string($conncf4,$_POST['txtOBHistPremature']);
  $txtOBHistAbortion=mysqli_real_escape_string($conncf4,$_POST['txtOBHistAbortion']);
  $txtOBHistLivingChildren=mysqli_real_escape_string($conncf4,$_POST['txtOBHistLivingChildren']);
}
else{
  $txtOBHistLastMens="";

  $txtOBHistGravity="";
  $txtOBHistParity="";
  $txtOBHistFullTerm="";
  $txtOBHistPremature="";
  $txtOBHistAbortion="";
  $txtOBHistLivingChildren="";
}


$adcf4=$dateadmitted;

$pdate=date("Y-m-d");
$pyear=date("Y");

$outconnkmsci=mysqli_connect('192.168.0.200', 'kmsciec', 'levelwithme', 'kmsci');
if(!$outconnkmsci){echo"<script>alert('Unable to connect eClaims KMSCI DB');</script>";}

$outconnmiscset=mysqli_connect('192.168.0.200', 'kmsciec', 'levelwithme', 'miscset');
if(!$outconnmiscset){echo"<script>alert('Unable to connect eClaims KMSCI DB');</script>";}

$hcsql=mysqli_query($outconnmiscset,"SELECT * FROM `hcode` WHERE `no`='1'");
$hcfetch=mysqli_fetch_array($hcsql);
$hc=$hcfetch['hcode'];
$pmcc=$hcfetch['pmcc'];

$hcode=$hc;
//$pmcc="932336";
if($adcf4==""){
echo "
  <span class='arial14redbold'>Error!!! Admission date is not set!&quot;.</span>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='4;URL=?cf4p1&caseno=$caseno'>";
}
else{
  if(($mhDone=="Y")&&(($txtOBHistLastMens=="0000-00-00")||($txtOBHistLastMens==""))){
echo "
  <span class='arial14redbold'>Error!!! Wrong date format in &quot;Last menstrual period&quot;.</span>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='4;URL=?cf4p1&caseno=$caseno'>";
  }
  else{
    if(($mhDone=="Y")&&(($txtOBHistGravity=="")||($txtOBHistParity=="")||($txtOBHistFullTerm=="")||($txtOBHistPremature=="")||($txtOBHistAbortion=="")||($txtOBHistLivingChildren==""))){
echo "
  <span class='arial14redbold'>Error!!! Pregnancy History must be filled up properly.</span>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='4;URL=?cf4p1&caseno=$caseno'>";
    }
    else{
      $count=0;
      $prompt="";
      $pym=date("Ym");
      $epcbdsql=mysqli_query($outconnkmsci,"SELECT `epcbdate` FROM `myCounter` WHERE `counterno`='1'");
      while($epcbdfetch=mysqli_fetch_array($epcbdsql)){
        $epcbdate=$epcbdfetch['epcbdate'];
      }

      if($epcbdate!=$pym){
        mysqli_query($outconnkmsci,"UPDATE `myCounter` SET `epcbdate`='$pym', `epcbcount`='0' WHERE `counterno`='1'");
      }

      $epcbcsql=mysqli_query($outconnkmsci,"SELECT `epcbcount` FROM `myCounter` WHERE `counterno`='1'");
      while($epcbcfetch=mysqli_fetch_array($epcbcsql)){
        $epcbcount=$epcbcfetch['epcbcount'];
      }

      if($epcbcount<10){$pHciTransmittalNumber="R".$pmcc.$pym."000".$epcbcount;$pHciCaseNo="T".$pmcc.$pym."000".$epcbcount;$pHciTransNo="T".$pmcc.$pym."000".$epcbcount;}
      else if(($epcbcount>9)&&($epcbcount<100)){$pHciTransmittalNumber="R".$pmcc.$pym."00".$epcbcount;$pHciCaseNo="T".$pmcc.$pym."00".$epcbcount;$pHciTransNo="T".$pmcc.$pym."00".$epcbcount;}
      else if(($epcbcount>99)&&($epcbcount<1000)){$pHciTransmittalNumber="R".$pmcc.$pym."0".$epcbcount;$pHciCaseNo="T".$pmcc.$pym."0".$epcbcount;$pHciTransNo="T".$pmcc.$pym."0".$epcbcount;}
      else if(($epcbcount>999)&&($epcbcount<10000)){$pHciTransmittalNumber="R".$pmcc.$pym.$epcbcount;$pHciCaseNo="T".$pmcc.$pym.$epcbcount;$pHciTransNo="T".$pmcc.$pym.$epcbcount;}
      else{$pHciTransmittalNumber="R".$pmcc.$pym.$epcbcount;$pHciCaseNo="T".$pmcc.$pym.$epcbcount;$pHciTransNo="T".$pmcc.$pym.$epcbcount;}

      $uname=strtoupper(base64_decode($sun));

      /*<EPCB>*/

      $epcbsql=mysqli_query($conncf4,"SELECT * FROM `epcb` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($epcbsql)==0){
        //echo "INSERT INTO `epcb` (`pUsername`, `pPassword`, `pHciAccreNo`, `pEnlistTotalCnt`, `pProfileTotalCnt`, `pSoapTotalCnt`, `pEmrId`, `pCertificationId`, `pHciTransmittalNumber`, `caseno`) VALUES (':ECLAIMS-03-07-2018-00002', '', '$hcode', '', '', '', '', 'ECLAIMS-03-07-2018-00002', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `epcb` (`pUsername`, `pPassword`, `pHciAccreNo`, `pEnlistTotalCnt`, `pProfileTotalCnt`, `pSoapTotalCnt`, `pEmrId`, `pCertificationId`, `pHciTransmittalNumber`, `caseno`) VALUES (':ECLAIMS-03-07-2018-00002', '', '$hcode', '', '', '', '', 'ECLAIMS-03-07-2018-00002', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. epcb Inserted<br />";
      }
      else{
        //echo "UPDATE `epcb` SET `pUsername`=':ECLAIMS-17-06-2021-00001', `pPassword`='', `pHciAccreNo`='$hcode', `pEnlistTotalCnt`='', `pProfileTotalCnt`='', `pSoapTotalCnt`='', `pEmrId`='', `pCertificationId`='ECLAIMS-17-06-2021-00001', `pHciTransmittalNumber`='' WHERE `caseno`='$caseno'<br />";
        mysqli_query($conncf4,"UPDATE `epcb` SET `pUsername`=':ECLAIMS-17-06-2021-00001', `pPassword`='', `pHciAccreNo`='$hcode', `pEnlistTotalCnt`='', `pProfileTotalCnt`='', `pSoapTotalCnt`='', `pEmrId`='', `pCertificationId`='ECLAIMS-17-06-2021-00001', `pHciTransmittalNumber`='' WHERE `caseno`='$caseno'");

        $count+=1;
        $prompt=$prompt."$count. epcb Updated<br />";
      }


      /*<ENLISTMENTS>*/

      mysqli_query($conncf4,"SET NAMES 'utf8'");
      $enfsql=mysqli_query($conncf4,"SELECT * FROM `enlistment` WHERE `caseno`='$caseno'");
      $enfcount=mysqli_num_rows($enfsql);
      if($enfcount==0){
        //echo "INSERT INTO `enlistment` (`pEClaimId`, `pEClaimsTransmittalId`, `pHciCaseNo`, `pHciTransNo`, `pEffYear`, `pEnlistStat`, `pEnlistDate`, `pPackageType`, `pMemPin`, `pMemFname`, `pMemMname`, `pMemLname`, `pMemExtname`, `pMemDob`, `pMemCat`, `pMemNcat`, `pPatientPin`, `pPatientFname`, `pPatientMname`, `pPatientLname`, `pPatientExtname`, `pPatientType`, `pPatientSex`, `pPatientContactno`, `pPatientDob`, `pPatientAddbrgy`, `pPatientAddmun`, `pPatientAddprov`, `pPatientAddreg`, `pPatientAddzipcode`, `pCivilStatus`, `pWithConsent`, `pWithLoa`, `pWithDisability`, `pDependentType`, `pTransDate`, `pCreatedBy`, `pReportStatus`, `pDeficiencyRemarks`, `pAvailFreeService`, `caseno`) VALUES ('$txtPerClaimId', '$txtPerTransmittalNo', '$pHciCaseNo', '$pHciTransNo', '$pyear', '1', '$pdate', 'A', '', '', '', '', '', '', '', '', '$txtPerPatPIN', '".$txtPerPatFname."', '".$txtPerPatMname."', '".$txtPerPatLname."', '$txtPerPatExtName', '$txtPerPatType', '$txtPerPatSex', 'NA', '$txtPerPatBirthday', '', '', '', '', '', 'U', 'X', 'X', 'X', 'X', '$pdate', '$uname', 'U', '', 'X', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `enlistment` (`pEClaimId`, `pEClaimsTransmittalId`, `pHciCaseNo`, `pHciTransNo`, `pEffYear`, `pEnlistStat`, `pEnlistDate`, `pPackageType`, `pMemPin`, `pMemFname`, `pMemMname`, `pMemLname`, `pMemExtname`, `pMemDob`, `pMemCat`, `pMemNcat`, `pPatientPin`, `pPatientFname`, `pPatientMname`, `pPatientLname`, `pPatientExtname`, `pPatientType`, `pPatientSex`, `pPatientContactno`, `pPatientDob`, `pPatientAddbrgy`, `pPatientAddmun`, `pPatientAddprov`, `pPatientAddreg`, `pPatientAddzipcode`, `pCivilStatus`, `pWithConsent`, `pWithLoa`, `pWithDisability`, `pDependentType`, `pTransDate`, `pCreatedBy`, `pReportStatus`, `pDeficiencyRemarks`, `pAvailFreeService`, `caseno`) VALUES ('$txtPerClaimId', '$txtPerTransmittalNo', '$pHciCaseNo', '$pHciTransNo', '$pyear', '1', '$pdate', 'A', '', '', '', '', '', '', '', '', '$txtPerPatPIN', '".$txtPerPatFname."', '".$txtPerPatMname."', '".$txtPerPatLname."', '$txtPerPatExtName', '$txtPerPatType', '$txtPerPatSex', 'NA', '$txtPerPatBirthday', '', '', '', '', '', 'U', 'X', 'X', 'X', 'X', '$pdate', '$uname', 'U', '', 'X', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. enlistment Inserted<br />";
      }
      else{
        //echo "UPDATE `enlistment` SET `pPatientPin`='$txtPerPatPIN', `pPatientFname`='$txtPerPatFname', `pPatientMname`='$txtPerPatMname', `pPatientLname`='$txtPerPatLname', `pPatientExtname`='$txtPerPatExtName', `pPatientType`='$txtPerPatType', `pPatientSex`='$txtPerPatSex', `pPatientContactno`='NA', `pPatientDob`='$txtPerPatBirthday', `pCivilStatus`='U', `pCreatedBy`='$uname' WHERE `caseno` ='$caseno'<br />";
        mysqli_query($conncf4,"UPDATE `enlistment` SET `pPatientPin`='$txtPerPatPIN', `pPatientFname`='$txtPerPatFname', `pPatientMname`='$txtPerPatMname', `pPatientLname`='$txtPerPatLname', `pPatientExtname`='$txtPerPatExtName', `pPatientType`='$txtPerPatType', `pPatientSex`='$txtPerPatSex', `pPatientContactno`='NA', `pPatientDob`='$txtPerPatBirthday', `pCivilStatus`='U', `pCreatedBy`='$uname' WHERE `caseno` ='$caseno'");

        $count+=1;
        $prompt=$prompt."$count. enlistment Updated<br />";
      }

      /*</ENLISTMENTS>*/

      /*<PROFILING>*/

      $prosql=mysqli_query($conncf4,"SELECT * FROM `profile` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($prosql)==0){
        //echo "INSERT INTO `profile` (`pHciTransNo`, `pHciCaseNo`, `pPatientPin`, `pPatientType`, `pMemPin`, `pProfDate`, `pRemarks`, `pEffYear`, `pProfileATC`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('$pHciTransNo', '$pHciCaseNo', '$txtPerPatPIN', '', '', '$adcf4', '', '$pyear', 'CF4', 'U', '', '$caseno')";
        mysqli_query($conncf4,"INSERT INTO `profile` (`pHciTransNo`, `pHciCaseNo`, `pPatientPin`, `pPatientType`, `pMemPin`, `pProfDate`, `pRemarks`, `pEffYear`, `pProfileATC`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('$pHciTransNo', '$pHciCaseNo', '$txtPerPatPIN', '', '', '$adcf4', '', '$pyear', 'CF4', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. profile Inserted<br />";
      }
      else{
        //echo "UPDATE `profile` SET `pPatientPin`='$txtPerPatPIN', `pProfDate`='$adcf4' WHERE `caseno`='$caseno'<br />";
        mysqli_query($conncf4,"UPDATE `profile` SET `pPatientPin`='$txtPerPatPIN', `pProfDate`='$adcf4' WHERE `caseno`='$caseno'");

        $count+=1;
        $prompt=$prompt."$count. profile Updated<br />";
      }

      $oinfosql=mysqli_query($conncf4,"SELECT * FROM `oinfo` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($oinfosql)==0){
        //echo "INSERT INTO `oinfo` (`pPatientPob`, `pPatientAge`, `pPatientOccupation`, `pPatientEducation`, `pPatientReligion`, `pPatientMotherMnln`, `pPatientMotherMnmi`, `pPatientMotherFn`, `pPatientMotherExtn`, `pPatientMotherBday`, `pPatientFatherLn`, `pPatientFatherMi`, `pPatientFatherFn`, `pPatientFatherExtn`, `pPatientFatherBday`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `oinfo` (`pPatientPob`, `pPatientAge`, `pPatientOccupation`, `pPatientEducation`, `pPatientReligion`, `pPatientMotherMnln`, `pPatientMotherMnmi`, `pPatientMotherFn`, `pPatientMotherExtn`, `pPatientMotherBday`, `pPatientFatherLn`, `pPatientFatherMi`, `pPatientFatherFn`, `pPatientFatherExtn`, `pPatientFatherBday`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. oinfo Inserted<br />";
      }

      $medhistsql=mysqli_query($conncf4,"SELECT * FROM `medhist` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($medhistsql)==0){
        //echo "INSERT INTO `medhist` (`pMdiseaseCode`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `medhist` (`pMdiseaseCode`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. medhist Inserted<br />";
      }

      $mhspecificfsql=mysqli_query($conncf4,"SELECT * FROM `mhspecific` WHERE `caseno`='$caseno'");
      $mhspecificfcount=mysqli_num_rows($mhspecificfsql);
      if($mhspecificfcount==0){
        //echo "INSERT INTO `mhspecific` (`pMdiseaseCode`, `pSpecificDesc`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '$txaMedHistOthers', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `mhspecific` (`pMdiseaseCode`, `pSpecificDesc`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '$txaMedHistOthers', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. mhspecific Inserted<br />";
      }
      else{
        //echo "UPDATE `mhspecific` SET `pSpecificDesc`='$txaMedHistOthers' WHERE `caseno`='$caseno'<br />";
        mysqli_query($conncf4,"UPDATE `mhspecific` SET `pSpecificDesc`='$txaMedHistOthers' WHERE `caseno`='$caseno'");

        $count+=1;
        $prompt=$prompt."$count. mhspecific Updated<br />";
      }

      $surghistsql=mysqli_query($conncf4,"SELECT * FROM `surghist` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($surghistsql)==0){
        //echo "INSERT INTO `surghist` (`pSurgDesc`, `pSurgDate`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `surghist` (`pSurgDesc`, `pSurgDate`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. surghist Inserted<br />";
      }

      $famhistsql=mysqli_query($conncf4,"SELECT * FROM `famhist` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($famhistsql)==0){
        //echo "INSERT INTO `famhist` (`pMdiseaseCode`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `famhist` (`pMdiseaseCode`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. famhist Inserted<br />";
      }

      $fhspecificsql=mysqli_query($conncf4,"SELECT * FROM `fhspecific` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($fhspecificsql)){
        //echo "INSERT INTO `fhspecific` (`pMdiseaseCode`, `pSpecificDesc`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `fhspecific` (`pMdiseaseCode`, `pSpecificDesc`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. fhspecific Inserted<br />";
      }

      $sochistsql=mysqli_query($conncf4,"SELECT * FROM `sochist` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($sochistsql)==0){
        //echo "INSERT INTO `sochist` (`pIsSmoker`, `pNoCigpk`, `pIsAdrinker`, `pNoBottles`, `pIllDrugUser`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `sochist` (`pIsSmoker`, `pNoCigpk`, `pIsAdrinker`, `pNoBottles`, `pIllDrugUser`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. sochist Inserted<br />";
      }

      $immunizationsql=mysqli_query($conncf4,"SELECT * FROM `immunization` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($immunizationsql)==0){
        //echo "INSERT INTO `immunization` (`pChildImmcode`, `pYoungwImmcode`, `pPregwImmcode`, `pElderlyImmcode`, `pOtherImm`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `immunization` (`pChildImmcode`, `pYoungwImmcode`, `pPregwImmcode`, `pElderlyImmcode`, `pOtherImm`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. immunization Inserted<br />";
      }

      $menshistfsql=mysqli_query($conncf4,"SELECT * FROM `menshist` WHERE `caseno`='$caseno'");
      $menshistfcount=mysqli_num_rows($menshistfsql);
      if($menshistfcount==0){
        //echo "INSERT INTO `menshist` (`pMenarchePeriod`, `pLastMensPeriod`, `pPeriodDuration`, `pMensInterval`, `pPadsPerDay`, `pOnsetSexIc`, `pBirthCtrlMethod`, `pIsMenopause`, `pMenopauseAge`, `pIsApplicable`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '$txtOBHistLastMens', '', '', '', '', '', '', '', '$mhDone', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `menshist` (`pMenarchePeriod`, `pLastMensPeriod`, `pPeriodDuration`, `pMensInterval`, `pPadsPerDay`, `pOnsetSexIc`, `pBirthCtrlMethod`, `pIsMenopause`, `pMenopauseAge`, `pIsApplicable`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '$txtOBHistLastMens', '', '', '', '', '', '', '', '$mhDone', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. menshist Inserted<br />";
      }
      else{
        //echo "UPDATE `menshist` SET `pLastMensPeriod`='$txtOBHistLastMens', `pIsApplicable`='$mhDone' WHERE `caseno`='$caseno'<br />";
        mysqli_query($conncf4,"UPDATE `menshist` SET `pLastMensPeriod`='$txtOBHistLastMens', `pIsApplicable`='$mhDone' WHERE `caseno`='$caseno'");

        $count+=1;
        $prompt=$prompt."$count. menshist Updated<br />";
      }

      $preghistfsql=mysqli_query($conncf4,"SELECT * FROM `preghist` WHERE `caseno`='$caseno'");
      $preghistfcount=mysqli_num_rows($preghistfsql);
      if($preghistfcount==0){
        //echo "INSERT INTO `preghist` (`pPregCnt`, `pDeliveryCnt`, `pDeliveryTyp`, `pFullTermCnt`, `pPrematureCnt`, `pAbortionCnt`, `pLivChildrenCnt`, `pWPregIndhyp`, `pWFamPlan`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('$txtOBHistGravity', '$txtOBHistParity', '', '$txtOBHistFullTerm', '$txtOBHistPremature', '$txtOBHistAbortion', '$txtOBHistLivingChildren', '', '', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `preghist` (`pPregCnt`, `pDeliveryCnt`, `pDeliveryTyp`, `pFullTermCnt`, `pPrematureCnt`, `pAbortionCnt`, `pLivChildrenCnt`, `pWPregIndhyp`, `pWFamPlan`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('$txtOBHistGravity', '$txtOBHistParity', '', '$txtOBHistFullTerm', '$txtOBHistPremature', '$txtOBHistAbortion', '$txtOBHistLivingChildren', '', '', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. preghist Inserted<br />";
      }
      else{
        //echo "UPDATE `preghist` SET `pPregCnt`='$txtOBHistGravity', `pDeliveryCnt`='$txtOBHistParity', `pFullTermCnt`='$txtOBHistFullTerm', `pPrematureCnt`='$txtOBHistPremature', `pAbortionCnt`='$txtOBHistAbortion', `pLivChildrenCnt`='$txtOBHistLivingChildren' WHERE `caseno`='$caseno'<br />";
        mysqli_query($conncf4,"UPDATE `preghist` SET `pPregCnt`='$txtOBHistGravity', `pDeliveryCnt`='$txtOBHistParity', `pFullTermCnt`='$txtOBHistFullTerm', `pPrematureCnt`='$txtOBHistPremature', `pAbortionCnt`='$txtOBHistAbortion', `pLivChildrenCnt`='$txtOBHistLivingChildren' WHERE `caseno`='$caseno'");

        $count+=1;
        $prompt=$prompt.
        "$count. preghist Updated<br />";
      }

      /*<PEPERT--Not included here*/

      $bloodtypesql=mysqli_query($conncf4,"SELECT * FROM `bloodtype` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($bloodtypesql)==0){
        //echo "INSERT INTO `bloodtype` (`pBloodType`, `pBloodRh`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `bloodtype` (`pBloodType`, `pBloodRh`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. bloodtype Inserted<br />";
      }

      /*<PEGENSURVEY--Not included here*/
      /*<PEMISC--Not included here*/
      /*<PESPECIFIC--Not included here*/

      $diagnosticsql=mysqli_query($conncf4,"SELECT * FROM `diagnostic` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($diagnosticsql)==0){
        //echo "INSERT INTO `diagnostic` (`pDiagnosticId`, `pOthRemarks`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('0', '', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `diagnostic` (`pDiagnosticId`, `pOthRemarks`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('0', '', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. diagnostic Inserted<br />";
      }

      $managementsql=mysqli_query($conncf4,"SELECT * FROM `management` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($managementsql)){
        //echo "INSERT INTO `management` (`pManagementId`, `pOthRemarks`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('0', '', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `management` (`pManagementId`, `pOthRemarks`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('0', '', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. management Inserted<br />";
      }

      $advicesql=mysqli_query($conncf4,"SELECT * FROM `advice` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($advicesql)==0){
        //echo "INSERT INTO `advice` (`pRemarks`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('NA', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `advice` (`pRemarks`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('NA', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. advice Inserted<br />";
      }

      $ncdqanssql=mysqli_query($conncf4,"SELECT * FROM `ncdqans` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($ncdqanssql)==0){
        //echo "INSERT INTO `ncdqans` (`pQid1_Yn`, `pQid2_Yn`, `pQid3_Yn`, `pQid4_Yn`, `pQid5_Ynx`, `pQid6_Yn`, `pQid7_Yn`, `pQid8_Yn`, `pQid9_Yn`, `pQid10_Yn`, `pQid11_Yn`, `pQid12_Yn`, `pQid13_Yn`, `pQid14_Yn`, `pQid15_Yn`, `pQid16_Yn`, `pQid17_Abcde`, `pQid18_Yn`, `pQid19_Yn`, `pQid19_Fbsmg`, `pQid19_Fbsmmol`, `pQid19_Fbsdate`, `pQid20_Yn`, `pQid20_Choleval`, `pQid20_Choledate`, `pQid21_Yn`, `pQid21_Ketonval`, `pQid21_Ketondate`, `pQid22_Yn`, `pQid22_Proteinval`, `pQid22_Proteindate`, `pQid23_Yn`, `pQid24_Yn`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `ncdqans` (`pQid1_Yn`, `pQid2_Yn`, `pQid3_Yn`, `pQid4_Yn`, `pQid5_Ynx`, `pQid6_Yn`, `pQid7_Yn`, `pQid8_Yn`, `pQid9_Yn`, `pQid10_Yn`, `pQid11_Yn`, `pQid12_Yn`, `pQid13_Yn`, `pQid14_Yn`, `pQid15_Yn`, `pQid16_Yn`, `pQid17_Abcde`, `pQid18_Yn`, `pQid19_Yn`, `pQid19_Fbsmg`, `pQid19_Fbsmmol`, `pQid19_Fbsdate`, `pQid20_Yn`, `pQid20_Choleval`, `pQid20_Choledate`, `pQid21_Yn`, `pQid21_Ketonval`, `pQid21_Ketondate`, `pQid22_Yn`, `pQid22_Proteinval`, `pQid22_Proteindate`, `pQid23_Yn`, `pQid24_Yn`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. ncdqans Inserted<br />";
      }

      /*</PROFILING>*/

      /*<SOAPS>*/

      $soapsql=mysqli_query($conncf4,"SELECT * FROM `soap` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($soapsql)==0){
        //echo "INSERT INTO `soap` (`pHciCaseNo`, `pHciTransNo`, `pPatientPin`, `pPatientType`, `pMemPin`, `pSoapDate`, `pEffYear`, `pSoapATC`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('$pHciCaseNo', '$pHciTransNo', '$txtPerPatPIN', '$txtPerPatType', '', '$adcf4', '$pyear', 'CF4', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `soap` (`pHciCaseNo`, `pHciTransNo`, `pPatientPin`, `pPatientType`, `pMemPin`, `pSoapDate`, `pEffYear`, `pSoapATC`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('$pHciCaseNo', '$pHciTransNo', '$txtPerPatPIN', '$txtPerPatType', '', '$adcf4', '$pyear', 'CF4', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. soap Inserted<br />";
      }
      else{
        //echo "UPDATE `soap` SET `pPatientPin`='$txtPerPatPIN', `pPatientType`='$txtPerPatType', `pSoapDate`='$adcf4' WHERE `caseno`='$caseno'<br />";
        mysqli_query($conncf4,"UPDATE `soap` SET `pPatientPin`='$txtPerPatPIN', `pPatientType`='$txtPerPatType', `pSoapDate`='$adcf4' WHERE `caseno`='$caseno'");

        $count+=1;
        $prompt=$prompt."$count. soap Updated<br />";
      }

      $subjectivefsql=mysqli_query($conncf4,"SELECT * FROM subjective WHERE caseno='$caseno'");
      $subjectivefcount=mysqli_num_rows($subjectivefsql);
      if($subjectivefcount==0){
        //echo "INSERT INTO `subjective` (`pChiefComplaint`, `pIllnessHistory`, `pOtherComplaint`, `pSignsSymptoms`, `pPainSite`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('$pChiefComplaint', '$pHistPresentIllness', '', '', '', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `subjective` (`pChiefComplaint`, `pIllnessHistory`, `pOtherComplaint`, `pSignsSymptoms`, `pPainSite`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('$pChiefComplaint', '$pHistPresentIllness', '', '', '', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. subjective Inserted<br />";
      }
      else{
        //echo "UPDATE `subjective` SET `pChiefComplaint`='$pChiefComplaint', `pIllnessHistory`='$pHistPresentIllness' WHERE `caseno`='$caseno'<br />";
        mysqli_query($conncf4,"UPDATE `subjective` SET `pChiefComplaint`='$pChiefComplaint', `pIllnessHistory`='$pHistPresentIllness' WHERE `caseno`='$caseno'");

        $count+=1;
        $prompt=$prompt."$count. subjective Updated<br />";
      }

      $pepertsoapsql=mysqli_query($conncf4,"SELECT * FROM `pepertsoap` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($pepertsoapsql)==0){
        //echo "INSERT INTO `pepertsoap` (`pSystolic`, `pDiastolic`, `pHr`, `pRr`, `pHeight`, `pWeight`, `pTemp`, `pVision`, `pLength`, `pHeadCirc`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', '', '', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `pepertsoap` (`pSystolic`, `pDiastolic`, `pHr`, `pRr`, `pHeight`, `pWeight`, `pTemp`, `pVision`, `pLength`, `pHeadCirc`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', '', '', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. pepertsoap Inserted<br />";
      }

      $pemiscsoapsql=mysqli_query($conncf4,"SELECT * FROM `pemiscsoap` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($pemiscsoapsql)==0){
        //echo "INSERT INTO `pemiscsoap` (`pSkinId`, `pHeentId`, `pChestId`, `pHeartId`, `pAbdomenId`, `pNeuroId`, `pGuId`, `pRectalId`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `pemiscsoap` (`pSkinId`, `pHeentId`, `pChestId`, `pHeartId`, `pAbdomenId`, `pNeuroId`, `pGuId`, `pRectalId`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. pemiscsoap Inserted<br />";
      }

      $pespecificsoapsql=mysqli_query($conncf4,"SELECT * FROM `pespecificsoap` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($pespecificsoapsql)==0){
        //echo "INSERT INTO `pespecificsoap` (`pSkinRem`, `pHeentRem`, `pChestRem`, `pHeartRem`, `pAbdomenRem`, `pNeuroRem`, `pRectalRem`, `pGuRem`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `pespecificsoap` (`pSkinRem`, `pHeentRem`, `pChestRem`, `pHeartRem`, `pAbdomenRem`, `pNeuroRem`, `pRectalRem`, `pGuRem`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. pespecificsoap Inserted<br />";
      }

      $icdssql=mysqli_query($conncf4,"SELECT * FROM `icds` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($icdssql)==0){
        //echo "INSERT INTO `icds` (`pIcdCode`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('000', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `icds` (`pIcdCode`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('000', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. icds Inserted<br />";
      }

      $diagnosticsoapsql=mysqli_query($conncf4,"SELECT * FROM `diagnosticsoap` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($diagnosticsoapsql)){
        //echo "INSERT INTO `diagnosticsoap` (`pDiagnosticId`, `pOthRemarks`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('0', '', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `diagnosticsoap` (`pDiagnosticId`, `pOthRemarks`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('0', '', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. diagnosticsoap Inserted<br />";
      }

      $managementsoapsql=mysqli_query($conncf4,"SELECT * FROM `managementsoap` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($managementsoapsql)==0){
        //echo "INSERT INTO `managementsoap` (`pManagementId`, `pOthRemarks`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('0', '', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `managementsoap` (`pManagementId`, `pOthRemarks`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('0', '', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. managementsoap Inserted<br />";
      }

      $advicesoapsql=mysqli_query($conncf4,"SELECT * FROM `advicesoap` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($advicesoapsql)==0){
        //echo "INSERT INTO `advicesoap` (`pRemarks`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('NA', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `advicesoap` (`pRemarks`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('NA', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. advicesoap Inserted<br />";
      }

      //</SOAPS>

      //<LABRESULTS>

      $labresultsql=mysqli_query($conncf4,"SELECT * FROM `labresult` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($labresultsql)==0){
        //echo "INSERT INTO `labresult` (`pHciCaseNo`, `pPatientPin`, `pPatientType`, `pMemPin`, `pEffYear`, `caseno`) VALUES ('', '', '', '', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `labresult` (`pHciCaseNo`, `pPatientPin`, `pPatientType`, `pMemPin`, `pEffYear`, `caseno`) VALUES ('', '', '', '', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. labresult Inserted<br />";
      }

      $cbcsql=mysqli_query($conncf4,"SELECT * FROM `cbc` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($cbcsql)==0){
        //echo "INSERT INTO `cbc` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pHematocrit`, `pHemoglobinG`, `pHemoglobinMmol`, `pMhcPg`, `pMhcFmol`, `pMchcGhb`, `pMchcMmol`, `pMcvUm`, `pMcvFl`, `pWbc1000`, `pWbc10`, `pMyelocyte`, `pNeutrophilsBnd`, `pNeutrophilsSeg`, `pLymphocytes`, `pMonocytes`, `pEosinophils`, `pBasophils`, `pPlatelet`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `cbc` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pHematocrit`, `pHemoglobinG`, `pHemoglobinMmol`, `pMhcPg`, `pMhcFmol`, `pMchcGhb`, `pMchcMmol`, `pMcvUm`, `pMcvFl`, `pWbc1000`, `pWbc10`, `pMyelocyte`, `pNeutrophilsBnd`, `pNeutrophilsSeg`, `pLymphocytes`, `pMonocytes`, `pEosinophils`, `pBasophils`, `pPlatelet`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. cbc Inserted<br />";
      }

      $urinalysissql=mysqli_query($conncf4,"SELECT * FROM `urinalysis` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($urinalysissql)==0){
        //echo "INSERT INTO `urinalysis` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pGravity`, `pAppearance`, `pColor`, `pGlucose`, `pProteins`, `pKetones`, `pPh`, `pRbCells`, `pWbCells`, `pBacteria`, `pCrystals`, `pBladderCell`, `pSquamousCell`, `pTubularCell`, `pBroadCasts`, `pEpithelialCast`, `pGranularCast`, `pHyalineCast`, `pRbcCast`, `pWaxyCast`, `pWcCast`, `pAlbumin`, `pPusCells`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `urinalysis` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pGravity`, `pAppearance`, `pColor`, `pGlucose`, `pProteins`, `pKetones`, `pPh`, `pRbCells`, `pWbCells`, `pBacteria`, `pCrystals`, `pBladderCell`, `pSquamousCell`, `pTubularCell`, `pBroadCasts`, `pEpithelialCast`, `pGranularCast`, `pHyalineCast`, `pRbcCast`, `pWaxyCast`, `pWcCast`, `pAlbumin`, `pPusCells`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. urinalysis Inserted<br />";
      }

      $chestxraysql=mysqli_query($conncf4,"SELECT * FROM `chestxray` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($chestxraysql)){
        //echo "INSERT INTO `chestxray` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pFindings`, `pRemarksFindings`, `pObservation`, `pRemarksObservation`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `chestxray` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pFindings`, `pRemarksFindings`, `pObservation`, `pRemarksObservation`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. chestxray Inserted<br />";
      }

      $sputumsql=mysqli_query($conncf4,"SELECT * FROM `sputum` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($sputumsql)==0){
        //echo "INSERT INTO `sputum` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pDataCollection`, `pFindings`, `pRemarks`, `pNoPlusses`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', 'X', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `sputum` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pDataCollection`, `pFindings`, `pRemarks`, `pNoPlusses`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', 'X', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. sputum Inserted<br />";
      }

      $lipidprofsql=mysqli_query($conncf4,"SELECT * FROM `lipidprof` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($lipidprofsql)==0){
        //echo "INSERT INTO `lipidprof` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pLdl`, `pHdl`, `pTotal`, `pCholesterol`, `pTriglycerides`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `lipidprof` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pLdl`, `pHdl`, `pTotal`, `pCholesterol`, `pTriglycerides`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. lipidprof Inserted<br />";
      }

      $fbssql=mysqli_query($conncf4,"SELECT * FROM `fbs` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($fbssql)){
        //echo "INSERT INTO `fbs` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pGlucoseMg`, `pGlucoseMmol`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `fbs` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pGlucoseMg`, `pGlucoseMmol`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. fbs Inserted<br />";
      }

      $ecgsql=mysqli_query($conncf4,"SELECT * FROM `ecg` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($ecgsql)){
        //echo "INSERT INTO `ecg` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pFindings`, `pRemarks`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `ecg` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pFindings`, `pRemarks`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. ecg Inserted<br />";
      }

      $fecalysissql=mysqli_query($conncf4,"SELECT * FROM `fecalysis` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($fecalysissql)==0){
        //echo "INSERT INTO `fecalysis` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pColor`, `pConsistency`, `pRbc`, `pWbc`, `pOva`, `pParasite`, `pBlood`, `pOccultBlood`, `pPusCells`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', '', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `fecalysis` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pColor`, `pConsistency`, `pRbc`, `pWbc`, `pOva`, `pParasite`, `pBlood`, `pOccultBlood`, `pPusCells`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', '', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. fecalysis Inserted<br />";
      }

      $papssmearsql=mysqli_query($conncf4,"SELECT * FROM `papssmear` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($papssmearsql)==0){
        //echo "INSERT INTO `papssmear` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pFindings`, `pImpression`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `papssmear` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pFindings`, `pImpression`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. papssmear Inserted<br />";
      }

      $ogttsql=mysqli_query($conncf4,"SELECT * FROM `ogtt` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($ogttsql)==0){
        //echo "INSERT INTO `ogtt` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pExamFastingMg`, `pExamFastingMmol`, `pExamOgttOneHrMg`, `pExamOgttOneHrMmol`, `pExamOgttTwoHrMg`, `pExamOgttTwoHrMmol`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `ogtt` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pExamFastingMg`, `pExamFastingMmol`, `pExamOgttOneHrMg`, `pExamOgttOneHrMmol`, `pExamOgttTwoHrMg`, `pExamOgttTwoHrMmol`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')");

        $count+=1;
        $prompt=$prompt."$count. ogtt Inserted<br />";
      }

      //</LABRESULTS>

      $casenosql=mysqli_query($conncf4,"SELECT * FROM `caseno` WHERE `caseno`='$caseno'");
      if(mysqli_num_rows($casenosql)){
        //echo "INSERT INTO `caseno` (`caseno`, `status`) VALUES ('$caseno', 'processing')<br />";
        mysqli_query($conncf4,"INSERT INTO `caseno` (`caseno`, `status`) VALUES ('$caseno', 'processing')");
        //echo "INSERT INTO `coursewards` (`eraseme`, `caseno`) VALUES ('', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `coursewards` (`eraseme`, `caseno`) VALUES ('', '$caseno')");
        //echo "INSERT INTO `enlistments` (`eraseme`, `caseno`) VALUES ('', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `enlistments` (`eraseme`, `caseno`) VALUES ('', '$caseno')");
        //echo "INSERT INTO `labresults` (`eraseme`, `caseno`) VALUES ('', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `labresults` (`eraseme`, `caseno`) VALUES ('', '$caseno')");
        //echo "INSERT INTO `medicines` (`eraseme`, `caseno`) VALUES ('', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `medicines` (`eraseme`, `caseno`) VALUES ('', '$caseno')");
        //echo "INSERT INTO `profiling` (`eraseme`, `caseno`) VALUES ('', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `profiling` (`eraseme`, `caseno`) VALUES ('', '$caseno')");
        //echo "INSERT INTO `soaps` (`eraseme`, `caseno`) VALUES ('', '$caseno')<br />";
        mysqli_query($conncf4,"INSERT INTO `soaps` (`eraseme`, `caseno`) VALUES ('', '$caseno')");
      }

      $epcbcountplus=$epcbcount+1;

      //echo "UPDATE myCounter SET epcbcount='$epcbcountplus' WHERE counterno='1'<br />";
      mysqli_query($outconnkmsci,"UPDATE `myCounter` SET `epcbcount`='$epcbcountplus' WHERE `counterno`='1'");

echo "
  <span class='arial13blue'>$prompt</span>
";

      echo "<META HTTP-EQUIV='Refresh'CONTENT='2;URL=?cf4p2&caseno=$caseno'>";
    }
  }
}
?>
