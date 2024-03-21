<?php
  $prt=preg_split("/\-/",$tick);

  $rfa="&unf";
  $rtc=str_replace("&tick=$tick","",$aa[4]);

echo "
    <table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td style='padding-bottom: 5px;'><div align='left'>
          <img src='../Resources/Pictures/Cart.png' width='20' height='auto' /> <span style='font-family: arial;font-weight: bold;font-size: 16px;color: #2BAA76;'> $ctlbl CART</span> | <span style='font-family: arial;font-weight: bold;font-size: 12px;color: #000000;'>USER: <span style='color: #03A3CD;'>$snm</span></span>
        </div></td>
      </tr>
      <tr>
        <td style='padding-bottom: 5px;'><div align='left'><a href='../$aa[3]/".str_replace("$rfa","",$aa[4])."'><input type='button' class='btn cancel' value='&#9664; Back' /></a></div></td>
      </tr>
      <tr>
        <td style='padding-bottom: 5px;'><div align='left' style='font-family: arial;font-size: 16px;font-weight: bold;color: #7109A9;'>Un-finalized Request/s</div></td>
      </tr>
      <tr>
        <td><div align='left'>
          <table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td class='t2 b2 l2' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-weight: bold;font-size: 10px;color: #000000;padding: 3px 5px;'>#</div></td>
              <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-weight: bold;font-size: 10px;color: #000000;padding: 3px 5px;'>Batch No.</div></td>
              <td class='t2 b2 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-weight: bold;font-size: 10px;color: #000000;padding: 3px 5px;'>Date-Time Requested</div></td>
              <td class='t2 b2 l1 r2' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-weight: bold;font-size: 10px;color: #000000;padding: 3px 5px;'>Action</div></td>
            </tr>
";

  $zg=0;
  $zgsql=mysqli_query($tmpconn,"SELECT `batchno`, `datearray`, `invno` FROM `productout` WHERE `caseno`='$caseno' AND `batchno` LIKE '$prt[0]-%%' GROUP BY `batchno`");
  while($zgfetch=mysqli_fetch_array($zgsql)){
    $zgbno=$zgfetch['batchno'];
    $zgdat=$zgfetch['datearray'];
    $zgtim=$zgfetch['invno'];

    $pdt=date("Y-m-d H:i:s");
    $t1=strtotime($pdt);
    $t2=strtotime("$zgdat $zgtim");
    $diff=$t1-$t2;
    $hour=round(($diff/(60*60)),2);

    if(($tick!=$zgbno)&&($hour<1)){
      $zg++;

echo "
            <tr>
              <td class='b1 l2' style='border-radius: 0px;'><div align='left' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 3px;'>$zg</div></td>
              <td class='b1 l1' style='border-radius: 0px;'><div align='left' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 3px;'>$zgbno</div></td>
              <td class='b1 l1' style='border-radius: 0px;'><div align='center' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 3px;'>".date("M d, Y h:i A",strtotime("$zgdat $zgtim"))."</div></td>
              <td class='b1 l1 r2' style='border-radius: 0px;'><a href='../$aa[3]/".str_replace("&unf","",$rtc)."&tick=$zgbno'><div align='center' style='font-family: arial;font-size: 14px;color: #000000;padding: 3px 3px;'><button type='button' class='btn' title='View'>&#x27A4;</button></div></a></td>
            </tr>
";
    }
  }

echo "
            <tr>
              <td class='t1' colspan='4'></td>
            </tr>
          </table>
        </div></td>
      </tr>
    </table>
";
?>
