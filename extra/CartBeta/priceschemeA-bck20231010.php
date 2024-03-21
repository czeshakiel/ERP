<?php
$capital=$uc;
$opdfixprice=$sopd;
$sellingpricereceiving=$spr;
$lotno=$lot;

$spca=$opd;
$spch=$phi;

$cssp=preg_split("/\-/",$caseno);
$csfmt=$cssp[0];

if(($csfmt=="R")||($csfmt=="WD")){
  $senior="Y";
}

$cvat=0;
$cdisc=0;
$wvat="N";
$scpwd=$senior;
$rmks="";
$addons="";

$kmdsql=mysqli_query($conn,"SELECT `testcode` FROM `receiving` WHERE `code`='$code'");
$kmdfetch=mysqli_fetch_array($kmdsql);
$testcode=$kmdfetch['testcode'];

//CASH---------------------------------
  if($trantype=="cash"){
    if(stripos($lotno, "S") !== FALSE){
      $sellingprice=$spca;

      if($senior=="N"){$adj=0;}
      else if($senior=="Y"){
        if(($unit=="PHARMACY/SUPPLIES")||($unit=="MEDICAL SURGICAL SUPPLIES")||($unit=="RDU SUPPLIES")||($unit=="RDU-SUPPLIES")||($unit=="NONMEDICAL SUPPLIES")||($unit=="RDU-MEDICINE")){
          $adj=($sellingprice*$quanti)*0.20;

          $cvat=0;
          $cdisc=$adj;
          $rmks="";
        }
        else{
          $adj1=($sellingprice*$quanti)/1.12;
          $adj2=($sellingprice*$quanti)-$adj1;
          $adj=$adj2+($adj1*0.20);

          $cvat=$adj2;
          $cdisc=($adj1*0.20);
          $wvat="Y";
          $rmks="";
        }
      }
      else{$adj=0;}
    }
    else{
      $sp1=$uc + ($uc*0.30);
      $sellingprice=$sp1+($sp1*0.12);

      //PRICE ADJUSTMENT 2022-06-22 UPDATED--------------------------------------------------------
      $cash=$sp1+($sp1*0.12);
      $cashr=number_format($cash,2);
      $cashr=str_replace(",","",$cashr);
      $cashstr=substr($cashr, -1);

      if(($cashstr=="1")||($cashstr=="2")||($cashstr=="3")||($cashstr=="4")){
        $cashadd=(5-$cashstr)*0.01;
      }
      else if(($cashstr=="6")||($cashstr=="7")||($cashstr=="8")||($cashstr=="9")){
        $cashadd=(10-$cashstr)*0.01;
      }
      else{
        $cashadd=0;
      }

      $sellingprice=$cashr+$cashadd;
      //-------------------------------------------------------------------------------------------

      if($testcode=="0"){
      //Mark-up Price Percent Add-on---------------------------------------------------------------
        $mupaddsql=mysqli_query($conn,"SELECT `addon` FROM `markupaddon` WHERE `status`='1' ORDER BY CAST(`sort` AS UNSIGNED)");
        while($mupaddfetch=mysqli_fetch_array($mupaddsql)){
          $addonperc=$mupaddfetch['addon'];

          $addsp=$sellingprice+($sellingprice*$addonperc);

          $cashr=number_format($addsp,2);
          $cashr=str_replace(",","",$cashr);
          $cashstr=substr($cashr, -1);

          if(($cashstr=="1")||($cashstr=="2")||($cashstr=="3")||($cashstr=="4")){
            $cashadd=(5-$cashstr)*0.01;
          }
          else if(($cashstr=="6")||($cashstr=="7")||($cashstr=="8")||($cashstr=="9")){
            $cashadd=(10-$cashstr)*0.01;
          }
          else{
           $cashadd=0;
          }

          $sellingprice=$cashr+$cashadd;
        }
      //-------------------------------------------------------------------------------------------
      }

      if($senior=="N"){
        $adj=($sellingprice*$quanti)*0.26;
        $cdisc=$adj;
        $rmks="26% Discount";
      }
      else if($senior=="Y"){
        if(($unit=="PHARMACY/SUPPLIES")||($unit=="MEDICAL SURGICAL SUPPLIES")||($unit=="RDU SUPPLIES")||($unit=="RDU-SUPPLIES")||($unit=="NONMEDICAL SUPPLIES")||($unit=="RDU-MEDICINE")){
          $adj=($sellingprice*$quanti)*0.20;

          $cvat=0;
          $cdisc=$adj;
          $rmks="";
        }
        else{
          $adj1=($sellingprice*$quanti)/1.12;
          $adj2=($sellingprice*$quanti)-$adj1;
          $adj=$adj2+($adj1*0.20);

          $cvat=$adj2;
          $cdisc=($adj1*0.20);
          $wvat="Y";
          $rmks="";
        }
      }
      else{
        $adj=($sellingprice*$quanti)*0.26;
        $cdisc=$adj;
        $rmks="26% Discount";
      }
    }
  }
//-------------------------------------

//CHARGE-------------------------------
  else if($trantype=="charge"){
    if(($aem=="DSWD")||($aem=="DOH")||($aem=="EDC")||($aem=="EMCOR")||($aem=="PCSO")||($aem=="PROVINCE")||($aem=="COSUCECO")){
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

//PRICE ADJUSTMENT 2022-06-22 UPDATED--------------------------------------------------------------
        $cash=$sp1+($sp1*0.12);
        $cashr=number_format($cash,2);
        $cashr=str_replace(",","",$cashr);
        $cashstr=substr($cashr, -1);

        if(($cashstr=="1")||($cashstr=="2")||($cashstr=="3")||($cashstr=="4")){
          $cashadd=(5-$cashstr)*0.01;
        }
        else if(($cashstr=="6")||($cashstr=="7")||($cashstr=="8")||($cashstr=="9")){
          $cashadd=(10-$cashstr)*0.01;
        }
        else{
          $cashadd=0;
        }

        $sellingprice=$cashr+$cashadd;
//-------------------------------------------------------------------------------------------------

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
    else{
      if(stripos($lotno, "S") !== FALSE){
        $sellingprice=$spch;

        if($senior=="N"){$adj=0;}
        else if($senior=="Y"){$adj=($sellingprice*$quanti)*0.20;}
        else{$adj=0;}
      }
      else{
        $sellingprice=($uc+($uc*0.70));

//PRICE ADJUSTMENT 2022-06-22 UPDATED--------------------------------------------------------------
        $charge=round($uc+($uc*0.70),2);
        $charge=number_format($charge,2);
        $charge=str_replace(",","",$charge);
        //echo "<br /><br />PRICE: ".$charge."<br />";
        $charge4=($charge+($charge*0.04));
        $charger=number_format($charge4,2);
        $charger=str_replace(",","",$charger);
        $chargestr=substr($charger, -1);

        if(($chargestr=="1")||($chargestr=="2")||($chargestr=="3")||($chargestr=="4")){
          $chargeadd=(5-$chargestr)*0.01;
        }
        else if(($chargestr=="6")||($chargestr=="7")||($chargestr=="8")||($chargestr=="9")){
          $chargeadd=(10-$chargestr)*0.01;
        }
        else{
          $chargeadd=0;
        }

        $sellingprice=$charger+$chargeadd;
//-------------------------------------------------------------------------------------------------

        if($senior=="N"){$adj=0;}
        else if($senior=="Y"){$adj=($sellingprice*$quanti)*0.20;}
        else{$adj=0;}
      }
    }
  }
//-------------------------------------

    //MDRP---------------------------------------------------------------------
    if(($code=="kmsci-34-m-3952118-15-p")||($code=="kmsci-34-m-3955031-15-p")||($code=="kmsci-34-m-3954326-15-p")||($code=="kmsci-34-m-3951769-15-p")||($code=="kmsci-34-m-3952171-15-p")||($code=="kmsci-34-m-3951369-15-p")||($code=="kmsci-34-m-210409155707-15-n")||($code=="kmsci-34-m-3952235-15-p")||($code=="kmsci-34-m-3952079-15-p")||($code=="kmsci-34-m-3952078-15-p")||($code=="kmsci-34-m-3952297-15-p")||($code=="kmsci-34-m-3952298-15-p")||($code=="kmsci-34-m-210224163642-15-p")||($code=="0003067p-32")||($code=="0003807p-32")||($code=="0003012p-32")||($code=="kmsci-34-m-3954310-15-p")||($code=="kmsci-34-m-3951945-15-p")||($code=="kmsci-34-m-3951824-15-p")||($code=="kmsci-34-m-210415102247-15-p")||($code=="kmsci-34-m-210511125339-15-p")){
      $adj=0;

      $cvat=$adj2;
      $wvat="N";
      $cdisc=($adj1*0.20);
      $rmks="MDRP";
    }
    //-------------------------------------------------------------------------

    //NEW MDRP-----------------------------------------------------------------
    if($testcode=="1"){
      //$adj=0;
      if($senior=="Y"){
        $adj=($sellingprice*$quanti)*0.2;

        $cvat=0;
        $wvat="N";
        $cdisc=$adj;
        $rmks="MDRP";
      }
    }
    //-------------------------------------------------------------------------

    //NON VAT MEDS-------------------------------------------------------------
    if(($code=="kmsci-34-m-3954049-15-p")){
      if($senior=="Y"){
        $adj=($sellingprice*$quanti)*0.2;

        $cvat=0;
        $wvat="N";
        $cdisc=$adj;
        $rmks="MDRP kmsci-34-m-3954049-15-p";
      }
    }
    //-------------------------------------------------------------------------

    if($toh=="PACKAGE"){
      $sellingprice=mysqli_real_escape_string($conn,$_POST['sprel']);
      $adj=mysqli_real_escape_string($conn,$_POST['itd']);

      $rmks="PACKAGE";
    }

    $price=$sellingprice;

    $adjustment=$adj;
    $gross=($price*$quanti)-$adjustment;
    $phic1=0;
    $phic2=0;

    $hm=0;$ex=$gross;

    $hmo=$hm;
    $excess=$ex;
?>
