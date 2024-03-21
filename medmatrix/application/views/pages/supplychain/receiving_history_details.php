
<div>
	<table width="100%" border="1" cellspacing="0" cellpadding="2" style="font-family:Arial;font-size:12px;border-collapse:collapse;">
		<tr>
			<th align="center" width="11%">Date</th>
			<th align="center" width="38%">Description</th>
			<th align="center" width="15%">Supplier</th>
			<th align="center" width="13%">Ref No.</th>
			<th align="center" width="5%">Qty</th>
			<th align="center" width="8%">Unit Cost</th>
			<th align="center" width="10%">Total</th>
		</tr>
		<?php
		$grandtotal=0;
		$totalgross=0;
		$x=1;
		foreach($body AS $item){
			$desc=str_replace('ams-','',$item['description']);
			$desc=str_replace('-med','',$desc);
			$desc=str_replace('-sup','',$desc);
			$totalamount=$item['unitcost']*$item['quantity'];
			if($item['generic']==""){
				$generic="";
			}else{
				$generic="(".$item['generic'].") ";
			}
			echo "<tr>";
			echo "<td align='center' width='11%'>".date('m/d/Y',strtotime($item['datearray']))."</td>";
			echo "<td width='38%'>".$generic.$desc."</td>";
			echo "<td align='center' width='15%'>".$item['suppliername']."</td>";
			echo "<td align='center' width='13%'>".$item['rrno']."</td>";
			echo "<td align='center' width='5%'>".$item['quantity']."</td>";
			echo "<td align='right' width='8%'>".number_format($item['unitcost'],2)."</td>";
			echo "<td align='right' width='10%'>".number_format($totalamount,2)."</td>";
			echo "</tr>";
			$x++;
		}
		?>
	</table>
</div>
