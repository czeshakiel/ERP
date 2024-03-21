<?php
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
    <td class='t2 b2 l1'><div align='center' class='arial s10 black bold'>&nbsp;Price&nbsp;</div></td>
    <td class='t2 b2 l1 r2'><div align='center' class='arial s10 black bold'>&nbsp;&nbsp;</div></td>
  </tr>
";

$dsql=mysql_query("SELECT receiving.code, receiving.description, productsmasterlist.opd FROM receiving, productsmasterlist WHERE receiving.code=productsmasterlist.code AND receiving.description LIKE '%$searchme%' AND (receiving.unit='LABORATORY' OR receiving.unit='RDU SUPPLIES' OR receiving.unit='PROFESSIONAL FEE' OR receiving.unit='ROOM ACCOMODATION' OR receiving.unit='MEDICAL EQUIPMENT' OR receiving.unit='NURSING SERVICE FEE' OR receiving.unit='HEARTSTATION' OR receiving.unit='ECG' OR receiving.unit='ULTRASOUND' OR receiving.unit='MAMMOGRAPHY' OR receiving.unit='XRAY')");
while($dfetch=mysql_fetch_array($dsql)){
$dcode=$dfetch['code'];
$desc=$dfetch['description'];
$OPD=$dfetch['opd'];

$desc=str_replace("cmshi-","",$desc);
$desc=str_replace("ams-","",$desc);
$desc=str_replace("-sup","",$desc);

echo "
  <tr>
    <td class='b1 l2'><div align='left' class='arial s13 black'>&nbsp;$dcode&nbsp;</div></td>
    <td class='b1 l1'><div align='left' class='arial s13 black'>&nbsp;$desc&nbsp;</div></td>
    <td class='b1 l1'><div align='right' class='arial s13 black'>&nbsp;".number_format($OPD,"2",".",",")."&nbsp;</div></td>
    <td class='b1 l1 r2'><a href='additem.php?pckgno=$pckgno&code=$dcode&desc=$desc&price=$OPD' class='astyle'><div align='center'>&nbsp;<input type='button' class='arial s12 white bold bggreen borderblack' value='  +  ' />&nbsp;</div></a></td>
  </tr>
";
}

echo "
  <tr>
    <td colspan='4' class='t1'></td>
  </tr>
</table>
";

?>
