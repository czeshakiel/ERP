<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="../../Resources/Favicon/favicon.png" type="image/png" />
<link rel="shortcut icon" href="../../Resources/Favicon/favicon.png" type="image/png" />
<title>NORMAL VALUES</title>
<link href="../../Resources/CSS/mystyle.css" rel="stylesheet" type="text/css" />
<!-- Bootstrap core CSS-->
<link href="../../Resources/assets/css/bootstrap.min.css" rel="stylesheet"/>
<!-- animate CSS-->
<link href="../../Resources/assets/css/animate.css" rel="stylesheet" type="text/css"/>
<!-- Icons CSS-->
<link href="../../Resources/assets/css/icons.css" rel="stylesheet" type="text/css"/>
<!-- Custom Style-->
<!-- link href="assets/css/app-style.css" rel="stylesheet"/ -->
<style style="text/css">
.hoverTable{width:100%; border-collapse:collapse;}
.hoverTable td{padding:7px; border:#4e95f4 1px solid;}

.div-container input[type=text], .div-container input[type=password] {width: 450px;height: 30px;padding: 7px;margin: 5px 0 5px 0;border: none;background: #eee;border-radius: 10px;font-size: 18px;font-weight: bold;border: 2px solid #000000;}
.div-container select {height: 40px;padding: 7px;margin: 5px 0 5px 0;border: none;background: #eee;}
.div-container input[type=text]:focus, .div-container input[type=password]:focus, .div-container select:focus {background-color: #ddd;outline: none;}
.div-container .btn {background-color: #8ebf42;color: #fff;font-weight: bold;font-size: 11px;height: 30px;width: 30px;border: none;cursor: pointer;opacity: 0.8;border-radius: 3px;}
.div-container .cancel {background-color: #cc0000;}
.div-container .tpl {background-color: #821C97;}
.div-container .btn:hover, .open-button:hover {opacity: 1;}

.btnadd {background-color: #1E8449 ;color: #FFFFFF;font-weight: bold;font-size: 11px;padding: 5px 10px;border: none;cursor: pointer;opacity: 0.8;border-radius: 4px;}
.btnadd:hover {opacity: 1;}
.btnreload {background-color: #9709C9;color: #FFFFFF;font-weight: bold;font-size: 11px;padding: 5px 10px;border: none;cursor: pointer;opacity: 0.8;border-radius: 4px;}
.btnreload:hover {opacity: 1;}
.btnback {background-color: #0995C9;color: #FFFFFF;font-weight: bold;font-size: 11px;padding: 5px 10px;border: none;cursor: pointer;opacity: 0.8;border-radius: 4px;}
.btnback:hover {opacity: 1;}

/* Define the hover highlight color for the table row */
.hoverTable tr:hover {background-color: #ffff99;}
</style>
<script>
function changeTypeInput(inputElement){
 inputElement.type="password"
}
function placeFocus() {
if (document.forms.length > 0) {
var field = document.forms[0];
for (i = 0; i < field.length; i++) {
if ((field.elements[i].type == "text") || (field.elements[i].type == "textarea") || (field.elements[i].type.toString().charAt(0) == "s")) {
document.forms[0].elements[i].focus();
break;
         }
      }
   }
}
</script>
</head>

<body>
<?php
ini_set("display_errors","On");
include("../../../main/class.php");

$scode=mysqli_real_escape_string($conn,$_GET['scode']);
$stype=mysqli_real_escape_string($conn,$_GET['type']);

$setip=$_SERVER['HTTP_HOST'];

$asql=mysqli_query($conn,"SELECT `itemname` FROM `receiving` WHERE `code`='$scode'");
$afetch=mysqli_fetch_array($asql);
$itmn=mb_strtoupper($afetch['itemname']);

echo "
<div align='left' style='padding: 10px;'>
  <table border='0' width='100%' cellpadding='0' cellspacing='0'>
    <tr>
      <td><div align='left'><a href='../LabList/?type=$stype'><button class='btnback' style='height: 28px;'>&#8701; Back</button></a></div></td>
    </tr>
    <tr>
      <td height='5'></td>
    </tr>
    <tr>
      <td style='padding: 0 0 5px 0;'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
          <td width='50%'><div align='left' style='font-family: arial;font-size: 18px;font-weight: bold;color: blue;'>$itmn</div></td>
          <td width='50%'><div align='right'>
            <table border='0' cellpadding='0' cellspacing='0'>
              <tr>
                <td><a href='?scode=$scode&type=$stype'><button class='btnreload' style='height: 28px;' title='Reload Page'>&#8635; Reload Page</button></a></td>
                <td width='2'></td>
                <td><button class='btnadd' style='height: 28px;width: 28px;'"; ?> onclick="<?php echo "window.open('AENV.php?code=$scode', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=10,left=400,width=450,height=710');";?>" <?php echo ">&#10010;</button></td>
              </tr>
            </table>
          </div></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height='5'></td>
    </tr>
    <tr>
      <td>
        <table border='0' width='100%' cellpadding='0' cellspacing='0'>
          <tr>
            <td class='t2 b2 l2'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;'>#</div></td>
            <td class='t2 b2 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;'>Test Name</div></td>
            <!-- td class='t2 b2 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;' title='Abbreviated Exam Name'>Abr.</div></td -->
            <td class='t2 b2 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;' title='Sorting'>Sort</div></td>
            <td class='t2 b2 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;' title='Set Normal Value/s'>Set NV</div></td>
            <td class='t2 b2 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;' title='Display Normal Value/s'>Display NV</div></td>
            <td class='t2 b2 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;' title='Unit'>Unit</div></td>
            <td class='t2 b2 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;' title='Result or Input Type'>Result/Input</div></td>
            <td class='t2 b2 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;' title='Norval Value Type'>NV Type</div></td>
            <td class='t2 b2 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;'>Position</div></td>
            <td class='t2 b2 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;'>Header</div></td>
            <td class='t2 b2 l1 r2'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-weight: bold;font-size: 10px;'>Action</div></td>
          </tr>
";

$a=0;
$asql=mysqli_query($conn,"SELECT * FROM `labnormalvalues` WHERE `code`='$scode' AND `stat`='1' ORDER BY CAST(`sort` AS UNSIGNED)");
while($afetch=mysqli_fetch_array($asql)){
  $no=$afetch['no'];
  $code=$afetch['code'];
  $testname=$afetch['testname'];
  $testabr=$afetch['testabr'];
  $sort=$afetch['sort'];
  $amll=$afetch['amll'];
  $amul=$afetch['amul'];
  $afll=$afetch['afll'];
  $aful=$afetch['aful'];
  $cll=$afetch['cll'];
  $cul=$afetch['cul'];
  $nll=$afetch['nll'];
  $nul=$afetch['nul'];
  $displaynv=$afetch['displaynv'];
  $others=$afetch['others'];
  $unit=$afetch['unit'];
  $grplabel=$afetch['grplabel'];
  $grp=$afetch['grp'];
  $type=$afetch['type'];
  $header=$afetch['header'];
  $respos=$afetch['respos'];
  $rescollbl=$afetch['rescollbl'];
  $rescol=$afetch['rescol'];
  $resrowlbl=$afetch['resrowlbl'];
  $resrow=$afetch['resrow'];
  $a++;

  if($grp==1){
    if((($amll==$afll)&&($amll==$cll)&&($amll==$nll))&&(($amul==$aful)&&($amul==$cul)&&($amul==$nul))){
      $setnv=$amll." - ".$amul;
    }
    else{
      $setnv="Adult Male: ".$amll." - ".$amul."<br />Adult Female: ".$afll." - ".$aful."<br />Child: ".$cll." - ".$cul."<br />Neonate: ".$nll." - ".$nul;
    }
  }
  else if(($grp==2)||($grp==6)||($grp==8)){
    $vich="";
    if($others!=""){
      $setzm=substr_count($others,"|");
      $cs=preg_split("/\|/",$others);
      $csa="1";
    }
    else{
      $csa="0";
    }

    for($zm=1;$zm<=$setzm;$zm++){
      if($csa=="1"){
        $csvar=$zm-1;
        $ich=$cs[$csvar];
      }
      else{
        $ich="";
      }

      if($zm!=1){$vichsp="; ";}else{$vichsp=" ";}
      $vich=$vich.$vichsp.$ich;
    }

    if($grp==6){
      $setnv="<u>$grplabel</u><br />CHOICES: ".$vich;
    }
    else{
      $setnv="CHOICES: ".$vich;
    }

  }
  else if($grp==3){
    if(($others!="")&&($grp==3)){
      $setzb=substr_count($others,"|");
      $ots=preg_split("/\|/",$others);
      $otsa="1";
    }
    else{
      $otsa="0";
    }

    $iot="";
    for($zb=1;$zb<=$setzb;$zb++){
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

      $iot=$iot."Age ".$all." to ".$aul.": ".$oll." - ".$oul."<br />";
    }

    $setnv=$iot;
  }
  else if($grp==5){
    if(($others!="")&&($grp==5)){
      $setzb=substr_count($others,"|");
      $ots=preg_split("/\|/",$others);
      $otsa="1";
    }
    else{
      $otsa="0";
    }

    $iot="";
    for($zb=1;$zb<=$setzb;$zb++){
      if($otsa=="1"){
        $otsvar=$zb-1;
        $otss=preg_split("/\*/",$ots[$otsvar]);

        $lbl=$otss[0];
        $oll=$otss[1];
        $oul=$otss[2];
      }
      else{
        $lbl="";
        $oll="";
        $oul="";
      }

      $iot=$iot.$lbl.": ".$oll." - ".$oul."<br />";
    }

    $setnv=$iot;
  }
  else if($grp==7){
    $setnv="<u>$grplabel</u>";
  }
  else{
    $setnv="";
  }

  if($type==1){$tdisp="Result with H or L indicator.";}
  else if($type==2){$tdisp="Result has no H or L indicator.";}
  else if($type==3){$tdisp="Input 2 values. No H or L indicator.";}
  else if($type==4){$tdisp="Free write. Input any value.";}
  else if($type==5){$tdisp="Result with H or L indicator. Can input -value.";}
  else{$tdisp="";}

  if($grp=="8"){
    $testname=$resrowlbl." : ".$rescollbl;
  }

echo "
          <tr>
            <td class='b1 l2'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-size: 13px;'>$a</div></td>
            <td class='b1 l1'><div align='left' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-size: 13px;'>$testname</div></td>
            <!-- td class='b1 l1'><div align='left' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-size: 13px;'>$testabr</div></td -->
            <td class='b1 l1'><div align='left' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-size: 13px;'>$sort</div></td>
            <td class='b1 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-size: 13px;'>$setnv</div></td>
            <td class='b1 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-size: 13px;'>$displaynv</div></td>
            <td class='b1 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-size: 13px;'>$unit</div></td>
            <td class='b1 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-size: 13px;'>$tdisp</div></td>
            <td class='b1 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-size: 13px;'>$grp</div></td>
            <td class='b1 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-size: 13px;'>$respos</div></td>
            <td class='b1 l1'><div align='center' style='padding: 0 3px 0 3px;color: #000000;font-family: arial;font-size: 13px;'>$header</div></td>
            <td class='b1 l1 r2'><div align='center' class='div-container' style='padding: 3px;color: #000000;font-family: arial;font-size: 13px;'>
              <table border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td><div align='center' style='padding: 0 2px 0 0;'><button class='btn'"; ?> onclick="<?php echo "window.open('AENV.php?code=$scode&eno=$no', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=10,left=400,width=450,height=710');";?>" <?php echo "title='Edit'>&#9998;</btn></div></td>
                  <td><div align='center' style='padding: 0 0 0 2px;'>
                    <form method='post'>
                      <button type='submit' name='rmv' class='btn cancel'";?> onclick="return confirm('Are you sure you want to remove <?php echo "$testname"; ?> from the list?');" <?php echo " title='Remove'>&cross;</btn>
                      <input type='hidden' name='dno' value='$no' />
                    </form>
                  </div></td>
                </tr>
              </table>
            </div></td>
          </tr>
";
}

echo "
          <tr>
            <td class='t1' colspan='12' height='10'></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td style='padding: 0 0 5px 0;'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
          <td width='50%'></td>
          <td width='50%'><div align='right'>
            <table border='0' cellpadding='0' cellspacing='0'>
              <tr>
                <td><a href='?scode=$scode&type=$stype'><button class='btnreload' style='height: 28px;' title='Reload Page'>&#8635; Reload Page</button></a></td>
                <td width='2'></td>
                <td><button class='btnadd' style='height: 28px;width: 28px;'"; ?> onclick="<?php echo "window.open('AENV.php?code=$scode', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=10,left=400,width=450,height=710');";?>" <?php echo ">&#10010;</button></td>
              </tr>
            </table>
          </div></td>
        </tr>
      </table></td>
    </tr>
  </table>
</div>
";

if(isset($_POST['rmv'])){
  $dno=mysqli_real_escape_string($conn,$_POST['dno']);
  mysqli_query($conn,"DELETE FROM `labnormalvalues` WHERE `no`='$dno'");

  echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL='>";
}
?>
</body>
</html>
