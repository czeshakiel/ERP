<?php
if(isset($_GET['opdprocedure'])){$lb="OPD Procedure Patient/s";}
else{$lb="Active In-patient/s";}

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
                      <th>#</th>
                      <th>Case No.</th>
                      <th>Patient Name</th>
                      <th>Adm. Date</th>
                      <th>Room</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
";

$adm=0;
mysqli_query($conn,"SET NAMES 'utf8'");

if(isset($_GET['opdprocedure'])){$admsql=mysqli_query($conn,"SELECT a.`caseno`, a.`membership`, a.`hmomembership`, a.`hmo`, a.`room`, p.`lastname`, p.`firstname`, p.`middlename`, p.`suffix`, p.`sex`, a.`dateadmit`, a.`status`, a.`result` FROM `admission` a, `patientprofile` p WHERE (a.`room`='ER' OR a.`room`='ONCO') AND (a.`ward` NOT LIKE '%discharged%' AND a.`ward` NOT LIKE '%CANCELLED%') AND (a.`status`  NOT LIKE 'discharged' AND a.`status`  NOT LIKE 'CANCELLED') AND a.`patientidno`=p.`patientidno` AND (a.`employerno` LIKE '%M%' OR a.`employerno` LIKE '%ONCO%' OR a.`employerno` LIKE '%E%') ORDER BY p.`lastname`, p.`firstname` ASC");}
else{$admsql=mysqli_query($conn,"SELECT a.`caseno`, a.`membership`, a.`hmomembership`, a.`hmo`, a.`room`, p.`lastname`, p.`firstname`, p.`middlename`, p.`suffix`, p.`sex`, a.`dateadmit`, a.`status`, a.`result` FROM `admission` a, `patientprofile` p WHERE a.`ward`='in' AND a.`patientidno`=p.`patientidno` AND a.`room` NOT LIKE '%OPD%' GROUP BY a.`caseno` ORDER BY p.`lastname`, p.`firstname` ASC");}

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

  if($res=="FINAL"){
    $sta="BILL FINALIZED";
    $trc="table-info";
  }

echo "
                    <tr class='$trc'>
                      <td><div align='left'style='font-size: 11px;'>$adm</div></td>
                      <td><div align='left' style='font-size: 11px;'>$caseno</div></td>
                      <td><div align='left' style='font-size: 11px;'><a href='?details&caseno=$caseno&dept=BILLING&user=".$aun."' target='_blank'><img class='avatar rounded-circle' src='../main/assets/images/xs/$imgs.jpg' height='5' width='auto' alt='$alts' /></a><span class='fw-bold ms-1'>$pn</span></div></td>
                      <td><div align='center' style='font-size: 11px;'>".date("M d, Y",strtotime($dad))."</div></td>
                      <td><div align='left' style='font-size: 11px;'>$rom</div></td>
                      <td><div align='center' style='font-size: 11px;font-weight: bold;'>".ucwords(strtolower($sta))."</div></td>
                      <td>
                        <div align='center'>
                          <!--a href='../extra/BillMe/?caseno=$caseno&dept=BILLING&user=".$aun."' target='_blank'><button type='button' class='btn btn-outline-secondary'><i class='icofont-eye-alt text-success'></i></button></a-->
                          <a href='?details&caseno=$caseno&dept=BILLING&user=".$aun."' target='_blank'><button type='button' class='btn btn-outline-secondary'><i class='icofont-eye-alt text-success'></i></button></a>
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
