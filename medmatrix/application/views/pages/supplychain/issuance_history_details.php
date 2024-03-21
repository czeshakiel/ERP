<div>
	<table width="100%" border="1" cellspacing="0" cellpadding="1" style="border-collapse:collapse;font-size:11px;">
		<tr>
			<td width="15%">Date Range:</td>
			<td><?=date('M-d-Y',strtotime($startdate));?> to <?=date('M-d-Y',strtotime($enddate));?></td>
		</tr>
		<tr>
			<td width="15%">Department:</td>
			<td><?=$department;?></td>
		</tr>
	</table>
	<br />
	<table width="100%" border="1" cellspacing="0" cellpadding="1" style="border-collapse:collapse;font-size:10px;">
		<thead>
		<tr>
			<td align="center" style="font-size:10px;font-family: Times New Roman;">No.</td>
			<td align="center" style="font-size:10px;font-family: Times New Roman;">REF NO</td>
			<td align="center" style="font-size:10px;font-family: Times New Roman;">DESCRIPTION</td>
			<td align="center" style="font-size:10px;font-family: Times New Roman;">ACCOUNT TITLES</td>
			<td align="center" style="font-size:10px;font-family: Times New Roman;">DEPARTMENT</td>
			<td align="center" style="font-size:10px;font-family: Times New Roman;">SUPPLIER</td>
			<td align="center" style="font-size:10px;font-family: Times New Roman;">QTY</td>
			<td align="center" style="font-size:10px;font-family: Times New Roman;">UNIT COST</td>
			<td align="center" style="font-size:10px;font-family: Times New Roman;">SUB TOTAL</td>
		</tr>
		</thead>
		<tbody>
		<?php
		$x=1;
		$totalamount=0;
		foreach($items AS $row){
			$tamount=0;
			$unitcost=0;
			$desc=str_replace('ams-','',$row['description']);
			$desc=str_replace('-med','',$desc);
			$desc=str_replace('-sup','',$desc);
			$desc=str_replace('cmshi-','',$desc);
			$accttitle=str_replace('PHARMACY/','',$row['unit']);			
			if($row['generic']==""){
				$generic="";
			}else{
				$generic="(".$row['generic'].") ";
			}
			$disc=$this->Purchase_model->getDiscount($row['code']);
			if($disc['prodtype1'] > 0){
				$unitcost=$disc['prodtype1'];
				$tamount=$unitcost*$row['quantity'];
			}else{
				$unitcost=$disc['unitcost'];
				if($unitcost==0){
					$unitcost=$row['amount'];
				}
				$tamount=$unitcost*$row['quantity'];
			}
			echo "<tr>";
			echo "<td align='center'>$x.</td>";
			echo "<td align='center'>$row[autono]</td>";
			echo "<td>$generic$desc</td>";
			echo "<td align='center'>$accttitle</td>";
			echo "<td align='center'>$row[reqdept]</td>";
			echo "<td align='center'>$row[suppliername]</td>";
			echo "<td align='center'>$row[quantity]</td>";
			echo "<td align='right'>".number_format($unitcost,2,".",",")."</td>";
			echo "<td align='right'>".number_format($tamount,2,".",",")."</td>";
			echo "</tr>";
			$totalamount +=$tamount;
			$x++;
		}
		?>
		<tr>
			<td colspan="9" style="border:0;">
				&nbsp;
			</td>
		</tr>
		<tr>
			<td colspan="7" style="border:0;" align="right">
				<b>TOTAL</b>
			</td>
			<td colspan="2" style="border:0;" align="right">
				<b><?=number_format($totalamount,2);?></b>
			</td>
		</tr>
		</tbody>
	</table>
</div>
<br />
<div>
	<table border="0" width="100%" style="font-size:12px;">
		<tr>
			<td>
				<b>Prepared by:</b>
			</td>
			<td>
				<b>Checked by:</b>
			</td>
			<td>
				<b>Received by:</b>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				&nbsp;
			</td>
		</tr>
		<tr>
			<td>
				<u><b><?=$this->session->fullname;?></b></u>
			</td>
			<td>
				<u><b>JIHAN S. KUSAIN, Rph</b></u>
			</td>
			<td>
				<u><b>MEHRALYN L. TORCULAS</b></u>
			</td>
		</tr>
		<tr>
			<td>
				<b>CPU Staff</b>
			</td>
			<td>
				<b>CPU Head</b>
			</td>
			<td>
				<b>Accounting</b>
			</td>
		</tr>
	</table>
</div>
