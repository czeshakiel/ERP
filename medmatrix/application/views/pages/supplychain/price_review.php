
<style>
.responsive-iframe {
  position: relative;
    height: 600px;
    width: 100%;
  border: none;
}
</style>


<div class="col-lg-12" style="width: 100%;">
<div class="card mb-4">
<div class="table-responsive p-3">
<?php
echo "
<iframe src='http://192.168.0.100:100/ERP/extra/Prices/?xox=".base64_encode($_SESSION['username'])."&xix=".base64_encode($_SESSION['dept'])."' height='700' width='100%'></iframe>
";
?>
</div>
</div>
</div>
