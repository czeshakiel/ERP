<?php
  //AUTO MEDS------------------------------------------------------------------------------------------------------------------------------------------
  $medinum=0;
  $medisql=mysqli_query($mycon1,"SELECT `productdesc`, `productcode`, SUM(`quantity`) AS `quantity`, `sellingprice`, SUM(`adjustment`) AS `adjustment`, SUM((`quantity`*`sellingprice`)-`adjustment`) AS `netmed`, `drugcode` FROM `poaddon` WHERE `caseno`='$caseno' AND `status`='pending' AND `drugcode`='' ORDER BY `refno`");
  while($medifetch=mysqli_fetch_array($medisql)){
    $productcode=$medifetch['productcode'];
    $productdesc=$medifetch['productdesc'];
    $productdesc=str_replace("ams-","",$productdesc);
    $productdesc=str_replace("-med","",$productdesc);
    $productdesc=strtoupper($productdesc);
    $medinum++;

    if(($medifetch['productcode']!="")&&($medifetch['productdesc']!="")){
      $qty=$medifetch['quantity'];
      $ramt=$medifetch['sellingprice'];
      $radj=$medifetch['adjustment'];
      $tamt=($ramt*$qty)-$radj;
      $tamt=$medifetch['netmed'];

      $mtsql=mysqli_query($mycon1,"SELECT * FROM `medtranslator` WHERE `code`='$productcode'");
      $mtcount=mysqli_num_rows($mtsql);

      $dc=$medifetch['drugcode'];

echo "
        <tr>
          <form name='CF4Part5AddMeds' method='post' action='CF4Part5Save-test20230811.php'>
          <td>
";

      if($mtcount!=0){
        $aaa=$dc;

        $agsql=mysqli_query($mycon1,"SELECT * FROM `phicmedicine` WHERE `drugcode`='$aaa'");
        while($agfetch=mysqli_fetch_array($agsql)){
          $drugdescauto=$agfetch['drugdesc'];
          $bbb=$agfetch['gencode'];
          $ccc=$agfetch['saltcode'];
          $eee=$agfetch['formcode'];
          $ddd=$agfetch['strengthcode'];
          $fff=$agfetch['unitcode'];
          $ggg=$agfetch['packagecode'];
        }

        //bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb
        $bbbsql=mysqli_query($mycon1,"SELECT `gendesc` FROM `phicmedsgeneric` WHERE `gencode`='$bbb'");
        while($bbbfetch=mysqli_fetch_array($bbbsql)){$gendescauto=$bbbfetch['gendesc'];}

        //ccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc
        $cccsql=mysqli_query($mycon1,"SELECT `saltdesc` FROM `phicmedssalt` WHERE `saltcode`='$ccc'");
        while($cccfetch=mysqli_fetch_array($cccsql)){$saltdescauto=$cccfetch['saltdesc'];}

        //ddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd
        $dddsql=mysqli_query($mycon1,"SELECT `strengthdesc` FROM `phicmedsstrength` WHERE `strengthcode`='$ddd'");
        while($dddfetch=mysqli_fetch_array($dddsql)){$strengthdescauto=$dddfetch['strengthdesc'];}

        //eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
        $eeesql=mysqli_query($mycon1,"SELECT `formdesc` FROM `phicmedsform` WHERE `formcode`='$eee'");
        while($eeefetch=mysqli_fetch_array($eeesql)){$formdescauto=$eeefetch['formdesc'];}

        //fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff
        $fffsql=mysqli_query($mycon1,"SELECT `unitdesc` FROM `phicmedsunit` WHERE `unitcode`='$fff'");
        while($ffffetch=mysqli_fetch_array($fffsql)){$unitdescauto=$ffffetch['unitdesc'];}

        //ggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg
        $gggsql=mysqli_query($mycon1,"SELECT `packagedesc` FROM `phicmedspackage` WHERE `packagecode`='$ggg'");
        while($gggfetch=mysqli_fetch_array($gggsql)){$packagedescauto=$gggfetch['packagedesc'];}

        $generic="";

        $genoc="1";

echo "
            <table>
              <tr>
                <td><label style='text-decoration: underline;'>MEDICINE</label></td>
              </tr>
            </table>
            <table style='margin-top: 5px; text-align: left;'>
              <tr>
                <th><label style='font-size:13px;'>Complete Drug Description</label></th>
              </tr>
              <tr>
                <td>
                  <select name='pDrugCode' id='pDrugCode' class='form-control' style='width:auto;margin:0px 10px 0px 0px;'>
                    <option value='$aaa'>$drugdescauto</option>
                  </select>
                </td>
                <td width='5'></td>
                <td><a href='../2019codes/CF4Meds/MedSearchGen.php?Assign=Assign+Code&code=$productcode&gen=$generic' target='_blank' style='text-decoration: none;'><div align='center' style='color: red;'>&nbsp;Edit Generic Name&nbsp;</div></a></td>
              </tr>
            </table>
            <table style='margin-top: 15px; text-align: left;'>
              <tr>
                <th><label style='font-style: italic;font-weight: normal;'>Generic Name&nbsp;</label></th>
                <th><label style='font-style: italic;font-weight: normal;'>Salt&nbsp;</label></th>
                <th><label style='font-style: italic;font-weight: normal;'>Strength&nbsp;</label></th>
                <th><label style='font-style: italic;font-weight: normal;'>Form&nbsp;</label></th>
                <th><label style='font-style: italic;font-weight: normal;'>Unit&nbsp;</label></th>
                <th><label style='font-style: italic;font-weight: normal;'>Package</label></th>
              </tr>
              <tr>
                <td>
                  <select name='pGeneric' id='pGeneric' class='form-control' style='width:auto;margin:0px 10px 0px 0px;'>
                    <option value='$bbb' selected='selected'>$gendescauto</option>
                  </select>
                </td>
                <td>
                  <select name='pSalt' id='pSalt' class='form-control' style='width:auto;margin:0px 10px 0px 0px;'>
                    <option value='$ccc' selected='selected'>$saltdescauto</option>
                  </select>
                </td>
                <td>
                  <select name='pStrength' id='pStrength' class='form-control' style='width:auto;margin:0px 10px 0px 0px;'>
                    <option value='$ddd' selected='selected'>$strengthdescauto</option>
                  </select>
                </td>
                <td>
                  <select name='pForm' id='pForm' class='form-control' style='width:auto; margin:0px 10px 0px 0px;'>
                    <option value='$eee' selected='selected'>$formdescauto</option>
                  </select>
                </td>
                <td>
                  <select name='pUnit' id='pUnit' class='form-control' style='width:auto;margin:0px 10px 0px 0px;'>
                    <option value='$fff' selected='selected'>$unitdescauto</option>
                  </select>
                </td>
                <td>
                  <select name='pPackage' id='pPackage' class='form-control' style='width:auto;margin:0px 10px 0px 0px;'>
                    <option value='$ggg' selected='selected'>$packagedescauto</option>
                  </select>
                </td>
              </tr>
            </table>
";
      }
      else{
echo "
            <input type='hidden' name='pDrugCode' value='' />
            <input type='hidden' name='pGeneric' value='' />
            <input type='hidden' name='pSalt' value='' />
            <input type='hidden' name='pStrength' value='' />
            <input type='hidden' name='pForm' value='' />
            <input type='hidden' name='pUnit' value='' />
            <input type='hidden' name='pPackage' value='' />
";

        $generic=$productdesc;
        $genoc="0";
      }

      if($genoc=="0"){
echo "
            <table style='margin-top: 15px; text-align: left;'>
              <tbody>
                <tr>
                  <td>
                    <label style='font-size:13px;'>Generic Name/Salt/Strength/Form/Unit/Package</label>
                  </td>
                </tr>
                <tr>
                  <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><input type='text' name='pGenericFreeText' id='pGenericFreeText' class='form-control' value='$generic' style='width: 300px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase' autocomplete='off' maxlength='500' /></td>
";

        if($mtcount==0){
echo "
                      <td><a href='../2019codes/CF4Meds/MedSearchGen.php?Assign=Assign+Code&code=$productcode&caseno=$caseno' target='_blank' style='text-decoration: none;'><div align='center' style='color: red;'>&nbsp;Add Proper Generic Name&nbsp;</div></a></td>
";
        }

echo "
                    </tr>
                  </table></div></td>
                </tr>
              </tbody>
            </table>
";
      }
      else{
echo "
            <input type='hidden' name='pGenericFreeText' value='' />
";
      }


      $pairsql=mysqli_query($mycon1,"SELECT `route` FROM `productoutaddinfo` WHERE `caseno`='$caseno' AND `code`='$productcode' AND `route` NOT LIKE '' GROUP BY `route`");
      $paircount=mysqli_num_rows($pairsql);

      $colr="";
      if($paircount>1){$colr="colspan='2'";}

      $paifsql=mysqli_query($mycon1,"SELECT `frequency` FROM `productoutaddinfo` WHERE `caseno`='$caseno' AND `code`='$productcode' AND `frequency` NOT LIKE '' GROUP BY `frequency`");
      $paifcount=mysqli_num_rows($paifsql);

      $colf="";
      if($paifcount>1){$colf="colspan='2'";}

echo "
            <table style='margin-top: 15px; text-align: left;'>
              <tbody>
                <tr>
                  <td $colr><label style='font-size:13px;'>Route</label></td>
                  <td $colf><label style='font-size:13px;'>Frequency</label></td>
                  <td></td>
                </tr>
                <tr>
";


      if($paircount==0){
        $sroute="";

echo "
                  <td>
                    <input type='text' name='pRoute' id='pRoute' class='form-control' value='$sroute' style='width: 220px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase' maxlength='500' placeholder='Route' required />
                  </td>
";
      }
      else{
        if($paircount==1){
          $pairfetch=mysqli_fetch_array($pairsql);
          $sroute=$pairfetch['route'];

echo "
                  <td>
                    <input type='text' name='pRoute' id='pRoute' class='form-control' value='$sroute' style='width: 220px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase' maxlength='500' placeholder='Route' required />
                  </td>
";
        }
        else{
echo "
                  <td>
                    <select name='pRoute' id='pRoute' class='form-control' style='width: 220px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase'>
";

          while($pairfetch=mysqli_fetch_array($pairsql)){
            $sroute=$pairfetch['route'];
echo "
                      <option>$sroute</option>
";
          }

echo "
                    </select>
                  </td>
                  <td>
                    <input type='text' name='pRoutecustom' class='form-control unhide' value='' style='width: 320px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase' maxlength='500' placeholder='Other Route' />
                  </td>
";
        }
      }

      if($paifcount==0){
        $sfreq="";

echo "
                  <td>
                    <input type='text' name='pFrequencyInstruction' id='pFrequencyInstruction' class='form-control' value='$sfreq' style='width: 220px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase' maxlength='500' placeholder='Frequency' required />
                  </td>
";
      }
      else{
        if($paifcount==1){
          $paiffetch=mysqli_fetch_array($paifsql);
          $sfreq=$paiffetch['frequency'];

echo "
                  <td>
                    <input type='text' name='pFrequencyInstruction' id='pFrequencyInstruction' class='form-control' value='$sfreq' style='width: 220px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase' maxlength='500' placeholder='Frequency' required />
                  </td>
";
        }
        else{
echo "
                  <td>
                    <select name='pFrequencyInstruction' id='pFrequencyInstruction' class='form-control' style='width: 220px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase'>
";

          while($paiffetch=mysqli_fetch_array($paifsql)){
            $sfreq=$paiffetch['frequency'];
echo "
                      <option>$sfreq</option>
";
          }

echo "
                    </select>
                  </td>
                  <td>
                    <input type='text' name='pFrequencyInstructioncustom' class='form-control unhide' value='' style='width: 320px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase' maxlength='500' placeholder='Other Frequency' />
                  </td>
";
        }
      }

echo "
                </tr>
              </tbody>
            </table>
            <table style='margin-top: 15px; text-align: left;'>
              <tr>
                <td><label style='font-size:13px;'>Quantity</label></td>
                <td><label style='font-size:13px;'>Total Amount Price</label></td>
              </tr>
              <tr>
                <td>
                  <input type='number' name='pQuantity' id='pQuantity' class='form-control' value='$qty' style='width: 80px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase' autocomplete='off' maxlength='5' placeholder='Qty.' required />
                </td>
                <td>
                  <input type='number' step='0.01' name='pTotalPrice' id='pTotalPrice' class='form-control' value='$tamt' style='width: 150px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase' autocomplete='off' maxlength='15' placeholder='Total Amount' required />
                </td>
              </tr>
            </table>
          </td>
          <td style='vertical-align: middle'><div align='center'>
            <input type='image' name='imageField' src='Resources/Button/AddMed-Out.png' id='ImageA' height='38' onmouseover=MM_swapImage('ImageA','','Resources/Button/AddMed-Over.png',1) onmouseout='MM_swapImgRestore()' title='Add Medicine' />
          </div></td>
          <input type='hidden' name='caseno' value='$caseno' />
          <input type='hidden' name='source' value='$source' />
          <input type='hidden' name='sp' value='$ramt' />
          </form>
        </tr>
";
    }
  }
  //END AUTO MEDS--------------------------------------------------------------------------------------------------------------------------------------
?>
