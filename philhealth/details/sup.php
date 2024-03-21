<?php
//SUPPLIES ----------------------------------------------------------------------------------------
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

$sp=0;
$spsql=mysqli_query($conn,"SELECT * FROM `productout` WHERE `caseno`='$caseno' AND `producttype` NOT LIKE '%READERS FEE%' AND (`productsubtype`='PHARMACY/SUPPLIES' OR `productsubtype`='RDU SUPPLIES' OR `productsubtype`='RDU-SUPPLIES' OR `productsubtype` LIKE '%CSR KIT%' OR `productsubtype` LIKE '%OR/DR SUPPLIES%' OR `productsubtype` LIKE '%MEDICAL SURGICAL SUPPLIES%') AND (`status`='Approved' OR `status`='PAID' OR `status`='BALANCE' OR `status`='requested' OR `status`='REFUND') AND `quantity` > 0 GROUP BY `refno` ORDER BY `trantype` DESC, `administration` DESC");
while($spfetch=mysqli_fetch_assoc($spsql)){
  $status=$spfetch['administration'];
  $status1=$spfetch['status'];
  $administration1=$spfetch['administration'];
  $prod=$spfetch['productsubtype'];
  $terminalname=$spfetch['terminalname'];
  $productdesc=$spfetch['productdesc'];
  $approvalno=$spfetch['approvalno'];
  $producttype=$spfetch['producttype'];
  $qty=$spfetch['quantity'];
  $invno=$spfetch['invno'];
  $approvalno=$spfetch['approvalno'];
  $batchno=$spfetch['batchno'];
  $productcode=$spfetch['productcode'];
  $refno=$spfetch['refno'];
  $datearray=date("F d, Y", strtotime($spfetch['datearray']));
  $timedispensed=$spfetch['datearray'];
  $sp++;

  $productdesc=str_replace("mak-","",$productdesc);
  $productdesc=str_replace("-med","",$productdesc);
  $productdesc=str_replace("-sup","",$productdesc);
  $productdesc=str_replace("ams-","",$productdesc);
  $productdesc=str_replace("() ","",$productdesc);

  if($status=="pending") {$status="<span class='badge bg-primary'>Pending</span>";}
  if($status=="dispensed") {$status="<span class='badge bg-secondary'>Dispensed</span>";}
  if($status=="administered") {$status="<span class='badge bg-danger'>Administered</span>";}
  $loginuser=$spfetch['loginuser'];

  $hmm="";
  if(strpos($batchno, "HM-")!== false){$hmm="<small><font color='blue'>[homemeds]</font></small>";}
  $loginuser=str_replace("<br>","\n",$loginuser);

echo "
      <tr>
        <td align='center' style='font-size: 12px;'>$sp</td>
        <td style='font-size: 12px;'><font color='gray'>Desc:</font> <b>$productdesc $hmm</b><br><font color='gray'>Accttitle:</font> $prod</td>
        <td style='font-size: 12px;'><font color='gray'>Status:</font> ".$spfetch['trantype']." / $status1 / $status<br><font color='gray'>Date:</font> $datearray</td>
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
