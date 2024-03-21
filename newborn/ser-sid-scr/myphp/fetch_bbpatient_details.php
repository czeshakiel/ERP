<?php
session_start();
include("../../meshes/alink.php");
ini_set("display_errors", "on");

$caseno = $_POST['caseno'];
$refno = $_POST['refno'];

$queryPtProfile = $pdo->query("SELECT * FROM admission a, patientprofile p WHERE a.patientidno = p.patientidno AND a.caseno='$caseno'");
$ptDetails = array();
if ($queryPtProfile->rowCount() > 0) {
    $ptDetails = $queryPtProfile->fetch(PDO::FETCH_ASSOC);
    $refphycode = $ptDetails['ap']; 
} else {
    $ptDetails = array();
}

$queryRefPhysician = $pdo->query("SELECT * FROM nsauthdoctors WHERE empid ='$refphycode'");
if($queryRefPhysician->rowCount() > 0){
    $fthref = $queryRefPhysician->fetch(PDO::FETCH_ASSOC);
    $refphysician = $fthref['name'];
}else{
    $refphysician = "REFERRAL";
}

$queryProductout = $pdo->query("SELECT * from productout where refno='$refno' and caseno='$caseno'");
$productDetails = array();
while ($pffetch = $queryProductout->fetch(PDO::FETCH_ASSOC)) {
    $productDetails[] = array(
        'productdesc' => $pffetch['productdesc'],
        'productcode' => $pffetch['productcode'],
        'prodsubtype' => $pffetch['productsubtype'],
        'approvalno' => $pffetch['approvalno'],
        'trantype' => $pffetch['trantype'],
        'lguser' => $user
    );
}

$response = array(
    'ptDetails' => $ptDetails,
    'productDetails' => $productDetails,
    'refphysician' => $refphysician
);

echo json_encode($response);
?>
