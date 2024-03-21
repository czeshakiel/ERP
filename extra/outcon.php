<?php
$servername2 = "192.168.0.200";
$username2 = "kmsciec";
$password2 = "levelwithme";
$dbname3 = "eclaimtree";
$dbname4 = "eclaimtree-temp";
$dbname5 = "cf4";
$dbname6 = "kmsci";

$mycon3 = mysqli_connect($servername2, $username2, $password2, $dbname3);
// Check connection
if (!$mycon3) {
    die("Connection failed: " . mysqli_connect_error());
}

$mycon4 = mysqli_connect($servername2, $username2, $password2, $dbname4);
// Check connection
if (!$mycon4) {
    die("Connection failed: " . mysqli_connect_error());
}

$mycon5 = mysqli_connect($servername2, $username2, $password2, $dbname5);
// Check connection
if (!$mycon5) {
    die("Connection failed: " . mysqli_connect_error());
}

$mycon6 = mysqli_connect($servername2, $username2, $password2, $dbname6);
// Check connection
if (!$mycon6) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
