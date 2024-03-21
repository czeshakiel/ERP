<?php
$dhost = 'localhost';
$dusername = 'root';
$dpassword = 'b0ykup4l';
$ddbname = 'kmsci';

$conn = new mysqli($dhost, $dusername, $dpassword, $ddbname);
mysqli_set_charset($conn,"utf8"); 
if(!$conn){
  die("Cannot connect to the databse.".$conn->error);
}

?>
