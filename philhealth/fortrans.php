<style>
.t1 {border-top-width: 1px;border-top-color: #000000;border-top-style: solid;}
.b1 {border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;}
.l1 {border-left-width: 1px;border-left-color: #000000;border-left-style: solid;}
.r1 {border-right-width: 1px;border-right-color: #000000;border-right-style: solid;}

.t2 {border-top-width: 2px;border-top-color: #000000;border-top-style: solid;}
.b2 {border-bottom-width: 2px;border-bottom-color: #000000;border-bottom-style: solid;}
.l2 {border-left-width: 2px;border-left-color: #000000;border-left-style: solid;}
.r2 {border-right-width: 2px;border-right-color: #000000;border-right-style: solid;}

.arial{font-family: Arial;}
.times{font-family: "Times New Roman";}
.comic{font-family: "Comic Sans";}
.calibri{font-family: Calibri;}
.courier{font-family: "Courier New";}
.tahoma{font-family: Tahoma;}

.white{color: #FFFFFF;}
.black{color: #000000;}
.red{color: #FF0000;}
.blue{color: #0066FF;}
.green{color: #2FC200;}
.yellow{color: #FFFF00;}
.darkred{color: #830077;}
.brown{color: #4F2626;}
.grey{color: #CCCCCC;}

.bold{font-weight: bold;}

.s8{font-size: 8px;}
.s9{font-size: 9px;}
.s10{font-size: 10px;}
.s11{font-size: 11px;}
.s12{font-size: 12px;}
.s13{font-size: 13px;}
.s14{font-size: 14px;}
.s15{font-size: 15px;}
.s16{font-size: 16px;}
.s17{font-size: 17px;}
.s18{font-size: 18px;}
.s19{font-size: 19px;}
.s20{font-size: 20px;}
.s21{font-size: 21px;}
.s22{font-size: 22px;}
.s23{font-size: 23px;}
.s24{font-size: 24px;}
.s25{font-size: 25px;}
.s30{font-size: 30px;}
.s35{font-size: 35px;}
.s40{font-size: 40px;}

.pagein{width: 50px;text-align: center;border: 1px solid blue;color: blue;}

.hoverTable{width:100%; border-collapse:collapse;}

/* Define the default color for all the table rows */
.hoverTable tr{background: #b8d1f3;}

/* Define the hover highlight color for the table row */
.hoverTable tr:hover {background-color: #ffff99;}

.tabstyle .tab {padding: 5px 20px;font-family: Arial;font-weight: bold;font-size: 16px;color: #000000;}
.tabstyle .tab:hover {background-color: #FF0000;color: #FFFFFF;}
.tabstyle .tabselect {padding: 5px 20px;font-family: Arial;font-weight: bold;font-size: 16px;color: #FFFFFF;background-color: #FF0000;}
.tabstyle .tabselect:hover {opacity: 0.4;}

.btnstyle .btn {border: 1px solid #000000;width: 26px;height: 26px;border-radius: 8px;font-family: arial;font-size: 12px;text-align: center;padding: 0px 0px;}
.btnstyle .import {background-color: #4bf77c;color: #FFFFFF;}
.btnstyle .import:hover {opacity: 0.4;}
.btnstyle .add {background-color: #FFFFFF;color: #000000;}
.btnstyle .add:hover {opacity: 0.4;}
.btnstyle .view {background-color: #01d0da;color: #FFFFFF;}
.btnstyle .view:hover {opacity: 0.6;}
.btnstyle .dis {background-color: #b4b4b1;color: #e9e9e7;}

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
<script>
  function refundItem(){
    return confirm('Do you wish to request for refund?');
  }
  function undoRefund(){
    return confirm('Do you wish to undo request for refund?');
  }

  function deleteitem(){
    return confirm('Do you wish to delete?');
  }
</script>
<?php
include("../extra/outcon.php");

if(isset($_GET['page'])){
  $page=$_GET['page'];
}
else{
  if(isset($_POST['pagest'])){
    $page=(($_POST['pagest']-1)*$show);
  }
  else{
    $page="0";
  }
}

if($page==0){
$x=0;
$xsql=mysqli_query($conn,"SELECT `caseno`, `datedischarged`, `timedischarged`, `datearray` FROM `dischargedtable` ORDER BY `datearray`");
while($xfetch=mysqli_fetch_array($xsql)){
$xcaseno=$xfetch['caseno'];
$xdatedischarged=$xfetch['datedischarged'];
$xtimedischarged=$xfetch['timedischarged'];
$xdatearray=$xfetch['datearray'];

$xdatedischarged=trim(str_replace("_","-",$xdatedischarged));

$dat=date("Y-m-d",strtotime($xdatedischarged));

if($xdatearray!=$dat){
$x++;
//echo $x." ".$xcaseno." --> ".$xdatearray." | ".$xdatedischarged." | ".$dat."<br />";
//echo "UPDATE `dischargedtable` SET `datearray`='$dat' WHERE `caseno`='$xcaseno'<br />";

//mysqli_query($conn,"UPDATE `dischargedtable` SET `datearray`='$dat' WHERE `caseno`='$xcaseno'");
}
}
}

//-------------------------------------------------------------------------------------------------
if(isset($_GET['show'])){
  $show=$_GET['show'];
}
else{
  if(isset($_POST['showme'])){
    $show=$_POST['showme'];
  }
  else{
    $show="20";
  }
}

if(isset($_GET['page'])){
  $page=$_GET['page'];
}
else{
  if(isset($_POST['pagest'])){
    $page=(($_POST['pagest']-1)*$show);
  }
  else{
    $page="0";
  }
}
//-------------------------------------------------------------------------------------------------

if($modulex=="IPD"){$queryx="and admission.ward='in' and productout.terminalname!='Testtobedone' and productout.terminalname!='Testdone'";}
elseif($modulex=="OPD"){$queryx="and admission.ward='out' and productout.terminalname!='Testtobedone' and productout.terminalname!='Testdone'";}
//elseif($modulex=="OPD"){$queryx="and admission.ward='out' and productout.terminalname!='Testtobedone' and productout.terminalname!='Testdone' and DATE(productout.datearray) > (NOW() - INTERVAL 60 DAY)";}
elseif($modulex=="TESTTOBEDONE"){$queryx="and productout.terminalname='Testtobedone'";}
elseif($modulex=="TESTDONE-IPD"){$queryx="and admission.ward='in' and productout.terminalname='Testdone'";}
elseif($modulex=="TESTDONE-OPD"){$queryx="and admission.ward='out' and productout.terminalname='Testdone'";}
elseif($modulex=="DISCHARGED"){$queryx="and admission.ward='discharged' and productout.terminalname!='Testdone' and (productout.status='PAID' or productout.status='Approved')";}
?>

<script type="text/JavaScript">
<!--
function placeFocus() {
if (document.forms.length > 0) {
var field = document.forms[0];
for (i = 0; i < field.length; i++) {
if ((field.elements[i].type == "text") || (field.elements[i].type == "textarea") || (field.elements[i].type.toString().charAt(0) == "s")) {
document.forms[1].elements[i].focus();
break;
         }
      }
   }
}

<?php
ini_set("display_errors","On");
echo '
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
xmlhttp.open("GET","fortranssr.php?ft&user='.$user.'&userunique='.$userunique.'&show='.$show.'&page='.$page.'&searchme="+document.searchme.searchme.value,true);
xmlhttp.send();
}
';
?>
//-->
</script>

<div class="col-lg-12" style="width: 100%;">
<div class="card mb-4">
<div class="table-responsive p-3">

<?php
echo "
<div align='center'>
  <table border='0' width='98%' cellpadding='0' cellspacing='0'>
    <tr>
      <td height='15'></td>
    </tr>
    <tr>
      <td><div align='left' class='tabstyle'><table border='0' cellapdding='0' cellspacing='0'>
        <tr>
          <td width='2' bgcolor='#ece0cf' style='border-bottom: 2px solid #ece0cf;'></td>
          <td class='b2'><a href='../philhealth/?ft&show=$show&page=$page' style='text-decoration: none;'><div align='center' class='tabselect'>For Transmittal</div></a></td>
          <td width='2' bgcolor='#ece0cf' style='border-bottom: 2px solid #ece0cf;'></td>
          <td class='b2'><a href='../philhealth/?pl&show=$show&page=$page' style='text-decoration: none;'><div align='center' class='tab'>Pending</div></a></td>
          <td width='2' bgcolor='#ece0cf' style='border-bottom: 2px solid #ece0cf;'></td>
          <td class='b2'><a href='../philhealth/?fl&show=$show' style='text-decoration: none;'><div align='center' class='tab'>Transmittal List</div></a></td>
          <td width='2' bgcolor='#ece0cf' style='border-bottom: 2px solid #ece0cf;'></td>
          <td class='b2'><a href='../philhealth/?sp&show=$show' style='text-decoration: none;'><div align='center' class='tab'>Search Patient</div></a></td>
          <td width='2' bgcolor='#ece0cf' style='border-bottom: 2px solid #ece0cf;'></td>
        </tr>
      </table></div></td>
    </tr>
    <tr>
      <td height='10'></td>
    </tr>
    <tr>
      <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
          <td width='50%'><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='left' class='arial s12 black bold'>Show</div></td>
              <td width='5'></td>
              <form id='NextPage' name='NextPage' method='post' action='../philhealth/?ft&page=0'>
              <td><input name='showme' type='text' autocomplete='off' onKeyUp='showResult();' style='height: 25px;width: 40px;font-family: courier new;color: blue;border-top: none;border-left: none;border-right: none;border-bottom: 2px solid black;padding-left: 5px;padding-right: 5px;text-align: center;' value='$show'></td>
              </form>
              <td width='5'></td>
              <td><div align='left' class='arial s12 black bold'>entries</div></td>
            </tr>
          </table></div></td>
          <form name='searchme' onload='showResult();' method='post' action='../philhealth/?ft&show=$show&page=".($page)."'>
          <td width='50%'><div align='right' style='font-family: arial; font-weight: bold; font-size: 12px; color: blue;'>SEARCH: <input name='searchme' type='text' autocomplete='off' onKeyUp='showResult();' style='height: 25px;width: 250px;font-family: courier new;color: red;border-top: none;border-left: none;border-right: none;border-bottom: 2px solid black;padding-left: 5px;padding-right: 5px;'></div></td>
          </form>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height='5'></td>
    </tr>
";


//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
echo "
    <tr>
      <td><div id='livesearch' align='left'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
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

mysqli_query($conn,"SET NAMES 'utf8'");

$a=$page;
$asql=mysqli_query($conn,"SELECT dt.`caseno`, dt.`datedischarged`, dt.`timedischarged`, dt.`datearray`, a.`patientidno`, a.`dateadmit`, a.`membership` FROM `dischargedtable` dt, `admission` a WHERE dt.`caseno`=a.`caseno` AND a.`membership`='phic-med' AND dt.`count` NOT LIKE '9' AND a.`caseno` NOT LIKE '%R-%' ORDER BY dt.`datearray`, dt.`patientname` LIMIT $page,$show");
while($afetch=mysqli_fetch_array($asql)){
$caseno=$afetch['caseno'];
$datedischarged=$afetch['datedischarged'];
$timedischarged=$afetch['timedischarged'];
$datearray=$afetch['datearray'];
$a++;

$patientidno=$afetch['patientidno'];
$dateadmit=$afetch['dateadmit'];
$membership=$afetch['membership'];

$csql=mysqli_query($conn,"SELECT * FROM `patientprofile` WHERE `patientidno`='$patientidno'");
$cfetch=mysqli_fetch_array($csql);
$ln=$cfetch['lastname'];
$fn=$cfetch['firstname'];
$mn=$cfetch['middlename'];
$sf=$cfetch['suffix'];

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

  $ipbtn="<button type='button' class='btn import' title='Import to eClaims' onclick='bb$a()'><i class='icofont-upload-alt'></i></button>";
}
else{
  $ecfetch=mysqli_fetch_array($ecsql);
  $ecstatus=$ecfetch['status'];
  $ipbtn="<button type='button' class='btn dis' title='Already Imported' disabled><i class='icofont-upload-alt'></i></button>";

  if($ecstatus=="transmitted"){
    $ecsisql=mysqli_query($mycon4,"SELECT `pStatus` FROM `statusinfo` WHERE `caseno`='$caseno'");
    $ecsifetch=mysqli_fetch_array($ecsisql);
    $pStatus=$ecsifetch['pStatus'];

    $ectsql=mysqli_query($mycon4,"SELECT `datetransmitted`, `timetransmitted` FROM `transmittedlist` WHERE `caseno`='$caseno'");
    $ectfetch=mysqli_fetch_array($ectsql);
    $datetransmitted=date("Y-m-d",strtotime($ectfetch['datetransmitted']));
    $timetransmitted=$ectfetch['timetransmitted'];

    $dt=date("M d, Y",strtotime($datetransmitted));

    //mysqli_query($conn,"UPDATE `dischargedtable` SET `count`='9' WHERE `caseno`='$caseno'");

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

if(($val>30)&&($val<41)){
  $warn="warn3040";
}
else if(($val>40)&&($val<55)){
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
                        <td>$ipbtn</td>
                        <td width='2'></td>
                        <td><a href='../philhealth/?details$mh&caseno=$caseno' target='_blank'><button type='button' class='btn view' title='View Details'><i class='icofont-eye-alt'></i></button></a></td>
                        <td width='2'></td>
                        <td><button type='button' class='btn add' title='Add' onclick='cc$a()'><i class='icofont-plus-circle'></i></button></td>
                      </tr>
                    </table></div></td>
                  </tr>

                  <script>
                    function bb$a() {
                      window.open('../extra/eClaims/Porter.php?patientidno=$patientidno&caseno=$caseno&uname=$user', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=300,left=700,width=600,height=250');
                    }
                  </script>
                  <script>
                    function bb2$a() {
                      window.open('../extra/eClaims/PorterTest.php?patientidno=$patientidno&caseno=$caseno&uname=$user', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=300,left=700,width=600,height=250');
                    }
                  </script>
                  <script>
                    function cc$a() {
                      window.open('AddPatientPending.php?patientidno=$patientidno&caseno=$caseno&uname=$user&dt=$datetransmitted', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=700,width=450,height=710');
                    }
                  </script>

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

$pagesql=mysqli_query($conn,"SELECT dt.`caseno`, dt.`datedischarged`, dt.`timedischarged`, dt.`datearray`, a.`patientidno`, a.`dateadmit`, a.`membership` FROM `dischargedtable` dt, `admission` a WHERE dt.`caseno`=a.`caseno` AND a.`membership`='phic-med' AND dt.`count` NOT LIKE '9' AND a.`caseno` NOT LIKE '%R-%'");
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

if(($page+$show)>$pagecount){$tonum=$pagecount;}
else{$tonum=$page+$show;}

echo "
                <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                  <tr>
                    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
                      <tr>
                        <td width='50%'><div align='left'><span class='arial s12 black bold'>Showing </span><span class='arial s13 blue'>".($page+1)." to ".$tonum." of $pagecount</span> | <span class='arial s12 black bold'>Page: </span><span class='arial s13 blue'>$pagenum of $totalpage</span></div></td>
                        <td width='50%'><div align='right'>
                          <table border='0' cellspacing='0' cellpadding='0'>
";

if($pagecount<=$show){
echo "
                            <tr>
                              <td>
                                <input name='Submit4' type='submit' style='color: #cccccc;' value='  &lt;   ' disabled />
                              </td>
                              <td width='2'></td>
                              <td><div align='center'>
                                <input type='text' name='pagest' value='".($pagenum)."' style='height: 28px;width: 50px;border: 1px solid blue;text-align: center;padding: 0;' disabled />
                              </div></td>
                              <td width='2'></td>
                              <td>
                                <input name='Submit5' type='submit' style='color: #cccccc;' value='  &gt;  ' disabled />
                              </td>
                            </tr>
";
}
else if($pagecount>$show){
if($page=='0'){
echo "
                            <tr>
                              <td>
                                <input name='Submit4' type='submit' style='color: #cccccc;' value='  &lt;   ' disabled />
                              </td>
                              <td width='2'></td>
                              <form name='ShortPage' method='post' action='../philhealth/?ft&show=$show'>
                              <td><div align='center'>
                                <input type='text' name='pagest' value='".($pagenum)."' style='height: 28px;width: 50px;border: 1px solid blue;text-align: center;padding: 0;' autocomplete='off' />
                              </div></td>
                              </form>
                              <td width='2'></td>
                              <form id='NextPage' name='NextPage' method='post' action='../philhealth/?ft&show=$show&page=".($nxtpage)."'>
                              <td>
                                <input name='Submit5' type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;' value='  &gt;  ' />
                              </td>
                              </form>
                            </tr>
";
}
else if(($page!=0)&&($nxtpage!=$page)){
echo "
                            <tr>
                              <form id='NextPage' name='NextPage' method='post' action='../philhealth/?ft&show=$show&page=".($prevpage)."'>
                              <td>
                                <input name='Submit4' type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;' value='  &lt;   ' />
                              </td>
                              </form>
                              <td width='2'></td>
                              <form name='ShortPage' method='post' action='../philhealth/?ft&show=$show'>
                              <td><div align='center'>
                                <input type='text' name='pagest' value='".($pagenum)."' style='height: 28px;width: 50px;border: 1px solid blue;text-align: center;padding: 0;' autocomplete='off' />
                              </div></td>
                              </form>
                              <td width='2'></td>
                              <form id='NextPage' name='NextPage' method='post' action='../philhealth/?ft&show=$show&page=".($nxtpage)."'>
                              <td>
                                <input name='Submit5' type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;' value='  &gt;  ' />
                              </td>
                              </form>
                            </tr>
";
}
else if($nxtpage==$page){
echo "
                            <tr>
                              <form id='NextPage' name='NextPage' method='post' action='../philhealth/?ft&show=$show&page=".($prevpage)."'>
                              <td>
                                <input name='Submit4' type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;' value='  &lt;   ' />
                              </td>
                              </form>
                              <td width='2'></td>
                              <form name='ShortPage' method='post' action='../philhealth/?ft&show=$show'>
                              <td><div align='center'>
                                <input type='text' name='pagest' value='".($pagenum)."' style='height: 28px;width: 50px;border: 1px solid blue;text-align: center;padding: 0;' autocomplete='off' />
                              </div></td>
                              </form>
                              <td width='2'></td>
                              <td>
                                <input name='Submit5' type='submit' style='color: #cccccc;' value='  &gt;  ' disabled />
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
      </table></div></td>
    </tr>
";
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


echo "
  </table>
</div>
";
?>


</div>
</div>
</div>
<!--?php include "../main/modaldel.php"; ?-->
