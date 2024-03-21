<?php
  include 'db-connect.php';
  error_reporting(0);
  
      if (isset($_POST['submit'])) {
      $assignname = $_POST['assignname'];
      list($code, $lname, $fname, $mname) = explode('|', $assignname);
    
      $docspec = $_POST['docspec'];
      $sched_station = $_POST['sched_station'];
      list($station_id, $station_name) = explode('|', $sched_station);
      $station_sname = mb_strtoupper($station_name);
    
      $assgn_start_date = $_POST['assgn_start_date'];
      $startTime = $_POST['startSetTime'];
      $endTime = $_POST['endSetTime'];
    
      $errorEmpty = false;
      $stationEmpty = false;
      $duplicateName = false;
      $duplicateEr = false;
      $confirmSuccess = false;
      $trans = "INSERT";
      
      if (empty($assignname) || empty($sched_station)) {
        echo "<div class='alert alert-danger' role='alert'>Name and Station required!</div>";
        $errorEmpty = true;
      } elseif (empty($sched_station)) {
        echo "<div class='alert alert-danger' role='alert'>Please select station.</div>";
        $stationEmpty = true;
      } else {
        $sqli = $conn->query("SELECT `station_name` FROM `doclogfile_rod` WHERE `code` = '$code' AND `start_datetime` = '$assgn_start_date'");
        $countrowi = mysqli_num_rows($sqli);
        if ($station_id == 1) {
          $sql = $conn->query("SELECT `lastname`,`station_id`, `station_name` FROM `doclogfile_rod` WHERE `station_id` = '$station_id' AND `start_datetime` = '$assgn_start_date'");
          $countEr = mysqli_num_rows($sql);
          if ($countEr >= 1) {
            $row = $sql->fetch_assoc();
            $fetchname = $row['lastname'];
            $fetchEr = mb_strtoupper($row['station_name']);
            echo "<div class='alert alert-danger' role='alert'><b>".$fetchEr."</b> station has already been assigned to <span class='emphasized'><b>'" . $fetchname . "'</b></pan>.</div>";
            $duplicateEr = true;
          } else {
            $query = " INSERT INTO `doclogfile_rod`(`code`, `lastname`, `firstname`, `middlename`, `specialization`, `start_datetime`, `end_datetime`, `station_id`, `station_name`, `start_time`, `end_time`)
                  VALUES ('$code', '$lname', '$fname', '$mname', '$docspec', '$assgn_start_date', '$assgn_start_date', '$station_id', '$station_sname', '$startTime','$endTime')";
            $result = mysqli_query($conn, $query);
            if ($result) {
              $confirmSuccess = true;
            } else {
              echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
          }
       } else {
          $query = " INSERT INTO `doclogfile_rod`(`code`, `lastname`, `firstname`, `middlename`, `specialization`, `start_datetime`, `end_datetime`, `station_id`, `station_name`, `start_time`, `end_time`)
                VALUES ('$code', '$lname', '$fname', '$mname', '$docspec', '$assgn_start_date', '$assgn_start_date', '$station_id', '$station_sname', '$startTime','$endTime')";
          $result = mysqli_query($conn, $query);
          if ($result) {
            $confirmSuccess = true;
            $fortrans = $conn->query("INSERT INTO doclogfile_rodtrans (`name`, `trans`, `date`) VALUES('$code',' $trans','$assgn_start_date')");
          } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
          }
        }
      }
      mysqli_close($conn);
    }
    ?>
    <script>
      var errorEmpty = "<?php echo $errorEmpty; ?>";
      var stationEmpty = "<?php echo $stationEmpty; ?>";
      var duplicateEr = "<?php echo $duplicateEr; ?>";
      var maxSchedule = "<?php echo $maxSchedule;?>";
      var confirmSuccess = <?php echo $confirmSuccess;?>
    
      $("#assignname, #sched_station").removeClass("input-error");
    
      if(errorEmpty == true){
        $("#assignname, #sched_station").addClass("input-error");
      }
      if(stationEmpty == true){
        $("#sched_station").addClass("input-error");
      }
      if(duplicateEr == true){
        $("#sched_station").addClass("input-error");
      }
      if(errorEmpty == false && stationEmpty == false && duplicateEr == false){
        $("#assignname, #sched_station").val("");
      }
      if( confirmSuccess == true){
        $('#successfullModal').modal('show');
        $('#event_entry_modal').modal("hide");
        $('#successfullBtn').click(function(){
          $('#successfullModal').modal('hide');
          location.reload();
        });
      }
    </script>
