<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PACKAGE LIST</title>
<link href="Resources/CSS/style.css" rel="stylesheet" type="text/css" />
<script type="text/JavaScript">
<!--
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
//-->
</script>
<style type="text/css">
<!--
.t1 {border-top-width: 1px;border-top-color: #000000;border-top-style: solid;}
.b1 {border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;}
.l1 {border-left-width: 1px;border-left-color: #000000;border-left-style: solid;}
.r1 {border-right-width: 1px;border-right-color: #000000;border-right-style: solid;}

.t2 {border-top-width: 2px;border-top-color: #000000;border-top-style: solid;}
.b2 {border-bottom-width: 2px;border-bottom-color: #000000;border-bottom-style: solid;}
.l2 {border-left-width: 2px;border-left-color: #000000;border-left-style: solid;}
.r2 {border-right-width: 2px;border-right-color: #000000;border-right-style: solid;}

.hoverTable{border-collapse:collapse;}
.hoverTable tr:hover {background-color: #ffff99;}

.divbt .btn {background-color: #8ebf42;color: #fff;padding: 12px 20px;border: none;cursor: pointer;margin-bottom:10px;opacity: 0.8;border-radius: 5px;}
.divbt .cancel {background-color: #cc0000;}
.divbt .btn:hover, .open-button:hover {opacity: 1;}

.astyle {text-decoration: none;}
-->
</style>
</head>

<body onload="placeFocus()">
<?php
include("../../main/class.php");

if((isset($_COOKIE["ccpass"]))&&($_COOKIE["ccname"])&&($_COOKIE["ccacce"])){
  $ccpass=$_COOKIE["ccpass"];
  $ccname=$_COOKIE["ccname"];
  $ccacce=$_COOKIE["ccacce"];

  setcookie("ccpass", $ccpass, time() + 600, "/");
  setcookie("ccname", $ccname, time() + 600, "/");
  setcookie("ccacce", $ccacce, time() + 600, "/");
}
else{
  $ccpass="";
  $ccname="";
  $ccacce="";
}

$caseno=mysqli_real_escape_string($conn,$_POST['caseno']);
$dept=mysqli_real_escape_string($conn,$_POST['dept']);
$ipass=mysqli_real_escape_string($conn,$_POST['ipass']);
$nursename=mysqli_real_escape_string($conn,$_POST['user']);
$ticket=mysqli_real_escape_string($conn,$_POST['ticket']);
$pckgno=mysqli_real_escape_string($conn,$_POST['pckgno']);
$pn=mysqli_real_escape_string($conn,$_POST['pn']);
$dis=mysqli_real_escape_string($conn,$_POST['dis']);
$prc=mysqli_real_escape_string($conn,$_POST['prc']);
$frm=mysqli_real_escape_string($conn,$_POST['frm']);
$station=mysqli_real_escape_string($conn,$_POST['station']);

$relprc=$prc+$dis;

$whatday=date("D");

$asql=mysqli_query($conn,"SELECT p.`senior` FROM `admission` a, `patientprofile` p WHERE `caseno`='$caseno' AND a.`patientidno`=p.`patientidno`");
$afetch=mysqli_fetch_array($asql);
$senior=$afetch['senior'];

if((stripos($caseno, "R-") !== FALSE)||(stripos($caseno, "WD-") !== FALSE)){
  $senior="Y";
}

//colonoscopy/endoscopy
if(($pckgno=="PCKG-20220930091334")||($pckgno=="PCKG-20220930091745")){
  $senior="Y";
}

//NEW COLONOSCOPY/ENDOSCOPY
if(($pckgno=="PCKG-20221021125555")||($pckgno=="PCKG-20221021124543")||($pckgno=="PCKG-20221021010154")||($pckgno=="PCKG-20221021010958")){
  $senior="Y";
}

if(($pckgno=="PCKG-20210222035829")||($pckgno=="PCKG-20210711025237")){
  if($senior=="Y"){
    $net=$prc;
    $correction=0.01;
  }
  else{
    $net=$prc;
    $correction=0.01;
  }
}
else if($pckgno=="PCKG-20210301105350"){
  if($senior=="Y"){
    $net=$prc-($prc*0.20);
  }
  else{
    $net=$prc;
  }
  $correction=0;
}
else if($pckgno=="PCKG-20210405102812"){
  if($senior=="Y"){
    $net=$prc-($prc*0.20);
  }
  else{
    $net=$prc;
  }
  $correction=0;
}
//ENDOSCOPY-COLONOSCOPY-----------------------
else if($pckgno=="PCKG-20220930091334"){
  if($senior=="Y"){
    $net=$prc-($prc*0.20);
  }
  else{
    $net=$prc;
  }
  $correction=0;
}
else if($pckgno=="PCKG-20220930091745"){
  if($senior=="Y"){
    $net=$prc-($prc*0.20);
  }
  else{
    $net=$prc;
  }
  $correction=0;
}
//END ENDOSCOPY-COLONOSCOPY----------------------
//NEW ENDOSCOPY-COLONOSCOPY----------------------
else if($pckgno=="PCKG-20221021125555"){
  if($senior=="Y"){
    $net=$prc-($prc*0.20);
  }
  else{
    $net=$prc;
  }
  $correction=0;
}
else if($pckgno=="PCKG-20221021124543"){
  if($senior=="Y"){
    $net=$prc-($prc*0.20);
  }
  else{
    $net=$prc;
  }
  $correction=0;
}
else if($pckgno=="PCKG-20221021010154"){
  if($senior=="Y"){
    $net=$prc-($prc*0.20);
  }
  else{
    $net=$prc;
  }
  $correction=0;
}
else if($pckgno=="PCKG-20221021010958"){
  if($senior=="Y"){
    $net=$prc-($prc*0.20);
  }
  else{
    $net=$prc;
  }
  $correction=0;
}
//END NEW ENDOSCOPY-COLONOSCOPY------------------
else if($pckgno=="PCKG-20210412074849"){
  if($senior=="Y"){
    $net=$prc-($prc*0.20);
  }
  else{
    $net=$prc;
  }
  $correction=0;
}
else{
  $net=$prc;
  $correction=0;
}

$disrel=$relprc-$net;

$xsql=mysqli_query($conn,"SELECT `pckgno`, `packagename`, `price`, `dept`, `discount` FROM `packagelist` WHERE `pckgno`='$pckgno'");
$xfetch=mysqli_fetch_array($xsql);
$pdept=$xfetch['dept'];

$bsql=mysqli_query($conn,"SELECT * FROM `packagedetails` WHERE `pckgno`='$pckgno' ORDER BY CAST(`price` AS DECIMAL(10,2)) DESC");
$bcount=mysqli_num_rows($bsql);

$itd=$disrel/$bcount;
$itdr=round($itd,2);

$itd1st=$disrel-($bcount*$itdr);
$itd1str=round($itd1st,2);

$itd1stf=$itdr+$itd1str;

$perc=($disrel/$relprc)*100;

echo "
<div align='left'>
  <span style='font-family: arial;font-weight: bold;color: #0091C7;font-size: 18px;padding-left: 10px;'>ADDING $pn</span>
  <span style='font-family: arial;color: #909090;font-size: 14px;'>(<u>$pckgno</u>)</span>
</div>
<br />
<div align='left' class='arial16bluebold' style='padding-left: 10px;padding-bottom: 5px;'>
  <form name='back' action='../Package2023/' method='post'>
    <input type='submit' name='Back' value='&lt;&lt;Back' />
    <input type='hidden' name='caseno' value='$caseno'>
    <input type='hidden' name='dept' value='$dept'>
    <input type='hidden' name='enterpassword' value='$ipass'>
    <input type='hidden' name='user' value='$nursename'>
    <input type='hidden' name='ticket' value='$ticket'>
    <input type='hidden' name='station' value='$station'>
  </form>
</div>
<div align='left' style='padding-left: 10px;'>
  <form name='submit' method='post' action='lp.php'>
    <table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td class='t2 b2 l2' width='auto'><div align='center' style='font-family: arial;font-weight: bold;color: #0091C7;font-size: 16px;padding: 2px 5px 2px 5px;'>&nbsp;DESCRIPTION&nbsp;</div></td>
        <td class='t2 b2 l1 r2' width='120'><div align='center' style='font-family: arial;font-weight: bold;color: #0091C7;font-size: 16px;padding: 2px 5px 2px 5px;'>&nbsp;PRICE&nbsp;</div></td>
      </tr>
";

$tot=0;
$cou=0;
$sam=0;
$totamtper=0;
$tapdis=0;
while($bfetch=mysqli_fetch_array($bsql)){
  $cd=$bfetch['code'];
  $ds=$bfetch['description'];
  $pr=$bfetch['price'];
  $tot+=$pr;
  $cou++;

  if($cou==1){$itdd=$itd1stf;}
  else{$itdd=$itdr;}

  $sam+=$itdd;

  if($cou==$bcount){
    $apdis=$disrel-$totamtper-$correction;
  }
  else{
    $apdis=$pr*(round($perc)/100);
    $totamtper+=$apdis;
  }

  $tapdis+=$apdis;

echo "
      <tr>
        <td class='b1 l2' height='40'><div align='left' style='font-family: arial;color: #000000;font-size: 15px;padding: 2px 5px 2px 5px;'>&nbsp;$ds&nbsp;</div></td>
        <td class='b1 l1 r2' height='40'><div align='right' style='font-family: arial;color: #000000;font-size: 15px;padding: 2px 5px 2px 5px;'>&nbsp;".number_format($pr,2,'.',',')."&nbsp;</div></td>
      </tr>
";
}

echo "
      <tr>
        <td class='t1 b2 l2' height='40'><div align='left' style='font-family: arial;font-weight: bold;color: #FF5733;font-size: 16px;padding: 2px 5px 2px 5px;'>&nbsp;TOTAL&nbsp;</div></td>
        <td class='t1 b2 l1 r2' height='40'><div align='right' style='font-family: arial;font-weight: bold;color: #FF5733;font-size: 16px;padding: 2px 5px 2px 5px;'>&nbsp;".number_format($tot,2,'.',',')."&nbsp;</div></td>
      </tr>
      <tr>
        <td colspan='2' class='b2 l2 r2'><div align='center' style='padding: 8px;'><textarea name='remarks' placeholder='Remarks' style='width: 300px;height: 50px;border: 2px solid black;border-radius: 5px;padding: 3px;'></textarea></div></td>
      </tr>
      <tr>
        <td colspan='2' height='5'></td>
      </tr>
      <tr>
        <td colspan='2'><div align='center' class='divbt'>
          <table border='0' cellpadding='0' cellspacing='0'>
            <tr>
";

if(($pckgno=="PCKG-20210301105350")||($pckgno=="PCKG-20210222035829")||($pckgno=="PCKG-20210711025237")){
echo "
              <td><button type='submit' name='trantype' value='charge' style='width: 100px;height: 40px' class='btn'>Charge</button></td>
";
}
else{
  if($pdept!="ENDCOL"){
echo "
              <td style='padding: 3px;'><button type='submit' name='trantype' value='cash' style='width: 100px;height: 40px' class='btn cancel'>Cash</button></td>
";
  }

  if(stripos($caseno, "I-") !== FALSE){}
  else{
echo "
              <td style='padding: 3px;'><button type='submit' name='trantype' value='charge' style='width: 100px;height: 40px' class='btn'>Charge</button></td>
";
  }
}

echo "
            </tr>
          </table>
        </div></td>
      </tr>
    </table>
    <input type='hidden' name='caseno' value='$caseno' />
    <input type='hidden' name='dept' value='$dept' />
    <input type='hidden' name='enterpassword' value='$ipass' />
    <input type='hidden' name='user' value='$nursename' />
    <input type='hidden' name='ticket' value='$ticket' />
    <input type='hidden' name='pckgno' value='$pckgno' />
    <input type='hidden' name='pn' value='$pn' />
    <input type='hidden' name='disrel' value='$disrel' />
    <input type='hidden' name='prc' value='$relprc' />
    <input type='hidden' name='frm' value='$frm' />
    <input type='hidden' name='station' value='$station'>
  </form>
</div>
<br />
";

/*echo "
<form method='post' action='lp.php' id='data' style='display:none'>
  <input type='hidden' name='caseno' value='$caseno' />
  <input type='hidden' name='dept' value='$dept' />
  <input type='hidden' name='enterpassword' value='$ipass' />
  <input type='hidden' name='user' value='$nursename' />
  <input type='hidden' name='ticket' value='$ticket' />
  <input type='hidden' name='pckgno' value='$pckgno' />
  <input type='hidden' name='pn' value='$pn' />
  <input type='hidden' name='disrel' value='$disrel' />
  <input type='hidden' name='prc' value='$relprc' />
  <input type='hidden' name='frm' value='$frm' />
  <input type='hidden' name='station' value='$station' />
  <input type='hidden' name='trantype' value='charge' />
  <input type='hidden' name='remarks' value='' />
  <input type='submit'>
</form>
<script>
  document.forms.namedItem('data').submit();
</script>
";*/
?>
</body>
</html>
