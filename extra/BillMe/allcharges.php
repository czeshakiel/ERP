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
      <td class='t2 b2 l2' height='15'><div align='center' class='arial s11 black bold' style='padding: 3px;'>#</div></td>
      <td class='t2 b2 l1'><div align='center' class='arial s11 black bold' style='padding: 3px;'></div></td>
      <td class='t2 b2 l1'><div align='center' class='arial s11 black bold' style='padding: 3px;'>Action</div></td>
      <td class='t2 b2 l1'><div align='center' class='arial s11 black bold' style='padding: 3px;'>Description</div></td>
";

if($dept=="RDU"){
echo "
      <td class='t2 b2 l1' width='150'><div align='center' class='arial s11 black bold' style='padding: 3px;'>&nbspDate/Time</div></td>
";
}

echo "
      <td class='t2 b2 l1'><div align='center' class='arial s11 black bold' style='padding: 3px;'>Type</div></td>
      <td class='t2 b2 l1'><div align='center' class='arial s11 black bold' style='padding: 3px;'>Pay. Stat</div></td>
      <td class='t2 b2 l1'><div align='center' class='arial s11 black bold' style='padding: 3px;'>Status</div></td>
      <td class='t2 b2 l1' width='80'><div align='center' class='arial s11 black bold' style='padding: 3px;'>SP</div></td>
      <td class='t2 b2 l1' width='80'><div align='center' class='arial s11 black bold' style='padding: 3px;'>Qty.</div></td>
      <td class='t2 b2 l1' width='80'><div align='center' class='arial s11 black bold' style='padding: 3px;'>Discount</div></td>
      <td class='t2 b2 l1' width='80'><div align='center' class='arial s11 black bold' style='padding: 3px;'>Net</div></td>
      <td class='t2 b2 l1' width='80'><div align='center' class='arial s11 black bold' style='padding: 3px;'>CR 1</div></td>
      <td class='t2 b2 l1' width='80'><div align='center' class='arial s11 black bold' style='padding: 3px;'>CR 2</div></td>
      <td class='t2 b2 l1' width='80'><div align='center' class='arial s11 black bold' style='padding: 3px;'>HMO</div></td>
      <td class='t2 b2 l1 r2' width='80'><div align='center' class='arial s11 black bold' style='padding: 3px;'>Excess</div></td>
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
$rmqtycount=0;

//ROOM-----------------------------------------------------------------------------------------------------------------------------------------------
$rmaeposql=mysqli_query($conn,"SELECT refno, invno, productcode, productdesc, sellingprice, CAST(sellingprice AS DECIMAL(10,2)) AS sp, quantity, adjustment, CAST(adjustment AS DECIMAL(10,2)) AS adj, gross, CAST(gross AS DECIMAL(10,2)) AS gr, phic, CAST(phic AS DECIMAL(10,2)) AS ph, phic1, CAST(phic1 AS DECIMAL(10,2)) AS ph1, hmo, CAST(hmo AS DECIMAL(10,2)) AS hm, excess, CAST(excess AS DECIMAL(10,2)) AS ex, productsubtype, administration, terminalname, status, datearray FROM productout WHERE caseno='$caseno' AND trantype='charge' AND quantity > 0 AND productsubtype='ROOM ACCOMODATION' AND batchno NOT LIKE 'RDU-%%' ORDER BY productsubtype, productdesc, datearray");
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

$rmqtycount+=$rmaeqty;

$rmdt=date("M d, Y h:i:s A",strtotime("$rmaedatea $rmaeinvno"));

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
      <td class='b1 l2 $bg' height='40'><div align='left' class='arial s16 black' style='padding: 3px;'>$aeno</div></td>
      <td width='30' class='b1 l1 $bg'><div align='center' style='padding: 3px;'></div></td>
      <td width='80' class='b1 l1 $bg'><div align='center' style='padding: 3px;'><table border='0' cellpadding='0' cellspacing='0'>
        <tr $view>
          <td width='3' class='$bg'></td>
          <td class='$bg buttonstyle'><button type='button' onclick='a1$rmaerefno()' style='width: 30px;height: 30px;border-radius: 15px;border: none;background-color: #4284cc;color: #FFFFFF;border: 1px solid #0f39c0;' class='butt' title='Edit Item'><i class='demo-icon icon-edit-1' style='font-size: 10px;'>&#xe8c8</i></button></td>
          <td width='5' class='$bg'></td>
          <td class='$bg buttonstyle'><button type='button' onclick='b1$rmaerefno()' class='butt' $delsty><i class='demo-icon icon-trash-2' style='font-size: 10px;'>&#xe8e1</i></button></td>
          <td width='3' class='$bg'></td>
        </tr>
      </table></div></td>
      <td class='b1 l1 $bg'><div align='left' class='arial s16 black' title='$rmaedatea $rmaeinvno' style='padding: 3px;'>$rmaedesc</div></td>
";

if($dept=="RDU"){
echo "
      <td class='b1 l1 $bg'><div align='center' class='arial s12 black' style='padding: 3px;'>$rmdt</div></td>
";
}

echo "
      <td class='b1 l1 $bg'><div align='left' class='arial s16 black' style='padding: 3px;'>$rmaeptype</div></td>
      <td class='b1 l1 $bg'><div align='center' class='arial s16 black' style='padding: 3px;'>$rmaestat</div></td>
      <td class='b1 l1 $bg'><div align='left' class='arial s16 black' style='padding: 3px;'></div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='padding: 3px;'>$rmaesp</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='padding: 3px;'>$rmaeqty</div></td>
      <td class='b1 l1 $bg $errdisrm'><div align='right' class='arial s16 black $errdisrm' style='padding: 3px;'>$rmaeadj</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='padding: 3px;'>$rmaegross</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='padding: 3px;'>$rmaephic</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='padding: 3px;'>$rmaephic1</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='padding: 3px;'>$rmaehmo</div></td>
      <td class='b1 l1 r2 $bg'><div align='right' class='arial s16 black' style='padding: 3px;'>$rmaeexcess</div></td>
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

//ROOM ERROR DETECTION-------
if(($status=="MGH")&&(stripos($caseno, "I-") !== FALSE)){
  $zxsql=mysqli_query($conn,"SELECT `datearray` FROM `dischargedtable` WHERE `caseno`='$caseno'");
  $zxcount=mysqli_num_rows($zxsql);

  $strStart=$dateadmit;

  if($zxcount==0){
    $strEnd=date("Y-m-d");
  }
  else{
    $zxfetch=mysqli_fetch_array($zxsql);
    $strEnd=$zxfetch['datearray'];
  }

  $from=$strStart;
  $to=$strEnd;
  $total=strtotime($to) - strtotime($from);
  $days=round($total / (60 * 60 * 24));
  $val=$days;

  if($rmqtycount>$val){
echo "
    <tr>
      <td colspan='15' class='b1 l2 r2' height='28' bgcolor='#FF0000;'><div align='center' style='color: #FFFFFF;font-weight: bold;font-family: arial;font-size: 14px;'>
        WARNING!!! DAYS ON ROOM ACCOMODATION EXCEEDED THE DAYS STAYED AT THIS HOSPITAL. $val DAYS STAYED AT THE HOSPITAL. $rmqtycount TOTAL DAYS ON ROOM ACCOMODATION.
      </div></td>
    </tr>
";
  }
  else if($rmqtycount<$val){
echo "
    <tr>
      <td colspan='15' class='b1 l2 r2' height='28' bgcolor='#FF0000;'><div align='center' style='color: #FFFFFF;font-weight: bold;font-family: arial;font-size: 14px;'>
        WARNING!!! DAYS ON ROOM ACCOMODATION IS LESS THAN THE DAYS STAYED AT THIS HOSPITAL. $val DAYS STAYED AT THE HOSPITAL. $rmqtycount TOTAL DAYS ON ROOM ACCOMODATION.
      </div></td>
    </tr>
";
  }
}
//END ROOM ERROR DETECTION---
//END ROOM-------------------------------------------------------------------------------------------------------------------------------------------
$aeposql=mysqli_query($conn,"SELECT refno, invno, productcode, productdesc, sellingprice, CAST(sellingprice AS DECIMAL(10,2)) AS sp, quantity, adjustment, CAST(adjustment AS DECIMAL(10,2)) AS adj, gross, CAST(gross AS DECIMAL(10,2)) AS gr, phic, CAST(phic AS DECIMAL(10,2)) AS ph, phic1, CAST(phic1 AS DECIMAL(10,2)) AS ph1, hmo, CAST(hmo AS DECIMAL(10,2)) AS hm, excess, CAST(excess AS DECIMAL(10,2)) AS ex, productsubtype, administration, terminalname, status, approvalno, datearray, remarks FROM productout WHERE caseno='$caseno' AND trantype='charge' AND quantity > 0 AND productsubtype NOT LIKE 'ROOM ACCOMODATION' AND productsubtype NOT LIKE 'PROFESSIONAL FEE' AND batchno NOT LIKE 'RDU-%%' ORDER BY productsubtype, productdesc, datearray");
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
$aeremarks=$aepofetch['remarks'];

$aedt=date("M d, Y h:i:s A",strtotime("$aesdatea $aeinvno"));

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

$stat="";
if(($aeptype=="PHARMACY/MEDICINE")||($aeptype=="PHARMACY/SUPPLIES")||($aeptype=="MEDICAL SURGICAL SUPPLIES")||($aeptype=="MEDICAL SUPPLIES")){
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
  else{
    $stat="<span style='color: #FFFFFF;'>ERROR!!!</span>";
    $bg="bgred";
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
  else if($aeterm=="refund"){
    $stat="Refund";
    $delb="off";
    $bg="bgred";
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
      <td class='b1 l2 $bg' height='40'><div align='left' class='arial s16 black' style='padding: 3px;'>$aeno</div></td>
      <td width='30' class='b1 l1 $bg'><div align='center' style='padding: 3px;'>
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
else{
  if($aeptype=="LABORATORY"){
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
    if(($aecode=="11334620210406")||($aecode=="210505100721p-50")){
      $rm=$aeremarks;
    }
    else{
      $rm="";
    }
  }
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
      <td width='80' class='b1 l1 $bg'><div align='center' style='padding: 3px;'><table border='0' cellpadding='0' cellspacing='0'>
        <tr $view>
          <td width='3' class='$bg'></td>
          <td class='$bg buttonstyle'><button type='button' onclick='a1$aerefno()' style='width: 30px;height: 30px;border-radius: 15px;border: none;background-color: #4284cc;color: #FFFFFF;border: 1px solid #0f39c0;' class='butt' title='Edit Item'><i class='demo-icon icon-edit-1' style='font-size: 10px;'>&#xe8c8</i></button></td>
          <td width='5' class='$bg'></td>
          <td class='$bg buttonstyle'><button type='button' onclick='b1$aerefno()' class='butt' $delsty><i class='demo-icon icon-trash-2' style='font-size: 10px;'>&#xe8e1</i></button></td>
          <td width='3' class='$bg'></td>
        </tr>
      </table></div></td>
      <td class='b1 l1 $bg'><div align='left' class='arial s16 black' title='$aesdatea $aeinvno' style='padding: 3px;'>".$aedesc.$rmdisp.$pnflabel."</div></td>
";

if($dept=="RDU"){
echo "
      <td class='b1 l1 $bg'><div align='center' class='arial s12 black' style='padding: 3px;'>$aedt</div></td>
";
}

echo "
      <td class='b1 l1 $bg'><div align='left' class='arial s16 black' style='padding: 3px;'>$aeptype</div></td>
      <td class='b1 l1 $bg'><div align='center' class='arial s16 black' style='padding: 3px;'>$aestat</div></td>
      <td class='b1 l1 $bg'><div align='left' class='arial s16 black' style='padding: 3px;'>$stat</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='padding: 3px;'>$aesp</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='padding: 3px;'>$aeqty</div></td>
      <td class='b1 l1 $bg $errdis'><div align='right' class='arial s16 black $errdis' style='padding: 3px;'>$aeadj</div></td>
      <td class='b1 l1 $bg $errgross' title='$errgrosstitle'><div align='right' class='arial s16 black' style='padding: 3px;'>$aegross</div></td>
      <td class='b1 l1 $bg $errphic'><div align='right' class='arial s16 black $errphic' style='padding: 3px;'>$aephic</div></td>
      <td class='b1 l1 $bg $errphic1'><div align='right' class='arial s16 black $errphic1' style='padding: 3px;'>$aephic1</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='padding: 3px;'>$aehmo</div></td>
      <td class='b1 l1 r2 $bg'><div align='right' class='arial s16 black' style='padding: 3px;'>$aeexcess</div></td>
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
$pfaeposql=mysqli_query($conn,"SELECT refno, productcode, invno, productdesc, sellingprice, CAST(sellingprice AS DECIMAL(10,2)) AS sp, quantity, adjustment, CAST(adjustment AS DECIMAL(10,2)) AS adj, gross, CAST(gross AS DECIMAL(10,2)) AS gr, phic, CAST(phic AS DECIMAL(10,2)) AS ph, phic1, CAST(phic1 AS DECIMAL(10,2)) AS ph1, hmo, CAST(hmo AS DECIMAL(10,2)) AS hm, excess, CAST(excess AS DECIMAL(10,2)) AS ex, producttype, productsubtype, administration, terminalname, status, datearray FROM productout WHERE caseno='$caseno' AND trantype='charge' AND quantity > 0 AND productsubtype='PROFESSIONAL FEE' AND batchno NOT LIKE 'RDU-%%' ORDER BY productsubtype, productdesc, datearray");
while($pfaepofetch=mysqli_fetch_array($pfaeposql)){
$pfaerefno=$pfaepofetch['refno'];
$pfaecode=$pfaepofetch['productcode'];
$pfaedesc=$pfaepofetch['productdesc'];
$pfaeinvno=$pfaepofetch['invno'];
$pfaerefno=$pfaepofetch['refno'];
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

$pfdt=date("M d, Y h:i:s A",strtotime("$pfaedatea $pfaeinvno"));

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
      <td class='b1 l2 $bg' height='40'><div align='left' class='arial s16 black' style='padding: 3px;'>$aeno</div></td>
      <td width='30' class='b1 l1 $bg'><div align='center style='padding: 3px;''></div></td>
      <td width='80' class='b1 l1 $bg'><div align='center' style='padding: 3px;'><table border='0' cellpadding='0' cellspacing='0'>
        <tr $view>
          <td width='3' class='$bg'></td>
          <td class='$bg buttonstyle'><button type='button' onclick='a1$pfaerefno()' style='width: 30px;height: 30px;border-radius: 15px;border: none;background-color: #4284cc;color: #FFFFFF;border: 1px solid #0f39c0;' class='butt' title='Edit Item'><i class='demo-icon icon-edit-1' style='font-size: 10px;'>&#xe8c8</i></button></td>
          <td width='5' class='$bg'></td>
          <td class='$bg buttonstyle'><button type='button' onclick='b1$pfaerefno()' class='butt' $delsty><i class='demo-icon icon-trash-2' style='font-size: 10px;'>&#xe8e1</i></button></td>
          <td width='3' class='$bg'></td>
        </tr>
      </table></div></td>
      <td class='b1 l1 $bg'><div align='left' class='arial' style='padding: 3px;'><span class='s16 black' title='$pfaedatea'>$pfaedesc</span> <span class='s13 blue'>($pfaeprotype)</span></div></td>
";

if($dept=="RDU"){
echo "
      <td class='b1 l1 $bg'><div align='center' class='arial s12 black' style='padding: 3px;'>$pfdt</div></td>
";
}

echo "
      <td class='b1 l1 $bg'><div align='left' class='arial s16 black' style='padding: 3px;'>$pfaeptype</div></td>
      <td class='b1 l1 $bg'><div align='center' class='arial s16 black' style='padding: 3px;'>$pfaestat</div></td>
      <td class='b1 l1 $bg'><div align='left' class='arial s16 black' style='padding: 3px;'></div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='padding: 3px;'>$pfaesp</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='padding: 3px;'>$pfaeqty</div></td>
      <td class='b1 l1 $bg $errdispf'><div align='right' class='arial s16 black $errdispf' style='padding: 3px;'>$pfaeadj</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='padding: 3px;'>$pfaegross</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='padding: 3px;'>$pfaephic</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='padding: 3px;'>$pfaephic1</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='padding: 3px;'>$pfaehmo</div></td>
      <td class='b1 l1 r2 $bg'><div align='right' class='arial s16 black' style='padding: 3px;'>$pfaeexcess</div></td>
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

if($dept=="RDU"){$tc="8";$sptc="16";}else{$tc="7";$sptc="15";}

//RDU START------------------------------------------------------------------------------------------------------------------------------------------

$aerno=$aeno;
$aerposql=mysqli_query($conn,"SELECT refno, invno, productcode, productdesc, sellingprice, CAST(sellingprice AS DECIMAL(10,2)) AS sp, quantity, adjustment, CAST(adjustment AS DECIMAL(10,2)) AS adj, gross, CAST(gross AS DECIMAL(10,2)) AS gr, phic, CAST(phic AS DECIMAL(10,2)) AS ph, phic1, CAST(phic1 AS DECIMAL(10,2)) AS ph1, hmo, CAST(hmo AS DECIMAL(10,2)) AS hm, excess, CAST(excess AS DECIMAL(10,2)) AS ex, productsubtype, administration, terminalname, status, approvalno, datearray FROM productout WHERE caseno='$caseno' AND trantype='charge' AND quantity > 0 AND batchno LIKE 'RDU-%%' ORDER BY productsubtype, productdesc, datearray");
$aerpocount=mysqli_num_rows($aerposql);

if($aerpocount>0){
echo "
    <tr>
      <td colspan='$sptc' class='t2 b2' height='10'></td>
    </tr>
";
}

while($aerpofetch=mysqli_fetch_array($aerposql)){
$aerrefno=$aerpofetch['refno'];
$aerinvno=$aerpofetch['invno'];
$aercode=$aerpofetch['productcode'];
$aerdesc=$aerpofetch['productdesc'];
$aersp=$aerpofetch['sellingprice'];
$aerqty=$aerpofetch['quantity'];
$aeradj=$aerpofetch['adjustment'];
$aergross=$aerpofetch['gross'];
$aerphic=$aerpofetch['phic'];
$aerphic1=$aerpofetch['phic1'];
$aerhmo=$aerpofetch['hmo'];
$aerexcess=$aerpofetch['excess'];
$aerptype=$aerpofetch['productsubtype'];
$aertname=$aerpofetch['administration'];
$aerterm=$aerpofetch['terminalname'];
$aerstat=strtoupper($aerpofetch['status']);
$aersapprovalno=$aerpofetch['approvalno'];
$aersdatea=$aerpofetch['datearray'];

$aerdt=date("M d, Y h:i:s A",strtotime("$aersdatea $aerinvno"));

$aerdesc=str_replace("ams-","",$aerdesc);
$aerdesc=str_replace("-sup","",$aerdesc);
$aerdesc=str_replace("-med","",$aerdesc);

$consp=$aerpofetch['sp'];
$conadj=$aerpofetch['adj'];
$congross=$aerpofetch['gr'];
$conphic=$aerpofetch['ph'];
$conphic1=$aerpofetch['ph1'];
$conhmo=$aerpofetch['hm'];
$conexcess=$aerpofetch['ex'];

$aerno++;
$totadj+=$aeradj;
$totgross+=$aergross;
$totphic1+=$aerphic;
$totphic2+=$aerphic1;
$tothmo+=$aerhmo;
$totexcess+=$aerexcess;
$totgr+=$aersp*$aerqty;

$one=number_format(((($consp*$aerqty)-$conadj)*1),2);
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

$stat="";
if(($aerptype=="PHARMACY/MEDICINE")||($aerptype=="PHARMACY/SUPPLIES")||($aerptype=="MEDICAL SURGICAL SUPPLIES")||($aerptype=="MEDICAL SUPPLIES")){
  $crtnsql=mysqli_query($conn,"SELECT *  FROM `productreturn` WHERE `refno1`='$aerrefno' AND (`trantype`='pending' OR `trantype`='finalized')");
  $crtncount=mysqli_num_rows($crtnsql);

  $kpnfsql=mysqli_query($conn,"SELECT `pnf` FROM `receiving` WHERE `code`='$aercode'");
  $kpnfcount=mysqli_num_rows($kpnfsql);
  if($kpnfcount>0){
    $kpnffetch=mysqli_fetch_array($kpnfsql);
    $kpnf=$kpnffetch['pnf'];
    if($kpnf=="PNDF"){
      $pnflabel="<span style='color: blue;font-size: 11px;'> (PNDF)</span>";
    }
    else if(($kpnf=="NPNDF")||($kpnf=="NON-PNDF")){
      $pnflabel="<span style='color: #FF0000;font-weight: bold;font-size: 11px;'> (NON-PNDF)</span>";
      if($aerphic>0){
        $errphic="quadrat";
      }
      if($aerphic1>0){
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

  if($aertname=="pending"){
    $stat="Pending";
    $bg="bgyellow";
  }
  else if($aertname=="dispensed"){
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
  else if(($aertname=="administered")||($aertname=="Administered")){
    $stat="Administered";
  }
  else{
    $stat="<span style='color: #FFFFFF;'>ERROR!!!</span>";
    $bg="bgred";
  }

  $delb="off";
  $delsty="style='width: 30px;height: 30px;border-radius: 15px;border: none;background-color: #d9d9d9;color: #FFFFFF;border: 1px solid #c2c2c2;' title='Delete Item Disabled' disabled";
}
else if(($aerptype=="LABORATORY")||($aerptype=="EEG")||($aerptype=="ECG")||($aerptype=="HEARTSTATION")){
  if($aerterm=="pending"){
    $stat="Pending";
    $delb="on";
    $bg="bglightred";
  }
  else if($aerterm=="Testdone"){
    $stat="Test Done";
    $delb="off";
    $delsty="style='width: 30px;height: 30px;border-radius: 15px;border: none;background-color: #d9d9d9;color: #FFFFFF;border: 1px solid #c2c2c2;' title='Delete Item Disabled' disabled";
  }
  else if($aerterm=="Testtobedone"){
    $stat="Test to be done";
    $delb="on";
  }
  else{
    $stat="";
    $delb="on";
  }
}
else if(($aerptype=="XRAY")||($aerptype=="MAMMOGRAPHY")||($aerptype=="ULTRASOUND")||($aerptype=="CT SCAN")){
  if($aerterm=="pending"){
    if($aersapprovalno!=""){
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
  else if($aerterm=="Testdone"){
    $stat="Test Done";
    $delb="off";
    $delsty="style='width: 30px;height: 30px;border-radius: 15px;border: none;background-color: #d9d9d9;color: #FFFFFF;border: 1px solid #c2c2c2;' title='Delete Item Disabled' disabled";
  }
  else if($aerterm=="Testtobedone"){
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

if($aerptype=="PROFESSIONAL FEE"){$hei="600";}
else if(($aerptype=="ECG")||($aerptype=="LABORATORY")){$hei="600";}
else{$hei="540";}

echo "
    <tr>
      <td class='b1 l2 $bg' height='40'><div align='left' class='arial s16 black' style='padding: 3px;'>$aerno</div></td>
      <td width='30' class='b1 l1 $bg'><div align='center' style='padding: 3px;'>
";

if(($aerptype=="LABORATORY")||($aerptype=="XRAY")){
  if(($aerphic>0)||($aerphic1>0)||($aerhmo>0)){

  }
  else{
    echo "
        <input type='checkbox' name='refno[]' value='$aerrefno' />
    ";
  }

}

//REMARKS FOR RT HAZZARD---------------------------------------------------------------------------
if($aercode=="210906184316p-50"){
$rmsql=mysqli_query($conn,"SELECT `remarks` FROM `labtest` WHERE `refno`='$aerrefno'");
$rmcount=mysqli_num_rows($rmsql);
  if($rmcount==0){
    $rm="";
  }
  else{
    $rmfetch=mysqli_fetch_array($rmsql);
    $rm=strtoupper($rmfetch['remarks']);
  }
}
elseif($aerptype=="LABORATORY"){
$rmsql=mysqli_query($conn,"SELECT `remarks` FROM `labtest` WHERE `refno`='$aerrefno'");
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
if($aergross<1){
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
      <td width='80' class='b1 l1 $bg'><div align='center' style='padding: 3px;'><table border='0' cellpadding='0' cellspacing='0'>
        <tr $view>
          <td width='3' class='$bg'></td>
          <td class='$bg buttonstyle'><button type='button' onclick='a1$aerrefno()' style='width: 30px;height: 30px;border-radius: 15px;border: none;background-color: #4284cc;color: #FFFFFF;border: 1px solid #0f39c0;' class='butt' title='Edit Item'><i class='demo-icon icon-edit-1' style='font-size: 10px;'>&#xe8c8</i></button></td>
          <td width='5' class='$bg'></td>
          <td class='$bg buttonstyle'><button type='button' onclick='b1$aerrefno()' class='butt' $delsty><i class='demo-icon icon-trash-2' style='font-size: 10px;'>&#xe8e1</i></button></td>
          <td width='3' class='$bg'></td>
        </tr>
      </table></div></td>
      <td class='b1 l1 $bg'><div align='left' class='arial s16 black' title='$aersdatea $aerinvno' style='padding: 3px;'>".$aerdesc.$rmdisp.$pnflabel."</div></td>
";

if($dept=="RDU"){
echo "
      <td class='b1 l1 $bg'><div align='center' class='arial s12 black' style='padding: 3px;'>$aerdt</div></td>
";
}

echo "
      <td class='b1 l1 $bg'><div align='left' class='arial s16 black' style='padding: 3px;'>$aerptype</div></td>
      <td class='b1 l1 $bg'><div align='center' class='arial s16 black' style='padding: 3px;'>$aerstat</div></td>
      <td class='b1 l1 $bg'><div align='left' class='arial s16 black' style='padding: 3px;'>$stat</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='padding: 3px;'>$aersp</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='padding: 3px;'>$aerqty</div></td>
      <td class='b1 l1 $bg $errdis'><div align='right' class='arial s16 black $errdis' style='padding: 3px;'>$aeradj</div></td>
      <td class='b1 l1 $bg $errgross' title='$errgrosstitle'><div align='right' class='arial s16 black' style='padding: 3px;'>$aergross</div></td>
      <td class='b1 l1 $bg $errphic'><div align='right' class='arial s16 black $errphic' style='padding: 3px;'>$aerphic</div></td>
      <td class='b1 l1 $bg $errphic1'><div align='right' class='arial s16 black $errphic1' style='padding: 3px;'>$aerphic1</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s16 black' style='padding: 3px;'>$aerhmo</div></td>
      <td class='b1 l1 r2 $bg'><div align='right' class='arial s16 black' style='padding: 3px;'>$aerexcess</div></td>
    </tr>

<script>
function a1$aerrefno() {
  window.open('edititem.php?caseno=$caseno&refno=$aerrefno&user=$user', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=600,width=500,height=$hei');
}
</script>
";

if($delb=="on"){
echo "
<script>
function b1$aerrefno() {
  window.open('deleteitem.php?caseno=$caseno&refno=$aerrefno&user=$user&desc=$aerdesc', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=600,width=500,height=150');
}
</script>
";
}

}

if($aerpocount>0){
echo "
    <tr>
      <td colspan='$sptc' class='t2 b2' height='10'></td>
    </tr>
";
}
//RDU END--------------------------------------------------------------------------------------------------------------------------------------------

echo "
    <tr>
      <td class='t2 b2 l2' colspan='$tc' height='30'><div align='left' class='arial s14 black bold' style='padding: 3px;'>TOTAL</div></td>
      <td class='t2 b2 l1' colspan='2'><div align='right' class='arial s14 black bold' style='padding: 3px;'>".number_format($totgr,2)."</div></td>
      <td class='t2 b2 l1'><div align='right' class='arial s14 black bold' style='padding: 3px;'>".number_format($totadj,2)."</div></td>
      <td class='t2 b2 l1'><div align='right' class='arial s14 black bold' style='padding: 3px;'>".number_format($totgross,2)."</div></td>
      <td class='t2 b2 l1'><div align='right' class='arial s14 black bold' style='padding: 3px;'>".number_format($totphic1,2)."</div></td>
      <td class='t2 b2 l1'><div align='right' class='arial s14 black bold' style='padding: 3px;'>".number_format($totphic2,2)."</div></td>
      <td class='t2 b2 l1'><div align='right' class='arial s14 black bold' style='padding: 3px;'>".number_format($tothmo,2)."</div></td>
      <td class='t2 b2 l1 r2'><div align='right' class='arial s14 black bold' style='padding: 3px;'>".number_format($totexcess,2)."</div></td>
    </tr>
  </table>
  <!-- br />
  <input type='submit' value='Update Price' />
  </form -->
</div>
";
?>
