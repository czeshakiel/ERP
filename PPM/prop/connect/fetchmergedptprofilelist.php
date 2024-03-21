<?php 
include 'link.php';
ini_set('display_errors', 'on');
$querySelect = $conn->query("SELECT * FROM patientprofilemerging");
$response = array();
if ($querySelect->num_rows > 0) {
    while ($row = $querySelect->fetch_assoc()) {
        $response[] = $row;
    }
} else {
    $response['status'] = 200;
    $response['message'] = "Data not found!";
}
echo json_encode($response);
?>