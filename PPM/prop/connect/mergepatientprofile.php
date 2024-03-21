<?php
session_start();
include 'link.php';
ini_set('display_errors', 'off');
$loginuser = $_POST['loginuser'];
$datearray = date('Y-m-d');
$timearray = date('H:i:s');
$orgid = $_POST['orgid'];
$tmgid = $_POST['tmgid'];
$insertion = true;
$trans = "Merge patientidno [".$tmgid."] to patientidno [".$orgid."]";

$fetchPatientProfile = $conn->query("SELECT * FROM patientprofile WHERE `patientidno` = '$tmgid'");
$count = $fetchPatientProfile->num_rows;

if ($count > 0) {
    while ($row = $fetchPatientProfile->fetch_assoc()) {
        $patientidno = $conn->real_escape_string($row['patientidno']);
        $lastname = $conn->real_escape_string($row['lastname']);
        $middlename = $conn->real_escape_string($row['middlename']);
        $firstname = $conn->real_escape_string($row['firstname']);
        $suffix = $conn->real_escape_string($row['suffix']);
        $birthdate = $conn->real_escape_string($row['birthdate']);
        $age = $conn->real_escape_string($row['age']);
        $sex = $conn->real_escape_string($row['sex']);
        $senior = $conn->real_escape_string($row['senior']);
        $patientname = $conn->real_escape_string($row['patientname']);
        $dateOfBirth = $conn->real_escape_string($row['dateofbirth']);
        $type = $conn->real_escape_string($row['type']);

        $insertQuery = $conn->query("INSERT INTO `patientprofilemerging` (`patientidno`, `lastname`, `firstname`, `middlename`, `suffix`, `birthdate`, `age`, `sex`, `senior`, `patientname`, `dateofbirth`, `type`, `merge_in`,`merged_by`)
        VALUES ('$patientidno','$lastname','$firstname','$middlename','$suffix','$birthdate','$age','$sex','$senior','$patientname','$dateOfBirth','$type','$orgid','$loginuser')");
        if(!$insertQuery){
            $insertion = false;
        }
    }
}

$updateQuery = $conn->query("UPDATE `admission` SET `patientidno` = '$orgid', `branch` = '$tmgid'  WHERE `patientidno` = '$tmgid'");
$deleteQuery = $conn->query("DELETE FROM `patientprofile` WHERE patientidno = '$tmgid'");

if($insertion){
    echo "success";
    $insertlogs = $conn->query("INSERT INTO userlogs(`transaction`,`loginuser`,`datearray`,`timearray`)VALUES('$trans','$loginuser','$datearray','$timearray')");
}else{
    echo "failed";
}

$conn->close()
?>
