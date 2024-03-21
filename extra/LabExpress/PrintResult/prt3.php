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
            <td>
              <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='5' height='20'></td>
                  <td width='auto'><div align='left' style='font-family: times;'></div></td>
";

    $d="";
    $dsql=mysqli_query($conn,"SELECT `rescol`, `rescollbl` FROM `labnormalvalues` WHERE `code`='$bpcode' GROUP BY `rescol` ORDER BY CAST(`rescol` AS UNSIGNED)");
    while($dfetch=mysqli_fetch_array($dsql)){
      $rescol=$dfetch['rescol'];
      $rescollbl=$dfetch['rescollbl'];
      $d[]=$rescol;

echo "
                  <td width='110'><div align='center' style='font-family: times;font-size: 14px;font-weight: bold;padding: 3px 0;'>".$rescollbl."</div></td>
";
    }


echo "
                  <td width='5'></td>
                </tr>
";


    $esql=mysqli_query($conn,"SELECT `resrow`, `resrowlbl` FROM `labnormalvalues` WHERE `code`='$bpcode' GROUP BY `resrow` ORDER BY CAST(`resrow` AS UNSIGNED)");
    while($efetch=mysqli_fetch_array($esql)){
      $resrow=$efetch['resrow'];
      $resrowlbl=$efetch['resrowlbl'];

echo "
                <tr>
                  <td></td>
                  <td><div align='left' style='font-family: times;font-size: 14px;font-weight: bold;padding: 15px 0;'>$resrowlbl</div></td>
";

    for($e=0;$e<count($d);$e++){
      $fsql=mysqli_query($conn,"SELECT `no` FROM `labnormalvalues` WHERE `code`='$bpcode' AND `rescol`='".$d[$e]."' AND `resrow`='$resrow'");
      $ffetch=mysqli_fetch_array($fsql);
      $fno=$ffetch['no'];

      $gsql=mysqli_query($conn,"SELECT `result` FROM `labresults` WHERE `code`='$bpcode' AND `caseno`='$caseno' AND `printbatchno`='$printbatchno' AND `lnvno`='$fno'");
      $gfetch=mysqli_fetch_array($gsql);
      $resultn=$gfetch['result'];


echo "
                  <td><div align='center' style='font-family: times;font-size: 15px;'>$resultn</div></td>
";
    }

echo "
                  <td></td>
                </tr>
";
    }

echo "
                <tr>
                  <td colspan='".(3+count($d))."' style='padding: 20px 0 20px 0;'></td>
                </tr>
              </table>
            </td>
          </tr>
";


  }

echo "
        </table>
";
//-------------------------------------------------------------------------------------------------
?>
