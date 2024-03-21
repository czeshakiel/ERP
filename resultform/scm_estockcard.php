<?php
error_reporting(1);
include '../main/class.php';
$version = explode(".", phpversion());

if($version[0]=="5"){
//5.4 and above   
require_once '../resultform/dompdf5.4/autoload.inc.php';
}else{
//7.1 and above    
require_once '../resultform/dompdf7.1/autoload.inc.php';
}

$dompdf = new Dompdf\Dompdf();



$code = $_GET['code'];
$dstart = $_GET['datefrom'];
$dend = $_GET['dateto'];

$date_dis = date("F d, Y", strtotime($dstart))." to ".date("F d, Y", strtotime($dend));
$datebeg = date('Y-m-d', strtotime('-1 day', strtotime($dstart)));

$result22c = $conn->query("select * from receiving where code='$code'");
while($row22c = $result22c->fetch_assoc()) { 
$desc = $row22c['description'];
$genr = $row22c['generic'];

$desc=str_replace("mak-","",$desc);
$desc=str_replace("-med","",$desc);
$desc=str_replace("-sup","",$desc);
$desc=str_replace("ams-","",$desc);
$desc=str_replace("RDU-","",$desc);
}


// Define the HTML content
$html = '
<table width="100%"><tr>
<td width="10%"><img src="../resultform/kmsci.png" width="50" height="50"></td>
<td>
<table align="center"><tr>
<td style="text-align: center;"><b>'.$heading.'</b></td>
</tr><tr>
<td style="font-size: 13px; text-align: center;">'.$address.'</td>
</tr></table>
</td>
<td width="10%">&nbsp;</td>
</tr></table>
<br>

<table align="center"><tr>
<td style="font-size: 13px; text-align: center;"><b>'.$dept.' ELECTRONIC STOCK CARD<b></td>
</tr><tr>
<td style="font-size: 12px; text-align: center;">'.$date_dis.'</td>
</tr></table><hr>

<table>
<tr><td style="font-size: 11px;">Code: <b>'.$code.'</b></td></tr>
<tr><td style="font-size: 11px;">Desc: <b>'.$desc.'</b></td></tr>
</table>

<br>
<table align="center" width="100%" border="1" style="border-collapse: collapse;">
<tr>
<td style="text-align: center; font-size: 11px; width: 10%;"><b>Date</b></td>
<td style="text-align: center; font-size: 11px; width: 30%;"><b>Transaction Name</b></td>
<td style="text-align: center; font-size: 11px; width: 10%;"><b>Transaction Type</b></td>
<td style="text-align: center; font-size: 11px; width: 10%;"><b>Running Balance</b></td>
<td style="text-align: center; font-size: 11px; width: 10%;"><b>SOH</b></td>
<td style="text-align: center; font-size: 11px; width: 30%;"><b>User</b></td>
</tr>
<tr>
<th colspan="6" style="border-bottom: solid 1px black;"></th>
</tr>
';

$qty=0;
$result22 = $conn->query("select sum(quantity) as qty from stocktable where dept='$dept' and code='$code' and datearray between '1970-01-01' and '$datebeg'");
while($row22 = $result22->fetch_assoc()){ $qty=$row22['qty'];}
// if($qty<1){$qty=0;}

$html .= '
<tr>
<td style="text-align: center; font-size: 11px;">0000-00-00</td>
<td style="font-size: 11px;">Beginning Balance</td>
<td style="text-align: center; font-size: 11px;"></td>
<td style="text-align: center; font-size: 11px;"></td>
<td style="text-align: center; font-size: 11px;">'.$qty.'</td>
<td style="font-size: 11px;"></td>
</tr>
';

$sql222 = "select * from stocktable where dept='$dept' and code='$code' and datearray between '$dstart' and '$dend' order by datearray, timearray";
$result222 = $conn->query($sql222);
while($row222 = $result222->fetch_assoc()){ 
$date=date("M-d-Y", strtotime($row222['datearray']))." || ".date("h:i a", strtotime($row222['timearray']));
$suppliername=$row222['suppliername'];
$trantype=$row222['trantype'];
$receivinguser=$row222['receivinguser'];
$quantity=$row222['quantity'];
$qty = $qty + $quantity;

$suppliername = str_replace("'", "", $suppliername);
$receivinguser = str_replace("'", "", $receivinguser);

if($suppliername=="CPU" and $dept!="CPU" and $trantype=="ADJUSTMENT"){$suppliername=$dept;}

$html .= '
<tr>
<td style="text-align: center; font-size: 11px;">'.$date.'</td>
<td style="font-size: 11px;">'.$suppliername.'</td>
<td style="text-align: center; font-size: 11px;">'.$trantype.'</font> <font color="blue" size="1">'.$uc.'</td>
<td style="text-align: center; font-size: 11px;">'.$quantity.'</td>
<td style="text-align: center; font-size: 11px;">'.$qty.'</td>
<td style="font-size: 11px;">'.$receivinguser.'</td>
</tr>
';
}

$html .= '
<tr>
<td></td>
<td></td>
<td style="text-align: center; font-size: 11px;"><b>Stock On Hand</b></td>
<td style="text-align: center; font-size: 11px;"><b>'.$qty.'</b></td>
<td></td>
<td></td>
</tr>
</table>

<br>
<table align="center" width="100%">
<tr>
<td style="font-size: 11px;">PREPARED BY:</td>
<td style="font-size: 11px;">CHECKED BY:</td>
<td style="font-size: 11px;">NOTED BY:</td>
</tr>
<tr>
<td style="font-size: 11px;">&nbsp;</td>
<td style="font-size: 11px;">&nbsp;</td>
<td style="font-size: 11px;">&nbsp;</td>
</tr>
<tr>
<td style="font-size: 11px;">&nbsp;</td>
<td style="font-size: 11px;">&nbsp;</td>
<td style="font-size: 11px;">&nbsp;</td>
</tr>
<tr>
<td style="font-size: 11px;"><u>_______________________</u></td>
<td style="font-size: 11px;"><u>_______________________</u></td>
<td style="font-size: 11px;"><u>_______________________</u></td>
</tr>
<tr>
<td style="font-size: 11px;">'.$dept.' HEAD</td>
<td style="font-size: 11px;">ACCOUNTING IN-CHARGE</td>
<td style="font-size: 11px;">ADMINISTRATOR</td>
</tr>
</table>

';


// Load the HTML into the renderer
$dompdf->loadHtml($html);

// Set the paper size and orientation
//$dompdf->setPaper('A4', 'portrait');
$dompdf->setPaper([0,0,612,1008], 'portrait');

// Render the PDF
$dompdf->render();

// Output the generated PDF to the browser
$dompdf->stream('Electronic Stock Card.pdf', array('Attachment' => false));
?>
