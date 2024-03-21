<?php
$caseno = $_GET['caseno'];
$batchno = $_GET['batchno'];
$refno = $_GET['refno'];
$transid = $_GET['transid'];

if($refno=="")
{$qry = "batchno='$batchno'";
}else{
$qry="refno='$refno'";
}


include '../main/class.php';
$sql = "SELECT * FROM heading";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$heading=$row['heading'];
$address=$row['address'];
}

$sql = "SELECT * FROM requestreturn where transid='$transid'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$dtreq=$row['datetimereq'];
}

$sql2 = "SELECT * FROM admission where caseno='$caseno'";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$patientidno=$row2['patientidno'];
$room=$row2['room'];
$employerno=$row2['employerno'];
$ap=$row2['ap'];
$pataddress = $row2['street']." ".$row2['barangay'].", ".$row2['municipality'].", ".$row2['province'];
$initialdiagnosis = $row2['initialdiagnosis'];
}

$sql3 = "SELECT * FROM patientprofile where patientidno='$patientidno'";
$result3 = $conn->query($sql3);
$count = mysqli_num_rows($result3);
while($row3 = $result3->fetch_assoc()) {
$name=$row3['patientname'];
$age=$row3['age'];
$sex=$row3['sex'];
$birthdate=$row3['birthdate'];
}

if($count<=0){
$sql3 = "SELECT * FROM patientprofilewalkin where patientidno='$patientidno'";
$result3 = $conn->query($sql3);
$count = mysqli_num_rows($result3);
while($row3 = $result3->fetch_assoc()) {
$name=$row3['patientname'];
$age=$row3['age'];
$sex=$row3['sex'];
$birthdate=$row3['birthdate'];
}
}

$sql4 = "SELECT * FROM room where room='$room'";
$result4 = $conn->query($sql4);
while($row4 = $result4->fetch_assoc()) {
$station=$row4['nursestation'];
}
$room = $room." (".$station.")";
$loginuser2 = $_GET['user'];
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $name ?></title>
<style type="text/css">
<!--
BODY {
	PADDING-RIGHT: 5px;
	PADDING-LEFT: 0px;
	FONT-SIZE: 10pt;
	PADDING-BOTTOM: 0px;
	MARGIN: 0px;
	COLOR: #000;
	PADDING-TOP: 0px;
	FONT-FAMILY: arial, sans-serif;

}
.style1 {
	font-size: 12pt;
	font-weight: bold;
}
.style3 {font-size: 11pt}
#apDiv1 {
	position:absolute;
	left:0px;
	top:500px;
	height:85px;
	z-index:1;
}
#apDiv2 {
	position:absolute;
	left:0px;
	top:480px;
	height:75px;
	z-index:1;
}

.t1 {border-top-width: 1px;border-top-color: #000000;border-top-style: solid;}
.b1 {border-bottom-width: 1px;border-bottom-color: #000000;border-bottom-style: solid;}
.l1 {border-left-width: 1px;border-left-color: #000000;border-left-style: solid;}
.r1 {border-right-width: 1px;border-right-color: #000000;border-right-style: solid;}

.t2 {border-top-width: 2px;border-top-color: #000000;border-top-style: solid;}
.b2 {border-bottom-width: 2px;border-bottom-color: #000000;border-bottom-style: solid;}
.l2 {border-left-width: 2px;border-left-color: #000000;border-left-style: solid;}
.r2 {border-right-width: 2px;border-right-color: #000000;border-right-style: solid;}

.astyle {text-decoration: none;}

.arial {font-family: Arial;}
.courier{font-family: "Courier New";}

.red {color: #FF0000;}
.blue {color: #0B95F7;}
.black {color: #000000;}
.white {color: #FFFFFF;}

.bold {font-weight: bold;}

.s8 {font-size: 8px;}
.s9 {font-size: 9px;}
.s10 {font-size: 10px;}
.s11 {font-size: 11px;}
.s12 {font-size: 12px;}
.s13 {font-size: 13px;}
.s14 {font-size: 14px;}
.s15 {font-size: 15px;}
.s16 {font-size: 16px;}
.s17 {font-size: 17px;}
.s18 {font-size: 18px;}
-->
</style>
</head>

<body>
<table width='400' border='0' cellpadding='0' cellspacing='0'>
  <tr>
    <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='25'><div align='center'><img src='/image/logo/logo.png' width='23' height='auto' /></div></td>
        <td width='auto'><div align='center'><span class='arial s10 black bold'><?php echo $heading ?></span><br /><span class='arial s9 black'><?php echo $address ?></span></div></td>
        <td width='25'></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class='b2' height='5'></td>
  </tr>
    <tr>
    <td height='5'></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='25'><div align='left' class='arial s9 black bold'>&nbsp;Name</div></td>
        <td width='10'><div align='center' class='arial s9 black bold'>:</div></td>
        <td class='b1'><div align='left' class='arial s12 black'>&nbsp;<?php echo $name ?>&nbsp;</div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='55'><div align='left' class='arial s9 black bold'>&nbsp;Patient No.</div></td>
        <td width='10'><div align='center' class='arial s9 black bold'>:</div></td>
        <td class='b1'><div align='left' class='arial s11 black'>&nbsp;<?php echo $patientidno ?>&nbsp;</div></td>
        <td width='26'><div align='left' class='arial s9 black bold'>&nbsp;Date</div></td>
        <td width='10'><div align='center' class='arial s9 black bold'>:</div></td>
        <td class='b1'><div align='left' class='arial s11 black'>&nbsp;<?php echo date("M-d-Y"); ?>&nbsp;</div></td>
      </tr>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
      <tr>
      <tr>
        <td><div align='left' class='arial s9 black bold'>&nbsp;Case No.</div></td>
        <td><div align='center' class='arial s9 black bold'>:</div></td>
        <td class='b1'><div align='left' class='arial s11 black'>&nbsp;<?php echo $employerno ?>&nbsp;</div></td>
        <td><div align='left' class='arial s9 black bold'>&nbsp;Age/Sex</div></td>
        <td><div align='center' class='arial s9 black bold'>:</div></td>
        <td class='b1'><div align='left' class='arial s11 black'>&nbsp;<?php echo $age."/".$sex ?>&nbsp;</div></td>
        <td><div align='left' class='arial s9 black bold'>&nbsp;Room</div></td>
        <td><div align='center' class='arial s9 black bold'>:</div></td>
        <td class='b1'><div align='left' class='arial s11 black'>&nbsp;<?php echo $room ?>&nbsp;</div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='35'><div align='left' class='arial s9 black bold'>&nbsp;Physician</div></td>
        <td width='10'><div align='center' class='arial s9 black bold'>:</div></td>
        <td class='b1'><div align='left' class='arial s9 black'>&nbsp;<?php echo $ap ?>&nbsp;</div></td>
        <td width='26'><div align='left' class='arial s9 black bold'>&nbsp;DoB</div></td>
        <td width='10'><div align='center' class='arial s9 black bold'>:</div></td>
        <td class='b1'><div align='left' class='arial s11 black'>&nbsp;<?php echo $birthdate ?>&nbsp;</div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='35'><div align='left' class='arial s9 black bold'>&nbsp;Address</div></td>
        <td width='10'><div align='center' class='arial s9 black bold'>:</div></td>
        <td class='b1'><div align='left' class='arial s9 black'>&nbsp;<?php echo $pataddress ?>&nbsp;</div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='35'><div align='left' class='arial s9 black bold'>&nbsp;Refno</div></td>
        <td width='10'><div align='center' class='arial s9 black bold'>:</div></td>
        <td class='b1'><div align='left' class='arial s9 black'>&nbsp;<?php echo $transid ?>&nbsp;</div></td>
      </tr>
    </table></td>
  </tr>
    <tr>
    <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='35'><div align='left' class='arial s9 black bold'>&nbsp;Date/Time Request</div></td>
        <td width='10'><div align='center' class='arial s9 black bold'>:</div></td>
        <td class='b1'><div align='left' class='arial s9 black'>&nbsp;<?php echo $dtreq ?>&nbsp;</div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height='4'></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td><div align='center' class='arial s10 black bold' style='font-size: 15px;'>&nbsp;CREDIT MEMO (REFUND SLIP)</div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height='5' class='b2'></td>
  </tr>
  <tr>
    <td height='5'></td>
  </tr>
  <tr>
    <td><table width='99%' border='0' cellpadding='0' cellspacing='0' align="center">
      <tr>
        <td><div align='left' class='courier s11 black bold'>Description</div></td>
        <td width='30'><div align='center' class='courier s11 black bold'>Qty.</div></td>
		 <td width='40'><div align='center' class='courier s11 black bold'><font color='blue'>PRICE</div></td>
		 <td width='40'><div align='center' class='courier s11 black bold'><font color='red'>DISC</div></td>
       
      </tr>
	  <?php
$sql4 = "SELECT * FROM requestreturn where caseno='$caseno' and transid='$transid'";
$result4 = $conn->query($sql4);
while($row4 = $result4->fetch_assoc()) {
$code=$row4['code'];
$qty=$row4['quantity'];
$amount=$row4['amount'];
$discount=$row4['discount'];
$ofr=$row4['ofr'];
$total = $total + $amount;


$sql5 = "SELECT * FROM receiving where code='$code'";
$result5 = $conn->query($sql5);
while($row5 = $result5->fetch_assoc()) {
$desc=$row5['description'];
$lotno=$row5['lotno'];
if($lotno=="M"){$lotno2="MARKUP";}else{$lotno2="FIXED";}
}
echo "
<tr>
<td style='border-bottom-style: double;'><div align='left' class='courier s11 black bold'>$desc <font color='blue'>($ofr)<font color='green'>($lotno2)</div></td>
<td style='border-bottom-style: double;' width='30'><div align='center' class='courier s11 black bold'>$qty</div></td>
<td style='border-bottom-style: double;' width='40'><div align='center' class='courier s11 black bold'><font color='blue'>$amount</div></td>
<td style='border-bottom-style: double;' width='40'><div align='center' class='courier s11 black bold'><font color='red'>($discount)</div></td>
</tr>
";
}
	  
	  
	  
	  ?>
	  
	  
	  
	  
	     </table></td>
  </tr>
</table>

<div id="apDiv2">
  <table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="80%" style="text-align:right;"><b>TOTAL:</td>
	   <td style="text-align:center;"><b><?php echo $total ?></td>
    </tr>
   </table>
</div>

<div id="apDiv1">
  <table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
      <td><?php echo $loginuser2 ?></td>
	   <td></td>
    </tr>
    <tr>
      <td class='t2'>PREPARED BY:</td>
	   <td class='t2'>CHECKED BY:</td>
    </tr>
   </table>
</div>
