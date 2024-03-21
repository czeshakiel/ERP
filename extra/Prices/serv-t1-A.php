<?php
      $searchme=mysqli_real_escape_string($conn,$_POST['searchme']);
      $unit=mysqli_real_escape_string($conn,$_POST['unit']);

      if($unit=="All"){$zxsql=mysqli_query($conn,"SELECT * FROM `receiving` WHERE `description` LIKE '%$searchme%' AND (`unit` LIKE '2D ECHO' OR `unit` LIKE 'CT SCAN' OR `unit` LIKE 'ECG' OR `unit` LIKE 'LABORATORY' OR `unit` LIKE 'ULTRASOUND' OR `unit` LIKE 'XRAY' OR `unit` LIKE 'PHYSICAL THERAPY' OR `unit` LIKE 'HEARTSTATION' OR `unit` LIKE 'EEG') ORDER BY `description`");}
      else{$zxsql=mysqli_query($conn,"SELECT * FROM `receiving` WHERE `description` LIKE '%$searchme%' AND `unit` LIKE '$unit' ORDER BY `description`");}
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
                          <form method='post'>
                            <table border='0' cellpadding='0' cellspacing='0' class='hoverTable'>
                              <tr>
                                <td class='t2 b2 l2' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>#</div></td>
                                <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'><input type='checkbox' class='checkall' id='select_all' /></div></td>
                                <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>Description</div></td>
                                <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>Test Type</div></td>
                                <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>Cash Price</div></td>
                                <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>Charge Price</div></td>
                                <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>MDRP</div></td>
                                <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>Type</div></td>
                                <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>Restrictions</div></td>
                                <td class='t2 b2 l1 r2' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>Action</div></td>
                              </tr>
";

        $zx=0;
        while($zxfetch=mysqli_fetch_array($zxsql)){
          $cod=$zxfetch['code'];
          $itd=mb_strtoupper(trim($zxfetch['description']));
          $unt=$zxfetch['unit'];
          $itn=$zxfetch['itemname'];
          $lot=$zxfetch['lotno'];
          $pnf=$zxfetch['pnf'];
          $tes=$zxfetch['testcode'];
          $gte=$zxfetch['gtestcode'];
          $op4=$zxfetch['optset4'];
          $lot=$zxfetch['lotno'];
          $zx++;

          $dis="";

          if($tes=="0"){$tesdis="NON-MDRP";}else{$tesdis="MDRP";}

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

          $cash=$opd;
          $charge=$phi;

          if($unt=="LABORATORY"){$ht=760;}else{$ht=705;}

echo "
                              <tr>
                                <td class='b1 l2' style='border-radius: 0px;'><div align='left' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>$zx</div></td>
                                <td class='b1 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'><input type='checkbox' class='case' name='code[]' value='$cod' /></div></td>
                                <td class='b1 l1' style='border-radius: 0px;'><div align='left' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>$itd</div></td>
                                <td class='b1 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>$testcat</div></td>
                                <td class='b1 l1' style='border-radius: 0px;'><div align='right' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>".number_format($cash,2,".",",")."</div></td>
                                <td class='b1 l1' style='border-radius: 0px;'><div align='right' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>".number_format($charge,2,".",",")."</div></td>
                                <td class='b1 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>$tesdis</div></td>
                                <td class='b1 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>$unt</div></td>
                                <td class='b1 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>$dis</div></td>
                                <td class='b1 l1 r2' style='border-radius: 0px;'><div align='center' style='padding: 3px 5px;'>
";

          if($up==0){
echo "
                                  <button type='button' name='edt' class='btndis' title='Edit Disabled' disabled>&#x270E;</button>
";
          }
          else{
echo "
                                  <button type='button' name='edt' type='button' class='btn' title='Edit'"; ?> onclick="<?php echo "window.open('ms/?code=$cod".$usr."', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=30,left=700,width=480,height=$ht');";?>" <?php echo ">&#x270E;</button>
";
          }

echo "
                                </div></td>
                              </tr>
";
        }

echo "
                              <tr>
                                <td class='t2' colspan='10'><div align='center' style='padding: 3px 5px;'>
                                  <button type='submit' name='prc' class='prc'>Change Price</button>
                                <div></td>
                              </tr>
                            </table>
                            <input type='hidden' name='searchmeval' value='$searchmeval' />
                          </form>
                        </div></td>
                      </tr>
";
      }
?>
