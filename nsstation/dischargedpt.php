<?php
error_reporting(1);
$caseno=$_POST['caseno'];
$nursename=$_POST['nursename'];
$datedischarged=$_POST['datedischarged'];
$timedischarged=$_POST['timedischarged'];

$sql = $conn->query("SELECT a.*,pp.* FROM admission a INNER JOIN patientprofile pp ON pp.patientidno=a.patientidno WHERE a.caseno='$caseno'");
while($result = $sql->fetch_assoc()){
$status = $result['status'];
$patientidno = $result['patientidno'];
$caseno=  $result['caseno'];
$member=$result['paymentmode'];
$membership = $result['membership'];
$hmomembership = $result['hmomembership'];
$hmo = $result['hmo'];
$roomno = $result['room'];
$ward = $result['ward'];
$street = $result['street'];
$barangay = $result['barangay'];
$municipality = $result['municipality'];
$province = $result['province'];
$initialdiagnosis = $result['initialdiagnosis'];
$ap = $result['ap'];
$dateadmitted = $result['dateadmitted'];
$dateadmit = $result['dateadmit'];
$branch = $result['branch'];
$age = $result['age'];
$lastname = $result['lastname'];
$firstname = $result['firstname'];
$middlename = $result['middlename'];
$senior = $result['senior'];
$patientname=$lastname." ".$firstname." ".$middlename;
$disposition=$result['disposition'];
$patientadmit=$result['patientadmit'];
$statusAdmit=$result['status']; 
$sf=$result['result'];
$corp=$result['corp'];
}

$date1=new DateTime($dateadmit);
$date2=new DateTime($datedischarged);
$date=date('M-d-Y',strtotime($datedischarged));
$tim=date('H:i:s',strtotime($timedischarged));

if(strpos($caseno, "O-")!==false and $membership=="none"){$sf="FINAL"; $corp="FINAL PAID";}

if($status=="MGH" and $sf=="FINAL"){


if($corp==""){
echo "
<script type='text/javascript'>
swal({
icon: 'error',
title: 'Unable to Discharge this Patient!',
text: 'Please contact Cashier to settle account of this patient.',
type: 'error',
button: false
});
    
setTimeout(function(){window.history.back();}, 3000);
</script>
";

exit();
}

$sql2 = $conn->query("select sum(hmo) totalhmo from productout where caseno = '$caseno' and trantype = 'charge' and trantype not like '%OFFSET%' and productcode not like '%N/A%' and producttype not
 like '%READERS FEE%' and producttype not like '%PAYMENT OF%'");
while($result2 = $sql2->fetch_assoc()){$totalhmo=$result2['totalhmo'];}

$sql3 = $conn->query("select sum(hmo) as totalhmo from productout where caseno = '$caseno' and trantype = 'charge'  and productsubtype not like '%PROFESSIONAL FEE%'");
while($result3 = $sql3->fetch_assoc()){$grosstotalhmo=$result3['totalhmo'];}

$sql4 = $conn->query("select sum(hmo) as totalhmopf from productout where caseno = '$caseno' and trantype = 'charge'  and productsubtype  like '%PROFESSIONAL FEE%' and producttype not like '%PAYMENT OF%'");
while($result4 = $sql4->fetch_assoc()){$grosstotalhmopf=$result4['totalhmopf'];}

$sql5 = $conn->query("select sum(hospitalshare) as hospitalshare,sum(pfshare) as pfshare,caseno from finalcaserate where caseno = '$caseno' and (level='primary'  or level='related procedure') group by caseno");
while($result5 = $sql5->fetch_assoc()){
$hospitalshare = $result5['hospitalshare'];
$pfshare = $result5['pfshare'];
$totalcaserate=$hospitalshare+$pfshare;  
}

$conn->query("delete from dischargedby where caseno='$caseno'");
$conn->query("delete from dischargedtable where caseno='$caseno'");

$conn->query("INSERT INTO dischargedtable values('$caseno','$patientname','$date','$timedischarged','UNDONE','UNDONE','U','0','$pfshare','$totalcaserate','U','UNDONE','$grosstotalhmo',
'0','0','1','0','UNDONE','$grosstotalhmopf','$ward','$datedischarged','1','$branch')");

$conn->query("update productout set producttype='manual' where  caseno = '$caseno' and productsubtype='ROOM ACCOMODATION'");
$conn->query("update room set roomstat='vacant' where room = '$roomno'");
$conn->query("update admission set ward ='discharged', status='discharged'  where  caseno = '$caseno'");
$conn->query("INSERT INTO dischargedby values('$caseno','$nursename','$totalbill','$senior','$totalhmo','$totalphic','$totalexcess','$totalcaserate','$hmo','$lastname','$firstname','$roomno','$membership','$datedischarged','$timedischarged','$branch','$shift','1')");



//-------------------------------------->>>>>>>>>>>>>>> ELECTRONIC MEDICAL RECORDS STATISTIC ---------------------------->>>>>>>>>>>>>>>
$reportingyear=date('Y');
$sqlx = $connEMR->query("select hfhudcode from genInfoClassification");
while($resx = $sqlx->fetch_assoc()){$hfhudcode = $resx['hfhudcode'];}

$sqlx = $connEMR->query("select tscode, doctor from specialtycaseno where caseno = '$caseno'");
while($resx = $sqlx->fetch_assoc()){$tscode1 = $resx['tscode']; $doctor= $resx['doctor'];}

$sqlx = $conn->query("select name, tod  from docfile where code= '$doctor'");
while($resx = $sqlx->fetch_assoc()){
$productcode = $resx['name'];
$othertypeofservicespecify = $resx['tod'];
}

$sqlx = $connEMR->query("select  tscode,tsdesc  from  rtservice  where tscode='$tscode1'");
while($resx = $sqlx->fetch_assoc()){$tscode = $resx['tscode']; $tsdesc = $resx['tsdesc'];}

$sqlx = $conn->query("select producttype  from productout where caseno = '$caseno' and productcode='$productcode'");
while($resx = $sqlx->fetch_assoc()){$producttype = $resx['producttype'];}

$days=$date2->diff($date1);
$totallengthstay=$days->d;

$nppay= "0";
$nphtotal= "0";
$phpay= "0";
$phtotal= "0";
$hmo= "0";
if($membership=="Nonmed-none" && $hmomembership=="none"){$nppay= "1"; $nphtotal= "1";}
if($membership=="phic-med"){$phpay= "1"; $phtotal= "1";}
if(($membership=="Nonmed-none" && $hmomembership=="hmo-hmo") || ($membership=="Nonmed-none" && $hmomembership=="hmo-hmo")){$hmo= "1";}



$recoveredimproved= "0";
$transferred= "0";
$hama= "0";
$absconded= "0";
$unimproved= "0";
$totaldeaths= "0";
$nopatients= "0";
$totaldischarges = "0";
// -------------------------------->>>>>> IF RECOVERED
if($disposition=="RECOVERED"){
$recoveredimproved= "1";
$nopatients= "1";
$totaldischarges = "1";
}

// -------------------------------->>>>>> IF IMPROVED
if($disposition=="IMPROVED"){
$recoveredimproved= "1";
$totaldischarges = "1";
$nopatients= "1";
}

// -------------------------------->>>>>> IF MAHA
if($disposition=="HAMA"){
$hama= "1";
$totaldischarges = "1";
$nopatients= "1";
}

// -------------------------------->>>>>> IF ABSCONDED
if($disposition=="ABSCONDED"){
$absconded= "1";
$totaldischarges = "1";
$nopatients= "1";
}

// -------------------------------->>>>>> IF UNIMPROVED
if($disposition=="UNIMPROVED"){
$unimproved= "1";
$totaldischarges = "1";
$nopatients= "1";
}

// -------------------------------->>>>>> IF TRANSFERED
if($disposition=="TRANSFERRED"){
$transferred= "1";
$nopatients= "1";
$totaldischarges = "1";
}


// -------------------------------->>>>>> IF DIED
if($disposition=="DIED"){
$totaldeaths= "1";
$totaldischarges = "1";
$nopatients= "1";

if($totallengthstay<2){$deathsbelow48 = "1"; $deathsover48 = "0";}
if($totallengthstay>=2){$deathsbelow48 = "0"; $deathsover48 = "1";}

$sqlx = $connEMR->query("select typeofdeath from typeofdeath where patientidno='$patientidno'");
while($resx = $sqlx->fetch_assoc()){$typeofdeath = $resx['typeofdeath'];}

$totaldeaths = "";
$totalstillbirths = "0";
$totalneonataldeaths = "0";
$totalmaternaldeaths = "0";
$totaldeathsnewborn = "0";
$totalerdeaths = "0";
$totaldeaths48down = "0";
$totaldeaths48up= "0";
if($typeofdeath=="STILLBIRTHS"){$totalstillbirths = "1";}
if($typeofdeath=="NEONATAL"){$totalneonataldeaths = "1";}
if($typeofdeath=="MATERNAL"){$totalmaternaldeaths = "1";}

$connEMR->query("delete from patienthospitalOperationsDeaths where caseno='$caseno'");
$connEMR->query("insert into patienthospitalOperationsDeaths values('$hfhudcode','$totaldeaths','$deathsbelow48','$deathsover48','$totalerdeaths','$totaldoa','$totalstillbirths','$totalneonataldeaths',
'$totalmaternaldeaths','$totaldeathsnewborn','$totaldischargedeaths','$grossdeathrate','$ndrnumerator','$ndrdenominator','$netdeathrate','$reportingyear','','$datedischarged','$caseno','$branch')");

$conn->query("delete from patientstat where caseno='$caseno'");
$conn->query("insert into patientstat values('$patientidno','$caseno','EXPIRED','pending')");
}


$connEMR->query("delete from patienthospOptDischargesSpecialty where caseno='$caseno'");
$connEMR->query("INSERT INTO  patienthospOptDischargesSpecialty values('$hfhudcode','$tscode','$nopatients','$totallengthstay','$nppay','$nphservicecharity','$nphtotal','$phpay','$phservice','$phtotal',
'$hmo','$owwa','$recoveredimproved','$transferred','$hama','$absconded','$unimproved','$deathsbelow48','$deathsover48','$totaldeaths','$totaldischarges','$remarks','$reportingyear','','$datedischarged',
'$tsdesc','PENDING','$caseno','$branch')");


if($tscode=="7"){
$connEMR->query("delete from patienthospOptDischargesSpecialty where caseno='$caseno'");
$connEMR->query("INSERT INTO  patienthospOptDischargesSpecialty values('$hfhudcode','$tscode','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','$totaldischarges','$remarks',
'$reportingyear','','$datedischarged','$tsdesc','PENDING','$caseno','$branch')");

$connEMR->query("delete from patienthospOptDischargesSpecialtyOthers where caseno='$caseno'");
$connEMR->query("INSERT INTO  patienthospOptDischargesSpecialtyOthers values('$hfhudcode','$othertypeofservicespecify','$nopatients','$totallengthstay','$nppay','$nphservicecharity','$nphtotal','$phpay',
'$phservice','$phtotal','$hmo','$owwa','$recoveredimproved','$transferred','$hama','$absconded','$unimproved','$deathsbelow48','$deathsover48','$totaldeaths','$totaldischarges','$remarks','$reportingyear',
'','$datedischarged','$tsdesc','PENDING','$caseno','$branch')");
}

if($patientadmit=="NEWBORN" || $patientadmit=="NEW BORN"){
$sqlx = $connEMR->query("select code from newborn where caseno='$caseno'");
while($resx = $sqlx->fetch_assoc()){$code2 = $resx['code'];}

$connEMR->query("delete from patienthospOptDischargesSpecialty   where   caseno = '$caseno'");
$connEMR->query("delete from patienthospOptDischargesSpecialtyOthers   where   caseno = '$caseno'");
$connEMR->query("INSERT INTO  patienthospOptDischargesSpecialty values('$hfhudcode','$code2','$nopatients','$totallengthstay','$nppay','$nphservicecharity','$nphtotal','$phpay','$phservice',
'$phtotal','$hmo','$owwa','$recoveredimproved','$transferred','$hama','$absconded','$unimproved','$deathsbelow48','$deathsover48','$totaldeaths','$totaldischarges','$remarks','$reportingyear',
'','$datedischarged','$tsdesc','PENDING','$caseno','$branch')");

$sqlx = $connEMR->query("select typeofbirth from typeofbirth where caseno='$caseno'");
while($resx = $sqlx->fetch_assoc()){$typeofbirth = $resx['typeofbirth'];}

$totallbvdelivery = "0";
$totallbcdelivery = "0";
$totalotherdelivery = "0";
if($typeofbirth=="NORMAL"){$totallbvdelivery = "1";}
if($typeofbirth=="CAESARIAN"){$totallbcdelivery = "1";}
if ($typeofbirth=="OTHERS"){$totalotherdelivery = "1";}

$connEMR->query("insert into patienthospOptDischargesNumberDeliveries values('$hfhudcode','1','$totallbvdelivery','$totallbcdelivery','$totalotherdelivery','$reportingyear','','$datedischarged',
'$caseno','$branch')");
}

$admitdischarged = "0";
$discharge = "1";
$death = "0";
$transferin = "0";
$transferout = "0";
$totalinpatients = "1";

if($dateadmit==$datedischarged){
$admitdischarged = "1";
$discharge = "0";
$death = "0";
$transferin = "0";
$transferout = "0";
$admission = "";
}

if($disposition=="DIED") {
$admitdischarged = "0";
$discharge = "0";
$death = "1";
$transferin = "0";
$transferout = "0";
}


$sqlx = $conn->query("select status from transfers where caseno='$caseno'");
while($resx = $sqlx->fetch_assoc()){$status1 = $resx['status'];}

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

$connEMR->query("INSERT INTO  beddays values('$datedischarged','$reportingyear','$remaining','$admission','','$total','$discharge','$death','$transferout','$total1','$midnight',
'$admitdischarged','$caseno','$branch','','$disposition')");

$admitdischarged = "0";
$discharge = "1";
$death = "0";
$transferin = "0";
$transferout = "0";
$totalinpatients = "1";

if($dateadmit==$datedischarged) {
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


$sqlx = $conn->query("select status from transfers where caseno='$caseno'");
while($resx = $sqlx->fetch_assoc()){$status2 = $resx['status'];}

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


if ($patientadmit=="NEWBORN"){
$admitdischarged = "0";
$discharge = "0";
$death = "0";
$transferin = "0";
$transferout = "0";
$totalinpatients = "0";
$totalnewborn = "1";
}


$connEMR->query("insert into patienthospOptSummaryOfPatients values('$hfhudcode','$totalinpatients','$totalnewborn','$discharge','$admitdischarged','','$transferin','$transferout','',
'$reportingyear','','$datedischarged','$caseno','$branch','$patientname','')");

if (($disposition=="DIED") && ($patientadmit=="NEWBORN" || $patientadmit=="NEW BORN")){
$connEMR->query("delete from patienthospOptDischargesSpecialty where caseno='$caseno'");
$connEMR->query("delete from patienthospOptDischargesSpecialtyothers where caseno='$caseno'");
$connEMR->query("delete from patienthospOptSummaryOfPatients where caseno='$caseno'");
$connEMR->query("delete from beddays where caseno='$caseno'");
}

$transmessage= $lname11.", ".$fname11." has been discharged with the caseno $caseno";
$loginuser=$nursename;
$datearray=date('Y-m-d');
$timearray=date('H:i:s');
$conn->query("INSERT INTO userlogs(transaction,loginuser,datearray,timearray) VALUES('$transmessage','$loginuser','$datearray','$timearray')");



// ------------------------------ INSERT DOCTOR PAYABLES----------------------------
$conn->query("delete from pf_payables where caseno='$caseno'");
$result2 = $conn->query("SELECT * FROM productout where caseno='$caseno' and productsubtype='PROFESSIONAL FEE'");
while($row2 = $result2->fetch_assoc()){
$producttype1=$row2['producttype'];
$phic1=$row2['phic'];
$hmo1=$row2['hmo'];
$excess1=$row2['excess'];
$pdesc=$row2['productdesc'];
$iz++;
$refno11=$row2['refno'];
$datep = date('M-d-Y');

$result22 = $conn->query("SELECT * FROM admission, patientprofile where admission.patientidno=patientprofile.patientidno and admission.caseno='$caseno'");
while($row22 = $result22->fetch_assoc()) {
$lname11 = $row22['lastname'];
$fname11 = $row22['firstname'];
$mname11 = $row22['middlename'];
$hmocomp11 = $row22['hmo'];
$hmocompmem11 = $row22['hmomembership'];
$pname = $lname11.", ".$fname11." ".$mname11;
}

$doccode="";
$result222 = $conn->query("SELECT * FROM docfile where name like '%$pdesc%'");
while($row222 = $result222->fetch_assoc()) {$doccode = $row222['code'];}


if($phic1>0){
$conn->query("INSERT INTO `pf_payables`(`refno`, `caseno`, `patientname`, `doctorid`, `doctorname`, `dateposted`, `datearray`, `company`, `companytype`,
 `gross`, `tax`, `netexcess`, `producttype`, `status`, `branch`, `remarks`) values
 ('$refno11','$caseno','$pname','$doccode','$pdesc','$datep',CURDATE(),'PHIC','PHIC-MED','$phic1','0','$phic1','$producttype1',
 'pending','$branch','')");
}

if($hmo1>0){
$conn->query("INSERT INTO `pf_payables`(`refno`, `caseno`, `patientname`, `doctorid`, `doctorname`, `dateposted`, `datearray`, `company`, `companytype`,
 `gross`, `tax`, `netexcess`, `producttype`, `status`, `branch`, `remarks`) values
 ('$refno11','$caseno','$pname','$doccode','$pdesc','$datep',CURDATE(),'$hmocomp11','$hmocompmem11','$hmo1','0','$hmo1','$producttype1',
 'pending','$branch','')");
}

if($excess1>0){
$conn->query("INSERT INTO `pf_payables`(`refno`, `caseno`, `patientname`, `doctorid`, `doctorname`, `dateposted`, `datearray`, `company`, `companytype`,
 `gross`, `tax`, `netexcess`, `producttype`, `status`, `branch`, `remarks`) values
 ('$refno11','$caseno','$pname','$doccode','$pdesc','$datep',CURDATE(),'CASH','NONE','$excess1','0','$excess1','$producttype1',
 'pending','$branch','')");
}
}
// ----------------------------- END INSERT DOCTOR PAYABLES -----------------------------



//----------------------->>>>>>>>>> GENEREATE BACKUP PRODUCTOUT ------------------>>>>>>>>>>>>>>
$disyear = date("Y", strtotime($datedischarged));
$prodout = "productout".$disyear;
$ckt = $conn->query("SHOW TABLES LIKE '$prodout'");
if(mysqli_num_rows($ckt)==0){$conn->query("CREATE TABLE $prodout LIKE productout;");}

$ckt2 = $conn->query("SHOW TABLES LIKE 'datedischargedlog'");
if(mysqli_num_rows($ckt2)==0){
$conn->query("CREATE TABLE `datedischargedlog` (`id` int(20) NOT NULL AUTO_INCREMENT, `caseno` varchar(50) NOT NULL, `disyear` varchar(10) NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
}

$conn->query("delete from datedischargedlog where caseno='$caseno'");
$conn->query("INSERT INTO datedischargedlog (caseno, disyear) value ('$caseno', '$disyear')");

$conn->query("INSERT INTO $prodout SELECT * FROM productout where caseno='$caseno'");
//$conn->query("delete from productout where caseno='$caseno'");
//--------------------->>>>>>>>>> END GENEREATE BACKUP PRODUCTOUT ---------------->>>>>>>>>>>>>>

echo "
<script type='text/javascript'>
swal({
icon: 'success',
title: '$patientname is Successfully Discharged!',
text: 'Congratulations',
type: 'success',
button: false
});

setTimeout(function(){window.location='../nsstation/?dischargedsummary&caseno=$caseno';}, 3000);
</script>
";


}else{
echo "
<script type='text/javascript'>
swal({
icon: 'error',
title: 'Unable to Discharge this Patient!',
text: 'The status has not been set as May Go Home by the nursing station, nor has it been set as Final by billing.',
type: 'error',
button: false
});

setTimeout(function(){window.history.back();}, 3000);
</script>
";
}
?>