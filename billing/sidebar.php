<?php
if(isset($_GET['opdprocedure'])){
  $aac1="active";$aac2="";$aac3="";$aac4="";$aac5="";
  $x1="show";$x2="";$x3="";$x4="";$x5="";
  $y1="down";$y2="left";$y3="left";$y4="left";$y5="left";
  $bacc1a="";$bacc1b="active";
  $bacc3a="";$bacc3b="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
  $bacc5a="";$bacc5b="";
}
else if(isset($_GET['searchpatient'])){
  $aac1="";$aac2="active";$aac3="";$aac4="";$aac5="";
  $x1="";$x2="show";$x3="";$x4="";$x5="";
  $y1="left";$y2="down";$y3="left";$y4="left";$y5="left";
  $bacc1a="";$bacc1b="";
  $bacc3a="";$bacc3b="";$bacc3c="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
  $bacc5a="";$bacc5b="";
}
else if(isset($_GET['stockrequest'])){
  $aac1="";$aac2="";$aac3="active";$aac4="";$aac5="";
  $x1="";$x2="";$x3="show";$x4="";$x5="";
  $y1="left";$y2="left";$y3="down";$y4="left";$y5="left";
  $bacc1a="";$bacc1b="";
  $bacc3a="active";$bacc3b="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
  $bacc5a="";$bacc5b="";
}
else if(isset($_GET['pls'])){
  $aac1="";$aac2="";$aac3="";$aac4="";$aac5="active";
  $x1="";$x2="";$x3="";$x4="";$x5="show";
  $y1="left";$y2="left";$y3="left";$y4="left";$y5="down";
  $bacc1a="";$bacc1b="";
  $bacc3a="active";$bacc3b="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
  $bacc5a="active";$bacc5b="";
}
else if(isset($_GET['plo'])){
  $aac1="";$aac2="";$aac3="";$aac4="";$aac5="active";
  $x1="";$x2="";$x3="";$x4="";$x5="show";
  $y1="left";$y2="left";$y3="left";$y4="left";$y5="down";
  $bacc1a="";$bacc1b="";
  $bacc3a="";$bacc3b="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
  $bacc5a="";$bacc5b="active";
}
else if(isset($_GET['dadr'])){
  $aac1="";$aac2="";$aac3="";$aac4="active";$aac5="";
  $x1="";$x2="";$x3="";$x4="show";$x5="";
  $y1="left";$y2="left";$y3="left";$y4="down";$y5="left";
  $bacc1a="";$bacc1b="";
  $bacc3a="";$bacc3b="";
  $bacc4a="active";$bacc4b="";$bacc4c="";$bacc4d="";
  $bacc5a="";$bacc5b="";
}
else if(isset($_GET['daso'])){
  $aac1="";$aac2="";$aac3="";$aac4="active";$aac5="";
  $x1="";$x2="";$x3="";$x4="show";$x5="";
  $y1="left";$y2="left";$y3="left";$y4="down";$y5="left";
  $bacc1a="";$bacc1b="";
  $bacc3a="";$bacc3b="";
  $bacc4a="";$bacc4b="active";$bacc4c="";$bacc4d="";
  $bacc5a="";$bacc5b="";
}
else if(isset($_GET['arph'])){
  $aac1="";$aac2="";$aac3="";$aac4="active";$aac5="";
  $x1="";$x2="";$x3="";$x4="show";$x5="";
  $y1="left";$y2="left";$y3="left";$y4="down";$y5="left";
  $bacc1a="";$bacc1b="";
  $bacc3a="";$bacc3b="";
  $bacc4a="";$bacc4b="";$bacc4c="active";$bacc4d="";
  $bacc5a="";$bacc5b="";
}
else if(isset($_GET['arem'])){
  $aac1="";$aac2="";$aac3="";$aac4="active";$aac5="";
  $x1="";$x2="";$x3="";$x4="show";$x5="";
  $y1="left";$y2="left";$y3="left";$y4="down";$y5="left";
  $bacc1a="";$bacc1b="";
  $bacc3a="";$bacc3b="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="active";
  $bacc5a="";$bacc5b="";
}
else{
  $aac1="active";$aac2="";$aac3="";$aac4="";$aac5="";
  $x1="show";$x2="";$x3="";$x4="";$x5="";
  $y1="down";$y2="left";$y3="left";$y4="left";$y5="left";
  $bacc1a="active";$bacc1b="";
  $bacc2a="";$bacc2b="";
  $bacc3a="";$bacc3b="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
  $bacc5a="";$bacc5b="";
}

if(isset($_SESSION['nm'])){$anm=$_SESSION['nm'];}else{$anm="";}
if(isset($_SESSION['un'])){$aun=$_SESSION['un'];}else{$aun="";}

echo "
  <button class='hamburger' onclick='sbview();'><i class='icofont-navigation-menu'></i></button>
  <!-- sidebar -->
  <div class='sidebar px-4 py-4 py-md-5 me-0'>
    <div class='d-flex flex-column h-100'>
      <a href='../billing' class='mb-0 brand-icon'>
        <span class='logo-icon'>
          <span style='font-size: 30px;'><i class='icofont-coins'></i></span>
        </span>
        <span class='logo-text'>Billing</span>
      </a>
      <!-- Menu: main ul -->
      <ul class='menu-list flex-grow-1 mt-3'>
        <li><a class='m-link' href='../billing/'><span><i class='icofont-home fs-5'></i> Home</span></a></li>
        <li  class='collapsed'>
          <a class='m-link $aac1' data-bs-toggle='collapse' data-bs-target='#one' href='#'>
            <span><i class='icofont-listine-dots fs-5'></i> Billing List</span> <span class='arrow icofont-dotted-$y1 ms-auto text-end fs-5'></span>
          </a>
          <!-- Menu: Sub menu ul -->
          <ul class='sub-menu collapse $x1' id='one'>
            <li><a class='ms-link $bacc1a' href='../billing/'><span><i class='icofont-people'></i> Active IPD</span></a></li>
            <li><a class='ms-link $bacc1b' href='../billing/?opdprocedure'><span><i class='icofont-people'></i> OPD Procedure</span></a></li>
            <li><a class='ms-link' href='../medmatrix/arpatient_billing/".base64_decode($anm)."/".base64_decode($aun)."/BILLING'><span><i class='icofont-people'></i> AR Patient List</span></a></li>
          </ul>
        </li>
        <li  class='collapsed'>
          <a class='m-link $aac2' href='../billing/?searchpatient'>
            <span><i class='icofont-search-job fs-5'></i> Search Patient</span>
          </a>
        </li>
        <li class='collapsed'>
          <a class='m-link $aac3' data-bs-toggle='collapse' data-bs-target='#transactions' href='#'>
            <span><i class='icofont-briefcase fs-5'></i> Other Transactions</span> <span class='arrow icofont-dotted-$y3 ms-auto text-end fs-5'></span>
          </a>
          <!-- Menu: Sub menu ul -->
          <ul class='sub-menu collapse $x3' id='transactions'>
            <li><a class='ms-link $bacc3a' href='../medmatrix/request_stock/".base64_decode($anm)."/".base64_decode($aun)."/BILLING'><span><i class='icofont-ui-cart'></i> Stock Request</span></a></li>
            <li><a class='ms-link' href='../medmatrix/post_refund/".base64_decode($anm)."/".base64_decode($aun)."/BILLING'><span><i class='icofont-files-stack'></i> Post Refund</span></a></li>
          </ul>
        </li>
        <li  class='collapsed'>
          <a class='m-link $aac4' data-bs-toggle='collapse' data-bs-target='#reports' href='#'>
            <span><i class='icofont-briefcase fs-5'></i> Reports</span> <span class='arrow icofont-dotted-$y4 ms-auto text-end fs-5'></span>
          </a>
          <!-- Menu: Sub menu ul -->
          <ul class='sub-menu collapse $x4' id='reports'>
          <li><a class='ms-link' href='../medmatrix/discharged_report/".base64_decode($anm)."/".base64_decode($aun)."/BILLING'><span><i class='icofont-files-stack'></i> Discharged Summary (IPD)</span></a></li>
            <li><a class='ms-link $bacc4a' href='../billing/?dadr'><span><i class='icofont-files-stack'></i> Daily Discharged (OPD)</span></a></li>
            <li><a class='ms-link $bacc4b' href='../billing/?daso'><span><i class='icofont-files-stack'></i> Daily Summary (OPD)</span></a></li>
            <li><a class='ms-link $bacc4c' href='../billing/?arph'><span><i class='icofont-files-stack'></i> AR PHIC</span></a></li>
            <li><a class='ms-link $bacc4d' href='../billing/?arem'><span><i class='icofont-files-stack'></i> AR Employees</span></a></li>
          </ul>
        </li>
        <li  class='collapsed'>
          <a class='m-link $aac5' data-bs-toggle='collapse' data-bs-target='#price' href='#'>
            <span><i class='icofont-price fs-5'></i> Price List</span> <span class='arrow icofont-dotted-$y5 ms-auto text-end fs-5'></span>
          </a>
          <!-- Menu: Sub menu ul -->
          <ul class='sub-menu collapse $x5' id='price'>
            <li><a class='ms-link $bacc5a' href='../billing/?pls'><span><i class='icofont-search-job'></i> Services</span></a></li>
            <li><a class='ms-link $bacc5b' href='../billing/?plo'><span><i class='icofont-search-job'></i> Other Charges/Fees</span></a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
";
?>
