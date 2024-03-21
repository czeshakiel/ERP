<?php
include("../../meshes/alink.php");
ini_set("display_errors", "on");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");
$queryFeth = $pdo->query("SELECT * FROM receiving WHERE `description` LIKE '%EXPANDED NEWBORN%' AND (unit LIKE '%MEDICINE%' OR unit LIKE '%SUPPLIES%') ORDER BY itemname");
if ($queryFeth->rowCount() > 0) {
    $data = array();
    while ($row = $queryFeth->fetch(PDO::FETCH_ASSOC)) {
        $data[] = array(
            'code' => $row['code'],
            'desc' => $row['description']." [".$row['generic']."]"
        );
    }
    echo json_encode($data);
} else {
    echo json_encode(array());
}
?>