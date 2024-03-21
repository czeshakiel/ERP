<?php
echo "
<span style='font-family: arial;font-size: 16px;font-weight: bold;'>Please Enter Remarks</span>
<form method='POST'>
  <input type='hidden' name='caseno' value='$caseno' />
  <input type='hidden' name='user' value='$user' />
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><textarea name='remarks' rows='5' cols='50' style='padding: 5px;' placeholder='REMARKS' autofocus required></textarea></td>
    </tr>
    <tr>
      <td><div align='right' style='padding-top: 5px;'><input type='submit' name='submit' value='Submit' /></div></td>
    </tr>
  </table>
</form>
";

if(isset($_POST['submit'])){
  $remarks=mysqli_real_escape_string($conn,$_POST['remarks']);

  $sqlCheck=mysqli_query($conn,"SELECT * FROM `collection` WHERE `acctno`='$caseno' AND `type`='pending' AND (`accttitle`='CASHONHAND' OR `accttitle`='PROFESSIONAL FEE')");
  if(mysqli_num_rows($sqlCheck)>0){
    while($row=mysqli_fetch_array($sqlCheck)){
      $updateBill=mysqli_query($conn,"DELETE FROM `collection` WHERE `refno`='$row[refno]'");
      $updateBill=mysqli_query($conn,"DELETE FROM `acctgenledge` WHERE `refno`='$row[refno]'");
    }
  //==============================PROFESSIONAL FEE=======================================
    if($updateBill){
      $sqlRemove=mysqli_query($conn,"DELETE FROM `billingpayment` WHERE `caseno`='$caseno'");
      $sqlUpdate=mysqli_query($conn,"UPDATE `admission` SET `result`='' WHERE `caseno`='$caseno'");

echo "
<script>
  alert('Set final successfully removed!');
  window.location='../BillMe/?caseno=$caseno&dept=BILLING&user=$user';
</script>
";
    }
    else{
      $sqlUpdate=mysqli_query($conn,"UPDATE admission SET result='' WHERE caseno='$caseno'");
echo "
<script>
  alert('Set final successfully removed!');
  window.location='../BillMe/?caseno=$caseno&dept=BILLING&user=$user';
</script>
";
    }
  }
  else{
    $sqlUpdate=mysqli_query($conn,"UPDATE admission SET result='' WHERE caseno='$caseno'");
echo "
<script>
  alert('Set final successfully removed!');
  window.location='../BillMe/?caseno=$caseno&dept=BILLING&user=$user';
</script>
";
  }

  $patsql=mysqli_query($conn,"SELECT pp.patientname FROM patientprofile pp INNER JOIN admission a ON a.patientidno=pp.patientidno WHERE a.caseno='$caseno'");
  $patfetch=mysqli_fetch_array($patsql);
  $transmessage=$patfetch['patientname']." set final removed due to ".$remarks.".";
  $loginuser=$name;
  $datearray=date('Y-m-d');
  $timearray=date('H:i:s');
  $sqlInsert=mysqli_query($conn,"INSERT INTO userlogs(transaction,loginuser,datearray,timearray) VALUES('$transmessage','$loginuser','$datearray','$timearray')");
}
 ?>
