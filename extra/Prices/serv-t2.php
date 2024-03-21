<?php
  if(isset($_GET['laboratory'])){$lbl="Laboratory";$ads1="adsel";$ads2="aduns";$ads3="aduns";$ads4="aduns";$ads5="aduns";$ads6="aduns";$ads7="aduns";$ads8="aduns";$ads9="aduns";$setunit="LABORATORY";}
  else if(isset($_GET['xray'])){$lbl="Xray";$ads1="aduns";$ads2="adsel";$ads3="aduns";$ads4="aduns";$ads5="aduns";$ads6="aduns";$ads7="aduns";$ads8="aduns";$ads9="aduns";$setunit="XRAY";}
  else if(isset($_GET['ultrasound'])){$lbl="Ultrasound";$ads1="aduns";$ads2="aduns";$ads3="adsel";$ads4="aduns";$ads5="aduns";$ads6="aduns";$ads7="aduns";$ads8="aduns";$ads9="aduns";$setunit="ULTRASOUND";}
  else if(isset($_GET['2decho'])){$lbl="2D Echo";$ads1="aduns";$ads2="aduns";$ads3="aduns";$ads4="adsel";$ads5="aduns";$ads6="aduns";$ads7="aduns";$ads8="aduns";$ads9="aduns";$setunit="2D ECHO";}
  else if(isset($_GET['ctscan'])){$lbl="CT Scan";$ads1="aduns";$ads2="aduns";$ads3="aduns";$ads4="aduns";$ads5="adsel";$ads6="aduns";$ads7="aduns";$ads8="aduns";$ads9="aduns";$setunit="CT SCAN";}
  else if(isset($_GET['ecg'])){$lbl="ECG";$ads1="aduns";$ads2="aduns";$ads3="aduns";$ads4="aduns";$ads5="aduns";$ads6="adsel";$ads7="aduns";$ads8="aduns";$ads9="aduns";$setunit="ECG";}
  else if(isset($_GET['physicaltherapy'])){$lbl="Physical Therapy";$ads1="aduns";$ads2="aduns";$ads3="aduns";$ads4="aduns";$ads5="aduns";$ads6="aduns";$ads7="adsel";$ads8="aduns";$ads9="aduns";$setunit="PHYSICAL THERAPY";}
  else if(isset($_GET['heartstation'])){$lbl="Heart Station";$ads1="aduns";$ads2="aduns";$ads3="aduns";$ads4="aduns";$ads5="aduns";$ads6="aduns";$ads7="aduns";$ads8="adsel";$ads9="aduns";$setunit="HEARTSTATION";}
  else if(isset($_GET['eeg'])){$lbl="EEG";$ads1="aduns";$ads2="aduns";$ads3="aduns";$ads4="aduns";$ads5="aduns";$ads6="aduns";$ads7="aduns";$ads8="aduns";$ads9="adsel";$setunit="EEG";}
  else{$lbl="Laboratory";$ads1="adsel";$ads2="aduns";$ads3="aduns";$ads4="aduns";$ads5="aduns";$ads6="aduns";$ads7="aduns";$ads8="aduns";$ads9="aduns";$setunit="LABORATORY";}

echo "
                    <table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td valign='top'>
                          <table border='0' cellpaddingg='0' cellspacing='0'>
                            <tr>
                              <td><a href='?services&ads&laboratory$usr' style='text-decoration: none;'><div align='left' class='$ads1'>ADD LABORATORY</div></a></td>
                            </tr>
                            <tr>
                              <td><a href='?services&ads&xray$usr' style='text-decoration: none;'><div align='left' class='$ads2'>ADD XRAY</div></a></td>
                            </tr>
                            <tr>
                              <td><a href='?services&ads&ultrasound$usr' style='text-decoration: none;'><div align='left' class='$ads3'>ADD ULTRASOUND</div></a></td>
                            </tr>
                            <tr>
                              <td><a href='?services&ads&2decho$usr' style='text-decoration: none;'><div align='left' class='$ads4'>ADD 2D ECHO</div></a></td>
                            </tr>
                            <tr>
                              <td><a href='?services&ads&ctscan$usr' style='text-decoration: none;'><div align='left' class='$ads5'>ADD CT SCAN</div></a></td>
                            </tr>
                            <tr>
                              <td><a href='?services&ads&ecg$usr' style='text-decoration: none;'><div align='left' class='$ads6'>ADD ECG</div></a></td>
                            </tr>
                            <tr>
                              <td><a href='?services&ads&physicaltherapy$usr' style='text-decoration: none;'><div align='left' class='$ads7'>ADD PHYSICAL THERAPY</div></a></td>
                            </tr>
                            <tr>
                              <td><a href='?services&ads&heartstation$usr' style='text-decoration: none;'><div align='left' class='$ads8'>ADD HEARTSTATION</div></a></td>
                            </tr>
                            <tr>
                              <td><a href='?services&ads&eeg$usr' style='text-decoration: none;'><div align='left' class='$ads9'>ADD EEG</div></a></td>
                            </tr>
                          </table>
                        </td>
                        <td width='10'></td>
                        <td valign='top'><div align='left'>
";

  if(isset($_POST['save'])){
    $ndescription=mysqli_real_escape_string($conn,$_POST['description']);
    $nlotno=mysqli_real_escape_string($conn,$_POST['lotno']);
    $ncash=mysqli_real_escape_string($conn,$_POST['cash']);
    $ncharge=mysqli_real_escape_string($conn,$_POST['charge']);
    $nunit=mysqli_real_escape_string($conn,$_POST['nunit']);

    $xox=mysqli_real_escape_string($conn,$_GET['xox']);

    if($nunit=="2D ECHO"){$ncode="2D-".date("YmdHis");}
    else if($nunit=="CT SCAN"){$ncode="CT-".date("YmdHis");}
    else if($nunit=="ECG"){$ncode="EC-".date("YmdHis");}
    else if($nunit=="LABORATORY"){$ncode="LA-".date("YmdHis");}
    else if($nunit=="ULTRASOUND"){$ncode="UL-".date("YmdHis");}
    else if($nunit=="XRAY"){$ncode="XR-".date("YmdHis");}
    else if($nunit=="PHYSICAL THERAPY"){$ncode="PT-".date("YmdHis");}
    else if($nunit=="HEARTSTATION"){$ncode="HS-".date("YmdHis");}
    else if($nunit=="EEG"){$ncode="EE-".date("YmdHis");}

    //echo "INSERT INTO `receiving` (`code`, `description`, `sellingprice`, `lotno`, `unit`, `OPD`, `WARD`, `PRIVATE`, `pnf`, `itemname`) VALUES ('$ncode', '$ndescription', '$ncash', '$nlotno', '$nunit', '$ncash', '$ncharge', '$ncharge', 'PNDF', '$ndescription')<br />";
    mysqli_query($conn,"INSERT INTO `receiving` (`code`, `description`, `sellingprice`, `lotno`, `unit`, `OPD`, `WARD`, `PRIVATE`, `pnf`, `itemname`) VALUES ('$ncode', '$ndescription', '$ncash', '$nlotno', '$nunit', '$ncash', '$ncharge', '$ncharge', 'PNDF', '$ndescription')");
    //echo "INSERT INTO `productsmasterlist` (`code`, `philhealth`, `hmo`, `nonmed`, `company`, `opd`, `lotno`, `unit`) VALUES ('$ncode', '$ncharge', '$ncharge', '$ncash', '$ncharge', '$ncash', '$nlotno', '$nunit')";
    mysqli_query($conn,"INSERT INTO `productsmasterlist` (`code`, `philhealth`, `hmo`, `nonmed`, `company`, `opd`, `lotno`, `unit`) VALUES ('$ncode', '$ncharge', '$ncharge', '$ncash', '$ncharge', '$ncash', '$nlotno', '$nunit')");

    $elog="$ndescription|$ncode|Added New Service";
    mysqli_query($conn,"INSERT INTO `userlogs` (`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('$elog', '".base64_decode($xox)."', '".date("Y-m-d")."', '".date("H:i:s")."')");

echo "
                          <span style='font-family: arial;font-size: 14px;font-weight: bold;color: #229954;'>New service added!!!</span>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=?services&ads$usr'>";
  }
  else{
echo "
                          <form method='post'>
                            <table border='0' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td valign='middle'><div align='center' style='border: 3px solid #000000;border-radius: 5px;padding: 5px;'>
                                  <table border='0' cellpadding='0' cellspacing='0'>
                                    <tr>
                                      <td colspan='3'><div align='center' style='padding: 10px;font-family: arial;font-size: 14px;color: #1E8449;font-weight: bold;'>Add New $lbl Service</div></td>
                                    </tr>
                                    <tr>
                                      <td><div align='left' style='font-family: arial;font-size: 12px;font-weight: bold;'>Description</div></td>
                                      <td width='5'></td>
                                      <td><input type='text' class='inp' name='description' placeholder='Description' required autofocus /></td>
                                    </tr>
                                    <tr>
                                      <td colspan='3' height='5'></td>
                                    </tr>
";
    if($lbl=="Laboratory"){
echo "
                                    <tr>
                                      <td><div align='left' style='font-family: arial;font-size: 12px;font-weight: bold;'>Test Type</div></td>
                                      <td width='5'></td>
                                      <td><input type='text' class='inp' name='lotno' placeholder='Test Type (EG: hematology, chemistry, etc.)' /></td>
                                    </tr>
";
    }
    else{
echo "
                                    <input type='hidden' name='lotno' value='' />
";
    }

echo "
                                    <tr>
                                      <td colspan='3' height='5'></td>
                                    </tr>
                                    <tr>
                                      <td><div align='left' style='font-family: arial;font-size: 12px;font-weight: bold;'>Cash Price</div></td>
                                      <td width='5'></td>
                                      <td><input type='number' step='0.01' class='inp' name='cash' placeholder='Cash Price' required /></td>
                                    </tr>
                                    <tr>
                                      <td colspan='3' height='5'></td>
                                    </tr>
                                    <tr>
                                      <td><div align='left' style='font-family: arial;font-size: 12px;font-weight: bold;'>Charge Price</div></td>
                                      <td width='5'></td>
                                      <td><input type='number' step='0.01' class='inp' name='charge' placeholder='Charge Price' required /></td>
                                    </tr>
                                    <tr>
                                      <td colspan='3' height='5'></td>
                                    </tr>
                                    <tr>
                                      <td colspan='3'><div align='center' style='padding: 5px 0 5px 0;'><button type='submit' class='btn' style='width: 100px;height: 25px;font-size: 12px;' name='save'>Save</button></div></td>
                                    </tr>
                                  </table>
                                <input type='hidden' name='nunit' value='$setunit' />
                                </form>
";
  }

echo "
                              </div></td>
                            </tr>
                          </table>
                        </div></td>
                      </tr>
                    </table>
";
?>
