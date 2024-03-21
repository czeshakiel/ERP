<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Home Meds</title>
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

</head>

<body onload="placeFocus()" bgcolor='#0099CC'>
<?php
include("../Settings.php");
$cuz = new database();

$searchme=$_GET['searchme'];
$caseno=$_GET['caseno'];
$station=$_GET['station'];
$toh=$_GET['toh'];
$tick=$_GET['tick'];

$at=$_GET['at'];
$cl=$_GET['cl'];

$len=strlen($searchme);

$ccacce=$_COOKIE["ccacce"];

if($len>1){
echo "
<div a1lign='left'>
";

$zsql=mysqli_query($mycon1,"SELECT membership, hmomembership FROM admission WHERE caseno='$caseno'");
$zfetch=mysqli_fetch_array($zsql);
$membership=$zfetch['membership'];
$hmomembership=$zfetch['hmomembership'];

$a=0;
$asql=mysqli_query($mycon1,"SELECT * FROM receiving WHERE description LIKE '%$searchme%' AND unit NOT LIKE '%medicine%' AND unit NOT LIKE '%PHARMACY%' AND unit NOT LIKE '%ACCOUNTABLE%' AND unit NOT LIKE '%-SUPPLIES%' AND unit NOT LIKE '%LABORATORY SUPPLIES%' AND unit NOT LIKE 'GENERAL SUPPLIES' AND unit NOT LIKE '%CSR/KIT%' AND unit NOT LIKE 'RADIOLOGY SUPPLIES' AND unit NOT LIKE 'RESPIRATORY SUPPLIES' AND unit NOT LIKE 'STERILIZATION SUPPLIES' AND unit NOT LIKE 'ULTRASOUND SUPPLIES' AND unit NOT LIKE 'PT SUPPLIES' AND unit NOT LIKE 'PLUMBING' AND unit NOT LIKE '%OFFICE%%SUPPLIES%' AND unit NOT LIKE '%Nonmedical Supplies%' AND unit NOT LIKE 'HEART STATION SUPPLIES' AND unit NOT LIKE 'LAUNDRY SUPPLIES' AND unit NOT LIKE 'ELECTRICAL SUPPLIES' AND unit NOT LIKE 'CT SCAN SUPPLIES' AND unit NOT LIKE 'Housekeeping Supplies' AND unit NOT LIKE 'Equipment' AND unit NOT LIKE 'COMPUTER EQUIPMENT AND ACCESS' AND unit NOT LIKE 'HOSPITAL EQUIPMENT' AND unit NOT LIKE 'COMPUTER SUPPLIES' AND unit NOT LIKE 'LAUNDRY' AND unit NOT LIKE 'CENTRAL SUPPLIES' AND unit NOT LIKE '%MEDICAL SURGICAL SUPPLIES%' AND unit NOT LIKE 'MISCELLANEOUS SUPPLIES' AND unit NOT LIKE 'HOSPITAL CSR KIT' AND unit NOT LIKE 'ECG SUPPLIES' AND unit NOT LIKE '%ECG SUPPLIES%' AND unit NOT LIKE '%DIALYSIS%' AND unit NOT LIKE 'NEWBORN SCREENING SUPPLIES' AND unit NOT LIKE 'OTHERS' AND unit NOT LIKE '' ORDER BY itemname");
$acount=mysqli_num_rows($asql);

if($acount==0){
echo "
<span class='arial s14 red bold'>0 Results Found!!!</span>
";
}
else{
echo "
  <table border='1' bordercolor='#000000' cellpadding='0' cellspacing='0'>
    <tr>
      <td bgcolor='3380ff' width='30'><div align='center' class='arial s12 white bold'>&nbsp;#&nbsp;</div></td>
      <td bgcolor='3380ff' width='400'><div align='center' class='arial s12 white bold'>&nbsp;Description&nbsp;</div></td>
      <td bgcolor='3380ff' width='80'><div align='center' class='arial s12 white bold'>&nbsp;Qty&nbsp;</div></td>
      <td bgcolor='3380ff' width='160'><div align='center' class='arial s12 white bold'>&nbsp;&nbsp;</div></td>
      <td bgcolor='3380ff' width='200'><div align='center' class='arial s12 white bold'>&nbsp;Type&nbsp;</div></td>
    </tr>
  </table>
";


while($afetch=mysqli_fetch_array($asql)){
$co=$afetch['code'];
$ds=$afetch['description'];
$ty=$afetch['unit'];
$gte=$afetch['gtestcode'];

$ds=str_replace("cmshi-","",$ds);
$ds=str_replace("-sup","",$ds);
$ds=str_replace("-med","",$ds);
$ds=str_replace("ams-","",$ds);

$a++;

if($ty=="LABORATORY" || $ty=="XRAY"){
  $href="ccchargesremarks.php";
}
else{
  if($co=="210906184316p-50"){
    $href="ccchargesremarks.php";
  }
  else{
    $href="poscharges.php";
  }
}

echo "
  <form method='get' action='$href'>
  <table border='1' bordercolor='#000000' cellpadding='0' cellspacing='0'>
    <tr>
      <td height='35' width='30'><div align='center' class='arial s14 black bold'>&nbsp;$a&nbsp;</div></td>
      <td height='35' width='400'><div align='left' class='arial s14 black bold'>&nbsp;".strtoupper($ds)."&nbsp;</div></td>
";

if((stripos($ty, "LABORATORY") !== FALSE)||(stripos($ty, "CT SCAN") !== FALSE)||(stripos($ty, "ULTRASOUND") !== FALSE)||(stripos($ty, "ECG") !== FALSE)||(stripos($ty, "XRAY") !== FALSE)||(stripos($ty, "EEG") !== FALSE)){
echo "
      <td height='35' width='80'><div align='center'>&nbsp;<input type='number' name='qty' style='width: 50px;height: 20px;padding: 5px;margin: 3px 0 3px 0;border: none;background: #eee;border-radius: 5px;font-size: 14px;text-align: center;border: 1px solid #000000;' value='1' readonly />&nbsp;</div></td>
";
}
else{
echo "
      <td height='35' width='80'><div align='center'>&nbsp;<input type='number' name='qty' style='width: 50px;height: 20px;padding: 5px;margin: 3px 0 3px 0;border: none;background: #eee;border-radius: 5px;font-size: 14px;text-align: center;border: 1px solid #000000;' value='1' />&nbsp;</div></td>
";
}

echo "
      <td class='div-container' width='160'><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
        <tr>
";

if($gte=="1"){
echo "
      <td class='div-container' width='160'><div align='center' style='color: #c557ff;font-family: Arial;font-weight: bold;'>DISABLED</div></td>
";
}
else if($gte=="0"){
if(stripos($caseno, "W") !== FALSE){
  echo "
          <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn' value='cash'>&nbsp;Cash&nbsp;</button></div></td>
  ";
}
else if((stripos($caseno, "AR") !== FALSE)||(stripos($caseno, "AP") !== FALSE)){
  echo "
        <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn' value='cash'>&nbsp;Cash&nbsp;</button></div></td>
        <td width='20'></td>
        <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn cancel' value='charge'>Charge</button></td>
  ";
}
else{
  if((($membership=="Nonmed-none")||($membership=="none"))&&($hmomembership=="none")){
    echo "
          <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn' value='cash'>&nbsp;Cash&nbsp;</button></div></td>
    ";
  }
  else if((($membership=="Nonmed-none")||($membership=="none"))&&($hmomembership!="none")){
    echo "
          <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn' value='cash'>&nbsp;Cash&nbsp;</button></div></td>
          <td width='20'></td>
          <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn cancel' value='charge'>Charge</button></td>
    ";
  }
  else{
    echo "
          <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn' value='cash'>&nbsp;Cash&nbsp;</button></div></td>
          <td width='20'></td>
          <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn cancel' value='charge'>Charge</button></td>
    ";
  }
}

if(($ccacce=="4")||($ccacce=="5")){
  if(stripos($caseno, "W-") !== FALSE){

  }
  else{
echo "
          <td width='20'></td>
          <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn tpl' value='tpl' title='To Pay Later'>&nbsp;TPL&nbsp;</button></td>
";
  }
}
}

echo "
        </tr>
      </table></div></td>
      <td height='35' width='200'><div align='left' class='arial s14 black bold'>&nbsp;".strtoupper($ty)."&nbsp;</div></td>
    </tr>
  </table>
";

if($ty!="LABORATORY"){
    echo "
  <input type='hidden' name='remarks' value='' />
  ";
}


echo "
  <input type='hidden' name='caseno' value='$caseno' />
  <input type='hidden' name='station' value='$station' />
  <input type='hidden' name='toh' value='$toh' />
  <input type='hidden' name='tick' value='$tick' />
  <input type='hidden' name='code' value='$co' />
  <input type='hidden' name='unit' value='$ty' />
  </form>
";
}


echo "
</div>
";
}
}

?>
</body>
</html>
