<?php
$no=mysqli_real_escape_string($conncf4,$_POST['no']);

$kcwsql=mysqli_query($conncf4,"SELECT * FROM `courseward` WHERE `no`='$no'");
if(mysqli_num_rows($kcwsql)>0){
  $kcwfetch=mysqli_fetch_array($kcwsql);
  $pDateAction=$kcwfetch['pDateAction'];
  $pDoctorsAction=$kcwfetch['pDoctorsAction'];

  mysqli_query($conn,"INSERT INTO `userlogs` (`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('Course in the Ward Deleted | $caseno | $pDateAction | $pDoctorsAction', '".base64_decode($snm)."', '".date("Y-m-d")."', '".date("H:i:s")."')");
  mysqli_query($conncf4,"DELETE FROM `courseward` WHERE `no`='$no'");

echo "
  <span class='arial16redbold'>Course in the Ward deleted!!!</span>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='1;URL=?cf4p4&caseno=$caseno'>";
}
else{
echo "
  <span class='arial16redbold'>Course in the Ward already deleted!!!</span>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='2;URL=?cf4p4&caseno=$caseno'>";
}
?>
</body>
</html>
