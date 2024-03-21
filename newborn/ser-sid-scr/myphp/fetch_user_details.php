<?php
include("../../meshes/alink.php");
ini_set("display_errors", "on");

$lguser = $_POST['lguser'];
$queryUserEmpId = $pdo->query("SELECT empid FROM nsauth WHERE `name`='$lguser' LIMIT 1");
if ($queryUserEmpId->rowCount() > 0) {
    $rowUserEmp = $queryUserEmpId->fetch(PDO::FETCH_ASSOC);
    $userEmpId = $rowUserEmp["empid"];
    $queryUserDetails = $pdo->query("SELECT * FROM nsauthemployees WHERE `empid`='$userEmpId'");
    $userDetails = array();
    if ($queryUserDetails->rowCount() > 0) {
        $userDetails = $queryUserDetails->fetch(PDO::FETCH_ASSOC);
    }
} else {
    $userDetails = array();
}

$jsonResult = json_encode($userDetails);

echo $jsonResult;
?>
