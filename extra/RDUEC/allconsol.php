<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Conslidated LIst</title>
<link rel='icon' href='../Resources/Favicon/Cart.png' type='image/png' />
<link rel='shortcut icon' href='../Resources/Favicon/Cart.png' type='image/png' />
<link href="../Resources/CSS/mystyle.css" rel="stylesheet" type="text/css" />
<style>
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
</head>
<body>
<?php
ini_set("display_errors","On");
include("../../main/connection.php");
include("../outcon.php");

$xix=mysqli_real_escape_string($conn,$_GET['xix']);
$yiy=mysqli_real_escape_string($conn,$_GET['yiy']);

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
xmlhttp.open("GET","allconsolsr.php?view=ft&xix='.$xix.'&yiy='.$yiy.'&show='.$show.'&page='.$page.'&searchme="+document.searchme.searchme.value,true);
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
  <table border='0' width='100%' cellpadding='0' cellspacing='0'>
    <tr>
      <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
          <td width='50%'><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='left' class='arial s12 black bold'>Show</div></td>
              <td width='5'></td>
              <form id='NextPage' name='NextPage' method='post' action='?xix=$xix&yiy=$yiy&page=0'>
              <td><input name='showme' type='text' autocomplete='off' onKeyUp='showResult();' style='height: 25px;width: 40px;font-family: courier new;color: blue;border-top: none;border-left: none;border-right: none;border-bottom: 2px solid black;padding-left: 5px;padding-right: 5px;text-align: center;' value='$show'></td>
              </form>
              <td width='5'></td>
              <td><div align='left' class='arial s12 black bold'>entries</div></td>
            </tr>
          </table></div></td>
          <form name='searchme' onload='showResult();' method='post'>
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
$rmks=$afetch['remarks'];
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

  if($rmks!=""){
    mysqli_query($conn,"UPDATE `rduconsolidate` SET `remarks`='' WHERE `rducaseno`='$rducaseno'");
  }

  $ipbtn="<button type='button' class='btn import' style='cursor: pointer;' title='Import to eClaims' onclick='bb$a()'>&#x2756;</button>";
  $epbtn="<button type='button' class='btn add' style='cursor: pointer;' title='Add' onclick='cc$a()'>&#9998;</button>";
}
else{
  $ecfetch=mysqli_fetch_array($ecsql);
  $ecstatus=$ecfetch['status'];
  $ipbtn="<button type='button' class='btn dis' style='cursor: not-allowed;' title='Already Imported' disabled>&#x2756;</button>";
  $epbtn="<button type='button' class='btn add' style='cursor: not-allowed;' title='Cannot Edit! Already Imported' disabled>&#9998;</button>";

  if($ecstatus=="transmitted"){
    $ecsisql=mysqli_query($mycon4,"SELECT `pStatus` FROM `statusinfo` WHERE `caseno`='$rducaseno'");
    $ecsifetch=mysqli_fetch_array($ecsisql);
    $pStatus=$ecsifetch['pStatus'];

    $ectsql=mysqli_query($mycon4,"SELECT `datetransmitted`, `timetransmitted` FROM `transmittedlist` WHERE `caseno`='$rducaseno'");
    $ectfetch=mysqli_fetch_array($ectsql);
    $datetransmitted=date("Y-m-d",strtotime($ectfetch['datetransmitted']));
    $timetransmitted=$ectfetch['timetransmitted'];

    $dt=date("M d, Y",strtotime($datetransmitted));

    mysqli_query($conn,"UPDATE `rduconsolidate` SET `remarks`='Transmitted' WHERE `rducaseno`='$rducaseno'");

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

if(($val>30)&&($val<41)){$warn="warn3040";}
else if(($val>40)&&($val<55)){$warn="warn30over";}
else if(($val>54)&&($val<61)){$warn="warn5days";}
else if($val>60){$warn="warnover";}
else{$warn="";}

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
                        <td>$ipbtn</td>
                        <td width='2'></td>
                        <td>$epbtn</td>
                        <td width='2'></td>
                        <td><a href='http://".$_SERVER['HTTP_HOST']."/ERP/medmatrix/consoldetails/$rducaseno' target='_blank'><button type='button' class='btn view' style='cursor: pointer;' title='View Details'>&#x1F441;</button></a></td>
                      </tr>
                    </table></div></td>
                  </tr>

                  <script>
                    function cc$a() {
                      window.open('ComPatientE.php?patientidno=$patientidno&rducaseno=$rducaseno&caseno=$rducaseno&lastcaseno=$caseno&uname=".base64_decode($yiy)."&dt=$dateadm', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=150,left=700,width=600,height=400');
                    }
                  </script>
                  <script>
                    function bb$a() {
                      window.open('http://".$_SERVER['HTTP_HOST']."/2022codes/eClaimsRDU/Porter.php?patientidno=$patientidno&caseno=$rducaseno&lastcaseno=$caseno&uname=".base64_decode($xix)."', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=300,left=700,width=600,height=250');
                    }
                  </script>
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

$pagesql=mysqli_query($conn,"SELECT `caseno`, `patid`, `dateadmit`, `rducaseno` FROM `rduconsolidate` WHERE `dateadmit` IN (SELECT MAX(`dateadmit`) FROM `rduconsolidate` GROUP BY `rducaseno`) ORDER BY `dateadmit`");
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
                                <input type='submit' style='color: #cccccc;cursor: not-allowed;' value='  &lt;   ' disabled />
                              </td>
                              <td width='2'></td>
                              <td><div align='center'>
                                <input type='number' name='pagest' value='".($pagenum)."' style='border-radius: 3px;font-size: 10px;height: 18px;width: 50px;border: 1px solid blue;text-align: center;padding: 0;' disabled />
                              </div></td>
                              <td width='2'></td>
                              <td>
                                <input type='submit' style='color: #cccccc;cursor: not-allowed;' value='  &gt;  ' disabled />
                              </td>
                            </tr>
";
}
else if($pagecount>$show){
if($page=='0'){
echo "
                            <tr>
                              <td>
                                <input type='submit' style='color: #cccccc;cursor: not-allowed;' value='  &lt;   ' disabled />
                              </td>
                              <td width='2'></td>
                              <form method='post' action='?xix=$xix&yiy=$yiy&show=$show'>
                              <td><div align='center'>
                                <input type='number' name='pagest' value='".($pagenum)."' min='1' max='$totalpage' style='border-radius: 3px;font-size: 10px;height: 18px;width: 50px;border: 1px solid blue;text-align: center;padding: 0;' autocomplete='off' />
                              </div></td>
                              </form>
                              <td width='2'></td>
                              <form method='post' action='?xix=$xix&yiy=$yiy&show=$show&page=".($nxtpage)."'>
                              <td>
                                <input name='Submit5' type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;cursor: pointer;' value='  &gt;  ' />
                              </td>
                              </form>
                            </tr>
";
}
else if(($page!=0)&&($nxtpage!=$page)){
echo "
                            <tr>
                              <form method='post' action='?xix=$xix&yiy=$yiy&show=$show&page=".($prevpage)."'>
                              <td>
                                <input type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;cursor: pointer;' value='  &lt;   ' />
                              </td>
                              </form>
                              <td width='2'></td>
                              <form method='post' action='?xix=$xix&yiy=$yiy&show=$show'>
                              <td><div align='center'>
                                <input type='number' name='pagest' value='".($pagenum)."' min='1' max='$totalpage' style='border-radius: 3px;font-size: 10px;height: 18px;width: 50px;border: 1px solid blue;text-align: center;padding: 0;' autocomplete='off' />
                              </div></td>
                              </form>
                              <td width='2'></td>
                              <form method='post' action='?xix=$xix&yiy=$yiy&show=$show&page=".($nxtpage)."'>
                              <td>
                                <input type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;cursor: pointer;' value='  &gt;  ' />
                              </td>
                              </form>
                            </tr>
";
}
else if($nxtpage==$page){
echo "
                            <tr>
                              <form method='post' action='?xix=$xix&yiy=$yiy&show=$show&page=".($prevpage)."'>
                              <td>
                                <input type='submit' style='color: blue;border: 1px solid blue;font-weight: bold;cursor: pointer;' value='  &lt;   ' />
                              </td>
                              </form>
                              <td width='2'></td>
                              <form method='post' action='?xix=$xix&yiy=$yiy&show=$show'>
                              <td><div align='center'>
                                <input type='number' name='pagest' value='".($pagenum)."' min='1' max='$totalpage' style='border-radius: 3px;font-size: 10px;height: 18px;width: 50px;border: 1px solid blue;text-align: center;padding: 0;' autocomplete='off' />
                              </div></td>
                              </form>
                              <td width='2'></td>
                              <td>
                                <input type='submit' style='color: #cccccc;cursor: not-allowed;' value='  &gt;  ' disabled />
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
</body>
</html>
