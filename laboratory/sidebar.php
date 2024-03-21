<?php
if(isset($_GET['opdreq'])){
  $aac1="active";$aac2="";$aac3="";$aac4="";$aac5="";$aac6="";
  $x1="show";$x2="";$x3="";$x4="";$x5="";
  $y1="down";$y2="left";$y3="left";$y4="left";$y5="left";
  $bacc1a="";$bacc1b="active";$bacc1c="";
  $bacc3a="";$bacc3b="";$bacc3c="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
}
else if(isset($_GET['rdureq'])){
  $aac1="active";$aac2="";$aac3="";$aac4="";$aac5="";$aac6="";
  $x1="show";$x2="";$x3="";$x4="";$x5="";
  $y1="down";$y2="left";$y3="left";$y4="left";$y5="left";
  $bacc1a="";$bacc1b="";$bacc1c="active";
  $bacc3a="";$bacc3b="";$bacc3c="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
}
else if(isset($_GET['searcharchive'])){
  $aac1="";$aac2="active";$aac3="";$aac4="";$aac5="";$aac6="";
  $x1="";$x2="show";$x3="";$x4="";$x5="";
  $y1="left";$y2="down";$y3="left";$y4="left";$y5="left";
  $bacc1a="";$bacc1b="";$bacc1c="";
  $bacc3a="";$bacc3b="";$bacc3c="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
}
else if(isset($_GET['stockrequest'])){
  $aac1="";$aac2="";$aac3="active";$aac4="";$aac5="";$aac6="";
  $x1="";$x2="";$x3="show";$x4="";$x5="";
  $y1="left";$y2="left";$y3="down";$y4="left";$y5="left";
  $bacc1a="";$bacc1b="";$bacc1c="";
  $bacc3a="active";$bacc3b="";$bacc3c="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
}
else if(isset($_GET['snv'])){
  $aac1="";$aac2="";$aac3="active";$aac4="";$aac5="";$aac6="";
  $x1="";$x2="";$x3="show";$x4="";$x5="";
  $y1="left";$y2="left";$y3="down";$y4="left";$y5="left";
  $bacc1a="";$bacc1b="";$bacc1c="";
  $bacc3a="";$bacc3b="";$bacc3c="active";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
}
else if(isset($_GET['exp'])){
  $aac1="";$aac2="";$aac3="";$aac4="active";$aac5="";$aac6="";
  $x1="";$x2="";$x3="";$x4="";$x5="";
  $y1="left";$y2="left";$y3="left";$y4="left";$y5="left";
  $bacc1a="";$bacc1b="";$bacc1c="";
  $bacc3a="";$bacc3b="";$bacc3c="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
}
else if(isset($_GET['expabg'])){
  $aac1="";$aac2="";$aac3="";$aac4="";$aac5="active";$aac6="";
  $x1="";$x2="";$x3="";$x4="";$x5="";
  $y1="left";$y2="left";$y3="left";$y4="left";$y5="left";
  $bacc1a="";$bacc1b="";$bacc1c="";
  $bacc3a="";$bacc3b="";$bacc3c="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
}
else if(isset($_GET['pl'])){
  $aac1="";$aac2="";$aac3="";$aac4="";$aac5="";$aac6="active";
  $x1="";$x2="";$x3="";$x4="";$x5="";
  $y1="left";$y2="left";$y3="left";$y4="left";$y5="left";
  $bacc1a="";$bacc1b="";$bacc1c="";
  $bacc3a="";$bacc3b="";$bacc3c="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
}
else{
  $aac1="active";$aac2="";$aac3="";$aac4="";$aac5="";$aac6="";
  $x1="show";$x2="";$x3="";$x4="";$x5="";
  $y1="down";$y2="left";$y3="left";$y4="left";$y5="left";

  if(isset($_GET['inp'])){$bacc1a="active";$bacc1b="";$bacc1c="";}
  else if(isset($_GET['otp'])){$bacc1a="";$bacc1b="active";$bacc1c="";}
  else if(isset($_GET['rtp'])){$bacc1a="";$bacc1b="";$bacc1c="active";}
  else{$bacc1a="active";$bacc1b="";$bacc1c="";}

  $bacc2a="";$bacc2b="";
  $bacc3a="";$bacc3b="";$bacc3c="";
  $bacc4a="";$bacc4b="";$bacc4c="";$bacc4d="";
}

if((isset($_SESSION['nm']))&&(isset($_SESSION['un']))){
  $scnm=base64_decode($_SESSION['nm']);
  $scun=base64_decode($_SESSION['un']);
}
else{
  $scnm="";
  $scun="";
}

echo "
  <button class='hamburger' onclick='sbview();'><i class='icofont-navigation-menu'></i></button>
  <!-- sidebar -->
  <div class='sidebar px-4 py-4 py-md-5 me-0'>
    <div class='d-flex flex-column h-100'>
      <a href='../laboratory/' class='mb-0 brand-icon'>
        <span class='logo-icon'>
          <span style='font-size: 30px;'><i class='icofont-beaker'></i></span>
        </span>
        <span class='logo-text'>Laboratory</span>
      </a>
      <!-- Menu: main ul -->
      <ul class='menu-list flex-grow-1 mt-3'>
        <li><a class='m-link' href='../laboratory/'><span><i class='icofont-home fs-5'></i> Home</span></a></li>
        <li  class='collapsed'>
          <a class='m-link $aac1' data-bs-toggle='collapse' data-bs-target='#one' href='#'>
            <span><i class='icofont-listine-dots fs-5'></i> Lab Requests</span> <span class='arrow icofont-dotted-$y1 ms-auto text-end fs-5'></span>
          </a>
          <!-- Menu: Sub menu ul -->
          <ul class='sub-menu collapse $x1' id='one'>
            <li><a class='ms-link $bacc1a' href='../laboratory/'><span><i class='icofont-people'></i> In-patient Requests</span></a></li>
            <li><a class='ms-link $bacc1b' href='../laboratory/?opdreq'><span><i class='icofont-people'></i> Out-patient Requests</span></a></li>
            <li><a class='ms-link $bacc1c' href='../laboratory/?rdureq'><span><i class='icofont-people'></i> RDU Requests</span></a></li>
          </ul>
        </li>
        <li  class='collapsed'>
          <a class='m-link $aac2' href='../laboratory/?searcharchive'>
            <span><i class='icofont-search-job fs-5'></i> Search Archive</span>
          </a>
        </li>
        <li class='collapsed'>
          <a class='m-link $aac3' data-bs-toggle='collapse' data-bs-target='#transactions' href='#'>
            <span><i class='icofont-options fs-5'></i> Other Transactions</span> <span class='arrow icofont-dotted-$y3 ms-auto text-end fs-5'></span>
          </a>
          <!-- Menu: Sub menu ul -->
          <ul class='sub-menu collapse $x3' id='transactions'>
            <li><a class='ms-link $bacc3a' href='../medmatrix/request_stock/".$scnm."/".$scun."/LABORATORY' target='_blank'><span><i class='icofont-ui-cart'></i> Stock Request</span></a></li>
            <li><a class='ms-link $bacc3c' href='../laboratory/?snv'><span><i class='icofont-gears'></i> Set Normal Values</span></a></li>
          </ul>
        </li>
        <li><a class='m-link $aac4' href='../laboratory/?exp'><span><i class='icofont-fast-delivery fs-5'></i> Express Verify</span></a></li>
        <li><a class='m-link $aac5' href='../laboratory/?expabg'><span><i class='icofont-fast-delivery fs-5'></i> ABG Express Verify</span></a></li>
        <li><a class='m-link $aac6' href='../laboratory/?pl'><span><i class='icofont-price fs-5'></i> Price List</span></a></li>
      </ul>
    </div>
  </div>
";
?>
