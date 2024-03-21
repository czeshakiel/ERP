<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="Resources/Favicon/favicon.png" type="image/png" />
<link rel="shortcut icon" href="Resources/Favicon/favicon.png" type="image/png" />
<title><?php include("../Settings.php"); $cuz = new database(); mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass()); mysql_select_db($cuz->getDB()); $snamesql=mysql_query("SELECT * FROM heading"); while($snamefetch=mysql_fetch_array($snamesql)){$sname=$snamefetch['heading'];$address=$snamefetch['address'];} echo "$sname"; ?></title>
<link href="../../eClaims/Resources/CSS/style.css" rel="stylesheet" type="text/css" />
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
mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

session_start();

$caseno=mysql_real_escape_string($_GET['caseno']);

$tdssql=mysql_query("SELECT * FROM tempdatestorage WHERE caseno='$caseno'");
$tdscount=mysql_num_rows($tdssql);
if($tdscount==0){
$tdate="--";
$ttime="";
}
else{
while($tdsfetch=mysql_fetch_array($tdssql)){
$tdate=$tdsfetch['date'];
$ttime=$tdsfetch['time'];
}
}

echo "
<div align='left'>
  <table width='100%' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td><table border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td width='10'></td>
          <td><table bordercolor='#000000' bgcolor='#747474' border='1' cellpadding='0' cellspacing='0'>
            <tr>
              <form name='CSF' method='post' action='TempDateDisSave.php'>
              <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td height='30'><div align='left' class='arial12whitebold'>&nbsp;Set Temporary Date Discharged&nbsp;</div></td>
                  <td height='30'><div align='center' class='arial12whitebold'>:</div></td>
                  <td height='30'><div align='left'>
";

$pmonth=date("M");
$pday=date("d");
$pyear=date("Y");

$phour=date("H");
$pmin=date("m");
$pap=date("A");

if($pap=="PM"){$spap1="selected='selected'";$spap2="";}
else if($pap=="AM"){$spap1="";$spap2="selected='selected'";}

if($tdate=="--"){
echo "
                    &nbsp;<select name='sm' class='textfield08'>
                      <option selected='selected'>$pmonth</option>
                      <option></option>
                      <option>Jan</option>
                      <option>Feb</option>
                      <option>Mar</option>
                      <option>Apr</option>
                      <option>May</option>
                      <option>Jun</option>
                      <option>Jul</option>
                      <option>Aug</option>
                      <option>Sep</option>
                      <option>Oct</option>
                      <option>Nov</option>
                      <option>Dec</option>
                    </select>
                    <select name='sd' class='textfield08'>
                      <option></option>
";

for($s=1;$s<=31;$s++){
if($s<10){$t="0".$s;}else{$t=$s;}
if($t==$pday){$tds="selected='selected'";}else{$tds="";}
echo "
                      <option $tds>$t</option>
";
}

echo "
                    </select>
                    <select name='sy' class='textfield08'>
                      <option></option>
";

for($u=2016;$u<=($pyear+5);$u++){
if($u==$pyear){$udy="selected='selected'";}else{$udy="";}
echo "
                      <option $udy>$u</option>
";
}

echo "
                    </select>&nbsp;
";
}
else{
$hcids=preg_split('/\-/',$tdate);
$hcidsm=$hcids[0];
$hcidsd=$hcids[1];
$hcidsy=$hcids[2];

echo "
                    &nbsp;<select name='sm' class='textfield08'>
                      <option selected='selected'>$hcidsm</option>
                      <option></option>
                      <option>Jan</option>
                      <option>Feb</option>
                      <option>Mar</option>
                      <option>Apr</option>
                      <option>May</option>
                      <option>Jun</option>
                      <option>Jul</option>
                      <option>Aug</option>
                      <option>Sep</option>
                      <option>Oct</option>
                      <option>Nov</option>
                      <option>Dec</option>
                    </select>
                    <select name='sd' class='textfield08'>
                      <option></option>
";

for($s=1;$s<=31;$s++){
if($s<10){$t="0".$s;}else{$t=$s;}
if($t==$hcidsd){$tds="selected='selected'";}else{$tds="";}
echo "
                      <option $tds>$t</option>
";
}

echo "
                    </select>
                    <select name='sy' class='textfield08'>
                      <option></option>
";

for($u=2016;$u<=($pyear+5);$u++){
if($u==$hcidsy){$udy="selected='selected'";}else{$udy="";}
echo "
                      <option $udy>$u</option>
";
}

echo "
                    </select>&nbsp;
";
}

echo "
                    &nbsp;-&nbsp;&nbsp;<select name='th' class='textfield08'>
                      <option>$phour</option>
                      <option></option>
                      <option>01</option>
                      <option>02</option>
                      <option>03</option>
                      <option>04</option>
                      <option>05</option>
                      <option>06</option>
                      <option>07</option>
                      <option>08</option>
                      <option>09</option>
                      <option>10</option>
                      <option>11</option>
                      <option>12</option>
                    </select>
                    :
                    <select name='tm' class='textfield08'>
                      <option>$pmin</option>
                      <option></option>
";

for($asd=0;$asd<=59;$asd++){
if($asd<10){$qwe="0".$asd;}else{$qwe=$asd;}
echo "
                      <option>$qwe</option>
";
}

echo "
                    </select>
                    &nbsp;
                    <select name='tap' class='textfield08'>
                      <option $spap1>AM</option>
                      <option $spap2>PM</option>
                      <option></option>
                    </select>
                  </div></td>
                </tr>
                <tr>
                  <td height='25' colspan='3'><div align='right'><input type='submit' name='GO' class='butgreen01' value='   GO   ' />&nbsp;</div></td>
                </tr>
              </table></td>
              <input type='hidden' name='caseno' value='$caseno' />
              </form>
            </tr>
          </table></td>
        </tr>
      </table></td>
    </tr>
  </table>
  <br />
  <br />
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <form name='Remove' method='post' action='RemTempDate.php'>
      <td>&nbsp;&nbsp;<input type='submit' name='Remove' class='butblue03' value='Remove Set Date' /></td>
      <input type='hidden' name='caseno' value='$caseno' />
      </form>
    </tr>
  </table>
</div>
";
?>
</body>
</html>
