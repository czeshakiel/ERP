<?php
include 'link.php';
ini_set('display_errors','on');

$ptidno = $_POST['ptidno'];
$lsname = $_POST['lsname'];
$fsname = $_POST['fsname'];
$mdname = $_POST['mdname'];
$dofbirth = $_POST['dofbirth'];

$querySelect = "SELECT * FROM patientprofile WHERE `lastname`='$lsname' AND `firstname`='$fsname' AND `middlename`='$mdname' AND `dateofbirth` = '$dofbirth' AND `patientidno` !='$ptidno' ";
if (!$result = $conn->query($querySelect)) {
    exit(mysqli_error($conn));
}
$response = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
} else {
    $response['status'] = 200;
    $response['message'] = "Data not found!";
}
echo json_encode($response);


?>