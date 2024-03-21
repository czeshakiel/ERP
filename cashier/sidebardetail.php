<?php include "../ns/modal_class.php"; ?>
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="?view=main">
          <i class="bi bi-grid"></i>
          <span>Main Menu</span>
        </a>
      </li><!-- End Dashboard Nav -->
      
<li class="nav-item">
<a class="nav-link collapsed" href="?view=detail&caseno=<?php echo $caseno ?>">
<i class="bi bi-person-check"></i><span>Patient Profile</span></a>
</li>

<li class="nav-item">
<a class="nav-link collapsed" href="?view=printslip&caseno=<?php echo $caseno ?>">
<i class="bi bi-printer"></i><span>Print Charge-Slip</span></a>
</li>



<li class="nav-item">
<a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
<i class="bi bi-vector-pen"></i><span>Profile Settings</span><i class="bi bi-chevron-down ms-auto"></i>
</a>
<ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">


<li><a href="?view=ap&caseno=<?php echo $caseno ?>">
<i class="bi bi-circle"></i><span>Change Attending Physician</span>
</a></li>

<li><a href="components-accordion.html">
<i class="bi bi-circle"></i><span>Set Senior/ Non-senior</span>
</a></li>

<li><a href="components-accordion.html">
<i class="bi bi-circle"></i><span>Change / Add Room</span>
</a></li>

<li><a href="?view=editcaseno&caseno=<?php echo $caseno ?>">
<i class="bi bi-circle"></i><span>Edit Hospital Caseno</span>
</a></li>

</ul>
</li>



<li class="nav-item">
<a class="nav-link collapsed" data-bs-target="#components-nav1" data-bs-toggle="collapse" href="#">
<i class="bi bi-menu-button-wide"></i><span>Claim Form Entry</span><i class="bi bi-chevron-down ms-auto"></i>
</a>
<ul id="components-nav1" class="nav-content collapse " data-bs-parent="#sidebar-nav">
<li><a href="components-alerts.html">
<i class="bi bi-circle"></i><span>Print Claim Form 4</span>
</a></li>

<li><a href="?view=otherinfo&caseno=<?php echo $caseno ?>">
<i class="bi bi-circle"></i><span>Additional Information</span>
</a></li>

<li><a href="?view=part2&caseno=<?php echo $caseno ?>">
<i class="bi bi-circle"></i><span>Pertinent Sign & Symptoms on Admission</span>
</a></li>

<li><a href="?view=part3&caseno=<?php echo $caseno ?>">
<i class="bi bi-circle"></i><span>Pertinent Findings per System</span>
</a></li>

<li><a href="?view=courseward&caseno=<?php echo $caseno ?>">
<i class="bi bi-circle"></i><span>Course in the Ward</span>
</a></li>

</ul>
</li>





<li class="nav-item">
<a class="nav-link collapsed" data-bs-target="#components-nav2" data-bs-toggle="collapse" href="#">
<i class="bi bi-cart-check"></i><span>Medical Details</span><i class="bi bi-chevron-down ms-auto"></i>
</a>
<ul id="components-nav2" class="nav-content collapse " data-bs-parent="#sidebar-nav">
<li><a href="?view=finaldx&caseno=<?php echo $caseno ?>">
<i class="bi bi-circle"></i><span>Set Final Diagnosis</span>
</a></li>

<li><a href="?view=medicationsheet&caseno=<?php echo $caseno ?>">
<i class="bi bi-circle"></i><span>Medication Sheet</span>
</a></li>

<li><a href="components-accordion.html">
<i class="bi bi-circle"></i><span>Doctor's Note</span>
</a></li>

<li><a href="components-accordion.html">
<i class="bi bi-circle"></i><span>Nurse's Note</span>
</a></li>

<li><a href="components-accordion.html">
<i class="bi bi-circle"></i><span>ME Sheet</span>
</a></li>

</ul>
</li>



<li class="nav-item">
<a class="nav-link collapsed" data-bs-target="#components-nav3" data-bs-toggle="collapse" href="#">
<i class="bi bi-images"></i><span>Diagnosis Results</span><i class="bi bi-chevron-down ms-auto"></i>
</a>
<ul id="components-nav3" class="nav-content collapse " data-bs-parent="#sidebar-nav">
<li><a href="components-alerts.html">
<i class="bi bi-circle"></i><span>Radiology Results</span>
</a></li>

<li><a href="components-accordion.html">
<i class="bi bi-circle"></i><span>ECG Results</span>
</a></li>

<li><a href="components-accordion.html">
<i class="bi bi-circle"></i><span>Laboratory Results</span>
</a></li>

</ul>
</li>


<li class="nav-item">
<a class="nav-link collapsed" data-bs-target="#components-nav4" data-bs-toggle="collapse" href="#">
<i class="bi bi-thermometer-high"></i><span>Paramedical Services</span><i class="bi bi-chevron-down ms-auto"></i>
</a>
<ul id="components-nav4" class="nav-content collapse " data-bs-parent="#sidebar-nav">
<li><a href="components-alerts.html">
<i class="bi bi-circle"></i><span>OR Final Diagnosis</span>
</a></li>

<li><a href="components-alerts.html">
<i class="bi bi-circle"></i><span>OR Results</span>
</a></li>

<li><a href="components-alerts.html">
<i class="bi bi-circle"></i><span>Procedure Schedule</span>
</a></li>

<li><a href="components-accordion.html">
<i class="bi bi-circle"></i><span>Health Care Infection</span>
</a></li>

<li><a href="?view=dietlist&caseno=<?php echo $caseno ?>">
<i class="bi bi-circle"></i><span>Diet List</span>
</a></li>

<li><a href="components-accordion.html">
<i class="bi bi-circle"></i><span>Discharged Summary</span>
</a></li>

</ul>
</li>

<?php if($status!="MGH"){ ?>
<li class="nav-item">
<a class="nav-link collapsed" data-bs-target="#components-nav5" data-bs-toggle="collapse" href="#">
<i class="bi bi-thermometer-high"></i><span>Administration & Return</span><i class="bi bi-chevron-down ms-auto"></i>
</a>
<ul id="components-nav5" class="nav-content collapse " data-bs-parent="#sidebar-nav">
<li><a href='http://<?php echo $ip ?>/iHIS/ns/return.php?caseno=<?php echo $caseno ?>' target='tabiframereturn' onclick="document.getElementById('idreturn').click();">
<i class="bi bi-circle"></i><span>Return Item/s</span>
<button type="button" id="idreturn" data-bs-toggle="modal" data-bs-target="#return" hidden>My Button</button>
</a></li>

<li><a href='http://<?php echo $ip ?>/iHIS/ns/administer.php?caseno=<?php echo $caseno ?>' target='tabiframeadminister' onclick="document.getElementById('idadminister').click();">
<i class="bi bi-circle"></i><span>Administer Item/s</span>
<button type="button" id="idadminister" data-bs-toggle="modal" data-bs-target="#administer" hidden>My Button</button>
</a></li>

<li><a href="components-alerts.html">
<i class="bi bi-circle"></i><span>Cancel Administered</span>
</a></li>

<li><a href="components-accordion.html">
<i class="bi bi-circle"></i><span>Cancel Prending Request</span>
</a></li>

<li><a href="components-accordion.html">
<i class="bi bi-circle"></i><span>Administered Medicine Report</span>
</a></li>

<li><a href="components-accordion.html">
<i class="bi bi-circle"></i><span>Pedia Monitoring</span>
</a></li>

</ul>
</li>
<?php } ?>



<br><br>

    </ul>

  </aside><!-- End Sidebar-->
  
<form method="POST" action="../mainpage/login.php">  
<div class="modal fade" id="verticalycentered" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
<div class="modal-header" style="background: <?php echo $primarycolor ?>; color: <?php echo $primarycolortext ?>;">
<h5 class="modal-title" id="dept2">Login!</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">


<div class="input-group form-group">
<div class="input-group-prepend">
<span class="input-group-text"><i class="bi bi-person-plus"></i></span>
</div>
<input type="text" name="username" class="form-control" placeholder="username">
<input type="hidden" name="dept22">
</div>
					
<div class="input-group form-group">
<div class="input-group-prepend">
<span class="input-group-text"><i class="bi bi-key"></i></span>
</div>
<input type="password" name="password" class="form-control" placeholder="password">
<input type="hidden" name="dept" id="dept" class="form-control">
</div>


</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-person-x"></i> Close</button>
<button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i> Login</button>
</div>
</div>
</div>
</div>
</form>

<script>   
function c_load(vall){
val2 = vall.toUpperCase();
document.getElementById("dept2").innerHTML = "<img src='img/login.gif' width='30' height='20'  style='border-radius: 50%;'> <font size='4px'>" + val2 + " DEPARTMENT</font>";
document.getElementById("dept").value = vall;
}
</script>
