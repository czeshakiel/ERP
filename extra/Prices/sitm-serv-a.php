<?php
        if(isset($_POST['code'])){
          $cda=$_POST['code'];

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
                                <td class='t2 b2 l1 r2' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 11px;font-weight: bold;color: #000000;padding: 3px 5px;'>Charge Price</div></td>
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
                               <td class='t1' colspan='6' height='5'></td>
                             </tr>
                             <tr>
                               <td class='t2 b2' colspan='6'>
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
