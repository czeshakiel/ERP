
<div>
	<table width="100%" border="1" cellspacing="0" cellpadding="1" style="font-family:Arial;font-size:12px;border-collapse:collapse;">
		<?php
		$grandtotal=0;
		$totalgross=0;
		$x=1;
		foreach($body AS $item){
			$desc=str_replace('cmshi-','',$item['description']);
			$desc=str_replace('-med','',$desc);
			$desc=str_replace('-sup','',$desc);
			$desc=str_replace('ams-','',$desc);
			if($item['prodtype1']==""){
				$disc=0;
			}else{
				$disc=$item['prodtype1'];
			}
			if($disc==0){
				$totalamount=$item['unitcost']*$item['prodqty'];
			}else{
				$totalamount=$disc*$item['prodqty'];
			}
			$remqty=$this->Purchase_model->getQty($item['code'],$item['dept']);
			if($remqty['soh']>0){
				$rqty=$remqty['soh'];
			}else{
				$rqty=0;
			}
			$lastdate=$this->Purchase_model->getLastDate($item['code'],$item['dept']);
			$totalgross +=$item['unitcost']*$item['prodqty'];
			if($item['generic']==""){
				$generic="";
			}else{
				$generic="(".$item['generic'].") ";
			}
			echo "<tr>";
			echo "<td width='41%'>".$generic.$desc."</td>";
			echo "<td align='center' width='10%'>".$lastdate['datearray']."</td>";
			echo "<td align='center' width='10%'>".$lastdate['quantity']."</td>";
			echo "<td align='center' width='11%'>".$rqty."</td>";
			echo "<td align='center' width='10%'>".$item['prodqty']."</td>";
			echo "<td align='right' width='7%'>".number_format($item['unitcost'],2)."</td>";
			echo "<td align='right' width='7%'>".number_format($disc,2)."</td>";
			echo "<td align='right' width='10%'>".number_format($totalamount,2)."</td>";
			echo "</tr>";
			$grandtotal +=$totalamount;
			$x++;
		}
		?>
	</table>
	<br />
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-family:Arial;font-size:12px;border-collapse:collapse;">
		<tr>
			<td>
				<b>Total</b>
			</td>
			<td align='right'>
				<b><?=number_format($grandtotal,2);?></b>
			</td>
		</tr>
	</table>
	<br />
	<table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-family:Arial; font-size:10px; font-weight:bold;">
		<tr>
			<td align="left">Prepared by:</td>
			<td align="left">Approved by:</td>
			<td align="left">Noted by: (for CSR Request Supplies)</td>
		</tr>
		<tr>
			<td align="left"  width="35%"><br><br />____________________________________</td>
			<td align="left"  width="35%"><br><br />____________________________________</td>
			<td align="left"  width="30%"><br><br />____________________________________</td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td align="left"></td>
			<td align="left"><br><br />____________________________________</td>
			<td align="left"></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td align="left">Reviewed by:</td>
			<td align="left"></td>
			<td align="left">Received by:</td>
		</tr>
		<tr>
			<td align="left"  width="35%"><br><br />____________________________________</td>
			<td align="left"  width="35%"><br><br />____________________________________</td>
			<td align="left"  width="30%"><br><br />____________________________________</td>
		</tr>
	</table>
</div>
