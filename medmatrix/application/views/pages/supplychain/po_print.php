<div>
	<table width="100%" border="1" cellspacing="0" cellpadding="1" style="font-family:Arial;font-size:12px;border-collapse:collapse;">
		<?php
		$grandtotal=0;
		$totalgross=0;
		$x=1;
		foreach($body AS $item){
			$desc=str_replace('ams-','',$item['description']);
			$desc=str_replace('-med','',$desc);
			$desc=str_replace('-sup','',$desc);
			if($item['prodtype1']==0){
				$totalamount=$item['unitcost']*$item['prodqty'];
			}else{
				$totalamount=$item['prodtype1']*$item['prodqty'];
			}
			$totalgross +=$item['unitcost']*$item['prodqty'];
			if($item['generic']==""){
				$generic="";
			}else{
				$generic="(".$item['generic'].") ";
			}
			echo "<tr>";
			echo "<td width='41%'>".$generic.$desc."</td>";
			echo "<td align='center' width='5%'>".$item['prodqty']."</td>";
			echo "<td align='center' width='9%'>".$item['unit']."</td>";
			echo "<td align='right' width='15%'>".number_format($item['unitcost'],2)."</td>";
			echo "<td align='right' width='15%'>".number_format($item['prodtype1'],2)."</td>";
			echo "<td align='right' width='15%'>".number_format($totalamount,2)."</td>";
			echo "</tr>";
			$grandtotal +=$totalamount;
			$x++;
		}
		?>
	</table>
</div>
