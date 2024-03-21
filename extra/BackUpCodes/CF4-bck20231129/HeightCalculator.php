<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <meta name='description' content=''>
  <meta name='author' content=''>
  <link rel="icon" href="Resources/Favicon/favicon.png" type="image/png" />
  <link rel="shortcut icon" href="Resources/Favicon/favicon.png" type="image/png" />
  <title>Height Calculator</title>
  <link href='Resources/CSS/style.css' rel='stylesheet'>
  <!-- Custom Fonts -->
  <link href="../MedMatrixeClaims/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <script src="../MedMatrixeClaims/rs/js/jquery-1.9.1.min.js"></script>
  <link href="../MedMatrixeClaims/rs/css/toastr.css" rel="stylesheet"/>
  <script src="../MedMatrixeClaims/rs/js/toastr.js"></script>
</head>
<script type="text/JavaScript">
  <!--
    function placeFocus() {
      if (document.forms.length > 0) {
        var field = document.forms[0];
        for (i = 0; i < field.length; i++) {
          if ((field.elements[i].type == "text") || (field.elements[i].type == "number") || (field.elements[i].type.toString().charAt(0) == "s")) {
            document.forms[0].elements[i].focus();
            break;
          }
        }
      }
    }

    function toast1() {
      toastr.success("Height copied to clipboard.");
    }
  //-->
</script>
<body onload="placeFocus()">
<?php
ini_set("display_errors","On");
include("Settings.php");

if(isset($_POST['submit'])){
  $ft=mysqli_real_escape_string($mycon1,$_POST['ft']);
  $in=mysqli_real_escape_string($mycon1,$_POST['in']);

  $ftin=$ft*12;
  $ftcon=$ftin*2.54;

  $incon=$in*2.54;

  $cnv=$ftcon+$incon;
  $converted=($ftcon+$incon)." cm.";
}
else{
  $converted="";
  $cnv="";
}

echo "
<div align='center'>
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td class='t3'><div align='center' style='font-family: courier;font-weight: bold;font-size: 30px;'>HEIGHT CALCULATOR</div></td>
    </tr>
    <tr>
      <td height='10' class='t3'></td>
    </tr>
    <tr>
      <td class='t3 b3 l3 r3'><table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td height='10' colspan='3'></td>
          <td height='10' colspan='3' class='l3'></td>
        </tr>
        <tr>
          <td width='10'></td>
          <td><div align='center'><form method='post'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td><input type='number' name='ft' value='' placeholder='Input (ft)' class='courier' style='color: #9506F4;font-size: 30px;border-radius: 10px;width: 200px;height: 40px;text-align: center;' required /></td>
            </tr>
            <tr>
              <td height='10'></td>
            </tr>
            </tr>
              <td><input type='number' name='in' value='' placeholder='Input (in)' class='courier' style='color: #9506F4;font-size: 30px;border-radius: 10px;width: 200px;height: 40px;text-align: center;' required /></td>
            </tr>
            <tr>
              <td height='10'></td>
            </tr>
            <tr>
              <td><div align='center'><input name='submit' type='submit' value='&nbsp;Convert&nbsp;' class='courier' style='background-color: #0066FF;border: none;font-size: 25px;font-weight: bold;color: #FFFFFF;height: 40px;border-radius: 10px;' /></div></td>
            </tr>
          </table></form></div></td>
          <td width='10'></td>
          <td width='10' class='l3'></td>
          <td valign='middle' width='300'><div align='center'>
            <table border='0' cellpadding='0' cellspacing='0'>
              <tr>
                <td><div align='center' style='font-family: courier;font-weight: bold;font-size: 40px;color: #FF7D2F;'>$converted</div></td>
                <td>
";

if($cnv!=""){
echo "
                <span class='mono' id='theList' style='display: none;'>$cnv</span><button id='copyButton' style='background-color: #AA02A7;color: #FFFFFF;border: 1px solid black;border-radius: 2px;cursor: pointer;' title='Copy $cnv to Clip Board.' onclick=myCopyFunction()><i class='fa fa-clipboard' onclick='toast1()'></i></button>
";
}

echo "
                </td>
              </tr>
            </table>
          </div></td>
          <td width='10'></td>
        </tr>
        <tr>
          <td height='10' colspan='3'></td>
            <td height='10' colspan='3' class='l3'></td>
        </tr>
      </table></td>
    </tr>
  </table>
</div>
";

echo '
<script>
function myCopyFunction() {
  var myText = document.createElement("textarea")
  myText.value = document.getElementById("theList").innerHTML;
  myText.value = myText.value.replace(/&lt;/g,"<");
  myText.value = myText.value.replace(/&gt;/g,">");
  document.body.appendChild(myText)
  myText.focus();
  myText.select();
  document.execCommand("copy");
  document.body.removeChild(myText);
}
</script>
';

echo "<META HTTP-EQUIV='Refresh'CONTENT='360;URL=Close.php'>";
?>
</body>
</html>
