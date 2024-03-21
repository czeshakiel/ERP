<div>
	<table width="100%" border="1" style="border-collapse: collapse;">
		<?php	
		$x=1;	
		$totalamount=0;
		$totalliter=0;
		foreach($body as $item){
			$total=$item['quantity']*$item['sellingprice'];
			echo "
			<tr>
				<td width='5%'>$x.</td>
				<td width='50%'>$item[lastname], $item[firstname]</td>
				<td width='15%' align='center'>".date('M-d-Y',strtotime($item['dateadmit']))."</td>
				<td width='15%' align='center'>$item[quantity]</td>
				<td width='15%' align='right'>".number_format($total,2)."</td>
			</tr>
			";
			$x++;
			$totalamount +=$total;
			$totalliter +=$item['quantity'];
		}		
		?>
		<tr>
			<td colspan="3" align='right'><b>Total</b></td>
			<td align='center'><b><?=$totalliter;?></b></td>
			<td align='right'><b><?=number_format($totalliter,2);?></b></td>
		</tr>
	</table>
</div>