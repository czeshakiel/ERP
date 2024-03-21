<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="Resources/Favicon/favicon.png" type="image/png" />
<link rel="shortcut icon" href="Resources/Favicon/favicon.png" type="image/png" />
<title>SEARCH CHARGES</title>
<link href="../Resources/CSS/mystyle.css" rel="stylesheet" type="text/css" />
<style style="text/css">
.hoverTable{width:100%; border-collapse:collapse;}
.hoverTable td{padding:7px; border:#4e95f4 1px solid;}

.div-container input[type=text], .div-container input[type=password] {width: 450px;height: 30px;padding: 7px;margin: 5px 0 5px 0;border: none;background: #eee;border-radius: 10px;font-size: 18px;font-weight: bold;border: 2px solid #000000;}
.div-container select {height: 40px;padding: 7px;margin: 5px 0 5px 0;border: none;background: #eee;}
.div-container input[type=text]:focus, .div-container input[type=password]:focus, .div-container select:focus {background-color: #ddd;outline: none;}
.div-container .btn {background-color: #8ebf42;color: #fff;padding: 5px 10px;border: none;cursor: pointer;opacity: 0.8;border-radius: 5px;}
.div-container .cancel {background-color: #cc0000;}
.div-container .btn:hover, .open-button:hover {opacity: 1;}

/* Define the hover highlight color for the table row */
.hoverTable tr:hover {background-color: #ffff99;}
</style>
</head>

<body onload="placeFocus()">
<?php
header("Refresh:300");
ini_set("display_errors","On");
include("../Settings.php");
$cuz = new database();
$setip=$cuz->setIP();

$caseno=mysqli_real_escape_string($mycon1,$_GET['caseno']);
$station=mysqli_real_escape_string($mycon1,$_GET['station']);
$toh=mysqli_real_escape_string($mycon1,$_GET['toh']);
$tick=mysqli_real_escape_string($mycon1,$_GET['tick']);
$stk=mysqli_real_escape_string($mycon1,$_GET['stk']);

  //KNOW CREDIT LEFT-----------------------------
  $fsql=mysqli_query($mycon1,"SELECT SUM((sellingprice * quantity)-adjustment) AS totgross FROM productout WHERE caseno='$caseno' AND trantype='charge'");
  $ffetch=mysqli_fetch_array($fsql);
  $totgross=$ffetch['totgross'];
  //---------------------------------------------

if (!isset($_COOKIE["ccpass"])){
header("location: ../ChargeCart/?caseno=$caseno&station=$station&toh=$toh");
}
else{

  if(isset($_GET['searchme'])){
    $ss=mysqli_real_escape_string($mycon1,$_GET['searchme']);
  }
  else{
    $ss="";
  }

echo "
<div align='left'>
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <!-- td><input type='button' onclick=MM_openBrWindow('http://$setip/cgi-bin/printallsup2.cgi?ticketno=$tick&amp;caseno=$caseno','','toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes,width=800,height=800') value='CHARGE SLIP NO. $tick' /></td -->
          <td><input type='button' onclick=MM_openBrWindow('http://$setip/cgi-bin/nsprintps1.cgi?ticketno=$tick&amp;caseno=$caseno','','toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes,width=800,height=800') value='STANDARD CHARGE SLIP NO. $tick' /></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height='10'><div align='left' class='arial s14 bold'>$toh CART | USER: <span class='blue'>".$_COOKIE["ccname"]."</span></div></td>
    </tr>
    <tr class='div-container'>
      <form name='searchme' method='get'>
      <td><input name='searchme' type='text' autocomplete='off' placeholder='Type item name and press enter...' onKeyUp='showResult();' value='$ss' /></td>
      <input type='hidden' name='caseno' value='$caseno' />
      <input type='hidden' name='station' value='$station' />
      <input type='hidden' name='toh' value='$toh' />
      <input type='hidden' name='tick' value='$tick' />
      <input type='hidden' name='stk' value='$stk' />
      </form>
    </tr>
    <tr>
      <td height='10'></td>
    </tr>
    <tr>
      <td><div align='left'>
";

if(isset($_GET['searchme'])){
$searchme=mysqli_real_escape_string($mycon1,$_GET['searchme']);

$len=strlen($searchme);
if($len>2){
$zsql=mysqli_query($mycon1,"SELECT membership, hmomembership FROM admission WHERE caseno='$caseno'");
$zfetch=mysqli_fetch_array($zsql);
$membership=$zfetch['membership'];
$hmomembership=$zfetch['hmomembership'];

$a=0;
$asql=mysqli_query($mycon1,"SELECT code, description, generic FROM stocktable WHERE description LIKE '%$searchme%' AND dept='RDU' GROUP BY code");
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

$zsql=mysqli_query($mycon1,"SELECT unit, pnf, lotno, testcode, gtestcode FROM receiving WHERE code='$co'");
$zfetch=mysqli_fetch_array($zsql);
$ty=$zfetch['unit'];
$pnf=$zfetch['pnf'];
$lot=$zfetch['lotno'];
$gte=$zfetch['gtestcode'];
$tes=$zfetch['testcode'];

if($tes=="1"){
  $adt="MDRP";
}
else{
  $adt="";
}

$ysql=mysqli_query($mycon1,"SELECT SUM(quantity) AS soh FROM stocktable WHERE code='$co' AND dept='RDU'");
$yfetch=mysqli_fetch_array($ysql);
$soh=$yfetch['soh'];

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
  <input type='hidden' name='stk' value='RDU' />
  </form>
";
}
}

}
}
}

echo "
      </div></td>
    </tr>
    <tr>
      <td><div align='left' style='font-family: courier;font-size: 14px;color: blue;padding-left: 5px;'>Nothing follows...</td>
    </tr>
    <tr>
      <td height='10'></td>
    </tr>
";

$a=0;
$asql=mysqli_query($mycon1,"SELECT refno, productdesc, quantity, trantype FROM productout WHERE caseno='$caseno' AND batchno='$tick'");
$acount=mysqli_num_rows($asql);

if($acount!=0){
echo "
    <tr>
      <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td class='t2 b2'><div align='center' class='arial s11 black bold'>#</div></td>
          <td class='t2 b2' width='400'><div align='center' class='arial s11 black bold'>Description</div></td>
          <td class='t2 b2' width='50'><div align='center' class='arial s11 black bold'>Quantity</div></td>
          <td class='t2 b2' width='50'><div align='center' class='arial s11 black bold'></div></td>
        </tr>
";


while($afetch=mysqli_fetch_array($asql)){
$refno=$afetch['refno'];
$desc=$afetch['productdesc'];
$quan=$afetch['quantity'];
$tran=$afetch['trantype'];
$a++;

echo "
        <tr>
          <td class='b1' width='30' height='20'><div align='left' class='arial s13 black'>$a</div></td>
          <td class='b1'><div align='left' class='arial s13 black'>$desc <span style='color: red;'>($tran)</span></div></td>
          <td class='b1' width='50'><div align='center' class='arial s13 black'>$quan</div></td>
        </tr>
";
}

echo "
      </table></div></td>
    </tr>
";
}

echo "
  </table>
</div>
";
}

?>
</body>
</html>
