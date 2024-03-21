<?php
session_start();

ini_set("display_errors", "On");
include("../../../main/class.php");

if(isset($_GET['eno'])){$ttl="Edit";$eon=1;}
else{$ttl="Add";$eon=0;}

if(isset($_SESSION['zb'])){
  $setzb=$_SESSION['zb'];
}
else{
  $setzb=1;
}

if(isset($_SESSION['zm'])){
  $setzm=$_SESSION['zm'];
}
else{
  $setzm=1;
}

if(isset($_SESSION['zn'])){
  $setzn=$_SESSION['zn'];
}
else{
  $setzn=1;
}

$addzm=$setzm;

?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <title><?php echo $ttl; ?> Normal Value</title>
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
      .form-container-Edit input[type=text], .form-container-Edit input[type=number], .form-container-Edit select, .form-container-Edit textarea {padding: 7px;margin: 5px 0 5px 0;border: none;background: #eee;}
      /* When the inputs get focus, do something */
      .form-container-Edit input[type=text]:focus, .form-container-Edit input[type=number]:focus, .form-container-Edit select:focus, .form-container-Edit textarea:focus {background-color: #ddd;outline: none;}
      /* Style submit/login button */
      .form-container-Edit .btn {background-color: #8ebf42;color: #fff;padding: 12px 20px;border: none;cursor: pointer;margin-bottom:10px;opacity: 0.8;}
      /* Style cancel button */
      .form-container-Edit .cancel {background-color: #cc0000;}
      /* Hover effects for buttons */
      .form-container-Edit .btn:hover, .open-button:hover {opacity: 1;}
      /*Hide Unhide*/
      .unhide{display: block;}
      .hide{display: none;}
    </style>
    <script type="text/javascript">
      function change_url(val) {
        window.location=val;
      }
    </script>
  </head>
<body>
<?php
$code=mysqli_real_escape_string($conn,$_GET['code']);

$label="Add";

$asql=mysqli_query($conn,"SELECT `itemname` FROM `receiving` WHERE `code`='$code'");
$afetch=mysqli_fetch_array($asql);
$itmnm=$afetch['itemname'];

if(isset($_GET['eno'])){
  $label="Edit";
  $eno=mysqli_real_escape_string($conn,$_GET['eno']);
  $bsql=mysqli_query($conn,"SELECT * FROM `labnormalvalues` WHERE `no`='$eno'");
  if(mysqli_num_rows($bsql)>0){
    $bfetch=mysqli_fetch_array($bsql);
    $no=$bfetch['no'];
    $code=$bfetch['code'];
    $testname=$bfetch['testname'];
    $testabr=$bfetch['testabr'];
    $sort=$bfetch['sort'];
    $amll=$bfetch['amll'];
    $amul=$bfetch['amul'];
    $afll=$bfetch['afll'];
    $aful=$bfetch['aful'];
    $cll=$bfetch['cll'];
    $cul=$bfetch['cul'];
    $nll=$bfetch['nll'];
    $nul=$bfetch['nul'];
    $displaynv=$bfetch['displaynv'];
    $others=$bfetch['others'];
    $unit=$bfetch['unit'];
    $grp=$bfetch['grp'];
    $type=$bfetch['type'];
    $header=$bfetch['header'];
    $grplabel=$bfetch['grplabel'];
    $respos=$bfetch['respos'];
    $rescollbl=$bfetch['rescollbl'];
    $rescol=$bfetch['rescol'];
    $resrowlbl=$bfetch['resrowlbl'];
    $resrow=$bfetch['resrow'];

    if($type=="1"){$tp1="selected";$tp2="";$tp3="";$tp4="";}
    else if($type=="2"){$tp1="";$tp2="selected";$tp3="";$tp4="";}
    else if($type=="3"){$tp1="";$tp2="";$tp3="selected";$tp4="";}
    else if($type=="4"){$tp1="";$tp2="";$tp3="";$tp4="selected";}
    else{$tp1="";$tp2="";$tp3="";$tp4="";}

    if($grp=="1"){$gp1="selected";$gp2="";$gp3="";$gp4="";$gp5="";$gp6="";$gp7="";$gp8="";$one="unhide";$two="hide";$three="hide";$four="unhide";$five="hide";$six="hide";$seven="hide";$exun="";$ottype="button";$ottype5="button";$ctype="button";}
    else if($grp=="2"){$gp1="";$gp2="selected";$gp3="";$gp4="";$gp5="";$gp6="";$gp7="";$gp8="";$one="hide";$two="unhide";$three="hide";$four="hide";$five="hide";$six="hide";$seven="hide";$exun="";$ottype="button";$ottype5="button";$ctype="submit";}
    else if($grp=="3"){$gp1="";$gp2="";$gp3="selected";$gp4="";$gp5="";$gp6="";$gp7="";$gp8="";$one="hide";$two="hide";$three="unhide";$four="unhide";$five="hide";$six="hide";$seven="hide";$exun="unit";$ottype="submit";$ottype5="button";$ctype="button";}
    else if($grp=="4"){$gp1="";$gp2="";$gp3="";$gp4="selected";$gp5="";$gp6="";$gp7="";$gp8="";$one="hide";$two="hide";$three="hide";$four="unhide";$five="hide";$six="hide";$seven="hide";$exun="unit";$ottype="button";$ottype5="button";$ctype="button";}
    else if($grp=="5"){$gp1="";$gp2="";$gp3="";$gp4="";$gp5="selected";$gp6="";$gp7="";$gp8="";$one="hide";$two="hide";$three="hide";$four="unhide";$five="unhide";$six="hide";$seven="hide";$exun="";$ottype="button";$ottype5="submit";$ctype="button";}
    else if($grp=="6"){$gp1="";$gp2="";$gp3="";$gp4="";$gp5="";$gp6="selected";$gp7="";$gp8="";$one="hide";$two="unhide";$three="hide";$four="hide";$five="hide";$six="unhide";$seven="hide";$exun="";$ottype="button";$ottype5="button";$ctype="submit";}
    else if($grp=="7"){$gp1="";$gp2="";$gp3="";$gp4="";$gp5="";$gp6="";$gp7="selected";$one="hide";$two="hide";$three="hide";$four="unhide";$five="hide";$six="unhide";$seven="hide";$exun="unit";$ottype="button";$ottype5="button";$ctype="button";}
    else if($grp=="8"){$gp1="";$gp2="";$gp3="";$gp4="";$gp5="";$gp6="";$gp7="";$gp8="selected";$one="hide";$two="unhide";$three="hide";$four="unhide";$five="hide";$six="unhide";$seven="unhide";$exun="unit";$ottype="button";$ottype5="button";$ctype="submit";}
    else{$gp1="";$gp2="";$gp3="";$gp4="";$gp5="";$gp6="";$gp7="";$gp8="";$one="hide";$two="hide";$three="hide";$four="hide";$five="hide";$six="hide";$seven="hide";$exun="";$ottype="button";$ottype5="button";$ctype="button";}

    if($grp=="1"){$amllreq="required";$amulreq="required";$afllreq="required";$afulreq="required";$cllreq="required";$culreq="required";$nllreq="required";$nulreq="required";$creq="";$oreq="";}
    else if($grp=="2"){$amllreq="";$amulreq="";$afllreq="";$afulreq="";$cllreq="";$culreq="";$nllreq="";$nulreq="";$creq="required";$oreq="";}
    else if($grp=="3"){$amllreq="";$amulreq="";$afllreq="";$afulreq="";$cllreq="";$culreq="";$nllreq="";$nulreq="";$creq="";$oreq="required";}
    else if($grp=="4"){$amllreq="";$amulreq="";$afllreq="";$afulreq="";$cllreq="";$culreq="";$nllreq="";$nulreq="";$creq="";$oreq="";}
    else if($grp=="5"){$amllreq="";$amulreq="";$afllreq="";$afulreq="";$cllreq="";$culreq="";$nllreq="";$nulreq="";$creq="";$oreq="";}
    else if($grp=="6"){$amllreq="";$amulreq="";$afllreq="";$afulreq="";$cllreq="";$culreq="";$nllreq="";$nulreq="";$creq="";$oreq="";}
    else if($grp=="7"){$amllreq="";$amulreq="";$afllreq="";$afulreq="";$cllreq="";$culreq="";$nllreq="";$nulreq="";$creq="";$oreq="";}
    else{$amllreq="";$amulreq="";$afllreq="";$afulreq="";$cllreq="";$culreq="";$nllreq="";$nulreq="";$creq="required";$oreq="required";}
  }
  else{
    $code=$code;
    $testname="";
    $testabr="";
    $sort="";
    $amll="";
    $amul="";
    $afll="";
    $aful="";
    $cll="";
    $cul="";
    $nll="";
    $nul="";
    $displaynv="";
    $others="";
    $unit="";
    $grp="";
    $type="";
    $header="";
    $grplabel="";
    $respos="0";
    $rescollbl="";
    $rescol="";
    $resrowlbl="";
    $resrow="";

    $tp1="";$tp2="";$tp3="";$tp4="";
    $gp1="";$gp2="";$gp3="";$gp4="";$gp5="";$gp6="";$gp7="";$gp8="";
    $exun="";
    $ottype="button";
    $ottype5="button";
    $ctype="button";
    $one="hide";$two="hide";$three="hide";$four="hide";$five="hide";$six="hide";$seven="hide";

    $amllreq="required";$amulreq="required";$afllreq="required";$afulreq="required";$cllreq="required";$culreq="required";$nllreq="required";$nulreq="required";$creq="required";$oreq="required";
  }
}
else{
  if(isset($_GET['addot'])){
    $code=$code;
    $testname=$_SESSION['testname'];
    $testabr=$_SESSION['testabr'];
    $sort=$_SESSION['sort'];
    $amll="";
    $amul="";
    $afll="";
    $aful="";
    $cll="";
    $cul="";
    $nll="";
    $nul="";
    $displaynv=$_SESSION['displaynv'];
    $others="";
    $unit=$_SESSION['unit'];
    $grp=$_SESSION['grp'];
    $type=$_SESSION['type'];
    $header="";
    $grplabel="";
    $respos="0";
    $rescollbl="";
    $rescol="";
    $resrowlbl="";
    $resrow="";

    if($type=="1"){$tp1="selected";$tp2="";$tp3="";$tp4="";}
    else if($type=="2"){$tp1="";$tp2="selected";$tp3="";$tp4="";}
    else if($type=="3"){$tp1="";$tp2="";$tp3="selected";$tp4="";}
    else if($type=="4"){$tp1="";$tp2="";$tp3="";$tp4="selected";}
    else{$tp1="";$tp2="";$tp3="";$tp4="";}

    $gp1="";$gp2="";$gp3="selected";$gp4="";$gp5="";$gp6="";$gp7="";$gp8="";
    $exun="unit";
    $ottype="submit";
    $ottype5="button";
    $ctype="button";
    $one="hide";$two="hide";$three="unhide";$four="unhide";$five="hide";$six="hide";$seven="hide";

    $amllreq="";$amulreq="";$afllreq="";$afulreq="";$cllreq="";$culreq="";$nllreq="";$nulreq="";$creq="";$oreq="";
  }
  else{
    if(isset($_GET['addot5'])){
      $code=$code;
      $testname=$_SESSION['testname'];
      $testabr=$_SESSION['testabr'];
      $sort=$_SESSION['sort'];
      $amll="";
      $amul="";
      $afll="";
      $aful="";
      $cll="";
      $cul="";
      $nll="";
      $nul="";
      $displaynv=$_SESSION['displaynv'];
      $others="";
      $unit=$_SESSION['unit'];
      $grp=$_SESSION['grp'];
      $type=$_SESSION['type'];
      $header="";
      $grplabel="";
      $respos="0";
      $rescollbl="";
      $rescol="";
      $resrowlbl="";
      $resrow="";

      if($type=="1"){$tp1="selected";$tp2="";$tp3="";$tp4="";}
      else if($type=="2"){$tp1="";$tp2="selected";$tp3="";$tp4="";}
      else if($type=="3"){$tp1="";$tp2="";$tp3="selected";$tp4="";}
      else if($type=="4"){$tp1="";$tp2="";$tp3="";$tp4="selected";}
      else{$tp1="";$tp2="";$tp3="";$tp4="";}

      $gp1="";$gp2="";$gp3="";$gp4="";$gp5="selected";$gp6="";$gp7="";$gp8="";
      $exun="unit";
      $ottype="button";
      $ottype5="submit";
      $ctype="button";
      $one="hide";$two="hide";$three="hide";$four="unhide";$five="unhide";$six="hide";$seven="hide";

      $amllreq="";$amulreq="";$afllreq="";$afulreq="";$cllreq="";$culreq="";$nllreq="";$nulreq="";$creq="";$oreq="";
    }
    else{
      if(isset($_GET['addch'])){
        $code=$code;
        $testname=$_SESSION['testname'];
        $testabr=$_SESSION['testabr'];
        $sort=$_SESSION['sort'];
        $amll="";
        $amul="";
        $afll="";
        $aful="";
        $cll="";
        $cul="";
        $nll="";
        $nul="";
        $displaynv=$_SESSION['displaynv'];
        $others="";
        $unit=$_SESSION['unit'];
        $grp=$_SESSION['grp'];
        $type=$_SESSION['type'];
        $header="";
        $grplabel=$_SESSION['grplabel'];
        $respos=$_SESSION['respos'];
        $rescollbl=$_SESSION['rescollbl'];
        $rescol=$_SESSION['rescol'];
        $resrowlbl=$_SESSION['resrowlbl'];
        $resrow=$_SESSION['resrow'];

        if($type=="1"){$tp1="selected";$tp2="";$tp3="";$tp4="";}
        else if($type=="2"){$tp1="";$tp2="selected";$tp3="";$tp4="";}
        else if($type=="3"){$tp1="";$tp2="";$tp3="selected";$tp4="";}
        else if($type=="4"){$tp1="";$tp2="";$tp3="";$tp4="selected";}
        else{$tp1="";$tp2="";$tp3="";$tp4="";}

        if($grp==2){
          $gp1="";$gp2="selected";$gp3="";$gp4="";$gp5="";$gp6="";$gp7="";$gp8="";
          $one="hide";$two="unhide";$three="hide";$four="hide";$five="hide";$six="hide";$seven="hide";
        }
        else if($grp==6){
          $gp1="";$gp2="";$gp3="";$gp4="";$gp5="";$gp6="selected";$gp7="";$gp8="";
          $one="hide";$two="unhide";$three="hide";$four="hide";$five="hide";$six="unhide";$seven="hide";
        }
        else if($grp==8){
          $gp1="";$gp2="";$gp3="";$gp4="";$gp5="";$gp6="";$gp7="";$gp8="selected";
          $one="hide";$two="unhide";$three="hide";$four="hide";$five="hide";$six="hide";$seven="unhide";
        }
        else{
          $gp1="";$gp2="selected";$gp3="";$gp4="";$gp5="";$gp6="";$gp7="";$gp8="";
          $one="hide";$two="unhide";$three="hide";$four="hide";$five="hide";$six="hide";$seven="hide";
        }

        $exun="unit";
        $ottype="button";
        $ottype5="button";
        $ctype="submit";

        $amllreq="";$amulreq="";$afllreq="";$afulreq="";$cllreq="";$culreq="";$nllreq="";$nulreq="";$creq="";$oreq="";
      }
      else{
        $code=$code;
        $testname="";
        $testabr="";
        $amll="";
        $amul="";
        $afll="";
        $aful="";
        $cll="";
        $cul="";
        $nll="";
        $nul="";
        $displaynv="";
        $others="";
        $unit="";
        $grp="";
        $type="";
        $header="";
        $rescollbl="";
        $rescol="";
        $resrowlbl="";
        $resrow="";

        $tp1="";$tp2="";$tp3="";$tp4="";
        $gp1="";$gp2="";$gp3="";$gp4="";$gp5="";$gp6="";$gp7="";$gp8="";
        $exun="";
        $ottype="button";
        $ottype5="button";
        $ctype="button";
        $one="hide";$two="hide";$three="hide";$four="hide";$five="hide";$six="hide";$seven="hide";

        $amllreq="required";$amulreq="required";$afllreq="required";$afulreq="required";$cllreq="required";$culreq="required";$nllreq="required";$nulreq="required";$creq="required";$oreq="required";

        $yxsql=mysqli_query($conn,"SELECT `testname`, `grp`, `grplabel`, `respos`, `sort`, `type`, `rescol`, `rescollbl`, `resrow`, `resrowlbl` FROM `labnormalvalues` WHERE `code`='$code' ORDER BY CAST(`sort` AS UNSIGNED) DESC");
        $yxcount=mysqli_num_rows($yxsql);
        if($yxcount==0){
          $sort="";
          $grplabel="";
          $respos="0";
        }
        else{
          $yxfetch=mysqli_fetch_array($yxsql);
          $sort=$yxfetch['sort']+1;
          $grplabel=$yxfetch['grplabel'];
          $respos=$yxfetch['respos'];

          $grp=$yxfetch['grp'];
          if($grp==8){
            $testname=$yxfetch['testname'];
            $tp2="selected";
            $rescol=$yxfetch['rescol'];
            $rescollbl=$yxfetch['rescollbl'];
            $resrow=$yxfetch['resrow'];
            $resrowlbl=$yxfetch['resrowlbl'];

            $gp8="selected";
            $two="unhide";
            $seven="unhide";
            $ctype="submit";
          }
        }
      }
    }
  }
}

echo "
<div align='center'>
  <form name='Save' method='post' action='AENVSave.php' class='form-container-Edit'>
    <table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td colspan='3'><div align='center' class='arial s18 blue bold'>$label to Normal Value/s</div></td>
      </tr>
      <tr>
        <td colspan='3' height='10'></td>
      </tr>
      <tr class='hide'>
        <td><div align='left' class='s14 bold'>Code</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='Item Code' name='code' value='$code' autocomplete='off' style='width: 100%;height: 40px;border-radius: 6px;border: 1px solid grey;' readonly /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14 bold'>Test Name</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='Test Name' name='testname' value='$testname' autocomplete='off' style='width: 100%;height: 40px;border-radius: 6px;border: 1px solid grey;' autofocus required /></td>
      </tr>
      <!-- tr>
        <td><div align='left' class='s14 bold'>Test Abr.</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='Test Abbreviation' name='testabr' value='$testabr' autocomplete='off' style='width: 100%;height: 40px;border-radius: 6px;border: 1px solid grey;' required /></td>
      </tr -->
      <tr>
        <td><div align='left' class='s14 bold'>Sorting</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='number' placeholder='Sorting Number/Display Sequence' name='sort' value='$sort' autocomplete='off' style='width: 100%;height: 40px;border-radius: 6px;border: 1px solid grey;' required /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14 bold'>Result/Input</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><div align='left'>
          <select name='type' style='width: 100%;height: 40px;border-radius: 6px;border: 1px solid grey;' required>
            <option></option>
            <option value='1' $tp1>Result w/ H or L Indicator</option>
            <option value='2' $tp2>Result has no H or L Indicator</option>
            <option value='3' $tp3>Input 2 Value, No H or L Indicator</option>
            <option value='4' $tp4>Free Write</option>
          </select>
        </div></td>
      </tr>
      <tr>
        <td><div align='left' class='s14 bold'>NV Type</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><div align='left'>
          <select name='grp' id='grpid' style='width: 50px;height: 40px;border-radius: 6px;border: 1px solid grey;' required>
            <option></option>
            <option $gp1>1</option>
            <option $gp2>2</option>
            <option $gp3>3</option>
            <option $gp4>4</option>
            <option $gp5>5</option>
            <option $gp6>6</option>
            <option $gp7>7</option>
            <option $gp8>8</option>
          </select>
        </div></td>
      </tr>


      <tr>
        <td colspan='3'><div class='$one' id='oneonly' style='padding: 25px 0 5px 0;'>
          <table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td colspan='3'><div align='left' class='s11 bold blue'>Normal Values (NV Type = 1)</div></td>
            </tr>
            <tr>
              <td><div align='left' class='s14 bold'>Adult (Male)</div></td>
              <td width='10'><div align='center' class='s14'>:</div></td>
              <td><div align='left'><input type='text' placeholder='Lower Limit' name='amll' id='amll' value='$amll' autocomplete='off' style='width: 100px;height: 40px;border-radius: 6px;border: 1px solid grey;' $amllreq /> - <input type='text' placeholder='Upper Limit' name='amul' id='amul' value='$amul' autocomplete='off' style='width: 100px;height: 40px;border-radius: 6px;border: 1px solid grey;' $amulreq /></div></td>
            </tr>
            <tr>
              <td><div align='left' class='s14 bold'>Adult (Female)</div></td>
              <td width='10'><div align='center' class='s14'>:</div></td>
              <td><div align='left'><input type='text' placeholder='Lower Limit' name='afll' id='afll' value='$afll' autocomplete='off' style='width: 100px;height: 40px;border-radius: 6px;border: 1px solid grey;' $afllreq /> - <input type='text' placeholder='Upper Limit' name='aful' id='aful' value='$aful' autocomplete='off' style='width: 100px;height: 40px;border-radius: 6px;border: 1px solid grey;' $afulreq /></div></td>
            </tr>
            <tr>
              <td><div align='left' class='s14 bold'>Child</div></td>
              <td width='10'><div align='center' class='s14'>:</div></td>
              <td><div align='left'><input type='text' placeholder='Lower Limit' name='cll' id='cll' value='$cll' autocomplete='off' style='width: 100px;height: 40px;border-radius: 6px;border: 1px solid grey;' $cllreq /> - <input type='text' placeholder='Upper Limit' name='cul' id='cul' value='$cul' autocomplete='off' style='width: 100px;height: 40px;border-radius: 6px;border: 1px solid grey;' $culreq /></div></td>
            </tr>
            <tr>
              <td><div align='left' class='s14 bold'>Neonatal</div></td>
              <td width='10'><div align='center' class='s14'>:</div></td>
              <td><div align='left'><input type='text' placeholder='Lower Limit' name='nll' id='nll' value='$nll' autocomplete='off' style='width: 100px;height: 40px;border-radius: 6px;border: 1px solid grey;' $nllreq /> - <input type='text' placeholder='Upper Limit' name='nul' id='nul' value='$nul' autocomplete='off' style='width: 100px;height: 40px;border-radius: 6px;border: 1px solid grey;' $nulreq /></div></td>
            </tr>
          </table>
        </div></td>
      </tr>


      <tr>
        <td colspan='3'><div class='$two' id='twoonly' style='padding: 25px 0 5px 0;'>
          <table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td>
                <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td><div align='left' class='s11 bold green'>Set Choices (NV Type = 2)</div></td>
                    <td><div align='right'><input type='$ctype' name='addch' id='addch' style='height: 20px;font-size: 9px;font-weight: bold;text-align: center;border-radius: 5px;' value='+' /><div></td>
                  </tr>
                  <tr>
                    <td colspan='2'>
                      <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td><div align='left' class='arial s10 black bold'>#</div></td>
                          <td><div align='left' class='arial s10 black bold'>Choices</div></td>
                        </tr>
";

if(($others!="")&&(($grp==2)||($grp==6)||($grp==8))){
  $setzm=substr_count($others,"|");
  $cs=preg_split("/\|/",$others);
  $csa="1";

  if($addzm>$setzm){
    $setzm=$setzm+($addzm-$setzm);
  }
}
else{
  $csa="0";
}

for($zm=1;$zm<=$setzm;$zm++){
  if(isset($_GET['addch'])){
    $zch="ch-".$zm;
    $ich=$_SESSION[$zch];
  }
  else{
    if($csa=="1"){
      $csvar=$zm-1;
      $ich=$cs[$csvar];
    }
    else{
      $ich="";
    }
  }

echo "
                        <tr>
                          <td><div align='left' class='arial s12 black'>$zm</div></td>
                          <td><div align='center'><input type='text' name='ch-$zm' placeholder='Choice # $zm' style='width: 95%;height: 30px;border-radius: 4px;border: 1px solid grey;font-size: 11px;' value='$ich' /></div></td>
                        </tr>
";
}

echo "
                      </table>
                      <input type='hidden' name='zm' value='$zm' />
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </div></td>
      </tr>
";

if($eon==1){
echo "
      <input type='hidden' name='eon' value='$eon' />
      <input type='hidden' name='eonval' value='".$_GET['eno']."' />
";
}

echo "
      <tr>
        <td colspan='3'><div class='$three' id='threeonly' style='padding: 25px 0 5px 0;'>
          <table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='left' class='s11 bold blue'>Set Custom Age-based Normal Values (NV Type = 3)</div></td>
            </tr>
            <tr>
              <td>
                <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td colspan='3'><div align='left' class='s11 bold green'>Set Age</div></td>
                    <td width='2%'></td>
                    <td colspan='3'>
                      <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td><div align='left' class='s11 bold green'>Set Normal Value</div></td>
                          <td><div align='right'><input type='$ottype' name='addot' id='addot' type='submit' style='height: 20px;font-size: 9px;font-weight: bold;text-align: center;border-radius: 5px;' value='+' /><div></td>
                        </tr>
                      </table>
                    </td>
                  </tr>
";

if(($others!="")&&($grp==3)){
  $setzb=substr_count($others,"|");
  $ots=preg_split("/\|/",$others);
  $otsa="1";
}
else{
  $otsa="0";
}

for($zb=1;$zb<=$setzb;$zb++){
  if(isset($_GET['addot'])){
    $znall="agell-".$zb;
    $znaul="ageul-".$zb;
    $znoll="otnvll-".$zb;
    $znoul="otnvul-".$zb;

    $all=$_SESSION[$znall];
    $aul=$_SESSION[$znaul];
    $oll=$_SESSION[$znoll];
    $oul=$_SESSION[$znoul];
  }
  else{
    if($otsa=="1"){
      $otsvar=$zb-1;
      $otss=preg_split("/\*/",$ots[$otsvar]);

      $all=$otss[0];
      $aul=$otss[1];
      $oll=$otss[2];
      $oul=$otss[3];
    }
    else{
      $all="";
      $aul="";
      $oll="";
      $oul="";
    }
  }

echo "
                  <tr>
                    <td><div align='center'><input type='number' name='agell-$zb' style='width: 50px;height: 30px;border-radius: 4px;border: 1px solid grey;font-size: 11px;' value='$all' /></div></td>
                    <td><div align='center' class='s11 bold black'>to</div></td>
                    <td><div align='center'><input type='number' name='ageul-$zb' style='width: 50px;height: 30px;border-radius: 4px;border: 1px solid grey;font-size: 11px;' value='$aul' /></td>
                    <td></td>
                    <td><div align='center'><input type='number' name='otnvll-$zb' style='width: 65px;height: 30px;border-radius: 4px;border: 1px solid grey;font-size: 11px;' step='0.01' value='$oll' /></td>
                    <td><div align='center' class='s11 bold black'>to</div></td>
                    <td><div align='center'><input type='number' name='otnvul-$zb' style='width: 65px;height: 30px;border-radius: 4px;border: 1px solid grey;font-size: 11px;' step='0.01' value='$oul' /></td>
                  </tr>
";
}

echo "
                </table>
                <input type='hidden' name='zb' value='$zb' />
              </td>
            </tr>
          </table>
        </div></td>
      </tr>
";

echo "
      <tr>
        <td colspan='3'><div class='$five' id='fiveonly' style='padding: 25px 0 5px 0;'>
          <table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='left' class='s11 bold blue'>Set Custom Label Normal Values (NV Type = 5)</div></td>
            </tr>
            <tr>
              <td>
                <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td colspan='2'><div align='left' class='s11 bold green'>Set Label</div></td>
                    <td colspan='3'>
                      <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td><div align='left' class='s11 bold green'>Set Normal Value</div></td>
                          <td><div align='right'><input type='$ottype5' name='addot5' id='addot5' type='submit' style='height: 20px;font-size: 9px;font-weight: bold;text-align: center;border-radius: 5px;' value='+' /><div></td>
                        </tr>
                      </table>
                    </td>
                  </tr>
";

if(($others!="")&&($grp==5)){
  $setzn=substr_count($others,"|");
  $ots5=preg_split("/\|/",$others);
  $otsa5="1";
}
else{
  $otsa5="0";
}

for($zn=1;$zn<=$setzn;$zn++){
  if(isset($_GET['addot5'])){
    $znlbl="lbl-".$zn;
    $znoll5="otnvll5-".$zn;
    $znoul5="otnvul5-".$zn;

    $lbl=$_SESSION[$znlbl];
    $oll5=$_SESSION[$znoll5];
    $oul5=$_SESSION[$znoul5];
  }
  else{
    if($otsa5=="1"){
      $otsvar5=$zn-1;
      $otss5=preg_split("/\*/",$ots5[$otsvar5]);

      $lbl=$otss5[0];
      $oll5=$otss5[1];
      $oul5=$otss5[2];
    }
    else{
      $lbl="";
      $oll5="";
      $oul5="";
    }
  }

echo "
                  <tr>
                    <td><div align='center'><input type='text' name='lbl-$zn' style='width: 140px;height: 30px;border-radius: 4px;border: 1px solid grey;font-size: 11px;' value='$lbl' placeholder='Label' /></div></td>
                    <td width='10'></td>
                    <td width='65'><div align='center'><input type='number' name='otnvll5-$zn' style='width: 65px;height: 30px;border-radius: 4px;border: 1px solid grey;font-size: 11px;' step='0.01' value='$oll5' /></td>
                    <td width='20'><div align='center' class='s11 bold black'>to</div></td>
                    <td width='65'><div align='center'><input type='number' name='otnvul5-$zn' style='width: 65px;height: 30px;border-radius: 4px;border: 1px solid grey;font-size: 11px;' step='0.01' value='$oul5' /></td>
                  </tr>
";
}

echo "
                </table>
                <input type='hidden' name='zn' value='$zn' />
              </td>
            </tr>
          </table>
        </div></td>
      </tr>
";


echo "
      <tr>
        <td><div align='left' class='s14 bold'>Display NV</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='Display Normal Value' name='displaynv' value='$displaynv' autocomplete='off' style='width: 100%;height: 40px;border-radius: 6px;border: 1px solid grey;' /></td>
      </tr>

      <tr>
        <td colspan='3'><div class='$four' id='fouronly' style='padding: 25px 0 5px 0;'>
          <table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td colspan='3'><div align='left' class='s11 bold blue'>Set Unit (NV Type = 1 OR Type = 3 OR NV Type = 4 OR NV Type = 5)</div></td>
            </tr>
            <tr>
              <td><div align='left' class='s14 bold'>Unit</div></td>
              <td width='10'><div align='center' class='s14'>:</div></td>
              <td><input type='text' placeholder='Unit' name='unit' id='unit' value='$unit' autocomplete='off' style='width: 100%;height: 40px;border-radius: 6px;border: 1px solid grey;' /></td>
            </tr>
          </table>
        </div></td>
      </tr>

      <tr>
        <td colspan='3'><div class='$six' id='sixonly' style='padding: 25px 0 5px 0;'>
          <table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td colspan='3'><div align='left' class='s11 bold blue'>Set Result Position on Printout (NV Type = 6 OR NV Type = 7)</div></td>
            </tr>
            <tr>
              <td><div align='left' class='s14 bold'>Group Label</div></td>
              <td width='10'><div align='center' class='s14'>:</div></td>
              <td><input type='text' placeholder='Group Label' name='grplabel' value='$grplabel' autocomplete='off' style='width: 100%;height: 40px;border-radius: 6px;border: 1px solid grey;' /></td>
            </tr>
            <tr>
              <td><div align='left' class='s14 bold'>Position</div></td>
              <td width='10'><div align='center' class='s14'>:</div></td>
              <td><input type='number' min='0' max='2' placeholder='Result Position on Printount' name='respos' id='respos' value='$respos' autocomplete='off' style='width: 100%;height: 40px;border-radius: 6px;border: 1px solid grey;' /></td>
            </tr>
          </table>
        </div></td>
      </tr>

      <tr>
        <td colspan='3'><div class='$seven' id='sevenonly' style='padding: 25px 0 5px 0;'>
          <table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td><div align='left' class='s14 bold'>Column Label</div></td>
              <td width='10'><div align='center' class='s14'>:</div></td>
              <td><input type='text' placeholder='Column Label' name='rescollbl' value='$rescollbl' autocomplete='off' style='width: 100%;height: 40px;border-radius: 6px;border: 1px solid grey;' /></td>
            </tr>
            <tr>
              <td><div align='left' class='s14 bold'>Column #</div></td>
              <td width='10'><div align='center' class='s14'>:</div></td>
              <td><input type='number' placeholder='Column Number' name='rescol' value='$rescol' autocomplete='off' style='width: 100%;height: 40px;border-radius: 6px;border: 1px solid grey;' /></td>
            </tr>
            <tr>
              <td><div align='left' class='s14 bold'>Row Label</div></td>
              <td width='10'><div align='center' class='s14'>:</div></td>
              <td><input type='text' placeholder='Row Label' name='resrowlbl' value='$resrowlbl' autocomplete='off' style='width: 100%;height: 40px;border-radius: 6px;border: 1px solid grey;' /></td>
            </tr>
            <tr>
              <td><div align='left' class='s14 bold'>Row #</div></td>
              <td width='10'><div align='center' class='s14'>:</div></td>
              <td><input type='number' placeholder='Row Name' name='resrow' value='$resrow' autocomplete='off' style='width: 100%;height: 40px;border-radius: 6px;border: 1px solid grey;' /></td>
            </tr>
          </table>
        </div></td>
      </tr>

      <tr>
        <td colspan='3' height='3'></td>
      </tr>
      <tr>
        <td><div align='left' class='s14 bold'>Style</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <td><div align='left' style='padding: 0 5px 0 5px;'>
              <table border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td><div style='padding-right: 3px;'><input type='checkbox' name='sizeon' checked /></div></td>
                  <td><div align='left' class='s10 bold' style='padding-right: 15px;'>Font Size</div></td>
                  <td><input type='number' placeholder='Size' name='sizeval' min='10' value='15' autocomplete='off' style='font-size: 9px;width: 60px;height: 20px;border-radius: 3px;border: 1px solid grey;' /></td>
                </tr>
              </table>
            </div></td>
          </tr>
          <tr>
            <td><div align='left' style='padding: 0 5px 0 5px;'>
              <table border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td><div style='padding-right: 3px;'><input type='checkbox' name='weighton' checked /></div></td>
                  <td><div align='left' class='s10 bold' style='padding-right: 15px;'>Font Weight</div></td>
                  <td><div style='padding-right: 3px;'><input type='radio' name='weightval' value='normal' checked /></div></td>
                  <td><div class='s11 bold' style='padding-right: 10px;'>Normal</div></td>
                  <td><div style='padding-right: 3px;'><input type='radio' name='weightval' value='bold' /></div></td>
                  <td><div class='s11 bold' style='padding-right: 10px;'>Bold</div></td>
                </tr>
              </table>
            </div></td>
          </tr>
        </table></div></td>
      </tr>
      <tr>
        <td colspan='3' height='10'></td>
      </tr>
      <tr>
        <td colspan='3'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <td width='49%'><div align='right'><button type='button' class='btn cancel' onclick='closeme()'>Close</button></div></td>
            <td width='2%'></td>
            <td width='49%'><div align='left'><button type='submit' class='btn'>Save</button></div></td>
          </tr>
        </table></td>
      </tr>
    </table>
";

if(isset($_GET['eno'])){
echo "
    <input type='hidden' name='eno' value='$eno' />
";
}

echo "
  </form>
</div>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='400;URL=Close.php'>";
?>

<script>
  function closeme() {
    window.close();
  }

  const el1 = document.getElementById('grpid');
  var element = document.getElementById("oneonly");
  var amll = document.getElementById("amll");
  var amul = document.getElementById("amul");
  var afll = document.getElementById("afll");
  var aful = document.getElementById("aful");
  var cll = document.getElementById("cll");
  var cul = document.getElementById("cul");
  var nll = document.getElementById("nll");
  var nul = document.getElementById("nul");

  el1.addEventListener('change', function handleChange(event) {
    if (event.target.value === '1') {
      element.classList.remove("hide");
      element.classList.add("unhide");
      amll.required = true;
      amul.required = true;
      afll.required = true;
      aful.required = true;
      cll.required = true;
      cul.required = true;
      nll.required = true;
      nul.required = true;
    } else {
      element.classList.remove("unhide");
      element.classList.add("hide");
      amll.required = false;
      amul.required = false;
      afll.required = false;
      aful.required = false;
      cll.required = false;
      cul.required = false;
      nll.required = false;
      nul.required = false;
    }
  });

  const el2 = document.getElementById('grpid');
  var element2 = document.getElementById("twoonly");
  var element6 = document.getElementById("sixonly");
  var element7 = document.getElementById("sevenonly");
  var choices = document.getElementById("choices");
  var addch = document.getElementById("addch");

  el2.addEventListener('change', function handleChange(event) {
    if (event.target.value === '2') {
      element2.classList.remove("hide");
      element2.classList.add("unhide");
      element6.classList.remove("unhide");
      element6.classList.add("hide");
      element7.classList.remove("unhide");
      element7.classList.add("hide");
      addch.setAttribute('type', 'submit');
      choices.required = true;
    } else if (event.target.value === '6') {
      element2.classList.remove("hide");
      element2.classList.add("unhide");
      element6.classList.remove("hide");
      element6.classList.add("unhide");
      element7.classList.remove("unhide");
      element7.classList.add("hide");
      addch.setAttribute('type', 'submit');
      choices.required = true;
    } else if (event.target.value === '7') {
      element2.classList.remove("unhide");
      element2.classList.add("hide");
      element6.classList.remove("hide");
      element6.classList.add("unhide");
      element7.classList.remove("unhide");
      element7.classList.add("hide");
      addch.setAttribute('type', 'button');
      choices.required = true;
    } else if (event.target.value === '8') {
      element2.classList.remove("hide");
      element2.classList.add("unhide");
      element6.classList.remove("unhide");
      element6.classList.add("hide");
      element7.classList.remove("hide");
      element7.classList.add("unhide");
      addch.setAttribute('type', 'submit');
      choices.required = true;
    } else {
      element2.classList.remove("unhide");
      element2.classList.add("hide");
      element6.classList.remove("unhide");
      element6.classList.add("hide");
      element7.classList.remove("unhide");
      element7.classList.add("hide");
      addch.setAttribute('type', 'button');
      choices.required = false;
    }
  });

  const el3 = document.getElementById('grpid');
  var element3 = document.getElementById("threeonly");
  var others = document.getElementById("others");

  el3.addEventListener('change', function handleChange(event) {
    if (event.target.value === '3') {
      element3.classList.remove("hide");
      element3.classList.add("unhide");
      others.required = true;
    } else {
      element3.classList.remove("unhide");
      element3.classList.add("hide");
      others.required = false;
    }
  });

  const el4 = document.getElementById('grpid');
  var element4 = document.getElementById("fouronly");
  var addot = document.getElementById("addot");

  el4.addEventListener('change', function handleChange(event) {
    if (event.target.value === '4') {
      element4.classList.remove("hide");
      element4.classList.add("unhide");
      addot.setAttribute('type', 'button');
    } else if (event.target.value === '3') {
      element4.classList.remove("hide");
      element4.classList.add("unhide");
      addot.setAttribute('type', 'submit');
    } else if (event.target.value === '1') {
      element4.classList.remove("hide");
      element4.classList.add("unhide");
      addot.setAttribute('type', 'button');
    } else {
      element4.classList.remove("unhide");
      element4.classList.add("hide");
      addot.setAttribute('type', 'button');
    }
  });

  const el5 = document.getElementById('grpid');
  var element5 = document.getElementById("fiveonly");
  var element4 = document.getElementById("fouronly");
  var addot5 = document.getElementById("addot5");

  el5.addEventListener('change', function handleChange(event) {
    if (event.target.value === '5') {
      element5.classList.remove("hide");
      element5.classList.add("unhide");
      element4.classList.remove("hide");
      element4.classList.add("unhide");
      addot5.setAttribute('type', 'submit');
    } else {
      element5.classList.remove("unhide");
      element5.classList.add("hide");

      addot5.setAttribute('type', 'button');
    }
  });

</script>

</body>
</html>
