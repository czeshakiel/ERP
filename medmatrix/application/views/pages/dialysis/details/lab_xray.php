<?php
//SERVICES-----------------------------------------------------------------------------------------
echo "
<table class='datatable table table-hover align-middle mb-0' width='100%'>
  <thead>
    <tr>
      <th class='text-center'><font size='2'>#</th>
      <th class='text-center' width='55%'><font size='2'>DESCRIPTION</th>
      <th class='text-center' width='25%'><font size='2'>STATUS</th>
      <th class='text-center'><font size='2%'>QTY</th>
      <th class='text-center'><font size='2%'>USER</th>
    </tr>
  </thead>
  <tbody>
";

$lx=0;
$lxsql=mysqli_query($conn,"SELECT * FROM `productout` WHERE ($allcs) AND `productsubtype` NOT LIKE '%MEDICINE%' AND `productsubtype` NOT LIKE '%SUPPLIES%' AND `productsubtype` NOT LIKE '%PROFESSIONAL FEE%' AND `productsubtype` NOT LIKE '%ROOM ACCOMODATION%' AND `productsubtype` NOT LIKE '%NURSING_CHARGES%' AND `productsubtype` NOT LIKE '%NURSING SERVICE FEE%' AND `productsubtype` NOT LIKE '%OR/DR/ER FEE%' AND `productsubtype` NOT LIKE '%MISCELLANEOUS%' AND `productsubtype` NOT LIKE '%MEDICAL EQUIPMENT%' AND `productsubtype` NOT LIKE '%MEDICAL SURGICAL SUPPLIES%' AND `productsubtype` NOT LIKE '%OTHER FEES%' AND `productsubtype` NOT LIKE '%CONSULTATION FEE%' AND `productsubtype` NOT LIKE '%AMBULANCE%' AND `productsubtype` NOT LIKE '%NURSING%' AND `productsubtype` NOT LIKE '%NURSE%' AND `productsubtype` NOT LIKE '%OXYGEN%' AND `productsubtype` NOT LIKE '%ADMISSION FEE%' AND `productsubtype` NOT LIKE '%ER FEE%' AND `productsubtype` NOT LIKE '%CSR KIT%' AND `productsubtype` NOT LIKE '%OR/DR SUPPLIES%' AND `productsubtype` NOT LIKE 'OR-CHARGES' AND `productsubtype` NOT LIKE 'LINENS' AND `productsubtype` NOT LIKE 'GENERAL SUPPLIES' AND `productsubtype` NOT LIKE '%PULMONARY%' AND `productsubtype` NOT LIKE '%RT REFERRAL%' AND `productsubtype` NOT LIKE '%OPERATING ROOM FEE%' AND (`status`='Approved' OR `status`='PAID' OR `status`='BALANCE' OR `status`='requested' OR `status`='REFUND') AND `quantity` > 0 GROUP BY `refno` ORDER BY `trantype` DESC, `datearray`");
while($lxfetch=mysqli_fetch_assoc($lxsql)){
  $status=$lxfetch['administration'];
  $status1=$lxfetch['status'];
  $administration1=$lxfetch['administration'];
  $prod=$lxfetch['productsubtype'];
  $terminalname=$lxfetch['terminalname'];
  $productdesc=$lxfetch['productdesc'];
  $approvalno=$lxfetch['approvalno'];
  $producttype=$lxfetch['producttype'];
  $qty=$lxfetch['quantity'];
  $invno=$lxfetch['invno'];
  $approvalno=$lxfetch['approvalno'];
  $batchno=$lxfetch['batchno'];
  $productcode=$lxfetch['productcode'];
  $refno=$lxfetch['refno'];
  $loginuser=$lxfetch['loginuser'];
  $datearray=date("F d, Y", strtotime($lxfetch['datearray']));
  $timedispensed=$lxfetch['datearray'];
  $lx++;

  $productdesc=str_replace("mak-","",$productdesc);
  $productdesc=str_replace("-med","",$productdesc);
  $productdesc=str_replace("-sup","",$productdesc);
  $productdesc=str_replace("ams-","",$productdesc);
  $productdesc=str_replace("() ","",$productdesc);

  if($terminalname=="pending") {$terminalname="<span class='badge bg-primary'>Pending</span>";}
  else if($terminalname=="Testdone") {$terminalname="<span class='badge bg-danger'>Test Done</span>";}
  else if($terminalname=="Testtobedone") {$terminalname="<span class='badge bg-danger'>Test to be Done</span>";}
  else{$terminalname="<span class='badge bg-success'>$terminalname</span>";}

  $rm="";
  $lbsql=mysqli_query($conn,"SELECT `remarks` FROM `labtest` WHERE `refno`='$refno'");
  while($lbfetch=mysqli_fetch_assoc($lbsql)){$rm=$lbfetch['remarks'];}

  $hmm="";
  if($rm!=""){$hmm="<small><font color='blue'> [$rm]</font></small>";}

echo "
    <tr>
      <td align='center' style='font-size: 12px;'>$lx</td>
      <td style='font-size: 12px;'><font color='gray'>Desc:</font> <b>$productdesc$hmm</b><br><font color='gray'>Accttitle:</font> $prod</td>
      <td style='font-size: 12px;'><font color='gray'>Status:</font> ".$lxfetch['trantype']." / $status1 / $terminalname<br><font color='gray'>Date:</font> $datearray</td>
      <td class='text-center' style='font-size: 13px;'>$qty</td>
      <td style='text-align: center; font-size: 25px;'><i class='icofont-waiter-alt' data-bs-toggle='tooltip' title='$loginuser'></i></td>
    </tr>
";

}

echo "
  </tbody>
</table>
";
?>
