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



$dept = $_POST['dept'];
$acctitle = $_POST['accttitle'];
$invdate = $_POST['invdate'];


// Define the HTML content
$html = '

<header>
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
<td style="font-size: 13px; text-align: center;"><b>'.$dept.' COUNT SHEET<b></td>
</tr></table><hr>

<table>
<tr><td style="font-size: 11px;">Inventory Date: <b>'.$invdate.'</b></td></tr>
<tr><td style="font-size: 11px;">Account title: <b>'.$acctitle.'</b></td></tr>
</table>

<table align="center" width="100%" border="1" style="border-collapse: collapse;">
<tr>
<td style="text-align: center; font-size: 11px; width: 5%;"><b>NO.</b></td>
<td style="text-align: center; font-size: 11px; width: 60%;"><b>DESCRIPTION</b></td>
<td style="text-align: center; font-size: 11px; width: 10%;"><b>EXPIRATION</b></td>
<td style="text-align: center; font-size: 11px; width: 5%;"><b>QTY</b></td>
<td style="text-align: center; font-size: 11px; width: 10%;"><b>PHYSICAL<br>COUNT 1</b></td>
<td style="text-align: center; font-size: 11px; width: 10%;"><b>PHYSICAL<br>COUNT 2</b></td>
</tr>
</table>
</header>


<main>
<table align="center" width="100%" border="1" style="border-collapse: collapse;">
';

$i=0;
$result = $conn->query("select sum(s.quantity) as qty, r.description, r.generic from receiving r, stocktable s where r.code=s.code and 
r.unit='$acctitle' and s.dept='$dept' group by r.code");
while($row = $result->fetch_assoc()){ 
$qty=$row['qty'];
$desc=$row['description'];
$generic=$row['generic'];
$i++;


$html .= '
<tr>
<td style="text-align: center; font-size: 11px; width: 5%;">'.$i.'</td>
<td style="font-size: 11px; width: 60%;">'.$desc.'</td>
<td style="text-align: center; font-size: 11px; width: 10%;"></td>
<td style="text-align: center; font-size: 11px; width: 5%;">'.$qty.'</td>
<td style="text-align: center; font-size: 11px; width: 10%;"></td>
<td style="font-size: 11px; width: 10%;"></td>
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
</main>
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
