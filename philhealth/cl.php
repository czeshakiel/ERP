<?php
$lb="Credit Limit";

echo "
    <!-- Body: Body -->
    <div class='body d-flex py-lg-3 py-md-2'>
      <div class='container-xxl'>
        <div class='row align-items-center'>
          <div class='border-0 mb-4'>
            <div class='card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap'>
              <h3 class='fw-bold mb-0'>$lb</h3>
            </div>
          </div>
        </div> <!-- Row end  -->
        <div class='row clearfix g-3'>
          <div class='col-sm-12'>
            <div class='card mb-3'>
              <div class='card-body'>
";

if(isset($_POST['scl'])){
  $sccaseno=mysqli_real_escape_string($conn,$_POST['caseno']);
  $scpn=mysqli_real_escape_string($conn,$_POST['pn']);
  $scgross=mysqli_real_escape_string($conn,$_POST['gross']);
  $sccl=mysqli_real_escape_string($conn,$_POST['cl']);

echo "
                <div align='left'>
                  <form method='post'>
                    <table border='0' width='400' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td><div style='border: 2px solid #000000;border-radius: 5px;padding: 5px;'>
                          <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                            <tr>
                              <td colspan='3' style='padding: 0 0 5px 0;'><div align='left' style='font-face: arial;font-weight: bold;font-size: 16px;color: #089AD1;'>$scpn</div></td>
                            </tr>
                            <tr>
                              <td style='padding: 5px 0 5px 0;'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;'>Credit Limit</div></td>
                              <td style='padding: 5px 0 5px 0;'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                              <td style='padding: 5px 0 5px 0;'><div align='left'><input type='number' value='$sccl' style='width: 100%;height: 35px;border: 1px solid #000000;border-radius: 3px;padding: 0 5px;' readonly /></div></td>
                            </tr>
                            <tr>
                              <td style='padding: 5px 0 5px 0;'><div align='left' style='font-face: arial;font-weight: bold;font-size: 14px;'>Set New Limit</div></td>
                              <td style='padding: 5px 0 5px 0;'><div align='center' style='font-face: arial;font-weight: bold;font-size: 14px;padding: 0 3px;'>:</div></td>
                              <td style='padding: 5px 0 5px 0;'><div align='left'><input type='number' name='newcl' value='newlimit' style='width: 100%;height: 35px;border: 1px solid #000000;border-radius: 3px;padding: 0 5px;' autofocus required /></div></td>
                            </tr>
                            <tr>
                              <td colspan='3'><div align='right'><button type='submit' name='ucl' class='btn btn-primary' title='Save'><i class='icofont-save'></i> Save</button></div></td>
                            </tr>
                          </table>
                        </div></td>
                      </tr>
                    </table>
                    <input type='hidden' name='caseno' value='$sccaseno' />
                    <input type='hidden' name='oldcl' value='$sccl' />
                    <input type='hidden' name='scpn' value='$scpn' />
                  </form>
                </div>
";
}
else{
  if(isset($_POST['ucl'])){
    $caseno=mysqli_real_escape_string($conn,$_POST['caseno']);
    $oldcl=mysqli_real_escape_string($conn,$_POST['oldcl']);
    $newcl=mysqli_real_escape_string($conn,$_POST['newcl']);
    $scpn=mysqli_real_escape_string($conn,$_POST['scpn']);

    mysqli_query($conn,"UPDATE `patientscredit` SET `creditlimit`='$newcl' WHERE `caseno`='$caseno'");

    $kadstsql=mysqli_query($conn,"SELECT * FROM `admission` WHERE `caseno`='$caseno' AND `status`='YELLOW TAG'");
    if(mysqli_num_rows($kadstsql)>0){
      mysqli_query($conn,"UPDATE `admission` SET `status`='Active' WHERE `caseno`='$caseno'");
    }

    mysqli_query($conn,"INSERT INTO `userlogs` (`loginuser`, `transaction`, `timearray`, `datearray`) VALUES ('".base64_decode($_SESSION['nm'])."','|$scpn|Change Credit Limit to $newcl from $oldcl.|$caseno|','".date("H:i:s")."', '".date("Y-m-d")."')");

echo "
                <span style='font-face: arial;font-weight: bold;font-size: 16px;color: #089AD1;'>Credit Limit Updated.</span>
";

    echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=../philhealth/?cl'>";
  }
  else{
echo "
                <table id='myProjectTable' class='table table-hover align-middle mb-0' style='width:100%'>
                  <thead>
                    <tr>
                      <th>#</th>
                      <th><div align='center'>Case No.</div></th>
                      <th><div align='center'>Patient Name</div></th>
                      <th><div align='center'>Adm. Date</div></th>
                      <th><div align='center'>Status</div></th>
                      <th><div align='center'>Charged</div></th>
                      <th><div align='center'>Credit Left</div></th>
                      <th><div align='center'>Action</div></th>
                    </tr>
                  </thead>
                  <tbody>
";

$adm=0;
mysqli_query($conn,"SET NAMES 'utf8'");
$admsql=mysqli_query($conn,"SELECT a.`caseno`, a.`membership`, a.`hmomembership`, a.`hmo`, a.`room`, p.`lastname`, p.`firstname`, p.`middlename`, p.`suffix`, p.`sex`, a.`dateadmit`, a.`status`, a.`result` FROM `admission` a, `patientprofile` p WHERE a.`ward`='in' AND a.`patientidno`=p.`patientidno` AND a.`room` NOT LIKE '%OPD%' GROUP BY a.`caseno` ORDER BY p.`lastname`, p.`firstname` ASC");
while($admfetch=mysqli_fetch_array($admsql)){
  $caseno=$admfetch['caseno'];
  $msh=$admfetch['membership'];
  $hms=$admfetch['hmomembership'];
  $hmo=$admfetch['hmo'];
  $rom=$admfetch['room'];
  $lnm=$admfetch['lastname'];
  $fnm=$admfetch['firstname'];
  $mnm=$admfetch['middlename'];
  $suf=$admfetch['suffix'];
  $sex=$admfetch['sex'];
  $dad=$admfetch['dateadmit'];
  $sta=$admfetch['status'];
  $res=$admfetch['result'];
  $adm++;

  if($mnm==""){$mnmf="";}
  else{$mnmf=" ".$mnm;}

  if($suf==""){$suff="";}
  else{$suff=" ".$suf;}

  $pn=$lnm.", ".$fnm.$suff.$mnmf;

  if($sex=="M"){$imgs="male";$alts="Male";}
  else if($sex=="F"){$imgs="female";$alts="Female";}
  else{$imgs="male";$alts="Unknown";}

  if($msh=="phic-med"){$phic="Active";}
  else{$phic="Non-PHIC";}

  if($sta=="YELLOW TAG"){$trc="table-warning";}
  else if($sta=="LOCKED"){$trc="table-danger";}
  else  if($sta=="MGH"){$trc="table-success";}
  else  if($sta=="WARNING"){$trc="table-info";}
  else{$trc="";}

  if(stripos($caseno, "I-") !== FALSE){$mh="&inp";}else{$mh="&otp";}

  $asql=mysqli_query($conn,"SELECT SUM((`quantity`*`sellingprice`)-`adjustment`) AS `gross` FROM `productout` WHERE `caseno`='$caseno' AND `trantype`='charge'");
  $afetch=mysqli_fetch_array($asql);
  $gross=$afetch['gross'];

  $bsql=mysqli_query($conn,"SELECT `creditlimit` FROM `patientscredit` WHERE `caseno`='$caseno'");
  $bfetch=mysqli_fetch_array($bsql);
  $cl=$bfetch['creditlimit'];

  $cleft=$cl-$gross;

echo "
                    <tr class='$trc'>
                      <td><div align='left'style='font-size: 11px;'>$adm</div></td>
                      <td><div align='left' style='font-size: 11px;'>$caseno</div></td>
                      <td><div align='left' style='font-size: 11px;'><img class='avatar rounded-circle' src='../main/assets/images/xs/$imgs.jpg' height='5' width='auto' alt='$alts' /><span class='fw-bold ms-1'>$pn</span></div></td>
                      <td><div align='center' style='font-size: 11px;'>".date("M d, Y",strtotime($dad))."</div></td>
                      <td><div align='center' style='font-size: 11px;font-weight: bold;'>".ucwords(strtolower($sta))."</div></td>
                      <td><div align='right' style='font-size: 11px;'>".number_format($gross,2)."</div></td>
                      <td><div align='right' style='font-size: 11px;'>".number_format($cleft,2)."</div></td>
                      <td>
                        <div align='center'>
                          <form method='post'>
                            <button type='submit' name='scl' class='btn btn-primary' title='Set Credit Limit'>
                              <i class='icofont-edit'></i>
                            </button>
                            <input type='hidden' name='pn' value='$pn' />
                            <input type='hidden' name='caseno' value='$caseno' />
                            <input type='hidden' name='gross' value='$gross' />
                            <input type='hidden' name='cl' value='$cl' />
                          </form>
                        </div>
                      </td>
                    </tr>
";
}

echo "
                  </tbody>
                </table>
";
  }
}

echo "
                <!-- Back to top button -->
              </div>
            </div>
          </div>
        </div><!-- Row End -->
      </div>
    </div>
";
?>
