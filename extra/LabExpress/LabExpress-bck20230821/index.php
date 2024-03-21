<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="../Resources/Favicon/favicon.png" type="image/png" />
<link rel="shortcut icon" href="../Resources/Favicon/favicon.png" type="image/png" />
<?php
if(!isset($_POST['cres'])){
echo "
<title>SELECT TEST</title>
";
}
else{
echo "
<title>INPUT RESULT/S</title>
";
}
?>
<link href="../Resources/CSS/mystyle.css" rel="stylesheet" type="text/css" />
<!-- animate CSS-->
<style style="text/css">
.hoverTable{width:100%; border-collapse:collapse;}
.hoverTable td{padding:7px; border:#4e95f4 1px solid;}

.div-container input[type=text], .div-container input[type=password] {width: 450px;height: 30px;padding: 7px;margin: 5px 0 5px 0;border: none;background: #eee;border-radius: 10px;font-size: 18px;font-weight: bold;border: 2px solid #000000;}
.div-container select {height: 40px;padding: 7px;margin: 5px 0 5px 0;border: none;background: #eee;}
.div-container input[type=text]:focus, .div-container input[type=password]:focus, .div-container select:focus {background-color: #ddd;outline: none;}
.div-container .btn {background-color: #8ebf42;color: #fff;padding: 5px 10px;border: none;cursor: pointer;opacity: 0.8;border-radius: 5px;}
.div-container .cancel {background-color: #cc0000;}
.div-container .tpl {background-color: #821C97;}
.div-container .btn:hover, .open-button:hover {opacity: 1;}

/* Define the hover highlight color for the table row */
.hoverTable tr:hover {background-color: #ffff99;}
</style>
<script>
function changeTypeInput(inputElement){
 inputElement.type="password"
}
</script>
</head>

<body>
<?php
ini_set("display_errors","On");
include("../Settings.php");

$caseno=mysqli_real_escape_string($mycon1,$_GET['caseno']);
$srefno=mysqli_real_escape_string($mycon1,$_GET['refno']);
$code=mysqli_real_escape_string($mycon1,$_GET['code']);
$stype=mysqli_real_escape_string($mycon1,$_GET['type']);
$batchno=mysqli_real_escape_string($mycon1,$_GET['batchno']);
$user=mysqli_real_escape_string($mycon1,$_GET['user']);

$setip=$_SERVER['HTTP_HOST'];

if(!isset($_POST['cres'])){
echo "
<div align='left' style='padding: 10px;'>
  <form method='post'>
    <table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td>
          <table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td class='t2 b2 l2'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 12px;'>#</div></td>
              <td class='t2 b2 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 12px;'><input type='checkbox' class='checkall' id='select_all' /></div></td>
              <td class='t2 b2 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 12px;'>Description</div></td>
              <td class='t2 b2 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 12px;'>Type</div></td>
              <td class='t2 b2 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 12px;'>Date Requested</div></td>
              <td class='t2 b2 l1 r2'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 12px;'>Batch No.</div></td>
            </tr>
";

$a=0;
$asql=mysqli_query($mycon1,"SELECT p.`refno`, p.`productcode`, p.`productdesc`, p.`invno`, p.`batchno`, p.`datearray`, l.`test` FROM `productout` p, `labtest` l WHERE p.`caseno`='$caseno' AND p.`refno`=l.`refno` AND l.`test`='$stype' AND (p.`status`='Approved' OR p.`status`='PAID') AND p.`terminalname` NOT LIKE 'Testdone' AND p.`productsubtype`='LABORATORY'");
while($afetch=mysqli_fetch_array($asql)){
  $refno=$afetch['refno'];
  $pcode=$afetch['productcode'];
  $pdesc=$afetch['productdesc'];
  $timer=$afetch['invno'];
  $dater=$afetch['datearray'];
  $test=$afetch['test'];
  $a++;

  $ckp="";
  if($srefno==$refno){$ckp="checked";}

echo "
            <tr>
              <td class='b1 l2'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-size: 14px;'>$a</div></td>
              <td class='b1 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-size: 14px;'><input type='checkbox' name='refno$a' class='case' value='$refno' $ckp /></div></td>
              <td class='b1 l1'><div align='left' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-size: 14px;'>$pdesc</div></td>
              <td class='b1 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-size: 14px;'>$test</div></td>
              <td class='b1 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-size: 14px;'>".date("M d, Y h:i A",strtotime("$dater $timer"))."</div></td>
              <td class='b1 l1 r2'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-size: 14px;'>$batchno</div></td>
            </tr>
";
}

echo "
            <tr>
              <td class='t1' colspan='6'></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td height='10'></td>
      </tr>
      <tr>
        <td><div align='center'><input type='submit' name='cres' value='Create Result' /></div></td>
      </tr>
    </table>
    <input type='hidden' name='count' value='$a' />
  </form>
</div>
";
}
else{
  if(!isset($_POST['sres'])){
    $count=mysqli_real_escape_string($mycon1,$_POST['count']);

    include("agegroup.php");

echo "
<a href='?caseno=$caseno&refno=$srefno&code=$code&type=$stype&batchno=$batchno&user=$user'><input type='button' value='&lt;&lt; Back' /></a><br /><br />
";

if($stype=="hematology"){$pref="HE";}
else if($stype=="chemistry"){$pref="CH";}
else if($stype=="serology"){$pref="SE";}
else{$pref="OT";}

echo "
<div align='left'>
  <form method='post'>
    <table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td class='t2 b2 l2' colspan='2'><div align='left' style='padding: 0 3px 0 3px;color: #0784C0;font-family: arial;font-weight: bold;font-size: 14px;'>Laboratory No.</div></td>
        <td class='t2 b2 l1 r2' colspan='2'><div align='left' style='padding: 5px;'><input type='text' name='labno' placeholder='Laboratory Number' value='' autofocus required /></div></td>
      <tr>
      <tr>
        <td class='b2 l2' colspan='2'><div align='left' style='padding: 0 3px 0 3px;color: #0784C0;font-family: arial;font-weight: bold;font-size: 14px;'>Print Batch No.</div></td>
        <td class='b2 l1 r2' colspan='2'><div align='left' style='padding: 5px;'><input type='text' name='printbatchno' placeholder='Laboratory Number' value='$pref".date("YmdHis")."' required /></div></td>
      <tr>
      <tr>
        <td class='b2 l2' colspan='2'><div align='left' style='padding: 0 3px 0 3px;color: #0784C0;font-family: arial;font-weight: bold;font-size: 14px;'>Pathologist</div></td>
        <td class='b2 l1 r2' colspan='2'><div align='left' style='padding: 5px;'>
          <select name='pt' style='width: 100%' required>
            <option value='334'>NENA C. SALCEDO - LINGAYON, MD, FPSP - 092052</option>
          </select>
        </div></td>
      <tr>
      <tr>
        <td class='b2 l2' colspan='2'><div align='left' style='padding: 0 3px 0 3px;color: #0784C0;font-family: arial;font-weight: bold;font-size: 14px;'>Med. Tech</div></td>
        <td class='b2 l1 r2' colspan='2'><div align='left' style='padding: 5px;'>
          <select name='mt' style='width: 100%' required>
            <option></option>
";

$mtsql=mysqli_query($mycon1,"SELECT `name` , `empid` FROM `nsauth` WHERE `station`='LABORATORY' AND `Access`='99' ORDER BY `name`");
while($mtfetch=mysqli_fetch_array($mtsql)){
echo "
            <option value='".$mtfetch['empid']."'>".mb_strtoupper($mtfetch['name'])."</option>
";
}

echo "
          </select>
        </div></td>
      <tr>
      <tr>
        <td class='b2 l2' colspan='2'><div align='left' style='padding: 0 3px 0 3px;color: #0784C0;font-family: arial;font-weight: bold;font-size: 14px;'>Physician</div></td>
        <td class='b2 l1 r2' colspan='2'><div align='left' style='padding: 5px;'>
          <select name='ap' style='width: 100%' required>
            <option></option>
";

$dfsql=mysqli_query($mycon1,"SELECT `code`, `name` FROM `docfile` ORDER BY `name`");
while($dffetch=mysqli_fetch_array($dfsql)){
$dccode=$dffetch['code'];
$dcname=mb_strtoupper($dffetch['name']);

if($ap==$dccode){$dcops="selected";}else{$dcops="";}

echo "
            <option value='$dccode' $dcops>$dcname</option>
";
}
echo "
          </select>
        </div></td>
      <tr>
      <tr>
        <td colspan='3' height='10'></td>
      <tr>
      <tr>
        <td class='t2 b1 l2'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;'>#</div></td>
        <td class='t2 b1 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;'>Test</div></td>
        <td class='t2 b1 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;'>Result</div></td>
        <td class='t2 b1 l1 r2'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;'>Normal Values</div></td>
      </tr>
";

    $x=0;
    for($z=0;$z<=$count;$z++){
      $rl="refno".$z;
      if(isset($_POST[$rl])){
        $refno=$_POST[$rl];
        $x++;

        $asql=mysqli_query($mycon1,"SELECT `productcode`, `productdesc` FROM `productout` WHERE `refno`='$refno'");
        $afetch=mysqli_fetch_array($asql);
        $pcode=$afetch['productcode'];
        $desc=$afetch['productdesc'];

echo "
      <tr>
        <td class='t1 b2 l2 r2' colspan='4'><div align='left' style='color: blue;font-family: arial;font-weight: bold;font-size: 16px;padding: 3px;'>$refno --> ".$desc."</div></td>
      </tr>
";

        $b=0;
        $bsql=mysqli_query($mycon1,"SELECT * FROM `labnormalvalues` WHERE `code`='$pcode' AND `stat`='1'");
        while($bfetch=mysqli_fetch_array($bsql)){
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
          $unit=mysqli_real_escape_string($mycon1,$bfetch['unit']);
          $grp=$bfetch['grp'];
          $type=$bfetch['type'];
          $header=$bfetch['header'];
          $b++;

          if($amll!=""){$amll=$amll." - ";}else{$amll="";}
          if($amul!=""){$amul=$amul." ";}else{$amul="";}
          if($afll!=""){$afll=$afll." - ";}else{$afll="";}
          if($aful!=""){$aful=$aful." ";}else{$aful="";}
          if($cll!=""){$cll=$cll." - ";}else{$cll="";}
          if($cul!=""){$cul=$cul." ";}else{$cul="";}
          if($nll!=""){$nll=$nll." - ";}else{$nll="";}
          if($nul!=""){$nul=$nul." ";}else{$nul="";}

          if($unit!=""){$unitd=" ".$unit;}else{$unitd="";}

          if($displaynv!=""){
            $nv=$displaynv.$unitd;
          }
          else{
            if(($grp==1)||($grp==4)){
              if($agro=="A"){$nv=$amll.$amul.$unit;}
              else if($agro=="AF"){$nv=$afll.$aful.$unit;}
              else if($agro=="C"){$nv=$cll.$cul.$unit;}
              else if($agro=="N"){$nv=$nll.$nul.$unit;}
              else{$nv=$amll.$amul.$unit;}
            }
            else if($grp==3){
              $setot=substr_count($others,"|");
              $ots=preg_split("/\|/",$others);

              for($otz=0;$otz<$setot;$otz++){
                $otss=preg_split("/\*/",$ots[$otz]);
                $otagl=$otss[0];
                $otagh=$otss[1];
                $otll=$otss[2];
                $otul=$otss[3];

                if(($ay>=$otagl)&&($ay<=$otagh)){
                  $nv=$otll." - ".$otul.$unitd;
                }
              }
            }
            else{
              $nv="";
            }
          }

          if($grp==1){$intype="type='number' step='0.001'";}
          else{$intype="type='text'";}

echo "
      <tr>
        <td class='b1 l2'><div align='left' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 14px;'>$b</div></td>
        <td class='b1 l1'><div align='left' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 14px;'>$testname</div></td>
        <td class='b1 l1'><div align='center' style='padding: 5px;'>
";

if($grp==2){
echo "
          <input type='hidden' name='prf-$x-$b' value='' />
          <table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td style='padding-right: 5px;'>
                <select name='result-$x-$b' autofocus required>
                  <option value=''></option>
";

  $setzm=substr_count($others,"|");
  $cs=preg_split("/\|/",$others);

  for($cz=0;$cz<$setzm;$cz++){
echo "
                  <option value='".$cs[$cz]."'>".$cs[$cz]."</option>
";
  }

echo "
                </select>
              </td>
            </tr>
          </table>
";
}
else if($grp==4){
echo "
          <input type='hidden' name='prf-$x-$b' value='' />
          <input type='text' name='result-$x-$b' placeholder='Type Result' value='' autofocus />
";
}
else{
echo "
          <table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td style='padding-right: 5px;'>
                <select name='prf-$x-$b'>
                  <option value=''></option>
                  <option value='0'>&lt;</option>
                  <option value='9999999'>&gt;</option>
                </select>
              </td>
              <td>
                <input $intype name='result-$x-$b' placeholder='Input Result' value='' autofocus />
              </td>
            </tr>
          </table>
";
}

echo "
          <input type='hidden' name='no-$x-$b' value='$no' />
          <input type='hidden' name='ll-$x-$b' value='$no' />
          <input type='hidden' name='ul-$x-$b' value='$no' />
          <input type='hidden' name='un-$x-$b' value='$no' />
        </div></td>
        <td class='b1 l1 r2'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 14px;'>$nv</div></td>
      </tr>
";
        }
echo "
    <input type='hidden' name='bval-$x' value='$b' />
    <input type='hidden' name='itmrefno-$x' value='$refno' />
    <input type='hidden' name='desc-$x' value='$desc' />
";
      }
    }

echo "
      <tr>
        <td colspan='3' height='10'></td>
      <tr>
      <tr>
        <td class='t2 b2 l2' colspan='2'><div align='left' style='padding: 0 3px 0 3px;color: #0784C0;font-family: arial;font-weight: bold;font-size: 14px;'>Remarks</div></td>
        <td class='t2 b2 l1 r2' colspan='2'><div align='center' style='padding: 5px;'>
          <textarea name='remarks' style='width: 98%;border-radius: 4px;height: 50px;'></textarea>
        </div></td>
      <tr>
      <tr>
        <td class='t1' colspan='4' height='40'><div align='center'><input type='submit' name='sres' value='Save' /></div></td>
      </tr>
    </table>
    <input type='hidden' name='xval' value='$x' />
    <input type='hidden' name='cres' value='' />
    <input type='hidden' name='agro' value='$agro' />
    <input type='hidden' name='patid' value='$patientidno' />
  </form>
</div>
";
  }
  else{
    include("agegroup.php");

    $xval=mysqli_real_escape_string($mycon1,$_POST['xval']);
    $agro=mysqli_real_escape_string($mycon1,$_POST['agro']);

    $patid=mysqli_real_escape_string($mycon1,$_POST['patid']);
    $labno=trim(mysqli_real_escape_string($mycon1,$_POST['labno']));
    $ap=mysqli_real_escape_string($mycon1,$_POST['ap']);
    $mt=mysqli_real_escape_string($mycon1,$_POST['mt']);
    $pt=mysqli_real_escape_string($mycon1,$_POST['pt']);
    $printbatchno=mysqli_real_escape_string($mycon1,$_POST['printbatchno']);
    $remarks=mb_strtoupper(trim(mysqli_real_escape_string($mycon1,$_POST['remarks'])));

    $redtime=0;
    for($q=1;$q<=$xval;$q++){
      $bval="bval-$q";
      $bvaln=mysqli_real_escape_string($mycon1,$_POST[$bval]);

      $itmr="itmrefno-$q";
      $itmrefno=mysqli_real_escape_string($mycon1,$_POST[$itmr]);

      $itmd="desc-$q";
      $itmdesc=mysqli_real_escape_string($mycon1,$_POST[$itmd]);

      $itmerr=0;
      for($w=1;$w<=$bvaln;$w++){
        $nol="no-$q-$w";
        $resl="result-$q-$w";
        $prfl="prf-$q-$w";

        $non=mysqli_real_escape_string($mycon1,$_POST[$nol]);
        $resultn=trim(mysqli_real_escape_string($mycon1,$_POST[$resl]));
        $prfn=mysqli_real_escape_string($mycon1,$_POST[$prfl]);

        if($prfn!=""){$resultnd=$prfn;}
        else{$resultnd=$resultn;}

        $bsql=mysqli_query($mycon1,"SELECT `no`, `code`, `testname`, `testabr`, `grp`, `sort`, `amll`, `amul`, `afll`, `aful`, `cll`, `cul`, `nll`, `nul`, `displaynv`, `others`, `unit`, `type`, `header`, CAST(`amll` AS DECIMAL(10,3)) AS `amlld`, CAST(`amul` AS DECIMAL(10,3)) AS `amuld`, CAST(`afll` AS DECIMAL(10,3)) AS `aflld`, CAST(`aful` AS DECIMAL(10,3)) AS `afuld`, CAST(`cll` AS DECIMAL(10,3)) AS `clld`, CAST(`cul` AS DECIMAL(10,3)) AS `culd`, CAST(`nll` AS DECIMAL(10,3)) AS `nlld`, CAST(`nul` AS DECIMAL(10,3)) AS `nuld` FROM `labnormalvalues` WHERE `no`='$non' AND `stat`='1'");
        $bfetch=mysqli_fetch_array($bsql);
        $lnvno=$bfetch['no'];
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
        $unit=mysqli_real_escape_string($mycon1,$bfetch['unit']);
        $grp=$bfetch['grp'];
        $type=$bfetch['type'];
        $header=$bfetch['header'];

        $amlld=$bfetch['amlld'];
        $amuld=$bfetch['amuld'];
        $aflld=$bfetch['aflld'];
        $afuld=$bfetch['afuld'];
        $clld=$bfetch['clld'];
        $culd=$bfetch['culd'];
        $nlld=$bfetch['nlld'];
        $nuld=$bfetch['nuld'];

        if($unit!=""){$unitd=" ".$unit;}else{$unitd="";}

        if($grp==1){
          if($agro=="A"){$nvll=$amll;$nvul=$amul;$nvlld=$amlld;$nvuld=$amuld;}
          else if($agro=="AF"){$nvll=$afll;$nvul=$aful;$nvlld=$aflld;$nvuld=$afuld;}
          else if($agro=="C"){$nvll=$cll;$nvul=$cul;$nvlld=$clld;$nvuld=$culd;}
          else if($agro=="N"){$nvll=$nll;$nvul=$nul;$nvlld=$nlld;$nvuld=$nuld;}
          else{$nvll=$amll;$nvul=$amul;$nvlld=$amlld;$nvuld=$amuld;}
        }
        else if($grp==3){
          $setot=substr_count($others,"|");
          $ots=preg_split("/\|/",$others);

          $nvll="";$nvul="";$nvlld="";$nvuld="";

          for($otz=0;$otz<$setot;$otz++){
            $otss=preg_split("/\*/",$ots[$otz]);
            $otagl=$otss[0];
            $otagh=$otss[1];
            $otll=$otss[2];
            $otul=$otss[3];

            if(($ay>=$otagl)&&($ay<=$otagh)){
              $nv=$otll." - ".$otul.$unitd;
              $nvll=$otll;$nvul=$otul;$nvlld=$otll;$nvuld=$otul;
            }
          }
        }
        else{
          $nvll="";$nvul="";$nvlld="";$nvuld="";
        }

        if($resultn!=""){
          if($type==1){
            if(($nvll!="")&&($nvul!="")){
              if($resultnd<$nvlld){$suf="L";$sufd=" (L)";}
              else if($resultnd>$nvuld){$suf="H";$sufd=" (H)";}
              else{$suf="";$sufd="";}
            }
            else{
              $suf="";$sufd="";
            }
          }
          else{
            $suf="";$sufd="";
          }
        }
        else{
          $suf="";$sufd="";
        }


        if($displaynv!=""){
          $dispnv=$displaynv;
        }
        else{
          if(($nvll!="")&&($nvul!="")){$dispnv=trim("$nvll - $nvul $unit");}
          else{$dispnv="";}
        }

        //echo $testname." --> ".$resultn.$sufd." --> ".$nvll." - ".$nvul." ".$unit."<br />";
        //echo "SELECT * FROM `labresults` WHERE `refno`='$srefno' AND `lnvno`='$lnvno' AND `caseno`='$caseno'<br />";
        $ckinsql=mysqli_query($mycon1,"SELECT * FROM `labresults` WHERE `refno`='$itmrefno' AND `lnvno`='$lnvno' AND `caseno`='$caseno'");
        if(mysqli_num_rows($ckinsql)==0){
          //echo "INSERT INTO `labresults` (`refno`, `code`, `label`, `caseno`, `patid`, `labno`, `ap`, `mt`, `pt`, `printbatchno`, `lnvno`, `test`, `preresult`, `result`, `suf`, `nvll`, `nvul`, `unit`, `dispnv`, `remarks`, `dtrec`, `user`) VALUES ('$itmrefno', '$code', '$itmdesc', '$caseno', '$patid', '$labno', '$ap', '$mt', '$pt', '$printbatchno', '$lnvno', '$testname', '$prfn', '$resultn', '$suf', '$nvll', '$nvul', '$unit', '$dispnv', '$remarks', '".date("Y-m-d H:i:s")."', '".base64_decode($user)."')<br />";
          mysqli_query($mycon1,"INSERT INTO `labresults` (`refno`, `code`, `label`, `caseno`, `patid`, `labno`, `ap`, `mt`, `pt`, `printbatchno`, `lnvno`, `test`, `preresult`, `result`, `suf`, `nvll`, `nvul`, `unit`, `dispnv`, `remarks`, `dtrec`, `user`) VALUES ('$itmrefno', '$code', '$itmdesc', '$caseno', '$patid', '$labno', '$ap', '$mt', '$pt', '$printbatchno', '$lnvno', '$testname', '$prfn', '$resultn', '$suf', '$nvll', '$nvul', '$unit', '$dispnv', '$remarks', '".date("Y-m-d H:i:s")."', '".base64_decode($user)."')");
          //echo "Inserted<br />";
        }
        else{
          //echo "Already Inserted<br />";
          $itmerr+=1;
        }
      }

      if($itmerr==0){
        echo "UPDATE `productout` SET `terminalname`='Testdone' WHERE `refno`='$itmrefno'<br /><br />";
        echo "<span style='color: #0784C0;'>&quot;".$itmdesc."&quot; RESULTS RECORDED SUCCESSFULLY!.</span><br />";
        //mysqli_query($mycon1,"UPDATE `productout` SET `terminalname`='Testdone' WHERE `refno`='$itmrefno'");
      }
      else{
        echo "<span style='color: #FF0000;'>&quot;".$itmdesc."&quot; ALREADY TEST DONE!.</span><br />";
        $redtime=5;
      }
    }$redtime=5;

    echo "<META HTTP-EQUIV='Refresh'CONTENT='$redtime;URL=PrintResult/?caseno=$caseno&patid=$patid&printbatchno=$printbatchno&stype=$stype&asd=$user'>";
  }
}
?>

<!-- jQuery -->
<script src='../Resources/JS/jquery.min.js'></script>
<script language="javascript">
  $(function(){
    // add multiple select / deselect functionality
    $("#select_all").click(function () {
      $('.case').attr('checked', this.checked);
    });

    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
      if($(".case").length == $(".case:checked").length) {
        $("#select_all").attr("checked", "checked");
      }
      else {
        $("#select_all").removeAttr("checked");
      }
    });
  });
</script>
</body>
</html>
