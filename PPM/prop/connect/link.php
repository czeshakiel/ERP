<?php
session_start();
ini_set("display_errors","off");
$servername = "localhost";
$username = "root";
$password = "b0ykup4l";
$database = "kmsci";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the character set to UTF-8
if (!$conn->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $conn->error);
    exit();
}
?>