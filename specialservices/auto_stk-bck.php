<?php
$pono1=strtoupper($dept).'-'.date('YmdHis');

echo "
<main id='main' class='main'>
  <div class='pagetitle'>
    <h5>".strtoupper($dept)." DEPARTMENT</h5>
    <nav>
      <ol class='breadcrumb'>
        <li class='breadcrumb-item'><a href='?main'>Main</a></li>
        <li class='breadcrumb-item'><a href='?autostk'>Auto Stock Request</a></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class='section'>
    <div class='row'>
      <div class='col-lg-12'>
        <div class='card'>
          <div class='card-body'>
            <table width='100%'>
              <tr>
                <td><font color='black'><b><i class='bi bi-credit-card-2-back'></i> PENDING AUTO STOCK REQUISITION</b></font></td>
                <td align='right'></td>
              </tr>
            </table>
            <hr>
            <table id='patient-table' class='table table-hover align-middle mb-0' width='100%'>
              <thead>
                <tr>
                  <th class='text-center'>Requested To</th>
                  <th class='text-center'>Req NO and Req Date</th>
                  <th class='text-center'>Type and Terms</th>
                  <th class='text-center'>Requesting User</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
";

$i=0;
$amount=0;
$disym=date('Y-m');
$sqlyy="SELECT * FROM `purchaseorder` WHERE `reqdept`='$dept' AND `status`='request' GROUP BY `po` ORDER BY `generic` DESC";
$resultyy=$tconn->query($sqlyy);
while($rowyy=$resultyy->fetch_assoc()) {
  $supplier=$rowyy['supplier'];
  $suppliercode=$rowyy['suppliercode'];
  $pono=$rowyy['po'];
  $rrno= $rowyy['rrno'];
  $trantype=$rowyy['trantype'];
  $terms=$rowyy['terms'];
  $datearray=date('F d, Y', strtotime($rowyy['reqdate']));
  $requser=$rowyy['user'];
  $reqno=$rowyy['reqno'];
  $i++;
  $datenow=date('Y-m-d');
  $supplierx=$suppliercode.'_'.$supplier;
  $daterequest=$rowyy['generic'];

  // ---------------------->>>> GET TOTAL DAYS <<<---------------------
  $earlier=new DateTime($rowyy['generic']);
  $later=new DateTime($datenow);
  $diff=$later->diff($earlier)->format('%a');
  // ------------------>>>> END GET TOTAL DAYS <<<---------------------

  // ---------------------->>>> GET YR, MM, DAYS <<<-------------------
  $origin=new DateTime($rowyy['generic']);
  $target=new DateTime($datenow);
  $interval=$origin->diff($target);
  $aa=$interval->format('%y-%m-%d');
  list($yr, $mm, $dy)=explode('-', $aa);
  if($yr>0){$dd="$yr year(s), $mm month(s), and $dy day(s) ago";}
  elseif($mm>0){$dd="$mm month(s) and $dy day(s) ago";}
  else{$dd="$dy day(s) ago";}
  // ----------------->>>>  END GET YR, MM, DAYS <<<-------------------

  if($diff<=1){$imoji='emoji-laughing';}
  elseif(($diff>1)&&($diff<5)){$imoji='emoji-sunglasses';}
  elseif(($diff>5)&&($diff<10)){$imoji='emoji-smile';}
  elseif(($diff>10)&&($diff<20)){$imoji='emoji-neutral';}
  else{$imoji='emoji-frown';}

echo "
                <tr>
                  <td bgcolor='$col' style='color: $colx; font-size: 11px;'><table width='100%'><tr><td width='20%'><font size='5%'><i class='bi bi-$imoji'></i></font></td><td> $suppliercode<br>$supplier</td></tr></table></td>
                  <td align='center' style='color: $colx; font-size: 11px;'>$pono<br>$datearray</td>
                  <td align='center' style='color: $colx; font-size: 11px;'>$trantype<br>NONE</td>
                  <td align='center' style='color: $colx; font-size: 11px;'>$requser<br>$dd</td>
                  <td align='center'><a href='?autostkdetails&po=$pono&ls=rq'><button type='button' class='btn btn-warning'><i class='icofont-eye'></i></button></a></td>
                  <!-- td align='center'><a href='../scmprint/stockrequest/$reqno/$dept' target='_blank'><button class='btn btn-outline-primary btn-sm' title='Manage'><i class='icofont-check-circled'></i></button></a></td -->
                </tr>
              </tbody>
";
}

echo "
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
";
?>
