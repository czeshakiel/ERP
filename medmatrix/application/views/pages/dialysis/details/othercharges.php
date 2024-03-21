<?php
//OTHERS-------------------------------------------------------------------------------------------
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

$ot=0;
$otsql=mysqli_query($conn,"SELECT * FROM `productout` where ($allcs) AND `quantity` > 0  AND `producttype` NOT LIKE '%READERS FEE%' AND `administration` NOT LIKE '%pending%' AND (`productsubtype`='ROOM ACCOMODATION' OR `productsubtype`='PROFESSIONAL FEE' OR `productsubtype`='NURSING CHARGES' OR `productsubtype`='NURSING SERVICE FEE' OR `productsubtype`='OR/DR/ER FEE' OR `productsubtype`='MISCELLANEOUS' OR `productsubtype`='OTHER FEES' OR `productsubtype`='CONSULTATION FEE' OR `productsubtype`='ADMISSION FEE' OR `productsubtype`='AMBULANCE INCOME' OR `productsubtype`='ER FEE' OR `productsubtype`='NURSE ON CALL' OR `productsubtype` LIKE '%OXYGEN%' OR `productsubtype` LIKE '%MEDICAL EQUIPMENT%' OR `productsubtype` LIKE 'OR-CHARGES' OR `productsubtype` LIKE 'LINENS' OR `productsubtype` LIKE 'GENERAL SUPPLIES' OR `productsubtype` LIKE '%PULMONARY%' OR `productsubtype` LIKE '%RT REFERRAL%' OR `productsubtype` LIKE '%OPERATING ROOM FEE%') AND (`status`='Approved' OR `status`='PAID' OR `status`='BALANCE' OR `status`='requested' OR `status`='REFUND') GROUP BY `refno` ORDER BY `datearray`");
while($otfetch=mysqli_fetch_assoc($otsql)){
  $status=$otfetch['administration'];
  $status1=$otfetch['status'];
  $administration1=$otfetch['administration'];
  $prod=$otfetch['productsubtype'];
  $terminalname=$otfetch['terminalname'];
  $productdesc=$otfetch['productdesc'];
  $approvalno=$otfetch['approvalno'];
  $producttype=$otfetch['producttype'];
  $qty=$otfetch['quantity'];
  $invno=$otfetch['invno'];
  $approvalno=$otfetch['approvalno'];
  $batchno=$otfetch['batchno'];
  $productcode=$otfetch['productcode'];
  $refno=$otfetch['refno'];
  $datearray=date("F d, Y", strtotime($otfetch['datearray']));
  $timedispensed=$otfetch['datearray'];
  $ot++;

  $productdesc=str_replace("mak-","",$productdesc);
  $productdesc=str_replace("-med","",$productdesc);
  $productdesc=str_replace("-sup","",$productdesc);
  $productdesc=str_replace("ams-","",$productdesc);

  $loginuser=$otfetch['loginuser'];

  $hmm="";
  if($prod=="PROFESSIONAL FEE"){$hmm = "<small><font color='blue'>$producttype</font></small>";}

echo "
    <tr>
      <td align='center' style='font-size: 12px;'>$ot</td>
      <td style='font-size: 12px;'><font color='gray'>Desc:</font> <b>$productdesc $hmm;</b><br><font color='gray'>Accttitle:</font> $prod</td>
      <td style='font-size: 12px;'><font color='gray'>Status:</font> ".$otfetch['trantype']." / $status1 / $status<br><font color='gray'>Date:</font> $datearray</td>
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
