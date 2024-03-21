<main id="main" class="main">
    <div class="pagetitle">
        <h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?dashboard">Main</a></li>
            <li class="breadcrumb-item"><a href="?readers_report">Readers Report</a></li>
          </ol>
        </nav>
    </div>
    <!-- body pages of IPD request -->
    <section class="section">
        <div class="body d-flex py-3">
            <div class="container-xxl">
                <div class='dd-handle col-6'>
                        <div class="alert alert-primary p-3 mb-0 w-100">
                            <h6 class="fw-bold mb-1">AUDIOMETRY PF CASH PAID REPORT</h6>
                            <p class="small mb-4"></p>
                            <div class="my-3">
                                <label for="selected_stock">Reader:</label>
                                <select class="form-select" id="readerSelect" ></select>
                            </div>
                            <div class="my-3">
                                <label for="dateFrom">Date from:</label>
                                <input type="date" class="form-control" value="<?php echo date('Y-m-01');?>" id="dateFrom">
                            </div>
                            <div class="my-3">
                                <label for="dateTo">Date to:</label>
                                <input type="date" class="form-control" value="<?php echo date('Y-m-t');?>" id="dateTo">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="prccd-btn" onclick="generate_pfreport()">
                                    <div class="svg-wrapper-1">
                                        <div class="svg-wrapper">
                                            <svg viewBox="0 0 24 24" width="24" height="24">
                                              <path fill="none" d="M0 0h24v24H0z"></path>
                                              <path fill="currentColor" d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"></path>
                                            </svg>
                                            </div>
                                        </div>
                                    <span> Proceed</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="ser-sid-scr/myjs/onclickevent.js"></script>
<script>
$(document).ready(function() {
    $('#readerSelect').select2({
        theme: "bootstrap-5",
        closeOnSelect: true,
        placeholder: 'Select reader...'
    });
});
</script>