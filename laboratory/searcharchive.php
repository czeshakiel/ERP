<?php
$lb="Search Archived Lab Results";

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

if(isset($_POST['searchme'])){$searchme=mysqli_real_escape_string($conn,$_POST['searchme']);}
else{$searchme="";}

echo "
                <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td><div align='left'>
                      <form method='post'>
                        <table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td><div align='left'><input type='text' name='searchme' placeholder='Ex. Last Name(space)First Name(space)Middle Name' style='padding: 5px 10px 5px 10px;height: 40px;width: 400px;border: 2px solid #000000;border-radius: 6px;' value='$searchme' required autofocus /></div></td>
                            <td width='3'></td>
                            <td><button type='submit' style='padding: 5px;height: 40px;width: 40px;border: 2px solid #000000;border-radius: 6px;background-color: #229954;color: #FFFFFF;font-weight: bold;'><i class='icofont-search'></i></button></td>
                          </tr>
                        </table>
                      </form>
                    </div></td>
                  </tr>
";

if(isset($_POST['searchme'])){
  $searchme=mysqli_real_escape_string($conn,$_POST['searchme']);

echo "
                  <tr>
                    <td height='10'></td>
                  </tr>
                  <tr>
                    <td><div align='left'>
                      <table class='table table-hover align-middle mb-0' style='width:100%'>
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Case No.</th>
                            <th>Patient Name</th>
                            <th>Adm. Date</th>
                            <th>Room</th>
                            <th>Status</th>
                            <th>Request</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
";

$adm=0;
mysqli_query($conn,"SET NAMES 'utf8'");
$admsql=mysqli_query($conn,"SELECT a.`caseno`, a.`membership`, a.`hmomembership`, a.`hmo`, a.`room`, p.`lastname`, p.`firstname`, p.`middlename`, p.`suffix`, p.`sex`, a.`dateadmit`, a.`status`, a.`result` FROM `admission` a, `patientprofile` p WHERE a.`patientidno`=p.`patientidno` AND `status` NOT LIKE 'Cancelled' AND (CONCAT(p.`lastname`, ' ', p.`firstname`, ' ', p.`middlename`) LIKE '%$searchme%' OR a.`caseno`='$searchme') ORDER BY a.`dateadmit` DESC");
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
  
  $posql=mysqli_query($conn,"SELECT * FROM `productout` WHERE `caseno`='$caseno' AND `productsubtype`='LABORATORY' AND (`trantype`='charge' OR `trantype`='cash') AND `productdesc` NOT LIKE '%RAPID TEST%' AND `productdesc` NOT LIKE '%RT%%PCR%' AND `productdesc` NOT LIKE '%ABG%'");
  if(mysqli_num_rows($posql)>0){
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

echo "
                          <tr class='$trc'>
                            <td><div align='left'style='font-size: 11px;'>$adm</div></td>
                            <td><div align='left' style='font-size: 11px;'>$caseno</div></td>
                            <td><div align='left' style='font-size: 11px;'><img class='avatar rounded-circle' src='../main/assets/images/xs/$imgs.jpg' height='5' width='auto' alt='$alts' /><span class='fw-bold ms-1'>$pn</span></div></td>
                            <td><div align='center' style='font-size: 11px;'>".date("M d, Y",strtotime($dad))."</div></td>
                            <td><div align='left' style='font-size: 11px;'>$rom</div></td>
                            <td><div align='center' style='font-size: 11px;font-weight: bold;'>".ucwords(strtolower($sta))."</div></td>
                            <td><div align='center' style='font-size: 11px;font-weight: bold;color: blue;'>".mysqli_num_rows($posql)."</div></td>
                            <td>
                              <div align='center'>
                                <a href='../laboratory/?details$mh&caseno=$caseno' target='_blank'>
                                  <button type='button' class='btn btn-primary' style='width: 100px'>
                                    <i class='icofont-eye-alt'></i>
                                  </button>
                                </a>
                              </div>
                            </td>
                          </tr>
";
  }
}

echo "
                        </tbody>
                      </table>
                    </div></td>
                  </tr>
";
}

echo "
                </table>
";

echo "
              </div>
            </div>
          </div>
        </div><!-- Row End -->
      </div>
    </div>
";
?>