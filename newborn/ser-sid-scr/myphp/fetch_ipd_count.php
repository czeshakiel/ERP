<?php
include("../../meshes/alink.php");
ini_set("display_errors","on");
$queryFetch = $pdo->query("SELECT COUNT(p.caseno) AS ipdcount 
    FROM productout p, admission a 
    WHERE a.caseno = p.caseno 
    AND (p.productdesc LIKE '%NEWBORN SCREENING%' OR p.productdesc LIKE '%NEWBORN HEARING%' OR p.productdesc LIKE '%AUDIOMETRY%') 
    AND p.productsubtype NOT LIKE '%MISCELLANEOUS%' 
    AND a.ward = 'in'
    AND p.terminalname != 'Testtobedone' 
    AND p.terminalname != 'Testdone'
    AND p.status != 'CANCELLED' AND a.dateadmit = CURDATE()");

$queryIpdPatient = $pdo->query("SELECT COUNT(caseno) AS total_IpdCount 
    FROM admission 
    WHERE stat1 = 'New Born' 
        AND ward = 'in' 
        AND ward NOT IN ('CANCELLED', 'discharged')");
$fCount = $queryIpdPatient->fetch(PDO::FETCH_ASSOC);
$totalIpdPatientCount = $fCount['total_IpdCount'];

if ($queryFetch) {
    $result = $queryFetch->fetch(PDO::FETCH_ASSOC);
    $ipdCount = $result['ipdcount'];
    echo json_encode(['ipdCount' => $ipdCount, 'totalIpdCount' => $totalIpdPatientCount]);
} else {
    echo json_encode(['error' => 'Query execution failed']);
}
?>