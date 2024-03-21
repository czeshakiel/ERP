<?php
    if(isset($_POST['searchme'])){$searchmeval=mysqli_real_escape_string($conn,$_POST['searchme']);}else{$searchmeval="";}
    if(isset($_POST['dept'])){$deptval=mysqli_real_escape_string($conn,$_POST['dept']);}else{$deptval="";}

    if($deptval=="PHARMACY"){$dps1="selected";$dps2="";$dps3="";}
    else if($deptval=="PHARMACY_OPD"){$dps1="";$dps2="selected";$dps3="";}
    else if($deptval=="CPU"){$dps1="";$dps2="";$dps3="selected";}
    else{$dps1="";$dps2="";$dps3="";}

echo "
                    <table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td><div align='left'>
                          <form method='post'>
                            <table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td><input type='text' name='searchme' class='searchme' style='padding: 5px;height: 25px;width: 400px;border: 2px solid #000000;border-radius: 5px;font-size: 15px;font-weight: bold;' value='$searchmeval' placeholder='SEARCH GENERIC OR BRAND NAME' autofocus required /></td>
                                <td width='5'></td>
                                <td>
                                  <select name='dept' class='searchme' style='padding: 5px;height: 38px;border: 2px solid #000000;border-radius: 5px;font-size: 15px;font-weight: bold;'>
                                    <option $dps1>PHARMACY</option>
                                    <option value='PHARMACY_OPD' $dps2>OPD PHARMACY</option>
                                    <option $dps3>CPU</option>
                                  </select>
                                </td>
                                <td width='5'></td>
                                <td><button type='submit' class='sch'>&#x1F50D</button></td>
                              </tr>
                            </table>
                          </form>
                        </div></td>
                      </tr>
";

    if(isset($_POST['searchme'])){
      $searchme=mysqli_real_escape_string($conn,$_POST['searchme']);
      $dept=mysqli_real_escape_string($conn,$_POST['dept']);

      $zxsql=mysqli_query($conn,"SELECT r.`unit`, r.`pnf`, r.`lotno`, r.`testcode`, r.`gtestcode`, r.`code`, r.`description`, r.`generic`, SUM(s.`quantity`) AS `soh`, r.`optset4`, r.`itemname`, r.`lotno` FROM `stocktable` s, `receiving` r WHERE s.`code`=r.`code` AND r.`unit`='PHARMACY/MEDICINE' AND (r.`description` LIKE '%$searchme%' OR r.`generic` LIKE '$searchme%') AND s.`dept`='$dept' GROUP BY s.`code` ORDER BY r.`description`, r.`generic` ASC");
      $zxcount=mysqli_num_rows($zxsql);

      if($zxcount==0){
echo "
                      <tr>
                        <td height='10'></td>
                      </tr>
                      <tr>
                        <td><div align='left' style='font-family: arial;font-weight: bold;font-size: 12px;color: #FF0000;padding-left: 3px;'>0 Results found!</div></td>
                      </tr>
";
      }
      else{
echo "
                      <tr>
                        <td height='10'></td>
                      </tr>
                      <tr>
                        <td><div align='left'>
                          <table border='0' cellpadding='0' cellspacing='0' class='hoverTable'>
                            <tr>
                              <td class='t2 b2 l2' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>#</div></td>
                              <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>Description</div></td>
                              <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>SOH</div></td>
                              <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>Unit Cost</div></td>
                              <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>Price Type</div></td>
                              <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>Cash Price</div></td>
                              <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>Charge Price</div></td>
                              <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>PNDF</div></td>
                              <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>Restrictions</div></td>
                              <td class='t2 b2 l1 r2' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>Action</div></td>
                            </tr>
";

        $zx=0;
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

echo "
                            <tr>
                              <td class='b1 l2' style='border-radius: 0px;'><div align='left' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>$zx</div></td>
                              <td class='b1 l1' style='border-radius: 0px;'><div align='left' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>$itd"; if($itg!=""){echo " [<span style='color: blue;font-size: 10px;'>".$itg."</span>]";} echo "</div></td>
                              <td class='b1 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>$soh</div></td>
                              <td class='b1 l1' style='border-radius: 0px;'><div align='right' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>".number_format($uc,2,".",",")."</div></td>
                              <td class='b1 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>$lotdis</div></td>
                              <td class='b1 l1' style='border-radius: 0px;'><div align='right' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>".number_format($cash,2,".",",")."</div></td>
                              <td class='b1 l1' style='border-radius: 0px;'><div align='right' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>".number_format($charge,2,".",",")."</div></td>
                              <td class='b1 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>$pnfdis</div></td>
                              <td class='b1 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>$dis</div></td>
                              <td class='b1 l1 r2' style='border-radius: 0px;'><div align='center' style='padding: 3px 5px;'>
";

          if($up==0){
echo "
                                <button name='edt' class='btndis' title='Edit Disabled' disabled>&#x270E;</button>
";
          }
          else{
echo "
                                <button name='edt' class='btn' title='Edit'"; ?> onclick="<?php echo "window.open('ms/?code=$cod".$usr."', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=30,left=700,width=480,height=810');";?>" <?php echo ">&#x270E;</button>
";
          }

echo "
                              </div></td>
                            </tr>
";
        }

echo "
                            <tr>
                              <td class='t2' colspan='10'><div align='left' style='font-family: arial;font-size: 11px;padding: 3px 5px;'>
                                <span style='color: #FF0000;font-weight: bold;'><u>Price Formula for Mark-Up Meds</u></span><br />
                                <span style='color: #818181;'>CASH = ( ( Unit Cost + ( Unit Cost x 0.30 ) ) + ( ( Unit Cost + ( Unit Cost x 0.30 ) ) x 0.12 ) )</span><br />
                                <span style='color: #818181;'>CHARGE = ( ( Unit Cost + ( Unit Cost x 0.70 ) ) + ( ( Unit Cost + ( Unit Cost x 0.70 ) ) x 0.04 ) )</span><br />
                                <span style='color: #7F7FF5;'>*Resulting Price is rounded off to nearest 0.05 or 0.10</span>
                              <div></td>
                            </tr>
                          </table>
                        </div></td>
                      </tr>
";
      }
    }

echo "
                    </table>
";
?>
