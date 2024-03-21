<?php
if($ct=="eca"){$frmconn=$conn;$dp="disabled";$dpc="background-color: #C2C2C2;";}
else{$frmconn=$tmpconn;$dp="";$dpc="";}

echo "
    <tr>
      <td style='padding-top: 10px;'>
";

$zk=0;
$zksql=mysqli_query($frmconn,"SELECT * FROM `productout` WHERE `caseno`='$caseno' AND `batchno`='$tick'");
$zkcount=mysqli_num_rows($zksql);
if($zkcount>0){
echo "
        <form method='post'>
          <table border='0' cellpadding='0' cellspacing='0' >
            <tr>
              <td colspan='6'><div align='left' style='font-family: arial;font-weight: bold;font-size: 12px;color: #008684;'>Item/s Added</div></td>
            </tr>
            <tr>
              <td class='t2 b2 l2' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-weight: bold;font-size: 10px;color: #000000;padding: 3px 5px;'>#</div></td>
              <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-weight: bold;font-size: 10px;color: #000000;padding: 3px 5px;'>Description</div></td>
              <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-weight: bold;font-size: 10px;color: #000000;padding: 3px 5px;'>Quantity</div></td>
              <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-weight: bold;font-size: 10px;color: #000000;padding: 3px 5px;'>Transaction</div></td>
              <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-weight: bold;font-size: 10px;color: #000000;padding: 3px 5px;'>Type</div></td>
              <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-weight: bold;font-size: 10px;color: #000000;padding: 3px 5px;'>User</div></td>
              <td class='t2 b2 l1 r2' style='border-radius: 0px;'><div align='center'></div></td>
            </tr>
";

  while($zkfetch=mysqli_fetch_array($zksql)){
    $zkrfn=$zkfetch['refno'];
    $zkcod=$zkfetch['productcode'];
    $zkprd=$zkfetch['productdesc'];
    $zkpqty=$zkfetch['quantity'];
    $zktrty=$zkfetch['trantype'];
    $zktype=$zkfetch['productsubtype'];
    $zktime=$zkfetch['invno'];
    $zkdate=$zkfetch['datearray'];
    $zkuser=$zkfetch['loginuser'];
    $zk++;

    $pdt=date("Y-m-d H:i:s");
    $t1=strtotime($pdt);
    $t2=strtotime("$zkdate $zktime");
    $diff=$t1-$t2;
    $hours=round(($diff/(60*60)),2);

    if($zktrty=="charge"){$zktrty="<span style='color: blue;'>Charge</span>";}
    else if($zktrty=="cash"){$zktrty="<span style='color: #FF0000;'>Cash</span>";}

    $lnkers="";
    $lnkere="";
    if($zktype=="LABORATORY"){
      $lnkers="<a href='../$aa[3]/$aa[4]&ermkrfn=$zkrfn&edrmk' style='text-decoration: none;'>";
      $lnkere="</a>";
    }
    else{
      if($zkcod=="210906184316p-50"){
        $lnkers="<a href='../$aa[3]/$aa[4]&ermkrfn=$zkrfn&edrmk' style='text-decoration: none;'>";
        $lnkere="</a>";
      }
    }

    $zrsql=mysqli_query($frmconn,"SELECT `remarks` FROM `labtest` WHERE `refno`='$zkrfn' AND `caseno`='$caseno'");
    $zrcount=mysqli_num_rows($zrsql);

    $zrrmks="";
    if($zrcount>0){
      $zrfetch=mysqli_fetch_array($zrsql);
      $zrrmks=mb_strtoupper(trim($zrfetch['remarks']));
    }

    if($zrrmks!=""){$zrrmks="<span style='color: #008684;font-size: 14px;font-weight: bold;'> [<span style='font-size: 11px;'><u>$zrrmks</u></span>]</span>";}

echo "
            <tr>
              <td class='b1 l2' style='border-radius: 0px;'><div align='left' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 3px;'>$zk</div></td>
              <td class='b1 l1' style='border-radius: 0px;'>$lnkers<div align='left' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 3px;'>$zkprd$zrrmks<input type='hidden' name='itmrfn$zk' value='$zkrfn' /></div>$lnkere</td>
              <td class='b1 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 3px;'>$zkpqty</div></td>
              <td class='b1 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 3px;'>$zktrty</div></td>
              <td class='b1 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 3px;'>$zktype</div></td>
              <td class='b1 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 3px;'>$zkuser</div></td>
              <td class='b1 l1 r2' style='border-radius: 0px;padding: 3px 3px;'><div align='center'>
";

if($ct=="eca"){
echo "
                <button  type='button' class='btn cancel' style='border-radius: 5px;background-color: #C2C2C2;' disabled>X</button>
";
}
else{
echo "
                <a href='../$aa[3]/$aa[4]&drfn=$zkrfn&itmd'";?> onclick="return confirm('Are you sure you want to remove <?php echo "$zkprd"; ?> from the list?');" <?php echo "><button  type='button' class='btn cancel' style='border-radius: 5px;'>X</button></a>
";
}

echo "
              </div></td>
            </tr>
";
  }

echo "
            <tr>
              <td class='t1' style='border-radius: 0px;padding: 3px;' colspan='7'><div align='right'><button type='submit' name='finalized' class='btn' style='$dpc' $dp";?> onclick="return confirm('Finalize request/s?');" <?php echo ">Finalized</button></div></td>
            </tr>
          </table>
          <input type='hidden' name='fncount' value='$zk' />
        </form>
";
}

echo "
      </td>
    </tr>
";
?>
