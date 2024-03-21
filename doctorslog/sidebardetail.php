<button class='hamburger' onclick='sbview();'><i class='icofont-navigation-menu'></i></button>

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
          <li><a class="ms-link" href="?detail&caseno=<?php echo $caseno ?>"><span><i class="icofont-waiter-alt"></i> My Profile</span></a></li>


          <li class="collapsed">
            <a class="ms-link" data-bs-toggle="collapse" data-bs-target="#tikit-Components" href="#">
              <span><i class="icofont-patient-file"></i> Cf4 Entry</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <ul class="sub-menu collapse" id="tikit-Components">
              <li><a class="ms-link" href="http://<?php echo $ip ?>/eClaims/CF4.php?caseno=<?php echo $caseno ?>" target="_blank"><span><i class="icofont-caret-right"></i> Print CF4</span></a></li>
              <li><a class="ms-link" href="?otherinfo&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Additional Info</span></a></li>
              <li><a class="ms-link" href="?part2&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Pertinent Sign & Symptoms on Admission</span></a></li>
              <li><a class="ms-link" href="?part3&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Pertinent Findings per System</span></a></li>
              <li><a class="ms-link" href="?courseward&caseno=<?php echo $caseno ?>"><span><i class="icofont-caret-right"></i> Course in the Ward</span></a></li>
            </ul>
          </li>

          <li><a class="ms-link" href="?diagnosisresult&caseno=<?php echo $caseno ?>"><span><i class="icofont-flask"></i> Test Performed</span></a></li>
          <li><a class="ms-link" href="?finaldx&caseno=<?php echo $caseno ?>"><span><i class="icofont-medical-sign"></i> Final Diagnosis</span></a></li>
          
         



          
          
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