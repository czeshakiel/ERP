<?php
echo "
        <div class='row clearfix g-3'>
          <div class='col-sm-12'>
            <div class='card mb-1'>
              <div class='card-body'>
                <table border='0' style='width: 100%;' align='center' cellpadding='0' cellspacing='0'>
                  <tr>
                   <th colspan='8'><div align='left' style='font-size: 26px;font-weight: bold;color: #2980B9;'><u>$patientname</u></div></th>
                  </tr>
                  <tr>
                    <th colspan='8' height='30'><div align='left' style='font-size: 14px;font-weight: bold;'>ADDRESS: $pataddress</div></th>
                  </tr>
                  <tr>
                    <td width='16%'><div align='left' style='font-size: 15px;'>CASENO: </div></td>
                    <td width='17%'><div align='left' style='font-size: 14px;font-weight: bold;'>$caseno</div></td>
                    <td width='16%'><div align='left' style='font-size: 15px;'>HOSP. CASENO: </div></td>
                    <td width='18%'><div align='left' style='font-size: 14px;font-weight: bold;'>$employerno</div></td>
                    <td width='16%'><div align='left' style='font-size: 15px;'>AGE/ GENDER: </div></td>
                    <td width='17%'><div align='left' style='font-size: 14px;font-weight: bold;'>$age / $sex</div></td>
                  </tr>
                  <tr>
                    <td><div align='left' style='font-size: 15px;'>PATIENTID NO:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>$patientidno</div></td>
                    <td><div align='left' style='font-size: 15px;'>ROOM NO:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>$room</div></td>
                    <td><div align='left' style='font-size: 15px;'>SENIOR:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>$senior</div></td>
                  </tr>
                  <tr>
                    <td><div align='left' style='font-size: 15px;'>ATTENDING:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>$ap</div></td>
                    <td><div align='left' style='font-size: 15px;'>HMO:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>$hmo</div></td>
                    <td><div align='left' style='font-size: 15px;'>PHILHEALTH:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>$membership</div></td>
                  </tr>
                  <tr>
                    <td><div align='left' style='font-size: 15px;'>ADMITTING:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>$ad</div></td>
                    <td><div align='left' style='font-size: 15px;'>DATE/TIME ADMITTED:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>".date("M d, Y h:i A",strtotime("$dateadmitted $timeadmitted"))."</div></td>
                    <td><div align='left' style='font-size: 15px;'>DATE/TIME DISCHARGED:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>$ddt</div></td>
                  </tr>
                  <tr>
                    <td><div align='left' style='font-size: 15px;'>BIRTHDATE:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>".date("M d, Y",strtotime($birthdate))."</div></td>
                    <td><div align='left' style='font-size: 15px;'>LOGIN USER:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>$user</div></td>
                    <td><div align='left' style='font-size: 15px;'>STATUS:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>".ucfirst(mb_strtolower($adstatus))."</div></td>
                  </tr>
                  <tr>
                    <td colspan='6'><div align='left'>
                      <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td width='190'><div align='left' style='font-size: 15px;'>ADMITTING DIAGNOSIS:</div></td>
                          <td><div align='left' style='font-size: 14px;font-weight: bold;padding-left: 2px;'>$initialdiagnosis</div></td>
                        </tr>
                        <tr>
                          <td><div align='left' style='font-size: 15px;'>FINAL DIAGNOSIS:</div></td>
                          <td style='$bgrf'><div align='left' style='font-size: 14px;font-weight: bold;color: #FFFFFF;padding-left: 2px;'>$finaldiagnosis</div></td>
                        </tr>
                      </table>
                    </div></td>
                  </tr>
                  <tr>
                    <td height='10' colspan='6'></td>
                  </tr>
                  <tr>
                    <td colspan='6'><div style='border: 2px solid #000000;border-radius: 5px;'>
                      <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td width='50%' bgcolor='#5DADE2'>
                            <table border='0' width='100%' cellpadding='0' cellsapcing='0'>
                              <tr>
                                <td width='200'><div align='center' style='font-size: 15px;font-weight: bold;color: #FFFFFF;'>1st Case Rate</div></td>
                                <td class='l2' bgcolor='#FFFFFF'><div align='center' style='font-family: arial black;font-size: 40px;font-weight: bold;color: #5DADE2;'>$ficdrvs</div></td>
                                <td width='130' bgcolor='#FFFFFF'>
                                  <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                                    <tr>
                                      <td width='50' class='b1 l2'><div align='left' style='font-size: 11px;font-weight: bold;padding: 2px 3px;'>HCI</div></td>
                                      <td width='auto' class='b1 l1'><div align='right' style='font-size: 13px;font-weight: bold;padding: 2px 3px;'>$fhci</div></td>
                                    </tr>
                                    <tr>
                                      <td class='b2 l2'><div align='left' style='font-size: 11px;font-weight: bold;padding: 2px 3px;'>PF</div></td>
                                      <td class='b2 l1'><div align='right' style='font-size: 13px;font-weight: bold;padding: 2px 3px;'>$fpf</div></td>
                                    </tr>
                                    <tr>
                                      <td class='l2'><div align='left' style='font-size: 13px;padding: 2px 3px;font-weight: bold;'>Total</div></td>
                                      <td class='l1'><div align='right' style='font-size: 15px;font-weight: bold;padding: 2px 3px;'>$ftot</div></td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                          </td>
                          <td class='l2' width='50%'>
                            <table border='0' width='100%' cellpadding='0' cellsapcing='0'>
                              <tr>
                                <td width='200' bgcolor='#45B39D'><div align='center' style='font-size: 15px;font-weight: bold;color: #FFFFFF;'>2nd Case Rate</div></td>
                                <td class='l2'><div align='center' style='font-family: arial black;font-size: 40px;font-weight: bold;color: #45B39D;'>$sicdrvs</div></td>
                                <td width='130'>
                                  <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                                    <tr>
                                      <td width='50' class='b1 l2'><div align='left' style='font-size: 11px;font-weight: bold;padding: 2px 3px;'>HCI</div></td>
                                      <td width='auto' class='b1 l1'><div align='right' style='font-size: 13px;font-weight: bold;padding: 2px 3px;'>$shci</div></td>
                                    </tr>
                                    <tr>
                                      <td class='b2 l2'><div align='left' style='font-size: 11px;font-weight: bold;padding: 2px 3px;'>PF</div></td>
                                      <td class='b2 l1'><div align='right' style='font-size: 13px;font-weight: bold;padding: 2px 3px;'>$spf</div></td>
                                    </tr>
                                    <tr>
                                      <td class='l2'><div align='left' style='font-size: 13px;padding: 2px 3px;font-weight: bold;'>Total</div></td>
                                      <td class='l1'><div align='right' style='font-size: 15px;font-weight: bold;padding: 2px 3px;'>$stot</div></td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </div></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class='row clearfix g-3'>
          <div class='col-sm-12'>
            <div class='card mb-1'>
";

//-------------------------------------------------------------------------------------------------
if(trim($adremarks)!=""){
echo "
              <div class='card-body' align='center' style='background-color: #145A32;color: #FFFFFF;padding: 2px;'>
                <span style='font-size: 14px;font-weight: bold;'>REMARKS: ".mb_strtoupper(trim($adremarks))."</span>
              </div>

";
}
//-------------------------------------------------------------------------------------------------

//-------------------------------------------------------------------------------------------------
$pbsql=mysqli_query($conn,"SELECT * FROM `patientblacklist` WHERE `ln` LIKE '$lname' AND `fn` LIKE '$fname' ANd `mn` LIKE '$mname' AND `sf` LIKE '$suffix'");
$pbcount=mysqli_num_rows($pbsql);

if($pbcount>0){
  $pbfetch=mysqli_fetch_array($pbsql);
  $pbremarks=$pbfetch['remarks'];

echo "
              <div class='card-body' align='center' style='background-color: #FF0000;color: #FFFFFF;padding: 2px;'>
                <span style='font-size: 14px;font-weight: bold;'>PATIENT IS BLACK LISTED!!!</span><br />
                <span style='font-size: 12px;font-weight: bold;'>Reason: $pbremarks</span>
              </div>

";
}
//-------------------------------------------------------------------------------------------------

//-------------------------------------------------------------------------------------------------
$kaxsql=mysqli_query($conn,"SELECT `identity` FROM `admission` WHERE `caseno`='$caseno'");
$kaxfetch=mysqli_fetch_array($kaxsql);
$kaxdocom=$kaxfetch['identity'];

if($kaxdocom=="Complied"){
echo "
              <div class='card-body' align='center' style='background-color: #8A33FF;color: #FFFFFF;padding: 2px;'>
                <span style='font-size: 14px;font-weight: bold;'>PATIENT'S DOCUMENTS FULLY COMPLIED!!!</span><br />
              </div>
";
}
else if($kaxdocom=="Actual Bill"){
echo "
              <div class='card-body' align='center' style='background-color: #F033FF;color: #FFFFFF;padding: 2px;'>
                <span style='font-size: 14px;font-weight: bold;'>ACTUAL BILL IS SET ACTIVE!!!</span><br />
              </div>
";
}
//-------------------------------------------------------------------------------------------------

echo "
            </div>
          </div>
        </div>
";
?>
