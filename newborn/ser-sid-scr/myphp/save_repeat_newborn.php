<?php
include("../../meshes/alink.php");
ini_set('display_errors', 'on');
$lguser = $_SESSION['username'];
$rep_scrns = $_POST['rep_scrns'];
$rep_series = $_POST['rep_series'];
$rep_ptidno = $_POST['rep_ptidno'];
$rep_caseno = $_POST['rep_caseno'];
$rep_refno = $_POST['rep_refno'];
$rep_desc = $_POST['rep_desc'];
$rep_refphy = $_POST['rep_refphy'];
$rep_clcserv = $_POST['rep_clcserv'];
$rep_fname = $_POST['rep_fname'];
$rep_mname = $_POST['rep_mname'];
$rep_lname = $_POST['rep_lname'];
$rep_trantype = $_POST['rep_trantype'];
$rep_prodcode = $_POST['rep_prodcode'];
$rep_proddesc = $_POST['rep_proddesc'];
$branch = "KMSCI";
$today = date("Ymd");
$todaytime = date("his");
$coder = $todaytime . "" . $today;
$localdate = date("M-d-Y");
$todayx = date("Y-m-d");
$todaytimex = date("H:i:s");
$approvalno = "KIT-".$rep_series;
$transaction = $rep_caseno." ".$rep_fname." ".$rep_mname.". ".$rep_lname." (".$rep_proddesc.") set as Testdone Repeat by ".$lguser;
$patient_name = $rep_lname.", ".$rep_fname." ".$rep_mname;
$status1 = "Testdone";

$executeInsertRepeat = $pdo->query("INSERT INTO `productout`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`, `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`, `administration`,`shift`, `location`, `senior`, `datearray`, `addons`) 
VALUES ('$coder','$todaytimex','$rep_caseno','$rep_prodcode','$rep_proddesc','0','0','0','0','repeat','0','0','0','$localdate','$status1','$status1','$lguser','$rep_refno','','','$approvalno','$rep_refno','','$branch','','','$todayx','repeat')");
if ($executeInsertRepeat) {
    $querylog = $pdo->query("INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES('$transaction','$lguser','$todayx','$todaytimex')");
    echo "success";
}else{
    echo "failed";
}
?>