
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
			$qtyonhand=$this->Purchase_model->getLastDateQuantity($item['code'],$item['dept'],$lastdate['datearray']);
			if($qtyonhand['quantity']<0){
				$qtyhand=0;
			}else{
				$qtyhand=$qtyonhand['quantity'];
			}
			$totalgross +=$item['unitcost']*$item['prodqty'];
			if($item['generic']==""){
				$generic="";
			}else{
				$generic="(".$item['generic'].") ";
			}
			$qtyused=($qtyhand+$lastdate['quantity'])-$rqty;
			$diff=date_diff(date_create($transdate),date_create($lastdate['date']));
			$invdate=$diff->format('%a');
			if($invdate>0){
				$dailyusage=$qtyused/$invdate;
			}else{
				$dailyusage=0;
			}
			$recommend=$dailyusage*60;
			echo "<tr>";
			echo "<td width='41%'>".$generic.$desc."</td>";
			echo "<td align='center' width='10%'>".$lastdate['datearray']."</td>";
			echo "<td align='center' width='5%'>".$qtyhand."</td>";
			echo "<td align='center' width='5%'>".$lastdate['quantity']."</td>";
			echo "<td align='center' width='5%'>".$rqty."</td>";
			echo "<td align='center' width='5%'>".$qtyused."</td>";
			echo "<td align='center' width='5%'>".$invdate."</td>";
			echo "<td align='center' width='10%'>".number_format($dailyusage,8)."</td>";
			echo "<td align='center' width='10%'>".number_format($recommend,8)."</td>";
			echo "<td align='center' width='5%'>".$item['prodqty']."</td>";
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
			<td align="left">Verified by:</td>
		</tr>
		<tr>
			<td align="left"  width="35%"><br><br />____________________________________</td>
			<td align="left"  width="35%"><br><br />____________________________________</td>
		</tr>
	</table>
</div>
