<?php
include '../../meshes/alink.php';
ini_set('display_errors', 'on');

$slctd_year = $_POST['slctd_year'];

$monthDetails = array();
$queryFetch = $pdo->query("SELECT * FROM `nbs_report_details` WHERE `year` = '$slctd_year'");
while ($res = $queryFetch->fetch(PDO::FETCH_ASSOC)) {
    $month = strtolower($res['month']); // Convert to lowercase
    $monthDetails[$month] = array(
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
error_log('JSON Data: ' . json_encode($monthDetails));
echo json_encode($monthDetails);
?>