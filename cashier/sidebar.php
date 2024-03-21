
<?php
if(isset($_POST['opd'])){$_SESSION['loadreq'] = "opd";}
elseif(isset($_POST['ipd'])){$_SESSION['loadreq'] = "ipd";}
elseif(isset($_POST['rdu'])){$_SESSION['loadreq'] = "rdu";}
elseif(isset($_POST['arp'])){$_SESSION['loadreq'] = "arp";}
elseif(isset($_POST['ppayment'])){$_SESSION['loadreq'] = "ppayment";}
elseif(isset($_POST['finalbill'])){$_SESSION['loadreq'] = "finalbill";}
elseif(isset($_POST['casestudy'])){$_SESSION['loadreq'] = "casestudy";}
else{
  if($_SESSION['loadreq'] == "ipd"){$_SESSION['loadreq'] = "ipd";}
  elseif($_SESSION['loadreq'] == "opd"){$_SESSION['loadreq'] = "opd";}
  elseif($_SESSION['loadreq'] == "rdu"){$_SESSION['loadreq'] = "rdu";}
  elseif($_SESSION['loadreq'] == "arp"){$_SESSION['loadreq'] = "arp";}
  elseif($_SESSION['loadreq'] == "ppayment"){$_SESSION['loadreq'] = "ppayment";}
  elseif($_SESSION['loadreq'] == "casestudy"){$_SESSION['loadreq'] = "casestudy";}
  else{
  if($dept=="CASHIER" or $dept=="CASHIER3"){$_SESSION['loadreq'] = "ipd";}
  elseif($dept=="CASHIER2"){$_SESSION['loadreq'] = "opd";}
  elseif($dept=="CASHIER4"){$_SESSION['loadreq'] = "rdu";}
  }
  }
  
  
  $ddisp = "IN-PATIENT Requests";
  if($_SESSION['loadreq'] == "ipd"){
  $opd = "";
  $rdu = "";
  $ipd = "active";
  $arp = "";
  $ppayment = "";
  $finalbill = "";
  $casestudy = "";
  $ddisp = "IN-PATIENT Requests";
  }elseif($_SESSION['loadreq'] == "opd"){
  $opd = "active";
  $rdu = "";
  $ipd = "";
  $arp = "";
  $ppayment = "";
  $finalbill = "";
  $casestudy = "";
  $ddisp = "OUT-PATIENT Requests";
  }elseif($_SESSION['loadreq'] == "rdu"){
  $opd = "";
  $rdu = "active";
  $ipd = "";
  $arp = "";
  $ppayment = "";
  $finalbill = "";
  $casestudy = "";
  $ddisp = "RDU Requests";
  }elseif($_SESSION['loadreq'] == "arp"){
  $opd = "";
  $arp = "active";
  $ipd = "";
  $rdu = "";
  $ppayment = "";
  $finalbill = "";
  $casestudy = "";
  $ddisp = "AR-TRADE";
  }elseif($_SESSION['loadreq'] == "ppayment"){
  $opd = "";
  $arp = "";
  $ipd = "";
  $rdu = "";
  $ppayment = "active";
  $finalbill = "";
  $casestudy = "";
  $ddisp = "Patient Deposit";
  }elseif($_SESSION['loadreq'] == "finalbill"){
  $opd = "";
  $arp = "";
  $ipd = "";
  $rdu = "";
  $ppayment = "";
  $finalbill = "active";
  $casestudy = "";
  $ddisp = "Final Bill with Excess";
  }elseif($_SESSION['loadreq'] == "casestudy"){
  $opd = "";
  $arp = "";
  $ipd = "";
  $rdu = "";
  $ppayment = "";
  $finalbill = "";
  $casestudy = "active";
  $ddisp = "Case Study Requests";
  }

if($dept=="CASHIER"){$rduname="RDU Creditcard";}else{$rduname="RDU Request";}
?>
   <!-- sidebar -->
    <div class="sidebar px-4 py-4 py-md-5 me-0">
      <div class="d-flex flex-column h-100">
       
          
          
       <table>
	<tr>
	<td><img src="../main/img/logo/logo.png" width='40' height='40' style='border-radius: 50%;'></td>
	<td style="color: white;">MedMatrix<br><small style="font-size:11px;">eHealth Solutions, Inc.</small></td>
	</tr>
	</table><hr style="color: white;">
        <!-- Menu: main ul -->
        <ul class="menu-list flex-grow-1 mt-3">
          <!--li><a class="ms-link" href="?main"><span><i class="icofont-ui-home"></i> Main Menu</span></a></li-->
          
          <li class="collapsed">
            <a class="ms-link"  data-bs-toggle="collapse" data-bs-target="#NursingServicesc" href="#">
              <span><i class="icofont-ui-settings"></i> Pending Request</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <!-- Menu: Sub menu ul -->
            <ul class="sub-menu collapse show" id="NursingServicesc">
            <?php if($dept=="CASHIER" OR $dept=="CASHIER3") { ?><li><form method='POST' action='?main'><button class="btn btn-secondary ms-link <?php echo $ipd ?>" style="width: 100%; background-color: Transparent; border-color: transparent;" name="ipd"><span><i class="icofont-caret-right"></i> IPD Request</span></button></form></li><?php } ?>
            <?php if($dept=="CASHIER" OR $dept=="CASHIER2" OR $dept=="CASHIER3") { ?><li><form method='POST' action='?main'><button class="btn btn-secondary ms-link <?php echo $opd ?>" style="width: 100%; background-color: Transparent; border-color: transparent;" name="opd"><span><i class="icofont-caret-right"></i> OPD Request</span></button></form></li><?php } ?>
            <?php if($dept=="CASHIER") { ?><li><form method='POST' action='?main'><button class="btn btn-secondary ms-link <?php echo $casestudy ?>" style="width: 100%; background-color: Transparent; border-color: transparent;" name="casestudy"><span><i class="icofont-caret-right"></i> Case Study</span></button></form></li><?php } ?>
            <?php if($dept=="CASHIER" OR $dept=="CASHIER3" OR $dept=="CASHIER4") { ?><li><form method='POST' action='?main'><button class="btn btn-secondary ms-link <?php echo $rdu ?>" style="width: 100%; background-color: Transparent; border-color: transparent;" name="rdu"><span><i class="icofont-caret-right"></i> <?php echo $rduname ?></span></button></form></li><?php } ?>
            
            <?php if($dept=="CASHIER" or $dept=="CASHIER4") { ?>
            <li><form method='POST' action='?main'><button class="btn btn-secondary ms-link <?php echo $arp ?>" style="width: 100%; background-color: Transparent; border-color: transparent;" name="arp"><span><i class="icofont-caret-right"></i> AR-Trade List</span></button></form></li>
            <?php } ?>

            <?php if($dept=="CASHIER") { ?>
            <li><form method='POST' action='?main'><button class="btn btn-secondary ms-link <?php echo $ppayment ?>" style="width: 100%; background-color: Transparent; border-color: transparent;" name="ppayment"><span><i class="icofont-caret-right"></i> Patient Deposit</span></button></form></li>
            <?php } ?>
            
            <?php if($dept=="CASHIER" or $dept=="CASHIER4") { ?>
            <li><form method='POST' action='?main'><button class="btn btn-secondary ms-link <?php echo $finalbill ?>" style="width: 100%; background-color: Transparent; border-color: transparent;" name="finalbill"><span><i class="icofont-caret-right"></i> Final Bill [Excess]</span></button></form></li>
            <?php } ?>

            </ul>
          </li>

          <li><a class="ms-link" href="?manualpayment"><span><i class="icofont-pay"></i> Manual Payment</span></a></li>

          <?php if($dept=="CASHIER"){ ?>
          <li><a class="ms-link" href="?hmoacctreceivable"><span><i class="icofont-pay"></i> HMO Account Recievable</span></a></li>
          <?php } ?>

          <li class="collapsed">
            <a class="ms-link"  data-bs-toggle="collapse" data-bs-target="#NursingServices" href="#">
              <span><i class="icofont-ui-settings"></i> Other Services</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <!-- Menu: Sub menu ul -->
            <ul class="sub-menu collapse" id="NursingServices">
              <!--li><a class="ms-link" href="http://<?php echo $ip ?>/aboy2020/pages/cashier/?orsearch&branch=&nursename=<?php echo $user ?>&userunique=<?php echo $userunique ?>&dept=<?php echo $dept ?>" target="_blank"><span><i class="icofont-caret-right"></i> Edit OR Transaction</span></a></li-->
              <li><a class="ms-link" href="?editOR"><span><i class="icofont-caret-right"></i> Edit OR Transaction</span></a></li>
              <li><a class="ms-link" href="?orseries"><span><i class="icofont-caret-right"></i> OR Series</span></a></li>
              <li><a class="ms-link" href="../login/?dept=NS3"><span><i class="icofont-caret-right"></i> Credit Memo</span></a></li>
              <li><a class="ms-link" href="?ormonitoring"><span><i class="icofont-caret-right"></i> OR Monitoring</span></a></li>
            </ul>
          </li>

          <li class="collapsed">
            <a class="ms-link"  data-bs-toggle="collapse" data-bs-target="#NursingServices1" href="#">
              <span><i class="icofont-file-pdf"></i> Reports</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <!-- Menu: Sub menu ul -->
            <ul class="sub-menu collapse" id="NursingServices1">
              <li><a class="ms-link" href="../medmatrix/report_portal/<?=$_SESSION['username'];?>/<?=$userunique;?>/<?=$dept;?>"><span><i class="icofont-caret-right"></i> All Reports</span></a></li>
              <li><a class="ms-link" href="?pricelist"><span><i class="icofont-caret-right"></i> Pricelist</span></a></li>
              <li><a class="ms-link" href="http://<?php echo $ip ?>/aboy2020/pages/cashier/?quotationlist&branch=<?php echo $branch ?>&nursename=<?php echo $user ?>&userunique=<?php echo $userunique ?>&dept=<?php echo $dept ?>" target="_blank"><span><i class="icofont-caret-right"></i> Quotation List</span></a></li>
            </ul>
          </li>

          <li class="collapsed">
            <a class="ms-link"  data-bs-toggle="collapse" data-bs-target="#NursingServices11" href="#">
              <span><i class="icofont-connection"></i> Supply Chain</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <!-- Menu: Sub menu ul -->
            <ul class="sub-menu collapse" id="NursingServices11">
              <!--li><a class="ms-link" href="?stockrequest"><span><i class="icofont-caret-right"></i> Stock Request</span></a></li-->
              <li><a class="ms-link" href="../medmatrix/request_stock/<?=$_SESSION['username'];?>/<?=$_SESSION['userunique'];?>/<?=$_SESSION['dept'];?>"><span><i class="icofont-caret-right"></i> Stock Request</span></a></li>
              <li><a class="ms-link" href="../login/?dept=NS2"><span><i class="icofont-caret-right"></i> Acknowledge Issuance</span></a></li>
              <li><a class="ms-link" href="../login/?dept=NS3"><span><i class="icofont-caret-right"></i> Issuance History</span></a></li>
              <li><a class="ms-link" href="../cashier/?estockcard"><span><i class="icofont-caret-right"></i> Electronic Stockcard</span></a></li>
              <li><a class="ms-link" href="../cashier/?bulkadjustment"><span><i class="icofont-caret-right"></i> Bulk Adjustment</span></a></li>
            </ul>
          </li>



          
          
        </ul>
        <!-- Theme: Switch Theme -->
        <ul class="list-unstyled mb-0">
          <li class="d-flex align-items-center justify-content-center">
            <div class="form-check form-switch theme-switch">
              <input class="form-check-input" type="checkbox" id="theme-switch">
              <label class="form-check-label" for="theme-switch">Enable Dark Mode!</label>
            </div>
          </li>

        </ul>

      </div>
    </div>