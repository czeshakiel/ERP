<?php
echo "
    <!-- PART III - CONSENT TO ACCESS PATIENT RECORD/S -->
    <table width='750' border='0' cellpadding='0' cellspacing='0'>
      <tbody>
        <tr>
          <th scope='col' style='border-bottom: 2px solid black;border-top: 2px solid black;' class='tahoma s12 bold' height='26' align='center' valign='middle'>PART III - CONSENT TO ACCESS PATIENT RECORD/S</th>
        </tr>
        <tr>
          <td height='3'></td>
        </tr>
        <tr>
          <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='7'></td>
              <td width='auto'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='20'></td>
                  <td valign='top'><div align='justify' class='tahoma s8 black bold'><i>I hereby consent to the submission and examination of the patient's pertinent medical records for the purpose of verifying the veracity of this claim to effect efficient processing of benefit payment.</i></div></td>
                </tr>
                <tr>
                  <td width='20'></td>
                  <td valign='top'><div align='justify' class='tahoma s8 black bold'><i>I hereby hold PhilHealth or any of its officers, employees and/or representatives free from any legal liabilities relative to the herein-mention consent which I have voluntarily and willingly given in connection with this claim for reimbursement before PhilHealth.</i></div></td>
                </tr>
              </table></td>
              <td width='7'></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height='3'></td>
        </tr>
        <tr>
          <td $cursty onclick='myFunction7()'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='7'></td>
              <td width='auto'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='50'>&nbsp;</td>
                  <td class='bottomboxborder' align='center' valign='bottom'>$consentaccname</td>
                  <td width='50'>&nbsp;</td>
                  <td rowspan='2' width='260'><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
                    <!-- tr>
                      <td class='tahoma s8 black'>Date Signed&nbsp;</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$consentaccsiarr0</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$consentaccsiarr1</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$consentaccsiarr3</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$consentaccsiarr4</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$consentaccsiarr6</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$consentaccsiarr7</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$consentaccsiarr6</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$consentaccsiarr9</div></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td colspan='2' valign='top' align='center' class='tahoma s8 black'>month</td>
                      <td></td>
                      <td colspan='2' valign='top' align='center' class='tahoma s8 black'>day</td>
                      <td></td>
                      <td colspan='4' valign='top' align='center' class='tahoma s8 black1'>year</td>
                    </tr -->
                    <tr>
                      <td class='tahoma s8 black'>Date Signed&nbsp;</td>
                      <td width='140' height='18' class='b1 l1 r1'><div align='center' class='tahoma s12 black'>$consentaccsiarrf</div></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td valign='top' align='center' class='tahoma s8 black'>month day year</td>
                    </tr>
                  </table></div></td>
                </tr>
                <tr>
                  <td></td>
                  <td><div align='center' class='tahoma s8 black'>Signature Over Printed Name of Member/Pateint/Authorized Representative</div></td>
                  <td></td>
                </tr>
              </table></td>
              <td width='7'></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td $cursty onclick='myFunction7()'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='7'></td>
              <td width='auto'><table border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><div align='left' class='tahoma s8 black'>If member/representative is unable to write, <br />put right thumbmark. Member/Representative<br />should be assisted by an HCI representative.<br />Check the appropriate box.</div></td>
                    </tr>
                    <tr>
                      <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td><div align='left'><input name='checkbox' type='checkbox' class='larger11121111' $caruw1 /></div></td>
                          <td><div align='left' class='tahoma s8 black'>Patient&nbsp;</div></td>
                          <td><div align='left'><input name='checkbox' type='checkbox' class='larger11121111' $caruw2 /></div></td>
                          <td><div align='left' class='tahoma s8 black'>Representative</div></td>
                        </tr>
                      </table></div></td>
                    </tr>
                  </table></div></td>
                  <td width='25'></td>
                  <td width='120' valign='bottom'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td class='t3 b3 l3 r3' height='60'></td>
                    </tr>
                  </table></td>
                  <td width='25'></td>
                  <td><table border='0'width='100%' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><div align='left' class='tahoma s8 black'>Relationship of the<br />representative to the patient</div></td>
                      <td width='10'></td>
                      <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td><div align='left'><input name='checkbox' type='checkbox' class='larger11121111' $carrtm1 /></div></td>
                          <td><div align='left'><div align='left' class='tahoma s8 black'>Spouse</div></td>
                          <td width='5'></td>
                          <td><div align='left'><input name='checkbox' type='checkbox' class='larger11121111' $carrtm2 /></div></td>
                          <td><div align='left'><div align='left' class='tahoma s8 black'>Child</div></td>
                          <td width='5'></td>
                          <td><div align='left'><input name='checkbox' type='checkbox' class='larger11121111' $carrtm3 /></div></td>
                          <td><div align='left'><div align='left' class='tahoma s8 black'>Parent</div></td>
                        </tr>
                        <tr>
                          <td><div align='left'><input name='checkbox' type='checkbox' class='larger11121111' $carrtm4 /></div></td>
                          <td><div align='left'><div align='left' class='tahoma s8 black'>Sibling</div></td>
                          <td></td>
                          <td><div align='left'><input name='checkbox' type='checkbox' class='larger11121111' $carrtm5 /></div></td>
                          <td colspan='3'><div align='left'><div align='left' class='tahoma s8 black'>Other, Specify</div></td>
                          <td width='122' class='b1'><div align='left'><div align='left' class='tahoma s8 black'>&nbsp;$carrtmos</div></td>
                        </tr>
                      </table></div></td>
                    </tr>
                    <tr>
                      <td><div align='left' class='tahoma s8 black'>Reason for signing on<br />behalf of the patient</div></td>
                      <td width='5'></td>
                      <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td><div align='left'><input name='checkbox' type='checkbox' class='larger11121111' $carres1 /></div></td>
                          <td colspan='2'><div align='left'><div align='left' class='tahoma s8 black'>Patient is incapacitated</div></td>
                        </tr>
                        <tr>
                          <td><div align='left'><input name='checkbox' type='checkbox' class='larger11121111' $carres2 /></div></td>
                          <td><div align='left'><div align='left' class='tahoma s8 black'>Other reasons:</div></td>
                          <td width='170' class='b1'><div align='left' class='tahoma s8 black'>&nbsp;$carresos</div></td>
                        </tr>
                      </table></div></td>
                    </tr>
                  </table></td>
                </tr>
              </table></td>
              <td width='7'></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height='3'></td>
        </tr>
      </tbody>
    </table>
";


if($carchoose!=""){$hjk="&setcomchoose=$carchoose";}else{$hjk="";}
echo "
<script>
function myFunction7() {
  window.open('EditConAcc.php?caseno=$caseno&patientidno=$patientidno&paymentmode=$paymentmode".$hjk."', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=600,width=500,height=580');
}
</script>
";
?>
