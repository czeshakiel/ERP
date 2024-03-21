<?php
echo "
    <!-- PART II - EMPLOYER'S CERTIFICATION -->
    <table width='750' border='0' cellpadding='0' cellspacing='0'>
      <tbody>
        <tr>
          <th scope='col' style='border-bottom: 2px solid black;border-top: 2px solid black;' class='tahoma s12 bold' height='26' align='center' valign='middle'>PART II - EMPLOYER'S CERTIFICATION</th>
        </tr>
        <tr>
          <td height='3'></td>
        </tr>
        <tr>
          <td $cursty onclick='myFunction6()'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='7'></td>
              <td width='220' class='stylebody'>1. PhilHealth Employer Number (PEN):</td>
              <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='10'></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pen0</div></td>
                  <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pen1</div></td>
                  <td width='10' align='center'>-</td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pen3</div></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pen4</div></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pen5</div></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pen6</div></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pen7</div></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pen8</div></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pen9</div></td>
                  <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pen10</div></td>
                  <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pen11</div></td>
                  <td width='10' align='center'>-</td>
                  <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pen13</div></td>
                </tr>
              </table></div></td>
              <td width='90' class='stylebody'>2. Contact No. :</td>
              <td width='160' width='15' height='18' class='bottomboxborder'>&nbsp;$employercontactno</td>
              <td width='7'></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height='6'></td>
        </tr>
        <tr>
          <td $cursty onclick='myFunction6()'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='7'></td>
              <td width='auto'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td width='140' class='stylebody'>3. Business Name:</td>
                  <td class='b1'><div align='center' class='tahoma s10 black'>$employerbusname</div></td>
                </tr>
                <tr>
                  <td></td>
                  <td valign='top'><div align='center' class='tahoma s8 black'>Business Name of Employer</div></td>
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
          <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='7'></td>
              <td width='auto'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td colspan='2' class='stylebody'>4. CERTIFICATION OF EMPLOYER:</td>
                </tr>
                <tr>
                  <td colspan='2' height='8'></td>
                </tr>
                <tr>
                  <td width='20'></td>
                  <td valign='top'><div align='justify' class='tahoma s8 black bold'><i>&nbsp;&nbsp;&nbsp;&quot;This is to certify that the required 3/6 monthly premium contributions plus at least 6 months contribution preceding the 3 months qualifying contributions within 12 month period prior to the first day of confinement (sufficient regularity) have been regularly remitted to PhilHealth. Moreover, the information supplied by the member or his/her representative on Part I are consistent with our available records.&quot;</i></div></td>
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
          <td $cursty onclick='myFunction6()'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='7'></td>
              <td width='auto'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td class='bottomboxborder' align='center' valign='bottom'>$employername</td>
                  <td width='10'>&nbsp;</td>
                  <td width='200' class='bottomboxborder' align='center' valign='bottom'>$employerdesignation</td>
                  <td width='10'>&nbsp;</td>
                  <td rowspan='2' width='215'><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
                    <!-- tr>
                      <td class='tahoma s8 black'>Date Signed&nbsp;</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$empdatesiarr0</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$empdatesiarr1</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$empdatesiarr3</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$empdatesiarr4</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$empdatesiarr6</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$empdatesiarr7</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$empdatesiarr6</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$empdatesiarr9</div></td>
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
                      <td width='140' height='18' class='b1 l1 r1'><div align='center' class='tahoma s12 black'>$empdatesiarrf</div></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td valign='top' align='center' class='tahoma s8 black'>month day year</td>
                    </tr>
                  </table></div></td>
                </tr>
                <tr>
                  <td><div align='center' class='tahoma s8 black'>Signature Over Printed Name of Employer/Authorized Representative</div></td>
                  <td></td>
                  <td><div align='center' class='tahoma s8 black'>Official Capacity/Designation</div></td>
                  <td></td>
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

<script>
function myFunction6() {
  window.open('AddEditEmpDetails.php?caseno=$caseno', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=600,width=500,height=500');
}
</script>
";
