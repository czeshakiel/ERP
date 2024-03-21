<!doctype html>
<html class='no-js' lang='en' dir='ltr'>
<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=Edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
  <title>KMSCI Laboratory</title>
  <link rel='icon' href='../main/assets/favicon/favicon.png' type='image/png' />
  <link rel='shortcut icon' href='../main/assets/favicon/favicon.png' type='image/png' />
  <!-- plugin css file  -->
  <link rel='stylesheet' href='../main/assets/plugin/datatables/responsive.dataTables.min.css'>
  <link rel='stylesheet' href='../main/assets/plugin/datatables/dataTables.bootstrap5.min.css'>
  <!-- project css file  -->
  <link rel='stylesheet' href='../main/assets/css/my-task.style.min.css'>
  <!-- my style  -->
  <link rel='stylesheet' href='myrs/mystyle.css'>
</head>
<body>
<?php
ini_set("display_errors","On");
include("../main/class2.php");

echo "
<div id='mytask-layout' class='theme-indigo'>
";

//sidebar
include("sidebar.php");

echo "
  <!-- main body area -->
  <div class='main px-lg-4 px-md-4'>
";

//Body: Header
include("../main/heading.php");

//Body: Body
if(isset($_GET['opdreq'])){include("main.php");}
else if(isset($_GET['searcharchive'])){include("searcharchive.php");}
else if(isset($_GET['exp'])){include("exp.php");}
else if(isset($_GET['expabg'])){include("expabg.php");}
else if(isset($_GET['pl'])){include("pl.php");}
else if(isset($_GET['snv'])){include("snv.php");}
else if(isset($_GET['tick'])){include("tick.php");}
else if(isset($_GET['cart'])){include("cart.php");}
else if(isset($_GET['details'])){
  if(isset($_POST['stest'])){
    include("allaboutresults.php");
  }
  else if(isset($_POST['eres'])){
    include("allaboutresults.php");
  }
  else{
    include("details.php");
  }
}
else if(isset($_GET['stockrequest'])){include("stockrequest.php");}
else{include("main.php");}

echo "
  </div>
</div>
";

if((!isset($_SESSION['un']))&&(!isset($_SESSION['pw']))&&(!isset($_SESSION['nm']))&&(!isset($_SESSION['ac']))){
echo "
<!-- Leave Reject-->
<div class='modal fade' id='leavereject' tabindex='-1' data-bs-keyboard='false' data-bs-backdrop='static'>
  <div class='modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title text-danger fw-bold' id='leaverejectLabel' style='font-weight: bold;'> Warning!!!</h5>
        <a href='../login/?dept=LABORATORY'><button type='button' class='btn-close' aria-label='Close'></button></a>
      </div>
      <div class='modal-body justify-content-center flex-column d-flex'>
        <i class='icofont-sad text-danger display-2 text-center mt-2'></i>
        <p class='mt-4 fs-5 text-danger text-center' style='font-weight: bold;'>You're Logged out!</p>
      </div>
    </div>
  </div>
</div>
";
}
else{
  $sun=$_SESSION['un'];
  $spw=$_SESSION['pw'];
  $snm=$_SESSION['nm'];
  $sac=$_SESSION['ac'];

  $sfn=$_SESSION['fullname'];
  $sul=$_SESSION['user_login'];

  $_SESSION['un']=$sun;
  $_SESSION['pw']=$spw;
  $_SESSION['nm']=$snm;
  $_SESSION['ac']=$sac;

  $_SESSION['fullname']=$sfn;
  $_SESSION['user_login']=$sul;
}

?>
<!-- Jquery Core Js -->
<script src='../main/assets/bundles/libscripts.bundle.js'></script>
<!-- Plugin Js-->
<script src='../main/assets/bundles/dataTables.bundle.js'></script>
<!-- Jquery Page Js -->
<script src='../js/template.js'></script>

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

<script>
  var myModal = new bootstrap.Modal(document.getElementById('leavereject'), {})
  myModal.show();
</script>

</body>
</html>
