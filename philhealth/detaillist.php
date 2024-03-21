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
.btnstyle .rem {background-color: #FF0000;color: #FFFFFF;}
.btnstyle .rem:hover {opacity: 0.4;}
.btnstyle .mod {background-color: #E474FC;color: #FFFFFF;}
.btnstyle .mod:hover {opacity: 0.4;}
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
<?php
include("../extra/outcon.php");

$claimnumber=mysqli_real_escape_string($conn,$_GET['claimnumber']);

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
          <td class='b2'><a href='../philhealth/?ft&show=$show&page=$page' style='text-decoration: none;'><div align='center' class='tab'>For Transmittal</div></a></td>
          <td width='2' bgcolor='#ece0cf' style='border-bottom: 2px solid #ece0cf;'></td>
          <td class='b2'><a href='../philhealth/?pl&show=$show&page=$page' style='text-decoration: none;'><div align='center' class='tab'>Pending</div></a></td>
          <td width='2' bgcolor='#ece0cf' style='border-bottom: 2px solid #ece0cf;'></td>
          <td class='b2'><a href='../philhealth/?fl&show=$show' style='text-decoration: none;'><div align='center' class='tab'>Transmittal List</div></a></td>
          <td width='2' bgcolor='#ece0cf' style='border-bottom: 2px solid #ece0cf;'></td>
          <td class='b2'><a href='../philhealth/?dl&claimnumber=$claimnumber&show=$show' style='text-decoration: none;'><div align='center' class='tabselect'>Details</div></a></td>
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
          <td width='50%'><!-- div align='left'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='left' class='arial s12 black bold'>Show</div></td>
              <td width='5'></td>
              <form id='NextPage' name='NextPage' method='post' action='?ft&page=0'>
              <td><input name='showme' type='text' autocomplete='off' onKeyUp='showResult();' style='height: 25px;width: 40px;font-family: courier new;color: blue;border-top: none;border-left: none;border-right: none;border-bottom: 2px solid black;padding-left: 5px;padding-right: 5px;text-align: center;' value='$show'></td>
              </form>
              <td width='5'></td>
              <td><div align='left' class='arial s12 black bold'>entries</div></td>
            </tr>
          </table></div --></td>
          <form name='searchme' onload='showResult();' method='post' action='?ft&show=$show&page=".($page)."'>
          <td width='50%'><!-- div align='right' style='font-family: arial; font-weight: bold; font-size: 12px; color: blue;'>SEARCH: <input name='searchme' type='text' autocomplete='off' onKeyUp='showResult();' style='height: 25px;width: 250px;font-family: courier new;color: red;border-top: none;border-left: none;border-right: none;border-bottom: 2px solid black;padding-left: 5px;padding-right: 5px;'></div --></td>
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
                    <td class='t2 b2 l1' width='200'><div align='center' class='arial s12 black bold'>Date of Transaction</div></td>
                    <td class='t2 b2 l1' width='150'><div align='center' class='arial s12 black bold'>Case Rate</div></td>
                    <td class='t2 b2 l1' width='150'><div align='center' class='arial s12 black bold'>Claim Status</div></td>
                    <td class='t2 b2 l1 r2' width='100'><div align='center' class='arial s12 black bold'>Action</div></td>
                  </tr>
";

// /mysqli_query($conn,"SET NAMES 'utf8'");

$a=0;
$asql=mysqli_query($conn,"SELECT `caseno`, `claimnumber`, `pin`, `membername`, `patientname`, `mtype`, `age`, `sex`, `dateadmitted`, `datedischarged`, `finaldiagnosis`, `roomandboard`, `labothers`, `meds`, `or`, `pf`, `datetransmitted`, `status`, `dateadded`, `user` FROM `translist` WHERE `claimnumber`='$claimnumber' ORDER BY `datedischarged`");
$acount=mysqli_num_rows($asql);
while($afetch=mysqli_fetch_array($asql)){
$caseno=$afetch['caseno'];
$patientname=$afetch['patientname'];
$dateadmitted=$afetch['dateadmitted'];
$datedischarged=$afetch['datedischarged'];
$a++;

$adsql=mysqli_query($conn,"SELECT `patientidno` FROM `admission` WHERE `caseno`='$caseno'");
$adfetch=mysqli_fetch_array($adsql);
$patientidno=$adfetch['patientidno'];

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


$strStart=$datedischarged;
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
  $ecstat="Not in eClaimsTwo";
  $dt="";
  $datetransmitted="";

  $ipbtn="<button type='button' class='btn import' title='Import to eClaims' onclick='bb$a()'><i class='fa fa-cloud-upload'></i></button>";
}
else{
  $ecfetch=mysqli_fetch_array($ecsql);
  $ecstatus=$ecfetch['status'];
  $ipbtn="<button type='button' class='btn dis' title='Already Imported' disabled><i class='fa fa-cloud-upload'></i></button>";

  if($ecstatus=="transmitted"){
    $ecsisql=mysqli_query($mycon4,"SELECT `pStatus` FROM `statusinfo` WHERE `caseno`='$caseno'");
    $ecsifetch=mysqli_fetch_array($ecsisql);
    $pStatus=$ecsifetch['pStatus'];

    if($pStatus==""){
      $ecstat=strtoupper($ecstatus);
      $dt="";
      $datetransmitted="";
    }
    else{
      $ecstat=$pStatus;

      $ectsql=mysqli_query($mycon4,"SELECT `datetransmitted`, `timetransmitted` FROM `transmittedlist` WHERE `caseno`='$caseno'");
      $ectfetch=mysqli_fetch_array($ectsql);
      $datetransmitted=date("Y-m-d",strtotime($ectfetch['datetransmitted']));
      $timetransmitted=$ectfetch['timetransmitted'];

      $dt=date("M d, Y",strtotime($datetransmitted));

    }
  }
  else{
    $ecstat=strtoupper($ecstatus);
    $dt="";
    $datetransmitted="";
  }
}

if(stripos($caseno, "I-") !== FALSE){$mh="&inp";}else{$mh="&otp";}
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

echo "
                  <tr>
                    <td class='b1 l2' height='30'><div align='left' class='arial s14 black'>&nbsp;$a&nbsp;</div></td>
                    <td class='b1 l1'><div align='center' class='arial s14 black'><input type='checkbox' name='test' value='' /></div></td>
                    <td class='b1 l1'><div align='left' class='arial s14 black'>&nbsp;$val&nbsp;</div></td>
                    <td class='b1 l1'><div align='left' class='arial s14 black'>&nbsp;$patientname&nbsp;</div></td>
                    <td class='b1 l1'><div align='center' class='arial s14 black'>&nbsp;$pattype&nbsp;</div></td>
                    <td class='b1 l1'><div align='center' class='arial s14 black'>".date("M d, Y",strtotime($dateadmitted))." to ".date("M d, Y",strtotime($datedischarged))."</div></td>
                    <td class='b1 l1'><div align='center' class='arial s14 black'>$cr</div></td>
                    <td class='b1 l1'><div align='center' class='arial s14 black'>$ecstat</div></td>
                    <td class='b1 l1 r2' valign='middle'><div align='center' class='arial s14 black btnstyle'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td><button type='button' class='btn mod' title='Edit'"; ?> onclick="<?php echo "window.open('EditPatient.php?caseno=$caseno&uname=$user', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=700,width=450,height=670');";?>" <?php echo "><i class='icofont-edit'></i></button></td>
                        <td width='2'></td>
                        <td><a href='../philhealth/?details$mh&caseno=$caseno' target='_blank'><button type='button' class='btn view' title='View Details'><i class='icofont-eye-alt'></i></button></a></td>
                        <td width='2'></td>
                        <td><button type='button' class='btn rem' title='Remove'"; ?> onclick="<?php echo "window.open('Remove.php?caseno=$caseno&patientidno=$patientidno&uname=$user', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=280,left=700,width=600,height=250');";?>" <?php echo "><i class='icofont-bin'></i></button></td>
                      </tr>
                    </table></div></td>
                  </tr>
";
}

echo "
                  <tr>
                    <td colspan='9' class='t2'></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height='20'></td>
              </tr>
            </table>
          </div></td>
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
