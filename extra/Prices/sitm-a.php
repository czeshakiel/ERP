<?php
        if(isset($_POST['code'])){
          $cda=$_POST['code'];
          $dept=mysqli_real_escape_string($conn,$_POST['dept']);

echo "
                      <tr>
                        <td height='10'></td>
                      </tr>
                      <tr>
                        <td><div align='left'>
                          <form method='post'>
                            <table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='t2 b2 l2' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>#</div></td>
                                <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'><input type='checkbox' class='checkall' id='select_all' /></div></td>
                                <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>Description</div></td>
                                <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>SOH</div></td>
                                <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>Unit Cost</div></td>
                                <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>Price Type</div></td>
                                <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>Cash Price</div></td>
                                <td class='t2 b2 l1 r2' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>Charge Price</div></td>
                              </tr>
";

          $zb=0;
          foreach ($cda as $code){
            $zbsql=mysqli_query($conn,"SELECT r.`unit`, r.`pnf`, r.`lotno`, r.`testcode`, r.`gtestcode`, r.`code`, r.`description`, r.`generic`, SUM(s.`quantity`) AS `soh`, r.`optset4`, r.`itemname`, r.`lotno` FROM `stocktable` s, `receiving` r WHERE s.`code`=r.`code` AND r.`code`='$code' AND s.`dept`='$dept' GROUP BY s.`code` ORDER BY r.`description`, r.`generic` ASC");
            if(mysqli_num_rows($zbsql)>0){
              $zbfetch=mysqli_fetch_array($zbsql);
              $itd=mb_strtoupper(trim($zbfetch['description']));
              $itg=mb_strtoupper(trim($zbfetch['generic']));
              $unt=$zbfetch['unit'];
              $itn=$zbfetch['itemname'];
              $lot=$zbfetch['lotno'];
              $pnf=$zbfetch['pnf'];
              $tes=$zbfetch['testcode'];
              $gte=$zbfetch['gtestcode'];
              $op4=$zbfetch['optset4'];
              $soh=$zbfetch['soh'];
              $lot=$zbfetch['lotno'];
              $zb++;

              if($lot=="M"){$lotdis="MARK-UP";}
              else if($lot=="S"){$lotdis="SPECIAL";}
              else{$lotdis=$lot;}

              $itd=str_replace("AMS-","",$itd);
              $itd=str_replace("ams-","",$itd);
              $itd=str_replace("-MED","",$itd);
              $itd=str_replace("-med","",$itd);
              $itd=str_replace("-SUP","",$itd);
              $itd=str_replace("-sup","",$itd);
              $itd=str_replace("MAK-","",$itd);
              $itd=str_replace("mak--","",$itd);

              $stuc=mysqli_query($conn,"SELECT `unitcost` FROM `stocktable` WHERE `code`='$code' AND (`trantype` LIKE 'charge' OR `trantype` LIKE 'cash') AND `unitcost` > 0 ORDER BY `datearray`");
              while($stucfetch=mysqli_fetch_array($stuc)){
                $uc=round($stucfetch['unitcost'],2);
              }

              //Price Calculations Start---------------------------------------------------------------
              $cash=0;
              $charge=0;

              $prmsql=mysqli_query($conn,"SELECT `philhealth`, `nonmed`, `opd`, `lotno` FROM `productsmasterlist` WHERE `code`='$code'");
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
                                <td class='b1 l2' style='border-radius: 0px;'><div align='left' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>$zb</div></td>
                                <td class='b1 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'><input type='checkbox' class='case' name='code[]' value='$code' checked /></div></td>
                                <td class='b1 l1' style='border-radius: 0px;'><div align='left' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>$itd"; if($itg!=""){echo " [<span style='color: blue;font-size: 10px;'>".$itg."</span>]";} echo "</div></td>
                                <td class='b1 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>$soh</div></td>
                                <td class='b1 l1' style='border-radius: 0px;'><div align='right' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>".number_format($uc,2,".",",")."</div></td>
                                <td class='b1 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>$lotdis</div></td>
                                <td class='b1 l1' style='border-radius: 0px;'><div align='right' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>".number_format($cash,2,".",",")."</div></td>
                                <td class='b1 l1 r2' style='border-radius: 0px;'><div align='right' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>".number_format($charge,2,".",",")."</div></td>
                              </tr>
";

            }
            else{
              //echo $x." ".$code."<br />";
            }
          }

echo "
                             <tr>
                               <td class='t1' colspan='8' height='5'></td>
                             </tr>
                             <tr>
                               <td class='t2 b2' colspan='8'>
                                  <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                                    <tr>
                                      <td><div align='rleft'>
                                        <table border='0' cellpadding='0' cellspacing='0'>
                                          <tr>
                                            <td><div align='left' style='font-family: arial;font-size: 14px;font-weight: bold;color: #FF5733;padding: 5px 0;'>Add</div></td>
                                            <td><div align='left' style='font-family: arial;font-size: 14px;font-weight: bold;color: #FF5733;padding: 5px 5px;'><input type='number' step='0.01' name='addperc' class='num' style='width: 50px;text-align: center;' placeholder='%' value='' required /> % to</div></td>
                                            <td><div align='left' style='font-family: arial;font-size: 14px;font-weight: bold;color: #FF5733;padding: 5px 5px;'>
                                              <select name='trantype' class='num' style='height: 30px;' required>
                                                <option></option>
                                                <option value='Cash'>Cash Price/s</option>
                                                <option value='Charge'>Charge Price/s</option>
                                                <option value='Both'>Both Cash and Charge</option>
                                              </select>
                                            </div></td>
                                            <td><div align='left' style='font-family: arial;font-size: 14px;font-weight: bold;color: #FF5733;padding: 5px 5px;'>to all checked items.</div></td>
                                            <td><div align='left' style='font-family: arial;font-size: 14px;font-weight: bold;color: #FF5733;padding: 5px 5px;'><label><input type='checkbox' name='roundoff' checked /> Round off to nearest 0.05 or 0.10?</label></div></td>
                                          </tr>
                                        </table>
                                      </div></td>
                                      <td><div align='right'><button type='submit' class='prc' name='proceed'>Proceed &#10145;</button></div></td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                            <input type='hidden' name='dept' value='$dept' />
                            <input type='hidden' name='searchmeval' value='$searchmeval' />
                          </form>
                        </div><td>
                      </tr>
";
        }
        else{
echo "s
                      <tr>
                        <td height='10'></td>
                      </tr>
                      <tr>
                        <td><div align='left' style='font-family: arial;font-size: 14px;font-weight: bold;color: #FF0000;'>Error!!! No item selected! Select atleast 1 item.</div></td>
                      </tr>
";
        }
?>
