<?php
  $clientProps=array('screen.width','screen.height','window.innerWidth','window.innerHeight',
    'window.outerWidth','window.outerHeight','screen.colorDepth','screen.pixelDepth');

  if(! isset($_POST['screenheight'])){

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

  //---------------------------------------------
  $setw=400;
  $wid=round(($scw-$setw)/2);

  $seth=200;
  $hei=round(($sch-$seth)/2)-100;
  //---------------------------------------------
?>
<script>
    window.history.replaceState(null,null); //avoid form warning if user clicks refresh
</script>

<?php
ini_set("display_errors","On");
include("../Settings.php");
//include("../Resources/CSS/divstyle.php");
$cuz = new database();
$setip=$cuz->setIP();

mysqli_query($mycon1,"SET NAMES 'utf8'");

$caseno=mysqli_real_escape_string($mycon1,$_GET['caseno']);
$user=mysqli_real_escape_string($mycon1,$_GET['user']);
$dept=mysqli_real_escape_string($mycon1,$_GET['dept']);

//HEADING
$asql=mysqli_query($mycon1,"SELECT * FROM `heading`");
$afetch=mysqli_fetch_array($asql);
$heading=$afetch['heading'];
$hadd=$afetch['address'];
$htelno=$afetch['telno'];

//USERDETAILS
$bsql=mysqli_query($mycon1,"SELECT * FROM `nsauth` WHERE `username`='".base64_decode($user)."' AND `station`='$dept'");
$bfetch=mysqli_fetch_array($bsql);
$name=$bfetch['name'];
$uname=$bfetch['username'];
$upass=$bfetch['password'];

if(!isset($COOKIE['billname'])){setcookie("billname", $name, time() + 28800, "/");}
if(!isset($COOKIE['billuser'])){setcookie("billuser", $uname, time() + 28800, "/");}
if(!isset($COOKIE['billpass'])){setcookie("billpass", $upass, time() + 28800, "/");}

//ADMISSION TABLE
$csql=mysqli_query($mycon1,"SELECT * FROM `admission` WHERE `caseno`='$caseno'");
$cfetch=mysqli_fetch_array($csql);
$patientidno=$cfetch['patientidno'];
$type=$cfetch['type'];
$membership=$cfetch['membership'];
$hmomembership=$cfetch['hmomembership'];
$sethmo=$cfetch['hmo'];
$policyno=$cfetch['policyno'];
$paymentmode=$cfetch['paymentmode'];
$room=strtoupper($cfetch['room']);
$ward=$cfetch['ward'];
$street=strtoupper($cfetch['street']);
$barangay=strtoupper($cfetch['barangay']);
$municipality=strtoupper($cfetch['municipality']);
$province=strtoupper($cfetch['province']);
$zipcode=$cfetch['zipcode'];
$ap=strtoupper($cfetch['ap']);
$finaldiagnosis=strtoupper($cfetch['finaldiagnosis']);
$dateadmit=$cfetch['dateadmit'];
$timeadmitted=$cfetch['timeadmitted'];
$complied=$cfetch['identity'];
$result=$cfetch['result'];
$status=$cfetch['status'];
$employerno=$cfetch['employerno'];

$dtadm=$dateadmit." ".$timeadmitted;

if($membership=="phic-med"){
  $phic="ACTIVE";
}
else{
  $phic="NONE";
}

if($complied=="Complied"){
  $warning2="PHIC Document already complied.";
  $color2="style='color:blue'";
}else{
  $warning2="PHIC Document not yet complied!";
  $color2="style='color:red'";
}

$pataddress=$street." ".$barangay." ".$municipality." ".$province." ".$zipcode;

//CASE RATES
$dsql=mysqli_query($mycon1,"SELECT * FROM `finalcaserate` WHERE `caseno`='$caseno' AND `level`='primary'");
$dcount=mysqli_num_rows($dsql);
if($dcount!=0){
  $dfetch=mysqli_fetch_array($dsql);
  $crcode1=$dfetch['icdcode'];
  $h1=$dfetch['hospitalshare'];
  $p1=$dfetch['pfshare'];
}
else{
  $crcode1="&nbsp;";
  $h1="0";
  $p1="0";
}

$esql=mysqli_query($mycon1,"SELECT * FROM `finalcaserate` WHERE `caseno`='$caseno' AND `level`='secondary'");
$ecount=mysqli_num_rows($esql);
if($ecount!=0){
  $efetch=mysqli_fetch_array($esql);
  $crcode2=$efetch['icdcode'];
  $h2=$efetch['hospitalshare'];
  $p2=$efetch['pfshare'];
}
else{
  $crcode2="";
  $h2="0";
  $p2="0";
}

//PATIENT PROFILE
$kprosql=mysqli_query($mycon1,"SELECT * FROM `patientprofile` WHERE `patientidno`='$patientidno'");
$kprocount=mysqli_num_rows($kprosql);

if($kprocount!=0){
  $dsql=mysqli_query($mycon1,"SELECT * FROM `patientprofile` WHERE `patientidno`='$patientidno'");
  $dfetch=mysqli_fetch_array($dsql);
  $lastname=strtoupper($dfetch['lastname']);
  $firstname=strtoupper($dfetch['firstname']);
  $middlename=strtoupper($dfetch['middlename']);
  $suffix=strtoupper($dfetch['suffix']);
  $birthdate=$dfetch['birthdate'];
  $age=$dfetch['age'];
  $sex=$dfetch['sex'];
  $senior=$dfetch['senior'];
  $patientname=$dfetch['patientname'];
  $dateofbirth=$dfetch['dateofbirth'];
}
else{
  $dsql=mysqli_query($mycon1,"select UPPER(lastname) as lastname,UPPER(firstname) as firstname,UPPER(middlename) as middlename,age,UPPER(gender) as sex,birthdate from nsauthemployees where empid = '$patientidno'");
  $dfetch=mysqli_fetch_array($dsql);
  $lastname=$dfetch['lastname'];
  $firstname=$dfetch['firstname'];
  $middlename=$dfetch['middlename'];
  $suffix="";
  $birthdate=$dfetch['birthdate'];
  $sex=$dfetch['sex'];
  $senior="N";
  $patientname=$lastname." ".$firstname." ".$middlename;
  $dateofbirth=$dfetch['birthdate'];

  $datetoday=date("Y-m-d");
  $today = date("Y-m-d",strtotime($birthdate));
  $diff = date_diff(date_create($datetoday), date_create($today));
  $age=$diff->format('%y');
}

$patname=$lastname.", ".$firstname." ".$suffix." ".$middlename;

$patient=$patientname."_".$caseno;

//SOA Details--------------------------------------------------------------------------------------
$sdfsql=mysqli_query($mycon1,"SELECT * FROM soadetails WHERE caseno='$caseno'");
$sdfcount=mysqli_num_rows($sdfsql);
if($sdfcount==0){
  $d1="";
  $d2="";
  $d3="";
  $c1="";
  $c2="";
}
else{
  $sdffetch=mysqli_fetch_array($sdfsql);
  $d1=strtoupper($sdffetch['d1']);
  $d2=strtoupper($sdffetch['d2']);
  $d3=strtoupper($sdffetch['d3']);
  $c1=strtoupper($sdffetch['c1']);
  $c2=strtoupper($sdffetch['c2']);
}

if($c1==""){
  $c1disp="";
}
else{
  $c1disp=" --> ".$c1;
}

if($c2==""){
  $c2disp="";
}
else{
  $c2disp=" --> ".$c2;
}
//End SOA Details----------------------------------------------------------------------------------

//-------------------------------------------------------------------------------------------------
$setusql=mysqli_query($mycon1,"SELECT * FROM setuser WHERE caseno='$caseno'");
$setucount=mysqli_num_rows($setusql);
if($setucount==0){
  $nsusql=mysqli_query($mycon1,"SELECT `name` FROM `nsauth` WHERE `username`='".base64_decode($user)."' AND `station`='$dept'");
  $nsucount=mysqli_num_rows($nsusql);
  if($nsucount==0){
    $setuser="";
  }
  else{
    $nsufetch=mysqli_fetch_array($nsusql);
    $setuser=strtoupper($nsufetch['name']);
  }
}
else{
while($setufetch=mysqli_fetch_array($setusql)){$setuname=$setufetch['name'];}
  if($setuname==""){
    $nsusql=mysqli_query($mycon1,"SELECT `name` FROM `nsauth`='".base64_decode($user)."' AND `station`='$dept'");
    $nsucount=mysqli_num_rows($nsusql);
    if($nsucount==0){
      $setuser="";
    }
    else{
      $nsufetch=mysqli_fetch_array($nsusql);
      $setuser=strtoupper($nsufetch['name']);
    }
  }
  else{
    $setuser=strtoupper($setuname);
  }
}
//-------------------------------------------------------------------------------------------------

//-------------------------------------------------------------------------------------------------
$cimisql=mysqli_query($mycon1,"SELECT * FROM claiminfomoreinfo WHERE caseno='$caseno'");
$cimicount=mysqli_num_rows($cimisql);
if($cimicount==0){
$membersuffix="";
$memberbday="";
$membergender="";
$rtm="";
$comchoose="M";
$comname="";
$comcontact="";
$comdatesigned="";
$comrelation="";
$comrelationos="";
$comreason="";
$comreasonos="";
$comuw="";
$emppen="";
$empbusinessname="";
$empname="";
$empcontactno="";
$empsigdesignation="";
$empdatesigned="";
$carchoose="";
$carname="";
$cardatesigned="";
$carrelation="";
$carrelationos="";
$carreason="";
$carreasonos="";
$caruw="";
$hcirep="";
$hcidesignation="";
$hcidatesigned="";
}
else{
while($cimifetch=mysqli_fetch_array($cimisql)){
$membersuffix=$cimifetch['membersuffix'];
$memberbday=$cimifetch['memberbday'];
$membergender=$cimifetch['membergender'];
$rtm=$cimifetch['rtm'];
$comchoose=$cimifetch['comchoose'];
$comname=strtoupper($cimifetch['comname']);
$comcontact=strtoupper($cimifetch['comcontact']);
//$comdatesigned=$cimifetch['comdatesigned'];

$comdatesigned = date("M d, Y");
$comrelation=$cimifetch['comrelation'];
$comrelationos=strtoupper($cimifetch['comrelationos']);
$comreason=$cimifetch['comreason'];
$comreasonos=strtoupper($cimifetch['comreasonos']);
$comuw=$cimifetch['comuw'];
$emppen=$cimifetch['emppen'];
$empbusinessname=strtoupper($cimifetch['empbusinessname']);
$empname=strtoupper($cimifetch['empname']);
$empcontactno=$cimifetch['empcontactno'];
$empsigdesignation=strtoupper($cimifetch['empsigdesignation']);
$empdatesigned=$cimifetch['empdatesigned'];
$carchoose=$cimifetch['carchoose'];
$carname=strtoupper($cimifetch['carname']);
$cardatesigned=$cimifetch['cardatesigned'];
$carrelation=$cimifetch['carrelation'];
$carrelationos=strtoupper($cimifetch['carrelationos']);
$carreason=$cimifetch['carreason'];
$carreasonos=strtoupper($cimifetch['carreasonos']);
$caruw=$cimifetch['caruw'];
$hcirep=$cimifetch['hcirep'];
$hcidesignation=$cimifetch['hcidesignation'];
$hcidatesigned=$cimifetch['hcidatesigned'];
}
}

$cfsql=mysqli_query($mycon1,"SELECT lastname, firstname, middlename FROM claiminfo WHERE patientidno='$patientidno' AND caseno='$caseno'");
$cfcount=mysqli_num_rows($cfsql);

if($cfcount==0){
$mlname="";
$mfname="";
$mmname="";
}
else{
while($cffetch=mysqli_fetch_array($cfsql)){
$mlname=strtoupper($cffetch['lastname']);
$mfname=strtoupper($cffetch['firstname']);
$mmname=strtoupper($cffetch['middlename']);
}
}

if($comchoose=="M"){$signame=$mfname." ".$mmname." ".$mlname." ".$membersuffix;}else{$signame=$comname;}

if($comrelation=="Others"){$comrel=$comrelationos;}else{$comrel=$comrelation;}
//-------------------------------------------------------------------------------------------------

//dischargetable-----------------------------------------------------------------------------------
$dtsql=mysqli_query($mycon1,"SELECT `datedischarged`, `timedischarged` FROM `dischargedtable` WHERE `caseno`='$caseno'");
$dtcount=mysqli_num_rows($dtsql);

if($dtcount==0){
  $tdssql=mysqli_query($mycon1,"SELECT `date`, `time` FROM `tempdatestorage` WHERE `caseno`='$caseno'");
  $tdscount=mysqli_num_rows($tdssql);

  if($tdscount==0){
    $dtddis="";
  }
  else{
    $tdsfetch=mysqli_fetch_array($tdssql);
    $tdsdate=$tdsfetch['date'];
    $tdstime=$tdsfetch['time'];

    if($tdsdate==""){
      $dtddis="";
    }
    else{
      $dtddis="";
    }
  }
}
else{
  $dtfetch=mysqli_fetch_array($dtsql);
  $datedischarged=$dtfetch['datedischarged'];
  $datedischarged=str_replace("_","-",$datedischarged);
  $timedischarged=$dtfetch['timedischarged'];

  $dtdis=$datedischarged." ".$timedischarged;

  $dtddis=date("M d, Y h:i A",strtotime($dtdis));
}
//-------------------------------------------------------------------------------------------------
?>
