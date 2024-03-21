<?php
include 'link.php';
ini_set('display_errors', 'off');

$searchTerm = $_GET['q'];
$querySelectlist = $conn->query("SELECT * FROM patientprofile WHERE CONCAT(lastname, ', ', firstname, ' ', middlename, '(', patientidno, ')') LIKE '%$searchTerm%' ORDER BY lastname ASC LIMIT 50");

$results = [];

if ($querySelectlist->num_rows > 0) {
    while ($rwi = $querySelectlist->fetch_assoc()) {
        $result = [
            'id' => $rwi['patientidno'],
            'text' => $rwi['lastname'] . ', ' . $rwi['firstname'] . ' ' . $rwi['middlename'] . '(' . $rwi['patientidno'] . ')'
        ];
        $results[] = $result;
    }
} else {
    $results[] = [
        'id' => '',
        'text' => 'No data found.'
    ];
}
echo json_encode($results);
?>
