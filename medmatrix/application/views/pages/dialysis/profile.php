<style>
  .profbt{background-color: #73C6B6;font-size: 10px;font-weight: bold;border-radius: 3px;border: 1px solid #000000;padding: 3px 10px;}
  .profbt:hover{background-color: #036478;color: #FFFFFF;border: 1px solid #036478;}
</style>
<?php
include("../main/connection.php");

//-------------------------------------------------------------------------------------------------
$allcs="";
$ya=0;

$yasql=mysqli_query($conn,"SELECT * FROM `rduconsolidate` WHERE `rducaseno`='$rcsno' ORDER BY `dateadmit`");
$yacount=mysqli_num_rows($yasql);
while($yafetch=mysqli_fetch_array($yasql)){
  $ya++;
  $csn[$ya]=$yafetch['caseno'];
  $caseno=$yafetch['caseno'];
  $allda[$ya]=$yafetch['dateadmit'];

  if($ya!=$yacount){$yaprf=" OR ";}else{$yaprf="";}

  $allcs=$allcs."caseno='".$csn[$ya]."'".$yaprf;
}
//-------------------------------------------------------------------------------------------------

//-------------------------------------------------------------------------------------------------
$csstart=$csn[1];
$csend=$csn[$yacount];

$ybsql=mysqli_query($conn,"SELECT `timeadmitted`, `dateadmit` FROM `admission` WHERE `caseno`='$csstart'");
$ybfetch=mysqli_fetch_array($ybsql);
$ybtm=$ybfetch['timeadmitted'];
$ybda=$ybfetch['dateadmit'];

$alladt=date("M d y h:i A",strtotime("$ybda $ybtm"));

$ycsql=mysqli_query($conn,"SELECT `timeadmitted`, `dateadmit` FROM `admission` WHERE `caseno`='$csend'");
$ycfetch=mysqli_fetch_array($ycsql);
$yctm=$ycfetch['timeadmitted'];
$ycda=$ycfetch['dateadmit'];

$allddt=date("M d y h:i A",strtotime("$ycda $yctm"));
//-------------------------------------------------------------------------------------------------

mysqli_query($conn,"SET NAMES 'utf8'");
$zasql=mysqli_query($conn,"SELECT `patientidno`, `caseno`, `membership`, `paymentmode`, `hmo`, `room`, `street`, `barangay`, `municipality`, `province`, `initialdiagnosis`, `finaldiagnosis`, `ap`, `timeadmitted`, `dateadmitted`, `branch`, `employerno`, `ad`, `status`, `remarks` FROM `admission` WHERE `caseno`='$caseno'");
$zacount=mysqli_num_rows($zasql);
if($zacount==0){
  $patientidno="";
  $caseno="";
  $membership="";
  $paymentmode="";
  $hmo="";
  $room="";
  $initialdiagnosis="";
  $finaldiagnosis="";
  $ap="";
  $ad="";
  $employerno="";
  $timeadmitted="";
  $dateadmitted="";
  $branch="";
  $adstatus="";
  $street="";
  $barangay="";
  $municipality="";
  $province="";
  $adremarks="";
}
else{
  $zafetch=mysqli_fetch_array($zasql);
  $patientidno=$zafetch['patientidno'];
  $caseno=$zafetch['caseno'];
  $membership=$zafetch['membership'];
  $paymentmode=$zafetch['paymentmode'];
  $hmo=$zafetch['hmo'];
  $room=$zafetch['room'];
  $initialdiagnosis=$zafetch['initialdiagnosis'];
  $finaldiagnosis=$zafetch['finaldiagnosis'];
  $ap=$zafetch['ap'];
  $ad=$zafetch['ad'];
  $employerno=$zafetch['employerno'];
  $timeadmitted=$zafetch['timeadmitted'];
  $dateadmitted=$zafetch['dateadmitted'];
  $branch=$zafetch['branch'];
  $adstatus=$zafetch['status'];
  $adremarks=$zafetch['remarks'];

  if($zafetch['street']!=""){$street=mb_strtoupper($zafetch['street'])." ";}else{$street="";}
  if($zafetch['barangay']!=""){$barangay=mb_strtoupper($zafetch['barangay'])." ";}else{$barangay="";}
  if($zafetch['municipality']!=""){$municipality=mb_strtoupper($zafetch['municipality'])." ";}else{$municipality="";}
  if($zafetch['province']!=""){$province=mb_strtoupper($zafetch['province'])." ";}else{$province="";}

}

$pataddress=$street.$barangay.$municipality.$province;

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

if(($sex=="m")||($sex=="M")){$sex="MALE";$ics="boy";}
else{
  if(($sex=="f")||($sex=="F")){$sex="FEMALE";$ics="girl-alt";}
  else{$sex="";$ics="zigzag";}
}


if(($senior=="Y")||($senior=="y")){$senior="YES";}
else{$senior="NO";}

//PRINT LOCK---------------------------------------------------------------------------------------
if((stripos($caseno, "I-") !== FALSE)){
  $dat="<input type='hidden' name='dat' value='0' />";
  $pl=0;
}
else{
  $zsql=mysqli_query($conn,"SELECT `lock` FROM `labprintlock`");
  $zfetch=mysqli_fetch_array($zsql);
  $pl=$zfetch['lock'];
  $dat="<input type='hidden' name='dat' value='$pl' />";
}
//-------------------------------------------------------------------------------------------------

if(stripos($caseno, "I-") !== FALSE){$mh="&inp";}else{$mh="&otp";}

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

  $ddt=date("M d, Y h:i A",strtotime("$tmd $dtd"));
}
//-------------------------------------------------------------------------------------------------

echo "
        <div class='row clearfix g-3'>
          <div class='col-sm-12'>
            <div class='card mb-1'>
              <div class='card-body'>
                <table border='0' style='width: 100%;' align='center' cellpadding='0' cellspacing='0'>
                  <tr>
                   <th colspan='8'><div align='left' style='font-size: 26px;font-weight: bold;'><u>$patientname</u></div></th>
                  </tr>
                  <tr>
                    <th colspan='8' height='30'><div align='left' style='font-size: 14px;font-weight: bold;'>ADDRESS: $pataddress</div></th>
                  </tr>
                  <tr>
                    <td width='16%'><div align='left' style='font-size: 15px;'>RDU CASENO: </div></td>
                    <td width='17%'><div align='left' style='font-size: 14px;font-weight: bold;'>$rcsno</div></td>
                    <td width='16%'><div align='left' style='font-size: 15px;'>BIRTH DATE: </div></td>
                    <td width='18%'><div align='left' style='font-size: 14px;font-weight: bold;'>".date("M d, Y",strtotime($birthdate))."</div></td>
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
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>$alladt</div></td>
                    <td><div align='left' style='font-size: 15px;'>DATE/TIME DISCHARGED:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>$allddt</div></td>
                  </tr>
                  <tr>
                    <td><div align='left' style='font-size: 15px;'>SESSION COUNT:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>$yacount</div></td>
                    <td><div align='left' style='font-size: 15px;'>LOGIN USER:</div></td>
                    <td><div align='left' style='font-size: 14px;font-weight: bold;'>".$_SESSION['fullname']."</div></td>
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
            <div class='card mb-1'>
              <div class='card-body' align='left'>
                <span style='font-size: 12px;font-weight: bold;'>HEMODIALYSIS SESSIONS:</span><br />
                <table border='0' cellpadding='0' cellspacing='0'>
                  <tr>
";

for($aa=1;$aa<=$yacount;$aa++){
echo "
                    <td><a href='../../../2021codes/BillMe/?caseno=".$csn[$aa]."&nursename=".$_SESSION['fullname']."&user=".$_SESSION['username']."&branch=KMSCI&dept=RDU' target='_blank'><button class='profbt'>".date("M d, Y",strtotime($allda[$aa]))." - ".$csn[$aa]."</button></a></td>
                    <td width='2'></td>
";
}

echo "
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
";
?>
