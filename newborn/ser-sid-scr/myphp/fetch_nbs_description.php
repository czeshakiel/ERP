<?php
include("../../meshes/alink.php");
ini_set("display_errors", "on");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");
$queryFeth = $pdo->query("SELECT * FROM receiving WHERE (`description` LIKE '%NEWBORN SCREENING%' OR `description` LIKE '%NEWBORN HEARING%') AND unit = 'LABORATORY' AND prodtype = 'LABORATORY'");
if ($queryFeth->rowCount() > 0) {
    $data = array();
    while ($row = $queryFeth->fetch(PDO::FETCH_ASSOC)) {
        $string =  $row['description'];
        $pattern = '/ams-(.*?)-sup/';
        if (preg_match($pattern, $string, $matches)) {
            $extractedString = $matches[1];
            $descript = $extractedString;
        }else{
            $descript = $string;
        }

        $data[] = array(
            'code' => $row['code'],
            'desc' => $descript
        );
    }
    echo json_encode($data);
} else {
    echo json_encode(array());
}
?>