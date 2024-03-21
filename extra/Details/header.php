<?php
if($crcode1!=""){
  $c1disp=$c1disp;
}
else{
  $c1disp="";
}

if($crcode2!=""){
  $c2disp=$c2disp;
}
else{
  $c2disp="";
}
echo "
        <tr>
          <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>

              <!-- ------------------------------------------------------------------------------------------------------------------------------ -->
              <td width='auto' valign='top'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='68'><div align='left' class='times s10 black bold'>Patient name</div></td>
                      <td width='10'><div align='center' class='times s10 black bold'>:</div></td>
                      <td width='auto' class='b1'><div align='left' class='times s11 black bold'>$patname</div></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td height='3'></td>
                </tr>
                <tr>
                  <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='40'><div align='left' class='times s10 black bold'>Address</div></td>
                      <td width='10'><div align='center' class='times s10 black bold'>:</div></td>
                      <td width='auto' class='b1'><div align='left' class='times s11 black bold'>$pataddress</div></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td height='3'></td>
                </tr>
                <tr>
                  <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='70'><div align='left' class='times s10 black bold'>Final Diagnosis</div></td>
                      <td width='10'><div align='center' class='times s10 black bold'>:</div></td>
                      <td width='auto' class='b1'><div align='left' class='times s11 black'>$finaldiagnosis</div></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td height='3'></td>
                </tr>
                <tr>
                  <td><a href='../../2017codes/SOA/AddDiagnosis.php?caseno=$caseno' target='_blank' style='text-decoration: none;'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='90' valign='middle' rowspan='5'><div align='left' class='times s10 black bold'>Other Diagnosis:</div></td>
                      <td width='12' valign='middle' height='20'><div align='left' class='times s10 black bold'>1.</div></td>
                      <td width='auto' class='b1'><div align='left' class='times s11 black bold'>$d1</div></td>
                    </tr>
                    <tr>
                      <td height='3' colspan='2'></td>
                    </tr>
                    <tr>
                      <td valign='middle' height='20'><div align='left' class='times s10 black bold'>2.</div></td>
                      <td class='b1'><div align='left' class='times s11 black bold'>$d2</div></td>
                    </tr>
                    <tr>
                      <td height='3' colspan='2'></td>
                    </tr>
                    <tr>
                      <td valign='middle' height='20'><div align='left' class='times s10 black bold'>3.</div></td>
                      <td class='b1'><div align='left' class='times s11 black bold'>$d3</div></td>
                    </tr>
                  </table></a></td>
                </tr>
              </table></td>
              <!-- ------------------------------------------------------------------------------------------------------------------------------ -->

              <td width='5'></td>

              <!-- ------------------------------------------------------------------------------------------------------------------------------ -->
              <td width='280' valign='top'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                  <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width='auto'><div align='left' class='times s10 black bold'>Billing Date & Time</div></td>
                      <td width='10'><div align='center' class='times s10 black bold'>:</div></td>
                      <td width='160' class='b1'><div align='left' class='times s11 black bold'>".date("M d, Y H:i A")."</div></td>
                    </tr>
                    <tr>
                      <td height='3' colspan='3'></td>
                    </tr>
                    <tr>
                      <td><div align='left' class='times s10 black bold'>Date & Time Admitted</div></td>
                      <td><div align='center' class='times s10 black bold'>:</div></td>
                      <td class='b1'><div align='left' class='times s11 black bold'>".date("M d, Y h:i A",strtotime($dtadm))."</div></td>
                    </tr>
                    <tr>
                      <td height='3' colspan='3'></td>
                    </tr>
                    <tr>
                      <td><div align='left' class='times s10 black bold'>Date & Time Discharged</div></td>
                      <td><div align='center' class='times s10 black bold'>:</div></td>
                      <td class='b1' style='cursor: pointer;'";?> onclick="<?php ini_set("display_errors","On"); echo "window.open('settempdisdate.php?caseno=$caseno&uname=$uname', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=$hei,left=$wid,width=$setw,height=$seth');"; ?>" <?php echo "><div align='left' class='times s11 black bold'>$dtddis</div></td>
                    </tr>
                    <tr>
                      <td height='3' colspan='3'></td>
                    </tr>
                    <tr>
                      <td><div align='left' class='times s10 black bold'>Room Accomodation</div></td>
                      <td><div align='center' class='times s10 black bold'>:</div></td>
                      <td class='b1'><div align='left' class='times s11 black bold'>$room</div></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td valign='middle' width='auto' height='35'><div align='left' class='times s10 black bold'>First Case Rate</div></td>
                      <td valign='middle' width='10'><div align='center' class='times s10 black bold'>:</div></td>
                      <td class='b1' valign='middle' width='190'><a href='../../2017codes/SOA/AddDetails.php?caseno=$caseno&type=1' target='_blank' style='text-decoration: none;'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td width='45'><div align='left' class='times s10 black bold'>$crcode1</div></td>
                          <td><div align='left' class='times s8 black'>$c1disp</div></td>
                        </tr>
                      </table></a></td>
                    </tr>
                    <tr>
                      <td valign='middle' height='35'><div align='left' class='times s10 black bold'>Second Case Rate</div></td>
                      <td valign='middle'><div align='center' class='times s10 black bold'>:</div></td>
                      <td class='b1' valign='middle'><a href='../../2017codes/SOA/AddDetails.php?caseno=$caseno&type=2' target='_blank' style='text-decoration: none;'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td width='45'><div align='left' class='times s10 black bold'>$crcode2</div></td>
                          <td><div align='left' class='times s8 black'>$c2disp</div></td>
                        </tr>
                      </table></a></td>
                    </tr>
                  </table></td>
                </tr>
              </table></td>
              <!-- ------------------------------------------------------------------------------------------------------------------------------ -->

            </tr>
          </table></td>
        </tr>
";
?>
