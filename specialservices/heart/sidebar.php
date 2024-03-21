

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
          <li><a class="ms-link" href="?readerslogin"><span><i class="icofont-doctor"></i> Readers Lounge</span></a></li>
          <li><a class="ms-link" href="?archives"><span><i class="icofont-search-user"></i> Search Archive</span></a></li>
          <li class="collapsed">
            <a class="ms-link"  data-bs-toggle="collapse" data-bs-target="#NursingServices" href="#">
              <span><i class="icofont-ui-settings"></i> Supply Chain</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <!-- Menu: Sub menu ul -->
            <ul class="sub-menu collapse" id="NursingServices">
              <li><a class="ms-link" href="?ap&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Stock Request</span></a></li>
              <li><a class="ms-link" href="../login/?dept=NS2"><span><i class="icofont-caret-right"></i> Acknowledge Issuance</span></a></li>
              <li><a class="ms-link" href="../login/?dept=NS3"><span><i class="icofont-caret-right"></i> Issuance History</span></a></li>
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