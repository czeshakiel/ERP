<?php
          if(isset($_POST['code'])){
            $cda=$_POST['code'];
            $dept=mysqli_real_escape_string($conn,$_POST['dept']);
            $addperc=mysqli_real_escape_string($conn,$_POST['addperc']);
            $trantype=mysqli_real_escape_string($conn,$_POST['trantype']);

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

                //Price Calculations Start---------------------------------------------------------
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
                  //cash-------------------------
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
                  //-----------------------------

                  //charge-----------------------
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
                  //-----------------------------
                }
                //Price Calculations End-----------------------------------------------------------

                if(($trantype=="Cash")||($trantype=="Both")){
                  $caperc=$cash+($cash*($addperc/100));

                  if(isset($_POST['roundoff'])){
                    $car=number_format($caperc,2);
                    $car=str_replace(",","",$car);
                    $castr=substr($car, -1);

                    if(($castr=="1")||($castr=="2")||($castr=="3")||($castr=="4")){
                      $caadd=(5-$castr)*0.01;
                    }
                    else if(($castr=="6")||($castr=="7")||($castr=="8")||($castr=="9")){
                      $caadd=(10-$castr)*0.01;
                    }
                    else{
                      $caadd=0;
                    }

                    $caro=$car+$caadd;

                    //echo "$zb UPDATE `productsmasterlist` SET `nonmed`='$caro', `opd`='$caro' WHERE `code`='$code'<br />";
                    //echo "$zb INSERT INTO `pricechangelogs` (`code`, `type`, `price`, `iomno`, `remarks`, `user`, `logtime`) VALUES ('$code', 'cash', '$cash', '', '', '".base64_decode($user)."', '".date("Y-m-d H:i:s")."')<br />";

                    mysqli_query($conn,"UPDATE `productsmasterlist` SET `nonmed`='$caro', `opd`='$caro' WHERE `code`='$code'");
                    mysqli_query($conn,"INSERT INTO `pricechangelogs` (`code`, `type`, `price`, `iomno`, `remarks`, `user`, `logtime`) VALUES ('$code', 'cash', '$cash', '', '', '".base64_decode($user)."', '".date("Y-m-d H:i:s")."')");
                  }
                  else{
                    //echo "$zb UPDATE `productsmasterlist` SET `nonmed`='$caperc', `opd`='$caperc' WHERE `code`='$code'<br />";
                    //echo "$zb INSERT INTO `pricechangelogs` (`code`, `type`, `price`, `iomno`, `remarks`, `user`, `logtime`) VALUES ('$code', 'cash', '$cash', '', '', '".base64_decode($user)."', '".date("Y-m-d H:i:s")."')<br />";

                    mysqli_query($conn,"UPDATE `productsmasterlist` SET `nonmed`='$caperc', `opd`='$caperc' WHERE `code`='$code'");
                    mysqli_query($conn,"INSERT INTO `pricechangelogs` (`code`, `type`, `price`, `iomno`, `remarks`, `user`, `logtime`) VALUES ('$code', 'cash', '$cash', '', '', '".base64_decode($user)."', '".date("Y-m-d H:i:s")."')");
                  }
                }

                if(($trantype=="Charge")||($trantype=="Both")){
                  $chperc=$charge+($charge*($addperc/100));
                  if(isset($_POST['roundoff'])){
                    $chr=number_format($chperc,2);
                    $chr=str_replace(",","",$chr);
                    $chstr=substr($chr, -1);

                    if(($chstr=="1")||($chstr=="2")||($chstr=="3")||($chstr=="4")){
                      $chadd=(5-$chstr)*0.01;
                    }
                    else if(($chstr=="6")||($chstr=="7")||($chstr=="8")||($chstr=="9")){
                      $chadd=(10-$chstr)*0.01;
                    }
                    else{
                      $chadd=0;
                    }

                    $chro=$chr+$chadd;

                    //echo "$zb UPDATE `productsmasterlist` SET `philhealth`='$chro', `hmo`='$chro', `company`='$chro' WHERE `code`='$code'<br />";
                    //echo "$zb INSERT INTO `pricechangelogs` (`code`, `type`, `price`, `iomno`, `remarks`, `user`, `logtime`) VALUES ('$code', 'charge', '$charge', '', '', '".base64_decode($user)."', '".date("Y-m-d H:i:s")."')<br />";

                    mysqli_query($conn,"UPDATE `productsmasterlist` SET `philhealth`='$chro', `hmo`='$chro', `company`='$chro' WHERE `code`='$code'");
                    mysqli_query($conn,"INSERT INTO `pricechangelogs` (`code`, `type`, `price`, `iomno`, `remarks`, `user`, `logtime`) VALUES ('$code', 'charge', '$charge', '', '', '".base64_decode($user)."', '".date("Y-m-d H:i:s")."')");
                  }
                  else{
                    //echo "$zb UPDATE `productsmasterlist` SET `philhealth`='$chperc', `hmo`='$chperc', `company`='$chperc' WHERE `code`='$code'<br />";
                    //echo "$zb INSERT INTO `pricechangelogs` (`code`, `type`, `price`, `iomno`, `remarks`, `user`, `logtime`) VALUES ('$code', 'charge', '$charge', '', '', '".base64_decode($user)."', '".date("Y-m-d H:i:s")."')<br />";

                    mysqli_query($conn,"UPDATE `productsmasterlist` SET `philhealth`='$chperc', `hmo`='$chperc', `company`='$chperc' WHERE `code`='$code'");
                    mysqli_query($conn,"INSERT INTO `pricechangelogs` (`code`, `type`, `price`, `iomno`, `remarks`, `user`, `logtime`) VALUES ('$code', 'charge', '$charge', '', '', '".base64_decode($user)."', '".date("Y-m-d H:i:s")."')");
                  }
                }
              }
            }

echo "
                      <tr>
                        <td height='10'></td>
                      </tr>
                      <tr>
                        <td><div align='left' style='font-family: arial;font-size: 14px;font-weight: bold;color: #FF0000;'>Price/s updated successfully.</div></td>
                      </tr>
";
            echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=?meds&srm&xox=$user'>";
          }
          else{
echo "
                      <tr>
                        <td height='10'></td>
                      </tr>
                      <tr>
                        <td><div align='left' style='font-family: arial;font-size: 14px;font-weight: bold;color: #FF0000;'>Error!!! No item selected! Select atleast 1 item.</div></td>
                      </tr>
";
          }
?>
