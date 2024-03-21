<?php
if(isset($_POST['dept'])){$dept=mysqli_real_escape_string($conn,$_POST['dept']);}
else{$dept="CSR2";}

if(isset($_POST['stctype'])){$stctype=mysqli_real_escape_string($conn,$_POST['stctype']);}
else{$stctype="";}

if(isset($_POST['suptype'])){$suptype=mysqli_real_escape_string($conn,$_POST['suptype']);}
else{$suptype="All Supplies";}

if($dept=="CSR2"){$dps1="selected";$dps2="";$dps3="";$dps4="";}
else if($dept=="PHARMACY"){$dps1="";$dps2="selected";$dps3="";$dps4="";}
else if($dept=="PHARMACY_OPD"){$dps1="";$dps2="";$dps3="selected";$dps4="";}
else if($dept=="CSR"){$dps1="";$dps2="";$dps3="";$dps4="selected";}
else{$dps1="";$dps2="";$dps3="";$dps4="";}

if($stctype=="ai"){$stcs1="selected";$stcs2="";}
else if($stctype=="iws"){$stcs1="";$stcs2="selected";}
else{$stcs1="";$stcs2="";}

if($suptype=="All Supplies"){$sups1="selected";$sunt="";}
else{$sups1="";$sunt=$suptype;}

if(isset($_GET['sdpt'])){
  if($_GET['sdpt']=="PHARMACY"){$alwv=0;$alwvcol=9;}
  else{$alwv=0;$alwvcol=9;}
}
else{$alwv=1;$alwvcol=10;}

echo "
                    <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td><div align='center'>
                          <table border='0' cellpadding='0' cellspacing='0'>
                            <tr>
                              <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                                <tr>
                                  <td><div align='left'>
                                    <form method='post'>
                                      <table border='0' cellpadding='0' cellspacing='0'>
                                        <tr>
                                          <td>
                                            <select name='dept' class='searchme' style='padding: 5px;height: 30px;border: 2px solid #000000;border-radius: 5px;font-size: 15px;font-weight: bold;'>
                                              <option $dps1>CSR2</option>
                                              <option $dps2>PHARMACY</option>
                                              <option value='PHARMACY_OPD' $dps3>OPD PHARMACY</option>
                                              <option $dps4>CSR</option>
                                              <option $dps4>CPU</option>
                                            </select>
                                          </td>
                                          <!-- td width='5'></td>
                                          <td>
                                            <select name='stctype' class='searchme' style='padding: 5px;height: 30px;border: 2px solid #000000;border-radius: 5px;font-size: 15px;font-weight: bold;'>
                                              <option value='ai' $stcs1>All Items</option>
                                              <option value='iws' $stcs2>Items with Stocks</option>
                                            </select>
                                          </td -->
                                          <td width='5'></td>
                                          <td>
                                            <select name='suptype' class='searchme' style='padding: 5px;height: 30px;border: 2px solid #000000;border-radius: 5px;font-size: 15px;font-weight: bold;'>
                                              <option $sups1>All Supplies</option>
";

$zasql=mysqli_query($conn,"SELECT * FROM `accounttitle` WHERE `grp`='SUPPLIES'");
while($zafetch=mysqli_fetch_array($zasql)){
  if($zafetch['accounttitle']==$suptype){$sups2="selected";}
  else{$sups2="";}

echo "
                                              <option $sups2>".$zafetch['accounttitle']."</option>
";
}

echo "
                                            </select>
                                          </td>
                                          <td width='5'></td>
                                          <td><button type='submit' class='dpt' title='Change Dept'>&#x21c4;</button></td>
                                        </tr>
                                      </table>
                                    </form>
                                  </div></td>
                                  <td><div align='right'><button type='button' class='prt' onclick=printDiv('printableArea') title='Print'>	&#128424;</button></div></td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td height='5'></td>
                            </tr>
                            <tr>
                              <td><div align='center' id='printableArea'>
                                <table border='0' cellpadding='0' cellspacing='0'>
                                  <tr>
                                    <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td width='130' valign='middle'><div align='center'><img src='../Resources/Logo/logo.png' width='80' /></div></td>
                                        <td width='auto' valign='middle'><div align='center' style='font-family: arial;color: #000000;'>
                                          <span style='font-size: 16px;font-weight: bold;'>KIDAPAWAN MEDICAL SPECIALISTS CENTER, INC.</span><br />
                                          <span style='font-size: 13px;'>Sudapin, Kidapawan City, Cotabato</span>
                                        </div></td>
                                        <td width='130' valign='middle'></td>
                                      </tr>
                                    </table></td>
                                  </tr>
                                  <tr>
                                    <td><div align='center' style='padding: 10px 0;font-family: arial;color: #000000;'>
                                      <span style='font-size: 15px;font-weight: bold;'>$dept SUPPLIES PRICE LIST</span><br />
                                      <span style='font-size: 13pxx'>".date("F d, Y")."</span>
                                    </div></td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                                        <tr>
                                          <td bgcolor='3380ff' width='30' class='t2 b2 l2' rowspan='2'><div align='center' class='arial s12 white bold' style='padding: 2px 3px;'>#</div></td>
                                          <td bgcolor='3380ff' width='auto' class='t2 b2 l1' rowspan='2'><div align='center' class='arial s12 white bold' style='padding: 2px 3px;'>Description (Generic)</div></td>
                                          <td bgcolor='3380ff' width='50' class='t2 b2 l1' rowspan='2'><div align='center' class='arial s12 white bold' style='padding: 2px 3px;'>SOH</div></td>
";

if($alwv==1){
echo "
                                          <td bgcolor='3380ff' width='80' class='t2 b2 l1' rowspan='2'><div align='center' class='arial s12 white bold' style='padding: 2px 3px;'>Unit Cost</div></td>
";
}

echo "
                                          <td bgcolor='3380ff' width='100' class='t2 b2 l1' rowspan='2'><div align='center' class='arial s12 white bold' style='padding: 2px 3px;'>Price Type</div></td>
                                          <td bgcolor='3380ff' class='t2 b1 l1' colspan='2' height='20'><div align='center' class='arial s12 white bold' style='padding: 2px 3px;'>Prices</div></td>
                                          <td bgcolor='3380ff' width='100' class='t2 b2 l1' rowspan='2'><div align='center' class='arial s12 white bold' style='padding: 2px 3px;'>PNDF</div></td>
                                          <td bgcolor='3380ff' width='100' class='t2 b2 l1' rowspan='2'><div align='center' class='arial s12 white bold' style='padding: 2px 3px;'>Type</div></td>
                                          <td bgcolor='3380ff' width='auto' class='t2 b2 l1 r2' rowspan='2'><div align='center' class='arial s12 white bold' style='padding: 2px 3px;'>Restrictions</div></td>
                                        </tr>
                                        <tr>
                                          <td bgcolor='3380ff' width='80' class='b2 l1' height='20'><div align='center' class='arial s11 white bold' style='padding: 2px 3px;'>Cash Price</div></td>
                                          <td bgcolor='3380ff' width='80' class='b2 l1' height='20'><div align='center' class='arial s11 white bold' style='padding: 2px 3px;'>Charge Price</div></td>
                                        </tr>
";

    $zx=0;
    if($suptype=="All Supplies"){$zxsql=mysqli_query($conn,"SELECT r.`unit`, r.`pnf`, r.`lotno`, r.`testcode`, r.`gtestcode`, r.`code`, r.`description`, r.`generic`, SUM(s.`quantity`) AS `soh`, r.`optset4`, r.`itemname`, r.`lotno` FROM `stocktable` s, `receiving` r WHERE s.`code`=r.`code` AND (r.`unit` LIKE 'PHARMACY/SUPPLIES' OR r.`unit` LIKE 'MEDICAL SURGICAL SUPPLIES' OR r.`unit` LIKE 'MEDICAL SUPPLIES') AND s.`dept`='$dept' GROUP BY s.`code` ORDER BY r.`description`, r.`generic` ASC");}
    else{$zxsql=mysqli_query($conn,"SELECT r.`unit`, r.`pnf`, r.`lotno`, r.`testcode`, r.`gtestcode`, r.`code`, r.`description`, r.`generic`, SUM(s.`quantity`) AS `soh`, r.`optset4`, r.`itemname`, r.`lotno` FROM `stocktable` s, `receiving` r WHERE s.`code`=r.`code` AND r.`unit` LIKE '$suptype' AND s.`dept`='$dept' GROUP BY s.`code` ORDER BY r.`description`, r.`generic` ASC");}
    while($zxfetch=mysqli_fetch_array($zxsql)){
      $cod=$zxfetch['code'];
      $itd=mb_strtoupper(trim($zxfetch['description']));
      $itg=mb_strtoupper(trim($zxfetch['generic']));
      $unt=$zxfetch['unit'];
      $itn=$zxfetch['itemname'];
      $lot=$zxfetch['lotno'];
      $pnf=$zxfetch['pnf'];
      $tes=$zxfetch['testcode'];
      $gte=$zxfetch['gtestcode'];
      $op4=$zxfetch['optset4'];
      $soh=$zxfetch['soh'];
      $lot=$zxfetch['lotno'];
      $zx++;

      $dis="";

      if($soh==0){$sohst="background-color: #FBA67C;color: #FFFFFF;";}else{$sohst="color: #000000;";}

      if(($lot=="S")||(($lot=="M"))){$lotst="color: #000000;";}else{$lotst="background-color: #FF0000;color: #FFFFFF;height: 18px;";}

      if($lot=="M"){$lotdis="MARK-UP";}
      else if($lot=="S"){$lotdis="SPECIAL";}
      else{$lotdis=$lot;}

      $itd=str_replace("AMS-","",$itd);
      $itd=str_replace("-MED","",$itd);

      if(stripos($op4, "-1|") !== FALSE){$dis=$dis."PHARMACY |";}//disable pharmacy only
      if(stripos($op4, "-2|") !== FALSE){$dis=$dis."OPD PHARMACY |";}//disable pharmacy opd only
      if(stripos($op4, "-3|") !== FALSE){$dis=$dis."CSR2 |";}//disable csr2 only
      if(stripos($op4, "-4|") !== FALSE){$dis=$dis."BILLING |";}//disable billing only
      if(stripos($op4, "-5|") !== FALSE){$dis=$dis."NS1 |";;}//disable ns1 only
      if(stripos($op4, "-6|") !== FALSE){$dis=$dis."NS2 |";}//disable ns2 only
      if(stripos($op4, "-7|") !== FALSE){$dis=$dis."NS3 |";}//disable ns3 only
      if(stripos($op4, "-8|") !== FALSE){$dis=$dis."NS4 |";}//disable ns4 only
      if(stripos($op4, "-9|") !== FALSE){$dis=$dis."NS5A |";}//disable ns5a only
      if(stripos($op4, "-10|") !== FALSE){$dis=$dis."NS5B |";}//disable nsb only
      if(stripos($op4, "-11|") !== FALSE){$dis=$dis."NS6 |";}//disable ns6 only
      if(stripos($op4, "-12|") !== FALSE){$dis=$dis."ER |";}//disable er only

      if(stripos($op4, "-99|") !== FALSE){$dis=$dis."OPD Only |";}//disable in patient only
      if(stripos($op4, "-100|") !== FALSE){$dis=$dis."IPD Only |";}//disable out patient only

      $cashonly=1;
      $chargeonly=1;
      if(stripos($op4, "-101|") !== FALSE){$dis=$dis."Cash Only |";}//disable charge and tpl button for in patient
      if(stripos($op4, "-102|") !== FALSE){$dis=$dis."Charge Only |";}//disable cash button for in patient

      $ronl="";
      if((stripos($unt, "LABORATORY") !== FALSE)||(stripos($unt, "CT SCAN") !== FALSE)||(stripos($unt, "ULTRASOUND") !== FALSE)||(stripos($unt, "ECG") !== FALSE)||(stripos($unt, "XRAY") !== FALSE)||(stripos($unt, "EEG") !== FALSE)){
        $ronl="readonly";
      }

      $qtdis="";
      if($gte==1){
        $qtdis="disabled";
      }
      else{
        if($soh<1){
          $qtdis="disabled";
        }
        else{
          if($pnf!="PNDF"){
            $qtdis="disabled";
          }
        }
      }

      $pnfwarn="";
      if($pnf!="PNDF"){$pnfwarn="style='background-color: #EC7063;' title='NON PNDF'";}

      $pnfdis=$pnf;
      if($pnf=="NPNDF"){$pnfdis="NON-PNDF";}

      $stuc=mysqli_query($conn,"SELECT `unitcost` FROM `stocktable` WHERE `code`='$cod' AND (`trantype` LIKE 'charge' OR `trantype` LIKE 'cash') AND `unitcost` > 0 ORDER BY `datearray`");
      while($stucfetch=mysqli_fetch_array($stuc)){
        $uc=round($stucfetch['unitcost'],2);
      }

      //Price Calculations Start---------------------------------------------------------------
      $cash=0;
      $charge=0;

      $prmsql=mysqli_query($conn,"SELECT `philhealth`, `nonmed`, `opd`, `lotno` FROM `productsmasterlist` WHERE `code`='$cod'");
      if(mysqli_num_rows($prmsql)>0){
        $prmfetch=mysqli_fetch_array($prmsql);
        $phi=$prmfetch['philhealth'];
        $opd=$prmfetch['opd'];
      }
      else{
        $phi=0;
        $opd=0;
      }

      if(stripos($lot, "S") !== FALSE){
        $cash=$opd;
        $charge=$phi;
      }
      else{
        //cash-------------------------------
        $sp1=$uc + ($uc*0.30);
        $spcash=$sp1+($sp1*0.12);
        $cashr=number_format($spcash,2);
        $cashr=str_replace(",","",$cashr);
        $cashstr=substr($cashr, -1);

        if(($cashstr=="1")||($cashstr=="2")||($cashstr=="3")||($cashstr=="4")){
          $cashadd=(5-$cashstr)*0.01;
        }
        else if(($cashstr=="6")||($cashstr=="7")||($cashstr=="8")||($cashstr=="9")){
          $cashadd=(10-$cashstr)*0.01;
        }
        else{
          $cashadd=0;
        }

        $cash=$cashr+$cashadd;
        //-----------------------------------

        //charge-----------------------------
        $charge=round($uc+($uc*0.70),2);
        $charge=number_format($charge,2);
        $charge=str_replace(",","",$charge);
        $charge4=($charge+($charge*0.04));
        $charger=number_format($charge4,2);
        $charger=str_replace(",","",$charger);
        $chargestr=substr($charger, -1);

        if(($chargestr=="1")||($chargestr=="2")||($chargestr=="3")||($chargestr=="4")){
          $chargeadd=(5-$chargestr)*0.01;
        }
        else if(($chargestr=="6")||($chargestr=="7")||($chargestr=="8")||($chargestr=="9")){
          $chargeadd=(10-$chargestr)*0.01;
        }
        else{
          $chargeadd=0;
        }

        $charge=$charger+$chargeadd;
        //-----------------------------------
      }
      //Price Calculations End-----------------------------------------------------------------

      if($itg!=""){$itgdis=" ($itg)";}else{$itgdis="";}

      if($uc>$cash){$cast="background-color: #FFC300;color: #000000;";}else{$cast="color: #000000;";}
      if($uc>$charge){$chst="background-color: #FFC300;color: #000000;";}else{$chst="color: #000000;";}

echo "
                                        <tr>
                                          <td class='b1 l2'><div align='left' style='font-family: arial;font-size; 13px;color: #000000;padding: 2px 4px;'>$zx</div></td>
                                          <td class='b1 l1'><div align='left' style='font-family: arial;font-size; 13px;color: #000000;padding: 2px 4px;'>$itd$itgdis<br /><span style='color: #979797;'>$cod</span></div></td>
                                          <td class='b1 l1'><div align='center' style='font-family: arial;font-size; 13px;padding: 2px 4px;$sohst'>$soh</div></td>
";

      if($alwv==1){
echo "
                                          <td class='b1 l1'><div align='right' style='font-family: arial;font-size; 13px;color: #000000;padding: 2px 4px;'>".number_format($uc,2,".",",")."</div></td>
";
      }

echo "
                                          <td class='b1 l1'><div align='center' style='font-family: arial;font-size; 13px;padding: 2px 4px;$lotst'>$lotdis</div></td>
                                          <td class='b1 l1'><div align='right' style='font-family: arial;font-size; 13px;padding: 2px 4px;$cast'>".number_format($cash,2,".",",")."</div></td>
                                          <td class='b1 l1'><div align='right' style='font-family: arial;font-size; 13px;padding: 2px 4px;$chst'>".number_format($charge,2,".",",")."</div></td>
                                          <td class='b1 l1'><div align='center' style='font-family: arial;font-size; 13px;color: #000000;padding: 2px 4px;'>$pnfdis</div></td>
                                          <td class='b1 l1'><div align='center' style='font-family: arial;font-size; 13px;color: #000000;padding: 2px 4px;'>$unt</div></td>
                                          <td class='b1 l1 r2'><div align='center' style='font-family: arial;font-size; 9px;color: #000000;padding: 2px 4px;'>$dis</div></td>
                                        </tr>
";
    }

echo "
                                        <tr>
                                          <td class='t1' colspan='$alwvcol'></td>
                                        </tr>
                                      </table>
                                    </td>
                                  </tr>
                                </table>
                              </div></td>
                            </tr>
                          </table>
                        </table></td>
                      </tr>
                    </table>
";
?>
<script type="text/javascript">
  function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
  }
</script>
