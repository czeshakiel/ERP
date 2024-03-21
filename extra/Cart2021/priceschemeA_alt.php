<?php
$capital=$uc;
$opdfixprice=$sopd;
$sellingpricereceiving=$spr;
$lotno=$lot;

$spca=$opd;
$spch=$phi;

//CASH---------------------------------
    if(stripos($lotno, "S") !== FALSE){
      $sellingprice=$spca;

      if($senior=="N"){$adj=0;}
      else if($senior=="Y"){
        if(($unit=="PHARMACY/SUPPLIES")||($unit=="MEDICAL SURGICAL SUPPLIES")||($unit=="RDU SUPPLIES")||($unit=="RDU-SUPPLIES")||($unit=="NONMEDICAL SUPPLIES")||($unit=="RDU-MEDICINE")){
          $adj=($sellingprice*$quanti)*0.20;
        }
        else{
          $adj1=($sellingprice*$quanti)/1.12;
          $adj2=($sellingprice*$quanti)-$adj1;
          $adj=$adj2+($adj1*0.20);
        }
      }
      else{$adj=0;}
    }
    else{
      $sp1=$uc + ($uc*0.30);
      $sellingprice=$sp1+($sp1*0.12);

      if($senior=="N"){$adj=($sellingprice*$quanti)*0.26;}
      else if($senior=="Y"){
        if(($unit=="PHARMACY/SUPPLIES")||($unit=="MEDICAL SURGICAL SUPPLIES")||($unit=="RDU SUPPLIES")||($unit=="RDU-SUPPLIES")||($unit=="NONMEDICAL SUPPLIES")||($unit=="RDU-MEDICINE")){
          $adj=($sellingprice*$quanti)*0.20;
        }
        else{
          $adj1=($sellingprice*$quanti)/1.12;
          $adj2=($sellingprice*$quanti)-$adj1;
          $adj=$adj2+($adj1*0.20);
        }
      }
      else{$adj=($sellingprice*$quanti)*0.26;}
    }
//-------------------------------------

$spcash=$sellingprice;
if(($senior=="Y")&&($unit=="PHARMACY/MEDICINE")){
  $kmdsql=mysqli_query($mycon1,"SELECT `testcode` FROM `receiving` WHERE `code`='$code'");
  $kmdfetch=mysqli_fetch_array($kmdsql);
  $testcode=$kmdfetch['testcode'];

  if($testcode=="1"){
    $adj=0;
    if($senior=="Y"){$adj=($sellingprice*$quanti)*0.2;}
  }
  else{
    $adj1=($sellingprice*$quanti)/1.12;
    $adj2=($sellingprice*$quanti)-$adj1;
    $adj=$adj2+($adj1*0.20);
  }
}
else{
  $adj=0;
}

$cag=$sellingprice*$quanti;
$cad=$adj;

//CHARGE-------------------------------
    if(stripos($lotno, "S") !== FALSE){
      $sellingprice=$spch;

      if($senior=="N"){$adj=0;}
      else if($senior=="Y"){$adj=($sellingprice*$quanti)*0.20;}
      else{$adj=0;}
    }
    else{
      //if(stripos($hmomembership, "hmo") !== FALSE){
        //$sellingprice=($uc+($uc*0.60))+(($uc+($uc*0.60))*0.12);

        //if($senior=="N"){$adj=0;}
        //else if($senior=="Y"){$adj=($sellingprice*$quanti)*0.20;}
        //else{$adj=0;}
      //}
      //else{
        $sellingprice=($uc+($uc*0.70));

        if($senior=="N"){$adj=0;}
        else if($senior=="Y"){$adj=($sellingprice*$quanti)*0.20;}
        else{$adj=0;}
      //}
    }
//-------------------------------------

$spcharge=$sellingprice;

?>
