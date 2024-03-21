<?php 
include 'link.php';
ini_set('display_errors', 'on');

$ptid = $_POST['ptid'];
$querySelect = "SELECT p.lastname, p.firstname, p.middlename, ad.caseno, ad.dateadmit FROM patientprofile p 
               JOIN admission ad ON ad.patientidno = p.patientidno 
               WHERE p.patientidno = '$ptid'";
if (!$result = $conn->query($querySelect)) {
    exit(mysqli_error($conn));
}
$response = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response[] = $row; // Append each row to the $response array
    }
} else {
    $response['status'] = 200;
    $response['message'] = "Data not found!";
}
echo json_encode($response);
?>