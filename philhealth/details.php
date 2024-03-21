<style>
@keyframes animate {
  0% {opacity: 0;}
  50% {opacity: 0.7;}
  100% {opacity: 0;}
}

.blinkforme {
  -webkit-animation: blinker 1s infinite;  /* Safari 4+ */
  -moz-animation: blinker 1s infinite;  /* Fx 5+ */
  -o-animation: blinker 1s infinite;  /* Opera 12+ */
  animation: blinker 1s infinite;  /* IE 10+, Fx 29+ */
}

@-webkit-keyframes blinker {
  0%, 49% {
    background-color: #FFFFFF;
    color: #FF0000;
    height: 100%;
  }
  50%, 100% {
    background-color: #FF0000;
    color: #FFFFFF;
    height: 100%;
  }
}
</style>

<?php
ini_set("display_errors","On");
$lb="Patient Details";

echo "
    <!-- Body: Body -->
    <div class='body d-flex py-lg-3 py-md-2'>
      <div class='container-xxl'>
";

include("profile.php");

echo "
        <div class='row clearfix g-3'>
          <div class='col-sm-12'>
            <div class='card mb-3'>

              <ul class='nav nav-tabs nav-tabs-bordered'>
                <li class='nav-item'>
                  <button class='nav-link active hover-effect' data-bs-toggle='tab' data-bs-target='#p1'><font size='2%'><i class='icofont-medicine'></i> Medicine(s)</font></button>
                </li>
                <li class='nav-item'>
                  <button class='nav-link hover-effect' data-bs-toggle='tab' data-bs-target='#p2'><font size='2%'><i class='icofont-thermometer-alt'></i> Supplies</font></button>
                </li>
                <li class='nav-item'>
                  <button class='nav-link hover-effect' data-bs-toggle='tab' data-bs-target='#p3'><font size='2%'><i class='icofont-flask'></i> Laboratories</font></button>
                </li>
                <li class='nav-item'>
                  <button class='nav-link hover-effect' data-bs-toggle='tab' data-bs-target='#p4'><font size='2%'><i class='icofont-nurse-alt'></i> Other Charges</font></button>
                </li>
                <li class='nav-item'>
                  <button class='nav-link hover-effect' data-bs-toggle='tab' data-bs-target='#p5'><font size='2%'><i class='icofont-undo'></i> Return Usage</font></button>
                </li>
                <li class='nav-item'>
                  <button class='nav-link hover-effect' data-bs-toggle='tab' data-bs-target='#p6'><font size='2%'><i class='icofont-link-broken'></i> Damage Item(s)</font></button>
                </li>
                <li class='nav-item'>
                  <button class='nav-link hover-effect' data-bs-toggle='tab' data-bs-target='#p7'><font size='2%'><i class='icofont-close-circled'></i> Cancelled</font></button>
                </li>

              </ul>
              <div class='tab-content pt-2'>
                <div class='tab-pane fade show active' id='p1'>
";

include('details/med.php');

echo "
                </div>
                <div class='tab-pane fade show' id='p2'>
";

include('details/sup.php');

echo "
                </div>
                <div class='tab-pane fade show' id='p3'>
";

include('details/lab_xray.php');

echo "
                </div>
                <div class='tab-pane fade show' id='p4'>
";

include('details/othercharges.php');

echo "
                </div>
                <div class='tab-pane fade show' id='p5'>
";

include('details/return.php');

echo "
                </div>
                <div class='tab-pane fade show' id='p6'>
";

include('details/damage.php');

echo "
                </div>
                <div class='tab-pane fade show' id='p7'>
";

include('details/cancelled.php');

echo "
                </div>
              </div>

            </div>
          </div>
        </div><!-- Row End -->
      </div>
    </div>
";

//echo "<META HTTP-EQUIV='Refresh'CONTENT='1500;URL=Close.php'>";
?>
