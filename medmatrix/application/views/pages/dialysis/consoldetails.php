<!-- plugin css file  -->
<link rel='stylesheet' href='../main/assets/plugin/datatables/responsive.dataTables.min.css'>
<link rel='stylesheet' href='../main/assets/plugin/datatables/dataTables.bootstrap5.min.css'>
<style>
  .mbtus{background-color: #B1D7FC;color: #000000;font-weight: bold;border-left: none;border-right: none;border-top: 1px solid #000000;border-bottom: 1px solid #000000;padding: 5px 15px;}
  .mbtus:hover{background-color: #2B7FD2;color: #FFFFFF;}
  .mbts{background-color: #FB63B1;color: #FFFFFF;font-weight: bold;border-left: none;border-right: none;border-top: 1px solid #000000;border-bottom: 1px solid #000000;padding: 5px 15px;}
  .mbts:hover{background-color: #EB0078;}
</style>

<?php
$csnsp=preg_split("/\//",$_SERVER['REQUEST_URI']);
$rcsno=$csnsp[4];

echo "
    <!-- Body: Body -->
    <div class='body d-flex py-lg-3 py-md-2'>
      <div class='container-xxl'>
";

include("profile.php");

echo "
        <div class='row clearfix g-3'>
          <div class='col-sm-12'>
            <div class='card mb-3'>

              <ul class='nav nav-tabs nav-tabs-bordered'>
                <li class='nav-item'>
                  <button class='nav-link hover-effect' data-bs-toggle='tab' data-bs-target='#p1'><font size='2%'><i class='icofont-medicine'></i> Medicine(s)</font></button>
                </li>
                <li class='nav-item'>
                  <button class='nav-link active hover-effect' data-bs-toggle='tab' data-bs-target='#p2'><font size='2%'><i class='icofont-thermometer-alt'></i> Supplies</font></button>
                </li>
                <li class='nav-item'>
                  <button class='nav-link hover-effect' data-bs-toggle='tab' data-bs-target='#p3'><font size='2%'><i class='icofont-flask'></i> Laboratories</font></button>
                </li>
                <li class='nav-item'>
                  <button class='nav-link hover-effect' data-bs-toggle='tab' data-bs-target='#p4'><font size='2%'><i class='icofont-nurse-alt'></i> Other Charges</font></button>
                </li>
                <li class='nav-item'>
                  <button class='nav-link hover-effect' data-bs-toggle='tab' data-bs-target='#p5'><font size='2%'><i class='icofont-undo'></i> Return Usage</font></button>
                </li>
                <li class='nav-item'>
                  <button class='nav-link hover-effect' data-bs-toggle='tab' data-bs-target='#p6'><font size='2%'><i class='icofont-link-broken'></i> Damage Item(s)</font></button>
                </li>
                <li class='nav-item'>
                  <button class='nav-link hover-effect' data-bs-toggle='tab' data-bs-target='#p7'><font size='2%'><i class='icofont-close-circled'></i> Cancelled</font></button>
                </li>

              </ul>
              <div class='tab-content pt-2'>
                <div class='tab-pane fade show' id='p1'>
";

include('details/med.php');

echo "
                </div>
                <div class='tab-pane fade show active' id='p2'>
";

include('details/sup.php');

echo "
                </div>
                <div class='tab-pane fade show' id='p3'>
";

include('details/lab_xray.php');

echo "
                </div>
                <div class='tab-pane fade show' id='p4'>
";

include('details/othercharges.php');

echo "
                </div>
                <div class='tab-pane fade show' id='p5'>
";

include('details/return.php');

echo "
                </div>
                <div class='tab-pane fade show' id='p6'>
";

include('details/damage.php');

echo "
                </div>
                <div class='tab-pane fade show' id='p7'>
";

include('details/cancelled.php');

echo "
                </div>
              </div>

            </div>
          </div>
        </div><!-- Row End -->
      </div>
    </div>
";
?>

<!-- Jquery Core Js -->
<script src='../main/assets/bundles/libscripts.bundle.js'></script>
<!-- Plugin Js-->
<script src='../main/assets/bundles/dataTables.bundle.js'></script>
<!-- Jquery Page Js -->
<script src='../main/template.js'></script>
<script>
  // project data table
  $(document).ready(function() {
    $('#myProjectTable')
    .addClass( 'nowrap' )
    .dataTable( {
      responsive: true,
      columnDefs: [
        { targets: [-1, -3], className: 'dt-body-right' }
      ]
    });
    $('.deleterow').on('click',function(){
      var tablename = $(this).closest('table').DataTable();
      tablename
        .row( $(this)
        .parents('tr') )
        .remove()
        .draw();
    } );
  });
</script>
