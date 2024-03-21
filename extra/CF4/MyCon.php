<?php
$ini = parse_ini_file("config.ini");
$servername = $ini['DBSERVER'];
$username = $ini['APPUSERNAME'];
$password = $ini['APPPASSWORD'];
$dbname = $ini['CF4'];
$setip = $ini['SETIP'];

// Create connection
$mycon = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$mycon) {die("Connection failed: " . mysqli_connect_error());}
?>
