

<?php
// ------- other
$hcode="H12017356";
// ------------


$sql2 = "SELECT * FROM admission, patientprofile where admission.patientidno=patientprofile.patientidno and caseno='$caseno'";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$initialdx=$row2['initialdiagnosis'];
$patientidno=$row2['patientidno'];
$sex=$row2['sex'];
if($sex=="F"){$sex="FEMALE"; $avat = "female";}
else{$sex="MALE"; $avat = "male";}
$age=$row2['age'];
$birthdate=date("m/d/Y", strtotime($row2['dateofbirth']));
$senior=$row2['senior'];
$lastname=$row2['lastname'];
$firstname=$row2['firstname'];
$middlename=$row2['middlename'];
$suffix=$row2['suffix'];
$ptype=strtoupper($row2["paymentmode"]);
$namearray = "$lastname".",  "."$firstname"."  "."$middlename";
$mystat=strtoupper($row2["stat1"]);
}

$sql2x = "SELECT * FROM admissionaddinfo WHERE caseno='$caseno'";
$result2x = $conn->query($sql2x);
$checkaddinfo = mysqli_num_rows($result2x);
while($row2x = $result2x->fetch_assoc()) {
$chiefcomplaint=$row2x['chiefcomplaint'];
$historyofpresentillness=$row2x['historyofpresentillness'];
$pastmedicalhistory=$row2x['pastmedicalhistory'];
$heartrate=$row2x['heartrate'];
$respiratoryrate=$row2x['respiratoryrate'];
}


$sql = "SELECT * from claiminfoadd WHERE caseno='$caseno'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()){
$hciyes=$row["hciyes"];
$reason=$row["reasons"];
$hci=$row["hci"];
if($hciyes == ""){$checkno = "checked"; $checkyes="";}else{$checkno = ""; $checkyes="checked";}
if($hci==""){$hci="N/A";}
if($reason==""){$reason="N/A";}
}

/*
$sqlx3 = "SELECT pHospitalTransmittalNo FROM hcode WHERE caseno='$caseno'";
$resultx3 = $conn_ett->query($sqlx3);
while($rowx3 = $resultx3->fetch_assoc()) {
$pHospitalTransmittalNo=$rowx3['pHospitalTransmittalNo'];
}
*/

$sqlx4 = "SELECT identificationno FROM claiminfo WHERE caseno='$caseno'";
$resultx4 = $conn->query($sqlx4);
while($rowx4 = $resultx4->fetch_assoc()) {
$pin=$rowx4['identificationno'];
}

/*1. PhilHealth Identification Number (PIN) of Member: */
$phicofmember = $pin; //Place value of PHIC Number of member from the DB here.

if(strlen($phicofmember)==14){
$phicmember = str_split($phicofmember);
$phicmember0 = $phicmember[0];
$phicmember1 = $phicmember[1];
$phicmember3 = $phicmember[3];
$phicmember4 = $phicmember[4];
$phicmember5 = $phicmember[5];
$phicmember6 = $phicmember[6];
$phicmember7 = $phicmember[7];
$phicmember8 = $phicmember[8];
$phicmember9 = $phicmember[9];
$phicmember10 = $phicmember[10];
$phicmember11 = $phicmember[11];
$phicmember13 = $phicmember[13];
}
else if(strlen($phicofmember)==12){
$phicmember = str_split($phicofmember);
$phicmember0 = $phicmember[0];
$phicmember1 = $phicmember[1];
$phicmember3 = $phicmember[2];
$phicmember4 = $phicmember[3];
$phicmember5 = $phicmember[4];
$phicmember6 = $phicmember[5];
$phicmember7 = $phicmember[6];
$phicmember8 = $phicmember[7];
$phicmember9 = $phicmember[8];
$phicmember10 = $phicmember[9];
$phicmember11 = $phicmember[10];
$phicmember13 = $phicmember[11];
}
else{
$phicmember0 = "";
$phicmember1 = "";
$phicmember3 = "";
$phicmember4 = "";
$phicmember5 = "";
$phicmember6 = "";
$phicmember7 = "";
$phicmember8 = "";
$phicmember9 = "";
$phicmember10 = "";
$phicmember11 = "";
$phicmember13 = "";
}

$pinrel=$phicmember0.$phicmember1.$phicmember3.$phicmember4.$phicmember5.$phicmember6.$phicmember7.$phicmember8.$phicmember9.$phicmember10.$phicmember11.$phicmember13;
/*------------------------------------------------------*/

$sqlx5 = "SELECT pCivilStatus FROM enlistment WHERE caseno='$caseno'";
$resultx5 = $conncf4->query($sqlx5);
while($rowx5 = $resultx5->fetch_assoc()) {
$cvsrel=$rowx5['pCivilStatus'];
if($cvsrel=="S"){$cvs="SINGLE";}
else if($cvsrel=="M"){$cvs="MARRIED";}
else if($cvsrel=="W"){$cvs="WIDOWED";}
else if($cvsrel=="X"){$cvs="SEPARATED";}
else if($cvsrel=="A"){$cvs="ANNULED";}
else{$cvs="SINGLE";}
}


$pPregCnt="0";$pDeliveryCnt="0";$pFullTermCnt="0";$pAbortionCnt="0";$pPrematureCnt="0";$pLivChildrenCnt="0";

$sqlc=$conncf4->query("SELECT * FROM `preghist` WHERE caseno='$caseno'");
while($prow = $sqlc->fetch_assoc()){
$pPregCnt=$prow["pPregCnt"];
$pDeliveryCnt=$prow["pDeliveryCnt"];
$pFullTermCnt=$prow["pFullTermCnt"];
$pAbortionCnt=$prow["pAbortionCnt"];
$pPrematureCnt=$prow["pPrematureCnt"];
$pLivChildrenCnt=$prow["pLivChildrenCnt"];

if($pPregCnt==""){$pPregCnt="0";}
if($pDeliveryCnt==""){$pDeliveryCnt="0";}
if($pFullTermCnt==""){$pFullTermCnt="0";}
if($pAbortionCnt==""){$pAbortionCnt="0";}
if($pPrematureCnt==""){$pPrematureCnt="0";}
if($pLivChildrenCnt==""){$pLivChildrenCnt="0";}
}




$pIsApplicable="N"; $pIsApplicable2="NO"; $pIsApplicable3="YES"; $pIsApplicable33="Y"; $pLastMensPeriod="";
$menss = $conncf4->query("SELECT pLastMensPeriod, pIsApplicable FROM menshist WHERE caseno='$caseno'");
while($mens1 = $menss->fetch_assoc()){
$pLastMensPeriod = $mens1['pLastMensPeriod'];
$pIsApplicable = $mens1['pIsApplicable'];
if($pIsApplicable=="N"){$pIsApplicable2="NO"; $pIsApplicable3="YES"; $pIsApplicable33="Y";}else{$pIsApplicable2="YES"; $pIsApplicable3="NO";  $pIsApplicable33="N";}

}


// ----------------------------------------------------------------------------------------------------------------------------------->
if(isset($_POST['btn_save'])){
$hcode="H12017356";
$ad = $_POST['admittingdx'];
$cc = $_POST['chiefcomplaint'];
$hp = $_POST['historyPI'];
$pm = $_POST['pastMH'];
$hr = $_POST['heartrate'];
$rp = $_POST['resprate'];

$referred = $_POST['referred'];
$reason = $_POST['reason'];
$hci = $_POST['HCI'];

if($checkaddinfo<=0){
$sqlposwalkin = "INSERT INTO `admissionaddinfo` (`caseno`, `chiefcomplaint`, `historyofpresentillness`, `pastmedicalhistory`, `respiratoryrate`, `heartrate`)
VALUES ('$caseno', '$cc', '$hp', '$pm', '$rp', '$hr')";
if($conn->query($sqlposwalkin) === TRUE) {echo"<script>alert('Successfully Saved!');</script>";}
}else{
$sqlposwalkin = "update `admissionaddinfo` set `chiefcomplaint`='$cc', `historyofpresentillness`='$hp', `pastmedicalhistory`='$pm', `respiratoryrate`='$rp', `heartrate`='$hr' where caseno='$caseno'";
if($conn->query($sqlposwalkin) === TRUE) {}
}

$sqlposwalkinz = "update `admission` set `initialdiagnosis`='$ad' where caseno='$caseno'";
if($conn->query($sqlposwalkinz) === TRUE) {}

$sqlposwalkinz = "update `admission` set `initialdiagnosis`='$ad' where caseno='$caseno'";
if($conn->query($sqlposwalkinz) === TRUE) {}

$checksub = $conncf4->query("select * from subjective where caseno='$caseno'");
$ifexist= mysqli_num_rows($checksub);
if($ifexist>0){$conncf4->query("UPDATE `subjective` SET pChiefComplaint='$cc', pIllnessHistory='$hp' WHERE caseno='$caseno'");}
else{$conncf4->query("INSERT INTO `subjective`(`pChiefComplaint`, `pIllnessHistory`, `pOtherComplaint`, `pSignsSymptoms`, `pPainSite`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('$cc', '$hp', '$txtother', '$symptom1', '$txtpain', 'U', '', '$caseno')");}

$check1 = $conncf4->query("select * from mhspecific WHERE caseno='$caseno'");
if(mysqli_num_rows($check1)>0){
$conncf4->query("UPDATE `mhspecific` SET pSpecificDesc='$pm' WHERE caseno='$caseno'");
}else{
$conncf4->query("INSERT INTO `mhspecific`(`pMdiseaseCode`, `pSpecificDesc`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '$pm', 'U', '', '$caseno')");
}



$sql2xx = "SELECT * FROM claiminfoadd WHERE caseno='$caseno'";
$result2xx = $conn->query($sql2xx);
$checklang = mysqli_num_rows($result2xx);

if($referred=="NO"){$col = "hcino"; $col2 ="hciyes";}else{$col = "hciyes";  $col2 ="hcino";}
if($checklang>0){
$sqlposwalkinz22 = "update `claiminfoadd` set $col = 'checked', $col2 = '', hci='$hci', reasons='$reason' where caseno='$caseno'";
if($conn->query($sqlposwalkinz22) === TRUE) {}
}else{
$sqlposwalkin = "INSERT INTO `claiminfoadd` (`caseno`, $col, $col2, `hci`, `reasons`)
VALUES ('$caseno', 'checked', '', '$hci', '$reason')";
if($conn->query($sqlposwalkin) === TRUE) {}
}




//---------------------------
$txtPerTransmittalNo=$_POST['txtPerTransmittalNo'];
$txtPerClaimId=$_POST['txtPerClaimId'];
$txtPerPatPIN=$_POST['txtPerPatPIN'];
$txtPerPatLname=strtoupper($_POST['txtPerPatLname']);
$txtPerPatFname=strtoupper($_POST['txtPerPatFname']);
$txtPerPatMname=strtoupper($_POST['txtPerPatMname']);
$txtPerPatExtName=strtoupper($_POST['txtPerPatExtName']);
$txtPerPatSex=$_POST['txtPerPatSex'];
$txtPerPatStatus=$_POST['txtPerPatStatus'];
$txtPerPatType=$_POST['txtPerPatType'];
$txtPerPatBirthday=$_POST['txtPerPatType'];
if($txtPerPatBirthday=="--"){$txtPerPatBirthday="";}

$mhDone=$_POST['mhDone'];
$txtOBHistLastMens=$_POST['menstrualdate'];
if($mhDone=="Y"){$txtOBHistLastMens=$txtOBHistLastMens;}
else{$txtOBHistLastMens="";}

$txtOBHistGravity=$_POST['txtOBHistGravity'];
$txtOBHistParity=$_POST['txtOBHistParity'];
$txtOBHistFullTerm=$_POST['txtOBHistFullTerm'];
$txtOBHistPremature=$_POST['txtOBHistPremature'];
$txtOBHistAbortion=$_POST['txtOBHistAbortion'];
$txtOBHistLivingChildren=$_POST['txtOBHistLivingChildren'];
$source=$_POST['source'];

$pdate=date("Y-m-d");
$pyear=date("Y");
$pym=date("Ym");

if($txtPerPatSex=="MALE"){$txtPerPatSex="M";}else{$txtPerPatSex="F";}

$checkv = $conncf4->query("SELECT * FROM enlistment WHERE caseno='$caseno'");
if(mysqli_num_rows($checkv)==0){


// -----------------------------------------
$conncf4->query("DELETE FROM `epcb` where caseno='$caseno'");
$conncf4->query("DELETE FROM `enlistment`  where caseno='$caseno'");
$conncf4->query("DELETE FROM `profile` where caseno='$caseno'");
$conncf4->query("DELETE FROM `oinfo` where caseno='$caseno'");
$conncf4->query("DELETE FROM `medhist` where caseno='$caseno'");
$conncf4->query("DELETE FROM `surghist` where caseno='$caseno'");
$conncf4->query("DELETE FROM `famhist` where caseno='$caseno'");
$conncf4->query("DELETE FROM `fhspecific` where caseno='$caseno'");
$conncf4->query("DELETE FROM `sochist` where caseno='$caseno'");
$conncf4->query("DELETE FROM `immunization` where caseno='$caseno'");
$conncf4->query("DELETE FROM `menshist` where caseno='$caseno'");
$conncf4->query("DELETE FROM `preghist` where caseno='$caseno'");
$conncf4->query("DELETE FROM `bloodtype` where caseno='$caseno'");
$conncf4->query("DELETE FROM `diagnostic` where caseno='$caseno'");
$conncf4->query("DELETE FROM `management` where caseno='$caseno'");
$conncf4->query("DELETE FROM `advice` where caseno='$caseno'");
$conncf4->query("DELETE FROM `ncdqans` where caseno='$caseno'");
$conncf4->query("DELETE FROM `soap` where caseno='$caseno'");
$conncf4->query("DELETE FROM `pepertsoap` where caseno='$caseno'");
$conncf4->query("DELETE FROM `pemiscsoap` where caseno='$caseno'");
$conncf4->query("DELETE FROM `pespecificsoap` where caseno='$caseno'");
$conncf4->query("DELETE FROM `icds` where caseno='$caseno'");
$conncf4->query("DELETE FROM `diagnosticsoap` where caseno='$caseno'");
$conncf4->query("DELETE FROM `managementsoap` where caseno='$caseno'");
$conncf4->query("DELETE FROM `advicesoap` where caseno='$caseno'");
$conncf4->query("DELETE FROM `labresult` where caseno='$caseno'");
$conncf4->query("DELETE FROM `cbc` where caseno='$caseno'");
$conncf4->query("DELETE FROM `urinalysis` where caseno='$caseno'");
$conncf4->query("DELETE FROM `chestxray` where caseno='$caseno'");
$conncf4->query("DELETE FROM `sputum` where caseno='$caseno'");
$conncf4->query("DELETE FROM `lipidprof` where caseno='$caseno'");
$conncf4->query("DELETE FROM `fbs` where caseno='$caseno'");
$conncf4->query("DELETE FROM `ecg` where caseno='$caseno'");
$conncf4->query("DELETE FROM `fecalysis` where caseno='$caseno'");
$conncf4->query("DELETE FROM `papssmear` where caseno='$caseno'");
$conncf4->query("DELETE FROM `ogtt` where caseno='$caseno'");
$conncf4->query("DELETE FROM `caseno` where caseno='$caseno'");
$conncf4->query("DELETE FROM `coursewards` where caseno='$caseno'");
$conncf4->query("DELETE FROM `enlistments` where caseno='$caseno'");
$conncf4->query("DELETE FROM `labresults` where caseno='$caseno'");
$conncf4->query("DELETE FROM `medicines` where caseno='$caseno'");
$conncf4->query("DELETE FROM `profiling` where caseno='$caseno'");
$conncf4->query("DELETE FROM `soaps` where caseno='$caseno'");
// -----------------------------------------


$conncf4->query("INSERT INTO `epcb` (`pUsername`, `pPassword`, `pHciAccreNo`, `pEnlistTotalCnt`, `pProfileTotalCnt`, `pSoapTotalCnt`, `pEmrId`, `pCertificationId`, `pHciTransmittalNumber`, `caseno`) VALUES (':ECLAIMS-03-07-2018-00002', '', '$hcode', '', '', '', '', 'ECLAIMS-03-07-2018-00002', '', '$caseno')");

//<ENLISTMENTS>
$uname=strtoupper($username);
$conncf4->query("INSERT INTO `enlistment` (`pEClaimId`, `pEClaimsTransmittalId`, `pHciCaseNo`, `pHciTransNo`, `pEffYear`, `pEnlistStat`, `pEnlistDate`, `pPackageType`, `pMemPin`, `pMemFname`, `pMemMname`, `pMemLname`, `pMemExtname`, `pMemDob`, `pMemCat`, `pMemNcat`, `pPatientPin`, `pPatientFname`, `pPatientMname`, `pPatientLname`, `pPatientExtname`, `pPatientType`, `pPatientSex`, `pPatientContactno`, `pPatientDob`, `pPatientAddbrgy`, `pPatientAddmun`, `pPatientAddprov`, `pPatientAddreg`, `pPatientAddzipcode`, `pCivilStatus`, `pWithConsent`, `pWithLoa`, `pWithDisability`, `pDependentType`, `pTransDate`, `pCreatedBy`, `pReportStatus`, `pDeficiencyRemarks`, `pAvailFreeService`, `caseno`) VALUES ('$txtPerClaimId', '$txtPerTransmittalNo', '$pHciCaseNo', '$pHciTransNo', '$pyear', '1', '$pdate', 'A', '', '', '', '', '', '', '', '', '$txtPerPatPIN', '$txtPerPatFname', '$txtPerPatMname', '$txtPerPatLname', '$txtPerPatExtName', '$txtPerPatType', '$txtPerPatSex', 'NA', '$txtPerPatBirthday', '', '', '', '', '', 'U', 'X', 'X', 'X', 'X', '$pdate', '$uname', 'U', '', 'X', '$caseno')");
//</ENLISTMENTS>

//<PROFILING>
$conncf4->query("INSERT INTO `profile` (`pHciTransNo`, `pHciCaseNo`, `pPatientPin`, `pPatientType`, `pMemPin`, `pProfDate`, `pRemarks`, `pEffYear`, `pProfileATC`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('$pHciTransNo', '$pHciCaseNo', '$txtPerPatPIN', '', '', '$pdate', '', '$pyear', 'CF4', 'U', '', '$caseno')");

$conncf4->query("INSERT INTO `oinfo` (`pPatientPob`, `pPatientAge`, `pPatientOccupation`, `pPatientEducation`, `pPatientReligion`, `pPatientMotherMnln`, `pPatientMotherMnmi`, `pPatientMotherFn`, `pPatientMotherExtn`, `pPatientMotherBday`, `pPatientFatherLn`, `pPatientFatherMi`, `pPatientFatherFn`, `pPatientFatherExtn`, `pPatientFatherBday`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'U', '', '$caseno')");

$conncf4->query("INSERT INTO `medhist` (`pMdiseaseCode`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', 'U', '', '$caseno')");
$conncf4->query("INSERT INTO `surghist` (`pSurgDesc`, `pSurgDate`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', 'U', '', '$caseno')");
$conncf4->query("INSERT INTO `famhist` (`pMdiseaseCode`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', 'U', '', '$caseno')");
$conncf4->query("INSERT INTO `fhspecific` (`pMdiseaseCode`, `pSpecificDesc`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', 'U', '', '$caseno')");
$conncf4->query("INSERT INTO `sochist` (`pIsSmoker`, `pNoCigpk`, `pIsAdrinker`, `pNoBottles`, `pIllDrugUser`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('','','','','','U','','$caseno')");
$conncf4->query("INSERT INTO `immunization` (`pChildImmcode`, `pYoungwImmcode`, `pPregwImmcode`, `pElderlyImmcode`, `pOtherImm`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('','','','','','U', '', '$caseno')");
$conncf4->query("INSERT INTO `menshist` (`pMenarchePeriod`, `pLastMensPeriod`, `pPeriodDuration`, `pMensInterval`, `pPadsPerDay`, `pOnsetSexIc`, `pBirthCtrlMethod`, `pIsMenopause`, `pMenopauseAge`, `pIsApplicable`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '$txtOBHistLastMens', '', '', '', '', '', '', '', '$mhDone', 'U', '', '$caseno')");
$conncf4->query("INSERT INTO `preghist` (`pPregCnt`, `pDeliveryCnt`, `pDeliveryTyp`, `pFullTermCnt`, `pPrematureCnt`, `pAbortionCnt`, `pLivChildrenCnt`, `pWPregIndhyp`, `pWFamPlan`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('$txtOBHistGravity', '$txtOBHistParity', '', '$txtOBHistFullTerm', '$txtOBHistPremature', '$txtOBHistAbortion', '$txtOBHistLivingChildren', '', '', 'U', '', '$caseno')");

//<PEPERT--Not included here
$conncf4->query("INSERT INTO `bloodtype` (`pBloodType`, `pBloodRh`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', 'U', '', '$caseno')");

//<PEGENSURVEY--Not included here

//<PEMISC--Not included here

//<PESPECIFIC--Not included here
$conncf4->query("INSERT INTO `diagnostic` (`pDiagnosticId`, `pOthRemarks`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('0', '', 'U', '', '$caseno')");
$conncf4->query("INSERT INTO `management` (`pManagementId`, `pOthRemarks`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('0', '', 'U', '', '$caseno')");
$conncf4->query("INSERT INTO `advice` (`pRemarks`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('NA', 'U', '', '$caseno')");
$conncf4->query("INSERT INTO `ncdqans` (`pQid1_Yn`, `pQid2_Yn`, `pQid3_Yn`, `pQid4_Yn`, `pQid5_Ynx`, `pQid6_Yn`, `pQid7_Yn`, `pQid8_Yn`, `pQid9_Yn`, `pQid10_Yn`, `pQid11_Yn`, `pQid12_Yn`, `pQid13_Yn`, `pQid14_Yn`, `pQid15_Yn`, `pQid16_Yn`, `pQid17_Abcde`, `pQid18_Yn`, `pQid19_Yn`, `pQid19_Fbsmg`, `pQid19_Fbsmmol`, `pQid19_Fbsdate`, `pQid20_Yn`, `pQid20_Choleval`, `pQid20_Choledate`, `pQid21_Yn`, `pQid21_Ketonval`, `pQid21_Ketondate`, `pQid22_Yn`, `pQid22_Proteinval`, `pQid22_Proteindate`, `pQid23_Yn`, `pQid24_Yn`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'U', '', '$caseno')");
//<//PROFILING>

//<SOAPS>
$conncf4->query("INSERT INTO `soap` (`pHciCaseNo`, `pHciTransNo`, `pPatientPin`, `pPatientType`, `pMemPin`, `pSoapDate`, `pEffYear`, `pSoapATC`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('$pHciCaseNo', '$pHciTransNo', '$txtPerPatPIN', '$txtPerPatType', '', '$pdate', '$pyear', 'CF4', 'U', '', '$caseno')");

$conncf4->query("INSERT INTO `pepertsoap` (`pSystolic`, `pDiastolic`, `pHr`, `pRr`, `pHeight`, `pWeight`, `pTemp`, `pVision`, `pLength`, `pHeadCirc`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', '', '', 'U', '', '$caseno')");

$conncf4->query("INSERT INTO `pemiscsoap` (`pSkinId`, `pHeentId`, `pChestId`, `pHeartId`, `pAbdomenId`, `pNeuroId`, `pGuId`, `pRectalId`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', 'U', '', '$caseno')");

$conncf4->query("INSERT INTO `pespecificsoap` (`pSkinRem`, `pHeentRem`, `pChestRem`, `pHeartRem`, `pAbdomenRem`, `pNeuroRem`, `pRectalRem`, `pGuRem`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', 'U', '', '$caseno')");

$conncf4->query("INSERT INTO `icds` (`pIcdCode`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('000', 'U', '', '$caseno')");
$conncf4->query("INSERT INTO `diagnosticsoap` (`pDiagnosticId`, `pOthRemarks`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('0', '', 'U', '', '$caseno')");
$conncf4->query("INSERT INTO `managementsoap` (`pManagementId`, `pOthRemarks`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('0', '', 'U', '', '$caseno')");
$conncf4->query("INSERT INTO `advicesoap` (`pRemarks`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('NA', 'U', '', '$caseno')");
//</SOAPS>

//<LABRESULTS>
$conncf4->query("INSERT INTO `labresult` (`pHciCaseNo`, `pPatientPin`, `pPatientType`, `pMemPin`, `pEffYear`, `caseno`) VALUES ('', '', '', '', '', '$caseno')");

$conncf4->query("INSERT INTO `cbc` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pHematocrit`, `pHemoglobinG`, `pHemoglobinMmol`, `pMhcPg`, `pMhcFmol`, `pMchcGhb`, `pMchcMmol`, `pMcvUm`, `pMcvFl`, `pWbc1000`, `pWbc10`, `pMyelocyte`, `pNeutrophilsBnd`, `pNeutrophilsSeg`, `pLymphocytes`, `pMonocytes`, `pEosinophils`, `pBasophils`, `pPlatelet`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')");

$conncf4->query("INSERT INTO `urinalysis` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pGravity`, `pAppearance`, `pColor`, `pGlucose`, `pProteins`, `pKetones`, `pPh`, `pRbCells`, `pWbCells`, `pBacteria`, `pCrystals`, `pBladderCell`, `pSquamousCell`, `pTubularCell`, `pBroadCasts`, `pEpithelialCast`, `pGranularCast`, `pHyalineCast`, `pRbcCast`, `pWaxyCast`, `pWcCast`, `pAlbumin`, `pPusCells`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')");

$conncf4->query("INSERT INTO `chestxray` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pFindings`, `pRemarksFindings`, `pObservation`, `pRemarksObservation`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')");

$conncf4->query("INSERT INTO `sputum` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pDataCollection`, `pFindings`, `pRemarks`, `pNoPlusses`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', 'X', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')");

$conncf4->query("INSERT INTO `lipidprof` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pLdl`, `pHdl`, `pTotal`, `pCholesterol`, `pTriglycerides`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')");

$conncf4->query("INSERT INTO `fbs` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pGlucoseMg`, `pGlucoseMmol`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')");

$conncf4->query("INSERT INTO `ecg` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pFindings`, `pRemarks`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')");

$conncf4->query("INSERT INTO `fecalysis` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pColor`, `pConsistency`, `pRbc`, `pWbc`, `pOva`, `pParasite`, `pBlood`, `pOccultBlood`, `pPusCells`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', '', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')");

$conncf4->query("INSERT INTO `papssmear` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pFindings`, `pImpression`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')");

$conncf4->query("INSERT INTO `ogtt` (`pHciTransNo`, `pReferralFacility`, `pLabDate`, `pExamFastingMg`, `pExamFastingMmol`, `pExamOgttOneHrMg`, `pExamOgttOneHrMmol`, `pExamOgttTwoHrMg`, `pExamOgttTwoHrMmol`, `pDateAdded`, `pIsApplicable`, `pModule`, `pDiagnosticLabFee`, `pCoPay`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '', '', '', 'N', '', '', '', 'U', '', '$caseno')");

//</LABRESULTS>

$conncf4->query("INSERT INTO `caseno` (`caseno`, `status`) VALUES ('$caseno', 'processing')");
$conncf4->query("INSERT INTO `coursewards` (`eraseme`, `caseno`) VALUES ('', '$caseno')");
$conncf4->query("INSERT INTO `enlistments` (`eraseme`, `caseno`) VALUES ('', '$caseno')");
$conncf4->query("INSERT INTO `labresults` (`eraseme`, `caseno`) VALUES ('', '$caseno')");
$conncf4->query("INSERT INTO `medicines` (`eraseme`, `caseno`) VALUES ('', '$caseno')");
$conncf4->query("INSERT INTO `profiling` (`eraseme`, `caseno`) VALUES ('', '$caseno')");
$conncf4->query("INSERT INTO `soaps` (`eraseme`, `caseno`) VALUES ('', '$caseno')");

echo"
<script type='text/javascript'>
swal({
icon: 'success',
title: 'Save Entries!',
text: 'CF4 ADDITIONAL INFORMATION',
type: 'error',
button: false
});
setTimeout(function(){window.location.href = '?part2&caseno=$caseno$datax';}, 2000);
</script>";

}else{

$conncf4->query("UPDATE `epcb` SET pUsername=':ECLAIMS-03-07-2018-00002', pPassword='', pHciAccreNo='$hcode', pEnlistTotalCnt='', pProfileTotalCnt='', pSoapTotalCnt='', pEmrId='', pCertificationId='ECLAIMS-03-07-2018-00002', pHciTransmittalNumber='' WHERE caseno='$caseno'");

$conncf4->query("UPDATE `enlistment` SET pPatientPin='$txtPerPatPIN', pPatientFname='$txtPerPatFname', pPatientMname='$txtPerPatMname', pPatientLname='$txtPerPatLname', pPatientExtname='$txtPerPatExtName', pPatientType='$txtPerPatType', pPatientSex='$txtPerPatSex', pPatientContactno='NA', pPatientDob='$txtPerPatBirthday', pCivilStatus='U', pCreatedBy='$uname' WHERE `caseno` ='$caseno'");

$conncf4->query("UPDATE `profile` SET pPatientPin='$txtPerPatPIN' WHERE caseno='$caseno'");

$conncf4->query("UPDATE `menshist` SET pLastMensPeriod='$txtOBHistLastMens', pIsApplicable='$mhDone' WHERE caseno='$caseno'");

$conncf4->query("UPDATE `preghist` SET pPregCnt='$txtOBHistGravity', pDeliveryCnt='$txtOBHistParity', pFullTermCnt='$txtOBHistFullTerm', pPrematureCnt='$txtOBHistPremature', pAbortionCnt='$txtOBHistAbortion', pLivChildrenCnt='$txtOBHistLivingChildren' WHERE caseno='$caseno'");

$conncf4->query("UPDATE `soap` SET pPatientPin='$txtPerPatPIN', pPatientType='$txtPerPatType' WHERE caseno='$caseno'");


echo"
<script type='text/javascript'>
swal({
icon: 'success',
title: 'Update Entries!',
text: 'CF4 ADDITIONAL INFORMATION',
type: 'error',
button: false
});
setTimeout(function(){window.location.href = '?part2&caseno=$caseno$datax';}, 2000);
</script>";
}
//---------------------------

//echo"<script>window.location='index.php?view=part2&caseno=$caseno$datax';</script>";
}
// ------------------------------------------------------------------------------------------------------------------------------------->
?>
