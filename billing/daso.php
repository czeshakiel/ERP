<?php
$lb="Daily Summary Collection Report";

if(isset($_GET['startdate'])){$startdate=mysqli_real_escape_string($conn,$_GET['startdate']);}
else{$startdate=date("Y-m-d");}

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
                            <td><div style='padding: 0 3px 0 3px;'><input type='date' name='startdate' value='$startdate' style='height: 30px;border-radius: 3px;padding: 3px;' required /></div></td>
                            <td><div style='padding: 0 3px 0 3px;'><button type='submit' class='btn btn-primary btn-sm' style='width: 100px;' title='Submit'><i class='icofont-ui-next'></i></button></div></td>
                          </tr>
                        </table>
                        <input type='hidden' name='dadm' />
                      </form>
                    </div></td>
                  </tr>

";

if(!isset($_GET['startdates'])){
echo "
                  <tr>
                    <td height='550'></td>
                  </tr>
";
}
else{
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
                                      <td align='center' widtd='auto'><label style='font-size:18px;font-family: Times New Roman;font-weight: bold;'>$heading</label><p>$address</p><br><label style='font-size: 24px;font-family: Times New Roman;font-weight: bold;'>ADMISSION LIST</label><br>For ".date('M d, Y',strtotime($startdate))."</td>
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
                                  <table class='table table-bordered' style='font-size:8px;'>
                                    <tr>
                                      <td align='center'>ADMISSION DATE</td>
                                      <td align='center'>NAME OF PATIENT</td>
                                      <td align='center'>DATE OF BIRTH</td>
                                      <td align='center'>CONTACT NO.</td>
                                      <td align='center'>ROOM</td>
                                      <td align='center'>STATUS</td>
                                    </tr>

";

$sql="SELECT a.*,pp.* FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE a.dateadmit='$startdate' AND a.caseno LIKE '%I-%' AND a.ward NOT LIKE '%CANCELLED%'";
$SQLpatient=mysqli_query($conn,$sql);
$x=1;
if(mysqli_num_rows($SQLpatient)>0){
  while($patient=mysqli_fetch_array($SQLpatient)){
    if($patient['status'] == 'Active' || $patient['status'] == 'MGH' || $patient['status'] == 'WARNING' || $patient['status'] == 'LOCKED'){
      $disposition="";
    }
    else{
      $disposition=$patient['status'];
    }

    $sqlDischarge=mysqli_query($conn,"SELECT * FROM dischargedtable WHERE caseno='$patient[caseno]'");

    if(mysqli_num_rows($sqlDischarge)>0){
      $disposition="Discharged";
      $discharge=mysqli_fetch_array($sqlDischarge);
      $dischargedate=date('Y-m-d',strtotime($discharge['datedischarged']));
      $dischargetime=date('h:i A',strtotime($discharge['timeadmitted']));
      $lengthofstay=date_diff(new DateTime($rundate),new DateTime($dischargedate));
    }
    else{
      $disposition="";
      $dischargedate="";
      $dischargetime="";
      $lengthofstay="";
    }

    $case=explode('-',$patient['caseno']);
    $mem=explode('-',$patient['membership']);

    if($mem[0]=='phic'){$member="P";}
    else{$member="NP";}


    $sqlDept=mysqli_query($conn,"SELECT * FROM docfile WHERE `name`='$patient[ap]'");
    $department=mysqli_fetch_array($sqlDept);
    $sqlCase=mysqli_query($conn,"SELECT * FROM finalcaserate WHERE caseno='$patient[caseno]'");
    if(mysqli_num_rows($sqlCase)>0){
      while($case1=mysqli_fetch_array($sqlCase)){
        $cases .=$case1['icdcode']." ".$case1['description']."<br>";
      }
    }
    else{
      $cases="";
    }

    $rm=$patient['room'];

echo "
                                    <tr>
                                      <td align='center'>$patient[dateadmit] ".date('h:i A',strtotime($patient['timeadmitted']))."</td>
                                      <td align='left'>$patient[patientname]</td>
                                      <td align='center'>$patient[birthdate]</td>
                                      <td align='center'>$patient[patientcontactno]</td>
                                      <td align='center'>$rm</td>
                                      <td align='center'>$patient[identity]</td>
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
