<?php
/*if($dept=="LABORATORY"){
  $clientProps=array('screen.width','screen.height','window.innerWidth','window.innerHeight',
    'window.outerWidth','window.outerHeight','screen.colorDepth','screen.pixelDepth');

  if(!isset($_POST['screenheight'])){

    echo "<form method='POST' id='data' style='display:none'>";
    foreach($clientProps as $p) {  //create hidden form
      echo "<input type='text' id='".str_replace('.','',$p)."' name='".str_replace('.','',$p)."'>";
    }
    echo "<input type='submit'></form>";

    echo "<script>";
    foreach($clientProps as $p) {  //populate hidden form with screen/window info
      echo "document.getElementById('" . str_replace('.','',$p) . "').value = $p;";
    }
    echo "document.forms.namedItem('data').submit();"; //submit form
    echo "</script>";

  }else{

    $zx=0;
    foreach($clientProps as $p) {
         //create output table
      $asd[$zx]=$_POST[str_replace('.','',$p)];
      $zx++;
    }
  }

  $scw=$asd[0];
  $sch=$asd[1];

  $_SESSION['scw']=$scw;
  $_SESSION['sch']=$sch;
}*/
//---------------------------------------------
if((isset($_SESSION['scw']))&&(isset($_SESSION['sch']))){
  $scw=$_SESSION['scw'];
  $sch=$_SESSION['sch'];
}
else{
  $scw=1920;
  $sch=1080;
}

$setw=500;
$wid=round(($scw-$setw)/2);

$seth=500;
$hei=round(($sch-$seth)/2)-($sch+50);
//---------------------------------------------
?>
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

$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);

$nm="";
if(isset($_SESSION['nm'])){$nm=base64_decode($_SESSION['nm']);}

mysqli_query($conn,"SET NAMES 'utf8'");
$zasql=mysqli_query($conn,"SELECT `patientidno`, `caseno`, `membership`, `hmo`, `room`, `street`, `barangay`, `municipality`, `province`, `initialdiagnosis`, `finaldiagnosis`, `ap`, `timeadmitted`, `dateadmitted`, `branch`, `employerno`, `ad`, `status` FROM `admission` WHERE `caseno`='$caseno'");
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
                    <td width='50%'><div align='left'><h5 class='fw-bold'><i class='icofont-listine-dots me-2'></i> LABORATORY REQUEST LIST</h5></div></td>
                    <td width='50%'><div align='right'>
                      <table border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td>
                            <a href='../laboratory/?cart&caseno=$caseno'>
                              <button type='button' class='btn btn-primary btn-sm' style='width: 150px;font-weight: bold;'><i class='icofont-ui-cart'></i> Cart</button>
                            </a>
                          </td>
                          <td width='5'></td>
                          <td>
                            <a href='../laboratory/?tick&caseno=$caseno&nursename=$nm&dept=laboratory' target='_blank'>
                              <button type='button' class='btn btn-danger text-white btn-sm' style='width: 150px;font-weight: bold;'><i class='icofont-ticket'></i> Ticket</button>
                            </a>
                          </td>
                        </tr>
                      </table>
                    </div></td>
                  </tr>
                </table>
              </div>
";

if(isset($_POST['ttb'])){
  //Set Test to be done
  include("details-ttb.php");
}
else{
  if(isset($_POST['rfu'])){
    //Refund
    include("details-rfu.php");
  }
  else{
    if(isset($_POST['crf'])){
      //Cancel refund
      include("details-crf.php");
    }
    else{
      if(isset($_POST['dli'])){
        //Delete item
        include("details-dli.php");
      }
      else{
        if(isset($_POST['cttb'])){
          //Cancel Test to be done status
          include("details-ctb.php");
        }
        else{
echo "
              <div class='card-body'>
                <table id='myProjectTable' class='table table-hover align-middle mb-0' style='width:100%'>
                  <thead>
                    <tr>
                      <th><div align='center'>#</div></th>
                      <th><div align='center'>Description</div></th>
                      <th><div align='center'>Payment Status</div></th>
                      <th><div align='center'>Date/Time Requested</div></th>
                      <th><div align='center'>Result Status</div></th>
                      <th><div align='center'>Action</div></th>
                    </tr>
                  </thead>
                  <tbody>
";

          $zx=0;
          $zxsql=mysqli_query($conn,"SELECT * FROM `labpending` WHERE `caseno`='$caseno' AND `ptype`='LABORATORY' AND `productdesc` NOT LIKE '%RAPID TEST%' AND `productdesc` NOT LIKE '%RT%%PCR%' AND `productdesc` NOT LIKE '%ABG%' ORDER BY `dateadded`, `timeadded`");
          while($zxfetch=mysqli_fetch_array($zxsql)){
            $refno=$zxfetch['refno'];
            $itemcode=$zxfetch['itemcode'];
            $productdesc=$zxfetch['productdesc'];
            $ptype=$zxfetch['ptype'];
            $trantype=$zxfetch['trantype'];
            $status=$zxfetch['status'];
            $resultstatus=$zxfetch['resultstatus'];
            $testdonedt=$zxfetch['testdonedt'];
            $labtype=$zxfetch['labtype'];
            $testno=$zxfetch['testno'];
            $station=$zxfetch['station'];
            $dateadded=$zxfetch['dateadded'];
            $timeadded=$zxfetch['timeadded'];
            $user=$zxfetch['user'];
            $viewcount=$zxfetch['viewcount'];
            $printcount=$zxfetch['printcount'];
            $verified=$zxfetch['verified'];
            $redit=$zxfetch['redit'];

            $zysql=mysqli_query($conn,"SELECT * FROM `productout` WHERE `refno`='$refno' AND `caseno`='$caseno' AND (`trantype`='charge' OR `trantype`='cash' OR `trantype`='CANCELLED')");
            if(mysqli_num_rows($zysql)==1){
              $zyfetch=mysqli_fetch_array($zysql);
              $approvalno=$zyfetch['approvalno'];
              $terminalname=$zyfetch['terminalname'];
              $prtype=$zyfetch['producttype'];
              $prstatus=$zyfetch['status'];
              $rmks=trim($zyfetch['remarks']);
              $prst=$zyfetch['terminalname'];
              $zx++;

              if($prst!=$resultstatus){$resultstatus=$prst;}

              if($prstatus!=$status){$status=$prstatus;}

              if((trim($rmks)=="")||($labtype=="")){
                $zksql=mysqli_query($conn,"SELECT `remarks`, `test` FROM `labtest` WHERE `refno`='$refno' AND `caseno`='$caseno'");
                if(mysqli_num_rows($zksql)>0){
                  $zkfetch=mysqli_fetch_array($zksql);
                  $rmks=trim($zkfetch['remarks']);
                  $labtype=$zkfetch['test'];
                }
              }

              if($rmks!=""){$rmks=" <span style='color: blue;'>($rmks)</span>";}

              if($labtype==""){$labtype=$prtype;}

              if($resultstatus!=$terminalname){$resultstatus=$terminalname;}

              if($approvalno=="FOR CANCEL"){$rqc=" <span class='blinkforme' style='padding: 5px 6px;color: #FF0000;font-size: 11px;border-radius: 10px;'>(For Delete)</span>";}else{$rqc="";}

              if($resultstatus=="Testdone"){$rstdisp="Test Done";}
              else if($resultstatus=="pending"){$rstdisp="Pending";}
              else if($resultstatus=="Testtobedone"){$rstdisp="Test to be Done";}
              else if($resultstatus=="refund"){$rstdisp="<span class='text-warning'>Request Refund</span>";}
              else if($resultstatus=="CANCELLED"){$rstdisp="<span class='text-danger'>Request Cancelled</span>";}
              else{$rstdisp=$resultstatus;}

              if(($status=="Approved")||($status=="PAID")){$trc="";}else{$trc="class='table-danger'";}

              if($status=="PAID"){
                $zvsql=mysqli_query($conn,"SELECT `ofr` FROM `collection` WHERE `refno`='$refno'");
                $zvcount=mysqli_num_rows($zvsql);

                if($zvcount==0){
                  $orno="";
                }
                else{
                  $zvfetch=mysqli_fetch_array($zvsql);
                  $orno=" <span style='color: blue;'>(".$zvfetch['ofr'].")</span>";
                }
              }
              else{
                $orno="";
              }

              $statusdisp=mb_strtoupper($status);
              $kcst=preg_split("/\-/",$caseno);

echo "
                    <tr $trc>
                      <td><div align='left'style='font-size: 13px;font-weight: bold;'>$zx</div></td>
                      <td><div align='left' style='font-size: 13px;font-weight: bold;'>$productdesc$rmks</div></td>
                      <td><div align='center' style='font-size: 13px;'>".$statusdisp.$orno."</div></td>
                      <td><div align='center' style='font-size: 13px;'>".date("M d, Y h:i A",strtotime("$dateadded $timeadded"))."</div></td>
                      <td><div align='center' style='font-size: 13px;font-weight: bold;'>$rstdisp$rqc</div></td>
                      <td><div align='center'>
                        <table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
";

              if(($resultstatus=="pending")||($resultstatus=="Testtobedone")){
                $agstart="<form method='post' target='_blank'><input type='hidden' name='stest' /><input type='hidden' name='srefno' value='$refno' /><input type='hidden' name='ltype' value='$labtype' />";
                $agend="</form>";

                if($resultstatus=="Testtobedone"){
                  if(($adstatus=="MGH")||($adstatus=="discharged")){
                    $xgstart="";
                    $xgend="";
                    $xgt="button";
                    $xgd=" disabled";
                    $xgwarn="";
                    $xgtitle="";
                    $xgicon="<i class='icofont-slack'></i>";
                  }
                  else{
                    $xgstart="<form method='post'><input type='hidden' name='cttb' /><input type='hidden' name='refno' value='$refno' /><input type='hidden' name='productdesc' value='$productdesc' />";
                    $xgend="</form>";
                    $xgt="submit";
                    $xgd="";
                    $xgwarn="Pending";
                    $xgtitle="Set Status to Pending";
                    $xgicon="<i class='icofont-touch'></i>";
                  }
                }
                else{
                  $xgstart="<form method='post'><input type='hidden' name='ttb' /><input type='hidden' name='refno' value='$refno' /><input type='hidden' name='productdesc' value='$productdesc' />";
                  $xgend="</form>";
                  $xgt="submit";
                  $xgd="";
                  $xgwarn="Test to be Done";
                  $xgtitle="Set Test to be Done";
                  $xgicon="<i class='icofont-hand-thunder'></i>";
                }

                if($status=="PAID"){
                  $ygstart="<form method='post'><input type='hidden' name='rfu' /><input type='hidden' name='refno' value='$refno' /><input type='hidden' name='productdesc' value='$productdesc' />";
                  $ygend="</form>";
                  $ygt="submit";
                  $ygd="";
echo "
                            <td>$agstart<button type='submit' class='btn btn-success text-white' title='Input Result/s'><i class='icofont-test-tube-alt'></i></button>$agend</td>
                            <td width='3'></td>
                            <td>$xgstart<button type='$xgt' class='btn btn-warning$xgd' ";?> onclick="return confirm('Set status of &quot;<?php echo "$productdesc"; ?>&quot; to <?php echo "$xgwarn?"; ?>');" <?php echo " title='$xgtitle' $xgd>$xgicon</button>$xgend</td>
";

                  if($adstatus!="discharged"){
echo "
                            <td width='3'></td>
                            <td>$ygstart<button type='$ygt' class='btn btn-danger$ygd'  ";?> onclick="return confirm('Request Refund for &quot;<?php echo "$productdesc"; ?>&quot;?');" <?php echo " title='Refund' $ygd><i class='icofont-ui-reply'></i></button>$ygend</td>
";
                  }
                  else{
echo "
                            <td width='3'></td>
                            <td><button type='button' class='btn btn-info disabled' title=''><i class='icofont-simple-smile'></i></button></td>
";
                  }
                }
                else if($status=="Approved"){
                  $ygstart="<form method='post'><input type='hidden' name='dli' /><input type='hidden' name='refno' value='$refno' /><input type='hidden' name='productdesc' value='$productdesc' />";
                  $ygend="</form>";
                  $ygt="submit";
                  $ygd="";
echo "
                            <td>$agstart<button type='submit' class='btn btn-success text-white' title='Input Result/s'><i class='icofont-test-tube-alt'></i></button>$agend</td>
                            <td width='3'></td>
                            <td>$xgstart<button type='$xgt' class='btn btn-warning$xgd' ";?> onclick="return confirm('Set status of &quot;<?php echo "$productdesc"; ?>&quot; to <?php echo "$xgwarn?"; ?>');" <?php echo " title='$xgtitle' $xgd>$xgicon</button>$xgend</td>
";

                  if($adstatus!="discharged"){
echo "
                            <td width='3'></td>
                            <td>$ygstart<button type='$ygt' class='btn btn-danger$ygd' ";?> onclick="return confirm('Cancel Request for &quot;<?php echo "$productdesc"; ?>&quot;?');" <?php echo " title='Cancel Request' $ygd><i class='icofont-bin'></i></button>$ygend</td>
";
                  }
                  else{
echo "
                            <td width='3'></td>
                            <td><button type='button' class='btn btn-info disabled' title=''><i class='icofont-simple-smile'></i></button></td>
";
                  }
                }
              }
              else{
                if($resultstatus=="Testdone"){
                  $zzsql=mysqli_query($conn,"SELECT * FROM `labresults` WHERE `refno`='$refno' LIMIT 0,1");
                  $zzcount=mysqli_num_rows($zzsql);

                  $elogs=0;
                  if($zzcount==0){
                    if(($labtype=="chemistry")||($labtype=="serology")){
                      if(stripos($caseno, "I-") !== FALSE){
                        $bgstart="<form method='get' target='_blank' action='http://".$_SERVER['HTTP_HOST']."/labprint/bloodchem.php'><input type='hidden' name='caseno' value='$caseno' /><input type='hidden' name='lab29' value='$refno' /><input type='hidden' name='testno' value='$testno' />$dat";
                        $bgend="</form>";
                      }
                      else{
                        $bgstart="<form method='get' target='_blank' action='http://".$_SERVER['HTTP_HOST']."/labprint/bloodchem_alt.php'><input type='hidden' name='caseno' value='$caseno' /><input type='hidden' name='lab29' value='$refno' /><input type='hidden' name='testno' value='$testno' />$dat";
                        $bgend="</form>";
                      }

                      $cgstart="<form method='get' target='_blank' action='http://".$_SERVER['HTTP_HOST']."/cgi-bin/bloodchem-update.cgi'><input type='hidden' name='caseno' value='$caseno' /><input type='hidden' name='lab29' value='$refno' /><input type='hidden' name='testno' value='$testno' />";
                      $cgend="</form>";
                    }
                    else{
                      if($labtype=="hematology"){
                        if(stripos($caseno, "I-") !== FALSE){
                          $bgstart="<form method='get' target='_blank' action='http://".$_SERVER['HTTP_HOST']."/labprint/hemabody.php'><input type='hidden' name='caseno' value='$caseno' /><input type='hidden' name='lab29' value='$refno' />$dat";
                          $bgend="</form>";
                        }
                        else{
                          $bgstart="<form method='get' target='_blank' action='http://".$_SERVER['HTTP_HOST']."/labprint/hemabody_alt2.php'><input type='hidden' name='caseno' value='$caseno' /><input type='hidden' name='lab29' value='$refno' />";
                          $bgend="</form>";
                        }

                        $cgstart="<form method='get' target='_blank' action='http://".$_SERVER['HTTP_HOST']."/cgi-bin/CBC-update.cgi'><input type='hidden' name='caseno' value='$caseno' /><input type='hidden' name='lab29' value='$refno' />";
                        $cgend="</form>";
                      }
                      else{
                        if(($productdesc=="Stool Exam")||($productdesc=="Stool Exam with Occult Blood")||($productdesc=="OCCULT BLOOD")){
                          if(stripos($caseno, "I-") !== FALSE){
                            $bgstart="<form method='get' target='_blank' action='http://".$_SERVER['HTTP_HOST']."/cgi-bin/fecalysis200.cgi'><input type='hidden' name='patient' value='$patient' /><input type='hidden' name='refno' value='$refno' />$dat";
                            $bgend="</form>";
                          }
                          else{
                            $bgstart="<form method='get' target='_blank' action='http://".$_SERVER['HTTP_HOST']."/cgi-bin/fecalysis200_alt.cgi'><input type='hidden' name='patient' value='$patient' /><input type='hidden' name='refno' value='$refno' />$dat";
                            $bgend="</form>";
                          }
                        }
                        else{
                          if(stripos($caseno, "I-") !== FALSE){
                            $bgstart="<form method='get' target='_blank' action='http://".$_SERVER['HTTP_HOST']."/labprint/$productdesc-body.php'><input type='hidden' name='caseno' value='$caseno' /><input type='hidden' name='refno' value='$refno' />$dat";
                            $bgend="</form>";
                          }
                          else{
                            $bgstart="<form method='get' target='_blank' action='http://".$_SERVER['HTTP_HOST']."/labprint/$productdesc-body_alt.php'><input type='hidden' name='caseno' value='$caseno' /><input type='hidden' name='refno' value='$refno' />$dat";
                            $bgend="</form>";
                          }
                        }

                        if($productdesc=="Widal Test"){
                          $cgstart="<form method='get' target='_blank' action='http://".$_SERVER['HTTP_HOST']."/cgi-bin/widaltest100.cgi'><input type='hidden' name='caseno' value='$caseno' /><input type='hidden' name='lab29' value='$refno' />";
                          $cgend="</form>";
                        }
                        else{
                          $cgstart="<form method='get' target='_blank' action='http://".$_SERVER['HTTP_HOST']."/cgi-bin/$productdesc.cgi'><input type='hidden' name='caseno' value='$caseno' /><input type='hidden' name='lab29' value='$refno' />";
                          $cgend="</form>";
                        }
                      }
                    }
                  }
                  else{
                    $zzfetch=mysqli_fetch_array($zzsql);
                    $zzlogs=trim($zzfetch['logs']);
                    if($zzlogs!=""){$elogs=1;}

                    $bgstart="<form method='get' target='_blank' action='../extra/LabExpress/PrintResult/'><input type='hidden' name='caseno' value='$caseno' /><input type='hidden' name='patid' value='$patientidno' /><input type='hidden' name='printbatchno' value='$testno' /><input type='hidden' name='stype' value='$labtype' /><input type='hidden' name='asd' value='".base64_decode($nm)."' />";
                    $bgend="</form>";
                    $cgstart="<form method='post' target='_blank'><input type='hidden' name='srefno' value='$refno' /><input type='hidden' name='ltype' value='$labtype' /><input type='hidden' name='eres' />";
                    $cgend="</form>";
                  }

echo "
                            <td>$bgstart<button type='submit' class='btn btn-secondary' title='Print Result'><i class='icofont-print'></i></button>$bgend</td>
";

                  if($adstatus!="discharged"){
echo "
                            <td width='3'></td>
                            <td>$cgstart<button type='submit' class='btn btn-primary' title='Edit Result'><i class='icofont-edit'></i></button>$cgend</td>
";
                  }
                  else{
                    if($kcst[0]=="R"){
echo "
                            <td width='3'></td>
                            <td>$cgstart<button type='submit' class='btn btn-primary' title='Edit Result'><i class='icofont-edit'></i></button>$cgend</td>
";
                    }
                    else{
echo "
                            <td width='3'></td>
                            <td><button type='button' class='btn btn-info disabled' title=''><i class='icofont-simple-smile'></i></button></td>
";
                    }
                  }

                  if($elogs==0){
echo "
                            <td width='3'></td>
                            <td><button type='button' class='btn btn-info disabled' title=''><i class='icofont-simple-smile'></i></button></td>
";
                  }
                  else{
echo "
                            <td width='3'></td>
                            <td><button type='button' class='btn btn-danger' style='color: #FFFFFF;' title='Result Edit Logs'";?> onclick="<?php echo "window.open('vieweditlogs.php?caseno=$caseno&refno=$refno', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=".($wid-200).",width=$setw,height=$seth');"; ?>" <?php echo "><i class='icofont-notebook'></i></button></td>
";
                  }

                }
                else{
                  if($resultstatus=="refund"){
                    $ygstart="<form method='post'><input type='hidden' name='crf' /><input type='hidden' name='refno' value='$refno' /><input type='hidden' name='productdesc' value='$productdesc' />";
                    $ygend="</form>";
                    $ygt="submit";
                    $ygd="";

echo "
                            <td><button type='button' class='btn btn-info disabled' title=''><i class='icofont-simple-smile'></i></button></td>
                            <td width='3'></td>
                            <td>$ygstart<button type='$ygt' class='btn btn-warning$ygd'";?> onclick="return confirm('Cancel Request Refund for &quot;<?php echo "$productdesc"; ?>&quot;?');" <?php echo " title='Cancel Request Refund' $ygd><i class='icofont-spinner-alt-5'></i></button>$ygend</td>
                            <td width='3'></td>
                            <td><button type='button' class='btn btn-info disabled' title=''><i class='icofont-simple-smile'></i></button></td>
";
                  }
                  else{
                    if($resultstatus=="CANCELLED"){
echo "
                            <td><button type='button' class='btn btn-info disabled' title=''><i class='icofont-simple-smile'></i></button></td>
                            <td width='3'></td>
                            <td><button type='button' class='btn btn-info disabled' title=''><i class='icofont-simple-smile'></i></button></td>
                            <td width='3'></td>
                            <td><button type='button' class='btn btn-danger' style='color: #FFFFFF;' title='Logs'";?> onclick="<?php echo "window.open('viewcancellogs.php?caseno=$caseno&refno=$refno', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=".($wid-200).",width=$setw,height=$seth');"; ?>" <?php echo "><i class='icofont-notebook'></i></button></td>
";
                    }
                    else{
echo "
                            <td></td>
";
                    }
                  }
                }
              }

echo "
                          </tr>
                        </table>
                      </div></td>
                    </tr>
";
            }
          }

echo "
                  </tbody>
                </table>
                <!-- Back to top button -->
              </div>
";
//--------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        }
      }
    }
  }
}

echo "
            </div>
          </div>
        </div><!-- Row End -->
      </div>
    </div>
";

//echo "<META HTTP-EQUIV='Refresh'CONTENT='1500;URL=Close.php'>";
?>
