<?php
$spo=mysqli_real_escape_string($conn,$_GET['po']);
$ls=mysqli_real_escape_string($conn,$_GET['ls']);

if($ls=="rq"){$fconn=$tconn;}
else if($ls=="fn"){$fconn=$conn;}
else{$fconn=$conn;}

echo "
<main id='main' class='main'>
  <div class='pagetitle'>
    <h5>".strtoupper($dept)." DEPARTMENT</h5>
    <nav>
      <ol class='breadcrumb'>
        <li class='breadcrumb-item'><a href='?main'>Main</a></li>
        <li class='breadcrumb-item'><a href='?autostk'>Auto Stock Request</a></li>
        <li class='breadcrumb-item'><a href='?autostkdetails'>Request Deatils</a></li>
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
                <td><font color='black'><b><i class='bi bi-credit-card-2-back'></i> PO DETAILS | PO NO.: $spo</b></font></td>
                <td align='right'></td>
              </tr>
            </table>
            <hr>
";

if(!isset($_POST['finalized'])){
  if($ls=="rq"){
echo "
            <form method='post'>
            <table border='0' width='100%' cellpadding='0' cellspacing='0'>
              <tr>
                <td style='padding-bottom: 5px;'><div align='right'><button type='submit' name='finalized' class='btn btn-success' style='color: #FFFFFF;' ";?> onclick="return confirm('Are you sure you want to finalized this PO?');" <?php echo " ><i class='icofont-ui-clip-board'> Finalize</i></button></div></td>
              </tr>
            </table>
";
  }
  else{
echo "
            <table border='0' width='100%' cellpadding='0' cellspacing='0'>
              <tr>
                <td style='padding-bottom: 5px;'><div align='right'><a href='../scmprint/stockrequest/$spo/$dept' target='_blank'><button class='btn btn-outline-primary btn-sm' title='Print Purchase Order'><i class='icofont-printer'></i></button></a></div></td>
              </tr>
            </table>
";
  }

echo "
            <table class='table table-hover align-middle mb-0' width='100%'>
              <tr>
                <th class='text-center' style='background-color: #01787E;'><div style='font-weight: bold;font-size: 12px;color: #FFFFFF;'>#</div></th>
                <th class='text-center' style='background-color: #01787E;'><div style='font-weight: bold;font-size: 12px;color: #FFFFFF;'>Description</div></th>
                <th class='text-center' style='background-color: #01787E;'><div style='font-weight: bold;font-size: 12px;color: #FFFFFF;'>Qty. Requested</div></th>
                <th class='text-center' style='background-color: #01787E;'><div style='font-weight: bold;font-size: 12px;color: #FFFFFF;'>Requested Dept.</div></th>
                <th class='text-center' style='background-color: #01787E;'><div style='font-weight: bold;font-size: 12px;color: #FFFFFF;'>User</div></th>
                <th class='text-center' style='background-color: #01787E;'><div style='font-weight: bold;font-size: 12px;color: #FFFFFF;'>Date Requested</div></th>
              </tr>
              <tbody>
";

$za=0;
$zasql=mysqli_query($fconn,"SELECT `description`, `prodqty`, `dept`, `user`, `reqdate` FROM `purchaseorder` WHERE `po`='$spo' AND `status`='request'");
while($zafetch=mysqli_fetch_array($zasql)){
  $desc=$zafetch['description'];
  $rqty=$zafetch['prodqty'];
  $rdpt=$zafetch['dept'];
  $rusr=mb_strtoupper($zafetch['user']);
  $rdat=$zafetch['reqdate'];
  $za++;

  $desc=str_replace("ams-","",$desc);
  $desc=str_replace("-sup","",$desc);
  $desc=strtoupper($desc);

echo "
                <tr>
                  <td><div align='left'>$za</div></td>
                  <td><div align='left'>$desc</div></td>
                  <td><div align='center'>$rqty</div></td>
                  <td><div align='center'>$rdpt</div></td>
                  <td><div align='center'>$rusr</div></td>
                  <td><div align='center'>".date("M d, Y",strtotime($rdat))."</div></td>
                </tr>
              </tbody>
";
}

echo "
              <tr>
                <td colspan='6' style='background-color: #01787E;'></td>
              </tr>
            </table>
";

  if($ls=="rq"){
echo "
            <input type='hidden' name='po' value='$spo' />
            </form>
";
  }
}
else{
  $fspo=mysqli_real_escape_string($conn,$_POST['po']);

  $zasql=mysqli_query($tconn,"SELECT * FROM `purchaseorder` WHERE `po`='$fspo' AND `status`='request'");
  while($zafetch=mysqli_fetch_array($zasql)){
    $rrdetails=$zafetch['rrdetails'];
    $rrno=$zafetch['rrno'];
    $transdate=$zafetch['transdate'];
    $supplier=$zafetch['supplier'];
    $suppliercode=$zafetch['suppliercode'];
    $terms=$zafetch['terms'];
    $trantype=$zafetch['trantype'];
    $pocode=$zafetch['code'];
    $description=$zafetch['description'];
    $unitcost=$zafetch['unitcost'];
    $generic=$zafetch['generic'];
    $prodqty=$zafetch['prodqty'];
    $podept=$zafetch['dept'];
    $status=$zafetch['status'];
    $prodtype1=$zafetch['prodtype1'];
    $po=$zafetch['po'];
    $user=$zafetch['user'];
    $approvingofficer=$zafetch['approvingofficer'];
    $reqdept=$zafetch['reqdept'];
    $reqno=$zafetch['reqno'];
    $reqdate=$zafetch['reqdate'];
    $requser=$zafetch['requser'];

    mysqli_query($conn,"INSERT INTO `purchaseorder` (`rrno`, `transdate`, `supplier`, `suppliercode`, `terms`, `trantype`, `code`, `description`, `unitcost`, `generic`, `prodqty`, `dept`, `status`, `prodtype1`, `po`, `user`, `approvingofficer`, `reqdept`, `reqno`, `reqdate`, `requser`) VALUES ('$rrno', '$transdate', '$supplier', '$suppliercode', '$terms', '$trantype', '$pocode', '$description', '$unitcost', '$generic', '$prodqty', '$podept', '$status', '$prodtype1', '$po', '$user', '$approvingofficer', '$reqdept', '$reqno', '$reqdate', '$requser')");
  }

echo "
            <table border='0' width='100%' celllpadding='0' cellspacing='0'>
              <tr>
                <td><div align='left' style='color: #1E8449;font-weight: bold;'>Request Finalized</div></td>
              </tr>
            </table>
";

  mysqli_query($tconn,"DELETE FROM `purchaseorder` WHERE `po`='$fspo'");
  mysqli_query($conn,"INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('FINALIZED PO. PO No.: $fspo', '$user', '".date("Y-m-d")."', '".date("H:i:s")."')");

echo "<META HTTP-EQUIV='Refresh'CONTENT='1;URL=?autostkdetails&po=$fspo&ls=fn'>";
}

echo "
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
";
?>
