<?php
//START KNOW AGE GROUP-----------------------------------------------------------------------------
$adsql=mysqli_query($conn,"SELECT `patientidno`, `ap` FROM `admission` WHERE `caseno`='$caseno'");
$adfetch=mysqli_fetch_array($adsql);
$patientidno=$adfetch['patientidno'];
$ap=$adfetch['ap'];

$ptsql=mysqli_query($conn,"SELECT `birthdate`, `dateofbirth`, `sex` FROM `patientprofile` WHERE `patientidno`='$patientidno'");
$ptcount=mysqli_num_rows($ptsql);
if($ptcount!=0){
  $ptfetch=mysqli_fetch_array($ptsql);
  $bd=date("Y-m-d", strtotime($ptfetch['dateofbirth']));
  $bd=date("Y-m-d", strtotime($ptfetch['birthdate']));
  $bdrel=$bd." 01:00:00";
  $sex=mb_strtoupper($ptfetch['sex']);
}
else{
  $bd="1990-01-01";
  $sex="M";
}

$bday=new DateTime($bd);
$ages=$bday->diff(new DateTime);

$ay=$ages->y;
$am=$ages->m;
$ad=$ages->d;

if($ay>=14){
  if($sex=="F"){
    $agro="AF";
  }
  else if($sex=="f"){
    $agro="AF";
  }
  else{
    $agro="A";
  }
}
else{
  if($ay>0){
    $agro="C";
  }
  else if($ay==0){
    if($am>0){
      $agro="C";
    }
    else{
      if($ad<29){
        $agro="N";
      }
      else{
        $agro="C";
      }
    }
  }
}
//END KNOW AGE GROUP-------------------------------------------------------------------------------
?>
