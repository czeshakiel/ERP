<?php
error_reporting(0);
session_start();

include($_SERVER['DOCUMENT_ROOT'].'/ERP/main/connection.php');

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if(strpos($url, "index.php")!==false){$url = str_replace("index.php", "", $url); echo"<script>window.location='$url';</script>";}

$sql = $conn->query("select * from ipaddress");
while($result = $sql->fetch_assoc()){$ip = $result['ipaddress'];}
$ipadd = "http://".$ip."/ERP/main/";
$myip = $_SERVER['REMOTE_ADDR'];
$arv_ip = $_SERVER['HTTP_HOST'];

$sqlxx = "SELECT * from heading";
$resultxx = $conn->query($sqlxx);
while($rowxx = $resultxx->fetch_assoc()) {
$heading=$rowxx['heading'];
$address=$rowxx['address'];
$telno=$rowxx['telno'];
$softwarename=$rowxx['designation'];
}

$sqlxxx = "SELECT * from mission";
$resultxxx = $conn->query($sqlxxx);
while($rowxxx = $resultxxx->fetch_assoc()) {
$mission=$rowxxx['mission'];
$vision=$rowxxx['vision'];
}

// ----------------------------------------------
$user=$_SESSION["username"];
$userunique=$_SESSION["userunique"];
$password=$_SESSION["password"];
$dept=strtoupper($_SESSION["dept"]);
$branch=$_SESSION["branch"];
$access=$_SESSION["access"];
$view=$_GET['view'];
$modulex=$_GET["modulex"];
$mm = $_GET['mm'];
$dd = $_GET['dd'];
$yy = $_GET['yy'];
if(isset($_GET['nursename'])){$user=$_GET['nursename'];}
if(isset($_GET['st'])){$dept=$_GET['st'];}
//$datax = "&username=".$user."&userunique=".$userunique."&dept=".$dept."&branch=".$branch."&mm=".$mm."&dd=".$dd."&yy=".$yy;
$_SESSION['datax'] = $datax;
$_SESSION['user_login'] = $user;

if(isset($_SESSION["username"])){
$conn->query("DELETE FROM `user_session` WHERE ipaddress='$myip'");
$conn->query("INSERT INTO `user_session`(`ipaddress`, `name`, `username`, `password`, `dept`, `branch`, `myaccess`) VALUES ('$myip', '$user', '$userunique', '$password', '$dept', '$branch', '$access')");
}else{
$user_session = $conn->query("select * from user_session where ipaddress='$myip'");
if(mysqli_num_rows($user_session)>0){
while($user_s = $user_session->fetch_assoc()){
$_SESSION["username"] = $user_s['name'];
$_SESSION["userunique"] = $user_s['username'];
$_SESSION["password"] = $user_s['password'];
$_SESSION["dept"] = $user_s['dept'];
$_SESSION["branch"] = $user_s['branch'];
$_SESSION['count']=0;
$_SESSION['verifyuser']="verified";
$_SESSION['user_login'] = true;
$_SESSION['access'] = $user_s['myaccess'];
echo"<script>location.reload();</script>";
}
}
}
// ----------------------------------------------

$caseno=$_GET['caseno'];
if($caseno!=""){
$sql22 = "SELECT * from admission, patientprofile where admission.patientidno=patientprofile.patientidno and caseno='$caseno'";
$result22 = $conn->query($sql22);
while($row22 = $result22->fetch_assoc()) {
$patientidno=$row22['patientidno'];
$lname=$row22['lastname'];
$fname=$row22['firstname'];
$mname=$row22['middlename'];
$ptname = $lname.", ".$fname." ".$mname;
$ptname2 = $ptname."_".$caseno;
} }


if($dept=="DOC-OTHERS"){
$xx = $conn->query("select * from nsauthdoctors where station='$dept' and username='$userunique' and password='$password'");
while($xx1 = $xx->fetch_assoc()){$empid =$xx1['empid'];}

$resulta22 = $conn->query("select * from docfile where code='$empid'");
while($rowa22 = $resulta22->fetch_assoc()) {$position =$rowa22['specialization'];}

}else{
$xx = $conn->query("select * from nsauth where station='$dept' and username='$userunique' and password='$password'");
while($xx1 = $xx->fetch_assoc()){$empid =$xx1['empid'];}

$resulta22 = $conn->query("select * from nsauthemployees where empid='$empid'");
while($rowa22 = $resulta22->fetch_assoc()) {$position =$rowa22['position']; $gender =$rowa22['gender'];}
}

if($position=="" or $position==" "){$position="Staff";}
if($gender=="MALE" or $gender=="M"){$ppic = "avatar11";}else{$ppic="avatar12";}

//-----------------------------------------------
class database {
public $setip = '192.168.0.100:100';
public function setIP(){return $this->setip;}
}
//-----------------------------------------------
include($_SERVER['DOCUMENT_ROOT'].'/ERP/main/model.php');

if(isset($_GET['closetab'])){echo"<script>window.close();</script>";}
?>
