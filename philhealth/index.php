<!doctype html>
<html class='no-js' lang='en' dir='ltr'>
<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=Edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
  <title>KMSCI PhilHealth</title>
  <link rel='icon' href='../main/assets/favicon/favicon.png' type='image/png' />
  <link rel='shortcut icon' href='../main/assets/favicon/favicon.png' type='image/png' />
  <!-- plugin css file  -->
  <link rel='stylesheet' href='../main/assets/plugin/datatables/responsive.dataTables.min.css'>
  <link rel='stylesheet' href='../main/assets/plugin/datatables/dataTables.bootstrap5.min.css'>
  <!-- project css file  -->
  <link rel='stylesheet' href='../main/assets/css/my-task.style.min.css'>
  <!-- my style  -->
  <link rel='stylesheet' href='myrs/mystyle.css'>
  <link rel='stylesheet' href='myrs/style.css'>
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

if((!isset($_SESSION['un']))&&(!isset($_SESSION['pw']))&&(!isset($_SESSION['nm']))&&(!isset($_SESSION['ac']))){
  $sun="";
  $spw="";
  $snm="";
  $sac="";
}
else{
  $sun=$_SESSION['un'];
  $spw=$_SESSION['pw'];
  $snm=$_SESSION['nm'];
  $sac=$_SESSION['ac'];
}

echo "
<div id='mytask-layout' class='theme-indigo'>
";

//sidebar
if((isset($_GET['details']))||(isset($_GET['caserate']))||(isset($_GET['csfada']))||(isset($_GET['lab']))||(isset($_GET['rad']))||(isset($_GET['epm']))||(isset($_GET['epr']))||(isset($_GET['rmk']))||(isset($_GET['cns']))||(isset($_GET['cf4p1']))||(isset($_GET['cf4p2']))||(isset($_GET['cf4p3']))||(isset($_GET['cf4clear']))||(isset($_GET['cf4p4']))||(isset($_GET['cf4p4edit']))||(isset($_GET['cf4p5']))||(isset($_GET['docom']))||(isset($_GET['actbill']))||(isset($_GET['patchk']))){
  include("detailssidebar.php");
}
else{
  include("sidebar.php");
}

echo "
  <!-- main body area -->
  <div class='main px-lg-4 px-md-4'>
";

//Body: Header
include("../main/heading.php");

//Body: Body
if(isset($_GET['opdprocedure'])){include("main.php");}
else if(isset($_GET['searchpatient'])){include("searchpatient.php");}
else if(isset($_GET['stockrequest'])){include("stockrequest.php");}
else if(isset($_GET['details'])){include("details.php");}
else if(isset($_GET['caserate'])){include("caserate.php");}
else if(isset($_GET['csfada'])){include("csfada.php");}
else if(isset($_GET['cf4p1'])){include("cf4p1.php");}
else if(isset($_GET['cf4p2'])){include("cf4p2.php");}
else if(isset($_GET['cf4p3'])){include("cf4p3.php");}
else if(isset($_GET['cf4p4'])){include("cf4p4.php");}
else if(isset($_GET['cf4p4edit'])){include("cf4p4edit.php");}
else if(isset($_GET['cf4p5'])){include("cf4p5.php");}
else if(isset($_GET['cf4clear'])){include("cf4clear.php");}
else if(isset($_GET['lab'])){include("lab.php");}
else if(isset($_GET['rad'])){include("rad.php");}
else if(isset($_GET['cl'])){include("cl.php");}
else if(isset($_GET['aecr'])){include("aecr.php");}
else if(isset($_GET['dadm'])){include("dadm.php");}
else if(isset($_GET['ddr'])){include("ddr.php");}
else if(isset($_GET['ft'])){include("fortrans.php");}
else if(isset($_GET['pl'])){include("pendinglist.php");}
else if(isset($_GET['fl'])){include("finallist.php");}
else if(isset($_GET['dl'])){include("detaillist.php");}
else if(isset($_GET['sp'])){include("searchpat.php");}
else if(isset($_GET['epm'])){include("epm.php");}
else if(isset($_GET['epr'])){include("epr.php");}
else if(isset($_GET['rmk'])){include("rmk.php");}
else if(isset($_GET['cns'])){include("cns.php");}
else if(isset($_GET['blk'])){include("blacklist.php");}
else if(isset($_GET['blksp'])){include("blacklist-sp.php");}
else if(isset($_GET['docom'])){include("docom.php");}
else if(isset($_GET['actbill'])){include("actbill.php");}
else if(isset($_GET['patchk'])){include("patchk.php");}
else{include("main.php");}

echo "
  </div>
</div>
";

if((!isset($_SESSION['un']))&&(!isset($_SESSION['pw']))&&(!isset($_SESSION['nm']))&&(!isset($_SESSION['ac']))){
  $cont=base64_encode(str_replace("/ERP/philhealth/","",$_SERVER['REQUEST_URI']));

echo "
<!-- Leave Reject-->
<div class='modal fade' id='leavereject' tabindex='-1' data-bs-keyboard='false' data-bs-backdrop='static'>
  <div class='modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title text-danger fw-bold' id='leaverejectLabel' style='font-weight: bold;'> Warning!!!</h5>
        <a href='../login/?dept=PHILHEALTH&cont=$cont'><button type='button' class='btn-close' aria-label='Close'></button></a>
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
