<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("../Settings.php"); $cuz = new database(); mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass()); mysql_select_db($cuz->getDB()); $snamesql=mysql_query("SELECT heading, address, telno FROM heading"); while($snamefetch=mysql_fetch_array($snamesql)){ $sname=$snamefetch['heading']; $address=$snamefetch['address']; $telno=$snamefetch['telno']; } echo "$sname"; ?></title>
<link href="CSS/style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="../../image/logo/logo.png" type="image/png" />
</head>
<style>
.watermark{
color:red;
height:100%;
width:100%;
display:flex;
align-items:center;
justify-content:center;
position:fixed;
bottom:5px;
right:5px;
}
</style>
<body>
<div class="watermark"><font size='100%' style='text-align: center;'><b>* STATEMENT OF ACCOUNT TEST<br><small>Request format by Dr. Lily</small></b></font></div>
<?php
ini_set('display_errors', 'On');

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$patientidno=$_GET['patientidno'];
$caseno=$_GET['caseno'];
$uname=$_GET['uname'];

$resall= fopen("Logs/$caseno.txt", "w") or die("Unable to open file!");


mysql_query('SET NAMES utf8');
$admsql=mysql_query("SELECT patientidno, membership, paymentmode, room, UPPER(street) AS street, UPPER(barangay) AS barangay, UPPER(municipality) AS municipality, UPPER(province) AS province,UPPER(pastmed) AS pastmed, zipcode, status, UPPER(initialdiagnosis) AS initialdiagnosis, UPPER(finaldiagnosis) AS finaldiagnosis, UPPER(ap) AS ap, timeadmitted, dateadmit, contactno, employerno, hmomembership, hmo FROM admission WHERE caseno='$caseno'");
while($admfetch=mysql_fetch_array($admsql)){
$patientidno=$admfetch['patientidno'];
$membership=$admfetch['membership'];
$paymentmode=$admfetch['paymentmode'];
$room=$admfetch['room'];
$street=$admfetch['street'];
$barangay=$admfetch['barangay'];
$municipality=$admfetch['municipality'];
$province=$admfetch['province'];
$pastmed=$admfetch['pastmed'];
$initialdiagnosis=$admfetch['initialdiagnosis'];
$finaldiagnosis=$admfetch['finaldiagnosis'];
$ap=$admfetch['ap'];
$timeadmitted=$admfetch['timeadmitted'];
$dateadmit=$admfetch['dateadmit'];
$contactno=$admfetch['contactno'];
$employerno=$admfetch['employerno'];
$hmomembership=$admfetch['hmomembership'];
$sethmo=$admfetch['hmo'];
$zipcode=$admfetch['zipcode'];
$adstatus=$admfetch['status'];
}

mysql_query('SET NAMES utf8');
$patfsql=mysql_query("SELECT UPPER(lastname) AS lastname, UPPER(firstname) AS firstname, UPPER(middlename) AS middlename, age, sex, senior, UPPER(suffix) AS suffix, birthdate FROM patientprofile WHERE patientidno='$patientidno'");
while($patffetch=mysql_fetch_array($patfsql)){
$lastname=$patffetch['lastname'];
$firstname=$patffetch['firstname'];
$middlename=$patffetch['middlename'];
$age=$patffetch['age'];
$sex=$patffetch['sex'];
$senior=$patffetch['senior'];
$suffix=$patffetch['suffix'];
$birthdate=$patffetch['birthdate'];
}

$dateOfBirth=date("Y-m-d");
$today = date("Y-m-d",strtotime($birthdate));
$diff = date_diff(date_create($dateOfBirth), date_create($today));
$agerel=$diff->format('%y');

$tm="2020-01-01 ".$timeadmitted;
$timeadmittedrel=date("h:i A",strtotime($tm));

$agsql=mysql_query("SELECT SUM(amount) AS amount FROM acctgenledge WHERE caseno='$caseno' AND acctitle='Discounts'");
$agcount=mysql_num_rows($agsql);
if($agcount==0){
$agamount=0;
}
else{
while($agfetch=mysql_fetch_array($agsql)){$agamount=$agfetch['amount'];}
}

$agamount=0;

$dispfi=0;
$fcsql=mysql_query("SELECT icdcode, hospitalshare, pfshare, level, UPPER(description) AS description FROM finalcaserate WHERE caseno='$caseno' AND level='primary'");
$fccount=mysql_num_rows($fcsql);

if($fccount==0){
$fcicdcode="";
$fcdesc="";
$fchshare=0;
$fcpshare=0;
}
else{
while($fcfetch=mysql_fetch_array($fcsql)){$fcicdcode=$fcfetch['icdcode'];$fchshare=$fcfetch['hospitalshare'];$fcpshare=$fcfetch['pfshare'];$fcdesc=$fcfetch['description'];}

//1st Description--------------------------------
$fcidsql=mysql_query("SELECT description FROM caserates WHERE icdcode='$fcicdcode'");
$fcidcount=mysql_num_rows($fcidsql);
if($fcidcount==0){
$fcidesc="";
$dispfi+=1;
}
else{
$fcidfetch=mysql_fetch_array($fcidsql);
$fcidesc=$fcidfetch['description'];

//Add Details
$sodsql=mysql_query("SELECT * FROM soadetails WHERE caseno='$caseno'");
$sodcount=mysql_num_rows($sodsql);
if($sodcount==0){
  $da=date("Ymdhi");
  mysql_query("INSERT INTO `soadetails`(`caseno`, `d1`, `d2`, `d3`, `c1`, `c2`, `addedby`, `dateadded`) VALUES ('$caseno', '', '', '', '$fcidesc', '', '$uname', '$da')");
}
else{
  $sodfetch=mysql_fetch_array($sodsql);
  $sodc1=$sodfetch['c1'];
    if($sodc1==""){
      mysql_query("UPDATE `soadetails` SET `c1`='$fcidesc' WHERE caseno='$caseno'");
    }
}
//----------

}
//End 1st Description----------------------------
}

$secsql=mysql_query("SELECT icdcode, hospitalshare, pfshare, level, UPPER(description) AS description FROM finalcaserate WHERE caseno='$caseno' AND level='secondary'");
$seccount=mysql_num_rows($secsql);

if($seccount==0){
$secicdcode="";
$secdesc="";
$sechshare=0;
$secpshare=0;
}
else{
while($secfetch=mysql_fetch_array($secsql)){$secicdcode=$secfetch['icdcode'];$sechshare=$secfetch['hospitalshare'];$secpshare=$secfetch['pfshare'];$secdesc=$secfetch['description'];}
$dispsi=0;
//2nd Description--------------------------------
$scidsql=mysql_query("SELECT description FROM caserates WHERE icdcode='$secicdcode'");
$scidcount=mysql_num_rows($scidsql);
if($scidcount==0){
$scidesc="";
$dispsi+=1;
}
else{
$scidfetch=mysql_fetch_array($scidsql);
$scidesc=$scidfetch['description'];

//Add Details
$sodsql=mysql_query("SELECT * FROM soadetails WHERE caseno='$caseno'");
$sodcount=mysql_num_rows($sodsql);
if($sodcount!=0){
  $sodfetch=mysql_fetch_array($sodsql);
  $sodc2=$sodfetch['c2'];
    if($sodc2==""){
      mysql_query("UPDATE `soadetails` SET `c2`='$scidesc' WHERE caseno='$caseno'");
    }
}
//----------

}
//End 2nd Description----------------------------
}


//SOA Details--------------------------------------------------------------------------------------
$sdfsql=mysql_query("SELECT * FROM soadetails WHERE caseno='$caseno'");
$sdfcount=mysql_num_rows($sdfsql);
if($sdfcount==0){
  $d1="";
  $d2="";
  $d3="";
  $c1="";
  $c2="";
}
else{
  $sdffetch=mysql_fetch_array($sdfsql);
  $d1=strtoupper($sdffetch['d1']);
  $d2=strtoupper($sdffetch['d2']);
  $d3=strtoupper($sdffetch['d3']);
  $c1=strtoupper($sdffetch['c1']);
  $c2=strtoupper($sdffetch['c2']);
}

if($c1==""){
  $c1disp="";
}
else{
  $c1disp=" --> ".$c1;
}

if($c2==""){
  $c2disp="";
}
else{
  $c2disp=" --> ".$c2;
}
//End SOA Details----------------------------------------------------------------------------------

$tersql=mysql_query("SELECT icdcode, hospitalshare, pfshare, level, UPPER(description) AS description FROM finalcaserate WHERE caseno='$caseno' AND level='tertiary'");
$tercount=mysql_num_rows($tersql);

if($tercount==0){
$tericdcode="";
$terdesc="";
$terhshare=0;
$terpshare=0;
}
else{
while($terfetch=mysql_fetch_array($tersql)){$tericdcode=$terfetch['icdcode'];$terhshare=$terfetch['hospitalshare'];$terpshare=$terfetch['pfshare'];$terdesc=$terfetch['description'];}
}

$fousql=mysql_query("SELECT icdcode, hospitalshare, pfshare, level, UPPER(description) AS description FROM finalcaserate WHERE caseno='$caseno' AND level='fourth'");
$foucount=mysql_num_rows($fousql);

if($foucount==0){
$fouicdcode="";
$foudesc="";
$fouhshare=0;
$foupshare=0;
}
else{
while($foufetch=mysql_fetch_array($fousql)){$fouicdcode=$foufetch['icdcode'];$fouhshare=$foufetch['hospitalshare'];$foupshare=$foufetch['pfshare'];$foudesc=$foufetch['description'];}
}



echo "
<div align='center'>
  <table width='100%' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td width='3%'></td>
          <td width='110' rowspan='3'><div align='center'><img src='Image/logo.png' width='auto' height='100' /></div></td>
          <td width='auto' height='50' valign='middle'><div align='center' class='times16blackbold'>STATEMENT OF ACCOUNT - TEST</div></td>
          <td width='110'></td>
          <td width='3%'></td>
        </tr>
        <tr>
          <td width='3%'></td>
          <td width='auto' colspan='2' valign='middle' height='30'><div align='right'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='left' class='times14blackbold'>SOA Reference No.:</div></td>
              <td class='table1Bottom'><div align='left' class='times14black'>&nbsp;$employerno&nbsp;</div></td>
            </tr>
          </table></div></td>
          <td width='3%'></td>
        </tr>
        <tr>
          <td width='3%'></td>
          <td><div align='center'><span class='times14blackbold'>$sname<br /></span><span class='times14black'>$address<br />$telno</span></div></td>
          <td width='110'></td>
          <td width='3%'></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height='30'></td>
    </tr>
    <tr>
      <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td width='2%'></td>
          <td width='52%'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='68' height='20'><div align='left' class='times10blackbold'>Patient name:&nbsp;</div></td>
              <td width='auto' class='table1Bottom'><div align='left' class='times11blackbold'>&nbsp;$lastname, $firstname $middlename $suffix&nbsp;</div></td>
              <td width='20'><div align='left' class='times12blackbold'>&nbsp;Age:&nbsp;</div></td>
              <td width='20' class='table1Bottom'><div align='left' class='times10black'>&nbsp;$agerel&nbsp;</div></td>
            </tr>
          </table></td>
          <td width='42%'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='50' height='20'></td>
              <td width='112'><div align='left' class='times10blackbold'>Billing Date:&nbsp;</div></td>
              <td width='auto' class='table1Bottom'><div align='left' class='times9black'>&nbsp;".date("M-d-Y h:i:s a")."&nbsp;</div></td>
            </tr>
          </table></td>
          <td width='4%'></td>
        </tr>


        <tr>
          <td></td>
          <td rowspan='2'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='48' height='20'><div align='left' class='times10blackbold'>Address:&nbsp;</div></td>
              <td width='auto' class='table1Bottom'><div align='left' class='times10black'>&nbsp;$street $barangay $municipality $province $zipcode&nbsp;</div></td>
            </tr>
          </table></td>
          <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='50' height='20'></td>
              <td width='112'><div align='left' class='times10blackbold'>Date & Time Admitted:&nbsp;</div></td>
              <td width='auto' class='table1Bottom'><div align='left' class='times9black'>&nbsp;".date("M d, Y",strtotime($dateadmit))." ".$timeadmittedrel."&nbsp;</div></td>
            </tr>
          </table></td>
          <td></td>
        </tr>


        <tr>
          <td></td>

          <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='50' height='20'></td>
              <td width='120'><div align='left' class='times10blackbold'>Date & Time Discharged:&nbsp;</div></td>
              <td width='auto' class='table1Bottom'><a href='TempDateDis.php?caseno=$caseno' target='_blank' class='astyle'><div align='left' class='times9black'>
";

$dtsql=mysql_query("SELECT datedischarged, timedischarged FROM dischargedtable WHERE caseno='$caseno'");
$dtcount=mysql_num_rows($dtsql);

if($dtcount==0){
$tdssql=mysql_query("SELECT date, time FROM tempdatestorage WHERE caseno='$caseno'");
$tdscount=mysql_num_rows($tdssql);

if($tdscount==0){
echo "
                &nbsp;&nbsp;
";
}
else{
while($tdsfetch=mysql_fetch_array($tdssql)){
$tdsdate=$tdsfetch['date'];
//$tdsdate=str_replace("_","-",$tsdate);
$tdstime=$tdsfetch['time'];
}

if($tdsdate==""){
echo "
                &nbsp;&nbsp;
";
}
else{
echo "
                  &nbsp;&nbsp;
";
//echo "
//                &nbsp;".date("M d, Y",strtotime($tdsdate))." $tdstime&nbsp;
//";
}
}
}

else{
while($dtfetch=mysql_fetch_array($dtsql)){
$datedischarged=$dtfetch['datedischarged'];
$datedischarged=str_replace("_","-",$datedischarged);
$timedischarged=$dtfetch['timedischarged'];
}

echo "
                &nbsp;".date("M d, Y",strtotime($datedischarged))." ".$timedischarged."&nbsp;
";
}

echo "
              </div></a></td>
            </tr>
          </table></td>
          <td></td>
        </tr>

        <tr>
          <td></td>
";


echo "
          <td valign='top'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='80' height='30'><div align='left' class='times10blackbold'>Final Diagnosis:&nbsp;</div></td>
                  <td width='auto' class='table1Bottom'><div align='left' class='times10black'>&nbsp;$finaldiagnosis&nbsp;</div></td>
                </tr>
              </table></td>
            <tr>
            <tr>
              <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='100'><div align='left' class='times10blackbold'>Other Diagnosis:&nbsp;</div></td>
                      <td width='auto'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td width='10' height='20'><div align='left' class='times10blackbold'>1.</div></td>
                          <td width='auto' class='table1Bottom'><a href='AddDiagnosis.php?caseno=$caseno' class='astyle' target='_blank'><div align='left' class='times10black2'>&nbsp;$d1&nbsp;</div></a></td>
                        </tr>
                        <tr>
                          <td width='10' height='20'><div align='left' class='times10blackbold'>2.</div></td>
                          <td width='auto' class='table1Bottom'><a href='AddDiagnosis.php?caseno=$caseno' class='astyle' target='_blank'><div align='left' class='times10black2'>&nbsp;$d2&nbsp;</div></a></td>
                        </tr>
                        <tr>
                          <td width='10' height='20'><div align='left' class='times10blackbold'>3.</div></td>
                          <td width='auto' class='table1Bottom'><a href='AddDiagnosis.php?caseno=$caseno' class='astyle' target='_blank'><div align='left' class='times10black2'>&nbsp;$d3&nbsp;</div></a></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
              </table></td>
            </tr>
          </table></td>
";


echo "
          <td valign='top'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='50'></td>
              <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
              <tr>
                <td height='20'><div align='left' class='times10blackbold'>Room:&nbsp;</div></td>
                <td class='table1Bottom'><div align='left' class='times10blackbold'>&nbsp;$room</div></td>
              </tr>
                <tr>
                  <td width='90' height='35'><div align='left' class='times10blackbold'>First Case Rate:&nbsp;</div></td>
                  <td width='auto' class='table1Bottom' valign='middle'><a href='AddDetails.php?caseno=$caseno&type=1' class='astyle' target='_blank'><div align='left'>
                    <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td width='45' valign='middle'><div align='left' class='times10blackbold'>&nbsp;$fcicdcode</div></td>
                        <td width='auto'><div align='left' class='times8black'>$c1disp&nbsp;</div></td>
                      <tr>
                    </table>
                  </div></a></td>
                </tr>
";

if($secicdcode!=""){
echo "
                <tr>
                  <td height='35'><div align='left' class='times10blackbold'>Second Case Rate:&nbsp;</div></td>
                  <td width='auto' class='table1Bottom' valign='middle'><a href='AddDetails.php?caseno=$caseno&type=2' class='astyle' target='_blank'><div align='left'>
                    <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td width='45' valign='middle'><div align='left' class='times10blackbold'>&nbsp;$secicdcode</div></td>
                        <td width='auto'><div align='left' class='times8black'>$c2disp&nbsp;</div></td>
                      <tr>
                    </table>
                  </div></a></td>
                </tr>
";
}
else{
echo "
                <tr>
                  <td height='35'><div align='left' class='times10blackbold'>Second Case Rate:&nbsp;</div></td>
                  <td width='auto' class='table1Bottom' valign='middle'><div align='left'>
                    <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td width='45' valign='middle'><div align='left' class='times10blackbold'>&nbsp;$secicdcode</div></td>
                        <td width='auto'><div align='left' class='times8black2'>$c2disp&nbsp;</div></td>
                      <tr>
                    </table>
                  </div></td>
                </tr>
";
}


echo "
              </table></td>
            <tr>
          </table></td>
";


echo "
          <td></td>
        </tr>

      </table></td>
    </tr>
    <tr>
      <td height='10'></td>
    </tr>
    <tr>
      <td><div align='center' class='times14blackbold'>SUMMARY OF FEES</div></td>
    </tr>
";

if(($adstatus=="MGH")||($adstatus=="discharged")||($adstatus=="TRANSFERRED")){
}
else{
echo "
    <tr>
      <td><div align='center' style='font-family: arial;color: red;font-size: 30px;font-weight: bold;'>PATIENT IS NOT SET AS MGH!!!<br />PLEASE SETTLE ALL PENDING MEDS/SUPPLIES/SERVICES!!!</div></td>
    </tr>
";
}

echo "
    <tr>
      <td height='10'></td>
    </tr>
    <tr>
      <td><table width='100%' border='1' cellpadding='0' cellspacing='0'>
        <tr>
          <td width='auto' rowspan='2'><div align='center' class='times12blackbold'>Particulars</div></td>
          <td width='70' rowspan='2'><div align='center' class='times12blackbold'>Actual<br />Charges</div></td>
          <td colspan='3'><div align='center' class='times12blackbold'>Amount of Discounts</div></td>
          <td colspan='2'><div align='center' class='times12blackbold'>PhilHealth benefits</div></td>
          <td width='70' rowspan='2'><div align='center' class='times12blackbold'>Out of<br />Pocket<br />of Patient</div></td>
        </tr>
        <tr>
          <td width='70'><div align='center' class='times12blackbold'>VAT<br />exempt</div></td>
          <td width='70'><div align='center' class='times12blackbold'>Senior<br />Citizen/<br />PWD</div></td>
          <td width='70'><a href='DiscType.php?caseno=$caseno' class='astyle' target='_blank'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='2'></td>
              <td width='auto'><div align='left' class='times8blackbold'>Place &#10004;</div></td>
            </tr>
";

$tddssql=mysql_query("SELECT discounttype1, discounttype2, discounttype3, discounttype4, discounttype5, discounttype5o FROM tempdatestorage WHERE caseno='$caseno'");
$tddscount=mysql_num_rows($tddssql);

if($tddscount==0){
$pcso="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
$dswd="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
$doh="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
$hmo="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
$others="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
$othersVal="";

$discounttype5="";
}
else{
while($tddsfetch=mysql_fetch_array($tddssql)){
$discounttype1=$tddsfetch['discounttype1'];
$discounttype2=$tddsfetch['discounttype2'];
$discounttype3=$tddsfetch['discounttype3'];
$discounttype4=$tddsfetch['discounttype4'];
$discounttype5=$tddsfetch['discounttype5'];
$discounttype5o=$tddsfetch['discounttype5o'];
}

if($discounttype1=="c"){$pcso="&nbsp;&#10004;&nbsp;";}else{$pcso="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}
if($discounttype2=="c"){$dswd="&nbsp;&#10004;&nbsp;";}else{$dswd="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}
if($discounttype3=="c"){$doh="&nbsp;&#10004;&nbsp;";}else{$doh="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}
if($discounttype4=="c"){$hmo="&nbsp;&#10004;&nbsp;";}else{$hmo="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}
if($discounttype5=="c"){$others="&nbsp;&#10004;&nbsp;";$othersval=$discounttype5o;}else{$others="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";$othersval="";}

}

if(stripos($hmomembership, "hmo-") !== FALSE){$hmo="&nbsp;&#10004;&nbsp;";$hmodisp="<br /><span style='font-size: 8px;'>".$sethmo."</span>";}else{$hmodisp="";}


echo "
            <tr>
              <td></td>
              <td><div align='left' class='times10blackbold'><u>".$pcso."</u>PCSO</div></td>
            </tr>
            <tr>
              <td></td>
              <td><div align='left' class='times10blackbold'><u>".$dswd."</u>DSWD</div></td>
            </tr>
            <tr>
              <td></td>
              <td><div align='left'><span class='times10blackbold'><u>".$doh."</u>DOH</span><span class='times8black'>(MAP)</span></div></td>
            </tr>
            <tr>
              <td></td>
              <td><div align='left' class='times10blackbold'><u>".$hmo."</u>HMO$hmodisp</div></td>
            </tr>
            <tr>
              <td></td>
              <td><div align='left' class='times10blackbold'><u>".$others."</u>Others:</div></td>
            </tr>
";


if($discounttype5=="c"){
echo "
            <tr>
              <td></td>
              <td><div align='left' class='times10blackbold'>&nbsp;$othersval</div></td>
            </tr>
";
}
else{
echo "
            <tr>
              <td></td>
              <td><div align='left' class='times10blackbold'>&nbsp;</div></td>
            </tr>
";
}

echo "
          </table></a></td>
          <td width='70'><div align='center' class='times12blackbold'>First<br />Case Rate<br />amount</div></td>
          <td width='70'><div align='center' class='times12blackbold'>Second<br />Case Rate<br />amount</div></td>
        </tr>
        <tr>
          <td><a href='../../2020codes/AutoDistro/showcharges.php?caseno=$caseno' target='_blank' class='astyle'><div align='center' class='times12blackbold'>HCI fees</div></a></td>
          <td colspan='7'><div align='center' class='times12blackbold'>&nbsp;</div></td>
        </tr>
";

$a=0;

$labtotactual=0;
$labadjsubtot=0;
$labgrosssubtot=0;
$labhmotot=0;
$labphictot=0;
$labphic1tot=0;
$labexcesstot=0;

$totactual=0;
$adjsubtot=0;
$grosssubtot=0;
$hmotot=0;
$phictot=0;
$phic1tot=0;
$excesstot=0;

$suppliesactual=0;
$suppliesadj=0;
$supplieshmo=0;
$suppliesphic=0;
$suppliesphic1=0;
$suppliesexcess=0;

$misctotactual=0;
$miscadjsubtot=0;
$miscgrosssubtot=0;
$mischmotot=0;
$miscphictot=0;
$miscphic1tot=0;
$miscexcesstot=0;



// ---------------------------------------- ROOM ACCOMODATION ---------------------------------------
$poutdsql=mysql_query("SELECT sellingprice, quantity, adjustment, gross, hmo, phic, phic1, excess FROM productout WHERE caseno='$caseno' AND quantity > 0 AND trantype='charge' AND productsubtype='ROOM ACCOMODATION'");
$poutdcount=mysql_num_rows($poutdsql);
if($poutdcount==0){}
else{
$poutdadjtot=0;
$poutdgrosstot=0;
$actual=0;
$hmo=0;
$phic=0;
$phic1=0;
$excess=0;
while($poutdfetch=mysql_fetch_array($poutdsql)){$poutdadjtot+=$poutdfetch['adjustment'];$poutdgrosstot+=$poutdfetch['gross'];$actual+=($poutdfetch['sellingprice']*$poutdfetch['quantity']);$hmo+=$poutdfetch['hmo'];$phic+=$poutdfetch['phic'];$phic1+=$poutdfetch['phic1'];$excess+=$poutdfetch['excess'];}


$totactual+=$actual;
$adjsubtot+=$poutdadjtot;
$grosssubtot+=$poutdgrosstot;
$hmotot+=$hmo;
$phictot+=$phic;
$phic1tot+=$phic1;
$excesstot+=$excess;

echo "
<tr>
<td><a href='../../2020codes/TestCodes/testviewdetails.php?caseno=$caseno&type=ROOM ACCOMODATION' target='_blank' class='astyle'><div align='left' class='times10blackbold'>&nbsp;ROOM ACCOMODATION</div></a></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($actual,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($poutdadjtot,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($hmo,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($phic,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($phic1,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($excess,2,'.',',')."&nbsp;</div></td>
</tr>
";
}
// ----------------------------------------------------------------------------------------------------


// ---------------------------------------- LABORATORY ---------------------------------------
$poutdsql=mysql_query("SELECT sellingprice, quantity, adjustment, gross, hmo, phic, phic1, excess FROM productout WHERE caseno='$caseno' AND quantity > 0 AND trantype='charge' AND productsubtype='LABORATORY'");
$poutdcount=mysql_num_rows($poutdsql);
if($poutdcount==0){}
else{
$poutdadjtot=0;
$poutdgrosstot=0;
$actual=0;
$hmo=0;
$phic=0;
$phic1=0;
$excess=0;
while($poutdfetch=mysql_fetch_array($poutdsql)){$poutdadjtot+=$poutdfetch['adjustment'];$poutdgrosstot+=$poutdfetch['gross'];$actual+=($poutdfetch['sellingprice']*$poutdfetch['quantity']);$hmo+=$poutdfetch['hmo'];$phic+=$poutdfetch['phic'];$phic1+=$poutdfetch['phic1'];$excess+=$poutdfetch['excess'];}


$totactual+=$actual;
$adjsubtot+=$poutdadjtot;
$grosssubtot+=$poutdgrosstot;
$hmotot+=$hmo;
$phictot+=$phic;
$phic1tot+=$phic1;
$excesstot+=$excess;

echo "
<tr>
<td><a href='../../2020codes/TestCodes/testviewdetails.php?caseno=$caseno&type=ROOM ACCOMODATION' target='_blank' class='astyle'><div align='left' class='times10blackbold'>&nbsp;LABORATORY</div></a></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($actual,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($poutdadjtot,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($hmo,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($phic,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($phic1,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($excess,2,'.',',')."&nbsp;</div></td>
</tr>
";
}
// ----------------------------------------------------------------------------------------------------


// ---------------------------------------- XRAY/ ULTASOUND/ CTSCAN / ECG ---------------------------------------
$poutdsql=mysql_query("SELECT sum(sellingprice) as sellingprice, sum(quantity) as quantity, sum(adjustment) as adjustment, sum(gross) as gross, sum(hmo) as hmo, sum(phic) as phic, sum(phic1) as phic1, sum(excess) as excess, productsubtype FROM productout WHERE caseno='$caseno' AND quantity > 0 AND trantype='charge' AND (productsubtype like '%XRAY%' or productsubtype like '%ULTRASOUND%' or productsubtype like '%CT SCAN%' or productsubtype like '%MAMMO%' or productsubtype like '%ECG%') group by productsubtype");
$poutdcount=mysql_num_rows($poutdsql);
if($poutdcount==0){}
else{
$poutdadjtot=0;
$poutdgrosstot=0;
$actual=0;
$hmo=0;
$phic=0;
$phic1=0;
$excess=0;
while($poutdfetch=mysql_fetch_array($poutdsql)){$poutdadjtot=$poutdfetch['adjustment'];$poutdgrosstot=$poutdfetch['gross'];$actual=($poutdfetch['sellingprice']*$poutdfetch['quantity']);$hmo=$poutdfetch['hmo'];$phic=$poutdfetch['phic'];$phic1=$poutdfetch['phic1'];$excess=$poutdfetch['excess'];$ptype=$poutdfetch['productsubtype'];


$totactual+=$actual;
$adjsubtot+=$poutdadjtot;
$grosssubtot+=$poutdgrosstot;
$hmotot+=$hmo;
$phictot+=$phic;
$phic1tot+=$phic1;
$excesstot+=$excess;

echo "
<tr>
<td><a href='../../2020codes/TestCodes/testviewdetails.php?caseno=$caseno&type=ROOM ACCOMODATION' target='_blank' class='astyle'><div align='left' class='times10blackbold'>&nbsp;$ptype</div></a></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($actual,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($poutdadjtot,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($hmo,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($phic,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($phic1,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($excess,2,'.',',')."&nbsp;</div></td>
</tr>
";
}
}
// ----------------------------------------------------------------------------------------------------

// ---------------------------------------- MEDICINES ---------------------------------------
$poutdsql=mysql_query("SELECT sellingprice, quantity, adjustment, gross, hmo, phic, phic1, excess FROM productout WHERE caseno='$caseno' AND quantity > 0 AND trantype='charge' AND productsubtype like '%MEDICINE%'");
$poutdcount=mysql_num_rows($poutdsql);
if($poutdcount==0){}
else{
$poutdadjtot=0;
$poutdgrosstot=0;
$actual=0;
$hmo=0;
$phic=0;
$phic1=0;
$excess=0;
while($poutdfetch=mysql_fetch_array($poutdsql)){$poutdadjtot+=$poutdfetch['adjustment'];$poutdgrosstot+=$poutdfetch['gross'];$actual+=($poutdfetch['sellingprice']*$poutdfetch['quantity']);$hmo+=$poutdfetch['hmo'];$phic+=$poutdfetch['phic'];$phic1+=$poutdfetch['phic1'];$excess+=$poutdfetch['excess'];}


$totactual+=$actual;
$adjsubtot+=$poutdadjtot;
$grosssubtot+=$poutdgrosstot;
$hmotot+=$hmo;
$phictot+=$phic;
$phic1tot+=$phic1;
$excesstot+=$excess;

echo "
<tr>
<td><a href='../../2020codes/TestCodes/testviewdetails.php?caseno=$caseno&type=PHARMACY/MEDICINES' target='_blank' class='astyle'><div align='left' class='times10blackbold'>&nbsp;PHARMACY/MEDICINE</div></a></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($actual,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($poutdadjtot,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($hmo,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($phic,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($phic1,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($excess,2,'.',',')."&nbsp;</div></td>
</tr>
";
}
// ----------------------------------------------------------------------------------------------------


// ---------------------------------------- MEDICAL SUPPLIES ---------------------------------------
$poutdsql=mysql_query("SELECT sellingprice, quantity, adjustment, gross, hmo, phic, phic1, excess FROM productout WHERE caseno='$caseno' AND quantity > 0 AND trantype='charge' AND productsubtype like '%SUPPLIES%' and productsubtype not like '%OXYGEN%' and productsubtype not like '%OR/DR SUPPLIES%'");
$poutdcount=mysql_num_rows($poutdsql);
if($poutdcount==0){}
else{
$poutdadjtot=0;
$poutdgrosstot=0;
$actual=0;
$hmo=0;
$phic=0;
$phic1=0;
$excess=0;
while($poutdfetch=mysql_fetch_array($poutdsql)){$poutdadjtot+=$poutdfetch['adjustment'];$poutdgrosstot+=$poutdfetch['gross'];$actual+=($poutdfetch['sellingprice']*$poutdfetch['quantity']);$hmo+=$poutdfetch['hmo'];$phic+=$poutdfetch['phic'];$phic1+=$poutdfetch['phic1'];$excess+=$poutdfetch['excess'];}


$totactual+=$actual;
$adjsubtot+=$poutdadjtot;
$grosssubtot+=$poutdgrosstot;
$hmotot+=$hmo;
$phictot+=$phic;
$phic1tot+=$phic1;
$excesstot+=$excess;

echo "
<tr>
<td><a href='../../2020codes/TestCodes/testviewdetails.php?caseno=$caseno&type=PHARMACY/MEDICINES' target='_blank' class='astyle'><div align='left' class='times10blackbold'>&nbsp;MEDICAL SUPPLIES</div></a></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($actual,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($poutdadjtot,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($hmo,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($phic,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($phic1,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($excess,2,'.',',')."&nbsp;</div></td>
</tr>
";
}
// ----------------------------------------------------------------------------------------------------

// ---------------------------------------- OXYGEN SUPPLIES ---------------------------------------
$poutdsql=mysql_query("SELECT sellingprice, quantity, adjustment, gross, hmo, phic, phic1, excess FROM productout WHERE caseno='$caseno' AND quantity > 0 AND trantype='charge' AND productsubtype like '%OXYGEN%'");
$poutdcount=mysql_num_rows($poutdsql);
if($poutdcount==0){}
else{
$poutdadjtot=0;
$poutdgrosstot=0;
$actual=0;
$hmo=0;
$phic=0;
$phic1=0;
$excess=0;
while($poutdfetch=mysql_fetch_array($poutdsql)){$poutdadjtot+=$poutdfetch['adjustment'];$poutdgrosstot+=$poutdfetch['gross'];$actual+=($poutdfetch['sellingprice']*$poutdfetch['quantity']);$hmo+=$poutdfetch['hmo'];$phic+=$poutdfetch['phic'];$phic1+=$poutdfetch['phic1'];$excess+=$poutdfetch['excess'];}


$totactual+=$actual;
$adjsubtot+=$poutdadjtot;
$grosssubtot+=$poutdgrosstot;
$hmotot+=$hmo;
$phictot+=$phic;
$phic1tot+=$phic1;
$excesstot+=$excess;

echo "
<tr>
<td><a href='../../2020codes/TestCodes/testviewdetails.php?caseno=$caseno&type=PHARMACY/MEDICINES' target='_blank' class='astyle'><div align='left' class='times10blackbold'>&nbsp;OXYGEN SUPPLIES</div></a></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($actual,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($poutdadjtot,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($hmo,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($phic,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($phic1,2,'.',',')."&nbsp;</div></td>
<td><div align='right' class='times10black'>&nbsp;".number_format($excess,2,'.',',')."&nbsp;</div></td>
</tr>
";
}
// ----------------------------------------------------------------------------------------------------



// --------------------------------------------MISCELLANEOUS ------------------------------------------



$poutdsql=mysql_query("SELECT sellingprice, quantity, adjustment, gross, hmo, phic, phic1, excess FROM productout WHERE caseno='$caseno' AND trantype='charge' AND quantity > 0 AND

 (productsubtype='ADMISSION FEE' or productsubtype='ER FEE' or productsubtype='GENERAL SUPPLIES' or productsubtype='MEDICAL EQUIPMENT' or productsubtype='MISCELLANEOUS' or productsubtype='OR-CHARGES' or productsubtype='OR/DR SUPPLIES' or productsubtype='OR/DR/ER FEE' or productsubtype='ADMITTING FEE' or productsubtype='MISCELLANEOUS CR' or productsubtype='NURSING CHARGES' or productsubtype='NURSING SERVICE FEE' or productsubtype='NURSING_CHARGES' or productsubtype='LINENS' or productsubtype='LAUNDRY SUPPLIES' or productsubtype='OTHER INCOME')");

$poutdcount=mysql_num_rows($poutdsql);
if($poutdcount==0){
}
else{
$poutdadjtot=0;
$poutdgrosstot=0;
$actual=0;
$hmo=0;
$phic=0;
$phic1=0;
$excess=0;
while($poutdfetch=mysql_fetch_array($poutdsql)){$poutdadjtot+=$poutdfetch['adjustment'];$poutdgrosstot+=$poutdfetch['gross'];$actual+=($poutdfetch['sellingprice']*$poutdfetch['quantity']);$hmo+=$poutdfetch['hmo'];$phic+=$poutdfetch['phic'];$phic1+=$poutdfetch['phic1'];$excess+=$poutdfetch['excess'];}

$misctotactual+=$actual;
$miscadjsubtot+=$poutdadjtot;
$miscgrosssubtot+=$poutdgrosstot;
$mischmotot+=$hmo;
$miscphictot+=$phic;
$miscphic1tot+=$phic1;
$miscexcesstot+=$excess;

$totactual+=$actual;
$adjsubtot+=$poutdadjtot;
$grosssubtot+=$poutdgrosstot;
$hmotot+=$hmo;
$phictot+=$phic;
$phic1tot+=$phic1;
$excesstot+=$excess;

}
// ---------------------------------------------------------------------------------------------------





$pfadactual=0;
if($suppliesactual!=0){

echo "
        <tr>
          <td><a href='../../2020codes/TestCodes/testviewdetails.php?caseno=$caseno&type=MEDICAL SUPPLIES' target='_blank' class='astyle'><div align='left' class='times10blackbold'>&nbsp;MEDICAL SUPPLIES</div></a></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(($suppliesactual),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(($suppliesadj),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(($supplieshmo),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(($suppliesphic),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(($suppliesphic1),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(($suppliesexcess),2,'.',',')."&nbsp;</div></td>
        </tr>
";
}

if($misctotactual>0){
echo "
        <tr>
          <td><a href='../../2020codes/TestCodes/testviewdetails.php?caseno=$caseno&type=MISCELLANEOUS' target='_blank' class='astyle'><div align='left' class='times10blackbold'>&nbsp;MISCELLANEOUS</div></a></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(($misctotactual),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(($miscadjsubtot),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(($mischmotot),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(($miscphictot),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(($miscphic1tot),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(($miscexcesstot),2,'.',',')."&nbsp;</div></td>
        </tr>
";
}

$agamount=0;
$hdamt=0;
$hd2amt=0;
$hd3amt=0;
$hd4amt=0;

$htot=((($totactual-$adjsubtot-($agamount+$hmotot+$hdamt+$hd2amt+$hd3amt+$hd4amt))-$fchshare)-$sechshare);
if($htot<0){$htotdisp=$htot;}else{$htotdisp=$htot;}

//$res1= fopen("Logs/$caseno-HP.txt", "w") or die("Unable to open file!");
//$log1=$totactual."|".$adjsubtot."|".($hmotot+$agamount+$hdamt+$hd2amt+$hd3amt+$hd4amt)."|".$phictot."|".$phic1tot."|".$htot."|";
//fwrite($res1, $log1);
//fclose($res1);

$logall=$totactual."|".$adjsubtot."|".($hmotot+$agamount+$hdamt+$hd2amt+$hd3amt+$hd4amt)."|".$phictot."|".$phic1tot."|".$htot."|<>";
fwrite($resall, $logall);

echo "
        <tr>
          <td height='16'><div align='left' class='times13blackbold'>&nbsp;Subtotal</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format($totactual,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format($adjsubtot,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format(($hmotot+$agamount+$hdamt+$hd2amt+$hd3amt+$hd4amt),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format($phictot,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format($phic1tot,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format($htotdisp,2,'.',',')."&nbsp;</div></td>
        </tr>
";


echo "
        <tr>
          <td><a href='../../2020codes/AutoDistro/showpf.php?caseno=$caseno' target='_blank' class='astyle'><div align='center' class='times12blackbold'>Professional fee/s</div></a></td>
          <td colspan='7'><div align='center' class='times12blackbold'>&nbsp;</div></td>
        </tr>
";

$atcount=0;$sucount=0;$ancount=0;
$prcount=0;$tprgr=0;$tprad=0;$tprp1=0;$tprp2=0;$tprhm=0;$tprex=0;
$prsql=mysqli_query($mycon1,"SELECT `productdesc`, `producttype` FROM `productout` WHERE `caseno`='$caseno' AND `productsubtype`='PROFESSIONAL FEE' AND (`producttype`='IPD attending' OR `producttype`='IPD surgeon' OR `producttype`='IPD anesthesiologist' OR `producttype`='ON CALL') ORDER BY FIELD(`producttype`, 'IPD attending', 'IPD surgeon', 'IPD anesthesiologist', 'ON CALL'),`productdesc`");
while($prfetch=mysqli_fetch_array($prsql)){
  $prdoctor=$prfetch['productdesc'];
  $prptype=$prfetch['producttype'];
  $prcount++;

  $pra=0;$pragr=0;$praad=0;$prap1=0;$prap2=0;$prahm=0;$praex=0;
  $pratsql=mysqli_query($mycon1,"SELECT * FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `productdesc`='$prdoctor'");
  while($pratfetch=mysqli_fetch_array($pratsql)){$pragr+=($pratfetch['sellingprice']*$pratfetch['quantity']);$praad+=$pratfetch['adjustment'];$prap1+=$pratfetch['phic'];$prap2+=$pratfetch['phic1'];$prahm+=$pratfetch['hmo'];$praex+=$pratfetch['excess'];}

  if($prptype=="IPD attending"){
  //Attending--------------------------------------------------------------------------------------
    $atcount++;
    if($atcount==1){
      $prcosql=mysqli_query($mycon1,"SELECT * FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND (`producttype`='IPD comanaged' OR `producttype`='Consultation')");
      while($prcofetch=mysqli_fetch_array($prcosql)){$pragr+=($prcofetch['sellingprice']*$prcofetch['quantity']);$praad+=$prcofetch['adjustment'];$prap1+=$prcofetch['phic'];$prap2+=$prcofetch['phic1'];$prahm+=$prcofetch['hmo'];$praex+=$prcofetch['excess'];}
    }
  //End Attending----------------------------------------------------------------------------------
  }
  else if($prptype=="IPD surgeon"){
  //Surgeon----------------------------------------------------------------------------------------
    $sucount++;
    if($sucount==1){
      $prcssql=mysqli_query($mycon1,"SELECT * FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `producttype`='IPD co-surgeon'");
      while($prcsfetch=mysqli_fetch_array($prcssql)){$pragr+=($prcsfetch['sellingprice']*$prcsfetch['quantity']);$praad+=$prcsfetch['adjustment'];$prap1+=$prcsfetch['phic'];$prap2+=$prcsfetch['phic1'];$prahm+=$prcsfetch['hmo'];$praex+=$prcsfetch['excess'];}
    }
  //End Surgeon------------------------------------------------------------------------------------
  }
  else if($prptype=="IPD anesthesiologist"){
  //Surgeon----------------------------------------------------------------------------------------
    $ancount++;
    if($ancount==1){
      $prcasql=mysqli_query($mycon1,"SELECT * FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `producttype`='IPD co-anesthesiologist'");
      while($prcafetch=mysqli_fetch_array($prcasql)){$pragr+=($prcafetch['sellingprice']*$prcafetch['quantity']);$praad+=$prcafetch['adjustment'];$prap1+=$prcafetch['phic'];$prap2+=$prcafetch['phic1'];$prahm+=$prcafetch['hmo'];$praex+=$prcafetch['excess'];}
    }
  //End Surgeon------------------------------------------------------------------------------------
  }

$tprgr+=$pragr;$tprad+=$praad;$tprp1+=$prap1;$tprp2+=$prap2;$tprhm+=$prahm;$tprex+=$praex;

$logall2="$prdoctor<->".$pragr."<->".$praad."<->".$prahm."<->".$prap1."<->".$prap2."<->".$praex."<->|";
fwrite($resall, $logall2);

if($prptype=="ON CALL"){$docti="";}else{$docti="DR. ";}

echo "
        <tr>
          <td><a href='../../2020codes/TestCodes/testviewdetails.php?caseno=$caseno&type=PROFESSIONAL FEE' target='_blank' class='astyle'><div align='left' class='times10blackbold'>&nbsp;$prcount.&nbsp;$docti".strtoupper($prdoctor)."</div></a></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format($pragr,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;0.00&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format($praad,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format($prahm,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format($prap1,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format($prap2,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format($praex,2,'.',',')."&nbsp;</div></td>
        </tr>
";
}


$logall3="<>";
fwrite($resall, $logall3);

$overtotdisp=$htot+$tprex;

//$logall4=$totfingross."|".$totfinadj."|".$totfinhmo."|".$totfinphic1."|".$totfinphic2."|".$totfinexc."|<>";
$logall4=$tprgr."|".$tprad."|".$tprhm."|".$tprp1."|".$tprp2."|".$tprex."|<>";
fwrite($resall, $logall4);
//$gtotalexcess=($totactual+$totfingross)-($adjsubtot+$totfinadj)-($hmotot+$totfinhmo+$agamount+$hdamt+$hd2amt+$hd3amt+$hd4amt)-($totfinphic1+$phictot)-($totfinphic2+$phic1tot);
$gtotalexcess=($totactual+$tprgr)-($adjsubtot+$tprad)-($hmotot+$tprhm+$agamount+$hdamt+$hd2amt+$hd3amt+$hd4amt)-($tprp1+$phictot)-($tprp2+$phic1tot);
$overtotdisp=$gtotalexcess;
echo "
        <tr>
          <td height='16'><div align='left' class='times13blackbold'>&nbsp;Subtotal</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format($tprgr,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format($tprad,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format($tprhm,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format($tprp1,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format($tprp2,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format($tprex,2,'.',',')."&nbsp;</div></td>
        </tr>
";

$tbgp1="";
$tbgp2="";

if(number_format(($tprp1+$phictot),2)!=number_format(($fchshare+$fcpshare),2)){
  $tbgp1="#FF0000";
}

if(number_format(($tprp2+$phic1tot),2)!=number_format(($sechshare+$secpshare),2)){
  $tbgp2="#FF0000";
}

echo "
        <tr>
          <td height='24'><div align='left' class='times13blackbold'>&nbsp;Total</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format(($totactual+$tprgr),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format(($adjsubtot+$tprad),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format(($hmotot+$tprhm+$agamount+$hdamt+$hd2amt+$hd3amt+$hd4amt),2,'.',',')."&nbsp;</div></td>
          <td bgcolor='$tbgp1'><div align='right' class='times13blackbold'>&nbsp;".number_format(($tprp1+$phictot),2,'.',',')."&nbsp;</div></td>
          <td bgcolor='$tbgp2'><div align='right' class='times13blackbold'>&nbsp;".number_format(($tprp2+$phic1tot),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format($overtotdisp,2,'.',',')."&nbsp;</div></td>
        </tr>
";


//load the AR/s and Deposit/s to patient bill
echo "
          <tr>
              <td colspan='8'><div align='left' class='times13blackbold'>Less:</div></t>

          </tr>


        ";
                       // $lessacct=mysql_query("SELECT * FROM acctgenledge where caseno='$caseno'");
                     // $lessacct=mysql_query("SELECT SUBSTRING_INDEX(type, ' ', 2) as status,SUBSTRING_INDEX(accttitle, ' ', 2) as acctitle,sum(amount) as amount,datearray,refno,ofr FROM collection where acctno='$caseno'  and accttitle like '%AR %' AND `type` <> 'pending'   group by SUBSTRING_INDEX(accttitle, ' ', 2)");
                    // $lessacct=mysql_query("SELECT SUBSTRING_INDEX(type, ' ', 2) as status,SUBSTRING_INDEX(accttitle, ' ', 2) as acctitle,sum(amount) as amount,datearray,refno,ofr FROM collection where acctno='$caseno'  and accttitle like '%AR %'   group by SUBSTRING_INDEX(accttitle, ' ', 2)");
                    $lessacct=mysql_query("SELECT type as status,accttitle as acctitle,sum(amount) as amount,datearray,refno,ofr FROM collection where acctno='$caseno'  and accttitle like '%AR %'   group by SUBSTRING_INDEX(accttitle, ' ', 2),type");

                    while($lessacctfetch=mysql_fetch_array($lessacct))
                        {
                             $acstatus=$lessacctfetch['status'];
                             $acctitle=$lessacctfetch['acctitle'];
                             if($acctitle=="AR TRADE" or $acctitle=="AR TRADE PF")
                               {
                                 $acctitle=str_replace(' PF','',$acctitle);

                                 if($acstatus=="cash-Visa")
                                 {

                                 $amount=$lessacctfetch['amount'];
                                 $date=$lessacctfetch['datearray'];

                                  echo "<tr>
                                        <td align='center' class='times10black' >
                                        <table border='0' width='100%'>
                                            <tr>
                                              <td width='30%'>&nbsp; </td>
                                              <td lign='left'><b>$acctitle - $lessacctfetch[ofr] - $date </b></td>
                                              <td width='30%'>&nbsp;  </td>
                                            </tr>
                                        </table>
                                        </td>
                                        <td align='right' class='times10black' colspan='7'>".number_format($amount,2)."</td>
                                        </tr>

                                        ";
                                }
                              }
                            else
                              {
                                $amount=$lessacctfetch['amount'];
                                $date=$lessacctfetch['datearray'];
                                $acctitle=str_replace(' PF','',$acctitle);

                                 echo "<tr>
                                       <td align='center' class='times10black' >
                                       <table border='0' width='100%'>
                                           <tr>
                                             <td width='30%'>&nbsp; </td>
                                             <td lign='left'><b>$acctitle - $lessacctfetch[ofr] - $date </b></td>
                                             <td width='30%'>&nbsp;  </td>
                                           </tr>
                                       </table>
                                       </td>
                                       <td align='right' class='times10black' colspan='7'>".number_format($amount,2)."</td>
                                       </tr>

                                       ";
                              }

                          }

                       // $lessacct=mysql_query("SELECT * FROM acctgenledge where caseno='$caseno'");
                        $lesscollect=mysql_query("SELECT * FROM collection where acctno='$caseno' and (accttitle='PATIENTS DEPOSIT' OR accttitle='PF DEPOSIT') and type !='pending' ");
                    while($lesscollectfech=mysql_fetch_array($lesscollect))
                            {
                                 $acctitle=$lesscollectfech['accttitle'];
                                 $amount=$lesscollectfech['amount'];
                                $ofr=$lesscollectfech['ofr'];
                                $date=$lesscollectfech['date'];



                                  echo "

                                        <tr>
                                        <td align='center' class='times10black' >
                                        <table border='0' width='100%'>
                                            <tr>
                                              <td width='30%'>&nbsp; </td>
                                              <td align='left'><b>$acctitle - $ofr - $date </b></td>
                                              <td width='30%'>&nbsp;  </td>
                                            </tr>
                                        </table>
                                        </td>
                                        <td align='right' class='times10black' colspan='7'>".number_format($amount,2)."</td>
                                        </tr>
                                        ";

                              }
   $lesscollect=mysql_query("SELECT accttitle,sum(amount) as amount,ofr,date FROM collection where acctno='$caseno' and (accttitle='CASHONHAND' or accttitle='PROFESSIONAL FEE') and type !='pending' group by ofr");
                    while($lesscollectfech=mysql_fetch_array($lesscollect))
                            {
                             $acctitle=$lesscollectfech['accttitle'];
                             $amount=$lesscollectfech['amount'];
        $ofr=$lesscollectfech['ofr'];
          $date=$lesscollectfech['date'];

                              echo "
          <tr>
                                    <td align='center' class='times10black' >
                                    <table border='0' width='100%'>
                                        <tr>
                                          <td width='30%'>&nbsp; </td>
                                          <td align='left'><b>CASHONHAND - $ofr - $date<b></td>
                                          <td width='30%'>&nbsp;  </td>
                                        </tr>
                                    </table>
                                    </td>
                                    <td align='right' class='times10black' colspan='7'>".number_format($amount,2)."</td>
                                    </tr>
                                    ";

                              }
                              $lesscollect=mysql_query("SELECT pd.accttitle,pd.amount,c.description,pd.datearray FROM collection c INNER JOIN pfdiscount pd ON pd.refno=c.refno where pd.caseno='$caseno'");
                                               while($lesscollectfech=mysql_fetch_array($lesscollect))
                                                       {
                                                        $acctitle=$lesscollectfech['accttitle'];
                                                        $amount=$lesscollectfech['amount'];
                                                        $description=$lesscollectfech['description'];
                                     $date=$lesscollectfech['datearray'];

                                                         echo "
                                     <tr>
                                                               <td align='center' class='times10black' >
                                                               <table border='0' width='100%'>
                                                                   <tr>
                                                                     <td width='30%'>&nbsp; </td>
                                                                     <td align='left'><b>$acctitle - $description - $date<b></td>
                                                                     <td width='30%'>&nbsp;  </td>
                                                                   </tr>
                                                               </table>
                                                               </td>
                                                               <td align='right' class='times10black' colspan='7'>".number_format($amount,2)."</td>
                                                               </tr>
                                                               ";

                                                         }


//start-- sum of the total Less (AR and Patient's Deposit)
          $total_AR=0;
          $AR_query=mysql_query("SELECT * FROM acctgenledge where caseno='$caseno' and (acctitle like '%AR %')");
                    while($AR_fetch=mysql_fetch_array($AR_query))
                            {
                              $acct=$AR_fetch['acctitle'];
                              $statu=$AR_fetch['status'];
                              if($acct=="AR TRADE" or $acct=="AR TRADE PF"){
                              if($statu=="PAID"){
                             $acctitle=$AR_fetch['acctitle'];
                             $amount=$AR_fetch['amount'];


                             $total_AR +=$amount;
                             }
                             }
                             else{
                             $acctitle=$AR_fetch['acctitle'];
                             $amount=$AR_fetch['amount'];

                             $total_AR +=$amount;
                             }

                              }

          $total_PD=0;
          $PD_query=mysql_query("SELECT * FROM collection where acctno='$caseno' and (accttitle='PATIENTS DEPOSIT' or accttitle='PF DEPOSIT' or accttitle='CASHONHAND' or accttitle='PROFESSIONAL FEE') and type !='pending' ");
                    while($PD_fetch=mysql_fetch_array($PD_query))
                            {
                             $acctitle=$PD_fetch['accttitle'];
                             $amount=$PD_fetch['amount'];


                             $total_PD +=$amount;


                              }

        $total_less= $total_AR + $total_PD;

        $total_disc=0;
        $PD_query=mysql_query("SELECT amount,accttitle FROM pfdiscount where caseno='$caseno'");
                  while($PD_fetch=mysql_fetch_array($PD_query))
                          {
                           $acctitle=$PD_fetch['accttitle'];
                           $amount=$PD_fetch['amount'];


                           $total_disc +=$amount;


                            }

      $total_less= $total_less + $total_disc;
          echo "<tr>
                                    <td align='left' class='times13blackbold' colspan='7'>Subtotal Less</td>
                                    <td align='right' class='times13blackbold' >".number_format($total_less,2)."</td>
                                    </tr>
                                    ";
//end-- sum of the total Less (AR and Patient's Deposit)
            $net=$overtotdisp-$total_less;
          echo "<tr>
                                    <td align='left' class='times13blackbold' colspan='7'>Net</td>
                                    <td align='right' class='times13blackbold' >".number_format($net,2)."</td>
                                    </tr>
                                    ";

  echo"
      </table></td>
    </tr>
    <tr>
      <td height='30'></td>
    </tr>
";

$setusql=mysql_query("SELECT * FROM setuser WHERE caseno='$caseno'");
$setucount=mysql_num_rows($setusql);
if($setucount==0){
$setuser=$uname;
}
else{
while($setufetch=mysql_fetch_array($setusql)){$setuname=$setufetch['name'];}
if($setuname==""){
$setuser=$uname;
}
else{
$setuser=$setuname;
}
}

echo "
    <tr>
      <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td width='2%'>&nbsp;</td>
          <td width='30%'><div align='left' class='times12blackbold'>Prepared by:</div></td>
          <td width='15%'>&nbsp;</td>
          <td width='50%'><div align='left' class='times12blackbold'>Conforme:</div></td>
          <td width='3%'>&nbsp;</td>
        </tr>
        <tr>
          <td height='40' colspan='5'></td>
        </tr>
        <tr>
          <td></td>
          <td valign='top'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td class='table1Bottom'><a href='EditUser.php?caseno=$caseno&setuser=$setuser' target='_blank' class='astyle'><div align='center' class='times13blackbold'>".strtoupper($setuser)."</div></a></td>
            </tr>
            <tr>
              <td><a href='EditUser.php?caseno=$caseno&setuser=$setuser' target='_blank' class='astyle'><div align='left' class='times11blackbold'>Billing Clerk/Accountant</div></a></td>
            </tr>
            <tr>
              <td><div align='left' class='times11blackbold'>(Signature over printed name)</div></td>
            </tr>
          </table></td>
          <td></td>
";

//claiminfomoreinfo
mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());
$cimisql=mysql_query("SELECT * FROM claiminfomoreinfo WHERE caseno='$caseno'");
$cimicount=mysql_num_rows($cimisql);
if($cimicount==0){
$membersuffix="";
$memberbday="";
$membergender="";
$rtm="";
$comchoose="M";
$comname="";
$comcontact="";
$comdatesigned="";
$comrelation="";
$comrelationos="";
$comreason="";
$comreasonos="";
$comuw="";
$emppen="";
$empbusinessname="";
$empname="";
$empcontactno="";
$empsigdesignation="";
$empdatesigned="";
$carchoose="";
$carname="";
$cardatesigned="";
$carrelation="";
$carrelationos="";
$carreason="";
$carreasonos="";
$caruw="";
$hcirep="";
$hcidesignation="";
$hcidatesigned="";
}
else{
while($cimifetch=mysql_fetch_array($cimisql)){
$membersuffix=$cimifetch['membersuffix'];
$memberbday=$cimifetch['memberbday'];
$membergender=$cimifetch['membergender'];
$rtm=$cimifetch['rtm'];
$comchoose=$cimifetch['comchoose'];
$comname=strtoupper($cimifetch['comname']);
$comcontact=strtoupper($cimifetch['comcontact']);
//$comdatesigned=$cimifetch['comdatesigned'];

$comdatesigned = date("M-d-Y");
$comrelation=$cimifetch['comrelation'];
$comrelationos=strtoupper($cimifetch['comrelationos']);
$comreason=$cimifetch['comreason'];
$comreasonos=strtoupper($cimifetch['comreasonos']);
$comuw=$cimifetch['comuw'];
$emppen=$cimifetch['emppen'];
$empbusinessname=strtoupper($cimifetch['empbusinessname']);
$empname=strtoupper($cimifetch['empname']);
$empcontactno=$cimifetch['empcontactno'];
$empsigdesignation=strtoupper($cimifetch['empsigdesignation']);
$empdatesigned=$cimifetch['empdatesigned'];
$carchoose=$cimifetch['carchoose'];
$carname=strtoupper($cimifetch['carname']);
$cardatesigned=$cimifetch['cardatesigned'];
$carrelation=$cimifetch['carrelation'];
$carrelationos=strtoupper($cimifetch['carrelationos']);
$carreason=$cimifetch['carreason'];
$carreasonos=strtoupper($cimifetch['carreasonos']);
$caruw=$cimifetch['caruw'];
$hcirep=$cimifetch['hcirep'];
$hcidesignation=$cimifetch['hcidesignation'];
$hcidatesigned=$cimifetch['hcidatesigned'];
}
}

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());
$cfsql=mysql_query("SELECT lastname, firstname, middlename FROM claiminfo WHERE patientidno='$patientidno' AND caseno='$caseno'");
$cfcount=mysql_num_rows($cfsql);

if($cfcount==0){
$mlname="";
$mfname="";
$mmname="";
}
else{
while($cffetch=mysql_fetch_array($cfsql)){
$mlname=strtoupper($cffetch['lastname']);
$mfname=strtoupper($cffetch['firstname']);
$mmname=strtoupper($cffetch['middlename']);
}
}

if($comchoose=="M"){$signame=$mlname.", ".$mfname." ".$mmname." ".$membersuffix;}else{$signame=$comname;}

if($comrelation=="Others"){$comrel=$comrelationos;}else{$comrel=$comrelation;}

echo "
          <td valign='top'><table width='220' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td class='table1Bottom'><div align='center' class='times11blackbold'>$signame</div></td>
            </tr>
            <tr>
              <td><a href='../../eClaims/CSF-Data-AddEdit.php?caseno=$caseno&patientidno=$patientidno&choosea=0&chooseb=0' target='_blank' class='astyle'><div align='left' class='times11blackbold'>Member/Patient/Authorized representative</div></a></td>
            </tr>
            <tr>
              <td><div align='left' class='times11blackbold'>(Signature over printed name)</div></td>
            </tr>
          </table></td>
          <td></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='70'><div align='left' class='times11blackbold'>Date signed:&nbsp;</div></td>
              <td width='auto' class='table1Bottom'><div align='left' class='times11black'>$comdatesigned</div></td>
            </tr>
          </table></td>
          <td>&nbsp;</td>
          <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='265'><div align='left' class='times11blackbold'>Relationship to member of authorized representative:&nbsp;</div></td>
              <td width='auto' class='table1Bottom'><div align='left' class='times11black'>&nbsp;$comrel</div></td>
            </tr>
          </table></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='70'><div align='left' class='times11blackbold'>Contact no.:&nbsp;</div></td>
              <td width='auto' class='table1Bottom'><div align='left' class='times11black'>$telno&nbsp;</div></td>
            </tr>
          </table></td>
          <td>&nbsp;</td>
          <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='70'><div align='left' class='times11blackbold'>Date signed:&nbsp;</div></td>
              <td width='70' class='table1Bottom'><div align='left' class='times11black'>&nbsp;$comdatesigned</div></td>
              <td width='70'><div align='left' class='times11blackbold'>&nbsp;Contact no.:&nbsp;</div></td>
              <td width='auto' class='table1Bottom'><div align='left' class='times11black'>$comcontact&nbsp;</div></td>
            </tr>
          </table></td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height='20' class='table1Bottom'></td>
    </tr>
    <tr>
      <td height='15'></td>
    </tr>
    <!-- tr>
      <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td width='2%'></td>
          <td width='auto'><div align='left' class='times12blackbold'>NOTE:<br />1. Fill out the form legibly.<br />2. The member/patient/authorized representative should not sign a blank SOA.<br />3. Printed copy of SOA or its equivalent should be free of charge.</div></td>
       <td width='55%'><div align='left'><!--img src='Image/signature-wala.png' width='300' height='120' /--></div></td>
	</tr>
      </table></td>
    </tr -->
  </table>
</div>
";

$pensql=mysql_query("SELECT sellingprice, quantity, adjustment, gross, hmo, phic, phic1, excess FROM productout WHERE caseno='$caseno' AND quantity > 0 AND trantype='charge' AND (productsubtype='PHARMACY/MEDICINE' OR productsubtype='PHARMACY/SUPPLIES') AND administration LIKE 'pending'");
$pencount=mysql_num_rows($pensql);

if($pencount!=0){
echo "
<br />
<div align='center' style='font-family: Arial;font-size: 18px;color: #FF0000;font-weight: bold;'>WARNING!!! PATIENT STILL HAS PENDING MEDICINES OR SUPPLIES. $pencount</div>
";
}

fclose($resall);
exec("chmod 777 Logs/$caseno.txt");
?>
</body>
</html>
