<?php include("../Settings.php"); $cuz = new database(); mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass()); mysql_select_db($cuz->getDB()); $snamesql=mysql_query("SELECT * FROM heading"); while($snamefetch=mysql_fetch_array($snamesql)){$sname=$snamefetch['heading'];$address=$snamefetch['address'];} echo ""; ?>


<?php
$patientidno=mysql_real_escape_string($_GET['patientidno']);
$caseno=mysql_real_escape_string($_GET['caseno']);

//admission
mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());
$admsql=mysql_query("SELECT type, paymentmode, room, UPPER(street) AS street, UPPER(barangay) AS barangay, UPPER(municipality) AS municipality, UPPER(province) AS province, zipcode,UPPER(pastmed) AS pastmed, UPPER(initialdiagnosis) AS initialdiagnosis, UPPER(finaldiagnosis) AS finaldiagnosis, UPPER(ap) AS ap, timeadmitted, dateadmit FROM admission WHERE caseno='$caseno'");
while($admfetch=mysql_fetch_array($admsql)){
$type=$admfetch['type'];
$paymentmode=$admfetch['paymentmode'];
$room=$admfetch['room'];
$street=$admfetch['street'];
$barangay=$admfetch['barangay'];
$municipality=$admfetch['municipality'];
$province=$admfetch['province'];
$zipcode=$admfetch['zipcode'];
$pastmed=$admfetch['pastmed'];
$initialdiagnosis=$admfetch['initialdiagnosis'];
$finaldiagnosis=$admfetch['finaldiagnosis'];
$ap=$admfetch['ap'];
$timeadmitted=$admfetch['timeadmitted'];
$dateadmit=$admfetch['dateadmit'];
}

$dateadmitfmt=date("m-d-Y",strtotime($dateadmit));
$datetimead=$dateadmit." ".$timeadmitted;
$gettimead=date("H:i:sA",strtotime($datetimead));
$mailadd=$street." ".$barangay." ".$municipality." ".$province;

//patientprofile
mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());
mysql_query('SET NAMES utf8');
$patfsql=mysql_query("SELECT UPPER(lastname) AS lastname, UPPER(firstname) AS firstname, UPPER(middlename) AS middlename, birthdate, age, UPPER(sex) AS sex FROM patientprofile WHERE patientidno='$patientidno'");
while($patffetch=mysql_fetch_array($patfsql)){
$lastname=$patffetch['lastname'];
$firstname=$patffetch['firstname'];
$middlename=$patffetch['middlename'];
$birthdate=$patffetch['birthdate'];
$age=$patffetch['age'];
$sex=$patffetch['sex'];
}

$birthdatefmt=date("m-d-Y",strtotime($birthdate));

$birthdatespl=preg_split('/\-/', $birthdate);

$bm=$birthdatespl[0];
$bd=$birthdatespl[1];
$by=$birthdatespl[2];

if(strlen($bd)==1){$bdf="0".$bd;}else{$bdf=$bd;}

$birthdaterel=$bm."-".$bdf."-".$by;

//patientprofileaddinfo
mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());
$pataisql=mysql_query("SELECT UPPER(suffix) AS suffix FROM patientprofileaddinfo WHERE patientidno='$patientidno'");
$pataicount=mysql_num_rows($pataisql);
if($pataicount==0){
$suffix="";
}
else{
while($pataifetch=mysql_fetch_array($pataisql)){
$suffix=$pataifetch['suffix'];
}
}

//claiminfo
mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());
mysql_query('SET NAMES utf8');
$cfsql=mysql_query("SELECT identificationno, UPPER(lastname) AS lastname, UPPER(firstname) AS firstname, UPPER(middlename) AS middlename FROM claiminfo WHERE patientidno='$patientidno' AND caseno='$caseno'");
$cfcount=mysql_num_rows($cfsql);
if($cfcount==0){
$identificationno="";
$mlname="";
$mfname="";
$mmname="";
$mbdate="";
$mgender="";
$msuffix='';
}
else{
while($cffetch=mysql_fetch_array($cfsql)){
$identificationno=$cffetch['identificationno'];
$mlname= $cffetch['lastname'];
$mfname=$cffetch['firstname'];
$mmname=$cffetch['middlename'];
$mbdate="";
$mgender="";
$msuffix='';
}
}

$identificationnofmt=str_replace("-","",$identificationno);
$mbdatefmt=date("m-d-Y",strtotime($mbdate));

//claiminfoadd
mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());
mysql_query('SET NAMES utf8');
$cfasql=mysql_query("SELECT hciyes, hcino, disposition, expireddays, timeexpired, transferto, transferadd, reasons, private, nonprivate, doctor1, datesigned1, doctor2, datesigned2, copay2, doctor3, datesigned3, copay3 FROM claiminfoadd WHERE patientidno='$patientidno' AND caseno='$caseno'");
$cfacount=mysql_num_rows($cfasql);
if($cfacount==0){
$hciyes="";
$hcino="";
$disposition="";
$expireddays="";
$timeexpired="";
$transferto="";
$transferadd="";
$reasons="";
$private="";
$nonprivate="";
$doctor="";
$datesigned="";
$doctor2="";
$datesigned2="";
$copay2="";
$doctor3="";
$datesigned3="";
$copay3="";

$copay3="";
}
else{
while($cfafetch=mysql_fetch_array($cfasql)){
$hciyes=$cfafetch['hciyes'];
$hcino=$cfafetch['hcino'];
$disposition=$cfafetch['disposition'];
$expireddays=$cfafetch['expireddays'];
$timeexpired=$cfafetch['timeexpired'];
$transferto=$cfafetch['transferto'];
$transferadd=$cfafetch['transferadd'];
$reasons=$cfafetch['reasons'];
$private=$cfafetch['private'];
$nonprivate=$cfafetch['nonprivate'];
$doctor=$cfafetch['doctor1'];
$datesigned=$cfafetch['datesigned1'];
$doctor2=$cfafetch['doctor2'];
$datesigned2=$cfafetch['datesigned2'];
$copay2=$cfafetch['copay2'];
$doctor3=$cfafetch['doctor3'];
$datesigned3=$cfafetch['datesigned3'];
$copay3=$cfafetch['copay3'];

}
}

//claiminfomoreinfo
mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());
$cimisql=mysql_query("SELECT * FROM claiminfomoreinfo WHERE caseno='$caseno'");
$cimicount=mysql_num_rows($cimisql);
if($cimicount==0){
$membersuffix="";
$memberbday="";
$membergender="";
$rtm="";
$comchoose="M";
$comname="";
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
while($cimifetch=mysql_fetch_array($cimisql)){
$membersuffix=$cimifetch['membersuffix'];
$memberbday=$cimifetch['memberbday'];
$membergender=$cimifetch['membergender'];
$rtm=$cimifetch['rtm'];
$comchoose=$cimifetch['comchoose'];
$comname=$cimifetch['comname'];
$comdatesigned=$cimifetch['comdatesigned'];
$comrelation=$cimifetch['comrelation'];
$comrelationos=$cimifetch['comrelationos'];
$comreason=$cimifetch['comreason'];
$comreasonos=$cimifetch['comreasonos'];
$comuw=$cimifetch['comuw'];
$emppen=$cimifetch['emppen'];
$empbusinessname=$cimifetch['empbusinessname'];
$empname=$cimifetch['empname'];
$empcontactno=$cimifetch['empcontactno'];
$empsigdesignation=$cimifetch['empsigdesignation'];
$empdatesigned=$cimifetch['empdatesigned'];
$carchoose=$cimifetch['carchoose'];
$carname=$cimifetch['carname'];
$cardatesigned=$cimifetch['cardatesigned'];
$carrelation=$cimifetch['carrelation'];
$carrelationos=$cimifetch['carrelationos'];
$carreason=$cimifetch['carreason'];
$carreasonos=$cimifetch['carreasonos'];
$caruw=$cimifetch['caruw'];
$hcirep=$cimifetch['hcirep'];
$hcidesignation=$cimifetch['hcidesignation'];
$hcidatesigned=$cimifetch['hcidatesigned'];

}
}
if($hcirep==""){$hcirep="CECILIA R. ROLDAN, M.D.";}
if($hcidesignation==""){$hcidesignation="MEDICAL DIRECTOR";}
//dischargedtable
mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());
$dtsql=mysql_query("SELECT datedischarged, timedischarged FROM dischargedtable WHERE caseno='$caseno'");
$dtcount=mysql_num_rows($dtsql);
if($dtcount==0){
$datedischarged="__";
$timedischarged="";
}
else{
while($dtfetch=mysql_fetch_array($dtsql)){
$datedischarged=$dtfetch['datedischarged'];
$timedischarged=$dtfetch['timedischarged'];
}
}

$datetimedis=$datedischarged." ".$timedischarged;
$gettimedis=date("H:i:sA",strtotime($datetimedis));

if($paymentmode=="Member"){
$mlnamerel=$lastname;
$mfnamerel=$firstname;
$mmnamerel=$middlename;
$msuffixrel=$suffix;
$mbdaterel=$birthdaterel;
$mgenderrel=$sex;
}
else{
$mlnamerel=$mlname;
$mfnamerel=$mfname;
$mmnamerel=$mmname;
$mbdaterel=$memberbday;
$msuffixrel=$membersuffix;
$mgenderrel=$membergender;
}

/*1. PhilHealth Identification Number (PIN) of Member: */
$phicofmember = $identificationno; //Place value of PHIC Number of member from the DB here.

if(strlen($phicofmember)==14){
$phicmember = str_split($phicofmember);

$phicmember0 = $phicmember[0];
$phicmember1 = $phicmember[1];
$phicmember3 = $phicmember[3];
$phicmember4 = $phicmember[4];
$phicmember5 = $phicmember[5];
$phicmember6 = $phicmember[6];
$phicmember7 = $phicmember[7];
$phicmember8 = $phicmember[8];
$phicmember9 = $phicmember[9];
$phicmember10 = $phicmember[10];
$phicmember11 = $phicmember[11];
$phicmember13 = $phicmember[13];

}
else if(strlen($phicofmember)==12){
$phicmember = str_split($phicofmember);

$phicmember0 = $phicmember[0];
$phicmember1 = $phicmember[1];
$phicmember3 = $phicmember[2];
$phicmember4 = $phicmember[3];
$phicmember5 = $phicmember[4];
$phicmember6 = $phicmember[5];
$phicmember7 = $phicmember[6];
$phicmember8 = $phicmember[7];
$phicmember9 = $phicmember[8];
$phicmember10 = $phicmember[9];
$phicmember11 = $phicmember[10];
$phicmember13 = $phicmember[11];
}
else{
$phicmember0 = "";
$phicmember1 = "";
$phicmember3 = "";
$phicmember4 = "";
$phicmember5 = "";
$phicmember6 = "";
$phicmember7 = "";
$phicmember8 = "";
$phicmember9 = "";
$phicmember10 = "";
$phicmember11 = "";
$phicmember13 = "";
}
/*------------------------------------------------------*/


/*2. Name of Member: */
$LN = $mlnamerel;
$FN = $mfnamerel;
$MN = $mmnamerel;
$MS = $msuffixrel;
/*------------------------------------------------------*/


/*3. Member Date of Birth: */
$bdayofmem=date("m-d-Y",strtotime($mbdaterel)); //change this to the value on the DB.

$bdayofmemarr=str_split($bdayofmem);

if(strlen($bdayofmem)>1){
$bdayofmemarr0 = $bdayofmemarr[0];
$bdayofmemarr1 = $bdayofmemarr[1];
$bdayofmemarr3 = $bdayofmemarr[3];
$bdayofmemarr4 = $bdayofmemarr[4];
$bdayofmemarr6 = $bdayofmemarr[6];
$bdayofmemarr7 = $bdayofmemarr[7];
$bdayofmemarr8 = $bdayofmemarr[8];
$bdayofmemarr9 = $bdayofmemarr[9];
}
else{
$bdayofmemarr0 = "";
$bdayofmemarr1 = "";
$bdayofmemarr3 = "";
$bdayofmemarr4 = "";
$bdayofmemarr6 = "";
$bdayofmemarr7 = "";
$bdayofmemarr8 = "";
$bdayofmemarr9 = "";
}
/*------------------------------------------------------*/


/*4. PhilHealth Identification Number (PIN) of Dependent: */
$phicofdep = ""; //Place value of PHIC Number of dependent from the DB here.

if(strlen($phicofdep)==14){
$phicdep = str_split($phicofdep);

$phicdep0 = $phicdep[0];
$phicdep1 = $phicdep[1];
$phicdep3 = $phicdep[3];
$phicdep4 = $phicdep[4];
$phicdep5 = $phicdep[5];
$phicdep6 = $phicdep[6];
$phicdep7 = $phicdep[7];
$phicdep8 = $phicdep[8];
$phicdep9 = $phicdep[9];
$phicdep10 = $phicdep[10];
$phicdep11 = $phicdep[11];
$phicdep13 = $phicdep[13];

}
else{
$phicdep0 = "";
$phicdep1 = "";
$phicdep3 = "";
$phicdep4 = "";
$phicdep5 = "";
$phicdep6 = "";
$phicdep7 = "";
$phicdep8 = "";
$phicdep9 = "";
$phicdep10 = "";
$phicdep11 = "";
$phicdep13 = "";
}
/*------------------------------------------------------*/

 	
/*5. Name of Patient: */
$LNPat = $lastname;
$FNPat = $firstname;
$MNPat = $middlename;
$MNSuf = $suffix;
/*------------------------------------------------------*/


/*6. Relationship to Member: */
$relofmem = $rtm;

if($paymentmode=="Member"){
$rom1 = ""; $rom2 = ""; $rom3 = "";
}
else{
if($relofmem=="Child")
{$rom1 = "checked='checked'"; $rom2 = ""; $rom3 = "";
}
else if($relofmem=="Parent")
{$rom1 = ""; $rom2 = "checked='checked'"; $rom3 = "";}
else if($relofmem=="Spouse"){$rom1 = ""; $rom2 = ""; $rom3 = "checked='checked'";}
else {$rom1 = ""; $rom2 = ""; $rom3 = "";}
}
/*------------------------------------------------------*/

$datedischarged=str_replace("_","-",$datedischarged);

/*7. Confinement Period */
$dateadmitted = date("m-d-Y",strtotime($dateadmit));
if($datedischarged != ""){
	

$ddis=preg_split('/\-/',$datedischarged);
$ddism=$ddis[0];
$ddisd=$ddis[1];
$ddisy=$ddis[2];
$ddisf=$ddism."-".$ddisd."-".$ddisy;
}
if($datedischarged == ""){
	
$ddism="";
$ddisd="";
$ddisy="";
$ddisf="";
}
$datedischargedfmt = date("m-d-Y",strtotime($ddisf));

$dateadmittedarr=str_split($dateadmitted);


$dateadmittedarr0 = $dateadmittedarr[0];
$dateadmittedarr1 = $dateadmittedarr[1];
$dateadmittedarr3 = $dateadmittedarr[3];
$dateadmittedarr4 = $dateadmittedarr[4];
$dateadmittedarr6 = $dateadmittedarr[6];
$dateadmittedarr7 = $dateadmittedarr[7];
$dateadmittedarr8 = $dateadmittedarr[8];
$dateadmittedarr9 = $dateadmittedarr[9];


$datedischargedarr=str_split($datedischargedfmt);

if($datedischarged!="--"){
$datedischargedarr0 = $datedischargedarr[0];
$datedischargedarr1 = $datedischargedarr[1];
$datedischargedarr3 = $datedischargedarr[3];
$datedischargedarr4 = $datedischargedarr[4];
$datedischargedarr6 = $datedischargedarr[6];
$datedischargedarr7 = $datedischargedarr[7];
$datedischargedarr8 = $datedischargedarr[8];
$datedischargedarr9 = $datedischargedarr[9];
}
else{
$datedischargedarr0 = "";
$datedischargedarr1 = "";
$datedischargedarr3 = "";
$datedischargedarr4 = "";
$datedischargedarr6 = "";
$datedischargedarr7 = "";
$datedischargedarr8 = "";
$datedischargedarr9 = "";
}
/*------------------------------------------------------*/


/*8. Patient Date of Birth: */
$bdayofpat=date("m-d-Y",strtotime($birthdaterel)); //change this to the value on the DB.

$bdayofpatarr=str_split($bdayofpat);

if(strlen($bdayofpat)>1){
$bdayofpatarr0 = $bdayofpatarr[0];
$bdayofpatarr1 = $bdayofpatarr[1];
$bdayofpatarr3 = $bdayofpatarr[3];
$bdayofpatarr4 = $bdayofpatarr[4];
$bdayofpatarr6 = $bdayofpatarr[6];
$bdayofpatarr7 = $bdayofpatarr[7];
$bdayofpatarr8 = $bdayofpatarr[8];
$bdayofpatarr9 = $bdayofpatarr[9];
}
else{
$bdayofpatarr0 = "";
$bdayofpatarr1 = "";
$bdayofpatarr3 = "";
$bdayofpatarr4 = "";
$bdayofpatarr6 = "";
$bdayofpatarr7 = "";
$bdayofpatarr8 = "";
$bdayofpatarr9 = "";
}
/*------------------------------------------------------*/



/*9. CERTIFICATION OF MEMBER:*/
if($comchoose=="M"){
$comnamem=$mfnamerel." ".$mmnamerel." ".$mlnamerel." ".$msuffixrel;
$comnamer="";
}
else if($comchoose=="R"){
$comnamem="";
$comnamer=$comname;
}
else{
$comnamem="";
$comnamer="";
}

$comdate = date("m-d-Y",strtotime($comdatesigned));

$comdatearr=str_split($comdate);

if($comchoose=="M"){
if(($comdatesigned!="")&&($comdatesigned!="--")){
$comdatearr01 = $comdatearr[0];
$comdatearr11 = $comdatearr[1];
$comdatearr31 = $comdatearr[3];
$comdatearr41 = $comdatearr[4];
$comdatearr61 = $comdatearr[6];
$comdatearr71 = $comdatearr[7];
$comdatearr81 = $comdatearr[8];
$comdatearr91 = $comdatearr[9];


$comdatearr02 = "";
$comdatearr12 = "";
$comdatearr32 = "";
$comdatearr42 = "";
$comdatearr62 = "";
$comdatearr72 = "";
$comdatearr82 = "";
$comdatearr92 = "";
}
else{
$comdatearr01 = "";
$comdatearr11 = "";
$comdatearr31 = "";
$comdatearr41 = "";
$comdatearr61 = "";
$comdatearr71 = "";
$comdatearr81 = "";
$comdatearr91 = "";


$comdatearr02 = "";
$comdatearr12 = "";
$comdatearr32 = "";
$comdatearr42 = "";
$comdatearr62 = "";
$comdatearr72 = "";
$comdatearr82 = "";
$comdatearr92 = "";
}
}
else if($comchoose=="R"){
if(($comdatesigned!="")&&($comdatesigned!="--")){
$comdatearr01 = "";
$comdatearr11 = "";
$comdatearr31 = "";
$comdatearr41 = "";
$comdatearr61 = "";
$comdatearr71 = "";
$comdatearr81 = "";
$comdatearr91 = "";


$comdatearr02 = $comdatearr[0];
$comdatearr12 = $comdatearr[1];
$comdatearr32 = $comdatearr[3];
$comdatearr42 = $comdatearr[4];
$comdatearr62 = $comdatearr[6];
$comdatearr72 = $comdatearr[7];

$comdatearr82 = $comdatearr[8];
$comdatearr92 = $comdatearr[9];
}
else{
$comdatearr01 = "";
$comdatearr11 = "";
$comdatearr31 = "";
$comdatearr41 = "";
$comdatearr61 = "";
$comdatearr71 = "";
$comdatearr81 = "";
$comdatearr91 = "";


$comdatearr02 = "";
$comdatearr12 = "";
$comdatearr32 = "";
$comdatearr42 = "";
$comdatearr62 = "";
$comdatearr72 = "";
$comdatearr82 = "";
$comdatearr92 = "";
}

}
else{
$comdatearr01 = "";
$comdatearr11 = "";
$comdatearr31 = "";
$comdatearr41 = "";
$comdatearr61 = "";
$comdatearr71 = "";
$comdatearr81 = "";
$comdatearr91 = "";


$comdatearr02 = "";
$comdatearr12 = "";
$comdatearr32 = "";
$comdatearr42 = "";
$comdatearr62 = "";
$comdatearr72 = "";
$comdatearr82 = "";
$comdatearr92 = "";
}

if($comchoose=="M"){
if($comrelation=="Spouse"){$comrtm1="checked='checked'";$comrtm2="";$comrtm3="";$comrtm4="";$comrtm5="";$comrtmos="__________";}
else if($comrelation=="Child"){$comrtm1="";$comrtm2="checked='checked'";$comrtm3="";$comrtm4="";$comrtm5="";$comrtmos="__________";}
else if($comrelation=="Parent"){$comrtm1="";$comrtm2="";$comrtm3="checked='checked'";$comrtm4="";$comrtm5="";$comrtmos="__________";}
else if($comrelation=="Sibling"){$comrtm1="";$comrtm2="";$comrtm3="";$comrtm4="checked='checked'";$comrtm5="";$comrtmos="__________";}
else{$comrtm1="";$comrtm2="";$comrtm3="";$comrtm4="";$comrtm5="checked='checked'";$comrtmos=$comrelationos;}
}
else if($comchoose=="R"){
if($comrelation=="Spouse"){$comrtm1="checked='checked'";$comrtm2="";$comrtm3="";$comrtm4="";$comrtm5="";$comrtmos="__________";}
else if($comrelation=="Child"){$comrtm1="";$comrtm2="checked='checked'";$comrtm3="";$comrtm4="";$comrtm5="";$comrtmos="__________";}
else if($comrelation=="Parent"){$comrtm1="";$comrtm2="";$comrtm3="checked='checked'";$comrtm4="";$comrtm5="";$comrtmos="__________";}
else if($comrelation=="Sibling"){$comrtm1="";$comrtm2="";$comrtm3="";$comrtm4="checked='checked'";$comrtm5="";$comrtmos="__________";}
else{$comrtm1="";$comrtm2="";$comrtm3="";$comrtm4="";$comrtm5="checked='checked'";$comrtmos=$comrelationos;}
}
else{
if($comrelation=="Spouse"){$comrtm1="checked='checked'";$comrtm2="";$comrtm3="";$comrtm4="";$comrtm5="";$comrtmos="__________";}
else if($comrelation=="Child"){$comrtm1="";$comrtm2="checked='checked'";$comrtm3="";$comrtm4="";$comrtm5="";$comrtmos="__________";}
else if($comrelation=="Parent"){$comrtm1="";$comrtm2="";$comrtm3="checked='checked'";$comrtm4="";$comrtm5="";$comrtmos="__________";}
else if($comrelation=="Sibling"){$comrtm1="";$comrtm2="";$comrtm3="";$comrtm4="checked='checked'";$comrtm5="";$comrtmos="__________";}
else{$comrtm1="";$comrtm2="";$comrtm3="";$comrtm4="";$comrtm5="checked='checked'";$comrtmos=$comrelationos;}
}

if($comchoose=="M"){
if($comreason=="1"){$comres1="checked='checked'";$comres2="";$comreso="__________";}
else if($comreason=="2"){$comres1="";$comres2="checked='checked'";$comreso=$comreasonos;}
else{$comres1="";$comres2="";$comreso="__________";}
}
else if($comchoose=="R"){
if($comreason=="1"){$comres1="checked='checked'";$comres2="";$comreso="__________";}
else if($comreason=="2"){$comres1="";$comres2="checked='checked'";$comreso=$comreasonos;}
else{$comres1="";$comres2="";$comreso="__________";}
}
else{
if($comreason=="1"){$comres1="";$comres2="";$comreso="__________";}
else if($comreason=="2"){$comres1="";$comres2="";$comreso="__________";}
else{$comres1="";$comres2="";$comreso="__________";}
}

if($comuw=="1"){$comuw1="checked='checked'";$comuw2="";}
else if($comuw=="2"){$comuw1="";$comuw2="checked='checked'";}
else{$comuw1="";$comuw2="";}
/*------------------------------------------------------*/


/*1.PhilHealth Employer No. (PEN): */
$phicofemploy = $emppen; //Place value of PhilHealth Employer No. (PEN) from the DB here.

if(strlen($phicofemploy)==14){
$pen = str_split($phicofemploy);
$pen0 = $pen[0];
$pen1 = $pen[1];
$pen3 = $pen[3];
$pen4 = $pen[4];
$pen5 = $pen[5];
$pen6 = $pen[6];
$pen7 = $pen[7];
$pen8 = $pen[8];
$pen9 = $pen[9];
$pen10 = $pen[10];
$pen11 = $pen[11];
$pen13 = $pen[13];
}
else{
$pen0 = "";
$pen1 = "";
$pen3 = "";
$pen4 = "";
$pen5 = "";
$pen6 = "";
$pen7 = "";
$pen8 = "";
$pen9 = "";
$pen10 = "";
$pen11 = "";
$pen13 = "";
}
/*------------------------------------------------------*/


/*2. Contact No.: */
$employercontactno = $empcontactno;
/*------------------------------------------------------*/


/*3. Business Name: */
$employerbusname = $empbusinessname;
/*------------------------------------------------------*/


/*4. CERTIFICATION OF EMPLOYER: */
$employername = $empname;
$employerdesignation = $empsigdesignation;

$employerdatesigned = date("m-d-Y",strtotime($empdatesigned));

$empdatesiarr=str_split($employerdatesigned);

if(($empdatesigned!="")&&($empdatesigned!="--")){
$empdatesiarr0 = $empdatesiarr[0];
$empdatesiarr1 = $empdatesiarr[1];
$empdatesiarr3 = $empdatesiarr[3];
$empdatesiarr4 = $empdatesiarr[4];
$empdatesiarr6 = $empdatesiarr[6];
$empdatesiarr7 = $empdatesiarr[7];
$empdatesiarr8 = $empdatesiarr[8];
$empdatesiarr9 = $empdatesiarr[9];
}
else{
$empdatesiarr0 = "";
$empdatesiarr1 = "";
$empdatesiarr3 = "";
$empdatesiarr4 = "";
$empdatesiarr6 = "";
$empdatesiarr7 = "";
$empdatesiarr8 = "";
$empdatesiarr9 = "";
}
/*------------------------------------------------------*/


/*PART III - CONSENT TO ACCESS PATIENT RECORD/S */

if($carchoose=="M"){
$consentaccname = $mfnamerel." ".$mmnamerel." ".$mlnamerel." ".$msuffixrel;
}
else{
$consentaccname = $carname;
}

$consentaccdatesigned = date("m-d-Y",strtotime($cardatesigned));

$consentaccsiarr=str_split($consentaccdatesigned);

if(($cardatesigned!="")&&($cardatesigned!="--")){
$consentaccsiarr0 = $consentaccsiarr[0];
$consentaccsiarr1 = $consentaccsiarr[1];
$consentaccsiarr3 = $consentaccsiarr[3];
$consentaccsiarr4 = $consentaccsiarr[4];
$consentaccsiarr6 = $consentaccsiarr[6];
$consentaccsiarr7 = $consentaccsiarr[7];
$consentaccsiarr8 = $consentaccsiarr[8];
$consentaccsiarr9 = $consentaccsiarr[9];
}
else{
$consentaccsiarr0 = "";
$consentaccsiarr1 = "";
$consentaccsiarr3 = "";
$consentaccsiarr4 = "";
$consentaccsiarr6 = "";
$consentaccsiarr7 = "";
$consentaccsiarr8 = "";
$consentaccsiarr9 = "";
}

$consentaccrelation = $carrelation;

if($carchoose=="M"){
if($carrelation=="Spouse"){$carrtm1="checked='checked'";$carrtm2="";$carrtm3="";$carrtm4="";$carrtm5="";$carrtmos="__________";}
else if($carrelation=="Child"){$carrtm1="";$carrtm2="checked='checked'";$carrtm3="";$carrtm4="";$carrtm5="";$carrtmos="__________";}
else if($carrelation=="Parent"){$carrtm1="";$carrtm2="";$carrtm3="checked='checked'";$carrtm4="";$carrtm5="";$carrtmos="__________";}
else if($carrelation=="Sibling"){$carrtm1="";$carrtm2="";$carrtm3="";$carrtm4="checked='checked'";$carrtm5="";$carrtmos="__________";}
else{$carrtm1="";$carrtm2="";$carrtm3="";$carrtm4="";$carrtm5="checked='checked'";$carrtmos=$carrelation;}
}
else if($carchoose=="R"){
if($carrelation=="Spouse"){$carrtm1="checked='checked'";$carrtm2="";$carrtm3="";$carrtm4="";$carrtm5="";$carrtmos="__________";}
else if($carrelation=="Child"){$carrtm1="";$carrtm2="checked='checked'";$carrtm3="";$carrtm4="";$carrtm5="";$carrtmos="__________";}
else if($carrelation=="Parent"){$carrtm1="";$carrtm2="";$carrtm3="checked='checked'";$carrtm4="";$carrtm5="";$carrtmos="__________";}
else if($carrelation=="Sibling"){$carrtm1="";$carrtm2="";$carrtm3="";$carrtm4="checked='checked'";$carrtm5="";$carrtmos="__________";}
else{$carrtm1="";$carrtm2="";$carrtm3="";$carrtm4="";$carrtm5="checked='checked'";$carrtmos=$carrelationos;}
}
else{
if($carrelation=="Spouse"){$carrtm1="checked='checked'";$carrtm2="";$carrtm3="";$carrtm4="";$carrtm5="";$carrtmos="__________";}
else if($carrelation=="Child"){$carrtm1="";$carrtm2="checked='checked'";$carrtm3="";$carrtm4="";$carrtm5="";$carrtmos="__________";}
else if($carrelation=="Parent"){$carrtm1="";$carrtm2="";$carrtm3="checked='checked'";$carrtm4="";$carrtm5="";$carrtmos="__________";}
else if($carrelation=="Sibling"){$carrtm1="";$carrtm2="";$carrtm3="";$carrtm4="checked='checked'";$carrtm5="";$carrtmos="__________";}
else{$carrtm1="";$carrtm2="";$carrtm3="";$carrtm4="";$carrtm5="checked='checked'";$carrtmos=$carrelationos;}
}

if($carchoose=="M"){
if($carreason=="1"){$carres1="checked='checked'";$carres2="";$carresos="__________";}
else if($carreason=="2"){$carres1="";$carres2="checked='checked'";$carresos=$carreason;}
else{$carres1="";$carres2="";$carresos="__________";}
}
else if($carchoose=="R"){
if($carreason=="1"){$carres1="checked='checked'";$carres2="";$carresos="__________";}
else if($carreason=="2"){$carres1="";$carres2="checked='checked'";$carresos=$carreason;}
else{$carres1="";$carres2="";$carresos="";}
}
else{
if($carreason=="1"){$carres1="checked='checked'";$carres2="";$carresos="__________";}
else if($carreason=="2"){$carres1="";$carres2="checked='checked'";$carresos=$carreason;}
else{$carres1="";$carres2="";$carresos="__________";}
}

if($caruw=="1"){$caruw1="checked='checked'";$caruw2="";}
else if($caruw=="2"){$caruw1="";$caruw2="checked='checked'";}
else{$caruw1="";$caruw2="";}
/*------------------------------------------------------*/

/*PART V - PROVIDER INFORMATION AND CERTIFICATION*/
$hcidatesignedfmt = date("m-d-Y",strtotime($hcidatesigned));

$hcidtarr=str_split($hcidatesignedfmt);

if(($hcidatesigned!="")&&($hcidatesigned!="--")){
$hcidtarr0 = $hcidtarr[0];
$hcidtarr1 = $hcidtarr[1];
$hcidtarr3 = $hcidtarr[3];
$hcidtarr4 = $hcidtarr[4];
$hcidtarr6 = $hcidtarr[6];
$hcidtarr7 = $hcidtarr[7];
$hcidtarr8 = $hcidtarr[8];
$hcidtarr9 = $hcidtarr[9];
}
else{
$hcidtarr0 = "";
$hcidtarr1 = "";
$hcidtarr3 = "";
$hcidtarr4 = "";
$hcidtarr6 = "";
$hcidtarr7 = "";
$hcidtarr8 = "";
$hcidtarr9 = "";
}

$dcname=$doctor;

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());
mysql_query('SET NAMES utf8');
$dfsql=mysql_query("SELECT phicacc FROM docfile WHERE name like '$dcname'");
$dfcount=mysql_num_rows($dfsql);
if($dfcount==0){
$phicacc="";

$dclname="";
$dcfname="";
$dcmname="";
$dcsuffix="";

$pa10 = "";
$pa11 = "";
$pa12 = "";
$pa13 = "";
$pa14 = "";
$pa15 = "";
$pa16 = "";
$pa17 = "";
$pa18 = "";
$pa19 = "";
$pa110 = "";
$pa111 = "";
$pa112 = "";
$pa113 = "";
}
else{
while($dffetch=mysql_fetch_array($dfsql)){$phicacc=$dffetch['phicacc'];}

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());
mysql_query('SET NAMES utf8');
$ddsql=mysql_query("SELECT UPPER(lastname) AS lastname, UPPER(firstname) AS firstname, UPPER(middlename) AS middlename, UPPER(suffix) AS suffix FROM docdetails WHERE phicacc='$phicacc'");
$ddcount=mysql_num_rows($ddsql);
if($ddcount==0){
$dclname="";
$dcfname="";
$dcmname="";
$dcsuffix="";

$pa10 = "";
$pa11 = "";
$pa12 = "";
$pa13 = "";
$pa14 = "";
$pa15 = "";
$pa16 = "";
$pa17 = "";
$pa18 = "";
$pa19 = "";
$pa110 = "";
$pa111 = "";
$pa112 = "";
$pa113 = "";
}
else{
while($ddfetch=mysql_fetch_array($ddsql)){
$dclname=$ddfetch['lastname'];
$dcfname=$ddfetch['firstname'];
$dcmname=$ddfetch['middlename'];
$dcsuffix=$ddfetch['suffix'];
}

$pa1 = str_split($phicacc);
$pa10 = $pa1[0];
$pa11 = $pa1[1];
$pa12 = $pa1[2];
$pa13 = $pa1[3];
$pa14 = $pa1[4];
$pa15 = $pa1[5];
$pa16 = $pa1[6];
$pa17 = $pa1[7];
$pa18 = $pa1[8];
$pa19 = $pa1[9];
$pa110 = $pa1[10];
$pa111 = $pa1[11];
$pa112 = $pa1[12];
$pa113 = $pa1[13];
}


}

$pfname1=$dcfname." ".$dcmname." ".$dclname." ".$dcsuffix;

//PF2

$dcname2=$doctor2;

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());
mysql_query('SET NAMES utf8');
$df2sql=mysql_query("SELECT phicacc FROM docfile WHERE name='$dcname2'");
$df2count=mysql_num_rows($df2sql);
if($df2count==0){
$phicacc2="";

$dc2lname="";
$dc2fname="";
$dc2mname="";
$dc2suffix="";

$pa20 = "";
$pa21 = "";
$pa22 = "";
$pa23 = "";
$pa24 = "";
$pa25 = "";
$pa26 = "";
$pa27 = "";
$pa28 = "";
$pa29 = "";
$pa210 = "";
$pa211 = "";
$pa212 = "";
$pa213 = "";
}
else{
while($df2fetch=mysql_fetch_array($df2sql)){$phicacc2=$df2fetch['phicacc'];}

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());
mysql_query('SET NAMES utf8');
$dd2sql=mysql_query("SELECT UPPER(lastname) AS lastname, UPPER(firstname) AS firstname, UPPER(middlename) AS middlename, UPPER(suffix) AS suffix FROM docdetails WHERE phicacc='$phicacc2'");
$dd2count=mysql_num_rows($dd2sql);
if($dd2count==0){
$dc2lname="";
$dc2fname="";
$dc2mname="";
$dc2suffix="";

$pa20 = "";
$pa21 = "";
$pa22 = "";
$pa23 = "";
$pa24 = "";
$pa25 = "";
$pa26 = "";
$pa27 = "";
$pa28 = "";
$pa29 = "";
$pa210 = "";
$pa211 = "";
$pa212 = "";
$pa213 = "";
}
else{
while($dd2fetch=mysql_fetch_array($dd2sql)){
$dc2lname=$dd2fetch['lastname'];
$dc2fname=$dd2fetch['firstname'];
$dc2mname=$dd2fetch['middlename'];
$dc2suffix=$dd2fetch['suffix'];
}

$pa2123 = str_split($phicacc2);
$pa20 = $pa2123[0];
$pa21 = $pa2123[1];
$pa22 = $pa2123[2];
$pa23 = $pa2123[3];
$pa24 = $pa2123[4];
$pa25 = $pa2123[5];
$pa26 = $pa2123[6];
$pa27 = $pa2123[7];
$pa28 = $pa2123[8];
$pa29 = $pa2123[9];
$pa210 = $pa2123[10];
$pa211 = $pa2123[11];
$pa212 = $pa2123[12];
$pa213 = $pa2123[13];
}

}

$pfname2=$dc2fname." ".$dc2mname." ".$dc2lname." ".$dc2suffix;

//PF3

$dcname3=$doctor3;

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());
mysql_query('SET NAMES utf8');
$df3sql=mysql_query("SELECT phicacc FROM docfile WHERE name='$dcname3'");
$df3count=mysql_num_rows($df3sql);
if($df3count==0){
$phicacc3="";

$dc3lname="";
$dc3fname="";
$dc3mname="";
$dc3suffix="";

$pa30 = "";
$pa31 = "";
$pa32 = "";
$pa33 = "";
$pa34 = "";
$pa35 = "";
$pa36 = "";
$pa37 = "";
$pa38 = "";
$pa39 = "";
$pa310 = "";
$pa311 = "";
$pa312 = "";
$pa313 = "";
}
else{
while($df3fetch=mysql_fetch_array($df3sql)){$phicacc3=$df3fetch['phicacc'];}

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());
mysql_query('SET NAMES utf8');
$dd3sql=mysql_query("SELECT UPPER(lastname) AS lastname, UPPER(firstname) AS firstname, UPPER(middlename) AS middlename, UPPER(suffix) AS suffix FROM docdetails WHERE phicacc='$phicacc3'");
$dd3count=mysql_num_rows($dd3sql);
if($dd3count==0){
$dc3lname="";
$dc3fname="";
$dc3mname="";
$dc3suffix="";

$pa30 = "";
$pa31 = "";
$pa32 = "";
$pa33 = "";
$pa34 = "";
$pa35 = "";
$pa36 = "";
$pa37 = "";
$pa38 = "";
$pa39 = "";
$pa310 = "";
$pa311 = "";
$pa312 = "";
$pa313 = "";
}
else{
while($dd3fetch=mysql_fetch_array($dd3sql)){
$dc3lname=$dd3fetch['lastname'];
$dc3fname=$dd3fetch['firstname'];
$dc3mname=$dd3fetch['middlename'];
$dc3suffix=$dd3fetch['suffix'];
}

$pa3123 = str_split($phicacc3);
$pa30 = $pa3123[0];
$pa31 = $pa3123[1];
$pa32 = $pa3123[2];
$pa33 = $pa3123[3];
$pa34 = $pa3123[4];
$pa35 = $pa3123[5];
$pa36 = $pa3123[6];
$pa37 = $pa3123[7];
$pa38 = $pa3123[8];
$pa39 = $pa3123[9];
$pa310 = $pa3123[10];
$pa311 = $pa3123[11];
$pa312 = $pa3123[12];
$pa313 = $pa3123[13];
}

}

$pfname3=$dc3fname." ".$dc3mname." ".$dc3lname." ".$dc3suffix;


//PF4





$pfdatesigned = date("m-d-Y",strtotime($datesigned));

$pfdatesiarr=str_split($pfdatesigned);

if(($datesigned!="")&&($datesigned!="0000-00-00")){
$pfdatesiarr0 = $pfdatesiarr[0];
$pfdatesiarr1 = $pfdatesiarr[1];
$pfdatesiarr3 = $pfdatesiarr[3];
$pfdatesiarr4 = $pfdatesiarr[4];
$pfdatesiarr6 = $pfdatesiarr[6];
$pfdatesiarr7 = $pfdatesiarr[7];
$pfdatesiarr8 = $pfdatesiarr[8];
$pfdatesiarr9 = $pfdatesiarr[9];
}
else{
$pfdatesiarr0 = "";
$pfdatesiarr1 = "";
$pfdatesiarr3 = "";
$pfdatesiarr4 = "";
$pfdatesiarr6 = "";
$pfdatesiarr7 = "";
$pfdatesiarr8 = "";
$pfdatesiarr9 = "";
}


$pfdatesigned2 = date("m-d-Y",strtotime($datesigned2));

$pfdatesiarr2111=str_split($pfdatesigned2);

if(($datesigned2!="")&&($datesigned2!="0000-00-00")){
$pfdatesiarr20 = $pfdatesiarr2111[0];
$pfdatesiarr21 = $pfdatesiarr2111[1];
$pfdatesiarr23 = $pfdatesiarr2111[3];
$pfdatesiarr24 = $pfdatesiarr2111[4];
$pfdatesiarr26 = $pfdatesiarr2111[6];
$pfdatesiarr27 = $pfdatesiarr2111[7];
$pfdatesiarr28 = $pfdatesiarr2111[8];
$pfdatesiarr29 = $pfdatesiarr2111[9];
}
else{
$pfdatesiarr20 = "";
$pfdatesiarr21 = "";
$pfdatesiarr23 = "";
$pfdatesiarr24 = "";
$pfdatesiarr26 = "";
$pfdatesiarr27 = "";
$pfdatesiarr28 = "";
$pfdatesiarr29 = "";
}


$pfdatesigned3 = date("m-d-Y",strtotime($datesigned3));

$pfdatesiarr3111=str_split($pfdatesigned3);

if(($datesigned3!="")&&($datesigned3!="0000-00-00")){
$pfdatesiarr30 = $pfdatesiarr3111[0];
$pfdatesiarr31 = $pfdatesiarr3111[1];
$pfdatesiarr33 = $pfdatesiarr3111[3];
$pfdatesiarr34 = $pfdatesiarr3111[4];
$pfdatesiarr36 = $pfdatesiarr3111[6];
$pfdatesiarr37 = $pfdatesiarr3111[7];
$pfdatesiarr38 = $pfdatesiarr3111[8];
$pfdatesiarr39 = $pfdatesiarr3111[9];
}
else{
$pfdatesiarr30 = "";
$pfdatesiarr31 = "";
$pfdatesiarr33 = "";
$pfdatesiarr34 = "";
$pfdatesiarr36 = "";
$pfdatesiarr37 = "";
$pfdatesiarr38 = "";
$pfdatesiarr39 = "";
}



$pcasesql=mysql_query("SELECT icdcode FROM finalcaserate WHERE caseno='$caseno' AND level='primary'");
$pcasecount=mysql_num_rows($pcasesql);
if($pcasecount==0){
$pcase="";
}
else{
while($pcasefetch=mysql_fetch_array($pcasesql)){$pcase=$pcasefetch['icdcode'];}
}

$scasesql=mysql_query("SELECT icdcode FROM finalcaserate WHERE caseno='$caseno' AND level='secondary'");
$scasecount=mysql_num_rows($scasesql);
if($scasecount==0){
$scase="";
}
else{
while($scasefetch=mysql_fetch_array($scasesql)){$scase=$scasefetch['icdcode'];}
}


if($hcidtarr0==""){$hcidtarr0=$pfdatesiarr0;}
if($hcidtarr1==""){$hcidtarr1=$pfdatesiarr1;}
if($hcidtarr3==""){$hcidtarr3=$pfdatesiarr3;}
if($hcidtarr4==""){$hcidtarr4=$pfdatesiarr4;}
if($hcidtarr6==""){$hcidtarr6=$pfdatesiarr6;}
if($hcidtarr7==""){$hcidtarr7=$pfdatesiarr7;}
if($hcidtarr8==""){$hcidtarr8=$pfdatesiarr8;}
if($hcidtarr9==""){$hcidtarr9=$pfdatesiarr9;}

echo "





<!doctype html>
<html>
<head>
<meta http-equiv='content-type' content='text/html; charset=utf-8' />
<title>Claim Signature Form</title>
</head>
	<style>
		
		#phicborder {
			border: #000000 solid 1px;
			width: 750px;
			height: auto;
		}
		
		#smallbox {
			border: #000000 solid 1px;
			width: 13px;
			height: 14px;
			font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';
			font-size: 10px;
			line-height: 1;
			text-align: center;
			
		}
		
		#bigbox {
			border: #000000 solid 2px;
			width: 80px;
			height: 65px;
			
		}
		#bottomborderdv {
			border-bottom: #000000 solid 1px;
			font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';
			font-size: 10px;
			line-height: 1;
			vertical-align: bottom;
			text-align: left;
		}
		
		#header {
			border: #000000 solid 1px;
		}
		#body {
			border: #000000 solid 1px;
		}
		#part1 {
			border: #000000 solid 1px;
		}
		.boxborder {
			border: #000000 solid 1px;
			font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';
			font-size: 10px;
			line-height: 1;
		}
		.boxborder2 {
			border: #000000 solid 2px;
		}
		.bottomboxborder {
			border-bottom: #000000 solid 1px;
			font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';
			font-size: 10px;
			line-height: 1;
		}
		.part1style {
			font-weight: bold;
			font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';
			font-size: 10px;
			line-height: 1;
			background: #000000;
			color: white;
			
		}
		.stylebody {
			font-weight: bold;
			font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';
			font-size: 10px;
			line-height: 1;
			
		}
		.stylebody1 {
			
			font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';
			font-size: 8px;
			line-height: 1;
		}
		.stylebody12 {
			
			font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';
			font-size: 9px;
			line-height: 1.2;
		}
		.stylebodyp1 {
			
			font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';
			font-size: 9px;
			line-height: 1;
		}
		.stylebody2 {
			font-weight: bold;
			font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';
			font-size: 8px;
			line-height: 1;
		}
		.stylebody21 {
			font-weight: bold;
			font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';
			font-size: 9px;
			line-height: 1;
		}
		.stylebody3 {
			
			font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';
			font-size: 10px;
			line-height: 1;
		}
		
		.stylehead {
			font-family:Baskerville, Palatino Linotype, Palatino, Century Schoolbook L, Times New Roman, serif;
			font-size: 10px;
			line-height: 1;
		
		}
		.stylehead1 {
			font-weight: bold;
			font-family:Baskerville, Palatino Linotype, Palatino, Century Schoolbook L, Times New Roman, serif;
			font-size: 12px;
			line-height: 1;
		
		}
		.stylehead2 {
			font-weight: bold;
			font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';
			font-size: 50px;
			line-height: 1;
		
		}
		.stylehead3 {
			font-weight: bold;
			font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';
			font-size: 10px;
			line-height: 1;
			vertical-align:middle;
		
		}
		.larger111211111 {
			-webkit-transform:scale(1.5,1.5);

			-icab-transform:scale(1.5,1.5);
			-moz-transform:scale(1.5,1.5);
			-ms-transform:scale(1.5,1.5);
			-o-transform:scale(1.5,1.5);
			transform:scale(1.5,1.5);
		}
		
		
		
	</style>
<body>



<div id='phicborder'>

<!-- HEADER START HERE-->

  <div id ='header'>
		<table width='750' border='0' cellpadding='0' cellspacing='0'>
  			<tbody>
    		<tr>
      		<td width='14%' ><div align='left'><img src='Image/Logo.jpg' height='76' width='auto' /></div></td>
      		<td width='53%' align='center'><div class='stylehead'><i>Republic of the Philippines</i></div><div class='stylehead1'>PHILIPPINE HEALTH INSURANCE CORPORATION</div><div class='stylehead' >Citystate Centre 709 Shaw Boulevard, Pasig City</div><div class='stylehead'>Call Center (02) 441-7442 * Trunkline (02) 441-7444</div>  <div class='stylehead'>www.philhealth.gov.ph</div><div class='stylehead'>email:actioncenter@philhealth.gov.ph</div></td>
      		<td width='25%' align='center' ><div class='stylebody1'>This form may be reproduced and</div><div class='stylebody1' >is NOT FOR SALE</div><div class='stylehead2'>CSF</div><div class='stylehead3'>(Claim Signature Form)</div><div class='stylebody1' >Revised September 1418</div></td>
    		</tr>
    		</tbody>
		</table>
	
	</div>
	
<!-- HEADER BODY START HERE-->
	
	<div id='body'>
		<table width='750' border='0' cellspacing='0' cellpadding='0'>
  		<tbody>
   			<tr>
   			<td colspan='14' height='4'></td>
   			</tr>
    		<tr >
    		<td width='4'>&nbsp;</td>
			  <td width='600' class='stylebody21' valign='middle' >IMPORTANT REMINDERS:</td>
			  <td width='62'  class='stylebody3'>Series #</td>
				<td width='14'><div id='smallbox'></div></td>
			  <td width='14' ><div id='smallbox'></div></td>
			  <td width='14' ><div id='smallbox'></div></td>
			  <td width='14' ><div id='smallbox'></div></td>
			  <td width='14' ><div id='smallbox'></div></td>
			  <td width='14' ><div id='smallbox'></div></td>
			  <td width='14' ><div id='smallbox'></div></td>
			  <td width='14' ><div id='smallbox'></div></td>
			  <td width='14' ><div id='smallbox'></div></td>
			  <td width='14' ><div id='smallbox'></div></td>
			  <td width='14' ><div id='smallbox'></div></td>
			  <td width='14' ><div id='smallbox'></div></td>
			  <td width='14' ><div id='smallbox'></div></td>
			  <td width='14' ><div id='smallbox'></div></td>
			  <td width='14' ><div id='smallbox'></div></td>
			  <td width='14' ><div id='smallbox'></div></td>
			  <td width='4'>&nbsp;</td>
			</tr>
			
			<tr>
		  <td width='4'>&nbsp;</td>
			  <td colspan='18' rowspan='2' class='stylebody12' valign='top'><span class='stylebody12'>PLEASE WRITE IN CAPITAL <strong>LETTERS</strong> AND <strong>CHECK</strong> THE APPROPRIATE BOXES.</span><br><span class='stylebody12'>All Information required in this form are necessary. Claim forms with incomplete information shall not be processed.</span><br> <span class='stylebody21'>FALSE/INCORRECT INFORMATION OR MISREPRESENTATION SHALL BE SUBJECT TO CRIMINAL, CIVIL OR ADMINISTRATIVE LIABILITIES.</span></td>
			  <td>&nbsp;</td>
			</tr>
			
			
		  </tbody>
	</table>
	</div>
<!-- PART 1 START HERE-->
					<div id='part1'>

					  <table width='750' border='0' cellspacing='0' cellpadding='0'>
					  <tbody>
						<tr>
						  <th colspan='41' scope='col' class='part1style' height='15' align='center' valign='middle'>PART I - MEMBER AND PATIENT INFORMATION AND CERTIFICATION</th>
					    </tr>
					    <tr>
						  <td colspan='41' height='4'></td>
					    </tr>
						<tr>
						  <td width='7'>&nbsp;</td>
						  <td colspan='10' class='stylebody'>1. PhilHealth Identification Number (PIN) of Member:</td>
						  
						  <td width='14'><div id='smallbox'>$phicmember0</div></td>
						  <td width='14'><div id='smallbox'>$phicmember1</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$phicmember3</div></td>
						  <td width='14'><div id='smallbox'>$phicmember4</div></td>
						  <td width='14'><div id='smallbox'>$phicmember5</div></td>
						  <td width='14'><div id='smallbox'>$phicmember6</div></td>
						  <td width='14'><div id='smallbox'>$phicmember7</div></td>
						  <td width='14'><div id='smallbox'>$phicmember8</div></td>
						  <td width='14'><div id='smallbox'>$phicmember9</div></td>
						  <td width='14'><div id='smallbox'>$phicmember10</div></td>
						  <td width='14'><div id='smallbox'>$phicmember11</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$phicmember13</div></td>
						  
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  
					    </tr>
						<tr>
						  <td>&nbsp;</td>
						  <td colspan='10' class='stylebody'>2. Name of Member:</td>
						  <td width='14' >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td colspan='11' class='stylebody'>3. Member Date of Birth:</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td colspan='4' class='bottomboxborder' align='center'>$LN</td>
						  <td width='14'>&nbsp;</td>
						  <td colspan='4' class='bottomboxborder' align='center'>$FN</td>
						  <td width='14'>&nbsp;</td>
						  <td colspan='6' class='bottomboxborder' align='center'>$MS</td>
						  <td>&nbsp;</td>
						  <td colspan='8' class='bottomboxborder' align='center'>$MN</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td width='14'><div id='smallbox'>$bdayofmemarr0</div></td>
						  <td width='14'><div id='smallbox'>$bdayofmemarr1</div></td>
						  <td align='center'>-</td>
						  <td width='14'><div id='smallbox'>$bdayofmemarr3</div></td>
						  <td width='14'><div id='smallbox'>$bdayofmemarr4</div></td>
						  <td align='center'>-</td>
						  <td width='14'><div id='smallbox'>$bdayofmemarr6</div></td>
						  <td width='14'><div id='smallbox'>$bdayofmemarr7</div></td>
						  <td width='14'><div id='smallbox'>$bdayofmemarr8</div></td>
						  <td width='14'><div id='smallbox'>$bdayofmemarr9</div></td>
						  <td>&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td colspan='4' valign='top' align='center' class='stylebodyp1'>Last Name</td>
						  <td>&nbsp;</td>
						  <td colspan='4' valign='top' align='center' class='stylebodyp1'>First Name</td>
						  <td>&nbsp;</td>
						  <td colspan='6' valign='top'  align='center' class='stylebodyp1'>Name Extension<br>
						    (JR/SR/III)</td>
						    <td>&nbsp;</td>
						    <td colspan='8' valign='top'  align='center' class='stylebodyp1' >Middle Name<br>(ex:DELA CRUZ JUAN JR SIPAG)</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td colspan='2' valign='top'  align='center' class='stylebodyp1'>month</td>
						  <td>&nbsp;</td>
						  <td colspan='2' valign='top'  align='center' class='stylebodyp1'>day</td>
						  <td>&nbsp;</td>
						  <td colspan='4' valign='top'  align='center' class='stylebodyp1'>year</td>
						  <td>&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						</tr>
						<tr>
						  <td colspan='41' height='8'></td>
					    </tr>
						<tr>
						  <td width='7'>&nbsp;</td>
						  <td colspan='10' class='stylebody'>4. PhilHealth Identification Number (PIN) of Dependent:</td>
						  
						  <td width='14'><div id='smallbox'>$phicdep0</div></td>
						  <td width='14'><div id='smallbox'>$phicdep1</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$phicdep3</div></td>
						  <td width='14'><div id='smallbox'>$phicdep4</div></td>
						  <td width='14'><div id='smallbox'>$phicdep5</div></td>
						  <td width='14'><div id='smallbox'>$phicdep6</div></td>
						  <td width='14'><div id='smallbox'>$phicdep7</div></td>
						  <td width='14'><div id='smallbox'>$phicdep8</div></td>
						  <td width='14'><div id='smallbox'>$phicdep9</div></td>
						  <td width='14'><div id='smallbox'>$phicdep10</div></td>
						  <td width='14'><div id='smallbox'>$phicdep11</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$phicdep13</div></td>
						  
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='7' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='7' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  
					    </tr>
						
						
						<tr>
						  <td>&nbsp;</td>
						  <td colspan='10' class='stylebody'>5. Name of Patient:</td>
						  <td width='14' >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td colspan='11' class='stylebody'>6. Relationship to Member:</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td colspan='4' align='center' class='bottomboxborder'>$LNPat</td>
						  <td width='14'>&nbsp;</td>
						  <td colspan='4' align='center' class='bottomboxborder'>$FNPat</td>
						  <td width='14'>&nbsp;</td>
						  <td colspan='6' align='center' class='bottomboxborder'>$MNSuf</td>
						  <td>&nbsp;</td>
						  <td colspan='8' align='center' class='bottomboxborder'>$MNPat</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td width='14'><input name='checkbox' type='checkbox' class='larger11121111' $rom1 /></td>
						  <td colspan='3'  valign='middle'  align='left' class='stylebodyp1'>&nbsp; child</td>
						  <td width='14'><input name='checkbox' type='checkbox' class='larger11121111' $rom2 /></td>
						  <td colspan='3' valign='middle'  align='left' class='stylebodyp1'>&nbsp; parent</td>
						  <td width='14'><input name='checkbox' type='checkbox' class='larger11121111' $rom3 /></td>
						  <td colspan='3' valign='middle'  align='left' class='stylebodyp1'>&nbsp; spouse</td>
						  <td >&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td colspan='4' valign='top' align='center' class='stylebodyp1'>Last Name</td>
						  <td>&nbsp;</td>
						  <td colspan='4' valign='top' align='center' class='stylebodyp1'>First Name</td>
						  <td>&nbsp;</td>
						  <td colspan='6' valign='top'  align='center' class='stylebodyp1'>Name Extension<br>
						    (JR/SR/III)</td>
						    <td>&nbsp;</td>
						    <td colspan='8' valign='top'  align='center' class='stylebodyp1' >Middle Name<br>(ex:DELA CRUZ JUAN JR SIPAG)</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						</tr>
						</tbody>
					</table>
					
					<table width='750' border='0' cellspacing='0' cellpadding='0'>
					  <tbody>
					
					
					
						<tr>
						  <td colspan='41' height='8'></td>
					    </tr>
						
						<tr>
						  <td width='4'>&nbsp;</td>
						  <td colspan='10' class='stylebody'>7. Confinement Period:</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='33'>&nbsp;</td>
						  <td width='33'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						
						  <td colspan='13' class='stylebody'>8. Patient Date of Birth:</td>
					    </tr>
						<tr>
						  <td width='4'>&nbsp;</td>
						  <td colspan='6' class='stylebodyp1'>a. Date Admitted:</td>
						  <td width='14'><div id='smallbox'>$dateadmittedarr0</div></td>
						  <td width='14'><div id='smallbox'>$dateadmittedarr1</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$dateadmittedarr3</div></td>
						  <td width='14'><div id='smallbox'>$dateadmittedarr4</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$dateadmittedarr6</div></td>
						  <td width='14'><div id='smallbox'>$dateadmittedarr7</div></td>
						  <td width='14'><div id='smallbox'>$dateadmittedarr8</div></td>
						  <td width='14'><div id='smallbox'>$dateadmittedarr9</div></td>
						  
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td class='stylebodyp1' colspan='4'>b. Date Discharged:</td>
						  <td width='14'><div id='smallbox'>$datedischargedarr0</div></td>
						  <td width='14'><div id='smallbox'>$datedischargedarr1</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$datedischargedarr3</div></td>
						  <td width='14'><div id='smallbox'>$datedischargedarr4</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$datedischargedarr6</div></td>
						  <td width='14'><div id='smallbox'>$datedischargedarr7</div></td>
						  <td width='14'><div id='smallbox'>$datedischargedarr8</div></td>
						  <td width='14'><div id='smallbox'>$datedischargedarr9</div></td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						   <td>&nbsp;</td>
						 
						  <td width='14'><div id='smallbox'>$bdayofpatarr0</div></td>
						  <td width='14'><div id='smallbox'>$bdayofpatarr1</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$bdayofpatarr3</div></td>
						  <td width='14'><div id='smallbox'>$bdayofpatarr4</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$bdayofpatarr6</div></td>
						  <td width='14'><div id='smallbox'>$bdayofpatarr7</div></td>
						  <td width='14'><div id='smallbox'>$bdayofpatarr8</div></td>
						  <td width='14'><div id='smallbox'>$bdayofpatarr9</div></td>
						  <td width='30'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						   <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						 <td width='14'>&nbsp;</td>
						   <td colspan='2' valign='top'  align='center' class='stylebodyp1'>month</td>
						  <td>&nbsp;</td>
						  <td colspan='2' valign='top'  align='center' class='stylebodyp1'>day</td>
						  <td>&nbsp;</td>
						  <td colspan='4' valign='top'  align='center' class='stylebodyp1'>year</td>
						  <td>&nbsp;</td>
					    <td>&nbsp;</td>
						  <td>&nbsp;</td>
						    <td>&nbsp;</td>
						     <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  
						  <td colspan='2' valign='top'  align='center' class='stylebodyp1'>month</td>
						  <td>&nbsp;</td>
						  <td colspan='2' valign='top'  align='center' class='stylebodyp1'>day</td>
						  <td>&nbsp;</td>
						  <td colspan='4' valign='top'  align='center' class='stylebodyp1'>year</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						
						
						  <td colspan='2' valign='top'  align='center' class='stylebodyp1'>month</td>
						  <td>&nbsp;</td>
						  <td colspan='2' valign='top'  align='center' class='stylebodyp1'>day</td>
						  <td>&nbsp;</td>
						  <td colspan='4' valign='top'  align='center' class='stylebodyp1'>year</td>
						  <td>&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						</tr>
					  </tbody>
					</table>
					
					<table width='750' border='0' cellspacing='0' cellpadding='0'>
					  <tbody>
					
						
						<tr>
						  <td width='14'>&nbsp;</td>
						  <td colspan='8' class='stylebody'>9. CERTIFICATION OF MEMBER:</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14' >&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='21'>&nbsp;</td>
					    </tr>
						
						<tr>
						  <td>&nbsp;</td>
						   <td colspan='44' align='center' class='stylebodyp1'><strong><i>Under the penalty of low, I attest that the information I provided in this Form are true and accurate to the best of my knowledge.</i></strong></td>
						  <td width='4' >&nbsp;</td>
						  <td width='4' >&nbsp;</td>
						</tr>
						
						<tr>
						  <td colspan='44' height='8'></td>
					    </tr>
						<tr>
						  <td width='14'>&nbsp;</td>
						  <td width='18'>&nbsp;</td>
						  <td width='18'>&nbsp;</td>
						  <td width='18'>&nbsp;</td>
						   <td colspan='11' class='bottomboxborder' align='center'>$comnamem</td>
						  <td >&nbsp;</td>
						  <td colspan='21' class='bottomboxborder' align='center'>$comnamer</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						  
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						</tr>
						
						
						<tr>
						  <td>&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						   <td colspan='11' align='center' class='stylebodyp1'>Signature Over Printed Name of Member</td>
						  <td >&nbsp;</td>
						  <td colspan='21' align='center' class='stylebodyp1'>Signature Over Printed Name of Member's Representative</td>
						  
						  <td >&nbsp;</td>
						  <td>&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						</tr>
						
						<tr>
						  <td>&nbsp;</td>
						   <td width='18' >&nbsp;</td>
						  <td width='18'>&nbsp;</td>
						  <td width='18'>&nbsp;</td>
						  <td class='stylebodyp1'>Date Signed:</td>
						  <td width='14'><div id='smallbox'>$comdatearr01</div></td>
						  <td width='14'><div id='smallbox'>$comdatearr11</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$comdatearr31</div></td>
						  <td width='14'><div id='smallbox'>$comdatearr41</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$comdatearr61</div></td>
						  <td width='14'><div id='smallbox'>$comdatearr71</div></td>
						  <td width='14'><div id='smallbox'>$comdatearr81</div></td>
						  <td width='14'><div id='smallbox'>$comdatearr91</div></td>
						  <td>&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td>&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td>&nbsp;</td>
						  
						  <td colspan='4' class='stylebodyp1'>Date Signed:</td>
						  <td width='14'><div id='smallbox'>$comdatearr02</div></td>
						  <td width='14'><div id='smallbox'>$comdatearr12</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$comdatearr32</div></td>
						  <td width='14'><div id='smallbox'>$comdatearr42</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$comdatearr62</div></td>
						  <td width='14'><div id='smallbox'>$comdatearr72</div></td>
						  <td width='14'><div id='smallbox'>$comdatearr82</div></td>
						  <td width='14'><div id='smallbox'>$comdatearr92</div></td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td>&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td >&nbsp;</td>
						  <td>&nbsp;</td>
						  <td >&nbsp;</td>
						  <td width='4' >&nbsp;</td>
						</tr>
						
						<tr>
						  <td colspan='44' height='8'></td>
					    </tr>
						
						
					  </tbody>
					</table>
					
					<table width='750' border='0' cellspacing='0' cellpadding='0'>
					  <tbody>
					
						
						<tr>
						  <td width='4'>&nbsp;</td>
						  <td colspan='11' rowspan='3' valign='top' align='left' class='stylebodyp1'>If member/representative is unable to write, <br>put right thumbmark. Member/Representative<br>should be assisted by an HCI representative.<br>Check the appropriate box.</td>
						  <td width='8'>&nbsp;</td>
						  <td colspan='7' rowspan='7' valign='top'><div id='bigbox'></div></td>
						  <td width='4' >&nbsp;</td>
						  <td width='30' >&nbsp;</td>
						  
						  <td colspan='9' class='stylebodyp1'>Relationship of the</td>
						  <td width='14'><input name='checkbox' type='checkbox' class='larger11121111' $comrtm1 /></td>
						  <td  valign='middle' width='10' align='left' class='stylebodyp1'>&nbsp;Spouse</td>
						  <td width='14' align='center'>&nbsp;</td>
						  <td width='14'><input name='checkbox' type='checkbox' class='larger11121111' $comrtm2 /></td>
						  <td width='14'  align='left'  valign='middle' class='stylebodyp1'>&nbsp;Child&nbsp;</td>
						  <td width='14'><input name='checkbox' type='checkbox' class='larger11121111' $comrtm3 /></td>
						  <td width='17'  align='left'  valign='middle' class='stylebodyp1'>&nbsp;Parent</td>
						  <td width='53' colspan='-1'>&nbsp;</td>
						  <td width='30' colspan='-1'>&nbsp;</td>
						  <td width='29'>&nbsp;</td>
						  <td width='32'>&nbsp;</td>
						  
						  <td width='14'>&nbsp;</td>
						  
					    </tr>
					    <tr>
						  <td colspan='51' height='2'></td>
					    </tr>
					    <tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td width='30'>&nbsp;</td>
						  
						  <td colspan='9' class='stylebodyp1' valign='top'>representative to the member</td>
						  <td width='14'><input name='checkbox' type='checkbox' class='larger11121111' $comrtm4 /></td>
						  <td  valign='middle'  align='left' class='stylebodyp1'>&nbsp;Siblling</td>
						  <td width='14' align='center'>&nbsp;</td>";
$comrtm5="";
echo "
						  <td width='14'><input name='checkbox' type='checkbox' class='larger11121111' $comrtm5 /></td>
						  <td colspan='3'   class='stylebodyp1'>&nbsp;Other, Specify </td>
						  <td colspan='3' valign='bottom'><div id='bottomborderdv'>$comrtmos</div></td>
						 <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  
					    </tr>
					    
					    <tr>
						  <td colspan='51' height='2'></td>
					    </tr>
					    
					    <tr>
						  <td>&nbsp;</td>
						  <td width='18'><input name='checkbox' type='checkbox' class='larger11121111' $comuw1 /></td>
						  <td colspan='3'  valign='middle'  align='left' class='stylebodyp1'>&nbsp;Member</td>
						  <td width='14'><input name='checkbox' type='checkbox' class='larger11121111' $comuw2 /></td>
						  <td colspan='4' valign='middle'  align='left' class='stylebodyp1'>&nbsp;Representative</td>
						  <td width='14'>&nbsp;</td>
						  <td width='23'>&nbsp;</td>
						  
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
				
						  <td colspan='9' class='stylebodyp1' valign='bottom'>Reason for signing on</td>
						  <td width='14'><input name='checkbox' type='checkbox' class='larger11121111' $comres1 /></td>
						  <td colspan='6'  valign='middle'  align='left' class='stylebodyp1'>&nbsp;Member is incapacitated</td>
						  <td colspan='-1'>&nbsp;</td>
						  <td width='30' colspan='-1'>&nbsp;</td>
						  <td width='29' colspan='-1'>&nbsp;</td>
						  <td width='32' colspan='-1'>&nbsp;</td>
						  <td colspan='-1'>&nbsp;</td>
						  <td colspan='-1'>&nbsp;</td>
						 
						  <td>&nbsp;</td>
						 <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  
					    </tr>
					    
					    <tr>
						  <td colspan='51' height='2'></td>
					    </tr>
					    
					    <tr>
						  <td width='4'>&nbsp;</td>
						  <td width='18'>&nbsp;</td>
						  <td width='18'>&nbsp;</td>
						  <td width='18'>&nbsp;</td>
						  <td width='18'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						
						 
						  
						  <td colspan='9' class='stylebodyp1' valign='center'>Behalf of the member</td>
						  <td width='14'><input name='checkbox' type='checkbox' class='larger11121111' $comres2 /></td>
						  <td colspan='4'  valign='middle'  align='left' class='stylebodyp1'>&nbsp;Other reasons:</td>
						  <td colspan='5' valign='bottom'><div id='bottomborderdv'>$comreso</div>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						 
						  
					    </tr>
					    <tr>
						  <td colspan='51' height='2'></td>
					    </tr>
					    
				      </tbody>
					</table>
					
<!-- PART II - EMPLOYER'S CERTIFICATION -->					
					
					<table width='750' border='0' cellspacing='0' cellpadding='0'>
					  <tbody>
					  <tr>
						  <th colspan='51' scope='col' class='part1style' height='15' align='center' valign='middle'>PART II - EMPLOYER'S CERTIFICATION</th>
					    </tr>
					    <tr>
						  <td colspan='51' height='2'></td>
					    </tr>
					<tr>

						  <td width='4'>&nbsp;</td>
						  <td colspan='11' class='stylebody'>1. PhilHealth Employer Number (PEN):</td>
						  
						  <td width='14'><div id='smallbox'>$pen0</div></td>
						  <td width='14'><div id='smallbox'>$pen1</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$pen3</div></td>
						  <td width='14'><div id='smallbox'>$pen4</div></td>
						  <td width='14'><div id='smallbox'>$pen5</div></td>
						  <td width='14'><div id='smallbox'>$pen6</div></td>
						  <td width='14'><div id='smallbox'>$pen7</div></td>
						  <td width='14'><div id='smallbox'>$pen8</div></td>
						  <td width='14'><div id='smallbox'>$pen9</div></td>
						  <td width='14'><div id='smallbox'>$pen10</div></td>
						  <td width='14'><div id='smallbox'>$pen11</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$pen13</div></td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
					  <td width='14'>&nbsp;</td>
						<td colspan='6' class='stylebody'>2. Contact No. :</td>
			    	  <td colspan='10' width='14' class='bottomboxborder'>$employercontactno</td>
					    <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						 
						  
						 
						  
					    </tr>
					    
					    <tr>
						  <td colspan='51' height='2'></td>
					    </tr>
					    
					    <tr>
						  <td width='4'>&nbsp;</td>
						  <td colspan='4' class='stylebody' >3. Business Name:</td>
						  <td colspan='41'  class='bottomboxborder' align='center' >$employerbusname</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						 
					    </tr>
					    
					    <tr>
						  <td width='4'>&nbsp;</td>
						  <td  >&nbsp;</td>
						  <td  >&nbsp;</td>
						  <td  >&nbsp;</td>
						  <td  >&nbsp;</td>
						  
						  <td colspan='41'  valign='top'  align='center' class='stylebodyp1'>Business Name of Employer</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						 
					    </tr>
					    
					    
					    <tr>
						  <td width='4'>&nbsp;</td>
						  <td colspan='17' class='stylebody' >4. CERTIFICATION OF EMPLOYER:</td>
						  <td  >&nbsp;</td>
						  <td  >&nbsp;</td>
						  <td  >&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						 <td>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						 <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						<td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						 <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						 
					    </tr>
					    
					    <tr>
						  <td width='4'>&nbsp;</td>
						  <td colspan='45'  valign='top' align='justify' class='stylebodyp1'><strong><i>&nbsp;&nbsp;&nbsp;&quot;This is to certify that the required 3/6 monthly premium contributions plus at least 6 months contribution preceding the 3 months qualifying contributions within 12 month period prior to the first day of confinement (sufficient regularity) have been regularly remitted to PhilHealth. Moreover, the information supplied by the member or his/her representative on Part I are consistent with our available records.'</i></strong></td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						 
					    </tr>
					    
					    <tr>
						  <td width='4' height='30'>&nbsp;</td>
						  <td colspan='16' class='bottomboxborder' align='center' valign='bottom'>$employername</td>
						  <td  >&nbsp;</td>
						  <td colspan='12' class='bottomboxborder' align='center' valign='bottom'>$employerdesignation</td>
						  <td width='14'>&nbsp;</td>
						  <td colspan='4' class='stylebodyp1'>Date Signed:</td>
						  <td width='14'><div id='smallbox'>$empdatesiarr0</div></td>
						  <td width='14'><div id='smallbox'>$empdatesiarr1</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$empdatesiarr3</div></td>
						  <td width='14'><div id='smallbox'>$empdatesiarr4</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$empdatesiarr6</div></td>
						  <td width='14'><div id='smallbox'>$empdatesiarr7</div></td>
						  <td width='14'><div id='smallbox'>$empdatesiarr8</div></td>
						  <td width='14'><div id='smallbox'>$empdatesiarr9</div></td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						 
					    </tr>
					    
					    <tr>
						  <td width='4'>&nbsp;</td>
						  <td colspan='16' align='center' class='stylebodyp1' valign='top'>Signature Over Printed Name of Employer/Authorized</td>
						  <td  >&nbsp;</td>
						  <td colspan='12' align='center' class='stylebodyp1' valign='top'>Official Capacity/Designation</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td colspan='2' valign='top'  align='center' class='stylebodyp1'>month</td>
						  <td>&nbsp;</td>
						  <td colspan='2' valign='top'  align='center' class='stylebodyp1'>day</td>
						  <td>&nbsp;</td>
						  <td colspan='4' valign='top'  align='center' class='stylebodyp1'>year</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						 
					    </tr>
					    </tbody>
					</table>
					    
					    <table width='750' border='0' cellspacing='0' cellpadding='0'>
					  <tbody>
					  <tr>
						  <th colspan='51' scope='col' class='part1style' height='15' align='center' valign='middle'>PART III - CONSENT TO ACCESS PATIENT RECORD/S</th>
					    </tr>
					    <tr>
						  <td width='4'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td colspan='48' align='justify' valign='middle' class='stylebodyp1'><strong><i>I hereby consent to the submission and examination of the patient's pertinent medical records for the purpose of verifying the veracity of this claim to effect efficient processing of benefit payment. </i></strong></td>
						  <td width='14'>&nbsp;</td>
						  
					    </tr>
					    
					    <tr>
						  <td width='4'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td colspan='48' valign='middle' align='justify' class='stylebodyp1'><strong><i>I hereby hold PhilHealth or any of its officers, employees and/or representatives free from any legal liabilities relative to the herein-mention consent which I have voluntarily and willingly given in connection with this claim for reimbursement before PhilHealth.</i></strong></td>
						  <td width='14'>&nbsp;</td>
						  
					    </tr>
					    
					    <tr>
						  <td width='4' height='40'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td colspan='23' class='bottomboxborder' align='center' valign='bottom'>$consentaccname</td>
						  <td width='14'>&nbsp;</td>
						  <td colspan='4' class='stylebodyp1'>Date Signed:</td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr0</div></td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr1</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr3</div></td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr4</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr6</div></td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr7</div></td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr8</div></td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr9</div></td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  
					    </tr>
					    
					    <tr>
						  <td width='4'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td colspan='23' valign='top'  align='center' class='stylebodyp1'>Signature Over Printed Name of Member/Patient/Authorized Representative</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  
					    </tr>
					    
					    
					    
					    </tbody>
					</table>
					
				  
				  <table width='750' border='0' cellspacing='0' cellpadding='0'>
					  <tbody>
					
						
						<tr>
						  <td width='4'>&nbsp;</td>
						  <td colspan='11' rowspan='3' valign='top' align='left' class='stylebodyp1'>If member/representative is unable to write, <br>put right thumbmark. Member/Representative<br>should be assisted by an HCI representative.<br>Check the appropriate box.</td>
						  <td width='8'>&nbsp;</td>
						  <td colspan='7' rowspan='7' valign='top'><div id='bigbox'></div></td>
						  <td width='4' >&nbsp;</td>
						  <td width='30' >&nbsp;</td>
						  
						  <td colspan='9' class='stylebodyp1'>Relationship of the</td>
						  <td width='14'><input name='checkbox' type='checkbox' class='larger11121111' $carrtm1 /></td>
						  <td  valign='middle' width='10' align='left' class='stylebodyp1'>&nbsp;Spouse</td>
						  <td width='14' align='center'>&nbsp;</td>
						  <td width='14'><input name='checkbox' type='checkbox' class='larger11121111' $carrtm2 /></td>
						  <td width='14'  align='left'  valign='middle' class='stylebodyp1'>&nbsp;Child&nbsp;</td>
						  <td width='14'><input name='checkbox' type='checkbox' class='larger11121111' $carrtm3 /></td>
						  <td width='17'  align='left'  valign='middle' class='stylebodyp1'>&nbsp;Parent</td>
						  <td width='53' colspan='-1'>&nbsp;</td>
						  <td width='30' colspan='-1'>&nbsp;</td>
						  <td width='29'>&nbsp;</td>
						  <td width='32'>&nbsp;</td>
						  
						  <td width='14'>&nbsp;</td>
						  
					    </tr>
					    <tr>
						  <td colspan='51' height='2'></td>
					    </tr>
					    <tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td width='30'>&nbsp;</td>
						  
						  <td colspan='9' class='stylebodyp1' valign='top'>representative to the Patient</td>
						  <td width='14'><input name='checkbox' type='checkbox' class='larger11121111' $carrtm4 /></td>
						  <td  valign='middle'  align='left' class='stylebodyp1'>&nbsp;Siblling</td>
";
$carrtm5="";
echo "
						  <td width='14' align='center'>&nbsp;</td>
						  <td width='14'><input name='checkbox' type='checkbox' class='larger11121111' $carrtm5 /></td>
						  <td colspan='3'   class='stylebodyp1'>&nbsp;Other, Specify </td>
						  <td colspan='3' valign='bottom'><div id='bottomborderdv'>$carrtmos</div></td>
						 <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  
					    </tr>
					    
					    <tr>
						  <td colspan='51' height='2'></td>
					    </tr>
					    
					    <tr>
						  <td>&nbsp;</td>
						  <td width='18'><input name='checkbox' type='checkbox' class='larger11121111' $caruw1 /></td>
						  <td colspan='3'  valign='middle'  align='left' class='stylebodyp1'>&nbsp;Patient</td>
						  <td width='14'><input name='checkbox' type='checkbox' class='larger11121111' $caruw2 /></td>
						  <td colspan='4' valign='middle'  align='left' class='stylebodyp1'>&nbsp;Representative</td>
						  <td width='14'>&nbsp;</td>
						  <td width='23'>&nbsp;</td>
						  
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
				
						  <td colspan='9' class='stylebodyp1' valign='bottom'>Reason for signing on</td>
						  <td width='14'><input name='checkbox' type='checkbox' class='larger11121111' $carres1 /></td>
						  <td colspan='6'  valign='middle'  align='left' class='stylebodyp1'>&nbsp;Patient is incapacitated</td>
						  <td colspan='-1'>&nbsp;</td>
						  <td width='30' colspan='-1'>&nbsp;</td>
						  <td width='29' colspan='-1'>&nbsp;</td>
						  <td width='32' colspan='-1'>&nbsp;</td>
						  <td colspan='-1'>&nbsp;</td>
						  <td colspan='-1'>&nbsp;</td>
						 
						  <td>&nbsp;</td>
						 <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  
					    </tr>
					    
					    <tr>
						  <td colspan='51' height='2'></td>
					    </tr>
					    
					    <tr>
						  <td width='4'>&nbsp;</td>
						  <td width='18'>&nbsp;</td>
						  <td width='18'>&nbsp;</td>
						  <td width='18'>&nbsp;</td>
						  <td width='18'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						
						 
						  
						  <td colspan='9' class='stylebodyp1' valign='center'>Behalf of the Member</td>
						  <td width='14'><input name='checkbox' type='checkbox' class='larger11121111' $carres2 /></td>
						  <td colspan='4'  valign='middle'  align='left' class='stylebodyp1'>&nbsp;Other reasons:</td>
						  <td colspan='5' valign='bottom'><div id='bottomborderdv'>$carresos</div>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						 
						  
					    </tr>
					    <tr>
						  <td colspan='51' height='2'></td>
					    </tr>
					    
				      </tbody>
					</table>
							
					  <table width='750' border='0' cellspacing='0' cellpadding='0'>
					  <tbody>
					  
					  <tr>
						  <th colspan='40' scope='col' class='part1style' height='15' align='center' valign='middle'>PART IV - HEALTH CARE PROFESSIONAL INFORMATION</th>
					    </tr>
					    <tr>
						  <td colspan='40' height='2'></td>
					    </tr>
						<tr>
						  <td width='4' height='30'>&nbsp;</td>
						  <td colspan='5' align='left' class='stylebodyp1'>Accreditation No.</td>
						  <td width='14'><div id='smallbox'>$pa10</div></td>
						  <td width='14'><div id='smallbox'>$pa11</div></td>
						  <td width='14'><div id='smallbox'>$pa12</div></td>
						  <td width='14'><div id='smallbox'>$pa13</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$pa15</div></td>
						  <td width='14'><div id='smallbox'>$pa16</div></td>
						  <td width='14'><div id='smallbox'>$pa17</div></td>
						  <td width='14'><div id='smallbox'>$pa18</div></td>
						  <td width='14'><div id='smallbox'>$pa19</div></td>
						  <td width='14'><div id='smallbox'>$pa110</div></td>
						  <td width='14'><div id='smallbox'>$pa111</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$pa113</div></td>
						  <td width='14'>&nbsp;</td>
						  <td class='bottomboxborder' align='center' valign='middle'>$pfname1</td>
						  <td width='14'>&nbsp;</td>
						  <td colspan='4' class='stylebodyp1'>Date Signed:</td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr0</div></td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr1</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr3</div></td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr4</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr6</div></td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr7</div></td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr8</div></td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr9</div></td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  
					    </tr>
					    <tr>
						  <td width='4'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td valign='top' align='center' class='stylebodyp1'>Signature Over Printed Name</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						   <td colspan='2' valign='top'  align='center' class='stylebodyp1'>month</td>
						  <td>&nbsp;</td>
						  <td colspan='2' valign='top'  align='center' class='stylebodyp1'>day</td>
						  <td>&nbsp;</td>
						  <td colspan='4' valign='top'  align='center' class='stylebodyp1'>year</td><td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  
					    </tr>
					    <tr>
						  <td width='4' height='30'>&nbsp;</td>
						  <td colspan='5' align='left' class='stylebodyp1'>Accreditation No.</td>
						  <td width='14'><div id='smallbox'>$pa20</div></td>
						  <td width='14'><div id='smallbox'>$pa21</div></td>
						  <td width='14'><div id='smallbox'>$pa22</div></td>
						  <td width='14'><div id='smallbox'>$pa23</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$pa25</div></td>
						  <td width='14'><div id='smallbox'>$pa26</div></td>
						  <td width='14'><div id='smallbox'>$pa27</div></td>
						  <td width='14'><div id='smallbox'>$pa28</div></td>
						  <td width='14'><div id='smallbox'>$pa29</div></td>
						  <td width='14'><div id='smallbox'>$pa210</div></td>
						  <td width='14'><div id='smallbox'>$pa211</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$pa213</div></td>
						  <td width='14'>&nbsp;</td>
						  <td class='bottomboxborder' align='center' valign='bottom'>$pfname2</td>
						  <td width='14'>&nbsp;</td>
						  <td colspan='4' class='stylebodyp1'>Date Signed:</td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr20</div></td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr21</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr23</div></td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr24</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr26</div></td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr27</div></td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr28</div></td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr29</div></td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  
					    </tr>
					    <tr>
						  <td width='4'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td valign='top' align='center' class='stylebodyp1'>Signature Over Printed Name</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						   <td colspan='2' valign='top'  align='center' class='stylebodyp1'>month</td>
						  <td>&nbsp;</td>
						  <td colspan='2' valign='top'  align='center' class='stylebodyp1'>day</td>
						  <td>&nbsp;</td>
						  <td colspan='4' valign='top'  align='center' class='stylebodyp1'>year</td><td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  
					    </tr>
					    <tr>
						  <td width='4' height='30'>&nbsp;</td>
						  <td colspan='5' align='left' class='stylebodyp1'>Accreditation No.</td>
						  <td width='14'><div id='smallbox'>$pa31</div></td>
						  <td width='14'><div id='smallbox'>$pa32</div></td>
						  <td width='14'><div id='smallbox'>$pa33</div></td>
						  <td width='14'><div id='smallbox'>$pa34</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$pa35</div></td>
						  <td width='14'><div id='smallbox'>$pa36</div></td>
						  <td width='14'><div id='smallbox'>$pa37</div></td>
						  <td width='14'><div id='smallbox'>$pa38</div></td>
						  <td width='14'><div id='smallbox'>$pa39</div></td>
						  <td width='14'><div id='smallbox'>$pa310</div></td>
						  <td width='14'><div id='smallbox'>$pa311</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$pa313</div></td>
						  <td width='14'>&nbsp;</td>
						  <td align='center' class='bottomboxborder' valign='bottom'>$pfname3</td>
						  <td width='14'>&nbsp;</td>
						  <td colspan='4' class='stylebodyp1'>Date Signed:</td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr30</div></td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr31</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr33</div></td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr34</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr36</div></td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr37</div></td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr38</div></td>
						  <td width='14'><div id='smallbox'>$pfdatesiarr39</div></td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  
					    </tr>
					    <tr>
						  <td width='4'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td valign='top' align='center' class='stylebodyp1'>Signature Over Printed Name</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						   <td colspan='2' valign='top'  align='center' class='stylebodyp1'>month</td>
						  <td>&nbsp;</td>
						  <td colspan='2' valign='top'  align='center' class='stylebodyp1'>day</td>
						  <td>&nbsp;</td>
						  <td colspan='4' valign='top'  align='center' class='stylebodyp1'>year</td><td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  
					    </tr>
					    
					    
					    </tbody>
					</table>
					
					<table width='750' border='0' cellspacing='0' cellpadding='0'>
					  <tbody>
					  
					  <tr>
						  <th colspan='33' scope='col' class='part1style' height='15' align='center' valign='middle'>PART V - PROVIDER INFORMATION AND CERTIFICATION</th>
					    </tr>
					    <tr>
						  <td colspan='33' height='2'></td>
					    </tr>
						<tr>
						  <td width='4'>&nbsp;</td>
						  <td colspan='3' class='stylebody' width='80'>1. PhilHealth Benefits:</td>
						  <td width='20'>&nbsp;</td>
						  <td  colspan='3' class='stylebody' width='80'>ICD 10 or RVS Code:</td>
						  <td colspan='4' class='stylebodyp1' width='50'>1. First Case Rate</td>
						  <td colspan='7' width='100' class='bottomboxborder'><div align='center'>$pcase</div></td>
						  <td width='14'>&nbsp;</td>
						  <td colspan='4' class='stylebodyp1' width='60'>2. Second Case Rate</td>
						  <td colspan='7' width='100' class='bottomboxborder'><div align='center'>$scase</div></td>
						  
						  <td width='14'>&nbsp;</td>
						  <td width='8'>&nbsp;</td>
						  
					    </tr>
					    <tr>
						  <td width='8'>&nbsp;</td>
						  <td colspan='33' align='center' class='stylebodyp1'><strong><i>I certify that services rendered were recorded in the patient's chart and health care institution records and that the herein information given are true and correct.</i></strong></td>
					    </tr>
					    
				      </tbody>
					</table>
					
					<table width='750' border='0' cellspacing='0' cellpadding='0'>
					  <tbody>
					<tr>
						  <td width='4' height='30'>&nbsp;</td>
						  <td colspan='16' class='bottomboxborder' align='center' valign='bottom'>$hcirep</td>
						  <td  >&nbsp;</td>
						  <td colspan='12' class='bottomboxborder' align='center' valign='bottom'>$hcidesignation</td>
						  <td width='14'>&nbsp;</td>
						  <td colspan='4' class='stylebodyp1'>Date Signed:</td>
						  <td width='14'><div id='smallbox'>$hcidtarr0</div></td>
						  <td width='14'><div id='smallbox'>$hcidtarr1</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$hcidtarr3</div></td>
						  <td width='14'><div id='smallbox'>$hcidtarr4</div></td>
						  <td width='14' align='center'>-</td>
						  <td width='14'><div id='smallbox'>$hcidtarr6</div></td>
						  <td width='14'><div id='smallbox'>$hcidtarr7</div></td>
						  <td width='14'><div id='smallbox'>$hcidtarr8</div></td>
						  <td width='14'><div id='smallbox'>$hcidtarr9</div></td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						 
					    </tr>
					    
					    <tr>
						  <td width='4'>&nbsp;</td>
						  <td colspan='16' align='center' class='stylebodyp1'>Signature Over Printed Name of Authorized HCI Representative</td>
						  <td width='10'>&nbsp;</td>
						  <td colspan='12' align='center' class='stylebodyp1' >Official Capacity/Designation</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td colspan='2' valign='top'  align='center' class='stylebodyp1'>month</td>
						  <td>&nbsp;</td>
						  <td colspan='2' valign='top'  align='center' class='stylebodyp1'>day</td>
						  <td>&nbsp;</td>
						  <td colspan='4' valign='top'  align='center' class='stylebodyp1'>year</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						  <td width='14'>&nbsp;</td>
						 
					    </tr>
				      </tbody>
					</table>
			</div>

</div>
</body>
</html>






";




?> 
