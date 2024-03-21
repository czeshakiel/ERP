<?php
//-------------------------------------------------------------------------------------------------
include("../extra/LabExpress/agegroup.php");

$count=mysqli_real_escape_string($conn,$_POST['count']);

echo "
<form method='post'>
  <input type='hidden' name='stest' />
  <input type='hidden' name='srefno' value='$srefno' />
  <input type='hidden' name='ltype' value='$stype' />
  <button type='submit' class='btn btn-warning text-white' style='font-weight: bold;' title='Back to Select test'><i class='icofont-hand-drawn-left'></i> Back</button>
</form>
<br /><br />
";

if($stype=="hematology"){$pref="HE";}
else if($stype=="chemistry"){$pref="CH";}
else if($stype=="serology"){$pref="SE";}
else if($stype=="miscellaneous"){$pref="MS";}
else{$pref="OT";}

$rnd=strtoupper(substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 3));
$prbtno=$pref.date("YmdHis").$rnd;

echo "
<div align='left'>
  <form method='post'>
    <table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td class='t2 b2 l2' colspan='2'><div align='left' style='padding: 0 3px 0 3px;color: #0784C0;font-family: arial;font-weight: bold;font-size: 14px;'>Laboratory No.</div></td>
        <td class='t2 b2 l1 r2' colspan='2'><div align='left' style='padding: 5px;'><input type='text' name='labno' placeholder='Laboratory Number' style='width: 100%;height: 35px;font-size: 14px;border-radius: 5px;border: 2px solid #000000;' value='' autofocus required /></div></td>
      <tr>
      <tr>
        <td class='b2 l2' colspan='2'><div align='left' style='padding: 0 3px 0 3px;color: #0784C0;font-family: arial;font-weight: bold;font-size: 14px;'>Print Batch No.</div></td>
        <td class='b2 l1 r2' colspan='2'><div align='left' style='padding: 5px;'><input type='text' name='printbatchno' placeholder='Laboratory Number' style='width: 100%;height: 35px;font-size: 14px;border-radius: 5px;border: 2px solid #000000;' value='$prbtno' required /></div></td>
      <tr>
      <tr>
        <td class='b2 l2' colspan='2'><div align='left' style='padding: 0 3px 0 3px;color: #0784C0;font-family: arial;font-weight: bold;font-size: 14px;'>Pathologist</div></td>
        <td class='b2 l1 r2' colspan='2'><div align='left' style='padding: 5px;'>
          <select name='pt' style='width: 100%;height: 35px;font-size: 14px;border-radius: 5px;border: 2px solid #000000;' required>
            <option value='334'>NENA C. SALCEDO - LINGAYON, MD, FPSP - 092052</option>
          </select>
        </div></td>
      <tr>
      <tr>
        <td class='b2 l2' colspan='2'><div align='left' style='padding: 0 3px 0 3px;color: #0784C0;font-family: arial;font-weight: bold;font-size: 14px;'>Med. Tech</div></td>
        <td class='b2 l1 r2' colspan='2'><div align='left' style='padding: 5px;'>
          <select name='mt' style='width: 100%;height: 35px;font-size: 14px;border-radius: 5px;border: 2px solid #000000;' required>
            <option></option>
";

$mtsql=mysqli_query($conn,"SELECT `name` , `empid` FROM `nsauth` WHERE `station`='LABORATORY' AND `Access`='99' ORDER BY `name`");
while($mtfetch=mysqli_fetch_array($mtsql)){
echo "
            <option value='".$mtfetch['empid']."'>".mb_strtoupper($mtfetch['name'])."</option>
";
}

echo "
          </select>
        </div></td>
      <tr>
";

$cssp=preg_split("/\-/",$caseno);
$csres=$cssp[0];

if($csres=="I"){$drreq="required";}else{$drreq="";}

echo "
      <tr>
        <td class='b2 l2' colspan='2'><div align='left' style='padding: 0 3px 0 3px;color: #0784C0;font-family: arial;font-weight: bold;font-size: 14px;'>Physician</div></td>
        <td class='b2 l1 r2' colspan='2'><div align='left' style='padding: 5px;'>
          <select name='ap' style='width: 100%;height: 35px;font-size: 14px;border-radius: 5px;border: 2px solid #000000;' $drreq>
            <option>$ap</option>
";

$dfsql=mysqli_query($conn,"SELECT `code`, `name` FROM `docfile` ORDER BY `name`");
while($dffetch=mysqli_fetch_array($dfsql)){
$dccode=$dffetch['code'];
$dcname=mb_strtoupper($dffetch['name']);

if($ap==$dccode){
  $dcops="selected";
}
else{
  if($ap==$dcname){
    $dcops="selected";
  }
  else{
    $dcops="";
  }
}


echo "
            <option value='$dccode' $dcops>$dcname</option>
";
}
echo "
          </select>
        </div></td>
      <tr>
      <tr>
        <td colspan='3' height='10'></td>
      <tr>
";

    $x=0;
    for($z=0;$z<=$count;$z++){
      $rl="refno".$z;
      if(isset($_POST[$rl])){
        $refno=$_POST[$rl];
        $x++;

        $asql=mysqli_query($conn,"SELECT `productcode`, `productdesc` FROM `productout` WHERE `refno`='$refno'");
        $afetch=mysqli_fetch_array($asql);
        $pcode=$afetch['productcode'];
        $desc=$afetch['productdesc'];

        $kgrpsql=mysqli_query($conn,"SELECT `grp` FROM `labnormalvalues` WHERE `code`='$pcode' GROUP BY `code`");
        $kgrpfetch=mysqli_fetch_array($kgrpsql);
        $kgrp=$kgrpfetch['grp'];



//START WIDAL TEST---------------------------------------------------------------------------------
        if($kgrp=="8"){
echo "
      <tr>
        <td class='t2 b2 l2 r2' colspan='4'><div align='left' style='color: blue;font-family: arial;font-weight: bold;font-size: 16px;padding: 3px;'><i class='fa fa-star'></i> ".$desc."</div></td>
      </tr>
      <tr>
        <td class='t2 b1 l2 r2' colspan='4'>
          <table border='0' width='100%' cellpadding='0' cellspacing='0'>
";

echo "
            <tr>
              <td class='b1'></td>
";

          $b=0;
          $bsql=mysqli_query($conn,"SELECT `rescollbl` FROM `labnormalvalues` WHERE `code`='$pcode' AND `stat`='1' GROUP BY `rescol` ORDER BY `rescol`");
          $bcount=mysqli_num_rows($bsql);
          while($bfetch=mysqli_fetch_array($bsql)){
            $b++;
            $rescollbl[$b]=$bfetch['rescollbl'];

echo "
              <td class='b1 l1' width='15%'><div align='center' style='font-family: arial;font-weight: bold;font-size: 12px;padding: 3px 3px;'>$rescollbl[$b]</div></td>
";
          }

echo "
            </tr>
";

          $c=0;
          $csql=mysqli_query($conn,"SELECT `resrowlbl` FROM `labnormalvalues` WHERE `code`='$pcode' AND `stat`='1' GROUP BY `resrow` ORDER BY `resrow`");
          $ccount=mysqli_num_rows($csql);
          while($cfetch=mysqli_fetch_array($csql)){
            $c++;
            $resrowlbl[$c]=$cfetch['resrowlbl'];
echo "
            <tr>
              <td class='b1'><div align='left' style='font-family: arial;font-weight: bold;font-size: 12px;padding: 3px 3px;'>$resrowlbl[$c]</div></td>
";

            for($zy=1;$zy<=$b;$zy++){
              $dsql=mysqli_query($conn,"SELECT `no`, `others` FROM `labnormalvalues` WHERE `code`='$pcode' AND `stat`='1' AND `rescollbl`='$rescollbl[$zy]' AND `resrowlbl`='$resrowlbl[$c]'");
              $dfetch=mysqli_fetch_array($dsql);
              $dno=$dfetch['no'];
              $doth=$dfetch['others'];

              $dothspl=preg_split("/\|/",$doth);

echo "
              <td class='b1 l1'><div align='center' style='padding: 5px 5px;'>
                <input type='hidden' name='no-$x-$c-$zy' value='$dno' />
                <select name='result-$x-$c-$zy' style='height: 30px;'>
                  <option selectted></option>
";

              for($dx=0;$dx<(count($dothspl)-1);$dx++){
echo "
                <option>$dothspl[$dx]</option>
";
              }

echo "
                </select>
              </div></td>
";
            }

echo "
            </tr>
";
          }

echo "
          </table>
          <input type='hidden' name='srtype' value='2' />
          <input type='hidden' name='colc' value='$bcount' />
          <input type='hidden' name='rowc' value='$ccount' />
          <input type='hidden' name='code' value='$pcode' />
        </td>
      </tr>
";
        }
//END WIDAL TEST-----------------------------------------------------------------------------------
//START SPUTUM TEST---------------------------------------------------------------------------------
        else if($kgrp=="9"){
echo "
      <tr>
        <td class='t2 b2 l2 r2' colspan='4'><div align='left' style='color: blue;font-family: arial;font-weight: bold;font-size: 16px;padding: 3px;'><i class='fa fa-star'></i> ".$desc."</div></td>
      </tr>
      <tr>
        <td class='t2 b1 l2 r2' colspan='4'>
          <table border='0' width='100%' cellpadding='0' cellspacing='0'>
";

echo "
            <tr>
              <td class='b1'></td>
";

          $b=0;
          $bsql=mysqli_query($conn,"SELECT `rescollbl` FROM `labnormalvalues` WHERE `code`='$pcode' AND `stat`='1' GROUP BY `rescol` ORDER BY `rescol`");
          $bcount=mysqli_num_rows($bsql);
          while($bfetch=mysqli_fetch_array($bsql)){
            $b++;
            $rescollbl[$b]=$bfetch['rescollbl'];

echo "
              <td class='b1 l1' width='15%'><div align='center' style='font-family: arial;font-weight: bold;font-size: 12px;padding: 3px 3px;'>$rescollbl[$b]</div></td>
";
          }

echo "
            </tr>
";

          $c=0;
          $csql=mysqli_query($conn,"SELECT `resrowlbl` FROM `labnormalvalues` WHERE `code`='$pcode' AND `stat`='1' GROUP BY `resrow` ORDER BY `resrow`");
          $ccount=mysqli_num_rows($csql);
          while($cfetch=mysqli_fetch_array($csql)){
            $c++;
            $resrowlbl[$c]=$cfetch['resrowlbl'];
echo "
            <tr>
              <td class='b1'><div align='left' style='font-family: arial;font-weight: bold;font-size: 12px;padding: 3px 3px;'>$resrowlbl[$c]</div></td>
";

            for($zy=1;$zy<=$b;$zy++){
              $dsql=mysqli_query($conn,"SELECT `no`, `others` FROM `labnormalvalues` WHERE `code`='$pcode' AND `stat`='1' AND `rescollbl`='$rescollbl[$zy]' AND `resrowlbl`='$resrowlbl[$c]'");
              $dfetch=mysqli_fetch_array($dsql);
              $dno=$dfetch['no'];
              $doth=$dfetch['others'];

              $dothspl=preg_split("/\|/",$doth);

echo "
              <td class='b1 l1'><div align='center' style='padding: 5px 5px;'>
                <input type='hidden' name='no-$x-$c-$zy' value='$dno' />
                <input type='text' name='result-$x-$c-$zy' style='height: 30px;' placeholder='Input Result' value='' required />
              </div></td>
";
            }

echo "
            </tr>
";
          }

echo "
          </table>
          <input type='hidden' name='srtype' value='3' />
          <input type='hidden' name='colc' value='$bcount' />
          <input type='hidden' name='rowc' value='$ccount' />
          <input type='hidden' name='code' value='$pcode' />
        </td>
      </tr>
";
        }
//END SPUTUM AFB-----------------------------------------------------------------------------------
//SART ALL OTHERS----------------------------------------------------------------------------------
        else{
          if($x==1){
echo "
      <tr>
        <td class='t2 b1 l2'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;'>#</div></td>
        <td class='t2 b1 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;'>Test</div></td>
        <td class='t2 b1 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;'>Result</div></td>
        <td class='t2 b1 l1 r2'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;'>Normal Values</div></td>
      </tr>
";
          }

echo "
      <tr>
        <td class='t2 b2 l2 r2' colspan='4'><div align='left' style='color: blue;font-family: arial;font-weight: bold;font-size: 16px;padding: 3px;'><i class='fa fa-star'></i> ".$desc."</div></td>
      </tr>
";


          $b=0;
          $bsql=mysqli_query($conn,"SELECT * FROM `labnormalvalues` WHERE `code`='$pcode' AND `stat`='1' ORDER BY CAST(`sort` AS UNSIGNED)");
          while($bfetch=mysqli_fetch_array($bsql)){
            $no=$bfetch['no'];
            $code=$bfetch['code'];
            $testname=$bfetch['testname'];
            $testabr=$bfetch['testabr'];
            $sort=$bfetch['sort'];
            $amll=$bfetch['amll'];
            $amul=$bfetch['amul'];
            $afll=$bfetch['afll'];
            $aful=$bfetch['aful'];
            $cll=$bfetch['cll'];
            $cul=$bfetch['cul'];
            $nll=$bfetch['nll'];
            $nul=$bfetch['nul'];
            $displaynv=$bfetch['displaynv'];
            $others=$bfetch['others'];
            $unit=mysqli_real_escape_string($conn,$bfetch['unit']);
            $grp=$bfetch['grp'];
            $type=$bfetch['type'];
            $header=$bfetch['header'];
            $b++;

            if($amll!=""){$amll=$amll." - ";}else{$amll="";}
            if($amul!=""){$amul=$amul." ";}else{$amul="";}
            if($afll!=""){$afll=$afll." - ";}else{$afll="";}
            if($aful!=""){$aful=$aful." ";}else{$aful="";}
            if($cll!=""){$cll=$cll." - ";}else{$cll="";}
            if($cul!=""){$cul=$cul." ";}else{$cul="";}
            if($nll!=""){$nll=$nll." - ";}else{$nll="";}
            if($nul!=""){$nul=$nul." ";}else{$nul="";}

            if($unit!=""){$unitd=" ".$unit;}else{$unitd="";}

            if($displaynv!=""){
              $nv=$displaynv;
            }
            else{
              if(($grp==1)||($grp==4)){
                if(($stype=="chemistry")||($stype=="serology")){
                  if(mb_strtoupper($sex)=="M"){$nv=$amll.$amul.$unit;}
                  else if(mb_strtoupper($sex)=="F"){$nv=$afll.$aful.$unit;}
                  else{$nv=$amll.$amul.$unit;}
                }
                else{
                  if($agro=="A"){$nv=$amll.$amul.$unit;}
                  else if($agro=="AF"){$nv=$afll.$aful.$unit;}
                  else if($agro=="C"){$nv=$cll.$cul.$unit;}
                  else if($agro=="N"){$nv=$nll.$nul.$unit;}
                  else{$nv=$amll.$amul.$unit;}
                }
              }
              else if($grp==3){
                $setot=substr_count($others,"|");
                $ots=preg_split("/\|/",$others);

                for($otz=0;$otz<$setot;$otz++){
                  $otss=preg_split("/\*/",$ots[$otz]);
                  $otagl=$otss[0];
                  $otagh=$otss[1];
                  $otll=$otss[2];
                  $otul=$otss[3];

                  if(($ay>=$otagl)&&($ay<=$otagh)){
                    $nv=$otll." - ".$otul.$unitd;
                  }
                }
              }
              else{
                $nv="";
              }
            }

            if($grp==1){$intype="type='number' step='0.001'";}
            else{$intype="type='text'";}

echo "
      <tr>
        <td class='b1 l2'><div align='left' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 14px;'>$b</div></td>
        <td class='b1 l1'><div align='left' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 14px;'>$testname</div></td>
        <td class='b1 l1'><div align='center' style='padding: 5px;'>
";

            if(($grp==2)||($grp==6)){
echo "
          <input type='hidden' name='prf-$x-$b' value='' />
          <table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='center'>
                <select name='result-$x-$b' style='height: 30px;width: 215px;font-size: 15px;' autofocus>
                  <option value=''></option>
";

              $setzm=substr_count($others,"|");
              $cs=preg_split("/\|/",$others);

              for($cz=0;$cz<$setzm;$cz++){
echo "
                  <option value='".$cs[$cz]."'>".$cs[$cz]."</option>
";
              }

echo "
                </select>
              </div></td>
            </tr>
          </table>
";
            }
            else if($grp==4){
echo "
          <input type='hidden' name='prf-$x-$b' value='' />
          <input type='text' name='result-$x-$b' style='height: 30px;width: 215px;font-size: 15px;' placeholder='Type Result' value='' autofocus />
";
            }
            else{
              if($type==3){
echo "
          <input type='hidden' name='prf-$x-$b' value='' />
          <label>
            <input type='number' name='result-$x-$b' placeholder='Minutes' style='height: 30px;width: 130px;' value='' autofocus /> Min.
          </label>
          <label>
            <input type='number' name='result2-$x-$b' placeholder='Seconds' style='height: 30px;width: 130px;' value='' autofocus /> Sec.
          </label>
";
              }
              else{
                if($type==5){
echo "
          <table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td style='padding-right: 5px;'>
                <select name='prf-$x-$b' style='height: 30px;font-size: 15px;'>
                  <option value=''></option>
                  <option value='0'>&lt;</option>
                  <option value='9999999'>&gt;</option>
                </select>
              </td>
              <td>
                <input type='text' name='result-$x-$b' style='height: 30px;' placeholder='Input Result' value='' autofocus />
              </td>
            </tr>
          </table>
";
                }
                else{

echo "
          <table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td style='padding-right: 5px;'>
                <select name='prf-$x-$b' style='height: 30px;font-size: 15px;'>
                  <option value=''></option>
                  <option value='0'>&lt;</option>
                  <option value='9999999'>&gt;</option>
                </select>
              </td>
              <td>
                <input $intype name='result-$x-$b' style='height: 30px;' placeholder='Input Result' value='' autofocus />
              </td>
            </tr>
          </table>
";
                }
              }
            }

echo "
          <input type='hidden' name='no-$x-$b' value='$no' />
          <input type='hidden' name='ll-$x-$b' value='$no' />
          <input type='hidden' name='ul-$x-$b' value='$no' />
          <input type='hidden' name='un-$x-$b' value='$no' />
        </div></td>
        <td class='b1 l1 r2'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 14px;'>$nv</div></td>
      </tr>
";
          }

echo "
      <input type='hidden' name='srtype' value='1' />
";
        }
//END ALL OTHERS-----------------------------------------------------------------------------------


echo "
    <input type='hidden' name='bval-$x' value='$b' />
    <input type='hidden' name='itmrefno-$x' value='$refno' />
    <input type='hidden' name='desc-$x' value='$desc' />
";
      }
    }

echo "
      <tr>
        <td colspan='3' height='10'></td>
      <tr>
      <tr>
        <td class='t2 b2 l2' colspan='2'><div align='left' style='padding: 0 3px 0 3px;color: #0784C0;font-family: arial;font-weight: bold;font-size: 14px;'>Remarks</div></td>
        <td class='t2 b2 l1 r2' colspan='2'><div align='center' style='padding: 5px;'>
          <textarea name='remarks' style='width: 98%;border-radius: 4px;height: 50px;'></textarea>
        </div></td>
      <tr>
      <tr>
        <td class='t1' colspan='4' height='50'><div align='center'><button type='submit' name='sres' class='btn btn-success text-white' style='font-weight: bold;width: 100px;' title='Back to Select test'><i class='icofont-save'></i> Save</button></div></td>

      </tr>
    </table>
    <input type='hidden' name='xval' value='$x' />
    <input type='hidden' name='agro' value='$agro' />
    <input type='hidden' name='patid' value='$patientidno' />
    <input type='hidden' name='ltype' value='$stype' />
    <input type='hidden' name='srefno' value='$srefno' />
    <input type='hidden' name='stest' />
  </form>
</div>
";
//-------------------------------------------------------------------------------------------------
?>
