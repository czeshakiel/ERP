<?php
  // ----------------- Arvid 04-12-2021 -------------------------------------
  
  $checker = 0;
  if($code=="110002025p-3"){ /*Stool Exam */ $searchcode="0003012p-32"; /* Stool Container */ $checker="1";}
  if($code=="L197p-3"){ /* URINALYSIS */ $searchcode="0003067p-32"; /* URINE CUP */ $checker="1";} 
   
   
  if($checker > 0) {
	  
  echo"<script>alert('Perform Includes....');</script>";  
  $zsql=mysqli_query($mycon1,"SELECT * FROM receiving WHERE code='$searchcode'");
  $zfetch=mysqli_fetch_array($zsql);
  $code1=$zfetch['code'];
  $itemname1=$zfetch['description'];
  $lotno=$zfetch['lotno'];
  $qty = "1";
  
  $zsqll=mysqli_query($mycon1,"SELECT * FROM productsmasterlist WHERE code='$searchcode'");
  $zfetchl=mysqli_fetch_array($zsqll);
  $spca=$zfetchl['nonmed'];
  $spch=$zfetchl['philhealth'];
  
  
  //CASH---------------------------------
  if($trantype=="cash"){
    if(stripos($lotno, "S") !== FALSE){
      $sellingprice=$spca;

      if($senior=="N"){$adj=0;}
      else if($senior=="Y"){
        $adj1=($sellingprice*$quanti)/1.12;
        $adj2=($sellingprice*$quanti)-$adj1;
        $adj=$adj2+($adj1*0.20);
      }
      else{$adj=0;}
    }
    else{
      $sp1=$uc + ($uc*0.30);
      $sellingprice=$sp1+($sp1*0.12);

      if($senior=="N"){$adj=($sellingprice*$quanti)*0.26;}
      else if($senior=="Y"){
        $adj1=($sellingprice*$quanti)/1.12;
        $adj2=($sellingprice*$quanti)-$adj1;
        $adj=$adj2+($adj1*0.20);
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
  
	$price=$sellingprice;
    $adjustment=$adj;
    $gross=($price*$quanti)-$adjustment;
    $phic1=0;
    $phic2=0;
	$hmo=$hm;
    $excess=$ex;
//-------------------------------------
  
  
  
  
  mysqli_query($mycon1,"INSERT INTO `productout`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`,
  `adjustment`, `gross`, `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`,
  `productsubtype`, `approvalno`, `referenceno`, `administration`, `shift`, `location`, `datearray`, `phic1`) VALUES ('$refno', '$invno',
  '$caseno', '$code1', '$itemname1', '$sp', '$qty', '$adjustment', '$gross', '$trantype', '0', '0', '$gross', '$pdate', '$status', 'pending',
  '$ccname', '$tick', '', '$unit', '', '', '', 'NEW', 'CASHIER', '".date("Y-m-d")."', '0')");
  }
  
  
  // ------------------------------------------------------------------------ 

?>