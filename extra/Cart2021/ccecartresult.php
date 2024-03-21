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
$stk=$_GET['stk'];

$len=strlen($searchme);

if($len>1){
echo "
<div a1lign='left'>
";

$zsql=mysqli_query($mycon1,"SELECT membership, hmomembership FROM admission WHERE caseno='$caseno'");
$zfetch=mysqli_fetch_array($zsql);
$membership=$zfetch['membership'];
$hmomembership=$zfetch['hmomembership'];

$a=0;
//$asql=mysqli_query($mycon1,"SELECT code, description, generic, SUM(quantity) as soh FROM stocktable WHERE (description LIKE '%$searchme%' OR generic LIKE '%$searchme%') AND dept='$stk' GROUP BY code");
$asql=mysqli_query($mycon1,"SELECT r.code, r.description, r.generic, SUM(s.quantity) as soh, r.unit, r.pnf, r.lotno, r.testcode, r.gtestcode FROM stocktable s INNER JOIN receiving r WHERE (r.description LIKE '%$searchme%' OR r.generic LIKE '%$searchme%') AND s.dept='$stk' GROUP BY r.code");
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
      <td bgcolor='3380ff' width='80'><div align='center' class='arial s12 white bold'>&nbsp;SOH&nbsp;</div></td>
      <td bgcolor='3380ff' width='80'><div align='center' class='arial s12 white bold'>&nbsp;Qty&nbsp;</div></td>
      <td bgcolor='3380ff' width='130'><div align='center' class='arial s12 white bold'>&nbsp;&nbsp;</div></td>
      <td bgcolor='3380ff' width='150'><div align='center' class='arial s12 white bold'>&nbsp;Type&nbsp;</div></td>
    </tr>
  </table>
";


while($afetch=mysqli_fetch_array($asql)){
$co=$afetch['code'];
$ds=$afetch['description'];
$gn=$afetch['generic'];
$soh=$afetch['soh'];
$ty=$afetch['unit'];
$pnf=$afetch['pnf'];
$lot=$afetch['lotno'];
$gte=$afetch['gtestcode'];
$tes=$afetch['testcode'];


//$zsql=mysqli_query($mycon1,"SELECT unit, pnf, lotno, testcode, gtestcode FROM receiving WHERE code='$co'");
//$zfetch=mysqli_fetch_array($zsql);
//$ty=$zfetch['unit'];
// $pnf=$zfetch['pnf'];
// $lot=$zfetch['lotno'];
// $gte=$zfetch['gtestcode'];
// $tes=$zfetch['testcode'];

if($tes=="1"){
  $adt="MDRP";
}
else{
  $adt="";
}

//$ysql=mysqli_query($mycon1,"SELECT SUM(quantity) AS soh FROM stocktable WHERE code='$co' AND dept='$stk'");
//$yfetch=mysqli_fetch_array($ysql);
//$soh=$yfetch['soh'];

$ds=str_replace("cmshi-","",$ds);
$ds=str_replace("-sup","",$ds);
$ds=str_replace("-med","",$ds);
$ds=str_replace("ams-","",$ds);

if($gn!=""){
  $gndisp="($gn)";
}
else{
  $gndisp="";
}


if($pnf!="PNDF"){
$bg="bgcolor='#FF0000' title='NON PNDF $adt'";
}
else{
$bg="title='$adt'";
}


if($soh>0){
$a++;
echo "
  <form method='post' action='pospharma.php'>
  <table border='1' bordercolor='#000000' cellpadding='0' cellspacing='0'>
    <tr $bg>
      <td height='35' width='30'><div align='center' class='arial s14 black'>&nbsp;$a&nbsp;</div></td>
      <td height='35' width='400'><div align='left' class='arial s14 black'>&nbsp;".strtoupper($ds)." ".strtoupper($gndisp)."&nbsp;</div></td>
      <td height='35' width='80'><div align='center' class='arial s14 black'>&nbsp;$soh&nbsp;</div></td>
      <td height='35' width='80'><div align='center'>&nbsp;<input type='number' name='qty' style='width: 50px;height: 20px;padding: 5px;margin: 3px 0 3px 0;border: none;background: #eee;border-radius: 5px;font-size: 14px;text-align: center;border: 1px solid #000000;' value='1' required />&nbsp;</div></td>
      <td class='div-container' width='130'><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
";

if($gte=="1"){
echo "
      <td class='div-container' width='160'><div align='center' style='color: #c557ff;font-family: Arial;font-weight: bold;'>DISABLED</div></td>
";
}
else if($gte=="0"){
echo "
        <tr>
          <td width='5'></td>
          <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn' value='cash'>&nbsp;Cash&nbsp;</button></div></td>
          <td width='20'></td>
          <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn cancel' value='charge'>Charge</button></td>
          <td width='5'></td>
        </tr>
      </table></div></td>
";
}

echo "
      <td height='35' width='150'><div align='left' class='arial s13 black'>&nbsp;".strtoupper($ty)."&nbsp;</div></td>
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
  <input type='hidden' name='stk' value='$stk' />
  </form>
";
}
}


echo "
</div>
";
}
}

?>
</body>
</html>
