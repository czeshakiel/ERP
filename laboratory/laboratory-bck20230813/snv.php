<script src="jquery-1.9.1.min.js"></script>
<link href="toastr.css" rel="stylesheet"/>
<script type="text/javascript">
  function toast1() {
    toastr.success("Case number copied to clipboard.");
  }
  function toast2() {
    toastr.success("Reference number copied to clipboard.");
  }
</script>

<?php
$lb="Set Normal Values";


if(isset($_POST['dt'])){
  $dt=mysqli_real_escape_string($conn,$_POST['dt']);

  if($dt==""){
    $da=date("Y-m-d");
  }
  else{
    $da=$dt;
  }
}
else{
  $da=date("Y-m-d");
}

echo "
    <!-- Body: Body -->
    <div class='body d-flex py-lg-3 py-md-2'>
      <div class='container-xxl'>
        <div class='row align-items-center'>
          <div class='border-0 mb-4'>
            <div class='card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap'>
              <h3 class='fw-bold mb-0'>$lb</h3>
            </div>
          </div>
        </div> <!-- Row end  -->
        <div class='row clearfix g-3'>
          <div class='col-sm-12'>
            <div class='card mb-3'>
              <div class='card-body'>
                <iframe src='../extra/LabExpress/LabList/?type=hematology' title='description' width='100%' height='600' style='border: none;'></iframe>
              </div>
            </div>
          </div>
        </div><!-- Row End -->
      </div>
    </div>
";
?>
