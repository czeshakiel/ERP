<?php
//START PART II------------------------------------------------------------------------------------------------------------------
echo "
          <tr>
            <td height='24' class='t1 b1 l1 r1' bgcolor='#000000'><div align='center' class='arial s12 white bold'>PART II. PATIENT CONFINEMENT INFORMATION</div></td>
          </tr>
          <tr>
            <td height='3'></td>
          </tr>
          <tr>
            <td><table border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;'>
              <tr>
                <td width='5'></td>
                <td><div align='center' $cursty onclick='openpatname()'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td class='tahoma s9 black bold' width='15%'>1 Name of Patient </td>
                    <td class='b1'><div align='center' class='tahoma s12 black'>$ln</div></td>
                    <td class='b1'><div align='center' class='tahoma s12 black'>$fn</div></td>
                    <td class='b1'><div align='center' class='tahoma s12 black'>$su</div></td>
                    <td class='b1'><div align='center' class='tahoma s12 black'>$mn</div></td>
                  </tr>
                  <tr>
                    <td><div align='center' class='tahoma s9 black bold'></div></td>
                    <td ><div align='center' class='tahoma s10 black'>Last Name &nbsp;</div></td>
                    <td><div align='center' class='tahoma s10 black'>First Name &nbsp;</div></td>
                    <td><div align='center' class='tahoma s10 black'>Name Extension &nbsp;</div></td>
                    <td><div align='center' class='tahoma s10 black'>Middle Name &nbsp;</div></td>
                  </tr>
                  <tr>
                    <td><div align='center' class='tahoma s8 black'></div></td>
                    <td ><div align='center' class='tahoma s8 black'></div></td>
                    <td><div align='center' class='tahoma s8 black'></div></td>
                    <td valign='top'><div align='center' class='tahoma s8 black'>(JR/SR/III)</div></td>
                    <td><div align='center' class='tahoma s8 black'>(ex:DELA CRUZ JR SIPAG)</div></td>
                  </tr>
                </table></div></td>
              </tr>
              <tr>
                <td height='3'></td>
              </tr>
              <tr>
                <td width='5'></td>
                <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td><div align='left' class='tahoma s9 black bold'>2. Was patient referred by another Health Care Institution (HCI)? &nbsp;</div></td>
                  </tr>
                  <tr>
                    <td height='5'></td>
                  </tr>
                  <tr>
                    <td width='10'><table border='0' cellpadding='0' cellspacing='0' width='100%'>
                      <tr>
                        <td width='10'></td>
                        <td><table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td class='r1 l1 b1 t1' height='17' width='17'><div align='center' class='tahoma s9 black'>$isrefn</div></td>
                            <td><div class='tahoma s12 black'>&nbsp;NO&nbsp;</div></td>
                          </tr>
                        </table></td>
                        <td><table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td class='r1 l1 b1 t1' height='17' width='17'><div align='center' class='tahoma s9 black'>$isrefy</div></td>
                            <td class='tahoma s12 black'>&nbsp;YES&nbsp;</td>
                          </tr>
                        </table></td>
                        <td class='b1'><div align='center' class='tahoma s9 black'>$hcidisp</div></td>
                        <td width='5'></td>
                        <td class='b1'><div align='center' class='tahoma s10 black'></div></td>
                        <td width='5'></td>
                        <td class='b1'><div align='center' class='tahoma s10 black'></div></td>
                        <td width='5'></td>
                        <td class='b1'><div align='center' class='tahoma s10 black'></div></td>
                        <td width='5'></td>
                        <td class='b1'><div align='center' class='tahoma s10 black'></div></td>
                        <td width='5'></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><div align='center' class='tahoma s10 black'>&nbsp;Name of referring Health Care Institution&nbsp;</div></td>
                        <td></td>
                        <td><div align='center' class='tahoma s10 black'>&nbsp;Building Number and Street Name&nbsp;</div></td>
                        <td></td>
                        <td><div align='center' class='tahoma s10 black'>&nbsp;City/Municipality&nbsp;</div></td>
                        <td></td>
                        <td><div align='center' class='tahoma s10 black'>&nbsp;Province&nbsp;</div></td>
                        <td></td>
                        <td><div align='center' class='tahoma s10 black'>&nbsp;Zip code&nbsp;</div></td>
                        <td></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>


              <tr>
                <td width='5'></td>
                <td><div align='left'><table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse;'>
";


//---------------------------------------------------------------------------------------------------------------------------------------------------
echo "
                  <tr>
                    <td><div align='left' class='tahoma s9 black bold'>3. Confinement Period:</div></td>
                    <td width='20'></td>
                    <td valign='center'><div align='left' class='tahoma s10 black'>a. Date Admitted</div></td>
                    <td width='10'></td>
                    <td><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td><table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>$adm1</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>$adm2</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td width='15' height='15'><div align='center' class='tahoma s10 black'>-</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>$add1</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>$add2</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td width='15' height='15'><div align='center' class='tahoma s10 black'>-</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>$ady1</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>$ady2</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>$ady3</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>$ady4</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td colspan='5' valign='top'><div align='center' class='tahoma s7 black'>month</div></td>
                            <td></td>
                            <td colspan='5' valign='top'><div align='center' class='tahoma s7 black'>day</div></td>
                            <td></td>
                            <td colspan='9' valign='top'><div align='center' class='tahoma s7 black'>year</div></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                    <td width='20'></td>


                    <td valign='center'><div align='left' class='tahoma s10 black'>b. Time Admitted</div></td>
                    <td width='10'></td>
                    <td><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td><table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>$adh1</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>$adh2</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td width='15' height='15'><div align='center' class='tahoma s10 black'>-</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>$adi1</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>$adi2</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td colspan='5' valign='top'><div align='center' class='tahoma s7 black'>hour</div></td>
                            <td></td>
                            <td colspan='5' valign='top'><div align='center' class='tahoma s7 black'>min</div></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                    <td width='25'></td>
                    <td><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td><table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td class='r1 l1 b1 t1' width='17' height='17'><div align='center' class='tahoma s9 black'>$adam</div></td>
                            <td class='tahoma s9 black'>&nbsp;AM &nbsp;</td>
                          </tr>
                        </table></td>
                        <td width='10'></td>
                        <td><table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td class='r1 l1 b1 t1' width='17' height='17'><div align='center' class='tahoma s9 black'>$adpm</div></td>
                            <td class='tahoma s9 black'>&nbsp;PM &nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>

                  <tr>
                    <td><div align='left' class='tahoma s9 black bold'></div></td>
                    <td></td>
                    <td valign='center'><div align='left' class='tahoma s10 black'>c. Date Discharge</div></td>
                    <td width='10'></td>
                    <td><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td><table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>$dtm1</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>$dtm2</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td width='15' height='15'><div align='center' class='tahoma s10 black'>-</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>$dtd1</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>$dtd2</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td width='15' height='15'><div align='center' class='tahoma s10 black'>-</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>$dty1</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>$dty2</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>$dty3</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>$dty4</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td colspan='5' valign='top'><div align='center' class='tahoma s7 black'>month</div></td>
                            <td></td>
                            <td colspan='5' valign='top'><div align='center' class='tahoma s7 black'>day</div></td>
                            <td></td>
                            <td colspan='9' valign='top'><div align='center' class='tahoma s7 black'>year</div></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                    <td width='20'></td>


                    <td valign='center'><div align='left' class='tahoma s10 black'>d. Time Discharge</div></td>
                    <td width='10'></td>
                    <td><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td><table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>$dth1</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>$dth2</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td width='15' height='15'><div align='center' class='tahoma s10 black'>-</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>$dti1</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                            <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td class='b1' width='15' height='15'><div align='center' class='tahoma s10 black'>$dti2</div></td>
                              </tr>
                            </table></td>
                            <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='5' class='l1'></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td colspan='5' valign='top'><div align='center' class='tahoma s7 black'>hour</div></td>
                            <td></td>
                            <td colspan='5' valign='top'><div align='center' class='tahoma s7 black'>min</div></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                    <td></td>
                    <td><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td><table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td class='r1 l1 b1 t1' width='17' height='17'><div align='center' class='tahoma s9 black'>$dtam</div></td>
                            <td class='tahoma s9 black'>&nbsp;AM &nbsp;</td>
                          </tr>
                        </table></td>
                        <td width='10'></td>
                        <td><table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td class='r1 l1 b1 t1' width='17' height='17'><div align='center' class='tahoma s9 black'>$dtpm</div></td>
                            <td class='tahoma s9 black'>&nbsp;PM &nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
";
//---------------------------------------------------------------------------------------------------------------------------------------------------


echo "
                </table></td>
              </tr>



              <tr>
                <td colspan='2' height='5'></td>
              </tr>
              <tr>
                <td width='5'></td>
                <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td class='tahoma s9 black'><b>4. Patient Disposition:</b> (select only 1) </td>
                  </tr>
                  <tr>
                    <td $cursty onclick='opendispo()'><table border='0' width='100%' cellpadding='0' cellspacing='0'>

                      <tr>
                        <td width='10'></td>
                        <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td width='17' height='17' class='t1 b1 l1 r1'><div align='center' class='tahoma s9 black'>$disi</div></td>
                          </tr>
                        </table></td>
                        <td width='12'></td>
                        <td width='180'><table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td><div align='left' class='tahoma s10 black'>a. Improved</div></td>
                          </tr>
                        </table></td>
                        <td width='19'><table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td width='17' height='17' class='t1 b1 l1 r1'><div align='center' class='tahoma s9 black'>$dise</div></td>
                          </tr>
                        </table></td>
                        <td width='12'></td>
                        <td><table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='17'><div align='left' class='tahoma s10 black'>e. Expired</div></td>
                              </tr>
                            </table></td>
                            <td width='12'></td>
                            <td valign='top'><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
                              <tr>

                                <td><table border='0' cellpadding='0' cellspacing='0'>
                                  <tr>
                                    <td height='13' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td height='5' class='l1'></td>
                                      </tr>
                                    </table></td>
                                    <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td class='b1' width='15' height='13'><div align='center' class='tahoma s10 black'>$exm1</div></td>
                                      </tr>
                                    </table></td>
                                    <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td height='5' class='l1'></td>
                                      </tr>
                                    </table></td>
                                    <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td class='b1' width='15' height='13'><div align='center' class='tahoma s10 black'>$exm2</div></td>
                                      </tr>
                                    </table></td>
                                    <td valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td height='5' class='l1'></td>
                                      </tr>
                                    </table></td>
                                    <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td width='15' height='13'><div align='center' class='tahoma s10 black'>-</div></td>
                                      </tr>
                                    </table></td>
                                    <td valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td height='5' class='l1'></td>
                                      </tr>
                                    </table></td>
                                    <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td class='b1' width='15' height='13'><div align='center' class='tahoma s10 black'>$exd1</div></td>
                                      </tr>
                                    </table></td>
                                    <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td height='5' class='l1'></td>
                                      </tr>
                                    </table></td>
                                    <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td class='b1' width='15' height='13'><div align='center' class='tahoma s10 black'>$exd2</div></td>
                                      </tr>
                                    </table></td>
                                    <td valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td height='5' class='l1'></td>
                                      </tr>
                                    </table></td>
                                    <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td width='15' height='13'><div align='center' class='tahoma s10 black'>-</div></td>
                                      </tr>
                                    </table></td>
                                    <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td height='5' class='l1'></td>
                                      </tr>
                                    </table></td>
                                    <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td class='b1' width='15' height='13'><div align='center' class='tahoma s10 black'>$exy1</div></td>
                                      </tr>
                                    </table></td>
                                    <td valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td height='5' class='l1'></td>
                                      </tr>
                                    </table></td>
                                    <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td class='b1' width='15' height='13'><div align='center' class='tahoma s10 black'>$exy2</div></td>
                                      </tr>
                                    </table></td>
                                    <td valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td height='5' class='l1'></td>
                                      </tr>
                                    </table></td>
                                    <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td class='b1' width='15' height='13'><div align='center' class='tahoma s10 black'>$exy3</div></td>
                                      </tr>
                                    </table></td>
                                    <td valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td height='5' class='l1'></td>
                                      </tr>
                                    </table></td>
                                    <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td class='b1' width='15' height='13'><div align='center' class='tahoma s10 black'>$exy4</div></td>
                                      </tr>
                                    </table></td>
                                    <td valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td height='5' class='l1'></td>
                                      </tr>
                                    </table></td>
                                  </tr>
                                  <tr>
                                    <td colspan='5' valign='top'><div align='center' class='tahoma s7 black'>month</div></td>
                                    <td></td>
                                    <td colspan='5' valign='top'><div align='center' class='tahoma s7 black'>day</div></td>
                                    <td></td>
                                    <td colspan='9' valign='top'><div align='center' class='tahoma s7 black'>year</div></td>
                                  </tr>
                                </table></td>
                                <td width='20'></td>
                                <td><div align='left' class='tahoma s10 black'>Time:</div></td>
                                <td width='10'></td>
                                <td valign='top'><table border='0' cellpadding='0' cellspacing='0'>
                                  <tr>
                                    <td><table border='0' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td height='15' valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                                          <tr>
                                            <td height='5' class='l1'></td>
                                          </tr>
                                        </table></td>
                                        <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                                          <tr>
                                            <td class='b1' width='15' height='13'><div align='center' class='tahoma s10 black'>$exh1</div></td>
                                          </tr>
                                        </table></td>
                                        <td valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                                          <tr>
                                            <td height='5' class='l1'></td>
                                          </tr>
                                        </table></td>
                                        <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                                          <tr>
                                            <td class='b1' width='15' height='13'><div align='center' class='tahoma s10 black'>$exh2</div></td>
                                          </tr>
                                        </table></td>
                                        <td valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                                          <tr>
                                            <td height='5' class='l1'></td>
                                          </tr>
                                        </table></td>
                                        <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                                          <tr>
                                            <td width='15' height='13'><div align='center' class='tahoma s10 black'>-</div></td>
                                          </tr>
                                        </table></td>
                                        <td valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                                          <tr>
                                            <td height='5' class='l1'></td>
                                          </tr>
                                        </table></td>
                                        <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                                          <tr>
                                            <td class='b1' width='15' height='13'><div align='center' class='tahoma s10 black'>$exmn1</div></td>
                                          </tr>
                                        </table></td>
                                        <td valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                                          <tr>
                                            <td height='5' class='l1'></td>
                                          </tr>
                                        </table></td>
                                        <td valign='bottom'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                                          <tr>
                                            <td class='b1' width='15' height='13'><div align='center' class='tahoma s10 black'>$exmn2</div></td>
                                          </tr>
                                        </table></td>
                                        <td valign='bottom'><table border='0' cellpadding='0' cellspacing='0'>
                                          <tr>
                                            <td height='5' class='l1'></td>
                                          </tr>
                                        </table></td>
                                      </tr>
                                      <tr>
                                        <td colspan='5' valign='top'><div align='center' class='tahoma s7 black'>hour</div></td>
                                        <td></td>
                                        <td colspan='5' valign='top'><div align='center' class='tahoma s7 black'>min</div></td>
                                      </tr>
                                    </table></td>
                                  </tr>
                                </table></td>
                                <td width='10'></td>
                                <td><table border='0' cellpadding='0' cellspacing='0'>
                                  <tr>
                                    <td><table border='0' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td class='r1 l1 b1 t1' width='17' height='17'><div align='center' class='tahoma s9 black'>$exdtam</div></td>
                                        <td class='tahoma s9 black'>&nbsp;AM &nbsp;</td>
                                      </tr>
                                    </table></td>
                                    <td><table border='0' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td class='r1 l1 b1 t1' width='17' height='17'><div align='center' class='tahoma s9 black'>$exdtpm</div></td>
                                        <td class='tahoma s9 black'>&nbsp;PM &nbsp;</td>
                                      </tr>
                                    </table></td>
                                  </tr>
                                </table></td>

                              </tr>
                            </table></div></td>
                          </tr>
                        </table></td>
                      </tr>

                      <tr>
                        <td></td>
                        <td><table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td width='17' height='17' class='t1 b1 l1 r1'><div align='center' class='tahoma s9 black'>$disr</div></td>
                          </tr>
                        </table></td>
                        <td></td>
                        <td><div align='left' class='tahoma s10 black'>b. Recovered</div></td>
                        <td><table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td width='17' height='17' class='t1 b1 l1 r1'><div align='center' class='tahoma s9 black'>$dist</div></td>
                          </tr>
                        </table></td>
                        <td></td>
                        <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td width='110'><div align='left' class='tahoma s10 black'>f. Transferred/Referred</div></td>
                            <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='15' class='b1'><div align='center' class='tahoma s10 black'>&nbsp;</div></td>
                              </tr>
                              <tr>
                                <td><div align='center' class='tahoma s7 black'>Name of Referral Health Care Institution</div></td>
                              </tr>
                            </table></td>
                            <td width='5'></td>
                          </tr>
                        </table></td>
                      </tr>

                      <tr>
                        <td colspan='7' height='2'></td>
                      </tr>

                      <tr>
                        <td></td>
                        <td><table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td width='17' height='17' class='t1 b1 l1 r1'><div align='center' class='tahoma s9 black'>$dish</div></td>
                          </tr>
                        </table></td>
                        <td ></td>
                        <td colspan='2'><div align='left' class='tahoma s10 black'>c. Home/Discharged Against Medical Advise</div></td>
                        <td></td>
                        <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td width='30'></td>
                            <td class='b1' width='180'><div align='center' class='tahoma s10 black'>&nbsp;</div></td>
                            <td width='5'></td>
                            <td class='b1'><div align='center' class='tahoma s10 black'>&nbsp;</div></td>
                            <td width='5'></td>
                            <td class='b1' width='80'><div align='center' class='tahoma s10 black'>&nbsp;</div></td>
                            <td width='5'></td>
                            <td class='b1' width='50'><div align='center' class='tahoma s10 black'>&nbsp;</div></td>
                            <td width='5'></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td><div align='center' class='tahoma s7 black'>Building Number and Street Name</div></td>
                            <td></td>
                            <td><div align='center' class='tahoma s7 black'>City/Municipality</div></td>
                            <td></td>
                            <td><div align='center' class='tahoma s7 black'>Province</div></td>
                            <td></td>
                            <td><div align='center' class='tahoma s7 black'>Zip code</div></td>
                            <td></td>
                          </tr>
                        </table></td>
                      </tr>

                      <tr>
                        <td colspan='7' height='3'></td>
                      </tr>

                      <tr>
                        <td></td>
                        <td><table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td width='17' height='17' class='t1 b1 l1 r1'><div align='center' class='tahoma s9 black'>$disa</div></td>
                          </tr>
                        </table></td>
                        <td ></td>
                        <td colspan='2'><div align='left' class='tahoma s10 black'>d. Absconded</div></td>
                        <td></td>
                        <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td width='140'><div align='left' class='tahoma s10 black'>Reason/s for referral/transfer: </div></td>
                            <td class='b1'><div align='left' class='tahoma s10 black'></div></td>
                            <td width='5'></td>
                          </tr>
                        </table></td>
                      </tr>

                    </table></td>
                  </tr>

                </table></td>
              </tr>

              <tr>
                <td colspan='2' height='10'></td>
              </tr>

              <tr>
                <td width='5'></td>
                <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td width='140' class='tahoma s9 black bold'>5. Type of Accomodation:</td>
                    <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td><table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td class='r1 l1 b1 t1' width='17' height='17'><div align='center' class='tahoma s10 black'>$rmchk1</div></td>
                            <td class='tahoma s10 black' valign='bottom'>&nbsp;Private&nbsp;</td>
                          </tr>
                        </table></td>
                        <td width='10'></td>
                        <td><table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td class='r1 l1 b1 t1' width='17' height='17'><div align='center' class='tahoma s10 black'>$rmchk2</div></td>
                            <td class='tahoma s10 black' valign='bottom'>&nbsp;Non-Private (Charity/Service)&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></div></td>
                  </tr>
                  <tr>
                    <td height='3'></td>
                  </tr>
                </table></td>
              </tr>


            </table></div></td>
          </tr>

          <tr>
            <td colspan='3' class='t2' height='5'></td>
          </tr>


          <tr height='20'>
            <td class='b2'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
              <tr>
                <td width='5'></td>
                <td><div align='left' class='tahoma s9 black bold'>6. Admission Diagnosis/es:</div></td>
                <td width='5'></td>
              </tr>
              <tr>
                <td></td>
                <td height='30' valign='middle'><div align='left' class='tahoma s12 black'>$initialdiagnosis</div></td>
                <td></td>
              </tr>
              <tr>
                <td colspan='3' height='5'></td>
              </tr>
            </table></td>
          </tr>

          <tr>
            <td colspan='3' height='5'></td>
          </tr>
";
?>
