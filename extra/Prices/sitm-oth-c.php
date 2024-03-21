<?php
          if(isset($_POST['code'])){
            $cda=$_POST['code'];
            $addperc=mysqli_real_escape_string($conn,$_POST['addperc']);
            $trantype=mysqli_real_escape_string($conn,$_POST['trantype']);

            $zb=0;
            foreach ($cda as $code){
              $zbsql=mysqli_query($conn,"SELECT * FROM `receiving` WHERE `code`='$code'");
              if(mysqli_num_rows($zbsql)>0){
                $zbfetch=mysqli_fetch_array($zbsql);
                $itd=mb_strtoupper(trim($zbfetch['description']));
                $unt=$zbfetch['unit'];
                $itn=$zbfetch['itemname'];
                $lot=$zbfetch['lotno'];
                $pnf=$zbfetch['pnf'];
                $tes=$zbfetch['testcode'];
                $gte=$zbfetch['gtestcode'];
                $op4=$zbfetch['optset4'];
                $lot=$zbfetch['lotno'];
                $zb++;

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

                $cash=$opd;
                $charge=$phi;
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
            //echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=?others&srm&xox=$user'>";
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
