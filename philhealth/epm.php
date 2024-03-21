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
$lb="Patient Details";

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
                    <td><div align='left'><h5 class='fw-bold'><i class='icofont-pixels me-2'></i> Edit PHIC Membership</h5></div></td>
                  </tr>
                </table>
              </div>
              <div class='card-body' align='left'>
";

//---------------------------------------------------------------------------------------------------------------------------------------------------

if(!isset($_POST['upmemgo'])){
echo "
                <table border='0' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td width='10'></td>
                    <td><div style='border: 2px solid #000000;border-radius: 10px;padding: 5px 5px 5px 5px;'>
";

if($membership=="phic-med"){$mms1="selected";$mms2="";}else{$mms1="";$mms2="selected";}

echo "
                      <form method='post'>
                        <table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td><div style='font-family: arial;font-weight: bold;font-size: 16px;color: #089AD1;padding: 0 0 0 3px;'>PHIC Membership</div></td>
                            <td><div style='padding: 0 3px 0 3px;'>
                              <select name='membership' style='height: 30px;border-radius: 3px;padding: 0 3px;' autofocus required>
                                <option value='phic-med' $mms1>PhilHealth Member/Beneficiary<option>
                                <option value='Nonmed-none' $mms2>Non-PhilHealth Memeber/Beneficiary<option>
                              </select>
                            </div></td>
                            <td><div style='padding: 0 3px 0 3px;'><button type='submit' name='upmemgo' class='btn btn-primary btn-sm' style='width: 100px;' title='Submit'><i class='icofont-save'></i></button></div></td>
                          </tr>
                        </table>
                        <input type='hidden' name='caseno' value='$caseno' />
                        <input type='hidden' name='oldmembership' value='$membership' />
                        <input type='hidden' name='spn' value='$patientname' />
                      </form>
";

echo "
                    </div></td>
                  </tr>
                </table>
";
}
else{
  $caseno=mysqli_real_escape_string($conn,$_POST['caseno']);
  $newmembership=mysqli_real_escape_string($conn,$_POST['membership']);
  $oldmembership=mysqli_real_escape_string($conn,$_POST['oldmembership']);
  $spn=mysqli_real_escape_string($conn,$_POST['spn']);

  mysqli_query($conn,"UPDATE `admission` SET `membership`='$newmembership' WHERE `caseno`='$caseno'");
  mysqli_query($conn,"INSERT INTO `userlogs` (`loginuser`, `transaction`, `timearray`, `datearray`) VALUES ('".base64_decode($_SESSION['nm'])."','|$spn|Change PhilHealth Membership to $newmembership from $oldmembership.|$caseno|','".date("H:i:s")."', '".date("Y-m-d")."')");

echo "
                <div style='font-family: arial;font-weight: bold;font-size: 16px;color: #089AD1;padding: 0 0 0 3px;'>PhilHealth Membership Updated</div>
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
