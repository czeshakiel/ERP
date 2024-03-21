<?php
//MEDICINE/SUPPLIES -------------------------------------------------------------------------------
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

$md=0;
$mdsql=mysqli_query($conn,"SELECT * FROM `productout` WHERE ($allcs) AND `producttype` NOT LIKE '%READERS FEE%' AND (`productsubtype`='PHARMACY/MEDICINE' OR `productsubtype`='RDU MEDICINE' OR `productsubtype`='RDU-MEDICINE') AND (`status`='Approved' OR `status`='PAID' OR `status`='BALANCE' OR `status`='requested' OR `status`='REFUND') AND `quantity` > 0  GROUP BY `refno` ORDER BY `trantype` DESC, `administration`");
while($mdfetch=mysqli_fetch_assoc($mdsql)){
  $status=$mdfetch['administration'];
  $status1=$mdfetch['status'];
  $administration1=$mdfetch['administration'];
  $prod=$mdfetch['productsubtype'];
  $terminalname=$mdfetch['terminalname'];
  $productdesc=$mdfetch['productdesc'];
  $approvalno=$mdfetch['approvalno'];
  $producttype=$mdfetch['producttype'];
  $qty=$mdfetch['quantity'];
  $invno=$mdfetch['invno'];
  $approvalno=$mdfetch['approvalno'];
  $batchno=$mdfetch['batchno'];
  $productcode=$mdfetch['productcode'];
  $refno=$mdfetch['refno'];
  $datearray=date("F d, Y", strtotime($mdfetch['datearray']));
  $timedispensed=$mdfetch['datearray'];
  $md++;

  $productdesc=str_replace("mak-","",$productdesc);
  $productdesc=str_replace("-med","",$productdesc);
  $productdesc=str_replace("-sup","",$productdesc);
  $productdesc=str_replace("ams-","",$productdesc);
  $productdesc=str_replace("() ","",$productdesc);

  if($status=="pending") {$status="<span class='badge bg-primary'>Pending</span>";}
  if($status=="dispensed") {$status="<span class='badge bg-secondary'>Dispensed</span>";}
  if($status=="administered") {$status="<span class='badge bg-danger'>Administered</span>";}
  $loginuser=$mdfetch['loginuser'];

  $hmm="";
  if(strpos($batchno, "HM-")!== false){$hmm="<small><font color='blue'>[homemeds]</font></small>";}
  $loginuser=str_replace("<br>","\n",$loginuser);

echo "
      <tr>
        <td align='center' style='font-size: 12px;'>$md</td>
        <td style='font-size: 12px;'><font color='gray'>Desc:</font> <b>$productdesc $hmm</b><br><font color='gray'>Accttitle:</font> $prod</td>
        <td style='font-size: 12px;'><font color='gray'>Status:</font> ".$mdfetch['trantype']." / $status1 / $status<br><font color='gray'>Date:</font> $datearray</td>
        <td class='text-center' style='font-size: 13px;'>$qty</td>
        <td style='text-align: center; font-size: 25px;'><i class='icofont-waiter-alt' data-bs-toggle='tooltip' title='$loginuser'></i></td>
      </tr>
";
}

echo "
  </tbody>
</table>
";
