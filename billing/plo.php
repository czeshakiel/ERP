<?php
$lb="Other Charges/Fees Price List";

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
                <table id='myProjectTable' class='table table-hover align-middle mb-0' width='100%'>
                  <thead>
                    <tr>
                      <th><div align='center'>#</div></th>
                      <th><div align='center'>Description</div></th>
                      <th><div align='center'>Type</div></th>
                      <th><div align='center'>Cash Price</div></th>
                      <th><div align='center'>Charge Price</div></th>
                      <th><div align='center'>Status</div></th>
                    </tr>
                  </thead>
                  <tbody>
";

$adm=0;
mysqli_query($conn,"SET NAMES 'utf8'");

$ax=0;
$axsql=mysqli_query($conn,"SELECT `code`, `description`, `lotno`, `unit`, `testcode`, `gtestcode` FROM `receiving` WHERE unit NOT LIKE '%medicine%' AND unit NOT LIKE '%PHARMACY%' AND unit NOT LIKE '%ACCOUNTABLE%' AND unit NOT LIKE '%-SUPPLIES%' AND unit NOT LIKE '%LABORATORY SUPPLIES%' AND unit NOT LIKE 'GENERAL SUPPLIES' AND unit NOT LIKE '%CSR/KIT%' AND unit NOT LIKE 'RADIOLOGY SUPPLIES' AND unit NOT LIKE 'RESPIRATORY SUPPLIES' AND unit NOT LIKE 'STERILIZATION SUPPLIES' AND unit NOT LIKE 'ULTRASOUND SUPPLIES' AND unit NOT LIKE 'PT SUPPLIES' AND unit NOT LIKE 'PLUMBING' AND unit NOT LIKE '%OFFICE%%SUPPLIES%' AND unit NOT LIKE '%Nonmedical Supplies%' AND unit NOT LIKE 'HEART STATION SUPPLIES' AND unit NOT LIKE 'LAUNDRY SUPPLIES' AND unit NOT LIKE 'ELECTRICAL SUPPLIES' AND unit NOT LIKE 'CT SCAN SUPPLIES' AND unit NOT LIKE 'Housekeeping Supplies' AND unit NOT LIKE 'Equipment' AND unit NOT LIKE 'COMPUTER EQUIPMENT AND ACCESS' AND unit NOT LIKE 'HOSPITAL EQUIPMENT' AND unit NOT LIKE 'COMPUTER SUPPLIES' AND unit NOT LIKE 'LAUNDRY' AND unit NOT LIKE 'CENTRAL SUPPLIES' AND unit NOT LIKE 'HOSPITAL CSR KIT' AND unit NOT LIKE 'ECG SUPPLIES' AND unit NOT LIKE 'MEDICAL SURGICAL SUPPLIES' AND unit NOT LIKE 'PROFESSIONAL FEE' AND unit NOT LIKE 'RDU SUPPLIES' AND unit NOT LIKE '%ECG SUPPLIES%' AND unit NOT LIKE '%DIALYSIS%' AND unit NOT LIKE 'NEWBORN SCREENING SUPPLIES' AND unit NOT LIKE 'OTHERS' AND unit NOT LIKE '' AND unit NOT LIKE '2D ECHO' AND unit NOT LIKE 'CT SCAN' AND unit NOT LIKE 'ECG' AND unit NOT LIKE 'LABORATORY' AND unit NOT LIKE 'ULTRASOUND' AND unit NOT LIKE 'XRAY' AND unit NOT LIKE 'XRAY SUPPLIES' AND unit NOT LIKE 'gmap' ORDER BY `itemname`");
while($axfetch=mysqli_fetch_array($axsql)){
  $code=$axfetch['code'];
  $description=$axfetch['description'];
  $lotno=mb_strtoupper($axfetch['lotno']);
  $unit=$axfetch['unit'];
  $testcode=$axfetch['testcode'];
  $gtestcode=$axfetch['gtestcode'];
  $ax++;

  $description=str_replace("cmshi-","",$description);
  $description=str_replace("-sup","",$description);
  $description=str_replace("-med","",$description);
  $description=str_replace("ams-","",$description);
  $description=mb_strtoupper($description);

  if($lotno=="S"){$lotno="";}

  $acsql=mysqli_query($conn,"SELECT `philhealth`, `opd` FROM `productsmasterlist` WHERE `code`='$code'");
  $acfetch=mysqli_fetch_array($acsql);
  $charge=$acfetch['philhealth'];
  $cash=$acfetch['opd'];

  if($gtestcode==1){$status="<span style='color: red;'>DISABLED</span>";}else{$status="Active";}

echo "
                    <tr>
                      <td><div align='left'style='font-size: 13px;'>$ax</div></td>
                      <td><div align='left' style='font-size: 13px;font-weight: bold;'>$description</div></td>
                      <td><div align='center' style='font-size: 13px;'>$unit</div></td>
                      <td><div align='right' style='font-size: 13px;font-weight: bold;'>".number_format($cash,2)."</td>
                      <td><div align='right' style='font-size: 13px;font-weight: bold;'>".number_format($charge,2)."</div></td>
                      <td><div align='center' style='font-size: 13px;font-weight: bold;'>$status</div></td>
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