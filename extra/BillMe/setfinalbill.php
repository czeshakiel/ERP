<?php
include("../../main/class2.php");

$caseno=$_GET['caseno'];
$nursename=$_GET['nursename'];
$userunique=$_GET['userunique'];
$branch=$_GET['branch'];
$dept=$_GET['dept'];

$sqlCheck=mysqli_query($conn,"SELECT * FROM admission WHERE caseno='$caseno' AND status LIKE '%MGH%'");
if(mysqli_num_rows($sqlCheck)>0){
  //==============================PROFESSIONAL FEE=======================================
  $updateBill=mysqli_query($conn,"UPDATE admission SET result='FINAL' WHERE caseno='$caseno'");
  if($updateBill){
    $sqlPatient=mysqli_query($conn,"SELECT pp.patientname FROM patientprofile pp INNER JOIN admission a ON a.patientidno=pp.patientidno WHERE a.caseno='$caseno'");
    $name=mysqli_fetch_array($sqlPatient);
    $loginuser=$nursename;
    $transmessage=$name['patientname']." account has been set to final by $loginuser";
    $datearray=date('Y-m-d');
    $timearray=date('H:i:s');
    $sqlInsert=mysqli_query($conn,"INSERT INTO userlogs(transaction,loginuser,datearray,timearray) VALUES('$transmessage','$loginuser','$datearray','$timearray')");

echo "
<script>
  alert('Successfully set to final!');
  window.history.back();
</script>
";
  }
  else{
echo "
<script>
  alert('Unable to post all payments!');
  window.history.back();
</script>
";
  }
}
else{
echo "
<script>
  alert('Patient status must be MGH!');
  window.history.back();
</script>
";
}
?>
