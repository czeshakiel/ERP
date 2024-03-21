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
$lb="Patient Details";

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
                    <td><div align='left'><h5 class='fw-bold'><i class='icofont-listine-dots me-2'></i> Laboratory Results</h5></div></td>
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
$zxsql=mysqli_query($conn,"SELECT * FROM `labpending` WHERE `caseno`='$caseno' AND `ptype`='LABORATORY' AND `productdesc` NOT LIKE '%RAPID TEST%' AND `productdesc` NOT LIKE '%RT%%PCR%' AND `productdesc` NOT LIKE '%ABG%' ORDER BY `dateadded`, `timeadded`");
while($zxfetch=mysqli_fetch_array($zxsql)){
  $refno=$zxfetch['refno'];
  $itemcode=$zxfetch['itemcode'];
  $productdesc=$zxfetch['productdesc'];
  $ptype=$zxfetch['ptype'];
  $trantype=$zxfetch['trantype'];
  $status=$zxfetch['status'];
  $resultstatus=$zxfetch['resultstatus'];
  $testdonedt=$zxfetch['testdonedt'];
  $labtype=$zxfetch['labtype'];
  $testno=$zxfetch['testno'];
  $station=$zxfetch['station'];
  $dateadded=$zxfetch['dateadded'];
  $timeadded=$zxfetch['timeadded'];
  $user=$zxfetch['user'];
  $viewcount=$zxfetch['viewcount'];
  $printcount=$zxfetch['printcount'];
  $verified=$zxfetch['verified'];
  $redit=$zxfetch['redit'];

  $zysql=mysqli_query($conn,"SELECT * FROM `productout` WHERE `refno`='$refno' AND (`trantype`='charge' OR `trantype`='cash' OR `trantype`='CANCELLED')");
  if(mysqli_num_rows($zysql)==1){
    $zyfetch=mysqli_fetch_array($zysql);
    $approvalno=$zyfetch['approvalno'];
    $terminalname=$zyfetch['terminalname'];
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

    if($labtype==""){
      $khsql=mysqli_query($conn,"SELECT `lotno` FROM `receiving` WHERE `code`='$itemcode'");
      $khfetch=mysqli_fetch_array($khsql);
      $labtype=$khfetch['lotno'];
    }

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


    if($resultstatus=="Testdone"){
      $zzsql=mysqli_query($conn,"SELECT * FROM `labresults` WHERE `refno`='$refno' LIMIT 0,1");
      $zzcount=mysqli_num_rows($zzsql);

      if($zzcount==0){
        if(($labtype=="chemistry")||($labtype=="serology")){
          if(stripos($caseno, "I-") !== FALSE){
            $bgstart="<form method='get' target='_blank' action='http://".$_SERVER['HTTP_HOST']."/labprint/bloodchem.php'><input type='hidden' name='caseno' value='$caseno' /><input type='hidden' name='lab29' value='$refno' /><input type='hidden' name='testno' value='$testno' />$dat";
            $bgend="</form>";
          }
          else{
            $bgstart="<form method='get' target='_blank' action='http://".$_SERVER['HTTP_HOST']."/labprint/bloodchem_alt.php'><input type='hidden' name='caseno' value='$caseno' /><input type='hidden' name='lab29' value='$refno' /><input type='hidden' name='testno' value='$testno' />$dat";
            $bgend="</form>";
          }

          $cgstart="<form method='get' target='_blank' action='http://".$_SERVER['HTTP_HOST']."/cgi-bin/bloodchem-update.cgi'><input type='hidden' name='caseno' value='$caseno' /><input type='hidden' name='lab29' value='$refno' /><input type='hidden' name='testno' value='$testno' />";
          $cgend="</form>";
        }
        else{
          if($labtype=="hematology"){
            if(stripos($caseno, "I-") !== FALSE){
              $bgstart="<form method='get' target='_blank' action='http://".$_SERVER['HTTP_HOST']."/labprint/hemabody.php'><input type='hidden' name='caseno' value='$caseno' /><input type='hidden' name='lab29' value='$refno' />$dat";
              $bgend="</form>";
            }
            else{
              $bgstart="<form method='get' target='_blank' action='http://".$_SERVER['HTTP_HOST']."/labprint/hemabody_alt2.php'><input type='hidden' name='caseno' value='$caseno' /><input type='hidden' name='lab29' value='$refno' />";
              $bgend="</form>";
            }

            $cgstart="<form method='get' target='_blank' action='http://".$_SERVER['HTTP_HOST']."/cgi-bin/CBC-update.cgi'><input type='hidden' name='caseno' value='$caseno' /><input type='hidden' name='lab29' value='$refno' />";
            $cgend="</form>";
          }
          else{
            if(($productdesc=="Stool Exam")||($productdesc=="Stool Exam with Occult Blood")||($productdesc=="OCCULT BLOOD")){
              if(stripos($caseno, "I-") !== FALSE){
                $bgstart="<form method='get' target='_blank' action='http://".$_SERVER['HTTP_HOST']."/cgi-bin/fecalysis200.cgi'><input type='hidden' name='patient' value='$patient' /><input type='hidden' name='refno' value='$refno' />$dat";
                $bgend="</form>";
              }
              else{
                $bgstart="<form method='get' target='_blank' action='http://".$_SERVER['HTTP_HOST']."/cgi-bin/fecalysis200_alt.cgi'><input type='hidden' name='patient' value='$patient' /><input type='hidden' name='refno' value='$refno' />$dat";
                $bgend="</form>";
              }
            }
            else{
              if(stripos($caseno, "I-") !== FALSE){
                $bgstart="<form method='get' target='_blank' action='http://".$_SERVER['HTTP_HOST']."/labprint/$productdesc-body.php'><input type='hidden' name='caseno' value='$caseno' /><input type='hidden' name='refno' value='$refno' />$dat";
                $bgend="</form>";
              }
              else{
                $bgstart="<form method='get' target='_blank' action='http://".$_SERVER['HTTP_HOST']."/labprint/$productdesc-body_alt.php'><input type='hidden' name='caseno' value='$caseno' /><input type='hidden' name='refno' value='$refno' />$dat";
                $bgend="</form>";
              }
            }

            if($testdetails2=="Widal Test"){
              $cgstart="<form method='get' target='_blank' action='http://".$_SERVER['HTTP_HOST']."/cgi-bin/widaltest100.cgi'><input type='hidden' name='caseno' value='$caseno' /><input type='hidden' name='lab29' value='$refno' />";
              $cgend="</form>";
            }
            else{
              $cgstart="<form method='get' target='_blank' action='http://".$_SERVER['HTTP_HOST']."/cgi-bin/$productdesc.cgi'><input type='hidden' name='caseno' value='$caseno' /><input type='hidden' name='lab29' value='$refno' />";
              $cgend="</form>";
            }
          }
        }
      }
      else{
        $bgstart="<form method='get' target='_blank' action='../extra/LabExpress/PrintResult/'><input type='hidden' name='caseno' value='$caseno' /><input type='hidden' name='patid' value='$patientidno' /><input type='hidden' name='printbatchno' value='$testno' /><input type='hidden' name='stype' value='$labtype' /><input type='hidden' name='asd' value='".base64_decode($snm)."' /><input type='hidden' name='noh' />";
        $bgend="</form>";
        $cgstart="<form method='post' target='_blank'><input type='hidden' name='srefno' value='$refno' /><input type='hidden' name='ltype' value='$labtype' /><input type='hidden' name='eres' />";
        $cgend="</form>";
      }

echo "
                            <td>$bgstart<input type='hidden' name='from' /><button type='submit' class='btn btn-secondary' title='Print Result'><i class='icofont-print'></i></button>$bgend</td>
";
    }
    else{
echo "
                            <td></td>
";
    }

echo "
                          </tr>
                        </table>
                      </div></td>
                    </tr>
";
  }
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
