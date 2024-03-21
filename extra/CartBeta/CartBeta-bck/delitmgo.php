<?php
  $drfn=mysqli_real_escape_string($tmpconn,$_GET['drfn']);
  $rfa="&drfn=$drfn&itmd";

  $zjsql=mysqli_query($tmpconn,"SELECT `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`, `trantype`, `datearray`, `invno`, `loginuser` FROM `productout` WHERE `refno`='$drfn'");
  $zjfetch=mysqli_fetch_array($zjsql);
  $zjdesc=$zjfetch['productdesc'];
  $zjsp=$zjfetch['sellingprice'];
  $zjqty=$zjfetch['quantity'];
  $zjadj=$zjfetch['adjustment'];
  $zjgr=$zjfetch['gross'];
  $zjttype=$zjfetch['trantype'];
  $zjdate=$zjfetch['datearray'];
  $zjtime=$zjfetch['invno'];
  $zjuser=$zjfetch['loginuser'];

  $reclog="$pn --> $caseno --> RefNo: $drfn --> Desc.: $zjdesc --> Item Deleted. ($zjdesc, $zjsp, $zjqty, $zjadj, $zjgr, $zjttype, $zjdate, $zjtime, $zjuser)";
  mysqli_query($tmpconn,"INSERT INTO `userlogs` (`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('$reclog', '".base64_decode($_SESSION['cnm'])."', '".date("Y-m-d")."', '".date("H:i:s")."')");

  if(mysqli_query($tmpconn,"DELETE FROM `productout` WHERE `refno`='$drfn'")){}
  if(mysqli_query($tmpconn,"DELETE FROM `labtest` WHERE `refno`='$drfn'")){}
  if(mysqli_query($tmpconn,"DELETE FROM `labpending` WHERE `refno`='$drfn'")){}

echo "
  <span style='font-family: arial;font-weight: bold;font-size: 16px;color: #FF0000;'>Item Deleted!!!</span>
";

  echo "<META HTTP-EQUIV='Refresh'CONTENT='2;URL=../$aa[3]/".str_replace("$rfa","",$aa[4])."'>";
?>
