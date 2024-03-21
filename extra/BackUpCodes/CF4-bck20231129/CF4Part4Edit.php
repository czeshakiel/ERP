<?php
include('function.php');
include('function_global.php');

mysqli_query($conncf4,"SET NAMES 'utf8'");

if(!isset($_POST['savep4edit'])){
  if($dateadmitted==""){$pAdmissionDate=date("m-d-Y");}
  else{$pAdmissionDate=date("m-d-Y",strtotime($dateadmitted));}

  if($ddt==""){$pDischargeDate=date("m-d-Y");}
  else{$pDischargeDate=date("m-d-Y",strtotime($ddt));}

  $adate=preg_split("/\-/",$pAdmissionDate);

  $dastr=$adate[2]."-".$adate[0]."-".$adate[1];
  $da=preg_split("/\-/",$dastr);
  $daY=$da[0];
  $daM=$da[1];
  $daD=$da[2];

  $ddate=preg_split("/\-/",$pDischargeDate);

  $ddstr=$ddate[2]."-".$ddate[0]."-".$ddate[1];
  $ddstrp1=date('Y-m-d', strtotime('+1 day', strtotime($ddstr)));
  $dd=preg_split("/\-/",$ddstr);
  $ddY=$dd[0];
  $ddM=$dd[1];
  $ddD=$dd[2];

  $period = new DatePeriod(new DateTime($dastr), new DateInterval('P1D'), new DateTime($ddstrp1));

  $asd=(-1);
  foreach ($period as $date){$days[] = $date->format("d");}
  foreach ($period as $date){$months[] = $date->format("m");$asd+=1;}

  $asql=mysqli_query($conncf4,"SELECT * FROM `subjective` WHERE `caseno`='$caseno'");
  $acount=mysqli_num_rows($asql);
  if($acount!=0){
    $afetch=mysqli_fetch_array($asql);
    $pOtherComplaint=$afetch["pOtherComplaint"];
    $pSignsSymptoms=$afetch["pSignsSymptoms"];
    $pPainSite=$afetch["pPainSite"];
  }
  else{
    $pOtherComplaint="";
    $pSignsSymptoms="";
    $pPainSite="";
  }

  $listHeents = listHeent();
  $listChests = listChest();
  $listHearts = listHeart();
  $listAbs = listAbdomen();
  $listNeuro = listNeuro();
  $listGenitourinary = listGenitourinary();
  $listRectal = listDigitalRectal();
  $listSkinExtremities = listSkinExtremities();

//---------------------------------------------------------------------------------------------------------------------------------------------------

echo "
<div align='center'>
  <table style='width: 100%;'>
    <tr>
      <td>
        <div class='alert alert-success' style='margin-bottom: 2px'>
          <label style='color:red;'>*</label><strong style='font-size: 16px'>COURSE IN THE WARD</strong>
        </div>
        <table id='tblCourseWard' class='table table-condensed table-bordered'>
          <col width='300'>
          <col width='auto'>
          <col width='110'>
          <thead>
            <tr>
              <th>DATE</th>
              <th>DOCTOR'S ORDER/ACTION</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
";

  $a=0;
  $werr=0;
  $asql=mysqli_query($conncf4,"SELECT * FROM `courseward` WHERE `caseno`='$caseno' ORDER BY `pDateAction`");
  while($afetch=mysqli_fetch_array($asql)){
    $a++;
    $pDateAction=$afetch['pDateAction'];
    $pDoctorsAction=$afetch['pDoctorsAction'];
    $no=$afetch['no'];

    $countda=strlen($pDateAction);
    $warn="";
    if($countda!=10){
      $warn="background-color: red;";
      $werr+=1;
    }

    $pDateActionfmt=date("M d, Y",strtotime($pDateAction));

    if($sno==$no){
echo "
          <form method='post' id='RemoveCF4' ";?> onsubmit="return confirm('Saving changes. Press ok to continue.');" <?php echo ">
            <tr>
              <td style='vertical-align: middle;'><div align='center'>
                <table border='0' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td>
                      <select name='txtWardDateOrderM' class='form-control' style='width: 90px;text-transform: uppercase;'>
                        <option value='' disabled>Month</option>
";

      $edate=preg_split("/\-/",$pDateAction);
      $eY=$edate[0];
      $eM=$edate[1];
      $eD=$edate[2];

      $pm=date("m");
      $bn=0;
      $mo = getDateMonth(true, '');
      foreach($mo as $key => $value) {

        if($daM==$ddM){
          if(in_array($key,$months)){$bn+=1;$disa="";}
          else{$bn=0;$disa="disabled";}
        }
        else{
          if(in_array($key,$months)){$bn+=1;$disa="";}
          else{$bn+=0;$disa="disabled";}
        }

        if($key==$eM){$bdms="selected='selected'";}else{$bdms="";}


echo "
                        <option value='$key' $bdms $disa>$value</option>
";
      }

echo "
                      </select>
                    </td>
                    <td width='2'></td>
                    <td>
                      <select name='txtWardDateOrderD' class='form-control' style='width: 80px;text-transform: uppercase;'>
                        <option value='' disabled>Day</option>
";

      $pd=date("d");
      $cv=0;
      for($x=1;$x<=31;$x++){
        if($x<10){$y="0".$x;}else{$y=$x;}
        if(in_array($y,$days)){$cv+=1;$disb="";}else{$cv+=0;$disb="disabled";}
        if($y==$eD){$bdds="selected='selected'";}else{$bdds="";}

echo "
                        <option $bdds $disb>$y</option>
";
      }


echo "
                      </select>
                    </td>
                    <td width='2'></td>
                    <td>
                      <select name='txtWardDateOrderY' class='form-control' style='width: 95px;text-transform: uppercase;'>
                        <option value='' disabled>Year</option>
";

      $py=date("Y");
      for($z=$adate[2];$z<=$ddate[2];$z++){
        if($z==$eY){$bdys="selected='selected'";}else{$bdys="";}
echo "
                        <option $bdys>$z</option>
";
      }


echo "
                      </select>
                    </td>
                  </tr>
                </table>
              </div></td>
              <td style='vertical-align: middle'>
                <textarea name='txtWardDocAction' id='txtWardDocAction' onkeyup='resizeTextAreaCf4();' class='form-control' rows='1' maxlength='1500' style='resize: none; width: 100%;height: 100px;text-transform: uppercase;' autofocus required>$pDoctorsAction</textarea>
              </td>
              <td><div align='center'><button type='submit' name='savep4edit' class='btn btn-success btn-sm' title='Save Course in Ward' style='width: 70px;'><i class='icofont-save'></i></button></div></td>
            </tr>
            <input type='hidden' name='caseno' value='$caseno' />
            <input type='hidden' name='no' value='$no' />
          </form>
";
    }
    else{
echo "
          <form name='CF4Part4Remove' method='post' id='RemoveCF4' action='CF4Part4Remove.php' ";?> onsubmit="return confirm('Are you sure you want to remove this entry?');" <?php echo ">
            <tr>
              <td style='vertical-align: middle'><div align='center' class='arial16black'>$pDateActionfmt</div></td>
              <td style='vertical-align: middle'>
                <textarea name='txtWardDocAction' id='txtWardDocAction' onkeyup='resizeTextAreaCf4();' class='form-control' rows='1' maxlength='1500' style='resize: none; width: 100%;height: 100px;text-transform: uppercase;'>$pDoctorsAction</textarea>
              </td>
              <td style='vertical-align: middle'><div align='center'>
                <table border='0' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td><a href='?cf4p4edit&caseno=$caseno&no=$no' class='astyle'><button type='button' class='btn btn-success btn-sm' title='Edit Course in Ward'><i class='icofont-edit-alt'></i></button></a></td>
                    <td width='3'></td>
                    <td><button type='submit' class='btn btn-danger btn-sm' title='Remove Course in Ward'><i class='icofont-ui-delete'></i></button></td>
                  </tr>
                </table>
              </div></td>
            </tr>
          </form>
";
    }
  }

echo "
          <form method='post' action='CF4Part4Save.php'>
            <tr>
              <td style='vertical-align: middle'><div align='center'>
                <table border='0' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td>
                      <select name='txtWardDateOrderM' class='form-control' style='width: 90px;text-transform: uppercase;'>
                        <option value='' disabled>Month</option>
";

  $pm=date("m");
  $bn=0;
  $mo = getDateMonth(true, '');
  foreach($mo as $key => $value) {
    if($daM==$ddM){
      if(in_array($key,$months)){$bn+=1;$disa="";}
      else{$bn=0;$disa="disabled";}
    }
    else{
      if(in_array($key,$months)){$bn+=1;$disa="";}
      else{$bn+=0;$disa="disabled";}
    }

    if($bn==1){$bdms="selected='selected'";}else{$bdms="";}

echo "
                        <option value='$key' $bdms $disa>$value</option>
";
  }

echo "
                      </select>
                    </td>
                    <td width='2'></td>
                    <td>
                      <select name='txtWardDateOrderD' class='form-control' style='width: 80px;text-transform: uppercase;'>
                        <option value='' disabled>Day</option>
";

  $pd=date("d");
  $cv=0;
  for($x=1;$x<=31;$x++){
    if($x<10){$y="0".$x;}else{$y=$x;}
    if(in_array($y,$days)){$cv+=1;$disb="";}else{$cv+=0;$disb="disabled";}

    if($cv==1){$bdds="selected='selected'";}else{$bdds="";}

echo "
                        <option $bdds $disb>$y</option>
";
  }


echo "
                      </select>
                    </td>
                    <td width='2'></td>
                    <td>
                      <select name='txtWardDateOrderY' class='form-control' style='width: 95px;text-transform: uppercase;'>
                        <option value='' disabled>Year</option>
";

  $py=date("Y");
  for($z=$adate[2];$z<=$ddate[2];$z++){
    if($z==$py){$bdys="selected='selected'";}else{$bdys="";}

echo "
                        <option $bdys>$z</option>
";
  }


echo "
                      </select>
                    </td>
                  </tr>
                </table>
              </div></td>
              <td>
                <textarea name='txtWardDocAction' id='txtWardDocAction' onkeyup='resizeTextAreaCf4();' class='form-control' rows='1' maxlength='1500' style='resize: none; width: 100%;height: 100px;text-transform: uppercase;' required></textarea>
              </td>
              <td style='vertical-align: middle'><div align='center'>
                <button type='submit' class='btn btn-primary btn-sm' title='Save' style='width: 70px;'><i class='icofont-save'></i></button>
              </div></td>
            </tr>
            <input type='hidden' name='caseno' value='$caseno' />
          </form>
          </tbody>
        </table>
      </td>
    </tr>
  </table>
  <hr />
  <table boreder='0' width='100%' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='left'><a href='?cf4clear&bck=p4&caseno=$caseno'";?> onclick="return confirm('Clear CF4 Data?');" <?php echo "><input type='button' class='btn btn-danger' value='Clear CF4 Data' title='Clear CF4 Data' style='color: #FFFFFF;font-weight: bold;margin: 10px 0px 0px 0px;' /></a></div></td>
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
            <td><a href='?cf4p3&caseno=$caseno' class='astyle'><div align='right'><input type='button' class='btn btn-success' name='CF4 Part 3' value='CF4 Part 3' title='CF4 Part3' style='font-weight: bold;margin: 10px 0px 0px 0px;' /></div></td>
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
</div>
";
}
else{
echo "
<div align='left'>
";

  include("CF4Part4EditSave.php");

echo "
</div>
";
}
//---------------------------------------------------------------------------------------------------------------------------------------------------
?>
