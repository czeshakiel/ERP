<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="../../Resources/Favicon/favicon.png" type="image/png" />
<link rel="shortcut icon" href="../../Resources/Favicon/favicon.png" type="image/png" />
<title>Laboratory Package</title>
<link href="../../Resources/CSS/mystyle.css" rel="stylesheet" type="text/css" />
<?php
include('../../Settings.php');
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

if(!isset($_GET['pckgno'])){
$pckgno="PCKG-".date("Ymdhis");
$sh="no";
}
else{
$pckgno=mysql_real_escape_string($_GET['pckgno']);
$sh="yes";
}

echo '
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

function showResult() {
if (document.searchme.searchme.value.length==0) {
  document.getElementById("livesearch").innerHTML=" ";
  return;
  }
if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","itemsearchres.php?pckgno='.$pckgno.'&searchme="+document.searchme.searchme.value,true);
xmlhttp.send();
}
//-->
</script>
';
?>
</head>

<body onload="placeFocus()">
<?php
$asql=mysql_query("SELECT * FROM packagelist WHERE pckgno='$pckgno'");
$acount=mysql_num_rows($asql);

if($sh=="yes"){
$afetch=mysql_fetch_array($asql);
$packagename=$afetch['packagename'];
$price=$afetch['price'];
$discount=$afetch['discount'];
$dept=$afetch['dept'];
}
else{
$packagename="";
$price="";
$discount="";
$dept="";
}

echo "
<div align='left'>
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td height='30'></td>
    </tr>
    <tr>
      <td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td class='t3 b3 l3 r3'><form name='AddUpdate' method='post' action='aupack.php'><table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td colspan='5' height='5'></td>
            </tr>
            <tr>
              <td width='5'></td>
              <td><div align='left' class='arial s12 black bold'>Package Name</div></td>
              <td width='10'><div align='center' class='arial s12 black bold'>:</div></td>
              <td width='10'><div align='center'><input type='text' name='packagename' class='courier s14 white bold borderblack bgblue' value='$packagename' /></div></td>
              <td width='5'></td>
            </tr>
            <tr>
              <td colspan='5' height='3'></td>
            </tr>
            <tr>
              <td></td>
              <td><div align='left' class='arial s12 black bold'>Package Price</div></td>
              <td><div align='center' class='arial s12 black bold'>:</div></td>
              <td><div align='center'><input type='text' name='price' class='courier s14 white bold borderblack bgblue' value='$price' /></div></td>
              <td></td>
            </tr>
            <tr>
              <td colspan='5' height='3'></td>
            </tr>
            <tr>
              <td></td>
              <td><div align='left' class='arial s12 black bold'>Dept.</div></td>
              <td><div align='center' class='arial s12 black bold'>:</div></td>
              <td><div align='left'>
                <select name='dept' class='courier s14 white bold borderblack bgblue'>
                  <option>$dept</option>
                  <option></option>
                  <option>RDU</option>
                </select>
              </div></td>
              <td></td>
            </tr>
            <tr>
              <td colspan='5' height='3'></td>
            </tr>
            <tr>
              <td></td>
              <td><div align='left' class='arial s12 black bold'>Original Price</div></td>
              <td><div align='center' class='arial s12 black bold'>:</div></td>
              <td><div align='center'><input type='text' class='courier s14 black bold bordergray bggray' value='".($price+$discount)."' readonly /></div></td>
              <td></td>
            </tr>
            <tr>
              <td colspan='5' height='3'></td>
            </tr>
            <tr>
              <td></td>
              <td><div align='left' class='arial s12 black bold'>Discount</div></td>
              <td><div align='center' class='arial s12 black bold'>:</div></td>
              <td><div align='center'><input type='text' class='courier s14 black bold bordergray bggray' value='$discount' readonly /></div></td>
              <td></td>
            </tr>
            <tr>
              <td colspan='5' height='3'></td>
            </tr>
            <tr>
              <td width='5'></td>
";

if($acount==0){
echo "
              <td colspan='3'><div align='right'><input type='submit' name='act' class='arial s14 white bold bggreen borderblack' value='Add' /></div></td>
";
}
else{
echo "
              <td colspan='3'><div align='right'><input type='submit' name='act' class='arial s14 white bold bggreen borderblack' value='Update' /></div></td>
";
}

echo "
              <td width='5'></td>
            </tr>
            <tr>
              <td colspan='5' height='5'>
                <input type='hidden' name='pckgno' value='$pckgno' />
              </td>
            </tr>
          </table></form></td>
        </tr>
      </table></div></td>
    </tr>
";

if($acount!=0){
echo "
    <tr>
      <td height='20'></td>
    </tr>
    <tr>
      <td><div align='left' class='arial 16 blue bold'>Test Included</div></td>
    </tr>
    <tr>
      <td><div align='left'><table border='0' cellpadding='0' cellspacing='0' class='hoverTable'>
        <tr>
          <td class='t2 b2 l2'><div align='center' class='courier s10 black bold'>&nbsp;#&nbsp;</div></td>
          <td class='t2 b2 l1'><div align='center' class='courier s10 black bold'>&nbsp;Description&nbsp;</div></td>
          <td class='t2 b2 l1'><div align='center' class='courier s10 black bold'>&nbsp;Price&nbsp;</div></td>
          <td class='t2 b2 l1 r2'><div align='center' class='courier s10 black bold'>&nbsp;&nbsp;</div></td>
        </tr>
";

$b=0;
$tot=0;
$bsql=mysql_query("SELECT * FROM packagedetails WHERE pckgno='$pckgno'");
while($bfetch=mysql_fetch_array($bsql)){
$b++;
$no=$bfetch['no'];
$code=$bfetch['code'];
$description=$bfetch['description'];
$bprice=$bfetch['price'];
$tot+=$bprice;

echo "
        <tr>
          <td class='b1 l2' height='25'><div align='center' class='courier s13 black'>&nbsp;$b&nbsp;</div></td>
          <td class='b1 l1'><div align='left' class='courier s13 black'>&nbsp;$description&nbsp;</div></td>
          <td class='b1 l1'><div align='right' class='courier s13 black'>&nbsp;".number_format($bprice,"2",".",",")."&nbsp;</div></td>
          <td class='b1 l1 r2'><a href='remitem.php?pckgno=$pckgno&no=$no' class='astyle'><div align='center'>&nbsp;<input type='button' class='arial s12 white bold bgred borderblack' value='  X  ' />&nbsp;</div></a></td>
        </tr>
";
}

echo "
        <tr>
          <td class='t1 b1 l2' height='25' colspan='2'><div align='left' class='courier s13 black'>&nbsp;TOTAL&nbsp;</div></td>
          <td class='t1 b1 l1'><div align='right' class='courier s13 black'>&nbsp;".number_format($tot,"2",".",",")."&nbsp;</div></td>
          <td class='t1 b1 l1 r2'></td>
        </tr>
        <tr>
          <td colspan='4' class='t2'></td>
        </tr>
      </table></div></td>
    </tr>
    <tr>
      <td height='40'></td>
    </tr>
    <tr>
      <td><div align='left' class='arial 16 blue bold'>Search Lab. Test</div></td>
    </tr>
    <tr>
      <form name='searchme'>
      <td><div align='left'><input name='searchme' type='text' class='arial s16 black bold bgyellow borderblack h35 w400' autocomplete='off' placeholder=' Lab. Test' onKeyUp='showResult();' size='30' ></div></td>
      </form>
    </tr>
    <tr>
      <td><div id='livesearch' align='left'></div></td>
    </tr>
";
}

echo "
  </table>
</div>
";

?>
</body>
</html>
