<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="../../Resources/Favicon/favicon.png" type="image/png" />
<link rel="shortcut icon" href="../../Resources/Favicon/favicon.png" type="image/png" />
<title>LAB RESULT</title>
<link href="../../Resources/CSS/mystyle.css" rel="stylesheet" type="text/css" />
<!-- Bootstrap core CSS-->
<link href="../../Resources/assets/css/animate.css" rel="stylesheet" type="text/css"/>
<!-- Icons CSS-->
<link href="../../Resources/assets/css/icons.css" rel="stylesheet" type="text/css"/>
<!-- Custom Style-->
<!-- link href="assets/css/app-style.css" rel="stylesheet"/ -->
<script>
function changeTypeInput(inputElement){
 inputElement.type="password"
}
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
</script>
</head>

<body onload='placeFocus()'>
<?php
ini_set("display_errors","On");
include("../../../main/class.php");

$setip=$_SERVER['HTTP_HOST'];

mysqli_query($conn,"SET NAMES 'utf8'");

$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);
$patid=mysqli_real_escape_string($conn,$_GET['patid']);
$printbatchno=mysqli_real_escape_string($conn,$_GET['printbatchno']);
$stype=mysqli_real_escape_string($conn,$_GET['stype']);
$user=mysqli_real_escape_string($conn,$_GET['asd']);

//heading------------------------------------------------------------------------------------------
$hdsql=mysqli_query($conn,"SELECT `heading`, `address`, `telno` FROM `heading`");
$hdfetch=mysqli_fetch_array($hdsql);
$heading=$hdfetch['heading'];
$address=$hdfetch['address'];
$telno=$hdfetch['telno'];
//-------------------------------------------------------------------------------------------------

//patientprofile-----------------------------------------------------------------------------------
$ppsql=mysqli_query($conn,"SELECT `lastname`, `firstname`, `middlename`, `suffix`, `dateofbirth`, `sex` FROM `patientprofile` WHERE `patientidno`='$patid'");
$ppfetch=mysqli_fetch_array($ppsql);
$ln=mb_strtoupper(trim($ppfetch['lastname']));
$fn=mb_strtoupper(trim($ppfetch['firstname']));
$mn=mb_strtoupper(trim($ppfetch['middlename']));
$sf=mb_strtoupper(trim($ppfetch['suffix']));
$sx=mb_strtoupper(trim($ppfetch['sex']));
$db=$ppfetch['dateofbirth'];

if($sx=="M"){$sx="/ Male";}
else if($sx=="F"){$sx="/ Female";}
else{$sx="/ $sx";}

if($mn!=""){$mn=" ".mb_substr($mn, 0, 1).". ";}
if($sf!=""){$sf=" ".$sf;}

$pn=$fn.$mn.$ln.$sf;

$bday=new DateTime($db);
$ages=$bday->diff(new DateTime);

$ay=$ages->y;
$am=$ages->m;
$ad=$ages->d;

if($ay==0){
  if($am==0){
    if($ad>1){$age=$ad." days old";}
    else{$age=$ad." day old";}
  }
  else{
    if($am>1){
      if($ad>1){$age=$am." months and ".$ad." days old";}
      else if($ad==0){$age=$am." months old";}
      else{$age=$am." months and ".$ad." day old";}
    }
    else{
      if($ad>1){$age=$am." month and ".$ad." days old";}
      else if($ad==0){$age=$am." month old";}
      else{$age=$am." month and ".$ad." day old";}
    }
  }
}
else{
  if($ay>1){$age=$ay." years old";}
  else{$age=$ay." year old";}
}
//-------------------------------------------------------------------------------------------------

//admission----------------------------------------------------------------------------------------
$adsql=mysqli_query($conn,"SELECT `ap`, `room` FROM `admission` WHERE `caseno`='$caseno'");
$adfetch=mysqli_fetch_array($adsql);
$ap=$adfetch['ap'];
$room=mb_strtoupper($adfetch['room']);
//-------------------------------------------------------------------------------------------------

//docfile------------------------------------------------------------------------------------------
$dfsql=mysqli_query($conn,"SELECT `lastname`, `firstname`, `middlename`, `ext` FROM `docfile` WHERE `code`='$ap'");
$dffetch=mysqli_fetch_array($dfsql);
$dln=$dffetch['lastname'];
$dfn=$dffetch['firstname'];
$dmn=$dffetch['middlename'];
$dsf=$dffetch['ext'];

if($dmn!=""){$dmn=" ".mb_substr($dmn, 0, 1).". ";}
if($dsf!=""){$dsf=" ".$dsf;}

$dn="DR. ".$dfn.$dmn.$dln.$dsf;
//-------------------------------------------------------------------------------------------------

if($stype=="hematology"){$header="HEMATOLOGY";}
else{$header=mb_strtoupper($stype);}

//start--------------------------------------------------------------------------------------------
$qlcon="";
$asql=mysqli_query($conn,"SELECT `refno`, `labno`, `mt`, `pt`, `labno` FROM `labresults` WHERE `printbatchno`='$printbatchno' GROUP BY `refno`");
$acount=mysqli_num_rows($asql);
if($acount!=0){
  $a=0;
  while($afetch=mysqli_fetch_array($asql)){
    $arefno=$afetch['refno'];
    $alabno=$afetch['labno'];
    $mt=$afetch['mt'];
    $pt=$afetch['pt'];
    $labno=$afetch['labno'];
    $a++;

    if($acount==$a){
      $qlcon=$qlcon."`refno`='$arefno'";
    }
    else{
      $qlcon=$qlcon."`refno`='$arefno' OR ";
    }
  }
}
else{
  $mt="";
  $pt="";
}

$qlcon="(".$qlcon.")";

$bsql=mysqli_query($conn,"SELECT `refno`, `productcode`, `productdesc`, `datearray`, `invno` FROM `productout` WHERE $qlcon ORDER BY `datearray`, `invno`");
$bfetch=mysqli_fetch_array($bsql);
$brefno=$bfetch['refno'];
$bpcode=$bfetch['productcode'];
$bpdesc=$bfetch['productdesc'];
$bda=$bfetch['datearray'];
$bdt=$bfetch['invno'];

$dtreq=$bda." ".$bdt;
$dtreq=date("M d, Y h:i A",strtotime($dtreq));
//-------------------------------------------------------------------------------------------------

//-------------------------------------------------------------------------------------------------
if(($stype=="hematology")||($stype=="chemistry")||($stype=="serology")){
  $prt=1;
}
else{
  $zxsql=mysqli_query($conn,"SELECT * FROM `labnormalvalues` WHERE `code`='$bpcode' AND (`grp`='6' OR `grp`='7')");
  $zxcount=mysqli_num_rows($zxsql);

  if($zxcount==0){
    $prt=1;
  }
  else{
    $zxln=0;
    while($zxfetch=mysqli_fetch_array($zxsql)){$zxln+=$zxfetch['line'];}
    $prt=2;
  }
}
//-------------------------------------------------------------------------------------------------

echo "
<div align='center'>
  <table border='0' width='750' cellpadding='0' cellspacing='0'>
    <tr>
      <td>
        <table border='0' width='100%' cellpadding='0' cellspacing='0'>
          <tr>
            <td width='120'><div align='center'><img src='../../Resources/Logo/logo.png' height='auto' width='60' /></div></td>
            <td><div align='center' style='font-family: arial;color: #000000;'><span style='font-size: 16px;font-weight: bold;'>$heading</span><br /><span style='font-size: 12px;'>$address<br />Tel. No.: $telno</span></div></td>
            <td width='120'></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td height='8'></td>
    </tr>
    <tr>
      <td></td>
    </tr>
    <tr>
      <td><div align='center' style='font-family: arial;font-size: 15px;font-weight: bold;'>$header</div></td>
    </tr>
    <tr>
      <td height='5' class='b3'></td>
    </tr>
    <tr>
      <td>
        <table border='0' width='100%' cellpadding='0' cellspacing='0'>
          <tr>
            <td height='3' width='3'></td>
            <td height='3'></td>
            <td height='3' width='3'></td>
          </tr>
          <tr>
            <td></td>
            <td>
              <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='85' height='16' valign='bottom'><div align='left' style='font-family: arial;font-size: 10px;font-weight: bold;color: #000000;'>Patient Name</div></td>
                  <td width='10' valign='bottom'><div align='center' style='font-family: arial;font-size: 10px;font-weight: bold;color: #000000;'>:</div></td>
                  <td width='auto' valign='bottom' class='b1'><div align='left' style='font-family: arial;font-size: 11px;color: #000000;'>$pn</div></td>
                  <td width='3'></td>
                  <td width='55' valign='bottom'><div align='left' style='font-family: arial;font-size: 10px;font-weight: bold;color: #000000;'>Patient ID</div></td>
                  <td width='10' valign='bottom'><div align='center' style='font-family: arial;font-size: 10px;font-weight: bold;color: #000000;'>:</div></td>
                  <td width='100' valign='bottom' class='b1'><div align='left' style='font-family: arial;font-size: 11px;color: #000000;'>$patid</div></td>
                  <td width='3'></td>
                  <td width='110' valign='bottom'><div align='left' style='font-family: arial;font-size: 10px;font-weight: bold;color: #000000;'>Date/Time Requested</div></td>
                  <td width='10' valign='bottom'><div align='center' style='font-family: arial;font-size: 10px;font-weight: bold;color: #000000;'>:</div></td>
                  <td width='120' valign='bottom' class='b1'><div align='left' style='font-family: arial;font-size: 11px;color: #000000;'>$dtreq</div></td>
                </tr>
                <tr>
                  <td height='16' valign='bottom'><div align='left' style='font-family: arial;font-size: 10px;font-weight: bold;color: #000000;'>Age/Sex</div></td>
                  <td valign='bottom'><div align='center' style='font-family: arial;font-size: 10px;font-weight: bold;color: #000000;'>:</div></td>
                  <td valign='bottom' class='b1'><div align='left' style='font-family: arial;font-size: 11px;color: #000000;'>$age $sx</div></td>
                  <td></td>
                  <td valign='bottom'><div align='left' style='font-family: arial;font-size: 10px;font-weight: bold;color: #000000;'>Case No.</div></td>
                  <td valign='bottom'><div align='center' style='font-family: arial;font-size: 10px;font-weight: bold;color: #000000;'>:</div></td>
                  <td valign='bottom' class='b1'><div align='left' style='font-family: arial;font-size: 11px;color: #000000;'>$caseno</div></td>
                  <td></td>
                  <td valign='bottom'><div align='left' style='font-family: arial;font-size: 10px;font-weight: bold;color: #000000;'>Time Printed</div></td>
                  <td valign='bottom'><div align='center' style='font-family: arial;font-size: 10px;font-weight: bold;color: #000000;'>:</div></td>
                  <td valign='bottom' class='b1'><div align='left' style='font-family: arial;font-size: 11px;color: #000000;'>".date("M d, Y h:i A")."</div></td>
                </tr>
                <tr>
                  <td height='16' valign='bottom'><div align='left' style='font-family: arial;font-size: 10px;font-weight: bold;color: #000000;'>Attending Doctor</div></td>
                  <td valign='bottom'><div align='center' style='font-family: arial;font-size: 10px;font-weight: bold;color: #000000;'>:</div></td>
                  <td valign='bottom' class='b1'><div align='left' style='font-family: arial;font-size: 11px;color: #000000;'>$dn</div></td>
                  <td></td>
                  <td valign='bottom'><div align='left' style='font-family: arial;font-size: 10px;font-weight: bold;color: #000000;'>Room</div></td>
                  <td valign='bottom'><div align='center' style='font-family: arial;font-size: 10px;font-weight: bold;color: #000000;'>:</div></td>
                  <td valign='bottom' class='b1'><div align='left' style='font-family: arial;font-size: 11px;color: #000000;'>$room</div></td>
                  <td></td>
                  <td valign='bottom'><div align='left' style='font-family: arial;font-size: 10px;font-weight: bold;color: #000000;'>Section No.</div></td>
                  <td valign='bottom'><div align='center' style='font-family: arial;font-size: 10px;font-weight: bold;color: #000000;'>:</div></td>
                  <td valign='bottom' class='b1'><div align='left' style='font-family: arial;font-size: 11px;color: #000000;'>$alabno</div></td>
                </tr>
              </table>
            </td>
            <td></td>
          </tr>
          <tr>
            <td height='3'></td>
            <td height='3'></td>
            <td height='3'></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td height='5' class='t3'></td>
    </tr>
";

if($prt==2){
  $padding=7-round($zxln/2);
  $padh=$padding*20;

echo "
    <tr>
      <td height='$padh'></td>
    </tr>
";
}

echo "
    <tr>
      <td>
";

$cremarks="";
$test="";

if($prt==1){
  include("prt1.php");
}
else if($prt==2){
  include("prt2.php");
}

echo "
      </td>
    </tr>
";

if($prt==1){
  if($stype=="hematology"){
    $padding=14-$testcount;
  }
  else{
    $padding=15-$testcount;
  }

  if($padding>0){
    $padh=$padding*20;
echo "
    <tr>
      <td height='$padh'></td>
    </tr>
";
  }
}
else if($prt==2){
  if($divc==1){
    $padding=7-round($lncount/2);
    $padh=$padding*20;

echo "
    <tr>
      <td height='$padh'></td>
    </tr>
";
  }
}

echo "
    <tr>
      <td>
        <table border='0' width='100%' cellpadding='0' cellspacing='0'>
          <tr>
            <td width='5' height='25'></td>
            <td style='border-top: 1px dotted #000000;' colspan='5'>
              <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='100'><div align='left' style='font-family: times;font-weight: bold;font-size: 13px;padding-right: 10px;'>REMARKS:</td>
                  <td><div align='left' style='font-family: times;font-size: 14px;'>$cremarks</td>
                </tr>
              </table>
            </td>
            <td width='5'></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td height='5' class='t3'></td>
    </tr>
";

//start footer-------------------------------------------------------------------------------------
$kt=substr(date("s"), -1);
if(($kt==1)||($kt==4)||($kt==7)){$snum=1;}
else if(($kt==2)||($kt==5)||($kt==8)){$snum=2;}
else if(($kt==3)||($kt==6)||($kt==9)){$snum=3;}
else{$snum=2;}

$user=base64_decode($user);

$name=""; $mtuname="";
$mtsql=mysqli_query($conn,"SELECT `username`, `name` FROM `nsauth` WHERE `empid`='$mt' AND `station`='LABORATORY'");
while($mtfetch=mysqli_fetch_array($mtsql)){
  $mtname=$mtfetch['name'];
  $mtuname=mb_strtoupper($mtfetch['username']);
}

if(($test=="CHEMISTRY")||($test=="SEROLOGY")||($test=="MISCELLANEOUS")){
  $zsql=mysqli_query($conn,"SELECT * FROM `verifier` WHERE `caseno`='$caseno' AND `testno`='$printbatchno'");
  $stestno=$testno;
}
else{
  $zsql=mysqli_query($conn,"SELECT * FROM `verifier` WHERE `refno`='$arefno'");
  $stestno="";
}

$zcount=mysqli_num_rows($zsql);
if($zcount==0){
  $verify="";
  $vuser="";
}
else{
  $zfetch=mysqli_fetch_array($zsql);
  $vuser=strtoupper($zfetch['user']);
  $verify=$zfetch['name'];
}

$psql=mysqli_query($conn,"SELECT `licenseno`, `lastname`, `firstname`, `middlename`, `ext`, `specialization` FROM `docfile` WHERE `code`='$pt'");
$pcount=mysqli_num_rows($psql);
if($pcount!=0){
  while($pfetch=mysqli_fetch_array($psql)){
    $plno=trim(mb_strtoupper($pfetch['licenseno']));
    $pln=trim(mb_strtoupper($pfetch['lastname']));
    $pfn=trim(mb_strtoupper($pfetch['firstname']));
    $pmn=trim(mb_strtoupper($pfetch['middlename']));
    $psf=trim(mb_strtoupper($pfetch['ext']));
    $psp=trim(mb_strtoupper($pfetch['specialization']));
  }
}
else{
  $plno="";
  $pln="";
  $pfn="";
  $pmn="";
  $psf="";
  $psp="";
}

if($pmn!=""){$pmn=" ".mb_substr($pmn, 0, 1).".";}else{$pmn=" ";}
if($psf!=""){$psf=" ".$psf;}else{$psf="";}

$ptname=$pfn.$pmn.$pln.$psf;

echo "
    <tr>
      <td>
        <table width='750' border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <td colspan='2'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
              <tr>
";

$ws1=225;
$ws2=270;
if(stripos($caseno, "I-") !== FALSE){
echo "
                <td width='75'></td>
";
$ws1=275;
$ws2=300;
}

echo "
                <td width='$ws1' valign='bottom'><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td height='60' valign='bottom' style='background-image: url(../Sig/$mtuname-$snum.png);background-size: 235px 60px;width: ".$ws1."px;height: 60px;'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td class='b1'><div align='center' class='arial s11 black bold'>&nbsp;&nbsp;$mtname&nbsp;&nbsp;</div></td>
                      </tr>
                      <tr>
                        <td><div align='center' class='arial s10 black bold'>MEDICAL TECHNOLOGIST</div></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></div></td>
";

if(stripos($caseno, "I-") !== FALSE){
echo "
                <td width='30'></td>
";
}
else{
echo "
                <td width='10'></td>
                <td width='235' valign='bottom'><div align='center'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td height='60' valign='bottom' style='background-image: url(../Sig/$vuser-$snum.png);background-size: 235px 60px;width: 235px;height: 60px;'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td class='b1'><div align='center' class='arial s11 black bold' style='cursor: pointer;'";?> onclick="<?php echo "window.open('Verify.php?caseno=$caseno&printbatchno=$printbatchno', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=700,width=360,height=250');"; ?>" <?php echo ">&nbsp;&nbsp;$verify&nbsp;&nbsp;</div></td>
                      </tr>
                      <tr>
                        <td><div align='center' class='arial s10 black bold'>VERIFIED BY</div></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></div></td>
                <td width='10'></td>
";
}

echo "
                <td width='$ws2' valign='bottom'><div align='center'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td height='60' background='../Sig/Salcedo_alt.png' valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td class='b1'><div align='center' class='arial s11 black bold'>&nbsp;&nbsp;$ptname&nbsp;&nbsp;</div></td>
                      </tr>
                      <tr>
                        <td><div align='center' class='arial s10 black bold'>$psp</div></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></div></td>
";

if(stripos($caseno, "I-") !== FALSE){
echo "
                <td width='75'></td>
";
}

echo "
              </tr>
            </table></td>
          </tr>
        </table>
      </td>
    </tr>
";
//end footer---------------------------------------------------------------------------------------

echo "
  </table>
</div>
";
?>
</body>
</html>
