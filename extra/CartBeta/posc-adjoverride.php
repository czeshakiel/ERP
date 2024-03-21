<?php
//ANNIVERSARY PROMO 2022-04-01 to 2022-04-15---------------------------------------------------------------------------------------------------------
if(($itmcode!="210901082034p-3")&&($itmcode!="210823152208p-3")&&($itmcode!="210519084140p-3")&&($itmcode!="210330142232p-3")&&($itmcode!="210407140138p-3")&&($itmcode!="210330142303p-3")&&($itmcode!="210901082006p-3")&&($itmcode!="210804162541p-3")&&($itmcode!="210407140432p-3")&&($itmcode!="210916093805p-3")&&($itmcode!="210916093934p-3")&&($itmcode!="210916083459p-3")&&($itmcode!="210916093831p-3")&&($itmcode!="L157p-3")&&($itmcode!="L85p-3")&&($itmcode!="210712165825p-3")&&($itmcode!="L84p-3")&&($itmcode!="L80p-3")&&($itmcode!="L33p-3")&&($itmcode!="L33p-3")&&($itmcode!="1000554n-3")&&($itmcode!="L79p-3")&&($itmcode!="10007026p-3")&&($itmcode!="0004137p-32")&&($itmcode!="2081004p-23") &&($itmcode!="10007314p-13")){
  $knowdate=date("Ymd");
  if(stripos($caseno, "W-") !== FALSE){
    if($trantype=="cash"){
      if(($itmtype=="LABORATORY")||($itmtype=="ECG")||($itmtype=="CT SCAN")||($itmtype=="HEARTSTATION")||($itmtype=="RESPIRATORY")||($itmtype=="ULTRASOUND")||($itmtype=="XRAY")){
        if(($knowdate>"20220331")&&($knowdate<"20220501")){
          if($sn=="Y"){
            $padinfsql=mysqli_query($conn,"SELECT `discounttype` FROM `patientprofileaddinfo` WHERE `patientidno`='$patientidno'");
            $padinfcount=mysqli_num_rows($padinfsql);
            if($padinfcount>0){
              $padinffetch=mysqli_fetch_array($padinfsql);
              $discounttype=$padinffetch['discounttype'];
            }
            else{
              $discounttype="";
            }

            if($discounttype=="PWD"){
              $adjustment1=($sp*$itmqty)*0.20;
              $adjustment=round(($adjustment1),2);
            }
            else{
              $adjustment1=($sp*$itmqty)*0.20;
              $adjustment2=(($sp*$itmqty)-$adjustment1)*0.10;
              $adjustment=round(($adjustment1+$adjustment2),2);
            }
          }
          else if($sn=="N"){
            $adjustment=round((($sp*$itmqty)*0.20),2);
          }
          else{
            $adjustment=0;
          }
        }
      }
    }
  }
}
//END ANNIVERSARY PROMO------------------------------------------------------------------------------------------------------------------------------

//CT SCAN PROMO--------------------------------------------------------------------------------------------------------------------------------------
  $datel=date("Ymd");
  $ifwend=date("D");
  if($itmtype=="CT SCAN"){
    if($trantype=="cash"){
      if($datel<"20221101"){
        if(($ifwend=="Sun")||($ifwend=="Sat")){
        }
        else{
          if($sn!="Y"){
            $nowtime="1".date("Hi");
            if(($nowtime>="10600")&&($nowtime<="10800")){
              $adjustment=round((($sp*$itmqty)*0.10),2);
            }
            if(($nowtime>="11800")&&($nowtime<="12000")){
              $adjustment=round((($sp*$itmqty)*0.10),2);
            }
          }
        }
      }
    }
  }
//END CT SCAN PROMO----------------------------------------------------------------------------------------------------------------------------------

//Start HMO Senior/PWD 0 Discount--------------------------------------------------------------------------------------------------------------------
if((stripos($caseno, "AR-") !== FALSE)&&($comsp==1)&&($comscpwd==0)){
  if($sn=="Y"){
    $adjustment=0;
    $itmaddons="HMO: NO DISCOUNT";
  }
}
//End HMO Senior/PWD 0 Discount----------------------------------------------------------------------------------------------------------------------

//PACKAGE--------------------------------------------------------------------------------------------------------------------------------------------
if($ct=="pck"){
  $sp=mysqli_real_escape_string($conn,$_GET['sprel']);
  $adjustment=mysqli_real_escape_string($conn,$_GET['itd']);
}
//END PACKAGE----------------------------------------------------------------------------------------------------------------------------------------
?>
