<?php
echo "
<div class='row'>
  <div class='col-lg-12'>
    <div class='panel panel-white' id='printableArea'>
      <div class='panel-heading'>
        <center>
          <table width='100%' border='0'>
            <tr>
              <td><div align='left' style='font-family: Arial; font-size: 16px;'><span style='font-weight: bold;'><u><?php echo $ap; ?></u></span></div></td>
            </tr>
          </table>
          <br />
          <form name='f1' method='get' action='../BillMe/postpayERP.php'>
            <input type='hidden' name='pfallocationhmo'>
            <input type='hidden' name='dept' value='$st'>
            <input type='hidden' name='branch' value='$branch'>
            <input type='hidden' name='nursename' value='$nursename'>
            <input type='hidden' name='userunique' value='$userunique'>
            <input type='hidden' name='caseno' value='$caseno'>
            <input type='hidden' name='dept' value='$dept'>
            <input type='hidden' name='user' value='$user'>
            <input type='hidden' name='patientidno' value='$patientidno'>
            <input type='hidden' name='postpay'>

            <table width='100%' border='0'>
              <tr>
                <td align='left'><u>Doctor's Name</u></td>
                <td align='right'><u>Excess</u></td>
                <td align='right'><u>Amount Allocated</u></td>
                <td align='right'><u>HMO</u></td>
              </tr>
";

$sqlHospital=mysqli_query($conn,"SELECT SUM(excess) as totalexcess FROM productout WHERE caseno='$caseno' AND (productsubtype NOT LIKE '%PROFESSIONAL FEE%' OR (productsubtype LIKE '%PROFESSIONAL FEE%' AND (producttype LIKE '%IPD apnurse%' OR producttype LIKE '%IPD admitting%'))) AND trantype='charge' AND excess > 0 AND quantity > 0");
$hospitalbill=0;
if(mysqli_num_rows($sqlHospital)>0){
  $h=mysqli_fetch_array($sqlHospital);
  $hospitalbill =$h['totalexcess'];
}

$sqlPayment=mysqli_query($conn,"SELECT SUM(amount) as amount FROM collection WHERE acctno='$caseno' AND description LIKE '%HOSPITAL BILL%'");
$totalbalance=0;
if(mysqli_num_rows($sqlPayment)>0){
  $payment=mysqli_fetch_array($sqlPayment);
  $totalbalance=$hospitalbill-$payment['amount'];
}
else{
  $totalbalance=$hospitalbill;
}

if($totalbalance < 0){
  $totalbalance=0;
}

echo "
              <tr>
                <td><input type='checkbox' name='hosp'> HOSPITAL BILL</td>
                <td align='right'>".number_format($totalbalance,2,".",",")."</td>
                <td align='right'><input type='text' name='hospital' value='0.00' class='form-control' style='width:150px; text-align:right'></td>
                <td align='right'>
                  <select name='hmohosp' class='form-control' style='width:300px; text-align:right'>
                    <option value='CASHONHAND'>CASHONHAND</option>
                    <option value='DISCOUNT'>DISCOUNT</option>
";

$sqlhmo=mysqli_query($conn,"SELECT accttitle FROM accttitle WHERE (accttitle LIKE '%AR %' OR accttitle LIKE '% DEPOSIT%')");
  while($hmo=mysqli_fetch_array($sqlhmo)){
echo "
                    <option vaue='$hmo[accttitle]'>$hmo[accttitle]</option>
";
  }

echo "
                  </select>
                </td>
              </tr>
";

$total=0;
$sqlPatient=mysqli_query($conn,"SELECT * FROM productout WHERE caseno='$caseno' AND productsubtype LIKE '%PROFESSIONAL FEE%' AND excess > 0 AND (producttype NOT LIKE '%IPD admitting%' AND producttype NOT LIKE '%IPD apnurse%' AND producttype NOT LIKE '%READERS FEE%' AND producttype <> '' )");
while($patient=mysqli_fetch_array($sqlPatient)){
  $sqlCheck=mysqli_query($conn,"SELECT SUM(amount) as amount FROM collection WHERE acctno='$caseno' AND description LIKE '%$patient[productdesc]%'");
  $rem=0;

  if(mysqli_num_rows($sqlCheck)>0){
    $col=mysqli_fetch_array($sqlCheck);
    $rem=$patient['excess']-$col['amount'];
  }
  else{
    $rem=$patient['excess'];
  }

  $total=$total+$rem;

echo "
              <input type='hidden' name='patientname[]' value='$patientname'>
              <tr>
                <td><input type='checkbox' name='code[]' value='$patient[refno]' checked> $patient[productdesc] <font style='color:red'>$patient[producttype]</font></td>
                <td align='right'>".number_format($rem,2,".",",")."</td>
                <td align='right'><input type='text' name='allo[]' class='form-control' style='width:150px; text-align:right' value='0.00'></td>
                <td align='right'>
                  <select name='hmo[]' class='form-control' style='width:300px; text-align:right'>
                    <option value='PROFESSIONAL FEE'>PROFESSIONAL FEE</option>
";

  $sqlhmo=mysqli_query($conn,"SELECT accttitle FROM accttitle WHERE accttitle LIKE '%AR %'");
  while($hmo=mysqli_fetch_array($sqlhmo)){
echo "
                    <option vaue='$hmo[accttitle]'>$hmo[accttitle]</option>
";
  }

echo "
                  </select>
                </td>
              <tr>
";
}

echo "
              <tr>
                <td colspan='4'><hr width='100%'></td>
              </tr>
              <tr>
                <td align='right'>TOTAL EXCESS</td>
                <td align='right'><u>".number_format($total+$totalbalance,2,'.',',')."</u></td>
              </tr>
            </table>
            <table width='100%' border='0'>
              <tr>
               <td align='left' colspan='4'>ALLOCATION HISTORY:</td>
              </tr>
";

$sqlCollect=mysqli_query($conn,"SELECT *,SUM(amount) as amount FROM collection WHERE acctno='$caseno' GROUP BY description,accttitle,type");
$totalposted=0;
if(mysqli_num_rows($sqlCollect)>0){
  while($tbal=mysqli_fetch_array($sqlCollect)){
    if($tbal['type']=='pending'){
      $hide="";
    }
    else{
      $hide="style='display:none'";
    }

    if($tbal['accttitle']=='PHARMACY/MEDICINE' || $tbal['accttitle']=='PHARMACY/SUPPLIES' || $tbal['accttitle']=='LABORATORY' || $tbal['accttitle']=='ULTRASOUND' || $tbal['accttitle']=='XRAY' || $tbal['accttitle']=='ECG' || $tbal['accttitle']=='EEG' || $tbal['accttitle']=='MEDICAL SURGICAL SUPPLIES'){
    }
    else{
      $totalposted +=$tbal['amount'];

echo "
              <tr>
                <td>$tbal[description] ($tbal[accttitle])</td>
                <td align='right'>".number_format($tbal['amount'],2,".",",")."</td>
                <td width='5%' style='text-indent:10px;'><a href='../BillMe/postpayERP.php?pfallocationhmo&delete&refno=$tbal[refno]&caseno=$caseno&dept=BILLING&nursename=$nursename&userunique=$userunique&patientidno=$patientidno&user=$user' onclick='return confirm('Do you wish to remove this item?');return false;' $hide>Remove</a></td>
                <td width='50%'>&nbsp;</td>
              </tr>
";
    }
  }
}


echo "
              <tr>
                <td colspan='4'>&nbsp;</td>
              </tr>
              <tr>
                <td>TOTAL</td><td align='right'>".number_format($totalposted,2,'.',',')."</td><td width='70%' colspan='2'>&nbsp;</td>
              </tr>
            </table>
            <br />
            <br />
            <br />
            <label><input type='submit' name='submit' value='ALLOCATE PAYMENT' class='btn btn-primary'></label>
          </form>
        </center>
      </div>
      <div class='panel-body'>
";

if(isset($_GET['submit'])){
  include('function.php');
  $c=$_GET['code'];
  $caseno=$_GET['caseno'];
  $patientidno=$_GET['patientidno'];
  $allocation=$_GET['allo'];
  $tbal=$_GET['tbal'];
  $hosp=$_GET['hosp'];
  $hmo=$_GET['hmo'];

  $cd=explode('-',$caseno);
  $date=date('M-d-Y');

  if($cd[0]=="I"){$d="IPD";}
  else{$d="OPD";}

  $datearray=date('Y-m-d');
  $sql1="SELECT patientname FROM patientprofile WHERE patientidno='$patientidno'";
  $sqlPatient=mysqli_query($conn,$sql1);
  $patient=mysqli_fetch_array($sqlPatient);
  $patientname=$patient['patientname'];

  $x=0;
  foreach($c as $code){
    $sql="SELECT * FROM productout WHERE refno='$code'";
    $sqlItem=mysqli_query($conn,$sql);

    if(mysqli_num_rows($sqlItem)>0){
      while($item=mysqli_fetch_array($sqlItem)){
        if($allocation[$x] > 0){
          $refno=generateRefNo('RN',$nursename);
          $acctno=$caseno;
          $acctname=$patientname;
          $description=$item['productdesc'];
          $accttitle="PROFESSIONAL FEE";
          $amount=$allocation[$x];
          $hmopf=$hmo[$x];

          if($hmopf=="PROFESSIONAL FEE"){
            $hmopf1=$hmopf;
          }
          else{
            $hmopf1=$hmopf." PF";
          }

          $discount="0.00";
          $date=date('M-d-Y');
          $cd=explode('-',$caseno);

          if($cd[0]=="I"){$d="IPD";}
          else{$d="OPD";}

          $datearray=date('Y-m-d');
          $branch="KMSCI";

          $sqlCollection=mysqli_query($conn,"INSERT INTO collection(refno,acctno,acctname,ofr,description,accttitle,amount,discount,date,Dept,username,shift,type,paymentTime,paidBy,datearray,branch) VALUES('$refno','$acctno','$acctname','','$description','$hmopf1','$amount','$discount','$date','$d','$nursename','0','pending','','','$datearray','KMSCI')");
          $sqlAcctGenledge=mysqli_query($conn,"INSERT INTO acctgenledge(refno,acctitle,transaction,amount,date,caseno,status) VALUES('$refno','$hmopf1','debit','$amount','$date','$caseno','pending')");
        }
      }
    }

    $x++;
  }

  if($hosp=='on'){
    $hospital=$_GET['hospital'];
    $hmohosp=$_GET['hmohosp'];
    $refno=generateRefNo('RN',$nursename);

    $sqlCollection1=mysqli_query($conn,"INSERT INTO collection(refno,acctno,acctname,ofr,description,accttitle,amount,discount,date,Dept,username,shift,type,paymentTime,paidBy,datearray,branch) VALUES('$refno','$caseno','$patientname','','HOSPITAL BILL','$hmohosp','$hospital','0.00','$date','$d','$nursename','0','pending','','','$datearray','KMSCI')");
    $sqlAcctGenledge1=mysqli_query($conn,"INSERT INTO acctgenledge(refno,acctitle,transaction,amount,date,caseno,status) VALUES('$refno','$hmohosp','debit','$hospital','$date','$caseno','pending')");
  }

  if(sizeof($c)>0 || $hosp=='on'){
    $sqlPatient=mysqli_query($conn,"SELECT pp.patientname FROM patientprofile pp INNER JOIN admission a ON a.patientidno=pp.patientidno WHERE a.caseno='$caseno'");
    $name=mysqli_fetch_array($sqlPatient);
    $transmessage=$name['patientname']." HOSPITAL BILL/PF is posted.";
    $loginuser=$nursename;
    $datearray=date('Y-m-d');
    $timearray=date('H:i:s');

    $sqlInsert=mysqli_query($conn,"INSERT INTO userlogs(transaction,loginuser,datearray,timearray) VALUES('$transmessage','$loginuser','$datearray','$timearray')");

echo "
<script>
  alert('Assistance allocation successfully posted!');window.location='../BillMe/postpayERP.php?postpay&caseno=$caseno&dept=BILLING&nursename=$nursename&userunique=$userunique&patientidno=$patientidno&user=$user';
</script>
";
  }
  else{
echo "
<script>
  alert('Please select at least one (1) item from the list!');window.location='../BillMe/postpayERP.php?postpay&caseno=$caseno&dept=BILLING&nursename=$nursename&userunique=$userunique&patientidno=$patientidno&user=$user';
</script>
";
  }
}

if(isset($_GET['delete'])){
  $refno=$_GET['refno'];
  $caseno=$_GET['caseno'];

  $sqlDelete=mysqli_query($conn,"DELETE FROM collection WHERE refno='$refno'");
  $sqlDelete=mysqli_query($conn,"DELETE FROM acctgenledge WHERE refno='$refno'");

  $sqlPatient=mysqli_query($conn,"SELECT pp.patientname FROM patientprofile pp INNER JOIN admission a ON a.patientidno=pp.patientidno WHERE a.caseno='$caseno'");
  $name=mysqli_fetch_array($sqlPatient);
  $transmessage=$name['patientname']." posted payment has been removed with reference no. $refno";
  $loginuser=$nursename;
  $datearray=date('Y-m-d');
  $timearray=date('H:i:s');

  $sqlInsert=mysqli_query($conn,"INSERT INTO userlogs(transaction,loginuser,datearray,timearray) VALUES('$transmessage','$loginuser','$datearray','$timearray')");
echo "
<script>
  alert('Item successfully removed!');window.location='../BillMe/postpayERP.php?postpay&caseno=$caseno&dept=BILLING&nursename=$nursename&userunique=$userunique&patientidno=$patientidno&user=$user';
</script>";
}

echo "
      </div>
    </div>
  </div>
</div>

<script type='text/javascript'>
  function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
  }
</script>
";
?>
