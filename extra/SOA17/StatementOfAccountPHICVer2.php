<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("../Settings.php"); $cuz = new database(); mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass()); mysql_select_db($cuz->getDB()); $snamesql=mysql_query("SELECT heading, address, telno FROM heading"); while($snamefetch=mysql_fetch_array($snamesql)){ $sname=$snamefetch['heading']; $address=$snamefetch['address']; $telno=$snamefetch['telno']; } echo "$sname"; ?></title>
<link href="CSS/styleblank.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="Favicon/logo.png" type="image/png" />
</head>

<body>
<?php
mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$patientidno=$_GET['patientidno'];
$caseno=$_GET['caseno'];
$uname=$_GET['uname'];

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


$today = date("Y-m-d",strtotime($birthdate));
$diff = date_diff(date_create($dateOfBirth), date_create($today));
$agerel=$diff->format('%y');


mysql_query('SET NAMES utf8');
$admsql=mysql_query("SELECT membership, paymentmode, room, UPPER(street) AS street, UPPER(barangay) AS barangay, UPPER(municipality) AS municipality, UPPER(province) AS province,UPPER(pastmed) AS pastmed, UPPER(initialdiagnosis) AS initialdiagnosis, UPPER(finaldiagnosis) AS finaldiagnosis, UPPER(ap) AS ap, timeadmitted, dateadmit, contactno, employerno FROM admission WHERE caseno='$caseno'");
while($admfetch=mysql_fetch_array($admsql)){
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
}

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
  mysql_query("INSERT INTO `soadetails`(`caseno`, `d1`, `d2`, `d3`, `c1`, `c2`) VALUES ('$caseno', '', '', '', '$fcidesc', '')");
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

//---------------------------------------------------------------------------------------------------------------------------------------------------
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
//---------------------------------------------------------------------------------------------------------------------------------------------------


echo "
<div align='center'>
  <table width='100%' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td width='3%'></td>
          <td width='110' rowspan='3'><div align='center'><img src='Image/logoblank.jpg' width='auto' height='100' /></div></td>
          <td width='auto' height='50' valign='middle'><div align='center' class='times16blackbold'>STATEMENT OF ACCOUNT</div></td>
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
              <td width='68'><div align='left' class='times10blackbold'>Patient name:&nbsp;</div></td>
              <td width='auto' class='table1Bottom'><div align='left' class='times11blackbold'>&nbsp;$lastname, $firstname $middlename $suffix&nbsp;</div></td>
              <td width='20'><div align='left' class='times12blackbold'>&nbsp;Age:&nbsp;</div></td>
              <td width='20' class='table1Bottom'><div align='left' class='times10black'>&nbsp;$agerel&nbsp;</div></td>
            </tr>
          </table></td>
          <td width='42%'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='50'></td>
              <td width='112'><div align='left' class='times10blackbold'>Date & Time Admitted:&nbsp;</div></td>
              <td width='auto' class='table1Bottom'><div align='left' class='times9black'>&nbsp;".date("M d, Y",strtotime($dateadmit))." ".$timeadmittedrel."&nbsp;</div></td>
            </tr>
          </table></td>
          <td width='4%'></td>
        </tr>
        <tr>
          <td></td>
          <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='48'><div align='left' class='times10blackbold'>Address:&nbsp;</div></td>
              <td width='auto' class='table1Bottom'><div align='left' class='times10black'>&nbsp;$street $barangay $municipality $province&nbsp;</div></td>
            </tr>
          </table></td>
          <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='50'></td>
              <td width='120'><div align='left' class='times10blackbold'>Date & Time Discharged:&nbsp;</div></td>
              <td width='auto' class='table1Bottom'><a href='TempDateDis.php?caseno=$caseno' target='_blank' class='astyle'><div align='left' class='times9black2'>
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

echo "
                &nbsp;".date("M d, Y",strtotime($tdsdate))." $tdstime&nbsp;
";
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
                  <td width='80'><div align='left' class='times10blackbold'>Final Diagnosis:&nbsp;</div></td>
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
                          <td width='auto' class='table1Bottom'><div align='left' class='times10black2'>&nbsp;$d1&nbsp;</div></td>
                        </tr>
                        <tr>
                          <td width='10' height='20'><div align='left' class='times10blackbold'>2.</div></td>
                          <td width='auto' class='table1Bottom'><div align='left' class='times10black2'>&nbsp;$d2&nbsp;</div></td>
                        </tr>
                        <tr>
                          <td width='10' height='20'><div align='left' class='times10blackbold'>3.</div></td>
                          <td width='auto' class='table1Bottom'><div align='left' class='times10black2'>&nbsp;$d3&nbsp;</div></td>
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
                        <td width='auto'><div align='left' class='times8black'>$c2disp&nbsp;</div></td>
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
    <tr>
      <td height='10'></td>
    </tr>
    <tr>
      <td><table width='100%' border='1' bordercolor='#FFFFFF' cellpadding='0' cellspacing='0'>
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
              <td><div align='left'><span class='times10blackbold'><u>".$doh."</u>DOH</span><span class='times8black2'>(MAP)</span></div></td>
            </tr>
            <tr>
              <td></td>
              <td><div align='left' class='times10blackbold'><u>".$hmo."</u>HMO</div></td>
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
          <td><div align='center' class='times12blackbold'>HCI fees</div></td>
          <td colspan='7'><div align='center' class='times12blackbold'>&nbsp;</div></td>
        </tr>
";

$poutsql=mysql_query("SELECT productsubtype FROM productout WHERE caseno='$caseno' AND quantity > 0 AND productsubtype NOT LIKE 'PROFESSIONAL FEE' AND productsubtype NOT LIKE 'ADMITTING FEE' AND productsubtype NOT LIKE 'MISCELLANEOUS CR' AND productsubtype NOT LIKE 'NURSING CHARGES' AND productsubtype NOT LIKE 'NURSING_CHARGES' AND productsubtype NOT LIKE 'NURSING SERVICE FEE' AND productsubtype NOT LIKE 'MEDICAL SURGICAL SUPPLIES' AND trantype='charge' GROUP BY productsubtype ORDER BY productsubtype");
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
while($poutfetch=mysql_fetch_array($poutsql)){
$pstype=$poutfetch['productsubtype'];

if(($pstype=='MEDICAL SUPPLIES')||($pstype=='PHARMACY/MEDICINE')||($pstype=='SALES-SUPPLIES')||($pstype=='PHARMACY/SUPPLIES')){
$poutdsql=mysql_query("SELECT sellingprice, quantity, adjustment, gross, hmo, phic, phic1, excess FROM productout WHERE caseno='$caseno' AND quantity > 0 AND trantype='charge' AND productsubtype='$pstype' AND administration NOT LIKE 'pending'");
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

$totactual+=$actual;
$adjsubtot+=$poutdadjtot;
$grosssubtot+=$poutdgrosstot;
$hmotot+=$hmo;
$phictot+=$phic;
$phic1tot+=$phic1;
$excesstot+=$excess;

echo "
        <tr>
          <td><a href='../../2020codes/TestCodes/testviewdetails.php?caseno=$caseno&type=$pstype' target='_blank' class='astyle'><div align='left' class='times10blackbold'>&nbsp;".$pstype."</div></a></td>
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
else if($pstype=='ECG'){
$poutdsql=mysql_query("SELECT sellingprice, quantity, adjustment, gross, hmo, phic, phic1, excess FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype='ECG'");


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


$labtotactual+=$actual;
$labadjsubtot+=$poutdadjtot;
$labgrosssubtot+=$poutdgrosstot;
$labhmotot+=$hmo;
$labphictot+=$phic;
$labphic1tot+=$phic1;
$labexcesstot+=$excess;

$totactual+=$actual;
$adjsubtot+=$poutdadjtot;
$grosssubtot+=$poutdgrosstot;
$hmotot+=$hmo;
$phictot+=$phic;
$phic1tot+=$phic1;
$excesstot+=$excess;

}
}
else if($pstype=='LABORATORY'){
$poutdsql=mysql_query("SELECT sellingprice, quantity, adjustment, gross, hmo, phic, phic1, excess FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype='LABORATORY'");


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


$totactual+=$actual;
$adjsubtot+=$poutdadjtot;
$grosssubtot+=$poutdgrosstot;
$hmotot+=$hmo;
$phictot+=$phic;
$phic1tot+=$phic1;
$excesstot+=$excess;

echo "
        <tr>
          <td><a href='../../2020codes/TestCodes/testviewdetails.php?caseno=$caseno&type=$pstype' target='_blank' class='astyle'><div align='left' class='times10blackbold'>&nbsp;LABORATORY</div></a></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format($actual+$labtotactual,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format($poutdadjtot+$labadjsubtot,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format($hmo+$labhmotot,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format($phic+$labphictot,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format($phic1+$labphic1tot,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format($excess+$labexcesstot,2,'.',',')."&nbsp;</div></td>
        </tr>
";
}
}
else{
$poutdsql=mysql_query("SELECT sellingprice, quantity, adjustment, gross, hmo, phic, phic1, excess FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype='$pstype'");


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


$totactual+=$actual;
$adjsubtot+=$poutdadjtot;
$grosssubtot+=$poutdgrosstot;
$hmotot+=$hmo;
$phictot+=$phic;
$phic1tot+=$phic1;
$excesstot+=$excess;

echo "
        <tr>
          <td><a href='../../2020codes/TestCodes/testviewdetails.php?caseno=$caseno&type=$pstype' target='_blank' class='astyle'><div align='left' class='times10blackbold'>&nbsp;".$pstype."</div></a></td>
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

}


$poutasddadjtotf=0;
$poutasddgrosstotf=0;
$actualf=0;
$hmof=0;
$phicf=0;
$phic1f=0;
$excessf=0;
$poutasdsql=mysql_query("SELECT productsubtype FROM productout WHERE caseno='$caseno' AND (productsubtype LIKE 'ADMITTING FEE' OR productsubtype LIKE 'MISCELLANEOUS CR' OR productsubtype LIKE 'NURSING CHARGES' OR productsubtype LIKE 'NURSING SERVICE FEE' OR productsubtype LIKE 'NURSING_CHARGES' OR productsubtype LIKE 'MEDICAL SURGICAL SUPPLIES') GROUP BY productsubtype ORDER BY productsubtype");
while($poutasdfetch=mysql_fetch_array($poutasdsql)){
$pstype=$poutasdfetch['productsubtype'];


$poutasddsql=mysql_query("SELECT sellingprice, quantity, adjustment, gross, hmo, phic, phic1, excess FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype='$pstype'");


$poutasddcount=mysql_num_rows($poutasddsql);
if($poutasddcount==0){
$poutasddadjtot=0;
$poutasddgrosstot=0;
$actual=0;
$hmo=0;
$phic=0;
$phic1=0;
$excess=0;
}
else{
$poutasddadjtot=0;
$poutasddgrosstot=0;
$actual=0;
$hmo=0;
$phic=0;
$phic1=0;
$excess=0;
while($poutasddfetch=mysql_fetch_array($poutasddsql)){$poutasddadjtot+=$poutasddfetch['adjustment'];$poutasddgrosstot+=$poutasddfetch['gross'];$actual+=($poutasddfetch['sellingprice']*$poutasddfetch['quantity']);$hmo+=$poutasddfetch['hmo'];$phic+=$poutasddfetch['phic'];$phic1+=$poutasddfetch['phic1'];$excess+=$poutasddfetch['excess'];}


}

$poutasddadjtotf+=$poutasddadjtot;
$poutasddgrosstotf+=$poutasddgrosstot;
$actualf+=$actual;
$hmof+=$hmo;
$phicf+=$phic;
$phic1f+=$phic1;
$excessf+=$excess;

}


$totactual+=($actualf);
$adjsubtot+=($poutasddadjtotf);
$grosssubtot+=($poutasddgrosstotf);
$hmotot+=($hmof);
$phictot+=($phicf);
$phic1tot+=($phic1f);
$excesstot+=($excessf);


if(($actualf+$pfadactual)!=0){
echo "
        <tr>
          <td><a href='../../2020codes/TestCodes/testviewdetails.php?caseno=$caseno&type=MEDICAL SURGICAL SUPPLIES' target='_blank' class='astyle'><div align='left' class='times10blackbold'>&nbsp;MEDICAL SURGICAL SUPPLIES</div></a></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(($actualf),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(($poutasddadjtotf),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(($hmof),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(($phicf),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(($phic1f),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(($excessf),2,'.',',')."&nbsp;</div></td>
        </tr>
";
}

$agamount=0;

if($agamount>0){
echo "
        <tr>
          <td><div align='left' class='times10blackbold'>&nbsp;HOSPITAL DISCOUNT</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format($agamount,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;&nbsp;</div></td>
        </tr>
";
}

$hdamt=0;
$hdsql=mysql_query("SELECT amount FROM collection WHERE acctno='$caseno' AND description='001-HOSPITALBILL' AND accttitle='PATIENTS DEPOSIT'");
while($hdfetch=mysql_fetch_array($hdsql)){
$hdamount=$hdfetch['amount'];
$hdamt+=$hdamount;
}

if($hdamt>0){
echo "
        <tr>
          <td><div align='left' class='times10blackbold'>&nbsp;DEPOSIT/PARTIAL PAYMENT</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format($hdamt,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;0.00&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;0.00&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;0.00&nbsp;</div></td>
        </tr>
";
}


$htot=((($totactual-$adjsubtot-($agamount+$hmotot+$hdamt))-$fchshare)-$sechshare);
if($htot<0){$htotdisp=0;}else{$htotdisp=$htot;}

echo "
        <tr>
          <td height='16'><div align='left' class='times13blackbold'>&nbsp;Subtotal</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format($totactual,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format($adjsubtot,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format(($hmotot+$agamount+$hdamt),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format($phictot,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format($phic1tot,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format($htotdisp,2,'.',',')."&nbsp;</div></td>
        </tr>
";

echo "
        <tr>
          <td><div align='center' class='times12blackbold'>Professional fee/s</div></td>
          <td colspan='7'><div align='center' class='times12blackbold'>&nbsp;</div></td>
        </tr>
";

//---------------------------------------------------------------------------------------------------------------------
$pfadactual=0;
$pfadadj=0;
$pfadgross=0;
$pfadhmo=0;
$pfadphic=0;
$pfadphic1=0;
$pfadexcess=0;
$pfadsql=mysql_query("SELECT productcode, sellingprice, quantity, adjustment, gross, hmo, phic, phic1, excess FROM productout WHERE caseno='$caseno' AND trantype='charge' AND (producttype LIKE 'IPD admitting' OR producttype LIKE 'ADMITTING' OR producttype LIKE 'IPD discharge') AND productsubtype='PROFESSIONAL FEE'");
while($pfadfetch=mysql_fetch_array($pfadsql)){
$pfadactual+=($pfadfetch['sellingprice']*$pfadfetch['quantity']);
$pfadadj+=$pfadfetch['adjustment'];
$pfadgross+=$pfadfetch['gross'];
$pfadhmo+=$pfadfetch['hmo'];
$pfadphic+=$pfadfetch['phic'];
$pfadphic1+=$pfadfetch['phic1'];
$pfadexcess+=$pfadfetch['excess'];
}
//---------------------------------------------------------------------------------------------------------------------

$b=0;
$pftotactual=0;
$pfadjsubtot=0;
$pfgrosssubtot=0;
$pfhmotot=0;

$totopfactual=0;
$totopfadj=0;
$totopfhmo=0;
$totopfphic=0;
$totopfphic1=0;
$totopfexcess=0;

if($membership=="Nonmed-none"){
$pfpoutsql=mysql_query("SELECT productdesc, sellingprice, quantity, adjustment, gross, phic, hmo, producttype, phic, phic1, excess FROM productout WHERE caseno='$caseno' AND trantype='charge' AND (producttype NOT LIKE 'IPD admitting' or producttype NOT LIKE 'IPD discharge') AND productsubtype='PROFESSIONAL FEE' ORDER BY gross DESC");
}
else if($membership=="phic-med"){
$pfpoutsql=mysql_query("SELECT productdesc, sellingprice, quantity, adjustment, gross, phic, hmo, producttype, phic, phic1, excess FROM productout WHERE caseno='$caseno' AND trantype='charge' AND (producttype LIKE 'ATTENDING' OR producttype LIKE 'IPD attending' OR producttype LIKE 'IPD surgeon' OR producttype LIKE 'IPD anesthesiologist') AND productsubtype='PROFESSIONAL FEE' GROUP BY productdesc ORDER BY gross DESC");
}
else{
$pfpoutsql=mysql_query("SELECT productdesc, sellingprice, quantity, adjustment, gross, phic, hmo, producttype, phic, phic1, excess FROM productout WHERE caseno='$caseno' AND trantype='charge' AND (producttype NOT LIKE 'IPD admitting' OR producttype NOT LIKE 'IPD discharge') AND productsubtype='PROFESSIONAL FEE' ORDER BY gross DESC");
}

while($pfpoutfetch=mysql_fetch_array($pfpoutsql)){
$producttype=$pfpoutfetch['producttype'];
$doctor=$pfpoutfetch['productdesc'];
$b++;

$fifsasql=mysql_query("SELECT * FROM productout WHERE caseno='$caseno' AND trantype='charge' AND (producttype LIKE 'IPD surgeon' OR producttype LIKE 'IPD anesthesiologist') AND productsubtype='PROFESSIONAL FEE'");
$fifsacount=mysql_num_rows($fifsasql);

/*if($fifsacount==0){
$pfactual=0;
$pfadj=0;
$pfhmo=0;
$pfshowsql=mysql_query("SELECT sellingprice, quantity, adjustment, gross, phic, hmo, producttype FROM productout WHERE caseno='$caseno' AND trantype='charge' AND producttype NOT LIKE 'IPD admitting' AND producttype NOT LIKE 'IPD discharge' AND productsubtype='PROFESSIONAL FEE'");
while($pfshowfetch=mysql_fetch_array($pfshowsql)){
$pfactual+=$pfshowfetch['sellingprice']*$pfshowfetch['quantity'];
$pfadj+=$pfshowfetch['adjustment'];
$pfhmo+=$pfshowfetch['hmo'];
//$pfphic+=$pfshowfetch['phic'];
}

$pftotactual+=$pfactual;
$pfadjsubtot+=$pfadj;
$pfhmotot+=$pfhmo;
}
else{*/
$pfactual=0;
$pfadj=0;
$pfhmo=0;
$pfphic=0;
$pfphic1=0;
$pfexcess=0;
$pfshowsql=mysql_query("SELECT sellingprice, quantity, adjustment, gross, phic, hmo, producttype, phic, phic1, excess FROM productout WHERE caseno='$caseno' AND productdesc='$doctor'");
while($pfshowfetch=mysql_fetch_array($pfshowsql)){
$pfactual+=$pfshowfetch['sellingprice']*$pfshowfetch['quantity'];
$pfadj+=$pfshowfetch['adjustment'];
$pfhmo+=$pfshowfetch['hmo'];
$pfphic+=$pfshowfetch['phic'];
$pfphic1+=$pfshowfetch['phic1'];
$pfexcess+=$pfshowfetch['excess'];

$pftotactual+=$pfactual;
$pfadjsubtot+=$pfadj;
$pfhmotot+=$pfhmo;
$pfphictot+=$pfphic;
$pfphic1tot+=$pfphic1;
$pfexcesstot+=$pfexcess;
}


$asdsql=mysql_query("SELECT sellingprice, quantity, adjustment, gross, phic, hmo, producttype, phic, phic1, excess FROM productout WHERE caseno='$caseno' AND productdesc NOT LIKE '$doctor' AND trantype='charge' AND producttype NOT LIKE 'IPD surgeon' AND producttype NOT LIKE 'IPD anesthesiologist' AND producttype NOT LIKE 'IPD attending' AND producttype NOT LIKE 'IPD admitting' AND producttype NOT LIKE 'IPD discharge' AND productsubtype='PROFESSIONAL FEE'");
$asdcount=mysql_num_rows($asdsql);

$pfactual2=0;
$pfadj2=0;
$pfhmo2=0;
$pfphic2=0;
$pfphic12=0;
$pfexcess2=0;
if(($asdcount!=0)&&($membership=="phic-med")&&($producttype=="IPD attending")&&($fifsacount!=0)){
$opfsql=mysql_query("SELECT productdesc FROM productout WHERE caseno='$caseno' AND trantype='charge' AND (producttype LIKE 'IPD surgeon' OR producttype LIKE 'IPD anesthesiologist') AND productsubtype='PROFESSIONAL FEE'");
while($opffetch=mysql_fetch_array($opfsql)){
$opfname=$opffetch['productdesc'];

$qwesql=mysql_query("SELECT SUM(sellingprice) AS sp, SUM(adjustment) AS adj, SUM(hmo) AS hmo, SUM(phic) AS phic, SUM(phic1) AS phic1, SUM(excess) AS excess FROM productout WHERE caseno='$caseno' AND productdesc LIKE '$opfname' AND producttype NOT LIKE 'IPD surgeon' AND producttype NOT LIKE 'IPD anesthesiologist' AND productsubtype='PROFESSIONAL FEE'");
$qwecount=mysql_num_rows($qwesql);
if($qwecount==0){
$opfsp=0;
$opfadj=0;
$opfhmo=0;
$opfphic=0;
$opfphic1=0;
$opfexcess=0;
}
else{
while($qwefetch=mysql_fetch_array($qwesql)){$opfsp=$qwefetch['sp'];$opfadj=$qwefetch['adj'];$opfhmo=$qwefetch['hmo'];$opfphic=$qwefetch['phic'];$opfphic1=$qwefetch['phic1'];$opfexcess=$qwefetch['excess'];}
}


$totopfactual+=$opfsp;
$totopfadj+=$opfadj;
$totopfhmo+=$opfhmo;
$totopfphic+=$opfphic;
$totopfphic1+=$opfphic1;
$totopfexcess+=$opfexcess;
}


while($asdfetch=mysql_fetch_array($asdsql)){
$pfactual2+=$asdfetch['sellingprice']*$asdfetch['quantity'];
$pfadj2+=$asdfetch['adjustment'];
$pfhmo2+=$asdfetch['hmo'];
$pfphic2+=$asdfetch['phic'];
$pfphic12+=$asdfetch['phic1'];
$pfexcess2+=$asdfetch['excess'];
}

$pftotactual+=$pfactual2;
$pfadjsubtot+=$pfadj2;
$pfhmotot+=$pfhmo2;
$pfphictot+=$pfphic2;
$pfphic1tot+=$pfphic12;
$pfexcesstot+=$pfexcess2;
}
else{
$totopfactual=0;
$totopfadj=0;
$totopfhmo=0;
$totopfphic=0;
$totopfphic1=0;
$totopfexcess=0;
}

$pfactualrel=$pfactual+$pfactual2-$totopfactual;
$pfadjrel=$pfadj+$pfadj2-$totopfadj;
$pfhmorel=$pfhmo+$pfhmo2-$totopfhmo;
$pfphicrel=$pfphic+$pfphic2-$totopfphic;
$pfphic1rel=$pfphic1+$pfphic12-$totopfphic1;
$pfexcessrel=$pfexcess+$pfexcess2-$totopfexcess;

$pftotactual+=(-$totopfactual);
$pfadjsubtot+=(-$totopfadj);
$pfhmotot+=(-$totopfhmo);
$pfphictot+=(-$totopfphic);
$pfphic1tot+=(-$totopfphic1);
$pfexcesstot+=(-$totopfexcess);


if(($senior=="N")&&($pfadjrel!=0)){
$pfadjrelnew=0;
$pfhmorelnew=$pfhmorel+$pfadjrel;
$pfhmotot+=$pfadjsubtot;
$pfadjsubtot=0;
}
else{
$pfadjrelnew=$pfadjrel;
$pfhmorelnew=$pfhmorel;
}


if($b==1){$actualplus=$pfadactual;$adjplus=$pfadadj;$grossplus=$pfadgross;$hmoplus=$pfadhmo;$phicplus=$pfadphic;$phicp1lus=$pfadphic1;$excessplus=$pfadexcess;}
else{$actualplus=0;$adjplus=0;$grossplus=0;$hmoplus=0;$phicplus=0;$phicp1lus=0;$excessplus=0;}


echo "
        <tr>
          <td><a href='../../2020codes/TestCodes/testviewdetails.php?caseno=$caseno&type=PROFESSIONAL FEE' target='_blank' class='astyle'><div align='left' class='times10blackbold'>&nbsp;$b.&nbsp;".strtoupper($doctor)."</div></a></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(($pfactualrel+$actualplus),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(($pfadjrelnew+$adjplus),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(($pfhmorelnew+$hmoplus),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(($pfphicrel+$phicplus),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(($pfphic1rel+$phic1plus),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(($pfexcessrel+$excessplus),2,'.',',')."&nbsp;</div></td>
        </tr>
";

}


$pftot=(((($pftotactual+$pfadactual)-$pfadjsubtot-$pfadadj-$pfhmotot)-$fcpshare)-$secpshare);
if($pftot<0){$pftotdisp=$pftot;}else{$pftotdisp=$pftot;}


$overap1=(($totactual-$adjsubtot-($agamount+$hmotot+$hdamt))-$fchshare)-$sechshare;
if($overap1<0){$op1=$overap1;}else{$op1=$overap1;}
$overap2=((($pftotactual+$pfadactual)-$pfadjsubtot-$pfadadj-$pfhmotot)-$fcpshare)-$secpshare;
if($overap2<0){$op2=$overap2;}else{$op2=$overap2;}

$overtot=($op1+$op2);
if($overtot<0){$overtotdisp=0;}else{$overtotdisp=$overtot;}

echo "
        <tr>
          <td height='16'><div align='left' class='times13blackbold'>&nbsp;Subtotal</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format((($pftotactual-$totopfactual)+$pfadactual),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format((($pfadjsubtot-$totopfadj)+$pfadadj),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format((($pfhmotot-$totopfhmo)+$pfadhmo),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format(($pfphictot+$pfadphic),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format(($pfphic1tot+$pfadphic1),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format($pftotdisp,2,'.',',')."&nbsp;</div></td>
        </tr>
        <tr>
          <td height='24'><div align='left' class='times13blackbold'>&nbsp;Total</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format(($totactual+$pftotactual+$pfadactual),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format(($pfadjsubtot+$adjsubtot+$pfadadj),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format(($hmotot+$pfhmotot+$agamount+$hdamt),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format((($pfphictot+$pfadphic)+$phictot),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format((($pfphic1tot+$pfadphic1)+$phic1tot),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format($overtotdisp,2,'.',',')."&nbsp;</div></td>
        </tr>
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
$comdatesigned=$cimifetch['comdatesigned'];
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
    <tr>
      <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td width='2%'></td>
          <td width='auto'><div align='left' class='times12blackbold'>NOTE:<br />1. Fill out the form legibly.<br />2. The member/patient/authorized representative should not sign a blank SOA.<br />3. Printed copy of SOA or its equivalent should be free of charge.</div></td>
       <td width='55%'><div align='left'><!--img src='Image/signature-wala.png' width='300' height='120' /--></div></td>
	</tr>
      </table></td>
    </tr>
  </table>
</div>
";

?> 
</body>
</html>
