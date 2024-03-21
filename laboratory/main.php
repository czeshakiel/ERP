<?php
if(isset($_GET['opdreq'])){
  $lb="Out-Patient Requests";
  $adq="(ad.`caseno` LIKE 'O-%%' OR ad.`caseno` LIKE 'W-%%' OR ad.`caseno` LIKE '%AR-%')";
}
else if(isset($_GET['rdureq'])){
  $lb="RDU Requests";
  $adq="(ad.`caseno` LIKE 'R-%%' OR ad.`caseno` LIKE 'WD-%%')";
}
else{
  $lb="In-patient Requests";
  $adq="ad.`caseno` LIKE 'I-%%'";
}

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
                <table id='myProjectTable' class='table table-hover align-middle mb-0' style='width:100%'>
                  <thead>
                    <tr>
                      <th><div align='center' style='font-size: 12px;'>#</div></th>
                      <th><div align='center' style='font-size: 12px;'>Patient Name</div></th>
                      <th><div align='center' style='font-size: 12px;'>Case No.</div></th>
                      <th><div align='center' style='font-size: 12px;'>Room</div></th>
                      <th><div align='center' style='font-size: 12px;'>Date/Time Admitted</div></th>
                      <th><div align='center' style='font-size: 12px;'>No. of Pending</div></th>
                      <th><div align='center' style='font-size: 12px;'>Action</div></th>
                    </tr>
                  </thead>
                  <tbody>
";

$adm=0;
mysqli_query($conn,"SET NAMES 'utf8'");

$ax=0;
$axsql=mysqli_query($conn,"SELECT * FROM productout pr, admission ad, patientprofile pa WHERE pa.`patientidno`=ad.`patientidno` AND ad.`caseno`=pr.`caseno` AND $adq AND pr.`productsubtype`='LABORATORY' AND pr.`terminalname`!='Testdone' AND pr.`status`!='requested' AND ad.`ward`!='discharged' AND ad.`ward`!='OPD' AND (pr.`productdesc` NOT LIKE '%NEWBORN%' OR pr.`productdesc` NOT LIKE '%AUDIOMETRY%' AND pr.`productdesc` NOT LIKE '%RAPID%' AND pr.`productdesc` NOT LIKE '%PCR%') AND (ad.`status`!='CANCELLED' AND ad.`status`!='discharged') AND DATE(pr.`datearray`) > (NOW() - INTERVAL 7 DAY) GROUP BY ad.`caseno` ORDER BY pa.`lastname`");
while($axfetch=mysqli_fetch_array($axsql)){
  $caseno=$axfetch['caseno'];
  $name=$axfetch['lastname'].", ".$axfetch['firstname']." ".$axfetch['suffix']." ".$axfetch['middlename'];
  $status=$axfetch['status'];
  $dateadmit=$axfetch['dateadmit']." ".$axfetch['timeadmitted'];
  $room=$axfetch['room'];
  $gender=$axfetch['sex'];
  $ax++;

  if($gender=="M"){$imgs="male";$alts="Male";}
  else if($gender=="F"){$imgs="female";$alts="Female";}
  else{$imgs="male";$alts="Unknown";}

  if(stripos($caseno, "I-") !== FALSE){$mh="&inp";}
  else{
    if((stripos($caseno, "W-") !== FALSE)||(stripos($caseno, "O-") !== FALSE)||(stripos($caseno, "AR-") !== FALSE)){$mh="&otp";}
    else{$mh="&rtp";}
  }

  //NOTIFICATION ----------------------------------------------------------------------------------
  $azsql=mysqli_query($conn,"SELECT * FROM `productout` WHERE `caseno`='$caseno' AND `terminalname`='pending' AND `productsubtype`='LABORATORY' AND (`status`='PAID' OR `status`='Approved')");
  $azcount=mysqli_num_rows($azsql);

  $avsql=mysqli_query($conn,"SELECT * FROM `productout` WHERE `caseno`='$caseno' AND `approvalno`='FOR CANCEL' AND `status`='PAID' AND `terminalname`='pending'");
  $avcount=mysqli_num_rows($avsql);

  $ansql=mysqli_query($conn,"SELECT COUNT(`caseno`) AS `totnew` FROM `productout` WHERE `shift`='NEW' AND `caseno`='$caseno' AND `terminalname` NOT LIKE 'Testdone' AND `terminalname` NOT LIKE 'Testtobedone' AND `productsubtype`='LABORATORY'");
  $anfetch=mysqli_fetch_array($ansql);
  $ancount=$anfetch['totnew'];
// ------------------------------------------------------------------------------------------------

echo "
                    <tr>
                      <td><div align='left'style='font-size: 11px;'>$ax</div></td>
                      <td><div align='left' style='font-size: 11px;'><a href='../laboratory/?details$mh&caseno=$caseno' target='_blank'><img class='avatar rounded-circle' src='../main/assets/images/xs/$imgs.jpg' height='5' width='auto' alt='$alts' /></a><span class='fw-bold ms-1'>$name</span></div></td>
                      <td><div align='center' style='font-size: 11px;'>$caseno</div></td>
                      <td><div align='center' style='font-size: 11px;'>$room</div></td>
                      <td><div align='center' style='font-size: 11px;'>".date("M d, Y h:i A",strtotime($dateadmit))."</div></td>
                      <td><div align='center' style='font-size: 11px;font-weight: bold;'>
";

  if($azcount>0){
echo"
                        <span class='badge bg-warning' style='color: #000000;padding: 4px;font-size: 12px;'>$azcount Pending</span>
";
  }

  if($avcount>0){
echo"
                        <span class='badge bg-danger' style='font-size: 12px;'>$avcount request for delete</span>
";
  }

  if($ancount>'0'){
    $badgenr="<span class='badge bg-danger'>$ancount</span>";
    $tnr="View Details | $ancount New Request";
  }
  else{
    $badgenr="";
    $tnr="View Details";
  }

echo "
                      </div></td>
                      <td>
                        <div align='center'>
                          <a href='../laboratory/?details$mh&caseno=$caseno' target='_blank'>
                            <button type='button' class='btn btn-primary' style='width: 100px' title='$tnr'>
                              <i class='icofont-eye-alt'></i> $badgenr
                            </button>
                          </a>
                        </div>
                      </td>
                    </tr>
";
}

echo "
                  </tbody>
                </table>
                <!-- Back to top button -->
              </div>
            </div>
          </div>
        </div><!-- Row End -->
      </div>
    </div>

    <!-- Modal Members-->
    <div class='modal fade' id='addUser' tabindex='-1' aria-labelledby='addUserLabel' aria-hidden='true'>
      <div class='modal-dialog modal-dialog-centered modal-lg'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h5 class='modal-title  fw-bold' id='addUserLabel'>Employee Invitation</h5>
            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
          </div>
          <div class='modal-body'>
            <div class='inviteby_email'>
              <div class='input-group mb-3'>
                <input type='email' class='form-control' placeholder='Email address' id='exampleInputEmail1' aria-describedby='exampleInputEmail1'>
                <button class='btn btn-dark' type='button' id='button-addon2'>Sent</button>
              </div>
            </div>
            <div class='members_list'>
              <h6 class='fw-bold '>Employee </h6>
              <ul class='list-unstyled list-group list-group-custom list-group-flush mb-0'>
                <li class='list-group-item py-3 text-center text-md-start'>
                  <div class='d-flex align-items-center flex-column flex-sm-column flex-md-column flex-lg-row'>
                    <div class='no-thumbnail mb-2 mb-md-0'>
                      <img class='avatar lg rounded-circle' src='../main/assets/images/xs/avatar2.jpg' alt=''>
                    </div>
                    <div class='flex-fill ms-3 text-truncate'>
                      <h6 class='mb-0  fw-bold'>Rachel Carr(you)</h6>
                      <span class='text-muted'>rachel.carr@gmail.com</span>
                    </div>
                    <div class='members-action'>
                      <span class='members-role '>Admin</span>
                      <div class='btn-group'>
                        <button type='button' class='btn bg-transparent dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
                          <i class='icofont-ui-settings  fs-6'></i>
                        </button>
                        <ul class='dropdown-menu dropdown-menu-end'>
                          <li><a class='dropdown-item' href='#'><i class='icofont-ui-password fs-6 me-2'></i>ResetPassword</a></li>
                          <li><a class='dropdown-item' href='#'><i class='icofont-chart-line fs-6 me-2'></i>ActivityReport</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </li>
                <li class='list-group-item py-3 text-center text-md-start'>
                  <div class='d-flex align-items-center flex-column flex-sm-column flex-md-column flex-lg-row'>
                    <div class='no-thumbnail mb-2 mb-md-0'>
                      <img class='avatar lg rounded-circle' src='../main/assets/images/xs/avatar3.jpg' alt=''>
                    </div>
                    <div class='flex-fill ms-3 text-truncate'>
                      <h6 class='mb-0  fw-bold'>Lucas Baker<a href='#' class='link-secondary ms-2'>(Resend invitation)</a></h6>
                      <span class='text-muted'>lucas.baker@gmail.com</span>
                    </div>
                    <div class='members-action'>
                      <div class='btn-group'>
                        <button type='button' class='btn bg-transparent dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
                          Members
                        </button>
                        <ul class='dropdown-menu dropdown-menu-end'>
                          <li>
                            <a class='dropdown-item' href='#'>
                              <i class='icofont-check-circled'></i>
                              <span>All operations permission</span>
                            </a>
                          </li>
                          <li>
                            <a class='dropdown-item' href='#'>
                              <i class='fs-6 p-2 me-1'></i>
                              <span>Only Invite & manage team</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                      <div class='btn-group'>
                        <button type='button' class='btn bg-transparent dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
                          <i class='icofont-ui-settings  fs-6'></i>
                        </button>
                        <ul class='dropdown-menu dropdown-menu-end'>
                          <li><a class='dropdown-item' href='#'><i class='icofont-delete-alt fs-6 me-2'></i>Delete Member</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </li>
                <li class='list-group-item py-3 text-center text-md-start'>
                  <div class='d-flex align-items-center flex-column flex-sm-column flex-md-column flex-lg-row'>
                    <div class='no-thumbnail mb-2 mb-md-0'>
                      <img class='avatar lg rounded-circle' src='../main/assets/images/xs/avatar8.jpg' alt=''>
                    </div>
                    <div class='flex-fill ms-3 text-truncate'>
                      <h6 class='mb-0  fw-bold'>Una Coleman</h6>
                      <span class='text-muted'>una.coleman@gmail.com</span>
                    </div>
                    <div class='members-action'>
                      <div class='btn-group'>
                        <button type='button' class='btn bg-transparent dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
                          Members
                        </button>
                        <ul class='dropdown-menu dropdown-menu-end'>
                          <li>
                            <a class='dropdown-item' href='#'>
                              <i class='icofont-check-circled'></i>
                              <span>All operations permission</span>
                            </a>
                          </li>
                          <li>
                            <a class='dropdown-item' href='#'>
                              <i class='fs-6 p-2 me-1'></i>
                              <span>Only Invite & manage team</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                      <div class='btn-group'>
                        <div class='btn-group'>
                          <button type='button' class='btn bg-transparent dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
                            <i class='icofont-ui-settings  fs-6'></i>
                          </button>
                          <ul class='dropdown-menu dropdown-menu-end'>
                            <li><a class='dropdown-item' href='#'><i class='icofont-ui-password fs-6 me-2'></i>ResetPassword</a></li>
                            <li><a class='dropdown-item' href='#'><i class='icofont-chart-line fs-6 me-2'></i>ActivityReport</a></li>
                            <li><a class='dropdown-item' href='#'><i class='icofont-delete-alt fs-6 me-2'></i>Suspend member</a></li>
                            <li><a class='dropdown-item' href='#'><i class='icofont-not-allowed fs-6 me-2'></i>Delete Member</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Members End-->
";
?>
