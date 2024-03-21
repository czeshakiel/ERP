<script src="jquery-1.9.1.min.js"></script>
<link href="toastr.css" rel="stylesheet"/>
<script type="text/javascript">
  function toast1() {
    toastr.success("Case number copied to clipboard.");
  }
  function toast2() {
    toastr.success("Reference number copied to clipboard.");
  }
</script>

<?php
$lb="Express Verify";


if(isset($_POST['dt'])){
  $dt=mysqli_real_escape_string($conn,$_POST['dt']);

  if($dt==""){
    $da=date("Y-m-d");
  }
  else{
    $da=$dt;
  }
}
else{
  $da=date("Y-m-d");
}

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
              <div class='card-header'>
                <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td width='50%'><div align='left'><h5 class='fw-bold'><i class='icofont-question-circle me-2'></i> UN-VERIFIED LIST</h5></div></td>
                    <td width='50%'><div align='right'>
                      <form method='post'>
                        <table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td><input type='date' name='dt' value='$da' style='border-radius: 5px;height: 35px;padding: 0 2px 0 2px;' /></td>
                            <td width='5'></td>
                            <td><button type='submit' class='btn btn-danger text-white' style='width: 150px;font-weight: bold;'><i class='icofont-ui-calendar'></i> Change Date</button></td>
                          </tr>
                        </table>
                      </form>
                    </div></td>
                  </tr>
                </table>
              </div>
              <div class='card-body'>
                <table id='myProjectTable' class='table table-hover align-middle mb-0' style='width:100%'>
                  <thead>
                    <tr>
                      <th><div align='center'>#</div></th>
                      <th><div align='center'>Patient Name</div></th>
                      <th><div align='center'>Patient Type</div></th>
                      <th><div align='center'>Exam</div></th>
                      <th><div align='center'>Date/Time Test Done</div></th>
                      <th><div align='center'>Action</div></th>
                    </tr>
                  </thead>
                  <tbody>
";

$adm=0;
mysqli_query($conn,"SET NAMES 'utf8'");

$ax=0;
$axsql=mysqli_query($conn,"SELECT * FROM `labpending` WHERE `caseno` NOT LIKE '%I-%' AND `resultstatus`='Testdone' AND `ptype`='LABORATORY' AND `testdonedt` LIKE '$da%%' AND `verified`='0' ORDER BY `testdonedt`");
while($axfetch=mysqli_fetch_array($axsql)){
  $refno=$axfetch['refno'];
  $patientidno=trim($axfetch['patientidno']);
  $caseno=$axfetch['caseno'];
  $patientname=$axfetch['patientname'];
  $itemcode=$axfetch['itemcode'];
  $pdesc=$axfetch['productdesc'];
  $ptype=$axfetch['ptype'];
  $trantype=$axfetch['trantype'];
  $status=$axfetch['status'];
  $resstat=$axfetch['resultstatus'];
  $testdonedt=$axfetch['testdonedt'];
  $station=$axfetch['station'];
  $dateadded=$axfetch['dateadded'];
  $timeadded=$axfetch['timeadded'];
  $labtype=$axfetch['labtype'];
  $testno=$axfetch['testno'];
  $ax++;

  $patient=$patientname."_".$caseno;

  $acsql=mysqli_query($conn,"SELECT * FROM `labresults` WHERE `refno`='$refno'");
  $account=mysqli_num_rows($acsql);

  if($account==0){
    if(($labtype=="serology")||($labtype=="chemistry")||($labtype=="miscellaneous")){
      if($resstat=="Testdone"){
        $csql=mysqli_query($conn,"SELECT `testno` FROM `hematology` WHERE `lab29`='$refno'");
        $cfetch=mysqli_fetch_array($csql);
        $tno=$cfetch['testno'];

        //$plink="<form name='Print' target='blank' method='post' action='../../../labprint/bloodchem.php?caseno=$caseno&lab29=$refno&testno=$tno' onSubmit='return printalert$a();'><button type='submit' class='btn btn-info xs'><i class='fa fa-print'></i></button></form>";
        $plink="<form name='Print' target='_blank' method='post' action='printme.php'><input type='hidden' name='restype' value='chemistry' /><input type='hidden' name='caseno' value='$caseno' /><input type='hidden' name='lab29' value='$refno' /><input type='hidden' name='testno' value='$tno' /><button type='submit' class='btn btn-info text-white' title='View Result'><i class='icofont-print'></i></button></form>";
      }
      else{
        $plink="<button class='btn btn-info xs' disabled><i class='fa fa-print'></i></button>";
      }
    }
    else if($labtype=="hematology"){
      if($resstat=="Testdone"){
        //$plink="<form name='Print' target='blank' method='post' action='../../../labprint/hemabody.php?caseno=$caseno&lab29=$refno' onSubmit='return printalert$a();'><button type='submit' class='btn btn-info xs'><i class='fa fa-print'></i></button></form>";
        $plink="<form name='Print' target='_blank' method='post' action='printme.php'><input type='hidden' name='restype' value='hematology' /><input type='hidden' name='caseno' value='$caseno' /><input type='hidden' name='lab29' value='$refno' /><button type='submit' class='btn btn-info text-white' title='View Result'><i class='icofont-print'></i></button></form>";
      }
      else{
        $plink="<button class='btn btn-info xs' disabled><i class='fa fa-print'></i></button>";
      }
    }
    else{
      if($resstat=="Testdone"){
        if(($pdesc=="Stool Exam")||($pdesc=="Stool Exam with Occult Blood")||($pdesc=="OCCULT BLOOD")){
          //$plink="<form name='Print' target='blank' method='post' action='http://$ip/cgi-bin/fecalysis200.cgi' onSubmit='return printalert$a();'><input type='hidden' name='patient' value='$patient' /><input type='hidden' name='refno' value='$refno' /><button type='submit' class='btn btn-info xs'><i class='fa fa-print'></i></button></form>";
          $plink="<form name='Print' target='_blank' method='post' action='printme.php'><input type='hidden' name='restype' value='stool' /><input type='hidden' name='patient' value='$patient' /><input type='hidden' name='refno' value='$refno' /><button type='submit' class='btn btn-info text-white'><i class='icofont-print'></i></button></form>";
        }
        else{
          //$plink="<form name='Print' target='blank' method='post' action='http://$ip/labprint/$pdesc-body.php?caseno=$caseno&refno=$refno' onSubmit='return printalert$a();'><button type='submit' class='btn btn-info xs'><i class='fa fa-print'></i></button></form>";
          $plink="<form name='Print' target='_blank' method='post' action='printme.php'><input type='hidden' name='restype' value='others' /><input type='hidden' name='desc' value='$pdesc' /><input type='hidden' name='caseno' value='$caseno' /><input type='hidden' name='refno' value='$refno' /><button type='submit' class='btn btn-info text-white' title='View Result'><i class='icofont-print'></i></button></form>";
        }
      }
      else{
        $plink="<button class='btn btn-info xs' disabled><i class='icofont-print'></i></button>";
      }
    }
  }
  else{
    $snm="";
    if(isset($_SESSION['nm'])){$snm=base64_decode($_SESSION['nm']);}

    $plink="<form method='get' target='_blank' action='../extra/LabExpress/PrintResult/'><input type='hidden' name='caseno' value='$caseno' /><input type='hidden' name='patid' value='$patientidno' /><input type='hidden' name='printbatchno' value='$testno' /><input type='hidden' name='stype' value='$labtype' /><input type='hidden' name='asd' value='$snm' /><button type='submit' class='btn btn-info text-white' title='View Result'><i class='icofont-print'></i></button></form>";
  }


  if(stripos($caseno, "I-") !== FALSE){$pattype="<span style='color: #0022B9;font-weight: bold;font-family: arial;'>IN-PATIENT</span>";}
  else if(stripos($caseno, "O-") !== FALSE){$pattype="<span style='color: #B97D05;font-weight: bold;font-family: arial;'>OUT-PATIENT</span>";}
  else if(stripos($caseno, "W-") !== FALSE){$pattype="<span style='color: #8C0EB4;font-weight: bold;font-family: arial;'>WALK-IN</span>";}
  else if((stripos($caseno, "AR-") !== FALSE)||(stripos($caseno, "AP-") !== FALSE)){$pattype="<span style='color: #F8365F;font-weight: bold;font-family: arial;'>AR-PATIENT</span>";}
  else if((stripos($caseno, "R-") !== FALSE)||(stripos($caseno, "WR-") !== FALSE)){$pattype="<span style='color: #137C00;font-weight: bold;font-family: arial;'>RDU-PATIENT</span>";}
  else{$pattype="";}


echo "
                    <tr>
                      <td><div align='left'style='font-size: 13px;'>$ax</div></td>
                      <td><div align='left' style='font-size: 13px;'><span class='fw-bold ms-1'><span class='mono' id='theList$ax' style='display: none;'>$caseno</span><button id='copyButton' class='btn' title='Copy $caseno to Clip Board.' onclick=myCopyFunction$ax()><i class='icofont-ui-copy' onclick='toast1()'></i></button>$patientname</span></div></td>
                      <td><div align='center' style='font-size: 13px;'>$pattype</div></td>
                      <td><div align='center' style='font-size: 13px;font-weight: bold;'><span class='mono' id='theList1$ax' style='display: none;'>$refno</span><button id='copyButton' class='btn' title='Copy $refno to Clip Board.' onclick=myCopyFunction1$ax()><i class='icofont-ui-copy' onclick='toast2()'></i></button>$pdesc</div></td>
                      <td><div align='center' style='font-size: 13px;'>".date("M d, Y h:i:s A",strtotime($testdonedt))."</div></td>
                      <td><div align='center' style='font-size: 13px;font-weight: bold;'>$plink</div></td>
                    </tr>
";

echo '
<script>
function myCopyFunction'.$ax.'() {
  var myText = document.createElement("textarea")
  myText.value = document.getElementById("theList'.$ax.'").innerHTML;
  myText.value = myText.value.replace(/&lt;/g,"<");
  myText.value = myText.value.replace(/&gt;/g,">");
  document.body.appendChild(myText)
  myText.focus();
  myText.select();
  document.execCommand("copy");
  document.body.removeChild(myText);
}
function myCopyFunction1'.$ax.'() {
  var myText = document.createElement("textarea")
  myText.value = document.getElementById("theList1'.$ax.'").innerHTML;
  myText.value = myText.value.replace(/&lt;/g,"<");
  myText.value = myText.value.replace(/&gt;/g,">");
  document.body.appendChild(myText)
  myText.focus();
  myText.select();
  document.execCommand("copy");
  document.body.removeChild(myText);
}
</script>
';
}

echo "
                  </tbody>
                </table>
                <!-- Back to top button -->
              </div>
            </div>
          </div>
        </div><!-- Row End -->
      </div>
    </div>

    <!-- Modal Members-->
    <div class='modal fade' id='addUser' tabindex='-1' aria-labelledby='addUserLabel' aria-hidden='true'>
      <div class='modal-dialog modal-dialog-centered modal-lg'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h5 class='modal-title  fw-bold' id='addUserLabel'>Employee Invitation</h5>
            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
          </div>
          <div class='modal-body'>
            <div class='inviteby_email'>
              <div class='input-group mb-3'>
                <input type='email' class='form-control' placeholder='Email address' id='exampleInputEmail1' aria-describedby='exampleInputEmail1'>
                <button class='btn btn-dark' type='button' id='button-addon2'>Sent</button>
              </div>
            </div>
            <div class='members_list'>
              <h6 class='fw-bold '>Employee </h6>
              <ul class='list-unstyled list-group list-group-custom list-group-flush mb-0'>
                <li class='list-group-item py-3 text-center text-md-start'>
                  <div class='d-flex align-items-center flex-column flex-sm-column flex-md-column flex-lg-row'>
                    <div class='no-thumbnail mb-2 mb-md-0'>
                      <img class='avatar lg rounded-circle' src='../main/assets/images/xs/avatar2.jpg' alt=''>
                    </div>
                    <div class='flex-fill ms-3 text-truncate'>
                      <h6 class='mb-0  fw-bold'>Rachel Carr(you)</h6>
                      <span class='text-muted'>rachel.carr@gmail.com</span>
                    </div>
                    <div class='members-action'>
                      <span class='members-role '>Admin</span>
                      <div class='btn-group'>
                        <button type='button' class='btn bg-transparent dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
                          <i class='icofont-ui-settings  fs-6'></i>
                        </button>
                        <ul class='dropdown-menu dropdown-menu-end'>
                          <li><a class='dropdown-item' href='#'><i class='icofont-ui-password fs-6 me-2'></i>ResetPassword</a></li>
                          <li><a class='dropdown-item' href='#'><i class='icofont-chart-line fs-6 me-2'></i>ActivityReport</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </li>
                <li class='list-group-item py-3 text-center text-md-start'>
                  <div class='d-flex align-items-center flex-column flex-sm-column flex-md-column flex-lg-row'>
                    <div class='no-thumbnail mb-2 mb-md-0'>
                      <img class='avatar lg rounded-circle' src='../main/assets/images/xs/avatar3.jpg' alt=''>
                    </div>
                    <div class='flex-fill ms-3 text-truncate'>
                      <h6 class='mb-0  fw-bold'>Lucas Baker<a href='#' class='link-secondary ms-2'>(Resend invitation)</a></h6>
                      <span class='text-muted'>lucas.baker@gmail.com</span>
                    </div>
                    <div class='members-action'>
                      <div class='btn-group'>
                        <button type='button' class='btn bg-transparent dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
                          Members
                        </button>
                        <ul class='dropdown-menu dropdown-menu-end'>
                          <li>
                            <a class='dropdown-item' href='#'>
                              <i class='icofont-check-circled'></i>
                              <span>All operations permission</span>
                            </a>
                          </li>
                          <li>
                            <a class='dropdown-item' href='#'>
                              <i class='fs-6 p-2 me-1'></i>
                              <span>Only Invite & manage team</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                      <div class='btn-group'>
                        <button type='button' class='btn bg-transparent dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
                          <i class='icofont-ui-settings  fs-6'></i>
                        </button>
                        <ul class='dropdown-menu dropdown-menu-end'>
                          <li><a class='dropdown-item' href='#'><i class='icofont-delete-alt fs-6 me-2'></i>Delete Member</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </li>
                <li class='list-group-item py-3 text-center text-md-start'>
                  <div class='d-flex align-items-center flex-column flex-sm-column flex-md-column flex-lg-row'>
                    <div class='no-thumbnail mb-2 mb-md-0'>
                      <img class='avatar lg rounded-circle' src='../main/assets/images/xs/avatar8.jpg' alt=''>
                    </div>
                    <div class='flex-fill ms-3 text-truncate'>
                      <h6 class='mb-0  fw-bold'>Una Coleman</h6>
                      <span class='text-muted'>una.coleman@gmail.com</span>
                    </div>
                    <div class='members-action'>
                      <div class='btn-group'>
                        <button type='button' class='btn bg-transparent dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
                          Members
                        </button>
                        <ul class='dropdown-menu dropdown-menu-end'>
                          <li>
                            <a class='dropdown-item' href='#'>
                              <i class='icofont-check-circled'></i>
                              <span>All operations permission</span>
                            </a>
                          </li>
                          <li>
                            <a class='dropdown-item' href='#'>
                              <i class='fs-6 p-2 me-1'></i>
                              <span>Only Invite & manage team</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                      <div class='btn-group'>
                        <div class='btn-group'>
                          <button type='button' class='btn bg-transparent dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
                            <i class='icofont-ui-settings  fs-6'></i>
                          </button>
                          <ul class='dropdown-menu dropdown-menu-end'>
                            <li><a class='dropdown-item' href='#'><i class='icofont-ui-password fs-6 me-2'></i>ResetPassword</a></li>
                            <li><a class='dropdown-item' href='#'><i class='icofont-chart-line fs-6 me-2'></i>ActivityReport</a></li>
                            <li><a class='dropdown-item' href='#'><i class='icofont-delete-alt fs-6 me-2'></i>Suspend member</a></li>
                            <li><a class='dropdown-item' href='#'><i class='icofont-not-allowed fs-6 me-2'></i>Delete Member</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Members End-->
";
?>
