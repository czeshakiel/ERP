<main id="main" class="main">
    <div class="pagetitle">
        <h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?dashboard">Main</a></li>
            <li class="breadcrumb-item"><a href="?census_report">Census Report</a></li>
          </ol>
        </nav>
    </div>
    <!-- body pages of Census Report -->
    <section class="section">
        <div class="border-0 mb-4">
            <div class="card-header no-bg bg-transparent d-flex align-items-center justify-content-between border-bottom flex-wrap">
                <h5 class="fw-bold mb-0">Census Report</h5>
                <div class="col-md-6 mt-3">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="col-auto d-flex justify-content-end align-items-center">
                                <label for="year-select" class="text-end fs-6"><b>Year:&nbsp;</b></label>
                                <select id="year-select" class="form-select text-center w-50 fs-6 fw-bold"></select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="col-auto d-flex justify-content-center align-items-center">
                                <button type="button" onclick="createNbsCensusReport()" class="btn btn-dark btn-set-task w-100 text-center" data-bs-toggle="modal" data-bs-target="#createtask">
                                    <i class="icofont-plus-circle me-2 fs-6"></i><span class="fs-6">Create Report</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="row align-item-center">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body basic-custome-color">
                        <div class="table-responsive" id="nbs_report_list">
                        </div>
                    </div>
                </div>
             </div>
        </div>
    </section>
</main>