<!doctype html>
<html class='no-js' lang='en' dir='ltr'>
<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=Edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
  <title>KMSCI Billing</title>
  <link rel='icon' href='../main/assets/favicon/favicon.png' type='image/png' />
  <link rel='shortcut icon' href='../main/assets/favicon/favicon.png' type='image/png' />
  <!-- plugin css file  -->
  <link rel='stylesheet' href='../main/assets/plugin/datatables/responsive.dataTables.min.css'>
  <link rel='stylesheet' href='../main/assets/plugin/datatables/dataTables.bootstrap5.min.css'>
  <!-- project css file  -->
  <link rel='stylesheet' href='../main/assets/css/my-task.style.min.css'>
  <!-- my style  -->
  <link rel='stylesheet' href='myrs/mystyle.css'>
  <style>
    .sidebar {top: 0;left: 0;bottom: 0;transition: all 0.3s ease;}
    @media (max-width: 575.98px) {
      .sidebar {transform: translateX(-100%);}
    }
    .sidebar.open {transform: translateX(0);}
    .hamburger {display: none;}
    @media (max-width: 1275.99px) {
      .hamburger {
        display: block;
        position: fixed; /* Make the hamburger button fixed so it's always visible */
        top: 1rem;
        right: 1rem;
        z-index: 200; /* Set a higher z-index than the sidebar to make sure it's above it */
        padding: 0px;
      }
    }
    .hamburger{width: 50px;height: 50px;background-color: #6d2344;border-radius: 30%;color: #fff;text-align: center;font-size: 20px;line-height: 1;cursor: pointer;}
    .scroll {overflow-y: scroll; /* Add the ability to scroll */}
  </style>
</head>
<body>
<?php
ini_set("display_errors","On");
include("../main/class2.php");

echo "
<div id='mytask-layout' class='theme-indigo'>
";

//sidebar
if(!isset($_GET['details'])){
  include("sidebar.php");
}

echo "
  <!-- main body area -->
  <div class='main px-lg-4 px-md-4'>
";

//Body: Header
if(!isset($_GET['details'])){
  include("../main/heading.php");
}

//Body: Body
if(isset($_GET['opdprocedure'])){include("main.php");}
else if(isset($_GET['searchpatient'])){include("searchpatient.php");}
else if(isset($_GET['stockrequest'])){include("stockrequest.php");}
else if(isset($_GET['pls'])){include("pls.php");}
else if(isset($_GET['plo'])){include("plo.php");}
else if(isset($_GET['dadr'])){include("dadr.php");}
else if(isset($_GET['daso'])){include("daso.php");}
else if(isset($_GET['arph'])){include("arph.php");}
else if(isset($_GET['arem'])){include("arem.php");}
else if(isset($_GET['details'])){include("details.php");}
else{include("main.php");}

echo "
  </div>
</div>
";

if((!isset($_SESSION['un']))&&(!isset($_SESSION['pw']))&&(!isset($_SESSION['nm']))&&(!isset($_SESSION['ac']))){
  $cont=base64_encode(str_replace("/ERP/billing/","",$_SERVER['REQUEST_URI']));

echo "
<!-- Leave Reject-->
<div class='modal fade' id='leavereject' tabindex='-1' data-bs-keyboard='false' data-bs-backdrop='static'>
  <div class='modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title text-danger fw-bold' id='leaverejectLabel' style='font-weight: bold;'> Warning!!!</h5>
        <a href='../login/?dept=BILLING&cont=$cont'><button type='button' class='btn-close' aria-label='Close'></button></a>
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

  function sbview(){
    const sidebar = document.querySelector('.sidebar');
    if(sidebar.style.transform == 'translateX(-100%)'){sidebar.style.transform = 'translateX(0)';}
    else{sidebar.style.transform = 'translateX(-100%)';}
  }

  const sidebar = document.querySelector('.sidebar');
  const mediaQuery = window.matchMedia("(min-width: 1275.99px)");
  const handleMediaQueryChange = (mediaQuery) => {
    if (mediaQuery.matches) {sidebar.style.transform = 'translateX(0)';}
    else {sidebar.style.transform = 'translateX(-100%)';}
  }

  mediaQuery.addListener(handleMediaQueryChange);
  handleMediaQueryChange(mediaQuery);
</script>

</body>
</html>
