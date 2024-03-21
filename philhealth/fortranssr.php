<?php
ini_set("display_errors","Off");
include("../extra/outcon.php");
include("../extra/Settings.php");

$view=$_GET['view'];
$show=$_GET['show'];
$page=$_GET['page'];
$datax=base64_decode($_GET['datax']);
$searchme=$_GET['searchme'];
$user=$_GET['user'];
$userunique=$_GET['userunique'];

$ip="192.168.0.100:100";

echo "
<style>
  .h2 {
    font-size: 30px;
    font-family: Arial;
    font-weight: bold;
    animation: animate 1.5s linear infinite;
  }

  @keyframes animate {
    0% {
      opacity: 0;
    }

    50% {
      opacity: 0.7;
    }

    100% {
      opacity: 0;
    }
  }

  .warn30over {
    -webkit-animation: warn30over 1s infinite;  /* Safari 4+ */
    -moz-animation: warn30over 1s infinite;  /* Fx 5+ */
    -o-animation: warn30over 1s infinite;  /* Opera 12+ */
    animation: warn30over 1s infinite;  /* IE 10+, Fx 29+ */
  }

  @-webkit-keyframes warn30over {
    0%, 49% {
      background-color: #b8d1f3;
      color: #000000;
      height: 100%;
    }
    50%, 100% {
      background-color: #F54432;
      color: #FFFFFF;
      height: 100%;
    }
  }

  .warn5days {
    -webkit-animation: warn5days 1s infinite;  /* Safari 4+ */
    -moz-animation: warn5days 1s infinite;  /* Fx 5+ */
    -o-animation: warn5days 1s infinite;  /* Opera 12+ */
    animation: warn5days 1s infinite;  /* IE 10+, Fx 29+ */
  }

  @-webkit-keyframes warn5days {
    0%, 49% {
      background-color: #b8d1f3;
      color: #000000;
      height: 100%;
    }
    50%, 100% {
      background-color: #931003;
      color: #FFFFFF;
      height: 100%;
    }
  }

  .warnover {
    -webkit-animation: warnover 1s infinite;  /* Safari 4+ */
    -moz-animation: warnover 1s infinite;  /* Fx 5+ */
    -o-animation: warnover 1s infinite;  /* Opera 12+ */
    animation: warnover 1s infinite;  /* IE 10+, Fx 29+ */
  }

  @-webkit-keyframes warnover {
    0%, 49% {
      background-color: #b8d1f3;
      color: #000000;
      height: 100%;
    }
    50%, 100% {
      background-color: #370601;
      color: #FFFFFF;
      height: 100%;
    }
  }

  .warn3040 {
    -webkit-animation: warn3040 1s infinite;  /* Safari 4+ */
    -moz-animation: warn3040 1s infinite;  /* Fx 5+ */
    -o-animation: warn3040 1s infinite;  /* Opera 12+ */
    animation: warn3040 1s infinite;  /* IE 10+, Fx 29+ */
  }

  @-webkit-keyframes warn3040 {
    0%, 49% {
      background-color: #b8d1f3;
      color: #000000;
      height: 100%;
    }
    50%, 100% {
      background-color: #DC7633;
      color: #FFFFFF;
      height: 100%;
    }
  }
</style>
";

echo "
<div align='center'>
";

$len=strlen($searchme);
if($len>1){
mysqli_query($mycon1,"SET NAMES 'utf8'");

echo "
  <table border='0' width='100%' cellpadding='0' cellspacing='0'>
    <tr>
      <td><table border='0' width='100%' cellpadding='0' cellspacing='0' class='hoverTable'>
        <tr>
          <td class='t2 b2 l2' width='30'><div align='center' class='arial s12 black bold'>#</div></td>
          <td class='t2 b2 l1' width='30'><div align='center' class='arial s12 black bold'><input type='checkbox' name='test' value='' /></div></td>
          <td class='t2 b2 l1' width='60'><div align='center' class='arial s12 black bold'>Days</div></td>
          <td class='t2 b2 l1'><div align='center' class='arial s12 black bold'>Patient Name</div></td>
          <td class='t2 b2 l1' width='100'><div align='center' class='arial s12 black bold'>Patient Type</div></td>
          <td class='t2 b2 l1' width='200'><div align='center' class='arial s12 black bold'>Confinement Period</div></td>
          <td class='t2 b2 l1' width='150'><div align='center' class='arial s12 black bold'>Case Rate</div></td>
          <td class='t2 b2 l1' width='150'><div align='center' class='arial s12 black bold'>Claim Status</div></td>
          <td class='t2 b2 l1' width='150'><div align='center' class='arial s12 black bold' title='Date Transmitted'>Date Trans.</div></td>
          <td class='t2 b2 l1 r2' width='100'><div align='center' class='arial s12 black bold'>Action</div></td>
        </tr>
";

$a=0;
$asql=mysqli_query($mycon1,"SELECT dt.`caseno`, dt.`datedischarged`, dt.`timedischarged`, dt.`datearray`, a.`patientidno`, a.`dateadmit`, a.`membership`, p.`lastname`, p.`firstname`, p.`middlename`, p.`suffix` FROM `dischargedtable` dt, `admission` a, `patientprofile` p WHERE dt.`caseno`=a.`caseno` AND a.`patientidno`=p.`patientidno` AND a.`membership`='phic-med' AND dt.`count` NOT LIKE '9' AND a.`caseno` NOT LIKE '%R-%' AND (CONCAT(p.lastname, ' ', p.firstname, ' ', p.middlename) LIKE '%$searchme%' OR a.`caseno`='$searchme') ORDER BY dt.`datearray`, dt.`patientname` LIMIT 0,$show");
while($afetch=mysqli_fetch_array($asql)){
$caseno=$afetch['caseno'];
$datedischarged=$afetch['datedischarged'];
$timedischarged=$afetch['timedischarged'];
$datearray=$afetch['datearray'];
$a++;

$patientidno=$afetch['patientidno'];
$dateadmit=$afetch['dateadmit'];
$membership=$afetch['membership'];

$csql=mysqli_query($mycon1,"SELECT * FROM `patientprofile` WHERE `patientidno`='$patientidno'");
$cfetch=mysqli_fetch_array($csql);
$ln=$cfetch['lastname'];
$fn=$cfetch['firstname'];
$mn=$cfetch['middlename'];
$sf=$cfetch['suffix'];

$cr="";
$d=0;
$dsql=mysqli_query($mycon1,"SELECT `icdcode` FROM `finalcaserate` WHERE `caseno`='$caseno' AND (`level`='primary' OR `level`='secondary')");
$dcount=mysqli_num_rows($dsql);
while($dfetch=mysqli_fetch_array($dsql)){
$d++;

if(($d!=1)){$ck="; ";}else{$ck="";}
  $ic=$dfetch['icdcode'];
  $cr=$cr.$ck.$ic;
}


$strStart=$datearray;
$strEnd=date("Y-m-d");
$from=$strStart;
$to=$strEnd;
$total=strtotime($to) - strtotime($from);
$days=round($total / (60 * 60 * 24));
$val=$days;

if(stripos($caseno, "I-") !== FALSE){
  $pattype="IPD";
}
else if(stripos($caseno, "O-") !== FALSE){
  $pattype="OPD";
}
else if(stripos($caseno, "R-") !== FALSE){
  $pattype="RDU";
}
else{
  $pattype=$caseno;
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
$ecsql=mysqli_query($mycon3,"SELECT `status` FROM `caseno` WHERE `caseno`='$caseno'");
$eccount=mysqli_num_rows($ecsql);
if($eccount==0){
  $ecstat="Not in eClaims";
  $dt="";
  $datetransmitted="";

  $ipbtn="on";
}
else{
  $ecfetch=mysqli_fetch_array($ecsql);
  $ecstatus=$ecfetch['status'];
  $ipbtn="";

  if($ecstatus=="transmitted"){
    $ecsisql=mysqli_query($mycon4,"SELECT `pStatus` FROM `statusinfo` WHERE `caseno`='$caseno'");
    $ecsifetch=mysqli_fetch_array($ecsisql);
    $pStatus=$ecsifetch['pStatus'];

    $ectsql=mysqli_query($mycon4,"SELECT `datetransmitted`, `timetransmitted` FROM `transmittedlist` WHERE `caseno`='$caseno'");
    $ectfetch=mysqli_fetch_array($ectsql);
    $datetransmitted=date("Y-m-d",strtotime($ectfetch['datetransmitted']));
    $timetransmitted=$ectfetch['timetransmitted'];

    $dt=date("M d, Y",strtotime($datetransmitted));

    if($pStatus==""){
      $ecstat=strtoupper($ecstatus);
    }
    else{
      $ecstat=$pStatus;
    }
  }
  else{
    $ecstat=strtoupper($ecstatus);
    $dt="";
    $datetransmitted="";
  }

}
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

if(($val>30)&&($val<55)){
  $warn="warn30over";
}
else if(($val>54)&&($val<61)){
  $warn="warn5days";
}
else if($val>60){
  $warn="warnover";
}
else{
  $warn="";
}

if(stripos($caseno, "I-") !== FALSE){$mh="&inp";}else{$mh="&otp";}

echo "
        <tr>
          <td class='b1 l2' height='30'><div align='left' class='arial s14 black'>&nbsp;$a&nbsp;</div></td>
          <td class='b1 l1'><div align='center' class='arial s14 black'><input type='checkbox' name='test' value='' /></div></td>
          <td class='b1 l1 $warn'><div align='left' class='arial s14'>&nbsp;$val&nbsp;</div></td>
          <td class='b1 l1'><div align='left' class='arial s14 black'>&nbsp;$ln, $fn $sf $mn&nbsp;</div></td>
          <td class='b1 l1'><div align='center' class='arial s14 black'>&nbsp;$pattype&nbsp;</div></td>
          <td class='b1 l1'><div align='center' class='arial s14 black'>".date("M d, Y",strtotime($dateadmit))." to ".date("M d, Y",strtotime($datearray))."</div></td>
          <td class='b1 l1'><div align='center' class='arial s14 black'>$cr</div></td>
          <td class='b1 l1'><div align='center' class='arial s14 black'>$ecstat</div></td>
          <td class='b1 l1'><div align='center' class='arial s14 black'>$dt</div></td>
          <td class='b1 l1 r2' valign='middle'><div align='center' class='arial s14 black btnstyle'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
";

if($ipbtn=="on"){
echo "
              <td><button type='button' class='btn import' title='Import to eClaims'";?> onclick="<?php echo "window.open('../extra/eClaims/Porter.php?patientidno=$patientidno&caseno=$caseno&uname=$user', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=300,left=700,width=600,height=250');"; ?>" <?php echo "><i class='icofont-upload-alt'></i></button></td>
";
}
else{
echo "
              <td><button type='button' class='btn dis' title='Already Imported' disabled><i class='icofont-upload-alt'></i></button></td>
";
}


echo "
              <td width='2'></td>
              <td><a href='../philhealth/?details$mh&caseno=$caseno' target='_blank'><button type='button' class='btn view' title='View Details'><i class='icofont-eye-alt'></i></button></a></td>
              <td width='2'></td>
              <td><button type='button' class='btn add' title='Add'"; ?> onclick="<?php echo "window.open('AddPatientPending.php?patientidno=$patientidno&caseno=$caseno&uname=$user&dt=$datetransmitted', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=700,width=450,height=710');";?>" <?php echo "><i class='icofont-plus-circle'></i></button></td>
            </tr>
          </table></div></td>
        </tr>

";
}

echo "
        <tr>
          <td colspan='10' class='t2'></td>
        </tr>
      </table></td>
    </tr>
  </table>
";
}
else{
echo "
  <table border='0' width='100%' cellpadding='0' cellspacing='0'>
    <tr>
      <td>
        <table border='0' width='100%' cellpadding='0' cellspacing='0'>
          <tr>
            <td><table border='0' width='100%' cellpadding='0' cellspacing='0' class='hoverTable'>
              <tr>
                <td class='t2 b2 l2' width='30'><div align='center' class='arial s12 black bold'>#</div></td>
                <td class='t2 b2 l1' width='30'><div align='center' class='arial s12 black bold'><input type='checkbox' name='test' value='' /></div></td>
                <td class='t2 b2 l1' width='60'><div align='center' class='arial s12 black bold'>Days</div></td>
                <td class='t2 b2 l1'><div align='center' class='arial s12 black bold'>Patient Name</div></td>
                <td class='t2 b2 l1' width='100'><div align='center' class='arial s12 black bold'>Patient Type</div></td>
                <td class='t2 b2 l1' width='200'><div align='center' class='arial s12 black bold'>Confinement Period</div></td>
                <td class='t2 b2 l1' width='150'><div align='center' class='arial s12 black bold'>Case Rate</div></td>
                <td class='t2 b2 l1' width='150'><div align='center' class='arial s12 black bold'>Claim Status</div></td>
                <td class='t2 b2 l1' width='150'><div align='center' class='arial s12 black bold' title='Date Transmitted'>Date Trans.</div></td>
                <td class='t2 b2 l1 r2' width='100'><div align='center' class='arial s12 black bold'>Action</div></td>
              </tr>
";

mysqli_query($mycon1,"SET NAMES 'utf8'");

$a=$page;
$asql=mysqli_query($mycon1,"SELECT dt.`caseno`, dt.`datedischarged`, dt.`timedischarged`, dt.`datearray`, a.`patientidno`, a.`dateadmit`, a.`membership` FROM `dischargedtable` dt, `admission` a WHERE dt.`caseno`=a.`caseno` AND a.`membership`='phic-med' AND dt.`count` NOT LIKE '9' AND a.`caseno` NOT LIKE '%R-%' ORDER BY dt.`datearray`, dt.`patientname` LIMIT $page,$show");
while($afetch=mysqli_fetch_array($asql)){
$caseno=$afetch['caseno'];
$datedischarged=$afetch['datedischarged'];
$timedischarged=$afetch['timedischarged'];
$datearray=$afetch['datearray'];
$a++;

$patientidno=$afetch['patientidno'];
$dateadmit=$afetch['dateadmit'];
$membership=$afetch['membership'];

$csql=mysqli_query($mycon1,"SELECT * FROM `patientprofile` WHERE `patientidno`='$patientidno'");
$cfetch=mysqli_fetch_array($csql);
$ln=$cfetch['lastname'];
$fn=$cfetch['firstname'];
$mn=$cfetch['middlename'];
$sf=$cfetch['suffix'];

$cr="";
$d=0;
$dsql=mysqli_query($mycon1,"SELECT `icdcode` FROM `finalcaserate` WHERE `caseno`='$caseno' AND (`level`='primary' OR `level`='secondary')");
$dcount=mysqli_num_rows($dsql);
while($dfetch=mysqli_fetch_array($dsql)){
$d++;

if(($d!=1)){$ck="; ";}else{$ck="";}
  $ic=$dfetch['icdcode'];
  $cr=$cr.$ck.$ic;
}


$strStart=$datearray;
$strEnd=date("Y-m-d");
$from=$strStart;
$to=$strEnd;
$total=strtotime($to) - strtotime($from);
$days=round($total / (60 * 60 * 24));
$val=$days;

if(stripos($caseno, "I-") !== FALSE){
  $pattype="IPD";
}
else if(stripos($caseno, "O-") !== FALSE){
  $pattype="OPD";
}
else if(stripos($caseno, "R-") !== FALSE){
  $pattype="RDU";
}
else{
  $pattype=$caseno;
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
$ecsql=mysqli_query($mycon3,"SELECT `status` FROM `caseno` WHERE `caseno`='$caseno'");
$eccount=mysqli_num_rows($ecsql);
if($eccount==0){
  $ecstat="Not in eClaims";
  $dt="";
  $datetransmitted="";

  $ipbtn2="on";
}
else{
  $ecfetch=mysqli_fetch_array($ecsql);
  $ecstatus=$ecfetch['status'];
  $ipbtn2="";

  if($ecstatus=="transmitted"){
    $ecsisql=mysqli_query($mycon4,"SELECT `pStatus` FROM `statusinfo` WHERE `caseno`='$caseno'");
    $ecsifetch=mysqli_fetch_array($ecsisql);
    $pStatus=$ecsifetch['pStatus'];

    $ectsql=mysqli_query($mycon4,"SELECT `datetransmitted`, `timetransmitted` FROM `transmittedlist` WHERE `caseno`='$caseno'");
    $ectfetch=mysqli_fetch_array($ectsql);
    $datetransmitted=date("Y-m-d",strtotime($ectfetch['datetransmitted']));
    $timetransmitted=$ectfetch['timetransmitted'];

    $dt=date("M d, Y",strtotime($datetransmitted));

    if($pStatus==""){
      $ecstat=strtoupper($ecstatus);
    }
    else{
      $ecstat=$pStatus;
    }
  }
  else{
    $ecstat=strtoupper($ecstatus);
    $dt="";
    $datetransmitted="";
  }

}

if(($val>30)&&($val<55)){
  $warn="warn30over";
}
else if(($val>54)&&($val<61)){
  $warn="warn5days";
}
else if($val>60){
  $warn="warnover";
}
else{
  $warn="";
}
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

echo "
              <tr>
                <td class='b1 l2' height='30'><div align='left' class='arial s14 black'>&nbsp;$a&nbsp;</div></td>
                <td class='b1 l1'><div align='center' class='arial s14 black'><input type='checkbox' name='test' value='' /></div></td>
                <td class='b1 l1 $warn'><div align='left' class='arial s14'>&nbsp;$val&nbsp;</div></td>
                <td class='b1 l1'><div align='left' class='arial s14 black'>&nbsp;$ln, $fn $sf $mn&nbsp;</div></td>
                <td class='b1 l1'><div align='center' class='arial s14 black'>&nbsp;$pattype&nbsp;</div></td>
                <td class='b1 l1'><div align='center' class='arial s14 black'>".date("M d, Y",strtotime($dateadmit))." to ".date("M d, Y",strtotime($datearray))."</div></td>
                <td class='b1 l1'><div align='center' class='arial s14 black'>$cr</div></td>
                <td class='b1 l1'><div align='center' class='arial s14 black'>$ecstat</div></td>
                <td class='b1 l1'><div align='center' class='arial s14 black'>$dt</div></td>
                <td class='b1 l1 r2' valign='middle'><div align='center' class='arial s14 black btnstyle'><table border='0' cellpadding='0' cellspacing='0'>
                  <tr>
";

if($ipbtn2=="on"){
echo "
                    <td><button type='button' class='btn import' title='Import to eClaims'";?> onclick="<?php echo "window.open('../extra/eClaims/Porter.php?patientidno=$patientidno&caseno=$caseno&uname=$user', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=300,left=700,width=600,height=250');"; ?>" <?php echo "><i class='icofont-upload-alt'></i></button></td>
";
}
else{
echo "
                    <td><button type='button' class='btn dis' title='Already Imported' disabled><i class='fa fa-cloud-upload'></i></button></td>
";
}


echo "
                    <td width='2'></td>
                    <!-- td><a href='../../2021codes/BillMe/?caseno=$caseno&nursename=$user&user=$userunique&branch=KMSCI&dept=PHILHEALTH' target='_blank'><button type='button' class='btn view' title='View Details'><i class='icofont-eye-alt'></i></button></a></td -->
                    <td><a href='../philhealth/?view=detail&dept=MEDICARE&caseno=$caseno&username=$user&userunique=$userunique&dept=MEDICARE&branch=&mm=&dd=&yy=' target='_blank'><button type='button' class='btn view' title='View Details'><i class='icofont-eye-alt'></i></button></a></td>
                    <td width='2'></td>
                    <td><button type='button' class='btn add' title='Add'"; ?> onclick="<?php echo "window.open('AddPatientPending.php?patientidno=$patientidno&caseno=$caseno&uname=$user&dt=$datetransmitted', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=700,width=450,height=710');";?>" <?php echo "><i class='icofont-plus-circle'></i></button></td>
                  </tr>
                </table></div></td>
              </tr>
";
}

echo "
              <tr>
                <td colspan='10' class='t2'></td>
              </tr>
            </table></td>
          </tr>
        </table>
      </div></td>
    </tr>
    <tr>
      <td height='5'></td>
    </tr>
    <tr>
      <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
          <td>
";

$pagesql=mysqli_query($mycon1,"SELECT dt.`caseno`, dt.`datedischarged`, dt.`timedischarged`, dt.`datearray`, a.`patientidno`, a.`dateadmit`, a.`membership` FROM `dischargedtable` dt, `admission` a WHERE dt.`caseno`=a.`caseno` AND a.`membership`='phic-med' AND dt.`count` NOT LIKE '9' AND a.`caseno` NOT LIKE '%R-%'");
$pagecount=mysqli_num_rows($pagesql);

if($pagecount<=$show){
$pagenum=1;
$totalpage=1;
$prevpage=0;
$nxtpage=0;
}
else if($pagecount>$show){
$var1=$pagecount/$show;
$var1fmt=number_format($var1,0,'.',',');
if($var1fmt>=$var1){
$var2=$var1fmt-1;
}
else{
$var2=$var1fmt;
}
if($var1==$var2){
$totalpage=$var2;
}
else{
$totalpage=$var2+1;
}

$pagenum=($page+$show)/$show;
$pagelimit=$var2*$show;

if($page=='0'){
$prevpage=0;
$nxtpage=$page+$show;
}
else if(($page!='0')&&($page!=$pagelimit)){
$prevpage=$page-$show;
$nxtpage=$page+$show;
}
else if($page==$pagelimit){
$prevpage=$page-$show;
$nxtpage=$page;
}
}

echo "
            <table width='100%' border='0' cellspacing='0' cellpadding='0'>
              <tr>
                <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
                  <tr>
                    <td width='50%'><div align='left'><span class='arial s12 black bold'>Showing </span><span class='arial s13 blue'>".($page+1)." to ".($page+$show)." of $pagecount</span> | <span class='arial s12 black bold'>Page: </span><span class='arial s13 blue'>$pagenum of $totalpage</span></div></td>
                    <td width='50%'><div align='right'>
                      <table border='0' cellspacing='0' cellpadding='0'>
";

if($pagecount<=$show){
echo "
                        <tr>
                          <td>
                            <input name='Submit4' type='submit' class='button13' value='  &lt;   ' disabled />
                          </td>
                          <td width='2'></td>
                          <td><div align='center'>
                            <input type='text' name='pagest' value='".($pagenum)."' style='height: 28px;width: 50px;text-align: center;border: 1px solid blue;padding: 0;' disabled />
                          </div></td>
                          <td width='2'></td>
                          <td>
                            <input name='Submit5' type='submit' class='button13' value='  &gt;  ' disabled />
                          </td>
                        </tr>
";
}
else if($pagecount>$show){
if($page=='0'){
echo "
                        <tr>
                          <td>
                            <input name='Submit4' type='submit' class='button13' value='  &lt;   ' disabled />
                          </td>
                          <td width='2'></td>
                          <td><div align='center'><form name='ShortPage' method='post' action='../philhealth/?ft&show=$show'>
                            <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td><input type='text' name='pagest' value='".($pagenum)."' style='height: 28px;width: 50px;text-align: center;border: 1px solid blue;padding: 0;' autocomplete='off' /></td>
                              </tr>
                            </table>
                          </form></div></td>
                          <td width='2'></td>
                          <td>
                            <a href='../philhealth/?ft&show=$show&page=".($nxtpage)."'><input name='Submit5' type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;' value='  &gt;  ' /></a>
                          </td>
                        </tr>
";
}
else if(($page!=0)&&($nxtpage!=$page)){
echo "
                        <tr>
                          <td>
                            <a href='../philhealth/?ft&show=$show&page=".($prevpage)."'><input name='Submit4' type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;' value='  &lt;   ' /></a>
                          </td>
                          <td width='2'></td>
                          <td><div align='center'><form name='ShortPage' method='post' action='../philhealth/?ft&show=$show'>
                            <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td><input type='text' name='pagest' value='".($pagenum)."' style='height: 28px;width: 50px;text-align: center;border: 1px solid blue;padding: 0;' autocomplete='off' /></td>
                              </tr>
                            </table>
                          </form></div></td>
                          <td width='2'></td>
                          <td>
                            <a href='../philhealth/?ft&show=$show&page=".($nxtpage)."'><input name='Submit5' type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;' value='  &gt;  ' /></a>
                          </td>
                        </tr>
";
}
else if($nxtpage==$page){
echo "
                        <tr>
                          <td>
                            <a href='../philhealth/?ft&show=$show&page=".($prevpage)."'><input name='Submit4' type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;' value='  &lt;   ' /></a>
                          </td>
                          <td width='2'></td>
                          <td><div align='center'><form name='ShortPage' method='post' action='../philhealth/?ft&show=$show'>
                            <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td><input type='text' name='pagest' value='".($pagenum)."' style='height: 28px;width: 50px;text-align: center;border: 1px solid blue;padding: 0;' autocomplete='off' /></td>
                              </tr>
                            </table>
                          </form></div></td>
                          <td width='2'></td>
                          <td>
                            <input name='Submit5' type='submit' class='button13' value='  &gt;  ' disabled />
                          </td>
                        </tr>
";
}
}

echo "
                      </table>
                    </div></td>
                  </tr>
                </table></td>
              </tr>
            </table>
          </td>
        </tr>
      </table></td>
    </tr>
  </table>
";
}

echo "
</div>
";
?>
