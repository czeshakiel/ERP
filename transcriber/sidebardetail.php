

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
          <li><a class="ms-link" href="?detail&caseno=<?php echo $caseno ?>"><span><i class="icofont-man-in-glasses"></i> Patient Profile</span></a></li>
          <li><a class="ms-link" href="../login/?dept=OPD"><span><i class="icofont-printer"></i> Print Charge-Slip</span></a></li>
          <li class="collapsed">
            <a class="ms-link"  data-bs-toggle="collapse" data-bs-target="#NursingServices" href="#">
              <span><i class="icofont-ui-settings"></i> Profile Settings</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <!-- Menu: Sub menu ul -->
            <ul class="sub-menu collapse" id="NursingServices">
              <li><a class="ms-link" href="?ap&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Attending Physician</span></a></li>
              <li><a class="ms-link" href="?senior&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Senior/ PWD</span></a></li>
              <li><a class="ms-link" href="../login/?dept=NS3"><span><i class="icofont-caret-right"></i> Room</span></a></li>
              <li><a class="ms-link" href="?editcaseno&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Hospital Caseno</span></a></li>
              <li><a class="ms-link" href="?dietlist&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Diet List</span></a></li>
            </ul>
          </li>
          <li class="collapsed">
            <a class="ms-link" data-bs-toggle="collapse" data-bs-target="#tikit-Components" href="#">
              <span><i class="icofont-patient-file"></i> Cf4 Entry</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <ul class="sub-menu collapse" id="tikit-Components">
              <li><a class="ms-link" href="../login/?dept=OR"><span><i class="icofont-caret-right"></i> Print CF4</span></a></li>
              <li><a class="ms-link" href="?otherinfo&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Additional Info</span></a></li>
              <li><a class="ms-link" href="?part2&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Pertinent Sign & Symptoms on Admission</span></a></li>
              <li><a class="ms-link" href="?part3&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Pertinent Findings per System</span></a></li>
              <li><a class="ms-link" href="?courseward&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Course in the Ward</span></a></li>
            </ul>
          </li>

          <li class="collapsed">
            <a class="ms-link" data-bs-toggle="collapse" data-bs-target="#client-Components" href="#">
              <span><i class="icofont-medicine"></i> Medical Details</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <ul class="sub-menu collapse" id="client-Components">
              <li><a class="ms-link" href="?finaldx&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Final Diagnosis</span></a></li>
              <li><a class="ms-link" href="?medicationsheet&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Medication Sheet</span></a></li>
              <li><a class="ms-link" href=../login/?dept=CSR2"><span><i class="icofont-caret-right"></i> Doctor's Note</span></a></li>
              <li><a class="ms-link" href=../login/?dept=CSR2"><span><i class="icofont-caret-right"></i> Nurses Note</span></a></li>
              <li><a class="ms-link" href="mesheet2.php?caseno=<?php echo $caseno ?>" target="_blank"><span><i class="icofont-caret-right"></i> ME Sheet</span></a></li>
            </ul>
          </li>
          <li class="collapsed">
            <a class="ms-link" data-bs-toggle="collapse" data-bs-target="#emp-Components" href="#">
              <span><i class="icofont-medical-sign"></i> Other Services</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <ul class="sub-menu collapse" id="emp-Components">
              <li><a class="ms-link" href="../login/?dept=Heart"><span><i class="icofont-caret-right"></i> Procedure Schedule</span></a></li>
              <li><a class="ms-link" href=../login/?dept=CSR2"><span><i class="icofont-caret-right"></i> Health Care Infection</span></a></li>
              <li><a class="ms-link" href=../login/?dept=CSR2"><span><i class="icofont-caret-right"></i> Discharged Summary</span></a></li>
            </ul>
          </li>

          <li class="collapsed">
            <a class="ms-link" data-bs-toggle="collapse" data-bs-target="#emp-Components2" href="#">
              <span><i class="icofont-hand"></i> Administration & Return</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <ul class="sub-menu collapse" id="emp-Components2">
            
<li><a class="ms-link" href='http://<?php echo $ip ?>/ERP/nsstation/return.php?caseno=<?php echo $caseno ?>' target='tabiframereturn' onclick="document.getElementById('idreturn').click();">
<span><i class="icofont-caret-right"></i> Return Item(s)</span>
<button type="button" id="idreturn" data-bs-toggle="modal" data-bs-target="#return" hidden>My Button</button>
</a></li>

<li><a class="ms-link" href='http://<?php echo $ip ?>/ERP/nsstation/administer.php?caseno=<?php echo $caseno ?>' target='tabiframeadminister' onclick="document.getElementById('idadminister').click();">
<span><i class="icofont-caret-right"></i> Administer Item(s)</span>
<button type="button" id="idadminister" data-bs-toggle="modal" data-bs-target="#administer" hidden>My Button</button>
</a></li>

              <li><a class="ms-link" href="../login/?dept=Heart"><span><i class="icofont-caret-right"></i> Cancel Administered</span></a></li>
              <li><a class="ms-link" href=../login/?dept=CSR2"><span><i class="icofont-caret-right"></i> Cancel Pending Request</span></a></li>
              <li><a class="ms-link" href=../login/?dept=CSR2"><span><i class="icofont-caret-right"></i> Administered Med Report</span></a></li>
              <li><a class="ms-link" href=../login/?dept=CSR2"><span><i class="icofont-caret-right"></i> Pedia Monitoring</span></a></li>
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
    <?php include "../nsstation/modal_class.php"; ?>