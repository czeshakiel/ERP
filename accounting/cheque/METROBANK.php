<?php
include "../../main/class.php";
$voucher = $_GET['voucher'];

$sql22 = "SELECT * from arv_tbl_paymentledger where voucherno = '$voucher'";
$result22 = $conn->query($sql22);
while($row22 = $result22->fetch_assoc()) {
$amount=$row22['amount'];
$payee=$row22['payee'];
$datearray=$row22['datearray'];
$mydate = date("m-d-Y", strtotime($datearray));
$mydate = str_replace("-", ".             -                .", $mydate);

}

$amount2 = number_format($amount,2);
$amount = number_format($amount, 2, '.', '');
list($peso, $cent) = explode(".", $amount);


$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
$numpeso =  $f->format($peso);
$numword = ucwords($numpeso)." and ".$cent."/100 Only.";

echo"
<table width='80%' align='center'><tr><td align='right'>$mydate</td></tr></table>
<br>
<table width='93%' align='center'>

<tr>
<td></td>
<td>*** $payee ***</td>
<td align='right'>*** $amount2 ***</td>
</tr>
<tr>
<td></td>
<td colspan = '2'>*** $numword ***</td>
</tr>
</table>
";
?>
