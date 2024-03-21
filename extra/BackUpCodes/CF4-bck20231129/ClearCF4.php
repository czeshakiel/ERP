<link href="res/ico/favicon.png" rel="shortcut icon" type="image/x-icon" />
<link href="res/css/normalize.css" rel="stylesheet" type="text/css" />
<link href="res/css/omis.css" rel="stylesheet" type="text/css" />
<link href="res/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="res/css/styles.css" rel="stylesheet" type="text/css" />
<link href="res/css/jquery-ui-1.11.4.css" rel="stylesheet">
<?php
$bck=mysqli_real_escape_string($conn,$_GET['bck']);

if(isset($_POST['confclear'])){
  mysqli_query($conncf4,"DELETE FROM `advice` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `advicesoap` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `bloodtype` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `caseno` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `cbc` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `chestxray` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `courseward` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `coursewards` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `diagnostic` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `diagnosticsoap` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `ecg` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `enlistment` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `enlistments` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `epcb` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `famhist` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `fbs` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `fecalysis` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `fhspecific` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `icds` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `immunization` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `labresult` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `labresults` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `lipidprof` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `management` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `managementsoap` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `medhist` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `medicine` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `medicines` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `menshist` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `mhspecific` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `ncdqans` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `ogtt` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `oinfo` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `papssmear` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `pegensurvey` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `pemisc` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `pemiscsoap` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `pepert` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `pepertsoap` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `pespecific` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `pespecificsoap` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `preghist` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `profile` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `profiling` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `soap` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `soaps` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `sochist` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `sputum` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `subjective` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `surghist` WHERE caseno='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `urinalysis` WHERE `caseno`='$caseno'");
  mysqli_query($conncf4,"DELETE FROM `xmlresults` WHERE `caseno`='$caseno'");

  mysqli_query($conn,"INSERT INTO `userlogs` (`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('Clear CF4 Data for $patientname $caseno', '".base64_decode($snm)."', '".date("Y-m-d")."', '".date("H:i:s")."')");

echo "
  <span class='arial14bluebold'>CF4 Data Cleared!</span>
";

  echo "<META HTTP-EQUIV='Refresh'CONTENT='2;URL=?cf4p1&caseno=$caseno'>";
}
else{
echo "
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='left' class='arial14redbold'>Are you really sure you want to <span style='color: #000000;'>&quot;Clear the CF4 Data&quot;</span>?</div></td>
    </tr>
    <tr>
      <td><div align='left'>
        <table border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <td><a href='?cf4".$bck."&caseno=$caseno'><input type='button' class='btn btn-success btn-sm' value='No?' title='Back' style='color: #FFFFFF;font-weight: bold;margin: 10px 0px 0px 0px;width: 100px;' /></a></td>
            <td width='5'></td>
            <td>
              <form method='post'";?> onclick="return confirm('Are you really really sure you want to Clear the CF4 data?');" <?php echo ">
                <input type='submit' name='confclear' class='btn btn-danger btn-sm' value='Yes?' title='Continue' style='color: #FFFFFF;font-weight: bold;margin: 10px 0px 0px 0px;width: 100px;' />
              </form>
            </td>
          </tr>
        </table>
      </div></td>
    </tr>
  </table>
";
}
?>
