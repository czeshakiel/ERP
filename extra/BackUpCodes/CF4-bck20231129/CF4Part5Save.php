<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="Resources/Favicon/favicon.png" type="image/png" />
<link rel="shortcut icon" href="Resources/Favicon/favicon.png" type="image/png" />
<title>CF4 Creator 2.0</title>
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
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<style type="text/css">
<!--

-->
</style>
</head>
<body onload="placeFocus()">
<?php
include("Settings.php");

$caseno=mysqli_real_escape_string($mycon5,$_POST["caseno"]);
$source=mysqli_real_escape_string($mycon5,$_POST["source"]);

$pDrugCode=mysqli_real_escape_string($mycon5,$_POST["pDrugCode"]);
$pGeneric=mysqli_real_escape_string($mycon5,$_POST["pGeneric"]);
$pSalt=mysqli_real_escape_string($mycon5,$_POST["pSalt"]);
$pStrength=mysqli_real_escape_string($mycon5,$_POST["pStrength"]);
$pForm=mysqli_real_escape_string($mycon5,$_POST["pForm"]);
$pUnit=mysqli_real_escape_string($mycon5,$_POST["pUnit"]);
$pPackage=mysqli_real_escape_string($mycon5,$_POST["pPackage"]);
$pGenericFreeText=strtoupper(mysqli_real_escape_string($mycon5,$_POST["pGenericFreeText"]));
$pRoute=strtoupper(mysqli_real_escape_string($mycon5,$_POST["pRoute"]));
$pFrequencyInstruction=strtoupper(mysqli_real_escape_string($mycon5,$_POST["pFrequencyInstruction"]));
$pQuantity=mysqli_real_escape_string($mycon5,$_POST["pQuantity"]);
$pTotalPrice=mysqli_real_escape_string($mycon5,$_POST["pTotalPrice"]);

$pGenericFreeText=str_replace("`","",$pGenericFreeText);
$pGenericFreeText=str_replace("%","PERCENT",$pGenericFreeText);
$pGenericFreeText=str_replace("<","LESS THAN",$pGenericFreeText);
$pGenericFreeText=str_replace(">","MORE THAN",$pGenericFreeText);
$pGenericFreeText=str_replace("&","AND",$pGenericFreeText);
$pGenericFreeText=str_replace(":","",$pGenericFreeText);

$pFrequencyInstruction=str_replace("`","",$pFrequencyInstruction);
$pFrequencyInstruction=str_replace("%","PERCENT",$pFrequencyInstruction);
$pFrequencyInstruction=str_replace("<","LESS THAN",$pFrequencyInstruction);
$pFrequencyInstruction=str_replace(">","MORE THAN",$pFrequencyInstruction);
$pFrequencyInstruction=str_replace("&","AND",$pFrequencyInstruction);
$pFrequencyInstruction=str_replace(":","",$pFrequencyInstruction);

$asql=mysqli_query($mycon5,"SELECT pHciCaseNo, pHciTransNo FROM enlistment WHERE caseno='$caseno'");
$acount=mysqli_num_rows($asql);
if($acount==0){
$pHciCaseNo="";
$pHciTransNo="";
}
else{
while($afetch=mysqli_fetch_array($asql)){
$pHciCaseNo=$afetch['pHciCaseNo'];
$pHciTransNo=$afetch['pHciTransNo'];
}
}

$pdate=date("Y-m-d");

if($pDrugCode!=""){
if(($pRoute!="")&&($pFrequencyInstruction!="")&&($pQuantity!="")&&($pTotalPrice!="")){
mysqli_query($mycon5,"INSERT INTO `cf4`.`medicine` (`pHciCaseNo`, `pHciTransNo`, `pDrugCode`, `pGenericName`, `pGenericCode`, `pSaltCode`, `pStrengthCode`, `pFormCode`, `pUnitCode`, `pPackageCode`, `pRoute`, `pQuantity`, `pActualUnitPrice`, `pCoPayment`, `pTotalAmtPrice`, `pInstructionQuantity`, `pInstructionStrength`, `pInstructionFrequency`, `pPrescPhysician`, `pIsApplicable`, `pDateAdded`, `pModule`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('$pHciCaseNo', '$pHciTransNo', '$pDrugCode', '', '$pGeneric', '$pSalt', '$pStrength', '$pForm', '$pUnit', '$pPackage', '$pRoute', '$pQuantity', '', '', '$pTotalPrice', '', '', '$pFrequencyInstruction', '', 'Y', '$pdate', 'CF4', 'U', '', '$caseno')");

echo "
<table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; left: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
  <tr>
    <td><div align='center'>
      <table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td><div align='center' class='arial14bluebold'>Entries saved...</div></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=CF4Part5.php?caseno=$caseno&source=$source'>";
}
else{
echo "
<table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; left: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
  <tr>
    <td><div align='center'>
      <table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td><div align='center' class='arial14redbold'>Cannot be blank! Try again!!!</div></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='1;URL=CF4Part5.php?caseno=$caseno&source=$source&aa=$pDrugCode&bb=$pGeneric&cc=$pSalt&dd=$pStrength&ee=$pForm&ff=$pUnit&gg=$pPackage'>";
}
}
else{
if(($pGenericFreeText!="")&&($pRoute!="")&&($pFrequencyInstruction!="")&&($pQuantity!="")&&($pTotalPrice!="")){
mysqli_query($mycon5,"INSERT INTO `cf4`.`medicine` (`pHciCaseNo`, `pHciTransNo`, `pDrugCode`, `pGenericName`, `pGenericCode`, `pSaltCode`, `pStrengthCode`, `pFormCode`, `pUnitCode`, `pPackageCode`, `pRoute`, `pQuantity`, `pActualUnitPrice`, `pCoPayment`, `pTotalAmtPrice`, `pInstructionQuantity`, `pInstructionStrength`, `pInstructionFrequency`, `pPrescPhysician`, `pIsApplicable`, `pDateAdded`, `pModule`, `pReportStatus`, `pDeficiencyRemarks`, `caseno`) VALUES ('$pHciCaseNo', '$pHciTransNo', '', '$pGenericFreeText', '', '', '', '', '', '', '$pRoute', '$pQuantity', '', '', '$pTotalPrice', '', '', '$pFrequencyInstruction', '', 'Y', '$pdate', 'CF4', 'U', '', '$caseno')");

echo "
<table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; left: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
  <tr>
    <td><div align='center'>
      <table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td><div align='center' class='arial14bluebold'>Entries saved...</div></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=CF4Part5.php?caseno=$caseno&source=$source'>";
}
else{
echo "
<table style='height:100%;width:100%; position: absolute; top: 0; bottom: 0; left: 0; right: 0;' border='0' cellpadding='0' cellspacing='0'>
  <tr>
    <td><div align='center'>
      <table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td><div align='center' class='arial14redbold'>Cannot be blank! Try again!!!</div></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
";

echo "<META HTTP-EQUIV='Refresh'CONTENT='1;URL=CF4Part5.php?caseno=$caseno&source=$source&aa=$pDrugCode&bb=$pGeneric&cc=$pSalt&dd=$pStrength&ee=$pForm&ff=$pUnit&gg=$pPackage'>";
}
}

?>
</body>
</html>
