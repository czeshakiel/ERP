<?php
echo "
          <tr>
            <td colspan='3' class='b2'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
              <tr>
                <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td width='5'></td>
                    <td"; ?> onclick="<?php echo "window.open('../2021codes/CaseRates/?caseno=$caseno&user=".base64_encode($user)."', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=300,width=1000,height=650');";?>" <?php echo " $cursty><div align='left' class='tahoma s9 black'><b>7. Discharge Diagnosis/es</b> (Use additional CF2 if necessary):</div></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height='5'></td>
              </tr>
              <tr>
                <td><table border='0' cellpadding='0' cellspacing='0' width='100%'>
                  <tr>
                    <td width='10'></td>
                    <td width='10' class='Tahoma10black'></td>
                    <td width='130'><div align='center' class='tahoma s10 black'>Diagnosis</div></td>
                    <td width='8'></td>
                    <td width='80'><div align='center' class='tahoma s10 black'>ICD-10 Code/s</div></td>
                    <td width='7'></td>
                    <td width='10'><div align='center' class='tahoma s10 black'></div></td>
                    <td width='185'><div align='center' class='tahoma s10 black'>Related Procedure/s (if there's any)</div></td>
                    <td width='7'></td>
                    <td width='50'><div align='center' class='tahoma s10 black'>RVS Code</div></td>
                    <td width='7'></td>
                    <td width='80'><div align='center' class='tahoma s10 black'>Date of Procedure</div></td>
                    <td width='7'></td>
                    <td colspan='6'><div align='center' class='tahoma s10 black'>Laterality (check pplicable box)</div></td></td>
                    <td width='8'></td>
                  </tr>
                  <tr>
                    <td colspan='20' height='3'></td>
                  </tr>
";

$fcrpsql=mysqli_query($mycon1,"SELECT * FROM `finalcaserate` WHERE `caseno`='$caseno' AND `level`='primary'");
$fcrpcount=mysqli_num_rows($fcrpsql);

if($fcrpcount!=0){
  $fcrpfetch=mysqli_fetch_array($fcrpsql);
  $autonop=$fcrpfetch['autono'];
  $icdcodep=$fcrpfetch['icdcode'];
  $desccf2p=trim($fcrpfetch['desccf2']);
  $typep=$fcrpfetch['type'];
  $relatedprocedurep=$fcrpfetch['relatedprocedure'];
  $dateofprocedurep=$fcrpfetch['dateofprocedure'];
  $lateralityp=$fcrpfetch['laterality'];

  if($dateofprocedurep!=""){
    $reldateofprocedurep=date("m-d-Y",strtotime($dateofprocedurep));
  }
  else{
    $reldateofprocedurep="";
  }

  if($typep=="icd"){
    $icdp=$icdcodep;
    $rvsp="";

    $relpl1="";
    $reladdp1="";
    $relpl2="";
    $reladdp2="";
    $relpl3="";
    $reladdp3="";

    $reldesccf2p="";
    $valrelpsty="";

    $editautop=$autonop;
  }
  else if($typep=="rvs"){
    $relicdpsql=mysqli_query($mycon1,"SELECT `autono`, `icdcode`, `desccf2` FROM `finalcaserate` WHERE `con`='$autonop'");
    $relicdpcount=mysqli_num_rows($relicdpsql);

    if($relicdpcount!=0){
      $relicdpfetch=mysqli_fetch_array($relicdpsql);
      $relicdp=$relicdpfetch['icdcode'];
      $reldesccf2p=$relicdpfetch['desccf2'];
      $editautop=$relicdpfetch['autono'];
    }
    else{
      $relicdp="";
      $reldesccf2p="";
      $editautop=$autonop;
    }

    $icdp=$relicdp;
    $rvsp=$icdcodep;

    //RELATED PROCEDURE----------------------------------------------------------------------------
    if(strlen($relatedprocedurep)<="105"){
      $valrelp=35;
      $valrelpsty="style='font-size: 9px;'";
    }
    else if((strlen($relatedprocedurep)<="117")&&(strlen($relatedprocedurep)>"105")){
      $valrelp=39;
      $valrelpsty="style='font-size: 8px;'";
    }
    else if((strlen($relatedprocedurep)<="135")&&(strlen($relatedprocedurep)>"117")){
      $valrelp=45;
      $valrelpsty="style='font-size: 7px;'";
    }
    else if((strlen($relatedprocedurep)<="159")&&(strlen($relatedprocedurep)>"135")){
      $valrelp=53;
      $valrelpsty="style='font-size: 6px;'";
    }
    else{
      $valrelp=63;
      $valrelpsty="style='font-size: 5px;'";
    }
    //8px 41
    $rpcount=strlen($relatedprocedurep);
    echo $rpcount;

    $valrelp=41;
    $valrelpsty="style='font-size: 8px;'";
    $pnolinerp=$rpcount/$valrelp;
    if(stripos($pnolinerp, ".") !== FALSE){
      $pnolinerpspl=preg_split("/\./",$pnolinerp);
      if($pnolinerpspl[1]>0){
        $pnolinerprel=$pnolinerpspl[0]+1;
      }
      else{
        $pnolinerprel=$pnolinerp;
      }
    }
    else{
      $pnolinerprel=$pnolinerp;
    }

    //Line 1
    $relpl1=substr($relatedprocedurep, 0, $valrelp);
    $relpl1knowifspacenext=substr($relatedprocedurep, $valrelp, 1);
    $relpl1knowifspaceprev=substr($relatedprocedurep, ($valrelp-1), 1);
    if($relpl1knowifspacenext!=' '){
      if($relpl1knowifspaceprev!=' '){
        $reladdp1="-";
      }
      else{
        $reladdp1="";
      }
    }
    else{
      $reladdp1="";
    }

    //Line 2
    $relpl2=substr($relatedprocedurep, $valrelp, $valrelp);
    $relpl2knowifspacenext=substr($relatedprocedurep, ($valrelp*2), 1);
    $relpl2knowifspaceprev=substr($relatedprocedurep, (($valrelp*2)-1), 1);
    if($relpl2knowifspacenext!=' '){
      if($relpl2knowifspaceprev!=' '){
        $reladdp2="-";
      }
      else{
        $reladdp2="";
      }
    }
    else{
      $reladdp2="";
    }

    //Line 3
    $relpl3=substr($relatedprocedurep, ($valrelp*2), $valrelp);
    $relpl3knowifspacenext=substr($relatedprocedurep, ($valrelp*3), 1);
    $relpl3knowifspaceprev=substr($relatedprocedurep, (($valrelp*3)-1), 1);
    if($relpl3knowifspacenext!=' '){
      if(($relpl3knowifspaceprev!=' ')&&($relpl3knowifspaceprev!='')){
        $reladdp3="-";
      }
      else{
        $reladdp3="";
      }
    }
    else{
      $reladdp3="";
    }
    //END RELATED PROCEDURE------------------------------------------------------------------------
  }
  else{
    $icdp="";
    $rvsp="";

    $relpl1="";
    $reladdp1="";
    $relpl2="";
    $reladdp2="";
    $relpl3="";
    $reladdp3="";

    $reldesccf2p="";
    $valrelpsty="";

    $editautop=$autonop;
  }

  if($reldesccf2p!=""){
    $realdescp=$reldesccf2p;
  }
  else{
    $realdescp=$desccf2p;
  }

  //5px 31 93max
  //6px 27 81max
  //7px 23 69max
  //8px 20 60max
  //9px 17 51max

  //5px 42 126
  //6px 36 108max
  //7px 31 93max
  //8px 27 81max
  //9px 21 63max

//DESCRIPTION----------------------------------------------------------------------------------------------------------------------------------------
  if(strlen($realdescp)<="63"){
    $valp=21;
    $valpsty="style='font-size: 9px;'";
  }
  else if((strlen($realdescp)<="81")&&(strlen($realdescp)>"63")){
    $valp=27;
    $valpsty="style='font-size: 8px;'";
  }
  else if((strlen($realdescp)<="93")&&(strlen($realdescp)>"81")){
    $valp=31;
    $valpsty="style='font-size: 7px;'";
  }
  else if((strlen($realdescp)<="108")&&(strlen($realdescp)>"93")){
    $valp=36;
    $valpsty="style='font-size: 6px;'";
  }
  else{
    $valp=42;
    $valpsty="style='font-size: 5px;'";
  }
  $valp=29;
  $valpsty="style='font-size: 8px;'";
  //Desc Line 1
  $pl1=substr($realdescp, 0, $valp);
  $pl1knowifspacenext=substr($realdescp, $valp, 1);
  $pl1knowifspaceprev=substr($realdescp, ($valp-1), 1);
  if($pl1knowifspacenext!=' '){
    if($pl1knowifspaceprev!=' '){
      $addp1="-";
    }
    else{
      $addp1="";
    }
  }
  else{
    $addp1="";
  }

  //Desc Line 2
  $pl2=substr($realdescp, ($valp*1), $valp);
  $pl2knowifspacenext=substr($realdescp, ($valp*2), 1);
  $pl2knowifspaceprev=substr($realdescp, (($valp*2)-1), 1);
  if($pl2knowifspacenext!=' '){
    if($pl2knowifspaceprev!=' '){
      $addp2="-";
    }
    else{
      $addp2="";
    }
  }
  else{
    $addp2="";
  }

  //Desc Line 3
  $pl3=substr($realdescp, ($valp*2), $valp);
  $pl3knowifspacenext=substr($realdescp, ($valp*3), 1);
  $pl3knowifspaceprev=substr($realdescp, (($valp*3)-1), 1);
  if($pl3knowifspacenext!=' '){
    if(($pl3knowifspaceprev!=' ')&&($pl3knowifspaceprev!='')){
      $addp3="-";
    }
    else{
      $addp3="";
    }
  }
  else{
    $addp3="";
  }
//END DESCRIPTION--------------------------------------------------------------------------------------------------------------------------

  if($lateralityp=="R"){
    $rvspl="";
    $rvspr="&#10004;";
    $rvspb="";
    $rvspn="";
  }
  else if($lateralityp=="L"){
    $rvspl="&#10004;";
    $rvspr="";
    $rvspb="";
    $rvspn="";
  }
  else if($lateralityp=="B"){
    $rvspl="";
    $rvspr="";
    $rvspb="&#10004;";
    $rvspn="";
  }
  else{
    $rvspl="";
    $rvspr="";
    $rvspb="";
    $rvspn="";
  }

echo "
                  <tr>
                    <td height='17'></td>
                    <td><div align='left' class='tahoma s10 black'>a.&nbsp;</div></td>
                    <td class='b1'"; ?> onclick="<?php echo "window.open('../2021codes/CaseRates/EditICDDesc.php?caseno=$caseno&user=".base64_encode($user)."&editauto=$editautop', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=300');";?>" <?php echo " $cursty><div align='left' class='tahoma black' $valpsty>".$pl1.$addp1."</div></td>
                    <td></td>
";

if($typep=="rvs"){
echo "
                    <td class='b1'"; ?> onclick="<?php echo "window.open('../2021codes/CaseRates/?caseno=$caseno&user=".base64_encode($user)."&frm=con&rvauto=$autonop', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=300,width=1000,height=650');";?>" <?php echo " $cursty><div align='center' class='tahoma s10 black bold'>$icdp</div></td>
";
}
else{
echo "
                    <td class='b1'><div align='center' class='tahoma s10 black bold'>$icdp</div></td>
";
}

echo "
                    <td></td>
                    <td><div align='left' class='tahoma s10 black'>i.</div></td>
";

if($typep=="rvs"){
echo "
                    <td class='b1'"; ?> onclick="<?php echo "window.open('../2021codes/CaseRates/EditRVRP.php?caseno=$caseno&user=".base64_encode($user)."&editauto=$autonop', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=380');";?>" <?php echo " $cursty><div align='left' class='tahoma black' $valrelpsty>".$relpl1.$reladdp1."</div></td>
";
}
else{
echo "
                    <td class='b1'><div align='left' class='tahoma black' $valrelpsty>".$relpl1.$reladdp1."</div></td>
";
}

echo "
                    <td></td>
                    <td class='b1'><div align='center' class='tahoma s10 black bold'>$rvsp</div></td>
                    <td></td>
";

if($typep=="rvs"){
echo "
                    <td class='b1'"; ?> onclick="<?php echo "window.open('../2021codes/CaseRates/EditRVRP.php?caseno=$caseno&user=".base64_encode($user)."&editauto=$autonop', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=380');";?>" <?php echo " $cursty><div align='center' class='tahoma s10 black bold'>$reldateofprocedurep</div></td>
                    <td></td>
                    <td width='19'"; ?> onclick="<?php echo "window.open('../2021codes/CaseRates/EditRVRP.php?caseno=$caseno&user=".base64_encode($user)."&editauto=$autonop', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=380');";?>" <?php echo " $cursty><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='center' class='tahoma s9 black'>$rvspl</div></td>
                      </tr>
                    </table></td>
                    <td"; ?> onclick="<?php echo "window.open('../2021codes/CaseRates/EditRVRP.php?caseno=$caseno&user=".base64_encode($user)."&editauto=$autonop', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=380');";?>" <?php echo " $cursty><div align='center' class='tahoma s10 black'>left</div></td>
                    <td width='19'"; ?> onclick="<?php echo "window.open('../2021codes/CaseRates/EditRVRP.php?caseno=$caseno&user=".base64_encode($user)."&editauto=$autonop', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=380');";?>" <?php echo " $cursty><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='center' class='tahoma s9 black'>$rvspr</div></td>
                      </tr>
                    </table></td>
                    <td"; ?> onclick="<?php echo "window.open('../2021codes/CaseRates/EditRVRP.php?caseno=$caseno&user=".base64_encode($user)."&editauto=$autonop', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=380');";?>" <?php echo " $cursty><div align='center' class='tahoma s10 black'>right</div></td>
                    <td width='19'"; ?> onclick="<?php echo "window.open('../2021codes/CaseRates/EditRVRP.php?caseno=$caseno&user=".base64_encode($user)."&editauto=$autonop', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=380');";?>" <?php echo " $cursty><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='center' class='tahoma s9 black'>$rvspb</div></td>
                      </tr>
                    </table></td>
                    <td"; ?> onclick="<?php echo "window.open('../2021codes/CaseRates/EditRVRP.php?caseno=$caseno&user=".base64_encode($user)."&editauto=$autonop', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=380');";?>" <?php echo " $cursty><div align='center' class='tahoma s10 black'>both</div></td>
                    <td></td>
";
}
else{
echo "
                    <td class='b1'><div align='center' class='tahoma s10 black bold'>$reldateofprocedurep</div></td>
                    <td></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='center' class='tahoma s9 black'>$rvspl</div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>left</div></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='center' class='tahoma s9 black'>$rvspr</div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>right</div></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='center' class='tahoma s9 black'>$rvspb</div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>both</div></td>
                    <td></td>
";
}

echo "
                  </tr>

                  <tr>
                    <td height='2' colspan='20'></td>
                  </tr>

                  <tr>
                    <td height='17'></td>
                    <td><div align='left' class='tahoma s10 black'></div></td>
                    <td class='b1'"; ?> onclick="<?php echo "window.open('../2021codes/CaseRates/EditICDDesc.php?caseno=$caseno&user=".base64_encode($user)."&editauto=$editautop', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=300');";?>" <?php echo " $cursty><div align='left' class='tahoma black' $valpsty>".$pl2.$addp2."</div></td>
                    <td></td>
";

if($typep=="rvs"){
echo "
                    <td class='b1'"; ?> onclick="<?php echo "window.open('../2021codes/CaseRates/?caseno=$caseno&user=".base64_encode($user)."&frm=con&rvauto=$autonop', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=300,width=1000,height=650');";?>" <?php echo " $cursty><div align='center' class='tahoma s10 black bold'></div></td>
";
}
else{
echo "
                    <td class='b1'><div align='center' class='tahoma s10 black bold'></div></td>
";
}

echo "
                    <td></td>
                    <td><div align='left' class='tahoma s10 black'>ii.</div></td>
                    <td class='b1'><div align='left' class='tahoma black' $valrelpsty>".$relpl2.$reladdp2."</div></td>
                    <td></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>left</div></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>right</div></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>both</div></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td height='2' colspan='20'></td>
                  </tr>

                  <tr>
                    <td height='17'></td>
                    <td><div align='left' class='tahoma s10 black'></div></td>
                    <td class='b1'"; ?> onclick="<?php echo "window.open('../2021codes/CaseRates/EditICDDesc.php?caseno=$caseno&user=".base64_encode($user)."&editauto=$editautop', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=300');";?>" <?php echo " $cursty><div align='left' class='tahoma black' $valpsty>".$pl3.$addp3."</div></td>
                    <td></td>
";

if($typep=="rvs"){
echo "
                    <td class='b1'"; ?> onclick="<?php echo "window.open('../2021codes/CaseRates/?caseno=$caseno&user=".base64_encode($user)."&frm=con&rvauto=$autonop', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=300,width=1000,height=650');";?>" <?php echo " $cursty><div align='center' class='tahoma s10 black bold'></div></td>
";
}
else{
echo "
                    <td class='b1'><div align='center' class='tahoma s10 black bold'></div></td>
";
}

echo "
                    <td></td>
                    <td><div align='left' class='tahoma s10 black'>iii.</div></td>
                    <td class='b1'><div align='left' class='tahoma black' $valrelpsty>".$relpl3.$reladdp3."</div></td>
                    <td></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>left</div></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>right</div></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>both</div></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td height='2' colspan='20'></td>
                  </tr>
";
}
else{
echo "
                  <tr>
                    <td></td>
                    <td><div align='left' class='tahoma s10 black'>a.&nbsp;</div></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td><div align='left' class='tahoma s10 black'>i.</div></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>left</div></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>right</div></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>both</div></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan='20' height='2'></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td><div align='left' class='tahoma s10 black'></div></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td><div align='left' class='tahoma s10 black'>ii.</div></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>left</div></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>right</div></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>both</div></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan='20' height='2'></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td><div align='left' class='tahoma s10 black'></div></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td><div align='left' class='tahoma s10 black'>iii.</div></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>left</div></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>right</div></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>both</div></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan='20' height='2'></td>
                  </tr>
";
}

$kifsispresent=mysqli_query($mycon1,"SELECT * FROM `finalcaserate` WHERE `caseno`='$caseno' AND `level`='secondary'");
$kifsispresentcount=mysqli_num_rows($kifsispresent);

if($kifsispresentcount!=0){
  $fcrssql=mysqli_query($mycon1,"SELECT * FROM `finalcaserate` WHERE `caseno`='$caseno' AND `level`='secondary'");
  $sstat=1;
}
else{
  $fcrssql=mysqli_query($mycon1,"SELECT * FROM `finalcaserate` WHERE `caseno`='$caseno' AND `level` NOT LIKE 'secondary' AND `level` NOT LIKE 'primary' AND `con`='' ORDER BY CAST(`autono` AS UNSIGNED)");
  $sstat=0;
}

$fcrscount=mysqli_num_rows($fcrpsql);

if($fcrscount!=0){
  $fcrsfetch=mysqli_fetch_array($fcrssql);
  $autonos=$fcrsfetch['autono'];
  $icdcodes=$fcrsfetch['icdcode'];
  $desccf2s=trim($fcrsfetch['desccf2']);
  $types=$fcrsfetch['type'];
  $relatedprocedures=$fcrsfetch['relatedprocedure'];
  $dateofprocedures=$fcrsfetch['dateofprocedure'];
  $lateralitys=$fcrsfetch['laterality'];

  if($sstat==0){
    $dontinclude="AND `icdcode` NOT LIKE '$icdcodes'";
  }
  else{
    $dontinclude="";
  }

  if($dateofprocedures!=""){
    $reldateofprocedures=date("m-d-Y",strtotime($dateofprocedures));
  }
  else{
    $reldateofprocedures="";
  }

  if($types=="icd"){
    $icds=$icdcodes;
    $rvss="";

    $relsl1="";
    $reladds1="";
    $relsl2="";
    $reladds2="";
    $relsl3="";
    $reladds3="";

    $reldesccf2s="";
    $valrelssty="";
    $editautos=$autonos;
  }
  else if($types=="rvs"){
    $relicdssql=mysqli_query($mycon1,"SELECT `autono`, `icdcode`, `desccf2` FROM `finalcaserate` WHERE `con`='$autonos'");
    $relicdscount=mysqli_num_rows($relicdssql);

    if($relicdscount!=0){
      $relicdsfetch=mysqli_fetch_array($relicdssql);
      $relicds=$relicdsfetch['icdcode'];
      $reldesccf2s=$relicdsfetch['desccf2'];
      $editautos=$relicdsfetch['autono'];
    }
    else{
      $relicds="";
      $reldesccf2s="";
      $editautos=$autonos;
    }

    $icds=$relicds;
    $rvss=$icdcodes;

    //5px 63 189max
    //6px 53 159max
    //7px 45 135max
    //8px 39 117max
    //9px 35 105max

    //RELATED PROCEDURE----------------------------------------------------------------------------
    if(strlen($relatedprocedures)<="105"){
      $valrels=35;
      $valrelssty="style='font-size: 9px;'";
    }
    else if((strlen($relatedprocedures)<="117")&&(strlen($relatedprocedurep)>"105")){
      $valrels=39;
      $valrelssty="style='font-size: 8px;'";
    }
    else if((strlen($relatedprocedures)<="135")&&(strlen($relatedprocedurep)>"117")){
      $valrels=45;
      $valrelssty="style='font-size: 7px;'";
    }
    else if((strlen($relatedprocedures)<="159")&&(strlen($relatedprocedurep)>"135")){
      $valrels=53;
      $valrelssty="style='font-size: 6px;'";
    }
    else{
      $valrels=63;
      $valrelssty="style='font-size: 5px;'";
    }

    //Line 1
    $relsl1=substr($relatedprocedures, 0, $valrels);
    $relsl1knowifspacenext=substr($relatedprocedures, $valrels, 1);
    $relsl1knowifspaceprev=substr($relatedprocedures, ($valrels-1), 1);
    if(($relsl1knowifspacenext!=' ')||($relsl1knowifspacenext!='')){
      if($relsl1knowifspaceprev!=' '){
        $reladds1="-";
      }
      else{
        $reladds1="";
      }
    }
    else{
      $reladds1="";
    }

    //Line 2
    $relsl2=substr($relatedprocedures, $valrels, $valrels);
    $relsl2knowifspacenext=substr($relatedprocedures, ($valrels*2), 1);
    $relsl2knowifspaceprev=substr($relatedprocedures, (($valrels*2)-1), 1);
    if(($relsl2knowifspacenext!=' ')||($relsl2knowifspacenext!='')){
      if($relsl2knowifspaceprev!=' '){
        $reladds2="-";
      }
      else{
        $reladds2="";
      }
    }
    else{
      $reladds2="";
    }

    //Line 3
    $relsl3=substr($relatedprocedures, ($valrels*2), $valrels);
    $relsl3knowifspacenext=substr($relatedprocedures, ($valrels*3), 1);
    $relsl3knowifspaceprev=substr($relatedprocedures, (($valrels*3)-1), 1);
    if($relsl3knowifspacenext!=' '){
      if(($relsl3knowifspaceprev!=' ')&&($relsl3knowifspaceprev!='')){
        $reladds3="-";
      }
      else{
        $reladds3="";
      }
    }
    else{
      $reladds3="";
    }
    //END RELATED PROCEDURE------------------------------------------------------------------------
  }
  else{
    $icds="";
    $rvss="";

    $relsl1="";
    $reladds1="";
    $relsl2="";
    $reladds2="";
    $relsl3="";
    $reladds3="";

    $reldesccf2s="";
    $valrelssty="";
    $editautos=$autonos;
  }

  if($reldesccf2s!=""){
    $realdescs=$reldesccf2s;
  }
  else{
    $realdescs=$desccf2s;
  }

  //5px 31 93max
  //6px 27 81max
  //7px 23 69max
  //8px 20 60max
  //9px 17 51max

  //5px 42 126max
  //6px 36 108max
  //7px 31 93max
  //8px 27 81max
  //9px 21 63max

//DESCRIPTION----------------------------------------------------------------------------------------------------------------------------------------
  if(strlen($realdescs)<="63"){
    $vals=21;
    $valssty="style='font-size: 9px;'";
  }
  else if((strlen($realdescs)<="81")&&(strlen($realdescs)>"63")){
    $vals=27;
    $valssty="style='font-size: 8px;'";
  }
  else if((strlen($realdescs)<="93")&&(strlen($realdescs)>"60")){
    $vals=31;
    $valssty="style='font-size: 7px;'";
  }
  else if((strlen($realdescs)<="108")&&(strlen($realdescs)>"93")){
    $vals=36;
    $valssty="style='font-size: 6px;'";
  }
  else{
    $vals=42;
    $valssty="style='font-size: 5px;'";
  }

  //Desc Line 1
  $sl1=substr($realdescs, 0, $vals);
  $sl1knowifspacenext=substr($realdescs, $vals, 1);
  $sl1knowifspaceprev=substr($realdescs, ($vals-1), 1);
  if(($sl1knowifspacenext!=' ')||($sl1knowifspacenext!='')){
    if(($sl1knowifspaceprev!=' ')&&($sl1knowifspaceprev!='')){
      $adds1="-";
    }
    else{
      $adds1="";
    }
  }
  else{
    $adds1="";
  }

  //Desc Line 2
  $sl2=substr($realdescs, ($vals*1), $vals);
  $sl2knowifspacenext=substr($realdescs, ($vals*2), 1);
  $sl2knowifspaceprev=substr($realdescs, (($vals*2)-1), 1);
  if(($sl2knowifspacenext!=' ')||($sl2knowifspacenext!='')){
    if(($sl2knowifspaceprev!=' ')&&($sl2knowifspaceprev!='')){
      $adds2="-";
    }
    else{
      $adds2="";
    }
  }
  else{
    $adds2="";
  }

  //Desc Line 3
  $sl3=substr($realdescs, ($vals*2), $vals);
  $sl3knowifspacenext=substr($realdescs, ($vals*3), 1);
  $sl3knowifspaceprev=substr($realdescs, (($vals*3)-1), 1);
  if($sl3knowifspacenext!=' '){
    if(($sl3knowifspaceprev!=' ')&&($sl3knowifspaceprev!='')){
      $adds3="-";
    }
    else{
      $adds3="";
    }
  }
  else{
    $adds3="";
  }
//END DESCRIPTION--------------------------------------------------------------------------------------------------------------------------

  if($lateralitys=="R"){
    $rvssl="";
    $rvssr="&#10004;";
    $rvssb="";
    $rvssn="";
  }
  else if($lateralitys=="L"){
    $rvssl="&#10004;";
    $rvssr="";
    $rvssb="";
    $rvssn="";
  }
  else if($lateralitys=="B"){
    $rvssl="";
    $rvssr="";
    $rvssb="&#10004;";
    $rvssn="";
  }
  else{
    $rvssl="";
    $rvssr="";
    $rvssb="";
    $rvssn="";
  }

echo "
                  <tr>
                    <td height='17'></td>
                    <td><div align='left' class='tahoma s10 black'>b.&nbsp;</div></td>
                    <td class='b1'"; ?> onclick="<?php echo "window.open('../2021codes/CaseRates/EditICDDesc.php?caseno=$caseno&user=".base64_encode($user)."&editauto=$editautos', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=300');";?>" <?php echo " $cursty><div align='left' class='tahoma black' $valssty>".$sl1.$adds1."</div></td>
                    <td></td>
";

if($types=="rvs"){
echo "
                    <td class='b1'"; ?> onclick="<?php echo "window.open('../2021codes/CaseRates/?caseno=$caseno&user=".base64_encode($user)."&frm=con&rvauto=$autonos', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=300,width=1000,height=650');";?>" <?php echo " $cursty><div align='center' class='tahoma s10 black bold'>$icds</div></td>
";
}
else{
echo "
                    <td class='b1'><div align='center' class='tahoma s10 black bold'>$icds</div></td>
";
}

echo "
                    <td></td>
                    <td><div align='left' class='tahoma s10 black'>i.</div></td>
                    <td class='b1'><div align='left' class='tahoma black' $valrelssty>".$relsl1.$reladds1."</div></td>
                    <td></td>
                    <td class='b1'><div align='center' class='tahoma s10 black bold'>$rvss</div></td>
                    <td></td>
                    <td class='b1'><div align='center' class='tahoma s10 black bold'>$reldateofprocedures</div></td>
                    <td></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='center' class='tahoma s9 black'>$rvssl</div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>left</div></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='center' class='tahoma s9 black'>$rvssr</div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>right</div></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='center' class='tahoma s9 black'>$rvssb</div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>both</div></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td height='2' colspan='20'></td>
                  </tr>

                  <tr>
                    <td height='17'></td>
                    <td><div align='left' class='tahoma s10 black'></div></td>
                    <td class='b1'"; ?> onclick="<?php echo "window.open('../2021codes/CaseRates/EditICDDesc.php?caseno=$caseno&user=".base64_encode($user)."&editauto=$editautos', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=300');";?>" <?php echo " $cursty><div align='left' class='tahoma black' $valssty>".$sl2.$adds2."</div></td>
                    <td></td>
";

if($types=="rvs"){
echo "
                    <td class='b1'"; ?> onclick="<?php echo "window.open('../2021codes/CaseRates/?caseno=$caseno&user=".base64_encode($user)."&frm=con&rvauto=$autonos', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=300,width=1000,height=650');";?>" <?php echo " $cursty><div align='center' class='tahoma s10 black bold'></div></td>
";
}
else{
echo "
                    <td class='b1'><div align='center' class='tahoma s10 black bold'></div></td>
";
}

echo "
                    <td></td>
                    <td><div align='left' class='tahoma s10 black'>ii.</div></td>
                    <td class='b1'><div align='left' class='tahoma black' $valrelssty>".$relsl2.$reladds2."</div></td>
                    <td></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>left</div></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>right</div></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>both</div></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td height='2' colspan='20'></td>
                  </tr>

                  <tr>
                    <td height='17'></td>
                    <td><div align='left' class='tahoma s10 black'></div></td>
                    <td class='b1'"; ?> onclick="<?php echo "window.open('../2021codes/CaseRates/EditICDDesc.php?caseno=$caseno&user=".base64_encode($user)."&editauto=$editautos', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=300');";?>" <?php echo " $cursty><div align='left' class='tahoma black' $valssty>".$sl3.$adds3."</div></td>
                    <td></td>
";

if($types=="rvs"){
echo "
                    <td class='b1'"; ?> onclick="<?php echo "window.open('../2021codes/CaseRates/?caseno=$caseno&user=".base64_encode($user)."&frm=con&rvauto=$autonos', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=300,width=1000,height=650');";?>" <?php echo " $cursty><div align='center' class='tahoma s10 black bold'></div></td>
";
}
else{
echo "
                    <td class='b1'><div align='center' class='tahoma s10 black bold'></div></td>
";
}

echo "
                    <td></td>
                    <td><div align='left' class='tahoma s10 black'>iii.</div></td>
                    <td class='b1'><div align='left' class='tahoma black' $valrelssty>".$relsl3.$reladds3."</div></td>
                    <td></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>left</div></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>right</div></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>both</div></td>
                    <td></td>
                  </tr>

";
}
else{
echo "
                  <tr>
                    <td></td>
                    <td><div align='left' class='tahoma s10 black'>b.&nbsp;</div></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td><div align='left' class='tahoma s10 black'>i.</div></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>left</div></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>right</div></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>both</div></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan='20' height='2'></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td><div align='left' class='tahoma s10 black'></div></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td><div align='left' class='tahoma s10 black'>ii.</div></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>left</div></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>right</div></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>both</div></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan='20' height='2'></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td><div align='left' class='tahoma s10 black'></div></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td><div align='left' class='tahoma s10 black'>iii.</div></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>left</div></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>right</div></td>
                    <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='tahoma s9 black'></div></td>
                      </tr>
                    </table></td>
                    <td><div align='center' class='tahoma s10 black'>both</div></td>
                    <td></td>
                  </tr>
";
}

echo "
                </table></td>
              </tr>
              <tr>
                <td height='5'></td>
              </tr>
            </table></td>
          </tr>
";
?>
