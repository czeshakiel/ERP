<?php
echo "
<table width='730' border='0' cellpadding='0' cellspacing='0'>
";

//Start 1st Row
echo "
  <tr>
    <td class='t3 b3 r3 l3'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td height='5'></td>
      </tr>
      <tr>
        <td><div align='left' class='Tahoma09blackbold'>&nbsp; 10: Accreditation Number/Name of Accredited Health Care Professional/Date Signed and Professional Fees/Charges</div></td>
      </tr>
      <tr>
        <td><div align='left' class='Tahoma09black'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (Use additional CF2 if necessary):</div></td>
      </tr>
      <tr>
        <td height='5'></div></td>
      </tr>
      <tr>
        <td class='t1'><table width='100%' border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse;'>
          <tr>
            <td height='15' width='50%' class='Tahoma09black b1' align='center'>Accreditation number/Name of Accredited Health Care Professional/Date Signed</td>
            <td class='Tahoma09black l1 b1' align='center'>Details</td>
          </tr>
";

//Doctor-------------------------------
$pd=date("Ymd");

$filn=$caseno."_".$num;
if (!file_exists("Files/$filn.txt")) {
$wr="1";
}
else{
$wr="0";
}

if($wr=="1"){
$res= fopen("Files/$filn.txt", "w") or die("Unable to open file!");
}

$datset="";
for($dc=$qstart;$dc<=$qend;$dc++){
if(!empty($pdrs[$dc])){
  $drd=$pdrs[$dc];
  $log=$drd."|";
  if($wr=="1"){
   fwrite($res, $log);
  }

  $datset=$datset."-".$pd;
}
else{
  $drd="<-><-><-><-><-><-><->|";
  $log=$drd;
  if($wr=="1"){
    fwrite($res, $log);
  }

  $datset=$datset."-";
}

if($num==1){
  $dcset=$dc;
}
else{
  $dcset=$dc-($num+1);
}

include("cf2_back-doctor.php");
}

if($wr=="1"){

$hcir=fopen("HCIRep.txt", "r") or die("Unable to open file!");
$hcirres=trim(fgets($hcir));
fclose($hcir);
$hcirs=preg_split("/\|/",$hcirres);

$hcird=fopen("HCIRepDesignation.txt", "r") or die("Unable to open file!");
$hcirdres=trim(fgets($hcird));
fclose($hcird);
$hcirds=preg_split("/\|/",$hcirdres);

$datw="*".$datset."*|$pd||||||||||||*".$hcirs[0]."|".$hcirds[0]."|$pd|*";
fwrite($res, $datw);
fclose($res);
}
//End Doctor---------------------------


echo "
        </table></td>
      </tr>
";



echo "
      <tr>
        <td colspan='3' height='25' class='table1Top1Bottom1Left1Right' bgcolor='#000000'><table width='100%' border='0' style='border-collapse: collapse;'>
          <tr valign='bottom'>
            <td><div align='center' class='arial12whitebold'>PART III. CERTIFICATION OF CONSUMPTION OF BENEFITS AND CONSENT TO ACCESS PATIENT RECORD/S</div></td>
          </tr>
          <tr valign='top'>
            <td align='center' class='arial10white'>NOTE: Member/Patient should sign only after the applicable charges have been filled-out</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <td height='5'></td>
          </tr>
          <tr>
            <td><div align='left' class='Tahoma10blackbold'>&nbsp;&nbsp;A. CERTIFICATION OF CONSUMPTION OF BENEFITS:</div></td>
          </tr>
          <tr>
            <td height='5'></td>
          </tr>
          <tr>
            <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
              <tr>
                <td width='10'></td>
                <td class='r1 l1 b1 t1' width='20' height='10'><div align='center' class='Tahoma12blackbold'>$certcon1</div></td>
                <td width='5'></td>
                <td class='Tahoma09black' valign='top'>Philhealth benefit is enough to cover the HCI and PF Charges </br> No purchase of drugs/medicines, supplies, diagnostics, and co-pay of professional fees by the member/patient</td>
                <td width='15'></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><table border='1' width='100%' style='border-collapse: collapse;'>
                  <tr>
                    <td width='50%'>&nbsp;</td>
                    <td class='Tahoma09black' align='center'>Total Actual Charges*</td>
                  </tr>
                  <tr>
                    <td class='Tahoma09black'>Total Health Care Institution Fees</td>
                    <td class='Tahoma09black' align='left'>&nbsp;$TotalHealthCareInstitutionFees</td>
                  </tr>
                  <tr>
                    <td class='Tahoma09black'>Total Professional Fees</td>
                    <td class='Tahoma09black' align='left'>&nbsp;$TotalProfessionalFees</td>
                  </tr>
                  <tr>
                    <td class='Tahoma09black'>Grand Total</td>
                    <td class='Tahoma09black' align='left'>&nbsp;$GrandTotal</td>
                  </tr>
                </table></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td class='r1 l1 b1 t1' width='20' height='10'><div align='center' class='Tahoma12blackbold'>$certcon2</div></td>
                <td></td>
                <td class='Tahoma09black' valign='top'>The benefit of the member/patient was completely consumed prior to co-pay OR the benefit of the member/patient is not completely consumed BUT with purchases/expenses for drugs/medicine, supplies and others.</td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class='Tahoma09black' valign='top'>a.) The total co-pay for the following are:</td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td height='50' class='t2 l2 b1'></td>
                    <td class='Tahoma09black t2 l1 b1' align='center'>Total Actual Charges*</td>
                    <td class='Tahoma09black t2 l1 b1' align='center'>Amount after Application<br />of Discount (i.e. personal<br />discount, Senior Citizen/PWD)</td>
                    <td class='Tahoma09black t2 l1 b1' align='center'>Philhealth Benefit</td>
                    <td class='Tahoma09black t2 l1 b1 r2' align='center'>Amount after Philhealth Deduction</td>
                  </tr>
                  <tr>
                    <td class='Tahoma09black l2 b1' height='80'>&nbsp;Total Health Care<br />&nbsp;Institution Fees</td>
                    <td class='Tahoma09black l1 b1' align='center'>$hospactual</td>
                    <td class='Tahoma09black l1 b1' align='center'>$hosplessdisc</td>
                    <td class='Tahoma09black l1 b1' align='center'>$hospphicben</td>
                    <td class='l1 b1 r2'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td width='5'></td>
                            <td class='Tahoma09black' width='50'>Amount P</td>
                            <td class='Tahoma09black b1'><div align='left'>$hospnet</div></td>
                            <td width='5'></td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td width='5'></td>
                            <td class='Tahoma09black' >Paid by (check all that applies):</td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td width='5'></td>
                            <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='r1 l1 b1 t1' width='15' height='15' class='tahoma s8 black'><div align='center'>$hospmempat</div></td>
                                <td class='Tahoma09black'>&nbsp;Member/Patient</td>
                              </tr>
                            </table></td>
                            <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='r1 l1 b1 t1' width='15' height='15' class='Tahoma09black'></td>
                                <td class='Tahoma09black'>&nbsp;HMO</td>
                              </tr>
                            </table></td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td height='2'></td>
                      </tr>
                      <tr>
                        <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td width='5'></td>
                            <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='r1 l1 b1 t1' width='15' height='15' class='Tahoma09black'></td>
                                <td class='Tahoma09black'>&nbsp;Others(i.e., PCSO, Promisory note, etc.)</td>
                              </tr>
                            </table></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td class='Tahoma09black b2 l2' height='80'>&nbsp;Total Professional<br />&nbsp;Fees (for accredited<br />&nbsp;and non-accredited<br />&nbsp;professionals)</td>
                    <td class='Tahoma09black b2 l1' align='center'>$profactual</td>
                    <td class='Tahoma09black b2 l1' align='center'>$proflessdisc</td>
                    <td class='Tahoma09black b2 l1' align='center'>$profphicben</td>
                    <td class=' b2 l1 r2'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td width='5'></td>
                            <td class='Tahoma09black' width='50'>Amount P</td>
                            <td class='Tahoma09black b1'><div align='left'>$profnet</div></td>
                            <td width='5'></td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td width='5'></td>
                            <td class='Tahoma09black' >Paid by (check all that applies):</td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td width='5'></td>
                            <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='r1 l1 b1 t1' width='15' height='15' class='tahoma s7 black'><div align='center'>$profmempat</div></td>
                                <td class='Tahoma09black'>&nbsp;Member/Patient</td>
                              </tr>
                            </table></td>
                            <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='r1 l1 b1 t1' width='15' height='15' class='Tahoma09black'></td>
                                <td class='Tahoma09black'>&nbsp;HMO</td>
                              </tr>
                            </table></td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td height='2'></td>
                      </tr>
                      <tr>
                        <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td width='5'></td>
                            <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='r1 l1 b1 t1' width='15' height='15' class='tahoma s7 black'><div align='center'>$profoth</div></td>
                                <td class='Tahoma09black'>&nbsp;Others(i.e., PCSO, Promisory note, etc.)</td>
                              </tr>
                            </table></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>

                </table></td>
              </tr>
              <tr>
                <td colspan='5' height='3'></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class='Tahoma09black' valign='top'>b.) Purchases/Expenses <b>NOT</b> included in the Health Care Institution Charges</td>
                <td></td>
              </tr>
              <tr>
                <td colspan='5' height='3'></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><table border='2' width='100%' style='border-collapse: collapse;'>
                  <tr>
                    <td class='Tahoma09black' width='60%' height='35'>&nbsp;Total cost of  purchase/s for drugs/medicines  and/or medical supplies bought by the</br>&nbsp;patient/memeber withnin/outside the HCI during confinement</td>
                    <td class='Tahoma09black' align='center'><table width='100%' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td class='Tahoma09black'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td width='5'></td>
                                <td class='r1 l1 b1 t1' width='15' height='15' class='Tahoma09black'><div align='center'>$purchase1</div></td>
                                <td class='Tahoma09black'>&nbsp;None</td>
                              </tr>
                            </table></td>
                            <td class='Tahoma09black' align='right'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td width='5'></td>
                                <td class='r1 l1 b1 t1' width='15' height='15' class='Tahoma09black' ></td>
                                <td class='Tahoma09black'>&nbsp;Total Amount P</td>
                              </tr>
                            </table></td>
                            <td class='Tahoma09black b1' width='40%' align='left'></td>
                            <td width='10'></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td class='Tahoma09black' height='35'>&nbsp;Total cost of diagnostic/laboratory examinations paid by the patient/member done</br>&nbsp;within/outside the HCI during confinement</td>
                    <td class='Tahoma09black' align='center'><table width='100%' width='100%' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td class='Tahoma09black'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td width='5'></td>
                                <td class='r1 l1 b1 t1' width='15' height='15' class='Tahoma09black'><div align='center'>$purchase2</div></td>
                                <td class='Tahoma09black'>&nbsp;None</td>
                              </tr>
                            </table></td>
                            <td class='Tahoma09black' align='right'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td width='5'></td>
                                <td class='r1 l1 b1 t1' width='15' height='15' class='Tahoma09black' ></td>
                                <td class='Tahoma09black'>&nbsp;Total Amount P</td>
                              </tr>
                            </table></td>
                            <td class='Tahoma09black b1' width='40%' align='left'></td>
                            <td width='10'></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class='Tahoma09black' valign='top'>&nbsp; &nbsp; &nbsp; <b> *NOTE: </b> Total Actual Charges should be based on the Statement of Account (SOA)</td>
                <td></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height='5'></td>
          </tr>
          <tr>
            <td><div align='left' class='Tahoma10blackbold'>&nbsp;&nbsp;B. CONSENT TO ACCESS PATIENT RECORD/S:</div></td>
          </tr>
          <tr>
            <td height='5'></td>
          </tr>
";

$rep=preg_split("/\|/",$retress[2]);

if($rep[1]!=""){
$dtrep=str_split($rep[1]);

$dtrep1=$dtrep[0];
$dtrep2=$dtrep[1];
$dtrep3=$dtrep[2];
$dtrep4=$dtrep[3];

$dtrep5=$dtrep[4];
$dtrep6=$dtrep[5];

$dtrep7=$dtrep[6];
$dtrep8=$dtrep[7];

$dtrepy=$dtrep1.$dtrep2.$dtrep3.$dtrep4;
$dtrepm=$dtrep5.$dtrep6;
$dtrepd=$dtrep7.$dtrep8;
}
else{
$dtrep1="";
$dtrep2="";
$dtrep3="";
$dtrep4="";

$dtrep5="";
$dtrep6="";

$dtrep7="";
$dtrep8="";

$dtrepy="0000";
$dtrepm="00";
$dtrepd="00";
}

echo "
          <tr>
            <td><table border='0' cellpadding='0' cellspacing='0'>
              <tr>
                <td class='Tahoma08blackbold' valign='top'>&nbsp;&nbsp;&nbsp;
                  I hereby consent to the submission and examination of the patient's pertinent medical records for the purpose of verifying the veracity of this claim to effect </br>
                  &nbsp;&nbsp;&nbsp;
                  efficient processing of benefit payment.</br>
                  &nbsp;&nbsp;&nbsp;
                  I hereby hold PhilHealth or any of its officers, employee and/or representatives free from any and all legal liabilities relative to the herein-mentioned consent </br>
                  &nbsp;&nbsp;&nbsp;
                  which I have voluntarily and willingly given in connection with this claim for reimbursement before PhilHealth.
                </td>
              </tr>
            </table></td>
          </tr>
          <tr>
          <td $cursty onclick='openconsent()'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='10'></td>
              <td class='Tahoma09black' align='center' height='20'></td>
            </tr>
            <tr>
              <td></td>
              <td class='tahoma s10 black bold b1' align='center'><div>".strtoupper($rep[0])."</div></td>
            </tr>
            <tr>
              <td></td>
              <td class='Tahoma09black' align='center'>Signature Over Printed Name of Member/Patient/Authorized Representative</td>
            </tr>
          </table></td>
        </tr>

        <tr>
          <td><table border='0' cellpadding='0' cellspacing='0' width='100%'>
            <tr>
              <td width='55%'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td $cursty onclick='openconsent()'><table border='0'cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='27'></td>
                      <td class='Tahoma09black' align='center' ><div>Date Signed:</div></td>
                      <td><table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse;'>
                        <tr>
                          <td width='20'><table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse;'>
                            <tr>
                              <td height='5'></td>
                              <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s12 black'>$dtrep5</div></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td height='5' class='r1'></td>
                              <td class='l1'></td>
                            </tr>
                          </table></td>
                          <td width='20' align='center'><table  border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse;'>
                            <tr>
                              <td height='5'></td>
                              <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s12 black'>$dtrep6</div></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td height='5'></td>
                              <td class='l1'></td>
                            </tr>
                          </table></td>
                          <td width='20' align='center'><table  border='0' cellpadding='0' cellspacing='0'>
                            <tr>
                              <td height='5'></td>
                              <td rowspan='2' width='20'><div align='center' class='tahoma s12 black'>-</div></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td height='5'></td>
                              <td ></td>
                            </tr>
                          </table></td>
                          <td width='20'><table  border='0' cellpadding='0' cellspacing='0'>
                            <tr>
                              <td height='5'></td>
                              <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s12 black'>$dtrep7</div></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td height='5' class='r1'></td>
                              <td class='l1'></td>
                            </tr>
                          </table></td>
                          <td width='20' align='center'><table  border='0' cellpadding='0' cellspacing='0'>
                            <tr>
                              <td height='5'></td>
                              <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s12 black'>$dtrep8</div></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td height='5'></td>
                              <td class='l1'></td>
                            </tr>
                          </table></td>
                          <td width='20' align='center'><table  border='0' cellpadding='0' cellspacing='0'>
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
                              <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s12 black'>$dtrep1</div></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td height='5' class='r1'></td>
                              <td class='l1'></td>
                            </tr>
                          </table></td>
                          <td width='20' align='center'><table  border='0' cellpadding='0' cellspacing='0'>
                            <tr>
                              <td height='5'></td>
                              <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s12 black'>$dtrep2</div></td>
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
                              <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s12 black'>$dtrep3</div></td>
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
                              <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s12 black'>$dtrep4</div></td>
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
                              <td  width='20' height='10'><div align='center' class='Tahoma08black'>month</div></td>
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
                              <td  width='20' height='10'><div align='center' class='Tahoma08black'>year</div></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>

                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td height='5'></td>
                </tr>
                <tr>
                  <td><div $cursty onclick='openconsent()'><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='10'></td>
                      <td><table border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td class='Tahoma09black'>Relationship of the representative to </br> the member/patient:</td>
                        </tr>
                      </table></td>
                      <td width='5'></td>
                      <td><table border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td><table border='0' cellpadding='0' cellspacing='0'>
                            <tr>
                              <td class='r1 l1 b1 t1' width='15' height='15' class='Tahoma09black'><div align='center'>".$rep[2]."</div></td>
                              <td class='Tahoma09black'>&nbsp;Spouse</td>
                            </tr>
                          </table></td>
                          <td><table border='0' cellpadding='0' cellspacing='0'>
                            <tr>
                              <td class='r1 l1 b1 t1' width='15' height='15' class='Tahoma09black'><div align='center'>".$rep[3]."</div></td>
                              <td class='Tahoma09black'>&nbsp;Child</td>
                            </tr>
                          </table></td>
                          <td><table border='0' cellpadding='0' cellspacing='0'>
                            <tr>
                              <td class='r1 l1 b1 t1' width='15' height='15' class='Tahoma09black'><div align='center'>".$rep[4]."</div></td>
                              <td class='Tahoma09black'>&nbsp;Parent</td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td colspan='3' height='2'></td>
                        </tr>
                        <tr>
                          <td><table border='0' cellpadding='0' cellspacing='0'>
                            <tr>
                              <td class='r1 l1 b1 t1' width='15' height='15' class='Tahoma09black'><div align='center'>".$rep[5]."</div></td>
                              <td class='Tahoma09black'>&nbsp;Sibling</td>
                            </tr>
                          </table></td>
                          <td><table border='0' cellpadding='0' cellspacing='0'>
                            <tr>
                              <td class='r1 l1 b1 t1' width='15' height='15' class='Tahoma09black'><div align='center'>".$rep[6]."</div></td>
                              <td class='Tahoma09black'>&nbsp;Others, Specify</td>
                            </tr>
                          </table></td>
                          <td><table border='0' cellpadding='0' cellspacing='0'>
                            <tr>
                              <td class='Tahoma09black b1'>".$rep[11]."</td>
                            </tr>
                          </table></td>
                        </tr>

                      </table></td>
                    </tr>

                    <tr>
                      <td colspan='4' height='3'></td>
                    </tr>

                    <tr>
                      <td></td>
                      <td><table border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td class='Tahoma09black'>Relationship for signing on behalf of </br> the  member/patient:</td>
                        </tr>
                      </table></td>
                      <td width='5'></td>
                      <td><table border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td><table border='0' cellpadding='0' cellspacing='0'>
                            <tr>
                              <td class='r1 l1 b1 t1' width='15' height='15' class='Tahoma09black'><div align='center'>".$rep[7]."</div></td>
                              <td class='Tahoma09black'>&nbsp;Patient is Incapacitated</td>
                            </tr>
                          </table></td>
                          <td><table border='0' cellpadding='0' cellspacing='0'>
                            <tr>
                              <td class='Tahoma09black'></td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td colspan='2' height='2'></td>
                        </tr>
                        <tr>
                          <td><table border='0' cellpadding='0' cellspacing='0'>
                            <tr>
                              <td class='r1 l1 b1 t1' width='15' height='15' class='Tahoma09black'><div align='center'>".$rep[8]."</div></td>
                              <td class='Tahoma09black'>&nbsp;Other Reasons</td>
                            </tr>
                          </table></td>
                          <td><table border='0' cellpadding='0' cellspacing='0'>
                            <tr>
                              <td class='Tahoma09black b1'>".$rep[12]."</td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>

                  </table></div></td>
                </tr>
              </table></td>
              <td width='20%'><div $cursty onclick='openconsent()'><table border='0' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td class='Tahoma09black'>
                      If the patient/representative </br>
                      is unable to write, put</br>
                      right thumbmark. Patient/<br>
                      Representative should be </br>
                      assisted by an HCI representative.
                    </td>
                  </tr>
                  <tr>
                    <td height='10'></td>
                  </tr>
                  <tr>
                    <td><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td class='r1 l1 b1 t1' width='15' height='15' class='Tahoma09black'><div align='center'>".$rep[9]."</div></td>
                        <td class='Tahoma09black'>&nbsp;Patient</td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height='2'></td>
                  </tr>
                  <tr>
                    <td><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td class='r1 l1 b1 t1' width='15' height='15' class='Tahoma09black'><div align='center'>".$rep[10]."</div></td>
                        <td class='Tahoma09black'>&nbsp;Representative</td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
                <td align='center'><table border='0' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td class='r2 l2 b2 t2' width='100' height='100' class='Tahoma09black'></td>
                  </tr>
                  <tr>
                    <td height='3'></td>
                  </tr>
                </table></td>
              </tr>
            </table></div></td>
          </tr>
        </table></td>
      </tr>
";

$hcirep=preg_split("/\|/",$retress[3]);

if($hcirep[2]!=""){
$hciredt=str_split($hcirep[2]);

$hciredt1=$hciredt[0];
$hciredt2=$hciredt[1];
$hciredt3=$hciredt[2];
$hciredt4=$hciredt[3];

$hciredt5=$hciredt[4];
$hciredt6=$hciredt[5];

$hciredt7=$hciredt[6];
$hciredt8=$hciredt[7];

$hcirepdty=$hciredt1.$hciredt2.$hciredt3.$hciredt4;
$hcirepdtm=$hciredt5.$hciredt6;
$hcirepdtd=$hciredt7.$hciredt8;
}
else{
$hciredt1="";
$hciredt2="";
$hciredt3="";
$hciredt4="";

$hciredt5="";
$hciredt6="";

$hciredt7="";
$hciredt8="";

$hcirepdty="0000";
$hcirepdtm="00";
$hcirepdtd="00";
}

echo "
      <tr>
        <td colspan='3' height='25' class='table1Top1Bottom1Left1Right' bgcolor='#000000'><table width='100%'>
          <tr>
            <td valign='bottom'><div align='center' class='arial12whitebold'>PART IV. CERTIFICATION OF CONSUMPTION OF HEALTH CARE INSTITUTION</div></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <td height='5'></td>
          </tr>
          <tr>
            <td><div align='left' class='Tahoma08blackbold'><i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I certify that services rendered were recorded in the patient's chart and health care institution records and that the therein given are true and correct.</i></div></td>
          </tr>
          <tr>
            <td><table border=0' width='100%' cellpadding='0' cellspacing='0'>
              <tr>
                <td width='10'></td>
                <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td class='Tahoma09black' align='center' height='20'></td>
                  </tr>
                  <tr>
                    <td class='tahoma s10 black bold b1' align='center'>".strtoupper($hcirep[0])."</td>
                  </tr>
                  <tr>
                    <td class='Tahoma09black' align='center'>Signature Over Printed Name of Authorized HCI Representative</td>
                  </tr>
                </table></td>
                <td width='5'></td>
                <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td class='Tahoma09black' align='center' height='20'></td>
                  </tr>
                  <tr>
                    <td class='tahoma s10 black bold b1' align='center'>".strtoupper($hcirep[1])."</td>
                  </tr>
                  <tr>
                    <td class='Tahoma09black' align='center'>Office Capacity/Designation</td>
                  </tr>
                </table></td>
                <td valign='bottom'><div $cursty onclick='openhci()'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td><table border='0' cellpadding='0' cellspacing='0' width='100%'>
                      <tr>
                        <td class='Tahoma09black' align='center' >Date Signed:</td>
                        <td><table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td width='20' height='20' ><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='10'></td>
                                <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s13 black'>$hciredt5</div></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td height='10' class='r1'></td>
                                <td class='l1'></td>
                              </tr>
                            </table></td>
                            <td width='20' height='20'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='10'></td>
                                <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s13 black'>$hciredt6</div></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td height='10'></td>
                                <td class='l1'></td>
                              </tr>
                            </table></td>
                          </tr>
                        </table></td>
                        <td><table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td width='20' height='20' ><table width='100%' border='0' cellpadding='0' cellspacing='0'>
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
                          </tr>
                        </table></td>
                        <td><table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td width='20' height='20'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='10'></td>
                                <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s13 black'>$hciredt7</div></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td height='10' class='r1'></td>
                                <td class='l1'></td>
                              </tr>
                            </table></td>
                            <td width='20' height='20'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='10'></td>
                                <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s13 black'>$hciredt8</div></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td height='10'></td>
                                <td class='l1'></td>
                              </tr>
                            </table></td>
                          </tr>
                        </table></td>
                        <td><table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
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
                          </tr>
                        </table></td>
                        <td><table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td width='20' height='20' ><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='10'></td>
                                <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s13 black'>$hciredt1</div></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td height='10' class='r1'></td>
                                <td></td>
                              </tr>
                            </table></td>
                            <td width='20' height='20'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='10'></td>
                                <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s13 black'>$hciredt2</div></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td height='10' class='r1'></td>
                                <td ></td>
                              </tr>
                            </table></td>
                            <td width='20' height='20' ><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='10'></td>
                                <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s13 black'>$hciredt3</div></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td height='10' class='r1'></td>
                                <td></td>
                              </tr>
                            </table></td>
                            <td width='20' height='20' ><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='10'></td>
                                <td class='b1' rowspan='2' width='20'><div align='center' class='tahoma s13 black'>$hciredt4</div></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td height='10' class='r1'></td>
                                <td class='l1'></td>
                              </tr>
                            </table></td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr valign='top'>
                        <td><div align='center' class='Tahoma09black'></div></td>
                        <td><div align='center' class='Tahoma09black'>month</div></td>
                        <td><div align='center' class='Tahoma09black'></div></td>
                        <td><div align='center' class='Tahoma09black'>day</div></td>
                        <td><div align='center' class='Tahoma09black'></div></td>
                        <td><div align='center' class='Tahoma09black'>year</div></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></div></td>
              </tr>
              <tr>
                <td colspan='5' height='15'></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
";
?>
