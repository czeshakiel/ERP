<?php
include("../../meshes/alink.php");
ini_set("display_errors", "on");

$queryFetch = $pdo->query("SELECT SUM(ttl_qty) AS total_quantity
    FROM (
        SELECT SUM(quantity) AS ttl_qty
        FROM stocktable
        WHERE `description` LIKE '%EXPANDED NEWBORN%' AND `dept` ='NEW BORN SCREENING'
        GROUP BY rrno
        HAVING ttl_qty != 0
    ) AS subquery");

if ($queryFetch === false) {
    echo json_encode(['error' => 'Query execution failed']);
} else {
    $result = $queryFetch->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $kitCount = $result['total_quantity'];
        header('Content-Type: application/json');
        echo json_encode(['kit_count' => $kitCount]);
    } else {
        echo json_encode(['kit_count' => 0]);
    }
}
?>