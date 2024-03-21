<main id="main" class="main">
    <div class="pagetitle">
        <h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?dashboard">Main</a></li>
            <li class="breadcrumb-item"><a href="?search_archive">Search Archive</a></li>
          </ol>
        </nav>
    </div>
    <!-- body pages of IPD request -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
                <div class='planned_task client_task'>
                      <div class='dd-handle'>
                          <div class='row'>
                              <div class="col-6">
                                  <input type="text" class="form-control seach_input" id="search_patient" placeholder="Enter lastname, firstname" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="manual" data-bs-content="Please enter a search term.">
                              </div>
                              <div class="col-4">
                                    <button type="submit" class="srch_button" onclick="search_archpatient()">
                                      <span class="span">🔎</span>
                                    </button>
                              </div>
                              <div class="col-2 reslt d-flex align-items-center justify-content-center" id="search_result_container"><span id="search_result"></span></div>
                          </div>
                      </div>
                    <div id="srch_datalist">
                      <div class="dd-handle" id="myloader" style="margin-top:10px; display:none;">
                        <div class="mt-20 mydloader" id="myloader">
                            <div class="tb_loading">
                              <div class="cube">
                                <div class="side front"></div>
                                <div class="side back"></div>
                                <div class="side top"></div>
                                <div class="side bottom"></div>
                                <div class="side left"></div>
                                <div class="side right"></div>
                              </div>
                            </div>
                            <span class="text-center loaderlabel">LOADING...</span>
                          </div>
                      </div>
                      <div id="table_patientlist"></div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</main>

<!-- loginuser pf modal -->
<div class="modal fade" id="loginuserDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content moumodal">
           <div class="modal-body">
                <img src="assets/images/lg/unknown.png" alt="userlog-image">
                <div class="form-group nm_dtls">
                    <span id="loginuser-name" class="usr_fname"></span><br>
                    <span id="job-title" class="usr_jtttle"></span>
                </div>
           </div>
           <div class="modal-footer" style="text-align: center;">
                <button class="btn btn-primary" data-bs-dismiss="modal">Close</button>
           </div>
        </div>
    </div>
</div>

<script src="ser-sid-scr/myjs/onclickevent.js"></script>
<script>
$(document).ready(function() {
  $('.selectsearch').select2({
      placeholder: 'Select reader...',
      openOnEnter: true,
      allowClear: true,
      dropdownParent: $('#proceedTestdoneModal'),
      ajax: {
        url: 'ser-sid-scr/myphp/selection_fetch_data.php',
        dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term
                };
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
      }
  });
}); 
</script>