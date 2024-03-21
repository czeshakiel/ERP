<?php
echo "
          <tr>
            <td colspan='3' class='b2'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
              <tr>
                <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td width='5'></td>
                    <td"; ?> onclick="<?php echo "window.open('../CaseRates/?caseno=$caseno&user=".base64_encode($user)."', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=300,width=1000,height=650');";?>" <?php echo " $cursty><div align='left' class='tahoma s9 black'><b>7. Discharge Diagnosis/es</b> (Use additional CF2 if necessary):</div></td>
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
                    <td width='138'><div align='center' class='tahoma s10 black'>Diagnosis</div></td>
                    <td width='8'></td>
                    <td width='76'><div align='center' class='tahoma s10 black'>ICD-10 Code/s</div></td>
                    <td width='7'></td>
                    <td width='10'><div align='center' class='tahoma s10 black'></div></td>
                    <td width='185'><div align='center' class='tahoma s10 black'>Related Procedure/s (if there's any)</div></td>
                    <td width='7'></td>
                    <td width='50'><div align='center' class='tahoma s10 black'>RVS Code</div></td>
                    <td width='7'></td>
                    <td width='80'><div align='center' class='tahoma s10 black'>Date of Procedure</div></td>
                    <td width='7'></td>
                    <td colspan='6'><div align='center' class='tahoma black'><span class='s9'>Laterality</span><span class='s8'> (check applicable box)</span></div></td></td>
                    <td width='8'></td>
                  </tr>
                  <tr>
                    <td colspan='20' height='3'></td>
                  </tr>
";

//EXTRA START----------------------------------------------------------------------------------------------------------------------------------------
$zc=1;
if($lastarray>$lastlinetot){
$extrasql=mysqli_query($conn,"SELECT * FROM `finalcaserate` WHERE `autono`='$editauto'");
$extrafetch=mysqli_fetch_array($extrasql);
$exdesc=$extrafetch['description'];
$extype=$extrafetch['type'];

$exnewdesc=substr($exdesc, (($lastlinetot*29)));

$excharcount=strlen($exnewdesc);
$exlineint=$excharcount/$valp;
if(stripos($exlineint, ".") !== FALSE){
  $exlinespl=preg_split("/\./",$exlineint);
  $exlineforreal=$exlinespl[0]+1;
}
else{
  $exlineforreal=$exlineint;
}

for($zc=1;$zc<=$exlineforreal;$zc++){
  $exline=substr($exnewdesc, ($valp*($zc-1)), $valp);
  $exlinenext=substr($exnewdesc, ($valp*$zc), 1);
  $exlineprev=substr($exnewdesc, (($valp*$zc)-1), 1);
  if(($exlinenext!=' ')||($exlinenext!='')){
    if(($exlineprev!=' ')&&($exlineprev!='')){
      $exadd="-";
    }
    else{
      $exadd="";
    }
  }
  else{
    $exadd="";
  }

  $zv=$zc+$lastlinetot;

  if($zv=="1"){$exrom="i";}
  else if($zv=="2"){$exrom="ii";}
  else if($zv=="3"){$exrom="iii";}
  else if($zv=="4"){$exrom="iv";}
  else if($zv=="5"){$exrom="v";}
  else if($zv=="6"){$exrom="vi";}
  else if($zv=="7"){$exrom="vii";}
  else if($zv=="8"){$exrom="viii";}
  else if($zv=="9"){$exrom="ix";}
  else if($zv=="10"){$exrom="x";}
  else if($zv=="11"){$exrom="xi";}
  else if($zv=="12"){$exrom="xii";}
  else if($zv=="13"){$exrom="xiii";}
  else if($zv=="14"){$exrom="xiv";}
  else if($zv=="15"){$exrom="xv";}

echo "
                  <tr>
                    <td></td>
                    <td><div align='left' class='tahoma s10 black'>&nbsp;</div></td>
                    <td class='b1'"; ?> onclick="<?php echo "window.open('../CaseRates/EditICDDesc.php?caseno=$caseno&user=".base64_encode($user)."&editauto=$editauto', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=300');";?>" <?php echo " $cursty><div align='left' class='tahoma black' $valpsty>".$exline.$exadd."</div></td>
                    <td></td>
                    <td class='b1'><div align='center' class='tahoma s10 black bold'></div></td>
                    <td></td>
                    <td><div align='left' class='tahoma s10 black'>$exrom.</div></td>
                    <td class='b1'><div align='left' class='tahoma black'></div></td>
                    <td></td>
                    <td class='b1'><div align='center' class='tahoma s10 black bold'></div></td>
                    <td></td>
                    <td class='b1'><div align='center' class='tahoma s10 black'></div></td>
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
}
//EXTRA END------------------------------------------------------------------------------------------------------------------------------------------

if($fcrpcount!=0){
  $linecount=$zc-1;
  $allline=$zc-1;
  $lastarray=0;
  while($fcrpfetch=mysqli_fetch_array($fcrpsql)){
  $autonop=$fcrpfetch['autono'];
  $icdcodep=$fcrpfetch['icdcode'];
  $desc=trim($fcrpfetch['description']);
  $typep=$fcrpfetch['type'];
  $relatedprocedurep=$fcrpfetch['relatedprocedure'];
  $dateofprocedurep=$fcrpfetch['dateofprocedure'];
  $lateralityp=$fcrpfetch['laterality'];
  $a++;

  $dontinclude=$dontinclude." AND `autono` NOT LIKE '$autonop'";

  if($a=="1"){$let="a.";}
  else if($a=="2"){$let="b.";}
  else if($a=="3"){$let="c.";}
  else if($a=="4"){$let="d.";}
  else if($a=="5"){$let="e.";}
  else if($a=="6"){$let="f.";}
  else if($a=="7"){$let="g.";}
  else if($a=="8"){$let="h.";}
  else if($a=="9"){$let="i.";}
  else if($a=="10"){$let="j.";}
  else if($a=="11"){$let="k.";}
  else if($a=="12"){$let="l.";}
  else if($a=="13"){$let="m.";}
  else if($a=="14"){$let="n.";}
  else if($a=="15"){$let="o.";}

  $valp=29;
  $valpsty="style='font-size: 8px;'";

  $valrelp=38;
  $valrelpsty="style='font-size: 8px;'";

  if($dateofprocedurep!=""){
    $reldateofprocedurep=date("m-d-Y",strtotime($dateofprocedurep));
  }
  else{
    $reldateofprocedurep="";
  }

  if($typep=="rvs"){
  //Related Procedure Line Count---------------------------------------------------------------------------------------
    //8px 41
    $rpcount=strlen($relatedprocedurep);

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
  //-------------------------------------------------------------------------------------------------------------------

  //Added DX Description-----------------------------------------------------------------------------------------------
  //8px 29
  $kdxicdsql=mysqli_query($conn,"SELECT `autono`, `description`, `icdcode` FROM `finalcaserate` WHERE `con`='$autonop'");
  $kdxicdcount=mysqli_num_rows($kdxicdsql);
    if($kdxicdcount!=0){
      $kdxicdfetch=mysqli_fetch_array($kdxicdsql);
      $kdxauto=$kdxicdfetch['autono'];
      $kdxdesc=$kdxicdfetch['description'];
      $kdxicd=$kdxicdfetch['icdcode'];

      $kdxdesccount=strlen($kdxdesc);

      $klineno=$kdxdesccount/$valp;
      if(stripos($klineno, ".") !== FALSE){
        $klinenospl=preg_split("/\./",$klineno);
        if($klinenospl[1]>0){
          $klinenorel=$klinenospl[0]+1;
        }
        else{
          $klinenorel=$klineno;
        }
      }
      else{
        $klinenorel=$klineno;
      }
      $icdrel=$kdxicd;
      $editauto=$kdxauto;
    }
    else{
      $kdxdesc=$desc;
      $kdxdesccount=strlen($kdxdesc);
      $klineno=$kdxdesccount/$valp;
      if(stripos($klineno, ".") !== FALSE){
        $klinenospl=preg_split("/\./",$klineno);
        if($klinenospl[1]>0){
          $klinenorel=$klinenospl[0]+1;
        }
        else{
          $klinenorel=$klineno;
        }
      }
      else{
        $klinenorel=$klineno;
      }

      $icdrel="";
      $editauto=$autonop;
    }

    $rvcode=$icdcodep;
    $prdate=date("m-d-Y",strtotime($dateofprocedurep));
  //-------------------------------------------------------------------------------------------------------------------
  }
  else if($typep=="icd"){
    $pnolinerprel=0;

    $kdxdesc=$desc;

    $kdxdesccount=strlen($kdxdesc);

    $klineno=$kdxdesccount/$valp;
    if(stripos($klineno, ".") !== FALSE){
      $klinenospl=preg_split("/\./",$klineno);
      if($klinenospl[1]>0){
        $klinenorel=$klinenospl[0]+1;
      }
      else{
        $klinenorel=$klineno;
      }
    }
    else{
      $klinenorel=$klineno;
    }

    $icdrel=$icdcodep;
    $rvcode="";
    $prdate="";
    $editauto=$autonop;
  }

  if($pnolinerprel>$klinenorel){
    $linearray=$pnolinerprel;
  }
  else if($klinenorel>$pnolinerprel){
    $linearray=$klinenorel;
  }
  else{
    $linearray=$klinenorel;
  }

$linecount+=$linearray;
//LINE LOOP------------------------------------------------------------------------------------------------------------
for($zx=1;$zx<=$linearray;$zx++){
  $allline++;
  if($allline>6){$lastaaray=$linearray;break;$lastlinetot=$zx;}
  else{$lastarray=$linearray;$lastlinetot=$zx;}

  $pl1=substr($kdxdesc, ($valp*($zx-1)), $valp);
  $pl1knowifspacenext=substr($kdxdesc, ($valp*$zx), 1);
  $pl1knowifspaceprev=substr($kdxdesc, (($valp*$zx)-1), 1);
  if(($pl1knowifspacenext!=' ')||($pl1knowifspacenext!='')){
    if(($pl1knowifspaceprev!=' ')&&($pl1knowifspaceprev!='')){
      $addp1="-";
    }
    else{
      $addp1="";
    }
  }
  else{
    $addp1="";
  }

  $relpl1=substr($relatedprocedurep,($valrelp*($zx-1)), $valrelp);
  $relpl1knowifspacenext=substr($relatedprocedurep, ($valrelp*$zx), 1);
  $relpl1knowifspaceprev=substr($relatedprocedurep, (($valrelp*$zx)-1), 1);
  if(($relpl1knowifspacenext!=' ')||($relpl1knowifspacenext!='')){
    if(($relpl1knowifspaceprev!='')&&($relpl1knowifspaceprev!='')){
      $reladdp1="-";
    }
    else{
      $reladdp1="";
    }
  }
  else{
    $reladdp1="";
  }

  if($zx=="1"){$rom="i";}
  else if($zx=="2"){$rom="ii";}
  else if($zx=="3"){$rom="iii";}
  else if($zx=="4"){$rom="iv";}
  else if($zx=="5"){$rom="v";}
  else if($zx=="6"){$rom="vi";}
  else if($zx=="7"){$rom="vii";}
  else if($zx=="8"){$rom="viii";}
  else if($zx=="9"){$rom="ix";}
  else if($zx=="10"){$rom="x";}
  else if($zx=="11"){$rom="xi";}
  else if($zx=="12"){$rom="xii";}
  else if($zx=="13"){$rom="xiii";}
  else if($zx=="14"){$rom="xiv";}
  else if($zx=="15"){$rom="xv";}

  if($zx==1){
    $label=$let;
    $icddisprel=$icdrel;
    $rvcoderel=$rvcode;
    $prdaterel=$prdate;

    if($lateralityp=="R"){$rvspl="";$rvspr="&#10004;";$rvspb="";$rvspn="";}
    else if($lateralityp=="L"){$rvspl="&#10004;";$rvspr="";$rvspb="";$rvspn="";}
    else if($lateralityp=="B"){$rvspl="";$rvspr="";$rvspb="&#10004;";$rvspn="";}
    else{$rvspl="";$rvspr="";$rvspb="";$rvspn="";}
  }
  else{
    $label="";
    $icddisprel="";
    $rvcoderel="";
    $prdaterel="";

    $rvspl="";
    $rvspr="";
    $rvspb="";
    $rvspn="";
  }

echo "
                  <tr>
                    <td></td>
                    <td><div align='left' class='tahoma s10 black'>$label&nbsp;</div></td>
                    <td class='b1'"; ?> onclick="<?php echo "window.open('../CaseRates/EditICDDesc.php?caseno=$caseno&user=".base64_encode($user)."&editauto=$editauto', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=300');";?>" <?php echo " $cursty><div align='left' class='tahoma black' $valpsty>".$pl1.$addp1."</div></td>
                    <td></td>
";

if($typep=="rvs"){
echo "
                    <td class='b1'"; ?> onclick="<?php echo "window.open('../CaseRates/?caseno=$caseno&user=".base64_encode($user)."&frm=con&rvauto=$autonop', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=300,width=1000,height=650');";?>" <?php echo " $cursty><div align='center' class='tahoma s10 black bold'>$icddisprel</div></td>
";
}
else{
echo "
                    <td class='b1'><div align='center' class='tahoma s10 black bold'>$icddisprel</div></td>
";
}

echo "
                    <td></td>
                    <td><div align='left' class='tahoma s10 black'>$rom.</div></td>
";

if($typep=="rvs"){
echo "
                    <td class='b1'"; ?> onclick="<?php echo "window.open('../CaseRates/EditRVRP.php?caseno=$caseno&user=".base64_encode($user)."&editauto=$autonop', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=380');";?>" <?php echo " $cursty><div align='left' class='tahoma black' $valrelpsty>".$relpl1.$reladdp1."</div></td>
";
}
else{
echo "
                    <td class='b1'><div align='left' class='tahoma black'></div></td>
";
}

echo "
                    <td></td>
                    <td class='b1'><div align='center' class='tahoma s10 black bold'>$rvcoderel</div></td>
                    <td></td>
";

if($typep=="rvs"){
echo "
                    <td class='b1'"; ?> onclick="<?php echo "window.open('../CaseRates/EditRVRP.php?caseno=$caseno&user=".base64_encode($user)."&editauto=$autonop', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=380');";?>" <?php echo " $cursty><div align='center' class='tahoma s10 black'>$prdaterel</div></td>
                    <td></td>
                    <td width='19'"; ?> onclick="<?php echo "window.open('../CaseRates/EditRVRP.php?caseno=$caseno&user=".base64_encode($user)."&editauto=$autonop', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=380');";?>" <?php echo " $cursty><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='center' class='tahoma s9 black'>$rvspl</div></td>
                      </tr>
                    </table></td>
                    <td"; ?> onclick="<?php echo "window.open('../CaseRates/EditRVRP.php?caseno=$caseno&user=".base64_encode($user)."&editauto=$autonop', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=380');";?>" <?php echo " $cursty><div align='center' class='tahoma s10 black'>left</div></td>
                    <td width='19'"; ?> onclick="<?php echo "window.open('../CaseRates/EditRVRP.php?caseno=$caseno&user=".base64_encode($user)."&editauto=$autonop', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=380');";?>" <?php echo " $cursty><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='center' class='tahoma s9 black'>$rvspr</div></td>
                      </tr>
                    </table></td>
                    <td"; ?> onclick="<?php echo "window.open('../CaseRates/EditRVRP.php?caseno=$caseno&user=".base64_encode($user)."&editauto=$autonop', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=380');";?>" <?php echo " $cursty><div align='center' class='tahoma s10 black'>right</div></td>
                    <td width='19'"; ?> onclick="<?php echo "window.open('../CaseRates/EditRVRP.php?caseno=$caseno&user=".base64_encode($user)."&editauto=$autonop', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=380');";?>" <?php echo " $cursty><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td height='17' width='17' class='t1 b1 l1 r1'><div align='center' class='tahoma s9 black'>$rvspb</div></td>
                      </tr>
                    </table></td>
                    <td"; ?> onclick="<?php echo "window.open('../CaseRates/EditRVRP.php?caseno=$caseno&user=".base64_encode($user)."&editauto=$autonop', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=700,width=450,height=380');";?>" <?php echo " $cursty><div align='center' class='tahoma s10 black'>both</div></td>
                    <td></td>
";
}
else{
echo "
                    <td class='b1'><div align='center' class='tahoma s10 black'></div></td>
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
";
}

echo "
                  </tr>
                  <tr>
                    <td colspan='20' height='2'></td>
                  </tr>
";
}
if($linecount>=6){break;}
//LINE LOOP END--------------------------------------------------------------------------------------------------------
}
}

if($allline<6){
  $a+=1;
  if($a=="1"){$let="a.";}
  else if($a=="2"){$let="b.";}
  else if($a=="3"){$let="c.";}
  else if($a=="4"){$let="d.";}
  else if($a=="5"){$let="e.";}
  else if($a=="6"){$let="f.";}
  else if($a=="7"){$let="g.";}
  else if($a=="8"){$let="h.";}
  else if($a=="9"){$let="i.";}
  else if($a=="10"){$let="j.";}
  else if($a=="11"){$let="k.";}
  else if($a=="12"){$let="l.";}
  else if($a=="13"){$let="m.";}
  else if($a=="14"){$let="n.";}
  else if($a=="15"){$let="o.";}

  $padloop=6-$allline;

for($zb=1;$zb<=$padloop;$zb++){
  if($zb==1){
    $label=$let;
  }
  else{
    $label="";
  }

  $zn=$zb+$lastlinetot;

  if($zn=="1"){$rom="i";}
  else if($zn=="2"){$rom="ii";}
  else if($zn=="3"){$rom="iii";}
  else if($zn=="4"){$rom="iv";}
  else if($zn=="5"){$rom="v";}
  else if($zn=="6"){$rom="vi";}
  else if($zn=="7"){$rom="vii";}
  else if($zn=="8"){$rom="viii";}
  else if($zn=="9"){$rom="ix";}
  else if($zn=="10"){$rom="x";}
  else if($zn=="11"){$rom="xi";}
  else if($zn=="12"){$rom="xii";}
  else if($zn=="13"){$rom="xiii";}
  else if($zn=="14"){$rom="xiv";}
  else if($zn=="15"){$rom="xv";}

echo "
                  <tr>
                    <td></td>
                    <td><div align='left' class='tahoma s10 black'>&nbsp;</div></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                    <td></td>
                    <td><div align='left' class='tahoma s10 black'>$rom.</div></td>
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
