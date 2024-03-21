<?php
  $cmd="AND productsubtype NOT LIKE 'PROFESSIONAL FEE' ";
  echo "<br />";
  $dpsql=mysql_query("SELECT `type`, `availment` FROM distropriority ORDER BY CAST(no AS UNSIGNED)");
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

        $disesql=mysql_query("SELECT * FROM distroexclude WHERE caseno='$caseno' AND code='$dpcode'");
        $disecount=mysql_num_rows($disesql);

        if($disecount==0){
          echo $dpno." --> ".$dpdesc." --> ".$dpsp." | ".$dpqty." | ".$dpadj." | ".$dpgross." --> ";

          if($fcnewhs!=0){
            if($fcnewhs>$dpgross){
              $fcnewhs-=$dpgross;
              echo $fcnewhs."<br />";
              mysql_query("UPDATE `productout` SET hmo='$dpgross', excess='0' WHERE refno='$dprefno'");
            }
            else if($fcnewhs<$dpgross){
              $newphic=$fcnewhs;
              $newdpgross=$dpgross-$fcnewhs;
              $fcnewhs=0;
              echo $fcnewhs." P: ".$newphic." E: ".$newdpgross."<br />";
              mysql_query("UPDATE `productout` SET hmo='$newphic', excess='$newdpgross' WHERE refno='$dprefno'");
            }
          }
          else if($fcnewhs==0){
            echo "Excess<br />";
          }
          echo "<br />";
        }
      }
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
    $no++;
    echo $no." --> ".$desc." --> ".$sp." | ".$qty." | ".$adj." | ".$gross." --> ";

    $disesql=mysql_query("SELECT * FROM distroexclude WHERE caseno='$caseno' AND code='$code'");
    $disecount=mysql_num_rows($disesql);

    if($disecount==0){

      if($fcnewhs!=0){
        if($fcnewhs>$gross){
          $fcnewhs-=$gross;
          echo $fcnewhs."<br />";
          mysql_query("UPDATE `productout` SET hmo='$gross', excess='0' WHERE refno='$refno'");
        }
        else if($fcnewhs<$gross){
          $newphic=$fcnewhs;
          $newgross=$gross-$fcnewhs;
          $fcnewhs=0;
          echo $fcnewhs." P: ".$newphic." E: ".$newgross."<br />";
          mysql_query("UPDATE `productout` SET hmo='$newphic', excess='$newgross' WHERE refno='$refno'");
        }
      }
      else if($fcnewhs==0){
        echo "Excess<br />";
      }
    }

  }
?>
