<?php
include("../../meshes/alink.php");
ini_set("display_errors","on");
$searchTerm = $_GET['q'];
$queryReader = $pdo->query("SELECT `name`,`empid` FROM `nsauthdoctors` WHERE `station`= 'NEWBORNDOCTORS' AND `name` LIKE '%$searchTerm%' ORDER BY `name`");
$rd_results = [];
if ($queryReader ->rowCount() > 0) {
    while ($rwi = $queryReader->fetch(PDO::FETCH_ASSOC)) {
        $rd_result = [
            'id' => $rwi['empid'],
            'text' => $rwi['name']
        ];
        $rd_results[] = $rd_result;
    }
} else {
    $rd_results[] = [
        'id' => '',
        'text' => 'No data found.'
    ];
}

$rd_results[] = [
    'id' => '023145',
    'text' => 'REFERRAL'
];

echo json_encode($rd_results);
?>