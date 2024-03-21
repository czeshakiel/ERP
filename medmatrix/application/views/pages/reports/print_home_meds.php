<table width="100%" border="0" cellpadding="2" cellspacing="0" style="font-size: 10px;">	
	<?php
	$x=1;
	$amount=0;
	$totalamount=0;
	foreach($body as $item){
		 $remarks=$this->General_model->getAllHomeMedsRemarks($caseno,$item['refno']);
		// $amount +=$item['gross'];
		// $totalamount +=$item['gross'];
		echo "<tr>";
			echo "<td>$item[productdesc]</td>";
			echo "<td align='center' width='10%'>$item[quantity]</td>";
			// echo "<td align='right' width='20%'>".number_format($item['gross'],2)."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td colspan='2' style='color:blue;'>$remarks[dosage] $remarks[frequency]</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td colspan='2' style='font-size:8px;'>&nbsp;</td>";
		echo "</tr>";
		// if($x == 6){	
		// 	$totalamount = 0;		
		// 	echo "<tr>";
		// 		echo "<td colspan='2' align='right'><b>Total</b></td>";
		// 		echo "<td align='right'>".number_format($amount,2)."</td>";
		// 	echo "</tr>";
		// 	$x=0;
		// }
		// $x++;
	}
			// echo "<tr>";
			// 	echo "<td colspan='2' align='right'><b>Total</b></td>";
			// 	echo "<td align='right'>".number_format($totalamount,2)."</td>";
			// echo "</tr>";
	?>
</table>