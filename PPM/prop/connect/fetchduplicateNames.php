<?php
$dsn = 'mysql:host=localhost;dbname=kmsci';
$username = 'root';
$password = 'b0ykup4l';

try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}
$querySelect = "SELECT COUNT(*) AS duplicate_count
FROM (
    SELECT lastname, firstname, dateofbirth, COUNT(*) AS count_duplicates
    FROM patientprofile
    GROUP BY lastname, firstname, dateofbirth
    HAVING COUNT(*) > 1
) AS subquery;";
$result = $db->query($querySelect);
if ($result) {
    $data = $result->fetch(PDO::FETCH_ASSOC);
    $duplicateCount = $data['duplicate_count'];
    echo json_encode($duplicateCount);
} else {
    echo json_encode(array('error' => 'Query failed'));
}

$db = null;
?>
