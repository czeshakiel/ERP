<?php 
include 'db-connect.php';

// Fetch new added date of event
$sql = "SELECT `date` FROM `doclogfile_rodtrans` ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $newAddDate = $row["date"];
} else {
    $newAddDate = date("Y-m-d"); // default to today's date if no events found
}

// Close database connection
mysqli_close($conn);

// Return new added date to JavaScript
echo $newAddDate;
?>
<?php
// session_start();
// include 'db-connect.php';

// // Check if the user has been inactive for 1 hour or has logged out
// $inactive_time = 60 * 60; // 1 hour in seconds
// if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $inactive_time)) {
//     session_unset();
//     session_destroy();
//     $newAddDate = date("Y-m-d");
// } else {
//     $_SESSION['last_activity'] = time();

//     // Fetch new added date of event
//     $sql = "SELECT `date` FROM `doclogfile_rodtrans` ORDER BY `id` DESC LIMIT 1";
//     $result = mysqli_query($conn, $sql);

//     if (mysqli_num_rows($result) > 0) {
//         $row = mysqli_fetch_assoc($result);
//         $newAddDate = $row["date"];
//     } else {
//         $newAddDate = date("Y-m-d"); // default to today's date if no events found
//     }

//     // Close database connection
//     mysqli_close($conn);
// }

// // Return new added date to JavaScript
// echo $newAddDate;
?>
