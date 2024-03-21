<?php
//ini_set("display_errors","On");
$caseno = $_GET['caseno'];
$batchno = $_GET['ticketno'];
// $refno = $_GET['refno'];
// $trantype = $_GET['trantype'];

$qry2="and trantype='cash'";

// if($refno=="")
// {
  $qry = "batchno='$batchno'";
// }else{
// $qry="refno='$refno'";
// }

include '../connect.php';
$sql = "SELECT * FROM heading";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$heading=$row['heading'];
$address=$row['address'];
}

$sql2 = "SELECT * FROM admission where caseno='$caseno'";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()) {
$patientidno=$row2['patientidno'];
$room=$row2['room'];
$employerno=$row2['employerno'];
$ap=$row2['ap'];
if(is_numeric($ap)){
    $sqlAp=mysqli_query($conn,"SELECT `name` FROM docfile WHERE code='$ap'");
    if(mysqli_num_rows($sqlAp)>0){
      $myap=mysqli_fetch_array($sqlAp);
      $ap=$myap['name'];
    }else{
      $ap="";
    }
    }
$pataddress = $row2['street']." ".$row2['barangay'].", ".$row2['municipality'].", ".$row2['province'];
$initialdiagnosis = $row2['initialdiagnosis'];
}

$ppksql=mysqli_query($conn,"SELECT * FROM patientprofile WHERE patientidno='$patientidno'");
$ppkcount=mysqli_num_rows($ppksql);

if($ppkcount==0){
  $sql3="select UPPER(lastname) as lastname,UPPER(firstname) as firstname,UPPER(middlename) as middlename,age,UPPER(gender) as sex, birthdate as dateofbirth from nsauthemployees where empid = '$patientidno'";
  $sf="off";
}
else{
  $sql3="SELECT * FROM patientprofile WHERE patientidno='$patientidno'";
  $sf="on";
}

//$sql3 = "SELECT * FROM patientprofile where patientidno='$patientidno'";
$result3 = $conn->query($sql3);
while($row3 = $result3->fetch_assoc()) {
$ln=$row3['lastname'];
$fn=$row3['firstname'];
$mn=$row3['middlename'];
if($sf=="on"){
  $sf=$row3['suffix'];
}
else{
  $sf="";
}
$name=$ln." ".$fn." ".$mn;
$age=$row3['age'];
$sex=$row3['sex'];
$birthdate=$row3['birthdate'];
}

$sql4 = "SELECT * FROM room where room='$room'";
$result4 = $conn->query($sql4);
while($row4 = $result4->fetch_assoc()) {
$station=$row4['nursestation'];
}
$room = $room." (".$station.")";

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
<table width='330' border='0' cellpadding='0' cellspacing='0'>
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
  <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='35'><div align='left' class='arial s9 black bold'>&nbsp;BatchNo.</div></td>
        <td width='10'><div align='center' class='arial s9 black bold'>:</div></td>
        <td class='b1'><div align='left' class='arial s9 black'>&nbsp;<?php echo $batchno ?>&nbsp;</div></td>
              </tr>
    </table></td>
  </tr>
  <!-- <tr>
    <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='35'><div align='left' class='arial s9 black bold'>&nbsp;Address</div></td>
        <td width='10'><div align='center' class='arial s9 black bold'>:</div></td>
        <td class='b1'><div align='left' class='arial s9 black'>&nbsp;<?php echo $pataddress ?>&nbsp;</div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height='4'></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td><div align='left' class='arial s10 black bold'>&nbsp;Inital Diagnosis:</div></td>
      </tr>
      <tr>
        <td class='b1'><div align='left' class='arial s11 black'>&nbsp;<?php echo $initialdiagnosis ?>&nbsp;</div></td>
      </tr>
    </table></td>
  </tr> -->
  <!-- <tr>
    <td height='4'></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td><div align='left' class='arial s10 black bold'>&nbsp;Type: <?=$trantype;?></div></td>
      </tr>
    </table></td>
  </tr> -->
  <tr>
    <td height='5' class='b2'></td>
  </tr>
  <tr>
    <td height='5'></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
      <tr>
          <td colspan='4' height='5'><br><img src='RX.png' height='40' width='auto' /><br><br></td>       
        </tr>
      <tr>
        <td width='10'></td>

        <td><div align='left' class='courier s11 blackbold'>Generic/Brand</div></td>
        <td width='30'><div align='center' class='courier s11 blackbold'>Qty.</div></td>
        <td width='10'></td>
      </tr>
    <?php
$sql4 = "SELECT * FROM productout where $qry and quantity>0 $qry2";
$result4 = $conn->query($sql4);
while($row4 = $result4->fetch_assoc()) {
$desc=$row4['productdesc'];
$qty=$row4['quantity'];
$loginuser2=$row4['loginuser'];

echo "
<tr>
<td width='10'></td>
<td><div align='left' class='courier s11 black bold'>$desc</div></td>
<td width='30'><div align='center' class='courier s11 black bold'>$qty</div></td>
</tr>
";
}



    ?>




       </table></td>
  </tr>
</table>

<div id="apDiv1">
  <table width="330" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td class='t2'></td>
    </tr>
    <tr>
      <td><div align='right'><table border='0' width='170' cellpadding='0' cellspacing='0'>
        
        <tr>
          <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='60' height='15'><div align='left' class='courier s11 black bold'>License #</div></td>
              <td width='2' height='15'></td>
              <td width='auto' height='15' class='b2'></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='40' height='15'><div align='left' class='courier s11 black bold'>PTR #</div<</td>
              <td width='2' height='15'></td>
              <td width='auto' height='15' class='b2'></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><table border='0' width='100%' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='30' height='15'><div align='left' class='courier s11 black bold'>S2 #</div></td>
              <td width='2' height='15'></td>
              <td width='auto' height='15' class='b2'></td>
            </tr>
          </table></td>
        </tr>
      </table></div></td>
    </tr>
   </table>
</div>
