<main id="main" class="main">
    <div class="pagetitle">
        <h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?dashboard">Main</a></li>
            </ol>
        </nav>
    </div>
 <!-- Body: Body -->
      <div class="body d-flex py-3">
            <div class="container-xxl">
                <div class="row clearfix g-3">
                    <div class="col-xl-8 col-lg-12 col-md-12 flex-column">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                        <h6 class="mb-0 fw-bold ">Today's Newborn</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-2 row-deck">
                                            <div class="col-md-6 col-sm-6">
                                                <div class="card">
                                                    <div class="card-body ">
                                                        <img src="assets/images/lg/baby.png" alt="IPD Baby" style='width:30px'>
                                                        <h6 class="mt-3 mb-0 fw-bold small-14">IPD Request</h6>
                                                        <span class="text-muted" id="totalipd"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <img src="assets/images/lg/scan.png" alt="OPD Baby" style='width:30px'>
                                                        <h6 class="mt-3 mb-0 fw-bold small-14">OPD Request</h6>
                                                        <span class="text-muted" id="totalopd"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <img src="assets/img/babyipd.png" alt="IPD Baby" style='width:30px'>
                                                        <h6 class="mt-3 mb-0 fw-bold small-14">IPD Patient</h6>
                                                        <span class="text-muted" id="todIpdCount"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <img src="assets/img/babyopd.png" alt="IPD Baby" style='width:30px'>
                                                        <h6 class="mt-3 mb-0 fw-bold small-14">OPD Patient</h6>
                                                        <span class="text-muted" id="todOpdCount"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                        <h6 class="mb-0 fw-bold ">Total Newborn <span style="color:blue" id="ths_year"></span></h6>
                                        <h4 class="mb-0 fw-bold "><span id="ttlnwbrn"></span></h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="mt-3" id="apexMainCategories"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                        <h6 class="mb-0 fw-bold ">Newborn Patient Monthly Census for a Year <span style="color:blue" id="ths_year2"></span></h6>
                                    </div>
                                    <div class="card-body">
                                        <div id="newborn-resources"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12 col-md-12">
                        <div class="row g-3 row-deck">
                            <div class="col-md-6 col-lg-6 col-xl-12">
                                <div class="card bg-primary">
                                    <div class="card-body row">
                                        <div class="col">
                                            <span class="avatar lg bg-white rounded-circle text-center d-flex align-items-center justify-content-center"><i class="icofont-baby fs-5"></i></span>
                                            <h1 class="mt-3 mb-0 fw-bold text-white"><span id="nwcnt"></span></h1>
                                            <span class="text-white">Newborn</span>
                                        </div>
                                        <div class="col">
                                            <img class="img-fluid" src="assets/images/Pediatrician-cuate.svg" alt="interview">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-12  flex-column">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center flex-fill">
                                            <span class="avatar lg light-success-bg rounded-circle text-center d-flex align-items-center justify-content-center"><i class="icofont-baby fs-5"></i></span>
                                            <div class="d-flex flex-column ps-3  flex-fill">
                                                <h6 class="fw-bold mb-0 fs-4"><span id="nbScreening"></span></h6>
                                                <span class="text-muted">NEWBORN SCREENING</span>
                                            </div>
                                            <i class="icofont-chart-bar-graph fs-3 text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center flex-fill">
                                            <span class="avatar lg light-success-bg rounded-circle text-center d-flex align-items-center justify-content-center"><i class="icofont-listening fs-5"></i></span>
                                            <div class="d-flex flex-column ps-3 flex-fill">
                                                <h6 class="fw-bold mb-0 fs-4"><span id="nbHearing"></span></h6>
                                                <span class="text-muted">NEWBORN HEARING TEST</span>
                                            </div>
                                            <i class="icofont-chart-line fs-3 text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center flex-fill">
                                            <span class="avatar lg light-success-bg rounded-circle text-center d-flex align-items-center justify-content-center"><i class="icofont-headphone-alt-1 fs-5"></i></span>
                                            <div class="d-flex flex-column ps-3 flex-fill">
                                                <h6 class="fw-bold mb-0 fs-4"><span id="nbAudiometry"></span></h6>
                                                <span class="text-muted">AUDIOMETRY</span>
                                            </div>
                                            <i class="icofont-chart-histogram-alt fs-3 text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center flex-fill">
                                            <span class="avatar lg light-success-bg rounded-circle text-center d-flex align-items-center justify-content-center"><i class="icofont-baby-backpack fs-5"></i></span>
                                            <div class="d-flex flex-column ps-3 flex-fill">
                                                <h6 class="fw-bold mb-0 fs-4"><span id="expdnewbornkit">0</span></h6>
                                                <span class="text-muted">EXPANDED NEWBORN KIT</span>
                                            </div>
                                            <i class="icofont-chart-flow fs-3 text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center flex-fill">
                                            <span class="avatar lg light-success-bg rounded-circle text-center d-flex align-items-center justify-content-center"><i class="icofont-spinner-alt-3 fs-5"></i></span>
                                            <div class="d-flex flex-column ps-3 flex-fill">
                                                <h6 class="fw-bold mb-0 fs-4"><span id="repeatnewborn">0</span></h6>
                                                <span class="text-muted">REPEAT NEWBORN SCREENING & HEARING TEST</span>
                                            </div>
                                            <i class="icofont-chart-pie fs-3 text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>
<script src="ser-sid-scr/myjs/crickets.js"></script>