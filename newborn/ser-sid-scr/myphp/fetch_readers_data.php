<?php
include("../../meshes/alink.php");
ini_set("display_errors", "on");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");
$queryFeth = $pdo->query("SELECT * FROM `nsauthdoctors` WHERE `station`='NEWBORNDOCTORS' ORDER BY `name`");
if ($queryFeth->rowCount() > 0) {
    $data = array();
    $data[] = array(
        'id' => 'All',
        'name' => 'ALL*'
    );
    while ($row = $queryFeth->fetch(PDO::FETCH_ASSOC)) {
        $data[] = array(
            'id' => $row['empid'],
            'name' => $row['name']
        );
    }
    echo json_encode($data);
} else {
    echo json_encode(array());
}
?>