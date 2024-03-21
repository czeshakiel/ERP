<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="../Resources/Favicon/favicon.png" type="image/png" />
<link rel="shortcut icon" href="../Resources/Favicon/favicon.png" type="image/png" />
<title>TRANSMITTAL LIST</title>
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
include("../Settings.php");

$claimnumber=mysqli_real_escape_string($mycon1,$_GET['claimnumber']);

if(isset($_GET['page'])){
  $page=$_GET['page'];
}
else{
  $page=0;
}

$show=10;

echo "
<div align='center'>
  <table border='0' width='1170' cellpadding='0' cellspacing='0'>
    <tr>
      <td height='710' valign='top'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
          <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='auto' height='15' colspan='3'><div align='center' class='arial s12 black bold'>Republic of the Philippines</div></td>
            </tr>
            <tr>
              <td width='300' rowspan='4'></td>
              <td height='25'><div align='center' class='arial s16 black bold'>PHILIPPINE HEALTH INSURANCE CORAPORATION</div></td>
              <td width='300' rowspan='4' valign='top'><div align='right'><table border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td><div align='left' class='arial s15 black'>TRANSMITTAL NO.</div></td>
                  <td width='15'><div align='center' class='arial s15 black'>:</div></td>
                  <td width='120' class='b1'><div align='left' class='arial s15 black bold'>$claimnumber</div></td>
                </tr>
              </table></div></td>
            </tr>
            <tr>
              <td height='15'><div align='center' class='arial s12 black bold'>PhilHealth Regional Office - XII</div></td>
            </tr>
            <tr>
              <td height='15'><div align='center' class='arial s12 black bold'>Plaza de Español bldg. corner Posadas and Abad Santos St., Koronadal City</div></td>
            </tr>
            <tr>
              <td height='40'><div align='center' class='arial s20 black bold'><u>T R A N S M I T T A L L I S T</u></div></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height='15'></td>
        </tr>
        <tr>
          <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='180' height='30'><div align='left' class='arial s16 black'>NAME OF HOSPITAL</div></td>
                  <td width='15'><div align='cnter' class='arial s16 black'>:</div></td>
                  <td class='b2' width='auto'><div align='left' class='arial s16 black bold'>KIDAPAWAN MEDICAL SPECIALISTS CENTER, INC.</div></td>
                </tr>
                <tr>
                  <td height='30'><div align='left' class='arial s16 black'>ADDRESS</div></td>
                  <td><div align='cnter' class='arial s16 black'>:</div></td>
                  <td class='b2'><div align='left' class='arial s16 black bold'>SUDAPIN, KIDAPAWAN CITY</div></td>
                </tr>
              </table></td>
              <td width='15'></td>
              <td width='320'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='170' height='20'><div align='left' class='arial s12 black'>PHIC ACCREDITATION NO.</div></td>
                  <td width='15'><div align='center' class='arial s12 black'>:</div></td>
                  <td width='auto' class='b2'><div align='left' class='arial s12 black bold'>H12017336</div></td>
                </tr>
                <tr>
                  <td height='20'><div align='left' class='arial s12 black'>HOSPITAL CATEGORY</div></td>
                  <td><div align='center' class='arial s12 black'>:</div></td>
                  <td class='b2'><div align='left' class='arial s12 black bold'>Tertiary</div></td>
                </tr>
                <tr>
                  <td height='20'><div align='left' class='arial s12 black'>ACCREDITED BED CAPACITY</div></td>
                  <td><div align='center' class='arial s12 black'>:</div></td>
                  <td class='b2'><div align='left' class='arial s12 black bold'>200</div></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height='15'></td>
        </tr>
        <tr>
          <td height='350' valign='top'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td rowspan='2' class='t2 b2 l2' width='80'><div align='center' class='arial s11 black'>PHILHEALTH NUMBER</div></td>
              <td rowspan='2' class='t2 b2 l1'><div align='center' class='arial s11 black'>NAME OF MEMBER</div></td>
              <td colspan='4' class='t2 b1 l1'><div align='center' class='arial s11 black'>PATIENT</div></td>
              <td colspan='2' class='t2 b1 l1'><div align='center' class='arial s11 black'>CONFINEMENT PERIOD</div></td>
              <td rowspan='2' colspan='3' class='t2 b2 l1'><div align='center' class='arial s11 black'>FINAL DIAGNOSIS</div></td>
              <td colspan='4' class='t2 b1 l1'><div align='center' class='arial s11 black'>HOSPITAL CHARGES</div></td>
              <td rowspan='2' class='t2 b2 l1' width='50'><div align='center' class='arial s11 black'>PF</div></td>
              <td rowspan='2' class='t2 b2 l1 r2' width='60'><div align='center' class='arial s11 black'>TOTAL AMOUNT</div></td>
            </tr>
            <tr>
              <td class='b2 l1'><div align='center' class='arial s11 black'>Name/Relationship to Member</div></td>
              <td class='b2 l1' width='30'><div align='center' class='arial s11 black'>M</div></td>
              <td class='b2 l1' width='30'><div align='center' class='arial s11 black'>Age</div></td>
              <td class='b2 l1' width='30'><div align='center' class='arial s11 black'>Sex</div></td>
              <td class='b2 l1' width='60'><div align='center' class='arial s11 black'>From</div></td>
              <td class='b2 l1' width='60'><div align='center' class='arial s11 black'>To</div></td>
              <td class='b2 l1' width='50'><div align='center' class='arial s11 black'>Room & Board</div></td>
              <td class='b2 l1' width='50'><div align='center' class='arial s11 black'>Lab / Others</div></td>
              <td class='b2 l1' width='50'><div align='center' class='arial s11 black'>Meds.</div></td>
              <td class='b2 l1' width='50'><div align='center' class='arial s11 black'>O.R.</div></td>
            </tr>
";

$r=0;
$l=0;
$m=0;
$o=0;
$p=0;
$tt=0;
$asql=mysqli_query($mycon1,"SELECT * FROM `translist` WHERE `claimnumber`='$claimnumber' ORDER BY `patientname` LIMIT $page,$show");
$acount=mysqli_num_rows($asql);

if($acount<9){
  $padding='75';
}
else{
  $padding='10';
}

while($afetch=mysqli_fetch_array($asql)){
$caseno=$afetch['caseno'];
$pin=$afetch['pin'];
$membername=$afetch['membername'];
$patientname=$afetch['patientname'];
$mtype=$afetch['mtype'];
$age=$afetch['age'];
$sex=$afetch['sex'];
$dateadmitted=$afetch['dateadmitted'];
$datedischarged=$afetch['datedischarged'];
$finaldiagnosis=$afetch['finaldiagnosis'];
$roomandboard=$afetch['roomandboard'];
$labothers=$afetch['labothers'];
$meds=$afetch['meds'];
$or=$afetch['or'];
$pf=$afetch['pf'];
$dt=$afetch['datetransmitted'];

$tot=($roomandboard+$labothers+$meds+$or+$pf);

$r+=$roomandboard;
$l+=$labothers;
$m+=$meds;
$o+=$or;
$p+=$pf;
$tt+=$tot;

$adsql=mysqli_query($mycon1,"SELECT `patientidno` FROM `admission` WHERE `caseno`='$caseno'");
$adfetch=mysqli_fetch_array($adsql);
$patid=$adfetch['patientidno'];

echo "
            <tr>
              <td class='b1 l2' height='20'><div align='center' class='arial s10 black'>$pin</div></td>
              <td class='b1 l1'><div align='left' class='arial s10 black'>&nbsp;$membername&nbsp;</div></td>
              <td class='b1 l1'><div align='left' class='arial s9 black'>&nbsp;$patientname&nbsp;</div></td>
              <td class='b1 l1'><div align='center' class='arial s9 black'>$mtype</div></td>
              <td class='b1 l1'><div align='center' class='arial s10 black'>$age</div></td>
              <td class='b1 l1'><div align='center' class='arial s10 black'>$sex</div></td>
              <td class='b1 l1'><div align='center' class='arial s10 black'>&nbsp;".date("m/d/Y",strtotime($dateadmitted))."&nbsp;</div></td>
              <td class='b1 l1'><div align='center' class='arial s10 black'>&nbsp;".date("m/d/Y",strtotime($datedischarged))."&nbsp;</div></td>
              <td class='b1 l1' width='2'></td>
              <td class='b1' width='200'><div align='left' class='arial s8 black'>$finaldiagnosis</div></td>
              <td class='b1' width='2'></td>
              <td class='b1 l1' style='cursor: pointer;'"; ?> onclick="<?php echo "window.open('../../2017codes/SOA/StatementOfAccountPHICVer.php?caseno=$caseno&patientidno=$patid&uname=FORVIEWING', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=200,width=900,height=600');";?>" <?php echo "><div align='right' class='arial s9 black'>&nbsp;".number_format($roomandboard,"2")."&nbsp;</div></td>
              <td class='b1 l1' style='cursor: pointer;'"; ?> onclick="<?php echo "window.open('../../2017codes/SOA/StatementOfAccountPHICVer.php?caseno=$caseno&patientidno=$patid&uname=FORVIEWING', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=200,width=900,height=600');";?>" <?php echo "><div align='right' class='arial s9 black'>&nbsp;".number_format($labothers,"2")."&nbsp;</div></td>
              <td class='b1 l1' style='cursor: pointer;'"; ?> onclick="<?php echo "window.open('../../2017codes/SOA/StatementOfAccountPHICVer.php?caseno=$caseno&patientidno=$patid&uname=FORVIEWING', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=200,width=900,height=600');";?>" <?php echo "><div align='right' class='arial s9 black'>&nbsp;".number_format($meds,"2")."&nbsp;</div></td>
              <td class='b1 l1' style='cursor: pointer;'"; ?> onclick="<?php echo "window.open('../../2017codes/SOA/StatementOfAccountPHICVer.php?caseno=$caseno&patientidno=$patid&uname=FORVIEWING', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=200,width=900,height=600');";?>" <?php echo "><div align='right' class='arial s9 black'>&nbsp;".number_format($or,"2")."&nbsp;</div></td>
              <td class='b1 l1' style='cursor: pointer;'"; ?> onclick="<?php echo "window.open('../../2017codes/SOA/StatementOfAccountPHICVer.php?caseno=$caseno&patientidno=$patid&uname=FORVIEWING', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=200,width=900,height=600');";?>" <?php echo "><div align='right' class='arial s9 black'>&nbsp;".number_format($pf,"2")."&nbsp;</div></td>
              <td class='b1 l1 r2' style='cursor: pointer;'"; ?> onclick="<?php echo "window.open('../../2017codes/SOA/StatementOfAccountPHICVer.php?caseno=$caseno&patientidno=$patid&uname=FORVIEWING', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=200,width=900,height=600');";?>" <?php echo "><div align='right' class='arial s9 black'>&nbsp;".number_format($tot,"2")."&nbsp;</div></td>
            </tr>
";
}

echo "
            <tr>
              <td colspan='11' class='t1 b2 l2'><div align='right' class='arial s16 bold black'>Total &gt;&gt;&gt;&nbsp;</div></td>
              <td class='t1 b2 l1'><div align='right' class='arial s9 black'>&nbsp;".number_format($r,"2")."&nbsp;</div></td>
              <td class='t1 b2 l1'><div align='right' class='arial s9 black'>&nbsp;".number_format($l,"2")."&nbsp;</div></td>
              <td class='t1 b2 l1'><div align='right' class='arial s9 black'>&nbsp;".number_format($m,"2")."&nbsp;</div></td>
              <td class='t1 b2 l1'><div align='right' class='arial s9 black'>&nbsp;".number_format($o,"2")."&nbsp;</div></td>
              <td class='t1 b2 l1'><div align='right' class='arial s9 black'>&nbsp;".number_format($p,"2")."&nbsp;</div></td>
              <td class='t1 b2 l1 r2'><div align='right' class='arial s9 black'>&nbsp;".number_format($tt,"2")."&nbsp;</div></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height='$padding'></td>
        </tr>
        <tr>
          <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td valign='top'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td><div align='left' class='arial s14 black'>This is to certify all claims and information stated above are true and correct based on my personal knowledge and on hospital records.</div></td>
                </tr>
                <tr>
                  <td height='10'></td>
                </tr>
                <tr>
                  <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='20'></td>
                      <td><div align='left' class='arial s14 black'>DATE SUBMITTED</div></td>
                      <td width='15'><div align='center' class='arial s14 black'>:</div></td>
                      <td width='100' class='b2'><div align='left' class='arial s14 black bold'>".date("m/d/Y",strtotime($dt))."</div></td>
                    </tr>
                  </table></div></td>
                </tr>
              </table></td>
              <td width='10'></td>
              <td width='320'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='100' height='23'><div align='left' class='arial s12 black'>SIGNATURE</div></td>
                  <td width='15'><div align='center' class='arial s12 black'>:</div></td>
                  <td width='auto' class='b2'><div align='left' class='arial s12 black bold'></div></td>
                </tr>
                <tr>
                  <td height='23'><div align='left' class='arial s12 black'>PRINTED NAME</div></td>
                  <td><div align='center' class='arial s12 black'>:</div></td>
                  <td class='b2'><div align='left' class='arial s12 black bold'>ROBELYN M. ISABEL</div></td>
                </tr>
                <tr>
                  <td height='23'><div align='left' class='arial s12 black'>DESIGNATION</div></td>
                  <td><div align='center' class='arial s12 black'>:</div></td>
                  <td class='b2'><div align='left' class='arial s12 black bold'>PHIC IN-CHARGE</div></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height='10'></td>
        </tr>
";

$pagesql=mysqli_query($mycon1,"SELECT * FROM `translist` WHERE `claimnumber`='$claimnumber' ORDER BY `datedischarged`");
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

if($pagecount<=$show){
echo "
        <tr>
          <td><div align='right'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='left' class='arial s14 black'>Page $pagenum of $totalpage</div></td>
            </tr>
          </table></div></td>
        </tr>
";
}
else if($pagecount>$show){
if($page=='0'){
echo "
        <tr>
          <td><div align='right'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='left' class='arial s14 black'>Page $pagenum of <a href='../TransmittalList/?page=$nxtpage&claimnumber=$claimnumber' style='text-decoration: none;color: #000000;'>$totalpage</a></div></td>
            </tr>
          </table></div></td>
        </tr>
";
}
else if(($page!=0)&&($nxtpage!=$page)){
echo "
        <tr>
          <td><div align='right'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='left' class='arial s14 black'>Page <a href='../TransmittalList/?page=$prevpage&claimnumber=$claimnumber' style='text-decoration: none;color: #000000;'>$pagenum</a> of <a href='../TransmittalList/?page=$nxtpage&claimnumber=$claimnumber' style='text-decoration: none;color: #000000;'>$totalpage</a></div></td>
            </tr>
          </table></div></td>
        </tr>
";
}
else if($nxtpage==$page){
echo "
        <tr>
          <td><div align='right'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='left' class='arial s14 black'>Page <a href='../TransmittalList/?page=$prevpage&claimnumber=$claimnumber' style='text-decoration: none;color: #000000;'>$pagenum</a> of $totalpage</div></td>
            </tr>
          </table></div></td>
        </tr>
";
}
}


echo "
      </table></td>
    </tr>
  </table>
</div>
";

?>
</body>
</html>
