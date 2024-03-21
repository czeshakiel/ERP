<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cart</title>
<link rel='icon' href='../Resources/Favicon/Cart.png' type='image/png' />
<link rel='shortcut icon' href='../Resources/Favicon/Cart.png' type='image/png' />
<link href="../Resources/CSS/mystyle.css" rel="stylesheet" type="text/css" />
<script type="text/JavaScript">
<!--
//-->
</script>
<?php
include("style.php");
?>
</head>
<?php
include("../../main/class.php");
session_start();

//TEMPORARY DB CONNECT-----------------------------------------------------------------------------
$tmpservername = "localhost";
$tmpusername = "root";
$tmppassword = "b0ykup4l";
$tmpdbname = "kmsci-tmp";

$tmpconn = mysqli_connect($tmpservername, $tmpusername, $tmppassword, $tmpdbname);
if(!$tmpconn){die("Connection failed: " . mysqli_connect_error());}
//END TEMPORARY DB CONNECT-------------------------------------------------------------------------

$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);
$dept=mysqli_real_escape_string($conn,$_GET['dept']);
$ct=mysqli_real_escape_string($conn,$_GET['ct']);
$user=mysqli_real_escape_string($conn,$_GET['user']);

if(isset($_GET['tick'])){$tick=mysqli_real_escape_string($conn,$_GET['tick']);}

if(isset($_POST['searchme'])){$sm=mysqli_real_escape_string($conn,$_POST['searchme']);}else{$sm="";}

//auto adress
$aa=preg_split("/\*/",str_replace("/","*",$_SERVER['REQUEST_URI']));

if(isset($_GET['xix'])){
  unset($_SESSION['cun']);
  unset($_SESSION['cpw']);
  unset($_SESSION['cac']);
  unset($_SESSION['cnm']);

  echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=../$aa[3]/".str_replace("&xix","",$aa[4])."'>";
}

//-------------------------------------------------------------------------------------------------
include("login.php");
//-------------------------------------------------------------------------------------------------

//admission query----------------------------------------------------------------------------------
$zcsql=mysqli_query($conn,"SELECT `patientidno`, `membership`, `hmomembership`, `policyno`, `status`, `addemployer`, `ward`, `hmo` FROM `admission` WHERE `caseno`='$caseno'");
$zcfetch=mysqli_fetch_array($zcsql);
$patientidno=$zcfetch['patientidno'];
$membership=$zcfetch['membership'];
$hmomembership=$zcfetch['hmomembership'];
$policyno=$zcfetch['policyno'];
$admstatus=$zcfetch['status'];
$addemployer=$zcfetch['addemployer'];
$ward=$zcfetch['ward'];
$sethmo=$zcfetch['hmo'];
//end admission query------------------------------------------------------------------------------

//patientprofile query-----------------------------------------------------------------------------
$zfsql=mysqli_query($conn,"SELECT `lastname`, `firstname`, `middlename`, `suffix`, `dateofbirth`, `senior` FROM `patientprofile` WHERE `patientidno`='$patientidno'");
$zffetch=mysqli_fetch_array($zfsql);
$ln=mb_strtoupper(trim($zffetch['lastname']));
$fn=mb_strtoupper(trim($zffetch['firstname']));
$mn=mb_strtoupper(trim($zffetch['middlename']));
$sf=mb_strtoupper(trim($zffetch['suffix']));
$dob=$zffetch['dateofbirth'];
$sn=$zffetch['senior'];

if($mn!=""){$mn=" ".$mn;}
if($sf!=""){$sf=" ".$sf;}

$pn=$ln.", ".$fn.$mn.$sf;
//end patientprofile query-------------------------------------------------------------------------


//KNOW CREDIT LEFT---------------------------------------------------------------------------------
  $totgross=0;
  $zasql=mysqli_query($conn,"SELECT `sellingprice`, `quantity`, `adjustment` FROM `productout` WHERE `caseno`='$caseno' AND `quantity` > 0  AND `trantype`='charge'");
  while($zafetch=mysqli_fetch_array($zasql)){
    $zasp=$zafetch['sellingprice'];
    $zaqt=$zafetch['quantity'];
    $zaad=$zafetch['adjustment'];

    $totgross+=($zasp*$zaqt)-$zaad;
  }

  $strtime=date("H:i:s",time()-3600);

  $zbsql=mysqli_query($tmpconn,"SELECT `sellingprice`, `quantity`, `adjustment` FROM `productout` WHERE `caseno`='$caseno' AND `quantity` > 0  AND `trantype`='charge' AND `datearray`='".date("Y-m-d")."' AND `invno` BETWEEN '$strtime' AND '".date("H:i:s")."'");
  while($zbfetch=mysqli_fetch_array($zbsql)){
    $zbsp=$zbfetch['sellingprice'];
    $zbqt=$zbfetch['quantity'];
    $zbad=$zbfetch['adjustment'];

    $totgross+=($zbsp*$zbqt)-$zbad;
  }

  $losql=mysqli_query($conn,"SELECT `policyno` FROM `admission` WHERE `caseno`='$caseno'");
  $lofetch=mysqli_fetch_array($losql);
  $polno=$lofetch['policyno'];

  $clsql=mysqli_query($conn,"SELECT `creditlimit` FROM `patientscredit` WHERE `caseno`='$caseno'");
  $clcount=mysqli_num_rows($clsql);
  if($clcount==0){
    $setcl=0;
  }
  else{
    $clfetch=mysqli_fetch_array($clsql);
    $setcl=$clfetch['creditlimit'];
  }

  $cl=$setcl+$polno;

  if($cl<$totgross){$label=" &#10142;  <span style='color: #FF0000;'>EXCEEDED CREDIT LIMIT</span>";}
  else{$label="";}
//-------------------------------------------------------------------------------------------------

//-------------------------------------------------------------------------------------------------
if($ct=="sot"){
  $ctlbl="SERVICES & OTHER CHARGES";
  $ctph="Search Services & Other Charges...";
  $ctopt="onKeyUp='showResult();'";

  include("searchjs.php");
}
else if($ct=="phm"){
  $ctlbl="PHARMACY";
  $ctph="Input Generic or Brand Name...";
  $ctopt="";
}
else if($ct=="phs"){
  $ctlbl="CSR2";
  $ctph="Input Item Description...";
  $ctopt="";
}
//-------------------------------------------------------------------------------------------------

echo "
<body $shwpu>
<div align='left'>
";

if($seon=="1"){

echo "
  <table border='0' width='100%' cellpadding='0' cellspacing='0'>
    <tr>
      <td>
        <form method='post' name='searchme'>
          <table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td style='padding-bottom: 5px;'><div align='left'>
                <img src='../Resources/Pictures/Cart.png' width='20' height='auto' /> <span style='font-family: arial;font-weight: bold;font-size: 16px;color: #2BAA76;'> $ctlbl CART</span> | <span style='font-family: arial;font-weight: bold;font-size: 12px;color: #000000;'>USER: <span style='color: #03A3CD;'>$snm</span></span>
              </div></td>
            </tr>
";

$kcst=preg_split("/\-/",$caseno);
if(($kcst[0]!="W")&&($kcst[0]!="WD")){
echo "
            <tr>
              <td style='padding-bottom: 5px;'><div align='left'>
                <span style='font-family: arial;font-weight: bold;font-size: 12px;color: #000000;'>CREDIT LIMIT: <span style='color: #B01DFF;'>&#8369; ".number_format($cl,2)."</span> | TOTAL CHARGED: <span style='color: #B01DFF;'>&#8369; ".number_format($totgross,2)."</span>$label</span>
              </div></td>
            </tr>
";
}

echo "
            <tr>
              <td style='padding-bottom: 5px;'><div align='left'><input type='text' name='searchme' style='height: 40px;width: 400px;font-size: 16px;font-weight: bold;border: 3px solid #000000;border-radius: 10px;padding: 0 5px;' value='$sm' placeholder='$ctph' $ctopt autofocus /></div></td>
            </tr>
            <tr>
              <td style='padding-bottom: 5px;'><div align='left'>
                <table border='0' cellpadding='0' cellspacing='0'>
                  <tr>
";

if($dept!="BILLING"){
/*echo "
                    <td><a href='../../nsstation/?printslip&caseno=$caseno' target='_blank'><button class='btn tkt'>Print Ticket</button></a></td>
";*/
}

if($admstatus!="MGH"){
echo "
                    <td width='3'></td>
                    <td><a href='../$aa[3]/$aa[4]&unf'><button type='button' class='btn unf'>Un-Finalized Items</button></a></td>
";
}

echo "
                  </tr>
                </table>
              </div></td>
            </tr>
          </table>
          <input type='hidden' name='searchgo' />
        </form>
      </td>
    </tr>
";

//SERVICES AND OTHERS START------------------------------------------------------------------------
  if($ct=="sot"){
echo "
    <tr>
      <td height='20'></td>
    </tr>
    <tr>
      <td><div id='livesearch' align='left'></div></td>
    </tr>
";
  }
//SERVICES AND OTHERS END--------------------------------------------------------------------------

  if(isset($_POST['searchgo'])){
    if($ct=="phm"){
echo "
    <tr>
      <td height='20'></td>
    </tr>
    <tr>
      <td>
";

      include("phm.php");

echo "
      </td>
    </tr>
";
    }
    else if($ct=="phs"){
echo "
    <tr>
      <td height='20'></td>
    </tr>
    <tr>
      <td>
";
      if(isset($_POST['msgo'])){
        include("phs-ms.php");
      }
      else{
        include("phs.php");
      }

echo "
      </td>
    </tr>
";
    }
  }

  include("itmadded.php");

echo "
  </table>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='300;URL=../$aa[3]/".str_replace("&chu","",$aa[4])."&xix'>";
}
else if($seon=="2"){
  include("addrmk.php");
}
else if($seon=="3"){
  include("posc.php");

echo "
  <span style='font-family: arial;font-weight: bold;font-size: 16px;color: #108600;'>Item Added!!!</span>
";

  echo "<META HTTP-EQUIV='Refresh'CONTENT='1;URL=../$aa[3]/$aa[4]'>";
}
else if($seon=="4"){
  include("delitmgo.php");
}
else if($seon=="5"){
  include("editrmk.php");
}
else if($seon=="6"){
  include("editrmkgo.php");
}
else if($seon=="7"){
  include("finalized.php");
}
else if($seon=="8"){
  include("unfinalized.php");
}
else if($seon=="9"){
  include("posms.php");

  if($adderr==0){
    $delay=2;
echo "
  <span style='font-family: arial;font-weight: bold;font-size: 16px;color: #108600;'>Item Added!!!</span>
";
  }
  else if($adderr==1){
    $delay=5;
echo "
  <span style='font-family: arial;font-weight: bold;font-size: 16px;color: #FF0000;'>QUANTITY REQUESTED IS GREATER THAN STOCK ON HAND!!!</span>
";
  }

  echo "<META HTTP-EQUIV='Refresh'CONTENT='$delay;URL=../$aa[3]/$aa[4]'>";
}

echo "
</div>
";

//START POP UP-------------------------------------------------------------------------------------
include("popup.php");
//END POP UP---------------------------------------------------------------------------------------
?>
</body>
</html>
