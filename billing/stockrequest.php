<?php
if(!isset($_POST['proceed'])){
$lb="Stock Request";

$pdt=date('Y-m-d');
mysqli_query($conn,"INSERT INTO `requestno` VALUES('')");
$axsql=mysqli_query($conn,"SELECT `autono` FROM `requestno` ORDER BY `autono` DESC LIMIT 1");
$axfetch=mysqli_fetch_array($axsql);
$reqno="BILLING-".date('Ymd')."".$axfetch['autono'];

echo "
    <!-- Body: Body -->
    <div class='body d-flex py-lg-3 py-md-2'>
      <div class='container-xxl'>
        <div class='row align-items-center'>
          <div class='border-0 mb-4'>
            <div class='card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap'>
              <h3 class='fw-bold mb-0'>$lb</h3>
            </div>
          </div>
        </div> <!-- Row end  -->
        <div class='row clearfix g-3'>
          <div class='col-xl-12 col-lg-12 col-md-12 flex-column'>
            <div class='row g-3'>
";

echo "
                <div class='col-md-4'>
                  <div class='card light-danger-bg'>
                    <div class='card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0'>
                      <h6 class='mb-0 fw-bold '>Requisition Details</h6>
                    </div>
                    <div class='card-body' style='background-color: #FFFFFF;'>
                      <form method='post'>
                        <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td>Request No.</td>
                            <td><input type='text' name='reqno' class='form-control' value='$reqno' readonly /></td>
                          </tr>
                          <tr>
                            <td height='5' colspan='2'></td>
                          </tr>
                          <tr>
                            <td>Transaction Date</td>
                            <td><input type='date' name='transdate' class='form-control' value='$pdt' readonly /></td>
                          </tr>
                          <tr>
                            <td height='5' colspan='2'></td>
                          </tr>
                          <tr>
                            <td>Requesting Dept.</td>
                            <td><input type='text' name='requestingdept' class='form-control' value='BILLING' readonly /></td>
                          </tr>
                          <tr>
                            <td height='5' colspan='2'></td>
                          </tr>
                          <tr>
                            <td>Requesting User</td>
                            <td><input type='text' name='requser' class='form-control' value='$user' readonly /></td>
                          </tr>
                          <tr>
                            <td height='5' colspan='2'></td>
                          </tr>
                          <tr>
                            <td>To Department</td>
                            <td>
                              <select name='requesteddept' class='form-control'>
";

$aysql=mysqli_query($conn,"SELECT `employeename` FROM `mmshi` WHERE `employeename` NOT LIKE ''");
if(mysqli_num_rows($aysql)>0){
  while($ayfetch=mysqli_fetch_array($aysql)){
    $empdpt=$ayfetch['employeename'];

echo "
                                <option>$empdpt</option>
";
  }
}

echo "
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td height='15' colspan='2'></td>
                          </tr>
                          <tr>
                            <td colspan='2'><div align='right'><button type='submit' name='proceed' class='btn btn-success text-white'>Proceed <i class='icofont-bubble-right fs-5'></i></button></div></td>
                          </tr>
                        </table>
                      </form>
                    </div>
                    <div class='card-footer border-top-0'>
                    </div>
                  </div>
                </div>

                <div class='col-md-6'>
                  <div class='card light-danger-bg'>
                    <div class='card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0'>
                      <h6 class='mb-0 fw-bold'>Print Requisistion</h6>
                    </div>
                    <div class='card-body' style='background-color: #FFFFFF;'>
                      <table id='myProjectTable' class='table table-hover align-middle mb-0' style='width:100%'>
                        <thead>
                          <tr>
                            <th width='25'>#</th>
                            <th>Request No.</th>
                            <th width='40'>Action</th>
                          </tr>
                        </thead>
                        <tbody>
";

$ar=0;
$arsql=mysqli_query($conn,"SELECT * FROM `purchaseorder` WHERE `reqdept`='BILLING' AND `status`='request' GROUP BY `reqno`");
while($arfetch=mysqli_fetch_array($arsql)){
  $arreqno=$arfetch['reqno'];
  $ar++;

echo "
                          <tr>
                            <td>$ar</td>
                            <td>$arreqno</td>
                            <td><div align='center'><a href='stockrequestprint.php?reqno=$arreqno&dept=BILLING' target='_blank'><button type='button' class='btn btn-success' title='Print Request'><i class='icofont-printer text-white'></i></button></a></div></td>
                          </tr>
";
}

echo "
                        </tbody>
                      </table>
                    </div>
                    <div class='card-footer border-top-0'>
                    </div>
                  </div>
                </div>
";

echo "
              </div>
            </div>
          </div>
        </div><!-- Row End -->
      </div>
    </div>
";
}
else if(isset($_POST['proceed'])){
$lb="Requesistion Details";

$transdate=mysqli_real_escape_string($conn,$_POST['transdate']);
$requestingdept=mysqli_real_escape_string($conn,$_POST['requestingdept']);
$requesteddept=mysqli_real_escape_string($conn,$_POST['requesteddept']);
$reqno=mysqli_real_escape_string($conn,$_POST['reqno']);
$requser=mysqli_real_escape_string($conn,$_POST['requser']);

echo "
    <!-- Body: Body -->
    <div class='body d-flex py-lg-3 py-md-2'>
      <div class='container-xxl'>
        <div class='row align-items-center'>
          <div class='border-0 mb-4'>
            <div class='card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap'>
              <h3 class='fw-bold mb-0'>$lb</h3>
            </div>
          </div>
        </div> <!-- Row end  -->
        <div class='row clearfix g-3'>
          <div class='col-xl-12 col-lg-12 col-md-12 flex-column'>
            <div class='row g-3'>
";


echo "
                <div class='col-md-5'>
                  <div class='card light-success-bg'>
                    <div class='card-header py-2 d-flex justify-content-between bg-transparent border-bottom-0'>
                      <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td><div align='right'>
                            <a href='stockrequestprint.php?reqno=$reqno&dept=BILLING' target='_blank'>
                              <button type='button' class='btn btn-dark btn-sm'>Print <i class='icofont-printer fs-8'></i></button>
                            </a>
                          </div></td>
                        </tr>
                      </table>
                    </div>
                    <div class='card-body' style='background-color: #FFFFFF;'>
                      <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td>
                            <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                              <tr>
                                <td><div align='left' style='padding: 0 2px 0 2px;'><i><span style='font-weight: bold;'>REQUESTED DEPT.: </span>$requesteddept</i></div></td>
                              </tr>
                              <tr>
                                <td><div align='left' style='padding: 0 2px 0 2px;'><i><span style='font-weight: bold;'>DATE: </span>".date('M d, Y',strtotime($transdate))."</i></div></td>
                              </tr>
                              <tr>
                                <td><div align='left' style='padding: 0 2px 0 2px;'><i><span style='font-weight: bold;'>REQUESTING DEPARTMENT: </span>$requestingdept</i></div></td>
                              </tr>
                              <tr>
                                <td><div align='left' style='padding: 0 2px 0 2px;'><i><span style='font-weight: bold;'>REQUESITION NO.: </span>$reqno</i></div></td>
                              </tr>
                              <tr>
                                <td><div align='left' style='padding: 0 2px 0 2px;'><i><span style='font-weight: bold;'>REQUESTING USER: </span>$requser</i></div></td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <td height='5'></td>
                        </tr>
                        <tr>
                          <td>
                            <table class='table table-hover align-middle mb-0' style='width:100%'>
                              <thead>
                                <tr>
                                  <th><div align='center' style='font-size: 10px;'>#</div></th>
                                  <th><div align='center' style='font-size: 10px;'>Type</div></th>
                                  <th><div align='center' style='font-size: 10px;'>Description</div></th>
                                  <th><div align='center' style='font-size: 10px;'>Qty.</div></th>
                                  <th><div align='center' style='font-size: 10px;'>Action</div></th>
                                </tr>
                              </thead>
                              <tbody>
";

$az=0;
$azsql=mysqli_query($conn,"SELECT `description`, `prodqty`, `approvingofficer`, `rrdetails`, `code`, `supplier`, `suppliercode` FROM `purchaseorder` WHERE `po`='$reqno' AND `status`='request'");
//$azsql=mysqli_query($conn,"SELECT `description`, `prodqty`, `approvingofficer`, `rrdetails`, `code`, `supplier`, `suppliercode` FROM `purchaseorder` WHERE `status`='request'");
while($azfetch=mysqli_fetch_array($azsql)){
  $description=$azfetch['description'];
  $prodqty=$azfetch['prodqty'];
  $approvingofficer=$azfetch['approvingofficer'];
  $rrdetails=$azfetch['rrdetails'];
  $code=$azfetch['code'];
  $supplier=$azfetch['supplier'];
  $suppliercode=$azfetch['suppliercode'];
  $az++;

  $description=str_replace("cmshi-","",$description);
  $description=str_replace("ams-","",$description);
  $description=str_replace("-sup","",$description);
  $description=str_replace("-med","",$description);

  if($approvingofficer=="EXPENSE"){$status="E";}
  else if($approvingofficer=="charge"){$status="C";}

echo "
                                <tr>
                                  <td><div align='left' style='font-size: 12px;'>$az</div></td>
                                  <td><div align='left' style='font-size: 12px;'>$status</div></td>
                                  <td><div align='left' style='font-size: 12px;'>$description</div></td>
                                  <td><div align='center' style='font-size: 12px;'>$prodqty</div></td>
                                  <td><div align='center' style='font-size: 12px;'>
                                    <form id='mySignUp' method='post'>
                                      <span style='color: #FFFFFF;cursor: pointer;' onclick=document.getElementById('mySignUp').submit();><i class='icofont-trash text-danger fs-8'></i></span>
                                      <input type='hidden' name='transdate' value='$transdate' />
                                      <input type='hidden' name='requestingdept' value='$requestingdept' />
                                      <input type='hidden' name='requesteddept' value='$requesteddept' />
                                      <input type='hidden' name='reqno' value='$reqno' />
                                      <input type='hidden' name='requser' value='$requser' />
                                      <input type='hidden' name='code' value='$code' />
                                      <input type='hidden' name='delete' value='' />
                                      <input type='hidden' name='proceed' value='' />
                                    </form>
                                  </div></td>
                                </tr>
";
}

echo "
                              </tbody>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </div>
                    <div class='card-footer border-top-0'>
                    </div>
                  </div>
                </div>

                <div class='col-md-7'>
                  <div class='card light-success-bg'>
                    <div class='card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0'>
                      <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td><div align='left'><h6 class='mb-0 fw-bold'>Select Product</h6></div></td>
                        </tr>
                      </table>
                    </div>
                    <div class='card-body' style='background-color: #FFFFFF;'>
                      <form method='post'>
                        <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                          <tr>
                            <td>
                              <table id='myProjectTable' class='table table-hover align-middle mb-0' style='width:100%'>
                                <thead>
                                  <tr>
                                    <th></th>
                                    <th>Description</th>
                                    <th><div align='center'>SOH</div></th>
                                  </tr>
                                </thead>
                                <tbody>
";

$ay=0;
if(($requesteddept=="PHARMACY")||($requesteddept=="PHARMACY_OPD")){$aysql=mysqli_query($conn,"SELECT r.`description`, r.`code`, r.`generic`, SUM(s.`quantity`) AS soh FROM `stocktable` s INNER JOIN `receiving` r ON r.`code`=s.`code` WHERE s.`dept`='$requesteddept' GROUP BY s.`code` ORDER BY s.`datearray` ASC");}
else{$aysql=mysqli_query($conn,"SELECT r.`description`, r.`code`, r.`generic`, SUM(s.`quantity`) AS soh FROM `stocktable` s INNER JOIN `receiving` r ON r.`code`=s.`code` WHERE s.`dept`='$requesteddept' AND s.`datearray` >= '2021-07-01' GROUP BY s.`code`");}
while($ayfetch=mysqli_fetch_array($aysql)){
  $aydescription=$ayfetch['description'];
  $aycode=$ayfetch['code'];
  $aygeneric=$ayfetch['generic'];
  $aysoh=$ayfetch['soh'];

  $aydescription=str_replace("cmshi-","",$aydescription);
  $aydescription=str_replace("ams-","",$aydescription);
  $aydescription=str_replace("-sup","",$aydescription);
  $aydescription=str_replace("-med","",$aydescription);

  if($aygeneric!=""){$aygeneric="($aygeneric) ";}

  $sqlCheck=mysqli_query($conn,"SELECT `code` FROM `receiving` WHERE `code`='$aycode'");

  if(mysqli_num_rows($sqlCheck)>0){
    $ay++;

echo "
                                  <tr>
                                    <td><div align='center'><input type='checkbox' name='code[]' value='$aycode' /></div></td>
                                    <td><div align='left'>$aygeneric$aydescription</div></td>
                                    <td><div align='center'>$aysoh</div></td>
                                  </tr>
";
  }
}

echo "
                                </tbody>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td height='10' class='b2'></td>
                          </tr>
                          <tr>
                            <td height='10'></td>
                          </tr>
                          <tr>
                            <td><div align='center'>
                              <table border='0' cellpadding='0' cellspacing='0'>
                                <tr>
                                  <td><input name='qty' type='number' step='1' min='1' class='form-control' style='width: 200px;text-align: center;' placeholder='Quantity' value='' required /></td>
                                  <td width='10'></td>
                                  <td>
                                    <select name='trantype' class='form-control' style='width: 200px;text-align: center;'>
                                      <option value='charge'>CHARGE</optio>
                                      <option value='EXPENSE'>EXPENSE</option>
                                    </select>
                                  </td>
                                </tr>
                              </table>
                            </div></td>
                          </tr>
                          <tr>
                            <td height='10'></td>
                          </tr>
                          <tr>
                            <td><div align='center'><button type='submit' name='submitItem' class='btn btn-dark' style='width: 200px;'>Submit <i class='icofont-save fs-8'></i></button></div></td>
                          </tr>
                          <tr>
                            <td height='10'></td>
                          </tr>
                          <tr>
                            <td height='10' class='t2'></td>
                          </tr>
                        </table>
                        <input type='hidden' name='transdate' value='$transdate' />
                        <input type='hidden' name='requestingdept' value='$requestingdept' />
                        <input type='hidden' name='requesteddept' value='$requesteddept' />
                        <input type='hidden' name='reqno' value='$reqno' />
                        <input type='hidden' name='requser' value='$requser' />
                        <input type='hidden' name='proceed' value='' />
                      </form>
                    </div>
                    <div class='card-footer border-top-0'>
                    </div>
                  </div>
                </div>
";

echo "
              </div>
            </div>
          </div>
        </div><!-- Row End -->
      </div>
    </div>
";

  if(isset($_POST['submitItem'])){
    $transdate=mysqli_real_escape_string($conn,$_POST['transdate']);
    $requestingdept=mysqli_real_escape_string($conn,$_POST['requestingdept']);
    $requesteddept=mysqli_real_escape_string($conn,$_POST['requesteddept']);
    $reqno=mysqli_real_escape_string($conn,$_POST['reqno']);
    $requser=mysqli_real_escape_string($conn,$_POST['requser']);
    $trantype=mysqli_real_escape_string($conn,$_POST['trantype']);
    //$code=mysqli_real_escape_string($conn,$_POST['code']);
    $qty=mysqli_real_escape_string($conn,$_POST['qty']);

    $tdate=date('M-d-Y',strtotime($transdate));

    foreach($_POST['code'] as $item){echo $item;
      $sql="SELECT * FROM `purchaseorder` WHERE `po`='$reqno' AND `code`='$item'";
      $sqlCheck=mysqli_query($conn,$sql);
      if(mysqli_num_rows($sqlCheck)>0){
        $check=mysqli_fetch_array($sqlCheck);
        $oldqty=$check['prodqty'];
        $newqty=$oldqty+$qty;
        $sql="SELECT SUM(`quantity`) AS soh from `stocktable` WHERE `dept`='$requesteddept' AND `code`='$item' AND `datearray` >= '2021-07-01'";
        $sqlSOH=mysqli_query($conn,$sql);

        if(mysqli_num_rows($sqlSOH)>0){
          $qty1=mysqli_fetch_array($sqlSOH);
          $soh=$qty1['soh'];
        }
        if($soh >= $newqty){
          $update=mysqli_query($conn,"UPDATE `purchaseorder` SET `prodqty`='$newqty' WHERE `po`='$reqno' AND `code`='$item'");

echo "
  <form method='POST' id='data' style='display:none'>
    <input type='hidden' name='transdate' value='$transdate' />
    <input type='hidden' name='requestingdept' value='$requestingdept' />
    <input type='hidden' name='requesteddept' value='$requesteddept' />
    <input type='hidden' name='reqno' value='$reqno' />
    <input type='hidden' name='requser' value='$requser' />
    <input type='hidden' name='proceed' value='' />
    <input type='submit'>
  </form>
  <script>
    document.forms.namedItem('data').submit();
  </script>
";

        }
        else{
echo "
                        <script>
                            alert('Invalid quantity!');
                        </script>
";
        }
      }
      else{
        $sql="SELECT SUM(`quantity`) AS soh FROM `stocktable` WHERE `dept`='$requesteddept' AND `code`='$item' AND `datearray` >= '2021-07-01'";
        $sqlSOH=mysqli_query($conn,$sql);

        if(mysqli_num_rows($sqlSOH)>0){
          $qty1=mysqli_fetch_array($sqlSOH);
          $soh=$qty1['soh'];
        }

        if($soh >= $qty){echo $qty;
          //---------------------------------------------------------------------------------------
            $seqname="RN";
            $user=mysqli_query($conn,"SELECT `name` FROM `nsauth` WHERE `username`='".$user."'");
            $name=mysqli_fetch_object($user)->name;
            $datenow=date('Y');
            $check=mysqli_query($con,"SELECT * FROM `seqpatientid` WHERE `seq_name`='$seqname' AND `seq_code`='$datenow'");

            if(mysqli_num_rows($check)>0){
              $row=mysqli_fetch_object($check);
              $seq_name=$row->seq_name;
              $seq_code=$row->seq_code;
              $last_value=$row->last_value;
              $last_gen_date=date('Ym');
              $date=date('Y-m-d H:i:s');

              $new_value=$last_value+1;

              $count_last_value=strlen($new_value);
              $count_format=strlen('00000');
              $count=$count_format - $count_last_value;
              $new_format="";

              for($i=0;$i<$count;$i++){
                $new_format=$new_format."0";
              }

              $caseno=$seq_name."".$last_gen_date."".$new_format."".$new_value;
              $updatecase=mysqli_query($con,"UPDATE `seqpatientid` SET `last_value`='$new_value', `last_gen_date`='$date', `last_gen_by`='$name' WHERE `seq_name`='$seqname' AND `seq_code`='$datenow'");
            }
            else{
              $new_value=1;
              $last_gen_date=date('Ym');
              $format='0000';
              $caseno=$seqname."".$last_gen_date."".$format."".$new_value;
              $savecase=mysqli_query($con,"INSERT INTO `seqpatientid` (`seq_name`, `seq_code`, `last_value`, `last_gen_date`, `last_gen_by`) VALUES('$seqname', '$datenow', '$new_value', NOW(), '$name')");
            }

          //---------------------------------------------------------------------------------------

          $refno=$caseno;
          $sqlDescription=mysqli_query($conn,"SELECT `description`, `unitcost`, `rrno` FROM `stocktable` WHERE `code`='$item' GROUP BY `rrno`");
          $item1=mysqli_fetch_array($sqlDescription);
          $sql1="INSERT INTO `purchaseorder` (`rrno`, `transdate`, `supplier`, `suppliercode`, `terms`, `trantype`, `code`, `description`, `unitcost`, `generic`, `prodqty`, `dept`, `status`, `prodtype1`, `po`, `user`, `approvingofficer`, `reqdept`, `reqno`, `reqdate`, `requser`) VALUES ('$item1[rrno]', '$refno', '$requesteddept', '$requesteddept', '', 'NONE', '$item', '$item1[description]', '$item1[unitcost]', '$transdate', '$qty', '$requesteddept', 'request', '', '$reqno', '$requser', '$trantype', '$requestingdept', '$reqno', '$transdate', '$requser')";
          $sqlSave=mysqli_query($conn,$sql1);

          if($sqlSave){

echo "
  <form method='POST' id='data' style='display:none'>
    <input type='hidden' name='transdate' value='$transdate' />
    <input type='hidden' name='requestingdept' value='$requestingdept' />
    <input type='hidden' name='requesteddept' value='$requesteddept' />
    <input type='hidden' name='reqno' value='$reqno' />
    <input type='hidden' name='requser' value='$requser' />
    <input type='hidden' name='proceed' value='' />
    <input type='submit'>
  </form>
  <script>
    document.forms.namedItem('data').submit();
  </script>
";
          }
          else{
echo "
  <script>
    alert('Unable to add item!');
  </script>
";
          }
        }
        else{
echo "
  <script>
    alert('Invalid quantity!');
  </script>
";
        }
      }
    }
  }

  if(isset($_POST['delete'])){
    $transdate=mysqli_real_escape_string($conn,$_POST['transdate']);
    $requestingdept=mysqli_real_escape_string($conn,$_POST['requestingdept']);
    $requesteddept=mysqli_real_escape_string($conn,$_POST['requesteddept']);
    $reqno=mysqli_real_escape_string($conn,$_POST['reqno']);
    $requser=mysqli_real_escape_string($conn,$_POST['requser']);
    $code=mysqli_real_escape_string($conn,$_POST['code']);

    $sql="DELETE FROM `purchaseorder` WHERE `po`='$reqno' AND `code`='$code'";
    $sqlDelete=mysqli_query($conn,$sql);

    if($sqlDelete){

echo "
  <script>
    alert('Item Deleted!');
  </script>
  <form method='POST' id='data' style='display:none'>
    <input type='hidden' name='transdate' value='$transdate' />
    <input type='hidden' name='requestingdept' value='$requestingdept' />
    <input type='hidden' name='requesteddept' value='$requesteddept' />
    <input type='hidden' name='reqno' value='$reqno' />
    <input type='hidden' name='requser' value='$requser' />
    <input type='hidden' name='proceed' value='' />
    <input type='submit'>
  </form>
  <script>
    document.forms.namedItem('data').submit();
  </script>
";

    }
  }
}
?>
