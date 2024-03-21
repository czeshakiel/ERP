<?php
echo "
    <!-- PART 1 START HERE-->
    <table width='750' border='0' cellspacing='0' cellpadding='0'>
      <tbody>
        <tr>
          <th scope='col' style='border-bottom: 2px solid black;' class='tahoma s12 bold' height='26' align='center' valign='middle'>PART I - MEMBER AND PATIENT INFORMATION AND CERTIFICATION</th>
        </tr>
        <tr>
          <td height='3'></td>
        </tr>
        <tr>
          <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='7'></td>
              <td width='305' class='stylebody'>1. PhilHealth Identification Number (PIN) of Member:</td>
              <td $cursty onclick='myFunction()'><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='10'></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$phicmember0</div></td>
                  <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$phicmember1</div></td>
                  <td width='10' align='center'>-</td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$phicmember3</div></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$phicmember4</div></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$phicmember5</div></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$phicmember6</div></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$phicmember7</div></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$phicmember8</div></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$phicmember9</div></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$phicmember10</div></td>
                  <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$phicmember11</div></td>
                  <td width='10' align='center'>-</td>
                  <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$phicmember13</div></td>
                </tr>
              </table></div></td>
              <td width='7'></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height='3'></td>
        </tr>
        <tr>
          <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='7'></td>
              <td width='560' class='stylebody'><div align='left'>2. Name of Member:</div></td>
              <td width='auto' class='stylebody'><div a;ign='left'>3. Member Date of Birth:</div></td>
              <td width='7'></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height='3'></td>
        </tr>
        <tr>
          <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='7'>&nbsp;</td>
              <td width='560'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='140' class='bottomboxborder' align='center' $cursty onclick='myFunction()'>$LN</td>
                  <td width='15' height='18'>&nbsp;</td>
                  <td width='140' class='bottomboxborder' align='center' $cursty onclick='myFunction()'>$FN</td>
                  <td width='15' height='18'>&nbsp;</td>
                  <td width='80' class='bottomboxborder' align='center' $cursty onclick='myFunction()'>$MS</td>
                  <td width='15' height='18'>&nbsp;</td>
                  <td width='auto' class='bottomboxborder' align='center' $cursty onclick='myFunction()'>$MN</td>
                </tr>
                <tr>
                  <td valign='top' align='center' class='tahoma s8 black'>Last Name</td>
                  <td>&nbsp;</td>
                  <td valign='top' align='center' class='tahoma s8 black'>First Name</td>
                  <td>&nbsp;</td>
                  <td valign='top' align='center' class='tahoma s8 black'>Name Extension<br>(JR/SR/III)</td>
                  <td>&nbsp;</td>
                  <td valign='top' align='center' class='tahoma s8 black' >Middle Name<br>(ex:DELA CRUZ JUAN JR SIPAG)</td>
                </tr>
              </table></td>
              <td width='auto'>&nbsp;</td>
              <td width='160'><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='15' height='18' class='t1 b1 l1' $cursty onclick='myFunction()'><div align='center' class='tahoma s10 black'>$bdayofmemarr0</div></td>
                  <td width='15' height='18' class='t1 b1 l1 r1' $cursty onclick='myFunction()'><div align='center' class='tahoma s10 black'>$bdayofmemarr1</div></td>
                  <td width='10' align='center'>-</td>
                  <td width='15' height='18' class='t1 b1 l1' $cursty onclick='myFunction()'><div align='center' class='tahoma s10 black'>$bdayofmemarr3</div></td>
                  <td width='15' height='18' class='t1 b1 l1 r1' $cursty onclick='myFunction()'><div align='center' class='tahoma s10 black'>$bdayofmemarr4</div></td>
                  <td width='10' align='center'>-</td>
                  <td width='15' height='18' class='t1 b1 l1' $cursty onclick='myFunction()'><div align='center' class='tahoma s10 black'>$bdayofmemarr6</div></td>
                  <td width='15' height='18' class='t1 b1 l1' $cursty onclick='myFunction()'><div align='center' class='tahoma s10 black'>$bdayofmemarr7</div></td>
                  <td width='15' height='18' class='t1 b1 l1' $cursty onclick='myFunction()'><div align='center' class='tahoma s10 black'>$bdayofmemarr8</div></td>
                  <td width='15' height='18' class='t1 b1 l1 r1' $cursty onclick='myFunction()'><div align='center' class='tahoma s10 black'>$bdayofmemarr9</div></td>
                </tr>
                <tr>
                  <td colspan='2' valign='top' align='center' class='tahoma s8 black'>month</td>
                  <td>&nbsp;</td>
                  <td colspan='2' valign='top' align='center' class='tahoma s8 black'>day</td>
                  <td>&nbsp;</td>
                  <td colspan='4' valign='top' align='center' class='tahoma s8 black1'>year</td>
                </tr>
              </table></div></td>
              <td width='7'>&nbsp;</td>
            </tr>
          </table></td>
        </tr>

        <tr>
          <td colspan='41' height='8'></td>
        </tr>
        <tr>
          <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='7'>&nbsp;</td>
              <td width='325' class='stylebody'>4. PhilHealth Identification Number (PIN) of Dependent:</td>
              <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$phicdep0</div></td>
                  <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$phicdep1</div></td>
                  <td width='10' align='center'>-</td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$phicdep3</div></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$phicdep4</div></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$phicdep5</div></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$phicdep6</div></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$phicdep7</div></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$phicdep8</div></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$phicdep9</div></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$phicdep10</div></td>
                  <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$phicdep11</div></td>
                  <td width='10' align='center'>-</td>
                  <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$phicdep13</div></td>
                </tr>
              </table></div></td>
              <td width='7'>&nbsp;</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height='3'></td>
        </tr>
        <tr>
          <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='7'></td>
              <td width='560' class='stylebody'><div align='left'>5. Name of Patient:</div></td>
              <td width='auto' class='stylebody'><div a;ign='left'>6. Relationship to Member:</div></td>
              <td width='7'></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height='3'></td>
        </tr>
        <tr>
          <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='7'>&nbsp;</td>
              <td width='560'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='140' class='bottomboxborder' $cursty onclick='myFunction2()' align='center'>$LNPat</td>
                  <td width='15' height='18'>&nbsp;</td>
                  <td width='140' class='bottomboxborder' $cursty onclick='myFunction2()' align='center'>$FNPat</td>
                  <td width='15' height='18'>&nbsp;</td>
                  <td width='80' class='bottomboxborder' $cursty onclick='myFunction2()' align='center'>$MNSuf</td>
                  <td width='15' height='18'>&nbsp;</td>
                  <td width='auto' class='bottomboxborder' $cursty onclick='myFunction2()' align='center'>$MNPat</td>
                </tr>
                <tr>
                  <td valign='top' align='center' class='tahoma s8 black'>Last Name</td>
                  <td>&nbsp;</td>
                  <td valign='top' align='center' class='tahoma s8 black'>First Name</td>
                  <td>&nbsp;</td>
                  <td valign='top' align='center' class='tahoma s8 black'>Name Extension<br>(JR/SR/III)</td>
                  <td>&nbsp;</td>
                  <td valign='top' align='center' class='tahoma s8 black' >Middle Name<br>(ex:DELA CRUZ JUAN JR SIPAG)</td>
                </tr>
              </table></td>
              <td width='auto'>&nbsp;</td>
              <td width='160'><div align='left' $cursty onclick='myFunction()'><table border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='15' height='18'><input name='checkbox' type='checkbox' class='larger11121111' $rom1 /></td>
                  <td valign='middle' align='left' class='stylebodyp1'>&nbsp;child</td>
                  <td width='15' height='18'><input name='checkbox' type='checkbox' class='larger11121111' $rom2 /></td>
                  <td valign='middle' align='left' class='stylebodyp1'>&nbsp;parent</td>
                  <td width='15' height='18'><input name='checkbox' type='checkbox' class='larger11121111' $rom3 /></td>
                  <td valign='middle' align='left' class='stylebodyp1'>&nbsp;spouse</td>
                </tr>
                <tr>
                  <td colspan='6'>&nbsp;</td>
                </tr>
              </table></div></td>
              <td width='7'>&nbsp;</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td colspan='41' height='8'></td>
        </tr>
        <tr>
          <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='7'></td>
              <td width='560' class='stylebody'><div align='left'>7. Confinement Period:</div></td>
              <td width='auto' class='stylebody'><div a;ign='left'>8. Patient Date of Birth:</div></td>
              <td width='7'></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height='3'></td>
        </tr>
        <tr>
          <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='18'></td>
              <td $cursty onclick='myFunction3()'><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
                <!-- tr>
                  <td class='stylebodyp1'>a. Date Admitted:&nbsp;</td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$dateadmittedarr0</div></td>
                  <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$dateadmittedarr1</div></td>
                  <td width='10' align='center'>-</td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$dateadmittedarr3</div></td>
                  <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$dateadmittedarr4</div></td>
                  <td width='10' align='center'>-</td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$dateadmittedarr6</div></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$dateadmittedarr7</div></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$dateadmittedarr8</div></td>
                  <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$dateadmittedarr9</div></td>
                </tr>
                <tr>
                  <td></td>
                  <td colspan='2' valign='top' align='center' class='tahoma s8 black'>month</td>
                  <td>&nbsp;</td>
                  <td colspan='2' valign='top' align='center' class='tahoma s8 black'>day</td>
                  <td>&nbsp;</td>
                  <td colspan='4' valign='top' align='center' class='tahoma s8 black1'>year</td>
                </tr -->
                <tr>
                  <td class='stylebodyp1'><div class='blk'>a. Date Admitted:&nbsp;</div></td>
                  <td width='140' height='18' class='b1 l1 r1'><div align='center' class='tahoma s12 black'><!-- $dateadmitted --></div></td>
                </tr>
                <tr>
                  <td></td>
                  <td valign='top' align='center' class='tahoma s8 black'>month day year</td>
                </tr>
              </table></div></td>
              <td width='auto'></td>
              <td $cursty onclick='myFunction4()'><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
                <!-- tr>
                  <td class='stylebodyp1'><a href='../SOA/TempDateDis.php?caseno=$caseno' target='_blank' class='astyle'><div class='blk'>b. Date Discharged:&nbsp;</div></a></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$datedischargedarr0</div></td>
                  <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$datedischargedarr1</div></td>
                  <td width='10' align='center'>-</td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$datedischargedarr3</div></td>
                  <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$datedischargedarr4</div></td>
                  <td width='10' align='center'>-</td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$datedischargedarr6</div></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$datedischargedarr7</div></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$datedischargedarr8</div></td>
                  <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$datedischargedarr9</div></td>
                </tr>
                <tr>
                  <td></td>
                  <td colspan='2' valign='top' align='center' class='tahoma s8 black'>month</td>
                  <td>&nbsp;</td>
                  <td colspan='2' valign='top' align='center' class='tahoma s8 black'>day</td>
                  <td>&nbsp;</td>
                  <td colspan='4' valign='top' align='center' class='tahoma s8 black1'>year</td>
                </tr -->
                <tr>
                  <td class='stylebodyp1'><div class='blk'>b. Date Discharged:&nbsp;</div></a></td>
                  <td width='140' height='18' class='b1 l1 r1'><div align='center' class='tahoma s12 black'>$datedischargedfmtdisp</div></td>
                </tr>
                <tr>
                  <td></td>
                  <td valign='top' align='center' class='tahoma s8 black'>month day year</td>
                </tr>
              </table></div></td>
              <td width='160'><div align='left' $cursty onclick='myFunction2()'><table border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$bdayofpatarr0</div></td>
                  <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$bdayofpatarr1</div></td>
                  <td width='10' align='center'>-</td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$bdayofpatarr3</div></td>
                  <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$bdayofpatarr4</div></td>
                  <td width='10' align='center'>-</td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$bdayofpatarr6</div></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$bdayofpatarr7</div></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$bdayofpatarr8</div></td>
                  <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$bdayofpatarr9</div></td>
                </tr>
                <tr>
                  <td colspan='2' valign='top' align='center' class='tahoma s8 black'>month</td>
                  <td>&nbsp;</td>
                  <td colspan='2' valign='top' align='center' class='tahoma s8 black'>day</td>
                  <td>&nbsp;</td>
                  <td colspan='4' valign='top' align='center' class='tahoma s8 black'>year</td>
                </tr>
              </table></div></td>
              <td width='7'>&nbsp;</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='7'></td>
              <td width='auto' class='stylebody'><div align='left'>9. CERTIFICATION OF MEMBER:</div></td>
              <td width='7'></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height='3'></td>
        </tr>
        <tr>
          <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='7'></td>
              <td width='auto' class='stylebody'><div align='center' class='tahoma s8 black'><strong><i>Under the penalty of low, I attest that the information I provided in this Form are true and accurate to the best of my knowledge.</i></strong></div></td>
              <td width='7'></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height='10'></td>
        </tr>
        <tr>
          <td $cursty onclick='myFunction5()'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='30'></td>
              <td width='auto'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='35%' class='bottomboxborder'><div align='center'>$comnamem</div></td>
                  <td width='15%'>&nbsp;</td>
                  <td width='50%' class='bottomboxborder'><div align='center'>$comnamer</div></td>
                </tr>
                <tr>
                  <td><div align='center' class='tahoma s8 black'>Signature Over Printed Name of Member</div></td>
                  <td>&nbsp;</td>
                  <td><div align='center' class='tahoma s8 black'>Signature Over Printed Name of Member's Representative</div></td>
                </tr>
                <tr>
                  <td><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
                    <!-- tr>
                      <td class='tahoma s8 black'>Date Signed&nbsp;</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$comdatearr01</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$comdatearr11</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$comdatearr31</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$comdatearr41</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$comdatearr61</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$comdatearr71</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$comdatearr81</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$comdatearr91</div></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td colspan='2' valign='top' align='center' class='tahoma s8 black'>month</td>
                      <td>&nbsp;</td>
                      <td colspan='2' valign='top' align='center' class='tahoma s8 black'>day</td>
                      <td>&nbsp;</td>
                      <td colspan='4' valign='top' align='center' class='tahoma s8 black1'>year</td>
                    </tr -->
";


echo "
                    <tr>
                      <td class='tahoma s8 black'>Date Signed&nbsp;</td>
                      <td width='140' height='18' class='b1 l1 r1'><div align='center' class='tahoma s12 black'>$comdate1</div></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td valign='top' align='center' class='tahoma s8 black'>month day year</td>
                    </tr>
                  </table></div></td>
                  <td>&nbsp;</td>
                  <td><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
                    <!-- tr>
                      <td class='tahoma s8 black'>Date Signed&nbsp;</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$comdatearr02</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$comdatearr12</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$comdatearr32</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$comdatearr42</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$comdatearr62</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$comdatearr72</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$comdatearr82</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$comdatearr92</div></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td colspan='2' valign='top' align='center' class='tahoma s8 black'>month</td>
                      <td>&nbsp;</td>
                      <td colspan='2' valign='top' align='center' class='tahoma s8 black'>day</td>
                      <td>&nbsp;</td>
                      <td colspan='4' valign='top' align='center' class='tahoma s8 black1'>year</td>
                    </tr -->
                    <tr>
                      <td class='tahoma s8 black'>Date Signed&nbsp;</td>
                      <td width='140' height='18' class='b1 l1 r1'><div align='center' class='tahoma s12 black'>$comdate2</div></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td valign='top' align='center' class='tahoma s8 black'>month day year</td>
                    </tr>
                  </table></div></td>
                </tr>
              </table></td>
              <td width='30'></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td $cursty onclick='myFunction5()'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
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
                          <td><div align='left'><input name='checkbox' type='checkbox' class='larger11121111' $comuw1 /></div></td>
                          <td><div align='left' class='tahoma s8 black'>Member</div></td>
                          <td><div align='left'><input name='checkbox' type='checkbox' class='larger11121111' $comuw2 /></div></td>
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
                      <td><div align='left' class='tahoma s8 black'>Relationship of the<br />representative to the member</div></td>
                      <td width='10'></td>
                      <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td><div align='left'><input name='checkbox' type='checkbox' class='larger11121111' $comrtm1 /></div></td>
                          <td><div align='left'><div align='left' class='tahoma s8 black'>Spouse</div></td>
                          <td width='5'></td>
                          <td><div align='left'><input name='checkbox' type='checkbox' class='larger11121111' $comrtm2 /></div></td>
                          <td><div align='left'><div align='left' class='tahoma s8 black'>Child</div></td>
                          <td width='5'></td>
                          <td><div align='left'><input name='checkbox' type='checkbox' class='larger11121111' $comrtm3 /></div></td>
                          <td><div align='left'><div align='left' class='tahoma s8 black'>Parent</div></td>
                        </tr>
                        <tr>
                          <td><div align='left'><input name='checkbox' type='checkbox' class='larger11121111' $comrtm4 /></div></td>
                          <td><div align='left'><div align='left' class='tahoma s8 black'>Sibling</div></td>
                          <td></td>
                          <td><div align='left'><input name='checkbox' type='checkbox' class='larger11121111' $comrtm5 /></div></td>
                          <td colspan='3'><div align='left'><div align='left' class='tahoma s8 black'>Other, Specify</div></td>
                          <td width='122' class='b1'><div align='left'><div align='left' class='tahoma s8 black'>&nbsp;$comrtmos</div></td>
                        </tr>
                      </table></div></td>
                    </tr>
                    <tr>
                      <td><div align='left' class='tahoma s8 black'>Reason for signing on<br />behalf of the member</div></td>
                      <td width='5'></td>
                      <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td><div align='left'><input name='checkbox' type='checkbox' class='larger11121111' $comres1 /></div></td>
                          <td colspan='2'><div align='left'><div align='left' class='tahoma s8 black'>Member is incapacitated</div></td>
                        </tr>
                        <tr>
                          <td><div align='left'><input name='checkbox' type='checkbox' class='larger11121111' $comres2 /></div></td>
                          <td><div align='left'><div align='left' class='tahoma s8 black'>Other reasons:</div></td>
                          <td width='170' class='b1'><div align='left' class='tahoma s8 black'>&nbsp;$comreso</div></td>
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

<!-- Member Information -->
<script>
function myFunction() {
  window.open('AddEditMem.php?caseno=$caseno&patientidno=$patientidno&paymentmode=$paymentmode', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=600,width=500,height=600');
}
</script>

<!-- Patient Information -->
<script>
function myFunction2() {
  window.open('AddEditPat.php?caseno=$caseno&patientidno=$patientidno&paymentmode=$paymentmode', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=600,width=500,height=500');
}
</script>

<!-- Date Admitted -->
<script>
function myFunction3() {
  window.open('EditDateAdm.php?caseno=$caseno', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=600,width=500,height=250');
}
</script>

<!-- Date Discharged -->
<script>
function myFunction4() {
  window.open('EditDateDis.php?caseno=$caseno', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=600,width=500,height=250');
}
</script>
";

if($comchoose!=""){$hjk="&setcomchoose=$comchoose";}else{$hjk="";}
echo "
<script>
function myFunction5() {
  window.open('EditCertMem.php?caseno=$caseno&patientidno=$patientidno&paymentmode=$paymentmode".$hjk."', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=600,width=500,height=630');
}
</script>
";
?>
