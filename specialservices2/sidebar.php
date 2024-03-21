

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
          <li><a class="ms-link" href="?archives"><span><i class="icofont-search-user"></i> Search Archive</span></a></li>
          <li><a class="ms-link" href="?activepatients"><span><i class="icofont-user"></i> Active Patient</span></a></li>
          <li class="collapsed">
            <a class="ms-link"  data-bs-toggle="collapse" data-bs-target="#NursingServices" href="#">
              <span><i class="icofont-ui-settings"></i> Supply Chain</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span>
            </a>
            <!-- Menu: Sub menu ul -->
            <ul class="sub-menu collapse" id="NursingServices">
              <li><a class="ms-link" href="?stockrequest"><span><i class="icofont-caret-right"></i> Stock Request</span></a></li>
              <li><a class="ms-link" href="?issuancehistory"><span><i class="icofont-caret-right"></i> Issuance History Detl.</span></a></li>
              <li><a class="ms-link" href="?issuancehistorysummary"><span><i class="icofont-caret-right"></i> Issuance History Sum.</span></a></li>
            </ul>
          </li>

        <?php if($dept=="PT"){
          echo"
          <li><a class='ms-link' href='?ptpf'><span><i class='icofont-ui-file'></i> PT Prof. Fee Report</span></a></li>
          <li><a class='ms-link' href='?ptlab'><span><i class='icofont-flask'></i> PT Lab Request</span></a></li>
          <li><a class='ms-link' href='?patientlist'><span><i class='icofont-flask'></i> Admission</span></a></li>
          ";
          } ?>

<?php if($dept=="RT"){
          echo"
          <li><a class='ms-link' href='?rtlab'><span><i class='icofont-flask'></i> RT Lab Request</span></a></li>
          <li><a class='ms-link' href='?patientlist'><span><i class='icofont-flask'></i> Admission</span></a></li>
          ";
          } ?>

<?php
$zmsql=mysqli_query($tconn,"SELECT * FROM `purchaseorder` WHERE `reqdept`='$dept' AND `status`='request'");
$zmcount=mysqli_num_rows($zmsql);

$newbadge="";
if($zmcount>0){
  $newbadge=" <span class='badge bg-danger' style='font-size: 12px;'>$zmcount</span>";
}

echo "
           <li><a class='ms-link' href='?autostk'><span><i class='icofont-cart'></i> Auto Stock Request$newbadge</span></a></li>
";
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
