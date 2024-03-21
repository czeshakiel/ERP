<?php
include '../../meshes/alink.php';
ini_set("display_errors", "on");

$caseno = $_POST['caseno'];
$refno = $_POST['refno'];
$status = "CANCELLED";

// echo "success";
$updateQuery = $pdo->query("UPDATE productout SET `status` = '$status', `terminalname` = '$status' WHERE `caseno`= '$caseno' AND `refno` = '$refno'");
if ($updateQuery){
    echo "success";
}else{
    $errorInfo = $pdo->errorInfo();
    echo "error: " . $errorInfo[2];
}
?>
