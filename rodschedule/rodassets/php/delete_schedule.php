<?php
include 'db-connect.php';

if (isset($_POST['del_id'])) {
  $id = mysqli_real_escape_string($conn, $_POST['del_id']);
  $tdate = mysqli_real_escape_string($conn, $_POST['tdate']);
  $tcode = mysqli_real_escape_string($conn, $_POST['tcode']);
  $trans = "DELETE";

  // Execute two SQL statements: delete the event and set the deleted_at column
  $sql = "DELETE FROM doclogfile_rod WHERE id = $id"; 
  //  UPDATE doclogfile_rod SET deleted_at = NOW() WHERE id = $id;";
  if (mysqli_multi_query($conn, $sql)) {
    echo 200;
    $fortrans = $conn->query("INSERT INTO doclogfile_rodtrans (`name`, `trans`, `date`) VALUES('$tcode',' $trans','$tdate')");
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}
?>
