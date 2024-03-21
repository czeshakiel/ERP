<?php
if($status=="discharged"){
    $view="style='display:none;'";
}
else{
  if($result=="FINAL"){
    $view="style='display:none;'";
  }
  else{
    $view="";
  }
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

//ROOM-----------------------------------------------------------------------------------------------------------------------------------------------
$rmaeposql=mysqli_query($conn,"SELECT refno, invno, productcode, productdesc, sellingprice, CAST(sellingprice AS DECIMAL(10,2)) AS sp, quantity, adjustment, CAST(adjustment AS DECIMAL(10,2)) AS adj, gross, CAST(gross AS DECIMAL(10,2)) AS gr, phic, CAST(phic AS DECIMAL(10,2)) AS ph, phic1, CAST(phic1 AS DECIMAL(10,2)) AS ph1, hmo, CAST(hmo AS DECIMAL(10,2)) AS hm, excess, CAST(excess AS DECIMAL(10,2)) AS ex, productsubtype, administration, terminalname, status, datearray FROM productout WHERE caseno='$caseno' AND trantype='charge' AND quantity > 0 AND productsubtype='ROOM ACCOMODATION' ORDER BY productsubtype, productdesc, datearray");
while($rmaepofetch=mysqli_fetch_array($rmaeposql)){
$rmaerefno=$rmaepofetch['refno'];
$rmaeinvno=$rmaepofetch['invno'];
$rmaecode=$rmaepofetch['productcode'];
$rmaedesc=$rmaepofetch['productdesc'];
$rmaesp=$rmaepofetch['sellingprice'];
$rmaeqty=$rmaepofetch['quantity'];
$rmaeadj=$rmaepofetch['adjustment'];
$rmaegross=$rmaepofetch['gross'];
$rmaephic=$rmaepofetch['phic'];
$rmaephic1=$rmaepofetch['phic1'];
$rmaehmo=$rmaepofetch['hmo'];
$rmaeexcess=$rmaepofetch['excess'];
$rmaeptype=$rmaepofetch['productsubtype'];
$rmaetname=$rmaepofetch['administration'];
$rmaeterm=$rmaepofetch['terminalname'];
$rmaestat=strtoupper($rmaepofetch['status']);
$rmaedatea=$rmaepofetch['datearray'];

$rmaedesc=str_replace("ams-","",$rmaedesc);
$rmaedesc=str_replace("-sup","",$rmaedesc);
$rmaedesc=str_replace("-med","",$rmaedesc);

$consp=$rmaepofetch['sp'];
$conadj=$rmaepofetch['adj'];
$congross=$rmaepofetch['gr'];
$conphic=$rmaepofetch['ph'];
$conphic1=$rmaepofetch['ph1'];
$conhmo=$rmaepofetch['hm'];
$conexcess=$rmaepofetch['ex'];

$aeno++;
$totadj+=$rmaeadj;
$totgross+=$rmaegross;
$totphic1+=$rmaephic;
$totphic2+=$rmaephic1;
$tothmo+=$rmaehmo;
$totexcess+=$rmaeexcess;
$totgr+=$rmaesp*$rmaeqty;

$one=number_format(((($consp*$rmaeqty)-$conadj)*1),2);
$two=number_format(($congross*1),2);
$three=number_format((($conphic+$conphic1+$conhmo+$conexcess)*1),2);

$errdisrm="";
if($senior=="Y"){
  $kdis=$conadj*1;
  if($kdis==0){
    $errdisrm="quadrat";
  }
}

$bg="";
$delsty="style='width: 30px;height: 30px;border-radius: 15px;border: none;background-color: #fd6666;color: #FFFFFF;border: 1px solid #FF0000;' title='Delete Item'";
if(($one!=$two)||($two!=$three)){$bg="bgred white";$flag+=1;}
if($conexcess<0){$bg="bgred white";}

  $stat="";
  $delb="on";

if($rmaeptype=="PROFESSIONAL FEE"){$hei="600";}
else{$hei="540";}

echo "
    <tr>
      <td class='b1 l2 $bg' height='40'><div align='left' class='arial s16 black' style='font-size: 11px;'>&nbsp;$aeno&nbsp;</div></td>
      <td width='30' class='b1 l1 $bg'><div align='center'></div></td>
      <td width='80' class='b1 l1 $bg'><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
        <tr $view>
          <td width='3' class='$bg'></td>
          <td class='$bg buttonstyle'><button type='button' onclick='a1$rmaerefno()' style='width: 30px;height: 30px;border-radius: 15px;border: none;background-color: #4284cc;color: #FFFFFF;border: 1px solid #0f39c0;' class='butt' title='Edit Item'><i class='demo-icon icon-edit-1' style='font-size: 10px;'>&#xe8c8</i></button></td>
          <td width='5' class='$bg'></td>
          <td class='$bg buttonstyle'><button type='button' onclick='b1$rmaerefno()' class='butt' $delsty><i class='demo-icon icon-trash-2' style='font-size: 10px;'>&#xe8e1</i></button></td>
          <td width='3' class='$bg'></td>
        </tr>
      </table></div></td>
      <td class='b1 l1 $bg'><div align='left' class='arial s16 black' style='font-size: 11px;' title='$rmaedatea $rmaeinvno'>&nbsp;$rmaedesc&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='left' class='arial s16 black' style='font-size: 11px;'>&nbsp;$rmaeptype&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='center' class='arial s16 black' style='font-size: 11px;'>&nbsp;$rmaestat&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='left' class='arial s16 black' style='font-size: 11px;'>&nbsp;&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='font-size: 11px;'>&nbsp;$rmaesp&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='font-size: 11px;'>&nbsp;$rmaeqty&nbsp;</div></td>
      <td class='b1 l1 $bg $errdisrm'><div align='right' class='arial s16 black $errdisrm' style='font-size: 11px;'>&nbsp;$rmaeadj&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='font-size: 11px;'>&nbsp;$rmaegross&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='font-size: 11px;'>&nbsp;$rmaephic&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='font-size: 11px;'>&nbsp;$rmaephic1&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='font-size: 11px;'>&nbsp;$rmaehmo&nbsp;</div></td>
      <td class='b1 l1 r2 $bg'><div align='right' class='arial s16 black' style='font-size: 11px;'>&nbsp;$rmaeexcess&nbsp;</div></td>
    </tr>

<script>
function a1$rmaerefno() {
  window.open('edititem.php?caseno=$caseno&refno=$rmaerefno&user=$user', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=600,width=500,height=$hei');
}
</script>
";

if($delb=="on"){
echo "
<script>
function b1$rmaerefno() {
  window.open('deleteitem.php?caseno=$caseno&refno=$rmaerefno&user=$user&desc=$rmaedesc', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=600,width=500,height=150');
}
</script>
";
}

}
//END ROOM-------------------------------------------------------------------------------------------------------------------------------------------

$aeposql=mysqli_query($conn,"SELECT refno, invno, productcode, productdesc, sellingprice, CAST(sellingprice AS DECIMAL(10,2)) AS sp, quantity, adjustment, CAST(adjustment AS DECIMAL(10,2)) AS adj, gross, CAST(gross AS DECIMAL(10,2)) AS gr, phic, CAST(phic AS DECIMAL(10,2)) AS ph, phic1, CAST(phic1 AS DECIMAL(10,2)) AS ph1, hmo, CAST(hmo AS DECIMAL(10,2)) AS hm, excess, CAST(excess AS DECIMAL(10,2)) AS ex, productsubtype, administration, terminalname, status, approvalno, datearray FROM productout WHERE caseno='$caseno' AND trantype='charge' AND quantity > 0 AND productsubtype NOT LIKE 'ROOM ACCOMODATION' AND productsubtype NOT LIKE 'PROFESSIONAL FEE' ORDER BY productsubtype, productdesc, datearray");
while($aepofetch=mysqli_fetch_array($aeposql)){
$aerefno=$aepofetch['refno'];
$aeinvno=$aepofetch['invno'];
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
$aesapprovalno=$aepofetch['approvalno'];
$aesdatea=$aepofetch['datearray'];

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

$errdis="";
if($senior=="Y"){
  $kdis=$conadj*1;
  if($kdis==0){
    $errdis="quadrat";
  }
}

$bg="";
$pnflabel="";
$errphic="";
$errphic1="";
$delsty="style='width: 30px;height: 30px;border-radius: 15px;border: none;background-color: #fd6666;color: #FFFFFF;border: 1px solid #FF0000;' title='Delete Item'";
if(($one!=$two)||($two!=$three)){$bg="bgred white";$flag+=1;}
if($conexcess<0){$bg="bgred white";}

if(($aeptype=="PHARMACY/MEDICINE")||($aeptype=="PHARMACY/SUPPLIES")||($aeptype=="MEDICAL SURGICAL SUPPLIES")){
  $crtnsql=mysqli_query($conn,"SELECT *  FROM `productreturn` WHERE `refno1`='$aerefno' AND (`trantype`='pending' OR `trantype`='finalized')");
  $crtncount=mysqli_num_rows($crtnsql);

  $kpnfsql=mysqli_query($conn,"SELECT `pnf` FROM `receiving` WHERE `code`='$aecode'");
  $kpnfcount=mysqli_num_rows($kpnfsql);
  if($kpnfcount>0){
    $kpnffetch=mysqli_fetch_array($kpnfsql);
    $kpnf=$kpnffetch['pnf'];
    if($kpnf=="PNDF"){
      $pnflabel="<span style='color: blue;font-size: 11px;'> (PNDF)</span>";
    }
    else if(($kpnf=="NPNDF")||($kpnf=="NON-PNDF")){
      $pnflabel="<span style='color: #FF0000;font-weight: bold;font-size: 11px;'> (NON-PNDF)</span>";
      if($aephic>0){
        $errphic="quadrat";
      }
      if($aephic1>0){
        $errphic1="quadrat";
      }
    }
    else{
      $pnflabel="<span style='color: #FF0000;font-weight: bold;font-size: 11px;'> (ERROR! Contact pharmacy to set pndf or non-pndf label.)</span>";
    }
  }
  else{
    $pnflabel="";
  }

  if($aetname=="pending"){
    $stat="Pending";
    $bg="bgyellow";
  }
  else if($aetname=="dispensed"){
    if($crtncount!=0){
      $crtnfetch=mysqli_fetch_array($crtnsql);
      $retqty=$crtnfetch['quantity1'];
      $stat="<span style='color: #FF0000;font-weight: bold;'>For Return </span><span style='font-size: 10px;color: #FF0000;'>($retqty Item/s.)</span>";
      $bg="bgorange";
    }
    else{
      $stat="Dispensed";
      $bg="bgyellow";
    }
  }
  else if(($aetname=="administered")||($aetname=="Administered")){
    $stat="Administered";
  }

  $delb="off";
  $delsty="style='width: 30px;height: 30px;border-radius: 15px;border: none;background-color: #d9d9d9;color: #FFFFFF;border: 1px solid #c2c2c2;' title='Delete Item Disabled' disabled";
}
else if(($aeptype=="LABORATORY")||($aeptype=="EEG")||($aeptype=="ECG")||($aeptype=="HEARTSTATION")){
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
  else if($aeterm=="Testtobedone"){
    $stat="Test to be done";
    $delb="on";
  }
  else{
    $stat="";
    $delb="on";
  }
}
else if(($aeptype=="XRAY")||($aeptype=="MAMMOGRAPHY")||($aeptype=="ULTRASOUND")||($aeptype=="CT SCAN")){
  if($aeterm=="pending"){
    if($aesapprovalno!=""){
      $stat="Processed";
      $delb="off";
      $delsty="style='width: 30px;height: 30px;border-radius: 15px;border: none;background-color: #d9d9d9;color: #FFFFFF;border: 1px solid #c2c2c2;' title='Delete Item Disabled' disabled";
    }
    else{
      $stat="Pending";
      $delb="on";
      $bg="bglightred";
    }
  }
  else if($aeterm=="Testdone"){
    $stat="Test Done";
    $delb="off";
    $delsty="style='width: 30px;height: 30px;border-radius: 15px;border: none;background-color: #d9d9d9;color: #FFFFFF;border: 1px solid #c2c2c2;' title='Delete Item Disabled' disabled";
  }
  else if($aeterm=="Testtobedone"){
    $stat="Test to be done";
    $delb="on";
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

if($aeptype=="PROFESSIONAL FEE"){$hei="600";}
else if(($aeptype=="ECG")||($aeptype=="LABORATORY")){$hei="600";}
else{$hei="540";}

echo "
    <tr>
      <td class='b1 l2 $bg' height='40'><div align='left' class='arial s16 black' style='font-size: 11px;'>&nbsp;$aeno&nbsp;</div></td>
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

//REMARKS FOR RT HAZZARD---------------------------------------------------------------------------
if($aecode=="210906184316p-50"){
$rmsql=mysqli_query($conn,"SELECT `remarks` FROM `labtest` WHERE `refno`='$aerefno'");
$rmcount=mysqli_num_rows($rmsql);
  if($rmcount==0){
    $rm="";
  }
  else{
    $rmfetch=mysqli_fetch_array($rmsql);
    $rm=strtoupper($rmfetch['remarks']);
  }
}
elseif($aeptype=="LABORATORY"){
$rmsql=mysqli_query($conn,"SELECT `remarks` FROM `labtest` WHERE `refno`='$aerefno'");
$rmcount=mysqli_num_rows($rmsql);
  if($rmcount==0){
    $rm="";
  }
  else{
    $rmfetch=mysqli_fetch_array($rmsql);
    $rm=strtoupper($rmfetch['remarks']);
  }
}
else{
  $rm="";
}

if($rm!=""){
  $rmdisp="<span style='font-size: 10px;font-family: arial;color: blue;'>($rm)</span>";
}
else{
  $rmdisp="";
}
//-------------------------------------------------------------------------------------------------


//0 GROSS Alert------------------------------------------------------------------------------------
if($aegross<1){
  $errgross="quadrat";
  $errgrosstitle="Net is zero!";
}
else{
  $errgross="";
  $errgrosstitle="";
}
//-------------------------------------------------------------------------------------------------

echo "
      </div></td>
      <td width='80' class='b1 l1 $bg'><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
        <tr $view>
          <td width='3' class='$bg'></td>
          <td class='$bg buttonstyle'><button type='button' onclick='a1$aerefno()' style='width: 30px;height: 30px;border-radius: 15px;border: none;background-color: #4284cc;color: #FFFFFF;border: 1px solid #0f39c0;' class='butt' title='Edit Item'><i class='demo-icon icon-edit-1' style='font-size: 10px;'>&#xe8c8</i></button></td>
          <td width='5' class='$bg'></td>
          <td class='$bg buttonstyle'><button type='button' onclick='b1$aerefno()' class='butt' $delsty><i class='demo-icon icon-trash-2' style='font-size: 10px;'>&#xe8e1</i></button></td>
          <td width='3' class='$bg'></td>
        </tr>
      </table></div></td>
      <td class='b1 l1 $bg'><div align='left' class='arial s16 black' style='font-size: 11px;' title='$aesdatea $aeinvno'>&nbsp;".$aedesc.$rmdisp.$pnflabel."&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='left' class='arial s16 black' style='font-size: 11px;'>&nbsp;$aeptype&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='center' class='arial s16 black' style='font-size: 11px;'>&nbsp;$aestat&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='left' class='arial s16 black' style='font-size: 11px;'>&nbsp;$stat&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='font-size: 11px;'>&nbsp;$aesp&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='font-size: 11px;'>&nbsp;$aeqty&nbsp;</div></td>
      <td class='b1 l1 $bg $errdis'><div align='right' class='arial s16 black $errdis' style='font-size: 11px;'>&nbsp;$aeadj&nbsp;</div></td>
      <td class='b1 l1 $bg $errgross' title='$errgrosstitle'><div align='right' class='arial s16 black' style='font-size: 11px;'>&nbsp;$aegross&nbsp;</div></td>
      <td class='b1 l1 $bg $errphic'><div align='right' class='arial s16 black $errphic' style='font-size: 11px;'>&nbsp;$aephic&nbsp;</div></td>
      <td class='b1 l1 $bg $errphic1'><div align='right' class='arial s16 black $errphic1' style='font-size: 11px;'>&nbsp;$aephic1&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='font-size: 11px;'>&nbsp;$aehmo&nbsp;</div></td>
      <td class='b1 l1 r2 $bg'><div align='right' class='arial s16 black' style='font-size: 11px;'>&nbsp;$aeexcess&nbsp;</div></td>
    </tr>

<script>
function a1$aerefno() {
  window.open('edititem.php?caseno=$caseno&refno=$aerefno&user=$user', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=600,width=500,height=$hei');
}
</script>
";

if($delb=="on"){
echo "
<script>
function b1$aerefno() {
  window.open('deleteitem.php?caseno=$caseno&refno=$aerefno&user=$user&desc=$aedesc', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=600,width=500,height=150');
}
</script>
";
}

}


//PF-------------------------------------------------------------------------------------------------------------------------------------------------
$pfaeposql=mysqli_query($conn,"SELECT refno, productcode, productdesc, sellingprice, CAST(sellingprice AS DECIMAL(10,2)) AS sp, quantity, adjustment, CAST(adjustment AS DECIMAL(10,2)) AS adj, gross, CAST(gross AS DECIMAL(10,2)) AS gr, phic, CAST(phic AS DECIMAL(10,2)) AS ph, phic1, CAST(phic1 AS DECIMAL(10,2)) AS ph1, hmo, CAST(hmo AS DECIMAL(10,2)) AS hm, excess, CAST(excess AS DECIMAL(10,2)) AS ex, producttype, productsubtype, administration, terminalname, status, datearray FROM productout WHERE caseno='$caseno' AND trantype='charge' AND quantity > 0 AND productsubtype='PROFESSIONAL FEE' ORDER BY productsubtype, productdesc, datearray");
while($pfaepofetch=mysqli_fetch_array($pfaeposql)){
$pfaerefno=$pfaepofetch['refno'];
$pfaecode=$pfaepofetch['productcode'];
$pfaedesc=$pfaepofetch['productdesc'];
$pfaesp=$pfaepofetch['sellingprice'];
$pfaeqty=$pfaepofetch['quantity'];
$pfaeadj=$pfaepofetch['adjustment'];
$pfaegross=$pfaepofetch['gross'];
$pfaephic=$pfaepofetch['phic'];
$pfaephic1=$pfaepofetch['phic1'];
$pfaehmo=$pfaepofetch['hmo'];
$pfaeexcess=$pfaepofetch['excess'];
$pfaeprotype=$pfaepofetch['producttype'];
$pfaeptype=$pfaepofetch['productsubtype'];
$pfaetname=$pfaepofetch['administration'];
$pfaeterm=$pfaepofetch['terminalname'];
$pfaestat=strtoupper($pfaepofetch['status']);
$pfaedatea=$pfaepofetch['datearray'];

$pfaedesc=str_replace("ams-","",$pfaedesc);
$pfaedesc=str_replace("-sup","",$pfaedesc);
$pfaedesc=str_replace("-med","",$pfaedesc);

$consp=$pfaepofetch['sp'];
$conadj=$pfaepofetch['adj'];
$congross=$pfaepofetch['gr'];
$conphic=$pfaepofetch['ph'];
$conphic1=$pfaepofetch['ph1'];
$conhmo=$pfaepofetch['hm'];
$conexcess=$pfaepofetch['ex'];

$aeno++;
$totadj+=$pfaeadj;
$totgross+=$pfaegross;
$totphic1+=$pfaephic;
$totphic2+=$pfaephic1;
$tothmo+=$pfaehmo;
$totexcess+=$pfaeexcess;
$totgr+=$pfaesp*$pfaeqty;

$one=number_format(((($consp*$pfaeqty)-$conadj)*1),2);
$two=number_format(($congross*1),2);
$three=number_format((($conphic+$conphic1+$conhmo+$conexcess)*1),2);

$errdispf="";
if($senior=="Y"){
  $kdis=$conadj*1;
  if($kdis==0){
    $errdispf="quadrat";
  }
}

$bg="";
$delsty="style='width: 30px;height: 30px;border-radius: 15px;border: none;background-color: #fd6666;color: #FFFFFF;border: 1px solid #FF0000;' title='Delete Item'";
if(($one!=$two)||($two!=$three)){$bg="bgred white";$flag+=1;}
if($conexcess<0){$bg="bgred white";}

  $stat="";
  $delb="on";

if($pfaeptype=="PROFESSIONAL FEE"){$hei="600";}else{$hei="540";}

echo "
    <tr>
      <td class='b1 l2 $bg' height='40'><div align='left' class='arial s16 black' style='font-size: 11px;'>&nbsp;$aeno&nbsp;</div></td>
      <td width='30' class='b1 l1 $bg'><div align='center'></div></td>
      <td width='80' class='b1 l1 $bg'><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
        <tr $view>
          <td width='3' class='$bg'></td>
          <td class='$bg buttonstyle'><button type='button' onclick='a1$pfaerefno()' style='width: 30px;height: 30px;border-radius: 15px;border: none;background-color: #4284cc;color: #FFFFFF;border: 1px solid #0f39c0;' class='butt' title='Edit Item'><i class='demo-icon icon-edit-1' style='font-size: 10px;'>&#xe8c8</i></button></td>
          <td width='5' class='$bg'></td>
          <td class='$bg buttonstyle'><button type='button' onclick='b1$pfaerefno()' class='butt' $delsty><i class='demo-icon icon-trash-2' style='font-size: 10px;'>&#xe8e1</i></button></td>
          <td width='3' class='$bg'></td>
        </tr>
      </table></div></td>
      <td class='b1 l1 $bg'><div align='left' class='arial'>&nbsp;<span class='s16 black' title='$pfaedatea'>$pfaedesc</span> <span class='s13 blue'>($pfaeprotype)</span>&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='left' class='arial s16 black' style='font-size: 11px;'>&nbsp;$pfaeptype&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='center' class='arial s16 black' style='font-size: 11px;'>&nbsp;$pfaestat&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='left' class='arial s16 black' style='font-size: 11px;'>&nbsp;&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='font-size: 11px;'>&nbsp;$pfaesp&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='font-size: 11px;'>&nbsp;$pfaeqty&nbsp;</div></td>
      <td class='b1 l1 $bg $errdispf'><div align='right' class='arial s16 black $errdispf'>&nbsp;$pfaeadj&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='font-size: 11px;'>&nbsp;$pfaegross&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='font-size: 11px;'>&nbsp;$pfaephic&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='font-size: 11px;'>&nbsp;$pfaephic1&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='font-size: 11px;'>&nbsp;$pfaehmo&nbsp;</div></td>
      <td class='b1 l1 r2 $bg'><div align='right' class='arial s16 black' style='font-size: 11px;'>&nbsp;$pfaeexcess&nbsp;</div></td>
    </tr>

<script>
function a1$pfaerefno() {
  window.open('edititem.php?caseno=$caseno&refno=$pfaerefno&user=$user', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=600,width=500,height=$hei');
}
</script>
";

if($delb=="on"){
echo "
<script>
function b1$pfaerefno() {
  window.open('deleteitem.php?caseno=$caseno&refno=$pfaerefno&user=$user&desc=$pfaedesc', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=600,width=500,height=150');
}
</script>
";
}

}
//END PF---------------------------------------------------------------------------------------------------------------------------------------------


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
