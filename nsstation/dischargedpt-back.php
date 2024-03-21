<?php
include('../Auth/config.php');
$case=$_POST['caseno'];
$caseno = $case;
$nursename=$_POST['nursename'];
$datedischarged=$_POST['datedischarged'];
$timedischarged=$_POST['timedischarged'];

$sqlStatus=mysqli_query($con,"SELECT * FROM admission WHERE caseno='$caseno'");
$f=mysqli_fetch_array($sqlStatus);
$stat=$f['status'];
if($stat=="MGH"){
$Query=mysqli_query($con,"delete from statementproductoutslash where caseno='$case'");
$Query=mysqli_query($con,"delete from statementproductout where caseno='$case'");





// ---------------------------------------------------- Arvid 05-13-2021 For Doctor's PF ------------------------------------------------
include('../Auth/connect.php');
header('content-type: text/html; charset: utf-8');
$sql = "SELECT * FROM pf_payables where caseno='$caseno'";
$result = $conn->query($sql);
$pfcheck = mysqli_num_rows($result);


if($pfcheck>0){
// ------------------------------ UPDATE EXISTING/ ADD NEW (RE-OPEN ACCOUNT) ----------------------------
$sql2 = "SELECT * FROM productout where caseno='$caseno' and productsubtype='PROFESSIONAL FEE'";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$producttype1=$row2['producttype'];
$phic1=$row2['phic'];
$hmo1=$row2['hmo'];
$excess1=$row2['excess'];
$pdesc=$row2['productdesc'];
$refno11=$row2['refno'];
$datep = date('M-d-Y');

$sql22 = "SELECT * FROM admission, patientprofile where admission.patientidno=patientprofile.patientidno and admission.caseno='$caseno'";
$result22 = $conn->query($sql22);
while($row22 = $result22->fetch_assoc()) {
$lname11 = $row22['lastname'];
$fname11 = $row22['firstname'];
$mname11 = $row22['middlename'];
$hmocomp11 = $row22['hmo'];
$hmocompmem11 = $row22['hmomembership'];
$pname = $lname11.", ".$fname11." ".$mname11;
}

$doccode="";
$sql222xx = "SELECT * FROM docfile where name like '%$pdesc%'";
$result222xx = $conn->query($sql222xx);
while($row222xx = $result222xx->fetch_assoc()) {
$doccode = $row222xx['code'];
}

$sql222xxx = "SELECT * FROM pf_payables where doctorid = '$doccode' and refno='$refno11'";
$result222xxx = $conn->query($sql222xxx);
$countdoc = mysqli_num_rows($result222xxx);

if($countdoc>0){
while($row222xxx = $result222xxx->fetch_assoc()) {
$id = $row222xxx['id'];
$company = $row222xxx['company'];

if($company=="CASH"){
$sqlxx = "update pf_payables set gross='$excess1', tax='0', netexcess='$excess1' where id = '$id'";
if($conn->query($sqlxx) === TRUE) {$z++;}
}

elseif($company=="PHIC"){
$sqlxx = "update pf_payables set gross='$phic1', tax='0', netexcess='$phic1' where id = '$id'";
if($conn->query($sqlxx) === TRUE) {$z++;}
}

else{
$sqlxx = "update pf_payables set gross='$hmo1', tax='0', netexcess='$hmo1' where id = '$id'";
if($conn->query($sqlxx) === TRUE) {$z++;}
}
}

}else{

if($phic1>0){
$sqlxx = "INSERT INTO `pf_payables`(`refno`, `caseno`, `patientname`, `doctorid`, `doctorname`, `dateposted`, `datearray`, `company`, `companytype`,
 `gross`, `tax`, `netexcess`, `producttype`, `status`, `branch`, `remarks`) values
 ('$refno11','$caseno','$pname','$doccode','$pdesc','$datep',CURDATE(),'PHIC','PHIC-MED','$phic1','0','$phic1','$producttype1',
 'pending','$branch','')";
if($conn->query($sqlxx) === TRUE) {$z++;}
}

if($hmo1>0){
$sqlxx = "INSERT INTO `pf_payables`(`refno`, `caseno`, `patientname`, `doctorid`, `doctorname`, `dateposted`, `datearray`, `company`, `companytype`,
 `gross`, `tax`, `netexcess`, `producttype`, `status`, `branch`, `remarks`) values
 ('$refno11','$caseno','$pname','$doccode','$pdesc','$datep',CURDATE(),'$hmocomp11','$hmocompmem11','$hmo1','0','$hmo1','$producttype1',
 'pending','$branch','')";
if($conn->query($sqlxx) === TRUE) {$z++;}
}

if($excess1>0){
$sqlxx = "INSERT INTO `pf_payables`(`refno`, `caseno`, `patientname`, `doctorid`, `doctorname`, `dateposted`, `datearray`, `company`, `companytype`,
 `gross`, `tax`, `netexcess`, `producttype`, `status`, `branch`, `remarks`) values
 ('$refno11','$caseno','$pname','$doccode','$pdesc','$datep',CURDATE(),'CASH','NONE','$excess1','0','$excess1','$producttype1',
 'pending','$branch','')";
if($conn->query($sqlxx) === TRUE) {$z++;}
}
}
}
// ------------------------------ END UPDATE EXISTING/ ADD NEW (RE-OPEN ACCOUNT) ----------------------------
}else{
// ------------------------------ INSERT DOCTOR (NEW DISCHARGED ----------------------------
$sql2 = "SELECT * FROM productout where caseno='$caseno' and productsubtype='PROFESSIONAL FEE'";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$producttype1=$row2['producttype'];
$phic1=$row2['phic'];
$hmo1=$row2['hmo'];
$excess1=$row2['excess'];
$pdesc=$row2['productdesc'];
$iz++;
$refno11=$row2['refno'];
$datep = date('M-d-Y');

$sql22 = "SELECT * FROM admission, patientprofile where admission.patientidno=patientprofile.patientidno and admission.caseno='$caseno'";
$result22 = $conn->query($sql22);
while($row22 = $result22->fetch_assoc()) {
$lname11 = $row22['lastname'];
$fname11 = $row22['firstname'];
$mname11 = $row22['middlename'];
$hmocomp11 = $row22['hmo'];
$hmocompmem11 = $row22['hmomembership'];
$pname = $lname11.", ".$fname11." ".$mname11;
}

$doccode="";
$sql222 = "SELECT * FROM docfile where name like '%$pdesc%'";
$result222 = $conn->query($sql222);
while($row222 = $result222->fetch_assoc()) {
$doccode = $row222['code'];
}


if($phic1>0){
$sqlxx = "INSERT INTO `pf_payables`(`refno`, `caseno`, `patientname`, `doctorid`, `doctorname`, `dateposted`, `datearray`, `company`, `companytype`,
 `gross`, `tax`, `netexcess`, `producttype`, `status`, `branch`, `remarks`) values
 ('$refno11','$caseno','$pname','$doccode','$pdesc','$datep',CURDATE(),'PHIC','PHIC-MED','$phic1','0','$phic1','$producttype1',
 'pending','$branch','')";
if($conn->query($sqlxx) === TRUE) {$z++;}
}
if($hmo1>0){
$sqlxx = "INSERT INTO `pf_payables`(`refno`, `caseno`, `patientname`, `doctorid`, `doctorname`, `dateposted`, `datearray`, `company`, `companytype`,
 `gross`, `tax`, `netexcess`, `producttype`, `status`, `branch`, `remarks`) values
 ('$refno11','$caseno','$pname','$doccode','$pdesc','$datep',CURDATE(),'$hmocomp11','$hmocompmem11','$hmo1','0','$hmo1','$producttype1',
 'pending','$branch','')";
if($conn->query($sqlxx) === TRUE) {$z++;}
}

if($excess1>0){
$sqlxx = "INSERT INTO `pf_payables`(`refno`, `caseno`, `patientname`, `doctorid`, `doctorname`, `dateposted`, `datearray`, `company`, `companytype`,
 `gross`, `tax`, `netexcess`, `producttype`, `status`, `branch`, `remarks`) values
 ('$refno11','$caseno','$pname','$doccode','$pdesc','$datep',CURDATE(),'CASH','NONE','$excess1','0','$excess1','$producttype1',
 'pending','$branch','')";
if($conn->query($sqlxx) === TRUE) {$z++;}
}
}

// ------------------------------ END INSERT DOCTOR (NEW DISCHARGED ----------------------------
}



// ------------------------------ DISCHARGED PT IN OPERATING ROOM ----------------------------
$sqlxxx = "UPDATE ORSCHEDULE SET status='DISCHARGED' WHERE caseno='$caseno'";
if($conn->query($sqlxxx) === TRUE) {$z++;}
// ----------------------- END OF DISCHARGED PT IN OPERATING ROOM ----------------------------
}
// -------------------------------------------------------END Arvid update 05-13-2021 ----------------------------------------------------------

















include('../Auth/config.php');
$sqlPatient=mysqli_query($con,"SELECT a.*,pp.* FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE a.caseno='$case'");
if(mysqli_num_rows($sqlPatient)>0){
  $patient=mysqli_fetch_array($sqlPatient);
  $patientidno = $patient['patientidno'];
  $caseno=  $patient['caseno'];
  $member=$patient['paymentmode'];
  $membership = $patient['membership'];
  $hmomembership = $patient['hmomembership'];
  $hmo = $patient['hmo'];
  $roomno = $patient['room'];
  $ward = $patient['ward'];
  $street = $patient['street'];
  $barangay = $patient['barangay'];
  $municipality = $patient['municipality'];
  $province = $patient['province'];
  $initialdiagnosis = $patient['initialdiagnosis'];
  $ap = $patient['ap'];
  $dateadmitted = $patient['dateadmitted'];
  $dateadmit = $patient['dateadmit'];
  $branch = $patient['branch'];
  $age = $patient['age'];
  $lastname = $patient['lastname'];
  $firstname = $patient['firstname'];
  $middlename = $patient['middlename'];
  $senior = $patient['senior'];
  $patientname=$lastname." ".$firstname." ".$middlename;
  $disposition=$patient['disposition'];
  $patientadmit=$patient['patientadmit'];
  $statusAdmit=$patient['status'];
}
if($statusAdmit=="MGH"){
$date1=new DateTime($dateadmit);
$date2=new DateTime($datedischarged);

if ($member=="Member") {
$NHIP= "1";
$NONNHIP= "0";
$member="NHIP";
}else{
$NONNHIP= "1";
$NHIP= "0";
$member="NONNHIP";
}

$Query=mysqli_query($con,"delete from incensus where caseno='$case'");
$Query=mysqli_query($con,"select date  from wholeyear  where  date  between  '$dateadmit'  and '$datedischarged'  and date not like '%$datedischarged%'  group by date");
if(mysqli_num_rows($Query)>0){
  $d=mysqli_fetch_array($Query);
  $date100=$d['date'];
}

$Query=mysqli_query($con,"insert into incensus values('$case','$NHIP','$NONNHIP','$date100','$branch','$member','')");
$Query=mysqli_query($con,"delete from incensusdis where caseno='$case'");
$Query=mysqli_query($con,"insert into incensusdis values('$case','$NHIP','$NONNHIP','$date100','$branch','$member')");

$Query=mysqli_query($con,"select sum(hmo) totalhmo from productout where caseno = '$case' and trantype = 'charge' and trantype not like '%OFFSET%' and productcode not like '%N/A%' and producttype not like '%READERS FEE%' and producttype not like '%PAYMENT OF%'");
if(mysqli_num_rows($Query)>0){
  $d=mysqli_fetch_array($Query);
  $totalhmo=$d['totalhmo'];
}

$Query=mysqli_query($con,"select sum(phic) as total from productout where caseno = '$case'   and productcode not like '%N/A%' and productsubtype not like '%READERS FEE%' AND productsubtype not like '%CT CONTRAST%' and producttype not like '%PAYMENT OF%'");
if(mysqli_num_rows($Query)>0){
  $d=mysqli_fetch_array($Query);
  $grosstotalphic=$d['total'];
}

$Query=mysqli_query($con,"select sum(hmo) as totalhmo from productout where caseno = '$case' and trantype = 'charge'  and productsubtype not like '%PROFESSIONAL FEE%'");
if(mysqli_num_rows($Query)>0){
  $d=mysqli_fetch_array($Query);
  $grosstotalhmo=$d['totalhmo'];
}

$Query=mysqli_query($con,"select sum(hmo) as totalhmopf from productout where caseno = '$case' and trantype = 'charge'  and productsubtype  like '%PROFESSIONAL FEE%' and producttype not like '%PAYMENT OF%'");
if(mysqli_num_rows($Query)>0){
  $d=mysqli_fetch_array($Query);
  $grosstotalhmopf=$d['totalhmopf'];
}

$Query=mysqli_query($con,"select sum(hmo) as totalhmopf from productout where caseno = '$case' and trantype = 'charge' and productcode not like '%N/A%' and producttype not like '%PAYMENT OF%'");
if(mysqli_num_rows($Query)>0){
  $d=mysqli_fetch_array($Query);
  $totalhmo1=$d['totalhmopf'];
}

$Query=mysqli_query($con,"select sum(hospitalshare) as hospitalshare,sum(pfshare) as pfshare,caseno from finalcaserate where caseno = '$case' and (level='primary'  or level='related procedure') group by caseno");
if(mysqli_num_rows($Query)>0){
  $d=mysqli_fetch_array($Query);
  $hospitalshare = $d['hospitalshare'];
  $pfshare = $d['pfshare'];
  $caseno100=$d['caseno'];
  $totalcaserate=$hospitalshare+$pfshare;
}

$date=date('M-d-Y',strtotime($datedischarged));
$tim=date('H:i:s',strtotime($timedischarged));
$QueryDischarged=mysqli_query($con,"INSERT INTO dischargedtable values('$case','$patientname','$date','$timedischarged','UNDONE','UNDONE','U','0','$grosstotalphic','$totalcaserate','U','UNDONE','$grosstotalhmo','0','0','1','0','UNDONE','$grosstotalhmopf','$ward','$datedischarged','1','$branch')");
$Query=mysqli_query($con,"INSERT INTO dischargedtablepaid values('$case','$patientname','$date','$timedischarged','UNDONE','UNDONE','U','0','$grosstotalphic','$totalcaserate','U','UNDONE','$grosstotalhmo','0','0','1','0','UNDONE','$grosstotalhmopf','$ward','$datedischarged','1','$branch','')");

//$Query=mysqli_query($con,"update productout set invno='$timedischarged' where  caseno = '$case'");
$Query=mysqli_query($con,"update productout set producttype='manual' where  caseno = '$case' and productsubtype='ROOM ACCOMODATION'");
$Query=mysqli_query($con,"update room set roomstat='vacant' where room = '$roomno' AND branch='$branch'");
$Query=mysqli_query($con,"update admission set ward ='discharged',status='discharged'  where  caseno = '$case'");
$Query=mysqli_query($con,"update admissionicd set datedischarged='$datedischarged',type='$membership' where caseno = '$case'");

$Query=mysqli_query($con,"delete from statementadmission where caseno='$case'");

$Query=mysqli_query($con,"select sum(sellingprice * quantity) as totalbill,sum(hmo) as totalhmo,sum(phic) as totalphic,sum(adjustment) as senior,sum(excess) as totalexcess from productout where caseno = '$case'         and (trantype ='charge'  or  trantype ='ISSUED'   OR  trantype ='extinguish' )   AND productcode not like '%N/A%' and trantype not like '%RETURN%' and trantype not like '%OFFSET%' and trantype not like '%REVENUE%' and producttype not like '%PAYMENT OF%' and producttype not like '%READERS FEE%'   and producttype not like '%CT CONTRAST%'");
if(mysqli_num_rows($Query)>0){
  $d=mysqli_fetch_array($Query);
  $totalbill = $d['totalbill'];
  $totalhmo = $d['totalhmo'];

  $totalphic = $d['totalphic'];
  $senior= $d['senior'];

  $totalexcess = $d['excess'];

  if ($timedischarged >= "00:00:01" && $timedischarged <= "13:00:00") {


  $shift = "1";

  }



  if ($timedischarged >= "13:00:01" && $timedischarged <= "21:00:00") {


  $shift = "2";

  }

  if ($timedischarged >="21:00:01" && $timedischarged <= "23:59:59") {


  $shift = "3";
}
}
$Query1=mysqli_query($con,"INSERT INTO dischargedby  values('$case','$nursename','$totalbill','$senior','$totalhmo','$totalphic','$totalexcess','$totalcaserate','$hmo','$lastname','$firstname','$roomno','$membership','$datedischarged','$timedischarged','$branch','$shift','1')");

if($QueryDischarged && $Query1){
//==========================================EMR STATS HERE=======================================================
$sqlPatient=mysqli_query($con,"SELECT a.*,pp.* FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE a.caseno='$case'");
if(mysqli_num_rows($sqlPatient)>0){
  $patient=mysqli_fetch_array($sqlPatient);
  $patientidno = $patient['patientidno'];
  $caseno=  $patient['caseno'];
  $member=$patient['paymentmode'];
  $membership = $patient['membership'];
  $hmomembership = $patient['hmomembership'];
  $hmo = $patient['hmo'];
  $roomno = $patient['room'];
  $ward = $patient['ward'];
  $street = $patient['street'];
  $barangay = $patient['barangay'];
  $municipality = $patient['municipality'];
  $province = $patient['province'];
  $initialdiagnosis = $patient['initialdiagnosis'];
  $ap = $patient['ap'];
  $dateadmitted = $patient['dateadmitted'];
  $dateadmit = $patient['dateadmit'];
  $branch = $patient['branch'];
  $age = $patient['age'];
  $lastname = $patient['lastname'];
  $firstname = $patient['firstname'];
  $middlename = $patient['middlename'];
  $senior = $patient['senior'];
  $patientname=$lastname." ".$firstname." ".$middlename;
  $disposition=$patient['disposition'];
  $patientadmit=$patient['patientadmit'];
}
$reportingyear=date('Y');
if ($ward=="discharged") {

$Query=mysqli_query($conEMR,"select hfhudcode from genInfoClassification");
if(mysqli_num_rows($Query)>0){
  $d=mysqli_fetch_array($Query);
  $hfhudcode = $d['hfhudcode'];
}

$Query=mysqli_query($conEMR,"select tscode,doctor  from specialtycaseno where caseno = '$case'");
if(mysqli_num_rows($Query)>0){
  $d=mysqli_fetch_array($Query);
  $tscode1 = $d['tscode'];
  $doctor= $d['doctor'];
}

$Query=mysqli_query($conEMR,"select name  from docfile where code= '$doctor'");
if(mysqli_num_rows($Query)>0){
  $d=mysqli_fetch_array($Query);
  $productcode = $d['name'];
}

$Query=mysqli_query($con,"select producttype  from productout where caseno = '$case' and productcode='$productcode'");
if(mysqli_num_rows($Query)>0){
  $d=mysqli_fetch_array($Query);
  $producttype = $d['producttype'];
}
$Query=mysqli_query($con,"SELECT tod from docfile  where code='$doctor'");
if(mysqli_num_rows($Query)>0){
  $d=mysqli_fetch_array($Query);
  $othertypeofservicespecify = $d['tod'];
}

$Query=mysqli_query($con,"select  tscode,tsdesc  from  rtservice  where tscode='$tscode1'");
if(mysqli_num_rows($Query)>0){
  $d=mysqli_fetch_array($Query);
  $tscode = $d['tscode'];
  $tsdesc = $d['tsdesc'];
}

$days=$date2->diff($date1);
$totallengthstay=$days->d;

if ($membership=="Nonmed-none" && $hmomembership=="none") {
$nppay= "1";
$nphtotal= "1";

$phpay= "0";
$phtotal= "0";
$hmo= "0";

}

if ($membership=="phic-med") {
$nppay= "0";
$nphtotal= "0";

$phpay= "1";
$phtotal= "1";
$hmo= "0";

}
if (($membership=="Nonmed-none" && $hmomembership=="hmo-hmo") || ($membership=="Nonmed-none" && $hmomembership=="hmo-hmo")) {
$nppay= "0";
$nphtotal= "0";

$phpay= "0";
$phtotal= "0";
$hmo= "1";

}

if ($disposition=="RECOVERED") {
$recoveredimproved= "1";
$transferred= "0";
$hama= "0";
$absconded= "0";
$unimproved= "0";
$totaldeaths= "0";
$nopatients= "1";

$totaldischarges = "1";

}
if ($disposition=="IMPROVED") {
$recoveredimproved= "1";
$transferred= "0";

$hama= "0";
$absconded= "0";
$unimproved= "0";
$totaldeaths= "0";
$totaldischarges = "1";
$nopatients= "1";
}
if ($disposition=="HAMA") {
$recoveredimproved= "0";
$transferred= "0";
$hama= "1";$nopatients= "1";
$absconded= "0";
$unimproved= "0";
$totaldeaths= "0";
$totaldischarges = "1";
$nopatients= "1";
}
if ($disposition=="ABSCONDED") {
$recoveredimproved= "0";
$transferred= "0";
$hama= "0";
$absconded= "1";
$unimproved= "0";
$totaldeaths= "0";
$totaldischarges = "1";
$nopatients= "1";
}

if ($disposition=="UNIMPROVED") {
$recoveredimproved= "0";
$transferred= "0";
$hama= "0";
$absconded= "0";
$unimproved= "1";
$totaldeaths= "0";
$totaldischarges = "1";
$nopatients= "1";
}
if ($disposition=="TRANSFERRED") {

 $transferred= "1";
$nopatients= "1";
$totaldischarges = "1";
$recoveredimproved= "0";

$hama= "0";
$absconded= "0";
$unimproved= "0";
$totaldeaths= "0";

}


if ($disposition=="DIED") {
$recoveredimproved= "0";
$transferred= "0";
$hama= "0";
$absconded= "0";
$unimproved= "0";
$totaldeaths= "1";
$totaldischarges = "1";
$nopatients= "1";

##################################
if ($totallengthstay  <  2) {
$deathsbelow48 = "1";
$deathsover48 = "0";
}


##################################
if ($totallengthstay  >= 2) {
$deathsbelow48 = "0";
$deathsover48 = "1";
}


  $SQLstatement = mysqli_query($conEMR,"select typeofdeath from typeofdeath where patientidno='$patientidno'");
  if(mysqli_num_rows($SQLstatement)>0){
    $death=mysqli_fetch_array($SQLstatement);
      $typeofdeath = $death['typeofdeath'];
  }

if ($typeofdeath=="STILLBIRTHS") {

$totaldeaths = "";
$totalstillbirths = "1";
$totalneonataldeaths = "0";
$totalmaternaldeaths = "0";
$totaldeathsnewborn = "0";
$totalerdeaths = "0";
$totaldeaths48down = "0";
$totaldeaths48up= "0";
$totalerdeaths = "0";

$deathsbelow48 = "0";
$deathsover48 = "0";

}

if ($typeofdeath=="NEONATAL") {
$totaldeaths = "0";
$totalstillbirths = "0";
$totalneonataldeaths = "1";
$totalmaternaldeaths = "0";
$totaldeathsnewborn = "0";
$totalerdeaths = "0";
$deathsbelow48 = "0";
$deathsover48 = "0";
$totalerdeaths = "0";
}
if ($typeofdeath=="MATERNAL") {
$totaldeaths = "0";
$totalstillbirths = "0";
$totalneonataldeaths = "0";
$totalmaternaldeaths = "1";
$totaldeathsnewborn = "0";
$totalerdeaths = "0";
$deathsbelow48 = "0";
$deathsover48 = "0";
$totalerdeaths = "0";

}

$SQL = "insert into patienthospitalOperationsDeaths values('$hfhudcode','$totaldeaths','$deathsbelow48','$deathsover48','$totalerdeaths','$totaldoa','$totalstillbirths','$totalneonataldeaths','$totalmaternaldeaths','$totaldeathsnewborn','$totaldischargedeaths','$grossdeathrate','$ndrnumerator','$ndrdenominator','$netdeathrate','$reportingyear','','$datedischarged','$case','$branch')";
$InsertRecord = mysqli_query($conEMR,$SQL);

$SQL = "insert into patientstat values('$patientidno','$case','EXPIRED','pending')";
$InsertRecord = mysqli_query($con,$SQL);
}

if ($producttype=="IPD Procedure done at OR") {

if ($proc <= 18) {

$tscode = "5";
}



if ($proc >= 19) {

$tscode = "6";
}
}

$SQL = "INSERT INTO  patienthospOptDischargesSpecialty values('$hfhudcode','$tscode','$nopatients','$totallengthstay','$nppay','$nphservicecharity','$nphtotal','$phpay','$phservice','$phtotal','$hmo','$owwa','$recoveredimproved','$transferred','$hama','$absconded','$unimproved','$deathsbelow48','$deathsover48','$totaldeaths','$totaldischarges','$remarks','$reportingyear','','$datedischarged','$tsdesc','PENDING','$case','$branch')";
$InsertRecords = mysqli_query($conEMR,$SQL);

if ($tscode=="7") {
$SQLstatement = mysqli_query($conEMR,"delete from patienthospOptDischargesSpecialty   where   caseno = '$case'");

$SQL = "INSERT INTO  patienthospOptDischargesSpecialty values('$hfhudcode','$tscode','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','$totaldischarges','$remarks','$reportingyear','','$datedischarged','$tsdesc','PENDING','$case','$branch')";
$InsertRecords = mysqli_query($conEMR,$SQL);

$SQL = "INSERT INTO  patienthospOptDischargesSpecialtyOthers values('$hfhudcode','$othertypeofservicespecify','$nopatients','$totallengthstay','$nppay','$nphservicecharity','$nphtotal','$phpay','$phservice','$phtotal','$hmo','$owwa','$recoveredimproved','$transferred','$hama','$absconded','$unimproved','$deathsbelow48','$deathsover48','$totaldeaths','$totaldischarges','$remarks','$reportingyear','','$datedischarged','$tsdesc','PENDING','$case','$branch')";
$InsertRecords = mysqli_query($conEMR,$SQL);
}

if ($patientadmit=="NEWBORN" || $patientadmit=="NEW BORN"){

  $SQLstatement = mysqli_query($conEMR,"select code from newborn where caseno='$case'");
if(mysqli_num_rows($SQLstatement)>0){
  $c=mysqli_fetch_array($SQLstatement);
  $code2 = $c['code'];
  }
 $SQLstatement = mysqli_query($conEMR,"delete from patienthospOptDischargesSpecialty   where   caseno = '$case'");
 $SQLstatement = mysqli_query($conEMR,"delete from patienthospOptDischargesSpecialtyOthers   where   caseno = '$case'");
$SQL = "INSERT INTO  patienthospOptDischargesSpecialty values('$hfhudcode','$code2','$nopatients','$totallengthstay','$nppay','$nphservicecharity','$nphtotal','$phpay','$phservice','$phtotal','$hmo','$owwa','$recoveredimproved','$transferred','$hama','$absconded','$unimproved','$deathsbelow48','$deathsover48','$totaldeaths','$totaldischarges','$remarks','$reportingyear','','$datedischarged','$tsdesc','PENDING','$case','$branch')";
$InsertRecords = mysqli_query($conEMR,$SQL);

  $SQLstatement = mysqli_query($conEMR,"select typeofbirth from typeofbirth where caseno='$caseno'");
  if(mysqli_num_rows($SQLstatement)>0){
    $birth=mysqli_fetch_array($SQLstatement);
    $typeofbirth = $birth['typeofbirth'];
  }
if ($typeofbirth=="NORMAL") {
$totallbvdelivery = "1";
$totallbcdelivery = "0";
$totalotherdelivery = "0";
}
if ($typeofbirth=="CAESARIAN") {
$totallbvdelivery = "0";
$totallbcdelivery = "1";
$totalotherdelivery = "0";
}
if ($typeofbirth=="OTHERS") {
$totallbvdelivery = "0";
$totallbcdelivery = "0";
$totalotherdelivery = "1";
}

$SQL = "insert into patienthospOptDischargesNumberDeliveries values('$hfhudcode','1','$totallbvdelivery','$totallbcdelivery','$totalotherdelivery','$reportingyear','','$datedischarged','$case','$branch')";
$InsertRecord = mysqli_query($conEMR,$SQL);

}

if ($ward=="discharged") {
$admitdischarged = "0";
$discharge = "1";
$death = "0";
$transferin = "0";
$transferout = "0";
$totalinpatients = "1";
}
if ($dateadmit==$datedischarged) {
$admitdischarged = "1";
$discharge = "0";
$death = "0";
$transferin = "0";
$transferout = "0";
$admission = "";
}

if ($disposition=="DIED") {
$admitdischarged = "0";
$discharge = "0";
$death = "1";
$transferin = "0";
$transferout = "0";
}

$SQLstatement = mysqli_query($con,"select status from transfers where caseno='$case'");
if(mysqli_num_rows($SQLstatement)>0){
  $st1=mysqli_fetch_array($SQLstatement);
  $status1 = $st1['status'];
}
#############################################
if ($status1=="ingoing") {
$admitdischarged = "0";
$discharge = "1";
$death = "0";
$transferin = "0";
$transferout = "0";
$totalnewborn = "0";
}
#############################################
if ($status1=="outgoing") {
$admitdischged = "0";
$discharge = "0";
$death = "0";
$transferin = "0";
$transferout = "1";
$totalnewborn = "0";
}
if ($patientadmit=="NEWBORN" || $patientadmit=="NEW BORN") {
$admitdischged = "0";
$discharge = "1";
$death = "0";
$transferin = "0";
$transferout = "0";
$totalnewborn = "0";
}

$SQL = "INSERT INTO  beddays values('$datedischarged','$reportingyear','$remaining','$admission','','$total','$discharge','$death','$transferout','$total1','$midnight','$admitdischarged','$case','$branch','','$disposition')";
$InsertRecords = mysqli_query($conEMR,$SQL);

if ($ward=="discharged") {
$admitdischarged = "0";
$discharge = "1";
$death = "0";
$transferin = "0";
$transferout = "0";
$totalinpatients = "1";
}
if ($dateadmit==$datedischarged) {
$admitdischarged = "1";
$discharge = "1";
$death = "0";
$transferin = "0";
$transferout = "0";
$totalinpatients = "1";
}

if ($disposition=="DIED") {
$admitdischarged = "0";
$discharge = "0";
$death = "1";
$transferin = "0";
$transferout = "0";
}

$SQLstatement = mysqli_query($con,"select status from transfers where caseno='$case'");
if(mysqli_num_rows($SQLstatement)>0){
  $st2=mysqli_fetch_array($SQLstatement);
  $status2 = $st2['status'];
}



#############################################

if ($status2=="ingoing") {
$admitdischarged = "0";
$discharge = "1";
$death = "0";
$transferin = "1";
$transferout = "0";
$totalnewborn = "0";
$totalinpatients = "1";
}
#############################################
if ($status2=="outgoing") {
$admitdischged = "0";
$discharge = "1";
$death = "0";
$transferin = "0";
$transferout = "1";
$totalnewborn = "0";
$totalinpatients = "1";
}


if ($patientadmit=="NEWBORN") {

$admitdischarged = "0";
$discharge = "0";
$death = "0";
$transferin = "0";
$transferout = "0";
$totalinpatients = "0";
$totalnewborn = "1";


}
$SQL = "insert into patienthospOptSummaryOfPatients values('$hfhudcode','$totalinpatients','$totalnewborn','$discharge','$admitdischarged','','$transferin','$transferout','','$reportingyear','','$datedischarged','$case','$branch','$patientname','')";
$InsertRecord = mysqli_query($conEMR,$SQL);

}

if (($disposition=="DIED") && ($patientadmit=="NEWBORN" || $patientadmit=="NEW BORN"))
{
$SQLstatement = mysqli_query($conEMR,"delete from patienthospOptDischargesSpecialty   where   caseno = '$case'");
$SQLstatement = mysqli_query($conEMR,"delete from patienthospOptDischargesSpecialtyothers   where   caseno = '$case'");
$SQLstatement = mysqli_query($conEMR,"delete from patienthospOptSummaryOfPatients   where   caseno = '$case'");
$SQLstatement = mysqli_query($conEMR,"delete from beddays   where   caseno = '$case'");
}

$transmessage=$lname11.", ".$fname11." has been discharged with the caseno $caseno";
$loginuser=$nursename;
$datearray=date('Y-m-d');
$timearray=date('H:i:s');
$sqlInsert=mysqli_query($con,"INSERT INTO userlogs(transaction,loginuser,datearray,timearray) VALUES('$transmessage','$loginuser','$datearray','$timearray')");

echo "<script>";
  echo "alert('$patientname is successfully discharged!');";
  echo "window.location = 'index.php?view=detail&caseno=$caseno$datax';";
echo "</script>";
}else{
  echo "<script>";
    echo "alert('Unable to discharge patient!');";
    echo "window.location = 'index.php?view=detail&caseno=$caseno$datax';";
  echo "</script>";
}
}else{
  echo "<script>";
    echo "alert('Patient status must be MGH!');";
    echo "window.location = 'index.php?view=detail&caseno=$caseno$datax';";
  echo "</script>";
}
 ?>
