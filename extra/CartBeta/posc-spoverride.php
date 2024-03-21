<?php
//SUNDAY PRICE INCREASE 2021-08-21 MARK----------------------------------------
$ifsun=date("D");
if($ifsun=="Sun"){
  if(($itmcode=="210519084140p-3")||($itmcode=="210330142232p-3")){
    if((stripos($caseno, "R-") !== FALSE)||(stripos($caseno, "WD-") !== FALSE)){
      $sp=$sp;
    }
    else{
      //$sp=$sp+($sp*0.30);
      $sp=$sp;//ALTERED Jan 5, 2022 --> By Admin: PRICE ADJUSTMENT ENDED FOR SUNDAY
    }
  }
  else if(($itmcode=="210407140138p-3")||($itmcode=="210330142303p-3")||($itmcode=="210407140432p-3")){
    if((stripos($caseno, "R-") !== FALSE)||(stripos($caseno, "WD-") !== FALSE)){
      $sp=5000;
    }
    else{
      $sp=7000;
    }
  }
}
//---------------------------------------------------------------------------
?>
