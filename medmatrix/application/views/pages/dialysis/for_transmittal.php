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
if(isset($_POST['pending'])){
  $mbtc1="mbts";
  $mbtc2="mbtus";
  $mbtc3="mbtus";

  $plabel="PENDING LIST";
}
else{
  if(isset($_POST['consol'])){
    $mbtc1="mbtus";
    $mbtc2="mbts";
    $mbtc3="mbtus";

    $plabel="CONSOLIDATED LIST";
  }
  else{
    if(isset($_POST['aconsol'])){
      $mbtc1="mbtus";
      $mbtc2="mbtus";
      $mbtc3="mbts";

      $plabel="ALL CONSOLIDATED LIST";
    }
    else{
      $mbtc1="mbts";
      $mbtc2="mbtus";
      $mbtc3="mbtus";

      $plabel="PENDING LIST";
    }
  }
}

echo "
<div class='body d-flex py-lg-3 py-md-2'>
  <div class='container-xxl'>
    <div class='row align-items-center'>
      <div class='border-0 mb-4'>
        <div class='card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap'>
          <h3 class='fw-bold mb-0'><?=$title;?></h3>
        </div>
      </div>
    </div> <!-- Row end  -->

    <div class='row align-item-center'>
      <div class='col-md-12'>
        <div class='card mb-3'>
          <div class='card-header py-3 bg-transparent border-bottom-0'>
            <table border='0' width='100%'>
              <tr>
                <td><h6 class='mb-0 fw-bold '>$plabel</h6></td>
              </tr>
            </table>
          </div>
          <div class='card-body'>
            <table border='0' width='100%' cellpadding='0' cellspacing='0'>
              <tr>
                <td><div align='left'>
                  <table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td>
                        <form method='post'>
                          <button type='submit' class='$mbtc1' name='pending' style='border-left: 1px solid #000000;'>PENDING</button>
                        </form>
                      </td>
                      <td>
                        <form method='post'>
                          <button type='submit' class='$mbtc2' name='consol' style='border-left: 1px solid #000000;'>CONSOLIDATED LIST</button>
                        </form>
                      </td>
                      <td>
                        <form method='post'>
                          <button type='submit' class='$mbtc3' name='aconsol' style='border-left: 1px solid #000000;border-right: 1px solid #000000;'>ALL CONSOLIDATED LIST</button>
                        </form>
                      </td>
                    </tr>
                  </table>
                </div></td>
              </tr>
              <tr>
                <td>
";

if(isset($_POST['pending'])){
echo "
                  <iframe src='../extra/RDUEC/fortrans.php?xix=".base64_encode($_SESSION['username'])."&yiy=".base64_encode($_SESSION['fullname'])."' title='Pending List' height='750' width='100%'></iframe>
";
}
else{
  if(isset($_POST['consol'])){
echo "
                  <iframe src='../extra/RDUEC/consol.php?xix=".base64_encode($_SESSION['username'])."&yiy=".base64_encode($_SESSION['fullname'])."' title='Consolidated List' height='750' width='100%'></iframe>
";
  }
  else{
    if(isset($_POST['aconsol'])){
echo "
                  <iframe src='../extra/RDUEC/allconsol.php?xix=".base64_encode($_SESSION['username'])."&yiy=".base64_encode($_SESSION['fullname'])."' title='Consolidated List' height='750' width='100%'></iframe>
";
    }
    else{
echo "
                  <iframe src='../extra/RDUEC/fortrans.php?xix=".base64_encode($_SESSION['username'])."&yiy=".base64_encode($_SESSION['fullname'])."' title='Pending List' height='750' width='100%'></iframe>
";
    }
  }
}

echo "
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div><!-- Row end  -->

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
