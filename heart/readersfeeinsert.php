<?php
$mysql = $conn->query("select * from productout where caseno='$caseno' and refno='$refno'");
while($myresult = $mysql->fetch_assoc()){
$mycode = $myresult['productcode'];
$mydesc = $myresult['productdesc'];
}

$mysql2 = $conn->query("select * from productsmasterlist where code='$mycode'");
while($myresult2 = $mysql2->fetch_assoc()){
$cashprice = $myresult2['opd'];
$chargeprice = $myresult2['philhealth'];
}

// ---------------------- STRESS TEST ------------------------
if(strpos("STRESS TEST", $mydesc)!==false){
$myhosp_share = 0.65;
$mypf_share = 0.35;
}
// ---------------------- STRESS TEST ------------------------

// ---------------------- 2D ECHO ------------------------
elseif(strpos("ECHO", $mydesc)!==false){
$myhosp_share = 0.60;
$mypf_share = 0.40;
}
// ---------------------- 2D ECHO ------------------------

// ---------------------- others ------------------------
else{
$myhosp_share = 0.75;
$mypf_share = 0.25;
}
// ---------------------- others ------------------------


if($trantype=="cash"){
  $myhospital = $cashprice - ($cashprice*$myhosp_share);
  $mypf = $cashprice - ($cashprice*$mypf_share);
  if($mysenior=="Y" or $mysenior=="y"){
    $myhospital = $myhospital - ($myhospital*0.20);
    $mypf = $mypf - ($mypf*0.20);  
  }
}else{
  $myhospital = $chargeprice - ($chargeprice*$myhosp_share);
  $mypf = $chargeprice - ($chargeprice*$mypf_share);
  if($mysenior=="Y" or $mysenior=="y"){
    $myhospital = $myhospital - ($myhospital*0.20);
    $mypf = $mypf - ($mypf*0.20);  
  }
}
?>