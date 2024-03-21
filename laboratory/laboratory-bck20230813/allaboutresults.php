<?php
ini_set("display_errors","On");
$lb="Patient Details";

$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);
$srefno=mysqli_real_escape_string($conn,$_POST['srefno']);
$stype=mysqli_real_escape_string($conn,$_POST['ltype']);

mysqli_query($conn,"SET NAMES 'utf8'");
$zasql=mysqli_query($conn,"SELECT `patientidno`, `caseno`, `membership`, `hmo`, `room`, `street`, `barangay`, `municipality`, `province`, `initialdiagnosis`, `finaldiagnosis`, `ap`, `dateadmitted`, `timeadmitted`, `branch`, `employerno`, `ad`, `status` FROM `admission` WHERE `caseno`='$caseno'");
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
  $adstatus="";
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
  $adstatus=$zafetch['status'];

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

$zdsql=mysqli_query($conn,"SELECT UPPER(`lastname`) AS `lname`, UPPER(`firstname`) AS `fname`, UPPER(`middlename`) AS `mname`, UPPER(`suffix`) AS `suffix`, `age`, `senior`, `sex`, `birthdate`, `dateofbirth` FROM `patientprofile` WHERE `patientidno`='$patientidno'");
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
  $dateofbirth=$zdfetch['dateofbirth'];

  $datetoday=date("Y-m-d");
  $today = date("Y-m-d",strtotime($dateofbirth));
  $diff = date_diff(date_create($datetoday), date_create($today));
  $age=$diff->format('%y');

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
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>".date("M d, Y h:i A",strtotime("$dateadmitted $timeadmitted"))."</div></td>
                    <td><div align='left' style='font-size: 15px;'>DATE/TIME DISCHARGED:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>$ddt</div></td>
                  </tr>
                  <tr>
                    <td><div align='left' style='font-size: 15px;'>BIRTHDATE:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>".date("M d, Y",strtotime($birthdate))."</div></td>
                    <td><div align='left' style='font-size: 15px;'>MEDTECH ON-DUTY:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>$user</div></td>
                    <td><div align='left' style='font-size: 15px;'>STATUS:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>".ucfirst(mb_strtolower($adstatus))."</div></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class='row clearfix g-3'>
          <div class='col-sm-12'>
            <div class='card mb-3'>
              <div class='card-header'>
                <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                  <tr>
";

if(isset($_POST['stest'])){
  if(isset($_POST['cres'])){
echo "
                    <td><div align='left'><h5 class='fw-bold'><i class='icofont-keyboard-wireless me-2'></i> INPUT RESULT</h5></div></td>
";
  }
  else{
    if(isset($_POST['sres'])){
echo "
                    <td><div align='left'><h5 class='fw-bold'><i class='icofont-save me-2'></i> SAVING RESULT</h5></div></td>
";
    }
    else{
echo "
                    <td><div align='left'><h5 class='fw-bold'><i class='icofont-ui-pointer me-2'></i> SELECT TEST</h5></div></td>
";
    }
  }
}
else{
  if(isset($_POST['eres'])){
    if(isset($_POST['ures'])){
echo "
                    <td><div align='left'><h5 class='fw-bold'><i class='icofont-ui-settings me-2'></i> UPDATING RESULT</h5></div></td>
";
    }
    else{
echo "
                    <td><div align='left'><h5 class='fw-bold'><i class='icofont-edit-alt me-2'></i> EDIT RESULT</h5></div></td>
";
    }
  }
}


echo "
                  </tr>
                </table>
              </div>
              <div class='card-body'>
";

if(isset($_POST['stest'])){
  if(isset($_POST['cres'])){
    include("ltcr.php");
  }
  else{
    if(isset($_POST['sres'])){
      include("ltsr.php");
    }
    else{
      include("ltst.php");
    }
  }
}
else{
  if(isset($_POST['eres'])){
    if(isset($_POST['ures'])){
      include("ltur.php");
    }
    else{
      include("lter.php");
    }
  }
}

echo "
              </div>
            </div>
          </div>
        </div><!-- Row End -->
      </div>
    </div>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='900;URL=Close.php'>";
?>
