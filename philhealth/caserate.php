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

$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);
$setuser=mysqli_real_escape_string($conn,$_GET['user']);

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
              <div class='card-header'>
                <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td><div align='left'><h5 class='fw-bold'><i class='icofont-listine-dots me-2'></i> PhilHealth Case Rate</h5></div></td>
                  </tr>
                </table>
              </div>
              <div class='card-body' align='left'>
";

//---------------------------------------------------------------------------------------------------------------------------------------------------

echo "
                <iframe src='../extra/CaseRates/?caseno=$caseno&user=$setuser&noclose' title='description' width='100%' height='600' style='border: none;'></iframe>
";

//---------------------------------------------------------------------------------------------------------------------------------------------------
echo "
              </div>
            </div>
          </div>
        </div><!-- Row End -->
      </div>
    </div>
";

//echo "<META HTTP-EQUIV='Refresh'CONTENT='1500;URL=Close.php'>";
?>
