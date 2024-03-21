<?php
$lb="Discharged Patients";

if((isset($_GET['startdate']))&&(isset($_GET['enddate']))&&(isset($_GET['type']))){
  $setstartdate=mysqli_real_escape_string($conn,$_GET['startdate']);
  $setenddate=mysqli_real_escape_string($conn,$_GET['enddate']);
  $settype=mysqli_real_escape_string($conn,$_GET['type']);
}
else{
  $setstartdate="";
  $setenddate="";
  $settype="";
}

if($settype=="I-"){$sts1="selected";$sts2="";}
else if($settype=="O-"){$sts1="";$sts2="selected";}
else {$sts1="";$sts2="";}

echo "
    <!-- Body: Body -->
    <div class='body d-flex py-lg-3 py-md-2'>
      <div class='container-xxl'>
        <div class='row align-items-center'>
          <div class='border-0 mb-4'>
            <div class='card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap'>
              <h3 class='fw-bold mb-0'>$lb</h3>
            </div>
          </div>
        </div> <!-- Row end  -->
        <div class='row clearfix g-3'>
          <div class='col-sm-12'>
            <div class='card mb-3'>
              <div class='card-body'>
                <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td><div align='left'>
                      <form method='get'>
                        <table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td><div style='font-family: arial;font-weight: bold;font-size: 16px;color: #089AD1;padding: 0 0 0 3px;'>Select Date</div></td>
                            <td><div style='padding: 0 3px 0 3px;'><input type='date' name='startdate' value='$setstartdate' style='height: 30px;border-radius: 3px;padding: 3px;' required /></div></td>
                            <td><div style='padding: 0 5px 0 5px;' align='center'>to</div></td>
                            <td><div style='padding: 0 3px 0 3px;'><input type='date' name='enddate' value='$setenddate' style='height: 30px;border-radius: 3px;padding: 3px;' required /></div></td>
                            <td><div style='padding: 0 3px 0 3px;'>
                              <select name='type' style='height: 30px;border-radius: 3px;padding: 0 3px;' required>
                                <option value=''>Type<option>
                                <option value='I-' $sts1>In-Patient<option>
                                <option value='O-' $sts2>Out-Patient<option>
                              </select>
                            </div></td>
                            <td><div style='padding: 0 3px 0 3px;'><button type='submit' name='showres' class='btn btn-primary btn-sm' style='width: 100px;' title='Submit'><i class='icofont-ui-next'></i></button></div></td>
                          </tr>
                        </table>
                        <input type='hidden' name='ddr' />
                      </form>
                    </div></td>
                  </tr>

";

if(!isset($_GET['showres'])){
echo "
                  <tr>
                    <td height='550'></td>
                  </tr>
";
}
else{
  $startdate=mysqli_real_escape_string($conn,$_GET['startdate']);
  $enddate=mysqli_real_escape_string($conn,$_GET['enddate']);
  $type=mysqli_real_escape_string($conn,$_GET['type']);

echo "
                  <tr>
                    <td height='30'></td>
                  </tr>
                  <tr>
                    <td><div align='center'>
                      <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td><div align='right'><button type='button' onclick=printDiv('printableArea') class='btn btn-success btn-sm' style='width: 100px;' title='Print'><i class='icofont-print'></i></button></div></td>
                        </tr>
                        <tr>
                          <td><div id='printableArea'>
                            <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td height='10'></td>
                              </tr>
                              <tr>
                                <td><div align='center'>
                                  <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                                    <tr>
                                      <td align='right' width='130'><div style='height: 100px;widtd: 100px;'><img src='../extra/Resources/Logo/logo.png' widtd='100' height='100' /></div></td>
                                      <td align='center' widtd='100%'><label style='font-size:18px;font-family: Times New Roman;font-weight: bold;'>$heading</label><p>$address</p><br><b>MONTHLY DISCHARGED REPORT</b></br>".date('F d, Y',strtotime($startdate))." To ".date('F d, Y',strtotime($enddate))."</label></td>
                                      <td width='130'></td>
                                    </tr>
                                  </table>
                                </div></td>
                              </tr>
                              <tr>
                                <td height='10'></td>
                              </tr>
                              <tr>
                                <td>
                                  <table class='table table-hover table-bordered' style='font-size:10px;'>
                                    <tr>
                                      <td align='center'>&nbsp;</td>
                                      <td align='center'>NAME OF PATIENT</td>
                                      <td align='center'>HRN</td>
                                      <td align='center'>&nbsp;</td>
                                      <td align='center'>Case #</td>
                                      <td align='center'>Admitted</td>
                                      <td align='center'>Discharged</td>
                                      <td align='center'>Department/Serv</td>
                                      <td align='center'>Sex</td>
                                      <td align='center'>Result</td>
                                      <td align='center'>Age</td>
                                      <td align='center'>Room #</td>
                                      <td align='center'>Length of Stay</td>
                                      <td align='center'>Status</td>
                                    </tr>
";

mysqli_query($conn,"SET NAMES 'utf8'");
$sql="SELECT a.*,pp.*,dt.* FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno INNER JOIN dischargedtable dt ON dt.caseno=a.caseno WHERE dt.datearray BETWEEN '$startdate' AND '$enddate' AND dt.caseno LIKE '%$type%' ORDER BY pp.lastname ASC";
$SQLpatient=mysqli_query($conn,$sql);
$x=1;
if(mysqli_num_rows($SQLpatient)>0){
  while($patient=mysqli_fetch_array($SQLpatient)){
    if($patient['membership']=="phic-med"){
      $member="P";
    }
    else{
      $member="NP";
    }

    $sqlDoc=mysqli_query($conn,"SELECT * FROM docfile WHERE `name` LIKE '%$patient[ap]%' OR `code`='$patient[ap]'");
    $d=mysqli_fetch_array($sqlDoc);
    $department=$d['specialization'];
    $caseno=str_replace('O-','',$patient['caseno']);
    $caseno=str_replace('I-','',$caseno);
    $lengthofstay=date_diff(new DateTime($patient['dateadmitted']),new DateTime($patient['datearray']));

    if($lengthofstay->d == 0){
      $length=1;
    }
    else{
      $length=$lengthofstay->d;
    }

    $sqlHRN=mysqli_query($conn,"SELECT hrn FROM hrn WHERE patientidno='$patient[patientidno]'");
    if(mysqli_num_rows($sqlHRN)>0){
      $hr=mysqli_fetch_array($sqlHRN);
      $hrn=$hr['hrn'];
    }
    else{
      $hrn="";
    }


echo "
                                    <tr>
                                      <td>$x.</td>
                                      <td align='left'>$patient[patientname]</td>
                                      <td align='center'>$hrn</td>
                                      <td align='center'>$member</td>
                                      <td align='center'>$caseno</td>
                                      <td align='center'>$patient[dateadmitted]</td>
                                      <td align='center'>$patient[datearray]</td>
                                      <td align='center'>$department</td>
                                      <td align='center'>$patient[sex]</td>
                                      <td align='center'>$patient[disposition]</td>
                                      <td align='center'>$patient[age] y</td>
                                      <td align='left'>$patient[room]</td>
                                      <td align='center'>$length</td>
                                      <td align='center'>$patient[statusphic] - ".date('m/d/Y',strtotime($patient['datepayment']))."</td>
                                    </tr>
";

    $x++;
  }
}

echo "
                                </table>
                                </td>
                              </tr>
                            </table>
                          </div></td>
                        </tr>
                    </div></td>
                  </tr>
";
}

echo "
                </table>
                <!-- Back to top button -->
              </div>
            </div>
          </div>
        </div><!-- Row End -->
      </div>
    </div>
";
?>

<script type="text/javascript">
  function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
  }
</script>
