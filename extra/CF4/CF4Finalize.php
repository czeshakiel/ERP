<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="Resources/Favicon/favicon.png" type="image/png" />
<link rel="shortcut icon" href="Resources/Favicon/favicon.png" type="image/png" />
<title>CF4 Creator 1.0</title>
<link href="res/ico/favicon.png" rel="shortcut icon" type="image/x-icon" />
<link href="res/css/normalize.css" rel="stylesheet" type="text/css" />
<link href="res/css/omis.css" rel="stylesheet" type="text/css" />
<link href="res/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="res/css/styles.css" rel="stylesheet" type="text/css" />
<link href="res/css/jquery-ui-1.11.4.css" rel="stylesheet"><!--added by marv 01302018-->
<link href="Resources/CSS/style.css" rel="stylesheet" type="text/css" />
<link href="res/datatable/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/JavaScript">
<!--
function placeFocus() {
if (document.forms.length > 0) {
var field = document.forms[0];
for (i = 0; i < field.length; i++) {
if ((field.elements[i].type == "checkbox") || (field.elements[i].type == "textarea") || (field.elements[i].type.toString().charAt(0) == "s")) {
document.forms[0].elements[i].focus();
break;
         }
      }
   }
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

var el = document.getElementById('RemoveCF4');

el.addEventListener('submit', function(){
    return confirm('Are you sure you want to remove this entry?');
}, false);
//-->
</script>

</head>

<body onload="placeFocus()">
<?php
ini_set("display_errors","On");
include("Settings.php");
include("MyCon.php");
$cuz = new database();

$caseno=mysqli_real_escape_string($mycon,$_GET["caseno"]);
$source=mysqli_real_escape_string($mycon,$_GET["source"]);

$asql=mysqli_query($mycon,"SELECT * FROM `subjective` WHERE `caseno`='$caseno'");
$acount=mysqli_num_rows($asql);
if($acount!=0){
while($afetch=mysqli_fetch_array($asql)){$pOtherComplaint=$afetch["pOtherComplaint"];$pSignsSymptoms=$afetch["pSignsSymptoms"];$pPainSite=$afetch["pPainSite"];}
}
else{
$pOtherComplaint="";$pSignsSymptoms="";$pPainSite="";
}

include('function.php');
include('function_global.php');

$listHeents = listHeent();
$listChests = listChest();
$listHearts = listHeart();
$listAbs = listAbdomen();
$listNeuro = listNeuro();
$listGenitourinary = listGenitourinary();
$listRectal = listDigitalRectal();
$listSkinExtremities = listSkinExtremities();

//---------------------------------------------------------------------------------------------------------------------------------------------------

echo "
<div align='center'>
<table style='width:95%;'>
  <tr>
    <td width='10'></td>
    <td><div class='alert alert-success' style='margin-bottom: 2px'><strong style='font-size: 16px'>CHECKING AND FINALIZING CF4</strong></div>
    </td>
    <td width='10'></td>
  </tr>
";

$patdata=0;
$palist="";

$epcb=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `epcb` WHERE `caseno`='$caseno'"));
$enlistments=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `enlistments` WHERE `caseno`='$caseno'"));
$enlistment=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `enlistment` WHERE `caseno`='$caseno'"));
$enlistmentcb=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `enlistment` WHERE `caseno`='$caseno' AND `pCreatedBy`=''"));

if($epcb!=1){$padata+=1;$palist="epcb";}
if($enlistments!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-enlistments";}
if($enlistment!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-enlistment";}
if($enlistmentcb!=0){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-enlistment: pCreatedBy is Balnk --> Please Go Back to CF4 Part1 and Press Next to fix problem.";}

$profiling=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `profiling` WHERE `caseno`='$caseno'"));
$profile=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `profile` WHERE `caseno`='$caseno'"));
$oinfo=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `oinfo` WHERE `caseno`='$caseno'"));
$medhist=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `medhist` WHERE `caseno`='$caseno'"));
$surghist=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `surghist` WHERE `caseno`='$caseno'"));
$famhist=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `famhist` WHERE `caseno`='$caseno'"));
$fhspecific=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `fhspecific` WHERE `caseno`='$caseno'"));
$sochist=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `sochist` WHERE `caseno`='$caseno'"));
$immunization=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `immunization` WHERE `caseno`='$caseno'"));
$menshist=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `menshist` WHERE `caseno`='$caseno'"));
$menshist1=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `menshist` WHERE `pLastMensPeriod`='' AND `pIsApplicable`='Y' AND `caseno`='$caseno'"));
$menshist2=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `menshist` WHERE `pLastMensPeriod`='0000-00-00' AND `pIsApplicable`='Y' AND `caseno`='$caseno'"));
$menshist3=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `menshist` WHERE `pLastMensPeriod`='0000-00-00' AND `pIsApplicable`='N' AND `caseno`='$caseno'"));
$preghist=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `preghist` WHERE `caseno`='$caseno'"));
$pemisc=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `pemisc` WHERE `caseno`='$caseno'"));
$pespecific=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `pespecific` WHERE `caseno`='$caseno'"));
$diagnostic=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `diagnostic` WHERE `caseno`='$caseno'"));
$management=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `management` WHERE `caseno`='$caseno'"));
$advice=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `advice` WHERE `caseno`='$caseno'"));
$ncdqans=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `ncdqans` WHERE `caseno`='$caseno'"));

if($profiling!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-profiling";}
if($profile!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-profile";}
if($oinfo!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-oinfo";}
if($medhist!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-medhist";}

//MHSPECIFIC CHECK
$mhspecificsql=mysqli_query($mycon,"SELECT * FROM `mhspecific` WHERE `caseno`='$caseno'");
$mhspecific=mysqli_num_rows($mhspecificsql);
if($mhspecific!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-mhspecific";}
else{
  $mhspecificfetch=mysqli_fetch_array($mhspecificsql);
  $pSpecificDesc=$mhspecificfetch['pSpecificDesc'];
  if(trim($pSpecificDesc)==""){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-mhspecific --> ERROR!!! History of present illness must not be blank.";}
}

if($surghist!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-surghist";}
if($famhist!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-famhist";}
if($fhspecific!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-fhspecific";}
if($sochist!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-sochist";}
if($immunization!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-immunization";}
if($menshist!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-menshist";}
if($menshist1>0){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-menshist1";}
if($menshist2>0){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-menshist2";}
if($menshist3>0){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-menshist3";}
if($preghist!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-preghist";}

//PEPERT CHECK-----------------------------------------------------------------
$pepertsql=mysqli_query($mycon,"SELECT * FROM `pepert` WHERE `caseno`='$caseno'");
$pepert=mysqli_num_rows($pepertsql);
if($pepert!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pepert";}
else{
  $pepertfetch=mysqli_fetch_array($pepertsql);
  $pSystolic=trim($pepertfetch['pSystolic']);
  $pDiastolic=trim($pepertfetch['pDiastolic']);
  $pHr=trim($pepertfetch['pHr']);
  $pRr=trim($pepertfetch['pRr']);
  $pTemp=trim($pepertfetch['pTemp']);
  $pHeight=trim($pepertfetch['pHeight']);
  $pWeight=trim($pepertfetch['pWeight']);

  //pSystolic
  if($pSystolic==""){
    $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pepert --> BP ERROR!!! <span style='color: black;'>Systolic</span> must not be blank!";
  }
  else{
    if(!is_numeric($pSystolic)){
      $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pepert --> BP ERROR!!! <span style='color: black;'>Systolic</span> must be filled up properly!";
    }
  }

  //pDiastolic
  if($pDiastolic==""){
    $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pepert --> BP ERROR!!! <span style='color: black;'>Diastolic</span> must not be blank!";
  }
  else{
    if(!is_numeric($pDiastolic)){
      $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pepert --> BP ERROR!!! <span style='color: black;'>Diastolic</span> must be filled up properly!";
    }
  }

  //pHr
  if($pHr==""){
    $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pepert --> HEART RATE ERROR!!! <span style='color: black;'>Heart Rate</span> must not be blank!";
  }
  else{
    if(!is_numeric($pHr)){
      $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pepert --> HEART RATE ERROR!!! <span style='color: black;'>Heart Rate</span> must be filled up properly!";
    }
  }

  //pRr
  if($pRr==""){
    $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pepert --> RESPIRATORY RATE ERROR!!! <span style='color: black;'>Respiratory Rate</span> must not be blank!";
  }
  else{
    if(!is_numeric($pRr)){
      $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pepert --> RESPIRATORYT RATE ERROR!!! <span style='color: black;'>Respiratory Rate</span> must be filled up properly!";
    }
  }

  //pTemp
  if($pTemp==""){
    $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pepert --> TEMPERATURE ERROR!!! <span style='color: black;'>Temperature</span> must not be blank!";
  }
  else{
    if(!is_numeric($pTemp)){
      $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pepert --> TEMPERATURE ERROR!!! <span style='color: black;'>Temperature</span> must be filled up properly!";
    }
  }

  //pHeight
  if($pHeight==""){
    $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pepert --> HEIGHT ERROR!!! <span style='color: black;'>Height</span> must not be blank!";
  }
  else{
    if(!is_numeric($pHeight)){
      $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pepert --> HEIGHT ERROR!!! <span style='color: black;'>Height</span> must be filled up properly!";
    }
  }

  //pWeight
  if($pWeight==""){
    $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pepert --> WEIGHT ERROR!!! <span style='color: black;'>Weight</span> must not be blank!";
  }
  else{
    if(!is_numeric($pWeight)){
      $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pepert --> WEIGHT ERROR!!! <span style='color: black;'>Weight</span> must be filled up properly!";
    }
  }
}
//END PEPERT CHECK-------------------------------------------------------------

//PEGENSURVEY CHECK------------------------------------------------------------
$pegensurveysql=mysqli_query($mycon,"SELECT * FROM `pegensurvey` WHERE `caseno`='$caseno'");
$pegensurvey=mysqli_num_rows($pegensurveysql);
if($pegensurvey!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pegensurvey";}
else{
  $pegensurveyfetch=mysqli_fetch_array($pegensurveysql);
  $pGenSurveyId=$pegensurveyfetch['pGenSurveyId'];
  $pGenSurveyRem=$pegensurveyfetch['pGenSurveyRem'];

  if(($pGenSurveyId==1)&&($pGenSurveyRem!="")){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pegensurvey --> GENERAL SURVEY ERROR! <span style='color: black;'>Remarks</span> must be blank if <span style='color: black;'>Awake and alert</span> is selected.";}

  if(($pGenSurveyId==2)&&($pGenSurveyRem=="")){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pegensurvey --> GENERAL SURVEY ERROR! <span style='color: black;'>Remarks</span> must be filled up properly if <span style='color: black;'>Altered Sensorium</span> is selected.";}
}
//END PEGENSURVEY CHECK--------------------------------------------------------

//PEMISC CHECK-----------------------------------------------------------------
if($pespecific!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pespecific";}
$pspesql=mysqli_query($mycon,"SELECT `pHeentRem`, `pChestRem`, `pHeartRem`, `pAbdomenRem`, `pGuRem`, `pSkinRem`, `pNeuroRem` FROM `pespecific` WHERE `caseno`='$caseno'");
$pspefetch=mysqli_fetch_array($pspesql);
$pHeentRem=trim($pspefetch['pHeentRem']);
$pChestRem=trim($pspefetch['pChestRem']);
$pHeartRem=trim($pspefetch['pHeartRem']);
$pAbdomenRem=trim($pspefetch['pAbdomenRem']);
$pGuRem=trim($pspefetch['pGuRem']);
$pSkinRem=trim($pspefetch['pSkinRem']);
$pNeuroRem=trim($pspefetch['pNeuroRem']);

if($pemisc==0){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pemisc";}

//A. heent
$apemiscsql=mysqli_query($mycon,"SELECT `pHeentId` FROM `pemisc` WHERE `pHeentId` NOT LIKE '' AND `caseno`='$caseno'");
$apemisccount=mysqli_num_rows($apemiscsql);
if($apemisccount==0){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pemisc --> A. Heent --> 0 entries found!";}
$aess=0;
$aoth=0;
$aall=0;
while($apemiscfetch=mysqli_fetch_array($apemiscsql)){
  $pHeentId=$apemiscfetch['pHeentId'];
  if($pHeentId=="11"){$aess+=1;}
  else if($pHeentId=="99"){$aoth+=1;}
  else{$aall+=1;}
}

if(($aess>0)&&(($aoth>0)||($aall>0))){
  $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pemisc --> A. HEENT Error! &quot;Essentially normal&quot; must be unchecked if other options are checked.";
}
else{
  if(($aoth>0)&&($pHeentRem=="")){
    $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pespecific --> A. HEENT Error! Remarks must not be blank if &quot;Others&quot; is checked.";
  }
  else if(($aoth==0)&&($pHeentRem!="")){
    $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pespecific --> A. HEENT Error! Remove <u><span style='color: black'>Remarks</span></u> if &quot;Others&quot; is unchecked.";
  }
}

//B. chest
$bpemiscsql=mysqli_query($mycon,"SELECT `pChestId` FROM `pemisc` WHERE `pChestId` NOT LIKE '' AND `caseno`='$caseno'");
$bpemisccount=mysqli_num_rows($bpemiscsql);
if($bpemisccount==0){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pemisc --> B. Chest --> 0 entries found!";}
$bess=0;
$both=0;
$ball=0;
while($bpemiscfetch=mysqli_fetch_array($bpemiscsql)){
  $pChestId=$bpemiscfetch['pChestId'];
  if($pChestId=="6"){$bess+=1;}
  else if($pChestId=="99"){$both+=1;}
  else{$ball+=1;}
}

if(($bess>0)&&(($both>0)||($ball>0))){
  $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pemisc --> B. CHEST Error! &quot;Essentially normal&quot; must be unchecked if other options are checked.";
}
else{
  if(($both>0)&&($pChestRem=="")){
    $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pespecific --> B. CHEST Error! Remarks must not be blank if &quot;Others&quot; is checked.";
  }
  else if(($both==0)&&($pChestRem!="")){
    $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pespecific --> B. CHEST Error! Remove <u><span style='color: black'>Remarks</span></u> if &quot;Others&quot; is unchecked.";
  }
}

//C. heart
$cpemiscsql=mysqli_query($mycon,"SELECT `pHeartId` FROM `pemisc` WHERE `pHeartId` NOT LIKE '' AND `caseno`='$caseno'");
$cpemisccount=mysqli_num_rows($cpemiscsql);
if($cpemisccount==0){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pemisc --> C. Heart --> 0 entries found!";}
$cess=0;
$coth=0;
$call=0;
while($cpemiscfetch=mysqli_fetch_array($cpemiscsql)){
  $pHeartId=$cpemiscfetch['pHeartId'];
  if($pHeartId=="5"){$cess+=1;}
  else if($pHeartId=="99"){$coth+=1;}
  else{$call+=1;}
}

if(($cess>0)&&(($coth>0)||($call>0))){
  $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pemisc --> C. HEART Error! &quot;Essentially normal&quot; must be unchecked if other options are checked.";
}
else{
  if(($coth>0)&&($pHeartRem=="")){
    $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pespecific --> C. HEART Error! Remarks must not be blank if &quot;Others&quot; is checked.";
  }
  else if(($coth==0)&&($pHeartRem!="")){
    $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pespecific --> C. HEART Error! Remove <u><span style='color: black'>Remarks</span></u> if &quot;Others&quot; is unchecked.";
  }
}

//D. abdomen
$dpemiscsql=mysqli_query($mycon,"SELECT `pAbdomenId` FROM `pemisc` WHERE `pAbdomenId` NOT LIKE '' AND `caseno`='$caseno'");
$dpemisccount=mysqli_num_rows($dpemiscsql);
if($dpemisccount==0){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pemisc --> D. Abdomen --> 0 entries found!";}
$dess=0;
$doth=0;
$dall=0;
while($dpemiscfetch=mysqli_fetch_array($dpemiscsql)){
  $pAbdomenId=$dpemiscfetch['pAbdomenId'];
  if($pAbdomenId=="7"){$dess+=1;}
  else if($pAbdomenId=="99"){$doth+=1;}
  else{$dall+=1;}
}

if(($dess>0)&&(($doth>0)||($dall>0))){
  $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pemisc --> D. ABDOMEN Error! &quot;Essentially normal&quot; must be unchecked if other options are checked.";
}
else{
  if(($doth>0)&&($pAbdomenRem=="")){
    $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pespecific --> D. ABDOMEN Error! Remarks must not be blank if &quot;Others&quot; is checked.";
  }
  else if(($doth==0)&&($pAbdomenRem!="")){
    $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pespecific --> D. ABDOMEN Error! Remove <u><span style='color: black'>Remarks</span></u> if &quot;Others&quot; is unchecked.";
  }
}

//E. genitourinary
$epemiscsql=mysqli_query($mycon,"SELECT `pGuId` FROM `pemisc` WHERE `pGuId` NOT LIKE '' AND `caseno`='$caseno'");
$epemisccount=mysqli_num_rows($epemiscsql);
if($epemisccount==0){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pemisc --> E. Genitourinary --> 0 entries found!";}
$eess=0;
$eoth=0;
$eall=0;
while($epemiscfetch=mysqli_fetch_array($epemiscsql)){
  $pGuId=$epemiscfetch['pGuId'];
  if($pGuId=="1"){$eess+=1;}
  else if($pGuId=="99"){$eoth+=1;}
  else{$eall+=1;}
}

if(($eess>0)&&(($eoth>0)||($eall>0))){
  $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pemisc --> E. GU Error! &quot;Essentially normal&quot; must be unchecked if other options are checked.";
}
else{
  if(($eoth>0)&&($pGuRem=="")){
    $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pespecific --> E. GU Error! Remarks must not be blank if &quot;Others&quot; is checked.";
  }
  else if(($eoth==0)&&($pGuRem!="")){
    $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pespecific --> E. GU Error! Remove <u><span style='color: black'>Remarks</span></u> if &quot;Others&quot; is unchecked.";
  }
}

//F. skin
$fpemiscsql=mysqli_query($mycon,"SELECT `pSkinId` FROM `pemisc` WHERE `pSkinId` NOT LIKE '' AND `caseno`='$caseno'");
$fpemisccount=mysqli_num_rows($fpemiscsql);
if($fpemisccount==0){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pemisc --> F. Skin --> 0 entries found!";}
$fess=0;
$foth=0;
$fall=0;
while($fpemiscfetch=mysqli_fetch_array($fpemiscsql)){
  $pSkinId=$fpemiscfetch['pSkinId'];
  if($pSkinId=="1"){$fess+=1;}
  else if($pSkinId=="99"){$foth+=1;}
  else{$fall+=1;}
}

if(($fess>0)&&(($foth>0)||($fall>0))){
  $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pemisc --> F. SKIN Error! &quot;Essentially normal&quot; must be unchecked if other options are checked.";
}
else{
  if(($foth>0)&&($pSkinRem=="")){
    $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pespecific --> F. SKIN Error! Remarks must not be blank if &quot;Others&quot; is checked.";
  }
  else if(($foth==0)&&($pSkinRem!="")){
    $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pespecific --> F. SKIN Error! Remove <u><span style='color: black'>Remarks</span></u> if &quot;Others&quot; is unchecked.";
  }
}

//G. neuro
$gpemiscsql=mysqli_query($mycon,"SELECT `pNeuroId` FROM `pemisc` WHERE `pNeuroId` NOT LIKE '' AND `caseno`='$caseno'");
$gpemisccount=mysqli_num_rows($gpemiscsql);
if($gpemisccount==0){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pemisc --> G. Neuro --> 0 entries found!";}
$gess=0;
$goth=0;
$gall=0;
while($gpemiscfetch=mysqli_fetch_array($gpemiscsql)){
  $pNeuroId=$gpemiscfetch['pNeuroId'];
  if($pNeuroId=="6"){$gess+=1;}
  else if($pNeuroId=="99"){$goth+=1;}
  else{$gall+=1;}
}

if(($gess>0)&&(($goth>0)||($gall>0))){
  $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pemisc --> G. NEURO Error! &quot;Essentially normal&quot; must be unchecked if other options are checked.";
}
else{
  if(($goth>0)&&($pNeuroRem=="")){
    $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pespecific --> G. NEURO Error! Remarks must not be blank if &quot;Others&quot; is checked.";
  }
  else if(($goth==0)&&($pNeuroRem!="")){
    $padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pespecific --> G. NEURO Error! Remove <u><span style='color: black'>Remarks</span></u> if &quot;Others&quot; is unchecked.";
  }
}
//END PEMISC CHECK-------------------------------------------------------------

if($diagnostic!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-diagnostic";}
if($management!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-management";}
if($advice!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-advice";}
if($ncdqans!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-ncqdans";}


$soaps=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `soaps` WHERE `caseno`='$caseno'"));
$soap=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `soap` WHERE `caseno`='$caseno'"));
$subjective=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `subjective` WHERE `caseno`='$caseno'"));
$subjectivecc=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `subjective` WHERE `caseno`='$caseno' AND `pChiefComplaint`=''"));
$subjectivehpi=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `subjective` WHERE `caseno`='$caseno' AND `pIllnessHistory`=''"));
$pepertsoap=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `pepertsoap` WHERE `caseno`='$caseno'"));
$pemiscsoap=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `pemiscsoap` WHERE `caseno`='$caseno'"));
$pespecificsoap=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `pespecificsoap` WHERE `caseno`='$caseno'"));
$icds=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `icds` WHERE `caseno`='$caseno'"));
$diagnosticsoap=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `diagnosticsoap` WHERE `caseno`='$caseno'"));
$managementsoap=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `managementsoap` WHERE `caseno`='$caseno'"));
$advicesoap=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `advicesoap` WHERE `caseno`='$caseno'"));

if($soaps!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-soaps";}
if($soap!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-soap";}
if($subjective!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-subjective";}
if($subjectivecc!=0){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-subjective-cc";}
if($subjectivehpi!=0){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-subjective-hpi";}
if($pepertsoap!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pepertsoap";}
if($pemiscsoap!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pemiscsoap";}
if($pespecificsoap!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-pespecificsoap";}
if($icds!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-icds";}
if($diagnosticsoap!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-diagnosticsoap";}
if($managementsoap!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-managementsoap";}
if($advicesoap!=1){$padata+=1;$palist=$palist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-advicesoap";}


if($padata==0){
echo "
  <tr>


    <td></td>
    <td><div align='left'><span class='arial16bluebold'>&nbsp;*&nbsp;</span><span class='arial14black'>Patient's Data and Symptoms: </span><span class='arial14greenbold'>ALL OK</span></div></td>
    <td></td>
  </tr>
";
}
else{
echo "
  <tr>
    <td></td>
    <td><div align='left'><span class='arial16bluebold'>&nbsp;*&nbsp;</span><span class='arial14black'>Patient's Data and Symptoms: </span><a href='CF4Part1.php?caseno=$caseno&source=1' class='astyle'><span class='arial14redbold'>NOT OK$palist</span></a></div></td>
    <td></td>
  </tr>
";
}


$docorders=0;
$docolist="";

$coursewards=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `coursewards` WHERE `caseno`='$caseno'"));
$courseward=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `courseward` WHERE `caseno`='$caseno'"));

if($coursewards!=1){$docorders+=1;$docolist=$docolist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-coursewards";}
if($courseward==0){$docorders+=1;$docolist=$docolist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-courseward";}


if($docorders==0){
echo "
  <tr>
    <td></td>
    <td><div align='left'><span class='arial16bluebold'>&nbsp;*&nbsp;</span><span class='arial14black'>Doctor's Orders: </span><span class='arial14greenbold'>ALL OK</span></div></td>
    <td></td>
  </tr>
";
}
else{
echo "
  <tr>
    <td></td>
    <td><div align='left'><span class='arial16bluebold'>&nbsp;*&nbsp;</span><span class='arial14black'>Doctor's Orders: </span><a href='CF4Part4.php?caseno=$caseno&source=1' class='astyle'><span class='arial14redbold'>NOT OK$docolist</span></a></div></td>
    <td></td>
  </tr>
";
}


$others=0;
$othlist="";

$labresults=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `labresults` WHERE `caseno`='$caseno'"));
$labresult=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `labresult` WHERE `caseno`='$caseno'"));
$cbc=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `cbc` WHERE `caseno`='$caseno'"));
$urinalysis=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `urinalysis` WHERE `caseno`='$caseno'"));
$chestxray=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `chestxray` WHERE `caseno`='$caseno'"));
$sputum=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `sputum` WHERE `caseno`='$caseno'"));
$lipidprof=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `lipidprof` WHERE `caseno`='$caseno'"));
$fbs=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `fbs` WHERE `caseno`='$caseno'"));
$ecg=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `ecg` WHERE `caseno`='$caseno'"));
$fecalysis=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `fecalysis` WHERE `caseno`='$caseno'"));
$papssmear=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `papssmear` WHERE `caseno`='$caseno'"));
$ogtt=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `ogtt` WHERE `caseno`='$caseno'"));

if($labresults!=1){$others+=1;$othlist=$othlist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-labresults";}
if($labresult!=1){$others+=1;$othlist=$othlist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-labresult";}
if($cbc!=1){$others+=1;$othlist=$othlist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-cbc";}
if($urinalysis!=1){$others+=1;$othlist=$othlist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-urinalysis";}
if($chestxray!=1){$others+=1;$othlist=$othlist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-chestxray";}
if($sputum!=1){$others+=1;$othlist=$othlist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-sputum";}
if($lipidprof!=1){$others+=1;$othlist=$othlist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-lipidprof";}
if($fbs!=1){$others+=1;$othlist=$othlist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-fbs";}
if($ecg!=1){$others+=1;$othlist=$othlist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-ecg";}
if($fecalysis!=1){$others+=1;$othlist=$othlist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-fecalysis";}
if($papssmear!=1){$others+=1;$othlist=$othlist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-papsmear";}
if($ogtt!=1){$others+=1;$othlist=$othlist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-ogtt";}


$meds=0;
$medlist="";

$medicines=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `medicines` WHERE `caseno`='$caseno'"));
$medicine=mysqli_num_rows(mysqli_query($mycon,"SELECT * FROM `medicine` WHERE `caseno`='$caseno'"));

if($medicines!=1){$meds+=1;$medlist=$medlist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-medicines";}
if($medicine==0){$meds+=1;$medlist=$medlist."<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-medicine";}

if($meds==0){
echo "
  <tr>
    <td></td>
    <td><div align='left'><span class='arial16bluebold'>&nbsp;*&nbsp;</span><span class='arial14black'>Medicine List: </span><span class='arial14greenbold'>ALL OK</span></div></td>
    <td></td>
  </tr>
";
}
else{
echo "
  <tr>
    <td></td>
    <td><div align='left'><span class='arial16bluebold'>&nbsp;*&nbsp;</span><span class='arial14black'>Medicine List: </span><a href='CF4Part5.php?caseno=$caseno&source=1' class='astyle'><span class='arial14redbold'>NOT OK$medlist</span></a></div></td>
    <td></td>
  </tr>
";
}


if($others==0){
echo "
  <tr>
    <td></td>
    <td><div align='left'><span class='arial16bluebold'>&nbsp;*&nbsp;</span><span class='arial14black'>Other CF4 Data: </span><span class='arial14greenbold'>ALL OK</span></div></td>
    <td></td>
  </tr>
";
}
else{
echo "
  <tr>
    <td></td>
    <td><div align='left'><span class='arial16bluebold'>&nbsp;*&nbsp;</span><span class='arial14black'>Other CF4 Data: </span><span class='arial14redbold'>NOT OK$othlist</span></div></td>
    <td></td>
  </tr>
";
}

if(($padata==0)&&($docorders==0)&&($meds==0)&&($others==0)){
$bsql=mysqli_query($mycon,"SELECT `pHciCaseNo`, `pHciTransNo`, `pEClaimsTransmittalId` FROM `enlistment` WHERE `caseno`='$caseno'");
while($bfetch=mysqli_fetch_array($bsql)){$pHciCaseNo=$bfetch['pHciCaseNo'];$pHciTransNo=$bfetch['pHciTransNo'];}

mysqli_query($mycon,"UPDATE `courseward` SET `pHciCaseNo`='$pHciCaseNo', `pHciTransNo`='$pHciTransNo' WHERE `caseno`='$caseno'");
mysqli_query($mycon,"UPDATE `medicine` SET `pHciCaseNo`='$pHciCaseNo', `pHciTransNo`='$pHciTransNo' WHERE `caseno`='$caseno'");
mysqli_query($mycon,"UPDATE `caseno` SET `status`='processing' WHERE `status`='pending'");
mysqli_query($mycon,"UPDATE `caseno` SET `status`='pending' WHERE `caseno`='$caseno'");

echo "<META HTTP-EQUIV='Refresh'CONTENT='1;URL=../CreateCF4XML/?caseno=$caseno'>";
}
//---------------------------------------------------------------------------------------------------------------------------------------------------

echo "
</table>
</div>
";
?>
</body>
</html>
