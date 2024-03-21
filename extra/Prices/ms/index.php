<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Edit Item</title>
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
      .form-container-Edit {max-width: 500px;padding: 15px;background-color: #E8E4C9; }
      /* Full-width for input fields */
      .form-container-Edit input[type=text], .form-container-Edit input[type=number] {width: 100%;height: 40px;padding: 7px;margin: 5px 0 5px 0;border: none;background: #eee;border-radius: 10px;font-size: 14px;}
            /* Full-width for input fields */
      .form-container-Edit select {height: 40px;padding: 7px;margin: 5px 0 5px 0;border: none;background: #eee;border-radius: 10px;font-size: 14px;}
      /* Select fields */
      .form-container-Edit select {width: 100%;padding: 10px;margin: 5px 0 10px 0;border: none;background: #eee;}
      /* When the inputs get focus, do something */
      .form-container-Edit input[type=text]:focus, .form-container-Edit input[type=number]:focus, .form-container-Edit select:focus {background-color: #ddd;outline: none;}
      /* Style submit/login button */
      .form-container-Edit .btn {background-color: #8ebf42;color: #fff;padding: 12px 20px;border: none;cursor: pointer;margin-bottom:10px;opacity: 0.8;border-radius: 10px;}
      /* Style cancel button */
      .form-container-Edit .cancel {background-color: #cc0000;}
      /* Hover effects for buttons */
      .form-container-Edit .btn:hover, .open-button:hover {opacity: 1;}\
      .t1 {border-top-width: 1px;border-top-color: #000000;border-top-style: solid;}
      .b1 {border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;}
      .l1 {border-left-width: 1px;border-left-color: #000000;border-left-style: solid;}
      .r1 {border-right-width: 1px;border-right-color: #000000;border-right-style: solid;}
    </style>
    <script type="text/javascript">
      function change_url(val){
        window.location=val;
      }
    </script>
  </head>
<body>
<?php
ini_set("display_errors", "On");
include("../../../main/connection.php");

if(isset($_POST['save'])){
  $code=mysqli_real_escape_string($conn,$_POST['code']);
  $xox=mysqli_real_escape_string($conn,$_POST['xox']);
  $description=trim(mysqli_real_escape_string($conn,$_POST['description']));
  $generic=trim(mysqli_real_escape_string($conn,$_POST['generic']));
  $pnf=mysqli_real_escape_string($conn,$_POST['pnf']);
  $testcode=mysqli_real_escape_string($conn,$_POST['testcode']);
  $gtestcode=mysqli_real_escape_string($conn,$_POST['gtestcode']);
  $lotno=mysqli_real_escape_string($conn,$_POST['lotno']);

  if($lotno=="S"){
    $cash=mysqli_real_escape_string($conn,$_POST['cash']);
    $charge=mysqli_real_escape_string($conn,$_POST['charge']);
  }

  $itemname=$description." (".$generic.")";

  //-------------------------------------------------------------------------------------------------
  $asql=mysqli_query($conn,"SELECT * FROM `receiving` WHERE `code`='$code'");
  $afetch=mysqli_fetch_array($asql);
  $adescription=$afetch['description'];
  $ageneric=$afetch['generic'];
  $aexpiration=$afetch['expiration'];
  $alotno=$afetch['lotno'];
  $aunit=$afetch['unit'];
  $ageneric=$afetch['generic'];
  $apnf=$afetch['pnf'];
  $aitemname=$afetch['itemname'];
  $atestcode=$afetch['testcode'];
  $agtestcode=$afetch['gtestcode'];
  $aop4=$afetch['optset4'];
  //-----------------------------------------------------------------------------------------------

  $xx=0;
  if($adescription!=$description){
    $xx+=1;
    mysqli_query($conn,"UPDATE `receiving` SET `description`='$description', `itemname`='$itemname' WHERE `code`='$code'");

    $elog="$itemname|$code|Updated Description|New Description: $description|Old Description: $adescription";
    mysqli_query($conn,"INSERT INTO `userlogs` (`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('$elog', '".base64_decode($xox)."', '".date("Y-m-d")."', '".date("H:i:s")."')");
  }

  if($ageneric!=$generic){
    $xx+=1;
    mysqli_query($conn,"UPDATE `receiving` SET `generic`='$generic', `itemname`='$itemname' WHERE `code`='$code'");

    $elog="$itemname|$code|Updated Generic|New Generic: $generic|Old Description: $ageneric";
    mysqli_query($conn,"INSERT INTO `userlogs` (`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('$elog', '".base64_decode($xox)."', '".date("Y-m-d")."', '".date("H:i:s")."')");
  }

  if($apnf!=$pnf){
    $xx+=1;
    mysqli_query($conn,"UPDATE `receiving` SET `pnf`='$pnf' WHERE `code`='$code'");

    $elog="$aitemname|$code|Updated PNF|New PNF: $pnf|Old PNF: $apnf";
    mysqli_query($conn,"INSERT INTO `userlogs` (`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('$elog', '".base64_decode($xox)."', '".date("Y-m-d")."', '".date("H:i:s")."')");
  }

  if($agtestcode!=$gtestcode){
    $xx+=1;
    mysqli_query($conn,"UPDATE `receiving` SET `gtestcode`='$gtestcode' WHERE `code`='$code'");

    $elog="$aitemname|$code|Updated Enable Disable Status|New Status: $gtestcode|Old Status: $agtestcode";
    mysqli_query($conn,"INSERT INTO `userlogs` (`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('$elog', '".base64_decode($xox)."', '".date("Y-m-d")."', '".date("H:i:s")."')");
  }

  if($atestcode!=$testcode){
    $xx+=1;
    mysqli_query($conn,"UPDATE `receiving` SET `testcode`='$testcode' WHERE `code`='$code'");

    $elog="$aitemname|$code|Updated Taxable Status|New Status: $testcode|Old Status: $atestcode";
    mysqli_query($conn,"INSERT INTO `userlogs` (`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('$elog', '".base64_decode($xox)."', '".date("Y-m-d")."', '".date("H:i:s")."')");
  }

  if($alotno!=$lotno){
    $xx+=1;
    mysqli_query($conn,"UPDATE `receiving` SET `lotno`='$lotno' WHERE `code`='$code'");

    $elog="$aitemname|$code|Updated Price Type|New Price Type: $lotno|Old Price Type: $alotno";
    mysqli_query($conn,"INSERT INTO `userlogs` (`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('$elog', '".base64_decode($xox)."', '".date("Y-m-d")."', '".date("H:i:s")."')");
  }

  if($lotno=="S"){
    $bsql=mysqli_query($conn,"SELECT * FROM `productsmasterlist` WHERE `code`='$code'");
    $bcount=mysqli_num_rows($bsql);

    if($bcount=="0"){
      $xx+=1;
      mysqli_query($conn,"INSERT INTO `productsmasterlist` (`code`, `unitprice`, `philhealth`, `hmo`, `nonmed`, `company`, `opd`) VALUES ('$code', '$unitcost', '$charge', '$hmo', '$cash', '$charge', '$cash')");

      $elog="$aitemname|$code|Add New Price";
      mysqli_query($conn,"INSERT INTO `userlogs` (`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('$elog', '".base64_decode($xox)."', '".date("Y-m-d")."', '".date("H:i:s")."')");
    }
    else{
      $bfetch=mysqli_fetch_array($bsql);
      $bcharge=$bfetch['philhealth'];
      $bcash=$bfetch['opd'];
      $bhmo=$bfetch['hmo'];

      if($bcharge!=$charge){
        $xx+=1;
        mysqli_query($conn,"UPDATE `productsmasterlist` SET `philhealth`='$charge', `company`='$charge' WHERE `code`='$code'");

        $elog="$aitemname|$code|Updated Charge Price|Old Charge Price: $bcharge";
        mysqli_query($conn,"INSERT INTO `userlogs` (`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('$elog', '".base64_decode($xox)."', '".date("Y-m-d")."', '".date("H:i:s")."')");
      }

      if($bcash!=$cash){
        $xx+=1;
        mysqli_query($conn,"UPDATE `productsmasterlist` SET `nonmed`='$cash', `opd`='$cash' WHERE `code`='$code'");

        $elog="$aitemname|$code|Updated Cash Price|Old Cash Price: $bcash";
        mysqli_query($conn,"INSERT INTO `userlogs` (`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('$elog', '".base64_decode($xox)."', '".date("Y-m-d")."', '".date("H:i:s")."')");
      }
    }
  }
  else{
    if($aunit!='PHARMACY/MEDICINE'){
      if($aunit!='PHARMACY/SUPPLIES'){
        $cash=mysqli_real_escape_string($conn,$_POST['cash']);
        $charge=mysqli_real_escape_string($conn,$_POST['charge']);

        $bsql=mysqli_query($conn,"SELECT * FROM `productsmasterlist` WHERE `code`='$code'");
        $bcount=mysqli_num_rows($bsql);

        if($bcount=="0"){
          $xx+=1;
          mysqli_query($conn,"INSERT INTO `productsmasterlist` (`code`, `unitprice`, `philhealth`, `hmo`, `nonmed`, `company`, `opd`) VALUES ('$code', '$unitcost', '$charge', '$hmo', '$cash', '$charge', '$cash')");

          $elog="$aitemname|$code|Add New Price";
          mysqli_query($conn,"INSERT INTO `userlogs` (`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('$elog', '".base64_decode($xox)."', '".date("Y-m-d")."', '".date("H:i:s")."')");
        }
        else{
          $bfetch=mysqli_fetch_array($bsql);
          $bcharge=$bfetch['philhealth'];
          $bcash=$bfetch['opd'];
          $bhmo=$bfetch['hmo'];

          if($bcharge!=$charge){
            $xx+=1;
            mysqli_query($conn,"UPDATE `productsmasterlist` SET `philhealth`='$charge', `company`='$charge' WHERE `code`='$code'");

            $elog="$aitemname|$code|Updated Charge Price|Old Charge Price: $bcharge";
            mysqli_query($conn,"INSERT INTO `userlogs` (`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('$elog', '".base64_decode($xox)."', '".date("Y-m-d")."', '".date("H:i:s")."')");
          }

          if($bcash!=$cash){
            $xx+=1;
            mysqli_query($conn,"UPDATE `productsmasterlist` SET `nonmed`='$cash', `opd`='$cash' WHERE `code`='$code'");

            $elog="$aitemname|$code|Updated Cash Price|Old Cash Price: $bcash";
            mysqli_query($conn,"INSERT INTO `userlogs` (`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('$elog', '".base64_decode($xox)."', '".date("Y-m-d")."', '".date("H:i:s")."')");
          }
        }
      }
    }
  }

  $op4="";
  //-------------------------------------------------------------------------------------------------
  if(isset($_POST['opt41'])){$op4=$op4."-1|";}//disable pharmacy only
  if(isset($_POST['opt42'])){$op4=$op4."-2|";}//disable pharmacy opd only
  if(isset($_POST['opt43'])){$op4=$op4."-3|";}//disable csr2 only
  if(isset($_POST['opt44'])){$op4=$op4."-4|";}//disable billing only
  if(isset($_POST['opt45'])){$op4=$op4."-5|";}//disable ns1 only
  if(isset($_POST['opt46'])){$op4=$op4."-6|";}//disable ns2 only
  if(isset($_POST['opt47'])){$op4=$op4."-7|";}//disable ns3 only
  if(isset($_POST['opt48'])){$op4=$op4."-8|";}//disable ns4 only
  if(isset($_POST['opt49'])){$op4=$op4."-9|";}//disable ns5a only
  if(isset($_POST['opt410'])){$op4=$op4."-10|";}//disable nsb only
  if(isset($_POST['opt411'])){$op4=$op4."-11|";}//disable ns6 only
  if(isset($_POST['opt412'])){$op4=$op4."-12|";}//disable er only

  if(isset($_POST['opt499'])){$op4=$op4."-99|";}//disable in patient only
  if(isset($_POST['opt4100'])){$op4=$op4."-100|";}//disable out patient only

  if(isset($_POST['opt4bt'])){
    $opt4bt=mysqli_real_escape_string($conn,$_POST['opt4bt']);
    $op4=$op4.$opt4bt;
  }

  if($aop4!=$op4){
    $xx+=1;
    mysqli_query($conn,"UPDATE `receiving` SET `optset4`='$op4' WHERE `code`='$code'");

    $elog="$aitemname|$code|Updated Specified Disable or Enable|Old value: $aop4";
    mysqli_query($conn,"INSERT INTO `userlogs` (`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('$elog', '".base64_decode($xox)."', '".date("Y-m-d")."', '".date("H:i:s")."')");
  }
  //-------------------------------------------------------------------------------------------------

  if($xx==0){
echo "
<table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; left: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
  <tr>
    <td valign='middle'><div align='center' style='color: orange;font-weight: bold;'>No changes were made!</div></td>
  </tr>
</table>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='5;URL=../ms/?code=$code&xox=$xox'>";
  }
  else{
echo "
<table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; left: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
  <tr>
    <td valign='middle'><div align='center' style='color: blue;font-weight: bold;'>Saving Data...</div></td>
  </tr>
</table>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='1;URL=../ms/?code=$code&xox=$xox'>";
  }
}
else{
  $code=mysqli_real_escape_string($conn,$_GET['code']);
  $xox=mysqli_real_escape_string($conn,$_GET['xox']);

  $resql=mysqli_query($conn,"SELECT * FROM `receiving` WHERE `code`='$code'");
  if(mysqli_num_rows($resql)>0){
    $refetch=mysqli_fetch_array($resql);
    $description=$refetch['description'];
    $generic=$refetch['generic'];
    $lotno=$refetch['lotno'];
    $pnf=$refetch['pnf'];
    $tec=$refetch['testcode'];
    $gte=$refetch['gtestcode'];
    $op4=$refetch['optset4'];
    $unit=$refetch['unit'];

    if($pnf=="PNDF"){$ps1="selected";$ps2="";}
    else{$ps1="";$ps2="selected";}

    if($tec==0){$vs1="selected";$vs2="";}
    else if($tec==1){$vs1="";$vs2="selected";}

    if($gte==0){$ss1="selected";$ss2="";}
    else if($gte==1){$ss1="";$ss2="selected";}

    if($lotno=="S"){$prs1="selected";$prs2="";}
    else{$prs1="";$prs2="selected";}

    $cash=0;
    $charge=0;
    if(($unit=="PHARMACY/MEDICINE")||($unit=="PHARMACY/SUPPLIES")||($unit=="MEDICAL SURGICAL SUPPLIES")||($unit=="MEDICAL SUPPLIES")){
      if($lotno=="S"){
        $prmsql=mysqli_query($conn,"SELECT `philhealth`, `nonmed`, `opd`, `lotno` FROM `productsmasterlist` WHERE `code`='$code'");
        if(mysqli_num_rows($prmsql)>0){
          $prmfetch=mysqli_fetch_array($prmsql);
          $charge=$prmfetch['philhealth'];
          $cash=$prmfetch['opd'];
        }
        else{
          $charge=0;
          $cash=0;
        }
      }
    }
    else{
      $prmsql=mysqli_query($conn,"SELECT `philhealth`, `nonmed`, `opd`, `lotno` FROM `productsmasterlist` WHERE `code`='$code'");
      if(mysqli_num_rows($prmsql)>0){
        $prmfetch=mysqli_fetch_array($prmsql);
        $charge=$prmfetch['philhealth'];
        $cash=$prmfetch['opd'];
      }
      else{
        $charge=0;
        $cash=0;
      }
    }

    $opt41="";$opt42="";$opt43="";$opt44="";$opt45="";$opt46="";$opt47="";$opt48="";$opt49="";$opt410="";$opt411=""; $opt412="";$opt499="";$opt4100="";$opt4101="";$opt4102="";

    if((stripos($op4, "-1|") !== FALSE)){$opt41="checked";}//disable pharmacy only
    if((stripos($op4, "-2|") !== FALSE)){$opt42="checked";}//disable pharmacy opd only
    if((stripos($op4, "-3|") !== FALSE)){$opt43="checked";}//disable csr2 only
    if((stripos($op4, "-4|") !== FALSE)){$opt44="checked";}//disable billing only
    if((stripos($op4, "-5|") !== FALSE)){$opt45="checked";}//disable ns1 only
    if((stripos($op4, "-6|") !== FALSE)){$opt46="checked";}//disable ns2 only
    if((stripos($op4, "-7|") !== FALSE)){$opt47="checked";}//disable ns3 only
    if((stripos($op4, "-8|") !== FALSE)){$opt48="checked";}//disable ns4 only
    if((stripos($op4, "-9|") !== FALSE)){$opt49="checked";}//disable ns5a only
    if((stripos($op4, "-10|") !== FALSE)){$opt410="checked";}//disable ns5b only
    if((stripos($op4, "-11|") !== FALSE)){$opt411="checked";}//disable ns6 only
    if((stripos($op4, "-12|") !== FALSE)){$opt412="checked";}//disable er only

    if((stripos($op4, "-99|") !== FALSE)){$opt499="checked";}//disable in patient only
    if((stripos($op4, "-100|") !== FALSE)){$opt4100="checked";}//disable out patient only

    if(stripos($op4, "-101|") !== FALSE){$opt4bt1="checked";$opt4bt2="";$opt4bt3="";}//disable charge and tpl button
    else if(stripos($op4, "-102|") !== FALSE){$opt4bt1="";$opt4bt2="checked";$opt4bt3="";}//disable cash button
    else{$opt4bt1="";$opt4bt2="";$opt4bt3="checked";}

    if(($unit=="PHARMACY/SUPPLIES")||($unit=="MEDICAL SUPPLIES")||($unit=="MEDICAL SURGICAL SUPPLIES")){$genreq="";}else{$genreq="required";}

    if(isset($_GET['sdpt'])){
      if($_GET['sdpt']=="PHARMACY"){$alwe=0;}
      else{$alwe=0;}
    }
    else{$alwe=1;}

    if($alwe==0){$ro="readonly";}
    else{$ro="";}


echo "
<div align='center'>
  <form name='Save' method='post' class='form-container-Edit'>
    <table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td colspan='3'><div align='center' style='font-family: arial;font-weight: bold;color: blue;'>Edit Item</div></td>
      </tr>
      <tr>
        <td colspan='3' height='10'></td>
      </tr>
";

    if($unit=="PHARMACY/MEDICINE"){
echo "
      <tr>
        <td width='120'><div align='left' class='s14'>Generic Name</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='Generic Name' name='description' value='$description' autocomplete='off' required $ro /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Brand Name</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='Brand Name' name='generic' value='$generic' autocomplete='off' $genreq $ro /></td>
      </tr>
";
    }
    else{
echo "
      <tr>
        <td width='120'><div align='left' class='s14'>Description</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='Generic Name' name='description' value='$description' autocomplete='off' required $ro /></td>
      </tr>
      <input type='hidden' name='generic' value='$generic' />
";
    }

echo "
      <tr>
        <td><div align='left' class='s14'>PNDF</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td>
          <select name='pnf'>
            <option value='PNDF' $ps1>PNDF</option>
            <option value='NPNDF' $ps2>NON-PNDF</option>
          </select>
        </td>
      </tr>
";

    if(($unit=="PHARMACY/MEDICINE")||($unit=="PHARMACY/SUPPLIES")||($unit=="MEDICAL SURGICAL SUPPLIES")||($unit=="MEDICAL SUPPLIES")){
echo "
      <tr>
        <td><div align='left' class='s14'>VAT</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td>
          <select name='testcode'>
            <option value='0' $vs1>VATable</option>
            <option value='1' $vs2>Non-VAT</option>
          </select>
        </td>
      </tr>
";
    }
    else{
echo "
      <tr>
        <td><div align='left' class='s14'>MDRP</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td>
          <select name='testcode'>
            <option value='0' $vs1>NON-MDRP</option>
            <option value='1' $vs2>MDRP</option>
          </select>
        </td>
      </tr>
";
    }

echo "
      <tr>
        <td><div align='left' class='s14'>Status</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td>
          <select name='gtestcode'>
            <option value='0' $ss1>Active</option>
            <option value='1' $ss2>Disabled</option>
          </select>
        </td>
      </tr>
";

    if(($unit=="PHARMACY/MEDICINE")||($unit=="PHARMACY/SUPPLIES")||($unit=="MEDICAL SURGICAL SUPPLIES")||($unit=="MEDICAL SUPPLIES")){
      if($alwe==1){
echo "
      <tr>
        <td><div align='left' class='s14'>Price Type</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td>
          <select name='lotno'>
            <option value='S' $prs1>Special</option>
            <option value='M' $prs2>Mark-Up</option>
          </select>
        </td>
      </tr>
";
      }
      else{
echo "
      <input type='hidden' name='lotno' value='$lotno' />
";
      }
    }
    else{
      if($unit=="LABORATORY"){
echo "
      <tr>
        <td><div align='left' class='s14'>Test Type</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='text' placeholder='Test Type' name='lotno' value='$lotno' autocomplete='off' /></td>
      </tr>
";
      }
      else{
echo "
      <input type='hidden' name='lotno' value='$lotno' />
";
      }
    }

echo "
      <tr>
        <td colspan='3'><div align='left' style='font-family: arial;font-size: 12px;font-weight: bold;color: #769FFF;'>*If Price Type is set to Special</div></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Cash</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='number' step='0.01' placeholder='Cash Price' name='cash' value='$cash' autocomplete='off' $ro /></td>
      </tr>
      <tr>
        <td><div align='left' class='s14'>Charge</div></td>
        <td width='10'><div align='center' class='s14'>:</div></td>
        <td><input type='number' step='0.01' placeholder='Charge Price' name='charge' value='$charge' autocomplete='off' $ro /></td>
      </tr>
      <tr>
        <td colspan='3' class='b1' style='padding-top: 5px;'><div align='left'>
          <table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td style='border-top-width: 1px;border-top-color: #000000;border-top-style: solid;'><div align='left' style='padding: 10px 3px 3px 3px;font-family: arial;font-size: 14px;font-weight: bold;color: violet;'>DISABLE ITEM FOR SPECIFIC DEPARTMENT</td>
            </tr>
            <tr>
              <td><table border='0' width='100%' cellspadding='0' cellspacing='0'>
                <tr>
                  <td><label><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;'><input type='checkbox' name='opt41' value='-1|' $opt41 /></div></td>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;font-family: arial;font-size: 10px;'>PHARMACY</div></td>
                    </tr>
                  </table></label></td>
                  <td><label><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;'><input type='checkbox' name='opt42' value='-2|' $opt42 /></div></td>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;font-family: arial;font-size: 10px;'>PHARMACY OPD</div></td>
                    </tr>
                  </table></label></td>
                  <td><label><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;'><input type='checkbox' name='opt43' value='-3|' $opt43 /></div></td>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;font-family: arial;font-size: 10px;'>CSR2</div></td>
                    </tr>
                  </table></label></td>
                  <td><label><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;'><input type='checkbox' name='opt44' value='-4|' $opt44 /></div></td>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;font-family: arial;font-size: 10px;'>BILLING</div></td>
                    </tr>
                  </table></label></td>
                </tr>
                <tr>
                  <td><label><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;'><input type='checkbox' name='opt412' value='-12|' $opt412 /></div></td>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;font-family: arial;font-size: 10px;'>ER</div></td>
                    </tr>
                  </table></label></td>
                  <td><label><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;'><input type='checkbox' name='opt45' value='-5|' $opt45 /></div></td>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;font-family: arial;font-size: 10px;'>NS 1</div></td>
                    </tr>
                  </table></label></td>
                  <td><label><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;'><input type='checkbox' name='opt46' value='-6|' $opt46 /></div></td>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;font-family: arial;font-size: 10px;'>NS 2</div></td>
                    </tr>
                  </table></label></td>
                  <td><label><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;'><input type='checkbox' name='opt47' value='-7|' $opt47 /></div></td>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;font-family: arial;font-size: 10px;'>NS 3</div></td>
                    </tr>
                  </table></label></td>
                </tr>
                <tr>
                  <td><label><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;'><input type='checkbox' name='opt48' value='-8|' $opt48 /></div></td>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;font-family: arial;font-size: 10px;'>NS 4</div></td>
                    </tr>
                  </table></label></td>
                  <td><label><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;'><input type='checkbox' name='opt49' value='-9|' $opt49 /></div></td>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;font-family: arial;font-size: 10px;'>NS 5A</div></td>
                    </tr>
                  </table></label></td>
                  <td><label><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;'><input type='checkbox' name='opt410' value='-10|' $opt410 /></div></td>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;font-family: arial;font-size: 10px;'>NS 5B</div></td>
                    </tr>
                  </table></label></td>
                  <td><label><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;'><input type='checkbox' name='opt411' value='-11|' $opt411 /></div></td>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;font-family: arial;font-size: 10px;'>NS 6</div></td>
                    </tr>
                  </table></label></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td style='border-top-width: 1px;border-top-color: #000000;border-top-style: solid;'><div align='left' style='padding: 10px 3px 3px 3px;font-family: arial;font-size: 14px;font-weight: bold;color: violet;'>DISABLE FOR SPECIFIC PATIENT TYPE</td>
            </tr>
            <tr>
              <td><div align='left'><table border='0' cellspadding='0' cellspacing='0'>
                <tr>
                  <td><label><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;'><input type='checkbox' name='opt499' value='-99|' $opt499 /></div></td>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;font-family: arial;font-size: 10px;'>IN PATIENT</div></td>
                    </tr>
                  </table></label></td>
                  <td><label><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;'><input type='checkbox' name='opt4100' value='-100|' $opt4100 /></div></td>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;font-family: arial;font-size: 10px;'>OUT PATIENT</div></td>
                    </tr>
                  </table></label></td>
                </tr>
              </table></div></td>
            </tr>
            <tr>
              <td style='border-top-width: 1px;border-top-color: #000000;border-top-style: solid;'><div align='left' style='padding: 10px 3px 3px 3px;font-family: arial;font-size: 14px;font-weight: bold;color: violet;'>DISABLE BUTTON</td>
            </tr>
            <tr>
              <td><div align='left'><table border='0' cellspadding='0' cellspacing='0'>
                <tr>
                  <td><label><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;'><input type='radio' name='opt4bt' value='-101|' $opt4bt1 /></div></td>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;font-family: arial;font-size: 10px;'>DISABLE CHARGE & TPL</div></td>
                    </tr>
                  </table></label></td>
                  <td><label><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;'><input type='radio' name='opt4bt' value='-102|' $opt4bt2 /></div></td>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;font-family: arial;font-size: 10px;'>DISABLE CASH</div></td>
                    </tr>
                  </table></label></td>
                  <td><label><table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;'><input type='radio' name='opt4bt' value='' $opt4bt3 /></div></td>
                      <td><div align='left' style='padding: 3px 3px 3px 3px;font-family: arial;font-size: 10px;'>ENABLE CASH, CHARGE & TPL </div></td>
                    </tr>
                  </table></label></td>
                </tr>
              </table></div></td>
            </tr>
          </table>
        </div></td>
      </tr>
      <tr>
        <td colspan='3' height='10'></td>
      </tr>
      <tr>
        <td colspan='3'><table width='100%' border='0' cellpadding='0' cellspacing='0'>
          <tr>
            <td width='49%'><div align='right'><button type='button' class='btn cancel' onclick='closeme()'>Close</button></div></td>
            <td width='2%'></td>
            <td width='49%'><div align='left'><button type='submit' class='btn' name='save'>Save</button></div></td>
          </tr>
        </table></td>
      </tr>
    </table>
  <input type='hidden' name='code' value='$code' />
  <input type='hidden' name='xox' value='$xox' />
  </form>
</div>
";
  }
  else{
echo "

";
echo "
<table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; left: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
  <tr>
    <td valign='middle'><div align='center' style='color: #FF0000;font-weight: bold;'>ITEM DOES NOT EXISTS!!!</div></td>
  </tr>
</table>
";
  }
}

echo "<META HTTP-EQUIV='Refresh'CONTENT='300;URL=Close.php'>";
?>

<script>
  function closeme() {
    window.close();
  }
</script>

</body>
</html>
