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

    $viewlabel=0;
    if($ccount==1){
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

    if($viewlabel==0){
echo "
          <tr>
            <td>
              <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='5'></td>
                  <td style='border-top: 1px dotted #000000;border-bottom: 1px dotted #000000;padding: 2px 2px;'><div align='center' style='font-family: arial;font-size: 16px;font-weight: bold;color: blue;padding: 10px;'>$clabel</div></td>
                  <td width='5'></td>
                </tr>
              </table>
            </td>
          </tr>
";
    }

echo "
          <tr>
            <td style='padding-top: 5px;'>
              <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='5' height='20'></td>
                  <td width='auto' class='b1'><div align='left' style='font-family: times;'></div></td>
";

    $d="";
    $dsql=mysqli_query($conn,"SELECT `rescol`, `rescollbl` FROM `labnormalvalues` WHERE `code`='$bpcode' GROUP BY `rescol` ORDER BY CAST(`rescol` AS UNSIGNED)");
    while($dfetch=mysqli_fetch_array($dsql)){
      $rescol=$dfetch['rescol'];
      $rescollbl=$dfetch['rescollbl'];
      $d[]=$rescol;

echo "
                  <td width='280' class='t1 b1 l1'><div align='center' style='font-family: times;font-size: 14px;font-weight: bold;padding: 3px 0;'>".$rescollbl."</div></td>
";
    }


echo "
                  <td width='5' class='l1'></td>
                </tr>
";


    $esql=mysqli_query($conn,"SELECT `resrow`, `resrowlbl` FROM `labnormalvalues` WHERE `code`='$bpcode' GROUP BY `resrow` ORDER BY CAST(`resrow` AS UNSIGNED)");
    while($efetch=mysqli_fetch_array($esql)){
      $resrow=$efetch['resrow'];
      $resrowlbl=$efetch['resrowlbl'];

echo "
                <tr>
                  <td></td>
                  <td class='b1 l1'><div align='left' style='font-family: times;font-size: 14px;font-weight: bold;padding: 10px 3px;'>$resrowlbl</div></td>
";

    for($e=0;$e<count($d);$e++){
      $fsql=mysqli_query($conn,"SELECT `no` FROM `labnormalvalues` WHERE `code`='$bpcode' AND `rescol`='".$d[$e]."' AND `resrow`='$resrow'");
      $ffetch=mysqli_fetch_array($fsql);
      $fno=$ffetch['no'];

      $gsql=mysqli_query($conn,"SELECT `result` FROM `labresults` WHERE `code`='$bpcode' AND `caseno`='$caseno' AND `printbatchno`='$printbatchno' AND `lnvno`='$fno'");
      $gfetch=mysqli_fetch_array($gsql);
      $resultn=$gfetch['result'];


echo "
                  <td class='b1 l1'><div align='center' style='font-family: times;font-size: 15px;'>$resultn</div></td>
";
    }

echo "
                  <td class='l1'></td>
                </tr>
";
    }

echo "
              </table>
            </td>
          </tr>
";


  }

echo "
          <tr>
            <td><div align='center'>
              <table border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td colspan='3'><div style='padding-top: 5px;'></div></td>
                </tr>
                <tr>
                  <td class='t1 l1 r1' colspan='3'><div align='center' style='font-family: arial;font-size: 10px;font-weight: bold;padding: 5px 0 3px 0;'>READING INTERPRETATION</div></td>
                </tr>
                <tr>
                  <td class='l1'><div align='center' style='font-family: arial;font-size: 10px;padding: 3px 10px;'>0</div></td>
                  <td width='20'><div align='center' style='font-family: arial;font-size: 10px;padding: 3px 5px;'>=</div></td>
                  <td class='r1' width='300'><div align='center' style='font-family: arial;font-size: 10px;padding: 3px 5px;'>NO AFB/300 VISUAL FIELDS</div></td>
                </tr>
                <tr>
                  <td class='l1'><div align='center' style='font-family: arial;font-size: 10px;padding: 3px 10px;'>+n</div></td>
                  <td><div align='center' style='font-family: arial;font-size: 11px;padding: 3px 5px;'>=</div></td>
                  <td class='r1'><div align='center' style='font-family: arial;font-size: 10px;padding: 3px 5px;'>1-9 AFB/300 VISUAL FILEDS</div></td>
                </tr>
                <tr>
                  <td class='l1'><div align='center' style='font-family: arial;font-size: 10px;padding: 3px 10px;'>1+</div></td>
                  <td><div align='center' style='font-family: arial;font-size: 10px;padding: 3px 5px;'>=</div></td>
                  <td class='r1'><div align='center' style='font-family: arial;font-size: 11px;padding: 3px 5px;'>10-99 AFB/300 VISUAL FILEDS</div></td>
                </tr>
                <tr>
                  <td class='l1'><div align='center' style='font-family: arial;font-size: 10px;padding: 3px 10px;'>2+</div></td>
                  <td><div align='center' style='font-family: arial;font-size: 10px;padding: 3px 5px;'>=</div></td>
                  <td class='r1'><div align='center' style='font-family: arial;font-size: 10px;padding: 3px 5px;'>1-10 AFB/VISUAL FILEDS IN AT LEAST 50 FIELDS</div></td>
                </tr>
                <tr>
                  <td class='b1 l1'><div align='center' style='font-family: arial;font-size: 10px;padding: 3px 10px 5px 10px;'>3+</div></td>
                  <td class='b1'><div align='center' style='font-family: arial;font-size: 10px;padding: 3px 5px 5px 5px;'>=</div></td>
                  <td class='b1 r1'><div align='center' style='font-family: arial;font-size: 10px;padding: 3px 5px 5px 5px;'>&gt; 10 AFB/VISUAL FILEDS IN AT LEAST 20 FIELDS</div></td>
                </tr>
                <tr>
                  <td colspan='3'><div style='padding-top: 5px;'></div></td>
                </tr>
              </table>
            </div></td>
          </tr>
        </table>
";
//-------------------------------------------------------------------------------------------------
?>
