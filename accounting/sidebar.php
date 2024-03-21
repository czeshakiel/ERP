

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
          <li><a class="ms-link" href="?main"><span><i class="icofont-ui-home"></i> Main Menu</span></a></li>

          <li><a class="ms-link" href="?accountpayable"><span><i class="icofont-pay"></i> Accounts Payable</span></a></li>
          <li><a class="ms-link" href="?accountreceivable"><span><i class="icofont-money"></i> Accounts Receivable</span></a></li>


          <li class="collapsed">
            <a class="ms-link"  data-bs-toggle="collapse" data-bs-target="#NursingServices3" href="#">
              <span><i class="icofont-ui-settings"></i> Patient Refund</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <!-- Menu: Sub menu ul -->
            <ul class="sub-menu collapse" id="NursingServices3">
              <li><a class="ms-link" href="?paysupplier"><span><i class="icofont-caret-right"></i> Medicine & Supplies</span></a></li>
              <li><a class="ms-link" href="?editOR"><span><i class="icofont-caret-right"></i> Lab & Other Services</span></a></li>
            </ul>
          </li>

          <li class="collapsed">
            <a class="ms-link"  data-bs-toggle="collapse" data-bs-target="#NursingServices4" href="#">
              <span><i class="icofont-ui-file"></i> Reports</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <!-- Menu: Sub menu ul -->
            <ul class="sub-menu collapse" id="NursingServices4">
            <li><a class="ms-link" href="?readerpf"><span><i class="icofont-caret-right"></i> Reader PF Report</span></a></li>
              <li><a class="ms-link" href="?papsmear"><span><i class="icofont-caret-right"></i> Papsmear Report</span></a></li>
              <li><a class="ms-link" href="?diagnosticrep"><span><i class="icofont-caret-right"></i> Diagnostic Report</span></a></li>
              <li><a class="ms-link" href="?billingreport"><span><i class="icofont-caret-right"></i> Billing Report</span></a></li>              
              <li><a class="ms-link" href="?arreport"><span><i class="icofont-caret-right"></i> Acct. Receivable Report</span></a></li>
              <li><a class="ms-link" href="?pfreport"><span><i class="icofont-caret-right"></i> Prof. Fee Report</span></a></li>
              <li><a class="ms-link" href="../medmatrix/dialysis_report/<?php echo $user ?>/<?php echo $userunique ?>/<?php echo $dept ?>"><span><i class="icofont-caret-right"></i> Dialysis Report</span></a></li>
            </ul>
          </li>


          <li><a class="ms-link" href="?pricereview"><span><i class="icofont-ui-home"></i> Price Review</span></a></li>
          
          
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