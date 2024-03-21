<?php
include '../../meshes/alink.php';
ini_set("display_errors", "on");

$startDate = new DateTime(date("Y-m-d", strtotime("first day of January this year")));
$endDate = new DateTime(date("Y-m-d", strtotime("last day of December this year")));
$datefrom = $startDate->format("Y-m-d");
$dateto = $endDate->format("Y-m-d");

$queryTotalCounts = $pdo->prepare("SELECT COUNT(*) AS total_count,
    SUM(CASE WHEN UPPER(pp.sex) = 'F' OR UPPER(pp.sex) = 'FEMALE' THEN 1 ELSE 0 END) AS girl_count,
    SUM(CASE WHEN UPPER(pp.sex) = 'M' OR UPPER(pp.sex) = 'MALE' THEN 1 ELSE 0 END) AS boy_count
    FROM admission a
    JOIN patientprofile pp ON a.patientidno = pp.patientidno
    WHERE a.stat1 = 'New Born' AND a.dateadmit BETWEEN :datefrom AND :dateto");
$queryTotalCounts->bindParam(':datefrom', $datefrom, PDO::PARAM_STR);
$queryTotalCounts->bindParam(':dateto', $dateto, PDO::PARAM_STR);
$queryTotalCounts->execute();

if ($queryTotalCounts) {
    $row = $queryTotalCounts->fetch(PDO::FETCH_ASSOC);
    $totalCount = $row['total_count'];
    $boyCount = $row['boy_count'];
    $girlCount = $row['girl_count'];
    
    echo json_encode(['total_count' => $totalCount, 'boy_count' => $boyCount, 'girl_count' => $girlCount]);
} else {
    echo json_encode(['error' => 'Query execution failed']);
}
?>