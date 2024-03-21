<?php
$txtPhExSystolic=trim(mysqli_real_escape_string($conncf4,$_POST["txtPhExSystolic"]));
$txtPhExBPDiastolic=trim(mysqli_real_escape_string($conncf4,$_POST["txtPhExBPDiastolic"]));
$txtPhExHeartRate=trim(mysqli_real_escape_string($conncf4,$_POST["txtPhExHeartRate"]));
$txtPhExRespiratoryRate=trim(mysqli_real_escape_string($conncf4,$_POST["txtPhExRespiratoryRate"]));
$txtPhExTemp=trim(mysqli_real_escape_string($conncf4,$_POST["txtPhExTemp"]));
$txtPhExHeight=trim(mysqli_real_escape_string($conncf4,$_POST["txtPhExHeight"]));
$txtPhExWeight=trim(mysqli_real_escape_string($conncf4,$_POST["txtPhExWeight"]));
$pGenSurvey=mysqli_real_escape_string($conncf4,$_POST["pGenSurvey"]);
$pGenSurveyRemarks=trim(mysqli_real_escape_string($conncf4,$_POST["pGenSurveyRemarks"]));

$txtPhExSystolic=str_replace("`","",$txtPhExSystolic);
$txtPhExBPDiastolic=str_replace("`","",$txtPhExBPDiastolic);
$txtPhExHeartRate=str_replace("`","",$txtPhExHeartRate);
$txtPhExRespiratoryRate=str_replace("`","",$txtPhExRespiratoryRate);

$aa=strtoupper(trim(mysqli_real_escape_string($conncf4,$_POST["heent_remarks"])));
$bb=strtoupper(trim(mysqli_real_escape_string($conncf4,$_POST["chest_lungs_remarks"])));
$cc=strtoupper(trim(mysqli_real_escape_string($conncf4,$_POST["heart_remarks"])));
$dd=strtoupper(trim(mysqli_real_escape_string($conncf4,$_POST["abdomen_remarks"])));
$ee=strtoupper(trim(mysqli_real_escape_string($conncf4,$_POST["gu_remarks"])));
$ff=strtoupper(trim(mysqli_real_escape_string($conncf4,$_POST["skinExtremities_remarks"])));
$gg=strtoupper(trim(mysqli_real_escape_string($conncf4,$_POST["neuro_remarks"])));

$aa=str_replace("`","",$aa);
$aa=str_replace("<","LESS THAN",$aa);
$aa=str_replace(">","MORE THAN",$aa);
$bb=str_replace("`","",$bb);
$bb=str_replace("<","LESS THAN",$bb);
$bb=str_replace(">","MORE THAN",$bb);
$cc=str_replace("`","",$cc);
$cc=str_replace("<","LESS THAN",$cc);
$cc=str_replace(">","MORE THAN",$cc);
$dd=str_replace("`","",$dd);
$dd=str_replace("<","LESS THAN",$dd);
$dd=str_replace(">","MORE THAN",$dd);
$ee=str_replace("`","",$ee);
$ee=str_replace("<","LESS THAN",$ee);
$ee=str_replace(">","MORE THAN",$ee);
$ff=str_replace("`","",$ff);
$ff=str_replace("<","LESS THAN",$ff);
$ff=str_replace(">","MORE THAN",$ff);
$gg=str_replace("`","",$gg);
$gg=str_replace("<","LESS THAN",$gg);
$gg=str_replace(">","MORE THAN",$gg);

$otherr=0;

$erra=0;
$errb=0;
$errc=0;
$errd=0;
$erre=0;
$errf=0;
$errg=0;

$heenterr=0;
$chesterr=0;
$hearterr=0;
$abdomenerr=0;
$genitourinaryerr=0;
$skinExtremitieserr=0;
$neuroerr=0;

$heentot=0;
$chestot=0;
$heartot=0;
$abdomenot=0;
$genitourinaryot=0;
$skinExtremitiesot=0;
$neuroot=0;

if(!is_numeric($txtPhExSystolic)){
  $otherr+=1;

echo "
  <span class='arial16redbold'>Systolic Error!!! You need to fill up <span style='color: black'>Systolic</span> properly!</span>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='5;URL=?cf4p3&caseno=$caseno'>";
}
else{
  if(!is_numeric($txtPhExBPDiastolic)){
    $otherr+=1;

echo "
  <span class='arial16redbold'>Diastolic Error!!! You need to fill up <span style='color: black'>Diastolic</span> properly!</span>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='5;URL=?cf4p3&caseno=$caseno'>";
  }
  else{
    if(!is_numeric($txtPhExHeartRate)){
      $otherr+=1;

echo "
  <span class='arial16redbold'>Heart Rate Error!!! You need to fill up <span style='color: black'>Heart Rate</span> properly!</span>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='5;URL=?cf4p3&caseno=$caseno'>";
    }
    else{
      if(!is_numeric($txtPhExRespiratoryRate)){
        $otherr+=1;

echo "
  <span class='arial16redbold'>Respiratory Rate Error!!! You need to fill up <span style='color: black'>Respiratory Rate</span> properly!</span>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='5;URL=?cf4p3&caseno=$caseno'>";
      }
      else{
        if(!is_numeric($txtPhExTemp)){
          $otherr+=1;

echo "
  <span class='arial16redbold'>Temperature Error!!! You need to fill up <span style='color: black'>Temperature</span> properly!</span>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='5;URL=?cf4p3&caseno=$caseno'>";
        }
        else{
          if(!is_numeric($txtPhExHeight)){
            $otherr+=1;

echo "
  <span class='arial16redbold'>Height Error!!! You need to fill up <span style='color: black'>Height</span> properly!</span>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='5;URL=?cf4p3&caseno=$caseno'>";
          }
          else{
            if(!is_numeric($txtPhExWeight)){
              $otherr+=1;

echo "
  <span class='arial16redbold'>Weight Error!!! You need to fill up <span style='color: black'>Weight</span> properly!</span>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='5;URL=?cf4p3&caseno=$caseno'>";
            }
            else{
              if(($pGenSurvey==2)&&($pGenSurveyRemarks=="")){
                $otherr+=1;

echo "
  <span class='arial16redbold'><span style='color: black'>Remarks</span> must not be blank if <span style='color: black'>Altered Sensorium</span> is selected!</span>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='5;URL=?cf4p3&caseno=$caseno'>";
              }
            }
          }
        }
      }
    }
  }
}

if($otherr==0){
include("CF4Part3Check.php");

if(($erra==0)&&($errb==0)&&($errc==0)&&($errd==0)&&($erre==0)&&($errf==0)&&($errg==0)){
  mysqli_query($conncf4,"DELETE FROM `pemisc` WHERE `caseno`='$caseno'");

  //---------------------------------------------------------------------------------------------------------------------------------------------------
  $asql=mysqli_query($conncf4,"SELECT * FROM `pepert` WHERE `caseno`='$caseno'");
  $acount=mysqli_num_rows($asql);

  if($acount==0){
    mysqli_query($conncf4,"INSERT INTO `pepert` (`pSystolic`, `pDiastolic`, `pHr`, `pRr`, `pTemp`, `pHeight`, `pWeight`, `pVision`, `pLength`, `pHeadCirc`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('$txtPhExSystolic', '$txtPhExBPDiastolic', '$txtPhExHeartRate', '$txtPhExRespiratoryRate', '$txtPhExTemp', '$txtPhExHeight', '$txtPhExWeight', '', '', '', 'U', '', '$caseno')");
  }
  else{
    mysqli_query($conncf4,"UPDATE `pepert` SET `pSystolic`='$txtPhExSystolic', `pDiastolic`='$txtPhExBPDiastolic', `pHr`='$txtPhExHeartRate', `pRr`='$txtPhExRespiratoryRate', `pTemp`='$txtPhExTemp', `pHeight`='$txtPhExHeight', `pWeight`='$txtPhExWeight' WHERE `caseno`='$caseno'");
  }
  //---------------------------------------------------------------------------------------------------------------------------------------------------

  //---------------------------------------------------------------------------------------------------------------------------------------------------
  $bsql=mysqli_query($conncf4,"SELECT * FROM `pegensurvey` WHERE `caseno`='$caseno'");
  $bcount=mysqli_num_rows($bsql);

  if($pGenSurvey==1){$pGenSurveyRemarksrel="";}
  else if($pGenSurvey==2){$pGenSurveyRemarksrel=$pGenSurveyRemarks;}
  else{$pGenSurveyRemarksrel=$pGenSurveyRemarks;}

  if($bcount==0){
    mysqli_query($conncf4,"INSERT INTO `pegensurvey` (`pGenSurveyId`, `pGenSurveyRem`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('$pGenSurvey', '$pGenSurveyRemarks', 'U', '', '$caseno')");
  }
  else{
    mysqli_query($conncf4,"UPDATE `pegensurvey` SET `pGenSurveyId`='$pGenSurvey', `pGenSurveyRem`='$pGenSurveyRemarksrel' WHERE `caseno`='$caseno'");
  }
  //---------------------------------------------------------------------------------------------------------------------------------------------------


  $err=0;
  //AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
  if(empty($_POST["heent"])){
    $err+=1;

echo "
  <span class='arial16redbold'>You need to check atleast one of the checkbox at A. HEENT!!!</span><br />
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=?cf4p3&caseno=$caseno'>";

  }
  else {
    $heenterr=0;
    $heentot=0;

    foreach ($_POST['heent'] as $keya => $valuea) {
      if($valuea=="11"){
        $heenterr+=1;
        mysqli_query($conncf4,"INSERT INTO `pemisc` (`pSkinId`, `pHeentId`, `pChestId`, `pHeartId`, `pAbdomenId`, `pNeuroId`, `pRectalId`, `pGuId`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '$valuea', '', '', '', '', '', '', 'U', '', '$caseno')");
      }
      else{
        if($heenterr==0){
          if($valuea==99){$heentot+=1;}
          mysqli_query($conncf4,"INSERT INTO `pemisc` (`pSkinId`, `pHeentId`, `pChestId`, `pHeartId`, `pAbdomenId`, `pNeuroId`, `pRectalId`, `pGuId`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '$valuea', '', '', '', '', '', '', 'U', '', '$caseno')");
        }
      }
    }
  }

  //BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB
  if(empty($_POST["chest"])){
    $err+=1;

echo "
  <span class='arial16redbold'>You need to check atleast one of the checkbox at B. Chest/Lungs!!!</span><br />
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=?cf4p3&caseno=$caseno'>";

  }
  else {
    $chesterr=0;
    $chestot=0;
    foreach ($_POST['chest'] as $keyb => $valueb) {
      if($valueb=="6"){
        $chesterr+=1;
        mysqli_query($conncf4,"INSERT INTO `pemisc` (`pSkinId`, `pHeentId`, `pChestId`, `pHeartId`, `pAbdomenId`, `pNeuroId`, `pRectalId`, `pGuId`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '$valueb', '', '', '', '', '', 'U', '', '$caseno')");
      }
      else{
        if($chesterr==0){
          if($valueb==99){$chestot+=1;}
          mysqli_query($conncf4,"INSERT INTO `pemisc` (`pSkinId`, `pHeentId`, `pChestId`, `pHeartId`, `pAbdomenId`, `pNeuroId`, `pRectalId`, `pGuId`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '$valueb', '', '', '', '', '', 'U', '', '$caseno')");
        }
      }
    }
  }

  //CCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCC
  if(empty($_POST["heart"])){
    $err+=1;

echo "
  <span class='arial16redbold'>You need to check atleast one of the checkbox at C. CVS!!!</span><br />
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=?cf4p3&caseno=$caseno'>";

  }
  else {
    $hearterr=0;
    $heartot=0;
    foreach ($_POST['heart'] as $keyc => $valuec) {
      if($valuec=="5"){
        $hearterr+=1;
        mysqli_query($conncf4,"INSERT INTO `pemisc` (`pSkinId`, `pHeentId`, `pChestId`, `pHeartId`, `pAbdomenId`, `pNeuroId`, `pRectalId`, `pGuId`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '$valuec', '', '', '', '', 'U', '', '$caseno')");
      }
      else{
        if($hearterr==0){
          if($valuec==99){$heartot+=1;}
          mysqli_query($conncf4,"INSERT INTO `pemisc` (`pSkinId`, `pHeentId`, `pChestId`, `pHeartId`, `pAbdomenId`, `pNeuroId`, `pRectalId`, `pGuId`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '$valuec', '', '', '', '', 'U', '', '$caseno')");
        }
      }
    }
  }

  //DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD
  if(empty($_POST["abdomen"])){
    $err+=1;

echo "
  <span class='arial16redbold'>You need to check atleast one of the checkbox at D. Abdomen!!!</span><br />
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=?cf4p3&caseno=$caseno'>";

  }
  else {
    $abdomenerr=0;
    $abdomenot=0;
    foreach ($_POST['abdomen'] as $keyd => $valued) {
      if($valued=="7"){
        $abdomenerr+=1;
        mysqli_query($conncf4,"INSERT INTO `pemisc` (`pSkinId`, `pHeentId`, `pChestId`, `pHeartId`, `pAbdomenId`, `pNeuroId`, `pRectalId`, `pGuId`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '$valued', '', '', '', 'U', '', '$caseno')");
      }
      else{
        if($abdomenerr==0){
          if($valued==99){$abdomenot+=1;}
          mysqli_query($conncf4,"INSERT INTO `pemisc` (`pSkinId`, `pHeentId`, `pChestId`, `pHeartId`, `pAbdomenId`, `pNeuroId`, `pRectalId`, `pGuId`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '$valued', '', '', '', 'U', '', '$caseno')");
        }
      }
    }
  }

  //EEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE
  if(empty($_POST["genitourinary"])){
    $err+=1;

echo "
  <span class='arial16redbold'>You need to check atleast one of the checkbox at E. GU (IE)!!!</span><br />
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=?cf4p3&caseno=$caseno'>";

  }
  else {
    $genitourinaryerr=0;
    $genitourinaryot=0;
    foreach ($_POST['genitourinary'] as $keye => $valuee) {
      if($valuee=="1"){
        $genitourinaryerr+=1;
        mysqli_query($conncf4,"INSERT INTO `pemisc` (`pSkinId`, `pHeentId`, `pChestId`, `pHeartId`, `pAbdomenId`, `pNeuroId`, `pRectalId`, `pGuId`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '$valuee', 'U', '', '$caseno')");
      }
      else{
        if($genitourinaryerr==0){
          if($valuee==99){$genitourinaryot+=1;}
          mysqli_query($conncf4,"INSERT INTO `pemisc` (`pSkinId`, `pHeentId`, `pChestId`, `pHeartId`, `pAbdomenId`, `pNeuroId`, `pRectalId`, `pGuId`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '', '', '$valuee', 'U', '', '$caseno')");
        }
      }
    }
  }

  //FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
  if(empty($_POST["skinExtremities"])){
    $err+=1;

echo "
  <span class='arial16redbold'>You need to check atleast one of the checkbox at F. Skin/Extremities!!!</span><br />
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=?cf4p3&caseno=$caseno'>";

  }
  else {
    $skinExtremitieserr=0;
    $skinExtremitiesot=0;
    foreach ($_POST['skinExtremities'] as $keyf => $valuef) {
      if($valuef=="1"){
        $skinExtremitieserr+=1;
        mysqli_query($conncf4,"INSERT INTO `pemisc` (`pSkinId`, `pHeentId`, `pChestId`, `pHeartId`, `pAbdomenId`, `pNeuroId`, `pRectalId`, `pGuId`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('$valuef', '', '', '', '', '', '', '', 'U', '', '$caseno')");
      }
      else{
        if($skinExtremitieserr==0){
          if($valuef==99){$skinExtremitiesot+=1;}
          mysqli_query($conncf4,"INSERT INTO `pemisc` (`pSkinId`, `pHeentId`, `pChestId`, `pHeartId`, `pAbdomenId`, `pNeuroId`, `pRectalId`, `pGuId`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('$valuef', '', '', '', '', '', '', '', 'U', '', '$caseno')");
        }
      }
    }
  }

  //GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
  if(empty($_POST["neuro"])){
    $err+=1;

echo "
  <span class='arial16redbold'>You need to check atleast one of the checkbox at G. Neurological Examination!!!</span><br />
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=?cf4p3&caseno=$caseno'>";

  }
  else {
    $neuroerr=0;
    $neuroot=0;
    foreach ($_POST['neuro'] as $keyg => $valueg) {
      if($valueg=="6"){
        $neuroerr+=1;
        mysqli_query($conncf4,"INSERT INTO `pemisc` (`pSkinId`, `pHeentId`, `pChestId`, `pHeartId`, `pAbdomenId`, `pNeuroId`, `pRectalId`, `pGuId`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '$valueg', '', '', 'U', '', '$caseno')");
      }
      else{
        if($neuroerr==0){
          if($valueg==99){$neuroot+=1;}
          mysqli_query($conncf4,"INSERT INTO `pemisc` (`pSkinId`, `pHeentId`, `pChestId`, `pHeartId`, `pAbdomenId`, `pNeuroId`, `pRectalId`, `pGuId`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '', '', '', '$valueg', '', '', 'U', '', '$caseno')");
        }
      }
    }
  }

  //---------------------------------------------------------------------------------------------------------------------------------------------------
  if($heenterr==0){if($heentot==0){$finaa="";$heentv=0;}else{$finaa=$aa;$heentv=1;}}else{$finaa="";$heentv=0;}
  if($chesterr==0){if($chestot==0){$finbb="";$chestv=0;}else{$finbb=$bb;$chestv=1;}}else{$finbb="";$chestv=0;}
  if($hearterr==0){if($heartot==0){$fincc="";$heartv=0;}else{$fincc=$cc;$heartv=1;}}else{$fincc="";$heartv=0;}
  if($abdomenerr==0){if($abdomenot==0){$findd="";$abdomenv=0;}else{$findd=$dd;$abdomenv=1;}}else{$findd="";$abdomenv=0;}
  if($genitourinaryerr==0){if($genitourinaryot==0){$finee="";$genitourinary=0;}else{$finee=$ee;$genitourinary=1;}}else{$finee="";$genitourinary=0;}
  if($skinExtremitieserr==0){if($skinExtremitiesot==0){$finff="";$skinExtremitiesv=0;}else{$finff=$ff;$skinExtremitiesv=1;}}else{$finff="";$skinExtremitiesv=0;}
  if($neuroerr==0){if($neuroot==0){$fingg="";$neurov=0;}else{$fingg=$gg;$neurov=1;}}else{$fingg="";$neurov=0;}

  $csql=mysqli_query($conncf4,"SELECT * FROM `pespecific` WHERE `caseno`='$caseno'");
  $ccount=mysqli_num_rows($csql);

  if($ccount==0){
    mysqli_query($conncf4,"INSERT INTO `pespecific` (`pSkinRem`, `pHeentRem`, `pChestRem`, `pHeartRem`, `pAbdomenRem`, `pNeuroRem`, `pRectalRem`, `pGuRem`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('$finff', '$finaa', '$finbb', '$fincc', '$findd', '$fingg', '', '$finee', 'U', '', '$caseno')");
  }
  else{
    mysqli_query($conncf4,"UPDATE `pespecific` SET `pSkinRem`='$finff', `pHeentRem`='$finaa', `pChestRem`='$finbb', `pHeartRem`='$fincc', `pAbdomenRem`='$findd', `pNeuroRem`='$fingg', `pGuRem`='$finee' WHERE caseno='$caseno'");
  }
  //---------------------------------------------------------------------------------------------------------------------------------------------------


  if($err==0){
    $dsql=mysqli_query($conncf4,"SELECT * FROM pepert WHERE caseno='$caseno'");
    $dcount=mysqli_num_rows($dsql);

    if($dcount==0){

echo "
  <span class='arial16bluebold'>Entries saved...</span><br />
";

    }
    else{

echo "
  <span class='arial16bluebold'>Entries updated...</span><br />
";

    }

echo "<META HTTP-EQUIV='Refresh'CONTENT='1;URL=?cf4p4&caseno=$caseno'>";

  }
}
}
?>
