<?php
ini_set("display_errors","On");
$lb="Patient Details";

$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);

mysqli_query($conn,"SET NAMES 'utf8'");
$zasql=mysqli_query($conn,"SELECT `patientidno`, `caseno`, `membership`, `hmo`, `room`, `street`, `barangay`, `municipality`, `province`, `initialdiagnosis`, `ap`, `dateadmitted`, `timeadmitted`, `branch`, `employerno`, `ad`, `status`, `finaldiagnosis` FROM `admission` WHERE `caseno`='$caseno'");
$zacount=mysqli_num_rows($zasql);
if($zacount==0){
  $patientidno="";
  $caseno="";
  $membership="";
  $hmo="";
  $room="";
  $initialdiagnosis="";
  $finaldiagnosis="";
  $ap="";
  $ad="";
  $employerno="";
  $dateadmitted="";
  $timeadmitted="";
  $branch="";
  $status="";
  $street="";
  $barangay="";
  $municipality="";
  $province="";
}
else{
  $zafetch=mysqli_fetch_array($zasql);
  $patientidno=$zafetch['patientidno'];
  $caseno=$zafetch['caseno'];
  $membership=$zafetch['membership'];
  $hmo=$zafetch['hmo'];
  $room=$zafetch['room'];
  $initialdiagnosis=$zafetch['initialdiagnosis'];
  $finaldiagnosis=$zafetch['finaldiagnosis'];
  $ap=$zafetch['ap'];
  $ad=$zafetch['ad'];
  $employerno=$zafetch['employerno'];
  $dateadmitted=$zafetch['dateadmitted'];
  $timeadmitted=$zafetch['timeadmitted'];
  $branch=$zafetch['branch'];
  $status=$zafetch['status'];

  if($zafetch['street']!=""){$street=mb_strtoupper($zafetch['street'])." ";}else{$street="";}
  if($zafetch['barangay']!=""){$barangay=mb_strtoupper($zafetch['barangay'])." ";}else{$barangay="";}
  if($zafetch['municipality']!=""){$municipality=mb_strtoupper($zafetch['municipality'])." ";}else{$municipality="";}
  if($zafetch['province']!=""){$province=mb_strtoupper($zafetch['province'])." ";}else{$province="";}

}

$address=$street.$barangay.$municipality.$province;

$zbsql=mysqli_query($conn,"SELECT `name` FROM `docfile` WHERE `code`='$ap'");
$zbcount=mysqli_num_rows($zbsql);
if($zbcount!=0){
  $zbfetch=mysqli_fetch_array($zbsql);
  $ap=$zbfetch['name'];
}

$zcsql=mysqli_query($conn,"SELECT `name` FROM `docfile` WHERE `code`='$ad'");
$zccount=mysqli_num_rows($zcsql);
if($zccount!=0){
  $zcfetch=mysqli_fetch_array($zcsql);
  $ad=$zcfetch['name'];
}

$zdsql=mysqli_query($conn,"SELECT UPPER(`lastname`) AS `lname`, UPPER(`firstname`) AS `fname`, UPPER(`middlename`) AS `mname`, UPPER(`suffix`) AS `suffix`, `age`, `senior`, `sex`, `birthdate` FROM `patientprofile` WHERE `patientidno`='$patientidno'");
$zdcount=mysqli_num_rows($zdsql);
if($zdcount==0){
  $zdfetch=mysqli_fetch_array($zdsql);
  $lname="";
  $fname="";
  $mname="";
  $suffix="";
  $age="";
  $senior="";
  $sex="";
  $birthdate="";
}
else{
  $zdfetch=mysqli_fetch_array($zdsql);
  $lname=$zdfetch['lname'];
  $fname=$zdfetch['fname'];
  $mname=$zdfetch['mname'];
  $suffix=$zdfetch['suffix'];
  $age=$zdfetch['age'];
  $senior=$zdfetch['senior'];
  $sex=$zdfetch['sex'];
  $birthdate=$zdfetch['birthdate'];

  if($zdfetch['lname']!=""){$ln=$lname.", ";}else{$ln="";}
  if($zdfetch['fname']!=""){$fn=$fname." ";}else{$fn="";}
  if($zdfetch['mname']!=""){$mn=$mname;}else{$mn="";}
  if($zdfetch['suffix']!=""){$sf=$suffix." ";}else{$sf="";}
}

$patientname=$ln.$fn.$sf.$mn;
$patient=$lname.", ".$fname." ".$mname."_".$caseno;

if(($sex=="m")||($sex=="M")){$sex="MALE";}
else{
  if(($sex=="f")||($sex=="F")){$sex="FEMALE";}
  else{$sex="";}
}

if(($senior=="Y")||($senior=="y")){$senior="YES";}
else{$senior="NO";}

//-------------------------------------------------------------------------------------------------
$dstsql=mysqli_query($conn,"SELECT `timedischarged`, `datearray` FROM `dischargedtable` WHERE `caseno`='$caseno'");
$dstcount=mysqli_num_rows($dstsql);

if($dstcount==0){
  $ddt="";
}
else{
  $dstfetch=mysqli_fetch_array($dstsql);
  $tmd=$dstfetch['timedischarged'];
  $dtd=$dstfetch['datearray'];

  $ddt=date("M d, Y h:i A");
}
//-------------------------------------------------------------------------------------------------

echo "
    <!-- Body: Body -->
    <div class='body d-flex py-lg-3 py-md-2'>
      <div class='container-xxl'>
        <div class='row clearfix g-3'>
          <div class='col-sm-12'>
            <div class='card mb-3'>
              <div class='card-body'>
                <table border='0' style='width: 100%;' align='center' cellpadding='0' cellspacing='0'>
                  <tr>
                   <th colspan='8'><div align='left' style='font-size: 26px;font-weight: bold;'><u>$patientname</u></div></th>
                  </tr>
                  <tr>
                    <th colspan='8' height='30'><div align='left' style='font-size: 14px;font-weight: bold;'>ADDRESS: $address</div></th>
                  </tr>
                  <tr>
                    <td width='16%'><div align='left' style='font-size: 15px;'>CASENO: </div></td>
                    <td width='17%'><div align='left' style='font-size: 14px;font-weight: bold;'>$caseno</div></td>
                    <td width='16%'><div align='left' style='font-size: 15px;'>HOSP. CASENO: </div></td>
                    <td width='18%'><div align='left' style='font-size: 14px;font-weight: bold;'>$employerno</div></td>
                    <td width='16%'><div align='left' style='font-size: 15px;'>AGE/ GENDER: </div></td>
                    <td width='17%'><div align='left' style='font-size: 14px;font-weight: bold;'>$age / $sex</div></td>
                  </tr>
                  <tr>
                    <td><div align='left' style='font-size: 15px;'>PATIENTID NO:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>$patientidno</div></td>
                    <td><div align='left' style='font-size: 15px;'>ROOM NO:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>$room</div></td>
                    <td><div align='left' style='font-size: 15px;'>SENIOR:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>$senior</div></td>
                  </tr>
                  <tr>
                    <td><div align='left' style='font-size: 15px;'>ATTENDING:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>$ap</div></td>
                    <td><div align='left' style='font-size: 15px;'>HMO:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>$hmo</div></td>
                    <td><div align='left' style='font-size: 15px;'>PHILHEALTH:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>$membership</div></td>
                  </tr>
                  <tr>
                    <td><div align='left' style='font-size: 15px;'>ADMITTING:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>$ad</div></td>
                    <td><div align='left' style='font-size: 15px;'>DATE/TIME ADMITTED:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>$dateadmitted $timeadmitted</div></td>
                    <td><div align='left' style='font-size: 15px;'>DATE/TIME DISCHARGED:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>$ddt</div></td>
                  </tr>
                  <tr>
                    <td><div align='left' style='font-size: 15px;'>BIRTHDATE:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>$birthdate</div></td>
                    <td><div align='left' style='font-size: 15px;'>MEDTECH ON-DUTY:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>$user</div></td>
                    <td><div align='left' style='font-size: 15px;'>STATUS:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>$status</div></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
";

if(stripos($caseno, "I-") !== FALSE){
  $mh="&inp";
}
else{
  if((stripos($caseno, "W-") !== FALSE)||(stripos($caseno, "O-") !== FALSE)||(stripos($caseno, "AR-") !== FALSE)){$mh="&otp";}
  else{$mh="&rtp";}
}

echo "
        <div class='row clearfix g-3'>
          <div class='col-sm-12'>
            <div class='card mb-3'>
              <div class='card-header'>
                <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td style='border-bottom: 1px solid #000000;padding-bottom: 5px;'><div align='left'><h5 class='fw-bold'><i class='icofont-cart me-2'></i> Cart</h5></div></td>
                    <td style='border-bottom: 1px solid #000000;padding-bottom: 5px;'><div align='right'>
                      <a href='../laboratory/?details&$mh&caseno=$caseno'>
                        <button type='button' class='btn btn-success btn-sm' style='font-weight: bold;'><i class='icofont-bubble-left'></i> Back to Profile</button>
                      </a>
                    </div></td>
                  </tr>
                </table>
              </div>
              <div class='card-body' style='padding-top: 0px;'>
                <iframe src='../extra/CartBeta/?caseno=$caseno&ct=sot-lab&dept=$dept&user=$userunique&lin&linu=".base64_encode($userunique)."&linp=".$_SESSION['pw']."' title='description' width='100%' height='420' style='border: none;'></iframe>
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

echo "<META HTTP-EQUIV='Refresh'CONTENT='900;URL=Close.php'>";
?>
