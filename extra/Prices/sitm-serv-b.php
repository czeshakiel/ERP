<?php
          if(isset($_POST['code'])){
            $cda=$_POST['code'];
            $addperc=mysqli_real_escape_string($conn,$_POST['addperc']);
            $trantype=mysqli_real_escape_string($conn,$_POST['trantype']);

            if(($trantype=="Charge")||($trantype=="Both")){$rb="";}else{$rb="r2";}

            if((($trantype=="Charge")||($trantype=="Both"))&&(isset($_POST['roundoff']))){$rb2="";}else{$rb2="r2";}

            if(($trantype=="Cash")||($trantype=="Charge")){
              if(isset($_POST['roundoff'])){
                $coladd="8";
              }
              else{
                $coladd="7";
              }
            }
            else if($trantype=="Both"){
              if(isset($_POST['roundoff'])){
                $coladd="10";
              }
              else{
                $coladd="8";
              }
            }
            else{
              $coladd="7";
            }

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
                                <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>Test Type</div></td>
                                <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>Cash Price</div></td>
";

            if(($trantype=="Cash")||($trantype=="Both")){
echo "
                                <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>Cash (+$addperc%)</div></td>
";

              if(isset($_POST['roundoff'])){
echo "
                                <td class='t2 b2 l1' style='border-radius: 0px;background-color: #DAF7A6;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>Round Off</div></td>
";
              }
            }

echo "
                                <td class='t2 b2 l1 $rb' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>Charge Price</div></td>
";

            if(($trantype=="Charge")||($trantype=="Both")){
echo "
                                <td class='t2 b2 l1 $rb2' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>Charge (+$addperc%)</div></td>
";

              if(isset($_POST['roundoff'])){
echo "
                                <td class='t2 b2 l1 r2' style='border-radius: 0px;background-color: #DAF7A6;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>Round Off</div></td>
";
              }
            }


echo "
                              </tr>
";

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

                $dis="";

                $testcat="";
                if($unt=="LABORATORY"){
                  if(($lot=="hematology")||($lot=="chemistry")||($lot=="serology")||($lot=="clinical microscopy")||($lot=="parasitology")){
                    $testcat=mb_strtoupper($lot);
                  }
                }

                $itd=str_replace("AMS-","",$itd);
                $itd=str_replace("ams-","",$itd);
                $itd=str_replace("-MED","",$itd);
                $itd=str_replace("-med","",$itd);
                $itd=str_replace("-SUP","",$itd);
                $itd=str_replace("-sup","",$itd);
                $itd=str_replace("MAK-","",$itd);
                $itd=str_replace("mak--","",$itd);

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

echo "
                              <tr>
                                <td class='b1 l2' style='border-radius: 0px;'><div align='left' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>$zb</div></td>
                                <td class='b1 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'><input type='checkbox' class='case' name='code[]' value='$code' checked /></div></td>
                                <td class='b1 l1' style='border-radius: 0px;'><div align='left' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>$itd</div></td>
                                <td class='b1 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>$testcat</div></td>
                                <td class='b1 l1' style='border-radius: 0px;'><div align='right' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>".number_format($cash,2,".",",")."</div></td>
";

                if(($trantype=="Cash")||($trantype=="Both")){
                  $caperc=$cash+($cash*($addperc/100));
echo "
                                <td class='b1 l1' style='border-radius: 0px;'><div align='right' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>".number_format($caperc,2,".",",")."</div></td>
";

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
echo "
                                <td class='b1 l1' style='border-radius: 0px;background-color: #DAF7A6;'><div align='right' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>".number_format($caro,2,".",",")."</div></td>
";
                  }
                }

echo "
                                <td class='b1 l1 $rb' style='border-radius: 0px;'><div align='right' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>".number_format($charge,2,".",",")."</div></td>
";

                if(($trantype=="Charge")||($trantype=="Both")){
                  $chperc=$charge+($charge*($addperc/100));
echo "
                                <td class='b1 l1 $rb2' style='border-radius: 0px;'><div align='right' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>".number_format($chperc,2,".",",")."</div></td>
";

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
echo "
                                <td class='b1 l1 r2' style='border-radius: 0px;background-color: #DAF7A6;'><div align='right' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>".number_format($chro,2,".",",")."</div></td>
";
                  }
                }

echo "
                              </tr>
";

              }
            }

echo "
                             <tr>
                               <td class='t1' colspan='$coladd' height='5'></td>
                             </tr>
                             <tr>
                               <td class='t2 b2' colspan='$coladd'>
                                  <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                                    <tr>
                                      <td><div align='left' style='padding: 5px 0;'><button type='submit' class='prv' name='prc'>&#11013; Previous</button></div></td>
                                      <td><div align='right' style='padding: 5px 0;'><button type='submit' class='prc' name='finalized' ";?> onclick="return confirm('Are you sure you want to update the prices of the selected item/s?');" <?php echo ">Finalized &#10145;</button></div></td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                            <input type='hidden' name='searchmeval' value='$searchmeval' />
                            <input type='hidden' name='addperc' value='$addperc' />
                            <input type='hidden' name='trantype' value='$trantype' />
";

            if(isset($_POST['roundoff'])){
echo "
                            <input type='hidden' name='roundoff' />
";
            }

echo "
                          </form>
                        </div><td>
                      </tr>
";
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
