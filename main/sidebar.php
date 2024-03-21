
    <button class='hamburger' onclick='sbview();'><i class='icofont-navigation-menu'></i></button>
    <!-- sidebar -->
    <div class="sidebar px-4 py-4 py-md-5 me-0">
      <div class="d-flex flex-column h-100">
        <a href="index.html" class="mb-0 brand-icon">
          <img src="../main/img/logo/logo.png" width='40' height='40' style='border-radius: 50%;'>
          <span class="logo-text">MedMatrix<br><small style="font-size:11px;">eHealth Solutions, Inc.</small></span>
        </a>
        <!-- Menu: main ul -->
        <ul class="menu-list flex-grow-1 mt-3">
          <li><a class="ms-link" href="../medmatrix/?dept=ADMISSION"><span><i class="icofont-medical-sign"></i> Admission</span></a></li>
          <li><a class="ms-link" href="../medmatrix/?dept=ER"><span><i class="icofont-ambulance-cross"></i> Emergency Room</span></a></li>
          <li><a class="ms-link" href="../medmatrix/?dept=OPD"><span><i class="icofont-wheelchair"></i> Out-Patient Dept</span></a></li>
          <li><a class="ms-link" href="../medmatrix/?dept=RDU"><span><i class="icofont-hospital"></i> Renal Dialysis Unit</span></a></li>
          <li class="collapsed">
            <a class="ms-link"  data-bs-toggle="collapse" data-bs-target="#NursingServices" href="#">
              <span><i class="icofont-nursing-home"></i> Nursing Services</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <!-- Menu: Sub menu ul -->
            <ul class="sub-menu collapse" id="NursingServices">
              <li><a class="ms-link" href="../login/?dept=NS1"><span><i class="icofont-caret-right"></i> Nursing Station 1</span></a></li>
              <li><a class="ms-link" href="../login/?dept=NS2"><span><i class="icofont-caret-right"></i> Nursing Station 2</span></a></li>
              <li><a class="ms-link" href="../login/?dept=NS3"><span><i class="icofont-caret-right"></i> Nursing Station 3</span></a></li>
              <li><a class="ms-link" href="../login/?dept=NS4"><span><i class="icofont-caret-right"></i> Nursing Station 4</span></a></li>
              <li><a class="ms-link" href="../login/?dept=NS 5A"><span><i class="icofont-caret-right"></i> Nursing Station 5A</span></a></li>
              <li><a class="ms-link" href="../login/?dept=NS 5B"><span><i class="icofont-caret-right"></i> Nursing Station 5B</span></a></li>
              <li><a class="ms-link" href="../login/?dept=NS 6"><span><i class="icofont-caret-right"></i> Nursing Station 6</span></a></li>
              <li><a class="ms-link" href="../login/?dept=NS7"><span><i class="icofont-caret-right"></i> Nursing Station 7</span></a></li>
              <li><a class="ms-link" href="../login/?dept=ICU"><span><i class="icofont-caret-right"></i> ICU</span></a></li>
              <li><a class="ms-link" href="../login/?dept=COVID ICU"><span><i class="icofont-caret-right"></i> COVID ICU</span></a></li>
              <li><a class="ms-link" href="../login/?dept=SCU"><span><i class="icofont-caret-right"></i> NICU</span></a></li>
              <li><a class="ms-link" href="../login/?dept=Verifier"><span><i class="icofont-caret-right"></i> Verifier</span></a></li>
            </ul>
          </li>
          <li class="collapsed">
            <a class="ms-link" data-bs-toggle="collapse" data-bs-target="#tikit-Components" href="#">
              <span><i class="icofont-ticket"></i> Special Services</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <ul class="sub-menu collapse" id="tikit-Components">
              <li><a class="ms-link" href="../login/?dept=OR"><span><i class="icofont-caret-right"></i> Operating Room</span></a></li>
              <li><a class="ms-link" href="../login/?dept=PT"><span><i class="icofont-caret-right"></i> Physical Theraphy</span></a></li>
              <li><a class="ms-link" href="../login/?dept=RT"><span><i class="icofont-caret-right"></i> Respiratory Theraphy</span></a></li>
              <li><a class="ms-link" href="../medmatrix/?dept=ONCOLOGY"><span><i class="icofont-caret-right"></i> Oncology</span></a></li>
              <li><a class="ms-link" href="../medmatrix/?dept=KONSULTA"><span><i class="icofont-caret-right"></i> Konsulta</span></a></li>
            </ul>
          </li>
          <li><a class="ms-link" href="../login/?dept=Information"><span><i class="icofont-info-circle"></i> Information</span></a></li>
          <li class="collapsed">
            <a class="ms-link" data-bs-toggle="collapse" data-bs-target="#client-Components" href="#">
              <span><i class="icofont-medicine"></i> Pharmacy/CSR2</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <ul class="sub-menu collapse" id="client-Components">
              <li><a class="ms-link" href="../login/?dept=PHARMACY"><span><i class="icofont-caret-right"></i> Pharmacy</span></a></li>
              <li><a class="ms-link" href="../login/?dept=PHARMACY_OPD"><span><i class="icofont-caret-right"></i> Pharmacy Opd</span></a></li>
              <li><a class="ms-link" href="../login/?dept=CSR2"><span><i class="icofont-caret-right"></i> Csr2</span></a></li>
            </ul>
          </li>
          <li class="collapsed">
            <a class="ms-link" data-bs-toggle="collapse" data-bs-target="#emp-Components" href="#">
              <span><i class="icofont-film"></i> Imaging</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <ul class="sub-menu collapse" id="emp-Components">
              <li><a class="ms-link" href="../login/?dept=XRAY"><span><i class="icofont-caret-right"></i> Radiology</span></a></li>
              <li><a class="ms-link" href="../login/?dept=EEG"><span><i class="icofont-caret-right"></i> EEG</span></a></li>
              <li><a class="ms-link" href="../login/?dept=Heart"><span><i class="icofont-caret-right"></i> Heart</span></a></li>
            </ul>
          </li>
          <li class="collapsed">
            <a class="ms-link" data-bs-toggle="collapse" data-bs-target="#menu-Componentsone" href="#">
              <span><i class="icofont-flask"></i> Laboratories</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <ul class="sub-menu collapse" id="menu-Componentsone">
              <li><a class="ms-link" href="../login/?dept=LABORATORY"><span><i class="icofont-caret-right"></i> Laboratory</span> </a></li>
              <li><a class="ms-link" href="../login/?dept=RAPID"><span><i class="icofont-caret-right"></i> RT-PCR/Rapid</span> </a></li>
              <li><a class="ms-link" href="../login/?dept=NEW BORN SCREENING"><span><i class="icofont-caret-right"></i> Newborn</span> </a></li>
              <li><a class="ms-link" href="../login/?dept=EXPRESS"><span><i class="icofont-caret-right"></i> Express Printing</span> </a></li>
            </ul>
          </li>
          <li><a class="ms-link" href="../login/?dept=BILLING"><span><i class="icofont-coins"></i> Billing</span></a></li>
          <li><a class="ms-link" href="../medmatrix/?dept=HMO"><span><i class="icofont-bow"></i> HMO</span></a></li>
             <li class="collapsed">
            <a class="ms-link" data-bs-toggle="collapse" data-bs-target="#payroll-Components" href="#">
              <span><i class="icofont-pay"></i>  Cashier</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <!-- Menu: Sub menu ul -->
            <ul class="sub-menu collapse" id="payroll-Components">
              <li><a class="ms-link" href="../login/?dept=CASHIER"><span><i class="icofont-caret-right"></i> Cashier Main</span> </a></li>
              <li><a class="ms-link" href="../login/?dept=CASHIER2"><span><i class="icofont-caret-right"></i> Cashier OPD</span> </a></li>
              <li><a class="ms-link" href="../login/?dept=CASHIER3"><span><i class="icofont-caret-right"></i> Cashier Pharma</span> </a></li>
              <li><a class="ms-link" href="../login/?dept=CASHIER4"><span><i class="icofont-caret-right"></i> Cashier RDU</span> </a></li>
            </ul>
          </li>
          <li><a class="ms-link" href="../login/?dept=PHILHEALTH"> <span><i class="icofont-patient-file"></i> PhilHealth</span></a></li>
          <li class="collapsed">
            <a class="ms-link" data-bs-toggle="collapse" data-bs-target="#SCMNew" href="#">
              <span><i class="icofont-users-alt-5"></i> SCM Portal</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <!-- Menu: Sub menu ul -->
            <ul class="sub-menu collapse" id="SCMNew">
              <li><a class="ms-link" href="../medmatrix/?dept=CPU"><span><i class="icofont-caret-right"></i> CPU</span> </a></li>
              <li><a class="ms-link" href="../medmatrix/?dept=CSR"><span><i class="icofont-caret-right"></i> CSR</span> </a></li>
              <li><a class="ms-link" href="../medmatrix/?dept=CPU-RDU"><span><i class="icofont-caret-right"></i> CPU-RDU</span> </a></li>
              <li><a class="ms-link" href="../medmatrix/request_login"><span><i class="icofont-caret-right"></i> Inter Deaprtment Requisition</span> </a></li>
            </ul>
          </li>
          <li class="collapsed">
            <a class="ms-link" data-bs-toggle="collapse" data-bs-target="#MedicalRecords" href="#">
              <span><i class="icofont-users-alt-5"></i> Medical Records</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <!-- Menu: Sub menu ul -->
            <ul class="sub-menu collapse" id="MedicalRecords">
              <li><a class="ms-link" href="../medmatrix/?dept=MEDICAL RECORDS"><span><i class="icofont-caret-right"></i> Medical Records Module</span></a></li>
              <li><a class="ms-link" href="../login/?dept=MEDICAL RECORDSEMR"><span><i class="icofont-caret-right"></i> Medical Records EMR</span></a></li>
              <li><a class="ms-link" href="../login/?dept=MEDICAL RECORDS EMR"><span><i class="icofont-caret-right"></i> EMR-Portal</span></a></li>
            </ul>
          </li>
          <li class="collapsed">
            <a class="ms-link" data-bs-toggle="collapse" data-bs-target="#DoctorsModule" href="#">
              <span><i class="icofont-doctor-alt"></i> Doctor Module</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <!-- Menu: Sub menu ul -->
            <ul class="sub-menu collapse" id="DoctorsModule">
              <li><a class="ms-link" href="http://192.168.0.100:100/arv2022/Auth/?dept=DOC-OTHERS"><span><i class="icofont-caret-right"></i> Doctors Log</span></a></li>
<li><a class="ms-link" href="../login/?dept=DOC-OTHERS"><span><i class="icofont-caret-right"></i> Doctors Log - Beta</span></a></li>
              <li><a class="ms-link" href="../login/?dept=RADIOLOGYDOCTORS"><span><i class="icofont-caret-right"></i> Readers Log</span></a></li>
              <li><a class="ms-link" href="../login/?dept=TRANSCRIBER"><span><i class="icofont-caret-right"></i> Transcriptionist</span></a></li>
            </ul>
          </li>
          <li><a class="ms-link" href="http://192.168.0.200/"><span><i class="icofont-electron"></i> MedMatrix eClaims</span></a></li>
          <li><a class="ms-link" href="../medmatrix/?dept=DIETARY"><span><i class="icofont-bow"></i> Dietary</span></a></li>
          <li><a class="ms-link" href="../login/?dept=SOCIAL WORKER"><span><i class="icofont-bow"></i> Social Worker</span></a></li>
          <li><a class="ms-link" href="http://194.233.79.65/"><span><i class="icofont-bow"></i> HR Information System</span></a></li>
          <li class="collapsed">
            <a class="ms-link" data-bs-toggle="collapse" data-bs-target="#MaintenanceReport" href="#">
              <span><i class="icofont-users-alt-5"></i> Maintenance & Report</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <!-- Menu: Sub menu ul -->
            <ul class="sub-menu collapse" id="MaintenanceReport">
              <li><a class="ms-link" href="../login/?dept=ADMINISTRATOR1"><span><i class="icofont-caret-right"></i> Administrator</span></a></li>
              <li><a class="ms-link" href="../login/?dept=ACCOUNTING"><span><i class="icofont-caret-right"></i> Accounting</span></a></li>
              <li><a class="ms-link" href="../login/?dept=IT ADMIN"><span><i class="icofont-caret-right"></i> IT Admin</span></a></li>
              <li><a class="ms-link" href="../medmatrix/?dept=Masterfile"><span><i class="icofont-caret-right"></i> Masterfile</span></a></li>
              <li><a class="ms-link" href="salaryslip.html"><span><i class="icofont-caret-right"></i> Statistics</span></a></li>
              <li><a class="ms-link" href="salaryslip.html"><span><i class="icofont-caret-right"></i> Segworks</span></a></li>
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

        <!-- Menu: menu collepce btn -->
        <button type="button" class="btn btn-link sidebar-mini-btn text-light">
          <span class="ms-2"><i class="icofont-bubble-right"></i></span>
        </button>
      </div>
    </div>
