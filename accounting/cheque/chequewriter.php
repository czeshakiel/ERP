<?php
include "../../main/class.php";
$voucher = $_GET['voucher'];

$amount = $_GET['amount'];
$doc = $_GET['doctor'];

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
<td>*** $doc ***</td>
<td align='right'>*** $amount2 ***</td>
</tr>
<tr>
<td></td>
<td colspan = '2'>*** $numword ***</td>
</tr>
</table>
";
?>
