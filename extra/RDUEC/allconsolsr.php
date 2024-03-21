<?php
ini_set("display_errors","On");
include("../../main/connection.php");
include("../outcon.php");

$view=$_GET['view'];
$show=$_GET['show'];
$page=$_GET['page'];
$searchme=$_GET['searchme'];
$yiy=$_GET['yiy'];
$xix=$_GET['xix'];

echo "
<style>
  .h2 {
    font-size: 30px;
    font-family: Arial;
    font-weight: bold;
    animation: animate 1.5s linear infinite;
  }

  @keyframes animate {
    0% {opacity: 0;}
    50% {opacity: 0.7;}
    100% {opacity: 0;}
  }

  .warn30over {
    -webkit-animation: warn30over 1s infinite;  /* Safari 4+ */
    -moz-animation: warn30over 1s infinite;  /* Fx 5+ */
    -o-animation: warn30over 1s infinite;  /* Opera 12+ */
    animation: warn30over 1s infinite;  /* IE 10+, Fx 29+ */
  }

  @-webkit-keyframes warn30over {
    0%, 49% {background-color: #FFFFFF;color: #000000;height: 100%;}
    50%, 100% {background-color: #F54432;color: #FFFFFF;height: 100%;}
  }

  .warn5days {
    -webkit-animation: warn5days 1s infinite;  /* Safari 4+ */
    -moz-animation: warn5days 1s infinite;  /* Fx 5+ */
    -o-animation: warn5days 1s infinite;  /* Opera 12+ */
    animation: warn5days 1s infinite;  /* IE 10+, Fx 29+ */
  }

  @-webkit-keyframes warn5days {
    0%, 49% {background-color: #FFFFFF;color: #000000;height: 100%;}
    50%, 100% {background-color: #931003;color: #FFFFFF;height: 100%;}
  }

  .warnover {
    -webkit-animation: warnover 1s infinite;  /* Safari 4+ */
    -moz-animation: warnover 1s infinite;  /* Fx 5+ */
    -o-animation: warnover 1s infinite;  /* Opera 12+ */
    animation: warnover 1s infinite;  /* IE 10+, Fx 29+ */
  }

  @-webkit-keyframes warnover {
    0%, 49% {background-color: #FFFFFF;color: #000000;height: 100%;}
    50%, 100% {background-color: #370601;color: #FFFFFF;height: 100%;}
  }

  .warn3040 {
    -webkit-animation: warn3040 1s infinite;  /* Safari 4+ */
    -moz-animation: warn3040 1s infinite;  /* Fx 5+ */
    -o-animation: warn3040 1s infinite;  /* Opera 12+ */
    animation: warn3040 1s infinite;  /* IE 10+, Fx 29+ */
  }

  @-webkit-keyframes warn3040 {
    0%, 49% {background-color: #FFFFFF;color: #000000;height: 100%;}
    50%, 100% {background-color: #DC7633;color: #FFFFFF;height: 100%;}
  }
</style>
";

echo "
<div align='center'>
";

$len=strlen($searchme);
if($len>1){
mysqli_query($conn,"SET NAMES 'utf8'");

echo "
  <table border='0' width='100%' cellpadding='0' cellspacing='0'>
    <tr>
      <td><table border='0' width='100%' cellpadding='0' cellspacing='0' class='hoverTable'>
        <tr>
          <td class='t2 b2 l2' width='30'><div align='center' class='arial s12 black bold'>#</div></td>
          <td class='t2 b2 l1' width='30'><div align='center' class='arial s12 black bold'><input type='checkbox' name='test' value='' /></div></td>
          <td class='t2 b2 l1' width='60'><div align='center' class='arial s12 black bold'>Days</div></td>
          <td class='t2 b2 l1' width='160'><div align='center' class='arial s12 black bold'>Case No.</div></td>
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
$asql=mysqli_query($conn,"SELECT `caseno`, `patid`, `dateadmit`, `patientname`, `rducaseno` FROM `rduconsolidate` WHERE `patientname` LIKE '%$searchme%' GROUP BY `rducaseno` ORDER BY `dateadmit`");
while($afetch=mysqli_fetch_array($asql)){
$caseno=$afetch['caseno'];
$rducaseno=$afetch['rducaseno'];
$patientidno=$afetch['patid'];
$patientname=$afetch['patientname'];
$a++;

$rdc1sql=mysqli_query($conn,"SELECT `dateadmit` FROM `rduconsolidate` WHERE `rducaseno`='$rducaseno' ORDER BY `dateadmit` ASC");
$rdc1fetch=mysqli_fetch_array($rdc1sql);
$dateadm=$rdc1fetch['dateadmit'];

$rdc2sql=mysqli_query($conn,"SELECT `dateadmit` FROM `rduconsolidate` WHERE `rducaseno`='$rducaseno' ORDER BY `dateadmit` DESC");
$rdc2fetch=mysqli_fetch_array($rdc2sql);
$datedis=$rdc2fetch['dateadmit'];

$cr="";
$d=0;
$dsql=mysqli_query($conn,"SELECT `icdcode` FROM `finalcaserate` WHERE `caseno`='$caseno' AND (`level`='primary' OR `level`='secondary')");
$dcount=mysqli_num_rows($dsql);
while($dfetch=mysqli_fetch_array($dsql)){
$d++;

if(($d!=1)){$ck="; ";}else{$ck="";}
  $ic=$dfetch['icdcode'];
  $cr=$cr.$ck.$ic;
}

$strStart=$datedis;
$strEnd=date("Y-m-d");
$from=$strStart;
$to=$strEnd;
$total=strtotime($to) - strtotime($from);
$days=round($total / (60 * 60 * 24));
$val=$days;

if(stripos($caseno, "I-") !== FALSE){$pattype="IPD";}
else if(stripos($caseno, "O-") !== FALSE){$pattype="OPD";}
else if(stripos($caseno, "R-") !== FALSE){$pattype="RDU";}
else{$pattype=$caseno;}

if(($val>30)&&($val<55)){$warn="warn30over";}
else if(($val>54)&&($val<61)){$warn="warn5days";}
else if($val>60){$warn="warnover";}
else{$warn="";}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
$ecsql=mysqli_query($mycon3,"SELECT `status` FROM `caseno` WHERE `caseno`='$rducaseno'");
$eccount=mysqli_num_rows($ecsql);
if($eccount==0){
  $ecstat="Not in eClaims";
  $dt="";
  $datetransmitted="";

  $ipbtn=1;
  $epbtn=1;
}
else{
  $ecfetch=mysqli_fetch_array($ecsql);
  $ecstatus=$ecfetch['status'];
  $ipbtn=0;
  $epbtn=0;

  if($ecstatus=="transmitted"){
    $ecsisql=mysqli_query($mycon4,"SELECT `pStatus` FROM `statusinfo` WHERE `caseno`='$rducaseno'");
    $ecsifetch=mysqli_fetch_array($ecsisql);
    $pStatus=$ecsifetch['pStatus'];

    $ectsql=mysqli_query($mycon4,"SELECT `datetransmitted`, `timetransmitted` FROM `transmittedlist` WHERE `caseno`='$rducaseno'");
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

echo "
        <tr>
          <td class='b1 l2' height='30'><div align='left' class='arial s14 black'>&nbsp;$a&nbsp;</div></td>
          <td class='b1 l1'><div align='center' class='arial s14 black'><input type='checkbox' name='test' value='' /></div></td>
          <td class='b1 l1 $warn'><div align='left' class='arial s14'>&nbsp;$val&nbsp;</div></td>
          <td class='b1 l1'><div align='center' class='arial s14 black'>&nbsp;$rducaseno&nbsp;</div></td>
          <td class='b1 l1'><div align='left' class='arial s14 black'>&nbsp;$patientname&nbsp;</div></td>
          <td class='b1 l1'><div align='center' class='arial s14 black'>&nbsp;$pattype&nbsp;</div></td>
          <td class='b1 l1'><div align='center' class='arial s14 black'>".date("M d, Y",strtotime($dateadm))." to ".date("M d, Y",strtotime($datedis))."</div></td>
          <td class='b1 l1'><div align='center' class='arial s14 black'>$cr</div></td>
          <td class='b1 l1'><div align='center' class='arial s14 black'>$ecstat</div></td>
          <td class='b1 l1'><div align='center' class='arial s14 black'>$dt</div></td>
          <td class='b1 l1 r2' valign='middle'><div align='center' class='arial s14 black btnstyle'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
";

if($ipbtn==1){
echo "
              <td><button type='button' class='btn import' style='cursor: pointer;' title='Add'"; ?> onclick="<?php echo "window.open('http://".$_SERVER['HTTP_HOST']."/2022codes/eClaimsRDU/Porter.php?patientidno=$patientidno&caseno=$rducaseno&lastcaseno=$caseno&uname=".base64_decode($xix)."', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=300,left=700,width=600,height=250');";?>" <?php echo ">&#x2756;</button></td>
";
}
else{
echo "
              <td><button type='button' class='btn dis' style='cursor: not-allowed;' title='Already Imported' disabled>&#x2756;</button></td>
";
}

echo "
              <td width='2'></td>
";

if($epbtn==1){
echo "
              <td><button type='button' class='btn add' style='cursor: pointer;' title='Add'"; ?> onclick="<?php echo "window.open('ComPatientE.php?patientidno=$patientidno&rducaseno=$rducaseno&caseno=$rducaseno&lastcaseno=$caseno&uname=".base64_decode($yiy)."&dt=$dateadm', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=300,left=700,width=600,height=400');";?>" <?php echo ">&#9998;</button></td>
";
}
else{
echo "
              <td><button type='button' class='btn add' style='cursor: not-allowed;' title='Cannot Edit! Already Imported' disabled>&#9998;</button></td>
";
}

echo "
              <td width='2'></td>
              <td><a href='http://".$_SERVER['HTTP_HOST']."/ERP/medmatrix/consoldetails/$rducaseno' target='_blank'><button type='button' class='btn view' style='cursor: pointer;' title='View Details'>&#x1F441;</button></a></td>
            </tr>
          </table></div></td>
        </tr>

";
}

echo "
        <tr>
          <td colspan='11' class='t2'></td>
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
                <td class='t2 b2 l1' width='160'><div align='center' class='arial s12 black bold'>Case No.</div></td>
                <td class='t2 b2 l1'><div align='center' class='arial s12 black bold'>Patient Name</div></td>
                <td class='t2 b2 l1' width='100'><div align='center' class='arial s12 black bold'>Patient Type</div></td>
                <td class='t2 b2 l1' width='200'><div align='center' class='arial s12 black bold'>Confinement Period</div></td>
                <td class='t2 b2 l1' width='150'><div align='center' class='arial s12 black bold'>Case Rate</div></td>
                <td class='t2 b2 l1' width='150'><div align='center' class='arial s12 black bold'>Claim Status</div></td>
                <td class='t2 b2 l1' width='150'><div align='center' class='arial s12 black bold' title='Date Transmitted'>Date Trans.</div></td>
                <td class='t2 b2 l1 r2' width='100'><div align='center' class='arial s12 black bold'>Action</div></td>
              </tr>
";

mysqli_query($conn,"SET NAMES 'utf8'");

$a=$page;
$asql=mysqli_query($conn,"SELECT `caseno`, `patid`, `patientname`, `dateadmit`, `rducaseno`, `remarks` FROM `rduconsolidate` WHERE `dateadmit` IN (SELECT MAX(`dateadmit`) FROM `rduconsolidate` GROUP BY `rducaseno`) ORDER BY `dateadmit` LIMIT $page,$show");
while($afetch=mysqli_fetch_array($asql)){
$caseno=$afetch['caseno'];
$rducaseno=$afetch['rducaseno'];
$patientidno=$afetch['patid'];
$patientname=$afetch['patientname'];
$a++;

$rdc1sql=mysqli_query($conn,"SELECT `dateadmit` FROM `rduconsolidate` WHERE `rducaseno`='$rducaseno' ORDER BY `dateadmit` ASC");
$rdc1fetch=mysqli_fetch_array($rdc1sql);
$dateadm=$rdc1fetch['dateadmit'];

$rdc2sql=mysqli_query($conn,"SELECT `dateadmit` FROM `rduconsolidate` WHERE `rducaseno`='$rducaseno' ORDER BY `dateadmit` DESC");
$rdc2fetch=mysqli_fetch_array($rdc2sql);
$datedis=$rdc2fetch['dateadmit'];

$cr="";
$d=0;
$dsql=mysqli_query($conn,"SELECT `icdcode` FROM `finalcaserate` WHERE `caseno`='$caseno' AND (`level`='primary' OR `level`='secondary')");
$dcount=mysqli_num_rows($dsql);
while($dfetch=mysqli_fetch_array($dsql)){
$d++;

if(($d!=1)){$ck="; ";}else{$ck="";}
  $ic=$dfetch['icdcode'];
  $cr=$cr.$ck.$ic;
}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
$ecsql=mysqli_query($mycon3,"SELECT `status` FROM `caseno` WHERE `caseno`='$rducaseno'");
$eccount=mysqli_num_rows($ecsql);
if($eccount==0){
  $ecstat="Not in eClaims";
  $dt="";
  $datetransmitted="";

  $ipbtn=1;
  $epbtn=1;
}
else{
  $ecfetch=mysqli_fetch_array($ecsql);
  $ecstatus=$ecfetch['status'];
  $ipbtn=0;
  $epbtn=0;

  if($ecstatus=="transmitted"){
    $ecsisql=mysqli_query($mycon4,"SELECT `pStatus` FROM `statusinfo` WHERE `caseno`='$rducaseno'");
    $ecsifetch=mysqli_fetch_array($ecsisql);
    $pStatus=$ecsifetch['pStatus'];

    $ectsql=mysqli_query($mycon4,"SELECT `datetransmitted`, `timetransmitted` FROM `transmittedlist` WHERE `caseno`='$rducaseno'");
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

$strStart=$datedis;
$strEnd=date("Y-m-d");
$from=$strStart;
$to=$strEnd;
$total=strtotime($to) - strtotime($from);
$days=round($total / (60 * 60 * 24));
$val=$days;

if(stripos($caseno, "I-") !== FALSE){$pattype="IPD";}
else if(stripos($caseno, "O-") !== FALSE){$pattype="OPD";}
else if(stripos($caseno, "R-") !== FALSE){$pattype="RDU";}
else{$pattype=$caseno;}

echo "
              <tr>
                <td class='b1 l2' height='30'><div align='left' class='arial s14 black'>&nbsp;$a&nbsp;</div></td>
                <td class='b1 l1'><div align='center' class='arial s14 black'><input type='checkbox' name='test' value='' /></div></td>
                <td class='b1 l1'><div align='left' class='arial s14 black'>&nbsp;$val&nbsp;</div></td>
                <td class='b1 l1'><div align='center' class='arial s14 black'>&nbsp;$rducaseno&nbsp;</div></td>
                <td class='b1 l1'><div align='left' class='arial s14 black'>&nbsp;$patientname&nbsp;</div></td>
                <td class='b1 l1'><div align='center' class='arial s14 black'>&nbsp;$pattype&nbsp;</div></td>
                <td class='b1 l1'><div align='center' class='arial s14 black'>".date("M d, Y",strtotime($dateadm))." to ".date("M d, Y",strtotime($datedis))."</div></td>
                <td class='b1 l1'><div align='center' class='arial s14 black'>$cr</div></td>
                <td class='b1 l1'><div align='center' class='arial s14 black'>$ecstat</div></td>
                <td class='b1 l1'><div align='center' class='arial s14 black'>$dt</div></td>
                <td class='b1 l1 r2' valign='middle'><div align='center' class='arial s14 black btnstyle'><table border='0' cellpadding='0' cellspacing='0'>
                  <tr>
";

if($ipbtn==1){
echo "
                    <td><button type='button' class='btn import' style='cursor: pointer;' title='Add'"; ?> onclick="<?php echo "window.open('http://$ip/2022codes/eClaimsRDU/Porter.php?patientidno=$patientidno&caseno=$rducaseno&lastcaseno=$caseno&uname=".base64_decode($xix)."', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=300,left=700,width=600,height=250');";?>" <?php echo ">&#x2756;</button></td>
";
}
else{
echo "
                    <td><button type='button' class='btn dis' style='cursor: not-allowed;' title='Already Imported' disabled>&#x2756;</button></td>
";
}

echo "
                    <td width='2'></td>
";

if($epbtn==1){
echo "
                    <td><button type='button' class='btn add' style='cursor: pointer;' title='Add'"; ?> onclick="<?php echo "window.open('ComPatientE.php?patientidno=$patientidno&rducaseno=$rducaseno&caseno=$rducaseno&lastcaseno=$caseno&uname=".base64_decode($yiy)."&dt=$dateadm', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=300,left=700,width=600,height=400');";?>" <?php echo ">&#9998;</button></td>
";
}
else{
echo "
                    <td><button type='button' class='btn add' style='cursor: not-allowed;' title='Cannot Edit! Already Imported' disabled>&#9998;</button></td>
";
}

echo "
                    <td width='2'></td>
                    <td><a href='http://".$_SERVER['HTTP_HOST']."/ERP/medmatrix/consoldetails/$rducaseno' target='_blank'><button type='button' class='btn view' style='cursor: pointer;' title='View Details'>&#x1F441;</button></a></td>
                  </tr>
                </table></div></td>
              </tr>
";
}

echo "
              <tr>
                <td colspan='11' class='t2'></td>
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

$pagesql=mysqli_query($conn,"SELECT `caseno`, `patid`, `patientname`, `dateadmit`, `rducaseno`, `remarks` FROM `rduconsolidate` WHERE `dateadmit` IN (SELECT MAX(`dateadmit`) FROM `rduconsolidate` GROUP BY `rducaseno`) ORDER BY `dateadmit`");
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

if(($page+$show)>$pagecount){$showtot=$pagecount;}else{$showtot=($page+$show);}

echo "
            <table width='100%' border='0' cellspacing='0' cellpadding='0'>
              <tr>
                <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
                  <tr>
                    <td width='50%'><div align='left'><span class='arial s12 black bold'>Showing </span><span class='arial s13 blue'>".($page+1)." to ".$showtot." of $pagecount</span> | <span class='arial s12 black bold'>Page: </span><span class='arial s13 blue'>$pagenum of $totalpage</span></div></td>
                    <td width='50%'><div align='right'>
                      <table border='0' cellspacing='0' cellpadding='0'>
";

if($pagecount<=$show){
echo "
                        <tr>
                          <td>
                            <input type='submit' class='button13' style='cursor: not-allowed;' value='  &lt;   ' disabled />
                          </td>
                          <td width='2'></td>
                          <td><div align='center'>
                            <input type='number' name='pagest' value='".($pagenum)."' style='border-radius: 3px;font-size: 10px;height: 18px;width: 50px;text-align: center;border: 1px solid blue;padding: 0;' disabled />
                          </div></td>
                          <td width='2'></td>
                          <td>
                            <input type='submit' class='button13' style='cursor: not-allowed;' value='  &gt;  ' disabled />
                          </td>
                        </tr>
";
}
else if($pagecount>$show){
if($page=='0'){
echo "
                        <tr>
                          <td>
                            <input type='submit' class='button13' style='cursor: not-allowed;' value='  &lt;   ' disabled />
                          </td>
                          <td width='2'></td>
                          <td><div align='center'><form method='post' action='?xix=$xix&yiy=$yiy&show=$show'>
                            <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td><input type='number' name='pagest' value='".($pagenum)."' min='1' max='$totalpage' style='border-radius: 3px;font-size: 10px;height: 18px;width: 50px;text-align: center;border: 1px solid blue;padding: 0;' autocomplete='off' /></td>
                              </tr>
                            </table>
                          </form></div></td>
                          <td width='2'></td>
                          <td>
                            <a href='?xix=$xix&yiy=$yiy&show=$show&page=".($nxtpage)."'><input type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;cursor: pointer;' value='  &gt;  ' /></a>
                          </td>
                        </tr>
";
}
else if(($page!=0)&&($nxtpage!=$page)){
echo "
                        <tr>
                          <td>
                            <a href='?xix=$xix&yiy=$yiy&show=$show&page=".($prevpage)."'><input type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;cursor: pointer;' value='  &lt;   ' /></a>
                          </td>
                          <td width='2'></td>
                          <td><div align='center'><form method='post' action='?xix=$xix&yiy=$yiy&show=$show'>
                            <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td><input type='number' name='pagest' value='".($pagenum)."' min='1' max='$totalpage' style='border-radius: 3px;font-size: 10px;height: 18px;width: 50px;text-align: center;border: 1px solid blue;padding: 0;' autocomplete='off' /></td>
                              </tr>
                            </table>
                          </form></div></td>
                          <td width='2'></td>
                          <td>
                            <a href='?xix=$xix&yiy=$yiy&show=$show&page=".($nxtpage)."'><input type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;cursor: pointer;' value='  &gt;  ' /></a>
                          </td>
                        </tr>
";
}
else if($nxtpage==$page){
echo "
                        <tr>
                          <td>
                            <a href='?xix=$xix&yiy=$yiy&show=$show&page=".($prevpage)."'><input type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;cursor: pointer;' value='  &lt;   ' /></a>
                          </td>
                          <td width='2'></td>
                          <td><div align='center'><form method='post' action='?xix=$xix&yiy=$yiy&show=$show'>
                            <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td><input type='number' name='pagest' value='".($pagenum)."' min='1' max='$totalpage' style='border-radius: 3px;font-size: 10px;height: 18px;width: 50px;text-align: center;border: 1px solid blue;padding: 0;' autocomplete='off' /></td>
                              </tr>
                            </table>
                          </form></div></td>
                          <td width='2'></td>
                          <td>
                            <input type='submit' class='button13' style='cursor: not-allowed;' value='  &gt;  ' disabled />
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
