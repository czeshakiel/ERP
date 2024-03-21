<style>
.custom-icon {
  display: inline-block;
  width: 24px;
  height: 24px;
  background-image: url('assets/img/big-data.png');
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center center;
  filter: invert(1);
}
.babylogo{
    width: 70px;
    height: auto;
    position: relative;
    border-radius: 50%;
}
</style>
 <button class="hamburger" onclick="sbview()"><i class='icofont-navigation-menu'></i></button>  
    <!-- sidebar -->
    <div class="sidebar px-4 py-4 py-md-5 me-0">
        <div class="d-flex flex-column h-100">
            <a href="" class="mb-0 brand-icon">
                <span class="logo-icon">
                   <img src="assets/img/logo/babylogo.jpg" alt="" class="babylogo">
                </span>
                <span class="logo-text">New Born Screening</span>
            </a>
            <!-- Menu: main ul -->
            <ul class="menu-list flex-grow-1 mt-3">
                <li class="collapsed">
                    <a class="m-link active" href="?dashboard"><i class="icofont-home fs-5"></i> <span>Dashboard</span></a>
                </li>
                <li  class="collapsed">
                    <a class="m-link"  data-bs-toggle="collapse" data-bs-target="#requestsComponents" href="#">
                        <i class="icofont-hand-drag1"></i><span> Requests</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    <ul class="sub-menu collapse" id="requestsComponents">
                        <li><a class="ms-link" href="" onclick="handleRequestClick('IPD')"><span><i class="icofont-stylish-right"></i>  IPD Request</span></a></li>
                        <li><a class="ms-link" href="" onclick="handleRequestClick('OPD')"><span><i class="icofont-stylish-right"></i>  OPD Request</span></a></li>
                    </ul>
                </li>
                <li><a class="m-link" href="?search_archive"><i class="icofont-search-user"></i> <span> Search Archives</span></a></li>
                <li  class="collapsed">
                    <a class="m-link"  data-bs-toggle="collapse" data-bs-target="#servicesComponents" href="#">
                        <i class="icofont-architecture-alt"></i><span> Other Services</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    <ul class="sub-menu collapse" id="servicesComponents">
                        <li><a class="ms-link" href="?readers_report"><span><i class="icofont-stylish-right"></i>  Readers Fee Report</span></a></li>
                        <li><a class="ms-link" href="?stockrequest"><span><i class="icofont-stylish-right"></i>  Stock Requisition</span></a></li>
                        <li><a class="ms-link" href="?estockcard"><span><i class="icofont-stylish-right"></i>  Electronic Stockcard</span></a></li>
                        <li><a class="ms-link" href="?password&trans=adjustment"><span><i class="icofont-stylish-right"></i> Adjustment Entry</span></a></li>
                    </ul>
                </li>
                <li class="collapsed">
                    <a class="m-link"  data-bs-toggle="collapse" data-bs-target="#reportsComponents" href="#">
                        <i class="icofont-ui-file"></i><span> Reports</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    <ul class="sub-menu collapse" id="reportsComponents">
                        <li><a class="ms-link" href="?audiometry_report"><span><i class="icofont-stylish-right"></i>  Audiometry Report</span></a></li>
                        <li><a class="ms-link" href="?census_report"><span><i class="icofont-stylish-right"></i>  NBS Census Report</span></a></li>
                        <li><a class="ms-link" href="?repeat_report"><span><i class="icofont-stylish-right"></i>  NBS Repeat Report</span></a></li>
                    </ul>
                </li>
            </ul>

            <!-- Theme: Switch Theme -->
            <ul class="list-unstyled mb-0">
                <li class="d-flex align-items-center justify-content-center">
                    <div class="form-check form-switch theme-switch">
                        <input class="form-check-input" type="checkbox" id="theme-switch">
                        <label class="form-check-label" for="theme-switch">Enable Dark Mode!</label>
                    </div>
                </li>
            </ul>
        </div>
    </div>
