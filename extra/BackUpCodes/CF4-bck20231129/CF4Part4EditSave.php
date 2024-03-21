<?php
$txtWardDateOrderM=mysqli_real_escape_string($conncf4,$_POST['txtWardDateOrderM']);
$txtWardDateOrderD=mysqli_real_escape_string($conncf4,$_POST['txtWardDateOrderD']);
$txtWardDateOrderY=mysqli_real_escape_string($conncf4,$_POST['txtWardDateOrderY']);
$txtWardDocAction=trim(mb_strtoupper(mysqli_real_escape_string($conncf4,$_POST['txtWardDocAction'])));
$no=mysqli_real_escape_string($conncf4,$_POST['no']);

$txtWardDocAction=str_replace("`","",$txtWardDocAction);
$txtWardDocAction=str_replace("%","PERCENT",$txtWardDocAction);
$txtWardDocAction=str_replace("<","LESS THAN",$txtWardDocAction);
$txtWardDocAction=str_replace(">","MORE THAN",$txtWardDocAction);
$txtWardDocAction=str_replace("&","AND",$txtWardDocAction);
$txtWardDocAction=str_replace(":","",$txtWardDocAction);

$txtWardDateOrder=$txtWardDateOrderY."-".$txtWardDateOrderM."-".$txtWardDateOrderD;

$asql=mysqli_query($conncf4,"SELECT `pHciCaseNo`, `pHciTransNo` FROM `enlistment` WHERE `caseno`='$caseno'");
$acount=mysqli_num_rows($asql);
if($acount==0){
  $pHciCaseNo="";
  $pHciTransNo="";
}
else{
  $afetch=mysqli_fetch_array($asql);
  $pHciCaseNo=$afetch['pHciCaseNo'];
  $pHciTransNo=$afetch['pHciTransNo'];
}

if($txtWardDocAction!=""){
  mysqli_query($conncf4,"SET NAMES 'utf8'");
  mysqli_query($conncf4,"UPDATE `courseward` SET `pDateAction`='$txtWardDateOrder', `pDoctorsAction`='$txtWardDocAction' WHERE `no`='$no'");

echo "
  <span class='arial16bluebold'>Course in the Ward saved...</span>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='1;URL=?cf4p4&caseno=$caseno'>";
}
else{
echo "
  <span class='arial14redbold'>Cannot be blank! Try again!!!</span>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='2;URL=?cf4p4&caseno=$caseno'>";
}

?>
</body>
</html>
