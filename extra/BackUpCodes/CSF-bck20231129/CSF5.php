<?php
$kt=substr(date("s"), -1);
if(($kt==1)||($kt==4)||($kt==7)){$snum=1;}
else if(($kt==2)||($kt==5)||($kt==8)){$snum=2;}
else if(($kt==3)||($kt==6)||($kt==9)){$snum=3;}
else{$snum=2;}

echo "
    <!-- PART V - PROVIDER INFORMATION AND CERTIFICATION -->
    <table width='750' border='0' cellpadding='0' cellspacing='0' style='background-image: url(Image/CSFSig_$snum.png);background-size: 750px 100px;width: 750px;height: 100px;'>
      <tbody>
        <tr>
          <th scope='col' style='border-bottom: 2px solid black;border-top: 2px solid black;' class='tahoma s12 bold' height='26' align='center' valign='middle'>PART V - PROVIDER INFORMATION AND CERTIFICATION</th>
        </tr>
        <tr>
          <td height='3'></td>
        </tr>
        <tr>
          <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='7'></td>
              <td width='auto' class='stylebody'>1. PhilHealth Benefits:</td>
              <td width='20'></td>
              <td width='115' class='stylebody'>ICD 10 or RVS Code:</td>
              <td width='10'></td>
              <td width='70'><div align='left' class='tahoma s8 black'>1. First Case Rate</div></td>
              <td width='5'></td>
              <td width='135' width='15' height='18' class='bottomboxborder'><div align='center'>$pcase</div></td>
              <td width='5'></td>
              <td width='80'><div align='left' class='tahoma s8 black'>2. Second Case Rate</div></td>
              <td width='5'></td>
              <td width='135' width='15' height='18' class='bottomboxborder'><div align='center'>$scase</div></td>
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
                  <td valign='top'><div align='center' class='tahoma s8 black bold'><i>I certify that services rendered were recorded in the patient's chart and health care institution records and that the herein information given are true and correct.</i></div></td>
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
          <td $cursty onclick='myFunction10()'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='7'></td>
              <td width='auto'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td class='bottomboxborder' align='center' valign='bottom'>ALELIE T. ANGOT</td>
                  <td width='10'>&nbsp;</td>
                  <td width='200' class='bottomboxborder' align='center' valign='bottom'>PHIC IN-CHARGE</td>
                  <td width='10'>&nbsp;</td>
                  <td rowspan='2' width='215'><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
                    <!-- tr>
                      <td class='tahoma s8 black'>Date Signed&nbsp;</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$hcidtarr0</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$hcidtarr1</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$hcidtarr3</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$hcidtarr4</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$hcidtarr6</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$hcidtarr7</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$hcidtarr6</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$hcidtarr9</div></td>
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
                      <td width='140' height='18' class='b1 l1 r1'><div align='center' class='tahoma s12 black'>$hcidtarrf</div></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td valign='top' align='center' class='tahoma s8 black'>month day year</td>
                    </tr>
                  </table></div></td>
                </tr>
                <tr>
                  <td><div align='center' class='tahoma s8 black'>Signature Over Printed Name of Authorized HCI Representative</div></td>
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
          <td height='10'></td>
        </tr>
      </tbody>
    </table>

<script>
function myFunction9() {
  window.open('AddEditPhicBen.php?caseno=$caseno', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=600,width=500,height=640');
}
</script>

<script>
function myFunction10() {
  window.open('AddEditAuthSig.php?caseno=$caseno', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=600,width=500,height=300');
}
</script>
";
?>
