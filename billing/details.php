<?php
$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);
$dept=mysqli_real_escape_string($conn,$_GET['dept']);
$user=mysqli_real_escape_string($conn,$_GET['user']);

$billlink=str_replace("/ERP/billing/","",$_SERVER['REQUEST_URI']);

echo "
<style>
  .responsive-iframe{position: relative;height: 100%;width: 100%;border: none;padding-top: 5px;}
</style>
<iframe class='responsive-iframe' src='../extra/BillMe/$billlink'></iframe>
";
?>
