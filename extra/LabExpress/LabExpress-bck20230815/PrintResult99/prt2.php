<?php
$yxa=0;
$yxb=0;
$yxc=0;
//-------------------------------------------------------------------------------------------------
$yxsql=mysqli_query($conn,"SELECT `respos` FROM `labnormalvalues` WHERE `code`='$bpcode' GROUP BY `code`,`respos` ORDER BY CAST(`respos` AS UNSIGNED)");
while($yxfetch=mysqli_fetch_array($yxsql)){
  $yxrespos=$yxfetch['respos'];

  if($yxrespos=="0"){$yxa+=1;}
  else if($yxrespos=="1"){$yxb+=1;}
  else if($yxrespos=="2"){$yxc+=1;}
}

if(($yxa>0)&&($yxb>1)){$divc="2";}
else if(($yxa==0)&&($yxb>1)){$divc="1";}
else if(($yxa>1)&&($yxb==0)){$divc="1";}
else if(($yxa==0)&&($yxb==0)){$divc="1";}
else{$divc="1";}
//-------------------------------------------------------------------------------------------------

//START RESULT RETRIEVAL---------------------------------------------------------------------------
echo "
        <table border='0' width='100%' cellpadding='0' cellspacing='0'>
";

$c=0;
$lncount=0;
$csql=mysqli_query($conn,"SELECT `grplabel` FROM `labnormalvalues` WHERE `code`='$bpcode' GROUP BY `grplabel` ORDER BY CAST(`grplabelsort` AS UNSIGNED)");
$ccount=mysqli_num_rows($csql);
while($cfetch=mysqli_fetch_array($csql)){
  $grplabel=$cfetch['grplabel'];
  $c++;

echo "
          <tr>
            <td width='5'></td>
";


if(trim($grplabel)!=""){
echo "
            <td colspan='3' style='border-top: 1px dotted #000000;border-bottom: 1px dotted #000000;'><div align='left' style='font-family: arial;font-size: 10px;font-weight: bold;'>$grplabel</div></td>
";
}
else{
echo "
            <td colspan='3'><div align='left' style='font-family: arial;font-size: 10px;font-weight: bold;'>$grplabel</div></td>
";
}

echo "
            <td width='5'></td>
          </tr>
          <tr>
            <td></td>
            <td width='3'></td>
            <td valign='top'>
";

if($divc==1){
echo "
              <table border='0' width='100%' cellpadding='0' cellspacing='0'>
";

//respos = 1---------------------------------------------------------------------------------------
  $dsql=mysqli_query($conn,"SELECT `no`, `testname`, `header` FROM `labnormalvalues` WHERE `code`='$bpcode' AND `grplabel`='$grplabel' ORDER BY CAST(`sort` AS UNSIGNED)");
  while($dfetch=mysqli_fetch_array($dsql)){
    $dno=$dfetch['no'];
    $dtestname=$dfetch['testname'];
    $hd=$dfetch['header'];

    $fsql=mysqli_query($conn,"SELECT `preresult`, `result` FROM `labresults` WHERE `code`='$bpcode' AND `caseno`='$caseno' AND `printbatchno`='$printbatchno' AND `lnvno`='$dno'");
    $fcount=mysqli_num_rows($fsql);
    if($fcount==0){
      $fpreresult="";
      $fresult="";
    }
    else{
      $ffetch=mysqli_fetch_array($fsql);
      $fpreresult=$ffetch['preresult'];
      $fresult=" ".$ffetch['result'];
    }

    if($fpreresult=="0"){$fpreresult="&lt; ";}
    else if($fpreresult=="9999999"){$fpreresult="&gt;";}

    $lncount++;

echo "
                <tr>
                  <td width='65%'><div align='left' style='font-family: arial;$hd'>$dtestname</div></td>
                  <td width='35%'><div align='left' style='font-family: arial;$hd'>: $fpreresult$fresult</div></td>
                </tr>
";
  }
//-------------------------------------------------------------------------------------------------

echo "
              </table>
";
}
else if($divc==2){
echo "
              <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='49%' valign='top'>
                    <table border='0' width='100%' cellpadding='0' cellspacing='0'>
";

//respos = 1---------------------------------------------------------------------------------------
  $dsql=mysqli_query($conn,"SELECT `no`, `testname` FROM `labnormalvalues` WHERE `code`='$bpcode' AND `grplabel`='$grplabel' AND `respos`='1' ORDER BY CAST(`sort` AS UNSIGNED)");
  while($dfetch=mysqli_fetch_array($dsql)){
    $dno=$dfetch['no'];
    $dtestname=$dfetch['testname'];

    $fsql=mysqli_query($conn,"SELECT `preresult`, `result` FROM `labresults` WHERE `code`='$bpcode' AND `caseno`='$caseno' AND `printbatchno`='$printbatchno' AND `lnvno`='$dno'");
    $fcount=mysqli_num_rows($fsql);
    if($fcount==0){
      $fpreresult="";
      $fresult="";
    }
    else{
      $ffetch=mysqli_fetch_array($fsql);
      $fpreresult=$ffetch['preresult'];
      $fresult=" ".$ffetch['result'];
    }

    if($fpreresult=="0"){$fpreresult="&lt; ";}
    else if($fpreresult=="9999999"){$fpreresult="&gt;";}

    $lncount++;

echo "
                      <tr>
                        <td width='65%'><div align='left' style='font-family: arial;font-size: 13px;'>$dtestname</div></td>
                        <td width='35%'><div align='left' style='font-family: arial;font-weight: bold;font-size: 13px;'>: $fpreresult$fresult</div></td>
                      </tr>
";
  }
//-------------------------------------------------------------------------------------------------

echo "
                    </table>
                  </td>
                  <td width='2%'></td>
                  <td width='49%' valign='top'>
                    <table border='0' width='100%' cellpadding='0' cellspacing='0'>
";

//respos = 2---------------------------------------------------------------------------------------
  $esql=mysqli_query($conn,"SELECT `no`, `testname` FROM `labnormalvalues` WHERE `code`='$bpcode' AND `grplabel`='$grplabel' AND `respos`='2' ORDER BY CAST(`sort` AS UNSIGNED)");
  while($efetch=mysqli_fetch_array($esql)){
    $eno=$efetch['no'];
    $etestname=$efetch['testname'];

    $gsql=mysqli_query($conn,"SELECT `preresult`, `result`, `remarks` FROM `labresults` WHERE `code`='$bpcode' AND `caseno`='$caseno' AND `printbatchno`='$printbatchno' AND `lnvno`='$eno'");
    $gcount=mysqli_num_rows($gsql);
    if($gcount==0){
      $gpreresult="";
      $gresult="";
      $cremarks="";
    }
    else{
      $gfetch=mysqli_fetch_array($gsql);
      $gpreresult=$gfetch['preresult'];
      $gresult=" ".$gfetch['result'];
      $cremarks=$gfetch['remarks'];
    }

    if($gpreresult=="0"){$gpreresult="&lt; ";}
    else if($gpreresult=="9999999"){$gpreresult="&gt; ";}

echo "
                      <tr>
                        <td width='65%'><div align='left' style='font-family: arial;font-size: 13px;'>$etestname</div></td>
                        <td width='35%'><div align='left' style='font-family: arial;font-weight: bold;font-size: 13px;'>: $gpreresult$gresult</div></td>
                      </tr>
";
  }
//-------------------------------------------------------------------------------------------------

echo "
                    </table>
                  </td>
                </tr>
              </table>
";
}

echo "
            </td>
            <td width='3'></td>
            <td></td>
          </tr>
          <tr>
            <td colspan='5' height='5'></td>
          </tr>
";
}
echo "
        </table>
";
//-------------------------------------------------------------------------------------------------
?>
