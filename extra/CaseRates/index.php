<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="../Resources/Favicon/favicon.png" type="image/png" />
<link rel="shortcut icon" href="../Resources/Favicon/favicon.png" type="image/png" />
<title>SEARCH ICD</title>
<link href="../Resources/CSS/mystyle.css" rel="stylesheet" type="text/css" />
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
<style type="text/css">
<!--
.t1 {border-top-width: 1px;border-top-color: #000000;border-top-style: solid;}
.b1 {border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;}
.l1 {border-left-width: 1px;border-left-color: #000000;border-left-style: solid;}
.r1 {border-right-width: 1px;border-right-color: #000000;border-right-style: solid;}

.t2 {border-top-width: 2px;border-top-color: #000000;border-top-style: solid;}
.b2 {border-bottom-width: 2px;border-bottom-color: #000000;border-bottom-style: solid;}
.l2 {border-left-width: 2px;border-left-color: #000000;border-left-style: solid;}
.r2 {border-right-width: 2px;border-right-color: #000000;border-right-style: solid;}

.s1 {font-family: Arial;font-weight: bold;font-size: 11px;}
.s2 {font-family: Arial;font-size: 16px;}
.s3 {font-family: Arial;font-weight: bold;font-size: 14px;color: #000000;}
.s4 {font-family: Arial;font-weight: bold;font-size: 13px;color: #000000;}
.s5 {font-family: Arial;font-size: 13px;color: #0B95F7;}

.red {color: #FF0000;}
.blue {color: #0B95F7;}

.s12 {font-size: 12px;}

.bgwhite {background-color: #FFFFFF;}

.borderwhite {border-color: #000000;border-width: 1px;}

.hoverTable{border-collapse:collapse;}
/*.hoverTable td{padding:0px; border:#4e95f4 1px solid;}*/

/* Define the default color for all the table rows */
/*.hoverTable tr{background: #b8d1f3;}*/

/* Define the hover highlight color for the table row */
.hoverTable tr:hover {background-color: #ffff99;}

.btnstyle .btn {border: 1px solid #000000;width: 26px;height: 26px;border-radius: 8px;font-family: arial;font-size: 14px;font-weight: bold;text-align: center;padding: 0px 0px;}
.btnstyle .rem {background-color: #FF0000;color: #FFFFFF;}
.btnstyle .rem:hover {opacity: 0.4;}
.btnstyle .add {background-color: #FFFFFF;color: #000000;}
.btnstyle .add:hover {opacity: 0.4;}
.btnstyle .view {background-color: #01d0da;color: #FFFFFF;}
.btnstyle .view:hover {opacity: 0.6;}
.btnstyle .dis {background-color: #b4b4b1;color: #e9e9e7;}

.button1 {font-family: Arial;font-size: 14px;font-weight: bold;color: #FFFFFF;background-color: #00DA1D;border: 1px solid #00DA1D;height: 32px;}
.button2 {font-family: Arial;font-size: 14px;font-weight: bold;color: #FFFFFF;background-color: #00DA1D;border: 1px solid #00DA1D;}

.textfield1 {font-family: Arial;font-size: 16px;font-weight: bold;color: #000000;background-color: #ccff99;border: 1px solid #000000;height: 30px;width: 200px;}

.astyle {text-decoration: none;}
-->
</style>

</head>

<body onload="placeFocus()">
<?php
ini_set("display_errors","On");
include("../../main/connection.php");

$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);
$user=mysqli_real_escape_string($conn,$_GET['user']);

if(isset($_GET['dept'])){
  $dept=mysqli_real_escape_string($conn,$_GET['dept']);
}
else{
  $dept="";
}

if(isset($_GET['frm'])){
  $frm=mysqli_real_escape_string($conn,$_GET['frm']);
}
else{
  $frm="";
}

if($frm=="con"){
  $rvauto=mysqli_real_escape_string($conn,$_GET['rvauto']);
}
else{
  $rvauto="";
}

$ysql=mysqli_query($conn,"SELECT * FROM `dischargedtable` WHERE `caseno`='$caseno'");
$ycount=mysqli_num_rows($ysql);

$qsql=mysqli_query($conn,"SELECT `patientidno`, `remarks`, `dateadmit` FROM `admission` WHERE `caseno`='$caseno'");
$qfetch=mysqli_fetch_array($qsql);
$patid=$qfetch['patientidno'];
$adrmks=$qfetch['remarks'];
$dadmt=str_replace("-","",$qfetch['dateadmit']);

echo '
<script>
function showResult() {
  if (document.searchme.searchme.value.length==0) {
    document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
    return;
  }
  if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  }
  else {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","caserateres.php?caseno='.$caseno.'&user='.$user.'&frm='.$frm.'&rvauto='.$rvauto.'&da='.$dadmt.'&searchme="+document.searchme.searchme.value,true);
  xmlhttp.send();
}
</script>
';

echo "
<div align='center'>
  <table border='0' width='100%' cellpadding='0' cellspacing='0'>
";

if($adrmks!=""){
echo "
    <tr>
      <td height='30'><div align='left'><span class='arial s16 black'>REMARKS: </span><span class='arial s15 red bold b1'>".strtoupper($adrmks)."</span></div></td>
    </tr>
    <tr>
      <td height='10'></td>
    </tr>
";
}

echo "
    <tr>
      <td><div align='left' class='arial s12 blue bold'>SEARCH ICD/RVS</div></td>
    </tr>
    <tr>
      <td height='5'></td>
    </tr>
    <tr>
      <form name='searchme' onload='showResult();' method='post' action='../CaseRates/?caseno=$caseno&user=$user'>
      <td><div align='left'><input name='searchme' type='text' autocomplete='off' onKeyUp='showResult();' style='height: 40px;width: 350px;font-family: courier new;font-size: 25px;color: red;border: 2px solid black;padding-left: 5px;padding-right: 5px;border-radius: 10px;' placeholder='SEARCH ICD/RVS CODE'></div></td>
      </form>
    </tr>
    <tr>
      <td height='10'></td>
    </tr>
    <tr>
      <td><div id='livesearch' align='left'></div></td>
    </tr>
    <tr>
      <td height='20'></td>
    </tr>
    <tr>
      <td>
        <table width='100%' border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <td width='60%'><div align='left' class='arial s14 blue bold'>Patient's Case Rate and Additional Diagnosis.</div></td>
            <td width='40%'><div align='right'>
";

if($ycount!=0){
  if(!isset($_POST['unlockme'])){
echo "
              <form method='post' action='../CaseRates/UnlockAuth.php'>
                <button type='submit' style='color: #FFFFFF;background-color: #FF0000;font-weight: bold;border: 1px solid #000000;padding-left: 10px;padding-right: 10px;border-radius: 4px;' title='Unlock Edit and Delete Options (For Philhealth User&apos;s Only)'>Unlock Edit/Delete</button>
              <input type='hidden' name='caseno' value='$caseno' />
              <input type='hidden' name='user' value='$user' />
              </form>
";
  }
  else{
echo "
              <span style='color: red;font-weight: bold;font-family: arial;'>Edit/Delete is Unlocked!</span>
";
  }
}

echo "
            </div></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td height='5'></td>
    </tr>
    <tr>
      <td><div align='left'><table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='#FFF7E0'>
        <tr>
          <td class='t2 b2 l2' width='100' rowspan='2'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;'>ICD/RVS Code</div></td>
          <td class='t2 b1 l1' colspan='3'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;'>Case Rate Amount</div></td>
          <td class='t2 b2 l1' width='150' rowspan='2'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;'>Type</div></td>
          <td class='t2 b2 l1' width='auto' rowspan='2' colspan='3'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;'>Description</div></td>
          <td class='t2 b2 l1' width='150' rowspan='2'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;'>User</div></td>
          <td class='t2 b2 l1' width='150' rowspan='2'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;'>Date/Time</div></td>
          <td class='t2 b2 l1 r2' width='90' rowspan='2'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;'>Action</div></td>
        </tr>
        <tr>
          <td class='b2 l1' width='100'><div align='center' style='font-family: courier;font-size: 12px;font-weight: bold;color: #000000;'>Total</div></td>
          <td class='b2 l1' width='100'><div align='center' style='font-family: courier;font-size: 12px;font-weight: bold;color: #000000;'>HCI Share</div></td>
          <td class='b2 l1' width='100'><div align='center' style='font-family: courier;font-size: 12px;font-weight: bold;color: #000000;'>PF Share</div></td>
        </tr>
";

$pcs="";
$scs="";
$xsql=mysqli_query($conn,"SELECT `autono`, `icdcode`, `hospitalshare`, `pfshare`, `caseno`, `level`, `description`, `con`, `datetime`, `user` FROM `finalcaserate` WHERE `caseno`='$caseno' ORDER BY FIELD(`level`, 'primary', 'secondary', 'additional', ''), CAST(`autono` AS UNSIGNED) ASC");
while($xfetch=mysqli_fetch_array($xsql)){
$autono=$xfetch['autono'];
$icdcode=$xfetch['icdcode'];
$hs=$xfetch['hospitalshare'];
$ps=$xfetch['pfshare'];
$level=$xfetch['level'];
$description=$xfetch['description'];
$con=$xfetch['con'];
$datetime=$xfetch['datetime'];
$suser=$xfetch['user'];

$acr=$hs+$ps;

if($level=="primary"){
  $type="1st Case Rate";
  $pcs=$icdcode;
}
else if($level=="secondary"){
  $type="2nd Case Rate";
  $scs=$icdcode;
}
else{
  $type="Additional DX";
}

$rsql=mysqli_query($conn,"SELECT `icdcode` FROM `finalcaserate` WHERE `caseno`='$caseno' AND `con`='$rvauto'");
$rcount=mysqli_num_rows($rsql);
if($rcount!=0){
  $rfetch=mysqli_fetch_array($rsql);
  $ricd=$rfetch['icdcode'];
}
else{
  $ricd="";
}

echo "
        <tr>
";

if(($frm=="con")&&($con=='')&&(($level!="primary")&&($level!="secondary"))){
echo "
          <td class='b1 l2' height='35' style='background-color: #1D9FF4;'><a href='ConGo.php?caseno=$caseno&icdcode=$icdcode&user=$user&autono=$autono&rvauto=$rvauto' style='text-decoration: none;'><div align='center' style='font-family: courier;font-size: 14px;font-weight: bold;color: #000000;'>&nbsp;$icdcode&nbsp;</div></a></td>
";
}
else{
  if($ricd==$icdcode){
echo "
          <td class='b1 l2' height='35' style='background-color: #F27219;'><a href='RemConGo.php?caseno=$caseno&icdcode=$icdcode&user=$user&autono=$autono&rvauto=$rvauto' style='text-decoration: none;'><div align='center' style='font-family: courier;font-size: 14px;font-weight: bold;color: #FFFFFF;'>&nbsp;$icdcode&nbsp;</div></a></td>
";
  }
  else{
echo "
          <td class='b1 l2' height='35'><div align='center' style='font-family: courier;font-size: 14px;font-weight: bold;color: #000000;'>&nbsp;$icdcode&nbsp;</div></td>
";
  }
}

echo "
          <td class='b1 l1'><div align='right' style='font-family: courier;font-size: 12px;color: #000000;'>&nbsp;".number_format($acr,2)."&nbsp;</div></td>
          <td class='b1 l1'><div align='right' style='font-family: courier;font-size: 12px;color: #000000;'>&nbsp;".number_format($hs,2)."&nbsp;</div></td>
          <td class='b1 l1'><div align='right' style='font-family: courier;font-size: 12px;color: #000000;'>&nbsp;".number_format($ps,2)."&nbsp;</div></td>
          <td class='b1 l1'><div align='center' style='font-family: courier;font-size: 12px;color: #000000;'>&nbsp;$type&nbsp;</div></td>
          <td width='3' class='b1 l1'></td>
          <td class='b1'><div align='left' style='font-family: courier;font-size: 12px;color: #000000;'>$description</div></td>
          <td width='3' class='b1'></td>
          <td class='b1 l1'><div align='center' style='font-family: courier;font-size: 12px;color: #000000;'>&nbsp;$suser&nbsp;</div></td>
          <td class='b1 l1'><div align='center' style='font-family: courier;font-size: 12px;color: #000000;'>&nbsp;$datetime&nbsp;</div></td>
          <td class='b1 l1 r2'><div align='center' class='btnstyle'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
";

if($ycount==0){
echo "
              <td><div align='center' class='btnstyle'><button type='button' class='btn view' title='Edit'"; ?> onclick="<?php echo "window.open('EditICRVAmt.php?caseno=$caseno&user=$user&autono=$autono', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=270');";?>" <?php echo ">E</button></div></td>
              <td width='5'></td>
              <td>
                <div align='center' class='btnstyle'><button type='button' class='btn rem' title='Remove'"; ?> onclick="<?php echo "window.open('RemICDRVS.php?caseno=$caseno&autono=$autono&user=$user', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=270');";?>" <?php echo ">X</button></div>
              </td>
";
}
else{
  if(($level=="primary")||($level=="secondary")){
    if(isset($_POST['unlockme'])){
      $authuser=mysqli_real_escape_string($conn,$_POST['authuser']);
      $authpass=mysqli_real_escape_string($conn,$_POST['authpass']);

      $xysql=mysqli_query($conn,"SELECT * FROM `nsauth` WHERE `username`='$authuser' AND `password`='$authpass' AND `station` LIKE 'MEDICARE'");
      $xycount=mysqli_num_rows($xysql);

      if($xycount!=0){
        $unmp=mysqli_real_escape_string($conn,$_POST['unlockme']);
        if($unmp=="nowunlocked"){
echo "
              <td><div align='center' class='btnstyle'><button type='button' class='btn view' title='Edit'"; ?> onclick="<?php echo "window.open('EditICRVAmt.php?caseno=$caseno&user=$user&autono=$autono', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=270');";?>" <?php echo ">E</button></div></td>
              <td width='5'></td>
              <td>
                <div align='center' class='btnstyle'><button type='button' class='btn rem' title='Remove'"; ?> onclick="<?php echo "window.open('RemICDRVS.php?caseno=$caseno&autono=$autono&user=$user', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=270');";?>" <?php echo ">X</button></div>
              </td>
";
        }
      }
      else{
        echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=UnlockError.php?caseno=$caseno&user=$user'>";
      }
    }
    echo "
    <!-- td><div align='center' class='btnstyle'><button type='button' class='btn view' title='Edit'"; ?> onclick="<?php echo "window.open('EditICRVAmt.php?caseno=$caseno&user=$user&autono=$autono', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=270');";?>" <?php echo ">E</button></div></td -->
    ";
  }
  else{
    if(isset($_POST['unlockme'])){
      $unmp=mysqli_real_escape_string($conn,$_POST['unlockme']);
      if($unmp=="nowunlocked"){
echo "
              <td><div align='center' class='btnstyle'><button type='button' class='btn view' title='Edit'"; ?> onclick="<?php echo "window.open('EditICRVAmt.php?caseno=$caseno&user=$user&autono=$autono', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=270');";?>" <?php echo ">E</button></div></td>
              <td width='5'></td>
              <td>
                <div align='center' class='btnstyle'><button type='button' class='btn rem' title='Remove'"; ?> onclick="<?php echo "window.open('RemICDRVS.php?caseno=$caseno&autono=$autono&user=$user', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=270');";?>" <?php echo ">X</button></div>
              </td>
";
      }
      else{
echo "
              <td>
                <div align='center' class='btnstyle'><button type='button' class='btn rem' title='Remove'"; ?> onclick="<?php echo "window.open('RemICDRVS.php?caseno=$caseno&autono=$autono&user=$user', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=270');";?>" <?php echo ">X</button></div>
              </td>
";
      }
    }
    else{
echo "
              <td>
                <div align='center' class='btnstyle'><button type='button' class='btn rem' title='Remove'"; ?> onclick="<?php echo "window.open('RemICDRVS.php?caseno=$caseno&autono=$autono&user=$user', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=270');";?>" <?php echo ">X</button></div>
              </td>
";
    }
  }
}

echo "
            </tr>
          </table></div></td>
        </tr>
";
}

echo "
      </table></div></td>
    </tr>
    <tr>
      <td height='30'></td>
    </tr>
    <tr>
      <td><div align='left' class='arial s16 red bold'>Patient's Previous Admission Case Rate</div></td>
    </tr>
    <tr>
      <td height='5'></td>
    </tr>
    <tr>
      <td><div align='left'><table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='#FFF7E0'>
        <tr>
          <td class='t2 b2 l2' width='120' rowspan='2'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;'>Case No.</div></td>
          <td class='t2 b2 l1' width='100' rowspan='2'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;'>ICD/RVS Code</div></td>
          <td class='t2 b1 l1' colspan='3'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;'>Case Rate Amount</div></td>
          <td class='t2 b2 l1' width='150' rowspan='2'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;'>Type</div></td>
          <td class='t2 b2 l1' width='auto' rowspan='2' colspan='3'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;'>Description</div></td>
          <td class='t2 b1 l1 r2' width='150' colspan='2'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;'>Date</div></td>
        </tr>
        <tr>
          <td class='b2 l1' width='100'><div align='center' style='font-family: courier;font-size: 12px;font-weight: bold;color: #000000;'>Total</div></td>
          <td class='b2 l1' width='100'><div align='center' style='font-family: courier;font-size: 12px;font-weight: bold;color: #000000;'>HCI Share</div></td>
          <td class='b2 l1' width='100'><div align='center' style='font-family: courier;font-size: 12px;font-weight: bold;color: #000000;'>PF Share</div></td>
          <td class='b2 l1' width='100'><div align='center' style='font-family: courier;font-size: 12px;font-weight: bold;color: #000000;'>Addmitted</div></td>
          <td class='b2 l1 r2' width='100'><div align='center' style='font-family: courier;font-size: 12px;font-weight: bold;color: #000000;'>Discharged</div></td>
        </tr>
";

mysqli_query($conn,"SET NAMES 'utf8'");
$zxsql=mysqli_query($conn,"SELECT p.`patientidno`, p.`lastname`, p.`firstname`, p.`middlename`, p.`suffix`, a.`dateadmit` FROM `admission` a, `patientprofile` p WHERE a.`patientidno`=p.`patientidno` AND a.`caseno`='$caseno'");
$zxfetch=mysqli_fetch_array($zxsql);
$pid=$zxfetch['patientidno'];
$zln=trim($zxfetch['lastname']);
$zfn=trim($zxfetch['firstname']);
$zmn=trim($zxfetch['middlename']);
$zsf=trim($zxfetch['suffix']);
$zda=$zxfetch['dateadmit'];

$val=date('Y-m-d',(strtotime('-90 day',strtotime($zda))));

if($dept=="RDU"){
  $query="SELECT `caseno`, `dateadmit` FROM `admission` WHERE `patientidno`='$patid' AND `caseno` NOT LIKE '$caseno' AND (caseno LIKE '%I-%' OR `caseno` LIKE '%O-%' OR `caseno` LIKE '%R-%') ORDER BY dateadmit DESC";
}
else{
  $query="SELECT `caseno`, `dateadmit` FROM `admission` WHERE `patientidno`='$patid' AND `caseno` NOT LIKE '$caseno' AND (caseno LIKE '%I-%' OR `caseno` LIKE '%O-%') ORDER BY dateadmit DESC";
}

$wsql=mysqli_query($conn,$query);
while($wfetch=mysqli_fetch_array($wsql)){
$kcaseno=$wfetch['caseno'];
$kda=$wfetch['dateadmit'];

$rsql=mysqli_query($conn,"SELECT `datearray` FROM `dischargedtable` WHERE `caseno`='$kcaseno'");
$rcount=mysqli_num_rows($rsql);
if($rcount!=0){
  $rfetch=mysqli_fetch_array($rsql);
  $kdc=$rfetch['datearray'];
}
else{
  $kdc="";
}

$ysql=mysqli_query($conn,"SELECT `autono`, `icdcode`, `hospitalshare`, `pfshare`, `caseno`, `level`, `description`, `con`, `datetime`, `user` FROM `finalcaserate` WHERE `caseno`='$kcaseno' AND (`level`='primary' OR `level`='secondary') ORDER BY FIELD(`level`, 'primary', 'secondary'), CAST(`autono` AS UNSIGNED) ASC");
$ycount=mysqli_num_rows($ysql);

if($ycount!=0){
while($yfetch=mysqli_fetch_array($ysql)){
$autono=$yfetch['autono'];
$icdcode=$yfetch['icdcode'];
$hs=$yfetch['hospitalshare'];
$ps=$yfetch['pfshare'];
$level=$yfetch['level'];
$description=$yfetch['description'];
$con=$yfetch['con'];
$datetime=$yfetch['datetime'];
$suser=$yfetch['user'];

$acr=$hs+$ps;

if($level=="primary"){
  $type="1st Case Rate";
}
else if($level=="secondary"){
  $type="2nd Case Rate";
}
else{
  $type="Additional DX";
}

$yy=0;
$bgwarn="";$tcolor="#000000";
if($kdc!=""){
  $yysql=mysqli_query($conn,"SELECT `caseno` FROM `dischargedtable` WHERE `caseno`='$kcaseno' AND `datearray` BETWEEN '$val' AND '$zda'");
  $yy=mysqli_num_rows($yysql);

  if($yy!=0){
    if($pcs==$icdcode){
      $bgwarn="style='background-color: #FF0000;'";$tcolor="#FFFFFF";
    }
    else{
      if($scs==$icdcode){
        $bgwarn="style='background-color: #FF0000;'";$tcolor="#FFFFFF";
      }
      else{
        $bgwarn="";$tcolor="#000000";
      }
    }
  }
}

echo "
        <tr>
          <td class='b1 l2' height='35' $bgwarn><div align='center' style='font-family: courier;font-size: 12px;color: $tcolor;'>&nbsp;$kcaseno&nbsp;</div></td>
          <td class='b1 l1' height='35' $bgwarn><div align='center' style='font-family: courier;font-size: 12px;font-weight: bold;color: $tcolor;'>&nbsp;$icdcode&nbsp;</div></td>
          <td class='b1 l1' $bgwarn><div align='right' style='font-family: courier;font-size: 12px;color: $tcolor;'>&nbsp;".number_format($acr,2)."&nbsp;</div></td>
          <td class='b1 l1' $bgwarn><div align='right' style='font-family: courier;font-size: 12px;color: $tcolor;'>&nbsp;".number_format($hs,2)."&nbsp;</div></td>
          <td class='b1 l1' $bgwarn><div align='right' style='font-family: courier;font-size: 12px;color: $tcolor;'>&nbsp;".number_format($ps,2)."&nbsp;</div></td>
          <td class='b1 l1' $bgwarn><div align='center' style='font-family: courier;font-size: 12px;color: $tcolor;'>&nbsp;$type&nbsp;</div></td>
          <td width='3' class='b1 l1' $bgwarn></td>
          <td class='b1' $bgwarn><div align='left' style='font-family: courier;font-size: 12px;color: $tcolor;'>$description</div></td>
          <td width='3' class='b1' $bgwarn></td>
          <td class='b1 l1' $bgwarn><div align='center' style='font-family: courier;font-size: 12px;color: $tcolor;'>&nbsp;$kda&nbsp;</div></td>
          <td class='b1 l1 r2'$bgwarn><div align='center' style='font-family: courier;font-size: 12px;color: $tcolor;'>&nbsp;$kdc&nbsp;</div></td>
        </tr>
";
}
}
}

echo "
      </table></div></td>
    </tr>
";

if($dept=="RDU"){
  $zquery="SELECT a.`caseno`, a.`dateadmit`, a.`patientidno`, p.`lastname`, p.`firstname`, p.`middlename`, p.`suffix`, p.`dateofbirth`, a.`dateadmit` FROM `patientprofile` p, `admission` a WHERE p.`patientidno`=a.`patientidno` AND p.`patientidno` NOT LIKE '$pid' AND p.`lastname` LIKE '%$zln%' AND p.`firstname` LIKE '%$zfn%' AND (a.`caseno` LIKE '%I-%' OR a.`caseno` LIKE '%O-%' OR a.`caseno` LIKE '%R-%') ORDER BY a.`dateadmit` DESC";
}
else{
  $zquery="SELECT a.`caseno`, a.`dateadmit`, a.`patientidno`, p.`lastname`, p.`firstname`, p.`middlename`, p.`suffix`, p.`dateofbirth`, a.`dateadmit` FROM `patientprofile` p, `admission` a WHERE p.`patientidno`=a.`patientidno` AND p.`patientidno` NOT LIKE '$pid' AND p.`lastname` LIKE '%$zln%' AND p.`firstname` LIKE '%$zfn%' AND (a.`caseno` LIKE '%I-%' OR a.`caseno` LIKE '%O-%') ORDER BY a.`dateadmit` DESC";
}

$zwsql=mysqli_query($conn,$zquery);
$zwcount=mysqli_num_rows($zwsql);

if($zwcount>0){
echo "
    <tr>
      <td height='30'></td>
    </tr>
    <tr>
      <td><div align='left' class='arial s16 red bold'>Posible Patient's Previous Admission Case Rate (Duplicate Entry of Patient Record)</div></td>
    </tr>
    <tr>
      <td height='5'></td>
    </tr>
    <tr>
      <td><div align='left'><table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='#FFF7E0'>
        <tr>
          <td class='t2 b2 l2' width='120' rowspan='2'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;'>Case No.</div></td>
          <td class='t2 b2 l1' width='100' rowspan='2'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;'>Patient ID No.</div></td>
          <td class='t2 b2 l1' width='auto' rowspan='2'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;'>Patient Name</div></td>
          <td class='t2 b2 l1' width='100' rowspan='2'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;'>ICD/RVS Code</div></td>
          <td class='t2 b2 l1' width='150' rowspan='2'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;'>Type</div></td>
          <td class='t2 b2 l1' width='auto' rowspan='2' colspan='3'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;'>Description</div></td>
          <td class='t2 b1 l1 r2' width='150' colspan='2'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;'>Date</div></td>
        </tr>
        <tr>
          <td class='b2 l1' width='100'><div align='center' style='font-family: courier;font-size: 12px;font-weight: bold;color: #000000;'>Addmitted</div></td>
          <td class='b2 l1 r2' width='100'><div align='center' style='font-family: courier;font-size: 12px;font-weight: bold;color: #000000;'>Discharged</div></td>
        </tr>
";

while($zwfetch=mysqli_fetch_array($zwsql)){
$kpid=$zwfetch['patientidno'];
$kcaseno=$zwfetch['caseno'];
$kda=$zwfetch['dateadmit'];
$kln=trim($zwfetch['lastname']);
$kfn=trim($zwfetch['firstname']);
$kmn=trim($zwfetch['middlename']);
$ksf=trim($zwfetch['suffix']);
$kbd=$zwfetch['dateofbirth'];
$kda=$zwfetch['dateadmit'];

if($kmn!=""){$kmn=" ".$kmn;}else{$kmn="";}
if($ksf!=""){$ksf=" ".$ksf;}else{$ksf="";}
$kpn=$kln." ".$kfn.$ksf.$kmn;

$rsql=mysqli_query($conn,"SELECT `datearray` FROM `dischargedtable` WHERE `caseno`='$kcaseno'");
$rcount=mysqli_num_rows($rsql);
if($rcount!=0){
  $rfetch=mysqli_fetch_array($rsql);
  $kdc=$rfetch['datearray'];
}
else{
  $kdc="";
}

$ysql=mysqli_query($conn,"SELECT `autono`, `icdcode`, `hospitalshare`, `pfshare`, `caseno`, `level`, `description`, `con`, `datetime`, `user` FROM `finalcaserate` WHERE `caseno`='$kcaseno' AND (`level`='primary' OR `level`='secondary') ORDER BY FIELD(`level`, 'primary', 'secondary'), CAST(`autono` AS UNSIGNED) ASC");
$ycount=mysqli_num_rows($ysql);

if($ycount!=0){
while($yfetch=mysqli_fetch_array($ysql)){
$autono=$yfetch['autono'];
$icdcode=$yfetch['icdcode'];
$hs=$yfetch['hospitalshare'];
$ps=$yfetch['pfshare'];
$level=$yfetch['level'];
$description=$yfetch['description'];
$con=$yfetch['con'];
$datetime=$yfetch['datetime'];
$suser=$yfetch['user'];

$acr=$hs+$ps;

if($level=="primary"){
  $type="1st Case Rate";
}
else if($level=="secondary"){
  $type="2nd Case Rate";
}
else{
  $type="Additional DX";
}

$zz=0;
$zbgwarn="";$ztcolor="#000000";
if($kdc!=""){
  $zzsql=mysqli_query($conn,"SELECT `caseno` FROM `dischargedtable` WHERE `caseno`='$kcaseno' AND `datearray` BETWEEN '$val' AND '$zda'");
  $zz=mysqli_num_rows($zzsql);

  if($zz!=0){
    if($pcs==$icdcode){
      $zbgwarn="style='background-color: #FF0000;'";$ztcolor="#FFFFFF";
    }
    else{
      if($scs==$icdcode){
        $zbgwarn="style='background-color: #FF0000;'";$ztcolor="#FFFFFF";
      }
      else{
        $zbgwarn="";$ztcolor="#000000";
      }
    }
  }
}

echo "
        <tr>
          <td class='b1 l2' height='35' $zbgwarn><div align='center' style='font-family: courier;font-size: 12px;color: $ztcolor;'>&nbsp;$kcaseno&nbsp;</div></td>
          <td class='b1 l1' height='35' $zbgwarn><div align='center' style='font-family: courier;font-size: 12px;font-weight: bold;color: $ztcolor;'>&nbsp;$kpid&nbsp;</div></td>
          <td class='b1 l1' height='35' $zbgwarn><div align='left' style='font-family: courier;font-size: 12px;font-weight: bold;color: $ztcolor;'>&nbsp;$kpn&nbsp;</div></td>
          <td class='b1 l1' height='35' $zbgwarn><div align='center' style='font-family: courier;font-size: 12px;font-weight: bold;color: $ztcolor;'>&nbsp;$icdcode&nbsp;</div></td>
          <td class='b1 l1' $zbgwarn><div align='center' style='font-family: courier;font-size: 12px;color: $ztcolor;'>&nbsp;$type&nbsp;</div></td>
          <td width='3' $zbgwarn class='b1 l1'></td>
          <td class='b1' $zbgwarn><div align='left' style='font-family: courier;font-size: 12px;color: $ztcolor;'>$description</div></td>
          <td width='3' $zbgwarn class='b1'></td>
          <td class='b1 l1' $zbgwarn><div align='center' style='font-family: courier;font-size: 12px;color: $ztcolor;'>&nbsp;$kda&nbsp;</div></td>
          <td class='b1 l1 r2' $zbgwarn><div align='center' style='font-family: courier;font-size: 12px;color: $ztcolor;'>&nbsp;$kdc&nbsp;</div></td>
        </tr>
";
}
}
}

echo "
      </table></div></td>
    </tr>
";
}

echo "
  </table>
</div>
";

if(!isset($_GET['noclose'])){
  echo "<META HTTP-EQUIV='Refresh'CONTENT='300;URL=Close.php'>";
}


?>
</body>
</html>
