<?php
// -------------------> NEAREST TO 5 Cents --------------->>>
function sp($data){
$sp = number_format($data, 2, '.', '');
$ck = substr($sp, -1);
if(($ck==1) || ($ck==2) || ($ck==3) || ($ck==4)){$val =  (5-$ck) * 0.01;}
elseif(($ck==6) || ($ck==7) || ($ck==8) || ($ck==9)){$val =  (10-$ck) * 0.01;}
else{$val=0;}
$sp = $sp + $val;
return $sp;
}
// ---------------> END NEAREST TO 5 Cents --------------->>>

  

// -------------------------- POS PRICING ---------------------------------
function cashPOS($data){
list($producttype, $lotno, $unitcost, $fixprice, $mdrp, $qty1) = explode("||", $data);

if($lotno=="M" || $lotno==""){
$markup = 0.30;
$vat = 0.12;
$max = 0.26;
$markup1 = 1.30;
$vat1 = 1.12;
$max1 = 1.26;

$sp = $unitcost * $markup1;
$sp = $sp * 1.03;
//if($mdrp=="0"){$sp = $sp * $vat1;}
$sp = $sp * $vat1;
$sp = sp($sp);
$less = $sp * $max;
$newgross = $sp * $qty1;
$newadj = $less * $qty1;
$newnet = $newgross - $newadj;

}else{
$sp = $fixprice;
$sp = sp($sp);
$newgross = $sp * $qty1;
$newadj = 0;
$newnet = $newgross - $newadj;
}

return array ($sp, $newgross, $newadj, $newnet, $lessvat, $less);
}
// ---------------------- END POS PRICING ---------------------------------



// ------------------------AR EMP/DOC PRICING ---------------------------------
function cashPOSdoc($data){
list($producttype, $lotno, $unitcost, $fixprice, $mdrp, $qty1) = explode("||", $data);

if($lotno=="M" || $lotno==""){
$markup = 0.60;
$vat = 0.12;
$max = 0.20;
$markup1 = 1.60;
$vat1 = 1.12;
$max1 = 1.20;

$sp = $unitcost * $markup1;
$sp = sp($sp);
//if($mdrp=="0"){$sp = $sp * $vat1;}
$less = $sp * $max;
$newgross = $sp * $qty1;
$newadj = $less * $qty1;
$newnet = $newgross - $newadj;

}else{
$sp = $fixprice;
$sp = sp($sp);
$newgross = $sp * $qty1;
$newadj = 0;
$newnet = $newgross - $newadj;
}
return array ($sp, $newgross, $newadj, $newnet, $lessvat, $less);
}
// ------------------- END AR EMP/DOC PRICING ---------------------------------



// ------------------------ SENIOR CASH MED/SUP ---------------------------------
function seniorPOS($data){
list($producttype, $lotno, $unitcost, $fixprice, $mdrp, $qty1) = explode("||", $data);

if($lotno=="M" || $lotno==""){
$markup = 0.30;
$vat = 0.12;
$max = 0.20;
$markup1 = 1.30;
$vat1 = 1.12;
$max1 = 1.20;
$sp = $unitcost * $markup1;
$sp = $sp * 1.03;
if($mdrp=="0"){
$sp = $sp * $vat1;
$sp = sp($sp);
$splessvat = $sp / $vat1;
if($producttype!="PHARMACY/MEDICINE"){$splessvat = $sp;}
$lessvat = $sp - $splessvat;
$less = $splessvat * $max;
$less2 = $less + $lessvat;
$newgross = $splessvat * $qty1;
}else{
$sp = sp($sp);
$less = $sp * $max;
$less2 = $sp * $max;
$newgross = $sp * $qty1;
}

$newadj = $less2 * $qty1;
$newadj2 = $less * $qty1;
$newnet = $newgross - $newadj2;
$checkm = "MARKUP";
}

else{
$sp = $fixprice;
$sp = sp($sp);
$max = 0.20;
$vat1 = 1.12;


if($mdrp=="0"){
$splessvat = $sp / $vat1;
if($producttype!="PHARMACY/MEDICINE"){$splessvat = $sp;}
$lessvat = $sp - $splessvat;
$less = $splessvat * $max;
$less2 = $less + $lessvat;
$newgross = $splessvat * $qty1;
}else{
$less = $sp * $max;
$less2 = $sp * $max;
$newgross = $sp * $qty1;
}

$newadj = $less2 * $qty1;
$newadj2 = $less * $qty1;
$newnet = $newgross - $newadj2;
$checkm = "FIXED";
}

return array ($sp, $newgross, $newadj, $newnet, $lessvat, $less);
}
// -------------------- END SENIOR CASH MED/SUP ---------------------------------
?>