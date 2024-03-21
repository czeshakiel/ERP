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

$patfsql=mysql_query("SELECT UPPER(lastname) AS lastname, UPPER(firstname) AS firstname, UPPER(middlename) AS middlename, age, sex FROM patientprofile WHERE patientidno='$patientidno'");
while($patffetch=mysql_fetch_array($patfsql)){
$lastname=$patffetch['lastname'];
$firstname=$patffetch['firstname'];
$middlename=$patffetch['middlename'];
$age=$patffetch['age'];
$sex=$patffetch['sex'];
}

$patfasql=mysql_query("SELECT UPPER(suffix) AS suffix FROM patientprofileaddinfo WHERE patientidno='$patientidno'");
$patfacount=mysql_num_rows($patfasql);
if($patfacount==0){
$suffix="";
}
else{
while($patfafetch=mysql_fetch_array($patfasql)){
$suffix=$patfafetch['suffix'];
}
}

$admsql=mysql_query("SELECT paymentmode, room, UPPER(street) AS street, UPPER(barangay) AS barangay, UPPER(municipality) AS municipality, UPPER(province) AS province,UPPER(pastmed) AS pastmed, UPPER(initialdiagnosis) AS initialdiagnosis, UPPER(finaldiagnosis) AS finaldiagnosis, UPPER(ap) AS ap, timeadmitted, dateadmit, contactno FROM admission WHERE caseno='$caseno'");
while($admfetch=mysql_fetch_array($admsql)){
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
}

$agsql=mysql_query("SELECT SUM(amount) AS amount FROM acctgenledge WHERE caseno='$caseno' AND acctitle='Discounts'");
$agcount=mysql_num_rows($agsql);
if($agcount==0){
$agamount=0;
}
else{
while($agfetch=mysql_fetch_array($agsql)){$agamount=$agfetch['amount'];}
}

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

//Other Diagnosis
$tersql=mysql_query("SELECT icdcode, hospitalshare, pfshare, level, UPPER(description) AS description FROM finalcaserate WHERE caseno='$caseno' AND level='diagnosis1'");
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

$fousql=mysql_query("SELECT icdcode, hospitalshare, pfshare, level, UPPER(description) AS description FROM finalcaserate WHERE caseno='$caseno' AND level='diagnosis2'");
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

$fifsql=mysql_query("SELECT icdcode, hospitalshare, pfshare, level, UPPER(description) AS description FROM finalcaserate WHERE caseno='$caseno' AND level='diagnosis3'");
$fifcount=mysql_num_rows($fifsql);

if($fifcount==0){
$fificdcode="";
$fifdesc="";
$fifhshare=0;
$fifpshare=0;
}
else{
while($fiffetch=mysql_fetch_array($fifsql)){$fificdcode=$fiffetch['icdcode'];$fifhshare=$fiffetch['hospitalshare'];$fifpshare=$fiffetch['pfshare'];$fifdesc=$fiffetch['description'];}
}
//End Other Diagnosis


}
else{
while($secfetch=mysql_fetch_array($secsql)){$secicdcode=$secfetch['icdcode'];$sechshare=$secfetch['hospitalshare'];$secpshare=$secfetch['pfshare'];$secdesc=$secfetch['description'];}

//Other Diagnosis
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
//End Other Diagnosis

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
              <td class='table1Bottom'><div align='left' class='times14black'>&nbsp;$caseno&nbsp;</div></td>
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
while($tdsfetch=mysql_fetch_array($tdssql)){$tdsdate=$tdsfetch['date'];$tdstime=$tdsfetch['time'];}

echo "
                &nbsp;".date("M d, Y",strtotime($tdsdate))." $tdstime&nbsp;
";
}
}

else{
while($dtfetch=mysql_fetch_array($dtsql)){$datedischarged=$dtfetch['datedischarged'];$timedischarged=$dtfetch['timedischarged'];}

$datedischarged=str_replace("_","-",$datedischarged);

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
              <td width='auto' class='table1Bottom'><div align='left' class='times10black'>&nbsp;$fcdesc&nbsp;</div></td>
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
";

if($secdesc==""){$secdes=$terdesc;$terdes=$foudesc;$foudes="";}else{$secdes=$secdesc;$terdes=$terdesc;$foudes=$foudesc;}


echo "
                <tr>
                  <td width='10'><div align='left' class='times10blackbold'>1.</div></td>
                  <td width='auto' class='table1Bottom'><div align='left' class='times10black'>&nbsp;$secdes&nbsp;</div></td>
                </tr>
                <tr>
                  <td width='10'><div align='left' class='times10blackbold'>2.</div></td>
                  <td width='auto' class='table1Bottom'><div align='left' class='times10black'>&nbsp;$terdes&nbsp;</div></td>
                </tr>
                <tr>
                  <td width='10'><div align='left' class='times10blackbold'>3.</div></td>
                  <td width='auto' class='table1Bottom'><div align='left' class='times10black'>&nbsp;$foudes&nbsp;</div></td>
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

$poutsql=mysql_query("SELECT productsubtype FROM productout WHERE caseno='$caseno' AND productsubtype NOT LIKE 'PROFESSIONAL FEE' GROUP BY productsubtype ORDER BY productsubtype");
$a=0;
$totactual=0;
$adjsubtot=0;
$grosssubtot=0;
$hmotot=0;
while($poutfetch=mysql_fetch_array($poutsql)){
$pstype=$poutfetch['productsubtype'];

if(($pstype=='MEDICAL SUPPLIES')||($pstype=='PHARMACY/MEDICINE')||($pstype=='SALES-SUPPLIES')){
$poutdsql=mysql_query("SELECT sellingprice, quantity, adjustment, gross, hmo FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype='$pstype' ");
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
          <td><div align='left' class='times10blackbold'>&nbsp;".$pstype."</div></td>
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
          <td><div align='left' class='times10blackbold'>&nbsp;".$pstype."</div></td>
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
          <td height='16'><div align='left' class='times12blackbold'>&nbsp;Subtotal</div></td>
          <td><div align='right' class='times11blackbold'>&nbsp;".number_format($totactual,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times11blackbold'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times11blackbold'>&nbsp;".number_format($adjsubtot,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times11blackbold'>&nbsp;".number_format(($hmotot+$agamount),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times11blackbold'>&nbsp;".number_format($fchshare,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times11blackbold'>&nbsp;".number_format($sechshare,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times11blackbold'>&nbsp;".number_format($htotdisp,2,'.',',')."&nbsp;</div></td>
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
$pfpoutsql=mysql_query("SELECT productdesc, sellingprice, quantity, adjustment, gross, hmo FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype='PROFESSIONAL FEE'");
while($pfpoutfetch=mysql_fetch_array($pfpoutsql)){
$b++;
$pfactual=$pfpoutfetch['sellingprice']*$pfpoutfetch['quantity'];
$pfhmo=$pfpoutfetch['hmo'];

$pftotactual+=$pfactual;
$pfadjsubtot+=$pfpoutfetch['adjustment'];
$pfgrosssubtot+=$pfpoutfetch['gross'];
$pfhmotot+=$pfhmo;

echo "
        <tr>
          <td><div align='left' class='times10blackbold'>&nbsp;$b.&nbsp;".$pfpoutfetch['productdesc']."</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format($pfactual,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format($pfpoutfetch['adjustment'],2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times10black'>&nbsp;".number_format($pfhmo,2,'.',',')."&nbsp;</div></td>
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
          <td height='16'><div align='left' class='times12blackbold'>&nbsp;Subtotal</div></td>
          <td><div align='right' class='times11blackbold'>&nbsp;".number_format($pftotactual,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times11blackbold'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times11blackbold'>&nbsp;".number_format($pfadjsubtot,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times11blackbold'>&nbsp;".number_format($pfhmotot,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times11blackbold'>&nbsp;".number_format($fcpshare,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times11blackbold'>&nbsp;".number_format($secpshare,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times11blackbold'>&nbsp;".number_format($pftotdisp,2,'.',',')."&nbsp;</div></td>
        </tr>
        <tr>
          <td height='24'><div align='left' class='times12blackbold'>&nbsp;Total</div></td>
          <td><div align='right' class='times11blackbold'>&nbsp;".number_format(($totactual+$pftotactual),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times11blackbold'>&nbsp;".number_format(0,2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times11blackbold'>&nbsp;".number_format(($pfadjsubtot+$adjsubtot),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times11blackbold'>&nbsp;".number_format(($hmotot+$pfhmotot+$agamount),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times11blackbold'>&nbsp;".number_format(($fcpshare+$fchshare),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times11blackbold'>&nbsp;".number_format(($secpshare+$sechshare),2,'.',',')."&nbsp;</div></td>
          <td><div align='right' class='times11blackbold'>&nbsp;".number_format($overtotdisp,2,'.',',')."&nbsp;</div></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height='30'></td>
    </tr>
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
          <td height='60' colspan='5'></td>
        </tr>
        <tr>
          <td></td>
          <td valign='top'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td class='table1Bottom'><div align='center' class='times13blackbold'>".strtoupper($uname)."</div></td>
            </tr>
            <tr>
              <td><div align='left' class='times11blackbold'>Billing Clerk/Accountant</div></td>
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

if($comchoose=="M"){$signame=$firstname." ".$middlename." ".$lastname." ".$suffix;}else{$signame=$comname;}

if($comrelation=="Others"){$comrel=$comrelationos;}else{$comrel=$comrelation;}

echo "
          <td valign='top'><table width='220' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td class='table1Bottom'><div align='center' class='times11blackbold'></div></td>
            </tr>
            <tr>
              <td><a href='../../eClaims/CSF-Data-AddEdit.php?caseno=$caseno&patientidno=$patientidno&choosea=0&chooseb=0' class='astyle'><div align='left' class='times11blackbold'>Member/Patient/Authorized representative</div></a></td>
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
              <td width='auto' class='table1Bottom'><div align='left' class='times11black'>&nbsp;</div></td>
            </tr>
          </table></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='70'><div align='left' class='times11blackbold'>Contact no.:&nbsp;</div></td>
              <td width='auto' class='table1Bottom'><div align='left' class='times11black'>&nbsp;0910-875-1627&nbsp;</div></td>
            </tr>
          </table></td>
          <td>&nbsp;</td>
          <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='70'><div align='left' class='times11blackbold'>Date signed:&nbsp;</div></td>
              <td width='70' class='table1Bottom'><div align='left' class='times11black'>&nbsp;$comdatesigned</div></td>
              <td width='70'><div align='left' class='times11blackbold'>&nbsp;Contact no.:&nbsp;</div></td>
              <td width='auto' class='table1Bottom'><div align='left' class='times11black'>$contactno&nbsp;</div></td>
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
        </tr>
      </table></td>
    </tr>
  </table>
</div>
";

?> 
</body>
</html>
