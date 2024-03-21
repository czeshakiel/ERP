<?php

$ret=fopen("Files/$filn.txt", "r") or die("Unable to open file!");
$retres=trim(fgets($ret));
fclose($ret);

$retress=preg_split("/\*/",$retres);

$retresss=preg_split("/\|/",$retress[0]);

$drds=preg_split("/\<->/",$retresss[$dcset]);

$dfsql=mysqli_query($conn,"SELECT phicacc FROM docfile WHERE name='".$drds[0]."'");
$dfcount=mysqli_num_rows($dfsql);
if($dfcount==0){
  $dpac01="&nbsp;";
  $dpac02="&nbsp;";
  $dpac03="&nbsp;";
  $dpac04="&nbsp;";
  $dpac05="&nbsp;";
  $dpac06="&nbsp;";
  $dpac07="&nbsp;";
  $dpac08="&nbsp;";
  $dpac09="&nbsp;";
  $dpac10="&nbsp;";
  $dpac11="&nbsp;";
  $dpac12="&nbsp;";
}
else{
  $dffetch=mysqli_fetch_array($dfsql);
  $phicacc=$dffetch['phicacc'];
  $phicacc=str_replace("-","",$phicacc);

  $dpac=str_split($phicacc);
  $dpac01=$dpac[0];
  $dpac02=$dpac[1];
  $dpac03=$dpac[2];
  $dpac04=$dpac[3];
  $dpac05=$dpac[4];
  $dpac06=$dpac[5];
  $dpac07=$dpac[6];
  $dpac08=$dpac[7];
  $dpac09=$dpac[8];
  $dpac10=$dpac[9];
  $dpac11=$dpac[10];
  $dpac12=$dpac[11];
}

if($drds[0]!=""){
  $drt="DR. ";

  if($drds[6]>0){
    $copa=number_format($drds[6],2,'.',',');
    $wocop="<img src='Resources/Pictures/Blank.png' height='15' width='auto' />";
    $wcop="<img src='Resources/Pictures/check.png' height='15' width='auto' />";
  }
  else{
    $copa="&nbsp;";
    $wocop="<img src='Resources/Pictures/check.png' height='15' width='auto' />";
    $wcop="<img src='Resources/Pictures/Blank.png' height='15' width='auto' />";
  }
}
else{
  $drt="";

  $copa="&nbsp;";
  $wocop="<img src='Resources/Pictures/Blank.png' height='15' width='auto' />";
  $wcop="<img src='Resources/Pictures/Blank.png' height='15' width='auto' />";
}

echo "
            <tr>
              <td width='50%' class='Tahoma09black' align='center'><table  border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td class='Tahoma09black' align='center'>Accreditation No.:</td>
                  <td><table border='0' cellpadding='0' cellspacing='0'>
                   <tr>
                     <td width='20' height='20'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='10'></td>
                          <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s13 black'>$dpac01</div></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td height='10' class='l1'></td>
                          <td class='l1'></td>
                        </tr>
                      </table></td>
                      <td width='20' height='20'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='10'></td>
                          <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s13 black'>$dpac02</div></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td height='10'></td>
                          <td class='l1'></td>
                        </tr>
                      </table></td>
                      <td width='20' height='20'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='10'></td>
                          <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s13 black'>$dpac03</div></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td height='10'></td>
                          <td class='l1'></td>
                        </tr>
                      </table></td>
                      <td width='20' height='20'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='10'></td>
                          <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s13 black'>$dpac04</div></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td height='10'></td>
                          <td class='l1'></td>
                        </tr>
                      </table></td>
                      <td width='20' height='20'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='10'></td>
                          <td rowspan='2' width='20'><div align='center' class='tahoma s13 black'>-</div></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td height='10'></td>
                          <td></td>
                        </tr>
                      </table></td>
                      <td width='20' height='20'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='10'></td>
                          <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s13 black'>$dpac05</div></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td height='10' class='l1'></td>
                          <td class='l1'></td>
                        </tr>
                      </table></td>
                      <td width='20' height='20'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='10'></td>
                          <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s13 black'>$dpac06</div></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td height='10'></td>
                          <td class='l1'></td>
                        </tr>
                      </table></td>
                      <td width='20' height='20'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='10'></td>
                          <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s13 black'>$dpac07</div></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td height='10'></td>
                          <td class='l1'></td>
                        </tr>
                      </table></td>
                      <td width='20' height='20'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='10'></td>
                          <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s13 black'>$dpac08</div></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td height='10'></td>
                          <td class='l1'></td>
                        </tr>
                      </table></td>
                      <td width='20' height='20'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='10'></td>
                          <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s13 black'>$dpac09</div></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td height='10'></td>
                          <td class='l1'></td>
                        </tr>
                      </table></td>
                      <td width='20' height='20'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='10'></td>
                          <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s13 black'>$dpac10</div></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td height='10'></td>
                          <td class='l1'></td>
                        </tr>
                      </table></td>
                      <td width='20' height='20'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='10'></td>
                          <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s13 black'>$dpac11</div></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td height='10'></td>
                          <td class='l1'></td>
                        </tr>
                      </table></td>
                      <td width='20' height='20'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='10'></td>
                          <td rowspan='2' width='20'><div align='center' class='tahoma s13 black'>-</div></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td height='10'></td>
                          <td></td>
                        </tr>
                      </table></td>
                      <td width='20' height='20'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td height='10'></td>
                          <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s13 black'>$dpac12</div></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td height='10' class='l1'></td>
                          <td class='l1'></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                </tr>

                <tr>
                  <td colspan='2'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td class='Tahoma09black' align='center' height='18'></td>
                    </tr>
                    <tr>
                      <td class='tahoma s10 black bold b1' align='center'>$drt".strtoupper($drds[0])."</td>
                    </tr>
                    <tr>
                      <td class='Tahoma09black' align='center'>Signature Over Printed Name</td>
                    </tr>
                  </table></td>
                </tr>
";

$dcplus=$dcset+1;
$dates=preg_split("/\-/",$retress[1]);
//echo $retress[1];
if($dates[$dcplus]!=""){
  $spldat=str_split($dates[$dcplus]);

  $spldat1=$spldat[0];
  $spldat2=$spldat[1];
  $spldat3=$spldat[2];
  $spldat4=$spldat[3];

  $spldat5=$spldat[4];
  $spldat6=$spldat[5];

  $spldat7=$spldat[6];
  $spldat8=$spldat[7];

  $sety[$dcset]=$spldat1.$spldat2.$spldat3.$spldat4;
  $setm[$dcset]=$spldat5.$spldat6;
  $setd[$dcset]=$spldat7.$spldat8;
}
else{
  $spldat1="&nbsp;";
  $spldat2="&nbsp;";
  $spldat3="&nbsp;";
  $spldat4="&nbsp;";

  $spldat5="&nbsp;";
  $spldat6="&nbsp;";

  $spldat7="&nbsp;";
  $spldat8="&nbsp;";

  $sety[$dcset]="0000";
  $setm[$dcset]="00";
  $setd[$dcset]="00";
}

echo "
                <tr>
                  <td colspan='2' $cursty onclick='openad".$dc."()'><table border='0' cellpadding='0' cellspacing='0' width='100%'>
                    <tr>
                      <td class='Tahoma09black' align='center'><div>Date Signed:</div></td>
                      <td><table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse;'>
                        <tr>
                          <td width='20'><table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse;'>
                            <tr>
                              <td height='5'></td>
                              <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s12 black'>$spldat5</div></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td height='5' class='r1'></td>
                              <td class='l1'></td>
                            </tr>
                          </table></td>
                          <td width='20'  align='center'><table  border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse;'>
                            <tr>
                              <td height='5'></td>
                              <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s12 black'>$spldat6</div></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td height='5'></td>
                              <td class='l1'></td>
                            </tr>
                          </table></td>
                          <td width='20'  align='center'><table  border='0' cellpadding='0' cellspacing='0'>
                            <tr>
                              <td height='5'></td>
                              <td rowspan='2' width='20'><div align='center' class='tahoma s12 black'>-</div></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td height='5'></td>
                              <td></td>
                            </tr>
                          </table></td>
                          <td width='20'><table border='0' cellpadding='0' cellspacing='0'>
                            <tr>
                              <td height='5'></td>
                              <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s12 black'>$spldat7</div></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td height='5' class='r1'></td>
                              <td class='l1'></td>
                            </tr>
                          </table></td>
                          <td width='20'  align='center'><table  border='0' cellpadding='0' cellspacing='0'>
                            <tr>
                              <td height='5'></td>
                              <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s12 black'>$spldat8</div></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td height='5'></td>
                              <td class='l1'></td>
                            </tr>
                          </table></td>
                          <td width='20' align='center'><table border='0' cellpadding='0' cellspacing='0'>
                            <tr>
                              <td height='5'></td>
                              <td rowspan='2' width='20'><div align='center' class='tahoma s12 black'>-</div></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td height='5'></td>
                              <td></td>
                            </tr>
                          </table></td>
                          <td width='20'><table border='0' cellpadding='0' cellspacing='0'>
                            <tr>
                              <td height='5'></td>
                              <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s12 black'>$spldat1</div></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td height='5' class='r1'></td>
                              <td class='l1'></td>
                            </tr>
                          </table></td>
                          <td width='20'  align='center'><table  border='0' cellpadding='0' cellspacing='0'>
                            <tr>
                              <td height='5'></td>
                              <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s12 black'>$spldat2</div></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td height='5'></td>
                              <td class='l1'></td>
                            </tr>
                          </table></td>
                          <td width='20'><table border='0' cellpadding='0' cellspacing='0'>
                            <tr>
                              <td height='5'></td>
                              <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s12 black'>$spldat3</div></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td height='5'></td>
                              <td class='l1'></td>
                            </tr>
                          </table></td>
                          <td width='20'  align='center'><table  border='0' cellpadding='0' cellspacing='0'>
                            <tr>
                              <td height='5'></td>
                              <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s12 black'>$spldat4</div></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td height='5'></td>
                              <td class='l1'></td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td width='20' colspan='2'><table border='0' cellpadding='0' cellspacing='0' width='100%'>
                            <tr>
                              <td width='20' height='10'><div align='center' class='Tahoma08black'>month</div></td>
                            </tr>
                          </table></td>
                          <td width='20'></td>
                          <td width='20' colspan='2'><table border='0' cellpadding='0' cellspacing='0' width='100%'>
                            <tr>
                              <td width='20' height='10'><div align='center' class='Tahoma08black'>day</div></td>
                            </tr>
                          </table></td>
                          <td width='20'></td>
                          <td width='20' colspan='4'><table border='0' cellpadding='0' cellspacing='0' width='100%'>
                            <tr>
                              <td width='20' height='10'><div align='center' class='Tahoma08black'>year</div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                </tr>
              </table></td>


              <td class='Tahoma09black l1' align='left'><table width='100%'>
                <tr>
                  <td><table width='100%' border='0'>
                    <tr>
                      <td class='r1 l1 b1 t1' width='20' height='20' class='Tahoma09black'>$wocop</td>
                      <td class='Tahoma09black'>No co-pay on top of PhilHealth Benefit</td>
                    </tr>
                    <tr>
                      <td class='r1 l1 b1 t1' width='20' height='20' class='Tahoma09black'>$wcop</td>
                      <td class='Tahoma09black'>With co-pay on top of PhilHealth Benefit</td>
                      <td class='Tahoma09black'>P</td>
                      <td class='Tahoma09black b1' width='40%'>&nbsp;$copa</td>
                    </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td class='b1' height='3'></td>
              <td class='b1 l1'></td>
            </tr>
";

?>
