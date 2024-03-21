<?php
if(trim($pfname1)!=""){$pre1="DR.";}else{$pre1="";}
if(trim($pfname2)!=""){$pre2="DR.";}else{$pre2="";}
if(trim($pfname3)!=""){$pre3="DR.";}else{$pre3="";}

$dkt=substr(date("s"), -1);
if(($dkt==1)||($dkt==4)||($dkt==7)){$dnum=1;}
else if(($dkt==2)||($dkt==5)||($dkt==8)){$dnum=2;}
else if(($dkt==3)||($dkt==6)||($dkt==9)){$dnum=3;}
else{$dnum=2;}

if(file_exists("Sig/".$phicac1."_".$dnum.".png")){
echo "
<img src='Sig/".$phicac1."_".$dnum.".png' style='position: absolute;left: 160px;top: 935px;width: auto;height: 75px;' alt='$phicac1'  />
";
}

if(file_exists("Sig/".$phicac2."_".$dnum.".png")){
echo "
<img src='Sig/".$phicac2."_".$dnum.".png' style='position: absolute;left: 190px;top: 960px;width: auto;height: 75px;' alt='$phicac2'  />
";
}

if(file_exists("Sig/".$phicac3."_".$dnum.".png")){
echo "
<img src='Sig/".$phicac3."_".$dnum.".png' style='position: absolute;left: 165px;top: 1000px;width: auto;height: 75px;' alt='$phicac3'  />
";
}

echo "
    <!-- PART IV - HEALTH CARE PROFESSIONAL INFORMATION -->
    <table width='750' border='0' cellpadding='0' cellspacing='0'>
      <tbody>
        <tr>
          <th scope='col' style='border-bottom: 2px solid black;border-top: 2px solid black;' class='tahoma s12 bold' height='26' align='center' valign='middle'>PART IV - HEALTH CARE PROFESSIONAL INFORMATION</th>
        </tr>
        <tr>
          <td height='3'></td>
        </tr>
        <tr>
          <td $cursty onclick='myFunction8()'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='7'></td>
              <td width='auto'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td rowspan='2'><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td colspan='5' align='left' class='tahoma s8 black'>Accreditation No.&nbsp;</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa10</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa11</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa12</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pa13</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa15</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa16</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa17</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa18</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa19</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa110</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pa111</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pa113</div></td>
                    </tr>
                  </table></td>
                  <td width='10'>&nbsp;</td>
                  <td width='240' class='bottomboxborder' align='center' valign='middle'>$pre1 $pfname1</td>
                  <td width='10'>&nbsp;</td>
                  <td rowspan='2'><table border='0' cellpadding='0' cellspacing='0'>
                    <!-- tr>
                      <td class='tahoma s8 black'>Date Signed&nbsp;</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr0</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pfdatesiarr1</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr3</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pfdatesiarr4</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr6</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr7</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr6</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pfdatesiarr9</div></td>
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
                      <td width='140' height='18' class='b1 l1 r1'><div align='center' class='tahoma s12 black'>$pfdatesiarrf</div></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td valign='top' align='center' class='tahoma s8 black'>month day year</td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td></td>
                  <td><div align='center' class='tahoma s8 black'>Signature Over Printed Name</div></td>
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
        <tr>
          <td $cursty onclick='myFunction8()'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='7'></td>
              <td width='auto'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td rowspan='2'><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td colspan='5' align='left' class='tahoma s8 black'>Accreditation No.&nbsp;</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa20</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa21</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa22</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pa23</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa25</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa26</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa27</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa28</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa29</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa210</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pa211</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pa213</div></td>
                    </tr>
                  </table></td>
                  <td width='10'>&nbsp;</td>
                  <td width='240' class='bottomboxborder' align='center' valign='middle'>$pre2 $pfname2</td>
                  <td width='10'>&nbsp;</td>
                  <td rowspan='2'><table border='0' cellpadding='0' cellspacing='0'>
                    <!-- tr>
                      <td class='tahoma s8 black'>Date Signed&nbsp;</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr20</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pfdatesiarr21</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr23</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pfdatesiarr24</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr26</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr27</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr26</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pfdatesiarr29</div></td>
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
                      <td width='140' height='18' class='b1 l1 r1'><div align='center' class='tahoma s12 black'>$pfdatesiarr2f</div></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td valign='top' align='center' class='tahoma s8 black'>month day year</td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td></td>
                  <td><div align='center' class='tahoma s8 black'>Signature Over Printed Name</div></td>
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
        <tr>
          <td $cursty onclick='myFunction8()'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='7'></td>
              <td width='auto'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td rowspan='2'><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td colspan='5' align='left' class='tahoma s8 black'>Accreditation No.&nbsp;</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa30</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa31</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa32</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pa33</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa35</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa36</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa37</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa38</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa39</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pa310</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pa311</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pa313</div></td>
                    </tr>
                  </table></td>
                  <td width='10'>&nbsp;</td>
                  <td width='240' class='bottomboxborder' align='center' valign='middle'>$pre3 $pfname3</td>
                  <td width='10'>&nbsp;</td>
                  <td rowspan='2'><table border='0' cellpadding='0' cellspacing='0'>
                    <!-- tr>
                      <td class='tahoma s8 black'>Date Signed&nbsp;</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr30</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pfdatesiarr31</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr33</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pfdatesiarr34</div></td>
                      <td width='10' align='center'>-</td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr36</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr37</div></td>
                      <td width='15' height='18' class='t1 b1 l1'><div align='center' class='tahoma s10 black'>$pfdatesiarr36</div></td>
                      <td width='15' height='18' class='t1 b1 l1 r1'><div align='center' class='tahoma s10 black'>$pfdatesiarr39</div></td>
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
                      <td width='140' height='18' class='b1 l1 r1'><div align='center' class='tahoma s12 black'>$pfdatesiarr3f</div></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td valign='top' align='center' class='tahoma s8 black'>month day year</td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td></td>
                  <td><div align='center' class='tahoma s8 black'>Signature Over Printed Name</div></td>
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
function myFunction8() {
  window.open('AddEditProfDetails.php?caseno=$caseno', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=600,width=500,height=700');
}
</script>
";
?>
