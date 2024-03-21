<?php
echo "
<div a1lign='left'>
";

$zsql=mysqli_query($mycon1,"SELECT membership, hmomembership FROM admission WHERE caseno='$caseno'");
$zfetch=mysqli_fetch_array($zsql);
$membership=$zfetch['membership'];
$hmomembership=$zfetch['hmomembership'];

$a=0;
$asql=mysqli_query($mycon1,"SELECT * FROM receiving WHERE code='1000582n-3' OR code='10007110p-3' OR code='110002625n-3' OR code='110003885n-5' OR code='L62p-3' OR code='L139p-3' OR code='L135p-3' OR code='L1000p-3' OR code='L32p-3' ORDER BY description");
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

$ds=str_replace("cmshi-","",$ds);
$ds=str_replace("-sup","",$ds);
$ds=str_replace("-med","",$ds);
$ds=str_replace("ams-","",$ds);

$a++;

echo "
  <form method='get' action='ccchargesremarks-lab.php'>
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

if($ccacce=="4"){
echo "
          <td width='20'></td>
          <td height='35' valign='middle'><div align='center'><button type='submit' name='trantype' class='btn tpl' value='tpl' title='To Pay Later'>&nbsp;TPL&nbsp;</button></td>
";
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

?>
