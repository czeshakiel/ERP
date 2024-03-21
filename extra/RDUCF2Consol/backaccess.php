<?php
//$all=fopen("../2017codes/SOA/Logs/$caseno.txt", "r") or die("Unable to open file!");
//$allres=trim(fgets($all));
//fclose($all);

$rslsql=mysqli_query($conn,"SELECT * FROM `soalogs` WHERE `caseno`='$caseno'");
if(mysqli_num_rows($rslsql)>0){
  $rslfetch=mysqli_fetch_array($rslsql);
  $allresenc=base64_decode($rslfetch['logs']);
  $iv=base64_decode($rslfetch['iv']);

  //Decrypt
  $allres=openssl_decrypt($allresenc, "aes128", $caseno, 0, $iv);
  //End Decrypt

  $alls=preg_split("/\<>/",$allres);
  $hrs=preg_split("/\|/",$alls[0]);
  $prs=preg_split("/\|/",$alls[2]);
  $pdrs=preg_split("/\|/",$alls[1]);

  //finalcaserates----------------------------------------------
  $toths=0;
  $totps=0;
  $fcsql=mysqli_query($conn,"SELECT * FROM `finalcaserate` WHERE `caseno`='$caseno' AND (`level`='primary' OR `level`='secondary')");
  while($fcfetch=mysqli_fetch_array($fcsql)){
    $hs=$fcfetch['hospitalshare'];
    $ps=$fcfetch['pfshare'];

    $toths+=$hs;
    $totps+=$ps;
  }//echo "<br />".$toths."-->".$totps;
  //------------------------------------------------------------

  $hact=$hrs[0];
  $hadj=$hrs[1];

  $hnet=$hact-$hadj;
  $hexc=$hnet-$toths;
  //echo "<br />".$hnet."-->".$hexc;

  $pact=$prs[0];
  $padj=$prs[1];
  $phmo=$prs[2];

  $pnet=$pact-$padj;
  $pexc=$pnet-$totps;
  //echo "<br />".$pnet."-->".$pexc;

  $totalactual=$hact+$pact;
  $totphic=$toths+$totps;
  //echo "<br />".$totalactual."-->".$totphic;

  //PART III. CERTIFICATION OF CONSUMPTION OF BENEFITS AND CONSENT TO ACCESS PATIENT RECORD/S
  $totleft=$totalactual-$totphic;
  //echo "<br />".$totleft;
  if($totleft<=0){
    //echo "<br />A";
    //No Excess
    $certcon1="&#10003;";
    $certcon2="&nbsp;";

    $hospactual="&nbsp;";
    $profactual="&nbsp;";

    $hosplessdisc="&nbsp;";
    $proflessdisc="&nbsp;";

    $hospphicben="&nbsp;";
    $profphicben="&nbsp;";

    $hospnet="&nbsp;";
    $hospmempat="<img src='Resources/Pictures/Blank.png' height='10' width='auto' />";

    $profnet="&nbsp;";
    $profmempat="<img src='Resources/Pictures/Blank.png' height='10' width='auto' />";

    //Total Actual Charges*
    $TotalHealthCareInstitutionFees=number_format($hact,2,'.',',');
    $TotalProfessionalFees=number_format($pact,2,'.',',');
    $GrandTotal=number_format($totalactual,2,'.',',');
  }
  else if($totleft>0){
    //echo "<br />B";
    //With Excess
    $certcon1="&nbsp;";
    $certcon2="&#10003;";

    //Total Actual Charges*
    $TotalHealthCareInstitutionFees="&nbsp;";
    $TotalProfessionalFees="&nbsp;";
    $GrandTotal="&nbsp;";

    $hospactual=number_format($hact,2,'.',',');
    $profactual=number_format($pact,2,'.',',');

    if($hadj>0){
      $hosplessdisc=number_format(($hact-$hadj),2,'.',',');
    }
    else{
      $hosplessdisc="&nbsp;";
    }

    if($padj>0){
      $proflessdisc=number_format(($pact-$padj),2,'.',',');
    }
    else{
      $proflessdisc="&nbsp;";
    }

    $hospphicben=number_format($toths,2,'.',',');
    $profphicben=number_format($totps,2,'.',',');

    if(($hact-$hadj-$toths)>0){
      $hospnet=number_format(($hact-$hadj-$toths),2,'.',',');
      $hospmempat="<img src='Resources/Pictures/check.png' height='10' width='auto' />";
    }
    else{
      $hospnet="&nbsp;";
      $hospmempat="<img src='Resources/Pictures/Blank.png' height='10' width='auto' />";
    }

    if(($pact-$padj-$totps)>0){
      $profnet=number_format(($pact-$padj-$totps),2,'.',',');
      if(($pexc-$phmo)>0){
        $profmempat="<img src='Resources/Pictures/check.png' height='10' width='auto' />";
      }
    }
    else{
      $profnet="&nbsp;";
      $profmempat="<img src='Resources/Pictures/Blank.png' height='10' width='auto' />";
    }

    if($phmo>0){
      $profoth="<img src='Resources/Pictures/check.png' height='10' width='auto' />";
    }
    else{
      $profoth="<img src='Resources/Pictures/Blank.png' height='10' width='auto' />";
    }
  }

  $purchase1="<img src='Resources/Pictures/check.png' height='10' width='auto' />";
  $purchase2="<img src='Resources/Pictures/check.png' height='10' width='auto' />";

  $patsql=mysqli_query($conn,"SELECT p.`patientname` FROM `admission` a, `patientprofile` p WHERE a.`caseno`='$caseno' AND a.`patientidno`=p.`patientidno`");
  $patfetch=mysqli_fetch_array($patsql);
  $patientname=strtoupper($patfetch['patientname']);
}
?>
