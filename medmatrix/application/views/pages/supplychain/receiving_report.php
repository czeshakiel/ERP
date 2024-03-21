
<div>
	<table width="400" border="0" cellspacing="0" cellpadding="1" style="font-family:Arial;font-size:9.5px; border-collapse: collapse;">
		<?php
		$grandtotal=0;
		$totalgross=0;
		$net=0;
		$vat=0;
		foreach($body AS $item){
			$desc=str_replace('ams-','',$item['description']);
			$desc=str_replace('-med','',$desc);
			$desc=str_replace('-sup','',$desc);
			if($item['prodtype1']== 0){
				$totalamount=$item['unitcost']*$item['quantity'];
			}else{
				$totalamount=$item['prodtype1']*$item['quantity'];
			}
			if(($item['vat']) > 0 ){
				$net=$totalamount/1.12;
				$vat=$totalamount-$net;
			}else{
				$net=$totalamount;
				$vat=0;
			}
			if($item['trantype']=="FREE GOODS"){
				$fg="(FG)";
				$net=0;
				$vat=0;
				$totalamount=0;
			}else{
				$fg="";
			}
			if($item['generic']==""){
				$generic="";
			}else{
				$generic="(".$item['generic'].")<br>";
			}
			if($item['dept']=="CPU" || $item['dept']=="CSR"){
				$dept=$item['dept'];
			}if($item['dept']=="CPU-RDU"){
				$dept=" CPU<br>RDU";
			}else{
				$dept="PHR";
			}
			if($item['quantity']>0) {
				echo "<tr>";
				echo '<td align="center" width="5%" style="border-bottom:1px solid black; vertical-align:top;">' . $item['quantity'] . '</td>';
				echo '<td align="center" width="9%" style="border-bottom:1px solid black; vertical-align:top;">' . $item['unit'] . '</td>';
				echo '<td width="39%" style="border-bottom:1px solid black;">' . $generic . $desc . $fg . '</td>';
				echo '<td align="center" width="6%" style="border-bottom:1px solid black; vertical-align:top;">1</td>';
				echo '<td align="center" width="7%" style="border-bottom:1px solid black; vertical-align:top;">' . $dept . '</td>';
				echo '<td align="right" width="11%" style="border-bottom:1px solid black; vertical-align:top;">' . number_format($item['unitcost'], 3) . '</td>';
				echo '<td align="right" width="10%" style="border-bottom:1px solid black; vertical-align:top;">' . number_format($item['prodtype1'], 2) . '</td>';
				echo '<td align="right" width="12%" style="border-bottom:1px solid black; vertical-align:top;">' . number_format($totalamount, 2) . '</td>';
				echo '<td align="right" width="11%" style="border-bottom:1px solid black; vertical-align:top;">' . number_format($vat, 2) . '</td>';
				echo '<td align="right" width="12%" style="border-bottom:1px solid black; vertical-align:top;">' . number_format($net, 2) . '</td>';
				echo "</tr>";
			}

		}
		?>
	</table>
</div>
