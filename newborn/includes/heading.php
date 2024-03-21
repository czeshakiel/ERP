<?php
echo "
    <!-- Body: Header -->
    <div class='header'>
      <nav class='navbar py-4'>
        <div class='container-xxl'>
          <!-- header rightbar icon -->
          <div class='h-right d-flex align-items-center mr-5 mr-lg-0 order-1'>
            <div class='d-flex'>

            </div>
            <div class='dropdown notifications zindex-popover'>
              <a class='nav-link dropdown-toggle pulse' href='#' role='button' data-bs-toggle='dropdown'>
                <i class='icofont-alarm fs-5'></i>
                <span class='pulse-ring'></span>
              </a>
              <div id='NotificationsDiv' class='dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-sm-end p-0 m-0'>
                <div class='card border-0 w380'>
                  <div class='card-header border-0 p-3'>
                    <h5 class='mb-0 font-weight-light d-flex justify-content-between'>
                      <span>Notifications</span>
                      <span class='badge text-white'>11</span>
                    </h5>
                  </div>
                  <div class='tab-content card-body'>
                    <div class='tab-pane fade show active'>
                      <ul class='list-unstyled list mb-0'>
                        <li class='py-2 mb-1 border-bottom'>
                          <a href='javascript:void(0);' class='d-flex'>
                            <img class='avatar rounded-circle' src='".$ipadd."/assets/images/xs/avatar1.jpg' alt=''>
                            <div class='flex-fill ms-2'>
                              <p class='d-flex justify-content-between mb-0 '><span class='font-weight-bold'>Dylan Hunter</span> <small>2MIN</small></p>
                              <span class=''>Added  2021-02-19 my-Task ui/ux Design <span class='badge bg-success'>Review</span></span>
                            </div>
                          </a>
                        </li>
                        <li class='py-2 mb-1 border-bottom'>
                          <a href='javascript:void(0);' class='d-flex'>
                            <div class='avatar rounded-circle no-thumbnail'>DF</div>
                            <div class='flex-fill ms-2'>
                              <p class='d-flex justify-content-between mb-0 '><span class='font-weight-bold'>Diane Fisher</span> <small>13MIN</small></p>
                              <span class=''>Task added Get Started with Fast Cad project</span>
                            </div>
                          </a>
                        </li>
                        <li class='py-2 mb-1 border-bottom'>
                          <a href='javascript:void(0);' class='d-flex'>
                            <img class='avatar rounded-circle' src='".$ipadd."/assets/images/xs/avatar3.jpg' alt=''>
                            <div class='flex-fill ms-2'>
                              <p class='d-flex justify-content-between mb-0 '><span class='font-weight-bold'>Andrea Gill</span> <small>1HR</small></p>
                              <span class=''>Quality Assurance Task Completed</span>
                            </div>
                          </a>
                        </li>
                        <li class='py-2 mb-1 border-bottom'>
                          <a href='javascript:void(0);' class='d-flex'>
                            <img class='avatar rounded-circle' src='".$ipadd."/assets/images/xs/avatar5.jpg' alt=''>
                            <div class='flex-fill ms-2'>
                              <p class='d-flex justify-content-between mb-0 '><span class='font-weight-bold'>Diane Fisher</span> <small>13MIN</small></p>
                              <span class=''>Add New Project for App Developemnt</span>
                            </div>
                          </a>
                        </li>
                        <li class='py-2 mb-1 border-bottom'>
                          <a href='javascript:void(0);' class='d-flex'>
                            <img class='avatar rounded-circle' src='".$ipadd."/assets/images/xs/avatar6.jpg' alt=''>
                            <div class='flex-fill ms-2'>
                              <p class='d-flex justify-content-between mb-0 '><span class='font-weight-bold'>Andrea Gill</span> <small>1HR</small></p>
                              <span class=''>Add Timesheet For Rhinestone project</span>
                            </div>
                          </a>
                        </li>
                        <li class='py-2'>
                          <a href='javascript:void(0);' class='d-flex'>
                            <img class='avatar rounded-circle' src='".$ipadd."/assets/images/xs/avatar7.jpg' alt=''>
                            <div class='flex-fill ms-2'>
                              <p class='d-flex justify-content-between mb-0 '><span class='font-weight-bold'>Zoe Wright</span> <small class=''>1DAY</small></p>
                              <span class=''>Add Calander Event</span>
                            </div>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <a class='card-footer text-center border-top-0' href='#'> View all notifications</a>
                </div>
              </div>
            </div>
            <div class='dropdown user-profile ml-2 ml-sm-3 d-flex align-items-center zindex-popover'>
              <div class='u-info me-2'>
                <p class='mb-0 text-end line-height-sm '><span class='font-weight-bold'>".$user."</span></p>
                <small>".$dspst."</small>
              </div>
              <a class='nav-link dropdown-toggle pulse p-0' href='#' role='button' data-bs-toggle='dropdown' data-bs-display='static'>
                <img class='avatar lg rounded-circle img-thumbnail' src='".$ipadd."/assets/images/profile_av.png' alt='profile'>
              </a>
              <div class='dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0'>
                <div class='card border-0 w280'>
                  <div class='card-body pb-0'>
                    <div class='d-flex py-1'>
                      <img class='avatar rounded-circle' src='".$ipadd."/assets/images/profile_av.png' alt='profile'>
                      <div class='flex-fill ms-3'>
                        <p class='mb-0'><span class='font-weight-bold'>$user</span></p>
                        <small class=''>".$dspst."</small>
                      </div>
                    </div>
                    <div><hr class='dropdown-divider border-dark'></div>
                  </div>
                  <div class='list-group m-2 '>
                    <!--a href='task.html' class='list-group-item list-group-item-action border-0 '><i class='icofont-tasks fs-5 me-3'></i>My Task</a>
                    <a href='members.html' class='list-group-item list-group-item-action border-0 '><i class='icofont-ui-user-group fs-6 me-3'></i>members</a-->
                    "; ?>
                    <a  href="javascript:void(0);"  onclick="c_load(this.id);" data-bs-toggle="modal" data-bs-target="#basicModal" class='list-group-item list-group-item-action border-0 '><i class='icofont-logout fs-6 me-3'></i>Sign out</a>
                    <?php echo"
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- menu toggler -->
          <button class='navbar-toggler p-0 border-0 menu-toggle order-3' type='button' data-bs-toggle='collapse' data-bs-target='#mainHeader'>
            <span class='fa fa-bars'></span>
          </button>
          <!-- Company Header-->
          <div>
            <table width='100%'>
              <tr>
                <td width='10%'><img src='".$ipadd."/assets/img/logo/kmsci2.png' width='60px'></td>
                <td style='font-size: 13px;'><b>$heading</b><br>$address<br>$telno</td>
              </tr>
            </table>
          </div>
        </div>
      </nav>
    </div>
";
?>

<form method="POST" action="includes/logout.php">
<div class="modal fade" id="basicModal" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Ohh No!!!</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">Are you sure you want to logout?</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Logout</button>
</div>
</div>
</div>
</div>
</form>
