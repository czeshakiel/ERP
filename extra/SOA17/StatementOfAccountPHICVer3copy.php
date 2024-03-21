<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("../Settings.php"); $cuz = new database(); mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass()); mysql_select_db($cuz->getDB()); $snamesql=mysql_query("SELECT heading, address, telno FROM heading"); while($snamefetch=mysql_fetch_array($snamesql)){ $sname=$snamefetch['heading']; $address=$snamefetch['address']; $telno=$snamefetch['telno']; } echo "$sname"; ?></title>
<link href="CSS/style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="Favicon/favicon.png" type="image/png" />
</head>

<body>
<?php
mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$patientidno=$_GET['patientidno'];
$caseno=$_GET['caseno'];
$uname=$_GET['uname'];

mysql_query('SET NAMES utf8');
$patfsql=mysql_query("SELECT UPPER(lastname) AS lastname, UPPER(firstname) AS firstname, UPPER(middlename) AS middlename, age, sex, senior, UPPER(suffix) AS suffix FROM patientprofile WHERE patientidno='$patientidno'");
while($patffetch=mysql_fetch_array($patfsql)){
$lastname=$patffetch['lastname'];
$firstname=$patffetch['firstname'];
$middlename=$patffetch['middlename'];
$age=$patffetch['age'];
$sex=$patffetch['sex'];
$senior=$patffetch['senior'];
$suffix=$patffetch['suffix'];
}


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

$agsql=mysql_query("SELECT SUM(amount) AS amount FROM acctgenledge WHERE caseno='$caseno' AND acctitle='Discounts'");
$agcount=mysql_num_rows($agsql);
if($agcount==0){
$agamount=0;
}
else{
while($agfetch=mysql_fetch_array($agsql)){$agamount=$agfetch['amount'];}
}

$agamount=0;

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
}

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
      <td height='50' valign='middle'><div align='center' class='times16blackbold'>STATEMENT OF ACCOUNT</div></td>
    </tr>
    <tr>
      <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td width='3%'></td>
          <td width='47%'><div align='left'><img src='Image/logo.jpg' width='auto' height='70' /></div></td>
          <td width='47%' valign='middle'><div align='right'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='left' class='times14blackbold'>SOA Reference No.:</div></td>
";

if($employerno==''){
echo "
              <td class='table1Bottom'><div align='left' class='times14black'>&nbsp;$caseno&nbsp;</div></td>
";
}
else{
echo "
              <td class='table1Bottom'><div align='left' class='times14black'>&nbsp;$employerno&nbsp;</div></td>
";
}

echo "
            </tr>
          </table></div></td>
          <td width='3%'></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td><div align='center'><span class='times14blackbold'>$sname<br /></span><span class='times14black'>$address<br />$telno</span></div></td>
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
              <td width='20' class='table1Bottom'><div align='left' class='times10black'>&nbsp;$age&nbsp;</div></td>
            </tr>
          </table></td>
          <td width='42%'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='50'></td>
              <td width='112'><div align='left' class='times10blackbold'>Date & Time Admitted:&nbsp;</div></td>
              <td width='auto' class='table1Bottom'><div align='left' class='times9black'>&nbsp;".date("M d, Y",strtotime($dateadmit))." ".$timeadmitted."&nbsp;</div></td>
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
          <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='80'><div align='left' class='times10blackbold'>Final Diagnosis:&nbsp;</div></td>
              <td width='auto' class='table1Bottom'><div align='left' class='times10black'>&nbsp;$finaldiagnosis&nbsp;</div></td>
            </tr>
          </table></td>
          <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='50'></td>
              <td width='80'><div align='left' class='times10blackbold'>First Case Rate:&nbsp;</div></td>
              <td width='auto' class='table1Bottom'><div align='left' class='times10black'>&nbsp;$fcicdcode&nbsp;</div></td>
            </tr>
          </table></td>
          <td></td>
        </tr>
        <tr>
          <td></td>
          <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='100'><div align='left' class='times10blackbold'>Other Diagnosis:&nbsp;</div></td>
              <td width='auto'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='10'><div align='left' class='times10blackbold'>1.</div></td>
                  <td width='auto' class='table1Bottom'><div align='left' class='times10black'>&nbsp;$secdesc&nbsp;</div></td>
                </tr>
                <tr>
                  <td width='10'><div align='left' class='times10blackbold'>2.</div></td>
                  <td width='auto' class='table1Bottom'><div align='left' class='times10black'>&nbsp;$terdesc&nbsp;</div></td>
                </tr>
                <tr>
                  <td width='10'><div align='left' class='times10blackbold'>3.</div></td>
                  <td width='auto' class='table1Bottom'><div align='left' class='times10black'>&nbsp;$foudesc&nbsp;</div></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
          <td valign='top'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='50'></td>
              <td width='92'><div align='left' class='times10blackbold'>Second Case Rate:&nbsp;</div></td>
              <td width='auto' class='table1Bottom'><div align='left' class='times10black'>&nbsp;$secicdcode&nbsp;</div></td>
            </tr>
          </table></td>
          <td></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height='20'></td>
    </tr>
    <tr>
      <td><div align='center' class='times14blackbold'>SUMMARY OF FEES</div></td>
    </tr>
    <tr>
      <td height='20'></td>
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

$poutsql=mysql_query("SELECT productsubtype FROM productout WHERE caseno='$caseno' AND quantity > 0 AND productsubtype NOT LIKE 'PROFESSIONAL FEE' AND productsubtype NOT LIKE 'ADMITTING FEE' AND productsubtype NOT LIKE 'MISCELLANEOUS CR' AND productsubtype NOT LIKE 'NURSING CHARGES' AND productsubtype NOT LIKE 'NURSING_CHARGES' AND productsubtype NOT LIKE 'NURSING SERVICE FEE' GROUP BY productsubtype ORDER BY productsubtype");
$a=0;
$totactual=0;
$adjsubtot=0;
$grosssubtot=0;
$hmotot=0;
while($poutfetch=mysql_fetch_array($poutsql)){
$pstype=$poutfetch['productsubtype'];

if(($pstype=='MEDICAL SUPPLIES')||($pstype=='PHARMACY/MEDICINE')||($pstype=='SALES-SUPPLIES')||($pstype=='PHARMACY/SUPPLIES')){
$poutdsql=mysql_query("SELECT sellingprice, quantity, adjustment, gross, hmo FROM productout WHERE caseno='$caseno' AND quantity > 0 AND trantype='charge' AND productsubtype='$pstype' AND administration NOT LIKE 'pending'");
$poutdcount=mysql_num_rows($poutdsql);
if($poutdcount==0){
}
else{
$poutdadjtot=0;
$poutdgrosstot=0;
$actual=0;
$hmo=0;
while($poutdfetch=mysql_fetch_array($poutdsql)){$poutdadjtot+=$poutdfetch['adjustment'];$poutdgrosstot+=$poutdfetch['gross'];$actual+=($poutdfetch['sellingprice']*$poutdfetch['quantity']);$hmo+=$poutdfetch['hmo'];}

$totactual+=$actual;
$adjsubtot+=$poutdadjtot;
$grosssubtot+=$poutdgrosstot;
$hmotot+=$hmo;

echo "
        <tr>
          <td><a href='../../2020codes/TestCodes/testviewdetails.php?caseno=$caseno&type=$pstype' target='_blank' class='astyle'><div align='left' class='times10blackbold'>&nbsp;".$pstype."</div></a></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format($actual,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format($poutdadjtot,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format($hmo,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;&nbsp;</div></td>
        </tr>
";
}
}
else{
$poutdsql=mysql_query("SELECT sellingprice, quantity, adjustment, gross, hmo FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype='$pstype'");


$poutdcount=mysql_num_rows($poutdsql);
if($poutdcount==0){
}
else{
$poutdadjtot=0;
$poutdgrosstot=0;
$actual=0;
$hmo=0;
while($poutdfetch=mysql_fetch_array($poutdsql)){$poutdadjtot+=$poutdfetch['adjustment'];$poutdgrosstot+=$poutdfetch['gross'];$actual+=($poutdfetch['sellingprice']*$poutdfetch['quantity']);$hmo+=$poutdfetch['hmo'];}


$totactual+=$actual;
$adjsubtot+=$poutdadjtot;
$grosssubtot+=$poutdgrosstot;
$hmotot+=$hmo;

echo "
        <tr>
          <td><a href='../../2020codes/TestCodes/testviewdetails.php?caseno=$caseno&type=$pstype' target='_blank' class='astyle'><div align='left' class='times10blackbold'>&nbsp;".$pstype."</div></a></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format($actual,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format($poutdadjtot,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format($hmo,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;&nbsp;</div></td>
        </tr>
";
}
}

}


$poutasddadjtotf=0;
$poutasddgrosstotf=0;
$actualf=0;
$hmof=0;
$poutasdsql=mysql_query("SELECT productsubtype FROM productout WHERE caseno='$caseno' AND (productsubtype LIKE 'ADMITTING FEE' OR productsubtype LIKE 'MISCELLANEOUS CR' OR productsubtype LIKE 'NURSING CHARGES' OR productsubtype LIKE 'NURSING SERVICE FEE' OR productsubtype LIKE 'NURSING_CHARGES') GROUP BY productsubtype ORDER BY productsubtype");
while($poutasdfetch=mysql_fetch_array($poutasdsql)){
$pstype=$poutasdfetch['productsubtype'];


$poutasddsql=mysql_query("SELECT sellingprice, quantity, adjustment, gross, hmo FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype='$pstype'");


$poutasddcount=mysql_num_rows($poutasddsql);
if($poutasddcount==0){
$poutasddadjtot=0;
$poutasddgrosstot=0;
$actual=0;
$hmo=0;
}
else{
$poutasddadjtot=0;
$poutasddgrosstot=0;
$actual=0;
$hmo=0;
while($poutasddfetch=mysql_fetch_array($poutasddsql)){$poutasddadjtot+=$poutasddfetch['adjustment'];$poutasddgrosstot+=$poutasddfetch['gross'];$actual+=($poutasddfetch['sellingprice']*$poutasddfetch['quantity']);$hmo+=$poutasddfetch['hmo'];}


}

$poutasddadjtotf+=$poutasddadjtot;
$poutasddgrosstotf+=$poutasddgrosstot;
$actualf+=$actual;
$hmof+=$hmo;

}

$pfadactual=0;
$pfadadj=0;
$pfadgross=0;
$pfadhmo=0;
$pfadsql=mysql_query("SELECT productcode, sellingprice, quantity, adjustment, gross, hmo FROM productout WHERE caseno='$caseno' AND trantype='charge' AND (producttype LIKE 'IPD admitting' OR producttype LIKE 'ADMITTING' OR producttype LIKE 'IPD discharge' OR producttype LIKE 'Catherization Fee' OR producttype LIKE 'Intubation Fee' OR producttype LIKE 'NGT Fee' OR producttype LIKE 'IPD apnurse') AND productsubtype='PROFESSIONAL FEE'");
while($pfadfetch=mysql_fetch_array($pfadsql)){
$pfadactual+=($pfadfetch['sellingprice']*$pfadfetch['quantity']);
$pfadadj+=$pfadfetch['adjustment'];
$pfadgross+=$pfadfetch['gross'];
$pfadhmo+=$pfadfetch['hmo'];

//$pfadactual+=0;
//$pfadadj+=0;
//$pfadgross+=0;
//$pfadhmo+=0;
}


$totactual+=($actualf+$pfadactual);
$adjsubtot+=($poutasddadjtotf+$pfadadj);
$grosssubtot+=($poutasddgrosstotf+$pfadgross);
$hmotot+=($hmof+$pfadhmo);


if(($actualf+$pfadactual)!=0){
echo "
        <tr>
          <td><a href='../../2020codes/TestCodes/testviewdetails.php?caseno=$caseno&type=MEDICAL SURGICAL SUPPLIES' target='_blank' class='astyle'><div align='left' class='times10blackbold'>&nbsp;MEDICAL SURGICAL SUPPLIES</div></a></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(($actualf+$pfadactual),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(($poutasddadjtotf+$pfadadj),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(($hmof+$pfadhmo),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;&nbsp;</div></td>
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


$htot=((($totactual-$adjsubtot-($agamount+$hmotot))-$fchshare)-$sechshare);
if($htot<0){$htotdisp=$htot;}else{$htotdisp=$htot;}

echo "
        <tr>
          <td height='16'><div align='left' class='times13blackbold'>&nbsp;Subtotal</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format($totactual,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format($adjsubtot,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format(($hmotot+$agamount),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format($fchshare,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format($sechshare,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format($htotdisp,2,'.',',')."&nbsp;</div></td>
        </tr>
";

echo "
        <tr>
          <td><div align='center' class='times12blackbold'>Professional fee/s</div></td>
          <td colspan='7'><div align='center' class='times12blackbold'>&nbsp;</div></td>
        </tr>
";

$b=0;
$pftotactual=0;
$pfadjsubtot=0;
$pfgrosssubtot=0;
$pfhmotot=0;

$totopfactual=0;
$totopfadj=0;
$totopfhmo=0;

$pfrelactual=0;
$pfreladj=0;
$prrelhmo=0;
$pfrelgross=0;

if($membership=="Nonmed-none"){
$pfpoutsql=mysql_query("SELECT productdesc, sellingprice, quantity, adjustment, gross, phic, hmo, producttype FROM productout WHERE caseno='$caseno' AND trantype='charge' AND (producttype NOT LIKE 'IPD admitting' or producttype NOT LIKE 'IPD discharge' OR producttype NOT LIKE 'Catherization Fee' OR producttype NOT LIKE 'Intubation Fee' OR producttype NOT LIKE 'NGT Fee' OR producttype NOT LIKE 'IPD apnurse') AND productsubtype='PROFESSIONAL FEE' ");
}
else if($membership=="phic-med"){
$pfpoutsql=mysql_query("SELECT productdesc, sellingprice, quantity, adjustment, gross, phic, hmo, producttype FROM productout WHERE caseno='$caseno' AND trantype='charge' AND (producttype LIKE 'ATTENDING' OR producttype LIKE 'IPD attending' OR producttype LIKE 'IPD surgeon' OR producttype LIKE 'IPD anesthesiologist') AND productsubtype='PROFESSIONAL FEE' GROUP BY productdesc");
}
else{
$pfpoutsql=mysql_query("SELECT productdesc, sellingprice, quantity, adjustment, gross, phic, hmo, producttype FROM productout WHERE caseno='$caseno' AND trantype='charge' AND (producttype NOT LIKE 'IPD admitting' OR producttype NOT LIKE 'IPD discharge' OR producttype NOT LIKE 'Catherization Fee' OR producttype NOT LIKE 'Intubation Fee' OR producttype NOT LIKE 'NGT Fee' OR producttype NOT LIKE 'IPD apnurse') AND productsubtype='PROFESSIONAL FEE' ");
}

while($pfpoutfetch=mysql_fetch_array($pfpoutsql)){
$producttype=$pfpoutfetch['producttype'];
$doctor=$pfpoutfetch['productdesc'];
$b++;

$fifsasql=mysql_query("SELECT * FROM productout WHERE caseno='$caseno' AND trantype='charge' AND (producttype LIKE 'IPD surgeon' OR producttype LIKE 'IPD anesthesiologist') AND productsubtype='PROFESSIONAL FEE'");
$fifsacount=mysql_num_rows($fifsasql);

if($fifsacount==0){
$pfactual=0;
$pfadj=0;
$pfhmo=0;
$pfshowsql=mysql_query("SELECT sellingprice, quantity, adjustment, gross, phic, hmo, producttype FROM productout WHERE caseno='$caseno' AND trantype='charge' AND producttype NOT LIKE 'IPD admitting' AND producttype NOT LIKE 'IPD discharge' AND producttype NOT LIKE 'Catherization Fee' AND producttype NOT LIKE 'Intubation Fee' AND producttype NOT LIKE 'NGT Fee' AND producttype NOT LIKE 'IPD apnurse' AND productsubtype='PROFESSIONAL FEE'");
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
else{
$pfactual=0;
$pfadj=0;
$pfhmo=0;
$pfshowsql=mysql_query("SELECT sellingprice, quantity, adjustment, gross, phic, hmo, producttype FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productdesc='$doctor' AND producttype NOT LIKE 'IPD admitting' AND producttype NOT LIKE 'IPD apnurse'");
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


$asdsql=mysql_query("SELECT sellingprice, quantity, adjustment, gross, phic, hmo, producttype FROM productout WHERE caseno='$caseno' AND productdesc NOT LIKE '$doctor' AND trantype='charge' AND producttype NOT LIKE 'IPD surgeon' AND producttype NOT LIKE 'IPD anesthesiologist' AND producttype NOT LIKE 'IPD attending' AND producttype NOT LIKE 'IPD admitting' AND producttype NOT LIKE 'IPD discharge' AND producttype NOT LIKE 'Catherization Fee' AND producttype NOT LIKE 'Intubation Fee' AND producttype NOT LIKE 'NGT Fee' AND producttype NOT LIKE 'IPD apnurse' AND productsubtype='PROFESSIONAL FEE'");
$asdcount=mysql_num_rows($asdsql);

$pfactual2=0;
$pfadj2=0;
$pfhmo2=0;
if(($asdcount!=0)&&($membership=="phic-med")&&($producttype=="IPD attending")&&($fifsacount!=0)){
$opfsql=mysql_query("SELECT productdesc FROM productout WHERE caseno='$caseno' AND trantype='charge' AND (producttype LIKE 'IPD surgeon' OR producttype LIKE 'IPD anesthesiologist') AND productsubtype='PROFESSIONAL FEE'");
while($opffetch=mysql_fetch_array($opfsql)){
$opfname=$opffetch['productdesc'];

$qwesql=mysql_query("SELECT SUM(sellingprice) AS sp, SUM(adjustment) AS adj, SUM(hmo) AS hmo FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productdesc LIKE '$opfname' AND producttype NOT LIKE 'IPD surgeon' AND producttype NOT LIKE 'IPD anesthesiologist' AND productsubtype='PROFESSIONAL FEE'");
$qwecount=mysql_num_rows($qwesql);


if($qwecount==0){
$opfsp=0;$opfadj=0;$opfhmo=0;
}
else{
  while($qwefetch=mysql_fetch_array($qwesql)){
    $opfsp=$qwefetch['sp'];
    $opfadj=$qwefetch['adj'];
    $opfhmo=$qwefetch['hmo'];
    //echo $opfname." --> ".$opfsp." | ".$opfadj." | ".$opfhmo."<br />";
  }
}


$totopfactual+=$opfsp;
$totopfadj+=$opfadj;
$totopfhmo+=$opfhmo;
}


while($asdfetch=mysql_fetch_array($asdsql)){
$pfactual2+=$asdfetch['sellingprice']*$asdfetch['quantity'];
$pfadj2+=$asdfetch['adjustment'];
$pfhmo2+=$asdfetch['hmo'];
}

$pftotactual+=$pfactual2;
$pfadjsubtot+=$pfadj2;
$pfhmotot+=$pfhmo2;
}
else{
$totopfactual=0;
$totopfadj=0;
$totopfhmo=0;
}

$pfactualrel=$pfactual+$pfactual2-$totopfactual;
$pfadjrel=$pfadj+$pfadj2-$totopfadj;
$pfhmorel=$pfhmo+$pfhmo2-$totopfhmo;

$pftotactual+=(-$totopfactual);
$pfadjsubtot+=(-$totopfadj);
$pfhmotot+=(-$totopfhmo);


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

$pfrelactual+=$pfactualrel;
$pfreladj+=$pfadjrelnew;
$pfrelhmo+=$pfhmorelnew;


echo "
        <tr>
          <td><a href='../../2020codes/TestCodes/testviewdetails.php?caseno=$caseno&type=PROFESSIONAL FEE' target='_blank' class='astyle'><div align='left' class='times10blackbold'>&nbsp;$b.&nbsp;".strtoupper($doctor)."</div></a></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format($pfactualrel,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format($pfadjrelnew,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format($pfhmorelnew,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;&nbsp;</div></td>
        </tr>
";

}


$pftot=((($pftotactual-$pfadjsubtot-$pfhmotot)-$fcpshare)-$secpshare);
if($pftot<0){$pftotdisp=$pftot;}else{$pftotdisp=$pftot;}


$overap1=(($totactual-$adjsubtot-($agamount+$hmotot))-$fchshare)-$sechshare;
if($overap1<0){$op1=$overap1;}else{$op1=$overap1;}
$overap2=(($pftotactual-$pfadjsubtot-$pfhmotot)-$fcpshare)-$secpshare;
if($overap2<0){$op2=$overap2;}else{$op2=$overap2;}

$overtot=($op1+$op2);
if($overtot<0){$overtotdisp=0;}else{$overtotdisp=$overtot;}

echo "
        <tr>
          <td height='16'><div align='left' class='times13blackbold'>&nbsp;Subtotal</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format(($pfrelactual),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format(($pfreladj),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format(($pfrelhmo),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format($fcpshare,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format($secpshare,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format($pftotdisp,2,'.',',')."&nbsp;</div></td>
        </tr>
        <tr>
          <td height='24'><div align='left' class='times13blackbold'>&nbsp;Total</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format(($totactual+$pftotactual),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format(($pfadjsubtot+$adjsubtot),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format(($hmotot+$pfhmotot+$agamount),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format(($fcpshare+$fchshare),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times13blackbold'>&nbsp;".number_format(($secpshare+$sechshare),2,'.',',')."&nbsp;</div></td>
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
                        $lessacct=mysql_query("SELECT SUBSTRING_INDEX(acctitle, ' ', 2) as acctitle,sum(amount) as amount,date FROM acctgenledge where caseno='$caseno' and  acctitle like '%AR%' group by SUBSTRING_INDEX(acctitle, ' ', 2) ");
                    while($lessacctfetch=mysql_fetch_array($lessacct))
                            {
                             $acctitle=$lessacctfetch['acctitle'];
                             $amount=$lessacctfetch['amount'];
				$date=$lessacctfetch['date'];

                              echo "<tr>
                                    <td align='center' class='times10black' >
                                    <table border='0' width='100%'>
                                    		<tr>
                                    			<td width='30%'>&nbsp; </td>
                                    			<td lign='left'><b>$acctitle - $date </b></td>
                                    			<td width='30%'>&nbsp;  </td>
                                    		</tr>
                                    </table>
                                    </td>
                                    <td align='right' class='times10black' colspan='7'>".number_format($amount,2)."</td>
                                    </tr>

                                    ";
             
                              }

                       // $lessacct=mysql_query("SELECT * FROM acctgenledge where caseno='$caseno'");
                        $lesscollect=mysql_query("SELECT * FROM collection where acctno='$caseno' and (accttitle='PATIENTS DEPOSIT') and type !='pending' ");
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

//start-- sum of the total Less (AR and Patient's Deposit)
          $total_AR=0;
          $AR_query=mysql_query("SELECT * FROM acctgenledge where caseno='$caseno' and acctitle like '%AR%' ");
                    while($AR_fetch=mysql_fetch_array($AR_query))
                            {
                             $acctitle=$AR_fetch['acctitle'];
                             $amount=$AR_fetch['amount'];


                             $total_AR +=$amount;
                  
             
                              }

          $total_PD=0;
          $PD_query=mysql_query("SELECT * FROM collection where acctno='$caseno' and (accttitle='PATIENTS DEPOSIT' or accttitle='CASHONHAND' or accttitle='PROFESSIONAL FEE') and type !='pending' ");
                    while($PD_fetch=mysql_fetch_array($PD_query))
                            {
                             $acctitle=$PD_fetch['accttitle'];
                             $amount=$PD_fetch['amount'];


                             $total_PD +=$amount;
                  
             
                              }

        $total_less= $total_AR + $total_PD;
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

//<td><div align='right' class='times13blackbold'>&nbsp;".number_format($overtotdisp,2,'.',',')."&nbsp;</div></td>

echo "
          </table>
          </td>
        </tr>
        </tr>
        <tr>
          <td height='30'></td>
          </tr>";

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
              <td width='auto' class='table1Bottom'><div align='left' class='times11black'>572-2018/2396&nbsp;</div></td>
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
       <td width='55%'><div align='left'><img src='Image/signature.png' width='300' height='120' /></div></td>
	</tr>
      </table></td>
    </tr>
  </table>
</div>
";

?> 
</body>
</html>
