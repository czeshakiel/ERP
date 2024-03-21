<?php
include '../../meshes/alink.php';
ini_set("display_errors", "on");
$slct_year = $_POST["yearSlct"];
$report_title = "NBS REPORT YEAR ".$slct_year;
$datenow = date("Y-m-d");
$timenow = date("H:i:s");

$queryCheck = $pdo->query("SELECT `slc_year` FROM nbs_report WHERE `slc_year` = '$slct_year'");
if($queryCheck->rowCount() > 0){
    echo "exists";
}else{
    $queryInsert = $pdo->query("INSERT INTO nbs_report (`title`, `slc_year`, `date_created`, `time_created`) VALUES ('$report_title','$slct_year','$datenow','$timenow')");
    if($queryInsert){
        echo "success";
    }else{
        echo "failed";
    }
}
?>