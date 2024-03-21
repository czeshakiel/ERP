<style>
  .t1{border-top: 1px solid black;}
  .b1{border-bottom: 1px solid black;}
  .l1{border-left: 1px solid black;}
  .r1{border-right: 1px solid black;}

  .t2{border-top: 2px solid black;}
  .b2{border-bottom: 2px solid black;}
  .l2{border-left: 2px solid black;}
  .r2{border-right: 2px solid black;}
</style>

<?php
if(isset($_POST['btn_submit'])){
  $doctor=mysqli_real_escape_string($conn,$_POST['doctor']);
  $services=mysqli_real_escape_string($conn,$_POST['services']);
  $phic=mysqli_real_escape_string($conn,$_POST['phic']);
  $hmo=mysqli_real_escape_string($conn,$_POST['hmo']);
  $disc=mysqli_real_escape_string($conn,$_POST['disc']);
  $pf=mysqli_real_escape_string($conn,$_POST['pf']);
  $round=mysqli_real_escape_string($conn,$_POST['round']);

  if($doctor==""){
echo"
  <script>alert('Please select doctor!');</script>
  <script>window.location='pfposting.php?caseno=$caseno&patientidno=$patientidno&user=$user&postpf';</script>
";
    exit;
  }

  if($pf==""){
echo"
  <script>alert('Please provide PF amount!');</script>
  <script>window.location='pfposting.php?caseno=$caseno&patientidno=$patientidno&user=$user&postpf';</script>
";
    exit;
  }

  if($round==""){
echo"
  <script>alert('Please input round!');</script>
  <script>window.location='pfposting.php?caseno=$caseno&patientidno=$patientidno&user=$user&postpf';</script>
";
    exit;
  }

  $sql2 = "SELECT * FROM docfile where code='$doctor'";
  $result2 = $conn->query($sql2);

  $rescount=mysqli_num_rows($result2);
  if($rescount!=0){
    while($row2 = $result2->fetch_assoc()) {
      $docname=$row2['name'];
    }
  }
  else{
    $docname=$doctor;
  }

  $gross = $pf * $round;

  mysqli_query($conn,"SET NAMES 'utf8'");
  $axsql=mysqli_query($conn,"SELECT p.`senior` FROM `admission` a, `patientprofile` p WHERE a.`caseno`='$caseno' AND a.`patientidno`=p.`patientidno`");
  $axfetch=mysqli_fetch_array($axsql);
  $senior=$axfetch['senior'];

  if($senior == "Y" or $senior == "y" or $senior == "YES"){$lesssenior = $gross * .20;}else{$lesssenior = 0;}

  $gross2 = $gross - $disc - $lesssenior;
  $lessphic = $gross - $phic;
  $lesshmo = $lessphic - $hmo;
  $lessdisc = $lesshmo - $disc;
  $lessdisc = $lessdisc - $lesssenior;
  $excess = $lessdisc;
  $disc = $disc + $lesssenior;
  $refno = date("YmdHis");
  $vdate = date("M-d-Y");
  $batchno = "PF".$refno;

  if($disc>0){$loc="discount";}else{$loc="0";}

  $sql7 = "INSERT INTO `productout` (`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`, `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`) VALUES ('$refno', CURTIME(), '$caseno', '$doctor', '$docname', '$pf', '$round', '$disc', '$gross2', 'charge', '$phic', '$hmo', '$excess', '$vdate', 'Approved', '', '".base64_decode($_SESSION['nm'])."', '$batchno', '$services', 'PROFESSIONAL FEE', 'doc-pf', '', 'Approved', '$branch', '$loc', CURDATE(), '')";
  if ($conn->query($sql7) === TRUE) {echo"<script>alert('Successfully Added!');</script>";}
  $location = "pfposting.php?caseno=$caseno&patientidno=$patientidno&user=$user&postpf";

echo "
<script>
  window.location='".$location."';
</script>
";
}

if(isset($_POST['btn_del'])){
  $refno = $_POST['refno'];
  $casenox = $_POST['caseno'];
  $code = $_POST['code'];

  mysqli_query($conn,"SET NAMES 'utf8'");
  $axsql=mysqli_query($conn,"SELECT p.`patientname` FROM `admission` a, `patientprofile` p WHERE a.`caseno`='$casenox' AND a.`patientidno`=p.`patientidno`");
  $axfetch=mysqli_fetch_array($axsql);
  $patname=$axfetch['patientname'];

  $aysql=mysqli_query($conn,"SELECT * FROM `productout` WHERE `refno`='$refno'");
  $ayfetch=mysqli_fetch_array($aysql);
  $itmdesc=$ayfetch['productdesc'];
  $itmsp=$ayfetch['sellingprice'];
  $itmqty=$ayfetch['quantity'];
  $itmadj=$ayfetch['adjustment'];
  $itmgr=$ayfetch['gross'];
  $itmph1=$ayfetch['phic'];
  $itmph2=$ayfetch['phic1'];
  $itmhmo=$ayfetch['hmo'];
  $itmdate=$ayfetch['datearray'];
  $itmtime=$ayfetch['invno'];
  $itmptype=$ayfetch['producttype'];

  $ulog=$patname." | ".$casenox." | Remove Posted PF | $itmdesc | $itmsp | $itmqty | $itmadj | $itmgr | $itmph1 | $itmph2 | $itmhmo | $itmptype | $itmdate | $itmtime | $refno |";
  mysqli_query($conn,"INSERT INTO `userlogs` (`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('$ulog', '".base64_decode($_SESSION['nm'])."', '".date("Y-m-d")."', '".date("H:i:s")."')");

  $sql7="DELETE FROM `productout` WHERE `refno`='$refno' AND `productcode`='$code' AND `caseno`='$casenox'";

  if ($conn->query($sql7) === TRUE) {echo"<script>alert('Successfully Removed!');</script>";}
  $location = "pfposting.php?caseno=$caseno&patientidno=$patientidno&user=$user&postpf";

echo "
<script>
  window.location='".$location."';
</script>
";
}


?>

<?php
mysqli_query($conn,"SET NAMES 'utf8'");

echo "
<table border='0' width='100%' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='40%' valign='top'>
      <form method='post'>
        <table border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <td colspan='2' height='10'></td>
          </tr>
          <tr>
            <td><div align='left' style='font-family: arial;font-size: 12px;font-weight: bold;padding: 2px 5px 2px 0;'>DOCTOR:</div></td>
            <td><div align='left' style='padding: 2px 0;'>
              <select id='selsearch' name='doctor' style='width: 300px;border-radius: 3px;' required>
                <option value=''></option>
                <option>JURELL DAVE N. OGADO, RTRP</option>
                <option>JEANNY ROSE DAGATAN, RN</option>
                <option>LENS C/O DRA. EMBALSADO</option>
                <option>IMPLANTS C/O DR. AMPARO</option>
                <option>INSTRUMENT C/O DR. DEL ROSARIO</option>
                <option>INSTRUMENT C/O DR. CERIALES</option>
                <option>SUPPLIES C/O DR. ISAGUIRRE</option>
                <option>STAINLESS c/o Dr. MANGAHAS</option>
                <option>SUPPLIES C/O DR. PURACAN</option>
                <option>SUPPLIES C/O DR. LAFORTEZA</option>
                <option>STENT C/O DR. LOBATON</option>
    ";

    $zxsql=mysqli_query($conn,"SELECT `name`, `code` FROM `docfile` WHERE `status`='ACTIVE' ORDER BY `name`");
    while($zxfetch=$zxsql->fetch_assoc()) {
      $name=$zxfetch['name'];
      $code=$zxfetch['code'];

    echo "
                <option value='$code'>$name</option>
    ";
    }

    echo "
              </select>
            </div></td>
          </tr>
          <tr>
            <td><div align='left' style='font-family: arial;font-size: 12px;font-weight: bold;padding: 2px 5px 2px 0;'>SERVICES:</div></td>
            <td><div align='left' style='padding: 2px 0;'>
              <select name='services' style='border: 1px solid black;height: 30px;width: 300px;border-radius: 3px;'>
                <option value'IPD attending'>IPD attending</option>
                <option value'ON CALL'>ON CALL</option>
                <option value'IPD comanaged'>IPD comanaged</option>
                <option value'IPD discharge'>IPD surgeon</option>
                <option value'IPD discharge'>IPD co-surgeon</option>
                <option value'IPD discharge'>IPD anesthesiologist</option>
                <option value'IPD discharge'>IPD co-anesthesiologist</option>
              </select>
            </div></td>
          </tr>
          <tr>
            <td><div align='left' style='font-family: arial;font-size: 12px;font-weight: bold;padding: 2px 5px 2px 0;'>PF:</div></td>
            <td><div align='left' style='padding: 2px 0;'><input type='text' name='pf' style='border: 1px solid black;height: 25px;border-radius: 3px;' value='' required /></div></td>
          </tr>
          <tr>
            <td><div align='left' style='font-family: arial;font-size: 12px;font-weight: bold;padding: 2px 5px 2px 0;'>ROUND:</div></td>
            <td><div align='left' style='padding: 2px 0;'><input type='text' name='round' style='border: 1px solid black;height: 25px;border-radius: 3px;' value='1' /></div></td>
          </tr>
          <tr>
            <td><div align='left' style='font-family: arial;font-size: 12px;font-weight: bold;padding: 2px 5px 2px 0;'>PHIC:</div></td>
            <td><div align='left' style='padding: 2px 0;'>
              <input type='text' name='phic' style='border: 1px solid black;height: 25px;border-radius: 3px;' value='0' /><br>
              <font color='red' size='1'><i>IF NO ENTRY FOR PHIC, JUST ENCODE A ZERO VALUE</i></font>
            </div></td>
          </tr>
          <tr>
            <td><div align='left' style='font-family: arial;font-size: 12px;font-weight: bold;padding: 2px 5px 2px 0;'>HMO:</div></td>
            <td><div align='left' style='padding: 2px 0;'><div align='left' style='padding: 2px 0;'>
              <input type='text' name='hmo' style='border: 1px solid black;height: 25px;border-radius: 3px;' value='0' /><br>
              <font color='red' size='1'><i>IF NO ENTRY FOR HMO, JUST ENCODE A ZERO VALUE</i></font>
            </div></td>
          </tr>
          <tr>
            <td><div align='left' style='font-family: arial;font-size: 12px;font-weight: bold;padding: 2px 5px 2px 0;'>DISCOUNT:</div></td>
            <td><div align='left' style='padding: 2px 0;'>
              <input type='text' name='disc' style='border: 1px solid black;height: 25px;border-radius: 3px;' value='0' /><br>
              <font color='red' size='1'><i>IF NO ENTRY FOR DISC, JUST ENCODE A ZERO VALUE</i></font>
            </div></td>
          </tr>
          <tr>
            <td colspan='2'><div align='center' style='padding: 10px 0;'><button type='submit' class='btngreen' name='btn_submit' style='height: 30px;padding: 5px 25px 5px 25px;font-size: 12px;border-radius: 5px;'>Submit</button></div></td>
          </tr>
        </table>
      </form>
    </td>
    <td valign='top'><div align='left'>
      <p align='left'><font color='black'><b>REQUEST FOR EXCESS <i><font color='red'>(set by Doctor)</font></i></p>
      <table border='0' cellpadding='0' cellspacing='0'>
        <thead>
          <tr>
            <th bgcolor='#034B58' class='t2 b2 l2'><div align='center' style='color: #FFFFFF;font-family: arial;font-weight: bold;font-size: 12px;padding: 3px 5px;'>DOCTOR</div></th>
            <th bgcolor='#034B58' class='t2 b2 l1'><div align='center' style='color: #FFFFFF;font-family: arial;font-weight: bold;font-size: 12px;padding: 3px 5px;'>SERVICES</div></th>
            <th bgcolor='#034B58' class='t2 b2 l1 r2'><div align='center' style='color: #FFFFFF;font-family: arial;font-weight: bold;font-size: 12px;padding: 3px 5px;'>EXCESS</div></th>
          </tr>
        </thead>
        <tbody>
";

$zasql=mysqli_query($conn,"SELECT `ontop` FROM `request_caserate` WHERE `caseno`='$caseno'");
while($zafetch=$zasql->fetch_assoc()){
  $ontop=$zafetch['ontop'];

  $zbsql=mysqli_query($conn,"SELECT `ap` FROM `admission` WHERE `caseno`='$caseno'");
  $zbfetch=$zbsql->fetch_assoc();
  $ap=$zbfetch['ap'];

echo "
          <tr>
            <td class='b1 l2'><div align='left' style='font-family: arial;font-size: 14px;padding: 3px 5px;color: blue;'>$ap</div></td>
            <td class='b1 l1'><div align='right' style='font-family: arial;font-size: 14px;padding: 3px 5px;color: blue;'>$ontop</div></td>
            <td class='b1 l1 r2'><div align='center' style='font-family: arial;font-size: 14px;padding: 3px 5px;color: blue;'>FOR EXCESS</div></td>
          </tr>
";
}

echo "
        </tbody>
      </table>

      <p align='left'><font color='black'><b>PARTIAL REQUEST <i><font color='red'>(set by Station)</font></i></p>
      <table border='0' cellpadding='0' cellspacing='0'>
        <thead>
          <tr>
            <th bgcolor='#034B58' class='t2 b2 l2'><div align='center' style='color: #FFFFFF;font-family: arial;font-size: 12px;font-weight: bold;padding: 3px 5px;'>DOCTOR</div></th>
            <th bgcolor='#034B58' class='t2 b2 l1'><div align='center' style='color: #FFFFFF;font-family: arial;font-size: 12px;font-weight: bold;padding: 3px 5px;'>SERVICES</div></th>
            <th bgcolor='#034B58' class='t2 b2 l1'><div align='center' style='color: #FFFFFF;font-family: arial;font-size: 12px;font-weight: bold;padding: 3px 5px;'>QTY</div></th>
            <th bgcolor='#034B58' class='t2 b2 l1'><div align='center' style='color: #FFFFFF;font-family: arial;font-size: 12px;font-weight: bold;padding: 3px 5px;'>SP</div></th>
            <th bgcolor='#034B58' class='t2 b2 l1'><div align='center' style='color: #FFFFFF;font-family: arial;font-size: 12px;font-weight: bold;padding: 3px 5px;'>SC</div></th>
            <th bgcolor='#034B58' class='t2 b2 l1'><div align='center' style='color: #FFFFFF;font-family: arial;font-size: 12px;font-weight: bold;padding: 3px 5px;'>GROSS</div></th>
            <th bgcolor='#034B58' class='t2 b2 l1'><div align='center' style='color: #FFFFFF;font-family: arial;font-size: 12px;font-weight: bold;padding: 3px 5px;'>PHIC</div></th>
            <th bgcolor='#034B58' class='t2 b2 l1'><div align='center' style='color: #FFFFFF;font-family: arial;font-size: 12px;font-weight: bold;padding: 3px 5px;'>HMO</div></th>
            <th bgcolor='#034B58' class='t2 b2 l1 r2'><div align='center' style='color: #FFFFFF;font-family: arial;font-size: 12px;font-weight: bold;padding: 3px 5px;'>EXCESS</div></th>
          </tr>
        </thead>
        <tbody>
";

$zcsql=mysqli_query($conn,"SELECT * FROM `productoutarv` WHERE (`productsubtype`='PROFESSIONAL FEE' OR `productsubtype` LIKE '%ON CALL%') AND `caseno`='$caseno'");
while($zcfetch=$zcsql->fetch_assoc()){
  $pdesc=$zcfetch['productdesc'];
  $gross=$zcfetch['gross'];
  $qty=$zcfetch['quantity'];
  $adj=$zcfetch['adjustment'];
  $sp=$zcfetch['sellingprice'];
  $phic=$zcfetch['phic'];
  $hmo=$zcfetch['hmo'];
  $excess=$zcfetch['excess'];
  $ptype=$zcfetch['producttype'];
  $refno=$zcfetch['refno'];
  $pcode=$zcfetch['productcode'];

echo "
          <tr>
            <td class='b1 l2'><div align='left' style='font-size: 14px;padding: 3px 5px;color: blue;'>$pdesc</div></td>
            <td class='b1 l1'><div align='left' style='font-size: 14px;padding: 3px 5px;color: blue;'>$ptype</div></td>
            <td class='b1 l1'><div align='left' style='font-size: 14px;padding: 3px 5px;color: blue;'>$qty</div></td>
            <td class='b1 l1'><div align='left' style='font-size: 14px;padding: 3px 5px;color: blue;'>$sp</div></td>
            <td class='b1 l1'><div align='left' style='font-size: 14px;padding: 3px 5px;color: blue;'>$adj</div></td>
            <td class='b1 l1'><div align='left' style='font-size: 14px;padding: 3px 5px;color: blue;'>$gross</div></td>
            <td class='b1 l1'><div align='left' style='font-size: 14px;padding: 3px 5px;color: blue;'>$phic</div></td>
            <td class='b1 l1'><div align='left' style='font-size: 14px;padding: 3px 5px;color: blue;'>$hmo</div></td>
            <td class='b1 l1'><div align='left' style='font-size: 14px;padding: 3px 5px;color: blue;'>$excess</div></td>
            <td class='b1 l1 r2'><div align='left' style='padding: 3px 5px;'>
              <a href='removepf.php?refno=".$row2z['refno']."' target='_blank'"?> onclick="return confirm('Do you wish to remove this item?');return false;" ?><?php echo "><button name='btn_del' class='btn btn-danger' title='Delete PF' disabled><i class='icofont-ui-close text-danger'></i></button></a>
            </div></td>
          </tr>
";
}

echo "
        </tbody>
      </table>

      <p align='left'><font color='black'><b>FINAL REQUEST <i><font color='red'>(set by Billing)</font></i></p>
      <table border='0' cellpadding='0' cellspacing='0'>
        <thead>
          <tr>
            <th bgcolor='#034B58' class='t2 b2 l2'><div align='center' style='color: #FFFFFF;font-family: arial;font-size: 12px;font-weight: bold;padding: 3px 5px;'>DOCTOR</div></th>
            <th bgcolor='#034B58' class='t2 b2 l1'><div align='center' style='color: #FFFFFF;font-family: arial;font-size: 12px;font-weight: bold;padding: 3px 5px;'>SERVICES</div></th>
            <th bgcolor='#034B58' class='t2 b2 l1'><div align='center' style='color: #FFFFFF;font-family: arial;font-size: 12px;font-weight: bold;padding: 3px 5px;'>SP</div></th>
            <th bgcolor='#034B58' class='t2 b2 l1'><div align='center' style='color: #FFFFFF;font-family: arial;font-size: 12px;font-weight: bold;padding: 3px 5px;'>SC</div></th>
            <th bgcolor='#034B58' class='t2 b2 l1'><div align='center' style='color: #FFFFFF;font-family: arial;font-size: 12px;font-weight: bold;padding: 3px 5px;'>GROSS</div></th>
            <th bgcolor='#034B58' class='t2 b2 l1'><div align='center' style='color: #FFFFFF;font-family: arial;font-size: 12px;font-weight: bold;padding: 3px 5px;'>PHIC</div></th>
            <th bgcolor='#034B58' class='t2 b2 l1'><div align='center' style='color: #FFFFFF;font-family: arial;font-size: 12px;font-weight: bold;padding: 3px 5px;'>HMO</div></th>
            <th bgcolor='#034B58' class='t2 b2 l1'><div align='center' style='color: #FFFFFF;font-family: arial;font-size: 12px;font-weight: bold;padding: 3px 5px;'>EXCESS</div></th>
            <th bgcolor='#034B58' class='t2 b2 l1 r2'><div align='center' style='color: #FFFFFF;font-family: arial;font-size: 12px;font-weight: bold;padding: 3px 5px;'></div></th>
          </tr>
        </thead>
        <tbody>
";

$zdsql=mysqli_query($conn,"SELECT * FROM `productout` WHERE (`productsubtype`='PROFESSIONAL FEE' OR `productsubtype` LIKE '%ON CALL%') AND `caseno`='$caseno' AND (`approvalno`='doc-pf' OR `approvalno`='')");
while($zdfetch=$zdsql->fetch_assoc()) {
  $pdesc=$zdfetch['productdesc'];
  $gross=$zdfetch['gross'];
  $adj=$zdfetch['adjustment'];
  $sp=$zdfetch['sellingprice'];
  $phic=$zdfetch['phic'];
  $hmo=$zdfetch['hmo'];
  $excess=$zdfetch['excess'];
  $ptype=$zdfetch['producttype'];
  $refno=$zdfetch['refno'];
  $pcode=$zdfetch['productcode'];

echo "
          <tr>
            <td class='b1 l2'><div align='left' style='font-size: 14px;padding: 3px 5px;color: blue;'>$pdesc</div></td>
            <td class='b1 l1'><div align='center' style='font-size: 14px;padding: 3px 5px;color: blue;'>$ptype</div></td>
            <td class='b1 l1'><div align='right' style='font-size: 14px;padding: 3px 5px;color: blue;'>$sp</div></td>
            <td class='b1 l1'><div align='right' style='font-size: 14px;padding: 3px 5px;color: blue;'>$adj</div></td>
            <td class='b1 l1'><div align='right' style='font-size: 14px;padding: 3px 5px;color: blue;'>$gross</div></td>
            <td class='b1 l1'><div align='right' style='font-size: 14px;padding: 3px 5px;color: blue;'>$phic</div></td>
            <td class='b1 l1'><div align='right' style='font-size: 14px;padding: 3px 5px;color: blue;'>$hmo</div></td>
            <td class='b1 l1'><div align='right' style='font-size: 14px;padding: 3px 5px;color: blue;'>$excess</div></td>
            <td class='b1 l1 r2'><div align='center' style='padding: 3px 5px;'>
              <form method='POST'>
                <button type='submit' name='btn_del' title='Delete PF' style='color: #FF0000;'"?> onclick="return confirm('Are you sure you want to remove <?php echo $pdesc ?>');" <?php echo ">&#x2716;</button>
                <input type='hidden' name='refno' value='$refno' />
                <input type='hidden' name='caseno' value='$caseno' />
                <input type='hidden' name='code' value='$pcode' />
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
";
?>
