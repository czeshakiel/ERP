<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Show Charges</title>
<link href="../Resources/CSS/mystyle.css" rel="stylesheet" type="text/css" />
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
<style style="text/css">
/* Define the default color for all the table rows */
.hoverTable tr{background: #ffffff;}

/* Define the hover highlight color for the table row */
.hoverTable tr:hover {background-color: #ffff99;}
</style>
</head>

<body onload="placeFocus()">
<?php
include("../Settings.php");
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());
//mysql_query("SET NAMES 'utf8'");

$caseno=mysql_real_escape_string($_GET['caseno']);

echo "
<div align='left'>
  <span class='arial 18 blue bold'>CHARGES DETAILS</span>
  <br /><br />
  <form name='Update' method='post' target='_blank' action='updatetocashprice.php'>
  <table border='0' cellpadding='0' cellspacing='0' class='hoverTable'>
    <tr>
      <td class='t2 b2 l2' height='15'><div align='center' class='arial s11 black bold'>&nbsp;#&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='arial s11 black bold'>&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='arial s11 black bold'>&nbsp;Ref. No.&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='arial s11 black bold'>&nbsp;Code&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='arial s11 black bold'>&nbsp;Description&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='arial s11 black bold'>&nbsp;Type&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='arial s11 black bold'>&nbsp;Tran. Type&nbsp;</div></td>
      <td class='t2 b2 l1'><div align='center' class='arial s11 black bold'>&nbsp;Status&nbsp;</div></td>
      <td class='t2 b2 l1' width='70'><div align='center' class='arial s11 black bold'>&nbsp;SP&nbsp;</div></td>
      <td class='t2 b2 l1' width='70'><div align='center' class='arial s11 black bold'>&nbsp;Qty.&nbsp;</div></td>
      <td class='t2 b2 l1' width='70'><div align='center' class='arial s11 black bold'>&nbsp;Discount&nbsp;</div></td>
      <td class='t2 b2 l1' width='70'><div align='center' class='arial s11 black bold'>&nbsp;Net&nbsp;</div></td>
      <td class='t2 b2 l1' width='70'><div align='center' class='arial s11 black bold'>&nbsp;CR 1&nbsp;</div></td>
      <td class='t2 b2 l1' width='70'><div align='center' class='arial s11 black bold'>&nbsp;CR 2&nbsp;</div></td>
      <td class='t2 b2 l1' width='70'><div align='center' class='arial s11 black bold'>&nbsp;HMO&nbsp;</div></td>
      <td class='t2 b2 l1 r2' width='70'><div align='center' class='arial s11 black bold'>&nbsp;Excess&nbsp;</div></td>
    </tr>
";

$aeno=0;
$totadj=0;
$totgross=0;
$totphic1=0;
$totphic2=0;
$tothmo=0;
$totexcess=0;
$flag=0;
$aeposql=mysql_query("SELECT refno, productcode, productdesc, sellingprice, quantity, adjustment, gross, phic, phic1, hmo, excess, productsubtype, administration, trantype, terminalname FROM productout WHERE caseno='$caseno' AND gross > 0 AND productsubtype NOT LIKE 'PROFESSIONAL FEE' ORDER BY productsubtype, productdesc");
while($aepofetch=mysql_fetch_array($aeposql)){
$aerefno=$aepofetch['refno'];
$aecode=$aepofetch['productcode'];
$aedesc=$aepofetch['productdesc'];
$aesp=$aepofetch['sellingprice'];
$aeqty=$aepofetch['quantity'];
$aeadj=$aepofetch['adjustment'];
$aegross=$aepofetch['gross'];
$aephic=$aepofetch['phic'];
$aephic1=$aepofetch['phic1'];
$aehmo=$aepofetch['hmo'];
$aeexcess=$aepofetch['excess'];
$aeptype=$aepofetch['productsubtype'];
$aetname=$aepofetch['administration'];
$aetrantype=$aepofetch['trantype'];
$term=$aepofetch['terminalname'];

$aeno++;
$totadj+=$aeadj;
$totgross+=$aegross;
$totphic1+=$aephic;
$totphic2+=$aephic1;
$tothmo+=$aehmo;
$totexcess+=$aeexcess;

if(((($aesp*$aeqty)-$aeadj)!=$aegross)||($aegross!=($aephic+$aephic1+$aehmo+$aeexcess))){$bg="bgred white";$flag+=1;}else{$bg="";}

if(($aeptype=="PHARMACY/MEDICINE")||($aeptype=="PHARMACY/SUPPLIES")||($aeptype=="MEDICAL SURGICAL SUPPLIES")){
$stat=$aetname;
}
else if($aeptype=="LABORATORY"){
$stat=$term;
}
else{
$stat="";
}

echo "
    <tr>
      <td class='b1 l2 $bg' height='25'><div align='left' class='arial s14 black'>&nbsp;$aeno&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='center' class='arial s14 black'>&nbsp;
";

if(($aeptype=="LABORATORY")||($aeptype=="XRAY")){
  if(($aephic>0)||($aephic1>0)||($aehmo>0)){

  }
  else{
    echo "
            <input type='checkbox' name='refno[]' value='$aerefno' />
    ";
  }

}

echo "
      &nbsp;</div></td>
      <td class='b1 l1 $bg'><a href='ManualDistroItem.php?caseno=$caseno&refno=$aerefno' target='_blank' class='astyle'><div align='left' class='arial s14 black'>&nbsp;$aerefno&nbsp;</div></a></td>
      <td class='b1 l1 $bg'><div align='left' class='arial s14 black'>&nbsp;$aecode&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='left' class='arial s14 black'>&nbsp;$aedesc&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='left' class='arial s14 black'>&nbsp;$aeptype&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='left' class='arial s14 black'>&nbsp;$aetrantype&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='left' class='arial s14 black'>&nbsp;$stat&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s14 black'>&nbsp;$aesp&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s14 black'>&nbsp;$aeqty&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s14 black'>&nbsp;$aeadj&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s14 black'>&nbsp;$aegross&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s14 black'>&nbsp;$aephic&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s14 black'>&nbsp;$aephic1&nbsp;</div></td>
      <td class='b1 l1 $bg'><div align='right' class='arial s14 black'>&nbsp;$aehmo&nbsp;</div></td>
      <td class='b1 l1 r2 $bg'><div align='right' class='arial s14 black'>&nbsp;$aeexcess&nbsp;</div></td>
    </tr>
";

}

echo "
    <tr>
      <td class='t1 b2 l2' colspan='10' height='30'><div align='left' class='arial s14 black bold'>&nbsp;TOTAL&nbsp;</div></td>
      <td class='t1 b2 l1'><div align='right' class='arial s14 black bold'>&nbsp;".number_format($totadj,2)."&nbsp;</div></td>
      <td class='t1 b2 l1'><div align='right' class='arial s14 black bold'>&nbsp;".number_format($totgross,2)."&nbsp;</div></td>
      <td class='t1 b2 l1'><div align='right' class='arial s14 black bold'>&nbsp;".number_format($totphic1,2)."&nbsp;</div></td>
      <td class='t1 b2 l1'><div align='right' class='arial s14 black bold'>&nbsp;".number_format($totphic2,2)."&nbsp;</div></td>
      <td class='t1 b2 l1'><div align='right' class='arial s14 black bold'>&nbsp;".number_format($tothmo,2)."&nbsp;</div></td>
      <td class='t1 b2 l1 r2'><div align='right' class='arial s14 black bold'>&nbsp;".number_format($totexcess,2)."&nbsp;</div></td>
    </tr>
  </table>
  <br />
  <input type='submit' value='Update Price' />
  </form>
</div>
";
?>
</body>
</html>
