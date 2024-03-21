<?php
echo "
          <tr>
            <td colspan='3'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
              <tr>
                <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td width='5'></td>
                    <td><div align='left' class='tahoma s9 black'><b>7. Discharge Diagnosis/es</b> (Use additional CF2 if necessary):</div></td>
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
                    <td class='Tahoma10black'></td>
                    <td width='125'><div align='center' class='tahoma s10 black'>Diagnosis</div></td>
                    <td width='8'></td>
                    <td width='80'><div align='center' class='tahoma s10 black'>ICD-10 Code/s</div></td>
                    <td width='8'></td>
                    <td><div align='center' class='tahoma s10 black'></div></td>
                    <td width='180'><div align='center' class='tahoma s10 black'>Related Procedure/s (if there's any)</div></td>
                    <td width='8'></td>
                    <td><div align='center' class='tahoma s10 black'>RVS Code</div></td>
                    <td width='8'></td>
                    <td><div align='center' class='tahoma s10 black'>Date of Procedure</div></td>
                    <td width='8'></td>
                    <td colspan='6'><div align='center' class='tahoma s10 black'>Laterality (check pplicable box)</div></td></td>
                    <td width='8'></td>
                  </tr>
                  <tr>
                    <td colspan='20' height='3'></td>
                  </tr>
";

$let=0;
while($disdxfetch=mysqli_fetch_array($adddxsql)){
  $autonop=$disdxfetch['autono'];
  $icdcodep=$disdxfetch['icdcode'];
  $desccf2p=trim($disdxfetch['desccf2']);
  $typep=$disdxfetch['type'];
  $relatedprocedurep=$disdxfetch['relatedprocedure'];
  $dateofprocedurep=$disdxfetch['dateofprocedure'];
  $lateralityp=$disdxfetch['laterality'];
  $let++;

  if($let==1){$letdis="c";}
  else if($let==2){$letdis="d";}
  else if($let==3){$letdis="e";}
  else if($let==4){$letdis="f";}
  else if($let==5){$letdis="g";}
  else if($let==6){$letdis="h";}
  else if($let==7){$letdis="i";}
  else if($let==8){$letdis="j";}
  else if($let==9){$letdis="k";}
  else if($let==10){$letdis="l";}
  else if($let==11){$letdis="m";}

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
    $editautoa=$autonop;
  }
  else if($typep=="rvs"){
    $relicdpsql=mysqli_query($mycon1,"SELECT `autono`, `icdcode`, `desccf2` FROM `finalcaserate` WHERE `con`='$autonop'");
    $relicdpcount=mysqli_num_rows($relicdpsql);

    if($relicdpcount!=0){
      $relicdpfetch=mysqli_fetch_array($relicdpsql);
      $relicdp=$relicdpfetch['icdcode'];
      $reldesccf2p=$relicdpfetch['desccf2'];
      $editautoa=$relicdpfetch['autono'];
    }
    else{
      $relicdp="";
      $reldesccf2p="";
      $editautoa=$autonop;
    }

    $icdp=$relicdp;
    $rvsp=$icdcodep;

    //5px 63 189max
    //6px 53 159max
    //7px 45 135max
    //8px 39 117max
    //9px 35 105max

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
    $editautoa=$autonop;
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

  //Desc Line 1
  $pl1=substr($realdescp, 0, $valp);
  $pl1knowifspacenext=substr($realdescp, $valp, 1);
  $pl1knowifspaceprev=substr($realdescp, ($valp-1), 1);
  if(($pl1knowifspacenext!=' ')&&($pl1knowifspacenext!='')){
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
  if(($pl2knowifspacenext!=' ')&&($pl2knowifspacenext!='')){
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
  if(($pl3knowifspacenext!=' ')&&($pl3knowifspacenext!='')){
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
                    <td><div align='left' class='tahoma s10 black'>$letdis.&nbsp;</div></td>
                    <td class='b1'"; ?> onclick="<?php echo "window.open('../2021codes/CaseRates/EditICDDesc.php?caseno=$caseno&user=".base64_encode($user)."&editauto=$editautoa', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=300');";?>" <?php echo " $cursty><div align='left' class='tahoma black' $valpsty>".$pl1.$addp1."</div></td>
                    <td></td>
                    <td class='b1'><div align='center' class='tahoma s10 black bold'>$icdp</div></td>
                    <td></td>
                    <td><div align='left' class='tahoma s10 black'>i.</div></td>
                    <td class='b1'><div align='left' class='tahoma black' $valrelpsty>".$relpl1.$reladdp1."</div></td>
                    <td></td>
                    <td class='b1'><div align='center' class='tahoma s10 black bold'>$rvsp</div></td>
                    <td></td>
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
                  </tr>

                  <tr>
                    <td height='2' colspan='20'></td>
                  </tr>

                  <tr>
                    <td height='17'></td>
                    <td><div align='left' class='tahoma s10 black'></div></td>
                    <td class='b1'"; ?> onclick="<?php echo "window.open('../2021codes/CaseRates/EditICDDesc.php?caseno=$caseno&user=".base64_encode($user)."&editauto=$editautoa', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=300');";?>" <?php echo " $cursty><div align='left' class='tahoma black' $valpsty>".$pl2.$addp2."</div></td>
                    <td></td>
                    <td class='b1'><div align='center' class='tahoma s10 black'></div></td>
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
                    <td class='b1'"; ?> onclick="<?php echo "window.open('../2021codes/CaseRates/EditICDDesc.php?caseno=$caseno&user=".base64_encode($user)."&editauto=$editautoa', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=300');";?>" <?php echo " $cursty><div align='left' class='tahoma black' $valpsty>".$pl3.$addp3."</div></td>
                    <td></td>
                    <td class='b1'><div align='center' class='tahoma s10 black'></div></td>
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
