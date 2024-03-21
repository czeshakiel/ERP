<table width="100%" border="1" cellspacing="0" cellpadding="1" style="border-collapse: collapse; font-size: 12px;">
	<tr>
		<td align="center"><b>No.</b></td>
		<td align="center"><b>Document Type</b></td>
		<td align="center"><b>Issued To</b></td>
		<td align="center"><b>Issued By</b></td>
		<td align="center"><b>Amount</b></td>
		<?php
		if($type=="CHARGED"){
		?>
		<td align="center"><b>Charged To</b></td>
		<?php
		}
		?>
	</tr>
	<?php
	$x=1;
	$totalamount=0;
	foreach($documents as $item){
		if($item['is_employee'] <> ""){
			$unitcost=0;
		}else{
			$unitcost=$item['unitcost'];
		}
		if($type=="CASH" && $unitcost > 0){
			echo "<tr>";
				echo "<td>$x.</td>";
				echo "<td>$item[type]</td>";
				echo "<td>$item[lastname], $item[firstname] $item[middlename] $item[suffix]</td>";
				echo "<td>$item[user]</td>";
				echo "<td align='right'>".number_format($unitcost,2)."</td>";
				if($type=="CHARGED"){
					echo "<td>$item[is_employee]</td>";
				}
			echo "</tr>";
			$totalamount +=$unitcost;
		}else if($type=="CHARGED" && $unitcost == 0){
			echo "<tr>";
				echo "<td>$x.</td>";
				echo "<td>$item[type]</td>";
				echo "<td>$item[lastname], $item[firstname] $item[middlename] $item[suffix]</td>";
				echo "<td>$item[user]</td>";
				echo "<td align='right'>".number_format($unitcost,2)."</td>";
				if($type=="CHARGED"){
					echo "<td>$item[is_employee]</td>";
				}
			echo "</tr>";
			$totalamount +=$unitcost;
		}
		$x++;

	}
	foreach($medicolegal as $item){
		if($item['is_employee'] <> ""){
			$unitcost=0;
		}else{
			$unitcost=$item['unitcost'];
		}
		if($type=="CASH" && $unitcost > 0){
			echo "<tr>";
				echo "<td>$x.</td>";
				echo "<td>MEDICO LEGAL</td>";
				echo "<td>$item[lastname], $item[firstname] $item[middlename] $item[suffix]</td>";
				echo "<td>$item[user]</td>";
				echo "<td align='right'>".number_format($unitcost,2)."</td>";
				if($type=="CHARGED"){
					echo "<td>$item[is_employee]</td>";
				}
			echo "</tr>";
			$totalamount +=$unitcost;
		}else if($type=="CHARGED" && $unitcost == 0){
			echo "<tr>";
				echo "<td>$x.</td>";
				echo "<td>MEDICO LEGAL</td>";
				echo "<td>$item[lastname], $item[firstname] $item[middlename] $item[suffix]</td>";
				echo "<td>$item[user]</td>";
				echo "<td align='right'>".number_format($unitcost,2)."</td>";
				if($type=="CHARGED"){
					echo "<td>$item[is_employee]</td>";
				}
			echo "</tr>";
			$totalamount +=$unitcost;
		}
		$x++;

	}
	foreach($others as $item){
			$unitcost=$item['unitcost'];
			if($type=="CASH" && $unitcost > 0){
			echo "<tr>";
				echo "<td>$x.</td>";
				echo "<td>$item[description] ($item[type])</td>";
				echo "<td>$item[lastname], $item[firstname] $item[middlename] $item[suffix]</td>";
				echo "<td>$item[user]</td>";
				echo "<td align='right'>".number_format($unitcost,2)."</td>";
				if($type=="CHARGED"){
					echo "<td></td>";
				}
			echo "</tr>";
			$totalamount +=$unitcost;
		}
		$x++;

	}
	?>
	<!-- <tr style="border:0;">
		<td colspan="5">&nbsp;</td>
		<?php
		if($type=="CHARGED"){
		?>
		<td align="center">&nbsp;</td>
		<?php
		}
		?>
	</tr> -->
	<tr>
		<td colspan="4" align="right"><b>TOTAL</b></td>
		<td align="right"><?=number_format($totalamount,2);?></td>
		<?php
		if($type=="CHARGED"){
		?>
		<td align="center">&nbsp;</td>
		<?php
		}
		?>
	</tr>
</table>
