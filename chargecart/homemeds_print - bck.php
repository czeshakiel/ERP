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
include("../main/class.php");
include("../main/header.php");
$caseno=$_GET['caseno'];
$refno=$_GET['batchno'];
$pdate=date("M d, Y");

if($refno == ""){
$qr ="";
}else{
$qr ="and batchno='$refno'";
}

$sql2xx = "SELECT * FROM admission WHERE caseno='$caseno'";
$result2xx = $conn->query($sql2xx);
while($afetch = $result2xx->fetch_assoc()){
$patientidno=$afetch['patientidno'];
$street=$afetch['street'];
$barangay=$afetch['barangay'];
$municipality=$afetch['municipality'];
$province=$afetch['province'];
$ap=$afetch['ap'];
$md_sig = $afetch['diet'];
if($md_sig!=""){$doc=$md_sig;}else{$doc=$ap;}

if(strpos($caseno, "R-")!==false){$ap = $afetch['ad'];}
}

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

$sql2xxxzzz = "SELECT * FROM docfile where (code='$doc' or name='$doc')";
$result2xxxzzz = $conn->query($sql2xxxzzz);
while($dfetchzz = $result2xxxzzz->fetch_assoc()){
$docname = $dfetchzz['name'];
$ptrno = $dfetchzz['ptrno'];
$licenseno = $dfetchzz['licenseno'];
$s2no = $dfetchzz['s2no'];
$sig = $dfetchzz['pic'];
}

if(isset($_POST['btnupdate'])){
$rod = $_POST['rod'];
$conn->query("update admission set diet='$rod' where caseno='$caseno'");
$conn->query("INSERT INTO `userlogs`(`transaction`, `loginuser`, `datearray`, `timearray`) VALUES ('PT $caseno change doctor in RX from doc $doc to doc $rod', '$user', CURDATE(), CURTIME())");
echo"<script>alert('$rod'); window.history.back();</script>";
}

echo "
<div align='left'>
<table border='0' width='360' cellpadding='0' cellspacing='0'>
<tr>
<td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
<tr>
<td width='30' rowspan='2'><div align='center'><img src='../main/img/logo/mmshi.png' width='25' height='auto' /></td>
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
<td class='table2Top' height='350' valign='top'><table border='0' width='100%' cellpadding='0' cellspacing='0'>
<tr>
<td colspan='4' height='5'><br><img src='../main/img/RX.png' height='40' width='auto' /><br><br></td>
</tr>
<tr>
<td width='2'></td>
<td><div align='left' class='couriernew10blackbold'>&nbsp;Generic/Brand&nbsp;</div></td>
<td><div align='center' class='couriernew10blackbold'>&nbsp;Qty.&nbsp;</div></td>
<td width='2'></td>
</tr>
<tr>
<td colspan='4' height='4'></td>
</tr>
";

$sql2xxxz = "SELECT productcode, productdesc, sum(quantity) as quantity, refno, trantype  FROM productouthm WHERE caseno='$caseno' $qr group by productcode";
$result2xxxz = $conn->query($sql2xxxz);
while($dfetch = $result2xxxz->fetch_assoc()){
$code = $dfetch['productcode'];
$desc = $dfetch['productdesc'];
$qty = $dfetch['quantity'];
$refno2 = $dfetch['refno'];
$trantype = $dfetch['trantype'];


$sql2xxxzz = "SELECT * FROM homemeds WHERE caseno='$caseno' and refno='$refno2'";
$result2xxxzz = $conn->query($sql2xxxzz);
while($dfetchz = $result2xxxzz->fetch_assoc()){
$route = $dfetchz['dosage'];
$freq = $dfetchz['frequency'];
}

$desc = str_replace("mak-","", $desc);
echo "
<tr>
<td width='2'></td>
<td><div align='left' class='couriernew11black'>&nbsp;$desc&nbsp;</div></td>
<td><div align='center' class='couriernew11black'>&nbsp;$qty&nbsp;</div></td>
<td width='2'></td>
</tr>
<tr>
<td width='2'></td>
<td colspan='2'><div align='left' class='couriernew11black'><font color='blue'>&nbsp;$route $freq&nbsp;</font></div></td>
<td width='2'></td>
</tr>
<tr>
<td colspan='4' height='10'></td>
</tr>
";
}


echo "
</table></td>
</tr>
<tr>
<td height='25' class='table2Top'></td>
</tr>
<tr>
<td><div align='right'><table border='0' width='170' cellpadding='0' cellspacing='0'>
<tr>
<td><table border='0' width='100%' cellpadding='0' cellspacing='0' style='background-image: url(sig/$sig.png);background-size: 235px 60px;height: 50px;'>
<tr>
<td height='15' class='table1Bottom' align='center' valign='bottom'><font size='1'><a href='' data-bs-toggle='modal' data-bs-target='#exampleModaladdhm' data-bs-dismiss='modal'>$docname</a></font></td>
</tr>
</table></td>
</tr>
<tr>
<td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
<tr>
<td width='60' height='15'><div align='left' class='couriernew11blackbold'>License #</div></td>
<td width='2' height='15'></td>
<td width='auto' height='15' class='table1Bottom'> <font size='1'>$licenseno</td>
</tr>
</table></td>
</tr>
<tr>
<td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
<tr>
<td width='40' height='15'><div align='left' class='couriernew11blackbold'>PTR #</div<</td>
<td width='2' height='15'></td>
<td width='auto' height='15' class='table1Bottom'> <font size='1'>$ptrno</td>
</tr>
</table></td>
</tr>
<tr>
<td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
<tr>
<td width='30' height='15'><div align='left' class='couriernew11blackbold'>S2 #</div></td>
<td width='2' height='15'></td>
<td width='auto' height='15' class='table1Bottom'> <font size='1'>$s2no</td>
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


<div class="modal fade" id="exampleModaladdhm" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog modal-xs glowing-circle3">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="icofont-plus-circle"></i> Update ROD</h5>
<button type="button" class="btn-close" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">
<?php
echo"
<form method='POST'>
<table width='90%' align='center'>
<tr>
<td width='20%'><font color='black'>ROD:</td><td>
<select name='rod' class='form-control'>
";
$sq = $conn->query("select * from docfile where specialization='ROD'");
echo"<option value='$ap'>$docname</option>";
while($res = $sq->fetch_assoc()){echo"<option value='$res[code]'>$res[name]</option>";}
echo"
</select>
</td>
</tr>
<tr><td><button type='submit' name='btnupdate' class='btn btn-danger btn-sm'><i class='icofont-check-circled'></i> Submit</button></td></tr>
</table> <br>
</form> 
";
?>
</div>
</div>
</div>
</div>

<?php include("../main/footer.php"); ?>