
<div>
	<table width="100%" border="1" cellspacing="0" cellpadding="2" style="font-family:Arial;font-size:12px;border-collapse:collapse;">
		<tr>
                    	<td align="center" width="10%">Date</td>
                    	<td align="center" width="38%">Description</td>
                    	<td align="center" width="15%">Ref No.</td>                    	
                    	<td align="center" width="10%">Unit Cost</td>                    	
                    	<td align="center" width="5%">Qty</td>                    	
                    	<td align="center" width="10%">Total</td>                    	
					</tr>
		<?php
		$grandtotal=0;
		$totalamount=0;
		$x=1;
		foreach($body AS $item){
			$desc=str_replace('ams-','',$item['description']);
			$desc=str_replace('-med','',$desc);
			$desc=str_replace('-sup','',$desc);
			if($item['prodtype1'] > 0){
				$totalamount=$item['prodtype1']*$item['quantity'];
				$unitcost=$item['prodtype1'];
			}else{
				$totalamount=$item['unitcost']*$item['quantity'];
				$unitcost=$item['unitcost'];
			}			
			if($item['generic']==""){
				$generic="";
			}else{
				$generic="(".$item['generic'].") ";
			}
			echo "<tr>";
			echo "<td align='center' width='12%'>".date('m/d/Y',strtotime($item['datearray']))."</td>";
			echo "<td width='38%'>".$generic.$desc."</td>";
			echo "<td align='center' width='15%'>".$item['rrno']."</td>";			
			echo "<td align='right' width='10%'>".number_format($unitcost,2)."</td>";		
			echo "<td align='center' width='5%'>".$item['quantity']."</td>";
			echo "<td align='right' width='15%'>".number_format($totalamount,2)."</td>";							
			echo "</tr>";
			$x++;			
			$grandtotal +=$totalamount;
		}
		?>
	</table>
	<p align="right"><b>Total Amount: <?=number_format($grandtotal,2);?></b></p>
</div>
