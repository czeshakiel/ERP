<?php
$capital=$uc;
$opdfixprice=$sopd;
$sellingpricereceiving=$spr;
$lotno=$lot;

$spca=$opd;
$spch=$phi;

//CASH---------------------------------
  if($trantype=="cash"){
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
  }
//-------------------------------------

//CHARGE-------------------------------
  else if($trantype=="charge"){
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
  }
//-------------------------------------

    //MDRP---------------------------------------------------------------------
    if(($code=="kmsci-34-m-3952118-15-p")||($code=="kmsci-34-m-3955031-15-p")||($code=="kmsci-34-m-3954326-15-p")||($code=="kmsci-34-m-3951769-15-p")||($code=="kmsci-34-m-3952171-15-p")||($code=="kmsci-34-m-3951369-15-p")||($code=="kmsci-34-m-210409155707-15-n")||($code=="kmsci-34-m-3952235-15-p")||($code=="kmsci-34-m-3952079-15-p")||($code=="kmsci-34-m-3952078-15-p")||($code=="kmsci-34-m-3952297-15-p")||($code=="kmsci-34-m-3952298-15-p")||($code=="kmsci-34-m-210224163642-15-p")||($code=="0003067p-32")||($code=="0003807p-32")||($code=="0003012p-32")||($code=="kmsci-34-m-3954310-15-p")||($code=="kmsci-34-m-3951945-15-p")||($code=="kmsci-34-m-3951824-15-p")||($code=="kmsci-34-m-210415102247-15-p")||($code=="kmsci-34-m-210511125339-15-p")){
      $adj=0;
    }
    //-------------------------------------------------------------------------

    //NEW MDRP-----------------------------------------------------------------
    $kmdsql=mysqli_query($mycon1,"SELECT `testcode` FROM `receiving` WHERE `code`='$code'");
    $kmdfetch=mysqli_fetch_array($kmdsql);
    $testcode=$kmdfetch['testcode'];

    if($testcode=="1"){
      $adj=0;
      //if($senior=="Y"){$adj=($sellingprice*$quanti)*0.2;}
    }
    //-------------------------------------------------------------------------


    //NON VAT MEDS-------------------------------------------------------------
    if(($code=="kmsci-34-m-3954049-15-p")){
      if($senior=="Y"){$adj=($sellingprice*$quanti)*0.2;}
    }
    //-------------------------------------------------------------------------

    $price=$sellingprice;

    $adjustment=$adj;
    $gross=($price*$quanti)-$adjustment;
    $phic1=0;
    $phic2=0;

    //if(($hmomembership=="hmo-hmo")||($hmomembership=="hmo-company")){if(($hmgross+$gross)>$policyno){$hm=0;$ex=$gross;}else{$hm=$gross;$ex=0;}}
    //else{
    $hm=0;$ex=$gross;
    //}

    $hmo=$hm;
    $excess=$ex;
?>
