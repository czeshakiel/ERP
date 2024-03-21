<?php
$pPainSite=trim(strtoupper(mysqli_real_escape_string($conncf4,$_POST["pPainSite"])));
$pCf4OtherSymptoms=trim(strtoupper(mysqli_real_escape_string($conncf4,$_POST["pCf4OtherSymptoms"])));

$pPainSite=str_replace("`","",$pPainSite);
$pPainSite=str_replace("'","",$pPainSite);
$pPainSite=str_replace("&","",$pPainSite);

$pCf4OtherSymptoms=str_replace("`","",$pCf4OtherSymptoms);
$pCf4OtherSymptoms=str_replace("'","",$pCf4OtherSymptoms);
$pCf4OtherSymptoms=str_replace("&","",$pCf4OtherSymptoms);

$a=0;$b=0;$c=0;
$pSignsSymptoms="";

if(empty($_POST["pCf4Symptoms"])){
echo "
  <span class='arial16redbold'>You need to check atleast one of the symptoms!!!</span>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=?cf4p2&caseno=$caseno'>";
}
else{
  foreach ($_POST['pCf4Symptoms'] as $key => $value) {
    $a++;
    if($value=="38"){$b+=1;}
    if($value=="X"){$c+=1;}
    if($a<2){$pSignsSymptoms=$pSignsSymptoms.$value;}
    elseif($a>1){$pSignsSymptoms=$pSignsSymptoms.";".$value;}
  }

  $asql=mysqli_query($conncf4,"SELECT * FROM `subjective` WHERE `caseno`='$caseno'");
  $acount=mysqli_num_rows($asql);

  $d=0;
  if($b>0){
    $pPainSite=$pPainSite;
    if($pPainSite==""){
      $d+=1;
    }
  }
  else{
    $pPainSite="";
  }

  if($c>0){
    $pCf4OtherSymptoms=$pCf4OtherSymptoms;
  }
  else{
    $pCf4OtherSymptoms="";
  }

  if($d==0){
    if($acount==0){
      //echo "INSERT INTO `subjective` (`pChiefComplaint`, `pIllnessHistory`, `pOtherComplaint`, `pSignsSymptoms`, `pPainSite`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '$pCf4OtherSymptoms', '$pSignsSymptoms', '$pPainSite', 'U', '', '$caseno')";
      mysqli_query($conncf4,"INSERT INTO `subjective` (`pChiefComplaint`, `pIllnessHistory`, `pOtherComplaint`, `pSignsSymptoms`, `pPainSite`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('', '', '$pCf4OtherSymptoms', '$pSignsSymptoms', '$pPainSite', 'U', '', '$caseno')");

echo "
  <span class='arial16bluebold'>Entries saved...</span>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='1;URL=?cf4p3&caseno=$caseno'>";
    }
    else{
      //echo "UPDATE `subjective` SET pOtherComplaint='$pCf4OtherSymptoms', pSignsSymptoms='$pSignsSymptoms', pPainSite='$pPainSite' WHERE caseno='$caseno'";
      mysqli_query($conncf4,"UPDATE `subjective` SET `pOtherComplaint`='$pCf4OtherSymptoms', `pSignsSymptoms`='$pSignsSymptoms', `pPainSite`='$pPainSite' WHERE `caseno`='$caseno'");

echo "
  <span class='arial16bluebold'>Entries updated...</span>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='1;URL=?cf4p3&caseno=$caseno'>";
    }
  }
  else{
echo "
  <span class='arial16redbold'>Pain site must not be blank!!!</span>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=?cf4p2&caseno=$caseno'>";
  }
}
?>
</body>
</html>
