<?php
session_start();
if (!isset($_SESSION['selectedRequestType']) || ($_SESSION['selectedRequestType'] != 'IPD' && $_SESSION['selectedRequestType'] != 'OPD')) {
echo "<script>window.location.href='index.php?page=dashboard';</script>";
exit;
}
$reqType = $_SESSION['selectedRequestType'];
?>
<main id="main" class="main">
    <div class="pagetitle">
        <h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?dashboard">Main</a></li>
            <li class="breadcrumb-item"><a href="?requests"><?=$reqType;?> Request</a></li>
          </ol>
        </nav>
    </div>
    <!-- body pages of IPD request -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body border-0 bg-transparent" id="req-loader">
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
            <div class="card-body" id="req-content"></div>
          </div>
        </div>
      </div>
    </section>  
</main>
<!-- requested user -->
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
<script>
$(document).ready(function() {
    $('#req-loader').show();
    $.ajax({
        url: 'ser-sid-scr/myphp/request_datatable.php',
        type: 'POST',
        dataType: 'html',
        data: { selectedRequestType: '<?php echo $reqType; ?>' },
        success: function(data) {
            $('#req-loader').hide();
            $('#req-content').html(data).show();
            reinitializeTooltips();
        },
        error: function() {
            console.error('Error loading data.');
        }
    });
});
</script>