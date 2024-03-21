<?php
if(isset($_GET['opdprocedure'])){
  $aac1="active";$aac2="";$aac3="";$aac4="";$aac5="";$aac6="";
  $x1="show";$x2="";$x3="";$x4="";$x5="";
  $y1="down";$y2="left";$y3="left";$y4="left";$y5="left";
  $bacc1a="";$bacc1b="active";
  $bacc3a="";$bacc3b="";$bacc3c="";
  $bacc4a="";$bacc4b="";
  $bacc5a="";
}
else if(isset($_GET['searchpatient'])){
  $aac1="";$aac2="active";$aac3="";$aac4="";$aac5="";$aac6="";
  $x1="";$x2="show";$x3="";$x4="";$x5="";
  $y1="left";$y2="down";$y3="left";$y4="left";$y5="left";
  $bacc1a="";$bacc1b="";
  $bacc3a="";$bacc3b="";$bacc3c="";
  $bacc4a="";$bacc4b="";
  $bacc5a="";
}
else if(isset($_GET['cl'])){
  $aac1="";$aac2="";$aac3="active";$aac4="";$aac5="";$aac6="";
  $x1="";$x2="";$x3="show";$x4="";$x5="";
  $y1="left";$y2="left";$y3="down";$y4="left";$y5="left";
  $bacc1a="";$bacc1b="";
  $bacc3a="";$bacc3b="active";$bacc3c="";
  $bacc4a="";$bacc4b="";
  $bacc5a="";
}
else if(isset($_GET['aecr'])){
  $aac1="";$aac2="";$aac3="active";$aac4="";$aac5="";$aac6="";
  $x1="";$x2="";$x3="show";$x4="";$x5="";
  $y1="left";$y2="left";$y3="down";$y4="left";$y5="left";
  $bacc1a="";$bacc1b="";
  $bacc3a="";$bacc3b="";$bacc3c="active";
  $bacc4a="";$bacc4b="";
  $bacc5a="";
}
else if(isset($_GET['stockrequest'])){
  $aac1="";$aac2="";$aac3="active";$aac4="";$aac5="";$aac6="";
  $x1="";$x2="";$x3="show";$x4="";$x5="";
  $y1="left";$y2="left";$y3="down";$y4="left";$y5="left";
  $bacc1a="";$bacc1b="";
  $bacc3a="active";$bacc3b="";$bacc3c="";
  $bacc4a="";$bacc4b="";
  $bacc5a="";$bacc5b="";
}
else if(isset($_GET['dadm'])){
  $aac1="";$aac2="";$aac3="";$aac4="active";$aac5="";$aac6="";
  $x1="";$x2="";$x3="";$x4="show";$x5="";
  $y1="left";$y2="left";$y3="left";$y4="down";$y5="left";
  $bacc1a="";$bacc1b="";
  $bacc3a="";$bacc3b="";$bacc3c="";
  $bacc4a="active";$bacc4b="";
  $bacc5a="";
}
else if(isset($_GET['ddr'])){
  $aac1="";$aac2="";$aac3="";$aac4="active";$aac5="";$aac6="";
  $x1="";$x2="";$x3="";$x4="show";$x5="";
  $y1="left";$y2="left";$y3="left";$y4="down";$y5="left";
  $bacc1a="";$bacc1b="";
  $bacc3a="";$bacc3b="";$bacc3c="";
  $bacc4a="";$bacc4b="active";
  $bacc5a="";
}
else if((isset($_GET['ft']))||(isset($_GET['pl']))||(isset($_GET['fl']))||(isset($_GET['dl']))||(isset($_GET['sp']))){
  $aac1="";$aac2="";$aac3="";$aac4="";$aac5="active";$aac6="";
  $x1="";$x2="";$x3="";$x4="";$x5="show";
  $y1="left";$y2="left";$y3="left";$y4="left";$y5="down";
  $bacc1a="";$bacc1b="";
  $bacc3a="";$bacc3b="";$bacc3c="";
  $bacc4a="";$bacc4b="";
  $bacc5a="active";
}
else if((isset($_GET['blk']))||(isset($_GET['blksp']))){
  $aac1="";$aac2="";$aac3="";$aac4="";$aac5="";$aac6="active";
  $x1="";$x2="";$x3="";$x4="";$x5="";
  $y1="left";$y2="left";$y3="left";$y4="left";$y5="left";
  $bacc1a="";$bacc1b="";
  $bacc2a="";$bacc2b="";
  $bacc3a="";$bacc3b="";$bacc3c="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
  $bacc5a="";
}
else{
  $aac1="active";$aac2="";$aac3="";$aac4="";$aac5="";$aac6="";
  $x1="show";$x2="";$x3="";$x4="";$x5="";
  $y1="down";$y2="left";$y3="left";$y4="left";$y5="left";
  $bacc1a="active";$bacc1b="";
  $bacc2a="";$bacc2b="";
  $bacc3a="";$bacc3b="";$bacc3c="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
  $bacc5a="";
}

echo "
  <!-- sidebar -->
  <div class='sidebar px-4 py-4 py-md-5 me-0'>
    <div class='d-flex flex-column h-100'>
      <a href='../philhealth/' class='mb-0 brand-icon'>
        <span class='logo-icon'>
          <span style='font-size: 30px;'><i class='icofont-patient-file'></i></span>
        </span>
        <span class='logo-text'>PhilHealth</span>
      </a>
      <!-- Menu: main ul -->
      <ul class='menu-list flex-grow-1 mt-3'>
        <li><a class='m-link' href='../philhealth/'><span><i class='icofont-home fs-5'></i> Home</span></a></li>
        <li  class='collapsed'>
          <a class='m-link $aac1' data-bs-toggle='collapse' data-bs-target='#one' href='#'>
            <span><i class='icofont-listine-dots fs-5'></i> Patient List</span> <span class='arrow icofont-dotted-$y1 ms-auto text-end fs-5'></span>
          </a>
          <!-- Menu: Sub menu ul -->
          <ul class='sub-menu collapse $x1' id='one'>
            <li><a class='ms-link $bacc1a' href='../philhealth/'><span><i class='icofont-people'></i> Active IPD</span></a></li>
            <li><a class='ms-link $bacc1b' href='../philhealth/?opdprocedure'><span><i class='icofont-people'></i> OPD Procedure</span></a></li>
          </ul>
        </li>
        <li  class='collapsed'>
          <a class='m-link $aac2' href='../philhealth/?searchpatient'>
            <span><i class='icofont-search-job fs-5'></i> Search Patient</span>
          </a>
        </li>
        <li class='collapsed'>
          <a class='m-link $aac3' data-bs-toggle='collapse' data-bs-target='#transactions' href='#'>
            <span><i class='icofont-options fs-5'></i> Other Transactions</span> <span class='arrow icofont-dotted-$y3 ms-auto text-end fs-5'></span>
          </a>
          <!-- Menu: Sub menu ul -->
          <ul class='sub-menu collapse $x3' id='transactions'>
            <li><a class='ms-link $bacc3a' href='../medmatrix/request_stock/".base64_decode($snm)."/".base64_decode($sun)."/PHILHEALTH' target='_blank'><span><i class='icofont-ui-cart'></i> Stock Request</span></a></li>
            <li><a class='ms-link $bacc3b' href='../philhealth/?cl'><span><i class='icofont-wall'></i> Credit Limit</span></a></li>
            <li><a class='ms-link $bacc3c' href='../philhealth/?aecr'><span><i class='icofont-pencil'></i> Add/Edit Case Rates</span></a></li>
          </ul>
        </li>
        <li  class='collapsed'>
          <a class='m-link $aac4' data-bs-toggle='collapse' data-bs-target='#reports' href='#'>
            <span><i class='icofont-paperclip fs-5'></i> Reports</span> <span class='arrow icofont-dotted-$y4 ms-auto text-end fs-5'></span>
          </a>
          <!-- Menu: Sub menu ul -->
          <ul class='sub-menu collapse $x4' id='reports'>
            <li><a class='ms-link $bacc4a' href='../philhealth/?dadm'><span><i class='icofont-question-circle'></i> Daily Admission</span></a></li>
            <li><a class='ms-link $bacc4b' href='../philhealth/?ddr'><span><i class='icofont-question-circle'></i> Discharged Report</span></a></li>
          </ul>
        </li>
        <li  class='collapsed'>
          <a class='m-link $aac5' data-bs-toggle='collapse' data-bs-target='#eclaims' href='#'>
            <span><i class='icofont-package fs-5'></i> eClaims</span> <span class='arrow icofont-dotted-$y5 ms-auto text-end fs-5'></span>
          </a>
          <!-- Menu: Sub menu ul -->
          <ul class='sub-menu collapse $x5' id='eclaims'>
            <li><a class='ms-link $bacc5a' href='../philhealth/?ft'><span><i class='icofont-listine-dots'></i> Transmittal List</span></a></li>
            <li><a class='ms-link' href='http://192.168.0.200/' target='_blank'><span><i class='icofont-pixels'></i> MedMatrix eClaims</span></a></li>
          </ul>
        </li>
        <li  class='collapsed'>
          <a class='m-link $aac6' href='../philhealth/?blk'>
            <span><i class='icofont-book-alt fs-5'></i> Patient Black List</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
";
?>
