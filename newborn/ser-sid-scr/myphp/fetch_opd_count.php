<?php
include("../../meshes/alink.php");
ini_set("display_errors","on");
$queryFetch = $pdo->query("SELECT COUNT(a.caseno) AS optcount FROM 
productout p JOIN 
admission a ON a.caseno = p.caseno
WHERE 
(
    p.productdesc LIKE '%NEWBORN HEARING%' 
    OR p.productdesc LIKE '%NEWBORN SCREENING%' 
    OR p.productdesc LIKE '%AUDIOMETRY%'
) 
AND p.productsubtype NOT LIKE '%MISCELLANEOUS' AND p.status != 'CANCELLED'
AND a.ward = 'out' AND p.terminalname != 'Testtobedone' AND p.terminalname != 'Testdone' AND p.datearray > (CURDATE() - INTERVAL 7 DAY)
GROUP BY 
p.refno 
ORDER BY 
p.datearray DESC, p.invno");

$queryOpdPatient = $pdo->query("SELECT COUNT(caseno) AS todayCount_Opd
    FROM admission
    WHERE stat1 = 'New Born'
      AND ward = 'out'
      AND ward NOT IN ('CANCELLED', 'discharged')
");

$fCount = $queryOpdPatient->fetch(PDO::FETCH_ASSOC);
$todayOpdPatientCount = $fCount['todayCount_Opd'];

if ($queryFetch) {
    $result = $queryFetch->fetch(PDO::FETCH_ASSOC);
    $opdCount = $result['optcount'];
    echo json_encode(['opdCount' => $opdCount, 'todOpdCount' => $todayOpdPatientCount]);
} else {
    echo json_encode(['error' => 'Query execution failed']);
}
?>