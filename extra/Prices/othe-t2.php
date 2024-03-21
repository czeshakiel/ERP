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

    $rnd=strtoupper(substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 3));
    $ncode="OTH-".date("YmdHis").$rnd;

    //echo "INSERT INTO `receiving` (`code`, `description`, `sellingprice`, `lotno`, `unit`, `OPD`, `WARD`, `PRIVATE`, `pnf`, `itemname`) VALUES ('$ncode', '$ndescription', '$ncash', '$nlotno', '$nunit', '$ncash', '$ncharge', '$ncharge', 'PNDF', '$ndescription')<br />";
    mysqli_query($conn,"INSERT INTO `receiving` (`code`, `description`, `sellingprice`, `lotno`, `unit`, `prodtype`, `OPD`, `WARD`, `PRIVATE`, `pnf`, `itemname`) VALUES ('$ncode', '$ndescription', '$ncash', '$nlotno', '$nunit', '$nunit', '$ncash', '$ncharge', '$ncharge', 'PNDF', '$ndescription')");
    //echo "INSERT INTO `productsmasterlist` (`code`, `philhealth`, `hmo`, `nonmed`, `company`, `opd`, `lotno`, `unit`) VALUES ('$ncode', '$ncharge', '$ncharge', '$ncash', '$ncharge', '$ncash', '$nlotno', '$nunit')";
    mysqli_query($conn,"INSERT INTO `productsmasterlist` (`code`, `philhealth`, `hmo`, `nonmed`, `company`, `opd`, `lotno`, `unit`) VALUES ('$ncode', '$ncharge', '$ncharge', '$ncash', '$ncharge', '$ncash', '$nlotno', '$nunit')");

    $elog="$ndescription|$ncode|Added New Item/Charges";
    mysqli_query($conn,"INSERT INTO `userlogs` (`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('$elog', '".base64_decode($xox)."', '".date("Y-m-d")."', '".date("H:i:s")."')");

echo "
                          <span style='font-family: arial;font-size: 14px;font-weight: bold;color: #229954;'>New item/charges added!!!</span>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=?others&ads$usr'>";
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
                                      <td><div align='left' style='font-family: arial;font-size: 12px;font-weight: bold;'>Unit/Type</div></td>
                                      <td width='5'></td>
                                      <td>
                                        <select id='selsearch' name='nunit' placeholder='Select Unit' style='width: 263px;border: 2px solid #000000;' required>
                                          <option></option>
";

    $zvsql=mysqli_query($conn,"SELECT `unit` FROM `receiving` WHERE `unit` NOT LIKE '%medicine%' AND `unit` NOT LIKE '%PHARMACY%' AND `unit` NOT LIKE '%ACCOUNTABLE%' AND `unit` NOT LIKE '%-SUPPLIES%' AND `unit` NOT LIKE '%LABORATORY SUPPLIES%' AND `unit` NOT LIKE 'GENERAL SUPPLIES' AND `unit` NOT LIKE '%CSR/KIT%' AND `unit` NOT LIKE 'RADIOLOGY SUPPLIES' AND `unit` NOT LIKE 'RESPIRATORY SUPPLIES' AND `unit` NOT LIKE 'STERILIZATION SUPPLIES' AND `unit` NOT LIKE 'ULTRASOUND SUPPLIES' AND `unit` NOT LIKE 'PT SUPPLIES' AND `unit` NOT LIKE 'PLUMBING' AND `unit` NOT LIKE '%OFFICE%%SUPPLIES%' AND `unit` NOT LIKE '%Nonmedical Supplies%' AND `unit` NOT LIKE 'HEART STATION SUPPLIES' AND `unit` NOT LIKE 'LAUNDRY SUPPLIES' AND `unit` NOT LIKE 'ELECTRICAL SUPPLIES' AND `unit` NOT LIKE 'CT SCAN SUPPLIES' AND `unit` NOT LIKE 'Housekeeping Supplies' AND `unit` NOT LIKE 'Equipment' AND `unit` NOT LIKE 'COMPUTER EQUIPMENT AND ACCESS' AND `unit` NOT LIKE 'HOSPITAL EQUIPMENT' AND `unit` NOT LIKE 'COMPUTER SUPPLIES' AND `unit` NOT LIKE 'LAUNDRY' AND `unit` NOT LIKE 'CENTRAL SUPPLIES' AND `unit` NOT LIKE '%MEDICAL SURGICAL SUPPLIES%' AND `unit` NOT LIKE 'MISCELLANEOUS SUPPLIES' AND `unit` NOT LIKE 'HOSPITAL CSR KIT' AND `unit` NOT LIKE 'ECG SUPPLIES' AND `unit` NOT LIKE '%ECG SUPPLIES%' AND `unit` NOT LIKE '%DIALYSIS%' AND `unit` NOT LIKE 'NEWBORN SCREENING SUPPLIES' AND `unit` NOT LIKE 'OTHERS' AND `unit` NOT LIKE '2D ECHO' AND `unit` NOT LIKE 'CT SCAN' AND `unit` NOT LIKE 'ECG' AND `unit` NOT LIKE 'LABORATORY' AND `unit` NOT LIKE 'ULTRASOUND' AND `unit` NOT LIKE 'XRAY' AND `unit` NOT LIKE 'PHYSICAL THERAPY' AND `unit` NOT LIKE 'HEARTSTATION' AND `unit` NOT LIKE 'EEG' AND `unit` NOT LIKE 'MEDICAL SUPPLIES' AND `unit` NOT LIKE '' GROUP BY `unit` ORDER BY `unit`");
    while($zvfetch=mysqli_fetch_array($zvsql)){
      $addunit=$zvfetch['unit'];

echo "
                                          <option>$addunit</option>
";
    }
echo "
                                        </select>
                                      </td>
                                    </tr>
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
