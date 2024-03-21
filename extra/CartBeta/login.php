<?php
if(isset($_POST['login'])){
  $spsw=mysqli_real_escape_string($conn,$_POST['spsw']);

  if(isset($_POST['susr'])){
    $susr=mysqli_real_escape_string($conn,$_POST['susr']);

    $asql=mysqli_query($conn,"SELECT * FROM `nsauth` WHERE `username`='$susr' AND `password`='$spsw' AND `station`='$dept'");
    if(mysqli_num_rows($asql)>0){
      $afetch=mysqli_fetch_array($asql);
      $_SESSION['cun']=base64_encode($susr);
      $_SESSION['cpw']=base64_encode($spsw);
      $_SESSION['cac']=base64_encode($afetch['Access']);
      $_SESSION['cnm']=base64_encode($afetch['name']);

      unset($_SESSION['lerr']);

      $four=preg_split("/\&/",$aa[4]);

      if(isset($_GET['tick'])){
        $tick=mysqli_real_escape_string($conn,$_GET['tick']);
        $reptk="&tick=$tick";
      }
      else{
        $tick="AXD-".date("YmdHis").rand(1000,9999);
        if($ct=="sot"){$tick="LXD-".date("YmdHis").rand(1000,9999);}
        else if($ct=="sot-lab"){$tick="LXD-".date("YmdHis").rand(1000,9999);}
        else if($ct=="phm"){$tick="PHARMACY-".date("YmdHis").rand(1000,9999);}
        else if($ct=="phs"){$tick="CSR2-".date("YmdHis").rand(1000,9999);}
        else if($ct=="eca"){$tick="$dept-".date("YmdHis").rand(1000,9999);}
        $reptk="&tick=$tick";
      }

      echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=../$aa[3]/".str_replace("&user=$susr","",str_replace("$reptk","",str_replace("&$four[3]","",$aa[4])))."&user=$susr&tick=$tick'>";
    }
    else{
      $_SESSION['lerr']=base64_encode("<br /><span style='padding-top: 5px;color: #FF0000;font-size: 12px;font-weight: bold;'>Log-in Failed!!! Try again!!!</span>");
    }
  }
  else{
    $asql=mysqli_query($conn,"SELECT * FROM `nsauth` WHERE `username`='$user' AND `password`='$spsw' AND `station`='$dept'");
    if(mysqli_num_rows($asql)>0){
      $afetch=mysqli_fetch_array($asql);
      $_SESSION['cun']=base64_encode($user);
      $_SESSION['cpw']=base64_encode($spsw);
      $_SESSION['cac']=base64_encode($afetch['Access']);
      $_SESSION['cnm']=base64_encode($afetch['name']);

      unset($_SESSION['lerr']);

      $four=preg_split("/\&/",$aa[4]);

      if(isset($_GET['tick'])){
        $tick=mysqli_real_escape_string($conn,$_GET['tick']);
        $reptk="&tick=$tick";
      }
      else{
        $tick="AXD-".date("YmdHis").rand(1000,9999);
        if($ct=="sot"){$tick="LXD-".date("YmdHis").rand(1000,9999);}
        else if($ct=="sot-lab"){$tick="LXD-".date("YmdHis").rand(1000,9999);}
        else if($ct=="phm"){$tick="PHARMACY-".date("YmdHis").rand(1000,9999);}
        else if($ct=="phs"){$tick="CSR2-".date("YmdHis").rand(1000,9999);}
        else if($ct=="eca"){$tick="$dept-".date("YmdHis").rand(1000,9999);}
        $reptk="&tick=$tick";
      }

      echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=../$aa[3]/".str_replace("&user=$user","",str_replace("$reptk","",str_replace("&$four[3]","",$aa[4])))."&user=$user&tick=$tick'>";
    }
    else{
      $_SESSION['lerr']=base64_encode("<br/><span style='padding-top: 5px;color: #FF0000;font-size: 12px;font-weight: bold;'>Log-in Failed!!! Try again!!!</span>");
    }
  }
}

//-------------------------------------------------------------------------------------------------
if((isset($_SESSION['cun']))&&(isset($_SESSION['cpw']))&&(isset($_SESSION['cnm']))){
  if(isset($_POST['addchrmks'])){
    $shwpu="";$seon="2";
    $cnm=base64_decode($_SESSION['cnm']);
  }
  else{
    if(isset($_POST['addch'])){
      $shwpu="";$seon="3";
      $cnm=base64_decode($_SESSION['cnm']);
    }
    else{
      if(isset($_GET['itmd'])){
        $shwpu="";$seon="4";
      }
      else{
        if(isset($_GET['edrmk'])){
          $shwpu="";$seon="5";
        }
        else{
          if(isset($_POST['srmk'])){
            $shwpu="";$seon="6";
          }
          else{
            if(isset($_POST['finalized'])){
              $shwpu="";$seon="7";
            }
            else{
              if(isset($_GET['unf'])){
                $shwpu="";$seon="8";
              }
              else{
                if(isset($_POST['addphms'])){
                  $shwpu="";$seon="9";
                }
                else{
                  if(isset($_POST['oncall'])){
                    $shwpu="";$seon="10";
                  }
                  else{
                    $shwpu="";$seon="1";
                  }
                }
              }
            }
          }
        }
      }
    }
  }
}
else{
  $shwpu="onload='openlin()'";$seon="0";
}
//-------------------------------------------------------------------------------------------------

if(!isset($_SESSION['cnm'])){
  $zsql=mysqli_query($conn,"SELECT `name` FROM `nsauth` WHERE `station`='$dept' AND `username`='$user'");
  if(mysqli_num_rows($zsql)>0){
    $zfetch=mysqli_fetch_array($zsql);
    $snm=mb_strtoupper($zfetch['name']);
  }
  else{
    $shwpu="onload='openlin()'";$seon="0";
    unset($_SESSION['cnm']);
    echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=../$aa[3]/$aa[4]&chu'>";
  }
}
else{
  if((trim($_SESSION['cnm'])=="")&&(!isset($_GET['chu']))){
    echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=../$aa[3]/$aa[4]&chu'>";
  }
  else{
    $snm=mb_strtoupper(base64_decode($_SESSION['cnm']));
  }
}
?>
