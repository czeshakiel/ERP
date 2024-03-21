<?php
error_reporting(1);
include '../main/class.php';

$deptx = $_POST['dept'];
$invdatex = date("Y-m-d");

$ss = $conn->query("select * from bulkadjustment where dept='$deptx' group by batchno");
while($ss1 = $ss->fetch_assoc()){$batch = $ss1['batchno'];}
?>

<style>
.A4 {
  background: white;
  font-family: Tahoma;
  width: 21.59cm;
  height: 33.02cm;
  display: block;
  margin: 0 auto;
  padding: 10px 25px;
  margin-bottom: 0.5cm;
}

@media print {
  @page {
     size: 8.5in 13in;
     size: portrait;
  }
}


</style>

<div width='730' align='center' class='A4'>
<div class='header'>
<table width="100%"><tr>
<td width="10%"><img src="../../resultform/kmsci.png" width="50" height="50"></td>
<td>
<table align="center"><tr>
<td style="text-align: center;"><b><?php echo $heading ?></b></td>
</tr><tr>
<td style="font-size: 13px; text-align: center;"><?php echo $address ?></td>
</tr></table>
</td>
<td width="10%">&nbsp;</td>
</tr></table>
<br>

<table align="center"><tr>
<td style="font-size: 13px; text-align: center;"><b> COUNT SHEET<b></td>
</tr></table><hr>

<table align='left'>
<tr><td style="font-size: 12px;">Inventory Date: <b><?php echo $invdatex ?></b></td></tr>
<tr><td style="font-size: 12px;">Department: <b><?php echo $deptx ?></b></td></tr>
<tr><td style="font-size: 12px;">Batch: <b><?php echo $batch ?></b></td></tr>
</table>


<table align="center" width="100%" border="1" style="border-collapse: collapse;">
<tr>
<td style="text-align: center; font-size: 12px; width: 5%;"><b>NO.</b></td>
<td style="text-align: center; font-size: 12px; width: 60%;"><b>DESCRIPTION</b></td>
<td style="text-align: center; font-size: 12px; width: 10%;"><b>EXPIRATION</b></td>
<td style="text-align: center; font-size: 12px; width: 5%;"><b>QTY</b></td>
<td style="text-align: center; font-size: 12px; width: 10%;"><b>PHYSICAL<br>COUNT 1</b></td>
<td style="text-align: center; font-size: 12px; width: 10%;"><b>PHYSICAL<br>COUNT 2</b></td>
</tr>
</table>
</div>


<div class='content'>
<table align="center" width="100%" border="1" style="border-collapse: collapse;">
<?php
$i=0;
$resultn = $conn->query("select * from bulkadjustment where dept='$deptx'");
while($rown = $resultn->fetch_assoc()){ 
$qty=$rown['soh'];
$desc=$rown['desc'];
$i++;

$desc=str_replace('ams-','',$desc);
$desc=str_replace('cmshi-','',$desc);
$desc=str_replace('-med','',$desc);
$desc=str_replace('-sup','',$desc);


echo "
<tr>
<td style='text-align: center; font-size: 12px; width: 5%;'>$i</td>
<td style='font-size: 12px; width: 60%;'>$desc</td>
<td style='text-align: center; font-size: 12px; width: 10%;'></td>
<td style='text-align: center; font-size: 12px; width: 5%;'>$qty</td>
<td style='text-align: center; font-size: 12px; width: 10%;'></td>
<td style='font-size: 12px; width: 10%;'></td>
</tr>
";
}

echo "
</table>
</div>
</div>
";
?>
