<?php
$searchme=mysqli_real_escape_string($conn,$_POST['searchme']);

$stk="CSR2";
$len=strlen($searchme);
$cac=base64_decode($_SESSION['cac']);

$adu="";
$adp="";
$zz=0;
$zzsql=mysqli_query($conn,"SELECT `accounttitle` FROM `accounttitle` WHERE `grp`='SUPPLIES'");
$zzcount=mysqli_num_rows($zzsql);
while($zzfetch=mysqli_fetch_array($zzsql)){
  $zzacc=$zzfetch['accounttitle'];
  $zz++;

  if($zz>1){$mid=" OR ";}else{$mid="";}
  $adu=$adu.$mid."r.`unit` LIKE '$zzacc'";
  $adp=$adp." OR `productsubtype` LIKE '$zzacc'";
}

//KNOW LOCK STATUS---------------------------------------------------------------------------------
$pen=0;
$dis=0;
if($admstatus=="LOCKED"){
  $pensql=mysqli_query($conn,"SELECT `refno`, `productdesc`, `invno`, `datearray`, `approvalno` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > '0' AND `administration`='pending' AND (`productsubtype` LIKE '%PHARMACY/MEDICINE%' $adp)");
  while($penfetch=mysqli_fetch_array($pensql)){
    $prefno=$penfetch['refno'];
    $pdesc=$penfetch['productdesc'];
    $pinvno=$penfetch['invno'];
    $pdatearray=$penfetch['datearray'];
    $papprovalno=$penfetch['approvalno'];

    if($papprovalno==""){
      $pstartdt=$pdatearray." ".$pinvno;
    }
    else{
      $pstartdt=$penfetch['approvalno'];
    }

    $penddt=date("Y-m-d H:i:s");

    $date1 = new DateTime($pstartdt);
    $date2 = new DateTime($penddt);

    $diff = $date2->diff($date1);

    $hours = $diff->h;
    $hours = $hours + ($diff->days*24);

    //echo $prefno." --> ".$pdesc." --> ".$pstartdt." to ".$penddt." --> ".$hours."<br />";
    if($hours>='12'){
      $pen+=1;
    }
  }

  $dissql=mysqli_query($conn,"SELECT `refno`, `productdesc`, `invno`, `datearray`, `approvalno` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge' AND `quantity` > '0' AND `administration`='dispensed' AND (`productsubtype` LIKE '%PHARMACY/MEDICINE%' $adp)");
  while($disfetch=mysqli_fetch_array($dissql)){
    $drefno=$disfetch['refno'];
    $ddesc=$disfetch['productdesc'];
    $dinvno=$disfetch['invno'];
    $ddatearray=$disfetch['datearray'];
    $dapprovalno=$disfetch['approvalno'];

    if($dapprovalno==""){
      $dstartdt=$ddatearray." ".$dinvno;
    }
    else{
      $dstartdt=$disfetch['approvalno'];
    }

    $denddt=date("Y-m-d H:i:s");

    $ddate1 = new DateTime($dstartdt);
    $ddate2 = new DateTime($denddt);

    $ddiff = $ddate2->diff($ddate1);

    $dhours = $ddiff->h;
    $dhours = $dhours + ($ddiff->days*24);

    //echo $drefno." --> ".$ddesc." --> ".$dstartdt." to ".$denddt." --> ".$dhours."<br />";
    if($dhours>='12'){
      $dis+=1;
    }
  }//echo $pen." AND ".$dis;

  if(($pen==0)&&($dis==0)){
    mysqli_query($conn,"UPDATE `admission` SET `status`='Active' WHERE `caseno`='$caseno'");
  }
}
//KNOW LOCK STATUS END-----------------------------------------------------------------------------

//PHARMACY START-----------------------------------------------------------------------------------
$lcksql=mysqli_query($conn,"SELECT `membership`, `hmomembership`, `status` FROM `admission` WHERE `caseno`='$caseno'");
$lckfetch=mysqli_fetch_array($lcksql);
$lck=$lckfetch['status'];

if($lck=="LOCKED"){
  $penlabel="";
  if($pen>0){
    if($dis>1){$qwe="are items";}
    else{$qwe="is an item";}

    $penlabel="<span style='color: #952BFF;font-size: 16px;'>The system detected that there $qwe needed to be dispensed.</span>";
  }

  $dislabel="";
  if($dis>0){
    if($dis>1){$asd="are items";}
    else{$asd="is an item";}

    $dislabel="<span style='color: #952BFF;font-size: 16px;'>The system detected that there $asd needed to be administered.</span>";
  }

echo "
      <div align='left' style='color: red;font-family: arial;font-size: 20px;font-weight: bold;'>PHARMACY CART IS DISABLED!!! $penlabel $dislabel</div>
";
}
else{
  if($len>1){
    if($ct=="phs"){
      $zxsql=mysqli_query($conn,"SELECT r.`unit`, r.`pnf`, r.`lotno`, r.`testcode`, r.`gtestcode`, r.`code`, r.`description`, r.`generic`, SUM(s.`quantity`) AS `soh`, r.`optset4` FROM `stocktable` s, `receiving` r WHERE s.`code`=r.`code` AND ($adu) AND (r.`description` LIKE '%$searchme%' OR r.`generic` LIKE '$searchme%') AND s.`dept`='$stk' GROUP BY s.`code` ORDER BY r.`description`");
      $zxcount=mysqli_num_rows($zxsql);

      if($zxcount==0){
echo "
      <div align='left' style='font-family: arial;font-size: 16px;font-weight: bold;color: #FF0000;'>0 results found!!!</div>
";
      }
      else{
echo "
        <table border='0' cellpadding='0' cellspacing='0' class='hoverTable'>
          <tr>
            <form id='mySignUp' method='post'>
            <td colspan='5' style='padding: 5px 0;background-color: #FFFFFF;'><div align='left' style='font-family: arial;font-size: 11px;font-weight: bold;color: #0374A5;background-color: #FFFFFF;'><span onclick=document.getElementById('mySignUp').submit(); style='cursor: pointer;'>Multi-Select</span></div></td>
            <input type='hidden' name='searchme' value='$searchme' />
            <input type='hidden' name='searchgo' />
            <input type='hidden' name='msgo' />
            </form>
          </tr>
          <tr>
            <td class='t2 b2 l2' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;padding: 3px 5px;'>#</div></td>
            <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;padding: 3px 5px;'>Description</div></td>
            <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;padding: 3px 5px;'>SOH</div></td>
            <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;padding: 3px 5px;'>Action</div></td>
            <td class='t2 b2 l1 r2' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 12px;font-weight: bold;color: #000000;padding: 3px 5px;'>Type</div></td>
          </tr>
";

        $zx=0;
        while($zxfetch=mysqli_fetch_array($zxsql)){
          $cod=$zxfetch['code'];
          $itd=mb_strtoupper(trim($zxfetch['description']));
          $itg=mb_strtoupper(trim($zxfetch['generic']));
          $unt=$zxfetch['unit'];
          $lot=$zxfetch['lotno'];
          $pnf=$zxfetch['pnf'];
          $tes=$zxfetch['testcode'];
          $gte=$zxfetch['gtestcode'];
          $op4=$zxfetch['optset4'];
          $soh=$zxfetch['soh'];
          $zx++;

          $itd=str_replace("AMS-","",$itd);
          $itd=str_replace("-MED","",$itd);

          if(($dept=="PHARMACY")&&(stripos($op4, "-1|") !== FALSE)){$gte=1;}
          if((($dept=="PHARMACY_OPD")||($dept=="pharmacy_opd"))&&(stripos($op4, "-2|") !== FALSE)){$gte=1;}
          if((($dept=="CSR2")||($dept=="csr2"))&&(stripos($op4, "-3|") !== FALSE)){$gte=1;}
          if(($dept=="BILLING")&&(stripos($op4, "-4|") !== FALSE)){$gte=1;}
          if(($dept=="NS1")&&(stripos($op4, "-5|") !== FALSE)){$gte=1;}
          if(($dept=="NS2")&&(stripos($op4, "-6|") !== FALSE)){$gte=1;}
          if(($dept=="NS3")&&(stripos($op4, "-7|") !== FALSE)){$gte=1;}
          if(($dept=="NS 4")&&(stripos($op4, "-8|") !== FALSE)){$gte=1;}
          if(($dept=="NS 5A")&&(stripos($op4, "-9|") !== FALSE)){$gte=1;}
          if(($dept=="NS 5B")&&(stripos($op4, "-10|") !== FALSE)){$gte=1;}
          if(($dept=="NS 6")&&(stripos($op4, "-11|") !== FALSE)){$gte=1;}

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

echo "
          <tr $pnfwarn>
            <td class='b1 l2' style='border-radius: 0px;'><div align='left' style='font-family: arial;font-weight: bold;font-size: 14px;color: #000000;padding: 3px 5px;'>$zx</div></td>
            <td class='b1 l1' style='border-radius: 0px;'><div align='left' style='font-family: arial;font-weight: bold;font-size: 14px;color: #000000;padding: 3px 5px;'>$itd"; if($itg!=""){echo " [<span style='color: blue;font-size: 10px;'>".$itg."</span>]";} echo "</div></td>
            <td class='b1 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-weight: bold;font-size: 14px;color: #000000;padding: 3px 5px;'>$soh</div></td>
            <td class='b1 l1' style='border-radius: 0px;'><div align='left' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 5px;'>
              <form method='post'>
                <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                  <tr $pnfwarn>
                    <td width='60' style='border-radius: 0px;'><div align='center' style='padding: 3px 5px;'><input type='number' style='height: 30px;width: 60px;border-radius: 5px;border: 2px solid #000000;' placeholder='Qty.' name='qty' value='1' $qtdis $ronl /></div></td>
";

          if($gte==1){
echo "
                    <td style='border-radius: 0px;'><div align='center' style='font-family: arial;font-weight: bold;font-size: 14px;color: #FF0000;'>DISABLED</div></td>
";
          }
          else{
            if($pnf!="PNDF"){
echo "
                    <td style='border-radius: 0px;'><div align='center' style='font-family: arial;font-weight: bold;font-size: 14px;color: #FFFFFF;'>NON-PNDF</div></td>
";
            }
            else{
echo "
                    <td style='border-radius: 0px;'>
                      <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                        <tr $pnfwarn>
";
              if($soh>0){
                if($totgross<=$cl){
                  $kcst=preg_split("/\-/",$caseno);
                  if(($kcst[0]!="W")&&($kcst[0]!="WD")){
echo "
                          <td style='border-radius: 0px;'><div align='center' style='padding: 3px 2px;'><button type='submit' name='trantype' value='charge' class='btn'>Charge</button></div></td>
";
                  }
                }

                if($pnf=="PNDF"){
echo "
                          <td style='border-radius: 0px;'><div align='center' style='padding: 3px 2px;'><button type='submit' name='trantype' value='cash' class='btn cancel'>Cash</button></div></td>
";
                }

                if(($cac=="4")||($cac=="5")){
                  //if($totgross>$cl){
echo "
                          <td style='border-radius: 0px;'><div align='center' style='padding: 3px 2px;'><button type='submit' name='trantype' value='tpl' class='btn tpl'>TPL</button></div></td>
";
                  //}
                }
              }

echo "
                        </tr>
                      </table>
                    </td>
";
            }
          }

echo "
                  </tr>
                </table>
                <input type='hidden' name='itmcode' value='$cod' />
                <input type='hidden' name='itmtype' value='$unt' />
                <input type='hidden' name='itmname' value='$itn' />
                <input type='hidden' name='stk' value='$stk' />
                <input type='hidden' name='addphms' />
              </form>
            </div></td>
            <td class='b1 l1 r2' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-weight: bold;font-size: 14px;color: #1E8449;padding: 3px 5px;'>$unt</div></td>
          </tr>
";
        }

echo "
          <tr>
            <td class='t2' colspan='5'><div align='left' style='color: #FF0000;font-family: arial;font-size: 14px;padding-top: 5px;'>N o t h i n g&nbsp;&nbsp;&nbsp;f o l l o w s . . .</div></td>
          </tr>
        </table>
";
      }
    }
  }
}
//PHARMACY END-------------------------------------------------------------------------------------
?>
