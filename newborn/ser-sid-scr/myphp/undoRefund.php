<?php
include '../../meshes/alink.php';
ini_set("display_errors", "on");

$caseno = $_POST['caseno'];
$refno = $_POST['refno'];
$status = "pending";
$loginuser = $_SESSION['username'];

$updateQuery = $pdo->query("UPDATE productout SET `terminalname` = '$status' WHERE `caseno`= '$caseno' AND `refno` = '$refno'");
if ($updateQuery){
    echo "success";
}else{
    $errorInfo = $pdo->errorInfo();
    echo "error: " . $errorInfo[2];
}
?>