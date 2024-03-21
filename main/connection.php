<?php
// ------------------>>>>>>>>>>>>>> DB CONNECTION ------------------------->>>>
$conn = mysqli_connect('localhost', 'root', 'b0ykup4l', 'kmsci');
if(!$conn){echo"<script>alert('Unable to connect KMSCI Databse');</script>";}
mysqli_query($conn,"SET NAMES 'utf8'");

$connEMR = mysqli_connect('localhost', 'root', 'b0ykup4l', 'medrecordsEMR');
if(!$connEMR){echo"<script>alert('Unable to connect medrecordsEMR Databse');</script>";}

$conncf4 = mysqli_connect('localhost', 'root', 'b0ykup4l', 'cf4');
if(!$conncf4){echo"<script>alert('Unable to connect CF4 Databse');</script>";}

$connepcb = mysqli_connect('localhost', 'root', 'b0ykup4l', 'epcb');
if(!$connepcb){echo"<script>alert('Unable to connect EPCB Databse');</script>";}

$tconn = mysqli_connect('localhost', 'root', 'b0ykup4l', 'kmsci-tmp');
if(!$tconn){echo"<script>alert('Unable to connect KMSCI Temporary Databse');</script>";}
// ------------------>>>>>>>>>>>>>> DB CONNECTION ------------------------->>>>


$conUp=mysqli_connect('192.168.0.183', 'uploadchart', 'uploadchart', 'kmsci');
if(!$conUp){echo"<script>alert('Unable to connect uploadchart');</script>";}
?>
