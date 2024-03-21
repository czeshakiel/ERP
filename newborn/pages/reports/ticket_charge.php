<?php
ini_set("display_errors","On");
session_start();
$caseno = $_GET["caseno"];
$datenow = date("m-d-Y");
$loginuser = $_GET["loginuser"];
include '../../meshes/alink.php';
$queryOne = $pdo->query("SELECT * FROM heading");
  while($row = $queryOne->fetch(PDO::FETCH_ASSOC)) {
    $heading = $row['heading'];
    $address = $row['address'];
  }
  
$queryTwo = $pdo->query("SELECT * FROM admission where caseno='$caseno'");
while($row2 = $queryTwo->fetch(PDO::FETCH_ASSOC)){
$patientidno = $row2['patientidno'];
$room = $row2['room'];
$employerno = $row2['employerno'];
$ap = $row2['ap'];
if(is_numeric($ap)){
  $sqlAp = $pdo->query("SELECT `name` FROM docfile WHERE code='$ap'");
  if($sqlAp->rowCount()> 0){
    $myap = $sqlAp->fetch(PDO::FETCH_ASSOC);
    $ap = $myap['name'];
  }else{
    $ap="";
  }
}
$pataddress = $row2['street']." ".$row2['barangay'].", ".$row2['municipality'].", ".$row2['province'];
$initialdiagnosis = $row2['initialdiagnosis'];
}

$ppksql = $pdo->query("SELECT * FROM patientprofile WHERE patientidno='$patientidno'");
if($ppkcount = $ppksql->rowCount() == 0){
  $queryThree = $pdo->query("SELECT UPPER(lastname) AS lastname,UPPER(firstname) AS firstname,UPPER(middlename) AS middlename,age,UPPER(gender) AS sex, birthdate AS dateofbirth FROM nsauthemployees WHERE empid = '$patientidno'");
  $sf="off";
}
else{
  $queryThree = $pdo->query("SELECT * FROM patientprofile WHERE patientidno='$patientidno'");
  $sf="on";
}
while($row3 = $queryThree->fetch(PDO::FETCH_ASSOC)){
  $ln = $row3['lastname'];
  $fn = $row3['firstname'];
  $mn = $row3['middlename'];
  if($sf=="on"){
    $sf = $row3['suffix'];
  }
  else{
    $sf= "";
  }
  $name=$ln." ".$fn." ".$mn;
  $age=$row3['age'];
  $sex=$row3['sex'];
  $birthdate=$row3['birthdate'];
}


$queryFour = $pdo->query("SELECT * FROM room WHERE room='$room'");
while($row4 = $queryFour->fetch(PDO::FETCH_ASSOC)) {
  $station=$row4['nursestation'];
}
$room = $room." (".$station.")";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<title>Print all</title>
<style type="text/css">
BODY { padding-right: 5px; padding-left: 0px; font-size: 10pt; padding-bottom: 0px; margin: 0px; color: #000; padding-top: 0px; font-family: arial, sans-serif;}
.style1 {font-size: 12pt;font-weight: bold;}
.style3 {font-size: 11pt}
#apDiv1 { position:absolute; left:0px; top:500px; height:85px; z-index:1;}
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
</style>
</head>
<body>
<table width='330' border='0' cellpadding='0' cellspacing='0'>
  <tr>
    <td>
      <table width='100%' border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td width='25'><div align='center'><img src='../../assets/img/logo/kmsci.png' width='23' height='auto' /></div></td>
          <td width='auto'><div align='center'><span class='arial s10 black bold'><?=$heading;?></span><br/><span class='arial s9 black'><?=$address;?></span></div></td>
          <td width='25'></td>
        </tr>
      </table>
    </td>
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
        <td class='b1'><div align='left' class='arial s12 black'>&nbsp;<?=$name?>&nbsp;</div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='55'><div align='left' class='arial s9 black bold'>&nbsp;Patient No.</div></td>
        <td width='10'><div align='center' class='arial s9 black bold'>:</div></td>
        <td class='b1'><div align='left' class='arial s11 black'>&nbsp;<?=$patientidno;?>&nbsp;</div></td>
        <td width='26'><div align='left' class='arial s9 black bold'>&nbsp;Date</div></td>
        <td width='10'><div align='center' class='arial s9 black bold'>:</div></td>
        <td class='b1'><div align='left' class='arial s11 black'>&nbsp;<?=$datenow;?>&nbsp;</div></td>
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
        <td class='b1'><div align='left' class='arial s11 black'>&nbsp;<?=$employerno;?>&nbsp;</div></td>
        <td><div align='left' class='arial s9 black bold'>&nbsp;Age/Sex</div></td>
        <td><div align='center' class='arial s9 black bold'>:</div></td>
        <td class='b1'><div align='left' class='arial s11 black'>&nbsp;<?=$age."/".$sex;?>&nbsp;</div></td>
        <td><div align='left' class='arial s9 black bold'>&nbsp;Room</div></td>
        <td><div align='center' class='arial s9 black bold'>:</div></td>
        <td class='b1'><div align='left' class='arial s11 black'>&nbsp;<?=$room;?>&nbsp;</div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='35'><div align='left' class='arial s9 black bold'>&nbsp;Physician</div></td>
        <td width='10'><div align='center' class='arial s9 black bold'>:</div></td>
        <td class='b1'><div align='left' class='arial s9 black'>&nbsp;<?=$ap;?>&nbsp;</div></td>
        <td width='26'><div align='left' class='arial s9 black bold'>&nbsp;DoB</div></td>
        <td width='10'><div align='center' class='arial s9 black bold'>:</div></td>
        <td class='b1'><div align='left' class='arial s11 black'>&nbsp;<?=$birthdate;?>&nbsp;</div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width='100%' border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='35'><div align='left' class='arial s9 black bold'>&nbsp;Address</div></td>
        <td width='10'><div align='center' class='arial s9 black bold'>:</div></td>
        <td class='b1'><div align='left' class='arial s9 black'>&nbsp;<?=$pataddress;?>&nbsp;</div></td>
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
        <td class='b1'><div align='left' class='arial s11 black'>&nbsp;<?=$initialdiagnosis;?>&nbsp;</div></td>
      </tr>
    </table></td>
  </tr>
	<tr>
    <td height='4'></td>
  </tr>
  <tr>
    <td height='5' class='b2'></td>
  </tr>
  <tr>
    <td height='5'></td>
  </tr>
  <tr>
    <td>
      <table width='100%' border='0' cellpadding='0' cellspacing='0'>
        <tr>
          <td width='10'></td>
          <td><div align='left' class='courier s11 black bold'>Description</div></td>
          <td width='30'><div align='center' class='courier s11 black bold'>Qty.</div></td>
          <td width='10'></td>
        </tr>
        <?php
          if (isset($_GET['selectedItems'])) {
            $selectedItems = json_decode($_GET['selectedItems'], true);
            foreach ($selectedItems as $item) {
              $refno = $item['refno'];
                  $queryFth = $pdo->query("SELECT * FROM productout WHERE refno = '$refno'");
                  if ($queryFth->rowCount() > 0) {
                      $rowi = $queryFth->fetch(PDO::FETCH_ASSOC);
                      $desc = $rowi['productdesc'];
                      $qty = $rowi['quantity'];
                      $trantyp = $rowi['trantype'];
                      echo "
                      <tr style='margi-top: 5px'>
                        <td width='10'></td>
                        <td><div align='left' class='courier s14 black'>$desc</div></td>
                        <td><div align='center' class='courier s14 black'>$qty</div></td>
                      </tr>
                      ";
                  }
                }
          }
        ?>
      </table>
    </td>
  </tr>
</table>
<div id="apDiv1">
  <table width="330" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td class='t2'>PREPARED BY : <b><?=$loginuser;?></b></td>
    </tr>
   </table>
</div>
