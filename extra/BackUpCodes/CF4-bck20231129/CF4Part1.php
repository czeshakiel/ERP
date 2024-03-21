<link href="res/ico/favicon.png" rel="shortcut icon" type="image/x-icon" />
<link href="res/css/normalize.css" rel="stylesheet" type="text/css" />
<link href="res/css/omis.css" rel="stylesheet" type="text/css" />
<link href="res/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="res/css/styles.css" rel="stylesheet" type="text/css" />
<link href="res/css/jquery-ui-1.11.4.css" rel="stylesheet">
<link href="res/datatable/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
<style>
.unhide{display: block;}
.hide{display: none;}
</style>

<?php
$username=$sun;
$password=$spw;

include('function.php');
include('function_global.php');

ini_set("display_errors","On");

$source="2";

if(!isset($_POST['savep1'])){
mysqli_query($conncf4,"SET NAMES 'utf8'");
$enlsql=mysqli_query($conncf4,"SELECT `pCivilStatus`, `pPatientDob`, `pPatientPin`, `pPatientFname`, `pPatientMname`, `pPatientLname`, `pPatientExtname`, `pPatientType`, `pPatientSex`, `pPatientDob` FROM `enlistment` WHERE `caseno`='$caseno'");
$enlcount=mysqli_num_rows($enlsql);
if($enlcount!=0){
  $enlfetch=mysqli_fetch_array($enlsql);
  $cvsrel=$enlfetch['pCivilStatus'];
  $pin=$enlfetch['pPatientPin'];
  $ln=strtoupper($enlfetch["pPatientLname"]);
  $fn=strtoupper($enlfetch["pPatientFname"]);
  $mn=strtoupper($enlfetch["pPatientMname"]);
  $suffix=strtoupper($enlfetch["pPatientExtname"]);
  $patdob=$enlfetch["pPatientDob"];
  $gn=strtoupper($enlfetch["pPatientSex"]);
  $ptype=$enlfetch['pPatientType'];

  if($cvsrel=="S"){$cvs="SINGLE";$cvss1="selected";$cvss2="";$cvss3="";$cvss4="";$cvss5="";}
  else if($cvsrel=="M"){$cvs="MARRIED";$cvss1="";$cvss2="selected";$cvss3="";$cvss4="";$cvss5="";}
  else if($cvsrel=="W"){$cvs="WIDOWED";$cvss1="";$cvss2="";$cvss3="selected";$cvss4="";$cvss5="";}
  else if($cvsrel=="X"){$cvs="SEPARATED";$cvss1="";$cvss2="";$cvss3="";$cvss4="selected";$cvss5="";}
  else if($cvsrel=="A"){$cvs="ANNULED";$cvss1="";$cvss2="";$cvss3="";$cvss4="";$cvss5="selected";}
  else{$cvs="";$cvss1="";$cvss2="";$cvss3="";$cvss4="";$cvss5="";}

  if($pin==""){
    $aysql=mysqli_query($conn,"SELECT `identificationno` FROM `claiminfo` WHERE `caseno`='$caseno'");
    if(mysqli_num_rows($aysql)>0){
      $ayfetch=mysqli_fetch_array($aysql);
      $pin=$ayfetch['identificationno'];
    }
  }
}
else{
  $azsql=mysqli_query($conn,"SELECT * FROM `admission` WHERE `caseno`='$caseno'");
  $azfetch=mysqli_fetch_array($azsql);
  $patid=$azfetch['patientidno'];
  $cvs=$azfetch['stat1'];

  $kcsspl=preg_split("/\-/",$caseno);
  $kcs=$kcsspl[0];

  if($kcs=="I"){$ptype="I";}else{$ptype="O";}

  $aysql=mysqli_query($conn,"SELECT `identificationno` FROM `claiminfo` WHERE `caseno`='$caseno'");
  if(mysqli_num_rows($aysql)>0){
    $ayfetch=mysqli_fetch_array($aysql);
    $pin=$ayfetch['identificationno'];
  }
  else{
    $pin="";
  }

  $axsql=mysqli_query($conn,"SELECT * FROM `patientprofile` WHERE `patientidno`='$patid'");
  $axfetch=mysqli_fetch_array($axsql);
  $ln=strtoupper($axfetch["lastname"]);
  $fn=strtoupper($axfetch["firstname"]);
  $mn=strtoupper($axfetch["middlename"]);
  $suffix=strtoupper($axfetch["suffix"]);
  $patdob=$axfetch["dateofbirth"];
  $gn=strtoupper($axfetch["sex"]);

  if($cvs=="SINGLE"){$cvsrel="S";$cvss1="selected";$cvss2="";$cvss3="";$cvss4="";$cvss5="";}
  else if($cvs=="MARRIED"){$cvsrel="M";$cvss1="";$cvss2="selected";$cvss3="";$cvss4="";$cvss5="";}
  else if($cvs=="WIDOWED"){$cvsrel="W";$cvss1="";$cvss2="";$cvss3="selected";$cvss4="";$cvss5="";}
  else if($cvs=="SEPARATED"){$cvsrel="X";$cvss1="";$cvss2="";$cvss3="";$cvss4="selected";$cvss5="";}
  else if($cvs=="ANNULED"){$cvsrel="A";$cvss1="";$cvss2="";$cvss3="";$cvss4="";$cvss5="selected";}
  else{$cvsrel="";$cvss1="";$cvss2="";$cvss3="";$cvss4="";$cvss5="";}
}


$avsql=mysqli_query($conn,"SELECT `chiefcomplaint`, `historyofpresentillness`, `pastmedicalhistory` FROM `admissionaddinfo` WHERE `caseno`='$caseno'");
if(mysqli_num_rows($avsql)>0){
  $avfetch=mysqli_fetch_array($avsql);
  $chiefcomplaint=$avfetch['chiefcomplaint'];
  $historyofpresentillness=$avfetch['historyofpresentillness'];
  $pastmedicalhistory=$avfetch['pastmedicalhistory'];
}
else{
  $chiefcomplaint="";
  $historyofpresentillness="";
  $pastmedicalhistory="";
}


/*$subsql=mysqli_query($conncf4,"SELECT `pChiefComplaint`, `pIllnessHistory` FROM `subjective` WHERE `caseno`='$caseno'");
if(mysqli_num_rows($subsql)==0){
  $chiefcomplaint="";
  $historyofpresentillness="";
}
else{
  $subfetch=mysqli_fetch_array($subsql);
  $chiefcomplaint=$subfetch["pChiefComplaint"];
  $historyofpresentillness=$subfetch["pIllnessHistory"];
}

$mhspsql=mysqli_query($mycon5,"SELECT `pSpecificDesc` FROM `mhspecific` WHERE `caseno`='$caseno'");
if(mysqli_num_rows($mhspsql)==0){
  $pastmedicalhistory="";
}
else{
  $mhspfetch=mysqli_fetch_array($mhspsql);
  $pastmedicalhistory=$mhspfetch["pSpecificDesc"];
}*/


if($gn=="F"){$hideunhide="unhide";}
else if($gn=="M"){$hideunhide="hide";}
else{$hideunhide="hide";}

$ln=str_replace("'","",$ln);

$bds=preg_split("/\-/",$patdob);
$bdm=$bds[1];
$bdd=$bds[2];
$bdy=$bds[0];

$pbdbg="";
$pbdtitle="";

$rnd=strtoupper(substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 3));
$pHospitalTransmittalNo="KMS".date("YmdH").$rnd;

$listHeents = listHeent();
$listChests = listChest();
$listHearts = listHeart();
$listAbs = listAbdomen();
$listNeuro = listNeuro();
$listGenitourinary = listGenitourinary();
$listRectal = listDigitalRectal();
$listSkinExtremities = listSkinExtremities();


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

$hcode="H12017336";
$hci="KIDAPAWAN MEDICAL SPECIALISTS CENTER, INC.";
$hciadd="BRGY. SUDAPIN, KIDAPAWAN CITY, COTABATO 9400";
/*------------------------------------------------------*/


echo "
<div align='center'>
<form method='post'>
<table border='0' style='width: 100%;padding: none;' class='table-condensed'>
  <tr>
    <td colspan='4'>
      <div class='alert alert-success' style='margin-bottom: 0px;font-weight: bold;font-size:16px;'>
        I. HEALTH CARE INSTITUTION (HCI) INFORMATION
      </div>
    </td>
  </tr>
  <tr>
    <td style='width: 25%;'>
      <label for='txtPerTransmittalNo'>Name of HCI:</label>
      <input type='text' value='$hci' class='form-control' style='width: 95%;' placeholder='Name of HCI'/>
    </td>
    <td style='width: 30%;'>
      <label for='txtPerClaimId'>Address of HCI:</label>
      <input type='text' value='$hciadd' class='form-control' style='width: 95%;' placeholder='Address of HCI'/>
    </td>
    <td style='width: 25%;'>
      <label>Accreditation Number:</label>
      <!--Patient PIN-->
      <input type='text' value='$hcode' class='form-control' style='width: 95%;' minlength='12' maxlength='12' placeholder='Accreditation Number'/>
    </td>
    <td></td>
  </tr>
  <tr>
    <td colspan='4' height='10'></td>
  </tr>
  <tr>
    <td colspan='4'>
      <div class='alert alert-success' style='margin-bottom: 0px;font-weight: bold;font-size:16px;'>
        II. PATIENT'S DATA
      </div>
    </td>
  </tr>
  <tr>
    <td>
      <label style='color:red;'>*</label><label for='txtPerTransmittalNo'>EClaims Transmittal ID Number:</label>
      <input type='text' name='txtPerTransmittalNo' value='$pHospitalTransmittalNo' class='form-control' style='width: 95%;' maxlength='21' placeholder='E-Claims Transmittal ID No.' required/>
    </td>
    <td>
      <label style='color:red;'>*</label><label for='txtPerClaimId'>Claim ID Number:</label>
      <input type='text' id='txtPerClaimId' name='txtPerClaimId' value='$caseno' class='form-control' style='width: 95%;' maxlength='21' placeholder='Claim ID No.' required />
    </td>
    <td>
      <label style='color:red;'>*</label><label>Patient PhilHealth Identification Number:</label>
      <!--Patient PIN-->
      <input type='text' id='txtPerPatPIN' name='txtPerPatPIN' value='$pinrel' class='form-control' style='width: 95%;' minlength='12' maxlength='12' onkeypress='return isNumberKey(event);' placeholder='Patient PIN' required />
    </td>
    <td></td>
  </tr>
  <tr>
    <td>
      <label style='color:red;'>*</label><label>Last Name:</label>
";

echo '
      <input type="text" id="txtPerPatLname" name="txtPerPatLname" value="'.$ln.'" class="form-control" style="width: 95%;text-transform: uppercase;" maxlength="20" placeholder="Last Name" required />
';

echo "
    </td>
    <td>
      <label style='color:red;'>*</label><label>First Name:</label>
";

echo '
      <input type="text" id="txtPerPatFname" name="txtPerPatFname" value="'.$fn.'" class="form-control" style="width: 95%;text-transform: uppercase;" maxlength="20" placeholder="First Name" required />
';

echo "
    </td>
    <td>
      <label>Middle Name:</label>
";

echo '
      <input type="text" id="txtPerPatMname" name="txtPerPatMname" value="'.$mn.'" class="form-control" style="width: 95%;text-transform: uppercase;" maxlength="20" placeholder="Middle Name" />
';

echo "
    </td>
    <td style='width: 20%'>
      <label>Extension Name:</label>
      <input type='text' id='txtPerPatExtName' name='txtPerPatExtName' value='$suffix' class='form-control' style='width: 95%;text-transform: uppercase;' maxlength='4' placeholder='Extension Name'/>
    </td>
  </tr>

  <tr>
    <td $pbdbg $pbdtitle>
      <label style='color:red;'>*</label><label>Date of Birth (mm/dd/yyyy):</label><br/>
      <table border='0' cellpadding='0' cellspacing='0'>
        <tr>
";


//      <input type='text' id='txtPerPatBirthday' name='txtPerPatBirthday' value='' class='datepicker form-control' style='width: 95%;text-transform: uppercase;' placeholder='Date of Birth' />

echo "
          <td>
            <select name='txtPerPatBirthdayM' class='form-control' style='width: 80px;text-transform: uppercase;'>
              <option value='' disabled>MM</option>
";


        $sexX = getDateMonth(true, '');
        foreach($sexX as $key => $value) {

        if($bdm==$key){$bdms="selected='selected'";}else{$bdms="";}
echo "
              <option value='$key' $bdms>$value</option>
";
        }


echo "
            </select>
          </td>
          <td width='5'></td>
          <td>
            <select name='txtPerPatBirthdayD' class='form-control' style='width: 70px;text-transform: uppercase;'>
              <option value='' disabled>DD</option>
";


        for($x=1;$x<=31;$x++){
        if($x<10){$y="0".$x;}else{$y=$x;}

        if($bdd==$y){$bdds="selected='selected'";}else{$bdds="";}
echo "
              <option $bdds>$y</option>
";
        }


echo "
            </select>
          </td>
          <td width='5'></td>
          <td>
            <select name='txtPerPatBirthdayY' class='form-control' style='width: 75px;text-transform: uppercase;'>
              <option value='' disabled>YYYY</option>
";

        $py=date("Y");
        for($z=1900;$z<=$py+5;$z++){

        if($bdy==$z){$bdys="selected";}else{$bdys="";}
echo "
              <option $bdys>$z</option>
";
        }


echo "
            </select>
          </td>
        </tr>
      </table>
    </td>
    <td>
      <label style='color:red;'>*</label><label>Sex:</label><br/>
      <select name='txtPerPatSex' id='txtPerPatSex' class='form-control' style='width: 95%;text-transform: uppercase;'>
        <option value='' disabled>Select Sex</option>
";


        $sexX = getSex(true, '');
        foreach($sexX as $key => $value) {

          if($gn==$key){$gns="selected";}else{$gns="";}
echo "
        <option $gns value='$key'>$value</option>
";
        }


echo "
      </select>
    </td>
    <td>
      <label style='color:red;'>*</label><label>Civil Status:</label><br/>
      <select name='txtPerPatStatus' id='txtPerPatStatus' class='form-control' style='width: 95%;text-transform: uppercase;'>
        <option value='' disabled>Select Civil Status</option>
";
        $civilStatus = getCivilStatus(true, '');
        foreach($civilStatus as $key => $value) {

          $cvss="";
          if(($cvs!="CHILD")&&($cvs==$value)){$cvss="selected='selected'";}
          if(($cvs=="CHILD")&&($value=="SINGLE")){$cvss="selected='selected'";}

echo "
 <option value='$key' $cvss>$value</option>
";
        }

echo "
      </select>
    </td>
";

if($ptype==""){$pt0="selected";}else{$pt0="";}
echo "
    <td>
      <label style='color:red;'>*</label><label>Patient Type:</label><br/>
      <select name='txtPerPatType' id='txtPerPatType' class='form-control' style='width: 95%;text-transform: uppercase;' required>
        <option value='' $pt0>Select Patient Type</option>
";


        $patientType = getPatientType(true, '');
        foreach($patientType as $key => $value) {

          if(($ptype=="M")&&($value=="MEMBER")){$pts="selected";}
            else if(($ptype!="M")&&($value=="DEPENDENT")){
              if($ptype=="RTH"){
                $pts="";
              }
              else{
                $pts="selected";
              }
            }
            else{$pts="";}
echo "
        <option value='$key' $pts ";
            if($key == 'NM') { echo " disabled ";}

echo "
        >$value</option>
";
        }


echo "
      </select>
    </td>
  </tr>
";

if(strstr($chiefcomplaint, PHP_EOL)){$remsp1="<span class='arial12red'>(REMOVE NEXT LINE PRESENT IN CHIEF COMPLAINT.)</span>";}else{$remsp1="";}

echo "
  <tr>
    <td colspan='4'><div align='left'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td><div><span style='color:red;'>*</span>Chief Complaint:</div></td>
      </tr>
      <tr>
        <td>
          <textarea name='pChiefComplaint' id='pChiefComplaint' class='form-control' rows='5' maxlength='2000' style='resize: none; width: 100%;text-transform: uppercase' required>$chiefcomplaint</textarea>
        </td>
      </tr>
    </table></div></td>
  </tr>
  <tr>
    <td colspan='4' height='10'></td>
  </tr>
";

if(strstr($historyofpresentillness, PHP_EOL)){$remsp2="<span class='arial12red'>(REMOVE NEXT LINE PRESENT IN HISTORY OF PRESENT ILLNESS.)</span>";}else{$remsp2="";}

echo "
  <tr>
    <td colspan='4'>
      <div class='alert alert-success' style='margin-bottom: 0px;font-weight: bold;font-size:16px;'>
        III.a. REASON FOR ADMISSION
      </div>
    </td>
  </tr>
  <tr>
    <td colspan='4'><div align='left'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td><div><span style='color:red;'>*</span>History of Present Illness: $remsp2</div></td>
      </tr>
      <tr>
        <td>
          <textarea name='pHistPresentIllness' id='pHistPresentIllness' class='form-control' rows='5' maxlength='2000' style='resize: none; width: 100%;text-transform: uppercase' required>$historyofpresentillness</textarea>
        </td>
      </tr>
    </table></div></td>
  </tr>
  <tr>
    <td colspan='4'><div align='left'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td><div><span style='color:red;'>*</span>Past Medical History:</div></td>
      </tr>
      <tr>
        <td>
          <textarea name='xaMedHistOthers' id='txaMedHistOthers' class='form-control' rows='5' maxlength='2000' style='resize: none; width: 100%;text-transform: uppercase' required>$pastmedicalhistory</textarea>
        </td>
      </tr>
    </table></div></td>
  </tr>
  <tr>
    <td colspan='4' height='10'></td>
  </tr>
</table>
";

$mnhsql=mysqli_query($conncf4,"SELECT `pLastMensPeriod`, `pIsApplicable` FROM `menshist` WHERE `caseno`='$caseno'");
$mnhcount=mysqli_num_rows($mnhsql);
if($mnhcount>0){
  $mnhfetch=mysqli_fetch_array($mnhsql);
  $pLastMensPeriod=$mnhfetch['pLastMensPeriod'];
  $pIsApplicable=$mnhfetch['pIsApplicable'];
}
else{
  $pLastMensPeriod="";
  $pIsApplicable="";
}

if($pLastMensPeriod==""){
  $smd="selected='selected'";
  $smm="selected='selected'";
  $smy="selected='selected'";
}
else{
  $smd="";
  $smm="";
  $smy="";
  $lmp=preg_split("/\-/",$pLastMensPeriod);
}

//---------------------------------------------------------------------------------------------------------------------------------------------------

echo "
<div class='$hideunhide' id='fonly'>
<table border='0' width='100%' class='table-condensed'>
  <col style='width: 25%;'>
  <col style='width: 25%;'>
  <col style='width: 25%;'>
  <col style='width: 25%;'>
  <tr>
    <td colspan='4'>
      <div class='alert alert-danger' style='margin-bottom: 0px'>
";


if ($gn=="F") {
echo "
          <font color='red'>*</font>
";
}

if($mnhcount==0){
  if($gn=="M"){$nap="checked='checked'";$ap="";}else if($gn=="F"){$nap="";$ap="checked='checked'";}else{$nap="checked='checked'";$ap="";}
}
else{
  if($pIsApplicable=="N"){$nap="checked";$ap="";}else{$nap="";$ap="checked";}
}

echo "
        <strong style='font-size: 16px'>MENSTRUAL HISTORY</strong>
        <div style='float:right;'>
          <table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><label>
                <table border='0' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td><input id='mhDone_1' type='radio' name='mhDone' value='N' style='float: left;' onclick='setnotreq()' $nap /></td>
                    <td><label for='mhDone_1' style='margin: 3px 20px 0px 5px;'>Not applicable</label></td>
                  </tr>
                </table>
              </lable></td>
              <td width='10'></td>
              <td><label>
                <table border='0' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td><input id='mhDone_2' type='radio' name='mhDone' value='Y' style='float: left;' onclick='setreq()' $ap /></td>
                    <td><label for='mhDone_2' style='margin: 3px 20px 0px 5px;'>Applicable</label></td>
                  </tr>
                </table>
              </label></td>
            </tr>
          </table>
        </div>
      </div>

    </td>
  </tr>
  <tr>
    <td colspan='4'><div align='left'>
      <table border='0'>
        <tr>
          <td><label style='color:red;'>*</label><label>Last menstrual period:</label></td>
        </tr>
        <tr>
          <td>
            <table>
              <tr>
                <td>
                  <input type='date' name='txtOBHistLastMens' id='lastmens' class='form-control' style='width: 95%;' value='$pLastMensPeriod' />
                  <!-- select name='txtOBHistLastMensM' id='lastmens' class='form-control' style='width: 90px;text-transform: uppercase;'>
                    <option value='' $smm>Month</option>
";

$pm=date("m");
$sexX = getDateMonth(true, '');
foreach($sexX as $key => $value) {

  if($key==$lmp[1]){$bdms="selected='selected'";}else{$bdms="";}
echo "
                    <option value='$key' $bdms>$value</option>
";
}


echo "
                  </select>
                  <select name='txtOBHistLastMensD' id='lastmens' class='form-control' style='width: 80px;text-transform: uppercase;'>
                    <option value='' selected='selected'>Day</option>
";

$pd=date("d");
for($x=1;$x<=31;$x++){
if($x<10){$y="0".$x;}else{$y=$x;}

  if($y==$lmp[2]){$bdds="selected='selected'";}else{$bdds="";}
echo "
                    <option $bdds>$y</option>
";

}


echo "
                  </select>
                  <select name='txtOBHistLastMensY' id='lastmens' class='form-control' style='width: 95px;text-transform: uppercase;'>
                    <option value='' selected='selected'>Year</option>
";

$py=date("Y");
for($z=1900;$z<=$py+5;$z++){

  if($z==$lmp[0]){$bdys="selected='selected'";}else{$bdys="";}
echo "
                    <option $bdys>$z</option>
";
}


echo "
                  </select -->
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td colspan='4'>
      <div class='alert alert-warning' style='margin-bottom: 0px'>
";

if ($gn=="F") {
echo "
          <font color='red'>*</font>
";
}

echo "
        <strong style='font-size: 16px'>PREGNANCY HISTORY</strong>
      </div>
    </td>
  </tr>
";

$pregsql=mysqli_query($conncf4,"SELECT `pPregCnt`, `pDeliveryCnt`, `pFullTermCnt`, `pAbortionCnt`, `pPrematureCnt`, `pLivChildrenCnt` FROM `preghist` WHERE `caseno`='$caseno'");
$pregcount=mysqli_num_rows($pregsql);
if($pregcount==0){
  $pPregCnt="";
  $pDeliveryCnt="";
  $pFullTermCnt="";
  $pAbortionCnt="";
  $pPrematureCnt="";
  $pLivChildrenCnt="";
}
else{
  $pregfetch=mysqli_fetch_array($pregsql);
  $pPregCnt=$pregfetch["pPregCnt"];
  $pDeliveryCnt=$pregfetch["pDeliveryCnt"];
  $pFullTermCnt=$pregfetch["pFullTermCnt"];
  $pAbortionCnt=$pregfetch["pAbortionCnt"];
  $pPrematureCnt=$pregfetch["pPrematureCnt"];
  $pLivChildrenCnt=$pregfetch["pLivChildrenCnt"];
}


echo "
  <tr>
    <td><label style='color:red;'>*</label><label>Gravidity (no. of pregnancy):</label></td>
    <td><label style='color:red;'>*</label><label>Parity (no. of delivery):</label></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td><input type='number' step='1' name='txtOBHistGravity' id='lastmens' maxlength='2' class='form-control' onkeypress='return acceptNumOnly(event);' value='$pPregCnt' style='margin-right: 10px;' /></td>
    <td><input type='number' step='1' name='txtOBHistParity' id='lastmens' maxlength='2' class='form-control' onkeypress='return acceptNumOnly(event);' value='$pDeliveryCnt' /></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td><label style='color:red;'>*</label><label>No. of full term:</label></td>
    <td><label style='color:red;'>*</label><label>No. of premature:</label></td>
    <td><label style='color:red;'>*</label><label>No. of abortion:</label></td>
    <td><label style='color:red;'>*</label><label>No. of living children:</label></td>
  </tr>
  <tr>
    <td><input type='number' step='1' name='txtOBHistFullTerm' id='lastmens' maxlength='2' class='form-control' onkeypress='return acceptNumOnly(event);' value='$pFullTermCnt' /></td>
    <td><input type='number' step='1' name='txtOBHistPremature' id='lastmens' maxlength='2' class='form-control' onkeypress='return acceptNumOnly(event);' value='$pPrematureCnt' /></td>
    <td><input type='number' step='1' name='txtOBHistAbortion' id='lastmens' maxlength='2' class='form-control' onkeypress='return acceptNumOnly(event);' value='$pAbortionCnt' /></td>
    <td><input type='number' step='1' name='txtOBHistLivingChildren' id='lastmens' maxlength='2' class='form-control' onkeypress='return acceptNumOnly(event);' value='$pLivChildrenCnt' /></td>
  </tr>
</table>
</div>
";

if($gn=="M"){
echo "
  <input type='hidden' name='mhDone' value='N' />
  <input type='hidden' name='txtOBHistLastMens' value='' />
  <input type='hidden' name='txtOBHistLastMensM' value='' />
  <input type='hidden' name='txtOBHistLastMensD' value='' />
  <input type='hidden' name='txtOBHistLastMensY' value='' />
  <input type='hidden' name='txtOBHistGravity' value='' />
  <input type='hidden' name='txtOBHistParity' value='' />
  <input type='hidden' name='txtOBHistFullTerm' value='' />
  <input type='hidden' name='txtOBHistPremature' value='' />
  <input type='hidden' name='txtOBHistAbortion' value='' />
  <input type='hidden' name='txtOBHistLivingChildren' value='' />
";
}

//---------------------------------------------------------------------------------------------------------------------------------------------------

echo "
<hr />
<table boreder='1' width='100%' cellpadding='0' cellspacing='0'>
  <tr>
    <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
      <tr>
        <td valign='bottom'><div align='left'><a href='?cf4clear&bck=p1&caseno=$caseno'";?> onclick="return confirm('Clear CF4 Data?');" <?php echo "><input type='button' class='btn btn-danger' value='Clear CF4 Data' title='Clear CF4 Data' style='color: #FFFFFF;font-weight: bold;margin: 10px 0px 0px 0px;' /></a></div></td>
        <td valign='bottom'><div align='right'><table border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <!-- td><a href='../eClaimsTwo/3/CF4/?caseno=$caseno' class='astyle' target='_blank'><div align='right'><input type='button' class='btn btn-primary' value='PRINTABLE CF4' title='PRINTABLE CF4' style='font-weight: bold;margin: 10px 0px 0px 0px;' /></div></td -->
            <td width='3'></td>
";

$zsql=mysqli_query($conncf4,"SELECT `pHciCaseNo`, `pHciTransNo` FROM `enlistment` WHERE `caseno`='$caseno'");
$zcount=mysqli_num_rows($zsql);

if($zcount!=0){
echo "
            <!-- td><a href='?cf4p5&caseno=$caseno' class='astyle'><div align='right'><input type='button' class='btn btn-success' name='CF4 Part 5' value='CF4 Part 5' title='CF4 Part 5' style='font-weight: bold;margin: 10px 0px 0px 0px;' /></div></td>
            <td width='3'></td -->
            <td><a href='?cf4p4&caseno=$caseno' class='astyle'><div align='right'><input type='button' class='btn btn-success' name='CF4 Part 4' value='CF4 Part 4' title='CF4 Part4' style='font-weight: bold;margin: 10px 0px 0px 0px;' /></div></td>
            <td width='3'></td>
            <td><a href='?cf4p3&caseno=$caseno' class='astyle'><div align='right'><input type='button' class='btn btn-success' name='CF4 Part 3' value='CF4 Part 3' title='CF4 Part3' style='font-weight: bold;margin: 10px 0px 0px 0px;' /></div></td>
            <td width='3'></td>
            <td><a href='?cf4p2&caseno=$caseno' class='astyle'><div align='right'><input type='button' class='btn btn-success' name='CF4 Part 2' value='CF4 Part 2' title='CF4 Part2' style='font-weight: bold;margin: 10px 0px 0px 0px;' /></div></td>
            <td width='20'></td>
";
}

echo "
            <td valign='bottom'><div align='right'><input type='submit' class='btn btn-primary' name='savep1' value='Save  Entries' title='Save Entries' style='font-weight: bold;margin: 10px 0px 0px 0px;' /></div></td>
          </tr>
        </table></div></td>
      </tr>
    </td>
    <td width='10' height='20'></td>
  </tr>
</table>
</form>
</div>
";
}
else{
echo "
<div align='left'>
";

  include("CF4Part1Save.php");

echo "
</div>
";
}
?>

<script>
const el = document.getElementById('txtPerPatSex');
var element = document.getElementById("fonly");

el.addEventListener('change', function handleChange(event) {
  if (event.target.value === 'F') {
    element.classList.remove("hide");
    element.classList.add("unhide");
    element.required = true;
  } else {
    element.classList.remove("unhide");
    element.classList.add("hide");
    element.required = false;
  }
});

function setreq() {
  var rad = document.getElementById("mhDone_2");
  var lastmens = document.getElementById("lastmens");
  if (rad.checked == true){
    lastmens.required = true;
  }
}

function setnotreq() {
  var rad = document.getElementById("mhDone_1");
  var lastmens = document.getElementById("lastmens");
  if (rad.checked == true){
    lastmens.required = false;
  }
}
</script>
