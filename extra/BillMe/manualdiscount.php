<?php
echo "
<table border='0' width='100%' cellpadding='0' cellspacing='0'>
  <tr>
    <td><div align='center'>
      <table border='0' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
          <td><div align='left' style='font-family: Arial; font-size: 16px;'><span style='font-weight: bold;'><u><?php echo $ap; ?></u></span></div></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td><div class='panel-body'>
      <form name='f1' method='post' action=''>
      <input type='hidden' name='applydiscount'>
        <div class='accordion' id='accord'>
";

$tgross="";
$count=explode("-",$tgross);
$w=0;
$sqlAccount=mysqli_query($conn,"SELECT `id`, `producttype` FROM `hmoallocation` WHERE `producttype` <> 'PROFESSIONAL FEE' ORDER BY `id` ASC");
if(mysqli_num_rows($sqlAccount)>0){
  while($account=mysqli_fetch_array($sqlAccount)){
    $accounttitle=$account['producttype'];
    $sqlSubType=mysqli_query($conn,"SELECT `productsubtype` FROM `hmoallocationtype` WHERE `pid`='$account[id]' GROUP BY `productsubtype`");
    $excess=0;
    $discount=0;
    if(mysqli_num_rows($sqlSubType)>0){
      while($type=mysqli_fetch_array($sqlSubType)){
        $sqlHospital=mysqli_query($conn,"SELECT SUM(`excess`) AS `excess`, SUM(`adjustment`) AS `discount` FROM `productout` WHERE `caseno`='$caseno' AND `productsubtype`='$type[productsubtype]' AND `trantype`='charge' AND `quantity` > 0");
        if(mysqli_num_rows($sqlHospital)>0){
          while($row=mysqli_fetch_array($sqlHospital)){
            $excess+=$row['excess'];
            $discount+=$row['discount'];
          }

          if(($excess>0)||(($excess==0)&&($discount>0))){$view="";}
          else{$view="style='display:none;'";}
        }
      }
    }

echo "
          <div class='accordion-item' $view>
            <h2 class='accordion-header' id='headingOne$w'>
              <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#collapseOne$w' aria-expanded='false' aria-controls='collapseOne$w'>$accounttitle</button>
            </h2>
            <div id='collapseOne$w' class='accordion-collapse collapse' aria-labelledby='headingOne$w' data-bs-parent='#accord'>
              <div class='accordion-body'>
                <table width='100%' border='0'>
                  <tr>
                    <td align='left'><u>Item Description</u></td>
                    <td align='right'><u>SRP</u></td>
                    <td align='center'><u>Qty</u></td>
                    <td align='right'><u>Gross</u></td>
                    <td align='right'><u>Discount</u></td>
                    <td align='right'><u>PHIC</u></td>
                    <td align='right'><u>HMO</u></td>
                    <td align='right'><u>Excess</u></td>
                  </tr>
";

    $totalgross=0;
    $totaldiscount=0;
    $totalphic=0;
    $totalhmo=0;
    $totalexcess=0;
    $sqlSubType=mysqli_query($conn,"SELECT `productsubtype` FROM `hmoallocationtype` WHERE `pid`='$account[id]' AND `productsubtype` <> 'PROFESSIONAL FEE'");
    if(mysqli_num_rows($sqlSubType)>0){
      while($type=mysqli_fetch_array($sqlSubType)){
        $sqlHospital=mysqli_query($conn,"SELECT `productcode`, SUM(`quantity`) AS `quantity`, `sellingprice`, `productdesc`, SUM(`excess`) AS `excess`, SUM(`adjustment`) AS `discount`, SUM(`hmo`) AS `hmo`, SUM(`phic`) AS `phic` FROM `productout` WHERE `caseno`='$caseno' AND `productsubtype`='$type[productsubtype]' AND `trantype`='charge' AND `quantity` > 0 GROUP BY `productcode` ORDER BY `productsubtype` ASC, `productdesc` ASC");
        if(mysqli_num_rows($sqlHospital)>0){
          while($row=mysqli_fetch_array($sqlHospital)){
            $gross=$row['sellingprice']*$row['quantity'];
            $desc=str_replace('ams-','',$row['productdesc']);
            $desc=str_replace('-sup','',$desc);
            $desc=str_replace('-med','',$desc);
            $totalexcess+=$row['excess'];
            $totalgross+=$gross;
            $totaldiscount+=$row['discount'];
            $totalphic +=$row['phic'];
            $totalhmo +=$row['hmo'];

            if($row['discount']>0){$view="";}
            else{$view="style='display:none;'";}

echo "
                  <tr>
                    <td height='30'><label><input type='checkbox' name='code[]' value='$row[productcode]'> $desc</label></td>
                    <td align='right'>".number_format($row['sellingprice'],2,'.',',')."</td>
                    <td align='center'>$row[quantity]</td>
                    <td align='right'>".number_format($gross,2,'.',',')."</td>
                    <td align='right'>".number_format($row['discount'],2,'.',',')."<a href='?caseno=$caseno&dept=BILLING&user=$user&applydiscount&delete&code=$row[productcode]' $view> <i class='icofont-ui-close text-danger'></i></a></td>
                    <td align='right'>".number_format($row['phic'],2,'.',',')."</td>
                    <td align='right'>".number_format($row['hmo'],2,'.',',')."</td>
                    <td align='right'>".number_format($row['excess'],2,'.',',')."</td>
                  </tr>
";
          }
        }
      }
    }

echo "
                  <tr>
                    <td colspan='8'><hr width='100%' /></td>
                  </tr>
                  <tr>
                    <td align='right'>TOTAL EXCESS</td>
                    <td align='right'></td>
                    <td align='right'></td>
                    <td align='right'><u>".number_format($totalgross,2,'.',',')."</u></td>
                    <td align='right'><u>".number_format($totaldiscount,2,'.',',')."</u></td>
                    <td align='right'><u>".number_format($totalphic,2,'.',',')."</u></td>
                    <td align='right'><u>".number_format($totalhmo,2,'.',',')."</u></td>
                    <td align='right'><u>".number_format($totalexcess,2,'.',',')."</u></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
";

    $w++;
  }
}

echo "
        </div>
        <br />
        <table border='0' width='100%' cellpadding='0' cellspacing='0'>
          <tr>
            <td><div align='center'>
              <table border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td><input type='text' name='discount' value='' class='form-control' style='border: 2px solid #000000;width:100px; text-align:center' placeholder='% Discount' required /></td>
                  <td width='5'></td>
                  <td><input type='submit' class='btn btn-warning' name='submit' value='APPLY DISCOUNT' /></td>
                </tr>
              </table>
            </div></td>
          </tr>
        </table>
      </form>
";

if(isset($_POST['submit'])){
  $amount=$_POST['discount'];

  if(isset($_POST['code'])){
    $c=$_POST['code'];
    $datearray=date('Y-m-d');
    $sql1="SELECT `patientname` FROM `patientprofile` WHERE `patientidno`='$patientidno'";
    $sqlPatient=mysqli_query($conn,$sql1);
    $patient=mysqli_fetch_array($sqlPatient);
    $patientname=$patient['patientname'];

    $x=0;
    $xxix=0;
    foreach($c as $code){
      $sqlasd="SELECT * FROM `productout` WHERE `productcode`='$code' AND `caseno`='$caseno' AND `quantity` > 0 AND `trantype`='charge' AND `excess` > 0";
      $sqlItem=mysqli_query($conn,$sqlasd);
      if(mysqli_num_rows($sqlItem)>0){
        while($item=mysqli_fetch_array($sqlItem)){
          if(($amount > 0)&&($item['excess']>0)){
            $refno=$item['refno'];
            $discount=($amount/100);
            $disc=($item['excess'])*$discount+$item['adjustment'];
            $excess=($item['sellingprice']*$item['quantity'])-$item['phic']-$item['hmo']-$disc;
            $gross=($item['sellingprice']*$item['quantity'])-$disc;

            mysqli_query($conn,"UPDATE `productout` SET `adjustment`='$disc', `gross`='$gross', `excess`='$excess' WHERE `refno`='$refno'");

            $sqlPatient=mysqli_query($conn,"SELECT `patientname` FROM `patientprofile` WHERE `patientidno`='$patientidno'");
            $pname=mysqli_fetch_array($sqlPatient);
            $transmessage=$pname['patientname']." Manual Discount is posted.";
            $datearray=date('Y-m-d');
            $timearray=date('H:i:s');

            $sqlInsert=mysqli_query($conn,"INSERT INTO `userlogs` (`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('$transmessage', '$name', '$datearray', '$timearray')");

            $xxix+=1;
          }
        }
      }

      $x++;
    }

    if($xxix>0){
echo "
<script>
  alert('Discount successfully posted!');window.location='?caseno=$caseno&dept=BILLING&user=$user&applydiscount';
</script>
";
    }
  }
  else{
echo "
<script>
  alert('Please select at least one (1) item from the list!');window.location='?caseno=$caseno&dept=BILLING&user=$user&applydiscount';
</script>
";
  }
}

if(isset($_GET['delete'])){
  $code=$_GET['code'];
  $sql="SELECT * FROM `productout` WHERE `productcode`='$code' AND `caseno`='$caseno' AND `quantity` > 0 AND `trantype`='charge'";
  $sqlItem=mysqli_query($conn,$sql);
  if(mysqli_num_rows($sqlItem)>0){
    while($item=mysqli_fetch_array($sqlItem)){
      $refno=$item['refno'];
      $disc=0;
      $gross=($item['sellingprice']*$item['quantity'])-$disc;
      $excess=$gross-$item['phic']-$item['hmo'];
      $sqlApplyDiscount=mysqli_query($conn,"UPDATE `productout` SET `adjustment`='$disc', `gross`='$gross', `excess`='$excess' WHERE `refno`='$refno'");
    }
  }
  if($sqlApplyDiscount){
    $sqlPatient=mysqli_query($conn,"SELECT pp.`patientname` FROM `patientprofile` pp INNER JOIN `admission` a ON a.`patientidno`=pp.`patientidno` WHERE a.`caseno`='$caseno'");
    $pname=mysqli_fetch_array($sqlPatient);
    $transmessage=$pname['patientname']." posted discount has been removed with reference no. $refno";
    $datearray=date('Y-m-d');
    $timearray=date('H:i:s');

    $sqlInsert=mysqli_query($conn,"INSERT INTO `userlogs` (`transaction`, `loginuser`, `datearray`, `timearray`) VALUES('$transmessage', '$name', '$datearray', '$timearray')");

echo "
<script>
  alert('Discount successfully removed!');window.location='?caseno=$caseno&dept=BILLING&user=$user&applydiscount';
</script>
";
  }
  else{
echo "
<script>
  alert('Unable to remove discount!');window.location='?caseno=$caseno&dept=BILLING&user=$user&applydiscount';
</script>
";
  }
}
?>

<script type='text/javascript'>
  function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
  }
</script>
