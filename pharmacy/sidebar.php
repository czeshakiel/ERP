

<?php
$ddfg = $conn->query("select * productreturn where trantype='finalized' and gross like '%$dept%' group by caseno");
$totr1 = mysqli_num_rows($ddfg);
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
          <li><a class="ms-link" href="?main"><span><i class="icofont-navigation-menu"></i> Main Menu</span></a></li>
          <li><a class="ms-link" href="?returnitem"><span><i class="icofont-spinner-alt-3"></i> Return Items <?php if($totr1>0){ ?><span class="badge rounded-pill bg-danger" style="font-size:10px;"><?php echo $totr1 ?></span><?php } ?></span></a></li>
          <li><a class="ms-link" href="?mainhm"><span><i class="icofont-ui-home"></i> Home Medicines</span></a></li>
          <li><a class="ms-link" href="?pos"><span><i class="icofont-sale-discount"></i> Point of Sale</span></a></li>

          <li class="collapsed">
            <a class="ms-link"  data-bs-toggle="collapse" data-bs-target="#NursingServices" href="#">
              <span><i class="icofont-ui-settings"></i> AR Transaction</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <!-- Menu: Sub menu ul -->
            <ul class="sub-menu collapse" id="NursingServices">
              <li><a class="ms-link" href="?aremployee"><span><i class="icofont-caret-right"></i> Charge to Employee</span></a></li>
              <li><a class="ms-link" href="?ardoctor"><span><i class="icofont-caret-right"></i> Charge to Doctor</span></a></li>
            </ul>
          </li>



          <li class="collapsed">
            <a class="ms-link"  data-bs-toggle="collapse" data-bs-target="#NursingServices2" href="#">
              <span><i class="icofont-connection"></i> SCM Portal</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <!-- Menu: Sub menu ul -->
            <ul class="sub-menu collapse" id="NursingServices2">
              <li><a class="ms-link" href="?manualreceiving"><span><i class="icofont-caret-right"></i> Manual Receiving</span></a></li>
              <li><a class="ms-link" href="?purchaserequest"><span><i class="icofont-caret-right"></i> Purchase Request</span></a></li>
              <li><a class="ms-link" href="?stockissuance"><span><i class="icofont-caret-right"></i> Stock Issuance</span></a></li>
              <li><a class="ms-link" href="?stockrequest"><span><i class="icofont-caret-right"></i> Stock Requisition</span></a></li>
              <li><a class="ms-link" href="?stockreturn"><span><i class="icofont-caret-right"></i> Return to Warehouse</span></a></li>
              <li><a class="ms-link" href="?password&trans=adjustment"><span><i class="icofont-caret-right"></i> Adjusting Entry</span></a></li>
              <li><a class="ms-link" href="?bulkadjustment"><span><i class="icofont-caret-right"></i> Bulk Ajustment</span></a></li>
              <li><a class="ms-link" href="?reorderinglevel"><span><i class="icofont-caret-right"></i> Re-ordering level</span></a></li>
              <li><a class="ms-link" href="?countsheet"><span><i class="icofont-caret-right"></i> Count Sheet</span></a></li>

            </ul>
          </li>

          <li class="collapsed">
            <a class="ms-link"  data-bs-toggle="collapse" data-bs-target="#NursingServices3" href="#">
              <span><i class="icofont-funky-man"></i> Patient Profile</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <!-- Menu: Sub menu ul -->
            <ul class="sub-menu collapse" id="NursingServices3">
              <li><a class="ms-link" href="?activept"><span><i class="icofont-caret-right"></i> Active Patients</span></a></li>
              <li><a class="ms-link" href="?activeptopd"><span><i class="icofont-caret-right"></i> Today's OPD</span></a></li>
              <li><a class="ms-link" href="?archives"><span><i class="icofont-caret-right"></i> Search Archives</span></a></li>
            </ul>
          </li>



          <li class="collapsed">
            <a class="ms-link"  data-bs-toggle="collapse" data-bs-target="#NursingServices4" href="#">
              <span><i class="icofont-file-document"></i> Reports</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <!-- Menu: Sub menu ul -->
            <ul class="sub-menu collapse" id="NursingServices4">
            <li><a class="ms-link" href="?prhistory"><span><i class="icofont-caret-right"></i> Purchase Receiving Hist.</span></a></li>
            <li><a class="ms-link" href="?prsummary"><span><i class="icofont-caret-right"></i> Purchase Receiving Sum.</span></a></li>
            <li><a class="ms-link" href="?estockcard"><span><i class="icofont-caret-right"></i> Electronic Stockcard</span></a></li>
            <li><a class="ms-link" href="?adjustmenthistory"><span><i class="icofont-caret-right"></i> Adjustment History</span></a></li>
            <li><a class="ms-link" href="?issuancehistory"><span><i class="icofont-caret-right"></i> Issuance History</span></a></li>
            <li><a class="ms-link" href="?arreport"><span><i class="icofont-caret-right"></i> AR Reports</span></a></li>
            </ul>
          </li>

          <li><a class="ms-link" href="?requestreturn"><span><i class="icofont-search-user"></i> Processing for Refund</span></a></li>
          <li><a class="ms-link" href="?servemonitoring"><span><i class="icofont-monitor"></i> Served Monitoring</span></a></li>
          <li><a class="ms-link" href="?trackinvoice"><span><i class="icofont-architecture-alt"></i> Track Invoice</span></a></li>
          <li><a class="ms-link" href="?priceinquiry"><span><i class="icofont-price"></i> Price Inquiry</span></a></li>
<?php
if($dept=="PHARMACY"){
echo  "
          <li><a class='ms-link' href='?priceinquirynew'><span><i class='icofont-price'></i> Price Inquiry</span>&nbsp;<h6><span class='badge rounded-pill bg-danger' style='font-size: 10px;'>Beta</span></h6></a></li>
";
}
?>




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
