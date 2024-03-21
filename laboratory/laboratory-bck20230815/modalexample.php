<?php
echo "
    <!-- Body: Body -->
    <div class='body d-flex py-lg-3 py-md-2'>
      <div class='container-xxl'>
        <div class='row align-items-center'>
          <div class='border-0 mb-4'>
            <div class='card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap'>
              <h3 class='fw-bold mb-0'>Team Leaders</h3>
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
                      <th>Leader Name</th>
                      <th>Project</th>
                      <th>Total Task</th>
                      <th>Email</th>
                      <th>Project Assigned</th>
                      <th>Assigned Staff</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <img class='avatar rounded-circle' src='../main/assets/images/xs/avatar1.jpg' alt=''>
                        <span class='fw-bold ms-1'>Joan Dyer</span>
                      </td>
                      <td>
                        <a href='projects.html'>Box of Crayons</a>
                      </td>
                      <td>
                        <a href='task.html'>5 Task</a>
                      </td>
                      <td>
                        <a href='mailto:'>JoanDyer@gmail.com</a>
                      </td>
                      <td>
                        23/02/21
                      </td>
                      <td>
                        <div class='avatar-list avatar-list-stacked px-3'>
                          <img class='avatar rounded-circle sm' src='../main/assets/images/xs/avatar2.jpg' alt=''>
                          <img class='avatar rounded-circle sm' src='../main/assets/images/xs/avatar1.jpg' alt=''>
                          <img class='avatar rounded-circle sm' src='../main/assets/images/xs/avatar3.jpg' alt=''>
                          <img class='avatar rounded-circle sm' src='../main/assets/images/xs/avatar4.jpg' alt=''>
                          <img class='avatar rounded-circle sm' src='../main/assets/images/xs/avatar7.jpg' alt=''>
                          <img class='avatar rounded-circle sm' src='../main/assets/images/xs/avatar8.jpg' alt=''>
                          <span class='avatar rounded-circle text-center pointer sm' data-bs-toggle='modal' data-bs-target='#addUser'><i class='icofont-ui-add'></i></span>
                        </div>
                      </td>
                      <td>
                        <span class='badge bg-success'>Working</span>
                      </td>
                      <td>
                        <div class='btn-group' role='group' aria-label='Basic outlined example'>
                          <button type='button' class='btn btn-outline-secondary'><i class='icofont-edit text-success'></i></button>
                          <button type='button' class='btn btn-outline-secondary deleterow'><i class='icofont-ui-delete text-danger'></i></button>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
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
