<?php
if(isset($_POST['unit'])){
  $unit=mysqli_real_escape_string($conn,$_POST['unit']);
}
else{
  $unit="LABORATORY";
}

if($unit=="2D ECHO"){$uns1="selected";$uns2="";$uns3="";$uns4="";$uns5="";$uns6="";$uns7="";$uns8="";$uns9="";}
else if($unit=="CT SCAN"){$uns1="";$uns2="selected";$uns3="";$uns4="";$uns5="";$uns6="";$uns7="";$uns8="";$uns9="";}
else if($unit=="ECG"){$uns1="";$uns2="";$uns3="selected";$uns4="";$uns5="";$uns6="";$uns7="";$uns8="";$uns9="";}
else if($unit=="LABORATORY"){$uns1="";$uns2="";$uns3="";$uns4="selected";$uns5="";$uns6="";$uns7="";$uns8="";$uns9="";}
else if($unit=="ULTRASOUND"){$uns1="";$uns2="";$uns3="";$uns4="";$uns5="selected";$uns6="";$uns7="";$uns8="";$uns9="";}
else if($unit=="XRAY"){$uns1="";$uns2="";$uns3="";$uns4="";$uns5="";$uns6="selected";$uns7="";$uns8="";$uns9="";}
else if($unit=="PHYSICAL THERAPY"){$uns1="";$uns2="";$uns3="";$uns4="";$uns5="";$uns6="";$uns7="selected";$uns8="";$uns9="";}
else if($unit=="HEARTSTATION"){$uns1="";$uns2="";$uns3="";$uns4="";$uns5="";$uns6="";$uns7="";$uns8="selected";$uns9="";}
else if($unit=="EEG"){$uns1="";$uns2="";$uns3="";$uns4="";$uns5="";$uns6="";$uns7="";$uns8="";$uns9="selected";}
else{$uns1="";$uns2="";$uns3="";$uns4="selected";$uns5="";$uns6="";$uns7="";$uns8="";$uns9="";}

echo "
                    <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td><div align='center'>
                          <table border='0' cellpadding='0' cellspacing='0'>
                            <tr>
                              <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                                <tr>
                                  <td><div align='left'>
                                    <!-- table border='0' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td>
                                          <form method='post'>
                                            <table border='0' cellpadding='0' cellspacing='0'>
                                              <tr>
                                                <td>
                                                  <select name='unit' class='searchme' style='padding: 5px;height: 32px;border: 2px solid #000000;border-radius: 5px;font-size: 15px;font-weight: bold;'>
                                                    <option $uns1>2D ECHO</option>
                                                    <option $uns2>CT SCAN</option>
                                                    <option $uns3>ECG</option>
                                                    <option $uns4>LABORATORY</option>
                                                    <option $uns5>ULTRASOUND</option>
                                                    <option $uns6>XRAY</option>
                                                    <option $uns7>PHYSICAL THERAPY</option>
                                                    <option $uns8>HEARTSTATION</option>
                                                    <option $uns9>EEG</option>
                                                  </select>
                                                </td>
                                                <td width='5'></td>
                                                <td><button type='submit' class='dpt' title='Change Dept'>&#x21c4;</button></td>
                                              </tr>
                                            </table>
                                          </form>
                                        </td>
";

if($unit=="LABORATORY"){
  if(isset($_POST['lotno'])){
    $lotno=mysqli_real_escape_string($conn,$_POST['lotno']);

    if($lotno=="hematology"){$los1="selected";$los2="";$los3="";$los4="";$los5="";$los6="";}
    else if($lotno=="chemistry"){$los1="";$los2="selected";$los3="";$los4="";$los5="";$los6="";}
    else if($lotno=="serology"){$los1="";$los2="";$los3="selected";$los4="";$los5="";$los6="";}
    else if($lotno=="clinical microscopy"){$los1="";$los2="";$los3="";$los4="selected";$los5="";$los6="";}
    else if($lotno=="parasitology"){$los1="";$los2="";$los3="";$los4="";$los5="selected";$los6="";}
    else if($lotno=="others"){$los1="";$los2="";$los3="";$los4="";$los5="";$los6="selected";}
    else{$los1="";$los2="";$los3="";$los4="";$los5="";$los6="";}
  }
  else{
    $los1="";$los2="";$los3="";$los4="";$los5="";$los6="";
    $lotno="";
  }

echo "
                                        <td width='10'></td>
                                        <td>
                                          <form method='post'>
                                            <table border='0' cellpadding='0' cellspacing='0'>
                                              <tr>
                                                <td>
                                                  <select name='lotno' class='searchme' style='padding: 5px;height: 32px;border: 2px solid #000000;border-radius: 5px;font-size: 15px;font-weight: bold;'>
                                                    <option value=''>ALL</option>
                                                    <option value='hematology' $los1>HEMATOLOGY</option>
                                                    <option value='chemistry' $los2>CHEMISTRY</option>
                                                    <option value='serology' $los3>SEROLOGY</option>
                                                    <option value='clinical microscopy' $los4>CLINICAL MICROSCOPY</option>
                                                    <option value='parasitology' $los5>PARASITOLOGY</option>
                                                    <option value='others' $los6>OTHERS</option>
                                                  </select>
                                                </td>
                                                <td width='5'></td>
                                                <td><button type='submit' class='dpt' title='Change Dept'>&#x21c4;</button></td>
                                              </tr>
                                            </table>
                                            <input type='hidden' name='unit' value='$unit' />
                                          </form>
                                        </td>
";
}

echo "
                                      </tr>
                                    </table -->
                                  </div></td>
                                  <td><div align='right'><button type='button' class='prt' onclick=printDiv('printableArea') title='Print'>	&#128424;</button></div></td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td height='5'></td>
                            </tr>
                            <tr>
                              <td><div align='center' id='printableArea'>
                                <table border='0' cellpadding='0' cellspacing='0'>
                                  <tr>
                                    <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td width='130' valign='middle'><div align='center'><img src='../Resources/Logo/logo.png' width='80' /></div></td>
                                        <td width='auto' valign='middle'><div align='center' style='font-family: arial;color: #000000;'>
                                          <span style='font-size: 16px;font-weight: bold;'>KIDAPAWAN MEDICAL SPECIALISTS CENTER, INC.</span><br />
                                          <span style='font-size: 13px;'>Sudapin, Kidapawan City, Cotabato</span>
                                        </div></td>
                                        <td width='130' valign='middle'></td>
                                      </tr>
                                    </table></td>
                                  </tr>
                                  <tr>
                                    <td><div align='center' style='padding: 10px 0;font-family: arial;color: #000000;'>
                                      <span style='font-size: 15px;font-weight: bold;'>OTHER CHARGES PRICE LIST</span><br />
                                      <span style='font-size: 13pxx'>".date("F d, Y")."</span>
                                    </div></td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                                        <tr>
                                          <td bgcolor='3380ff' width='30' class='t2 b2 l2' rowspan='2'><div align='center' class='arial s12 white bold' style='padding: 2px 3px;'>#</div></td>
                                          <td bgcolor='3380ff' width='auto' class='t2 b2 l1' rowspan='2'><div align='center' class='arial s12 white bold' style='padding: 2px 3px;'>Description</div></td>
                                          <td bgcolor='3380ff' class='t2 b1 l1' colspan='2' height='20'><div align='center' class='arial s12 white bold' style='padding: 2px 3px;'>Prices</div></td>
                                          <td bgcolor='3380ff' width='130' class='t2 b2 l1' rowspan='2'><div align='center' class='arial s12 white bold' style='padding: 2px 3px;'>MDRP</div></td>
                                          <td bgcolor='3380ff' width='auto' class='t2 b2 l1' rowspan='2'><div align='center' class='arial s12 white bold' style='padding: 2px 3px;'>Type</div></td>
                                          <td bgcolor='3380ff' width='auto' class='t2 b2 l1 r2' rowspan='2'><div align='center' class='arial s12 white bold' style='padding: 2px 3px;'>Restrictions</div></td>
                                        </tr>
                                        <tr>
                                          <td bgcolor='3380ff' width='100' class='b2 l1' height='20'><div align='center' class='arial s11 white bold' style='padding: 2px 3px;'>Cash Price</div></td>
                                          <td bgcolor='3380ff' width='100' class='b2 l1' height='20'><div align='center' class='arial s11 white bold' style='padding: 2px 3px;'>Charge Price</div></td>
                                        </tr>
";

    $zx=0;
    $colsp=6;
    $zxsql=mysqli_query($conn,"SELECT * FROM `receiving` WHERE `unit` NOT LIKE '%medicine%' AND `unit` NOT LIKE '%PHARMACY%' AND `unit` NOT LIKE '%ACCOUNTABLE%' AND `unit` NOT LIKE '%-SUPPLIES%' AND `unit` NOT LIKE '%LABORATORY SUPPLIES%' AND `unit` NOT LIKE 'GENERAL SUPPLIES' AND `unit` NOT LIKE '%CSR/KIT%' AND `unit` NOT LIKE 'RADIOLOGY SUPPLIES' AND `unit` NOT LIKE 'RESPIRATORY SUPPLIES' AND `unit` NOT LIKE 'STERILIZATION SUPPLIES' AND `unit` NOT LIKE 'ULTRASOUND SUPPLIES' AND `unit` NOT LIKE 'PT SUPPLIES' AND `unit` NOT LIKE 'PLUMBING' AND `unit` NOT LIKE '%OFFICE%%SUPPLIES%' AND `unit` NOT LIKE '%Nonmedical Supplies%' AND `unit` NOT LIKE 'HEART STATION SUPPLIES' AND `unit` NOT LIKE 'LAUNDRY SUPPLIES' AND `unit` NOT LIKE 'ELECTRICAL SUPPLIES' AND `unit` NOT LIKE 'CT SCAN SUPPLIES' AND `unit` NOT LIKE 'Housekeeping Supplies' AND `unit` NOT LIKE 'Equipment' AND `unit` NOT LIKE 'COMPUTER EQUIPMENT AND ACCESS' AND `unit` NOT LIKE 'HOSPITAL EQUIPMENT' AND `unit` NOT LIKE 'COMPUTER SUPPLIES' AND `unit` NOT LIKE 'LAUNDRY' AND `unit` NOT LIKE 'CENTRAL SUPPLIES' AND `unit` NOT LIKE '%MEDICAL SURGICAL SUPPLIES%' AND `unit` NOT LIKE 'MISCELLANEOUS SUPPLIES' AND `unit` NOT LIKE 'HOSPITAL CSR KIT' AND `unit` NOT LIKE 'ECG SUPPLIES' AND `unit` NOT LIKE '%ECG SUPPLIES%' AND `unit` NOT LIKE '%DIALYSIS%' AND `unit` NOT LIKE 'NEWBORN SCREENING SUPPLIES' AND `unit` NOT LIKE 'OTHERS' AND `unit` NOT LIKE '2D ECHO' AND `unit` NOT LIKE 'CT SCAN' AND `unit` NOT LIKE 'ECG' AND `unit` NOT LIKE 'LABORATORY' AND `unit` NOT LIKE 'ULTRASOUND' AND `unit` NOT LIKE 'XRAY' AND `unit` NOT LIKE 'PHYSICAL THERAPY' AND `unit` NOT LIKE 'HEARTSTATION' AND `unit` NOT LIKE 'EEG' AND `unit` NOT LIKE '%MEDICAL SUPPLIES%' AND `unit` NOT LIKE '' ORDER BY `itemname`");
    while($zxfetch=mysqli_fetch_array($zxsql)){
      $cod=$zxfetch['code'];
      $itd=mb_strtoupper(trim($zxfetch['description']));
      $unt=$zxfetch['unit'];
      $itn=$zxfetch['itemname'];
      $lot=$zxfetch['lotno'];
      $pnf=$zxfetch['pnf'];
      $tes=$zxfetch['testcode'];
      $gte=$zxfetch['gtestcode'];
      $op4=$zxfetch['optset4'];
      $lot=$zxfetch['lotno'];
      $zx++;

      $dis="";

      $itd=str_replace("AMS-","",$itd);
      $itd=str_replace("-MED","",$itd);
      $itd=str_replace("-sup","",$itd);
      $itd=str_replace("-SUP","",$itd);

      if($tes=="0"){$tesdis="NON-MDRP";}else{$tesdis="MDRP";}

      $testcat="";
      if($unt=="LABORATORY"){
        if(($lot=="hematology")||($lot=="chemistry")||($lot=="serology")||($lot=="clinical microscopy")||($lot=="parasitology")){
          $testcat=mb_strtoupper($lot);
        }
      }

      if(stripos($op4, "-1|") !== FALSE){$dis=$dis."PHARMACY |";}//disable pharmacy only
      if(stripos($op4, "-2|") !== FALSE){$dis=$dis."OPD PHARMACY |";}//disable pharmacy opd only
      if(stripos($op4, "-3|") !== FALSE){$dis=$dis."CSR2 |";}//disable csr2 only
      if(stripos($op4, "-4|") !== FALSE){$dis=$dis."BILLING |";}//disable billing only
      if(stripos($op4, "-5|") !== FALSE){$dis=$dis."NS1 |";;}//disable ns1 only
      if(stripos($op4, "-6|") !== FALSE){$dis=$dis."NS2 |";}//disable ns2 only
      if(stripos($op4, "-7|") !== FALSE){$dis=$dis."NS3 |";}//disable ns3 only
      if(stripos($op4, "-8|") !== FALSE){$dis=$dis."NS4 |";}//disable ns4 only
      if(stripos($op4, "-9|") !== FALSE){$dis=$dis."NS5A |";}//disable ns5a only
      if(stripos($op4, "-10|") !== FALSE){$dis=$dis."NS5B |";}//disable nsb only
      if(stripos($op4, "-11|") !== FALSE){$dis=$dis."NS6 |";}//disable ns6 only
      if(stripos($op4, "-12|") !== FALSE){$dis=$dis."ER |";}//disable er only

      if(stripos($op4, "-99|") !== FALSE){$dis=$dis."OPD Only |";}//disable in patient only
      if(stripos($op4, "-100|") !== FALSE){$dis=$dis."IPD Only |";}//disable out patient only

      $cashonly=1;
      $chargeonly=1;
      if(stripos($op4, "-101|") !== FALSE){$dis=$dis."Cash Only |";}//disable charge and tpl button for in patient
      if(stripos($op4, "-102|") !== FALSE){$dis=$dis."Charge Only |";}//disable cash button for in patient

      $cash=0;
      $charge=0;

      $prmsql=mysqli_query($conn,"SELECT `philhealth`, `nonmed`, `opd`, `lotno` FROM `productsmasterlist` WHERE `code`='$cod'");
      if(mysqli_num_rows($prmsql)>0){
        $prmfetch=mysqli_fetch_array($prmsql);
        $charge=$prmfetch['philhealth'];
        $cash=$prmfetch['opd'];
      }

echo "
                                        <tr>
                                          <td class='b1 l2'><div align='left' style='font-family: arial;font-size; 13px;color: #000000;padding: 2px 4px;'>$zx</div></td>
                                          <td class='b1 l1'><div align='left' style='font-family: arial;font-size; 13px;color: #000000;padding: 2px 4px;'>$itd</div></td>
                                          <td class='b1 l1'><div align='right' style='font-family: arial;font-size; 13px;color: #000000;padding: 2px 4px;'>".number_format($cash,2,".",",")."</div></td>
                                          <td class='b1 l1'><div align='right' style='font-family: arial;font-size; 13px;color: #000000;padding: 2px 4px;'>".number_format($charge,2,".",",")."</div></td>
                                          <td class='b1 l1'><div align='center' style='font-family: arial;font-size; 13px;color: #000000;padding: 2px 4px;'>$tesdis</div></td>
                                          <td class='b1 l1'><div align='center' style='font-family: arial;font-size; 13px;color: #000000;padding: 2px 4px;'>$unt</div></td>
                                          <td class='b1 l1 r2'><div align='center' style='font-family: arial;font-size; 9px;color: #000000;padding: 2px 4px;'>$dis</div></td>
                                        </tr>
";
    }

echo "
                                        <tr>
                                          <td class='t1' colspan='7'></td>
                                        </tr>
                                      </table>
                                    </td>
                                  </tr>
                                </table>
                              </div></td>
                            </tr>
                          </table>
                        </table></td>
                      </tr>
                    </table>
";
?>
<script type="text/javascript">
  function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
  }
</script>
