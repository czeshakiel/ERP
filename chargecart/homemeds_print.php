<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>RX(Home Meds)</title>
<link href="../main/arv_new/style.css" rel="stylesheet" type="text/css" />
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

</head>

<body>
<?php
include '../main/class.php';
$caseno = $_GET['caseno'];
$batchno = $_GET['batchno'];
$refno = $_GET['refno'];
$trantype = $_GET['trantype'];
//$user = $_GET['user'];

if(isset($_GET['rdu']) or isset($_GET['other'])){$q = " and administration!='administered'";}else{$q = " and administration='pending'";}
if($refno==""){$qry = "batchno='$batchno' $q";}
else{$qry="refno='$refno' $q";}


$pdate=date("M d, Y");


$sql2xx = "SELECT * FROM admission WHERE caseno='$caseno'";
$result2xx = $conn->query($sql2xx);
while($afetch = $result2xx->fetch_assoc()){
$patientidno=$afetch['patientidno'];$street=$afetch['street'];$barangay=$afetch['barangay'];$municipality=$afetch['municipality'];$province=$afetch['province']; $ap=$afetch['ap']; $room=$afetch['room'];}

$provsp=preg_split("/\_/",$province);
$provsp=preg_split("/\(/",$provsp[0]);
$prov=trim($provsp[0]);
$add=$street." ".$barangay." ".$municipality." ".$prov;


$sql2xxx = "SELECT * FROM patientprofile WHERE patientidno='$patientidno'";
$result2xxx = $conn->query($sql2xxx);
while($bfetch = $result2xxx->fetch_assoc()){
$ln=$bfetch['lastname'];$fn=$bfetch['firstname'];$mn=$bfetch['middlename'];$suffix=$bfetch['suffix'];$bd=$bfetch['birthdate'];$age=$bfetch['age'];$sex=strtoupper($bfetch['sex']);}
$pname=$ln.", ".$fn." ".$mn." ".$suffix;

$sql2xxxx = "SELECT heading, address FROM heading";
$result2xxxx = $conn->query($sql2xxxx);
while($cfetch = $result2xxxx->fetch_assoc()){
$heading=$cfetch['heading'];$address=$cfetch['address'];}

$sql2xxxzzz = "SELECT * FROM docfile where (code='$ap' or name='$ap')";
$result2xxxzzz = $conn->query($sql2xxxzzz);
while($dfetchzz = $result2xxxzzz->fetch_assoc()){
$docname = $dfetchzz['name'];
$ptrno = $dfetchzz['ptrno'];
$licenseno = $dfetchzz['licenseno'];
$s2no = $dfetchzz['s2no'];
$sig = $dfetchzz['pic'];
}

echo "
<div align='left'>
<table border='0' width='360' cellpadding='0' cellspacing='0'>
<tr>
<td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
<tr>
<td width='30' rowspan='2'><div align='center'><img src='../../main/img/logo/mmshi.png' width='25' height='auto' /></td>
<td width='auto'><div align='center' class='couriernew10blackbold'>$heading</div></td>
<td width='30' rowspan='2'></td>
</tr>
<tr>
<td><div align='center' class='couriernew10black'>$address</div></td>
</tr>
</table></td>
</tr>
<tr>
<td height='10'></td>
</tr>
<tr>
<td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
<tr>
<td width='auto' valign='top'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
<tr>
<td height='20'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
<tr>
<td width='80'><div align='left' class='couriernew10blackbold'>Patient Name</div></td>
<td width='5'><div align='center' class='couriernew10blackbold'>:</div></td>
<td width='auto' class='table1Bottom'><div align='left' class='couriernew11black'>&nbsp;$pname</div></td>
</tr>
</table></td>
</tr>
<tr>
<td height='20'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
<tr>
<td><div align='left'><table border='0' cellpadding='0' cellspacing='0'>
<tr>
<td width='25'><div align='left' class='couriernew10blackbold'>Age</div></td>
<td width='5'><div align='center' class='couriernew10blackbold'>:</div></td>
<td width='25' class='table1Bottom'><div align='left' class='couriernew11black'>&nbsp;$age</div></td>
<td width='5'></td>
<td width='25'><div align='left' class='couriernew10blackbold'>Sex</div></td>
<td width='5'><div align='center' class='couriernew10blackbold'>:</div></td>
<td width='25' class='table1Bottom'><div align='left' class='couriernew11black'>&nbsp;$sex</div></td>
</tr>
</table></div></td>
<td><div align='right'><table border='0' cellpadding='0' cellspacing='0'>
<tr>
<td width='25'><div align='left' class='couriernew10blackbold'>Date</div></td>
<td width='5'><div align='center' class='couriernew10blackbold'>:</div></td>
<td width='100' class='table1Bottom'><div align='left' class='couriernew11black'>&nbsp;$pdate</div></td>
</tr>
</table></div></td>
</table></td>
</tr>
<tr>
<td height='20'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
<tr>
<td width='43'><div align='left' class='couriernew10blackbold'>Address</div></td>
<td width='5'><div align='center' class='couriernew10blackbold'>:</div></td>
<td width='auto' class='table1Bottom'><div align='left' class='couriernew9black'>&nbsp;$add</div></td>
</tr>
<tr>
<td width='43'><div align='left' class='couriernew10blackbold'>Room</div></td>
<td width='5'><div align='center' class='couriernew10blackbold'>:</div></td>
<td width='auto' class='table1Bottom'><div align='left' class='couriernew9black'>&nbsp;<b>$room - $dept</b></div></td>
</tr>
<tr>
<td width='43'><div align='left' class='couriernew10blackbold'>Batch</div></td>
<td width='5'><div align='center' class='couriernew10blackbold'>:</div></td>
<td width='auto' class='table1Bottom'><div align='left' class='couriernew9black' style='font-size:12px;'>&nbsp;<b>$batchno</b></div></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
<tr>
<td height='10'></td>
</tr>
<tr>
<td class='table2Top' height='80' valign='top'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
<br>
<td width='2'></td>
<td><div align='left' class='couriernew10blackbold'>&nbsp;Account-title&nbsp;</div></td>
<td><div align='center' class='couriernew10blackbold'>&nbsp;Total Amount.&nbsp;</div></td>
<td width='2'></td>
</tr>
<tr>
<td colspan='4' height='4'></td>
</tr>
";

$total=0;
//$sql2xxxz = "SELECT * FROM productout WHERE caseno='$caseno' and $qry and trantype='cash' and quantity>0 group by productcode";
$sql2xxxz = "SELECT * FROM productout WHERE caseno='$caseno' and $qry and trantype='cash' and quantity>0";
$result2xxxz = $conn->query($sql2xxxz);
while($dfetch = $result2xxxz->fetch_assoc()){
$code = $dfetch['productcode'];
$desc = $dfetch['productdesc'];
$qty = $dfetch['quantity'];
$refno2 = $dfetch['refno'];
$trantype = $dfetch['trantype'];
$total += $dfetch['excess'];
$productsubtype = $dfetch['productsubtype'];
}

$desc = str_replace("mak-","", $desc);
echo "
<tr>
<td width='2'></td>
<td><div align='left' class='couriernew11black'>&nbsp;$productsubtype&nbsp;</div></td>
<td><div align='center' class='couriernew11black'>&nbsp;$total&nbsp;</div></td>
<td width='2'></td>
</tr>
";


echo "
</table></td>
</tr>
<tr>
<td height='10' class='table2Top'></td>
</tr>
<tr>
<td><div align='right'><table border='0' width='170' cellpadding='0' cellspacing='0'>
<tr>
<td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
<tr>
<td height='15' class='table1Bottom' align='center' valign='bottom'><font size='1'>$user</font></td>
</tr>
</table></td>
</tr>

</td>
</tr>
<tr>
<td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
<tr>
<td width='30' height='15'><div align='center' class='couriernew11blackbold'>Printed by</div></td>
</tr>
</table></td>
</tr>
</table></div></td>
</tr>
</table>
</div>
";

?>
</body>
</html>
