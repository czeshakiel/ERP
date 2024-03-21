<?php
  $itmrfnrmk=mysqli_real_escape_string($tmpconn,$_POST['itmrfnrmk']);
  $eremarks=mysqli_real_escape_string($tmpconn,$_POST['eremarks']);

  $zjsql=mysqli_query($tmpconn,"SELECT `productdesc` FROM `productout` WHERE `refno`='$itmrfnrmk'");
  $zjfetch=mysqli_fetch_array($zjsql);
  $zjdesc=$zjfetch['productdesc'];

  if(mysqli_query($tmpconn,"UPDATE `labtest` SET `remarks`='$eremarks' WHERE `refno`='$itmrfnrmk'")){}

  $reclog="$pn --> $caseno --> RefNo: $itmrfnrmk --> Desc.: $zjdesc --> Updated Remarks.";
  mysqli_query($conn,"INSERT INTO `userlogs` (`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('$reclog', '".base64_decode($_SESSION['cnm'])."', '".date("Y-m-d")."', '".date("H:i:s")."')");

echo "
  <span style='font-family: arial;font-weight: bold;font-size: 16px;color: #3E0AA5;'>Remarks updated!!!</span>
";

  echo "<META HTTP-EQUIV='Refresh'CONTENT='2;URL=../$aa[3]/$aa[4]'>";
?>
