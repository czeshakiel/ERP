<?php
include '../../meshes/alink.php';
ini_set('display_errors', 'on');

$retrvYear = $_POST['retrvYear'];

$retrvDetails = array();
$queryFetch = $pdo->query("SELECT * FROM `nbs_report_details` WHERE `year` = '$retrvYear'");
while ($res = $queryFetch->fetch(PDO::FETCH_ASSOC)) {
    $month = strtolower($res['month']); // Convert to lowercase
    $retrvDetails[$month] = array(
        'ttl_delv' => $res['ttl_of_deliveries'],
        'ttl_neod' => $res['ttl_of_neodths'],
        'ttl_lvb' => $res['ttl_of_livebirths'],
        'ttl_stbr' => $res['ttl_of_stillbirths'],
        'ttl_inbs' => $res['ttl_of_inbornscn'],
        'ttl_onbs' => $res['ttl_of_outbornscn'],
        'ttl_refu' => $res['ttl_of_refusal'],
        'ttl_tran' => $res['ttl_of_transferred'],
        'reason_refu' => $res['reason_for_refu']
    );
}
echo json_encode($retrvDetails);
?>