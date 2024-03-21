<?php
      $irefno=mysqli_real_escape_string($conn,$_POST['refno']);
      $ipdesc=mysqli_real_escape_string($conn,$_POST['productdesc']);

      mysqli_query($conn,"UPDATE `productout` SET `terminalname`='pending' WHERE `refno`='$irefno' AND `caseno`='$caseno'");
      mysqli_query($conn,"UPDATE `labpending` SET `resultstatus`='pending' WHERE `refno`='$irefno' AND `caseno`='$caseno'");

      $uplogs="|LabUpdate|$patientname|Cancel refund for $ipdesc.|$caseno|$irefno|";
      mysqli_query($conn,"INSERT INTO `userlogs` (`loginuser`, `transaction`, `timearray`, `datearray`) VALUES ('".base64_decode($_SESSION['nm'])."','$uplogs','".date("H:i:s")."', '".date("Y-m-d")."')");

echo "
            <div class='card-body'>
              <div align='left' class='text-warning'><h4><i class='icofont-spinner-alt-5'></i> Cancel Request Refund Done</h4></div>
            </div>
";

      echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=../laboratory/?details$mh&caseno=$caseno'>";
?>
