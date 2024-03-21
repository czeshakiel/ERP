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
  //$sqlCheckPayment=mysqli_query($con,"SELECT * FROM collection WHERE acctno='$caseno' AND accttitle LIKE '%CASHONHAND%'");
  //if(mysqli_num_rows($sqlCheckPayment)>0){
  //=======================HOSPITAL BILL=====================================
  $sqlHospital=mysqli_query($con,"SELECT SUM(excess) as totalexcess FROM productout WHERE caseno='$caseno' AND (productsubtype NOT LIKE '%PROFESSIONAL FEE%' OR (productsubtype LIKE '%PROFESSIONAL FEE%' AND (producttype LIKE '%IPD apnurse%' OR producttype LIKE '%IPD admitting%'))) AND trantype='charge' AND excess > 0 AND quantity > 0");
  $hospitalbill=0;
  if(mysqli_num_rows($sqlHospital)>0){
    $h=mysqli_fetch_array($sqlHospital);
      $hospitalbill=$h['totalexcess'];
  }

  $sqlCheckCollection=mysqli_query($con,"SELECT * FROM collection WHERE acctno='$caseno' AND description='HOSPITAL BILL' AND accttitle='CASHONHAND' AND type='pending'");
  if(mysqli_num_rows($sqlCheckCollection)>0){
    $collect=mysqli_fetch_array($sqlCheckCollection);
    $sqlCheckOtherCollection=mysqli_query($con,"SELECT SUM(amount) as payment FROM collection WHERE acctno='$caseno' AND description='HOSPITAL BILL' AND accttitle NOT LIKE '%CASHONHAND%' AND accttitle NOT LIKE '%CANCELLED%'");
    if(mysqli_num_rows($sqlCheckOtherCollection)>0){
      $other=mysqli_fetch_array($sqlCheckOtherCollection);
        $payment=$other['payment'];
    }else{
      $payment=0;
    }
    $hospitalbill=$hospitalbill-$payment;
    $sqlUpdate=mysqli_query($con,"UPDATE collection SET amount='$hospitalbill' WHERE refno='$collect[refno]'");
    $sqlUpdate=mysqli_query($con,"UPDATE acctgenledge SET amount='$hospitalbill' WHERE refno='$collect[refno]'");
  }else{
    $sqlCheckOtherCollection=mysqli_query($con,"SELECT SUM(amount) as payment FROM collection WHERE acctno='$caseno' AND description='HOSPITAL BILL' AND accttitle NOT LIKE '%CASHONHAND%' AND accttitle NOT LIKE '%CANCELLED%'");
    if(mysqli_num_rows($sqlCheckOtherCollection)>0){
      $other=mysqli_fetch_array($sqlCheckOtherCollection);
        $payment =$other['payment'];
      }else{
        $payment=0;
      }
      $hospitalbill=$hospitalbill-$payment;
    $sql1="SELECT pp.patientname FROM patientprofile pp INNER JOIN admission a ON a.patientidno=pp.patientidno WHERE a.caseno='$caseno'";
    $sqlPatient=mysqli_query($con,$sql1);
    $patient=mysqli_fetch_array($sqlPatient);
    $patientname=$patient['patientname'];

$refno=generateRefNo('RN',$nursename);
$acctno=$caseno;
$acctname=$patientname;
$description="HOSPITAL BILL";
$accttitle="CASHONHAND";
$amount=$hospitalbill;
$discount="0.00";
$date=date('M-d-Y');
$datearray=date('Y-m-d');
//$sqlCollection=mysqli_query($con,"INSERT INTO collection(refno,acctno,acctname,ofr,description,accttitle,amount,discount,date,Dept,username,shift,type,paymentTime,paidBy,datearray,branch) VALUES('$refno','$acctno','$acctname','','$description','$accttitle','$amount','$discount','$date','in','$nursename','0','pending','','','$datearray','KMSCI')");
//$sqlAcctGenledge=mysqli_query($con,"INSERT INTO acctgenledge(refno,acctitle,transaction,amount,date,caseno,status) VALUES('$refno','$accttitle','debit','$amount','$date','$caseno','pending')");
  }
//=======================================HOSPITAL BILL=================================

//===============================PROFESSIONAL FEE=======================================
$totalexcess=0;
$sqlPatient=mysqli_query($con,"SELECT * FROM productout WHERE caseno='$caseno' AND productsubtype LIKE '%PROFESSIONAL FEE%' AND excess > 0 AND (producttype NOT LIKE '%IPD admitting%' AND producttype NOT LIKE '%IPD apnurse%' AND producttype NOT LIKE '%READERS FEE%' AND producttype <> '') GROUP BY refno");
if(mysqli_num_rows($sqlPatient)>0){
while($patient=mysqli_fetch_array($sqlPatient)){
  $sqlCheck=mysqli_query($con,"SELECT refno,amount FROM collection WHERE acctno='$caseno' AND description='$patient[productcode]' AND accttitle LIKE '%PROFESSIONAL FEE%'");
  if(mysqli_num_rows($sqlCheck)>0){
    $excess1=mysqli_fetch_array($sqlCheck);
    $sqlCheck1=mysqli_query($con,"SELECT SUM(amount) as amount FROM collection WHERE acctno='$caseno' AND description='$patient[productcode]' AND accttitle NOT LIKE '%PROFESSIONAL FEE%' AND accttitle NOT LIKE '%CANCELLED%'");
    if(mysqli_num_rows($sqlCheck1)>0){
      $excess=mysqli_fetch_array($sqlCheck1);
      $totalexcess=$patient['excess']-$excess['amount'];
    }else{
      $totalexcess=0;
    }
    $sqlUpdate=mysqli_query($con,"UPDATE collection SET amount='$hospitalbill' WHERE refno='$excess1[refno]'");
    $sqlUpdate=mysqli_query($con,"UPDATE acctgenledge SET amount='$hospitalbill' WHERE refno='$excess1[refno]'");
  }else{
    $sqlCheck1=mysqli_query($con,"SELECT SUM(amount) as amount FROM collection WHERE acctno='$caseno' AND description='$patient[productcode]' AND accttitle NOT LIKE '%PROFESSIONAL FEE%' AND accttitle NOT LIKE '%CANCELLED%'");
    if(mysqli_num_rows($sqlCheck1)>0){
      $excess=mysqli_fetch_array($sqlCheck1);
      $totalexcess=$patient['excess']-$excess['amount'];
    }else{
      $totalexcess=0;
    }
    $sql1="SELECT pp.patientname FROM patientprofile pp INNER JOIN admission a ON a.patientidno=pp.patientidno WHERE a.caseno='$caseno'";
    $sqlPatient1=mysqli_query($con,$sql1);
    $patient1=mysqli_fetch_array($sqlPatient1);
    $patientname=$patient1['patientname'];

$refno=generateRefNo('RN',$nursename);
$acctno=$caseno;
$acctname=$patientname;
$description=$patient['productdesc'];
$accttitle="PROFESSIONAL FEE";
$amount=$totalexcess;
$discount="0.00";
$date=date('M-d-Y');
$datearray=date('Y-m-d');
//$sqlCollection=mysqli_query($con,"INSERT INTO collection(refno,acctno,acctname,ofr,description,accttitle,amount,discount,date,Dept,username,shift,type,paymentTime,paidBy,datearray,branch) VALUES('$refno','$acctno','$acctname','','$description','$accttitle','$amount','$discount','$date','in','$nursename','0','pending','','','$datearray','KMSCI')");
//$sqlAcctGenledge=mysqli_query($con,"INSERT INTO acctgenledge(refno,acctitle,transaction,amount,date,caseno,status) VALUES('$refno','$accttitle','debit','$amount','$date','$caseno','pending')");
}
}
}

//==============================PROFESSIONAL FEE=======================================
$updateBill=mysqli_query($con,"UPDATE admission SET result='FINAL' WHERE caseno='$caseno'");
$updateBill=mysqli_query($con,"INSERT INTO billingpayment(caseno,status) VALUES('$caseno','1')");
if($updateBill){
  $sqlPatient=mysqli_query($con,"SELECT pp.patientname FROM patientprofile pp INNER JOIN admission a ON a.patientidno=pp.patientidno WHERE a.caseno='$caseno'");
  $name=mysqli_fetch_array($sqlPatient);
  $loginuser=$nursename;
  $transmessage=$name['patientname']." account has been posted by $loginuser";
  $datearray=date('Y-m-d');
  $timearray=date('H:i:s');
  $sqlInsert=mysqli_query($con,"INSERT INTO userlogs(transaction,loginuser,datearray,timearray) VALUES('$transmessage','$loginuser','$datearray','$timearray')");
  echo "<script>";
    echo "alert('Payment successfully posted!');";
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
}else{
  echo "<script>";
    echo "alert('Patient status must be MGH!');";
    echo "window.history.back();";
  echo "</script>";
}
 ?>
