
<?php
$diss = 0;
$sql91 = "select * from admission where lastnamed='to follow'";
$result91 = $conn->query($sql91);
while($row91 = $result91->fetch_assoc()) {
$caseno=$row91['caseno'];

$sql1ssx = "select * from courseward where caseno='$caseno'";
$result1ssx = $conncf4->query($sql1ssx);
$count_coursewardx = mysqli_num_rows($result1ssx);

if($count_coursewardx<2){$diss++;}
}

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
          <li><a class="ms-link" href="?main"><span><i class="icofont-ui-home"></i> Main Menu</span></a></li>
          <?php if($diss<=0){ ?>
          <li><a class="ms-link" href="?activept"><span><i class="icofont-ui-home"></i> Active Patient</span></a></li>
          <li><a class="ms-link" href="?activeptopd"><span><i class="icofont-search-user"></i> OPD List</span></a></li>
          <li><a class="ms-link" href="?archives"><span><i class="icofont-search-user"></i> Archives</span></a></li>
          <?php } ?>



          
          
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