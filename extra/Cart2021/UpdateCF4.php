<!DOCTYPE html PUBLIC"-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="../Resources/Favicon/favicon.png" type="image/png" />
<link rel="shortcut icon" href="../Resources/Favicon/favicon.png" type="image/png" />
<title>Test Codes</title>
<script type="text/JavaScript">
<!--
function placeFocus() {
if (document.forms.length > 0) {
var field= document.forms[0];
for (i= 0; i < field.length; i++) {
if ((field.elements[i].type=="text") || (field.elements[i].type=="textarea") || (field.elements[i].type.toString().charAt(0)=="s")) {
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
.T1 {border-top-width: 1px;border-top-color: #000000;border-top-style: solid;}
.B1 {border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;}
.L1 {border-left-width: 1px;border-left-color: #000000;border-left-style: solid;}
.R1 {border-right-width: 1px;border-right-color: #000000;border-right-style: solid;}

.T2 {border-top-width: 2px;border-top-color: #000000;border-top-style: solid;}
.B2 {border-bottom-width: 2px;border-bottom-color: #000000;border-bottom-style: solid;}
.L2 {border-left-width: 2px;border-left-color: #000000;border-left-style: solid;}
.R2 {border-right-width: 2px;border-right-color: #000000;border-right-style: solid;}

.s1 {font-family: Arial;font-weight: bold;font-size: 11px;}
.s2 {font-family: Arial;font-size: 13px;}
.s3 {font-family: Arial;font-weight: bold;font-size: 14px;color: #000000;}
.s4 {font-family: Arial;font-weight: bold;font-size: 13px;color: #000000;}
.s5 {font-family: Arial;font-size: 16px;color: #0B95F7;font-weight: bold;}

.hoverTable{border-collapse:collapse;}
/*.hoverTable td{padding:0px; border:#4e95f4 1px solid;}*/

/* Define the default color for all the table rows */
/*.hoverTable tr{background: #b8d1f3;}*/

/* Define the hover highlight color for the table row */
.hoverTable tr:hover {background-color: #ffff99;}

.button1 {font-family: Arial;font-size: 14px;font-weight: bold;color: #FFFFFF;background-color: #00DA1D;border: 1px solid #00DA1D;height: 32px;}
.button2 {font-family: Arial;font-size: 14px;font-weight: bold;color: #FFFFFF;background-color: #0066FF;border: 1px solid #0066FF;height: 32px;}

.textfield1 {font-family: Arial;font-size: 16px;font-weight: bold;color: #000000;background-color: #ccff99;border: 1px solid #000000;height: 30px;width: 200px;}

.astyle {text-decoration: none;}
-->
</style>

</head>

<body>
<?php
ini_set("display_errors","On");
include('../Settings.php');
$cuz= new database();
$setip=$cuz->setIP();

/*$pHciCaseNo
--> enlistment --> pHciCaseNo
--> profile --> pHciCaseNo
--> soap --> pHciCaseNo
--> courseward --> pHciCaseNo
--> medicine --> pHciCaseNo

$pHciTransNo
--> enlistment --> pHciTransNo
--> profile --> pHciTransNo
--> soap --> pHciTransNo
--> courseward --> pHciTransNo
--> medicine --> pHciTransNo

$hcode
--> epcb --> pHciAccreNo*/

$hcode="H12017229";
$pmcc="932227";

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB4());

$anum=0;
$asql=mysql_query("SELECT caseno, pHciCaseNo, pHciTransNo FROM enlistment");
while($afetch=mysql_fetch_array($asql)){
$caseno=$afetch['caseno'];
$oldpHciCaseNo=$afetch['pHciCaseNo'];
$oldpHciTransNo=$afetch['pHciTransNo'];
$anum++;

$newpHciCaseNo=str_replace("H12017356","$pmcc",$oldpHciCaseNo);
$newpHciTransNo=str_replace("H12017356","$pmcc",$oldpHciTransNo);


if(strpos($oldpHciCaseNo, "H12017356") !== false){
  $asd="True";
}
else{
  $asd="<span style='color: #FF0000'>False</span>";
}

echo $anum." --> ".$asd." --> |".$oldpHciCaseNo." --> ".$newpHciCaseNo."| --> ".$oldpHciTransNo." --> ".$newpHciTransNo."| --> ".$caseno."<br />";

if($asd=="True"){
mysql_query("UPDATE `epcb` SET `pHciAccreNo`='$hcode' WHERE caseno='$caseno'");
mysql_query("UPDATE `enlistment` SET `pHciCaseNo`='$newpHciCaseNo', `pHciTransNo`='$newpHciTransNo' WHERE caseno='$caseno'");
mysql_query("UPDATE `profile` SET `pHciCaseNo`='$newpHciCaseNo', `pHciTransNo`='$newpHciTransNo' WHERE caseno='$caseno'");
mysql_query("UPDATE `soap` SET `pHciCaseNo`='$newpHciCaseNo', `pHciTransNo`='$newpHciTransNo' WHERE caseno='$caseno'");
mysql_query("UPDATE `courseward` SET `pHciCaseNo`='$newpHciCaseNo', `pHciTransNo`='$newpHciTransNo' WHERE caseno='$caseno'");
mysql_query("UPDATE `medicine` SET `pHciCaseNo`='$newpHciCaseNo', `pHciTransNo`='$newpHciTransNo' WHERE caseno='$caseno'");
}

}

?>
</body>
</html>
