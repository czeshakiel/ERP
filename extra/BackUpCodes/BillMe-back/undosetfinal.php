<?php
include('../../aboy2020/pages/includes/function.php');
include('../../aboy2020/pages/includes/config.php');

$caseno=$_GET['caseno'];
$nursename=$_GET['nursename'];
$userunique=$_GET['userunique'];
$branch=$_GET['branch'];
$dept=$_GET['dept'];

?>
<h4>Please enter Remarks</h4>
<form name="f1" method="GET">
  <input type="hidden" name="caseno" value="<?=$caseno;?>">
  <input type="hidden" name="nursename" value="<?=$nursename;?>">
  <input type="hidden" name="userunique" value="<?=$userunique;?>">
  <input type="hidden" name="branch" value="<?=$branch;?>">
  <input type="hidden" name="dept" value="<?=$dept;?>">
<table width="50%">
  <tr>
    <td width="3%">Remarks</td>
    <td><textarea name="remarks" rows="5" cols="50"></textarea></td>
  </tr>
  <tr>
    <td></td>
    <td><input type="submit" name="submit" value="Submit"></td>
  </tr>
</table>
</form>
<?php
if(isset($_GET['submit'])){
  $caseno=$_GET['caseno'];
$nursename=$_GET['nursename'];
$userunique=$_GET['userunique'];
$branch=$_GET['branch'];
$dept=$_GET['dept'];
$remarks=$_GET['remarks'];
$sqlCheck=mysqli_query($con,"SELECT * FROM collection WHERE acctno='$caseno' AND `type`='pending' AND (accttitle='CASHONHAND' OR accttitle='PROFESSIONAL FEE')");
if(mysqli_num_rows($sqlCheck)>0){
  while($row=mysqli_fetch_array($sqlCheck)){
    $updateBill=mysqli_query($con,"DELETE FROM collection WHERE refno='$row[refno]'");
    $updateBill=mysqli_query($con,"DELETE FROM acctgenledge WHERE refno='$row[refno]'");
  }
//==============================PROFESSIONAL FEE=======================================
if($updateBill){
  $sqlRemove=mysqli_query($con,"DELETE FROM billingpayment WHERE caseno='$caseno'");
  $sqlUpdate=mysqli_query($con,"UPDATE admission SET result='' WHERE caseno='$caseno'");
  echo "<script>";
    echo "alert('Set final successfully removed!');";
    echo "window.location='../BillMe/?caseno=$caseno&dept=$dept&nursename=$nursename&branch=$branch&user=$userunique';";
  echo "</script>";
}else{
  $sqlUpdate=mysqli_query($con,"UPDATE admission SET result='' WHERE caseno='$caseno'");
  echo "<script>";
    echo "alert('Set final successfully removed!');";
    echo "window.location='../BillMe/?caseno=$caseno&dept=$dept&nursename=$nursename&branch=$branch&user=$userunique';";
  echo "</script>";
}
/*}else{
  echo "<script>";
    echo "alert('CASHONHAND NOT POSTED!');";
    echo "window.history.back();";
  echo "</script>";
}*/
}else{
  $sqlUpdate=mysqli_query($con,"UPDATE admission SET result='' WHERE caseno='$caseno'");
  echo "<script>";
    echo "alert('Set final successfully removed!');";
    echo "window.location='../BillMe/?caseno=$caseno&dept=$dept&nursename=$nursename&branch=$branch&user=$userunique';";
  echo "</script>";
}
    $sqlPatient=mysqli_query($con,"SELECT pp.patientname FROM patientprofile pp INNER JOIN admission a ON a.patientidno=pp.patientidno WHERE a.caseno='$caseno'");
                      $name=mysqli_fetch_array($sqlPatient);
                      $transmessage=$name['patientname']." set final removed due to ".$remarks.".";
                      $loginuser=$nursename;
                      $datearray=date('Y-m-d');
                      $timearray=date('H:i:s');
                      $sqlInsert=mysqli_query($con,"INSERT INTO userlogs(transaction,loginuser,datearray,timearray) VALUES('$transmessage','$loginuser','$datearray','$timearray')");
                    }
 ?>
