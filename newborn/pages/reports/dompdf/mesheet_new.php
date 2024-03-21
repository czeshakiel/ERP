<?php
include 'alinkii.php';
ini_set("display_errors", "off");
$version = explode(".", phpversion());
if ($version[0] == "5") { require_once '../dompdf/dompdf0.8.3/autoload.inc.php'; } 
else { require_once '../dompdf/dompdf7.1/autoload.inc.php'; }

$queryHeading = $pdo_kmsci->query("SELECT * FROM heading"); $fetchHd = $queryHeading->fetch(PDO::FETCH_ASSOC);
$branchname = $fetchHd['heading'];
$branchteln = $fetchHd['telno'];
$branchaddr = $fetchHd['address'];

$lginuser = $_GET['fname'];
$caseno = $_GET['caseno'];
$queryAdmission = $pdo_kmsci->query("SELECT * FROM admission WHERE caseno = '$caseno'");
$fetch = $queryAdmission->fetch(PDO::FETCH_ASSOC);
$room = $fetch['room'];
$employerno = $fetch['employerno'];
$patientidno = $fetch['patientidno'];
$ap = $fetch['ap'];
$street = $fetch['street'];
$barangay = $fetch['barangay'];
$municipality = $fetch['municipality'];
$province = $fetch['province'];
$admittingdiagnosis = $fetch['initialdiagnosis'];
$finaldiagnosis = $fetch['finaldiagnosis'];
$dateadmit = $fetch['dateadmitted'];
$timeadmit = date("h:i:s a", strtotime($fetch['timeadmitted']));
$address = $street." ".$barangay." ".$municipality.", ".$province;
$dateRegister = date('m/d/Y',strtotime($fetch['dateadmitted']));
$dateRegister = new DateTime($dateRegister,new DateTimeZone('Asia/Manila'));

$queryDocfile = $pdo_kmsci->query("SELECT `name` FROM docfile where code = '$ap'");
if($queryDocfile->rowCount() != 0){
  $fetchAp = $queryDocfile->fetch(PDO::FETCH_ASSOC);
  $apName = mb_strtoupper($fetchAp['name']);
}

$queryDchTable = $pdo_kmsci->query("SELECT * FROM dischargedtable where caseno='$caseno'");
$dischCount = $queryDchTable->rowCount();
if ($dischCount == 0){
  $dischargedno = '';
  $datedischarged = '';
  $timedischarged = '';
} else {
  while($fetchDct = $queryDchTable->fetch(PDO::FETCH_ASSOC)){
    $dischargedno = $fetchDct['caseno'];
    $datedischarged = $fetchDct['datedischarged'];
    $timedischarged = $fetchDct['timedischarged'];
  }
}

$queryPtProfile = $pdo_kmsci->query("SELECT * FROM patientprofile WHERE patientidno='$patientidno'");
$ptCount = $queryPtProfile->rowCount();
if ($ptCount == 0) {
  $age='';
  $sex='';
  $bdate='';
  $name='';
} else {
  while($fetchPt = $queryPtProfile->fetch(PDO::FETCH_ASSOC)){
    $age = $fetchPt['age'];
    $sex = $fetchPt['sex'];
    $bdate = $fetchPt['dateofbirth'];
    $name = $fetchPt['lastname'].", ".$fetchPt['firstname']." ".$fetchPt['middlename'];
    if($sex == 'M') {$sex = 'MALE'; $male = "checked"; $female = "";} 
    elseif($sex == 'F') {$sex = 'FEMALE'; $male = ""; $female = "checked";}
  }
}

$datePxDoB = date('m/d/Y',strtotime($bdate));
$datePxDoB = new DateTime($datePxDoB,new DateTimeZone('Asia/Manila'));
$getAgeServ = date_diff($dateRegister,$datePxDoB);
$age = $getAgeServ->y." yr(s), ".$getAgeServ->m." mo(s), ".$getAgeServ->d." day(s)";

$queryProfile = $pdo_cf4->query("SELECT * FROM `profile` WHERE caseno='$caseno'");
$pfCount = $queryProfile->rowCount();
if ($pfCount == 0) {
  $pin='';
} else {
  while($fetchPf = $queryProfile->fetch(PDO::FETCH_ASSOC)){$pin = $fetchPf['pPatientPin'];}
}

$queryAddInfo = $pdo_kmsci->query("SELECT * FROM admissionaddinfo WHERE caseno='$caseno'");
$addInfoCount = $queryAddInfo->rowCount();
if($addInfoCount == 0){
  $chiefcomplaint = '';
  $historyofpresentillness = '';
  $pastmedicalhistory ='';

} else {
  while($fetchAddInfo = $queryAddInfo->fetch(PDO::FETCH_ASSOC)){
    $chiefcomplaint = $fetchAddInfo['chiefcomplaint'];
    $historyofpresentillness = $fetchAddInfo['historyofpresentillness'];
    $pastmedicalhistory = $fetchAddInfo['pastmedicalhistory'];
  }
}

$queryPreg = $pdo_cf4->query("SELECT * FROM preghist WHERE caseno='$caseno'");
$pregCount = $queryPreg->rowCount();
if ($pregCount == 0) {
  $pPregCnt = '';
  $pDeliveryCnt = '';
} else {
  while($fetchPreg = $queryPreg->fetch(PDO::FETCH_ASSOC)){
    $pPregCnt = $fetchPreg['pPregCnt'];
    $pDeliveryCnt = $fetchPreg['pDeliveryCnt'];
  }
}

$queryMenshist = $pdo_cf4->query("SELECT * FROM menshist WHERE caseno='$caseno'");
$menshistCount = $queryMenshist->rowCount();
if ($menshistCount == 0){
  $pLastMensPeriod = '';
}
while($fetchMenshist = $queryMenshist->fetch(PDO::FETCH_ASSOC)){
  $pLastMensPeriod = $fetchMenshist['pLastMensPeriod'];
}

$queryClaimInfo = $pdo_kmsci->query("SELECT * FROM claiminfoadd WHERE caseno='$caseno'");
if($queryClaimInfo->rowCount() > 0){
  $trans = $queryClaimInfo->fetch(PDO::FETCH_ASSOC);
  $transfer = $trans['hci'];
  $hciyes = $trans['hciyes'];
  $hcino = $trans['hcino'];
  $reason = $trans['reasons'];
}else{
  $transfer="";
  $hciyes="";
  $hcino="";
  $reason = "";
}

if(!empty($hcino) && $hcino == "checked" && empty($hciyes)){ $no = 'checked'; $yes = ''; }
else{ $no = ''; $yes = 'checked'; }

$sqlcourseward = $pdo_cf4->query("SELECT * FROM courseward WHERE caseno = '$caseno'");
$sqlGensurvey = $pdo_kmsci->query("SELECT * FROM tsekap_lib_gen_survey WHERE LIB_STAT='1' ORDER BY GENSURVEY_ID ASC");
$sqlVital = $pdo_cf4->query("SELECT * FROM pepert WHERE caseno ='$caseno'"); $vital = $sqlVital->fetch(PDO::FETCH_ASSOC);
$sqlpagensurvey = $pdo_cf4->query("SELECT * FROM pegensurvey WHERE caseno='$caseno'"); $survey = $sqlpagensurvey->fetch(PDO::FETCH_ASSOC);
$sqlheent = $pdo_epcb->query("SELECT * FROM tsekap_lib_heent WHERE LIB_STAT='1' AND HEENT_ID NOT LIKE '99' ORDER BY SORT_NO ASC");
$sqlchest = $pdo_epcb->query("SELECT * FROM tsekap_lib_chest WHERE LIB_STAT='1' AND CHEST_ID NOT LIKE '99' ORDER BY SORT_NO ASC");
$sqlheart = $pdo_epcb->query("SELECT * FROM tsekap_lib_heart WHERE LIB_STAT='1' AND HEART_ID NOT LIKE '99' ORDER BY SORT_NO ASC");
$sqlabdomen = $pdo_epcb->query("SELECT * FROM tsekap_lib_abdomen WHERE LIB_STAT='1' AND ABDOMEN_ID NOT LIKE '99'ORDER BY SORT_NO ASC");
$sqlguie = $pdo_epcb->query("SELECT * FROM tsekap_lib_genitourinary WHERE LIB_STAT='1' AND GU_ID NOT LIKE '99' ORDER BY SORT_NO ASC");
$sqlskin = $pdo_epcb->query("SELECT * FROM tsekap_lib_skin_extremities WHERE LIB_STAT='1' AND SKIN_ID NOT LIKE '99' ORDER BY SORT_NO ASC");
$sqlneuro = $pdo_epcb->query("SELECT * FROM tsekap_lib_neuro WHERE LIB_STAT='1' AND NEURO_ID NOT LIKE '99' ORDER BY SORT_NO ASC");
$sqlPheent = $pdo_cf4->query("SELECT pHeentId FROM pemisc WHERE caseno = '$caseno' AND pHeentId <> ''"); $fetchPheent = $sqlPheent->fetch(PDO::FETCH_ASSOC); $pheent = $fetchPheent['pHeentId'];
$sqlPchest = $pdo_cf4->query("SELECT pChestId FROM pemisc WHERE caseno = '$caseno' AND pChestId <> ''"); $fetchPchest = $sqlPchest->fetch(PDO::FETCH_ASSOC); $pchest = $fetchPchest['pChestId'];
$sqlPheart = $pdo_cf4->query("SELECT pHeartId FROM pemisc WHERE caseno = '$caseno' AND pHeartId <> ''"); $fetchPheart = $sqlPheart->fetch(PDO::FETCH_ASSOC); $pheart = $fetchPheart['pHeartId'];
$sqlPabdomen = $pdo_cf4->query("SELECT pAbdomenId FROM pemisc WHERE caseno = '$caseno' AND pAbdomenId <> ''"); $fetchPabdomen = $sqlPabdomen->fetch(PDO::FETCH_ASSOC); $pabdomen = $fetchPabdomen['pAbdomenId'];
$sqlPguie = $pdo_cf4->query("SELECT pGuId FROM pemisc WHERE caseno = '$caseno' AND pGuId <> ''"); $fetchPguie = $sqlPguie->fetch(PDO::FETCH_ASSOC); $pguie = $fetchPguie['pGuId'];
$sqlPskin = $pdo_cf4->query("SELECT pSkinId FROM pemisc WHERE caseno = '$caseno' AND pSkinId <> ''"); $fetchPskin = $sqlPskin->fetch(PDO::FETCH_ASSOC); $pskin = $fetchPskin['pSkinId'];
$sqlPneuro = $pdo_cf4->query("SELECT pNeuroId FROM pemisc WHERE caseno = '$caseno' AND pNeuroId <> ''"); $fetchPneuro = $sqlPneuro->fetch(PDO::FETCH_ASSOC); $pneuro = $fetchPneuro['pNeuroId'];

$sqlPERem = $pdo_cf4->query("SELECT * FROM pespecific WHERE caseno='$caseno'");
if($sqlPERem->rowCount() == 0){ $aa = ''; $bb = ''; $cc = ''; $dd = ''; $ee = ''; $ff = ''; $gg = '';
} else {while($peremarks = $sqlPERem->fetch(PDO::FETCH_ASSOC)){ 
  $aa = $peremarks["pHeentRem"]; 
  $bb = $peremarks["pChestRem"]; 
  $cc = $peremarks["pHeartRem"]; 
  $dd = $peremarks["pAbdomenRem"]; 
  $ee = $peremarks["pGuRem"]; 
  $ff = $peremarks["pSkinRem"]; 
  $gg = $peremarks["pNeuroRem"];
  }
}
$dompdf = new Dompdf\Dompdf();
$html = "<!DOCTYPE html>
<html>
<head>
    <title>MEDICATION SHEET</title>
    <style>
        .padt20{ padding-top:20px; }
        .mlogo { width: 70px; text-align: center; position: absolute; left: 10px; border: none; }
        .maintable { width: 100%; border-collapse: collapse; font-family: Tahoma, Verdana, Segoe, sans-serif; }
        .sbtable { width: 100%; border-collapse: collapse; text-align: center; }
        .fs-11{ font-family: Tahoma, Verdana, Segoe, sans-serif; font-size:11pt; }
        .fs-10{ font-family: Tahoma, Verdana, Segoe, sans-serif; font-size:10pt; }
        .fsp-10{ font-family: Tahoma, Verdana, Segoe, sans-serif; font-size:10px; }
        .fs-9{ font-family: Tahoma, Verdana, Segoe, sans-serif; font-size:9pt; }
        .fs-8{ font-family: Tahoma, Verdana, Segoe, sans-serif; font-size:8pt; }
        .material-checkbox input[type='checkbox'] { display:inline; position:relative; opacity:0; width:0; height:0; }
        .checkbox-input{margin-bottom:10px; }
    </style>
</head>
<body>
    <img src='logo/kmsci.png' class='mlogo'>
    <table class='maintable' border='0'>
        <tr><td>
            <table border='0' class='sbtable'>
                <tr>
                    <td><span class='fs-10'><b> $branchname </b></span><br><span class='fs-9'> $branchaddr </span><br><span class='fs-9'> $branchteln </span></td>
                </tr>
            </table>
        </td></tr>
        <tr><td>
            <table class='sbtable'>
                <tr>
                    <td colspan='4' class='fs-10 padt20'><b>MEDICAL EXAMINATION SHEET</b></td>
                </tr>
            </table>
        </td></tr>
    </table>
    <table width='100%' border='1' style='border-collapse: collapse;'>
        <tr>
            <td width='75%' valign='TOP'><span class='fs-9'>Patient Address: <br><br> &nbsp;&nbsp;&nbsp;&nbsp;<b>$address</b></span></td>
            <td valign='TOP'><span class='fs-9'>Case #: <b><u> $employerno</u></b> <br><br> Room #: <b><u>$room</u></b></span></td>
        </tr>
        <tr>
          <td rowspan='2' valign='top'>
            <span class='fs-9'>
              Past Medical/Personal/Social/Family History:<b>&nbsp; $pastmedicalhistory</b><br><br>
              Referral/Consult: <br><br>
              Travel History (Abroad) Place/s: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date/s:
            </span>
          </td>
          <td valign='top'><span class='fs-9'>Primary AP: <b><u> $apName</u></b></span></td>
        </tr>
        <tr>
          <td valign='top'><span class='fs-9'>Co-Manage: <br> <b><u> </u></b></span></td>
        </tr>
        <tr>
            <td colspan='2' style='text-align:center; background-color:#D3D3D3;'><span class='fs-9'><b>II. PATIENT'S DATA</b></span></td>
        </tr>
        <tr>
          <td>
            <span class='fs-9'> 1. Name of Patient </span><br>
            <span class='fs-9'><b> &nbsp;&nbsp;&nbsp;&nbsp; $name</b></span>
          </td>
          <td valign='TOP'>
            <span class='fs-9'> 2. PIN </span><br>
            <span class='fs-9'><b> &nbsp;&nbsp;&nbsp;&nbsp; $pin</b></span>
          </td>
        </tr>
        <tr>
          <td colspan='2'>
            <span class='fs-9'><small>&nbsp;&nbsp;&nbsp;&nbsp; Last Name | First Name | Middle Name</small></span>
          </td>
        </tr>
        <tr>
          <td rowspan='2' valign='TOP'><span class='fs-9'> 5. Chief Complaint: <br> &nbsp;&nbsp;&nbsp;&nbsp; <b> $chiefcomplaint</b></span><br></td>
          <td valign='TOP'><span class='fs-9'> Age: <br><b><u>$age</u></b></span></td>
        </tr>
        <tr>
          <td valign='TOP'>
            <table width='100%' border='0' cellpadding='0' cellspacing='0'>
              <tr>
                  <td style='width:20%'><span class='fs-9'>Sex:</span></td>
                  <td style='width:40%'>
                    <div class='checkbox-container'>
                      <label class='material-checkbox'>
                        <input type='checkbox' class='checkbox-input' $male>
                        <span class='checkmark'></span>
                        <span class='description fs-9'> Male</span>
                      </label>
                    </div>
                  </td>
                  <td style='width:40%'>
                    <div class='checkbox-container'>
                      <label class='material-checkbox'>
                        <input type='checkbox' class='checkbox-input' $female>
                        <span class='checkmark'></span>
                        <span class='description fs-9'> Female</span>
                      </label>
                    </div>
                  </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td>
            <table width='100%' border='1' style='border-collapse: collapse;'>
              <tr>
                <td width='50%' style='height:70px; max-height:100px; word-wrap: break-word;' valign='TOP'><span class='fs-8'> Admitting Diagnosis: <br> &nbsp;&nbsp;&nbsp;&nbsp; <b>$admittingdiagnosis</b></span></td>
                <td width='50%' style='height:70px; max-height:100px; word-wrap: break-word;' valign='TOP'><span class='fs-8'> Final Diagnosis: <br> &nbsp;&nbsp;&nbsp;&nbsp; <b>$finaldiagnosis</b></span></td>
              </tr>
            </table>
          </td>
          <td>
            <table width='100%' border='0' cellpadding='0' cellspacing='0'>
              <tr>
                <td style='height:35px; max-height:80px; word-wrap: break-word;' valign='TOP'><span class='fs-9'> 8.a. 1st Case Rate Code <br><b> </b></span></td>
              </tr>
              <tr>
                <td style='height:35px; max-height:80px; word-wrap: break-word;' valign='TOP'><span class='fs-9'> 8.b. 2st Case Rate Code <br><b> </b></span></td>
              </tr>
            </table>
          </td>
      </tr>
      <tr>
        <td colspan='2'>
          <span class='fs-9'>
            9.a. Date admitted &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            9.b. Time admitted:<br><b>$dateadmit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $timeadmit</b>
          </span>
        </td>
      </tr>
      <tr>
        <td colspan='2'>
          <span class='fs-9'>
            10.a. Date discharged&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            10.b. Time discharged:<br><b>$datedischarged&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $timedischarged</b>
          </span>
        </td>
      </tr>
      <tr>
        <td colspan='2' style='text-align:center; background-color:#D3D3D3;'><span class='fs-9'><b>III. REASON FOR ADMISSION</b></span></td>
      </tr>
      <tr>
        <td colspan='2' style='height:50px; max-height:100px; word-wrap: break-word;' valign='TOP'><span class='fs-8'> 1.History of Present Illness: <br>&nbsp;&nbsp;&nbsp;&nbsp;<b>$historyofpresentillness</b></span></td>
      </tr>
      <tr>
        <td colspan='2' style='height:auto;' valign='TOP'>
          <table width='100%' border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse;'>
          <tr>
            <td valign='top' style='height:40px; max-height:80px; word-wrap: break-word;'>
              <span class='fs-9'>2.a. Pertinent Past Medical History: <br>&nbsp;&nbsp;&nbsp;&nbsp;<b>$pastmedicalhistory<b></span>
            </td>
          </tr>
          <tr>
            <td style='height:30px; max-height:30px; overflow: hidden; word-wrap: break-word;'>
                <table width='100%' border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse;'>
                  <tr>
                    <td valig='top' colspan='5' style='height:15px; width:15%' class='fs-9'> 2.b. OB/GYN History: </td>
                  </tr>    
                  <tr>
                    <td class='fs-9' style='height:25px; width:15%'>G: &nbsp;&nbsp;<b>$pPregCnt</b></td>
                    <td class='fs-9' style='height:25px; width:15%'>P: &nbsp;&nbsp;<b>$pDeliveryCnt</b></td>
                    <td class='fs-9' style='height:25px; width:15%'>LMP: &nbsp;&nbsp;<b>$pLastMensPeriod</b></td>
                    <td class='fs-9' style='height:25px; width:8%'>
                      <div class='checkbox-container'>
                        <label class='material-checkbox'>
                            <input type='checkbox' class='checkbox-input' $checked>
                            <span class='checkmark'></span>
                            <span class='description'> N/A</span>
                        </label>
                      </div>
                    </td>
                    <td class='fs-9' style='height:25px; width:47%'>OTHERS: &nbsp;&nbsp;</td>
                  </tr>
                </table>
            </td>
          </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan='2' style='height: 100px;' valign='TOP'><span class='fs-9'>3. Pertinent Signs and Symptoms on Admission: <br>
          <table width='99%' align='center' border='0' style='border-collapse:collapse; margin-bottom:5px;' cellpadding='0' cellspacing='0'>
            <tr>";
  $i=1;
  $x = 0;
  $querySymtom = $pdo_kmsci->query("SELECT * FROM tsekap_lib_symptoms WHERE LIB_STAT = '1' AND SYMPTOMS_ID NOT IN('X','38') ORDER BY SYMPTOMS_DESC ASC");
  while($row2 = $querySymtom->fetch(PDO::FETCH_ASSOC)) {
  $SYMPTOMS_ID = $row2["SYMPTOMS_ID"];
  $SYMPTOMS_DESC = $row2["SYMPTOMS_DESC"];
  $SYMPTOMS_ID2 = $SYMPTOMS_ID.";";
  $x++;

  $subj = $pdo_cf4->query("SELECT * FROM subjective WHERE caseno='$caseno'");
  if ($subj->rowCount() == 0){
    $symp = explode(";", '');
    $pPainSite='';
    $pOtherComplaint='';
    $c=0;
    $countsymp=0;
  } else {
      while($myrow = $subj->fetch(PDO::FETCH_ASSOC)){
        $symp = explode(";", $myrow['pSignsSymptoms']);
        $pPainSite = $myrow['pPainSite'];
        $pOtherComplaint = $myrow['pOtherComplaint'];
        $countsymp = count($symp);
      }
  }

  $sqlpainSite = $pdo_cf4->query("SELECT * FROM subjective WHERE caseno='$caseno'");
  if($sqlpainSite->rowCount() == 0){ $pp=''; }
  else{
    while($painsite = $sqlpainSite->fetch(PDO::FETCH_ASSOC)){
      $pp = $painsite["pPainSite"];
    }
  }

  $c=0;
  for($d=0; $d<$countsymp; $d++){
    if($SYMPTOMS_ID == $symp[$d]){$c++;}
  }

  if($c > 0){ $checked = "checked"; } else{ $checked = "";}
  if($pOtherComplaint != ""){$checked2 = "checked";} else{$checked2 = "";}
  if($aa != ""){ $heentmarkOthers = "checked"; } else{ $heentmarkOthers = "";}
  if($bb != ""){ $chestmarkOthers = "checked"; } else{ $chestmarkOthers = "";}
  if($cc != ""){ $heartmarkOthers = "checked"; } else{ $heartmarkOthers = "";}
  if($dd != ""){ $abdomenmarkOthers = "checked"; } else{ $abdomenmarkOthers = "";}
  if($ee != ""){ $guiemarkOthers = "checked"; } else{ $guiemarkOthers = "";}
  if($ff != ""){ $skinmarkOthers = "checked"; } else{ $skinmarkOthers = "";}
  if($gg != ""){ $neuromarkOthers = "checked"; } else{ $neuromarkOthers = "";}
  if($pp != ""){ $checkedp = "checked";} else{ $checkedp = "";}
  $html .= "<td width='25%' style='height:auto; align-items:center;'>
                <div class='checkbox-container'>
                    <label class='material-checkbox'>
                        <input type='checkbox' class='checkbox-input' $checked>
                        <span class='checkmark'></span>
                        <span class='description fsp-10'>$SYMPTOMS_DESC</span>
                    </label>
                </div>
            </td>";

      if ($i % 4 == 0) {
          $html .= "</tr><tr>";
      }

      if ($SYMPTOMS_DESC == "ORTHOPNEA") {
        $blankColumnsNeeded = 4 - ($i % 4);
        for ($j = 0; $j < $blankColumnsNeeded; $j++) {
            $html .= "<td width='25%'></td>";
        }
        $html .= "</tr>
                    <tr>
                      <td colspan='4' style='height:auto;'>
                        <div class='checkbox-container'>
                          <label class='material-checkbox'>
                              <input type='checkbox' class='checkbox-input' $checkedp>
                              <span class='checkmark'></span>
                              <span class='description fsp-10'>PAIN: <b>$pPainSite</b></span>
                          </label>
                        </div>
                      </td>
                    </tr>
                  <tr>";
                  $i = 0;
      }
  $i++;
  }
        $html .="<td colspan='4' style='height:auto;'>
                  <div class='checkbox-container'>
                    <label class='material-checkbox'>
                        <input type='checkbox' class='checkbox-input' $checked2>
                        <span class='checkmark'></span>
                        <span class='description fsp-10'>OTHERS: <b>$pOtherComplaint</b></span>
                    </label>
                  </div>
                </td>";            
              $html .= "</tr>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan='2' valign='TOP'>
        <span class='fs-9'>4. Referred from another Health Care Institution (HCI):</span><br>
         <table width='100%' cellpadding='0' cellpadding='0' border='0'>
            <tr>
              <td style='width:10%'>
                <div class='checkbox-container'>
                  <label class='material-checkbox'>
                      <input type='checkbox' class='checkbox-input' $no>
                      <span class='checkmark'></span>
                      <span class='description fs-9'>No</span>
                  </label>
                </div>
              </td>
              <td style='width:90%'>
                <div class='checkbox-container'>
                  <label class='material-checkbox'>
                      <input type='checkbox' class='checkbox-input' $yes>
                      <span class='checkmark'></span>
                  </label>
                  <span class='fs-9'>Yes, Specify Reason: <u style='text-transform:uppercase;'><b>$reason</b></u></span>
                </div>
              </td>
            </tr>
          </table><br>
          <span class='fs-9' style='margin-left:20px'>Name of Originating HCI: <u style='text-transform:uppercase'><b>$transfer</b></u></span>
        </td>
     </tr>
     <tr>
      <td colspan='2' valign='TOP'>
        <span class='fs-9'> 5. Physical Examination on Admission (Pertinent Findings per System)</span><br>
        <table width='99%' align='center' border='0' style='border-collapse:collapse; margin-bottom:5px;' cellpadding='0' cellspacing='0'>
          <tr>
            <td style='width:15%'><span class='fs-9'> General Survey:</span></td>
            <td style='width:85%; white-space:nowrap;'>
            
          ";
          while($gensurvey = $sqlGensurvey->fetch(PDO::FETCH_ASSOC)){
            if($survey['pGenSurveyId'] == $gensurvey['GENSURVEY_ID']){ $survCheck = 'checked'; }else{ $survCheck = '';}
            $html .= "<div class='checkbox-container column' style='display:inline-block; width:160px; margin-right:10px; margin-top:3px;'>
                        <label class='material-checkbox'>
                          <input type='checkbox' class='checkbox-input' $survCheck>
                          <span class='checkmark'></span>
                          <span class='description fs-9'><b>".$gensurvey['GENSURVEY_DESC']."</b></span>
                        </label>
                      </div>";
          }
          $html .= "
              <span class='fs-9'> Remarks: </span>
            </td>
          </tr>
          <tr>
            <td colspan='2'>
              <span class='fs-9'>Vital Sign: </span>&nbsp;&nbsp;&nbsp;&nbsp;
              <span class='fs-9'>BP: <b>".$vital['pSystolic']."/".$vital['pDiastolic']." mmHg</b></span>&nbsp;&nbsp;&nbsp;&nbsp;
              <span class='fs-9'>HR: <b>".$vital['pHr']."/min </b></span>&nbsp;&nbsp;&nbsp;&nbsp;
              <span class='fs-9'>RR: <b>".$vital['pRr']."/min </b></span>&nbsp;&nbsp;&nbsp;&nbsp;
              <span class='fs-9'>Temp: <b>".$vital['pTemp']."&#176;C</b></span>&nbsp;&nbsp;&nbsp;&nbsp;
              <span class='fs-9'>Height: <b>".$vital['pHeight']." cm </b></span>&nbsp;&nbsp;&nbsp;&nbsp;
              <span class='fs-9'>Weight: <b>".$vital['pWeight']." kg </b></span>
            </td> 
          </tr>
        </table>
      </td>
     </tr>
     <tr>
      <td colspan='2' valign='TOP'>
        <table width='99%' align='center' border='0' style='border-collapse:collapse; margin-bottom:5px;' cellpadding='0' cellspacing='0'>
          <tr>
            <td valign='TOP' style='width:15%'>
              <table width='100%' border='0'>
                <tr>
                  <td valign='TOP'><span class='fs-9'><b>HEENT<b></span></td>
                </tr>
              </table>
            </td>
            <td valign='TOP' style='width:85%'>
              <table width='100%' border='0'>
                <tr>";
                $l=1;
                while($heent = $sqlheent->fetch(PDO::FETCH_ASSOC)){
                  if($pheent == $heent['HEENT_ID']){ $heentmark = 'checked';} else { $heentmark = ''; }
                  $html .="<td style='width:28%'>
                            <div class='checkbox-container'>
                              <label class='material-checkbox'>
                                  <input type='checkbox' class='checkbox-input' $heentmark>
                                  <span class='checkmark'></span>
                                  <span class='description fs-9'>".$heent['HEENT_DESC']."</span>
                              </label>
                            </div>
                          </td>";
                  if($l % 3 == 0){
                      $html .="</tr><tr>";
                  }
                  if ($l % 8 == 0) {
                    break;
                  }
                  $l++;
                }
                  $html .="</tr><tr>
                            <td colspan='3'>
                              <div class='checkbox-container'>
                                <label class='material-checkbox'>
                                    <input type='checkbox' class='checkbox-input' $heentmarkOthers>
                                    <span class='checkmark'></span>
                                    <span class='description fs-9'>Others: <b><u>$aa</u></b></span>
                                </label>
                              </div>
                            </td>
                          </tr>";
              $html .= "</table>
            </td>
          </tr>
          <tr>
            <td valign='TOP' style='width:15%'>
              <table width='100%' border='0'>
                <tr>
                  <td valign='TOP'><span class='fs-9'><b>CHEST/ LUNGS:<b></span></td>
                </tr>
              </table>
            </td>
            <td valign='TOP' style='width:85%'>
              <table width='100%' border='0'>
              <tr>";
              $l=1;
              while($chest = $sqlchest->fetch(PDO::FETCH_ASSOC)){
                if($pchest == $chest['CHEST_ID']){ $chestmark = 'checked'; } else { $chestmark = ''; }
                $html .="<td style='width:28%'>
                          <div class='checkbox-container'>
                            <label class='material-checkbox'>
                                <input type='checkbox' class='checkbox-input' $chestmark>
                                <span class='checkmark'></span>
                                <span class='description fs-9'>".$chest['CHEST_DESC']."</span>
                            </label>
                          </div>
                        </td>";
                if($l % 3 == 0){
                    $html .="</tr><tr>";
                }
                if ($l % 8 == 0) {
                  break;
                }
                $l++;
              }
            $html .="</tr><tr>
                      <td colspan='3'>
                        <div class='checkbox-container'>
                          <label class='material-checkbox'>
                              <input type='checkbox' class='checkbox-input' $chestmarkOthers>
                              <span class='checkmark'></span>
                              <span class='description fs-9'>Others: <b><u>$bb</u></b></span>
                          </label>
                        </div>
                      </td>
                    </tr>";
            $html .="</table>
          </td>
        </tr>
        <tr>
          <td valign='TOP' style='width:15%'>
            <table width='100%' border='0'>
              <tr>
                <td valign='TOP'><span class='fs-9'><b>CVS:<b></span></td>
              </tr>
            </table>
          </td>
          <td valign='TOP' style='width:85%'>
            <table width='100%' border='0'>
              <tr>";
              $l=1;
              while($heart = $sqlheart->fetch(PDO::FETCH_ASSOC)){
                if($pheart[0]==$heart['HEART_ID']){ $heartmark = 'checked'; }else { $heartmark = ''; }
                $html .="<td style='width:28%'>
                          <div class='checkbox-container'>
                            <label class='material-checkbox'>
                                <input type='checkbox' class='checkbox-input' $heartmark>
                                <span class='checkmark'></span>
                                <span class='description fs-9'>".$heart['HEART_DESC']."</span>
                            </label>
                          </div>
                        </td>";
                if($l % 3 == 0){
                    $html .="</tr><tr>";
                }
                if ($l % 8 == 0) {
                  break;
                }
                $l++;
              }
            $html .="</tr><tr>
                      <td colspan='3'>
                        <div class='checkbox-container'>
                          <label class='material-checkbox'>
                              <input type='checkbox' class='checkbox-input' $heartmarkOthers>
                              <span class='checkmark'></span>
                              <span class='description fs-9'>Others: <b><u>$cc</u></b></span>
                          </label>
                        </div>
                      </td>
                    </tr>";
            $html .="</table>
          </td>
        </tr>
        <tr>
          <td valign='TOP' style='width:15%'>
            <table width='100%' border='0'>
              <tr>
                <td valign='TOP'><span class='fs-9'><b>ABDOMEN:<b></span></td>
              </tr>
            </table>
          </td>
          <td valign='TOP' style='width:85%'>
            <table width='100%' border='0'>
              <tr>";
              $l=1;
              while($abdomen = $sqlabdomen->fetch(PDO::FETCH_ASSOC)){
                if($pabdomen==$abdomen['ABDOMEN_ID']){ $abdomenmark = 'checked'; }else { $abdomenmark = ''; }
                $html .="<td style='width:28%'>
                          <div class='checkbox-container'>
                            <label class='material-checkbox'>
                                <input type='checkbox' class='checkbox-input' $abdomenmark>
                                <span class='checkmark'></span>
                                <span class='description fs-9'>".$abdomen['ABDOMEN_DESC']."</span>
                            </label>
                          </div>
                        </td>";
                if($l % 3 == 0){
                    $html .="</tr><tr>";
                }
                if ($l % 8 == 0) {
                  break;
                }
                $l++;
              }
            $html .="</tr><tr>
                      <td colspan='3'>
                        <div class='checkbox-container'>
                          <label class='material-checkbox'>
                              <input type='checkbox' class='checkbox-input' $abdomenmarkOthers>
                              <span class='checkmark'></span>
                              <span class='description fs-9'>Others: <b><u>$dd</u></b></span>
                          </label>
                        </div>
                      </td>
                    </tr>";
            $html .="</table>
          </td>
        </tr>
        <tr>
          <td valign='TOP' style='width:15%'>
            <table width='100%' border='0'>
              <tr>
                <td valign='TOP'><span class='fs-9'><b>GU (IE):<b></span></td>
              </tr>
            </table>
          </td>
          <td valign='TOP' style='width:85%'>
            <table width='100%' border='0'>
              <tr>";
              $l=1;
              while($guie = $sqlguie->fetch(PDO::FETCH_ASSOC)){
                if($pguie==$guie['GU_ID']){ $guiemark = 'checked'; } else { $guiemark = ''; }
                $html .="<td style='width:28%'>
                          <div class='checkbox-container'>
                            <label class='material-checkbox'>
                                <input type='checkbox' class='checkbox-input' $guiemark>
                                <span class='checkmark'></span>
                                <span class='description fs-9'>".$guie['GU_DESC']."</span>
                            </label>
                          </div>
                        </td>";
                if($l % 3 == 0){
                    $html .="</tr><tr>";
                }
                if ($l % 8 == 0) {
                  break;
                }
                $l++;
              }
            $html .="</tr><tr>
                      <td colspan='3'>
                        <div class='checkbox-container'>
                          <label class='material-checkbox'>
                              <input type='checkbox' class='checkbox-input' $guiemarkOthers>
                              <span class='checkmark'></span>
                              <span class='description fs-9'> Others: <b><u>$ee</u></b></span>
                          </label>
                        </div>
                      </td>
                    </tr>";
            $html .="</table>
          </td>
        </tr>
        <tr>
          <td valign='TOP' style='width:15%'>
            <table width='100%' border='0'>
              <tr>
                <td valign='TOP'><span class='fs-9'><b>SKIN/<br>EXTREMITIES:<b></span></td>
              </tr>
            </table>
          </td>
          <td valign='TOP' style='width:85%'>
            <table width='100%' border='0'>
              <tr>";
              $l=1;
              while($skin = $sqlskin->fetch(PDO::FETCH_ASSOC)){
                if($pskin==$skin['SKIN_ID']){ $skinmark = 'checked'; } else { $skinmark = ''; }
                $html .="<td style='width:28%'>
                          <div class='checkbox-container'>
                            <label class='material-checkbox'>
                                <input type='checkbox' class='checkbox-input' $skinmark>
                                <span class='checkmark'></span>
                                <span class='description fs-9'>".$skin['SKIN_DESC']."</span>
                            </label>
                          </div>
                        </td>";
                if($l % 3 == 0){
                    $html .="</tr><tr>";
                }
                if ($l % 8 == 0) {
                  break;
                }
                $l++;
              }
            $html .="</tr><tr>
                      <td colspan='3'>
                        <div class='checkbox-container'>
                          <label class='material-checkbox'>
                              <input type='checkbox' class='checkbox-input' $skinmarkOthers>
                              <span class='checkmark'></span>
                              <span class='description fs-9'>Others: <b><u>$ff</u></b></span>
                          </label>
                        </div>
                      </td>
                    </tr>";
          $html .= "</table>
          </td>
        </tr>
        <tr>
          <td valign='TOP' style='width:15%'>
              <table width='100%' border='0'>
                <tr>
                  <td valign='TOP'><span class='fs-9'><b>NEURO-EXAM:<b></span></td>
                </tr>
              </table>
            </td>
            <td valign='TOP' style='width:85%'>
              <table width='100%' border='0'>
              <tr>";
              $l=1;
              while($neuro = $sqlneuro->fetch(PDO::FETCH_ASSOC)){
                if($pneuro == $neuro['NEURO_ID']){ $neuromark = 'checked'; } else { $neuromark = ''; }
                $html .="<td style='width:28%'>
                          <div class='checkbox-container'>
                            <label class='material-checkbox'>
                                <input type='checkbox' class='checkbox-input' $neuromark>
                                <span class='checkmark'></span>
                                <span class='description fs-9'>".$neuro['NEURO_DESC']."</span>
                            </label>
                          </div>
                        </td>";
                if($l % 3 == 0){
                    $html .="</tr><tr>";
                }
                if ($l % 8 == 0) {
                  break;
                }
                $l++;
              }
            $html .="</tr><tr>
                      <td colspan='3'>
                        <div class='checkbox-container'>
                          <label class='material-checkbox'>
                              <input type='checkbox' class='checkbox-input' $neuromarkOthers>
                              <span class='checkmark'></span>
                              <span class='description fs-9'>Others: <b><u>$gg</u></b></span>
                          </label>
                        </div>
                      </td>
                    </tr>";
            $html .="</table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td colspan='2' style='text-align:center; background-color:#D3D3D3;'>
        <span class='fs-9'><b> IV. COURSE IN THE WARD (Attach photocopy of laboratory/image results)</b></span>
      </td>
    </tr>
    <tr>
      <td colspan='2' valign='TOP'>
        <table width='100%' border='1' style='border-collapse: collapse;'>
          <tr>
            <td width='25%' style='font-size: 13px; font=Tahoma11black; text-align: center'><span class='fs-9'>DATE</span></td>
            <td width='80%' style='font-size: 13px; font=Tahoma11black; text-align: center'><span class='fs-9'>DOCTOR'S ORDER/ACTION</span></td>
          </tr>
          <tr><td colspan='2'><span class='fs-9'>SURGICAL PROCEDURE/RVS/CODE (Attach photocopy of OR technique): </span></td></tr>
        </table>
      </td>
    </tr>
    <tr>
      <td colspan='2' style='text-align:center; background-color:#D3D3D3;'>
        <span class='fs-9'><b> V. DRUGS/MEDICINES </b></span>
      </td>
    </tr>
    <tr>
      <td colspan='2' valign='TOP'>
        <table width='100%' border='1' style='border-collapse: collapse;'>
          <tr style='text-align: center;'>
            <td width='25%'><span class='fs-9'>Generic Name</span></td>
            <td width='50%'><span class='fs-9'>Quantity/Dosage/Route</span></td>
            <td width='25%'><span class='fs-9'>Total Cost</span></td>
          </tr>
        </table>
        <span class='fs-9'> <b>Number of record/s: </b></span>
      </td>
    </tr>
    <tr>
      <td colspan='2' style='text-align:center; background-color:#D3D3D3;'>
        <span class='fs-9'><b>  VI. OUTCOME OF TREATMENT</b></span>
      </td>
    </tr>
    <tr>
      <td colspan='2' valign='top'>
        <table width='100%' border='0' style='border-collapse: collapse;'>
          <tr>
            <td style='width:20%'>
              <div class='checkbox-container'>
                <label class='material-checkbox'>
                    <input type='checkbox' class='checkbox-input'>
                    <span class='checkmark'></span>
                    <span class='description fs-9'> IMPROVED</span>
                </label>
              </div>
            </td>
            <td style='width:20%'>
              <div class='checkbox-container'>
                <label class='material-checkbox'>
                    <input type='checkbox' class='checkbox-input'>
                    <span class='checkmark'></span>
                    <span class='description fs-9'> HAMA</span>
                </label>
              </div>
            </td>
            <td style='width:20%'>
              <div class='checkbox-container'>
                <label class='material-checkbox'>
                    <input type='checkbox' class='checkbox-input'>
                    <span class='checkmark'></span>
                    <span class='description fs-9'> EXPIRED</span>
                </label>
              </div>
            </td>
            <td style='width:20%'>
              <div class='checkbox-container'>
                <label class='material-checkbox'>
                    <input type='checkbox' class='checkbox-input'>
                    <span class='checkmark'></span>
                    <span class='description fs-9'> ABSCONDED</span>
                </label>
              </div>
            </td>
            <td style='width:20%'>
              <div class='checkbox-container'>
                <label class='material-checkbox'>
                    <input type='checkbox' class='checkbox-input'>
                    <span class='checkmark'></span>
                    <span class='description fs-9'> TRANSFERRED</span>
                </label>
              </div>
            </td>
          </tr>
          <tr>
            <td colspan='5'> <span class='fs-9'>Specify reason:____________________________________________________</span></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td colspan='2' style='text-align:center; background-color:#D3D3D3;'>
        <span class='fs-9'><b>VII. CERTIFICATION OF HEALTH CARE PROFESSIONAL</b></span>
      </td>
    </tr>
    <tr>
      <td colspan='2'>    
        <table width='100%' cellpadding='0' cellspacing='0' style='border-collapse:collapse;' border='0'>
          <tr>
            <td colspan='5'><span class='fs-9'><br>&nbsp; Certification of Attending Health Care Professional: </span><br></td>
          </tr>
          <tr>
            <td colspan='5' style='font-style:italic; text-align:center'>
              <span class='fs-10'> I certify that the above information given in this form, including all attachments, are true and correct. </span>  
            </td>
          </tr>
          <tr>
            <td style='width:5%; padding-top:50px;'></td>
            <td style='width:75%; border-bottom:1px solid #000;'></td>
            <td style='width:5%'></td>
            <td style='width:10%; border-bottom:1px solid #000;'></td>
            <td style='width:5%'></td>
          </tr>
          <tr>
            <td style='width:5%'></td>
            <td style='width:70%; text-align:center'> <span class='fs-9'> Signature over Printed Name of Attending Health Care Professional</span></td>
            <td style='width:5%'></td>
            <td style='width:15%; text-align:center'> <span class='fs-9'> Date Signed</span></td>
            <td style='width:5%'></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <table width='100%' cellpadding='0' cellspacing='0' border='0' style='margin-top:20px;'>
      <tr>
        <td style='text-align:left; width:50%'><span class='fs-9'> Prepared By: <b>$lginuser</b> </span></td>
        <td style='text-align:right; width:50%'><span class='fs-9'> Prepared Date: <b>".date('F d, Y')."<b></span></td>
      </tr>
  </table>
  </body>
</html>
";

$dompdf->loadHtml($html);
$dompdf->setPaper('folio', 'portrait');
$dompdf->render();
$dompdf->stream('Newborn PF.pdf', array('Attachment' => false));
?>