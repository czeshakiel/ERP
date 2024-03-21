<script type="text/JavaScript">
<!--
function placeFocus() {
if (document.forms.length > 0) {
var field = document.forms[0];
for (i = 0; i < field.length; i++) {
if ((field.elements[i].type == "password") || (field.elements[i].type == "textarea") || (field.elements[i].type.toString().charAt(0) == "s")) {
document.forms[0].elements[i].focus();
break;
         }
      }
   }
}
//-->
</script>

<?php
ini_set("display_errors","On");
include("../../main/class.php");
$cuz = new database();
$setip=$_SERVER['HTTP_HOST'];

session_start();

$caseno=mysqli_real_escape_string($conn,$_GET['caseno']);
$toh=mysqli_real_escape_string($conn,$_GET['toh']);
$station=mysqli_real_escape_string($conn,$_GET['station']);

if($toh=="CHARGES_QUOT"){
  $tohdisp="CHARGES QUOTAION";
}
else if($toh=="PHARMACY_QUOT"){
  $tohdisp="PHARMACY QUOTATION";
}
else if($toh=="PHARMACY_MANUAL"){
  $tohdisp="PHARMACY";
}
else if($toh=="CSR2_MANUAL"){
  $tohdisp="CSR2";
}
else if($toh=="RDU_MANUAL"){
  $tohdisp="RDU";
}
else if($toh=="PACKAGE2022"){
  $tohdisp="ENDOSCOPY/COLONOSCOPY";
}
else if($toh=="PACKAGE2023"){
  $tohdisp="Package";
}
else{
  $tohdisp=$toh;
}

echo "
<!doctype html>
<html>
<head>
  <meta charset='utf-8'>
  <title>Log-in</title>
  <!-- link rel='stylesheet' type='text/css' href='http://$setip/arv2020/Auth/css/login2.css'>
  <link rel='stylesheet' href='http://$setip/arv2020/arv_includes/stackpath.bootstrapcdn.css' -->
  <link rel='icon' href='../Resources/Favicon/favicon.png' type='image/png' />
  <link rel='shortcut icon' href='../Resources/Favicon/favicon.png' type='image/png' />
";

include("style.php");

echo "
</head>
<!-- body onload='placeFocus()' -->
<body onload='openlin()'>
  <!-- div class='login-box'>
    <img src='http://$setip/arv2020/Auth/icons/avatar1.png' class='avatar'>
    <h1>Log-in Here <br> <font color='#FFFFFF'><small>$tohdisp</small></font></h1 -->
";

if(isset($_POST['login'])){
$ccpass=mysqli_real_escape_string($conn,$_POST['ccpass']);

if($station=="DOC-OTHERS"){$auth = "nsauthdoctors";}else{$auth = "nsauth";}

$asql=mysqli_query($conn,"SELECT * FROM $auth WHERE `station`='$station' AND password='$ccpass'");
$acount=mysqli_num_rows($asql);

  if($acount==0){
    echo "
    <br />
    <div class='error-message' align='center' style='font-size: 16px; font-weight: bold;color: red;'>Log-in failed!!!</div>
    <META HTTP-EQUIV='Refresh'CONTENT='1;URL=../Cart/?caseno=$caseno&station=$station&toh=$toh'>
    ";
  }
  else{
    $afetch=mysqli_fetch_array($asql);
    $ccname=$afetch['name'];
    $ccacce=$afetch['Access'];

    //setcookie("ccpass", $ccpass, time() + 600, "/");
    //setcookie("ccname", $ccname, time() + 600, "/");
    //setcookie("ccacce", $ccacce, time() + 600, "/");

    $_SESSION['ccpass']=$ccpass;
    $_SESSION['ccname']=$ccname;
    $_SESSION['ccacce']=$ccacce;

    echo "
    <br />
    <div align='center' style='color: blue;font-weight: bold;'>Log-in successful!!!</div>
    ";

    if($toh=="CHARGES"){
      $tick="LXD-".date("YmdHis").rand(1000,9999);
      echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=cccharges.php?caseno=$caseno&station=$station&toh=$toh&tick=$tick'>";
    }
    else if($toh=="CHARGES_QUOT"){
      $tick="LXD-".date("YmdHis").rand(1000,9999);
      echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=cccharges_quot.php?caseno=$caseno&station=$station&toh=$toh&tick=$tick'>";
    }
    else if($toh=="PHARMACY"){
      $toh="PHARMACY_MANUAL";
      $tick="PHARMACY-".date("YmdHis").rand(1000,9999);
      echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=ccpharmacy_manual.php?caseno=$caseno&station=$station&toh=$toh&tick=$tick&stk=PHARMACY'>";
    }
    else if($toh=="PHARMACY_MANUAL"){
      $tick="PHARMACY-".date("YmdHis").rand(1000,9999);
      echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=ccpharmacy_manual.php?caseno=$caseno&station=$station&toh=$toh&tick=$tick&stk=PHARMACY'>";
    }
    else if($toh=="PHARMACY_QUOT"){
      $tick="PHARMACY-".date("YmdHis").rand(1000,9999);
      echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=ccpharmacy_quot.php?caseno=$caseno&station=$station&toh=$toh&tick=$tick&stk=PHARMACY'>";
    }
    else if($toh=="CSR2"){
      $tick="CSR2-".date("YmdHis").rand(1000,9999);
      echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=cccsr2.php?caseno=$caseno&station=$station&toh=$toh&tick=$tick&stk=CSR2'>";
    }
    else if($toh=="CSR2_MANUAL"){
      $tick="CSR2-".date("YmdHis").rand(1000,9999);
      echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=cccsr2_manual.php?caseno=$caseno&station=$station&toh=$toh&tick=$tick&stk=CSR2'>";
    }
    else if($toh=="PACKAGE"){
      $tick="".date("YmdHis").rand(1000,9999);
      echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=../../2020codes/Package/?caseno=$caseno&station=$station&dept=PACKAGE&ticket=$tick'>";
    }
    else if($toh=="PACKAGE2023"){
      $tick="".date("YmdHis").rand(1000,9999);
      echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=../Package2023/?caseno=$caseno&station=$station&dept=PACKAGE&ticket=$tick'>";
    }
    else if($toh=="PACKAGE2022"){
      $tick="".date("YmdHis").rand(1000,9999);
      echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=../Package2022/?caseno=$caseno&station=$station&dept=PACKAGE&ticket=$tick'>";
    }
    else if($toh=="PHARMACY OPD"){
      $tick="$toh-".date("YmdHis").rand(1000,9999);
      echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=ccphopcart.php?caseno=$caseno&station=$station&toh=$toh&tick=$tick&stk=pharmacy_opd'>";
    }
    else if($toh=="RDU_MANUAL"){
      $tick="RDU-".date("YmdHis").rand(1000,9999);
      echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=ccecart_manual.php?caseno=$caseno&station=$station&toh=$toh&tick=$tick&stk=$toh'>";
    }
    else{
      $tick="$toh-".date("YmdHis").rand(1000,9999);
      echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=ccecart_manual_all.php?caseno=$caseno&station=$station&toh=$toh&tick=$tick&stk=$toh'>";
    }
  }
}
else{
echo "
    <!-- form action='../Cart/?caseno=$caseno&station=$station&toh=$toh' target='_self' method='post'>
      <p>Password&nbsp;&nbsp;&nbsp;<span id='password_info'></span></p>
      <input type='password' name='ccpass' placeholder='Enter Password' value='' required />
      <input type='submit' name='login' name='login' value='Proceed'>
    </form -->
";

echo "
<div class='cpup' style='box-sizing: border-box;border-radius: 10px;background-color: #FFFFFF;'>
  <div class='formcpup' id='lin' align='center' style='background-color: #FFFFFF;'>
    <form action='../Cart/?caseno=$caseno&station=$station&toh=$toh' target='_self' method='post' class='formcontainer'>
      <table width='100%' border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td style='padding: 10px 0;' valign='top'><div align='center'>
            <img src='../Resources/Pictures/Cart.png' width='20' height='auto' /> <span style='font-family: arial;font-weight: bold;font-size: 16px;color: #2BAA76;'>$tohdisp Cart Log-In</span>
";

if(isset($_SESSION['lerr'])){
  echo base64_decode($_SESSION['lerr']);
}

echo "
          </div></td>
        </tr>
";

/*if(isset($_GET['chu'])){
echo "
        <tr>
          <td style='padding-bottom: 5px;'><div align='center'><input type='text' name='susr' style='font-weight: bold;font-size: 16px;' placeholder='Username' autofocus required /></div></td>
        </tr>
";
}
else{
echo "
        <tr>
          <td style='padding-bottom: 5px;'><div align='center' style='font-family: arial;font-weight: bold;font-size: 12px;'>User: <span style='color: #03A3CD;'>$snm</span> <a href='../$aa[3]/$aa[4]&chu' style='text-decoration: none;'><span style='font-size:10px;font-weigth: bold;color: #FF0000;'>(Change User)</span></a></div></td>
        </tr>
";
}*/

echo "
        <tr>
          <td><div align='center'><input type='password' name='ccpass' style='font-weight: bold;font-size: 16px;' placeholder='Password' autofocus required /></div></td>
        </tr>
        <tr>
          <td style='padding-top: 10px;'><div align='center'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><button type='submit' name='login' class='btn'>Proceed</button></td>
            </tr>
          </table></div></td>
        </tr>
      </table>
    </form>
  </div>
</div>

<script>
  function openlin() {
    document.getElementById('lin').style.display='block';
  }

  function closelin() {
    document.getElementById('lin').style.display='none';
  }
</script>
";
}

echo "
  </div>
</body>
</html>
";
//
?>
