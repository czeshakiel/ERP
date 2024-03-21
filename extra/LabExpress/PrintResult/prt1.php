<?php
//START RESULT RETRIEVAL---------------------------------------------------------------------------
echo "
        <table border='0' width='100%' cellpadding='0' cellspacing='0'>
";

  $c=0;
  $testcount=0;
  $csql=mysqli_query($conn,"SELECT `label`, `refno`, `remarks` FROM `labresults` WHERE `printbatchno`='$printbatchno' AND `caseno`='$caseno' GROUP BY `refno`");
  $ccount=mysqli_num_rows($csql);
  while($cfetch=mysqli_fetch_array($csql)){
    $clabel=mb_strtoupper($cfetch['label']);
    $crefno=$cfetch['refno'];
    $cremarks=$cfetch['remarks'];
    $c++;

    $inlog="";

    if($stype=="hematology"){
      $viewlabel=0;
      if($ccount>1){
        $khsql=mysqli_query($conn,"SELECT `test` FROM `labresults` WHERE `refno`='$crefno'");
        $khcount=mysqli_num_rows($khsql);

        if($khcount==1){
          $khfetch=mysqli_fetch_array($khsql);
          $khtest=mb_strtoupper($khfetch['test']);

          if(mb_strtoupper($clabel)==$khtest){
            $viewlabel=1;
          }
        }
      }
      else{
        $khsql=mysqli_query($conn,"SELECT `test` FROM `labresults` WHERE `refno`='$crefno'");
        $khcount=mysqli_num_rows($khsql);

        if($khcount==1){
          $viewlabel=1;
        }
      }

      if($viewlabel==0){
echo "
          <tr>
            <td>
              <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='5'></td>
                  <td style='border-top: 1px dotted #000000;border-bottom: 1px dotted #000000;padding: 2px 2px;'><div align='center' style='font-family: arial;font-size: 10px;font-weight: bold;color: blue;'><u>$clabel</u></div></td>
                  <td width='5'></td>
                </tr>
              </table>
            </td>
          </tr>
";
      }
    }

echo "
          <tr>
            <td>
              <table border='0' width='100%' cellpadding='0' cellspacing='0'>
";

//  if($stype=="hematology"){
echo "
                <!-- tr>
                  <td width='5'></td>
                  <td><div align='left' style='font-family: arial;font-size: 9px;font-weight: bold;'>Test</div></td>
                  <td><div align='left' style='font-family: arial;font-size: 9px;font-weight: bold;'>Result</div></td>
                  <td><div align='left' style='font-family: arial;font-size: 9px;font-weight: bold;'>Unit</div></td>
                  <td></td>
                  <td><div align='left' style='font-family: arial;font-size: 9px;font-weight: bold;'>Normal Values</div></td>
                  <td width='5'></td>
                </tr>
                <tr>
                  <td height='5' colspan='7'></td>
                </tr -->
";
//  }
//  else{
    if($c==1){
echo "
                <tr>
                  <td width='5'></td>
                  <td><div align='left' style='font-family: arial;font-size: 9px;font-weight: bold;'><u>Test</u></div></td>
                  <td><div align='left' style='font-family: arial;font-size: 9px;font-weight: bold;'><u>Result</u></div></td>
                  <td><div align='left' style='font-family: arial;font-size: 9px;font-weight: bold;'><u>Unit</u></div></td>
                  <td></td>
                  <td><div align='left' style='font-family: arial;font-size: 9px;font-weight: bold;'><u>Normal Values</u></div></td>
                  <td width='5'></td>
                </tr>
                <tr>
                  <td height='5' colspan='7'></td>
                </tr>
";
    }
//  }

    $dsql=mysqli_query($conn,"SELECT `lnvno`, `test`, `preresult`, `result`, `suf`, `nvll`, `nvul`, `unit`, `dispnv` FROM `labresults` WHERE `refno`='$crefno' AND `printbatchno`='$printbatchno'");
    while($dfetch=mysqli_fetch_array($dsql)){
      $lnvno=$dfetch['lnvno'];
      $test=$dfetch['test'];
      $preresult=$dfetch['preresult'];
      $result=$dfetch['result'];
      $suf=$dfetch['suf'];
      $nvll=$dfetch['nvll'];
      $nvul=$dfetch['nvul'];
      $unit=$dfetch['unit'];
      $dispnv=$dfetch['dispnv'];

      $sufrel="";
      if($suf!=""){$sufrel="($suf)";$suf=" <span style='font-size: 10px;font-weight: normal;'>($suf)</span>";}

      if($preresult!=""){
        if($preresult=="9999999"){$pref="&gt; ";}
        else if($preresult=="0"){$pref="&lt; ";}
        else{$pref="";}
      }
      else{
        $pref="";
      }

      $hdsql=mysqli_query($conn,"SELECT `header`, `line` FROM `labnormalvalues` WHERE `no`='$lnvno'");
      $hdfetch=mysqli_fetch_array($hdsql);
      $hd=$hdfetch['header'];
      $line=$hdfetch['line'];

      $testcount+=$line;

      if((trim(mb_strtoupper($test))=="BLOOD TYPING")&&(stripos($caseno, "I-") === FALSE)){$btc=1;}

      if(($stype=="chemistry")||($stype=="serology")){
        if($result!=""){

          if(trim($result)!=""){
            if($sufrel!=""){$sufrel=" --> $sufrel";}else{$sufrel="";}
            $inlog=$inlog."  | $test: ".$pref.$result." $unit"."$sufrel";
          }

echo "
                <tr>
                  <td width='5' height='20'></td>
                  <td width='auto'><div align='left' style='font-family: times;$hd'>$test</div></td>
                  <td width='150'><div align='left' style='font-family: times;$hd'>".$pref.$result.$suf."</div></td>
                  <td width='70'><div align='left' style='font-family: times;$hd'>$unit</div></td>
                  <td width='50'></td>
                  <td width='200'><div align='left' style='font-family: times;$hd'>$dispnv</div></td>
                  <td width='5'></td>
                </tr>
";
        }
      }
      else{
        if(trim($result)!=""){
          if($sufrel!=""){$sufrel=" --> $sufrel";}else{$sufrel="";}
          $inlog=$inlog."  | $test: ".$pref.$result." $unit"."$sufrel";
        }

echo "
                <tr>
                  <td width='5' height='20'></td>
                  <td width='auto'><div align='left' style='font-family: times;$hd'>$test</div></td>
                  <td width='150'><div align='left' style='font-family: times;$hd'>".$pref.$result.$suf."</div></td>
                  <td width='70'><div align='left' style='font-family: times;$hd'>$unit</div></td>
                  <td width='50'></td>
                  <td width='200'><div align='left' style='font-family: times;$hd'>$dispnv</div></td>
                  <td width='5'></td>
                </tr>
";
      }
    }

echo "
              </table>
            </td>
          </tr>
";

/*if($c!=$ccount){
echo "
          <tr>
            <td height='5'></td>
          </tr>
";
}*/

    if((stripos($caseno, "I-") !== FALSE)||(stripos($caseno, "O-") !== FALSE)){
      //Start LabLogs------------------------------
      if(trim($cremarks)!=""){
        $inlog=$inlog."| Remarks: ".$cremarks;
      }

      $rzsql=mysqli_query($conn,"SELECT `caseno`, `refno`, `testname`, `updatecount`, `datetimeperf` FROM `lablogs` WHERE `caseno`='$caseno' AND `testname`='$clabel'");
      $rzcount=mysqli_num_rows($rzsql);

      if($rzcount==0){
        mysqli_query($conn,"INSERT INTO `lablogs` (`caseno`, `refno`, `testname`, `results`, `updatecount`, `datetimeperf`, `datetimeadded`) VALUES ('$caseno', '$crefno', '$clabel', '".mysqli_real_escape_string($conn,$inlog)."', '1', '$dtreqlog', '".date("Y-m-d H:i:s")."')");
      }
      else{
        $rzfetch=mysqli_fetch_array($rzsql);
        $rzdt=$rzfetch['datetimeperf'];
        $rzrefno=$rzfetch['refno'];

        if($rzdt==""){$rzdt=0;}

        //if(($dtreqlog>=$rzdt)&&($rzrefno!=$crefno)){
        if($dtreqlog>=$rzdt){
          $updatecount=$rzfetch['updatecount']+1;
          mysqli_query($conn,"UPDATE `lablogs` SET `refno`='$crefno', `results`='$inlog', `updatecount`='$updatecount', `datetimeperf`='$dtreqlog', `datetimeadded`='".date("Y-m-d H:i:s")."' WHERE `caseno`='$caseno' AND `testname`='$clabel'");
        }
      }
      //End LobLogs--------------------------------
    }
  }

echo "
        </table>
";
//-------------------------------------------------------------------------------------------------
?>
