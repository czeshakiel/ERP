<?php
ini_set("display_errors","On");
include('../../Settings.php');
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$searchme=$_GET['searchme'];
$pckgno=$_GET['pckgno'];

echo "
<table border='0' cellpadding='0' cellspacing='0'>
  <tr>
    <td colspan='4' height='15'></td>
  </tr>
  <tr>
    <td class='t2 b2 l2'><div align='center' class='arial s10 black bold'>&nbsp;Code&nbsp;</div></td>
    <td class='t2 b2 l1'><div align='center' class='arial s10 black bold'>&nbsp;Description&nbsp;</div></td>
    <td class='t2 b2 l1'><div align='center' class='arial s10 black bold'>&nbsp;Unit&nbsp;</div></td>
    <td class='t2 b2 l1'><div align='center' class='arial s10 black bold'>&nbsp;Price Type&nbsp;</div></td>
    <td class='t2 b2 l1'><div align='center' class='arial s10 black bold'>&nbsp;Unit Cost&nbsp;</div></td>
    <td class='t2 b2 l1'><div align='center' class='arial s10 black bold'>&nbsp;Price&nbsp;</div></td>
    <td class='t2 b2 l1 r2'><div align='center' class='arial s10 black bold'>&nbsp;&nbsp;</div></td>
  </tr>
";

$dsql=mysql_query("SELECT code, description, unit, lotno, generic FROM receiving WHERE (itemname LIKE '%$searchme%' OR generic LIKE '%$searchme%') AND (unit='PHARMACY/MEDICINE' OR unit='MEDICAL SURGICAL SUPPLIES' OR unit='PHARMACY/SUPPLIES') ORDER BY itemname");
while($dfetch=mysql_fetch_array($dsql)){
$dcode=$dfetch['code'];
$desc=$dfetch['description'];
$generic=$dfetch['generic'];
$unit=$dfetch['unit'];
$lotno=$dfetch['lotno'];

$desc=str_replace("cmshi-","",$desc);
$desc=str_replace("ams-","",$desc);
$desc=str_replace("-sup","",$desc);

if($unit=="PHARMACY/MEDICINE"){
  $desc=$desc." ($generic)";
}

//$stuc=mysql_query("SELECT unitcost FROM stocktable WHERE code='$code' GROUP BY rrno ORDER BY CAST(unitcost AS DECIMAL(10,2))");
$stuc=mysql_query("SELECT unitcost FROM stocktable WHERE code='$dcode' AND trantype NOT LIKE 'dispensed' AND trantype NOT LIKE 'return' AND unitcost > 0 ORDER BY datearray");
while($stucfetch=mysql_fetch_array($stuc)){
$uc=round($stucfetch['unitcost'],2);
//echo $uc."<br />";
}

$sellingprice=($uc+($uc*0.70));

if($lotno=="M"){
  $sp=$sellingprice;
}
else if($lotno=="S"){
  $esql=mysql_query("SELECT philhealth FROM productsmasterlist WHERE code='$dcode'");
  $efetch=mysql_fetch_array($esql);
  $phic=$efetch['philhealth'];

  $sp=$phic;
}
else{
  $sp=0;
}

echo "
  <tr>
    <td class='b1 l2'><div align='left' class='arial s13 black'>&nbsp;$dcode&nbsp;</div></td>
    <td class='b1 l1'><div align='left' class='arial s13 black'>&nbsp;$desc&nbsp;</div></td>
    <td class='b1 l1'><div align='center' class='arial s13 black'>&nbsp;$unit&nbsp;</div></td>
    <td class='b1 l1'><div align='center' class='arial s13 black'>&nbsp;$lotno&nbsp;</div></td>
    <td class='b1 l1'><div align='right' class='arial s13 black'>&nbsp;".number_format($uc,"2",".",",")."&nbsp;</div></td>
    <td class='b1 l1'><div align='right' class='arial s13 black'>&nbsp;".number_format($sp,"2",".",",")."&nbsp;</div></td>
    <td class='b1 l1 r2'><a href='additem.php?pckgno=$pckgno&code=$dcode&desc=$desc&price=$sp' class='astyle'><div align='center'>&nbsp;<input type='button' class='arial s12 white bold bggreen borderblack' value='  +  ' />&nbsp;</div></a></td>
  </tr>
";
}

echo "
  <tr>
    <td colspan='7' class='t1'></td>
  </tr>
</table>
";

?>
