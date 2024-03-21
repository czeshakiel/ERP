<?php
include('../../aboy2020/pages/includes/function.php');
include('../../aboy2020/pages/includes/config.php');

$caseno=$_GET['caseno'];
$nursename=$_GET['nursename'];
$userunique=$_GET['userunique'];
$branch=$_GET['branch'];
$dept=$_GET['dept'];
$sqlCheck=mysqli_query($con,"SELECT * FROM admission WHERE caseno='$caseno' AND status LIKE '%MGH%'");
if(mysqli_num_rows($sqlCheck)>0){
//   $sqlCheckMeds=mysqli_query($con,"SELECT * FROM productout WHERE caseno='$caseno' AND (productsubtype LIKE '%PHARMACY/MEDICINE%' OR productsubtype LIKE '%PHARMACY/SUPPLIES%' OR productsubtype LIKE '%MEDICAL SURGICAL SUPPLIES%') AND `status`='PAID' AND administration='pending' AND quantity > 0");
//   if(mysqli_num_rows($sqlCheckMeds)>0){
//     echo "<script>";
//       echo "alert('Unable to set final due to undispensed medicines or supplies!');";
//       echo "window.history.back();";
//     echo "</script>";
//   }else{
    //==============================PROFESSIONAL FEE=======================================
    $updateBill=mysqli_query($con,"UPDATE admission SET result='FINAL' WHERE caseno='$caseno'");
    if($updateBill){
      $sqlPatient=mysqli_query($con,"SELECT pp.patientname FROM patientprofile pp INNER JOIN admission a ON a.patientidno=pp.patientidno WHERE a.caseno='$caseno'");
      $name=mysqli_fetch_array($sqlPatient);
      $loginuser=$nursename;
      $transmessage=$name['patientname']." account has been set to final by $loginuser";
      $datearray=date('Y-m-d');
      $timearray=date('H:i:s');
      $sqlInsert=mysqli_query($con,"INSERT INTO userlogs(transaction,loginuser,datearray,timearray) VALUES('$transmessage','$loginuser','$datearray','$timearray')");
      echo "<script>";
        echo "alert('Successfully set to final!');";
        echo "window.history.back();";
      echo "</script>";
    }else{
      echo "<script>";
        echo "alert('Unable to post all payments!');";
        echo "window.history.back();";
      echo "</script>";
    }
    /*}else{
      echo "<script>";
        echo "alert('CASHONHAND NOT POSTED!');";
        echo "window.history.back();";
      echo "</script>";
    }*/
    //}
  }else{
    echo "<script>";
      echo "alert('Patient status must be MGH!');";
      echo "window.history.back();";
    echo "</script>";
  }
 ?>
