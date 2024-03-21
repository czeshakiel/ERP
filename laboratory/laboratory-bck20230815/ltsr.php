<?php
//-------------------------------------------------------------------------------------------------
include("../extra/LabExpress/agegroup.php");
error_reporting(1);
$xval=mysqli_real_escape_string($conn,$_POST['xval']);
$agro=mysqli_real_escape_string($conn,$_POST['agro']);

$patid=mysqli_real_escape_string($conn,$_POST['patid']);
$labno=trim(mysqli_real_escape_string($conn,$_POST['labno']));
$ap=mysqli_real_escape_string($conn,$_POST['ap']);
$mt=mysqli_real_escape_string($conn,$_POST['mt']);
$pt=mysqli_real_escape_string($conn,$_POST['pt']);
$printbatchno=mysqli_real_escape_string($conn,$_POST['printbatchno']);
$remarks=mb_strtoupper(trim(mysqli_real_escape_string($conn,$_POST['remarks'])));
$stype=mysqli_real_escape_string($conn,$_POST['ltype']);

$srtype=mysqli_real_escape_string($conn,$_POST['srtype']);

$redtime=0;
for($q=1;$q<=$xval;$q++){
  $bval="bval-$q";
  $bvaln=mysqli_real_escape_string($conn,$_POST[$bval]);

  $itmr="itmrefno-$q";
  $itmrefno=mysqli_real_escape_string($conn,$_POST[$itmr]);

  $itmd="desc-$q";
  $itmdesc=mysqli_real_escape_string($conn,$_POST[$itmd]);

  if($srtype==1){
    $itmerr=0;
    for($w=1;$w<=$bvaln;$w++){
      $nol="no-$q-$w";
      $resl="result-$q-$w";
      $prfl="prf-$q-$w";

      $non=mysqli_real_escape_string($conn,$_POST[$nol]);
      $resultn=trim(mysqli_real_escape_string($conn,$_POST[$resl]));
      $prfn=mysqli_real_escape_string($conn,$_POST[$prfl]);

      if($prfn!=""){$resultnd=$prfn;}
      else{$resultnd=$resultn;}

      $bsql=mysqli_query($conn,"SELECT `no`, `code`, `testname`, `testabr`, `grp`, `sort`, `amll`, `amul`, `afll`, `aful`, `cll`, `cul`, `nll`, `nul`, `displaynv`, `others`, `unit`, `type`, `header`, CAST(`amll` AS DECIMAL(10,3)) AS `amlld`, CAST(`amul` AS DECIMAL(10,3)) AS `amuld`, CAST(`afll` AS DECIMAL(10,3)) AS `aflld`, CAST(`aful` AS DECIMAL(10,3)) AS `afuld`, CAST(`cll` AS DECIMAL(10,3)) AS `clld`, CAST(`cul` AS DECIMAL(10,3)) AS `culd`, CAST(`nll` AS DECIMAL(10,3)) AS `nlld`, CAST(`nul` AS DECIMAL(10,3)) AS `nuld` FROM `labnormalvalues` WHERE `no`='$non' AND `stat`='1'");
      $bfetch=mysqli_fetch_array($bsql);
      $lnvno=$bfetch['no'];
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

      $amlld=$bfetch['amlld'];
      $amuld=$bfetch['amuld'];
      $aflld=$bfetch['aflld'];
      $afuld=$bfetch['afuld'];
      $clld=$bfetch['clld'];
      $culd=$bfetch['culd'];
      $nlld=$bfetch['nlld'];
      $nuld=$bfetch['nuld'];

      if($type==3){
        $resl2="result2-$q-$w";
        $resultn2=trim(mysqli_real_escape_string($conn,$_POST[$resl2]));

        if($resultn2!=""){$resultn2=$resultn2." sec.";$spc=" ";}
        else{$resultn2="";$spc="";}
        if($resultn!=""){$resultn=$resultn." min.";}
        else{$resultn="";$spc="";}
        $resultn=$resultn.$spc.$resultn2;
      }

      if($unit!=""){$unitd=" ".$unit;}else{$unitd="";}

      if($grp==1){
        if($agro=="A"){$nvll=$amll;$nvul=$amul;$nvlld=$amlld;$nvuld=$amuld;}
        else if($agro=="AF"){$nvll=$afll;$nvul=$aful;$nvlld=$aflld;$nvuld=$afuld;}
        else if($agro=="C"){$nvll=$cll;$nvul=$cul;$nvlld=$clld;$nvuld=$culd;}
        else if($agro=="N"){$nvll=$nll;$nvul=$nul;$nvlld=$nlld;$nvuld=$nuld;}
        else{$nvll=$amll;$nvul=$amul;$nvlld=$amlld;$nvuld=$amuld;}
      }
      else if($grp==3){
        $setot=substr_count($others,"|");
        $ots=preg_split("/\|/",$others);

        $nvll="";$nvul="";$nvlld="";$nvuld="";

        for($otz=0;$otz<$setot;$otz++){
          $otss=preg_split("/\*/",$ots[$otz]);
          $otagl=$otss[0];
          $otagh=$otss[1];
          $otll=$otss[2];
          $otul=$otss[3];

          if(($ay>=$otagl)&&($ay<=$otagh)){
            $nv=$otll." - ".$otul.$unitd;
            $nvll=$otll;$nvul=$otul;$nvlld=$otll;$nvuld=$otul;
          }
        }
      }
      else{
        $nvll="";$nvul="";$nvlld="";$nvuld="";
      }

      if($resultn!=""){
        if($type==1){
          if(($nvll!="")&&($nvul!="")){
            if($resultnd<$nvlld){$suf="L";$sufd=" (L)";}
            else if($resultnd>$nvuld){$suf="H";$sufd=" (H)";}
            else{$suf="";$sufd="";}
          }
          else{
            $suf="";$sufd="";
          }
        }
        else{
          $suf="";$sufd="";
        }
      }
      else{
        $suf="";$sufd="";
      }

      if($displaynv!=""){
        $dispnv=$displaynv;
      }
      else{
        if(($nvll!="")&&($nvul!="")){$dispnv=trim("$nvll - $nvul $unit");}
        else{$dispnv="";}
      }

      //echo $testname." --> ".$resultn.$sufd." --> ".$nvll." - ".$nvul." ".$unit."<br />";
      //echo "SELECT * FROM `labresults` WHERE `refno`='$srefno' AND `lnvno`='$lnvno' AND `caseno`='$caseno'<br />";
      $ckinsql=mysqli_query($conn,"SELECT * FROM `labresults` WHERE `refno`='$itmrefno' AND `lnvno`='$lnvno' AND `caseno`='$caseno'");
      if(mysqli_num_rows($ckinsql)==0){
        //echo "INSERT INTO `labresults` (`refno`, `code`, `label`, `caseno`, `patid`, `labno`, `ap`, `mt`, `pt`, `printbatchno`, `lnvno`, `test`, `preresult`, `result`, `suf`, `nvll`, `nvul`, `unit`, `dispnv`, `remarks`, `dtrec`, `user`) VALUES ('$itmrefno', '$code', '$itmdesc', '$caseno', '$patid', '$labno', '$ap', '$mt', '$pt', '$printbatchno', '$lnvno', '$testname', '$prfn', '$resultn', '$suf', '$nvll', '$nvul', '$unit', '$dispnv', '$remarks', '".date("Y-m-d H:i:s")."', '$user')<br />";
        mysqli_query($conn,"INSERT INTO `labresults` (`refno`, `code`, `label`, `caseno`, `patid`, `labno`, `ap`, `mt`, `pt`, `printbatchno`, `lnvno`, `test`, `preresult`, `result`, `suf`, `nvll`, `nvul`, `unit`, `dispnv`, `remarks`, `dtrec`, `user`) VALUES ('$itmrefno', '$code', '$itmdesc', '$caseno', '$patid', '$labno', '$ap', '$mt', '$pt', '$printbatchno', '$lnvno', '$testname', '$prfn', '$resultn', '$suf', '$nvll', '$nvul', '$unit', '$dispnv', '$remarks', '".date("Y-m-d H:i:s")."', '$user')");
        //echo "Inserted<br />";
      }
      else{
        //echo "Already Inserted<br />";
        $itmerr+=1;
      }
    }
  }
  else if($srtype==2){
    $rowc=mysqli_real_escape_string($conn,$_POST['rowc']);
    $colc=mysqli_real_escape_string($conn,$_POST['colc']);
    $code=mysqli_real_escape_string($conn,$_POST['code']);

    for($resrow=1;$resrow<=$rowc;$resrow++){
      for($rescol=1;$rescol<=$colc;$rescol++){
        $noin="no-".$q."-".$resrow."-".$rescol;
        $lnvno=$_POST[$noin];

        $resin="result-".$q."-".$resrow."-".$rescol;
        $resultn=$_POST[$resin];

        $testname=$resrow;
        $prfn=$rescol;

        $ckinsql=mysqli_query($conn,"SELECT * FROM `labresults` WHERE `refno`='$itmrefno' AND `lnvno`='$lnvno' AND `caseno`='$caseno'");
        if(mysqli_num_rows($ckinsql)==0){
          //echo "INSERT INTO `labresults` (`refno`, `code`, `label`, `caseno`, `patid`, `labno`, `ap`, `mt`, `pt`, `printbatchno`, `lnvno`, `test`, `preresult`, `result`, `suf`, `nvll`, `nvul`, `unit`, `dispnv`, `remarks`, `dtrec`, `user`) VALUES ('$itmrefno', '$code', '$itmdesc', '$caseno', '$patid', '$labno', '$ap', '$mt', '$pt', '$printbatchno', '$lnvno', '$testname', '$prfn', '$resultn', '', '', '', '', '', '$remarks', '".date("Y-m-d H:i:s")."', '$user')<br />";
          mysqli_query($conn,"INSERT INTO `labresults` (`refno`, `code`, `label`, `caseno`, `patid`, `labno`, `ap`, `mt`, `pt`, `printbatchno`, `lnvno`, `test`, `preresult`, `result`, `suf`, `nvll`, `nvul`, `unit`, `dispnv`, `remarks`, `dtrec`, `user`) VALUES ('$itmrefno', '$code', '$itmdesc', '$caseno', '$patid', '$labno', '$ap', '$mt', '$pt', '$printbatchno', '$lnvno', '$testname', '$prfn', '$resultn', '', '', '', '', '', '$remarks', '".date("Y-m-d H:i:s")."', '$user')");
          //echo "Inserted<br />";
        }
        else{
          //echo "Already Inserted<br />";
          $itmerr+=1;
        }

        echo $_POST[$noin]." | ".$_POST[$resin]."<br />";
      }
      echo "<hr />";
    }
    $redtime=10;
  }

  if($itmerr==0){
    //echo "UPDATE `productout` SET `terminalname`='Testdone' WHERE `refno`='$itmrefno'<br />";
    //echo "UPDATE `labpending` SET `resultstatus`='Testdone', `testdonedt`='".date("Y-m-d H:i:s")."', `testno`='$printbatchno' WHERE `refno`='$itmrefno'<br />";
    //echo "<span style='color: #0784C0;'>&quot;".$itmdesc."&quot; RESULTS RECORDED SUCCESSFULLY!.</span><br />";
    mysqli_query($conn,"UPDATE `productout` SET `terminalname`='Testdone' WHERE `refno`='$itmrefno'");
    mysqli_query($conn,"UPDATE `labpending` SET `resultstatus`='Testdone', `testdonedt`='".date("Y-m-d H:i:s")."', `testno`='$printbatchno' WHERE `refno`='$itmrefno'");

  }
  else{
    echo "<span style='color: #FF0000;'>&quot;".$itmdesc."&quot; ALREADY TEST DONE!.</span><br />";
    $redtime=5;
  }
}

//$redtime=0;
//echo "../../2023codes/LabExpress/PrintResult/?caseno=$caseno&patid=$patid&printbatchno=$printbatchno&stype=$stype&asd=$user";
echo "<META HTTP-EQUIV='Refresh'CONTENT='$redtime;URL=../extra/LabExpress/PrintResult/?caseno=$caseno&patid=$patid&printbatchno=$printbatchno&stype=$stype&asd=$user'>";
//-----------------------------------------------------------------------------------------------
?>
