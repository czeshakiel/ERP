<?php
    try {
      include 'db-connect.php';
      $schedules = $conn->query("SELECT * FROM `doclogfile_rod`");
      $sched_res = [];
      foreach($schedules->fetch_all(MYSQLI_ASSOC) as $row){
        $sched_res[$row['id']] = $row;
      }
      echo json_encode($sched_res);
    } catch (Exception $e) {
      echo 'Caught exception: ',  $e->getMessage(), "\n";
    } finally {
      if(isset($conn)) $conn->close();
    }
    
?>