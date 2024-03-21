<?php
if($status=="discharged"){
  $view="style='display:none;'";
}else{
  $view="";
}
echo "
<div align='left'>
  <form name='Update' method='post' target='_blank' action='updatetocashprice.php'>
  <table border='0' width='100%' cellpadding='0' cellspacing='0' class='hoverTable'>
    <tr>
      <td class='t2 b2 l2' height='15'><div align='center' class='arial s11 black bold'>&nbsp;#&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='arial s11 black bold'>&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='arial s11 black bold'>&nbsp;Action&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='arial s11 black bold'>&nbsp;Description&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='arial s11 black bold'>&nbsp;Type&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='arial s11 black bold'>&nbsp;Pay. Stat&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='arial s11 black bold'>&nbsp;Status&nbsp;</div></td>
      <td class='t2 b2 l1' width='80'><div align='center' class='arial s11 black bold'>&nbsp;SP&nbsp;</div></td>
      <td class='t2 b2 l1' width='80'><div align='center' class='arial s11 black bold'>&nbsp;Qty.&nbsp;</div></td>
      <td class='t2 b2 l1' width='80'><div align='center' class='arial s11 black bold'>&nbsp;Discount&nbsp;</div></td>
      <td class='t2 b2 l1' width='80'><div align='center' class='arial s11 black bold'>&nbsp;Net&nbsp;</div></td>
      <td class='t2 b2 l1' width='80'><div align='center' class='arial s11 black bold'>&nbsp;CR 1&nbsp;</div></td>
      <td class='t2 b2 l1' width='80'><div align='center' class='arial s11 black bold'>&nbsp;CR 2&nbsp;</div></td>
      <td class='t2 b2 l1' width='80'><div align='center' class='arial s11 black bold'>&nbsp;HMO&nbsp;</div></td>
      <td class='t2 b2 l1 r2' width='80'><div align='center' class='arial s11 black bold'>&nbsp;Excess&nbsp;</div></td>
    </tr>
";

$aeno=0;
$totadj=0;
$totgross=0;
$totphic1=0;
$totphic2=0;
$tothmo=0;
$totexcess=0;
$totgr=0;
$flag=0;
$aeposql=mysqli_query($conn,"SELECT refno, productcode, productdesc, sellingprice, CAST(sellingprice AS DECIMAL(10,2)) AS sp, quantity, adjustment, CAST(adjustment AS DECIMAL(10,2)) AS adj, gross, CAST(gross AS DECIMAL(10,2)) AS gr, phic, CAST(phic AS DECIMAL(10,2)) AS ph, phic1, CAST(phic1 AS DECIMAL(10,2)) AS ph1, hmo, CAST(hmo AS DECIMAL(10,2)) AS hm, excess, CAST(excess AS DECIMAL(10,2)) AS ex, productsubtype, administration, terminalname, status, batchno FROM productout WHERE caseno='$caseno' AND trantype='cash' AND quantity > 0 ORDER BY productsubtype, productdesc, datearray");
while($aepofetch=mysqli_fetch_array($aeposql)){
$aerefno=$aepofetch['refno'];
$aecode=$aepofetch['productcode'];
$aedesc=$aepofetch['productdesc'];
$aesp=$aepofetch['sellingprice'];
$aeqty=$aepofetch['quantity'];
$aeadj=$aepofetch['adjustment'];
$aegross=$aepofetch['gross'];
$aephic=$aepofetch['phic'];
$aephic1=$aepofetch['phic1'];
$aehmo=$aepofetch['hmo'];
$aeexcess=$aepofetch['excess'];
$aeptype=$aepofetch['productsubtype'];
$aetname=$aepofetch['administration'];
$aeterm=$aepofetch['terminalname'];
$aestat=strtoupper($aepofetch['status']);
$aebatchno=$aepofetch['batchno'];

$aedesc=str_replace("ams-","",$aedesc);
$aedesc=str_replace("-sup","",$aedesc);
$aedesc=str_replace("-med","",$aedesc);

$consp=$aepofetch['sp'];
$conadj=$aepofetch['adj'];
$congross=$aepofetch['gr'];
$conphic=$aepofetch['ph'];
$conphic1=$aepofetch['ph1'];
$conhmo=$aepofetch['hm'];
$conexcess=$aepofetch['ex'];

$aeno++;
$totadj+=$aeadj;
$totgross+=$aegross;
$totphic1+=$aephic;
$totphic2+=$aephic1;
$tothmo+=$aehmo;
$totexcess+=$aeexcess;
$totgr+=$aesp*$aeqty;

$one=number_format(((($consp*$aeqty)-$conadj)*1),2);
$two=number_format(($congross*1),2);
$three=number_format((($conphic+$conphic1+$conhmo+$conexcess)*1),2);


$bg="";
$delb="on";
$delsty="style='width: 30px;height: 30px;border-radius: 15px;border: none;background-color: #fd6666;color: #FFFFFF;border: 1px solid #FF0000;' title='Delete Item'";
if(($one!=$two)||($two!=$three)){$bg="bgred white";$flag+=1;}
if($conexcess<0){$bg="bgred white";}

if(($aeptype=="PHARMACY/MEDICINE")||($aeptype=="PHARMACY/SUPPLIES")||($aeptype=="MEDICAL SURGICAL SUPPLIES")||($aeptype=="MEDICAL SUPPLIES")){
  if($aetname=="pending"){
    $stat="Pending";
    $bg="bgyellow";
  }
  else if($aetname=="dispensed"){
    $stat="Dispensed";
    $bg="bgyellow";
  }
  else if($aetname=="administered"){
    $stat="Administered";
  }

  $delb="off";
  $delsty="style='width: 30px;height: 30px;border-radius: 15px;border: none;background-color: #d9d9d9;color: #FFFFFF;border: 1px solid #c2c2c2;' title='Delete Item Disabled' disabled";
}
else if(($aeptype=="LABORATORY")||($aeptype=="XRAY")||($aeptype=="MAMMOGRAPHY")||($aeptype=="ULTRASOUND")||($aeptype=="EEG")||($aeptype=="ECG")||($aeptype=="CT SCAN")||($aeptype=="HEARTSTATION")){
  if($aeterm=="pending"){
    $stat="Pending";
    $delb="on";
    $bg="bglightred";
  }
  else if($aeterm=="Testdone"){
    $stat="Test Done";
    $delb="off";
    $delsty="style='width: 30px;height: 30px;border-radius: 15px;border: none;background-color: #d9d9d9;color: #FFFFFF;border: 1px solid #c2c2c2;' title='Delete Item Disabled' disabled";
  }
  else{
    $stat="";
    $delb="on";
  }
}
else{
  $stat="";
  $delb="on";
}

$editb="on";
$editdis="";
$editsty="style='width: 30px;height: 30px;border-radius: 15px;border: none;background-color: #4284cc;color: #FFFFFF;border: 1px solid #0f39c0;' title='Edit Item'";
if($aestat=="PAID"){
  $editb="off";
  $editdis="disabled";
  $editsty="style='width: 30px;height: 30px;border-radius: 15px;border: none;background-color: #d9d9d9;color: #FFFFFF;border: 1px solid #c2c2c2;' title='Edit Item Disabled' disabled";
  $delb="off";
  $delsty="style='width: 30px;height: 30px;border-radius: 15px;border: none;background-color: #d9d9d9;color: #FFFFFF;border: 1px solid #c2c2c2;' title='Delete Item Disabled' disabled";
}

if($aeptype=="PROFESSIONAL FEE"){$hei="600";}else{$hei="540";}

echo "
    <tr>
      <td class='b1 l2 $bg' height='40'><div align='left' class='arial s16 black'>&nbsp;$aeno&nbsp;</div></td>
      <td width='30' class='b1 l1 $bg'><div align='center'>
";

if(($aeptype=="LABORATORY")||($aeptype=="XRAY")){
  if(($aephic>0)||($aephic1>0)||($aehmo>0)){

  }
  else{
    echo "
            <input type='checkbox' name='refno[]' value='$aerefno' />
    ";
  }

}

echo "
      </div></td>
      <td width='80' class='b1 l1 $bg'><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
        <tr $view>
          <td width='3' class='$bg'></td>
          <td class='$bg buttonstyle'><button type='button' onclick='a1$aerefno()' class='butt' $editsty><i class='demo-icon icon-edit-1' style='font-size: 10px;'>&#xe8c8</i></button></td>
          <td width='5' class='$bg'></td>
           <td class='$bg buttonstyle'><button type='button' onclick='b1$aerefno()' class='butt' $delsty><i class='demo-icon icon-trash-2' style='font-size: 10px;'>&#xe8e1</i></button></td>
          <td width='3' class='$bg'></td>
        </tr>
      </table></div></td>
";


// --------------------- ARVID 2021-12-02 ---------------------------
$ofr="";
$estat = $aestat;
if($aestat=="PAID"){

if($stat=="Administered"){
$aeposql1=mysqli_query($conn,"SELECT * from productout where refno = '$aerefno'");
while($aepofetch1=mysqli_fetch_array($aeposql1)){
$refnodis=$aepofetch1['referenceno'];}

$aeposql12=mysqli_query($conn,"SELECT * from productout where refno = '$refnodis'");
while($aepofetch12=mysqli_fetch_array($aeposql12)){
$refnopen=$aepofetch12['referenceno'];}
}

elseif($stat=="Dispensed"){
$aeposql13=mysqli_query($conn,"SELECT * from productout where refno = '$aerefno'");
while($aepofetch13=mysqli_fetch_array($aeposql13)){
$refnopen=$aepofetch13['referenceno'];}
}

else{$refnopen = $aerefno;}

$aeposql14=mysqli_query($conn,"SELECT * from collection where refno = '$refnopen'");
while($aepofetch14=mysqli_fetch_array($aeposql14)){
$ofr=$aepofetch14['ofr'];}
$estat = $aestat." - ".$ofr;
}

if($aeptype == "LABORATORY"){
$rem="";
$aeposql15=mysqli_query($conn,"SELECT * from labtest where refno='$aerefno' and caseno='$caseno'");
while($aepofetch15=mysqli_fetch_array($aeposql15)){
$rem=$aepofetch15['remarks'];}

if($rem!=""){$aedesc = $aedesc. "<font size='1' color='blue'> (".$rem.")</font>";}
}
// -----------------------------------------------------------------


if($aecode=="210826135500p-8"){
echo "
      <td class='b1 l1 $bg'><a href='http://$setip/cgi-bin/printallsup3.cgi?refno=$aerefno&ticketno=$aebatchno&caseno=$caseno' target='_blank' style='text-decoration: none;'><div align='left' class='arial s16 black'>&nbsp;$aedesc&nbsp;</div></a></td>
";
}
else{
echo "
      <td class='b1 l1 $bg'><div align='left' class='arial s16 black'>&nbsp;$aedesc&nbsp</div></td>
";
}


echo "
      <td class='b1 l1 $bg'><div align='left' class='arial s16 black'>&nbsp;$aeptype&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='center' class='arial s16 black'>&nbsp;$estat</div></td>
      <td class='b1 l1 $bg'><div align='left' class='arial s16 black'>&nbsp;$stat&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black'>&nbsp;$aesp&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black'>&nbsp;$aeqty&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black'>&nbsp;$aeadj&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black'>&nbsp;$aegross&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black'>&nbsp;$aephic&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black'>&nbsp;$aephic1&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black'>&nbsp;$aehmo&nbsp;</div></td>
      <td class='b1 l1 r2 $bg'><div align='right' class='arial s16 black'>&nbsp;$aeexcess&nbsp;</div></td>
    </tr>
";

if($editb=="on"){
echo "
<script>
function a1$aerefno() {
  window.open('edititem.php?caseno=$caseno&refno=$aerefno&user=$user', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=600,width=500,height=$hei');
}
</script>
";
}

if($delb=="on"){
echo "
<script>
function b1$aerefno() {
  window.open('deleteitem.php?caseno=$caseno&refno=$aerefno&user=$user&desc=$aedesc', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=300,left=600,width=500,height=150');
}
</script>
";
}

}

echo "
    <tr>
      <td class='t2 b2 l2' colspan='7' height='30'><div align='left' class='arial s14 black bold'>&nbsp;TOTAL&nbsp;</div></td>
      <td class='t2 b2 l1' colspan='2'><div align='right' class='arial s14 black bold'>&nbsp;".number_format($totgr,2)."&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='right' class='arial s14 black bold'>&nbsp;".number_format($totadj,2)."&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='right' class='arial s14 black bold'>&nbsp;".number_format($totgross,2)."&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='right' class='arial s14 black bold'>&nbsp;".number_format($totphic1,2)."&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='right' class='arial s14 black bold'>&nbsp;".number_format($totphic2,2)."&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='right' class='arial s14 black bold'>&nbsp;".number_format($tothmo,2)."&nbsp;</div></td>
      <td class='t2 b2 l1 r2'><div align='right' class='arial s14 black bold'>&nbsp;".number_format($totexcess,2)."&nbsp;</div></td>
    </tr>
  </table>
  <!-- br />
  <input type='submit' value='Update Price' />
  </form -->
</div>
";
?>
