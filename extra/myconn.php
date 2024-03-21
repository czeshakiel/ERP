<?php
$mysv="localhost";
$myun="root";
$mypw="b0ykup4l";
$mytmpdb="kmsci-tmp";

// Create connection
$tconn=mysqli_connect($mysv, $myun, $mypw, $mytmpdb);
// Check connection
if(!$tconn){
  die("Connection failed: " . mysqli_connect_error());
}

?>
