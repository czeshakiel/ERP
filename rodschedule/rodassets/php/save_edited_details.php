<?php
  include 'db-connect.php';
  //error_reporting(0);
  
if (isset($_POST['eId'])) {
    $eId = $_POST['eId'];
    $ename = $_POST['eName'];
    list($code, $lname, $fname, $mname) = explode('|', $ename);

    $espec = $_POST['eSpec'];
    $estation = $_POST['eStation'];
    list($estationId, $estationName) = explode('|', $estation);
    $estationsname = mb_strtoupper($estationName);

    $estartdate = $_POST['eStartDate'];
    $estarttime = $_POST['eStartTime'];
    $eendtime = $_POST['eEndTime'];

    $duplicateEr = false;
    $confirmSuccess = false;
    $trans = "UPDATE";
   
    $sqli = $conn->query("SELECT `station_name` FROM `doclogfile_rod` WHERE `code` = '$code' AND `start_datetime` = '$estartdate'");
    $countrowi = mysqli_num_rows($sqli);
    if ($estationId == 1) {
          $sql = $conn->query("SELECT `lastname`,`station_id`, `station_name` FROM `doclogfile_rod` WHERE `station_id` = '$estationId' AND `start_datetime` = '$estartdate'");
          $countEr = mysqli_num_rows($sql);
          if ($countEr >= 1) {
            $row = $sql->fetch_assoc();
            $fetchname = $row['lastname'];
            $fetchEr = mb_strtoupper($row['station_name']);
            echo "<div class='alert alert-danger' role='alert'><b>".$fetchEr."</b> station has already been assigned to <span class='emphasized'><b>'" . $fetchname . "'</b></pan>.</div>";
            $duplicateEr = true;
          } else {
            $query = "UPDATE `doclogfile_rod` SET `code`='$code',`lastname`='$lname',`firstname`='$fname',`middlename`='$mname',`specialization`='$espec',`start_datetime`='$estartdate',`end_datetime`='$estartdate',`station_id`='$estationId',`station_name`='$estationsname',`start_time`='$estarttime',`end_time`='$eendtime' WHERE `id`='$eId'";
            $result = mysqli_query($conn, $query);
            if ($result) {
              $confirmSuccess = true;
              $fortrans = $conn->query("INSERT INTO doclogfile_rodtrans (`name`, `trans`, `date`) VALUES('$code',' $trans','$estartdate')");
              echo 201;
            } else {
              echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        }
    } else {
          $query = "UPDATE `doclogfile_rod` SET `code`='$code',`lastname`='$lname',`firstname`='$fname',`middlename`='$mname',`specialization`='$espec',`start_datetime`='$estartdate',`end_datetime`='$estartdate',`station_id`='$estationId',`station_name`='$estationsname',`start_time`='$estarttime',`end_time`='$eendtime' WHERE `id`='$eId'";
          $result = mysqli_query($conn, $query);
          if ($result) {
            $confirmSuccess = true;
            $fortrans = $conn->query("INSERT INTO doclogfile_rodtrans (`name`, `trans`, `date`) VALUES('$code',' $trans','$estartdate')");
            echo 201;
          } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
          }
    }
      mysqli_close($conn);
}
    ?>
<script>
  var duplicateEr = "<?php echo $duplicateEr; ?>";
  var confirmSuccess = <?php echo $confirmSuccess;?>

  $("#editStation").removeClass("input-error");

  if (duplicateEr == true) {
    $("#editStation").addClass("input-error");
  }
  if (confirmSuccess == true) {
    $('#editDetailsModal').modal("hide");
    $('#successEditModal').modal('show');

    $('#successEditBtn').click(function() {
        $('#successEditModal').modal('hide');
        $("#scheduleDetails").modal('hide');
        location.reload();
    });
}

</script>

