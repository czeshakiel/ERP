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

if(($yxa==0)&&($yxb>0)&&($yxb==0)){$divc="1";}
else if(($yxa==0)&&($yxb>0)&&($yxb>0)){$divc="2";}
else if(($yxa==0)&&($yxb==0)&&($yxb>0)){$divc="1";}
else if(($yxa==0)&&($yxb>0)&&($yxb>0)){$divc="2";}
else if(($yxa>0)&&($yxb==0)&&($yxb==0)){$divc="1";}
else{$div="1";}

//-------------------------------------------------------------------------------------------------

$inlog="";

//START RESULT RETRIEVAL---------------------------------------------------------------------------
echo "
        <table border='0' width='100%' cellpadding='0' cellspacing='0'>
";

$c=0;
$csql=mysqli_query($conn,"SELECT `grplabel` FROM `labnormalvalues` WHERE `code`='$bpcode' GROUP BY `grplabel` ORDER BY CAST(`grplabelsort` AS UNSIGNED)");
$ccount=mysqli_num_rows($csql);
while($cfetch=mysqli_fetch_array($csql)){
  $grplabel=$cfetch['grplabel'];
  $c++;

  if($c==1){$brt="";}else{$brt="border-top: 1px dotted #000000;";}

echo "
          <tr>
            <td width='5'></td>
            <td colspan='3' style='border-top: 1px dotted #000000;border-bottom: 1px dotted #000000;'><div align='left' style='font-family: arial;font-size: 10px;font-weight: bold;'>$grplabel</div></td>
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
  $dsql=mysqli_query($conn,"SELECT `no`, `testname` FROM `labnormalvalues` WHERE `code`='$bpcode' AND `grplabel`='$grplabel' ORDER BY CAST(`sort` AS UNSIGNED)");
  while($dfetch=mysqli_fetch_array($dsql)){
    $dno=$dfetch['no'];
    $dtestname=$dfetch['testname'];

    $fsql=mysqli_query($conn,"SELECT `preresult`, `result`, `remarks` FROM `labresults` WHERE `code`='$bpcode' AND `caseno`='$caseno' AND `printbatchno`='$printbatchno' AND `lnvno`='$dno'");
    $fcount=mysqli_num_rows($fsql);
    if($fcount==0){
      $fpreresult="";
      $fresult="";
      $cremarks="";
    }
    else{
      $ffetch=mysqli_fetch_array($fsql);
      $fpreresult=$ffetch['preresult'];
      $fresult=" ".$ffetch['result'];
      $cremarks=$ffetch['remarks'];
    }

    if($fpreresult=="0"){$fpreresult="&lt; ";}
    else if($fpreresult=="9999999"){$fpreresult="&gt;";}
    
    if(trim(mysqli_real_escape_string($conn,$fresult))!=""){$inlog=$inlog."| $dtestname: ".$fpreresult.$fresult;}

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

    $fsql=mysqli_query($conn,"SELECT `preresult`, `result`, `remarks` FROM `labresults` WHERE `code`='$bpcode' AND `caseno`='$caseno' AND `printbatchno`='$printbatchno' AND `lnvno`='$dno'");
    $fcount=mysqli_num_rows($fsql);
    if($fcount==0){
      $fpreresult="";
      $fresult="";
      $cremarks="";
    }
    else{
      $ffetch=mysqli_fetch_array($fsql);
      $fpreresult=$ffetch['preresult'];
      $fresult=" ".$ffetch['result'];
      $cremarks=$ffetch['remarks'];
    }

    if($fpreresult=="0"){$fpreresult="&lt; ";}
    else if($fpreresult=="9999999"){$fpreresult="&gt;";}
    
    if(trim(mysqli_real_escape_string($conn,$fresult))!=""){$inlog=$inlog."| $dtestname: ".$fpreresult.$fresult;}

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
    
    if(trim(mysqli_real_escape_string($conn,$gresult))!=""){$inlog=$inlog."| $etestname: ".$gpreresult.$gresult;}

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

if((stripos($caseno, "I-") !== FALSE)||(stripos($caseno, "O-") !== FALSE)){
  //Start LabLogs--------------------------------
  if(trim($cremarks)!=""){
    $inlog=$inlog."| Remarks: ".$cremarks;
  }
  
  $rzsql=mysqli_query($conn,"SELECT `caseno`, `refno`, `testname`, `updatecount`, `datetimeperf` FROM `lablogs` WHERE `caseno`='$caseno' AND `testname`='$bpdesc'");
  $rzcount=mysqli_num_rows($rzsql);
  
  if($rzcount=='0'){
    mysqli_query($conn,"INSERT INTO `lablogs` (`caseno`, `refno`, `testname`, `results`, `updatecount`, `datetimeperf`, `datetimeadded`) VALUES ('$caseno', '$brefno', '$bpdesc', '".mysqli_real_escape_string($conn,$inlog)."', '1', '$dtreqlog', '".date("Y-m-d H:i:s")."')");
  }
  else{
    $rzfetch=mysqli_fetch_array($rzsql);
    $rzdt=$rzfetch['datetimeperf'];
    $rzrefno=$rzfetch['refno'];
      
    if($rzdt==""){$rzdt=0;}

    //if(($dtreqlog>=$rzdt)&&($rzrefno!=$brefno)){
    if($dtreqlog>=$rzdt){
      $updatecount=$rzfetch['updatecount']+1;
      mysqli_query($conn,"UPDATE `lablogs` SET `refno`='$brefno', `results`='$inlog', `updatecount`='$updatecount', `datetimeperf`='$dtreqlog', `datetimeadded`='".date("Y-m-d H:i:s")."' WHERE `caseno`='$caseno' AND `testname`='$bpdesc'");
    }
  }
  //End LobLogs----------------------------------
}
?>
