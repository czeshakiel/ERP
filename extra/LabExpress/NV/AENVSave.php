<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Saving...</title>
  <link rel="stylesheet" type="text/css" href="../../Resources/CSS/mystyle.css">
  <!-- Favicon -->
    <link rel="icon" href="../../Resources/Favicon/favicon.png" type="image/png" />
    <link rel="shortcut icon" href="../../Resources/Favicon/favicon.png" type="image/png" />

    <style>
      * {box-sizing: border-box;}
      body {font-family: Roboto, Helvetica, sans-serif;background-color: #E8E4C9;}
      /* Fix the button on the left side of the page */
      .open-btn {display: flex;justify-content: left;}
      /* Style and fix the button on the page */
      .open-button {background-color: #1c87c9;color: white;padding: 12px 20px;border: none;border-radius: 5px;cursor: pointer;opacity: 0.8;position: fixed;}
      /* Styles for the form container */
      .form-container-Edit {max-width: 500px;padding: 15px;background-color: #E8E4C9;}
      /* Full-width for input fields */
      .form-container-Edit input[type=text], .form-container-Edit input[type=number], .form-container-Edit textarea {padding: 7px;margin: 5px 0 5px 0;border: none;background: #eee;}
      /* When the inputs get focus, do something */
      .form-container-Edit input[type=text]:focus, .form-container-Edit input[type=number]:focus, .form-container-Edit select:focus, .form-container-Edit textarea:focus {background-color: #ddd;outline: none;}
      /* Style submit/login button */
      .form-container-Edit .btn {background-color: #8ebf42;color: #fff;padding: 12px 20px;border: none;cursor: pointer;margin-bottom:10px;opacity: 0.8;}
      /* Style cancel button */
      .form-container-Edit .cancel {background-color: #cc0000;}
      /* Hover effects for buttons */
      .form-container-Edit .btn:hover, .open-button:hover {opacity: 1;}
    </style>
  </head>
<body>
<?php
session_start();
ini_set("display_errors", "On");
include("../../../main/class.php");

mysqli_query($conn,'SET NAMES utf8');

$code=mysqli_real_escape_string($conn,$_POST['code']);
$testname=trim(mysqli_real_escape_string($conn,$_POST['testname']));
//$testabr=mysqli_real_escape_string($conn,$_POST['testabr']);
$testabr=$testname;
$grp=mysqli_real_escape_string($conn,$_POST['grp']);
$type=mysqli_real_escape_string($conn,$_POST['type']);
$sort=mysqli_real_escape_string($conn,$_POST['sort']);
$amll=mysqli_real_escape_string($conn,$_POST['amll']);
$amul=mysqli_real_escape_string($conn,$_POST['amul']);
$afll=mysqli_real_escape_string($conn,$_POST['afll']);
$aful=mysqli_real_escape_string($conn,$_POST['aful']);
$cll=mysqli_real_escape_string($conn,$_POST['cll']);
$cul=mysqli_real_escape_string($conn,$_POST['cul']);
$nll=mysqli_real_escape_string($conn,$_POST['nll']);
$nul=mysqli_real_escape_string($conn,$_POST['nul']);
$displaynv=mysqli_real_escape_string($conn,$_POST['displaynv']);
$unit=mysqli_real_escape_string($conn,$_POST['unit']);
$grplabel=mb_strtoupper(trim(mysqli_real_escape_string($conn,$_POST['grplabel'])));
$respos=mysqli_real_escape_string($conn,$_POST['respos']);
$rescollbl=mysqli_real_escape_string($conn,$_POST['rescollbl']);
$rescol=mysqli_real_escape_string($conn,$_POST['rescol']);
$resrowlbl=mysqli_real_escape_string($conn,$_POST['resrowlbl']);
$resrow=mysqli_real_escape_string($conn,$_POST['resrow']);

$others="";
$choices="";

$editon="";
if(isset($_POST['eon'])){
  $eon=mysqli_real_escape_string($conn,$_POST['eon']);
  if($eon=="1"){
    $eonval=mysqli_real_escape_string($conn,$_POST['eonval']);
    $editon="&eno=$eonval";
  }
}

if(isset($_POST['addot'])){
  $zb=mysqli_real_escape_string($conn,$_POST['zb']);

  $_SESSION['testname']=$testname;
  $_SESSION['testabr']=$testabr;
  $_SESSION['grp']=$grp;
  $_SESSION['type']=$type;
  $_SESSION['sort']=$sort;
  $_SESSION['unit']=$unit;
  $_SESSION['displaynv']=$displaynv;
  $_SESSION['zb']=$zb;

  for($z=1;$z<=$zb;$z++){
    $znall="agell-".$z;
    $znaul="ageul-".$z;
    $znoll="otnvll-".$z;
    $znoul="otnvul-".$z;

    if(isset($_POST[$znall])){$all=mysqli_real_escape_string($conn,$_POST[$znall]);}else{$all="";}
    if(isset($_POST[$znaul])){$aul=mysqli_real_escape_string($conn,$_POST[$znaul]);}else{$aul="";}
    if(isset($_POST[$znoll])){$oll=mysqli_real_escape_string($conn,$_POST[$znoll]);}else{$oll="";}
    if(isset($_POST[$znoul])){$oul=mysqli_real_escape_string($conn,$_POST[$znoul]);}else{$oul="";}

    $_SESSION[$znall]=$all;
    $_SESSION[$znaul]=$aul;
    $_SESSION[$znoll]=$oll;
    $_SESSION[$znoul]=$oul;

    //$others=$others."$all<>$aul<>$oll<>$oul<>|";
  }

  unset($_SESSION['zm']);
  unset($_SESSION['zn']);

  echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=AENV.php?code=$code&addot$editon'>";
}
else{
  if(isset($_POST['addot5'])){
    $zn=mysqli_real_escape_string($conn,$_POST['zn']);

    $_SESSION['testname']=$testname;
    $_SESSION['testabr']=$testabr;
    $_SESSION['grp']=$grp;
    $_SESSION['type']=$type;
    $_SESSION['sort']=$sort;
    $_SESSION['unit']=$unit;
    $_SESSION['displaynv']=$displaynv;
    $_SESSION['grpgrplabel']=$grplabel;
    $_SESSION['respos']=$respos;
    $_SESSION['zn']=$zn;

    for($z=1;$z<=$zn;$z++){
      $znlbl="lbl-".$z;
      $znoll5="otnvll5-".$z;
      $znoul5="otnvul5-".$z;

      if(isset($_POST[$znlbl])){$lbl=mysqli_real_escape_string($conn,$_POST[$znlbl]);}else{$lbl="";}
      if(isset($_POST[$znoll5])){$oll=mysqli_real_escape_string($conn,$_POST[$znoll5]);}else{$oll="";}
      if(isset($_POST[$znoul5])){$oul=mysqli_real_escape_string($conn,$_POST[$znoul5]);}else{$oul="";}

      $_SESSION[$znlbl]=$lbl;
      $_SESSION[$znoll5]=$oll;
      $_SESSION[$znoul5]=$oul;

      //$others=$others."$all<>$aul<>$oll<>$oul<>|";
    }

    unset($_SESSION['zb']);
    unset($_SESSION['zm']);

    echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=AENV.php?code=$code&addot5$editon'>";
  }
  else{
    if(isset($_POST['addch'])){
      $zm=mysqli_real_escape_string($conn,$_POST['zm']);

      $_SESSION['testname']=$testname;
      $_SESSION['testabr']=$testabr;
      $_SESSION['grp']=$grp;
      $_SESSION['type']=$type;
      $_SESSION['sort']=$sort;
      $_SESSION['unit']=$unit;
      $_SESSION['displaynv']=$displaynv;
      $_SESSION['grplabel']=$grplabel;
      $_SESSION['respos']=$respos;
      $_SESSION['rescollbl']=$rescollbl;
      $_SESSION['rescol']=$rescol;
      $_SESSION['resrowlbl']=$resrowlbl;
      $_SESSION['resrow']=$resrow;
      $_SESSION['zm']=$zm;

      for($z=1;$z<=$zm;$z++){
        $zch="ch-".$z;

        if(isset($_POST[$zch])){$ch=mysqli_real_escape_string($conn,$_POST[$zch]);}else{$ch="";}

        $_SESSION[$zch]=$ch;

        //$others=$others."$all<>$aul<>$oll<>$oul<>|";
      }

      unset($_SESSION['zb']);

      echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=AENV.php?code=$code&addch$editon'>";
    }
    else{
      $size="";
      if(isset($_POST['sizeon'])){
        $sizeval=mysqli_real_escape_string($conn,$_POST['sizeval']);
        if($sizeval==""){$sizeval="";}
        else{$size="font-size: ".$sizeval."px;";}
      }

      $weight="";
      if(isset($_POST['weighton'])){
        $weightval=mysqli_real_escape_string($conn,$_POST['weightval']);
        if($weightval=="normal"){$weigth="";}
        else if($weightval=="bold"){$weight="font-weight: $weightval;";}
      }

      $header=$size.$weight;

echo "
<div align='center'>
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='center' class='arial s16 blue bold'>Saving changes...</div></td>
    </tr>
  </table>
</div>
";

      if($grp=="2"){
        $zm=mysqli_real_escape_string($conn,$_POST['zm']);

        for($z=1;$z<=$zm;$z++){
          $zch="ch-".$z;

          if(isset($_POST[$zch])){$ch=mysqli_real_escape_string($conn,$_POST[$zch]);}else{$ch="";}

          if($ch!=""){
            $choices=$choices."$ch|";
          }
        }
      }
      else if($grp=="6"){
        $zm=mysqli_real_escape_string($conn,$_POST['zm']);

        for($z=1;$z<=$zm;$z++){
          $zch="ch-".$z;

          if(isset($_POST[$zch])){$ch=mysqli_real_escape_string($conn,$_POST[$zch]);}else{$ch="";}

          if($ch!=""){
            $choices=$choices."$ch|";
          }
        }
      }
      else if($grp=="8"){
        $zm=mysqli_real_escape_string($conn,$_POST['zm']);

        for($z=1;$z<=$zm;$z++){
          $zch="ch-".$z;

          if(isset($_POST[$zch])){$ch=mysqli_real_escape_string($conn,$_POST[$zch]);}else{$ch="";}

          if($ch!=""){
            $choices=$choices."$ch|";
          }
        }
      }
      else if($grp=="3"){
        $zb=mysqli_real_escape_string($conn,$_POST['zb']);

        for($z=1;$z<=$zb;$z++){
          $znall="agell-".$z;
          $znaul="ageul-".$z;
          $znoll="otnvll-".$z;
          $znoul="otnvul-".$z;

          if(isset($_POST[$znall])){$all=mysqli_real_escape_string($conn,$_POST[$znall]);}else{$all="";}
          if(isset($_POST[$znaul])){$aul=mysqli_real_escape_string($conn,$_POST[$znaul]);}else{$aul="";}
          if(isset($_POST[$znoll])){$oll=mysqli_real_escape_string($conn,$_POST[$znoll]);}else{$oll="";}
          if(isset($_POST[$znoul])){$oul=mysqli_real_escape_string($conn,$_POST[$znoul]);}else{$oul="";}

          if(($all!="")&&($aul!="")&&($oll!="")&&($oul!="")){
            $others=$others."$all*$aul*$oll*$oul*|";
          }
        }
      }
      else if($grp=="5"){
        $zn=mysqli_real_escape_string($conn,$_POST['zn']);

        for($z=1;$z<=$zn;$z++){
          $znlbl="lbl-".$z;
          $znoll5="otnvll5-".$z;
          $znoul5="otnvul5-".$z;

          if(isset($_POST[$znlbl])){$lbl=mysqli_real_escape_string($conn,$_POST[$znlbl]);;}else{$lbl="";}
          if(isset($_POST[$znoll5])){$oll=mysqli_real_escape_string($conn,$_POST[$znoll5]);}else{$oll="";}
          if(isset($_POST[$znoul5])){$oul=mysqli_real_escape_string($conn,$_POST[$znoul5]);}else{$oul="";}

          if(($lbl!="")&&($oll!="")&&($oul!="")){
            $others=$others."$lbl*$oll*$oul*|";
          }
        }
      }

      if(isset($_POST['eno'])){
        $eno=mysqli_real_escape_string($conn,$_POST['eno']);

        if($grp==2){$amll="";$amul="";$afll="";$aful="";$cll="";$cul="";$nll="";$nul="";$unit="";$others="";}
        else if($grp=="3"){$amll="";$amul="";$afll="";$aful="";$cll="";$cul="";$nll="";$nul="";$choices="";}
        else if($grp=="5"){$amll="";$amul="";$afll="";$aful="";$cll="";$cul="";$nll="";$nul="";$choices="";}

        if($grp==2){$othval=$choices;}
        else if($grp==3){$othval=$others;}
        else if($grp==5){$othval=$others;}
        else if($grp==6){$othval=$choices;}
        else if($grp==8){$othval=$choices;}
        else{$othval="";}

        mysqli_query($conn,"UPDATE `labnormalvalues` SET `testname`='$testname', `testabr`='$testabr', `grplabel`='$grplabel', `grp`='$grp', `sort`='$sort', `amll`='$amll', `amul`='$amul', `afll`='$afll', `aful`='$aful', `cll`='$cll', `cul`='$cul', `nll`='$nll', `nul`='$nul', `displaynv`='$displaynv', `others`='$othval', `unit`='$unit', `type`='$type', `header`='$header', `respos`='$respos', `rescol`='$rescol', `rescollbl`='$rescollbl', `resrow`='$resrow', `resrowlbl`='$resrowlbl' WHERE `no`='$eno'");
      }
      else{
        if($grp==2){$othval=$choices;}
        else if($grp==3){$othval=$others;}
        else if($grp==5){$othval=$others;}
        else if($grp==6){$othval=$choices;}
        else if($grp==8){$othval=$choices;}
        else{$othval="";}

        mysqli_query($conn,"INSERT INTO `labnormalvalues` (`code`, `testname`, `testabr`, `grplabel`, `grp`, `sort`, `amll`, `amul`, `afll`, `aful`, `cll`, `cul`, `nll`, `nul`, `displaynv`, `others`, `unit`, `type`, `header`, `respos`, `line`, `stat`, `rescol`, `rescollbl`, `resrow`, `resrowlbl`) VALUES ('$code', '$testname', '$testabr', '$grplabel', '$grp', '$sort', '$amll', '$amul', '$afll', '$aful', '$cll', '$cul', '$nll', '$nul', '$displaynv', '$othval', '$unit', '$type', '$header', '$respos', '1', '1', '$rescol', '$rescollbl', '$resrow', '$resrowlbl')");
      }

      unset($_SESSION['zb']);
      unset($_SESSION['zm']);
      unset($_SESSION['zn']);

      echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=Close.php'>";
    }
  }
}

?>

</body>
</html>
