<?php
ini_set("display_errors","On");
include("../Settings.php");
$cuz = new database();
$setip=$cuz->setIP();

echo "
<html>
  <head>
    <title>PACKAGE ADDED</title>
    <link rel='stylesheet' type='text/css' href='http://$setip/arv2020/Auth/css/login2.css'>
    <link rel='stylesheet' href='http://$setip/arv2020/arv_includes/stackpath.bootstrapcdn.css'>
    <link rel='icon' href='http://$setip/arv2020/Auth/icons/avatar1.png' type='image/png' />
    <link rel='shortcut icon' href='http://$setip/arv2020/Auth/icons/avatar1.png' type='image/png' />
  </head>
  <body>
    <div align='left' style='color: #A569BD;font-weight: bold;font-family: arial;font-size: 14px;'>ITEM ADDED</div>
  </body>
</html>
";
?>
