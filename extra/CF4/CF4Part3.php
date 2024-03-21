<link href="res/ico/favicon.png" rel="shortcut icon" type="image/x-icon" />
<link href="res/css/normalize.css" rel="stylesheet" type="text/css" />
<link href="res/css/omis.css" rel="stylesheet" type="text/css" />
<link href="res/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="res/css/styles.css" rel="stylesheet" type="text/css" />
<link href="res/css/jquery-ui-1.11.4.css" rel="stylesheet">
<link href="../MedMatrixeClaims/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="res/datatable/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />

<?php
include('function.php');
include('function_global.php');

if(!isset($_POST['savep3'])){
  $acsql=mysqli_query($conncf4,"SELECT * FROM `pepert` WHERE `caseno`='$caseno'");
  $account=mysqli_num_rows($acsql);

  if($account==0){
    $bp="/";
    $temp="";
    $patientadmit="Ambulatory";

    $bpr=str_replace("/","-",$bp);
    if($bp!=""){
      if(strpos($bp, "/")!== false){
        $bps=preg_split("/\-/",$bpr);
      }
    }

    if($patientadmit=="Ambulatory"){$gsa="checked='checked'";$gsb="";$gsval="";}else{$gsa="";$gsb="checked='checked'";$gsval="$patientadmit";}

    $respiratoryrate="";
    $heartrate="";
    $height="";
    $weight="";
  }
  else{
    $acfetch=mysqli_fetch_array($acsql);
    $bps[0]=$acfetch['pSystolic'];
    $bps[1]=$acfetch['pDiastolic'];
    $temp=$acfetch['pTemp'];
    $respiratoryrate=$acfetch['pRr'];
    $heartrate=$acfetch['pHr'];
    $height=$acfetch['pHeight'];
    $weight=$acfetch['pWeight'];

    $aesql=mysqli_query($conncf4,"SELECT `pGenSurveyId`, `pGenSurveyRem` FROM `pegensurvey` WHERE `caseno`='$caseno'");
    $aefetch=mysqli_fetch_array($aesql);
    $pGenSurveyId=$aefetch['pGenSurveyId'];
    $pGenSurveyRem=$aefetch['pGenSurveyRem'];

    if($pGenSurveyId=="1"){$gsa="checked='checked'";$gsb="";$gsval="";}
    else{$gsa="";$gsb="checked='checked'";$gsval=$pGenSurveyRem;}
  }

  $pespsql=mysqli_query($conncf4,"SELECT * FROM `pespecific` WHERE `caseno`='$caseno'");
  $pespfetch=mysqli_fetch_array($pespsql);
  $aa=$pespfetch["pHeentRem"];
  $bb=$pespfetch["pChestRem"];
  $cc=$pespfetch["pHeartRem"];
  $dd=$pespfetch["pAbdomenRem"];
  $ee=$pespfetch["pGuRem"];
  $ff=$pespfetch["pSkinRem"];
  $gg=$pespfetch["pNeuroRem"];

  $listHeents = listHeent();
  $listChests = listChest();
  $listHearts = listHeart();
  $listAbs = listAbdomen();
  $listNeuro = listNeuro();
  $listGenitourinary = listGenitourinary();
  $listRectal = listDigitalRectal();
  $listSkinExtremities = listSkinExtremities();

  $adate="20200301";
  $cf2sql=mysqli_query($conn,"SELECT `dateadmit` FROM `admission` WHERE `caseno`='$caseno'");
  $cf2count=mysqli_num_rows($cf2sql);
  if($cf2count!=0){
    $cf2fetch=mysqli_fetch_array($cf2sql);
    $adat=preg_split("/\-/",$cf2fetch['dateadmit']);
    $adate=$adat[0].$adat[1].$adat[2];
  }

//---------------------------------------------------------------------------------------------------------------------------------------------------

echo "
<div align='center'>
  <form method='post'>
    <table width='100%' border='0' cellpadding='0' cellspaicng='0'>
      <tr>
        <td>
          <table border='0' style='width: 100%' class='table-condensed'>
            <col style='width: 35%;'>
            <col style='width: 65%;'>
            <tr>
              <td colspan='2'>
                <div class='alert alert-success' style='margin-bottom: 0px'>
                  <label style='color:red;'>*</label><strong style='font-size: 16px'>IV. PHYSICAL EXAMINATION ON ADMISSION - PERTINENT FINDINGS PER SYSTEM</strong>
                </div>
              </td>
            </tr>
            <tr>
              <td colspan='2' height='10'></td>
            </tr>
            <tr>
              <td colspan='2' style='vertical-align: top;'>
                <table width='100%'>
                  <tr>
                    <td><label style='color:red;'>*</label><label for='txtMedHistBPSystolic' title='Blood Pressure'>BP:</label></td>
                    <td>
                      <label class='form-inline'>
                        <table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td><input type='number' name='txtPhExSystolic' pattern='.{3}' maxlength='3' class='form-control' style='width: 70px;' value='".$bps[0]."' autofocus required /></td>
                            <td><div style='padding: 0 5px;'>/</div></td>
                            <td><input type='number' name='txtPhExBPDiastolic' maxlength='3' class='form-control' style='width: 70px;' value='".$bps[1]."' required /></td>
                            <td><div style='padding: 0 5px;'>mmHg</div></td>
                          </tr>
                        </table>
                      </label>
                    </td>
                    <td><label style='color:red;'>*</label><label for='txtPhExHeartRate' title='Heart Rate'>HR:</label></td>
                    <td>
                      <label class='form-inline'>
                        <table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td><input type='number' name='txtPhExHeartRate' maxlength='3' class='form-control' style='width:100px;' value='$heartrate' required /></td>
                            <td><div style='padding: 0 5px;'>/min</div></td>
                          </tr>
                        </table>
                      </label>
                    </td>
                    <td><label style='color:red;'>*</label><label for='txtPhExRespiratoryRate' title='Respiratory Rate'>RR:</label></td>
                    <td>
                      <label class='form-inline'>
                        <table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td><input type='number' name='txtPhExRespiratoryRate' maxlength='3' class='form-control' style='width:100px;' value='$respiratoryrate' required /></td>
                            <td><div style='padding: 0 5px;'>/min</div></td>
                          </tr>
                        </table>
                      </label>
                    </td>
                    <td><label style='color:red;'>*</label><label for='txtPhExTemp' title='Temperature'>Temp.:</label></td>
                    <td>
                      <label class='form-inline'>
                        <table bordedr='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td><input type='text' name='txtPhExTemp' maxlength='4' class='form-control' style='width:100px;' value='$temp' required /></td>
                            <td><div style='padding: 0 5px;'>&#176;C</div></td>
                          </tr>
                        </table>
                      </label>
                    </td>
                  </tr>
                  <tr>
                    <td colspan='8' height='10'></td>
                  </tr>
";

  if($adate>=20200301){
echo "
                  <tr>
                    <td></td>
                    <td></td>
                    <td><label style='color:red;'>*</label><label for='txtPhExHeight' title='Height'>Height:</label></td>
                    <td>
                      <table border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td>
                            <label class='form-inline'>
                              <table border='0' cellpadding='0' cellspacing='0'>
                                <tr>
                                  <td><input type='text' name='txtPhExHeight' maxlength='5' class='form-control' style='width:100px;' value='$height' required /></td>
                                  <td><div style='padding: 0 5px;'>cm</div></td>
                                </tr>
                              </table>
                            </label>
                          </td>
                          <td width='10'></td>
                          <td><span style='color: #026AAA;font-weight: bold;cursor: pointer;' title='Height Calculator'";?> onclick="<?php echo "window.open('HeightCalculator.php', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=300,left=700,width=600,height=250');"; ?>" <?php echo "><i class='fa fa-calculator'></i></span></td>
                        </tr>
                      </table>
                    </td>
                    <td><label style='color:red;'>*</label><label for='txtPhExWeight' title='Weight'>Weight:</label></td>
                    <td>
                      <label class='form-inline'>
                        <table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td><input type='text' name='txtPhExWeight' id='txtPhExWeight' maxlength='5' class='form-control' style='width:100px;' onkeypress='return isNumberKey(event);' value='$weight' required /></td>
                            <td><div style='padding: 0 5px;'>kg</div></td>
                          </tr>
                        </table>
                      </label>
                    </td>
                    <td></td>
                    <td></td>
                  </tr>
";
  }
  else{
echo "
                  <input type='hidden' name='txtPhExHeight' value='' />
                  <input type='hidden' name='txtPhExWeight' value='' />
";
  }

echo "
                </table>
              </td>
            </tr>
            <tr>
              <td colspan='2'>
                <table>
                  <tr>
                    <td><label style='color:red;margin-top:20px'>*</label><label for='txtGenSurvey' title='General Survey' style='margin-top:20px;'>General Survey:</label></td>
                    <td>
                      <label onclick='unsetreq()'>
                        <table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td><input type='radio' name='pGenSurvey' value='1' id='pGenSurvey_1' style='cursor: pointer; float: left;margin:20px 0px 0px 5px;' $gsa /></td>
                            <td><label for='pGenSurvey_1' style='font-weight: normal; cursor: pointer; float: left; margin: 20px 5px 0px 5px; '>Awake and alert</label></td>
                          </tr>
                        </table>
                      </label>
                    </td>
                    <td>
                      <label onclick='setreq()'>
                        <table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td><input type='radio' name='pGenSurvey' value='2' id='pGenSurvey_2' style='cursor: pointer; float: left;margin:20px 0px 0px 10px;' $gsb /></td>
                            <td><label for='pGenSurvey_2' style='font-weight: normal; cursor: pointer; float: left; margin: 20px 5px 0px 5px; '>Altered Sensorium</label></td>
                          </tr>
                        </table>
                      </label>
                    </td>
                    <td>
                      <input type='text' name='pGenSurveyRemarks' value='$gsval' id='pGenSurveyRem' class='form-control' style='margin:20px 0px 0px 5px;text-transform: uppercase;width: 500px;color: red;' maxlength='500' placeholder='Remarks (Required if Altered Sensorium is selected)' autocomplete='off' />
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td colspan='2' height='10'></td>
            </tr>

            <tr id='heent_info'>
              <td>
                <h5><label style='color:red;'>*</label><u style='font-weight: bold;'>A. HEENT</u></h5>
                <table style='margin: 5px 0px 0px 20px; text-align: left;'>
";

  $heentcount=0;
  $heenten=0;
  foreach ($listHeents as $pLibHEENT) {
    $heentcount++;
    $asql=mysqli_query($conncf4,"SELECT `pHeentId` FROM `pemisc` WHERE `pHeentId`='".$pLibHEENT['HEENT_ID']."' AND `caseno`='$caseno'");
    $acount=mysqli_num_rows($asql);

    if($acount!=0){
      if($pLibHEENT['HEENT_DESC']=="Essentially Normal"){$as="checked";$heenten+=1;}
      else{
        if($heenten==0){$as="checked";}
        else{$as="disabled";}
      }
    }
    else{
      if($heenten==0){$as="";}
      else{$as="disabled";}
    }

echo "
                  <tr>
                    <td style='width: 250px;'>
                      <label onclick='disheent()'>
                        <table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td><input type='checkbox' name='heent[]' id='heent$heentcount' value='".$pLibHEENT['HEENT_ID']."' $as style='cursor: pointer;float: left;' onclick='disheent()' /></td>
                            <td width='3'></td>
                            <td><div style='font-weight: normal;cursor: pointer;float: left;' onclick='disheent()'>".$pLibHEENT['HEENT_DESC']."</div></td>
                          </tr>
                        </table>
                      </label>
                    </td>
                  </tr>
";
  }

echo "
                </table>
              </td>
              <td>
                <label>Remarks: <span style='font-size: 10px;color: red;'>(If Others is checked.)</span></label><br/>
                <textarea name='heent_remarks' id='heent_remarks' class='form-control' style='width: 500px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase; resize: none;' autocomplete='off' axlength='500' rows='3'>$aa</textarea>
              </td>
            </tr>
            <tr id='chest_lungs_info'>
              <td>
                <h5><label style='color:red;'>*</label><u style='font-weight: bold;'>B. Chest/Lungs</u></h5>
                <table style='margin: 5px 0px 0px 20px; text-align: left;'>
";

  $chestcount=0;
  $chesten=0;
  foreach ($listChests as $pLibChest) {
    $chestcount++;
    $bsql=mysqli_query($conncf4,"SELECT `pChestId` FROM `pemisc` WHERE `pChestId`='".$pLibChest['CHEST_ID']."' AND `caseno`='$caseno'");
    $bcount=mysqli_num_rows($bsql);

    if($bcount!=0){
      if($pLibChest['CHEST_DESC']=="Essentially normal"){$bs="checked";$chesten+=1;}
      else{
        if($chesten==0){$bs="checked";}
        else{$bs="disabled";}
      }
    }
    else{
      if($chesten==0){$bs="";}
      else{$bs="disabled";}
    }

echo "
                  <tr>
                    <td style='width: 250px;'>
                      <label onclick='dischest()'>
                        <table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td><input type='checkbox' name='chest[]' id='chest$chestcount' value='".$pLibChest['CHEST_ID']."' $bs style='cursor: pointer;float: left;' onclick='dischest()' /></td>
                            <td width='3'></td>
                            <td><div style='font-weight: normal;cursor: pointer;float: left;' onclick='dischest()'>".$pLibChest['CHEST_DESC']."</div></td>
                          </tr>
                        </table>
                      </label>
                    </td>
                  </tr>
";
  }

echo "
                </table>
              </td>
              <td>
                <label>Remarks: <span style='font-size: 10px;color: red;'>(If Others is checked.)</span></label><br/>
                <textarea name='chest_lungs_remarks' id='chest_lungs_remarks' class='form-control' style='width: 500px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase; resize: none;' autocomplete='off' rows='3' maxlength='500'>$bb</textarea>
              </td>
            </tr>
            <tr id='heart_info'>
              <td>
                <h5><label style='color:red;'>*</label><u style='font-weight: bold;'>C. CVS</u></h5>
                <table style='margin: 5px 0px 0px 20px; text-align: left;'>
";

  $heartcount=0;
  $hearten=0;
  foreach ($listHearts as $pLibHeart) {
    $heartcount++;
    $csql=mysqli_query($conncf4,"SELECT `pHeartId` FROM `pemisc` WHERE `pHeartId`='".$pLibHeart['HEART_ID']."' AND `caseno`='$caseno'");
    $ccount=mysqli_num_rows($csql);

    if($ccount!=0){
      if($pLibHeart['HEART_DESC']=="Essentially normal"){$cs="checked";$hearten+=1;}
      else{
        if($hearten==0){$cs="checked";}
        else{$cs="disabled";}
      }
    }
    else{
      if($hearten==0){$cs="c";}
      else{$cs="disabled";}
    }

echo "
                  <tr>
                    <td style='width: 250px;'>
                      <label onclick='disheart()'>
                        <table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td><input type='checkbox' name='heart[]' id='heart$heartcount' value='".$pLibHeart['HEART_ID']."' $cs style='cursor: pointer;float: left;' onclick='disheart()' /></td>
                            <td width='3'></td>
                            <td><div style='font-weight: normal;cursor: pointer;float: left;' onclick='disheart()'>".$pLibHeart['HEART_DESC']."</div></td>
                          </tr>
                        </table>
                      </label>
                    </td>
                  </tr>
";
  }

echo "
                </table>
              </td>
              <td>
                <label>Remarks: <span style='font-size: 10px;color: red;'>(If Others is checked.)</span></label><br/>
                <textarea name='heart_remarks' id='heart_remarks' class='form-control' style='width: 500px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase; resize: none;' autocomplete='off' rows='3' maxlength='500'>$cc</textarea>
              </td>
            </tr>

            <tr id='abdomen_info'>
              <td>
                <h5><label style='color:red;'>*</label><u style='font-weight: bold;'>D. Abdomen</u></h5>
                <table style='margin: 5px 0px 0px 20px; text-align: left;'>
";

  $abdomencount=0;
  $abdomenen=0;
  foreach ($listAbs as $pLibAbdomen) {
    $abdomencount++;
    $dsql=mysqli_query($conncf4,"SELECT `pAbdomenId` FROM `pemisc` WHERE `pAbdomenId`='".$pLibAbdomen['ABDOMEN_ID']."' AND `caseno`='$caseno'");
    $dcount=mysqli_num_rows($dsql);

    if($dcount!=0){
      if($pLibAbdomen['ABDOMEN_DESC']=="Essentially normal"){$ds="checked";$abdomenen+=1;}
      else{
        if($abdomenen==0){$ds="checked";}
        else{$ds="disabled";}
      }
    }
    else{
      if($abdomenen==0){$ds="";}
      else{$ds="disabled";}
    }

echo "
                  <tr>
                    <td style='width: 250px;'>
                      <label onclick='disabdomen()'>
                        <table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td><input type='checkbox' name='abdomen[]' id='abdomen$abdomencount' value='".$pLibAbdomen['ABDOMEN_ID']."' $ds style='cursor: pointer;float: left;' onclick='disabdomen()' /></td>
                            <td width='3'></td>
                            <td><div style='font-weight: normal;cursor: pointer;float: left;' onclick='disabdomen()'>".$pLibAbdomen['ABDOMEN_DESC']."</div></td>
                          </tr>
                        </table>
                      </label>
                    </td>
                  </tr>
";
  }

echo "
                </table>
              </td>
              <td>
                <label>Remarks: <span style='font-size: 10px;color: red;'>(If Others is checked.)</span></label><br/>
                <textarea name='abdomen_remarks' id='abdomen_remarks' class='form-control' style='width: 500px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase; resize: none;' autocomplete='off' rows='3' maxlength='500'>$dd</textarea>
              </td>
            </tr>

            <tr id='gu_info'>
              <td>
                <h5><label style='color:red;'>*</label><u style='font-weight: bold;'>E. GU (IE)</u></h5>
                <table style='margin: 5px 0px 0px 20px; text-align: left;'>
";

  $guicount=0;
  $guien=0;
  foreach ($listGenitourinary  as $pLibGU) {
    $guicount++;
    $esql=mysqli_query($conncf4,"SELECT `pGuId` FROM `pemisc` WHERE `pGuId`='".$pLibGU['GU_ID']."' AND `caseno`='$caseno'");
    $ecount=mysqli_num_rows($esql);

    if($ecount!=0){
      if($pLibGU['GU_DESC']=="Essentially normal"){$es="checked";$guien+=1;}
      else{
        if($guien==0){$es="checked";}
        else{$es="disabled";}
      }
    }
    else{
      if($guien==0){$es="";}
      else{$es="disabled";}
    }

echo "
                  <tr>
                    <td style='width: 250px;'>
                      <label onclick='disgui()'>
                        <table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td><input type='checkbox' name='genitourinary[]' id='gui$guicount' value='".$pLibGU['GU_ID']."' $es style='cursor: pointer;float: left;' onclick='disgui()' /></td>
                            <td width='3'></td>
                            <td><div style='font-weight: normal;cursor: pointer;float: left;' onclick='disgui()'>".$pLibGU['GU_DESC']."</div></td>
                          </tr>
                        </table>
                      </label>
                    </td>
                  </tr>
";
  }

echo "
                </table>
              </td>
              <td>
                <label>Remarks: <span style='font-size: 10px;color: red;'>(If Others is checked.)</span></label><br/>
                <textarea name='gu_remarks' id='gu_remarks' class='form-control' style='width: 500px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase; resize: none;' autocomplete='off' rows='3' maxlength='500'>$ee</textarea>
              </td>
            </tr>

            <tr id='skin_extremities_info'>
              <td>
                <h5><label style='color:red;'>*</label><u style='font-weight: bold;'>F. Skin/Extremities</u></h5>
                <table style='margin: 5px 0px 0px 20px; text-align: left;'>
";

  $skincount=0;
  $skinen=0;
  foreach ($listSkinExtremities as $pLibExtremities) {
    $skincount++;
    $fsql=mysqli_query($conncf4,"SELECT `pSkinId` FROM `pemisc` WHERE `pSkinId`='".$pLibExtremities['SKIN_ID'] ."' AND `caseno`='$caseno'");
    $fcount=mysqli_num_rows($fsql);

    if($fcount!=0){
      if($pLibExtremities['SKIN_DESC']=="Essentially normal"){$fs="checked";$skinen+=1;}
      else{
        if($skinen==0){$fs="checked";}
        else{$fs="disabled";}
      }
    }
    else{
      if($skinen==0){$fs="";}
      else{$fs="disabled";}
    }

echo "
                  <tr>
                    <td style='width: 250px;'>
                      <label onclick='disskin()'>
                        <table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td><input type='checkbox' name='skinExtremities[]' id='skin$skincount' value='".$pLibExtremities['SKIN_ID']."' $fs style='cursor: pointer;float: left;' onclick='disskin()' /></td>
                            <td width='3'></td>
                            <td><div style='font-weight: normal;cursor: pointer;float: left;' onclick='disskin()'>".$pLibExtremities['SKIN_DESC']."</div></td>
                          </tr>
                        </table>
                      </label>
                    </td>
                  </tr>
";
  }

echo "
                </table>
              </td>
              <td>
                <label>Remarks: <span style='font-size: 10px;color: red;'>(If Others is checked.)</span></label><br/>
                <textarea name='skinExtremities_remarks' id='extremities_remarks' class='form-control' style='width: 500px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase; resize: none;' autocomplete='off' rows='3' maxlength='500'>$ff</textarea>
              </td>
            </tr>

            <tr id='neuro_info'>
              <td>
                <h5><label style='color:red;'>*</label><u style='font-weight: bold;'>G. Neurological Examination</u></h5>
                <table style='margin: 5px 0px 0px 20px; text-align: left;'>
";

  $neurocount=0;
  $neuroen=0;
  foreach ($listNeuro as $pLibNeuro) {
    $neurocount++;
    $gsql=mysqli_query($conncf4,"SELECT `pNeuroId` FROM `pemisc` WHERE `pNeuroId`='".$pLibNeuro['NEURO_ID'] ."' AND `caseno`='$caseno'");
    $gcount=mysqli_num_rows($gsql);

    if($gcount!=0){
      if($pLibNeuro['NEURO_DESC']=="Essentially normal"){$gs="checked";$neuroen+=1;}
      else{
        if($neuroen==0){$gs="checked";}
        else{$gs="disabled";}
      }
    }
    else{
      if($neuroen==0){$gs="";}
      else{$gs="disabled";}
    }

echo "
                  <tr>
                    <td style='width: 250px;'>
                      <label onclick='disneuro()'>
                        <table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td><input type='checkbox' name='neuro[]' id='neuro$neurocount' value='".$pLibNeuro['NEURO_ID']."' $gs style='cursor: pointer;float: left;' onclick='disneuro()' /></td>
                            <td width='3'></td>
                            <td><div style='font-weight: normal;cursor: pointer;float: left;' onclick='disneuro()'>".$pLibNeuro['NEURO_DESC']."</div></td>
                          </tr>
                        </table>
                      </label>
                    </td>
                  </tr>
";
  }

echo "
                </table>
              </td>
              <td>
                <label>Remarks: <span style='font-size: 10px;color: red;'>(If Others is checked.)</span></label><br/>
                <textarea name='neuro_remarks' id='neuro_remarks' class='form-control' style='width: 500px; color: #000; margin: 0px 10px 0px 0px; text-transform: uppercase; resize: none;' autocomplete='off' rows='3' maxlength='500'>$gg</textarea>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <hr />
    <table boreder='0' width='100%' cellpadding='0' cellspacing='0'>
      <tr>
        <td><div align='left'><a href='?cf4clear&bck=p3&caseno=$caseno'";?> onclick="return confirm('Clear CF4 Data?');" <?php echo "><input type='button' class='btn btn-danger' value='Clear CF4 Data' title='Clear CF4 Data' style='color: #FFFFFF;font-weight: bold;margin: 10px 0px 0px 0px;' /></a></div></td>
        <td><div align='right'>
          <table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <!-- td><a href='../eClaimsTwo/3/CF4/?caseno=$caseno' class='astyle' target='_blank'><div align='right'><input type='button' class='btn btn-primary' value='PRINTABLE CF4' title='PRINTABLE CF4' style='font-weight: bold;margin: 10px 0px 0px 0px;' /></div></td>
              <td width='3'></td -->
";

$zsql=mysqli_query($conncf4,"SELECT `pHciCaseNo`, `pHciTransNo` FROM `enlistment` WHERE `caseno`='$caseno'");
$zcount=mysqli_num_rows($zsql);

if($zcount!=0){
echo "
              <!-- td><a href='?cf4p5&caseno=$caseno' class='astyle'><div align='right'><input type='button' class='btn btn-success' name='CF4 Part 5' value='CF4 Part 5' title='CF4 Part 5' style='font-weight: bold;margin: 10px 0px 0px 0px;' /></div></td>
              <td width='3'></td -->
              <td><a href='?cf4p4&caseno=$caseno' class='astyle'><div align='right'><input type='button' class='btn btn-success' name='CF4 Part 4' value='CF4 Part 4' title='CF4 Part4' style='font-weight: bold;margin: 10px 0px 0px 0px;' /></div></td>
              <td width='3'></td>
";
}

echo "
              <td><a href='?cf4p2&caseno=$caseno' class='astyle'><div align='right'><input type='button' class='btn btn-success' name='CF4 Part 2' value='CF4 Part 2' title='CF4 Part2' style='font-weight: bold;margin: 10px 0px 0px 0px;' /></div></td>
              <td width='3'></td>
              <td><a href='?cf4p1&caseno=$caseno' class='astyle'><div align='right'><input type='button' class='btn btn-success' name='CF4 Part 1' value='CF4 Part 1' title='CF4 Part1' style='font-weight: bold;margin: 10px 0px 0px 0px;' /></div></td>
              <td width='20'></td>
              <td><div align='right'><input type='submit' class='btn btn-primary' name='savep3' value='Save Entries' title='Save Entries' style='font-weight: bold;margin: 10px 0px 0px 0px;' /></div></td>
            </tr>
          </table>
        </div></td>
      </tr>
    </table>
  </form>
</div>
";
}
else{
echo "
<div align='left'>
";

  include("CF4Part3Save.php");

echo "
</div>
";
}
//---------------------------------------------------------------------------------------------------------------------------------------------------
?>

<script>
function setreq() {
  var radiopgen = document.getElementById("pGenSurvey_2");
  var elementpgen = document.getElementById("pGenSurveyRem");
  if (radiopgen.checked == true){
    elementpgen.required = true;
  }
  else{
    elementpgen.required = false;
  }
}

function disheent() {
  document.getElementById('heent2').disabled = document.getElementById('heent1').checked;
  document.getElementById('heent3').disabled = document.getElementById('heent1').checked;
  document.getElementById('heent4').disabled = document.getElementById('heent1').checked;
  document.getElementById('heent5').disabled = document.getElementById('heent1').checked;
  document.getElementById('heent6').disabled = document.getElementById('heent1').checked;
  document.getElementById('heent7').disabled = document.getElementById('heent1').checked;
  document.getElementById('heent8').disabled = document.getElementById('heent1').checked;
  document.getElementById('heent9').disabled = document.getElementById('heent1').checked;
  document.getElementById('heent_remarks').required = document.getElementById('heent9').checked;

  var heent1 = document.getElementById("heent1");
  var heent2 = document.getElementById("heent2");
  var heent3 = document.getElementById("heent3");
  var heent4 = document.getElementById("heent4");
  var heent5 = document.getElementById("heent5");
  var heent6 = document.getElementById("heent6");
  var heent7 = document.getElementById("heent7");
  var heent8 = document.getElementById("heent8");
  var heent9 = document.getElementById("heent9");
  if (heent1.checked == true){
    heent2.checked = false;
    heent3.checked = false;
    heent4.checked = false;
    heent5.checked = false;
    heent6.checked = false;
    heent7.checked = false;
    heent8.checked = false;
    heent9.checked = false;
  }
}

function dischest() {
  document.getElementById('chest2').disabled = document.getElementById('chest1').checked;
  document.getElementById('chest3').disabled = document.getElementById('chest1').checked;
  document.getElementById('chest4').disabled = document.getElementById('chest1').checked;
  document.getElementById('chest5').disabled = document.getElementById('chest1').checked;
  document.getElementById('chest6').disabled = document.getElementById('chest1').checked;
  document.getElementById('chest7').disabled = document.getElementById('chest1').checked;
  document.getElementById('chest8').disabled = document.getElementById('chest1').checked;
  document.getElementById('chest9').disabled = document.getElementById('chest1').checked;
  document.getElementById('chest_lungs_remarks').required = document.getElementById('chest9').checked;

  var chest1 = document.getElementById("chest1");
  var chest2 = document.getElementById("chest2");
  var chest3 = document.getElementById("chest3");
  var chest4 = document.getElementById("chest4");
  var chest5 = document.getElementById("chest5");
  var chest6 = document.getElementById("chest6");
  var chest7 = document.getElementById("chest7");
  var chest8 = document.getElementById("chest8");
  var chest9 = document.getElementById("chest9");
  if (chest1.checked == true){
    chest2.checked = false;
    chest3.checked = false;
    chest4.checked = false;
    chest5.checked = false;
    chest6.checked = false;
    chest7.checked = false;
    chest8.checked = false;
    chest9.checked = false;
  }
}

function disheart() {
  document.getElementById('heart2').disabled = document.getElementById('heart1').checked;
  document.getElementById('heart3').disabled = document.getElementById('heart1').checked;
  document.getElementById('heart4').disabled = document.getElementById('heart1').checked;
  document.getElementById('heart5').disabled = document.getElementById('heart1').checked;
  document.getElementById('heart6').disabled = document.getElementById('heart1').checked;
  document.getElementById('heart7').disabled = document.getElementById('heart1').checked;
  document.getElementById('heart8').disabled = document.getElementById('heart1').checked;
  document.getElementById('heart_remarks').required = document.getElementById('heart8').checked;

  var heart1 = document.getElementById("heart1");
  var heart2 = document.getElementById("heart2");
  var heart3 = document.getElementById("heart3");
  var heart4 = document.getElementById("heart4");
  var heart5 = document.getElementById("heart5");
  var heart6 = document.getElementById("heart6");
  var heart7 = document.getElementById("heart7");
  var heart8 = document.getElementById("heart8");
  if (heart1.checked == true){
    heart2.checked = false;
    heart3.checked = false;
    heart4.checked = false;
    heart5.checked = false;
    heart6.checked = false;
    heart7.checked = false;
    heart8.checked = false;
  }
}

function disabdomen() {
  document.getElementById('abdomen2').disabled = document.getElementById('abdomen1').checked;
  document.getElementById('abdomen3').disabled = document.getElementById('abdomen1').checked;
  document.getElementById('abdomen4').disabled = document.getElementById('abdomen1').checked;
  document.getElementById('abdomen5').disabled = document.getElementById('abdomen1').checked;
  document.getElementById('abdomen6').disabled = document.getElementById('abdomen1').checked;
  document.getElementById('abdomen7').disabled = document.getElementById('abdomen1').checked;
  document.getElementById('abdomen8').disabled = document.getElementById('abdomen1').checked;
  document.getElementById('abdomen_remarks').required = document.getElementById('abdomen8').checked;

  var abdomen1 = document.getElementById("abdomen1");
  var abdomen2 = document.getElementById("abdomen2");
  var abdomen3 = document.getElementById("abdomen3");
  var abdomen4 = document.getElementById("abdomen4");
  var abdomen5 = document.getElementById("abdomen5");
  var abdomen6 = document.getElementById("abdomen6");
  var abdomen7 = document.getElementById("abdomen7");
  var abdomen8 = document.getElementById("abdomen8");
  if (abdomen1.checked == true){
    abdomen2.checked = false;
    abdomen3.checked = false;
    abdomen4.checked = false;
    abdomen5.checked = false;
    abdomen6.checked = false;
    abdomen7.checked = false;
    abdomen8.checked = false;
  }
}

function disgui() {
  document.getElementById('gui2').disabled = document.getElementById('gui1').checked;
  document.getElementById('gui3').disabled = document.getElementById('gui1').checked;
  document.getElementById('gui4').disabled = document.getElementById('gui1').checked;
  document.getElementById('gui5').disabled = document.getElementById('gui1').checked;
  document.getElementById('gu_remarks').required = document.getElementById('gui5').checked;

  var gui1 = document.getElementById("gui1");
  var gui2 = document.getElementById("gui2");
  var gui3 = document.getElementById("gui3");
  var gui4 = document.getElementById("gui4");
  var gui5 = document.getElementById("gui5");
  if (gui1.checked == true){
    gui2.checked = false;
    gui3.checked = false;
    gui4.checked = false;
    gui5.checked = false;
  }
}

function disskin() {
  document.getElementById('skin2').disabled = document.getElementById('skin1').checked;
  document.getElementById('skin3').disabled = document.getElementById('skin1').checked;
  document.getElementById('skin4').disabled = document.getElementById('skin1').checked;
  document.getElementById('skin5').disabled = document.getElementById('skin1').checked;
  document.getElementById('skin6').disabled = document.getElementById('skin1').checked;
  document.getElementById('skin7').disabled = document.getElementById('skin1').checked;
  document.getElementById('skin8').disabled = document.getElementById('skin1').checked;
  document.getElementById('skin9').disabled = document.getElementById('skin1').checked;
  document.getElementById('skin10').disabled = document.getElementById('skin1').checked;
  document.getElementById('skin11').disabled = document.getElementById('skin1').checked;
  document.getElementById('extremities_remarks').required = document.getElementById('skin11').checked;

  var skin1 = document.getElementById("skin1");
  var skin2 = document.getElementById("skin2");
  var skin3 = document.getElementById("skin3");
  var skin4 = document.getElementById("skin4");
  var skin5 = document.getElementById("skin5");
  var skin6 = document.getElementById("skin6");
  var skin7 = document.getElementById("skin7");
  var skin8 = document.getElementById("skin8");
  var skin9 = document.getElementById("skin9");
  var skin10 = document.getElementById("skin10");
  var skin11 = document.getElementById("skin11");
  if (skin1.checked == true){
    skin2.checked = false;
    skin3.checked = false;
    skin4.checked = false;
    skin5.checked = false;
    skin6.checked = false;
    skin7.checked = false;
    skin8.checked = false;
    skin9.checked = false;
    skin10.checked = false;
    skin11.checked = false;
  }
}

function disneuro() {
  document.getElementById('neuro2').disabled = document.getElementById('neuro1').checked;
  document.getElementById('neuro3').disabled = document.getElementById('neuro1').checked;
  document.getElementById('neuro4').disabled = document.getElementById('neuro1').checked;
  document.getElementById('neuro5').disabled = document.getElementById('neuro1').checked;
  document.getElementById('neuro6').disabled = document.getElementById('neuro1').checked;
  document.getElementById('neuro7').disabled = document.getElementById('neuro1').checked;
  document.getElementById('neuro8').disabled = document.getElementById('neuro1').checked;
  document.getElementById('neuro9').disabled = document.getElementById('neuro1').checked;
  document.getElementById('neuro_remarks').required = document.getElementById('neuro9').checked;

  var neuro1 = document.getElementById("neuro1");
  var neuro2 = document.getElementById("neuro2");
  var neuro3 = document.getElementById("neuro3");
  var neuro4 = document.getElementById("neuro4");
  var neuro5 = document.getElementById("neuro5");
  var neuro6 = document.getElementById("neuro6");
  var neuro7 = document.getElementById("neuro7");
  var neuro8 = document.getElementById("neuro8");
  var neuro9 = document.getElementById("neuro9");
  if (neuro1.checked == true){
    neuro2.checked = false;
    neuro3.checked = false;
    neuro4.checked = false;
    neuro5.checked = false;
    neuro6.checked = false;
    neuro7.checked = false;
    neuro8.checked = false;
    neuro9.checked = false;
  }
}
</script>
