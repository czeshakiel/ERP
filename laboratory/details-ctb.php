<?php
          $irefno=mysqli_real_escape_string($conn,$_POST['refno']);
          $ipdesc=mysqli_real_escape_string($conn,$_POST['productdesc']);

          $kstsql=mysqli_query($conn,"SELECT * FROM `productout` WHERE `refno`='$irefno' AND `caseno`='$caseno'");
          $kstfetch=mysqli_fetch_array($kstsql);
          $kst=$kstfetch['terminalname'];

          if(($adstatus=="Active")||($adstatus=="LOCKED")||($adstatus=="YELLOW TAG")){
            if($kst=="Testtobedone"){
              mysqli_query($conn,"UPDATE `productout` SET `terminalname`='pending' WHERE `refno`='$irefno' AND `caseno`='$caseno'");
              mysqli_query($conn,"UPDATE `labpending` SET `resultstatus`='pending' WHERE `refno`='$irefno' AND `caseno`='$caseno'");

              $uplogs="|LabUpdate|$patientname|Change status of $ipdesc to Pending.|$caseno|$irefno|";
              mysqli_query($conn,"INSERT INTO `userlogs` (`loginuser`, `transaction`, `timearray`, `datearray`) VALUES ('".base64_decode($_SESSION['nm'])."','$uplogs','".date("H:i:s")."', '".date("Y-m-d")."')");

echo "
              <div class='card-body'>
                <div align='left' class='text-warning'><h4><i class='icofont-hand-thunder'></i> Set back to pending.</h4></div>
              </div>
";

              echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=../laboratory/?details$mh&caseno=$caseno'>";
            }
            else{
              if($kst=="pending"){
echo "
              <div class='card-body'>
                <div align='left' class='text-danger'><h4><i class='icofont-warning'></i> Error!!! Action blocked!!!Test status already set to pending.</h4></div>
              </div>
";

                echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=../laboratory/?details$mh&caseno=$caseno'>";
              }
              else if($kst=="Testdone"){
echo "
              <div class='card-body'>
                <div align='left' class='text-danger'><h4><i class='icofont-warning'></i> Error!!! Action blocked!!! Test already Test Done!</h4></div>
              </div>
";

                echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=../laboratory/?details$mh&caseno=$caseno'>";
              }
              else if($kst=="CANCELLED"){
echo "
              <div class='card-body'>
                <div align='left' class='text-danger'><h4><i class='icofont-warning'></i> Error!!! Action blocked!!! Test already cancelled/deleted.</h4></div>
              </div>
";

                echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=../laboratory/?details$mh&caseno=$caseno'>";
              }
              else{
echo "
              <div class='card-body'>
                <div align='left' class='text-danger'><h4><i class='icofont-warning'></i> Error!!! Action blocked!!! Unknown cause.</h4></div>
              </div>
";

                echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=../laboratory/?details$mh&caseno=$caseno'>";
              }
            }
          }
          else{
echo "
              <div class='card-body'>
                <div align='left' class='text-danger'><h4><i class='icofont-warning'></i> Error!!! Action blocked!!! Patient is not Active or already set to MGH or has been Discharged.</h4></div>
              </div>
";

            echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=../laboratory/?details$mh&caseno=$caseno'>";
          }
?>
