<?php
echo "
                    <table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
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
                                      <td colspan='3'><div align='center' style='padding: 10px;font-family: arial;font-size: 14px;color: #1E8449;font-weight: bold;'>Add New Item</div></td>
                                    </tr>
                                    <tr>
                                      <td><div align='left' style='font-family: arial;font-size: 12px;font-weight: bold;'>Description</div></td>
                                      <td width='5'></td>
                                      <td><input type='text' class='inp' name='description' placeholder='Description' required autofocus /></td>
                                    </tr>
                                    <tr>
                                      <td colspan='3' height='5'></td>
                                    </tr>
                                    <input type='hidden' name='lotno' value='' />
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
