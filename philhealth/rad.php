<style>
@keyframes animate {
  0% {opacity: 0;}
  50% {opacity: 0.7;}
  100% {opacity: 0;}
}

.blinkforme {
  -webkit-animation: blinker 1s infinite;  /* Safari 4+ */
  -moz-animation: blinker 1s infinite;  /* Fx 5+ */
  -o-animation: blinker 1s infinite;  /* Opera 12+ */
  animation: blinker 1s infinite;  /* IE 10+, Fx 29+ */
}

@-webkit-keyframes blinker {
  0%, 49% {
    background-color: #FFFFFF;
    color: #FF0000;
    height: 100%;
  }
  50%, 100% {
    background-color: #FF0000;
    color: #FFFFFF;
    height: 100%;
  }
}
</style>

<?php
ini_set("display_errors","On");

$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);

echo "
    <!-- Body: Body -->
    <div class='body d-flex py-lg-3 py-md-2'>
      <div class='container-xxl'>
";

include("profile.php");

echo "
        <div class='row clearfix g-3'>
          <div class='col-sm-12'>
            <div class='card mb-3'>
              <div class='card-header'>
                <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td><div align='left'><h5 class='fw-bold'><i class='icofont-listine-dots me-2'></i> Radiology Results</h5></div></td>
                  </tr>
                </table>
              </div>
              <div class='card-body' align='left'>
";

//---------------------------------------------------------------------------------------------------------------------------------------------------

echo "
                <table id='myProjectTable' class='table table-hover align-middle mb-0' style='width:100%'>
                  <thead>
                    <tr>
                      <th><div align='center'>#</div></th>
                      <th><div align='center'>Description</div></th>
                      <th><div align='center'>Payment Status</div></th>
                      <th><div align='center'>Date/Time Requested</div></th>
                      <th><div align='center'>Result Status</div></th>
                      <th><div align='center'>Action</div></th>
                    </tr>
                  </thead>
                  <tbody>
";

$zx=0;
$zxsql=mysqli_query($conn,"SELECT * FROM `productout` WHERE `caseno`='$caseno' AND (`productsubtype`='XRAY' OR `productsubtype`='ULTRASOUND' OR `productsubtype`='CT SCAN' OR `productsubtype`='MAMMOGRAPHY') AND `status` NOT LIKE '%CANCELLED%' GROUP BY `refno`");
while($zxfetch=mysqli_fetch_array($zxsql)){
  $refno=$zxfetch['refno'];
  $itemcode=$zxfetch['productcode'];
  $productdesc=$zxfetch['productdesc'];
  $ptype=$zxfetch['productsubtype'];
  $trantype=$zxfetch['trantype'];
  $status=$zxfetch['status'];
  $resultstatus=$zxfetch['terminalname'];
  $dateadded=$zxfetch['datearray'];
  $timeadded=$zxfetch['invno'];
  $user=$zxfetch['loginuser'];

  $approvalno=$zxfetch['approvalno'];
  $terminalname=$zxfetch['terminalname'];
  $zx++;

  if($resultstatus!=$terminalname){$resultstatus=$terminalname;}

  if($approvalno=="FOR CANCEL"){$rqc=" <span class='blinkforme' style='padding: 5px 6px;color: #FF0000;font-size: 11px;border-radius: 10px;'>(For Delete)</span>";}else{$rqc="";}

  if($resultstatus=="Testdone"){$rstdisp="Test Done";}
  else if($resultstatus=="pending"){$rstdisp="Pending";}
  else if($resultstatus=="Testtobedone"){$rstdisp="Test to be Done";}
  else if($resultstatus=="refund"){$rstdisp="<span class='text-warning'>Request Refund</span>";}
  else if($resultstatus=="CANCELLED"){$rstdisp="<span class='text-danger'>Request Cancelled</span>";}
  else{$rstdisp=$resultstatus;}

  if(($status=="Approved")||($status=="PAID")){$trc="";}else{$trc="class='table-danger'";}

  if($status=="PAID"){
    $zvsql=mysqli_query($conn,"SELECT `ofr` FROM `collection` WHERE `refno`='$refno'");
    $zvcount=mysqli_num_rows($zvsql);

    if($zvcount==0){
      $orno="";
    }
    else{
      $zvfetch=mysqli_fetch_array($zvsql);
      $orno=" <span style='color: blue;'>(".$zvfetch['ofr'].")</span>";
    }
  }
  else{
    $orno="";
  }

  $statusdisp=mb_strtoupper($status);

echo "
                    <tr $trc>
                      <td><div align='left'style='font-size: 13px;font-weight: bold;'>$zx</div></td>
                      <td><div align='left' style='font-size: 13px;font-weight: bold;'>$productdesc</div></td>
                      <td><div align='center' style='font-size: 13px;'>".$statusdisp.$orno."</div></td>
                      <td><div align='center' style='font-size: 13px;'>".date("M d, Y h:i A",strtotime("$dateadded $timeadded"))."</div></td>
                      <td><div align='center' style='font-size: 13px;font-weight: bold;'>$rstdisp$rqc</div></td>
                      <td><div align='center'>
                        <table border='0' cellpadding='0' cellspacing='0'>
                          <tr>
";


echo "
                            <td>
                              <a href='http://".$_SERVER['HTTP_HOST']."/arv2022/radiology/printresult-view.php?caseno=$caseno&refno=$refno&asdf=2123' target='_blank'>
                                <button type='submit' class='btn btn-secondary' title='Print Result'><i class='icofont-print'></i></button>
                              </a>
                            </td>
                          </tr>
                        </table>
                      </div></td>
                    </tr>
";
}

echo "
                  </tbody>
                </table>
";

//---------------------------------------------------------------------------------------------------------------------------------------------------
echo "
              </div>
            </div>
          </div>
        </div><!-- Row End -->
      </div>
    </div>
";

//echo "<META HTTP-EQUIV='Refresh'CONTENT='1500;URL=Close.php'>";
?>
