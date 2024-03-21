<?php
//START RESULT RETRIEVAL---------------------------------------------------------------------------
echo "
        <table border='0' width='100%' cellpadding='0' cellspacing='0'>
";

  $c=0;
  $testcount=0;
  $csql=mysqli_query($conn,"SELECT `label`, `refno`, `remarks` FROM `labresults` WHERE `printbatchno`='$printbatchno' GROUP BY `refno`");
  $ccount=mysqli_num_rows($csql);
  while($cfetch=mysqli_fetch_array($csql)){
    $clabel=mb_strtoupper($cfetch['label']);
    $crefno=$cfetch['refno'];
    $cremarks=$cfetch['remarks'];
    $c++;

    if($stype=="hematology"){
echo "
          <!-- tr>
            <td height='19'><div align='left' style='font-family: arial;font-size: 12px;font-weight: bold;color: blue;'><u>$clabel</u></div></td>
          </tr -->
";
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

      if($suf!=""){$suf=" <span style='font-size: 10px;font-weight: normal;'>($suf)</span>";}

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

  }

echo "
        </table>
";
//-------------------------------------------------------------------------------------------------
?>
