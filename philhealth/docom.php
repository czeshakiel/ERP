<style>
@keyframes animate {
  0% {opacity: 0;}
  50% {opacity: 0.7;}
  100% {opacity: 0;}
}

.blinkforme {
  -webkit-animation: blinker 1s infinite;  /* Safari 4+ */
  -moz-animation: blinker 1s infinite;  /* Fx 5+ */
  -o-animation: blinker 1s infinite;  /* Opera 12+ */
  animation: blinker 1s infinite;  /* IE 10+, Fx 29+ */
}

@-webkit-keyframes blinker {
  0%, 49% {
    background-color: #FFFFFF;
    color: #FF0000;
    height: 100%;
  }
  50%, 100% {
    background-color: #FF0000;
    color: #FFFFFF;
    height: 100%;
  }
}
</style>

<?php
ini_set("display_errors","On");

$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);

echo "
    <!-- Body: Body -->
    <div class='body d-flex py-lg-3 py-md-2'>
      <div class='container-xxl'>
";

include("profile.php");

echo "
        <div class='row clearfix g-3'>
          <div class='col-sm-12'>
            <div class='card mb-3'>
              <div class='card-header'>
                <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td><div align='left'><h5 class='fw-bold'><i class='icofont-file-document me-2'></i> Document Complied</h5></div></td>
                  </tr>
                </table>
              </div>
              <div class='card-body' align='left'>
";

//---------------------------------------------------------------------------------------------------------------------------------------------------
if(!isset($_POST['proceeddocom'])){
  $kaxsql=mysqli_query($conn,"SELECT `identity` FROM `admission` WHERE `caseno`='$caseno'");
  $kaxfetch=mysqli_fetch_array($kaxsql);
  $kaxdocom=$kaxfetch['identity'];

  if($kaxdocom=="Complied"){
    $kaxlabel="Proceed to set patient's documents to not yet complied?";
    $docomact="";

  }
  else{
    $kaxlabel="Proceed to set patient's documents to fully complied?";
    $docomact="Complied";
  }

echo "
                <table border='0' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td width='10'></td>
                    <td><div style='border: 2px solid #000000;border-radius: 5px;padding: 10px 10px 10px 10px;'>
";

echo "
                      <form method='post'>
                        <table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td><div style='font-family: arial;font-weight: bold;font-size: 16px;color: #FF5733;padding: 0 0 10px 0;'>$kaxlabel</div></td>
                          </tr>
                          <tr>
                            <td><div align='left'>
                              <table border='0' cellpadding='0' cellspacing='0'>
                                <tr>
                                  <td><div style='padding: 0 3px 0 0;'><button type='button' class='btn btn-danger btn-sm' style='width: 100px;font-weight: bold;' title='Back'><i class='icofont-bubble-left'></i> Back</button></div></td>
                                  <td><div style='padding: 0 0 0 3px;'><button type='submit' name='proceeddocom' class='btn btn-primary btn-sm' style='width: 100px;font-weight: bold;' title='Proceed' ";?> onclick="return confirm('Press &quot;OK&quot; to proceed.');" <?php echo ">Proceed <i class='icofont-bubble-right'></i></button></div></td>
                                </tr>
                              </table>
                            </div></td>
                          </tr>
                        </table>
                        <input type='hidden' name='act' value='$docomact' />
                      </form>
";

echo "
                    </div></td>
                  </tr>
                </table>
";
}
else{
  $docomact=mysqli_real_escape_string($conn,$_POST['act']);

  if($docomact=="Complied"){
    $kaxlabel="Documents fully complied";

  }
  else{
    $kaxlabel="Documentso not yet complied";
  }

  mysqli_query($conn,"UPDATE `admission` SET `identity`='$docomact' WHERE `caseno`='$caseno'");
  mysqli_query($conn,"INSERT INTO `userlogs` (`loginuser`, `transaction`, `timearray`, `datearray`) VALUES ('".base64_decode($_SESSION['nm'])."','|$patientname|$kaxlabel.|$caseno|','".date("H:i:s")."', '".date("Y-m-d")."')");

echo "
                <div style='font-family: arial;font-weight: bold;font-size: 16px;color: #089AD1;padding: 0 0 0 3px;'>$kaxlabel...</div>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='1;URL=../philhealth/?details$mh&caseno=$caseno'>";
}

//---------------------------------------------------------------------------------------------------------------------------------------------------

echo "
              </div>
            </div>
          </div>
        </div><!-- Row End -->
      </div>
    </div>
";

//echo "<META HTTP-EQUIV='Refresh'CONTENT='1500;URL=Close.php'>";
?>
