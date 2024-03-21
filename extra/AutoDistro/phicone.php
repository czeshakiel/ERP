<?php
  $cmd="AND productsubtype NOT LIKE 'PROFESSIONAL FEE' AND productsubtype NOT LIKE 'ROOM ACCOMODATION' AND productsubtype NOT LIKE 'LABORATORY' AND productsubtype NOT LIKE 'XRAY' AND productsubtype NOT LIKE 'CT SCAN' AND productsubtype NOT LIKE 'ULTRASOUND' AND productsubtype NOT LIKE 'EEG' AND productsubtype NOT LIKE 'ECG' AND productsubtype NOT LIKE 'HEARTSTATION' ";
  echo "<br />";

  if((stripos($caseno, "R-") !== FALSE)||(stripos($caseno, "WD-") !== FALSE)){
    $dptbl="distropriorityrdu";

//PROFESSIONAL FEE---------------------------------------------------------------------------------------------------------------
  $no=0;
  $rmsql=mysql_query("SELECT * FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype='PROFESSIONAL FEE' AND gross > 0 ORDER BY datearray ASC");
  $rmcount=mysql_num_rows($rmsql);

  if($rmcount>0){
    $rmfetch=mysql_fetch_array($rmsql);
    $refno=$rmfetch['refno'];
    $code=$rmfetch['productcode'];
    $desc=$rmfetch['productdesc'];
    $sp=$rmfetch['sellingprice'];
    $qty=$rmfetch['quantity'];
    $adj=$rmfetch['adjustment'];
    $gross=$rmfetch['excess'];
    $productsubtype=$rmfetch['productsubtype'];
    $no++;

    echo $no." --> ".$desc." --> ".$sp." | ".$qty." | ".$adj." | ".$gross." --> ";

    $newgross=$gross-350;
    echo $fcnewhs." P: ".$newphic." E: ".$newgross."<br />";
    mysql_query("UPDATE `productout` SET phic='350', excess='0' WHERE refno='$refno'");

  }

  //$fcnewhs-=350;
//-------------------------------------------------------------------------------------------------------------------------------

  }
  else{
    $dptbl="distropriority";

//ROOM---------------------------------------------------------------------------------------------------------------------------
  $no=0;
  $rmsql=mysql_query("SELECT * FROM productout WHERE caseno='$caseno' AND trantype='charge' AND productsubtype='ROOM ACCOMODATION' AND gross > 0 ORDER BY quantity ASC");
  $rmcount=mysql_num_rows($rmsql);

  if($rmcount>0){
    //$fcroom=$nodays*500;

    while($rmfetch=mysql_fetch_array($rmsql)){
      $refno=$rmfetch['refno'];
      $code=$rmfetch['productcode'];
      $desc=$rmfetch['productdesc'];
      $sp=$rmfetch['sellingprice'];
      $qty=$rmfetch['quantity'];
      $adj=$rmfetch['adjustment'];
      $gross=$rmfetch['excess'];
      $productsubtype=$rmfetch['productsubtype'];
      $no++;

      $fcroom=$qty*500;

      echo $no." --> ".$desc." --> ".$sp." | ".$qty." | ".$adj." | ".$gross." --> ";

      $newgross=$gross-$fcroom;
      echo $fcnewhs." P: ".$newphic." E: ".$newgross."<br />";
      mysql_query("UPDATE `productout` SET phic='$fcroom', excess='$newgross' WHERE refno='$refno'");

      $fcnewhs-=$fcroom;
    }

  }

//-------------------------------------------------------------------------------------------------------------------------------
  }


  $dpsql=mysql_query("SELECT `type`, `availment` FROM $dptbl ORDER BY CAST(no AS UNSIGNED)");
  while($dpfetch=mysql_fetch_array($dpsql)){
    $type=$dpfetch['type'];
    $availment=$dpfetch['availment'];

    $dpno=0;
    $dpposql=mysql_query("SELECT * FROM productout WHERE caseno='$caseno' AND trantype='charge' AND excess > 0 AND productsubtype='$type'");
    $dppocount=mysql_num_rows($dpposql);
    if($dppocount>0){
      echo $type."<br />";
      while($dppofetch=mysql_fetch_array($dpposql)){
        $dprefno=$dppofetch['refno'];
        $dpcode=$dppofetch['productcode'];
        $dpdesc=$dppofetch['productdesc'];
        $dpsp=$dppofetch['sellingprice'];
        $dpqty=$dppofetch['quantity'];
        $dpadj=$dppofetch['adjustment'];
        $dpgross=$dppofetch['excess'];
        $dpno++;

        if(($type=="PHARMACY/MEDICINE")||($type=="PHARMACY/SUPPLIES")){
          $kpnfsql=mysql_query("SELECT * FROM receiving WHERE code='$dpcode' AND (pnf='NON-PNDF' OR pnf='NPNDF')");
          $kpnfcount=mysql_num_rows($kpnfsql);
          if($kpnfcount!=0){$go="no";}
          else{$go="yes";}
        }
        else{
          $go="yes";
        }
//-------------------------------------------------------------------------------------------------------------------------------
        if($go=="yes"){
          echo $dpno." --> ".$dpdesc." --> ".$dpsp." | ".$dpqty." | ".$dpadj." | ".$dpgross." --> ";

          if($fcnewhs!=0){
            if($fcnewhs>$dpgross){
              $fcnewhs-=$dpgross;
              echo $fcnewhs."<br />";
              mysql_query("UPDATE `productout` SET phic='$dpgross', excess='0' WHERE refno='$dprefno'");
            }
            else if($fcnewhs<$dpgross){
              $newphic=$fcnewhs;
              $newdpgross=$dpgross-$fcnewhs;
              $fcnewhs=0;
              echo $fcnewhs." P: ".$newphic." E: ".$newdpgross."<br />";
              mysql_query("UPDATE `productout` SET phic='$newphic', excess='$newdpgross' WHERE refno='$dprefno'");
            }
          }
          else if($fcnewhs==0){
            echo "Excess<br />";
          }
        }
//-------------------------------------------------------------------------------------------------------------------------------
      }
      echo "<br />";
    }

    $cmd=$cmd."AND productsubtype NOT LIKE '$type' ";
  }
  echo "<br /><br />";
  $no=0;
  $posql=mysql_query("SELECT * FROM productout WHERE caseno='$caseno' AND trantype='charge' AND gross > 0 $cmd ORDER BY datearray");
  while($pofetch=mysql_fetch_array($posql)){
    $refno=$pofetch['refno'];
    $code=$pofetch['productcode'];
    $desc=$pofetch['productdesc'];
    $sp=$pofetch['sellingprice'];
    $qty=$pofetch['quantity'];
    $adj=$pofetch['adjustment'];
    $gross=$pofetch['excess'];
    $productsubtype=$pofetch['productsubtype'];
    $no++;

    if(($productsubtype=="PHARMACY/MEDICINE")||($productsubtype=="PHARMACY/SUPPLIES")){
      $kpnfsql=mysql_query("SELECT * FROM receiving WHERE code='$code' AND (pnf='NON-PNDF' OR pnf='NPNDF')");
      $kpnfcount=mysql_num_rows($kpnfsql);
      if($kpnfcount!=0){$go="no";}
      else{$go="yes";}
    }
    else{
      $go="yes";
    }
//-------------------------------------------------------------------------------------------------------------------------------
    if($go=="yes"){
      echo $no." --> ".$desc." --> ".$sp." | ".$qty." | ".$adj." | ".$gross." --> ";

      if($fcnewhs!=0){
        if($fcnewhs>$gross){
          $fcnewhs-=$gross;
          echo $fcnewhs."<br />";
          mysql_query("UPDATE `productout` SET phic='$gross', excess='0' WHERE refno='$refno'");
        }
        else if($fcnewhs<$gross){
          $newphic=$fcnewhs;
          $newgross=$gross-$fcnewhs;
          $fcnewhs=0;
          echo $fcnewhs." P: ".$newphic." E: ".$newgross."<br />";
          mysql_query("UPDATE `productout` SET phic='$newphic', excess='$newgross' WHERE refno='$refno'");
        }
      }
      else if($fcnewhs==0){
        echo "Excess<br />";
      }
    }
//-------------------------------------------------------------------------------------------------------------------------------
  }
?>
