<?php
//-------------------------------------------------------------------------------------------------
include("../extra/LabExpress/agegroup.php");

$zxsql=mysqli_query($conn,"SELECT `code`, `label`, `labno`, `printbatchno`, `ap`, `mt`, `pt`, `remarks`, `logs` FROM `labresults` WHERE `refno`='$srefno' LIMIT 0,1");
$zxfetch=mysqli_fetch_array($zxsql);
$zxlabel=$zxfetch['label'];
$zxlabno=$zxfetch['labno'];
$zxprintbatchno=$zxfetch['printbatchno'];
$zxap=$zxfetch['ap'];
$zxmt=$zxfetch['mt'];
$zxpt=$zxfetch['pt'];
$zxremarks=$zxfetch['remarks'];
$zxlogs=$zxfetch['logs'];
$pcode=$zxfetch['code'];
$desc=$zxfetch['label'];

echo "
<div align='left'>
  <form method='post'>
    <table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td class='t2 b2 l2' colspan='2'><div align='left' style='padding: 0 3px 0 3px;color: #0784C0;font-family: arial;font-weight: bold;font-size: 14px;'>Laboratory No.</div></td>
        <td class='t2 b2 l1 r2' colspan='2'><div align='left' style='padding: 5px;'><input type='text' name='labno' placeholder='Laboratory Number' style='width: 100%;height: 35px;font-size: 14px;border-radius: 5px;border: 2px solid #000000;' value='$zxlabno' autofocus required /></div></td>
      <tr>
      <tr>
        <td class='b2 l2' colspan='2'><div align='left' style='padding: 0 3px 0 3px;color: #0784C0;font-family: arial;font-weight: bold;font-size: 14px;'>Print Batch No.</div></td>
        <td class='b2 l1 r2' colspan='2'><div align='left' style='padding: 5px;'><input type='text' name='printbatchno' placeholder='Laboratory Number' style='width: 100%;height: 35px;font-size: 14px;border-radius: 5px;border: 2px solid #000000;' value='$zxprintbatchno' required /></div></td>
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
  if($zxmt==$mtfetch['empid']){$mts="selected";}else{$mts="";}
echo "
            <option value='".$mtfetch['empid']."' $mts>".mb_strtoupper($mtfetch['name'])."</option>
";
}

echo "
          </select>
        </div></td>
      <tr>
      <tr>
        <td class='b2 l2' colspan='2'><div align='left' style='padding: 0 3px 0 3px;color: #0784C0;font-family: arial;font-weight: bold;font-size: 14px;'>Physician</div></td>
        <td class='b2 l1 r2' colspan='2'><div align='left' style='padding: 5px;'>
          <select name='ap' style='width: 100%;height: 35px;font-size: 14px;border-radius: 5px;border: 2px solid #000000;' required>
            <option></option>
";

$dfsql=mysqli_query($conn,"SELECT `code`, `name` FROM `docfile` ORDER BY `name`");
while($dffetch=mysqli_fetch_array($dfsql)){
  $dccode=$dffetch['code'];
  $dcname=mb_strtoupper($dffetch['name']);

  if($zxap==$dccode){$dcops="selected";}else{$dcops="";}

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
      <tr>
        <td class='t2 b1 l2'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;'>#</div></td>
        <td class='t2 b1 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;'>Test</div></td>
        <td class='t2 b1 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;'>Result</div></td>
        <td class='t2 b1 l1 r2'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;'>Normal Values</div></td>
      </tr>
      <tr>
        <td class='t2 b2 l2 r2' colspan='4'><div align='left' style='color: blue;font-family: arial;font-weight: bold;font-size: 16px;padding: 3px;'><i class='fa fa-star'></i> ".$desc."</div></td>
      </tr>
";

$kgrpsql=mysqli_query($conn,"SELECT `grp` FROM `labnormalvalues` WHERE `code`='$pcode' GROUP BY `code`");
$kgrpfetch=mysqli_fetch_array($kgrpsql);
$kgrp=$kgrpfetch['grp'];

if($kgrp==8){
//START WIDAL TEST---------------------------------------------------------------------------------
echo "
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
      
      $resnsql=mysqli_query($conn,"SELECT `result` FROM `labresults` WHERE `code`='$pcode' AND `caseno`='$caseno' AND `printbatchno`='$zxprintbatchno' AND `lnvno`='$dno'");
      $resnfetch=mysqli_fetch_array($resnsql);
      $resultn=$resnfetch['result'];
      

echo "
              <td class='b1 l1'><div align='center' style='padding: 5px 5px;'>
                <input type='hidden' name='no-$c-$zy' value='$dno' />
                <select name='result-$c-$zy' style='height: 30px;' required>
                  <option selectted></option>
";

      for($dx=0;$dx<(count($dothspl)-1);$dx++){
        if($resultn==$dothspl[$dx]){$selres="selected";}else{$selres="";}
echo "
                <option $selres>$dothspl[$dx]</option>
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
          <input type='hidden' name='colc' value='$bcount' />
          <input type='hidden' name='rowc' value='$ccount' />
          <input type='hidden' name='code' value='$pcode' />
          <input type='hidden' name='grp8' />
        </td>
      </tr>
";
//END WIDAL TEST-----------------------------------------------------------------------------------
}
else{
  $b=0;
  $bsql=mysqli_query($conn,"SELECT * FROM `labnormalvalues` WHERE `code`='$pcode' AND `stat`='1'");
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


    $zcsql=mysqli_query($conn,"SELECT `preresult`, `result`, `suf` FROM `labresults` WHERE `refno`='$srefno' AND `code`='$pcode' AND `caseno`='$caseno' AND `lnvno`='$no'");
    $zcfetch=mysqli_fetch_array($zcsql);
    $setpr=$zcfetch['preresult'];
    $setrs=$zcfetch['result'];
    $setsf=$zcfetch['suf'];

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
      $nv=$displaynv.$unitd;
    }
    else{
      if(($grp==1)||($grp==4)){
        if($agro=="A"){$nv=$amll.$amul.$unit;}
        else if($agro=="AF"){$nv=$afll.$aful.$unit;}
        else if($agro=="C"){$nv=$cll.$cul.$unit;}
        else if($agro=="N"){$nv=$nll.$nul.$unit;}
        else{$nv=$amll.$amul.$unit;}
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
          <input type='hidden' name='prf-$b' value='' />
          <table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td style='padding-right: 5px;'>
                <select name='result-$b' style='width: 300px;font-size: 15px;' autofocus required>
                  <option value=''></option>
";

      $setzm=substr_count($others,"|");
      $cs=preg_split("/\|/",$others);

      for($cz=0;$cz<$setzm;$cz++){
        if($setrs==$cs[$cz]){$crss="selected";}else{$crss="";}
echo "
                  <option value='".$cs[$cz]."' $crss>".$cs[$cz]."</option>
";
      }

echo "
                </select>
              </td>
            </tr>
          </table>
";
    }
    else if($grp==4){
echo "
          <input type='hidden' name='prf-$b' value='' />
          <input type='text' name='result-$b' placeholder='Type Result' value='$setrs' autofocus />
";
    }
    else{
      if($type==3){
echo "
          <input type='hidden' name='prf-$b' value='' />
          <label>
            <input type='number' name='result-$b' placeholder='Minutes' style='width: 130px;' value='' autofocus /> Min.
          </label>
          <label>
            <input type='number' name='result2-$b' placeholder='Seconds' style='width: 130px;' value='' autofocus /> Sec.
          </label>
";
      }
      else{
        if($setpr==''){$prs1="selected";$prs2="";$prs3="";}
        else if($setpr=='0'){$prs1="";$prs2="selected";$prs3="";}
        else if($setpr=='9999999'){$prs1="";$prs2="";$prs3="selected";}
        else{$prs1="";$prs2="";$prs3="";}

echo "
          <table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td style='padding-right: 5px;font-size: 15px;'>
                <select name='prf-$b'>
                  <option value='' $prs1></option>
                  <option value='0' $prs2>&lt;</option>
                  <option value='9999999' $prs3>&gt;</option>
                </select>
              </td>
              <td>
                <input $intype name='result-$b' placeholder='Input Result' value='$setrs' autofocus />
              </td>
            </tr>
          </table>
";
      }
    }

echo "
          <input type='hidden' name='no-$b' value='$no' />
          <input type='hidden' name='ll-$b' value='$no' />
          <input type='hidden' name='ul-$b' value='$no' />
          <input type='hidden' name='un-$b' value='$no' />
        </div></td>
        <td class='b1 l1 r2'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 14px;'>$nv</div></td>
      </tr>
";
  }
}

echo "
    <input type='hidden' name='bval' value='$b' />
    <input type='hidden' name='itmrefno' value='$srefno' />
    <input type='hidden' name='desc' value='$desc' />
    <input type='hidden' name='logs' value='".base64_encode($zxlogs)."' />
";

echo "
      <tr>
        <td colspan='4' height='10'></td>
      <tr>
      <tr>
        <td class='t2 b2 l2' colspan='2'><div align='left' style='padding: 0 3px 0 3px;color: #0784C0;font-family: arial;font-weight: bold;font-size: 14px;'>Remarks</div></td>
        <td class='t2 b2 l1 r2' colspan='2'><div align='center' style='padding: 5px;'>
          <textarea name='remarks' style='width: 98%;border-radius: 4px;height: 50px;'>$zxremarks </textarea>
        </div></td>
      <tr>
      <tr>
        <td colspan='4' height='10'></td>
      <tr>
      <tr>
        <td colspan='4' height='40'><div align='center'><button type='submit' name='ures' class='btn btn-success text-white' style='font-weight: bold;width: 160px;' title='Back to Select test'><i class='icofont-save'></i> Update Result</button></div></td>
      </tr>
    </table>
    <input type='hidden' name='agro' value='$agro' />
    <input type='hidden' name='patid' value='$patientidno' />
    <input type='hidden' name='ltype' value='$stype' />
    <input type='hidden' name='srefno' value='$srefno' />
    <input type='hidden' name='eres' />
  </form>
</div>
";
//-------------------------------------------------------------------------------------------------
?>
