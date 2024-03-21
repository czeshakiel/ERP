<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['selectedRequestType'])) {
        $_SESSION['selectedRequestType'] = $_POST['selectedRequestType'];
        echo "Session variable set successfully.";
    } else {
        echo "Error: selectedRequestType not provided in POST data.";
    }
} else {
    echo "Error: Invalid request method.";
}
?>
